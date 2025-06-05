<?php
include('lcheck.php');
 if((isset($_GET['proformano']))&&(isset($_GET['proformadate'])))
 {
     $proformano=mysqli_real_escape_string($con, $_GET['proformano']);
     $proformadate=mysqli_real_escape_string($con, $_GET['proformadate']);
 $sql=mysqli_query($con, "select * from pairproformas where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and proformano='$proformano' and proformadate='$proformadate' order by id asc");
if(mysqli_num_rows($sql)>0)
{
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Proforma Invoices' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Proforma Invoices' order by id  asc");
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

$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <link rel="shortcut icon" href="favicon.ico"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
<?php
include('externals.php');
?>
 <style type="text/css">
     table td{
        white-space: normal !important;
     }
     input:focus{
        outline: none !important;
        box-shadow: none !important;
        border: none !important;
     }
 </style>







  <title>
<?= $infomainaccessuser['modulename'] ?> Details
  </title>
</head>
<body class="g-sidenav-show" style="background-color:#F1F2F6">
<?php
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
if (($access['proformaprintexpdate']=='0')&&($access['proformaprintexpmonth']=='0')&&($access['proformaprintexpyear']=='0')) {
$dateforexp = '';
$widthforexp = '5%';
}
if (($access['proformaprintexpdate']=='1')&&($access['proformaprintexpmonth']=='1')&&($access['proformaprintexpyear']=='1')) {
$dateforexp = 'd/m/Y';
$widthforexp = '10%';
}
if (($access['proformaprintexpdate']=='0')&&($access['proformaprintexpmonth']=='1')&&($access['proformaprintexpyear']=='1')) {
$dateforexp = 'm/Y';
$widthforexp = '7%';
}
if (($access['proformaprintexpdate']=='1')&&($access['proformaprintexpmonth']=='0')&&($access['proformaprintexpyear']=='1')) {
$dateforexp = 'd/Y';
$widthforexp = '7%';
}
if (($access['proformaprintexpdate']=='1')&&($access['proformaprintexpmonth']=='1')&&($access['proformaprintexpyear']=='0')) {
$dateforexp = 'd/m';
$widthforexp = '7%';
}
if (($access['proformaprintexpdate']=='1')&&($access['proformaprintexpmonth']=='0')&&($access['proformaprintexpyear']=='0')) {
$dateforexp = 'd';
$widthforexp = '5%';
}
if (($access['proformaprintexpdate']=='0')&&($access['proformaprintexpmonth']=='1')&&($access['proformaprintexpyear']=='0')) {
$dateforexp = 'm';
$widthforexp = '5%';
}
if (($access['proformaprintexpdate']=='0')&&($access['proformaprintexpmonth']=='0')&&($access['proformaprintexpyear']=='1')) {
$dateforexp = 'Y';
$widthforexp = '5%';
}
}
?>
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Proforma Invoices' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
     ?>
 <?php
 if((isset($_GET['proformano']))&&(isset($_GET['proformadate'])))
 {
     $proformano=mysqli_real_escape_string($con, $_GET['proformano']);
     $proformadate=mysqli_real_escape_string($con, $_GET['proformadate']);
 $sql=mysqli_query($con, "select * from pairproformas where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and proformano='$proformano' and proformadate='$proformadate' order by id asc");
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
?> 
   <div style="max-width: 1650px;">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<div class="row">
<div class="col-lg-6">
<p style="font-size: 20px;margin-bottom: 0px !important;"><i class="fa fa-eye"></i> <?= $infomainaccessuser['modulename'] ?> Details</p>
 </div>
 <div class="col-lg-6">
 <span style="float:right">
     <!-- data-bs-toggle="modal" data-bs-target="#exampleModal" -->
    <a style="margin:4.5px 4.5px !important;" class="btn btn-primary btn-sm btn-custom-grey" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="converHTMLFileToPDF()"><i class="fa fa-print" aria-hidden="true"></i> <span class="mobreswords "> Print</span></a>
<a style="margin:4.5px 4.5px !important;" class="btn btn-primary btn-sm btn-custom-grey" onclick="downloadpdf()"><i class="fa fa-download" aria-hidden="true"></i> <span class="mobreswords "> Download</span></a>
          <a style="margin:4.5px 4.5px !important;" class="btn btn-primary btn-sm btn-custom-grey" href="salespaymentadd.php?no=<?=$proformano?>&date=<?=$proformadate?>&type=proforma" id="recordpaymentlink"><span style="font-weight: 700;"><?php echo $rescurrency[0]; ?></span> <span class="mobreswords " id="recordpaymentspan"> Record Payment</span></a>
          <?php
$sql = "select * from paircontrols where username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."'";  
$result = mysqli_query($con, $sql);
$rowsqt = mysqli_fetch_array($result);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Proforma Invoices' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccessedit']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
?>
<a class="btn btn-primary btn-sm btn-custom-grey" href="proformaedit.php?proformano=<?=$proformano?>&proformadate=<?=$proformadate?>" style="margin:4.5px 4.5px !important;"><i class="fa fa-pencil-alt"></i> <span class="mobreswords"> Edit</span></a>
 <?php 
}
?>
<a href="javascript:;" class="btn btn-primary btn-sm btn-custom-grey" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="margin:4.5px 4.5px !important;padding-bottom: 3px !important;" onclick="more()">
                <script type="text/javascript">
                    function more() {
                       document.getElementById("more").style.animation = "setone 2s 3000000";
                    }                   
                </script>
                <i class="fa fa-ellipsis-h" style="color:black !important;font-size: 18px !important;"></i>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end customdropdown me-sm-n4 mt-1" aria-labelledby="dropdownMenuButton">   
              <div style="background-color: #3c3c46;margin-top: 0px !important;cursor: pointer;"> 
              <i class="fa fa-caret-down" id="more" style="color: #3c3c46 !important;position: relative;top: -12px;left: 130px;"></i>   
               <li class="nav-item" style="margin-top:-22px !important;">
                  <a class="nav-link" href="proformacancel.php?proformano=<?=$proformano?>&proformadate=<?=$proformadate?>&cancelstatus=<?=($rows[0]['cancelstatus']=='0')?'1':'0'?>" onclick="return confirm('Are you sure want to <?=($rows[0]['cancelstatus']=='0')?'Cancel':'Enable'?> this Proforma Invoice?')">
                    <span class="nav-link-text ms-2"> Void</span>
                  </a>
                </li>  
          </div>
          </ul>
  </span>
  </div>
  </div>
  
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">Overview</a>  
             
                </div></button>
                <!-- <button class="nav-link" id="nav-transactions-tab" data-bs-toggle="tab" data-bs-target="#nav-transactions" type="button" role="tab" aria-controls="nav-transactions" aria-selected="false"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">Transactions</a>  
             
                </div></button> -->
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
        <div class="customcont-header ml-0">
    
        <a class="customcont-heading">History</a>   
             
                </div>
        
        </button>
        
  </div>
  
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="table-responsive m-3" id="histables">
      <table class="table table-bordered">
      <thead>
      <tr>
      <th style="border:1px solid #ddd !important;color: grey !important;font-weight: 600 !important;">DATE</th>
      <th style="border:1px solid #ddd !important;color: grey !important;font-weight: 600 !important;">DETAILS</th>
      </tr>
      </thead>
      <tbody>
        <?php
      $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='PROFORMAS' and useid='$proformano' order by createdon desc");
      while($infouse=mysqli_fetch_array($sqluse))
      {
      ?>
        <tr>
          <td data-label="DATE" id="datehis"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
          <td data-label="DETAILS"><?=$infouse['useremarks']?> <br><span>Changed By</span><span  id="chhis"> <?=$infouse['createdby']?></span></td>
        </tr>
      <?php
      }
      ?>
      </tbody>
      </table>
      </div>
    </div>
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<?php
$sqlismainaccessuser=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix,proformaprintgsttreatment,proformaprintgstin,modulename,proformaprintpos from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Proforma Invoices' order by id  asc");
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



<div class="container mt-1 mb-3">
    <div class="text-center">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="converHTMLFileToPDF()" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px; display:none"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-print" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Print</span></p></a><br>
        
        
     

<!-- Modal -->
<!-- Print Pdf Modal Download Start -->
<div class="modal fade" id="exampleModaldownload" tabindex="-1" role="dialog" aria-labelledby="downloadexampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="downloadexampleModalLabel" style="font-weight: normal;">Download</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" id="pdfObjdownload">
<img src="loading.gif" alt="Loading..." id="loadimgobj" style="width:100px">
</div>
<div class="modal-footer" style="margin-top: 33px !important;">
<a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>    
</div>
</div>
</div>
</div>
<!-- Print Pdf Modal Download End -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="pdfObj">
      </div>
      <div class="modal-footer" style="margin-top: 33px !important;">
          <a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>
          
      </div>
    </div>
  </div>
