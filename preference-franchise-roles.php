<?php
include('lcheck.php');
if($permissionbooks=='0')
{
  header('Location: dashboard.php');
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
if (isset($_POST['submit'])) {
$pos = mysqli_real_escape_string($con,$_POST['pos']);
if ($pos!='') {
    $defaultplaceofsupply = mysqli_real_escape_string($con,$_POST['pos']);
}
else{
    $defaultplaceofsupply = mysqli_real_escape_string($con,$_POST['defaultplaceofsupply']);
}
$branchinfohead = mysqli_real_escape_string($con,(isset($_POST['branchinfohead']))?'1':'0');
$branchinfoadd = mysqli_real_escape_string($con,(isset($_POST['branchinfoadd']))?'1':'0');
$branchinfoedit = mysqli_real_escape_string($con,(isset($_POST['branchinfoedit']))?'1':'0');
$branchinfoview = mysqli_real_escape_string($con,(isset($_POST['branchinfoview']))?'1':'0');
$dlnotwohead = mysqli_real_escape_string($con,(isset($_POST['dlnotwohead']))?'1':'0');
$dlnotwoadd = mysqli_real_escape_string($con,(isset($_POST['dlnotwoadd']))?'1':'0');
$dlnotwoedit = mysqli_real_escape_string($con,(isset($_POST['dlnotwoedit']))?'1':'0');
$dlnotwoview = mysqli_real_escape_string($con,(isset($_POST['dlnotwoview']))?'1':'0');
$dlnotonehead = mysqli_real_escape_string($con,(isset($_POST['dlnotonehead']))?'1':'0');
$dlnotoneadd = mysqli_real_escape_string($con,(isset($_POST['dlnotoneadd']))?'1':'0');
$dlnotoneedit = mysqli_real_escape_string($con,(isset($_POST['dlnotoneedit']))?'1':'0');
$dlnotoneview = mysqli_real_escape_string($con,(isset($_POST['dlnotoneview']))?'1':'0');
$sqlup=mysqli_query($con,"update pairaccess set defaultplaceofsupply='$defaultplaceofsupply',branchinfohead='$branchinfohead',branchinfoadd='$branchinfoadd',branchinfoedit='$branchinfoedit',branchinfoview='$branchinfoview',dlnotwohead='$dlnotwohead',dlnotwoadd='$dlnotwoadd',dlnotwoedit='$dlnotwoedit',dlnotwoview='$dlnotwoview',dlnotonehead='$dlnotonehead',dlnotoneadd='$dlnotoneadd',dlnotoneedit='$dlnotoneedit',dlnotoneview='$dlnotoneview' where createdid='$companymainid'");
     header('Location:preference_franchisee_roles.php?remarks=Updated Successfully');
    $store=mysqli_real_escape_string($con,$_POST['storeaccess']);
    $sqlupstore=mysqli_query($con,"update paircontrols set storeaccess='$store' where username='".$_SESSION['unqwerty']."' or usernewname='".$_SESSION['unqwerty']."'");
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
      Preference &gt; <?= $row['franchiseandroles'] ?> & Roles &gt; <?= $row['franchiseandroles'] ?> Details
    </title>
        <style type="text/css">
        table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
  table {
    border: 0;
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
.table td, .table th {
    white-space: normal;
}
    </style>
    <style>
   

    [aria-expanded="false"]>.expanded,
    [aria-expanded="true"]>.collapsed {
        display: none;
    }

    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }
    </style>
    <style>
    /*.accordion-button:not(.collapsed)::after {
        background-image: url();
        margin-left: -20px;
        margin-top: -5px;
    }

    .accordion-button:not(.collapsed) a.customcont-heading {
        border-bottom: 1.5px solid #000000;
        color: #000000;
    }*/
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}

.alignright
{
    text-align: right;
}


    @media screen and (min-device-width: 260px) and (max-device-width: 575px) { 
    /* STYLES HERE */

    /* STYLES HERE */
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}
.alignright{
    text-align: center;
    
}
.mobliview
{
    text-align: center;
    
}




}
@media screen and (min-device-width: 366px) and (max-device-width: 575px) { 
.row1
{
    width: auto;
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
     <div class="alert alert-dismissible" style="position: relative;top: 32px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -32px;border-radius: 0px !important;">
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
      <div class="alert alert-dismissible" style="position: relative;top: 32px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -32px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
    <i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></p>
  </div>
     <?php
     }
     ?>
             <div class="card card-body p-3 mt-5" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;max-width: 1650px;height: auto;z-index: 0;">
                <form action="" method="post" style="position: relative;top: -27px;margin-bottom: -78px;">
    <p class="mb-3" style="font-size: 14.6px;color: black;position: relative;top: 15px;"><a href="preference.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Preference </a><span>&gt;</span><a href="preference_franchisee_roles.php" style="color: #1878F1"> <!-- <i class="fa fa-book"></i> -->
                                    <?= $row['franchiseandroles'] ?> & Roles</a> &gt; <!-- <i class="fa fa-shopping-basket"></i>  --><?= $row['franchiseandroles'] ?> Details</p>
                                    <div class="mt-3" style="border-top: 1px solid #dee2e6;position: relative;top: 0px;"></div>
                                    <p class="mb-0" style="font-size: 20px;color: black;position: relative;top: 12px;"><?= $row['franchiseandroles'] ?> Details</p>
    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="position: relative;top: 9px;">
<button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $row['franchiseandroles'] ?> & Roles 
</a>  
             
                </div></button>
 </div>
<div class="tab-content" id="nav-tabContent" style="position:relative;top: -36px;">
  <div class="tab-pane fade show active mt-4 p-3" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: 0px !important;">
                                        <div style="visibility: visible;" id="arrowsalldashboard">
<svg id="rightarrowprodashboard" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowprodashboard()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowprodashboard" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowprodashboard()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchdashboard() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#franchisedashboard').outerWidth()
            var scrollWidth = $('#franchisedashboard')[0].scrollWidth; 
            var scrollLeft = $('#franchisedashboard').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowprodashboard').style.visibility = 'hidden';
            document.getElementById('rightarrowprodashboard').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowprodashboard').style.visibility = 'hidden';
            document.getElementById('leftarrowprodashboard').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowprodashboard').style.visibility = 'visible';
            document.getElementById('rightarrowprodashboard').style.visibility = 'visible';
          }
            }
          }
          function leftarrowprodashboard() {
            document.getElementById('franchisedashboard').scrollLeft += -90;
            var width = $('#franchisedashboard').outerWidth()
            var scrollWidth = $('#franchisedashboard')[0].scrollWidth; 
            var scrollLeft = $('#franchisedashboard').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowprodashboard').style.visibility = 'hidden';
            document.getElementById('rightarrowprodashboard').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowprodashboard').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowprodashboard() {
            document.getElementById('franchisedashboard').scrollLeft += 90;
            var width = $('#franchisedashboard').outerWidth()
            var scrollWidth = $('#franchisedashboard')[0].scrollWidth; 
            var scrollLeft = $('#franchisedashboard').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowprodashboard').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowprodashboard').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #franchisedashboard::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#franchisedashboard::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#franchisedashboard::-webkit-scrollbar-track {
  background-color: green;
}

