<?php
include('lcheck.php');
$sqlismainaccesspro=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
$infomainaccesspro=mysqli_fetch_array($sqlismainaccesspro);
$sqlismainaccessinvadj=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessinvadj=mysqli_fetch_array($sqlismainaccessinvadj);
// if (isset($_POST['storeaccess'])) {
// 	$store=mysqli_real_escape_string($con,$_POST['storeaccess']);
// 	$sql=mysqli_query($con,"update into paircontrols set storeaccess='$store' where createdby='".$_SESSION['unqwerty']."'");
// }
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
   Dashboard
  </title>
<style type="text/css">
        .wrapper{
            width: 370px;
            margin: 130px auto 0;
        }
        .select-btn{
            height: 65px;
            padding: 0 20px;
            border-radius: 7px;
            background: blue;
            display: flex;
            font-size: 22px;
            align-items: center;
            justify-content: space-between;
        }
        .content{
            display: none;
            padding: 20px;
            margin-top: 15px;
            border-radius: 7px;
            background: #fff;
        }
        .wrapper.active .content{
            display: block;
        }
        .content .search{
            position: relative;
        }
        .search input{
            height: 53px;
            width: 100%;
            font-size: 17px;
            outline: none;
            border-radius: 5px;
            padding: 0 15px 0 43px;
            border: 1px solid #b3b3b3;
        }
        .content .options{
            margin-top: 10px;
            max-height: 250px;
            overflow-y: auto;
            padding-right: 7px;
        }
        .options::-webkit-scrollbar{
            width: 7px;
        }
        .options::-webkit-scrollbar-track{
            background: #f1f1f1;
            border-radius: 25px;
        }
        .options::-webkit-scrollbar-thumb{
            background: #ccc;
            border-radius: 25px;
        }
        .options li{
            height: 50px;
            border-radius: 5px;
            padding: 0 13px;
            font-size: 21px;
        }
        .options li:hover{
            background-color: green;
        }
        /*p:hover{
            background-color: green;
        }*/
        .select-btn, .options li{
            display: flex;
            cursor: pointer;
            align-items: center;
        }
    .software-box {
      border: 1px solid #dee2e6;
      padding: 9px;
      margin: -3px -9px;
      transition: transform 0.3s ease-in-out;
      cursor: pointer;
      border-radius: 0px;
    }

    .software-box p {
      color: green;
      font-size: 10px;
    }
      #loginforms .col-lg-2{
        margin: 16px 25px 16px 0px;
        padding: 0px 8px;
      }
      #loginforms button{
        width: 115%;
      }
    @media only screen and (max-width: 991px) {
      #loginforms button{
        width: 100% !important;
      }
    }
  .blinkrow{
    background-color: red !important;
    color: white !important;
    animation: blinkrows 1s linear infinite;
  }
  @keyframes blinkrows{
    0%{opacity: 0;}
    50%{opacity: .5;}
    100%{opacity: 1;}
  }
    </style>
</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6">
  <?php
  include('sidebar.php');
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
   <?php
    include('navhead.php');
    ?>  
    <div class="container-fluid py-3 bg-body" style="min-height:400px;">
        <?php
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
          <div class="card mb-4 mt-5 p-3">
             <div class="card-body p-0">
             	<div style="padding: 6px 10px 10px 10px;">
                <span style="padding: 6px 6px 6px 10px; font-size: 18px; margin-top: -1.5px;width: 35px; height: 35px; text-align:center; border-radius:0px;background-color: #<?=$colsarry[0]?>; color: #fff;"><?=substr($_SESSION["firstname"],0,1)?> </span>
                <span style="font-size: 15px;color: black;font-weight: 450;"> &nbsp;&nbsp;&nbsp;Hello, <?=$_SESSION["firstname"]?></span>
             </div>
                 <div class="customcont-header ml-0 mb-1" style="height:41px;">
					<a class="customcont-heading customcont-heading-active" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Dashboard</a>
				</div>
<?php

//FOR ARGON2ID PASSWORD HASHING GENERATOR

// echo 'pairscriptpvtltd==='.argon2idHash('pairscriptpvtltd','pairscriptpvtltd').'<br>';

