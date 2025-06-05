<?php
// Include autoloader 
require_once 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 

if (($_GET['term']=='bill')&&($_GET['sizes']=='a4')) {
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
include('lcheck.php');
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='0')) {
$dateforexp = '';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'd/m/Y';
}
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'm/Y';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'd/Y';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='0')) {
$dateforexp = 'd/m';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='0')) {
$dateforexp = 'd';
}
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='0')) {
$dateforexp = 'm';
}
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'Y';
}
}
$sqlismainaccessuserinv=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Invoices' order by id  asc");
$infomainaccessuserinv=mysqli_fetch_array($sqlismainaccessuserinv);
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Bills' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Bills' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}

$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Bills' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
 if((isset($_GET['billno']))&&(isset($_GET['billdate'])))
 {
     $billno=mysqli_real_escape_string($con, $_GET['billno']);
     $billdate=mysqli_real_escape_string($con, $_GET['billdate']);
 $sql=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='$billno' and billdate='$billdate' order by id asc");
$count=1;
if(mysqli_num_rows($sql)>0)
{
$rows = array();
while($row = mysqli_fetch_assoc($sql)){ 
$rows[] = $row;
}
$sqliet=mysqli_query($con, "select * from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$info=mysqli_fetch_array($sqliet);
$businesstype=0;
}
}
$html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.($_GET['names']).'</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<style>@page { margin: 60px; }body { font-family: "Myriad Set Pro","Helvetica Neue",Helvetica,Arial,sans-serif;margin: '.(((in_array('DL No 20', $fieldview))&&(in_array('DL No 21', $fieldview)))?'225px':'204px').' -30px 153.3px -30px;word-wrap: break-word;border:1px solid #cccccc;}table {border-collapse: collapse;}header{position: fixed;top: -29px;height: max-content;width:108.8%;margin-left:-1px;color: black;text-align: center;}footer{position: fixed;bottom: -27px;height: max-content;width:108.8%;margin-left:-1px;color: black;text-align: center;}#footer{position: absolute;bottom: -35px;height: max-content;width:108.8%;margin-left:-1px;color: black;text-align: center;}.ribbon-wrapper {width: 185px;height: 188px;overflow: hidden;position: absolute;top: -3px;left: -3px;}.ribbon {font: bold 15px Sans-Serif;color: #333;text-align: center;text-shadow: rgba(255, 255, 255, 0.5) 0 1px 0;position: relative;padding: 7px 0;transform: rotate(-45deg);left: -42px;top: 32px;width: 180px;background-color: #BFDC7A;box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);}.ribbon:before, .ribbon:after {content: "";border-top: 3px solid #6e8900;border-left: 3px solid transparent;border-right: 3px solid transparent;position: absolute;bottom: -3px;}.ribbon:before {left: 0;}.ribbon:after {right: 0;}</style>
</head>
<body>
<header>';
$html .= '
<div style="border:1px solid #cccccc;border-bottom:none;">
<div><b style="font-size:15px !important;">'.($infomainaccessuser['modulename']).'</b></div>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-23px;">
<span style="width: 13%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:9px 6px !important;text-align:right;margin-top:18px;height:80px;">';
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
if ($info['branchimage']!='') {
$franchpath = (str_replace('../ups','ups',$img));
$franchtype = pathinfo($franchpath, PATHINFO_EXTENSION);
$franchdata = file_get_contents($franchpath);
$franchbase64 = 'data:image/' . $franchtype . ';base64,' . base64_encode($franchdata);
}
else{
$franchbase64 = '';
}
    $html .= '<img alt="Branch Pic" src="'.($franchbase64).'" id="branch-image1" height="80" width="80" style="'.(($info['branchimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '</span>
<span style="width: 50%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.($info['franchisename']).'</strong>
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 360px;overflow: hidden;white-space: nowrap;">'.($info['street']).' '.($info['city']).' '.($info['pincode']).' '.($info['state']).' '.($info['country']).' </span>
<span style="'.(($access['billbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 10%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Phone </span>
<span style="'.(($access['billbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 88%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
<span style="'.(($access['billbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 10%;overflow: hidden;font-size: 12px !important;text-align: left !important;">E-mail </span>
<span style="'.(($access['billbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 51%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['email']).'</span>
<span style="'.(($access['billprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 14%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 20 </span>
<span style="'.(($access['billprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 21%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno20']).'</span>
<span style="'.(($access['billbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 10%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($access['billbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 51%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['gstno']).'</span>
<span style="'.(($access['billprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 14%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 21 </span>
<span style="'.(($access['billprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 21%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno21']).'</span>
</span>
<span style="width: 32%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<span style="'.(($access['billbank']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Bank </span>
<span style="'.(($access['billbank']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['bank']).'</span>
<span style="'.(($access['billname']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Name </span>
<span style="'.(($access['billname']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['names']).'</span>
<span style="'.(($access['billaccnumber']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Account Number </span>
<span style="'.(($access['billaccnumber']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['accountnumber']).'</span>
<span style="'.(($access['billifsccode']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">IFSC Code </span>
<span style="'.(($access['billifsccode']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['ifsccode']).'</span>
<span style="'.(($access['billbranchandcity']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Branch & City </span>
<span style="'.(($access['billbranchandcity']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['branchandcity']).'</span>
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:2.8px;text-align: left;border-bottom:none;margin-bottom:-28px;">
<span style="width: 33%;display:inline-block;background-color:#eee;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:13px;white-space: nowrap;'.(((in_array('Billing Address', $fieldview))||(in_array('Billing Name', $fieldview)))?'':'visibility:hidden;').'"><strong>Bill '.((in_array('Billing Address', $fieldview))?'From':'').'</strong></span>
<span style="width: 33%;display:inline-block;background-color:#fff;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:13px;white-space: nowrap;"><strong>&nbsp;</strong></span>
<span style="width: 33.6%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"></span>
</div>
<div style="border:1px solid #cccccc;padding-top:3px;text-align: left;border-top:none;border-bottom:none;height:115px !important;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:6px 6px 3px 6px !important;margin-bottom:-22px;">
<br>
<strong style="'.(($rows[0]['vendorname']!=''&&(in_array('Billing Name', $fieldview)))?'':'visibility:hidden;').'font-weight:bold;font-size: 13px !important;display: inline-block;width: 245px;overflow: hidden;height: 15px;white-space: nowrap;">'.(($rows[0]['vendorname']!='')?((($rows[0]['vendorname']))):'').'</strong>
<span style="'.((in_array('Billing Address', $fieldview))?'':'visibility:hidden;').''.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['area']!='')||($rows[0]['city']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 245px;overflow: hidden;">'.((($rows[0]['area']))).' '.(((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'')).' '.((($rows[0]['city']))).'</span>
<span style="'.((in_array('Billing Address', $fieldview))?'':'visibility:hidden;').''.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 245px;overflow: hidden;">'.($rows[0]['state']).' '.(((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'')).' '.($rows[0]['pincode']).' '.(((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'')).' '.($rows[0]['district']).'</span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Work Phone </span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['workphone']).'</b></span>
<span style="'.((in_array('GSTIN', $fieldview))?'':'visibility:hidden;').''.(($infomainaccessuser['billprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['billprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.((in_array('GSTIN', $fieldview))?'':'visibility:hidden;').''.(($infomainaccessuser['billprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['billprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.(($infomainaccessuser['billprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['billprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?$rows[0]['gstno']:'').'</b></span>
<span style="'.((in_array('DL No 20', $fieldview))?'':'visibility:hidden;').''.(($infomainaccessuser['viewprintdlno20']=='show')||($rows[0]['dlno20']!='')&&($infomainaccessuser['viewprintdlno20']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 20 </span>
<span style="'.((in_array('DL No 20', $fieldview))?'':'visibility:hidden;').''.(($infomainaccessuser['viewprintdlno20']=='show')||($rows[0]['dlno20']!='')&&($infomainaccessuser['viewprintdlno20']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.(($infomainaccessuser['viewprintdlno20']=='show')||($rows[0]['dlno20']!='')&&($infomainaccessuser['viewprintdlno20']!='hide')&&(in_array('GSTIN', $fieldview))?$rows[0]['dlno20']:'').'</b></span>
<span style="'.((in_array('DL No 21', $fieldview))?'':'visibility:hidden;').''.(($infomainaccessuser['viewprintdlno21']=='show')||($rows[0]['dlno21']!='')&&($infomainaccessuser['viewprintdlno21']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 21 </span>
<span style="'.((in_array('DL No 21', $fieldview))?'':'visibility:hidden;').''.(($infomainaccessuser['viewprintdlno21']=='show')||($rows[0]['dlno21']!='')&&($infomainaccessuser['viewprintdlno21']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.(($infomainaccessuser['viewprintdlno21']=='show')||($rows[0]['dlno21']!='')&&($infomainaccessuser['viewprintdlno21']!='hide')&&(in_array('GSTIN', $fieldview))?$rows[0]['dlno21']:'').'</b></span>
</span>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:'.(((in_array('DL No 20', $fieldview))&&(in_array('DL No 21', $fieldview)))?'13px':'9px').' 6px 3px 6px !important;margin-bottom:-22px;vertical-align:top;border-top:none;"><br>
<strong style="visibility:hidden;font-weight:bold;font-size: 13px !important;display: inline-block;width: 245px;overflow: hidden;height: 15px;white-space: nowrap;"></strong>
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:0px;">Grand Total</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['invgrandtotal']).'</strong></span><span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).' Date</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($rows[0]['billdate']))).'</strong></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment Term</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['billterm']).'</strong></span>
<span style="visibility:hidden;'.((in_array('DL No 20', $fieldview))?'display: inline-block;':'display: none;').'white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment Term</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['billterm']).'</strong></span>
<span style="visibility:hidden;'.((in_array('DL No 21', $fieldview))?'display: inline-block;':'display: none;').'white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment Term</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['billterm']).'</strong></span>
</span>
<span style="width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:'.(((in_array('DL No 20', $fieldview))&&(in_array('DL No 21', $fieldview)))?'13px':'9px').' 6px 3px 6px !important;margin-bottom:-22px;vertical-align:top;">
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Invoice Number</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['invnumber']).'</strong></span><span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).' Date</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($rows[0]['billdate']))).'</strong></span>
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment Term</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['billterm']).'</strong></span>
<span style="visibility:hidden;'.((in_array('DL No 20', $fieldview))?'display: inline-block;':'display: none;').'white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment Term</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['billterm']).'</strong></span>
<span style="visibility:hidden;'.((in_array('DL No 21', $fieldview))?'display: inline-block;':'display: none;').'white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment Term</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['billterm']).'</strong></span>
</span>
</div>
</header>
<footer>
<div style="border:0px solid #cccccc;padding-top:30px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 20%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;'.(((in_array('Tax Informations', $fieldview)))?'border-left:1px solid #cccccc;':'border-left:0px solid #cccccc;;').'visibility:hidden">

