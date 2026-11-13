const BOARD_SIZE = 12;
	let boardState = [];
	let currentPlayer = 'X'; // X: Bạn, O: Máy
	let isGameOver = false;

	function initCaroBoard() {
		const boardElem = document.getElementById('caroBoard');
		boardElem.innerHTML = '';
		boardState = Array(BOARD_SIZE).fill(null).map(() => Array(BOARD_SIZE).fill(''));
		currentPlayer = 'X';
		isGameOver = false;
		
		document.getElementById('caroStatus').innerHTML = 'Lượt đi: <span class="player-x">Bạn (X)</span>';

		for (let r = 0; r < BOARD_SIZE; r++) {
			for (let c = 0; c < BOARD_SIZE; c++) {
				const cell = document.createElement('div');
				cell.classList.add('caro-cell');
				cell.dataset.row = r;
				cell.dataset.col = c;
				cell.addEventListener('click', handleCellClick);
				boardElem.appendChild(cell);
			}
		}
	}

	function handleCellClick(e) {
		if (isGameOver || currentPlayer !== 'X') return;

		const r = parseInt(e.target.dataset.row);
		const c = parseInt(e.target.dataset.col);

		if (boardState[r][c] !== '') return;

		// Người chơi đi (X)
		makeMove(r, c, 'X');

		if (checkWin(r, c, 'X')) {
			document.getElementById('caroStatus').innerHTML = '<span class="player-x">BẠN ĐÃ THẮNG MÁY! 🎉</span>';
			isGameOver = true;
			return;
		}

		if (isBoardFull()) {
			document.getElementById('caroStatus').innerHTML = '<span>HÒA CỜ!</span>';
			isGameOver = true;
			return;
		}

		// Chuyển lượt sang Máy (O)
		currentPlayer = 'O';
		document.getElementById('caroStatus').innerHTML = 'Máy đang suy nghĩ... <span class="player-o">(O)</span>';

		setTimeout(makeAIMove, 300); // Tạo độ trễ 0.3s để tạo cảm giác máy nghĩ
	}

	function makeMove(r, c, player) {
		boardState[r][c] = player;
		const cellElem = document.querySelector(`.caro-cell[data-row="${r}"][data-col="${c}"]`);
		if (cellElem) {
			cellElem.textContent = player;
			cellElem.classList.add(player.toLowerCase());
		}
	}

	// Thuật toán AI cho Máy đánh
	function makeAIMove() {
		if (isGameOver) return;

		let bestScore = -Infinity;
		let bestMove = null;

		// Duyệt từng ô trống để chấm điểm
		for (let r = 0; r < BOARD_SIZE; r++) {
			for (let c = 0; c < BOARD_SIZE; c++) {
				if (boardState[r][c] === '') {
					let attackScore = evaluateCell(r, c, 'O');  // Điểm tấn công của Máy
					let defenseScore = evaluateCell(r, c, 'X'); // Điểm phòng thủ (chặn Bạn)
					
					// Kết hợp điểm (ưu tiên phòng thủ khi Bạn có nguy cơ 4-5 nước)
					let totalScore = attackScore + defenseScore * 1.2;

					if (totalScore > bestScore) {
						bestScore = totalScore;
						bestMove = { r, c };
					}
				}
			}
		}

		if (bestMove) {
			makeMove(bestMove.r, bestMove.c, 'O');

			if (checkWin(bestMove.r, bestMove.c, 'O')) {
				document.getElementById('caroStatus').innerHTML = '<span class="player-o">MÁY ĐÃ THẮNG! 🤖</span>';
				isGameOver = true;
				return;
			}

			if (isBoardFull()) {
				document.getElementById('caroStatus').innerHTML = '<span>HÒA CỜ!</span>';
				isGameOver = true;
				return;
			}

			currentPlayer = 'X';
			document.getElementById('caroStatus').innerHTML = 'Lượt đi: <span class="player-x">Bạn (X)</span>';
		}
	}

	// Đánh giá mức độ nguy hiểm/tiềm năng của từng ô
	function evaluateCell(r, c, player) {
		const directions = [
			[[0, 1], [0, -1]],   // Ngang
			[[1, 0], [-1, 0]],   // Dọc
			[[1, 1], [-1, -1]],  // Chéo chính
			[[1, -1], [-1, 1]]   // Chéo phụ
		];

		let score = 0;

		for (let dir of directions) {
			let count = 1;
			let openEnds = 0;

			for (let [dr, dc] of dir) {
				let currR = r + dr;
				let currC = c + dc;
				
				while (
					currR >= 0 && currR < BOARD_SIZE &&
					currC >= 0 && currC < BOARD_SIZE &&
					boardState[currR][currC] === player
				) {
					count++;
					currR += dr;
					currC += dc;
				}

				if (
					currR >= 0 && currR < BOARD_SIZE &&
					currC >= 0 && currC < BOARD_SIZE &&
					boardState[currR][currC] === ''
				) {
					openEnds++;
				}
			}

			if (count >= 5) score += 100000;
			else if (count === 4) score += openEnds > 0 ? 10000 : 1000;
			else if (count === 3) score += openEnds > 0 ? 1000 : 100;
			else if (count === 2) score += openEnds > 0 ? 100 : 10;
		}

		return score;
	}

	function checkWin(r, c, player) {
		const directions = [
			[[0, 1], [0, -1]],
			[[1, 0], [-1, 0]],
			[[1, 1], [-1, -1]],
			[[1, -1], [-1, 1]]
		];

		for (let dir of directions) {
			let count = 1;
			for (let [dr, dc] of dir) {
				let currR = r + dr;
				let currC = c + dc;
				while (
					currR >= 0 && currR < BOARD_SIZE &&
					currC >= 0 && currC < BOARD_SIZE &&
					boardState[currR][currC] === player
				) {
					count++;
					currR += dr;
					currC += dc;
				}
			}
			if (count >= 5) return true;
		}
		return false;
	}

	function isBoardFull() {
		return boardState.every(row => row.every(cell => cell !== ''));
	}

	function resetCaroGame() {
		initCaroBoard();
	}

	window.addEventListener('DOMContentLoaded', initCaroBoard);