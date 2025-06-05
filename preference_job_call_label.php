<?php
include('lcheck.php');
if($userrole!='SUPER ADMIN')
{
	header('Location: dashboard.php');
}
if(isset($_POST['submit']))
{
$franchisename=mysqli_real_escape_string($con, $_POST['franchisename']);
$street=mysqli_real_escape_string($con, $_POST['street']);
$city=mysqli_real_escape_string($con, $_POST['city']);
$pincode=mysqli_real_escape_string($con, $_POST['pincode']);
$state=mysqli_real_escape_string($con, $_POST['state']);
$country=mysqli_real_escape_string($con, $_POST['country']);
$mobile=mysqli_real_escape_string($con, $_POST['mobile']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$website=mysqli_real_escape_string($con, $_POST['website']);
$gstno=mysqli_real_escape_string($con, $_POST['gstno']);
$invoice=mysqli_real_escape_string($con, $_POST['invoice']);
$invoiceprefix=mysqli_real_escape_string($con, $_POST['invoiceprefix']);
$invoicesuffix=mysqli_real_escape_string($con, $_POST['invoicesuffix']);

$msg = "";
$msg_class = "";
	if(($franchisename!=""))
	{		
        $sqlcon = "SELECT id From pairfranchises WHERE franchisename = '{$franchisename}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon == 0) 
		{	


			$sqlup = "insert into pairfranchises set createdon='$times',  createdby='".$_SESSION["unqwerty"]."', email='$email', mobile='$mobile', franchisename='$franchisename', website='$website', invoice='$invoice',   gstno='$gstno', invoiceprefix='$invoiceprefix', street='$street', country='$country', invoicesuffix='$invoicesuffix', city='$city',  state='$state', pincode='$pincode'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				$id=mysqli_insert_id($con);
				$sqluse=mysqli_query($con, "update paircontrols set franchises=concat(franchises, ',' , $id) where role='SUPER ADMIN'");
				
				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='FRANCHISE', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$id', useremarks='CREATED BY' ");
				
				header("Location: franchises.php?remarks=Added Successfully");
			} 
	    }
		else
			{
				header("Location: franchises.php?error=This record is Already Found! Kindly check in All Franchises and Roles List");
			}
	}
	else
			{
				header("Location: franchises.php?error=Error Data");
			}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
include('externals.php');
?>
    <title>
        New Franchisee & Roles - Dmedia
    </title>
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
    </style>


</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6">
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
                            <div class="card-body p-3">

                                <h6 class="font-weight-bolder mb-3 myheading"><i class="fa fa-user"></i>
                                    Franchisee & Roles</h6>
                                <form action="" onsubmit="return checkvalidate()" method="post"
                                    enctype="multipart/form-data" class="form-horizontal" role="form">


                                    <div class="accordion" id="accordionRental">
                                        <div class="accordion-item mb-1">
                                            <h5 class="accordion-header" id="headingOne">
                                                <button class="accordion-button font-weight-bold" type="button">

                                                    <div class="customcont-header ml-0 mb-1">
                                                        <a class="customcont-heading">General</a>

                                                    </div>

                                                </button>
                                            </h5>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" style="">
                                                <div class="accordion-body text-sm">

                                                <h5 style="padding-left: 20px;"> <img  src="assets/img/edit-button.png" alt="User_image"/> <span>Edit Label</span></h5>
                                                   
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
                                                                        placeholder="(Example: Branches or Franchisee or Stores)"
                                                                        required>
                                                                        <br>

                                                                        <div class="col-lg-6">
                                                                <input class="btn btn-primary btn-sm btn-custom"
                                                                    type="submit" name="submit" value="Save"> <a
                                                                    class="btn btn-primary btn-sm btn-custom-grey"
                                                                    href="franchises.php">Cancel</a>
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
</body>

</html>