</span>
<span style="margin-bottom:-16px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 20%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-37px;width: 46%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;'.(((in_array('Tax Informations', $fieldview)))?'border-left:1px solid #cccccc;':'border-left:0px solid #cccccc;;').'visibility:hidden">
<div style="'.(((in_array('Tax Informations', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;"><table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<th rowspan="2" style="border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></th>
<th colspan="2" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">CGST</th>
<th colspan="2" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">SGST</th>
<th colspan="4" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'">IGST</th>
<th colspan="2" style="font-size: 12px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;">GST</th>
</tr>
<tr>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
</tr>
<tbody style="font-size:10px !important;">';
$newtaxes=array();
$newcgst=array();
$newsgst=array();
$newigst=array();
$newgst=array();
$newgstpercent=array();
$newcsgstpercent=array();
$sqlitaxes=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='$billno' and billdate='$billdate' order by id asc");
while($infotaxes=mysqli_fetch_array($sqlitaxes)){
$anstax = $infotaxes['tax'];
$anscgst = $infotaxes['cgst'];
$anssgst = $infotaxes['sgst'];
$ansigst = $infotaxes['igst'];
$ansgst = $infotaxes['gst'];
$ansgstpercent = $infotaxes['gstpercent'];
$anscsgstpercent = $infotaxes['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
}
$finalbase = 4;
for ($i=1; $i <count($newtaxes) ; $i++) {
if ($i<=4) {
$finalbase--;
$html.='<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newtaxes[$i]).'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;">'.($newcgst[$i]).'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;">'.($newsgst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;">'.($newigst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newgst[$i]).'</span>
</td>
</tr>';
}
}
for($i=0;$i<$finalbase;$i++){
$html.='<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;"></span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
</tr>';
}
$html.='<tr>
<td colspan="6" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-16px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:86px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:86px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:86px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:86px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:0px;text-align: left;border-top:none;margin-bottom:-28px;border-bottom:none;">';
$number = number_format((float)$rows[0]['grandtotal'],2,'.','');
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "and Paise " . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
   $finals = "Rupees  " . $result ."". $points . " Only";
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-4px;visibility:hidden;">
<b style="width: 99.9%;display:inline-block;overflow:hidden;">Grand Total In Words : '.$finals.'</b>
</span>
<span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;visibility:hidden;">
<b style="width: 48%;display:inline-block;overflow:hidden;">Grand Total </b>
<b style="width: 50%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;position:relative;top:2px;">&#8377;</span> <span style="display:inline-block;width:86px;text-align:right;overflow:hidden;position:relative;top:5px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
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
<span style="display: inline-block;white-space: nowrap;width: 48%;font-size: 12px !important;text-align: center !important;position:relative;top:25px;">Printed </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:13px;"><b> </b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;font-size: 12px !important;text-align: center !important;position:relative;top:25px;font-weight:bold;left:63px;">Pages </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:13px;"><b> </b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;visibility:hidden;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
if ($info['signimage']!='') {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
}
else{
$signbase64 = '';
}
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
    if ($info['signimage']=='') {
        $html .= '<span style="width: 238px !important;height: 25px !important;display:inline-block;">&nbsp;</span>';
    }
$html .= '<span style="width: 103%;display:inline-block;margin-right: -4.5px;position:relative;top:3px;padding:6px 6px 10px 6px !important;font-size:12px;white-space: nowrap;text-align:center;overflow:hidden;">For '.($info['franchisename']).'</span>
</span>
</div>
</footer>';
$widthforitems = 105.5;
if(!in_array('Category', $fieldview)){
$widthforitems += 31;
}
if(!in_array('Hsn or Sac', $fieldview)){
$widthforitems += 48;
}
if($access['batchexpiryval']==0){
$widthforitems += 58;
}
if($access['batchexpiryval']==0){
$widthforitems += 35;
}
if(!in_array('Rate', $fieldview)){
$widthforitems += 45;
}
if(!in_array('Mrp', $fieldview)){
$widthforitems += 46;
}
if(!in_array('Discount', $fieldview)){
$widthforitems += 18;
}
if(!in_array('Quantity', $fieldview)){
$widthforitems += 18;
}
if(!in_array('Pack', $fieldview)){
$widthforitems += 18;
}
if(!in_array('GST Percentage', $fieldview)){
$widthforitems += 28;
}
if(!in_array('Taxable Value', $fieldview)){
$widthforitems += 47;
}
if(!in_array('Sale Quantity', $fieldview)){
$widthforitems += 25;
}
$html .= '
<div style="border: 0px solid #cccccc;width:100% !important;">
<table style="border: 0px solid #cccccc;width:100% !important;">
<thead style="background-color: #eee;">
<tr>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Item Details', $fieldview))?'':'display:none !important;').'text-align:left;min-width:'.($widthforitems).'px ;max-width:'.($widthforitems).'px ;">ITEM DETAILS</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Category', $fieldview))?'':'display:none !important;').'text-align: left;max-width:31px;min-width:31px;">'.($access['txtnamecategory']).'</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Hsn or Sac', $fieldview))?'':'display:none !important;').'text-align: left;max-width:48px;min-width:48px;">HSN/SAC</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'text-align: left;">BATCH</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'text-align: left;max-width:35px !important;min-width:35px !important;">EXPIRY</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('Mrp', $fieldview))?'':'display:none !important;').'">MRP</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('Rate', $fieldview))?'':'display:none !important;').'">RATE</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 3px !important;text-align: left !important;min-width:18px;max-width:18px;'.((in_array('Discount', $fieldview))?'':'display:none !important;').'">'.($access['txtprodisbill']).'</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;min-width:18px;max-width:18px;'.((in_array('Quantity', $fieldview))?'':'display:none !important;').'">'.($access['txtqtybill']).'</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: left !important;min-width:18px;max-width:18px;'.((in_array('Pack', $fieldview))?'':'display:none !important;').'">PACK</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('GST Percentage', $fieldview))?'':'display:none !important;').'max-width: 28px !important;min-width: 28px !important;">GST %</th>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align:right !important;min-width:47px;max-width:47px;">'.($access['txttaxablebill']).'</th>';
}
if ((in_array('Sale Quantity', $fieldview))) {
$html .= '<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;background-color: #1BBC9B;min-width:25px;max-width:25px;white-space:nowrap !important;">'.($access['txtsqty']).'</th>';
}
$html .= '</tr>
</thead>
<tbody>';
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
$netamount= (float)$row['productvalue']+$vatamount+$vatamount;
$html .= '<tr style="height:13px !important;">
    <td style="border: 1px solid #cccccc;padding:0px 3px !important;max-width: '.($widthforitems).'px  !important;min-width: '.($widthforitems).'px  !important;line-height: 18px;white-space: normal !important;font-size:13px;'.((in_array('Item Details', $fieldview))?'':'display:none !important;').'"><span style="display: block;font-size:13px !important;">'.($row['productname']).'</span>';
