<?php
include('lcheck.php');
$sqlismainaccessuserinv=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Invoices' order by id  asc");
$infomainaccessuserinv=mysqli_fetch_array($sqlismainaccessuserinv);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Reports' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($franchisesrole==''))||((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['groupaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['groupaccess']=='0')||($infomainaccessuser['useraccessview']==0))))) {
header('Location:dashboard.php');
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd-m-Y';
}
$sqlbranch=mysqli_query($con, "select * from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$branch=mysqli_fetch_array($sqlbranch);
if (isset($_POST['submitcustomizes'])) {
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $datenxt = 'Y-m-d';
    }
  $from = mysqli_real_escape_string($con,$_POST['from']);
  $to = mysqli_real_escape_string($con,$_POST['to']);
  $reportperiod = mysqli_real_escape_string($con,$_POST['reportperiod']);

  $sqlreportmodules=mysqli_query($con, "select * from pairreportmodules where types='ouw' order by id  asc");
while($inforeportmodules=mysqli_fetch_array($sqlreportmodules)){
$ansmodules = $inforeportmodules[2];
$newmodules = explode(',',$ansmodules);
}
$modcolumncolchanges='';
foreach ($newmodules as $newmoduleskey) {
$coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
$modcolumncol=$coltypemod."ouw";
$modcolumncol=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
if($modcolumncolchanges!='')
{
$modcolumncolchanges.=','.$modcolumncol;
}
else
{
$modcolumncolchanges.=$modcolumncol;
}
}
$sqlupreport = "update pairreports set rowcolumns='$modcolumncolchanges' where franchiseid='".$_SESSION['franchisesession']."' and types='ouw' and createdid='$companymainid'"; 
$sqlreportup = mysqli_query($con, $sqlupreport);

  $filtername = mysqli_real_escape_string($con,(isset($_POST['filtername']))?'1':'0');
  $companyname = mysqli_real_escape_string($con,(isset($_POST['companyname']))?'1':'0');
  $dateprepare = mysqli_real_escape_string($con,(isset($_POST['dateprepare']))?'1':'0');
  $timeprepare = mysqli_real_escape_string($con,(isset($_POST['timeprepare']))?'1':'0');
  $gstrule = mysqli_real_escape_string($con,(isset($_POST['gstrule']))?'1':'0');
  
  $sqlreportfav = mysqli_query($con,"update pairreportfavourites set reporturl=CONCAT(SUBSTRING_INDEX(reporturl, '&period=', 1),'&period=$reportperiod') where franchisesession='".$_SESSION['franchisesession']."' and reportnames='outward' and createdid='$companymainid'");

  $sqlreport = mysqli_query($con,"update pairreports set reportperiod='$reportperiod',filtername='$filtername',gstrule='$gstrule',companyname='$companyname',dateprepare='$dateprepare',timeprepare='$timeprepare' where franchiseid='".$_SESSION['franchisesession']."' and types='ouw' and createdid='$companymainid'");

  $sqlinwregreport = mysqli_query($con,"update pairreports set gstrule='$gstrule' where franchiseid='".$_SESSION['franchisesession']."' and types='ouwreg' and createdid='$companymainid'");

  $sqlinwconreport = mysqli_query($con,"update pairreports set gstrule='$gstrule' where franchiseid='".$_SESSION['franchisesession']."' and types='ouwcon' and createdid='$companymainid'");

  header("Location:outwardreport.php?invfrom=".date($datenxt,strtotime($from))."&invto=".date($datenxt,strtotime($to))."");
}
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='ouw' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
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
    <link rel="stylesheet" href="pdf/examples/libs/pure-min.css">
    <link rel="stylesheet" href="pdf/examples/libs/grids-responsive-min.css">
  <title>
    <?= $infomainaccessuser['groupname']; ?> View
  </title>
<style>
  .modal-header{
    background: #F1F2F6 !important;
    font-size: 13px !important;
    font-weight: normal !important;
  }
  h5{
    font-weight: normal !important;
  }
@media screen and (max-width: 666px){
        .mobreswords{
            display: none !important;
        }
      }
</style>
    <!-- <link> doesn't need a closing tag -->
    <link href="CSS/Master.css" rel="stylesheet" type="text/css">
    <!-- include the jQuery UI style sheet -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- include jQuery -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <!-- include jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Reports' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
?>
     <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-0" role="form">
<div class="row">
<div class="col-lg-6">
<p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> <a href="reports.php" style="color: #1878F1"> <i class="fa fa-pie-chart" aria-hidden="true"></i> <?= $infomainaccessuser['groupname']; ?> </a> &gt; Summary of Outward Supplies (GSTR-1)</p>
</div>
<div class="col-lg-6">
<span style="float:right">
<a style="margin:4.5px 4.5px !important;" id="calendars" class="btn btn-primary btn-sm btn-custom-grey" onclick="calendars()"><i class="fa-solid fa-calendar-days"></i> <span class="mobreswords "> Custom</span></a>
<a style="margin:4.5px 4.5px !important;" id="customizes" data-bs-toggle="modal" data-bs-target="#Customizesmodal" class="btn btn-primary btn-sm btn-custom-grey">
<i class="fa fa-sliders" aria-hidden="true"></i>
<span class="mobreswords "> Customize Report</span></a>
<!-- Customization modal start -->
<div class="modal fade" id="Customizesmodal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel" style="font-weight: normal;">Customize Report</h5>
<span type="button" onclick="funescustomizes()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-0" role="form">
<div class="modal-body mbsub">

