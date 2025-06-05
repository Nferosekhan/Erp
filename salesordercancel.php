<?php 
include('lcheck.php');
if(isset($_GET['salesorderno']))
{
	$delopenorders = $con->prepare("UPDATE pairsalesorders SET tdelete=1 WHERE createdid=? AND franchisesession=? AND salesorderno=? AND salesorderdate=?");
   $delopenorders->bind_param("ssss", $companymainid, $_SESSION['franchisesession'], $_GET['salesorderno'], $_GET['salesorderdate']);
   $delopenorders->execute();
   $delopenorders->close();
   header("Location:salesorders.php?remarks=Order Deleted Successfully");
}
?>