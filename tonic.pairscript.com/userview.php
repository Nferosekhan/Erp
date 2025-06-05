<?php
include('lcheck.php');
if($permissionuser==0){
  header('Location:dashboard.php');
}
// ROW FOR ADMIN    ||     INFO FOR USER
$sqlss="select * from paircontrols where id='$companymainid'";
$resultss=mysqli_query($con,$sqlss);
$rowww=mysqli_fetch_assoc($resultss);
$sql="select * from paircontrols where createdid='$companymainid'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($con, $_GET['id']);
$sqli=mysqli_query($con, "select * from paircontrols where id='".$id."' order by username asc");
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
    <?= $row['userandroles'] ?> Details
  </title>
   <link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
   
</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6">
 <?php
  // sidebar
  include('sidebar.php');
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
     <style type="text/css">
    .dropdown:not(.dropdown-hover) .dropdown-menu{
        margin-top: 8px !important;
    }
</style>
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
       <div style="max-width: 1650px;">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;z-index: 0;">

<div class="row">
<div class="col-lg-6">
 <p class="mb-3" style="font-size:20px;"><i class="fa fa-eye"></i> <?= $row['userandroles'];?> Details</p>

 </div>
 <div class="col-lg-6">
 <span style="float:right" class="mb-3">

<form action="userchange.php" method="get">
  <?php
        if($permissionuser!=1){
          ?>
<a class="btn btn-primary btn-sm btn-custom-grey" href="useredit.php?id=<?=$info['id']?>" style="margin-bottom:0rem; margin-right:10px;"><i class="fa fa-pencil-alt"></i> Edit</a>
<input type="hidden" name="id" value="<?=$info['id']?>">
<input type="checkbox" <?=($info['is_active']=='0')?'checked':''?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-style="slow"  data-size="small" value="0" name="val" onchange="this.form.submit()">
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
  
    <a class="customcont-heading">Overview</a>  
             
        </div></button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
    <div class="customcont-header ml-0">
  
    <a class="customcont-heading">History</a> 
             
        </div>
    
    </button>
    
  </div>
  
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<p class="m-3" style="font-size: 17px;"><?= $row['userandroles'];?> Details</p>   
    <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;">First Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['firstname']?>
        </div>
      </div>
    
    <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;">Last Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['lastname']?>
        </div>
      </div>
    
    <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;">D.O.B</span>
        </div>
        <div class="col-md-8 col-6">
           <?=($info['dob']!='')?date('d/m/Y', strtotime($info['dob'])):''?>
        </div>
      </div>
    <div class="row m-3" style="align-items: center;">
    
      <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;">Designation</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['designation']?>
        </div>
      </div>
    <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;">Email Address</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['email']?>
        </div>
      </div>
    <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;"><?= $row['userandroles'];?> name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['usernewname']?>
        </div>
      </div>
    <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;">Mobile Phone</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['mobile']?>
        </div>
      </div>
      <?php
      if ($access['userdetailpassword']!=0) {
      if ($access['userdetailpasswordview']!=0) {
      ?>
      <div class="row m-3" style="align-items: center;">
        <div class="col-sm-3 col-md-2 col-6">
          <span style="font-size:13px;">Password</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['password']?>
        </div>
      </div>
      <?php
  }
}
?>
    <hr>
<p class="m-3" style="font-size: 17px;"><?= $row['userandroles'];?> Roles</p>   
    <div class="row m-3">
        <div class="col-sm-12 col-md-12 col-12">
            <div class="row" style=" border-top:2px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
      <div class="col-lg-2">
      <label class="custom-label" style="color: royalblue;font-size: 14.6px;">Default Permissions</label>
      </div>
      <div class="col-lg-10">
          
      <div class="row">
        <div class="col-lg-3 my-1">
                      <select class="form-control form-control-sm" onchange="showDiv(this)" disabled>
                          <option hidden>Select</option>
                          <option value="0">Owner / Investor</option>
                          <option value="1">Manager / Admin</option>
                          <option value="2">Biller / Cashier</option>
                      </select>
            </div>
          </div>
          
      </div>
      
      
      </div>
          <div class="row" style=" border-top:2px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
      <div class="col-lg-2">
      <label class="custom-label" style="color: royalblue;font-size: 14.6px;">Default Permissions</label>
      </div>
      <div class="col-lg-10">
          
      <div class="row">
        <?php
                if($rowww['permissioninsights']=='1'){
               ?>
         <div class="col-lg-2 my-1">
                      <div class="form-check mr-sm-2">
                        <input type="checkbox" class="form-check-input" name="permissioninsights" style="margin-top: 6px;margin-left: -18px;" id="permissioninsights" disabled <?= ($info['permissioninsights']=='1')?'checked':''?>>
                        <label class="custom-check-label custom-label" for="permissioninsights"> Insights</label>
                      </div>
                      
                      </div>
                       <?php
              }
              ?>
            <div class="col-lg-2 my-1">
                      <div class="form-check mr-sm-2">
                        <input type="checkbox" class="form-check-input" style="margin-top: 6px;margin-left: -18px;" name="permissiondashboard" id="permissiondashboard" checked disabled <?= ($info['permissiondashboard']=='1')?'checked':''?>>
                        <label class="custom-check-label custom-label" for="permissiondashboard"> Dashboard</label>
                      </div>
                      
                      </div>
                      <?php
                if($rowww['permissionnotification']=='1'){
               ?>
                      <div class="col-lg-2 my-1">
                      <div class="form-check mr-sm-2">
                        <input type="checkbox" class="form-check-input" style="margin-top: 6px;margin-left: -18px;" name="permissionnotification" id="permissionnotification" disabled <?= ($info['permissionnotification']=='1')?'checked':''?>>
                        <label class="custom-check-label custom-label" for="permissionnotification"> Notifications</label>
                      </div>
                      
                      </div>
                      <?php
              }
              ?>
               <?php
                if($rowww['permissionhelp']=='1'){
               ?>
                      <div class="col-lg-2 my-1">
                      <div class="form-check mr-sm-2">
                        <input type="checkbox" class="form-check-input" style="margin-top: 6px;margin-left: -18px;" name="permissionhelp" id="permissionhelp" disabled <?= ($info['permissionhelp']=='1')?'checked':''?>>
                        <label class="custom-check-label custom-label" for="permissionhelp"> Help</label>
                      </div>
                      
                      </div>
                      <?php
              }
              ?>
               <?php
                if($rowww['permissionmyaccount']=='1'){
               ?>
                      <div class="col-lg-2 my-1">
                      <div class="form-check mr-sm-2">
                        <input type="checkbox" class="form-check-input" style="margin-top: 6px;margin-left: -18px;" name="permissionmyaccount" id="permissionmyaccount" disabled <?= ($info['permissionmyaccount']=='1')?'checked':''?>>
                        <label class="custom-check-label custom-label" for="permissionmyaccount"> My Account</label>
                      </div>
                      
                      </div>
                      <?php
              }
              ?>
            
          </div>
          
      </div>
      
      
      </div>
      <?php
              $sql=mysqli_query($con,"SELECT * FROM paircontrols WHERE id='$companymainid' AND role='SUPER ADMIN'");
              while($row=mysqli_fetch_assoc($sql)){
              
               ?>
      
      <?php
      if($permissionfranchise!=0||$permissionuser!=0||$permissionpreference!=0||$permissionconfig!=0){
      ?>
            <div class="row" style=" border-top:1px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <div class="col-lg-12">
            <label class="custom-label mr-sm-2" style="font-size: 14.6px;color:royalblue;">App Permissions</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      
                  </div>
                  
            </div>
            
            
            </div>
            
            <?php
         if($permissionfranchise!='0')
         {
        ?>
      <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2"><?= $row['franchiseandroles'];?> & Roles</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">

                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionfranchise" id="nopermissionfranchise" value="0" disabled <?= ($info['permissionfranchise']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="nopermissionfranchise"> No Access</label>
                      </div>
                      
                      </div>
                      
                
                      <?php
         if($permissionfranchise=='1'||$permissionfranchise=='2'||$row['permissionfranchise']=='1'||$row['permissionfranchise']=='2')
         {
        ?>
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionfranchise" id="permissionfranchiseview" value="1" disabled <?= (($info['permissionfranchise']=='1'))?'checked':''?>>
                        <label class="custom-control-label custom-label" for="permissionfranchiseview">View</label>
                      </div>
                      
                      
                      </div>
                      
                    <?php
         if($permissionfranchise=='2')
         {
        ?>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionfranchise" id="permissionfranchise" value="2" disabled <?= ($info['permissionfranchise']=='2')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="permissionfranchise">Full Access</label>
                      </div>
                      
                      </div>

                      <?php
                    }
                    ?>
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
         if($permissionuser!='0')
         {
        ?>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2"><?= $row['userandroles'];?> & Roles</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
             
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionuser" id="nopermissionuser" value="0" disabled <?= ($info['permissionuser']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="nopermissionuser">No Access</label>
                      </div>
                      
                      </div>
                      
                         <?php
         if($permissionuser=='2'||$permissionuser=='1'||$row['permissionuser']=='2'||$row['permissionuser']=='1')
         {
        ?>
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionuser" id="permissionuserview" value="1" disabled <?= (($info['permissionuser']=='1'))?'checked':''?>>
                        <label class="custom-control-label custom-label" for="permissionuserview">View</label>
                      </div>
                      
                      </div>
                     <?php
         }
        ?> 
                      <?php
         if($permissionuser=='2')
         {
        ?>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionuser" id="permissionuser" value="2" disabled <?= ($info['permissionuser']=='2')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="permissionuser">Full Access</label>
                      </div>
                      
                      </div>
                      <?php
         }
        ?>
                  </div>
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
            
          <?php
         if($permissionsidebooks!='0')
         {
        ?>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2"><?= $row['books'];?></label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionsidebooks" id="nopermissiondbook" value="0" onclick="booknotshows()" disabled <?= ($info['permissionsidebooks']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="nopermissiondbook">No Access</label>
                      </div>
                      
                      </div>
                       <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionsidebooks" id="permissiondbook" value="1" onclick="bookshows()" disabled <?= ($info['permissionsidebooks']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="permissiondbook">Access</label>
                      </div>
                      
                      </div>
                     
                  </div>
                  
            </div>
            </div>
             <?php
                    }
                    ?>
            <?php
            // if($permissionitems!='0'||$permissionsales!='0'||$permissionspurchases!='0'||$permissionbanking!='0'||$permissionsexpens!='0'||$permissionaccounting!='0'||$permissiontimetracking!='0'||$permissionewaybills!='0'||$permissiongstfilling!='0'||$permissionpayroll!='0'||$permissionattendence!='0'||$permissionsreport!='0')
         {
               ?>
          <?php
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if ((($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']!=0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']!=0))) {
?>
            <div id="showbooks">
            <div class="row" style=" border-top:0px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <div class="col-lg-12">
            <label class="custom-label mt-2" style="color:royalblue !important;"><span style="margin-left: 18px !important;"><?= $row['books'] ?></span></label>
            </div>
            </div>
            <?php
$sqlmain = mysqli_query($con,"select distinct grouptype,groupname,groupaccess from pairmainaccess where userid='$userid'");
while($sqlmainresult = mysqli_fetch_array($sqlmain)){
    $grouptype = preg_replace('/\s+/', '', $sqlmainresult['grouptype']);
    $maingrouptype=$sqlmainresult['grouptype'];
    if ($sqlmainresult['groupaccess']=='1') {
?>
<div class="row" style=" border-top:1px solid #eee; border-bottom:0px solid #eee;margin-left: 6px; padding:5px 0">
<div class="col-lg-2">
<label class="custom-label mt-2" style="color: royalblue !important;"><?=$sqlmainresult['groupname']?></label>
</div>
    <div class="col-lg-10">
            <div class="row">
<?php
$sqlismainaccessnew=mysqli_query($con, "select distinct modulename,grouptype,moduleaccess,moduletype,groupaccess,groupname,useraccesscreate,useraccessedit,useraccessview,useraccessdelete from pairmainaccess where userid='$id' and grouptype='$maingrouptype' ORDER BY ordering ASC");
while($infomainaccessnew=mysqli_fetch_array($sqlismainaccessnew)){
    $colgtype = preg_replace('/\s+/', '', $infomainaccessnew['grouptype']);
if ($infomainaccessnew['moduletype']=='') {
    ?>
    <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="fullaccess<?=strtolower($colgtype)?>()">
                        <input type="checkbox" class="custom-control-input useraccessfull<?=strtolower($colgtype)?>" name="useraccessfull<?=strtolower($colgtype)?>" id="useraccessfull<?=strtolower($colgtype)?>"  disabled <?= (($infomainaccessnew['useraccessview']=='1')&&($infomainaccessnew['useraccesscreate']=='1')&&($infomainaccessnew['useraccessedit']=='1')&&($infomainaccessnew['useraccessdelete']=='1'))?'checked':''?>>
                        <label class="custom-control-label custom-label" for="useraccessfull<?=strtolower($colgtype)?>" style="color: royalblue !important;"> Full access</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="fullviewaccess<?=strtolower($colgtype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($colgtype)?> useraccessview<?=strtolower($colgtype)?>" name="useraccessview<?=strtolower($colgtype)?>" id="useraccessview<?=strtolower($colgtype)?>" disabled <?= ($infomainaccessnew['useraccessview']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="useraccessview<?=strtolower($colgtype)?>"> View</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="viewaccess<?=strtolower($colgtype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($colgtype)?>" name="useraccesscreate<?=strtolower($colgtype)?>" id="useraccesscreate<?=strtolower($colgtype)?>" onclick="fullviewaccess<?=strtolower($colgtype)?>()" disabled <?= ($infomainaccessnew['useraccesscreate']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="useraccesscreate<?=strtolower($colgtype)?>"> Create</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="viewaccess<?=strtolower($colgtype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($colgtype)?>" name="useraccessedit<?=strtolower($colgtype)?>" id="useraccessedit<?=strtolower($colgtype)?>" onclick="fullviewaccess<?=strtolower($colgtype)?>()" disabled <?= ($infomainaccessnew['useraccessedit']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="useraccessedit<?=strtolower($colgtype)?>"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="viewaccess<?=strtolower($colgtype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($colgtype)?>" name="useraccessdelete<?=strtolower($colgtype)?>" id="useraccessdelete<?=strtolower($colgtype
                        )?>" onclick="fullviewaccess<?=strtolower($colgtype)?>()" disabled <?= ($infomainaccessnew['useraccessdelete']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label text-danger" for="useraccessdelete<?=strtolower($colgtype)?>"> Delete</label>
                      </div>
                      
                      </div>
                      <script type="text/javascript">
                function fullaccess<?=strtolower($colgtype)?>() {
        if($("#useraccessfull<?=strtolower($colgtype)?>").prop('checked')){
                    let one = document.getElementsByClassName("full<?=strtolower($colgtype)?>");
                    let onelen = one.length;
                    for (i=0;i<onelen;i++) {
                        one[i].checked = true;
                    }
                    }
  else{
        let one = document.getElementsByClassName("full<?=strtolower($colgtype)?>");
        onelen = one.length;
        for(i=0;i<onelen;i++){
        one[i].checked=false;
      }
  }
                }
                function viewaccess<?=strtolower($colgtype)?>() {
                    if ($("#useraccesscreate<?=strtolower($colgtype)?>").prop('checked')||$("#useraccessedit<?=strtolower($colgtype)?>").prop('checked')||$("#useraccessdelete<?=strtolower($colgtype)?>").prop('checked')) {
                    let view = document.getElementsByClassName("useraccessview<?=strtolower($colgtype)?>");
                    let viewlen = view.length;
                    for (i=0;i<viewlen;i++) {
                        view[i].checked = true;
                    }
                    }
                    else{
                    let view = document.getElementsByClassName("useraccessview<?=strtolower($colgtype)?>");
                    let viewlen = view.length;
                    for (i=0;i<viewlen;i++) {
                        view[i].checked = false;
                    }
                    }
                }
                function fullviewaccess<?=strtolower($colgtype)?>() {
                    if ($("#useraccesscreate<?=strtolower($colgtype)?>").prop('checked')&&$("#useraccessedit<?=strtolower($colgtype)?>").prop('checked')&&$("#useraccessdelete<?=strtolower($colgtype)?>").prop('checked')&&$("#useraccessview<?=strtolower($colgtype)?>").prop('checked')) {
                    let full = document.getElementsByClassName("useraccessfull<?=strtolower($colgtype)?>");
                    let fulllen = full.length;
                    for (i=0;i<fulllen;i++) {
                        full[i].checked = true;
                    }
                    }
                    else{
                    let full = document.getElementsByClassName("useraccessfull<?=strtolower($colgtype)?>");
                    let fulllen = full.length;
                    for (i=0;i<fulllen;i++) {
                        full[i].checked = false;
                    }
                    }
                }
            </script>
                      <?php
}
}
?>
</div>
</div>
</div>
<?php
$sqlismainaccess=mysqli_query($con, "select distinct modulename,moduleaccess,moduletype,groupaccess,groupname,useraccesscreate,useraccessedit,useraccessview,useraccessdelete from pairmainaccess where userid='$id' and (grouptype='$maingrouptype' and moduletype!='') ORDER BY ordering ASC");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and (grouptype='$maingrouptype' and moduletype='".$infomainaccess['moduletype']."') ORDER BY ordering ASC");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if(($infomainaccess['moduleaccess']==1)&&((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessview']==1||$infomainaccessuser['useraccesscreate']==1||$infomainaccessuser['useraccessedit']==1||$infomainaccessuser['useraccessdelete']==1)))) {
?>
            <div class="row" style=" border-top:0px solid #eee;padding:5px 0;margin-left: 6px;">
            <div class="col-lg-2">
                        <label class="custom-label"> <?= $infomainaccess['modulename']; ?></label>
                      </div>
            <div class="col-lg-10">
            <div class="row">
<input type="hidden" name="group<?=strtolower($coltype)?>" id="group<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupaccess'] ?>">
<input type="hidden" name="grouptype<?=strtolower($coltype)?>" id="grouptype<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupname'] ?>">
                <input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
                <input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
                      <div class="col-lg-2 my-1" <?=(((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&(($infomainaccessuser['useraccessview']==1)&&($infomainaccessuser['useraccesscreate']==1)&&($infomainaccessuser['useraccessedit']==1)&&($infomainaccessuser['useraccessdelete']==1))))?'':'style="display:none;"')?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="fullaccess<?=strtolower($coltype)?>()">
                        <input type="checkbox" class="custom-control-input useraccessfull<?=strtolower($coltype)?>" name="useraccessfull<?=strtolower($coltype)?>" id="useraccessfull<?=strtolower($coltype)?>" disabled <?= (($infomainaccess['useraccessview']=='1')&&($infomainaccess['useraccesscreate']=='1')&&($infomainaccess['useraccessedit']=='1')&&($infomainaccess['useraccessdelete']=='1'))?'checked':''?>>
                        <label class="custom-control-label custom-label" for="useraccessfull<?=strtolower($coltype)?>" style="color: royalblue !important;"> Full access</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?=(((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessview']==1)))?'':'style="display:none;"')?>>
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($coltype)?>" name="useraccessview<?=strtolower($coltype)?>" id="useraccessview<?=strtolower($coltype)?>"  disabled <?= ($infomainaccess['useraccessview']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="useraccessview<?=strtolower($coltype)?>"> View</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?=(((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccesscreate']==1)))?'':'style="display:none;"')?>>
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($coltype)?>" name="useraccesscreate<?=strtolower($coltype)?>" id="useraccesscreate<?=strtolower($coltype)?>"  disabled <?= ($infomainaccess['useraccesscreate']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="useraccesscreate<?=strtolower($coltype)?>"> Create</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?=(((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessedit']==1)))?'':'style="display:none;"')?>>
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($coltype)?>" name="useraccessedit<?=strtolower($coltype)?>" id="useraccessedit<?=strtolower($coltype)?>"  disabled <?= ($infomainaccess['useraccessedit']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="useraccessedit<?=strtolower($coltype)?>"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?=(((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessdelete']==1)))?'':'style="display:none;"')?>>
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($coltype)?>" name="useraccessdelete<?=strtolower($coltype)?>" id="useraccessdelete<?=strtolower($coltype
                        )?>"  disabled <?= ($infomainaccess['useraccessdelete']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label text-danger" for="useraccessdelete<?=strtolower($coltype)?>"> Delete</label>
                      </div>
                      
                      </div>

                  </div>
            </div>
            </div>
            <script type="text/javascript">
                function fullaccess<?=strtolower($coltype)?>() {
        if($("#useraccessfull<?=strtolower($coltype)?>").prop('checked')){
                    let one = document.getElementsByClassName("full<?=strtolower($coltype)?>");
                    let onelen = one.length;
                    for (i=0;i<onelen;i++) {
                        one[i].checked = true;
                    }
                    }
  else{
        let one = document.getElementsByClassName("full<?=strtolower($coltype)?>");
        onelen = one.length;
        for(i=0;i<onelen;i++){
        one[i].checked=false;
      }
  }
                }
                // $(document).ready(function() {
                //      let one = document.getElementsByClassName("full<?=strtolower($coltype)?>");
                //      onelen = one.length;
                //      for(i=0;i<onelen;i++){
                //      if(one[i].checked==false){
                //     let full = document.getElementsByClassName("useraccessfull<?=strtolower($coltype)?>");
                //     let fulllen = full.length;
                //     for (i=0;i<fulllen;i++) {
                //         full[i].checked = false;
                //     }
                //      }
                //     else{
                //     let full = document.getElementsByClassName("useraccessfull<?=strtolower($coltype)?>");
                //     let fulllen = full.length;
                //     for (i=0;i<fulllen;i++) {
                //         full[i].checked = true;
                //     }
                //      }
                //      }
                // });
            </script>
<?php
}
else{
?>
<input type="hidden" name="group<?=strtolower($coltype)?>" id="group<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupaccess'] ?>">
<input type="hidden" name="grouptype<?=strtolower($coltype)?>" id="grouptype<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupname'] ?>">
                <input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
                <input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
                        <input type="hidden" class="custom-control-input" name="useraccessfull<?=strtolower($coltype)?>" id="useraccessfull<?=strtolower($coltype)?>" value="0">
                        <input type="hidden" class="custom-control-input" name="useraccessview<?=strtolower($coltype)?>" id="useraccessview<?=strtolower($coltype)?>" value="0">
                        <input type="hidden" class="custom-control-input" name="useraccesscreate<?=strtolower($coltype)?>" id="useraccesscreate<?=strtolower($coltype)?>" value="0">
                        <input type="hidden" class="custom-control-input" name="useraccessedit<?=strtolower($coltype)?>" id="useraccessedit<?=strtolower($coltype)?>" value="0">
                        <input type="hidden" class="custom-control-input" name="useraccessdelete<?=strtolower($coltype)?>" id="useraccessdelete<?=strtolower($coltype)?>" value="0">
<?php
}
}
}
}
?>
<div class="row" style=" border-top:1px solid #eee; border-bottom:0px solid #eee; padding:5px 0"></div>
      </div>
         <?php
          // }
      }
          ?>
          <?php
          // }
      }
          ?>
          <?php
          // }
      }
          ?>
          <?php
         if($permissionpreference!='0'||$row['permissionpreference']!='0')
         {
        ?>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2">Preference</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
              
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionpreference" id="nopermissionpreference" value="0" disabled <?= ($info['permissionpreference']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="nopermissionpreference">No Access</label>
                      </div>
                      
                      </div>
                     
                      <?php
         if($permissionpreference=='1')
         {
        ?>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionpreference" id="permissionpreference" value="1" disabled <?= ($info['permissionpreference']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="permissionpreference">Full Access</label>
                      </div>
                      <script type="text/javascript">
                $(document).ready(function() {
                    let nofullpre = document.getElementById('permissionpreference');
                   if (nofullpre.checked == true) {
                    $('#showpre').show();
                   }
                   else{
                    $('#showpre').hide();
                   }
                });
            </script>
                      </div>
                      <?php
             }
             ?>
                  </div>
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
            <?php
            if($preferencefranchisepermission!=0||$permissionuserr!=0||$permissionbooks!=0){
            ?>
            <div class="row" style=" border-top:1.5px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <!-- <div class="col-lg-12">
            <label class="custom-label mr-sm-2" style="font-size: 14.6px;color:royalblue;margin-left:21px;">Preference Permissions</label>
            </div> -->
            <div class="col-lg-10">
                    
            <div class="row">
                      
                  </div>
                  
            </div>
            
            
            </div>
             <?php
         if($preferencefranchisepermission!='0')
         {
        ?>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;"><?= $row['franchiseandroles'];?> & Roles</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="preferencefranchisepermission" id="nopreferencefranchisepermission" value="0" disabled <?= ($info['preferencefranchisepermission']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="nopreferencefranchisepermission">No Access</label>
                      </div>
                      
                      </div>
                      
                       <?php
         if($preferencefranchisepermission=='1')
         {
        ?>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="preferencefranchisepermission" id="preferencefranchisepermission" value="1" disabled <?= ($info['preferencefranchisepermission']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="preferencefranchisepermission">Full Access</label>
                      </div>
                      
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                  
            </div>
            
            
            </div>
           
             <?php
                    }
                    ?>
                    <?php
         if($permissionuserr!='0')
         {
        ?>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;"><?= $row['userandroles'];?> & Roles</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
              
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionuserr" id="nopermissionuserr" value="0" disabled <?= ($info['permissionuserr']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="nopermissionuserr">No Access</label>
                      </div>
                      
                      </div>
                      
                      <?php
         if($permissionuserr=='1')
         {
        ?>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionuserr" id="permissionuserr" value="1" disabled <?= ($info['permissionuserr']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="permissionuserr">Full Access</label>
                      </div>
                      
                      </div>
                      <?php
                    }
                    ?>
                  </div>
                  
            </div>
            
            
            </div>
           
             <?php
                    }
                    ?>
                    <?php
         if($permissionbooks!='0')
         {
        ?>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;"><?= $row['books'];?></label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
              
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionbooks" id="nopermissionbooks" value="0" disabled <?= ($info['permissionbooks']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="nopermissionbooks">No Access</label>
                      </div>
                      
                      </div>
                      
                      <?php
         if($permissionbooks=='1')
         {
        ?>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionbooks" id="permissionbooks" value="1" disabled <?= ($info['permissionbooks']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="permissionbooks">Full Access</label>
                      </div>
                      
                      </div>
                      <?php
                    }
                    ?>
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
                    }
                    ?>
                    <?php
         if($permissionconfig!='0')
         {
        ?>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2">Configuration</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
               
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionconfig" id="nopermissionconfig" value="0" disabled <?= ($info['permissionconfig']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="nopermissionconfig">No Access</label>
                      </div>
                      
                      </div>
                      
                       <?php
         if($permissionconfig=='1')
         {
        ?>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionconfig" id="permissionconfig" value="1" disabled <?= ($info['permissionconfig']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="permissionconfig">Full Access</label>
                      </div>
                      <script type="text/javascript">
                $(document).ready(function() {
                    let nofullcon = document.getElementById('permissionconfig');
                   if (nofullcon.checked == true) {
                    $('#showcon').show();
                   }
                   else{
                    $('#showcon').hide();
                   }
                });
            </script>
                      </div>
                      <?php
                    }
                    ?>
                        
                  </div>
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
                    <?php
            if($language!=0||$time!=0||$currency!=0||$taxes!=0){
            ?>
              <div class="row" style=" border-top:1.5px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <!-- <div class="col-lg-12">
            <label class="custom-label mr-sm-2" style="font-size: 14.6px;color:royalblue;margin-left:21px;">Configuration Permissions</label>
            </div> -->
            <div class="col-lg-10">
                    
            <div class="row">
                      
                  </div>
                  
            </div>
            
            
            </div>
             <?php
         if($language!='0')
         {
        ?>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;">Language</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="language" id="nolanguage" value="0" disabled <?= ($info['language']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="nolanguage">No Access</label>
                      </div>
                      
                      </div>
                      
                      
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="language" id="language" value="1" disabled <?= ($info['language']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="language">Full Access</label>
                      </div>
                      
                      </div>
                      
                  </div>
                  
            </div>
            
            
            </div>
            <?php
                    }
                    ?>
             <?php
         if($time!='0')
         {
        ?>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;">Country & Time Zone</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="time" id="notime" value="0" disabled <?= ($info['time']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="notime">No Access</label>
                      </div>
                      
                      </div>
                      
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="time" id="time" value="1" disabled <?= ($info['time']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="time">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            
            
            </div>
            <?php
                    }
                    ?>
             <?php
         if($currency!='0')
         {
        ?>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;">Currency</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="currency" id="nocurrency" value="0" disabled <?= ($info['currency']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="nocurrency">No Access</label>
                      </div>
                      
                      </div>
                      
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="currency" id="currency" value="1" disabled <?= ($info['currency']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="currency">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            
            
            </div>
            <?php
                    }
                    ?>
            <?php
         if($taxes!='0')
         {
        ?>   
                  <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;">Taxes</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="taxes" id="notaxes" value="0" disabled <?= ($info['taxes']=='0')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="notaxes">No Access</label>
                      </div>
                      
                      </div>
                      
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="taxes" id="taxes" value="1" disabled <?= ($info['taxes']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="taxes">Full Access</label>
                      </div>
                      
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

       <div class="row" style=" border-top:1px solid #eee; border-bottom:3px solid #eee; padding:5px 0">
      <div class="col-lg-2">
        <?php
        $sql="select * from paircontrols where createdid='$companymainid'";
        $result=mysqli_query($con,$sql);
        $fra=mysqli_fetch_assoc($result);
        ?>
      <label class="custom-label" style="color: royalblue;font-size: 14.6px;"><?= $fra['franchiseandroles'] ?> Permissions</label>
      </div>
      <div class="col-lg-10">
      
      
      
      <div class="row">
        <?php
          $count=1;
          $franchise=$info['franchises'];
          $franchises=explode(',',$franchise);
          $sqliu=mysqli_query($con, "select * from pairfranchises where createdid='$companymainid' order by id desc");
          while($infou=mysqli_fetch_array($sqliu))
          {
            ?>
            <div class="col-lg-3 my-1">
            <div class="form-check mr-sm-2">
            <input type="checkbox" class="form-check-input check" name="franchises[]" id="franchises<?=$infou['id']?>" value="<?=$infou['id']?>" <?=(in_array($infou['id'],$franchises))?'checked':''?> disabled style="margin-top: 6px;margin-left: -18px;">
            <label class="custom-check-label custom-label" style="max-width:100%;" for="franchises<?=$infou['id']?>"> <?=$infou['franchisename']?></label>
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
</div>
    
    
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="table-responsive m-3">
    <table class="table table-bordered" style="table-layout: fixed;">
    <thead>
    <tr>
    <th style="border:1px solid #ddd !important;width: 190px;">DATE</th>
    <th style="border:1px solid #ddd !important;">DETAILS</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='USER' and useid='$id' order by createdon desc");
    while($infouse=mysqli_fetch_array($sqluse))
    {
        $fname=$infouse['fname'];
        $lname=$infouse['lastname'];
        $dob=$infouse['dob'];
        $design=$infouse['design'];
        $email=$infouse['email'];
        $uname=$infouse['username'];
        $mobile=$infouse['mobile'];
        $myaccount=$infouse['myaccountch'];
        $franchise=$infouse['permissionfranchisech'];
        $user=$infouse['permissionuserch'];
        if($myaccount==1){
           $ansmyaccount='Enabled';
          }
          elseif($myaccount==0){
           $ansmyaccount='Disabled';
          }
          else{
            $ansmyaccount='';
          }
          if($franchise==2){
           $ansfranchise='FULL ACCESS';
          }
          elseif ($franchise==1) {
            $ansfranchise='VIEW ACCESS';
          }
          elseif($franchise==0){
           $ansfranchise='NO ACCESS';
          }
          else{
            $ansfranchise='';
          }
          if($user=='2'){
           $ansuser='FULL ACCESS';
          }
          elseif ($user=='1') {
            $ansuser='VIEW ACCESS';
          }
          elseif($user=='0'){
           $ansuser='NO ACCESS';
          }
          else{
            $ansuser='';
          }
    ?>
    <tr>
      <td data-label="DATE" style="color:grey"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
      <td data-label="DETAILS"><?=$infouse['useremarks']?> <br> <span><?=(($infouse['useremarks']=='USER CREATED')?'Created By':'Changed By')?></span> <span  style="color:grey"><?=$info['createdby']?></span></td>
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
       source: 'usersearch.php?type=email',
     });
  });
</script>
 
</body>

</html>
<?php
}
else
{
	header("Location: users.php?error=No Information Found");
}
}
else
{
	header("Location: users.php?error=No Information Found");
}
?>