</div>
      
      
      
      
      
        
        </div>
        <div>
    <div class="row d-flex justify-content-center">
        <div class="col-lg-8 col-md-12 justify-content-center">
        
    
        
        
            <div class="card" id="zoomforprint"  style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding:10px; width:max-content;height: max-content;padding-bottom: 0px !important;" align="center">
            <?php
            $paidamount=0;
                $currentbalance=0;
                $currentamount=(float)$rows[0]['proformaamount'];
                $sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$proformano."' and invoicedate='".$proformadate."' order by id desc");
                while($infosalespay=mysqli_fetch_array($sqlsalespay))
                {
                    $paidamount+=(float)$infosalespay['amount'];
                }
                $currentbalance=((float)$rows[0]['proformaamount']-$paidamount);
            if($currentbalance==0)
            {
                ?>
                 <div class="ribbon-wrapper"><div class="ribbon">PAID</div></div>  
                 <script>
                 document.getElementById("recordpaymentlink").removeAttribute("href");
                 document.getElementById("recordpaymentspan").innerHTML="FULLY PAID";
                 </script>
                <?php
            }
            else
            {
                if($currentbalance==$currentamount)
                {
                    ?>
                    <style>
                    .ribbon {
                     background-color: #eb4034;
                     color: #fff !important;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">UN PAID</div></div>  
                <?php
                }
                else
                {
                    ?>
                    <style>
                    .ribbon {
                     background-color: #fcba03;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">PARTIALLY PAID</div></div>  
                <?php
                }
            }
            if($rows[0]['cancelstatus']=="1")
            {
                ?>
                <style>
                    .ribbon {
                     background-color: #b5b5b5;
                    }
                    </style>
                 <div class="ribbon-wrapper"><div class="ribbon">VOID</div></div>  
                <?php
            }
            ?>
<?php
if($info['proformatemplate']=='1')
{
    ?>
<div id="printalble">
<div class="table-responsive" style="width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;">
<table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 24.13cm !important;height: 15.75cm !important;max-width:24.13cm !important; max-height:15.75cm !important;min-width:24.13cm !important; min-height:15.75cm !important;">

<tr style="height:10px !important;">
<td style="border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td style="text-align:center;line-height: 15px !important;">
<b style="font-size:15px !important;display: inline-flex;white-space: nowrap;width: max-content;overflow: hidden;text-align: center;max-width: 166px;"><?= $infomainaccessuser['modulename'] ?></b>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:10px !important;">
<td style="">
<table width="100%">
<tr>
<td style="text-align:center;height: 80px !important;">
<table width="100%">
<tr>
<td width="15%" style="text-align:right;">
<?php
if($info['branchimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Branch Pic" src="<?=str_replace('../ups','ups',$img)?>" id="branch-image1" height="80" width="80">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>
    <?php
}
?>
</td>
<td width="51.5%" style="text-align:left;vertical-align: top;padding-left: 10px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<tr style="padding:0px !important;">
<td style="">
<table width="100%" style="padding:0px !important;">
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;"><?=$info['franchisename']?></strong>
</td>
</tr>
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;margin-bottom: -3px;">
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;"><?=$info['street']?> <?=$info['city']?> <?=$info['pincode']?> <?=$info['state']?> <?=$info['country']?> </span>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td style="">
<table width="100%">
<tr style="<?=($access['proformabranchphone']=='0')?'display:none;':''?>">
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">Phone </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">: <span style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$info['mobile']?></span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;<?=($access['proformabranchemail']=='0')?'visibility:hidden;':''?>">E-mail </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><input type="text" readonly value=": <?=$info['email']?>" style="padding:0px;color:black;width: 206px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;<?=($access['proformabranchemail']=='0')?'visibility:hidden;':''?>" class="form-control form-control-sm"><span style="<?=(($access['proformaprintdlno20']=='1')?'display:inline-flex;':'display:none;')?>white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 20 &nbsp; : <?=$info['dlno20']?></span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;<?=($access['proformabranchgstin']=='0')?'visibility:hidden;':''?>">GSTIN </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><span style="display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;<?=($access['proformabranchgstin']=='0')?'visibility:hidden;':''?>">: <?=$info['gstno']?></span><span style="<?=(($access['proformaprintdlno21']=='1')?'display:inline-flex;':'display:none;')?>white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 21 &nbsp; : <?=$info['dlno21']?></span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="34.5%">
<table width="100%">
<tr <?=(($access['proformabank']=='1')?'':'style="display:none;"')?>>
<td style="padding: 0px 6px !important;font-size: 11px !important;line-height: 15px !important;text-align: left;" width="35%"><input type="text" readonly value="Bank" style="padding:0px;color:black;width: 100px !important;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 11px;" class="form-control form-control-sm"></td>
<td style="padding: 0px !important;font-size: 11px !important;line-height: 15px !important;text-align: left !important;white-space: nowrap !important;overflow: hidden !important;" width="65%">: <b style="display:inline-flex;max-width: 163px !important;overflow: hidden;"><?=$info['bank']?></b></td>
</tr>
<tr <?=(($access['proformaname']=='1')?'':'style="display:none;"')?>>
<td style="padding: 0px 6px !important;font-size: 11px !important;line-height: 15px !important;text-align: left;" width="35%"><input type="text" readonly value="Name" style="padding:0px;color:black;width: 100px !important;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 11px;" class="form-control form-control-sm"></td>
<td style="padding: 0px !important;font-size: 11px !important;line-height: 15px !important;text-align: left !important;white-space: nowrap !important;overflow: hidden !important;" width="65%">: <b style="display:inline-flex;max-width: 163px !important;overflow: hidden;"><?=$info['names']?></b></td>
</tr>
<tr <?=(($access['proformaaccnumber']=='1')?'':'style="display:none;"')?>>
<td style="padding: 0px 6px !important;font-size: 11px !important;line-height: 15px !important;text-align: left;" width="35%"><input type="text" readonly value="Account Number" style="padding:0px;color:black;width: 100px !important;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 11px;" class="form-control form-control-sm"></td>
<td style="padding: 0px !important;font-size: 11px !important;line-height: 15px !important;text-align: left !important;white-space: nowrap !important;overflow: hidden !important;" width="65%">: <b style="display:inline-flex;max-width: 163px !important;overflow: hidden;"><?=$info['accountnumber']?></b></td>
</tr>
<tr <?=(($access['proformaifsccode']=='1')?'':'style="display:none;"')?>>
<td style="padding: 0px 6px !important;font-size: 11px !important;line-height: 15px !important;text-align: left;" width="35%"><input type="text" readonly value="IFSC Code" style="padding:0px;color:black;width: 100px !important;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 11px;" class="form-control form-control-sm"></td>
<td style="padding: 0px !important;font-size: 11px !important;line-height: 15px !important;text-align: left !important;white-space: nowrap !important;overflow: hidden !important;" width="65%">: <b style="display:inline-flex;max-width: 163px !important;overflow: hidden;"><?=$info['ifsccode']?></b></td>
</tr>
<tr <?=(($access['proformabranchandcity']=='1')?'':'style="display:none;"')?>>
<td style="padding: 0px 6px !important;font-size: 11px !important;line-height: 15px !important;text-align: left;" width="35%"><input type="text" readonly value="Branch & City" style="padding:0px;color:black;width: 100px !important;height: 16px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 11px;" class="form-control form-control-sm"></td>
<td style="padding: 0px !important;font-size: 11px !important;line-height: 15px !important;text-align: left !important;white-space: nowrap !important;overflow: hidden !important;" width="65%">: <b style="display:inline-flex;max-width: 163px !important;overflow: hidden;"><?=$info['branchandcity']?></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;border: 1px solid #cccccc;">
<td style="padding: 0px !important;">
<table width="100%">
<tr>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;height: 98px !important;">
<table width="100%">
<tr style="background-color: #eee;">
<td style="padding: 0px !important;">
<strong style="padding:0px 6px !important;">Billing Address</strong>
</td>
</tr>
<tr>
<?php
if ($rows[0]['customername']!=''&&(in_array('Billing Name', $fieldview))) {
?>
<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;"><?=ucwords(strtolower($rows[0]['customername']))?></strong></td>
<?php
}
?>
</tr>
<tr>
<td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">
<?php
if ((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))) {
?>
<?php
if ((($rows[0]['area']!='')||($rows[0]['city']!=''))) {
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
    <?=ucwords(strtolower($rows[0]['area']))?> <?=((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'')?> <?=ucwords(strtolower($rows[0]['city']))?>
</span>
<br>
<?php
}
if ((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))) {
?>
<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=$rows[0]['state']?> <?=((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'')?> <?=$rows[0]['pincode']?> <?=((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'')?> <?=$rows[0]['district']?>
<!-- <br> -->
</span>
<?php
}
}
?>
</td>
</tr>
<tr>
<td style="padding: 0px !important;">
<table width="100%">
<tr <?=((in_array('Work Phone', $fieldview))?'':'style="display:none;"')?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Work Phone </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$rows[0]['workphone']?></b></td>
</tr>
<tr <?=((in_array('GSTIN', $fieldview))?'':'style="display:none;"')?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">GSTIN </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: 
<?php
if (($infomainaccessuser['proformaprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['proformaprintgstin']!='hide')) {
?>
<b style="font-size:12px;padding: 0px !important;display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;"><?=$rows[0]['gstno']?></b>
<?php
}
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;">
<table width="100%">
<tr style="background-color: #eee;">
<td style="padding: 0px !important;">
<strong style="padding:0px 6px !important;">Shipping Address</strong>
</td>
</tr>
<tr>
<?php
if ($rows[0]['customername']!=''&&(in_array('Shipping Name', $fieldview))) {
?>
<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;"><?=ucwords(strtolower($rows[0]['customername']))?></strong></td>
<?php
}
?>
</tr>
<tr>
<td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">
<?php
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))) {
?>
<?php
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!=''))){
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=ucwords(strtolower($rows[0]['sarea']))?> <?=((($rows[0]['sarea']!='')&&($rows[0]['scity']!=''))?',':'')?> <?=ucwords(strtolower($rows[0]['scity']))?>
</span>
<br>
<?php
}
if (($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!='')){
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=$rows[0]['sstate']?> <?=((($rows[0]['sstate']!='')&&($rows[0]['spincode']!=''))?',':'')?> <?=$rows[0]['spincode']?> <?=((($rows[0]['sstate']!='')&&($rows[0]['sdistrict']!='')||($rows[0]['spincode']!='')&&($rows[0]['sdistrict']!=''))?',':'')?> <?=$rows[0]['sdistrict']?>
<!-- <br> -->
</span>
<?php
}
}
?>
</td>
</tr>
<tr>
<td style="padding: 0px !important;">
<table width="100%">
<tr <?=(in_array('Mobile Phone', $fieldview))?'':'style="display:none;"'?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Mobile Phone </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$rows[0]['mobile']?></b></td>
</tr>
<tr <?=(in_array('Place of Supply', $fieldview))?'':'style="display:none;"'?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">Place Of Supply </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: 
<?php
if (($infomainaccessuser['proformaprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['proformaprintpos']!='hide')) {
?>
<b style="font-size:12px;padding:0px !important;display: inline-flex;white-space: nowrap;width: 150px;overflow: hidden;"><?=$rows[0]['pos']?></b>
<?php
}
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: middle;padding: 0px !important;">
<table width="100%" style="text-align: center !important;">
<?php
if ((in_array('Proforma Invoice Information', $fieldview))) {
?>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="<?= $infomainaccessuser['modulename'] ?>" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Number" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=$rows[0]['proformano']?></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="<?= $infomainaccessuser['modulename'] ?>" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Date" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
    ?>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=date($date,strtotime($rows[0]['proformadate']))?></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=$rows[0]['proformaterm']?></b></td>
</tr>
<?php
}
?>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;">
<td style="padding: 0px !important;">
<table width="100%">
<tr style="vertical-align: top !important;">
<td style="padding: 0px !important;height:226px !important;">
<div style="max-height: 226px;min-height: 226px;overflow: hidden;">
<table width="100%" style="border:1px solid #cccccc 0px 0px 0px !important;line-height: 13px !important;height: 226px;">
<thead style="background-color: #eee;">
<tr style="height:1px !important;">
<th width="25%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">ITEM DETAILS</th>
<th width="8%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;<?=(in_array('Product Category', $fieldview))?'':'display:none !important;'?>"><span style="display: block;overflow: hidden;max-width: 78px;max-height: 13px;"><?=$access['txtnamecategory']?></span></th>
<th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">BATCH</th>
<th width="<?=$widthforexp?>" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">EXPIRY</th>
<th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">HSN/SAC</th>
<th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;<?=(in_array('Product Mrp', $fieldview))?'':'display:none !important;'?>">MRP</th>
<th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">RATE</th>
<th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">QUANTITY</th>
<?php
if ((in_array('Taxable Value', $fieldview))) {
?>
<th width="5%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">GST%</th>
<?php
}
?>
<?php
if ((in_array('Tax Value', $fieldview))) {
?>
<th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">TAXABLE&nbsp;&nbsp;&nbsp;VALUE</th>
<?php
}
?>
</tr>
</thead>
<tbody>
<?php
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
?>
<tr style="height:13px !important;">
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;max-width: 350px !important;overflow: hidden;line-height: 18px;white-space: normal !important;"><span style="display: block;overflow: hidden;height: 19px;"><?=$row['productname']?></span><span style="display: block;overflow: hidden;height: 19px;"><?=$row['productdescription']?></span>
</td>
<td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=(in_array('Product Category', $fieldview))?'':'display:none !important;'?>">
<input type="text" readonly value="<?=(($row['manufacturer']!='')?$row['manufacturer']:'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm">    
</td>
<td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">
<input type="text" readonly value="<?=(($row['batch']!='')?$row['batch']:'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm">    
</td>
<td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">
<input type="text" readonly value="<?=(($row['expdate']!='')?date($dateforexp,strtotime($row['expdate'])):'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm">    
</td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;"><input type="text" readonly value="<?=(($row['producthsn']!='')?$row['producthsn']:'')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=(in_array('Product Mrp', $fieldview))?'':'display:none !important;'?>"><input type="text" readonly value="<?=(($row['mrp']!='')?number_format((float)$row['mrp'],2,'.',''):'')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;"><input type="text" readonly value="<?=(($row['productrate']!='0')?(number_format((float)$row['productrate'],2,'.','')):'Free')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;"><input type="text" readonly value="<?=$row['quantity']?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <?php
if ((in_array('Taxable Value', $fieldview))) {
?>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;"><input type="text" readonly value="<?=(($row['vat']!='')?$row['vat'].'%':'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
<?php
}
?>
<?php
if ((in_array('Tax Value', $fieldview))) {
?>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;"><input type="text" readonly value="<?=(($row['productvalue']!='0')?(number_format((float)$row['productvalue'],2,'.','')):'Free')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
<?php
}
?>
</tr>
<?php
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
$dateformat = mysqli_query($con,"select * from paricountry");$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {$dateforfooter = 'd/m/Y h:i:s';}
$dates = date('d-m-Y h:i:s');
$begin = (round(($item-1)/5));
$finish = (round(($totpros)/5));
if($info['branchimage']!=''){
$imgs=explode(',',$info['branchimage']);
foreach($imgs as $img){
}
$imgans = '<img alt="Branch Pic" src="'.str_replace('../ups','ups',$img).'" id="branch-image1" height="80" width="80">';
}
else{
$imgans ='';
};
$custname='';
if ($rows[0]['customername']!=''&&(in_array('Billing Name', $fieldview))) {
$custname = '<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;">'.ucwords(strtolower($rows[0]['customername'])).'</strong></td>';
}
if ($rows[0]['customername']!=''&&(in_array('Shipping Name', $fieldview))) {
$custname = '<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;">'.ucwords(strtolower($rows[0]['customername'])).'</strong></td>';
}
$bill1='';
$bill2='';
if ((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))) {
if ((($rows[0]['area']!='')||($rows[0]['city']!=''))) {
$bill1 = '<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">'.ucwords(strtolower($rows[0]['area'])).' '.((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'').' '.ucwords(strtolower($rows[0]['city'])).'</span><br>';
}
if ((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))) {
$bill2 = '<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">'.$rows[0]['state'].' '.((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'').' '.$rows[0]['pincode'].' '.((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'').' '.$rows[0]['district'].'</span>';
}
}
$gstin ='';
if (($infomainaccessuser['proformaprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['proformaprintgstin']!='hide')) {
$gstin = '<b style="font-size:12px;padding: 0px !important;display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;">'.$rows[0]['gstno'].'</b>';
}
$ship1='';
$ship2='';
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))) {
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!=''))) {
$ship1 = '<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">'.ucwords(strtolower($rows[0]['sarea'])).' '.((($rows[0]['sarea']!='')&&($rows[0]['scity']!=''))?',':'').' '.ucwords(strtolower($rows[0]['scity'])).'</span><br>';
}
if ((($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))) {
$ship2 = '<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">'.$rows[0]['sstate'].' '.((($rows[0]['sstate']!='')&&($rows[0]['spincode']!=''))?',':'').' '.$rows[0]['spincode'].' '.((($rows[0]['sstate']!='')&&($rows[0]['sdistrict']!='')||($rows[0]['spincode']!='')&&($rows[0]['sdistrict']!=''))?',':'').' '.$rows[0]['sdistrict'].'</span>';
}
}
$pos ='';
if (($infomainaccessuser['proformaprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['proformaprintpos']!='hide')) {
$pos = '<b style="font-size:12px;padding:0px !important;display: inline-flex;white-space: nowrap;width: 150px;overflow: hidden;">'.$rows[0]['pos'].'</b>';
}
$proforma='';
if ((in_array('Proforma Invoice Information', $fieldview))) {
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {$date = 'd/m/Y';}
$proforma = '<tr><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="'. $infomainaccessuser['modulename'] .'" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Number" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.$rows[0]['proformano'].'</b></td></tr><tr><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="'. $infomainaccessuser['modulename'] .'" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Date" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.date($date,strtotime($rows[0]['proformadate'])).'</b></td></tr><tr><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.$rows[0]['proformaterm'].'</b></td></tr>';
}
$taxable ='';
$tax ='';
if ((in_array('Taxable Value', $fieldview))) {
$taxable = '<th width="5%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">GST%</th>';
}
if ((in_array('Tax Value', $fieldview))) {
$tax = '<th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">TAXABLE&nbsp;&nbsp;&nbsp;VALUE</th>';
}
$merge = '</tbody></table></div></td></tr></table></td></tr><tr><td><div style="min-height:92px !important;max-height:92px !important;"><div></td></tr><tr><td><div style="min-height:25px !important;max-height:25px !important;padding: 0px !important;"><div></td></tr><tr style="height:40px !important;"><td style="padding:0px !important;border-bottom: none;"><table width="100%"><tr><td width="30%" style="padding: 0px !important;border-right: 1px solid #cccccc;"><table width="100%"><tr><td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;"><div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;"><span>Printed On :'.date($dateforfooter,strtotime($dates)).'</span></div><div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page '.$begin.'/'.$finish.')</b></div></td></tr></table></td></tr></table></td></tr></table><span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span></div><div class="table-responsive" style="margin-top:1.4rem;width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;"><table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 24.13cm !important;height: 15.75cm !important;max-width:24.13cm !important; max-height:15.75cm !important;min-width:24.13cm !important; min-height:15.75cm !important;"><tr style="height:10px !important;"><td style="border-bottom: 1px solid #cccccc;"><table width="100%"><tr><td style="text-align:center;line-height: 13px !important;"><b style="font-size:15px !important;display: inline-flex;white-space: nowrap;width: max-content;overflow: hidden;text-align: center;max-width: 166px;">'.$infomainaccessuser['modulename'].'</b></td></tr></table></td></tr><tr style="height:10px !important;"><td style=""><table width="100%"><tr><td style="text-align:center;height: 80px !important;"><table width="100%"><tr>
<td width="15%" style="text-align:right;">'.$imgans.'</td><td width="51.5%" style="text-align:left;vertical-align: top;padding-left: 10px !important;border-right: 1px solid #cccccc;"><table width="100%"><tr style="padding:0px !important;"><td style=""><table width="100%" style="padding:0px !important;"><tr style="padding:0px !important;"><td style="padding:0px !important;line-height: 15px !important;"><strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.$info['franchisename'].'</strong></td></tr><tr style="padding:0px !important;"><td style="padding:0px !important;line-height: 15px !important;margin-bottom: -3px;"><span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;">'.$info['street'].' '.$info['city'].' '.$info['pincode'].' '.$info['state'].' '.$info['country'].'</span></td></tr></table></td></tr><tr><td style=""><table width="100%"><tr style="'.(($access['proformabranchphone']=='0')?'display:none;':'').'"><td width="10%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">Phone </td><td width="90%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">: <span style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$info['mobile'].'</span></td></tr><tr><td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;'.(($access['proformabranchemail']=='0')?'visibility:hidden;':'').'">E-mail </td><td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><input type="text" readonly value=": '.$info['email'].'" style="padding:0px;color:black;width: 206px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;'.(($access['proformabranchemail']=='0')?'visibility:hidden;':'').'" class="form-control form-control-sm"><span style="'.(($access['proformaprintdlno20']=='1')?'display:inline-flex;':'display:none;').'white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 20 &nbsp; : '.$info['dlno20'].'</span></td></tr><tr><td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;'.(($access['proformabranchgstin']=='0')?'visibility:hidden;':'').'">GSTIN </td><td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><span style="display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;'.(($access['proformabranchgstin']=='0')?'visibility:hidden;':'').'">: '.$info['gstno'].'</span><span style="'.(($access['proformaprintdlno21']=='1')?'display:inline-flex;':'display:none;').'white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 21 &nbsp; : '.$info['dlno21'].'</span></td></tr></table></td></tr></table></td>
<td width="34.5%">
<table width="100%">
<tr '.(($access['proformabank']=='1')?'':'style="display:none;"').'>
<td style="padding: 0px 6px !important;font-size: 11px !important;line-height: 15px !important;text-align: left;" width="35%"><input type="text" readonly value="Bank" style="padding:0px;color:black;width: 113px !important;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 11px;" class="form-control form-control-sm"></td>
<td style="padding: 0px !important;font-size: 11px !important;line-height: 15px !important;text-align: left !important;white-space: nowrap !important;overflow: hidden !important;" width="65%">: <b style="display:inline-flex;max-width: 163px !important;overflow: hidden;">'.$info['bank'].'</b></td>
</tr>
<tr '.(($access['proformaname']=='1')?'':'style="display:none;"').'>
<td style="padding: 0px 6px !important;font-size: 11px !important;line-height: 15px !important;text-align: left;" width="35%"><input type="text" readonly value="Name" style="padding:0px;color:black;width: 113px !important;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 11px;" class="form-control form-control-sm"></td>
<td style="padding: 0px !important;font-size: 11px !important;line-height: 15px !important;text-align: left !important;white-space: nowrap !important;overflow: hidden !important;" width="65%">: <b style="display:inline-flex;max-width: 163px !important;overflow: hidden;">'.$info['names'].'</b></td>
</tr>
<tr '.(($access['proformaaccnumber']=='1')?'':'style="display:none;"').'>
<td style="padding: 0px 6px !important;font-size: 11px !important;line-height: 15px !important;text-align: left;" width="35%"><input type="text" readonly value="Account Number" style="padding:0px;color:black;width: 113px !important;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 11px;" class="form-control form-control-sm"></td>
<td style="padding: 0px !important;font-size: 11px !important;line-height: 15px !important;text-align: left !important;white-space: nowrap !important;overflow: hidden !important;" width="65%">: <b style="display:inline-flex;max-width: 163px !important;overflow: hidden;">'.$info['accountnumber'].'</b></td>
</tr>
<tr '.(($access['proformaifsccode']=='1')?'':'style="display:none;"').'>
<td style="padding: 0px 6px !important;font-size: 11px !important;line-height: 15px !important;text-align: left;" width="35%"><input type="text" readonly value="IFSC Code" style="padding:0px;color:black;width: 113px !important;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 11px;" class="form-control form-control-sm"></td>
<td style="padding: 0px !important;font-size: 11px !important;line-height: 15px !important;text-align: left !important;white-space: nowrap !important;overflow: hidden !important;" width="65%">: <b style="display:inline-flex;max-width: 163px !important;overflow: hidden;">'.$info['ifsccode'].'</b></td>
</tr>
<tr '.(($access['proformabranchandcity']=='1')?'':'style="display:none;"').'>
<td style="padding: 0px 6px !important;font-size: 11px !important;line-height: 15px !important;text-align: left;" width="35%"><input type="text" readonly value="Branch & City" style="padding:0px;color:black;width: 100px !important;height: 16px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 11px;" class="form-control form-control-sm"></td>
<td style="padding: 0px !important;font-size: 11px !important;line-height: 15px !important;text-align: left !important;white-space: nowrap !important;overflow: hidden !important;" width="65%">: <b style="display:inline-flex;max-width: 163px !important;overflow: hidden;">'.$info['branchandcity'].'</b></td>
</tr>
</table>
</td></tr></table></td></tr></table></td></tr><tr style="height:1px !important;border: 1px solid #cccccc;"><td style="padding: 0px !important;"><table width="100%"><tr><td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;height: 98px !important;"><table width="100%"><tr style="background-color: #eee;"><td style="padding: 0px !important;"><strong style="padding:0px 6px !important;">Billing Address</strong></td></tr><tr>'.$custname.'</tr><tr><td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">'.$bill1.$bill2.'</td>
</tr><tr><td style="padding: 0px !important;"><table width="100%"><tr '.(((in_array('Work Phone', $fieldview))?'':'style="display:none;"')).'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Work Phone </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$rows[0]['workphone'].'</b></td></tr><tr '.(((in_array('GSTIN', $fieldview))?'':'style="display:none;"')).'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">GSTIN </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">:'.$gstin.'</td></tr></table></td></tr></table></td><td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;"><table width="100%"><tr style="background-color: #eee;"><td style="padding: 0px !important;"><strong style="padding:0px 6px !important;">Shipping Address</strong></td></tr><tr>'.$custname.'</tr><tr><td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">'.$ship1.$ship2.'</td></tr><tr><td style="padding: 0px !important;"><table width="100%"><tr '.((in_array('Mobile Phone', $fieldview))?'':'style="display:none;"').'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Mobile Phone </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$rows[0]['mobile'].'</b></td></tr><tr '.((in_array('Place of Supply', $fieldview))?'':'style="display:none;"').'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">Place Of Supply </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: '.$pos.'</td></tr></table></td></tr></table></td><td width="33%" style="white-space: normal !important;vertical-align: middle;padding: 0px !important;"><table width="100%" style="text-align: center !important;">'.$proforma.'</table></td></tr></table></td></tr><tr style="height:1px !important;"><td style="padding: 0px !important;"><table width="100%"><tr style="vertical-align: top !important;"><td style="padding: 0px !important;height:226px !important;"><div style="max-height: 226px;min-height: 226px;overflow: hidden;"><table width="100%" style="border:1px solid #cccccc 0px 0px 0px !important;line-height: 13px !important;height: 226px;"><thead style="background-color: #eee;"><tr style="height:1px !important;"><th width="25%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">ITEM DETAILS</th><th width="8%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Product Category', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;max-width: 78px;max-height: 13px;">'.$access['txtnamecategory'].'</span></th><th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">BATCH</th><th width="'.$widthforexp.'" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">EXPIRY</th><th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">HSN/SAC</th><th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align:right !important;'.((in_array('Product Mrp', $fieldview))?'':'display:none !important;').'">MRP</th><th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">RATE</th><th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">QUANTITY</th>'.$taxable.$tax.'</tr></thead><tbody>';
$finalrow=5;
if ((($item-1)%$finalrow)==0) {
if ((($countt-1)-$totpros)!=0) {
echo $merge;
}
}
}
if(($totpros%$finalrow)!=0){
?>
<tr>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=(in_array('Product Category', $fieldview))?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=(in_array('Product Mrp', $fieldview))?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<?php
if ((in_array('Taxable Value', $fieldview))) {
?>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<?php
}
?>
<?php
if ((in_array('Tax Value', $fieldview))) {
?>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<?php
}
?>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:92px !important;">
<td style="padding:0px !important;border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td width="22%" style="padding:0px 6px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<tr style="text-align:left;">
<td width="40%" style="padding:0px !important;">Total Items</td>
<td width="60%" style="padding:0px !important;">: <b><?=$rows[0]['totalitems']?></b></td>
</tr>
<tr style="text-align:left;<?=((in_array('Prepared By', $fieldview))?'':'display:none;')?>">
<td width="40%" style="padding:0px !important;">Prepared By</td>
<td width="60%" style="padding:0px !important;">: <b style="display:inline-flex;max-width: 103px;overflow: hidden;"><?=$rows[0]['preparedby']?></b></td>
</tr>
<tr style="text-align:left;<?=((in_array('Checked By', $fieldview))?'':'display:none;')?>">
<td width="40%" style="padding:0px !important;">Checked By</td>
<td width="60%" style="padding:0px !important;">: <b style="display:inline-flex;max-width: 103px;overflow: hidden;"><?=$rows[0]['checkedby']?></b></td>
</tr>
</table>
</td>
<td width="51%" style="padding:0px 6px !important;">
<table width="100%" style="padding:0px !important;">
<?php
if ((in_array('Tax Table', $fieldview))) {
?>
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<td width="28%" style="font-weight:normal !important;border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;"><b>TAXABLE&nbsp;&nbsp;&nbsp;VALUE <span class="rupeeforprint"><?=$rescurrency[0]?></span></b></td>
<td colspan="2" width="12%" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;"><b>CGST</b></td>
<td colspan="2" width="12%" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;"><b>SGST</b></td>
<td colspan="2" width="12%" style="font-weight:normal !important;font-size: 10px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;"><b>GST</b></td>
</tr>
<tbody style="font-size:10px !important;">
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['tax25']!='0')?number_format((float)$rows[0]['tax25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst25']!='0')?number_format((float)$rows[0]['cgst25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst25']!='0')?number_format((float)$rows[0]['sgst25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
5%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst25']!='0'&&$rows[0]['sgst25']!='0')?number_format((float)$rows[0]['gst25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;"><input type="text" readonly value="<?=($rows[0]['tax6']!='0')?number_format((float)$rows[0]['tax6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst6']!='0')?number_format((float)$rows[0]['cgst6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst6']!='0')?number_format((float)$rows[0]['sgst6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
12%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst6']!='0'&&$rows[0]['sgst6']!='0')?number_format((float)$rows[0]['gst6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['tax9']!='0')?number_format((float)$rows[0]['tax9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst9']!='0')?number_format((float)$rows[0]['cgst9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst9']!='0')?number_format((float)$rows[0]['sgst9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
18%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst9']!='0'&&$rows[0]['sgst9']!='0')?number_format((float)$rows[0]['gst9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['tax14']!='0')?number_format((float)$rows[0]['tax14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst14']!='0')?number_format((float)$rows[0]['cgst14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst14']!='0')?number_format((float)$rows[0]['sgst14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
28%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst14']!='0'&&$rows[0]['sgst14']!='0')?number_format((float)$rows[0]['gst14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td colspan="5" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td colspan="2" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b><span style="margin-right:-3px !important;font-size: 10px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['totalvatamount'],2,'.','')?>" style="width:90%;text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm"></b></td>
</tr>
</tbody>
</table>
</td>
</tr>
<?php
}
?>
</table>
</td>
<td width="27%" style="padding: 0px 0px 0px 6px  !important;border-left: 1px solid #cccccc;vertical-align: top;">
<table width="100%">
<tr>
<td width="43%">Sub Total &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['totalamount'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td width="43%">Discount &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['discountamount'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td width="43%">Total Tax &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['totalvatamount'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td width="43%">Round Off &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['roundoff'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:25px !important;padding: 0px !important;">
<td style="padding:0px !important;border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td width="73%" style="padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center;max-width:565px !important;width:565px !important;overflow: hidden;">
<table width="100%">
<tr>
<td style="white-space: nowrap !important;"><b><span>Grand Total In Words : </span><span style="overflow: hidden !important;padding: 0px 6px !important;" id="grandwordsans"> Rupees One Crores Forty Five Lakhs Sixty Seven Thousand Eight Hundred Eight only</span></b>
<input type="number" id="grandwords" value="<?=number_format((float)$rows[0]['grandtotal'],2,'.','')?>" style="display: none;">
<script>
$(document).ready(function() {
function Rs(amount){
var words = new Array();
words[0] = 'Zero';words[1] = 'One';words[2] = 'Two';words[3] = 'Three';words[4] = 'Four';words[5] = 'Five';words[6] = 'Six';words[7] = 'Seven';words[8] = 'Eight';words[9] = 'Nine';words[10] = 'Ten';words[11] = 'Eleven';words[12] = 'Twelve';words[13] = 'Thirteen';words[14] = 'Fourteen';words[15] = 'Fifteen';words[16] = 'Sixteen';words[17] = 'Seventeen';words[18] = 'Eighteen';words[19] = 'Nineteen';words[20] = 'Twenty';words[30] = 'Thirty';words[40] = 'Forty';words[50] = 'Fifty';words[60] = 'Sixty';words[70] = 'Seventy';words[80] = 'Eighty';words[90] = 'Ninety';var op;
amount = amount.toString();
var atemp = amount.split('.');
var number = atemp[0].split(',').join('');
var n_length = number.length;
var words_string = '';
if(n_length <= 9){
var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
var received_n_array = new Array();
for (var i = 0; i < n_length; i++){
received_n_array[i] = number.substr(i, 1);}
for (var i = 9 - n_length, j = 0; i < 9; i++, j++){
n_array[i] = received_n_array[j];}
for (var i = 0, j = 1; i < 9; i++, j++){
if(i == 0 || i == 2 || i == 4 || i == 7){
if(n_array[i] == 1){
n_array[j] = 10 + parseInt(n_array[j]);
n_array[i] = 0;}}}
value = '';
for (var i = 0; i < 9; i++){
if(i == 0 || i == 2 || i == 4 || i == 7){
value = n_array[i] * 10;} else {
value = n_array[i];}
if(value != 0){
words_string += words[value] + ' ';}
if((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Crores ';}
if((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Lakhs ';}
if((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Thousand ';}
if(i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)){
words_string += 'Hundred and ';} else if(i == 6 && value != 0){
words_string += 'Hundred ';}}
words_string = words_string.split(' ').join(' ');}
return words_string;}
n = document.getElementById("grandwords").value;

nums = n.toString().split('.')

var whole = Rs(nums[0])

if(nums[1]==null)nums[1]=0;

if(nums[1].length == 1 )nums[1]=nums[1]+'0';

if(nums[1].length> 2){
    nums[1]=nums[1].substring(2,length - 1)
}

if(nums.length == 2){
if(nums[0]<=9){
    nums[0]=nums[0]*10
} 
else {
    nums[0]=nums[0]
};

var fraction = Rs(nums[1])

if(whole=='' && fraction==''){
    op= 'Zero only';
}

if(whole=='' && fraction!=''){
    op= 'paise ' + fraction + ' only';
}

if(whole!='' && fraction==''){
    op='Rupees ' + whole + ' only';
}

if(whole!='' && fraction!=''){
    op='Rupees ' + whole + 'and paise ' + fraction + ' only';
}

amt=n;

if(amt > 999999999.99){
    op='Oops!!! The amount is too big to convert';
}

if(isNaN(amt) == true ){
    op='Error : Amount in number appears to be incorrect. Please Check.';
}

$('#grandwordsans').html(op);}
})
</script>
</td>
</tr>
</table>
</td>
<td width="27%" style="padding: 0px 0px 0px 6px  !important;">
<table width="100%">
<tr style="font-size:13px !important;">
<td width="43%"><b>Grand Total &nbsp;</b></td>
<td width="57%"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['grandtotal'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 13px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:40px !important;">
<td style="padding:0px !important;border-bottom: none;">
<table width="100%">
<tr>
<td width="30%" style="padding: 0px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<tr>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
    ?>
<td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;">
<div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;"><span>Printed On : <?php $dates = date('d-m-Y h:i:s');echo date($date,strtotime($dates))?></span></div>
<div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page <?=$begin.'/'.$begin?>)</b></div>
</td>
</tr>
</table>
</td>
<td width="40%" style="padding: 0px 6px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<?php
if ((in_array('Terms and Conditions', $fieldview))) {
?>
<tr>
<td style="font-size: 12px !important;">Terms and Conditions : <b><span style="display: inline-flex;white-space: nowrap;width: 171px;overflow: hidden;font-size: 12px !important;"><?=$rows[0]['terms']?></span></b></td>
</tr>
<?php
}
?>
</table>
</td>
<td width="30%" style="padding: 0px !important;">
<table width="100%">
<tr>
<td style="border:1px solid #cccccc; height:25px !important;width: 237px !important; text-align:center; vertical-align:bottom">
<?php
if($info['signimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Sign Pic" src="<?=str_replace('../ups','ups',$img)?>" id="sign-image1" style="width: 237px !important;height: 25px !important;">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>

    <?php
}
?>
</td>
</tr>
<tr>
<td style="text-align:center;line-height: 10px !important;"><span style="position: relative;top: 1px !important;font-size: 12px !important;">For <strong style="font-size:12px !important;"><?=$info['franchisename']?></strong></span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

</table>
<span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span>
</div>
</div>
<style type="text/css">
.insidecard{
    width: max-content !important;
    height: max-content !important;
}
    @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    zoom: 20% !important;
                    margin-left: -135px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    margin-left: -15px !important;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    zoom: 21% !important;
                    margin-left: -135px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    zoom: 22% !important;
                    margin-left: -135px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 300px) {
                #zoomforprint{
                    zoom: 23% !important;
                    margin-left: -120px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 301px) and (max-device-width: 310px) {
                #zoomforprint{
                    zoom: 25% !important;
                    margin-left: -115px !important;
                }
                #templatetext{
                    zoom: 78% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 311px) and (max-device-width: 320px) {
                #zoomforprint{
                    zoom: 26% !important;
                    margin-left: -115px !important;
                }
                #templatetext{
                    zoom: 81% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    zoom: 27% !important;
                    margin-left: -115px !important;
                }
                #templatetext{
                    zoom: 86% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 340px) {
                #zoomforprint{
                    zoom: 29% !important;
                    margin-left: -115px !important;
                }
                #templatetext{
                    zoom: 90% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 341px) and (max-device-width: 350px) {
                #zoomforprint{
                    zoom: 30% !important;
                    margin-left: -115px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 360px) {
                #zoomforprint{
                    zoom: 31% !important;
                    margin-left: -110px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 361px) and (max-device-width: 370px) {
                #zoomforprint{
                    zoom: 32% !important;
                    margin-left: -100px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 371px) and (max-device-width: 380px) {
                #zoomforprint{
                    zoom: 33% !important;
                    margin-left: -93px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 390px) {
                #zoomforprint{
                    zoom: 34% !important;
                    margin-left: -90px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 391px) and (max-device-width: 400px) {
                #zoomforprint{
                    zoom: 35% !important;
                    margin-left: -90px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 410px) {
                #zoomforprint{
                    zoom: 36% !important;
                    margin-left: -90px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 411px) and (max-device-width: 420px) {
                #zoomforprint{
                    zoom: 37% !important;
                    margin-left: -80px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 421px) and (max-device-width: 430px) {
                #zoomforprint{
                    zoom: 38% !important;
                    margin-left: -80px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 431px) and (max-device-width: 440px) {
                #zoomforprint{
                    zoom: 39% !important;
                    margin-left: -80px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 441px) and (max-device-width: 450px) {
                #zoomforprint{
                    zoom: 40% !important;
                    margin-left: -76px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 451px) and (max-device-width: 460px) {
                #zoomforprint{
                    zoom: 40% !important;
                    margin-left: -54px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 470px) {
                #zoomforprint{
                    zoom: 41% !important;
                    margin-left: -54px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 471px) and (max-device-width: 490px) {
                #zoomforprint{
                    zoom: 42% !important;
                    margin-left: -53px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    zoom: 43% !important;
                    margin-left: -33px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 510px) {
                #zoomforprint{
                    zoom: 44% !important;
                    margin-left: -33px !important;
                }
                #templatetext{
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 511px) and (max-device-width: 530px) {
                #zoomforprint{
                    zoom: 45% !important;
                    margin-left: -33px !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 531px) and (max-device-width: 540px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -33px !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 541px) and (max-device-width: 550px) {
                #zoomforprint{
                    zoom: 48% !important;
                    margin-left: -33px !important;
                }
                #templatetext{
                    margin-right: -3px !important;
                }
            }
            @media screen and (min-device-width: 551px) and (max-device-width: 560px) {
                #zoomforprint{
                    zoom: 49% !important;
                    margin-left: -33px !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 561px) and (max-device-width: 570px) {
                #zoomforprint{
                    zoom: 50% !important;
                    margin-left: -33px !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 571px) and (max-device-width: 580px) {
                #zoomforprint{
                    zoom: 51% !important;
                    margin-left: -33px !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 581px) and (max-device-width: 590px) {
                #zoomforprint{
                    zoom: 52% !important;
                    margin-left: -33px !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 591px) and (max-device-width: 600px) {
                #zoomforprint{
                    zoom: 53% !important;
                    margin-left: -33px !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 610px) {
                #zoomforprint{
                    zoom: 54% !important;
                    margin-left: -27px !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 611px) and (max-device-width: 620px) {
                #zoomforprint{
                    zoom: 55% !important;
                    margin-left: -27px !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 621px) and (max-device-width: 767px) {
                #zoomforprint{
                    zoom: 56% !important;
                    margin-left: -27px !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 768px) and (max-device-width: 991px) {
                #zoomforprint{
                    zoom: 70% !important;
                }
            }
            @media screen and (min-device-width: 768.5px) and (max-device-width: 790px) {
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 830px) and (max-device-width: 991.7px) {
                #zoomforprint{
                    margin-left: 25px !important;
                }
            }
            @media screen and (min-device-width: 791px) and (max-device-width: 990.5px) {
                #templatetext{
                    margin-right: 25px !important;
                }
            }
            @media screen and (min-device-width: 992px) and (max-device-width: 1020px) {
                #zoomforprint{
                    zoom: 86% !important;
                    margin-left: -123px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1021px) and (max-device-width: 1199px) {
                #zoomforprint{
                    zoom: 96% !important;
                    margin-left: -153px !important;
                }
                #templatetext{
                    margin-right: -135px !important;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1220px) {
                #zoomforprint{
                    zoom: 95% !important;
                    margin-left: -163px !important;
                }
                #templatetext{
                    margin-right: -160px !important;
                }
            }
            @media screen and (min-device-width: 1221px) and (max-device-width: 1250px) {
                #zoomforprint{
                    zoom: 95% !important;
                    margin-left: -160px !important;
                }
                #templatetext{
                    margin-right: -150px !important;
                }
            }
            @media screen and (min-device-width: 1251px) and (max-device-width: 1290px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -163px !important;
                }
                #templatetext{
                    margin-right: -170px !important;
                }
            }
            @media screen and (min-device-width: 1291px) and (max-device-width: 1330px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -145px !important;
                }
                #templatetext{
                    margin-right: -150px !important;
                }
            }
            @media screen and (min-device-width: 1331px) and (max-device-width: 1360px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -135px !important;
                }
                #templatetext{
                    margin-right: -130px !important;
                }
            }
            @media screen and (min-device-width: 1361px) and (max-device-width: 1400px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -125px !important;
                }
                #templatetext{
                    margin-right: -123px !important;
                }
            }
            @media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -66px !important;
                }
            }
            @media screen and (min-device-width: 1501px) and (max-device-width: 1549px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -70px !important;
                }
                #templatetext{
                    margin-right: -80px !important;
                }
            }
            @media screen and (min-device-width: 1550px) and (max-device-width: 3000px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -45px !important;
                }
                #templatetext{
                    margin-right: -40px !important;
                }
            }
