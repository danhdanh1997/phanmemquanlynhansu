<?php
require_once('include/function.php');
require_once('Connections/Myconnection.php');

$submit = get_param('submit');
if($submit<>""){
	$ten_dang_nhap=get_param('ten_dang_nhap');
	$mat_khau=md5(get_param('mat_khau'));
	mysqli_select_db($Myconnection,$database_Myconnection );
	$query_RCNguoidung = "SELECT * FROM tlb_nguoidung WHERE ten_dang_nhap = '".$ten_dang_nhap."' AND mat_khau = '".$mat_khau."'";
	$RCNguoidung = mysqli_query($Myconnection,$query_RCNguoidung) or die(mysqli_error());
	$row_RCNguoidung = mysqli_fetch_assoc($RCNguoidung);
	$totalRows_RCNguoidung = mysqli_num_rows($RCNguoidung);
	mysqli_free_result($RCNguoidung);
	//nếu đăng nhập thành công
	if ($totalRows_RCNguoidung<>0)
	{
		$_SESSION['logged-in'] = true;
		$_SESSION['user_name'] = $ten_dang_nhap;
		$_SESSION['quyen_them'] = true;
		$_SESSION['quyen_sua'] = true;
		$_SESSION['quyen_xoa'] = true;
		echo "Đăng nhập thành công";
		$url = "index.php?require=danh_sach_nhan_vien.php&title=Danh sách nhân viên";
		location($url);
		exit;
	}
	else{
		echo "<center>Đăng nhập thất bại!</center>";
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý nhân sự</title>
<body style="margin-top:100px;">
<form action="dang_nhap.php" method="post" name="form1" id="form1">
<div style="border:#F00 solid 1px; width:300px; margin:auto">
<div style="background:#F00; color:#FFF; text-align:center; padding: 5px 0px 5px 0px"><strong>Đăng nhập hệ thống</strong></div>
        <table width="255" align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Tên đăng nhập:</td>
            <td><input type="text" name="ten_dang_nhap" value="" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Mật khẩu:</td>
            <td><input type="password" name="mat_khau" value="" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input name="submit" type="submit" value="Đăng nhập" /></td>
          </tr>
        </table>
</div>
</form>
</body>