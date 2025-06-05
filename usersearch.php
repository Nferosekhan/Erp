<?php
include('lcheck.php');
function get_users($con , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM paircontrols WHERE LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($con,$_GET['type']);
 $getusers = get_users($con, mysqli_real_escape_string($con, $_GET['term']), mysqli_real_escape_string($con,$_GET['type']));
 $usersList = array();
 foreach($getusers as $users){
 $usersList[] = $users[$type];
 }
 echo json_encode($usersList);
}
?>