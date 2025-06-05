<?php
include('lcheck.php');
// This is for Restriction of Pages
$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$sql = "select * from paircontrols where id='$companymainid'";
$result = mysqli_query($con, $sql);
$rowes = mysqli_fetch_array($result);
$sql = "select * from paircontrols where username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."'";
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_array($result);
 if($userrole!='SUPER ADMIN')
{
    if($rowes['permissionsidebooks']==0||$rowes['permissioninvoices']==0||$rows['binvcreate']==0||$row['franchises']==''){
    header('Location: dashboard.php');
}
}
else{
    if($rowes['permissionsidebooks']==0||$rowes['permissioninvoices']==0||$row['franchises']==''){
    header('Location: dashboard.php');
}
}
if(isset($_POST['grandtotal']))
{
date_default_timezone_set('Asia/Calcutta');
$createdon=date('Y-m-d H:i:s');
$data1 = mysqli_query($con, "SET NAMES utf8");
$data1=mysqli_query($con, "SET sql_mode = ''");
$data1=mysqli_query($con, "select invoice, invoiceprefix, (invoicesuffix+1) as invoicesuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$info1=mysqli_fetch_array($data1);
$customername=mysqli_real_escape_string($con, $_POST['customername']);
$customerid=mysqli_real_escape_string($con, $_POST['customerid']);
$address1 = mysqli_real_escape_string($con, $_POST['address1']);
$address2 = mysqli_real_escape_string($con, $_POST['address2']);
$area = mysqli_real_escape_string($con, $_POST['area']);
$city = mysqli_real_escape_string($con, $_POST['city']);
$state = mysqli_real_escape_string($con, $_POST['state']);
$district = mysqli_real_escape_string($con, $_POST['district']);
$pincode = mysqli_real_escape_string($con, $_POST['pincode']);
$saddress1 = mysqli_real_escape_string($con, $_POST['saddress1']);
$saddress2 = mysqli_real_escape_string($con, $_POST['saddress2']);
$sarea = mysqli_real_escape_string($con, $_POST['sarea']);
$scity = mysqli_real_escape_string($con, $_POST['scity']);
$sstate = mysqli_real_escape_string($con, $_POST['sstate']);
$sdistrict = mysqli_real_escape_string($con, $_POST['sdistrict']);
$spincode = mysqli_real_escape_string($con, $_POST['spincode']);
$gstno = mysqli_real_escape_string($con, $_POST['gstno']);
$invoiceterm=mysqli_real_escape_string($con, $_POST['invoiceterm']);
$invoiceno=mysqli_real_escape_string($con, $info1['invoiceprefix'].(str_pad((float)$info1['invoicesuffix']+1, 0, "0", STR_PAD_LEFT)));
$invoicedate=mysqli_real_escape_string($con, $_POST['invoicedate']);
$duedate=mysqli_real_escape_string($con, $_POST['duedate']);
$orderdcno=mysqli_real_escape_string($con, $_POST['orderdcno']);
$reference=mysqli_real_escape_string($con, $_POST['reference']);
$totalitems=mysqli_real_escape_string($con, $_POST['totalitems']);
$totalvatamount=mysqli_real_escape_string($con, $_POST['totalvatamount']);
$totalamount=mysqli_real_escape_string($con, $_POST['totalamount']);
$discount=mysqli_real_escape_string($con, $_POST['discount']);
$discountamount=mysqli_real_escape_string($con, $_POST['discountamount']);
$freightamount=mysqli_real_escape_string($con, $_POST['freightamount']);
$roundoff=mysqli_real_escape_string($con, $_POST['roundoff']);
$grandtotal=mysqli_real_escape_string($con, $_POST['grandtotal']);
$invoiceamount=mysqli_real_escape_string($con, $_POST['grandtotal']);
$preparedby=mysqli_real_escape_string($con, $_POST['preparedby']);
$taxtype=mysqli_real_escape_string($con, $_POST['taxtype']);
$cgst25=mysqli_real_escape_string($con, $_POST['cgst25']);
$sgst25=mysqli_real_escape_string($con, $_POST['sgst25']);
$gst25=mysqli_real_escape_string($con, $_POST['gst25']);
$cgst6=mysqli_real_escape_string($con, $_POST['cgst6']);
$sgst6=mysqli_real_escape_string($con, $_POST['sgst6']);
$gst6=mysqli_real_escape_string($con, $_POST['gst6']);
$cgst9=mysqli_real_escape_string($con, $_POST['cgst9']);
$sgst9=mysqli_real_escape_string($con, $_POST['sgst9']);
$gst9=mysqli_real_escape_string($con, $_POST['gst9']);
$cgst14=mysqli_real_escape_string($con, $_POST['cgst14']);
$sgst14=mysqli_real_escape_string($con, $_POST['sgst14']);
$gst14=mysqli_real_escape_string($con, $_POST['gst14']);
$tax25=mysqli_real_escape_string($con, $_POST['tax25']);
$tax6=mysqli_real_escape_string($con, $_POST['tax6']);
$tax9=mysqli_real_escape_string($con, $_POST['tax9']);
$tax14=mysqli_real_escape_string($con, $_POST['tax14']);
if($customerid=='')
{
$sqlcon = "SELECT id From paircustomers WHERE franchisesession='".$_SESSION["franchisesession"]."' and customername = '{$customername}'";
$querycon = mysqli_query($con, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
   die("SQL query failed: " . mysqli_error($con));
}
if($rowCountcon == 0) 
{   
$sqlup = "insert into paircustomers set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', customername='$customername', city='$city', address='$area', pin='$pincode', state='$state', country='$district'";
$queryup = mysqli_query($con, $sqlup);
if(!$queryup){
   die("SQL query failed: " . mysqli_error($con));
}
else
{
$tid=mysqli_insert_id($con);
$customerid=$tid;
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Customer', '{$tid}')");
} 
}
}
$sql2=mysqli_query($con, "SET sql_mode = ''");
$sql2=mysqli_query($con, "select id from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='$invoiceno' and invoicedate='$invoicedate'");
if(mysqli_num_rows($sql2)==0)
{
for($i=0; $i<count($_POST['productname']); $i++)
{
$productid=mysqli_real_escape_string($con, $_POST['productid'][$i]);
$productname=mysqli_real_escape_string($con, $_POST['productname'][$i]);
$producthsn=mysqli_real_escape_string($con, $_POST['producthsn'][$i]);
$productnotes=mysqli_real_escape_string($con, $_POST['productnotes'][$i]);
$mrp=mysqli_real_escape_string($con, $_POST['mrp'][$i]);
$vat=mysqli_real_escape_string($con, $_POST['vat'][$i]);
$quantity=mysqli_real_escape_string($con, $_POST['quantity'][$i]);
$productrate=mysqli_real_escape_string($con, $_POST['productrate'][$i]);
$prodiscount=mysqli_real_escape_string($con, $_POST['prodiscount'][$i]);
$productvalue=mysqli_real_escape_string($con, $_POST['productvalue'][$i]);
if($productname!='')
{   
$sql=mysqli_query($con, "insert into pairinvoices set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', customername='$customername', customerid='$customerid', address1='$address1', address2='$address2', area='$area', city='$city', state='$state', district='$district', pincode='$pincode', saddress1='$saddress1', saddress2='$saddress2', sarea='$sarea', scity='$scity', sstate='$sstate', sdistrict='$sdistrict', spincode='$spincode', gstno='$gstno', invoiceterm='$invoiceterm', invoiceno='$invoiceno', invoicedate='$invoicedate', invoiceamount='$invoiceamount', duedate='$duedate', productid='$productid', productname='$productname', producthsn='$producthsn', productnotes='$productnotes', mrp='$mrp', vat='$vat', quantity='$quantity', productrate='$productrate', prodiscount='$prodiscount', productvalue='$productvalue', totalitems='$totalitems', orderdcno='$orderdcno', reference='$reference', totalvatamount='$totalvatamount', totalamount='$totalamount', discount='$discount', discountamount='$discountamount', freightamount='$freightamount', roundoff='$roundoff', grandtotal='$grandtotal', preparedby='$preparedby', taxtype='$taxtype', cgst25='$cgst25', sgst25='$sgst25', gst25='$gst25', cgst6='$cgst6', sgst6='$sgst6', gst6='$gst6', cgst9='$cgst9', sgst9='$sgst9', gst9='$gst9', cgst14='$cgst14', sgst14='$sgst14', gst14='$gst14', tax25='$tax25', tax6='$tax6', tax9='$tax9', tax14='$tax14'");
if($sql)
{
/* $salesid=mysqli_insert_id($con);
$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-$quantity where id='$productid'"); */
}
else
{
echo mysqli_error($con);
}
}
$tid=mysqli_insert_id($con);
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Invoice', '{$tid}')");
}
if($invoiceterm=='CASH')
{
$sql=mysqli_query($con, "insert into pairsalespayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='RECEIPT', customername='$customername', customerid='$customerid', receiptno='$invoiceno', receiptdate='$invoicedate', amount='$invoiceamount', paymentmode='CASH', notes='-'");
if($sql)
{
	$paymentid=mysqli_insert_id($con);
	$sqle=mysqli_query($con,"insert into pairsalespayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', customerid='$customerid', invoiceno='$invoiceno', invoicedate='$invoicedate', amount='$invoiceamount'");
	if($sqle)
	{
		$sqler=mysqli_query($con,"update pairinvoices set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='1' where invoiceno='$invoiceno' and invoicedate='$invoicedate' and customerid='$customerid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
		if($sqler)
		{
			//echo 's';
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		echo mysqli_error($con);
	}
}


}
$sql3=mysqli_query($con, "update pairfranchises set invoicesuffix=invoicesuffix+1 where tdelete='0' and id='".$_SESSION['franchisesession']."'");
if($sql3)
{
echo '<script> window.open("invoiceprint.php?invoiceno='.$invoiceno.'&invoicedate='.$invoicedate.'", "_blank");</script>';
echo '<script> window.location.href="invoices.php?remarks=Added Successfully";</script>'; 
}
}
else
{
header("Location: invoices.php?error=Error Data");
}
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
<?php
include('externals.php');
?>
 <style>
.myinput::-webkit-input-placeholder {
font-size: 9.5px;
}
.select2 {
width: 100% !important;
background-color: #ffffff !important;
}
.modal-content {
border-radius: 0px;
}
.modal-header {
background: #F1F2F6;
border-radius: 0;
}
.modal-title {
font-weight: normal;
}
.select2-container--default .select2-selection--single {
background-color: #ffffff !important;
color: #495057;
border: 1px solid #ced4da;
height: 25px;
border-radius: 2px;
}
.select2-selection--single .select2-selection__rendered{
	line-height: 22.5px !important;
}
</style>
<style>
.btn_upload {
cursor: pointer;
display: inline-block;
overflow: hidden;
position: relative;
color: #fff;
background-color: #fff;
border: none;
}
.btn_upload:hover,
.btn_upload:focus {
background-color: #fff;
}
.yes {
display: flex;
align-items: flex-start;
margin-top: 10px !important;
}
.btn_upload input {
cursor: pointer;
height: 100%;
position: absolute;
filter: alpha(opacity=1);
-moz-opacity: 0;
opacity: 0;
}
.it {
height: 100px;
margin-left: 10px;
}
.accordion-button:not(.collapsed)::after
{
background-image: url("");
}
.mb-3 {
margin-bottom: -5px !important;
}
#removeImage1,
#removeImage2,
#removeImage3,
#removeImage4,
#removeImage5 {
color: #6c757d;
}
#removeImage1:hover {
color: black;
}
#removeImage2:hover {
color: black;
}
#removeImage3:hover {
color: black;
}
#removeImage4:hover {
color: black;
}
#removeImage5:hover {
color: black;
}
.rmv {
cursor: pointer;
color: #fff;
border-radius: 30px;
border: 1px solid #fff;
display: inline-block;
background: rgba(255, 0, 0, 1);
margin: -5px -10px;
}
.rmv:hover {
background: rgba(255, 0, 0, 0.5);
}
</style>
<style>
.item-actions-container .item-actions {
position: absolute;
right: -50px;
top: -20px;
}
.icon-cancel-circled {
color: #fab2b1;
}
svg.icon.icon-sm {
height: 14px;
width: 14px;
}
td:hover {
cursor: move;
}
.imagePreview {
width: 200px;
height: 140px;
background-position: center center;
background-color: #fff;
background-size: cover;
background-repeat: no-repeat;
text-align: center;
}
.btn-custom-grey:hover i {
color: #ffffff !important;
}
.btn-custom-grey:active, .btn-custom-grey:focus, .btn-custom-grey:hover {
background-color: #f8f8f8;
border-color: #c6c6c6;
}
/*.btn-custom:hover {
background-color: #ed0707 !important;
border-color: #c6c6c6;
}*/
.selectdesign {
width: 6px;
padding-right: 0px;
padding-left: 10px;
padding-bottom: 1px;
border-top-width: 2px;
background-color: #f5f5f5;
}
.dash {
border: 0 none;
border-top: 2px dashed #322f32;
background: none;
height: 0;
margin-top: 0px;
width: 60px;
}
thead tr th {
color: black !important;
text-align: left !important;
}
.basicaddon1 {
padding-right: 8px;
padding-left: 8px;
padding-top: 5px;
padding-bottom: 5px;
background-color: #e9ecef;
border-bottom: 2px solid #e9ecef;
}
.form-control:disabled,
.form-control[readonly] {
background-color: #e9ecef;
opacity: 1;
}
#footer {
background-color: #ffffff;
width: 84%;
position: fixed;
bottom: 0px;
height: 50px;
margin-bottom: 0px;
Padding-top: 0px;
margin-left: -15px;
margin-right: -15px;
border: 1px solid #eee;
  -webkit-box-shadow: 0px -4px 3px #e9ecef;
  -moz-box-shadow: 0px -4px 3px #e9ecef;
  box-shadow: 0 -4px 5px -3px rgb(0 0 0 / 10%);
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
padding-right: 5px;
}
input[type="number"]::placeholder {
/* Firefox, Chrome, Opera */
text-align: right;
}
#subtotal {
text-align: right;
}
input[type=number] {
text-align: right;
}
.input-group-text {
border: none;
border-radius: 0px;
}
.form-control {
padding: 1px 8px;
height: 25px;
}
.form-control-sm {
padding: 1px 8px;
}
</style>
<style>
table tbody tr:nth-of-type(odd) {}
@media screen and (max-width: 600px) {
table {
border: 0;
}
table caption {
font-size: 1.3em;
}
table thead {
border: none;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}
table tr {
border-bottom: 3px solid #ddd;
display: block;
margin-bottom: 1em;
}
table thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
table td {
border-bottom: 1px solid #ddd;
display: block;
font-size: .8em;
text-align: right;
}
table td::before {
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: bold;
text-transform: uppercase;
}
table td:last-child {
border-bottom: 0;
}
}
.table> :not(caption)>*>* {
background-color: #ffffff;
box-shadow: none;
}
.table> :not(:last-child)> :last-child>* {
border-bottom-color: #e9ecef;
font-size: 12px !important;
}
.input-group .form-control:not(:first-child) {
border-left: 0;
padding-left: 5px;
}
a .customcont-heading1 {
margin-left: 30px;
}
.form-control-bn:focus {
border: none !important;
box-shadow: none;
}
.input-group .form-control-bn:focus {
border: none !important;
box-shadow: none;
}
table thead th {
height: 10px;
vertical-align: top;
}
</style>
<style>
@media screen and (min-device-width: 300px) and (max-device-width: 768px) {
.mobview {
padding-left: 30px;
}
}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
.imagePreview {
width: 100%;
}
}
@media only screen and (max-width: 300px) {
.select2-container {
width: 90px !important;
margin-top: 3px;
}
.select2-dropdown--below
  {
  width: none !important;
  }
#fulla {
padding-left: 12px !important;
}
}
.table-hover>tbody>tr:hover {
--bs-table-accent-bg: #FFFFFF;
color: var(--bs-table-hover-color);
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#city {
margin-top: 15px
}
}
.customcont-heading{
padding-bottom: 5px;font-size: 15px;
}
hr{
margin-bottom:16px;
}
.table> :not(caption)>*>* {
padding-top: 4px;
padding-bottom: 2px;
}
.addan:hover {
background-color: #b7bbc0 !important;
}
.dropdown-toggle{
content: "\f107";
}

