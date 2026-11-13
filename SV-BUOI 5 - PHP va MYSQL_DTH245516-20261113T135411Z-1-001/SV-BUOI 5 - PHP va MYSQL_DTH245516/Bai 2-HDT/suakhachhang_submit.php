<?php
include_once "cauhinh.php";

// Lấy dữ liệu từ FORM
$MaKH = $_POST['MaKH'];
$HoTen = $_POST['HoTen'];
$NamSinh = $_POST['NamSinh'];
$GioiTinh = $_POST['GioiTinh'];
$DiemMuaHang = $_POST['DiemMuaHang'];
$GhiChu = $_POST['GhiChu'];

// Kiểm tra
if (trim($HoTen) == "") {
    echo "Họ tên không được bỏ trống!";
}
elseif (trim($NamSinh) == "" || !is_numeric($NamSinh)) {
    echo "Năm sinh không được bỏ trống và phải là số!";
}
elseif (trim($DiemMuaHang) == "" || !is_numeric($DiemMuaHang)) {
    echo "Điểm mua hàng không được bỏ trống và phải là số!";
}
else {
    // Cập nhật
    $sql = "UPDATE `khachhang`
            SET `HoVaTen` = '$HoTen',
                `NamSinh` = '$NamSinh',
                `GioiTinh` = '$GioiTinh',
                `DiemMuaHang` = '$DiemMuaHang',
                `GhiChu` = '$GhiChu'
            WHERE `MaKH` = '$MaKH'";

    if ($connect->query($sql) === TRUE) {
        // Chuyển hướng về danh sách khách hàng
        header("Location: danhsachkhachhang.php");
        exit();
    }
    else {
        echo "Lỗi: " . $sql . "<br>" . $connect->error;
    }

    // Đóng database
    $connect->close();
}

?>