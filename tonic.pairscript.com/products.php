<?php
include('lcheck.php');
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Products' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}

$typesforlisting = "";
$typesforlistingstock = "";
$nameshowinglisting = "All";
if ($infomainaccessuser['filtertypesforlistsorting']=='All') {
  $typesforlisting = "";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Active'){
  $typesforlisting = "AND t1.isactive=0";
  $nameshowinglisting = "Active";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='Inactive'){
  $typesforlisting = "AND t1.isactive=1";
  $nameshowinglisting = "Inactive";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='StockAvailable'){
  $typesforlistingstock = "HAVING SUM(t2.quantity) > 0";
  $nameshowinglisting = "Stock Available";
}
elseif($infomainaccessuser['filtertypesforlistsorting']=='StockUnavailable'){
  $typesforlistingstock = "HAVING SUM(t2.quantity) < 1";
  $nameshowinglisting = "Stock Unavailable";
}

$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
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
          <script type="text/javascript" src="https://unpkg.com/react@18/umd/react.development.js"></script>
          <script type="text/javascript" src="https://unpkg.com/react-dom@18/umd/react-dom.development.js"></script>
          <script type="text/javascript" src="https://unpkg.com/dayjs@1/dayjs.min.js"></script>
          <script type="text/javascript" src="https://unpkg.com/antd@5.11.0/dist/antd-with-locales.js"></script>
          <script type="text/javascript" src="https://unpkg.com/@ant-design/icons/dist/index.umd.js"></script>
          <script type="text/javascript" src="https://unpkg.com/react-router-dom/dist/umd/react-router-dom.production.min.js"></script>
          <script type="text/javascript" src="https://unpkg.com/react-router/dist/umd/react-router.production.min.js"></script>
    <?php
include('externals.php');
?>
    <title>
        Products - Dmedia
    </title>
    


        <script type="text/javascript">
          function checkscrolltouch() {
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrow').style.visibility = 'hidden';
            document.getElementById('leftarrow').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrow').style.visibility = 'visible';
            document.getElementById('rightarrow').style.visibility = 'visible';
          }
            }
          }
          function leftarrow() {
            document.getElementById('nav-tab').scrollLeft += -90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrow() {
            document.getElementById('nav-tab').scrollLeft += 90;
            var width = $('#nav-tab').outerWidth()
            var scrollWidth = $('#nav-tab')[0].scrollWidth; 
            var scrollLeft = $('#nav-tab').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrow').style.visibility = 'hidden';
            }
            document.getElementById('leftarrow').style.visibility = 'visible';
          }
        </script>
        <script type="text/javascript">   
$(document).ready(function() {
function isOverflown(element) {
return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
var el = document.getElementById("nav-tab");
isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
window.onresize = function (event) {
applyOrientation();
}         
function applyOrientation() {
function isOverflown(element) {
return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}
var el = document.getElementById("nav-tab");
isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
}
});
</script>
        <style type="text/css">

#dropdownMenuButton111check .nav-link.active{
  background-color: #1BBC9B !important;
}

#dropdownMenuButton111check .nav-link:hover{
  background-color: #1BBC9B !important;
}

        #nav-tab::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#nav-tab::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#nav-tab::-webkit-scrollbar-track {
  background-color: green;
}

#nav-tab::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#nav-tab::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
.nav-tabs button{
    margin-bottom: 2px !important;
}
.nav-tabs .customcont-header{
    border-bottom: 0px !important;
}

