<?php
include('lcheck.php');
// This is for Restriction of Pages
$sql = "select * from paircontrols where id='$companymainid'";  
$result = mysqli_query($con, $sql);
$rowes = mysqli_fetch_array($result);
$sql = "select * from paircontrols where username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."'";  
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_array($result);
if($userrole!='SUPER ADMIN')
{
    if($rowes['permissionsidebooks']==0||$rowes['permissionquotations']==0||$rows['bqtview']==0||$row['franchises']==''){
    header('Location: dashboard.php');
}
}
else{
    if($rowes['permissionsidebooks']==0||$rowes['permissionquotations']==0||$row['franchises']==''){
    header('Location: dashboard.php');
}
}
if(!isset($_GET['cid']))
{
	header('Location: dashboard.php');
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
    Quotations - Dmedia
  </title>
<style>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
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
                                <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> Quotations</p>
								<?php
$cid=mysqli_real_escape_string($con, $_GET['cid']);
$sqliet=mysqli_query($con, "select franchisename, quotation, quotationprefix, (quotationsuffix+1) as quotationsuffix from pairfranchises where tdelete='0' and id='".$cid."' order by id desc");
$infoet=mysqli_fetch_array($sqliet);
if($infoet['quotation']!='1')
{
	?>
	<div class="alert alert-danger mt-2 text-white">Sorry! Quotation Generation is Allowed for this Franchise</div>
	<?php
}
else
{
?>
<h5 class="text-blue"><?=$infoet['franchisename']?></h5>
						    <div class="table-responsive p-0 min-height-480">
                                <table id="someTable" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                        <tr>
<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Quotation<br>Date</span></td>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Quotation No</span></td>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Customer<br>Name</span></td>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Quotation<br>Term</span></td>
                      <!--td class="text-uppercase" style="width:50px;"><span style="font-size:13px;">Due Date</span></td-->
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Quotation<br>Amount</span></td>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Generate<br>Estimate</span></td>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Generate<br>Proforma Invoice</span></td>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Generate<br>Invoice</span></td>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Print</span></td>
					  
                      <!--td class="text-uppercase" style="width:50px;"><span style="font-size:13px;">Cancel Quotation</span></td-->
												
                                        </tr>
                                    </thead>
                                   <tbody>
				  <?php
				  $totalcancel=array();
				  $totalquotationno=array();
				  $totalquotationdate=array();
				  $sql=mysqli_query($con, "select quotationdate, quotationno, customername, quotationterm, duedate, quotationamount, cancelstatus, estimatestatus, proformastatus, id from pairquotations where franchisesession='".$cid."' and createdid='$companymainid' GROUP BY quotationdate, quotationno order by quotationdate desc, quotationno desc");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
            $id=$info['id'];
					 /* $totalid[]=$info['id'];*/
					  $totalcancel[]=$info['cancelstatus'];
					  $totalquotationno[]=$info['quotationno'];
					  $totalquotationdate[]=$info['quotationdate'];
					  /* if($info['cancelstatus']=='1')
					  {
					  ?>
                      <tr style="text-decoration: line-through;">
                      <?php
					  }
					  else
					  { */
					  ?>



                 <?php
        
          $count=1;
          $sqli=mysqli_query($con, "select * from pairquotations where franchisesession='".$_SESSION["franchisesession"]."' and id='$id'");
                 
                 
                  while($infop=mysqli_fetch_array($sqli))
          {
            // $sqlias=mysqli_query($con, "select salecost from pairprosale where productid='".$info['id']."'");
            // $infoas=mysqli_fetch_array($sqlias);
            ?>

                      <tr>

             <?php
          $count++;
                  }
                
               
                  
          ?>

                      <?php
					  /* } */
					  ?>
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Quotation Date"><?=(($info['quotationdate']!='')?(date('d/m/Y',strtotime($info['quotationdate']))):'')?></td>
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Quotation No"><?=$info['quotationno']?></td>
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Customer Name"><?=$info['customername']?></td>
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Quotation Term"><?=$info['quotationterm']?></td>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Quotation Amount"><i class="fa fa-rupee"></i> <?=$info['quotationamount']?></td>
					   <?php
					  if($info['estimatestatus']=='1')
					  {
					  ?>
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Estimate Converted</a></td>
                      <?php
					  }
					  else
					  {
					  ?>
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')"><a id="edit_button" class="text-danger" style="cursor:pointer">Pending</a></td>
                      <?php
					  } 
					  ?>
					  
					  <?php
					  if($info['proformastatus']=='1')
					  {
					  ?>
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Proforma Invoice Converted</a></td>
                      <?php
					  }
					  else
					  {
					  ?>
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')"><a id="edit_button" class="text-danger" style="cursor:pointer">Pending</a></td>
                      <?php
					  } 
					  ?>
					  <?php
					  if($info['cancelstatus']=='1')
					  {
					  ?>
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Invoice Converted</a></td>
                      <?php
					  }
					  else
					  {
					  ?>
                      <td onclick="window.open('quotationallview.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')"><a id="edit_button" class="text-danger" style="cursor:pointer" >Pending</a></td>
                      <?php
					  } 
					  ?>
                      
					  <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="quotationprint.php?cid=<?=$cid?>&quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Quotation">
                          Print
                        </a>
                      </td>
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
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to Generate this Quotation as Invoice?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem" href="" class="btn btn-success success" >Yes</a>
        </div>
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
                Are you sure you want to Generate this Quotation as Estimate?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem1" href="" class="btn btn-success success" >Yes</a>
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
                Are you sure you want to Generate this Quotation as Proforma Invoice?
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
 function deleteitem(quotationno,quotationdate,cancelstatus)
{
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","quotationcancel.php?quotationno="+quotationno+"&quotationdate="+quotationdate+"&cancelstatus="+cancelstatus);
}
 function deleteitem1(quotationno,quotationdate,cancelstatus)
{
	$('#deleteconfirm1-adddelete').modal('show');
	$("#deleteconfirm1-adddelete #deleteitem1").attr("href","estimatecancel.php?quotationno="+quotationno+"&quotationdate="+quotationdate+"&estimatestatus="+cancelstatus);
}
 function deleteitem2(quotationno,quotationdate,cancelstatus)
{
	$('#deleteconfirm2-adddelete').modal('show');
	$("#deleteconfirm2-adddelete #deleteitem2").attr("href","proformacancel1.php?quotationno="+quotationno+"&quotationdate="+quotationdate+"&proformastatus="+cancelstatus);
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