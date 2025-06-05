<?php
include('lcheck.php');
header('location:dashboard.php');
 if((isset($_GET['adjustmentno']))&&(isset($_GET['adjustmentdate'])))
 {
     $adjustmentno=mysqli_real_escape_string($con, $_GET['adjustmentno']);
     $adjustmentdate=mysqli_real_escape_string($con, $_GET['adjustmentdate']);
 $sql=mysqli_query($con, "select * from pairadjustments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and adjustmentno='$adjustmentno' and adjustmentdate='$adjustmentdate' order by id asc");
if(mysqli_num_rows($sql)>0)
{
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Inventory Adjustments' order by id  asc");
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
$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)||($infomainaccessuser['useraccessedit']==0)))) {
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}

if(isset($_POST['submit']))
{
date_default_timezone_set('Asia/Calcutta');
$createdon=date('Y-m-d H:i:s');
$oldadjustmentdate=mysqli_real_escape_string($con, $_POST['oldadjustmentdate']);
$oldadjustmentno=mysqli_real_escape_string($con, $_POST['oldadjustmentno']);
$adjustmentdate=mysqli_real_escape_string($con, $_POST['adjustmentdate']);
$adjustmentno=mysqli_real_escape_string($con, $_POST['adjustmentno']);
$publiccode=mysqli_real_escape_string($con, $_POST['publicid']);
$privatecode=mysqli_real_escape_string($con, $_POST['privateid']);
// $chartaccountname=mysqli_real_escape_string($con, $_POST['chartaccountname']);
// $chartaccountid=mysqli_real_escape_string($con, $_POST['chartaccountid']);
$adjustmentreason=mysqli_real_escape_string($con, $_POST['adjustmentreason']);
$description=mysqli_real_escape_string($con, $_POST['description']);
$reference=mysqli_real_escape_string($con, $_POST['reference']);

for($i=0; $i<count($_POST['oldproductname']); $i++)
{
$productid=mysqli_real_escape_string($con, $_POST['oldproductid'][$i]);
$oldproductname=mysqli_real_escape_string($con, $_POST['oldproductname'][$i]);
$oldquantity=mysqli_real_escape_string($con, $_POST['oldquantity'][$i]);
$oldnewquantity=mysqli_real_escape_string($con, $_POST['oldnewquantity'][$i]);
$oldadjustment=mysqli_real_escape_string($con, $_POST['oldadjustment'][$i]);
$oldbatch=mysqli_real_escape_string($con, $_POST['oldbatch'][$i]);
$oldexpiry=mysqli_real_escape_string($con, $_POST['oldexpiry'][$i]);
if($oldproductname!='')
{
$sql=mysqli_query($con, "delete from pairadjustments where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and adjustmentno='$oldadjustmentno' and adjustmentdate='$oldadjustmentdate'");
if($sql)
{
	$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-$oldnewquantity where id='$productid'");
    $sql5=mysqli_query($con, "update pairbatch set quantity=quantity-$oldnewquantity where productid='$productid' and (batch='$oldbatch' and expdate='$oldexpiry')");
}
else
{
echo mysqli_error($con);
}
}
}

$sql2=mysqli_query($con, "SET sql_mode = ''");
$sql2=mysqli_query($con, "select id from pairadjustments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and adjustmentno='$oldadjustmentno' and adjustmentdate='$oldadjustmentdate'");
if(mysqli_num_rows($sql2)==0)
{
for($i=0; $i<count($_POST['productname']); $i++)
{
$productid=mysqli_real_escape_string($con, $_POST['productid'][$i]);
$productname=mysqli_real_escape_string($con, $_POST['productname'][$i]);
$quantity=mysqli_real_escape_string($con, $_POST['quantity'][$i]);
$newquantity=mysqli_real_escape_string($con, $_POST['newquantity'][$i]);
$adjustment=mysqli_real_escape_string($con, $_POST['adjustment'][$i]);
// if ($_POST['batch'][$i]!='') {
    $batch=mysqli_real_escape_string($con, $_POST['batch'][$i]);
// }
// else{
//     $batch='';
// }
// if ($_POST['expdate'][$i]!='') {
    $expdate=mysqli_real_escape_string($con, $_POST['expdate'][$i]);
// }
// else{
//     $expdate='';
// }
    //,chartaccountid='$chartaccountid', chartaccountname='$chartaccountname'
if($productname!='')
{
$sql=mysqli_query($con, "insert into pairadjustments set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."',  adjustmentreason='$adjustmentreason', adjustmentno='$adjustmentno', adjustmentdate='$adjustmentdate', description='$description', reference='$reference', productid='$productid', productname='$productname', quantity='$quantity', newquantity='$newquantity', adjustment='$adjustment',publicid='$publiccode',privateid='$privatecode',batch='$batch',expiry='$expdate'");
if($sql)
{
$salesid=mysqli_insert_id($con);
$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock+$newquantity where id='$productid'");
// if($batch!='')
// {
// if($expdate!='')
// {
$sql5=mysqli_query($con, "update pairbatch set quantity=quantity+$newquantity where productid='$productid' and (batch='$batch' and expdate='$expdate')");
// }
// }
}
else
{
echo mysqli_error($con);
}
}

}
$tid=mysqli_insert_id($con);
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Adjustment', '{$tid}')");
if($sql)
{
 if(isset($_POST['submit1']))
{
echo '<script> window.open("adjustmentprint.php?adjustmentno='.$adjustmentno.'&adjustmentdate='.$adjustmentdate.'", "_blank");</script>';
echo '<script> window.location.href="adjustmentview.php?adjustmentno='.$adjustmentno.'&adjustmentdate='.$adjustmentdate.'";</script>'; 
}
else
{
echo '<script> window.location.href="adjustmentview.php?adjustmentno='.$adjustmentno.'&adjustmentdate='.$adjustmentdate.'";</script>';
}
}
}
else
{
header("Location: adjustments.php?error=Error Data");
}
if ($sql) {
$hissql=mysqli_query($con, "insert into pairusehistory set usetype='ADJUSTMENTS', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$adjustmentno', uniqueid='".$salesid."', useremarks='Adjustment Updated' ");
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
<!-------------------customer add info start ------------------------------->
<!-------------------customer add info end ------------------------------->
<title>
Edit <?= $infomainaccessuser['modulename']; ?>
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
 if((isset($_GET['adjustmentno']))&&(isset($_GET['adjustmentdate'])))
 {
	 $adjustmentno=mysqli_real_escape_string($con, $_GET['adjustmentno']);
	 $adjustmentdate=mysqli_real_escape_string($con, $_GET['adjustmentdate']);
 $sql=mysqli_query($con, "select * from pairadjustments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and adjustmentno='$adjustmentno' and adjustmentdate='$adjustmentdate' order by id asc");
$count=1;
if(mysqli_num_rows($sql)>0)
{
$rows = array();
while($row = mysqli_fetch_assoc($sql)){ 
$rows[] = $row;
}
?> 
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
?>
<div style="max-width: 1650px;">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<p style="font-size:20px;margin-top: -9px !important;margin-bottom: 6px !important;"><i class="fa fa-pencil"></i> Edit <?= $infomainaccessuser['modulename']; ?></p>
<?php
$sqlismainaccessuser=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix,modulename from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
?>
<div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename']; ?> Generation is Allowed for this Franchise</div>
<?php
}
else
{
?>
<?php
$sqligst=mysqli_query($con, "select gstno from pairgst where companymainid='$companymainid' ");
$infogst=mysqli_fetch_array($sqligst);
?>
<?php
        $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
$sqlismainaccessuserpro=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
$infomainaccessuserpro=mysqli_fetch_array($sqlismainaccessuserpro);
?>
<!----------------------------------------------- product add start ----------------------------------------->

<!------------------------------------------ pro style start ------------------------------------------>
<!------------------------------------------ productadd.css ------------------------------------------>
<!-- <link href="productadd.css" rel="stylesheet"> -->
<!------------------------------------------ pro style end ------------------------------------------>
<div class="modal fade" id="AddNewProduct" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">New <?=$infomainaccessuserpro['modulename']?></h5>
<span type="button" onclick="funesproduct()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-2" role="form">
<div class="modal-body mbsub" id="promodal">
<?php
include("productaddmodal.php");
?>
</div>
<div class="modal-footer mfsub">
<div class="col">
<button onclick="funaddproduct()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit"  name="submitproduct" id="submitproduct" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funesproduct()">Cancel</button> </div>
</div>
</form>
</div>
</div>
</div>
<!--------------------------------------------- product add end --------------------------------------------->
<hr class="p-0 mb-1 mt-1">

<form id="adjustmentform" action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<input type="hidden" id="custoriginpage">
<input type="hidden" id="prooriginpage">
<input type="hidden" name="oldadjustmentno" value="<?=$rows[0]['adjustmentno']?>">
<input type="hidden" name="oldadjustmentdate" value="<?=$rows[0]['adjustmentdate']?>">
     <?php
     if ((in_array('Inventory Adjustment Information', $fieldedit))) {
        ?>
<div class="row">

<div class="col-lg-12">
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingTwo" >
<button class="accordion-button font-weight-bold" type="button">
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;"><?= $infomainaccessuser['modulename']; ?> Information</a>
</div>
</button>
</h5>
<div id="collapseTwo" class="accordion-collapse collapse show"
aria-labelledby="headingTwo">
<div class="accordion-body text-sm">
<div class="row">
<div class="col-lg-6">

<div class="row" style="display: none;">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-lg-5">
<label for="adjustmentno" class="custom-label"><span class="text-danger">Number *</span></label>
</div>
<div class="col-lg-7">
<input type="text" class="form-control  form-control-sm" id="adjustmentno" name="adjustmentno" required value="<?=$rows[0]['adjustmentno']?>" readonly>
</div>
</div>
</div>
</div>
     <?php
     if ((in_array('Public Id', $fieldedit))) {
        ?>
<div class="row">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-lg-5">
<label for="publicid" class="custom-label">Public Id</label>
</div>
<div class="col-lg-7">
<input type="text" class="form-control  form-control-sm" id="publicid" name="publicid" required value="<?=$rows[0]['publicid']?>" readonly>
</div>
</div>
</div>
</div>
                                                    <?php
}
?>
     <?php
     if ((in_array('Private Id', $fieldedit))) {
        ?>
<div class="row">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-lg-5">
<label for="privateid" class="custom-label">Private Id</label>
</div>
<div class="col-lg-7">
<input type="text" class="form-control  form-control-sm" id="privateid" name="privateid" required value="<?=$rows[0]['privateid']?>" readonly>
</div>
</div>
</div>
</div>
                                                    <?php
}
?>
<div class="row">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-lg-5" style="padding-right:0px">
<label for="adjustmentdate" class="custom-label"><span class="text-danger">Date *</span></label>
</div>
<div class="col-lg-7">
<input type="date" class="form-control  form-control-sm" id="adjustmentdate" name="adjustmentdate" required value="<?=$rows[0]['adjustmentdate']?>">
</div>
</div>
</div>
</div>

</div>
<div class="col-lg-6">

<!-- <div class="row">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-lg-5" style="padding-right:0px">
<label for="adjustmentdate" class="custom-label"><span class="text-danger">Account *</span></label>
</div>
<div class="col-lg-7">
<input type="hidden" name="chartaccountid" id="chartaccountid" required value="<?=$rows[0]['chartaccountid']?>">
<input type="text" class="form-control  form-control-sm" id="chartaccountname" name="chartaccountname" required value="<?=$rows[0]['chartaccountname']?>">

</div>
</div>
</div>
</div> -->
<div class="row">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-lg-5" style="padding-right:0px">
<label for="adjustmentdate" class="custom-label"><span class="text-danger">Reason *</span></label>
</div>
<div class="col-lg-7">
<select class="select2-field form-control  form-control-sm" name="adjustmentreason" id="adjustmentreason" required>
<option value="" selected disabled>Select</option>
<?php
$sqli = mysqli_query($con, "select reason from pairreasons where (createdid='$companymainid' or createdid='0') and itemmodule='adjustment' order by reason asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?= $info['reason'] ?>" <?=($info['reason']===$rows[0]['adjustmentreason'])?'selected':''?>><?= $info['reason'] ?></option>
<?php
}
?>
</select>

</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-lg-5">
<label for="reference" class="custom-label">Reference Number</label>
</div>
<div class="col-lg-7">
<input type="text" class="form-control  form-control-sm" id="reference" name="reference" value="<?=$rows[0]['reference']?>">
</div>
</div>
</div>

</div>
<div class="row">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-lg-5">
<label for="description" class="custom-label">Description</label>
</div>
<div class="col-lg-7">
<textarea class="form-control  form-control-sm" id="description" name="description" style="height:50px;"><?=$rows[0]['description']?></textarea>
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
                                                    <?php
}
?>

<hr class="p-0 mb-1 mt-1">
<div class="row">
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingOne" >
<button class="accordion-button font-weight-bold" type="button">
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;">Item Information</a> <span style="font-weight: normal;font-size: 13px;">(<span id="totalProCount">1</span> of 100)</span>
</div>
</button>
</h5>
<div id="collapseOne" class="accordion-collapse collapse show"
aria-labelledby="headingOne">
<div class="accordion-body text-sm" style="padding-bottom: 0px !important;padding-top: 3px">
<div class="table-responsive">
<table class="table table-bordered" id="purchasetable">
<thead>
<tr>
<th style="display:none"></th>
<th></th>
<th width="28%">ITEM DETAILS<span class="text-danger"> *</span></th>
     <?php
     if ((in_array('Batch', $fieldedit))) {
        ?>
<th>BATCH</th>
<?php
}
?>
<th>Quantity Available<span class="text-danger"> *</span></th>
<th>New Quantity On Hand<span class="text-danger"> *</span></th>
<th>Quantity Adjusted</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
$i=1;
foreach($rows as $row)
{
?>
<input type="hidden" name="oldproductid[]" id="oldproductid<?=$i?>" value="<?=$row['productid']?>">
<input type="hidden" name="oldproductname[]" id="oldproductname<?=$i?>" value="<?=$row['productname']?>">
<input type="hidden" name="oldquantity[]" id="oldquantity<?=$i?>" value="<?=$row['quantity']?>">
<input type="hidden" name="oldnewquantity[]" id="oldnewquantity<?=$i?>" value="<?=$row['newquantity']?>">
<input type="hidden" name="oldadjustment[]" id="oldadjustment<?=$i?>" value="<?=$row['adjustment']?>">
<input type="hidden" name="oldbatch[]" id="oldbatch<?=$i?>" value="<?=$row['batch']?>">
<input type="hidden" name="oldexpiry[]" id="oldexpiry<?=$i?>" value="<?=$row['expiry']?>">
<tr>
<td class="priority" style="display:none"> <?=$i?></td>
<td class="tdmove"><svg version="1.1" id="Layer_<?=$i?>" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td class="iteminfo" data-label="ITEM DETAILS" style="padding-top: 1px !important;"><input type="hidden" name="productid[]" id="productid<?=$i?>" value="<?=$row['productid']?>">
<input type="hidden" name="productname[]" id="productname<?=$i?>" value="<?=$row['productname']?>">
<div onclick="andus()" id="selecttheproduct">
<select class="form-control  form-control-sm product proitemselect adjustingproduct1" name="product[]" id="product<?=$i?>" required onChange="productchange(<?=$i?>)">

<option value="" data-foo="" data-receivable="" selected disabled>Select</option>
<?php
$sqli = mysqli_query($con, "SELECT t1.productname, t1.category, t1.id, t1.description, t1.itemmodule, t1.hsncode, t1.openingstock, t2.tax, t3.salemrp, t3.salecost, t3.salediscount, t3.saleofferprice, t1.manufacturer, t1.defaultunit FROM pairproducts t1, pairtaxrates t2, pairprosale t3 WHERE t1.createdid='$companymainid' and ((t1.franchisesession='".$_SESSION["franchisesession"]."' and t1.pvisiblity='PRIVATE') or t1.pvisiblity='PUBLIC') and (t2.id=t1.intratax or t1.intratax='null') and t3.productid=t1.id and t1.isactive='0' and t1.id='".$row['productid']."' ORDER BY t1.productname ASC");
while ($infopro = mysqli_fetch_array($sqli))
{
?>
<option value="<?=mysqli_real_escape_string($con, $infopro['id']);?>" <?=($row['productid']==$infopro['id'])?'selected':''?>><?=mysqli_real_escape_string($con, $infopro['productname']);?></option>
<?php
if($row['productid']==$infopro['id'])
{
$itemmodule=$infopro['itemmodule'];    
}
else{
$itemmodule='Products';
}
?>
<?php
}
?>
</select>
</div>
<span class="badge" style="width:75px; padding:3px; margin:5px 3px; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan<?=$i?>"><?=$itemmodule?></span>
</td>
<td class="batchinfo" data-label="BATCH" <?=(in_array('Batch', $fieldedit))?'':'style="display:none !important;"'?>>
<div>
<input autocomplete="off" type="text" name="batch[]" id="batch<?=$i?>" onClick="batchget(<?=$i?>);" onFocus="batchget(<?=$i?>);"  class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;" value="<?=$row['batch']?>"></div>
<span id="productexpdatespan<?=$i?>" style="font-size:11px;">EXPIRY:</span>
<input autocomplete="off" type="date" name="expdate[]" id="expdate<?=$i?>" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;" value="<?=$row['expiry']?>"> <span id="productexpdateval<?=$i?>" style=" font-size:11px;" class="text-primary"><?=($row['expiry']!='')?date($datemainphp,strtotime($row['expiry'])):''?></span>
<span id="productexpdateedit<?=$i?>" style="font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate(<?=$i?>)"><i class="fa fa-edit"></i></span>
<span id="productexpdateupdate<?=$i?>" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate(<?=$i?>)"><i class="fa fa-save"></i></span>
<div>
<script type="text/javascript">
$(document).ready(function () {
var productid= $('#product'+<?=$i?>).val();
var invbatchdef = '';
$.get("batchsearch.php", {term: productid,batchdef: invbatchdef} , function(datas){
console.log("normal"+datas);
$("#errbatch"+<?=$i?>).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $datas in";
brrch = document.getElementById("errbatch"+<?=$i?>);
if (brrch.value.includes(letters)) {
$("#outfordone"+<?=$i?>).html("");
var browsers = document.getElementById("outfordone"+<?=$i?>);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
var chnew = 0;
for (var key in objbatch) {
  console.log("key"+key);
chnew++;
  check+="<div id='option"+<?=$i?>+chnew+"' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' id='batch"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].batch+"'>Batch : "+objbatch[key].batch+" </td><td align='right' id='qty"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].quantity+"'>Quantity : "+objbatch[key].quantity+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' id='exp"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].expdate+"'>Expiry : "+objbatch[key].expdate+" </td><td align='right' id='rate"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].productrate+"'>Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#outfordone"+<?=$i?>).html(check);
var browsers = document.getElementById("outfordone"+<?=$i?>);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
});
</script>
<div id="outfordone<?=$i?>" class="dvi" style="display:none;width: 250px;"></div>
<input type="text" id="errbatch<?=$i?>" style="display:none;">
</div>
</td>
<td class="qtyinfo" data-label="Quantity Available"><input type="number" min="0" step="0.01" name="quantity[]" required id="quantity<?=$i?>" class="form-control form-control-sm bordernoneinput productselectwidth" onChange="productcalc(<?=$i?>)" readonly value="<?=$row['quantity']?>"></td>
<td class="newqtyinfo" data-label="New Quantity On Hand"><input type="number" min="0" step="0.01" name="newquantity[]" placeholder="Eg. +10, -10" required id="newquantity<?=$i?>" class="form-control form-control-sm bordernoneinput productselectwidth" onChange="productcalc(<?=$i?>)" value="<?=$row['newquantity']?>"></td>
<td class="qtyadjinfo" data-label="Quantity Adjusted"><input type="number" min="0" step="0.01" name="adjustment[]" required id="adjustment<?=$i?>" class="form-control form-control-sm bordernoneinput productselectwidth" onChange="productcalc(<?=$i?>)" readonly value="<?=$row['adjustment']?>"></td>
<td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>


<?php
$i++;
}
?>
<input type="hidden" id="totalinedit" value="<?=$i-1?>">
<script type="text/javascript">
$(document).ready(function() {
$("#totalProCount").html($("#totalinedit").val());
addnewrow(<?=$i?>);
});
</script>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-8">


<div class="row">
<div class="form-group row" id="mobadddesign">
<div class="col-lg-6 col-md-5 col-sm-12 col-12">
<p align="left" style="margin:0px;padding:0px;">
<a class="productadd-row btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;padding: 2px 4.5px 1px 4.5px !important; margin-bottom:0.25rem;"><i style="font-size: 14px;color:#0066cc;" class="fa fa-plus-circle"></i> Add another line</a></p>
</div>
</div>
</div>


</div>

</div>

</div>

<style type="text/css">
@media screen and (max-width: 991px){
    .dvi {
        width: 200px !important;
        right: 25px !important;
    }
    .ratedvi{
        margin-top: 9px !important;
    }
.invbillgets td{
width: 50% !important;
display: inline-block;
}
}
    .ratedvi{
        margin-top: 16px;
    }
.dvi {
  position: absolute;
  float: right;
  background-color: #fff;
  border: 1px solid #cccccc !important;
  border-radius: 0 0 5px 5px;
  border-top: none;
  font-family: sans-serif;
  width: 354px;
  padding: 0px;
  max-height: 10rem;
  overflow-y: auto;
  border-bottom: 1px solid #cccccc !important;
}

.dvi div td{
    white-space: nowrap !important;
}

.dvi div {
  background-color: #fff;
  padding: 0px;
  color: black;
  margin-bottom: 0px;
   font-size: 13px;
  cursor: pointer;
}

.dvi div:hover{
  background-color: #1BBC9B !important;
  color: #fff;
}
.invbillgets td{
padding: 5px 3px !important;
width: 50%;
}
.invbillgets span{
padding: 3px;
border-radius: 6px;
color: black;
display: inline-block;
width: 100%;
}
.invbillgets span:hover{
background-color: #1BBC9B !important;
color: #fff !important;
}
.select2-container .select2-selection--single .select2-selection__rendered{
white-space: normal !important;
}

.select2-container .select2-selection--single{
    overflow: hidden !important;
}
</style>


<!---payment confirm---->
<!---payment confirm---->
<!---navbottom---->
<header class="app-header fixed-bottom" style="height:48px !important;z-index: 1 !important;">
<div class="app-header-inner">
<div class="py-2 px-3">
<div class="app-header-content" style="margin-left: -45px;" id="ilu">
<div class="row">
<div class="col-auto pt-1" style="width:34px !important;margin-top: -8px !important;height: 100px;margin-left: -18px !important;border-top: 1px solid #eff0f4;">
</div>
<div class="col" style="width:34px !important;margin-top: 1px !important;margin-left: -9px !important;">
<button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="submit" value="Convert to Adjusted">
<span class="label">Convert to Adjusted</span> <span class="spinner"></span>
</button>
<a class="btn btn-primary btn-sm btn-custom-grey"
href="adjustments.php" style="margin-top:-3px !important;">Cancel</a>

</div>
</div>
</div>
</div>
</div>
</header>
<!---navbottom---->
</form>
<?php
}
?>
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
<!-------------------customer add info start ------------------------------->
<!-- subtext -->
<!-------------------customer add info end ------------------------------->
<?php
include('fexternals.php');
?>
<script type="text/javascript">
function andun() {
$(".select2-container--open .select2-dropdown--above").hide();
$(".select2-container--open .select2-dropdown--below").hide();
}
function andus() {
$(".select2-container--open .select2-dropdown--above").show();
$(".select2-container--open .select2-dropdown--below").show();
}
</script>
<!-------------------customer add info start ------------------------------->
<!--salutation-->
<script type="text/javascript">
$("#custsalute").click(function(){
document.getElementById('custcustdrpsalute').classList.toggle("custdropdownsalute");
});
</script>
<!-- cat -->
<!-- subcat -->
<!-- same as bill -->
<script type="text/javascript">
function sameasbillingticaccess() {
let showorhide = document.getElementById('custsameasbilling');
if (showorhide.checked==true) {
document.getElementById('custtotalshipadd').style.display = 'none';
}
else{
document.getElementById('custtotalshipadd').style.display = 'block';
}
}
$(document).ready(function() {
let showorhide = document.getElementById('custsameasbilling');
if (showorhide.checked==true) {
document.getElementById('custtotalshipadd').style.display = 'none';
}
else{
document.getElementById('custtotalshipadd').style.display = 'block';
}
});
</script>
<!-- gstrtype -->
<script type="text/javascript">
$(document).ready(function() {
let noaccess = document.getElementById('custtaxprefnontaxable');
let access = document.getElementById('custtaxpreftaxable');
if (noaccess.checked == true) {
document.getElementById('custgstrtypesh').style.display='none';
}
if (access.checked == true) {
document.getElementById('custgstrtypesh').style.display='block';
}
});
function gettaxable(){
let noaccess = document.getElementById('custtaxprefnontaxable');
let access = document.getElementById('custtaxpreftaxable');
if (noaccess.checked == true) {
document.getElementById('custgstrtypesh').style.display='none';
}
else{
document.getElementById('custgstrtypesh').style.display='block';
}
}
</script>
<script type="text/javascript">
function showDiv(element)
{
if (element.value == '') {
document.getElementById('custgstblock').style.display = 'none';
document.getElementById('custplaceofsupply').style.display = 'block';
}
else if (element.value == 'Registered Business - Regular') {
document.getElementById('custgstblock').style.display = 'block';
document.getElementById('custplaceofsupply').style.display = 'block';
}
else if (element.value == 'Registered Business - Composition') {
document.getElementById('custgstblock').style.display = 'block';
document.getElementById('custplaceofsupply').style.display = 'block';
}
else if (element.value == 'Unregistered Business') {
document.getElementById('custgstblock').style.display = 'none';
}
else if (element.value == 'Consumer') {
document.getElementById('custgstblock').style.display = 'none';
}
else if (element.value == 'Overseas') {
document.getElementById('custplaceofsupply').style.display = 'none';
document.getElementById('custgstblock').style.display = 'none';
}
else if (element.value == 'Special Economic Zone') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
}
else if (element.value == 'Deemed Export') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
}
else if (element.value == 'Tax Deductor') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
}
else if (element.value == 'SEZ Developer') {
document.getElementById('custplaceofsupply').style.display = 'block';
document.getElementById('custgstblock').style.display = 'block';
}
}
</script>
<!-- cat -->
<script>
$("#custcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#custAddNewCategory') {
$('#custAddNewCategory').modal('show');
}
});
$("#custsubcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#custAddNewSubCategory') {
$('#custAddNewSubCategory').modal('show');
}
});
</script>
<script>
function funaddcategory() {
var missingcategory = document.getElementById('custmissingcategory');
if (missingcategory.value == '') {
alert('Please Enter New Category Name');
missingcategory.focus();
return false;
} else {
$('#custcategory').append('<option value="' + missingcategory.value + '">' + missingcategory.value +
'</option>');
$('#custcategory').val(missingcategory.value).change();
$('#custAddNewCategory').modal('hide');
return false;
}
}
function funescategory() {
$('#custcategory').val('').change();
$('#custAddNewCategory').modal('hide');
return false;
}
</script>
<!-- subcat -->
<script>
function funaddsubcategory() {
var missingsubcategory = document.getElementById('custmissingsubcategory');
if (missingsubcategory.value == '') {
alert('Please Enter New Sub Category Name');
missingsubcategory.focus();
return false;
} else {
$('#custsubcategory').append('<option value="' + missingsubcategory.value + '">' + missingsubcategory.value +
'</option>');
$('#custsubcategory').val(missingsubcategory.value).change();
$('#custAddNewSubCategory').modal('hide');
return false;
}
}
function funessubcategory() {
$('#custsubcategory').val('').change();
$('#custAddNewSubCategory').modal('hide');
return false;
}
</script>
<!-- unit cat subcat select modal design -->
<script>
$("#customer").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewCustomer");
$("#configureunits").show();
});
$("#customer").on("select2:open", function() {
$("#configureunits").show();
document.getElementById("configureunits").innerHTML = "New Customer";
});

