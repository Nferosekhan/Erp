<?php
include('lcheck.php');
if($taxes=='0'||$permissionconfig=='0')
{
  header('Location: dashboard.php');
}
$id=$_GET['id'];
$sqlipath=mysqli_query($con, "select * from pairtaxrates where id='$id' order by tax asc");
$infopath=mysqli_fetch_array($sqlipath);
if ($infopath['taxgroups']!='') {
    header("location:taxgview.php?id='".$id."'");
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
        Configuration &gt; Tax Rates &gt; Tax Details
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

    .table td,
    .table th {
        white-space: normal;
    }
    </style>
    <!--<style>
    .tree li {
        font-size: 13px;
        list-style-type: none;
        margin: 0;
        padding: 2px 5px 0 5px;
        position: relative
    }

    .tree li::before,
    .tree li::after {
        content: '';
        left: -20px;
        position: absolute;
        right: auto
    }

    .tree li::before {
        border-left: 1px solid #ced4da;
        bottom: 50px;
        height: 100%;
        top: 0;
        width: 1px
    }

    .tree li::after {
        border-top: 1px solid #ced4da;
        height: 20px;
        top: 15px;
        width: 25px
    }

    .tree li span {
        display: inline-block;
        padding: 3px 3px;
        text-decoration: none;
        cursor: pointer;
    }

    .tree>ul>li::before,
    .tree>ul>li::after {
        border: 0
    }

    .tree li:last-child::before {
        height: 15px
    }

    .tree li span a {
        text-decoration: none;
    }

    

    .tree li span:hover a {
        color: white;
    }

    [aria-expanded="false"]>.expanded,
    [aria-expanded="true"]>.collapsed {
        display: none;
    }

    .myinput::-webkit-input-placeholder {
        font-size: 12px;
    }

    .table-bordered>thead>tr>th,
    .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>tbody>tr>td,
    .table-bordered>tfoot>tr>td {
        border: 1px solid #dddddd;
        border-right-width: 0px;
        border-left-width: 0px;
    }
    </style>-->
    <link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
    .slow .toggle-group {
        transition: left 0.7s;
        -webkit-transition: left 0.7s;
    }

    .fast .toggle-group {
        transition: left 0.1s;
        -webkit-transition: left 0.1s;
    }

    .quick .toggle-group {
        transition: none;
        -webkit-transition: none;
    }

    .toggle-group .btn {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        margin-bottom: 0rem;
    }

    .toggle-group .btn-default {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }

    .toggle-on {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 50%;
        margin: 0;
        border: 0;
        border-radius: 0;
    }

    .toggle-off {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        right: 0;
        margin: 0;
        border: 0;
        border-radius: 0;
    }

    .toggle-handle {
        position: relative;
        margin: 0 auto;
        padding-top: 0px;
        padding-bottom: 0px;
        height: 100%;
        width: 0px;
        border-width: 0 1px;
    }

    .toggle-on.btn {
        padding-right: 24px;
        text-transform: none;
    }

    .toggle-off.btn {
        padding-left: 24px;
        text-transform: none;
    }

    .toggle-group .btn-success {
        color: #fff;
        background-color: #5cb85c;
        border-color: #4cae4c;
    }

    .toggle-group .btn-danger.active {
        color: #fff;
        background-color: #c9302c;
        border-color: #ac2925;
    }

    .toggle.btn {
        margin-bottom: 0rem;
    }

    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
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
                                <p style="color:black;font-size: 14.6px;border-bottom: 1px solid #dee2e6;" class="mb-2"><a href="config.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Configuration </a><span>&gt;</span><a href="taxs.php" style="color: #1878F1"><!-- <i class="fa fa-book"></i> -->
                                   Tax Rates </a> <span>&gt;</span> Tax Details  <!-- <i class="fa fa-file-import"></i> --></p>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="mb-0" style="color:black;font-size: 20px;"><i
                                                class="fa fa-eye"></i>
                                                Tax Details</p>
                                    </div>
                                    <div class="col-lg-6">
                                        <span style="float:right" class="mb-0">

                                            <form action="franchisechange.php" method="get">
                                                <?php
                  $id=$_GET['id'];
                  $sqli=mysqli_query($con, "select * from pairtaxrates where id='$id' order by tax asc");
                  $info=mysqli_fetch_array($sqli);
                      ?>
                                                <a class="btn btn-primary btn-sm btn-custom-grey"
                                                    onclick="window.open('taxedit.php?id=<?=$info['id']?>', '_self')"
                                                    style="margin-bottom:0rem; margin-right:10px;color:black;"><i
                                                        class="fa fa-pencil-alt"></i> Edit</a>
                                                <input type="hidden" name="id" value="<?=$info['id']?>">
                                           
                                            </form>
                                        </span>
                                    </div>
                                </div>

                                <form action="" onsubmit="return checkvalidate()" method="post"
                                    enctype="multipart/form-data" class="form-horizontal" role="form">


                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-home" type="button" role="tab"
                                                aria-controls="nav-home" aria-selected="true">
                                                <div class="customcont-header ml-0">

                                                    <a class="customcont-heading">Overview</a>

                                                </div>
                                            </button>
                                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-profile" type="button" role="tab"
                                                aria-controls="nav-profile" aria-selected="false">
                                                <div class="customcont-header ml-0">

                                                    <a class="customcont-heading">History</a>

                                                </div>

                                            </button>

                                        </div>

                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                            aria-labelledby="nav-home-tab">
                                                   
                  <?php
                  $id=$_GET['id'];
                  $sqli=mysqli_query($con, "select * from pairtaxrates where id='$id' order by tax asc");
                  $info=mysqli_fetch_array($sqli);
                      ?>
                                            <div class="row m-3" style="align-items: center;">
                                                <div class="col-sm-3 col-md-2 col-6"
                                                        ><span style="color:black;font-size: 13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Tax
                                                        Name</span>
                                                </div>
                                                <div class="col-md-8 col-6" style="font-size:13px;">
                                                   <?=$info['taxname']?> <?=($info['taxgroups']!='')?'(Tax Group)':''?>
                                                </div>
                                            </div>
                                            <div class="row m-3" style="align-items: center;">
                                                <div class="col-sm-3 col-md-2 col-6"
                                                        ><span style="color:black;font-size: 13px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">Tax
                                                        Rate</span>
                                                </div>
                                                <div class="col-md-8 col-6" style="font-size:13px;">
                                                <?=$info['tax']?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                            aria-labelledby="nav-profile-tab">
                                            <div class="table-responsive m-3">
                                                <table class="table table-bordered" style="table-layout: fixed;">
                                                    <thead>
                                                        <tr>
                                                            <th style="border:1px solid #ddd !important;width: 190px;">DATE</th>
                                                            <th style="border:1px solid #ddd !important;">DETAILS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
	  $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='TAX' and useid='$id' order by createdon desc");
	  while($infouse=mysqli_fetch_array($sqluse))
	  {
        $taxname=$infouse['taxnamehis'];
        $tax=$infouse['taxhis'];
        // $msl=mysqli_query($con,"select * from pairtaxrates where id='".$tax."'");
        // while ($name=mysqli_fetch_array($msl)) {
        //     $taxn=$name['taxname'];
	  ?>
                                                        <tr>
      <td data-label="DATE" style="color:grey"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
      <td data-label="DETAILS"><?=$infouse['useremarks']?> <br> <span><?=(($infouse['useremarks']=='Tax Created')?'Created By':'Changed By')?></span> <span  style="color:grey"><?=$info['createdby']?></span></td>
    </tr>
                                                        <?php
	  }
    // }
	  ?>

                                                    </tbody>
                                                </table>
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
    <!-- <script src="assets/js/bootstrap-toggle.min.js"></script>
    <script>
    window.setMobileTable = function(selector) {
        // if (window.innerWidth > 600) return false;
        const tableEl = document.querySelector(selector);
        const thEls = tableEl.querySelectorAll('thead th');
        const tdLabels = Array.from(thEls).map(el => el.innerText);
        tableEl.querySelectorAll('tbody tr').forEach(tr => {
            Array.from(tr.children).forEach(
                (td, ndx) => td.setAttribute('label', tdLabels[ndx])
            );
        });
    }
    </script>
    <script type="text/javascript">
    $(function() {
        $("#area").autocomplete({
            source: 'areasearch.php',
            select: function(event, ui) {
                $("#area").val(ui.item.area);
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
 -->
</body>

</html>
