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
    $passwordhead=mysqli_real_escape_string($con, (isset($_POST['passwordhead']))?'1':'0');
    $passwordedit=mysqli_real_escape_string($con, (isset($_POST['passwordedit']))?'1':'0');
    $passwordview=mysqli_real_escape_string($con, (isset($_POST['passwordview']))?'1':'0');
    $passwordhead=mysqli_real_escape_string($con, (isset($_POST['passwordhead']))?'1':'0');
    $dashboardnotification=mysqli_real_escape_string($con, (isset($_POST['dashboardnotification']))?'1':'0');

    $sqlup=mysqli_query($con,"update pairaccess set userdetailpassword='$passwordhead',userdetailpasswordedit='$passwordedit',userdetailpasswordview='$passwordview' where createdid='$companymainid'");

    $sqlupnotify=mysqli_query($con,"update pairaccess set dashboardnotification='$dashboardnotification' where createdid='$companymainid' and createdby='control'");
    // $permissionitems=mysqli_real_escape_string($con, (isset($_POST['items']))?'1':'0');
    // $permissionproducts=mysqli_real_escape_string($con, (isset($_POST['product']))?'1':'0');
     header('Location:preference_users_roles.php?remarks=Updated Successfully');
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
        Preference &gt; <?= $row['userandroles'] ?> & Roles &gt; <?= $row['userandroles'] ?> Details
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
    <p class="mb-3" style="font-size: 14.6px;color: black;position: relative;top: 15px;"><a href="preference.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Preference </a><span>&gt;</span><a href="preference_users_roles.php" style="color: #1878F1"> <!-- <i class="fa fa-book"></i> -->
                                    <?= $row['userandroles'] ?> & Roles</a> &gt; <!-- <i class="fa fa-shopping-basket"></i>  --><?= $row['userandroles'] ?> Details</p>
                                    <div class="mt-3" style="border-top: 1px solid #dee2e6;position: relative;top: 0px;"></div>
                                    <p class="mb-0" style="font-size: 20px;color: black;position: relative;top: 12px;"><?= $row['userandroles'] ?> Details</p>
    <div class="nav nav-tabs" id="nav-tab" role="tablist" style="position: relative;top: 9px;">
<button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $row['userandroles'] ?> & Roles 
</a>  
             
                </div></button>
 </div>
 <!-- <style type="text/css">
     .custom-control-label{
        color: red !important;
     }
 </style> -->
<div class="tab-content" id="nav-tabContent" style="position:relative;top: -36px;">
  <div class="tab-pane fade show active mt-4 p-3" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                      <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: 0px !important;">
                                        <div style="visibility: visible;" id="arrowsallpronot">
<svg id="rightarrowpronot" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowpronot()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowpronot" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowpronot()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchpronot() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#notificationdashboard').outerWidth()
            var scrollWidth = $('#notificationdashboard')[0].scrollWidth; 
            var scrollLeft = $('#notificationdashboard').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpronot').style.visibility = 'hidden';
            document.getElementById('rightarrowpronot').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowpronot').style.visibility = 'hidden';
            document.getElementById('leftarrowpronot').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowpronot').style.visibility = 'visible';
            document.getElementById('rightarrowpronot').style.visibility = 'visible';
          }
            }
          }
          function leftarrowpronot() {
            document.getElementById('notificationdashboard').scrollLeft += -90;
            var width = $('#notificationdashboard').outerWidth()
            var scrollWidth = $('#notificationdashboard')[0].scrollWidth; 
            var scrollLeft = $('#notificationdashboard').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowpronot').style.visibility = 'hidden';
            document.getElementById('rightarrowpronot').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowpronot').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowpronot() {
            document.getElementById('notificationdashboard').scrollLeft += 90;
            var width = $('#notificationdashboard').outerWidth()
            var scrollWidth = $('#notificationdashboard')[0].scrollWidth; 
            var scrollLeft = $('#notificationdashboard').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowpronot').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowpronot').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #notificationdashboard::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#notificationdashboard::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#notificationdashboard::-webkit-scrollbar-track {
  background-color: green;
}

#notificationdashboard::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#notificationdashboard::-webkit-scrollbar-button:horizontal:decrement {
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
  #arrowsallpronot{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 300px) and (max-device-width: 379px){
