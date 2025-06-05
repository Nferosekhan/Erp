<?php
include('lcheck.php');
if(!isset($_GET['cid']))
{
	header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include('externals.php');
?>
  <title>
    All <?=$pmsaleorderch?>s - Dmedia
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
                                <h6 class="font-weight-bolder mb-3 myheading"><i class="fa fa-quote-left"></i> <?=$pmsaleorderch?>s</h6>
								<?php

				  $cid=mysqli_real_escape_string($con, $_GET['cid']);
$sqliet=mysqli_query($con, "select franchisename, job, jobprefix, (jobsuffix+1) as jobsuffix from pairfranchises where tdelete='0' and id='".$cid."' order by id desc");
$infoet=mysqli_fetch_array($sqliet);
if($infoet['job']!='1')
{
	?>
	<div class="alert alert-danger mt-2 text-white">Sorry! <?=$pmsaleorderch?> Generation is Allowed for this Franchise</div>
	<?php
}
else
{
?>
<h6 class="text-blue"><?=$infoet['franchisename']?></h6>
								<div class="p-2" align="right">
								<a href="jobadd.php" class="btn btn-sm btn-custom"
											style="padding: 0.2rem 0.4rem;"><i class="fa fa-plus"
												style="font-size:13px;"></i> &nbsp; New <?=$pmsaleorderch?></a>
								 					
                                            <br>
											
                                        </div>
								
							
                            <div class="table-responsive p-0 min-height-480">
                                <table id="someTable" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
<th class="text-lowercase text-capitalize text-xs font-weight-bolder"><?=$pmsaleorderch?><br>Date</th>
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder"><?=$pmsaleorderch?> No</th>
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder">Customer<br>Name</th>
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder"><?=$pmsaleorderch?><br>Term</th>
                      <!--th class="text-lowercase text-capitalize text-xs font-weight-bolder">Due Date</th-->
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder"><?=$pmsaleorderch?><br>Amount</th>
                      <th class="text-lowercase text-capitalize text-xs font-weight-bolder">View</th>
												
                                        </tr>
                                    </thead>
                                   <tbody>
				  <?php
				  $totalcancel=array();
				  $totaljobno=array();
				  $totaljobdate=array();
				  $sql=mysqli_query($con, "select jobdate, jobno, customername, jobterm, duedate, jobamount, cancelstatus, estimatestatus, viewstatus from pairjobs where franchisesession='".$cid."' and (estimatestatus='0' and cancelstatus='0') and createdid='$companymainid' GROUP BY jobdate, jobno order by jobdate desc, jobno desc");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
					  $totalcancel[]=$info['cancelstatus'];
					  $totaljobno[]=$info['jobno'];
					  $totaljobdate[]=$info['jobdate'];
					  ?>
                      <tr <?=($info['viewstatus']=='')?'style="background-color:#eeeeee; border-top:1px solid #000000"':''?>>
                      <td data-label="<?=$pmsaleorderch?> Date"><?=(($info['jobdate']!='')?(date('d/m/Y',strtotime($info['jobdate']))):'')?></td>
                      <td data-label="<?=$pmsaleorderch?> No"><?=$info['jobno']?></td>
                      <td data-label="Customer Name"><?=$info['customername']?></td>
                      <td data-label="<?=$pmsaleorderch?> Term"><?=$info['jobterm']?></td>
                      <td data-label="<?=$pmsaleorderch?> Amount"><i class="fa fa-rupee"></i> <?=$info['jobamount']?></td>
					  <td data-label="Print" class="">&nbsp;
                        <a href="joballprint.php?cid=<?=$cid?>&jobno=<?=$info['jobno']?>&jobdate=<?=$info['jobdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit <?=$pmsaleorderch?>">
                          View
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
                Are you sure you want to Generate this <?=$pmsaleorderch?> as Invoice?
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
                Are you sure you want to Generate this <?=$pmsaleorderch?> as Estimate?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem1" href="" class="btn btn-success success" >Yes</a>
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
 function deleteitem(jobno,jobdate,cancelstatus)
{
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","jobcancel.php?jobno="+jobno+"&jobdate="+jobdate+"&cancelstatus="+cancelstatus);
}
 function deleteitem1(jobno,jobdate,cancelstatus)
{
	$('#deleteconfirm1-adddelete').modal('show');
	$("#deleteconfirm1-adddelete #deleteitem1").attr("href","estimatecancel.php?jobno="+jobno+"&jobdate="+jobdate+"&estimatestatus="+cancelstatus);
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