<?php
include('lcheck.php');
function get_maincategory($con , $term, $companymainid){ 
$query = "SELECT t1.productname, t1.category, t1.id, t1.description, t1.itemmodule, t1.hsncode, t1.openingstock, t2.tax, t3.salemrp, t3.salecost, t3.salediscount, t3.saleofferprice, t1.manufacturer, t1.defaultunit FROM pairproducts t1, pairtaxrates t2, pairprosale t3 WHERE t1.createdid='$companymainid' and ((t1.franchisesession='".$_SESSION["franchisesession"]."' and t1.pvisiblity='PRIVATE') or t1.pvisiblity='PUBLIC') and (LOWER(t1.productname) LIKE LOWER('%".$term."%') or LOWER(t1.category) LIKE LOWER('%".$term."%')) and t2.id=t1.intratax and t3.productid=t1.id and t1.isactive='0' ORDER BY t1.productname ASC";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']), $companymainid);
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['productname'] = $maincategory['productname'];
 $data['value'] = (($maincategory['category']!='')?$maincategory['category'].' - ':'').$maincategory['productname'];
 $data['label']='<table width="300" style="color:#000000;"><tr><td style="padding:5px 10px;"><span>'.$maincategory['productname'].'</span><br><span>Rate:</span> '.(number_format((float)$maincategory['salecost'],2,'.','')).'</td><td style="text-align:right; padding:5px 10px;"><span style="font-size:12px">Stock in Hand</span><br>'.$maincategory['openingstock'].' '.(($maincategory['category']!='')?$maincategory['category']:'').'</td></tr></table>';
 $data['id'] = $maincategory['id'];
 $data['description'] = $maincategory['description'];
 $data['itemmodule'] = $maincategory['itemmodule'];
 $data['manufacturer'] = $maincategory['manufacturer'];
 $data['hsncode'] = $maincategory['hsncode'];
 $data['tax'] = $maincategory['tax'];
 $data['salemrp'] = $maincategory['salemrp'];
 $data['salecost'] = $maincategory['salecost'];
 $data['noofpacks'] = $maincategory['defaultunit'];
 $data['salediscount'] = $maincategory['salediscount'];
  $data['saleofferprice'] = $maincategory['saleofferprice'];
 
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>