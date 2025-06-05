<?php
include('lcheck.php');
/* if($userrole!='SUPER ADMIN')
{
	header('Location: products.php');
} */
if(isset($_POST['submit']))
{
 
   
$productcode=mysqli_real_escape_string($con, $_POST['productcode']);
$productname=mysqli_real_escape_string($con, $_POST['productname']);
$codetags=mysqli_real_escape_string($con, $_POST['codetags']);
$category=mysqli_real_escape_string($con, $_POST['category']);
$subcategory=mysqli_real_escape_string($con, $_POST['subcategory']);
$hsncode=mysqli_real_escape_string($con, $_POST['hsncode']);
$defaultunit=mysqli_real_escape_string($con, $_POST['defaultunit']);
$description=mysqli_real_escape_string($con, $_POST['description']);
//$foronline=(float)mysqli_real_escape_string($con, $_POST['foronline']);
$purchaseaccounttype=mysqli_real_escape_string($con, $_POST['purchaseaccounttype']);
$saleaccounttype=mysqli_real_escape_string($con, $_POST['saleaccounttype']);
$taxpref=(float)mysqli_real_escape_string($con, $_POST['taxpref']);
$taxratecountry=mysqli_real_escape_string($con, $_POST['taxratecountry']);
$intratax=mysqli_real_escape_string($con, $_POST['intratax']);
$intertax=mysqli_real_escape_string($con, $_POST['intertax']);
$excemptionreason=mysqli_real_escape_string($con, $_POST['excemptionreason']);
$trackinventory=(float)mysqli_real_escape_string($con, $_POST['trackinventory']);
$inventoryaccounttype=mysqli_real_escape_string($con, $_POST['inventoryaccounttype']);
$openingstock=(float)mysqli_real_escape_string($con, $_POST['openingstock']);
$openingstockrate=(float)mysqli_real_escape_string($con, $_POST['openingstockrate']);
$openingason=mysqli_real_escape_string($con, $_POST['openingason']);
$msg = "";
$msg_class = "";
	if(($productname!=""))
	{		
        $sqlcon = "SELECT id From pairproducts WHERE franchisesession='".$_SESSION["franchisesession"]."' and productname = '{$productname}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon == 0) 
		{	
			$productimages=array();
  // Configure upload directory and allowed file types
    $upload_dir = 'ups/';
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
     
    // Define maxsize for files i.e 2MB
    $maxsize = 2 * 1024 * 1024;

    // Checks if user sent an empty form
    if(!empty(array_filter($_FILES['productimage']['name']))) {

        // Loop through each file in files[] array
        foreach ($_FILES['productimage']['tmp_name'] as $key => $value) {
               
            $file_tmpname = $_FILES['productimage']['tmp_name'][$key];
            $file_name = $_FILES['productimage']['name'][$key];
            $file_size = $_FILES['productimage']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
 
            // Set upload file path
            $filepath = $upload_dir.$file_name;
            // Check file type is allowed or not
            if(in_array(strtolower($file_ext), $allowed_types)) {
 
                // Verify file size - 2MB max
                if ($file_size > $maxsize)        
                    header("Location: products.php?error=File size is larger than the allowed limit");
 
                // If file with name already exist then append time in
                // front of name of the file to avoid overwriting of file
                if(file_exists($filepath)) {
                    $filepath = $upload_dir.time().$file_name;
                     
                    if( move_uploaded_file($file_tmpname, $filepath)) {
						$productimages[]=$filepath;
                       // echo "{$file_name} successfully uploaded <br />";
                    }
                    else {                    
                        //echo "Error uploading {$file_name} <br />";
                    }
                }
                else {
                 
                    if( move_uploaded_file($file_tmpname, $filepath)) {
						$productimages[]=$filepath;
                        //echo "{$file_name} successfully uploaded <br />";
                    }
                    else {                    
                        //echo "Error uploading {$file_name} <br />";
                    }
                }
				
            }
            else {
                 
                // If file extension not valid
               // echo "Error uploading {$file_name} ";
              //  echo "({$file_ext} file type is not allowed)<br / >";
            }
        }
    }
    else {
         
    
    }

$productimage=implode(",",$productimages);
$viewaccess='';
foreach($_POST['viewaccess'] as $viewa)
{
if($viewaccess!='')
{
	$viewaccess.=','.$viewa;
}
else
{
	$viewaccess.=''.$viewa;
}
}

			
			$sqlup = "insert into pairproducts set productcode='$productcode', productname='$productname', codetags='$codetags', category='$category', subcategory='$subcategory', productimage='$productimage', hsncode='$hsncode', defaultunit='$defaultunit', description='$description', foronline='$foronline', viewaccess='$viewaccess', purchaseaccounttype='$purchaseaccounttype', saleaccounttype='$saleaccounttype', taxpref='$taxpref', taxratecountry='$taxratecountry', intratax='$intratax', intertax='$intertax', excemptionreason='$excemptionreason', trackinventory='$trackinventory', inventoryaccounttype='$inventoryaccounttype', openingstock='$openingstock', openingstockrate='$openingstockrate', openingason='$openingason'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				$tid=mysqli_insert_id($con);
				$productid=$tid;
				$productcode='DM'.str_pad($tid,5,"0",STR_PAD_LEFT);
				mysqli_query($con, "update pairproducts set productcode='$productcode' where id='$tid'");
				mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Reported Problem', '{$tid}')");
				
				$sqlias=mysqli_query($con, "delete from pairpropurchase where productid='$productid'");
				for($ip=0;$ip<count($_POST['purchasename']);$ip++)
				{
					$purchasename=mysqli_real_escape_string($con, $_POST['purchasename'][$ip]);
					$purchasemrp=mysqli_real_escape_string($con, $_POST['purchasemrp'][$ip]);
					$purchasecost=mysqli_real_escape_string($con, $_POST['purchasecost'][$ip]);
					$purchasediscount=mysqli_real_escape_string($con, $_POST['purchasediscount'][$ip]);
					$purchaseofferprice=mysqli_real_escape_string($con, $_POST['purchaseofferprice'][$ip]);
					$purchaseunit=mysqli_real_escape_string($con, $_POST['purchaseunit'][$ip]);
					$purchaseindunit=mysqli_real_escape_string($con, $_POST['purchaseindunit'][$ip]);
					if(($purchasename!='')&&($purchasecost!=''))
					{
						$sqlias=mysqli_query($con, "select purchasename from pairpropurchase where productid='$productid' and purchasename='$purchasename'");
						if(mysqli_num_rows($sqlias)==0)
						{
							$sqliasa=mysqli_query($con, "insert into pairpropurchase set productid='$productid', purchasename='$purchasename', purchasemrp='$purchasemrp', purchasecost='$purchasecost', purchasediscount='$purchasediscount', purchaseofferprice='$purchaseofferprice', purchaseunit='$purchaseunit', purchaseindunit='$purchaseindunit'");
						}							
					}
					
				}
				
				$sqlias=mysqli_query($con, "delete from pairprosale where productid='$productid'");
				for($ip=0;$ip<count($_POST['salename']);$ip++)
				{
					$salename=mysqli_real_escape_string($con, $_POST['salename'][$ip]);
					$salemrp=mysqli_real_escape_string($con, $_POST['salemrp'][$ip]);
					$salecost=mysqli_real_escape_string($con, $_POST['salecost'][$ip]);
					$salediscount=mysqli_real_escape_string($con, $_POST['salediscount'][$ip]);
					$saleofferprice=mysqli_real_escape_string($con, $_POST['saleofferprice'][$ip]);
					$saleunit=mysqli_real_escape_string($con, $_POST['saleunit'][$ip]);
					$saleindunit=mysqli_real_escape_string($con, $_POST['saleindunit'][$ip]);
					if(($salename!='')&&($salecost!=''))
					{
						$sqlias=mysqli_query($con, "select salename from pairprosale where productid='$productid' and salename='$salename'");
						if(mysqli_num_rows($sqlias)==0)
						{
							$sqliasa=mysqli_query($con, "insert into pairprosale set productid='$productid', salename='$salename', salemrp='$salemrp', salecost='$salecost', salediscount='$salediscount', saleofferprice='$saleofferprice', saleunit='$saleunit', saleindunit='$saleindunit'");
						}							
					}
					
				}
				
				header("Location: products.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: products.php?error=This record is Already Found! Kindly check in All Products List");
			}
	}
	else
			{
				header("Location: products.php?error=Error Data");
			}
}
elseif(isset($_POST['submitunit']) ) {  

    $unitname=mysqli_real_escape_string($con, $_POST['missingdefaultunit']);
    $uqc=mysqli_real_escape_string($con, $_POST['uqc']);

    	
			$sqlup = "insert into pairunits set unitname='$unitname', uqc='$uqc'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}

}elseif( isset($_POST['submitcategory'])) { 

    //  submitcategory code 
   

}
elseif( isset($_POST['submitsubcategory'])) { 

    //  submitsubcategory code 
  

}


