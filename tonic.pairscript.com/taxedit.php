<?php
include('lcheck.php');
if($taxes=='0'||$permissionconfig=='0')
{
  header('Location: dashboard.php');
}
if(isset($_POST['submit']))
{
$id=mysqli_real_escape_string($con, $_POST['id']);	
$taxname=mysqli_real_escape_string($con, $_POST['taxname']);
$tax=mysqli_real_escape_string($con, $_POST['tax']);
$msg = "";
$msg_class = "";
	if(($taxname!=""))
	{		
        $sqlcon = "SELECT id From pairtaxrates WHERE id = '{$id}' and createdid='{$companymainid}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
        $sqlconh = "SELECT * From pairtaxrates WHERE id = '{$id}' and createdid='{$companymainid}'";
        $queryconh = mysqli_query($con, $sqlconh);
        $arrayconh=mysqli_fetch_array($queryconh);
        $oldtaxname=$arrayconh['taxname'];
        $oldtax=$arrayconh['tax'];
        $ch='';
                if($taxname!=$oldtaxname)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Tax Name  <span style="color:green;" id="prohisfromtospan">( From '.$oldtaxname.' To '.$taxname.' ) </span>';
                    }
                    else
                    {
                        $ch.='Tax Name  <span style="color:green;" id="prohisfromtospan">( From '.$oldtaxname.' To '.$taxname.' ) </span>';
                    }
                    $taxnamehis=mysqli_real_escape_string($con, $_POST['taxname']);                   
                }
                if($tax!=$oldtax)
                {
                    if($ch!='')
                    {
                        $ch.='<br> Rate  <span style="color:green;" id="prohisfromtospan">( From '.$oldtax.' To '.$tax.' ) </span>';
                    }
                    else
                    {
                        $ch.='Rate  <span style="color:green;" id="prohisfromtospan">( From '.$oldtax.' To '.$tax.' ) </span>';
                    }  
                    $taxhis=mysqli_real_escape_string($con, $_POST['tax']);                 
                }
                if($ch!='')
                {
         $sqluphis = "insert into pairusehistory set usetype='TAX',useid='$id',createdon='$times', createdby='".$_SESSION["unqwerty"]."',useremarks='".$ch."'";
            $queryuphis = mysqli_query($con, $sqluphis);
            }
        if($rowCountcon > 0) 
		{	
			$sqlup = "update pairtaxrates set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', tax='$tax', taxname='$taxname' where id='$id'";
			$queryup = mysqli_query($con, $sqlup); 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				$tid=$id;
				mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Update A Tax Rate Information', '{$tid}')");
				header("Location: taxs.php?remarks=Updated Successfully");
			} 
	    }
		else
			{
				header("Location: taxs.php?error=This record is Already Found! Kindly check in All Tax Rates List");
			}
	}
	else
			{
				header("Location: taxs.php?error=Error Data");
			}
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
    Configuration &gt; Tax Rates &gt; Tax Details &gt; Edit Tax
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
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body py-1"
                                style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                <?php
if(isset($_GET['id']))
{
$count=1;
$id=mysqli_real_escape_string($con, $_GET['id']);
$sqli=mysqli_query($con, "select * from pairtaxrates where id='$id' and (createdid='$companymainid' or createdid='0') order by tax asc");
if(mysqli_num_rows($sqli)>0)
{
$info=mysqli_fetch_array($sqli);
?>
                                <p style="color:black;font-size: 14.6px;border-bottom: 1px solid #dee2e6;" class="mb-3"><a href="config.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Configuration </a><span>&gt;</span><a href="taxs.php" style="color: #1878F1"><!-- <i class="fa fa-book"></i> -->
                                   Tax Rates </a> <span>&gt;</span><a href="taxview.php?id=<?= $id ?>" style="color: #1878F1"><!-- <i class="fa fa-book"></i> -->
                                   Tax Details </a> <span>&gt;</span> Edit Tax   <!-- <i class="fa fa-file-import"></i> --></p>
             	<p class="mb-3" style="font-size: 20px;"><i class="fa fa-pencil-square-o"></i> Edit Tax </p>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<input type="hidden" name="id" id="id" value="<?=$info['id']?>">
	<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="taxname" class="custom-label text-danger">Tax Name *</span></label>
            </div>
            <div class="col-sm-8">
               <input type="text" class="form-control  form-control-sm" id="taxname" name="taxname" value="<?=$info['taxname']?>" required>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="tax" class="custom-label text-danger">Tax Rate (%) *</label>
            </div>
            <div class="col-sm-8">
               <div class="input-group mb-3">
    <input type="number"  min="0" step="0.5" class="form-control  form-control-sm" id="tax" name="tax" placeholder="" required value="<?=$info['tax']?>">
    <div class="input-group-append">
    <span class="input-group-text" style="padding-top: 4.5px;padding-bottom: 3px;padding-right: 15px;padding-left: 15px ;background-color:#EEEEEE;border-radius:0px;">%</span>
  </div>
  </div>
            </div>
          </div>
    </div>
</div>
<!--<div style="margin-bottom: -14px;">
  <button name="submit" 
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 0px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey mt-3" href="taxs.php">Cancel</a>
                                                        </div>-->
                                                        <div class="row justify-content-center" style="margin-bottom: -9px;margin-top:-6px;">
    <div class="col-lg-6"><hr>
        <button name="submit" 
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Save"
                                                            style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;margin-top: -9px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>
                                                        <a class="btn btn-primary btn-sm btn-custom-grey " href="taxs.php" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;margin-top: -9px;">Cancel</a>
    </div>
</div>
</form>
<?php
}
}
else
{
	?>
	<div class="alert alert-danger">No Results Found</div>
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

<script type="text/javascript">
  $(function() {
     $( "#taxname" ).autocomplete({
       source: 'taxsearch.php?type=taxname',
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