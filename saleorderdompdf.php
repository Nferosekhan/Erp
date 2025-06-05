<?php
// Include autoloader 
require_once 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 

if (($_GET['term']=='saleorder')&&($_GET['sizes']=='a4')) {
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
include('lcheck.php');
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Sales Orders' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Sales Orders' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Sales Orders' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
 if((isset($_GET['salesorderno']))&&(isset($_GET['salesorderdate'])))
 {
     $salesorderno=mysqli_real_escape_string($con, $_GET['salesorderno']);
     $salesorderdate=mysqli_real_escape_string($con, $_GET['salesorderdate']);
 $sql=mysqli_query($con, "select * from pairsalesorders where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and salesorderno='$salesorderno' and salesorderdate='$salesorderdate' order by id asc");
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
<style>body { font-family: "Myriad Set Pro","Helvetica Neue",Helvetica,Arial,sans-serif;margin: 204px -30px 153.3px -30px;word-wrap: break-word;border:1px solid #cccccc;}table {border-collapse: collapse;}header{position: fixed;top: -29px;height: max-content;width:108.3%;color: black;text-align: center;}footer{position: fixed;bottom: -27px;height: max-content;width:108.3%;color: black;text-align: center;}#footer{position: absolute;bottom: -33px;height: max-content;width:108.3%;color: black;text-align: center;}.ribbon-wrapper {width: 185px;height: 188px;overflow: hidden;position: absolute;top: -3px;left: -3px;}.ribbon {font: bold 15px Sans-Serif;color: #333;text-align: center;text-shadow: rgba(255, 255, 255, 0.5) 0 1px 0;position: relative;padding: 7px 0;transform: rotate(-45deg);left: -42px;top: 32px;width: 180px;background-color: #BFDC7A;box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);}.ribbon:before, .ribbon:after {content: "";border-top: 3px solid #6e8900;border-left: 3px solid transparent;border-right: 3px solid transparent;position: absolute;bottom: -3px;}.ribbon:before {left: 0;}.ribbon:after {right: 0;}</style>
</head>
<body>
<header>';
            $paidamount=0;
                $currentbalance=0;
                $currentamount=(float)$rows[0]['salesorderamount'];
                $sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$salesorderno."' and invoicedate='".$salesorderdate."' order by id desc");
                while($infosalespay=mysqli_fetch_array($sqlsalespay))
                {
                    $paidamount+=(float)$infosalespay['amount'];
                }
                $currentbalance=((float)$rows[0]['salesorderamount']-$paidamount);
            if($currentbalance==0)
            {
                 $html .= '<div class="ribbon-wrapper"><div class="ribbon">PAID</div></div>  ';
            }
            else
            {
                if($currentbalance==$currentamount)
                {
                    $html .= '<style>
                    .ribbon {
                     background-color: #eb4034;
                     color: #fff !important;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">UN PAID</div></div>  ';
                }
                else
                {
                    $html .= '<style>
                    .ribbon {
                     background-color: #fcba03;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">PARTIALLY PAID</div></div>  ';
                }
            }
            if($rows[0]['cancelstatus']=="1")
            {
                $html .= '<style>
                    .ribbon {
                     background-color: #b5b5b5;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">VOID</div></div>';
            }
$html .= '
<div style="border:1px solid #cccccc;border-bottom:none;">
<div>'.($infomainaccessuser['modulename']).'</div>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-23px;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:9px 6px !important;text-align:right;margin-top:18px;">';
if ($info['branchimage']!='') {
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
$franchpath = (str_replace('../ups','ups',$img));
$franchtype = pathinfo($franchpath, PATHINFO_EXTENSION);
$franchdata = file_get_contents($franchpath);
$franchbase64 = 'data:image/' . $franchtype . ';base64,' . base64_encode($franchdata);
    $html .= '<img alt="Branch Pic" src="'.($franchbase64).'" id="branch-image1" height="80" width="80">';
    }
}
else{
    $html .= '<img alt="Branch Pic" style="visibility:hidden;" src="data:image/jpeg;base64,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" id="branch-image1" height="80" width="80">';
}
$html .= '</span>
<span style="width: 63%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.($info['franchisename']).'</strong>
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;">'.($info['street']).' '.($info['city']).' '.($info['pincode']).' '.($info['state']).' '.($info['country']).' </span>
<span style="'.(($access['saleorderbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Phone </span>
<span style="'.(($access['saleorderbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 80%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
<span style="'.(($access['saleorderbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">E-mail </span>
<span style="'.(($access['saleorderbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 47%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['email']).'</span>
<span style="'.(($access['saleorderprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 13%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 20 </span>
<span style="'.(($access['saleorderprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 19%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno20']).'</span>
<span style="'.(($access['saleorderbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($access['saleorderbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 47%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['gstno']).'</span>
<span style="'.(($access['saleorderprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 13%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 21 </span>
<span style="'.(($access['saleorderprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 19%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno21']).'</span>
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-28px;">
<span style="width: 33%;display:inline-block;background-color:#eee;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"><strong>Billing Address</strong></span>
<span style="width: 33%;display:inline-block;background-color:#eee;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"><strong>Shipping Address</strong></span>
<span style="width: 33.6%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"></span>
</div>
<div style="border:1px solid #cccccc;padding-top:3px;text-align: left;border-top:none;border-bottom:none;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:3px 6px !important;margin-bottom:-22px;">
<br>
<strong style="'.(($rows[0]['customername']!=''&&(in_array('Billing Name', $fieldview)))?'':'visibility:hidden;').'font-weight:bold;font-size: 13px !important;display: inline-block;width: 253px;overflow: hidden;height: 15px;white-space: nowrap;">'.(ucwords(strtolower($rows[0]['customername']))).'</strong>
<span style="'.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['area']!='')||($rows[0]['city']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 253px;overflow: hidden;">'.(ucwords(strtolower($rows[0]['area']))).' '.(((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'')).' '.(ucwords(strtolower($rows[0]['city']))).'</span>
<span style="'.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 253px;overflow: hidden;">'.($rows[0]['state']).' '.(((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'')).' '.($rows[0]['pincode']).' '.(((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'')).' '.($rows[0]['district']).'</span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Work Phone </span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['workphone']).'</b></span>
<span style="'.(($infomainaccessuser['saleorderprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['saleorderprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($infomainaccessuser['saleorderprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['saleorderprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['gstno']).'</b></span>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;margin-bottom:-22px;">
<br>
<strong style="'.(($rows[0]['customername']!=''&&(in_array('Shipping Name', $fieldview)))?'':'visibility:hidden;').'font-weight:bold;font-size: 13px !important;display: inline-block;width: 253px;overflow: hidden;height: 15px;white-space: nowrap;">'.(ucwords(strtolower($rows[0]['customername']))).'</strong>
<span style="'.(((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))&&((($rows[0]['sarea']!='')||($rows[0]['scity']!=''))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 253px;overflow: hidden;">'.(ucwords(strtolower($rows[0]['sarea']))).' '.(((($rows[0]['sarea']!='')&&($rows[0]['scity']!=''))?',':'')).' '.(ucwords(strtolower($rows[0]['scity']))).'</span>
<span style="'.(((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))&&(($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!='')))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 253px;overflow: hidden;">'.($rows[0]['sstate']).' '.(((($rows[0]['sstate']!='')&&($rows[0]['spincode']!=''))?',':'')).' '.($rows[0]['spincode']).' '.(((($rows[0]['sstate']!='')&&($rows[0]['sdistrict']!='')||($rows[0]['spincode']!='')&&($rows[0]['sdistrict']!=''))?',':'')).' '.($rows[0]['sdistrict']).'</span>
<span style="'.((in_array('Mobile Phone', $fieldview))?'':'visibility:hidden;').'display: inline-flex;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Mobile Phone </span>
<span style="'.((in_array('Mobile Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['mobile']).'</b></span>
<span style="'.(($infomainaccessuser['saleorderprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['saleorderprintpos']!='hide')&&(in_array('Place of Supply', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Place Of Supply </span>
<span style="'.(($infomainaccessuser['saleorderprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['saleorderprintpos']!='hide')&&(in_array('Place of Supply', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['pos']).'</b></span>
</span>
<span style="width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;margin-bottom:-22px;vertical-align:middle;">
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).'</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Number</span></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['salesorderno']).'</strong></span><span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).'</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Date</span></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($rows[0]['salesorderdate']))).'</strong></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Term</span></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['salesorderterm']).'</strong></span>
</span>
</div>
</header>
<footer>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;visibility:hidden">
<div style="'.(((in_array('Tax Table', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<td style="font-weight:normal !important;border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE<br>VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">CGST</td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">SGST</td>
<td colspan="2" style="font-weight:normal !important;font-size: 8px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;">GST</td>
</tr>
<tbody style="font-size:10px !important;">
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax25']!='0')?number_format((float)$rows[0]['tax25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0')?number_format((float)$rows[0]['cgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst25']!='0')?number_format((float)$rows[0]['sgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
5%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0'&&$rows[0]['sgst25']!='0')?number_format((float)$rows[0]['gst25'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;"><span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax6']!='0')?number_format((float)$rows[0]['tax6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0')?number_format((float)$rows[0]['cgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst6']!='0')?number_format((float)$rows[0]['sgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
12%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0'&&$rows[0]['sgst6']!='0')?number_format((float)$rows[0]['gst6'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax9']!='0')?number_format((float)$rows[0]['tax9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0')?number_format((float)$rows[0]['cgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst9']!='0')?number_format((float)$rows[0]['sgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
18%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0'&&$rows[0]['sgst9']!='0')?number_format((float)$rows[0]['gst9'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax14']!='0')?number_format((float)$rows[0]['tax14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0')?number_format((float)$rows[0]['cgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst14']!='0')?number_format((float)$rows[0]['sgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
28%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0'&&$rows[0]['sgst14']!='0')?number_format((float)$rows[0]['gst14'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td colspan="5" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td colspan="2" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
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
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
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
<b style="width: 49.5%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
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
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:11px;"><b> '.($rows[0]['terms']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;font-size: 12px !important;text-align: center !important;position:relative;top:23px;font-weight:bold;left:63px;">Pages </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:11px;"><b> '.($rows[0]['terms']).'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;visibility:hidden;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">For </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> '.($info['franchisename']).'</strong>
</span>
</div>
</footer>
<div style="border: 0px solid #cccccc;width:100% !important;">
<table style="border: 0px solid #cccccc;width:100% !important;">
<thead>
<tr>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;">ITEM DETAILS</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;'.((in_array('Product Category', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;max-width: 78px;max-height: 13px;">'.($access['txtnamecategory']).'</span></th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">BATCH</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">EXPIRY</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;">HSN/SAC</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('Product Mrp', $fieldview))?'':'display:none !important;').'">MRP</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;">RATE</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;">QUANTITY</th>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;">GST%</th>';
}
if ((in_array('Tax Value', $fieldview))) {
$html .= '<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;">TAXABLE VALUE</th>';
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
$html .= '<tr>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 350px !important;overflow: hidden;line-height: 18px;white-space: normal !important;">
'.((($row['productname']!='')?$row['productname']:'')).'<br><span style="position:relative;top:-3px;">'.((($row['productdescription']!='')?$row['productdescription']:'')).'</span>
</td>
<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.((in_array('Product Category', $fieldview))?'':'display:none !important;').'">
'.((($row['manufacturer']!='')?$row['manufacturer']:'')).'
</td>
<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">
'.((($row['batch']!='')?$row['batch']:'')).'
</td>';
$dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='0')) {
$date = '';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='1')) {
$date = 'd/m/Y';
}
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='1')) {
$date = 'm/Y';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='1')) {
$date = 'd/Y';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='0')) {
$date = 'd/m';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='0')) {
$date = 'd';
}
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='0')) {
$date = 'm';
}
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='1')) {
$date = 'Y';
}
    }