$html .= '
</td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 31px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Category', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;">'.((($row['manufacturer']!='')?$row['manufacturer']:'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 48px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Hsn or Sac', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['producthsn']!='')?$row['producthsn']:'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 58px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['batch']!='')?$row['batch']:'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 35px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['expdate']!='')?date($dateforexp,strtotime($row['expdate'])):'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;max-width: 46px !important;min-width: 46px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Mrp', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['mrp']!='0')?(number_format((float)$row['mrp'],2,'.','')):'0.00')).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;max-width: 45px !important;min-width: 45px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Rate', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['productrate']!='0')?(number_format((float)$row['productrate'],2,'.','')):'Free')).'</span></td>
   <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 3px !important;text-align: left;max-width: 18px !important;min-width: 18px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Discount', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['prodiscounttype']=='0')?($row['prodiscount']).'%':(number_format((float)$row['prodiscount'],2,'.','')))).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;max-width: 18px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Quantity', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.($row['quantity']).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: left;max-width: 18px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Pack', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.($row['noofpacks']).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;max-width: 28px !important;min-width: 28px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('GST Percentage', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.($row['vat']).'%</span></td>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align:right;max-width: 47px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;"><span style="display: block;overflow: hidden;height: 19px;">'.((number_format((float)$row['productvalue'],2,'.',''))).'</span></td>';
}
if ((in_array('Sale Quantity', $fieldview))) {
$html .= '<td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;max-width: 25px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;"><span style="display: block;overflow: hidden;height: 19px;">'.(($row['salequantity']!='0')?(number_format((float)$row['salequantity'],2,'.','')):'Free').'</span></td>';
}
$html .= '</tr>';
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
$outArr=array("timer"=>ceil(($countt-1)/500));
$jsonResponse=json_encode($outArr);
echo $jsonResponse;
$html .= '
</tbody>
</table>
</div>
<div id="footer" style="'.((($countt-1)==$totpros)?'visibility:visible;':'visibility:hidden;').'">
<p style="background-color:white;position:fixed;width:150%;margin:179px 0px 0px -18px;z-index:999999;">&nbsp;</p>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;">
<span style="margin-bottom:-35px;width: 20%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-37px;width: 46%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;'.(((in_array('Tax Informations', $fieldview)))?'border-left:1px solid #cccccc;':'border-left:0px solid #cccccc;;').'">
<div style="'.(((in_array('Tax Informations', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;"><table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<th rowspan="2" style="border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></th>
<th colspan="2" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">CGST</th>
<th colspan="2" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">SGST</th>
<th colspan="4" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'">IGST</th>
<th colspan="2" style="font-size: 12px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;">GST</th>
</tr>
<tr>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
</tr>
<tbody style="font-size:10px !important;">';
$newtaxes=array();
$newcgst=array();
$newsgst=array();
$newigst=array();
$newgst=array();
$newgstpercent=array();
$newcsgstpercent=array();
$sqlitaxes=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='$billno' and billdate='$billdate' order by id asc");
while($infotaxes=mysqli_fetch_array($sqlitaxes)){
$anstax = $infotaxes['tax'];
$anscgst = $infotaxes['cgst'];
$anssgst = $infotaxes['sgst'];
$ansigst = $infotaxes['igst'];
$ansgst = $infotaxes['gst'];
$ansgstpercent = $infotaxes['gstpercent'];
$anscsgstpercent = $infotaxes['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
}
$finalbase = 4;
for ($i=1; $i <count($newtaxes) ; $i++) {
if ($i<=4) {
$finalbase--;
$html.='<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newtaxes[$i]).'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 50px;overflow: hidden;">'.($newcgst[$i]).'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 50px;overflow: hidden;">'.($newsgst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 50px;overflow: hidden;">'.($newigst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newgst[$i]).'</span>
</td>
</tr>';
}
}
for($i=0;$i<$finalbase;$i++){
$html.='<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;"></span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 20px;overflow: hidden;"></span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 20px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 20px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;"></span>
</td>
</tr>';
}
$html.='<tr>
<td colspan="6" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-16px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:80px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:80px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:80px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:80px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:0px;text-align: left;border-top:none;margin-bottom:-28px;">';
$number = number_format((float)$rows[0]['grandtotal'],2,'.','');
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "and Paise " . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
   $finals = "Rupees  " . $result ."". $points . " Only";
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:13px;white-space: nowrap;margin-bottom:-4px;">
<b style="width: 99.9%;display:inline-block;overflow:hidden;">Grand Total In Words : '.$finals.'</b>
</span>
<span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;">
<b style="width: 48%;display:inline-block;overflow:hidden;">Grand Total </b>
<b style="width: 50%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;position:relative;top:2px;">&#8377;</span> <span style="display:inline-block;width:80px;text-align:right;overflow:hidden;position:relative;top:5px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
</span>
</div>
<br>
<div style="border:1px solid #cccccc;padding:0px !important;text-align: left;border-top:none;border-bottom:0px solid #cccccc;">';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
$html .= '<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;border-left: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;text-align:left;overflow:hidden;margin-top:10px;margin-bottom:-11px;">
<span style="display:block;height:23px;padding-left:36px;position:relative;top:6px;">Printed</span>
<span style="width: 1%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp;</span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:center;overflow:hidden;width:95%;position:relative;top:-9px;left:-10px;">Pages</strong>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;left:3px;">'.(((in_array('Terms and Conditions', $fieldview)))?'Terms and Conditions ':'').'</span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;"><b>'.(((in_array('Terms and Conditions', $fieldview)))?': '.($rows[0]['terms']):'').'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
if ($info['signimage']!='') {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
}
else{
$signbase64 = '';
}
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 230px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
    if ($info['signimage']=='') {
        $html .= '<span style="width: 230px !important;height: 25px !important;display:inline-block;">&nbsp;</span>';
    }
$html .= '<span style="width: 103%;display:inline-block;margin-right: -4.5px;position:relative;top:3px;padding:6px 6px 10px 6px !important;font-size:12px;white-space: nowrap;text-align:center;overflow:hidden;">For '.($info['franchisename']).'</span>
</span>
</div>
</div>
</body>
</html>';
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dates = date('d-m-Y h:i:s');
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
$mask = 'dompdf/Bills-*.*';
array_map('unlink', glob($mask));
$output = $dompdf->output();
file_put_contents("dompdf/".$_GET['names'].".pdf", $output);
} 
if (($_GET['term']=='bill')&&($_GET['sizes']=='a5')) {
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
include('lcheck.php');
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='0')) {
$dateforexp = '';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'd/m/Y';
}
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'm/Y';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'd/Y';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='0')) {
$dateforexp = 'd/m';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='0')) {
$dateforexp = 'd';
}
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='0')) {
$dateforexp = 'm';
}
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'Y';
}
}
$sqlismainaccessuserinv=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Invoices' order by id  asc");
$infomainaccessuserinv=mysqli_fetch_array($sqlismainaccessuserinv);
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Bills' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Bills' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}

