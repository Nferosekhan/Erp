<?php
include('lcheck.php');
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
if(isset($_POST['projectname']))
{
date_default_timezone_set('Asia/Calcutta');
$createdon=date('Y-m-d H:i:s');
$data1 = mysqli_query($con, "SET NAMES utf8");
$data1=mysqli_query($con, "SET sql_mode = ''");
$data1=mysqli_query($con, "select project, projectprefix, (projectsuffix+1) as projectsuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$info1=mysqli_fetch_array($data1);

$projectno=mysqli_real_escape_string($con, $info1['projectprefix'].(str_pad((float)$info1['projectsuffix']+1, 0, "0", STR_PAD_LEFT)));
$projectdate=mysqli_real_escape_string($con, $_POST['projectdate']);
$projectname=mysqli_real_escape_string($con, $_POST['projectname']);
$projectdescription=mysqli_real_escape_string($con, $_POST['projectdescription']);
$customername=mysqli_real_escape_string($con, $_POST['customername']);
$customerid=mysqli_real_escape_string($con, $_POST['customerid']);
$billingmethod=mysqli_real_escape_string($con, $_POST['billingmethod']);
$projectcost=mysqli_real_escape_string($con, $_POST['projectcost']);
$rateperhour=mysqli_real_escape_string($con, $_POST['rateperhour']);


if($customerid=='')
{
	$sqlcon = "SELECT id From paircustomers WHERE franchisesession='".$_SESSION["franchisesession"]."' and customername = '{$customername}'";
$querycon = mysqli_query($con, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if(!$querycon){
   die("SQL query failed: " . mysqli_error($con));
}
if($rowCountcon == 0) 
{   
$sqlup = "insert into paircustomers set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', customername='$customername'";
$queryup = mysqli_query($con, $sqlup);
if(!$queryup){
   die("SQL query failed: " . mysqli_error($con));
}
else
{
$tid=mysqli_insert_id($con);
$customerid=$tid;
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Customer', '{$tid}')");
} 
}
}

$usercount=count($_POST['username']);
$taskcount=count($_POST['taskname']);
$largest=max($usercount,$taskcount);
$sql2=mysqli_query($con, "SET sql_mode = ''");
$sql2=mysqli_query($con, "select id from pairprojects where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and projectno='$projectno' and projectdate='$projectdate'");
if(mysqli_num_rows($sql2)==0)
{
for($i=0; $i<$largest; $i++)
{
if(isset($_POST['userid'][$i]))
{
$userid=mysqli_real_escape_string($con, $_POST['userid'][$i]);
}
else
{
$userid="";	
}
if(isset($_POST['username'][$i]))
{
$username=mysqli_real_escape_string($con, $_POST['username'][$i]);
}
else
{
$username="";	
}
if(isset($_POST['useremail'][$i]))
{
$useremail=mysqli_real_escape_string($con, $_POST['useremail'][$i]);
}
else
{
$useremail="";	
}
if(isset($_POST['userrateperhour'][$i]))
{
$userrateperhour=mysqli_real_escape_string($con, $_POST['userrateperhour'][$i]);
}
else
{
$userrateperhour="";	
}
if(isset($_POST['taskname'][$i]))
{
$taskname=mysqli_real_escape_string($con, $_POST['taskname'][$i]);
}
else
{
$taskname="";	
}
if(isset($_POST['taskdescription'][$i]))
{
$taskdescription=mysqli_real_escape_string($con, $_POST['taskdescription'][$i]);
}
else
{
$taskdescription="";	
}
if(isset($_POST['taskrateperhour'][$i]))
{
$taskrateperhour=mysqli_real_escape_string($con, $_POST['taskrateperhour'][$i]);
}
else
{
$taskrateperhour="";	
}
if(isset($_POST['taskbillable'][$i]))
{
$taskbillable=mysqli_real_escape_string($con, $_POST['taskbillable'][$i]);
}
else
{
$taskbillable="";	
}
if(($username!='')||($taskname!=''))
{
	
$sql=mysqli_query($con, "insert into pairprojects set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', projectdate='$projectdate', projectno='$projectno', projectname='$projectname', projectdescription='$projectdescription', customername='$customername', customerid='$customerid', billingmethod='$billingmethod', projectcost='$projectcost', rateperhour='$rateperhour', userid='$userid', username='$username', useremail='$useremail', userrateperhour='$userrateperhour', taskname='$taskname', taskdescription='$taskdescription', taskrateperhour='$taskrateperhour', taskbillable='$taskbillable'");
if($sql)
{
/* $salesid=mysqli_insert_id($con);
$sql4=mysqli_query($con, "update users set openingstock=openingstock-$projectcredit where id='$userid'"); */
}
else
{
echo mysqli_error($con);
}
}
$tid=mysqli_insert_id($con);
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Project', '{$tid}')");
}
/* if($projectterm=='CASH')
{
$sql=mysqli_query($con, "insert into salespayments set createdon='$createdon', customername='$customername', customerid='$customerid', receiptno='$projectno', receiptdate='$projectdate', amount='$projectamount', paymentmode='CASH', useremail='-'");
} */
$sql3=mysqli_query($con, "update pairfranchises set projectsuffix=projectsuffix+1 where tdelete='0' and id='".$_SESSION['franchisesession']."'");
if($sql3)
{
//echo '<script> window.open("projectprint.php?projectno='.$projectno.'&projectdate='.$projectdate.'", "_blank");</script>';
echo '<script> window.location.href="projects.php?remarks=Added Successfully";</script>'; 
}
}
else
{
header("Location: projects.php?error=Error Data");
}
}
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Projects' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccesscreate']==0)))) {
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
New <?= $infomainaccessuser['modulename'] ?>
  </title>
</head>
<body class="g-sidenav-show" style="background-color:#F1F2F6" onLoad="billingchange()">
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Projects' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
     ?>
   <div style="max-width: 1650px;">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<p class="mb-3" style="font-size:20px;"><i class="fa fa-file-import"></i> New
<?= $infomainaccessuser['modulename'] ?></p>
	
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Projects' order by id  asc");
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

<hr>



<div class="row">
<div class="col-lg-12">
	
<div class="accordion" id="accordionRental">
	
	<div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingOne">
				
				<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading" style="font-size: 18px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $infomainaccessuser['modulename'] ?> Details</a>	
             
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
              <input type="date" class="form-control  form-control-sm" id="projectdate" name="projectdate"  required value="<?=date('Y-m-d')?>">
			  
            </div>
			</div>
		
		  <div class="form-group row">
            <div class="col-sm-4">
            <label for="receiptno" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Number *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="projectno" name="projectno" required value="<?=$infomainaccessuser['moduleprefix']?><?=str_pad(($infomainaccessuser['modulesuffix']+1), 0, "0", STR_PAD_LEFT)?>" readonly>	  
            </div>
			</div>
	
	
	
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="projectname" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Name *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="projectname" name="projectname" placeholder="Name" required>
			  
            </div>
			</div>
			
			<div class="form-group row">
            <div class="col-sm-4">
            <label for="projectdescription" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Description</label>
            </div>
            <div class="col-sm-8">
              <textarea class="form-control  form-control-sm" id="projectdescription1" name="projectdescription" placeholder="Description" style="height:100px;"></textarea>
			  
            </div>
			</div>
			
			
			 <div class="form-group row">
            <div class="col-sm-4">
            <label for="projectname" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Customer Name *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="customername" name="customername" placeholder="Customer Name" required>
			  <input type="hidden" name="customerid" id="customerid" value="">
            </div>
			</div>
			
			
		
		  <div class="form-group row">
            <div class="col-sm-4">
            <label for="receiptno" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Billing Method *</span></label>
            </div>
            <div class="col-sm-8">
              <select class="form-control  form-control-sm select4" id="billingmethod" name="billingmethod" required onchange="billingchange()">			  
			  <option value="">Select</option>
			  <option value="Fixed Cost for Project">Fixed Cost for Project</option>
			  <option value="Based on Project Hours">Based on Project Hours</option>
			  <option value="Based on Task Hours">Based on Task Hours</option>
			  <option value="Based on Staff Hours">Based on Staff Hours</option>			  
			  </select>
            </div>
			</div>
			<script>
			function toggle(className, displayState){
    var elements = document.getElementsByClassName(className)

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = displayState;
    }
}
			function billingchange()
			{
			var billingmethod=document.getElementById("billingmethod").value;
			if(billingmethod!='')
			{
				if(billingmethod=='Fixed Cost for Project')
				{
				document.getElementById("projectcostdiv").style.display="block";
				document.getElementById("rateperhourdiv").style.display="none";
				$('#purchasetable').find('th:nth-child(5)').hide();
				$('#purchasetable').find('td:nth-child(5)').hide();
				$('#purchase1table').find('th:nth-child(5)').hide();
				$('#purchase1table').find('td:nth-child(5)').hide();
				$('#purchase1table').find('th:nth-child(6)').hide();
				$('#purchase1table').find('td:nth-child(6)').hide();
				}
				if(billingmethod=='Based on Project Hours')
				{
				document.getElementById("projectcostdiv").style.display="none";
				document.getElementById("rateperhourdiv").style.display="block";
				$('#purchasetable').find('th:nth-child(5)').hide();
				$('#purchasetable').find('td:nth-child(5)').hide();
				$('#purchase1table').find('th:nth-child(5)').hide();
				$('#purchase1table').find('td:nth-child(5)').hide();
				$('#purchase1table').find('th:nth-child(6)').hide();
				$('#purchase1table').find('td:nth-child(6)').hide();
				}
				if(billingmethod=='Based on Task Hours')
				{
				document.getElementById("projectcostdiv").style.display="none";
				document.getElementById("rateperhourdiv").style.display="none";
				$('#purchasetable').find('th:nth-child(5)').hide();
				$('#purchasetable').find('td:nth-child(5)').hide();
				$('#purchase1table').find('th:nth-child(5)').show();
				$('#purchase1table').find('td:nth-child(5)').show();
				$('#purchase1table').find('th:nth-child(6)').show();
				$('#purchase1table').find('td:nth-child(6)').show();
				}
				if(billingmethod=='Based on Staff Hours')
				{
				document.getElementById("projectcostdiv").style.display="none";
				document.getElementById("rateperhourdiv").style.display="none";
				$('#purchasetable').find('th:nth-child(5)').show();
				$('#purchasetable').find('td:nth-child(5)').show();
				$('#purchase1table').find('th:nth-child(5)').hide();
				$('#purchase1table').find('td:nth-child(5)').hide();
				$('#purchase1table').find('th:nth-child(6)').hide();
				$('#purchase1table').find('td:nth-child(6)').hide();
				}

			}
			else
			{
				document.getElementById("projectcostdiv").style.display="none";
				document.getElementById("rateperhourdiv").style.display="none";
				$('#purchasetable').find('th:nth-child(5)').hide();
				$('#purchasetable').find('td:nth-child(5)').hide();
				$('#purchase1table').find('th:nth-child(5)').hide();
				$('#purchase1table').find('td:nth-child(5)').hide();
				$('#purchase1table').find('th:nth-child(6)').hide();
				$('#purchase1table').find('td:nth-child(6)').hide();
				
			}
			}
			</script>
			<div  id="projectcostdiv" style="display:none">
			<div class="form-group row">
            <div class="col-sm-4">
            <label for="projectname" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Total Project Cost *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="number" min="0" step="0.01" class="form-control  form-control-sm" id="projectcost" name="projectcost" placeholder="Total Project Cost">
			  
            </div>
			</div>
			</div>
			<div  id="rateperhourdiv" style="display:none">
			<div class="form-group row">
            <div class="col-sm-4">
            <label for="projectname" class="custom-label" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><span class="text-danger">Rate Per Hour *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="number" min="0" step="0.01" class="form-control  form-control-sm" id="rateperhour" name="rateperhour" placeholder="Rate Per Hour">
			  
            </div>
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
	 <h5 class="accordion-header" id="headingTwo" >
	 
	 <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
		 
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;">User Information</a>
</div>
</button>
</h5>
<div id="collapseTwo" class="accordion-collapse collapse show"
aria-labelledby="headingTwo">
<div class="accordion-body text-sm" style="padding-bottom: 0px;padding-top: 3px">
	
	
	