$html .= '<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">
'.((($row['expdate']!='')?date($date,strtotime($row['expdate'])):'')).'
</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;">'.((($row['producthsn']!='')?$row['producthsn']:'')).'</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.((in_array('Product Mrp', $fieldview))?'':'display:none !important;').'">'.((($row['mrp']!='')?number_format((float)$row['mrp'],2,'.',''):'')).'</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;">'.((($row['productrate']!='0')?(number_format((float)$row['productrate'],2,'.','')):'Free')).'</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;">'.($row['quantity']).'</td>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;">'.((($row['vat']!='')?$row['vat'].'%':'')).'</td>';
}
if ((in_array('Tax Value', $fieldview))) {
$html .= '<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;">'.((($row['productvalue']!='0')?(number_format((float)$row['productvalue'],2,'.','')):'Free')).'</td>';
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
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;">
<div style="'.(((in_array('Tax Table', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<td style="font-weight:normal !important;border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE<br>VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">CGST</td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">SGST</td>
<td colspan="2" style="font-weight:normal !important;font-size: 8px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;">GST</td>
</tr>
<tbody style="font-size:10px !important;">
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax25']!='0')?number_format((float)$rows[0]['tax25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0')?number_format((float)$rows[0]['cgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst25']!='0')?number_format((float)$rows[0]['sgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
5%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0'&&$rows[0]['sgst25']!='0')?number_format((float)$rows[0]['gst25'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;"><span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax6']!='0')?number_format((float)$rows[0]['tax6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0')?number_format((float)$rows[0]['cgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst6']!='0')?number_format((float)$rows[0]['sgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
12%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0'&&$rows[0]['sgst6']!='0')?number_format((float)$rows[0]['gst6'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax9']!='0')?number_format((float)$rows[0]['tax9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0')?number_format((float)$rows[0]['cgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst9']!='0')?number_format((float)$rows[0]['sgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
18%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0'&&$rows[0]['sgst9']!='0')?number_format((float)$rows[0]['gst9'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax14']!='0')?number_format((float)$rows[0]['tax14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0')?number_format((float)$rows[0]['cgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst14']!='0')?number_format((float)$rows[0]['sgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
28%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0'&&$rows[0]['sgst14']!='0')?number_format((float)$rows[0]['gst14'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td colspan="5" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td colspan="2" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
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
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
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
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-4px;">
<b style="width: 99.9%;display:inline-block;overflow:hidden;">Grand Total In Words : '.$finals.'</b>
</span>
<span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;">
<b style="width: 48%;display:inline-block;overflow:hidden;">Grand Total </b>
<b style="width: 49.5%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
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
<span style="'.(((in_array('Terms and Conditions', $fieldview)))?'':'visibility:hidden;').'width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;left:3px;">Terms and Conditions </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;"><b>: '.($rows[0]['terms']).'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">For </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> '.($info['franchisename']).'</strong>
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
$mask = 'dompdf/Sales Orders-*.*';
array_map('unlink', glob($mask));
$output = $dompdf->output();
file_put_contents("dompdf/".$_GET['names'].".pdf", $output);
} 
if (($_GET['term']=='saleorder')&&($_GET['sizes']=='a5')) {
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
include('lcheck.php');
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Sales Orders' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Sales Orders' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Sales Orders' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
 if((isset($_GET['salesorderno']))&&(isset($_GET['salesorderdate'])))
 {
     $salesorderno=mysqli_real_escape_string($con, $_GET['salesorderno']);
     $salesorderdate=mysqli_real_escape_string($con, $_GET['salesorderdate']);
 $sql=mysqli_query($con, "select * from pairsalesorders where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and salesorderno='$salesorderno' and salesorderdate='$salesorderdate' order by id asc");
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
<style>body { font-family: "Myriad Set Pro","Helvetica Neue",Helvetica,Arial,sans-serif;margin: 204px -30px 154.5px -30px;word-wrap: break-word;border:1px solid #cccccc;}table {border-collapse: collapse;}header{position: fixed;top: -29px;height: max-content;width:108.3%;color: black;text-align: center;}footer{position: fixed;bottom: -25px;height: max-content;width:108.3%;color: black;text-align: center;}#footer{position: absolute;bottom: -31px;height: max-content;width:108.3%;color: black;text-align: center;}.ribbon-wrapper {width: 185px;height: 188px;overflow: hidden;position: absolute;top: -3px;left: -3px;}.ribbon {font: bold 15px Sans-Serif;color: #333;text-align: center;text-shadow: rgba(255, 255, 255, 0.5) 0 1px 0;position: relative;padding: 7px 0;transform: rotate(-45deg);left: -42px;top: 32px;width: 180px;background-color: #BFDC7A;box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);}.ribbon:before, .ribbon:after {content: "";border-top: 3px solid #6e8900;border-left: 3px solid transparent;border-right: 3px solid transparent;position: absolute;bottom: -3px;}.ribbon:before {left: 0;}.ribbon:after {right: 0;}</style>
</head>
<body>
<header>';
            $paidamount=0;
                $currentbalance=0;
                $currentamount=(float)$rows[0]['salesorderamount'];
                $sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$salesorderno."' and invoicedate='".$salesorderdate."' order by id desc");
                while($infosalespay=mysqli_fetch_array($sqlsalespay))
                {
                    $paidamount+=(float)$infosalespay['amount'];
                }
                $currentbalance=((float)$rows[0]['salesorderamount']-$paidamount);
            if($currentbalance==0)
            {
                 $html .= '<div class="ribbon-wrapper"><div class="ribbon">PAID</div></div>  ';
            }
            else
            {
                if($currentbalance==$currentamount)
                {
                    $html .= '<style>
                    .ribbon {
                     background-color: #eb4034;
                     color: #fff !important;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">UN PAID</div></div>  ';
                }
                else
                {
                    $html .= '<style>
                    .ribbon {
                     background-color: #fcba03;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">PARTIALLY PAID</div></div>  ';
                }
            }
            if($rows[0]['cancelstatus']=="1")
            {
                $html .= '<style>
                    .ribbon {
                     background-color: #b5b5b5;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">VOID</div></div>';
            }
$html .= '
<div style="border:1px solid #cccccc;border-bottom:none;">
<div>'.($infomainaccessuser['modulename']).'</div>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-23px;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:9px 6px !important;text-align:right;margin-top:18px;">';
if ($info['branchimage']!='') {
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
$franchpath = (str_replace('../ups','ups',$img));
$franchtype = pathinfo($franchpath, PATHINFO_EXTENSION);
$franchdata = file_get_contents($franchpath);
$franchbase64 = 'data:image/' . $franchtype . ';base64,' . base64_encode($franchdata);
    $html .= '<img alt="Branch Pic" src="'.($franchbase64).'" id="branch-image1" height="80" width="80">';
    }
}
else{
    $html .= '<img alt="Branch Pic" style="visibility:hidden;" src="data:image/jpeg;base64,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" id="branch-image1" height="80" width="80">';
}
$html .= '</span>
<span style="width: 63%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.($info['franchisename']).'</strong>
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;">'.($info['street']).' '.($info['city']).' '.($info['pincode']).' '.($info['state']).' '.($info['country']).' </span>
<span style="'.(($access['saleorderbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Phone </span>
<span style="'.(($access['saleorderbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 80%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
<span style="'.(($access['saleorderbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">E-mail </span>
<span style="'.(($access['saleorderbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 47%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['email']).'</span>
<span style="'.(($access['saleorderprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 13%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 20 </span>
<span style="'.(($access['saleorderprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 19%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno20']).'</span>
<span style="'.(($access['saleorderbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($access['saleorderbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 47%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['gstno']).'</span>
<span style="'.(($access['saleorderprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 13%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 21 </span>
<span style="'.(($access['saleorderprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 19%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno21']).'</span>
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-28px;">
<span style="width: 33%;display:inline-block;background-color:#eee;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"><strong>Billing Address</strong></span>
<span style="width: 33%;display:inline-block;background-color:#eee;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"><strong>Shipping Address</strong></span>
<span style="width: 33.6%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"></span>
</div>
<div style="border:1px solid #cccccc;padding-top:3px;text-align: left;border-top:none;border-bottom:none;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:3px 6px !important;margin-bottom:-22px;">
<br>
<strong style="'.(($rows[0]['customername']!=''&&(in_array('Billing Name', $fieldview)))?'':'visibility:hidden;').'font-weight:bold;font-size: 13px !important;display: inline-block;width: 253px;overflow: hidden;height: 15px;white-space: nowrap;">'.(ucwords(strtolower($rows[0]['customername']))).'</strong>
<span style="'.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['area']!='')||($rows[0]['city']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 253px;overflow: hidden;">'.(ucwords(strtolower($rows[0]['area']))).' '.(((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'')).' '.(ucwords(strtolower($rows[0]['city']))).'</span>
<span style="'.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 253px;overflow: hidden;">'.($rows[0]['state']).' '.(((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'')).' '.($rows[0]['pincode']).' '.(((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'')).' '.($rows[0]['district']).'</span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Work Phone </span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['workphone']).'</b></span>
<span style="'.(($infomainaccessuser['saleorderprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['saleorderprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($infomainaccessuser['saleorderprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['saleorderprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['gstno']).'</b></span>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;margin-bottom:-22px;">
<br>
<strong style="'.(($rows[0]['customername']!=''&&(in_array('Shipping Name', $fieldview)))?'':'visibility:hidden;').'font-weight:bold;font-size: 13px !important;display: inline-block;width: 253px;overflow: hidden;height: 15px;white-space: nowrap;">'.(ucwords(strtolower($rows[0]['customername']))).'</strong>
<span style="'.(((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))&&((($rows[0]['sarea']!='')||($rows[0]['scity']!=''))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 253px;overflow: hidden;">'.(ucwords(strtolower($rows[0]['sarea']))).' '.(((($rows[0]['sarea']!='')&&($rows[0]['scity']!=''))?',':'')).' '.(ucwords(strtolower($rows[0]['scity']))).'</span>
<span style="'.(((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))&&(($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!='')))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 253px;overflow: hidden;">'.($rows[0]['sstate']).' '.(((($rows[0]['sstate']!='')&&($rows[0]['spincode']!=''))?',':'')).' '.($rows[0]['spincode']).' '.(((($rows[0]['sstate']!='')&&($rows[0]['sdistrict']!='')||($rows[0]['spincode']!='')&&($rows[0]['sdistrict']!=''))?',':'')).' '.($rows[0]['sdistrict']).'</span>
<span style="'.((in_array('Mobile Phone', $fieldview))?'':'visibility:hidden;').'display: inline-flex;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Mobile Phone </span>
<span style="'.((in_array('Mobile Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['mobile']).'</b></span>
<span style="'.(($infomainaccessuser['saleorderprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['saleorderprintpos']!='hide')&&(in_array('Place of Supply', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Place Of Supply </span>
<span style="'.(($infomainaccessuser['saleorderprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['saleorderprintpos']!='hide')&&(in_array('Place of Supply', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['pos']).'</b></span>
</span>
<span style="width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;margin-bottom:-22px;vertical-align:middle;">
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).'</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Number</span></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['salesorderno']).'</strong></span><span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).'</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Date</span></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($rows[0]['salesorderdate']))).'</strong></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Term</span></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['salesorderterm']).'</strong></span>
</span>
</div>
</header>
<footer>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;visibility:hidden">
<div style="'.(((in_array('Tax Table', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<td style="font-weight:normal !important;border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE<br>VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">CGST</td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">SGST</td>
<td colspan="2" style="font-weight:normal !important;font-size: 8px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;">GST</td>
</tr>
<tbody style="font-size:10px !important;">
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax25']!='0')?number_format((float)$rows[0]['tax25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0')?number_format((float)$rows[0]['cgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst25']!='0')?number_format((float)$rows[0]['sgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
5%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0'&&$rows[0]['sgst25']!='0')?number_format((float)$rows[0]['gst25'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;"><span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax6']!='0')?number_format((float)$rows[0]['tax6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0')?number_format((float)$rows[0]['cgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst6']!='0')?number_format((float)$rows[0]['sgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
12%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0'&&$rows[0]['sgst6']!='0')?number_format((float)$rows[0]['gst6'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax9']!='0')?number_format((float)$rows[0]['tax9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0')?number_format((float)$rows[0]['cgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst9']!='0')?number_format((float)$rows[0]['sgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
18%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0'&&$rows[0]['sgst9']!='0')?number_format((float)$rows[0]['gst9'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax14']!='0')?number_format((float)$rows[0]['tax14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0')?number_format((float)$rows[0]['cgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst14']!='0')?number_format((float)$rows[0]['sgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
28%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0'&&$rows[0]['sgst14']!='0')?number_format((float)$rows[0]['gst14'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td colspan="5" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td colspan="2" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
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
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
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
<b style="width: 49.5%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
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
<span style="display: inline-block;white-space: nowrap;width: 48%;;font-size: 12px !important;text-align: center !important;position:relative;top:23px;">Printed </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;font-size: 12px !important;text-align: left !important;position:relative;top:11px;"><b> '.($rows[0]['terms']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;;font-size: 12px !important;text-align: center !important;position:relative;top:23px;font-weight:bold;left:63px;">Pages </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;font-size: 12px !important;text-align: left !important;position:relative;top:11px;"><b> '.($rows[0]['terms']).'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;visibility:hidden;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">For </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> '.($info['franchisename']).'</strong>
</span>
</div>
</footer>
<div style="border: 0px solid #cccccc;width:100% !important;">
<table style="border: 0px solid #cccccc;width:100% !important;">
<thead>
<tr>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;">ITEM DETAILS</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;'.((in_array('Product Category', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;max-width: 78px;max-height: 13px;">'.($access['txtnamecategory']).'</span></th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">BATCH</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">EXPIRY</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;">HSN/SAC</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('Product Mrp', $fieldview))?'':'display:none !important;').'">MRP</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;">RATE</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;">QUANTITY</th>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;">GST%</th>';
}
if ((in_array('Tax Value', $fieldview))) {
$html .= '<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;">TAXABLE VALUE</th>';
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
$html .= '<tr>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 350px !important;overflow: hidden;line-height: 18px;white-space: normal !important;">
'.((($row['productname']!='')?$row['productname']:'')).'<br><span style="position:relative;top:-3px;">'.((($row['productdescription']!='')?$row['productdescription']:'')).'</span>
</td>
<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.((in_array('Product Category', $fieldview))?'':'display:none !important;').'">
'.((($row['manufacturer']!='')?$row['manufacturer']:'')).'
</td>
<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">
'.((($row['batch']!='')?$row['batch']:'')).'
</td>';
$dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='0')) {
$date = '';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='1')) {
$date = 'd/m/Y';
}
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='1')) {
$date = 'm/Y';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='1')) {
$date = 'd/Y';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='0')) {
$date = 'd/m';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='0')) {
$date = 'd';
}
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='0')) {
$date = 'm';
}
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='1')) {
$date = 'Y';
}
    }
