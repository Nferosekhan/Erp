<?php
include('lcheck.php');
if($permissionbooks=='0')
{
  header('Location: dashboard.php');
}
$sqlismainaccessexpenses=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Expences' order by id  asc");
$infomainaccessexpenses=mysqli_fetch_array($sqlismainaccessexpenses);
if ($infomainaccessexpenses['groupaccess']=='0') {
header('Location: preference_billing.php');
}
$sql="SELECT * FROM paircontrols WHERE id='$companymainid';";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
if (isset($_POST['submit'])) {
$sqlismodules=mysqli_query($con, "select * from pairmodules where grouptype='Expences' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['grouptype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  $modcolumncolchanges='';
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
                $modcolumncol=$coltypemod."col";
                $modcolumncol=mysqli_real_escape_string($con, (isset($_POST[$modcolumncol]))?$newmoduleskey:' ');
                if($modcolumncolchanges!='')
                {
                    $modcolumncolchanges.=','.$modcolumncol;
                }
                else
                {
                    $modcolumncolchanges.=$modcolumncol;
                }

              }
                $sqlmainaccess = "update pairmainaccess set modulecolumns='$modcolumncolchanges' where (userid='$companymainid' or createdid='$companymainid') and grouptype='Expences'"; 
                $sqlmainaccessuppro = mysqli_query($con, $sqlmainaccess);
              header('Location:preference_billing.php?remarks=Updated Successfully');
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
      $sqlismainaccessexpenses=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Expences' order by id  asc");
      $infomainaccessexpenses=mysqli_fetch_array($sqlismainaccessexpenses);
?>
    <title>
        Preference &gt; <?= $row['books'] ?> &gt; <?= $infomainaccessexpenses['groupname'] ?>
    </title>
<style type="text/css">
        table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
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
.table td, .table th {
    white-space: normal;
}
    [aria-expanded="false"]>.expanded,
    [aria-expanded="true"]>.collapsed {
        display: none;
    }

    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}
.alignright
{
    text-align: right;
}
    @media screen and (min-device-width: 260px) and (max-device-width: 575px) { 
    /* STYLES HERE */

    /* STYLES HERE */
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}
.alignright{
    text-align: center;
    
}
.mobliview
{
    text-align: center;
    
}
}
@media screen and (min-device-width: 366px) and (max-device-width: 575px) { 
.row1
{
    width: auto;
}
}
</style>

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
        <?php
      $sqlismainaccessexpenses=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Expences' order by id  asc");
      $infomainaccessexpenses=mysqli_fetch_array($sqlismainaccessexpenses);
        ?>
             <div class="card card-body p-3 mt-5" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;max-width: 1650px;height: auto;z-index: 0;">
                <form action="" method="post" style="position: relative;top: -27px;margin-bottom: -78px;">
    <p class="mb-3" style="font-size: 14.6px;color: black;position: relative;top: 15px;"><a href="preference.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Preference </a><span>&gt;</span><a href="preference_billing.php" style="color: #1878F1"> <!-- <i class="fa fa-book"></i> -->
                                    <?= $row['books'] ?> </a> &gt; <!-- <i class="fa fa-shopping-basket"></i>  --><?= $infomainaccessexpenses['groupname'] ?></p>
                                    <div class="mt-3" style="border-top: 1px solid #dee2e6;position: relative;top: 0px;"></div>
                                    <p class="mb-2" style="font-size: 20px;color: black;position: relative;top: 12px;"><?= $infomainaccessexpenses['groupname'] ?></p>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
<button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading"><?= $infomainaccessexpenses['groupname'] ?> 
</a>  
             
                </div></button>
 </div>
<div class="tab-content" id="nav-tabContent" style="position:relative;top: -18px;">
  <div class="tab-pane fade show active mt-4 p-3" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="expensefield">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#expensefields"
                                                    aria-expanded="true" aria-controls="expensefields">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the fields you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                        </div>
                                            <div id="expensefields" class="accordion-collapse collapse show"
                                                aria-labelledby="expensefield">
                                                <div class="accordion-body text-sm">
</div>
</div>
</div>
<div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="expensecolumn">
                                                <button class="accordion-button" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#expensecolumns"
                                                    aria-expanded="true" aria-controls="expensecolumns">
                                                    <div class="customcont-header ml-0 mb-1 mt-3">
                                                        <a class="customcont-heading" style="font-size: 18px;"> Select the columns you would like to enable</a>
                                                    </div>
                                                </button>
                                            </h5>
                                        </div>
                                            <div id="expensecolumns" class="accordion-collapse collapse show"
                                                aria-labelledby="expensecolumn">
                                                <div class="accordion-body text-sm">
                                                  <?php