.form-group {
    margin-bottom: 0.5rem;
}
.bordernoneinput:focus{
    outline: none;
	border-color: inherit;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.bordernoneinput{
    border: none;
}
</style>
  <title>
Add Invoice - Dmedia
  </title>
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
     <script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 4000);
 
});
</script>
   <div style="max-width: 1650px;">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<p style="font-size:20px;margin-top: -9px !important;margin-bottom: 6px !important;"><i class="fa fa-file-import"></i> New
Invoice</p>
	
<?php

$sqliet=mysqli_query($con, "select invoice, invoiceprefix, (invoicesuffix+1) as invoicesuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$infoet=mysqli_fetch_array($sqliet);
if($infoet['invoice']!='1')
{
	?>
	<div class="alert alert-danger mt-2 text-white">Sorry! Invoice Generation is Allowed for this Franchise</div>
	<?php
}
else
{
?>
<?php
$sqligst=mysqli_query($con, "select gstno from pairgst where companymainid='$companymainid' ");
$infogst=mysqli_fetch_array($sqligst);
?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">

<hr class="p-0 mb-1 mt-1">



<div class="row">
<!-- <div class="col-lg-6">
	
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingOne" >
<button class="accordion-button font-weight-bold" type="button">
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;">Customer Information</a>
</div>
</button>
</h5>
<div id="collapseOne" class="accordion-collapse collapse show"
aria-labelledby="headingOne">
<div class="accordion-body text-sm" style="padding-bottom: 0px;padding-top: 3px">
	
	
<div class="row">
<div class="col-lg-12">
  <div class="form-group row">
  <input type="hidden" name="customerid" id="customerid">
<div class="col-sm-4">
<label for="customername" class="custom-label"><span class="text-danger">Customer Name *</span></label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="customername" name="customername" required placeholder="Customer Name">
</div>
  </div>
</div>
</div>
 
<div class="row">
	<div class="col-lg-12">
  <div class="form-group row">
<div class="col-sm-4">
<label for="customername" class="custom-label">Billing Address</label>
</div>
<div class="col-sm-5">
<input type="hidden" name="address1" id="address1">
<input type="hidden" name="address2" id="address2">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="area" id="area"  placeholder="Street">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="city" id="city" placeholder="City/Town">
</div>
  </div>
</div>
</div>

<div class="row">
	<div class="col-lg-12">
  <div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-3 mtcolumn">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="state" id="state" placeholder="State">
</div>
<div class="col-sm-2 mtcolumn">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="pincode" id="pincode" min="0" placeholder="Pin">
</div>
<div class="col-sm-3 mtcolumn">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="district" id="district" placeholder="Country/Region">
</div>
  </div>
</div>
</div>

<div class="row">
<div class="col-lg-6" style="display:none">
<h6>Shipping Address <label><input type="checkbox" name="sameaddress" id="sameaddress" onchange="sameadd()" value="0"> Same as Billing Address</label></h6>
<div class="row">
<div class="col-md-6">
  <div class="form-group">
<label>Door No. / House Name</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="saddress1" id="saddress1">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
<label>Street Name</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="saddress2" id="saddress2">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
<label>Area</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sarea" id="sarea">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
<label>City</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="scity" id="scity">
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
<label>District</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sdistrict" id="sdistrict">
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
<label>State</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sstate" id="sstate">
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
<label>Pin Code</label>
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="spincode" id="spincode" min="0">
  </div>
</div>
</div>
</div>
</div>
<div class="row" style="display:none">
<div class="col-md-6">
  <div class="form-group">
<label>GSTIN</label>
<input type="text" autocomplete="off" class="form-control  form-control-sm" name="gstno" id="gstno" >
  </div>
</div>
</div>

</div>
</div>
</div>
</div>
<!-------------
</div> -->
<div class="col-lg-4">
	
	<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
	<h5 class="accordion-header" id="headingTwo" >
	
<button class="accordion-button font-weight-bold" type="button">
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;">Invoice Information</a>
</div>
</button>
</h5>
<div id="collapseTwo" class="accordion-collapse collapse show"
aria-labelledby="headingTwo">
<div class="accordion-body text-sm" style="background-color:#fbfafa;padding-bottom: 0px;padding-top: 3px">
	
	
<div class="row">
<div class="col-lg-12">
  <div class="form-group row">
  <div class="col-lg-4">
<label for="invoiceno" class="custom-label"><span class="text-danger">Invoice No. *</span></label>
</div>
<div class="col-lg-8">
<input type="text" class="form-control  form-control-sm" id="invoiceno" name="invoiceno" required value="<?=$infoet['invoiceprefix']?><?=str_pad((float)$infoet['invoicesuffix']+1, 0, "0", STR_PAD_LEFT)?>" readonly>
</div>
  </div>
</div>
<div class="col-lg-12">
  <div class="form-group row">
  <div class="col-lg-4">
<label for="invoicedate" class="custom-label">Invoice Date</label>
</div>
  <div class="col-lg-8">
<input type="date" class="form-control  form-control-sm" id="invoicedate" name="invoicedate" readonly required value="<?=date('Y-m-d')?>">
  </div>
  </div>
</div>
<div class="col-lg-12">
  <div class="form-group row">
  <div class="col-lg-4">
<label for="invoiceterm" class="custom-label">Invoice Term</label>
</div>
  <div class="col-lg-8">
 <select required class="form-control  form-control-sm" name="invoiceterm" id="invoiceterm" >
<option value="" disabled>Select</option>
<option value="CASH" selected>CASH</option>
<option value="CREDIT">CREDIT</option> <option value="BANK ACCOUNT">BANK ACCOUNT</option><option value="UPI">UPI</option>
  </select>
  </div>
  </div>
</div>
<div class="col-lg-12">
  <div class="form-group row">
  <div class="col-lg-4">
<label for="duedate" class="custom-label">Due Date</label>
</div>
  <div class="col-lg-3 duedateselect" style="margin-top: -3px !important;" onclick="andus()">
<!-- <input type="text" class="form-control  form-control-sm" id="duedate" name="duedate"> -->
<select class="select2-field form-control form-control-sm" id="duedateselects">
	<option>1</option>
	<option>2</option>
	<option>3</option>
</select>
  </div>
  <style type="text/css">
  	@media screen and (max-device-width: 991px){
  		.duedatepicker{
  			margin-top: 9px !important;
  		}
  	}
  	@media screen and (min-device-width: 992px) and (max-device-width: 3000px){
  		.duedatepicker{
  			padding-left: 6px !important;
  		}
  		.duedateselect{
  			padding-right: 0px !important;
  		}
  	}
  </style>
  <script type="text/javascript">
  	function andun() {
    $(".select2-container--open .select2-dropdown--above").hide();
    $(".select2-container--open .select2-dropdown--below").hide();
    }
    function andus() {
    $(".select2-container--open .select2-dropdown--above").show();
    $(".select2-container--open .select2-dropdown--below").show();
    }
  </script>
  <div class="col-lg-5 duedatepicker">
<input type="date" class="form-control  form-control-sm" id="duedate" name="duedate">
  </div>
</div>
</div>
<div class="col-lg-12">
  <div class="form-group row">
  <div class="col-lg-4">
<label for="reference" class="custom-label">Reference</label>
</div>
  <div class="col-lg-8">
<input type="text" class="form-control  form-control-sm" id="reference" name="reference">
  </div>
</div>
</div>
<div class="col-lg-12">
  <div class="form-group row">
  <div class="col-lg-4">
<label for="saleperson" class="custom-label">Sale Person</label>
</div>
  <div class="col-lg-8">
<input type="text" class="form-control  form-control-sm" id="saleperson" name="saleperson">
  </div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>


</div>

<div class="col-lg-8">
	
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingOne" >
<button class="accordion-button font-weight-bold" type="button">
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;">Customer Information</a>
</div>
</button>
</h5>
<div id="collapseOne" class="accordion-collapse collapse show"
aria-labelledby="headingOne">
<div class="accordion-body text-sm" style="padding-bottom: 0px;padding-top: 3px">
	
	
<div class="row">
<div class="col-lg-12">
  <div class="form-group row">
  <input type="hidden" name="customerid" id="customerid">
<div class="col-sm-4">
<label for="customername" class="custom-label"><span class="text-danger">Customer Name *</span></label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="customername" name="customername" required placeholder="Customer Name">
</div>
  </div>
</div>
</div>
 
<div class="row">
	<div class="col-lg-12">
  <div class="form-group row">
<div class="col-sm-4">
<label for="customername" class="custom-label">Billing Address</label>
</div>
<div class="col-sm-5">
<input type="hidden" name="address1" id="address1">
<input type="hidden" name="address2" id="address2">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="area" id="area"  placeholder="Street">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="city" id="city" placeholder="City/Town">
</div>
  </div>
</div>
</div>

<div class="row">
	<div class="col-lg-12">
  <div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-3 mtcolumn">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="state" id="state" placeholder="State">
</div>
<div class="col-sm-2 mtcolumn">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="pincode" id="pincode" min="0" placeholder="Pin">
</div>
<div class="col-sm-3 mtcolumn">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="district" id="district" placeholder="Country/Region">
</div>
  </div>
</div>
</div>

<div class="row">
<div class="col-lg-6" style="display:none">
<h6>Shipping Address <label><input type="checkbox" name="sameaddress" id="sameaddress" onchange="sameadd()" value="0"> Same as Billing Address</label></h6>
<div class="row">
<div class="col-md-6">
  <div class="form-group">
<label>Door No. / House Name</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="saddress1" id="saddress1">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
<label>Street Name</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="saddress2" id="saddress2">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
<label>Area</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sarea" id="sarea">
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
<label>City</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="scity" id="scity">
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
<label>District</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sdistrict" id="sdistrict">
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
<label>State</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sstate" id="sstate">
  </div>
</div>
<div class="col-md-4">
  <div class="form-group">
<label>Pin Code</label>
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="spincode" id="spincode" min="0">
  </div>
</div>
</div>
</div>
</div>
<div class="row" style="display:none">
<div class="col-md-6">
  <div class="form-group">
<label>GSTIN</label>
<input type="text" autocomplete="off" class="form-control  form-control-sm" name="gstno" id="gstno" >
  </div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>

</div>
<script>
function sameadd()
{
var address1=document.getElementById('address1');
var address2=document.getElementById('address2');
var area=document.getElementById('area');
var city=document.getElementById('city');
var district=document.getElementById('district');
var state=document.getElementById('state');
var pincode=document.getElementById('pincode');
var sameaddress=document.getElementById('sameaddress');
if(sameaddress.checked==true)
{
document.getElementById('saddress1').value=address1.value;
document.getElementById('saddress2').value=address2.value;
document.getElementById('sarea').value=area.value;
document.getElementById('scity').value=city.value;
document.getElementById('sdistrict').value=district.value;
document.getElementById('sstate').value=state.value;
document.getElementById('spincode').value=pincode.value;
}
else
{
document.getElementById('saddress1').value='';
document.getElementById('saddress2').value='';
document.getElementById('sarea').value='';
document.getElementById('scity').value='';
document.getElementById('sdistrict').value='';
document.getElementById('sstate').value='';
document.getElementById('spincode').value='';
}
}
</script>
<hr class="p-0 mb-1 mt-1">
<div class="row">
	
	<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
	 <h5 class="accordion-header" id="headingOne" >
<button class="accordion-button font-weight-bold" type="button">
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;">Item Information</a>
</div>
</button>
</h5>
<div id="collapseOne" class="accordion-collapse collapse show"
aria-labelledby="headingOne">
<div class="accordion-body text-sm" style="padding-bottom: 0px;padding-top: 3px">
	
	
	
<div class="table-responsive">
  <table class="table table-bordered" id="purchasetable">
<thead>
<tr><th style="display:none"></th><th></th><th>ITEM DETAILS</th><th style="display:none">DESCRIPTION</th><th style="display:none">HSN</th><th style="display:none">MRP</th><th>QUANTITY</th><th>RATE</th><th>TAX</th><th style="display:none">Discount</th><th>AMOUNT</th><th></th></tr>
</thead>
<tbody>
<tr>
<td class="priority" style="display:none"> 1</td>
<td><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td><input type="hidden" name="productid[]" id="productid1"><input type="text" name="productname[]" id="productname1" required class="form-control form-control-sm bordernoneinput" ></td>
<td style="display:none"><input type="text" name="productnotes[]" id="productnotes1" class="form-control form-control-sm bordernoneinput"></td>
<td style="display:none"><input type="text" name="producthsn[]" id="producthsn1" class="form-control form-control-sm bordernoneinput"></td>
<td style="display:none"><input type="number" min="0" step="0.01" name="mrp[]" id="mrp1" class="form-control form-control-sm bordernoneinput"></td>
<td><input type="number" min="0" step="0.01" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput" onChange="productcalc(1)"></td>
<td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:black;font-size: 14.5px !important;"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="productrate[]" readonly  required id="productrate1" class="form-control form-control-sm bordernoneinput" onChange="productcalc(1)"></div></td>
<td><input type="number" min="0" step="0.01" name="vat[]" readonly id="vat1" class="form-control form-control-sm bordernoneinput"></td>
<td style="display:none"><input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount1" class="form-control form-control-sm bordernoneinput" onChange="productcalc(1)"></td>
<td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:black;font-size: 14.5px !important;"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue1" class="form-control form-control-sm bordernoneinput"style="background:none;" readonly ></div></td>
<style type="text/css">
	@media screen and (min-device-width: 1526px) and (max-device-width: 3000px){
		.btnclosebtn{
			padding-right: 0px !important;
		}
	}
</style>
<td class="btnclosebtn"><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
</tbody>
</table>
</div>

</div>
</div>
</div>
</div>

</div>
<div class="row">
<div class="col-lg-8">
	<p align="left" style="margin:0px;padding:0px;">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;padding: 3.5px 4.5px 3.5px 4.5px !important;"><i style="font-size: 14px;color:#0066cc;" class="fa fa-plus-circle"></i> Add another line</a></p>

<div class="form-group row">
	<div class="row">
	<div class="form-group row">
	<div class="col-lg-4">
		<label class="custom-label" for="totalitems">Total Items</label>
	</div>
	<div class="col-lg-8">
		<input required type="text" name="totalitems" id="totalitems" class="form-control form-control-sm" style="width:50px;" readonly  value="0" >
	</div>
	</div>
</div>
<!-- <div class="col-lg-3"> <label class="custom-label" for="totalitems">Total Items</label> </div>
<div class="col-lg-9"> 
<input required type="text" name="totalitems" id="totalitems" class="form-control form-control-sm" style="width:50px;margin-bottom: 9px !important;" readonly  value="0" ></div> -->
<!-- <div class="col-lg-3">
  
</div> -->
<div class="row">
	<div class="form-group row">
	<div class="col-lg-4">
		<label class="custom-label" for="terms">Terms</label>
	</div>
	<div class="col-lg-8">
		<!-- <input type="text" name="terms" class="form-control form-control-sm"> -->
		<textarea class="form-control form-control-sm" style="height: 30px !important;"></textarea>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group row">
	<div class="col-lg-4">
		<label class="custom-label" for="description">Description</label>
	</div>
	<div class="col-lg-8">
		<!-- <input type="text" name="description" class="form-control form-control-sm"> -->
		<textarea class="form-control form-control-sm" style="height: 30px !important;"></textarea>
	</div>
	</div>
</div>
<!-- <div class="col-lg-3"> Billed By 


<?=$currentusername?><a class="btn btn-primary" data-html="true" data-placement="top" data-popover-content="#a1" data-toggle="popover" data-trigger="focus" href="#" tabindex="0"><i class="fas fa-edit"></i></a>

Content for Popover #1
<div class="hidden d-none" id="a1">
  <div class="popover-heading">
    This is the heading for #1
  </div>

  <div class="popover-body">
    
<input type="text" name="preparedby" id="preparedby" class="form-control form-control-sm">
  </div>
</div>
</div> -->
<div class="col-lg-3">
</div>
  </div>

<div class="row mb-1" style="display:none">
<div class="col-lg-3"> Tax Type </div>
<div class="col-lg-3">
  <select required type="text" name="taxtype" id="taxtype" class="form-control form-control-sm" onChange="gstcalc();">
  <option value="IntraState" selected>IntraState</option>
  <option value="InterState">InterState</option>
  </select>
</div>
  </div>
  <div class="row mb-1" style="display:none">
<div class="col-lg-8">
<style>
#gsttable td,th
{
padding:1px;;
}
</style>
<div class="table-responsive" id="gsttablediv">
<table class="table table-bordered" id="gsttable" style="font-size:12px;">
<tr>
<th >Taxable<br> Amount</th><th >SGST %</th><th >Amount</th><th >CGST %</th>
<th >Amount</th>
<th >GST</th>
<th >Total Tax<br> Amount</th>
</tr>
<tr>
<td class="text-center"><input type="text" name="tax25" id="tax25" class="form-control form-control-sm" style="width:75px" readonly></td><td class="text-center">2.5%</td><td class="text-center"><input type="text" name="cgst25" id="cgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td class="text-center">2.5%</td>
<td class="text-center"><input type="text" name="sgst25" id="sgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td style="">5%</td> <td style=" "><input type="text" name="gst25" id="gst25"   class="form-control form-control-sm" style="width:50px;" readonly ></td>
</tr>
<tr>
<td class="text-center"><input type="text" name="tax6" id="tax6"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td class="text-center">6%</td><td class="text-center"><input type="text" name="cgst6" id="cgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td class="text-center">6%</td>
<td class="text-center"><input type="text" name="sgst6" id="sgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td style="">12%</td> <td style=""><input type="text" name="gst6" id="gst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
</tr>
<tr>
<td class="text-center"><input type="text" name="tax9" id="tax9"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td class="text-center">9%</td><td class="text-center"><input type="text" name="cgst9" id="cgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td class="text-center">9%</td>
<td class="text-center"><input type="text" name="sgst9" id="sgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td style="">18%</td> <td style="  "><input type="text" name="gst9" id="gst9"   class="form-control form-control-sm" style="width:50px;" readonly ></td>
</tr>
<tr>
<td class="text-center"><input type="text" name="tax14" id="tax14"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td class="text-center">14%</td> <td class="text-center"><input type="text" name="cgst14" id="cgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td class="text-center">14%</td>
<td class="text-center"><input type="text" name="sgst14" id="sgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td style="">28%</td> <td style="  "><input type="text" name="gst14" id="gst14"   class="form-control form-control-sm" style="width:50px;" readonly ></td>
</tr>
<tr>
<td colspan="6" style="text-align:right; ">Total GST Amount <?php echo $rescurrency[0]; ?></td> <td style=""><input type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm" style="width:50px;" readonly ></td>
</tr>
</table>
</div>
</div>
  </div>
</div>
<div class="col-lg-4" style="background-color:#fbfafa;">
<div class="p-3">
 <div class="row mb-1">
<div class="col-6" >Sub Total <span class="pull-right">:</span> <?php echo $rescurrency[0]; ?></div>
<div class="col-6">
  <input required type="text" name="totalamount" id="totalamount" class="form-control form-control-sm bordernoneinput" style="background:none; text-align:right"  readonly  value="0" >
</div>
  </div>
  <div class="row mb-1" >
<div class="col-6" > Total Tax <span class="pull-right">:</span> <?php echo $rescurrency[0]; ?></div>
<div class="col-6">
  <input required type="text" name="totalvatamount" id="totalvatamount" class="form-control form-control-sm bordernoneinput" style="background:none; text-align:right"  readonly  value="0" >
</div>
  </div>
  <div class="row mb-1" >
<div class="col-6" > <!-- <span style="float:left">Discount </span> 
  <input type="text" name="discount" class="form-control form-control-sm"  id="discount" value="0" onChange="discount1()" style="width:50px;"  >  -->
  <div class="input-group input-group-sm">
  	<span style="float:left">Discount </span>
     <div class="input-group-prepend">
       <input type="text" name="discount" class="form-control form-control-sm"  id="discount" value="0" onChange="discount1()" style="width:50px;border: 1px solid #e0e3e6 !important;">
    </div>
    <select class="form-control form-control-sm" style="border: 1px solid #e0e3e6 !important;background-color: #f5f5f5;">
    	<option>%</option>
    	<option><?php echo $rescurrency[0]; ?></option>
    </select>
  </div>
</div>
<div class="col-6" >
  <input required type="text" name="discountamount" id="discountamount" class="form-control form-control-sm bordernoneinput" style="background:none; text-align:right" value="0" onChange="productcalc1()" >
</div>
  </div>
  <div class="row mb-1" >
<div class="col-6" > Freight<span class="pull-right">:</span> <?php echo $rescurrency[0]; ?></div>
<div class="col-6" >
  <input required type="text" name="freightamount" id="freightamount" class="form-control form-control-sm bordernoneinput" style="background:none; text-align:right" value="0" onChange="productcalc1()" >
</div>
  </div>
  <div class="row mb-1" >
<div class="col-6" > Round off<span class="pull-right">:</span> <?php echo $rescurrency[0]; ?></div>
<div class="col-6">
  <input required type="text" name="roundoff" id="roundoff" class="form-control form-control-sm bordernoneinput" style="background:none; text-align:right" value="0" onChange="productcalcround()" >
</div>
  </div>
  <div class="row mb-1" style="font-size:18px;" >
<div class="col-6" > <strong>Grand Total<span class="pull-right">:</span></strong> <?php echo $rescurrency[0]; ?></div>
<div class="col-6">
  <input required type="text" name="grandtotal" id="grandtotal" class="form-control form-control-sm bordernoneinput" style="background:none; text-align:right; font-size:24px;" value="0" onChange="productcalc1()" readonly >
</div>
</div>
<div class="row mb-1" style="font-size:18px;" >
<div class="col-6" >
	<label class="custom-label" for="mode">Mode</label>
</div>
<div class="col-6">
  <select class="select4 form-control form-control-sm" name="mode" id="mode">
  	<option>1</option>
  	<option>2</option>
  	<option>3</option>
  </select>
</div>
</div>
<div class="row mb-1" style="font-size:18px;" >
<div class="col-6" >
	<label class="custom-label" for="balancedue">Balance Due</label>
</div>
<div class="col-6">
  <input type="text" name="balancedue" id="balancedue" class="form-control form-control-sm">
</div>
</div>

  </div>
</div>
  </div>
<!-- Start AddNewDue modal -->
                    <form method="post" action="">
                    <div class="modal fade" id="AddNewDue" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="border-radius: 0px;">
                                <div class="modal-header" style="border-radius:0px !important;">
                                    <h5 class="modal-title" id="exampleModalLabel">New Intra Tax</h5>
                                    <span type="button" onclick="funesintratax()" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true" style="font-size: 21px !important;font-weight: 600 !important;">&times;</span>
                                    </span>
                                </div>
                                <div class="modal-body" style="padding-bottom: 0px !important;margin-bottom: 0px !important;">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <div class="col-sm-5">
                                                    <label for="missingintratax" class="custom-label"><span class="text-danger">
                                                            Name *</span></label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control  form-control-sm"
                                                        id="missingintratax" name="missingintratax"
                                                        placeholder="Name" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer " style="display: block;">
                                <div class="col">
                                                  <button   onclick="funaddintratax()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitintratax" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>
                                                        <button type="button"
                                        class="btn btn-primary btn-sm btn-custom-grey"
                                        onclick="funesintratax()">Cancel</button> </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    <!-- End AddNewDue modal -->
  
  <?php
  include('navbottom.php');
  ?>
  <!-- <div class="row justify-content-center" id="footer" style="height: 50px;">

<div class="row col-md-12" style="padding-top: 8px;padding-left: 3px;">
    <div class="col">
      <button class="btn btn-primary btn-sm btn-custom-grey arlina-button expand-left" style="margin-right: 9px;background-color: #f8f8f8;border-color: #c6c6c6;color: #212529; display:none"   >
                <span class="label">Save as Draft</span> <span class="spinner"></span>
            </button>  

            <div class="btn-group dropup"> 
            <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-right: 0px;" type="submit" id="submit" name="submit" value="Submit"  >
                <span class="label">Save and Print</span> <span class="spinner"></span>
            </button> 
            <button type="button" class="btn btn-sm btn-custom dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" style="padding-left: 10px;padding-right: 10px;background-color: #D64830;color:#ffffff;margin-right: 9px; display:none">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Link 1</a></li>
      <li><a class="dropdown-item" href="#">Link 2</a></li>
      <li><a class="dropdown-item" href="#">Link 3</a></li>
  </ul>

            </div>

            <a class="btn btn-primary btn-sm btn-custom-grey" style="margin-left: 0px;background-color: #f8f8f8;border-color: #c6c6c6;color: #212529"
            href="invoices.php">Cancel</a>

           
    </div>
   
    <div class="col">
   

</div>
</div>

</div> -->
  
  
</form>
<?php
}
?>
	
</div>
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
<script>
let lineNo = 2;
$(document).ready(function () {
$(".purchaseadd-row").click(function () {
addnewrow(lineNo);  
lineNo++;   
}); 
}); 
</script>
<script>
function proautocomp(lineNo)
{
$( "#productname"+lineNo ).autocomplete({
   source: 'prosearch.php', select: function (event, ui) { $("#productname"+lineNo).val(ui.item.productname); $("#productnotes"+lineNo).val(ui.item.description); $("#producthsn"+lineNo).val(ui.item.hsncode); $("#mrp"+lineNo).val(ui.item.salemrp); $("#vat"+lineNo).val(ui.item.tax);$("#productrate"+lineNo).val(ui.item.salecost);$("#prodiscount"+lineNo).val(ui.item.salediscount); $("#vat"+lineNo).val(ui.item.tax);}, minLength: 2
 });
}
function addnewrow(lineNo)
{
markup = '<tr><td class="priority" style="display:none"> '+lineNo+'</td><td><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td><input type="hidden" name="productid[]" id="productid'+lineNo+'"><input type="text" name="productname[]" id="productname'+lineNo+'" class="form-control form-control-sm bordernoneinput" ></td><td style="display:none"><input type="text" name="productnotes[]" id="productnotes'+lineNo+'" class="form-control form-control-sm bordernoneinput"></td><td style="display:none"><input type="text" name="producthsn[]" id="producthsn'+lineNo+'" class="form-control form-control-sm bordernoneinput"></td><td style="display:none"><input type="number" min="0" step="0.01" name="mrp[]" id="mrp'+lineNo+'" class="form-control form-control-sm bordernoneinput"></td><td><input type="number" min="0" step="0.01" name="quantity[]" id="quantity'+lineNo+'" class="form-control form-control-sm bordernoneinput" onChange="productcalc('+lineNo+')"></td><td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:#cccccc"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="productrate[]" readonly  id="productrate'+lineNo+'" class="form-control form-control-sm bordernoneinput" onChange="productcalc('+lineNo+')"></div></td><td><input type="number" min="0" step="0.01" name="vat[]" readonly id="vat'+lineNo+'" class="form-control form-control-sm bordernoneinput"></td><td style="display:none"><input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount'+lineNo+'" class="form-control form-control-sm bordernoneinput" onChange="productcalc('+lineNo+')"></td><td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:#cccccc"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue'+lineNo+'" class="form-control form-control-sm bordernoneinput" style="background:none" readonly ></div></td><td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td></tr>';
tableBody = $("#purchasetable");
tableBody.append(markup);
proautocomp(lineNo);
renumber_table('#purchasetable');   
}
</script>
<script type="text/javascript">
$(document).ready(function() {
//Helper function to keep table row from collapsing when being sorted
var fixHelperModified = function(e, tr) {
var $originals = tr.children();
var $helper = tr.clone();
$helper.children().each(function(index)
{
  $(this).width($originals.eq(index).width())
});
return $helper;
};
//Make diagnosis table sortable
$("#purchasetable tbody").sortable({
helper: fixHelperModified,
stop: function(event,ui) {renumber_table('#purchasetable')}
}).disableSelection();
//Delete button in table rows
$('table').on('click','.btn-delete',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("purchasetable").rows.length;
if(x!=2)
{
r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
}
}
else
{
	alert('Unable to Delete First row');
}
});
});
//Renumber  table rows
function renumber_table(tableID) {
$(tableID + " tr").each(function() {
count = $(this).parent().children().index($(this)) + 1;
$(this).find('.priority').html(count);
});
}
</script>
<script type="text/javascript">
  $(function() {
  $( "#productname1" ).autocomplete({
   source: 'prosearch.php', select: function (event, ui) { $("#productname1").val(ui.item.productname); $("#productnotes1").val(ui.item.description); $("#producthsn1").val(ui.item.hsncode); $("#mrp1").val(ui.item.salemrp); $("#vat1").val(ui.item.tax);$("#productrate1").val(ui.item.salecost);$("#prodiscount1").val(ui.item.salediscount);}, minLength: 2
 });
  $( "#customername" ).autocomplete({
   source: 'customersearch.php', select: function (event, ui) { $("#area").val(ui.item.address); $("#city").val(ui.item.city); $("#district").val(ui.item.country); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pin); $( "#productname1" ).focus();}, minLength: 1
 });
 
 $( "#area" ).autocomplete({
   source: 'areasearch.php', select: function (event, ui) { $("#area").val(ui.item.area); $("#city").val(ui.item.city); $("#district").val(ui.item.district); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pincode);}, minLength: 2
 });
 
 $( "#email" ).autocomplete({
   source: 'franchisesearch.php?type=email',
 });
  });
