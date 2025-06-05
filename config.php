<?php
include('lcheck.php');
if($language=='0'&&$time=='0'&&$currency=='0'&&$taxes=='0')
{
  header('Location: dashboard.php');
}
$sql="SELECT * FROM paircontrols where id='$companymainid'";
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
        Configuration
    </title>
    <style>
    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table caption {
            font-size: 1.3em;
        }

        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: 1em;
        }


        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8em;
            text-align: right;
        }

        table td::before {
            /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
        }
    }
    </style>
    <style>
    body {
        font-family: 'Myriad Set Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }



    .sidenav a {
        padding: 6px 8px 6px 16px;
        text-decoration: none;
        font-size: 25px;
        color: #2196F3;
        display: block;
    }

    .btndesign {
        padding: 10px;
    }

    .btndesign:hover {
        color: black;
        background-color: #E7E9EB;
        border-radius: 10px;

    }

    .imgpaddingleft {
        padding-left: 5px;
    }


    .spandesign {
        font-size: large;
        padding-left: 5px;
        padding-right: 15px
    }
    </style>

    <head>
        <?php
include('externals.php');
?>
        <title>
            Dashboard - Dmedia
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
                            <div class="card-body p-3"
                                style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-3"
                                    style="font-size: 20px;font-family: 'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;color: black;margin-top: -9px;">
                                    <i class="fa fa-wrench"></i> Configuration</p>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne">
                                    <div class="accordion-body text-sm">

                                        <div class="row justify-content-center">
                                            <div class="col-lg-4">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">

                                                        <?php
         if($language=='1')
         {
        ?>
                                                        <a href="configuration_language_view.php" type="button"
                                                            class="btndesign <?=($current_file_name=='configuration_language_view.php')?'active':''?>">
                                                            <i class="fa fa-language"
                                                                style="font-size: 18px;color: black; width:22px"></i>
                                                            <span class="spandesign"
                                                                style="font-size: 18px;color: black;margin-left: -3px;">Language</span>
                                                        </a>
                                                    </div>
                                                    <?php
        }
        ?>
                                                    <?php
         if($time=='1')
         {
        ?>
                                                    <div class="col-sm-12">
                                                        <a href="configuration_country_view.php" type="button"
                                                            class="btndesign">
                                                            <i class="fa fa-globe"
                                                                style="font-size: 18px;color: black; width:21px;margin-left:-3px;padding-left: 5px;"></i>


                                                            <span class="spandesign"
                                                                style="font-size: 18px;color: black;margin-left: 1px;">Country
                                                                & Time Zone</span>
                                                        </a>
                                                    </div>
                                                    <?php
        }
        ?>

                                                    <?php
         if($currency=='1')
         {
        ?>
                                                    <div class="col-sm-12">
                                                        <a href="configuration_currency_list.php" type="button"
                                                            class="btndesign">
                                                            <i class="fa fa-money"
                                                                style="font-size: 18px;color: black; width:20px"></i>

                                                            <span class="spandesign"
                                                                style="font-size: 18px;color: black;">Currencies</span>
                                                        </a>
                                                    </div>
                                                    <?php
        }
        ?>
        <?php
         if($taxes=='1')
         {
        ?>
         <div class="col-sm-12">
                                                        <a href="taxs.php" type="button"
                                                            class="btndesign">
                                                            <i class="fa fa-line-chart"
                                                                style="font-size: 18px;color: black; width:20px;padding-left:2px;"></i>

                                                            <span class="spandesign"
                                                                style="font-size: 18px;color: black;">Taxes</span>
                                                        </a>
                                                    </div>
                                                    <?php
        }
        ?>
                                                    <div class="col-sm-12" style="display: none;">
                                                        <a href="preference_job_call.php" type="button"
                                                            class="btndesign">
                                                            <i class="fa fa-circle-o-notch"
                                                                style="font-size: 18px; width:17px;color: black;"></i>

                                                            <span class="spandesign">Job or Calls</span>
                                                        </a>
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