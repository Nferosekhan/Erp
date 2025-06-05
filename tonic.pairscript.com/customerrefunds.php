<?php
include('lcheck.php');
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customer Refunds' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}

$typesforlisting = "";
$nameshowinglisting = "All";
if ($infomainaccessuser['filtertypesforlistsorting']=='All') {
  $typesforlisting = "";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Cash'){
  $typesforlisting = "AND paymentmode='Cash'";
  $nameshowinglisting = "Cash";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Bank Account'){
  $typesforlisting = "AND paymentmode='Bank Account'";
  $nameshowinglisting = "Bank Account";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Credit'){
  $typesforlisting = "AND paymentmode='Credit'";
  $nameshowinglisting = "Credit";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Upi'){
  $typesforlisting = "AND paymentmode='Upi'";
  $nameshowinglisting = "Upi";
}

$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
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
     if(isset($_GET['remarks']))
     {
     ?>
     <div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -50px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #53b05a !important;">
    <i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks']?></p>
  </div>
     <?php
     }
     ?>
     <?php
     if(isset($_GET['error']))
     {
     ?>
      <div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -50px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
    <i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></p>
  </div>
     <?php
     }
     ?>
                                <?php
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customer Refunds' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
      $sqlismainaccesscustomer=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Customers' order by id  asc");
      $infomainaccesscustomer=mysqli_fetch_array($sqlismainaccesscustomer);
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
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Cash')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Cash')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Cash</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Bank Account')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Bank Account')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Bank Account</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Credit')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Credit')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Credit</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Upi')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Upi')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Upi</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  <p class="mb-5" style="color:black;font-size:20px;margin-top: -28px;margin-left: 18px;"> <?= $infomainaccessuser['modulename'] ?> </p>
                  <!-- </p> -->
                </div>
                <div class="col-lg-3" style="margin-bottom: 57px !important;"> 
                  <input class="form-control" id="cusrefsearch" type="text" placeholder="Search.." style="height:24px;">
                </div>
              </div>
                                <?php 
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccesscreate']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
                                 ?>
                                <div align="right" class=" p-2 addandmenuonlyforimportspayments" style="margin-top: -96px;">
        
       <a href="customerrefundadd.php" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $infomainaccessuser['modulename'] ?></span></p></a>
       
       <br>
       </div>
       <?php
                            }
                            ?>
			<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
    <div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> is Allowed for this Franchise</div>
    <?php
}
else
{
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
   <div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="position: relative;top: -60px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
      <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true" style="background-color: transparent !important;">
         <div class="customcont-header ml-0">
            <a class="customcont-heading"><?=$nameshowinglisting?> <?=$infomainaccessuser['modulename']?></a>
         </div>
      </button>
   </div>
   <div class="tab-content" id="nav-tabContent" style="position:relative;top: -38px;">
      <div class="tab-pane fade show active p-3" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                            <div class="table-responsive p-0 min-height-480">
                                <table id="someTable" class="table table-bordered align-items-center mb-0" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
                      <td class="text-uppercase" style="width:9%;"><span style="font-size:13px;color:black;">Date</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Number', $modulecolumns))) {
                                                ?>
					  <td class="text-uppercase" style="width:10%;"><span style="font-size:13px;color:black;">Number</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
                      <td class="text-uppercase" style="width:46%;"><span style="font-size:13px;color:black;"> Name</span></td>
                      <?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Mode of Payment', $modulecolumns))) {
                                                ?>
                      <td class="text-uppercase" style="width:15%;"><span style="font-size:13px;color:black;">Mode of Payment</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount Received', $modulecolumns))) {
                                                ?>
                      <td class="text-uppercase" style="width:15%;"><span style="font-size:13px;color:black;">Amount Received</span></td>
                      <?php
                                            }
                                                ?>
                                              <!--   <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Edit</span></td>
                      <?php
                                            }
                                                ?> -->
								
<?php
         if ((in_array('Edit', $modulecolumns))) {
        ?>
                                                <td class="text-uppercase status" style="width:5%;"
                                                id="status"><span style="font-size:13px;color:black;"> Edit</span></td>
                                                <?php
          }
          ?>
							
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
									
									<?php
