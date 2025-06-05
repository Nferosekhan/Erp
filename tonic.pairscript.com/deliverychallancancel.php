<?php 
include('lcheck.php');
$createdon=date('Y-m-d H:i:s');
if(isset($_POST['deliverychallanno']))
{
	$deliverychallanno=mysqli_real_escape_string($con, $_POST['deliverychallanno']);
	$deliverychallandate=mysqli_real_escape_string($con, $_POST['deliverychallandate']);
	$cancelstatus=mysqli_real_escape_string($con, $_POST['cancelstatus']);
	$deliverychallanamount=mysqli_real_escape_string($con, $_POST['deliverychallanamount']);
	$paidamount=mysqli_real_escape_string($con, $_POST['paidamount']);
	$paymentterm=mysqli_real_escape_string($con, $_POST['paymentterm']);
	$sql=mysqli_query($con, "update pairdeliverychallans set cancelstatus='$cancelstatus' where deliverychallandate='$deliverychallandate' and deliverychallanno='$deliverychallanno'");
	/* $sql2=mysqli_query($con, "update pairdeliverychallanspayments set cancelstatus='$cancelstatus' where receiptdate='$deliverychallandate' and receiptno='$deliverychallanno'"); */
	if($sql)
	{
		
$data1 = mysqli_query($con, "SET NAMES utf8");
$data1=mysqli_query($con, "SET sql_mode = ''");
$data1=mysqli_query($con, "select invoice, invoiceprefix, (invoicesuffix+1) as invoicesuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$info1=mysqli_fetch_array($data1);
$invoiceno=mysqli_real_escape_string($con, $info1['invoiceprefix'].(str_pad((float)$info1['invoicesuffix']+1, 0, "0", STR_PAD_LEFT)));
$invoicedate=date('Y-m-d');

	$sqlp=mysqli_query($con, "INSERT INTO pairinvoices(createdon, createdid, createdby, franchisesession, editedon, invoicedate, invoiceno, invoiceterm, duedate, orderdcno, reference, invoiceamount, customername, customerid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby) SELECT '$createdon', createdid, createdby, franchisesession, editedon, '$invoicedate', '$invoiceno', deliverychallanterm, duedate, orderdcno, reference, deliverychallanamount, customername, customerid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby FROM pairdeliverychallans WHERE franchisesession='".$_SESSION['franchisesession']."' and deliverychallanno='$deliverychallanno' and deliverychallandate='$deliverychallandate'");
		
		/* if($cancelstatus=='1')
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairdeliverychallans where createdid='$companymainid' and  deliverychallanno='$deliverychallanno' and deliverychallandate='$deliverychallandate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock+".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		else
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairdeliverychallans where createdid='$companymainid' and  deliverychallanno='$deliverychallanno' and deliverychallandate='$deliverychallandate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}*/
		if($sqlp)
		{
	
	if($paidamount!='0')
{
$sqlq=mysqli_query($con, "select customerid, customername from pairdeliverychallans where createdid='$companymainid' and  deliverychallanno='$deliverychallanno' and deliverychallandate='$deliverychallandate'");	
$infoq=mysqli_fetch_array($sqlq);
$customerid=$infoq['customerid'];
$customername=$infoq['customername'];

	
$sql=mysqli_query($con, "insert into pairsalespayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='RECEIPT', customername='$customername', customerid='$customerid', receiptno='$invoiceno', receiptdate='$invoicedate', amount='$paidamount', paymentmode='$paymentterm', notes='-'");
if($sql)
{
	$paymentid=mysqli_insert_id($con);
	$sqle=mysqli_query($con,"insert into pairsalespayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', customerid='$customerid', invoiceno='$invoiceno', invoicedate='$invoicedate', amount='$paidamount'");
	if($sqle)
	{
if((float)$deliverychallanamount==(float)$paidamount)
{
	$paidstatus='1';
}
else
{
	$paidstatus='0';
}
		$sqler=mysqli_query($con,"update pairinvoices set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$paidstatus' where invoiceno='$invoiceno' and invoicedate='$invoicedate' and customerid='$customerid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
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