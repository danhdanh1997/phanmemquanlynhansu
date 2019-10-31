<?php require_once('Connections/Myconnection.php'); 

?>

<?php
$table = get_param('table');
$title = get_param('title');
$column = get_param('column');
$action = get_param('action');
//Thực hiện lệnh xoá nếu chọn xoá
if ($action=="del")
{
	$ma_nv = get_param('catID');
	$ma_column = $column . "_id";
	$deleteSQL = "DELETE FROM $table WHERE $ma_column='$ma_nv'";                     
	
	  mysqli_select_db($Myconnection,$database_Myconnection);
	  $Result1 = mysqli_query($Myconnection,$deleteSQL) or die(mysqli_connect_errno());
	
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
  $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($Myconnection,$theValue) : mysqli_escape_string($theValue);

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
  $insertSQL = sprintf("INSERT INTO $table VALUES (%s, %s)",
                       GetSQLValueString($_POST['1'], "text"),
                       GetSQLValueString($_POST['2'], "text"));

  mysqli_select_db( $Myconnection,$database_Myconnection);
  $Result1 = mysqli_query( $Myconnection,$insertSQL) or die(mysqli_connect_errno());

  $insertGoTo = "them_danh_muc.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  sprintf("Location: %s", $insertGoTo);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<table width="800" border="0" cellspacing="1" cellpadding="0" align="center">
  <tr>
    <td class="row2" width="260" align="center" valign="top">
      <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="255" align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Mã <?php echo $title?> :</td>
            <td><input type="text" name="1" value="" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Tên <?php echo $title?> :</td>
            <td><input type="text" name="2" value="" size="24" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value=":|: Thêm mới :|:" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    <p>&nbsp;</p></td>
    <td class="row2" width="500" valign="top"><table width="500" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <th width="25">Stt</th>
        <th width="120">Mã <?php echo $title?></th>
        <th width="230">Tên <?php echo $title?></th>
        <th width="35">&nbsp;</th>
        <th width="35">&nbsp;</th>
      </tr>
      <?php 
	  	//mysqli_select_db($database_Myconnection, $Myconnection);
		$query_RCDanhmuc_TM = "SELECT * FROM $table";
		$RCDanhmuc_TM = mysqli_query($Myconnection,$query_RCDanhmuc_TM) or die(mysqli_connect_errno());
		//$row_RCDanhmuc_TM = mysqli_fetch_assoc($RCDanhmuc_TM);
		$totalRows_RCDanhmuc_TM = mysqli_num_rows($RCDanhmuc_TM);
	  ?>
        <?php 
		$stt =1;
		while ($row = mysqli_fetch_row($RCDanhmuc_TM)) {?>
          <tr>
            <td class="row1"><?php echo $stt;?></td>
            <td class="row1"><?php echo $row[0]; ?></td>
            <td class="row1"><?php echo $row[1]; ?></td>
            <td class="row1"><a href="index.php?require=cap_nhat_danh_muc.php&table=<?php echo $table; ?>&catID=<?php echo $row[0]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>&action=edit">Sửa</a></td>
            <td class="row1"><a href="index.php?require=them_danh_muc.php&table=<?php echo $table; ?>&catID=<?php echo $row[0]; ?>&title=<?php echo $title; ?>&column=<?php echo $column; ?>&action=del">Xoá</a></td>
          </tr>
          <?php $stt = $stt + 1; ?>
          <?php }  ?>
    </table></td>
  </tr>
</table>
<p></p>
</html>
<?php
mysqli_free_result($RCDanhmuc_TM);
?>