@media screen and (max-width: 560px){
  #arrowsalltabs{
    visibility: visible !important;
  }
}
@media screen and (min-device-width: 561px) and (max-device-width: 3000px){
  #arrowsalltabs{
    visibility: hidden !important;
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
                                <?php
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
                                ?>

            <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <div class="row">
                                    <div class="col-lg-6"> 
                    <div class="app-utility-item app-user-dropdown dropdown">
                      <a class="p-0 mac" id="dropdownMenuButton111" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-caret-down" style="color: #3c3c46 !important;position: relative;font-size: 18px;"></i></a>
                      <div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownMenuButton111" style="max-height: 0px;max-width: 0px;">
                        <div style="background-color: #3c3c46;margin-top: -39px !important;position: relative !important;left: 145px !important;" id="dropdownMenuButton111check">
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='All')?'active':'')?>" href="#" style="color: #fff;padding: 6px !important;" onclick="submitthesorting('All')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> All</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Active')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Active')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Active</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='Inactive')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('Inactive')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Inactive</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='StockAvailable')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('StockAvailable')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Stock Available</span>
                          </a>
                          <a class="nav-link <?=(($infomainaccessuser['filtertypesforlistsorting']=='StockUnavailable')?'active':'')?>" href="#" style="color: #fff;padding: 6px 3px !important;" onclick="submitthesorting('StockUnavailable')">
                            <!-- <i class="fa fa-sign-out-alt"></i> -->
                            <span class="nav-link-text ms-2"> Stock Unavailable</span>
                          </a>
                        </div>
                      </div>
                    </div>
                                <p class="mb-5" style="color:black;font-size:20px;margin-top: -28px;margin-left: 18px;"> <?= $infomainaccessuser['modulename'] ?> </p>
                  <!-- </p> -->
                            </div>
								<!-- <div class="row"> -->
                                 <!-- <div class="col-lg-9"> -->
                                 <!-- </div> -->
                                 <div class="col-lg-3" style="margin-bottom: 57px !important;"> 
                                 <input class="form-control" id="myInput" type="text" placeholder="Search.." style="height:24px;">
                                  </div> 
                                 </div>
                             <!-- </div>     -->
                             <?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Products' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccesscreate']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
                                 ?>
								<div class="p-2" align="right">
								<div class="row" style="width:250px;">

								
								<div class="col-8">
								
								
								<a href="productadd.php" class="btn btn-custom btn-sm p-2 add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: -151px;margin-right:-39px;padding-right: 5px;"><p style="width: max-content;margin-top:-7px;margin-left: -3px;padding: 0px;margin-right: -3px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $infomainaccessuser['modulename'] ?></span></p></a>
								</div>
								<?php
								//if($_SESSION['franchisesession']=='1')
								// {
								?>
								<div class="col-4">
								<div class="dropdown" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: -90px;margin-right:-18px;padding: 0.2rem 0.75rem;">
  <button class="btn btn-sm btn-custom-grey dropdown-toggle addmenu" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="height:24px;">
	  <i class="fa fa-bars" style="position: relative;top:-4.5px;"></i>
  </button>
<?php
if ((in_array('Import', $modulecolumns))) {
?>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
    <li><a class="dropdown-item" href="productimport.php"><i class="fa fa-download"></i> Product Import</a></li>
  </ul>
<?php
}
?>
</div>
								
								</div>								
								<?php 
								// }
								?>
								
								</div>

											
                                        </div>
                                        <br>
                                        <?php 
                            }
                            else{
                                ?>
                            <br>
                            <br>
                            <br>
                                <?php
                            }
                            ?>

                                <?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Products' order by id  asc");
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
<div style="visibility: visible;" id="arrowsalltabs">
      <svg id="rightarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 60px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;visibility: hidden;">
         <path d="M0 0h24v24H0z" fill="none"></path>
         <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
      </svg>
      <svg id="leftarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 60px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
         <path d="M0 0h24v24H0z" fill="none"></path>
         <path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
      </svg>
   </div>
   <div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="position: relative;top: -145px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;">
      <button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true" style="background-color: transparent !important;">
         <div class="customcont-header ml-0">
            <a class="customcont-heading"><?=$nameshowinglisting?> <?=$infomainaccessuser['modulename']?></a>
         </div>
      </button>
   </div>
   <div class="tab-content" id="nav-tabContent" style="position:relative;top: -88px;">
      <div class="tab-pane fade show active p-3" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
                            <div class="table-responsive p-0 min-height-480" style="margin-top: -54px;">
                                <table id="someTable" class="table align-items-center table-bordered mb-0" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <?php
         // if ((in_array('Name', $modulecolumns))) {
        ?>
                                            <td class="text-uppercase name" style="width:50px;"
                                                id="name"><span style="font-size:13px;color:black;">Name</span></td>
           <?php
          // }
          ?>
<?php
         if ((in_array('Code', $modulecolumns))) {
        ?>
												<td class="text-uppercase code" style="width:20px;"
                                                id="code"><span style="font-size:13px;color:black;">Code</span></td>
                                                <?php
          }
          ?>