$sql=mysqli_query($con,"set names utf8");
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes,publicid,privateid from paircreditnotepayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' ".$typesforlisting." order by id desc limit ".(($access['salereturnpaypageload']=='pagenum')?'10':'15')."");
$count=1;
while($info=mysqli_fetch_array($sql))
{
if($info['term']=='CASH INVOICE')
{
$sqls=mysqli_query($con,"select cancelstatus from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and creditnoteno='".$info['receiptno']."' and creditnotedate='".$info['receiptdate']."'");
$infos=mysqli_fetch_array($sqls);
if($infos['cancelstatus']=='1')
{
?>
<tr style="text-decoration: line-through;" onclick="window.open('customerrefundview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
else
{
?>
<tr onclick="window.open('customerrefundview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
}
else
{
?>
<tr onclick="window.open('customerrefundview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
?>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
<td data-label="Date"><?=date('d/m/Y',strtotime($info['receiptdate']))?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Number', $modulecolumns))) {
                                                ?>
<td data-label="Number"><?=(($info['privateid']=='')?'&nbsp;':$info['privateid'])?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
<?php
$sqlcus=mysqli_query($con,"select * from paircustomers where id=".$info['customerid']."");
$sqlcusfetch=mysqli_fetch_array($sqlcus);
?>
<td data-label="Name"><?=$sqlcusfetch['customername']?></td>
<?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Mode of Payment', $modulecolumns))) {
                                                ?>
<td data-label="Mode of Payment"><?=$info['paymentmode']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount Received', $modulecolumns))) {
                                                ?>
<td data-label="Amount Received"><i class="fa fa-rupee"></i> <?=number_format((float)$info['amount'],2,'.','')?></td>
<?php
                                            }
                                                ?>
                                                <!-- <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="customerrefundedit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> -->
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="customerrefundedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
</tr>
<?php
$count++;
}
$sqltotlist = mysqli_query($con,"select COUNT(DISTINCT id) from paircreditnotepayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' ".$typesforlisting."");
$sqlfetlist = mysqli_fetch_array($sqltotlist);
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
?>
                                    </tbody>
                                </table>
                                <div style="text-align: center !important;display: none;" id="loadimg">
                                    <img src="loading.gif" alt="Loading..." style="margin-top: -60px;" id="loadimgins">
                                </div>
<?php
if ($access['salereturnpaypageload']=='pageauto') {
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
url: 'listcustomerrefundssearch.php?term=' + sIndex + '&limitings=15&typesforlisting=<?=$typesforlisting?>',
success: function (result) {
$("#myTable").append(result);
sIndex = sIndex + offSet;
isPreviousEventComplete = true;
if (result == '') //When data is not available
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
</script>
<?php
}
?>
<?php
if ($access['salereturnpaypageload']=='pagenum') {
?>
<br>
<input type="hidden" value="10" id="limitforpagenum">
<div id="pagenumcontainer" style="padding: 24px;text-align: center;">
</div>
<script>
const mountNode = document.getElementById('pagenumcontainer');
"use strict";
const { createRoot } = ReactDOM;
const { Pagination } = antd;
// Total ${range[0]} - ${range[1]} of ${total} (Datas)
const App = () => (React.createElement(Pagination, { total: <?=ceil($sqlfetlist[0])?>, showSizeChanger: true, showQuickJumper: true, showTotal: (total, range) => `Total ${range[0]} - ${range[1]} of ${total} items`,
        onChange: pagechanges }));
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
url: 'listcustomerrefundssearch.php?term='+perpages+'&limitings='+($('#limitforpagenum').val())+'&typesforlisting=<?=$typesforlisting?>',
success: function (result) {
$("#myTable").html(result);
},
error: function (error) {
alert(error);
}
});
// it is done
};
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
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to Cancel this Invoice?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem" href="" class="btn btn-success success" >Yes</a>
        </div>
    </div>
</div>
</div> 
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
    url: 'listingsortfilters.php?moduletype=Customer Refunds&typesforlisting='+value+'',
    success: function (result) {
      console.log(result);
      window.location = 'customerrefunds.php?remarks='+result+'';
    },
    error: function (error) {
      console.log(error);
    }
  });
}
</script>

 <script>
 function deleteitem(creditnoteno,creditnotedate,cancelstatus)
{
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","creditnotecancel.php?creditnoteno="+creditnoteno+"&creditnotedate="+creditnotedate+"&cancelstatus="+cancelstatus);
}
 </script>
</body>

</html>