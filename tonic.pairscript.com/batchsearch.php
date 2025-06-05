<?php
include('lcheck.php');
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$datefor = 'd/m/Y';
}
function get_maincategory($con , $term, $companymainid, $fsess, $batchdef){ 
$query = "SELECT * FROM pairbatch where createdid='$companymainid' and franchisesession='".$fsess."' and productid='".$term."' ".$batchdef." order by createdon desc";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $datas[] = $row; }
 return $datas; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']), $companymainid, $_SESSION["franchisesession"], mysqli_real_escape_string($con, $_GET['batchdef']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
if($maincategory['batch']==null)	 
{
	$datas['batch']="";
}
else
{
  $datas['batch'] = $maincategory['batch'];
}
if($maincategory['quantity']==null)	 
{
	$datas['quantity']="";
}
else
{
  $datas['quantity'] = $maincategory['quantity'];
}
if($maincategory['expdate']==null)	 
{
	$datas['expdate']="";
}
else
{
  $datas['expdate'] = date($datefor,strtotime($maincategory['expdate']));
}
if($access['mrpforbatch']=='product'){
  if($maincategory['productrate']==null)   
  {
    $datas['productrate']="";
  }
  else
  {
    $datas['productrate'] = $maincategory['productrate'];
  }
}
elseif($access['mrpforbatch']=='sqtyexcrate'){
  if($maincategory['exctaxmrp']==null)   
  {
    $datas['productrate']="";
  }
  else
  {
    $datas['productrate'] = $maincategory['exctaxmrp'];
  }
}
elseif($access['mrpforbatch']=='sqtyincrate'){
  if($maincategory['inctaxmrp']==null)   
  {
    $datas['productrate']="";
  }
  else
  {
    $datas['productrate'] = $maincategory['inctaxmrp'];
  }
}
 
    array_push($maincategoryList, $datas);
 }
 echo json_encode($maincategoryList);
}
?>