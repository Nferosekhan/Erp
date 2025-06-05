<?php
include 'lcheck.php';
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Invoices' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $invfieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $invfieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $invfieldview = explode(',',$view);
}
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
$data[] = array("id"=>'all', "text"=>'All', "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='margin-bottom:0px !important;border:none !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>All</td></tr></table>");

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
        $data[] = array("id"=>$row['id'], "text"=>$row['productname'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='border:none !important;margin-bottom:0px !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['productname']."</td></tr><tr style='line-height:16px !important;border:none !important;color:#808080;font-size:12px;margin-bottom:0px !important;' class='subtextfoo'><td style='border:none !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;".(((in_array('Category', $invfieldadd))||(in_array('Category', $invfieldedit))||(in_array('Category', $invfieldview)))?'':'visibility: hidden;')."'>".$access['txtnamecategory'].": ".$row['category']."</td><td align='right' style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='itemmodulehov'>".$row['itemmodule']."</span></td><tr style='line-height:9px !important;border:none !important;color:#808080;font-size:12px;' class='subtextfoo'><td style='border:none !important;padding-top:6px !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>RATE: ".$rescurrency[0]."".$row['salescost']."</td><td align='right' style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;".(($access['stockonhand']=='1')?'':'visibility: hidden;')."'>STOCK ON HAND: <span style='color:green;'>".$infostocktotal['total']."</span></td></tr><tr style='line-height:10px !important;border:none !important;color:#808080;font-size:12px;' class='subtextfoo'><td style='border:none !important;padding-top:6px !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;".(((in_array('Rack', $invfieldadd))||(in_array('Rack', $invfieldedit))||(in_array('Rack', $invfieldview)))?'':'visibility: hidden;')."'>Rack : ".$row['rack']."</td></tr></table>");
	}
	else{
        $data[] = array("id"=>$row['id'], "text"=>$row['productname'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='border:none !important;margin-bottom:0px !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['productname']."</td></tr><tr style='line-height:16px !important;border:none !important;color:#808080;font-size:12px;margin-bottom:0px !important;' class='subtextfoo'><td style='border:none !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;".(((in_array('Category', $invfieldadd))||(in_array('Category', $invfieldedit))||(in_array('Category', $invfieldview)))?'':'visibility: hidden;')."'>".$access['txtnamecategory'].": ".$row['category']."</td><td align='right' style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='itemmodulehov'>".$row['itemmodule']."</span></td><tr style='line-height:9px !important;border:none !important;color:#808080;font-size:12px;' class='subtextfoo'><td style='border:none !important;padding-top:6px !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>RATE: ".$rescurrency[0]."".$row['salescost']."</td><td align='right' style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;".(($access['stockonhand']=='1')?'':'visibility: hidden;')."'>STOCK ON HAND: <span style='color:red;'>".$infostocktotal['total']."</span></td></tr><tr style='line-height:10px !important;border:none !important;color:#808080;font-size:12px;' class='subtextfoo'><td style='border:none !important;padding-top:6px !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;".(((in_array('Rack', $invfieldadd))||(in_array('Rack', $invfieldedit))||(in_array('Rack', $invfieldview)))?'':'visibility: hidden;')."'>Rack : ".$row['rack']."</td></tr></table>");
	}
}

echo json_encode($data);
?>