$(".adjustingproduct1").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewProduct");
$("#configureunits").show();
});
$(".adjustingproduct1").on("select2:open", function() {
$("#configureunits").show();
document.getElementById("configureunits").innerHTML = "New <?=$infomainaccessuserpro['modulename']?>";
});

$("#custgstrtype").on("select2:open", function() {
$("#configureunits").hide();
});
$("#custsubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewSubCategory");
});
$("#custsubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#custcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#custAddNewCategory");
});
$("#custcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Category";
});
</script>
<script>
function funaddcustomer() {
var custcustomerdname = document.getElementById('custcustomerdname');
if (custcustomerdname.value == '') {
alert('Please Enter New Customer Name');
custcustomerdname.focus();
return false;
} else {
$('#custcustomer').append('<option value="' + custcustomerdname.value + '">' + custcustomerdname.value +
'</option>');
$('#custcustomer').val(custcustomerdname.value).change();
$('#custAddNewCustomer').modal('hide');
return false;
}
}
function funescustomer() {
$('#custcustomer').val('').change();
$('#custAddNewCustomer').modal('hide');
return false;
}
</script>
<script>
$(document).ready(function(){
$("#custsubmitcustomer").click(function(e){
e.preventDefault();
var custcustomerdname=$("#custcustomerdname").val();
if(custcustomerdname=="")
{
alert("Please Enter the Customer Name");
return false;
}
else
{
$.ajax({type: "POST",
url: "customeradds.php",
data: {
customercode: $("#custcustomercode").val(),
landline: $("#custlandline").val(),
cstno: $("#custcstno").val(),
customerid: $("#custcustomerid").val(),
salute: $("#custsalute").val(),
pcontact: $("#custpcontact").val(),
companyname: $("#custcompanyname").val(),
customerdname: $("#custcustomerdname").val(),
category: $("#custcategory").val(),
subcategory: $("#custsubcategory").val(),
workphone: $("#custworkphone").val(),
mobilephone: $("#custmobilephone").val(),
email: $("#custemail").val(),
website: $("#custwebsite").val(),
billstreet: $("#custbillstreet").val(),
billcity: $("#custbillcity").val(),
billstate: $("#custbillstate").val(),
billpincode: $("#custbillpincode").val(),
billcountry: $("#custbillcountry").val(),
sameasbilling: $("#custsameasbilling").val(),
shipstreet: $("#custshipstreet").val(),
shipcity: $("#custshipcity").val(),
shipstate: $("#custshipstate").val(),
shippincode: $("#custshippincode").val(),
shipcountry: $("#custshipcountry").val(),
visibility: $("#custvisibility").val(),
taxpref: $("#custtaxpref").val(),
gstrtype: $("#custgstrtype").val(),
gstin: $("#custgstin").val(),
bln: $("#custbln").val(),
btname: $("#custbtname").val(),
pan: $("#custpan").val(),
pos: $("#custpos").val(),
submit: "Submit"
},
success:function(result){
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
var custcustomerdname=$("#custcustomerdname").val();
var billcity=$("#custbillcity").val();
var mobilephone=$("#custmobilephone").val();
$('#customer').append('<option value="' + resarray[1] + '">' + custcustomerdname + ' - ' + billcity+ ' - ' + mobilephone + '</option>');
$('select[name^="customer"] option[value="' + resarray[1] + '"]').attr("selected","selected");
$('#customer').val(resarray[1]).change();
$('#custAddNewCustomer').modal('hide');
}
}});
}
/* $.ajax({type: "POST",
url: "/imball-reagens/public/shareitem",
data: { id: $("#Shareitem").val(), access_token: $("#access_token").val() },
success:function(result){
$("#sharelink").html(result);
}}); */
});
});
</script>
<!-------------------customer add info end ------------------------------->
<script>
let lineNo = <?=$i?>;
$(document).ready(function () {
$(".productadd-row").click(function () {
addnewrow(lineNo);
lineNo++;
});
});
</script>
<script>
var proalreadychnxtlvl = 0;
function proautocomp(lineNo)
{
$('#product'+lineNo).change(function(){
proalreadychnxtlvl = 0;
var id= $('#product'+lineNo).val();
if(id != '')
{
$.get("prosearch1.php", {term: id} , function(data){
console.log(data);
const obj = JSON.parse(data);
console.log(obj[0]);
var oldproductnames = document.getElementsByName('productname[]');
var oldbatch = document.getElementsByName('batch[]');
var oldexp = document.getElementsByName('expdate[]');
var proalreadych = 0;
var nowthepro = obj[0].productname;
    var finalbatexp = 0;
<?php
if (in_array('Batch', $fieldadd)) {
?>
for (var i = 0; i < oldproductnames.length; i++){
    if(document.getElementById("outfordone"+(i+1)).innerHTML!=''){
    var gottedbatch = "Batch : "+oldbatch[i].value+" </td>";
    var gottedexp = "Expiry : "+oldexp[i].value+" </td>";
    }
    else{
    var gottedbatch = oldbatch[i].value;
    var gottedexp = oldexp[i].value;
    }
    console.log(gottedbatch);
if ((oldproductnames[i].value==nowthepro)&&(i+1!=lineNo)) {
    if(document.getElementById("outfordone"+(i+1)).innerHTML!=''){
    var lenofold = document.querySelectorAll("#outfordone"+(i+1)+" table").length;
    }
    else{
    var lenofold = 0;
    }
    for(f=0;f<lenofold;f++){
    if(document.getElementById("outfordone"+(i+1)).innerHTML!=''){
    var fully = document.getElementById("outfordone"+(i+1)).childNodes[f].innerHTML;
    if ((fully.includes(gottedbatch))&&(fully.includes(gottedexp))) {
        finalbatexp++;
    }
    }
    }
    if(document.getElementById("outfordone"+(i+1)).innerHTML==''){
    if (gottedbatch!=''||gottedexp!='') {
    finalbatexp++;
    }
    else if (gottedbatch==''&&gottedexp=='') {
    finalbatexp=0;
    }
    }
    if (finalbatexp==lenofold) {
        proalreadych++;
        proalreadychnxtlvl++;
    }
}
}
<?php
}
else{
?>
for (var i = 0; i < oldproductnames.length; i++){
if ((oldproductnames[i].value==nowthepro)){
proalreadych++;
proalreadychnxtlvl++;
}
}
<?php
}
?>
if (proalreadych==0) {
$("#productid"+lineNo).val(obj[0].id);
$("#productname"+lineNo).val(obj[0].productname);
$("#itemmodulespan"+lineNo).html(obj[0].itemmodule);
$("#itemmodulespan"+lineNo).css('display', 'block');
$("#quantity"+lineNo).val(obj[0].openingstock);
var btndel = document.getElementsByName('productname[]');
var btndels = document.getElementsByName('product[]');
if ((btndel.length>1)||(btndel[0].value!='')) {
for(i=0;i<btndel.length;i++){
if (btndels[i].value!=0) {
var ids = btndel[i].id.split('productname');
var id = ids[1];
productcalc(id);
}
}
}
}
else{
alert("This <?=$infomainaccessuserpro['modulename']?> Is Already Selected! Please Select The Another <?=$infomainaccessuserpro['modulename']?>");
$('#product'+lineNo).parents("tr").remove();
var btndel = document.getElementsByName('productname[]');
var btndels = document.getElementsByName('product[]');
if ((btndel.length>1)||(btndel[0].value!='')) {
for(i=0;i<btndel.length;i++){
if (btndels[i].value!=0) {
var ids = btndel[i].id.split('productname');
var id = ids[1];
productcalc(id);
}
}
}
}
});
}
});
var productid= $('#product'+lineNo).val();
var invbatchdef = '';
$.get("batchsearch.php", {term: productid,batchdef: invbatchdef} , function(datas){
console.log("normal"+datas);
$("#errbatch"+lineNo).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $datas in";
brrch = document.getElementById("errbatch"+lineNo);
if (brrch.value.includes(letters)) {
$("#outfordone"+lineNo).html("");
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
var chnew = 0;
for (var key in objbatch) {
  console.log("key"+key);
chnew++;
  check+="<div id='option"+lineNo+chnew+'d'+"' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' id='batch"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].batch+"'>Batch : "+objbatch[key].batch+" </td><td align='right' id='qty"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].quantity+"'>Quantity : "+objbatch[key].quantity+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' id='exp"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].expdate+"'>Expiry : "+objbatch[key].expdate+" </td><td align='right' id='rate"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;'>Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#outfordone"+lineNo).html(check);
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
}
proautocomp(1);
function addnewrow(lineNo)
{
var y=0;
var newquantitys = document.getElementsByName('newquantity[]');
for (var i = 0; i < newquantitys.length; i++)
{
if(newquantitys[i].value=='')
{
y++;
}
}
if(y==0)
{
markup = '<tr> <td class="priority" style="display:none"> 1</td> <td class="tdmove"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td> <td class="iteminfo" data-label="ITEM DETAILS" style="padding-top: 1px !important;"><input type="hidden" name="productid[]" id="productid'+lineNo+'"> <input type="hidden" name="productname[]" id="productname'+lineNo+'"> <div onclick="andus()" id="selecttheproduct"> <select class="form-control  form-control-sm product proitemselect adjustingproduct1 proselect2" name="product[]" id="product'+lineNo+'"  onChange="productchange('+lineNo+')"><option value="" selected disabled>Select</option></select> </div> <span class="badge" style="display:none; width:75px; padding:3px; margin:5px 3px; background-color: #57b729; font-size:75%;border-radius: 0px !important;" id="itemmodulespan'+lineNo+'"></span> </td><td class="batchinfo" data-label="BATCH" <?=(in_array('Batch', $fieldedit))?'':'style="display:none !important;"'?>> <div> <input autocomplete="off" type="text" name="batch[]" id="batch'+lineNo+'" onClick="batchget('+lineNo+');" onFocus="batchget('+lineNo+');"  class="form-control form-control-sm proitemselect productselectwidth" style="margin-bottom: 3px !important;padding: 0px !important;"></div><div id="outfordone'+lineNo+'" class="dvi" style="display:none;width: 250px;"></div><input type="text" id="errbatch'+lineNo+'" style="display:none;"> <span id="productexpdatespan'+lineNo+'" style="display:none; font-size:11px;">EXPIRY:</span> <input autocomplete="off" type="date" name="expdate[]" id="expdate'+lineNo+'" class="form-control form-control-sm proitemselect" style="display:none;width: 94px !important;padding: 0px !important;height: 18px !important;"> <span id="productexpdateval'+lineNo+'" style=" font-size:11px;" class="text-primary"></span> <span id="productexpdateedit'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-blue" onclick="editexpdate('+lineNo+')"><i class="fa fa-edit"></i></span> <span id="productexpdateupdate'+lineNo+'" style="display:none; font-size:11px; cursor:pointer" class="text-success" onclick="changeexpdate('+lineNo+')"><i class="fa fa-save"></i></span> </td><td class="qtyinfo" data-label="Quantity Available"><input type="number" min="0" step="0.01" name="quantity[]" required id="quantity'+lineNo+'" class="form-control form-control-sm bordernoneinput productselectwidth" onChange="productcalc('+lineNo+')" readonly></td> <td class="newqtyinfo" data-label="New Quantity On Hand"><input type="number" min="0" step="0.01" name="newquantity[]" placeholder="Eg. +10, -10" id="newquantity'+lineNo+'" class="form-control form-control-sm bordernoneinput productselectwidth" onChange="productcalc('+lineNo+')"></td> <td class="qtyadjinfo" data-label="Quantity Adjusted"><input type="number" min="0" step="0.01" name="adjustment[]" required id="adjustment'+lineNo+'" class="form-control form-control-sm bordernoneinput productselectwidth" onChange="productcalc('+lineNo+')" readonly></td> <td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td> </tr>';
tableBody = $("#purchasetable");
tableBody.append(markup);
document.getElementById("totalProCount").innerHTML = document.getElementsByClassName("adjustingproduct1").length;
function template(data) {
  return data.html;
}

$('#product'+lineNo).select2({
                width: '100%',
                ajax: {
                    url: "inlistadjustprosearch.php",
                    type: "post",
                    dataType: 'json',
                    delay: 0,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };

                    },
                    cache: true
                },
                  escapeMarkup: function(markup) {
                    return markup;
                  },
                  templateResult: function(data) {
                    return data.html;
                  },
                  templateSelection: function(data) {
                    return data.text;
                  }
            });
var productid= $('#product'+lineNo).val();
var invbatchdef = '';
$.get("batchsearch.php", {term: productid,batchdef: invbatchdef} , function(datas){
console.log("normal"+datas);
$("#errbatch"+lineNo).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $datas in";
brrch = document.getElementById("errbatch"+lineNo);
if (brrch.value.includes(letters)) {
$("#outfordone"+lineNo).html("");
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
var chnew = 0;
for (var key in objbatch) {
  console.log("key"+key);
chnew++;
  check+="<div id='option"+lineNo+chnew+'d'+"' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' id='batch"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].batch+"'>Batch : "+objbatch[key].batch+" </td><td align='right' id='qty"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].quantity+"'>Quantity : "+objbatch[key].quantity+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' id='exp"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].expdate+"'>Expiry : "+objbatch[key].expdate+" </td><td align='right' id='rate"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;'>Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#outfordone"+lineNo).html(check);
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
$("#product"+lineNo).on("select2:open", function() {
document.getElementById("ppp").value = lineNo;
});
$("#product"+lineNo).on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewProduct");
$("#configureunits").show();
});
$("#product"+lineNo).on("select2:open", function() {
$("#configureunits").show();
document.getElementById("configureunits").innerHTML = "New <?=$infomainaccessuserpro['modulename']?>";
});
proautocomp(lineNo);
renumber_table('#purchasetable');
}
}
</script>
<script type="text/javascript">
$(document).ready(function() {
//Helper function to keep table row from collapsing when being sorted
var fixHelperModified = function(e, tr) {
var $originals = tr.children();
var $helper = tr.clone();
$helper.children().each(function(index)
{
$(this).width($originals.eq(index).width())
});
return $helper;
};
//Make diagnosis table sortable
$("#purchasetable tbody").sortable({
helper: fixHelperModified,
stop: function(event,ui) {renumber_table('#purchasetable')}
}).disableSelection();
//Delete button in table rows
$('table').on('click','.btn-delete',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("purchasetable").rows.length;
if(x!=2)
{
r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
var btndel = document.getElementsByName('productname[]');
var btndels = document.getElementsByName('product[]');
if ((btndel.length>1)||(btndel[0].value!='')) {
for(i=0;i<btndel.length;i++){
if (btndels[i].value!=0) {
var ids = btndel[i].id.split('productname');
var id = ids[1];
productcalc(id);
}
}
}
document.getElementById("totalProCount").innerHTML = document.getElementsByClassName("adjustingproduct1").length;
}
}
else
{
alert('Unable to Delete First row');
}
});
});
//Renumber  table rows
function renumber_table(tableID) {
$(tableID + " tr").each(function() {
count = $(this).parent().children().index($(this)) + 1;
$(this).find('.priority').html(count);
});
}
</script>
<script type="text/javascript">
$(function() {
/* $("#productname1").autocomplete({
source: 'prosearch.php',
select: function(event, ui) {
$("#productid1").val(ui.item.id);
$("#productname1").val(ui.item.productname);
$("#adjustment1").val(ui.item.description);
$("#productdescription1").val(ui.item.description);
$("#productdescription1").css('display', 'block');
$("#productdescriptionspan1").css('display', 'block');
$("#itemmodule1").html(ui.item.itemmodule);
$("#itemmodule1").css('display', 'block');
$("#newquantity1").val(ui.item.hsncode);
$("#mrp1").val(ui.item.salemrp);
$("#vat1").val(ui.item.tax);
$("#productrate1").val(ui.item.salecost);
$("#prodiscount1").val(ui.item.salediscount);
$("#productquantityval1").html(ui.item.quantity);
$("#productquantityval1").css('display', 'inline');
$("#quantity1").val(ui.item.quantity);
$("#quantity1").css('display', 'none');
$("#productquantityspan1").css('display', 'inline');
$("#productquantityedit1").css('display', 'inline');
$("#productquantityupdate1").css('display', 'none');
$("#newquantitycodeval1").html(ui.item.hsncode);
$("#newquantitycodeval1").css('display', 'inline');
$("#newquantity1").val(ui.item.hsncode);
$("#newquantity1").css('display', 'none');
$("#newquantitycodespan1").css('display', 'inline');
$("#newquantitycodeedit1").css('display', 'inline');
$("#newquantitycodeupdate1").css('display', 'none');
//$("#productexpdateval1").html(ui.item.expdate);
$("#productexpdateval1").css('display', 'inline');
//$("#expdate1").val(ui.item.expdate);
$("#expdate1").css('display', 'none');
$("#productexpdatespan1").css('display', 'inline');
$("#productexpdateedit1").css('display', 'inline');
$("#productexpdateupdate1").css('display', 'none');
$("#productmrpval1").html(ui.item.mrp);
$("#productmrpval1").css('display', 'inline');
$("#mrp1").val(ui.item.mrp);
$("#mrp1").css('display', 'none');
$("#productmrpspan1").css('display', 'inline');
$("#productmrpedit1").css('display', 'inline');
$("#productmrpupdate1").css('display', 'none');
$("#productnoofpacksval1").html(ui.item.noofpacks);
$("#productnoofpacksval1").css('display', 'inline');
$("#noofpacks1").val(ui.item.noofpacks);
$("#noofpacks1").css('display', 'none');
$("#productnoofpacksspan1").css('display', 'inline');
$("#productnoofpacksedit1").css('display', 'inline');
$("#productnoofpacksupdate1").css('display', 'none');
$("#productprodiscountval1").html(ui.item.salediscount);
$("#productprodiscountval1").css('display', 'inline');
$("#prodiscount1").val(ui.item.salediscount);
$("#prodiscount1").css('display', 'none');
$("#productprodiscountspan1").css('display', 'inline');
$("#productprodiscountedit1").css('display', 'inline');
$("#productprodiscountupdate1").css('display', 'none');
$("#productvatval1").html(ui.item.tax);
$("#productvatval1").css('display', 'inline');
$("#vat1").val(ui.item.tax);
$("#vat1").css('display', 'none');
$("#productvatspan1").css('display', 'inline');
$("#productvatedit1").css('display', 'inline');
$("#productvatupdate1").css('display', 'none');
},
minLength: 2
}).data("ui-autocomplete")._renderItem = function(ui, item) {
return $("<li class='ui-autocomplete-row'></li>")
.data("item.autocomplete", item)
.append(item.label)
.appendTo(ui);
}; */
/*  $( "#customername" ).autocomplete({
source: 'customersearch.php', select: function (event, ui) { $("#area").val(ui.item.address); $("#city").val(ui.item.city); $("#district").val(ui.item.country); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pin); $( "#productname1" ).focus();}, minLength: 1
}); */
$( "#area" ).autocomplete({
source: 'areasearch.php', select: function (event, ui) { $("#area").val(ui.item.area); $("#city").val(ui.item.city); $("#district").val(ui.item.district); $("#state").val(ui.item.state); $("#pincode").val(ui.item.pincode);}, minLength: 2
});
$( "#email" ).autocomplete({
source: 'franchisesearch.php?type=email',
});
});
</script>
<script>
function editquantity(id)
{
$("#productquantityval"+id).css('display', 'none');
$("#quantity"+id).css('display', 'block');
$("#productquantityspan"+id).css('display', 'inline');
$("#productquantityedit"+id).css('display', 'none');
$("#productquantityupdate"+id).css('display', 'inline');
}
function changequantity(id)
{
$("#productquantityval"+id).html($("#quantity"+id).val());
$("#productquantityval"+id).css('display', 'inline');
$("#quantity"+id).css('display', 'none');
$("#productquantityspan"+id).css('display', 'inline');
$("#productquantityedit"+id).css('display', 'inline');
$("#productquantityupdate"+id).css('display', 'none');
}
</script>
<script>
function edithsncode(id)
{
$("#newquantitycodeval"+id).css('display', 'none');
$("#newquantity"+id).css('display', 'block');
$("#newquantitycodespan"+id).css('display', 'inline');
$("#newquantitycodeedit"+id).css('display', 'none');
$("#newquantitycodeupdate"+id).css('display', 'inline');
}
function changehsncode(id)
{
$("#newquantitycodeval"+id).html($("#newquantity"+id).val());
$("#newquantitycodeval"+id).css('display', 'inline');
$("#newquantity"+id).css('display', 'none');
$("#newquantitycodespan"+id).css('display', 'inline');
$("#newquantitycodeedit"+id).css('display', 'inline');
$("#newquantitycodeupdate"+id).css('display', 'none');
}
</script>
<script>
function editexpdate(id)
{
$("#productexpdateval"+id).css('display', 'none');
$("#expdate"+id).css('display', 'block');
$("#productexpdatespan"+id).css('display', 'inline');
$("#productexpdateedit"+id).css('display', 'none');
$("#productexpdateupdate"+id).css('display', 'inline');
}
function changeexpdate(id)
{
<?php
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
?>
var ymd = ($("#expdate"+id).val()).split('-');
if ((ymd[2]!=undefined)&&(ymd[1]!=undefined)&&(ymd[0]!=undefined)) {
var finalDate = ymd[2] + '/' + ymd[1] + '/' + ymd[0];
}
$("#productexpdateval"+id).html(finalDate);
<?php
}
?>
$("#productexpdateval"+id).css('display', 'inline');
$("#expdate"+id).css('display', 'none');
$("#productexpdatespan"+id).css('display', 'inline');
$("#productexpdateedit"+id).css('display', 'inline');
$("#productexpdateupdate"+id).css('display', 'none');
}
</script>
<script>
function editmrp(id)
{
$("#productmrpval"+id).css('display', 'none');
$("#mrp"+id).css('display', 'block');
$("#productmrpspan"+id).css('display', 'inline');
$("#productmrpedit"+id).css('display', 'none');
$("#productmrpupdate"+id).css('display', 'inline');
}
function changemrp(id)
{
$("#productmrpval"+id).html($("#mrp"+id).val());
$("#productmrpval"+id).css('display', 'inline');
$("#mrp"+id).css('display', 'none');
$("#productmrpspan"+id).css('display', 'inline');
$("#productmrpedit"+id).css('display', 'inline');
$("#productmrpupdate"+id).css('display', 'none');
}
</script>
<script>
function editnoofpacks(id)
{
$("#productnoofpacksval"+id).css('display', 'none');
$("#noofpacks"+id).css('display', 'block');
$("#productnoofpacksspan"+id).css('display', 'inline');
$("#productnoofpacksedit"+id).css('display', 'none');
$("#productnoofpacksupdate"+id).css('display', 'inline');
}
function changenoofpacks(id)
{
$("#productnoofpacksval"+id).html($("#noofpacks"+id).val());
$("#productnoofpacksval"+id).css('display', 'inline');
$("#noofpacks"+id).css('display', 'none');
$("#productnoofpacksspan"+id).css('display', 'inline');
$("#productnoofpacksedit"+id).css('display', 'inline');
$("#productnoofpacksupdate"+id).css('display', 'none');
}
</script>
<script>
function editprodiscount(id)
{
$("#productprodiscountval"+id).css('display', 'none');
$("#prodiscount"+id).css('display', 'block');
$("#productprodiscountspan"+id).css('display', 'inline');
$("#productprodiscountedit"+id).css('display', 'none');
$("#productprodiscountupdate"+id).css('display', 'inline');
}
function changeprodiscount(id)
{
$("#productprodiscountval"+id).html($("#prodiscount"+id).val());
$("#productprodiscountval"+id).css('display', 'inline');
$("#prodiscount"+id).css('display', 'none');
$("#productprodiscountspan"+id).css('display', 'inline');
$("#productprodiscountedit"+id).css('display', 'inline');
$("#productprodiscountupdate"+id).css('display', 'none');
}
</script>
<script>
function editvat(id)
{
$("#productvatval"+id).css('display', 'none');
$("#vat"+id).css('display', 'block');
$("#productvatspan"+id).css('display', 'inline');
$("#productvatedit"+id).css('display', 'none');
$("#productvatupdate"+id).css('display', 'inline');
}
function changevat(id)
{
$("#productvatval"+id).html($("#vat"+id).val());
$("#productvatval"+id).css('display', 'inline');
$("#vat"+id).css('display', 'none');
$("#productvatspan"+id).css('display', 'inline');
$("#productvatedit"+id).css('display', 'inline');
$("#productvatupdate"+id).css('display', 'none');
}
</script>
<script>
function isEmpty(object) {
for (const property in object) {
return false;
}
return true;
}
$(document).ready(function(){
$('#customer').change(function(){
$('#custaddressdiv').css("display", "none");
var id= $('#customer').val();
if(id != '')
{
$.get("customersearch1.php", {term: id} , function(data){
console.log(data);
const obj = JSON.parse(data);
if(isEmpty(obj)==false)
{
$('#custaddressdiv').css("display", "flex");
}
else
{
$('#custaddressdiv').css("display", "none");
}
console.log(obj[0]);
$("#customername").val(obj[0].customername);
$("#customerid").val(obj[0].id);
$("#area").val(obj[0].address);
$("#city").val(obj[0].city);
$("#district").val(obj[0].country);
$("#state").val(obj[0].state);
$("#pincode").val(obj[0].pin);
$("#gstno").val(obj[0].gstin);
$("#gstrtype").val(obj[0].gstrtype);
$("#workphone").val(obj[0].workphone);
$("#mobile").val(obj[0].mobile);
$("#sarea").val(obj[0].saddress);
$("#scity").val(obj[0].scity);
$("#sdistrict").val(obj[0].scountry);
$("#sstate").val(obj[0].sstate);
$("#spincode").val(obj[0].spin);
$("#pos").val(obj[0].pos);
//$( "#productname1" ).focus();
var ase=obj[0].address+' '+obj[0].city+' '+obj[0].state+' '+obj[0].pin+' '+obj[0].country+'';
ase=ase.trim();
var ase1=obj[0].saddress+' '+obj[0].scity+' '+obj[0].sstate+' '+obj[0].spin+' '+obj[0].scountry+'';
ase1=ase1.trim();
var ase2=obj[0].gstrtype+' '+obj[0].gstin+'';
ase2=ase2.trim();
var ase3=obj[0].workphone+' '+obj[0].mobile+'';
ase3=ase3.trim();
if(ase=="")
{
$("#billingaddressdiv").html(ase);
$("#billingaddressspan").html("Add New Address");
}
else
{
ase=obj[0].address+' '+obj[0].city+'<br>'+obj[0].state+' '+obj[0].pin+' '+obj[0].country+'';
$("#billingaddressdiv").html(ase);
$("#billingaddressspan").html("CHANGE");
}
if(ase1=="")
{
$("#shippingaddressdiv").html(ase1);
$("#shippingaddressspan").html("Add New Address");
}
else
{
ase1=obj[0].saddress+' '+obj[0].scity+'<br>'+obj[0].sstate+' '+obj[0].spin+' '+obj[0].scountry+'';
$("#shippingaddressdiv").html(ase1);
$("#shippingaddressspan").html("CHANGE");
}
if(ase2=="")
{
$("#gstrtypediv").html(ase2);
$("#gsttypespan").html("ADD NEW GSTIN");
}
else
{
ase2=obj[0].gstrtype+'<br>'+obj[0].gstin+'';
$("#gstrtypediv").html(ase2);
$("#gsttypespan").html("CHANGE");
}
if(ase3=="")
{
$("#workphonediv").html(ase3);
$("#worktypespan").html("ADD NEW PHONE");
}
else
{
ase3=obj[0].workphone+'<br>'+obj[0].mobile+'';
$("#workphonediv").html(ase3);
$("#worktypespan").html("CHANGE");
}
});
}
else
{
alert("Please Select Customer");
$('#custaddressdiv').css("display", "none");
}
});

//////////////////////

});
</script>
<script>
function productchange(lineNo)
{
var id= $('#product'+lineNo).val();
if(id != '')
{
$.get("prosearch1.php", {term: id} , function(data){
console.log(data);
const obj = JSON.parse(data);
console.log(obj[0]);
if (proalreadychnxtlvl==0) {
$("#productid"+lineNo).val(obj[0].id);
$("#productname"+lineNo).val(obj[0].productname);
$("#itemmodulespan"+lineNo).html(obj[0].itemmodule);
$("#itemmodulespan"+lineNo).css('display', 'inline');
$("#quantity"+lineNo).val(obj[0].openingstock);
$("#productexpdatespan"+lineNo).css('display', 'inline');
$("#productexpdateedit"+lineNo).css('display', 'inline');
$("#productexpdateupdate"+lineNo).css('display', 'none');
}
else{
$('#product'+lineNo).parents("tr").remove();
var btndel = document.getElementsByName('productname[]');
var btndels = document.getElementsByName('product[]');
if ((btndel.length>1)||(btndel[0].value!='')) {
for(i=0;i<btndel.length;i++){
if (btndels[i].value!=0) {
var ids = btndel[i].id.split('productname');
var id = ids[1];
productcalc(id);
}
}
}
}
});
var productid= $('#product'+lineNo).val();
var invbatchdef = '';
$.get("batchsearch.php", {term: productid,batchdef: invbatchdef} , function(datas){
console.log("normal"+datas);
$("#errbatch"+lineNo).val(datas);
var letters = "<br /><b>Warning</b>:  Undefined variable $datas in";
brrch = document.getElementById("errbatch"+lineNo);
if (brrch.value.includes(letters)) {
$("#outfordone"+lineNo).html("");
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
else{
const objbatch = JSON.parse(datas);
let check='';
var chnew = 0;
for (var key in objbatch) {
  console.log("key"+key);
chnew++;
  check+="<div id='option"+lineNo+chnew+'d'+"' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' id='batch"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].batch+"'>Batch : "+objbatch[key].batch+" </td><td align='right' id='qty"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].quantity+"'>Quantity : "+objbatch[key].quantity+" </td></tr><tr style='border-bottom:none;border-top:none;margin-bottom:0px;'><td align='left' id='exp"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;' title='"+objbatch[key].expdate+"'>Expiry : "+objbatch[key].expdate+" </td><td align='right' id='rate"+objbatch[key].batch+"' style='border:none;overflow:hidden;white-space:nowrap;'>Rate : "+objbatch[key].productrate+" </td></tr></table></div>";
}
console.log(check);
$("#outfordone"+lineNo).html(check);
var browsers = document.getElementById("outfordone"+lineNo);
browsers.style.display = 'none';
browsers.style.backgroundColor = 'transparent';
browsers.style.border = 'none';
}
});
}
}
</script>
<script>
function editexpdate(id)
{
$("#productexpdateval"+id).css('display', 'none');
$("#expdate"+id).css('display', 'inline');
$("#productexpdatespan"+id).css('display', 'inline');
$("#productexpdateedit"+id).css('display', 'none');
$("#productexpdateupdate"+id).css('display', 'inline');
}
function changeexpdate(id)
{
<?php
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
?>
var ymd = ($("#expdate"+id).val()).split('-');
if ((ymd[2]!=undefined)&&(ymd[1]!=undefined)&&(ymd[0]!=undefined)) {
var finalDate = ymd[2] + '/' + ymd[1] + '/' + ymd[0];
}
$("#productexpdateval"+id).html(finalDate);
<?php
}
?>
$("#productexpdateval"+id).css('display', 'inline');
$("#expdate"+id).css('display', 'none');
$("#productexpdatespan"+id).css('display', 'inline');
$("#productexpdateedit"+id).css('display', 'inline');
$("#productexpdateupdate"+id).css('display', 'none');
}
</script>
<script>
function productcalc(id)
{
var quantity = $('#quantity'+id).val();
var newquantity = $('#newquantity'+id).val();
if((quantity!='')&&(newquantity!=''))
{
if (newquantity>0) {
var productvalue = parseFloat(quantity)+parseFloat(newquantity);
}
else{
var productvalue = parseFloat(quantity)-parseFloat(Math.abs(newquantity));
}
$('#adjustment'+id).val(productvalue);
addnewrow(id+1);
}
}
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
<script>
$(function(){
$("[data-toggle=popover]").popover({
html : true,
content: function() {
var content = $(this).attr("data-popover-content");
return $(content).children(".popover-body").html();
},
title: function() {
var title = $(this).attr("data-popover-content");
return $(title).children(".popover-heading").html();
}
});
});
</script>
<script>
function funadddue() {
var missingduename = document.getElementById('missingduename');
var missingduedate = document.getElementById('missingduedate');
if (missingduename.value == ''||missingduedate.value == '') {
alert('Please Enter New Due Name And Due Date');
missingduename.focus();
return false;
}
else {
$('#duedateselects').append('<option value="' + missingduename.value + '">' + missingduename.value + '-' + missingduedate.value +
'</option>');
$('select[name^="duedateselects"] option[value="' + missingduename.value + '"]').attr("selected","selected");
$('#duedateselects').val(missingduename.value).change();
$('#AddNewDue').modal('hide');
return false;
}
}
function funesdue() {
// $('#duedateselects').val('').change();
$('#AddNewDue').modal('hide');
return false;
}
</script>
<script type="text/javascript">
$("#duedateselects").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewDue");
});
$("#duedateselects").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "+ New";
});
</script>
<!-- sve button spinner -->
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
<!-- purchase table add another row -->
<!------------------------------------------ pro script start ------------------------------------------>
<script type="text/javascript">
function title(x){
var Characters = x.value;
}
</script>
<script type="text/javascript">
function taxable() {
document.getElementById('protaxablediv').style.display = "block";
document.getElementById('pronontaxablediv').style.display = "none";
}
function nontaxable() {
document.getElementById('protaxablediv').style.display = "none";
document.getElementById('pronontaxablediv').style.display = "block";
}
</script>
<script type="text/javascript">
$(function() {
$("#adjustmentsuffix").autocomplete({
source: 'adjustmentsuffixsearch.php',
select: function(event, ui) {
$("#adjustmentsuffix").val(ui.item.adjustmentsuffix);
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
$("#prodefaultunit").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#proAddNewDefaultUnit') {
$('#proAddNewDefaultUnit').modal('show');
}
});
</script>
<script>
function profunadddefaultunit() {
var promissingdefaultunit = document.getElementById('promissingdefaultunit');
var prouqc = document.getElementById('prouqc');
if (promissingdefaultunit.value == ''||prouqc.value == '') {
alert('Please Enter New Default Unit Name And Uqc');
promissingdefaultunit.focus();
return false;
} else {
$('#prodefaultunit').append('<option value="' + promissingdefaultunit.value + ',' + prouqc.value + '">' + promissingdefaultunit.value + '-' + prouqc.value +
'</option>');
$('select[name^="prodefaultunit"] option[value="' + promissingdefaultunit.value + ',' + prouqc.value + '"]').attr("selected","selected");
$('#prodefaultunit').val(promissingdefaultunit.value).change();
$('#proAddNewDefaultUnit').modal('hide');
return false;
}
}
function profunesdefaultunit() {
$('#prodefaultunit').val('').change();
$('#proAddNewDefaultUnit').modal('hide');
return false;
}
</script>
<script>
$("#procategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#proAddNewCategory') {
$('#proAddNewCategory').modal('show');
}
});
$("#prosubcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#proAddNewSubCategory') {
$('#proAddNewSubCategory').modal('show');
}
});
</script>
<script>
function profunaddcategory() {
var promissingcategory = document.getElementById('promissingcategory');
if (promissingcategory.value == '') {
alert('Please Enter New Category Name');
promissingcategory.focus();
return false;
} else {
$('#procategory').append('<option value="' + promissingcategory.value + '">' + promissingcategory.value +
'</option>');
$('#procategory').val(promissingcategory.value).change();
$('#proAddNewCategory').modal('hide');
return false;
}
}
function profunescategory() {
$('#procategory').val('').change();
$('#proAddNewCategory').modal('hide');
return false;
}
</script>
<script>
function profunaddsubcategory() {
var promissingsubcategory = document.getElementById('promissingsubcategory');
if (promissingsubcategory.value == '') {
alert('Please Enter New Sub Category Name');
promissingsubcategory.focus();
return false;
} else {
$('#prosubcategory').append('<option value="' + promissingsubcategory.value + '">' + promissingsubcategory.value +
'</option>');
$('#prosubcategory').val(promissingsubcategory.value).change();
$('#proAddNewSubCategory').modal('hide');
return false;
}
}
function profunessubcategory() {
$('#prosubcategory').val('').change();
$('#proAddNewSubCategory').modal('hide');
return false;
}
</script>
<!-- <script type="text/javascript">
function funaddintratax() {
var missingintra = document.getElementById('missingintratax');
if (missingintratax.value == '') {
alert('Please Enter New Intra Tax');
missingintratax.focus();
return false;
} else {
$('#intratax').append('<option value="' + missingintratax.value + '">' + missingintratax.value +
'</option>');
$('#intratax').val(missingintratax.value).change();
$('#NewIntraTax').modal('hide');
return false;
}
}
function funesintratax() {
$('#intratax').val('').change();
$('#NewIntraTax').modal('hide');
return false;
}
</script> -->
<script type="text/javascript">
$(function() {
$("#proproductname").autocomplete({
source: 'productsearch.php?type=proproductname',
});
$("#procategory").autocomplete({
source: 'productsearch.php?type=procategory',
});
});
</script>
<script>
let lineNo = 2;
$(document).ready(function() {
$(".purchaseadd-row").click(function() {
markup =
'<tr><td style="width:3%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td style="width:18%;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="proproductname[]" id="proproductname1' +
lineNo +
'" required class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title=""></td><td style="width:11%;"><div class="input-group mb-3 input-group-sm"><div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1' +
lineNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div><td style="width: 6%;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1' +
lineNo +
'" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1' +
lineNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td style="width:3%;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>';
tableBody = $("#purchasetable");
tableBody.append(markup);
renumber_table('#purchasetable');
lineNo++;
});
});
</script>
<script>
let linesNo = 2;
$(document).ready(function() {
$(".saleadd-row").click(function() {
markup =
'<tr><td data-label="" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td data-label="PRICE NAME" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><input type="hidden" name="productid[]" id="productid1"><input type="text" name="proproductname[]" id="proproductname1" required class="form-control form-control-sm bordernoneinput bor"  style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title="" placeholder="Sale Price or Trade Price or Wholesale Price"></td><td data-label="MRP" style="padding-bottom:0px !important;margin-bottom: -18px !important;padding-top: 13.2px !important;"><div class="input-group mb-3 input-group-sm"><div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div></td><td data-label="SELLING PRICE" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td data-label="DESCRIPTION" style="padding-bottom:0px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td data-label="" style="padding-bottom: 9px !important;margin-bottom: 0px !important;padding-top: 13.2px !important;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-deletes" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td></tr>';
tableBody = $("#saletable");
tableBody.append(markup);
var start = moment().subtract(29, 'days');
var end = moment();
$('#reportrange' + linesNo).daterangepicker({
startDate: start,
endDate: end,
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
.subtract(1, 'month').endOf('month')
]
},
"alwaysShowCalendars": true,
"applyClass": "btn-custom",
"cancelClass": "btn-custom-grey"
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') +
' to ' + end.format('YYYY-MM-DD'));
});
renumber_table('#saletable');
linesNo++;
});
});
</script>
<script>
let linesNo = 2;
$(document).ready(function() {
$(".inventoryadd-row").click(function() {
markup =
'<tr><td style="width:3%;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td style="width:18%;"><input type="hidden" name="productid[]" id="productid1' +
linesNo +
'"><input type="text" name="proproductname[]" id="proproductname1" required class="form-control form-control-sm bordernoneinput bor"  style="height:21px;padding: 0px;" oninput="title(this)" data-toggle="tooltip" title=""></td><td style="width:11%;"> <div class="input-group mb-3 input-group-sm"> <div class="input-group-prepend"><span class="input-group-text" style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></span></div><input type="age" min="0" name="quantity[]" required id="quantity1' +
linesNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;" onChange="productcalc(1)"></div></td><td style="width: 6%;"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"  style="color: #495057;padding: 8px 3.75px;height:21px;"><?php echo $rescurrency[0]; ?></div></div><input  oninput="increaseWidth(this)" style="height:21px;width: 24px;text-align: right;padding: 0px;" placeholder="0.00" type="age" min="0" name="productrate[]"  required id="productrate1" class="form-control form-control-sm bordernoneinput rup" onChange="productcalc(1)"></div></td><td style="width:18%;"><input type="number" min="0" step="0.01" name="vat[]" id="vat1' +
linesNo +
'" class="form-control form-control-sm bordernoneinput bor" style="height:21px;padding: 0px;text-align: left;"></td><td style="width:3%;"><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete' +
linesNo +
'" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>';
tableBody = $("#inventorytable");
tableBody.append(markup);
var start = moment().subtract(29, 'days');
var end = moment();
$('#reportrange' + linesNo).daterangepicker({
startDate: start,
endDate: end,
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
.subtract(1, 'month').endOf('month')
]
},
"alwaysShowCalendars": true,
"applyClass": "btn-custom",
"cancelClass": "btn-custom-grey"
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') +
' to ' + end.format('YYYY-MM-DD'));
});
renumber_table('#inventorytable');
linesNo++;
});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
//Helper function to keep table row from collapsing when being sorted
var fixHelperModified = function(e, tr) {
var $originals = tr.children();
var $helper = tr.clone();
$helper.children().each(function(index) {
$(this).width($originals.eq(index).width())
});
return $helper;
};
//Make diagnosis table sortable
$("#purchasetable tbody").sortable({
helper: fixHelperModified,
stop: function(event, ui) {
renumber_table('#purchasetable')
}
}).disableSelection();
//Make diagnosis table sortable
$("#saletable tbody").sortable({
helper: fixHelperModified,
stop: function(event, ui) {
renumber_table('#saletable')
}
}).disableSelection();
$("#inventorytable tbody").sortable({
helper: fixHelperModified,
stop: function(event, ui) {
renumber_table('#inventorytable')
}
}).disableSelection();
//Delete button in table rows
//     $('table').on('click', '.btn-delete', function() {
//         tableID = '#' + $(this).closest('table').attr('id');
//         r = confirm('Delete this item?');
//         if (r) {
//             $(this).closest('tr').remove();
//             renumber_table(tableID);
//         }
//     });
// });
$('table').on('click','.btn-delete',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("purchasetable").rows.length;
if(x!=2)
{
// r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
}
}
else
{
// alert('Unable to Delete First row');
}
});
});
//Renumber  table rows
function renumber_table(tableID) {
$(tableID + " tr").each(function() {
count = $(this).parent().children().index($(this)) + 1;
$(this).find('.priority').html(count);
});
}
</script>
<script type="text/javascript">
$(document).ready(function() {
$('table').on('click','.btn-deletes',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("saletable").rows.length;
if(x!=2)
{
// r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
}
}
else
{
// alert('Unable to Delete First row');
}
});
});
</script>
<!------------------------------------------------ what is this ------------------------------------------------>
<!-- <script>
$("#prosubcategory").select2({
placeholder: "Select Country",
allowClear: true
});
</script> -->
<!------------------------------------------------ what is this ------------------------------------------------>
<script>
function readURL(input, imgControlName) {
if (input.files && input.files[0]) {
var reader = new FileReader();
reader.onload = function(e) {
$(imgControlName).attr('src', e.target.result);
}
reader.readAsDataURL(input.files[0]);
}
}
$("#imag").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview";
readURL(this, imgControlName);
$('.preview1').addClass('it');
$('#removeImage1').css("color", "black");
});
$("#imag2").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview2";
readURL(this, imgControlName);
$('.preview2').addClass('it');
$('.btn-rmv2').addClass('rmv');
});
$("#imag3").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview3";
readURL(this, imgControlName);
$('.preview3').addClass('it');
$('.btn-rmv3').addClass('rmv');
});
$("#imag4").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview4";
readURL(this, imgControlName);
$('.preview4').addClass('it');
$('.btn-rmv4').addClass('rmv');
});
$("#imag5").change(function() {
// add your logic to decide which image control you'll use
var imgControlName = "#ImgPreview5";
readURL(this, imgControlName);
$('.preview5').addClass('it');
});
$("#removeImage1").click(function(e) {
e.preventDefault();
$("#imag").val("");
$("#ImgPreview").attr("src",
"assets/img/productimage1.png"
);
$('.preview1').removeClass('it');
$('#removeImage1').css("color", "#6c757d");
});
$("#removeImage2").click(function(e) {
e.preventDefault();
$("#imag2").val("");
$("#ImgPreview2").attr("src",
"assets/img/productimage1.png"
);
$('.preview2').removeClass('it');
$('#removeImage2').css("color", "#6c757d");
});
$("#removeImage3").click(function(e) {
e.preventDefault();
$("#imag3").val("");
$("#ImgPreview3").attr("src",
"assets/img/productimage1.png"
);
$('.preview3').removeClass('it');
$('#removeImage3').css("color", "#6c757d");
});
$("#removeImage4").click(function(e) {
e.preventDefault();
$("#imag4").val("");
$("#ImgPreview4").attr("src",
"assets/img/productimage1.png"
);
$('.preview4').removeClass('it');
$('#removeImage4').css("color", "#6c757d");
});
$("#removeImage5").click(function(e) {
e.preventDefault();
$("#imag5").val("");
$("#ImgPreview5").attr("src",
"assets/img/productimage1.png"
);
$('.preview5').removeClass('it');
$('#removeImage5').css("color", "#6c757d");
});
</script>
<script>
var fixHelperModified = function(e, tr) {
var $originals = tr.children();
var $helper = tr.clone();
$helper.children().each(function(index) {
$(this).width($originals.eq(index).width())
});
return $helper;
},
updateIndex = function(e, ui) {
$('td.index', ui.item.parent()).each(function(i) {
$(this).html(i + 1);
});
$('input[type=text]', ui.item.parent()).each(function(i) {
$(this).val(i + 1);
});
};
$("#purchasetable tbody").sortable({
helper: fixHelperModified,
stop: updateIndex
}).disableSelection();
$("tbody").sortable({
distance: 5,
delay: 100,
opacity: 0.6,
cursor: 'move',
update: function() {}
});
</script>
<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<script>
$(function() {
var start = moment().subtract(29, 'days');
var end = moment();
$('#reportrange1').daterangepicker({
startDate: start,
endDate: end,
ranges: {
'Today': [moment(), moment()],
'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
'Last 7 Days': [moment().subtract(6, 'days'), moment()],
'Last 30 Days': [moment().subtract(29, 'days'), moment()],
'This Month': [moment().startOf('month'), moment().endOf('month')],
'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
'month').endOf('month')]
},
"alwaysShowCalendars": true,
"applyClass": "btn-custom",
"cancelClass": "btn-custom-grey"
}, function(start, end, label) {
console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
.format('YYYY-MM-DD'));
});
});
</script>
<script>
$(document).ready(function() {
$("#prodefaultunit").change(function(event) {
$('.unitchange span').html($(this).val());
});
});
$('#purchaseunit').on('change', function() {
var defaultunitval = $('#defaultunit').find(":selected").val();
var purchaseunitval = $('#purchaseunit').find(":selected").val();
if (defaultunitval === purchaseunitval) {
$('#purchaseindunit1').attr('disabled', true);
} else {
$('#purchaseindunit1').attr('disabled', false);
}
});
$('#salesunit').on('change', function() {
var defaultunitval = $('#defaultunit').find(":selected").val();
var salesunittval = $('#salesunit').find(":selected").val();
if (defaultunitval === salesunittval) {
$('#saleindunit').attr('disabled', true);
} else {
$('#saleindunit').attr('disabled', false);
}
});
</script>
<script>
$(document).ready(function() {
$('[data-toggle="tooltip"]').tooltip();
});
$("#submit").click(function() {
$(".Spinnn").css("display", "block");
$(".Spinnn").fadeOut(200);
});
checkBox = document.getElementById('trackinventory').addEventListener('click', event => {
if (event.target.checked) {
document.getElementById('table').style.display='none';
} else {
document.getElementById('table').style.display='block';
}
});
$('#ImgPreview').click(function() {
$('#imag').click();
});
$('#ImgPreview2').click(function() {
$('#imag2').click();
});
$('#ImgPreview3').click(function() {
$('#imag3').click();
});
$('#ImgPreview4').click(function() {
$('#imag4').click();
});
$('#ImgPreview5').click(function() {
$('#imag5').click();
});
</script>
<script>
var buttons = document.querySelectorAll( '.arlina-button' );
Array.prototype.slice.call( buttons ).forEach( function( button ) {
var resetTimeout;
button.addEventListener( 'click', function() {
if( typeof button.getAttribute( 'data-loading' ) === 'string' ) {
button.removeAttribute( 'data-loading' );
}
else {
button.setAttribute( 'data-loading', '' );
}
clearTimeout( resetTimeout );
resetTimeout = setTimeout( function() {
button.removeAttribute( 'data-loading' );
}, 1000 );
}, false );
} );
</script>
<script>
$("#prointratax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prointertax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prosubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewSubCategory");
});
$("#prosubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#procategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewCategory");
});
$("#procategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Category";
});
$("#prodefaultunit").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewDefaultUnit");
});
$("#prodefaultunit").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Unit";
});
$("#prointratax").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Intra Tax";
});
$("#prointratax").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#NewIntraTax");
});
</script>
<!-- <script>
function funaddproduct() {
var missingproduct = document.getElementById('proproductname');
if (missingproduct.value == '') {
alert('Please Enter New Product Name');
missingproduct.focus();
return false;
}
else {
$('#AddNewProduct').modal('hide');
return false;
}
}
function funesproduct() {
$('#AddNewProduct').modal('hide');
return false;
}
</script> -->
<script>
$(document).ready(function(){
$("#submitproduct").click(function(e){
e.preventDefault();
var proproductname=$("#proproductname").val();
var prodefaultunit = document.getElementById("prodefaultunit");
var prodefaultunitans = prodefaultunit.options[prodefaultunit.selectedIndex].text;
if(proproductname==""||prodefaultunitans=="Unit")
{
if (proproductname == '') {alert("Please Enter the <?=$infomainaccessuserpro['modulename']?> Name");}
else if (prodefaultunitans=="Unit") {alert("Please Select the Unit");}
return false;
}
else
{
$.ajax({type: "POST",
url: "productadds.php",
data: {
productname: $("#proproductname").val(),
codetags: $("#procodetags").val(),
hsncode: $("#prohsncode").val(),
delivery: $("#prodelinpbrd").val(),
defaultunit: $("#prodefaultunit").val(),
procategory: $("#procategory").val(),
prosubcategory: $("#prosubcategory").val(),
rack: $("#prorack").val(),
description: $("#prodescription").val(),
provisibility: $("#provisibility").val(),
taxable: $("#protaxable").val(),
intratax: $("#prointratax").val(),
intertax: $("#prointertax").val(),
pricename: $("#proproductname1").val(),
mrp: $("#proquantity1").val(),
sellingprice: $("#proproductrate1").val(),
descriptions: $("#provat1").val(),
pricenamepur: $("#purproproductname1").val(),
mrppur: $("#purproquantity1").val(),
sellingpricepur: $("#purproproductrate1").val(),
descriptionspur: $("#purprovat1").val(),
submit: "Submit"
},
success:function(result){
$.ajax({
type: "POST",
url: "productaddmodal.php",
success: function(data){
$("#promodal").html(data);
}
});
$('.select2-field').select2({
tags: "true"
});
$(function(){
$("#custgstrtype").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
return $(
'<div><div>' + state.text + '</div><div class="foo">'
+ $(state.element).attr('data-foo')
+ '</div></div>'
);
}
$("#prointratax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prointertax").on("select2:open", function() {
$("#configureunits").hide();
});
$("#prosubcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewSubCategory");
});
$("#prosubcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#procategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewCategory");
});
$("#procategory").on("select2:open", function() { document.getElementById("configureunits").innerHTML = "New <?=$access['txtnamecategory']?>";
});
$("#prodefaultunit").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#proAddNewDefaultUnit");
});
$("#prodefaultunit").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Unit";
});
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
var proproductname=$("#prooriginpage").val();
var proids=$("#ppp").val();
$('.adjustingproduct1').append('<option value="' + resarray[1] + '">' + proproductname + '</option>');
$('select[name^="product'+proids+'"] option[value="' + resarray[1] + '"]').attr("selected","selected");
$('#product'+proids+'').val(resarray[1]).change();
$('#AddNewProduct').modal('hide');
}
}});
}
});
});
</script>