</style>
    <?php
}
elseif($info['proformatemplate']=='0')
{
    ?>
<div id="printalble">
<div class="table-responsive" style="width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;">
<table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 21cm !important;height: 29cm !important;max-width:21cm !important; max-height:29cm !important;min-width:21cm !important; min-height:29cm !important;">

<tr style="height:10px !important;">
<td style="border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td style="text-align:center;line-height: 15px !important;">
<b style="font-size:15px !important;display: inline-flex;white-space: nowrap;width: max-content;overflow: hidden;text-align: center;max-width: 166px;"><?= $infomainaccessuser['modulename'] ?></b>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:10px !important;">
<td style="">
<table width="100%">
<tr>
<td style="text-align:center;height: 80px !important;">
<table width="100%">
<tr>
<td width="35%" style="text-align:right;">
<?php
if($info['branchimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Branch Pic" src="<?=str_replace('../ups','ups',$img)?>" id="branch-image1" height="80" width="80">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>
    <?php
}
?>
</td>
<td width="65%" style="text-align:left;vertical-align: top;padding-left: 30px !important;">
<table width="100%">
<tr style="padding:0px !important;">
<td style="">
<table width="100%" style="padding:0px !important;">
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;"><?=$info['franchisename']?></strong>
</td>
</tr>
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;margin-bottom: -3px;">
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;"><?=$info['street']?> <?=$info['city']?> <?=$info['pincode']?> <?=$info['state']?> <?=$info['country']?> </span>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td style="">
<table width="100%">
<tr style="<?=($access['proformabranchphone']=='0')?'display:none;':''?>">
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">Phone </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">: <span style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$info['mobile']?></span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;<?=($access['proformabranchemail']=='0')?'visibility:hidden;':''?>">E-mail </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><input type="text" readonly value=": <?=$info['email']?>" style="padding:0px;color:black;width: 206px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;<?=($access['proformabranchemail']=='0')?'visibility:hidden;':''?>" class="form-control form-control-sm"><span style="<?=(($access['proformaprintdlno20']=='1')?'display:inline-flex;':'display:none;')?>white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 20 &nbsp; : <?=$info['dlno20']?></span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;<?=($access['proformabranchgstin']=='0')?'visibility:hidden;':''?>">GSTIN </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><span style="display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;<?=($access['proformabranchgstin']=='0')?'visibility:hidden;':''?>">: <?=$info['gstno']?></span><span style="<?=(($access['proformaprintdlno21']=='1')?'display:inline-flex;':'display:none;')?>white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 21 &nbsp; : <?=$info['dlno21']?></span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;border: 1px solid #cccccc;">
<td style="padding: 0px !important;">
<table width="100%">
<tr>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;height: 98px !important;">
<table width="100%">
<tr style="background-color: #eee;">
<td style="padding: 0px !important;">
<strong style="padding:0px 6px !important;">Billing Address</strong>
</td>
</tr>
<tr>
<?php
if ($rows[0]['customername']!=''&&(in_array('Billing Name', $fieldview))) {
?>
<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;"><?=ucwords(strtolower($rows[0]['customername']))?></strong></td>
<?php
}
?>
</tr>
<tr>
<td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">
<?php
if ((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))) {
?>
<?php
if ((($rows[0]['area']!='')||($rows[0]['city']!=''))) {
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
    <?=ucwords(strtolower($rows[0]['area']))?> <?=((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'')?> <?=ucwords(strtolower($rows[0]['city']))?>
</span>
<br>
<?php
}
if ((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))) {
?>
<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=$rows[0]['state']?> <?=((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'')?> <?=$rows[0]['pincode']?> <?=((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'')?> <?=$rows[0]['district']?>
<!-- <br> -->
</span>
<?php
}
}
?>
</td>
</tr>
<tr>
<td style="padding: 0px !important;">
<table width="100%">
<tr <?=((in_array('Work Phone', $fieldview))?'':'style="display:none;"')?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Work Phone </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$rows[0]['workphone']?></b></td>
</tr>
<tr <?=((in_array('GSTIN', $fieldview))?'':'style="display:none;"')?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">GSTIN </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: 
<?php
if (($infomainaccessuser['proformaprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['proformaprintgstin']!='hide')) {
?>
<b style="font-size:12px;padding: 0px !important;display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;"><?=$rows[0]['gstno']?></b>
<?php
}
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;">
<table width="100%">
<tr style="background-color: #eee;">
<td style="padding: 0px !important;">
<strong style="padding:0px 6px !important;">Shipping Address</strong>
</td>
</tr>
<tr>
<?php
if ($rows[0]['customername']!=''&&(in_array('Shipping Name', $fieldview))) {
?>
<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;"><?=ucwords(strtolower($rows[0]['customername']))?></strong></td>
<?php
}
?>
</tr>
<tr>
<td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">
<?php
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))) {
?>
<?php
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!=''))){
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=ucwords(strtolower($rows[0]['sarea']))?> <?=((($rows[0]['sarea']!='')&&($rows[0]['scity']!=''))?',':'')?> <?=ucwords(strtolower($rows[0]['scity']))?>
</span>
<br>
<?php
}
if (($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!='')){
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=$rows[0]['sstate']?> <?=((($rows[0]['sstate']!='')&&($rows[0]['spincode']!=''))?',':'')?> <?=$rows[0]['spincode']?> <?=((($rows[0]['sstate']!='')&&($rows[0]['sdistrict']!='')||($rows[0]['spincode']!='')&&($rows[0]['sdistrict']!=''))?',':'')?> <?=$rows[0]['sdistrict']?>
<!-- <br> -->
</span>
<?php
}
}
?>
</td>
</tr>
<tr>
<td style="padding: 0px !important;">
<table width="100%">
<tr <?=(in_array('Mobile Phone', $fieldview))?'':'style="display:none;"'?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Mobile Phone </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$rows[0]['mobile']?></b></td>
</tr>
<tr <?=(in_array('Place of Supply', $fieldview))?'':'style="display:none;"'?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">Place Of Supply </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: 
<?php
if (($infomainaccessuser['proformaprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['proformaprintpos']!='hide')) {
?>
<b style="font-size:12px;padding:0px !important;display: inline-flex;white-space: nowrap;width: 150px;overflow: hidden;"><?=$rows[0]['pos']?></b>
<?php
}
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: middle;padding: 0px !important;">
<table width="100%" style="text-align: center !important;">
<?php
if ((in_array('Proforma Invoice Information', $fieldview))) {
?>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="<?= $infomainaccessuser['modulename'] ?>" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Number" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=$rows[0]['proformano']?></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="<?= $infomainaccessuser['modulename'] ?>" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Date" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
    ?>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=date($date,strtotime($rows[0]['proformadate']))?></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=$rows[0]['proformaterm']?></b></td>
</tr>
<?php
}
?>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;">
<td style="padding: 0px !important;">
<table width="100%">
<tr style="vertical-align: top !important;">
<td style="padding: 0px !important;height:723px !important;">
<div style="max-height: 723px;min-height: 723px;overflow: hidden;">
<table width="100%" style="border:1px solid #cccccc 0px 0px 0px !important;line-height: 13px !important;height: 723px;">
<thead style="background-color: #eee;">
<tr style="height:1px !important;">
<th width="20%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">ITEM DETAILS</th>
<th width="8%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;<?=(in_array('Product Category', $fieldview))?'':'display:none !important;'?>"><span style="display: block;overflow: hidden;max-width: 78px;max-height: 13px;"><?=$access['txtnamecategory']?></span></th>
<th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">BATCH</th>
<th width="<?=$widthforexp?>" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">EXPIRY</th>
<th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">HSN/SAC</th>
<th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;<?=(in_array('Product Mrp', $fieldview))?'':'display:none !important;'?>">MRP</th>
<th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">RATE</th>
<th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">QUANTITY</th>
<?php
if ((in_array('Taxable Value', $fieldview))) {
?>
<th width="5%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">GST%</th>
<?php
}
?>
<?php
if ((in_array('Tax Value', $fieldview))) {
?>
<th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">TAXABLE&nbsp;&nbsp;&nbsp;VALUE</th>
<?php
}
?>
</tr>
</thead>
<tbody>
<?php
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
?>
<tr style="height:13px !important;">
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;max-width: 350px !important;overflow: hidden;line-height: 18px;white-space: normal !important;"><span style="display: block;overflow: hidden;height: 19px;"><?=$row['productname']?></span><span style="display: block;overflow: hidden;height: 19px;"><?=$row['productdescription']?></span>
</td>
<td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=(in_array('Product Category', $fieldview))?'':'display:none !important;'?>">
<input type="text" readonly value="<?=(($row['manufacturer']!='')?$row['manufacturer']:'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm">    
</td>
<td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">
<input type="text" readonly value="<?=(($row['batch']!='')?$row['batch']:'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm">    
</td>
<td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">
<input type="text" readonly value="<?=(($row['expdate']!='')?date($dateforexp,strtotime($row['expdate'])):'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm">    
</td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;"><input type="text" readonly value="<?=(($row['producthsn']!='')?$row['producthsn']:'')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=(in_array('Product Mrp', $fieldview))?'':'display:none !important;'?>"><input type="text" readonly value="<?=(($row['mrp']!='')?number_format((float)$row['mrp'],2,'.',''):'')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;"><input type="text" readonly value="<?=(($row['productrate']!='0')?(number_format((float)$row['productrate'],2,'.','')):'Free')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;"><input type="text" readonly value="<?=$row['quantity']?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <?php
if ((in_array('Taxable Value', $fieldview))) {
?>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;"><input type="text" readonly value="<?=(($row['vat']!='')?$row['vat'].'%':'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
<?php
}
?>
<?php
if ((in_array('Tax Value', $fieldview))) {
?>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;"><input type="text" readonly value="<?=(($row['productvalue']!='0')?(number_format((float)$row['productvalue'],2,'.','')):'Free')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
<?php
}
?>
</tr>
<?php
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
$dateformat = mysqli_query($con,"select * from paricountry");$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {$dateforfooter = 'd/m/Y h:i:s';}
$dates = date('d-m-Y h:i:s');
$begin = (round(($item-1)/13));
$finish = (round(($totpros)/13));
if($info['branchimage']!=''){
$imgs=explode(',',$info['branchimage']);
foreach($imgs as $img){
}
$imgans = '<img alt="Branch Pic" src="'.str_replace('../ups','ups',$img).'" id="branch-image1" height="80" width="80">';
}
else{
$imgans ='';
};
$custname='';
if ($rows[0]['customername']!=''&&(in_array('Billing Name', $fieldview))) {
$custname = '<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;">'.ucwords(strtolower($rows[0]['customername'])).'</strong></td>';
}
if ($rows[0]['customername']!=''&&(in_array('Shipping Name', $fieldview))) {
$custname = '<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;">'.ucwords(strtolower($rows[0]['customername'])).'</strong></td>';
}
$bill1='';
$bill2='';
if ((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))) {
if ((($rows[0]['area']!='')||($rows[0]['city']!=''))) {
$bill1 = '<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">'.ucwords(strtolower($rows[0]['area'])).' '.((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'').' '.ucwords(strtolower($rows[0]['city'])).'</span><br>';
}
if ((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))) {
$bill2 = '<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">'.$rows[0]['state'].' '.((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'').' '.$rows[0]['pincode'].' '.((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'').' '.$rows[0]['district'].'</span>';
}
}
$gstin ='';
if (($infomainaccessuser['proformaprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['proformaprintgstin']!='hide')) {
$gstin = '<b style="font-size:12px;padding: 0px !important;display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;">'.$rows[0]['gstno'].'</b>';
}
$ship1='';
$ship2='';
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))) {
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!=''))) {
$ship1 = '<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">'.ucwords(strtolower($rows[0]['sarea'])).' '.((($rows[0]['sarea']!='')&&($rows[0]['scity']!=''))?',':'').' '.ucwords(strtolower($rows[0]['scity'])).'</span><br>';
}
if ((($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))) {
$ship2 = '<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">'.$rows[0]['sstate'].' '.((($rows[0]['sstate']!='')&&($rows[0]['spincode']!=''))?',':'').' '.$rows[0]['spincode'].' '.((($rows[0]['sstate']!='')&&($rows[0]['sdistrict']!='')||($rows[0]['spincode']!='')&&($rows[0]['sdistrict']!=''))?',':'').' '.$rows[0]['sdistrict'].'</span>';
}
}
$pos ='';
if (($infomainaccessuser['proformaprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['proformaprintpos']!='hide')) {
$pos = '<b style="font-size:12px;padding:0px !important;display: inline-flex;white-space: nowrap;width: 150px;overflow: hidden;">'.$rows[0]['pos'].'</b>';
}
$proforma='';
if ((in_array('Proforma Invoice Information', $fieldview))) {
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {$date = 'd/m/Y';}
$proforma = '<tr><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="'. $infomainaccessuser['modulename'] .'" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Number" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.$rows[0]['proformano'].'</b></td></tr><tr><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="'. $infomainaccessuser['modulename'] .'" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Date" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.date($date,strtotime($rows[0]['proformadate'])).'</b></td></tr><tr><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.$rows[0]['proformaterm'].'</b></td></tr>';
}
$taxable ='';
$tax ='';
if ((in_array('Taxable Value', $fieldview))) {
$taxable = '<th width="5%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">GST%</th>';
}
if ((in_array('Tax Value', $fieldview))) {
$tax = '<th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">TAXABLE&nbsp;&nbsp;&nbsp;VALUE</th>';
}
$merge = '</tbody></table></div></td></tr></table></td></tr><tr><td><div style="min-height:92px !important;max-height:92px !important;"><div></td></tr><tr><td><div style="min-height:25px !important;max-height:25px !important;padding: 0px !important;"><div></td></tr><tr style="height:40px !important;"><td style="padding:0px !important;border-bottom: none;"><table width="100%"><tr><td width="30%" style="padding: 0px !important;border-right: 1px solid #cccccc;"><table width="100%"><tr><td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;"><div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;"><span>Printed On :'.date($dateforfooter,strtotime($dates)).'</span></div><div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page '.$begin.'/'.$finish.')</b></div></td></tr></table></td></tr></table></td></tr></table><span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span></div><div class="table-responsive" style="margin-top:1.6rem;width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;"><table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 21cm !important;height: 29cm !important;max-width:21cm !important; max-height:29cm !important;min-width:21cm !important; min-height:29cm !important;"><tr style="height:10px !important;"><td style="border-bottom: 1px solid #cccccc;"><table width="100%"><tr><td style="text-align:center;line-height: 13px !important;"><b style="font-size:15px !important;display: inline-flex;white-space: nowrap;width: max-content;overflow: hidden;text-align: center;max-width: 166px;">'.$infomainaccessuser['modulename'].'</b></td></tr></table></td></tr><tr style="height:10px !important;"><td style=""><table width="100%"><tr><td style="text-align:center;height: 80px !important;"><table width="100%"><tr><td width="35%" style="text-align:right;">'.$imgans.'</td><td width="65%" style="text-align:left;vertical-align: top;padding-left: 30px !important;"><table width="100%"><tr style="padding:0px !important;"><td style=""><table width="100%" style="padding:0px !important;"><tr style="padding:0px !important;"><td style="padding:0px !important;line-height: 15px !important;"><strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.$info['franchisename'].'</strong></td></tr><tr style="padding:0px !important;"><td style="padding:0px !important;line-height: 15px !important;margin-bottom: -3px;"><span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;">'.$info['street'].' '.$info['city'].' '.$info['pincode'].' '.$info['state'].' '.$info['country'].'</span></td></tr></table></td></tr><tr><td style=""><table width="100%"><tr style="'.(($access['proformabranchphone']=='0')?'display:none;':'').'"><td width="10%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">Phone </td><td width="90%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">: <span style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$info['mobile'].'</span></td></tr><tr><td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;'.(($access['proformabranchemail']=='0')?'visibility:hidden;':'').'">E-mail </td><td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><input type="text" readonly value=": '.$info['email'].'" style="padding:0px;color:black;width: 206px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;'.(($access['proformabranchemail']=='0')?'visibility:hidden;':'').'" class="form-control form-control-sm"><span style="'.(($access['proformaprintdlno20']=='1')?'display:inline-flex;':'display:none;').'white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 20 &nbsp; : '.$info['dlno20'].'</span></td></tr><tr><td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;'.(($access['proformabranchgstin']=='0')?'visibility:hidden;':'').'">GSTIN </td><td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><span style="display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;'.(($access['proformabranchgstin']=='0')?'visibility:hidden;':'').'">: '.$info['gstno'].'</span><span style="'.(($access['proformaprintdlno21']=='1')?'display:inline-flex;':'display:none;').'white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 21 &nbsp; : '.$info['dlno21'].'</span></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr><tr style="height:1px !important;border: 1px solid #cccccc;"><td style="padding: 0px !important;"><table width="100%"><tr><td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;height: 98px !important;"><table width="100%"><tr style="background-color: #eee;"><td style="padding: 0px !important;"><strong style="padding:0px 6px !important;">Billing Address</strong></td></tr><tr>'.$custname.'</tr><tr><td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">'.$bill1.$bill2.'</td>
</tr><tr><td style="padding: 0px !important;"><table width="100%"><tr '.(((in_array('Work Phone', $fieldview))?'':'style="display:none;"')).'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Work Phone </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$rows[0]['workphone'].'</b></td></tr><tr '.(((in_array('GSTIN', $fieldview))?'':'style="display:none;"')).'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">GSTIN </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">:'.$gstin.'</td></tr></table></td></tr></table></td><td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;"><table width="100%"><tr style="background-color: #eee;"><td style="padding: 0px !important;"><strong style="padding:0px 6px !important;">Shipping Address</strong></td></tr><tr>'.$custname.'</tr><tr><td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">'.$ship1.$ship2.'</td></tr><tr><td style="padding: 0px !important;"><table width="100%"><tr '.((in_array('Mobile Phone', $fieldview))?'':'style="display:none;"').'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Mobile Phone </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$rows[0]['mobile'].'</b></td></tr><tr '.((in_array('Place of Supply', $fieldview))?'':'style="display:none;"').'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">Place Of Supply </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: '.$pos.'</td></tr></table></td></tr></table></td><td width="33%" style="white-space: normal !important;vertical-align: middle;padding: 0px !important;"><table width="100%" style="text-align: center !important;">'.$proforma.'</table></td></tr></table></td></tr><tr style="height:1px !important;"><td style="padding: 0px !important;"><table width="100%"><tr style="vertical-align: top !important;"><td style="padding: 0px !important;height:723px !important;"><div style="max-height: 723px;min-height: 723px;overflow: hidden;"><table width="100%" style="border:1px solid #cccccc 0px 0px 0px !important;line-height: 13px !important;height: 723px;"><thead style="background-color: #eee;"><tr style="height:1px !important;"><th width="20%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">ITEM DETAILS</th><th width="8%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Product Category', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;max-width: 78px;max-height: 13px;">'.$access['txtnamecategory'].'</span></th><th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">BATCH</th><th width="'.$widthforexp.'" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">EXPIRY</th><th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">HSN/SAC</th><th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align:right !important;'.((in_array('Product Mrp', $fieldview))?'':'display:none !important;').'">MRP</th><th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">RATE</th><th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">QUANTITY</th>'.$taxable.$tax.'</tr></thead><tbody>';
$finalrow=13;
if ((($item-1)%$finalrow)==0) {
if ((($countt-1)-$totpros)!=0) {
echo $merge;
}
}
}
if(($totpros%$finalrow)!=0){
?>
<tr>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=(in_array('Product Category', $fieldview))?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=(in_array('Product Mrp', $fieldview))?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<?php
if ((in_array('Taxable Value', $fieldview))) {
?>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<?php
}
?>
<?php
if ((in_array('Tax Value', $fieldview))) {
?>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<?php
}
?>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:92px !important;">
<td style="padding:0px !important;border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td width="22%" style="padding:0px 6px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<tr style="text-align:left;">
<td width="50%" style="padding:0px !important;">Total Items</td>
<td width="50%" style="padding:0px !important;">: <b><?=$rows[0]['totalitems']?></b></td>
</tr>
<tr style="text-align:left;<?=((in_array('Prepared By', $fieldview))?'':'display:none;')?>">
<td width="50%" style="padding:0px !important;">Prepared By</td>
<td width="50%" style="padding:0px !important;">: <b style="display:inline-flex;max-width: 72px;overflow: hidden;"><?=$rows[0]['preparedby']?></b></td>
</tr>
<tr style="text-align:left;<?=((in_array('Checked By', $fieldview))?'':'display:none;')?>">
<td width="50%" style="padding:0px !important;">Checked By</td>
<td width="50%" style="padding:0px !important;">: <b style="display:inline-flex;max-width: 72px;overflow: hidden;"><?=$rows[0]['checkedby']?></b></td>
</tr>
</table>
</td>
<td width="51%" style="padding:0px 6px !important;">
<table width="100%" style="padding:0px !important;">
<?php
if ((in_array('Tax Table', $fieldview))) {
?>
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<td width="28%" style="font-weight:normal !important;border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;"><b>TAXABLE&nbsp;&nbsp;&nbsp;VALUE <span class="rupeeforprint"><?=$rescurrency[0]?></span></b></td>
<td colspan="2" width="12%" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;"><b>CGST</b></td>
<td colspan="2" width="12%" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;"><b>SGST</b></td>
<td colspan="2" width="12%" style="font-weight:normal !important;font-size: 10px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;"><b>GST</b></td>
</tr>
<tbody style="font-size:10px !important;">
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['tax25']!='0')?number_format((float)$rows[0]['tax25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst25']!='0')?number_format((float)$rows[0]['cgst25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst25']!='0')?number_format((float)$rows[0]['sgst25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
5%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst25']!='0'&&$rows[0]['sgst25']!='0')?number_format((float)$rows[0]['gst25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;"><input type="text" readonly value="<?=($rows[0]['tax6']!='0')?number_format((float)$rows[0]['tax6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst6']!='0')?number_format((float)$rows[0]['cgst6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst6']!='0')?number_format((float)$rows[0]['sgst6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
12%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst6']!='0'&&$rows[0]['sgst6']!='0')?number_format((float)$rows[0]['gst6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['tax9']!='0')?number_format((float)$rows[0]['tax9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst9']!='0')?number_format((float)$rows[0]['cgst9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst9']!='0')?number_format((float)$rows[0]['sgst9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
18%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst9']!='0'&&$rows[0]['sgst9']!='0')?number_format((float)$rows[0]['gst9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['tax14']!='0')?number_format((float)$rows[0]['tax14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst14']!='0')?number_format((float)$rows[0]['cgst14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst14']!='0')?number_format((float)$rows[0]['sgst14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
28%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst14']!='0'&&$rows[0]['sgst14']!='0')?number_format((float)$rows[0]['gst14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td colspan="5" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td colspan="2" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b><span style="margin-right:-3px !important;font-size: 10px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['totalvatamount'],2,'.','')?>" style="width:90%;text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm"></b></td>
</tr>
</tbody>
</table>
</td>
</tr>
<?php
}
?>
</table>
</td>
<td width="27%" style="padding: 0px 0px 0px 6px  !important;border-left: 1px solid #cccccc;vertical-align: top;">
<table width="100%">
<tr>
<td width="43%">Sub Total &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['totalamount'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td width="43%">Discount &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['discountamount'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td width="43%">Total Tax &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['totalvatamount'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td width="43%">Round Off &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['roundoff'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:25px !important;padding: 0px !important;">
<td style="padding:0px !important;border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td width="73%" style="padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center;max-width:565px !important;width:565px !important;overflow: hidden;">
<table width="100%">
<tr>
<td style="white-space: nowrap !important;"><b><span>Grand Total In Words : </span><span style="overflow: hidden !important;padding: 0px 6px !important;" id="grandwordsans"> Rupees One Crores Forty Five Lakhs Sixty Seven Thousand Eight Hundred Eight only</span></b>
<input type="number" id="grandwords" value="<?=number_format((float)$rows[0]['grandtotal'],2,'.','')?>" style="display: none;">
<script>
$(document).ready(function() {
function Rs(amount){
var words = new Array();
words[0] = 'Zero';words[1] = 'One';words[2] = 'Two';words[3] = 'Three';words[4] = 'Four';words[5] = 'Five';words[6] = 'Six';words[7] = 'Seven';words[8] = 'Eight';words[9] = 'Nine';words[10] = 'Ten';words[11] = 'Eleven';words[12] = 'Twelve';words[13] = 'Thirteen';words[14] = 'Fourteen';words[15] = 'Fifteen';words[16] = 'Sixteen';words[17] = 'Seventeen';words[18] = 'Eighteen';words[19] = 'Nineteen';words[20] = 'Twenty';words[30] = 'Thirty';words[40] = 'Forty';words[50] = 'Fifty';words[60] = 'Sixty';words[70] = 'Seventy';words[80] = 'Eighty';words[90] = 'Ninety';var op;
amount = amount.toString();
var atemp = amount.split('.');
var number = atemp[0].split(',').join('');
var n_length = number.length;
var words_string = '';
if(n_length <= 9){
var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
var received_n_array = new Array();
for (var i = 0; i < n_length; i++){
received_n_array[i] = number.substr(i, 1);}
for (var i = 9 - n_length, j = 0; i < 9; i++, j++){
n_array[i] = received_n_array[j];}
for (var i = 0, j = 1; i < 9; i++, j++){
if(i == 0 || i == 2 || i == 4 || i == 7){
if(n_array[i] == 1){
n_array[j] = 10 + parseInt(n_array[j]);
n_array[i] = 0;}}}
value = '';
for (var i = 0; i < 9; i++){
if(i == 0 || i == 2 || i == 4 || i == 7){
value = n_array[i] * 10;} else {
value = n_array[i];}
if(value != 0){
words_string += words[value] + ' ';}
if((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Crores ';}
if((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Lakhs ';}
if((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Thousand ';}
if(i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)){
words_string += 'Hundred and ';} else if(i == 6 && value != 0){
words_string += 'Hundred ';}}
words_string = words_string.split(' ').join(' ');}
return words_string;}
n = document.getElementById("grandwords").value;

nums = n.toString().split('.')

var whole = Rs(nums[0])

if(nums[1]==null)nums[1]=0;

if(nums[1].length == 1 )nums[1]=nums[1]+'0';

if(nums[1].length> 2){
    nums[1]=nums[1].substring(2,length - 1)
}

if(nums.length == 2){
if(nums[0]<=9){
    nums[0]=nums[0]*10
} 
else {
    nums[0]=nums[0]
};

var fraction = Rs(nums[1])

if(whole=='' && fraction==''){
    op= 'Zero only';
}

if(whole=='' && fraction!=''){
    op= 'paise ' + fraction + ' only';
}

if(whole!='' && fraction==''){
    op='Rupees ' + whole + ' only';
}

if(whole!='' && fraction!=''){
    op='Rupees ' + whole + 'and paise ' + fraction + ' only';
}

amt=n;

if(amt > 999999999.99){
    op='Oops!!! The amount is too big to convert';
}

if(isNaN(amt) == true ){
    op='Error : Amount in number appears to be incorrect. Please Check.';
}

$('#grandwordsans').html(op);}
})
</script>
</td>
</tr>
</table>
</td>
<td width="27%" style="padding: 0px 0px 0px 6px  !important;">
<table width="100%">
<tr style="font-size:13px !important;">
<td width="43%"><b>Grand Total &nbsp;</b></td>
<td width="57%"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['grandtotal'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 13px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:40px !important;">
<td style="padding:0px !important;border-bottom: none;">
<table width="100%">
<tr>
<td width="30%" style="padding: 0px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<tr>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
    ?>
<td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;">
<div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;"><span>Printed On : <?php $dates = date('d-m-Y h:i:s');echo date($date,strtotime($dates))?></span></div>
<div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page <?=$begin.'/'.$begin?>)</b></div>
</td>
</tr>
</table>
</td>
<td width="40%" style="padding: 0px 6px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<?php
if ((in_array('Terms and Conditions', $fieldview))) {
?>
<tr>
<td style="font-size: 12px !important;">Terms and Conditions : <b><span style="display: inline-flex;white-space: nowrap;width: 171px;overflow: hidden;font-size: 12px !important;"><?=$rows[0]['terms']?></span></b></td>
</tr>
<?php
}
?>
</table>
</td>
<td width="30%" style="padding: 0px !important;">
<table width="100%">
<tr>
<td style="border:1px solid #cccccc; height:25px !important;width: 237px !important; text-align:center; vertical-align:bottom">
<?php
if($info['signimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Sign Pic" src="<?=str_replace('../ups','ups',$img)?>" id="sign-image1" style="width: 237px !important;height: 25px !important;">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>

    <?php
}
?>
</td>
</tr>
<tr>
<td style="text-align:center;line-height: 10px !important;"><span style="position: relative;top: 1px !important;font-size: 12px !important;">For <strong style="font-size:12px !important;"><?=$info['franchisename']?></strong></span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

</table>
<span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span>
</div>
</div>
<style type="text/css">
.insidecard{
    width: max-content !important;
    height: max-content !important;
}
    @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    zoom: 20% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    margin-left: -15px !important;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    zoom: 21% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    zoom: 22% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 300px) {
                #zoomforprint{
                    zoom: 23% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 301px) and (max-device-width: 310px) {
                #zoomforprint{
                    zoom: 25% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 78% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 311px) and (max-device-width: 320px) {
                #zoomforprint{
                    zoom: 27% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 81% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    zoom: 28% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 86% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 340px) {
                #zoomforprint{
                    zoom: 30% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 90% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 341px) and (max-device-width: 350px) {
                #zoomforprint{
                    zoom: 31% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 360px) {
                #zoomforprint{
                    zoom: 33% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 361px) and (max-device-width: 370px) {
                #zoomforprint{
                    zoom: 34% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 371px) and (max-device-width: 380px) {
                #zoomforprint{
                    zoom: 35% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 390px) {
                #zoomforprint{
                    zoom: 36% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 391px) and (max-device-width: 400px) {
                #zoomforprint{
                    zoom: 38% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 410px) {
                #zoomforprint{
                    zoom: 40% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 411px) and (max-device-width: 420px) {
                #zoomforprint{
                    zoom: 41% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 421px) and (max-device-width: 430px) {
                #zoomforprint{
                    zoom: 42% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 431px) and (max-device-width: 440px) {
                #zoomforprint{
                    zoom: 44% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 441px) and (max-device-width: 450px) {
                #zoomforprint{
                    zoom: 45% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 451px) and (max-device-width: 460px) {
                #zoomforprint{
                    zoom: 46% !important;
                    margin-left: -48px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 470px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -48px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 471px) and (max-device-width: 490px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -40px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -20px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 510px) {
                #zoomforprint{
                    zoom: 49% !important;
                    margin-left: -10px !important;
                }
                #templatetext{
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 511px) and (max-device-width: 530px) {
                #zoomforprint{
                    zoom: 49% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 531px) and (max-device-width: 540px) {
                #zoomforprint{
                    zoom: 50% !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 541px) and (max-device-width: 550px) {
                #zoomforprint{
                    zoom: 52% !important;
                }
                #templatetext{
                    margin-right: -3px !important;
                }
            }
            @media screen and (min-device-width: 551px) and (max-device-width: 560px) {
                #zoomforprint{
                    zoom: 53% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 561px) and (max-device-width: 570px) {
                #zoomforprint{
                    zoom: 54% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 571px) and (max-device-width: 580px) {
                #zoomforprint{
                    zoom: 55% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 581px) and (max-device-width: 590px) {
                #zoomforprint{
                    zoom: 56% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 591px) and (max-device-width: 600px) {
                #zoomforprint{
                    zoom: 57% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 610px) {
                #zoomforprint{
                    zoom: 58% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 611px) and (max-device-width: 620px) {
                #zoomforprint{
                    zoom: 59% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 621px) and (max-device-width: 767px) {
                #zoomforprint{
                    zoom: 61% !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 768px) and (max-device-width: 991px) {
                #zoomforprint{
                    zoom: 80% !important;
                }
            }
            @media screen and (min-device-width: 768.5px) and (max-device-width: 790px) {
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 830px) and (max-device-width: 991.7px) {
                #zoomforprint{
                    margin-left: 25px !important;
                }
            }
            @media screen and (min-device-width: 791px) and (max-device-width: 990.5px) {
                #templatetext{
                    margin-right: 25px !important;
                }
            }
            @media screen and (min-device-width: 992px) and (max-device-width: 1020px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -123px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1021px) and (max-device-width: 1199px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1220px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -111px !important;
                }
            }
            @media screen and (min-device-width: 1221px) and (max-device-width: 1250px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -100px !important;
                }
                #templatetext{
                    margin-right: -100px !important;
                }
            }
            @media screen and (min-device-width: 1251px) and (max-device-width: 1290px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -90px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1291px) and (max-device-width: 1330px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -80px !important;
                }
                #templatetext{
                    margin-right: -80px !important;
                }
            }
            @media screen and (min-device-width: 1331px) and (max-device-width: 1360px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -70px !important;
                }
                #templatetext{
                    margin-right: -70px !important;
                }
            }
            @media screen and (min-device-width: 1361px) and (max-device-width: 1400px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    margin-right: -60px !important;
                }
            }
            @media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: -54px !important;
                }
            }
            @media screen and (min-device-width: 1501px) and (max-device-width: 1549px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: -45px !important;
                }
            }
            @media screen and (min-device-width: 1550px) and (max-device-width: 3000px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: 27px !important;
                }
            }
