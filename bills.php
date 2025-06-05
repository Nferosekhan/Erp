<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE
$sqlismainaccessfields=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
$sqlismainaccessfields->bind_param("i", $companymainid);
$sqlismainaccessfields->execute();
$sqlismainaccessfield = $sqlismainaccessfields->get_result();
while($infomainaccessfield=$sqlismainaccessfield->fetch_array()){
	$coltypemodule = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
	$ansmodules = $infomainaccessfield[24];
	$modulecolumns = explode(',',$ansmodules);
}
$sqlismainaccessfield->close();
$sqlismainaccessfields->close();
//FOR CHECK THE THIS FILES PREFERENCE FIELDS ARE ON OR OFF
$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
$sqlismainaccessusers->bind_param("i", $companymainid);
$sqlismainaccessusers->execute();
$sqlismainaccessuser = $sqlismainaccessusers->get_result();
$infomainaccessuser=$sqlismainaccessuser->fetch_array();
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
	header('Location:dashboard.php');
}
//FOR CHECK THE THIS FILES ACCESSES ARE ALLOW OR NOT

$typesforlisting = "";
$nameshowinglisting = "All";
if ($infomainaccessuser['filtertypesforlistsorting']=='All') {
  $typesforlisting = "";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Paid'){
  $typesforlisting = "AND paidstatus='1' AND cancelstatus='0'";
  $nameshowinglisting = "Paid";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Pending'){
  $typesforlisting = "AND paidstatus='0' AND cancelstatus='0'";
  $nameshowinglisting = "Pending";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Partially Paid'){
  $typesforlisting = "AND paidstatus='2' AND cancelstatus='0'";
  $nameshowinglisting = "Partially Paid";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Void'){
  $typesforlisting = "AND cancelstatus='1'";
  $nameshowinglisting = "Void";
}

$sqlprefer=$con->prepare("SELECT * FROM paircontrols WHERE (username = ? OR usernewname = ?)");
$sqlprefer->bind_param("ss", $_SESSION['unqwerty'],$_SESSION['unqwerty']);
$sqlprefer->execute();
$resultprefer = $sqlprefer->get_result();
$sidebarprefer=$resultprefer->fetch_array();
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
	header('location:dashboard.php');
}
//FOR CHECK THE THIS FILES BACKENDS CONTROL ACCESSES ARE ON OR OFF
$dateformats=$con->prepare("SELECT * FROM paricountry");
$dateformats->execute();
$dateformat = $dateformats->get_result();
$datefetch=$dateformat->fetch_array();
if ($datefetch['date']=='DD/MM/YYYY') {
	$date = 'd/m/Y';
}
//FOR DATE FORMAT
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="shortcut icon" href="favicon.ico"> 
	<!-- FontAwesome JS-->
	<script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
	<!-- App CSS -->  
	<link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
	<script type="text/javascript" src="https://unpkg.com/react@18/umd/react.development.js"></script>
	<script type="text/javascript" src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
	<script type="text/javascript" src="https://unpkg.com/dayjs@1/dayjs.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/antd@5.11.0/dist/antd-with-locales.js"></script>
	<script type="text/javascript" src="https://unpkg.com/@ant-design/icons/dist/index.umd.js"></script>
	<script type="text/javascript" src="https://unpkg.com/react-router-dom/dist/umd/react-router-dom.production.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/react-router/dist/umd/react-router.production.min.js"></script>
<?php
	include('externals.php');
?>
	<title>
		<?= $infomainaccessuser['modulename'] ?>
	</title>
        <script type="text/javascript">
          function checkscrolltouch() {
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrow').style.visibility = 'hidden';
            document.getElementById('leftarrow').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrow').style.visibility = 'visible';
            document.getElementById('rightarrow').style.visibility = 'visible';
          }
            }
          }
          function leftarrow() {
            document.getElementById('nav-tab').scrollLeft += -90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrow() {
            document.getElementById('nav-tab').scrollLeft += 90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrow').style.visibility = 'hidden';
            }
            document.getElementById('leftarrow').style.visibility = 'visible';
          }
        </script>
        <script type="text/javascript">   
$(document).ready(function() {
function isOverflown(element) {
return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
var el = document.getElementById("nav-tab");
isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
window.onresize = function (event) {
applyOrientation();
}         
function applyOrientation() {
function isOverflown(element) {
return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
var el = document.getElementById("nav-tab");
isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
}
});
</script>
        <style type="text/css">

#dropdownMenuButton111check .nav-link.active{
  background-color: #1BBC9B !important;
}

#dropdownMenuButton111check .nav-link:hover{
  background-color: #1BBC9B !important;
}

        #nav-tab::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#nav-tab::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#nav-tab::-webkit-scrollbar-track {
  background-color: green;
}

