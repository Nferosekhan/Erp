<?php
include('lcheck.php');
if($permissionpreference=='0')
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
        Preference &gt; <?= $row['franchiseandroles'] ?>
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
     <div class="alert alert-dismissible" style="position: relative;top: 32px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -32px;border-radius: 0px !important;">
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
      <div class="alert alert-dismissible" style="position: relative;top: 32px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -32px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
    <i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></p>
  </div>
     <?php
     }
     ?>
 <div class="card card-body mt-5" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;max-width: 1650px;">
    <p class="mb-0" style="font-size: 14.6px;color: black;position: relative;top: -12px;border-bottom: 1px solid #dee2e6;"><a href="preference.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Preference</a> <span>&gt;</span> <?= $row['franchiseandroles'] ?></p>
    <p class="mb-0" style="font-size: 20px;color: black;"><i class="fa fa-user"></i>
                                    <?= $row['franchiseandroles'] ?> & Roles</p>
 <div class="nav nav-tabs" id="nav-tab" role="tablist">
<button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">General</a>  
             
                </div></button>
    <button class="nav-link" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-history" aria-selected="false">
        <div class="customcont-header ml-0">
    
        <a class="customcont-heading">History</a>   
             
                </div>
        </button>
 </div>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
 <div class="card card-body mt-3 totedits" style="width: max-content;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;box-shadow: 0 1px 5px 0 rgb(0 0 0 / 20%);">
                                                                <div class="row row1">
                                                                <div class="col-sm-2  mobliview" style="width:max-content;"> <i class="fa fa-pencil-square-o ico" style="margin-top: 15px;margin-left: 10px;"></i>
                                                                 </div>
                                                                <div class="col-sm-6 mobliview" style="width:max-content;">
                                                                <p class="card-subtitle mb-2 text-muted" style="margin-top: 0px;font-size: 16px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;color: black;">Label</p>
                                                                    <p class="card-text" style="margin-top:-10px;color: grey;font-size: 14px;font-family: 'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['franchiseandroles']
                                                                ?> & Roles</p>

                                                                </div>
                                                                <div class="col-sm-4 alignright edbtn" style="cursor: pointer;width:max-content;margin-left: 30px;" > 
                                                               
                                                               
                                                                <!-- <a class="btn btn-primary btn-sm btn-custom-grey"  style=" margin-top: 5px; margin-bottom: 0px;margin-left: 0px;text-align:right;cursor: pointer;" href="preference_franchises_roles_label.php"><span style="color: black;font-size: 15px;">&#128393;</span> Edit</a> -->
                                                                <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_franchises_roles_label.php" style="margin-top: 6px;margin-bottom:0rem; margin-right:0px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                               
                                                                </div>
                                                                </div>


                                                                   
                                                                </div>
                                                                <div class="mt-3" style="border-top: 1px solid #dee2e6;">
                                                                <div class="mt-3 btn-custom-grey">
                                                                <a href="preference-franchise-roles.php" style="font-size:18px;padding: 20px 0px 14px;width: 61.25;height: 55.5;color: black;"><?= $row['franchiseandroles'] ?> & Roles</a>
                                                                </div>
                                                            </div>
    </div>
    <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
        <div class="table-responsive m-3">
      <table class="table table-bordered" style="table-layout: fixed;">
      <thead>
      <tr>
      <td style="width: 190px;">DATE</td>
      <td>DETAILS</td>
      </tr>
      </thead>
      <tbody>
        <?php
        $pairuse="SELECT * FROM pairusehistory WHERE createdby='".$_SESSION["unqwerty"]."' and usetype='Franch' order by createdon desc";
        $finally=mysqli_query($con,$pairuse);
        while ($use=mysqli_fetch_array($finally))
         {
        ?>
       <tr>
      <td data-label="DATE" style="color:grey"><?=date('d/m/Y h:i:s a', strtotime($use['createdon']))?></td>
      <td data-label="DETAILS"><?=$use['useremarks']?> <br> <span>Changed By</span> <span  style="color:grey"><?=$use['createdby']?></span></td>
    </tr>
        <?php
        }
        ?>
      </tbody>
      </table>
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