<?php
include('lcheck.php');
if($permissionbooks=='0')
{
  header('Location: dashboard.php');
}
$sqlismainaccessreports=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Reports' order by id  asc");
$infomainaccessreports=mysqli_fetch_array($sqlismainaccessreports);
if ($infomainaccessreports['groupaccess']=='0') {
header('Location: preference_billing.php');
}
$sql="SELECT * FROM paircontrols WHERE id='$companymainid';";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
if (isset($_POST['submit'])) {
 $sqlismoduleshis=mysqli_query($con, "select * from pairmodules where grouptype='Reports' order by id  asc");
$infomoduleshis=mysqli_fetch_array($sqlismoduleshis);
$sqlismainaccesshis=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Reports' order by id  asc");
while($infomainaccesshis=mysqli_fetch_array($sqlismainaccesshis)){
    $coltype = preg_replace('/\s+/', '', $infomainaccesshis['grouptype']);
    $colhis = $infomainaccesshis[24];
    $colhistory = explode(',',$colhis);
}
$sqlismodules=mysqli_query($con, "select * from pairmodules where grouptype='Reports' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['grouptype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  $ch = '';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod;
                $modcolumncol=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
                if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncol;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncol;
                }
                $modacchis=$coltypemod;
                $oldmodacc=((in_array($newmoduleskey, $colhistory))?'ENABLE':'DISABLE');
                $newmodacc=mysqli_real_escape_string($con, (isset($_POST[$modacchis]))?'ENABLE':'DISABLE');
                if ($oldmodacc=="ENABLE"&&$newmodacc=="DISABLE") {
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['grouptype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['grouptype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }     
                }
                else if ($oldmodacc=="DISABLE"&&$newmodacc=="ENABLE"){
                    if($ch!='')
                    {
                        $ch.='<br> '.$infomoduleshis['grouptype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$infomoduleshis['grouptype'].' '.$newmoduleskey.' <span style="color:green;" id="prohisfromtospan">( From '.$oldmodacc.' To '.$newmodacc.' ) </span>';
                    }        
                }     

              }    
                $sqlmainaccess = "update pairmainaccess set modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and grouptype='Reports'"; 
                $sqlmainaccessupreport = mysqli_query($con, $sqlmainaccess);
if($ch!='')
{
$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='Books', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$companymainid', useremarks='".$ch."'");
}
              header('Location:preference_billing.php?remarks=Updated Successfully');
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
      $sqlismainaccessreports=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Reports' order by id  asc");
      $infomainaccessreports=mysqli_fetch_array($sqlismainaccessreports);
?>
    <title>
        Preference &gt; <?= $row['books'] ?> &gt; <?= $infomainaccessreports['groupname'] ?>
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
   input[type="text"]:focus{
        border: 1px solid #3f94eb !important;
        outline: none;
        box-shadow: none !important;
        border-radius: 0px !important;
    }

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
        <?php
        $sqlismainaccessreports=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Reports' order by id  asc");
        ?>
             <div class="card card-body p-3 mt-5" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;max-width: 1650px;height: auto;z-index: 0;">
                <form action="" method="post" style="position: relative;top: -27px;margin-bottom: -78px;">
    <p class="mb-3" style="font-size: 14.6px;color: black;position: relative;top: 15px;"><a href="preference.php" style="color: #1878F1"> Preference </a><span>&gt;</span><a href="preference_billing.php" style="color: #1878F1"> 
                                    <?= $row['books'] ?> </a> &gt; <?= $infomainaccessreports['groupname'] ?></p>
                                    <div class="mt-3" style="border-top: 1px solid #dee2e6;position: relative;top: 0px;"></div>
                                    <p class="mb-0" style="font-size: 20px;color: black;position: relative;top: 12px;"><?= $infomainaccessreports['groupname'] ?></p>
                                      <div style="margin-top: -42px !important;">
                                        <div style="visibility: visible;" id="arrowsalltabs">
<svg id="rightarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 60px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 60px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouch() {
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrow').style.visibility = 'hidden';
            document.getElementById('leftarrow').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrow').style.visibility = 'visible';
            document.getElementById('rightarrow').style.visibility = 'visible';
          }
            }
          }
          function leftarrow() {
            document.getElementById('nav-tab').scrollLeft += -90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrow() {
            document.getElementById('nav-tab').scrollLeft += 90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrow').style.visibility = 'hidden';
            }
            document.getElementById('leftarrow').style.visibility = 'visible';
          }
        </script>
        <script type="text/javascript">   
