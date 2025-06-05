<?php
include('lcheck.php');
function get_maincategory($con , $term){ 
$query = "SELECT area, city, district, state, pincode FROM pairpincode WHERE LOWER(area) LIKE LOWER('%".$term."%') ORDER BY area ASC";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['area'] = $maincategory['area'];
 $data['value'] = $maincategory['area'];
 $data['city'] = $maincategory['city'];
 $data['district'] = $maincategory['district'];
 $data['state'] = $maincategory['state'];
 $data['pincode'] = $maincategory['pincode'];
 
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>