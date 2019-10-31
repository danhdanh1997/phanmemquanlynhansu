<?php 
require_once('include/function.php');
require_once('Connections/Myconnection.php');
if ( !isset($_SESSION['logged-in']) || $_SESSION['logged-in'] !== true) {
	header('Location: dang_nhap.php');
	exit;
}
$title = get_param('title');
if ($title == "") $title = 'Danh sách nhân viên';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý cán bộ</title>
<link rel="stylesheet" type="text/css" href="js/superfish/css/superfish.css" media="screen">
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/superfish/js/hoverIntent.js"></script>
<script type="text/javascript" src="js/superfish/js/superfish.js"></script>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	jQuery(function(){
		jQuery('ul.sf-menu').superfish();
	});
</script>
</head>

<body>
<div id="topbar">
<div class="wrapper">
<ul class="sf-menu">
	<li class="current">
		<a href="#a">Hệ thống</a>
		<ul>
        <li><a href="index.php?require=them_nguoi_dung.php&title=Người dùng">Người dùng</a></li>
		<li><a href="dang_nhap.php">Đăng nhập</a></li>
		<li class="current"><a href="dang_xuat.php">Đăng xuất</a></li>
		</ul>
	</li>
	<li><a href="#">Chức năng</a>
    <ul>
    	<li><a href="#">Nhân viên</a>
        	<ul>
            	<li><a href="index.php?require=them_moi_nhan_vien.php&title=Thêm mới nhân viên">Thêm mới nhân viên</a></li>
                <li><a href="index.php?require=danh_sach_nhan_vien.php&title=Danh sách nhân viên">Danh sách nhân viên</a></li>
                <li><a href="index.php?require=danh_sach_nhan_vien_nghi.php&title=Danh sách nghỉ việc">Danh sách nghỉ việc</a></li>
            </ul>
        </li>
    	<li><a href="#">Báo cáo</a></li>
    </ul>
    </li>
	<li><a href="#">Quản lý</a>
		<ul>
			<li><a href="index.php?require=them_danh_muc.php&table=tlb_phongban&title=Phòng ban&column=phong_ban&action=new">Phòng ban</a></li>
			<li><a href="index.php?require=them_danh_muc.php&table=tlb_ctcongviec&title=Công việc&column=cong_viec&action=new">Công việc</a></li>
            <li><a href="index.php?require=them_danh_muc.php&table=tlb_chucvu&title=Chức vụ&column=chuc_vu&action=new">Chức vụ</a></li>
            <li><a href="index.php?require=them_danh_muc.php&table=tlb_hocvan&title=Học vấn&column=hoc_van&action=new">Học vấn</a></li>
            <li><a href="index.php?require=them_danh_muc.php&table=tlb_bangcap&title=Bằng cấp&column=bang_cap&action=new">Bằng cấp</a></li>
            <li><a href="index.php?require=them_danh_muc.php&table=tlb_ngoaingu&title=Ngoại ngữ&column=ngoai_ngu&action=new">Ngoại ngữ</a></li>
            <li><a href="index.php?require=them_danh_muc.php&table=tlb_tinhoc&title=Tin học&column=tin_hoc&action=new">Tin học</a></li>
            <li><a href="index.php?require=them_danh_muc.php&table=tlb_dantoc&title=Dân tộc&column=dan_toc&action=new">Dân tộc</a></li>
      		<li><a href="index.php?require=them_danh_muc.php&table=tlb_quoctich&title=Quốc tịch&column=quoc_tich&action=new">Quốc tịch</a></li>
      		<li><a href="index.php?require=them_danh_muc.php&table=tlb_tongiao&title=Tôn giáo&column=ton_giao&action=new">Tôn giáo</a></li>
            <li><a href="index.php?require=them_danh_muc.php&table=tlb_tinhthanh&title=Tỉnh thành&column=tinh_thanh&action=new">Tỉnh thành</a></li>
		</ul>
     </li>
     <li><a href="#">Công cụ</a>
     	<ul><li><a href="module/backup/backup.php?login=root&pass=vertrigo">Sao lưu</a></li></ul>
     </li>     
</ul>
<span class="hello"><strong><?php echo $_SESSION['user_name'] . ", " .Date("l F d, Y"); ?></strong></span>
</div>
</div>
<div class="top_space"></div>
<div class="wrapper">
<table align="center" width="980" border="0" cellspacing="0" cellpadding="0">
  <tr><td colspan="2"><img width="978" src="images/banner.png" /></td></tr>
  <tr>
    <td class="row4" width="170" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="10">
      <tr>
        <td class="row3"><a href="index.php">Trang chủ</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_nguoi_dung.php&title=Người dùng">Người dùng</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=danh_sach_nhan_vien_nghi.php&title=Danh sách nghỉ việc">Danh sách nghỉ việc</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_moi_nhan_vien.php&title=Thêm mới nhân viên">Thêm mới nhân viên</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_phongban&title=Phòng ban&column=phong_ban&action=new">Phòng ban</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_ctcongviec&title=Công việc&column=cong_viec&action=new">Công việc</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_chucvu&title=Chức vụ&column=chuc_vu&action=new">Chức vụ</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_hocvan&title=Học vấn&column=hoc_van&action=new">Học vấn</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_bangcap&title=Bằng cấp&column=bang_cap&action=new">Bằng cấp</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_ngoaingu&title=Ngoại ngữ&column=ngoai_ngu&action=new">Ngoại ngữ</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_tinhoc&title=Tin học&column=tin_hoc&action=new">Tin học</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_dantoc&title=Dân tộc&column=dan_toc&action=new">Dân tộc</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_quoctich&title=Quốc tịch&column=quoc_tich&action=new">Quốc tịch</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_tongiao&title=Tôn giáo&column=ton_giao&action=new">Tôn giáo</a></td>
      </tr>
      <tr>
        <td class="row3"><a href="index.php?require=them_danh_muc.php&table=tlb_tinhthanh&title=Tỉnh thành&column=tinh_thanh&action=new">Tỉnh thành</a></td>
      </tr>
    </table></td>
    <td width="797" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td><div id="tieude2"><?php echo $title; ?></div></td>
         </tr>
         <tr>
           <td><?php
        	$require = get_param('require');
			if($require ==""){$require = "danh_sach_nhan_vien.php";}
        	require_once $require; ?>
          </td>
         </tr>
	</table>
	</td></tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table class="footer" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>TRƯỜNG ĐẠI HỌC KHOA HỌC TỰ NHIÊN - ĐHQGHN</td>
      </tr>
      <tr>
        <td>334 Nguyễn Trãi - Thanh Xuân - Hà Nội</td>
      </tr>
      <tr>
        <td>COPYRIGHT 2011 BY NHÓM 11 - K55A2</td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
</body>
</html>
