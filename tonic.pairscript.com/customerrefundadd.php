<?php
include('lcheck.php');
$sqlismainaccessusercus=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customers' order by id  asc");
$infomainaccessusercus=mysqli_fetch_array($sqlismainaccessusercus);
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customer Refunds' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccesscreate']==0)))) {
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
if((isset($_GET['no']))&&(isset($_GET['date']))&&(isset($_GET['type']))){
$currentdate=date('Y-m-d');
}
else{
$currentdate='';
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
     ?>
       <div style="max-width: 1650px;">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3">
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
?>
 <p class="mb-3" style="font-size:20px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-file-import"></i> New <?= $infomainaccessuser['modulename'] ?></p>
 <?php
$sqlismainaccessuser=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix, modulename from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
    <div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> is Allowed for this Franchise</div>
    <?php
}
else
{
?>
<form action="customerrefundadds.php" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


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
        
        
        
        
        
        
        
<?php
$customername='';
$customerid='';
$no='';
$date='';
$type='CREDITNOTE';
if((isset($_GET['no']))&&(isset($_GET['date']))&&(isset($_GET['type'])))
{
  $no=mysqli_real_escape_string($con, $_GET['no']);
  $date=mysqli_real_escape_string($con, $_GET['date']);
  $type=mysqli_real_escape_string($con, $_GET['type']);
  $nocolumn=$type.'no';
  $datecolumn=$type.'date';
  $tabname='pair'.$type.'s';
  $sqlise=mysqli_query($con, "select customername, customerid, grandtotal from $tabname where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and $datecolumn='$date' and $nocolumn='$no'");
  if(mysqli_num_rows($sqlise)>0)
  {
    $infose=mysqli_fetch_array($sqlise);
    $customername=$infose['customername'];
    $customerid=$infose['customerid'];
    
  } 
}
if(isset($_GET['type']))
{
  $type=mysqli_real_escape_string($con, $_GET['type']);
}
?>
        
        
        
        
        <input type="hidden" name="term" id="term" value="RECEIPT">
        <input type="hidden" name="no" id="no" value="<?=$no?>">
        <input type="hidden" name="date" id="date" value="<?=$date?>">
        <input type="hidden" name="type" id="type" value="<?=strtolower($type)?>">
        
        
        
  <?php
    $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
            $publicsql=mysqli_query($con,"select count(publicid) from paircreditnotepayments where createdid='$companymainid'");
            $publicans=mysqli_fetch_array($publicsql);
            $sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Customer Refunds' order by id  asc");
                                $infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Public Id', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="publiccode" class="custom-label"><?= $infomainaccessuser['modulename'] ?> Public Id</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="publiccode" name="publiccode" readonly value="<?= $infomodulespublicname['publiccolumn'] . $publicans[0]+1 ?>" style="background-color: #e9ecef;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<?php
            $privatesql=mysqli_query($con,"select count(privateid) from paircreditnotepayments where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
            $privateans=mysqli_fetch_array($privatesql);
            $sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Customer Refunds' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
                                $infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Private Id', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="privatecode" class="custom-label"><?= $infomainaccessuser['modulename'] ?> Private Id</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="privatecode" name="privatecode" readonly value="<?= $infomainaccesspublicname['moduleprefix'] . $privateans[0]+1 ?>" style="background-color: #e9ecef;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
        
  <div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="customername" class="custom-label" style="font-size:13.6px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger"><?=$infomainaccessusercus['modulename']?> Name *</span></label>
            </div>
            <div class="col-sm-8">
               <div class="col-sm-12" onclick="andus()">
<select class="select4 form-control  form-control-sm" name="customername" id="customername" required>
<option value="" data-foo="" data-receivable="" selected disabled>Select</option>
<?php
$sqli = mysqli_query($con, "SELECT id, customername, billcity, mobile, workphone From paircustomers WHERE (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and customername!='' order by customername asc");
while ($info = mysqli_fetch_array($sqli))
{
if((isset($_GET['no']))&&(isset($_GET['date']))&&(isset($_GET['type'])))
{
?>
<option value="<?=$info['id']?>" <?=($info['id']==$customerid)?'selected':''?>><?=$info['customername']?></option>
<?php
}
else{
?>
<option value="<?=$info['id']?>"><?=$info['customername']?></option>
<?php
}
}
?>
</select>
</div>
        <input type="hidden" name="customerid" id="customerid" value="<?=$customerid?>">
        <span id="totalbalance" style="color: white;"></span>
            </div>
          </div>
    </div>
</div>
<!-- <script type="text/javascript">
$("#totalbalance").on('DOMSubtreeModified',function(){
if (document.getElementById("totalbalance").innerHTML.includes("-")) {
document.getElementById("totalbalance").style.color="red";
}
else{
document.getElementById("totalbalance").style.color="green";
}
});
</script> -->
  <div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="customername" class="custom-label text-danger" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Date *</label>
            </div>
            <div class="col-sm-8">
              <input type="date" class="form-control  form-control-sm" id="receiptdate" name="receiptdate" placeholder="Date" required value="<?php echo $currentdate ?>">
        
            </div>
      </div>
      <div class="form-group row" <?=((in_array('Reference Number', $fieldadd))?'':'style="display:none;"')?>>
            <div class="col-sm-4">
            <label for="receiptno" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Reference Number *</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="receiptno" name="receiptno" placeholder="Reference Number">        
            </div>
      </div>
       <div class="form-group row">
            <div class="col-sm-4">
            <label for="paymentmode" class="custom-label text-danger" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Mode of Payment *</label>
            </div>
            <div class="col-sm-8">
               <div class="col-sm-12" style="width: 100% !important;" onclick="andus()">
              <select class="select2-field form-control  form-control-sm" name="paymentmode" id="paymentmode" required>
<?php
$sqli = mysqli_query($con, "select term from pairterms where (createdid='$companymainid' or createdid='0') order by term asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?= $info['term'] ?>" <?=($info['term']=="CASH")?'selected':''?>><?= $info['term'] ?></option>
<?php
}
?>
</select>   
</div>    
            </div>
      </div>
      
      <div class="form-group row">
            <div class="col-sm-4">
            <label for="amount" class="custom-label text-danger" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Amount Received *</label>
            </div>
            <div class="col-sm-8">
              <div class="input-group input-group-sm">
<div class="input-group-prepend">
<span style="border: 1px solid #ced4da;border-radius:0px;background-color: #e9ecef;padding: .290rem .75rem;display: flex;"><?php echo $rescurrency[0]; ?></span>
</div>
<input type="number" step="any" class="form-control  form-control-sm" id="amount" name="amount" placeholder="Amount Received" required style="border-left: 0px solid #ced4da !important;border-radius: 0px !important;margin-left: 0px !important;padding-left: 3px;">
</div>
        
            </div>
      </div>
<?php
     if ((in_array('Notes', $fieldadd))) {
        ?>
      <div class="form-group row">
            <div class="col-sm-4">
            <label for="notes" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Notes</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="notes" name="notes" placeholder="Notes">
        
            </div>
      </div>
<?php
}
?>
      

      
      
    </div>
</div>
<div id="idlist">
                
</div>
<div class="row justify-content-end" id="grandans" style="padding: 0px 11px;margin-top: -10px;">
<?php
if((isset($_GET['no']))&&(isset($_GET['date']))&&(isset($_GET['type']))){
?>
<div class="col-lg-4"><div class="form-group row" style="font-size:13px;background-color:#ededed;"><div class="col-6" style="padding-top: 5px;"> <strong>Total<span class="pull-right">:</span></strong> </div><div class="col-6" style="padding-right:10px;"><div class="input-group input-group-sm"><div class="input-group-prepend"><span style="border: 0px solid #ced4da;border-radius:0px;background-color: #e9ecef;padding: .290rem .75rem;display: flex;padding-top: 6px"><?php echo $rescurrency[0]; ?></span></div><input type="number" step="any" class="form-control  form-control-sm" id="grandtotal" name="grandtotal" placeholder="0.00" required style="border: 0px solid #ced4da !important;border-radius: 0px !important;margin-left: 0px !important;padding-left: 3px;background: none;text-align:right;padding-right:0px;font-size:13px;font-weight:600;" readonly value="0.00"></div></div></div></div>
<script type="text/javascript">
setTimeout(function() {
$("#grandtotal").val($("#amounts0").val());
},1500);
</script>
<?php
}
?>
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
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="customerrefunds.php" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Cancel</a>
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
            <script type="text/javascript">
                $(document).ready(function() {
$('#amount').change(function(){
    var amount = $("#amount").val();
    $("#amount").val((amount.toFixed(2)));
});
});
            </script>
 <!--term start-->
<div class="modal fade" id="AddNewTerm" tabindex="-1" role="dialog" style="z-index: 1051;">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New <?= $infomainaccessuser['modulename'] ?> Term</h5>
<span type="button" onclick="funespaymentmode()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="closeicon">&times;</span>
</span>
</div>
<div class="modal-body">
<!-- <form method="post" action=""> -->
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingpaymentmode" class="custom-label"><span class="text-danger">
<?= $infomainaccessuser['modulename'] ?> Term *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="paymentmode" class="form-control form-control-sm mb-4" id="missingpaymentmode" placeholder="Name" required>
</div>
</div>
</div>
</div>
<!-- </form> -->
</div>
<div class="modal-footer " style="margin-top: 10px !important;">
<div class="col">
<button   onclick="funaddpaymentmode()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitpaymentmode" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funespaymentmode()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<script>
$("#paymentmode").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewTerm') {
$('#AddNewTerm').modal('show');
}
});
function funaddpaymentmode() {
var missingpaymentmode = document.getElementById('missingpaymentmode');
if (missingpaymentmode.value == '') {
alert('Please Enter New Term Name');
missingpaymentmode.focus();
return false;
} else {

$.ajax({type: "POST",
url: "termadds.php",
data: {
term: $("#missingpaymentmode").val(),
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
$('#paymentmode').append('<option value="' + missingpaymentmode.value + '">' + missingpaymentmode.value +
'</option>');
$('#paymentmode').val(missingpaymentmode.value).change();
$("#paymentmode").select2();
$('#AddNewTerm').modal('hide');
return false;
}
}});
}
}
function funespaymentmode() {
//$('#paymentmode').val('').change();
$("#paymentmode").select2();
$('#AddNewTerm').modal('hide');
return false;
}
$("#paymentmode").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewTerm");
});
$("#paymentmode").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Term";
});
$("#submittableview").on("click",function() {
setTimeout(function() {
$("#submittableview").attr("disabled","disabled");
},100);
});
</script>
 
