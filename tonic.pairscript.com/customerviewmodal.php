<?php
if (!isset($userid)) {
include("lcheck.php");
}
$sqlismainaccessfieldcusview=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customers' order by id  asc");
while($infomainaccessfieldcusview=mysqli_fetch_array($sqlismainaccessfieldcusview)){
$coltype = preg_replace('/\s+/', '', $infomainaccessfieldcusview['moduletype']);
$addcusview = $infomainaccessfieldcusview[21];
$fieldaddcusview = explode(',',$addcusview);
$editcusview = $infomainaccessfieldcusview[22];
$fieldeditcusview = explode(',',$editcusview);
$viewcusview = $infomainaccessfieldcusview[23];
$fieldviewcusview = explode(',',$viewcusview);
}
// This is for Restriction of Pages
$sqlget=mysqli_query($con,"select * from paircurrency");
$row=mysqli_fetch_array($sqlget);
$ans=$row['currencysymbol'];
$res=explode('-',$ans);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- customerview.css -->
<link href="customerview.css" rel="stylesheet">
</head>
<body class="g-sidenav-show" style="background-color:#F1F2F6;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customers' order by id  asc");
$infomainaccessusercusview=mysqli_fetch_array($sqlismainaccessuser);
?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<nav>
<div class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist">
<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
<div class="customcont-header ml-0">
<a class="customcont-heading">Overview</a>  
</div>
</button>
<button class="nav-link" id="nav-transactions-tab" data-bs-toggle="tab" data-bs-target="#nav-transactions" type="button" role="tab" aria-controls="nav-transactions" aria-selected="false">
<div class="customcont-header ml-0">
<a class="customcont-heading">Transactions</a>  
</div>
</button>
<!-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
<div class="customcont-header ml-0"> 
<a class="customcont-heading">History</a>   
</div>
</button> -->
</div>
</nav>
<div class="tab-content" id="nav-tabContent">
<!-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
<div class="table-responsive m-3">
<table class="table table-bordered" style="width: 100%;table-layout: fixed;">
      <thead>
      <tr>
      <th style="border:1px solid #ddd !important;color: grey !important;font-weight: 600 !important;width: 19%;">DATE</th>
      <th style="border:1px solid #ddd !important;color: grey !important;font-weight: 600 !important;width: 81%;">DETAILS</th>
      </tr>
      </thead>
