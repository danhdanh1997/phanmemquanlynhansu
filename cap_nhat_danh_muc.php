<?php require_once('Connections/Myconnection.php'); ?>
<?php
$table = get_param('table');
$title = get_param('title');
$ma_nv = get_param('catID');
$column = get_param('column');
$ma_column = $column . "id";
$ten_column = "ten_dang_nhap" . $column;
$action = get_param('action');
//Thực hiện lệnh xoá nếu chọn xoá
if ($action=="del")
{
	$ma_nv = $_GET['catID'];
	$ma_column = $column . "id";
	$deleteSQL = "DELETE FROM $table WHERE $ma_column='$ma_nv'";                     
	
	  mysqli_select_db($Myconnection,$database_Myconnection);
	  $Result1 = mysqli_query($deleteSQL, $Myconnection) or die(mysqli_connect_errno());
	
	  $deleteGoTo = "them_danh_muc.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
		$deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
		$deleteGoTo .= $_SERVER['QUERY_STRING'];
	  }
	  sprintf("Location: %s", $deleteGoTo);
}
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }
  $hostname_Myconnection = "localhost";
  $database_Myconnection = "quanlynhansu";
  $username_Myconnection = "root";
  $password_Myconnection = "";
$Myconnection = mysqli_connect($hostname_Myconnection, $username_Myconnection, $password_Myconnection) or trigger_error(mysqli_connect_errno(),E_USER_ERROR);

  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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
  $updateSQL = sprintf("UPDATE $table SET $ten_column=%s WHERE $ma_column=%s",
                       GetSQLValueString($_POST['2'], "text"),
                       GetSQLValueString($_POST['1'], "text"));

  mysqli_select_db($Myconnection,$database_Myconnection);
  $Result1 = mysqli_query($Myconnection,$updateSQL) or die(mysqli_error());

  $updateGoTo = "them_danh_muc.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
 	sprintf("Location: %s", $updateGoTo);
}
mysqli_select_db($Myconnection,$database_Myconnection);
$query_RCDanhmuc_DS = "SELECT * FROM $table";
$RCDanhmuc_DS = mysqli_query($Myconnection,$query_RCDanhmuc_DS) or die(mysqli_error());
$row_RCDanhmuc_DS = mysqli_fetch_assoc($RCDanhmuc_DS);
$totalRows_RCDanhmuc_DS = mysqli_num_rows($RCDanhmuc_DS);
?>
<table width="800" border="0" cellspacing="1" cellpadding="0" align="center">
  <tr>
    <td class="row2" width="500" valign="top"><table width="500" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <th width="25">Stt</th>
        <th width="100">Mã <?php echo $title?></th>
        <th width="210">Tên <?php echo $title?></th>
        <th width="35">&nbsp;</th>
        <th width="35">&nbsp;</th>
        <th width="35">&nbsp;</th>
      </tr>
      <?php 
	  $stt = 1;
	  do { ?>
        <tr>
          <td class="row1"><?php echo $stt; ?></td>
          <td class="row1"><?php echo $row_RCDanhmuc_DS[$ma_column]; ?></td>
          <td class="row1"><?php echo $row_RCDanhmuc_DS[$ten_column]; ?></td>
          <td class="row1"><a href="index.php?require=them_danh_muc.php&table=<?php echo $table; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>&action=new">Thêm</a></td>
          <td class="row1"><a href="index.php?require=cap_nhat_danh_muc.php&table=<?php echo $table; ?>&catID=<?php echo $row_RCDanhmuc_DS[$ma_column]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>">Sửa</a></td>
          <td class="row1"><a href="index.php?require=cap_nhat_danh_muc.php&table=<?php echo $table; ?>&catID=<?php echo $row_RCDanhmuc_DS[$ma_column]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>&action=del">Xoá</a></td>
        </tr>
        <?php $stt = $stt + 1; ?>
        <?php } while ($row_RCDanhmuc_DS = mysqli_fetch_assoc($RCDanhmuc_DS)); ?>
    </table></td>
    <td class="row2" width="260" align="center" valign="top">
    <?php 
	  mysqli_select_db($Myconnection,$database_Myconnection);
		$query_RCDanhmuc_CN = "SELECT * FROM $table where $ma_column = '$ma_nv'";
		$RCDanhmuc_CN = mysqli_query($Myconnection,$query_RCDanhmuc_CN) or die(mysqli_connect_errno());
		$row_RCDanhmuc_CN = mysqli_fetch_assoc($RCDanhmuc_CN);
		$totalRows_RCDanhmuc_CN = mysqli_num_rows($RCDanhmuc_CN);
	?>
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="260" align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Mã <?php echo $title?> :</td>
            <td><input type="text" name="1" value="<?php echo $row_RCDanhmuc_CN[$ma_column]; ?>" readonly="readonly" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Tên <?php echo $title?> :</td>
            <td><input type="text" name="2" value="<?php echo $row_RCDanhmuc_CN[$ten_column]; ?>" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value=":|: Cập nhật :|:" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
      </form>
    </td>
  </tr>
</table>
<?php
mysqli_free_result($RCDanhmuc_CN);
mysqli_free_result($RCDanhmuc_DS);
?>