$newans=array();
$newans1=array();
$newans2=array();

$sqlismainaccess=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='Expences' order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['grouptype']);
    $ans = $infomainaccess[24];
    $newans = explode(',',$ans);
  }

$newmodules=array();

$sqlismodules=mysqli_query($con, "select * from pairmodules where grouptype='Expences' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['grouptype']);
    $ansmodules = $infomodules[4];
    $newmodules = explode(',',$ansmodules);
  }
  foreach ($newmodules as $newmoduleskey) {
                $coltypemod = preg_replace('/\s+/', '',$newmoduleskey);
?>
           <div class="row" style=" border-top:1.5px solid #eee; border-bottom:1.5px solid #eee; padding:5px 0">
            <div class="col-lg-2">
                <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="<?= $coltypemod; ?>col" id="<?= $coltypemod; ?>col" <?= ((in_array($newmoduleskey, $newans)))?'checked':'' ?> <?= (($newmoduleskey=='Name'))?'disabled checked':'' ?>>
                        <label class="custom-control-label custom-label" for="<?= $coltypemod; ?>col" style="font-size: 14.6px;color:royalblue !important;"> <?= $newmoduleskey; ?></label>
                      </div>
            </div>
            <div class="col-lg-10">
                    
            
                  
            </div>
            
            
            </div>
            <?php
          }
          ?>
</div>
</div>
</div>
            <div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</div>
</div> <!-- tab -->
</form>
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
        $("#invoicesuffix").autocomplete({
            source: 'invoicesuffixsearch.php',
            select: function(event, ui) {
                $("#invoicesuffix").val(ui.item.invoicesuffix);
                $("#city").val(ui.item.city);
                $("#district").val(ui.item.district);
                $("#state").val(ui.item.state);
                $("#pincode").val(ui.item.pincode);
            },
            minLength: 2
        });
        $("#email").autocomplete({
            source: 'franchisesearch.php?type=email',
        });
    });
    </script>
    <script>
    var buttons = document.querySelectorAll('.arlina-button');

    Array.prototype.slice.call(buttons).forEach(function(button) {

        var resetTimeout;

        button.addEventListener('click', function() {

            if (typeof button.getAttribute('data-loading') === 'string') {
                button.removeAttribute('data-loading');
            } else {
                button.setAttribute('data-loading', '');
            }

            clearTimeout(resetTimeout);
            resetTimeout = setTimeout(function() {
                button.removeAttribute('data-loading');
            }, 1000);

        }, false);

    });
    </script>






    <style>
    /*************************************
 * BUTTON BASE
 */

    .arlina-button {
        position: relative;
        border: 0;
        cursor: pointer;
        outline: 0;
        -webkit-appearance: none;
        -webkit-font-smoothing: antialiased;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    .arlina-button[data-loading] {
        cursor: default;
    }


    /* Blue button */
    .arlina-button.blue {
        background: #53b5e6;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.blue:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #58c2f8;
    }

    .arlina-button.blue[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }

    /* Orange button */
    .arlina-button.orange {
        background: #ea8557;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.orange:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #ffa96c;
    }

    .arlina-button.orange[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }


    /* Spinner animation */
    .arlina-button .spinner {
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        margin-top: -10px;
        opacity: 0;

        background-image: url("./assets/img/spin.gif");
        background-repeat: no-repeat;

        /* background-image: url(http://2.bp.blogspot.com/-GPSLDnKmX3s/VSvPkXsCHvI/AAAAAAAACOg/Xmm2kIDu-CU/s1600/spin.gif); */


    }


    /*************************************
 * EASING
 */

    .arlina-button,
    .arlina-button .spinner,
    .arlina-button .label {
        -webkit-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -moz-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -ms-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
    }

    .arlina-button.zoom-in,
    .arlina-button.zoom-in .spinner,
    .arlina-button.zoom-in .label,
    .arlina-button.zoom-out,
    .arlina-button.zoom-out .spinner,
    .arlina-button.zoom-out .label {
        -webkit-transition: 0.3s ease all;
        -moz-transition: 0.3s ease all;
        -ms-transition: 0.3s ease all;
        transition: 0.3s ease all;
    }



    /*************************************
 * EXPAND RIGHT
 */

    .arlina-button.expand-left .spinner {
        left: 0.8em;
    }

    .arlina-button.expand-left[data-loading] {
        padding-left: 40px;
    }

    .arlina-button.expand-left[data-loading] .spinner {
        opacity: 1;
    }
    </style>
</body>

</html>