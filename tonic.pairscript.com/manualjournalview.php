<?php
include('lcheck.php');
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Manual Journals' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
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
View <?= $infomainaccessuser['modulename'] ?>
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
 <?php
 if((isset($_GET['ledgerno']))&&(isset($_GET['ledgerdate'])))
 {
	 $ledgerno=mysqli_real_escape_string($con, $_GET['ledgerno']);
	 $ledgerdate=mysqli_real_escape_string($con, $_GET['ledgerdate']);
 $sql=mysqli_query($con, "select * from pairledgers where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ledgerno='$ledgerno' and ledgerdate='$ledgerdate' order by id asc");
$count=1;
if(mysqli_num_rows($sql)>0)
{
$rows = array();
while($row = mysqli_fetch_assoc($sql)){ 
$rows[] = $row;
}
$sqliet=mysqli_query($con, "select franchisename, street, city, state, pincode, country, mobile, email, gstno, website from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$info=mysqli_fetch_array($sqliet);
$businesstype=0;
?> 
   <div style="max-width: 1650px;">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<p class="mb-3" style="font-size: 20px;"><i class="fa fa-pencil-square-o"></i> View <?= $infomainaccessuser['modulename'] ?></p>
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



<div class="container mt-1 mb-3">
    <div class="text-center">
        <a data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="converHTMLFileToPDF()" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-print" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Print</span></p></a>
        
        
     

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
      <div class="modal-footer">
          <a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>
          
      </div>
    </div>
  </div>
</div>
      
      
        
        </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card" id="printarea" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding:10px; overflow-x:auto">
               
               
<table width="664"  height="1020" style="border:1px solid #cccccc">
<tr>
<td height="50">
<table width="100%">
<tr>
<td width="25%" style="padding:20px;"><img src="assets/img/invoicelogo.png" width="100%" ></td>
<td width="25%" style="vertical-align:middle"><strong style="font-size:18px;"><?=$info['franchisename']?></strong><br>
<?=$info['street']?> <?=$info['city']?> <?=$info['state']?> <?=$info['pincode']?><br>
 <?=$info['country']?><br>
GSTIN: <?=$info['gstno']?>
</td>
<td width="25%"></td>
<td width="25%" style="font-size:30px; vertical-align:bottom; padding-bottom:10px;">JOURNAL</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="50">
<table width="100%" border="1" style="border:1px solid #cccccc">
<tr>
<td width="50%" style="border:1px solid #cccccc">
<table border="0" width="100%">
<tr>
<td width="50%">#</td>
<td width="50%">: <b><?=$rows[0]['ledgerno']?></b></td>
</tr>
<tr>
<td width="50%">Date</td>
<td width="50%">: <b><?=date('d/m/Y',strtotime($rows[0]['ledgerdate']))?></b></td>
</tr>
<tr>
<td width="50%">Reference No</td>
<td width="50%">: <?=$rows[0]['referenceno']?></td>
</tr>
<tr>
<td width="50%">Reference Date</td>
<td width="50%">: <?=date('d/m/Y',strtotime($rows[0]['referencedate']))?></td>
</tr>
</table>
</td>
<td width="50%" style="border:1px solid #cccccc">
<table border="0" width="100%">
<tr>
<td width="50%">Notes</td>
<td width="50%">: <b><?=$rows[0]['notes']?></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="50">
<table id="minis" border="0" width="100%" style="border:1px solid #cccccc">
<tr>
<th style="border:1px solid #cccccc; background-color:#eeeeee; text-align:center">#</th>
<th style="border:1px solid #cccccc; background-color:#eeeeee">ACCOUNT</th>
<th style="border:1px solid #cccccc; background-color:#eeeeee">DESCRIPTION</th>
<th style="border:1px solid #cccccc; background-color:#eeeeee">CONTACT</th>
<th style="border:1px solid #cccccc; background-color:#eeeeee; text-align:right">DEBITS</th>
<th style="border:1px solid #cccccc; background-color:#eeeeee; text-align:right">CREDITS</th>
</tr>
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
?>
<tr style=" border-bottom:none;">
<td style="border:1px solid #cccccc; text-align:center"><?=$countt?></td>
<td style="border:1px solid #cccccc; text-align:left"><?=$row['chartaccountname']?></td>
<td style="border:1px solid #cccccc; text-align:left"><?=$row['description']?></td>
<td style="border:1px solid #cccccc; text-align:left"><?=$row['customername']?></td>
<td style="border:1px solid #cccccc; text-align:right"><?=number_format((float)$row['ledgerdebit'],2,'.','')?></td> 
<td style="border:1px solid #cccccc; text-align:right"><?=number_format((float)$row['ledgercredit'],2,'.','')?></td> 

</tr>
<?php
}
?>
<tr>
	<td colspan="4">Sub Total Rs.</td>
	<td style="text-align:right"><?=number_format((float)$rows[0]['subledgerdebit'],2,'.','')?></td>
	<td style="text-align:right"><?=number_format((float)$rows[0]['subledgercredit'],2,'.','')?></td>
</tr>
<tr style="font-size:18px;">
	<td colspan="4">Total Rs.</td>
	<td style="text-align:right"><?=number_format((float)$rows[0]['totalledgerdebit'],2,'.','')?></td>
	<td style="text-align:right"><?=number_format((float)$rows[0]['totalledgercredit'],2,'.','')?></td>
</tr>

</table>
</td>
</tr>

<tr>
<td height="50">
<table width="100%">
<tr>
<td width="60%">
Terms & Conditions<br>
Designing charge Extra
</td>
<td style="border:1px solid #cccccc; height:100px; text-align:center; vertical-align:bottom">
Authorized Signature
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

<script>

function converHTMLFileToPDF() {
	const { jsPDF } = window.jspdf;
	var doc = new jsPDF('p', 'mm', [1070, 700]);

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