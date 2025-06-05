<?php
include('lcheck.php');
function get_maincategory($con , $companymainid, $term){ 
$query = "SELECT * from paircontrols WHERE createdid='$companymainid' and LOWER(firstname) LIKE LOWER('%".$term."%') ORDER BY firstname ASC";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($con, $companymainid, mysqli_real_escape_string($con, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['firstname'] = $maincategory['firstname'];
 $data['value'] = $maincategory['firstname'];
 $data['id'] = $maincategory['id'];
 $data['email'] = $maincategory['email'];
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>