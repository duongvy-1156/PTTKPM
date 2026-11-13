<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f5f7fa;
    margin: 0;
    padding: 30px;
}

.bieumau1 {
    width: 900px;
    margin: 0 auto;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
}

/* Tiêu đề */
.bieumau1 h2 {
    margin: 0;
    padding: 15px;
    color: white;
    background: #2672EC;
    font-size: 24px;
}

/* Các ô */
.bieumau1 th,
.bieumau1 td {
    border: 1px solid #ddd;
    padding: 10px;
}

/* Dòng tiêu đề cột */
.bieumau1 tr:nth-child(2) {
    background: #e8f1ff;
    font-weight: bold;
    color: #2672EC;
    text-align: center;
}

/* Căn giữa */
.canhgiua {
    text-align: center;
}

/* STT */
.bieumau1 td:first-child {
    width: 60px;
    text-align: center;
}

/* Hình ảnh */
.bieumau1 img {
    width: 100px;
    height: 80px;
    object-fit: cover;
    display: block;
    margin: auto;
}

/* Cột hình ảnh */
.bieumau1 td:nth-child(3) {
    text-align: center;
}

/* Giá */
.bieumau1 td:nth-child(4),
.bieumau1 td:nth-child(5) {
    text-align: right;
    font-weight: bold;
}

/* Đổi màu dòng khi rê chuột */
.bieumau1 tr:hover {
    background: #f0f7ff;
}

/* Không đổi màu tiêu đề */
.bieumau1 tr:first-child:hover,
.bieumau1 tr:nth-child(2):hover {
    background: inherit;
}
</style>

</head>

<body>

<table class="bieumau1">

    <tr>
        <td colspan="5" class="canhgiua">
            <h2>Danh mục sản phẩm</h2>
        </td>
    </tr>

    <tr>
        <td>STT</td>
        <td>Tên Sản Phẩm</td>
        <td>Hình ảnh</td>
        <td>Giá bán</td>
        <td>Giá gốc</td>
    </tr>

    <?php
     $servername = "localhost";
$username = "root";
$password = "vertrigo";
$dbname = "qlhanghoa";

// Kết nối database
$connect = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);

// Nếu kết nối bị lỗi
if ($connect->connect_error) {
    die("Không kết nối: " . $connect->connect_error);
}

// Thực hiện câu lệnh SQL
$sql = "SELECT * FROM mathang";

$danhsach = $connect->query($sql);

// Nếu câu lệnh SQL bị lỗi
if (!$danhsach) {
    die(
        "Không thể thực hiện câu lệnh SQL: "
        . $connect->error
    );
}

$stt = 1;
// Hiển thị dữ liệu
while ($row = $danhsach->fetch_array(MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $stt . "</td>";
    echo "<td>" . $row["TenHang"] . "</td>";
    echo "<td>";
    echo "<img src=\"" . $row["HinhAnh"] . "\">";
    echo "</td>";
    echo "<td>" . $row["GiaBan"] . "</td>";
    echo "<td>" . $row["GiaGoc"] . "</td>";
    echo "</tr>";
    $stt++;
}

// Đóng kết nối
$connect->close();
   

 ?>

</table>

</body>
</html>