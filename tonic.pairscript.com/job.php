<?php
include('lcheck.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include('externals.php');
?>
  <title>
    Job - Dmedia
  </title>
<style>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
  table {
    border: 0;
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
  include('sidebar.php');
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-0 shadow-none" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-0">
        <nav aria-label="breadcrumb">
        </nav>
        <?php include('navbar.php'); ?>
      </div>
    </nav>
    <!-- End Navbar -->
     <div class="container-fluid py-4 bg-body">
 	 <?php
	 if(isset($_GET['remarks']))
	 {
	 ?>
	 <div class="toast bg-gradient-success text-white" id="myToast"><div class="toast-body"><i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks']?></div></div>
	 <?php
	 }
	 ?>
	 <?php
	 if(isset($_GET['error']))
	 {
	 ?>
	 <div class="toast bg-gradient-danger text-white" id="myToast"><div class="toast-body"><i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></div></div>
	 <?php
	 }
	 ?>
	 
	 
	 <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body p-3">
                                <h6 class="font-weight-bolder mb-3 myheading"><i class="fa fa-suitcase"></i> Job</h6>
								
								<div class="p-2" align="right">
								<a href="jobadd.php" class="btn btn-sm btn-custom"
											style="padding: 0.2rem 0.4rem;"><i class="fa fa-plus"
												style="font-size:13px;"></i> &nbsp; New job</a>
								 					
                                            <br>
											
                                        </div>
								
							
                            <div class="table-responsive p-0 min-height-480">
                                <table id="someTable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
	<th class="text-lowercase text-capitalize text-xs font-weight-bolder">Invoice Date</th>
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder">Invoice No</th>
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder">Customer Name</th>
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder">Invoice Term</th>
                      <!--th class="text-lowercase text-capitalize text-xs font-weight-bolder">Due Date</th-->
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder">Invoice Amount</th>
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder">Edit</th>
												
                                        </tr>
                                    </thead>
                                    <tbody>
                   <?php
				  $totalcancel=array();
				  $totalinvoiceno=array();
				  $totalinvoicedate=array();
				  $sql=mysqli_query($con, "select invoicedate, invoiceno, customername, invoiceterm, duedate, invoiceamount, cancelstatus from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
					 /* $totalid[]=$info['id'];*/
					  $totalcancel[]=$info['cancelstatus'];
					  $totalinvoiceno[]=$info['invoiceno'];
					  $totalinvoicedate[]=$info['invoicedate'];
					  if($info['cancelstatus']=='1')
					  {
					  ?>
                      <tr style="text-decoration: line-through;">
                      <?php
					  }
					  else
					  {
					  ?>
                      <tr>
                      <?php
					  }
					  ?>
                      <td data-label="Invoice Date"><?=(($info['invoicedate']!='')?(date('d/m/Y',strtotime($info['invoicedate']))):'')?></td>
                      <td data-label="Invoice No"><?=$info['invoiceno']?></td>
                      <td data-label="Customer Name"><?=$info['customername']?></td>
                      <td data-label="Invoice Term"><?=$info['invoiceterm']?></td>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td data-label="Invoice Amount"><i class="fa fa-rupee"></i> <?=$info['invoiceamount']?></td>
					  <!--td class="">&nbsp;
                        <a href="invoiceedit.php?invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td-->
					  <td data-label="Edit" class="">&nbsp;
                        <a target="_blank" href="invoiceprint.php?invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Print
                        </a>
                      </td>
                      <?php
					  /* if($info['cancelstatus']=='1')
					  {
					  ?>
                      <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['invoiceno']?>','<?=$info['invoicedate']?>','0')"><i class="fa fa-check"></i> Enable Invoice</a></td>
                      <?php
					  }
					  else
					  {
					  ?>
                      <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['invoiceno']?>','<?=$info['invoicedate']?>','1')"><i class="fa fa-times"></i> Cancel Invoice</a></td>
                      <?php
					  } */
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