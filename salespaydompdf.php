<?php
// Include autoloader 
require_once 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 

if (($_GET['term']=='salespayment')&&($_GET['sizes']=='a4')) {
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
include('lcheck.php');
$sqlismainaccessusercus=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
$infomainaccessusercus=mysqli_fetch_array($sqlismainaccessusercus);
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes, type, publicid, privateid from pairsalespayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='".$_GET['id']."'");
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Payments Received' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
$sqlismainaccessinvoice=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Invoices' order by id  asc");
$infomainaccessinvoice=mysqli_fetch_array($sqlismainaccessinvoice);
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Payments Received' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}

$id=mysqli_real_escape_string($con, $_GET['id']);
$sql=mysqli_query($con,"select module, id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes, publicid, privateid from pairsalespayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='".$_GET['id']."'");
$info=mysqli_fetch_array($sql);
$sqliet=mysqli_query($con, "select * from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$infofranch=mysqli_fetch_array($sqliet);
$sqlcus=mysqli_query($con,"select * from paircustomers where id=".$info['customerid']."");
$sqlcusfetch=mysqli_fetch_array($sqlcus);
$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$dates = date('d-m-Y h:i:s');
$html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.($_GET['names']).'</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<style>@page { margin: 60px; }body { font-family: "Myriad Set Pro","Helvetica Neue",Helvetica,Arial,sans-serif;margin: 204px -30px 51.8px -30px;word-wrap: break-word;border:1px solid #cccccc;}table {border-collapse: collapse;}header{position: fixed;top: -29px;height: max-content;width:108.8%;color: black;text-align: center;}footer{position: fixed;bottom: -27px;height: max-content;width:108.8%;color: black;text-align: center;}#footer{position: absolute;bottom: -33px;height: max-content;width:108.8%;color: black;text-align: center;}.ribbon-wrapper {width: 185px;height: 188px;overflow: hidden;position: absolute;top: -3px;left: -3px;}.ribbon {font: bold 15px Sans-Serif;color: #333;text-align: center;text-shadow: rgba(255, 255, 255, 0.5) 0 1px 0;position: relative;padding: 7px 0;transform: rotate(-45deg);left: -42px;top: 32px;width: 180px;background-color: #BFDC7A;box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);}.ribbon:before, .ribbon:after {content: "";border-top: 3px solid #6e8900;border-left: 3px solid transparent;border-right: 3px solid transparent;position: absolute;bottom: -3px;}.ribbon:before {left: 0;}.ribbon:after {right: 0;}</style>
</head>
<body>
<header>
<div style="border:1px solid #cccccc;border-bottom:none;">
<div>'.($infomainaccessuser['modulename']).'</div>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-23px;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:9px 6px !important;text-align:right;margin-top:18px;height:80px;">';
    $imgs=explode(',',$infofranch['branchimage']);
    foreach($imgs as $img)
    {
if ($infofranch['branchimage']!='') {
$franchpath = (str_replace('../ups','ups',$img));
$franchtype = pathinfo($franchpath, PATHINFO_EXTENSION);
$franchdata = file_get_contents($franchpath);
$franchbase64 = 'data:image/' . $franchtype . ';base64,' . base64_encode($franchdata);
}
else{
$franchbase64 = '';
}
    $html .= '<img alt="Branch Pic" src="'.($franchbase64).'" id="branch-image1" height="80" width="80" style="'.(($infofranch['branchimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '</span>
<span style="width: 63%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.($infofranch['franchisename']).'</strong>
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;">'.($infofranch['street']).' '.($infofranch['city']).' '.($infofranch['pincode']).' '.($infofranch['state']).' '.($infofranch['country']).' </span>
<span style="'.(($access['salespayreceivebranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Phone </span>
<span style="'.(($access['salespayreceivebranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 80%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($infofranch['mobile']).'</span>
<span style="'.(($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">E-mail </span>
<span style="'.(($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 47%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($infofranch['email']).'</span>
<span style="'.(($access['salespayreceiveprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 13%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 20 </span>
<span style="'.(($access['salespayreceiveprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 19%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($infofranch['dlno20']).'</span>
<span style="'.(($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 47%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($infofranch['gstno']).'</span>
<span style="'.(($access['salespayreceiveprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 13%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 21 </span>
<span style="'.(($access['salespayreceiveprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 19%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($infofranch['dlno21']).'</span>
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-28px;">
<span style="width: 33%;display:inline-block;background-color:#eee;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;border-left: 1px solid #cccccc;'.((in_array('Billing Address', $fieldview))?'':'visibility:hidden;').'"><strong>Billing Address</strong></span>
<span style="width: 33%;display:inline-block;background-color:#fff;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"><strong></strong></span>
<span style="width: 33.6%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"></span>
</div>
<div style="border:1px solid #cccccc;padding-top:3px;text-align: left;border-top:none;border-bottom:none;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:3px 6px !important;margin-bottom:-10px;">
<strong style="'.((($sqlcusfetch['customername']!='')&&(in_array('Billing Name', $fieldview))&&(in_array('Billing Address', $fieldview)))?'display:inline-block;':'display:none;').'font-weight:bold;font-size: 13px !important;width: 245px;overflow: hidden;height: 15px;white-space: nowrap;">'.(ucwords(strtolower($sqlcusfetch['customername']))).'</strong>
<span style="'.((in_array('Billing Address', $fieldview))?'display:inline-block;':'display:none;').''.(((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!='')||($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))&&(((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;width: 245px;overflow: hidden;">'.(ucwords(strtolower($sqlcusfetch['billstreet']))).' '.(((($sqlcusfetch['billstreet']!='')&&($sqlcusfetch['billcity']!=''))?',':'')).' '.(ucwords(strtolower($sqlcusfetch['billcity']))).'</span>
<span style="'.((in_array('Billing Address', $fieldview))?'display:inline-block;':'display:none;').''.(((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!='')||($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))&&(((($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;width: 245px;overflow: hidden;">'.($sqlcusfetch['billstate']).' '.(((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billpincode']!=''))?',':'')).' '.($sqlcusfetch['billpincode']).' '.(((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billcountry']!='')||($sqlcusfetch['billpincode']!='')&&($sqlcusfetch['billcountry']!=''))?',':'')).' '.($sqlcusfetch['billcountry']).'</span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Work Phone </span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($sqlcusfetch['workphone']).'</b></span>
<span style="'.((in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.((in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.$sqlcusfetch['gstin'].'</b></span>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;margin-bottom:-10px;">
<br>
<strong style="visibility:hidden;font-weight:bold;font-size: 13px !important;display: inline-block;width: 245px;overflow: hidden;height: 15px;white-space: nowrap;"></strong>
<span style="'.(((in_array('Reference Number', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:10px;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:0px;">Reference Number</span></span>
<span style="'.(((in_array('Reference Number', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:10px;"><strong>: '.($info['receiptno']).'</strong></span><span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:10px;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:0px;">Amount Received</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:10px;"><strong>: '.((number_format((float)$info['amount'],2,'.',''))).'</strong></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Term</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($info['paymentmode']).'</strong></span>
<span style="display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;"></b></span>
</span>
<span style="width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;margin-bottom:-10px;vertical-align:middle;">
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).'</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Number</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($info['privateid']).'</strong></span><span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).'</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Date</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($info['receiptdate']))).'</strong></span>
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Term</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($info['paymentmode']).'</strong></span>
</span>
</div>
</header>
<footer>
<div style="border:1px solid #cccccc;padding-top:30px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:0px;text-align: left;margin-bottom:-28px;border-bottom:none;border-top:none;">';
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-4px;visibility:hidden;">

</span>
<span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;visibility:hidden;">

</span>
</div>
<br>
<div style="border:1px solid #cccccc;padding:0px !important;text-align: left;border-top:none;">';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
$html .= '<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;border-left: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;text-align:left;overflow:hidden;margin-top:10px;margin-bottom:-11px;visibility:hidden;">
<span style="display:block;height:23px;padding-left:36px;position:relative;top:6px;"></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp;</span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"></strong>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;font-size: 12px !important;text-align: center !important;position:relative;top:23px;">Printed </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:11px;"><b> </b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;font-size: 12px !important;text-align: center !important;position:relative;top:23px;font-weight:bold;left:63px;">Pages </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:11px;"><b> </b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;visibility:hidden;">';
    $imgs=explode(',',$infofranch['signimage']);
    foreach($imgs as $img)
    {
if ($infofranch['signimage']!='') {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
}
else{
$signbase64 = '';
}
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($infofranch['signimage']!='')?'':'visibility:hidden;').'">';
    }
    if ($infofranch['signimage']=='') {
        $html .= '<span style="width: 238px !important;height: 25px !important;display:inline-block;">&nbsp;</span>';
    }
$html .= '<span style="width: 103%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px 6px 10px 6px !important;font-size:12px;white-space: nowrap;text-align:center;overflow:hidden;">For '.($infofranch['franchisename']).'</span>
</span>
</div>
</footer>
<div style="border: 0px solid #cccccc;width:100% !important;">';
if($info['module']=='payment'){
if(!empty($info["customerid"]))
{
$customerid=$info["customerid"];
if($customerid!='')
{
$html .= '<table style="border: 0px solid #cccccc;width:100% !important;">
<thead style="background-color: #eee;">
<tr class="info">
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:left;">'.(strtoupper($infomainaccessinvoice['modulename'])).' DATE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:left;">'.(strtoupper($infomainaccessinvoice['modulename'])).' NUMBER</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;">'.(strtoupper($infomainaccessinvoice['modulename'])).' AMOUNT</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;">BALANCE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align: right;">PAYMENT</span></th>
</tr>
</thead>
<tbody>';
    $i=0;
    $item=1;
    $countt=1;
    $totpros=1;
$sqls=mysqli_query($con,"select invoiceno, invoicedate, grandtotal, paidstatus, customerid, customername from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY invoicedate, invoiceno  order by invoicedate asc, invoiceno asc");
while($infos=mysqli_fetch_array($sqls))
{
$s=0;
if($infos['paidstatus']=='1')
{
$sqlse=mysqli_query($con,"select paymentid from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  invoiceno='".$infos['invoiceno']."' and invoicedate='".$infos['invoicedate']."' and customerid='$customerid' and paymentid='".$_GET['id']."'");
if(mysqli_num_rows($sqlse)>0)
{
$s=0;
}
else
{
$s=1;
}
}
if($s==0)
{
$am=0;
$am1=0;
$p='';
$p1=0;
$sqlse=mysqli_query($con,"select amount, paymentid from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  invoiceno='".$infos['invoiceno']."' and invoicedate='".$infos['invoicedate']."' and customerid='$customerid'");
while($infose=mysqli_fetch_array($sqlse))
{
if($infose['paymentid']==$_GET['id'])
{
$p='yes';
$p1=(float)$infose['amount'];
}
else
{
$am+=(float)$infose['amount'];
}
$am1+=(float)$infose['amount']; 
}
if($p=='yes')
{
$totpros++;
}
}
}
    $sqls=mysqli_query($con,"select invoiceno, invoicedate, grandtotal, paidstatus, customerid, customername from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY invoicedate, invoiceno  order by invoicedate asc, invoiceno asc");
    while($infos=mysqli_fetch_array($sqls))
    {
        $s=0;
        if($infos['paidstatus']=='1')
        {
            $sqlse=mysqli_query($con,"select paymentid from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  invoiceno='".$infos['invoiceno']."' and invoicedate='".$infos['invoicedate']."' and customerid='$customerid' and paymentid='".$_GET['id']."'");
            if(mysqli_num_rows($sqlse)>0)
            {
                $s=0;
            }
            else
            {
                $s=1;
            }
        }
        if($s==0)
        {
        $am=0;
        $am1=0;
        $p='';
        $p1=0;
        $sqlse=mysqli_query($con,"select amount, paymentid from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  invoiceno='".$infos['invoiceno']."' and invoicedate='".$infos['invoicedate']."' and customerid='$customerid'");
        while($infose=mysqli_fetch_array($sqlse))
        {
            if($infose['paymentid']==$_GET['id'])
            {
                $p='yes';
                $p1=(float)$infose['amount'];
            }
            else
            {
                $am+=(float)$infose['amount'];
            }
            $am1+=(float)$infose['amount']; 
        }
        if($p=='yes')
        {
        $bal=(float)$infos['grandtotal']-$am;
        if((float)$infos['grandtotal']==$am1)
        {
            $sta='1';
        }
        else
        {
            $sta='2';
        }
$html .= '<input type="hidden" name="nos[]" id="invoice'.$i.'" value="'.$infos['invoiceno'].'">
        <input type="hidden" name="dates[]" id="date'.$i.'" value="'.$infos['invoicedate'].'">
        <input type="hidden" name="status[]" id="status'.$i.'" value="'.$sta.'">
<tr style="height:28px !important;border:1px solid #cccccc !important;">
<td style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;border: 1px solid #cccccc !important;width:10px;"><input type="checkbox" name="payments'.$i.'" id="payments'.$i.'" onchange="return changeval('.$i.')" value="'.(number_format((float)$bal,2,'.','')).'" checked disabled style="position:relative;top:0px;"></td>
<td data-label="'. strtoupper($infomainaccessinvoice['modulename']) .' DATE" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;border: 1px solid #cccccc !important;">'.date('d/m/Y',strtotime($infos['invoicedate'])).'</td>
<td data-label="'. strtoupper($infomainaccessinvoice['modulename']) .' NUMBER" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;border: 1px solid #cccccc !important;">'.$infos['invoiceno'].'</td>
<td data-label="'. strtoupper($infomainaccessinvoice['modulename']) .' AMOUNT" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;border: 1px solid #cccccc !important;padding:0px 3px;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$infos['grandtotal'],2,'.','')).'</td>
<td data-label="BALANCE" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;border: 1px solid #cccccc !important;padding:0px 3px;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$bal,2,'.','')).'</td>
<td data-label="PAYMENT" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;border: 1px solid #cccccc !important;padding:0px 3px;" id="amttd"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$p1,2,'.','')).'</td>
</tr>';
        $item++;
        $countt++;
        }
        $i++;
        }
    }
$outArr=array("timer"=>ceil(($countt)/500));
$jsonResponse=json_encode($outArr);
echo $jsonResponse;
$html .= '</tbody>
</table>';
}
}
}
else{
$html .= '<table style="border: 0px solid #cccccc;width:100% !important;">
<thead style="background-color: #eee;">
<tr class="info">
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;text-align:left;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;">DESCRIPTION</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;text-align: right;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;">AMOUNT</span></th>
</tr>
</thead>
<tbody>
<tr style="height:28px !important;border:1px solid #cccccc !important;">
<td data-label="DESCRIPTION" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;border: 1px solid #cccccc !important;">'.strtoupper($infomainaccessusercus['modulename']).' ADVANCE RECEIVED</td>
<td data-label="AMOUNT" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;border: 1px solid #cccccc !important;">'.number_format((float)$info['amount'],2,'.','').'</td>
</tr>
</tbody>
</table>';
$countt=1;
$totpros=1;
$outArr=array("timer"=>1);
$jsonResponse=json_encode($outArr);
echo $jsonResponse;
}
$html .= '</div>
<div id="footer" style="'.((($countt)==$totpros)?'visibility:visible;':'visibility:hidden;').'">
<div style="border:0px solid #cccccc;padding-top:5px;text-align: left;border-top:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;">

</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;">

</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">

</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:0px;text-align: left;border-top:none;margin-bottom:-28px;">';
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-4px;">

</span>
<span style="width: 28.9%;display:inline-block;margin-right: 0px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-6.5px;border-left:1px solid #cccccc;margin-left:-0.5px;">
<b style="width: 48%;display:inline-block;overflow:hidden;position:relative;top:1.5px;">Total </b>
<b style="width: 49.5%;display:inline-block;overflow:hidden;position:relative;top:1.5px;">: <span style="font-family: DejaVu Sans; sans-serif;position:relative;top:1.5px;">&#8377;</span> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:4.5px;">'.((number_format((float)$info['amount'],2,'.',''))).'</span></b>
</span>
</div>
<br>
<div style="border:1px solid #cccccc;padding:0px !important;text-align: left;border-top:none;border-bottom:0px solid #cccccc;margin-bottom:6px;">';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
$html .= '<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;border-left: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;text-align:left;overflow:hidden;margin-top:10px;margin-bottom:-11px;">
<span style="display:block;height:23px;padding-left:36px;position:relative;top:6px;">Printed</span>
<span style="width: 1%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp;</span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:center;overflow:hidden;width:95%;position:relative;top:-9px;left:-10px;">Pages</strong>
</span>
<span style="'.(((in_array('Notes', $fieldview)))?'':'visibility:hidden;').'width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;left:3px;">Notes </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;"><b>: '.($info['notes']).'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;"><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;background-color:white;">&nbsp;&nbsp;&nbsp; </strong> </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;background-color:white;position:relative;left:-3px;">&nbsp;&nbsp;&nbsp; </strong></span>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;">';
    $imgs=explode(',',$infofranch['signimage']);
    foreach($imgs as $img)
    {
if ($infofranch['signimage']!='') {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
}
else{
$signbase64 = '';
}
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 230px !important;height: 25px !important;'.(($infofranch['signimage']!='')?'':'visibility:hidden;').'">';
    }
    if ($infofranch['signimage']=='') {
        $html .= '<span style="width: 230px !important;height: 25px !important;display:inline-block;">&nbsp;</span>';
    }
$html .= '<span style="width: 103%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px 6px 10px 6px !important;font-size:12px;white-space: nowrap;text-align:center;overflow:hidden;">For '.($infofranch['franchisename']).'</span>
</span>
</div>
</div>';
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$Printed = date($date,strtotime($dates));
$canvas = $dompdf->getCanvas();
$pdf = $canvas->get_cpdf();
$pages=0;
foreach ($pdf->objects as &$o) {
if ($o['t'] === 'contents') {
$pages+=1;    
$o['c'] = str_replace('Printed', "Printed On : ".$Printed, $o['c']);
$o['c'] = str_replace('Pages', "(Page ".$pages."/".$canvas->get_page_count().")", $o['c']);
}
}

// Output
// $output = $dompdf->output();
// $dompdf->stream("pairscript", array("Attachment" => 0));
$mask = 'dompdf/SalesPayments-*.*';
array_map('unlink', glob($mask));
$output = $dompdf->output();
file_put_contents("dompdf/".$_GET['names'].".pdf", $output);
}
if (($_GET['term']=='salespayment')&&($_GET['sizes']=='a5')) {
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
include('lcheck.php');
$sqlismainaccessusercus=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
$infomainaccessusercus=mysqli_fetch_array($sqlismainaccessusercus);
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes, type, publicid, privateid from pairsalespayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='".$_GET['id']."'");
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Payments Received' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
$sqlismainaccessinvoice=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Invoices' order by id  asc");
$infomainaccessinvoice=mysqli_fetch_array($sqlismainaccessinvoice);
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Payments Received' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}

$id=mysqli_real_escape_string($con, $_GET['id']);
$sql=mysqli_query($con,"select module, id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes, publicid, privateid from pairsalespayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='".$_GET['id']."'");
$info=mysqli_fetch_array($sql);
$sqliet=mysqli_query($con, "select * from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$infofranch=mysqli_fetch_array($sqliet);
$sqlcus=mysqli_query($con,"select * from paircustomers where id=".$info['customerid']."");
$sqlcusfetch=mysqli_fetch_array($sqlcus);
$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$dates = date('d-m-Y h:i:s');
$html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.($_GET['names']).'</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<style>body { font-family: "Myriad Set Pro","Helvetica Neue",Helvetica,Arial,sans-serif;margin: 204px -30px 55.5px -30px;word-wrap: break-word;border:1px solid #cccccc;}table {border-collapse: collapse;}header{position: fixed;top: -29px;height: max-content;width:108.3%;color: black;text-align: center;}footer{position: fixed;bottom: -25px;height: max-content;width:108.3%;color: black;text-align: center;}#footer{position: absolute;bottom: -31px;height: max-content;width:108.3%;color: black;text-align: center;}.ribbon-wrapper {width: 185px;height: 188px;overflow: hidden;position: absolute;top: -3px;left: -3px;}.ribbon {font: bold 15px Sans-Serif;color: #333;text-align: center;text-shadow: rgba(255, 255, 255, 0.5) 0 1px 0;position: relative;padding: 7px 0;transform: rotate(-45deg);left: -42px;top: 32px;width: 180px;background-color: #BFDC7A;box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);}.ribbon:before, .ribbon:after {content: "";border-top: 3px solid #6e8900;border-left: 3px solid transparent;border-right: 3px solid transparent;position: absolute;bottom: -3px;}.ribbon:before {left: 0;}.ribbon:after {right: 0;}</style>
</head>
<body>
<header>
<div style="border:1px solid #cccccc;border-bottom:none;">
<div>'.($infomainaccessuser['modulename']).'</div>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-23px;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:9px 6px !important;text-align:right;margin-top:18px;height:80px;">';
    $imgs=explode(',',$infofranch['branchimage']);
    foreach($imgs as $img)
    {
if ($infofranch['branchimage']!='') {
$franchpath = (str_replace('../ups','ups',$img));
$franchtype = pathinfo($franchpath, PATHINFO_EXTENSION);
$franchdata = file_get_contents($franchpath);
$franchbase64 = 'data:image/' . $franchtype . ';base64,' . base64_encode($franchdata);
}
else{
$franchbase64 = '';
}
    $html .= '<img alt="Branch Pic" src="'.($franchbase64).'" id="branch-image1" height="80" width="80" style="'.(($infofranch['branchimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '</span>
<span style="width: 63%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.($infofranch['franchisename']).'</strong>
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;">'.($infofranch['street']).' '.($infofranch['city']).' '.($infofranch['pincode']).' '.($infofranch['state']).' '.($infofranch['country']).' </span>
<span style="'.(($access['salespayreceivebranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Phone </span>
<span style="'.(($access['salespayreceivebranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 80%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($infofranch['mobile']).'</span>
<span style="'.(($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">E-mail </span>
<span style="'.(($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 47%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($infofranch['email']).'</span>
<span style="'.(($access['salespayreceiveprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 13%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 20 </span>
<span style="'.(($access['salespayreceiveprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 19%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($infofranch['dlno20']).'</span>
<span style="'.(($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 47%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($infofranch['gstno']).'</span>
<span style="'.(($access['salespayreceiveprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 13%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 21 </span>
<span style="'.(($access['salespayreceiveprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 19%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($infofranch['dlno21']).'</span>
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-28px;">
<span style="width: 33%;display:inline-block;background-color:#eee;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;border-left: 1px solid #cccccc;'.((in_array('Billing Address', $fieldview))?'':'visibility:hidden;').'"><strong>Billing Address</strong></span>
<span style="width: 33%;display:inline-block;background-color:#fff;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"><strong></strong></span>
<span style="width: 33.6%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"></span>
</div>
<div style="border:1px solid #cccccc;padding-top:3px;text-align: left;border-top:none;border-bottom:none;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:3px 6px !important;margin-bottom:-10px;">
<strong style="'.((($sqlcusfetch['customername']!='')&&(in_array('Billing Name', $fieldview))&&(in_array('Billing Address', $fieldview)))?'display:inline-block;':'display:none;').'font-weight:bold;font-size: 13px !important;width: 253px;overflow: hidden;height: 15px;white-space: nowrap;">'.(ucwords(strtolower($sqlcusfetch['customername']))).'</strong>
<span style="'.((in_array('Billing Address', $fieldview))?'display:inline-block;':'display:none;').''.(((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!='')||($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))&&(((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;width: 253px;overflow: hidden;">'.(ucwords(strtolower($sqlcusfetch['billstreet']))).' '.(((($sqlcusfetch['billstreet']!='')&&($sqlcusfetch['billcity']!=''))?',':'')).' '.(ucwords(strtolower($sqlcusfetch['billcity']))).'</span>
<span style="'.((in_array('Billing Address', $fieldview))?'display:inline-block;':'display:none;').''.(((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!='')||($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))&&(((($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;width: 253px;overflow: hidden;">'.($sqlcusfetch['billstate']).' '.(((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billpincode']!=''))?',':'')).' '.($sqlcusfetch['billpincode']).' '.(((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billcountry']!='')||($sqlcusfetch['billpincode']!='')&&($sqlcusfetch['billcountry']!=''))?',':'')).' '.($sqlcusfetch['billcountry']).'</span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Work Phone </span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($sqlcusfetch['workphone']).'</b></span>
<span style="'.((in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.((in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.$sqlcusfetch['gstin'].'</b></span>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;margin-bottom:-10px;">
<br>
<strong style="visibility:hidden;font-weight:bold;font-size: 13px !important;display: inline-block;width: 253px;overflow: hidden;height: 15px;white-space: nowrap;"></strong>
<span style="'.(((in_array('Reference Number', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:10px;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:0px;">Reference Number</span></span>
<span style="'.(((in_array('Reference Number', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:10px;"><strong>: '.($info['receiptno']).'</strong></span><span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:10px;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:0px;">Amount Received</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:10px;"><strong>: '.((number_format((float)$info['amount'],2,'.',''))).'</strong></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Term</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($info['paymentmode']).'</strong></span>
<span style="display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;"></b></span>
</span>
<span style="width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;margin-bottom:-10px;vertical-align:middle;">
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).'</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Number</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($info['privateid']).'</strong></span><span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).'</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Date</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($info['receiptdate']))).'</strong></span>
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Term</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($info['paymentmode']).'</strong></span>
</span>
</div>
</header>
<footer>
<div style="border:1px solid #cccccc;padding-top:30px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:0px;text-align: left;margin-bottom:-28px;border-bottom:none;">';
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-4px;visibility:hidden;">

</span>
<span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;visibility:hidden;">

</span>
</div>
<br>
<div style="border:1px solid #cccccc;padding:0px !important;text-align: left;border-top:none;">';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
$html .= '<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;border-left: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;text-align:left;overflow:hidden;margin-top:10px;margin-bottom:-11px;visibility:hidden;">
<span style="display:block;height:23px;padding-left:36px;position:relative;top:6px;"></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp;</span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"></strong>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;font-size: 12px !important;text-align: center !important;position:relative;top:23px;">Printed </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:11px;"><b> </b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;font-size: 12px !important;text-align: center !important;position:relative;top:23px;font-weight:bold;left:63px;">Pages </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:11px;"><b> </b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;visibility:hidden;">';
    $imgs=explode(',',$infofranch['signimage']);
    foreach($imgs as $img)
    {
if ($infofranch['signimage']!='') {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
}
else{
$signbase64 = '';
}
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($infofranch['signimage']!='')?'':'visibility:hidden;').'">';
    }
    if ($infofranch['signimage']=='') {
        $html .= '<span style="width: 238px !important;height: 25px !important;display:inline-block;">&nbsp;</span>';
    }
$html .= '<span style="width: 103%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px 6px 10px 6px !important;font-size:12px;white-space: nowrap;text-align:center;overflow:hidden;">For '.($infofranch['franchisename']).'</span>
</span>
</div>
</footer>
<div style="border: 0px solid #cccccc;width:100% !important;">';
if($info['module']=='payment'){
if(!empty($info["customerid"]))
{
$customerid=$info["customerid"];
if($customerid!='')
{
$html .= '<table style="border: 0px solid #cccccc;width:100% !important;">
<thead style="background-color: #eee;">
<tr class="info">
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:left;">'.(strtoupper($infomainaccessinvoice['modulename'])).' DATE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:left;">'.(strtoupper($infomainaccessinvoice['modulename'])).' NUMBER</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;">'.(strtoupper($infomainaccessinvoice['modulename'])).' AMOUNT</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;">BALANCE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px 6px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align: right;">PAYMENT</span></th>
</tr>
</thead>
<tbody>';
    $i=0;
    $item=1;
    $countt=1;
    $totpros=1;
$sqls=mysqli_query($con,"select invoiceno, invoicedate, grandtotal, paidstatus, customerid, customername from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY invoicedate, invoiceno  order by invoicedate asc, invoiceno asc");
while($infos=mysqli_fetch_array($sqls))
{
$s=0;
if($infos['paidstatus']=='1')
{
$sqlse=mysqli_query($con,"select paymentid from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  invoiceno='".$infos['invoiceno']."' and invoicedate='".$infos['invoicedate']."' and customerid='$customerid' and paymentid='".$_GET['id']."'");
if(mysqli_num_rows($sqlse)>0)
{
$s=0;
}
else
{
$s=1;
}
}
if($s==0)
{
$am=0;
$am1=0;
$p='';
$p1=0;
$sqlse=mysqli_query($con,"select amount, paymentid from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  invoiceno='".$infos['invoiceno']."' and invoicedate='".$infos['invoicedate']."' and customerid='$customerid'");
while($infose=mysqli_fetch_array($sqlse))
{
if($infose['paymentid']==$_GET['id'])
{
$p='yes';
$p1=(float)$infose['amount'];
}
else
{
$am+=(float)$infose['amount'];
}
$am1+=(float)$infose['amount']; 
}
if($p=='yes')
{
$totpros++;
}
}
}
    $sqls=mysqli_query($con,"select invoiceno, invoicedate, grandtotal, paidstatus, customerid, customername from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY invoicedate, invoiceno  order by invoicedate asc, invoiceno asc");
    while($infos=mysqli_fetch_array($sqls))
    {
        $s=0;
        if($infos['paidstatus']=='1')
        {
            $sqlse=mysqli_query($con,"select paymentid from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  invoiceno='".$infos['invoiceno']."' and invoicedate='".$infos['invoicedate']."' and customerid='$customerid' and paymentid='".$_GET['id']."'");
            if(mysqli_num_rows($sqlse)>0)
            {
                $s=0;
            }
            else
            {
                $s=1;
            }
        }
        if($s==0)
        {
        $am=0;
        $am1=0;
        $p='';
        $p1=0;
        $sqlse=mysqli_query($con,"select amount, paymentid from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  invoiceno='".$infos['invoiceno']."' and invoicedate='".$infos['invoicedate']."' and customerid='$customerid'");
        while($infose=mysqli_fetch_array($sqlse))
        {
            if($infose['paymentid']==$_GET['id'])
            {
                $p='yes';
                $p1=(float)$infose['amount'];
            }
            else
            {
                $am+=(float)$infose['amount'];
            }
            $am1+=(float)$infose['amount']; 
        }
        if($p=='yes')
        {
        $bal=(float)$infos['grandtotal']-$am;
        if((float)$infos['grandtotal']==$am1)
        {
            $sta='1';
        }
        else
        {
            $sta='2';
        }
$html .= '<input type="hidden" name="nos[]" id="invoice'.$i.'" value="'.$infos['invoiceno'].'">
        <input type="hidden" name="dates[]" id="date'.$i.'" value="'.$infos['invoicedate'].'">
        <input type="hidden" name="status[]" id="status'.$i.'" value="'.$sta.'">
<tr style="height:28px !important;border:1px solid #cccccc !important;">
<td style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;border: 1px solid #cccccc !important;width:10px;"><input type="checkbox" name="payments'.$i.'" id="payments'.$i.'" onchange="return changeval('.$i.')" value="'.(number_format((float)$bal,2,'.','')).'" checked disabled style="position:relative;top:0px;"></td>
<td data-label="'. strtoupper($infomainaccessinvoice['modulename']) .' DATE" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;border: 1px solid #cccccc !important;">'.date('d/m/Y',strtotime($infos['invoicedate'])).'</td>
<td data-label="'. strtoupper($infomainaccessinvoice['modulename']) .' NUMBER" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;border: 1px solid #cccccc !important;">'.$infos['invoiceno'].'</td>
<td data-label="'. strtoupper($infomainaccessinvoice['modulename']) .' AMOUNT" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;border: 1px solid #cccccc !important;padding:0px 3px;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$infos['grandtotal'],2,'.','')).'</td>
<td data-label="BALANCE" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;border: 1px solid #cccccc !important;padding:0px 3px;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$bal,2,'.','')).'</td>
<td data-label="PAYMENT" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;border: 1px solid #cccccc !important;padding:0px 3px;" id="amttd"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$p1,2,'.','')).'</td>
</tr>';
        $item++;
        $countt++;
        }
        $i++;
        }
    }
$outArr=array("timer"=>ceil(($countt)/500));
$jsonResponse=json_encode($outArr);
echo $jsonResponse;
$html .= '</tbody>
</table>';
}
}
}
else{
$html .= '<table style="border: 0px solid #cccccc;width:100% !important;">
<thead style="background-color: #eee;">
<tr class="info">
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;text-align:left;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;">DESCRIPTION</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;text-align: right;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;">AMOUNT</span></th>
</tr>
</thead>
<tbody>
<tr style="height:28px !important;border:1px solid #cccccc !important;">
<td data-label="DESCRIPTION" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;border: 1px solid #cccccc !important;">'.strtoupper($infomainaccessusercus['modulename']).' ADVANCE RECEIVED</td>
<td data-label="AMOUNT" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;border: 1px solid #cccccc !important;">'.number_format((float)$info['amount'],2,'.','').'</td>
</tr>
</tbody>
</table>';
$countt=1;
$totpros=1;
$outArr=array("timer"=>1);
$jsonResponse=json_encode($outArr);
echo $jsonResponse;
}
$html .= '</div>
<div id="footer" style="'.((($countt)==$totpros)?'visibility:visible;':'visibility:hidden;').'">
<div style="border:0px solid #cccccc;padding-top:5px;text-align: left;border-top:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;">

</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;">

</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">

</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:0px;text-align: left;border-top:none;margin-bottom:-28px;">';
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-4px;">

</span>
<span style="width: 28.9%;display:inline-block;margin-right: 0px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-6px;border-left:1px solid #cccccc;margin-left:-0.5px;">
<b style="width: 48%;display:inline-block;overflow:hidden;position:relative;top:1.5px;">Total </b>
<b style="width: 49.5%;display:inline-block;overflow:hidden;position:relative;top:1.5px;">: <span style="font-family: DejaVu Sans; sans-serif;position:relative;top:1.5px;">&#8377;</span> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:4.5px;">'.((number_format((float)$info['amount'],2,'.',''))).'</span></b>
</span>
</div>
<br>
<div style="border:1px solid #cccccc;padding:0px !important;text-align: left;border-top:none;border-bottom:0px solid #cccccc;margin-bottom:6px;">';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
$html .= '<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;border-left: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;text-align:left;overflow:hidden;margin-top:10px;margin-bottom:-11px;">
<span style="display:block;height:23px;padding-left:36px;position:relative;top:6px;">Printed</span>
<span style="width: 1%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp;</span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:center;overflow:hidden;width:95%;position:relative;top:-9px;left:-10px;">Pages</strong>
</span>
<span style="'.(((in_array('Notes', $fieldview)))?'':'visibility:hidden;').'width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;left:3px;">Notes </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;"><b>: '.($info['notes']).'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;"><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;background-color:white;">&nbsp;&nbsp;&nbsp; </strong> </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;background-color:white;position:relative;left:-3px;">&nbsp;&nbsp;&nbsp; </strong></span>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;">';
    $imgs=explode(',',$infofranch['signimage']);
    foreach($imgs as $img)
    {
if ($infofranch['signimage']!='') {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
}
else{
$signbase64 = '';
}
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($infofranch['signimage']!='')?'':'visibility:hidden;').'">';
    }
    if ($infofranch['signimage']=='') {
        $html .= '<span style="width: 238px !important;height: 25px !important;display:inline-block;">&nbsp;</span>';
    }
$html .= '<span style="width: 103%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px 6px 10px 6px !important;font-size:12px;white-space: nowrap;text-align:center;overflow:hidden;">For '.($infofranch['franchisename']).'</span>
</span>
</div>
</div>';
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'landscape');
$dompdf->render();
$Printed = date($date,strtotime($dates));
$canvas = $dompdf->getCanvas();
$pdf = $canvas->get_cpdf();
$pages=0;
foreach ($pdf->objects as &$o) {
if ($o['t'] === 'contents') {
$pages+=1;    
$o['c'] = str_replace('Printed', "Printed On : ".$Printed, $o['c']);
$o['c'] = str_replace('Pages', "(Page ".$pages."/".$canvas->get_page_count().")", $o['c']);
}
}

// Output
// $output = $dompdf->output();
// $dompdf->stream("pairscript", array("Attachment" => 0));
$mask = 'dompdf/SalesPayments-*.*';
array_map('unlink', glob($mask));
$output = $dompdf->output();
file_put_contents("dompdf/".$_GET['names'].".pdf", $output);
}
?>