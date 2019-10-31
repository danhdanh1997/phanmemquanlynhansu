<?php
$keyword = get_param('keyword');
mysqli_select_db($Myconnection,$database_Myconnection);
$query_RCdanh_sach = "SELECT * FROM tlb_nhanvien";
if($keyword!=''){
	$query_RCdanh_sach .= " Where ho_ten like '%".$keyword."%'";
}

$RCdanh_sach = mysqli_query( $Myconnection,$query_RCdanh_sach) or die(mysqli_error());
$row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach);
$totalRows_RCdanh_sach = mysqli_num_rows($RCdanh_sach);
?>
<div style="padding:10px; text-align:right;">
<form name="fsearch">
<input type="text" name="keyword" value="" />
<input type="submit" value="Tìm kiếm" />
</form>
</div>
<?php
if($keyword!=''){
	echo '<div id="tieude2">Kết quả tìm nhân viên có tên "'.$keyword.'"</div>';
}
?>
<table class="tablebg" border="0" width="800" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <th width="80" rowspan="2" align="center">MÃ NV</th>
    <th width="220" rowspan="2" align="center">HỌ VÀ TÊN</th>
    <th width="90" rowspan="2" align="center">ĐT DI ĐỘNG</th>
    <th width="90" rowspan="2" align="center">ĐT NHÀ</th>
    <th width="170" rowspan="2" align="center">EMAIL</th>
    <th colspan="2" align="center"> THÔNG TIN</th>
  </tr>
  <tr class="tieudeds">
    <td align="center" bgcolor="#CC0000">Nhân viên</td>
    <td align="center" bgcolor="#CC0000">Công việc</td>
  </tr>
  <?php do { ?>
    <tr class="row">
      <td class="row1" width="100" align="left"><a href="chi_tiet_nhan_vien.php?catID=<?php echo $row_RCdanh_sach['ma_nhan_vien']; ?>"><?php echo $row_RCdanh_sach['ma_nhan_vien']; ?></a></td>
      <td  class="row1" align="left"><?php echo $row_RCdanh_sach['ho_ten']; ?></td>
      <td  class="row1" align="left"><?php echo $row_RCdanh_sach['dt_di_dong']; ?></td>
      <td  class="row1" align="left"><?php echo $row_RCdanh_sach['dt_nha']; ?></td>
      <td  class="row1" align="left"><?php echo $row_RCdanh_sach['email']; ?></td>
      <td class="row1" width="113" align="left" ><a href="index.php?require=cap_nhat_thong_tin_nhan_vien.php&catID=<?php echo $row_RCdanh_sach['ma_nhan_vien']; ?>&title=Thông tin nhân viên">Xem chi tiết</a></td>
      <td class="row1" width="113" align="left" ><a href="index.php?require=cap_nhat_thong_tin_cong_viec.php&catID=<?php echo $row_RCdanh_sach['ma_nhan_vien']; ?>&title=Thông tin công việc">Xem chi tiết</a></td>
    </tr>
    <?php } while ($row_RCdanh_sach = mysqli_fetch_assoc($RCdanh_sach)); ?>
</table>
<?php
mysqli_free_result($RCdanh_sach);
?>
