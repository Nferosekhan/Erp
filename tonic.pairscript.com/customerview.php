<?php
include('lcheck.php');
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customers' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
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

$sqlget=mysqli_query($con,"select * from paircurrency");
$row=mysqli_fetch_array($sqlget);
$ans=$row['currencysymbol'];
$res=explode('-',$ans);
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($con, $_GET['id']);
$sqls=mysqli_query($con,"select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and id='".$id."'");
// $anss=mysqli_fetch_array($sqls);
if(mysqli_num_rows($sqls)>0)
{
$info=mysqli_fetch_array($sqls);
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
    <?= $infomainaccessuser['modulename'] ?> Details
  </title>
   <link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
   <!-- customerview.css -->
   <link href="customerview.css" rel="stylesheet">
</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
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
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
                                ?>
       <div id="fullcontainerwidth">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
<div class="row">
<div class="col-lg-6">
 <p class="mb-3" id="viewhead"><i class="fa fa-eye"></i> <?= $infomainaccessuser['modulename'] ?> Details</p>
 </div>
 <div class="col-lg-6">
 <span id="btnalignright" class="mb-3">

<?php
$sqli=mysqli_query($con, "select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and id='".$id."' order by customername asc");
$isactives=mysqli_fetch_array($sqli);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccessedit']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
?>
<form action="customerchange.php" method="get">
<a class="btn btn-primary btn-sm btn-custom-grey" href="customeredit.php?id=<?=$info['id']?>" id="btngopage"><i class="fa fa-pencil-alt"></i> Edit</a>
<input type="hidden" name="id" value="<?=$info['id']?>">
<input type="checkbox" <?=($isactives['is_active']=='0')?'checked':''?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-style="slow"  data-size="small" value="0" name="val" onchange="this.form.submit()">
</form>


  </span>
  </div>
   <?php 
}
?>
  </div>

                                <?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customers' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
    <div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> Generation is Allowed for this Franchise</div>
    <?php
}
else
{
?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


<nav>
   <div style="margin-top: -42px !important;">
                                        <div style="visibility: visible;" id="arrowsalltabs">
<svg id="rightarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 50px !important;z-index: 1 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 50px !important;z-index: 1 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
    <div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="position: relative;top: 9px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;padding-bottom: 0.3px !important;">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">Overview</a>  
             
                </div></button>
				 <button class="nav-link" id="nav-transactions-tab" data-bs-toggle="tab" data-bs-target="#nav-transactions" type="button" role="tab" aria-controls="nav-transactions" aria-selected="false"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">Transactions</a>  
             
                </div></button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
        <div class="customcont-header ml-0">
    
        <a class="customcont-heading">History</a>   
             
                </div>
        
        </button>
        
  </div>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="table-responsive m-3">
      <table class="table table-bordered" style="width: 100%;table-layout: fixed;">
      <thead>
      <tr>
      <th style="border:1px solid #ddd !important;width: 19%;">DATE</th>
      <th style="border:1px solid #ddd !important;width: 81%;">DETAILS</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='CUSTOMERS' and useid='$id' order by createdon desc");
      while($infouse=mysqli_fetch_array($sqluse))
      {
      ?>
        <tr>
          <td data-label="DATE" id="datehis"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
          <td data-label="DETAILS"><?=$infouse['useremarks']?> <br><span><?=((str_contains($infouse['useremarks'],'CUSTOMER CREATED'))?'Created By':'Changed By')?></span> <span id="chhis"><?=$info['createdby']?></span></td>
        </tr>
      <?php
      }
      ?>
      
      </tbody>
      </table>
      </div>
      </div>
	  
	   <div class="tab-pane fade" id="nav-transactions" role="tabpanel" aria-labelledby="nav-transactions-tab">
		    
	<div class="table-responsive mt-3 p-0 min-height-480">
                                <table id="someTable" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                        <tr>
    <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Date</span></td>
	<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Number</span></td>
    <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Type</span></td>
    <!-- <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Quantity</span></td> -->
	<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Amount</span></td>
<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;">Status</span></td>
                                     </tr>
                                    </thead>
                                    <tbody id="transactionans">
<?php

$sqlismainaccessuserinv=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Invoices' order by id  asc");
$infomainaccessuserinv=mysqli_fetch_array($sqlismainaccessuserinv);

$sqlismainaccessusercn=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Credit Notes' order by id  asc");
$infomainaccessusercn=mysqli_fetch_array($sqlismainaccessusercn);

$sqlismainaccessusersalepay=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Payments Received' order by id  asc");
$infomainaccessusersalepay=mysqli_fetch_array($sqlismainaccessusersalepay);

$sqlismainaccessusercr=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessusercr=mysqli_fetch_array($sqlismainaccessusercr);

$sql = "SELECT 'invoice' as source,'invoice' as type, id as id, invoiceno as numbersview, invoiceno as numbers, invoiceno as numberspublic, invoicedate as dates, createdon as date_column,invoiceamount as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairinvoices WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND customerid='$id' GROUP BY invoicedate, invoiceno UNION SELECT 'creditnote' as source,'creditnote' as type, id as id, creditnoteno as numbersview, creditnoteno as numbers, creditnoteno as numberspublic, creditnotedate as dates, createdon as date_column,creditnoteamount as amount,paidstatus as status,cancelstatus as cancelstatus FROM paircreditnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND customerid='$id' GROUP BY creditnotedate, creditnoteno UNION SELECT 'salespayment' as source,module as type, id as id, receiptno as numbersview, privateid as numbers, publicid as numberspublic, receiptdate as dates, createdon as date_column,amount as amount,'None' as status,cancelstatus as cancelstatus FROM pairsalespayments WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND customerid='$id' GROUP BY receiptdate, receiptno UNION SELECT 'customerrefund' as source,'creditnote' as type, id as id, receiptno as numbersview, privateid as numbers, publicid as numberspublic, receiptdate as dates, createdon as date_column,amount as amount,'None' as status,cancelstatus as cancelstatus FROM paircreditnotepayments WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND customerid='$id' GROUP BY receiptdate, receiptno order by dates desc, numbers desc limit 20";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
$statusanswer = "None";
if($row['cancelstatus']=='1'){
  $statusanswer = "Void";
}
elseif($row['status']=='1'){
  $statusanswer = "Paid";
}
elseif($row['status']=='0'){
  $statusanswer = "Pending";
}
elseif($row['status']=='2'){
  $statusanswer = "Partially Paid";
}
$modulesourcename = '';
if ($row['source']=='invoice') {
  $modulesourcename = $infomainaccessuserinv['modulename'];
}
elseif($row['source']=='creditnote'){
  $modulesourcename = $infomainaccessusercn['modulename'];
}
elseif($row['source']=='salespayment'){
  $modulesourcename = $infomainaccessusersalepay['modulename'];
}
elseif($row['source']=='customerrefund'){
  $modulesourcename = $infomainaccessusercr['modulename'];
}
if(($row['source']=='invoice')||($row['source']=='creditnote')){
?>
<tr onclick="window.open('<?=$row['source']?>view.php?id=<?=$row['id']?>&<?=$row['source']?>no=<?=$row['numbers']?>&<?=$row['source']?>date=<?=$row['dates']?>','_self')">
<?php
}
else{
?>
<tr onclick="window.open('<?=$row['source']?>view.php?id=<?=$row['id']?>&receiptno=<?=$row['numbers']?>&receiptdate=<?=$row['dates']?>&publicid=<?= $row['numberspublic'] ?>','_self')">
<?php
}
?>
<td data-label="Date"><?=date('d/m/Y', strtotime($row['dates']))?></td>
<td data-label="No"><?=$row['numbers']?></td>
<td data-label="Type"><?=strtoupper($modulesourcename)?></td>
<!-- <td data-label="Quantity"><?=$row['qty']?></td> -->
<td data-label="Amount"><?php echo $res[0]; ?> <?=number_format((float)$row['amount'],2,'.','')?></td>
<td data-label="Status"><?=$statusanswer?></td>
</tr>
<?php
}
?>

                                    </tbody>
                                </table>
                                <div style="text-align: center !important;display: none;" id="loadimg">
                                    <img src="loading.gif" alt="Loading..." style="margin-top: -60px;" id="loadimgins">
                                </div>


                            </div>
  </div>
	  
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <?php
// if ((in_array('Customer Information', $fieldview))) {
?>
<?php
	// 		  $sqliinvoice=mysqli_query($con, "select invoiceamount, invoicedate, invoiceno from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='".$id."' GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc");
	// $invoiceamount=0;
	$balanceamount=0;
	// $currentamount=0;
	// $overdueamount=0;
	// while($infoinvoice=mysqli_fetch_array($sqliinvoice))
	// {
	// 	$invoiceamount+=(float)$infoinvoice['invoiceamount'];
	// 	$paidamount=0;
	// 	$sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$infoinvoice['invoiceno']."' and invoicedate='".$infoinvoice['invoicedate']."' and customerid='".$id."' order by id desc");
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
   //  $sqlsants=mysqli_query($con,"select invoiceamount, invoicepaymentreceived, grandtotal,creditnotedate, creditnoteno from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$id' and invoiceno='".$infoinvoice['invoiceno']."' and invoicedate='".$infoinvoice['invoicedate']."' GROUP BY creditnotedate, creditnoteno  order by creditnotedate asc, creditnoteno asc");
   //  if(mysqli_num_rows($sqlsants)>0){
   //    while($infoantss=mysqli_fetch_array($sqlsants)){
   //      $balanceamount-=(float)$infoantss['grandtotal'];
   //      $paidamountcr=0;
   //                                        $sqlcrpays=$con->prepare("SELECT amount FROM paircreditnotepayhistory WHERE franchisesession=? AND createdid=? AND creditnoteno=? AND creditnotedate=? ORDER BY id DESC");
   //                                        $sqlcrpays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $infoantss['creditnoteno'], $infoantss['creditnotedate']);
   //                                        $sqlcrpays->execute();
   //                                        $sqlcrpay = $sqlcrpays->get_result();
   //                                        while($infocrpay=$sqlcrpay->fetch_array()){
   //                                           $paidamountcr+=(float)$infocrpay['amount'];
   //                                        }
   //                                        $balanceamount=((float)$balanceamount+$paidamountcr);
   //    }
   //  }
	// }
    // $sqlicreditnotes=$con->prepare("SELECT creditnoteamount, creditnotedate, creditnoteno FROM paircreditnotes WHERE franchisesession=? AND createdid=? AND customerid=? AND paidstatus!='1' GROUP BY creditnotedate, creditnoteno ORDER BY creditnotedate DESC, creditnoteno DESC");
    // $sqlicreditnotes->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $id);
    // $sqlicreditnotes->execute();
    // $sqlicreditnote = $sqlicreditnotes->get_result();
    // while($infocreditnote=$sqlicreditnote->fetch_array()){
    //   $invoiceamount+=(float)$infocreditnote['creditnoteamount'];
    //   $paidamount=0;
    //   $sqlsalespays=$con->prepare("SELECT amount FROM paircreditnotepayhistory WHERE franchisesession=? AND createdid=? AND creditnoteno=? AND creditnotedate=? AND customerid=? ORDER BY id ASC");
    //   $sqlsalespays->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $infocreditnote['creditnoteno'], $infocreditnote['creditnotedate'], $id);
    //   $sqlsalespays->execute();
    //   $sqlsalespay = $sqlsalespays->get_result();
    //   while($infosalespay=$sqlsalespay->fetch_array()){
    //     $paidamount+=(float)$infosalespay['amount'];
    //   }
    //   $balanceamount-=((float)$infocreditnote['creditnoteamount']);
    //   $diff = abs(time() - strtotime($infocreditnote['creditnotedate']));
    //   $days = floor(($diff)/ (60*60*24));
    //   if($days>30){
    //     $overdueamount-=((float)$infocreditnote['creditnoteamount']);
    //   }
    //   else{
    //     $currentamount-=((float)$infocreditnote['creditnoteamount']);
    //   }
    //   $sqlsalespay->close();
    //   $sqlsalespays->close();
    // }
    // $sqlicreditnote->close();
    // $sqlicreditnotes->close();