$html .= '<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">
'.((($row['expdate']!='')?date($date,strtotime($row['expdate'])):'')).'
</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;">'.((($row['producthsn']!='')?$row['producthsn']:'')).'</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.((in_array('Product Mrp', $fieldview))?'':'display:none !important;').'">'.((($row['mrp']!='')?number_format((float)$row['mrp'],2,'.',''):'')).'</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;">'.((($row['productrate']!='0')?(number_format((float)$row['productrate'],2,'.','')):'Free')).'</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;">'.($row['quantity']).'</td>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;">'.((($row['vat']!='')?$row['vat'].'%':'')).'</td>';
}
if ((in_array('Tax Value', $fieldview))) {
$html .= '<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;">'.((($row['productvalue']!='0')?(number_format((float)$row['productvalue'],2,'.','')):'Free')).'</td>';
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
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;">
<div style="'.(((in_array('Tax Table', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<td style="font-weight:normal !important;border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE<br>VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">CGST</td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">SGST</td>
<td colspan="2" style="font-weight:normal !important;font-size: 8px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;">GST</td>
</tr>
<tbody style="font-size:10px !important;">
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax25']!='0')?number_format((float)$rows[0]['tax25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0')?number_format((float)$rows[0]['cgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst25']!='0')?number_format((float)$rows[0]['sgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
5%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0'&&$rows[0]['sgst25']!='0')?number_format((float)$rows[0]['gst25'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;"><span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax6']!='0')?number_format((float)$rows[0]['tax6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0')?number_format((float)$rows[0]['cgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst6']!='0')?number_format((float)$rows[0]['sgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
12%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0'&&$rows[0]['sgst6']!='0')?number_format((float)$rows[0]['gst6'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax9']!='0')?number_format((float)$rows[0]['tax9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0')?number_format((float)$rows[0]['cgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst9']!='0')?number_format((float)$rows[0]['sgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
18%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0'&&$rows[0]['sgst9']!='0')?number_format((float)$rows[0]['gst9'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax14']!='0')?number_format((float)$rows[0]['tax14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0')?number_format((float)$rows[0]['cgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst14']!='0')?number_format((float)$rows[0]['sgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
28%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0'&&$rows[0]['sgst14']!='0')?number_format((float)$rows[0]['gst14'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td colspan="5" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td colspan="2" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
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
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
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
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-4px;">
<b style="width: 99.9%;display:inline-block;overflow:hidden;">Grand Total In Words : '.$finals.'</b>
</span>
<span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;">
<b style="width: 48%;display:inline-block;overflow:hidden;">Grand Total </b>
<b style="width: 49.5%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
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
<span style="'.(((in_array('Terms and Conditions', $fieldview)))?'':'visibility:hidden;').'width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;left:3px;">Terms and Conditions </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;"><b>: '.($rows[0]['terms']).'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">For </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> '.($info['franchisename']).'</strong>
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
$mask = 'dompdf/Sales Orders-*.*';
array_map('unlink', glob($mask));
$output = $dompdf->output();
file_put_contents("dompdf/".$_GET['names'].".pdf", $output);
} 
if (($_GET['term']=='saleorder')&&($_GET['sizes']=='dt')) {
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
include('lcheck.php');
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Sales Orders' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Sales Orders' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Sales Orders' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
 if((isset($_GET['salesorderno']))&&(isset($_GET['salesorderdate'])))
 {
     $salesorderno=mysqli_real_escape_string($con, $_GET['salesorderno']);
     $salesorderdate=mysqli_real_escape_string($con, $_GET['salesorderdate']);
 $sql=mysqli_query($con, "select * from pairsalesorders where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and salesorderno='$salesorderno' and salesorderdate='$salesorderdate' order by id asc");
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
<style>@page { size: 15.75cm 24.13cm landscape; }body { font-family: "Myriad Set Pro","Helvetica Neue",Helvetica,Arial,sans-serif;margin: 204px -30px 158px -30px;word-wrap: break-word;border:1px solid #cccccc;}table {border-collapse: collapse;}header{position: fixed;top: -29px;height: max-content;width:107.1%;color: black;text-align: center;}footer{position: fixed;bottom: -22px;height: max-content;width:107.1%;color: black;text-align: center;}#footer{position: absolute;bottom: -28px;height: max-content;width:107.1%;color: black;text-align: center;}.ribbon-wrapper {width: 185px;height: 188px;overflow: hidden;position: absolute;top: -3px;left: -3px;}.ribbon {font: bold 15px Sans-Serif;color: #333;text-align: center;text-shadow: rgba(255, 255, 255, 0.5) 0 1px 0;position: relative;padding: 7px 0;transform: rotate(-45deg);left: -42px;top: 32px;width: 180px;background-color: #BFDC7A;box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);}.ribbon:before, .ribbon:after {content: "";border-top: 3px solid #6e8900;border-left: 3px solid transparent;border-right: 3px solid transparent;position: absolute;bottom: -3px;}.ribbon:before {left: 0;}.ribbon:after {right: 0;}</style>
</head>
<body>
<header>';
            $paidamount=0;
                $currentbalance=0;
                $currentamount=(float)$rows[0]['salesorderamount'];
                $sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$salesorderno."' and invoicedate='".$salesorderdate."' order by id desc");
                while($infosalespay=mysqli_fetch_array($sqlsalespay))
                {
                    $paidamount+=(float)$infosalespay['amount'];
                }
                $currentbalance=((float)$rows[0]['salesorderamount']-$paidamount);
            if($currentbalance==0)
            {
                 $html .= '<div class="ribbon-wrapper"><div class="ribbon">PAID</div></div>  ';
            }
            else
            {
                if($currentbalance==$currentamount)
                {
                    $html .= '<style>
                    .ribbon {
                     background-color: #eb4034;
                     color: #fff !important;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">UN PAID</div></div>  ';
                }
                else
                {
                    $html .= '<style>
                    .ribbon {
                     background-color: #fcba03;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">PARTIALLY PAID</div></div>  ';
                }
            }
            if($rows[0]['cancelstatus']=="1")
            {
                $html .= '<style>
                    .ribbon {
                     background-color: #b5b5b5;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">VOID</div></div>';
            }
$html .= '
<div style="border:1px solid #cccccc;border-bottom:none;">
<div>'.($infomainaccessuser['modulename']).'</div>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-23px;">
<span style="width: 16%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:9px 6px !important;text-align:right;margin-top:18px;">';
if ($info['branchimage']!='') {
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
$franchpath = (str_replace('../ups','ups',$img));
$franchtype = pathinfo($franchpath, PATHINFO_EXTENSION);
$franchdata = file_get_contents($franchpath);
$franchbase64 = 'data:image/' . $franchtype . ';base64,' . base64_encode($franchdata);
    $html .= '<img alt="Branch Pic" src="'.($franchbase64).'" id="branch-image1" height="80" width="80">';
    }
}
else{
    $html .= '<img alt="Branch Pic" style="visibility:hidden;" src="data:image/jpeg;base64,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" id="branch-image1" height="80" width="80">';
}
$html .= '</span>
<span style="width: 50%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.($info['franchisename']).'</strong>
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;">'.($info['street']).' '.($info['city']).' '.($info['pincode']).' '.($info['state']).' '.($info['country']).' </span>
<span style="'.(($access['saleorderbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Phone </span>
<span style="'.(($access['saleorderbranchphone']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 80%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
<span style="'.(($access['saleorderbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">E-mail </span>
<span style="'.(($access['saleorderbranchemail']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 47%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['email']).'</span>
<span style="'.(($access['saleorderprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 13%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 20 </span>
<span style="'.(($access['saleorderprintdlno20']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 19%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno20']).'</span>
<span style="'.(($access['saleorderbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 18%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($access['saleorderbranchgstin']=='0')?'visibility:hidden;':'').'display: inline-block;white-space: nowrap;width: 47%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['gstno']).'</span>
<span style="'.(($access['saleorderprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 13%;overflow: hidden;font-size: 12px !important;text-align: left !important;">DL No 21 </span>
<span style="'.(($access['saleorderprintdlno21']=='1')?'visibility:visible;':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 19%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['dlno21']).'</span>
</span>
<span style="width: 30%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;vertical-align: top;">
<span style="'.(($access['saleorderbank']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 35%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Bank </span>
<span style="'.(($access['saleorderbank']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 63%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
<span style="'.(($access['saleordername']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 35%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Name </span>
<span style="'.(($access['saleordername']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 63%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
<span style="'.(($access['saleorderaccnumber']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 35%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Account Number </span>
<span style="'.(($access['saleorderaccnumber']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 63%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
<span style="'.(($access['saleorderifsccode']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 35%;overflow: hidden;font-size: 12px !important;text-align: left !important;">IFSC Code </span>
<span style="'.(($access['saleorderifsccode']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 63%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
<span style="'.(($access['saleorderbranchandcity']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 35%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Branch & City </span>
<span style="'.(($access['saleorderbranchandcity']=='1')?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 63%;overflow: hidden;font-size: 12px !important;text-align: left !important;">: '.($info['mobile']).'</span>
</span>
</div>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-bottom:none;margin-bottom:-28px;">
<span style="width: 33%;display:inline-block;background-color:#eee;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"><strong>Billing Address</strong></span>
<span style="width: 33%;display:inline-block;background-color:#eee;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"><strong>Shipping Address</strong></span>
<span style="width: 33.6%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;"></span>
</div>
<div style="border:1px solid #cccccc;padding-top:3px;text-align: left;border-top:none;border-bottom:none;">
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:3px 6px !important;margin-bottom:-22px;">
<br>
<strong style="'.(($rows[0]['customername']!=''&&(in_array('Billing Name', $fieldview)))?'':'visibility:hidden;').'font-weight:bold;font-size: 13px !important;display: inline-block;width: 293px;overflow: hidden;height: 15px;white-space: nowrap;">'.(ucwords(strtolower($rows[0]['customername']))).'</strong>
<span style="'.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['area']!='')||($rows[0]['city']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 293px;overflow: hidden;">'.(ucwords(strtolower($rows[0]['area']))).' '.(((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'')).' '.(ucwords(strtolower($rows[0]['city']))).'</span>
<span style="'.(((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))&&(((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!='')))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 293px;overflow: hidden;">'.($rows[0]['state']).' '.(((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'')).' '.($rows[0]['pincode']).' '.(((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'')).' '.($rows[0]['district']).'</span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Work Phone </span>
<span style="'.((in_array('Work Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['workphone']).'</b></span>
<span style="'.(($infomainaccessuser['saleorderprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['saleorderprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">GSTIN </span>
<span style="'.(($infomainaccessuser['saleorderprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['saleorderprintgstin']!='hide')&&(in_array('GSTIN', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['gstno']).'</b></span>
</span>
<span style="width: 33%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;margin-bottom:-22px;">
<br>
<strong style="'.(($rows[0]['customername']!=''&&(in_array('Shipping Name', $fieldview)))?'':'visibility:hidden;').'font-weight:bold;font-size: 13px !important;display: inline-block;width: 293px;overflow: hidden;height: 15px;white-space: nowrap;">'.(ucwords(strtolower($rows[0]['customername']))).'</strong>
<span style="'.(((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))&&((($rows[0]['sarea']!='')||($rows[0]['scity']!=''))))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 293px;overflow: hidden;">'.(ucwords(strtolower($rows[0]['sarea']))).' '.(((($rows[0]['sarea']!='')&&($rows[0]['scity']!=''))?',':'')).' '.(ucwords(strtolower($rows[0]['scity']))).'</span>
<span style="'.(((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))&&(($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!='')))?'':'visibility:hidden;').'white-space: nowrap;font-size:12px;display: inline-block;width: 293px;overflow: hidden;">'.($rows[0]['sstate']).' '.(((($rows[0]['sstate']!='')&&($rows[0]['spincode']!=''))?',':'')).' '.($rows[0]['spincode']).' '.(((($rows[0]['sstate']!='')&&($rows[0]['sdistrict']!='')||($rows[0]['spincode']!='')&&($rows[0]['sdistrict']!=''))?',':'')).' '.($rows[0]['sdistrict']).'</span>
<span style="'.((in_array('Mobile Phone', $fieldview))?'':'visibility:hidden;').'display: inline-flex;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Mobile Phone </span>
<span style="'.((in_array('Mobile Phone', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['mobile']).'</b></span>
<span style="'.(($infomainaccessuser['saleorderprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['saleorderprintpos']!='hide')&&(in_array('Place of Supply', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 43%;overflow: hidden;font-size: 12px !important;text-align: left !important;">Place Of Supply </span>
<span style="'.(($infomainaccessuser['saleorderprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['saleorderprintpos']!='hide')&&(in_array('Place of Supply', $fieldview))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 53%;overflow: hidden;font-size: 12px !important;text-align: left !important;"><b style="display: inline-block;white-space: nowrap;width: 123px;overflow: hidden;">: '.($rows[0]['pos']).'</b></span>
</span>
<span style="width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;margin-bottom:-22px;vertical-align:middle;">
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).'</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Number</span></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['salesorderno']).'</strong></span><span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">'.($infomainaccessuser['modulename']).'</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Date</span></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.(date($date,strtotime($rows[0]['salesorderdate']))).'</strong></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 55%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Payment</span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;position:relative;top:3px;">Term</span></span>
<span style="'.(((in_array('Sales Order Information', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 42%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><strong>: '.($rows[0]['salesorderterm']).'</strong></span>
</span>
</div>
</header>
<footer>
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;border-bottom:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;visibility:hidden">
<div style="'.(((in_array('Tax Table', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<td style="font-weight:normal !important;border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE<br>VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">CGST</td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">SGST</td>
<td colspan="2" style="font-weight:normal !important;font-size: 8px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;">GST</td>
</tr>
<tbody style="font-size:10px !important;">
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax25']!='0')?number_format((float)$rows[0]['tax25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0')?number_format((float)$rows[0]['cgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst25']!='0')?number_format((float)$rows[0]['sgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
5%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0'&&$rows[0]['sgst25']!='0')?number_format((float)$rows[0]['gst25'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;"><span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax6']!='0')?number_format((float)$rows[0]['tax6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0')?number_format((float)$rows[0]['cgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst6']!='0')?number_format((float)$rows[0]['sgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
12%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0'&&$rows[0]['sgst6']!='0')?number_format((float)$rows[0]['gst6'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax9']!='0')?number_format((float)$rows[0]['tax9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0')?number_format((float)$rows[0]['cgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst9']!='0')?number_format((float)$rows[0]['sgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
18%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0'&&$rows[0]['sgst9']!='0')?number_format((float)$rows[0]['gst9'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax14']!='0')?number_format((float)$rows[0]['tax14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0')?number_format((float)$rows[0]['cgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst14']!='0')?number_format((float)$rows[0]['sgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
28%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0'&&$rows[0]['sgst14']!='0')?number_format((float)$rows[0]['gst14'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td colspan="5" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td colspan="2" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;visibility:hidden">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
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
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
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
<b style="width: 49.5%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
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
<span style="display: inline-block;white-space: nowrap;width: 48.5%;font-size: 12px !important;text-align: left !important;position:relative;top:11px;"><b> '.($rows[0]['terms']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;font-size: 12px !important;text-align: center !important;position:relative;top:23px;font-weight:bold;left:63px;">Pages </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;font-size: 12px !important;text-align: left !important;position:relative;top:11px;"><b> '.($rows[0]['terms']).'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;visibility:hidden;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 238px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">For </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> '.($info['franchisename']).'</strong>
</span>
</div>
</footer>
<div style="border: 0px solid #cccccc;width:100% !important;">
<table style="border: 0px solid #cccccc;width:100% !important;">
<thead>
<tr>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;">ITEM DETAILS</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;'.((in_array('Product Category', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;max-width: 78px;max-height: 13px;">'.($access['txtnamecategory']).'</span></th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">BATCH</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">EXPIRY</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;">HSN/SAC</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;'.((in_array('Product Mrp', $fieldview))?'':'display:none !important;').'">MRP</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;">RATE</th>
<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;">QUANTITY</th>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;">GST%</th>';
}
if ((in_array('Tax Value', $fieldview))) {
$html .= '<th style="border: 1px solid #cccccc;font-size: 11px !important;padding:0px 6px !important;text-align: right !important;">TAXABLE VALUE</th>';
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
$html .= '<tr>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;max-width: 350px !important;overflow: hidden;line-height: 18px;white-space: normal !important;">
'.((($row['productname']!='')?$row['productname']:'')).'<br><span style="position:relative;top:-3px;">'.((($row['productdescription']!='')?$row['productdescription']:'')).'</span>
</td>
<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.((in_array('Product Category', $fieldview))?'':'display:none !important;').'">
'.((($row['manufacturer']!='')?$row['manufacturer']:'')).'
</td>
<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">
'.((($row['batch']!='')?$row['batch']:'')).'
</td>';
$dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='0')) {
$date = '';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='1')) {
$date = 'd/m/Y';
}
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='1')) {
$date = 'm/Y';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='1')) {
$date = 'd/Y';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='0')) {
$date = 'd/m';
}
if (($access['saleorderprintexpdate']=='1')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='0')) {
$date = 'd';
}
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='1')&&($access['saleorderprintexpyear']=='0')) {
$date = 'm';
}
if (($access['saleorderprintexpdate']=='0')&&($access['saleorderprintexpmonth']=='0')&&($access['saleorderprintexpyear']=='1')) {
$date = 'Y';
}
    }
