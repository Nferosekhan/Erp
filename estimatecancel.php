<?php 
include('lcheck.php');
$createdon=date('Y-m-d H:i:s');
if(isset($_GET['quotationno']))
{
	$quotationno=mysqli_real_escape_string($con, $_GET['quotationno']);
	$quotationdate=mysqli_real_escape_string($con, $_GET['quotationdate']);
	$estimatestatus=mysqli_real_escape_string($con, $_GET['estimatestatus']);
	$sql=mysqli_query($con, "update pairquotations set estimatestatus='$estimatestatus' where quotationdate='$quotationdate' and quotationno='$quotationno'");
	/* $sql2=mysqli_query($con, "update pairquotationspayments set estimatestatus='$estimatestatus' where receiptdate='$quotationdate' and receiptno='$quotationno'"); */
	if($sql)
	{
$data1 = mysqli_query($con, "SET NAMES utf8");
$data1=mysqli_query($con, "SET sql_mode = ''");
$data1=mysqli_query($con, "select estimate, estimateprefix, (estimatesuffix+1) as estimatesuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$info1=mysqli_fetch_array($data1);
$estimateno=mysqli_real_escape_string($con, $info1['estimateprefix'].(str_pad((float)$info1['estimatesuffix']+1, 0, "0", STR_PAD_LEFT)));
$estimatedate=date('Y-m-d');

	$sqlp=mysqli_query($con, "INSERT INTO pairestimates(createdon, createdid, createdby, franchisesession, editedon, estimatedate, estimateno, estimateterm, duedate, orderdcno, reference, estimateamount, customername, customerid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby) SELECT '$createdon', createdid, createdby, franchisesession, editedon, '$estimatedate', '$estimateno', quotationterm, duedate, orderdcno, reference, quotationamount, customername, customerid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby FROM pairquotations WHERE franchisesession='".$_SESSION['franchisesession']."' and quotationno='$quotationno' and quotationdate='$quotationdate'");
		
		/* if($estimatestatus=='1')
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairquotations where createdid='$companymainid' and  quotationno='$quotationno' and quotationdate='$quotationdate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock+".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		else
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairquotations where createdid='$companymainid' and  quotationno='$quotationno' and quotationdate='$quotationdate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}*/
		if($sqlp)
		{
		$sql3=mysqli_query($con, "update pairfranchises set estimatesuffix=estimatesuffix+1 where tdelete='0' and id='".$_SESSION['franchisesession']."'");	
		header("Location: estimates.php?remarks=Converted Successfully");
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