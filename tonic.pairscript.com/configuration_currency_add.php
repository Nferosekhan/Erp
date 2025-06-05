<?php
include('lcheck.php');
if($currency=='0'||$permissionconfig=='0')
{
  header('Location: dashboard.php');
}
if (isset($_POST['submit'])) {
    header('location:configuration_currency_list.php');
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
        Configuration &gt; Currencies &gt; Label
    </title>
    <style>
    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }

    .select2 {
        width: 100% !important;
        background-color: #ffffff !important;
    }

    .modal-content {
        border-radius: 0px;
    }

    .modal-header {
        background: #F1F2F6;
        border-radius: 0;
    }

    .modal-title {
        font-weight: normal;
    }

    .select2-container--default .select2-selection--single {
        background-color: #ffffff !important;
        color: #495057;
        border: 1px solid #ced4da;
        height: 32px;
        border-radius: 2px;
    }
    </style>
    <style>
    .btn_upload {
        cursor: pointer;
        display: inline-block;
        overflow: hidden;
        position: relative;
        color: #fff;
        background-color: #fff;
        border: none;
    }

    .btn_upload:hover,
    .btn_upload:focus {
        background-color: #fff;
    }

    .yes {
        display: flex;
        align-items: flex-start;
        margin-top: 10px !important;
    }

    .btn_upload input {
        cursor: pointer;
        height: 100%;
        position: absolute;
        filter: alpha(opacity=1);
        -moz-opacity: 0;
        opacity: 0;
    }

    .it {
        height: 100px;
        margin-left: 10px;
    }

    #removeImage1,
    #removeImage2,
    #removeImage3,
    #removeImage4,
    #removeImage5 {
        color: #6c757d;
    }

    #removeImage1:hover {
        color: black;
    }

    #removeImage2:hover {
        color: black;
    }

    #removeImage3:hover {
        color: black;
    }

    #removeImage4:hover {
        color: black;
    }

    #removeImage5:hover {
        color: black;
    }


    .rmv {
        cursor: pointer;
        color: #fff;
        border-radius: 30px;
        border: 1px solid #fff;
        display: inline-block;
        background: rgba(255, 0, 0, 1);
        margin: -5px -10px;
    }

    .rmv:hover {
        background: rgba(255, 0, 0, 0.5);
    }
    </style>
    <style>
    .item-actions-container .item-actions {
        position: absolute;
        right: -50px;
        top: -20px;
    }

    .icon-cancel-circled {
        color: #fab2b1;
    }

    svg.icon.icon-sm {
        height: 14px;
        width: 14px;
    }

    td:hover {
        cursor: move;
    }

    .imagePreview {
        width: 200px;
        height: 140px;
        background-position: center center;
        background-color: #fff;
        background-size: cover;
        background-repeat: no-repeat;


        text-align: center;
    }

    .btn-custom-grey:hover i {
        color: #ffffff !important;
    }

    .selectdesign {
        width: 6px;
        padding-right: 0px;
        padding-left: 10px;
        padding-bottom: 1px;
        border-top-width: 2px;
        background-color: #f5f5f5;
    }

    .dash {
        border: 0 none;
        border-top: 2px dashed #322f32;
        background: none;
        height: 0;
        margin-top: 0px;
        width: 60px;
    }

    thead tr th {
        color: black !important;

        text-align: left !important;
    }

    .basicaddon1 {
        padding-right: 8px;
        padding-left: 8px;
        padding-top: 5px;
        padding-bottom: 5px;
        background-color: #e9ecef;
        border-bottom: 2px solid #e9ecef;

    }

    .form-control:disabled,
    .form-control[readonly] {
        background-color: #e9ecef;
        opacity: 1;
    }


    #footer {
        background-color: #ffffff;
        width: 84%;

        position: fixed;
        bottom: 0px;

        height: 50px;
        margin-bottom: 0px;
        Padding-top: 0px;
        margin-left: -15px;
        margin-right: -15px;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"]::placeholder {

        /* Firefox, Chrome, Opera */
        text-align: right;
    }

    input[type=number] {
        text-align: right;
    }




    .input-group-text {

        border: none;
        border-radius: 0px;
    }
    </style>

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

        table thead th {
            height: 50px;
            vertical-align: top;
        }

        .pointer {
            cursor: pointer;
        }

        .auto {
            cursor: auto;
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


    .table> :not(caption)>*>* {
        background-color: #ffffff;
        box-shadow: none;
    }

    .table> :not(:last-child)> :last-child>* {
        border-bottom-color: #e9ecef;
        font-size: 12px !important;
    }

    .input-group .form-control:not(:first-child) {
        border-left: 0;
        padding-left: 5px;
    }

    a .customcont-heading1 {
        margin-left: 30px;
    }

    .form-control-bn:focus {
        border: none !important;
        box-shadow: none;

    }

    .input-group .form-control-bn:focus {
        border: none !important;
        box-shadow: none;

    }

    table thead th {
        height: 10px;
        vertical-align: top;
    }
    </style>


    <style>
    @media screen and (min-device-width: 300px) and (max-device-width: 768px) {
        .mobview {
            padding-left: 30px;

        }
    }

    @media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}



    @media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
        .imagePreview {
            width: 100%;

        }



    }


    @media only screen and (max-width: 300px) {
        .select2-container {
            width: 90px !important;
            margin-top: 3px;
        }

        .select2-dropdown--below {
            width: none !important;
        }


        #fulla {
            padding-left: 12px !important;
        }
    }

    .accordion-button:not(.collapsed)::after {
        background-image: none;
        margin-left: -20px;
        margin-top: -5px;
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
            <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body py-1"
                                style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p style="color:black;font-size: 14.6px;border-bottom: 1px solid #dee2e6;" class="mb-3"><a href="config.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Configuration </a><span>&gt;</span><a href="configuration_currency_list.php" style="color: #1878F1"><!-- <i class="fa fa-book"></i> -->
                                   Currencies </a> <span>&gt;</span> Label  <!-- <i class="fa fa-file-import"></i> --></p>
                                <p class="mb-3" style="color:black;font-size: 20px;"><i
                                        class="fa fa-file-import"></i> Add Currency</p>
                                <form action="" onsubmit="return checkvalidate()" method="post"
                                    enctype="multipart/form-data" class="form-horizontal" role="form">
                                    <?php
	$oldarray=array('franchisename', 'street', 'city', 'pincode', 'state', 'country', 'mobile', 'email', 'website', 'gstno', 'invoice', 'invoiceprefix', 'invoicesuffix');
	foreach($oldarray as $oldinfo)
	{
	?>
                                    <input type="hidden" name="old<?=$oldinfo?>" value="<?=$info[$oldinfo]?>">
                                    <?php
	}
	?>

                                    <input type="hidden" name="id" value="<?=$info['id']?>">
                                    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header">
                                                <button class="accordion-button font-weight-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">

                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading">Currency
                                                            Details</a>

                                                    </div>

                                                </button>
                                            </h5>
                                            <div id="collapseOne" class="accordion-collapse collapse show">
                                                <div class="accordion-body text-sm">

                                                    <div class="row justify-content-center">

                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="franchisename"
                                                                        class="custom-label"><span
                                                                            class="text-danger">Currency
                                                                            Name *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                <select style=" width: 100%"
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="currencyname" id="currencyname" required>

                                                                        <?php
$sqlis = mysqli_query($con, "select currencyname from paircurrency");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                        <option value="<?= $infos['currencyname'] ?>">
                                                                            <?= $infos['currencyname'] ?>
                                                                        </option>
                                                                        <?php
}
?>

                                                                    </select>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-center">

                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="franchisename"
                                                                        class="custom-label"><span
                                                                            class="text-danger">Currency Symbol
                                                                             *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                <select style=" width: 100%"
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="currencysymbol" id="currencysymbol" required>

                                                                        <?php
