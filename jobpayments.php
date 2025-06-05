<?php
include('lcheck.php');
// This is for Restriction of Pages
$sql = "select * from paircontrols where id='$companymainid'";  
$result = mysqli_query($con, $sql);
$rowes = mysqli_fetch_array($result);
$sql = "select * from paircontrols where username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."'";  
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_array($result);
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
if($userrole!='SUPER ADMIN')
{
    if($rowes['permissionsidebooks']==0||$rowes['permissionspayreceive']==0||$rows['bpayreceiveview']==0||$row['franchises']==''){
    header('Location: dashboard.php');
}
}
else{
    if($rowes['permissionsidebooks']==0||$rowes['permissionspayreceive']==0||$row['franchises']==''){
    header('Location: dashboard.php');
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
    <?= $row['payreceivech'] ?> - Dmedia
  </title>
<style>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 724px) 
{
  .add{
    position: relative;
    top: 36px; 
  }
  table {
    border: 0;
    margin-top: 30px;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: 1em;
  }
  
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}

</style>
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
     <script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 4000);
 
});
</script>
	 <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> <?= $row['payreceivech'] ?></p>
                                <?php 
                             if ($rows['bpayreceivecreate']==1) {
                                 ?>
                                <div align="right" class=" p-2" style="margin-top: -60px;">
        
       <a href="salespaymentadd.php?type=job" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $row['payreceivech'] ?></span></p></a>
       
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
													if ($access['payreceivedatelist']!=0) {
                                                ?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Date</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceivenolist']!=0) {
                                                ?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Number</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceivecustomernamelist']!=0) {
                                                ?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Customer Name</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceivetermlist']!=0) {
                                                ?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Term</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceivemodeofpaylist']!=0) {
                                                ?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Mode of Payment</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceiveamountreceivelist']!=0) {
                                                ?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Amount Received</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceivenoteslist']!=0) {
                                                ?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Notes</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceiveeditlist']!=0) {
                                                ?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Edit</span></td>
                      <?php
                                            }
                                                ?>
								
							
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
$sql=mysqli_query($con,"set names utf8");
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes from pairsalespayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and type='job' order by id desc");
$count=1;
while($info=mysqli_fetch_array($sql))
{
if($info['term']=='CASH INVOICE')
{
$sqls=mysqli_query($con,"select cancelstatus from pair".$info['type']."s where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$info['receiptno']."' and invoicedate='".$info['receiptdate']."'");
$infos=mysqli_fetch_array($sqls);
if($infos['cancelstatus']=='1')
{
?>
<tr style="text-decoration: line-through;" onclick="window.open('salespaymentview.php?id=<?=$info['id']?>', '_self')">
<?php
}
else
{
?>
<tr onclick="window.open('salespaymentview.php?id=<?=$info['id']?>', '_self')">
<?php
}
}
else
{
?>
<tr onclick="window.open('salespaymentview.php?id=<?=$info['id']?>', '_self')">
<?php
}
?>
                                                <?php
                                            if ($access['payreceivedatelist']!=0) {
                                                ?>
<td data-label="Date"><?=date('d/m/Y',strtotime($info['receiptdate']))?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceivenolist']!=0) {
                                                ?>
<td data-label="Number"><?=$info['receiptno']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceivecustomernamelist']!=0) {
                                                ?>
<td data-label="Term"><?=$info['term']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceivetermlist']!=0) {
                                                ?>
<td data-label="Customer Name"><?=$info['customername']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceivemodeofpaylist']!=0) {
                                                ?>
<td data-label="Mode of Payment"><?=$info['paymentmode']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceiveamountreceivelist']!=0) {
                                                ?>
<td data-label="Amount Received"><i class="fa fa-rupee"></i> <?=number_format((float)$info['amount'],2,'.','')?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceivenoteslist']!=0) {
                                                ?>
<td data-label="Notes"><?=$info['notes']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ($access['payreceiveeditlist']!=0) {
                                                ?>
<td data-label="Edit"><a href="salespaymentedit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
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











                        </div>
                    </div>
                </div>

            </div>
        </div>
	 
      <div class="modal fade" id="deleteconfirm-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to Cancel this Invoice?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem" href="" class="btn btn-success success" >Yes</a>
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
 function deleteitem(invoiceno,invoicedate,cancelstatus)
{
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","invoicecancel.php?invoiceno="+invoiceno+"&invoicedate="+invoicedate+"&cancelstatus="+cancelstatus);
}
 </script>
 <script>
window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
</script>
</body>

</html>