<!-- <script type="text/javascript">
  $(function() {
   $( "#customername" ).autocomplete({
   source: 'customersearch.php', select: function (event, ui) { $("#customerid").val(ui.item.id); $( "#receiptdate" ).focus(); getdata();}, minLength: 1
 });
 $( "#email" ).autocomplete({
   source: 'franchisesearch.php?type=email',
 });
  });
</script> -->
<script>
$(document).ready(function() {
var customerid = $("#customername").val();
$("#customerid").val(customerid);
getdata();
$('#customername').change(function(){
    var customerid = $("#customername").val();
    $("#customerid").val(customerid);
    getdata();
});
});
</script>
<script>
function getdata()
{
    $('#loadingmodal').modal('show');
    setTimeout(function(){
      var customerid = $("#customerid").val(); /* GET THE VALUE OF THE SELECTED DATA */
      var dataString = "customerid="+customerid+"&type=<?=strtolower($type)?>&no=<?=$no?>&date=<?=$date?>"; /* STORE THAT TO A DATA STRING */
  $.ajax({ /* THEN THE AJAX CALL */
        type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "customerrefundgetdata.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data: dataString, /* THE DATA WE WILL BE PASSING */
        success: function(result){ /* GET THE TO BE RETURNED DATA */
          $("#idlist").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
          $("#grandans").html('<div class="col-lg-4"><div class="form-group row" style="font-size:13px;background-color:#ededed;"><div class="col-6" style="padding-top: 5px;"> <strong>Total<span class="pull-right">:</span></strong> </div><div class="col-6" style="padding-right:10px;"><div class="input-group input-group-sm"><div class="input-group-prepend"><span style="border: 0px solid #ced4da;border-radius:0px;background-color: #e9ecef;padding: .290rem .75rem;display: flex;padding-top: 6px"><?php echo $rescurrency[0]; ?></span></div><input type="number" step="any" class="form-control  form-control-sm" id="grandtotal" name="grandtotal" placeholder="0.00" required style="border: 0px solid #ced4da !important;border-radius: 0px !important;margin-left: 0px !important;padding-left: 3px;background: none;text-align:right;padding-right:0px;font-size:13px;font-weight:600;" readonly value="0.00"></div></div></div></div>');
            if (document.getElementById("totalbalance").innerHTML.includes("-")) {
            document.getElementById("totalbalance").style.color="red";
            }
            else{
            document.getElementById("totalbalance").style.color="green";
            }
            $('#loadingmodal').modal('hide');
        }
      });
    },1500)
}
<?php
if($customerid!='')
{
  ?>
  getdata();
  <?php
}
?>
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
function changeval(id)
{
  var amount=document.getElementById("amount");
  var no=document.getElementsByName("nos[]");
    var date=document.getElementsByName("dates[]");
    var paymentsid=document.getElementById("payments"+id);
    var amounts=document.getElementsByName("amounts[]");
    var status=document.getElementsByName("status[]");
  if(amount.value!="")
  {
    var mainamount=parseFloat(amount.value);
    var comamount=0;
    
    var assamount=0;
    for(var i=0; i<amounts.length;i++)
    {
      assamount+=parseFloat(amounts[i].value);
    }
    for(var i=0; i<no.length;i++)
    {
      if(paymentsid.checked==true)
      {
        comamount+=parseFloat(paymentsid.value);
      }
    }
      if(paymentsid.checked==true)
      {
        if(assamount==mainamount)
        {
          paymentsid.checked=false;
          status[id].value='0';
        }
        else
        {
          comamount+=parseFloat(paymentsid.value);
          if(comamount>mainamount)
          {
            var news=comamount-(comamount-mainamount)-assamount;
            if(news>parseFloat(paymentsid.value)) 
            {
            amounts[id].value=paymentsid.value+".00";
            status[id].value='2';
            }
            else
            {
            amounts[id].value=news+".00";
            status[id].value='2';
            }
          }
          else
          {
            amounts[id].value=paymentsid.value+".00";
            status[id].value='1'; 
          }
        }
    var thistd = $("#payments"+id+"").parent();
    thistd.parent().css({"background-color": "rgb(213 213 213)"});
      }
      else
      {
        amounts[id].value='0.00';
        status[id].value='0';
    var thistd = $("#payments"+id+"").parent();
    thistd.parent().css({"background-color": "#fff"});
      }
    
  }
  else
  {
    paymentsid.checked=false;
    alert("Please enter amount");
    amount.focus();
    return false;
  }
  console.log(comamount);
    var amounts=document.getElementsByName("amounts[]");
    if(amounts)
    {
    var assamount=0;
    for(var i=0; i<amounts.length;i++)
    {
    assamount+=parseFloat(amounts[i].value);
    }
    $("#grandtotal").val(assamount.toFixed(2));
    }
}
function changeinpval(id) {
    var amount=document.getElementById("amount");
    var no=document.getElementsByName("nos[]");
    var date=document.getElementsByName("dates[]");
    var paymentsid=document.getElementById("payments"+id);
    var amounts=document.getElementsByName("amounts[]");
    var amountsid=document.getElementById("amounts"+id);
    var status=document.getElementsByName("status[]");
    if(amount.value!="")
    {
        if (amountsid.value==''||amountsid.value=='0'||amountsid.value=='0.00') {
            paymentsid.checked=false;
    var thistd = $("#payments"+id+"").parent();
    thistd.parent().css({"background-color": "#fff"});
        }
        else{
            paymentsid.checked=true;
    var thistd = $("#payments"+id+"").parent();
    thistd.parent().css({"background-color": "rgb(213 213 213)"});
        }
    }
    else
    {
        paymentsid.checked=false;
        alert("Please enter amount");
        amount.focus();
        amountsid.value='0.00';
        return false;
    }
    var amounts=document.getElementsByName("amounts[]");
    if(amounts)
    {
    var assamount=0;
    for(var i=0; i<amounts.length;i++)
    {
    assamount+=parseFloat(amounts[i].value);
    }
    $("#grandtotal").val(assamount.toFixed(2));
    }
}
</script>
<script>
function checkvalidate()
{
  var amount=document.getElementById("amount");
  var amounts=document.getElementsByName("amounts[]");
  if(amounts)
  {
  var assamount=0;
  for(var i=0; i<amounts.length;i++)
  {
    assamount+=parseFloat(amounts[i].value);
  }
  if(assamount!=parseFloat(amount.value))
  {
    alert("Amounts Mismatched");
    amount.focus();
    return false;
  }
  }
  else
  {
    alert("No Credit Note Found");
    return false;
  }
}
</script>
</body>

</html>