?>






<!DOCTYPE html>
<html lang="en">

<head>

    <?php
include('externals.php');
?>
    <title>
        New product - Dmedia
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
        width: 81.81%;

        position: fixed;
        bottom: 3px;

        height: 50px;
        margin-bottom: 0px;
        Padding-top: 10px;
        margin-left: -15.9px;
        margin-right: -15px;
        box-shadow: 9px 9px 9px 9px lightgrey;
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
    table tbody tr:nth-of-type(odd) {}

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
        .select2-dropdown--below
	  {
		  width: none !important;
	  }
       

        #fulla {
            padding-left: 12px !important;
        }
    }
    </style>





    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6;">
    <?php
  include('sidebar.php');
  ?>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-0 shadow-none" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-0">
                <nav aria-label="breadcrumb">
                </nav>
                <?php include('navbar.php'); ?>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4 bg-body">
            <?php
	 if(isset($_GET['remarks']))
	 {
	 ?>
            <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-autohide="false">
                <div class="toast-body">
                    <?=$_GET['remarks']?>
                </div>
            </div>
            <?php
	 }
	 ?>
            <?php
	 if(isset($_GET['error']))
	 {
	 ?>
            <div class="toast bg-gradient-danger text-white" id="myToast">
                <div class="toast-body"><i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></div>
            </div>
            <?php
	 }
	 ?>
            <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-3" style="font-size:20px;"><i class="fa fa-file-import"></i> New
                                    Product</p>
                                <?php
			if (isset($_GET['remarks'])) {
			?>
                                <div class="toast bg-gradient-success text-white" id="myToast">
                                    <div class="toast-body"><i class="fa fa-check"></i> &nbsp;<?= $_GET['remarks'] ?>
                                    </div>
                                </div>
                                <?php
			}
			?>
                                <?php
			if (isset($_GET['error'])) {
			?>
                                <div class="toast bg-gradient-danger text-white" id="myToast">
                                    <div class="toast-body"><i class="fa fa-times"></i> &nbsp;<?= $_GET['error'] ?>
                                    </div>
                                </div>
                                <?php
			}
			?>
                                <form action="" onsubmit="return checkvalidate()" method="post"
                                    enctype="multipart/form-data" class="form-horizontal" role="form">
                                    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingOne">
                                                <button class="accordion-button font-weight-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading" style="font-size: 18px;">Product
                                                            Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne">
                                                <div class="accordion-body text-sm">
                                                    <div class="row justify-content-center">

                                                    <div class="form-group " style="display: none;">
					<label for="productcode">Product Code</label>
					<input type="text" class="form-control  form-control-sm" id="productcode" name="productcode" readonly>
				  </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="productname" class="custom-label"><span
                                                                            class="text-danger">Name
                                                                            *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="productname" name="productname"
                                                                        placeholder="Name" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="codetags" class="custom-label"><span
                                                                            class="">Code / Tags</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="codetags" name="codetags"
                                                                        placeholder="Code / Tags" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="Unit" class="custom-label"><span
                                                                            class="text-danger">Unit *</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select style=" width: 100%"
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="defaultunit" id="defaultunit" required>
                                                                        <option selected disabled>Units</option>
                                                                        <?php