<div class="table-responsive">
  <table class="table table-bordered" id="purchasetable">
<thead>
<tr><th style="display:none"></th><th></th><th>USER</th><th >EMAIL</th><th>RATE PER HOUR</th><th></th></tr>
</thead>
<tbody>
<?php 
$sqlimainuser=mysqli_query($con, "select id, firstname, email from paircontrols where id='$companymainid'");
if(mysqli_num_rows($sqlimainuser)>0)
{
	$infomainuser=mysqli_fetch_array($sqlimainuser);
	?>
<tr>
<td class="priority" style="display:none"> 0</td>
<td><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td><input type="hidden" name="userid[]" id="userid0" value="<?=$infomainuser['id']?>"><input type="text" name="username[]" id="username0" required class="form-control form-control-sm bordernoneinput" value="<?=$infomainuser['firstname']?>" readonly ></td>
<td><input type="text" name="useremail[]" id="useremail0" class="form-control form-control-sm bordernoneinput" required value="<?=$infomainuser['email']?>" readonly></td>
<td><input type="text" name="userrateperhour[]" id="userrateperhour0" class="form-control form-control-sm bordernoneinput"></td>
<td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
	<?php
}
?>




</tbody>
</table>
</div>

<div class="row">
	<div class="col-lg-4">
	<p align="left" style="margin:0; padding:0">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line</a></p>
