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
$duedates=mysqli_real_escape_string($con, $_POST['duedates']);
//$orderdcno=mysqli_real_escape_string($con, $_POST['orderdcno']);
$orderdcno="";
$saleperson=mysqli_real_escape_string($con, $_POST['saleperson']);
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
//$preparedby=mysqli_real_escape_string($con, $_POST['preparedby']);
$preparedby="";
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
$terms=mysqli_real_escape_string($con, $_POST['terms']);
$notes=mysqli_real_escape_string($con, $_POST['notes']);
$description=mysqli_real_escape_string($con, $_POST['description']);
$validpaidamount=mysqli_real_escape_string($con, $_POST['validpaidamount']);
$validbalance=mysqli_real_escape_string($con, $_POST['validbalance']);
$fileattach="";
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
$manufacturer=mysqli_real_escape_string($con, $_POST['manufacturer'][$i]);
$producthsn=mysqli_real_escape_string($con, $_POST['producthsn'][$i]);
$productnotes=mysqli_real_escape_string($con, $_POST['productnotes'][$i]);
$productdescription=mysqli_real_escape_string($con, $_POST['productdescription'][$i]);
$batch=mysqli_real_escape_string($con, $_POST['batch'][$i]);
$expdate=mysqli_real_escape_string($con, $_POST['expdate'][$i]);
$mrp=mysqli_real_escape_string($con, $_POST['mrp'][$i]);
$vat=mysqli_real_escape_string($con, $_POST['vat'][$i]);
$quantity=mysqli_real_escape_string($con, $_POST['quantity'][$i]);
$productrate=mysqli_real_escape_string($con, $_POST['productrate'][$i]);
$noofpacks=mysqli_real_escape_string($con, $_POST['noofpacks'][$i]);
$prodiscount=mysqli_real_escape_string($con, $_POST['prodiscount'][$i]);
$productvalue=mysqli_real_escape_string($con, $_POST['productvalue'][$i]);
$taxvalue=mysqli_real_escape_string($con, $_POST['taxvalue'][$i]);
$productnetvalue=mysqli_real_escape_string($con, $_POST['productnetvalue'][$i]);


$files = array_filter($_FILES['fileattach']['name']); //Use something similar before processing files.
// Count the number of uploaded files in array
$total_count = count($_FILES['fileattach']['name']);
// Loop through every file
for( $i=0 ; $i < $total_count ; $i++ ) {
   //The temp file path is obtained
   $tmpFilePath = $_FILES['fileattach']['tmp_name'][$i];
   //A file path needs to be present
   if ($tmpFilePath != ""){
      //Setup our new file path
      $newFilePath = "./fileattach/".time().$_FILES['fileattach']['name'][$i];
      //File is uploaded to temp dir
      if(move_uploaded_file($tmpFilePath, $newFilePath)) {
         if($fileattach!="")
		 {
			 $fileattach.=" | ".$newFilePath;
		 }
		 else
		 {
			 $fileattach.="".$newFilePath;
		 }
      }
   }
}