$sqlis = mysqli_query($con, "select uqc, unitname from pairunits group by uqc order by unitname asc");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                        <option value="<?= $infos['uqc'] ?>">
                                                                            <?= $infos['unitname'] ?> -
                                                                            <?= $infos['uqc'] ?>
                                                                        </option>
                                                                        <?php
}
?>
                                                                        <option value="#AddNewDefaultUnit">+ Configure
                                                                            Units
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="hsncode" class="custom-label"><span
                                                                            class="">HSN Code</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="hsncode" name="hsncode"
                                                                        placeholder="HSN Code" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="Category" class="custom-label"><span
                                                                            class="">Category</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="category" id="category" required>
                                                                        <?php
																	$sqli = mysqli_query($con, "select distinct category from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and category!='' order by category asc");
																	while ($info = mysqli_fetch_array($sqli)) {
																	?>
                                                                        <option value="<?= $info['category'] ?>">
                                                                            <?= $info['category'] ?></option>
                                                                        <?php
																	}
																	?>
                                                                        <option value="#AddNewCategory">+ New
                                                                            Category
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="subcategory" class="custom-label"><span
                                                                            class="">Sub Category</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control form-control-sm"
                                                                        name="subcategory" id="subcategory" required>
                                                                        <?php
																	$sqli = mysqli_query($con, "select distinct subcategory from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and subcategory!='' order by subcategory asc");
																	while ($info = mysqli_fetch_array($sqli)) {
																	?>
                                                                        <option value="<?= $info['subcategory'] ?>">
                                                                            <?= $info['subcategory'] ?></option>
                                                                        <?php
																	}
																	?>
                                                                        <option value="#AddNewSubCategory">+ Add New Sub
                                                                            Category</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="description" class="custom-label"><span
                                                                            class="">Description</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <textarea style="height: 70px !important;"
                                                                        class="form-control" id="description"
                                                                        name="description"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button font-weight-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="true" aria-controls="collapseTwo">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading" style="font-size: 18px;">Product Image</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapseTwo" class="accordion-collapse collapse show"
                                                aria-labelledby="headingTwo">
                                                <div class="accordion-body text-sm">
                                                    <div class="accordion-body text-sm opacity-8">





                                                        <div class="row text-sm ">
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="row">
                                                                <div class="imagePreview input-img">

                                                                    <img src="assets/img/productimage1.png"
                                                                        id="ImgPreview"
                                                                        class=" preview1 navbar-brand-img" alt="image">
                                                                </div>
                                                                </div>
                                                                <div class="row text-center">
                                                                    <div class="col">

                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="btn_upload">
                                                                            <input type="file" id="imag" title=""
                                                                                class="input-img" />


                                                                            <P style="color: black;font-size: 15px;">
                                                                                &#128393;</p>
                                                                        </span>

                                                                    </div>
                                                                    <div class="col" style="padding: 0px;">
                                                                        |
                                                                    </div>
                                                                    <div class="col">
                                                                        <i id="removeImage1" class="fa fa-trash-o"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="col">

                                                                    </div>

                                                                </div>
                                                                </div>
                                                            </div>



                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="row">
                                                            <div class="row">
                                                                <div class="imagePreview input-img">

                                                                    <img src="assets/img/productimage1.png"
                                                                        id="ImgPreview2"
                                                                        class=" preview2 navbar-brand-img" alt="image">
                                                                </div>
                                                            </div>
                                                                <div class="row text-center">
                                                                    <div class="col">

                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="btn_upload">
                                                                            <input type="file" id="imag2" title=""
                                                                                class="input-img" />


                                                                            <P style="color: black;font-size: 15px;">
                                                                                &#128393;</p>
                                                                        </span>

                                                                    </div>
                                                                    <div class="col" style="padding: 0px;">
                                                                        |
                                                                    </div>
                                                                    <div class="col">
                                                                        <i id="removeImage2" class="fa fa-trash-o"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="col">

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="row">
                                                                <div class="imagePreview input-img">

                                                                    <img src="assets/img/productimage1.png"
                                                                        id="ImgPreview3"
                                                                        class=" preview3 navbar-brand-img" alt="image">
                                                                </div>
                                                                </div>
                                                                <div class="row text-center">
                                                                    <div class="col">

                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="btn_upload">
                                                                            <input type="file" id="imag3" title=""
                                                                                class="input-img" />


                                                                            <P style="color: black;font-size: 15px;">
                                                                                &#128393;</p>
                                                                        </span>

                                                                    </div>
                                                                    <div class="col" style="padding: 0px;">
                                                                        |
                                                                    </div>
                                                                    <div class="col" >
                                                                        <i id="removeImage3" class="fa fa-trash-o"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="col">

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="row">
                                                                <div class="imagePreview input-img">

                                                                    <img src="assets/img/productimage1.png"
                                                                        id="ImgPreview4"
                                                                        class=" preview4 navbar-brand-img" alt="image">
                                                                </div>
                                                                </div>
                                                                <div class="row text-center">
                                                                    <div class="col">

                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="btn_upload">
                                                                            <input type="file" id="imag4" title=""
                                                                                class="input-img" />


                                                                            <P style="color: black;font-size: 15px;">
                                                                                &#128393;</p>
                                                                        </span>

                                                                    </div>
                                                                    <div class="col" style="padding: 0px;">
                                                                        |
                                                                    </div>
                                                                    <div class="col">
                                                                        <i id="removeImage4" class="fa fa-trash-o"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="col">

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            </div>

                                                            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="row">
                                                                <div class="row">
                                                                <div class="imagePreview input-img">

                                                                    <img src="assets/img/productimage1.png"
                                                                        id="ImgPreview5"
                                                                        class=" preview5 navbar-brand-img" alt="image">
                                                                </div>
                                                                </div>
                                                                <div class="row text-center">
                                                                    <div class="col">

                                                                    </div>
                                                                    <div class="col">
                                                                        <span class="btn_upload">
                                                                            <input type="file" id="imag5" title=""
                                                                                class="input-img" />


                                                                            <P style="color: black;font-size: 15px;">
                                                                                &#128393;</p>
                                                                        </span>

                                                                    </div>
                                                                    <div class="col" style="padding: 0px;">
                                                                        |
                                                                    </div>
                                                                    <div class="col ">
                                                                        <i id="removeImage5" class="fa fa-trash-o"
                                                                            aria-hidden="true"></i>
                                                                    </div>
                                                                    <div class="col">

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingThree">
                                                <button class="accordion-button font-weight-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="true" aria-controls="collapseThree">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading" style="font-size: 18px;">Purchase Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapseThree" class="accordion-collapse collapse show"
                                                aria-labelledby="headingThree">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover  table-bordered"
                                                                id="purchasetable">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;"
                                                                            scope="col" class="text-center"></th>
                                                                        <th style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;"
                                                                            scope="col" class="text-center">
                                                                        </th>


                                                                        <th colspan="2">PURCHASE PRICE NAME</th>
                                                                        <th><span style="float: right;">MRP </span></th>
                                                                        <th><span style="float: right;">COST PRICE
                                                                            </span></th>
                                                                        <th><span style="float: right;">DISCOUNT </span>
                                                                        </th>
                                                                        <th><span style="float: right;">OFFER PRICE
                                                                            </span></th>
                                                                        <th>UNIT</th>
                                                                        <th>INDIVIDUAL UNIT</th>
                                                                        <th
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr id="1">
                                                                        <td class="index"
                                                                            style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                            1 </td>
                                                                        <td
                                                                            style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                            <input type="text" name="abc" id="index"
                                                                                value="1">
                                                                        </td>
                                                                        <td
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;cursor: pointer;">

                                                                            <i style="font-size:16px;color:#8392AB;"
                                                                                class='fas'>&#xf58e;</i>
                                                                        </td>

                                                                        <td style="cursor: none;padding:2px;"
                                                                            data-label="Prduct Name">
                                                                            <input type="text" name="purchasename[]"
                                                                                id="purchasename1"
                                                                                placeholder="Purchase Price Name"
                                                                                class="form-control form-control-sm form-control-bn"
                                                                                style="border: none">
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;"
                                                                            data-label="Mrp">
                                                                            <div class="input-group">

                                                                                <input type="number"
                                                                                    class="form-control form-control-bn"
                                                                                    placeholder="0.00"
                                                                                    name="purchasemrp[]"
                                                                                    id="purchasemrp1"
                                                                                    style="border: none">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="purchasecost[]"
                                                                                    id="purchasecost1"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    style="border: none">
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="purchasediscount[]"
                                                                                    id="purchasediscount1"
                                                                                    placeholder="Discount"
                                                                                    class="input-group form-control form-control-sm"
                                                                                    style="border: none">
                                                                                <select
                                                                                    style="background-color: #f5f5f5;border: 3px solid #f5f5f5;">
                                                                                    <option value="1">₹</option>
                                                                                    <option value="2">%</option>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">

                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span>
                                                                                </div>

                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="purchaseofferprice[]"
                                                                                    id="purchaseofferprice1"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    style="border: none">
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <select
                                                                                class="select2-field form-control  form-control-sm"
                                                                                name="purchaseunit[]" id="purchaseunit"
                                                                                required>
                                                                                <?php
