<?php
include('lcheck.php');
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
if(isset($_POST['balanceledgerdebit']))
{

$oldledgerno=mysqli_real_escape_string($con, $_POST['oldesledgerno']);
$oldledgerdate=mysqli_real_escape_string($con, $_POST['oldesledgerdate']);

$sql=mysqli_query($con, "delete from pairledgers where ledgerno='$oldledgerno' and ledgerdate='$oldledgerdate' and type='ledger'");

$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Manual Journals' order by id  asc");
$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Manual Journals' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
$publicsql=mysqli_query($con,"select count(publicid) from pairledgers where createdid='$companymainid' and type='ledger'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publicid=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
$privatesql=mysqli_query($con,"select count(privateid) from pairledgers where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and type='ledger'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privateid=$infomainaccesspublicname['moduleprefix'] . $infomainaccesspublicname['modulesuffix']+1;

$ledgerno=mysqli_real_escape_string($con, $_POST['oldesledgerno']);
$ledgerdate=mysqli_real_escape_string($con, $_POST['ledgerdate']);
$publicid=mysqli_real_escape_string($con, $_POST['publicid']);
$privateid=mysqli_real_escape_string($con, $_POST['privateid']);
$referenceno=mysqli_real_escape_string($con, $_POST['referenceno']);
// $referencedate=mysqli_real_escape_string($con, $_POST['referencedate']);
$notes=mysqli_real_escape_string($con, $_POST['notes']);
$cashbasedjournal=mysqli_real_escape_string($con, (isset($_POST['cashbasedjournal'])) ? '1' : '0');
$currencyname=mysqli_real_escape_string($con, $_POST['currencyname']);
$subledgerdebit=mysqli_real_escape_string($con, $_POST['subledgerdebit']);
$subledgercredit=mysqli_real_escape_string($con, $_POST['subledgercredit']);
$totalledgerdebit=mysqli_real_escape_string($con, $_POST['totalledgerdebit']);
$totalledgercredit=mysqli_real_escape_string($con, $_POST['totalledgercredit']);

$balanceledgerdebit=mysqli_real_escape_string($con, $_POST['balanceledgerdebit']);
$balanceledgercredit=mysqli_real_escape_string($con, $_POST['balanceledgercredit']);

$fileattach=mysqli_real_escape_string($con, $_POST['fileattach1']);

$files = array_filter($_FILES['fileattach']['name']); //Use something similar before processing files.
// Count the number of uploaded files in array
$total_count = count($_FILES['fileattach']['name']);
// Loop through every file
for( $i=0 ; $i < $total_count ; $i++ ) {
//The temp file path is obtained
$tmpFilePath = $_FILES['fileattach']['tmp_name'][$i];
//A file path needs to be present
if ($tmpFilePath != ""){
//Setup our new file path
$newFilePath = "ups/fileattach/".time().$_FILES['fileattach']['name'][$i];
//File is uploaded to temp dir
if(move_uploaded_file($tmpFilePath, $newFilePath)) {
if($fileattach!="")
{
$fileattach.=" | ".$newFilePath;
}
else
{
$fileattach.="".$newFilePath;
}
}
}
}

$sql2=mysqli_query($con, "select id from pairledgers where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ledgerno='$ledgerno' and ledgerdate='$ledgerdate' and type='ledger'");
if(mysqli_num_rows($sql2)==0)
{
for($i=0; $i<count($_POST['chartaccountname']); $i++)
{
$chartaccountid=mysqli_real_escape_string($con, $_POST['chartaccountname'][$i]);
$customerid=mysqli_real_escape_string($con, $_POST['customername'][$i]);
$description=mysqli_real_escape_string($con, $_POST['description'][$i]);
$ledgerdebit=mysqli_real_escape_string($con, $_POST['ledgerdebit'][$i]);
$ledgercredit=mysqli_real_escape_string($con, $_POST['ledgercredit'][$i]);

$sqlacc=mysqli_query($con, "select accountname from pairchartaccountings where id='$chartaccountid'");
$sqlcus=mysqli_query($con, "select customername from paircustomers where id='$customerid'");
$fetacc=mysqli_fetch_array($sqlacc);
$fetcus=mysqli_fetch_array($sqlcus);

$chartaccountname=$fetacc['accountname'];
$customername=$fetcus['customername'];

if($chartaccountname!='')
{   
  // , referencedate='$referencedate'
$sql=mysqli_query($con, "insert into pairledgers set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', ledgerdate='$ledgerdate', ledgerno='$ledgerno', referenceno='$referenceno', chartaccountname='$chartaccountname', chartaccountid='$chartaccountid', notes='$notes',cashbasedjournal='$cashbasedjournal',currency='$currencyname', description='$description', customerid='$customerid', customername='$customername', ledgerdebit='$ledgerdebit', ledgercredit='$ledgercredit', subledgerdebit='$subledgerdebit', subledgercredit='$subledgercredit', totalledgerdebit='$totalledgerdebit', totalledgercredit='$totalledgercredit', balanceledgerdebit='$balanceledgerdebit', balanceledgercredit='$balanceledgercredit',publicid='$publicid',privateid='$privateid',fileattach='$fileattach',type='ledger'");
}
$tid=mysqli_insert_id($con);
}
if($sql)
{
header("Location: manualjournals.php?remarks=Journal Updated Successfully");
}
}
else
{
header("Location: manualjournals.php?error=Error Data");
}
}
$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Manual Journals' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)||($infomainaccessuser['useraccessedit']==0)))) {
header('Location:dashboard.php');
}
$seldataedit=mysqli_query($con,"select * from pairledgers where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and ledgerno='".$_GET['ledgerno']."' and ledgerdate='".$_GET['ledgerdate']."' and type='ledger'");
$fetdataedit = array();
while($fetdataeditrow = mysqli_fetch_assoc($seldataedit)){ 
$fetdataedit[] = $fetdataeditrow;
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
Edit <?= $infomainaccessuser['modulename'] ?>
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Manual Journals' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
     ?>
   <div style="max-width: 1650px;">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<p class="mb-3" style="font-size:20px;"><i class="fa fa-file-import"></i> Edit
<?= $infomainaccessuser['modulename'] ?></p>
  
<?php
$sqlismainaccessuser=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix,modulename from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Manual Journals' order by id  asc");
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
<?php
$sqligst=mysqli_query($con, "select gstno from pairgst where companymainid='$companymainid' ");
$infogst=mysqli_fetch_array($sqligst);
?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<?php
    include('navbottom.php');
    ?>
<?php
    $oldarray=array( 'ledgerno','ledgerdate' );
    foreach($oldarray as $oldinfo)
    {
    ?>
    <input type="hidden" name="oldes<?=$oldinfo?>" value="<?=$fetdataedit[0][$oldinfo]?>">
    <?php
    }
    ?>

<hr>



<div class="row">
<div class="col-lg-12">
  
<div class="accordion" id="accordionRental">
  
  <div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingOne">
        
        <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        
        <div class="customcont-header ml-0 mb-1">
        <a class="customcont-heading" style="font-size: 18px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Journal Details</a> 
             
        </div> 
                
              </button>
            </h5>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"  style="">
              <div class="accordion-body text-sm">
        
        

  <div class="row justify-content-center">
    <div class="col-lg-6">
  
  <div class="form-group row">
            <div class="col-sm-4">
         <label for="customername" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Date *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="date" class="form-control  form-control-sm" id="ledgerdate" name="ledgerdate"  required value="<?=$fetdataedit[0]['ledgerdate']?>">
        
            </div>
      </div>
    
      <div class="form-group row">
            <div class="col-sm-4">
            <label for="receiptno" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Number *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="ledgerno" name="ledgerno" required value="<?=$fetdataedit[0]['ledgerno']?>" readonly>   
              <input type="hidden" class="form-control  form-control-sm" id="publicid" name="publicid" required value="<?=$fetdataedit[0]['publicid']?>">   
              <input type="hidden" class="form-control  form-control-sm" id="privateid" name="privateid" required value="<?=$fetdataedit[0]['privateid']?>">   
            </div>
      </div>
  
  
  
    
      <div class="form-group row">
            <div class="col-sm-4">
            <label for="receiptno" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Reference Number</label>
            </div>
            <div class="col-sm-8">
              <input type="number" min="0" step="0.01" class="form-control  form-control-sm" id="referenceno" name="referenceno" maxlength="10" placeholder="Reference Number" value="<?=$fetdataedit[0]['referenceno']?>">       
            </div>
      </div>
      
      <div class="form-group row">
            <div class="col-sm-4">
            <label for="notes" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Notes *</span></label>
            </div>
            <div class="col-sm-8">
              <textarea class="form-control  form-control-sm" id="notes" name="notes" placeholder="Notes" required style="height: 45px;"><?=$fetdataedit[0]['notes']?></textarea>
        
            </div>
      </div>

<div class="form-group row">
<div class="col-sm-4">
<label for="cashbasedjournal" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Journal Type</label>
</div>
<div class="col-sm-8">
<div class="custom-control custom-checkbox" style="z-index: 0;">
<input type="checkbox" class="custom-control-input" name="cashbasedjournal" id="cashbasedjournal" <?=(($fetdataedit[0]['cashbasedjournal']=='1')?'checked':'')?>>
<label class="custom-control-label custom-label" for="cashbasedjournal"> Cash based journal</label>
</div>    
</div>
</div>

<div class="form-group row">
<div class="col-sm-4">
<label for="currencyname" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Currency</label>
</div>
<div class="col-sm-8">
<select style=" width: 100%" class="select4 form-control  form-control-sm" name="currencyname" id="currencyname">
<?php
$sqlis = mysqli_query($con, "select currencyname from paircurrency");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
<option value="<?= $infos['currencyname'] ?>" <?=(($fetdataedit[0]['currency']==$infos['currencyname'])?'selected':'')?>><?= $infos['currencyname'] ?></option>
<?php
}
?>
</select>
</div>
</div>
      
      
      
    </div>
</div>

         
              </div>
            </div>
          </div>
  
</div>
<!------------->
</div>
</div>
<hr style="margin:0 0 0.5rem 0;">
<div class="row">
  
<div class="accordion" id="accordionRental">
  
  <div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingTwo">
        
        <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        
        <div class="customcont-header ml-0 mb-1">
        <a class="customcont-heading" style="font-size: 18px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Item Information</a> 
             
        </div> 
                
              </button>
            </h5>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"  style="">
              <div class="accordion-body text-sm">
<div class="table-responsive">
  <table class="table table-bordered" id="purchasetable">
<thead>
<tr><th style="display:none"></th><th></th><th>ACCOUNT</th><th >DESCRIPTION</th><th>CONTACT</th><th>DEBITS</th><th>CREDITS</th><th></th></tr>
</thead>
<tbody>
<?php
$i=1;
foreach($fetdataedit as $fetdataeditrow)
{
?>
<tr>
<td class="priority" style="display:none"> <?=$i?></td>
<td><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="ACCOUNT"><div class="col-sm-9 col-lg-12 selectmobview" onclick="andus()" style="width:250px;display: inline-block;margin-top: 1.5px !important;"><select style=" width: 100%;" class="select4 form-control form-control-sm oldaccnames" name="chartaccountname[]" id="chartaccountname<?=$i?>" required><option selected disabled value="">Select</option>
<?php
$seloldval = mysqli_query($con,"select optionslist from pairchartaccounttypes where optionslist!=''");
if (mysqli_num_rows($seloldval)>0) {
while($fetoldval = mysqli_fetch_array($seloldval)){
$explodeoptions = explode(';', $fetoldval['optionslist']);
for($inneri=0;$inneri<count($explodeoptions)-1;$inneri++){
$finalvalues = explode(',',$explodeoptions[$inneri]);
if($finalvalues[0]==$fetdataeditrow['chartaccountid']){
echo '<option value="'.$finalvalues[0].'" '.(($finalvalues[0]==$fetdataeditrow['chartaccountid'])?'selected':'').'>'.$finalvalues[1].'</option>';
}
}
}
}
?>
</select></div></td>
<td data-label="DESCRIPTION"><div><input type="text" name="description[]" id="description<?=$i?>" class="form-control form-control-sm bordernoneinput inpbordes productselectwidth" style="display: inline-block;" value="<?=$fetdataeditrow['description']?>"></div></td>
<td data-label="CONTACT"><div class="col-sm-9 col-lg-12 selectmobview" onclick="andus()" style="width:250px;display: inline-block;margin-top: 1.5px !important;"><select class="form-control  form-control-sm customerinlist" name="customername[]" id="customername<?=$i?>" required><option value='' selected disabled>Select</option>
<?php
$sqli = mysqli_query($con, "SELECT id, customername, billcity, mobile, workphone From paircustomers WHERE franchisesession='".$_SESSION["franchisesession"]."' and (createdid='$companymainid' and moduletype='Customers') and id='".$fetdataeditrow['customerid']."' order by customername asc");
while ($info = mysqli_fetch_array($sqli))
{
?>
<option value="<?=$info['id']?>" <?=($fetdataeditrow['customerid']==$info['id'])?'selected':''?>><?=$info['customername']?></option>
<?php
}
?>
</select></div></td>
<td data-label="DEBITS"><div><input type="number" min="0" step="0.01" name="ledgerdebit[]" id="ledgerdebit<?=$i?>" class="form-control form-control-sm bordernoneinput inpbordes productselectwidth" onChange="chartaccountcalc(this.id)" required style="display: inline-block;" value="<?=$fetdataeditrow['ledgerdebit']?>"></div></td>
<td data-label="CREDITS"><div><input type="number" min="0" step="0.01" name="ledgercredit[]" required id="ledgercredit<?=$i?>" class="form-control form-control-sm bordernoneinput inpbordes productselectwidth" onChange="chartaccountcalc(this.id)" style="display: inline-block;" value="<?=$fetdataeditrow['ledgercredit']?>"></div></td>
<td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
<?php
$i++;
}
?>
</tbody>
</table>
</div>

<script type="text/javascript">
setTimeout(function() {
for(i=0;i<document.getElementsByClassName("oldaccnames").length;i++){
var lineNo = document.getElementsByClassName("oldaccnames")[i].id.split('chartaccountname')[1];
var selectingval = document.getElementsByClassName("oldaccnames")[i].value;
geteditaccount(lineNo,selectingval);
}
function geteditaccount(lineNoid,selectingvals) {
$.ajax({
type: "GET",
url: 'inlistaccsearch.php?idname=chartaccountname&lineNo='+lineNoid+'',
success: function (result) {
console.log(result);
if (result!='') {
$("#chartaccountname"+lineNoid+"").html(result);
$('select[id^="chartaccountname'+lineNoid+'"] option[value="'+selectingvals+'"]').attr("selected","selected");
}
else{
$("#chartaccountname"+lineNoid+"").val("");
$("#chartaccountname"+lineNoid+"").append('<option selected disabled value="">Select</option>');
}
},
error: function (error) {
console.log(error);
}
});
}
},1500);
</script>


</div>
<div class="row">
<div class="col-lg-4">
<p align="left" style="margin:0px;padding:0px 0px 0px 13px;">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;padding: 2px 4.5px 1px 4.5px !important; margin-bottom:0.25rem;"><i style="font-size: 14px;color:#0066cc;" class="fa fa-plus-circle"></i> Add another line</a></p>
<div class="row mb-1" style="display:none">
<div class="col-lg-3"> Total Items</div>
<div class="col-lg-3"3>
  <input required type="text" name="totalitems" id="totalitems" class="form-control form-control-sm" style="width:50px;" readonly  value="0" >
</div>
<div class="col-lg-3"> Tax Type </div>
<div class="col-lg-3">
  <select required type="text" name="taxtype" id="taxtype" class="form-control form-control-sm" onChange="gstcalc();">
  <option value="IntraState" selected>IntraState</option>
  <option value="InterState">InterState</option>
  </select>
</div>
  </div>
  <div class="row mb-1" style="display:none">
  <div class="col-md-4">
  <div class="form-group">
<label>Billed By</label>
<input type="text" name="preparedby" id="preparedby" class="form-control form-control-sm">
  </div>
</div>
<div class="col-lg-8">
<div class="table-responsive" id="gsttablediv">
<table class="table table-bordered" id="gsttable" style="font-size:12px;">
<tr>
<th >Taxable<br> Amount</th><th >SGST %</th><th >Amount</th><th >CGST %</th>
<th >Amount</th>
<th >GST</th>
<th >Total Tax<br> Amount</th>
</tr>
<tr>
<td class="text-center"><input type="text" name="tax25" id="tax25" class="form-control form-control-sm" style="width:75px" readonly></td><td class="text-center">2.5%</td><td class="text-center"><input type="text" name="cgst25" id="cgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td class="text-center">2.5%</td>
<td class="text-center"><input type="text" name="sgst25" id="sgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td style="">5%</td> <td style=" "><input type="text" name="gst25" id="gst25"   class="form-control form-control-sm" style="width:50px;" readonly ></td>
</tr>
<tr>
<td class="text-center"><input type="text" name="tax6" id="tax6"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td class="text-center">6%</td><td class="text-center"><input type="text" name="cgst6" id="cgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td class="text-center">6%</td>
<td class="text-center"><input type="text" name="sgst6" id="sgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td style="">12%</td> <td style=""><input type="text" name="gst6" id="gst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
</tr>
<tr>
<td class="text-center"><input type="text" name="tax9" id="tax9"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td class="text-center">9%</td><td class="text-center"><input type="text" name="cgst9" id="cgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td class="text-center">9%</td>
<td class="text-center"><input type="text" name="sgst9" id="sgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td style="">18%</td> <td style="  "><input type="text" name="gst9" id="gst9"   class="form-control form-control-sm" style="width:50px;" readonly ></td>
</tr>
<tr>
<td class="text-center"><input type="text" name="tax14" id="tax14"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td class="text-center">14%</td> <td class="text-center"><input type="text" name="cgst14" id="cgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td class="text-center">14%</td>
<td class="text-center"><input type="text" name="sgst14" id="sgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td>
<td style="">28%</td> <td style="  "><input type="text" name="gst14" id="gst14"   class="form-control form-control-sm" style="width:50px;" readonly ></td>
</tr>
<tr>
<td colspan="6" style="text-align:right; ">Total GST Amount <i class="fa fa-rupee"></i></td> <td style=""><input type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm" style="width:50px;" readonly ></td>
</tr>
</table>
</div>
</div>
  </div>
</div>
<div class="col-lg-8" style="background-color:#fbfafa;">
<div class="p-3">
 <div class="row mb-1">
<div class="col-4" >Sub Total <span class="pull-right">:</span> </div>
<div class="col-4">
    <div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div><input required type="text" name="subledgerdebit" id="subledgerdebit" class="form-control form-control-sm bordernoneinput inpbordes" style="background:none; text-align:right"  readonly  value="<?=$fetdataedit[0]['subledgerdebit']?>" >
</div>
</div>
<div class="col-4">
    <div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div><input required type="text" name="subledgercredit" id="subledgercredit" class="form-control form-control-sm bordernoneinput inpbordes" style="background:none; text-align:right"  readonly  value="<?=$fetdataedit[0]['subledgercredit']?>" >
</div>
</div>
  </div> <div class="row mb-1" style="font-size:18px;">
<div class="col-4" >Total <span class="pull-right">:</span> </div>
<div class="col-4">
    <div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div><input required type="text" name="totalledgerdebit" id="totalledgerdebit" class="form-control form-control-sm bordernoneinput inpbordes" style="background:none;font-size:18px; text-align:right"  readonly  value="<?=$fetdataedit[0]['totalledgerdebit']?>" >
</div>
</div>
<div class="col-4">
    <div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div><input required type="text" name="totalledgercredit" id="totalledgercredit" class="form-control form-control-sm bordernoneinput inpbordes" style="background:none;font-size:18px; text-align:right"  readonly  value="<?=$fetdataedit[0]['totalledgercredit']?>" >
</div>
</div>
  </div>

 <div class="row mb-1 text-danger">
<div class="col-4" >Difference <span class="pull-right">:</span> </div>
<div class="col-4">
    <div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div><input required type="text" name="balanceledgerdebit" id="balanceledgerdebit" class="form-control form-control-sm bordernoneinput inpbordes text-danger" style="background:none; text-align:right"  readonly  value="<?=$fetdataedit[0]['balanceledgerdebit']?>" >
</div>
</div>
<div class="col-4">
    <div class="input-group"><div class="input-group-prepend"><div class="input-group-text" style="color: #495057;padding: 13px 3.75px;height:21px;font-size: 16px !important;background-color: transparent;"><?php echo $rescurrency[0]; ?></div></div><input required type="text" name="balanceledgercredit" id="balanceledgercredit" class="form-control form-control-sm bordernoneinput inpbordes text-danger" style="background:none; text-align:right"  readonly  value="<?=$fetdataedit[0]['balanceledgercredit']?>" >
</div>
</div>
  </div>
  </div>
</div>
  </div>

<div class="row">
<div class="col-lg-8"></div>
<div class="col-lg-4">
<div style="background-color:#fbfafa;">
<label class="custom-label mb-2" for="fileattach">Attach File(s) to <?= $infomainaccessuser['modulename'] ?></label>
<div class="form-group">
<input type="hidden" name="fileattach1" id="fileattach1" value="<?=$fetdataedit[0]['fileattach']?>">
<input type="file" name="fileattach[]" id="fileattach" class="form-control form-control-sm" multiple onchange="previewatt()">
</div>
<span style="font-size:11px;">You can upload a maximum of 5 files, 5MB each</span><br>
<?php
if ($fetdataedit[0]['fileattach']!='') {
    $imgs=explode('|',$fetdataedit[0]['fileattach']);
    $cot = 1;
    foreach($imgs as $img)
    {
    ?>
    <img alt="Attachment" src="<?=str_replace('../ups','ups',$img)?>" id="attach<?=$cot?>" style="height: 30px !important;width: 30px !important;<?=($fetdataedit[0]['fileattach']!='')?'':'opacity: 0;'?>">
<script type="text/javascript">
function previewatt() {
  var preview = document.getElementById('attach<?=$cot?>');
  var file    = document.getElementById('fileattach').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
    // preview.style.display = 'block';
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
  
}
</script>
    <?php
    $cot++;
    }
}
    ?>
</div>
</div>
  
</div>
</div>
</div>
</div>
  
  <!-- <div class="row justify-content-center" id="footer" style="height: 50px;">

<div class="row col-md-12" style="padding-top: 8px;padding-left: 3px;">
    <div class="col">
      <button class="btn btn-primary btn-sm btn-custom-grey arlina-button expand-left" style="margin-right: 9px;background-color: #f8f8f8;border-color: #c6c6c6;color: #212529; display:none"   >
                <span class="label">Save as Draft</span> <span class="spinner"></span>
            </button>  

            <div class="btn-group dropup"> 
            <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-right: 0px;" type="submit" id="submit" name="submit" value="Submit"  >
                <span class="label">Save and Print</span> <span class="spinner"></span>
            </button> 
            <button type="button" class="btn btn-sm btn-custom dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" style="padding-left: 10px;padding-right: 10px;background-color: #D64830;color:#ffffff;margin-right: 9px; display:none">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Link 1</a></li>
      <li><a class="dropdown-item" href="#">Link 2</a></li>
      <li><a class="dropdown-item" href="#">Link 3</a></li>
  </ul>

            </div>

            <a class="btn btn-primary btn-sm btn-custom-grey" style="margin-left: 0px;background-color: #f8f8f8;border-color: #c6c6c6;color: #212529"
            href="manualjournals.php">Cancel</a>

           
    </div>
   
    <div class="col">
   

</div>
</div>

</div> -->
  
  
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
  include('footer.php');
  ?>
</div>
</main>
 <?php
 include('fexternals.php');
 ?>
<script>
let lineNo = <?=$i?>;
$(document).ready(function () {
$(".purchaseadd-row").click(function () {
addnewrow(lineNo);  
lineNo++;   
}); 
}); 
</script>
<script>
function proautocomp(lineNo)
{
$( "#chartaccountname"+lineNo ).autocomplete({
   source: 'chartaccountsearch.php', select: function (event, ui) { $("#chartaccountname"+lineNo).val(ui.item.chartaccountname); $("#chartaccountid"+lineNo).val(ui.item.id);}, minLength: 0
 });
 
 $( "#customername"+lineNo ).autocomplete({
   source: 'custvensearch.php', select: function (event, ui) { $("#customername"+lineNo).val(ui.item.customername); $("#customerid"+lineNo).val(ui.item.id);}, minLength: 0
 });
}
function addnewrow(lineNo)
{
markup = '<tr><td class="priority" style="display:none"> '+lineNo+'</td><td><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td data-label="ACCOUNT"><div class="col-sm-9 col-lg-12 selectmobview" onclick="andus()" style="width:250px;display: inline-block;margin-top: 1.5px !important;"><select style=" width: 100%;" class="select4 form-control form-control-sm" name="chartaccountname[]" id="chartaccountname'+lineNo+'" required><option selected disabled value="">Select</option></select></div></td><td data-label="DESCRIPTION"><div><input type="text" name="description[]" id="description'+lineNo+'" class="form-control form-control-sm bordernoneinput inpbordes productselectwidth" style="display: inline-block;"></div></td><td data-label="CONTACT"><div class="col-sm-9 col-lg-12 selectmobview" onclick="andus()" style="width:250px;display: inline-block;margin-top: 1.5px !important;"><select class="form-control  form-control-sm customerinlist" name="customername[]" id="customername'+lineNo+'" required><option value="" selected disabled>Select</option></select></div></td><td data-label="DEBITS"><div><input type="number" min="0" step="0.01" name="ledgerdebit[]" id="ledgerdebit'+lineNo+'" class="form-control form-control-sm bordernoneinput inpbordes productselectwidth" onChange="chartaccountcalc(this.id)" required value="0" style="display: inline-block;"></div></td><td data-label="CREDITS"><div><input type="number" min="0" step="0.01" name="ledgercredit[]" required id="ledgercredit'+lineNo+'" class="form-control form-control-sm bordernoneinput inpbordes productselectwidth" onChange="chartaccountcalc(this.id)" value="0" style="display: inline-block;"></div></td><td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td></tr>';
tableBody = $("#purchasetable");
tableBody.append(markup);
$('#chartaccountname'+lineNo+'').select4();
$('#customername'+lineNo+'').select4();
$.ajax({
type: "GET",
url: 'inlistaccsearch.php?idname=chartaccountname&lineNo='+lineNo+'',
success: function (result) {
console.log(result);
if (result!='') {
$('#chartaccountname'+lineNo+'').html(result);
$('#chartaccountname'+lineNo+'').append('<option selected disabled value="">Select</option>');
}
else{
$('#chartaccountname'+lineNo+'').val("");
$('#chartaccountname'+lineNo+'').append('<option selected disabled value="">Select</option>');
}
},
error: function (error) {
console.log(error);
}
});
    $('#customername'+lineNo+'').select4({
                width: '100%',
                ajax: {
                    url: "inlistcustsearch.php",
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
proautocomp(lineNo);
renumber_table('#purchasetable');   
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
var btndel = document.getElementsByName('ledgercredit[]');
if ((btndel.length>1)||(btndel[0].value!='')) {
for(i=0;i<btndel.length;i++){
if (btndel[i].value!=0) {
var id = btndel[i].id;
chartaccountcalc(id);
}
}
}
else{
document.getElementById('subledgerdebit').value=0;
document.getElementById('subledgercredit').value=0;
document.getElementById('totalledgerdebit').value=0;
document.getElementById('totalledgercredit').value=0;
document.getElementById('balanceledgerdebit').value=0;
document.getElementById('balanceledgercredit').value=0;
}
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
$( "#chartaccountname1" ).autocomplete({
   source: 'chartaccountsearch.php', select: function (event, ui) { $("#chartaccountname1").val(ui.item.chartaccountname); $("#chartaccountid1").val(ui.item.id);}, minLength: 2
 });
   $( "#customername1" ).autocomplete({
   source: 'custvensearch.php', select: function (event, ui) { $("#customername1").val(ui.item.customername); $("#customerid1").val(ui.item.id);}, minLength: 0
 });
  });
</script>
<script>
function checkvalidate() {
if (document.getElementById('balanceledgercredit').value!=document.getElementById('balanceledgerdebit').value) {
alert("Please select the Accounts, enter the Debits, and the equivalent credits.");
return false;
}
}
function chartaccountcalc(id)
{
var checking = id.split('ledger')[1];
if (checking.includes('debit')) {
var crid = id.split('ledgerdebit')[1];
$('#ledgercredit'+crid).val(0);
var ledgercredit = $('#ledgercredit'+crid).val();
var ledgerdebit = $('#'+id).val();
}
else{
var debid = id.split('ledgercredit')[1];
$('#ledgerdebit'+debid).val(0);
var ledgercredit = $('#ledgerdebit'+debid).val();
var ledgerdebit = $('#'+id).val();
}
if((ledgercredit!='')&&(ledgerdebit!=''))
{
var x = document.getElementById("purchasetable").rows.length;
x--;
var totalcredit=0;
var totaldebit=0;
var ledgercredits = document.getElementsByName('ledgercredit[]');
var ledgerdebits = document.getElementsByName('ledgerdebit[]');
for (var i = 0; i < ledgercredits.length; i++) 
{
var vat = parseFloat(ledgercredits[i].value);
if(!isNaN(vat))
{
totalcredit+=vat;
}
var vat1 = parseFloat(ledgerdebits[i].value);
if(!isNaN(vat1))
{
totaldebit+=vat1;
}
}
document.getElementById('subledgerdebit').value=parseFloat(Math.round(totaldebit * 100) / 100).toFixed(2);
document.getElementById('subledgercredit').value=parseFloat(Math.round(totalcredit * 100) / 100).toFixed(2);
document.getElementById('totalledgerdebit').value=parseFloat(Math.round(totaldebit * 100) / 100).toFixed(2);
document.getElementById('totalledgercredit').value=parseFloat(Math.round(totalcredit * 100) / 100).toFixed(2);

document.getElementById('totalledgercredit').value=parseFloat(Math.round(totalcredit * 100) / 100).toFixed(2);

if(totalcredit>totaldebit)
{
  document.getElementById('balanceledgercredit').value=parseFloat(Math.round((totalcredit-totaldebit) * 100) / 100).toFixed(2);
  document.getElementById('balanceledgerdebit').value="0.00";
}
else if(totalcredit<totaldebit)
{
  document.getElementById('balanceledgerdebit').value=parseFloat(Math.round((totaldebit-totalcredit) * 100) / 100).toFixed(2);
  document.getElementById('balanceledgercredit').value="0.00";
}
else
{
  document.getElementById('balanceledgercredit').value="0.00";
  document.getElementById('balanceledgerdebit').value=parseFloat(Math.round((totaldebit-totalcredit) * 100) / 100).toFixed(2);
}

}
}
function chartaccountcalc1()
{
var grandtotal;
var totalamount=document.getElementById('totalamount').value;
var totalvatamount=document.getElementById('totalvatamount').value;
var freightamount=document.getElementById('freightamount').value;
var discountamount=document.getElementById('discountamount').value;
grandtotal=parseFloat(totalamount)+parseFloat(totalvatamount)+parseFloat(freightamount);
grandtotal=grandtotal-parseFloat(discountamount);
var grandtotal1=Math.round(Number(grandtotal)).toFixed(2);
var roundoff=grandtotal1-grandtotal;
document.getElementById('roundoff').value=parseFloat(Math.round(roundoff * 100) / 100).toFixed(2);
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show');
}
function gstcalc()
{
var totalvat=0;
var totalchartaccountval=0;
var totalchartaccountdiscountval=0;
var cgst25amt=0;
var sgst25amt=0;
var gst25amt=0;
var cgst6amt=0;
var sgst6amt=0;
var gst6amt=0;
var cgst9amt=0;
var sgst9amt=0;
var gst9amt=0;
var cgst14amt=0;
var sgst14amt=0;
var gst14amt=0;
var tax25=0;
var tax6=0;
var tax9=0;
var tax14=0;
var taxtype=document.getElementById('taxtype');
if(taxtype.value!='')
{
var chartaccountnames = document.getElementsByName('chartaccountname[]');
var vats = document.getElementsByName('vat[]');
var chartaccountvalues = document.getElementsByName('chartaccountvalue[]');
for (var i = 0; i < chartaccountnames.length; i++) 
{
var vat = parseFloat(vats[i].value);
if(!isNaN(vat))
{
var chartaccountvalue = parseFloat(chartaccountvalues[i].value);
var chartaccountvat=(chartaccountvalue*(1+(vat/100)));
if(vat==5)
{
cgst25amt+=(chartaccountvalue*(1+(2.5/100)))-chartaccountvalue;
sgst25amt+=(chartaccountvalue*(1+(2.5/100)))-chartaccountvalue;
gst25amt+=(chartaccountvalue*(1+(5/100)))-chartaccountvalue;
tax25+=chartaccountvalue;
}
if(vat==12)
{
cgst6amt+=(chartaccountvalue*(1+(6/100)))-chartaccountvalue;
sgst6amt+=(chartaccountvalue*(1+(6/100)))-chartaccountvalue;
gst6amt+=(chartaccountvalue*(1+(12/100)))-chartaccountvalue;
tax6+=chartaccountvalue;
}
if(vat==18)
{
cgst9amt+=(chartaccountvalue*(1+(9/100)))-chartaccountvalue;
sgst9amt+=(chartaccountvalue*(1+(9/100)))-chartaccountvalue;
gst9amt+=(chartaccountvalue*(1+(18/100)))-chartaccountvalue;
tax9+=chartaccountvalue;
}
if(vat==28)
{
cgst14amt+=(chartaccountvalue*(1+(14/100)))-chartaccountvalue;
sgst14amt+=(chartaccountvalue*(1+(14/100)))-chartaccountvalue;
gst14amt+=(chartaccountvalue*(1+(28/100)))-chartaccountvalue;
tax14+=chartaccountvalue;
}
}
}   
if(taxtype.value=='IntraState')
{
document.getElementById('gsttablediv').innerHTML='<table class="table table-bordered" id="gsttable" style="font-size:12px;"><tr> <th >Taxable Amount</th><th >SGST %</th><th >Taxable Amount</th><th >CGST %</th> <th >Taxable Amount</th> <th >GST</th><th >Taxable Amount</th> </tr> <tr> <td class="text-center"><input type="text" name="tax25" id="tax25" class="form-control form-control-sm" style="width:50px;" readonly ></td><td >2.5%</td><td class="text-center"><input type="text" name="cgst25" id="cgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >2.5%</td> <td class="text-center"><input type="text" name="sgst25" id="sgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">5%</td> <td style=" "><input type="text" name="gst25" id="gst25"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax6" id="tax6"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >6%</td><td class="text-center"><input type="text" name="cgst6" id="cgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >6%</td> <td class="text-center"><input type="text" name="sgst6" id="sgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">12%</td> <td style=""><input type="text" name="gst6" id="gst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax9" id="tax9"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >9%</td><td class="text-center"><input type="text" name="cgst9" id="cgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >9%</td> <td class="text-center"><input type="text" name="sgst9" id="sgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">18%</td> <td style="  "><input type="text" name="gst9" id="gst9"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax14" id="tax14"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >14%</td> <td class="text-center"><input type="text" name="cgst14" id="cgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >14%</td> <td class="text-center"><input type="text" name="sgst14" id="sgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">28%</td> <td style="  "><input type="text" name="gst14" id="gst14"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td colspan="6" style="text-align:right; ">Total GST Amount <i class="fa fa-rupee"></i></td> <td style=""><input type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> </table>';
document.getElementById('cgst25').value=parseFloat(Math.round(cgst25amt * 100) / 100).toFixed(2);
document.getElementById('sgst25').value=parseFloat(Math.round(sgst25amt * 100) / 100).toFixed(2);
document.getElementById('gst25').value=parseFloat(Math.round(gst25amt * 100) / 100).toFixed(2);
document.getElementById('cgst6').value=parseFloat(Math.round(cgst6amt * 100) / 100).toFixed(2);
document.getElementById('sgst6').value=parseFloat(Math.round(sgst6amt * 100) / 100).toFixed(2);
document.getElementById('gst6').value=parseFloat(Math.round(gst6amt * 100) / 100).toFixed(2);
document.getElementById('cgst9').value=parseFloat(Math.round(cgst9amt * 100) / 100).toFixed(2);
document.getElementById('sgst9').value=parseFloat(Math.round(sgst9amt * 100) / 100).toFixed(2);
document.getElementById('gst9').value=parseFloat(Math.round(gst9amt * 100) / 100).toFixed(2);
document.getElementById('cgst14').value=parseFloat(Math.round(cgst14amt * 100) / 100).toFixed(2);
document.getElementById('sgst14').value=parseFloat(Math.round(sgst14amt * 100) / 100).toFixed(2);
document.getElementById('gst14').value=parseFloat(Math.round(gst14amt * 100) / 100).toFixed(2);
document.getElementById('tax25').value=parseFloat(Math.round(tax25 * 100) / 100).toFixed(2);
document.getElementById('tax6').value=parseFloat(Math.round(tax6 * 100) / 100).toFixed(2);
document.getElementById('tax9').value=parseFloat(Math.round(tax9 * 100) / 100).toFixed(2);
document.getElementById('tax14').value=parseFloat(Math.round(tax14 * 100) / 100).toFixed(2);
document.getElementById('totalvatamount1').value=parseFloat(Math.round((gst25amt+gst6amt+gst9amt+gst14amt) * 100) / 100).toFixed(2);
}
else
{
document.getElementById('gsttablediv').innerHTML='<table class="table table-bordered" id="gsttable" style="font-size:12px;"><tr> <th >Taxable Amount</th><th >IGST %</th> <th >Taxable Amount</th> <th style="display:none"  >SGST %</th> <th style="display:none"  >Amount</th> <th >GST</th><th >Taxable Amount</th> </tr> <tr> <td class="text-center"><input type="text" name="tax25" id="tax25" class="form-control form-control-sm" style="width:50px;" readonly ></td><td >5%</td> <td class="text-center"><input type="text" name="cgst25" id="cgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >2.5%</td> <td style="display:none" ><input type="text" name="sgst25" id="sgst25" class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">5%</td> <td style=" "><input type="text" name="gst25" id="gst25"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr>  <td class="text-center"><input type="text" name="tax6" id="tax6"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >12%</td> <td class="text-center"><input type="text" name="cgst6" id="cgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >6%</td> <td style="display:none" ><input type="text" name="sgst6" id="sgst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">12%</td> <td style=""><input type="text" name="gst6" id="gst6"  class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax9" id="tax9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td >18%</td> <td class="text-center"><input type="text" name="cgst9" id="cgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >9%</td> <td style="display:none" ><input type="text" name="sgst9" id="sgst9"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">18%</td> <td style="  "><input type="text" name="gst9" id="gst9"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td class="text-center"><input type="text" name="tax14" id="tax14"  class="form-control form-control-sm" style="width:50px;" readonly ></td><td >28%</td> <td class="text-center"><input type="text" name="cgst14" id="cgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="display:none" >14%</td> <td style="display:none" ><input type="text" name="sgst14" id="sgst14"  class="form-control form-control-sm" style="width:50px;" readonly ></td> <td style="">28%</td> <td style="  "><input type="text" name="gst14" id="gst14"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> <tr> <td colspan="4" style="text-align:right; ">Total GST Amount <i class="fa fa-rupee"></i></td> <td style=""><input type="text" name="totalvatamount1" id="totalvatamount1"   class="form-control form-control-sm" style="width:50px;" readonly ></td> </tr> </table>';
document.getElementById('cgst25').value=parseFloat(Math.round(gst25amt * 100) / 100).toFixed(2);
document.getElementById('sgst25').value='0.00';
document.getElementById('gst25').value=parseFloat(Math.round(gst25amt * 100) / 100).toFixed(2);
document.getElementById('cgst6').value=parseFloat(Math.round(gst6amt * 100) / 100).toFixed(2);
document.getElementById('sgst6').value='0.00';
document.getElementById('gst6').value=parseFloat(Math.round(gst6amt * 100) / 100).toFixed(2);
document.getElementById('cgst9').value=parseFloat(Math.round(gst9amt * 100) / 100).toFixed(2);
document.getElementById('sgst9').value='0.00';
document.getElementById('gst9').value=parseFloat(Math.round(gst9amt * 100) / 100).toFixed(2);
document.getElementById('cgst14').value=parseFloat(Math.round(gst14amt * 100) / 100).toFixed(2);
document.getElementById('sgst14').value='0.00';
document.getElementById('gst14').value=parseFloat(Math.round(gst14amt * 100) / 100).toFixed(2);
document.getElementById('tax25').value=parseFloat(Math.round(tax25 * 100) / 100).toFixed(2);
document.getElementById('tax6').value=parseFloat(Math.round(tax6 * 100) / 100).toFixed(2);
document.getElementById('tax9').value=parseFloat(Math.round(tax9 * 100) / 100).toFixed(2);
document.getElementById('tax14').value=parseFloat(Math.round(tax14 * 100) / 100).toFixed(2);
document.getElementById('totalvatamount1').value=parseFloat(Math.round((gst25amt+gst6amt+gst9amt+gst14amt) * 100) / 100).toFixed(2);
}
}
}
function chartaccountcalcround()
{
var grandtotal;
var totalamount=document.getElementById('totalamount').value;
var totalvatamount=document.getElementById('totalvatamount').value;
var freightamount=document.getElementById('freightamount').value;
var discountamount=document.getElementById('discountamount').value;
var roundofff=document.getElementById('roundoff').value;
grandtotal=parseFloat(totalamount)+parseFloat(totalvatamount)+parseFloat(freightamount);
grandtotal=grandtotal-parseFloat(discountamount);
if(parseFloat(roundofff)!=0)
{
var grandtotal1=Math.round(Number(grandtotal)).toFixed(2);  
var roundoff=grandtotal1-grandtotal;
document.getElementById('roundoff').value=parseFloat(Math.round(roundoff * 100) / 100).toFixed(2);
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2);
$('#grandtotal').tooltip('hide').attr('data-original-title', parseFloat(Math.round(grandtotal1 * 100) / 100).toFixed(2)).tooltip('show');
}
else
{
document.getElementById('grandtotal').value=parseFloat(Math.round(grandtotal * 100) / 100).toFixed(2);
}
}
function discount1()
{
var disper=document.getElementById('discount').value;
var totalamount=document.getElementById('totalamount').value;
if((disper!='')&&(disper!='0'))
{
var discountamount=(parseFloat(disper)/100)*parseFloat(totalamount);
document.getElementById('discountamount').value=parseFloat(Math.round((discountamount) * 100) / 100).toFixed(2);
chartaccountcalc1();
}
}
</script>
</body>
</html>