$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Bills' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
 if((isset($_GET['billno']))&&(isset($_GET['billdate'])))
 {
     $billno=mysqli_real_escape_string($con, $_GET['billno']);
     $billdate=mysqli_real_escape_string($con, $_GET['billdate']);
 $sql=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='$billno' and billdate='$billdate' order by id asc");
$count=1;
if(mysqli_num_rows($sql)>0)
{
$rows = array();
while($row = mysqli_fetch_assoc($sql)){ 
$rows[] = $row;
}
$sqliet=mysqli_query($con, "select * from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$info=mysqli_fetch_array($sqliet);
$businesstype=0;
}
}
$html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.($_GET['names']).'</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<style>@page { margin: 60px; }body { font-family: "Myriad Set Pro","Helvetica Neue",Helvetica,Arial,sans-serif;margin: 204px -30px 154.5px -30px;word-wrap: break-word;border:1px solid #cccccc;}table {border-collapse: collapse;}header{position: fixed;top: -29px;height: max-content;width:108.8%;margin-left:-1px;color: black;text-align: center;}footer{position: fixed;bottom: -25px;height: max-content;width:108.8%;margin-left:-1px;color: black;text-align: center;}#footer{position: absolute;bottom: -33px;height: max-content;width:108.8%;margin-left:-1px;color: black;text-align: center;}.ribbon-wrapper {width: 185px;height: 188px;overflow: hidden;position: absolute;top: -3px;left: -3px;}.ribbon {font: bold 15px Sans-Serif;color: #333;text-align: center;text-shadow: rgba(255, 255, 255, 0.5) 0 1px 0;position: relative;padding: 7px 0;transform: rotate(-45deg);left: -42px;top: 32px;width: 180px;background-color: #BFDC7A;box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);}.ribbon:before, .ribbon:after {content: "";border-top: 3px solid #6e8900;border-left: 3px solid transparent;border-right: 3px solid transparent;position: absolute;bottom: -3px;}.ribbon:before {left: 0;}.ribbon:after {right: 0;}</style>
</head>
<body>
<header>';
$html .= '
<div style="border:1px solid #cccccc;border-bottom:none;">
<div><b style="font-size:15px !important;">'.($infomainaccessuser['modulename']).'</b></div>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-23px;">
<span style="width: 13%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:9px 6px !important;text-align:right;margin-top:18px;height:80px;">';
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
if ($info['branchimage']!='') {
$franchpath = (str_replace('../ups','ups',$img));
$franchtype = pathinfo($franchpath, PATHINFO_EXTENSION);
$franchdata = file_get_contents($franchpath);
$franchbase64 = 'data:image/' . $franchtype . ';base64,' . base64_encode($franchdata);
}
else{
$franchbase64 = '';
}
    $html .= '<img alt="Branch Pic" src="'.($franchbase64).'" id="branch-image1" height="80" width="80" style="'.(($info['branchimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '</span>
<span style="width: 50%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.($info['franchisename']).'</strong>
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 360px;overflow: hidden;white-space: nowrap;">'.($info['street']).' '.($info['city']).' '.($info['pincode']).' '.($info['state']).' '.($info['country']).' </span>
<span style="'.(($access['billbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 10%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Phone </span>
<span style="'.(($access['billbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 88%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
<span style="'.(($access['billbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 10%;overflow: hidden;font-size: 12px !important;text-align: left !important;">E-mail </span>
<span style="'.(($access['billbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 51%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['email']).'</span>
<span style="'.(($access['billprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 14%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 20 </span>
<span style="'.(($access['billprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 21%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno20']).'</span>
<span style="'.(($access['billbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 10%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($access['billbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 51%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['gstno']).'</span>
<span style="'.(($access['billprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 14%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 21 </span>
<span style="'.(($access['billprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 21%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno21']).'</span>
</span>
<span style="width: 32%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<span style="'.(($access['billbank']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Bank </span>
<span style="'.(($access['billbank']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['bank']).'</span>
<span style="'.(($access['billname']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Name </span>
<span style="'.(($access['billname']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['names']).'</span>
<span style="'.(($access['billaccnumber']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Account Number </span>
<span style="'.(($access['billaccnumber']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['accountnumber']).'</span>
<span style="'.(($access['billifsccode']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">IFSC Code </span>
<span style="'.(($access['billifsccode']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['ifsccode']).'</span>
<span style="'.(($access['billbranchandcity']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Branch & City </span>
<span style="'.(($access['billbranchandcity']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['branchandcity']).'</span>
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:2.8px;text-align: left;border-bottom:none;margin-bottom:-28px;">
<span style="width: 33%;display:inline-block;background-color:#eee;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:13px;white-space: nowrap;'.(((in_array('Billing Address', $fieldview))||(in_array('Billing Name', $fieldview)))?'':'visibility:hidden;').'"><strong>Bill '.((in_array('Billing Address', $fieldview))?'From':'').'</strong></span>
<span style="width: 33%;display:inline-block;background-color:#fff;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:13px;white-space: nowrap;"><strong>&nbsp;</strong></span>
<span style="width: 33.6%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"></span>
</div>
<div style="border:1px solid #cccccc;padding-top:3px;text-align: left;border-top:none;border-bottom:none;height:115px !important;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:3px 6px !important;margin-bottom:-22px;">
<br>
<strong style="'.(($rows[0]['vendorname']!=''&&(in_array('Billing Name', $fieldview)))?'':'visibility:hidden;').'font-weight:bold;font-size: 13px !important;display: inline-block;width: 245px;overflow: hidden;height: 15px;white-space: nowrap;">'.(($rows[0]['vendorname']!='')?((($rows[0]['vendorname']))):'').'</strong>
<span style="'.((in_array('Billing Address', $fieldview))?'':'visibility:hidden;').''.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['area']!='')||($rows[0]['city']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 245px;overflow: hidden;">'.((($rows[0]['area']))).' '.(((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'')).' '.((($rows[0]['city']))).'</span>
<span style="'.((in_array('Billing Address', $fieldview))?'':'visibility:hidden;').''.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 245px;overflow: hidden;">'.($rows[0]['state']).' '.(((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'')).' '.($rows[0]['pincode']).' '.(((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'')).' '.($rows[0]['district']).'</span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Work Phone </span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['workphone']).'</b></span>
<span style="'.((in_array('GSTIN', $fieldview))?'':'visibility:hidden;').''.(($infomainaccessuser['billprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['billprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.((in_array('GSTIN', $fieldview))?'':'visibility:hidden;').''.(($infomainaccessuser['billprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['billprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.(($infomainaccessuser['billprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['billprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?$rows[0]['gstno']:'').'</b></span>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;margin-bottom:-22px;vertical-align:middle;border-top:none;"><br>
<strong style="visibility:hidden;font-weight:bold;font-size: 13px !important;display: inline-block;width: 253px;overflow: hidden;height: 15px;white-space: nowrap;"></strong>
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:0px;">Grand Total</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['invgrandtotal']).'</strong></span><span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).' Date</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($rows[0]['billdate']))).'</strong></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment Term</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['billterm']).'</strong></span>
</span>
<span style="width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;margin-bottom:-22px;vertical-align:middle;">
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Invoice Number</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['invnumber']).'</strong></span><span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).' Date</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($rows[0]['billdate']))).'</strong></span>
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment Term</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['billterm']).'</strong></span>
</span>
</div>
</header>
<footer>
<div style="border:0px solid #cccccc;padding-top:30px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 20%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;'.(((in_array('Tax Informations', $fieldview)))?'border-left:1px solid #cccccc;':'border-left:0px solid #cccccc;;').'visibility:hidden">

</span>
<span style="margin-bottom:-16px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 20%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-37px;width: 46%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;'.(((in_array('Tax Informations', $fieldview)))?'border-left:1px solid #cccccc;':'border-left:0px solid #cccccc;;').'visibility:hidden">
<div style="'.(((in_array('Tax Informations', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;"><table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<th rowspan="2" style="border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></th>
<th colspan="2" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">CGST</th>
<th colspan="2" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">SGST</th>
<th colspan="4" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'">IGST</th>
<th colspan="2" style="font-size: 12px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;">GST</th>
</tr>
<tr>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
</tr>
<tbody style="font-size:10px !important;">';
$newtaxes=array();
$newcgst=array();
$newsgst=array();
$newigst=array();
$newgst=array();
$newgstpercent=array();
$newcsgstpercent=array();
$sqlitaxes=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='$billno' and billdate='$billdate' order by id asc");
while($infotaxes=mysqli_fetch_array($sqlitaxes)){
$anstax = $infotaxes['tax'];
$anscgst = $infotaxes['cgst'];
$anssgst = $infotaxes['sgst'];
$ansigst = $infotaxes['igst'];
$ansgst = $infotaxes['gst'];
$ansgstpercent = $infotaxes['gstpercent'];
$anscsgstpercent = $infotaxes['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
}
$finalbase = 4;
for ($i=1; $i <count($newtaxes) ; $i++) {
if ($i<=4) {
$finalbase--;
$html.='<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newtaxes[$i]).'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;">'.($newcgst[$i]).'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;">'.($newsgst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;">'.($newigst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newgst[$i]).'</span>
</td>
</tr>';
}
}
for($i=0;$i<$finalbase;$i++){
$html.='<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;"></span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
</tr>';
}
$html.='<tr>
<td colspan="6" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-16px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:86px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:86px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:86px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:86px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:0px;text-align: left;border-top:none;margin-bottom:-28px;border-bottom:none;">';
$number = number_format((float)$rows[0]['grandtotal'],2,'.','');
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "and Paise " . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
   $finals = "Rupees  " . $result ."". $points . " Only";
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-4px;visibility:hidden;">
<b style="width: 99.9%;display:inline-block;overflow:hidden;">Grand Total In Words : '.$finals.'</b>
</span>
<span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;visibility:hidden;">
<b style="width: 48%;display:inline-block;overflow:hidden;">Grand Total </b>
<b style="width: 50%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;position:relative;top:2px;">&#8377;</span> <span style="display:inline-block;width:86px;text-align:right;overflow:hidden;position:relative;top:5px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
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
<span style="display: inline-block;white-space: nowrap;width: 48%;;font-size: 12px !important;text-align: center !important;position:relative;top:25px;">Printed </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;font-size: 12px !important;text-align: left !important;position:relative;top:13px;"><b> </b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;;font-size: 12px !important;text-align: center !important;position:relative;top:25px;font-weight:bold;left:63px;">Pages </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;font-size: 12px !important;text-align: left !important;position:relative;top:13px;"><b> </b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;visibility:hidden;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
if ($info['signimage']!='') {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
}
else{
$signbase64 = '';
}
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
    if ($info['signimage']=='') {
        $html .= '<span style="width: 238px !important;height: 25px !important;display:inline-block;">&nbsp;</span>';
    }
$html .= '<span style="width: 103%;display:inline-block;margin-right: -4.5px;position:relative;top:3px;padding:6px 6px 10px 6px !important;font-size:12px;white-space: nowrap;text-align:center;overflow:hidden;">For '.($info['franchisename']).'</span>
</span>
</div>
</footer>';
$widthforitems = 98;
if(!in_array('Category', $fieldview)){
$widthforitems += 35;
}
if(!in_array('Hsn or Sac', $fieldview)){
$widthforitems += 48;
}
if($access['batchexpiryval']==0){
$widthforitems += 35;
}
if($access['batchexpiryval']==0){
$widthforitems += 35;
}
if(!in_array('Rate', $fieldview)){
$widthforitems += 47;
}
if(!in_array('Mrp', $fieldview)){
$widthforitems += 11;
}
if(!in_array('Quantity', $fieldview)){
$widthforitems += 34;
}
if(!in_array('Pack', $fieldview)){
$widthforitems += 18;
}
if(!in_array('GST Percentage', $fieldview)){
$widthforitems += 28;
}
if(!in_array('Taxable Value', $fieldview)){
$widthforitems += 47;
}
if(!in_array('Sale Quantity', $fieldview)){
$widthforitems += 85;
}
$html .= '
<div style="border: 0px solid #cccccc;width:100% !important;">
<table style="border: 0px solid #cccccc;width:100% !important;">
<thead style="background-color: #eee;">
<tr>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Item Details', $fieldview))?'':'display:none !important;').'text-align:left;min-width:'.($widthforitems).'px ;max-width:'.($widthforitems).'px ;">ITEM DETAILS</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Category', $fieldview))?'':'display:none !important;').'text-align: left;max-width:31px;min-width:31px;">'.($access['txtnamecategory']).'</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Hsn or Sac', $fieldview))?'':'display:none !important;').'text-align: left;max-width:48px;min-width:48px;">HSN/SAC</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'text-align: left;">BATCH</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'text-align: left;max-width:35px !important;min-width:35px !important;">EXPIRY</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('Mrp', $fieldview))?'':'display:none !important;').'">MRP</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('Rate', $fieldview))?'':'display:none !important;').'">RATE</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 3px !important;text-align: left !important;min-width:18px;max-width:18px;'.((in_array('Discount', $fieldview))?'':'display:none !important;').'">'.($access['txtprodisbill']).'</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;min-width:18px;max-width:18px;'.((in_array('Quantity', $fieldview))?'':'display:none !important;').'">'.($access['txtqtybill']).'</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: left !important;min-width:18px;max-width:18px;'.((in_array('Pack', $fieldview))?'':'display:none !important;').'">PACK</th>
<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('GST Percentage', $fieldview))?'':'display:none !important;').'max-width: 28px !important;min-width: 28px !important;">GST %</th>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align:right !important;min-width:47px;max-width:47px;">'.($access['txttaxablebill']).'</th>';
}
if ((in_array('Sale Quantity', $fieldview))) {
$html .= '<th style="border: 1px solid #cccccc;overflow:hidden;white-space: nowrap !important;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;background-color: #1BBC9B;min-width:25px;max-width:25px;white-space:nowrap !important;">'.($access['txtsqty']).'</th>';
}
$html .= '</tr>
</thead>
<tbody>';
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
$netamount= (float)$row['productvalue']+$vatamount+$vatamount;
$html .= '<tr style="height:13px !important;">
    <td style="border: 1px solid #cccccc;padding:0px 3px !important;max-width: '.($widthforitems).'px  !important;min-width: '.($widthforitems).'px  !important;line-height: 18px;white-space: normal !important;font-size:13px;'.((in_array('Item Details', $fieldview))?'':'display:none !important;').'"><span style="display: block;font-size:13px !important;">'.($row['productname']).'</span>';
