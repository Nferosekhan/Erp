<?php
include('lcheck.php');
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Reports' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($franchisesrole==''))||((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['groupaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['groupaccess']=='0')||($infomainaccessuser['useraccessview']==0))))) {
header('Location:dashboard.php');
}
$sqlismainaccessreportlist=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and grouptype='Reports' order by id  asc");
while($infomainaccessreportlists=mysqli_fetch_array($sqlismainaccessreportlist)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessreportlists['moduletype']);
    $lists = $infomainaccessreportlists[24];
    $listings = explode(',',$lists);
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
  <title>
    <?= $infomainaccessuser['groupname']; ?>
  </title>
<style>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 991px){
    .reportsdesign{
        margin-top: 16px !important;
    }
}
@media screen and (max-width: 600px) 
{
  .add{
    position: relative;
    top: 36px; 
  }
  table {
    border: 0;
    margin-top: 30px;
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Reports' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
?>
<div style="max-width: 1650px;">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<div class="row">
<div class="col-lg-9"> 
<p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> <i class="fa fa-pie-chart" aria-hidden="true"></i> <?= $infomainaccessuser['groupname']; ?></p>
</div>
<div class="col-lg-3 mb-3">
<select class="select4 form-control form-control-sm" onchange="customerchange(this)" id="customers" name="customers">
<!-- <?php
$sql=mysqli_query($con, "select distinct customername from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' order by id asc");
while($infopro=mysqli_fetch_array($sql))
{
?>
<option value="<?=$infopro['customername']?>"><?=$infopro['customername']?></option>
<?php
}
?> -->
<option>Select</option>
<script type="text/javascript">
function customerchange(anscustname) {
customernames = anscustname.value;
// alert(customernames);
document.getElementById('hiddencustname').value = customernames;
}
$(document).ready(function() {
customernames = document.getElementById('customers').value;
// alert(customernames);
document.getElementById('hiddencustname').value = customernames;
});
function favouritehrbalancepaylist() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=hrbalance&url='+$("#hrbalanceurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritehrbalancepaylist').style.display="none";
document.getElementById('nofavouritehrbalancepaylist').style.display="inline";
}
function nofavouritehrbalancepaylist() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=hrbalance&url='+$("#hrbalanceurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritehrbalancepaylist').style.display="none";
document.getElementById('favouritehrbalancepaylist').style.display="inline";
}
function favouritehrpandlpaylist() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=hrpandl&url='+$("#hrpandlurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritehrpandlpaylist').style.display="none";
document.getElementById('nofavouritehrpandlpaylist').style.display="inline";
}
function nofavouritehrpandlpaylist() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=hrpandl&url='+$("#hrpandlurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritehrpandlpaylist').style.display="none";
document.getElementById('favouritehrpandlpaylist').style.display="inline";
}
function favouriteacctranspaylist() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=acctrans&url='+$("#acctransurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouriteacctranspaylist').style.display="none";
document.getElementById('nofavouriteacctranspaylist').style.display="inline";
}
function nofavouriteacctranspaylist() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=acctrans&url='+$("#acctransurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouriteacctranspaylist').style.display="none";
document.getElementById('favouriteacctranspaylist').style.display="inline";
}
function favouriteinvreceivelist() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=invlist&url='+$("#invurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouriteinvreceivelist').style.display="none";
document.getElementById('nofavouriteinvreceivelist').style.display="inline";
}
function nofavouriteinvreceivelist() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=invlist&url='+$("#invurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouriteinvreceivelist').style.display="none";
document.getElementById('favouriteinvreceivelist').style.display="inline";
}
function favouritebillpaylist() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=billlist&url='+$("#billurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritebillpaylist').style.display="none";
document.getElementById('nofavouritebillpaylist').style.display="inline";
}
function nofavouritebillpaylist() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=billlist&url='+$("#billurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritebillpaylist').style.display="none";
document.getElementById('favouritebillpaylist').style.display="inline";
}
function favouritetaxinward() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=inward&url='+$("#inwardurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritetaxinward').style.display="none";
document.getElementById('nofavouritetaxinward').style.display="inline";
}
function nofavouritetaxinward() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=inward&url='+$("#inwardurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritetaxinward').style.display="none";
document.getElementById('favouritetaxinward').style.display="inline";
}
function favouritetaxoutward() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=outward&url='+$("#outwardurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritetaxoutward').style.display="none";
document.getElementById('nofavouritetaxoutward').style.display="inline";
}
function nofavouritetaxoutward() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=outward&url='+$("#outwardurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritetaxoutward').style.display="none";
document.getElementById('favouritetaxoutward').style.display="inline";
}
function favouritecrnote() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=crnote&url='+$("#crnotesurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritecrnote').style.display="none";
document.getElementById('nofavouritecrnote').style.display="inline";
}
function nofavouritecrnote() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=crnote&url='+$("#crnotesurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritecrnote').style.display="none";
document.getElementById('favouritecrnote').style.display="inline";
}
function favouritedrnote() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=drnote&url='+$("#drnotesurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritedrnote').style.display="none";
document.getElementById('nofavouritedrnote').style.display="inline";
}
function nofavouritedrnote() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=drnote&url='+$("#drnotesurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritedrnote').style.display="none";
document.getElementById('favouritedrnote').style.display="inline";
}
function favouritesales() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=sales&url='+$("#salesurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritesales').style.display="none";
document.getElementById('nofavouritesales').style.display="inline";
}
function nofavouritesales() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=sales&url='+$("#salesurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritesales').style.display="none";
document.getElementById('favouritesales').style.display="inline";
}
function favouriteprosalecus() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=prosalecus&url='+$("#prosalecusurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouriteprosalecus').style.display="none";
document.getElementById('nofavouriteprosalecus').style.display="inline";
}
function nofavouriteprosalecus() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=prosalecus&url='+$("#prosalecusurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouriteprosalecus').style.display="none";
document.getElementById('favouriteprosalecus').style.display="inline";
}
function favouritepromovement() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=promovement&url='+$("#promovementurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritepromovement').style.display="none";
document.getElementById('nofavouritepromovement').style.display="inline";
}
function nofavouritepromovement() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=promovement&url='+$("#promovementurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritepromovement').style.display="none";
document.getElementById('favouritepromovement').style.display="inline";
}
function favouritesalesperson() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=salesperson&url='+$("#salespersonurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritesalesperson').style.display="none";
document.getElementById('nofavouritesalesperson').style.display="inline";
}
function nofavouritesalesperson() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=salesperson&url='+$("#salespersonurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritesalesperson').style.display="none";
document.getElementById('favouritesalesperson').style.display="inline";
}
function favouritesalesprofitloss() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=salesprofitloss&url='+$("#salesprofitlossurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritesalesprofitloss').style.display="none";
document.getElementById('nofavouritesalesprofitloss').style.display="inline";
}
function nofavouritesalesprofitloss() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=salesprofitloss&url='+$("#salesprofitlossurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritesalesprofitloss').style.display="none";
document.getElementById('favouritesalesprofitloss').style.display="inline";
}
function favouritestockandsales() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=stockandsales&url='+$("#stockandsalesurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritestockandsales').style.display="none";
document.getElementById('nofavouritestockandsales').style.display="inline";
}
function nofavouritestockandsales() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=stockandsales&url='+$("#stockandsalesurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritestockandsales').style.display="none";
document.getElementById('favouritestockandsales').style.display="inline";
}
function favouritestockandsalesnew() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=stockandsalesnew&url='+$("#stockandsalesnewurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritestockandsalesnew').style.display="none";
document.getElementById('nofavouritestockandsalesnew').style.display="inline";
}
function nofavouritestockandsalesnew() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=stockandsalesnew&url='+$("#stockandsalesnewurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritestockandsalesnew').style.display="none";
document.getElementById('favouritestockandsalesnew').style.display="inline";
}
function favouritestockinhandwithvalue() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=stockinhandwithvalue&url='+$("#stockinhandwithvalueurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritestockinhandwithvalue').style.display="none";
document.getElementById('nofavouritestockinhandwithvalue').style.display="inline";
}
function nofavouritestockinhandwithvalue() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=stockinhandwithvalue&url='+$("#stockinhandwithvalueurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritestockinhandwithvalue').style.display="none";
document.getElementById('favouritestockinhandwithvalue').style.display="inline";
}
function favouritecustbalance() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=cust&url='+$("#custurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritecustbalance').style.display="none";
document.getElementById('nofavouritecustbalance').style.display="inline";
}
function nofavouritecustbalance() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=cust&url='+$("#custurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritecustbalance').style.display="none";
document.getElementById('favouritecustbalance').style.display="inline";
}
function favouritejournal() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=journal&url='+$("#journalurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritejournal').style.display="none";
document.getElementById('nofavouritejournal').style.display="inline";
}
function nofavouritejournal() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=journal&url='+$("#journalurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritejournal').style.display="none";
document.getElementById('favouritejournal').style.display="inline";
}
function favouriteaccounttrans() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=accounttrans&url='+$("#accounttransurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouriteaccounttrans').style.display="none";
document.getElementById('nofavouriteaccounttrans').style.display="inline";
}
function nofavouriteaccounttrans() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=accounttrans&url='+$("#accounttransurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouriteaccounttrans').style.display="none";
document.getElementById('favouriteaccounttrans').style.display="inline";
}
function favouritepayreceive() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=payreceive&url='+$("#payreceiveurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritepayreceive').style.display="none";
document.getElementById('nofavouritepayreceive').style.display="inline";
}
function nofavouritepayreceive() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=payreceive&url='+$("#payreceiveurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritepayreceive').style.display="none";
document.getElementById('favouritepayreceive').style.display="inline";
}
function favouritepaymade() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=paymade&url='+$("#paymadeurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritepaymade').style.display="none";
document.getElementById('nofavouritepaymade').style.display="inline";
}
function nofavouritepaymade() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=paymade&url='+$("#paymadeurl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritepaymade').style.display="none";
document.getElementById('favouritepaymade').style.display="inline";
}
function favouritetimesheet() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=0&reportnames=timesheet&url='+$("#timesheeturl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('favouritetimesheet').style.display="none";
document.getElementById('nofavouritetimesheet').style.display="inline";
}
function nofavouritetimesheet() {
$.ajax({
type: "GET",
url: 'favouriteadder.php?reportstatus=1&reportnames=timesheet&url='+$("#timesheeturl").val()+'',
success: function (result) {
console.log(result);
$(".favinsides").html(result);
if (result!='') {
document.getElementById("favheader").style.display = 'block';
document.getElementById("favtopheader").style.display = 'block';
}
else{
document.getElementById("favheader").style.display = 'none';
document.getElementById("favtopheader").style.display = 'none';
}
},
error: function (error) {
console.log(error);
}
});
document.getElementById('nofavouritetimesheet').style.display="none";
document.getElementById('favouritetimesheet').style.display="inline";
}
</script>
<input type="hidden" name="hiddencustname" id="hiddencustname">
</select> 
</div>
<?php
$sqlfavourites = mysqli_query($con,"select * from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportstatus='1'");
$sqlfavouritesheader = mysqli_query($con,"select * from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportstatus='1'");
$headershowhide = 0;
while($fetfavouritesheader = mysqli_fetch_array($sqlfavouritesheader)){
if (in_array(str_replace("/", " or ",(str_replace($resmaincurrencyans, "Rupee",(str_replace("(", 'opparen',(str_replace(")", 'closparen',(str_replace("%", 'Percentage',(str_replace("-", " hypens ",$fetfavouritesheader['reportoriginals']))))))))))), $listings)) {
$headershowhide += 1;
}
else{
$headershowhide -= 1;
}
}
?>
<div id="favtopheader" style="<?=(($headershowhide>0)?'':'display:none;')?>">
<div id="favheader" style="<?=((mysqli_num_rows($sqlfavourites)>0)?'display: block;':'display: none;')?>">
<h4 style="font-weight: 400;font-size: 1.3rem;line-height: 1.1;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon lpanel" style="height: 16px;width: 16px;margin-top: -5px;"><path d="M427.8.8c-1.7-.1-3.3-.2-5 0H89.5C85.4.3 81.2.3 77.1.8 62 5.3 51.9 19.6 52.5 35.3V476c-.6 13.1 6.4 25.5 18 31.8 11.7 6.3 26.1 4.8 36.3-3.8l136.1-99.1c7.5-6.5 18.7-6.5 26.2 0l15.2 11.1 121.6 88.4c5.8 4.8 13.2 7.2 20.7 6.9 18.4-.9 32.8-16.1 32.8-34.5V38.1c1.5-19-12.6-35.7-31.6-37.3zm-74.1 196.1C343.3 207.3 333.3 218 323 228c-4.1 3.6-5.8 9.2-4.5 14.5 2.8 15 5.3 29.9 7.6 44.9.3 1.6.3 3.2.1 4.9-1.1 9.1-9.3 15.6-18.4 14.5-2.7-.6-5.3-1.6-7.6-3.1-13.1-6.9-25.9-14.5-39-21.1a9.33 9.33 0 00-8.6 0c-14.2 7.3-28 15.5-42.1 22.8-3 1.7-6.4 2.3-9.8 1.8-8.1-1.3-13.6-8.9-12.3-17 2.4-15.5 4.8-33.2 7.9-50.1.8-3.2-.3-6.5-2.8-8.6L161.7 197c-5.3-4.8-7.5-12.1-5.5-19 2-6.4 7.8-10.8 14.5-11.1l43.5-6.2c3.9-.2 7.3-2.6 8.6-6.2l19-40.4c2.4-6.9 8.9-11.6 16.2-11.7 7.6 0 11.4 5.2 14.5 11.4 6.2 13.5 12.8 26.6 18.6 40.1 1.4 4.6 5.6 7.7 10.4 7.9l42.5 5.9c6.7.3 12.5 4.7 14.5 11.1 2.3 6.4.4 13.6-4.8 18.1z"></path></svg> My Favorites</h4>
</div>
</div>
<div class="row favinsides">
<?php
if (mysqli_num_rows($sqlfavourites)>0) {
while($fetfavourites = mysqli_fetch_array($sqlfavourites)){
?>
<div class="col-lg-3" style="<?=((in_array(str_replace("/", " or ",(str_replace($resmaincurrencyans, "Rupee",(str_replace("(", 'opparen',(str_replace(")", 'closparen',(str_replace("%", 'Percentage',(str_replace("-", " hypens ",$fetfavourites['reportoriginals']))))))))))), $listings))?'':'display:none;')?>">
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;">
<span onclick="<?=$fetfavourites['reportfunctions']?>()">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span onclick="window.open('<?=$fetfavourites['reporthref']?>','_self')"><?=$fetfavourites['reportoriginals']?> 
<svg data-toggle="tooltip" title="Invoices Ordered by Date" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
</div>
<?php
}
}
?>
</div>

