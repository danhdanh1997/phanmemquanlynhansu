<?php
function ThemDonHang($url)
{
//Code thêm 1 dơn hàng và lấy ra id don hàng mới
if ((isset($_POST["KT_Insert1"])==false) || (isset($_POST["id_user"])==false)) return;
$tmp1 = explode('/', $_POST['ThoiDiemDatHang']);
$yyyy1 = $tmp1[0];$mm1 = $tmp1[1];$dd1 = $tmp1[2];
$tmp2 = explode('/', $_POST['ThoiDiemGiaohang']);
$yyyy2 = $tmp2[0];$mm2 = $tmp2[1];$dd2 = $tmp2[2];

$ThoiDiemDatHang = $dd1.'/'.$mm1.'/'.$yyyy1;
$ThoiDiemGiaoHang = $dd2.'/'.$mm2.'/'.$yyyy2;
$TenBang="order";

$insertSQL = sprintf("INSERT INTO $TenBang (id_user, thoidiemdathang, thoidiemgiaohang, tennguoinhan, diadiemgiaohang) VALUES (%s, %s, %s, %s, %s)", 
GetSQLValueString($_POST['id_user'], "text"),
GetSQLValueString($ThoiDiemDatHang,"text"),
GetSQLValueString($ThoiDiemGiaoHang,"text"),
GetSQLValueString($_POST['TenNguoiNhan'], "text"), 
GetSQLValueString($_POST['DiaDiemGiaoHang'], "text")
); 
mysql_query($insertSQL) or die(mysql_error()); 
$lastID =mysql_insert_id();
$_SESSION['id_order']=$lastID;	
header("Location:". $url); 
exit();	
}
?>