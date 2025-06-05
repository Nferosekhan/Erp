<?php
include('lcheck.php');
function get_maincategory($con , $term, $companymainid){ 
$query = "select id, createdon, createdid, chartaccountname, chartaccountsubcategory, chartaccountcategory, notes from pairchartaccounts where ((franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid') or createdid='') and LOWER(chartaccountname) LIKE LOWER('%".$term."%') order by chartaccountname asc";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']), $companymainid);
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['chartaccountname'] = $maincategory['chartaccountname'];
 $data['value'] = $maincategory['chartaccountname'];
 $data['id'] = $maincategory['id'];
 
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>