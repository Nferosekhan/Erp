<?php 
include('lcheck.php');
if(isset($_GET['salesreturnno']))
{
	$salesreturnno=mysqli_real_escape_string($con, $_GET['salesreturnno']);
	$salesreturndate=mysqli_real_escape_string($con, $_GET['salesreturndate']);
	$cancelstatus=mysqli_real_escape_string($con, $_GET['cancelstatus']);
	$sql=mysqli_query($con, "update pairsalesreturns set cancelstatus='$cancelstatus' where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  salesreturnno='$salesreturnno' and salesreturndate='$salesreturndate'");
	/* $sql2=mysqli_query($con, "update pairsalesreturnspayments set cancelstatus='$cancelstatus' where receiptdate='$salesreturndate' and receiptno='$salesreturnno'"); */
	if($sql)
	{
		 if($cancelstatus=='1')
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairsalesreturns where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  salesreturnno='$salesreturnno' and salesreturndate='$salesreturndate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock+".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		else
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairsalesreturns where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  salesreturnno='$salesreturnno' and salesreturndate='$salesreturndate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		header("Location: salesreturns.php?remarks=Updated Successfully");
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>