<div class="row">

<?php
$sqlhrbalanceview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='hrbalance' and createdid='$companymainid'");
$sqlhrbalancereport = mysqli_fetch_array($sqlhrbalanceview);
$sqlfavouritehrbalance=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='hrbalance'");
$fetfavouritehrbalance = mysqli_fetch_array($sqlfavouritehrbalance);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlhrbalancereport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatehrbalance = formatDateSwitch(startDate);
  var enddatehrbalance = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<div class="col-lg-3" style="<?=((in_array('Business Overview', $listings))?'':'display:none;')?>">
<p style="font-size: 16px !important;">Business Overview</p>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Horizontal Balance Sheet', $listings))?'':'display:none;')?>">
<span id="favouritehrbalancepaylist" onclick="favouritehrbalancepaylist()" style="<?=(($fetfavouritehrbalance['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritehrbalancepaylist" onclick="nofavouritehrbalancepaylist()" style="<?=(($fetfavouritehrbalance['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritehrbalance['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatehrbalancefav = formatDateSwitch(startDate);
  var enddatehrbalancefav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#hrbalanceurl").val('reporthrbalanceviews.php?datefrom='+startdatehrbalancefav+'|-|dateto='+enddatehrbalancefav+'');
});
</script>
<input type="text" id="hrbalanceurl" style="display: none;">
<span onclick="window.open('reporthrbalanceviews.php?datefrom='+startdatehrbalance+'&dateto='+enddatehrbalance+'','_self')">Horizontal Balance Sheet 
<svg data-toggle="tooltip" title="Horizontal Balance Sheet" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>