</div>
  </div>

</div>
</div>
</div>
</div>

</div>



<hr style="margin:0 0 0.5rem 0;">
<div class="row">
	
	<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
	 <h5 class="accordion-header" id="headingThree" >
	 
	 <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
		 
<div class="customcont-header ml-0 mb-1" style="height: 30px;">
<a class="customcont-heading" style="padding: 7px 0 7px;">Task Information</a>
</div>
</button>
</h5>
<div id="collapseThree" class="accordion-collapse collapse show"
aria-labelledby="headingThree">
<div class="accordion-body text-sm" style="padding-bottom: 0px;padding-top: 3px">
	
	
	
<div class="table-responsive">
  <table class="table table-bordered" id="purchase1table">
<thead>
<tr><th style="display:none"></th><th></th><th>TASK NAME</th><th >DESCRIPTION</th><th>RATE PER HOUR</th><th>BILLABLE</th><th></th></tr>
</thead>
<tbody>
<tr>
<td class="priority" style="display:none"> 1</td>
<td><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td><input type="text" name="taskname[]" id="taskname1" required class="form-control form-control-sm bordernoneinput" ></td>
<td><input type="text" name="taskdescription[]" id="taskdescription1" class="form-control form-control-sm bordernoneinput" required></td>
<td><input type="text" name="taskrateperhour[]" id="taskrateperhour1" class="form-control form-control-sm bordernoneinput"></td>
<td><select name="taskbillable[]" id="taskbillable1" class="form-control form-control-sm bordernoneinput"><option value="Non-Billable">Non-Billable</option><option value="Billable">Billable</option></select></td>
<td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
</tbody>
</table>
</div>