$(document).ready(function() {
function isOverflown(element) {
return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
var el = document.getElementById("nav-tab");
isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
window.onresize = function (event) {
applyOrientation();
}         
function applyOrientation() {
function isOverflown(element) {
return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
var el = document.getElementById("nav-tab");
isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
}
});
</script>
        <style type="text/css">
        #nav-tab::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#nav-tab::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#nav-tab::-webkit-scrollbar-track {
  background-color: green;
}

#nav-tab::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#nav-tab::-webkit-scrollbar-button:horizontal:decrement {
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
.nav-tabs button{
    margin-bottom: 2px !important;
}
.nav-tabs .customcont-header{
    border-bottom: 0px !important;
}

@media screen and (max-width: 560px){
  #arrowsalltabs{
    visibility: visible !important;
  }
}
@media screen and (min-device-width: 561px) and (max-device-width: 3000px){
  #arrowsalltabs{
    visibility: hidden !important;
  }
}
      </style>
<div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="position: relative;top: 9px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
<button <?=(($infomainaccessreports['groupaccess']=='1')?'':'style="display:none"')?> class="nav-link <?=(($infomainaccessreports['groupaccess']=='1')?'active':'')?>" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true">
<div class="customcont-header ml-0">
  <a class="customcont-heading"><?= $infomainaccessreports['groupname'] ?></a>  
</div>
</button>
</div>
</div>
<div class="tab-content" id="nav-tabContent" style="position:relative;top: -18px;">
<div class="tab-pane fade show mt-4 p-3 <?=(($infomainaccessreports['groupaccess']=='1')?'active':'')?>" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" <?=(($infomainaccessreports['groupaccess']=='1')?'':'style="display:none"')?>>
        <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                          <div style="margin-top: -9px !important;">
                                        <div style="visibility: visible;" id="arrowsreportreport">
<svg id="rightarrowreportreport" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowreportreport()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowreportreport" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowreportreport()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchreportreport() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#reports').outerWidth()
            var scrollWidth = $('#reports')[0].scrollWidth; 
            var scrollLeft = $('#reports').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowreportreport').style.visibility = 'hidden';
            document.getElementById('rightarrowreportreport').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowreportreport').style.visibility = 'hidden';
            document.getElementById('leftarrowreportreport').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowreportreport').style.visibility = 'visible';
            document.getElementById('rightarrowreportreport').style.visibility = 'visible';
          }
            }
          }
          function leftarrowreportreport() {
            document.getElementById('reports').scrollLeft += -90;
            var width = $('#reports').outerWidth()
            var scrollWidth = $('#reports')[0].scrollWidth; 
            var scrollLeft = $('#reports').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowreportreport').style.visibility = 'hidden';
            document.getElementById('rightarrowreportreport').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowreportreport').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowreportreport() {
            document.getElementById('reports').scrollLeft += 90;
            var width = $('#reports').outerWidth()
            var scrollWidth = $('#reports')[0].scrollWidth; 
            var scrollLeft = $('#reports').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowreportreport').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowreportreport').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #reports::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#reports::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#reports::-webkit-scrollbar-track {
  background-color: green;
}

