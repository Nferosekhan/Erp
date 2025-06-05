<?php
include('lcheck.php');
$checker = true;
$querying = "SELECT * FROM pairproducts WHERE createdid='$companymainid' and ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and barcode='".$_GET['term']."' and isactive='0'";
 $resulting = mysqli_query($con, $querying);
function get_maincategory($con , $term, $companymainid, $fsess){ 
$query = "SELECT * FROM pairproducts WHERE createdid='$companymainid' and ((franchisesession='".$fsess."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and barcode='".$term."' and isactive='0'";
 $result = mysqli_query($con, $query);
	if(mysqli_num_rows($result)>0){
		$checker = true;
		while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
	 	return $data; 
	}
	else{
		$checker = false;
	}
}
if ((isset($_GET['term']))&&($_GET['term']!="")&&($checker)&&(mysqli_num_rows($resulting)>0)) {
	
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']), $companymainid, $_SESSION["franchisesession"]);
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
if($maincategory['id']==null)	 
{
	$data['productid']="";
}
else
{
 $data['productid'] = $maincategory['id'];
}
if($maincategory['productname']==null)	 
{
	$data['productname']="";
}
else
{
 $data['productname'] = $maincategory['productname'];
}
 
    array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
else{
	$maincategoryList = array();
	$data['productname'] = 'empty';
	array_push($maincategoryList, $data);
	echo json_encode($maincategoryList);
}
?>