<?php
$sqlhrpandlview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='hrpandl' and createdid='$companymainid'");
$sqlhrpandlreport = mysqli_fetch_array($sqlhrpandlview);
$sqlfavouritehrpandl=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='hrpandl'");
$fetfavouritehrpandl = mysqli_fetch_array($sqlfavouritehrpandl);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlhrpandlreport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatehrpandl = formatDateSwitch(startDate);
  var enddatehrpandl = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Horizontal Profit and Loss', $listings))?'':'display:none;')?>">
<span id="favouritehrpandlpaylist" onclick="favouritehrpandlpaylist()" style="<?=(($fetfavouritehrpandl['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritehrpandlpaylist" onclick="nofavouritehrpandlpaylist()" style="<?=(($fetfavouritehrpandl['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritehrpandl['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatehrpandlfav = formatDateSwitch(startDate);
  var enddatehrpandlfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#hrpandlurl").val('reporthrpandlviews.php?datefrom='+startdatehrpandlfav+'|-|dateto='+enddatehrpandlfav+'');
});
</script>
<input type="text" id="hrpandlurl" style="display: none;">
<span onclick="window.open('reporthrpandlviews.php?datefrom='+startdatehrpandl+'&dateto='+enddatehrpandl+'','_self')">Horizontal Profit and Loss 
<svg data-toggle="tooltip" title="Horizontal Profit and Loss" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>

<?php
$sqlacctransview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='acctrans' and createdid='$companymainid'");
$sqlacctransreport = mysqli_fetch_array($sqlacctransview);
$sqlfavouriteacctrans=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='acctrans'");
$fetfavouriteacctrans = mysqli_fetch_array($sqlfavouriteacctrans);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlacctransreport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateacctrans = formatDateSwitch(startDate);
  var enddateacctrans = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Account Transactions', $listings))?'':'display:none;')?>">
<span id="favouriteacctranspaylist" onclick="favouriteacctranspaylist()" style="<?=(($fetfavouriteacctrans['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouriteacctranspaylist" onclick="nofavouriteacctranspaylist()" style="<?=(($fetfavouriteacctrans['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouriteacctrans['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateacctransfav = formatDateSwitch(startDate);
  var enddateacctransfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#acctransurl").val('reportacctransviews.php?datefrom='+startdateacctransfav+'|-|dateto='+enddateacctransfav+'');
});
</script>
<input type="text" id="acctransurl" style="display: none;">
<span onclick="window.open('reportacctransviews.php?datefrom='+startdateacctrans+'&dateto='+enddateacctrans+'','_self')">Account Transactions 
<svg data-toggle="tooltip" title="Account Transactions" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>

