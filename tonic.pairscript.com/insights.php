<?php
include('lcheck.php');
// if (isset($_POST['storeaccess'])) {
// 	$store=mysqli_real_escape_string($con,$_POST['storeaccess']);
// 	$sql=mysqli_query($con,"update into paircontrols set storeaccess='$store' where createdby='".$_SESSION['unqwerty']."'");
// }
if($permissioninsights=='0'){
header('location:dashboard.php');
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
   Insights
  </title>
<style type="text/css">
        .wrapper{
            width: 370px;
            margin: 130px auto 0;
        }
        .select-btn{
            height: 65px;
            padding: 0 20px;
            border-radius: 7px;
            background: blue;
            display: flex;
            font-size: 22px;
            align-items: center;
            justify-content: space-between;
        }
        .content{
            display: none;
            padding: 20px;
            margin-top: 15px;
            border-radius: 7px;
            background: #fff;
        }
        .wrapper.active .content{
            display: block;
        }
        .content .search{
            position: relative;
        }
        .search input{
            height: 53px;
            width: 100%;
            font-size: 17px;
            outline: none;
            border-radius: 5px;
            padding: 0 15px 0 43px;
            border: 1px solid #b3b3b3;
        }
        .content .options{
            margin-top: 10px;
            max-height: 250px;
            overflow-y: auto;
            padding-right: 7px;
        }
        .options::-webkit-scrollbar{
            width: 7px;
        }
        .options::-webkit-scrollbar-track{
            background: #f1f1f1;
            border-radius: 25px;
        }
        .options::-webkit-scrollbar-thumb{
            background: #ccc;
            border-radius: 25px;
        }
        .options li{
            height: 50px;
            border-radius: 5px;
            padding: 0 13px;
            font-size: 21px;
        }
        .options li:hover{
            background-color: green;
        }
        .select-btn, .options li{
            display: flex;
            cursor: pointer;
            align-items: center;
        }
    </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6">
  <?php
  include('sidebar.php');
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
   <?php
    include('navhead.php');
    ?>  
    <div class="container-fluid py-3 bg-body" style="min-height:400px;">
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
             <div class="card-body p-3">

                 <div class="customcont-header ml-0 mb-1" style="height:41px;">
	<a class="customcont-heading customcont-heading-active" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Insights</a>
	</div>
    <?php
$sqlcontrol = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultcontrol = mysqli_query($con, $sqlcontrol);
$sidebarprefer = mysqli_fetch_array($resultcontrol);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){}
else{
    $sqlmainaccessinsight = mysqli_query($con,"select insightsale,moduleaccess from pairmainaccess where userid='$companymainid' and moduletype='Invoices'");
    $sqlinsight = mysqli_fetch_assoc($sqlmainaccessinsight);
    if (($sqlinsight['insightsale']==1)&&($sqlinsight['moduleaccess']=='1')) {
    ?>
	<div class="row">
        <div class="col-lg-9 mb-3 mt-2"> 
            <span style="color:black;font-size:20px;margin-top:3px; margin-bottom:5px;">SALES</span>
        </div>
		<div class="col-lg-3 mb-3 mt-2">
		<form action="" method="post">
		<select class="form-control form-control-sm" name="type" id="type" onchange="this.form.submit()">
		<option value="30" <?=((isset($_POST['type']))&&($_POST['type']=='30'))?'selected':''?>>Last 30 Days</option>
		<option value="7" <?=((isset($_POST['type']))&&($_POST['type']=='7'))?'selected':''?>>Last 7 Days</option>
		</select>
		</form>
		</div>
	</div>
	<?php
$pairarray=array();
$pairdates=array();
$q="";
if(isset($_POST['type']))
{
	if($_POST['type']=='7')
	{
		$q='and invoicedate >= DATE(NOW() - INTERVAL 7 DAY)';
	}
	else
	{
		$q='and invoicedate >= DATE(NOW() - INTERVAL 30 DAY)';
	}	
}
else
{
	$q='and invoicedate >= DATE(NOW() - INTERVAL 30 DAY)';
}
$q1="";
if(isset($_POST['type']))
{
	if($_POST['type']=='7')
	{
		$q1='and proformadate >= DATE(NOW() - INTERVAL 7 DAY)';
	}
	else
	{
		$q1='and proformadate >= DATE(NOW() - INTERVAL 30 DAY)';
	}	
}
else
{
	$q1='and proformadate >= DATE(NOW() - INTERVAL 30 DAY)';
}
$totalamount=0;
$sqliinvoice=mysqli_query($con, "select invoiceamount, invoicedate, invoiceno from pairinvoices where createdid='$companymainid' ".$q." GROUP BY invoicedate, invoiceno order by invoicedate asc, invoiceno asc");

while($infoinvoice=mysqli_fetch_array($sqliinvoice))
{
	$pairdates[]=$infoinvoice['invoicedate'];
	if(isset($pairarray[$infoinvoice['invoicedate']]))
	{
		$pairarray[$infoinvoice['invoicedate']]+=$infoinvoice['invoiceamount'];
	}
	else
	{
		$pairarray[$infoinvoice['invoicedate']]=$infoinvoice['invoiceamount'];
	}
	$totalamount+=(float)$infoinvoice['invoiceamount'];
}
$sqliproforma=mysqli_query($con, "select proformaamount, proformadate, proformano from pairproformas where createdid='$companymainid' ".$q1." GROUP BY proformadate, proformano order by proformadate asc, proformano asc");

while($infoproforma=mysqli_fetch_array($sqliproforma))
{
	$pairdates[]=$infoproforma['proformadate'];
	if(isset($pairarray[$infoproforma['proformadate']]))
	{
		$pairarray[$infoproforma['proformadate']]+=$infoproforma['proformaamount'];
	}
	else
	{
		$pairarray[$infoproforma['proformadate']]=$infoproforma['proformaamount'];
	}
	$totalamount+=(float)$infoproforma['proformaamount'];
}
$pairdates=array_unique($pairdates);
?>
<h5 class="text-blue"><i class="fa fa-rupee"></i> <?=number_format((float)$totalamount,2,'.', '')?></h5>
<p><?php
if(isset($_POST['type']))
{
	if($_POST['type']=='7')
	{
		echo 'Last 7 Days';
	}
	else
	{
		echo 'Last 30 Days';
	}	
}
else
{
	echo 'Last 30 Days';
}
?>
</p>
<canvas id="myChart" style="width:100%; height:300px;"></canvas>


<script>
var xValues = [<?php foreach($pairdates as $date){ echo '"'.date('M d',strtotime($date)).'"'.','; }?>];
var yValues = [<?php foreach($pairdates as $value){ echo $pairarray[$value].','; }?>];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(50,168,82,1.0)",
      borderColor: "rgba(50,168,82,0.5)",
	   pointStyle: 'circle',
      pointRadius: 5,
      pointHoverRadius: 10,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [],
    }
  }
});
</script>
<?php
}
}
?>
	
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
</body>

</html>