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
	 // $consigneeid = $row['id'];
      // $productname = $row['productname'];
      // $category = $row['category'];
      // $itemmodule = $row['itemmodule'];
      // $salescost = $row['salescost'];
$sqlstocktotal=mysqli_query($con,"SELECT sum(quantity) as total FROM pairbatch where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='".$row['id']."'");
$infostocktotal=mysqli_fetch_array($sqlstocktotal);
      $openingstock = $infostocktotal['total'];
	if (($infostocktotal['total']>0)&&($infostocktotal['total']!='')) {
        $data[] = array("id"=>$row['id'], "text"=>$row['productname'], "html"=>"<table style='table-layout:fixed;' width='100%'><tr style='border:none !important;margin-bottom:0px !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['productname']."</td></tr><tr style='line-height:16px !important;border:none !important;color:#808080;font-size:12px;margin-bottom:0px !important;' class='subtextfoo'><td style='border:none !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;".(((in_array('Category', $invfieldadd))||(in_array('Category', $invfieldedit))||(in_array('Category', $invfieldview)))?'':'visibility: hidden;')."' title='".$row['category']."'>".$access['txtnamecategory'].": ".$row['category']."</td><td align='right' style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='itemmodulehov'>".$row['itemmodule']."</span></td><tr style='line-height:7px !important;border:none !important;color:#808080;font-size:12px;' class='subtextfoo'><td style='border:none !important;padding-top:6px !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;' title='".$resmaincurrencyans."".$row['salescost']."'>RATE: ".$resmaincurrencyans."".$row['salescost']."</td><td align='right' style='overflow:hidden;white-space:nowrap;".(($access['stockonhand']=='1')?'':'visibility: hidden;')."' title='".$infostocktotal['total']."'><span style='width:100%;display:inline-block;line-height:10px;margin-top:5px;'><span style='width:70%;display:inline-block;text-overflow:ellipsis;overflow:hidden;'>STOCK ON HAND </span><span style='color:green;width:max-content;display:inline-block;text-align:left;' class='stockonmobile'>: ".$infostocktotal['total']."</span></span></td></tr><tr style='line-height:7px !important;border:none !important;color:#808080;font-size:12px;' class='subtextfoo'><td style='border:none !important;padding-top:6px !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;".(((in_array('Rack', $invfieldadd))||(in_array('Rack', $invfieldedit))||(in_array('Rack', $invfieldview)))?'':'visibility: hidden;')."' title='".$row['rack']."'>Rack : ".$row['rack']."</td></tr></table>");
	}
	else{
        $data[] = array("id"=>$row['id'], "text"=>$row['productname'], "html"=>"<table style='table-layout:fixed;' width='100%' class='".((($access['stockonhand']=='1')&&(strtolower($row['itemmodule'])=='products'))?'redstockhand':'')."'><tr style='border:none !important;margin-bottom:0px !important;'><td colspan='2' style='padding:0px;border:none !important;max-width:100%;overflow:hidden;text-overflow:ellipsis;'>".$row['productname']."</td></tr><tr style='line-height:16px !important;border:none !important;color:#808080;font-size:12px;margin-bottom:0px !important;' class='subtextfoo'><td style='border:none !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;".(((in_array('Category', $invfieldadd))||(in_array('Category', $invfieldedit))||(in_array('Category', $invfieldview)))?'':'visibility: hidden;')."' title='".$row['category']."'>".$access['txtnamecategory'].": ".$row['category']."</td><td align='right' style='overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'><span style='background-color:#1BBC9B;color:white;padding:2px 3px; border-radius:5px; text-transform: uppercase;' class='itemmodulehov'>".$row['itemmodule']."</span></td><tr style='line-height:7px !important;border:none !important;color:#808080;font-size:12px;' class='subtextfoo'><td style='border:none !important;padding-top:6px !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;' title='".$resmaincurrencyans."".$row['salescost']."'>RATE: ".$resmaincurrencyans."".$row['salescost']."</td><td class='blinkonloweststkhad' align='right' style='overflow:hidden;white-space:nowrap;".(($access['stockonhand']=='1')?'':'visibility: hidden;')."' title='".(($infostocktotal['total']<0)?$infostocktotal['total']:'0')."'><span style='width:100%;display:inline-block;line-height:10px;margin-top:5px;'><span style='width:70%;display:inline-block;text-overflow:ellipsis;overflow:hidden;'>STOCK ON HAND </span><span style='width:max-content;display:inline-block;text-align:left;' class='stockonmobile'>: ".(($infostocktotal['total']<0)?$infostocktotal['total']:'0')."</span></span></td></tr><tr style='line-height:7px !important;border:none !important;color:#808080;font-size:12px;' class='subtextfoo'><td style='border:none !important;padding-top:6px !important;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;".(((in_array('Rack', $invfieldadd))||(in_array('Rack', $invfieldedit))||(in_array('Rack', $invfieldview)))?'':'visibility: hidden;')."' title='".$row['rack']."'>Rack : ".$row['rack']."</td></tr></table>");
	}
}

echo json_encode($data);
?>