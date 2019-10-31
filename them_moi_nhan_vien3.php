<?php require_once('Connections/Myconnection.php'); ?>
<?php require_once('function/function.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	//tai hinh anh len
  if ($_FILES["hinh_anh"]["error"] > 0)
  {
	echo "Error: " . $_FILES["hinh_anh"]["error"] . "<br />";
	exit;
  }
  else
  	move_uploaded_file($_FILES["hinh_anh"][tmp_name],"images/" . $_FILES["hinh_anh"]["name"]);
	$luutru = "luu tru tai: " . "images/" . $_FILES["hinh_anh"]["name"];
	$hinhanh = $_FILES["hinh_anh"]["name"];
//bat dau them
  $insertSQL = sprintf("INSERT INTO tlb_nhanvien (ma_nhan_vien, ho_ten, gioi_tinh, gia_dinh, dt_di_dong, dt_nha, email, ngay_sinh, noi_sinh, tinh_thanh, cmnd, ngay_cap, noi_cap, que_quan, dia_chi, tam_tru, hinh_anh) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"),
                       GetSQLValueString($_POST['ho_ten'], "text"),
                       GetSQLValueString($_POST['gioi_tinh'], "int"),
                       GetSQLValueString($_POST['gia_dinh'], "int"),
                       GetSQLValueString($_POST['dt_di_dong'], "text"),
                       GetSQLValueString($_POST['dt_nha'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['ngay_sinh'], "date"),
                       GetSQLValueString($_POST['noi_sinh'], "text"),
                       GetSQLValueString($_POST['tinh_thanh'], "text"),
                       GetSQLValueString($_POST['cmnd'], "text"),
                       GetSQLValueString($_POST['ngay_cap'], "date"),
                       GetSQLValueString($_POST['noi_cap'], "text"),
                       GetSQLValueString($_POST['que_quan'], "text"),
                       GetSQLValueString($_POST['dia_chi'], "text"),
                       GetSQLValueString($_POST['tam_tru'], "text"),
                       GetSQLValueString($_FILES["hinh_anh"]["name"], "text"));

  mysql_select_db($database_Myconnection, $Myconnection);
  $Result1 = mysql_query($insertSQL, $Myconnection) or die(mysql_error());

  $insertGoTo = "danh_sach_nhan_vien.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
	//lấy mã nhân viên từ text nhập vào
	$ma_nv = GetSQLValueString($_POST['ma_nhan_vien']);
	if ($ma_nv<>"")
	{
  	//thêm mới thành công chuyển sang nhập công việc
  	$url = "index.php?require=them_moi_cong_viec.php&catID=$ma_nv&title=Thêm mới công việc";
	location($url);
	}
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
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table width="800" align="center" cellpadding="2" cellspacing="2" bgcolor="#66CCFF">
    <tr valign="baseline">
      <td width="127" align="right" nowrap="nowrap">Ma_nhan_vien:</td>
      <td width="227"><input type="text" name="ma_nhan_vien" value="" size="32" /></td>
      <td width="117">&nbsp;</td>
      <td width="301">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ho_ten:</td>
      <td><input type="text" name="ho_ten" value="" size="32" /></td>
      <td>Ngay_sinh:</td>
      <td><input type="text" name="ngay_sinh" value="" size="25" /> 
        (yyyy-mm-dd)</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gioi_tinh:</td>
      <td><select name="gioi_tinh">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Nam</option>
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Nữ</option>
      </select></td>
      <td>Noi_sinh:</td>
      <td><input type="text" name="noi_sinh" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Gia_dinh:</td>
      <td><select name="gia_dinh">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Có gia đình</option>
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Chưa có</option>
      </select></td>
      <td>Tinh_thanh:</td>
      <td><input type="text" name="tinh_thanh" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Dt_di_dong:</td>
      <td><input type="text" name="dt_di_dong" value="" size="32" /></td>
      <td>Cmnd:</td>
      <td><input type="text" name="cmnd" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Dt_nha:</td>
      <td><input type="text" name="dt_nha" value="" size="32" /></td>
      <td>Ngay_cap:</td>
      <td><input type="text" name="ngay_cap" value="" size="25" />
      (yyyy-mm-dd)</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Email:</td>
      <td><input type="text" name="email" value="" size="32" /></td>
      <td>Noi_cap:</td>
      <td><input type="text" name="noi_cap" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Que_quan:</td>
      <td colspan="3"><input type="text" name="que_quan" value="" size="90" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Dia_chi:</td>
      <td colspan="3"><input type="text" name="dia_chi" value="" size="90" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tam_tru:</td>
      <td colspan="3"><input type="text" name="tam_tru" value="" size="90" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Hinh_anh:</td>
      <td colspan="3"><input type="file" name="hinh_anh" size="60" /></td>
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