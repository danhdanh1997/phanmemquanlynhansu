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
  $insertSQL = sprintf("INSERT INTO tlb_congviec (ma_nhan_vien, ngay_vao_lam, phong_ban_id, cong_viec_id, muc_luong_cb, he_so, phu_cap, so_sld, ngay_cap, noi_cap, tknh, ngan_hang, hoc_van_id, bang_cap_id, ngoai_ngu_id, tin_hoc_id, dan_toc_id, quoc_tich_id, ton_giao_id, tinh_thanh_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"),
                       GetSQLValueString($_POST['ngay_vao_lam'], "date"),
                       GetSQLValueString($_POST['phong_ban_id'], "text"),
                       GetSQLValueString($_POST['cong_viec_id'], "text"),
                       GetSQLValueString($_POST['muc_luong_cb'], "text"),
                       GetSQLValueString($_POST['he_so'], "text"),
                       GetSQLValueString($_POST['phu_cap'], "text"),
                       GetSQLValueString($_POST['so_sld'], "text"),
                       GetSQLValueString($_POST['ngay_cap'], "date"),
                       GetSQLValueString($_POST['noi_cap'], "text"),
                       GetSQLValueString($_POST['tknh'], "text"),
                       GetSQLValueString($_POST['ngan_hang'], "text"),
                       GetSQLValueString($_POST['hoc_van_id'], "text"),
                       GetSQLValueString($_POST['bang_cap_id'], "text"),
                       GetSQLValueString($_POST['ngoai_ngu_id'], "text"),
                       GetSQLValueString($_POST['tin_hoc_id'], "text"),
                       GetSQLValueString($_POST['dan_toc_id'], "text"),
                       GetSQLValueString($_POST['quoc_tich_id'], "text"),
                       GetSQLValueString($_POST['ton_giao_id'], "text"),
                       GetSQLValueString($_POST['tinh_thanh_id'], "text"));

  mysql_select_db($database_Myconnection, $Myconnection);
  $Result1 = mysql_query($insertSQL, $Myconnection) or die(mysql_error());
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
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ma_nhan_vien:</td>
      <td><input type="text" name="ma_nhan_vien" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ngay_vao_lam:</td>
      <td><input type="text" name="ngay_vao_lam" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phong_ban_id:</td>
      <td><input type="text" name="phong_ban_id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Cong_viec_id:</td>
      <td><input type="text" name="cong_viec_id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Muc_luong_cb:</td>
      <td><input type="text" name="muc_luong_cb" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">He_so:</td>
      <td><input type="text" name="he_so" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Phu_cap:</td>
      <td><input type="text" name="phu_cap" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">So_sld:</td>
      <td><input type="text" name="so_sld" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ngay_cap:</td>
      <td><input type="text" name="ngay_cap" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Noi_cap:</td>
      <td><input type="text" name="noi_cap" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tknh:</td>
      <td><input type="text" name="tknh" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ngan_hang:</td>
      <td><input type="text" name="ngan_hang" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Hoc_van_id:</td>
      <td><input type="text" name="hoc_van_id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Bang_cap_id:</td>
      <td><input type="text" name="bang_cap_id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ngoai_ngu_id:</td>
      <td><input type="text" name="ngoai_ngu_id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tin_hoc_id:</td>
      <td><input type="text" name="tin_hoc_id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Dan_toc_id:</td>
      <td><input type="text" name="dan_toc_id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Quoc_tich_id:</td>
      <td><input type="text" name="quoc_tich_id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ton_giao_id:</td>
      <td><input type="text" name="ton_giao_id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tinh_thanh_id:</td>
      <td><input type="text" name="tinh_thanh_id" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>