#franchisedashboard::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#franchisedashboard::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 580px){
  #arrowsalldashboard{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 300px) and (max-device-width: 379px){
#franchisedashboard .accordion-button::after{
  position: sticky !important;
  margin-left: 250px !important;
}
}
@media screen and (min-device-width: 380px) and (max-device-width: 404px){
#franchisedashboard .accordion-button::after{
  position: sticky !important;
  margin-left: 180px !important;
}
}
@media screen and (min-device-width: 405px) and (max-device-width: 499px){
#franchisedashboard .accordion-button::after{
  position: sticky !important;
  margin-left: 154px !important;
}
}
@media screen and (min-device-width: 500px) and (max-device-width: 530px){
#franchisedashboard .accordion-button::after{
  position: sticky !important;
  margin-left: 60px !important;
}
}
@media screen and (min-device-width: 531px) and (max-device-width: 580px){
#franchisedashboard .accordion-button::after{
  position: sticky !important;
  margin-left: 62px !important;
}
}
@media screen and (min-device-width: 581px) and (max-device-width: 3000px){
  #arrowsalldashboard{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 class="accordion-header scrollbar-2" ontouchmove="checkscrolltouchdashboard()" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;" id="franchisedashboard">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#franchisedashboards"
                                                    aria-expanded="true" aria-controls="franchisedashboards">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the things you would like to display in dashboard</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="franchisedashboards" class="accordion-collapse collapse show"
                                                aria-labelledby="franchisedashboard">
                                                <div class="accordion-body text-sm">
                                                    <div>
                      <div class="row" style=" border-top:2px solid #eee; border-bottom:2px solid #eee; padding:5px 0">
                      <div class="col-lg-3">
            <label class="custom-label" style="font-size: 14.6px;color:royalblue;"><?=$row['franchiseandroles']?> Store Permissions</label>
            </div>
            <div class="col-lg-9">
                <?php
           $sqlquery=mysqli_query($con,"select * from paircontrols where username='".$_SESSION['unqwerty']."' or usernewname='".$_SESSION['unqwerty']."'");
           $infoaccess=mysqli_fetch_array($sqlquery);
                ?>
            <div class="row">
                      <div class="col-lg-4 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="storeaccess" id="storenoaccess" value="0" <?= ($infoaccess['storeaccess']==0)?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="storenoaccess">No Access</label>
                      </div>
                      
                      </div>
                    <div class="col-lg-4 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="storeaccess" id="storeaccess" value="1" <?= ($infoaccess['storeaccess']==1)?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="storeaccess">Full Access</label>
                      </div>
                      
                      </div>
                    </div>
            </div>
            </div>
        </div>
                      </div>
                      </div>
                      </div>
    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: 0px !important;">
                                        <div style="visibility: visible;" id="arrowsallpro">
<svg id="rightarrowproacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowproacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowproacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowproacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchproacc() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#franchisedetailfield').outerWidth()
            var scrollWidth = $('#franchisedetailfield')[0].scrollWidth; 
            var scrollLeft = $('#franchisedetailfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproacc').style.visibility = 'hidden';
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowproacc').style.visibility = 'hidden';
            document.getElementById('leftarrowproacc').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowproacc').style.visibility = 'visible';
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
          }
            }
          }
          function leftarrowproacc() {
            document.getElementById('franchisedetailfield').scrollLeft += -90;
            var width = $('#franchisedetailfield').outerWidth()
            var scrollWidth = $('#franchisedetailfield')[0].scrollWidth; 
            var scrollLeft = $('#franchisedetailfield').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproacc').style.visibility = 'hidden';
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowproacc() {
            document.getElementById('franchisedetailfield').scrollLeft += 90;
            var width = $('#franchisedetailfield').outerWidth()
            var scrollWidth = $('#franchisedetailfield')[0].scrollWidth; 
            var scrollLeft = $('#franchisedetailfield').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowproacc').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowproacc').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #franchisedetailfield::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#franchisedetailfield::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#franchisedetailfield::-webkit-scrollbar-track {
  background-color: green;
}

