<?php
include('lcheck.php');
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Expences' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['groupaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['groupaccess']=='0')||($infomainaccessuser['useraccesscreate']==0)))) {
header('Location:dashboard.php');
}
if($permissionfranchise=='0'||$permissionfranchise=='1')
{
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
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
New <?= $infomainaccessuser['groupname'] ?>
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Expences' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
 ?>
   <div style="max-width: 1650px;">
  <div class="row min-height-480">
<div class="col-12">
  <div class="card mb-4 mt-5">
 <div class="card-body p-3">

 <p class="mb-3" style="font-size:20px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-file-import"></i> New <?= $infomainaccessuser['groupname'] ?></p>
<form action="expenseadds.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


<div class="accordion" id="accordionRental">
  <div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingOne">
  <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading" style="font-size: 18px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $infomainaccessuser['groupname'] ?> Details</a>	
 
				</div> 

  </button>
</h5>
<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"  style="">
  <div class="accordion-body text-sm">
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  <input type="hidden" name="term" id="term" value="RECEIPT">
			  
			  
			  <div class="modal fade" id="AddNewDefaultCategoryName" tabindex="-1" role="dialog">

<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Configure Category Names</h5>
<span type="button" onclick="funesheadername()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true">&times;</span>
</span>
</div>
<div class="modal-body">
<div class="row justify-content-center">


<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="form-group row">
<label for="Category Name" class="custom-label"><span
   class="">Category Name</span></label>

</div>
<input type="text" class="form-control  form-control-sm"
id="missingheadername" name="missingheadername"
placeholder="Category Name">

</div>

</div>
</div>

</div>
</div>
<div class="modal-footer " style="display: block;">

<div class="col">
  <button   onclick="funaddheadername()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="button"  name="submitunit" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funesheadername()">Cancel</button> </div>
</div>







</div>
</div>

</div>
			  
			  <div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="Category Name" class="custom-label"><span
class="text-danger">Category Name * <svg data-toggle="tooltip" title="The product will be measured in terms of this unit (e.g.: kg, dozen)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-bottom: 3px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span></label>
</div>
<div class="col-sm-8" style="height:36px;" id="uck" onclick="andus()">
<select style=" width: 100%;" class="select2-field form-control  form-control-sm" name="headername" id="headername" required>
<option selected disabled value="">Category Name</option>
<?php
$sqlis = mysqli_query($con, "select distinct headername from pairexpenses order by headername asc");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
<option value="<?= $infos['headername'] ?>"><?= $infos['headername'] ?></option>
<?php
}
?>
  </select>
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
</div>
</div>
</div>
</div>
	

	<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="headername" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Date</label>
</div>
<div class="col-sm-8">
  <input type="date" class="form-control  form-control-sm" id="receiptdate" name="receiptdate" placeholder="Date" required>
			  
</div>
			</div>
		
		  <div class="form-group row">
<div class="col-sm-4">
<label for="receiptno" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">(Manual) Number</label>
</div>
<div class="col-sm-8">
  <input type="number" min="0" step="0.01" class="form-control  form-control-sm" id="receiptno" name="receiptno" maxlength="10" placeholder="(Manual) Number" required>			  
</div>
			</div>
			 <div class="form-group row">
<div class="col-sm-4">
<label for="paymentmode" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Mode of Payment</label>
</div>
<div class="col-sm-8">
  <input type="text" class="form-control  form-control-sm" id="paymentmode" name="paymentmode" placeholder="Mode of Payment">			  
</div>
			</div>
			
			<div class="form-group row">
<div class="col-sm-4">
<label for="amount" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Amount</label>
</div>
<div class="col-sm-8">
  <input type="number" class="form-control  form-control-sm" id="amount" name="amount" placeholder="Amount" required>
			  
</div>
			</div>
			<div class="form-group row">
<div class="col-sm-4">
<label for="notes" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Notes</label>
</div>
<div class="col-sm-8">
  <input type="text" class="form-control  form-control-sm" id="notes" name="notes" placeholder="Notes">
			  
</div>
			</div>
			
			<div id="idlist" align="center" style="text-align:center">
				
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
$("#headername").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewDefaultCategoryName') {
$('#AddNewDefaultCategoryName').modal('show');
}
});
</script>
<script>
function funaddheadername() {
var missingheadername = document.getElementById('missingheadername');
if (missingheadername.value == '') {
alert('Please Enter New Default Category Name Name');
missingheadername.focus();
return false;
} else {
$('#headername').append('<option value="' + missingheadername.value + '">' + missingheadername.value +
'</option>');

$('select[name^="headername"] option[value="'+ missingheadername +'"]').attr("selected","selected");
$('#headername').val(missingheadername.value).change();
$('#AddNewDefaultCategoryName').modal('hide');
return false;
}
}

function funesheadername() {
$('#headername').val('').change();
$('#AddNewDefaultCategoryName').modal('hide');
return false;
}
	$("#headername").on("select2:open", function() { 
$("#configureunits").attr("data-bs-target","#AddNewDefaultCategoryName");
$("#configureunits").html("Add New Category");
});
</script>
</body>

</html>