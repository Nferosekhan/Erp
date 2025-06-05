<?php 
include('lcheck.php');
$createdon=date('Y-m-d H:i:s');
if(isset($_GET['jobno']))
{
	$jobno=mysqli_real_escape_string($con, $_GET['jobno']);
	$jobdate=mysqli_real_escape_string($con, $_GET['jobdate']);
	$cancelstatus=mysqli_real_escape_string($con, $_GET['cancelstatus']);
	$sql=mysqli_query($con, "update pairjobs set cancelstatus='$cancelstatus' where jobdate='$jobdate' and jobno='$jobno'");
	/* $sql2=mysqli_query($con, "update pairjobspayments set cancelstatus='$cancelstatus' where receiptdate='$jobdate' and receiptno='$jobno'"); */
	if($sql)
	{
		
$data1 = mysqli_query($con, "SET NAMES utf8");
$data1=mysqli_query($con, "SET sql_mode = ''");
$data1=mysqli_query($con, "select quotation, quotationprefix, (quotationsuffix+1) as quotationsuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$info1=mysqli_fetch_array($data1);
$quotationno=mysqli_real_escape_string($con, $info1['quotationprefix'].(str_pad((float)$info1['quotationsuffix']+1, 0, "0", STR_PAD_LEFT)));
$quotationdate=date('Y-m-d');

	$sqlp=mysqli_query($con, "INSERT INTO pairquotations(createdon, createdid, createdby, franchisesession, editedon, quotationdate, quotationno, quotationterm, duedate, orderdcno, reference, quotationamount, customername, customerid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby) SELECT '$createdon', createdid, createdby, franchisesession, editedon, '$quotationdate', '$quotationno', jobterm, duedate, orderdcno, reference, jobamount, customername, customerid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby FROM pairjobs WHERE franchisesession='".$_SESSION['franchisesession']."' and jobno='$jobno' and jobdate='$jobdate'");
		
		/* if($cancelstatus=='1')
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairjobs where createdid='$companymainid' and  jobno='$jobno' and jobdate='$jobdate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock+".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		else
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairjobs where createdid='$companymainid' and  jobno='$jobno' and jobdate='$jobdate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}*/
		if($sqlp)
		{
		$sql3=mysqli_query($con, "update pairfranchises set quotationsuffix=quotationsuffix+1 where tdelete='0' and id='".$_SESSION['franchisesession']."'");
		header("Location: quotations.php?remarks=Converted Successfully");
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