<div class="row">
	<div class="col-lg-4">
	<p align="left" style="margin:0; padding:0">
<a class="purchase1add-row btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line</a></p>
</div>
  </div>

</div>
</div>
</div>
</div>

</div>



  
  
  <div class="row justify-content-center" id="footer" style="height: 50px;">

<div class="row col-md-12" style="padding-top: 8px;padding-left: 3px;">
    <div class="col">
      <button class="btn btn-primary btn-sm btn-custom-grey arlina-button expand-left" style="margin-right: 9px;background-color: #f8f8f8;border-color: #c6c6c6;color: #212529; display:none"   >
                <span class="label">Save as Draft</span> <span class="spinner"></span>
            </button>  

            <div class="btn-group dropup"> 
            <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-right: 0px;" type="submit" id="submit" name="submit" value="Submit"  >
                <span class="label">Save</span> <span class="spinner"></span>
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
            href="projects.php">Cancel</a>

           
    </div>
   
    <div class="col">
   

</div>
</div>

</div>
  
  
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
let lineNo = 2;
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
$( "#username"+lineNo ).autocomplete({
   source: 'usersearch1.php', select: function (event, ui) { $("#username"+lineNo).val(ui.item.firstname); $("#userid"+lineNo).val(ui.item.id); $("#useremail"+lineNo).val(ui.item.email);}, minLength: 0
 });
 
 $( "#customername"+lineNo ).autocomplete({
   source: 'customersearch.php', select: function (event, ui) { $("#customername").val(ui.item.customername); $("#customerid").val(ui.item.id);}, minLength: 0
 });
}
function addnewrow(lineNo)
{
markup = '<tr><td class="priority" style="display:none"> '+lineNo+'</td><td><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td><input type="hidden" name="userid[]" id="userid'+lineNo+'"><input type="text" name="username[]" id="username'+lineNo+'" required class="form-control form-control-sm bordernoneinput" ></td><td><input type="text" name="useremail[]" id="useremail'+lineNo+'" class="form-control form-control-sm bordernoneinput" required></td><td ><input type="text" name="userrateperhour[]" id="userrateperhour'+lineNo+'" class="form-control form-control-sm bordernoneinput"></td><td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td></tr>';
tableBody = $("#purchasetable");
tableBody.append(markup);
proautocomp(lineNo);
renumber_table('#purchasetable');   
billingchange();
}
</script>