<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="customizegeneral">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#customizegenerals" aria-expanded="true" aria-controls="customizegenerals">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">General</a>
</div>
</button>
</h5>
<div id="customizegenerals" class="accordion-collapse collapse show" aria-labelledby="customizegeneral">
<div class="accordion-body text-sm">
<div class="row justify-content-center">
<div class="col-lg-8">
<p style="font-size:16px !important;margin-bottom: 6px !important;">Report Period</p>
<div class="row">
<div class="col-lg-5 mb-1">
<select class="form-control form-control-sm select4" id="reportperiod" name="reportperiod" onchange="reportperiodfun(this.value)">
<option <?= ($sqlviewreport['reportperiod']=='all')?'selected':''?> value="all">All Dates</option>
<option <?= ($sqlviewreport['reportperiod']=='today')?'selected':''?> value="today">Today</option>
<option <?= ($sqlviewreport['reportperiod']=='thisweek')?'selected':''?> value="thisweek">This Week</option>
<option <?= ($sqlviewreport['reportperiod']=='thismonth')?'selected':''?> value="thismonth">This Month</option>
<option <?= ($sqlviewreport['reportperiod']=='thisquarter')?'selected':''?> value="thisquarter">This Quarter</option>
<option <?= ($sqlviewreport['reportperiod']=='thisyear')?'selected':''?> value="thisyear">This Year</option>
<option <?= ($sqlviewreport['reportperiod']=='yesterday')?'selected':''?> value="yesterday">Yesterday</option>
<option <?= ($sqlviewreport['reportperiod']=='lastweek')?'selected':''?> value="lastweek">Last Week</option>
<option <?= ($sqlviewreport['reportperiod']=='lastmonth')?'selected':''?> value="lastmonth">Last Month</option>
<option <?= ($sqlviewreport['reportperiod']=='lastquarter')?'selected':''?> value="lastquarter">Last Quarter</option>
<option <?= ($sqlviewreport['reportperiod']=='lastyear')?'selected':''?> value="lastyear">Last Year</option>
</select>
</div>
<script type="text/javascript">
$(document).ready(function() {
reportperiodfun("<?=$sqlviewreport['reportperiod']?>");
});
function reportperiodfun(val) {
  var selectedValue = val;
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(1990);
      // endDate.setDate(endDate.getDate() - 1);
      break;
    case "thisweek":
      startDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() - startDate.getDay());
      endDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() + 6);
      break;
    case "thismonth":
      startDate.setDate(1);
      endDate.setMonth(endDate.getMonth() + 1, 0);
      break;
    case "thisquarter":
      startDate = new Date(startDate.getFullYear(), Math.floor(startDate.getMonth() / 3) * 3, 1);
      endDate = new Date(startDate.getFullYear(), Math.floor(startDate.getMonth() / 3) * 3 + 3, 0);
      break;
    case "thisyear":
      startDate = new Date(startDate.getFullYear(), 0, 1);
      endDate = new Date(startDate.getFullYear(), 11, 31);
      break;
    case "yesterday":
      startDate.setDate(startDate.getDate() - 1);
      endDate.setDate(endDate.getDate() - 1);
      break;
    case "lastweek":
      startDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() - startDate.getDay() - 7);
      endDate = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate() - startDate.getDay() + 6);
      break;
    case "lastmonth":
      startDate = new Date(startDate.getFullYear(), startDate.getMonth() - 1, 1);
      endDate = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 0);
      break;
    case "lastquarter":
      startDate = new Date(startDate.getFullYear(), Math.floor(startDate.getMonth() / 3) * 3 - 3, 1);
      endDate = new Date(startDate.getFullYear(), Math.floor(startDate.getMonth() / 3) * 3 + 3, 0);
      break;
    case "lastyear":
      startDate = new Date(startDate.getFullYear() - 1, 0, 1);
      endDate = new Date(startDate.getFullYear() , 11, 31);
      break;
    default:
      // Default to "Today"
      break;
  }

  $("#from").val(formatDateSwitch(startDate));
  $("#to").val(formatDateSwitch(endDate));
}

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  (day < 10 ? '0' : '') + day + '-' + (month < 10 ? '0' : '') + month + '-' + year ;
}
</script>
<div class="col-lg-3 mb-1">
<input type="text" class="form-control form-control-sm" readonly style="background-color: #e9ecef;" id="from" name="from">
</div>
<div class="col-lg-1 m-0 p-0" style="text-align:center;">
To
</div>
<div class="col-lg-3 mb-1">
<input type="text" class="form-control form-control-sm" readonly style="background-color: #e9ecef;" id="to" name="to">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="customizerowcolumn">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#customizerowcolumns" aria-expanded="true" aria-controls="customizerowcolumns">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Rows / Columns</a>
</div>
</button>
</h5>
<div id="customizerowcolumns" class="accordion-collapse collapse show" aria-labelledby="customizerowcolumn">
<div class="accordion-body text-sm">
<div class="row justify-content-center">
<div class="col-lg-8">
<p style="font-size:16px !important;margin-bottom: -3px !important;">Select and Reorder Columns</p>
<?php
$newans=array();
$sqlreportaccess=mysqli_query($con, "select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='ouw' and createdid='$companymainid' order by id  asc");
while($inforeportaccess=mysqli_fetch_array($sqlreportaccess)){
$ans = $inforeportaccess['rowcolumns'];
$newans = explode(',',$ans);
}
$newmodules=array();
$sqlreportmodules=mysqli_query($con, "select * from pairreportmodules where types='ouw' order by id  asc");
while($inforeportmodules=mysqli_fetch_array($sqlreportmodules)){
$ansmodules = $inforeportmodules[2];
$newmodules = explode(',',$ansmodules);
}
foreach ($newmodules as $newmoduleskey) {
$coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
<div class="row" style="padding-left: 0px !important;">
<div class="col-lg-6 my-1" style="padding-left: 0px !important;">
<div class="custom-control custom-checkbox mr-sm-2" style="padding: 0px 12px !important;">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>ouw" id="<?= $coltypemod; ?>ouw" checked disabled>
<label class="custom-control-label custom-label" for="<?= $coltypemod; ?>ouw"> <?= str_replace(" or ", " / ",$newmoduleskey) ?></label>
</div>
</div>                  
</div>
</div>
<?php
}
?>
<!-- <div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="memoordescription" id="memoordescription" checked>
<label class="custom-control-label custom-label" for="memoordescription"> Memo / Description</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="amount" id="amount" checked>
<label class="custom-control-label custom-label" for="amount"> Amount</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="duedate" id="duedate" checked>
<label class="custom-control-label custom-label" for="duedate"> Due Date</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="openbalance" id="openbalance" checked>
<label class="custom-control-label custom-label" for="openbalance"> Open Balance</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="createdate" id="createdate" checked>
<label class="custom-control-label custom-label" for="createdate"> Create Date</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="lastmodifyby" id="lastmodifyby" checked>
<label class="custom-control-label custom-label" for="lastmodifyby"> Last Modified By</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="createdby" id="createdby" checked>
<label class="custom-control-label custom-label" for="createdby"> Created By</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="lastmodify" id="lastmodify" checked>
<label class="custom-control-label custom-label" for="lastmodify"> Last Modified</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="account" id="account" checked>
<label class="custom-control-label custom-label" for="account"> Account</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="shippingaddress" id="shippingaddress" checked>
<label class="custom-control-label custom-label" for="shippingaddress"> Shipping Address</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="customerorvendormessage" id="customerorvendormessage" checked>
<label class="custom-control-label custom-label" for="customerorvendormessage"> Customer / Vendor Message</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="billingaddress" id="billingaddress" checked>
<label class="custom-control-label custom-label" for="billingaddress"> Billing Address</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="terms" id="terms" checked>
<label class="custom-control-label custom-label" for="terms"> Terms</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="deliveryaddress" id="deliveryaddress" checked>
<label class="custom-control-label custom-label" for="deliveryaddress"> Delivery Address</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="sent" id="sent" checked>
<label class="custom-control-label custom-label" for="sent"> Sent</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="taxableamount" id="taxableamount" checked>
<label class="custom-control-label custom-label" for="taxableamount"> Taxable Amount</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="salesprinted" id="salesprinted" checked>
<label class="custom-control-label custom-label" for="salesprinted"> Sales Printed</label>
</div>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<div class="input-group input-group-sm" id="flaghead">
<div class="input-group-prepend">
<span class="input-group-text" style="height:28px !important;border: 0px !important;padding-left: 0px !important;padding-right: 33px !important;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom">
<circle cx="153.6" cy="451" r="61"></circle>
<circle cx="153.6" cy="256" r="61"></circle>
<circle cx="153.6" cy="61" r="61"></circle>
<circle cx="358.4" cy="256" r="61"></circle>
<circle cx="358.4" cy="61" r="61"></circle>
<circle cx="358.4" cy="451" r="61"></circle>
</svg>
</span>
</div>
<input type="checkbox" class="custom-control-input" name="taxamount" id="taxamount" checked>
<label class="custom-control-label custom-label" for="taxamount"> Tax Amount</label>
</div>
</div>                  
</div>
</div> -->
</div>
</div>

</div>
</div>
</div>
</div>

<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="filter">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#filters" aria-expanded="true" aria-controls="filters">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Filter</a>
</div>
</button>
</h5>
<div id="filters" class="accordion-collapse collapse show" aria-labelledby="filter">
<div class="accordion-body text-sm">

<div class="row justify-content-center">
<div class="col-lg-8">
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="filtername" id="filtername" checked disabled>
<label class="custom-control-label custom-label" for="filtername"> Customer(PRIVATE)</label>
</div>                  
</div>
<div class="col-lg-6">
<select class="form-control form-control-sm select4" disabled>
<option>All</option>
</select>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headerorfooter">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#headerorfooters" aria-expanded="true" aria-controls="headerorfooters">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Header / Footer</a>
</div>
</button>
</h5>
<div id="headerorfooters" class="accordion-collapse collapse show" aria-labelledby="headerorfooter">
<div class="accordion-body text-sm">

<div class="row justify-content-center">
<div class="col-lg-8">
<p style="font-size:16px !important;margin-bottom: -7px !important;">Header</p>
<div class="row mb-1">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="companyname" id="companyname" <?= ($sqlviewreport['companyname']=='1')?'checked':''?>>
<label class="custom-control-label custom-label" for="companyname"> Company Name</label>
</div>                  
</div>
<div class="col-lg-6">
<input type="text" value="<?= $branch['franchisename'] ?>" class="form-control form-control-sm" readonly style="background-color: #e9ecef;">
</div>
</div>
<p style="font-size:16px !important;margin-bottom: -3px !important;">Footer</p>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="dateprepare" id="dateprepare" <?= ($sqlviewreport['dateprepare']=='1')?'checked':''?>>
<label class="custom-control-label custom-label" for="dateprepare"> Date Prepared</label>
</div>                  
</div>
</div>
<div class="row">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="timeprepare" id="timeprepare" <?= ($sqlviewreport['timeprepare']=='1')?'checked':''?>>
<label class="custom-control-label custom-label" for="timeprepare"> Time Prepared</label>
</div>                  
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="advancedrules">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#advancedruless" aria-expanded="true" aria-controls="advancedruless">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Advanced</a>
</div>
</button>
</h5>
<div id="advancedruless" class="accordion-collapse collapse show" aria-labelledby="advancedrules">
<div class="accordion-body text-sm">
  
<div class="row justify-content-center">
<div class="col-lg-8">
<p style="font-size:16px !important;margin-bottom: -7px !important;">Validation Rule</p>
<div class="row mb-1">
<div class="col-lg-6 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="gstrule" id="gstrule" <?= ($sqlviewreport['gstrule']=='1')?'checked':''?>>
<label class="custom-control-label custom-label" for="gstrule"> If the invoice does not contain a GSTIN, it will be forwarded to the consumer for display and calculation. Conversely, if the invoice contains a GSTIN, it will be directed to the registered persons for display and calculation.</label>
</div>                  
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