#notificationdashboard .accordion-button::after{
  position: sticky !important;
  margin-left: 250px !important;
}
}
@media screen and (min-device-width: 380px) and (max-device-width: 404px){
#notificationdashboard .accordion-button::after{
  position: sticky !important;
  margin-left: 180px !important;
}
}
@media screen and (min-device-width: 405px) and (max-device-width: 499px){
#notificationdashboard .accordion-button::after{
  position: sticky !important;
  margin-left: 154px !important;
}
}
@media screen and (min-device-width: 500px) and (max-device-width: 530px){
#notificationdashboard .accordion-button::after{
  position: sticky !important;
  margin-left: 60px !important;
}
}
@media screen and (min-device-width: 531px) and (max-device-width: 580px){
#notificationdashboard .accordion-button::after{
  position: sticky !important;
  margin-left: 62px !important;
}
}
@media screen and (min-device-width: 581px) and (max-device-width: 3000px){
  #arrowsallpronot{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 class="accordion-header scrollbar-2" ontouchmove="checkscrolltouchpronot()" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;" id="notificationdashboard">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#notificationdashboards"
                                                    aria-expanded="true" aria-controls="notificationdashboards">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the things you would like to display in dashboard</a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                            <div id="notificationdashboards" class="accordion-collapse collapse show"
                                                aria-labelledby="notificationdashboard">
                                                <div class="accordion-body text-sm">
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="dashboardnotification" id="dashboardnotification" <?= ($access['dashboardnotification']=='1')?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="dashboardnotification"> Notification</label>
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
            var width = $('#userdetailfield').outerWidth()
            var scrollWidth = $('#userdetailfield')[0].scrollWidth; 
            var scrollLeft = $('#userdetailfield').scrollLeft();
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
            document.getElementById('userdetailfield').scrollLeft += -90;
            var width = $('#userdetailfield').outerWidth()
            var scrollWidth = $('#userdetailfield')[0].scrollWidth; 
            var scrollLeft = $('#userdetailfield').scrollLeft();
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
            document.getElementById('userdetailfield').scrollLeft += 90;
            var width = $('#userdetailfield').outerWidth()
            var scrollWidth = $('#userdetailfield')[0].scrollWidth; 
            var scrollLeft = $('#userdetailfield').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowproacc').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowproacc').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #userdetailfield::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#userdetailfield::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#userdetailfield::-webkit-scrollbar-track {
  background-color: green;
}

#userdetailfield::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#userdetailfield::-webkit-scrollbar-button:horizontal:decrement {
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
  #arrowsallpro{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 class="accordion-header scrollbar-2" ontouchmove="checkscrolltouchproacc()" id="userdetailfield" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#userdetailfields"
                                                    aria-expanded="true" aria-controls="userdetailfields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                        </div>
                                            <div id="userdetailfields" class="accordion-collapse collapse show"
                                                aria-labelledby="userdetailfield">
                                                <div class="accordion-body text-sm">
            <div class="row" style=" border-top:0px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mt-1" onclick="passwordfun()">
                        <input type="checkbox" class="custom-control-input" name="passwordhead" id="passwordhead" <?=($access['userdetailpassword']==1)?'checked':'';?>>
                        <label class="custom-control-label custom-label" for="passwordhead" style="color: red !important;"> Password</label>
                      </div>
            <!-- <label class="custom-label mt-2"></label> -->
            </div>
            <div class="col-lg-10">
                    <script>
                      function passwordevfun() {
                        let passwordhead = document.getElementById('passwordhead');
                        let passwordedit = document.getElementById('passwordedit');
                        let passwordview = document.getElementById('passwordview');
                        if (passwordedit.checked == true||passwordview.checked == true) {
                          passwordhead.checked = true;
                        }
                        else{
                          passwordhead.checked = false;
                        }
                      }
      function passwordfun() {
        if($("#passwordhead").prop('checked')){
        let passwordedit = document.getElementById('passwordedit');
        let passwordview = document.getElementById('passwordview');
        passwordedit.checked = true;
        passwordview.checked = true;
      }
  else{
        let passwordedit = document.getElementById('passwordedit');
        let passwordview = document.getElementById('passwordview');
        passwordedit.checked = false;
        passwordview.checked = false
  }
}
    </script>
            <div class="row">

                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="passwordedit" id="passwordedit" onclick="passwordevfun()" <?=($access['userdetailpasswordedit']==1)?'checked':'';?>>
                        <label class="custom-control-label custom-label text-danger" for="passwordedit"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="passwordview" id="passwordview" onclick="passwordevfun()" <?=($access['userdetailpasswordview']==1)?'checked':'';?>>
                        <label class="custom-control-label custom-label text-danger" for="passwordview"> View</label>
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
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_users_roles.php">Cancel</a>
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