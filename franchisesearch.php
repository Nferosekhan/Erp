<?php
include('lcheck.php');
function get_franchises($con , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM paircontrols WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($con,$_GET['type']);
 $getfranchises = get_franchises($con, mysqli_real_escape_string($con, $_GET['term']), mysqli_real_escape_string($con,$_GET['type']));
 $franchisesList = array();
 foreach($getfranchises as $franchises){
 $franchisesList[] = $franchises[$type];
 }
 echo json_encode($franchisesList);
}
?>