</style>

<?php
}
elseif($info['proformatemplate']=='2')
{
?>
<div id="printalble">
<div class="table-responsive" style="width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;">
<table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 21cm !important;height: 14.8cm !important;max-width:21cm !important; max-height:14.8cm !important;min-width:21cm !important; min-height:14.8cm !important;">

<tr style="height:10px !important;">
<td style="border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td style="text-align:center;line-height: 15px !important;">
<b style="font-size:15px !important;display: inline-flex;white-space: nowrap;width: max-content;overflow: hidden;text-align: center;max-width: 166px;"><?= $infomainaccessuser['modulename'] ?></b>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:10px !important;">
<td style="">
<table width="100%">
<tr>
<td style="text-align:center;height: 80px !important;">
<table width="100%">
<tr>
<td width="35%" style="text-align:right;">
<?php
if($info['branchimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['branchimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Branch Pic" src="<?=str_replace('../ups','ups',$img)?>" id="branch-image1" height="80" width="80">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>
    <?php
}
?>
</td>
<td width="65%" style="text-align:left;vertical-align: top;padding-left: 30px !important;">
<table width="100%">
<tr style="padding:0px !important;">
<td style="">
<table width="100%" style="padding:0px !important;">
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;"><?=$info['franchisename']?></strong>
</td>
</tr>
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;margin-bottom: -3px;">
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;"><?=$info['street']?> <?=$info['city']?> <?=$info['pincode']?> <?=$info['state']?> <?=$info['country']?> </span>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td style="">
<table width="100%">
<tr style="<?=($access['proformabranchphone']=='0')?'display:none;':''?>">
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">Phone </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">: <span style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$info['mobile']?></span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;<?=($access['proformabranchemail']=='0')?'visibility:hidden;':''?>">E-mail </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><input type="text" readonly value=": <?=$info['email']?>" style="padding:0px;color:black;width: 206px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;<?=($access['proformabranchemail']=='0')?'visibility:hidden;':''?>" class="form-control form-control-sm"><span style="<?=(($access['proformaprintdlno20']=='1')?'display:inline-flex;':'display:none;')?>white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 20 &nbsp; : <?=$info['dlno20']?></span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;<?=($access['proformabranchgstin']=='0')?'visibility:hidden;':''?>">GSTIN </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><span style="display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;<?=($access['proformabranchgstin']=='0')?'visibility:hidden;':''?>">: <?=$info['gstno']?></span><span style="<?=(($access['proformaprintdlno21']=='1')?'display:inline-flex;':'display:none;')?>white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 21 &nbsp; : <?=$info['dlno21']?></span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;border: 1px solid #cccccc;">
<td style="padding: 0px !important;">
<table width="100%">
<tr>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;height: 98px !important;">
<table width="100%">
<tr style="background-color: #eee;">
<td style="padding: 0px !important;">
<strong style="padding:0px 6px !important;">Billing Address</strong>
</td>
</tr>
<tr>
<?php
if ($rows[0]['customername']!=''&&(in_array('Billing Name', $fieldview))) {
?>
<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;"><?=ucwords(strtolower($rows[0]['customername']))?></strong></td>
<?php
}
?>
</tr>
<tr>
<td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">
<?php
if ((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))) {
?>
<?php
if ((($rows[0]['area']!='')||($rows[0]['city']!=''))) {
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
    <?=ucwords(strtolower($rows[0]['area']))?> <?=((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'')?> <?=ucwords(strtolower($rows[0]['city']))?>
</span>
<br>
<?php
}
if ((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))) {
?>
<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=$rows[0]['state']?> <?=((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'')?> <?=$rows[0]['pincode']?> <?=((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'')?> <?=$rows[0]['district']?>
<!-- <br> -->
</span>
<?php
}
}
?>
</td>
</tr>
<tr>
<td style="padding: 0px !important;">
<table width="100%">
<tr <?=((in_array('Work Phone', $fieldview))?'':'style="display:none;"')?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Work Phone </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$rows[0]['workphone']?></b></td>
</tr>
<tr <?=((in_array('GSTIN', $fieldview))?'':'style="display:none;"')?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">GSTIN </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: 
<?php
if (($infomainaccessuser['proformaprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['proformaprintgstin']!='hide')) {
?>
<b style="font-size:12px;padding: 0px !important;display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;"><?=$rows[0]['gstno']?></b>
<?php
}
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;">
<table width="100%">
<tr style="background-color: #eee;">
<td style="padding: 0px !important;">
<strong style="padding:0px 6px !important;">Shipping Address</strong>
</td>
</tr>
<tr>
<?php
if ($rows[0]['customername']!=''&&(in_array('Shipping Name', $fieldview))) {
?>
<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;"><?=ucwords(strtolower($rows[0]['customername']))?></strong></td>
<?php
}
?>
</tr>
<tr>
<td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">
<?php
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))) {
?>
<?php
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!=''))){
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=ucwords(strtolower($rows[0]['sarea']))?> <?=((($rows[0]['sarea']!='')&&($rows[0]['scity']!=''))?',':'')?> <?=ucwords(strtolower($rows[0]['scity']))?>
</span>
<br>
<?php
}
if (($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!='')){
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=$rows[0]['sstate']?> <?=((($rows[0]['sstate']!='')&&($rows[0]['spincode']!=''))?',':'')?> <?=$rows[0]['spincode']?> <?=((($rows[0]['sstate']!='')&&($rows[0]['sdistrict']!='')||($rows[0]['spincode']!='')&&($rows[0]['sdistrict']!=''))?',':'')?> <?=$rows[0]['sdistrict']?>
<!-- <br> -->
</span>
<?php
}
}
?>
</td>
</tr>
<tr>
<td style="padding: 0px !important;">
<table width="100%">
<tr <?=(in_array('Mobile Phone', $fieldview))?'':'style="display:none;"'?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Mobile Phone </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$rows[0]['mobile']?></b></td>
</tr>
<tr <?=(in_array('Place of Supply', $fieldview))?'':'style="display:none;"'?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">Place Of Supply </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: 
<?php
if (($infomainaccessuser['proformaprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['proformaprintpos']!='hide')) {
?>
<b style="font-size:12px;padding:0px !important;display: inline-flex;white-space: nowrap;width: 150px;overflow: hidden;"><?=$rows[0]['pos']?></b>
<?php
}
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: middle;padding: 0px !important;">
<table width="100%" style="text-align: center !important;">
<?php
if ((in_array('Proforma Invoice Information', $fieldview))) {
?>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="<?= $infomainaccessuser['modulename'] ?>" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Number" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=$rows[0]['proformano']?></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="<?= $infomainaccessuser['modulename'] ?>" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Date" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
    ?>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=date($date,strtotime($rows[0]['proformadate']))?></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=$rows[0]['proformaterm']?></b></td>
</tr>
<?php
}
?>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;">
<td style="padding: 0px !important;">
<table width="100%">
<tr style="vertical-align: top !important;">
<td style="padding: 0px !important;height:176px !important;">
<div style="max-height: 176px !important;min-height: 176px !important;overflow: hidden;">
<table width="100%" style="border:1px solid #cccccc 0px 0px 0px !important;line-height: 13px !important;height: 176px;">
<thead style="background-color: #eee;">
<tr style="height:1px !important;">
<th width="20%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">ITEM DETAILS</th>
<th width="8%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;<?=(in_array('Product Category', $fieldview))?'':'display:none !important;'?>"><span style="display: block;overflow: hidden;max-width: 78px;max-height: 13px;"><?=$access['txtnamecategory']?></span></th>
<th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">BATCH</th>
<th width="<?=$widthforexp?>" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">EXPIRY</th>
<th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">HSN/SAC</th>
<th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;<?=(in_array('Product Mrp', $fieldview))?'':'display:none !important;'?>">MRP</th>
<th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">RATE</th>
<th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">QUANTITY</th>
<?php
if ((in_array('Taxable Value', $fieldview))) {
?>
<th width="5%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">GST%</th>
<?php
}
?>
<?php
if ((in_array('Tax Value', $fieldview))) {
?>
<th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">TAXABLE&nbsp;&nbsp;&nbsp;VALUE</th>
<?php
}
?>
</tr>
</thead>
<tbody>
<?php
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
?>
<tr style="height:13px !important;">
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;max-width: 350px !important;overflow: hidden;line-height: 18px;white-space: normal !important;"><span style="display: block;overflow: hidden;height: 19px;"><?=$row['productname']?></span><span style="display: block;overflow: hidden;height: 19px;"><?=$row['productdescription']?></span>
</td>
<td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=(in_array('Product Category', $fieldview))?'':'display:none !important;'?>">
<input type="text" readonly value="<?=(($row['manufacturer']!='')?$row['manufacturer']:'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm">    
</td>
<td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">
<input type="text" readonly value="<?=(($row['batch']!='')?$row['batch']:'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm">    
</td>
<td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">
<input type="text" readonly value="<?=(($row['expdate']!='')?date($dateforexp,strtotime($row['expdate'])):'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm">    
</td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;"><input type="text" readonly value="<?=(($row['producthsn']!='')?$row['producthsn']:'')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;<?=(in_array('Product Mrp', $fieldview))?'':'display:none !important;'?>"><input type="text" readonly value="<?=(($row['mrp']!='')?number_format((float)$row['mrp'],2,'.',''):'')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;"><input type="text" readonly value="<?=(($row['productrate']!='0')?(number_format((float)$row['productrate'],2,'.','')):'Free')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;"><input type="text" readonly value="<?=$row['quantity']?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
    <?php
if ((in_array('Taxable Value', $fieldview))) {
?>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;"><input type="text" readonly value="<?=(($row['vat']!='')?$row['vat'].'%':'')?>" style="padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
<?php
}
?>
<?php
if ((in_array('Tax Value', $fieldview))) {
?>
    <td style="border: 1px solid #cccccc;padding:0px 6px !important;text-align: right;"><input type="text" readonly value="<?=(($row['productvalue']!='0')?(number_format((float)$row['productvalue'],2,'.','')):'Free')?>" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>
<?php
}
?>
</tr>
<?php
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
$dateformat = mysqli_query($con,"select * from paricountry");$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {$dateforfooter = 'd/m/Y h:i:s';}
$dates = date('d-m-Y h:i:s');
$begin = (round(($item-1)/4));
$finish = (round(($totpros)/4));
if($info['branchimage']!=''){
$imgs=explode(',',$info['branchimage']);
foreach($imgs as $img){
}
$imgans = '<img alt="Branch Pic" src="'.str_replace('../ups','ups',$img).'" id="branch-image1" height="80" width="80">';
}
else{
$imgans ='';
};
$custname='';
if ($rows[0]['customername']!=''&&(in_array('Billing Name', $fieldview))) {
$custname = '<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;">'.ucwords(strtolower($rows[0]['customername'])).'</strong></td>';
}
if ($rows[0]['customername']!=''&&(in_array('Shipping Name', $fieldview))) {
$custname = '<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;">'.ucwords(strtolower($rows[0]['customername'])).'</strong></td>';
}
$bill1='';
$bill2='';
if ((($rows[0]['area']!='')||($rows[0]['city']!='')||($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))&&(in_array('Billing Address', $fieldview))) {
if ((($rows[0]['area']!='')||($rows[0]['city']!=''))) {
$bill1 = '<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">'.ucwords(strtolower($rows[0]['area'])).' '.((($rows[0]['area']!='')&&($rows[0]['city']!=''))?',':'').' '.ucwords(strtolower($rows[0]['city'])).'</span><br>';
}
if ((($rows[0]['state']!='')||($rows[0]['pincode']!='')||($rows[0]['district']!=''))) {
$bill2 = '<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">'.$rows[0]['state'].' '.((($rows[0]['state']!='')&&($rows[0]['pincode']!=''))?',':'').' '.$rows[0]['pincode'].' '.((($rows[0]['state']!='')&&($rows[0]['district']!='')||($rows[0]['pincode']!='')&&($rows[0]['district']!=''))?',':'').' '.$rows[0]['district'].'</span>';
}
}
$gstin ='';
if (($infomainaccessuser['proformaprintgstin']=='show')||($rows[0]['gstno']!='')&&($infomainaccessuser['proformaprintgstin']!='hide')) {
$gstin = '<b style="font-size:12px;padding: 0px !important;display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;">'.$rows[0]['gstno'].'</b>';
}
$ship1='';
$ship2='';
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!='')||($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))&&(in_array('Shipping Address', $fieldview))) {
if ((($rows[0]['sarea']!='')||($rows[0]['scity']!=''))) {
$ship1 = '<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">'.ucwords(strtolower($rows[0]['sarea'])).' '.((($rows[0]['sarea']!='')&&($rows[0]['scity']!=''))?',':'').' '.ucwords(strtolower($rows[0]['scity'])).'</span><br>';
}
if ((($rows[0]['sstate']!='')||($rows[0]['spincode']!='')||($rows[0]['sdistrict']!=''))) {
$ship2 = '<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">'.$rows[0]['sstate'].' '.((($rows[0]['sstate']!='')&&($rows[0]['spincode']!=''))?',':'').' '.$rows[0]['spincode'].' '.((($rows[0]['sstate']!='')&&($rows[0]['sdistrict']!='')||($rows[0]['spincode']!='')&&($rows[0]['sdistrict']!=''))?',':'').' '.$rows[0]['sdistrict'].'</span>';
}
}
$pos ='';
if (($infomainaccessuser['proformaprintpos']=='show')||($rows[0]['pos']!='')&&($infomainaccessuser['proformaprintpos']!='hide')) {
$pos = '<b style="font-size:12px;padding:0px !important;display: inline-flex;white-space: nowrap;width: 150px;overflow: hidden;">'.$rows[0]['pos'].'</b>';
}
$proforma='';
if ((in_array('Proforma Invoice Information', $fieldview))) {
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {$date = 'd/m/Y';}
$proforma = '<tr><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="'. $infomainaccessuser['modulename'] .'" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Number" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.$rows[0]['proformano'].'</b></td></tr><tr><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="'. $infomainaccessuser['modulename'] .'" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Date" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.date($date,strtotime($rows[0]['proformadate'])).'</b></td></tr><tr><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td><td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.$rows[0]['proformaterm'].'</b></td></tr>';
}
$taxable ='';
$tax ='';
if ((in_array('Taxable Value', $fieldview))) {
$taxable = '<th width="5%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">GST%</th>';
}
if ((in_array('Tax Value', $fieldview))) {
$tax = '<th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">TAXABLE&nbsp;&nbsp;&nbsp;VALUE</th>';
}
$merge = '</tbody></table></div></td></tr></table></td></tr><tr><td><div style="min-height:92px !important;max-height:92px !important;"><div></td></tr><tr><td><div style="min-height:25px !important;max-height:25px !important;padding: 0px !important;"><div></td></tr><tr style="height:40px !important;"><td style="padding:0px !important;border-bottom: none;"><table width="100%"><tr><td width="30%" style="padding: 0px !important;border-right: 1px solid #cccccc;"><table width="100%"><tr><td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;"><div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;"><span>Printed On :'.date($dateforfooter,strtotime($dates)).'</span></div><div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page '.$begin.'/'.$finish.')</b></div></td></tr></table></td></tr></table></td></tr></table><span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span></div><div class="table-responsive" style="margin-top:0.75rem;width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;"><table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 21cm !important;height: 14.8cm !important;max-width:21cm !important; max-height:14.8cm !important;min-width:21cm !important; min-height:14.8cm !important;"><tr style="height:10px !important;"><td style="border-bottom: 1px solid #cccccc;"><table width="100%"><tr><td style="text-align:center;line-height: 13px !important;"><b style="font-size:15px !important;display: inline-flex;white-space: nowrap;width: max-content;overflow: hidden;text-align: center;max-width: 166px;">'.$infomainaccessuser['modulename'].'</b></td></tr></table></td></tr><tr style="height:10px !important;"><td style=""><table width="100%"><tr><td style="text-align:center;height: 80px !important;"><table width="100%"><tr><td width="35%" style="text-align:right;">'.$imgans.'</td><td width="65%" style="text-align:left;vertical-align: top;padding-left: 30px !important;"><table width="100%"><tr style="padding:0px !important;"><td style=""><table width="100%" style="padding:0px !important;"><tr style="padding:0px !important;"><td style="padding:0px !important;line-height: 15px !important;"><strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.$info['franchisename'].'</strong></td></tr><tr style="padding:0px !important;"><td style="padding:0px !important;line-height: 15px !important;margin-bottom: -3px;"><span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;">'.$info['street'].' '.$info['city'].' '.$info['pincode'].' '.$info['state'].' '.$info['country'].'</span></td></tr></table></td></tr><tr><td style=""><table width="100%"><tr style="'.(($access['proformabranchphone']=='0')?'display:none;':'').'"><td width="10%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">Phone </td><td width="90%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">: <span style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$info['mobile'].'</span></td></tr><tr><td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;'.(($access['proformabranchemail']=='0')?'visibility:hidden;':'').'">E-mail </td><td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><input type="text" readonly value=": '.$info['email'].'" style="padding:0px;color:black;width: 206px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;'.(($access['proformabranchemail']=='0')?'visibility:hidden;':'').'" class="form-control form-control-sm"><span style="'.(($access['proformaprintdlno20']=='1')?'display:inline-flex;':'display:none;').'white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 20 &nbsp; : '.$info['dlno20'].'</span></td></tr><tr><td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;'.(($access['proformabranchgstin']=='0')?'visibility:hidden;':'').'">GSTIN </td><td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><span style="display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;'.(($access['proformabranchgstin']=='0')?'visibility:hidden;':'').'">: '.$info['gstno'].'</span><span style="'.(($access['proformaprintdlno21']=='1')?'display:inline-flex;':'display:none;').'white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 21 &nbsp; : '.$info['dlno21'].'</span></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr><tr style="height:1px !important;border: 1px solid #cccccc;"><td style="padding: 0px !important;"><table width="100%"><tr><td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;height: 98px !important;"><table width="100%"><tr style="background-color: #eee;"><td style="padding: 0px !important;"><strong style="padding:0px 6px !important;">Billing Address</strong></td></tr><tr>'.$custname.'</tr><tr><td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">'.$bill1.$bill2.'</td>
</tr><tr><td style="padding: 0px !important;"><table width="100%"><tr '.(((in_array('Work Phone', $fieldview))?'':'style="display:none;"')).'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Work Phone </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$rows[0]['workphone'].'</b></td></tr><tr '.(((in_array('GSTIN', $fieldview))?'':'style="display:none;"')).'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">GSTIN </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">:'.$gstin.'</td></tr></table></td></tr></table></td><td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;"><table width="100%"><tr style="background-color: #eee;"><td style="padding: 0px !important;"><strong style="padding:0px 6px !important;">Shipping Address</strong></td></tr><tr>'.$custname.'</tr><tr><td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">'.$ship1.$ship2.'</td></tr><tr><td style="padding: 0px !important;"><table width="100%"><tr '.((in_array('Mobile Phone', $fieldview))?'':'style="display:none;"').'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Mobile Phone </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$rows[0]['mobile'].'</b></td></tr><tr '.((in_array('Place of Supply', $fieldview))?'':'style="display:none;"').'><td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">Place Of Supply </td><td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: '.$pos.'</td></tr></table></td></tr></table></td><td width="33%" style="white-space: normal !important;vertical-align: middle;padding: 0px !important;"><table width="100%" style="text-align: center !important;">'.$proforma.'</table></td></tr></table></td></tr><tr style="height:1px !important;"><td style="padding: 0px !important;"><table width="100%"><tr style="vertical-align: top !important;"><td style="padding: 0px !important;height:176px !important;"><div style="max-height: 176px !important;min-height: 176px !important;overflow: hidden;"><table width="100%" style="border:1px solid #cccccc 0px 0px 0px !important;line-height: 13px !important;height: 176px;"><thead style="background-color: #eee;"><tr style="height:1px !important;"><th width="20%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">ITEM DETAILS</th><th width="8%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;'.((in_array('Product Category', $fieldview))?'':'display:none !important;').'"><span style="display: block;overflow: hidden;max-width: 78px;max-height: 13px;">'.$access['txtnamecategory'].'</span></th><th width="10%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">BATCH</th><th width="'.$widthforexp.'" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;'.(($access['batchexpiryval']=='1')?'':'display:none !important;').'">EXPIRY</th><th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;">HSN/SAC</th><th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align:right !important;'.((in_array('Product Mrp', $fieldview))?'':'display:none !important;').'">MRP</th><th width="9%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">RATE</th><th width="7%" style="border: 1px solid #cccccc;font-size: 12px !important;padding:0px 6px !important;text-align: right !important;">QUANTITY</th>'.$taxable.$tax.'</tr></thead><tbody>';
$finalrow=4;
if ((($item-1)%$finalrow)==0) {
if ((($countt-1)-$totpros)!=0) {
echo $merge;
}
}
}
if(($totpros%$finalrow)!=0){
?>
<tr>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=(in_array('Product Category', $fieldview))?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=($access['batchexpiryval']=='1')?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<td style="border: 1px solid #cccccc;<?=(in_array('Product Mrp', $fieldview))?'':'display:none !important;'?>">&nbsp;</td>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<?php
if ((in_array('Taxable Value', $fieldview))) {
?>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<?php
}
?>
<?php
if ((in_array('Tax Value', $fieldview))) {
?>
<td style="border: 1px solid #cccccc;">&nbsp;</td>
<?php
}
?>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:92px !important;">
<td style="padding:0px !important;border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td width="22%" style="padding:0px 6px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<tr style="text-align:left;">
<td width="50%" style="padding:0px !important;">Total Items</td>
<td width="50%" style="padding:0px !important;">: <b><?=$rows[0]['totalitems']?></b></td>
</tr>
<tr style="text-align:left;<?=((in_array('Prepared By', $fieldview))?'':'display:none;')?>">
<td width="50%" style="padding:0px !important;">Prepared By</td>
<td width="50%" style="padding:0px !important;">: <b style="display:inline-flex;max-width: 72px;overflow: hidden;"><?=$rows[0]['preparedby']?></b></td>
</tr>
<tr style="text-align:left;<?=((in_array('Checked By', $fieldview))?'':'display:none;')?>">
<td width="50%" style="padding:0px !important;">Checked By</td>
<td width="50%" style="padding:0px !important;">: <b style="display:inline-flex;max-width: 72px;overflow: hidden;"><?=$rows[0]['checkedby']?></b></td>
</tr>
</table>
</td>
<td width="51%" style="padding:0px 6px !important;">
<table width="100%" style="padding:0px !important;">
<?php
if ((in_array('Tax Table', $fieldview))) {
?>
<tr>
<td style="padding: 0px !important;">
<table width="100%" style="line-height: 13px !important;padding: 0px !important;border: 1px solid #cccccc;border-collapse: collapse;">
<tr style="padding:0px !important;background-color: #eee;" class="text-uppercase">
<td width="28%" style="font-weight:normal !important;border-right: 1px solid #cccccc;border-bottom:1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;"><b>TAXABLE&nbsp;&nbsp;&nbsp;VALUE <span class="rupeeforprint"><?=$rescurrency[0]?></span></b></td>
<td colspan="2" width="12%" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;"><b>CGST</b></td>
<td colspan="2" width="12%" style="font-weight:normal !important;border-right: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: center !important;border-bottom: 1px solid #cccccc;"><b>SGST</b></td>
<td colspan="2" width="12%" style="font-weight:normal !important;font-size: 10px !important;padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center !important;border-bottom: 1px solid #cccccc;"><b>GST</b></td>
</tr>
<tbody style="font-size:10px !important;">
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['tax25']!='0')?number_format((float)$rows[0]['tax25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst25']!='0')?number_format((float)$rows[0]['cgst25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
2.5%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst25']!='0')?number_format((float)$rows[0]['sgst25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
5%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst25']!='0'&&$rows[0]['sgst25']!='0')?number_format((float)$rows[0]['gst25'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;"><input type="text" readonly value="<?=($rows[0]['tax6']!='0')?number_format((float)$rows[0]['tax6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst6']!='0')?number_format((float)$rows[0]['cgst6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
6%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst6']!='0')?number_format((float)$rows[0]['sgst6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
12%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst6']!='0'&&$rows[0]['sgst6']!='0')?number_format((float)$rows[0]['gst6'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['tax9']!='0')?number_format((float)$rows[0]['tax9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst9']!='0')?number_format((float)$rows[0]['cgst9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
9%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst9']!='0')?number_format((float)$rows[0]['sgst9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
18%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst9']!='0'&&$rows[0]['sgst9']!='0')?number_format((float)$rows[0]['gst9'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td style="border-right: 1px solid #cccccc;border-bottom: 1px solid #cccccc;font-size: 10px !important;padding: 0px 6px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['tax14']!='0')?number_format((float)$rows[0]['tax14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst14']!='0')?number_format((float)$rows[0]['cgst14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;padding-right: 15px;">
14%
</td>
<td style="border-right: 1px solid #cccccc;padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['sgst14']!='0')?number_format((float)$rows[0]['sgst14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;border-right: 1px solid #cccccc;text-align: right !important;padding-right: 15px;">
28%
</td>
<td style="padding: 0px 6px !important;border-bottom: 1px solid #cccccc;font-size: 10px !important;text-align: right !important;">
<input type="text" readonly value="<?=($rows[0]['cgst14']!='0'&&$rows[0]['sgst14']!='0')?number_format((float)$rows[0]['gst14'],2,'.',''):'0.00'?>" style="text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm">
</td>
</tr>
<tr>
<td colspan="5" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b>Total Tax</b></td>
<td colspan="2" style="border:1px solid #cccccc;text-align: right;border-bottom: 0px !important;font-size: 10px !important;padding: 0px 6px !important;"><b><span style="margin-right:-3px !important;font-size: 10px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['totalvatamount'],2,'.','')?>" style="width:90%;text-align: right;padding:0px;color:black;height: 15px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 10px;" class="form-control form-control-sm"></b></td>
</tr>
</tbody>
</table>
</td>
</tr>
<?php
}
?>
</table>
</td>
<td width="27%" style="padding: 0px 0px 0px 6px  !important;border-left: 1px solid #cccccc;vertical-align: top;">
<table width="100%">
<tr>
<td width="43%">Sub Total &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['totalamount'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td width="43%">Discount &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['discountamount'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td width="43%">Total Tax &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['totalvatamount'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td width="43%">Round Off &nbsp;</td>
<td width="57%" style="font-size: 12px !important;"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['roundoff'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 12px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:25px !important;padding: 0px !important;">
<td style="padding:0px !important;border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td width="73%" style="padding: 0px 6px !important;border-right: 1px solid #cccccc;text-align: center;max-width:565px !important;width:565px !important;overflow: hidden;">
<table width="100%">
<tr>
<td style="white-space: nowrap !important;"><b><span>Grand Total In Words : </span><span style="overflow: hidden !important;padding: 0px 6px !important;" id="grandwordsans"> Rupees One Crores Forty Five Lakhs Sixty Seven Thousand Eight Hundred Eight only</span></b>
<input type="number" id="grandwords" value="<?=number_format((float)$rows[0]['grandtotal'],2,'.','')?>" style="display: none;">
<script>
$(document).ready(function() {
function Rs(amount){
var words = new Array();
words[0] = 'Zero';words[1] = 'One';words[2] = 'Two';words[3] = 'Three';words[4] = 'Four';words[5] = 'Five';words[6] = 'Six';words[7] = 'Seven';words[8] = 'Eight';words[9] = 'Nine';words[10] = 'Ten';words[11] = 'Eleven';words[12] = 'Twelve';words[13] = 'Thirteen';words[14] = 'Fourteen';words[15] = 'Fifteen';words[16] = 'Sixteen';words[17] = 'Seventeen';words[18] = 'Eighteen';words[19] = 'Nineteen';words[20] = 'Twenty';words[30] = 'Thirty';words[40] = 'Forty';words[50] = 'Fifty';words[60] = 'Sixty';words[70] = 'Seventy';words[80] = 'Eighty';words[90] = 'Ninety';var op;
amount = amount.toString();
var atemp = amount.split('.');
var number = atemp[0].split(',').join('');
var n_length = number.length;
var words_string = '';
if(n_length <= 9){
var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
var received_n_array = new Array();
for (var i = 0; i < n_length; i++){
received_n_array[i] = number.substr(i, 1);}
for (var i = 9 - n_length, j = 0; i < 9; i++, j++){
n_array[i] = received_n_array[j];}
for (var i = 0, j = 1; i < 9; i++, j++){
if(i == 0 || i == 2 || i == 4 || i == 7){
if(n_array[i] == 1){
n_array[j] = 10 + parseInt(n_array[j]);
n_array[i] = 0;}}}
value = '';
for (var i = 0; i < 9; i++){
if(i == 0 || i == 2 || i == 4 || i == 7){
value = n_array[i] * 10;} else {
value = n_array[i];}
if(value != 0){
words_string += words[value] + ' ';}
if((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Crores ';}
if((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Lakhs ';}
if((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)){
words_string += 'Thousand ';}
if(i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)){
words_string += 'Hundred and ';} else if(i == 6 && value != 0){
words_string += 'Hundred ';}}
words_string = words_string.split(' ').join(' ');}
return words_string;}
n = document.getElementById("grandwords").value;

nums = n.toString().split('.')

var whole = Rs(nums[0])

if(nums[1]==null)nums[1]=0;

if(nums[1].length == 1 )nums[1]=nums[1]+'0';

if(nums[1].length> 2){
    nums[1]=nums[1].substring(2,length - 1)
}

if(nums.length == 2){
if(nums[0]<=9){
    nums[0]=nums[0]*10
} 
else {
    nums[0]=nums[0]
};

var fraction = Rs(nums[1])

if(whole=='' && fraction==''){
    op= 'Zero only';
}

if(whole=='' && fraction!=''){
    op= 'paise ' + fraction + ' only';
}

if(whole!='' && fraction==''){
    op='Rupees ' + whole + ' only';
}

if(whole!='' && fraction!=''){
    op='Rupees ' + whole + 'and paise ' + fraction + ' only';
}

amt=n;

if(amt > 999999999.99){
    op='Oops!!! The amount is too big to convert';
}

if(isNaN(amt) == true ){
    op='Error : Amount in number appears to be incorrect. Please Check.';
}

$('#grandwordsans').html(op);}
})
</script>
</td>
</tr>
</table>
</td>
<td width="27%" style="padding: 0px 0px 0px 6px  !important;">
<table width="100%">
<tr style="font-size:13px !important;">
<td width="43%"><b>Grand Total &nbsp;</b></td>
<td width="57%"> : <b><span style="margin-right:-3px !important;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=number_format((float)$rows[0]['grandtotal'],2,'.','')?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 13px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:40px !important;">
<td style="padding:0px !important;border-bottom: none;">
<table width="100%">
<tr>
<td width="30%" style="padding: 0px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<tr>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
    ?>
<td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;">
<div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;"><span>Printed On : <?php $dates = date('d-m-Y h:i:s');echo date($date,strtotime($dates))?></span></div>
<div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page <?=$begin.'/'.$begin?>)</b></div>
</td>
</tr>
</table>
</td>
<td width="40%" style="padding: 0px 6px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<?php
if ((in_array('Terms and Conditions', $fieldview))) {
?>
<tr>
<td style="font-size: 12px !important;">Terms and Conditions : <b><span style="display: inline-flex;white-space: nowrap;width: 171px;overflow: hidden;font-size: 12px !important;"><?=$rows[0]['terms']?></span></b></td>
</tr>
<?php
}
?>
</table>
</td>
<td width="30%" style="padding: 0px !important;">
<table width="100%">
<tr>
<td style="border:1px solid #cccccc; height:25px !important;width: 237px !important; text-align:center; vertical-align:bottom">
<?php
if($info['signimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$info['signimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Sign Pic" src="<?=str_replace('../ups','ups',$img)?>" id="sign-image1" style="width: 237px !important;height: 25px !important;">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>

    <?php
}
?>
</td>
</tr>
<tr>
<td style="text-align:center;line-height: 10px !important;"><span style="position: relative;top: 1px !important;font-size: 12px !important;">For <strong style="font-size:12px !important;"><?=$info['franchisename']?></strong></span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

</table>
<span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span>
</div>
</div>
<style type="text/css">
.insidecard{
    width: max-content !important;
    height: max-content !important;
}
    @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    zoom: 20% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 60% !important;
                    margin-left: -15px !important;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    zoom: 21% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 60% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    zoom: 22% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 300px) {
                #zoomforprint{
                    zoom: 23% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 301px) and (max-device-width: 310px) {
                #zoomforprint{
                    zoom: 25% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 75% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 311px) and (max-device-width: 320px) {
                #zoomforprint{
                    zoom: 27% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 78% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    zoom: 28% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 84% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 340px) {
                #zoomforprint{
                    zoom: 30% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 88% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 341px) and (max-device-width: 350px) {
                #zoomforprint{
                    zoom: 31% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 90% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 360px) {
                #zoomforprint{
                    zoom: 33% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 93% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 361px) and (max-device-width: 370px) {
                #zoomforprint{
                    zoom: 34% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 371px) and (max-device-width: 380px) {
                #zoomforprint{
                    zoom: 35% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 390px) {
                #zoomforprint{
                    zoom: 36% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 391px) and (max-device-width: 400px) {
                #zoomforprint{
                    zoom: 38% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 410px) {
                #zoomforprint{
                    zoom: 40% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 411px) and (max-device-width: 420px) {
                #zoomforprint{
                    zoom: 41% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 421px) and (max-device-width: 430px) {
                #zoomforprint{
                    zoom: 42% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 431px) and (max-device-width: 440px) {
                #zoomforprint{
                    zoom: 44% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 441px) and (max-device-width: 450px) {
                #zoomforprint{
                    zoom: 45% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 451px) and (max-device-width: 460px) {
                #zoomforprint{
                    zoom: 46% !important;
                    margin-left: -48px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 470px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -48px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 471px) and (max-device-width: 490px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -40px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -20px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 510px) {
                #zoomforprint{
                    zoom: 49% !important;
                    margin-left: -10px !important;
                }
                #templatetext{
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 511px) and (max-device-width: 530px) {
                #zoomforprint{
                    zoom: 49% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 531px) and (max-device-width: 540px) {
                #zoomforprint{
                    zoom: 50% !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 541px) and (max-device-width: 550px) {
                #zoomforprint{
                    zoom: 52% !important;
                }
                #templatetext{
                    margin-right: -3px !important;
                }
            }
            @media screen and (min-device-width: 551px) and (max-device-width: 560px) {
                #zoomforprint{
                    zoom: 53% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 561px) and (max-device-width: 570px) {
                #zoomforprint{
                    zoom: 54% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 571px) and (max-device-width: 580px) {
                #zoomforprint{
                    zoom: 55% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 581px) and (max-device-width: 590px) {
                #zoomforprint{
                    zoom: 56% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 591px) and (max-device-width: 600px) {
                #zoomforprint{
                    zoom: 57% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 610px) {
                #zoomforprint{
                    zoom: 58% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 611px) and (max-device-width: 620px) {
                #zoomforprint{
                    zoom: 59% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 621px) and (max-device-width: 767px) {
                #zoomforprint{
                    zoom: 61% !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 768px) and (max-device-width: 991px) {
                #zoomforprint{
                    zoom: 80% !important;
                }
            }
            @media screen and (min-device-width: 768.5px) and (max-device-width: 790px) {
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 830px) and (max-device-width: 991.7px) {
                #zoomforprint{
                    margin-left: 25px !important;
                }
            }
            @media screen and (min-device-width: 791px) and (max-device-width: 990.5px) {
                #templatetext{
                    margin-right: 25px !important;
                }
            }
            @media screen and (min-device-width: 992px) and (max-device-width: 1020px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -123px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1021px) and (max-device-width: 1199px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1220px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -111px !important;
                }
            }
            @media screen and (min-device-width: 1221px) and (max-device-width: 1250px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -100px !important;
                }
                #templatetext{
                    margin-right: -100px !important;
                }
            }
            @media screen and (min-device-width: 1251px) and (max-device-width: 1290px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -90px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1291px) and (max-device-width: 1330px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -80px !important;
                }
                #templatetext{
                    margin-right: -80px !important;
                }
            }
            @media screen and (min-device-width: 1331px) and (max-device-width: 1360px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -70px !important;
                }
                #templatetext{
                    margin-right: -70px !important;
                }
            }
            @media screen and (min-device-width: 1361px) and (max-device-width: 1400px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    margin-right: -60px !important;
                }
            }
            @media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: -54px !important;
                }
            }
            @media screen and (min-device-width: 1501px) and (max-device-width: 1549px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: -45px !important;
                }
            }
            @media screen and (min-device-width: 1550px) and (max-device-width: 3000px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: 27px !important;
                }
            }
