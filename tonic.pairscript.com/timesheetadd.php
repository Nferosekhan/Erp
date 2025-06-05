<?php
include('lcheck.php');
// if (isset($_POST['storeaccess'])) {
// 	$store=mysqli_real_escape_string($con,$_POST['storeaccess']);
// 	$sql=mysqli_query($con,"update into paircontrols set storeaccess='$store' where createdby='".$_SESSION['unqwerty']."'");
// }
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Timesheet' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
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
        p:hover{
            background-color: green;
        }
        .select-btn, .options li{
            display: flex;
            cursor: pointer;
            align-items: center;
        }
    </style>
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
    <div style="max-width: 1650px;">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3">
                                <?php
$sqlismainaccessuser=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Timesheet' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
    <div class="alert alert-danger mt-2 text-white">Sorry! Time Sheet Generation is Allowed for this Franchise</div>
    <?php
}
else
{
?>
                 <div class="customcont-header ml-0 mb-1" style="height:41px;">
	<a class="customcont-heading customcont-heading-active" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Time Sheet Add</a>
	</div>
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
</body>

</html>