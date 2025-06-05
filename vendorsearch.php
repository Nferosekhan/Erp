<?php
include('lcheck.php');
function get_maincategory($con , $term){ 
$query = "SELECT * from paircustomers WHERE franchisesession='".$_SESSION["franchisesession"]."' and LOWER(customername) LIKE LOWER('%".$term."%') and moduletype='Vendors' ORDER BY customername ASC";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
       
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']));
 $maincategoryList = array();
 foreach($getmaincategory as $maincategory){
 $data['customername'] = $maincategory['customername'];
 $data['value'] = $maincategory['customername'];
 $data['id'] = $maincategory['id'];
 $data['address'] = $maincategory['address'];
 $data['city'] = $maincategory['billcity'];
 $data['state'] = $maincategory['state'];
 $data['country'] = $maincategory['country'];
 $data['pin'] = $maincategory['pin']; 
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>