//FOR ARGON2ID PASSWORD HASHING GENERATOR

$sqlcontrol = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultcontrol = mysqli_query($con, $sqlcontrol);
$sidebarprefer = mysqli_fetch_array($resultcontrol);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){}
else{
if ($franchisesrole!='') {
$bellnotifications = 0;
$sqliexpdate=mysqli_query($con, "select expdate,remindon,renewalamount,renewalfor from paircontrols where id='".$companymainid."' order by id desc");
$infoexpdate=mysqli_fetch_array($sqliexpdate);
$expirationDate = strtotime($infoexpdate['expdate']);
$currentDate = time();
$remainingDays = ($expirationDate - $currentDate) / (60 * 60 * 24);
if ($remainingDays > 0) {
	$expdays = "".date('F j, Y',strtotime($infoexpdate['expdate']))."";
	$reminingdays =  "(" . round($remainingDays) . " days left)";
}
else {
	$expdays = "Your license is expired.";
	$reminingdays = "Contact Pairscript to activate it.";
}
$expiryDate = strtotime($infoexpdate['expdate']);
$reminderDays = $infoexpdate['remindon'];
$reminderDate = strtotime("-$reminderDays days", $expiryDate);
$currentDate = time();
if ($currentDate >= $reminderDate) {
$bellnotifications = 1;
}
?>
<div class="row mt-3 p-3" style="margin-bottom: -15px;margin-left: -5px;">
	<div class="col-lg-3" id="loginforms">
      <div class="software-box <?=(($bellnotifications==1)?'blinkrow':'')?>" style="background-color: #2b78f1;max-height: 150px;min-height: 150px;">
        <div style="color:white !important;" class="row">
          <div class="col-12" style="font-family:'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;text-align:left;font-size: 14px;line-height: 1.5em;font-weight: 600;margin-bottom: 11px !important;">EXPIRATION DATE</div>
          <div class="col-12" style="font-family:'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;text-align:left;font-size: 18px;font-weight:600;letter-spacing:.04em;line-height: 1.5rem;"><?=$expdays?></div>
          <div class="col-12 mb-3" style="font-family:'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;text-align:left;font-size: 16px;line-height: 1.5em;font-weight: 600;"><?=$reminingdays?></div>
          <div class="col-12 mb-3" style="font-family:'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;text-align:left;font-size: 9px;line-height: 0.1em;font-weight: 600;">License Renewal Amount = <?=$resmaincurrencyans?> <?=$infoexpdate['renewalamount']?> <?=$infoexpdate['renewalfor']?></div>
          <div class="col-12" style="font-family:'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;text-align:left;font-size: 13px;line-height:1rem;">
          	Contact
          </div>
        </div>
      </div>
   </div>
</div>
	<div class="row mt-3 p-3">
	<?php
	$receivablesel = mysqli_query($con,"select sum(invoiceamount) as invoiceamount,sum(balanceamount) as balanceamount,sum(overdueamount) as overdueamount,sum(currentamount) as currentamount from paircustomers where moduletype='Customers' and franchisesession='".$_SESSION['franchisesession']."'");
	$receivablefet = mysqli_fetch_array($receivablesel);
	if($receivablefet['invoiceamount']>0)
	{
	$receivableper=(((float)$receivablefet['invoiceamount']-(float)$receivablefet['balanceamount'])/(float)$receivablefet['invoiceamount'])*100;
	}
	else
	{
	$receivableper=0;
	}
	$sqlmainaccessreceivablesale = mysqli_query($con,"select receivablesales,moduleaccess from pairmainaccess where userid='$companymainid' and moduletype='Invoices'");
    $sqlreceivablesale = mysqli_fetch_assoc($sqlmainaccessreceivablesale);
    if (($sqlreceivablesale['receivablesales']==1)&&($sqlreceivablesale['moduleaccess']=='1')) {
	?>
	<div class="col-lg-6" style="margin-bottom:13px;">
		<table class="table table-bordered">
			<tr>
				<td colspan="2" class="text-center" style="font-size:14px;">Total Receivables</td>
			</tr>
			<tr>
				<td colspan="2" class="text-lef" style="font-size:10px; color:#0f0f0f">
					Total Unpaid Invoices <i class="fa fa-rupee"></i> <?=number_format((float)$receivablefet['balanceamount'],2,'.','')?>
				<div class="progress" style="width:100%; height:10px;background-color:rgb(236, 202, 110)">
    				<div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?=$receivableper?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$receivableper?>%; margin:0; height:10px; "></div>
  				</div>
				</td>
			</tr>
			<tr class="text-center">
				<td>
					<span class="text-blue" style="font-size:10px;" >CURRENT</span>
					<br>
					<span style="font-size:18px;"><i class="fa fa-rupee"></i> <?=number_format((float)$receivablefet['currentamount'],2,'.','')?></span>
				</td>
				<td>
					<span class="text-danger" style="font-size:10px;" >OVERDUE</span>
					<br>
					<span style="font-size:18px;"><i class="fa fa-rupee"></i> <?=number_format((float)$receivablefet['overdueamount'],2,'.','')?></span>
				</td>
			</tr>
		</table>
	</div>
	<?php
	}
	$payablesel = mysqli_query($con,"select sum(invoiceamount) as invoiceamount,sum(balanceamount) as balanceamount,sum(overdueamount) as overdueamount,sum(currentamount) as currentamount from paircustomers where moduletype='Vendors' and franchisesession='".$_SESSION['franchisesession']."'");
	$payablefet = mysqli_fetch_array($payablesel);
	if($payablefet['invoiceamount']>0)
	{
	$payableper=(((float)$payablefet['invoiceamount']-(float)$payablefet['balanceamount'])/(float)$payablefet['invoiceamount'])*100;
	}
	else
	{
	$payableper=0;
	}
	$sqlmainaccesspayablepurchase = mysqli_query($con,"select payablepurchase,moduleaccess from pairmainaccess where userid='$companymainid' and moduletype='Bills'");
    $sqlpayablepurchase = mysqli_fetch_assoc($sqlmainaccesspayablepurchase);
	if (($sqlpayablepurchase['payablepurchase']==1)&&($sqlpayablepurchase['moduleaccess']=='1')) {
	?>
	<div class="col-lg-6" style="margin-bottom:13px;">
		<table class="table table-bordered">
			<tr>
				<td colspan="2" class="text-center" style="font-size:14px;">Total Payables</td>
			</tr>
			<tr>
				<td colspan="2" class="text-lef" style="font-size:10px; color:#0f0f0f">
					Total Unpaid Bills <i class="fa fa-rupee"></i> <?=number_format((float)$payablefet['balanceamount'],2,'.','')?>
				<div class="progress" style="width:100%; height:10px;background-color:rgb(236, 202, 110)">
    				<div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?=$payableper?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$payableper?>%; margin:0; height:10px; "></div>
  				</div>
				</td>
			</tr>
			<tr class="text-center">
				<td>
					<span class="text-blue" style="font-size:10px;" >CURRENT</span>
					<br>
					<span style="font-size:18px;"><i class="fa fa-rupee"></i> <?=number_format((float)$payablefet['currentamount'],2,'.','')?></span>
				</td>
				<td>
					<span class="text-danger" style="font-size:10px;" >OVERDUE</span>
					<br>
					<span style="font-size:18px;"><i class="fa fa-rupee"></i> <?=number_format((float)$payablefet['overdueamount'],2,'.','')?></span>
				</td>
			</tr>
		</table>
	</div>
	<?php
	}
	?>
	<!-- </div> -->
	<?php
	if ($access['dashexppro']==1) {
	?>
	<!-- <div class="row mt-3 p-3"> -->
	<div class="col-lg-6" style="margin-bottom:13px;">
	<div style="min-height: 150px;max-height: 150px;overflow: auto;border: 1px solid #ddd;padding: 0px;border-radius: 0px;" id="scrollproexp">
	<div style="background-color: #eee;position: -webkit-sticky;position: sticky;top: 0;padding: 2px !important;margin-bottom: 0px !important;z-index: 1;">
		<table width="100%">
			<tr>
				<td align="left">Expiring <?=$infomainaccesspro['modulename']?></td>
				<td align="right" style="<?=(($access['expinvadjcheck']==1)?'':'display: none;')?>"><a style="background-color: #1BBC9B !important;color: #fff !important;padding: 3px;border-radius: 3px;text-decoration: none;" onclick="window.open('adjustmentadd.php?types=das','_self')"><?=$infomainaccessinvadj['modulename']?></a></td>
			</tr>
		</table>
	</div>
	<table class="table table-bordered mobviewtab">
	<thead style="position: -webkit-sticky;position: sticky;top: 24px;background-color: #e1e1e1;z-index: 1;">
		<tr style="vertical-align: middle;">
			<td style="padding: 0rem 0.3rem;font-size:15px;font-weight: 500;"><?=$infomainaccesspro['modulename']?> Name</td>
			<td style="padding: 0rem 0.3rem;font-size:15px;font-weight: 500;">Quantity</td>
			<td style="padding: 0rem 0.3rem;font-size:15px;font-weight: 500;">Batch</td>
			<td style="padding: 0rem 0.3rem;font-size:15px;font-weight: 500;">Expiry</td>
		</tr>
	</thead>
	<tbody id="expprotable">
	<?php
	$currentDateNow = new DateTime();
	$NowDateValue = new DateTime();
	$finalNowDate = $NowDateValue->format('Y-m-d');
	$dateexpmax = $access['proexpdate'];
	$currentDateNow->modify('+'.$dateexpmax.' days');
	$finalDateAfter = $currentDateNow->format('Y-m-d');
	$expiryproducts = mysqli_query($con,"select pairbatch.productid,pairbatch.productname,pairbatch.quantity,pairbatch.batch,pairbatch.expdate from pairbatch join pairproducts on pairproducts.id=pairbatch.productid and pairproducts.isactive='0' where pairbatch.expdate!='' and pairbatch.createdid='$companymainid' and pairbatch.franchisesession='".$_SESSION["franchisesession"]."' and pairbatch.quantity>=1 GROUP BY pairbatch.batch,pairbatch.expdate,pairbatch.productname order by pairbatch.expdate asc,pairbatch.quantity desc limit 5");
	if (mysqli_num_rows($expiryproducts)>0) {
	while($expiryprofetch = mysqli_fetch_array($expiryproducts)){
	if (($expiryprofetch['expdate']<=$finalDateAfter)) {
if ($expiryprofetch['expdate']>$finalDateAfter) {
$classnames = 'nothing';
}
else if ($expiryprofetch['expdate']<$finalDateAfter) {
$classnames = 'onlyblink';
}
else if ($expiryprofetch['expdate']==$finalDateAfter) {
$classnames = 'onlyred';
}
	?>
		<tr style="vertical-align: middle;" class="<?=$classnames?>">
			<td data-label="<?=$infomainaccesspro['modulename']?> Name" style="padding: 0rem 0.3rem;font-size:13px;"><span style="display: inline-block;max-width: 300px;"><?=$expiryprofetch['productname']?></span></td>
			<td data-label="Quantity" style="padding: 0rem 0.3rem;font-size:13px;"><span style="display: inline-block;max-width: 80px;"><?=$expiryprofetch['quantity']?></span></td>
			<td data-label="Batch" style="padding: 0rem 0.3rem;font-size:13px;"><span style="display: inline-block;max-width: 80px;"><?=($expiryprofetch['batch']!='')?$expiryprofetch['batch']:'&nbsp;'?></span></td>
			<td data-label="Expiry" style="padding: 0rem 0.3rem;font-size:13px;"><span style="display: inline-block;max-width: 80px;"><?=date($datemainphp,strtotime($expiryprofetch['expdate']))?></span></td>
		</tr>
	<?php
	}
	}
	}
	else{
	?>
	<tr style="vertical-align: middle;">
		<td style="padding: 0rem 0.3rem;font-size:13px;" colspan="4">No Results Found</td>
	</tr>
	<?php
	}
	?>
	<style type="text/css">
	.onlyred{
		color: red !important;
	}
	.onlyblink{
		color: red !important;
		animation: onlyblinks 1s linear infinite;
	}
	@keyframes onlyblinks{
		0%{opacity: 0;}
		50%{opacity: .5;}
		100%{opacity: 1;}
	}
	</style>
	</tbody>
	</table>
	<div style="text-align: center !important;display: none;" id="loadimg">
		<img src="loading.gif" alt="Loading..." style="margin-top: -60px;width: 300px;height: 300px;" id="loadimgins">
	</div>
	</div>
	</div>
	</div>
	<?php
	}
	?>
<script type="text/javascript">
var sIndex = 6, offSet = 5, isPreviousEventComplete = true, isDataAvailable = true;
$('#scrollproexp').on('scroll', function() {
var scrollTop = $(this).scrollTop();
if (scrollTop + $(this).innerHeight() >= this.scrollHeight-50) {
if (isPreviousEventComplete && isDataAvailable) {
isPreviousEventComplete = false;
$("#loadimg").css("display","block");
console.log('ss');
// ajax for get
$.ajax({
type: "GET",
url: 'dashboardsearch.php?term=' + sIndex + '&types=proexpdate',
success: function (result) {
$("#expprotable").append(result);
sIndex = sIndex + offSet;
isPreviousEventComplete = true;
if (result == '') //When data is not available
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
</script>
<?php
}
}
?>
	<!-- 
	<?php
                // if($franchisesrole!='')
                // {
            ?>  
	<div class="row mt-3">
	<?php
	// $sqliinvoice=mysqli_query($con, "select invoiceamount, invoicedate, invoiceno from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc");
	// $invoiceamount=0;
	// $balanceamount=0;
	// $currentamount=0;
	// $overdueamount=0;
	// while($infoinvoice=mysqli_fetch_array($sqliinvoice))
	// {
	// 	$invoiceamount+=(float)$infoinvoice['invoiceamount'];
	// 	$paidamount=0;
	// 	$sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$infoinvoice['invoiceno']."' and invoicedate='".$infoinvoice['invoicedate']."' order by id desc");
	// 	while($infosalespay=mysqli_fetch_array($sqlsalespay))
	// 	{
	// 		$paidamount+=(float)$infosalespay['amount'];
	// 	}
	// 	$balanceamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
	// 	$diff = abs(time() - strtotime($infoinvoice['invoicedate']));
	// 	$days = floor(($diff)/ (60*60*24));
	// 	if($days>30)
	// 	{
	// 		$overdueamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
	// 	}
	// 	else
	// 	{
	// 		$currentamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
	// 	}
	// }
	// if($invoiceamount>0)
	// {
	// $invper=(((float)$invoiceamount-(float)$balanceamount)/(float)$invoiceamount)*100;
	// }
	// else
	// {
	// 	$invper=0;
	// }

    // $sqlmainaccessreceivablesale = mysqli_query($con,"select receivablesales from pairmainaccess where (userid='$companymainid' or createdid='0' or franchiseid='".$_SESSION['franchisesession']."')");
    // $sqlreceivablesale = mysqli_fetch_assoc($sqlmainaccessreceivablesale);
    // if ($sqlreceivablesale['receivablesales']==1) {
	?>
	<div class="col-lg-6">
	<table class="table table-bordered">
	<tr>
	<td colspan="2" class="text-center" style="font-size:14px;">Total Receivables</td>
	</tr>
	<tr>
	<td colspan="2" class="text-lef" style="font-size:10px; color:#0f0f0f">
	Total Unpaid Invoices <i class="fa fa-rupee"></i> <?=number_format((float)$balanceamount,2,'.','')?>
	<div class="progress" style="width:100%; height:10px;background-color:rgb(236, 202, 110)">
    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?=$invper?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$invper?>%; margin:0; height:10px; "></div>
  </div>
</td>
	</tr>
	<tr class="text-center">
	<td><span class="text-blue" style="font-size:10px;" >CURRENT</span>
		<br><span style="font-size:18px;"><i class="fa fa-rupee"></i> <?=number_format((float)$currentamount,2,'.','')?></span>
		</td>
	<td><span class="text-danger" style="font-size:10px;" >OVERDUE</span>
		<br><span style="font-size:18px;"><i class="fa fa-rupee"></i> <?=number_format((float)$overdueamount,2,'.','')?></span>
		</td>
	</tr>
	</table>
	</div>
	
	
	<?php
// }
// 	$sqlibill=mysqli_query($con, "select billamount, billdate, billno from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY billdate, billno order by billdate desc, billno desc");
// 	$billamount=0;
// 	$balanceamount=0;
// 	$currentpamount=0;
// 	$overpdueamount=0;
// 	while($infobill=mysqli_fetch_array($sqlibill))
// 	{
// 		$billamount+=(float)$infobill['billamount'];
// 		$paidamount=0;
// 		$sqlpurchasepay=mysqli_query($con,"select amount from pairpurchasepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='".$infobill['billno']."' and billdate='".$infobill['billdate']."' order by id desc");
// 		while($infopurchasepay=mysqli_fetch_array($sqlpurchasepay))
// 		{
// 			$paidamount+=(float)$infopurchasepay['amount'];
// 		}
// 		$balanceamount+=((float)$infobill['billamount']-$paidamount);
// 		$diff = abs(time() - strtotime($infobill['billdate']));
// 		$days = floor(($diff)/ (60*60*24));
// 		if($days>30)
// 		{
// 			$overpdueamount+=((float)$infobill['billamount']-$paidamount);
// 		}
// 		else
// 		{
// 			$currentpamount+=((float)$infobill['billamount']-$paidamount);
// 		}
// 	}
// 	if($billamount>0)
// 	{
// 	$invper=(((float)$billamount-(float)$balanceamount)/(float)$billamount)*100;
// 	}
// 	else
// 	{
// 	$invper=0;	
// 	}

//     $sqlmainaccesspayablepurchase = mysqli_query($con,"select payablepurchase from pairmainaccess where (userid='$companymainid' or createdid='0' or franchiseid='".$_SESSION['franchisesession']."')");
//     $sqlpayablepurchase = mysqli_fetch_assoc($sqlmainaccesspayablepurchase);
//     if ($sqlpayablepurchase['payablepurchase']==1) {
	?>
	<div class="col-lg-6">
	<table class="table table-bordered">
	<tr>
	<td colspan="2" class="text-center" style="font-size:14px;">Total Payables</td>
	</tr>
	<tr>
	<td colspan="2" class="text-lef" style="font-size:10px; color:#0f0f0f">
	Total Unpaid Bills <i class="fa fa-rupee"></i> <?=number_format((float)$balanceamount,2,'.','')?>
	<div class="progress" style="width:100%; height:10px;background-color:rgb(236, 202, 110)">
    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?=$invper?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$invper?>%; margin:0; height:10px; "></div>
  </div>
</td>
	</tr>
	<tr class="text-center">
	<td><span class="text-blue" style="font-size:10px;" >CURRENT</span>
		<br><span style="font-size:18px;"><i class="fa fa-rupee"></i> <?=number_format((float)$currentpamount,2,'.','')?></span>
		</td>
	<td><span class="text-danger" style="font-size:10px;" >OVERDUE</span>
		<br><span style="font-size:18px;"><i class="fa fa-rupee"></i> <?=number_format((float)$overpdueamount,2,'.','')?></span>
		</td>
	</tr>
	</table>
	</div>
	
	</div>
	<div class="row">
	<?php
// }
// 	if($storeaccess=='1')
// 	{
// ?>
// 	<div class="col-lg-9">
// 	<div class="row">
// 	<?php
// 	$sqli=mysqli_query($con, "select id,franchisename from pairfranchises where tdelete='0' and createdby='".$_SESSION['unqwerty']."' order by id asc");
// 	while($info=mysqli_fetch_array($sqli))
// 	{
// $sql2=mysqli_query($con, "select quotationdate, quotationno, customername, quotationterm, duedate, quotationamount, cancelstatus, estimatestatus, viewstatus, proformastatus from pairquotations where franchisesession='".$info['id']."' and createdid='$companymainid' GROUP BY quotationdate, quotationno order by quotationdate desc, quotationno desc");
	 			  
// 				  $count=0;
// 				  $view=0;
// 				  while($info2=mysqli_fetch_array($sql2))
// 				  {
// 					  if(($info2['estimatestatus']=='0')&&($info2['cancelstatus']=='0')&&($info2['proformastatus']=='0'))
// 					  {
// 						  $count++;
// 						  if($info2['viewstatus']=='')
// 						  {
// 							  $view++;
// 						  }
// 					  }
// 				  }
				  
// 				  $countp=0;
// 				  $viewp=0;
// $sql2=mysqli_query($con, "select purchaseorderdate, purchaseorderno, vendorname, purchaseorderterm, duedate, purchaseorderamount, cancelstatus, estimatestatus, viewstatus from pairpurchaseorders where franchisesession='".$info['id']."' and createdid='$companymainid' GROUP BY purchaseorderdate, purchaseorderno order by purchaseorderdate desc, purchaseorderno desc");
	 			  
				  
// 				  while($info2=mysqli_fetch_array($sql2))
// 				  {
// 					  if(($info2['estimatestatus']=='0')&&($info2['cancelstatus']=='0'))
// 					  {
// 						  $countp++;
// 						  if($info2['viewstatus']=='')
// 						  {
// 							  $viewp++;
// 						  }
// 					  }
// 				  } 

	?>
	<div class="col-lg-4">
	
	<table class="table table-bordered">
	<tr>
	<td colspan="2" class="text-center" style="font-size:14px;"><?=strtoupper($info['franchisename'])?></td>
	</tr>
	<tr class="text-center" onclick="window.location = 'changefranchise1.php?cid=<?=$info['id']?>&type=quotations';">
	<td><span class="text-blue" style="font-size:10px;" >QUOTATIONS<BR>(NOT CONVERTED)</span>
		<br><span style="font-size:18px;"><?=$count?></span>
		</td>
	<td><span class="text-blue" style="font-size:10px;" >NEW QUOTATION</span>
		<br><br><span style="font-size:18px;"><?=$view?></span>
		</td>
	</tr>
	<tr class="text-center" onclick="window.location = 'changefranchise1.php?cid=<?=$info['id']?>&type=purchaseorders';">
	<td><span class="text-blue" style="font-size:10px;" >PURCHASE ORDERS<BR>(NOT CONVERTED)</span>
		<br><span style="font-size:18px;"><?=$countp?></span>
		</td>
	<td><span class="text-blue" style="font-size:10px;" >NEW PURCHASE ORDER</span>
		<br><br><span style="font-size:18px;"><?=$viewp?></span>
		</td>
	</tr>
	</table>
	
	</div>
		<?php
	// }
	?>
	</div>
	
	</div>
	
	<?php 
	// }
	?>
	<?php
                // }

    // $sqlmainaccessnotification = mysqli_query($con,"select dashboardnotification from pairaccess where createdid='$companymainid' and createdby='control'");
    // $sqlnotification = mysqli_fetch_assoc($sqlmainaccessnotification);
    // if ($sqlnotification['dashboardnotification']==1) {
                ?>
	<div class="col-lg-3">
	<div class="row">
	<div class="col-lg-12">
	<table class="table table-bordered">
	<tr>
	<td colspan="2" class="text-center" style="font-size:14px;">NOTIFICATIONS</td>
	</tr>
	<tr>
	<td>
	<form action="notificationadds.php" method="post">
	<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="form-group row">
            <div class="col-sm-12">
            <label for="notification" class="custom-label mb-1" data-toggle="tooltip" title="Type Notification Content" data-placement="top">Type Notification Content</label>
            </div>
                      <div class="col-sm-12 ali">
              <textarea class="form-control  form-control-sm" id="notification" name="notification" placeholder="Notification Content" style="height:120px;" required></textarea>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center" >
    <div class="col-lg-12">
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Send</span> <span
                                                                class="spinner"></span>
                                                        </button>  <button type="reset" class="btn btn-primary btn-sm btn-custom-grey" >Clear</button>
    </div>
</div>
</form>	
	</td>
	</tr>
	</table>
	</div>
	
	</div>
	
	
	</div>
	<?php
// }
?> -->
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
</body>

</html>