</div>

<?php
$sqlinvview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='inv' and createdid='$companymainid'");
$sqlinvport = mysqli_fetch_array($sqlinvview);
$sqlfavouriteinv=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='invlist'");
$fetfavouriteinv = mysqli_fetch_array($sqlfavouriteinv);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlinvport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateinv = formatDateSwitch(startDate);
  var enddateinv = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>

<div class="col-lg-3" style="<?=((in_array('Receivables or Who owes you', $listings))?'':'display:none;')?>">
<p style="font-size: 16px !important;">Receivables/Who owes you</p>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Invoice List or Details', $listings))?'':'display:none;')?>">
<span id="favouriteinvreceivelist" onclick="favouriteinvreceivelist()" style="<?=(($fetfavouriteinv['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouriteinvreceivelist" onclick="nofavouriteinvreceivelist()" style="<?=(($fetfavouriteinv['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouriteinv['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateinvfav = formatDateSwitch(startDate);
  var enddateinvfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#invurl").val('reportviews.php?amttype=all|-|names=<?=$sqlinvport['names']?>|-|datefrom='+startdateinvfav+'|-|dateto='+enddateinvfav+'|-|timefrom=00:00:00|-|timeto=23:59:59|-|payterm=<?=$sqlinvport['payterm']?>');
});
</script>
<input type="text" id="invurl" style="display: none;">
<span onclick="window.open('reportviews.php?amttype=all&names=<?=$sqlinvport['names']?>&datefrom='+startdateinv+'&dateto='+enddateinv+'&timefrom=00:00:00&timeto=23:59:59&payterm=<?=$sqlinvport['payterm']?>','_self')">Invoice List/Details 
<svg data-toggle="tooltip" title="Invoices Ordered by Date" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlpayreceiveview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='payreceive' and createdid='$companymainid'");
$sqlpayreceiveport = mysqli_fetch_array($sqlpayreceiveview);
$sqlfavouritepayreceive=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='payreceive'");
$fetfavouritepayreceive = mysqli_fetch_array($sqlfavouritepayreceive);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlpayreceiveport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatepayreceive = formatDateSwitch(startDate);
  var enddatepayreceive = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Payments Received', $listings))?'':'display:none;')?>">
<span id="favouritepayreceive" onclick="favouritepayreceive()" style="<?=(($fetfavouritepayreceive['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritepayreceive" onclick="nofavouritepayreceive()" style="<?=(($fetfavouritepayreceive['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritepayreceive['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatepayreceivefav = formatDateSwitch(startDate);
  var enddatepayreceivefav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#payreceiveurl").val('reportpayreceive.php?names=<?=$sqlpayreceiveport['names']?>|-|datefrom='+startdatepayreceivefav+'|-|dateto='+enddatepayreceivefav+'|-|timefrom=00:00:00|-|timeto=23:59:59|-|payterm=<?=$sqlpayreceiveport['payterm']?>');
});
</script>
<input type="text" id="payreceiveurl" style="display: none;">
<span onclick="window.open('reportpayreceive.php?names=<?=$sqlpayreceiveport['names']?>&datefrom='+startdatepayreceive+'&dateto='+enddatepayreceive+'&timefrom=00:00:00&timeto=23:59:59&payterm=<?=$sqlpayreceiveport['payterm']?>','_self')">Payments Received 
<svg data-toggle="tooltip" title="Payments Received" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
</div>

<?php
$sqlbillview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='bill' and createdid='$companymainid'");
$sqlbillport = mysqli_fetch_array($sqlbillview);
$sqlfavouritebill=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='billlist'");
$fetfavouritebill = mysqli_fetch_array($sqlfavouritebill);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlbillport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatebill = formatDateSwitch(startDate);
  var enddatebill = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<div class="col-lg-3" style="<?=((in_array('Payables or What you owe', $listings))?'':'display:none;')?>">
<p style="font-size: 16px !important;">Payables/What you owe</p>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Bills List or Details', $listings))?'':'display:none;')?>">
<span id="favouritebillpaylist" onclick="favouritebillpaylist()" style="<?=(($fetfavouritebill['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritebillpaylist" onclick="nofavouritebillpaylist()" style="<?=(($fetfavouritebill['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritebill['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatebillfav = formatDateSwitch(startDate);
  var enddatebillfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#billurl").val('reportbillviews.php?amttype=all|-|names=<?=$sqlbillport['names']?>|-|datefrom='+startdatebillfav+'|-|dateto='+enddatebillfav+'|-|payterm=<?=$sqlbillport['payterm']?>');
});
</script>
<input type="text" id="billurl" style="display: none;">
<span onclick="window.open('reportbillviews.php?amttype=all&names=<?=$sqlbillport['names']?>&datefrom='+startdatebill+'&dateto='+enddatebill+'&payterm=<?=$sqlbillport['payterm']?>','_self')">Bill List/Details 
<svg data-toggle="tooltip" title="Bills Ordered by Date" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlpaymadeview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='paymade' and createdid='$companymainid'");
$sqlpaymadeport = mysqli_fetch_array($sqlpaymadeview);
$sqlfavouritepaymade=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='paymade'");
$fetfavouritepaymade = mysqli_fetch_array($sqlfavouritepaymade);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlpaymadeport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatepaymade = formatDateSwitch(startDate);
  var enddatepaymade = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Payments Made', $listings))?'':'display:none;')?>">
<span id="favouritepaymade" onclick="favouritepaymade()" style="<?=(($fetfavouritepaymade['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritepaymade" onclick="nofavouritepaymade()" style="<?=(($fetfavouritepaymade['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritepaymade['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatepaymadefav = formatDateSwitch(startDate);
  var enddatepaymadefav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#paymadeurl").val('reportpaymade.php?names=<?=$sqlpaymadeport['names']?>|-|datefrom='+startdatepaymadefav+'|-|dateto='+enddatepaymadefav+'|-|timefrom=00:00:00|-|timeto=23:59:59|-|payterm=<?=$sqlpaymadeport['payterm']?>');
});
</script>
<input type="text" id="paymadeurl" style="display: none;">
<span onclick="window.open('reportpaymade.php?names=<?=$sqlpaymadeport['names']?>&datefrom='+startdatepaymade+'&dateto='+enddatepaymade+'&timefrom=00:00:00&timeto=23:59:59&payterm=<?=$sqlpaymadeport['payterm']?>','_self')">Payments Made 
<svg data-toggle="tooltip" title="Payments Made" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
</div>

