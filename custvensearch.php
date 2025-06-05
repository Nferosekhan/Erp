<?php
include('lcheck.php');
function get_maincategory($con , $term){ 
$query = "SELECT customername as customername, id FROM paircustomers WHERE franchisesession='".$_SESSION["franchisesession"]."' and LOWER(customername) LIKE LOWER('%".$term."%')
UNION
SELECT vendorname as customername, id FROM pairvendors WHERE franchisesession='".$_SESSION["franchisesession"]."' and LOWER(vendorname) LIKE LOWER('%".$term."%')";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
/* function get_maincategory2($con , $term){ 
$query2 = "SELECT * from pairvendors WHERE franchisesession='".$_SESSION["franchisesession"]."' and LOWER(vendorname) LIKE LOWER('%".$term."%') ORDER BY vendorname ASC";
 $result2 = mysqli_query($con, $query2); 
while($row2 = mysqli_fetch_assoc($result2)) { $data2[] = $row2; }
 return $data2; 
} */
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['customername'] = $maincategory['customername'];
 $data['value'] = $maincategory['customername'];
 $data['id'] = 'C'.$maincategory['id'];
        array_push($maincategoryList, $data);
 }

 /* $getmaincategory2 = get_maincategory2($con, mysqli_real_escape_string($con, $_GET['term']));  */
 /*  foreach($getmaincategory2 as $maincategory2){
 $data['customername'] = $maincategory2['vendorname'];
  $data['value'] = $maincategory2['vendorname'];
 $data['id'] = 'V'.$maincategory2['id'];
        array_push($maincategoryList, $data);
 } */
 echo json_encode($maincategoryList);
}
?>