$sqlis = mysqli_query($con, "select uqc, unitname from pairunits group by uqc order by unitname asc");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                                <option value="<?= $infos['uqc'] ?>">
                                                                                    <?= $infos['unitname'] ?> -
                                                                                    <?= $infos['uqc'] ?>
                                                                                </option>
                                                                                <?php
}
?>

                                                                            </select>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group boderline1">
                                                                                <div class="input-group-prepend"> <span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span> </div>
                                                                                <input type="text" min="0"
                                                                                    name="purchaseindunit[]"
                                                                                    id="purchaseindunit1"
                                                                                    style="border: none"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm readonly"
                                                                                    disabled="disabled">
                                                                            </div>
                                                                        </td>
                                                                        <td class="btn-delete"
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;cursor: pointer;">
                                                                            <img src="assets/img/delete-row.png"
                                                                                alt="Girl in a jacket" width="15"
                                                                                height="15"
                                                                                style="border-radius: 10px;">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </div>
                                                        <p align="left" style="margin:0; padding:0"><a
                                                                class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey"
                                                                style="background-color: #e9ecef;">
                                                                <i style="font-size: 14px;color:#0066cc"
                                                                    class="fa fa-plus-circle"></i> Add another line</a>
                                                        <p>
                                                        <div class="container row ">
                                                            <div class="col-md-4"
                                                                style="border-top: 2px solid #e9ecef; border-bottom: 2px solid #e9ecef;">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4"
                                                                        style="margin-top: 15px;margin-bottom: -5px;">
                                                                        <label for="purchaseaccounttype"
                                                                            class="custom-label"><span
                                                                                class="">Account</span></label>
                                                                        <hr class="dash" />
                                                                    </div>
                                                                    <div class="col-sm-8">

                                                                        <select
                                                                            style="margin-top: 14px;padding:0px 10px !important;"
                                                                            id="purchaseaccounttype"
                                                                            name="purchaseaccounttype"
                                                                            class="form-select form-control  form-control-sm"
                                                                            aria-label="Default select example"
                                                                            disabled>
                                                                            <option selected>Cost of Goods Sold</option>
                                                                            <option value="1">One</option>
                                                                            <option value="2">Two</option>
                                                                            <option value="3">Three</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingfour">
                                                <button class="accordion-button font-weight-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsefour"
                                                    aria-expanded="true" aria-controls="collapsefour">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading" style="font-size: 18px;">Sales
                                                            Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapsefour" class="accordion-collapse collapse show"
                                                aria-labelledby="headingfour">
                                                <div class="accordion-body text-sm">
                                                    <div class="text-sm opacity-8">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="saletable">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid ffffff;"
                                                                            scope="col" class="text-center"></th>
                                                                        <th style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;"
                                                                            scope="col" class="text-center ">
                                                                        </th>


                                                                        <th colspan="2"
                                                                            style="border-left:5px solid #ffffff;">
                                                                            SELLING PRICE NAME</th>
                                                                        <th style="width: 110px;"><span
                                                                                style="float: right;">MRP</span></th>
                                                                        <th> <span style="float: right;">SELLING
                                                                                PRICE</span></th>
                                                                        <th> <span style="float: right;">dISCOUNT</span>
                                                                        </th>
                                                                        <th>OFFER pRICE</th>
                                                                        <th style="width: 203px;">OFFER VALIDITY</th>
                                                                        <th>UNIT</th>
                                                                        <th>INDIVIDUAL UNIT</th>
                                                                        <th
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="index"
                                                                            style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                            1 </td>
                                                                        <td
                                                                            style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                            <input type="text" name="abc" id="index"
                                                                                value="1">
                                                                        </td>
                                                                        <td
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;cursor: pointer;">
                                                                            <i style='font-size:16px;color:#8392AB;'
                                                                                class='fas'>&#xf58e;</i>
                                                                        </td>

                                                                        <td style="cursor: none;padding:2px;"><input
                                                                                type="text" name="salename[]"
                                                                                id="salename1"
                                                                                placeholder="Selling Price"
                                                                                class="form-control form-control-sm"
                                                                                style="border: none">
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="salemrp[]" id="salemrp1"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    style="border: none">
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="salecost[]" id="salecost1"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    style="border: none">

                                                                            </div>
                                                                        </td>





                                                                        <td style="cursor: none;padding:2px;">


                                                                            <div class="input-group">
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="salediscount[]"
                                                                                    id="salediscount"
                                                                                    placeholder="Discount"
                                                                                    class="input-group form-control form-control-sm"
                                                                                    style="border: none">
                                                                                <select
                                                                                    style="background-color: #f5f5f5;border: 3px solid #f5f5f5;">
                                                                                    <option value="1">₹</option>
                                                                                    <option value="2">%</option>
                                                                                </select>
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="saleofferprice[]"
                                                                                    id="saleofferprice1"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    style="border: none">
                                                                            </div>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;"> Date
                                                                            Range<input type="text"
                                                                                class="form-control  form-control-sm"
                                                                                name="reportrange[]" id="reportrange1">
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <select
                                                                                class="select2-field form-control  form-control-sm"
                                                                                name="salesunit[]" id="salesunit"
                                                                                required>
                                                                                <?php $sqlis = mysqli_query($con, "select uqc, unitname from pairunits group by uqc order by unitname asc");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                                <option value="<?= $infos['uqc'] ?>">
                                                                                    <?= $infos['unitname'] ?> -
                                                                                    <?= $infos['uqc'] ?>
                                                                                </option>
                                                                                <?php
}
?>

                                                                            </select>
                                                                        </td>
                                                                        <td style="cursor: none;padding:2px;">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend"><span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="">₹</span></div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="saleindunit[]"
                                                                                    id="saleindunit" placeholder="0.00"
                                                                                    class="form-control form-control-smreadonly"
                                                                                    disabled="disabled"
                                                                                    style="border: none">
                                                                            </div>
                                                                        </td>
                                                                        <td
                                                                            style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;">
                                                                            <a class=" btn-delete "><img
                                                                                    src="assets/img/delete-row.png"
                                                                                    width="15" height="15"
                                                                                    style="border-radius: 10px;"></a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <p align="left" style="margin:0; padding:0"><a
                                                                class="saleadd-row btn btn-primary btn-sm btn-custom-grey"
                                                                style="background-color: #e9ecef;">
                                                                <i style="font-size: 14px;color:#0066cc"
                                                                    class="fa fa-plus-circle"></i> Add another line</a>
                                                        <p>

                                                        <div class="container row">
                                                            <div class="col-md-4"
                                                                style="border-top: 2px solid #e9ecef; border-bottom: 2px solid #e9ecef;">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-4"
                                                                        style="margin-top: 15px;margin-bottom: -5px;">
                                                                        <label for="saleaccounttype"
                                                                            class="custom-label"><span
                                                                                class="">Account</span></label>
                                                                        <hr class="dash" />
                                                                    </div>
                                                                    <div class="col-sm-8">

                                                                        <select
                                                                            style="margin-top: 14px;padding:0px 10px !important;"
                                                                            id="saleaccounttype" name="saleaccounttype"
                                                                            class="form-select form-control  form-control-md"
                                                                            aria-label="Default select example"
                                                                            disabled>
                                                                            <option selected>Sales</option>
                                                                            <option value="1">One</option>
                                                                            <option value="2">Two</option>
                                                                            <option value="3">Three</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingFive">
                                                <button class="accordion-button font-weight-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                    aria-expanded="true" aria-controls="collapseFive">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading" style="font-size: 18px;">Tax
                                                            Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapseFive" class="accordion-collapse collapse show"
                                                aria-labelledby="headingFive">
                                                <div class="accordion-body text-sm">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm-6 ">

                                                            <div class="form-check form-check-inline">

                                                                <label class="form-check-label" for="inlineRadio3"
                                                                    style="color: #ee0000;">Tax Preference*</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="taxpref" id="taxpreftaxable" value="0" checked
                                                                    onchange="gettaxable()">
                                                                <label class="form-check-label"
                                                                    for="Taxable">Taxable</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="taxpref" id="taxprefnontaxable" value="1"
                                                                    onchange="gettaxable()">
                                                                <label class="form-check-label" for="Non Taxable">Non
                                                                    Taxable</label>
                                                            </div>




                                                        </div>
                                                    </div>
                                                    </br>
                                                    </br>
                                                    <div class="row ">
                                                        <div class="col-sm-10">

                                                            <div id="taxablediv">


                                                                <div class="row ">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label for="taxratecountry"
                                                                                    class="custom-label"><span
                                                                                        class="">Tax Rate</span></label>
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group mb-3 input-group-sm"
                                                                                    style="width: 30%;border: solid 2px #e9ecef;">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"
                                                                                            style="padding-top: 6px;padding-bottom: 5px;padding-left: 5px;padding-right: 5px;">
                                                                                            <img src="assets/img/Indian-Flag.png"
                                                                                                width="25"
                                                                                                height="20"></span>
                                                                                    </div>
                                                                                    <input type="text"
                                                                                        class="form-control  form-control-sm"
                                                                                        id="taxratecountry"
                                                                                        name="taxratecountry"
                                                                                        value="INDIA"
                                                                                        style="border:none">
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row ">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label for="intratax"
                                                                                    class="custom-label"><span
                                                                                        class="">Intra State
                                                                                        Tax Rate</span></label>
                                                                                <hr style="width: 130px;"
                                                                                    class="dash" />
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <select
                                                                                    class="select2-field form-control  form-control-sm"
                                                                                    name="intratax" id="intratax"
                                                                                    required>
                                                                                    <?php
				  $count=1;
				  $sqlit=mysqli_query($con, "select * from pairtaxrates order by tax asc");
				  while($infot=mysqli_fetch_array($sqlit))
				  {
					  ?>
                                                                                    <option value="<?=$infot['id']?>">
                                                                                        <?=$infot['taxname']?> -
                                                                                        <?=$infot['tax']?>%
                                                                                    </option>
                                                                                    <?php
				  }
				  ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="row ">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-4">
                                                                                <label for="intratax"
                                                                                    class="custom-label"><span
                                                                                        class="">Intra State
                                                                                        Tax Rate</span></label>
                                                                                <hr style="width: 130px;"
                                                                                    class="dash" />
                                                                            </div>
                                                                            <div class="col-sm-8">
                                                                                <select
                                                                                    class="select2-field form-control  form-control-sm"
                                                                                    name="intratax1" id="intratax1"
                                                                                    required>
                                                                                    <?php
				  $count=1;
				  $sqlit=mysqli_query($con, "select * from pairtaxrates order by tax asc");
				  while($infot=mysqli_fetch_array($sqlit))
				  {
					  ?>
                                                                                    <option value="<?=$infot['id']?>">
                                                                                        <?=$infot['taxname']?> -
                                                                                        <?=$infot['tax']?>%
                                                                                    </option>
                                                                                    <?php
				  }
				  ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>









                                                        </div>
                                                        <div class="col-sm-2"> </div>


                                                    </div>
                                                    <div class="row ">

                                                        <div class="col-sm-6">


                                                            <div id="nontaxablediv" style="display:none">

                                                                <div class="row ">
                                                                    <div class="col-sm-7">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <label for="excemptionreason"
                                                                                    class="custom-label"><span
                                                                                        style="color: #ee0000;">Exemption
                                                                                        Reason*</span></label>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <input type="text"
                                                                                    class="form-control  form-control-sm"
                                                                                    id="excemptionreason"
                                                                                    name="excemptionreason"
                                                                                    placeholder="Exemption Reason">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>







                                                            </div>

                                                        </div>
                                                        <div class="col-sm-6"> </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingSix">
                                                <button class="accordion-button font-weight-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                    aria-expanded="true" aria-controls="collapseSix">
                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading" style="font-size: 18px;">Inventory Information</a>
                                                    </div>
                                                </button>
                                            </h5>
                                            <div id="collapseSix" class="accordion-collapse collapse show"
                                                aria-labelledby="headingSix">
                                                <div class="accordion-body text-sm">



                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="trackinventory">
                                                        <label class="form-trackinventory-label custom-label"
                                                            for="trackinventory" style="margin-top: 4px;">
                                                            Track Inventory for this Item <a href="#"
                                                                data-toggle="tooltip" title="Hooray!"><i
                                                                    class="fa fa-question-circle-o" aria-hidden="true"
                                                                    style="font-size: 14px;"></i> </a>
                                                        </label>

                                                        <p><small style="color:#8392AB"> You cannot enable/disable
                                                                inventory tracking once you've created transactions for
                                                                this item</small></p>
                                                    </div>

                                                    <br>
                                                    </br>


                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="inventoryaccounttype"
                                                                        class="custom-label"><span
                                                                            class="text-danger">Inventory Account
                                                                            Type*</span></label>
                                                                    <hr style="width: 160px" class="dash" />
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <select
                                                                        class="select2-field form-control  form-control-sm"
                                                                        name="inventoryaccounttype"
                                                                        id="inventoryaccounttype" required disabled>
                                                                        <?php
