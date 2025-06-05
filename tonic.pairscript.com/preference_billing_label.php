<?php
include('lcheck.php');
if($permissionbooks=='0')
{
  header('Location: dashboard.php');
}
$sql="SELECT * FROM paircontrols where  username='".$_SESSION["unqwerty"]."' OR usernewname='".$_SESSION["unqwerty"]."'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$oldbooks=$row['books'];
if(isset($_POST['submit']))
{
$books=mysqli_real_escape_string($con, $_POST['labelname']);

$msg = "";
$msg_class = "";
    if(($books!=$oldbooks))
    {       
        $sql="UPDATE paircontrols set books='$books' WHERE createdid='$companymainid' OR id='$companymainid'";
        $result=mysqli_query($con,$sql);
        if(!$result){
            die("SQL query failed: " . mysqli_error($con));
         }
         else{
            $ch.='Label Name  <span style="color:green;" id="prohisfromtospan">( From '.$oldbooks.' To '.$books.' ) </span>';
            $sqluse="insert into pairusehistory set usetype='Books', createdon='$times',createdby='".$_SESSION["unqwerty"]."', useid='$companymainid', useremarks='".$ch."',booklabelchanges='$books'";
            $final=mysqli_query($con,$sqluse);
        header("Location:preference_billing.php?remarks=Added Successfully");
         }
    }
    else
            {
                header("Location: preference_billing.php?remarks=Added Successfully");
            }
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
        Preference &gt; <?= $row['books'] ?> &gt; Label
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
                        <div class="card mb-5 mt-5">
                            <div class="card-body pb-5 pt-2" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p style="color:black;font-size: 14.6px;border-bottom: 1px solid #dee2e6;" class="mb-0"><a href="preference.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Preference </a><span>&gt;</span><a href="preference_billing.php" style="color: #1878F1"><!-- <i class="fa fa-book"></i> -->
                                    <?= $row['books'] ?> </a> <span>&gt;</span> Label  <!-- <i class="fa fa-file-import"></i> --></p>
                                <form action="" onsubmit="return checkvalidate()" method="post"
                                    enctype="multipart/form-data" class="form-horizontal" role="form">


                                    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" style="position: relative;top: 0px;">
                                                <div class="accordion-body text-sm">

                                                <p style="padding-left: 20px;font-size: 18px;"> <i class='fas fa-pencil-alt'></i> <span style="color:black;">Edit Label</span></p>
                                                   
                                                <br><div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="franchisename"
                                                                        class="custom-label"><span
                                                                            class="text-danger">Label Name
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="labelname" name="labelname"
                                                                        placeholder="(Example: Billing or Books)" value="<?=$row['books'] ?>"
                                                                        required style="color:black;">
                                                                        <br>

                                                                        <div class="col-lg-6" style="margin-bottom: -90px;">
                                                                        <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button> <a
                                                                    class="btn btn-primary btn-sm btn-custom-grey"
                                                                    href="preference_billing.php">Cancel</a>
                                                            </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>

                                                        
                                                    </div>


                                                </div>
                                            </div>
                                        </div>




                                    </div>


                            </div>
                        </div>
                    </div>





                    </form>


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