$html .= '
</td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 31px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Category', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;">'.((($row['manufacturer']!='')?$row['manufacturer']:'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 48px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Hsn or Sac', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['producthsn']!='')?$row['producthsn']:'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 58px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['batch']!='')?$row['batch']:'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 35px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['expdate']!='')?date($dateforexp,strtotime($row['expdate'])):'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;max-width: 46px !important;min-width: 46px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Mrp', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['mrp']!='0')?(number_format((float)$row['mrp'],2,'.','')):'0.00')).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;max-width: 45px !important;min-width: 45px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Rate', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['productrate']!='0')?(number_format((float)$row['productrate'],2,'.','')):'Free')).'</span></td>
   <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 3px !important;text-align: left;max-width: 18px !important;min-width: 18px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Discount', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.((($row['prodiscounttype']=='0')?($row['prodiscount']).'%':(number_format((float)$row['prodiscount'],2,'.','')))).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;max-width: 18px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Quantity', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.($row['quantity']).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: left;max-width: 18px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Pack', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.($row['noofpacks']).'</span></td>
    <td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;max-width: 28px !important;min-width: 28px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('GST Percentage', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 19px;">'.($row['vat']).'%</span></td>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align:right;max-width: 47px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;"><span style="display: block;overflow: hidden;height: 19px;">'.((number_format((float)$row['productvalue'],2,'.',''))).'</span></td>';
}
if ((in_array('Sale Quantity', $fieldview))) {
$html .= '<td style="font-size: 12px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;max-width: 25px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;"><span style="display: block;overflow: hidden;height: 19px;">'.(($row['salequantity']!='0')?(number_format((float)$row['salequantity'],2,'.','')):'Free').'</span></td>';
}
$html .= '</tr>';
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
$outArr=array("timer"=>ceil(($countt-1)/500));
$jsonResponse=json_encode($outArr);
echo $jsonResponse;
$html .= '
</tbody>
</table>
</div>
<div id="footer" style="'.((($countt-1)==$totpros)?'visibility:visible;':'visibility:hidden;').'">
<p style="background-color:white;position:fixed;width:150%;margin:179px 0px 0px -18px;z-index:999999;">&nbsp;</p>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;">
<span style="margin-bottom:-35px;width: 20%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-37px;width: 46%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;'.(((in_array('Tax Informations', $fieldview)))?'border-left:1px solid #cccccc;':'border-left:0px solid #cccccc;;').'">
<div style="'.(((in_array('Tax Informations', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;"><table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<th rowspan="2" style="border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></th>
<th colspan="2" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">CGST</th>
<th colspan="2" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">SGST</th>
<th colspan="4" style="border-right: 1px solid #cccccc;font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'">IGST</th>
<th colspan="2" style="font-size: 12px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;">GST</th>
</tr>
<tr>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border: 1px solid #999 !important;text-align: center !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;"><b>%</b></th>
<th style="border: 1px solid #999 !important;text-align: right !important;background-color: #e9ecef !important;font-size: 12px !important;padding: 0px 3px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
</tr>
<tbody style="font-size:10px !important;">';
$newtaxes=array();
$newcgst=array();
$newsgst=array();
$newigst=array();
$newgst=array();
$newgstpercent=array();
$newcsgstpercent=array();
$sqlitaxes=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='$billno' and billdate='$billdate' order by id asc");
while($infotaxes=mysqli_fetch_array($sqlitaxes)){
$anstax = $infotaxes['tax'];
$anscgst = $infotaxes['cgst'];
$anssgst = $infotaxes['sgst'];
$ansigst = $infotaxes['igst'];
$ansgst = $infotaxes['gst'];
$ansgstpercent = $infotaxes['gstpercent'];
$anscsgstpercent = $infotaxes['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
}
$finalbase = 4;
for ($i=1; $i <count($newtaxes) ; $i++) {
if ($i<=4) {
$finalbase--;
$html.='<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newtaxes[$i]).'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 20px;overflow: hidden;">'.($newcgst[$i]).'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 20px;overflow: hidden;">'.($newsgst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 20px;overflow: hidden;">'.($newigst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newgst[$i]).'</span>
</td>
</tr>';
}
}
for($i=0;$i<$finalbase;$i++){
$html.='<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;"></span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 20px;overflow: hidden;"></span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 20px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;border-right: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 20px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;"></span>
</td>
</tr>';
}
$html.='<tr>
<td colspan="6" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-16px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:80px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:80px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:80px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:80px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:0px;text-align: left;border-top:none;margin-bottom:-28px;">';
$number = number_format((float)$rows[0]['grandtotal'],2,'.','');
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "and Paise " . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
   $finals = "Rupees  " . $result ."". $points . " Only";
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:13px;white-space: nowrap;margin-bottom:-4px;">
<b style="width: 99.9%;display:inline-block;overflow:hidden;">Grand Total In Words : '.$finals.'</b>
</span>
<span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;">
<b style="width: 48%;display:inline-block;overflow:hidden;">Grand Total </b>
<b style="width: 50%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;position:relative;top:2px;">&#8377;</span> <span style="display:inline-block;width:80px;text-align:right;overflow:hidden;position:relative;top:5px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
</span>
</div>
<br>
<div style="border:1px solid #cccccc;padding:0px !important;text-align: left;border-top:none;border-bottom:0px solid #cccccc;">';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
$html .= '<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;border-left: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;text-align:left;overflow:hidden;margin-top:10px;margin-bottom:-11px;">
<span style="display:block;height:23px;padding-left:36px;position:relative;top:6px;">Printed</span>
<span style="width: 1%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp;</span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:center;overflow:hidden;width:95%;position:relative;top:-9px;left:-10px;">Pages</strong>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;left:3px;">'.(((in_array('Terms and Conditions', $fieldview)))?'Terms and Conditions ':'').'</span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;"><b>'.(((in_array('Terms and Conditions', $fieldview)))?': '.($rows[0]['terms']):'').'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
if ($info['signimage']!='') {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
}
else{
$signbase64 = '';
}
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 230px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
    if ($info['signimage']=='') {
        $html .= '<span style="width: 230px !important;height: 25px !important;display:inline-block;">&nbsp;</span>';
    }
$html .= '<span style="width: 103%;display:inline-block;margin-right: -4.5px;position:relative;top:3px;padding:6px 6px 10px 6px !important;font-size:12px;white-space: nowrap;text-align:center;overflow:hidden;">For '.($info['franchisename']).'</span>
</span>
</div>
</div>
</body>
</html>';
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'landscape');
$dompdf->render();
$dates = date('d-m-Y h:i:s');
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
$mask = 'dompdf/Bills-*.*';
array_map('unlink', glob($mask));
$output = $dompdf->output();
file_put_contents("dompdf/".$_GET['names'].".pdf", $output);
} 
if (($_GET['term']=='bill')&&($_GET['sizes']=='dt')) {
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
include('lcheck.php');
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='0')) {
$dateforexp = '';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'd/m/Y';
}
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'm/Y';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'd/Y';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='0')) {
$dateforexp = 'd/m';
}
if (($access['billprintexpdate']=='1')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='0')) {
$dateforexp = 'd';
}
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='1')&&($access['billprintexpyear']=='0')) {
$dateforexp = 'm';
}
if (($access['billprintexpdate']=='0')&&($access['billprintexpmonth']=='0')&&($access['billprintexpyear']=='1')) {
$dateforexp = 'Y';
}
}
$sqlismainaccessuserinv=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Invoices' order by id  asc");
$infomainaccessuserinv=mysqli_fetch_array($sqlismainaccessuserinv);
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Bills' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Bills' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}

