<?php
include('lcheck.php');
if($permissionuser=='0')
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
    <?= $row['userandroles'] ?> & Roles
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
      
<div style="max-width: 1650px;">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                  <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"><i class="fa fa-users"></i> <?= $row['userandroles'] ?> & Roles</p>
                  <?php
        if($permissionuser!=1){
          ?>
			 <div align="right" class=" p-2" style="margin-top: -60px;">
        
			 <a href="useradd.php" class="btn btn-sm btn-custom add"  style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $row['userandroles'] ?></span></p></a>
       
			 <br>
			 </div>
       <?php
     }
     ?>
              <div class="table-responsive p-0">
                <table class="table table-bordered align-items-center mb-0" style="table-layout: fixed;">
                  <thead>
                    <tr>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;">First Name</span></td>
                       <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;">Last Name</span></td>
                      <td class="text-uppercase" style="width:30px;"><span style="font-size:13px;">Designation</span></td>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;">Email</span></td>
                      <td class="text-uppercase" style="width:40px;"><span style="font-size:13px;">Username</span></td>
                      <td class="text-uppercase" style="width:30px;"><span style="font-size:13px;">Mobile Phone</span></td>
                      <td class="text-uppercase" style="width:10px;"><span style="font-size:13px;">Status</span></td>
					  
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sqli=mysqli_query($con, "select * from paircontrols where id='$companymainid'");
                    $results=mysqli_fetch_array($sqli);
                    ?>
                    <tr style="background-color:#f7f7f9 !important;">
                      <td data-label="First Name"><span><?= $results['firstname'] ?></span> (Admin)</td>
                      <td data-label="Last Name"><?= $results['lastname'] ?></td>
                      <td data-label="Designation"><?= $results['designation'] ?></td>
                      <td data-label="Email"><?= $results['email'] ?></td>
                      <td data-label="Username"><?= $results['usernewname'] ?></td>
                      <td data-label="Mobile Phone"><?= $results['mobile'] ?></td>
                      <td data-label="Status"><?php
            if($results['is_active']=='0')
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
            ?></td>
                    </tr>
				  <?php
				  $count=1;
				  $sqli=mysqli_query($con, "select * from paircontrols where role='USER' AND createdid='$companymainid' order by id desc");
				  while($info=mysqli_fetch_array($sqli))
				  {
					  ?>
                    <tr onclick="window.open('userview.php?id=<?=$info['id']?>', '_self')">
									
						<td data-label="First Name" class="" style="color:#1878F1">
                       <?=$info['firstname']?>
                         </td>
					  <td data-label="Last Name" class="">
                        <?=$info['lastname']?>
                      </td>
					  <td data-label="Designation" class="">
                        <?=$info['designation']?>
                      </td>
					  <td data-label="Email" class="">
                       <?=$info['email']?>
                      </td>
                      <td data-label="Username" class="">
                       <?=$info['usernewname']?>
                      </td>
                      <td data-label="Mobile Phone" class="">
                       <?=$info['mobile']?>
                      </td>
					   <td data-label="Status" class="">
					  <?php
					  if($info['is_active']=='0')
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