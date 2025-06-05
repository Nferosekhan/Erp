<?php
include('lcheck.php');
if(isset($_GET['moduletype'])){
	$sqlsortupdated=mysqli_query($con, "UPDATE pairmainaccess SET filtertypesforlistsorting='".$_GET['typesforlisting']."' WHERE moduletype='".$_GET['moduletype']."' AND userid='$companymainid'");
	if ($sqlsortupdated) {
		echo "Information Updated Successfully";
	}
	else{
		echo "Information Not Updated";
	}
}
else{
	echo "Invalid Details";
}
?>