<?php
$sqlinwview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='inw' and createdid='$companymainid'");
$sqlinwport = mysqli_fetch_array($sqlinwview);
$sqlfavouriteinward=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='inward'");
$fetfavouriteinward = mysqli_fetch_array($sqlfavouriteinward);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlinwport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateinw = formatDateSwitch(startDate);
  var enddateinw = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<div class="col-lg-3" style="<?=((in_array('Taxes', $listings))?'':'display:none;')?>">
<p style="font-size: 16px !important;">Taxes</p>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Summary of Inward Supplies opparen GSTR hypens 2 closparen', $listings))?'':'display:none;')?>">
<span id="favouritetaxinward" onclick="favouritetaxinward()" style="<?=(($fetfavouriteinward['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritetaxinward" onclick="nofavouritetaxinward()" style="<?=(($fetfavouriteinward['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouriteinward['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateinwardfav = formatDateSwitch(startDate);
  var enddateinwardfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#inwardurl").val('inwardreport.php?datefrom='+startdateinwardfav+'|-|dateto='+enddateinwardfav+'');
});
</script>
<input type="text" id="inwardurl" style="display: none;">
<span onclick="window.open('inwardreport.php?datefrom='+startdateinw+'&dateto='+enddateinw+'','_self')">Summary of Inward Supplies  (GSTR-2) 
<svg data-toggle="tooltip" title="Your bills, ordered by date" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlouwview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='ouw' and createdid='$companymainid'");
$sqlouwport = mysqli_fetch_array($sqlouwview);
$sqlfavouriteoutward=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='outward'");
$fetfavouriteoutward = mysqli_fetch_array($sqlfavouriteoutward);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlouwport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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
      // Default to "Today" String(endDate.setDate(0)).padStart(2, '0');
      break;
  }

  var startdateouw = formatDateSwitch(startDate);
  var enddateouw = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Summary of Outward Supplies opparen GSTR hypens 1 closparen', $listings))?'':'display:none;')?>">
<span id="favouritetaxoutward" onclick="favouritetaxoutward()" style="<?=(($fetfavouriteoutward['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritetaxoutward" onclick="nofavouritetaxoutward()" style="<?=(($fetfavouriteoutward['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouriteoutward['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateoutwardfav = formatDateSwitch(startDate);
  var enddateoutwardfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#outwardurl").val('outwardreport.php?datefrom='+startdateoutwardfav+'|-|dateto='+enddateoutwardfav+'');
});
</script>
<input type="text" id="outwardurl" style="display: none;">
<span onclick="window.open('outwardreport.php?datefrom='+startdateouw+'&dateto='+enddateouw+'','_self')">Summary of Outward Supplies (GSTR-1) 
<svg data-toggle="tooltip" title="Your invoices, ordered by date" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlcrnoteview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='crnote' and createdid='$companymainid'");
$sqlcrnoteport = mysqli_fetch_array($sqlcrnoteview);
$sqlfavouritecrnotes=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='crnote'");
$fetfavouritecrnotes = mysqli_fetch_array($sqlfavouritecrnotes);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlcrnoteport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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
      // Default to "Today" String(endDate.setDate(0)).padStart(2, '0');
      break;
  }

  var startdatecrnote = formatDateSwitch(startDate);
  var enddatecrnote = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Summary of Credit Note', $listings))?'':'display:none;')?>">
<span id="favouritecrnote" onclick="favouritecrnote()" style="<?=(($fetfavouritecrnotes['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritecrnote" onclick="nofavouritecrnote()" style="<?=(($fetfavouritecrnotes['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritecrnotes['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatecrnotesfav = formatDateSwitch(startDate);
  var enddatecrnotesfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#crnotesurl").val('reportcrnote.php?datefrom='+startdatecrnotesfav+'|-|dateto='+enddatecrnotesfav+'');
});
</script>
<input type="text" id="crnotesurl" style="display: none;">
<span onclick="window.open('reportcrnote.php?datefrom='+startdatecrnote+'&dateto='+enddatecrnote+'','_self')">Summary of Credit Note 
<svg data-toggle="tooltip" title="Your Credit Notes, ordered by date" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqldrnoteview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='drnote' and createdid='$companymainid'");
$sqldrnoteport = mysqli_fetch_array($sqldrnoteview);
$sqlfavouritedrnotes=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='drnote'");
$fetfavouritedrnotes = mysqli_fetch_array($sqlfavouritedrnotes);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqldrnoteport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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
      // Default to "Today" String(endDate.setDate(0)).padStart(2, '0');
      break;
  }

  var startdatedrnote = formatDateSwitch(startDate);
  var enddatedrnote = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Summary of Debit Note', $listings))?'':'display:none;')?>">
<span id="favouritedrnote" onclick="favouritedrnote()" style="<?=(($fetfavouritedrnotes['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritedrnote" onclick="nofavouritedrnote()" style="<?=(($fetfavouritedrnotes['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritedrnotes['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatedrnotesfav = formatDateSwitch(startDate);
  var enddatedrnotesfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#drnotesurl").val('reportdrnote.php?datefrom='+startdatedrnotesfav+'|-|dateto='+enddatedrnotesfav+'');
});
</script>
<input type="text" id="drnotesurl" style="display: none;">
<span onclick="window.open('reportdrnote.php?datefrom='+startdatedrnote+'&dateto='+enddatedrnote+'','_self')">Summary of Debit Note 
<svg data-toggle="tooltip" title="Your Debit Notes, ordered by date" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
</div>

<?php
$sqlsalesview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='sales' and createdid='$companymainid'");
$sqlsalesport = mysqli_fetch_array($sqlsalesview);
$sqlfavouritesales=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='sales'");
$fetfavouritesales = mysqli_fetch_array($sqlfavouritesales);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlsalesport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatesales = formatDateSwitch(startDate);
  var enddatesales = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<div class="col-lg-3" style="<?=((in_array('Sales Details', $listings))?'':'display:none;')?>">