$advanceamount = 0;
// $selfrompay = mysqli_query($con,"SELECT * FROM pairsalespayments WHERE module='advance' AND customerid='$id' AND createdid='$companymainid' AND franchisesession='".$_SESSION['franchisesession']."'");
// while ($fetfrompay = mysqli_fetch_array($selfrompay)) {
//   $advanceamount+=$fetfrompay['amount'];
// }

// if($balanceamount<0){
//    $advanceamount += (-1*$balanceamount);
//    $balanceamount = 0;
// }
    // $sqlsantss=mysqli_query($con,"select grandtotal from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$id' and refundoption='refundlater' GROUP BY creditnotedate, creditnoteno  order by creditnotedate asc, creditnoteno asc");
    // if(mysqli_num_rows($sqlsantss)>0){
    //   while($infoantsss=mysqli_fetch_array($sqlsantss)){
    //     $advanceamount+=(float)$infoantsss['grandtotal'];
    //   }
    // }
        ?>
        <div class="row">
        <div class="col-lg-6">
<p class="m-3" id="infoheadsall"><?= $infomainaccessuser['modulename'] ?> Details</p>
        </div>
        <div class="col-lg-3 mt-2">
            <span style="border-bottom: 1px dashed grey;margin-left: 1.8rem; font-size:16px;color: green !important;" data-toggle="tooltip" title="Outstanding Credits" data-placement="top">Outstanding Credits</span>
            <br>
            <span style="margin-left: 1.8rem; font-size:16px" id="advanceamount">Loading...</span>
        </div>
        <div class="col-lg-3 mt-2">
            <span style="border-bottom: 1px dashed grey;margin-left: 1.8rem; font-size:16px" data-toggle="tooltip" title="Outstanding Receivables" data-placement="top" class="text-danger">Outstanding Receivables</span>
            <br>
            <span style="margin-left: 1.8rem; font-size:16px" id="balanceamount">Loading...</span>
        </div>
        </div> 