#reports::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#reports::-webkit-scrollbar-button:horizontal:decrement {
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
@media screen and (max-width: 543px){
  #arrowsreportreport{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 241px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 205px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 155px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 543px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 105px !important;
}
}
@media screen and (min-device-width: 544px) and (max-device-width: 3000px){
  #arrowsreportreport{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 class="accordion-header scrollbar-2" ontouchmove="checkscrolltouchreportreport()" id="reports" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#reportss"
                                                    aria-expanded="true" aria-controls="reportss">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the things you would like to show in <?=$infomainaccessreports['groupname']?></a>
                                                    </div>
                                                </button>
                                            </h5>
                                          </div>
                                          <div id="reportss" class="accordion-collapse collapse show" aria-labelledby="reports">
                                          <div class="accordion-body text-sm">
                                            <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Reports' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['grouptype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where grouptype='Reports' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['grouptype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
              if(($coltypemod=='BusinessOverview')) {
                  $fullaccessans = 'businessoverview';
                }
                else if (($coltypemod=='ReceivablesorWhoowesyou')) {
                  $fullaccessans = 'receivables';
                }
                else if (($coltypemod=='PayablesorWhatyouowe')) {
                  $fullaccessans = 'payables';
                }
                else if (($coltypemod=='Taxes')) {
                  $fullaccessans = 'taxes';
                }
                else if (($coltypemod=='CustomerBalance')) {
                  $fullaccessans = 'custbalance';
                }
                else if (($coltypemod=='SalesDetails')) {
                  $fullaccessans = 'sales';
                }
                else if (($coltypemod=='PurchaseDetails')) {
                  $fullaccessans = 'purchase';
                }
                else if (($coltypemod=='Accounts')) {
                  $fullaccessans = 'accounts';
                }
                else{
                  $fullaccessans = '';
                }
?>
           <div class="row" style=" border-top:1.5px solid #eee;border-bottom:1px solid #eee; padding:5px 0">
            <div class="col-lg-6">
                <div class="custom-control custom-checkbox mr-sm-2" onclick="<?= $coltypemod; ?><?= $fullaccessans; ?>()">
                        <input type="checkbox" class="custom-control-input <?= (($newmoduleskey=='Horizontal Balance Sheet')||($newmoduleskey=='Horizontal Profit and Loss')||($newmoduleskey=='Account Transactions')||($newmoduleskey=='Sale Price Rate'))?'businessoverviewchild':'' ?> <?= (($newmoduleskey=='Invoice List or Details')||($newmoduleskey=='Payments Received'))?'receivableschild':'' ?> <?= (($newmoduleskey=='Bills List or Details')||($newmoduleskey=='Payments Made'))?'payableschild':'' ?> <?= (($newmoduleskey=='Summary of Inward Supplies opparen GSTR hypens 2 closparen')||($newmoduleskey=='Summary of Outward Supplies opparen GSTR hypens 1 closparen')||($newmoduleskey=='Summary of Credit Note')||($newmoduleskey=='Summary of Debit Note'))?'taxeschild':'' ?> <?=(($newmoduleskey=='Balance'))?'custbalancechild':''?> <?=((($newmoduleskey=='Sales')||($newmoduleskey=='Product Customer Wise Sales')||($newmoduleskey=='Product Movement')||($newmoduleskey=='Sales Person')||($newmoduleskey=='Profit And Loss')||($newmoduleskey=='Stock And Sales Statement')||($newmoduleskey=='Stock And Sales Statement New'))?'saleschild':'')?> <?= (($newmoduleskey=='Stock in Hand with Value'))?'purchasechild':'' ?> <?= (($newmoduleskey=='Journal')||($newmoduleskey=='Accounts Transactions'))?'accountschild':'' ?> <?= (($newmoduleskey=='Timesheet Details'))?'timetrackingchild':'' ?>" name="<?= $coltypemod; ?>" id="<?= $coltypemod; ?><?=$fullaccessans?>" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?><?=$fullaccessans?>" style="font-size: 14.6px;color: <?= ((($newmoduleskey=='Receivables or Who owes you')||($newmoduleskey=='Payables or What you owe')||($newmoduleskey=='Taxes'))?'royalblue':'') ?> <?= ((($newmoduleskey=='Receivables or Who owes you')||($newmoduleskey=='Payables or What you owe')||($newmoduleskey=='Invoice List or Details')||($newmoduleskey=='Bills List or Details')||($newmoduleskey=='Summary of Inward Supplies opparen GSTR hypens 2 closparen')||($newmoduleskey=='Summary of Outward Supplies opparen GSTR hypens 1 closparen')||($newmoduleskey=='Taxes'))?'':'yellow') ?> !important;"> <?= str_replace(" or ", " / ",(str_replace("Rupee", $resmaincurrencyans,(str_replace("opparen", '(',(str_replace("closparen", ')',(str_replace("Percentage", '%',(str_replace(" hypens ", " - ",$newmoduleskey))))))))))); ?></label>
                        <!-- <?= (($newmoduleskey=='Business Overview')||($newmoduleskey=='Receivables or Who owes you')||($newmoduleskey=='Payables or What you owe')||($newmoduleskey=='Taxes')||($newmoduleskey=='Customer Balance')||($newmoduleskey=='Sales Details')||($newmoduleskey=='Accounts'))?'royalblue':'' ?> -->
                      </div>
            </div>
            <div class="col-lg-6"></div>
            </div>
            <script type="text/javascript">
              function BusinessOverviewbusinessoverview() {
                let headerinfo = document.getElementsByClassName("businessoverviewchild");
                if ($("#BusinessOverviewbusinessoverview").prop("checked")) {
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=true;
                headerinfo[i].disabled=false;
                }
                }
                else{
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=false;
                headerinfo[i].disabled=true;
                }
                }
              }
              function ReceivablesorWhoowesyoureceivables() {
                let headerinfo = document.getElementsByClassName("receivableschild");
                if ($("#ReceivablesorWhoowesyoureceivables").prop("checked")) {
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=true;
                headerinfo[i].disabled=false;
                }
                }
                else{
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=false;
                headerinfo[i].disabled=true;
                }
                }
              }
              function PayablesorWhatyouowepayables() {
                let headerinfo = document.getElementsByClassName("payableschild");
                if ($("#PayablesorWhatyouowepayables").prop("checked")) {
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=true;
                headerinfo[i].disabled=false;
                }
                }
                else{
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=false;
                headerinfo[i].disabled=true;
                }
                }
              }
              function Taxestaxes() {
                let headerinfo = document.getElementsByClassName("taxeschild");
                if ($("#Taxestaxes").prop("checked")) {
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=true;
                headerinfo[i].disabled=false;
                }
                }
                else{
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=false;
                headerinfo[i].disabled=true;
                }
                }
              }
              function CustomerBalancecustbalance() {
                let headerinfo = document.getElementsByClassName("custbalancechild");
                if ($("#CustomerBalancecustbalance").prop("checked")) {
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=true;
                headerinfo[i].disabled=false;
                }
                }
                else{
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=false;
                headerinfo[i].disabled=true;
                }
                }
              }
              function SalesDetailssales() {
                let headerinfo = document.getElementsByClassName("saleschild");
                if ($("#SalesDetailssales").prop("checked")) {
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=true;
                headerinfo[i].disabled=false;
                }
                }
                else{
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=false;
                headerinfo[i].disabled=true;
                }
                }
              }
              function PurchaseDetailspurchase() {
                let headerinfo = document.getElementsByClassName("purchasechild");
                if ($("#PurchaseDetailspurchase").prop("checked")) {
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=true;
                headerinfo[i].disabled=false;
                }
                }
                else{
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=false;
                headerinfo[i].disabled=true;
                }
                }
              }
              function Accountsaccounts() {
                let headerinfo = document.getElementsByClassName("accountschild");
                if ($("#Accountsaccounts").prop("checked")) {
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=true;
                headerinfo[i].disabled=false;
                }
                }
                else{
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=false;
                headerinfo[i].disabled=true;
                }
                }
              }
              function TimeTracking() {
                let headerinfo = document.getElementsByClassName("timetrackingchild");
                if ($("#TimeTracking").prop("checked")) {
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=true;
                headerinfo[i].disabled=false;
                }
                }
                else{
                for (i=0;i<headerinfo.length;i++) {
                headerinfo[i].checked=false;
                headerinfo[i].disabled=true;
                }
                }
              }