$sqlis = mysqli_query($con, "select uqc, unitname from pairunits group by uqc order by unitname asc");
while ($infos = mysqli_fetch_array($sqlis)) {
?>
                                                                        <option value="<?= $infos['uqc'] ?>">
                                                                            <?= $infos['unitname'] ?> -
                                                                            <?= $infos['uqc'] ?>
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
                                                                    <label for="openingstock" class="custom-label"><span
                                                                            class="">Opening Stock</span></label>
                                                                    <hr style="width: 100px" class="dash" />
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text"
                                                                        class="form-control  form-control-sm"
                                                                        id="openingstock" name="openingstock" required
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="openingstockrate"
                                                                        class="custom-label"><span class="">Opening
                                                                            Stock Rate per Unit</span></label>
                                                                </div>
                                                                <div class="col-sm-8">

                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <div class="input-group-prepend unitchange">
                                                                                <span
                                                                                    class="input-group-text basicaddon1"
                                                                                    id="" placeholder=" BALE - BAL">Unit
                                                                                </span>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-sm-6">

                                                                            <div class="input-group">
                                                                                <div
                                                                                    class="input-group-prepend Unitchange">
                                                                                    <span
                                                                                        class="input-group-text basicaddon1"
                                                                                        id="Unitchange1">₹</span>
                                                                                </div>
                                                                                <input type="number" min="0" step="0.01"
                                                                                    name="openingstockrate"
                                                                                    id="openingstockrate"
                                                                                    placeholder="0.00"
                                                                                    class="form-control form-control-sm"
                                                                                    disabled>
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


                                        <div class="row justify-content-center" id="footer">

                                            <div class="row col-md-12">
                                                <div class="col">
                                                  <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  
                                                        <a class="btn btn-primary btn-sm btn-custom-grey"
                                                        href="franchises.php">Cancel</a>
                                                </div>
                                               
                                                <div class="col">
                                            	  
                                            
                                            </div>
                                            </div>

                                        </div>


                                    </div>






                            </div>
                        </div>
                    </div>
                    </form>
                    <!-- Start AddNewDefaultUnit modal -->
                    <div class="modal fade" id="AddNewDefaultUnit" tabindex="-1" role="dialog">

                    <form  action="" method="post" role="form">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Configure Units</h5>
                                    <span type="button" onclick="funesdefaultunit()" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </span>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">

                                   
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label for="Unit" class="custom-label"><span
                                                               class="">Unit</span></label>

                                                    </div>
                                                    <input type="text" class="form-control  form-control-sm"
                                                        id="missingdefaultunit" name="missingdefaultunit"
                                                        placeholder="Unit" required>

                                                </div>

                                                <div class="col-md-7">
                                                    <div class="form-group row">
                                                        <label for="Unit" class="custom-label"
                                                            style="padding-left: 0px;"><span>
                                                                Unique Quanty Code(UQC)</span></label>
                                                    </div>
                                                    <div class="form-group row">
                                                        <input type="text" class="form-control  form-control-sm" id="uqc"
                                                            name="uqc" placeholder="Unique Quanty Code(UQC)" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                                <div class="modal-footer " style="display: block;"> 
                                
                                <div class="col">
                                                  <button   onclick="funadddefaultunit()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitunit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  
                                                        <button type="button"
                                        class="btn btn-primary btn-sm btn-custom-grey"
                                        onclick="funesdefaultunit()">Cancel</button> </div>
                                                </div>
                                
                                


                            
                                        
                                       
                            </div>
                        </div>
                    </form>
                    </div>
                    <!-- End AddNewDefaultUnit modal -->
                    <!-- Start AddNewCategory modal -->
                    <div class="modal fade" id="AddNewCategory" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Create Category</h5>
                                    <span type="button" onclick="funescategory()" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </span>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <div class="col-sm-5">
                                                    <label for="Unit" class="custom-label"><span class="">Category
                                                            Name</span></label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control  form-control-sm"
                                                        id="missingcategory" name="missingcategory"
                                                        placeholder="Category Name" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer " style="display: block;">
  
                                <div class="col">
                                                  <button   onclick="funaddcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitcategory" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  
                                                        <button type="button"
                                        class="btn btn-primary btn-sm btn-custom-grey"
                                        onclick="funescategory()">Cancel</button> </div>






                                   

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End AddNewCategory modal -->
                    <!-- Start AddNewSubCategory modal -->
                    <div class="modal fade" id="AddNewSubCategory" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Sub Category</h5>
                                    <span type="button" onclick="funessubcategory()" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </span>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <div class="form-group row">
                                                <div class="col-sm-5">
                                                    <label for="Unit" class="custom-label"><span class="">Sub Category
                                                            Name</span></label>
                                                </div>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control  form-control-sm"
                                                        id="missingsubcategory" name="missingsubcategory"
                                                        placeholder="Category Name" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer " style="display: block;">
                                <div class="col">
                                                  <button   onclick="funaddsubcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitsubcategory" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button>  
                                                        <button type="button"
                                        class="btn btn-primary btn-sm btn-custom-grey"
                                        onclick="funessubcategory()">Cancel</button> </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End AddNewSubCategory modal -->
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
    $("#defaultunit").on("change", function() {
        var sOptionVal = $(this).val();
        if (sOptionVal == '#AddNewDefaultUnit') {
            $('#AddNewDefaultUnit').modal('show');
        }
    });
    </script>
    <script>
    function funadddefaultunit() {
        var missingdefaultunit = document.getElementById('missingdefaultunit');
        if (missingdefaultunit.value == '') {
            alert('Please Enter New Default Unit Name');
            missingdefaultunit.focus();
            return false;
        } else {
            $('#defaultunit').append('<option value="' + missingdefaultunit.value + '">' + missingdefaultunit.value +
                '</option>');

                $('select[name^="defaultunit"] option[value="'+ missingdefaultunit +'"]').attr("selected","selected");
            $('#defaultunit').val(missingdefaultunit.value).change();
            $('#AddNewDefaultUnit').modal('hide');
            return false;
        }
    }

    function funesdefaultunit() {
        $('#defaultunit').val('').change();
        $('#AddNewDefaultUnit').modal('hide');
        return false;
    }
    </script>
    <script>
    $("#category").on("change", function() {
        var sOptionVal = $(this).val();
        if (sOptionVal == '#AddNewCategory') {
            $('#AddNewCategory').modal('show');
        }
    });
    $("#subcategory").on("change", function() {
        var sOptionVal = $(this).val();
        if (sOptionVal == '#AddNewSubCategory') {
            $('#AddNewSubCategory').modal('show');
        }
    });
    </script>
    <script>
    function funaddcategory() {
        var missingcategory = document.getElementById('missingcategory');
        if (missingcategory.value == '') {
            alert('Please Enter New Category Name');
            missingcategory.focus();
            return false;
        } else {
            $('#category').append('<option value="' + missingcategory.value + '">' + missingcategory.value +
                '</option>');
            $('#category').val(missingcategory.value).change();
            $('#AddNewCategory').modal('hide');
            return false;
        }
    }

    function funescategory() {
        $('#category').val('').change();
        $('#AddNewCategory').modal('hide');
        return false;
    }
    </script>
    <script>
    function funaddsubcategory() {
        var missingsubcategory = document.getElementById('missingsubcategory');
        if (missingsubcategory.value == '') {
            alert('Please Enter New Sub Category Name');
            missingsubcategory.focus();
            return false;
        } else {
            $('#subcategory').append('<option value="' + missingsubcategory.value + '">' + missingsubcategory.value +
                '</option>');
            $('#subcategory').val(missingsubcategory.value).change();
            $('#AddNewSubCategory').modal('hide');
            return false;
        }
    }

    function funessubcategory() {
        $('#subcategory').val('').change();
        $('#AddNewSubCategory').modal('hide');
        return false;
    }
    </script>
    <script type="text/javascript">
    $(function() {
        $("#productname").autocomplete({
            source: 'productsearch.php?type=productname',
        });
        $("#category").autocomplete({
            source: 'productsearch.php?type=category',
        });
    });
    </script>
    <script>
    let lineNo = 2;
    $(document).ready(function() {
        $(".purchaseadd-row").click(function() {
            markup =
                '<tr> <td style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;" class="index">3 </td> <td style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;" ><input type="text" name="abc"  id="index" value="2"></td> <td style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;cursor: pointer;"><i style="font-size:16px;color:#8392AB;" class="fas">&#xf58e;</i> </td>  <td style="cursor: none;padding:2px;"><input   placeholder="Type Purchase Price Name"  style="border: none" type="text" name="purchasename[]" id="purchasename' +
                lineNo +
                '" class="form-control form-control-sm" ></td> <td style="cursor: none;padding:2px;">    <div class="input-group"><div class="input-group-prepend"><span class="input-group-text basicaddon1" id="">₹</span></div><input  placeholder="0.00"  style="border: none" type="number" min="0" step="0.01" name="purchasemrp[]" id="purchasemrp' +
                lineNo +
                '" class="form-control form-control-sm"> </div></td> <td style="cursor: none;padding:2px;">    <div class="input-group"><div class="input-group-prepend"><span class="input-group-text basicaddon1" id="">₹</span></div><input  placeholder="0.00"  style="border: none" type="number" min="0" step="0.01" name="purchasecost[]" id="purchasecost' +
                lineNo +
                '" class="form-control form-control-sm"> </div></td> <td style="cursor: none;padding:2px;"> <div class="input-group"><input  placeholder="Discount"  style="border: none" type="number" min="0" step="0.01" name="purchasediscount[]" id="purchasediscount' +
                lineNo +
                '" class="form-control form-control-sm"> <select style="background-color: #f5f5f5;border: 3px solid #f5f5f5;" ><option value="1">₹</option><option value="2">%</option></select></div></td> <td style="cursor: none;padding:2px;">  <div class="input-group"><div class="input-group-prepend"><span class="input-group-text basicaddon1" id="">₹</span></div><input  placeholder="0.00"  style="border: none" type="number" min="0" step="0.01" name="purchaseofferprice[]" id="purchaseofferprice' +
                lineNo +
                '" class="form-control form-control-sm"></td> <td style="cursor: none;padding:2px;"><select class="select2-field form-control  form-control-sm" name="purchaseunit[]' +
                lineNo +
                '"  required> </select></td>  <td style="cursor: none;padding:2px;"> <div class="input-group"><div class="input-group-prepend"><span class="input-group-text basicaddon1"id="">₹</span> </div> <input type="text" min="0"  name="purchaseindunit[]"  style="border: none"   placeholder="0.00" ' +
                lineNo +
                '" class="form-control form-control-sm readonly"disabled="disabled"></div> <td class="btn-delete" style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;"><img src="assets/img/delete-row.png" alt="Girl in a jacket" width="15" height="15"  style="border-radius: 10px;"></td></tr>';
            tableBody = $("#purchasetable");
            tableBody.append(markup);
            renumber_table('#purchasetable');
            lineNo++;
        });
    });
    </script>
    <script>
    let linesNo = 2;
    $(document).ready(function() {
        $(".saleadd-row").click(function() {
            markup =
                '<tr> <td style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;" class="index">3 </td> <td style="display: none;border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;" ><input type="text" name="abc"  id="index" value="2"></td> <td style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;cursor: pointer;"><i style="font-size:16px;color:#8392AB;" class="fas">&#xf58e;</i></td>  <td style="cursor: none;padding:2px;"><input  placeholder="Selling Price" style="border: none" type="text" name="salename[]" id="salename' +
                linesNo +
                '" class="form-control form-control-sm" ></td> <td style="cursor: none;padding:2px;"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text basicaddon1" id="">₹</span></div><input  placeholder="0.00" style="border: none" type="number" min="0" step="0.01" name="salemrp[]" id="salemrp' +
                linesNo +
                '" class="form-control form-control-sm"> </div></td> <td style="cursor: none;padding:2px;"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text basicaddon1" id="">₹</span></div><input  placeholder="0.00"  style="border: none" type="number" min="0" step="0.01" name="salecost[]" id="salecost' +
                linesNo +
                '" class="form-control form-control-sm"> </div></td><td style="cursor: none;padding:2px;"> <div class="input-group"><input  placeholder="0.00" style="border: none" type="number" min="0" step="0.01" name="salediscount[]" id="salediscount' +
                linesNo +
                '" class="form-control form-control-sm">  <select style="background-color: #f5f5f5;border: 3px solid #f5f5f5;"><option value="1">₹</option> <option value="2">%</option></select></div> </td> <td style="cursor: none;padding:2px;"><div class="input-group"><div class="input-group-prepend"><span class="input-group-text basicaddon1" id="">₹</span></div><input  placeholder="0.00" style="border: none" type="number" min="0" step="0.01" name="saleunit[]"' +
                linesNo +
                '" class="form-control form-control-sm"></div></td>  <td style="cursor: none;padding:2px;"> Date Range<input type="text" name="reportrange[]" id="reportrange' +
                linesNo +
                '" class="form-control form-control-sm"></td> <td style="cursor: none;padding:2px;"><select class="select2-field form-control  form-control-sm" name="saleunit[]" ' +
                lineNo +
                '"  required> </select></td>  <td style="cursor: none;padding:2px;"> <div class="input-group"><div class="input-group-prepend"><span class="input-group-text basicaddon1"id="">₹</span> </div> <input type="text" min="0"  name="saleindunit[]"  style="border: none"   placeholder="0.00"' +
                lineNo +
                '" class="form-control form-control-sm readonly" disabled="disabled"></div> <td class="btn-delete" style="border-top: 5px solid #ffffff; border-bottom: 5px solid #ffffff;border-left:5px solid #ffffff;border-right:5px solid #ffffff;"><img src="assets/img/delete-row.png" alt="img" width="15" height="15"  style="border-radius: 10px;"></td></tr>';
            tableBody = $("#saletable");
            tableBody.append(markup);
            var start = moment().subtract(29, 'days');
            var end = moment();
            $('#reportrange' + linesNo).daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment()
                        .subtract(1, 'month').endOf('month')
                    ]
                },
                "alwaysShowCalendars": true,
                "applyClass": "btn-custom",
                "cancelClass": "btn-custom-grey"
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') +
                    ' to ' + end.format('YYYY-MM-DD'));
            });
            renumber_table('#saletable');
            linesNo++;
        });
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        //Helper function to keep table row from collapsing when being sorted
        var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        };
        //Make diagnosis table sortable
        $("#purchasetable tbody").sortable({
            helper: fixHelperModified,
            stop: function(event, ui) {
                renumber_table('#purchasetable')
            }
        }).disableSelection();
        //Make diagnosis table sortable
        $("#saletable tbody").sortable({
            helper: fixHelperModified,
            stop: function(event, ui) {
                renumber_table('#saletable')
            }
        }).disableSelection();
        //Delete button in table rows
        $('table').on('click', '.btn-delete', function() {
            tableID = '#' + $(this).closest('table').attr('id');
            r = confirm('Delete this item?');
            if (r) {
                $(this).closest('tr').remove();
                renumber_table(tableID);
            }
        });
    });
    //Renumber  table rows
    function renumber_table(tableID) {
        $(tableID + " tr").each(function() {
            count = $(this).parent().children().index($(this)) + 1;
            $(this).find('.priority').html(count);
        });
    }
    </script>




    <style>
    .select2-search__field:focus {
        background-color: red;
    }

    .select2-search__field:focus {
        color: #495057;
        background-color: #fff;
        border-color: #a6c8e6;
        outline: 0;
        box-shadow: 0 0 8px rgb(102 175 233 / 60%);
    }

    .bootstrap-select button {
        background-color: #ffffff;
    }

    .bootstrap-select button:hover {
        color: #495057;
        background-color: #fff;
        border-color: #a6c8e6;
        outline: 0;
        box-shadow: 0 0 8px rgb(102 175 233 / 60%);
    }

    .dropdown-item:hover {
        background-color: #397DB9;
    }

    .bootstrap-select {
        width: 100% !important;
    }

    .control-group.error .bootstrap-select .dropdown-toggle {
        border-color: #b94a48;
    }

    .bootstrap-select.show-menu-arrow.open>.btn {
        z-index: 1035 + 1;
    }

    .bootstrap-select.show-menu-arrow .dropdown-toggle:before {
        content: '';
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-bottom-width: 7px;
        border-bottom-style: solid;
        border-bottom-color: #cccccc;
        border-bottom-color: rgba(204, 204, 204, 0.2);
        position: absolute;
        bottom: -4px;
        left: 9px;
        display: none;
    }

    .bootstrap-select.show-menu-arrow .dropdown-toggle:after {
        content: '';
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 6px solid white;
        position: absolute;
        bottom: -4px;
        left: 10px;
        display: none;
    }

    .bootstrap-select.show-menu-arrow.dropup .dropdown-toggle:before {
        bottom: auto;
        top: -3px;
        border-bottom: 0;
        border-top-width: 7px;
        border-top-style: solid;
        border-top-color: #cccccc;
        border-top-color: rgba(204, 204, 204, 0.2);
    }

    .bootstrap-select.show-menu-arrow.dropup .dropdown-toggle:after {
        bottom: auto;
        top: -3px;
        border-top: 6px solid white;
        border-bottom: 0;
    }

    .bootstrap-select.show-menu-arrow.pull-right .dropdown-toggle:before {
        right: 12px;
        left: auto;
    }

    .bootstrap-select.show-menu-arrow.pull-right .dropdown-toggle:after {
        right: 13px;
        left: auto;
    }

    .bootstrap-select.show-menu-arrow.open>.dropdown-toggle:before,
    .bootstrap-select.show-menu-arrow.open>.dropdown-toggle:after {
        display: block;
    }
    </style>
    <script>
    $("#subcategory").select2({
        placeholder: "Select Country",
        allowClear: true
    });
    </script>
    <script>
    function readURL(input, imgControlName) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(imgControlName).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imag").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview";
        readURL(this, imgControlName);
        $('.preview1').addClass('it');
        $('#removeImage1').css("color", "black");
    });
    $("#imag2").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview2";
        readURL(this, imgControlName);
        $('.preview2').addClass('it');
        $('.btn-rmv2').addClass('rmv');
    });
    $("#imag3").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview3";
        readURL(this, imgControlName);
        $('.preview3').addClass('it');
        $('.btn-rmv3').addClass('rmv');
    });
    $("#imag4").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview4";
        readURL(this, imgControlName);
        $('.preview4').addClass('it');
        $('.btn-rmv4').addClass('rmv');
    });
    $("#imag5").change(function() {
        // add your logic to decide which image control you'll use
        var imgControlName = "#ImgPreview5";
        readURL(this, imgControlName);
        $('.preview5').addClass('it');
    });
    $("#removeImage1").click(function(e) {
        e.preventDefault();
        $("#imag").val("");
        $("#ImgPreview").attr("src",
            "assets/img/productimage1.png"
        );
        $('.preview1').removeClass('it');
        $('#removeImage1').css("color", "#6c757d");
    });
    $("#removeImage2").click(function(e) {
        e.preventDefault();
        $("#imag2").val("");
        $("#ImgPreview2").attr("src",
            "assets/img/productimage1.png"
        );
        $('.preview2').removeClass('it');
        $('#removeImage2').css("color", "#6c757d");
    });
    $("#removeImage3").click(function(e) {
        e.preventDefault();
        $("#imag3").val("");
        $("#ImgPreview3").attr("src",
            "assets/img/productimage1.png"
        );
        $('.preview3').removeClass('it');
        $('#removeImage3').css("color", "#6c757d");
    });
    $("#removeImage4").click(function(e) {
        e.preventDefault();
        $("#imag4").val("");
        $("#ImgPreview4").attr("src",
            "assets/img/productimage1.png"
        );
        $('.preview4').removeClass('it');
        $('#removeImage4').css("color", "#6c757d");
    });
    $("#removeImage5").click(function(e) {
        e.preventDefault();
        $("#imag5").val("");
        $("#ImgPreview5").attr("src",
            "assets/img/productimage1.png"
        );
        $('.preview5').removeClass('it');
        $('#removeImage5').css("color", "#6c757d");
    });
    </script>
    <script>
    var fixHelperModified = function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width())
            });
            return $helper;
        },
        updateIndex = function(e, ui) {
            $('td.index', ui.item.parent()).each(function(i) {
                $(this).html(i + 1);
            });
            $('input[type=text]', ui.item.parent()).each(function(i) {
                $(this).val(i + 1);
            });
        };
    $("#purchasetable tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();
    $("tbody").sortable({
        distance: 5,
        delay: 100,
        opacity: 0.6,
        cursor: 'move',
        update: function() {}
    });
    </script>
    <script type="text/javascript" src="vendor/daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="vendor/daterangepicker/daterangepicker.js"></script>
    <script>
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();
        $('#reportrange1').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            },
            "alwaysShowCalendars": true,
            "applyClass": "btn-custom",
            "cancelClass": "btn-custom-grey"
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
        });
    });
    </script>
    <script>
    function gettaxable() {
        var taxpreftaxable = document.getElementById('taxpreftaxable');
        var taxprefnontaxable = document.getElementById('taxprefnontaxable');
        if (taxpreftaxable.checked == true) {
            document.getElementById('taxablediv').style.display = "block";
            document.getElementById('nontaxablediv').style.display = "none";
        } else {
            document.getElementById('taxablediv').style.display = "none";
            document.getElementById('nontaxablediv').style.display = "block";
        }
    }


    $(document).ready(function() {

        $("#defaultunit").change(function(event) {

            $('.unitchange span').html($(this).val());
        });
    });





    $('#purchaseunit').on('change', function() {
        var defaultunitval = $('#defaultunit').find(":selected").val();
        var purchaseunitval = $('#purchaseunit').find(":selected").val();
        if (defaultunitval === purchaseunitval) {
            $('#purchaseindunit1').attr('disabled', true);
        } else {
            $('#purchaseindunit1').attr('disabled', false);
        }
    });

    $('#salesunit').on('change', function() {
        var defaultunitval = $('#defaultunit').find(":selected").val();
        var salesunittval = $('#salesunit').find(":selected").val();
        if (defaultunitval === salesunittval) {
            $('#saleindunit').attr('disabled', true);
        } else {
            $('#saleindunit').attr('disabled', false);
        }
    });
    </script>
    <script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $("#submit").click(function() {



        $(".Spinnn").css("display", "block");
        $(".Spinnn").fadeOut(200);

    });




    checkBox = document.getElementById('trackinventory').addEventListener('click', event => {
        if (event.target.checked) {
            $("#inventoryaccounttype").removeAttr('disabled');
            $("#openingstock").removeAttr('disabled');
            $("#openingstockrate").removeAttr('disabled');
        } else {
            $("#inventoryaccounttype").attr('disabled', 'disabled');
            $("#openingstock").attr('disabled', 'disabled');
            $("#openingstockrate").attr('disabled', 'disabled');

        }
    });


    $('#ImgPreview').click(function() {
        $('#imag').click();
    });


    $('#ImgPreview2').click(function() {
        $('#imag2').click();
    });

    $('#ImgPreview3').click(function() {
        $('#imag3').click();
    });

    $('#ImgPreview4').click(function() {
        $('#imag4').click();
    });
    $('#ImgPreview5').click(function() {
        $('#imag5').click();
    });
    </script>