<script>
function funaddproduct() {
var missingproduct = document.getElementById('proproductname');
var prodefaultunit = document.getElementById("prodefaultunit");
var prodefaultunitans = prodefaultunit.options[prodefaultunit.selectedIndex].text;
if (missingproduct.value == ''||prodefaultunitans=="Unit") {
// alert('Please Enter New Product Name');
if (missingproduct.value == '') {missingproduct.focus();}
else if (prodefaultunitans=="Unit") {prodefaultunit.focus();}
return false;
}
else {
$('#AddNewProduct').modal('hide');
return false;
}
}
function funesproduct() {
$('#AddNewProduct').modal('hide');
return false;
}
</script>
<!------------------------------------------- pro script end ------------------------------------------->
<!--term start-->
<div class="modal fade" id="AddNewAdjustmentReason" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New Reason</h5>
<span type="button" onclick="funesadjustmentreason()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="closeicon">&times;</span>
</span>
</div>
<div class="modal-body">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingadjustmentreason" class="custom-label"><span class="text-danger">
Reason *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="adjustmentreason" class="form-control form-control-sm mb-4" id="missingadjustmentreason" placeholder="Name" required>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer ">
<div class="col">
<button   onclick="funaddadjustmentreason()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitadjustmentreason" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funesadjustmentreason()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<script>
$("#adjustmentreason").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewAdjustmentReason') {
$('#AddNewAdjustmentReason').modal('show');
}
});
function funaddadjustmentreason() {
var missingadjustmentreason = document.getElementById('missingadjustmentreason');
if (missingadjustmentreason.value == '') {
alert('Please Enter New AdjustmentReason Name');
missingadjustmentreason.focus();
return false;
} else {

$.ajax({type: "POST",
url: "reasonadds.php",
data: {
reason: $("#missingadjustmentreason").val(),
itemmodule: 'adjustment',
submit: "Submit"
},
success:function(result){
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
$("#adjustmentreason").select2();
$('#AddNewAdjustmentReason').modal('hide');
}
else
{
$('#adjustmentreason').append('<option value="' + missingadjustmentreason.value + '">' + missingadjustmentreason.value +
'</option>');
$('#adjustmentreason').val(missingadjustmentreason.value).change();
$("#adjustmentreason").select2();
$('#AddNewAdjustmentReason').modal('hide');
return false;
}
}});



}
}
function funesadjustmentreason() {
//$('#adjustmentreason').val('').change();
$("#adjustmentreason").select2();
$('#AddNewAdjustmentReason').modal('hide');
return false;
}
$("#adjustmentreason").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewAdjustmentReason");
});
$("#adjustmentreason").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New AdjustmentReason";
});
</script>
<!--term end-->

