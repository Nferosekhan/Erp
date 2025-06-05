<?php
include('lcheck.php');
function get_units($con , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM pairtaxrates WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($con,$_GET['type']);
 $getunits = get_units($con, mysqli_real_escape_string($con, $_GET['term']), mysqli_real_escape_string($con,$_GET['type']));
 $unitsList = array();
 foreach($getunits as $units){
 $unitsList[] = $units[$type];
 }
 echo json_encode($unitsList);
}
?>