#franchisedetailfield::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#franchisedetailfield::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallpro{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
#franchisedetailfield .accordion-button::after{
  position: sticky !important;
  margin-left: 188px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
#franchisedetailfield .accordion-button::after{
  position: sticky !important;
  margin-left: 152px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
#franchisedetailfield .accordion-button::after{
  position: sticky !important;
  margin-left: 130px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
#franchisedetailfield .accordion-button::after{
  position: sticky !important;
  margin-left: 52px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallpro{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 class="accordion-header scrollbar-2" ontouchmove="checkscrolltouchproacc()" id="franchisedetailfield" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#franchisedetailfields"
                                                    aria-expanded="true" aria-controls="franchisedetailfields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the defaults you would like to display</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="franchisedetailfields" class="accordion-collapse collapse show"
                                                aria-labelledby="franchisedetailfield">
                                                <div class="accordion-body text-sm">
<div class="row">
<div class="col-lg-3">
<label class="form-check-label text-danger" for="pos">Place Of Supply *</label>
</div>
<div class="col-lg-5">
<div class="row">
 <div class="col-lg-4 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="defaultplaceofsupply" id="autopos" value="auto" <?= $access['defaultplaceofsupply']=='auto'?'checked':'' ?> onclick="defposvalue()">
<label class="custom-control-label custom-label text-danger" for="autopos">Auto</label>
</div>
</div>
<div class="col-lg-4 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="defaultplaceofsupply" id="manualpos" value="manual" onclick="defposvalue()" <?= $access['defaultplaceofsupply']=='manual'?'checked':'' ?>>
<label class="custom-control-label custom-label" for="manualpos">Manual</label>
</div>
</div>
<div class="col-lg-4 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="defaultplaceofsupply" id="defaultpos" value="default" onclick="defposvalue()">
<label class="custom-control-label custom-label" for="defaultpos">Default</label>
</div>
</div>
</div>                 
</div>
<input type="hidden" id="hidchok" value="<?= $access['defaultplaceofsupply']?>">
<script type="text/javascript">
    $(document).ready(function () {
        var hidchok = document.getElementById('hidchok');
        if (hidchok.value=='auto') {
            document.getElementById("posfulldiv").style.display="none !important";
            $("#pos").removeAttr("required");
        }
        else if (hidchok.value=='manual') {
            document.getElementById("posfulldiv").style.display="none !important";
            $("#pos").removeAttr("required");
        }
        else if (hidchok.value!='manual'||'auto') {
            document.getElementById("posfulldiv").style.display="block";
            document.getElementById("defaultpos").checked=true;
            $("#pos").attr("required","required");
        }
    });
    function defposvalue() {
        var auto = document.getElementById('autopos');
        var manual = document.getElementById('manualpos');
        var defaults = document.getElementById('defaultpos');
        if (auto.checked==true) {
            document.getElementById("posfulldiv").style.display="none";
            var pos = document.getElementById("pos");
            var posans = pos.options[pos.selectedIndex].text;
            pos.value='';
            $("#pos").removeAttr("required");
        }
        else if (manual.checked==true) {
            document.getElementById("posfulldiv").style.display="none";
            var pos = document.getElementById("pos");
            var posans = pos.options[pos.selectedIndex].text;
            pos.value='';
            $("#pos").removeAttr("required");
        }
        else if (defaults.checked==true) {
            document.getElementById("posfulldiv").style.display="block";
            var pos = document.getElementById("pos");
            var posans = pos.options[pos.selectedIndex].text;
            if (posans=='Select The Place') {$("#pos").attr("required","required");}
        }
    }
</script>
<div class="col-lg-4" style="display: none;" id="posfulldiv">
<select name="pos" id="pos" class="select4 form-control form-control-sm">
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

</div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<div style="margin-top: 0px !important;">
<div style="visibility: visible;" id="arrowsallproenable">
<svg id="rightarrowproenable" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowproenable()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowproenable" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowproenable()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchproenable() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#franchisedetailfieldenable').outerWidth()
            var scrollWidth = $('#franchisedetailfieldenable')[0].scrollWidth; 
            var scrollLeft = $('#franchisedetailfieldenable').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproenable').style.visibility = 'hidden';
            document.getElementById('rightarrowproenable').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowproenable').style.visibility = 'hidden';
            document.getElementById('leftarrowproenable').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowproenable').style.visibility = 'visible';
            document.getElementById('rightarrowproenable').style.visibility = 'visible';
          }
            }
          }
          function leftarrowproenable() {
            document.getElementById('franchisedetailfieldenable').scrollLeft += -90;
            var width = $('#franchisedetailfieldenable').outerWidth()
            var scrollWidth = $('#franchisedetailfieldenable')[0].scrollWidth; 
            var scrollLeft = $('#franchisedetailfieldenable').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproenable').style.visibility = 'hidden';
            document.getElementById('rightarrowproenable').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowproenable').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowproenable() {
            document.getElementById('franchisedetailfieldenable').scrollLeft += 90;
            var width = $('#franchisedetailfieldenable').outerWidth()
            var scrollWidth = $('#franchisedetailfieldenable')[0].scrollWidth; 
            var scrollLeft = $('#franchisedetailfieldenable').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowproenable').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowproenable').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #franchisedetailfieldenable::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#franchisedetailfieldenable::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#franchisedetailfieldenable::-webkit-scrollbar-track {
  background-color: green;
}