#nav-tab::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#nav-tab::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
.nav-tabs button{
    margin-bottom: 2px !important;
}
.nav-tabs .customcont-header{
    border-bottom: 0px !important;
}

@media screen and (max-width: 560px){
  #arrowsalltabs{
    visibility: visible !important;
  }
}
@media screen and (min-device-width: 561px) and (max-device-width: 3000px){
  #arrowsalltabs{
    visibility: hidden !important;
  }
</style>
</head>
<body class="g-sidenav-show" style="background-color:#F1F2F6">
<?php
	// sidebar
	include('sidebar.php');
?>
<main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
<?php 
	// navbar
	include('navhead.php');
?>
	<div class="container-fluid py-4 bg-body">
	<?php
		// notifications
		if(isset($_GET['remarks'])){
	?>
		<div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -50px;border-radius: 0px !important;">
			<button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button>
			<p style="position: relative;top: -10px;color: white !important;background-color: #53b05a !important;">
				<i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks']?>
			</p>
		</div>
	<?php
		}
		if(isset($_GET['error'])){
	?>
		<div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -50px;border-radius: 0px !important;">
			<button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button>
			<p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
				<i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?>
			</p>
		</div>
	<?php
		}
		$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
      $sqlismainaccessusers->bind_param("i", $userid);
      $sqlismainaccessusers->execute();
      $sqlismainaccessuser = $sqlismainaccessusers->get_result();
      $infomainaccessuser=$sqlismainaccessuser->fetch_array();
      //FOR MODULE NAME
		$sqlismainaccessvendors=$con->prepare("SELECT * FROM pairmainaccess WHERE (userid=? AND createdid='0') AND moduletype='Vendors' ORDER BY id ASC");
      $sqlismainaccessvendors->bind_param("i", $companymainid);
      $sqlismainaccessvendors->execute();
      $sqlismainaccessvendor = $sqlismainaccessvendors->get_result();
      $infomainaccessvendor=$sqlismainaccessvendor->fetch_array();
      //FOR VENDOR MODULE NAME
	?>
		<div style="max-width: 1650px;">
			<div class="row min-height-480">
				<div class="col-12">
					<div class="card mb-4 mt-5">
						<div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
							<div class="row">
								<div class="col-lg-6"> 
                    <div class="app-utility-item app-user-dropdown dropdown">
                      <a class="p-0 mac" id="dropdownMenuButton111" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-caret-down" style="color: #3c3c46 !important;position: relative;font-size: 18px;"></i></a>
                      <div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownMenuButton111" style="max-height: 0px;max-width: 0px;">
                        <div style="background-color: #3c3c46;margin-top: -39px !important;position: relative !important;left: 145px !important;" id="dropdownMenuButton111check">
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='All')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('All')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> All</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Paid')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Paid')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Paid</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Pending')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Pending')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Pending</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Partially Paid')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Partially Paid')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Partially Paid</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Void')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Void')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Void</span>
                          </a>
                        </div>
                      </div>
                    </div>
									<p class="mb-5" style="color:black;font-size:20px;margin-top: -28px;margin-left: 18px;">
										<?= $infomainaccessuser['modulename'] ?> </p>
									<!-- </p> -->
								</div>
								<div class="col-lg-3" style="margin-bottom: 57px !important;"> 
									<input class="form-control" id="billsearch" type="text" placeholder="Search.." style="height:24px;">
								</div> 
							</div>
						<?php
							$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Bills' ORDER BY id ASC");
      					$sqlismainaccessusers->bind_param("i", $userid);
      					$sqlismainaccessusers->execute();
      					$sqlismainaccessuser = $sqlismainaccessusers->get_result();
      					$infomainaccessuser=$sqlismainaccessuser->fetch_array();
							if (($infomainaccessuser['useraccesscreate']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
						?>
							<div align="right" class=" p-2 addandmenuonlyforimports" style="margin-bottom: -30px;">
								<div class="row" style="width:250px;">           
									<div class="col-8">  
										<a href="billadd.php" class="btn btn-custom btn-sm p-2 add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: -151px;margin-right:-39px;padding-right: 5px;">
											<p style="width: max-content;margin-top:-7px;margin-left: -3px;padding: 0px;margin-right: -3px;">
												<i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; 
												<span style="margin-left: -5px;width: max-content;">
													New <?= $infomainaccessuser['modulename'] ?>
												</span>
											</p>
										</a>   
									</div>
									<div class="col-4">
										<div class="dropdown" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: -90px;margin-right:-18px;padding: 0.2rem 0.75rem;">
											<button class="btn btn-sm btn-custom-grey dropdown-toggle addmenu" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="height:24px;">
												<i class="fa fa-bars" style="position: relative;top:-4.5px;"></i>
											</button>
										<?php
											if ((in_array('Import', $modulecolumns))) {
										?>
											<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
												<li>
													<a class="dropdown-item" href="billimport.php">
														<i class="fa fa-download"></i>
														<?= $infomainaccessuser['modulename'] ?> Import
													</a>
												</li>
											</ul>
										<?php
											}
										?>
										</div>              
									</div>  
								</div>
							</div> 
						<?php
							}
							$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE franchiseid=? AND moduletype='Bills' ORDER BY id ASC");
      					$sqlismainaccessusers->bind_param("i", $_SESSION['franchisesession']);
      					$sqlismainaccessusers->execute();
      					$sqlismainaccessuser = $sqlismainaccessusers->get_result();
      					$infomainaccessuser=$sqlismainaccessuser->fetch_array();
      					//FOR GET MODULE NAME OF BILL
							if($infomainaccessuser['moduleno']!='1'){
						?>
							<div class="alert alert-danger mt-2 text-white">
								Sorry! <?= $infomainaccessuser['modulename'] ?> Generation is Allowed for this Franchise
							</div>
						<?php
							}
							else{
						?>	
<div style="visibility: visible;" id="arrowsalltabs">
      <svg id="rightarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 60px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;visibility: hidden;">
         <path d="M0 0h24v24H0z" fill="none"></path>
         <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
      </svg>
      <svg id="leftarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 60px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
         <path d="M0 0h24v24H0z" fill="none"></path>
         <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
      </svg>
   </div>
   <div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="position: relative;top: -100px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
      <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true" style="background-color: transparent !important;">
         <div class="customcont-header ml-0">
            <a class="customcont-heading"><?=$nameshowinglisting?> <?=$infomainaccessuser['modulename']?></a>
         </div>
      </button>
   </div>
   <div class="tab-content" id="nav-tabContent" style="position:relative;top: -88px;">
      <div class="tab-pane fade show active p-3" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
							<div class="table-responsive p-0 min-height-480">
								<table id="someTable" class="table table-bordered align-items-center mb-0" style="table-layout: fixed;">
									<thead>
										<tr>
										<?php
											if ((in_array('Date', $modulecolumns))) {
										?>
											<td class="text-uppercase" style="width:9%;">
												<span style="font-size:13px;color:black;">Date</span>
											</td>
										<?php
											}
											if ((in_array('No', $modulecolumns))) {
										?>
											<td class="text-uppercase" style="width:10%;">
												<span style="font-size:13px;color:black;">Number</span>
											</td>
										<?php
											}
											// if ((in_array('Vendor Name', $modulecolumns))) {
										?>
											<td class="text-uppercase" style="width:26%;">
												<span style="font-size:13px;color:black;">Name</span>
											</td>
										<?php
											// }
											if ((in_array('Term', $modulecolumns))) {
										?>
											<td class="text-uppercase" style="width:10%;">
												<span style="font-size:13px;color:black;">Term</span>
											</td>
										<?php
											}
											if ((in_array('Amount', $modulecolumns))) {
										?>
											<td class="text-uppercase" style="width:10%;">
												<span style="font-size:13px;color:black;">Amount</span>
											</td>
										<?php
											}
											if ((in_array('Status', $modulecolumns))) {
										?>
											<td class="text-uppercase" style="width:10%;">
												<span style="font-size:13px;color:black;">Status</span>
											</td>
										<?php
											}
											if ((in_array('Balance', $modulecolumns))) {
										?>
											<td class="text-uppercase" style="width:10%;">
												<span style="font-size:13px;color:black;">Balance</span>
											</td>
										<?php
											}
											if ((in_array('Print', $modulecolumns))) {
										?>
											<td class="text-uppercase" style="width:10%;">
												<span style="font-size:13px;color:black;">PRINT</span>
											</td>
										<?php
											}
				 							if ((in_array('Edit', $modulecolumns))) {
										?>
											<td class="text-uppercase status" style="width:5%;" id="status">
												<span style="font-size:13px;color:black;"> Edit</span>
											</td>
										<?php
											}
										?>
										</tr>
									</thead>
									<tbody id="myTable">
									<?php
                    				//FOR BILL DATA
										$totalcancel=array();
										$totalbillno=array();
										$totalbilldate=array();
			                     $sqls=$con->prepare("SELECT MAX(id) AS id,billdate, billno, vendorname, billterm, duedate, billamount, cancelstatus, vendorid FROM pairbills WHERE franchisesession=? AND createdid=? ".$typesforlisting." GROUP BY billdate, billno ORDER BY billdate DESC,ordering DESC LIMIT ".(($access['billpageload']=='pagenum')?'10':'15')."");
      								$sqls->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
      								$sqls->execute();
      								$sql = $sqls->get_result();
										$count=1;
										$billamount=0;
										$balanceamount=0;
										$currentamount=0;
										$overdueamount=0;
										while($info=$sql->fetch_array()){
											$billamount+=(float)$info['billamount'];
											$currentamount=(float)$info['billamount'];
											$paidamount=0;
											$refundamount=0;
											$currentbalance=0;
			                        $sqlpurchasepays=$con->prepare("SELECT amount FROM pairpurchasepayhistory WHERE franchisesession=? AND createdid=? AND billno=? AND billdate=? ORDER BY id DESC");
      									$sqlpurchasepays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $info['billno'], $info['billdate']);
      									$sqlpurchasepays->execute();
      									$sqlpurchasepay = $sqlpurchasepays->get_result();
			                        while($infopurchasepay=$sqlpurchasepay->fetch_array()){
												$paidamount+=(float)$infopurchasepay['amount'];
											}
											$currentbalance=((float)$info['billamount']-$paidamount);
											$balanceamount+=((float)$info['billamount']-$paidamount);
											$totalcancel[]=$info['cancelstatus'];
											$totalbillno[]=$info['billno'];
											$totalbilldate[]=$info['billdate'];
                      $sqlsantss=$con->prepare("SELECT billamount, billpaymentreceived, grandtotal,debitnotedate, debitnoteno FROM pairdebitnotes WHERE franchisesession=? AND createdid=? AND billno=? AND billdate=? AND vendorid=? GROUP BY debitnotedate, debitnoteno ORDER BY debitnotedate ASC, debitnoteno ASC");
                      $sqlsantss->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['billno'], $info['billdate'], $info['vendorid']);
                      $sqlsantss->execute();
                      $sqlsants = $sqlsantss->get_result();
                      if($sqlsants->num_rows>0){
                        while($infoantss=$sqlsants->fetch_array()){
													$currentbalance=((float)$currentbalance-$infoantss['grandtotal']);
													$paidamountdr=0;
													$sqldrpays=$con->prepare("SELECT amount FROM pairdebitnotepayhistory WHERE franchisesession=? AND createdid=? AND debitnoteno=? AND debitnotedate=? ORDER BY id DESC");
													$sqldrpays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $infoantss['debitnoteno'], $infoantss['debitnotedate']);
													$sqldrpays->execute();
													$sqldrpay = $sqldrpays->get_result();
													while($infodrpay=$sqldrpay->fetch_array()){
														$paidamountdr+=(float)$infodrpay['amount'];
													}
													$currentbalance=((float)$currentbalance+$paidamountdr);
													$refundamount=((float)$paidamountdr);
                        }
                      }
	      							if ($currentbalance<0) {
	      								$currentbalance = 0;
	      							}
											if($info['cancelstatus']=='1'){
									?>
										<!-- <tr style="text-decoration: line-through;"> -->
									<?php
										}
										else{
									?>
										<tr>
										<?php
											}
											if ((in_array('Date', $modulecolumns))) {
										?>
											<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Date">
												<?=(($info['billdate']!='')?(date($date,strtotime($info['billdate']))):'&nbsp;')?>
											</td>
										<?php
											}
											if ((in_array('No', $modulecolumns))) {
										?>
											<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Number">
												<?=(($info['billno']=='')?'&nbsp;':'')?><?=$info['billno']?>
											</td>
										<?php
											}
											// if ((in_array('Vendor Name', $modulecolumns))) {
										?>
											<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Name">
												<?=(($info['vendorname']=='')?'&nbsp;':'')?><?=$info['vendorname']?>
											</td>
										<?php
											// }
											if ((in_array('Term', $modulecolumns))) {
										?>
											<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Term">
												<?=$info['billterm']?>
											</td>
										<?php
											}
											if ((in_array('Amount', $modulecolumns))) {
										?>
						 					<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Amount">
						 						<i class="fa fa-rupee"></i>
						 						<?=number_format((float)$info['billamount'],2,'.','')?>
						 					</td>
										<?php
											}
											if ((in_array('Status', $modulecolumns))) {
												if($info['cancelstatus']=='1'){
										?>
											<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" style="color:#bbbbbb;text-decoration: none;">
												Void
											</td>
											<?php
												}
												else{
													if(($currentbalance==0)||($currentbalance<=0)){
											?>
											<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" class="text-success">
												Paid
											</td>
												<?php
													}
													else{
														if(($paidamount - $refundamount)<=0){
												?>
											<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" class="text-danger">
												Un Paid
											</td>
													<?php
														}
														else{
													?>
											<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" class="text-warning">
												Partially Paid
											</td>
										<?php
														}
													}
												}
											}
											if ((in_array('Balance', $modulecolumns))) {
										?>
											<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Balance">
												<i class="fa fa-rupee"></i>
												<?=number_format((float)$currentbalance,2,'.','')?>
											</td>
										<?php
											}
											if ((in_array('Print', $modulecolumns))) {
										?>
											<td data-label="Print" class="">&nbsp;
												<a target="_blank" href="billprint.php?billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
													Print
												</a>
											</td>
										<?php
											}
											if ((in_array('Edit', $modulecolumns))) {
										?>
											<td data-label="Edit">
												<a href="billedit.php?billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>" class="text-secondary font-weight-bold text-xs">
													<i class="fa fa-edit"></i> Edit
												</a>
											</td>
										<?php
											}
										?> 
										</tr>
									<?php
											$count++;
										}
										$sqltotlists=$con->prepare("SELECT COUNT(DISTINCT billno) FROM pairbills WHERE franchisesession=? AND createdid=? ".$typesforlisting."");
      								$sqltotlists->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
      								$sqltotlists->execute();
      								$sqltotlist = $sqltotlists->get_result();
										$sqlfetlist=$sqltotlist->fetch_array();
										if ($sqlfetlist[0]==0) {
											$pageinitnum = 0;
										}
										if ($sqlfetlist[0]!=0) {
											$pageinitnum = 1;
										}
										if (($sqlfetlist[0]>=1)&&($sqlfetlist[0]<=10)) {
											$pagetotnum = 1;
										}
										else if (($sqlfetlist[0]==0)) {
											$pagetotnum = 0;
										}
										else{
											$pagetotnum = ceil($sqlfetlist[0]/10);
										}
										//FOR PAGE NUMBER CALCULATION BY DATABASE TABLE
									?>
									</tbody>
								</table>
								<div style="text-align: center !important;display: none;" id="loadimg">
									<img src="loading.gif" alt="Loading..." style="margin-top: -60px;" id="loadimgins">
								</div>
							<?php
								if ($access['billpageload']=='pageauto') {
							?>
								<script type="text/javascript">
								var sIndex = 15, offSet = 15, isPreviousEventComplete = true, isDataAvailable = true;
								$('.main-content').on('scroll', function() {
									var scrollTop = $(this).scrollTop();
									if (scrollTop + $(this).innerHeight() >= this.scrollHeight-50) {
										if (isPreviousEventComplete && isDataAvailable) {
											isPreviousEventComplete = false;
											$("#loadimg").css("display","block");
											console.log('ss');
											// ajax for get
											$.ajax({
												type: "GET",
												url: 'listbillsearch.php?term=' + sIndex + '&limitings=15&typesforlisting=<?=urlencode($typesforlisting)?>',
												success: function (result) {
													$("#myTable").append(result);
													sIndex = sIndex + offSet;
													isPreviousEventComplete = true;
													if (result == '')
														isDataAvailable = false;
													$("#loadimg").css("display","none");
													console.log(result);
												},
												error: function (error) {
													console.log(error);
												}
											});
											// it is done
										}
									}
								});
								//FOR PAGE SCROLL
								</script>
							<?php
								}
								if ($access['billpageload']=='pagenum') {
							?>
								<br>
								<input type="hidden" value="10" id="limitforpagenum">
								<div id="pagenumcontainer" style="padding: 24px;text-align: center;"></div>
								<script>
                try{
  								const mountNode = document.getElementById('pagenumcontainer');
  								"use strict";
  								const { createRoot } = ReactDOM;
  								const { Pagination } = antd;
  								// Total ${range[0]} - ${range[1]} of ${total} (Datas)
  								const App = () => (React.createElement(Pagination, { total: <?=ceil($sqlfetlist[0])?>, showSizeChanger: true, showQuickJumper: true, showTotal: (total, range) => `Total ${range[0]} - ${range[1]} of ${total} items`, onChange: pagechanges }));
  								const ComponentDemo = App;
  								createRoot(mountNode).render(React.createElement(ComponentDemo, null));
  								const pagechanges = (page, pageSize) => {
  									// alert('Page changed to'+ page+'Items per page:'+ pageSize);
  									$('#limitforpagenum').val(parseInt(pageSize));
  									if ($('#limitforpagenum').val()==10) {
  										var totalpagesnumber = <?=ceil($sqlfetlist[0]/10)?>;
  										if ((page=='')||(page==0)) {
  											var isthisval = 1;
  										}
  										else if(page>totalpagesnumber){
  											var isthisval = totalpagesnumber;
  										}
  										else{
  											var isthisval = page;
  										}
  										var perpages = ''+((parseInt(isthisval)-1)*10);
  									}
  									else if ($('#limitforpagenum').val()==20) {
  										var totalpagesnumber = <?=ceil($sqlfetlist[0]/20)?>;
  										if ((page=='')||(page==0)) {
  											var isthisval = 1;
  										}
  										else if(page>totalpagesnumber){
  											var isthisval = totalpagesnumber;
  										}
  										else{
  											var isthisval = page;
  										}
  										var perpages = ''+((parseInt(isthisval)-1)*20);
  									}
  									else if ($('#limitforpagenum').val()==50) {
  										var totalpagesnumber = <?=ceil($sqlfetlist[0]/50)?>;
  										if ((page=='')||(page==0)) {
  											var isthisval = 1;
  										}
  										else if(page>totalpagesnumber){
  											var isthisval = totalpagesnumber;
  										}
  										else{
  											var isthisval = page;
  										}
  										var perpages = ''+((parseInt(isthisval)-1)*50);
  									}
  									else if ($('#limitforpagenum').val()==100) {
  										var totalpagesnumber = <?=ceil($sqlfetlist[0]/100)?>;
  										if ((page=='')||(page==0)) {
  											var isthisval = 1;
  										}
  										else if(page>totalpagesnumber){
  											var isthisval = totalpagesnumber;
  										}
  										else{
  											var isthisval = page;
  										}
  										var perpages = ''+((parseInt(isthisval)-1)*100);
  									}
  									else {
  										var perpages = '0';
  									}
  									// ajax for get
  									$.ajax({
  										type: "GET",
  										url: 'listbillsearch.php?term='+perpages+'&limitings='+($('#limitforpagenum').val())+'&typesforlisting=<?=urlencode($typesforlisting)?>',
  										success: function (result) {
  											$("#myTable").html(result);
  										},
  										error: function (error) {
  											alert(error);
  										}
  									});
  									// it is done
  								};
  								//FOR PAGE NUMBER
                }
                catch(e){
                  alert(e);
                }
								</script>
							<?php 
								}
							?>
							</div>
						<?php 
							}
						?>
         </div>
      </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="deleteconfirm-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">Confirm Submit</div>
					<div class="modal-body">Are you sure you want to Cancel this Bill?</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
						<a id="deleteitem" href="" class="btn btn-success success" >Yes</a>
					</div>
				</div>
			</div>
		</div> 
		<!-- FOR DELETE ITEM  -->
	<?php
		include('footer.php');
	?>
	</div>
</main>
<?php
	include('fexternals.php');
?>

<script type="text/javascript">
function submitthesorting(value) {
  $.ajax({
    type: "GET",
    url: 'listingsortfilters.php?moduletype=Bills&typesforlisting='+value+'',
    success: function (result) {
      console.log(result);
      window.location = 'bills.php?remarks='+result+'';
    },
    error: function (error) {
      console.log(error);
    }
  });
}
</script>

<script>
function deleteitem(billno,billdate,cancelstatus){
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","billcancel.php?billno="+billno+"&billdate="+billdate+"&cancelstatus="+cancelstatus);
}
//FOR DELETE ITEM
</script>
</body>
</html>