<tbody>
<?php
$sqluse=mysqli_query($con, "select * from pairusehistory where usetype='CUSTOMERS' order by createdon desc");
while($infouse=mysqli_fetch_array($sqluse))
{
?>
<tr>
<td data-label="DATE" id="datehis"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
<td data-label="DETAILS"><?=$infouse['useremarks']?> <br><span><?=((str_contains($infouse['useremarks'],'CUSTOMER CREATED'))?'Created By':'Changed By')?></span> <span id="chhis"></span></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>  -->
<input type="text" id="idforcust" style="display: none !important;">
<div class="tab-pane fade" id="nav-transactions" role="tabpanel" aria-labelledby="nav-transactions-tab">    
<div class="table-responsive mt-3 p-0 min-height-480 mb-3">
<table id="someTable" class="table table-bordered align-items-center mb-0">
<thead>
<tr>
<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Date</span></td>
<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Number</span></td>
<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Type</span></td>
<!-- <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Quantity</span></td> -->
<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Amount</span></td>
<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Status</span></td>
</tr>
</thead>
<tbody id="transactionans">
</tbody>
</table>
                                <div style="text-align: center !important;display: none;" id="loadimg">
                                    <img src="loading.gif" alt="Loading..." style="margin-top: -60px;" id="loadimgins">
                                </div>
</div>
</div>
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<?php
// if ((in_array('Customer Information', $fieldviewcusview))) {
?>
<div class="row">
<div class="col-lg-8">
<p class="m-3" id="infoheadsall"><?= $infomainaccessusercusview['modulename'] ?> Details</p>
</div>
<div class="col-lg-4 mt-2">
<span style="border-bottom: 1px dashed grey;margin-left: 1.8rem; font-size:16px" data-toggle="tooltip" title="Outstanding Receivables" data-placement="top" class="text-danger">Outstanding Receivables</span>
<br>
<span style="margin-left: 1.8rem; font-size:16px"><?php echo $res[0]; ?> <span id="outstandans"></span></span>
</div>
</div> 
<?php
if ((in_array('Customer Id', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall"><?= $infomainaccessusercusview['modulename'] ?> Id</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewcode"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Customer Public Id', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall"><?= $infomainaccessusercusview['modulename'] ?> Public Id</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewpublicid"></span>
</div>
</div>
<?php
 }
?>
<?php
if ((in_array('Customer Private Id', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall"><?= $infomainaccessusercusview['modulename'] ?> Private Id</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewprivateid"></span>
</div>
</div>
<?php
 }
?>
<?php
if ((in_array('Primary Contact', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Primary Contact</span>
</div>
<div class="col-md-6 col-6"> 
<span id="custviewpsalutation"></span> 
<span id="custviewpcontact"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Company Name', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Company Name</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewcname"></span>
</div>
</div>
<?php
}
?>
<?php
// if ((in_array('Customer Display Name', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall"><?= $infomainaccessusercusview['modulename'] ?> Name</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewname"></span>
</div>
</div>
<?php
// }
?>
<?php
if ((in_array('Category', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Category</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewcat"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Sub Category', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Sub Category</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewsubcat"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Work Phone', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Work Phone</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewwork"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Mobile Phone', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Mobile Phone</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewmobile"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Email', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Email</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewemail"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Website', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Website</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewweb"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Billing Address', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Billing Address</span>
</div>
<div class="col-md-6 col-6" style="position: relative;top: 19px !important;margin-top: -19px !important;">
<span id="custviewbstreet"></span>
<span id="custviewbcity"></span><br>
<span id="custviewbstate"></span>
<span id="custviewbpincode"></span>
<span id="custviewbcountry"></span>   
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Shipping Address', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Shipping Address</span>
</div>
<div class="col-md-6 col-6" style="position: relative;top: 9px !important;">
<span id="custviewsstreet"></span>
<span id="custviewscity"></span><br>
<span id="custviewsstate"></span>
<span id="custviewspincode"></span>
<span id="custviewscountry"></span> 
</div>
</div>
<?php
}
?>
<hr style="margin-top: 18px !important;">
<?php
// }
?>
<?php
if ((in_array('Customers Visibility', $fieldviewcusview))) {
?>
<p class="m-3" id="infoheadsall"><?= $infomainaccessusercusview['modulename'] ?> Visibility</p>   
<div class="row m-3" id="aligncenterall">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Visibility</span>
</div>
<div class="col-md-6 col-6">
<div class="row">
<div class="col-sm-6 " style="z-index:0;">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="custviewvisibility" id="custviewvisibility" value="0" disabled>
<label class="custom-control-label custom-label" for="custviewvisibility">Public</label>
</div>
</div>
<div class="col-sm-6 " style="z-index:0;">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="custviewvisibility" id="custviewnovisibility" value="1" disabled>
<label class="custom-control-label custom-label" for="custviewnovisibility">Private</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<hr>
<?php
}
?>
<?php
if ((in_array('Tax Information', $fieldviewcusview))) {
?>
<p class="m-3" id="infoheadsall">Tax Information</p>
<?php
if ((in_array('Tax Preference', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Tax Preference</span>
</div>
<div class="col-md-6 col-6">
<div class="row">
<div class="col-sm-6 " style="z-index:0;">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="custviewtaxprefer" id="custviewtaxprefer" value="0" disabled>
<label class="custom-control-label custom-label" for="custviewtaxprefer">Taxable</label>
</div>
</div>
<div class="col-sm-6 " style="z-index:0;display: none !important;">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="custviewtaxprefer" id="custviewtaxpreferno" value="1" disabled>
<label class="custom-control-label custom-label" for="custviewtaxpreferno">Non Taxable</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('GST Registration Type', $fieldviewcusview))) {
?>
<div id="custviewgstrtypesh">
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">GST Registration Type</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewgstrtype"></span>
</div>
</div>
<div id="gstinshowhideforcust" style="display: block;">
<?php
if ((in_array('GSTIN or UIN', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">GSTIN / UIN</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewgstin"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Business Legal Name', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Business Legal Name</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewbuslegname"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Business Trade Name', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Business Trade Name</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewbustrdname"></span>
</div>
</div>
<?php
}
?>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Pan', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">PAN</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewpan"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Place Of Supply', $fieldviewcusview))) {
?>
<div id="custviewposdiv">
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">Place Of Supply</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewpos"></span>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ((in_array('Other Information', $fieldviewcusview))) {
?>
<hr>
<p class="m-3" id="infoheadsall">Other Information</p>
<?php
if ((in_array('DL dot No dot or 20', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">DL.NO./20</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewdlt"></span>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('DL dot No dot or 21', $fieldviewcusview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-6 col-6">
<span id="insideheadall">DL.NO./21</span>
</div>
<div class="col-md-6 col-6">
<span id="custviewdlo"></span>
</div>
</div>
<?php
}
?>
<?php
}
?>
</div>
</div>
</form>
</body>
</html>