<?php
include('lcheck.php');
if(isset($_POST['submit']))
{
$gstno=mysqli_real_escape_string($con, $_POST['gstno']);
$gstregisteredon=mysqli_real_escape_string($con, $_POST['gstregisteredon']);
$msg = "";
$msg_class = "";
	if(($gstno!=""))
	{		
        $sqlcon = "select * from pairgst where companymainid='$companymainid' order by gstno asc";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon > 0) 
		{	
			$sqlup = "update pairgst set companymainid='$companymainid', createdon='$times', createdby='".$_SESSION["unqwerty"]."', gstno='$gstno', gstregisteredon='$gstregisteredon' where companymainid='$companymainid'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Update their GST Information', '{$id}')");
				header("Location: gstsettings.php?remarks=Updated Successfully");
			} 
	    }
		else
		{
			$sqlup = "insert into pairgst set companymainid='$companymainid', createdon='$times', createdby='".$_SESSION["unqwerty"]."', gstno='$gstno', gstregisteredon='$gstregisteredon'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Added their GST Information', '{$id}')");
				header("Location: gstsettings.php?remarks=Added Successfully");
			}
		}
	}
	else
			{
				header("Location: gstsettings.php?error=Error Data");
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
    GST Settings - Dmedia
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
          <h6 class="font-weight-bolder mb-3">GST Settings</h6>
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
if(isset($companymainid))
{
$count=1;
$sqli=mysqli_query($con, "select * from pairgst where companymainid='$companymainid' order by gstno asc");
$info=mysqli_fetch_array($sqli);
?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<div class="row">
<div class="col-lg-6">
  <div class="form-group">
    <label for="gstno">GSTIN</label>
    <input type="text" class="form-control  form-control-sm" id="gstno" name="gstno" maxlength="15" value="<?=$info['gstno']?>" required>
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label for="gstregisteredon">GST Registered On</label>
    <input type="date" class="form-control  form-control-sm" id="gstregisteredon" name="gstregisteredon" required value="<?=$info['gstregisteredon']?>">
  </div>
</div>
</div>

  <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Submit">
</form>


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
     $( "#lastname" ).autocomplete({
       source: 'productsearch.php?type=lastname',
     });
	 $( "#dob" ).autocomplete({
       source: 'productsearch.php?type=dob',
     });
  });
</script>
</body>

</html>