<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles/style11.css">
</head>

<body>

<?php
include_once "cauhinh.php";
// Lấy danh sách khách hàng
$sql = "SELECT * FROM `khachhang` WHERE 1";
$danhsach = $connect->query($sql);
// Nếu câu lệnh sql bị lỗi
if (!$danhsach) {
    die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
 }

?>

<table align="center" class="List" border="0" width="700" cellpadding="3">

    <tr>
        <td colspan="8" class="tieude1">
            Danh sách khách hàng thân thiết
        </td>
    </tr>

    <tr>
        <th>Mã KH</th>
        <th>Họ và tên</th>
        <th>Năm sinh</th>
        <th>Giới tính</th>
        <th>Điểm mua hàng</th>
        <th>Ghi chú</th>
        <th colspan="2">Hành động</th>
    </tr>

    <?php
     while ($row = $danhsach->fetch_array(MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['MaKH'] . "</td>";
    echo "<td>" . $row['HoVaTen'] . "</td>";
    echo "<td>" . $row['NamSinh'] . "</td>";
    echo "<td>" 
        . ($row['GioiTinh'] == 0 ? "Nam" : "Nữ") 
        . "</td>";
    echo "<td>" . $row['DiemMuaHang'] . "</td>";
    echo "<td>" . $row['GhiChu'] . "</td>";
    
    // Nút sửa
    echo "<td align='center'>
            <a href='suakhachhang.php?id=" . $row['MaKH'] . "'>
                <img src='images/edit.png'>
            </a>
          </td>";
          
    // Nút xóa
    echo "<td align='center'>
            <a href='xoakhachhang.php?id=" . $row['MaKH'] . "'>
                <img src='images/delete.png'>
            </a>
          </td>";
    echo "</tr>";
}

// Đóng kết nối
$connect->close();
   
?>

    <tr>
        <td colspan="8">
            <a href="themkhachhang.php">Thêm khách hàng</a>
        </td>
    </tr>

</table>

</body>
</html>