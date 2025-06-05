<?php 
include('lcheck.php');
$createdon=date('Y-m-d H:i:s');
if(isset($_POST['purchasereceiveno']))
{
	$purchasereceiveno=mysqli_real_escape_string($con, $_POST['purchasereceiveno']);
	$purchasereceivedate=mysqli_real_escape_string($con, $_POST['purchasereceivedate']);
	$cancelstatus=mysqli_real_escape_string($con, $_POST['cancelstatus']);
	$purchasereceiveamount=mysqli_real_escape_string($con, $_POST['purchasereceiveamount']);
	$paidamount=mysqli_real_escape_string($con, $_POST['paidamount']);
	$paymentterm=mysqli_real_escape_string($con, $_POST['paymentterm']);
	$sql=mysqli_query($con, "update pairpurchasereceives set cancelstatus='$cancelstatus' where purchasereceivedate='$purchasereceivedate' and purchasereceiveno='$purchasereceiveno'");
	/* $sql2=mysqli_query($con, "update pairpurchasereceivespayments set cancelstatus='$cancelstatus' where receiptdate='$purchasereceivedate' and receiptno='$purchasereceiveno'"); */
	if($sql)
	{
		
$data1 = mysqli_query($con, "SET NAMES utf8");
$data1=mysqli_query($con, "SET sql_mode = ''");
$data1=mysqli_query($con, "select invoice, invoiceprefix, (invoicesuffix+1) as invoicesuffix from pairfranchises where tdelete='0' and id='".$_SESSION['franchisesession']."' order by id desc");
$info1=mysqli_fetch_array($data1);
$invoiceno=mysqli_real_escape_string($con, $info1['invoiceprefix'].(str_pad((float)$info1['invoicesuffix']+1, 0, "0", STR_PAD_LEFT)));
$invoicedate=date('Y-m-d');

	$sqlp=mysqli_query($con, "INSERT INTO pairinvoices(createdon, createdid, createdby, franchisesession, editedon, invoicedate, invoiceno, invoiceterm, duedate, orderdcno, reference, invoiceamount, vendorname, vendorid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby) SELECT '$createdon', createdid, createdby, franchisesession, editedon, '$invoicedate', '$invoiceno', purchasereceiveterm, duedate, orderdcno, reference, purchasereceiveamount, vendorname, vendorid, address1, address2, area, city, pincode, state, district, saddress1, saddress2, sarea, scity, sdistrict, sstate, spincode, gstno, cstno, dlno20, dlno21, manufacturer, batch, expdate, productid, productname, producthsn, productnotes, mrp, vat, noofpacks, quantity, prodiscount, productrate, productvalue, totalitems, totalvatamount, taxtype, cgst25, sgst25, gst25, cgst6, sgst6, gst6, cgst9, sgst9, gst9, cgst14, sgst14, gst14, tax25, tax6, tax9, tax14, totalamount, discount, discountamount, freightamount, roundoff, grandtotal, preparedby, checkedby FROM pairpurchasereceives WHERE franchisesession='".$_SESSION['franchisesession']."' and purchasereceiveno='$purchasereceiveno' and purchasereceivedate='$purchasereceivedate'");
		
		/* if($cancelstatus=='1')
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairpurchasereceives where createdid='$companymainid' and  purchasereceiveno='$purchasereceiveno' and purchasereceivedate='$purchasereceivedate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock+".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}
		else
		{
			$sqlp=mysqli_query($con, "SET sql_mode = ''");
$sqlp=mysqli_query($con, "select productid, quantity from pairpurchasereceives where createdid='$companymainid' and  purchasereceiveno='$purchasereceiveno' and purchasereceivedate='$purchasereceivedate'");
			while($infop=mysqli_fetch_array($sqlp))
			{
				$sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-".$infop['quantity']." where id='".$infop['productid']."'");
			}
		}*/
		if($sqlp)
		{
	
	if($paidamount!='0')
{
$sqlq=mysqli_query($con, "select vendorid, vendorname from pairpurchasereceives where createdid='$companymainid' and  purchasereceiveno='$purchasereceiveno' and purchasereceivedate='$purchasereceivedate'");	
$infoq=mysqli_fetch_array($sqlq);
$vendorid=$infoq['vendorid'];
$vendorname=$infoq['vendorname'];

	
$sql=mysqli_query($con, "insert into pairsalespayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='RECEIPT', vendorname='$vendorname', vendorid='$vendorid', receiptno='$invoiceno', receiptdate='$invoicedate', amount='$paidamount', paymentmode='$paymentterm', notes='-'");
if($sql)
{
	$paymentid=mysqli_insert_id($con);
	$sqle=mysqli_query($con,"insert into pairsalespayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', vendorid='$vendorid', invoiceno='$invoiceno', invoicedate='$invoicedate', amount='$paidamount'");
	if($sqle)
	{
if((float)$purchasereceiveamount==(float)$paidamount)
{
	$paidstatus='1';
}
else
{
	$paidstatus='0';
}
		$sqler=mysqli_query($con,"update pairinvoices set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$paidstatus' where invoiceno='$invoiceno' and invoicedate='$invoicedate' and vendorid='$vendorid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
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