</script>
<script>
function productcalc(id)
{
var quantity = $('#quantity'+id).val();
var productrate = $('#productrate'+id).val();
var prodiscount = $('#prodiscount'+id).val();
if((quantity!='')&&(productrate!='')&&(prodiscount!=''))
{
var productvalue = (parseFloat(quantity)*parseFloat(productrate));
var productdiscount=(parseFloat(prodiscount)/100)*parseFloat(productvalue);
productvalue=productvalue-parseFloat(productdiscount);
$('#productvalue'+id).val(parseFloat(Math.round(productvalue * 100) / 100).toFixed(2));
$('#productvalue'+id).tooltip('hide').attr('data-original-title', parseFloat(Math.round(productvalue * 100) / 100).toFixed(2)).tooltip('show');
var x = document.getElementById("purchasetable").rows.length;
x--;
var totalvat=0;
var totalproductval=0;
var totalproductdiscountval=0;
var productnames = document.getElementsByName('productname[]');
var vats = document.getElementsByName('vat[]');
var productvalues = document.getElementsByName('productvalue[]');
for (var i = 0; i < productnames.length; i++) 
{
var vat = parseFloat(vats[i].value);
if(!isNaN(vat))
{
var productvalue = parseFloat(productvalues[i].value);
var productvat=(productvalue*(1+(vat/100)));
totalproductval+=productvalue;
totalproductdiscountval+=productdiscount;
totalvat+=productvat;
}
}
discount1();
gstcalc();
totalvat=totalvat-totalproductval;
document.getElementById('totalamount').value=parseFloat(Math.round(totalproductval * 100) / 100).toFixed(2);
$('#totalamount').tooltip('hide').attr('data-original-title', parseFloat(Math.round(totalproductval * 100) / 100).toFixed(2)).tooltip('show');
document.getElementById('totalvatamount').value=parseFloat(Math.round(totalvat * 100) / 100).toFixed(2);
addnewrow((productnames.length+1));
var grandtotal;
var totalamount=document.getElementById('totalamount').value;
var totalvatamount=document.getElementById('totalvatamount').value;
var freightamount=document.getElementById('freightamount').value;
var discountamount=document.getElementById('discountamount').value;
grandtotal=parseFloat(totalamount)+parseFloat(totalvatamount)+parseFloat(freightamount);
grandtotal=grandtotal-parseFloat(discountamount);
var grandtotal1=Math.round(Number(grandtotal)).toFixed(2);
var roundoff=grandtotal1-grandtotal;
document.getElementById('roundoff').value=parseFloat(Math.round(roundoff * 100) / 100).toFixed(2);
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show'); 
}
}
function productcalc1()
{
var grandtotal;
var totalamount=document.getElementById('totalamount').value;
var totalvatamount=document.getElementById('totalvatamount').value;
var freightamount=document.getElementById('freightamount').value;
var discountamount=document.getElementById('discountamount').value;
grandtotal=parseFloat(totalamount)+parseFloat(totalvatamount)+parseFloat(freightamount);
grandtotal=grandtotal-parseFloat(discountamount);
var grandtotal1=Math.round(Number(grandtotal)).toFixed(2);
var roundoff=grandtotal1-grandtotal;
document.getElementById('roundoff').value=parseFloat(Math.round(roundoff * 100) / 100).toFixed(2);
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show');
}
function gstcalc()
{
var totalvat=0;
var totalproductval=0;
var totalproductdiscountval=0;
var cgst25amt=0;
var sgst25amt=0;
var gst25amt=0;
var cgst6amt=0;
var sgst6amt=0;
var gst6amt=0;
var cgst9amt=0;
var sgst9amt=0;
var gst9amt=0;
var cgst14amt=0;
var sgst14amt=0;
var gst14amt=0;
var tax25=0;
var tax6=0;
var tax9=0;
var tax14=0;
var taxtype=document.getElementById('taxtype');
if(taxtype.value!='')
{
var productnames = document.getElementsByName('productname[]');
var vats = document.getElementsByName('vat[]');
var productvalues = document.getElementsByName('productvalue[]');
for (var i = 0; i < productnames.length; i++) 
{
var vat = parseFloat(vats[i].value);
if(!isNaN(vat))
{
var productvalue = parseFloat(productvalues[i].value);
var productvat=(productvalue*(1+(vat/100)));
if(vat==5)
{
cgst25amt+=(productvalue*(1+(2.5/100)))-productvalue;
sgst25amt+=(productvalue*(1+(2.5/100)))-productvalue;
gst25amt+=(productvalue*(1+(5/100)))-productvalue;
tax25+=productvalue;
}
if(vat==12)
{
cgst6amt+=(productvalue*(1+(6/100)))-productvalue;
sgst6amt+=(productvalue*(1+(6/100)))-productvalue;
gst6amt+=(productvalue*(1+(12/100)))-productvalue;
tax6+=productvalue;
}
if(vat==18)
{
cgst9amt+=(productvalue*(1+(9/100)))-productvalue;
sgst9amt+=(productvalue*(1+(9/100)))-productvalue;
gst9amt+=(productvalue*(1+(18/100)))-productvalue;
tax9+=productvalue;
}
if(vat==28)
{
cgst14amt+=(productvalue*(1+(14/100)))-productvalue;
sgst14amt+=(productvalue*(1+(14/100)))-productvalue;
gst14amt+=(productvalue*(1+(28/100)))-productvalue;
tax14+=productvalue;
}
}
}   
if(taxtype.value=='IntraState')
{
document.getElementById('gsttablediv').innerHTML='<table class="table table-bordered" id="gsttable" style="font-size:12px;"><tr> <th >Taxable Amount</th><th >SGST %</th><th >Taxable Amount</th><th >CGST %</th> <th >Taxable Amount</th> <th >GST</th><th >Taxable Amount</th> </tr> <tr> <td class="text-center"><input type="text" name="tax25" id="tax25" class="form-control form-control-sm" style="width:50px;" readonly ></td><td >2.5%</td><td class="text-center"><input type="text" name="cgst25" id="cgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >2.5%</td> <td class="text-center"><input type="text" name="sgst25" id="sgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">5%</td> <td style=" "><input type="text" name="gst25" id="gst25"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax6" id="tax6"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >6%</td><td class="text-center"><input type="text" name="cgst6" id="cgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >6%</td> <td class="text-center"><input type="text" name="sgst6" id="sgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">12%</td> <td style=""><input type="text" name="gst6" id="gst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax9" id="tax9"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >9%</td><td class="text-center"><input type="text" name="cgst9" id="cgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >9%</td> <td class="text-center"><input type="text" name="sgst9" id="sgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">18%</td> <td style="  "><input type="text" name="gst9" id="gst9"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax14" id="tax14"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >14%</td> <td class="text-center"><input type="text" name="cgst14" id="cgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >14%</td> <td class="text-center"><input type="text" name="sgst14" id="sgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">28%</td> <td style="  "><input type="text" name="gst14" id="gst14"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td colspan="6" style="text-align:right; ">Total GST Amount <?php echo $rescurrency[0]; ?></td> <td style=""><input type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> </table>';
document.getElementById('cgst25').value=parseFloat(Math.round(cgst25amt * 100) / 100).toFixed(2);
document.getElementById('sgst25').value=parseFloat(Math.round(sgst25amt * 100) / 100).toFixed(2);
document.getElementById('gst25').value=parseFloat(Math.round(gst25amt * 100) / 100).toFixed(2);
document.getElementById('cgst6').value=parseFloat(Math.round(cgst6amt * 100) / 100).toFixed(2);
document.getElementById('sgst6').value=parseFloat(Math.round(sgst6amt * 100) / 100).toFixed(2);
document.getElementById('gst6').value=parseFloat(Math.round(gst6amt * 100) / 100).toFixed(2);
document.getElementById('cgst9').value=parseFloat(Math.round(cgst9amt * 100) / 100).toFixed(2);
document.getElementById('sgst9').value=parseFloat(Math.round(sgst9amt * 100) / 100).toFixed(2);
document.getElementById('gst9').value=parseFloat(Math.round(gst9amt * 100) / 100).toFixed(2);
document.getElementById('cgst14').value=parseFloat(Math.round(cgst14amt * 100) / 100).toFixed(2);
document.getElementById('sgst14').value=parseFloat(Math.round(sgst14amt * 100) / 100).toFixed(2);
document.getElementById('gst14').value=parseFloat(Math.round(gst14amt * 100) / 100).toFixed(2);
document.getElementById('tax25').value=parseFloat(Math.round(tax25 * 100) / 100).toFixed(2);
document.getElementById('tax6').value=parseFloat(Math.round(tax6 * 100) / 100).toFixed(2);
document.getElementById('tax9').value=parseFloat(Math.round(tax9 * 100) / 100).toFixed(2);
document.getElementById('tax14').value=parseFloat(Math.round(tax14 * 100) / 100).toFixed(2);
document.getElementById('totalvatamount1').value=parseFloat(Math.round((gst25amt+gst6amt+gst9amt+gst14amt) * 100) / 100).toFixed(2);
}
else
{
document.getElementById('gsttablediv').innerHTML='<table class="table table-bordered" id="gsttable" style="font-size:12px;"><tr> <th >Taxable Amount</th><th >IGST %</th> <th >Taxable Amount</th> <th style="display:none"  >SGST %</th> <th style="display:none"  >Amount</th> <th >GST</th><th >Taxable Amount</th> </tr> <tr> <td class="text-center"><input type="text" name="tax25" id="tax25" class="form-control form-control-sm" style="width:50px;" readonly ></td><td >5%</td> <td class="text-center"><input type="text" name="cgst25" id="cgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >2.5%</td> <td style="display:none" ><input type="text" name="sgst25" id="sgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">5%</td> <td style=" "><input type="text" name="gst25" id="gst25"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr>  <td class="text-center"><input type="text" name="tax6" id="tax6"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >12%</td> <td class="text-center"><input type="text" name="cgst6" id="cgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >6%</td> <td style="display:none" ><input type="text" name="sgst6" id="sgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">12%</td> <td style=""><input type="text" name="gst6" id="gst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax9" id="tax9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >18%</td> <td class="text-center"><input type="text" name="cgst9" id="cgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >9%</td> <td style="display:none" ><input type="text" name="sgst9" id="sgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">18%</td> <td style="  "><input type="text" name="gst9" id="gst9"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax14" id="tax14"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >28%</td> <td class="text-center"><input type="text" name="cgst14" id="cgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >14%</td> <td style="display:none" ><input type="text" name="sgst14" id="sgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">28%</td> <td style="  "><input type="text" name="gst14" id="gst14"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td colspan="4" style="text-align:right; ">Total GST Amount <?php echo $rescurrency[0]; ?></td> <td style=""><input type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> </table>';
document.getElementById('cgst25').value=parseFloat(Math.round(gst25amt * 100) / 100).toFixed(2);
document.getElementById('sgst25').value='0.00';
document.getElementById('gst25').value=parseFloat(Math.round(gst25amt * 100) / 100).toFixed(2);
document.getElementById('cgst6').value=parseFloat(Math.round(gst6amt * 100) / 100).toFixed(2);
document.getElementById('sgst6').value='0.00';
document.getElementById('gst6').value=parseFloat(Math.round(gst6amt * 100) / 100).toFixed(2);
document.getElementById('cgst9').value=parseFloat(Math.round(gst9amt * 100) / 100).toFixed(2);
document.getElementById('sgst9').value='0.00';
document.getElementById('gst9').value=parseFloat(Math.round(gst9amt * 100) / 100).toFixed(2);
document.getElementById('cgst14').value=parseFloat(Math.round(gst14amt * 100) / 100).toFixed(2);
document.getElementById('sgst14').value='0.00';
document.getElementById('gst14').value=parseFloat(Math.round(gst14amt * 100) / 100).toFixed(2);
document.getElementById('tax25').value=parseFloat(Math.round(tax25 * 100) / 100).toFixed(2);
document.getElementById('tax6').value=parseFloat(Math.round(tax6 * 100) / 100).toFixed(2);
document.getElementById('tax9').value=parseFloat(Math.round(tax9 * 100) / 100).toFixed(2);
document.getElementById('tax14').value=parseFloat(Math.round(tax14 * 100) / 100).toFixed(2);
document.getElementById('totalvatamount1').value=parseFloat(Math.round((gst25amt+gst6amt+gst9amt+gst14amt) * 100) / 100).toFixed(2);
}
}
}
function productcalcround()
{
var grandtotal;
var totalamount=document.getElementById('totalamount').value;
var totalvatamount=document.getElementById('totalvatamount').value;
var freightamount=document.getElementById('freightamount').value;
var discountamount=document.getElementById('discountamount').value;
var roundofff=document.getElementById('roundoff').value;
grandtotal=parseFloat(totalamount)+parseFloat(totalvatamount)+parseFloat(freightamount);
grandtotal=grandtotal-parseFloat(discountamount);
if(parseFloat(roundofff)!=0)
{
var grandtotal1=Math.round(Number(grandtotal)).toFixed(2);  
var roundoff=grandtotal1-grandtotal;
document.getElementById('roundoff').value=parseFloat(Math.round(roundoff * 100) / 100).toFixed(2);
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show');
}
else
{
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal * 100) / 100).toFixed(2);
}
}
function discount1()
{
var disper=document.getElementById('discount').value;
var totalamount=document.getElementById('totalamount').value;
if((disper!='')&&(disper!='0'))
{
var discountamount=(parseFloat(disper)/100)*parseFloat(totalamount);
document.getElementById('discountamount').value=parseFloat(Math.round((discountamount) * 100) / 100).toFixed(2);
productcalc1();
}
}
</script>
<script>
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






    <style>
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
	<script>
	
$(function(){
    
    $("[data-toggle=popover]").popover({
        html : true,
        content: function() {
            var content = $(this).attr("data-popover-content");
            return $(content).children(".popover-body").html();
        },
        title: function() {
            var title = $(this).attr("data-popover-content");
            return $(title).children(".popover-heading").html();
        }
    });
    
});
	</script>
	<script type="text/javascript">
  	$("#duedateselects").on("select2:open", function() { 
    $("#configureunits").attr("data-bs-target","#AddNewDue");
    });
  	$("#duedateselects").on("select2:open", function() { 
    document.getElementById("configureunits").innerHTML = "+ New";
    });
	</script>
</body>
</html>