<?php
         if ((in_array('Category', $modulecolumns))) {
        ?>
												<td class="text-uppercase category" style="width:25px;"><span style="font-size:13px;color:black;"><?=$access['txtnamecategory']?></span></td>
                                                <?php
          }
          ?>
<?php
         if ((in_array('Unit', $modulecolumns))) {
        ?>
												<td class="text-uppercase unit" style="width:18px;"
                                                id="unit"><span style="font-size:13px;color:black;">Unit</span></td>
                                                <?php
          }
          ?>
<?php
         if ((in_array('Description', $modulecolumns))) {
        ?>
												<td class="text-uppercase description" style="width:30px;"
                                                id="description"><span style="font-size:13px;color:black;">Description</span></td>
                                                <?php
          }
          ?>
<?php
         if ((in_array('Delivery', $modulecolumns))) {
        ?>
												<td class="text-uppercase delivery" style="width:30px;"
                                                id="delivery"><span style="font-size:13px;color:black;">Delivery</span></td>
                                                <?php
          }
          ?>
<?php
         if ((in_array('Sale Price', $modulecolumns))) {
        ?>
												<td class="text-uppercase saleprice" style="width:20px;"
                                                id="saleprice"><span style="font-size:13px;color:black;">Sale Price</span></td>
                                                <?php
          }
          ?>
<?php
         if ((in_array('Intra Tax', $modulecolumns))) {
        ?>
												<td class="text-uppercase intratax" style="width:25px;"
                                                id="intratax"><span style="font-size:13px;color:black;">Intratax</span></td>
                                                <?php
          }
          ?>
<?php
         if ((in_array('Visibility', $modulecolumns))) {
        ?>
												<td class="text-uppercase visibility" style="width:23px;"
                                                id="visibility"><span style="font-size:13px;color:black;">Visibility</span></td>
                                                <?php
          }
          ?>
<?php
         if ((in_array('Stock On Hand', $modulecolumns))) {
        ?>
                        <td class="text-uppercase stock" style="width:25px;"
                                                id="stock"><span style="font-size:13px;color:black;">Stock On Hand</span></td>
                                                <?php
          }
          ?>
<?php
         if ((in_array('Status', $modulecolumns))) {
        ?>
												<td class="text-uppercase status" style="width:21px;"
                                                id="status"><span style="font-size:13px;color:black;">Status</span></td>
                                                <?php
          }
          ?>
