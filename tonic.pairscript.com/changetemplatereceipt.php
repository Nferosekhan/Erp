<?php 
include('lcheck.php');
if(isset($_GET['submt']))
{
	$template=mysqli_real_escape_string($con, $_GET['template']);
	$temptype=mysqli_real_escape_string($con, $_GET['temptype']);
	$no=mysqli_real_escape_string($con, $_GET['publicid']);
	$date=mysqli_real_escape_string($con, $_GET['receiptdate']);
	$receiptno=mysqli_real_escape_string($con, $_GET['receiptno']);
	$id=mysqli_real_escape_string($con, $_GET['id']);
	$idcolumn='id';
	$nocolumn='publicid';
	$receiptnocolumn='receiptdate';
	$datecolumn='receiptno';
	$templatecolumn=$template.'template';
	if(($template!='salesreturnpayment')&&($template!='purchasereturnpayment')){
		$viewpage=$template.'view';
	}
	elseif($template=='salesreturnpayment'){
		$viewpage='customerrefundview';
	}
	elseif($template=='purchasereturnpayment'){
		$viewpage='vendorrefundview';
	}
	if(($template!='')&&($temptype!=''))
	{
	$sql=mysqli_query($con, "update pairfranchises set $templatecolumn='$temptype' where id='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
	if($sql)
	{		
		header("Location: $viewpage.php?$idcolumn=$id&$receiptnocolumn=$receiptno&$datecolumn=$date&$nocolumn=$no&remarks=Changed Successfully");
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