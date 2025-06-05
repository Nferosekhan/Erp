<?php
include('lcheck.php');
// This is for Restriction of Pages
$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Expences' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['groupaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['groupaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
if((isset($_GET['id'])))
{
$id=mysqli_real_escape_string($con, $_GET['id']);
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, headerid, headername, paymentmode, amount, notes from pairexpenses where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='".$_GET['id']."'");
$info=mysqli_fetch_array($sql); 
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
<?= $infomainaccessuser['groupname']; ?> Details
</title>
<link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
<!-- productview.css -->
<link href="productview.css" rel="stylesheet">
</head>
<body class="g-sidenav-show" style="background-color:#F1F2F6;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Expences' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
?>
<div id="fullcontainerwidth">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3">
<div class="row">
<div class="col-lg-6">
<p class="mb-3" id="viewpro"><i class="fa fa-eye"></i> <?= $infomainaccessuser['groupname']; ?> Details</p>
</div>
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Expences' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccessedit']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
?>
<div class="col-lg-6">
<span id="btnalignright" class="mb-3">
<a class="btn btn-primary btn-sm btn-custom-grey" href="expenseedit.php?id=<?=$id?>" id="btngopage"><i class="fa fa-pencil-alt"></i> Edit</a>
</span>
</div>
<?php
}
?>
</div>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<nav>
<div class="nav nav-tabs" id="nav-tab" role="tablist">
<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><div class="customcont-header ml-0">
<a class="customcont-heading">Overview</a>	
</div></button>	
<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true"><div class="customcont-header ml-0">
<a class="customcont-heading">History</a>  
</div></button> 
</div>
</nav>
<div class="tab-content" id="nav-tabContent">
<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
<div class="table-responsive m-3">
<table class="table table-bordered">
<thead>
<tr>
<th>DATE</th>
<th>DETAILS</th>
</tr>
</thead>
<tbody>
<?php
$sqluse=mysqli_query($con, "select * from pairusehistory where usetype='EXPENSE' and useid='$id' order by createdon desc");
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
<p class="m-3" id="infoheadsall"><?= $infomainaccessuser['groupname']; ?> Details</p>	
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-2 col-6">
<span id="insideheadall"><span class="text-danger">Category Name * <svg data-toggle="tooltip" title="The product will be measured in terms of this unit (e.g.: kg, dozen)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-bottom: 3px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/></svg></span></span>
</div>
<div class="col-md-8 col-6">
<?=$info['headername']?>
</div>
</div>  
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-2 col-6">
<span id="insideheadall">Date</span>
</div>
<div class="col-md-8 col-6">
<?=$info['receiptdate']?>
</div>
</div>  
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-2 col-6">
<span id="insideheadall">(Manual) Number</span>
</div>
<div class="col-md-8 col-6">
<?=$info['receiptno']?>
</div>
</div>
</div>
</div>  
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-2 col-6">
<span id="insideheadall">Mode of Payment</span>
</div>
<div class="col-md-8 col-6">
<?=$info['paymentmode']?>
</div>
</div>  
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-2 col-6">
<span id="insideheadall">Amount</span>
</div>
<div class="col-md-8 col-6">
<?=$info['amount']?>
</div>
</div>  
<div class="row m-3" id="aligncenterall">
<div class="col-sm-3 col-md-2 col-6">
<span id="insideheadall">Notes</span>
</div>
<div class="col-md-8 col-6">
<?=$info['notes']?>
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
</body>
</html>