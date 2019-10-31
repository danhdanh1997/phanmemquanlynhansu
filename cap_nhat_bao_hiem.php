<?php require_once('Connections/Myconnection.php'); ?>
<?php
$ma_nv = $_GET['catID'];
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tlb_baohiem SET so_bhxh=%s, ngay_cap_bhxh=%s, noi_cap_bhxh=%s, so_bhyt=%s, ngay_cap_bhyt=%s, noi_cap_bhyt=%s WHERE ma_nhan_vien=%s",
                       GetSQLValueString($_POST['so_bhxh'], "text"),
                       GetSQLValueString($_POST['ngay_cap_bhxh'], "text"),
                       GetSQLValueString($_POST['noi_cap_bhxh'], "text"),
                       GetSQLValueString($_POST['so_bhyt'], "text"),
                       GetSQLValueString($_POST['ngay_cap_bhyt'], "text"),
                       GetSQLValueString($_POST['noi_cap_bhyt'], "text"),
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"));

  mysql_select_db($database_Myconnection, $Myconnection);
  $Result1 = mysql_query($updateSQL, $Myconnection) or die(mysql_error());

  $updateGoTo = "them_moi_bao_hiem.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  sprintf("Location: %s", $updateGoTo);
}

mysql_select_db($database_Myconnection, $Myconnection);
$query_RCBaohiem_DS = "SELECT * FROM tlb_baohiem";
$RCBaohiem_DS = mysql_query($query_RCBaohiem_DS, $Myconnection) or die(mysql_error());
$row_RCBaohiem_DS = mysql_fetch_assoc($RCBaohiem_DS);
$totalRows_RCBaohiem_DS = mysql_num_rows($RCBaohiem_DS);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<table class="row6" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="20%"><a href="index.php?require=them_moi_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&title=Quan hệ gia đình">Quan hệ gia đình</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_qua_trinh_cong_tac.php&catID=<?php echo $ma_nv; ?>&title=Quá trình công tác">Quá trình công tác</a></td>
          <td width="19%" align="center"><a href="index.php?require=them_moi_qua_trinh_luong.php&catID=<?php echo $ma_nv; ?>&title=Quá trình lương">Quá trình lương</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_hop_dong.php&catID=<?php echo $ma_nv; ?>&title=Hợp đồng">Hợp đồng</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_bao_hiem.php&catID=<?php echo $ma_nv; ?>&title=Bảo hiểm">Bảo hiểm</a></td>
        </tr>
      </table>
<table class="row2" width="800" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <th width="100">Số sổ BHXH</th>
    <th width="66">Ngày cấp</th>
    <th width="109">Nơi cấp</th>
    <th width="100">Số sổ BHYT</th>
    <th width="83">Ngày cấp</th>
    <th width="109">Nơi cấp</th>
    <th width="35">&nbsp;</th>
    <th width="35">&nbsp;</th>
  </tr>
  <tr class="row">
    <td class="row1"><?php echo $row_RCBaohiem_DS['so_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_DS['ngay_cap_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_DS['noi_cap_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_DS['so_bhyt']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_DS['ngay_cap_bhyt']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_DS['noi_cap_bhyt']; ?></td>
    <td class="row1">&nbsp;</td>
    <td class="row1">Xoá</td>
  </tr>
</table>
<?php
mysql_free_result($RCBaohiem_DS);
?>
<p></p>
<?php
mysql_select_db($database_Myconnection, $Myconnection);
$query_RCBaohiem_CN = "SELECT * FROM tlb_baohiem inner join tlb_nhanvien on tlb_baohiem.ma_nhan_vien = tlb_nhanvien.ma_nhan_vien where tlb_baohiem.ma_nhan_vien = '$ma_nv'";
$RCBaohiem_CN = mysql_query($query_RCBaohiem_CN, $Myconnection) or die(mysql_error());
$row_RCBaohiem_CN = mysql_fetch_assoc($RCBaohiem_CN);
$totalRows_RCBaohiem_CN = mysql_num_rows($RCBaohiem_CN);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="row2" width="800" align="center" cellpadding="3" cellspacing="3" bgcolor="#66CCFF">
    <tr valign="baseline">
      <td width="133" align="right" nowrap="nowrap">Mã nhân viên:</td>
      <td width="237"><?php echo $row_RCBaohiem_CN['ma_nhan_vien']; ?></td>
      <td width="120">Họ và tên:</td>
      <td width="269"><?php echo $row_RCBaohiem_CN['ho_ten']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Số sổ BHXH:</td>
      <td><input type="text" name="so_bhxh" value="<?php echo htmlentities($row_RCBaohiem_CN['so_bhxh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>Số sổ BHYT:</td>
      <td><input type="text" name="so_bhyt" value="<?php echo htmlentities($row_RCBaohiem_CN['so_bhyt'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ngày cấp BHXH:</td>
      <td><input type="text" name="ngay_cap_bhxh" value="<?php $sqldate = strtotime($row_RCBaohiem_CN['ngay_cap_bhxh']); $date = date('d-m-Y', $sqldate);echo $date;?>" size="32" /></td>
      <td>Ngày cấp BHYT:</td>
      <td><input type="text" name="ngay_cap_bhyt" value="<?php $sqldate2 = strtotime($row_RCBaohiem_CN['ngay_cap_bhyt']); $date2 = date('d-m-Y', $sqldate2);echo $date2; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nơi cấp BHXH:</td>
      <td><input type="text" name="noi_cap_bhxh" value="<?php echo htmlentities($row_RCBaohiem_CN['noi_cap_bhxh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>Nơi cấp BHYT:</td>
      <td><input type="text" name="noi_cap_bhyt" value="<?php echo htmlentities($row_RCBaohiem_CN['noi_cap_bhyt'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="center" nowrap="nowrap"><input type="submit" value=":|: Cập nhật :|:" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="ma_nhan_vien" value="<?php echo $row_RCBaohiem_CN['ma_nhan_vien']; ?>" />
</form>
<p></p>
</body>
</html>
<?php
mysql_free_result($RCBaohiem_CN);
?>