$sqlis = mysqli_query($con, "select currencysymbol from paircurrency");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                        <option value="<?= $infos['currencysymbol'] ?>">
                                                                            <?= $infos['currencysymbol'] ?>
                                                                        </option>
                                                                        <?php
}
?>

                                                                    </select>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="row justify-content-center">

                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="franchisename"
                                                                        class="custom-label"><span
                                                                            class="text-danger">Decimal Places
                                                                             *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                <select style=" width: 100%"
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="decimalplaces" id="decimalplaces" required>

                                                                        <?php
$sqlis = mysqli_query($con, "select decimalplaces from paircurrency");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                        <option value="<?= $infos['decimalplaces'] ?>">
                                                                            <?= $infos['decimalplaces'] ?>
                                                                        </option>
                                                                        <?php
}
?>

                                                                    </select>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="row justify-content-center">

                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="franchisename"
                                                                        class="custom-label"><span
                                                                            class="text-danger">Number Format
                                                                             *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                <select style=" width: 100%"
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="numberformat" id="numberformat" required>

                                                                        <?php
$sqlis = mysqli_query($con, "select numberformat from paircurrency");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                        <option value="<?= $infos['numberformat'] ?>">
                                                                            <?= $infos['numberformat'] ?>
                                                                        </option>
                                                                        <?php
}
?>

                                                                    </select>


                                                                        <br>
                                                                        <br>
                                                                  

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>





                                                   


                                                </div>
                                            </div>
                                                                      <div class="row justify-content-center" style="margin-bottom: -14px;">
                                                                    <div class="col-lg-12"><hr>
                                                                        <button
                                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                                            type="submit" id="submit" name="submit"
                                                                            value="Submit">
                                                                            <span class="label">Save</span> <span
                                                                                class="spinner"></span>
                                                                        </button> <a
                                                                            class="btn btn-primary btn-sm btn-custom-grey"
                                                                            href="configuration_currency_list.php">Cancel</a>
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
 <script type="text/javascript">
     $("#currencyname").on("select2:open", function() { 
    $("#configureunits").hide();
});
     $("#currencysymbol").on("select2:open", function() { 
    $("#configureunits").hide();
});
     $("#decimalplaces").on("select2:open", function() { 
    $("#configureunits").hide();
});
     $("#numberformat").on("select2:open", function() { 
    $("#configureunits").hide();
});
 </script>
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

        background-image: url("assets/img/spin.gif");
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