</style>
<?php
}
?>


               
            </div>
            
            
            
            
             <p align="right" class="mt-3" style="margin-right:-25px; cursor:pointer" id="templatetext">Template: '<?=($info['proformatemplate']=='1')?'24.13cm X 15.75cm':''?><?=($info['proformatemplate']=='0')?'Standard A4 Portrait':''?><?=($info['proformatemplate']=='2')?'Standard A5 Landscape':''?> ' <a data-bs-toggle="modal" data-bs-target="#changeproformaModal" class="text-blue">Change</a></p>
             </div>
        
        
     

<!-- Modal -->
<div class="modal fade" id="changeproformaModal" tabindex="-1" role="dialog" aria-labelledby="changeproformaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changeproformaModalLabel">Choose Template</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <!-------------->
      
<table width="100%">
<tr>
<td width="30%" style="text-align:center">
 <div class="imgcontainer" id="standardcontainer">
  <img src="standard.png" id="standardimg" alt="Snow" onclick="standandclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered" id="standardtext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">Standard A4 Portrait</p>
</td>
<td width="30%" style="text-align:center" id="webprintdesign">
 <div class="imgcontainer" id="standardcontainer">
  <img src="advanced.png" id="standardafiveimg" alt="Snow" onclick="standardafiveclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered" id="standardafivetext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">Standard A5 Landscape</p>
