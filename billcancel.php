<?php 
include('lcheck.php');
if(isset($_GET['billno']))
{
	$billno=mysqli_real_escape_string($con, $_GET['billno']);
	$billdate=mysqli_real_escape_string($con, $_GET['billdate']);
	$cancelstatus=mysqli_real_escape_string($con, $_GET['cancelstatus']);
	$sql=mysqli_query($con, "update pairbills set cancelstatus='$cancelstatus' where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  billno='$billno' and billdate='$billdate'");
	/* $sql2=mysqli_query($con, "update pairbillspayments set cancelstatus='$cancelstatus' where receiptdate='$billdate' and receiptno='$billno'"); */
	if($sql)
	{
		 if($cancelstatus=='1')
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  billno='$billno' and billdate='$billdate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock+".$infop['quantity']." where id='".$infop['productid']."'");
				$sqlforbatches=mysqli_query($con, "UPDATE pairbatch SET quantity=quantity - ".$infop['quantity']." WHERE createdid='$companymainid' AND franchisesession='".$_SESSION["franchisesession"]."' AND productid='".$infop['productid']."' AND batch='".$infop['batch']."' AND expdate='".$infop['expdate']."'");
				if(!$sqlforbatches){
					echo mysqli_error($con);
				}
			}
		}
		else
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  billno='$billno' and billdate='$billdate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		header("Location: bills.php?remarks=Updated Successfully");
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>