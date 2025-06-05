<?php 
include('lcheck.php');
if(isset($_GET['submt']))
{
	$template=mysqli_real_escape_string($con, $_GET['template']);
	$temptype=mysqli_real_escape_string($con, $_GET['temptype']);
	$no=mysqli_real_escape_string($con, $_GET['no']);
	$date=mysqli_real_escape_string($con, $_GET['date']);
	$nocolumn=$template.'no';
	$datecolumn=$template.'date';
	$templatecolumn=$template.'template';
	$viewpage=$template.'view';
	if(($template!='')&&($temptype!=''))
	{
	$sql=mysqli_query($con, "update pairfranchises set $templatecolumn='$temptype' where id='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
	if($sql)
	{		if(isset($_GET['id'])){
				header("Location: $viewpage.php?id=".$_GET['id']."&$nocolumn=$no&$datecolumn=$date&remarks=Changed Successfully");
			}
			else{
				header("Location: $viewpage.php?$nocolumn=$no&$datecolumn=$date&remarks=Changed Successfully");
			}
	}
	else
	{
		echo mysqli_error($con);
	}
	}
	else
	{
		header("Location: invoices.php?error=No Data found");
	}
}
?>