</td>
<td width="30%" style="text-align:center" id="webprintdesign">
 <div class="imgcontainer" id="standardcontainer">
  <img src="advanced.png" id="advancedimg" alt="Snow" onclick="advancedclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered" id="advancedtext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">24.13cm X 15.75cm</p>
</td>
</tr>
<tr id="mobprintdesign" style="display: none;">
<td width="30%" style="text-align:center">
 <div class="imgcontainer" id="standardcontainer">
  <img src="advanced.png" id="standardafiveimg" alt="Snow" onclick="standardafiveclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered" id="standardafivetext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">Standard A5 Landscape</p>
</td>
</tr>
<tr id="mobprintdesign" style="display: none;">
<td width="30%" style="text-align:center">
 <div class="imgcontainer" id="standardcontainer">
  <img src="advanced.png" id="advancedimg" alt="Snow" onclick="advancedclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered" id="advancedtext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">24.13cm X 15.75cm</p>
</td>
</tr>
</table>

<script>
function standandclick()
{
    $("#standardafivetext").css('display','none');
    $("#advancedtext").css('display','none');
    $("#standardtext").css('display','block');
    $("#standardafiveimg").css('border','none');
    $("#standardimg").css('border','1px solid #1BBC9B');
    $("#advancedimg").css('border','none'); 
    $("#standardafiveimg").css('opacity','1');
    $("#standardimg").css('opacity','0.5');
    $("#advancedimg").css('opacity','1');   
    setTimeout(function() {
var r = confirm('Are you sure want to Change this Template?');
if (r == true) {
    window.location.href='changetemplate.php?template=proforma&no=<?=$proformano?>&date=<?=$proformadate?>&temptype=0&submt=submt';
} else {
   
}
}, 100);
}
</script>

