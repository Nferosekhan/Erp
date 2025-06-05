<?php
include('lcheck.php');
if($userrole!='SUPER ADMIN')
{
	header('Location: dashboard.php');
}
if(isset($_POST['submit']))
{
$id=mysqli_real_escape_string($con, $_POST['id']);	
$unitname=mysqli_real_escape_string($con, $_POST['unitname']);
$uqc=mysqli_real_escape_string($con, $_POST['uqc']);
$msg = "";
$msg_class = "";
	if(($unitname!=""))
	{		
        $sqlcon = "SELECT id From pairunits WHERE id = '{$id}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon > 0) 
		{	
			$sqlup = "update pairunits set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', uqc='$uqc', unitname='$unitname' where id='$id'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				$tid=$id;
				mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Update A Unit Information', '{$tid}')");
				header("Location: units.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: units.php?error=This record is Already Found! Kindly check in All Units List");
			}
	}
	else
			{
				header("Location: units.php?error=Error Data");
			}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include('externals.php');
?>
  <title>
    Edit Unit - Dmedia
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
     <div class="container-fluid py-4 bg-body">
          <h6 class="font-weight-bolder mb-3">Edit Unit</h6>
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
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4">
             <div class="card-body p-3">
<?php
if(isset($_GET['id']))
{
$count=1;
$id=mysqli_real_escape_string($con, $_GET['id']);
$sqli=mysqli_query($con, "select * from pairunits where id='$id' order by uqc asc");
if(mysqli_num_rows($sqli)>0)
{
$info=mysqli_fetch_array($sqli);
?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<input type="hidden" name="id" id="id" value="<?=$info['id']?>">
<div class="row">
<div class="col-lg-6">
  <div class="form-group">
    <label for="unitname">Unit Name</label>
    <input type="text" class="form-control  form-control-sm" id="unitname" name="unitname" value="<?=$info['unitname']?>">
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="uqc">UQC</label>
    <input type="text" class="form-control  form-control-sm" id="uqc" name="uqc" required value="<?=$info['uqc']?>">
  </div>
</div>
</div>
	
  <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Submit">
</form>
<?php
}
}
else
{
	?>
	<div class="alert alert-danger">No Results Found</div>
	<?php
	
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

<script type="text/javascript">
  $(function() {
     $( "#unitname" ).autocomplete({
       source: 'unitsearch.php?type=unitname',
     });
  });
</script>
</body>

</html>