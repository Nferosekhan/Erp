<?php
include('lcheck.php');
     if(isset($_GET['id']))
{
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, vendorid, vendorname, paymentmode, amount, notes,publicid,privateid,type from pairpurchasereturnpayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='".$_GET['id']."'");
if(mysqli_num_rows($sql)>0)
{
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Payments Made For Purchase Return' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Payments Made For Purchase Return' order by id  asc");
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
$id=mysqli_real_escape_string($con, $_GET['id']);
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, vendorid, vendorname, paymentmode, amount, notes,publicid,privateid from pairpurchasereturnpayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='".$_GET['id']."'");
$info=mysqli_fetch_array($sql);
$sqliet=mysqli_query($con, "select * from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$infofranch=mysqli_fetch_array($sqliet);
?>
<?php
$sqlcus=mysqli_query($con,"select * from paircustomers where id=".$info['vendorid']."");
$sqlcusfetch=mysqli_fetch_array($sqlcus);
$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
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
    <?= $infomainaccessuser['modulename'] ?> Details
  </title>
  

   <link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
   <!-- productview.css -->
   <!-- <link href="productview.css" rel="stylesheet"> -->
   
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
     
       <div id="fullcontainerwidth">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3">
<div class="row">
<div class="col-lg-6">
 <p class="mb-3" id="viewpro"><i class="fa fa-eye"></i> Payment Received for Purchase Return Details</p>
 <?php
$sqlismainaccessuser=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix,modulename from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Payments Made For Purchase Return' order by id  asc");
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
 </div>
<div class="col-lg-6">
 <span id="btnalignright" class="mb-3">
    <a style="margin:4.5px 4.5px !important;" class="btn btn-primary btn-sm btn-custom-grey" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="converHTMLFileToPDF()"><i class="fa fa-print" aria-hidden="true"></i> <span class="mobreswords "> Print</span></a>
<a style="margin:4.5px 4.5px !important;" class="btn btn-primary btn-sm btn-custom-grey" onclick="downloadpdf()"><i class="fa fa-download" aria-hidden="true"></i> <span class="mobreswords "> Download</span></a>
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Payments Made For Purchase Return' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccessedit']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
?>
<a class="btn btn-primary btn-sm btn-custom-grey" href="purchasereturnpaymentedit.php?id=<?=$id?>" id="btngopage"><i class="fa fa-pencil-alt"></i> <span class="mobreswords "> Edit</span></a>
  <?php 
}
?>
  </span>
  </div>

  </div>
  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <object id="pdfObj" data="" type="application/pdf" width="90%" height="550"></object>
      </div>
      <div class="modal-footer" style="margin-top: 33px !important;">
          <a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>
          
      </div>
    </div>
  </div>
</div>

<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


<nav>
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><div class="customcont-header ml-0">
	
		<a class="customcont-heading">Overview</a>	
             
				</div></button>
               <!--  <button class="nav-link" id="nav-transactions-tab" data-bs-toggle="tab" data-bs-target="#nav-transactions" type="button" role="tab" aria-controls="nav-transactions" aria-selected="false"><div class="customcont-header ml-0">
    
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
      <th style="border:1px solid #ddd !important;">DATE</th>
      <th style="border:1px solid #ddd !important;">DETAILS</th>
      </tr>
      </thead>
      <tbody>
        <?php
      $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='PURCHASEPAYMADE' and useid='$id' order by createdon desc");
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
  <!-- <div class="tab-pane fade" id="nav-transactions" role="tabpanel" aria-labelledby="nav-transactions-tab">
    <p class="m-3">Transaction</p>
  </div> -->
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
<!-- <p class="m-3" id="infoheadsall">Payment Received for Purchase Return Details</p>	  -->
<div class="row d-flex justify-content-center mt-5" id="zoomforprint">
        <div class="col-lg-8 col-md-12" style="width:595px !important;">
        
        
    
        
        
            <div class="card"  style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding:10px; width:595px;" align="center">
<?php
if($infofranch['purchasereturnpaymenttemplate']=='1')
{
    ?>
<div class="table-responsive">
<table id="printarea" class="table" width="100%" height="1000" style="border:1px solid #cccccc; width:100%; height:900px;">
<tr>
<td height="50" style="border-bottom: 1px solid #17A2B7">
<table width="100%">
<tr>
<td width="15%" style="padding:10px;"><img src="assets/img/invoicelogo.png" height="100" ></td>
<td width="50%" style="vertical-align:middle; font-size:12px;"><strong style="font-size:16px;"><?=$infofranch['franchisename']?></strong><br>
<strong>GSTIN: <?=$infofranch['gstno']?></strong><br>
<?=$infofranch['street']?> <?=$infofranch['city']?> <?=$infofranch['state']?> <?=$infofranch['pincode']?> <?=$infofranch['country']?><br>
 <strong>Mobile: </strong><?=$infofranch['mobile']?> <strong>Email: </strong><?=$infofranch['email']?><br>
<strong>Website: </strong><?=$infofranch['website']?>
</td>
<td width="35%" style="vertical-align:bottom; text-align:right; padding:10px; font-size:12px;"><strong style="font-size:18px; color:#17A2B7"><?= $infomainaccessuser['modulename'] ?></strong><br>
ORIGINAL FOR RECIPIENT<br>
<?= $infomainaccessuser['modulename'] ?> #: <strong><?=$info['publicid']?></strong><br>
Vendor Name: <strong><?=$info['vendorname']?></strong><br>
Receipt Date: <strong><?=date('d/m/Y',strtotime($info['receiptdate']))?></strong><br>
Receipt Number: <strong><?=date('d/m/Y',strtotime($info['receiptno']))?></strong><br>
Mode of Payment: <strong><?=$info['paymentmode']?></strong><br>
Amount Received: <strong><?=$info['amount']?></strong><br>
Notes: <strong><?=$info['notes']?></strong><br>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td> &nbsp; </td>
</tr>

</table>
</div>
    <?php
}
else
{
    ?>   
<div class="table-responsive">
<table id="printarea" class="table" width="100%" height="900" style="border:1px solid #cccccc; width:100%; height:500px;">
<tr>
<td height="50">
<table width="100%">
<tr>
<td width="25%" style="padding:20px;"><img src="assets/img/invoicelogo.png" width="100%" ></td>
<td width="25%" style="vertical-align:middle"><strong style="font-size:18px;"><?=$infofranch['franchisename']?></strong><br>
<?=$infofranch['street']?> <?=$infofranch['city']?> <br> <?=$infofranch['state']?> <?=$infofranch['pincode']?>
 <?=$infofranch['country']?><br>
GSTIN: <?=$infofranch['gstno']?>
</td>
<td width="15%"></td>
<td width="35%" style=" vertical-align:middle;">
<table width="100%">
   <tr>
       <td style="font-size:25px;white-space: normal !important;"><?= $infomainaccessuser['modulename'] ?></td> 
    </tr>
     <tr>
<td width="50%">Date</td>
<td width="50%">: <?=$info['receiptdate']?></td>
</tr>
<?php
     if ((in_array('Number', $fieldview))) {
        ?>
     <tr>
<td width="50%">Number</td>
<td width="50%">: <?=$info['receiptno']?></td>
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
<tr>
<td height="50">
<table width="100%" border="1" style="border:1px solid #cccccc">
<tr style="font-weight:bold;background-color: #eeeeee;">
<td width="50%" style="border:1px solid #cccccc; background-color:#eeeeee;border-right:0px;">
Billing Address
</td>
<td width="50%" style="border:1px solid #cccccc; background-color:#eeeeee;border-left: 0px;">
</td>
</tr>
<tr>
<td width="50%" style="border:1px solid #cccccc;">
<strong style="font-weight:bold;font-size: 14px !important;"><?=ucwords(strtolower($sqlcusfetch['customername']))?></strong><br> 
<?php
if ((($sqlcusfetch['billstreet']!='')&&($sqlcusfetch['billcity']!='')&&($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billpincode']!='')&&($sqlcusfetch['billcountry']!=''))) {
?>
<span style="font-size: 13px !important;"><?=ucwords(strtolower($sqlcusfetch['billstreet']))?><?=((($sqlcusfetch['billstreet']!='')&&($sqlcusfetch['billcity']!=''))?',':'')?><?=ucwords(strtolower($sqlcusfetch['billcity']))?><br>
<?=$sqlcusfetch['billstate']?><?=((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billpincode']!=''))?',':'')?><?=$sqlcusfetch['billpincode']?><?=((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billcountry']!='')||($sqlcusfetch['billpincode']!='')&&($sqlcusfetch['billcountry']!=''))?',':'')?><?=$sqlcusfetch['billcountry']?><br></span>
<?php
}
?>
<span style="font-size: 12px !important;">WORK PHONE: <?=$sqlcusfetch['workphone']?><br></span>
</td>
<td width="50%" style="border:1px solid #cccccc;border-left: 0px;">

</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="50">
<table width="100%" border="1" style="border:1px solid #cccccc">
<tr style="font-weight:bold;background-color: #eeeeee;">
<td width="70%" style="border:1px solid #cccccc; background-color:#eeeeee;">
Mode of Payment
</td>
<td width="30%" style="border:1px solid #cccccc; background-color:#eeeeee;text-align: right;">
Amount
</td>
</tr>
<tr>
<td width="50%" style="border:1px solid #cccccc;">
<b><?=$info['paymentmode']?></b>
</td>
<td width="50%" style="border:1px solid #cccccc;border-left: 0px;text-align: right;">
<b><?php echo $rescurrency[0]; ?><?=number_format((float)$info['amount'],2,'.','')?></b>
</td>
</tr>
</table>
</td>
</tr>
<tr>
    <td height="50">
    <table width="100%">
        <tr>
<td width="60%" style="vertical-align:top !important;"></td>
<td style="border:1px solid #cccccc; height:100px; text-align:center; vertical-align:bottom">
Authorized Signature
</td>
</tr>
</table>
</td>
</tr>

</table>
</div>

<?php
}
?>
</div>
             <p align="right" class="mt-3" style="margin-right:0px; cursor:pointer" id="templatetext">Template: '<?=($infofranch['purchasereturnpaymenttemplate']=='1')?'Advanced':'Standard'?> Template' <a data-bs-toggle="modal" data-bs-target="#changepurchasereturnpaymentModal" class="text-blue">Change</a></p>
             
        </div>
        <!-- Modal -->
<div class="modal fade" id="changepurchasereturnpaymentModal" tabindex="-1" role="dialog" aria-labelledby="changepurchasereturnpaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changepurchasereturnpaymentModalLabel">Choose Template</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <!-------------->
      
<table width="100%">
<tr>
<td width="50%" style="text-align:center">
 <div class="imgcontainer" id="standardcontainer">
  <img src="standard.png" id="standardimg" alt="Snow" onclick="standandclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered" id="standardtext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">Standard Template</p>
</td>
<td width="50%" style="text-align:center" id="webprintdesign">
 <div class="imgcontainer" id="standardcontainer">
  <img src="advanced.png" id="advancedimg" alt="Snow" onclick="advancedclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered" id="advancedtext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">Advanced Template</p>
</td>
</tr>
<tr id="mobprintdesign" style="display: none;">
<td width="50%" style="text-align:center">
 <div class="imgcontainer" id="standardcontainer">
  <img src="advanced.png" id="advancedimg" alt="Snow" onclick="advancedclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered" id="advancedtext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">Advanced Template</p>
</td>
</tr>
</table>

<script>
function standandclick()
{
    $("#advancedtext").css('display','none');
    $("#standardtext").css('display','block');
    $("#standardimg").css('border','1px solid #1BBC9B');
    $("#advancedimg").css('border','none'); 
    $("#standardimg").css('opacity','0.5');
    $("#advancedimg").css('opacity','1');   
    setTimeout(function() {
var r = confirm('Are you sure want to Change this Template?');
if (r == true) {
    window.location.href='changetemplatereceipt.php?template=purchasereturnpayment&id=<?=$id?>&publicid=<?=$info['publicid']?>&receiptdate=<?=$info['receiptdate']?>&temptype=0&submt=submt';
} else {
   
}
}, 100);
}
</script>

<script>
function advancedclick()
{
    $("#standardtext").css('display','none');
    $("#advancedtext").css('display','block');
    $("#advancedimg").css('border','1px solid #1BBC9B');
    $("#standardimg").css('border','none'); 
    $("#advancedimg").css('opacity','0.5');
    $("#standardimg").css('opacity','1');   
    setTimeout(function() {
var r = confirm('Are you sure want to Change this Template?');
if (r == true) {
    window.location.href='changetemplatereceipt.php?template=purchasereturnpayment&id=<?=$id?>&publicid=<?=$info['publicid']?>&receiptdate=<?=$info['receiptdate']?>&temptype=1&submt=submt';
} else {
   
}
}, 100);
}
<?php
if($infofranch['purchasereturnpaymenttemplate']=='1')
{
    ?>
    $("#standardtext").css('display','none');
    $("#advancedtext").css('display','block');
    $("#advancedimg").css('border','1px solid #1BBC9B');
    $("#standardimg").css('border','none'); 
    $("#advancedimg").css('opacity','0.5');
    $("#standardimg").css('opacity','1');   
    <?php
}
else
{
    ?>
    $("#advancedtext").css('display','none');
    $("#standardtext").css('display','block');
    $("#standardimg").css('border','1px solid #1BBC9B');
    $("#advancedimg").css('border','none'); 
    $("#standardimg").css('opacity','0.5');
    $("#advancedimg").css('opacity','1');   
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
	  <hr>
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>

function converHTMLFileToPDF() {
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF('p', 'mm', [595, 595]);

    var pdfjs = document.querySelector('#printarea');

    doc.html(pdfjs, {
        callback: function(doc) {
            //doc.output('dataurlnewwindow');
            //doc.save("output.pdf");
            document.getElementById("pdfObj").data = doc.output("bloburl");
            //window.open(doc.output("bloburl"), "_blank","toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,modal=yes,top=200,left=350,width=600,height=400");
            
        },
        x: 10,
        y: 10
    });
}

</script>
<script>

function downloadpdf() {
    const { jsPDF } = window.jspdf;
    var doc = new jsPDF('p', 'mm', [595, 700]);

    var pdfjs = document.querySelector('#printarea');

    doc.html(pdfjs, {
        callback: function(doc) {
            //doc.output('dataurlnewwindow');
            doc.save("Payment Received for Purchase Return-<?=$info['publicid']?>-<?=$info['receiptdate']?>.pdf");
            //document.getElementById("pdfObj").data = doc.output("bloburl");
            //window.open(doc.output("bloburl"), "_blank","toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,modal=yes,top=200,left=350,width=600,height=400");
            
        },
        x: 10,
        y: 10
    });
}

</script>

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
 
</body>

</html>
<?php
}
else{
header("Location:purchasereturnpayments.php?error=No Information Found");
}
}
else{
header("Location:purchasereturnpayments.php?error=No Information Found");  
}
?>