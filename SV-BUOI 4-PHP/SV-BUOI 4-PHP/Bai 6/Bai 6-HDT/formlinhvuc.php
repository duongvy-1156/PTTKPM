<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Thêm lĩnh vực</title>

    <style>
        table {
            border-collapse: collapse;
            width: 400px;
            margin: 80px auto;
            border: solid green 1px;
        }

        td {
            font-size: 16px;
            text-align: left;
            padding: 8px;
            border-bottom: solid green 1px;
            color: #000080;
        }

        /* Tiêu đề */
        tr:first-child td {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            color: blue;
            background-color: #F0FFF0;
            padding: 12px;
        }

        /* Ô nhập */
        input[type="text"] {
            width: 200px;
            padding: 6px;
            border: 1px solid #999;
            font-size: 15px;
        }

        input[type="text"]:focus {
            border: 1px solid blue;
            outline: none;
        }

        /* Nút */
        input[type="submit"],
        input[type="reset"] {
            padding: 6px 18px;
            margin: 3px;
            border: 1px solid #666;
            border-radius: 4px;
            font-size: 15px;
            cursor: pointer;
        }

        /* Nút Lưu */
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
        }

        input[type="submit"]:hover {
            background-color: #388E3C;
        }

        /* Nút Xóa */
        input[type="reset"] {
            background-color: #ddd;
            color: #333;
        }

        input[type="reset"]:hover {
            background-color: #bbb;
        }

        /* Hiệu ứng dòng */
        tr:hover {
            background-color: #FFFACD;
        }
		.th1{
			text-align: center;
		}
    </style>
</head>

<body>

<form name="fLinhVuc" method="POST" action="themlinhvuc.php">

    <table>
        <tr>
            <td colspan="2">
                THÊM LĨNH VỰC
            </td>
        </tr>

        <tr>
            <td>Mã lĩnh vực</td>
            <td>
                <input type="text" name="txtMaLinhVuc">
            </td>
        </tr>

        <tr>
            <td>Tên lĩnh vực</td>
            <td>
                <input type="text" name="txtTenLinhVuc">
            </td>
        </tr>

        <tr>
            <td class="th1" colspan="2" align="center">
                <input type="submit" name="btnLuu" value="Lưu">
                <input type="reset" name="btnXoa" value="Xóa">
            </td>
        </tr>
    </table>

</form>

</body>
</html>