<script>
function standardafiveclick()
{
    $("#advancedtext").css('display','none');
    $("#standardtext").css('display','none');
    $("#standardafivetext").css('display','block');
    $("#standardimg").css('border','none');
    $("#advancedimg").css('border','none');
    $("#standardafiveimg").css('border','1px solid #1BBC9B'); 
    $("#standardimg").css('opacity','1');
    $("#advancedimg").css('opacity','1');
    $("#standardafiveimg").css('opacity','0.5'); 
    setTimeout(function() {
var r = confirm('Are you sure want to Change this Template?');
if (r == true) {
    window.location.href='changetemplate.php?template=proforma&no=<?=$proformano?>&date=<?=$proformadate?>&temptype=2&submt=submt';
} else {
   
}
}, 100);
}
</script>

<script>
function advancedclick()
{
    $("#standardafivetext").css('display','none');
    $("#standardtext").css('display','none');
    $("#advancedtext").css('display','block');
    $("#standardafiveimg").css('border','none');
    $("#advancedimg").css('border','1px solid #1BBC9B');
    $("#standardimg").css('border','none'); 
    $("#standardafiveimg").css('opacity','1');
    $("#advancedimg").css('opacity','0.5');
    $("#standardimg").css('opacity','1');   
    setTimeout(function() {
var r = confirm('Are you sure want to Change this Template?');
if (r == true) {
    window.location.href='changetemplate.php?template=proforma&no=<?=$proformano?>&date=<?=$proformadate?>&temptype=1&submt=submt';
} else {
   
}
}, 100);
}
<?php
if($info['proformatemplate']=='1')
{
    ?>
     $("#standardafivetext").css('display','none');
    $("#standardtext").css('display','none');
    $("#advancedtext").css('display','block');
    $("#standardafiveimg").css('border','none');
    $("#advancedimg").css('border','1px solid #1BBC9B');
    $("#standardimg").css('border','none'); 
    $("#standardafiveimg").css('opacity','1');
    $("#advancedimg").css('opacity','0.5');
    $("#standardimg").css('opacity','1');   
    <?php
}
elseif($info['proformatemplate']=='0')
{
    ?>
    $("#standardafivetext").css('display','none');
    $("#advancedtext").css('display','none');
    $("#standardtext").css('display','block');
    $("#standardafiveimg").css('border','none');
    $("#standardimg").css('border','1px solid #1BBC9B');
    $("#advancedimg").css('border','none'); 
    $("#standardafiveimg").css('opacity','1');
    $("#standardimg").css('opacity','0.5');
    $("#advancedimg").css('opacity','1');   
    <?php
}
else{
?>
    $("#advancedtext").css('display','none');
    $("#standardtext").css('display','none');
    $("#standardafivetext").css('display','block');
    $("#standardimg").css('border','none');
    $("#advancedimg").css('border','none');
    $("#standardafiveimg").css('border','1px solid #1BBC9B'); 
    $("#standardimg").css('opacity','1');
    $("#advancedimg").css('opacity','1');
    $("#standardafiveimg").css('opacity','0.5'); 
<?php
}
?>
</script>

      <!-------------->
      </div>
      <div class="modal-footer" style="margin-top: 33px !important;">
          <a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>
          
      </div>
    </div>
  </div>
