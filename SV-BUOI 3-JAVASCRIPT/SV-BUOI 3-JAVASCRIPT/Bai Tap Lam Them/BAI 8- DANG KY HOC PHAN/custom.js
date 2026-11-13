function taoLop()
{
 var nam= new Date().getFullYear();
 nam= nam.toString().substr(2,2);
 for (var i=nam; i>nam-6;i--)
 {
	 document.write("<option value='DH" + i + "TH'> DH"+i+"TH</option>");
 }
}
function taoMon()
{
  var mon =[
	  "Tin hoc dai cuong",
	  "Ky thuat lap trinh",
	  "Cau truc du lieu",
	  "Co so du lieu",
	  "He thong thong tin",
	  "Web"
  ];
  for (var i=0; i<mon.length;i++)
  {
	  document.write("<option value=' "+ mon[i]+ "' >" + mon[i] +"</option>");
  }
}

// tạo các mảng
var aMSSV =[];
var aHoTen=[];
var aLop=[];
var aMon=[];
var aLoai=[];

function dangKy()
{
	var mssv =frmDK.txtMSSV.value;
	var hoTen=frmDK.txtHoTen.value;
	//kiem tra viec nhap du lieu
	if (mssv.trim()==""|| hoTen.trim()=="")
	{
		alert("MSSV hoặc Họ tên không được bỏ trống");
		return;
	}
	
	var lop=frmDK.cboLop.value;
	var mon=frmDK.cboMon.value;
	var loai =frmDK.rbtnLoai.value;
	
	// thêm thông tin vào mảng
	aMSSV.push(mssv);
	aHoTen.push(hoTen);
	aLoai.push(loai);
	aLop.push(lop);
	aMon.push(mon);
	
	document.getElementById("frmDK").reset();
	hienDanhSach();
}
function hienDanhSach()
{
	var divDS = document.getElementById("danhSach");
	var html = "<table>";
	html += "<tr>";
	html += "<th>MSSV</th>";
	html += "<th>Họ Tên</th>";
	html += "<th>Lớp</th>";
	html += "<th>Môn</th>";
	html += "<th>Loại</th>";
	html += "</tr>";


	for(var i=0; i < aMSSV.length; i++)
	{
		html += "<tr>";
		html += "<td>" + aMSSV[i] + "</td>";
		html += "<td>" + aHoTen[i] + "</td>";
		html += "<td>" + aLop[i] + "</td>";
		html += "<td>" + aMon[i] + "</td>";
		html += "<td>" + aLoai[i] + "</td>";
		html += "</tr>";
	}

	html += "</table>";
	divDS.innerHTML = html;
}