if($productname!='')
{
$sql=mysqli_query($con, "insert into pairinvoices set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', customername='$customername', customerid='$customerid', address1='$address1', address2='$address2', area='$area', city='$city', state='$state', district='$district', pincode='$pincode', saddress1='$saddress1', saddress2='$saddress2', sarea='$sarea', scity='$scity', sstate='$sstate', sdistrict='$sdistrict', spincode='$spincode', gstno='$gstno', invoiceterm='$invoiceterm', invoiceno='$invoiceno', invoicedate='$invoicedate', invoiceamount='$invoiceamount', duedate='$duedate', duedates='$duedates', productid='$productid', productname='$productname', manufacturer='$manufacturer', producthsn='$producthsn', productnotes='$productnotes', productdescription='$productdescription', batch='$batch', expdate='$expdate', mrp='$mrp', vat='$vat', quantity='$quantity', productrate='$productrate', noofpacks='$noofpacks', prodiscount='$prodiscount', productvalue='$productvalue',  taxvalue='$taxvalue',  productnetvalue='$productnetvalue', totalitems='$totalitems', orderdcno='$orderdcno', reference='$reference', saleperson='$saleperson', totalvatamount='$totalvatamount', totalamount='$totalamount', discount='$discount', discountamount='$discountamount', freightamount='$freightamount', roundoff='$roundoff', grandtotal='$grandtotal', preparedby='$preparedby', taxtype='$taxtype', cgst25='$cgst25', sgst25='$sgst25', gst25='$gst25', cgst6='$cgst6', sgst6='$sgst6', gst6='$gst6', cgst9='$cgst9', sgst9='$sgst9', gst9='$gst9', cgst14='$cgst14', sgst14='$sgst14', gst14='$gst14', tax25='$tax25', tax6='$tax6', tax9='$tax9', tax14='$tax14', terms='$terms', notes='$notes', description='$description', fileattach='$fileattach'");
if($sql)
{
$salesid=mysqli_insert_id($con);
$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-$quantity where id='$productid'");
}
else
{
echo mysqli_error($con);
}
}
$tid=mysqli_insert_id($con);
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Invoice', '{$tid}')");
}
if(($validpaidamount!='')&&($validpaidamount!='0'))
{
$sql=mysqli_query($con, "insert into pairsalespayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='RECEIPT', customername='$customername', customerid='$customerid', receiptno='$invoiceno', receiptdate='$invoicedate', amount='$invoiceamount', paymentmode='$invoiceterm', notes='-'");
if($sql)
{
$paymentid=mysqli_insert_id($con);
$sqle=mysqli_query($con,"insert into pairsalespayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', customerid='$customerid', invoiceno='$invoiceno', invoicedate='$invoicedate', amount='$invoiceamount'");
if($sqle)
{
if($validpaidamount==$grandtotal)
{	
	$sqler=mysqli_query($con,"update pairinvoices set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='1' where invoiceno='$invoiceno' and invoicedate='$invoicedate' and customerid='$customerid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
}
else
{
	$sqler=mysqli_query($con,"update pairinvoices set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='2' where invoiceno='$invoiceno' and invoicedate='$invoicedate' and customerid='$customerid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
}
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
.tdmove:hover {
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
background-color: #ffffff;
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
<style>

</style>
<!-------------------customer add info start ------------------------------->
<!-------------------customer add info end ------------------------------->
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
$sqliet=mysqli_query($con, "select pos, invoice, invoiceprefix, (invoicesuffix+1) as invoicesuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$infoet=mysqli_fetch_array($sqliet);
$franpos=$infoet['pos'];
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
<hr class="p-0 mb-1 mt-1">
<!----------------------------------------------- product add start ----------------------------------------->
<!----------------------------------------------- pro cat sub unit modal start --------------------------->
<!----------------------------------------------- Start AddNewDefaultUnit modal ---------------------------->
<div class="modal fade" id="proAddNewDefaultUnit" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Units</h5>
<span type="button" onclick="profunesdefaultunit()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form  action="" method="post" role="form">
<div class="row justify-content-center">
<div class="col-md-12">
<div class="row">
<div class="col-md-4">
<div class="form-group row" id="prounitsindes">
<label for="proUnit" class="custom-label text-danger"><span
class="">Unit *</span></label>
</div>
<input type="text" class="form-control  form-control-sm"
id="promissingdefaultunit" name="promissingdefaultunit"
placeholder="Unit" required>
</div>
<div class="col-md-7 unitmod">
<div class="form-group row" id="prounitsindes">
<label for="proUnit" class="custom-label text-danger" id="prouqcindes"><span>
Unique Quanty Code(UQC) *</span></label>
</div>
<div class="form-group row">
<input type="text" class="form-control  form-control-sm" id="prouqc"
name="prouqc" placeholder="Unique Quanty Code(UQC)" required>
</div>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer mfsub" style="margin-bottom: 0px !important;margin-top: 30px !important;">
<div class="col">
<button   onclick="profunadddefaultunit()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="prosubmitunit" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="profunesdefaultunit()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!------------------------------------ End AddNewDefaultUnit modal ------------------------------------>
<!------------------------------------ Start AddNewCategory modal ------------------------------------>
<div class="modal fade" id="proAddNewCategory" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New Category</h5>
<span type="button" onclick="profunescategory()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingcategory" class="custom-label"><span class="text-danger">
Name *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="procategory" class="form-control form-control-sm mb-4" id="promissingcategory" placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div><!--
<div class="modal-body" style="padding: 1rem 0px 0px 2rem !important;">
<div class="row justify-content-center">
<div class="col-lg-12">
<label for="Unit" class="custom-label"><span class="text-danger">Name *</span></label>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="justify-content-center p-1">
<div style="margin-left: 30px;margin-right: 30px;"> -->
<!-- <input type="text" name="procategory" class="form-control form-control-sm mb-4" id="promissingcategory" required> -->
<!-- </div> -->
<?php
// $sqli = mysqli_query($con, "select distinct category from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and category!='' order by category asc");
// while ($info = mysqli_fetch_array($sqli)) {
?>
<?php
// }
?>
<?php
// $sqli = mysqli_query($con, "select * from paircategory where createdid='$companymainid' and createdby='".$_SESSION['unqwerty']."' order by category asc");
// while ($info = mysqli_fetch_array($sqli)) {
?>
<!-- <div style="margin-left: 30px;margin-right: 30px;">
<input type="text" name="procategoryies[]" value="" class="form-control form-control-sm mb-4" required>
</div> -->
<?php
// }
?>
<!-- <div class="container1">
<p style="margin-left:180px; padding:0">
<a class="add_form_field btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another Category </span></a></p>
</div> -->
<!-- </div> -->
<!-- <script type="text/javascript">
$(document).ready(function() {
var wrapper = $(".container1");
var add_button = $(".add_form_field");
$(add_button).click(function(e) {
e.preventDefault();
$(wrapper).prepend('<div style="margin-left: 30px;margin-right: 30px;"><input type="text" name="procategory[]" class="form-control form-control-sm"><a href="#" class="delete" style="width:max-content;position:relative;top:-27px;left:339px;"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></div>   '); //add input box<div class="mt-1" style="margin-left:30px;"><input type="text" name="procat[]" class="form-control form-control-sm" style="width:332px;"><a href="#" class="delete" style="width:max-content;position:relative;top:-27px;left:345px;"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;" class="mt-1 mb-1"></a></div>
});
$(wrapper).on("click", ".delete", function(e) {
e.preventDefault();
$(this).parent('div').remove();
x--;
})
});</script> -->
<div class="modal-footer ">
<div class="col">
<button   onclick="profunaddcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="prosubmitcategory" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="profunescategory()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!-- </form> -->
<!------------------------------------ End AddNewCategory modal ------------------------------------>
<!------------------------------------ Start AddNewSubCategory modal ------------------------------------>
<div class="modal fade" id="proAddNewSubCategory" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="proexampleModalLabel">New Sub Category</h5>
<span type="button" onclick="profunessubcategory()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<div class="modal-body mbsub">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingsubcategory" class="custom-label"><span class="text-danger">
Name *</span></label>
</div>
<div class="col-sm-7">
<input type="text" class="form-control  form-control-sm"
id="promissingsubcategory" name="promissingsubcategory"
placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer mfsub">
<div class="col">
<button   onclick="profunaddsubcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="prosubmitsubcategory" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="profunessubcategory()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!-- </form> -->
<!------------------------------------- End AddNewSubCategory modal ------------------------------------->
<!------------------------------------- pro cat sub unit modal end ------------------------------------->
<!------------------------------------------ pro style start ------------------------------------------>
<!------------------------------------------ productadd.css ------------------------------------------>
<!-- <link href="productadd.css" rel="stylesheet"> -->
<style>
.protables tbody tr:nth-of-type(odd) {}
.protables {
border: 0;
}
.protables caption {
font-size: 1.3em;
}
.protables thead {
border: none;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}
.protables tr {
border-bottom: 1px solid #ddd;
display: block;
margin-bottom: 1em;
}
.protables thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
.protables td {
color: #212529 !important;
border-bottom: 1px solid #ddd;
display: block;
font-size: .8em;
text-align: right;
}
.protables td::before {
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: bold;
text-transform: uppercase;
}
.protables td:last-child {
border-bottom: 0;
}
</style>
<style>
.country:focus{
outline: none !important;
border: none !important;
box-shadow: none !important;
}
.mfsub{
display: block;
}
.modal-content{
border-radius: 0px;
}
.modal-header{
border-radius:0px !important;
}
.modal-title{
color:#212529;
}
#procloseicon{
font-size: 21px;
font-weight: 600;
}
.modal-body{
padding-bottom: 0px !important;
margin-bottom: -24.5px !important;
}
.modal-footer{
display: block;
margin-bottom: -14.5px;
}
.mbsub{
padding-bottom: 0px !important;
margin-bottom: 0px !important;
}
.customcont-heading{
font-size: 18px;
}
#prounitsindes{
margin-bottom: 0px !important;
margin-top: 9px !important;
}
#prouqcindes{
padding-left: 0px;
}
.bi-question-circle{
color: #777777;
width: 14;
height: 14;
cursor: pointer;
margin-bottom: 3px;
}
#prouck{
height:36px;
}
#prodefaultunit{
width: 100%;
}
.deltophead{
margin-top:0px;
}
#prodelinpbrd{
border:1px solid lightgrey;
}
#prodescription{
height: 70px !important;
}
#profirstclsale{
width:10px;
}
#prosecondclsale{
width:75px;
}
#prothirdclsale{
width:82px;
}
#profourthclsale{
width:84px;
}
#profifthclsale{
width:72px;
}
#prosixthclsale{
width:33px;
}
.icon-drag{
color:#cccccc;
}
#proproductname1{
height:21px;
padding: 0px;
font-size: 16px !important;
}
#proruppesymbol{
color: #495057;
padding: 8px 3.75px;
height:21px;
font-size: 16px !important;
}
#proquantity1{
height:21px;
width: 24px;
text-align: right;
padding: 0px;
font-size: 16px !important;
}
#proproductrate1{
height:21px;
width: 24px;
text-align: right;
padding: 0px;
font-size: 16px !important;
}
#provat1{
height:21px;
padding: 0px;
text-align: left;
font-size: 16px !important;
}
#prointusymbol{
cursor: pointer;
}
#proimgintusymbol{
border-radius: 10px;
}
#protdfsize{
font-size:13px;
}
#protaxprefer{
height:48px !important;
}
#proflagicon{
width: 31.7%;
border: solid 2px #e9ecef;
height: 32px !important;
}
#proflagimg{
padding-top: 3.5px;
padding-bottom: 5px;
padding-left: 5px;
padding-right: 5px;
}
#protaxratecountry{
border:1px solid #fff !important;
background-color: #fff !important;
height: 21px !important;
padding-top: 11px !important;
}
#prointrahead{
height:48px !important;
}
</style>
<!------------------------------------------ pro style end ------------------------------------------>
<div class="modal fade" id="AddNewProduct" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">New Product</h5>
<span type="button" onclick="funesproduct()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<div class="modal-body mbsub">
<?php
if($permissionproductsinfo!='0')
{
?>
<?php
if($permissionproductsadd!='0')
{
?>
<div class="accordion" id="proaccordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="proheadingOne">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#procollapseOne"
aria-expanded="true" aria-controls="procollapseOne">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading"> <?= $row['prohead'] ?>
Information</a>
</div>
</button>
</h5>
<div id="procollapseOne" class="accordion-collapse collapse show"
aria-labelledby="proheadingOne">
<div class="accordion-body text-sm">
<?php
if($permissionproductcode!='0')
{
?>
<?php
if($permissionproductcodeadd!='0')
{
?>
<?php
$sql=mysqli_query($con,"select count(productcode) from pairproducts where createdid='$companymainid' and itemmodule='Products'");
$ans=mysqli_fetch_array($sql);
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="proproductcode" class="custom-label">Product Code</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="proproductcode" name="proproductcode" readonly value="<?= $ans[0]+1 ?>">
</div>
</div>
</div>
</div>
<?php
}
?>
<?php
}
?>
<?php
// if($permissionproname!='0')
// {
?>
<?php
// if($permissionpronadd!='0')
// {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="proproductname" class="custom-label"><span
class="text-danger">Name
*</span></label>
</div>
<div class="col-sm-8">
<input type="text"
class="form-control  form-control-sm"
id="proproductname" name="proproductname"
placeholder="Name" required>
</div>
</div>
</div>
</div>
<?php
// }
?>
<?php
// }
?>
<?php
if($permissionprocode!='0')
{
?>
<?php
if($permissionprocadd!='0')
{
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="procodetags" class="custom-label"><span
class="">Code / Tags</span></label>
</div>
<div class="col-sm-8">
<input type="text"
class="form-control  form-control-sm"
id="procodetags" name="procodetags"
placeholder="Code / Tags">
</div>
</div>
</div>
</div>
<?php
}
?>
<?php
}
?>
<?php
if($prounithead!='0')
{
?>
<?php
if($prounitadd!='0')
{
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="proUnit" class="custom-label"><span
class="text-danger">Unit * <svg data-toggle="tooltip" title="The product will be measured in terms of this unit (e.g.: kg, dozen)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
</div>
<div class="col-sm-8" id="prouck" onclick="andus()"><a class="">
<select
class="select2-field form-control  form-control-sm"
name="prodefaultunit" id="prodefaultunit" required></a>
<option selected disabled>Unit</option>
<?php
$sqlis = mysqli_query($con, "select uqc, unitname from pairunits where (createdid='$companymainid' or createdid='0') and (franchisesession='".$_SESSION["franchisesession"]."' or franchisesession='0') and (itemmodule='Products' or itemmodule='0') group by uqc order by unitname asc");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
<option value=",<?= $infos['unitname']?>,<?=$infos['uqc'] ?>">
<?= $infos['unitname'] ?> -
<?= $infos['uqc'] ?>
</option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
<?php
}
?>
<?php
}
?>
<?php
if($prohsnhead!='0')
{
?>
<?php
if($prohsnadd!='0')
{
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prohsncode" class="custom-label"><span
class="">HSN Code</span></label>
</div>
<div class="col-sm-8">
<input type="text"
class="form-control  form-control-sm"
id="prohsncode" name="prohsncode"
placeholder="HSN Code">
</div>
</div>
</div>
</div>
<?php
}
?>
<?php
}
?>
<?php
if($procathead!='0')
{
?>
<?php
if($procatadd!='0')
{
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="proCategory" class="custom-label"><span
class="">Category</span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select
class="select2-field form-control  form-control-sm"
name="procategory" id="procategory">
<?php
$sqli = mysqli_query($con, "select * from paircategory where (createdid='$companymainid' or createdid='0') and itemmodule='Products' order by category asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?= $info['category'] ?>">
<?= $info['category'] ?></option>
<?php
}
?>
<option selected disabled>Category</option>
</select>
</div>
</div>
</div>
</div>
<?php
}
?>
<?php
}
?>
<?php
if($prosubhead!='0')
{
?>
<?php
if($prosubadd!='0')
{
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prosubcategory" class="custom-label"><span class="">Sub Category</span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select
class="select2-field form-control form-control-sm"
name="prosubcategory" id="prosubcategory">
<?php
$sqli = mysqli_query($con, "select * from pairsubcategory where (createdid='$companymainid' or createdid='0') and itemmodule='Products' order by subcategory asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?= $info['subcategory'] ?>">
<?= $info['subcategory'] ?></option>
<?php
}
?>
<option selected disabled>Sub Category</option>
</select>
</div>
</div>
</div>
</div>
<?php
}
?>
<?php
}
?>
<?php
if($prodelhead!='0')
{
?>
<?php
if($prodeladd!='0')
{
?>
<div class="row justify-content-center deltophead">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="custom-label">Delivery</label>
</div>
<div class="col-sm-8">
<input type="text" name="prodelivery" class="form-control  form-control-sm" id="prodelinpbrd" placeholder="Delivery">
</div>
</div>
</div>
</div>
<?php
}
?>
<?php
}
?>
<?php
if($prodeshead!='0')
{
?>
<?php
if($prodesadd!='0')
{
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prodescription" class="custom-label"><span
class="">Description</span></label>
</div>
<div class="col-sm-8">
<textarea
class="form-control" id="prodescription"
name="prodescription" placeholder="Description"></textarea>
</div>
</div>
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
</div>
</div>
<?php
}
}
?>
<?php
if($permissionprovisibility!='0'){
?>
<?php
if($permissionprovisadd!='0'){
?>
<div class="accordion" id="proaccordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="proheadingfour">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#procollapsefour"
aria-expanded="true" aria-controls="procollapsefour">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Product Visibility</a>
</div>
</button>
</h5>
<div id="procollapsefour" class="accordion-collapse collapse show"
aria-labelledby="proheadingfour">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="custom-label mt-2 text-danger">Visibility * <svg data-toggle="tooltip" title="Visibility" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></label>
</div>
<div class="col-sm-8">
<div class="row">
<div class="col-lg-4 my-1">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="provisibility" id="provisibility" value="PUBLIC" checked>
<label class="custom-control-label custom-label" for="provisibility">Public</label>
</div>
</div>
<div class="col-lg-4 my-1">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="provisibility" id="pronovisibility" value="PRIVATE">
<label class="custom-control-label custom-label" for="pronovisibility">Private</label>
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
</div>
</div>
<?php
}
}
?>
<?php
if($permissionprosales!='0'){
?>
<?php
if($permissionprosaleadd!='0'){
?>
<div class="accordion" id="proaccordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="proheadingsale">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#procollapsesale"
aria-expanded="true" aria-controls="procollapsesale">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Sales
Information</a>
</div>
</button>
</h5>
<div id="procollapsesale" class="accordion-collapse collapse show"
aria-labelledby="proheadingsale">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<?php
if($permissionsalepricenameadd!='0'||$permissionsalemrpadd!='0'||$permissionsalepricerateadd!='0'||$permissionsaledescriptionadd!='0'){
?>
<div class="table-responsive">
<table class="table table-bordered" id="prosaletable">
<thead>
<tr><td class="text-uppercase" id="profirstclsale"><span id="protdfsize"></span></td>
<?php
if($permissionsalepricename!='0'){
?>
<?php
if($permissionsalepricenameadd!='0'){
?>
<td class="text-uppercase" id="prosecondclsale"><span id="protdfsize">PRICE NAME</span></td>
<?php
}
}
?>
<?php
if($permissionsalemrp!='0'){
?>
<?php
if($permissionsalemrpadd!='0'){
?>
<td class="text-uppercase" id="prothirdclsale"><span id="protdfsize">MRP</span> <svg version="1.1" id="proLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
<path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
<path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
<svg></td>
<?php
}
}
?>
<?php
if($permissionsalepricerate!='0'){
?>
<?php
if($permissionsalepricerateadd!='0'){
?>
<td class="text-uppercase" id="profourthclsale"><span id="protdfsize">PRICE/RATE</span> <svg version="1.1" id="proLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
<path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
<path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
<svg></td>
<?php
}
}
?>
<?php
if($permissionsaledescription!='0'){
?>
<?php
if($permissionsaledescriptionadd!='0'){
?>
<td class="text-uppercase" id="profifthclsale"><span id="protdfsize">DESCRIPTION</span></td>
<?php
}
}
?>
<td class="text-uppercase" id="prosixthclsale"><span id="protdfsize"></span></td></tr>
</thead>
<tbody>
<tr style="color: #ddd;">
<td data-label=""><svg version="1.1" id="proLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" ><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<?php
if($permissionsalepricename!='0'){
?>
<?php
if($permissionsalepricenameadd!='0'){
?>
<td data-label="PRICE NAME"><input type="hidden" name="proproductid[]" id="proproductid1"><input type="text" name="propricename[]" id="proproductname1" class="form-control form-control-sm bordernoneinput bor"  oninput="title(this)" data-toggle="tooltip" title="" placeholder="Sale Price or Trade Price or Wholesale Price"></td>
<?php
}
}
?>
<?php
if($permissionsalemrp!='0'){
?>
<?php
if($permissionsalemrpadd!='0'){
?>
<td data-label="MRP">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
<span class="input-group-text" id="proruppesymbol"><?php echo $rescurrency[0]; ?></span>
</div>
<input type="age" min="0" name="promrp[]" id="proquantity1" class="form-control form-control-sm bordernoneinput bor"  onChange="productcalc(1)" placeholder="0.00">
</div>
</td>
<?php
}
}
?>
<?php
if($permissionsalepricerate!='0'){
?>
<?php
if($permissionsalepricerateadd!='0'){
?>
<td data-label="SELLING PRICE"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" id="proruppesymbol"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)"  placeholder="0.00" type="age" min="0" name="prosellingprice[]"  id="proproductrate1" class="form-control form-control-sm bordernoneinput rup bor" onChange="productcalc(1)"></div></td>
<?php
}
}
?>
<?php
if($permissionsaledescription!='0'){
?>
<?php
if($permissionsaledescriptionadd!='0'){
?>
<td data-label="DESCRIPTION"><input type="text" min="0" name="prodescriptions[]" id="provat1" class="form-control form-control-sm bordernoneinput bor"></td>
<?php
}
}
?>
<td data-label=""><a onclick="addclick()" id="prointusymbol"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="proPath"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="proOval-1"></path></svg> </a><a class="btn-deletes" id="prointusymbol"><img src="assets/img/delete-row.png" width="15" height="15" id="proimgintusymbol"></a></td>
</tr>
</tbody>
</table>
</div>
<?php
}
?>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if($permissionpropurchase!='0'){
?>
<?php
if($permissionpropuradd!='0'){
?>
<div class="accordion" id="proaccordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="proheadingpurchase">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#procollapsepurchase"
aria-expanded="true" aria-controls="procollapsepurchase">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading"><?= $row['purch'] ?>
Information</a>
</div>
</button>
</h5>
<div id="procollapsepurchase" class="accordion-collapse collapse show"
aria-labelledby="proheadingpurchase">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<?php
if($permissionpurpricenameadd!='0'||$permissionpurmrpadd!='0'||$permissionpurpricerateadd!='0'||$permissionpurdescriptionadd!='0'){
?>
<div class="table-responsive">
<table class="table table-bordered" id="propurchasetable">
<thead>
<tr><td class="text-uppercase" id="profirstclsale"><span id="protdfsize"></span></td>
<?php
if($permissionpurpricename!='0'){
?>
<?php
if($permissionpurpricenameadd!='0'){
?>
<td class="text-uppercase" id="prosecondclsale"><span id="protdfsize">PRICE NAME</span></td>
<?php
}
}
?>
<?php
if($permissionpurmrp!='0'){
?>
<?php
if($permissionpurmrpadd!='0'){
?>
<td class="text-uppercase" id="prothirdclsale"><span id="protdfsize">MRP</span> <svg version="1.1" id="proLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
<path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
<path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
<svg></td>
<?php
}
}
?>
<?php
if($permissionpurpricerate!='0'){
?>
<?php
if($permissionpurpricerateadd!='0'){
?>
<td class="text-uppercase" id="profourthclsale"><span id="protdfsize">PRICE/RATE</span> <svg version="1.1" id="proLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
<path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
<path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
<svg></td>
<?php
}
}
?>
<?php
if($permissionpurdescription!='0'){
?>
<?php
if($permissionpurdescriptionadd!='0'){
?>
<td class="text-uppercase" id="profifthclsale"><span id="protdfsize">DESCRIPTION</span></td>
<?php
}
}
?>
<td class="text-uppercase" id="prosixthclsale"><span id="protdfsize"></span></td></tr>
</thead>
<tbody>
<tr style="color: #ddd;">
<td data-label=""><svg version="1.1" id="proLayer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<?php
if($permissionpurpricename!='0'){
?>
<?php
if($permissionpurpricenameadd!='0'){
?>
<td data-label="PRICE NAME"><input type="hidden" name="proproductid[]" id="proproductid1"><input type="text" name="propricenamepur[]" id="proproductname1" class="form-control form-control-sm bordernoneinput bor" oninput="title(this)" data-toggle="tooltip" title="" placeholder="Purchase Price or Trade Price or Wholesale Price"></td>
<?php
}
}
?>
<?php
if($permissionpurmrp!='0'){
?>
<?php
if($permissionpurmrpadd!='0'){
?>
<td data-label="MRP">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
<span class="input-group-text" id="proruppesymbol"><?php echo $rescurrency[0]; ?></span>
</div>
<input type="age" min="0" name="promrppur[]" id="proquantity1" class="form-control form-control-sm bordernoneinput bor" onChange="productcalc(1)" placeholder="0.00">
</div>
</td>
<?php
}
}
?>
<?php
if($permissionpurpricerate!='0'){
?>
<?php
if($permissionpurpricerateadd!='0'){
?>
<td data-label="SELLING PRICE"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" id="proruppesymbol"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)"  placeholder="0.00" type="age" min="0" name="prosellingpricepur[]"  id="proproductrate1" class="form-control form-control-sm bordernoneinput rup bor" onChange="productcalc(1)"></div></td>
<?php
}
}
?>
<?php
if($permissionpurdescription!='0'){
?>
<?php
if($permissionpurdescriptionadd!='0'){
?>
<td data-label="DESCRIPTION"><input type="text" min="0" name="prodescriptionspur[]" id="provat1" class="form-control form-control-sm bordernoneinput bor"></td>
<?php
}
}
?>
<td data-label=""><a onclick="addclick()" id="prointusymbol"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="proPath"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="proOval-1"></path></svg> </a><a class="btn-deletes" id="prointusymbol"><img src="assets/img/delete-row.png" width="15" height="15" id="proimgintusymbol"></a></td>
</tr>
</tbody>
</table>
</div>
<?php
}
?>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if($permissionprotaxes!='0'){
?>
<?php
if($permissionprotaxadd!='0'){
?>
<div class="accordion" id="proaccordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="proheadingFive">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#procollapseFive"
aria-expanded="true" aria-controls="procollapseFive">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Tax
Information</a>
</div>
</button>
</h5>
<div id="procollapseFive" class="accordion-collapse collapse show"
aria-labelledby="proheadingFive">
<div class="accordion-body text-sm">
<?php
if($permissionprotaxprefer!='0'){
?>
<?php
if($permissionprotaxpreferadd!='0'){
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="custom-label mt-2 text-danger">Tax Preference *</label>
</div>
<div class="col-sm-8">
<div class="row">
<div class="col-lg-5 my-1">
<div class="custom-control custom-radio mr-sm-2" onclick="taxable()">
<input type="radio" class="custom-control-input" name="protaxable" id="protaxable" value="1" checked>
<label class="custom-control-label custom-label" for="protaxable">Taxable</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<div id="protaxablediv">
<?php
if($permissionprotaxrate!='0'){
?>
<?php
if($permissionprotaxrateadd!='0'){
?>
<div class="row justify-content-center" id="protaxprefer">
<div class="col-sm-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="protaxratecountry"
class="custom-label"><span
class="">Tax Rate</span></label>
</div>
<div class="col-sm-8">
<div class="input-group mb-3 input-group-sm" id="proflagicon">
<div class="input-group-prepend">
<span class="input-group-text" id="proflagimg">
<img src="assets/img/Indian-Flag.png"
width="25"
height="20"></span>
</div>
<?php
$country=mysqli_query($con,"select * from paricountry");
$india=mysqli_fetch_array($country);
?>
<input type="text"
class="form-control  form-control-sm country" id="protaxratecountry"
name="protaxratecountry"
value="<?= $india['country'] ?>" readonly>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if($permissionprointratax!='0'){
?>
<?php
if($permissionprointrataxadd!='0'){
?>
<div class="row justify-content-center" id="prointrahead">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prointratax"
class="custom-label"><span
class="">Intra State
Tax Rate</span></label>
<hr class="dash" />
</div>
<div class="col-sm-8" onclick="andus()">
<select
class="select2-field form-control  form-control-sm"
name="prointratax" id="prointratax"
required>
<option selected disabled>Select</option>
<?php
$count=1;
$sqlit=mysqli_query($con, "select * from pairtaxrates  where taxgroups!=''and (createdid='$companymainid' or createdid='0') order by tax asc");
while($infot=mysqli_fetch_array($sqlit))
{
?>
<option value="<?=$infot['id']?>">
<?=$infot['taxname']?> -
<?=$infot['tax']?>%
</option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if($permissionprointertax!='0'){
?>
<?php
if($permissionprointertaxadd!='0'){
?>
<div class="row justify-content-center" id="prointrahead">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="prointertax"
class="custom-label"><span
class="">Inter State
Tax Rate</span></label>
<hr class="dash" />
</div>
<div class="col-sm-8">
<select
class="select2-field form-control  form-control-sm"
name="prointertax" id="prointertax"
required>
<option selected disabled>Select</option>
<?php
$count=1;
$sqlit=mysqli_query($con, "select * from pairtaxrates where createdid='$companymainid' or createdid='0' order by tax asc");
while($infot=mysqli_fetch_array($sqlit))
{
?>
<option value="<?=$infot['id']?>">
<?=$infot['taxname']?> -
<?=$infot['tax']?>%
</option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
<?php
}
}
?>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
</div>
<div class="modal-footer mfsub">
<div class="col">
<button onclick="funaddproduct()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit"  name="submitproduct" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funesproduct()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!--------------------------------------------- product add end --------------------------------------------->
<!-------------------customer add info start ------------------------------->
<!-- Start AddNewCategory modal -->
<div class="modal fade" id="custAddNewCategory" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New Category</h5>
<span type="button" onclick="funescategory()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="custcloseicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingcategory" class="custom-label"><span class="text-danger">
Name *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="custcategorys" class="form-control form-control-sm mb-4" id="custmissingcategory" placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div><!--
<div class="modal-body" style="padding: 1rem 0px 0px 2rem !important;">
<div class="row justify-content-center">
<div class="col-lg-12">
<label for="Unit" class="custom-label"><span class="text-danger">Name *</span></label>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="justify-content-center p-1">
<div style="margin-left: 30px;margin-right: 30px;"> -->
<!-- <input type="text" name="custcategory" class="form-control form-control-sm mb-4" id="custmissingcategory" > -->
<!-- </div> -->
<?php
// $sqli = mysqli_query($con, "select distinct category from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and category!='' order by category asc");
// while ($info = mysqli_fetch_array($sqli)) {
?>
<?php
// }
?>
<?php
// $sqli = mysqli_query($con, "select * from paircategory where createdid='$companymainid' and createdby='".$_SESSION['unqwerty']."' order by category asc");
// while ($info = mysqli_fetch_array($sqli)) {
?>
<!-- <div style="margin-left: 30px;margin-right: 30px;">
<input type="text" name="custcategoryies[]" value="" class="form-control form-control-sm mb-4" >
</div> -->
<?php
// }
?>
<!-- <div class="container1">
<p style="margin-left:180px; padding:0">
<a class="add_form_field btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another Category </span></a></p>
</div> -->
<!-- </div> -->
<!-- <script type="text/javascript">
$(document).ready(function() {
var wrapper = $(".container1");
var add_button = $(".add_form_field");
$(add_button).click(function(e) {
e.preventDefault();
$(wrapper).prepend('<div style="margin-left: 30px;margin-right: 30px;"><input type="text" name="custcategory[]" class="form-control form-control-sm"><a href="#" class="delete" style="width:max-content;position:relative;top:-27px;left:339px;"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></div>   '); //add input box<div class="mt-1" style="margin-left:30px;"><input type="text" name="custcat[]" class="form-control form-control-sm" style="width:332px;"><a href="#" class="delete" style="width:max-content;position:relative;top:-27px;left:345px;"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;" class="mt-1 mb-1"></a></div>
});
$(wrapper).on("click", ".delete", function(e) {
e.preventDefault();
$(this).parent('div').remove();
x--;
})
});</script> -->
<div class="modal-footer ">
<div class="col">
<button   onclick="funaddcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="custsubmitcategory" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funescategory()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!-- </form> -->
<!-- End AddNewCategory modal -->
<!-- Start AddNewSubCategory modal -->
<div class="modal fade" id="custAddNewSubCategory" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="custexampleModalLabel">New Sub Category</h5>
<span type="button" onclick="funessubcategory()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="custcloseicon">&times;</span>
</span>
</div>
<div class="modal-body mbsub">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingsubcategory" class="custom-label"><span class="text-danger">
Name *</span></label>
</div>
<div class="col-sm-7">
<input type="text" class="form-control  form-control-sm"
id="custmissingsubcategory" name="custmissingsubcategory"
placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer mfsub">
<div class="col">
<button   onclick="funaddsubcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="custsubmitsubcategory" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funessubcategory()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!-- </form> -->
<!-- End AddNewSubCategory modal -->
<!-- Start AddNewCustomer modal -->
<!-- customer style start  -->
<!-- customeradd -->

<link href="customeradd.css" rel="stylesheet">
<!-- gst select design -->
<style>
.modal-content{
border-radius: 0px;
}
.modal-header{
border-radius:0px !important;
}
.modal-title{
color:#212529;
}
#custcloseicon{
font-size: 21px;
font-weight: 600;
}
.modal-body{
padding-bottom: 0px !important;
margin-bottom: -24.5px !important;
}
.modal-footer{
display: block;
margin-bottom: -14.5px;
}
.mbsub{
padding-bottom: 0px !important;
margin-bottom: 0px !important;
}
.mfsub{
display: block;
}
.customcont-heading{
font-size: 18px;
}
.custvendorid{
border-bottom: 1px dashed grey;
}
.custhighfor{
height:42px;
}
.custprimarycontact{
border-bottom: 1px dashed grey;
}
#custdrpsalute{
position:relative;
top: -27px;
left: 81%;
color: #ced4da;
}
.custcompanyname{
border-bottom: 1px dashed grey;
}
.custdisplayname{
border-bottom: 1px dashed grey;
}
.custvis{
color: #ee0000;
}
.bi-question-circle{
color: #777777;
width: 14;
height: 14;
cursor: pointer;
}
.custtaxpre{
color: #ee0000;
}
#custgstblock{
display: none;
}
#custbillstreet{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 145px !important;
}
#custbillcity{
padding: 5px 8px;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
}
#custbillstate{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
}
#custbillpincode{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
}
#custbillcountry{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
}
#custshipstreet{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 145px !important;
}
#custshipcity{
padding: 5px 8px;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
}
#custshipstate{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
}
#custshippincode{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
}
#custshipcountry{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
}
</style>
<!-- customer style end -->
<div class="modal fade" id="custAddNewCustomer" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content" style="border-radius: 0px;">
<div class="modal-header" style="border-radius:0px !important;">
<h5 class="modal-title" style="color:#212529;">New Customer</h5>
<span type="button" onclick="funescustomer()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" style="font-size: 21px;font-weight: 600;">&times;</span>
</span>
</div>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-2" role="form">
<div class="modal-body" style="padding-bottom: 0px !important;margin-bottom: -24.5px !important;">
<!---------model begin------------------->
<input type="hidden" name="custcustomercode" id="custcustomercode" value="">
<input type="hidden" name="custlandline" id="custlandline" value="">
<input type="hidden" name="custcstno" id="custcstno" value="">
<?php
if ($permissioncusinfo != '0') {
?>
<?php
if ($permissioncusinfoadd != '0') {
?>
<div class="accordion" id="custaccordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="custheadingOne">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#custcollapseOne" aria-expanded="true" aria-controls="custcollapseOne">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Customer Information</a>
</div>
</button>
</h5>
<div id="custcollapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
<div class="accordion-body text-sm">
<?php
if ($cusidhead != '0') {
?>
<?php
if ($cusidadd != '0') {
?>
<?php
$sql = mysqli_query($con, "select count(customercode) from paircustomers where createdid='$companymainid'");
$ans = mysqli_fetch_array($sql);
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcustomerid" class="custom-label custvendorid" data-toggle="tooltip" title="Customer ID" data-placement="top">Customer ID</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="custcustomerid" name="custcustomerid" placeholder="Customer ID" readonly value="<?=$ans[0] + 1 ?>">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cuspcontacthead != '0') {
?>
<?php
if ($cuspcontactadd != '0') {
?>
<div class="row justify-content-center custhighfor">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custpcontact" class="custom-label custprimarycontact" data-toggle="tooltip" title="Primary Contact">Primary Contact <span id="custname"></span></label>
</div>
<div class="col-sm-3 ali">
<input type="text" class="form-control  form-control-sm" id="custsalute" name="custsalute" placeholder="Salutation" >
<!-- style="width:93px;"  -->
<i class="fa fa-angle-down" id="custdrpsalute"></i>
</div>
<div class="col-sm-5 ali one">
<input type="text" class="form-control  form-control-sm" id="custpcontact" name="custpcontact" placeholder="Name" onchange="custcompanynames()" oninput="pco(this)">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cuscnamehead != '0') {
?>
<?php
if ($cuscnameadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcompanyname" class="custom-label custcompanyname" data-toggle="tooltip" title="Company Name" data-placement="top">Company Name</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="custcompanyname" name="custcompanyname" placeholder="Company Name" onchange="custcompanynames()">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($permissioncusname != '0') {
?>
<?php
if ($permissioncusnadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcustomerdname" class="custom-label custdisplayname" data-toggle="tooltip" title="Display Name" data-placement="top"><span class="text-danger"> Customer</span></label><label class="custom-label custdisplayname" data-toggle="tooltip" title="Display Name" data-placement="top"><span class="text-danger">Name *</span></label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="custcustomerdname" name="custcustomerdname" placeholder="Display Name" required>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cuscathead != '0') {
?>
<?php
if ($cuscatadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custCategory" class="custom-label"><span
class="">Category</span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select
class="select2-field form-control  form-control-sm" name="custcategory" id="custcategory" >
<option selected disabled>Category</option>
<?php
$sqli = mysqli_query($con, "select * from paircategory where (createdid='$companymainid' or createdid='0') and itemmodule='Customers' order by category asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?=$info['category'] ?>">
<?=$info['category'] ?></option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cussubhead != '0') {
?>
<?php
if ($cussubadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custsubcategory" class="custom-label"><span
class="">Sub Category</span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select
class="select2-field form-control form-control-sm" name="custsubcategory" id="custsubcategory">
<option selected disabled>Sub Category</option>
<?php
$sqli = mysqli_query($con, "select * from pairsubcategory where (createdid='$companymainid' or createdid='0') and itemmodule='Customers' order by subcategory asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?=$info['subcategory'] ?>">
<?=$info['subcategory'] ?></option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusphonehead != '0') {
?>
<?php
if ($cusphoneadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custworkphone" class="custom-label workphone" data-toggle="tooltip" title="Work Phone" data-placement="top">Work Phone</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="custworkphone" name="custworkphone" placeholder="Work Phone">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusmobilephonehead != '0') {
?>
<?php
if ($cusmobilephoneadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custmobilephone" class="custom-label mobilephone" data-toggle="tooltip" title="Mobile Phone" data-placement="top">Mobile Phone</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="custmobilephone" name="custmobilephone" placeholder="Mobile Phone">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusmailhead != '0') {
?>
<?php
if ($cusmailadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custemail" class="custom-label email" data-toggle="tooltip" title="Email" data-placement="top">Email</label>
</div>
<div class="col-sm-8 ali">
<input type="email" class="form-control  form-control-sm" id="custemail" name="custemail" placeholder="Email">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cuswebhead != '0') {
?>
<?php
if ($cuswebadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custwebsite" class="custom-label website" data-toggle="tooltip" title="Website" data-placement="top">Website</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="custwebsite" name="custwebsite" placeholder="Website">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusbillhead != '0') {
?>
<?php
if ($cusbilladd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcustomername" class="custom-label">Billing Address</label>
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custbillstreet" id="custbillstreet"  placeholder="Street">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custbillcity" id="custbillcity" placeholder="City/Town">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custbillstate" id="custbillstate" placeholder="State">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="custbillpincode" id="custbillpincode" min="0" placeholder="Pin">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custbillcountry" id="custbillcountry" placeholder="Country/Region">
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusshiphead != '0') {
?>
<?php
if ($cusshipadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label for="custcustomername" class="custom-label" id="custshipword">Shipping Address</label>
</div>
<div class="col-sm-8 shipadd">
<div class="custom-control custom-checkbox" onclick="sameasbillingticaccess()">
<input type="checkbox" class="custom-control-input" name="custsameasbilling" id="custsameasbilling" checked>
<label class="custom-control-label custom-label" for="custsameasbilling"> Same as Billing Address</label>
</div>
</div>
</div>
</div>
</div>
<div id="custtotalshipadd">
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custshipstreet" id="custshipstreet"  placeholder="Street">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custshipcity" id="custshipcity" placeholder="City/Town">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custshipstate" id="custshipstate" placeholder="State">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="custshippincode" id="custshippincode" min="0" placeholder="Pin">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="custshipcountry" id="custshipcountry" placeholder="Country/Region">
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<!---
<?php
if ($permissionvencode != '0') {
?>
<?php
if ($permissionvencodeadd != '0') {
?>
<?php
}
}
?>
<?php
if ($cusgenhead != '0') {
?>
<?php
if ($cusgenadd != '0') {
?>
<?php
}
}
?>
<?php
if ($cusagehead != '0') {
?>
<?php
if ($cusageadd != '0') {
?>
<?php
}
}
?>
<?php
if ($cusmailhead != '0') {
?>
<?php
if ($cusmailadd != '0') {
?>
<?php
}
}
?>
<?php
if ($cusphonehead != '0') {
?>
<?php
if ($cusphoneadd != '0') {
?>
<?php
}
}
?>
<?php
if ($cuswebhead != '0') {
?>
<?php
if ($cuswebadd != '0') {
?>
<?php
}
}
?>
<?php
if ($cusbillhead != '0') {
?>
<?php
if ($cusbilladd != '0') {
?>
<?php
}
}
?>
<?php
if ($cusshiphead != '0') {
?>
<?php
if ($cusshipadd != '0') {
?>
<?php
}
}
?>-->
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($permissioncusvisinfo != '0') {
?>
<?php
if ($permissioncusvisadd != '0') {
?>
<div class="accordion" id="custaccordionRental">
<div class="accordion-item mb-1 pvi">
<h5 class="accordion-header" id="custheadingfour">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#custcollapsefour"
aria-expanded="true" aria-controls="custcollapsefour">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Customer Visibility</a>
</div>
</button>
</h5>
<div id="custcollapsefour" class="accordion-collapse collapse show"
aria-labelledby="headingfour">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="custom-label mt-2 text-danger custvis">Visibility * <svg data-toggle="tooltip" title="Visibility" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></label>
</div>
<div class="col-sm-8">
<div class="row">
<div class="col-lg-4 my-1">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="custvisibility" id="custvisibility" value="PUBLIC" checked>
<label class="custom-control-label custom-label" for="custvisibility">Public</label>
</div>
</div>
<div class="col-lg-4 my-1">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="custvisibility" id="custnovisibility" value="PRIVATE">
<label class="custom-control-label custom-label" for="custnovisibility">Private</label>
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
</div>
</div>
<?php
}
}
?>
<?php
if ($permissioncustaxinfo != '0') {
?>
<?php
if ($permissioncustaxadd != '0') {
?>
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="custheadingFive">
<button class="accordion-button font-weight-bold" type="button"
data-bs-toggle="collapse" data-bs-target="#custcollapseFive"
aria-expanded="true" aria-controls="custcollapseFive">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Tax
Information</a>
</div>
</button>
</h5>
<div id="custcollapseFive" class="accordion-collapse collapse show"
aria-labelledby="headingFive">
<div class="accordion-body text-sm">
<?php
if ($custaxprefer != '0') {
?>
<?php
if ($custaxpreferadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-sm-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label custtaxpre" for="custinlineRadio3">Tax Preference*</label>
</div>
<div class="col-sm-8">
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio"
name="custtaxpref" id="custtaxpref" value="0" checked
onclick="gettaxable()">
<label class="form-check-label"
for="custtaxpref">Taxable</label>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusgstrtype != '0') {
?>
<?php
if ($cusgstrtypeadd != '0') {
?>
<div id="custgstrtypesh">
<div class="row justify-content-center">
<div class="col-sm-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="custinlineRadio3">GST Registration Type</label>
</div>
<div class="col-sm-8">
<select class="selectpicker form-control select2" data-live-search="true" title="Search title or description..." onchange="showDiv(this)" id="custgstrtype" name="custgstrtype">
<option selected disabled value="" data-foo="Select Type of Add">Select Type of Add</option>
<option data-foo="Business that is registered under GST" value="Registered Business - Regular">Registered Business - Regular</option>
<option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition">Registered Business - Composition</option>
<option data-foo="Business that has not been registered under GST" value="Unregistered Business">Unregistered Business</option>
<option data-foo="A customer who is a regular consumer" value="Consumer">Consumer</option>
<option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas">Overseas</option>
<option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone">Special Economic Zone</option>
<option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export">Deemed Export</option>
<option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor">Tax Deductor</option>
<option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer">SEZ Developer</option>
</select>
</div>
</div>
</div>
</div>
<div id="custgstblock">
<?php
if ($cusgstin != '0') {
?>
<?php
if ($cusgstinadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-sm-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label text-danger" for="custgstin">GSTIN / UIN *</label>
</div>
<div class="col-sm-8">
<input type="text" name="custgstin" placeholder="GSTIN / UIN" id="custgstin" class="form-control form-control-sm">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusbusleg != '0') {
?>
<?php
if ($cusbuslegadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-sm-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="custbln">Business Legal Name</label>
</div>
<div class="col-sm-8">
<input type="text" name="custbln" placeholder="Business Legal Name" id="custbln" class="form-control  form-control-sm">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusbustrd != '0') {
?>
<?php
if ($cusbustrdadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-sm-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="custbtname">Business Trade Name</label>
</div>
<div class="col-sm-8">
<input type="text" name="custbtname" placeholder="Business Trade Name" id="custbtname" class="form-control  form-control-sm">
</div>
</div>
</div>
</div>
<?php
}
}
?>
</div>
<?php
}
}
?>
<?php
if ($cuspan != '0') {
?>
<?php
if ($cuspanadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-sm-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="custpan">PAN</label>
</div>
<div class="col-sm-8">
<input type="text" name="custpan" placeholder="PAN" id="custpan" class="form-control  form-control-sm">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cuspos != '0') {
?>
<?php
if ($cusposadd != '0') {
?>
<div id="custplaceofsupply">
<div class="row justify-content-center">
<div class="col-sm-8">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label text-danger" for="custpos">Place Of Supply *</label>
</div>
<div class="col-sm-8">
<select name="custpos" id="custpos" class="form-control  form-control-sm" >
<option value="JAMMU AND KASHMIR (1)">JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)">ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)">ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)">ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)">ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)">ASSAM (18)</option>
<option value="BIHAR (10)">BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)">CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)">CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)">CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)">DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)">DELHI (7)</option>
<option value="GOA (30)">GOA (30)</option>
<option value="GUJARAT (24)">GUJARAT (24)</option>
<option value="HARYANA (6)">HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)">HIMACHAL PRADESH (2)</option>
<option value="JAMMU AND KASHMIR (1)">JAMMU AND KASHMIR (1)</option>
<option value="JHARKHAND (20)">JHARKHAND (20)</option>
<option value="KARNATAKA (29)">KARNATAKA (29)</option>
<option value="KERALA (32)">KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)">LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)">LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)">MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)">MAHARASHTRA (27)</option>
<option value="MANIPUR (14)">MANIPUR (14)</option>
<option value="MEGHALAYA (17)">MEGHALAYA (17)</option>
<option value="MIZORAM (15)">MIZORAM (15)</option>
<option value="NAGALAND (13)">NAGALAND (13)</option>
<option value="ODISHA (21)">ODISHA (21)</option>
<option value="OTHER TERRITORY (97)">OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)">PUDUCHERRY (34)</option>
<option value="PUNJAB (3)">PUNJAB (3)</option>
<option value="RAJASTHAN (8)">RAJASTHAN (8)</option>
<option value="SIKKIM (11)">SIKKIM (11)</option>
<option value="TAMIL NADU (33)" selected>TAMIL NADU (33)</option>
<option value="TELANGANA (36)">TELANGANA (36)</option>
<option value="TRIPURA (16)">TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)">UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)">UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)">WEST BENGAL (19)</option>
</select>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<!--
<?php
if ($permissioncuspayinfo != '0') {
?>
<?php
if ($permissioncuspayadd != '0') {
?>
<?php
}
}
?>
<?php
if ($permissioncusbankinfo != '0') {
?>
<?php
if ($permissioncusbankadd != '0') {
?>
<?php
}
}
?>
<?php
if ($permissioncusothinfo != '0') {
?>
<?php
if ($permissioncusothadd != '0') {
?>
<?php
}
}
?>
<?php
if ($permissioncusattinfo != '0') {
?>
<?php
if ($permissioncusattadd != '0') {
?>
<?php
}
}
?>-->
<!-----------model ends----------------------------->
</div>
<div class="modal-footer " style="display: block;margin-bottom: -14.5px;">
<div class="col">
<button  class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="custsubmitcustomer" id="custsubmitcustomer" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funescustomer()">Cancel</button> </div>
</div>
</form>
</div>
</div>
</div>
<!-- </form> -->
<!-- End AddNewCustomer modal -->
<!-------------------customer add info end ------------------------------->
<form id="invoiceform" action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
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
<label for="invoicedate" class="custom-label"><span class="text-danger">Invoice Date *</span></label>
</div>
<div class="col-lg-8">
<input type="date" class="form-control  form-control-sm" id="invoicedate" name="invoicedate" readonly required value="<?=date('Y-m-d')?>">
</div>
</div>
</div>

<div class="col-lg-12">
<div class="form-group row">
<div class="col-lg-4">
<label for="duedates" class="custom-label">Due Date</label>
</div>
<div class="col-lg-3 duedateselect" style="margin-top: -3px !important;" onclick="andus()">
<select class="select2-field form-control  form-control-sm" name="duedates" id="duedates" onchange="funduedates()">
<?php
$sqli = mysqli_query($con, "select * from pairduedates where (createdid='$companymainid' or createdid='0') order by duedate asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?= $info['noofdays'] ?>"><?= $info['duedate'] ?></option>
<?php
}
?>
<option selected disabled>Due Terms</option>
</select>
</div>
<div class="col-lg-5 duedatepicker">
<input type="date" class="form-control  form-control-sm" id="duedate" name="duedate">
</div>
<script>
function addDays(date, days) {
var result = new Date(date);
days=parseFloat(days);
result.setDate(result.getDate() + days);
return result;
}
function funduedates()
{
var duedates=$("#duedates").val();
var invoicedate=$("#invoicedate").val();
var today="";
if(duedates!='')
{
console.log(invoicedate);
console.log(duedates);
today=addDays(invoicedate, duedates);
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
today = yyyy + '-' + mm + '-' + dd;
}
$("#duedate").val(today);
}
</script>
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
<div class="col-sm-3">
<label for="customername" class="custom-label"><span class="text-danger">Customer Name *</span></label>
</div>
<div class="col-sm-9" onclick="andus()">
<select class="form-control  form-control-sm" name="customer" id="customer">
<style type="text/css">
.tfunit{
display: none !important;
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
<option value="" data-foo="" data-receivable="">Select</option>
<?php
$sqli = mysqli_query($con, "SELECT id, customername, city, mobile, workphone From paircustomers WHERE franchisesession='".$_SESSION["franchisesession"]."' order by customername asc");
while ($info = mysqli_fetch_array($sqli)) 
{
	 $sqliinvoice=mysqli_query($con, "select invoiceamount, invoicedate, invoiceno from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='".$info['id']."' GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc");
	$invoiceamount=0;
	$balanceamount=0;
	$currentamount=0;
	$overdueamount=0;
	while($infoinvoice=mysqli_fetch_array($sqliinvoice))
	{
		$invoiceamount+=(float)$infoinvoice['invoiceamount'];
		$paidamount=0;
		$sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$infoinvoice['invoiceno']."' and invoicedate='".$infoinvoice['invoicedate']."' and customerid='".$info['id']."' order by id desc");
		while($infosalespay=mysqli_fetch_array($sqlsalespay))
		{
			$paidamount+=(float)$infosalespay['amount'];
		}
		$balanceamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
		$diff = abs(time() - strtotime($infoinvoice['invoicedate']));
		$days = floor(($diff)/ (60*60*24));
		if($days>30)
		{
			$overdueamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
		}
		else
		{
			$currentamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
		}
	}
?>
<option value="<?=$info['id']?>" data-foo="<?=$info['workphone']?>" data-receivable="<?php echo $rescurrency[0]; ?> <?=number_format((float)$balanceamount, 2, ".", "")?>"><?=$info['customername']?></option>
<?php
}
?>

</select>
<!----------->
<input type="text" class="form-control  form-control-sm" id="customername" name="customername" placeholder="Customer Name" style="display:none">
<!----------->
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-3">
</div>
<div class="col-lg-9">
<div class="row mb-1" id="custaddressdiv" style="background-color:#fbfafa; color:#777777; display:none">
<div class="col-lg-12 mb-2 mt-2">
<div id="ember529" class="info-item cursor-pointer ember-view">
<span class="text-blue">
<svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon align-text-bottom">
<path d="M394.8 422h-90c-11 0-20-9-20-20s9-20 20-20h90c11 0 20 9 20 20s-9 20-20 20zm97-145h-187c-11 0-20-9-20-20s9-20 20-20h187c11 0 20 9 20 20s-9 20-20 20zm0-145h-187c-11 0-20-9-20-20s9-20 20-20h187c11 0 20 9 20 20s-9 20-20 20zM227.2 422c-11 0-20-9-20-20v-37.3c0-22.2-22.3-40.3-49.8-40.3H89.8c-27.4 0-49.8 18.1-49.8 40.3V402c0 11-9 20-20 20s-20-9-20-20v-37.3c0-44.3 40.3-80.3 89.8-80.3h67.6c49.5 0 89.8 36 89.8 80.3V402c0 11-8.9 20-20 20zM123.6 244.8C80.8 244.8 46 210 46 167.2s34.8-77.6 77.6-77.6 77.6 34.8 77.6 77.6-34.8 77.6-77.6 77.6zm0-115.1c-20.7 0-37.6 16.9-37.6 37.6 0 20.7 16.8 37.6 37.6 37.6s37.6-16.9 37.6-37.6c0-20.8-16.8-37.6-37.6-37.6z"></path>
</svg>&nbsp; View Customer Details </span>
<!---->
<div id="ember530" class="ember-view">
<div id="ember531" class="ember-view"></div>
</div>
</div>
</div>
<div class="col-lg-6">
<div id="ember532" class="popovercontainer address-group ember-view">
<span class="text-uppercase font-small" style="color:#777777;"> Billing Address&nbsp;&nbsp;&nbsp;

<input type="hidden" name="pos" id="pos" >

<input type="hidden" name="address1" id="address1">
<input type="hidden" name="address2" id="address2">
<input type="hidden" name="area" id="area">
<input type="hidden" name="city" id="city">
<input type="hidden" name="state" id="state">
<input type="hidden" name="pincode" id="pincode">
<input type="hidden" name="district" id="district">
<span id="billingaddressspan" class="text-blue font-xxs cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#billingaddressmodel">Change</span>
<address id="billingaddressdiv" class="font-small ember-view" style="color:#777777;">
New Delhi <br> Delhi 110032 <br> India <br> Phone: 1-195-145-2657 x4235 <br>
</address>
</div>
</div>
<!-- Billing Modal -->
<div class="modal fade" id="billingaddressmodel" tabindex="-1" role="dialog" aria-labelledby="billingaddressmodelLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="billingaddressmodelLabel">Billing Address</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" style="height:120px">
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstreet" id="billstreet"  placeholder="Street">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcity" id="billcity" placeholder="City/Town">
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-4">
<div class="form-group">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstate" id="billstate" placeholder="State">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="billpincode" id="billpincode" min="0" placeholder="Pin">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcountry" id="billcountry" placeholder="Country/Region">
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button   onclick="funbillingaddress()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitbilling" value="Save"><span class="label">Save</span> <span class="spinner"></span></button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
<script>
function funbillingaddress()
{
var billstreet=document.getElementById("billstreet").value;
var billcity=document.getElementById("billcity").value;
var billstate=document.getElementById("billstate").value;
var billpincode=document.getElementById("billpincode").value;
var billcountry=document.getElementById("billcountry").value;
document.getElementById("area").value=billstreet;
document.getElementById("city").value=billcity;
document.getElementById("district").value=billcountry;
document.getElementById("state").value=billcity;
document.getElementById("pincode").value=billpincode;
var ase=billstreet+' '+billcity+' '+billstate+' '+billpincode+' '+billcountry+'';
ase=ase.trim();
if(ase=="")
{
$("#billingaddressdiv").html(ase);
$("#billingaddressspan").html("Add New Address");
}
else
{
$("#billingaddressdiv").html(ase);
$("#billingaddressspan").html("CHANGE");
}
document.getElementById("billingaddressmodel").classList.remove("show");
document.getElementById("billingaddressmodel").style.display="none";
document.getElementById("billingaddressmodel").removeAttribute("aria-modal");
document.getElementById("billingaddressmodel").removeAttribute("role");
document.getElementById("billingaddressmodel").setAttribute("aria-hidden", "true");
const backdrop = document.getElementsByClassName("modal-backdrop");
backdrop[0].classList.remove("show");
backdrop[0].classList.remove("modal-backdrop");
}
</script>
<div class="col-lg-6">
<div id="ember532" class="popovercontainer address-group ember-view">
<span class="text-uppercase font-small" style="color:#777777;"> Shipping Address&nbsp;&nbsp;&nbsp;
<input type="hidden" name="saddress1" id="saddress1">
<input type="hidden" name="saddress2" id="saddress2">
<input type="hidden" name="sarea" id="sarea">
<input type="hidden" name="scity" id="scity">
<input type="hidden" name="sstate" id="sstate">
<input type="hidden" name="spincode" id="spincode">
<input type="hidden" name="sdistrict" id="sdistrict">
<span id="shippingaddressspan" class="text-blue font-xxs cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#shippingaddressmodel">Change</span>
<address id="shippingaddressdiv" class="font-small ember-view" style="color:#777777;">
New Delhi <br> Delhi 110032 <br> India <br> Phone: 1-195-145-2657 x4235 <br>
</address>
</div>
</div>
<!-- Shipping Modal -->
<div class="modal fade" id="shippingaddressmodel" tabindex="-1" role="dialog" aria-labelledby="shippingaddressmodelLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="shippingaddressmodelLabel">Shipping Address</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" style="height:120px">
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstreet" id="shipstreet"  placeholder="Street">
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcity" id="shipcity" placeholder="City/Town">
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-4">
<div class="form-group">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstate" id="shipstate" placeholder="State">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="shippincode" id="shippincode" min="0" placeholder="Pin">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcountry" id="shipcountry" placeholder="Country/Region">
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button   onclick="funshippingaddress()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitshipping" value="Save"><span class="label">Save</span> <span class="spinner"></span></button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
<script>
function funshippingaddress()
{
var shipstreet=document.getElementById("shipstreet").value;
var shipcity=document.getElementById("shipcity").value;
var shipstate=document.getElementById("shipstate").value;
var shippincode=document.getElementById("shippincode").value;
var shipcountry=document.getElementById("shipcountry").value;
document.getElementById("sarea").value=shipstreet;
document.getElementById("scity").value=shipcity;
document.getElementById("sdistrict").value=shipcountry;
document.getElementById("sstate").value=shipcity;
document.getElementById("spincode").value=shippincode;
var ase=shipstreet+' '+shipcity+' '+shipstate+' '+shippincode+' '+shipcountry+'';
ase=ase.trim();
if(ase=="")
{
$("#shippingaddressdiv").html(ase);
$("#shippingaddressspan").html("Add New Address");
}
else
{
$("#shippingaddressdiv").html(ase);
$("#shippingaddressspan").html("CHANGE");
}
document.getElementById("shippingaddressmodel").classList.remove("show");
document.getElementById("shippingaddressmodel").style.display="none";
document.getElementById("shippingaddressmodel").removeAttribute("aria-modal");
document.getElementById("shippingaddressmodel").removeAttribute("role");
document.getElementById("shippingaddressmodel").setAttribute("aria-hidden", "true");
const backdrop = document.getElementsByClassName("modal-backdrop");
backdrop[0].classList.remove("show");
backdrop[0].classList.remove("modal-backdrop");
}
</script>
<div class="col-md-6">
<input type="hidden" name="mobile" id="mobile" >
<input type="hidden" name="workphone" id="workphone" >
<span class="text-uppercase font-small" style="color:#777777;">PHONE&nbsp;&nbsp;&nbsp;</span>
<span id="worktypespan" class="text-blue font-xxs cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#workphonemodel">Change</span>
<div id="workphonediv" style="color:#777777;"></div>
</div>
<!-- GSTping Modal -->
<div class="modal fade" id="workphonemodel" tabindex="-1" role="dialog" aria-labelledby="workphonemodelLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="workphonemodelLabel">PHONE</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" style="height:110px">

<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-4">
<label for="workphone" class="custom-label workphone" data-toggle="tooltip" title="Work Phone" data-placement="top">Work Phone</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="workworkphone" name="workworkphone" placeholder="Work Phone">
</div>
</div>
</div>
</div>

<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-4">
<label for="mobile" class="custom-label mobile" data-toggle="tooltip" title="Mobile Phone" data-placement="top">Mobile Phone</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="workmobile" name="workmobile" placeholder="Mobile Phone">
</div>
</div>
</div>
</div>

</div>
<div class="modal-footer">
<button   onclick="funworkphone()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitwork" value="Save"><span class="label">Save</span> <span class="spinner"></span></button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
<script>
function funworkphone()
{
var workworkphone=document.getElementById("workworkphone").value;
var workmobile=document.getElementById("workmobile").value;
document.getElementById("workphone").value=workworkphone;
document.getElementById("mobile").value=workmobile;
var ase=workworkphone+' '+workmobile+'';
ase=ase.trim();
if(ase=="")
{
$("#workphonediv").html(ase);
$("#workphonespan").html("ADD PHONE");
}
else
{
$("#workphonediv").html(ase);
$("#workphonespan").html("CHANGE");
}
document.getElementById("workphonemodel").classList.remove("show");
document.getElementById("workphonemodel").style.display="none";
document.getElementById("workphonemodel").removeAttribute("aria-modal");
document.getElementById("workphonemodel").removeAttribute("role");
document.getElementById("workphonemodel").setAttribute("aria-hidden", "true");
const backdrop = document.getElementsByClassName("modal-backdrop");
backdrop[0].classList.remove("show");
backdrop[0].classList.remove("modal-backdrop");
}
</script>



<div class="col-md-6">
<input type="hidden" name="gstno" id="gstno" >
<input type="hidden" name="gstrtype" id="gstrtype" >

<span class="text-uppercase font-small" style="color:#777777;">GST Treatment&nbsp;&nbsp;&nbsp;</span>
<span id="gsttypespan" class="text-blue font-xxs cursor-pointer" href="#" data-bs-toggle="modal" data-bs-target="#gstrtypemodel">Change</span>
<div id="gstrtypediv" style="color:#777777;">Registered Business - Regular</div>
</div>
<!-- GSTping Modal -->
<div class="modal fade" id="gstrtypemodel" tabindex="-1" role="dialog" aria-labelledby="gstrtypemodelLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="gstrtypemodelLabel">GST TREATMENT</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" style="height:180px">

<div class="row justify-content-center">
<div class="col-sm-12">
<div class="form-group row">
<div class="col-sm-12 mb-2">
<label class="form-check-label" for="gstinlineRadio3">GST Registration Type</label>
</div>
<div class="col-sm-12">
<select class="selectpicker form-control select2" data-live-search="true" title="Search title or description..." onchange="showDiv(this)" id="gstgstrtype" name="gstgstrtype">
<option selected disabled value="" data-foo="Select Type of Add">Select Type of Add</option>
<option data-foo="Business that is registered under GST" value="Registered Business - Regular">Registered Business - Regular</option>
<option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition">Registered Business - Composition</option>
<option data-foo="Business that has not been registered under GST" value="Unregistered Business">Unregistered Business</option>
<option data-foo="A gstomer who is a regular consumer" value="Consumer">Consumer</option>
<option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas">Overseas</option>
<option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone">Special Economic Zone</option>
<option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export">Deemed Export</option>
<option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor">Tax Deductor</option>
<option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer">SEZ Developer</option>
</select>
</div>
</div>
</div>
</div>

<div class="row justify-content-center">
<div class="col-sm-12">
<div class="form-group row">
<div class="col-sm-12 mb-2">
<label class="form-check-label text-danger" for="gstgstin">GSTIN / UIN *</label>
</div>
<div class="col-sm-12">
<input type="text" name="gstgstin" placeholder="GSTIN / UIN" id="gstgstin" class="form-control form-control-sm">
</div>
</div>
</div>
</div>

</div>
<div class="modal-footer">
<button   onclick="fungstrtype()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="button"  name="submitgst" value="Save"><span class="label">Save</span> <span class="spinner"></span></button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>
<script>
function fungstrtype()
{
var gstgstrtype=document.getElementById("gstgstrtype").value;
var gstgstin=document.getElementById("gstgstin").value;
document.getElementById("gstrtype").value=gstgstrtype;
document.getElementById("gstno").value=gstgstin;
var ase=gstgstrtype+' '+gstgstin+'';
ase=ase.trim();
if(ase=="")
{
$("#gstrtypediv").html(ase);
$("#gstrtypespan").html("Add GSTIN");
}
else
{
$("#gstrtypediv").html(ase);
$("#gstrtypespan").html("CHANGE");
}
document.getElementById("gstrtypemodel").classList.remove("show");
document.getElementById("gstrtypemodel").style.display="none";
document.getElementById("gstrtypemodel").removeAttribute("aria-modal");
document.getElementById("gstrtypemodel").removeAttribute("role");
document.getElementById("gstrtypemodel").setAttribute("aria-hidden", "true");
const backdrop = document.getElementsByClassName("modal-backdrop");
backdrop[0].classList.remove("show");
backdrop[0].classList.remove("modal-backdrop");
}
</script>

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
<div class="accordion-body text-sm" style="padding-bottom: 0px !important;padding-top: 3px">
<div class="table-responsive">
<table class="table table-bordered" id="purchasetable">
<thead>
<tr><th style="display:none"></th><th></th><th>ITEM DETAILS<span class="text-danger"> *</span></th><th>BATCH</th><th style="display:none">DESCRIPTION</th><th style="display:none">HSN</th><th style="display:none">MRP</th><th>RATE<span class="text-danger"> *</span></th><th>QUANTITY<span class="text-danger"> *</span></th><th>TAXABLE VALUE</th><th>TAX VALUE</th><th style="display:none">Discount</th><th>AMOUNT</th><th></th></tr>
</thead>
<tbody>
<tr>
<td class="priority" style="display:none"> 1</td>
<td class="tdmove"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td><input type="hidden" name="productid[]" id="productid1"><input type="text" name="productname[]" id="productname1" required class="form-control form-control-sm bordernoneinput" ><span class="badge" style="display:none; width:75px; padding:3px; margin:5px 0; background-color: #57b729; font-size:75%" id="itemmodule1"></span>
<span id="productmanufacturerspan1" style="display:none; font-size:11px;">Manufacturer:</span> <span id="productmanufacturerval1" style=" font-size:11px;" class="text-primary"></span>
<span id="productmanufactureredit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer(1)"><i class="fa fa-edit"></i></span>
<span id="productmanufacturerupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer(1)"><i class="fa fa-save"></i></span>
<input type="text" name="manufacturer[]" id="manufacturer1" class="form-control form-control-sm" style="display:none;">
<br>
<span id="producthsncodespan1" style="display:none; font-size:11px;">HSN Code:</span> <span id="producthsncodeval1" style=" font-size:11px;" class="text-primary"></span>
<span id="producthsncodeedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode(1)"><i class="fa fa-edit"></i></span>
<span id="producthsncodeupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode(1)"><i class="fa fa-save"></i></span>
<input type="text" name="producthsn[]" id="producthsn1" class="form-control form-control-sm" style="display:none;">
<span id="productdescriptionspan1" style="display:none; font-size:11px;">Description:</span><textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription1" style="height:50px; display:none; border:none;"></textarea></td>
<td style="display:none"><input type="text" name="productnotes[]" id="productnotes1" class="form-control form-control-sm bordernoneinput"></td>
<td><input type="text" name="batch[]" id="batch1" class="form-control form-control-sm bordernoneinput">
<span id="productexpdatespan1" style="display:none; font-size:11px;">EXPIRY:</span> <span id="productexpdateval1" style=" font-size:11px;" class="text-primary"></span>
<span id="productexpdateedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate(1)"><i class="fa fa-edit"></i></span>
<span id="productexpdateupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate(1)"><i class="fa fa-save"></i></span>
<input type="date" name="expdate[]" id="expdate1" class="form-control form-control-sm" style="display:none;">
</td>
<td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:#cccccc"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="productrate[]"   required id="productrate1" class="form-control form-control-sm bordernoneinput" onChange="productcalc(1)"></div>
<span id="productmrpspan1" style="display:none; font-size:11px;">MRP:</span> <span id="productmrpval1" style=" font-size:11px;" class="text-primary"></span>
<span id="productmrpedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp(1)"><i class="fa fa-edit"></i></span>
<span id="productmrpupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp(1)"><i class="fa fa-save"></i></span>
<input type="number" name="mrp[]" id="mrp1" class="form-control form-control-sm" style="display:none;" min="0" step="0.01">
</td>
<td><input type="number" min="0" step="0.01" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput" onChange="productcalc(1)">
<span id="productnoofpacksspan1" style="display:none; font-size:11px;">PACK:</span> <span id="productnoofpacksval1" style=" font-size:11px;" class="text-primary"></span>
<span id="productnoofpacksedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks(1)"><i class="fa fa-edit"></i></span>
<span id="productnoofpacksupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks(1)"><i class="fa fa-save"></i></span>
<input type="text" name="noofpacks[]" id="noofpacks1" class="form-control form-control-sm" style="display:none;">
</td>
<td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:#cccccc"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue1" class="form-control form-control-sm bordernoneinput"style="background:none;" readonly ></div>
<span id="productprodiscountspan1" style="display:none; font-size:11px;">DISCOUNT:</span> <span id="productprodiscountval1" style=" font-size:11px;" class="text-primary"></span>
<span id="productprodiscountedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount(1)"><i class="fa fa-edit"></i></span>
<span id="productprodiscountupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount(1)"><i class="fa fa-save"></i></span>
<input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount1" class="form-control form-control-sm" style="display:none;" onChange="productcalc(1)">
</td>
<td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:#cccccc"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue1" class="form-control form-control-sm bordernoneinput"style="background:none;" readonly ></div>
<span id="productvatspan1" style="display:none; font-size:11px;">VAT:</span> <span id="productvatval1" style=" font-size:11px;" class="text-primary"></span>
<span id="productvatedit1" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editvat(1)"><i class="fa fa-edit"></i></span>
<span id="productvatupdate1" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat(1)"><i class="fa fa-save"></i></span>
<input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm" style="display:none;" onChange="productcalc(1)">
<span id="productcgstvatspan1" style="display:none; font-size:11px;">CGST:</span> 
<span id="productcgstvatval1" style=" font-size:11px;" class="text-primary"></span>
<span id="productsgstvatspan1" style="display:none; font-size:11px;">SGST:</span> 
<span id="productsgstvatval1" style=" font-size:11px;" class="text-primary"></span>
<span id="productigstvatspan1" style="display:none; font-size:11px;">IGST:</span> 
<span id="productigstvatval1" style=" font-size:11px;" class="text-primary"></span>
</td>
<td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:#cccccc"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue1" class="form-control form-control-sm bordernoneinput"style="background:none;" readonly ></div></td>
<td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
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


<div class="row">
<div class="form-group row">
<div class="col-lg-6">
<p align="left" style="margin:0px;padding:0px;">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;padding: 3.5px 4.5px 3.5px 4.5px !important; margin-bottom:0.25rem;"><i style="font-size: 14px;color:#0066cc;" class="fa fa-plus-circle"></i> Add another line</a>
<a class="btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;padding: 3.5px 4.5px 3.5px 4.5px !important; margin-bottom:0.25rem;" id="productadd" data-bs-toggle="modal" data-bs-target="#AddNewProduct"><i style="font-size: 14px;color:#0066cc;" class="fa fa-plus"></i> Missing Products? Add Here</a></p>
</div>
<div class="col-lg-2">
<label class="custom-label" for="totalitems">Total Items</label>
</div>
<div class="col-lg-4">
<input required type="text" name="totalitems" id="totalitems" class="form-control form-control-sm " style="width:50px;" readonly  value="0" >
</div>
</div>
</div>

<div class="row">

<div class="col-lg-8">
<style>
#gsttable td,th
{
padding:1px;
text-align: center;
}
#gsttable .form-control-sm
{
	width:100%; background:none; font-size:12px; padding:1px 2px; height:auto; border:none; text-align:right;
}
</style>
<div class="table-responsive mt-1" id="gsttablediv">
<table class="table table-bordered" id="gsttable" style="font-size:12px;">
<tr>
<th style="width:19%">Taxable<br> Amount</th><th style="width:8%">SGST %</th><th style="width:19%">Amount</th><th style="width:8%">CGST %</th>
<th style="width:19%">Amount</th>
<th  style="width:8%">GST</th>
<th style="width:19%">Total Tax<br> Amount</th>
</tr>
<tr>
<td class="text-center" style="text-align:center"><input type="text" name="tax25" id="tax25" class="form-control form-control-sm bordernoneinput"  readonly></td><td class="text-center" style="text-align:center">2.5%</td><td class="text-center" style="text-align:center"><input type="text" name="cgst25" id="cgst25" class="form-control form-control-sm"  readonly></td>
<td class="text-center" style="text-align:center">2.5%</td>
<td class="text-center" style="text-align:center"><input type="text" name="sgst25" id="sgst25" class="form-control form-control-sm"  readonly></td>
<td style="">5%</td> <td style=" "><input type="text" name="gst25" id="gst25"   class="form-control form-control-sm"  readonly></td>
</tr>
<tr>
<td class="text-center" style="text-align:center"><input type="text" name="tax6" id="tax6"  class="form-control form-control-sm"  readonly ></td><td class="text-center" style="text-align:center">6%</td><td class="text-center" style="text-align:center"><input type="text" name="cgst6" id="cgst6"  class="form-control form-control-sm"  readonly ></td>
<td class="text-center" style="text-align:center">6%</td>
<td class="text-center" style="text-align:center"><input type="text" name="sgst6" id="sgst6"  class="form-control form-control-sm"  readonly ></td>
<td style="">12%</td> <td style=""><input type="text" name="gst6" id="gst6"  class="form-control form-control-sm"  readonly ></td>
</tr>
<tr>
<td class="text-center" style="text-align:center"><input type="text" name="tax9" id="tax9"  class="form-control form-control-sm"  readonly ></td><td class="text-center" style="text-align:center">9%</td><td class="text-center" style="text-align:center"><input type="text" name="cgst9" id="cgst9"  class="form-control form-control-sm"  readonly ></td>
<td class="text-center" style="text-align:center">9%</td>
<td class="text-center" style="text-align:center"><input type="text" name="sgst9" id="sgst9"  class="form-control form-control-sm"  readonly ></td>
<td style="">18%</td> <td style="  "><input type="text" name="gst9" id="gst9"   class="form-control form-control-sm"  readonly ></td>
</tr>
<tr>
<td class="text-center" style="text-align:center"><input type="text" name="tax14" id="tax14"  class="form-control form-control-sm"  readonly ></td><td class="text-center" style="text-align:center">14%</td> <td class="text-center" style="text-align:center"><input type="text" name="cgst14" id="cgst14"  class="form-control form-control-sm"  readonly ></td>
<td class="text-center" style="text-align:center">14%</td>
<td class="text-center" style="text-align:center"><input type="text" name="sgst14" id="sgst14"  class="form-control form-control-sm"  readonly ></td>
<td style="">28%</td> <td style="  "><input type="text" name="gst14" id="gst14"   class="form-control form-control-sm"  readonly ></td>
</tr>
<tr>
<td colspan="6" style="text-align:right; ">Total GST Amount <?php echo $rescurrency[0]; ?></td> <td style=""><input type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm"  readonly ></td>
</tr>
</table>
</div>
</div>
<div class="col-lg-4">
<div class="row">
<div class="col-lg-12">
<label class="custom-label" for="description">Description</label>
<textarea class="form-control form-control-sm" name="description" id="description" style="height: 60px !important;"></textarea>
</div>
<div class="col-lg-12">
<label class="custom-label" for="notes">Notes</label>
<textarea class="form-control form-control-sm" name="notes" id="notes" style="height: 60px !important;"></textarea>
</div>
</div>
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

</div>
</div>
</div>
<div class="col-lg-4" style="background-color:#fbfafa; font-size: 0.85rem">
<div class="p-1">
<div class="row mb-1">
<div class="col-6">Sub Total <span class="pull-right">:</span> <?php echo $rescurrency[0]; ?></div>
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
<span style="float:left">Discount &nbsp; &nbsp; </span>
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
<input required type="text" name="discountamount" id="discountamount" class="form-control form-control-sm" style="background:none; text-align:right" value="0" onChange="productcalc1()" >
</div>
</div>
<div class="row mb-1" style="display:none" >
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
<div class="row mb-1">
<div class="col-12">
<span id="grandwords">adfsadf</span>
</div>
</div>

<div class="row mb-1" style="font-size:18px; display:none" >
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
<div class="row mb-1" style="font-size:18px; display:none" >
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


<div class="row mt-2 mb-2"  style="background-color:#fbfafa;">
<div class="col-lg-8">

<div class="row">
<div class="form-group row">
<div class="col-lg-2">
<label class="custom-label" for="terms">Terms and Conditions</label>
</div>
<div class="col-lg-10">
<textarea class="form-control form-control-sm" name="terms" id="terms" style="height: 80px !important;"></textarea>
</div>
</div>
</div>

</div>
<div class="col-lg-4">
<label class="custom-label mb-2" for="fileattach">Attach File(s) to Invoice</label>
<div class="form-group">
<input type="file" name="fileattach[]" id="fileattach" class="form-control form-control-sm" multiple>
</div>
<span style="font-size:11px;">You can upload a maximum of 5 files, 5MB each</span>
</div>

</div>
</div>



<!---payment confirm---->
<div class="modal fade" id="triggerconfirm-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
	        <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body" style="height: 280px;">
                <table class="table">
				<tr>
				<th>Invoice No</th><td><input type="text" name="validinvoiceno" id="validinvoiceno" class
				="form-control form-control-sm" readonly required></td>
				</tr>
				<tr>
				<th>Invoice Date</th><td><input type="date" name="validinvoicedate" id="validinvoicedate" class
				="form-control form-control-sm" readonly required></td>
				</tr>
				<tr>
				<th>Total Amount</th><td><input type="text" name="validinvoiceamount" id="validinvoiceamount" class
				="form-control form-control-sm" readonly required></td>
				</tr>
				<tr>
				<th>Paid Amount</th><td><input type="number" name="validpaidamount" id="validpaidamount" class
				="form-control form-control-sm" value="0" required onchange="paidamountcalc()">
				
				<script>
				function paidamountcalc()
				{
					var validinvoiceamount=$("#validinvoiceamount").val();
					var validpaidamount=$("#validpaidamount").val();
					if((validinvoiceamount!='')&&(validpaidamount!=''))
					{
						var balance=parseFloat(validinvoiceamount)-parseFloat(validpaidamount);
						$("#validbalance").val(balance);
					}
				}
				</script>
				</td>
				</tr>
				<tr>
				<th>Payment Term</th><td> 
				<div class="col-lg-12">
<select class="select2-field form-control  form-control-sm" name="invoiceterm" id="invoiceterm" required>
<option value="">Select</option>
<?php
$sqli = mysqli_query($con, "select term from pairterms where (createdid='$companymainid' or createdid='0') order by term asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?= $info['term'] ?>" <?=($info['term']=="CASH")?'selected':''?>><?= $info['term'] ?></option>
<?php
}
?>
</select></td>
				</tr>
				<tr>
				<th>Balance Due</th><td><input type="number" name="validbalance" id="validbalance" class
				="form-control form-control-sm" value="0" required readonly></td>
				</tr>
				</table>
				<label><input type="checkbox" name="ihavereceived" id="ihavereceived" value="1"> I have Received this Payment</label>
				
            </div>

		<div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn btn-primary btn-sm btn-custom-grey" data-bs-dismiss="modal" aria-label="Close">CANCEL</button>
            <button type="submit" id="Submit" name="submit" class="btn btn-primary btn-sm btn-custom " >SAVE</button>
			<button type="submit" id="Submit" name="submit1" class="btn btn-primary btn-sm btn-custom " >SAVE AND PRINT</button>
        </div>
	</div>
</div>
</div>
<!---payment confirm---->
<!---navbottom---->
     <header class="app-header fixed-bottom" style="height:48px !important;z-index: 1 !important;">
        <div class="app-header-inner">  
            <div class="py-2 px-3">
                <div class="app-header-content" style="margin-left: -45px;" id="ilu"> 
                    <div class="row">
                        <div class="col-auto pt-1" style="width:34px !important;margin-top: -8px !important;height: 100px;margin-left: -18px !important;border-top: 1px solid #eff0f4;">
                    </div>
                    <div class="col" style="width:34px !important;margin-top: 1px !important;margin-left: -9px !important;">
                        <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="button" id="trigggerbutton" name="triggerbutton" value="Submit"  onClick="triggerpayment('','','','1')">
                                                            <span class="label">NEXT</span> <span class="spinner"></span>
                                                        </button> 
                                                        
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="invoices.php" style="margin-top:-3px !important;">Cancel</a>
                                                      
                    </div>
                   </div>
               </div>
            </div>
        </div>
    </header>
<!---navbottom---->
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
<!-------------------customer add info start ------------------------------->
<!-- subtext -->
<script type="text/javascript">
$(function(){
$(".select2").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
return $(
'<div><div>' + state.text + '</div><div class="foo">'
+ $(state.element).attr('data-foo')
+ '</div></div>'
);
}
</script>
<script type="text/javascript">
$(function(){
$("#customer").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
	if($(state.element).attr('data-receivable')=="")
	{
		return $(
'<div><div>' + state.text + '</div></div>'
);
	}
	else
	{
	if($(state.element).attr('data-receivable')=="0")
	{
		return $(
'<div><div>' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr><td>WORK PHONE: '+ $(state.element).attr('data-foo') + '</td><td align="right">AMOUNT RECEIVABLE: <span style="color:green">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
	}
	else
	{
		return $(
'<div><div>' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr><td>WORK PHONE: '+ $(state.element).attr('data-foo') + '</td><td align="right">AMOUNT RECEIVABLE: <span style="color:red">'+ $(state.element).attr('data-receivable') + '</span></td></tr></table></div></div>'
);
	}
	}
}
</script>
<!-------------------customer add info end ------------------------------->
<?php
include('fexternals.php');
?>
<!-------------------customer add info start ------------------------------->
<!--salutation-->
<script type="text/javascript">
$("#custsalute").click(function(){
document.getElementById('custcustdrpsalute').classList.toggle("custdropdownsalute");
});
</script>
<!-- cat -->
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
<!-- subcat -->
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
<!-- same as bill -->
<script type="text/javascript">
function sameasbillingticaccess() {
let showorhide = document.getElementById('custsameasbilling');
if (showorhide.checked==true) {
document.getElementById('custtotalshipadd').style.display = 'none';
}
else{
document.getElementById('custtotalshipadd').style.display = 'block';
}
}
$(document).ready(function() {
let showorhide = document.getElementById('custsameasbilling');
if (showorhide.checked==true) {
document.getElementById('custtotalshipadd').style.display = 'none';
}
else{
document.getElementById('custtotalshipadd').style.display = 'block';
}
});
</script>
<!-- gstrtype -->
<script type="text/javascript">
$(document).ready(function() {
let noaccess = document.getElementById('custtaxprefnontaxable');
let access = document.getElementById('custtaxpreftaxable');
if (noaccess.checked == true) {
document.getElementById('custgstrtypesh').style.display='none';
}
if (access.checked == true) {
document.getElementById('custgstrtypesh').style.display='block';
}
});
function gettaxable(){
let noaccess = document.getElementById('custtaxprefnontaxable');
let access = document.getElementById('custtaxpreftaxable');
if (noaccess.checked == true) {
document.getElementById('custgstrtypesh').style.display='none';
}
else{
document.getElementById('custgstrtypesh').style.display='block';
}
}
</script>
<script type="text/javascript">
function showDiv(element)
{
if (element.value == '') {
document.getElementById('custgstblock').style.display = 'none';
document.getElementById('custplaceofsupply').style.display = 'block';
}
else if (element.value == 'Registered Business - Regular') {
document.getElementById('custgstblock').style.display = 'block';
document.getElementById('custplaceofsupply').style.display = 'block';
}
else if (element.value == 'Registered Business - Composition') {
document.getElementById('custgstblock').style.display = 'block';
document.getElementById('custplaceofsupply').style.display = 'block';
}
else if (element.value == 'Unregistered Business') {
document.getElementById('custgstblock').style.display = 'none';
}
else if (element.value == 'Consumer') {
document.getElementById('custgstblock').style.display = 'none';
}
else if (element.value == 'Overseas') {
document.getElementById('custplaceofsupply').style.display = 'none';
document.getElementById('custgstblock').style.display = 'none';
}
else if (element.value == 'Special Economic Zone') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
}
else if (element.value == 'Deemed Export') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
}
else if (element.value == 'Tax Deductor') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
}
else if (element.value == 'SEZ Developer') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
}
}
</script>
<!-- cat -->
<script>
$("#custcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#custAddNewCategory') {
$('#custAddNewCategory').modal('show');
}
});
$("#custsubcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#custAddNewSubCategory') {
$('#custAddNewSubCategory').modal('show');
}
});
</script>
<script>
function funaddcategory() {
var missingcategory = document.getElementById('custmissingcategory');
if (missingcategory.value == '') {
alert('Please Enter New Category Name');
missingcategory.focus();
return false;
} else {
$('#custcategory').append('<option value="' + missingcategory.value + '">' + missingcategory.value +
'</option>');
$('#custcategory').val(missingcategory.value).change();
$('#custAddNewCategory').modal('hide');
return false;
}
}
function funescategory() {
$('#custcategory').val('').change();
$('#custAddNewCategory').modal('hide');
return false;
}
</script>
<!-- subcat -->
<script>
function funaddsubcategory() {
var missingsubcategory = document.getElementById('custmissingsubcategory');
if (missingsubcategory.value == '') {
alert('Please Enter New Sub Category Name');
missingsubcategory.focus();
return false;
} else {
$('#custsubcategory').append('<option value="' + missingsubcategory.value + '">' + missingsubcategory.value +
'</option>');
$('#custsubcategory').val(missingsubcategory.value).change();
$('#custAddNewSubCategory').modal('hide');
return false;
}
}
function funessubcategory() {
$('#custsubcategory').val('').change();
$('#custAddNewSubCategory').modal('hide');
return false;
}
</script>
<!-- unit cat subcat select modal design -->
<script>
$("#customer").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewCustomer");
$("#configureunits").show();
});
$("#customer").on("select2:open", function() {
$("#configureunits").show();
document.getElementById("configureunits").innerHTML = "New Customer";
});
$("#custgstrtype").on("select2:open", function() {
$("#configureunits").hide();
});
$("#custsubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewSubCategory");
});
$("#custsubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#custcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewCategory");
});
$("#custcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Category";
});
</script>
<script>
function funaddcustomer() {
var custcustomerdname = document.getElementById('custcustomerdname');
if (custcustomerdname.value == '') {
alert('Please Enter New Customer Name');
custcustomerdname.focus();
return false;
} else {
$('#custcustomer').append('<option value="' + custcustomerdname.value + '">' + custcustomerdname.value +
'</option>');
$('#custcustomer').val(custcustomerdname.value).change();
$('#custAddNewCustomer').modal('hide');
return false;
}
}
function funescustomer() {
$('#custcustomer').val('').change();
$('#custAddNewCustomer').modal('hide');
return false;
}
</script>
<script>
$(document).ready(function(){
$("#custsubmitcustomer").click(function(e){
e.preventDefault();
var custcustomerdname=$("#custcustomerdname").val();
if(custcustomerdname=="")
{
alert("Please Enter the Customer Name");
return false;
}
else
{
$.ajax({type: "POST",
url: "customeradds.php",
data: {
customercode: $("#custcustomercode").val(),
landline: $("#custlandline").val(),
cstno: $("#custcstno").val(),
customerid: $("#custcustomerid").val(),
salute: $("#custsalute").val(),
pcontact: $("#custpcontact").val(),
companyname: $("#custcompanyname").val(),
customerdname: $("#custcustomerdname").val(),
category: $("#custcategory").val(),
subcategory: $("#custsubcategory").val(),
workphone: $("#custworkphone").val(),
mobilephone: $("#custmobilephone").val(),
email: $("#custemail").val(),
website: $("#custwebsite").val(),
billstreet: $("#custbillstreet").val(),
billcity: $("#custbillcity").val(),
billstate: $("#custbillstate").val(),
billpincode: $("#custbillpincode").val(),
billcountry: $("#custbillcountry").val(),
sameasbilling: $("#custsameasbilling").val(),
shipstreet: $("#custshipstreet").val(),
shipcity: $("#custshipcity").val(),
shipstate: $("#custshipstate").val(),
shippincode: $("#custshippincode").val(),
shipcountry: $("#custshipcountry").val(),
visibility: $("#custvisibility").val(),
taxpref: $("#custtaxpref").val(),
gstrtype: $("#custgstrtype").val(),
gstin: $("#custgstin").val(),
bln: $("#custbln").val(),
btname: $("#custbtname").val(),
pan: $("#custpan").val(),
pos: $("#custpos").val(),
submit: "Submit"
},
success:function(result){
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
var custcustomerdname=$("#custcustomerdname").val();
var billcity=$("#custbillcity").val();
var mobilephone=$("#custmobilephone").val();
$('#customer').append('<option value="' + resarray[1] + '">' + custcustomerdname + ' - ' + billcity+ ' - ' + mobilephone + '</option>');
$('select[name^="customer"] option[value="' + resarray[1] + '"]').attr("selected","selected");
$('#customer').val(resarray[1]).change();
$('#custAddNewCustomer').modal('hide');
}
}});
}
/* $.ajax({type: "POST",
url: "/imball-reagens/public/shareitem",
data: { id: $("#Shareitem").val(), access_token: $("#access_token").val() },
success:function(result){
$("#sharelink").html(result);
}}); */
});
});
</script>
<!-------------------customer add info end ------------------------------->
<script>
let lineNo = 2;
$(document).ready(function () {
$(".purchaseadd-row").click(function () {
addnewrow(lineNo);
lineNo++;
});
});
</script><script>
function proautocomp(lineNo)
{
$("#productname"+lineNo).autocomplete({
source: 'prosearch.php',
select: function(event, ui) {
$("#productid"+lineNo).val(ui.item.id);
$("#productname"+lineNo).val(ui.item.productname);
$("#productnotes"+lineNo).val(ui.item.description);
$("#productdescription"+lineNo).val(ui.item.description);
$("#productdescription"+lineNo).css('display', 'block');
$("#productdescriptionspan"+lineNo).css('display', 'block');
$("#itemmodule"+lineNo).html(ui.item.itemmodule);
$("#itemmodule"+lineNo).css('display', 'block');
$("#producthsn"+lineNo).val(ui.item.hsncode);
$("#mrp"+lineNo).val(ui.item.salemrp);
$("#vat"+lineNo).val(ui.item.tax);
$("#productrate"+lineNo).val(ui.item.salecost);
$("#prodiscount"+lineNo).val(ui.item.salediscount);
$("#productmanufacturerval"+lineNo).html(ui.item.manufacturer);
$("#productmanufacturerval"+lineNo).css('display', 'inline');
$("#manufacturer"+lineNo).val(ui.item.manufacturer);
$("#manufacturer"+lineNo).css('display', 'none');
$("#productmanufacturerspan"+lineNo).css('display', 'inline');
$("#productmanufactureredit"+lineNo).css('display', 'inline');
$("#productmanufacturerupdate"+lineNo).css('display', 'none');
$("#producthsncodeval"+lineNo).html(ui.item.hsncode);
$("#producthsncodeval"+lineNo).css('display', 'inline');
$("#producthsn"+lineNo).val(ui.item.hsncode);
$("#producthsn"+lineNo).css('display', 'none');
$("#producthsncodespan"+lineNo).css('display', 'inline');
$("#producthsncodeedit"+lineNo).css('display', 'inline');
$("#producthsncodeupdate"+lineNo).css('display', 'none');
//$("#productexpdateval"+lineNo).html(ui.item.expdate);
$("#productexpdateval"+lineNo).css('display', 'inline');
//$("#expdate"+lineNo).val(ui.item.expdate);
$("#expdate"+lineNo).css('display', 'none');
$("#productexpdatespan"+lineNo).css('display', 'inline');
$("#productexpdateedit"+lineNo).css('display', 'inline');
$("#productexpdateupdate"+lineNo).css('display', 'none');
$("#productmrpval"+lineNo).html(ui.item.mrp);
$("#productmrpval"+lineNo).css('display', 'inline');
$("#mrp"+lineNo).val(ui.item.mrp);
$("#mrp"+lineNo).css('display', 'none');
$("#productmrpspan"+lineNo).css('display', 'inline');
$("#productmrpedit"+lineNo).css('display', 'inline');
$("#productmrpupdate"+lineNo).css('display', 'none');
$("#productnoofpacksval"+lineNo).html(ui.item.noofpacks);
$("#productnoofpacksval"+lineNo).css('display', 'inline');
$("#noofpacks"+lineNo).val(ui.item.noofpacks);
$("#noofpacks"+lineNo).css('display', 'none');
$("#productnoofpacksspan"+lineNo).css('display', 'inline');
$("#productnoofpacksedit"+lineNo).css('display', 'inline');
$("#productnoofpacksupdate"+lineNo).css('display', 'none');
$("#productprodiscountval"+lineNo).html(ui.item.salediscount);
$("#productprodiscountval"+lineNo).css('display', 'inline');
$("#prodiscount"+lineNo).val(ui.item.salediscount);
$("#prodiscount"+lineNo).css('display', 'none');
$("#productprodiscountspan"+lineNo).css('display', 'inline');
$("#productprodiscountedit"+lineNo).css('display', 'inline');
$("#productprodiscountupdate"+lineNo).css('display', 'none');
$("#productvatval"+lineNo).html(ui.item.tax);
$("#productvatval"+lineNo).css('display', 'inline');
$("#vat"+lineNo).val(ui.item.tax);
$("#vat"+lineNo).css('display', 'none');
$("#productvatspan"+lineNo).css('display', 'inline');
$("#productvatedit"+lineNo).css('display', 'inline');
$("#productvatupdate"+lineNo).css('display', 'none');
},
minLength: 2
}).data("ui-autocomplete")._renderItem = function(ui, item) {
return $("<li class='ui-autocomplete-row'></li>")
.data("item.autocomplete", item)
.append(item.label)
.appendTo(ui);
};
}
function addnewrow(lineNo)
{
var y=0;
var productvalues = document.getElementsByName('productvalue[]');
for (var i = 0; i < productvalues.length; i++)
{
if(productvalues[i].value=='')
{
y++;
}
}
if(y==0)
{
markup = '<tr><td class="priority" style="display:none"> '+lineNo+'</td><td class="tdmove"><svg version="1.1" id="Layer_'+lineNo+'" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td><input type="hidden" name="productid[]" id="productid'+lineNo+'"><input type="text" name="productname[]" id="productname'+lineNo+'" class="form-control form-control-sm bordernoneinput" ><span class="badge" style="display:none; width:75px; padding:3px; margin:5px 0; background-color: #57b729; font-size:75%" id="itemmodule'+lineNo+'"></span><span id="productmanufacturerspan'+lineNo+'" style="display:none; font-size:11px;">Manufacturer:</span> <span id="productmanufacturerval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productmanufactureredit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmanufacturer('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productmanufacturerupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemanufacturer('+lineNo+')"><i class="fa fa-save"></i></span><input type="text" name="manufacturer[]" id="manufacturer'+lineNo+'" class="form-control form-control-sm" style="display:none;"><br><span id="producthsncodespan'+lineNo+'" style="display:none; font-size:11px;">HSN Code:</span> <span id="producthsncodeval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="producthsncodeedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="edithsncode('+lineNo+')"><i class="fa fa-edit"></i></span><span id="producthsncodeupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changehsncode('+lineNo+')"><i class="fa fa-save"></i></span><input type="text" name="producthsn[]" id="producthsn'+lineNo+'" class="form-control form-control-sm" style="display:none;"><span id="productdescriptionspan'+lineNo+'" style="display:none; font-size:11px;">Description:</span><textarea class="form-control form-control-sm" name="productdescription[]" id="productdescription'+lineNo+'" style="height:50px; display:none; border:none;"></textarea></td><td style="display:none"><input type="text" name="productnotes[]" id="productnotes'+lineNo+'" class="form-control form-control-sm bordernoneinput"></td><td><input type="text" name="batch[]" id="batch'+lineNo+'" class="form-control form-control-sm bordernoneinput"><span id="productexpdatespan'+lineNo+'" style="display:none; font-size:11px;">EXPIRY:</span> <span id="productexpdateval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productexpdateedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productexpdateupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate('+lineNo+')"><i class="fa fa-save"></i></span><input type="date" name="expdate[]" id="expdate'+lineNo+'" class="form-control form-control-sm" style="display:none;"></td><td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:#cccccc"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="productrate[]"   id="productrate'+lineNo+'" class="form-control form-control-sm bordernoneinput" onChange="productcalc('+lineNo+')"></div><span id="productmrpspan'+lineNo+'" style="display:none; font-size:11px;">MRP:</span> <span id="productmrpval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productmrpedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editmrp('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productmrpupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changemrp('+lineNo+')"><i class="fa fa-save"></i></span><input type="number" name="mrp[]" id="mrp'+lineNo+'" class="form-control form-control-sm" style="display:none;" min="0" step="0.01"></td><td><input type="number" min="0" step="0.01" name="quantity[]" id="quantity'+lineNo+'" class="form-control form-control-sm bordernoneinput" onChange="productcalc('+lineNo+')"><span id="productnoofpacksspan'+lineNo+'" style="display:none; font-size:11px;">PACK:</span> <span id="productnoofpacksval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productnoofpacksedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editnoofpacks('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productnoofpacksupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changenoofpacks('+lineNo+')"><i class="fa fa-save"></i></span><input type="text" name="noofpacks[]" id="noofpacks'+lineNo+'" class="form-control form-control-sm" style="display:none;"></td><td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:#cccccc"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="productvalue[]" id="productvalue'+lineNo+'" class="form-control form-control-sm bordernoneinput" style="background:none;" readonly ></div><span id="productprodiscountspan'+lineNo+'" style="display:none; font-size:11px;">DISCOUNT:</span> <span id="productprodiscountval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productprodiscountedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editprodiscount('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productprodiscountupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeprodiscount('+lineNo+')"><i class="fa fa-save"></i></span><input type="number" min="0" step="0.01" name="prodiscount[]" id="prodiscount'+lineNo+'" class="form-control form-control-sm" style="display:none;" onChange="productcalc('+lineNo+')"></td><td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:#cccccc"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="taxvalue[]" id="taxvalue'+lineNo+'" class="form-control form-control-sm bordernoneinput"style="background:none;" readonly ></div><span id="productvatspan'+lineNo+'" style="display:none; font-size:11px;">VAT:</span> <span id="productvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productvatedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editvat('+lineNo+')"><i class="fa fa-edit"></i></span><span id="productvatupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changevat('+lineNo+')"><i class="fa fa-save"></i></span><input type="number" min="0" step="0.01" name="vat[]" id="vat'+lineNo+'" class="form-control form-control-sm" style="display:none;"><span id="productcgstvatspan'+lineNo+'" style="display:none; font-size:11px;">CGST:</span><span id="productcgstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productsgstvatspan'+lineNo+'" style="display:none; font-size:11px;">SGST:</span> <span id="productsgstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span><span id="productigstvatspan'+lineNo+'" style="display:none; font-size:11px;">IGST:</span> <span id="productigstvatval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span></td><td><div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color:#cccccc"><?php echo $rescurrency[0]; ?></div></div><input type="number" min="0" step="0.01" name="productnetvalue[]" id="productnetvalue'+lineNo+'" class="form-control form-control-sm bordernoneinput"style="background:none;" readonly ></div></td><td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td></tr>';
tableBody = $("#purchasetable");
tableBody.append(markup);
proautocomp(lineNo);
renumber_table('#purchasetable');
}
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
$("#productname1").autocomplete({
source: 'prosearch.php',
select: function(event, ui) {
$("#productid1").val(ui.item.id);
$("#productname1").val(ui.item.productname);
$("#productnotes1").val(ui.item.description);
$("#productdescription1").val(ui.item.description);
$("#productdescription1").css('display', 'block');
$("#productdescriptionspan1").css('display', 'block');
$("#itemmodule1").html(ui.item.itemmodule);
$("#itemmodule1").css('display', 'block');
$("#producthsn1").val(ui.item.hsncode);
$("#mrp1").val(ui.item.salemrp);
$("#vat1").val(ui.item.tax);
$("#productrate1").val(ui.item.salecost);
$("#prodiscount1").val(ui.item.salediscount);
$("#productmanufacturerval1").html(ui.item.manufacturer);
$("#productmanufacturerval1").css('display', 'inline');
$("#manufacturer1").val(ui.item.manufacturer);
$("#manufacturer1").css('display', 'none');
$("#productmanufacturerspan1").css('display', 'inline');
$("#productmanufactureredit1").css('display', 'inline');
$("#productmanufacturerupdate1").css('display', 'none');
$("#producthsncodeval1").html(ui.item.hsncode);
$("#producthsncodeval1").css('display', 'inline');
$("#producthsn1").val(ui.item.hsncode);
$("#producthsn1").css('display', 'none');
$("#producthsncodespan1").css('display', 'inline');
$("#producthsncodeedit1").css('display', 'inline');
$("#producthsncodeupdate1").css('display', 'none');
//$("#productexpdateval1").html(ui.item.expdate);
$("#productexpdateval1").css('display', 'inline');
//$("#expdate1").val(ui.item.expdate);
$("#expdate1").css('display', 'none');
$("#productexpdatespan1").css('display', 'inline');
$("#productexpdateedit1").css('display', 'inline');
$("#productexpdateupdate1").css('display', 'none');
$("#productmrpval1").html(ui.item.mrp);
$("#productmrpval1").css('display', 'inline');
$("#mrp1").val(ui.item.mrp);
$("#mrp1").css('display', 'none');
$("#productmrpspan1").css('display', 'inline');
$("#productmrpedit1").css('display', 'inline');
$("#productmrpupdate1").css('display', 'none');
$("#productnoofpacksval1").html(ui.item.noofpacks);
$("#productnoofpacksval1").css('display', 'inline');
$("#noofpacks1").val(ui.item.noofpacks);
$("#noofpacks1").css('display', 'none');
$("#productnoofpacksspan1").css('display', 'inline');
$("#productnoofpacksedit1").css('display', 'inline');
$("#productnoofpacksupdate1").css('display', 'none');
$("#productprodiscountval1").html(ui.item.salediscount);
$("#productprodiscountval1").css('display', 'inline');
$("#prodiscount1").val(ui.item.salediscount);
$("#prodiscount1").css('display', 'none');
$("#productprodiscountspan1").css('display', 'inline');
$("#productprodiscountedit1").css('display', 'inline');
$("#productprodiscountupdate1").css('display', 'none');
$("#productvatval1").html(ui.item.tax);
$("#productvatval1").css('display', 'inline');
$("#vat1").val(ui.item.tax);
$("#vat1").css('display', 'none');
$("#productvatspan1").css('display', 'inline');
$("#productvatedit1").css('display', 'inline');
$("#productvatupdate1").css('display', 'none');
},
minLength: 2
}).data("ui-autocomplete")._renderItem = function(ui, item) {
return $("<li class='ui-autocomplete-row'></li>")
.data("item.autocomplete", item)
.append(item.label)
.appendTo(ui);
};
/*  $( "#customername" ).autocomplete({
source: 'customersearch.php', select: function (event, ui) { $("#area").val(ui.item.address); $("#city").val(ui.item.city); $("#district").val(ui.item.country); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pin); $( "#productname1" ).focus();}, minLength: 1
}); */
$( "#area" ).autocomplete({
source: 'areasearch.php', select: function (event, ui) { $("#area").val(ui.item.area); $("#city").val(ui.item.city); $("#district").val(ui.item.district); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pincode);}, minLength: 2
});
$( "#email" ).autocomplete({
source: 'franchisesearch.php?type=email',
});
});
</script>
<script>
function editmanufacturer(id)
{
$("#productmanufacturerval"+id).css('display', 'none');
$("#manufacturer"+id).css('display', 'block');
$("#productmanufacturerspan"+id).css('display', 'inline');
$("#productmanufactureredit"+id).css('display', 'none');
$("#productmanufacturerupdate"+id).css('display', 'inline');
}
function changemanufacturer(id)
{
$("#productmanufacturerval"+id).html($("#manufacturer"+id).val());
$("#productmanufacturerval"+id).css('display', 'inline');
$("#manufacturer"+id).css('display', 'none');
$("#productmanufacturerspan"+id).css('display', 'inline');
$("#productmanufactureredit"+id).css('display', 'inline');
$("#productmanufacturerupdate"+id).css('display', 'none');
}
</script>
<script>
function edithsncode(id)
{
$("#producthsncodeval"+id).css('display', 'none');
$("#producthsn"+id).css('display', 'block');
$("#producthsncodespan"+id).css('display', 'inline');
$("#producthsncodeedit"+id).css('display', 'none');
$("#producthsncodeupdate"+id).css('display', 'inline');
}
function changehsncode(id)
{
$("#producthsncodeval"+id).html($("#producthsn"+id).val());
$("#producthsncodeval"+id).css('display', 'inline');
$("#producthsn"+id).css('display', 'none');
$("#producthsncodespan"+id).css('display', 'inline');
$("#producthsncodeedit"+id).css('display', 'inline');
$("#producthsncodeupdate"+id).css('display', 'none');
}
</script>
<script>
function editexpdate(id)
{
$("#productexpdateval"+id).css('display', 'none');
$("#expdate"+id).css('display', 'block');
$("#productexpdatespan"+id).css('display', 'inline');
$("#productexpdateedit"+id).css('display', 'none');
$("#productexpdateupdate"+id).css('display', 'inline');
}
function changeexpdate(id)
{
$("#productexpdateval"+id).html($("#expdate"+id).val());
$("#productexpdateval"+id).css('display', 'inline');
$("#expdate"+id).css('display', 'none');
$("#productexpdatespan"+id).css('display', 'inline');
$("#productexpdateedit"+id).css('display', 'inline');
$("#productexpdateupdate"+id).css('display', 'none');
}
</script>
<script>
function editmrp(id)
{
$("#productmrpval"+id).css('display', 'none');
$("#mrp"+id).css('display', 'block');
$("#productmrpspan"+id).css('display', 'inline');
$("#productmrpedit"+id).css('display', 'none');
$("#productmrpupdate"+id).css('display', 'inline');
}
function changemrp(id)
{
$("#productmrpval"+id).html($("#mrp"+id).val());
$("#productmrpval"+id).css('display', 'inline');
$("#mrp"+id).css('display', 'none');
$("#productmrpspan"+id).css('display', 'inline');
$("#productmrpedit"+id).css('display', 'inline');
$("#productmrpupdate"+id).css('display', 'none');
}
</script>
<script>
function editnoofpacks(id)
{
$("#productnoofpacksval"+id).css('display', 'none');
$("#noofpacks"+id).css('display', 'block');
$("#productnoofpacksspan"+id).css('display', 'inline');
$("#productnoofpacksedit"+id).css('display', 'none');
$("#productnoofpacksupdate"+id).css('display', 'inline');
}
function changenoofpacks(id)
{
$("#productnoofpacksval"+id).html($("#noofpacks"+id).val());
$("#productnoofpacksval"+id).css('display', 'inline');
$("#noofpacks"+id).css('display', 'none');
$("#productnoofpacksspan"+id).css('display', 'inline');
$("#productnoofpacksedit"+id).css('display', 'inline');
$("#productnoofpacksupdate"+id).css('display', 'none');
}
</script>
<script>
function editprodiscount(id)
{
$("#productprodiscountval"+id).css('display', 'none');
$("#prodiscount"+id).css('display', 'block');
$("#productprodiscountspan"+id).css('display', 'inline');
$("#productprodiscountedit"+id).css('display', 'none');
$("#productprodiscountupdate"+id).css('display', 'inline');
}
function changeprodiscount(id)
{
$("#productprodiscountval"+id).html($("#prodiscount"+id).val());
$("#productprodiscountval"+id).css('display', 'inline');
$("#prodiscount"+id).css('display', 'none');
$("#productprodiscountspan"+id).css('display', 'inline');
$("#productprodiscountedit"+id).css('display', 'inline');
$("#productprodiscountupdate"+id).css('display', 'none');
}
</script>
<script>
function editvat(id)
{
$("#productvatval"+id).css('display', 'none');
$("#vat"+id).css('display', 'block');
$("#productvatspan"+id).css('display', 'inline');
$("#productvatedit"+id).css('display', 'none');
$("#productvatupdate"+id).css('display', 'inline');
}
function changevat(id)
{
$("#productvatval"+id).html($("#vat"+id).val());
$("#productvatval"+id).css('display', 'inline');
$("#vat"+id).css('display', 'none');
$("#productvatspan"+id).css('display', 'inline');
$("#productvatedit"+id).css('display', 'inline');
$("#productvatupdate"+id).css('display', 'none');
}
</script>
<script>
function isEmpty(object) {
for (const property in object) {
return false;
}
return true;
}
$(document).ready(function(){
$('#customer').change(function(){
$('#custaddressdiv').css("display", "none");
var id= $('#customer').val();
if(id != '')
{
$.get("customersearch1.php", {term: id} , function(data){
console.log(data);
const obj = JSON.parse(data);
if(isEmpty(obj)==false)
{
$('#custaddressdiv').css("display", "flex");
}
else
{
$('#custaddressdiv').css("display", "none");
}
console.log(obj[0]);
$("#customername").val(obj[0].customername);
$("#customerid").val(obj[0].id);
$("#area").val(obj[0].address);
$("#city").val(obj[0].city);
$("#district").val(obj[0].country);
$("#state").val(obj[0].state);
$("#pincode").val(obj[0].pin);
$("#gstno").val(obj[0].gstin);
$("#gstrtype").val(obj[0].gstrtype);
$("#workphone").val(obj[0].workphone);
$("#mobile").val(obj[0].mobile);
$("#sarea").val(obj[0].saddress);
$("#scity").val(obj[0].scity);
$("#sdistrict").val(obj[0].scountry);
$("#sstate").val(obj[0].sstate);
$("#spincode").val(obj[0].spin);
$("#pos").val(obj[0].pos);
//$( "#productname1" ).focus();
var ase=obj[0].address+' '+obj[0].city+' '+obj[0].state+' '+obj[0].pin+' '+obj[0].country+'';
ase=ase.trim();
var ase1=obj[0].saddress+' '+obj[0].scity+' '+obj[0].sstate+' '+obj[0].spin+' '+obj[0].scountry+'';
ase1=ase1.trim();
var ase2=obj[0].gstrtype+' '+obj[0].gstin+'';
ase2=ase2.trim();
var ase3=obj[0].workphone+' '+obj[0].mobile+'';
ase3=ase3.trim();
if(ase=="")
{
$("#billingaddressdiv").html(ase);
$("#billingaddressspan").html("Add New Address");
}
else
{
$("#billingaddressdiv").html(ase);
$("#billingaddressspan").html("CHANGE");
}
if(ase1=="")
{
$("#shippingaddressdiv").html(ase1);
$("#shippingaddressspan").html("Add New Address");
}
else
{
$("#shippingaddressdiv").html(ase1);
$("#shippingaddressspan").html("CHANGE");
}
if(ase2=="")
{
$("#gstrtypediv").html(ase2);
$("#gsttypespan").html("ADD NEW GSTIN");
}
else
{
$("#gstrtypediv").html(ase2);
$("#gsttypespan").html("CHANGE");
}
if(ase3=="")
{
$("#workphonediv").html(ase3);
$("#worktypespan").html("ADD NEW PHONE");
}
else
{
$("#workphonediv").html(ase3);
$("#worktypespan").html("CHANGE");
}
});
}
else
{
alert("Please Select Customer");
$('#custaddressdiv').css("display", "none");
}
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
var taxval=parseFloat(productvat)-parseFloat(productvalue);

var pos=$('#pos').val();
var franpos="<?=$franpos?>";
if(pos=="")
{
	pos="TAMIL NADU (33)";
}
if(franpos=="")
{
	franpos="TAMIL NADU (33)";
}

if(pos!=franpos)
{
	$('#productcgstvatspan'+id).css("display", "none");
	$('#productcgstvatval'+id).css("display", "none");
	$('#productsgstvatspan'+id).css("display", "none");
	$('#productsgstvatval'+id).css("display", "none");
	$('#productigstvatspan'+id).css("display", "inline");
	$('#productigstvatval'+id).css("display", "inline");	
	$('#productigstvatspan'+id).html("<br>IGST: ");
	$('#productigstvatval'+id).html(""+(parseFloat(vat))+" ("+(parseFloat(Math.round((taxval) * 100) / 100).toFixed(2))+")");
}
else
{
	$('#productcgstvatspan'+id).css("display", "inline");
	$('#productcgstvatval'+id).css("display", "inline");
	$('#productsgstvatspan'+id).css("display", "inline");
	$('#productsgstvatval'+id).css("display", "inline");
	$('#productigstvatspan'+id).css("display", "none");
	$('#productigstvatval'+id).css("display", "none");
	$('#productcgstvatspan'+id).html("<br>CGST: ");
	$('#productsgstvatspan'+id).html("<br>SGST: ");
	$('#productcgstvatval'+id).html(""+(parseFloat(vat)/2)+" ("+(parseFloat(Math.round((taxval/2) * 100) / 100).toFixed(2))+")");
	$('#productsgstvatval'+id).html(""+(parseFloat(vat)/2)+" ("+(parseFloat(Math.round((taxval/2) * 100) / 100).toFixed(2))+")");
}	
$('#taxvalue'+id).val(parseFloat(Math.round((taxval) * 100) / 100).toFixed(2));
$('#productnetvalue'+id).val(parseFloat(Math.round(productvat * 100) / 100).toFixed(2));
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
RsPaise(parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2));
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
<script>
function funadddue() {
var missingduename = document.getElementById('missingduename');
var missingduedate = document.getElementById('missingduedate');
if (missingduename.value == ''||missingduedate.value == '') {
alert('Please Enter New Due Name And Due Date');
missingduename.focus();
return false;
}
else {
$('#duedateselects').append('<option value="' + missingduename.value + '">' + missingduename.value + '-' + missingduedate.value +
'</option>');
$('select[name^="duedateselects"] option[value="' + missingduename.value + '"]').attr("selected","selected");
$('#duedateselects').val(missingduename.value).change();
$('#AddNewDue').modal('hide');
return false;
}
}
function funesdue() {
// $('#duedateselects').val('').change();
$('#AddNewDue').modal('hide');
return false;
}
</script>
<script type="text/javascript">
$("#duedateselects").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewDue");
});
$("#duedateselects").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "+ New";
});
</script>
<!-- sve button spinner -->
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
<!-- purchase table add another row -->
<!------------------------------------------ pro script start ------------------------------------------>
<script type="text/javascript">
$(document).ready(function () {
window.setTimeout(function() {
$(".alert").fadeTo(1000, 0).slideUp(1000, function(){
$(this).remove();
});
}, 4000);
});
</script>
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
<script type="text/javascript">
function title(x){
var Characters = x.value;
}
</script>
<script type="text/javascript">
function title(x){
var Characters = x.value;
}
</script>
<script type="text/javascript">
function taxable() {
document.getElementById('protaxablediv').style.display = "block";
document.getElementById('pronontaxablediv').style.display = "none";
}
function nontaxable() {
document.getElementById('protaxablediv').style.display = "none";
document.getElementById('pronontaxablediv').style.display = "block";
}
</script>
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
<script type="text/javascript">
$(function() {
$("#invoicesuffix").autocomplete({
source: 'invoicesuffixsearch.php',
select: function(event, ui) {
$("#invoicesuffix").val(ui.item.invoicesuffix);
$("#city").val(ui.item.city);
$("#district").val(ui.item.district);
$("#state").val(ui.item.state);
$("#pincode").val(ui.item.pincode);
},
minLength: 2
});
$("#email").autocomplete({
source: 'franchisesearch.php?type=email',
});
});
</script>
<script>
$("#prodefaultunit").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#proAddNewDefaultUnit') {
$('#proAddNewDefaultUnit').modal('show');
}
});
</script>
<script>
function profunadddefaultunit() {
var promissingdefaultunit = document.getElementById('promissingdefaultunit');
var prouqc = document.getElementById('prouqc');
if (promissingdefaultunit.value == ''||prouqc.value == '') {
alert('Please Enter New Default Unit Name And Uqc');
promissingdefaultunit.focus();
return false;
} else {
$('#prodefaultunit').append('<option value="' + promissingdefaultunit.value + ',' + prouqc.value + '">' + promissingdefaultunit.value + '-' + prouqc.value +
'</option>');
$('select[name^="prodefaultunit"] option[value="' + promissingdefaultunit.value + ',' + prouqc.value + '"]').attr("selected","selected");
$('#prodefaultunit').val(promissingdefaultunit.value).change();
$('#proAddNewDefaultUnit').modal('hide');
return false;
}
}
function profunesdefaultunit() {
$('#prodefaultunit').val('').change();
$('#proAddNewDefaultUnit').modal('hide');
return false;
}
</script>
<script>
$("#procategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#proAddNewCategory') {
$('#proAddNewCategory').modal('show');
}
});
$("#prosubcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#proAddNewSubCategory') {
$('#proAddNewSubCategory').modal('show');
}
});
</script>
<script>
function profunaddcategory() {
var promissingcategory = document.getElementById('promissingcategory');
if (promissingcategory.value == '') {
alert('Please Enter New Category Name');
promissingcategory.focus();
return false;
} else {
$('#procategory').append('<option value="' + promissingcategory.value + '">' + promissingcategory.value +
'</option>');
$('#procategory').val(promissingcategory.value).change();
$('#proAddNewCategory').modal('hide');
return false;
}
}
function profunescategory() {
$('#procategory').val('').change();
$('#proAddNewCategory').modal('hide');
return false;
}
</script>
<script>
function profunaddsubcategory() {
var promissingsubcategory = document.getElementById('promissingsubcategory');
if (promissingsubcategory.value == '') {
alert('Please Enter New Sub Category Name');
promissingsubcategory.focus();
return false;
} else {
$('#prosubcategory').append('<option value="' + promissingsubcategory.value + '">' + promissingsubcategory.value +
'</option>');
$('#prosubcategory').val(promissingsubcategory.value).change();
$('#proAddNewSubCategory').modal('hide');
return false;
}
}
function profunessubcategory() {
$('#prosubcategory').val('').change();
$('#proAddNewSubCategory').modal('hide');
return false;
}
</script>
<!-- <script type="text/javascript">
function funaddintratax() {
var missingintra = document.getElementById('missingintratax');
if (missingintratax.value == '') {
alert('Please Enter New Intra Tax');
missingintratax.focus();
return false;
} else {
$('#intratax').append('<option value="' + missingintratax.value + '">' + missingintratax.value +
'</option>');
$('#intratax').val(missingintratax.value).change();
$('#NewIntraTax').modal('hide');
return false;
}
}
function funesintratax() {
$('#intratax').val('').change();
$('#NewIntraTax').modal('hide');
return false;
}
</script> -->
<script type="text/javascript">
$(function() {
$("#proproductname").autocomplete({
source: 'productsearch.php?type=proproductname',
});
$("#procategory").autocomplete({
source: 'productsearch.php?type=procategory',
});
});
</script>
<script>
let lineNo = 2;
$(document).ready(function() {
$(".purchaseadd-row").click(function() {
markup =
'<tr><td style="width:3%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td style="width:18%;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="proproductname[]" id="proproductname1' +
lineNo +
'" required class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title=""></td><td style="width:11%;"><div class="input-group mb-3 input-group-sm"><div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1' +
lineNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div><td style="width: 6%;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1' +
lineNo +
'" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1' +
lineNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td style="width:3%;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>';
tableBody = $("#purchasetable");
tableBody.append(markup);
renumber_table('#purchasetable');
lineNo++;
});
});
</script>
<script>
let linesNo = 2;
$(document).ready(function() {
$(".saleadd-row").click(function() {
markup =
'<tr><td data-label="" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td data-label="PRICE NAME" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="proproductname[]" id="proproductname1" required class="form-control form-control-sm bordernoneinput bor"  style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title="" placeholder="Sale Price or Trade Price or Wholesale Price"></td><td data-label="MRP" style="padding-bottom:0px !important;margin-bottom: -18px !important;padding-top: 13.2px !important;"><div class="input-group mb-3 input-group-sm"><div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div></td><td data-label="SELLING PRICE" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td data-label="DESCRIPTION" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td data-label="" style="padding-bottom: 9px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-deletes" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td></tr>';
tableBody = $("#saletable");
tableBody.append(markup);
var start = moment().subtract(29, 'days');
var end = moment();
$('#reportrange' + linesNo).daterangepicker({
startDate: start,
endDate: end,
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
.subtract(1, 'month').endOf('month')
]
},
"alwaysShowCalendars": true,
"applyClass": "btn-custom",
"cancelClass": "btn-custom-grey"
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') +
' to ' + end.format('YYYY-MM-DD'));
});
renumber_table('#saletable');
linesNo++;
});
});
</script>
<script>
let linesNo = 2;
$(document).ready(function() {
$(".inventoryadd-row").click(function() {
markup =
'<tr><td style="width:3%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td style="width:18%;"><input type="hidden" name="productid[]" id="productid1' +
linesNo +
'"><input type="text" name="proproductname[]" id="proproductname1" required class="form-control form-control-sm bordernoneinput bor"  style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title=""></td><td style="width:11%;"> <div class="input-group mb-3 input-group-sm"> <div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1' +
linesNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div></td><td style="width: 6%;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1' +
linesNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td style="width:3%;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete' +
linesNo +
'" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>';
tableBody = $("#inventorytable");
tableBody.append(markup);
var start = moment().subtract(29, 'days');
var end = moment();
$('#reportrange' + linesNo).daterangepicker({
startDate: start,
endDate: end,
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
.subtract(1, 'month').endOf('month')
]
},
"alwaysShowCalendars": true,
"applyClass": "btn-custom",
"cancelClass": "btn-custom-grey"
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') +
' to ' + end.format('YYYY-MM-DD'));
});
renumber_table('#inventorytable');
linesNo++;
});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
//Helper function to keep table row from collapsing when being sorted
var fixHelperModified = function(e, tr) {
var $originals = tr.children();
var $helper = tr.clone();
$helper.children().each(function(index) {
$(this).width($originals.eq(index).width())
});
return $helper;
};
//Make diagnosis table sortable
$("#purchasetable tbody").sortable({
helper: fixHelperModified,
stop: function(event, ui) {
renumber_table('#purchasetable')
}
}).disableSelection();
//Make diagnosis table sortable
$("#saletable tbody").sortable({
helper: fixHelperModified,
stop: function(event, ui) {
renumber_table('#saletable')
}
}).disableSelection();
$("#inventorytable tbody").sortable({
helper: fixHelperModified,
stop: function(event, ui) {
renumber_table('#inventorytable')
}
}).disableSelection();
//Delete button in table rows
//     $('table').on('click', '.btn-delete', function() {
//         tableID = '#' + $(this).closest('table').attr('id');
//         r = confirm('Delete this item?');
//         if (r) {
//             $(this).closest('tr').remove();
//             renumber_table(tableID);
//         }
//     });
// });
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
$(document).ready(function() {
$('table').on('click','.btn-deletes',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("saletable").rows.length;
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
</script>
<!------------------------------------------------ what is this ------------------------------------------------>
<!-- <script>
$("#prosubcategory").select2({
placeholder: "Select Country",
allowClear: true
});
</script> -->
<!------------------------------------------------ what is this ------------------------------------------------>
<script>
function readURL(input, imgControlName) {
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function(e) {
$(imgControlName).attr('src', e.target.result);
}
reader.readAsDataURL(input.files[0]);
}
}
$("#imag").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview";
readURL(this, imgControlName);
$('.preview1').addClass('it');
$('#removeImage1').css("color", "black");
});
$("#imag2").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview2";
readURL(this, imgControlName);
$('.preview2').addClass('it');
$('.btn-rmv2').addClass('rmv');
});
$("#imag3").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview3";
readURL(this, imgControlName);
$('.preview3').addClass('it');
$('.btn-rmv3').addClass('rmv');
});
$("#imag4").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview4";
readURL(this, imgControlName);
$('.preview4').addClass('it');
$('.btn-rmv4').addClass('rmv');
});
$("#imag5").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview5";
readURL(this, imgControlName);
$('.preview5').addClass('it');
});
$("#removeImage1").click(function(e) {
e.preventDefault();
$("#imag").val("");
$("#ImgPreview").attr("src",
"assets/img/productimage1.png"
);
$('.preview1').removeClass('it');
$('#removeImage1').css("color", "#6c757d");
});
$("#removeImage2").click(function(e) {
e.preventDefault();
$("#imag2").val("");
$("#ImgPreview2").attr("src",
"assets/img/productimage1.png"
);
$('.preview2').removeClass('it');
$('#removeImage2').css("color", "#6c757d");
});
$("#removeImage3").click(function(e) {
e.preventDefault();
$("#imag3").val("");
$("#ImgPreview3").attr("src",
"assets/img/productimage1.png"
);
$('.preview3').removeClass('it');
$('#removeImage3').css("color", "#6c757d");
});
$("#removeImage4").click(function(e) {
e.preventDefault();
$("#imag4").val("");
$("#ImgPreview4").attr("src",
"assets/img/productimage1.png"
);
$('.preview4').removeClass('it');
$('#removeImage4').css("color", "#6c757d");
});
$("#removeImage5").click(function(e) {
e.preventDefault();
$("#imag5").val("");
$("#ImgPreview5").attr("src",
"assets/img/productimage1.png"
);
$('.preview5').removeClass('it');
$('#removeImage5').css("color", "#6c757d");
});
</script>
<script>
var fixHelperModified = function(e, tr) {
var $originals = tr.children();
var $helper = tr.clone();
$helper.children().each(function(index) {
$(this).width($originals.eq(index).width())
});
return $helper;
},
updateIndex = function(e, ui) {
$('td.index', ui.item.parent()).each(function(i) {
$(this).html(i + 1);
});
$('input[type=text]', ui.item.parent()).each(function(i) {
$(this).val(i + 1);
});
};
$("#purchasetable tbody").sortable({
helper: fixHelperModified,
stop: updateIndex
}).disableSelection();
$("tbody").sortable({
distance: 5,
delay: 100,
opacity: 0.6,
cursor: 'move',
update: function() {}
});
</script>
<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<script>
$(function() {
var start = moment().subtract(29, 'days');
var end = moment();
$('#reportrange1').daterangepicker({
startDate: start,
endDate: end,
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
'month').endOf('month')]
},
"alwaysShowCalendars": true,
"applyClass": "btn-custom",
"cancelClass": "btn-custom-grey"
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
.format('YYYY-MM-DD'));
});
});
</script>
<script>
$(document).ready(function() {
$("#prodefaultunit").change(function(event) {
$('.unitchange span').html($(this).val());
});
});
$('#purchaseunit').on('change', function() {
var defaultunitval = $('#defaultunit').find(":selected").val();
var purchaseunitval = $('#purchaseunit').find(":selected").val();
if (defaultunitval === purchaseunitval) {
$('#purchaseindunit1').attr('disabled', true);
} else {
$('#purchaseindunit1').attr('disabled', false);
}
});
$('#salesunit').on('change', function() {
var defaultunitval = $('#defaultunit').find(":selected").val();
var salesunittval = $('#salesunit').find(":selected").val();
if (defaultunitval === salesunittval) {
$('#saleindunit').attr('disabled', true);
} else {
$('#saleindunit').attr('disabled', false);
}
});
</script>
<script>
$(document).ready(function() {
$('[data-toggle="tooltip"]').tooltip();
});
$("#submit").click(function() {
$(".Spinnn").css("display", "block");
$(".Spinnn").fadeOut(200);
});
checkBox = document.getElementById('trackinventory').addEventListener('click', event => {
if (event.target.checked) {
document.getElementById('table').style.display='none';
} else {
document.getElementById('table').style.display='block';
}
});
$('#ImgPreview').click(function() {
$('#imag').click();
});
$('#ImgPreview2').click(function() {
$('#imag2').click();
});
$('#ImgPreview3').click(function() {
$('#imag3').click();
});
$('#ImgPreview4').click(function() {
$('#imag4').click();
});
$('#ImgPreview5').click(function() {
$('#imag5').click();
});
</script>
<script>
var buttons = document.querySelectorAll( '.arlina-button' );
Array.prototype.slice.call( buttons ).forEach( function( button ) {
var resetTimeout;
button.addEventListener( 'click', function() {
if( typeof button.getAttribute( 'data-loading' ) === 'string' ) {
button.removeAttribute( 'data-loading' );
}
else {
button.setAttribute( 'data-loading', '' );
}
clearTimeout( resetTimeout );
resetTimeout = setTimeout( function() {
button.removeAttribute( 'data-loading' );
}, 1000 );
}, false );
} );
</script>
<script>
$("#prointratax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prointertax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prosubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewSubCategory");
});
$("#prosubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#procategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewCategory");
});
$("#procategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Category";
});
$("#prodefaultunit").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewDefaultUnit");
});
$("#prodefaultunit").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Unit";
});
$("#prointratax").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Intra Tax";
});
$("#prointratax").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#NewIntraTax");
});
</script>
<script>
function funaddproduct() {
var missingproduct = document.getElementById('proproductname');
if (missingproduct.value == '') {
alert('Please Enter New Product Name');
missingproduct.focus();
return false;
}
else {
$('#AddNewProduct').modal('hide');
return false;
}
}
function funesproduct() {
$('#AddNewProduct').modal('hide');
return false;
}
</script>
<!------------------------------------------- pro script end ------------------------------------------->
<!--term start-->
<div class="modal fade" id="AddNewInvoiceTerm" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New Invoice Term</h5>
<span type="button" onclick="funesinvoiceterm()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="closeicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missinginvoiceterm" class="custom-label"><span class="text-danger">
Invoice Term *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="invoiceterm" class="form-control form-control-sm mb-4" id="missinginvoiceterm" placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer ">
<div class="col">
<button   onclick="funaddinvoiceterm()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitinvoiceterm" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funesinvoiceterm()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<script>
$("#invoiceterm").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewInvoiceTerm') {
$('#AddNewInvoiceTerm').modal('show');
}
});
function funaddinvoiceterm() {
var missinginvoiceterm = document.getElementById('missinginvoiceterm');
if (missinginvoiceterm.value == '') {
alert('Please Enter New InvoiceTerm Name');
missinginvoiceterm.focus();
return false;
} else {
	
$.ajax({type: "POST",
url: "termadds.php",
data: {
term: $("#missinginvoiceterm").val(),
submit: "Submit"
},
success:function(result){
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
$('#invoiceterm').append('<option value="' + missinginvoiceterm.value + '">' + missinginvoiceterm.value +
'</option>');
$('#invoiceterm').val(missinginvoiceterm.value).change();
$("#invoiceterm").select2();
$('#AddNewInvoiceTerm').modal('hide');
return false;
}
}});

	

}
}
function funesinvoiceterm() {
//$('#invoiceterm').val('').change();
$("#invoiceterm").select2();
$('#AddNewInvoiceTerm').modal('hide');
return false;
}
$("#invoiceterm").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewInvoiceTerm");
});
$("#invoiceterm").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New InvoiceTerm";
});
</script>
<!--term end-->

