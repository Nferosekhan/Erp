<?php
include('lcheck.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include('externals.php');
?>
<link rel="stylesheet" type="text/css" media="all" href="vendor/daterangepicker/daterangepicker.css" />


  <title>
   Date Range - Dmedia
  </title>

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
    <div class="container-fluid py-3 bg-body" style="min-height:400px;">
        
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

                 <div class="customcont-header ml-0 mb-1" style="height:41px;">
	<a class="customcont-heading customcont-heading-active">Date Range</a>



	</div>

  <div class="row">
  <div class="col-lg-4">
				  <div class="form-group">
					<label for="reportrange">Date Range</label>
					<input type="text" class="form-control  form-control-sm" id="reportrange" name="reportrange">
				  </div>
				</div>
  </div>
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
<script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
<script>
$(function() {
  var start = moment().subtract(29, 'days');
  var end = moment();
  $('#reportrange').daterangepicker({
    startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,        
    "applyClass": "btn-custom",
    "cancelClass": "btn-custom-grey"
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
</body>

</html>