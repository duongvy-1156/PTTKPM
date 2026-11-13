<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="dinhdang/mystyle.css">
</head>

<body>

<form name="f" method="post" action="">

    <table class="bieumau">

        <!-- TIÊU ĐỀ -->
        <tr>
            <td colspan="3" class="canhgiua">
                <h2>PHIẾU MUA HÀNG TRẢ GÓP</h2>
            </td>
        </tr>

        <!-- THÔNG TIN SẢN PHẨM -->
        <tr>
            <td colspan="3" class="tieude">
                THÔNG TIN SẢN PHẨM
            </td>
        </tr>

        <!-- CHỌN SẢN PHẨM -->
        <tr>
            <td>Chọn sản phẩm</td>

            <td>
                <select name="optSanPham">
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "vertrigo";
                    $dbname = "qlhanghoa";

                   // Kết nối cơ sở dữ liệu
                    $connect = new mysqli(
                    $servername,
                    $username,
                    $password,
                    $dbname
                    );
					
					// Kiểm tra kết nối
                    if ($connect->connect_error) {
                   die("Không kết nối: " . $connect->connect_error);
                    }
					
					//Thực hiện câu lệnh SQL
					$sql = "SELECT * FROM mathang";
					$danhsach = $connect->query($sql);

                   // Kiểm tra câu lệnh SQL
                   if (!$danhsach) {
                   die(
                    "Không thể thực hiện câu lệnh SQL: "
                    . $connect->error
                    );
                  }
				     // Hiển thị danh sách sản phẩm
                     while ($row = $danhsach->fetch_array(MYSQLI_ASSOC)) {

                     echo "<option value=\""
                       . $row["MaHang"]
                       . "\">";

                    echo $row["TenHang"];

                    echo "</option>";
            }

            // Đóng kết nối
            $connect->close();
            ?>
        </select>
    </td>
                   

            <td>&nbsp;</td>
        </tr>

        <!-- THỜI HẠN TRẢ -->
        <tr>
            <td>Thời hạn trả</td>

            <td>
                <input
                    type="radio"
                    name="radThoiHan"
                    value="1"
                >
                6 tháng

                <input
                    type="radio"
                    name="radThoiHan"
                    value="2"
                >
                12 tháng
            </td>

            <td>&nbsp;</td>
        </tr>

        <!-- GIAO HÀNG -->
        <tr>
            <td>&nbsp;</td>

            <td>
                <input
                    type="checkbox"
                    name="chkGiaoHang"
                >
                Giao hàng tận nơi
            </td>

            <td>&nbsp;</td>
        </tr>

        <!-- THÔNG TIN KHÁCH HÀNG -->
        <tr>
            <td colspan="3" class="tieude">
                THÔNG TIN KHÁCH HÀNG
            </td>
        </tr>

        <!-- HỌ TÊN -->
        <tr>
            <td>Họ tên</td>

            <td>
                <input
                    type="text"
                    name="txtHoTen"
                    onchange="ktHoTen();"
                >
            </td>

            <td>*</td>
        </tr>

        <!-- NĂM SINH -->
        <tr>
            <td>Năm sinh</td>

            <td>
                <select name="optNamSinh">

                    <option>---Chọn---</option>

                    <script>
                        var d = new Date();
                        var namht = d.getFullYear();

                        for (var i = namht; i >= 1900; i--) {
                            document.write(
                                "<option>" + i + "</option>"
                            );
                        }
                    </script>

                </select>
            </td>

            <td>&nbsp;</td>
        </tr>

        <!-- NÚT -->
        <tr>
            <td colspan="3" class="canhgiua">

                <input
                    type="button"
                    name="btnXacNhan"
                    value="Xác nhận"
                    onclick="ktXacNhan();"
                >

                <input
                    type="reset"
                    name="btnKhong"
                    value="Không"
                >

            </td>
        </tr>

    </table>

</form>
<script>
    // Kiểm tra họ tên
    function ktHoTen() {
        var f = document.forms["f"];
        var hoten = f["txtHoTen"].value.trim();

        if (hoten == "") {
            alert("Vui lòng nhập họ tên!");
            f["txtHoTen"].focus();
            return false;
        }

        return true;
    }

    // Xử lý nút Xác nhận
    function ktXacNhan() {
        var f = document.forms["f"];

        // Kiểm tra sản phẩm
        if (f["optSanPham"].value == "") {
            alert("Vui lòng chọn sản phẩm!");
            f["optSanPham"].focus();
            return;
        }

        // Kiểm tra thời hạn trả
        if (!f["radThoiHan"][0].checked &&
            !f["radThoiHan"][1].checked) {
            alert("Vui lòng chọn thời hạn trả!");
            return;
        }

        // Kiểm tra họ tên
        if (f["txtHoTen"].value.trim() == "") {
            alert("Vui lòng nhập họ tên!");
            f["txtHoTen"].focus();
            return;
        }

        // Kiểm tra năm sinh
		if (f["optNamSinh"].value == "") {
            alert("Vui lòng chọn năm sinh!");
            f["optNamSinh"].focus();
            return;
        }

        // Lấy thông tin sản phẩm
        var sanPham =
            f["optSanPham"].options[
                f["optSanPham"].selectedIndex
            ].text;

        // Lấy thời hạn trả
        var thoiHan = f["radThoiHan"][0].checked
            ? "6 tháng"
            : "12 tháng";

        // Lấy thông tin giao hàng
        var giaoHang = f["chkGiaoHang"].checked
            ? "Có"
            : "Không";

        // Lấy thông tin khách hàng
        var hoten = f["txtHoTen"].value.trim();
        var namsinh = f["optNamSinh"].value;

        // Hiển thị thông tin xác nhận
        alert(
            "XÁC NHẬN PHIẾU MUA HÀNG TRẢ GÓP\n\n" +
            "Sản phẩm: " + sanPham + "\n" +
            "Thời hạn trả: " + thoiHan + "\n" +
            "Giao hàng tận nơi: " + giaoHang + "\n" +
            "Họ tên: " + hoten + "\n" +
            "Năm sinh: " + namsinh
        );
    }
</script>
</body>
</html>