</div>
<div class="modal-footer mfsub" style="margin: 0px 9px -16px 9px !important;border-top: 1px solid #b6bcc5 !important;">
<div class="col">
<button onclick="funaddcustomizes()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit"  name="submitcustomizes" id="submitcustomizes" value="Submit">
<span class="label">Run Report</span> <span class="spinner"></span>
</button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funescustomizes()">Cancel</button> </div>
</div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
function funescustomizes() {
  $("#Customizesmodal").modal("hide");
}
</script>
<!-- Customization modal end -->
<a style="margin:4.5px 4.5px !important;" class="btn btn-primary btn-sm btn-custom-grey" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="converHTMLFileToPDF()"><i class="fa fa-print" aria-hidden="true"></i> <span class="mobreswords "> Print</span></a>
<!-- Print Report Modal Preview Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel" style="font-weight: normal;">Preview</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" id="pdfObj">
<img src="loading.gif" alt="Loading..." id="loadimgobj">
</div>
<div class="modal-footer" style="margin-top: 33px !important;">
<a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>    
</div>
</div>
</div>
</div>
<!-- Print Report Modal Preview End -->
<a style="margin:4.5px 4.5px !important;" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-primary btn-sm btn-custom-grey" onclick="downloadpdf()"><i class="fa fa-download" aria-hidden="true"></i> <span class="mobreswords "> Download &nbsp; <i class="fa fa-caret-down" style="font-size:10px !important;"></i></span></a>
<!-- Print Report Modal Download Start -->
<div class="modal fade" id="exampleModaldownload" tabindex="-1" role="dialog" aria-labelledby="downloadexampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="downloadexampleModalLabel" style="font-weight: normal;">Download</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" id="pdfObjdownload">
<img src="loading.gif" alt="Loading..." id="loadimgobj" style="width:100px">
</div>
<div class="modal-footer" style="margin-top: 33px !important;">
<a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>    
</div>
</div>
</div>
</div>
<!-- Print Report Modal Download End -->
<div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownMenuButton1">
<i class="fa fa-caret-down" id="reparup" style="color: #3c3c46 !important;position: relative;top: -13px;left: 240px;"></i>
<div style="background-color: #3c3c46;margin-top: 10px !important;">
<script type="text/javascript">
function downloadpdf(){
document.getElementById('reparup').style.animation = "repone 2s 3000000";
}
</script>
<style type="text/css">
.macsyl{
animation-name: repone;
animation-duration: 1.5s;
animation-iteration-count: infinite;
animation-timing-function: linear;
}
@keyframes repone {
from {
transform:rotate(0deg);
}
to {
transform:rotate(180deg);
}
}
@media screen and (max-width: 1199px){
#reparup{
margin-left: -8.9px !important;
}
}
</style>
<a class="nav-link" href="#" style="color: #fff;margin-top: -30px;" onclick="downloadaspdf()">
<i class="fa-solid fa-file-pdf"></i>
<span class="nav-link-text ms-2"> PDF (Portable Document Format)</span>
</a>
<a class="nav-link" href="#" style="color: #fff;" onclick="downloadascsv()" id="csvdownopt">
<i class="fa-sharp fa-solid fa-file-csv"></i>
<span class="nav-link-text ms-2"> CSV (Comma Seperated Values)</span>
</a>
</div>
</div>
</div>
</div>
<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
            <div class="customcont-header ml-0">
                <a class="customcont-heading">Overview</a>  
            </div>
        </button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
            <div class="customcont-header ml-0">
                <a class="customcont-heading">History</a>   
            </div>
        </button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  <div class="table-responsive m-3" id="histables">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="border:1px solid #ddd !important;color: grey !important;font-weight: 600 !important;">DATE
          </th>
          <th style="border:1px solid #ddd !important;color: grey !important;font-weight: 600 !important;">DETAILS
          </th>
        </tr>
      </thead>
      <tbody>
      <?php
      $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='REPouw' and useid='$companymainid' order by createdon desc");
      while($infouse=mysqli_fetch_array($sqluse))
      {
      ?>
        <tr>
          <td data-label="DATE" id="datehis"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
          <td data-label="DETAILS"><?=str_replace('?', $resmaincurrencyans[0], $infouse['useremarks'])?> <br><span>Generated By</span><span  id="chhis"> <?=$infouse['createdby']?></span></td>
        </tr>
      <?php
      }
      ?>
      </tbody>
    </table>
  </div>
</div>
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<div class="container mt-1 mb-3">
<div class="row d-flex justify-content-center mt-5">
<div class="col-lg-8 col-md-12 justify-content-center">
<div class="card" id="zoomforprint"  style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding:10px; width:max-content;height: max-content;padding-bottom: 0px !important;" align="center">
<div class="table-responsive" style="width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;">
<table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 21cm !important;height: 29cm !important;max-width:21cm !important; max-height:29cm !important;min-width:21cm !important; min-height:29cm !important;">

