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
                                                aria-labelledby="headingOne">
                                                <div class="accordion-body text-sm">

                                                <h5 style="padding-left: 20px;"> <img  src="assets/img/edit-button.png" alt="User_image"/> <span>Edit Label</span></h5>
                                                   
                                                <br>
                                              
                                                <div class="row justify-content-center">
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
                                                                        <button class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit" id="submit" name="submit" value="Submit">
                                                            <span class="label">Save</span> <span class="spinner"></span>
                                                        </button> <a
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