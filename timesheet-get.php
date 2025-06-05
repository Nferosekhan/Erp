<?php
include('lcheck.php');
if(isset($_POST['project']))
{
	$project=mysqli_real_escape_string($con, $_POST['project']);
	$sql=mysqli_query($con, "select distinct taskname from pairprojects where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='$project'");
	while($info=mysqli_fetch_array($sql))
	{
		echo "<option value='".$info['taskname']."'>".$info['taskname']."</option>";
	}
}
?>