<script>
lineNo = 2;
$(document).ready(function () {
$(".purchase1add-row").click(function () {
addnewrow1(lineNo);  
lineNo++;   
}); 
}); 
</script>
<script>

function addnewrow1(lineNo)
{
markup = '<tr><td class="priority" style="display:none"> '+lineNo+'</td><td><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td><input type="text" name="taskname[]" id="taskname'+lineNo+'" required class="form-control form-control-sm bordernoneinput" ></td><td><input type="text" name="taskdescription[]" id="taskdescription'+lineNo+'" class="form-control form-control-sm bordernoneinput" required></td><td><input type="text" name="taskrateperhour[]" id="taskrateperhour'+lineNo+'" class="form-control form-control-sm bordernoneinput"></td><td><select name="taskbillable[]" id="taskbillable'+lineNo+'" class="form-control form-control-sm bordernoneinput"><option value="Non-Billable">Non-Billable</option><option value="Billable">Billable</option></select></td><td><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td></tr>';
tableBody = $("#purchase1table");
tableBody.append(markup);
renumber_table('#purchase1table');   
billingchange();
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
}
}
else
{
	alert('Unable to Delete First row');
}
});

//Make diagnosis table sortable
$("#purchase1table tbody").sortable({
helper: fixHelperModified,
stop: function(event,ui) {renumber_table('#purchase1table')}
}).disableSelection();
//Delete button in table rows
$('table').on('click','.btn-delete',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("purchase1table").rows.length;
if(x!=2)
{
r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
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
$( "#username1" ).autocomplete({
   source: 'usersearch1.php', select: function (event, ui) { $("#username1").val(ui.item.firstname); $("#userid1").val(ui.item.id); $("#useremail1").val(ui.item.email);}, minLength: 0
 });
   $( "#customername" ).autocomplete({
   source: 'customersearch.php', select: function (event, ui) { $("#customername").val(ui.item.customername); $("#customerid").val(ui.item.id);}, minLength: 0
 });
  });