$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Bills' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
 if((isset($_GET['billno']))&&(isset($_GET['billdate'])))
 {
     $billno=mysqli_real_escape_string($con, $_GET['billno']);
     $billdate=mysqli_real_escape_string($con, $_GET['billdate']);
 $sql=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='$billno' and billdate='$billdate' order by id asc");
$count=1;
if(mysqli_num_rows($sql)>0)
{
$rows = array();
while($row = mysqli_fetch_assoc($sql)){ 
$rows[] = $row;
}
$sqliet=mysqli_query($con, "select * from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$info=mysqli_fetch_array($sqliet);
$businesstype=0;
}
}
$html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.($_GET['names']).'</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<style>@page { size: 15.75cm 24.13cm landscape; margin:60px;}body { font-family: "Myriad Set Pro","Helvetica Neue",Helvetica,Arial,sans-serif;margin: 190px -30px 120px -30px;word-wrap: break-word;border:1px dashed #000000;}table {border-collapse: collapse;}header{position: fixed;top: -32px;height: max-content;width:107.6%;margin-left:-1px;color: black;text-align: center;}footer{position: fixed;bottom: -33px;height: max-content;width:107.6%;margin-left:-1px;color: black;text-align: center;}#footer{position: absolute;bottom: -41px;height: max-content;width:107.6%;margin-left:-1px;color: black;text-align: center;}.ribbon-wrapper {width: 185px;height: 188px;overflow: hidden;position: absolute;top: -3px;left: -3px;}.ribbon {font: bold 15px Sans-Serif;color: #333;text-align: center;text-shadow: rgba(255, 255, 255, 0.5) 0 1px 0;position: relative;padding: 7px 0;transform: rotate(-45deg);left: -42px;top: 32px;width: 180px;background-color: #BFDC7A;box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);}.ribbon:before, .ribbon:after {content: "";border-top: 3px dashed #6e8900;border-left: 3px dashed transparent;border-right: 3px dashed transparent;position: absolute;bottom: -3px;}.ribbon:before {left: 0;}.ribbon:after {right: 0;}</style>
</head>
<body>
<header>';
$html .= '
<div style="border:1px dashed #000000;border-bottom:none;">
<div><b style="font-size:15px !important;">'.($infomainaccessuser['modulename']).'</b></div>
</div>
<div style="border:1px dashed #000000;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-23px;">
<span style="width: 16%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:9px 6px !important;text-align:right;margin-top:18px;height:80px;">';
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
if ($info['branchimage']!='') {
$franchpath = (str_replace('../ups','ups',$img));
$franchtype = pathinfo($franchpath, PATHINFO_EXTENSION);
$franchdata = file_get_contents($franchpath);
$franchbase64 = 'data:image/' . $franchtype . ';base64,' . base64_encode($franchdata);
}
else{
$franchbase64 = '';
}
    $html .= '<img alt="Branch Pic" src="'.($franchbase64).'" id="branch-image1" height="80" width="80" style="'.(($info['branchimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '</span>
<span style="width: 50%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.($info['franchisename']).'</strong>
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 430px;overflow: hidden;white-space: nowrap;">'.($info['street']).' '.($info['city']).' '.($info['pincode']).' '.($info['state']).' '.($info['country']).' </span>
<span style="'.(($access['billbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 10%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Phone </span>
<span style="'.(($access['billbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 88%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
<span style="'.(($access['billbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 10%;overflow: hidden;font-size: 12px !important;text-align: left !important;">E-mail </span>
<span style="'.(($access['billbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 51%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['email']).'</span>
<span style="'.(($access['billprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 14%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 20 </span>
<span style="'.(($access['billprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 21%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno20']).'</span>
<span style="'.(($access['billbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 10%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($access['billbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 51%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['gstno']).'</span>
<span style="'.(($access['billprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 14%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 21 </span>
<span style="'.(($access['billprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 21%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno21']).'</span>
</span>
<span style="width: 30%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<span style="'.(($access['billbank']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 35%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Bank </span>
<span style="'.(($access['billbank']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 63%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['bank']).'</span>
<span style="'.(($access['billname']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 35%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Name </span>
<span style="'.(($access['billname']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 63%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['names']).'</span>
<span style="'.(($access['billaccnumber']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 35%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Account Number </span>
<span style="'.(($access['billaccnumber']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 63%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['accountnumber']).'</span>
<span style="'.(($access['billifsccode']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 35%;overflow: hidden;font-size: 12px !important;text-align: left !important;">IFSC Code </span>
<span style="'.(($access['billifsccode']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 63%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['ifsccode']).'</span>
<span style="'.(($access['billbranchandcity']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 35%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Branch & City </span>
<span style="'.(($access['billbranchandcity']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 63%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['branchandcity']).'</span>
</span>
</div>
<div style="border:1px dashed #000000;padding-top:2.8px;text-align: left;border-bottom:none;margin-bottom:-33px;">
<span style="width: 33%;display:inline-block;background-color:#fff;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:13px;white-space: nowrap;'.(((in_array('Billing Address', $fieldview))||(in_array('Billing Name', $fieldview)))?'':'visibility:hidden;').'"><strong>Bill '.((in_array('Billing Address', $fieldview))?'From':'').'</strong></span>
<span style="width: 33%;display:inline-block;background-color:#fff;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:13px;white-space: nowrap;"><strong>&nbsp;</strong></span>
<span style="width: 33.6%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;"></span>
</div>
<div style="border:1px dashed #000000;padding-top:3px;text-align: left;border-top:none;border-bottom:none;height:115px !important;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:3px 6px !important;margin-bottom:-22px;">
<br>
<strong style="'.(($rows[0]['vendorname']!=''&&(in_array('Billing Name', $fieldview)))?'':'visibility:hidden;').'font-weight:bold;font-size: 13px !important;display: inline-block;width: 293px;overflow: hidden;height: 15px;white-space: nowrap;">'.(($rows[0]['vendorname']!='')?((($rows[0]['vendorname']))):'').'</strong>
<span style="'.((in_array('Billing Address', $fieldview))?'':'visibility:hidden;').''.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['area']!='')))))?'':'visibility:hidden;').'white-space: normal;font-size:12px;display: inline-block;width: 293px;overflow: hidden;min-height:30px;max-height:30px;line-height:13.8px;">'.((($rows[0]['area']))).'</span>
<span style="'.((in_array('Billing Address', $fieldview))?'':'visibility:hidden;').''.(((($rows[0]['city']!='')||($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!='')||($rows[0]['city']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 293px;overflow: hidden;height:15px;"><span style="font-size: 12px;display: inline-flex;max-width: 111px;overflow: hidden;">'.($rows[0]['city']).'</span> '.(((($rows[0]['city']!='')&&($rows[0]['state']!=''))?',':'')).' <span style="font-size: 12px;display: inline-flex;max-width: 60px;overflow: hidden;">'.($rows[0]['state']).'</span> '.(((($rows[0]['city']!='')&&($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'')).' <span style="font-size: 12px;display: inline-flex;max-width: 39px;overflow: hidden;">'.($rows[0]['pincode']).'</span> '.(((($rows[0]['city']!='')&&($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'')).' <span style="font-size: 12px;display: inline-flex;max-width: 30px;overflow: hidden;">'.($rows[0]['district']).'</span></span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:-3px;">Work Phone </span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:-3px;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['workphone']).'</b></span>
<span style="'.((in_array('GSTIN', $fieldview))?'':'visibility:hidden;').''.(($infomainaccessuser['billprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['billprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:-10px;">GSTIN </span>
<span style="'.((in_array('GSTIN', $fieldview))?'':'visibility:hidden;').''.(($infomainaccessuser['billprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['billprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:-10px;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.(($infomainaccessuser['billprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['billprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?$rows[0]['gstno']:'').'</b></span>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;margin-bottom:-22px;vertical-align:middle;border-top:none;"><br>
<strong style="visibility:hidden;font-weight:bold;font-size: 13px !important;display: inline-block;width: 253px;overflow: hidden;height: 15px;white-space: nowrap;"></strong>
<span style="display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:-3px;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:0px;">Grand Total</span></span>
<span style="display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:-3px;"><strong>: '.($rows[0]['invgrandtotal']).'</strong></span><span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).' Date</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($rows[0]['billdate']))).'</strong></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment Term</span></span>
<span style="visibility:hidden;display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['billterm']).'</strong></span>
</span>
<span style="width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;margin-bottom:-22px;vertical-align:middle;">
<span style="display: inline-block;white-space: nowrap;position:relative;top:-6px;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Invoice Number</span></span>
<span style="display: inline-block;white-space: nowrap;position:relative;top:-6px;width: 42%;overflow: hidden;font-size: 20px !important;text-align: left !important;"><strong>: '.($rows[0]['invnumber']).'</strong></span><span style="display: inline-block;white-space: nowrap;position:relative;top:-6px;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).' Date</span></span>
<span style="display: inline-block;white-space: nowrap;position:relative;top:-6px;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($rows[0]['billdate']))).'</strong></span>
<span style="display: inline-block;white-space: nowrap;position:relative;top:-6px;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 96%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment Term</span></span>
<span style="display: inline-block;white-space: nowrap;position:relative;top:-6px;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['billterm']).'</strong></span>
</span>
</div>
</header>
<footer>
<div style="border:0px dashed #000000;padding-top:30px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 20%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px dashed #000000;visibility:hidden">

</span>
<span style="margin-bottom:-16px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">

</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px dashed #000000;padding-top:5px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 20%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-37px;width: 46%;display:inline-block;margin-right: -4.5px;border-right: 1px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px dashed #000000;visibility:hidden">
<div style="'.(((in_array('Tax Informations', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;"><table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px dashed #000000;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #fff;" class="text-uppercase">
<th rowspan="2" style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 12px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></th>
<th colspan="2" style="font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">CGST</th>
<th colspan="2" style="font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">SGST</th>
<th colspan="4" style="font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'">IGST</th>
<th colspan="2" style="font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;">GST</th>
</tr>
<tr>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: center !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: center !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: center !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b>%</b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: center !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;"><b>%</b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
</tr>
<tbody style="font-size:10px !important;">';
$newtaxes=array();
$newcgst=array();
$newsgst=array();
$newigst=array();
$newgst=array();
$newgstpercent=array();
$newcsgstpercent=array();
$sqlitaxes=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='$billno' and billdate='$billdate' order by id asc");
while($infotaxes=mysqli_fetch_array($sqlitaxes)){
$anstax = $infotaxes['tax'];
$anscgst = $infotaxes['cgst'];
$anssgst = $infotaxes['sgst'];
$ansigst = $infotaxes['igst'];
$ansgst = $infotaxes['gst'];
$ansgstpercent = $infotaxes['gstpercent'];
$anscsgstpercent = $infotaxes['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
}
$finalbase = 4;
for ($i=1; $i <count($newtaxes) ; $i++) {
if ($i<=4) {
$finalbase--;
$html.='<tr>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newtaxes[$i]).'</span>
</td>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.($newcgst[$i]).'</span>
</td>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.($newsgst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;font-size: 10px !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.($newigst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;font-size: 10px !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;padding-right: 15px;">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newgst[$i]).'</span>
</td>
</tr>';
}
}
for($i=0;$i<$finalbase;$i++){
$html.='<tr>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;"></span>
</td>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;font-size: 10px !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
</td>
<td style="padding: 0px 3px !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;font-size: 10px !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;padding-right: 15px;">
</td>
<td style="padding: 0px 3px !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;"></span>
</td>
</tr>';
}
$html.='<tr>
<td colspan="6" style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-16px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:103px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:103px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:103px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:103px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>
<div style="border:1px dashed #000000;padding-top:0px;text-align: left;border-top:none;margin-bottom:-28px;border-bottom:none;">';
$number = number_format((float)$rows[0]['grandtotal'],2,'.','');
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "and Paise " . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
   $finals = "Rupees  " . $result ."". $points . " Only";
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-4px;visibility:hidden;">
<b style="width: 99.9%;display:inline-block;overflow:hidden;">Grand Total In Words : '.$finals.'</b>
</span>
<span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;visibility:hidden;">
<b style="width: 48%;display:inline-block;overflow:hidden;">Grand Total </b>
<b style="width: 50%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;position:relative;top:2px;">&#8377;</span> <span style="display:inline-block;width:103px;text-align:right;overflow:hidden;position:relative;top:5px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
</span>
</div>
<br>
<div style="border:1px dashed #000000;padding:0px !important;text-align: left;border-top:none;">';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
$html .= '<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px dashed #000000;border-left: 0px dashed #000000;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px dashed #000000;text-align:left;overflow:hidden;margin-top:10px;margin-bottom:-11px;visibility:hidden;">
<span style="display:block;height:23px;padding-left:36px;position:relative;top:6px;"></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp;</span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"></strong>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px dashed #000000;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;font-size: 12px !important;text-align: center !important;position:relative;top:25px;">Printed </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;font-size: 12px !important;text-align: left !important;position:relative;top:13px;"><b> </b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;font-size: 12px !important;text-align: center !important;position:relative;top:25px;font-weight:bold;left:63px;">Pages </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;font-size: 12px !important;text-align: left !important;position:relative;top:13px;"><b> </b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px dashed #000000;margin-top:10px;margin-bottom:-12px;border-left:1px dashed #000000;visibility:hidden;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
if ($info['signimage']!='') {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
}
else{
$signbase64 = '';
}
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
    if ($info['signimage']=='') {
        $html .= '<span style="width: 238px !important;height: 25px !important;display:inline-block;">&nbsp;</span>';
    }
$html .= '<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:3px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">For </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;position:relative;top:-3px;"> '.($info['franchisename']).'</strong>
</span>
</div>
</footer>';
$widthforitems = 130;
if(!in_array('Category', $fieldview)){
$widthforitems += 35;
}
if(!in_array('Hsn or Sac', $fieldview)){
$widthforitems += 45;
}
if($access['batchexpiryval']==0){
$widthforitems += 45;
}
if($access['batchexpiryval']==0){
$widthforitems += 47;
}
if(!in_array('Mrp', $fieldview)){
$widthforitems += 40;
}
if(!in_array('Quantity', $fieldview)){
$widthforitems += 18;
}
if(!in_array('Rate', $fieldview)){
$widthforitems += 40;
}
if(!in_array('Discount', $fieldview)){
$widthforitems += 15;
}
if(!in_array('GST Percentage', $fieldview)){
$widthforitems += 29;
}
if(!in_array('Taxable Value', $fieldview)){
$widthforitems += 40;
}
if(!in_array('Sale Quantity', $fieldview)){
$widthforitems += 72;
}
$html .= '
<div style="border: 0px dashed #000000;width:100% !important;">
<table style="border: 0px dashed #000000;width:100% !important;">
<thead style="background-color: #fff;">
<tr>
<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Item Details', $fieldview))?'':'display:none !important;').'text-align:left;min-width:'.($widthforitems).'px ;max-width:'.($widthforitems).'px ;">ITEM DETAILS</th>
<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Category', $fieldview))?'':'display:none !important;').'text-align: left;max-width:35px;min-width:35px;">'.($access['txtnamecategory']).'</th>
<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Hsn or Sac', $fieldview))?'':'display:none !important;').'text-align: left;max-width:45px;min-width:45px;">HSN/SAC</th>
<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'text-align: left;max-width:45px;min-width:45px;">BATCH</th>
<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'text-align: left;max-width:47px;min-width:47px;">EXPIRY</th>
<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('Mrp', $fieldview))?'':'display:none !important;').'">MRP</th>
<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;min-width:18px;max-width:18px;'.((in_array('Quantity', $fieldview))?'':'display:none !important;').'">'.($access['txtqtybill']).'</th>
<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('Rate', $fieldview))?'':'display:none !important;').'">RATE</th>
<th style="border: 1px dashed #000000;white-space: nowrap !important;max-width: 15px !important;min-width: 15px !important;overflow: hidden;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('Discount', $fieldview))?'':'display:none !important;').'">'.$access['txtprodisbill'].'</th>
<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('GST Percentage', $fieldview))?'':'display:none !important;').'min-width:29px;max-width:29px;">GST %</th>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;text-align:right !important;min-width:40px;max-width:40px;"><span style="display: block;overflow: hidden;height: 18px;">'.($access['txttaxablebill']).'</span></th>';
}
if ((in_array('Sale Quantity', $fieldview))) {
$html .= '<th style="border: 1px dashed #000000;white-space: nowrap !important;overflow:hidden;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;background-color: #1BBC9B;min-width:72px;max-width:72px;">'.($access['txtsqty']).'</th>';
}
$html .= '</tr>
</thead>
<tbody>';
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
$netamount= (float)$row['productvalue']+$vatamount+$vatamount;
$html .= '<tr style="height:13px !important;">
    <td style="border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;max-width: '.($widthforitems).'px  !important;min-width: '.($widthforitems).'px  !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;font-size:13px;'.((in_array('Item Details', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;font-size:13px !important;">'.($row['productname']).'</span>';
