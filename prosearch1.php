<?php
include('lcheck.php');
function get_maincategory($con , $term, $companymainid, $fsess){ 
$query = "SELECT t1.barcodeformat,t1.barcodetitle,t1.barcodehead,t1.barcode,t1.underbarcodelabel,t1.barcodenotes,t1.productname, t1.category, t1.id, t1.rack, t1.description, t1.itemmodule, t1.hsncode, SUM(t6.quantity) AS openingstock, t2.tax, t3.salemrp, t3.salecost, t3.salediscount, t3.saleofferprice, t1.manufacturer, t1.defaultunit FROM pairproducts t1, pairtaxrates t2, pairprosale t3, pairbatch t6 WHERE t1.createdid='$companymainid' and ((t1.franchisesession='".$fsess."' and t1.pvisiblity='PRIVATE') or t1.pvisiblity='PUBLIC') and t1.id='".$term."' and (t2.id=t1.intratax or t1.intratax='null') and t3.productid=t1.id and t1.isactive='0' and t6.productid=t1.id ORDER BY t1.productname ASC";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']), $companymainid, $_SESSION["franchisesession"]);
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
if($maincategory['productname']==null)	 
{
	$data['productname']="";
}
else
{
 $data['productname'] = $maincategory['productname'];
}
if($maincategory['productname']==null)	 
{
	$data['value']="";
}
else
{
 $data['value'] = $maincategory['productname'];
 }
if($maincategory['id']==null)	 
{
	$data['id']="";
}
else
{
 $data['id'] = $maincategory['id'];
}
if($maincategory['category']==null)	 
{
	$data['category']="";
}
else
{
  $data['category'] = $maincategory['category'];
}
if($maincategory['description']==null)	 
{
	$data['description']="";
}
else
{
  $data['description'] = $maincategory['description'];
 }
if($maincategory['rack']==null)	 
{
	$data['rack']="";
}
else
{
 $data['rack'] = $maincategory['rack'];
 }
if($maincategory['itemmodule']==null)	 
{
	$data['itemmodule']="";
}
else
{
 $data['itemmodule'] = $maincategory['itemmodule'];
 }
if($maincategory['hsncode']==null)	 
{
	$data['hsncode']="";
}
else
{
 $data['hsncode'] = $maincategory['hsncode'];
 }
if($maincategory['openingstock']==null)	 
{
	$data['openingstock']="";
}
else
{
 $data['openingstock'] = $maincategory['openingstock']; 
}
 
if($maincategory['tax']==null)	 
{
	$data['tax']="";
}
else
{
 $data['tax'] = $maincategory['tax']; 
} 
if($maincategory['salemrp']==null)
{
	$data['salemrp']="";
}
else
{
 $data['salemrp'] = $maincategory['salemrp']; 
}
if($maincategory['salecost']==null)
{
	$data['salecost']="";
}
else
{
 $data['salecost'] = $maincategory['salecost']; 
}
if($maincategory['salediscount']==null)
{
	$data['salediscount']="";
}
else
{
 $data['salediscount'] = $maincategory['salediscount']; 
}
if($maincategory['saleofferprice']==null)
{
	$data['saleofferprice']="";
}
else
{
 $data['saleofferprice'] = $maincategory['saleofferprice']; 
}
if($maincategory['manufacturer']==null)
{
	$data['manufacturer']="";
}
else
{
 $data['manufacturer'] = $maincategory['manufacturer']; 
}
if($maincategory['defaultunit']==null)
{
	$data['defaultunit']="";
}
else
{
 $data['defaultunit'] = $maincategory['defaultunit']; 
}

if($maincategory['barcodeformat']==null)	 
{
	$data['barcodeformat']="";
}
else
{
 $data['barcodeformat'] = $maincategory['barcodeformat'];
}
if($maincategory['barcodetitle']==null)	 
{
	$data['barcodetitle']="";
}
else
{
 $data['barcodetitle'] = $maincategory['barcodetitle'];
}
if($maincategory['barcodehead']==null)	 
{
	$data['barcodesubtitle']="";
}
else
{
 $data['barcodesubtitle'] = $maincategory['barcodehead'];
}
if($maincategory['barcode']==null)	 
{
	$data['barcodeval']="";
}
else
{
 $data['barcodeval'] = $maincategory['barcode'];
}
if($maincategory['underbarcodelabel']==null)	 
{
	$data['underbarcodelabel']="";
}
else
{
 $data['underbarcodelabel'] = $maincategory['underbarcodelabel'];
}
if($maincategory['barcodenotes']==null)	 
{
	$data['footernote']="";
}
else
{
 $data['footernote'] = $maincategory['barcodenotes'];
}
 
    array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>