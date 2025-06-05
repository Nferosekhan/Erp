<?php
include('lcheck.php');
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Manual Journals' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
// This is for Restriction of Pages
$sql = "select * from paircontrols where id='$companymainid'";  
$result = mysqli_query($con, $sql);
$rowes = mysqli_fetch_array($result);
$sql = "select * from paircontrols where username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."'";  
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_array($result);
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
    <?= $infomainaccessuser['modulename'] ?>
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
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> <?= $infomainaccessuser['modulename'] ?></p>
								<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Manual Journals' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
	<div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> Generation is Allowed for this Franchise</div>
	<?php
}
else
{
$sqlismainaccessuserr=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Manual Journals' order by id  asc");
$infomainaccessuserr=mysqli_fetch_array($sqlismainaccessuserr);
if (($infomainaccessuserr['useraccesscreate']==1&&$infomainaccessuserr['createdid']!=0)||($infomainaccessuserr['createdid']==0)) {
?>
								<div class="p-2" align="right" style="margin-top: -60px;">
								<a href="manualjournaladd.php" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $infomainaccessuser['modulename'] ?></span></p></a>
								 					
                                            <br>
											
                                        </div>
                                    <?php
}
   ?>
								
							
                            <div class="table-responsive p-0 min-height-480">
                                <table id="someTable" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                        <tr>
<?php
if ((in_array('Date', $modulecolumns))) {
?>
<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Date</span></td>
<?php
}
?>
<?php
if ((in_array('Number', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Number</span></td>
<?php
}
?>
<?php
if ((in_array('Reference No', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Reference No</span></td>
<?php
}
?>     
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Notes</span></td>

					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Amount</span></td>
<?php
if ((in_array('Edit', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Edit</span></td>
<?php
}
?>
<?php
if ((in_array('Print', $modulecolumns))) {
?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Print</span></td>
<?php
}
?>
												
                                        </tr>
                                    </thead>
                                   <tbody>
				  <?php
				  $totalcancel=array();
				  $totalledgerno=array();
				  $totalledgerdate=array();
				  $sql=mysqli_query($con, "select notes,ledgerdate, ledgerno, referenceno, referencedate, totalledgerdebit, totalledgercredit, id from pairledgers where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and type='ledger' GROUP BY ledgerdate, ledgerno order by ledgerdate desc, ledgerno desc");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
            $id=$info['id'];
					  $totalledgerno[]=$info['ledgerno'];
					  $totalledgerdate[]=$info['ledgerdate'];
					 
					  ?>
                      <tr>
<?php
if ((in_array('Date', $modulecolumns))) {
?>
                      <td onclick="window.open('manualjournalview.php?ledgerno=<?=$info['ledgerno']?>&ledgerdate=<?=$info['ledgerdate']?>', '_self')" data-label="Date"><?=(($info['ledgerdate']!='')?(date('d/m/Y',strtotime($info['ledgerdate']))):'')?></td>
<?php
}
?>
<?php
if ((in_array('Number', $modulecolumns))) {
?>
                      <td onclick="window.open('manualjournalview.php?ledgerno=<?=$info['ledgerno']?>&ledgerdate=<?=$info['ledgerdate']?>', '_self')" data-label="Number"><?=$info['ledgerno']?></td>
<?php
}
?>
<?php
if ((in_array('Reference No', $modulecolumns))) {
?>
                      <td onclick="window.open('manualjournalview.php?ledgerno=<?=$info['ledgerno']?>&ledgerdate=<?=$info['ledgerdate']?>', '_self')" data-label="Reference No"><?=$info['referenceno']?></td>
<?php
}
?>  
                      <td onclick="window.open('manualjournalview.php?ledgerno=<?=$info['ledgerno']?>&ledgerdate=<?=$info['ledgerdate']?>', '_self')" data-label="Notes"><?=$info['notes']?></td>

					  <td onclick="window.open('manualjournalview.php?ledgerno=<?=$info['ledgerno']?>&ledgerdate=<?=$info['ledgerdate']?>', '_self')" data-label="Amount"><i class="fa fa-rupee"></i> <?=$info['totalledgercredit']?></td>
<?php
if ((in_array('Edit', $modulecolumns))) {
?>
						<td data-label="Edit" class="">&nbsp;
                        <a href="manualjournaledit.php?ledgerno=<?=$info['ledgerno']?>&ledgerdate=<?=$info['ledgerdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit <?= $infomainaccessuser['modulename'] ?>">
                          Edit
                        </a>
                      </td>
<?php
}
?>
<?php
if ((in_array('Print', $modulecolumns))) {
?>
					  <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="manualjournalprint.php?ledgerno=<?=$info['ledgerno']?>&ledgerdate=<?=$info['ledgerdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit <?= $infomainaccessuser['modulename'] ?>">
                          Print
                        </a>
                      </td>
<?php
}
?>
					</tr>

					<?php
				  $count++;
				  }
				  ?>
					  
                  </tbody>
                                </table>


                            </div>


<?php 
}
?>









                        </div>
                    </div>
                </div>

            </div>
        </div>
	 
	 
	 
	 
	 
	 
	 
	 
<div class="modal fade" id="deleteconfirm-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
		<form action="ledgercancel.php" method="post">
		<input type="hidden" name="cancelstatus" id="cancelstatus">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                <h6 class="text-blue text-center">Advance Payment Details</h6>
				<table class="table">
				<tr>
				<th><?= $infomainaccessuser['modulename'] ?> No</th><td><input type="text" name="ledgerno" id="ledgerno" class
				="form-control form-control-sm" readonly required></td>
				</tr>
				<tr>
				<th><?= $infomainaccessuser['modulename'] ?> Date</th><td><input type="text" name="ledgerdate" id="ledgerdate" class
				="form-control form-control-sm" readonly required></td>
				</tr>
				<tr>
				<th>Total Amount</th><td><input type="text" name="ledgeramount" id="ledgeramount" class
				="form-control form-control-sm" readonly required></td>
				</tr>
				<tr>
				<th>Paid Amount</th><td><input type="number" name="paidamount" id="paidamount" class
				="form-control form-control-sm" value="0" required></td>
				</tr>
				<tr>
				<th>Payment Term</th><td> <select required class="form-control  form-control-sm" name="paymentterm" id="paymentterm" >
<option value="" disabled>Select</option>
<option value="CASH" selected>CASH</option>
<option value="BANK ACCOUNT">BANK ACCOUNT</option>
<option value="UPI">UPI</option>
</select></td>
				</tr>
				</table>
				Are you sure you want to Generate this <?= $infomainaccessuser['modulename'] ?> as Invoice?
				
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" style="padding: 0.5rem 1rem; border-radius:0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <button type="submit" id="deleteitem" href="" style="padding: 0.5rem 1rem; border-radius:0px;" class="btn btn-success success" >Yes</button>
        </div>
		</form>
    </div>
</div>
</div> 


<div class="modal fade" id="deleteconfirm1-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to Generate this <?= $infomainaccessuser['modulename'] ?> as Estimate?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" style="padding: 0.5rem 1rem; border-radius:0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem1" href="" class="btn btn-success success" style="padding: 0.5rem 1rem; border-radius:0px;" >Yes</a>
        </div>
    </div>
</div>
</div> 


<div class="modal fade" id="deleteconfirm2-adddelete" tabindex="-2" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to Generate this <?= $infomainaccessuser['modulename'] ?> as Proforma Invoice?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem2" href="" class="btn btn-success success" >Yes</a>
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
 function deleteitem(ledgerno,ledgerdate,ledgeramount,cancelstatus)
{
	$('#ledgerno').val(ledgerno);
	$('#ledgerdate').val(ledgerdate);
	$('#ledgeramount').val(ledgeramount);
	$('#cancelstatus').val(cancelstatus);
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","ledgercancel.php?ledgerno="+ledgerno+"&ledgerdate="+ledgerdate+"&cancelstatus="+cancelstatus);
}
 function deleteitem1(ledgerno,ledgerdate,cancelstatus)
{
	$('#deleteconfirm1-adddelete').modal('show');
	$("#deleteconfirm1-adddelete #deleteitem1").attr("href","estimatecancel.php?ledgerno="+ledgerno+"&ledgerdate="+ledgerdate+"&estimatestatus="+cancelstatus);
}
 function deleteitem2(ledgerno,ledgerdate,cancelstatus)
{
	$('#deleteconfirm2-adddelete').modal('show');
	$("#deleteconfirm2-adddelete #deleteitem2").attr("href","proformacancel1.php?ledgerno="+ledgerno+"&ledgerdate="+ledgerdate+"&proformastatus="+cancelstatus);
}
 </script>
</body>

</html>