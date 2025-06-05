<?php
include('lcheck.php');
if(!isset($_GET['cid']))
{
	header('Location: dashboard.php');
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
/*#footer {
position:fixed;
bottom: 0px;
width: 100%;
background-color:#ffffff;
left:0;
text-align:center;
border-top:1px solid #eeeeee;
}*/

#footer {
position:fixed;
bottom: 0px;
width: 81.81%;
background-color:#ffffff;
left:0;
margin-left: 223px;
margin-right: -15px;
text-align:center;
padding-top: 10px;
border-top:1px solid #eeeeee;
box-shadow: 9px 9px 9px 9px lightgrey;
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
@media screen and (max-width: 600px) {
.mtcolumn
{
	margin-top:15px;
}
}
.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
}
</style>

  <title>
View Quotation - Dmedia
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
 <?php
 if((isset($_GET['quotationno']))&&(isset($_GET['quotationdate'])))
 {
	 $quotationno=mysqli_real_escape_string($con, $_GET['quotationno']);
	 $quotationdate=mysqli_real_escape_string($con, $_GET['quotationdate']);
	 $cid=mysqli_real_escape_string($con, $_GET['cid']);
 $sql=mysqli_query($con, "select * from pairquotations where franchisesession='".$cid."' and createdid='$companymainid' and quotationno='$quotationno' and quotationdate='$quotationdate' order by id asc");
$count=1;
if(mysqli_num_rows($sql)>0)
{
$rows = array();
while($row = mysqli_fetch_assoc($sql)){ 
$rows[] = $row;
}
$sqliet=mysqli_query($con, "select franchisename, street, city, state, pincode, country, mobile, email, gstno from pairfranchises where id='".$cid."' ");
$info=mysqli_fetch_array($sqliet);
$businesstype=0;
?> 
   <div style="max-width: 1650px;">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<p class="mb-3" style="font-size: 20px;"><i class="fa fa-pencil-square-o"></i> View Quotation</p>
<?php

$sqliet=mysqli_query($con, "select quotation, quotationprefix, (quotationsuffix+1) as quotationsuffix from pairfranchises where tdelete='0' and id='".$cid."' order by id desc");
$infoet=mysqli_fetch_array($sqliet);
if($infoet['quotation']!='1')
{
	?>
	<div class="alert alert-danger mt-2 text-white">Sorry! Quotation Generation is Allowed for this Franchise</div>
	<?php
}
else
{
?>



<div class="container mt-1 mb-3">
    <div class="text-center">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="converHTMLFileToPDF()" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-print" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Print</span></p></a>
        
        
     

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <object id="pdfObj" data="" type="application/pdf" width="90%" height="550"></object>
      </div>
      <div class="modal-footer">
          <a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>
          
      </div>
    </div>
  </div>
</div>
      
      
        
        </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card" id="printarea" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding:10px; overflow-x:auto">
               
               
<table width="664"  height="1020" style="border:1px solid #cccccc">
<tr>
<td height="50">
<table width="100%">
<tr>
<td width="25%" style="padding:20px;"><img src="assets/img/invoicelogo.png" width="100%" ></td>
<td width="25%" style="vertical-align:middle"><strong style="font-size:18px;"><?=$info['franchisename']?></strong><br>
<?=$info['street']?> <?=$info['city']?> <?=$info['state']?> <?=$info['pincode']?><br>
 <?=$info['country']?><br>
GSTIN: <?=$info['gstno']?>
</td>
<td width="25%"></td>
<td width="25%" style="font-size:30px; vertical-align:bottom; padding-bottom:10px;">QUOTATION</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="50">
<table width="100%" border="1" style="border:1px solid #cccccc">
<tr>
<td width="50%" style="border:1px solid #cccccc">
<table border="0" width="100%">
<tr>
<td width="50%">#</td>
<td width="50%">: <b><?=$rows[0]['quotationno']?></b></td>
</tr>
<tr>
<td width="50%">Quotation Date</td>
<td width="50%">: <b><?=date('d/m/Y',strtotime($rows[0]['quotationdate']))?></b></td>
</tr>
<tr>
<td width="50%">Terms</td>
<td width="50%">: <b>Due on Receipt</b></td>
</tr>
<tr>
<td width="50%">Due Date</td>
<td width="50%">: <b><?=date('d/m/Y',strtotime($rows[0]['quotationdate']))?></b></td>
</tr>
</table>
</td>
<td width="50%" style="border:1px solid #cccccc">
<table border="0" width="100%">
<tr>
<td width="50%">Place of Supply</td>
<td width="50%">: <b><?=$rows[0]['state']?></b></td>
</tr>
</table>
</td>
</tr>
<tr style="font-weight:bold">
<td width="50%" style="border:1px solid #cccccc; background-color:#eeeeee">
Bill To
</td>
<td width="50%" style="border:1px solid #cccccc; background-color:#eeeeee">
Ship To
</td>
</tr>
<tr style="font-weight:bold">
<td width="50%" style="border:1px solid #cccccc;">
<strong><?=ucwords(strtolower($rows[0]['customername']))?></strong><br> 
<?=ucwords(strtolower($rows[0]['area']))?><br>
<br><?=ucwords(strtolower($rows[0]['city']))?><br> <?=$rows[0]['pincode']?>  <?=$rows[0]['state']?><br><?=$rows[0]['district']?>
<?php
$sqla=mysqli_query($con,"select tinno from paircustomers where franchisesession='".$_SESSION["franchisesession"]."' and id='".$rows[0]['customerid']."'");
$infoa=mysqli_fetch_array($sqla);
if($infoa['tinno']!='')
{
	echo 'GSTIN '.$infoa['tinno'];
}
?>

</td>
<td width="50%" style="border:1px solid #cccccc;">
<?=ucwords(strtolower($rows[0]['area']))?><br>
<br><?=ucwords(strtolower($rows[0]['city']))?><br> <?=$rows[0]['pincode']?>  <?=$rows[0]['state']?><br><?=$rows[0]['district']?>
<?php
$sqla=mysqli_query($con,"select tinno from paircustomers where franchisesession='".$_SESSION["franchisesession"]."' and id='".$rows[0]['customerid']."'");
$infoa=mysqli_fetch_array($sqla);
if($infoa['tinno']!='')
{
	echo 'GSTIN '.$infoa['tinno'];
}
?>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="50">
<table id="minis" border="0" width="100%" style="border:1px solid #cccccc">
<tr>
<th rowspan="2" style="border:1px solid #cccccc; background-color:#eeeeee; text-align:center">#</th>
<th rowspan="2" style="border:1px solid #cccccc; background-color:#eeeeee">Item & Description</th>
<th rowspan="2" style="border:1px solid #cccccc; background-color:#eeeeee">HSN/SAC</th>
<th rowspan="2" style="border:1px solid #cccccc; background-color:#eeeeee; text-align:right">Qty</th>
<th rowspan="2" style="border:1px solid #cccccc; background-color:#eeeeee; text-align:right">Rate</th>
<th rowspan="2" style="border:1px solid #cccccc; background-color:#eeeeee; text-align:right">Total</th>
<th colspan="2" style="border:1px solid #cccccc; background-color:#eeeeee; text-align:center">CGST</th>
<th colspan="2" style="border:1px solid #cccccc; background-color:#eeeeee; text-align:center">SGST</th>
<th rowspan="2" style="border:1px solid #cccccc; background-color:#eeeeee; text-align:right">Net Amount</th>
</tr>
<tr>
<th style="border:1px solid #cccccc; background-color:#eeeeee; text-align:right">%</th>
<th style="border:1px solid #cccccc; background-color:#eeeeee; text-align:right">Amt</th>
<th style="border:1px solid #cccccc; background-color:#eeeeee; text-align:right">%</th>
<th style="border:1px solid #cccccc; background-color:#eeeeee; text-align:right">Amt</th>
</tr>
<?php
$i=1;
$item=1;
$serial=1;
$p=1;
$oi=0;
$cgst25=0;
$cgst6=0;
$cgst9=0;
$cgst14=0;
$totaltotal=0;
$totaldiscount=0;
$totaltaxable=0;
$totalcgst=0;
$totalsgst=0;
$totalcess=0;
$totalnet=0;

$countt=1;
$totpros=count($rows);
foreach($rows as $row)
{
$vatamount=((float)$row['productvalue']*(1+(((float)$row['vat']/2)/100)))-(float)$row['productvalue'];
$pval=((float)$row['quantity']*(float)$row['productrate']);
$disamount=((float)$pval*(1+((float)$row['prodiscount']/100)))-(float)$pval;
$netamount=	(float)$row['productvalue']+$vatamount+$vatamount;
?>
<tr style=" border-bottom:none;">
<td style="border:1px solid #cccccc; text-align:center"><?=$countt?></td>
<td style="border:1px solid #cccccc; text-align:left"><?=$row['productname']?><?=(($row['productdescription']!='')?('<br>'.$row['productdescription']):'')?></td>
<td  style="border:1px solid #cccccc; text-align:center"><?=(($row['producthsn']!='')?($row['producthsn']):'')?></td>
<td  style="border:1px solid #cccccc; text-align:right"><?=$row['quantity']?></td>
<td style="border:1px solid #cccccc; text-align:right"><?=(($row['productrate']!='0')?(number_format((float)$row['productrate'],2,'.','')):'Free')?></td>
<td style="border:1px solid #cccccc; text-align:right"><?=(($row['productvalue']!='0')?(number_format(((float)$row['quantity']*(float)$row['productrate']),2,'.','')):'Free')?></td>
<td style="border:1px solid #cccccc; text-align:right"><?=number_format(((float)$row['vat']/2),2,'.','')?>%</td> 
<td style="border:1px solid #cccccc; text-align:right"><?=number_format((float)$vatamount,2,'.','')?></td> 
<td style="border:1px solid #cccccc; text-align:right"><?=number_format(((float)$row['vat']/2),2,'.','')?>%</td> 
<td style="border:1px solid #cccccc; text-align:right"><?=number_format((float)$vatamount,2,'.','')?></td> 
<td style="border:1px solid #cccccc; text-align:right"><?=number_format((float)$netamount,2,'.','')?></td> 
</tr>
<?php
if($row['vat']==5)
{
$cgst25+=$row['productvalue'];
}
if($row['vat']==12)
{
$cgst6+=$row['productvalue'];
}
if($row['vat']==18)
{
$cgst9+=$row['productvalue'];
}
if($row['vat']==28)
{
$cgst14+=$row['productvalue'];
}
$i++;
$serial++;
$item++;

$totaltotal+=((float)$row['quantity']*(float)$row['productrate']);
$totaldiscount+=(float)$disamount;
$totaltaxable+=(float)$row['productvalue'];
$totalcgst+=$vatamount;
$totalsgst+=$vatamount;
$totalnet+=$netamount;
$countt++;
}
?>


</table>
</td>
</tr>
<tr>
<td height="50">
<table width="100%">
<tr>
<td width="60%">
<br>
Total In Words<br>
<i><strong>Rupees 
      <?php
	  function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . ' ' : '') . $paise ;
}
echo ucwords(strtolower(getIndianCurrency($rows[0]['grandtotal'])));
?> Only </strong></i><br>
<br>
Looking forward for your business.
</td>

<td style="border:1px solid #cccccc">
<table width="100%">
<tr>
<td width="50%" style="text-align:right;line-height:1.5">
Sub Total Rs. <br>
<?php
if($rows[0]['gst25']!='0')
{
?>	
CGST (2.5%) Rs. <br>
SGST (2.5%) Rs. <br>
<?php
}
if($rows[0]['gst6']!='0')
{
?>
CGST (6%) Rs. <br>
SGST (6%) Rs. <br>
<?php
}
if($rows[0]['gst9']!='0')
{
?>
CGST (9%) Rs. <br>
SGST (9%) Rs. <br>
<?php
}
if($rows[0]['gst14']!='0')
{
?>
CGST (14%) Rs. <br>
SGST (14%) Rs. <br>
<?php
}
?>
<?php
if(($rows[0]['discountamount']!='0'))
{
?>	
Discount <?=($rows[0]['discount']!='')?'('.$rows[0]['discount'].'%)':''?> Rs. <br>
<?php
}
?>
<b>Total Rs.</b> <br>
<strong style="font-size:16px;">Balance Due Rs.</strong> <br>

</td>
<td style="text-align:right;line-height:1.5">
<?=number_format((float)$rows[0]['totalamount'],2,'.','')?><br>
<?php
if($rows[0]['gst25']!='0')
{
?>	
<?=number_format((float)$rows[0]['cgst25'],2,'.','')?><br>
<?=number_format((float)$rows[0]['sgst25'],2,'.','')?><br>
<?php
}
if($rows[0]['gst6']!='0')
{
?>
<?=number_format((float)$rows[0]['cgst6'],2,'.','')?><br>
<?=number_format((float)$rows[0]['sgst6'],2,'.','')?><br>
<?php
}
if($rows[0]['gst9']!='0')
{
?>
<?=number_format((float)$rows[0]['cgst9'],2,'.','')?><br>
<?=number_format((float)$rows[0]['sgst9'],2,'.','')?><br>
<?php
}
if($rows[0]['gst14']!='0')
{
?>
<?=number_format((float)$rows[0]['cgst14'],2,'.','')?><br>
<?=number_format((float)$rows[0]['sgst14'],2,'.','')?><br>
<?php
}
?>
<?php
if(($rows[0]['discountamount']!='0'))
{
?>	
<?=number_format((float)$rows[0]['discountamount'],2,'.','')?><br>
<?php
}
?>
<strong><?=number_format((float)$rows[0]['grandtotal'],2,'.','')?></strong><br>
<strong style="font-size:16px;"><?=number_format((float)$rows[0]['grandtotal'],2,'.','')?></strong><br>
</td>
</tr>
</table>
</td>

</tr>
</table>
</td>
</tr>
<tr>
<td height="50">
<table width="100%">
<tr>
<td width="60%">
Terms & Conditions<br>
Designing charge Extra
</td>
<td style="border:1px solid #cccccc; height:100px; text-align:center; vertical-align:bottom">
Authorized Signature
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td> &nbsp; </td>
</tr>

</table>


               
            </div>
        </div>
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
 <?php
}
 else
 {
	 ?>
	 <div class="alert alert-danger text-white">
	 No Data Found
	 </div>
	 <?php
 }
 }
 else
 {
	 ?>
	 <div class="alert alert-danger text-white">
	 No Information
	 </div>
	 <?php
 }
?> 
  <?php
  include('footer.php');
  ?>
</div>
</main>
 <?php
 include('fexternals.php');
 ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>

function converHTMLFileToPDF() {
	const { jsPDF } = window.jspdf;
	var doc = new jsPDF('p', 'mm', [1070, 700]);

	var pdfjs = document.querySelector('#printarea');

	doc.html(pdfjs, {
		callback: function(doc) {
		    //doc.output('dataurlnewwindow');
			//doc.save("output.pdf");
			document.getElementById("pdfObj").data = doc.output("bloburl");
			//window.open(doc.output("bloburl"), "_blank","toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,modal=yes,top=200,left=350,width=600,height=400");
			
		},
		x: 10,
		y: 10
	});
}

</script>

<script>
        function printDiv() {
            var divContents = document.getElementById("printarea").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html><link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />');
            a.document.write('<body >');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
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
</body>
</html>