<p style="font-size: 16px !important;">Sales Details</p>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Sales', $listings))?'':'display:none;')?>">
<span id="favouritesales" onclick="favouritesales()" style="<?=(($fetfavouritesales['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritesales" onclick="nofavouritesales()" style="<?=(($fetfavouritesales['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritesales['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatesalesfav = formatDateSwitch(startDate);
  var enddatesalesfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#salesurl").val('reportsales.php?datefrom='+startdatesalesfav+'|-|dateto='+enddatesalesfav+'|-|timefrom=00:00:00|-|timeto=23:59:59|-|payterm=<?=$sqlsalesport['payterm']?>');
});
</script>
<input type="text" id="salesurl" style="display: none;">
<span onclick="window.open('reportsales.php?datefrom='+startdatesales+'&dateto='+enddatesales+'&timefrom=00:00:00&timeto=23:59:59&payterm=<?=$sqlsalesport['payterm']?>','_self')">Sales 
<svg data-toggle="tooltip" title="Your invoices, ordered by date" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlprosalecusview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='prosalecus' and createdid='$companymainid'");
$sqlprosalecusport = mysqli_fetch_array($sqlprosalecusview);
$sqlfavouriteprosalecus=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='prosalecus'");
$fetfavouriteprosalecus = mysqli_fetch_array($sqlfavouriteprosalecus);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlprosalecusport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateprosalecus = formatDateSwitch(startDate);
  var enddateprosalecus = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Product Customer Wise Sales', $listings))?'':'display:none;')?>">
<span id="favouriteprosalecus" onclick="favouriteprosalecus()" style="<?=(($fetfavouriteprosalecus['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouriteprosalecus" onclick="nofavouriteprosalecus()" style="<?=(($fetfavouriteprosalecus['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouriteprosalecus['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateprosalecusfav = formatDateSwitch(startDate);
  var enddateprosalecusfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#prosalecusurl").val('reportprosalecus.php?commision=<?=$sqlprosalecusport['commision']?>|-|category=<?=$sqlprosalecusport['category']?>|-|names=<?=$sqlprosalecusport['names']?>|-|datefrom='+startdateprosalecusfav+'|-|dateto='+enddateprosalecusfav+'');
});
</script>
<input type="text" id="prosalecusurl" style="display: none;">
<span onclick="window.open('reportprosalecus.php?commision=<?=$sqlprosalecusport['commision']?>&category=<?=$sqlprosalecusport['category']?>&names=<?=$sqlprosalecusport['names']?>&datefrom='+startdateprosalecus+'&dateto='+enddateprosalecus+'','_self')">Product Customer Wise Sales 
<svg data-toggle="tooltip" title="Product Customer Wise Sales" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlpromovement = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='promovement' and createdid='$companymainid'");
$sqlpromovementreport = mysqli_fetch_array($sqlpromovement);
$sqlfavouritepromovement=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='promovement'");
$fetfavouritepromovement = mysqli_fetch_array($sqlfavouritepromovement);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlpromovementreport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatepromovement = formatDateSwitch(startDate);
  var enddatepromovement = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Product Movement', $listings))?'':'display:none;')?>">
<span id="favouritepromovement" onclick="favouritepromovement()" style="<?=(($fetfavouritepromovement['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritepromovement" onclick="nofavouritepromovement()" style="<?=(($fetfavouritepromovement['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritepromovement['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatepromovementfav = formatDateSwitch(startDate);
  var enddatepromovementfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#promovementurl").val('reportpromovement.php?datefrom='+startdatepromovementfav+'|-|dateto='+enddatepromovementfav+'|-|proid=<?=$sqlpromovementreport['proid']?>');
});
</script>
<input type="text" id="promovementurl" style="display: none;">
<span onclick="window.open('reportpromovement.php?datefrom='+startdatepromovement+'&dateto='+enddatepromovement+'&proid=<?=$sqlpromovementreport['proid']?>','_self')">Product Movement 
<svg data-toggle="tooltip" title="Product Movement" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlsalesperson = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='salesperson' and createdid='$companymainid'");
$sqlsalespersonreport = mysqli_fetch_array($sqlsalesperson);
$sqlfavouritesalesperson=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='salesperson'");
$fetfavouritesalesperson = mysqli_fetch_array($sqlfavouritesalesperson);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlsalespersonreport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatesalesperson = formatDateSwitch(startDate);
  var enddatesalesperson = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Sales Person', $listings))?'':'display:none;')?>">
<span id="favouritesalesperson" onclick="favouritesalesperson()" style="<?=(($fetfavouritesalesperson['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritesalesperson" onclick="nofavouritesalesperson()" style="<?=(($fetfavouritesalesperson['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritesalesperson['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatesalespersonfav = formatDateSwitch(startDate);
  var enddatesalespersonfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#salespersonurl").val('reportsalesperson.php?datefrom='+startdatesalespersonfav+'|-|dateto='+enddatesalespersonfav+'|-|preparedby=<?=$sqlsalespersonreport['preparedby']?>|-|checkedby=<?=$sqlsalespersonreport['checkedby']?>');
});
</script>
<input type="text" id="salespersonurl" style="display: none;">
<span onclick="window.open('reportsalesperson.php?datefrom='+startdatesalesperson+'&dateto='+enddatesalesperson+'&preparedby=<?=$sqlsalespersonreport['preparedby']?>&checkedby=<?=$sqlsalespersonreport['checkedby']?>','_self')">Sales Person 
<svg data-toggle="tooltip" title="Sales Person" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlsalesprofitloss = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='salesprofitloss' and createdid='$companymainid'");
$sqlsalesprofitlossreport = mysqli_fetch_array($sqlsalesprofitloss);
$sqlfavouritesalesprofitloss=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='salesprofitloss'");
$fetfavouritesalesprofitloss = mysqli_fetch_array($sqlfavouritesalesprofitloss);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlsalesprofitlossreport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatesalesprofitloss = formatDateSwitch(startDate);
  var enddatesalesprofitloss = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Profit And Loss', $listings))?'':'display:none;')?>">
