<?php
include('lcheck.php');
function get_products($con , $term, $type){ 
 $query = "SELECT distinct ".$type." FROM pairproducts WHERE franchisesession='".$_SESSION["franchisesession"]."' and LOWER(".$type.") LIKE LOWER('%".$term."%') ORDER BY ".$type." ASC";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if (isset($_GET['term'])) {
	$type=mysqli_real_escape_string($con,$_GET['type']);
 $getproducts = get_products($con, mysqli_real_escape_string($con, $_GET['term']), mysqli_real_escape_string($con,$_GET['type']));
 $productsList = array();
 foreach($getproducts as $products){
 $productsList[] = $products[$type];
 }
 echo json_encode($productsList);
}
?>