<tr>
<td width="100%" style="height:10px !important;">
<table width="100%" style="text-align: center;font-weight: bold;">
<tr>
<td style="<?= ($sqlviewreport['companyname']=='1')?'':'display: none;'?>"><?= $branch['franchisename'] ?></td>
</tr>
<tr>
<td>Summary of Outward Supplies (GSTR-1)</td>
</tr>
<tr>
<td id="datefromto"></td>
</tr>
</table>
</td>
</tr>
<?php
$invfrom = mysqli_real_escape_string($con, $_GET['invfrom']);
$invto = mysqli_real_escape_string($con, $_GET['invto']);
?>
<input type="hidden" name="invfrom" id="invfrom" value="<?= $invfrom ?>">
<input type="hidden" name="invto" id="invto" value="<?= $invto ?>">
<tr style="height:1px;">
<td width="100%" style="padding:10px;">
<div style="height: 975px;">
<table id="print-are1" style="border: 1px solid #eee;" width="100%">
<thead>
<tr>
<td class="text-uppercase" style="width:40%;border:1px solid #eee;padding-left: 10px;"><span style="font-size:13px;color:black;"> Description</span></td>
<td class="text-uppercase" style="text-align: right !important;width: 14%;border:1px solid #eee;padding-right: 10px;"><span style="font-size:13px;color:black;"> IGST Amount</span></td>
<td class="text-uppercase" style="text-align: right !important;width: 15%;border:1px solid #eee;padding-right: 10px;"><span style="font-size:13px;color:black;"> CGST Amount</span></td>
<td class="text-uppercase" style="text-align: right !important;width: 15%;border:1px solid #eee;padding-right: 10px;"><span style="font-size:13px;color:black;"> SGST Amount</span></td>
<td class="text-uppercase" style="text-align: right !important;width: 16%;border:1px solid #eee;padding-right: 10px;"><span style="font-size:13px;color:black;"> <?=$infomainaccessuserinv["modulename"]?> Total</span></td>
</tr>
</thead>
<tbody id="myTable">
<?php
$sqlregister=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (invoicedate>='".$invfrom."' and invoicedate<='".$invto."') and cancelstatus='0' GROUP BY invoicedate, invoiceno");
$registerigst = 0;
$registercgst = 0;
$registersgst = 0;
$registerinvoicetotal = 0;
while($register=mysqli_fetch_array($sqlregister)){
$anstax = $register['tax'];
$anscgst = $register['cgst'];
$anssgst = $register['sgst'];
$ansigst = $register['igst'];
$ansgst = $register['gst'];
$ansgstpercent = $register['gstpercent'];
$anscsgstpercent = $register['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
for ($i=1; $i <count($newtaxes) ; $i++) {
$registerposics=$register['pos'];
$registerfranposics=$franpos;
if($registerposics=="")
{
$registerposics="TAMIL NADU (33)";
}
if($registerfranposics=="")
{
$registerfranposics="TAMIL NADU (33)";
}
if($registerposics!=$registerfranposics)
{
$registerigst += $newgst[$i];
$registercgst += 0.00;
$registersgst += 0.00;
}
else{
$registerigst += 0.00;
$registercgst += $newcgst[$i];
$registersgst += $newsgst[$i];
}
$registerinvoicetotal += $register['grandtotal'];
}
}
if($registerinvoicetotal!=0){
?>
<tr onclick="window.open('outwardreportregistered.php?invfrom=<?=$invfrom?>&invto=<?=$invto?>','_self')">
<td data-label="DESCRIPTION" style="border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 295px;min-width: 295px;white-space: nowrap;overflow: hidden;color: royalblue;">Taxable outward supplies made to registered persons</span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($registerigst>0)?'color:royalblue;':'color:black;') ?>"><?= (($registerigst==0)?number_format((float)0,2,'.',','):number_format((float)$registerigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($registercgst>0)?'color:royalblue;':'color:black;') ?>"><?= (($registercgst==0)?number_format((float)0,2,'.',','):number_format((float)$registercgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($registersgst>0)?'color:royalblue;':'color:black;') ?>"><?= (($registersgst==0)?number_format((float)0,2,'.',','):number_format((float)$registersgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($registerinvoicetotal>0)?'color:royalblue;':'color:black;') ?>"><?= (($registerinvoicetotal==0)?number_format((float)0,2,'.',','):number_format((float)$registerinvoicetotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
}
$sqlconsumer=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (invoicedate>='".$invfrom."' and invoicedate<='".$invto."') and cancelstatus='0' GROUP BY invoicedate, invoiceno");
$consumerigst = 0;
$consumercgst = 0;
$consumersgst = 0;
$consumerinvoicetotal = 0;
while($consumer=mysqli_fetch_array($sqlconsumer)){
$anstax = $consumer['tax'];
$anscgst = $consumer['cgst'];
$anssgst = $consumer['sgst'];
$ansigst = $consumer['igst'];
$ansgst = $consumer['gst'];
$ansgstpercent = $consumer['gstpercent'];
$anscsgstpercent = $consumer['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
for ($i=1; $i <count($newtaxes) ; $i++) {
$consumerposics=$consumer['pos'];
$consumerfranposics=$franpos;
if($consumerposics=="")
{
$consumerposics="TAMIL NADU (33)";
}
if($consumerfranposics=="")
{
$consumerfranposics="TAMIL NADU (33)";
}
if($consumerposics!=$consumerfranposics)
{
$consumerigst += $newgst[$i];
$consumercgst += 0.00;
$consumersgst += 0.00;
}
else{
$consumerigst += 0.00;
$consumercgst += $newcgst[$i];
$consumersgst += $newsgst[$i];
}
$consumerinvoicetotal += $consumer['grandtotal'];
}
}
if($consumerinvoicetotal!=0){
?>
<tr onclick="window.open('outwardreportconsumer.php?invfrom=<?=$invfrom?>&invto=<?=$invto?>','_self')">
<td data-label="DESCRIPTION" style="border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 295px;min-width: 295px;white-space: nowrap;overflow: hidden;color: royalblue;">Taxable outward supplies to consumer</span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($consumerigst>0)?'color:royalblue;':'color:black;') ?>"><?= (($consumerigst==0)?number_format((float)0,2,'.',','):number_format((float)$consumerigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($consumercgst>0)?'color:royalblue;':'color:black;') ?>"><?= (($consumercgst==0)?number_format((float)0,2,'.',','):number_format((float)$consumercgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($consumersgst>0)?'color:royalblue;':'color:black;') ?>"><?= (($consumersgst==0)?number_format((float)0,2,'.',','):number_format((float)$consumersgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($consumerinvoicetotal>0)?'color:royalblue;':'color:black;') ?>"><?= (($consumerinvoicetotal==0)?number_format((float)0,2,'.',','):number_format((float)$consumerinvoicetotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
}
$sqlhsn=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (invoicedate>='".$invfrom."' and invoicedate<='".$invto."') and cancelstatus='0' GROUP BY invoicedate, invoiceno");
$hsnigst = 0;
$hsncgst = 0;
$hsnsgst = 0;
$hsninvoicetotal = 0;
while($hsn=mysqli_fetch_array($sqlhsn)){
$anstax = $hsn['tax'];
$anscgst = $hsn['cgst'];
$anssgst = $hsn['sgst'];
$ansigst = $hsn['igst'];
$ansgst = $hsn['gst'];
$ansgstpercent = $hsn['gstpercent'];
$anscsgstpercent = $hsn['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
for ($i=1; $i <count($newtaxes) ; $i++) {
$hsnposics=$hsn['pos'];
$hsnfranposics=$franpos;
if($hsnposics=="")
{
$hsnposics="TAMIL NADU (33)";
}
if($hsnfranposics=="")
{
$hsnfranposics="TAMIL NADU (33)";
}
if($hsnposics!=$hsnfranposics)
{
$hsnigst += $newgst[$i];
$hsncgst += 0.00;
$hsnsgst += 0.00;
}
else{
$hsnigst += 0.00;
$hsncgst += $newcgst[$i];
$hsnsgst += $newsgst[$i];
}
$hsninvoicetotal += $hsn['grandtotal'];
}
}
if($hsninvoicetotal!=0){
?>
<tr onclick="window.open('outwardreporthsn.php?invfrom=<?=$invfrom?>&invto=<?=$invto?>','_self')">
<td data-label="DESCRIPTION" style="border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 295px;min-width: 295px;white-space: nowrap;overflow: hidden;color: royalblue;">HSN-wise summary of outward supplies</span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($hsnigst>0)?'color:royalblue;':'color:black;') ?>"><?= (($hsnigst==0)?number_format((float)0,2,'.',','):number_format((float)$hsnigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($hsncgst>0)?'color:royalblue;':'color:black;') ?>"><?= (($hsncgst==0)?number_format((float)0,2,'.',','):number_format((float)$hsncgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($hsnsgst>0)?'color:royalblue;':'color:black;') ?>"><?= (($hsnsgst==0)?number_format((float)0,2,'.',','):number_format((float)$hsnsgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span style="<?= (($hsninvoicetotal>0)?'color:royalblue;':'color:black;') ?>"><?= (($hsninvoicetotal==0)?number_format((float)0,2,'.',','):number_format((float)$hsninvoicetotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
}
if ($registerinvoicetotal==0) {
?>
<div style="text-align: center;position: relative;top: 75px;margin-bottom: -25px;">There are no transactions in registered during the selected date range</div>
<?php
}
if ($consumerinvoicetotal==0) {
?>
<div style="text-align: center;position: relative;top: 106px;margin-bottom: -25px;">There are no transactions in consumer during the selected date range</div>
<?php
}
if ($hsninvoicetotal==0) {
?>
<div style="text-align: center;position: relative;top: 139px;margin-bottom: -25px;">There are no transactions in hsn during the selected date range</div>
<?php
}
?>
</tbody>
</table>
</div>
</td>
</tr>
<tr style="height:40px !important;">
<td style="padding:0px !important;border-bottom: none;">
<table width="100%">
<tr>
<td width="30%" style="padding: 0px !important;border-right: 1px solid #cccccc;font-weight: bold;">
<table width="100%">
<tr>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s A';
    }
if (($sqlviewreport['dateprepare']=='1')&&($sqlviewreport['timeprepare']=='1')) {
  $date = 'd/m/Y h:i:s A';
  $dates = date('d-m-Y h:i:s A');
}
elseif ($sqlviewreport['dateprepare']!='1') {
  $date = 'h:i:s A';
  $dates = date('h:i:s A');
}
elseif ($sqlviewreport['timeprepare']!='1') {
  $date = 'd/m/Y';
  $dates = date('d-m-Y');
}
    ?>
<td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;">
<div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;<?=(($sqlviewreport['timeprepare']=='1'||$sqlviewreport['dateprepare']=='1')?'':'display: none;')?>"><span>Printed On : <?php echo date($date,strtotime($dates))?></span></div>
<div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page <span class="pagesforcurrent" style="padding: 0px 3px;">1</span>/1)</b></div>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
  <td></td>
</tr>
</table>
<span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span>
</div>
<style type="text/css">
.insidecard{
    width: max-content !important;
    height: max-content !important;
}
@supports (not (-moz-appearance:button)) and (contain:paint) and (-webkit-appearance:none) { 
    @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    zoom: 20% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    margin-left: -15px !important;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    zoom: 21% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    zoom: 22% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 300px) {
                #zoomforprint{
                    zoom: 23% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 301px) and (max-device-width: 310px) {
                #zoomforprint{
                    zoom: 25% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 78% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 311px) and (max-device-width: 320px) {
                #zoomforprint{
                    zoom: 27% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 81% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    zoom: 28% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 86% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 340px) {
                #zoomforprint{
                    zoom: 30% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 90% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 341px) and (max-device-width: 350px) {
                #zoomforprint{
                    zoom: 31% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 360px) {
                #zoomforprint{
                    zoom: 33% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 361px) and (max-device-width: 370px) {
                #zoomforprint{
                    zoom: 34% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 371px) and (max-device-width: 380px) {
                #zoomforprint{
                    zoom: 35% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 390px) {
                #zoomforprint{
                    zoom: 36% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 391px) and (max-device-width: 400px) {
                #zoomforprint{
                    zoom: 38% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 410px) {
                #zoomforprint{
                    zoom: 40% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 411px) and (max-device-width: 420px) {
                #zoomforprint{
                    zoom: 41% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 421px) and (max-device-width: 430px) {
                #zoomforprint{
                    zoom: 42% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 431px) and (max-device-width: 440px) {
                #zoomforprint{
                    zoom: 44% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 441px) and (max-device-width: 450px) {
                #zoomforprint{
                    zoom: 45% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 451px) and (max-device-width: 460px) {
                #zoomforprint{
                    zoom: 46% !important;
                    margin-left: -48px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 470px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -48px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 471px) and (max-device-width: 490px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -40px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -20px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 510px) {
                #zoomforprint{
                    zoom: 49% !important;
                    margin-left: -10px !important;
                }
                #templatetext{
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 511px) and (max-device-width: 530px) {
                #zoomforprint{
                    zoom: 49% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 531px) and (max-device-width: 540px) {
                #zoomforprint{
                    zoom: 50% !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 541px) and (max-device-width: 550px) {
                #zoomforprint{
                    zoom: 52% !important;
                }
                #templatetext{
                    margin-right: -3px !important;
                }
            }
            @media screen and (min-device-width: 551px) and (max-device-width: 560px) {
                #zoomforprint{
                    zoom: 53% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 561px) and (max-device-width: 570px) {
                #zoomforprint{
                    zoom: 54% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 571px) and (max-device-width: 580px) {
                #zoomforprint{
                    zoom: 55% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 581px) and (max-device-width: 590px) {
                #zoomforprint{
                    zoom: 56% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 591px) and (max-device-width: 600px) {
                #zoomforprint{
                    zoom: 57% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 610px) {
                #zoomforprint{
                    zoom: 58% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 611px) and (max-device-width: 620px) {
                #zoomforprint{
                    zoom: 59% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 621px) and (max-device-width: 767px) {
                #zoomforprint{
                    zoom: 61% !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 768px) and (max-device-width: 991px) {
                #zoomforprint{
                    zoom: 80% !important;
                }
            }
            @media screen and (min-device-width: 768.5px) and (max-device-width: 790px) {
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 830px) and (max-device-width: 991.7px) {
                #zoomforprint{
                    margin-left: 25px !important;
                }
            }
            @media screen and (min-device-width: 791px) and (max-device-width: 990.5px) {
                #templatetext{
                    margin-right: 25px !important;
                }
            }
            @media screen and (min-device-width: 992px) and (max-device-width: 1020px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -123px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1021px) and (max-device-width: 1199px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1220px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -111px !important;
                }
            }
            @media screen and (min-device-width: 1221px) and (max-device-width: 1250px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -100px !important;
                }
                #templatetext{
                    margin-right: -100px !important;
                }
            }
            @media screen and (min-device-width: 1251px) and (max-device-width: 1290px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -90px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1291px) and (max-device-width: 1330px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -80px !important;
                }
                #templatetext{
                    margin-right: -80px !important;
                }
            }
            @media screen and (min-device-width: 1331px) and (max-device-width: 1360px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -70px !important;
                }
                #templatetext{
                    margin-right: -70px !important;
                }
            }
            @media screen and (min-device-width: 1361px) and (max-device-width: 1400px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    margin-right: -60px !important;
                }
            }
            @media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: -54px !important;
                }
            }
            @media screen and (min-device-width: 1501px) and (max-device-width: 1549px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: -45px !important;
                }
            }
            @media screen and (min-device-width: 1550px) and (max-device-width: 3000px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: 27px !important;
                }
            }
        }