$html .= '<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">
'.((($row['expdate']!='')?date($date,strtotime($row['expdate'])):'')).'
</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;">'.((($row['producthsn']!='')?$row['producthsn']:'')).'</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;'.((in_array('Product Mrp', $fieldview))?'':'display:none !important;').'">'.((($row['mrp']!='')?number_format((float)$row['mrp'],2,'.',''):'')).'</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;">'.((($row['productrate']!='0')?(number_format((float)$row['productrate'],2,'.','')):'Free')).'</td>
    <td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;">'.($row['quantity']).'</td>';
if ((in_array('Taxable Value', $fieldview))) {
$html .= '<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;">'.((($row['vat']!='')?$row['vat'].'%':'')).'</td>';
}
if ((in_array('Tax Value', $fieldview))) {
$html .= '<td style="font-size: 10px !important;border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;">'.((($row['productvalue']!='0')?(number_format((float)$row['productvalue'],2,'.','')):'Free')).'</td>';
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
<div style="border:1px solid #cccccc;padding-top:5px;text-align: left;border-top:none;">
<span style="margin-bottom:-35px;width: 27%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:5px 6px 5px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['totalitems']).'</b></span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Prepared By </span>
<span style="'.(((in_array('Prepared By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['preparedby']).'</b></span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Checked By </span>
<span style="'.(((in_array('Checked By', $fieldview)))?'':'visibility:hidden;').'display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;"><b>: '.($rows[0]['checkedby']).'</b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;">Total Items </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;visibility:hidden;"><b>: totalitems</b></span>
</span>
<span style="margin-bottom:-36px;width: 39%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-top:9px;border-left:1px solid #cccccc;">
<div style="'.(((in_array('Tax Table', $fieldview)))?'':'visibility:hidden;').'">
<table width="100%" style="padding:0px !important;">
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<td style="font-weight:normal !important;border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: right !important;">TAXABLE<br>VALUE <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span></td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">CGST</td>
<td colspan="2" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 8px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;">SGST</td>
<td colspan="2" style="font-weight:normal !important;font-size: 8px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;">GST</td>
</tr>
<tbody style="font-size:10px !important;">
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax25']!='0')?number_format((float)$rows[0]['tax25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0')?number_format((float)$rows[0]['cgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst25']!='0')?number_format((float)$rows[0]['sgst25'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
5%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst25']!='0'&&$rows[0]['sgst25']!='0')?number_format((float)$rows[0]['gst25'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;"><span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax6']!='0')?number_format((float)$rows[0]['tax6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0')?number_format((float)$rows[0]['cgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst6']!='0')?number_format((float)$rows[0]['sgst6'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
12%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst6']!='0'&&$rows[0]['sgst6']!='0')?number_format((float)$rows[0]['gst6'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax9']!='0')?number_format((float)$rows[0]['tax9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0')?number_format((float)$rows[0]['cgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst9']!='0')?number_format((float)$rows[0]['sgst9'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
18%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst9']!='0'&&$rows[0]['sgst9']!='0')?number_format((float)$rows[0]['gst9'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 8px !important;padding: 0px 3px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 60px;overflow: hidden;">'.(($rows[0]['tax14']!='0')?number_format((float)$rows[0]['tax14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0')?number_format((float)$rows[0]['cgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['sgst14']!='0')?number_format((float)$rows[0]['sgst14'],2,'.',''):'0.00').'</span>
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
28%
</td>
<td style="padding: 0px 3px !important;border-bottom: 1px solid #cccccc;font-size: 8px !important;text-align: right !important;">
<span style="display: inline-block;white-space: nowrap;width: 23px;overflow: hidden;">'.(($rows[0]['cgst14']!='0'&&$rows[0]['sgst14']!='0')?number_format((float)$rows[0]['gst14'],2,'.',''):'0.00').'</span>
</td>
</tr>
<tr>
<td colspan="5" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td colspan="2" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 8px !important;padding: 0px 6px !important;"><b><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</b></td>
</tr>
</tbody>
</table>
</td>
</tr>
</table>
</div>
</span>
<span style="margin-bottom:-26px;width: 29%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Sub Total </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Discount </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['discountamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Total Tax </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['totalvatamount'],2,'.','')).'</span></b></span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;text-align: left !important;">Round Off </span>
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 14px !important;"><span style="font-family: DejaVu Sans; sans-serif;font-weight:700;">: &#8377;</span><b> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['roundoff'],2,'.','')).'</span></b></span>
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
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
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
$html .= '<span style="width: 67.6%;display:inline-block;margin-right: -4.5px;border-right: 1px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-4px;">
<b style="width: 99.9%;display:inline-block;overflow:hidden;">Grand Total In Words : '.$finals.'</b>
</span>
<span style="width: 28.9%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:1px 6px !important;font-size:15px;white-space: nowrap;margin-bottom:-9px;">
<b style="width: 48%;display:inline-block;overflow:hidden;">Grand Total </b>
<b style="width: 49.5%;display:inline-block;overflow:hidden;">: <span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> <span style="display:inline-block;width:76px;text-align:right;overflow:hidden;position:relative;top:3px;">'.(number_format((float)$rows[0]['grandtotal'],2,'.','')).'</span></b>
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
<span style="display:block;height:23px;padding-left:54px;position:relative;top:6px;">Printed</span>
<span style="width: 1%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp;</span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:center;overflow:hidden;width:95%;position:relative;top:-9px;left:-10px;">Pages</strong>
</span>
<span style="'.(((in_array('Terms and Conditions', $fieldview)))?'':'visibility:hidden;').'width: 33%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-11px;">
<span style="display: inline-block;white-space: nowrap;width: 48%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;left:3px;">Terms and Conditions </span>
<span style="display: inline-block;white-space: nowrap;width: 48.5%;overflow: hidden;font-size: 12px !important;text-align: left !important;position:relative;top:18px;background-color:white;height:27px;"><b>: '.($rows[0]['terms']).'</b></span>
<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">&nbsp; </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> </strong>
</span>
<span style="width: 28.3%;display:inline-block;margin-right: -4.5px;border-right: 0px solid #cccccc;padding:6px 3px 0px 3px !important;font-size:12px;white-space: nowrap;border-bottom:0px solid #cccccc;margin-top:10px;margin-bottom:-12px;border-left:1px solid #cccccc;">';
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
$signpath = str_replace('../ups','ups',$img);
$signtype = pathinfo($signpath, PATHINFO_EXTENSION);
$signdata = file_get_contents($signpath);
$signbase64 = 'data:image/' . $signtype . ';base64,' . base64_encode($signdata);
    $html .= '<img alt="Sign Pic" src="'.($signbase64).'" id="sign-image1" style="width: 278px !important;height: 25px !important;'.(($info['signimage']!='')?'':'visibility:hidden;').'">';
    }
$html .= '<span style="width: 45%;display:inline-block;margin-right: -4.5px;position:relative;top:6px;padding:6px !important;font-size:12px;white-space: nowrap;text-align:right;overflow:hidden;">For </span><strong style="font-size:12px !important;display:inline-block;white-space: nowrap;text-align:left;overflow:hidden;width:51%;"> '.($info['franchisename']).'</strong>
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
$mask = 'dompdf/Sales Orders-*.*';
array_map('unlink', glob($mask));
$output = $dompdf->output();
file_put_contents("dompdf/".$_GET['names'].".pdf", $output);
}
?>