<?php
         if ((in_array('Edit', $modulecolumns))) {
        ?>
                                                <td class="text-uppercase status" style="width:10px;"
                                                id="status"><span style="font-size:13px;color:black;">Edit</span></td>
                                                <?php
          }
          ?>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        <?php
        
				  $count=1;
				  $sqli=mysqli_query($con, "select t1.*,SUM(t2.quantity) as stockonproduct from pairproducts t1,pairbatch t2 where t1.createdid='$companymainid' and ((t1.franchisesession='".$_SESSION["franchisesession"]."' and t1.pvisiblity='PRIVATE') or t1.pvisiblity='PUBLIC') and t1.itemmodule='Products' and t2.createdid='$companymainid' and t2.franchisesession='".$_SESSION["franchisesession"]."' and t2.productid=t1.id ".$typesforlisting." GROUP BY t1.id ".$typesforlistingstock."  order by t1.productname asc limit ".(($access['propageload']=='pagenum')?'10':'15')."");
                 
                 
                  while($info=mysqli_fetch_array($sqli))
				  {
            $sqlstocktotal=mysqli_query($con,"SELECT id, batch, expdate, productrate, mrp, noofpacks, sum(quantity) as total, mrp, vat FROM pairbatch where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='".$info['id']."'");
$infostocktotal=mysqli_fetch_array($sqlstocktotal);
					  $sqlias=mysqli_query($con, "select salecost from pairprosale where productid='".$info['id']."'");
					  if(mysqli_num_rows($sqlias)>0)
					  {
							$infoas=mysqli_fetch_array($sqlias);
							$salecost=(float)$infoas['salecost'];
					  }
					  else
					  {
						  $salecost=0;
					  }
					  $sqlitax=mysqli_query($con, "select * from pairtaxrates where id='".$info['intratax']."'");
					  if(mysqli_num_rows($sqlitax)>0)
					  {
					  $infotax=mysqli_fetch_array($sqlitax);
					  $tax=(float)$infotax['tax'];
					  $taxname=$infotax['taxname'];
					  }
					  else
					  {
						  $tax=0;
						  $taxname=0;
					  }
					  ?>
                                        <tr style="font-size: 0.775rem !important;"
 onclick="window.open('productview.php?id=<?=$info['id']?>', '_self')">
<?php
         // if ((in_array('Name', $modulecolumns))) {
        ?>
                                            <td data-label="Name"><span style="color:#1878F1" class="mb-0 text-sm"><?=(($info['productname']=='')?'&nbsp;':$info['productname'])?></span></td>
											<?php
          // }
          ?>
<?php
         if ((in_array('Code', $modulecolumns))) {
        ?>
											<td data-label="Code"><?=(($info['codetags']=='')?'&nbsp;':$info['codetags'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Category', $modulecolumns))) {
        ?>
											<td data-label="<?=$access['txtnamecategory']?>"><?=(($info['category']==' ')?'&nbsp;':$info['category'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Unit', $modulecolumns))) {
        ?>
											<td data-label="Unit"><?=(($info['defaultunit']=='')?'&nbsp;':$info['defaultunit'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Description', $modulecolumns))) {
        ?>
											<td data-label="Description"><?=(($info['description']=='')?'&nbsp;':$info['description'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Delivery', $modulecolumns))) {
        ?>
											<td data-label="Delivery"><?=(($info['delivery']=='')?'&nbsp;':$info['delivery'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Sale Price', $modulecolumns))) {
        ?>
											<td data-label="Sale Price">&nbsp;<?=number_format((float)$salecost,2,".","")?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Intra Tax', $modulecolumns))) {
        ?>
											<td data-label="Intratax"><?=(($info['intratax']=='null')?'&nbsp;':'')?>
                                                 <?php
           if ($info['intratax']!='null') {
           ?>
                                                <?= $taxname ?> - <?=number_format((float)$tax,2,".","")?> 
                                                <?php
       }
       ?>
                                            </td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Visibility', $modulecolumns))) {
        ?>
											<td data-label="Visibility">&nbsp;<?=$info['pvisiblity']?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Stock On Hand', $modulecolumns))) {
        ?>
                      <td data-label="Stock" class="<?=(($info['stockonproduct']>0)?'text-success':'text-danger')?>">&nbsp;<?=(($info['stockonproduct']>0)?$info['stockonproduct']:$info['stockonproduct'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Status', $modulecolumns))) {
        ?>
											<td data-label="Status">
											<?php if($info['isactive']=='0')
											{
											?>
											<span class="badge badge-sm mybadge" style="text-transform:none; font-weight:normal">Active</span>
											<?php           
											}
											else
											{
											  ?>
											<span class="badge badge-sm mybadge bg-danger" style="text-transform:none; font-weight:normal">Inactive</span>
											<?php
											}
											?></td>
           <?php
          }
          ?>
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="productedit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
										</tr>
									<?php
										$count++;
									  }
$sqltotlist = mysqli_query($con,"select t1.*,SUM(t2.quantity) as stockonproduct from pairproducts t1,pairbatch t2 where t1.createdid='$companymainid' and ((t1.franchisesession='".$_SESSION["franchisesession"]."' and t1.pvisiblity='PRIVATE') or t1.pvisiblity='PUBLIC') and t1.itemmodule='Products' and t2.createdid='$companymainid' and t2.franchisesession='".$_SESSION["franchisesession"]."' and t2.productid=t1.id ".$typesforlisting." GROUP BY t1.id ".$typesforlistingstock."  order by t1.productname asc");
$sqlfetlistofzero = 0;
while($sqlfetlist = mysqli_fetch_array($sqltotlist)){
  $sqlfetlistofzero++;
}
if ($sqlfetlistofzero==0) {
$pageinitnum = 0;
}
if ($sqlfetlistofzero!=0) {
$pageinitnum = 1;
}
if (($sqlfetlistofzero>=1)&&($sqlfetlistofzero<=10)) {
$pagetotnum = 1;
}
else if (($sqlfetlistofzero==0)) {
$pagetotnum = 0;
}
else{
$pagetotnum = ceil($sqlfetlistofzero/10);
}
									?>

                                    </tbody>
                                </table>
                                <div style="text-align: center !important;display: none;" id="loadimg">
                                    <img src="loading.gif" alt="Loading..." style="margin-top: -60px;" id="loadimgins">
                                </div>
<?php
if ($access['propageload']=='pageauto') {
?>
<script type="text/javascript">
var sIndex = 15, offSet = 15, isPreviousEventComplete = true, isDataAvailable = true;
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
url: 'listprosearch.php?term=' + sIndex + '&limitings=15&typesforlisting=<?=$typesforlisting?>&typesforlistingstock=<?=$typesforlistingstock?>',
success: function (result) {
$("#myTable").append(result);
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
<?php
}
?>
<?php
if ($access['propageload']=='pagenum') {
?>
<br>
<input type="hidden" value="10" id="limitforpagenum">
<div id="pagenumcontainer" style="padding: 24px;text-align: center;">
</div>
<script>
const mountNode = document.getElementById('pagenumcontainer');
"use strict";
const { createRoot } = ReactDOM;
const { Pagination } = antd;
// Total ${range[0]} - ${range[1]} of ${total} (Datas)
const App = () => (React.createElement(Pagination, { total: <?=ceil($sqlfetlistofzero)?>, showSizeChanger: true, showQuickJumper: true, showTotal: (total, range) => `Total ${range[0]} - ${range[1]} of ${total} items`,
        onChange: pagechanges }));
const ComponentDemo = App;
createRoot(mountNode).render(React.createElement(ComponentDemo, null));
const pagechanges = (page, pageSize) => {
// alert('Page changed to'+ page+'Items per page:'+ pageSize);
$('#limitforpagenum').val(parseInt(pageSize));
if ($('#limitforpagenum').val()==10) {
var totalpagesnumber = <?=ceil($sqlfetlistofzero/10)?>;
if ((page=='')||(page==0)) {
var isthisval = 1;
}
else if(page>totalpagesnumber){
var isthisval = totalpagesnumber;
}
else{
var isthisval = page;
}
var perpages = ''+((parseInt(isthisval)-1)*10);
}
else if ($('#limitforpagenum').val()==20) {
var totalpagesnumber = <?=ceil($sqlfetlistofzero/20)?>;
if ((page=='')||(page==0)) {
var isthisval = 1;
}
else if(page>totalpagesnumber){
var isthisval = totalpagesnumber;
}
else{
var isthisval = page;
}
var perpages = ''+((parseInt(isthisval)-1)*20);
}
else if ($('#limitforpagenum').val()==50) {
var totalpagesnumber = <?=ceil($sqlfetlistofzero/50)?>;
if ((page=='')||(page==0)) {
var isthisval = 1;
}
else if(page>totalpagesnumber){
var isthisval = totalpagesnumber;
}
else{
var isthisval = page;
}
var perpages = ''+((parseInt(isthisval)-1)*50);
}
else if ($('#limitforpagenum').val()==100) {
var totalpagesnumber = <?=ceil($sqlfetlistofzero/100)?>;
if ((page=='')||(page==0)) {
var isthisval = 1;
}
else if(page>totalpagesnumber){
var isthisval = totalpagesnumber;
}
else{
var isthisval = page;
}
var perpages = ''+((parseInt(isthisval)-1)*100);
}
else {
var perpages = '0';
}

// ajax for get
$.ajax({
type: "GET",
url: 'listprosearch.php?term='+perpages+'&limitings='+($('#limitforpagenum').val())+'&typesforlisting=<?=$typesforlisting?>&typesforlistingstock=<?=$typesforlistingstock?>',
success: function (result) {
$("#myTable").html(result);
},
error: function (error) {
alert(error);
}
});
// it is done
};
</script>
<?php 
}
?>

                            </div>


<?php
}
?>


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

<script type="text/javascript">
function submitthesorting(value) {
  $.ajax({
    type: "GET",
    url: 'listingsortfilters.php?moduletype=Products&typesforlisting='+value+'',
    success: function (result) {
      console.log(result);
      window.location = 'products.php?remarks='+result+'';
    },
    error: function (error) {
      console.log(error);
    }
  });
}
</script>

</body>

</html>