<!--duedates start-->
<div class="modal fade" id="AddNewDueDate" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New Due Date</h5>
<span type="button" onclick="funesduedates()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="closeicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingduedates" class="custom-label"><span class="text-danger">
Name *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="duedates" class="form-control form-control-sm mb-1" id="missingduedates" placeholder="Name" required>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingnoofdays" class="custom-label"><span class="text-danger">
No of Dates *</span></label>
</div>
<div class="col-sm-7">
<input type="number" min="0" step="1" name="duedates" class="form-control form-control-sm mb-4" id="missingnoofdays" placeholder="No of Days" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer ">
<div class="col">
<button   onclick="funaddduedates()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitduedates" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funesduedates()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<script>
$("#duedates").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewDueDate') {
$('#AddNewDueDate').modal('show');
}
});
function funaddduedates() {
var missingduedates = document.getElementById('missingduedates');
var missingnoofdays = document.getElementById('missingnoofdays');
if (missingduedates.value == '') {
alert('Please Enter New DueDate Name');
missingduedates.focus();
return false;
} else if (missingnoofdays.value == '') {
alert('Please Enter New DueDate No of Days');
missingnoofdays.focus();
return false;
} else {
			
$.ajax({type: "POST",
url: "duedateadds.php",
data: {
duedate: $("#missingduedates").val(),
noofdays: $("#missingnoofdays").val(),
submit: "Submit"
},
success:function(result){
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
$('#duedates').append('<option value="' + missingnoofdays.value + '">' + missingduedates.value +
'</option>');
$('#duedates').val(missingnoofdays.value).change();
$("#duedates").select2();
$('#AddNewDueDate').modal('hide');
return false;
}
}});
}
}
function funesduedates() {
//$('#duedates').val('').change();
$("#duedates").select2();
$('#AddNewDueDate').modal('hide');
return false;
}
$("#duedates").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewDueDate");
});
$("#duedates").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = " New ";
});
</script>
<!--duedates end-->
<!--invoice attach start-->
<script>
    $(document).ready(function (){    
        $("#fileattach").change(function (){
			if($("#fileattach").get(0).files.length>5)
			{
				alert("Sorry only 5 files allowed");
				$("#fileattach").val("");
				return false;
			}
			else
			{
				for (var i = 0; i < $("#fileattach").get(0).files.length; ++i) {
					var file1=$("#fileattach").get(0).files[i].name;

					if(file1){                        
						var file_size=$("#fileattach").get(0).files[i].size;
						const files = Math.round((file_size / 1024));
						if(files<5000){
							var ext = file1.split('.').pop().toLowerCase();                            
							if($.inArray(ext,['jpg','jpeg','gif','doc','docx','xls','xlsx','pdf'])===-1){
								alert("Invalid file extension");
								$("#fileattach").val("");
								return false;
							}

						}else{
							alert("One of the File size is too large.");
							$("#fileattach").val("");
							return false;
						}                        
					}else{
						alert("Choose Any Attachment");         
						return false;
					}
            }
			}
        });
    });