</div>
      
            
            
            
            
            
        </div>
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
 </div> 
 <?php
}
 else
 {
     ?>
     <div class="alert alert-danger text-white">
     No Data Found
     </div>
     <?php
 }
 }
 else
 {
     ?>
     <div class="alert alert-danger text-white">
     No Information
     </div>
     <?php
 }
?> 
  <?php
  include('footer.php');
  ?>
</div>
</main>
 <?php
 include('fexternals.php');
 ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<?php
if($info['proformatemplate']=='0')
{
    ?>
<script>

function converHTMLFileToPDF() {
$('#pdfObj').html('<div class="text-center"><span id="timer">Please wait <span id="time"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');
// ajax for get
$.ajax({
type: "GET",
url: 'proformadompdf.php?term=proforma&names=Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>&proformano=<?=$_GET['proformano']?>&proformadate=<?=$_GET['proformadate']?>&sizes=a4',
success: function (result) {
if (result && result.length > 0) {       
result=$.parseJSON( result );
Timer=result.timer;
}
$("#time").html(Timer);
 var req = new XMLHttpRequest();
  req.open("GET", "dompdf/Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>.pdf", true);
  req.responseType = "blob";

  req.onload = function (event) {
    var blob = req.response;
    console.log(blob.size);
    url=URL.createObjectURL(blob);
    obj = '<object id="pdfObjObj" data="'+url+'" type="application/pdf" width="90%" height="550"></object>';
    $('#pdfObj').html(obj)        
  };

  req.send();
},
error: function (error) {
alert(error);
}
});
// it is done
}

</script>
<script>

function downloadpdf() {
$("#exampleModaldownload").modal("show");
$('#pdfObjdownload').html('<div class="text-center"><span id="timerdownload">Please wait <span id="timedownload"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');
    // ajax for get
$.ajax({
type: "GET",
url: 'proformadompdf.php?term=proforma&names=Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>&proformano=<?=$_GET['proformano']?>&proformadate=<?=$_GET['proformadate']?>&sizes=a4',
success: function (result) {
if (result && result.length > 0) {       
result=$.parseJSON( result );
Timer=result.timer;
}
$("#timedownload").html(Timer);
 var req = new XMLHttpRequest();
  req.open("GET", "dompdf/Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>.pdf", true);
  req.responseType = "blob";

  req.onload = function (event) {
    var blob = req.response;
    console.log(blob.size);
    var link=document.createElement('a');
    link.href=window.URL.createObjectURL(blob);
    link.download="Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>.pdf";
    link.click();
  };

  req.send();
$("#exampleModaldownload").modal("hide");
alert("Pdf Downloaded Successfully");
},
error: function (error) {
alert(error);
}
});
// it is done
}

</script>
<?php
}
?>
<?php
if($info['proformatemplate']=='2')
{
    ?>
<script>

function converHTMLFileToPDF() {
$('#pdfObj').html('<div class="text-center"><span id="timer">Please wait <span id="time"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');
// ajax for get
$.ajax({
type: "GET",
url: 'proformadompdf.php?term=proforma&names=Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>&proformano=<?=$_GET['proformano']?>&proformadate=<?=$_GET['proformadate']?>&sizes=a5',
success: function (result) {
if (result && result.length > 0) {       
result=$.parseJSON( result );
Timer=result.timer;
}
$("#time").html(Timer);
 var req = new XMLHttpRequest();
  req.open("GET", "dompdf/Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>.pdf", true);
  req.responseType = "blob";

  req.onload = function (event) {
    var blob = req.response;
    console.log(blob.size);
    url=URL.createObjectURL(blob);
    obj = '<object id="pdfObjObj" data="'+url+'" type="application/pdf" width="90%" height="550"></object>';
    $('#pdfObj').html(obj)        
  };

  req.send();
},
error: function (error) {
alert(error);
}
});
// it is done
}

</script>
<script>

function downloadpdf() {
$("#exampleModaldownload").modal("show");
$('#pdfObjdownload').html('<div class="text-center"><span id="timerdownload">Please wait <span id="timedownload"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');
    // ajax for get
$.ajax({
type: "GET",
url: 'proformadompdf.php?term=proforma&names=Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>&proformano=<?=$_GET['proformano']?>&proformadate=<?=$_GET['proformadate']?>&sizes=a5',
success: function (result) {
if (result && result.length > 0) {       
result=$.parseJSON( result );
Timer=result.timer;
}
$("#timedownload").html(Timer);
 var req = new XMLHttpRequest();
  req.open("GET", "dompdf/Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>.pdf", true);
  req.responseType = "blob";

  req.onload = function (event) {
    var blob = req.response;
    console.log(blob.size);
    var link=document.createElement('a');
    link.href=window.URL.createObjectURL(blob);
    link.download="Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>.pdf";
    link.click();
  };

  req.send();
$("#exampleModaldownload").modal("hide");
alert("Pdf Downloaded Successfully");
},
error: function (error) {
alert(error);
}
});
// it is done
}

</script>
<?php
}
?>

<?php
if($info['proformatemplate']=='1')
{
    ?>
<script>

function converHTMLFileToPDF() {
$('#pdfObj').html('<div class="text-center"><span id="timer">Please wait <span id="time"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');
// ajax for get
$.ajax({
type: "GET",
url: 'proformadompdf.php?term=proforma&names=Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>&proformano=<?=$_GET['proformano']?>&proformadate=<?=$_GET['proformadate']?>&sizes=dt',
success: function (result) {
if (result && result.length > 0) {       
result=$.parseJSON( result );
Timer=result.timer;
}
$("#time").html(Timer);
 var req = new XMLHttpRequest();
  req.open("GET", "dompdf/Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>.pdf", true);
  req.responseType = "blob";

  req.onload = function (event) {
    var blob = req.response;
    console.log(blob.size);
    url=URL.createObjectURL(blob);
    obj = '<object id="pdfObjObj" data="'+url+'" type="application/pdf" width="90%" height="550"></object>';
    $('#pdfObj').html(obj)        
  };

  req.send();
},
error: function (error) {
alert(error);
}
});
// it is done
}

</script>
<script>

function downloadpdf() {
$("#exampleModaldownload").modal("show");
$('#pdfObjdownload').html('<div class="text-center"><span id="timerdownload">Please wait <span id="timedownload"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');
    // ajax for get
$.ajax({
type: "GET",
url: 'proformadompdf.php?term=proforma&names=Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>&proformano=<?=$_GET['proformano']?>&proformadate=<?=$_GET['proformadate']?>&sizes=dt',
success: function (result) {
if (result && result.length > 0) {       
result=$.parseJSON( result );
Timer=result.timer;
}
$("#timedownload").html(Timer);
 var req = new XMLHttpRequest();
  req.open("GET", "dompdf/Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>.pdf", true);
  req.responseType = "blob";

  req.onload = function (event) {
    var blob = req.response;
    console.log(blob.size);
    var link=document.createElement('a');
    link.href=window.URL.createObjectURL(blob);
    link.download="Proforma Invoices-<?=$_GET['proformano']?>-<?=$_GET['proformadate']?>.pdf";
    link.click();
  };

  req.send();
$("#exampleModaldownload").modal("hide");
alert("Pdf Downloaded Successfully");
},
error: function (error) {
alert(error);
}
});
// it is done
}

</script>
<?php
}
?>
<script>
        function printDiv() {
            var divContents = document.getElementById("printarea").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html><link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />');
            a.document.write('<body >');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>
<!-- <script type="text/javascript">
        function converHTMLFileToPDF() {
            var divContents = document.getElementById("printarea").innerHTML;
            var a = window.open('', '', 'height=500, width=900');
            a.document.write(divContents);
            a.document.close();
            a.print();
        }
</script> -->






    
</body>
</html>
<?php
}
else{
header("Location:proformas.php?error=No Information Found");
}
}
else{
header("Location:proformas.php?error=No Information Found");  
}
?>