#franchisedetailfieldenable::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#franchisedetailfieldenable::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallproenable{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 168px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 132px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 82px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 32px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallproenable{
    visibility: hidden !important;
    display: none !important;
  }
}
</style>
<h5 class="accordion-header scrollbar-2" ontouchmove="checkscrolltouchproenable()" id="franchisedetailfieldenable" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#franchisedetailfieldenables" aria-expanded="true" aria-controls="franchisedetailfieldenables">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
</div>
</button>
</h5>
<div id="franchisedetailfieldenables" class="accordion-collapse collapse show" aria-labelledby="franchisedetailfieldenable">
<div class="accordion-body text-sm">
<div class="row" style=" border-top:0px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
<div class="col-lg-2">
<div class="custom-control custom-checkbox mt-1" onclick="branchinfofun()">
<input type="checkbox" class="custom-control-input" name="branchinfohead" id="branchinfohead" <?=(($access['branchinfohead']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="branchinfohead" style="color: royalblue;"> <?=$row['franchiseandroles']?> Details</label>
</div>
</div>
<div class="col-lg-10">
<script>
function branchinfoevfun() {
let branchinfohead = document.getElementById('branchinfohead');
let branchinfoadd = document.getElementById('branchinfoadd');
let branchinfoedit = document.getElementById('branchinfoedit');
let branchinfoview = document.getElementById('branchinfoview');
if (branchinfoedit.checked == true||branchinfoview.checked == true||branchinfoadd.checked == true) {
branchinfohead.checked = true;
}
else{
branchinfohead.checked = false;
}
}
function branchinfofun() {
if($("#branchinfohead").prop('checked')){
let branchinfoadd = document.getElementById('branchinfoadd');
let branchinfoedit = document.getElementById('branchinfoedit');
let branchinfoview = document.getElementById('branchinfoview');
branchinfoadd.checked = true;
branchinfoedit.checked = true;
branchinfoview.checked = true;
let dlnotwohead = document.getElementById('dlnotwohead');
let dlnotwoadd = document.getElementById('dlnotwoadd');
let dlnotwoedit = document.getElementById('dlnotwoedit');
let dlnotwoview = document.getElementById('dlnotwoview');
dlnotwohead.checked = true;
dlnotwoadd.checked = true;
dlnotwoedit.checked = true;
dlnotwoview.checked = true;
let dlnotonehead = document.getElementById('dlnotonehead');
let dlnotoneadd = document.getElementById('dlnotoneadd');
let dlnotoneedit = document.getElementById('dlnotoneedit');
let dlnotoneview = document.getElementById('dlnotoneview');
dlnotonehead.checked = true;
dlnotoneadd.checked = true;
dlnotoneedit.checked = true;
dlnotoneview.checked = true;
}
else{
let branchinfoadd = document.getElementById('branchinfoadd');
let branchinfoedit = document.getElementById('branchinfoedit');
let branchinfoview = document.getElementById('branchinfoview');
branchinfoadd.checked = false;
branchinfoedit.checked = false;
branchinfoview.checked = false;
let dlnotwohead = document.getElementById('dlnotwohead');
let dlnotwoadd = document.getElementById('dlnotwoadd');
let dlnotwoedit = document.getElementById('dlnotwoedit');
let dlnotwoview = document.getElementById('dlnotwoview');
dlnotwohead.checked = false;
dlnotwoadd.checked = false;
dlnotwoedit.checked = false;
dlnotwoview.checked = false;
let dlnotonehead = document.getElementById('dlnotonehead');
let dlnotoneadd = document.getElementById('dlnotoneadd');
let dlnotoneedit = document.getElementById('dlnotoneedit');
let dlnotoneview = document.getElementById('dlnotoneview');
dlnotonehead.checked = false;
dlnotoneadd.checked = false;
dlnotoneedit.checked = false;
dlnotoneview.checked = false;
}
}
</script>
<div class="row">
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="branchinfoadd" id="branchinfoadd" onclick="branchinfoevfun()" <?=(($access['branchinfoadd']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="branchinfoadd"> Add</label>
</div>
</div>
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="branchinfoedit" id="branchinfoedit" onclick="branchinfoevfun()" <?=(($access['branchinfoedit']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="branchinfoedit"> Edit</label>
</div>
</div>
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="branchinfoview" id="branchinfoview" onclick="branchinfoevfun()" <?=(($access['branchinfoview']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="branchinfoview"> View</label>
</div>
</div>
</div>
</div>
</div>
<div class="row" style=" border-top:0px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
<div class="col-lg-2">
<div class="custom-control custom-checkbox mt-1" onclick="dlnotwofun()">
<input type="checkbox" class="custom-control-input" name="dlnotwohead" id="dlnotwohead" <?=(($access['dlnotwohead']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="dlnotwohead" style=""> DL No 20</label>
</div>
</div>
<div class="col-lg-10">
<script>
function dlnotwoevfun() {
let dlnotwohead = document.getElementById('dlnotwohead');
let dlnotwoadd = document.getElementById('dlnotwoadd');
let dlnotwoedit = document.getElementById('dlnotwoedit');
let dlnotwoview = document.getElementById('dlnotwoview');
if (dlnotwoedit.checked == true||dlnotwoview.checked == true||dlnotwoadd.checked == true) {
dlnotwohead.checked = true;
}
else{
dlnotwohead.checked = false;
}
}
function dlnotwofun() {
if($("#dlnotwohead").prop('checked')){
let dlnotwoadd = document.getElementById('dlnotwoadd');
let dlnotwoedit = document.getElementById('dlnotwoedit');
let dlnotwoview = document.getElementById('dlnotwoview');
dlnotwoadd.checked = true;
dlnotwoedit.checked = true;
dlnotwoview.checked = true;
}
else{
let dlnotwoadd = document.getElementById('dlnotwoadd');
let dlnotwoedit = document.getElementById('dlnotwoedit');
let dlnotwoview = document.getElementById('dlnotwoview');
dlnotwoadd.checked = false;
dlnotwoedit.checked = false;
dlnotwoview.checked = false;
}
}
</script>
<div class="row">
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="dlnotwoadd" id="dlnotwoadd" onclick="dlnotwoevfun()" <?=(($access['dlnotwoadd']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="dlnotwoadd"> Add</label>
</div>
</div>
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="dlnotwoedit" id="dlnotwoedit" onclick="dlnotwoevfun()" <?=(($access['dlnotwoedit']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="dlnotwoedit"> Edit</label>
</div>
</div>
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="dlnotwoview" id="dlnotwoview" onclick="dlnotwoevfun()" <?=(($access['dlnotwoview']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="dlnotwoview"> View</label>
</div>
</div>
</div>
</div>
</div>
<div class="row" style=" border-top:0px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
<div class="col-lg-2">
<div class="custom-control custom-checkbox mt-1" onclick="dlnotonefun()">
<input type="checkbox" class="custom-control-input" name="dlnotonehead" id="dlnotonehead" <?=(($access['dlnotonehead']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="dlnotonehead" style=""> DL No 21</label>
</div>
</div>
<div class="col-lg-10">
<script>
function dlnotoneevfun() {
let dlnotonehead = document.getElementById('dlnotonehead');
let dlnotoneadd = document.getElementById('dlnotoneadd');
let dlnotoneedit = document.getElementById('dlnotoneedit');
let dlnotoneview = document.getElementById('dlnotoneview');
if (dlnotoneedit.checked == true||dlnotoneview.checked == true||dlnotoneadd.checked == true) {
dlnotonehead.checked = true;
}
else{
dlnotonehead.checked = false;
}
}
function dlnotonefun() {
if($("#dlnotonehead").prop('checked')){
let dlnotoneadd = document.getElementById('dlnotoneadd');
let dlnotoneedit = document.getElementById('dlnotoneedit');
let dlnotoneview = document.getElementById('dlnotoneview');
dlnotoneadd.checked = true;
dlnotoneedit.checked = true;
dlnotoneview.checked = true;
}
else{
let dlnotoneadd = document.getElementById('dlnotoneadd');
let dlnotoneedit = document.getElementById('dlnotoneedit');
let dlnotoneview = document.getElementById('dlnotoneview');
dlnotoneadd.checked = false;
dlnotoneedit.checked = false;
dlnotoneview.checked = false;
}
}
</script>
<div class="row">
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="dlnotoneadd" id="dlnotoneadd" onclick="dlnotoneevfun()" <?=(($access['dlnotoneadd']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="dlnotoneadd"> Add</label>
</div>
</div>
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="dlnotoneedit" id="dlnotoneedit" onclick="dlnotoneevfun()" <?=(($access['dlnotoneedit']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="dlnotoneedit"> Edit</label>
</div>
</div>
<div class="col-lg-2 my-1">
<div class="custom-control custom-checkbox mr-sm-2">
<input type="checkbox" class="custom-control-input" name="dlnotoneview" id="dlnotoneview" onclick="dlnotoneevfun()" <?=(($access['dlnotoneview']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="dlnotoneview"> View</label>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

</div>
</div>
</div>

            <div class="row justify-content-center" style="margin-bottom: -14px;">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_franchisee_roles.php">Cancel</a>
    </div>
</div>
</div>
</div>
</form>
            <?php
	  include('footer.php');
	  ?>
        </div>

    </main>
    <?php
 include('fexternals.php');
 ?>
    <script type="text/javascript">
    $(function() {
        $("#invoicesuffix").autocomplete({
            source: 'invoicesuffixsearch.php',
            select: function(event, ui) {
                $("#invoicesuffix").val(ui.item.invoicesuffix);
                $("#city").val(ui.item.city);
                $("#district").val(ui.item.district);
                $("#state").val(ui.item.state);
                $("#pincode").val(ui.item.pincode);
            },
            minLength: 2
        });
        $("#email").autocomplete({
            source: 'franchisesearch.php?type=email',
        });
    });
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