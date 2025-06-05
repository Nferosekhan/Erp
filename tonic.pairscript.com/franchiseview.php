<?php
include('lcheck.php');
if($permissionfranchise=='0')
{
	header('Location: dashboard.php');
}
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($con, $_GET['id']);
$sqli=mysqli_query($con, "select * from pairfranchises where tdelete='0' and id='".$id."' order by franchisename asc");
if(mysqli_num_rows($sqli)>0)
{
$info=mysqli_fetch_array($sqli);
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
    <?= $row['franchiseandroles'] ?> Details
  </title>
  
   <link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
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
<div class="row">
<div class="col-lg-6">
 <p class="mb-3" style="font-size:20px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-eye"></i> <?= $row['franchiseandroles'] ?> Details</p>
 </div>
 <div class="col-lg-6">
 <span style="float:right" class="mb-3">

<form action="franchisechange.php" method="get">
    <?php
if($permissionfranchise!=1){
    ?>
<a class="btn btn-primary btn-sm btn-custom-grey" href="franchiseedit.php?id=<?=$info['id']?>" style="margin-bottom:0rem; margin-right:10px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-pencil-alt"></i> Edit</a>
<input type="hidden" name="id" value="<?=$info['id']?>">
<input type="checkbox" <?=($info['astatus']=='0')?'checked':''?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-style="slow"  data-size="small" value="0" name="val" onchange="this.form.submit()">
<?php
}
?>
</form>
  </span>
  </div>
  </div>

<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


<nav>
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><div class="customcont-header ml-0">
	
		<a class="customcont-heading" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Overview</a>	
             
				</div></button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
		<div class="customcont-header ml-0">
	
		<a class="customcont-heading" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">History</a>	
             
				</div>
		
		</button>
		
  </div>
  
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <?php
    if (($access['branchinfohead']=='1')&&($access['branchinfoview']=='1')) {
    ?>
<p class="m-3" style="font-size: 17px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Details</p>
<div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Print Logo</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?php
if($info['branchimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Branch Pic" src="<?=str_replace('../ups','ups',$img)?>" id="branch-image1" style="height: 30px !important;width: 30px !important;">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>


        <img alt="Branch Pic" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="branch-image1" style="height: 30px !important;width: 30px !important;">

    <?php
}
?>
        </div>
      </div>
<div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Authorized Signature</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?php
if($info['signimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Sign Pic" src="<?=str_replace('../ups','ups',$img)?>" id="sign-image1" style="height: 30px !important;width: 30px !important;">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>


        <img alt="Sign Pic" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="sign-image1" style="height: 30px !important;width: 30px !important;">

    <?php
}
?>
        </div>
      </div>
<div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Scanner QR Code</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?php
if($info['qrcode']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['qrcode']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Scanner QR Code" src="<?=str_replace('../ups','ups',$img)?>" id="scanqr-image1" style="height: 30px !important;width: 30px !important;">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>


        <img alt="Scanner QR Code" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="scanqr-image1" style="height: 30px !important;width: 30px !important;">

    <?php
}
?>
        </div>
      </div> 	 
<div class="row m-3" style="align-items: center;<?=(($info['upiid']!='')?'':'display: none;')?>">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Upi Id</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['upiid']?>
        </div>
      </div> 
<div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Display Name</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['displayname']?>
        </div>
      </div> 
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Name</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['franchisename']?>
        </div>
      </div>
	  
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Address</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['street']?> <?=$info['city']?> <?=$info['pincode']?> <?=$info['state']?> <?=$info['country']?>
        </div>
      </div>
	  
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Phone</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['mobile']?>
        </div>
      </div>
	  <div class="row m-3" style="align-items: center;">
	  
		  <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> E-mail</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['email']?>
        </div>
      </div>
	  
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Website</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['website']?>
        </div>
      </div>
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">GSTIN</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['gstno']?>
        </div>
      </div>
	  <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Place of Supply</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['pos']?>
        </div>
      </div>
      <div class="row m-3" style="align-items: center;<?=(($access['dlnotwohead']=='0'&&($access['dlnotwoview']=='0'))?'display:none;':'')?>">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">DL No 20</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['dlno20']?>
        </div>
      </div>
      <div class="row m-3" style="align-items: center;<?=(($access['dlnotonehead']=='0'&&($access['dlnotoneview']=='0'))?'display:none;':'')?>">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">DL No 21</span>
        </div>
        <div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
           <?=$info['dlno21']?>
        </div>
      </div>
          <hr>
          <?php
      }
      ?>
<p class="m-3" style="font-size: 17px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Bank Details</p> 
<div class="row m-3" style="align-items: center;">
<div class="col-sm-3 col-md-2 col-6">
<span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Bank</span>
</div>
<div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<?=$info['bank']?>
</div>
</div>
<div class="row m-3" style="align-items: center;">
<div class="col-sm-3 col-md-2 col-6">
<span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Name</span>
</div>
<div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<?=$info['names']?>
</div>
</div> 
<div class="row m-3" style="align-items: center;">
<div class="col-sm-3 col-md-2 col-6">
<span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Account Number</span>
</div>
<div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<?=$info['accountnumber']?>
</div>
</div> 
<div class="row m-3" style="align-items: center;">
<div class="col-sm-3 col-md-2 col-6">
<span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">IFSC Code</span>
</div>
<div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<?=$info['ifsccode']?>
</div>
</div> 
<div class="row m-3" style="align-items: center;">
<div class="col-sm-3 col-md-2 col-6">
<span style="font-size:13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Branch & City</span>
</div>
<div class="col-md-8 col-6" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<?=$info['branchandcity']?>
</div>
</div>  
	  <hr>
          <?php
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if ((($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']!=0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']!=0))) {
?>
<p class="m-3" style="font-size: 17px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles'] ?> Roles</p>	  
	  <div class="row m-3">
        <div class="col-sm-12 col-md-12 col-12">
		
		
<!-- <?php
$sqlisaccess=mysqli_query($con, "select * from pairmodules order by id  asc");
while($infosaccess=mysqli_fetch_array($sqlisaccess))
{
    $coltype = preg_replace('/\s+/', '', $infosaccess['moduletype']);
    $moduletypeans=$infosaccess['moduletype'];
?>
<?php
$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where franchiseid='$id' and moduletype='$moduletypeans' ORDER BY ordering ASC");
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
    
      <input class="form-check-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenono<?=strtolower($coltype)?>" value="0" disabled <?= ($infomainaccess['moduleno']=='0')?'checked':''?>> 
<label class="form-check-label" for="modulenono<?=strtolower($coltype)?>">No Access
      </label> <i class="fa fa-info-circle"></i>
    </div>
    </div>
<div class="col-lg-2 p-0" id="fulla">   
    <div class="form-check">    
      <input class="form-check-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenofull<?=strtolower($coltype)?>" value="1" disabled <?= ($infomainaccess['moduleno']=='1')?'checked':''?>>
<label class="form-check-label" for="modulenofull<?=strtolower($coltype)?>">Full Access
      </label> <i class="fa fa-info-circle"></i>
    </div>
  </div>

<?php
$sqlismainaccesspresuf=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='$moduletypeans' ORDER BY ordering ASC");
$infomainaccesspresuf=mysqli_fetch_array($sqlismainaccesspresuf);
if ($infomainaccesspresuf['explode']==0) {
    ?>
  <div class="col-lg-2" style="background-color:#F7F7F7; height:42px; align-item:middle; margin-right:-10px;">  
    <label for="moduleno<?=strtolower($coltype)?>" class="custom-label" style="margin-top: 0.7rem; margin-left:0rem;font-size: 0.8rem;">Transaction Series</label>
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:5px 0">   
    <input type="text" class="form-control  form-control-sm myinput" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" placeholder="Prefix (Static Characters E.g. INV-)" disabled value="<?= $infomainaccess['moduleprefix'] ?>">
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:5px 0">   
    <input type="number" class="form-control  form-control-sm myinput" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" placeholder="Suffix (Automatic Numbering E.g. 001)" style="width:98%" disabled value="<?= $infomainaccess['modulesuffix'] ?>">
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
$sqlismainaccess=mysqli_query($con, "select distinct modulename,moduleaccess,moduletype,moduleno,moduleprefix,modulesuffix,groupaccess,groupname from pairmainaccess where franchiseid='$id' and (grouptype='$maingrouptype' and moduletype!='') ORDER BY ordering ASC");
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
    
      <input class="custom-control-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenono<?=strtolower($coltype)?>" value="0" <?= ($infomainaccess['moduleno']=='0')?'checked':''?> disabled> 
<label class="custom-control-label custom-label" for="modulenono<?=strtolower($coltype)?>">No Access
      </label> <i class="fa fa-info-circle"></i>
    </div>
    </div>
    <div class="col-lg-3 my-1" id="fulla">   
    <div class="custom-control custom-radio mr-sm-2">    
      <input class="custom-control-input" type="radio" name="moduleno<?=strtolower($coltype)?>" id="modulenofull<?=strtolower($coltype)?>" value="1" <?= ($infomainaccess['moduleno']=='1')?'checked':''?> disabled>
<label class="custom-control-label custom-label" for="modulenofull<?=strtolower($coltype)?>">Full Access
      </label> <i class="fa fa-info-circle"></i>
    </div>
  </div>

                  </div>
            </div>
            </div>
            <!-- <div class="row" style=" border-top:0px solid #eee;padding:5px 0;margin-left:18px;">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-10">
            <div class="row">
 <div class="col-lg-3 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input implode" name="prefixsuffix<?=strtolower($coltype)?>" id="implode<?=strtolower($coltype)?>" value="0" <?= ($infomainaccess['explode']=='0')?'checked':''?> disabled>
                        <label class="custom-control-label custom-label" for="implode<?=strtolower($coltype)?>">Implode Prefix Suffix</label>
                      </div>
                      
                      </div>
                      
                    <div class="col-lg-3 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input explode" name="prefixsuffix<?=strtolower($coltype)?>" id="explode<?=strtolower($coltype)?>" value="1" <?= ($infomainaccess['explode']=='1')?'checked':''?> disabled>
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
                            $placeholderforprefix = 'QUO';
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
                            $placeholderforprefix = 'SOR';
                        }
                        elseif ($coltype=='DeliveryChallans') {
                            $placeholderforprefix = 'DLC';
                        }
                        elseif ($coltype=='Invoices') {
                            $placeholderforprefix = 'INV';
                        }
                        elseif ($coltype=='Paymentsreceived') {
                            $placeholderforprefix = 'PMR';
                        }
                        elseif ($coltype=='SalesReturns') {
                            $placeholderforprefix = 'SLR';
                        }
                        elseif ($coltype=='CustomerRefunds') {
                            $placeholderforprefix = 'CRE';
                        }
                        elseif ($coltype=='Vendors') {
                            $placeholderforprefix = 'VEN';
                        }
                        elseif ($coltype=='PurchaseOrders') {
                            $placeholderforprefix = 'PUO';
                        }
                        elseif ($coltype=='PurchaseReceives') {
                            $placeholderforprefix = 'PUR';
                        }
                        elseif ($coltype=='Bills') {
                            $placeholderforprefix = 'BIL';
                        }
                        elseif ($coltype=='PaymentsMade') {
                            $placeholderforprefix = 'PYM';
                        }
                        elseif ($coltype=='PurchaseReturns') {
                            $placeholderforprefix = 'PRT';
                        }
                        elseif ($coltype=='VendorRefunds') {
                            $placeholderforprefix = 'VRE';
                        }
                        elseif ($coltype=='ManualJournals') {
                            $placeholderforprefix = 'MJS';
                        }
                        elseif ($coltype=='ChartofAccounts') {
                            $placeholderforprefix = 'CAC';
                        }
                        elseif ($coltype=='Projects') {
                            $placeholderforprefix = 'PRJ';
                        }
                        elseif ($coltype=='Timesheet') {
                            $placeholderforprefix = 'TSH';
                        }
                        ?>
            <div class="row" style=" border-top:0px solid #eee;padding:5px 0;margin-left:18px;">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-10">
            <div class="row">
                <div class="col-lg-2" style="background-color:#F7F7F7;  align-item:middle; margin-right:-10px;">    
    <label for="moduleno<?=strtolower($coltype)?>" class="custom-label" style="margin-top: 1rem; margin-left:0rem;font-size: 0.8rem;">Transaction Series</label>
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:12px 0">   
    <input type="text" class="form-control  form-control-sm myinput" id="moduleprefix<?=strtolower($coltype)?>" name="moduleprefix<?=strtolower($coltype)?>" placeholder="Prefix (Static Characters E.g. <?= $placeholderforprefix ?>-)" value="<?= $infomainaccess['moduleprefix']?>" disabled>
  </div>
  <div class="col-lg-3 px-1" style="background-color:#F7F7F7; padding:12px 0px 15px 0px">   
    <input type="number" class="form-control  form-control-sm myinput" id="modulesuffix<?=strtolower($coltype)?>" name="modulesuffix<?=strtolower($coltype)?>" placeholder="Suffix (Automatic Numbering E.g. 0)" value="<?= $infomainaccess['modulesuffix']?>" disabled>
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
<?php
}
?>

	  
	  
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
	  <div class="table-responsive m-3">
	  <table class="table table-bordered" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
	  <thead>
	  <tr>
	  <td><span>DATE</span></td>
	  <td><span>DETAILS</span></td>
	  </tr>
	  </thead>
	  <tbody>
	  <?php
	  $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='FRANCHISE' and useid='$id'  order by createdon desc");
	  while($infouse=mysqli_fetch_array($sqluse))
	  {
        $fn=$infouse['franchisenamech'];
        $fs=$infouse['franchiseaddressch'];
        $fp=$infouse['franchisephonech'];
        $fe=$infouse['franchiseemailch'];
        $fw=$infouse['franchisewebsitech'];
        $fg=$infouse['franchisegstch'];
        $fc=$infouse['city'];
        $fpi=$infouse['pincode'];
        $fst=$infouse['state'];
        $fco=$infouse['country'];
	  ?>
		<tr>
		  <td data-label="DATE" style="color:grey"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
		  <td data-label="DETAILS"><?=$infouse['useremarks']?> <br> <span><?=(($infouse['useremarks']=='FRANCHISE CREATED')?'Created By':'Changed By')?></span> <span  style="color:grey"><?=$info['createdby']?></span> </td>
		</tr>
	  <?php
	  }
	  ?>
	  
	  </tbody>
	  </table>
	  </div>
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
 <script src="assets/js/bootstrap-toggle.min.js"></script>
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
	header("Location: franchises.php?error=No Information Found");
}
}
else
{
	header("Location: franchises.php?remarks= Franchise Changed Successfully");
}
?>