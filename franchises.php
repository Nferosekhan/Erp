<?php
include('lcheck.php');
if($permissionfranchise=='0')
{
	header('Location: dashboard.php');
}
$sql="SELECT * FROM paircontrols WHERE id='$companymainid'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
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
    <?= $row['franchiseandroles'] ?> & Roles
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
	 
<div style="max-width: 1650px;">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                  <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"><i class="fa fa-building"></i> <?= $row['franchiseandroles'] ?> & Roles</p>
                  <?php
        if($permissionfranchise!=1){
          ?>
			 <div align="right" class=" p-2" style="margin-top: -60px;">
        
			 <a href="franchiseadd.php" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $row['franchiseandroles'] ?></span></p></a>
       
			 <br>
			 </div>
       <?php
     }
      ?>
              <div class="table-responsive p-0">
                <table class="table table-bordered align-items-center mb-0" style="table-layout: fixed;">
                  <thead>
                    <tr>
                      <td class="text-uppercase" style="width:40px;"><span style="font-size:13px;">Display Name</span></td>
					  <td class="text-uppercase" style="width:60px;"><span style="font-size:13px;">Name</span></td>
                      <td class="text-uppercase" style="width:45px;"><span style="font-size:13px;">Street</span></td>
                      <td class="text-uppercase" style="width:25px;"><span style="font-size:13px;">City</span></td>
                      <td class="text-uppercase" style="width:25px;"><span style="font-size:13px;">Pincode</span></td>
                      <td class="text-uppercase" style="width:30px;"><span style="font-size:13px;">State</span></td>
                      <!-- <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;">Country</span></td> -->
                      <td class="text-uppercase" style="width:33px;"><span style="font-size:13px;">Phone</span></td>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;">Email</span></td>
					  <td class="text-uppercase" style="width:23px;"><span style="font-size:13px;">Status</span></td>
					  
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $count=1;
				  $sqli=mysqli_query($con, "select * from pairfranchises where createdid='$companymainid' order by id desc");
				  while($info=mysqli_fetch_array($sqli))
				  {
					  ?>
 <tr onclick="window.open('franchiseview.php?id=<?=$info['id']?>', '_self')">
<td data-label="Display Name" class="" style="color:#1878F1">
  <?=$info['displayname']?> &nbsp;
</td>
<td data-label="Name" class="" style="color:#1878F1">
  <?=$info['franchisename']?> &nbsp;
</td>
<td data-label="Street" class="">
  <?=$info['street']?> &nbsp;
</td>
<td data-label="City" class="">
  <?=$info['city']?> &nbsp;
</td>
<td data-label="Pincode" class="">
  <?=$info['pincode']?> &nbsp;
</td>
<td data-label="State" class="">
  <?=$info['state']?> &nbsp;
</td>
<!-- <td data-label="Country" class=""><span style="font-size:13px;display: block;height: 18px;"><?=$info['country']?> &nbsp;</span> -->
</td>
<td data-label="Phone" class="">
  <?=$info['mobile']?> &nbsp;
</td>
<td data-label="Email" class="">
  <?=$info['email']?> &nbsp;
</td>
<td data-label="Status" class="">
<?php
if($info['astatus']=='0')
{
?>
<span class="badge badge-sm mybadge" style="text-transform:none; font-weight:normal">Active</span>
<?php						
}
else
{
?>
<span class="badge badge-sm mybadge bg-danger" style="text-transform:none; font-weight:normal">Inactive</span>
<?php
}
?>
</td>
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