<span id="favouritesalesprofitloss" onclick="favouritesalesprofitloss()" style="<?=(($fetfavouritesalesprofitloss['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritesalesprofitloss" onclick="nofavouritesalesprofitloss()" style="<?=(($fetfavouritesalesprofitloss['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritesalesprofitloss['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatesalesprofitlossfav = formatDateSwitch(startDate);
  var enddatesalesprofitlossfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#salesprofitlossurl").val('reportsalesprofitloss.php?datefrom='+startdatesalesprofitlossfav+'|-|dateto='+enddatesalesprofitlossfav+'|-|proid=<?=$sqlsalesprofitlossreport['proid']?>|-|modules=<?=$sqlsalesprofitlossreport['modules']?>');
});
</script>
<input type="text" id="salesprofitlossurl" style="display: none;">
<span onclick="window.open('reportsalesprofitloss.php?datefrom='+startdatesalesprofitloss+'&dateto='+enddatesalesprofitloss+'&proid=<?=$sqlsalesprofitlossreport['proid']?>&modules=<?=$sqlsalesprofitlossreport['modules']?>','_self')">Profit And Loss 
<svg data-toggle="tooltip" title="Profit And Loss" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlstockandsales = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='stockandsales' and createdid='$companymainid'");
$sqlstockandsalesreport = mysqli_fetch_array($sqlstockandsales);
$sqlfavouritestockandsales=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='stockandsales'");
$fetfavouritestockandsales = mysqli_fetch_array($sqlfavouritestockandsales);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlstockandsalesreport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatestockandsales = formatDateSwitch(startDate);
  var enddatestockandsales = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Stock And Sales Statement', $listings))?'':'display:none;')?>">
<span id="favouritestockandsales" onclick="favouritestockandsales()" style="<?=(($fetfavouritestockandsales['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritestockandsales" onclick="nofavouritestockandsales()" style="<?=(($fetfavouritestockandsales['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritestockandsales['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatestockandsalesfav = formatDateSwitch(startDate);
  var enddatestockandsalesfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#stockandsalesurl").val('reportstockandsales.php?commision=<?=$sqlstockandsalesreport['commision']?>|-|datefrom='+startdatestockandsalesfav+'|-|dateto='+enddatestockandsalesfav+'|-|category=<?=$sqlstockandsalesreport['category']?>');
});
</script>
<input type="text" id="stockandsalesurl" style="display: none;">
<span onclick="window.open('reportstockandsales.php?commision=<?=$sqlstockandsalesreport['commision']?>&datefrom='+startdatestockandsales+'&dateto='+enddatestockandsales+'&category=<?=$sqlstockandsalesreport['category']?>','_self')">Stock And Sales Statement 
<svg data-toggle="tooltip" title="Stock And Sales Statement" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlstockandsalesnew = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='stockandsalesnew' and createdid='$companymainid'");
$sqlstockandsalesnewreport = mysqli_fetch_array($sqlstockandsalesnew);
$sqlfavouritestockandsalesnew=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='stockandsalesnew'");
$fetfavouritestockandsalesnew = mysqli_fetch_array($sqlfavouritestockandsalesnew);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlstockandsalesnewreport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatestockandsalesnew = formatDateSwitch(startDate);
  var enddatestockandsalesnew = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Stock And Sales Statement New', $listings))?'':'display:none;')?>">
<span id="favouritestockandsalesnew" onclick="favouritestockandsalesnew()" style="<?=(($fetfavouritestockandsalesnew['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritestockandsalesnew" onclick="nofavouritestockandsalesnew()" style="<?=(($fetfavouritestockandsalesnew['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritestockandsalesnew['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatestockandsalesnewfav = formatDateSwitch(startDate);
  var enddatestockandsalesnewfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#stockandsalesnewurl").val('reportstockandsalesnew.php?datefrom='+startdatestockandsalesnewfav+'|-|dateto='+enddatestockandsalesnewfav+'|-|category=<?=$sqlstockandsalesnewreport['category']?>');
});
</script>
<input type="text" id="stockandsalesnewurl" style="display: none;">
<span onclick="window.open('reportstockandsalesnew.php?datefrom='+startdatestockandsalesnew+'&dateto='+enddatestockandsalesnew+'&category=<?=$sqlstockandsalesnewreport['category']?>','_self')">Stock And Sales Statement New <svg data-toggle="tooltip" title="Stock And Sales Statement New" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
</div>
<?php
$sqlstockinhandwithvalueview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='stockinhandwithvalue' and createdid='$companymainid'");
$sqlstockinhandwithvalueport = mysqli_fetch_array($sqlstockinhandwithvalueview);
$sqlfavouritestockinhandwithvalue=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='stockinhandwithvalue'");
$fetfavouritestockinhandwithvalue = mysqli_fetch_array($sqlfavouritestockinhandwithvalue);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlstockinhandwithvalueport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatestockinhandwithvalue = formatDateSwitch(startDate);
  var enddatestockinhandwithvalue = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<div class="col-lg-3" style="<?=((in_array('Purchase Details', $listings))?'':'display:none;')?>">
<p style="font-size: 16px !important;">Purchase Details</p>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Purchase Details', $listings))?'':'display:none;')?>">
<span id="favouritestockinhandwithvalue" onclick="favouritestockinhandwithvalue()" style="<?=(($fetfavouritestockinhandwithvalue['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritestockinhandwithvalue" onclick="nofavouritestockinhandwithvalue()" style="<?=(($fetfavouritestockinhandwithvalue['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritestockinhandwithvalue['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatestockinhandwithvaluefav = formatDateSwitch(startDate);
  var enddatestockinhandwithvaluefav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#stockinhandwithvalueurl").val('reportstockinhandwithvalue.php?datefrom='+startdatestockinhandwithvaluefav+'|-|dateto='+enddatestockinhandwithvaluefav+'|-|proid=<?=$sqlstockinhandwithvalueport['proid']?>');
});
</script>
<input type="text" id="stockinhandwithvalueurl" style="display: none;">
<span onclick="window.open('reportstockinhandwithvalue.php?datefrom='+startdatestockinhandwithvalue+'&dateto='+enddatestockinhandwithvalue+'&proid=<?=$sqlstockinhandwithvalueport['proid']?>','_self')">Stock in Hand with Value 
<svg data-toggle="tooltip" title="Stock in Hand with Value" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
</div>
<?php
$sqlcustbalanceview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='cust' and createdid='$companymainid'");
$sqlcustbalanceport = mysqli_fetch_array($sqlcustbalanceview);
$sqlfavouritecustbalance=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='cust'");
$fetfavouritecustbalance = mysqli_fetch_array($sqlfavouritecustbalance);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlcustbalanceport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatecustbalance = formatDateSwitch(startDate);
  var enddatecustbalance = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<div class="col-lg-3" style="<?=((in_array('Customer Balance', $listings))?'':'display:none;')?>">
