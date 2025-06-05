<?php
include 'lcheck.php';
$sqlgetcur=mysqli_query($con,"select * from paircurrency");
$rowcur=mysqli_fetch_array($sqlgetcur);
$anscur=$rowcur['currencysymbol'];
$rescurrency=explode('-',$anscur);

if((!isset($_POST['searchTerm']))&&(!isset($_POST['productname']))){
	$fetchData = mysqli_query($con,"select productname, category, id,  itemmodule,  openingstock, salescost,rack FROM pairproducts  WHERE  productname!='' and createdid='$companymainid' and ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and isactive='0' ORDER BY productname ASC limit 50");
}else if(isset($_POST['productname'])){
	$search = mysqli_real_escape_string($con,$_POST['productname']); 
	$fetchData = mysqli_query($con,"select productname, category, id,  itemmodule,  openingstock, salescost,rack FROM pairproducts  WHERE id='".$search."' createdid='$companymainid' and ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and isactive='0' and productname like '%".$search."%' ORDER BY productname ASC limit 50");
}else{
	$search = mysqli_real_escape_string($con,$_POST['searchTerm']); 
	$fetchData = mysqli_query($con,"select productname, category, id,  itemmodule,  openingstock, salescost,rack FROM pairproducts  WHERE createdid='$companymainid' and ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and isactive='0' and productname like '%".$search."%' ORDER BY productname ASC limit 50");
}
	 
$data = array();

while ($row = mysqli_fetch_array($fetchData)) {
	 $consigneeid = $row['id'];
      $productname = $row['productname'];
      $category = $row['category'];
      $itemmodule = $row['itemmodule'];
      $salescost = $row['salescost'];
$sqlstocktotal=mysqli_query($con,"SELECT id, batch, expdate, productrate, mrp, noofpacks, sum(quantity) as total, mrp, vat FROM pairbatch where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='".$row['id']."'");
$infostocktotal=mysqli_fetch_array($sqlstocktotal);
      $openingstock = $infostocktotal['total'];
		if ($infostocktotal['total']>0) {
        $data[] = array("id"=>$row['id'], "text"=>$row['productname'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='border:none !important;margin-bottom:0px !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['productname']."</td></tr><tr style='border:none !important;color:#808080;font-size:12px;margin-bottom:0px !important;' class='subtextfoo'><td style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>STOCK ON HAND: <span style='color:green;'>".$infostocktotal['total']."</span></td><td align='right' style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='itemmodulehov'>".$row['itemmodule']."</span></td></tr></table>");
	}
	else{
        $data[] = array("id"=>$row['id'], "text"=>$row['productname'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='border:none !important;margin-bottom:0px !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['productname']."</td></tr><tr style='border:none !important;color:#808080;font-size:12px;margin-bottom:0px !important;' class='subtextfoo'><td style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>STOCK ON HAND: <span style='color:red;'>".$infostocktotal['total']."</span></td><td align='right' style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='itemmodulehov'>".$row['itemmodule']."</span></td></tr></table>");
	}
}

echo json_encode($data);
?>