</style>
</div>
<p align="right" class="mt-3" style="margin-right:-25px; cursor:pointer" id="templatetext">Template: 'Standard A4 Portrait' <a data-bs-toggle="modal" data-bs-target="#changeModal" class="text-blue">Change</a></p>
<?php
// $sqltotlist = mysqli_query($con,"select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and gstrtype='Registered Business - Regular' and (invoicedate>='".$invfrom."' and invoicedate<='".$invto."')");
$chekcs=0;
// while($sqlfetlist = mysqli_fetch_array($sqltotlist)){
// $chekcs++;
// }
if ($chekcs==0) {
$pageinitnum = 0;
}
if ($chekcs!=0) {
$pageinitnum = 1;
}
if (($chekcs>=1)&&($chekcs<=40)) {
$pagetotnum = 1;
}
else if (($chekcs==0)) {
$pagetotnum = 0;
}
else{
$pagetotnum = ceil($chekcs/40);
}
?>
<input type="hidden" value="10" id="limitforpagenum">
<input type="hidden" value="<?=$pagetotnum?>" id="totalpagenums">
<div id="pagenumcontainer" style="padding: 24px;text-align: center;">
</div>
<script>
const mountNode = document.getElementById('pagenumcontainer');
"use strict";
const { createRoot } = ReactDOM;
const { Pagination } = antd;
// Total ${range[0]} - ${range[1]} of ${total} (Datas)
const App = () => (React.createElement(Pagination, { total: <?=ceil($chekcs)?>, showSizeChanger: false, showQuickJumper: true, showTotal: (total, range) => `Total ${range[0]} - ${range[1]} of ${total} items`,
        onChange: pagechanges,defaultPageSize: 6 }));
