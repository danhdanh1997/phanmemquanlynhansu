<?php
error_reporting(E_ALL);

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  /*tai hinh anh len
  if ($_FILES["hinh_anh"]["error"] > 0)
  {
	echo "Error: " . $_FILES["hinh_anh"]["error"] . "<br />";
	exit;
  }
  else
  	move_uploaded_file($_FILES["hinh_anh"][tmp_name],"images/" . $_FILES["hinh_anh"]["name"]);
	$luutru = "luu tru tai: " . "images/" . $_FILES["hinh_anh"]["name"];
	$hinhanh = $_FILES["hinh_anh"]["name"]; */
  $insertSQL = sprintf("INSERT INTO tlb_nhanvien (ma_nhan_vien, ho_ten, gioi_tinh, gia_dinh, dt_di_dong, dt_nha, email, ngay_sinh, noi_sinh, tinh_thanh, cmnd, ngay_cap, noi_cap, que_quan, dia_chi, tam_tru, hinh_anh) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
		get_param('ma_nhan_vien'),
		get_param('ho_ten'),
		get_param('gioi_tinh'),
		get_param('gia_dinh'),
		get_param('dt_di_dong'),
		get_param('dt_nha'),
		get_param('email'),
		get_param('ngay_sinh'),
		get_param('noi_sinh'),
		get_param('tinh_thanh'),
		get_param('cmnd'),
		get_param('ngay_cap'),
		get_param('noi_cap'),
		get_param('que_quan'),
		get_param('dia_chi'),
		get_param('tam_tru'),
		get_param('hinh_anh'));

  mysqli_select_db($Myconnection,$database_Myconnection);
  $Result1 = mysqli_query($Myconnection,$insertSQL) or die(mysqli_connect_errno());

  $insertGoTo = "danh_sach_nhan_vien.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  	//thêm mới thành công chuyển sang nhập công việc
	$ma_nv = get_param('ma_nhan_vien');
	if ($ma_nv <>"")
	{
  	$url = "index.php?require=them_moi_cong_viec.php&catID=$ma_nv&title=Thêm mới công việc";
	location($url);
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 1.4;
}
-->
</style></head>

<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table class="row2" width="800" align="center" cellpadding="2" cellspacing="2" bgcolor="#66CCFF">
    <tr valign="baseline">
      <td width="127" align="right" nowrap="nowrap">Mã nhân viên *:</td>
      <td width="227"><input type="text" name="ma_nhan_vien" value="" size="32" /></td>
      <td width="117">&nbsp;</td>
      <td width="301">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Họ và tên *</td>
      <td><input type="text" name="ho_ten" value="" size="32" /></td>
      <td>Ngày sinh:</td>
      <td><input type="text" name="ngay_sinh" value="" size="25" /> 
        (dd/mm/yyyy)</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Giới tính</td>
      <td><select name="gioi_tinh">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Nam</option>
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Nữ</option>
      </select></td>
      <td>Nơi sinh:</td>
      <td><input type="text" name="noi_sinh" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gia đình:</td>
      <td><select name="gia_dinh">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Có gia đình</option>
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Chưa có</option>
      </select></td>
      <td>Tỉnh thành:</td>
      <td><input type="text" name="tinh_thanh" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Điện thoại dd:</td>
      <td><input type="text" name="dt_di_dong" value="" size="32" /></td>
      <td>CMND:</td>
      <td><input type="text" name="cmnd" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Điện thoại nhà:</td>
      <td><input type="text" name="dt_nha" value="" size="32" /></td>
      <td>Ngày cấp:</td>
      <td><input type="text" name="ngay_cap" value="" size="25" />
      (dd/mm/yyyy)</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" value="" size="32" /></td>
      <td>Nơi cấp:</td>
      <td><input type="text" name="noi_cap" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Quê quán:</td>
      <td colspan="3"><input type="text" name="que_quan" value="" size="90" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Địa chỉ:</td>
      <td colspan="3"><input type="text" name="dia_chi" value="" size="90" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tạm trú:</td>
      <td colspan="3"><input type="text" name="tam_tru" value="" size="90" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Hình ảnh:</td>
      <td colspan="3"><input type="text" name="hinh_anh" size="60" />
      <a target="_blank" href="quan_ly_anh.php">Tìm ảnh</a></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="center" nowrap="nowrap"><input type="submit" value="Đồng ý" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>