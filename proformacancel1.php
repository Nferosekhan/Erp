<?php 
include('lcheck.php');
$createdon=date('Y-m-d H:i:s');
if(isset($_GET['quotationno']))
{
	$quotationno=mysqli_real_escape_string($con, $_GET['quotationno']);
	$quotationdate=mysqli_real_escape_string($con, $_GET['quotationdate']);
	$proformastatus=mysqli_real_escape_string($con, $_GET['proformastatus']);
	$sql=mysqli_query($con, "update pairquotations set proformastatus='$proformastatus' where quotationdate='$quotationdate' and quotationno='$quotationno'");
	/* $sql2=mysqli_query($con, "update pairquotationspayments set proformastatus='$proformastatus' where receiptdate='$quotationdate' and receiptno='$quotationno'"); */
	if($sql)
	{
$data1 = mysqli_query($con, "SET NAMES utf8");
$data1=mysqli_query($con, "SET sql_mode = ''");
$data1=mysqli_query($con, "select proforma, proformaprefix, (proformasuffix+1) as proformasuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$info1=mysqli_fetch_array($data1);
$proformano=mysqli_real_escape_string($con, $info1['proformaprefix'].(str_pad((float)$info1['proformasuffix']+1, 0, "0", STR_PAD_LEFT)));
$proformadate=date('Y-m-d');

	$sqlp=mysqli_query($con, "INSERT INTO pairproformas(createdon, createdid, createdby, franchisesession, editedon, proformadate, proformano, proformaterm, duedate, orderdcno, reference, proformaamount, customername, customerid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby) SELECT '$createdon', createdid, createdby, franchisesession, editedon, '$proformadate', '$proformano', quotationterm, duedate, orderdcno, reference, quotationamount, customername, customerid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby FROM pairquotations WHERE franchisesession='".$_SESSION['franchisesession']."' and quotationno='$quotationno' and quotationdate='$quotationdate'");
		
		/* if($proformastatus=='1')
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
		$sql3=mysqli_query($con, "update pairfranchises set proformasuffix=proformasuffix+1 where tdelete='0' and id='".$_SESSION['franchisesession']."'");	
		header("Location: proformas.php?remarks=Converted Successfully");
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