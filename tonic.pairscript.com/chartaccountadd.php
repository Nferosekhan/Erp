<?php
include('lcheck.php');
if($permissionfranchise=='0'||$permissionfranchise=='1')
{
	header('Location: dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
if (isset($_POST['submit'])) {

$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Chart of Accounts' order by id  asc");
$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Chart of Accounts' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
$publicsql=mysqli_query($con,"select count(publicid) from pairchartaccountings where createdid='$companymainid'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publicid=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
$privatesql=mysqli_query($con,"select count(privateid) from pairchartaccountings where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privateid=$infomainaccesspublicname['moduleprefix'] . $infomainaccesspublicname['modulesuffix']+1;

$accountcategory= mysqli_real_escape_string($con,$_POST['chartaccountcategory']);
$accountname = mysqli_real_escape_string($con,$_POST['chartaccountname']);
$subaccountcheck = mysqli_real_escape_string($con, (isset($_POST['subaccount'])) ? '1' : '0');
if (isset($_POST['parentaccount'])) {
$parentaccount = mysqli_real_escape_string($con,$_POST['parentaccount']);
}
else{
$parentaccount = '';
}
$accountcode = mysqli_real_escape_string($con,$_POST['chartaccountcode']);
$description = mysqli_real_escape_string($con,$_POST['notes']);
// $watchlist = mysqli_real_escape_string($con, (isset($_POST['watchlist'])) ? '1' : '0');,watchlist='$watchlist'

$selexistings = mysqli_query($con,"select id from pairchartaccountings where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and accountname='$accountname' and accountcategory='$accountcategory'");

if (mysqli_num_rows($selexistings)>0) {

header("Location:chartaccounts.php?error=Account Already Existed");

}
else{

$sql=mysqli_query($con,"insert into pairchartaccountings set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$times',   accountcategory='$accountcategory',  accountcode='$accountcode', accountname='$accountname', description='$description',publicid='$publicid',privateid='$privateid',subaccountcheck='$subaccountcheck',parentaccount='$parentaccount'");
$accountid = mysqli_insert_id($con);
$sql3=mysqli_query($con, "update pairmainaccess set modulesuffix=modulesuffix+1 where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Chart of Accounts'");

$seloldval = mysqli_query($con,"select optionslist from pairchartaccounttypes where id='".$accountcategory."'");

$fetoldval = mysqli_fetch_array($seloldval);
$explodeoptions = explode(';', $fetoldval['optionslist']);
$finishopt = '';

if (isset($_POST['parentaccount'])) {

for($i=0;$i<count($explodeoptions)-1;$i++){
$finalvalues = explode(',',$explodeoptions[$i]);

if ($finalvalues[0]==$parentaccount) {
$selpadding = mysqli_query($con,"select count(id) from pairchartaccountings where parentaccount='".$parentaccount."'");
$fetpadding = mysqli_fetch_array($selpadding);
$finishopt .= $finalvalues[0].','.$finalvalues[1].','.$finalvalues[2].','.$finalvalues[3].';'.$accountid.','.$accountname.','.$parentaccount.','.($finalvalues[3]+10).';';
}
else{
$finishopt .= $finalvalues[0].','.$finalvalues[1].','.$finalvalues[2].','.$finalvalues[3].';';
}

}

}
else{

if ($fetoldval['optionslist']!='') {

for($i=0;$i<count($explodeoptions)-1;$i++){
$finalvalues = explode(',',$explodeoptions[$i]);

$finishopt .= $finalvalues[0].','.$finalvalues[1].','.$finalvalues[2].','.$finalvalues[3].';';

}

}
else{
$finishopt .= $accountid.','.$accountname.',0,10;';
}

}

if (!isset($_POST['parentaccount'])) {
if ($fetoldval['optionslist']!='') {
$finishopt .= $accountid.','.$accountname.',0,10;';
}
}

$updoldval = mysqli_query($con,"update pairchartaccounttypes set optionslist='$finishopt' where id='".$accountcategory."'");

if ($updoldval) {
header("Location:chartaccounts.php?remarks=Added Successfully");
}

}

}
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Chart of Accounts' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccesscreate']==0)))) {
header('Location:dashboard.php');
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
New <?= $infomainaccessuser['modulename'] ?>
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Chart of Accounts' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
 ?>
   <div style="max-width: 1650px;">
  <div class="row min-height-480">
<div class="col-12">
  <div class="card mb-4 mt-5">
 <div class="card-body p-3">

 <p class="mb-3" style="font-size:20px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-file-import"></i> New <?= $infomainaccessuser['modulename'] ?></p>
 <?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Chart of Accounts' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
    <div class="alert alert-danger mt-2 text-white">Sorry! Chart of Accounts is Allowed for this Franchise</div>
    <?php
}
else
{
?>
<!------------------------------------------ New Type Start ------------------------------------------>
<div class="modal fade" id="AddNewDefaultCategoryName" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">New Account Category</h5>
<span type="button" onclick="funeschartaccountcategory()" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true" id="procloseicon">&times;</span>
</span>
</div>
<!-- <form action="" method="post" enctype="multipart/form-data" class="form-horizontal mt-2" role="form"> -->
<div class="modal-body mbsub" id="promodal">
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="accountgroupmodal" class="custom-label text-danger">
                        <span>Account Group *</span>
                    </label>
                </div>
                    <input type="text" class="form-control form-control-sm" id="accountgroupmodal" name="accountgroupmodal" placeholder="Account Group" required>
            </div>
            <div class="col-md-7">
                <div class="form-group row">
                    <label for="accountlistmodal" class="custom-label text-danger">
                        <span>Account Name *</span>
                    </label>
                </div>
                    <input type="text" class="form-control form-control-sm" id="accountlistmodal" name="accountlistmodal" placeholder="Account Name" required>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal-footer mfsub">
<div class="col">
<button onclick="funaddchartaccountcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left" type="submit"  name="submittype" id="submittype" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button" class="btn btn-primary btn-sm btn-custom-grey" onclick="funeschartaccountcategory()">Cancel</button> </div>
</div>
<!-- </form> -->
</div>
</div>
</div>
<!--------------------------------------------- New Type End --------------------------------------------->
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


<div class="accordion" id="accordionRental">
  <div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingOne">
  <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading" style="font-size: 18px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $infomainaccessuser['modulename'] ?> Details</a>	
 
				</div> 

  </button>
</h5>
<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"  style="">
  <div class="accordion-body text-sm">
<input type="hidden" name="term" id="term" value="RECEIPT">
			  
			  <div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="Account Category" class="custom-label"><span
class="text-danger">Account Category * <svg data-toggle="tooltip" title="The product will be measured in terms of this unit (e.g.: kg, dozen)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-bottom: 3px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
</div>
<div class="col-sm-8" style="height:36px;" id="uck" onclick="andus()">
<select style=" width: 100%;" class="select4 form-control form-control-sm" name="chartaccountcategory" id="chartaccountcategory" required onchange="accountcatch()">
<option selected disabled value="">Account Category</option>
<?php
$selacctypesgroups = mysqli_query($con,"select distinct chartaccounttypegroup from pairchartaccounttypes where (createdid='0' or createdid='$companymainid') and (franchisesession='0' or franchisesession='".$_SESSION['franchisesession']."')");
while($fetacctypesgroup = mysqli_fetch_array($selacctypesgroups)){
?>
<optgroup label="<?=$fetacctypesgroup['chartaccounttypegroup']?>">
<?php
$selacctypes = mysqli_query($con,"select id,chartaccounttypegroup,chartaccounttypelists from pairchartaccounttypes where (createdid='0' or createdid='$companymainid') and (franchisesession='0' or franchisesession='".$_SESSION['franchisesession']."') and chartaccounttypegroup='".$fetacctypesgroup['chartaccounttypegroup']."'");
while($fetacctypes = mysqli_fetch_array($selacctypes)){
?>
<option value="<?=$fetacctypes['id']?>"><?=$fetacctypes['chartaccounttypelists']?></option>
<?php
}
?>
</optgroup>
<?php
}
?>
  </select>
<!-- <script type="text/javascript">
function andun() {
$(".select2-container--open .select2-dropdown--above").hide();
$(".select2-container--open .select2-dropdown--below").hide();
 }
 function andus() {
 $(".select2-container--open .select2-dropdown--above").show();
$(".select2-container--open .select2-dropdown--below").show();
 }
</script> -->
</div>
</div>
</div>
</div>
	

	<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row" style="display: none;">
<div class="col-sm-4">
<label for="chartaccountcategory" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Account Sub Category</label>
</div>
<div class="col-sm-8">
  <input type="text" class="form-control form-control-sm" id="chartaccountsubcategory" name="chartaccountsubcategory" placeholder="Account Sub Category">
			  
</div>
			</div>
		
		
			 <div class="form-group row">
<div class="col-sm-4">
<label for="chartaccountname" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span
class="text-danger">Account Name * <svg data-toggle="tooltip" title="The product will be measured in terms of this unit (e.g.: kg, dozen)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-bottom: 3px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
</div>
<div class="col-sm-8">
  <input type="text" class="form-control form-control-sm" id="chartaccountname" name="chartaccountname" placeholder="Account Name" required>			  
</div>
			</div>

<div class="form-group row subaccountblocks" style="display: none;">
<div class="col-sm-4">
<!-- <label for="chartaccountcode" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Account Code</label> -->
</div>
<div class="col-sm-8">
<div class="custom-control custom-checkbox" style="z-index: 0;">
<input type="checkbox" class="custom-control-input" name="subaccount" id="subaccount" onchange="subaccountch()">
<label class="custom-control-label custom-label" for="subaccount"> Make this a sub-account</label>
</div>    
</div>
</div>

<div class="form-group row parentaccountblock" style="display: none;">
<div class="col-sm-4">
<label for="parentaccount" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Parent Account *</span></label>
</div>
<div class="col-sm-8" style="height:36px;" id="uck" onclick="andus()">
<select style=" width: 100%;" class="select4 form-control form-control-sm" name="parentaccount" id="parentaccount" required>
<option selected disabled value="">Select</option>
</select>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
accountcatch();
});
function accountcatch() {
$("#subaccount").val("0");
document.getElementById("subaccount").checked = false;
$(".parentaccountblock").css("display","none");
$("#parentaccount").val("");
$("#parentaccount").removeAttr("required");
$("#parentaccount").append('<option selected disabled value="">Select</option>');
if ($("#chartaccountcategory").val()!=null) {
$.ajax({
type: "GET",
url: 'parentcheck.php?chartaccountcategory='+$("#chartaccountcategory").val()+'',
success: function (result) {
console.log(result);
if (result!='') {
$("#parentaccount").html(result);
$("#parentaccount").append('<option selected disabled value="">Select</option>');
$(".subaccountblocks").css("display","flex");
}
else{
$(".subaccountblocks").css("display","none");
$("#subaccount").val("0");
document.getElementById("subaccount").checked = false;
$(".parentaccountblock").css("display","none");
$("#parentaccount").val("");
$("#parentaccount").removeAttr("required");
$("#parentaccount").append('<option selected disabled value="">Select</option>');
}
},
error: function (error) {
console.log(error);
}
});
}
if($("#chartaccountcategory").val()==null){
$(".subaccountblocks").css("display","none");
$("#subaccount").val("0");
document.getElementById("subaccount").checked = false;
$(".parentaccountblock").css("display","none");
$("#parentaccount").val("");
$("#parentaccount").removeAttr("required");
$("#parentaccount").append('<option selected disabled value="">Select</option>');
}
}
function subaccountch() {
if (document.getElementById("subaccount").checked==true) {
$(".parentaccountblock").css("display","flex");
$("#parentaccount").attr("required","required");
$.ajax({
type: "GET",
url: 'parentcheck.php?chartaccountcategory='+$("#chartaccountcategory").val()+'',
success: function (result) {
console.log(result);
$("#parentaccount").html(result);
$("#parentaccount").append('<option selected disabled value="">Select</option>');
},
error: function (error) {
console.log(error);
}
});
}
else{
$(".parentaccountblock").css("display","none");
$("#parentaccount").val("");
$("#parentaccount").removeAttr("required");
$("#parentaccount").append('<option selected disabled value="">Select</option>');
}
}
</script>