</script>
<!--invoice attach end-->
<!---gst---->
<script>
$("#gstgstrtype").on("select2:open", function() {
$("#configureunits").hide();
});
</script>
<!---gst---->
<!---payment confirm---->
<script>
function triggerpayment(invoiceno,invoicedate,invoiceamount,cancelstatus)
{
	let allAreFilled = true;
  document.getElementById("invoiceform").querySelectorAll("[required]").forEach(function(i) {
    if (!allAreFilled) return;
    if (i.type === "radio") {
      let radioValueCheck = false;
			document.getElementById("invoiceform").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
        if (r.checked) radioValueCheck = true;
      })
      allAreFilled = radioValueCheck;
      return;
    }
    if (!i.value) { allAreFilled = false; return; }
  })
  if (!allAreFilled) {
    alert('Fill all the fields');
  }
  else
  {
	 $('#validinvoiceno').val($('#invoiceno').val());
	 $('#validinvoicedate').val($('#invoicedate').val());
	 $('#validinvoiceamount').val($('#grandtotal').val());
 	 $('#triggerconfirm-adddelete').modal('show');
	}
}
 
</script>
<!---payment confirm---->
<!----rupees--->
<script>function Rs(amount){
var words = new Array();
words[0] = 'Zero';words[1] = 'One';words[2] = 'Two';words[3] = 'Three';words[4] = 'Four';words[5] = 'Five';words[6] = 'Six';words[7] = 'Seven';words[8] = 'Eight';words[9] = 'Nine';words[10] = 'Ten';words[11] = 'Eleven';words[12] = 'Twelve';words[13] = 'Thirteen';words[14] = 'Fourteen';words[15] = 'Fifteen';words[16] = 'Sixteen';words[17] = 'Seventeen';words[18] = 'Eighteen';words[19] = 'Nineteen';words[20] = 'Twenty';words[30] = 'Thirty';words[40] = 'Forty';words[50] = 'Fifty';words[60] = 'Sixty';words[70] = 'Seventy';words[80] = 'Eighty';words[90] = 'Ninety';var op;
amount = amount.toString();
var atemp = amount.split('.');
var number = atemp[0].split(',').join('');
var n_length = number.length;
var words_string = '';
if(n_length <= 9){
var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
var received_n_array = new Array();
for (var i = 0; i < n_length; i++){
received_n_array[i] = number.substr(i, 1);}
for (var i = 9 - n_length, j = 0; i < 9; i++, j++){
n_array[i] = received_n_array[j];}
for (var i = 0, j = 1; i < 9; i++, j++){
if(i == 0 || i == 2 || i == 4 || i == 7){
if(n_array[i] == 1){
n_array[j] = 10 + parseInt(n_array[j]);
n_array[i] = 0;}}}
value = '';
for (var i = 0; i < 9; i++){
if(i == 0 || i == 2 || i == 4 || i == 7){
value = n_array[i] * 10;} else {
value = n_array[i];}
if(value != 0){
words_string += words[value] + ' ';}
if((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Crores ';}
if((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Lakhs ';}
if((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Thousand ';}
if(i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)){
words_string += 'Hundred and ';} else if(i == 6 && value != 0){
words_string += 'Hundred ';}}
words_string = words_string.split(' ').join(' ');}
return words_string;}

function RsPaise(n){
nums = n.toString().split('.')
var whole = Rs(nums[0])
if(nums[1]==null)nums[1]=0;
if(nums[1].length == 1 )nums[1]=nums[1]+'0';
if(nums[1].length> 2){nums[1]=nums[1].substring(2,length - 1)}
if(nums.length == 2){
if(nums[0]<=9){nums[0]=nums[0]*10} else {nums[0]=nums[0]};
var fraction = Rs(nums[1])
if(whole=='' && fraction==''){op= 'Zero only';}
if(whole=='' && fraction!=''){op= 'paise ' + fraction + ' only';}
if(whole!='' && fraction==''){op='Rupees ' + whole + ' only';} 
if(whole!='' && fraction!=''){op='Rupees ' + whole + 'and paise ' + fraction + ' only';}
amt=n;
if(amt > 999999999.99){op='Oops!!! The amount is too big to convert';}
if(isNaN(amt) == true ){op='Error : Amount in number appears to be incorrect. Please Check.';}
document.getElementById('grandwords').innerHTML="<hr>"+op;}}
RsPaise(0);
</script>




</body>
</html>