<?php
if ((in_array('Customer Id', $fieldview))) {
?>
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall"><?= $infomainaccessuser['modulename'] ?> Id</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['customercode']?>
        </div>
      </div>
<?php
}
?>
<?php
if ((in_array('Customer Public Id', $fieldview))) {
?>
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall"><?= $infomainaccessuser['modulename'] ?> Public Id</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['publicid']?>
        </div>
      </div>
                                                     <?php
                                                 }
        ?>
                                                    <?php
if ((in_array('Customer Private Id', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall"><?= $infomainaccessuser['modulename'] ?> Private Id</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['privateid']?>
        </div>
      </div>
                                                     <?php
                                                 }
        ?>
<?php
if ((in_array('Primary Contact', $fieldview))) {
?>
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Primary Contact</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['primarysalutation']?> <?=$info['primarycontact']?>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('Company Name', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Company Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['companyname']?>
        </div>
      </div>
      <?php
}
?>
<?php
// if ((in_array('Customer Display Name', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall"><?= $infomainaccessuser['modulename'] ?> Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['customername']?>
        </div>
      </div>
       <?php
// }
?>
<?php
if ((in_array('Age', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
          <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Age</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['age']?>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('Sex', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
          <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Sex</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['sex']?>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('Category', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
          <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Category</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('Sub Category', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
          <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Sub Category</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['subcategory']?>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('Work Phone', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
          <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Work Phone</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['workphone']?>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('Mobile Phone', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
          <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Mobile Phone</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['mobile']?>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('Email', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
          <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Email</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['email']?>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('Website', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
          <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Website</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['website']?>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('Billing Address', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Billing Address</span>
        </div>
        <div class="col-md-8 col-6" style="position: relative;top: 19px !important;margin-top: -19px !important;">
        <?=$info['billstreet']?> <?=$info['billcity']?> <br> <?=$info['billstate']?> <?=$info['billpincode']?> <?=$info['billcountry']?>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('Shipping Address', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Shipping Address</span>
        </div>
        <div class="col-md-8 col-6" style="position: relative;top: 9px !important;">
        <?=$info['shipstreet']?> <?=$info['shipcity']?> <br> <?=$info['shipstate']?> <?=$info['shippincode']?> <?=$info['shipcountry']?>
        </div>
      </div>
      <?php
}
?>
<!---
      <div class="row m-3" id="aligncenterall">
      <div class="col-sm-3 col-md-2 col-6">
          <span
                                                                            style="font-size: 13px;">SKU <svg data-toggle="tooltip" title="The Stock Keeping of the product" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-bottom: 3px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['hsncode']?>
        </div>
      </div>
      
    <div class="row m-3" id="aligncenterall">
      <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">UPC <svg data-toggle="tooltip" title="Twelve digit unique number associated with the bar code (Universal Product Code)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['hsncode']?>
        </div>
      </div>

      <div class="row m-3" id="aligncenterall">
      <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">EAN <svg data-toggle="tooltip" title="Thirteen digit unique number (International Artical Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['hsncode']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">MPN <svg data-toggle="tooltip" title="Manufacturing Part Number unambiguously identifies a part design" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
      
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">ISBN <svg data-toggle="tooltip" title="Thirteen digit unique commercial book identifier (International Standard Book Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
      
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Brand</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
        
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Manufacturer</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
  
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Molicular Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
  
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Generic Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Salt Composition</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Consume Time</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Category</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Sub Category</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['subcategory']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Dimensions</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Weight</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Rack</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Description</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['description']?>
        </div>
      </div>-->
      <hr style="margin-top: 18px !important;">
     <?php
  // }
// }
  ?>
  <?php
// }
?>
<?php
if ((in_array('Customers Visibility', $fieldview))) {
?>
                                                      <?php
                                                         $sqlvis=mysqli_query($con,"select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and id='$id'");
                                                        $ansvis=mysqli_fetch_array($sqlvis);
                                                    ?>
    <p class="m-3" id="infoheadsall"><?= $infomainaccessuser['modulename'] ?> Visibility</p>   
    
<div class="row m-3" id="aligncenterall">
<div class="col-lg-6">
<div class="form-group row">
        <div class="col-sm-4">
          <span id="insideheadall">Visibility</span>
        </div>
        <div class="col-sm-8">
          <div class="row">
                      <div class="col-sm-6 " style="z-index:0;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="visibility" id="visibility" value="0" <?= $ansvis['cvisiblity']=='PUBLIC'?'checked':'' ?> disabled>
                        <label class="custom-control-label custom-label" for="visibility">Public</label>
                      </div>
                      
                      </div>
                      <div class="col-sm-6 " style="z-index:0;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="visibility" id="novisibility" value="1" <?= $ansvis['cvisiblity']=='PRIVATE'?'checked':'' ?> disabled>
                        <label class="custom-control-label custom-label" for="novisibility">Private</label>
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
<!--
                                    <?php
                                                     if($permissionproimage!='0'){
                                                    ?>
                                                    <?php
                                                     if($permissionproimgview!='0'){
                                                    ?>
<p class="m-3" id="infoheadsall">Product Image</p>     
      
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Description</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['description']?>
        </div>
      </div>

      <hr>
      <?php
                                    }
                                  }
                                    ?>
                                    <?php
                                                     if($permissionpropurchase!='0'){
                                                    ?>
                                                    <?php
                                                     if($permissionpropurview!='0'){
                                                    ?>
<p class="m-3" id="infoheadsall">Purchase Information</p>      
      
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Account</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['purchaseaccounttype']?>
        </div>
      </div>


      <hr>
        <?php
                                    }
                                  }
                                    ?>
                                    <?php
                                                     if($permissionprosales!='0'){
                                                    ?>
                                                    <?php
                                                     if($permissionprosaleview!='0'){
                                                    ?>
<p class="m-3" id="infoheadsall">Sales Information</p>     
      
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Account</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['saleaccounttype']?>
        </div>
      </div>

      <hr>
      <?php
                                    }
                                  }
                                    ?>
                                -->
<?php
if ((in_array('Tax Information', $fieldview))) {
?>
                                                    <?php
                                                    $forgstrtypes=mysqli_query($con,"select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and id='$id'");
                                                    $final=mysqli_fetch_array($forgstrtypes);
                                                    ?>
<p class="m-3" id="infoheadsall">Tax Information</p>
<?php
if ((in_array('Tax Preference', $fieldview))) {
?>
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Tax Preference</span>
        </div>
        <div class="col-md-8 col-6">
          <div class="row">
                      <div class="col-lg-4 " style="z-index:0;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="taxprefer" id="taxprefer" value="0" <?= $final['custaxprefer']=='0'?'checked':'' ?> disabled>
                        <label class="custom-control-label custom-label" for="taxprefer">Taxable</label>
                      </div>
                      
                      </div>
                      <!-- <div class="col-lg-4 " style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="taxprefer" id="notaxprefer" value="1" <?= $ansvis['custaxprefer']=='1'?'checked':'' ?> disabled>
                        <label class="custom-control-label custom-label" for="notaxprefer">Non Taxable</label>
                      </div>
                      
                      </div> -->
                  </div>
        </div>
      </div>
      <?php
}
?>
<?php
if ((in_array('GST Registration Type', $fieldview))) {
?>
<div id="gstrtypesh">
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">GST Registration Type</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['gstrtype']?>
        </div>
      </div>
      <?php
      if ($final['gstrtype']!='') {
         if(($final['gstrtype']=='Registered Business - Regular'||$final['gstrtype']=='Registered Business - Composition'||$final['gstrtype']=='Special Economic Zone'||$final['gstrtype']=='Deemed Export'||$final['gstrtype']=='Tax Deductor'||$final['gstrtype']=='SEZ Developer')&&($final['gstrtype']!='Unregistered Business'||$final['gstrtype']!='Consumer'||$final['gstrtype']!='Overseas'))
         {
        ?>
                                        
<?php
if ((in_array('GSTIN or UIN', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">GSTIN / UIN</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['gstin']?>
        </div>
      </div>
                                                                    <?php
}
?>
<?php
if ((in_array('Business Legal Name', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Business Legal Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['buslegname']?>
        </div>
      </div>
                                                                    <?php
}
?>
<?php
if ((in_array('Business Trade Name', $fieldview))) {
?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Business Trade Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['bustrdname']?>
        </div>
      </div>
                                                                <?php
}
?>
  </div>
                                                                    <?php
                                        }
                                    }
                                        ?>
                                        <?php
}
?>
<?php
if ((in_array('Pan', $fieldview))) {
?>

      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">PAN</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['pan']?>
        </div>
      </div>
                                                                    <?php
}
?>
<?php
if ((in_array('Place Of Supply', $fieldview))) {
?>
        <?php
         if($final['gstrtype']!='Overseas')
         {
        ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Place Of Supply</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['placeos']?>
        </div>
      </div>
      <?php
                                        }
                                        ?>
                                                                    <?php
}
?>
<!---
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Tax Preference</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['excemptionreason']?>
        </div>
      </div>

      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Currency</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['excemptionreason']?>
        </div>
      </div>-->

      <hr>
      <?php
}
?>
<?php
if ((in_array('Other Information', $fieldview))) {
?>
<p class="m-3" id="infoheadsall">Other Information</p>
<?php
if ((in_array('DL dot No dot or 20', $fieldview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-2 col-6">
<span id="insideheadall">DL.NO./20</span>
</div>
<div class="col-md-8 col-6">
<?=$info['dlno20']?>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('DL dot No dot or 21', $fieldview))) {
?>
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-2 col-6">
<span id="insideheadall">DL.NO./21</span>
</div>
<div class="col-md-8 col-6">
<?=$info['dlno21']?>
</div>
</div>
<?php
}
?>
<hr style="margin-top: 18px !important;">
<?php
}
?>
                                    <!--
                                    <?php
                                                     if($permissionproinventory!='0'){
                                                    ?>
                                                     <?php
                                                     if($permissionproinvview!='0'){
                                                    ?>
<p class="m-3" id="infoheadsall">Inventory Information</p>     
      
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Track Inventory for this Item</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Inventory Account Type</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['inventoryaccounttype']?>
        </div>
      </div>

      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Opening Stock</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['openingstock']?>
        </div>
      </div>

      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Opening Stock Rate per Unit</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['openingstockrate']?>
        </div>
      </div>
      <hr>
<?php
                                    }
                                  }
                                    ?>
                                    <?php
                                                     if($permissionprostock!='0'){
                                                    ?>
                                                     <?php
                                                     if($permissionprostkview!='0'){
                                                    ?>
<p class="m-3" id="infoheadsall">Stock Information</p>   
    
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Reorder Point <svg data-toggle="tooltip" title="Thirteen digit unique number (International Artical Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>
      <hr>
<?php
                                    }
                                  }
                                    ?>
                                    <?php
                                                     if($permissionproother!='0'){
                                                    ?>
                                                    <?php
                                                     if($permissionproothview!='0'){
                                                    ?>
      <p class="m-3" id="infoheadsall">Other Information</p>   
    
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">P.T.R <svg data-toggle="tooltip" title="P.T.R" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">P.T.S <svg data-toggle="tooltip" title="P.T.S" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Member Discount <svg data-toggle="tooltip" title="Member Discount" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">DCC Discount <svg data-toggle="tooltip" title="DCC Discount" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>-->
      
      
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
?>
</form>

             
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
function makeAjaxRequest() {
   ajaxRequest = $.ajax({
      type: "GET",
      url: 'balancesearching.php',
      data: { term: "customer", id: "<?= $id ?>" },
      success: function (result) {
         $("#balanceamount").html(`<?php echo $res[0]; ?>${result.balanceamount}`);
         $("#advanceamount").html(`<?php echo $res[0]; ?>${result.advanceamount}`);
      },
      error: function (xhr, status, error) {
         console.log('error '+error);
      }
   });
}
makeAjaxRequest();
$(window).on('beforeunload', function(){
   if (typeof ajaxRequest !== 'undefined' && ajaxRequest) {
      ajaxRequest.abort();
   }
});
var sIndex = 20, offSet = 20, isPreviousEventComplete = true, isDataAvailable = true;
$('.main-content').on('scroll', function() {
var scrollTop = $(this).scrollTop();
if (scrollTop + $(this).innerHeight() >= this.scrollHeight-50) {
if (isPreviousEventComplete && isDataAvailable) {
isPreviousEventComplete = false;
$("#loadimg").css("display","block");
console.log('ss');
// ajax for get
$.ajax({
type: "GET",
url: 'transactionfetch.php?term=' + sIndex + '&types=customer&id=<?=$_GET['id']?>',
success: function (result) {
$("#transactionans").append(result);
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
 <script src="assets/js/bootstrap-toggle.min.js"></script>
 <!-- alert -->
<!-- taxprefer -->
                      <script type="text/javascript">
$(document).ready(function() {
  let noaccess = document.getElementById('notaxprefer');
  let access = document.getElementById('taxprefer');
  if (noaccess.checked == true) {
    document.getElementById('gstrtypesh').style.display='none';
  }
  if (access.checked == true) {
    document.getElementById('gstrtypesh').style.display='block';
  }
});
            </script>
            <!-- table -->
<script type="text/javascript">
  $(function() {
      $( "#area" ).autocomplete({
       source: 'areasearch.php', select: function (event, ui) { $("#area").val(ui.item.area); $("#city").val(ui.item.city); $("#district").val(ui.item.district); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pincode);}, minLength: 2
     });
     $( "#email" ).autocomplete({
       source: 'franchisesearch.php?type=email',
     });
  });
</script>
 
</body>

</html>
<?php
}
else
{
    header("Location: customers.php?error=No Information Found");
}
}
else
{
    header("Location: customers.php?error=No Information Found");
}
?>