$html .= '
</td>
    <td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;max-width: 35px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Category', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;">'.((($row['manufacturer']!='')?$row['manufacturer']:'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;max-width: 45px !important;min-width: 45px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Hsn or Sac', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;">'.((($row['producthsn']!='')?$row['producthsn']:'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;max-width: 45px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;">'.((($row['batch']!='')?$row['batch']:'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;max-width: 47px !important;min-width:47px;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.(($access['batchexpiryval']==1)?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;">'.((($row['expdate']!='')?date($dateforexp,strtotime($row['expdate'])):'')).'</span></td>
    <td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;text-align: right;max-width: 40px !important;min-width: 40px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Mrp', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;">'.((($row['mrp']!='0')?(number_format((float)$row['mrp'],2,'.','')):'0.00')).'</span></td>
    <td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;text-align: right;max-width: 18px !important;min-width: 18px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Quantity', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;">'.($row['quantity']).'</span></td>
    <td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;text-align: right;max-width: 40px !important;min-width: 40px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Rate', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;">'.((($row['productrate']!='0')?(number_format((float)$row['productrate'],2,'.','')):'Free')).'</span></td>
    <td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;text-align: right;max-width: 15px !important;min-width: 15px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('Discount', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 18px;">'.((($row['prodiscounttype']=='0')?($row['prodiscount']).'%':(number_format((float)$row['prodiscount'],2,'.','')))).'</span></td>
    <td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;text-align: right;max-width: 29px !important;min-width: 29px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;'.((in_array('GST Percentage', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;height: 17.6px;">'.($row['vat']).'%</span></td>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;text-align:right;max-width: 40px !important;min-width: 40px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;"><span style="display: block;overflow: hidden;height: 17.6px;">'.((number_format((float)$row['productvalue'],2,'.',''))).'</span></td>';
}
if ((in_array('Sale Quantity', $fieldview))) {
$html .= '<td style="font-size: 12px !important;border: 1px dashed #000000;border-bottom: 0px dashed #fff !important;border-top: 0px dashed #fff !important;padding:0px 6px !important;text-align: right;max-width: 72px !important;min-width: 72px !important;overflow: hidden;line-height: 18px;white-space: nowrap !important;"><span style="display: block;overflow: hidden;height: 17.6px;">'.(($row['salequantity']!='0')?(number_format((float)$row['salequantity'],2,'.','')):'Free').'</span></td>';
}
$html .= '</tr>';
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
$outArr=array("timer"=>ceil(($countt-1)/500));
$jsonResponse=json_encode($outArr);
echo $jsonResponse;
$html .= '
</tbody>
</table>
</div>
<div id="footer" style="'.((($countt-1)==$totpros)?'visibility:visible;':'visibility:hidden;').'">
<p style="background-color:white;position:fixed;width:150%;margin:149px 0px 0px -18px;z-index:999999;">&nbsp;</p>
<div style="border:1px dashed #000000;padding-top:5px;text-align: left;border-top:none;">
<span style="margin-bottom:-35px;width: 20%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 13px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-35.5px;width: 46%;display:inline-block;margin-right: -4.5px;border-right: 1px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px dashed #000000;">
<div style="'.(((in_array('Tax Informations', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;"><table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px dashed #000000;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #fff;" class="text-uppercase">
<th rowspan="2" style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 12px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></th>
<th colspan="2" style="font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">CGST</th>
<th colspan="2" style="font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">SGST</th>
<th colspan="4" style="font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'">IGST</th>
<th colspan="2" style="font-size: 12px !important;padding: 0px 6px !important;text-align: center !important;border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;">GST</th>
</tr>
<tr>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: center !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: center !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b>%</b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: center !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b>%</b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: center !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;"><b>%</b></th>
<th style="border-top: 1px dashed #000000 !important;border-bottom: 1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;background-color: #fff !important;font-size: 12px !important;padding: 0px 3px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></b></th>
</tr>
<tbody style="font-size:10px !important;">';
$newtaxes=array();
$newcgst=array();
$newsgst=array();
$newigst=array();
$newgst=array();
$newgstpercent=array();
$newcsgstpercent=array();
$sqlitaxes=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='$billno' and billdate='$billdate' order by id asc");
while($infotaxes=mysqli_fetch_array($sqlitaxes)){
$anstax = $infotaxes['tax'];
$anscgst = $infotaxes['cgst'];
$anssgst = $infotaxes['sgst'];
$ansigst = $infotaxes['igst'];
$ansgst = $infotaxes['gst'];
$ansgstpercent = $infotaxes['gstpercent'];
$anscsgstpercent = $infotaxes['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
}
$finalbase = 4;
for ($i=1; $i <count($newtaxes) ; $i++) {
if ($i<=4) {
$finalbase--;
$html.='<tr>
<td style="border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newtaxes[$i]).'</span>
</td>
<td style="border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;">'.($newcgst[$i]).'</span>
</td>
<td style="border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
'.$newcsgstpercent[$i].'%
</td>
<td style="border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;">'.($newsgst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;">'.($newigst[$i]).'</span>
</td>
<td style="padding: 0px 3px !important;font-size: 10px !important;border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;padding-right: 15px;">
'.number_format((int)$newgstpercent[$i]).'%
</td>
<td style="padding: 0px 3px !important;border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;">'.($newgst[$i]).'</span>
</td>
</tr>';
}
}
for($i=0;$i<$finalbase;$i++){
$html.='<tr>
<td style="border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;"></span>
</td>
<td style="border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;"></span>
</td>
<td style="border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
</td>
<td style="border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;padding: 0px 3px !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='csgstshow')?'':'display:none;').'">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;font-size: 10px !important;border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;padding-right: 15px;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
</td>
<td style="padding: 0px 3px !important;border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;text-align: right !important;'.(($_GET['icsgst']=='igstshow')?'':'display:none;').'" colspan="2">
<span style="display: inline-block;white-space: nowrap;width: 30px;overflow: hidden;"></span>
</td>
<td style="padding: 0px 3px !important;font-size: 10px !important;border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right !important;padding-right: 15px;">
</td>
<td style="padding: 0px 3px !important;border-top: 1px dashed #fff !important;border-bottom: 1px dashed #fff !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;font-size: 10px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 100%;overflow: hidden;"></span>
</td>
</tr>';
}
$html.='<tr>
<td colspan="6" style="border-top: 1.1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td style="border-top: 1.1px dashed #000000 !important;border-right: 1px dashed #000000 !important;border-left: 1px dashed #000000 !important;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-48px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:98px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:98px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="'.((in_array('Total Tax', $fieldview))?'display:inline-block;':'display:none;').'white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:98px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 50%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:98px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
<b style="width: 48%;display:inline-block;overflow:hidden;position:relative;top:-10px;">Grand Total </b>
<b style="width: 50%;display:inline-block;overflow:hidden;font-size:20px;"><span style="position:relative;top:-6px;">:</span> <span style="font-family: DejaVu Sans; sans-serif;position:relative;top:-3px;">&#8377;</span> <span style="display:inline-block;width:90px;text-align:right;overflow:hidden;position:relative;top:0px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
</span>
<span style="margin-bottom:-26px;width: 1%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
</span>
</div>';
// $html .= '<div style="border:1px dashed #000000;padding-top:0px;text-align: left;border-top:none;margin-bottom:-28px;">';
// $number = number_format((float)$rows[0]['grandtotal'],2,'.','');
//    $no = floor($number);
//    $point = round($number - $no, 2) * 100;
//    $hundred = null;
//    $digits_1 = strlen($no);
//    $i = 0;
//    $str = array();
//    $words = array('0' => '', '1' => 'One', '2' => 'Two',
//     '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
//     '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
//     '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
//     '13' => 'Thirteen', '14' => 'Fourteen',
//     '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
//     '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
//     '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
//     '60' => 'Sixty', '70' => 'Seventy',
//     '80' => 'Eighty', '90' => 'Ninety');
//    $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
//    while ($i < $digits_1) {
//      $divider = ($i == 2) ? 10 : 100;
//      $number = floor($no % $divider);
//      $no = floor($no / $divider);
//      $i += ($divider == 10) ? 1 : 2;
//      if ($number) {
//         $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
//         $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
//         $str [] = ($number < 21) ? $words[$number] .
//             " " . $digits[$counter] . $plural . " " . $hundred
//             :
//             $words[floor($number / 10) * 10]
//             . " " . $words[$number % 10] . " "
//             . $digits[$counter] . $plural . " " . $hundred;
//      } else $str[] = null;
//   }
//   $str = array_reverse($str);
//   $result = implode('', $str);
//   $points = ($point) ?
//     "and Paise " . $words[$point / 10] . " " . 
//           $words[$point = $point % 10] : '';
//    $finals = "Rupees  " . $result ."". $points . " Only";
// $html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px dashed #000000;padding:1px 6px !important;font-size:13px;white-space: nowrap;margin-bottom:-4px;">
// <b style="width: 99.9%;display:inline-block;overflow:hidden;">Grand Total In Words : '.$finals.'</b>
// </span>
// <span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;">
// <b style="width: 48%;display:inline-block;overflow:hidden;">Grand Total </b>
// <b style="width: 50%;display:inline-block;overflow:hidden;font-size:20px;"><span style="position:relative;top:4px;">:</span> <span style="font-family: DejaVu Sans; sans-serif;position:relative;top:7px;">&#8377;</span> <span style="display:inline-block;width:90px;text-align:right;overflow:hidden;position:relative;top:10px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
// </span>
// </div>
// <br>
$html .= '<div style="border:1px dashed #000000;padding:0px !important;text-align: left;border-top:none;border-bottom:0px dashed #000000;">';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
$html .= '<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px dashed #000000;border-left: 0px dashed #000000;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px dashed #000000;text-align:left;overflow:hidden;margin-top:10px;margin-bottom:-11px;">
<span style="display:block;height:16px;padding-left:54px;position:relative;top:0px;">Printed</span>
<span style="width: 1%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp;</span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:center;overflow:hidden;width:95%;position:relative;top:-9px;left:-10px;">Pages</strong>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px dashed #000000;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:5.1px;background-color:white;height:26px;left:3px;">'.(((in_array('Terms and Conditions', $fieldview)))?'Terms and Conditions ':'').'</span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:5.1px;background-color:white;height:26px;"><b>'.(((in_array('Terms and Conditions', $fieldview)))?': '.($rows[0]['terms']):'').'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:1px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px dashed #000000;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px dashed #000000;margin-top:10px;margin-bottom:-12px;border-left:1px dashed #000000;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
if ($info['signimage']!='') {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
}
else{
$signbase64 = '';
}
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 278px !important;height: 18px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
    if ($info['signimage']=='') {
        $html .= '<span style="width: 238px !important;height: 18px !important;display:inline-block;">&nbsp;</span>';
    }
$html .= '<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:0px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">For </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;position:relative;top:-6px;"> '.($info['franchisename']).'</strong>
</span>
</div>
</div>
</body>
</html>';
$dompdf->loadHtml($html);
// $dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dates = date('d-m-Y h:i:s');
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
$mask = 'dompdf/Bills-*.*';
array_map('unlink', glob($mask));
$output = $dompdf->output();
file_put_contents("dompdf/".$_GET['names'].".pdf", $output);
}
?>