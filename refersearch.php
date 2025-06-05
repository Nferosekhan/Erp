<?php
include('lcheck.php');
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$datefor = 'd/m/Y';
}
if ($_GET['term']=='invref') {
function get_maincategory($con , $term, $companymainid, $fsess){ 
$query = "SELECT distinct reference FROM pairinvoices where createdid='$companymainid' and franchisesession='".$fsess."' and reference!='' order by reference asc";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $datas[] = $row; }
 return $datas; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']), $companymainid, $_SESSION["franchisesession"]);
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
if($maincategory['reference']==null)	 
{
	$datas['reference']="";
}
else
{
  $datas['reference'] = $maincategory['reference'];
}
 
    array_push($maincategoryList, $datas);
 }
 echo json_encode($maincategoryList);
}
}
?>