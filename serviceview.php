<?php
include('lcheck.php');
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Services' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Services' order by id  asc");
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
$sqlget=mysqli_query($con,"select * from paircurrency");
$row=mysqli_fetch_array($sqlget);
$ans=$row['currencysymbol'];
$res=explode('-',$ans);
// if (isset($_POST['val'])) {
//    $isactive = mysqli_real_escape_string($con,(isset($_POST['val']))?'1':'0');
//    $sqli=mysqli_query($con, "insert into pairproducts set isactive='$isactive'");
// }
if(isset($_GET['id']))
{
$id=mysqli_real_escape_string($con, $_GET['id']);
$sqli=mysqli_query($con, "select * from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and id='".$id."' and itemmodule='Services' order by productname asc");
if(mysqli_num_rows($sqli)>0)
{
$info=mysqli_fetch_array($sqli);
$sqlismainaccesssales=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Sales' order by id  asc");
$infomainaccesssales=mysqli_fetch_array($sqlismainaccesssales);
$salehead = $infomainaccesssales['groupname'];
$sqlismainaccesspurchase=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Purchase' order by id  asc");
$infomainaccesspurchase=mysqli_fetch_array($sqlismainaccesspurchase);
$purhead = $infomainaccesspurchase['groupname'];
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
    Service Details - Dmedia
  </title>
   <link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
   <!-- productview.css -->
   <link href="productview.css" rel="stylesheet">
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
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Services' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
                                ?>
     
       <div id="fullcontainerwidth">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
<div class="row">
<div class="col-lg-6">
 <p class="mb-3" id="viewpro"><i class="fa fa-eye"></i> <?= $infomainaccessuser['modulename'] ?> Details</p>
 </div>
<?php
$sqli=mysqli_query($con, "select * from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and id='".$id."' and itemmodule='Services' order by productname asc");
$isactives=mysqli_fetch_array($sqli);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Services' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccessedit']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
?>
<div class="col-lg-6">
 <span id="btnalignright" class="mb-3">
<form action="servicechange.php" method="get">
<a class="btn btn-primary btn-sm btn-custom-grey" href="serviceedit.php?id=<?=$info['id']?>" id="btngopage"><i class="fa fa-pencil-alt"></i> Edit</a>
<input type="hidden" name="id" value="<?=$info['id']?>">
<input type="checkbox" <?=($isactives['isactive']=='0')?'checked':''?> data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-style="slow"  data-size="small" value="0" name="val" onchange="this.form.submit()">
</form>
  </span>
  </div>
  <?php 
}
?>

  </div>

                                <?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Services' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
    <div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> Generation is Allowed for this Franchise</div>
    <?php
}
else
{
?>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


<nav>
   <div style="margin-top: -42px !important;">
                                        <div style="visibility: visible;" id="arrowsalltabs">
<svg id="rightarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 50px !important;z-index: 1 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 50px !important;z-index: 1 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        
        
        
    <div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="position: relative;top: 9px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;padding-bottom: 0.3px !important;">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">Overview</a>  
             
                </div></button>
                <button class="nav-link" id="nav-transactions-tab" data-bs-toggle="tab" data-bs-target="#nav-transactions" type="button" role="tab" aria-controls="nav-transactions" aria-selected="false"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">Transactions</a>  
             
                </div></button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
        <div class="customcont-header ml-0">
    
        <a class="customcont-heading">History</a>   
             
                </div>
        
        </button>
        </div>
  </div>
  
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="table-responsive m-3">
      <table class="table table-bordered" style="width: 100%;table-layout: fixed;">
      <thead>
      <tr>
      <th style="border:1px solid #ddd !important;width: 19%;">DATE</th>
      <th style="border:1px solid #ddd !important;width: 81%;">DETAILS</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='SERVICES' and useid='$id' order by createdon desc");
      while($infouse=mysqli_fetch_array($sqluse))
      {
      ?>
        <tr>
          <td data-label="DATE" id="datehis"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
          <td data-label="DETAILS"><?=$infouse['useremarks']?> <br><span><?=((str_contains($infouse['useremarks'],'SERVICE CREATED'))?'Created By':'Changed By')?></span><span  id="chhis"> <?=$info['createdby']?></span></td>
        </tr>
      <?php
      }
      ?>
      <!-- for selective values get for from and to only -->
      <?php
      // $sqluseft=mysqli_query($con, "select * from pairusehistory where usetype='PRODUCTS' and useid='$companymainid' order by createdon desc");
      // while($infouseft=mysqli_fetch_array($sqluseft))
      // {
      //   $ansfromto = $infouseft['useremarks'];
      //   $finalfromto = explode(' ', $ansfromto);
      ?>
      <!-- <tr>
          <td>
            <?php echo $finalfromto[6]; ?>
              <br>
            <?php echo $finalfromto[8]; ?>  
            <br>
            <?php echo $finalfromto[16]; ?>
              <br>
            <?php echo $finalfromto[18]; ?>  
          </td>
      </tr> -->
      <?php
      // }
      ?>
      <!-- for selective color changes for from and to only -->
      
      </tbody>
      </table>
      </div>
      </div>
  <div class="tab-pane fade" id="nav-transactions" role="tabpanel" aria-labelledby="nav-transactions-tab">
    
	<div class="table-responsive mt-3 p-0 min-height-480">
                                <table id="someTable" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                        <tr>
    <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Date</span></td>
  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Number</span></td>
    <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Type</span></td>
    <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Name</span></td>
    <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Quantity</span></td>
  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Value</span></td>
  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Amount</span></td>
  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:grey;font-weight: 600;">Status</span></td>
                                     </tr>
                                    </thead>
                                    <tbody id="transactionans">
                   <?php
				  $sql=mysqli_query($con, "SELECT 'invoice' as source, id as id, invoiceno as numbersview, invoiceno as numbers, invoicedate as dates, createdon as date_column, customername as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairinvoices WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='$id' GROUP BY invoicedate, invoiceno UNION SELECT 'bill' as source,id as id, billno as numbersview, billno as numbers, billdate as dates, createdon as date_column, vendorname as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairbills WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='$id' GROUP BY billdate, billno UNION SELECT 'creditnote' as source,id as id, creditnoteno as numbersview, creditnoteno as numbers, creditnotedate as dates, createdon as date_column, customername as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM paircreditnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='$id' GROUP BY creditnotedate, creditnoteno UNION SELECT 'debitnote' as source,id as id, debitnoteno as numbersview, debitnoteno as numbers, debitnotedate as dates, createdon as date_column, vendorname as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairdebitnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='$id' GROUP BY debitnotedate, debitnoteno UNION SELECT 'adjustment' as source,id as id, adjustmentno as numbersview, privateid as numbers, adjustmentdate as dates, createdon as date_column, 'None' as names,SUM(newquantity) as qty,'None' as value,'None' as amount,'Adjusted' as status,'Adjusted' as cancelstatus FROM pairadjustments WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='$id' GROUP BY adjustmentdate, adjustmentno order by dates desc, numbers desc limit 20");
	 			  while($infopro=mysqli_fetch_array($sql))
				  {
$statusanswer = "Adjusted";
if($row['cancelstatus']=='1'){
  $statusanswer = "Void";
}
elseif($row['status']=='1'){
  $statusanswer = "Paid";
}
elseif($row['status']=='0'){
  $statusanswer = "Pending";
}
elseif($row['status']=='2'){
  $statusanswer = "Partially Paid";
}
					  ?>
<tr onclick="window.open('<?=$row['source']?>view.php?id=<?=$row['id']?>&<?=$row['source']?>no=<?=$row['numbersview']?>&<?=$row['source']?>date=<?=$row['dates']?>','_self')">
<td data-label="Date"><?=date('d/m/Y', strtotime($row['dates']))?></td>
<td data-label="Number"><?=$row['numbers']?></td>
<td data-label="Type"><?=strtoupper($row['source'])?></td>
<td data-label="Name"><?=$row['names']?></td>
<td data-label="Quantity"><?=$row['qty']?></td>
<td data-label="Value"><?php echo $res[0]; ?> <?=number_format((float)$row['value'],2,'.','')?></td>
<td data-label="Amount"><?php echo $res[0]; ?> <?=number_format((float)$row['amount'],2,'.','')?></td>
<td data-label="Status"><?=$statusanswer?></td>
</tr>
					<?php
				  $count++;
				  }
				  ?>

                                    </tbody>
                                </table>


                            </div>
  </div>
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
     <?php
     // if ((in_array('Service Information', $fieldview))) {
        ?>
      <div class="row">
        <div class="col-lg-9">
<p class="m-3" id="infoheadsall"><?= $infomainaccessuser['modulename'] ?> Details</p>   
</div>  
</div>
<?php
     if ((in_array('Service Code', $fieldview))) {
        ?>
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall"><?= $infomainaccessuser['modulename'] ?> Code</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['productcode']?>
        </div>
      </div>
      <?php
}
?>
 <?php
     if ((in_array('Service Public Code', $fieldview))) {
        ?>
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall"><?= $infomainaccessuser['modulename'] ?> Code Public</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['publicid']?>
        </div>
      </div>
                                                     <?php
                                                 }
        ?>
                                                     <?php
     if ((in_array('Service Private Code', $fieldview))) {
        ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall"><?= $infomainaccessuser['modulename'] ?> Code Private</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['privateid']?>
        </div>
      </div>
                                                     <?php
                                                 }
        ?>
                                                    <?php
     // if ((in_array('Name', $fieldview))) {
        ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['productname']?>
        </div>
      </div>
       <?php
          // }
          ?>
         <?php
     if ((in_array('Code or Tags', $fieldview))) {
        ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Code / Tags</span>
        </div>
        <div class="col-md-8 col-6">
        <?=$info['codetags']?>
        </div>
      </div>
           <?php
          }
          ?>
          <?php
     if ((in_array('Unit', $fieldview))) {
        ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Unit</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['defaultunit']?>
        </div>
      </div>
      <?php
}
?>
<?php
     if ((in_array('SAC Code', $fieldview))) {
        ?>
      <div class="row m-3" id="aligncenterall">
          <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">SAC Code</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['hsncode']?>
        </div>
      </div>
      <?php
}
?>
<!--
      <div class="row m-3" id="aligncenterall">
      <div class="col-sm-3 col-md-2 col-6">
          <span
                                                                            style="font-size: 13px;">SKU <svg data-toggle="tooltip" title="The Stock Keeping of the product" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-bottom: 3px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['hsncode']?>
        </div>
      </div>
      
    <div class="row m-3" id="aligncenterall">
      <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">UPC <svg data-toggle="tooltip" title="Twelve digit unique number associated with the bar code (Universal Product Code)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['hsncode']?>
        </div>
      </div>

      <div class="row m-3" id="aligncenterall">
      <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">EAN <svg data-toggle="tooltip" title="Thirteen digit unique number (International Artical Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['hsncode']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">MPN <svg data-toggle="tooltip" title="Manufacturing Part Number unambiguously identifies a part design" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
      
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">ISBN <svg data-toggle="tooltip" title="Thirteen digit unique commercial book identifier (International Standard Book Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
      
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Brand</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
        
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Manufacturer</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
  
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Molicular Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
  
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Generic Name</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Salt Composition</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Consume Time</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
-->

          <?php
     if ((in_array('Category', $fieldview))) {
        ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Category</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
<?php
}
?>
                                                    <?php
     if ((in_array('Sub Category', $fieldview))) {
        ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Sub Category</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['subcategory']?>
        </div>
      </div>
      <?php
}
?>
<!--
    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Dimensions</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Weight</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>

    <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Rack</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['category']?>
        </div>
      </div>
-->
<?php
     if ((in_array('Delivery', $fieldview))) {
        ?>
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Delivery</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['delivery']?>
        </div>
      </div>
       <?php
}
?>
                                                    <?php
     if ((in_array('Description', $fieldview))) {
        ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Description</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['description']?>
        </div>
      </div>
      <?php
}
?>
      <hr>
     <?php
// }
?>
  <?php
     if ((in_array('Service Visibility', $fieldview))) {
        ?>
                                                      <?php
                                                        $sqlvis=mysqli_query($con,"select * from pairproducts where id='$id' and itemmodule='Services'");
                                                        $ansvis=mysqli_fetch_array($sqlvis);
                                                    ?>
    <p class="m-3" id="infoheadsall"><?= $infomainaccessuser['modulename'] ?> Visibility</p>   
    
<div class="row m-3" id="aligncenterall">
    <div class="col-lg-6">
        <div class="form-group row">
        <div class="col-sm-4">
          <span id="insideheadall">Visibility</span>
        </div>
        <div class="col-sm-8">
          <div class="row">
                      <div class="col-sm-6" style="z-index: 0;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="visibility" id="visibility" value="0" <?= $ansvis['pvisiblity']=='PUBLIC'?'checked':'' ?>  disabled>
                        <label class="custom-control-label custom-label" for="visibility">Public</label>
                      </div>
                      
                      </div>
                      <div class="col-sm-6" style="z-index: 0;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="visibility" id="novisibility" value="1" <?= $ansvis['pvisiblity']=='PRIVATE'?'checked':'' ?>  disabled>
                        <label class="custom-control-label custom-label" for="novisibility">Private</label>
                      </div>
                      
                      </div>
                  </div>
        </div>
        </div>
        </div>
      </div>

      <hr>
       <?php
                                    }
                                    ?>
                                    <!--
                                    <?php
                                                     if($permissionproimage!='0'){
                                                    ?>
                                                    <?php
                                                     if($permissionproimgview!='0'){
                                                    ?>
<p class="m-3" id="infoheadsall">Product Image</p>    
      
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Description</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['description']?>
        </div>
      </div>

      <hr>
      <?php
                                    }
                                  }
                                    ?>
                                    <?php
                                                     if($permissionpropurchase!='0'){
                                                    ?>
                                                    <?php
                                                     if($permissionpropurview!='0'){
                                                    ?>
<p class="m-3" id="infoheadsall">Purchase Information</p>     
      
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Account</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['purchaseaccounttype']?>
        </div>
      </div>


      <hr>
        <?php
                                    }
                                  }
                                    ?>-->
                                    <?php
     if ((in_array('Sales Information', $fieldview))) {
        ?>
<p class="m-3" id="infoheadsall"><?= $salehead ?> Information</p>  
<?php
$sqlisale=mysqli_query($con, "select * from pairprosale where productid='".$id."' and itemmodule='Services'");
$sale=mysqli_fetch_array($sqlisale);
?>   
<?php
                                                     if((in_array('Sale Price Name', $fieldview))||(in_array('Sale MRP', $fieldview))||(in_array('Sale Price Rate', $fieldview))||(in_array('Sale Description', $fieldview))){
                                                    ?>
      <div class="row" id="newproservtable">
        <div class="col-lg-8">
                                                        <div class="table-responsive">
  <table class="table table-bordered" id="saletable">
<thead>
<tr><td class="text-uppercase" id="firstclsale"><span id="tdfsize"></span></td>
<?php
                                                     if((in_array('Sale Price Name', $fieldview))){
                                                    ?>
    <td class="text-uppercase" id="secondclsale"><span id="tdfsize">PRICE NAME</span></td>
    <?php
                                    }
                                    ?>
<?php
                                                     if((in_array('Sale MRP', $fieldview))){
                                                    ?>
    <td class="text-uppercase" id="thirdclsale"><span id="tdfsize">MRP</span> <svg style="height: 15px !important;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <?php
                                    }
                                    ?>
<?php
                                                     if((in_array('Sale Price Rate', $fieldview))){
                                                    ?>
        <td class="text-uppercase" id="fourthclsale"><span id="tdfsize">PRICE/RATE</span> <svg style="height: 15px !important;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <?php
                                    }
                                    ?>
<?php
                                                     if((in_array('Sale Description', $fieldview))){
                                                    ?>
        <td class="text-uppercase" id="fifthclsale"><span id="tdfsize">DESCRIPTION</span></td>
        <?php
                                    }
                                    ?>
                                    <td class="text-uppercase" id="sixthclsale"><span id="tdfsize"></span></td></tr>
</thead>
<tbody>
<tr>
<td data-label=""><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<?php
                                                     if((in_array('Sale Price Name', $fieldview))){
                                                    ?>
<td data-label="PRICE NAME"><span id="insideheadall"><?=$sale['salename']?></span></td>
<?php
                                    }
                                    ?>

<?php
                                                     if((in_array('Sale MRP', $fieldview))){
                                                    ?>
<td data-label="MRP">
    <span style="border:0px solid grey;font-size: 13px !important"><?php echo $res[0]; ?></span>
    <span id="insideheadall"><?=$sale['salemrp']?></span>
</td>
<?php
                                    }
                                    ?>
<?php
                                                     if((in_array('Sale Price Rate', $fieldview))){
                                                    ?>
<td data-label="SELLING PRICE"><span style="border:0px solid grey;font-size: 13px !important"><?php echo $res[0]; ?></span><span id="insideheadall"><?=$sale['salecost']?></span></td>
<?php
                                    }
                                    ?>
<?php
                                                     if((in_array('Sale Description', $fieldview))){
                                                    ?>
<td data-label="DESCRIPTION"><span id="insideheadall"><?=$sale['saledescription']?></span></td>
<?php
                                    }
                                    ?>
<td data-label=""><a onclick="addclick()" id="intusymbol"><svg style="height: 15px !important;" width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-deletes" id="intusymbol"><img src="assets/img/delete-row.png" width="15" height="15" id="imgintusymbol"></a></td>
</tr>
    <!-- <tr id="none" style="display: ;"> </tr>--> 

</tbody>
</table>
</div>
</div>
</div>
<?php
}
?>
      <hr>
       <?php
                                    }
                                    ?>


                                   <?php
     if ((in_array('Purchase Information', $fieldview))) {
        ?>
<p class="m-3" id="infoheadsall"><?= $purhead ?> Information</p>   
<?php
$sqlipur=mysqli_query($con, "select * from pairpropurchase where productid='".$id."' and itemmodule='Services'");
$pur=mysqli_fetch_array($sqlipur);
?>   
<?php
                                                     if((in_array('Purchase Price Name', $fieldview))||(in_array('Purchase MRP', $fieldview))||(in_array('Purchase Price Rate', $fieldview))||(in_array('Purchase Description', $fieldview))){
                                                    ?>
      <div class="row" id="newproservtable">
        <div class="col-lg-8">
                                                        <div class="table-responsive">
  <table class="table table-bordered" id="purchasetable">
<thead>
<tr><td class="text-uppercase" id="firstclsale"><span id="tdfsize"></span></td>
<?php
                                                     if((in_array('Purchase Price Name', $fieldview))){
                                                    ?>
    <td class="text-uppercase" id="secondclsale"><span id="tdfsize">PRICE NAME</span></td>
    <?php
                                    }
                                    ?>
                                    <?php
                                                     if((in_array('Purchase MRP', $fieldview))){
                                                    ?>
    <td class="text-uppercase" id="thirdclsale"><span id="tdfsize">MRP</span> <svg style="height: 15px !important;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Inclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <?php
                                    }
                                    ?>
<?php
                                                     if((in_array('Purchase Price Rate', $fieldview))){
                                                    ?>
        <td class="text-uppercase" id="fourthclsale"><span id="tdfsize">PRICE/RATE</span> <svg style="height: 15px !important;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-sm align-text-top" data-toggle="tooltip" title="Exclusive of Tax">
    <path d="M256.4 31.9c30.2 0 59.4 5.9 87 17.5 26.6 11.2 50.4 27.4 71 47.9 20.5 20.5 36.6 44.3 47.9 71 11.6 27.6 17.5 56.7 17.5 87s-5.9 59.4-17.5 87c-11.2 26.6-27.4 50.4-47.9 71-20.5 20.5-44.3 36.6-71 47.9-27.6 11.6-56.7 17.5-87 17.5s-59.4-5.9-87-17.5c-26.6-11.2-50.4-27.4-71-47.9-20.5-20.5-36.6-44.3-47.9-71-11.6-27.6-17.5-56.7-17.5-87s5.9-59.4 17.5-87c11.2-26.6 27.4-50.4 47.9-71s44.3-36.6 71-47.9c27.5-11.6 56.7-17.5 87-17.5m0-31.9C114.3 0 0 114.3 0 255.4s114.3 255.4 255.4 255.4 255.4-114.3 255.4-255.4S396.4 0 255.4 0z"></path>
    <path d="M303.4 351.1h-8.2c-4.4 0-8-3.6-8-8v-94.4c0-15.3-11.4-28-26.6-29.7-2.5-.3-4.8-.5-6.7-.5-23.6 0-44.4 11.9-56.8 30l-.1.1v-.1c-1 2-1.7 5.2.7 6.5.6.3 1.2.5 1.8.5h15.9c4.4 0 8 3.6 8 8v79.8c0 4.4-3.6 8-8 8h-8.1c-8.7 0-15.8 7.1-15.8 15.8v.3c0 8.7 7.1 15.8 15.8 15.8h96.1c8.7 0 15.8-7.1 15.8-15.8v-.3c0-8.9-7.1-16-15.8-16zM255.4 127.7c-17.6 0-31.9 14.3-31.9 31.9s14.3 31.9 31.9 31.9 31.9-14.3 31.9-31.9-14.3-31.9-31.9-31.9z"></path>
    <svg></td>
        <?php
                                    }
                                    ?>
                                    <?php
                                                     if((in_array('Purchase Description', $fieldview))){
                                                    ?>
        <td class="text-uppercase" id="fifthclsale"><span id="tdfsize">DESCRIPTION</span></td>
        <?php
                                    }
                                    ?>
                                    <td class="text-uppercase" id="sixthclsale"><span id="tdfsize"></span></td></tr>
</thead>
<tbody>
<tr>
<td data-label=""><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<?php
                                                     if((in_array('Purchase Price Name', $fieldview))){
                                                    ?>
<td data-label="PRICE NAME"><span id="insideheadall"><?=$pur['purchasename']?></span></td>
<?php
                                    }
                                    ?>

<?php
                                                     if((in_array('Purchase MRP', $fieldview))){
                                                    ?>
<td data-label="MRP">
    <span style="border:0px solid grey;font-size: 13px !important"><?php echo $res[0]; ?></span>
    <span id="insideheadall"><?=$pur['purchasemrp']?></span>
</td>
<?php
                                    }
                                    ?>
                                    <?php
                                                     if((in_array('Purchase Price Rate', $fieldview))){
                                                    ?>
<td data-label="SELLING PRICE"><span style="border:0px solid grey;font-size: 13px !important"><?php echo $res[0]; ?></span><span id="insideheadall"><?=$pur['purchasecost']?></span></td>
<?php
                                    }
                                    ?>
                                    <?php
                                                     if((in_array('Purchase Description', $fieldview))){
                                                    ?>
<td data-label="DESCRIPTION"><span id="insideheadall"><?=$pur['purchasedescription']?></span></td>
<?php
                                    }
                                    ?>
<td data-label=""><a onclick="addclick()" id="intusymbol"><svg style="height: 15px !important;" width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-deletes" id="intusymbol"><img src="assets/img/delete-row.png" width="15" height="15" id="imgintusymbol"></a></td>
</tr>
    <!-- <tr id="none" style="display: ;"> </tr>--> 
</tbody>
</table>
</div>
</div>
</div>
<?php
}
?>
      <hr>
      <?php
                                    }
                                    ?>




                                    <?php
                                                     if((in_array('Tax Information', $fieldview))){
                                                    ?>
<p class="m-3" id="infoheadsall">Tax Information</p>      
<?php
                                                     if((in_array('Tax Preference', $fieldview))){
                                                    ?>
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Tax Preference</span>
        </div>
        <div class="col-md-8 col-6">
                  
            <div class="row">
                      <div class="col-lg-5" style="z-index: 0;">
          <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="taxpreference" id="taxpreftaxable" value="1" <?=($info['taxpref']==1)?'checked':'';?> disabled >
                        <label class="custom-control-label custom-label" for="taxpreftaxable"> Taxable</label>
                      </div>
                  </div>
                  <!-- <div class="col-lg-5 " style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="taxpreference" id="taxprefnontaxable" value="0" <?=($info['taxpref']==0)?'checked':'';?> disabled >
                        <label class="custom-control-label custom-label" for="taxprefnontaxable"> Non Taxable</label>
                      </div>
                  </div> -->
              </div>
        </div>
      </div>
      <?php
                                    }
                                    ?>
      <div id="taxablediv">
        <?php
                                                     if((in_array('Tax Rate', $fieldview))){
                                                    ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Tax Rate</span>
        </div>
        <div class="col-md-8 col-6">
           <div class="input-group input-group-sm" id="flaghead">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text" id="flagin">
                                                                                            <img src="assets/img/Indian-Flag.png"
                                                                                                width="25"
                                                                                                height="20" disabled></span> 
                                                                                    </div>
                                                                                     <?php
                                                                                    $country=mysqli_query($con,"select * from paricountry");
                                                                                    $india=mysqli_fetch_array($country);
                                                                                    ?>
                                                                                    <input type="text"
                                                                                        class="country"
                                                                                        id="taxratecountry"
                                                                                        name="taxratecountry"
                                                                                        value="<?= $india['country'] ?>" readonly style="width: 60px !important;">
                                                                                </div>
        </div>
      </div>
      <?php
                                    }
                                    ?>
                                    <?php
            $sqlinew=mysqli_query($con, "select * from pairproducts where createdid='$companymainid' and ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and itemmodule='Services' order by productname asc");
            $infonew=mysqli_fetch_array($sqli);
            $sqlitax=mysqli_query($con, "select * from pairtaxrates where id='".$info['intratax']."'");
            $infotax=mysqli_fetch_array($sqlitax);
            $sqlitaxs=mysqli_query($con, "select * from pairtaxrates where id='".$info['intertax']."'");
            $infotaxs=mysqli_fetch_array($sqlitaxs);
            ?>
                                                                
                                                                <?php
                                                     if((in_array('Intra State Tax Rate', $fieldview))){
                                                    ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall" style="border-bottom: 1px dashed grey;">Intra State Tax Rate</span>
        </div>
        <div class="col-md-8 col-6">
            <?php 
            if ($info['intratax']!='null') {
                ?>
           <?=$infotax['tax']?> - <?=$infotax['taxname']?>
           <?php
       }
       ?>
        </div>
      </div>
      <?php
                                    }
                                    ?>
                                                                <?php
                                                     if((in_array('Inter State Tax Rate', $fieldview))){
                                                    ?>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall" style="border-bottom: 1px dashed grey;">Inter State Tax Rate</span>
        </div>
        <div class="col-md-8 col-6">
             <?php 
            if ($info['intertax']!='null') {
                ?>
           <?=$infotaxs['tax']?> - <?=$infotaxs['taxname']?>
           <?php
       }
       ?>
        </div>
      </div>
      <?php
                                    }
                                    ?>
</div>
      <!-- <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Exemption Reason</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['excemptionreason']?>
        </div>
      </div> -->

      <hr>
      <?php
                                    }
                                    ?>
                                    <!--
                                    <?php
                                                     if($permissionproinventory!='0'){
                                                    ?>
                                                     <?php
                                                     if($permissionproinvview!='0'){
                                                    ?>
<p class="m-3" id="infoheadsall">Inventory Information</p>    
      
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Track Inventory for this Item</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Inventory Account Type</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['inventoryaccounttype']?>
        </div>
      </div>

      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Opening Stock</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['openingstock']?>
        </div>
      </div>

      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Opening Stock Rate per Unit</span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['openingstockrate']?>
        </div>
      </div>
      <hr>
<?php
                                    }
                                  }
                                    ?>
                                    <?php
                                                     if($permissionprostock!='0'){
                                                    ?>
                                                     <?php
                                                     if($permissionprostkview!='0'){
                                                    ?>
<p class="m-3" id="infoheadsall">Stock Information</p>   
    
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Reorder Point <svg data-toggle="tooltip" title="Thirteen digit unique number (International Artical Number)" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>
      <hr>
<?php
                                    }
                                  }
                                    ?>
                                    <?php
                                                     if($permissionproother!='0'){
                                                    ?>
                                                    <?php
                                                     if($permissionproothview!='0'){
                                                    ?>
      <p class="m-3" id="infoheadsall">Other Information</p>   
    
<div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">P.T.R <svg data-toggle="tooltip" title="P.T.R" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">P.T.S <svg data-toggle="tooltip" title="P.T.S" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">Member Discount <svg data-toggle="tooltip" title="Member Discount" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>
      <div class="row m-3" id="aligncenterall">
        <div class="col-sm-3 col-md-2 col-6">
          <span id="insideheadall">DCC Discount <svg data-toggle="tooltip" title="DCC Discount" style="color: #777777;width: 14;height: 14;cursor: pointer;margin-top: 1.5px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle mb-1" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></span>
        </div>
        <div class="col-md-8 col-6">
           <?=$info['trackinventory']?>
        </div>
      </div>-->
      
      
  </div>
   <?php
                                    }
                                }
                                    ?>
  
  
</div>

              
            
            </div>
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
<script type="text/javascript">
var sIndex = 20, offSet = 20, isPreviousEventComplete = true, isDataAvailable = true;
$('.main-content').on('scroll', function() {
var scrollTop = $(this).scrollTop();
if (scrollTop + $(this).innerHeight() >= this.scrollHeight-50) {
if (isPreviousEventComplete && isDataAvailable) {
isPreviousEventComplete = false;
$("#loadimg").css("display","block");
console.log('ss');
// ajax for get
$.ajax({
type: "GET",
url: 'transactionfetch.php?term=' + sIndex + '&types=service&id=<?=$_GET['id']?>',
success: function (result) {
$("#transactionans").append(result);
sIndex = sIndex + offSet;
isPreviousEventComplete = true;
if (result == '') //When data is not available
isDataAvailable = false;
$("#loadimg").css("display","none");
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
}
}
});
</script>
<script type="text/javascript">
$(document).ready(function() {
$('[data-toggle="tooltip"]').tooltip();
});
</script>

 <script src="assets/js/bootstrap-toggle.min.js"></script>
  
 
</body>

</html>
<?php
}
else
{
    header("Location: services.php?error=No Information Found");
}
}
else
{
    header("Location: services.php?error=No Information Found");
}
?>