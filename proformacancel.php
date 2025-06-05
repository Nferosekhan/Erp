<?php 
include('lcheck.php');
$createdon=date('Y-m-d H:i:s');
if(isset($_GET['proformano']))
{
	$proformano=mysqli_real_escape_string($con, $_GET['proformano']);
	$proformadate=mysqli_real_escape_string($con, $_GET['proformadate']);
	$cancelstatus=mysqli_real_escape_string($con, $_GET['cancelstatus']);
	$sql=mysqli_query($con, "update pairproformas set cancelstatus='$cancelstatus' where proformadate='$proformadate' and proformano='$proformano'");
	/* $sql2=mysqli_query($con, "update pairproformaspayments set cancelstatus='$cancelstatus' where receiptdate='$proformadate' and receiptno='$proformano'"); */
	if($sql)
	{
		
$data1 = mysqli_query($con, "SET NAMES utf8");
$data1=mysqli_query($con, "SET sql_mode = ''");
$data1=mysqli_query($con, "select invoice, invoiceprefix, (invoicesuffix+1) as invoicesuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$info1=mysqli_fetch_array($data1);
$invoiceno=mysqli_real_escape_string($con, $info1['invoiceprefix'].(str_pad((float)$info1['invoicesuffix']+1, 0, "0", STR_PAD_LEFT)));
$invoicedate=date('Y-m-d');

	$sqlp=mysqli_query($con, "INSERT INTO pairinvoices(createdon, createdid, createdby, franchisesession, editedon, invoicedate, invoiceno, invoiceterm, duedate, orderdcno, reference, invoiceamount, customername, customerid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby) SELECT '$createdon', createdid, createdby, franchisesession, editedon, '$invoicedate', '$invoiceno', proformaterm, duedate, orderdcno, reference, proformaamount, customername, customerid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby FROM pairproformas WHERE franchisesession='".$_SESSION['franchisesession']."' and proformano='$proformano' and proformadate='$proformadate'");
		
		/* if($cancelstatus=='1')
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairproformas where createdid='$companymainid' and  proformano='$proformano' and proformadate='$proformadate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock+".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		else
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairproformas where createdid='$companymainid' and  proformano='$proformano' and proformadate='$proformadate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}*/
		if($sqlp)
		{
		$sql3=mysqli_query($con, "update pairfranchises set invoicesuffix=invoicesuffix+1 where tdelete='0' and id='".$_SESSION['franchisesession']."'");
		header("Location: invoices.php?remarks=Converted Successfully");
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