const ComponentDemo = App;
createRoot(mountNode).render(React.createElement(ComponentDemo, null));
const pagechanges = (page, pageSize) => {
// alert('Page changed to'+ page+'Items per page:'+ pageSize);
$('#limitforpagenum').val(parseInt(pageSize));
var totalpagesnumber = <?=ceil($chekcs/6)?>;
if ((page=='')||(page==0)) {
var isthisval = 1;
}
else if(page>totalpagesnumber){
var isthisval = totalpagesnumber;
}
else{
var isthisval = page;
}
var perpages = ''+((parseInt(isthisval)-1)*6);

// ajax for get
$.ajax({
type: "GET",
url: 'reportviewsearch.php?term='+perpages+'&limitings='+($('#limitforpagenum').val())+'&invfrom=<?=$invfrom?>&invto=<?=$invto?>&dif=outward',
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
</div>
</div>
</div>
</div>
</div>

<table id="print-are3" style="border: 1px solid #eee;display: none;" width="100%">
<thead>
<tr>
<td class="text-uppercase" style="width:40%;border:1px solid #eee;padding-left: 10px;"><span style="font-size:13px;color:black;"> Description</span></td>
<td class="text-uppercase" style="text-align: right !important;width: 14%;border:1px solid #eee;padding-right: 10px;"><span style="font-size:13px;color:black;"> IGST Amount</span></td>
<td class="text-uppercase" style="text-align: right !important;width: 15%;border:1px solid #eee;padding-right: 10px;"><span style="font-size:13px;color:black;"> CGST Amount</span></td>
<td class="text-uppercase" style="text-align: right !important;width: 15%;border:1px solid #eee;padding-right: 10px;"><span style="font-size:13px;color:black;"> SGST Amount</span></td>
<td class="text-uppercase" style="text-align: right !important;width: 16%;border:1px solid #eee;padding-right: 10px;"><span style="font-size:13px;color:black;"> <?=$infomainaccessuserinv["modulename"]?> Total</span></td>
</tr>
</thead>
<tbody id="myTables">
</tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="changeModalLabel">Choose Template</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<!-------------->
<table width="100%">
<tr>
<td width="30%" style="text-align:center">
 <div class="imgcontainer" id="standardcontainer">
  <img src="a4.png" id="standardimg" alt="Snow" onclick="standandclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;border: 1px solid #1BBC9B;opacity: 0.5;">
  <div class="centered" id="standardtext" style="display:block;"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">Standard A4 Portrait</p>
</td>
</tr>
</table>
<!-------------->
</div>
<div class="modal-footer" style="margin-top: 33px !important;">
<a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>       
</div>
</div>
</div>
</div>
<!-- modal -->
</div>

</form>

      <?php
      include('footer.php');
      ?>
    </div>
  
    </main>
 <?php
 include('fexternals.php');
 ?>
<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<script>
$(function() {
  var start = moment().subtract(29, 'days');
  var end = moment();
  var quarter = moment().quarter();
  $('#calendars').daterangepicker({
    "showDropdowns": true,
    "opens": "center",
    startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'This Week': [moment().startOf('week'), moment().endOf('week')],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'This Quarter': [moment().quarter(quarter).startOf('quarter'), moment().quarter(quarter).endOf('quarter')],
           'This Year': [moment().startOf('year'), moment().endOf('year')],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
    'Last Quarter': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
           'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
        },
           // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    "linkedCalendars": false,
        "alwaysShowCalendars": true,        
    "applyClass": "btn-custom",
    "cancelClass": "btn-custom-grey"
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    let startspace = start.format('DD MM YYYY');
    let startslice = startspace.split(" ");
    let startfinalday = startslice[0];
    const startmonth = new Date(startslice[1]);
    const startmonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    let startfinalmonths = startmonths[startmonth.getMonth()];
    let startfinalmonth = startfinalmonths;
    let startfinalyear = startslice[2];
    // alert(startfinalday + " " + startfinalmonth + " " + startfinalyear);
    
    let endspace = end.format('DD MM YYYY');
    let endslice = endspace.split(" ");
    let endfinalday = endslice[0];
    const endmonth = new Date(endslice[1]);
    const endmonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    let endfinalmonths = endmonths[endmonth.getMonth()];
    let endfinalmonth = endfinalmonths;
    let endfinalyear = endslice[2];
    // alert(endfinalday + " " + endfinalmonth + " " + endfinalyear);

    $("#datefromto").html("From " + startfinalday + " " + startfinalmonth + " " + startfinalyear + ' To ' + endfinalday + " " + endfinalmonth + " " + endfinalyear);
    $("#invfrom").val(start.format('YYYY-MM-DD'));
    $("#invto").val(end.format('YYYY-MM-DD'));
    let invfrom = $("#invfrom").val();
    let invto = $("#invto").val();
    window.open("outwardreport.php?invfrom="+invfrom+"&invto="+invto+"","_self");
  });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
let invfrom = $("#invfrom").val();
let invto = $("#invto").val();
const startmonth = new Date(invfrom);
const startmonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
let startfinalmonths = startmonths[startmonth.getMonth()];
let startday = startmonth.getDate();
let startyear = startmonth.getFullYear();
const endmonth = new Date(invto);
const endmonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
let endfinalmonths = endmonths[endmonth.getMonth()];
let endday = endmonth.getDate();
let endyear = endmonth.getFullYear();
// alert(day+ " " + startfinalmonths + " " +year);
$("#datefromto").html("From " + startday + " " + startfinalmonths + " " + startyear + ' To ' + endday + " " + endfinalmonths + " " + endyear);
})
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script> -->
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script type="text/javascript">
function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('printarea');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
    }
</script>
<script src="pdf/examples/libs/jspdf.umd.js"></script>
<script src="pdf/examples/mitubachi-normal.js"></script>

<script src="pdf/examples/libs/faker.min.js"></script>
<script src="pdf/dist/jspdf.plugin.autotable.js"></script>

<script src="pdf/examples/examples.js"></script>
<script>

function converHTMLFileToPDF() {
$("#myTables").html("");
<?php
$sqlbranch=mysqli_query($con, "select franchisename from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$branch=mysqli_fetch_array($sqlbranch);
// $sqllimit=mysqli_query($con, "select count(distinct invoiceno) as countoftotal from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and gstrtype='Registered Business - Regular' and (invoicedate>='".$invfrom."' and invoicedate<='".$invto."')");
// $sqllimits = mysqli_fetch_array($sqllimit);
?>
var fromtopdf = document.getElementById("datefromto").innerHTML;
var mytabprev = '';
$("#loadimgobj").css("display","block");
$('#pdfObj').html('<div class="text-center"><span id="timer">Please wait <span id="time"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');

  sIndex = 0;
  dt = 5000;
var countering = 1;
var intervaling = setInterval(function() {
  $("body").on("click",function() {
    if ($("#exampleModal").hasClass("show")) {
      console.log("yes");
    }
    else{
        clearInterval(intervaling);
        clearInterval(intervalings);
        clearTimeout(finaltimer);
    }
  });
    if (countering <= 0) {
        clearInterval(intervaling);
        var counterings = 1;
        var percent = 10;
        var intervalings = setInterval(function() {
    counterings--;
    if (counterings <= 0) {
        clearInterval(intervalings);
    $('#timer').html('<div class="progress" style="height:30px !important;text-align:center !important;"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="96" aria-valuemin="0" aria-valuemax="96" style="height:30px !important;width:96%;background-color:#5cb85c !important;">96% completed. Please wait just a few seconds.</div></div>');
  }
  else{
    $('#timer').html('<div class="progress" style="height:30px !important;text-align:center !important;"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="'+percent+'" aria-valuemin="0" aria-valuemax="100" style="height:30px !important;width:'+percent+'%;background-color:#5cb85c !important;">'+percent+'% Completed</div></div>');
    percent+=10;
  }
}, 1000);
var finaltimer = setTimeout(function() 
  {
        var doc = new jspdf.jsPDF('p', 'pt','a4');
        var totalPagesExp = $("#totalpagenums").val();
  
   doc.setFontSize(9);
   doc.setFont(undefined, 'bold');
    var header = function(data) {
    var headtext = "<?= ($sqlviewreport['companyname']=='1')?$branch['franchisename']:''?>";
     var fontSize = doc.internal.getFontSize();
     var pageWidth = doc.internal.pageSize.width;
     txtWidth = doc.getStringUnitWidth(headtext)*fontSize/doc.internal.scaleFactor;
     x = ( pageWidth - txtWidth ) / 2;
     doc.text(headtext,x,35);
    
    var headtext1 = "Summary of Outward Supplies (GSTR-1)";
     var fontSize = doc.internal.getFontSize();
     var pageWidth = doc.internal.pageSize.width;
     txtWidth = doc.getStringUnitWidth(headtext1)*fontSize/doc.internal.scaleFactor;
     x = ( pageWidth - txtWidth ) / 2; 
    doc.text(headtext1, x, 50);
    
    var headtext3 = fromtopdf;
     var fontSize = doc.internal.getFontSize();
     var pageWidth = doc.internal.pageSize.width;
     txtWidth = doc.getStringUnitWidth(headtext3)*fontSize/doc.internal.scaleFactor;
     x = ( pageWidth - txtWidth ) / 2; 
    doc.text(headtext3, x, 65);

    // Footer
      var str = 'Page ' + doc.internal.getNumberOfPages()
      if (typeof doc.putTotalPages === 'function') {
             str = str + " of " + totalPagesExp;
        }
      var pageSize = doc.internal.pageSize
      var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
     var fontSize = doc.internal.getFontSize();
     var pageWidth = doc.internal.pageSize.width;
     txtWidth = doc.getStringUnitWidth(str)*fontSize/doc.internal.scaleFactor;
     x = ( pageWidth - txtWidth ) / 2;
      doc.text(str, x, pageHeight - 23);

    const date = new Date();
    let currentPeriod = date.getHours() >= 12 ? 'PM' : 'AM';
    let currentHour= String((date.getHours()>12)?date.getHours()-12:date.getHours()).padStart(2, '0');
    let currentMinute= String(date.getMinutes()).padStart(2, '0');
    let currentSecond= String(date.getSeconds()).padStart(2, '0');
    let currentDay= String(date.getDate()).padStart(2, '0');
    let currentMonth = String(date.getMonth()+1).padStart(2,"0");
    let currentYear = date.getFullYear();
    let dateprepare = '';
    let timeprepare = '';
    let printedword = '';
    <?php 
    if ($sqlviewreport['dateprepare']=='1') {
    ?>
    dateprepare = `${currentDay}/${currentMonth}/${currentYear}`;
    <?php 
    }
    if ($sqlviewreport['timeprepare']=='1') {
    ?>
    timeprepare = `${currentHour}:${currentMinute}:${currentSecond} ${currentPeriod}`;
    <?php 
    }
    if ($sqlviewreport['timeprepare']=='1'||$sqlviewreport['dateprepare']=='1') {
    ?>
    printedword = 'Printed On : ';
    <?php 
    }
    ?>
    let currentDate = `${printedword} ${dateprepare} ${timeprepare}`;
    var printedon = currentDate;
     var fontSize = doc.internal.getFontSize();
     var pageWidth = doc.internal.pageSize.width;
     txtWidth = doc.getStringUnitWidth(printedon)*fontSize/doc.internal.scaleFactor;
     x = ( pageWidth - txtWidth ) / 2;
    doc.text(printedon, x, pageHeight - 35);
  };
var botforprint = 50;
        doc.autoTable({ html: '#print-are3' ,theme: 'plain',headStyles :{fillColor : [245, 242, 242]},margin: {top: 80,bottom: botforprint},styles: { overflow: "hidden",fontSize: 8,fontStyle: 'normal',halign : 'center',fillColor: [255,255,255],lineColor: [204, 204, 204], lineWidth: 0.1},
              didDrawPage: header, 
              columnStyles: { 
                  0: { halign: 'left', cellWidth: 165},
                  1: { halign: 'right', cellWidth: 87},
                  2: { halign: 'right', cellWidth: 87},
                  3: { halign: 'right', cellWidth: 87},
                  4: { halign: 'right', cellWidth: 87}
              }});
// if (typeof doc.putTotalPages === 'function') { 
//     doc.putTotalPages(totalPagesExp);
// }            // doc.save('table.pdf');
    obj = '<object id="pdfObjObj" data="'+doc.output('bloburi')+'" type="application/pdf" width="90%" height="550"></object>';
$.ajax({
type: "GET",
url: 'reporthistory.php?types=ouw&titles=Summary of Outward Supplies (GSTR-1)&printdownpdfcsv=Printed PDF&fromto='+fromtopdf+'',
success: function (result) {
console.log(result);
},
error: function (error) {
console.log(error);
}
});
    $('#pdfObj').html(obj);
}, 1000);
        return;
    }
    else{
      // ajax for get
$.ajax({
type: "GET",
url: 'check.php?term=outward&invfrom=<?=$invfrom?>&invto=<?=$invto?>&limitfrom='+sIndex+'&limitto='+dt+'',
success: function (result) {
    if (result!=mytabprev) {
        $('#myTables').append(result);
        mytabprev = result;
    }
  sIndex+=dt;
  countering--;
},
error: function (error) {
console.log(error);
}
});
// it is done
      $('#time').text(countering);
      console.log("Timer --> " + countering);
      console.log("sIndex --> " + sIndex);
      console.log("dt --> " + dt);
    }
}, 1000);
}

</script>
<script>

function downloadaspdf() {
$("#myTables").html("");
$("#exampleModaldownload").modal("show");
<?php
$sqlbranch=mysqli_query($con, "select franchisename from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$branch=mysqli_fetch_array($sqlbranch);
// $sqllimit=mysqli_query($con, "select count(distinct invoiceno) as countoftotal from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and gstrtype='Registered Business - Regular' and (invoicedate>='".$invfrom."' and invoicedate<='".$invto."')");
// $sqllimits = mysqli_fetch_array($sqllimit);
?>
var fromtopdf = document.getElementById("datefromto").innerHTML;
var mytabprev = '';
$("#loadimgobj").css("display","block");
$('#pdfObjdownload').html('<div class="text-center"><span id="timerdownload">Please wait <span id="timedownload"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');

  sIndex = 0;
  dt = 5000;
var countering = 1;
var intervaling = setInterval(function() {
  $("body").on("click",function() {
    if ($("#exampleModaldownload").hasClass("show")) {
      console.log("yes");
    }
    else{
        clearInterval(intervaling);
        clearInterval(intervalings);
        clearTimeout(finaltimer);
    }
  });
    if (countering <= 0) {
        clearInterval(intervaling);
        var counterings = 1;
        var percent = 10;
        var intervalings = setInterval(function() {
    counterings--;
    if (counterings <= 0) {
        clearInterval(intervalings);
    $('#timerdownload').html('<div class="progress" style="height:30px !important;text-align:center !important;"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="96" aria-valuemin="0" aria-valuemax="96" style="height:30px !important;width:96%;background-color:#5cb85c !important;">96% completed. Please wait just a few seconds.</div></div>');
  }
  else{
    $('#timerdownload').html('<div class="progress" style="height:30px !important;text-align:center !important;"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="'+percent+'" aria-valuemin="0" aria-valuemax="100" style="height:30px !important;width:'+percent+'%;background-color:#5cb85c !important;">'+percent+'% Completed</div></div>');
    percent+=10;
  }
}, 1000);
var finaltimer = setTimeout(function() 
  {
        var doc = new jspdf.jsPDF('p', 'pt','a4');
        var totalPagesExp = $("#totalpagenums").val();
  
   doc.setFontSize(9);
   doc.setFont(undefined, 'bold');
    var header = function(data) {
    var headtext = "<?= ($sqlviewreport['companyname']=='1')?$branch['franchisename']:''?>";
     var fontSize = doc.internal.getFontSize();
     var pageWidth = doc.internal.pageSize.width;
     txtWidth = doc.getStringUnitWidth(headtext)*fontSize/doc.internal.scaleFactor;
     x = ( pageWidth - txtWidth ) / 2;
     doc.text(headtext,x,35);
    
    var headtext1 = "Summary of Outward Supplies (GSTR-1)";
     var fontSize = doc.internal.getFontSize();
     var pageWidth = doc.internal.pageSize.width;
     txtWidth = doc.getStringUnitWidth(headtext1)*fontSize/doc.internal.scaleFactor;
     x = ( pageWidth - txtWidth ) / 2; 
    doc.text(headtext1, x, 50);
    
    var headtext3 = fromtopdf;
     var fontSize = doc.internal.getFontSize();
     var pageWidth = doc.internal.pageSize.width;
     txtWidth = doc.getStringUnitWidth(headtext3)*fontSize/doc.internal.scaleFactor;
     x = ( pageWidth - txtWidth ) / 2; 
    doc.text(headtext3, x, 65);

    // Footer
      var str = 'Page ' + doc.internal.getNumberOfPages()
      if (typeof doc.putTotalPages === 'function') {
             str = str + " of " + totalPagesExp;
        }
      var pageSize = doc.internal.pageSize
      var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
     var fontSize = doc.internal.getFontSize();
     var pageWidth = doc.internal.pageSize.width;
     txtWidth = doc.getStringUnitWidth(str)*fontSize/doc.internal.scaleFactor;
     x = ( pageWidth - txtWidth ) / 2;
      doc.text(str, x, pageHeight - 23);

    const date = new Date();
    let currentPeriod = date.getHours() >= 12 ? 'PM' : 'AM';
    let currentHour= String((date.getHours()>12)?date.getHours()-12:date.getHours()).padStart(2, '0');
    let currentMinute= String(date.getMinutes()).padStart(2, '0');
    let currentSecond= String(date.getSeconds()).padStart(2, '0');
    let currentDay= String(date.getDate()).padStart(2, '0');
    let currentMonth = String(date.getMonth()+1).padStart(2,"0");
    let currentYear = date.getFullYear();
    let dateprepare = '';
    let timeprepare = '';
    let printedword = '';
    <?php 
    if ($sqlviewreport['dateprepare']=='1') {
    ?>
    dateprepare = `${currentDay}/${currentMonth}/${currentYear}`;
    <?php 
    }
    if ($sqlviewreport['timeprepare']=='1') {
    ?>
    timeprepare = `${currentHour}:${currentMinute}:${currentSecond} ${currentPeriod}`;
    <?php 
    }
    if ($sqlviewreport['timeprepare']=='1'||$sqlviewreport['dateprepare']=='1') {
    ?>
    printedword = 'Printed On : ';
    <?php 
    }
    ?>
    let currentDate = `${printedword} ${dateprepare} ${timeprepare}`;
    var printedon = currentDate;
     var fontSize = doc.internal.getFontSize();
     var pageWidth = doc.internal.pageSize.width;
     txtWidth = doc.getStringUnitWidth(printedon)*fontSize/doc.internal.scaleFactor;
     x = ( pageWidth - txtWidth ) / 2;
    doc.text(printedon, x, pageHeight - 35);
  };
var botforprint = 50;
        doc.autoTable({ html: '#print-are3' ,theme: 'plain',headStyles :{fillColor : [245, 242, 242]},margin: {top: 80,bottom: botforprint},styles: { overflow: "hidden",fontSize: 8,fontStyle: 'normal',halign : 'center',fillColor: [255,255,255],lineColor: [204, 204, 204], lineWidth: 0.1},
              didDrawPage: header, 
              columnStyles: { 
                  0: { halign: 'left', cellWidth: 165},
                  1: { halign: 'right', cellWidth: 87},
                  2: { halign: 'right', cellWidth: 87},
                  3: { halign: 'right', cellWidth: 87},
                  4: { halign: 'right', cellWidth: 87}
              }});
// if (typeof doc.putTotalPages === 'function') { 
//     doc.putTotalPages(totalPagesExp);
// }            // doc.save('table.pdf');
$.ajax({
type: "GET",
url: 'reporthistory.php?types=ouw&titles=Summary of Outward Supplies (GSTR-1)&printdownpdfcsv=Downloaded PDF&fromto='+fromtopdf+'',
success: function (result) {
console.log(result);
},
error: function (error) {
console.log(error);
}
});
    doc.save('Outward-Reports-<?=$invfrom?>-To-<?=$invto?>');
$("#exampleModaldownload").modal("hide");
alert("Downloaded Successfully");
}, 1000);
        return;
    }
    else{
      // ajax for get
$.ajax({
type: "GET",
url: 'check.php?term=outward&invfrom=<?=$invfrom?>&invto=<?=$invto?>&limitfrom='+sIndex+'&limitto='+dt+'',
success: function (result) {
    if (result!=mytabprev) {
        $('#myTables').append(result);
        mytabprev = result;
    }
  sIndex+=dt;
  countering--;
},
error: function (error) {
console.log(error);
}
});
// it is done
      $('#timedownload').text(countering);
      console.log("Timer --> " + countering);
      console.log("sIndex --> " + sIndex);
      console.log("dt --> " + dt);
    }
}, 1000);
}

</script>
<script>
function downloadascsv() {
checkdown = true;
$("#exampleModaldownload").modal("show");
<?php
$sqlbranch=mysqli_query($con, "select franchisename from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$branch=mysqli_fetch_array($sqlbranch);
// $sqllimit=mysqli_query($con, "select count(distinct invoiceno) as countoftotal from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and gstrtype='Registered Business - Regular' and (invoicedate>='".$invfrom."' and invoicedate<='".$invto."')");
// $sqllimits = mysqli_fetch_array($sqllimit);
?>
var fromtopdf = document.getElementById("datefromto").innerHTML;
var mytabprev = '';
$("#loadimgobj").css("display","block");
$('#pdfObjdownload').html('<div class="text-center"><span id="timerdownload">Please wait <span id="timedownload"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');

  sIndex = 0;
  dt = 5000;
var countering = 1;
var intervaling = setInterval(function() {
  $("body").on("click",function() {
    if ($("#exampleModaldownload").hasClass("show")) {
      console.log("yes");
    }
    else{
        clearInterval(intervaling);
        clearInterval(intervalings);
clearTimeout(finaltimer);
    }
  });
    if (countering <= 0) {
        clearInterval(intervaling);
        var counterings = 9;
        var percent = 10;
        var intervalings = setInterval(function() {
    counterings--;
    if (counterings <= 0) {
        clearInterval(intervalings);
    $('#timerdownload').html('<div class="progress" style="height:30px !important;text-align:center !important;"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="96" aria-valuemin="0" aria-valuemax="96" style="height:30px !important;width:96%;background-color:#5cb85c !important;">96% completed. Please wait just a few seconds.</div></div>');
  }
  else{
    $('#timerdownload').html('<div class="progress" style="height:30px !important;text-align:center !important;"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="'+percent+'" aria-valuemin="0" aria-valuemax="100" style="height:30px !important;width:'+percent+'%;background-color:#5cb85c !important;">'+percent+'% Completed</div></div>');
    percent+=10;
  }
}, 1000);
        return;
    }
    else{
// ajax for get
$.ajax({
type: "GET",
url: 'reportcsv.php?term=outward&from=<?=$invfrom?>&to=<?=$invto?>&branch=<?=(($sqlviewreport['companyname']=='1')?$branch['franchisename']:'')?>&type=Summary of Outward Supplies (GSTR-1)&fromto='+fromtopdf+'',
success: function (result) {
if(checkdown){
if (result.split(',')[0]=='downloaded') {
// for(i=1;i<result.split(',').length;i++){
var filename = result.split(',')[1]+".csv";
var req = new XMLHttpRequest();
req.open("GET", "reports/"+result.split(',')[1]+".csv", true);
req.responseType = "blob";
req.onload = function (event) {
var blob = req.response;
console.log(blob.size);
var link=document.createElement('a');
link.href=window.URL.createObjectURL(blob);
link.download=filename;
link.click();
};
req.send();
}
$.ajax({
type: "GET",
url: 'reporthistory.php?types=ouw&titles=Summary of Outward Supplies (GSTR-1)&printdownpdfcsv=Downloaded CSV&fromto='+fromtopdf+'',
success: function (result) {
console.log(result);
},
error: function (error) {
console.log(error);
}
});
$("#exampleModaldownload").modal("hide");
checkdown = false;
alert("Downloaded Successfully");
location.reload(true);
return;
// }
}
sIndex+=dt;
countering--;
},
error: function (error) {
console.log(error);
}
});
// it is done
      $('#timedownload').text(countering);
      console.log("Timer --> " + countering);
      console.log("sIndex --> " + sIndex);
      console.log("dt --> " + dt);
    }
}, 1000);
}
</script>
<script type="text/javascript">
var buttons = document.querySelectorAll('.arlina-button');

    Array.prototype.slice.call(buttons).forEach(function(button) {

        var resetTimeout;

        button.addEventListener('click', function() {

            if (typeof button.getAttribute('data-loading') === 'string') {
                button.removeAttribute('data-loading');
            } else {
                button.setAttribute('data-loading', '');
            }

            clearTimeout(resetTimeout);
            resetTimeout = setTimeout(function() {
                button.removeAttribute('data-loading');
            }, 1000);

        }, false);

    });
</script>
<style type="text/css">
/*************************************
 * BUTTON BASE
 */

    .arlina-button {
        position: relative;
        border: 0;
        cursor: pointer;
        outline: 0;
        -webkit-appearance: none;
        -webkit-font-smoothing: antialiased;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    .arlina-button[data-loading] {
        cursor: default;
    }


    /* Blue button */
    .arlina-button.blue {
        background: #53b5e6;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.blue:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #58c2f8;
    }

    .arlina-button.blue[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }

    /* Orange button */
    .arlina-button.orange {
        background: #ea8557;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.orange:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #ffa96c;
    }

    .arlina-button.orange[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }


    /* Spinner animation */
    .arlina-button .spinner {
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        margin-top: -10px;
        opacity: 0;

        background-image: url("./assets/img/spin.gif");
        background-repeat: no-repeat;

        /* background-image: url(http://2.bp.blogspot.com/-GPSLDnKmX3s/VSvPkXsCHvI/AAAAAAAACOg/Xmm2kIDu-CU/s1600/spin.gif); */


    }


    /*************************************
 * EASING
 */

    .arlina-button,
    .arlina-button .spinner,
    .arlina-button .label {
        -webkit-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -moz-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -ms-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
    }

    .arlina-button.zoom-in,
    .arlina-button.zoom-in .spinner,
    .arlina-button.zoom-in .label,
    .arlina-button.zoom-out,
    .arlina-button.zoom-out .spinner,
    .arlina-button.zoom-out .label {
        -webkit-transition: 0.3s ease all;
        -moz-transition: 0.3s ease all;
        -ms-transition: 0.3s ease all;
        transition: 0.3s ease all;
    }



    /*************************************
 * EXPAND RIGHT
 */

    .arlina-button.expand-left .spinner {
        left: 0.8em;
    }

    .arlina-button.expand-left[data-loading] {
        padding-left: 40px;
    }

    .arlina-button.expand-left[data-loading] .spinner {
        opacity: 1;
    }
</style>

<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/simonbengtsson/jsPDF@requirejs-fix-dist/dist/jspdf.debug.js"></script>
<script type="text/javascript" src="https://unpkg.com/jspdf-autotable@2.3.2/pdf/dist/jspdf.plugin.autotable.js"></script> -->
<script>
function generate() {

  var doc = new jsPDF('p', 'pt');
  var res = doc.autoTableHtmlToJson(document.getElementById("print-are1"));
  var totalPagesExp = $("#totalpagenums").val();
  
 doc.setFontSize(9);
   doc.setFont(undefined, 'bold');
    var header = function(data) {
    doc.setFontSize(15);
    doc.setTextColor(40);
    doc.setFontStyle('normal');
    //doc.addImage(headerImgData, 'JPEG', data.settings.margin.left, 20, 50, 50);
    
    var headtext = "<?=$branch['franchisename']?>",
    xOffset = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(headtext) * doc.internal.getFontSize() / 2); 
    doc.text(headtext, xOffset, 25);
    
    var headtext1 = "Summary of Outward Supplies (GSTR-1)",
    xOffset = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(headtext1) * doc.internal.getFontSize() / 2); 
    doc.text(headtext1, xOffset, 45);
    
    var fromtopdf = document.getElementById("datefromto").innerHTML;
var mytabprev = '';
    var headtext2 = fromtopdf,
    xOffset = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(headtext2) * doc.internal.getFontSize() / 2); 
    doc.text(headtext2, xOffset, 65);
     
  };
  var footer = function(data) {
    // Footer
      var str = 'Page ' + doc.internal.getNumberOfPages()
      // Total page number plugin only available in jspdf v1.0+
      if (typeof doc.putTotalPages === 'function') {
             str = str + " of " + totalPagesExp;
        }
      doc.setFontSize(10)

      // jsPDF 1.4+ uses getHeight, <1.4 uses .height
      var pageSize = doc.internal.pageSize
      var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
 
      xOffset = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(str) * 10 / 2); 
      
      doc.text(str, xOffset, pageHeight - 20);
  };

  var options = {
     "theme": "plain", 
    "pageBreak": "auto", 
    "tableWidth": "auto", 
    "showHead": "everyPage", 
    "showFoot": "everyPage", 
    "tableLineWidth": 0, 
    "tableLineColor": 50, 
    rowPageBreak: 'auto',
    bodyStyles: { valign: 'top' },
    styles: { overflow: "hidden",fontSize: 8,fontStyle: 'normal', cellWidth: "wrap", rowPageBreak: "avoid", halign: "justify", fontSize: "8", lineColor: 100, lineWidth: ".25" },   
    columnStyles: {1:{halign: "justify",cellWidth: "wrap"}},
      headStyles :{fillColor : [255, 255, 255]},
      alternateRowStyles: {fillColor : [255, 255, 255]},
      
      tableLineWidth: 0.1,
    beforePageContent: header,
    afterPageContent: footer,
    margin: {
      top: 80,
      bottom: 35
    },
    startY: 80,
  };

  doc.autoTable(res.columns, res.data, options);
// if (typeof doc.putTotalPages === 'function') { 
//     doc.putTotalPages(totalPagesExp);
// }

  doc.save("table.pdf");
}
<?php
if (($registerbilltotal==0)&&($consumerbilltotal==0)&&($hsnbilltotal==0)) {
?>
$("#csvdownopt").hide();
<?php
}
?>
</script>
</body>

</html>