</script>
<script>
function usercalc(id)
{
var projectcredit = $('#projectcredit'+id).val();
var projectdebit = $('#projectdebit'+id).val();
if((projectcredit!='')&&(projectdebit!=''))
{
var x = document.getElementById("purchasetable").rows.length;
x--;
var totalcredit=0;
var totaldebit=0;
var projectcredits = document.getElementsByName('projectcredit[]');
var projectdebits = document.getElementsByName('projectdebit[]');
for (var i = 0; i < projectcredits.length; i++) 
{
var vat = parseFloat(projectcredits[i].value);
if(!isNaN(vat))
{
totalcredit+=vat;
}
var vat1 = parseFloat(projectdebits[i].value);
if(!isNaN(vat1))
{
totaldebit+=vat1;
}
}
document.getElementById('subprojectdebit').value=parseFloat(Math.round(totaldebit * 100) / 100).toFixed(2);
document.getElementById('subprojectcredit').value=parseFloat(Math.round(totalcredit * 100) / 100).toFixed(2);
document.getElementById('totalprojectdebit').value=parseFloat(Math.round(totaldebit * 100) / 100).toFixed(2);
document.getElementById('totalprojectcredit').value=parseFloat(Math.round(totalcredit * 100) / 100).toFixed(2);

document.getElementById('totalprojectcredit').value=parseFloat(Math.round(totalcredit * 100) / 100).toFixed(2);

if(totalcredit>totaldebit)
{
	document.getElementById('balanceprojectcredit').value=parseFloat(Math.round((totalcredit-totaldebit) * 100) / 100).toFixed(2);
	document.getElementById('balanceprojectdebit').value="0.00";
}
else if(totalcredit<totaldebit)
{
	document.getElementById('balanceprojectdebit').value=parseFloat(Math.round((totaldebit-totalcredit) * 100) / 100).toFixed(2);
	document.getElementById('balanceprojectcredit').value="0.00";
}
else
{
	document.getElementById('balanceprojectcredit').value="0.00";
	document.getElementById('balanceprojectdebit').value=parseFloat(Math.round((totaldebit-totalcredit) * 100) / 100).toFixed(2);
}

}
}
function usercalc1()
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
var totaluserval=0;
var totaluserdiscountval=0;
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
var usernames = document.getElementsByName('username[]');
var vats = document.getElementsByName('vat[]');
var uservalues = document.getElementsByName('uservalue[]');
for (var i = 0; i < usernames.length; i++) 
{
var vat = parseFloat(vats[i].value);
if(!isNaN(vat))
{
var uservalue = parseFloat(uservalues[i].value);
var uservat=(uservalue*(1+(vat/100)));
if(vat==5)
{
cgst25amt+=(uservalue*(1+(2.5/100)))-uservalue;
sgst25amt+=(uservalue*(1+(2.5/100)))-uservalue;
gst25amt+=(uservalue*(1+(5/100)))-uservalue;
tax25+=uservalue;
}
if(vat==12)
{
cgst6amt+=(uservalue*(1+(6/100)))-uservalue;
sgst6amt+=(uservalue*(1+(6/100)))-uservalue;
gst6amt+=(uservalue*(1+(12/100)))-uservalue;
tax6+=uservalue;
}
if(vat==18)
{
cgst9amt+=(uservalue*(1+(9/100)))-uservalue;
sgst9amt+=(uservalue*(1+(9/100)))-uservalue;
gst9amt+=(uservalue*(1+(18/100)))-uservalue;
tax9+=uservalue;
}
if(vat==28)
{
cgst14amt+=(uservalue*(1+(14/100)))-uservalue;
sgst14amt+=(uservalue*(1+(14/100)))-uservalue;
gst14amt+=(uservalue*(1+(28/100)))-uservalue;
tax14+=uservalue;
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
function usercalcround()
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
usercalc1();
}
}
</script>
</body>
</html>