<p style="font-size: 16px !important;">Customer Balance</p>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Customer Balance', $listings))?'':'display:none;')?>">
<span id="favouritecustbalance" onclick="favouritecustbalance()" style="<?=(($fetfavouritecustbalance['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritecustbalance" onclick="nofavouritecustbalance()" style="<?=(($fetfavouritecustbalance['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritecustbalance['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatecustbalancefav = formatDateSwitch(startDate);
  var enddatecustbalancefav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#custurl").val('reportcustbalance.php?datefrom='+startdatecustbalancefav+'|-|dateto='+enddatecustbalancefav+'');
});
</script>
<input type="text" id="custurl" style="display: none;">
<span onclick="window.open('reportcustbalance.php?datefrom='+startdatecustbalance+'&dateto='+enddatecustbalance+'','_self')">Balance 
<svg data-toggle="tooltip" title="Your invoices, ordered by date" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
</div>


<?php
$sqljournalview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='journal' and createdid='$companymainid'");
$sqljournalport = mysqli_fetch_array($sqljournalview);
$sqlfavouritejournal=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='journal'");
$fetfavouritejournal = mysqli_fetch_array($sqlfavouritejournal);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqljournalport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatejournal = formatDateSwitch(startDate);
  var enddatejournal = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<div class="col-lg-3" style="<?=((in_array('Accounts', $listings))?'':'display:none;')?>">
<p style="font-size: 16px !important;">Accounts</p>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Journal', $listings))?'':'display:none;')?>">
<span id="favouritejournal" onclick="favouritejournal()" style="<?=(($fetfavouritejournal['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritejournal" onclick="nofavouritejournal()" style="<?=(($fetfavouritejournal['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritejournal['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatejournalfav = formatDateSwitch(startDate);
  var enddatejournalfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#journalurl").val('reportjournal.php?datefrom='+startdatejournalfav+'|-|dateto='+enddatejournalfav+'');
});
</script>
<input type="text" id="journalurl" style="display: none;">
<span onclick="window.open('reportjournal.php?datefrom='+startdatejournal+'&dateto='+enddatejournal+'','_self')">Journal 
<svg data-toggle="tooltip" title="Journal" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
<?php
$sqlaccounttransview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='accounttrans' and createdid='$companymainid'");
$sqlaccounttransport = mysqli_fetch_array($sqlaccounttransview);
$sqlfavouriteaccounttrans=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='accounttrans'");
$fetfavouriteaccounttrans = mysqli_fetch_array($sqlfavouriteaccounttrans);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqlaccounttransport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateaccounttrans = formatDateSwitch(startDate);
  var enddateaccounttrans = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Accounts Transactions', $listings))?'':'display:none;')?>">
<span id="favouriteaccounttrans" onclick="favouriteaccounttrans()" style="<?=(($fetfavouriteaccounttrans['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouriteaccounttrans" onclick="nofavouriteaccounttrans()" style="<?=(($fetfavouriteaccounttrans['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouriteaccounttrans['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdateaccounttransfav = formatDateSwitch(startDate);
  var enddateaccounttransfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#accounttransurl").val('reportaccounttrans.php?datefrom='+startdateaccounttransfav+'|-|dateto='+enddateaccounttransfav+'');
});
</script>
<input type="text" id="accounttransurl" style="display: none;">
<span onclick="window.open('reportaccounttrans.php?datefrom='+startdateaccounttrans+'&dateto='+enddateaccounttrans+'','_self')">Accounts Transactions 
<svg data-toggle="tooltip" title="Accounts Transactions" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
</div>


<?php
$sqltimesheetview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='timesheet' and createdid='$companymainid'");
$sqltimesheetport = mysqli_fetch_array($sqltimesheetview);
$sqlfavouritetimesheet=mysqli_query($con, "select reportstatus,reporturl from pairreportfavourites where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and reportnames='timesheet'");
$fetfavouritetimesheet = mysqli_fetch_array($sqlfavouritetimesheet);
?>
<script type="text/javascript">
  var selectedValue = "<?=$sqltimesheetport['reportperiod']?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatetimesheet = formatDateSwitch(startDate);
  var enddatetimesheet = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
</script>
<div class="col-lg-3" style="<?=((in_array('Time Tracking', $listings))?'':'display:none;')?>">
<p style="font-size: 16px !important;">Time Tracking</p>
<p style="border-bottom: 1px dashed lightgray;cursor: pointer;color: royalblue;font-size: 14px !important;margin-top: 9px !important;padding-bottom: 9px !important;<?=((in_array('Timesheet Details', $listings))?'':'display:none;')?>">
<span id="favouritetimesheet" onclick="favouritetimesheet()" style="<?=(($fetfavouritetimesheet['reportstatus']=='1')?'display: inline;':'display: none;')?>">
<i class="fa fa-star" style="color:yellow;"></i>
</span>
<span id="nofavouritetimesheet" onclick="nofavouritetimesheet()" style="<?=(($fetfavouritetimesheet['reportstatus']=='0')?'display: inline;':'display: none;')?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top favorites-disabled" width="16" height="16" fill="#cbcbcb" style="color: #cbcbcb;width: 16px;height: 16px;">
<path d="M512 195.6l-171.6-34.7L256 0l-84.4 160.9L0 195.6l119.5 134.1L97.8 512 256 434l158.2 78-21.7-182.3L512 195.6zM256.3 381.4l-102.8 50.7 14.1-118.5L90 226.4l111.5-22.5 54.8-104.6L311.2 204l111.5 22.5-77.6 87.2 14.1 118.5-102.9-50.8z"></path>
</svg>
</span>
<script type="text/javascript">
$(document).ready(function() {
  var selectedValue = "<?=explode("period=",$fetfavouritetimesheet['reporturl'])[1]?>";
  var endDate = new Date();
  var startDate = new Date();

  switch (selectedValue) {
    case "all":
      startDate.setDate(1);
      startDate.setMonth(0);
      startDate.setYear(2000);
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

  var startdatetimesheetfav = formatDateSwitch(startDate);
  var enddatetimesheetfav = formatDateSwitch(endDate);

function formatDateSwitch(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  return  year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
}
$("#timesheeturl").val('reporttimesheet.php?datefrom='+startdatetimesheetfav+'|-|dateto='+enddatetimesheetfav+'');
});
</script>
<input type="text" id="timesheeturl" style="display: none;">
<span onclick="window.open('reporttimesheet.php?datefrom='+startdatetimesheet+'&dateto='+enddatetimesheet+'','_self')">Timesheet Details 
<svg data-toggle="tooltip" title="Timesheet Details" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg>
</span>
</p>
</div>

<div class="col-lg-3">

</div>

</div>

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
<script type="text/javascript">
$(document).ready(function() {
$('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>