<?php 
include('lcheck.php');
if(isset($_GET['purchasereturnno']))
{
	$purchasereturnno=mysqli_real_escape_string($con, $_GET['purchasereturnno']);
	$purchasereturndate=mysqli_real_escape_string($con, $_GET['purchasereturndate']);
	$cancelstatus=mysqli_real_escape_string($con, $_GET['cancelstatus']);
	$sql=mysqli_query($con, "update pairpurchasereturns set cancelstatus='$cancelstatus' where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  purchasereturnno='$purchasereturnno' and purchasereturndate='$purchasereturndate'");
	/* $sql2=mysqli_query($con, "update pairpurchasereturnspayments set cancelstatus='$cancelstatus' where receiptdate='$purchasereturndate' and receiptno='$purchasereturnno'"); */
	if($sql)
	{
		 if($cancelstatus=='1')
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairpurchasereturns where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  purchasereturnno='$purchasereturnno' and purchasereturndate='$purchasereturndate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock+".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		else
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairpurchasereturns where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  purchasereturnno='$purchasereturnno' and purchasereturndate='$purchasereturndate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		header("Location: purchasereturns.php?remarks=Updated Successfully");
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>