function <?= $coltypemod; ?><?= $fullaccessans; ?>() {
let businessoverviewchild = document.getElementsByClassName("businessoverviewchild");
let businessoverviewchildchnumof = businessoverviewchild.length;
for (i=0;i<businessoverviewchild.length;i++) {
if (businessoverviewchild[i].checked) {
businessoverviewchildchnumof+=1;
}
else{
businessoverviewchildchnumof-=1;
}
}
if (businessoverviewchildchnumof==0) {
document.getElementById("BusinessOverviewbusinessoverview").checked=false;
}
else{
document.getElementById("BusinessOverviewbusinessoverview").checked=true;
}
let receivableschild = document.getElementsByClassName("receivableschild");
let receivableschildchnumof = receivableschild.length;
for (i=0;i<receivableschild.length;i++) {
if (receivableschild[i].checked) {
receivableschildchnumof+=1;
}
else{
receivableschildchnumof-=1;
}
}
if (receivableschildchnumof==0) {
document.getElementById("ReceivablesorWhoowesyoureceivables").checked=false;
}
else{
document.getElementById("ReceivablesorWhoowesyoureceivables").checked=true;
}
let payableschild = document.getElementsByClassName("payableschild");
let payableschildchnumof = payableschild.length;
for (i=0;i<payableschild.length;i++) {
if (payableschild[i].checked) {
payableschildchnumof+=1;
}
else{
payableschildchnumof-=1;
}
}
if (payableschildchnumof==0) {
document.getElementById("PayablesorWhatyouowepayables").checked=false;
}
else{
document.getElementById("PayablesorWhatyouowepayables").checked=true;
}
let taxeschild = document.getElementsByClassName("taxeschild");
let taxeschildchnumof = taxeschild.length;
for (i=0;i<taxeschild.length;i++) {
if (taxeschild[i].checked) {
taxeschildchnumof+=1;
}
else{
taxeschildchnumof-=1;
}
}
if (taxeschildchnumof==0) {
document.getElementById("Taxestaxes").checked=false;
}
else{
document.getElementById("Taxestaxes").checked=true;
}
let custbalancechild = document.getElementsByClassName("custbalancechild");
let custbalancechildchnumof = custbalancechild.length;
for (i=0;i<custbalancechild.length;i++) {
if (custbalancechild[i].checked) {
custbalancechildchnumof+=1;
}
else{
custbalancechildchnumof-=1;
}
}
if (custbalancechildchnumof==0) {
document.getElementById("CustomerBalancecustbalance").checked=false;
}
else{
document.getElementById("CustomerBalancecustbalance").checked=true;
}
let saleschild = document.getElementsByClassName("saleschild");
let saleschildchnumof = saleschild.length;
for (i=0;i<saleschild.length;i++) {
if (saleschild[i].checked) {
saleschildchnumof+=1;
}
else{
saleschildchnumof-=1;
}
}
if (saleschildchnumof==0) {
document.getElementById("SalesDetailssales").checked=false;
}
else{
document.getElementById("SalesDetailssales").checked=true;
}
let accountschild = document.getElementsByClassName("accountschild");
let accountschildchnumof = accountschild.length;
for (i=0;i<accountschild.length;i++) {
if (accountschild[i].checked) {
accountschildchnumof+=1;
}
else{
accountschildchnumof-=1;
}
}
if (accountschildchnumof==0) {
document.getElementById("Accountsaccounts").checked=false;
}
else{
document.getElementById("Accountsaccounts").checked=true;
}
let timetrackingchild = document.getElementsByClassName("timetrackingchild");
let timetrackingchildchnumof = timetrackingchild.length;
for (i=0;i<timetrackingchild.length;i++) {
if (timetrackingchild[i].checked) {
timetrackingchildchnumof+=1;
}
else{
timetrackingchildchnumof-=1;
}
}
if (timetrackingchildchnumof==0) {
document.getElementById("TimeTracking").checked=false;
}
else{
document.getElementById("TimeTracking").checked=true;
}
}
            </script>
            <?php
          }
          ?>
          <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit" id="submittableview" value="Submit" style="margin-bottom: 15px;">
            <span class="label">Save</span> <span class="spinner"></span>
        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
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