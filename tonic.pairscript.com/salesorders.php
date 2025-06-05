<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE


if(isset($_POST['submit'])){
	$delopenorders = $con->prepare("UPDATE pairsalesorders SET tdelete=1 WHERE createdid=? AND franchisesession=?");
   $delopenorders->bind_param("ss", $companymainid, $_SESSION['franchisesession']);
   $delopenorders->execute();
   $delopenorders->close();
   header("Location:salesorders.php?remarks=Orders Closed Successfully");
}

$sqlismainaccessinvoices=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Invoices' ORDER BY id ASC");
$sqlismainaccessinvoices->bind_param("i", $companymainid);
$sqlismainaccessinvoices->execute();
$sqlismainaccessinvoice = $sqlismainaccessinvoices->get_result();
$infomainaccessinvoice=$sqlismainaccessinvoice->fetch_array();
$sqlismainaccessinvoice->close();
$sqlismainaccessinvoices->close();

$sqlismainaccessfields=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Sales Orders' ORDER BY id ASC");
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



$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Sales Orders' ORDER BY id ASC");
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
elseif($infomainaccessuser['filtertypesforlistsorting']=='Converted'){
  $typesforlisting = "AND convertstatus=1 AND tdelete=0";
  $nameshowinglisting = "Converted";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Pending'){
  $typesforlisting = "AND convertstatus=0 AND tdelete=0";
  $nameshowinglisting = "Pending";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Deleted'){
  $typesforlisting = "AND tdelete=1";
  $nameshowinglisting = "Deleted";
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

  .blinkthetable{
    background-color: #1BBC9B !important;
    color: white !important;
    animation: blinkthetables 1s linear infinite;
  }
  @keyframes blinkthetables{
    0%{opacity: 0;}
    50%{opacity: .5;}
    100%{opacity: 1;}
  }

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
    $sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Sales Orders' ORDER BY id ASC");
      $sqlismainaccessusers->bind_param("i", $userid);
      $sqlismainaccessusers->execute();
      $sqlismainaccessuser = $sqlismainaccessusers->get_result();
      $infomainaccessuser=$sqlismainaccessuser->fetch_array();
      //FOR MODULE NAME
    $sqlismainaccesscustomers=$con->prepare("SELECT * FROM pairmainaccess WHERE (userid=? AND createdid='0') AND moduletype='Customers' ORDER BY id ASC");
      $sqlismainaccesscustomers->bind_param("i", $userid);
      $sqlismainaccesscustomers->execute();
      $sqlismainaccesscustomer = $sqlismainaccesscustomers->get_result();
      $infomainaccesscustomer=$sqlismainaccesscustomer->fetch_array();
      //FOR CUSTOMER MODULE NAME
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
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Converted')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Converted')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Converted</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Pending')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Pending')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Pending</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Deleted')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Deleted')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Deleted</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  <p class="mb-5" style="color:black;font-size: 20px;margin-top: -28px;margin-left: 18px;">
                    <?= $infomainaccessuser['modulename'] ?>
                  </p>
                </div>
                <div class="col-lg-3" style="margin-bottom: 18px !important;"> 
                  <input class="form-control" id="saleordersearch" type="text" placeholder="Search.." style="height:24px;">
                </div>
              </div>
            <?php 
              $sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Sales Orders' ORDER BY id ASC");
                $sqlismainaccessusers->bind_param("i", $userid);
                $sqlismainaccessusers->execute();
                $sqlismainaccessuser = $sqlismainaccessusers->get_result();
                $infomainaccessuser=$sqlismainaccessuser->fetch_array();
              if (($infomainaccessuser['useraccesscreate']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
            ?>
              <div align="right" class=" p-2 addandmenuonlyforimports" style="margin-bottom: -130px;">
                <div class="row" style="width:250px;">           
                  <div class="col-8">  
                    <a href="salesorderadd.php" class="btn btn-custom btn-sm p-2 add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: -151px;margin-right:-39px;padding-right: 5px;">
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
                          <a class="dropdown-item" href="salesorderimport.php">
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
              $sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE franchiseid=? AND moduletype='Sales Orders' ORDER BY id ASC");
                $sqlismainaccessusers->bind_param("i", $_SESSION['franchisesession']);
                $sqlismainaccessusers->execute();
                $sqlismainaccessuser = $sqlismainaccessusers->get_result();
                $infomainaccessuser=$sqlismainaccessuser->fetch_array();
                //FOR GET MODULE NAME OF INVOICE
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
   <div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="position: relative;top: 9px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
      <button class="nav-link <?= (($access['listingtabone']=='1')?'active':'') ?>" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true" style="background-color: transparent !important;<?= (($access['listingtabone']=='1')?'':'display: none;') ?>">
         <div class="customcont-header ml-0">
            <a class="customcont-heading"><?=$nameshowinglisting?> <?=$infomainaccessuser['modulename']?></a>
         </div>
      </button>
      <button class="nav-link <?= (($access['listingtabone']=='0')?'active':'') ?>" id="nav-service-tab" data-bs-toggle="tab" data-bs-target="#nav-service" type="button" role="tab" aria-controls="nav-service" style="background-color: transparent !important;<?= (($access['listingtabtwo']=='1')?'':'display: none;') ?>">
         <div class="customcont-header ml-0">
            <a class="customcont-heading"><?=$access['listingtabtwoname']?></a>
         </div>
      </button>
   </div>
   <div class="tab-content" id="nav-tabContent" style="position:relative;top: -18px;">
      <div class="tab-pane fade <?= (($access['listingtabone']=='1')?'show active':'') ?> mt-4 p-3" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" style="<?= (($access['listingtabone']=='1')?'':'display: none;') ?>">
         <div class="table-responsive p-0 min-height-480">

                    <div class="table-responsive p-0 min-height-480">
                <table id="someTable" class="table table-bordered align-items-center mb-0" style="table-layout: fixed;">
                  <thead>
                    <tr>
                              <?php
                      if ((in_array('Date', $modulecolumns))) {
                              ?>
                        <td class="text-uppercase" style="width:9%;">
                          <span style="font-size:13px;color:black;"> Date</span>
                        </td>
                      <?php
                        }
                        if ((in_array('No', $modulecolumns))) {
                      ?>
                              <td class="text-uppercase" style="width:10%;">
                                <span style="font-size:13px;color:black;"> Number</span>
                              </td>
                      <?php
                        }
                        // if ((in_array('Customer Name', $modulecolumns))) {
                      ?>
                        <td class="text-uppercase" style="width:35%;">
                          <span style="font-size:13px;color:black;"> Name</span>
                        </td>
                      <?php
                        // }
                        if ((in_array('Amount', $modulecolumns))) {
                      ?>
                              <td class="text-uppercase" style="width:10%;">
                                <span style="font-size:13px;color:black;"> Amount</span>
                              </td>
                      <?php
                        }
                        if ((in_array('Status', $modulecolumns))) {
                      ?>
                          <td class="text-uppercase" style="width:11%;">
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
                        <!-- <td class="text-uppercase status" style="width:5%;" id="status">
                          <span style="font-size:13px;color:black;"> Convert</span>
                        </td> -->
                      </tr>
                    </thead>
                    <tbody id="someTableTr">
                          <?php
                           $totalcancel=array();
                           $totalsalesorderno=array();
                           $totalsalesorderdate=array();
                           $sqls=$con->prepare("SELECT tdelete,convertstatus,id,salesorderdate, salesorderno, customername, salesorderterm, duedate, salesorderamount, cancelstatus FROM pairsalesorders WHERE franchisesession=? AND createdid=? ".$typesforlisting." GROUP BY salesorderdate, salesorderno ORDER BY salesorderdate DESC, salesordertime DESC, ordering DESC LIMIT ".(($access['saleorderpageload']=='pagenum')?'10':'15')."");
                      $sqls->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
                      $sqls->execute();
                      $sql = $sqls->get_result();
                           $count=1;
                           $salesorderamount=0;
                           $balanceamount=0;
                           $currentamount=0;
                           $overdueamount=0;
                           while($info=$sql->fetch_array()){
                              $salesorderamount+=(float)$info['salesorderamount'];
                              $currentamount=(float)$info['salesorderamount'];
                              $paidamount=0;
                              $currentbalance=0;
                              $sqlsalespays=$con->prepare("SELECT amount FROM pairsalespayhistory WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? ORDER BY id DESC");
                        $sqlsalespays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $info['salesorderno'], $info['salesorderdate']);
                        $sqlsalespays->execute();
                        $sqlsalespay = $sqlsalespays->get_result();
                              while($infosalespay=$sqlsalespay->fetch_array()){
                                $paidamount+=(float)$infosalespay['amount'];
                              }
                              $currentbalance=((float)$info['salesorderamount']-$paidamount);
                              $balanceamount+=((float)$info['salesorderamount']-$paidamount);
                              $totalcancel[]=$info['cancelstatus'];
                              $totalsalesorderno[]=$info['salesorderno'];
                              $totalsalesorderdate[]=$info['salesorderdate'];
                              if($info['cancelstatus']=='1'){
                          ?>
                            <!--tr style="text-decoration: line-through;"-->
                           <tr>
                          <?php
                        }
                        else{
                      ?>
                            <tr>
                          <?php
                        }
                      ?>
                    <?php
                      if ((in_array('Date', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Date">
                        <?=(($info['salesorderdate']!='')?(date($date,strtotime($info['salesorderdate']))):'&nbsp;')?>
                      </td>
                    <?php
                      }
                      if ((in_array('No', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Number">
                        <?=(($info['salesorderno']=='')?'&nbsp;':'')?><?=$info['salesorderno']?>
                      </td>
                    <?php
                      }
                      // if ((in_array('Customer Name', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Name">
                        <?=(($info['customername']=='')?'&nbsp;':'')?><?=$info['customername']?>
                      </td>
                    <?php
                      // }
                      if ((in_array('Amount', $modulecolumns))) {
                    ?>
                              <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Amount">
                        <i class="fa fa-rupee"></i> <?=number_format((float)$info['salesorderamount'],2,'.','')?>
                      </td>
                    <?php
                      }
                      if ((in_array('Status', $modulecolumns))) {
                        if($info['tdelete']=='1'){
                    ?>
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Status" style="color:#bbbbbb;text-decoration: none;">
                        Deleted
                      </td>
                    <?php
                            }
                        else{
                          if($info['convertstatus']=='0'){
                    ?>
                      <td data-label="Status">
                        <a href="converttoinvoice.php?salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>&type=salesorder" class="text-warning">
                          <i class="fa fa-file-import"></i> Convert To <?=$infomainaccessinvoice['modulename']?>
                        </a>
                      </td>
                    <?php
                          }
                          else{
                    ?>
                      <td data-label="Status" onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')">
                        <a href="#" class="text-success">
                          <i class="fa fa-file-import"></i> <?=$infomainaccessinvoice['modulename']?> Converted
                        </a>
                      </td>
                    <?php
                          }
                        }
                      }
                      if ((in_array('Balance', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Balance">
                        <i class="fa fa-rupee"></i> <?=number_format((float)$currentbalance,2,'.','')?>
                      </td>
                    <?php
                      }
                      if ((in_array('Print', $modulecolumns))) {
                    ?>
                      <td data-label="Print" class="">&nbsp;
                                <a target="_blank" href="salesorderprint.php?salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                  Print
                                </a>
                              </td>
                    <?php
                      }
                      if ((in_array('Edit', $modulecolumns))) {
                    ?>
                      <td data-label="Edit">
                        <a href="salesorderedit.php?salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>" class="text-secondary font-weight-bold text-xs">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                      </td>
                    <?php
                      }
                    ?> 
                      <!-- <td data-label="Convert">
                        <?php
                          if ($info['convertstatus']=='0') {
                        ?>
                        <a href="converttoinvoice.php?salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>&type=salesorder" class="text-warning">
                          <i class="fa fa-file-import"></i> Convert To <?=$infomainaccessinvoice['modulename']?>
                        </a>
                        <?php
                          }
                          else{
                        ?>
                        <a href="#" class="text-success">
                          <i class="fa fa-file-import"></i> <?=$infomainaccessinvoice['modulename']?> Converted
                        </a>
                        <?php
                          }
                        ?>
                      </td> -->
                            </tr>
                  <?php
                        $count++;
                    }
                    $sqltotsaleorders=$con->prepare("SELECT COUNT(DISTINCT salesorderno) FROM pairsalesorders WHERE franchisesession=? AND createdid=? ".$typesforlisting."");
                      $sqltotsaleorders->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
                      $sqltotsaleorders->execute();
                      $sqltotsaleorder = $sqltotsaleorders->get_result();
                    $sqlfetlist=$sqltotsaleorder->fetch_array();
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
                if ($access['saleorderpageload']=='pageauto') {
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
                        url: 'saleordersearch.php?term=' + sIndex + '&limitings=15&typesforlisting=<?=$typesforlisting?>',
                        success: function (result) {
                          $("#someTableTr").append(result);
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
                if ($access['saleorderpageload']=='pagenum') {
              ?>
                <br>
                <input type="hidden" value="10" id="limitforpagenum">
                <div id="pagenumcontainer" style="padding: 24px;text-align: center;"></div>
                <script>
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
                    url: 'saleordersearch.php?term='+perpages+'&limitings='+($('#limitforpagenum').val())+'&typesforlisting=<?=$typesforlisting?>',
                    success: function (result) {
                      $("#someTableTr").html(result);
                    },
                    error: function (error) {
                      alert(error);
                    }
                  });
                  // it is done
                };
                //FOR PAGE NUMBER
                </script>
              <?php 
                }
              ?>
              </div>
         </div>
      </div>
      <div class="tab-pane fade mt-4 p-3 <?= (($access['listingtabone']=='0')?'show active':'') ?>" id="nav-service" role="tabpanel" aria-labelledby="nav-service-tab" style="<?= (($access['listingtabtwo']=='1')?'':'display: none;') ?>">
      	<?php
      		$sqlis=$con->prepare("SELECT tablenumber,id FROM pairtables WHERE (createdid=? OR createdid='0') ORDER BY id ASC");
				$sqlis->bind_param("s", $companymainid);
				$sqlis->execute();
				$sqli = $sqlis->get_result();
				while($info=$sqli->fetch_array()){
	      	$sqlmoreinfo=$con->prepare("SELECT id,convertstatus,salesorderno,salesorderdate,grandtotal,salesordertime,tdelete,invoiceno,invoicedate FROM pairsalesorders WHERE tableid=? AND tdelete='0' ORDER BY createdon DESC");
					$sqlmoreinfo->bind_param("s", $info['id']);
					$sqlmoreinfo->execute();
          $convertstatus = 0;
          $convertstatusans = 0;
          $convertstatusanstext = 'salesorderedit.php?';
          $classforblink = '';
					$sqlmoreinfos = $sqlmoreinfo->get_result();
					if ($sqlmoreinfos->num_rows>0) {
						$sqlmoreinfosans=$sqlmoreinfos->fetch_array();
            $convertstatusanstext = 'salesorderedit.php?salesorderno='.$sqlmoreinfosans['salesorderno'].'&salesorderdate='.$sqlmoreinfosans['salesorderdate'].'';
            $convertstatus = $sqlmoreinfosans['convertstatus'];
						$salesordernousingthis = $sqlmoreinfosans['salesorderno'];
						$salesorderdateusingthis = $sqlmoreinfosans['salesorderdate'];
						$givenTime = $sqlmoreinfosans['salesordertime'];
						$currentTime = date("H:i:s");
						$givenDateTime = DateTime::createFromFormat('H:i:s', $givenTime);
						$currentDateTime = DateTime::createFromFormat('H:i:s', $currentTime);
						$timeDifference = $currentDateTime->getTimestamp() - $givenDateTime->getTimestamp();
						$hours = floor($timeDifference / 3600);
						$minutes = ceil(($timeDifference % 3600) / 60);
						if ($hours > 0) {
						    $howlongthis = "$hours hour";
						    if ($hours > 1) {
						        $howlongthis .= "s";
						    }
						    // if ($minutes > 0) {
						    //     $howlongthis .= " $minutes minute";
						    //     if ($minutes > 1) {
						    //         $howlongthis .= "s";
						    //     }
						    // }
						    $howlongthis .= " ago";
						}
						elseif ($minutes > 0) {
						    $howlongthis = "$minutes minute";
						    if ($minutes > 1) {
						        $howlongthis .= "s";
						    }
						    $howlongthis .= " ago";
						}
						else {
						    $howlongthis = "Just now";
						}
            if($convertstatus=='1'){
              $paidamountans=0;
              $currentbalanceans=0;
              $currentamountans=(float)$sqlmoreinfosans['grandtotal'];
              $sqlsalespaysans=$con->prepare("SELECT amount FROM pairsalespayhistory WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? ORDER BY id DESC");
              $sqlsalespaysans->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $sqlmoreinfosans['invoiceno'], $sqlmoreinfosans['invoicedate']);
              $sqlsalespaysans->execute();
              $sqlsalespayans = $sqlsalespaysans->get_result();
              while($infosalespayans=$sqlsalespayans->fetch_array()){
                $paidamountans+=(float)$infosalespayans['amount'];
              }
              $currentbalanceans=((float)$sqlmoreinfosans['grandtotal']-$paidamountans);
              $sqlmoreinfoinv=$con->prepare("SELECT * FROM pairinvoices WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? ORDER BY id ASC");
              $sqlmoreinfoinv->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $sqlmoreinfosans['invoiceno'], $sqlmoreinfosans['invoicedate']);
              $sqlmoreinfoinv->execute();
              $sqlmoreinfosinv = $sqlmoreinfoinv->get_result();
              if ($sqlmoreinfosinv->num_rows>0) {
                $sqlmoreinfosansinv=$sqlmoreinfosinv->fetch_array();
                if($sqlmoreinfosansinv['cancelstatus']=="1"){
                  $ansfortable = '<span style="font-size:29px;">'.$info['tablenumber'].'</span>';
                }
                elseif(($currentbalanceans==0)||($currentbalanceans<=0)){
                  $ansfortable = '<span style="font-size:29px;">'.$info['tablenumber'].'</span>';
                }
                else{
                  if($currentbalanceans==$currentamountans){
                    $convertstatusanstext = 'invoiceview.php?id='.$sqlmoreinfosansinv['id'].'&invoiceno='.$sqlmoreinfosansinv['invoiceno'].'&invoicedate='.$sqlmoreinfosansinv['invoicedate'].'';
                    $classforblink = 'blinkthetable';
                    $ansfortable = '<span style="margin:18px;font-size:29px;">'.$info['tablenumber'].'</span><br><span style="float:left;font-size:14px;">'.$resmaincurrencyans.' '.number_format($sqlmoreinfosans['grandtotal'],2,'.',',').'</span>&nbsp;<span style="float:right;text-transform:lowercase !important;font-size:14px;">'.strtolower($howlongthis).'</span>';
                  }
                  else{
                    $convertstatusanstext = 'invoiceview.php?id='.$sqlmoreinfosansinv['id'].'&invoiceno='.$sqlmoreinfosansinv['invoiceno'].'&invoicedate='.$sqlmoreinfosansinv['invoicedate'].'';
                    $classforblink = 'blinkthetable';
                    $ansfortable = '<span style="margin:18px;font-size:29px;">'.$info['tablenumber'].'</span><br><span style="float:left;font-size:14px;">'.$resmaincurrencyans.' '.number_format($sqlmoreinfosans['grandtotal'],2,'.',',').'</span>&nbsp;<span style="float:right;text-transform:lowercase !important;font-size:14px;">'.strtolower($howlongthis).'</span>';
                  }
                }
              }
              else{
                $ansfortable = '<span style="font-size:29px;">'.$info['tablenumber'].'</span>';
              }
            }
            else{
              $convertstatusans = 0;
						  $ansfortable = '<span style="margin:18px;font-size:29px;">'.$info['tablenumber'].'</span><br><span style="float:left;font-size:14px;">'.$resmaincurrencyans.' '.number_format($sqlmoreinfosans['grandtotal'],2,'.',',').'</span>&nbsp;<span style="float:right;text-transform:lowercase !important;font-size:14px;">'.strtolower($howlongthis).'</span>';
            }
					}
					else{
						$ansfortable = '<span style="font-size:29px;">'.$info['tablenumber'].'</span>';
					}
      	?>
         <button class="<?=$classforblink?> btn btn-default m-3 p-0" style="min-width: 220px;max-width: 220px;min-height: 70px;max-height: 70px;padding: 0px 6px !important;<?=((($ansfortable == '<span style="font-size:29px;">'.$info['tablenumber'].'</span>')||($convertstatusans=='1'))?'':'background-color: #1BBC9B;color: white !important;')?>" <?=((($ansfortable == '<span style="font-size:29px;">'.$info['tablenumber'].'</span>')||($convertstatusans=='1'))?'onclick="window.open(\'salesorderadd.php?tabledinfo='.base64_encode($info['id']).'\',\'_self\')"':'onclick="window.open(\''.$convertstatusanstext.'\',\'_self\')"')?>><?=$ansfortable?></button>
         <a class="<?=$classforblink?> btn btn-primary btn-sm btn-custom-grey" style="background-color: #1BBC9B;color: #fff !important;padding: 3px;border-radius: 3px;text-decoration: none;margin-right: -30px;z-index: 999999 !important;position: relative;left: -50px;<?= (($access['listingrenametable']=='1')?'':'display: none;') ?>" data-bs-toggle="modal" data-bs-target="#RenameTablenumber" onclick="openthemodal('<?=$info['tablenumber']?>','<?=$info['id']?>')"><i class="fa fa-pencil-alt"></i></a>
      	<?php
      		}
				$sqli->close();
				$sqlis->close();
      	?>
<div class="modal fade" id="RenameTablenumber" tabindex="-1" role="dialog" style="z-index: 9999999;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:#f5f5f5;">
                <h5 class="modal-title" style="font-weight: normal;font-size: 20px;">
                    Rename <?=$access['txttablenumber']?>
                </h5>
                <span type="button" onclick="funestablenumber()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" id="closeicon" style="font-size: 21px;">&times;</span>
                </span>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <label for="missingtablenumber" class="custom-label">
                                        <span class="text-danger"> <?=$access['txttablenumber']?> *</span>
                                    </label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" name="missingtablenumber" class="form-control form-control-sm mb-4" id="missingtablenumber" placeholder="Enter <?=$access['txttablenumber']?>" required>
                                    <input type="hidden" name="missingtableid" class="form-control form-control-sm mb-4" id="missingtableid">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer " style="margin-top: 10px !important;">
                <div class="col">
                    <button onclick="funaddtablenumber()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submittablenumber" value="Submit">
                        <span class="label">Save</span>
                        <span class="spinner"></span>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funestablenumber()">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
      	<form action="" method="POST" onSubmit="return check_validation_before_submit()" id="closeforms">
      		<input type="submit" name="submit" value="Close" id="submit" class="btn btn-danger m-3">
      	</form>
      </div>
   </div>
            <?php 
              }
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="modal fade" id="deleteconfirm-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">Confirm Submit</div>
              <div class="modal-body">Are you sure you want to Cancel this <?=$infomainaccessinvoice['modulename']?>?</div>
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
  				// 		$givenTime = $sqlmoreinfosans['salesordertime'];
						// $currentTime = date("H:i:s");
						// $givenDateTime = DateTime::createFromFormat('H:i:s', $givenTime);
						// $currentDateTime = DateTime::createFromFormat('H:i:s', $currentTime);
						// $timeDifference = $currentDateTime->getTimestamp() - $givenDateTime->getTimestamp();
						// if ($timeDifference < 60) {
						// 	$howlongthis =  ceil($timeDifference) . " seconds ago";
						// }
						// elseif ($timeDifference < 3600) {
						// 	$howlongthis =  ceil($timeDifference / 60) . " minutes ago";
						// }
						// elseif ($timeDifference < 86400) {
						// 	$howlongthis =  round($timeDifference / 3600, 2) . " hours ago";
						// }
						// elseif ($timeDifference < 2592000) {
						// 	$howlongthis =  ceil($timeDifference / 86400) . " days ago";
						// }
						// else {
						// 	$howlongthis =  ceil($timeDifference / 2592000) . " months ago";
						// }
?>

<script>
function openthemodal(name,id) {
  $("#missingtableid").val(id);
  $("#missingtablenumber").val(name);
}
function funaddtablenumber() {
    var missingtablenumber = document.getElementById('missingtablenumber');
    if (missingtablenumber.value == '') {
        alert('Please Enter The <?=$access['txttablenumber']?>');
        missingtablenumber.focus();
        return false;
    }
    else {
        $.ajax({
            type: "POST",
            url: "tablenumberadds.php",
            data: {
                tableid: $("#missingtableid").val(),
                tablenumber: $("#missingtablenumber").val(),
                permission: 'rename',
                submit: "Submit"
            },
            success:function(result){
                const resarray = result.split("|");
                alert(resarray[0]);
                if(resarray[1]=='0'){}
                else{
                    $('#RenameTablenumber').modal('hide');
                    window.location = 'salesorders.php?remarks=<?=$access['txttablenumber']?> Renamed Successfully';
                    return false;
                }
            }
        });
    }
}
function funestablenumber() {
    $('#RenameTablenumber').modal('hide');
    return false;
}
</script>

<script type="text/javascript">
function submitthesorting(value) {
  $.ajax({
    type: "GET",
    url: 'listingsortfilters.php?moduletype=Sales Orders&typesforlisting='+value+'',
    success: function (result) {
      console.log(result);
      window.location = 'salesorders.php?remarks='+result+'';
    },
    error: function (error) {
      console.log(error);
    }
  });
}
</script>

<script>
		    function check_validation_before_submit()
		    {
		        var checkthepart = confirm('Are you Sure want to Close?');
            if (checkthepart) {
              return true;
            }
            else{
              return false;
            }
		    }
function deleteitem(salesorderno,salesorderdate,cancelstatus){
  $('#deleteconfirm-adddelete').modal('show');
  $("#deleteconfirm-adddelete #deleteitem").attr("href","salesordercancel.php?salesorderno="+salesorderno+"&salesorderdate="+salesorderdate+"&cancelstatus="+cancelstatus);
}
//FOR DELETE ITEM
</script>
</body>
</html>