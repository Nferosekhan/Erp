<?php
include('lcheck.php');
if (isset($_POST['vendorsubmit'])) {
$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
if(!empty($_FILES['vendorfile'] ['name']) && in_array($_FILES['vendorfile'] ['type'], $csvMimes)){
if(is_uploaded_file($_FILES['vendorfile'] ['tmp_name'])){
$csvFile=fopen($_FILES['vendorfile'] ['tmp_name'],'r');
fgetcsv($csvFile);
while(($line=fgetcsv($csvFile))!==FALSE){
// $customercode=mysqli_real_escape_string($con, $line[0]);    
$primarysalutation=mysqli_real_escape_string($con, $line[1]);
$customername=mysqli_real_escape_string($con, $line[2]);
$billstreet=mysqli_real_escape_string($con, $line[3]);
$billcity=mysqli_real_escape_string($con, $line[4]);
$mobile=mysqli_real_escape_string($con, $line[5]);
$billpincode=mysqli_real_escape_string($con, $line[6]);
$email=mysqli_real_escape_string($con, $line[7]);
$billstate=mysqli_real_escape_string($con, $line[8]);
$billcountry=mysqli_real_escape_string($con, $line[9]);
$website=mysqli_real_escape_string($con, $line[10]);
$gstin=mysqli_real_escape_string($con, $line[11]);
$cstno=mysqli_real_escape_string($con, $line[12]);
$dlno20=mysqli_real_escape_string($con, $line[13]);
$dlno21=mysqli_real_escape_string($con, $line[14]);
$workphone=mysqli_real_escape_string($con, $line[15]);
$moduletype=mysqli_real_escape_string($con, $line[16]);
$gstrtype=mysqli_real_escape_string($con, $line[17]);
$pos=mysqli_real_escape_string($con, $line[18]);
$cvisibility=mysqli_real_escape_string($con, $line[19]);
$category = mysqli_real_escape_string($con, $line[20]);

$sqlismodulespublicnamecust=mysqli_query($con, "select * from pairmodules where moduletype='$moduletype' order by id  asc");
$infomodulespublicnamecust=mysqli_fetch_array($sqlismodulespublicnamecust);
$sqlismainaccesspublicnamecust=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='$moduletype' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicnamecust=mysqli_fetch_array($sqlismainaccesspublicnamecust);

$sqlins = mysqli_query($con, "select count(customercode) from paircustomers where createdid='$companymainid' and moduletype='$moduletype' and franchisesession='".$_SESSION['franchisesession']."'");
$ansins = mysqli_fetch_array($sqlins);
$oldid = $ansins[0];
$customercode = $oldid + 1;

$publicsql=mysqli_query($con,"select count(publicid) from paircustomers where createdid='$companymainid' and moduletype='$moduletype' and franchisesession='".$_SESSION['franchisesession']."'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publiccode=$infomodulespublicnamecust['publiccolumn'] . $oldcodepublic+1;

$privatesql=mysqli_query($con,"select count(privateid) from paircustomers where createdid='$companymainid' and moduletype='$moduletype' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privatecode=$infomainaccesspublicnamecust['moduleprefix'] . $oldcodeprivate+1;

if ($customername!='') {
$sqlven = mysqli_query($con,"insert into paircustomers set createdon='$times', createdid='$companymainid', createdby='" . $_SESSION["unqwerty"] . "', franchisesession='" . $_SESSION["franchisesession"] . "',primarysalutation='$primarysalutation',customername='$customername',cvisiblity='PRIVATE',billstreet='$billstreet',billcity='$billcity',billstate='$billstate',billpincode='$billpincode',billcountry='$billcountry',shipstreet='$billstreet',shipcity='$billcity',shipstate='$billstate',shippincode='$billpincode',shipcountry='$billcountry',customercode='$customercode',gstrtype='$gstrtype',gstin='$gstin',workphone='$workphone',mobile='$mobile',email='$email',website='$website',sameasbilling='1',placeos='$pos',moduletype='$moduletype',publicid='$publiccode',privateid='$privatecode',dlno20='$dlno20',dlno21='$dlno21',category='$category'");
$customerid=mysqli_insert_id($con);
$sqlcat = "select category from paircategory where category='$category' and itemmodule='Vendors' and createdid='$companymainid'";
$resultcat = mysqli_query($con, $sqlcat);
if (mysqli_num_rows($resultcat) > 0) {
} else {
// if (isset($_POST['category'])) {
$sqlupcat = "insert into paircategory set createdon='$times', createdid='$companymainid',createdby='" . $_SESSION["unqwerty"] . "',itemmodule='Vendors', category='$category'";
$queryupcat = mysqli_query($con, $sqlupcat);
// }
}
}
      }
        if($sqlven){
          header("Location: vendors.php?remarks=Imported Successfully");
        }
    else{
          header("Location: vendors.php?error=".mysqli_error($con));
    }
    }
  }
  else{
    // $all="invalid vendor type";
  }
}

// $franchisesession=mysqli_real_escape_string($con, $line[0]);    
// $createdon=mysqli_real_escape_string($con, $line[1]);
// $createdby=mysqli_real_escape_string($con, $line[2]);
// $createdid=mysqli_real_escape_string($con, $line[3]);
// $moduletype=mysqli_real_escape_string($con, $line[4]);
// $vendorcode=mysqli_real_escape_string($con, $line[5]);
// $publicid=mysqli_real_escape_string($con, $line[6]);
// $privateid=mysqli_real_escape_string($con, $line[7]);
// $primarysalutation=mysqli_real_escape_string($con, $line[8]);
// $primarycontact=mysqli_real_escape_string($con, $line[9]);
// $vendorname=mysqli_real_escape_string($con, $line[10]);
// $billstreet=mysqli_real_escape_string($con, $line[11]);
// $billcity=mysqli_real_escape_string($con, $line[12]);
// $billstate=mysqli_real_escape_string($con, $line[13]);
// $billpincode=mysqli_real_escape_string($con, $line[14]);
// $billcountry=mysqli_real_escape_string($con, $line[15]);
// $sameasbilling=mysqli_real_escape_string($con, $line[16]);
// $shipstreet=mysqli_real_escape_string($con, $line[17]);
// $shipcity=mysqli_real_escape_string($con, $line[18]);
// $shipstate=mysqli_real_escape_string($con, $line[19]);
// $shippincode=mysqli_real_escape_string($con, $line[20]);
// $shipcountry=mysqli_real_escape_string($con, $line[21]);
// $mobile=mysqli_real_escape_string($con, $line[22]);
// $email=mysqli_real_escape_string($con, $line[23]);
// $website=mysqli_real_escape_string($con, $line[24]);
// $workphone=mysqli_real_escape_string($con, $line[25]);
// $gstrtype=mysqli_real_escape_string($con, $line[26]);
// $gstin=mysqli_real_escape_string($con, $line[27]);
// $placeos=mysqli_real_escape_string($con, $line[28]);
// $cvisiblity=mysqli_real_escape_string($con, $line[29]);
// $dlno20=mysqli_real_escape_string($con, $line[30]);
// $dlno21=mysqli_real_escape_string($con, $line[31]);
// $cstno=mysqli_real_escape_string($con, $line[32]);
// $sqlvendor="INSERT INTO paircustomers set franchisesession='$franchisesession',createdon='$createdon',createdby='$createdby',createdid='$createdid',moduletype='$moduletype',customercode='$vendorcode',publicid='$publicid',privateid='$privateid',primarysalutation='$primarysalutation',primarycontact='$primarycontact',customername='$vendorname',billstreet='$billstreet',billcity='$billcity',billstate='$billstate',billpincode='$billpincode',billcountry='$billcountry',sameasbilling='$sameasbilling',shipstreet='$shipstreet',shipcity='$shipcity',shipstate='$shipstate',shippincode='$shippincode',shipcountry='$shipcountry',mobile='$mobile',email='$email',website='$website',workphone='$workphone',gstrtype='$gstrtype',gstin='$gstin',placeos='$placeos',cvisiblity='$cvisiblity',dlno20='$dlno20',dlno21='$dlno21',cstno='$cstno'";
// $resultvendor=mysqli_query($con,$sqlvendor);
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
        Vendors - Dmedia
    </title>
    <style>
    table tbody tr:nth-of-type(odd) {}

/*@media screen and (max-width: 3px) {
    .addmenu{
        position: relative;
        left: -57px; 
        top: 36px;
}
.add{
    position: relative;
    left: -60px;
}
}*/
@media screen and (max-width: 993px) {
    .add{
        position: relative;
        left: 0px; 
        top: 36px;
}
.addmenu{
        position: relative;
        left: 0px; 
        top: 36px;
}
}


@media screen and (max-width: 353px) {
    /*.add{
        position: relative;
        left: -90px; 
        top: 36px;
}
.addmenu{
        position: relative;
        left: -96px; 
        top: 36px;
}*/
}


    @media screen and (max-width: 600px) {
        table {
            border: 0;
            margin-top: 30px;
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
            padding-bottom: 2em;
        }
    }
    </style>



    <style>
    #tableEditor {
        position: absolute;
        left: 250px;
        top: 161px;
        padding: 5px;
        border: 1px solid #000;
        background: #fff;
    }
    </style>

    <style>
    .checkbox-dropdown {
        width: 220px;
        border: 0px solid #aaa;
        padding: 10px;
        position: relative;
		z-index:5;


        user-select: none;
    }

    /* Display CSS arrow to the right of the dropdown text */
    .checkbox-dropdown:after {

        height: 0;
        position: absolute;
        width: 0;
        border: 6px solid transparent;
        border-top-color: #000;
        top: 50%;
        right: 10px;
        margin-top: -3px;
    }

    /* Reverse the CSS arrow when the dropdown is active */
    .checkbox-dropdown.is-active:after {
        border-bottom-color: #000;
        border-top-color: #fff;
        margin-top: -9px;
    }

    .checkbox-dropdown-list {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        top: 100%;
        /* align the dropdown right below the dropdown text */
        border: inherit;
        border-top: none;
        left: -1px;
        /* align the dropdown to the left */
        right: -1px;
        /* align the dropdown to the right */
        opacity: 0;
        /* hide the dropdown */
        border: 1px solid #aaa;
        transition: opacity 0.4s ease-in-out;
        height: auto;
        overflow: scroll;
        overflow-x: hidden;
        pointer-events: none;
        /* avoid mouse click events inside the dropdown */
    }

    .is-active .checkbox-dropdown-list {
        opacity: 1;
        /* display the dropdown */
        pointer-events: auto;
        /* make sure that the user still can select checkboxes */
    }

    .checkbox-dropdown-list {

        background-color: white;
        padding: 10px;
        text-transform: uppercase;


    }

    .checkbox-dropdown-list li label {

        padding: 10px;


    }

    .checkbox-dropdown-list li:hover {
        background-color: #EDF0F2;
        color: white;
    }

    .dropliststyle {
        padding-left: 10px;
        margin-top: -4px;
        vertical-align: text-bottom;
        font-size: 14px;
    }

    input[type=checkbox] {
        transform: scale(1.25);
    }

    input:disabled {
        background: red;
    }

    input[type="checkbox"i]:disabled {
        color: red;
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
<div class="card-body p-3">

 <p class="mb-3" style="color:black;font-size:20px;margin-top: -8px;"> <i class="fa fa-file-import"></i> Vendor Import</p>

<div class="alert alert-info text-white">
Kindly Note that the New Vendor List should contains existing Vendor Name, otherwise it has been Overrided.
</div>

<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingThree">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
			  
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">New Import</a>	
             
</div> 
                
</button>
</h5>
<div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree"  style="">
<div class="accordion-body text-sm">
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">

<p>Download a <a href="simpleimport.csv">sample file</a> and compare it to your import file to ensure you have the file perfect for the import.</p>

<div class="row">
<div class="col-lg-12">

<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="vendorfile" class="custom-label"><span class="text-danger">Vendors CSV File *</span></label>
</div>
<div class="col-sm-8">
<input type="file" class="form-control  form-control-sm" required id="vendorfile" name="vendorfile" accept=".csv">
</div>
</div>
</div>
</div>


</div>

</div>

<div class="row justify-content-center">
<div class="col-lg-12"><hr>
<input class="btn btn-primary btn-sm btn-custom" type="submit" name="vendorsubmit" value="Save">  <a class="btn btn-primary btn-sm btn-custom-grey" href="vendors.php">Cancel</a>
</div>
</div>
</form>
			   
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


    <script>
    function tableEditorremove() {
        $('#tableEditor').remove();
        return false;
    }
    </script>

    <script>
    $(".checkbox-dropdown").click(function() {
        $(this).toggleClass("is-active");
    });

    $(".checkbox-dropdown ul").click(function(e) {
        e.stopPropagation();
    });








    $("#name").click(function(e) {
        var checkbox = $(this);
        if (checkbox.is(":checked")) {
            //check it 
        } else {
            // prevent from being unchecked
            this.checked = !this.checked;
        }
    });



    $("#rate").click(function(e) {
        var checkbox = $(this);
        if (checkbox.is(":checked")) {
            //check it 
        } else {
            // prevent from being unchecked
            this.checked = !this.checked;
        }
    });


    if ($('#name').is(":checked")) {
        // it is checked  
        //alert("Name column is checked")
    }
    if ($('#rate').is(":checked")) {
        // it is checked  
        //alert("rate column is checked")
    }
    </script>
    <script>
    $(function() {
        var $chk = $(".grpChkBox input:checkbox");
        var $tbl = $("#someTable");
        var $tblhead = $("#someTable th");

        $chk.prop('checked', true);

        $chk.click(function() {
            var colToHide = $tblhead.filter("." + $(this).attr("name"));
            var index = $(colToHide).index();
            $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
        });
    });


    function funaddcolumn() {
        
       // $('#grpChkBox').css("display" , "none");
    }
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