<!--duedates start-->
<div class="modal fade" id="AddNewDueDate" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New Due Date</h5>
<span type="button" onclick="funesduedates()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="closeicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingduedates" class="custom-label"><span class="text-danger">
Name *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="duedates" class="form-control form-control-sm mb-1" id="missingduedates" placeholder="Name" required>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingnoofdays" class="custom-label"><span class="text-danger">
No of Dates *</span></label>
</div>
<div class="col-sm-7">
<input type="number" min="0" step="1" name="duedates" class="form-control form-control-sm mb-4" id="missingnoofdays" placeholder="No of Days" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer ">
<div class="col">
<button   onclick="funaddduedates()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitduedates" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funesduedates()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<script>
$("#duedates").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewDueDate') {
$('#AddNewDueDate').modal('show');
}
});
function funaddduedates() {
var missingduedates = document.getElementById('missingduedates');
var missingnoofdays = document.getElementById('missingnoofdays');
if (missingduedates.value == '') {
alert('Please Enter New DueDate Name');
missingduedates.focus();
return false;
} else if (missingnoofdays.value == '') {
alert('Please Enter New DueDate No of Days');
missingnoofdays.focus();
return false;
} else {

$.ajax({type: "POST",
url: "duedateadds.php",
data: {
duedate: $("#missingduedates").val(),
noofdays: $("#missingnoofdays").val(),
submit: "Submit"
},
success:function(result){
const resarray = result.split("|");
alert(resarray[0]);
if(resarray[1]=='0')
{
}
else
{
$('#duedates').append('<option value="' + missingnoofdays.value + '">' + missingduedates.value +
'</option>');
$('#duedates').val(missingnoofdays.value).change();
$("#duedates").select2();
$('#AddNewDueDate').modal('hide');
return false;
}
}});
}
}
function funesduedates() {
//$('#duedates').val('').change();
$("#duedates").select2();
$('#AddNewDueDate').modal('hide');
return false;
}
$("#duedates").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewDueDate");
});
$("#duedates").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = " New ";
});
</script>
<!--duedates end-->
<!--adjustment attach start-->
<script>
$(document).ready(function (){
$("#fileattach").change(function (){
if($("#fileattach").get(0).files.length>5)
{
alert("Sorry only 5 files allowed");
$("#fileattach").val("");
return false;
}
else
{
for (var i = 0; i < $("#fileattach").get(0).files.length; ++i) {
var file1=$("#fileattach").get(0).files[i].name;

if(file1){
var file_size=$("#fileattach").get(0).files[i].size;
const files = Math.round((file_size / 1024));
if(files<5000){
var ext = file1.split('.').pop().toLowerCase();
if($.inArray(ext,['jpg','jpeg','gif','doc','docx','xls','xlsx','pdf'])===-1){
alert("Invalid file extension");
$("#fileattach").val("");
return false;
}

}else{
alert("One of the File size is too large.");
$("#fileattach").val("");
return false;
}
}else{
alert("Choose Any Attachment");
return false;
}
}
}
});
});
</script>
<!--adjustment attach end-->
<!---gst---->
<script>
$("#gstgstrtype").on("select2:open", function() {
$("#configureunits").hide();
});
</script>
<!---gst---->
<!---payment confirm---->
<script>
function triggerpayment(adjustmentno,adjustmentdate,adjustmentamount,cancelstatus)
{
let allAreFilled = true;
document.getElementById("adjustmentform").querySelectorAll("[required]").forEach(function(i) {
if (!allAreFilled) return;
if (i.type === "radio") {
let radioValueCheck = false;
document.getElementById("adjustmentform").querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
if (r.checked) radioValueCheck = true;
})
allAreFilled = radioValueCheck;
return;
}
if (!i.value) { allAreFilled = false; return; }
})
if (!allAreFilled) {
alert('Fill all the fields');
}
else
{
$('#validadjustmentno').val($('#adjustmentno').val());
$('#validadjustmentdate').val($('#adjustmentdate').val());
$('#validadjustmentamount').val($('#grandtotal').val());
$('#triggerconfirm-adddelete').modal('show');
}
}

