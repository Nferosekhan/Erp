<?php
include('lcheck.php');
 if((isset($_GET['adjustmentno']))&&(isset($_GET['adjustmentdate'])))
 {
     $adjustmentno=mysqli_real_escape_string($con, $_GET['adjustmentno']);
     $adjustmentdate=mysqli_real_escape_string($con, $_GET['adjustmentdate']);
 $sql=mysqli_query($con, "select * from pairadjustments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and adjustmentno='$adjustmentno' and adjustmentdate='$adjustmentdate' order by id asc");
if(mysqli_num_rows($sql)>0)
{
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Inventory Adjustments' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
// This is for Restriction of Pages
$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}

if((isset($_GET['adjustmentno']))&&(isset($_GET['adjustmentdate'])))
{
$adjustmentno=mysqli_real_escape_string($con, $_GET['adjustmentno']);
$adjustmentdate=mysqli_real_escape_string($con, $_GET['adjustmentdate']);
$sql=mysqli_query($con,"select * from pairadjustments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  adjustmentno='$adjustmentno'  and adjustmentdate='$adjustmentdate'");
$info=mysqli_fetch_array($sql);
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
    <?= $infomainaccessuser['modulename']; ?> Details
  </title>
   <link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
   <!-- productview.css -->
   <!-- <link href="productview.css" rel="stylesheet"> -->
</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
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
     <?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
?>
       <div id="fullcontainerwidth">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3">
<div class="row">
<div class="col-lg-6">
 <p class="mb-3" id="viewpro"><i class="fa fa-eye"></i> <?= $infomainaccessuser['modulename']; ?> Details</p>
 </div>
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccessedit']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
?>
<div class="col-lg-6" style="display: none;">
 <span id="btnalignright" class="mb-3">
<a class="btn btn-primary btn-sm btn-custom-grey" href="adjustmentedit.php?adjustmentno=<?=$adjustmentno?>&adjustmentdate=<?=$adjustmentdate?>" id="btngopage"><i class="fa fa-pencil-alt"></i> Edit</a>
  </span>
  </div>
  <?php 
}
?>

  </div>
<?php
$sqlismainaccessuser=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix,modulename from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
    <div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename']; ?> Generation is Allowed for this Franchise</div>
    <?php
}
else
{
?>

<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


<nav>
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><div class="customcont-header ml-0">
	
		<a class="customcont-heading">Overview</a>	
             
				</div></button>
               <!--  <button class="nav-link" id="nav-transactions-tab" data-bs-toggle="tab" data-bs-target="#nav-transactions" type="button" role="tab" aria-controls="nav-transactions" aria-selected="false"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">Transactions</a>  
             
                </div></button> -->
     <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
		<div class="customcont-header ml-0">
	
		<a class="customcont-heading">History</a>	
             
				</div>
		
		</button>
		
  </div>
  
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="table-responsive m-3">
      <table class="table table-bordered">
      <thead>
      <tr>
      <th style="color: #212529 !important;">DATE</th>
      <th style="color: #212529 !important;">DETAILS</th>
      </tr>
      </thead>
      <tbody>
        <?php
        $adjustmentid = $_GET['id'];
      $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='ADJUSTMENTS' and (useid = '".$adjustmentno."' AND (uniqueid = '".$adjustmentno."' OR uniqueid = '".$adjustmentid."')) order by createdon desc");
      while($infouse=mysqli_fetch_array($sqluse))
      {
      ?>
        <tr>
          <td data-label="DATE" id="datehis"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
          <td data-label="DETAILS"><?=$infouse['useremarks']?> <br><span>Adjusted By</span><span  id="chhis"> <?=$info['createdby']?></span></td>
        </tr>
      <?php
      }
      ?>
      </tbody>
      </table>
      </div>
      </div>
  <!-- <div class="tab-pane fade" id="nav-transactions" role="tabpanel" aria-labelledby="nav-transactions-tab">
    <p class="m-3">Transaction</p>
  </div> -->
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
     <?php
     // if ((in_array('Inventory Adjustment Information', $fieldview))) {
        ?>
<p class="m-3" id="infoheadsall"><?= $infomainaccessuser['modulename']; ?> Details</p>	 

<div class="row m-3" id="aligncenterall" style="display: none;">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Number</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['adjustmentno']?>
        </div>
      </div>
     <?php
     if ((in_array('Public Id', $fieldview))) {
        ?>
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Public Id</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['publicid']?>
        </div>
      </div>
                                                    <?php
}
?>
     <?php
     if ((in_array('Private Id', $fieldview))) {
        ?>
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Private Id</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['privateid']?>
        </div>
      </div>
                                                    <?php
}
?>
      
	  <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Date</span>
        </div>
        <div class="col-md-8 col-6">
           <?=date($datemainphp,strtotime($info['adjustmentdate']))?>
        </div>
      </div>
	  
	<!--   <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Account </span>
        </div>
        <div class="col-md-8 col-6">
        <?=$info['chartaccountname']?>
        </div>
      </div> -->
	  
	  <div class="row m-3" id="aligncenterall" <?=(in_array('Reason', $fieldview))?'':'style="display:none !important;"'?>>
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Reason</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['adjustmentreason']?>
        </div>
      </div>
      
	  <div class="row m-3" id="aligncenterall" <?=(in_array('Reference Number', $fieldview))?'':'style="display:none !important;"'?>>
		  <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Reference Number</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['reference']?>
        </div>
      </div>
      
	  <div class="row m-3" id="aligncenterall" <?=(in_array('Description', $fieldview))?'':'style="display:none !important;"'?>>
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Description</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['description']?>
        </div>
      </div>
                                                    <?php
// }
?>
<p class="m-3 mb-0" id="infoheadsall">Item Information</p>

      <div class="row" id="newonetable">
        <div class="col-lg-8">
      <div class="table-responsive m-3">
      <table class="table table-bordered">
      <thead>
      <tr>
        <th style="color:#212529 !important; <?=(in_array('Item Details', $fieldview))?'':'display:none !important;'?>">ITEM DETAILS</th>
        <th style="color:#212529 !important; <?=($access['batchexpiryval']==1)?'':'display:none !important;'?>">BATCH</th>
        <th style="color:#212529 !important; <?=($access['batchexpiryval']==1)?'':'display:none !important;'?>">EXPIRY DATE</th>
        <th style="color:#212529 !important;<?=(in_array('Quantity Adjusted', $fieldview))?'':'display:none !important;'?>">QUANTITY ADJUSTED</th>
      </tr>
      </thead>
      <tbody>
            <?php
    $i=0;
    $sqls=mysqli_query($con,"select adjustment, productname, productid,batch,expiry from pairadjustments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  adjustmentno='$adjustmentno'  and adjustmentdate='$adjustmentdate' order by id asc");
    while($infos=mysqli_fetch_array($sqls))
    {
        ?>
        <tr>
        <td data-label="ITEM DETAILS" style="<?=(in_array('Item Details', $fieldview))?'':'display:none !important;'?>">&nbsp;<?=$infos['productname']; ?></td>
        <td data-label="BATCH" style="<?=($access['batchexpiryval']==1)?'':'display:none !important;'?>">&nbsp;<?=$infos['batch']; ?></td>
        <td data-label="EXPIRY DATE" style="<?=($access['batchexpiryval']==1)?'':'display:none !important;'?>">&nbsp;<?=(($infos['expiry']!='')?date($datemainphp,strtotime($infos['expiry'])):'') ?></td>
        <td data-label="QUANTITY ADJUSTED" style="<?=(in_array('Quantity Adjusted', $fieldview))?'':'display:none !important;'?>">&nbsp;<?=$infos['adjustment']; ?></td>
        
        </tr>
        <?php
    }
?>
      </tbody>
      </table>
      </div>
      </div>
      </div>
	  <hr>
</div>
</div>
        <?php
    }
?>
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
</body>

</html>
<?php
}
?>
<?php
}
else{
header("Location:adjustments.php?error=No Information Found");
}
}
else{
header("Location:adjustments.php?error=No Information Found");  
}
?>