<style>

@media only screen and (max-width: 300px) {
        .select2-container {
            width: 100% !important;
            margin-top: 3px;
        }
        .select2-dropdown--below
	  {
		  width: none !important;
	  }

    

        #fulla {
            padding-left: 12px !important;
        }
    }
    </style>
<script>
   var buttons = document.querySelectorAll( '.arlina-button' );

Array.prototype.slice.call( buttons ).forEach( function( button ) {

	var resetTimeout;

	button.addEventListener( 'click', function() {
		
		if( typeof button.getAttribute( 'data-loading' ) === 'string' ) {
			button.removeAttribute( 'data-loading' );
		}
		else {
			button.setAttribute( 'data-loading', '' );
		}

		clearTimeout( resetTimeout );
		resetTimeout = setTimeout( function() {
			button.removeAttribute( 'data-loading' );			
		}, 1000 );

	}, false );

} );
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
		border-color: rgba( 0, 0, 0, 0.07 );
		background-color: #58c2f8;
	}
	.arlina-button.blue[data-loading] {
		border-color: rgba( 0, 0, 0, 0.07 );
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
		border-color: rgba( 0, 0, 0, 0.07 );
		background-color: #ffa96c;
	}
	.arlina-button.orange[data-loading] {
		border-color: rgba( 0, 0, 0, 0.07 );
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