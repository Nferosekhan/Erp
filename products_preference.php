<?php
include('lcheck.php');
if($permissionbooks=='0')
{
  header('Location: dashboard.php');
}
$sql="SELECT * FROM paircontrols WHERE id='$companymainid';";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
if (isset($_POST['submit'])) {
    // $headch=mysqli_real_escape_string($con,$_POST['heading']);
    $store=mysqli_real_escape_string($con,$_POST['storeaccess']);
    $sqlup=mysqli_query($con,"update paircontrols set storeaccess='$store' where username='".$_SESSION['unqwerty']."' or usernewname='".$_SESSION['unqwerty']."'");
    // $permissionitems=mysqli_real_escape_string($con, (isset($_POST['items']))?'1':'0');
    // $permissionproducts=mysqli_real_escape_string($con, (isset($_POST['product']))?'1':'0');
    // $sqlup=mysqli_query($con,"update paircontrols set permissionitems='$permissionitems',permissionproducts='$permissionproducts' where username='".$_SESSION['unqwerty']."' or usernewname='".$_SESSION['unqwerty']."'");
    // $ch='';
    //             if($permissionitems!=$oldpermissionitems)
    //             {
    //                 if($ch!='')
    //                 {
    //                     $ch.=', Items';
    //                 }
    //                 else
    //                 {
    //                     $ch.='Items';
    //                 }  
    //                 $itemch=$permissionitems;                 
    //             }
    //             if($permissionproducts!=$oldpermissionproducts)
    //             {
    //                 if($ch!='')
    //                 {
    //                     $ch.=', products';
    //                 }
    //                 else
    //                 {
    //                     $ch.='products';
    //                 }  
    //                 $productch=$permissionproducts;                 
    //             }
    //             if($ch!='')
    //             {
    //             $sqluse=mysqli_query($con, "insert into pairusehistory set usetype='FRANCH', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$companymainid', useremarks='".$ch." Changed by',itemchanges='$itemch',productchanges='$productch' ");
    //             }
    header('Location:preference_franchisee_roles.php');
    // if (isset($_POST['storeaccess'])) {
    // $sql=mysqli_query($con,"update into paircontrols set  where createdby='".$_SESSION['unqwerty']."'");
// }
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
        New Billing - Dmedia
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
    </style>
    <style>
   

    [aria-expanded="false"]>.expanded,
    [aria-expanded="true"]>.collapsed {
        display: none;
    }

    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }
    </style>
    <style>
    .accordion-button:not(.collapsed)::after {
        background-image: url();
        margin-left: -20px;
        margin-top: -5px;
    }

    .accordion-button:not(.collapsed) a.customcont-heading {
        border-bottom: 1.5px solid #000000;
        color: #000000;
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

    .heading:focus{
        border: 1px solid #3f94eb !important;
        outline: none;
        box-shadow: none !important;
        border-radius: 0px !important;
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
             <div class="card card-body mt-5" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;max-width: 1650px;">
                <form action="" method="post" style="position: relative;top: -12px;">
    <p class="mb-3" style="font-size: 14.6px;color: black;"><a href="preference.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Preference </a><span>&gt;</span><a href="preference_franchise_roles.php" style="color: #1878F1"> <!-- <i class="fa fa-book"></i> -->
                                    <?= $row['franchiseandroles'] ?> </a> &gt; <!-- <a href="in_item_preference.php" style="color: #1878F1"> <i class="fa fa-shopping-basket"></i>
                                    Items </a> &gt; --> <!-- <i class="fa fa-shopping-basket"></i>  --><!-- <input type="text" name="heading" value="" class="heading" style="border: 1px dashed lightgrey;width: 15%;"> --> <?= $row['franchiseandroles'] ?></p>
                                    <div class="mt-3" style="border-top: 1px solid #dee2e6;position: relative;top: -15px;"></div>
                                    <p class="mb-3" style="font-size: 20px;color: black;position: relative;top: -3px;"><i class="fa fa-user"></i> <?= $row['franchiseandroles'] ?></p>
    <!-- <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="items" id="items" checked>
                        <label class="custom-control-label custom-label" for="items"> 1 Products</label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="producto" id="producto" checked>
                        <label class="custom-control-label custom-label" for="producto"> 2 Products</label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="productt" id="productt" checked>
                        <label class="custom-control-label custom-label" for="productt"> 2 Products</label>
                      </div> -->
                      <div style="padding-right: 18px;padding-left: 18px;">
                      <div class="row" style=" border-top:2px solid #eee; border-bottom:2px solid #eee; padding:5px 0">
                      <div class="col-lg-3">
            <label class="custom-label" style="font-size: 14.6px;color:royalblue;">Franchise Store Permissions</label>
            </div>
            <div class="col-lg-9">
                <?php
           $sqlquery=mysqli_query($con,"select * from paircontrols where username='".$_SESSION['unqwerty']."' or usernewname='".$_SESSION['unqwerty']."'");
           $infoaccess=mysqli_fetch_array($sqlquery);
                ?>
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="storeaccess" id="storenoaccess" value="0" <?= ($infoaccess['storeaccess']==0)?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="storenoaccess">No Access</label>
                      </div>
                      
                      </div>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="storeaccess" id="storeaccess" value="1" <?= ($infoaccess['storeaccess']==1)?'checked':'' ?>>
                        <label class="custom-control-label custom-label" for="storeaccess">Full Access</label>
                      </div>
                      
                      </div>
                    </div>
            </div>
            </div>
        </div>
                      <div class="row justify-content-center" style="margin-bottom: -14px;">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="in_item_preference.php">Cancel</a>
    </div>
</div>
</form>
 <!-- <div class="nav nav-tabs" id="nav-tab" role="tablist">
<button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">General</a>  
             
                </div></button> -->
   <!--  <button class="nav-link" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-history" aria-selected="false">
        <div class="customcont-header ml-0">
    
        <a class="customcont-heading">History</a>   
             
                </div>
        </button> -->
 <!-- </div>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"> -->
 <!-- <div class="card card-body mt-3" style="width: 30%;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;box-shadow: 0 1px 5px 0 rgb(0 0 0 / 20%);">
                                                                <div class="row row1">
                                                                <div class="col-sm-2  mobliview"> <i class="fa fa-pencil-square-o" style="margin-top: 15px;margin-left: 10px;"></i>
                                                                 </div>
                                                                <div class="col-sm-6 mobliview">
                                                                <p class="card-subtitle mb-2 text-muted" style="margin-top: 0px;font-size: 16px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;color: black;">Label</p>
                                                                    <p class="card-text" style="margin-top:-10px;color: grey;font-size: 14px;font-family: 'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['books']
                                                                ?></p>

                                                                </div>
                                                                <div class="col-sm-4 alignright" style="cursor: pointer;" > 
                                                               
                                                               
                                                                 <a class="btn btn-primary btn-sm btn-custom-grey"  style=" margin-top: 5px; margin-bottom: 0px;margin-left: 0px;text-align:right;cursor: pointer;" href="preference_billing_label.php"><span style="color: black;font-size: 15px;">&#128393;</span> Edit</a> 
                                                                <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing_label.php" style="margin-top: 6px;margin-bottom:0rem; margin-right:0px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                               
                                                                </div>
                                                                </div>

                                                                   
                                                                </div>
<div class="card card-body mt-3" style="width: 30%;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;box-shadow: 0 1px 5px 0 rgb(0 0 0 / 20%);position: absolute;left: 33%;bottom: 33%;">
<div class="row row1">
                                                                <div class="col-sm-2  mobliview"> <i class="fa fa-pencil-square-o" style="margin-top: 15px;margin-left: 10px;"></i>
                                                                 </div>
                                                                <div class="col-sm-6 mobliview">
                                                                <p class="card-subtitle mb-2 text-muted" style="margin-top: 0px;font-size: 16px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;color: black;">Label</p>
                                                                    <p class="card-text" style="margin-top:-10px;color: grey;font-size: 14px;font-family: 'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['books']
                                                                ?></p>

                                                                </div>
                                                                <div class="col-sm-4 alignright" style="cursor: pointer;" > 
                                                               
                                                               
                                                                <a class="btn btn-primary btn-sm btn-custom-grey"  style=" margin-top: 5px; margin-bottom: 0px;margin-left: 0px;text-align:right;cursor: pointer;" href="preference_billing_label.php"><span style="color: black;font-size: 15px;">&#128393;</span> Edit</a> 
                                                                <a class="btn btn-primary btn-sm btn-custom-grey" href="item_preference.php" style="margin-top: 6px;margin-bottom:0rem; margin-right:0px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                               
                                                                </div>
                                                            </div>
                                                        </div>
                                                                <div class="mt-3" style="border-top: 1px solid #dee2e6;">
                                                                <div class="mt-3 btn-custom-grey">
                                                                <a style="font-size:18px;padding: 20px 0px 14px;width: 61.25;height: 55.5;">General</a>
                                                                </div>
                                                            </div> -->
    <!-- </div> -->
    <!-- <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
        <div class="table-responsive m-3">
      <table class="table table-bordered">
      <thead>
      <tr>
      <td>DATE</td>
      <td>DETAILS</td>
      </tr>
      </thead>
      <tbody> -->
        <?php
        // $pairuse="SELECT * FROM pairusehistory WHERE createdby='".$_SESSION["unqwerty"]."' order by createdon desc";
        // $finally=mysqli_query($con,$pairuse);
        // while ($use=mysqli_fetch_array($finally))
        //  {
        //     if($use['booklabelchanges']!=''){
        ?>
        <!-- <tr>
          <td data-label="DATE" style="color:grey"><?=date('d/m/Y h:i:s a', strtotime($use['createdon']))?></td>
          <td data-label="DETAILS"><span  style="color:black">Label Changed by <?=$use['createdby']?> </span><br><span  style="color:grey"><?=$use['booklabelchanges']?></span></td>
        </tr> -->
        <?php
    // }
    ?>
    <?php
        // }
        ?>
      <!-- </tbody>
      </table>
      </div>
    </div>
</div> -->
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