</script>
<!---payment confirm---->
<!----rupees--->
<script>function Rs(amount){
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

function RsPaise(n){
nums = n.toString().split('.')
var whole = Rs(nums[0])
if(nums[1]==null)nums[1]=0;
if(nums[1].length == 1 )nums[1]=nums[1]+'0';
if(nums[1].length> 2){nums[1]=nums[1].substring(2,length - 1)}
if(nums.length == 2){
if(nums[0]<=9){nums[0]=nums[0]*10} else {nums[0]=nums[0]};
var fraction = Rs(nums[1])
if(whole=='' && fraction==''){op= 'Zero only';}
if(whole=='' && fraction!=''){op= 'paise ' + fraction + ' only';}
if(whole!='' && fraction==''){op='Rupees ' + whole + ' only';}
if(whole!='' && fraction!=''){op='Rupees ' + whole + 'and paise ' + fraction + ' only';}
amt=n;
if(amt > 999999999.99){op='Oops!!! The amount is too big to convert';}
if(isNaN(amt) == true ){op='Error : Amount in number appears to be incorrect. Please Check.';}
document.getElementById('grandwords').innerHTML="<hr>"+op;}}
RsPaise(0);
</script>
<script>
var alertsbatchexpiry = true;
function batchget(id)
{
if($("#productid"+id).val()=='')
{
$("#product"+id).focus();
alert('Please Select <?=$infomainaccessuserpro['modulename']?>');
}
else
{
var input = document.getElementById("batch"+id);
var browsers = document.getElementById("outfordone"+id);
browsers.style.display = 'block';
var productid= $('#product'+id).val();
input.onclick = function () {
browsers.style.display = 'block';
$("#outfordone"+id).scrollTop( 1 );
$("#outfordone"+id).on('scroll', function() {
var scrollTop = $(this).scrollTop();
  if (scrollTop + $(this).innerHeight() >= this.scrollHeight) {
$("#outfordone"+id).scrollTop( 201.3 );
  } else if (scrollTop <= 0) {
$("#outfordone"+id).scrollTop( 1 );
  }
});
$("body").on("click",function() {
if($("#batch"+id).is(":focus")){
browsers.style.display = 'block';
$("#outfordone"+id).scrollTop( 1 );
$("#outfordone"+id).on('scroll', function() {
var scrollTop = $(this).scrollTop();
  if (scrollTop + $(this).innerHeight() >= this.scrollHeight) {
$("#outfordone"+id).scrollTop( 201.3 );
  } else if (scrollTop <= 0) {
$("#outfordone"+id).scrollTop( 1 );
  }
});
}
else{
browsers.style.display = 'none';
alertsbatchexpiry = true;
}
});
}
$('#batch'+id).change(function(){
var oldproductnames = document.getElementsByName('productname[]');
var oldbatch = document.getElementsByName('batch[]');
var oldexp = document.getElementsByName('expdate[]');
var batexpoldornow = 0;
for (var i = 0; i < oldproductnames.length; i++){
if (i+1!=id) {
if ((oldproductnames[i].value==$('#productname'+id).val())&&(oldbatch[i].value==$('#batch'+id).val())&&(oldexp[i].value==$('#expdate'+id).val())) {
batexpoldornow++;
}
}
}
if (batexpoldornow==0) {
alertsbatchexpiry = true;
}
else{
if (alertsbatchexpiry==true) {
    alert("Already Selected This Batch And Expiry Please Select Another One!");
    $('#batch'+id).focus();
    alertsbatchexpiry=false;
}
}
});
var invbatchdef = '';
$.get("batchsearch.php", {term: productid,batchdef: invbatchdef} , function(datas){
const objbatch = JSON.parse(datas);
option='';
batch='';
exp='';
qty='';
rate='';
var chnew = 0;
for (var key in objbatch) {
chnew++;
option+='option'+id+chnew+'d'+';';
batch+='batch'+objbatch[key].batch+';';
exp+='exp'+objbatch[key].batch+';';
qty+='qty'+objbatch[key].batch+';';
rate+='rate'+objbatch[key].batch+';';
}
optionspl = option.split(';');
batchspl = batch.split(';');
expspl = exp.split(';');
qtyspl = qty.split(';');
ratespl = rate.split(';');
for (var i = 0; i <= optionspl.length; i++) {
var optionans = document.getElementById(optionspl[i]);
$("#"+optionspl[i]).on("click",function() {
const child = this.children;
const childone = child[0].children;
const childtwo = childone[0].children;
var batchqty = childtwo[0].innerHTML;
var batqtyspl = batchqty.split(" ");
var exprate = childtwo[1].innerHTML;
var expratespl = exprate.split(" ");
var oldproductnames = document.getElementsByName('productname[]');
var oldbatch = document.getElementsByName('batch[]');
var oldexp = document.getElementsByName('expdate[]');
var batexpoldornow = 0;
for (var i = 0; i < oldproductnames.length; i++){
if (i+1!=id) {
if ((oldproductnames[i].value==$('#productname'+id).val())&&(oldbatch[i].value==batqtyspl[6])&&(oldexp[i].value==expratespl[6])) {
batexpoldornow++;
}
}
}
if (batexpoldornow==0) {
$('#batch'+id).val(batqtyspl[6]);
$("#productexpdateval"+id).html(expratespl[6]);
var ymd = expratespl[6].split('/');
var finalDate = ymd[2] + '-' + ymd[1] + '-' + ymd[0];
$("#expdate"+id).val(finalDate);
$("#quantity"+id).val(batqtyspl[13]);
$('#newquantity'+id).focus();
productcalc(id);
alertsbatchexpiry = true;
}
else{
if (alertsbatchexpiry==true) {
    alert("Already Selected This Batch And Expiry Please Select Another One!");
    alertsbatchexpiry=false;
}
}
});
}
});
$('#batch'+id).on("keyup", function() {
alertsbatchexpiry = true;
var value = $(this).val().toLowerCase();
$("#outfordone"+id+" "+"table").filter(function() {
$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
if ($(this).text().toLowerCase().indexOf(value) > -1) {
    $(this).parent().css({"display": "block"});
var browsers = document.getElementById("outfordone"+id);
    browsers.style.display = 'block';
}
else{
    $(this).parent().css({"display": "none"});
var oldproductnames = document.getElementsByName('productname[]');
var browsers = document.getElementById("outfordone"+id);
for (var i = 0; i < oldproductnames.length; i++){
if(document.getElementById("outfordone"+(i+1)).innerHTML!=''){
    var lenofold = document.querySelectorAll("#outfordone"+(i+1)+" table").length;
}
    else{
    var lenofold = 0;
    }
    if (lenofold==0) {
    browsers.style.display = 'none';
    }
    else{
    browsers.style.display = 'block';
    }
}
}
});
});
}
}
</script>
<script>
$(document).ready(function (){
$("#customer").trigger("change");
});
</script>


</body>
</html>
<?php
}
else{
header("Location:adjustments.php?error=No Information Found");
}
}
else{
header("Location:adjustments.php?error=No Information Found");  
}
?>