<?php
include('lcheck.php');
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
if($permissionfranchise=='0'||$permissionfranchise=='1')
{
	header('Location: dashboard.php');
}
if(isset($_POST['submit']))
{
$franchisename=mysqli_real_escape_string($con, $_POST['franchisename']);
$upiid=mysqli_real_escape_string($con, $_POST['upiid']);
$displayname=mysqli_real_escape_string($con, $_POST['displayname']);
$street=mysqli_real_escape_string($con, $_POST['street']);
$city=mysqli_real_escape_string($con, $_POST['city']);
$pincode=mysqli_real_escape_string($con, $_POST['pincode']);
$state=mysqli_real_escape_string($con, $_POST['state']);
$country=mysqli_real_escape_string($con, $_POST['country']);
$mobile=mysqli_real_escape_string($con, $_POST['mobile']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$website=mysqli_real_escape_string($con, $_POST['website']);
$gstno=mysqli_real_escape_string($con, $_POST['gstno']);
$pos=mysqli_real_escape_string($con, $_POST['pos']);

$bank=mysqli_real_escape_string($con, $_POST['bank']);
$names=mysqli_real_escape_string($con, $_POST['names']);
$accountnumber=mysqli_real_escape_string($con, $_POST['accountnumber']);
$ifsccode=mysqli_real_escape_string($con, $_POST['ifsccode']);
$branchandcity=mysqli_real_escape_string($con, $_POST['branchandcity']);
$dlno20=mysqli_real_escape_string($con, $_POST['dlno20']);
$dlno21=mysqli_real_escape_string($con, $_POST['dlno21']);

$branchimages=array();
// Configure upload directory and allowed file types
$upload_dir = 'ups/profile/';
$allowed_types = array('jpg', 'png', 'jpeg', 'gif');    
// Define maxsize for files i.e 2MB
$maxsize = 2 * 1024 * 1024;
// Checks if user sent an empty form
if(!empty(array_filter($_FILES['branchimage']['name']))) {
foreach ($_FILES['branchimage']['tmp_name'] as $key => $value) {            
$file_tmpname = $_FILES['branchimage']['tmp_name'][$key];
$file_name = $_FILES['branchimage']['name'][$key];
$file_size = $_FILES['branchimage']['size'][$key];
$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$filepath = $upload_dir.$file_name;
if(in_array(strtolower($file_ext), $allowed_types)) {
if ($file_size > $maxsize)        
header("Location: franchiseadd.php?error=File size is larger than the allowed limit");
if(file_exists($filepath)) {
$filepath = $upload_dir.time().$file_name; 
if( move_uploaded_file($file_tmpname, $filepath)) {
$branchimages[]=$filepath;
// echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}
else {
if( move_uploaded_file($file_tmpname, $filepath)) {
$branchimages[]=$filepath;
//echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}          
}
else {      
// If file extension not valid
// echo "Error uploading {$file_name} ";
//  echo "({$file_ext} file type is not allowed)<br / >";
}
}
}
else {
 
}
if(!empty($branchimages))
{
$branchimage=implode(",",$branchimages);
}
else
{
$branchimage=mysqli_real_escape_string($con, $_POST['branchimages']);
}

$signimages=array();
// Configure upload directory and allowed file types
$upload_dir = 'ups/profile/';
$allowed_types = array('jpg', 'png', 'jpeg', 'gif');    
// Define maxsize for files i.e 2MB
$maxsize = 2 * 1024 * 1024;
// Checks if user sent an empty form
if(!empty(array_filter($_FILES['signimage']['name']))) {
foreach ($_FILES['signimage']['tmp_name'] as $key => $value) {            
$file_tmpname = $_FILES['signimage']['tmp_name'][$key];
$file_name = $_FILES['signimage']['name'][$key];
$file_size = $_FILES['signimage']['size'][$key];
$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$filepath = $upload_dir.$file_name;
if(in_array(strtolower($file_ext), $allowed_types)) {
if ($file_size > $maxsize)        
header("Location: franchiseadd.php?error=File size is larger than the allowed limit");
if(file_exists($filepath)) {
$filepath = $upload_dir.time().$file_name; 
if( move_uploaded_file($file_tmpname, $filepath)) {
$signimages[]=$filepath;
// echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}
else {
if( move_uploaded_file($file_tmpname, $filepath)) {
$signimages[]=$filepath;
//echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}          
}
else {      
// If file extension not valid
// echo "Error uploading {$file_name} ";
//  echo "({$file_ext} file type is not allowed)<br / >";
}
}
}
else {
 
}
if(!empty($signimages))
{
$signimage=implode(",",$signimages);
}
else
{
$signimage=mysqli_real_escape_string($con, $_POST['signimages']);
}


$scanqrs=array();
// Configure upload directory and allowed file types
$upload_dir = 'ups/profile/';
$allowed_types = array('jpg', 'png', 'jpeg', 'gif');    
// Define maxsize for files i.e 2MB
$maxsize = 2 * 1024 * 1024;
// Checks if user sent an empty form
if(!empty(array_filter($_FILES['scanqrimage']['name']))) {
foreach ($_FILES['scanqrimage']['tmp_name'] as $key => $value) {            
$file_tmpname = $_FILES['scanqrimage']['tmp_name'][$key];
$file_name = $_FILES['scanqrimage']['name'][$key];
$file_size = $_FILES['scanqrimage']['size'][$key];
$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$filepath = $upload_dir.$file_name;
if(in_array(strtolower($file_ext), $allowed_types)) {
if ($file_size > $maxsize)        
header("Location: franchiseadd.php?error=File size is larger than the allowed limit");
if(file_exists($filepath)) {
$filepath = $upload_dir.time().$file_name; 
if( move_uploaded_file($file_tmpname, $filepath)) {
$scanqrs[]=$filepath;
// echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}
else {
if( move_uploaded_file($file_tmpname, $filepath)) {
$scanqrs[]=$filepath;
//echo "{$file_name} successfully uploaded <br />";
}
else {                    
//echo "Error uploading {$file_name} <br />";
}
}          
}
else {      
// If file extension not valid
// echo "Error uploading {$file_name} ";
//  echo "({$file_ext} file type is not allowed)<br / >";
}
}
}
else {
 
}
if(!empty($scanqrs))
{
$qrcode=implode(",",$scanqrs);
}
else
{
$qrcode=mysqli_real_escape_string($con, $_POST['scanqrs']);
}

// $salesorder=mysqli_real_escape_string($con, $_POST['salesorder']);
// $salesorderprefix=mysqli_real_escape_string($con, $_POST['salesorderprefix']);
// $salesordersuffix=mysqli_real_escape_string($con, $_POST['salesordersuffix']);

// $quotation=mysqli_real_escape_string($con, $_POST['quotation']);
// $quotationprefix=mysqli_real_escape_string($con, $_POST['quotationprefix']);
// $quotationsuffix=mysqli_real_escape_string($con, $_POST['quotationsuffix']);

// $estimate=mysqli_real_escape_string($con, $_POST['estimate']);
// $estimateprefix=mysqli_real_escape_string($con, $_POST['estimateprefix']);
// $estimatesuffix=mysqli_real_escape_string($con, $_POST['estimatesuffix']);

// $proforma=mysqli_real_escape_string($con, $_POST['proforma']);
// $proformaprefix=mysqli_real_escape_string($con, $_POST['proformaprefix']);
// $proformasuffix=mysqli_real_escape_string($con, $_POST['proformasuffix']);

// $invoice=mysqli_real_escape_string($con, $_POST['invoice']);
// $invoiceprefix=mysqli_real_escape_string($con, $_POST['invoiceprefix']);
// $invoicesuffix=mysqli_real_escape_string($con, $_POST['invoicesuffix']);

// $salesreturn=mysqli_real_escape_string($con, $_POST['salesreturn']);
// $salesreturnprefix=mysqli_real_escape_string($con, $_POST['salesreturnprefix']);
// $salesreturnsuffix=mysqli_real_escape_string($con, $_POST['salesreturnsuffix']);

// $purchaseorder=mysqli_real_escape_string($con, $_POST['purchaseorder']);
// $purchaseorderprefix=mysqli_real_escape_string($con, $_POST['purchaseorderprefix']);
// $purchaseordersuffix=mysqli_real_escape_string($con, $_POST['purchaseordersuffix']);

// $bill=mysqli_real_escape_string($con, $_POST['bill']);
// $billprefix=mysqli_real_escape_string($con, $_POST['billprefix']);
// $billsuffix=mysqli_real_escape_string($con, $_POST['billsuffix']);

// $purchasereturn=mysqli_real_escape_string($con, $_POST['purchasereturn']);
// $purchasereturnprefix=mysqli_real_escape_string($con, $_POST['purchasereturnprefix']);
// $purchasereturnsuffix=mysqli_real_escape_string($con, $_POST['purchasereturnsuffix']);

// $job=mysqli_real_escape_string($con, $_POST['job']);
// $jobprefix=mysqli_real_escape_string($con, $_POST['jobprefix']);
// $jobsuffix=mysqli_real_escape_string($con, $_POST['jobsuffix']);


// $ledger=mysqli_real_escape_string($con, $_POST['ledger']);
// $ledgerprefix=mysqli_real_escape_string($con, $_POST['ledgerprefix']);
// $ledgersuffix=mysqli_real_escape_string($con, $_POST['ledgersuffix']);

// $project=mysqli_real_escape_string($con, $_POST['project']);
// $projectprefix=mysqli_real_escape_string($con, $_POST['projectprefix']);
// $projectsuffix=mysqli_real_escape_string($con, $_POST['projectsuffix']);


// $deliverychallan=mysqli_real_escape_string($con, $_POST['deliverychallan']);
// $deliverychallanprefix=mysqli_real_escape_string($con, $_POST['deliverychallanprefix']);
// $deliverychallansuffix=mysqli_real_escape_string($con, $_POST['deliverychallansuffix']);

// $enquiry=mysqli_real_escape_string($con, $_POST['enquiry']);
// $enquiryprefix=mysqli_real_escape_string($con, $_POST['enquiryprefix']);
// $enquirysuffix=mysqli_real_escape_string($con, $_POST['enquirysuffix']);

// $purchasereceive=mysqli_real_escape_string($con, $_POST['purchasereceive']);
// $purchasereceiveprefix=mysqli_real_escape_string($con, $_POST['purchasereceiveprefix']);
// $purchasereceivesuffix=mysqli_real_escape_string($con, $_POST['purchasereceivesuffix']);
//, salesorder='$salesorder', salesorderprefix='$salesorderprefix', salesordersuffix='$salesordersuffix', quotation='$quotation', quotationprefix='$quotationprefix', quotationsuffix='$quotationsuffix', estimate='$estimate', estimateprefix='$estimateprefix', estimatesuffix='$estimatesuffix', proforma='$proforma', proformaprefix='$proformaprefix', proformasuffix='$proformasuffix', invoice='$invoice', invoiceprefix='$invoiceprefix', invoicesuffix='$invoicesuffix', salesreturn='$salesreturn', salesreturnprefix='$salesreturnprefix', salesreturnsuffix='$salesreturnsuffix', purchaseorder='$purchaseorder', purchaseorderprefix='$purchaseorderprefix', purchaseordersuffix='$purchaseordersuffix', bill='$bill', billprefix='$billprefix', billsuffix='$billsuffix', purchasereturn='$purchasereturn', purchasereturnprefix='$purchasereturnprefix', purchasereturnsuffix='$purchasereturnsuffix',  job='$job', jobprefix='$jobprefix', jobsuffix='$jobsuffix', ledger='$ledger', ledgerprefix='$ledgerprefix', ledgersuffix='$ledgersuffix', project='$project', projectprefix='$projectprefix', projectsuffix='$projectsuffix',  deliverychallan='$deliverychallan', deliverychallanprefix='$deliverychallanprefix', deliverychallansuffix='$deliverychallansuffix',  enquiry='$enquiry', enquiryprefix='$enquiryprefix', enquirysuffix='$enquirysuffix', purchasereceive='$purchasereceive', purchasereceiveprefix='$purchasereceiveprefix', purchasereceivesuffix='$purchasereceivesuffix'

$msg = "";
$msg_class = "";
	if(($franchisename!=""))
	{		
        $sqlcon = "SELECT id From pairfranchises WHERE franchisename = '{$franchisename}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon == 0) 
		{	


			$sqlup = "insert into pairfranchises set upiid='$upiid',createdon='$times',createdid='$companymainid',  createdby='".$_SESSION["unqwerty"]."', email='$email', mobile='$mobile', franchisename='$franchisename',displayname='$displayname', website='$website', gstno='$gstno', pos='$pos', street='$street', country='$country', city='$city',  state='$state', pincode='$pincode',branchimage='$branchimage',signimage='$signimage',bank='$bank',names='$names',accountnumber='$accountnumber',ifsccode='$ifsccode',branchandcity='$branchandcity',dlno20='$dlno20',dlno21='$dlno21',qrcode='$qrcode'";
			$queryup = mysqli_query($con, $sqlup);
            $franchiseid=mysqli_insert_id($con);
                $sqlisaccessreport=mysqli_query($con, "select * from pairreportmodules order by id  asc");
while($infosaccessreport=mysqli_fetch_array($sqlisaccessreport))
{
$types=$infosaccessreport['types'];
$typefields=$infosaccessreport['typefields'];
                $sqlreport = mysqli_query($con,"insert into pairreports set franchiseid='$franchiseid',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',username='".$_SESSION["unqwerty"]."',types='$types',rowcolumns='$typefields',rowcolumnsorder='$typefields'");
}
$sqlfavsreport=mysqli_query($con, "select * from pairreportfavmodules order by id  asc");
while($infofavreport=mysqli_fetch_array($sqlfavsreport))
{
$sqlfavreport = "insert into pairreportfavourites set createdid='$companymainid',reportnames='".$infofavreport['reportnames']."',reporturlname='".$infofavreport['reporturlname']."',reportoriginals='".$infofavreport['reportoriginals']."',reportfunctions='".$infofavreport['reportfunctions']."',reporturl='".$infofavreport['reporturl']."',reporthref='".$infofavreport['reporthref']."',franchisesession='$franchiseid'"; 
$sqlfavupreport = mysqli_query($con, $sqlfavreport);
}
			 
$sqlisaccess=mysqli_query($con, "select * from pairmodules where moduletype!='' order by id  asc");
            while($infosaccess=mysqli_fetch_array($sqlisaccess))
            {
                $coltype = preg_replace('/\s+/', '', $infosaccess['moduletype']);
                $grouptypeans=$infosaccess['grouptype'];
                $groupaccesscol="group".strtolower($coltype);
                $groupaccess=mysqli_real_escape_string($con, $_POST[$groupaccesscol]);
                $grouptypecol="grouptype".strtolower($coltype);
                $grouptype=mysqli_real_escape_string($con, $_POST[$grouptypecol]);
                $moduletypeans=$infosaccess['moduletype'];
                $moduleaccesscol="module".strtolower($coltype);
                $moduleaccess=mysqli_real_escape_string($con, $_POST[$moduleaccesscol]);
                $moduletypecol="moduletype".strtolower($coltype);
                $moduletype=mysqli_real_escape_string($con, $_POST[$moduletypecol]);
                $modulenocol="moduleno".strtolower($coltype);
                $moduleno=mysqli_real_escape_string($con, $_POST[$modulenocol]);
                $moduleprefixcol="moduleprefix".strtolower($coltype);
                $modulesuffixcol="modulesuffix".strtolower($coltype);
                // $prefixsuffixcol="prefixsuffix".strtolower($coltype);
                // $prefixsuffix=mysqli_real_escape_string($con, $_POST[$prefixsuffixcol]);,explode='$prefixsuffix'
                $moduleprefix=mysqli_real_escape_string($con, $_POST[$moduleprefixcol]);
                $modulesuffix=mysqli_real_escape_string($con, $_POST[$modulesuffixcol]);
                $orderingdef = $infosaccess['ordering'];
                $sqlmainaccess = "insert into pairmainaccess set createdon='$times',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',moduletype='$moduletypeans',modulename='$moduletype',moduleaccess='$moduleaccess',grouptype='$grouptypeans',groupname='$grouptype',groupaccess='$groupaccess',moduleno='$moduleno',moduleprefix='$moduleprefix',modulesuffix='$modulesuffix',franchiseid='$franchiseid',ordering='$orderingdef'"; 
                $sqlmainaccessup = mysqli_query($con, $sqlmainaccess);
            }
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				// $pfs=mysqli_query($con,"SELECT * FROM pairfranchises WHERE createdby='".$_SESSION["unqwerty"]."'");
				// while($res=mysqli_fetch_assoc($pfs)){
    //                  $ans=$res['id'];
				// $pf=mysqli_query($con,"UPDATE paircontrols SET franchises='concat(',' ,$ans )' WHERE createdid='$companymainid' OR id='$companymainid'");
				// }
				if ($userrole=='SUPER ADMIN') {
				$oldfranch=mysqli_query($con,"SELECT * From paircontrols WHERE id='$companymainid'");
				$oldfetch=mysqli_fetch_array($oldfranch);
				$fetch=$oldfetch['franchises'];
				if($fetch!='')
				{
					$sqluse=mysqli_query($con, "update paircontrols set franchises=concat(franchises, ',' , $franchiseid) where id='$companymainid'");
				}
				else{
					$sqluse=mysqli_query($con, "update paircontrols set franchises='$franchiseid' where id='$companymainid'");
				}
			}
				
                 if ($userrole=='USER') {
                $oldfranch=mysqli_query($con,"SELECT * From paircontrols WHERE id='$companymainid'");
				$oldfetch=mysqli_fetch_array($oldfranch);
				$fetch=$oldfetch['franchises']; 	
				$oldfranchh=mysqli_query($con,"SELECT * From paircontrols WHERE username = '".$_SESSION['unqwerty']."'");
				$oldfetchh=mysqli_fetch_array($oldfranchh);
				$fetchh=$oldfetchh['franchises'];
				if($fetchh!='')
				{
					$sqluse=mysqli_query($con, "update paircontrols set franchises=concat(franchises, ',' , $franchiseid) where username='".$_SESSION['unqwerty']."'");
				}
				else{
					$sqluse=mysqli_query($con, "update paircontrols set franchises='$franchiseid' where username='".$_SESSION['unqwerty']."'");
				}
				if($fetch!='')
				{
					$sqluse=mysqli_query($con, "update paircontrols set franchises=concat(franchises, ',' , $franchiseid) where id='$companymainid'");
				}
				else{
					$sqluse=mysqli_query($con, "update paircontrols set franchises='$franchiseid' where id='$companymainid'");
				}
			}

				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='FRANCHISE', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$franchiseid', useremarks='FRANCHISE CREATED' ");
				$_SESSION['franchisesession']=$franchiseid;
				header("Location: franchises.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: franchises.php?error=This record is Already Found! Kindly check in All ".$row['franchiseandroles']." and Roles List");
			}
	}
	else
			{
				header("Location: franchises.php?error=Error Data");
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
  <title>
    New <?= $row['franchiseandroles'] ?>
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
       <div style="max-width: 1650px;">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;z-index: 0;">

 <p class="mb-3" style="font-size:20px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-file-import"></i> New <?= $row['franchiseandroles'] ?></p>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


<div class="accordion" id="accordionRental">
          <div class="accordion-item mb-1" <?=((($access['branchinfohead']=='0')&&($access['branchinfoadd']=='0'))?'style="display:none;"':'')?>>
            <h5 class="accordion-header" id="headingOne">
              <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading" style="font-size: 18px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Details</a>	
             
				</div> 
                
              </button>
            </h5>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"  style="">
              <div class="accordion-body text-sm">
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="branch-image1" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Print Logo</label>
            </div>
            <div class="col-sm-8">
              <img alt="Branch Pic" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="branch-image1" style="height: 30px !important;width: 30px !important;">
<input id="branch-image-upload" type="file" style="display:none" class="form-control  form-control-sm" id="branchimage" name="branchimage[]" accept="image/*" onchange="previewLogo()" >
<input type="hidden" name="branchimages" value="">
<span style="color:#4285F4; cursor:pointer"  id="branch-image2"> Upload Photo </span>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="sign-image1" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Authorized Signature</label>
            </div>
            <div class="col-sm-8">
              <img alt="Sign Pic" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="sign-image1" style="height: 30px !important;width: 30px !important;">
<input id="sign-image-upload" type="file" style="display:none" class="form-control  form-control-sm" id="signimage" name="signimage[]" accept="image/*" onchange="previewSign()" >
<input type="hidden" name="signimages" value="">
<span style="color:#4285F4; cursor:pointer"  id="sign-image2"> Upload Photo </span>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="scanqr-image1" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Scanner QR Code</label>
            </div>
            <div class="col-sm-4">
              <img alt="Scanner QR Code" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="scanqr-image1" style="height: 30px !important;width: 30px !important;">
<input id="scanqr-image-upload" type="file" style="display:none" class="form-control  form-control-sm" id="scanqrimage" name="scanqrimage[]" accept="image/*" onchange="previewscanqr()" >
<input type="hidden" name="scanqrimages" value="">
<span style="color:#4285F4; cursor:pointer"  id="scanqr-image2"> Upload Photo </span>
            </div>
            <div class="col-sm-4">
                <div class="custom-control custom-checkbox" onclick="upiidaccess()">
                    <input type="checkbox" class="custom-control-input" name="upiidaccess" id="upiidaccess">
                    <label class="custom-control-label custom-label" for="upiidaccess" style="width:max-content !important;color: black;">
                        Enable Upi Id For Qr Code
                    </label>
                </div>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center" style="display: none;" id="upicontainer">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
            <label for="upiid" class="custom-label"><span class="text-danger">Upi Id *</span></label>
            </div>
            <div class="col-sm-8" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
              <input type="text" class="form-control  form-control-sm" id="upiid" name="upiid" placeholder="Upi Id">
            </div>
          </div>
    </div>
</div>
                <div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="displayname" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Display Name *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="displayname" name="displayname" placeholder="Display Name"  <?=((($access['branchinfohead']=='0')&&($access['branchinfoadd']=='0'))?'':'required')?> oninput="dname(this)">
            </div>
          </div>
    </div>
</div>
	<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="franchisename" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger"><?= $row['franchiseandroles'] ?> Name *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="franchisename" name="franchisename" placeholder="<?= $row['franchiseandroles'] ?> Name"  <?=((($access['branchinfohead']=='0')&&($access['branchinfoadd']=='0'))?'':'required')?>>
            </div>
          </div>
    </div>
</div>
	<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="franchisename" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Address</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="street" name="street" placeholder="Street">
			  
            </div>
			</div>
		 <div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
			<div class="form-group">
              <input type="text" class="form-control  form-control-sm" id="city" name="city" placeholder="City">
			  </div>
            </div>
			<div class="col-sm-4">
			<div class="form-group">
			<input type="text" class="form-control  form-control-sm" id="pincode" name="pincode" placeholder="Pin Code">
			</div>
            </div>
          </div>
		  <div class="row">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
			<div class="form-group">
              <input type="text" class="form-control  form-control-sm" id="state" name="state" placeholder="State">
			  </div>
            </div>
			<div class="col-sm-4">
			<div class="form-group">
              <input type="text" class="form-control  form-control-sm" id="country" name="country" placeholder="Country">
			  </div>
            </div>
          </div>
		  <div class="form-group row">
            <div class="col-sm-4">
            <label for="mobile" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Phone</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="mobile" name="mobile" placeholder="<?= $row['franchiseandroles'] ?> Phone">			  
            </div>
			</div>
			 <div class="form-group row">
            <div class="col-sm-4">
            <label for="email" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> E-mail</label>
            </div>
            <div class="col-sm-8">
              <input type="email" class="form-control  form-control-sm" id="email" name="email" placeholder="<?= $row['franchiseandroles'] ?> E-mail">			  
            </div>
			</div>
			
			<div class="form-group row">
            <div class="col-sm-4">
            <label for="website" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Website</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="website" name="website" placeholder="Website">
			  
            </div>
			</div>
			<div class="form-group row">
            <div class="col-sm-4">
            <label for="gstno" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">GSTIN</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="gstno" name="gstno" placeholder="GSTIN">
			  
            </div>
			</div>
		
<div class="form-group row">
<div class="col-sm-4">
<label class="custom-label text-danger" for="pos">Place Of Supply *</label>
</div>
<div class="col-sm-8">
<select name="pos" id="pos" class="form-control  form-control-sm select4"  <?=((($access['branchinfohead']=='0')&&($access['branchinfoadd']=='0'))?'':'required')?>>
<option disabled value="" <?=($access['defaultplaceofsupply']=='manual'||'auto')?'selected':''?>>Select The Place</option> 
<option value="JAMMU AND KASHMIR (1)" <?=($access['defaultplaceofsupply']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($access['defaultplaceofsupply']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($access['defaultplaceofsupply']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($access['defaultplaceofsupply']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($access['defaultplaceofsupply']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($access['defaultplaceofsupply']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($access['defaultplaceofsupply']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($access['defaultplaceofsupply']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($access['defaultplaceofsupply']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($access['defaultplaceofsupply']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($access['defaultplaceofsupply']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($access['defaultplaceofsupply']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($access['defaultplaceofsupply']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($access['defaultplaceofsupply']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($access['defaultplaceofsupply']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($access['defaultplaceofsupply']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($access['defaultplaceofsupply']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($access['defaultplaceofsupply']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($access['defaultplaceofsupply']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($access['defaultplaceofsupply']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($access['defaultplaceofsupply']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($access['defaultplaceofsupply']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($access['defaultplaceofsupply']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($access['defaultplaceofsupply']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($access['defaultplaceofsupply']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($access['defaultplaceofsupply']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($access['defaultplaceofsupply']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($access['defaultplaceofsupply']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($access['defaultplaceofsupply']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($access['defaultplaceofsupply']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($access['defaultplaceofsupply']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($access['defaultplaceofsupply']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($access['defaultplaceofsupply']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($access['defaultplaceofsupply']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($access['defaultplaceofsupply']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($access['defaultplaceofsupply']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($access['defaultplaceofsupply']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($access['defaultplaceofsupply']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($access['defaultplaceofsupply']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>
</div>
</div>
<div class="form-group row" <?=(($access['dlnotwohead']=='0'&&($access['dlnotwoadd']=='0'))?'style="display:none;"':'')?>>
<div class="col-sm-4">
<label for="dlno20" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">DL No 20</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="dlno20" name="dlno20" placeholder="DL No 20">
</div>
</div>
<div class="form-group row" <?=(($access['dlnotonehead']=='0'&&($access['dlnotoneadd']=='0'))?'style="display:none;"':'')?>>
<div class="col-sm-4">
<label for="dlno21" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">DL No 21</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="dlno21" name="dlno21" placeholder="DL No 21">
</div>
</div>
			
			
    </div>
</div>

			   
              </div>
            </div>
          </div>

<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingBank">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBank" aria-expanded="true" aria-controls="collapseBank">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading" style="font-size:18px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Bank Details</a>	
</div>          
</button>
</h5>
<div id="collapseBank" class="accordion-collapse collapse show" aria-labelledby="headingBank"  style="">
<div class="accordion-body text-sm">

<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="bank" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Bank</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="bank" name="bank" placeholder="Bank">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="names" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Name</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="names" name="names" placeholder="Name">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="accountnumber" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Account Number</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="accountnumber" name="accountnumber" placeholder="Account Number">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="ifsccode" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">IFSC Code</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="ifsccode" name="ifsccode" placeholder="IFSC Code">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="branchandcity" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Branch & City</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="branchandcity" name="branchandcity" placeholder="Branch & City">
</div>
</div>
</div>
</div>

</div>
</div>
</div>
		  <?php
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if ((($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']!=0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']!=0))) {
?>
		  <div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingTwo">
              <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading" style="font-size:18px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Roles</a>	
				</div> 
                
              </button>
            </h5>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"  style="">
              <div class="accordion-body text-sm">
<!-- <?php
$sqlisaccess=mysqli_query($con, "select * from pairmodules order by id  asc");
while($infosaccess=mysqli_fetch_array($sqlisaccess))
{
    $coltype = preg_replace('/\s+/', '', $infosaccess['moduletype']);
    $moduletypeans=$infosaccess['moduletype'];
?>
<?php
$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='$moduletypeans' ORDER BY ordering ASC");
$infomainaccess=mysqli_fetch_array($sqlismainaccess);
if ($infomainaccess['moduleaccess']==1) {
?>
<input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
<input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
<div class="row" style="align-items: end; border-top:1px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
<div class="col-lg-2 p-0">
    
    <div class="tree ">
        
<ul style="padding-left:0; margin-bottom:0">
    <li><span><?= $infosaccess['grouptype'] ?></span>
        <ul>
            <li><span><?= $infomainaccess['modulename'] ?></span>
                <ul>
                <li style="font-size:10px;"><span>New <?= $infomainaccess['modulename'] ?> </span></li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
</div>

</div>
<div class="col-lg-10 px-0">


   
<div class="row align-items-center mt-2">
<div class="col-lg-2 pe-0">	
	<div class="form-check">
	
	  <input class="form-check-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenono<?=strtolower($coltype)?>" value="0">	
<label class="form-check-label" for="modulenono<?=strtolower($coltype)?>">No Access
	  </label> <i class="fa fa-info-circle"></i>
	</div>
	</div>
<div class="col-lg-2 p-0" id="fulla">	
	<div class="form-check">	
	  <input class="form-check-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenofull<?=strtolower($coltype)?>" value="1" checked>
<label class="form-check-label" for="modulenofull<?=strtolower($coltype)?>">Full Access
	  </label> <i class="fa fa-info-circle"></i>
	</div>
  </div>
<?php
if ($infomainaccess['explode']==0) {
    ?>
  <div class="col-lg-2" style="background-color:#F7F7F7; height:42px; align-item:middle; margin-right:-10px;">	
	<label for="moduleno<?=strtolower($coltype)?>" class="custom-label" style="margin-top: 0.7rem; margin-left:0rem;font-size: 0.8rem;">Transaction Series</label>
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:5px 0">	
	<input type="text" class="form-control  form-control-sm myinput" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" placeholder="Prefix (Static Characters E.g. INV-)">
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:5px 0">	
	<input type="number" class="form-control  form-control-sm myinput" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" placeholder="Suffix (Automatic Numbering E.g. 001)" style="width:98%">
  </div>
  <?php
}
else{
    ?>
    <input type="hidden" class="form-control  form-control-sm myinput" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" value="">
    <input type="hidden" class="form-control  form-control-sm myinput" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" value="">
    <?php
}
?>
</div>
 
  </div>
  
</div>
<?php
}
else{
?>
<input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
<input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
<input type="hidden" name="moduleno<?=strtolower($coltype)?>" id="moduleno<?=strtolower($coltype)?>" value="0">
<input type="hidden" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" value="">
<input type="hidden" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" value="">
<?php
}
}
?> -->
<div class="row" style=" border-top:2px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <div class="col-lg-12">
            <label class="custom-label mt-2" style="color:royalblue !important;"><span style="margin-left: -6px !important;"><?= $row['books'] ?></span></label>
            </div>
            </div>
            <?php
$sqlmain = mysqli_query($con,"select distinct grouptype,groupname,groupaccess from pairmainaccess where userid='$userid' and moduletype!=''");
while($sqlmainresult = mysqli_fetch_array($sqlmain)){
    $grouptype = preg_replace('/\s+/', '', $sqlmainresult['grouptype']);
    $maingrouptype=$sqlmainresult['grouptype'];
    if ($sqlmainresult['groupaccess']=='1') {
?>
<div class="row" style=" border-top:1px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
<div class="col-lg-2">
<label class="custom-label mt-2" style="margin-left: 12.3px;color: royalblue !important;"><?=$sqlmainresult['groupname']?></label>
</div>
</div>
<?php
}
$sqlismainaccess=mysqli_query($con, "select distinct modulename,moduleaccess,moduletype,moduleno,moduleprefix,modulesuffix,groupaccess,groupname from pairmainaccess where (userid='$companymainid' and createdid='0') and (grouptype='$maingrouptype' and moduletype!='') ORDER BY ordering ASC");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and (grouptype='$maingrouptype' and moduletype='".$infomainaccess['moduletype']."') ORDER BY ordering ASC");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if(($infomainaccess['moduleaccess']==1)&&((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessview']==1||$infomainaccessuser['useraccesscreate']==1||$infomainaccessuser['useraccessedit']==1||$infomainaccessuser['useraccessdelete']==1)))) {
?>
<input type="hidden" name="group<?=strtolower($coltype)?>" id="group<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupaccess'] ?>">
<input type="hidden" name="grouptype<?=strtolower($coltype)?>" id="grouptype<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupname'] ?>">
<input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
<input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
            <div class="row" style=" border-top:0px solid #eee;padding:5px 0;margin-left:18px;">
            <div class="col-lg-2">
                        <label class="custom-label"> <?= $infomainaccess['modulename']; ?> (New <?= $infomainaccess['modulename'] ?>)</label>
                      </div>
            <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-3 my-1"> 
    <div class="custom-control custom-radio mr-sm-2">
    
      <input class="custom-control-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenono<?=strtolower($coltype)?>" value="0" <?=($coltype!='Products'||$coltype!='Services'||$coltype!='InventoryAdjustments'||$coltype!='Customers'||$coltype!='Vendors'||$coltype!='Enquiries'||$coltype!='Quotations'||$coltype!='Estimates'||$coltype!='ProformaInvoices'||$coltype!='Jobs'||$coltype!='SalesOrders'||$coltype!='DeliveryChallans'||$coltype!='Invoices'||$coltype!='PaymentsReceived'||$coltype!='SalesReturns'||$coltype!='CustomerRefunds'||$coltype!='PurchaseOrders'||$coltype!='PurchaseReceives'||$coltype!='Bills'||$coltype!='PaymentsMade'||$coltype!='PurchaseReturns'||$coltype!='VendorRefunds'||$coltype!='CreditNotes'||$coltype!='DebitNotes')?'checked':''?>> 
<label class="custom-control-label custom-label" for="modulenono<?=strtolower($coltype)?>">No Access
      </label> <i class="fa fa-info-circle"></i>
    </div>
    </div>
    <div class="col-lg-3 my-1" id="fulla">   
    <div class="custom-control custom-radio mr-sm-2">    
      <input class="custom-control-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenofull<?=strtolower($coltype)?>" value="1" <?=($coltype=='Products'||$coltype=='Services'||$coltype=='InventoryAdjustments'||$coltype=='Customers'||$coltype=='Vendors'||$coltype=='Enquiries'||$coltype=='Quotations'||$coltype=='Estimates'||$coltype=='ProformaInvoices'||$coltype=='Jobs'||$coltype=='SalesOrders'||$coltype=='DeliveryChallans'||$coltype=='Invoices'||$coltype=='PaymentsReceived'||$coltype=='SalesReturns'||$coltype=='CustomerRefunds'||$coltype=='PurchaseOrders'||$coltype=='PurchaseReceives'||$coltype=='Bills'||$coltype=='PaymentsMade'||$coltype=='PurchaseReturns'||$coltype=='VendorRefunds'||$coltype=='CreditNotes'||$coltype=='DebitNotes')?'checked':''?>>
<label class="custom-control-label custom-label" for="modulenofull<?=strtolower($coltype)?>">Full Access
      </label> <i class="fa fa-info-circle"></i>
    </div>
  </div>

                  </div>
            </div>
            </div>
            <!-- <div class="row" style=" border-top:0px solid #eee;padding:5px 0;margin-left: 18px;">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-10">
            <div class="row">
 <div class="col-lg-3 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input implode" name="prefixsuffix<?=strtolower($coltype)?>" id="implode<?=strtolower($coltype)?>" value="0" checked>
                        <label class="custom-control-label custom-label" for="implode<?=strtolower($coltype)?>">Implode Prefix Suffix</label>
                      </div>
                      
                      </div>
                      
                    <div class="col-lg-3 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input explode" name="prefixsuffix<?=strtolower($coltype)?>" id="explode<?=strtolower($coltype)?>" value="1">
                        <label class="custom-control-label custom-label" for="explode<?=strtolower($coltype)?>">Explode Prefix Suffix</label>
                      </div>
                      
                      </div>
                  </div>
            </div>
            </div> -->
            <?php
                        if ($coltype=='Products') {
                            $placeholderforprefix = 'PRO';
                        }
                        elseif ($coltype=='Services') {
                            $placeholderforprefix = 'SERV';
                        }
                        elseif ($coltype=='InventoryAdjustments') {
                            $placeholderforprefix = 'INVADJ';
                        }
                        elseif ($coltype=='Customers') {
                            $placeholderforprefix = 'CUS';
                        }
                        elseif ($coltype=='Enquiries') {
                            $placeholderforprefix = 'ENQ';
                        }
                        elseif ($coltype=='Quotations') {
                            $placeholderforprefix = 'QT';
                        }
                        elseif ($coltype=='Estimates') {
                            $placeholderforprefix = 'EST';
                        }
                        elseif ($coltype=='ProformaInvoices') {
                            $placeholderforprefix = 'PROINV';
                        }
                        elseif ($coltype=='Jobs') {
                            $placeholderforprefix = 'JOB';
                        }
                        elseif ($coltype=='SalesOrders') {
                            $placeholderforprefix = 'SALEORD';
                        }
                        elseif ($coltype=='DeliveryChallans') {
                            $placeholderforprefix = 'DELCH';
                        }
                        elseif ($coltype=='Invoices') {
                            $placeholderforprefix = 'INV';
                        }
                        elseif ($coltype=='PaymentsReceived') {
                            $placeholderforprefix = 'PAYREC';
                        }
                        elseif ($coltype=='SalesReturns') {
                            $placeholderforprefix = 'SALERET';
                        }
                        elseif ($coltype=='CustomerRefunds') {
                            $placeholderforprefix = 'CUSREFUND';
                        }
                        elseif ($coltype=='Vendors') {
                            $placeholderforprefix = 'VEN';
                        }
                        elseif ($coltype=='PurchaseOrders') {
                            $placeholderforprefix = 'PURORD';
                        }
                        elseif ($coltype=='PurchaseReceives') {
                            $placeholderforprefix = 'PURREC';
                        }
                        elseif ($coltype=='Bills') {
                            $placeholderforprefix = 'BILL';
                        }
                        elseif ($coltype=='PaymentsMade') {
                            $placeholderforprefix = 'PAYMADE';
                        }
                        elseif ($coltype=='PurchaseReturns') {
                            $placeholderforprefix = 'PURRET';
                        }
                        elseif ($coltype=='VendorRefunds') {
                            $placeholderforprefix = 'VENREFUND';
                        }
                        elseif ($coltype=='ManualJournals') {
                            $placeholderforprefix = 'MANJOURN';
                        }
                        elseif ($coltype=='ChartofAccounts') {
                            $placeholderforprefix = 'CHACC';
                        }
                        elseif ($coltype=='Projects') {
                            $placeholderforprefix = 'PROJEC';
                        }
                        elseif ($coltype=='Timesheet') {
                            $placeholderforprefix = 'TIMESH';
                        }
                        ?>
            <script>
function dname(x){
var store=x.value;
var storeans = store.substring(0,3);
var storelen=x.value.length;
if (storelen>=0) {
let prefix = document.getElementsByClassName('prejs');
prefixlen = prefix.length;
for (i=0;i<prefixlen;i++) {
if (prefix[i].classList.contains('moduleprefixproducts')) {
ansprefixnames = 'PRO';
}
else if (prefix[i].classList.contains('moduleprefixservices')){
ansprefixnames = 'SERV';
}
else if (prefix[i].classList.contains('moduleprefixinventoryadjustments')) {
ansprefixnames = 'INVADJ';
}
else if (prefix[i].classList.contains('moduleprefixcustomers')) {
ansprefixnames = 'CUS';
}
else if (prefix[i].classList.contains('moduleprefixenquiries')) {
ansprefixnames = 'ENQ';
}
else if (prefix[i].classList.contains('moduleprefixquotations')) {
ansprefixnames = 'QT';
}
else if (prefix[i].classList.contains('moduleprefixestimates')) {
ansprefixnames = 'EST';
}
else if (prefix[i].classList.contains('moduleprefixproformainvoices')) {
ansprefixnames = 'PROINV';
}
else if (prefix[i].classList.contains('moduleprefixjobs')) {
ansprefixnames = 'JOB';
}
else if (prefix[i].classList.contains('moduleprefixsalesorders')) {
ansprefixnames = 'SALEORD';
}
else if (prefix[i].classList.contains('moduleprefixdeliverychallans')) {
ansprefixnames = 'DELCH';
}
else if (prefix[i].classList.contains('moduleprefixinvoices')) {
ansprefixnames = 'INV';
}
else if (prefix[i].classList.contains('moduleprefixpaymentsreceived')) {
ansprefixnames = 'PAYREC';
}
else if (prefix[i].classList.contains('moduleprefixsalesreturns')) {
ansprefixnames = 'SALERET';
}
else if (prefix[i].classList.contains('moduleprefixpaymentsmadeforsalesreturns')) {
ansprefixnames = 'CUSREFUND';
}
else if (prefix[i].classList.contains('moduleprefixvendors')) {
ansprefixnames = 'VEN';
}
else if (prefix[i].classList.contains('moduleprefixpurchaseorders')) {
ansprefixnames = 'PURORD';
}
else if (prefix[i].classList.contains('moduleprefixpurchasereceives')) {
ansprefixnames = 'PURREC';
}
else if (prefix[i].classList.contains('moduleprefixbills')) {
ansprefixnames = 'BILL';
}
else if (prefix[i].classList.contains('moduleprefixpaymentsmade')) {
ansprefixnames = 'PAYMADE';
}
else if (prefix[i].classList.contains('moduleprefixpurchasereturns')) {
ansprefixnames = 'PURRET';
}
else if (prefix[i].classList.contains('moduleprefixpaymentsmadeforpurchasereturn')) {
ansprefixnames = 'VENREFUND';
}
else if (prefix[i].classList.contains('moduleprefixmanualjournals')) {
ansprefixnames = 'MANJOURN';
}
else if (prefix[i].classList.contains('moduleprefixchartofaccounts')) {
ansprefixnames = 'CHACC';
}
else if (prefix[i].classList.contains('moduleprefixprojects')) {
ansprefixnames = 'PROJEC';
}
else if (prefix[i].classList.contains('moduleprefixtimesheet')) {
ansprefixnames = 'TIMESH';
}
prefix[i].value = storeans + ansprefixnames;
}
}
}
</script>
            <div class="row" style=" border-top:0px solid #eee;padding:5px 0;margin-left: 18px;">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-2" style="background-color:#F7F7F7;  align-item:middle; margin-right:-10px;">    
    <label for="moduleno<?=strtolower($coltype)?>" class="custom-label" style="margin-top: 1rem; margin-left:0rem;font-size: 0.8rem;">Transaction Series</label>
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:12px 0">   
    <input type="text" class="form-control  form-control-sm myinput prejs moduleprefix<?=strtolower($coltype)?>" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" placeholder="Prefix (Static Characters E.g. <?= $placeholderforprefix ?>-)" value="<?= $placeholderforprefix ?>" maxlength="90">
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:12px 0px 15px 0px">   
    <input type="number" class="form-control  form-control-sm myinput" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" placeholder="Suffix (Automatic Numbering E.g. 0)" value="0">
  </div>
                  </div>
            </div>
            </div>
<?php
}
else{
?>
<input type="hidden" name="group<?=strtolower($coltype)?>" id="group<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupaccess'] ?>">
<input type="hidden" name="grouptype<?=strtolower($coltype)?>" id="grouptype<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupname'] ?>">
<input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
<input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
<input type="hidden" name="moduleno<?=strtolower($coltype)?>" id="moduleno<?=strtolower($coltype)?>" value="0">
<!-- <input type="hidden" name="prefixsuffix<?=strtolower($coltype)?>" id="implode<?=strtolower($coltype)?>" value="0"> -->
<input type="hidden" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" value="">
<input type="hidden" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" value="">  
<?php
}
}
}
?>
<div class="row" style=" border-top:1px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
</div>




</div>
</div>


  </div>
<?php
}
?>
			   
              </div>
			  
			  <div class="row justify-content-center" style="margin-bottom: -14px;">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Save"
                                                            style="margin-bottom: 15px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="franchises.php" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Cancel</a>
    </div>
</div>
            </div>
          </div>
</div>





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
<script>
 function previewLogo() {
  var preview = document.getElementById('branch-image1');
  var file    = document.getElementById('branch-image-upload').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
  
}
                      $(function() {
            $('#branch-image1').on('click', function() {
                $('#branch-image-upload').click();
            });
            $('#branch-image2').on('click', function() {
                $('#branch-image-upload').click();
            });
        });
 function previewSign() {
  var preview = document.getElementById('sign-image1');
  var file    = document.getElementById('sign-image-upload').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
  
}
                      $(function() {
            $('#sign-image1').on('click', function() {
                $('#sign-image-upload').click();
            });
            $('#sign-image2').on('click', function() {
                $('#sign-image-upload').click();
            });
        });
 function previewscanqr() {
  var preview = document.getElementById('scanqr-image1');
  var file    = document.getElementById('scanqr-image-upload').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
  
}
function upiidaccess(){
    if(document.getElementById("upiidaccess").checked){
        document.getElementById('upicontainer').style.display = 'flex';
        document.getElementById('upiid').required = true;
        document.getElementById('upiid').value = '';
    }
    else{
        document.getElementById('upicontainer').style.display = 'none';
        document.getElementById('upiid').required = false;
        document.getElementById('upiid').value = '';
    }
}
                      $(function() {
            $('#scanqr-image1').on('click', function() {
                $('#scanqr-image-upload').click();
            });
            $('#scanqr-image2').on('click', function() {
                $('#scanqr-image-upload').click();
            });
        });
        
</script>





    
</body>

</html>