<div class="form-group row">
<div class="col-sm-4">
<label for="chartaccountcode" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Account Code</label>
</div>
<div class="col-sm-8">
  <input type="text" class="form-control form-control-sm" id="chartaccountcode" name="chartaccountcode" placeholder="Account Code">
			  
</div>
</div>
			
			<div class="form-group row">
<div class="col-sm-4">
<label for="notes" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Description</label>
</div>
<div class="col-sm-8">
  <textarea placeholder="Description" class="form-control form-control-sm" id="notes" name="notes" style="height: 45px !important;"></textarea>
</div>
			</div>
			
<!-- <div class="form-group row">
<div class="col-sm-4"> 
</div> 
<div class="col-sm-8">
<div class="custom-control custom-checkbox" style="z-index: 0;">
<input type="checkbox" class="custom-control-input" name="watchlist" id="watchlist">
<label class="custom-control-label custom-label" for="watchlist"> Add to the watchlist on my dashboard</label>
</div>	  
</div>
</div> -->
			
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
<?php
}
?>

			 
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
$("#chartaccountcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewDefaultCategoryName') {
$('#AddNewDefaultCategoryName').modal('show');
}
});
</script>
<script>
function funaddchartaccountcategory() {
var accountgroupmodal = document.getElementById('accountgroupmodal');
var accountlistmodal = document.getElementById('accountlistmodal');
if (accountgroupmodal.value == '') {
alert('Please Enter Account Group');
accountgroupmodal.focus();
return false;
}
else if (accountlistmodal.value == '') {
alert('Please Enter Account Name');
accountlistmodal.focus();
return false;
}
else {
$.ajax({type: "POST",
url: "chartaccountcategoryadds.php",
data: {
chartaccounttypegroup: $("#accountgroupmodal").val(),
chartaccounttypelists: $("#accountlistmodal").val(),
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
var chartaccounttypegroupcheck = $('#chartaccountcategory optgroup[label="' + accountgroupmodal.value + '"]');
if (chartaccounttypegroupcheck.length === 0) {
	chartaccounttypegroupcheck = $('<optgroup label="' + accountgroupmodal.value + '"></optgroup>');
	$('#chartaccountcategory').append(chartaccounttypegroupcheck);
}
chartaccounttypegroupcheck.append('<option value="' + resarray[1] + '">' + accountlistmodal.value + '</option>');
$('#chartaccountcategory').val(resarray[1]).change();
$("#chartaccountcategory").select4();
$('#AddNewDefaultCategoryName').modal('hide');
return false;
}
}});
}
}

function funeschartaccountcategory() {
$('#chartaccountcategory').val('').change();
$('#AddNewDefaultCategoryName').modal('hide');
return false;
}
// 	$("#chartaccountcategory").on("select2:open", function() { 
// $("#configureunits").attr("data-bs-target","#AddNewDefaultCategoryName");
// $("#configureunits").html("Add New Category");
// });
</script>
</body>

</html>