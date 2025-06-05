<?php
	include('lcheck.php');
	function get_maincategory($con){ 
		$query = "SELECT * FROM training WHERE customdropdown!='' GROUP BY customdropdown ORDER BY id ASC";
		$result = mysqli_query($con, $query); 
		while($row = mysqli_fetch_assoc($result)) { $datas[] = $row; }
		return $datas; 
	}
	if ((isset($_GET['term']))&&($_GET['term']!="")) {
		$getmaincategory = get_maincategory($con);
		$maincategoryList = array();
		foreach($getmaincategory as $maincategory){
			if($maincategory['customdropdown']==null)	 {
				$datas['customdropdown']="";
			}
			else{
				$datas['customdropdown'] = $maincategory['customdropdown'];
			}
			array_push($maincategoryList, $datas);
		}
		echo json_encode($maincategoryList);
	}
?>