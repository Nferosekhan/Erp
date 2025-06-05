<?php 
include('lcheck.php');
$createdon=date('Y-m-d H:i:s');
if(isset($_POST['purchaseorderno']))
{
	$purchaseorderno=mysqli_real_escape_string($con, $_POST['purchaseorderno']);
	$purchaseorderdate=mysqli_real_escape_string($con, $_POST['purchaseorderdate']);
	$cancelstatus=mysqli_real_escape_string($con, $_POST['cancelstatus']);
	$purchaseorderamount=mysqli_real_escape_string($con, $_POST['purchaseorderamount']);
	$paidamount=mysqli_real_escape_string($con, $_POST['paidamount']);
	$paymentterm=mysqli_real_escape_string($con, $_POST['paymentterm']);
	$sql=mysqli_query($con, "update pairpurchaseorders set cancelstatus='$cancelstatus' where purchaseorderdate='$purchaseorderdate' and purchaseorderno='$purchaseorderno'");
	/* $sql2=mysqli_query($con, "update pairpurchaseorderspayments set cancelstatus='$cancelstatus' where receiptdate='$purchaseorderdate' and receiptno='$purchaseorderno'"); */
	if($sql)
	{
		
$data1 = mysqli_query($con, "SET NAMES utf8");
$data1=mysqli_query($con, "SET sql_mode = ''");
$data1=mysqli_query($con, "select bill, billprefix, (billsuffix+1) as billsuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$info1=mysqli_fetch_array($data1);
$billno=mysqli_real_escape_string($con, $info1['billprefix'].(str_pad((float)$info1['billsuffix']+1, 0, "0", STR_PAD_LEFT)));
$billdate=date('Y-m-d');

	$sqlp=mysqli_query($con, "INSERT INTO pairbills(createdon, createdid, createdby, franchisesession, editedon, billdate, billno, billterm, duedate, orderdcno, reference, billamount, vendorname, vendorid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby) SELECT '$createdon', createdid, createdby, franchisesession, editedon, '$billdate', '$billno', purchaseorderterm, duedate, orderdcno, reference, purchaseorderamount, vendorname, vendorid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby FROM pairpurchaseorders WHERE franchisesession='".$_SESSION['franchisesession']."' and purchaseorderno='$purchaseorderno' and purchaseorderdate='$purchaseorderdate'");
		
		/* if($cancelstatus=='1')
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairpurchaseorders where createdid='$companymainid' and  purchaseorderno='$purchaseorderno' and purchaseorderdate='$purchaseorderdate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock+".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		else
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairpurchaseorders where createdid='$companymainid' and  purchaseorderno='$purchaseorderno' and purchaseorderdate='$purchaseorderdate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}*/
		if($sqlp)
		{
	
	
	if($paidamount!='0')
{
	$sqlq=mysqli_query($con, "select vendorid, vendorname from pairpurchaseorders where createdid='$companymainid' and  purchaseorderno='$purchaseorderno' and purchaseorderdate='$purchaseorderdate'");	
$infoq=mysqli_fetch_array($sqlq);
$vendorid=$infoq['vendorid'];
$vendorname=$infoq['vendorname'];

	
$sql=mysqli_query($con, "insert into pairpurchasepayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='RECEIPT', vendorname='$vendorname', vendorid='$vendorid', receiptno='$billno', receiptdate='$billdate', amount='$paidamount', paymentmode='$paymentterm', notes='-'");
if($sql)
{
	$paymentid=mysqli_insert_id($con);
	$sqle=mysqli_query($con,"insert into pairpurchasepayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', vendorid='$vendorid', billno='$billno', billdate='$billdate', amount='$paidamount'");
	if($sqle)
	{
if((float)$purchaseorderamount==(float)$paidamount)
{
	$paidstatus='1';
}
else
{
	$paidstatus='0';
}
		$sqler=mysqli_query($con,"update pairbills set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$paidstatus' where billno='$billno' and billdate='$billdate' and vendorid='$vendorid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
		if($sqler)
		{
			//echo 's';
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		echo mysqli_error($con);
	}
}


}
	
	
	
	
		$sql3=mysqli_query($con, "update pairfranchises set billsuffix=billsuffix+1 where tdelete='0' and id='".$_SESSION['franchisesession']."'");
		header("Location: bills.php?remarks=Converted Successfully");
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>