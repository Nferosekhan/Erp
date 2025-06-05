<?php
include('lcheck.php');
if (isset($_POST['invoicesubmit'])) {
$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
if(!empty($_FILES['invoicefile'] ['name']) && in_array($_FILES['invoicefile'] ['type'], $csvMimes)){
if(is_uploaded_file($_FILES['invoicefile'] ['tmp_name'])){
$csvFile=fopen($_FILES['invoicefile'] ['tmp_name'],'r');
fgetcsv($csvFile);
while(($line=fgetcsv($csvFile))!==FALSE){

$invoicedate=mysqli_real_escape_string($con, $line[0]);    
$invoiceno=mysqli_real_escape_string($con, $line[1]);
// $invoiceterm=mysqli_real_escape_string($con, $line[2]);
$duedate=mysqli_real_escape_string($con, $line[3]);
$orderdcno=mysqli_real_escape_string($con, $line[4]);
$invoiceamount=mysqli_real_escape_string($con, $line[5]);
$customername=mysqli_real_escape_string($con, $line[6]);
// $customerid=mysqli_real_escape_string($con, $line[7]);
$area=mysqli_real_escape_string($con, $line[7]);
$city=mysqli_real_escape_string($con, $line[8]);
$pincode=mysqli_real_escape_string($con, $line[9]);
$state=mysqli_real_escape_string($con, $line[10]);
$district=mysqli_real_escape_string($con, $line[11]);
$gstno=mysqli_real_escape_string($con, $line[12]);
$cstno=mysqli_real_escape_string($con, $line[13]);
$dlno20=mysqli_real_escape_string($con, $line[14]);
$dlno21=mysqli_real_escape_string($con, $line[15]);
$manufacturer=mysqli_real_escape_string($con, $line[16]);
$batch=mysqli_real_escape_string($con, $line[17]);
$expdate=mysqli_real_escape_string($con, $line[18]);
// $productid=mysqli_real_escape_string($con, $line[20]);
$productname=mysqli_real_escape_string($con, $line[19]);
$producthsn=mysqli_real_escape_string($con, $line[20]);
$mrp=mysqli_real_escape_string($con, $line[21]);
$vat=mysqli_real_escape_string($con, $line[22]);
$noofpacks=mysqli_real_escape_string($con, $line[23]);
$quantity=mysqli_real_escape_string($con, $line[24]);
$prodiscount=mysqli_real_escape_string($con, $line[25]);
$productrate=mysqli_real_escape_string($con, $line[26]);
$productvalue=mysqli_real_escape_string($con, $line[27]);
$totalitems=mysqli_real_escape_string($con, $line[28]);
$totalvatamount=mysqli_real_escape_string($con, $line[29]);
$taxtype=mysqli_real_escape_string($con, $line[30]);
$tax=mysqli_real_escape_string($con, $line[31]);
$cgst=mysqli_real_escape_string($con, $line[32]);
$sgst=mysqli_real_escape_string($con, $line[33]);
$igst=mysqli_real_escape_string($con, $line[34]);
$gst=mysqli_real_escape_string($con, $line[35]);
$gstpercent=mysqli_real_escape_string($con, $line[36]);
$csgstpercent=mysqli_real_escape_string($con, $line[37]);
$totalamount=mysqli_real_escape_string($con, $line[38]);
$discount=mysqli_real_escape_string($con, $line[39]);
$discountamount=mysqli_real_escape_string($con, $line[40]);
$freightamount=mysqli_real_escape_string($con, $line[41]);
$roundoff=mysqli_real_escape_string($con, $line[42]);
$grandtotal=mysqli_real_escape_string($con, $line[43]);
$preparedby=mysqli_real_escape_string($con, $line[44]);
$checkedby=mysqli_real_escape_string($con, $line[45]);
$paidstatus=mysqli_real_escape_string($con, $line[46]);
$gstrtype=mysqli_real_escape_string($con, $line[47]);
$taxvalue=mysqli_real_escape_string($con, $line[48]);
$productnetvalue=mysqli_real_escape_string($con, $line[49]);
$discounttype=mysqli_real_escape_string($con, $line[50]);
$totalquantity=mysqli_real_escape_string($con, $line[51]);
$pos=mysqli_real_escape_string($con, $line[52]);
$validpaidamount=mysqli_real_escape_string($con, $line[53]);
$validbalance=mysqli_real_escape_string($con, $line[54]);
$invitemmodule=mysqli_real_escape_string($con, $line[55]);
$unit=mysqli_real_escape_string($con, $line[56]);
$prointratax=mysqli_real_escape_string($con, $line[57]);
$prointertax=mysqli_real_escape_string($con, $line[58]);

if ($productname!='') {
$prosel = mysqli_query($con,"select * from pairproducts where productname='$productname' and franchisesession='".$_SESSION["franchisesession"]."'");
$proids = mysqli_fetch_array($prosel);
if (mysqli_num_rows($prosel)==0) {
$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Products' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
$sqlcode=mysqli_query($con,"select count(productcode) from pairproducts where itemmodule='Products'");
$anscode=mysqli_fetch_array($sqlcode);
$oldcode=$anscode[0];
$productcode=$oldcode+1;
$publicsql=mysqli_query($con,"select count(publicid) from pairproducts where createdid='$companymainid' and itemmodule='Products'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publicid=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
$privatesql=mysqli_query($con,"select count(privateid) from pairproducts where createdid='$companymainid' and itemmodule='Products' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privateid=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;

$sqlpro = mysqli_query($con,"insert into pairproducts set franchisesession='".$_SESSION["franchisesession"]."',itemmodule='Products',productcode='$productcode',publicid='$publicid',privateid='$privateid',productname='$productname',taxpref='1',createdby='".$_SESSION["unqwerty"]."',createdon='$times',createdid='$companymainid',pvisiblity='PRIVATE',intratax='16',intertax='3'");
$productid=mysqli_insert_id($con);
$sqlprosale = mysqli_query($con,"insert into pairprosale set productid='$productid',itemmodule='Products',createdid='$companymainid'");
$sqlpropur = mysqli_query($con,"insert into pairpropurchase set productid='$productid',itemmodule='Products',createdid='$companymainid'");
}
else{
$productid=$proids['id'];
}
$cussel = mysqli_query($con,"select * from paircustomers where customername='$customername' and franchisesession='".$_SESSION["franchisesession"]."' and moduletype='Customers'");
$cusids = mysqli_fetch_array($cussel);
if (mysqli_num_rows($cussel)==0) {
$sqlismodulespublicnamecust=mysqli_query($con, "select * from pairmodules where moduletype='Customers' order by id  asc");
$infomodulespublicnamecust=mysqli_fetch_array($sqlismodulespublicnamecust);
$sqlismainaccesspublicnamecust=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Customers' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicnamecust=mysqli_fetch_array($sqlismainaccesspublicnamecust);
$sqlins = mysqli_query($con, "select count(customercode) from paircustomers where moduletype='Customers'");
$ansins = mysqli_fetch_array($sqlins);
$oldid = $ansins[0];
$customercode = $oldid + 1;
$publicsql=mysqli_query($con,"select count(publicid) from paircustomers where createdid='$companymainid' and moduletype='Customers'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publiccode=$infomodulespublicnamecust['publiccolumn'] . $oldcodepublic+1;
$privatesql=mysqli_query($con,"select count(privateid) from paircustomers where createdid='$companymainid' and moduletype='Customers' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privatecode=$infomainaccesspublicnamecust['moduleprefix'] . $oldcodeprivate+1;

$sqlup = mysqli_query($con,"insert into paircustomers set createdon='$times', createdid='$companymainid', createdby='" . $_SESSION["unqwerty"] . "', franchisesession='" . $_SESSION["franchisesession"] . "',customername='$customername',cvisiblity='PRIVATE',billstreet='$area',billcity='$city',billstate='$state',billpincode='$pincode',billcountry='$district',customercode='$customercode',gstrtype='Registered Business - Regular',sameasbilling='0',moduletype='Customers',publicid='$publiccode',privateid='$privatecode'");
$customerid=mysqli_insert_id($con);
}
else{
$customerid=$cusids['id'];
}
$selcuspos = mysqli_query($con,"select * from paircustomers where createdid='$companymainid' and moduletype='Customers' and id='$customerid'");
$fetcuspos = mysqli_fetch_array($selcuspos);
$pos = $fetcuspos['placeos'];
$sqlinv = mysqli_query($con,"insert into pairinvoices set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', customername='$customername', customerid='$customerid', area='$area', city='$city', state='$state', district='$district', pincode='$pincode', gstno='$gstno', invoiceterm='CASH', invoiceno='$invoiceno', invoicedate='$invoicedate', invoiceamount='$invoiceamount', duedate='$duedate', productid='$productid', productname='$productname', manufacturer='$manufacturer', producthsn='$producthsn', itemmodule='$invitemmodule', batch='$batch', expdate='$expdate', mrp='$mrp', vat='$vat', quantity='$quantity',unit='PCS', productrate='$productrate', noofpacks='$noofpacks', prodiscount='$prodiscount', productvalue='$productvalue',  taxvalue='0.00',  productnetvalue='$productvalue', totalitems='$totalitems', orderdcno='$orderdcno', totalvatamount='$totalvatamount', totalamount='$totalamount', totalquantity='$totalitems', discounttype='0', discount='$discount', discountamount='$discountamount', freightamount='$freightamount', roundoff='$roundoff', grandtotal='$grandtotal', preparedby='$preparedby', taxtype='$taxtype', tax='$tax',cgst='$cgst',sgst='$sgst', igst='$igst',gst='$gst',gstpercent='$gstpercent',csgstpercent='$csgstpercent',pos='$pos',sameasbilling='0',customerinfodefault='two',gstrtype='Registered Business - Regular',validpaidamount='$grandtotal',validbalance='0',cstno='$cstno',checkedby='$checkedby',paidstatus='$paidstatus',dlno20='$dlno20',dlno21='$dlno21'");
// $sql4=mysqli_query($con, "update pairproducts set openingstock=openingstock-$quantity where id='$productid'");
if ($sqlinv) {
$sqlismodulespublicnamepayments=mysqli_query($con, "select * from pairmodules where moduletype='Payments Received' order by id  asc");
$infomodulespublicnamepaymentspayments=mysqli_fetch_array($sqlismodulespublicnamepayments);
$sqlismainaccesspublicnamepayments=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Payments Received' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicnamepayments=mysqli_fetch_array($sqlismainaccesspublicnamepayments);
$publicsqlpayments=mysqli_query($con,"select count(publicid) from pairsalespayments where createdid='$companymainid'");
$publicanspayments=mysqli_fetch_array($publicsqlpayments);
$oldcodepublicpayments=$publicanspayments[0];
$publiccodepayments=$infomodulespublicnamepaymentspayments['publiccolumn'] . $oldcodepublicpayments+1;
$privatesqlpayments=mysqli_query($con,"select count(privateid) from pairsalespayments where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
$privateanspayments=mysqli_fetch_array($privatesqlpayments);
$oldcodeprivatepayments=$privateanspayments[0];
$privatecodepayments=$infomainaccesspublicnamepayments['moduleprefix'] . $oldcodeprivatepayments+1;
$selpayments = mysqli_query($con,"select receiptno,id from pairsalespayments where receiptno='$invoiceno' and receiptdate='$invoicedate'");
$selpaymentfetch = mysqli_fetch_array($selpayments);
if (mysqli_num_rows($selpayments)>0) {
$sqlpay=mysqli_query($con, "update pairsalespayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$times',  term='RECEIPT', type='invoice', customername='$customername', customerid='$customerid', receiptno='$invoiceno', receiptdate='$invoicedate', amount='$grandtotal', paymentmode='CASH', notes='-' where receiptno='$invoiceno' and receiptdate='$invoicedate'");
$paymentid=$selpaymentfetch['id'];
}
else{
$sqlpay=mysqli_query($con, "insert into pairsalespayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$times',  term='RECEIPT', type='invoice', customername='$customername', customerid='$customerid', receiptno='$invoiceno', receiptdate='$invoicedate', amount='$grandtotal', paymentmode='CASH', notes='-',publicid='$publiccodepayments',privateid='$privatecodepayments'");
$paymentid=mysqli_insert_id($con);
}
if($sqlpay)
{
$selpayhis = mysqli_query($con,"select invoiceno from pairsalespayhistory where invoiceno='$invoiceno' and invoicedate='$invoicedate'");
if (mysqli_num_rows($selpayhis)>0) {
$sqlhis=mysqli_query($con,"update pairsalespayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$times', customerid='$customerid', invoiceno='$invoiceno', invoicedate='$invoicedate', amount='$grandtotal',type='invoice' where invoiceno='$invoiceno' and invoicedate='$invoicedate'");
}
else{
$sqlhis=mysqli_query($con,"insert into pairsalespayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$times', paymentid='$paymentid', customerid='$customerid', invoiceno='$invoiceno', invoicedate='$invoicedate', amount='$grandtotal',type='invoice'");
}
}
}
}

}
if($sqlinv){
header("Location: invoices.php?remarks=Imported Successfully");
}
else{
header("Location: invoices.php?error=".mysqli_error($con));
}
}
}
else{
// $all="invalid invoice type";
}
}
// $franchisesession=mysqli_real_escape_string($con, $line[0]);    
// $createdon=mysqli_real_escape_string($con, $line[1]);
// $createdid=mysqli_real_escape_string($con, $line[2]);
// $createdby=mysqli_real_escape_string($con, $line[3]);
// $paidstatus=mysqli_real_escape_string($con, $line[4]);
// $invoicedate=mysqli_real_escape_string($con, $line[5]);
// $invoiceno=mysqli_real_escape_string($con, $line[6]);
// $invoiceterm=mysqli_real_escape_string($con, $line[7]);
// $duedate=mysqli_real_escape_string($con, $line[8]);
// $duedates=mysqli_real_escape_string($con, $line[9]);
// $invoiceamount=mysqli_real_escape_string($con, $line[10]);
// $customername=mysqli_real_escape_string($con, $line[11]);
// $customerid=mysqli_real_escape_string($con, $line[12]);
// $area=mysqli_real_escape_string($con, $line[13]);
// $city=mysqli_real_escape_string($con, $line[14]);
// $pincode=mysqli_real_escape_string($con, $line[15]);
// $state=mysqli_real_escape_string($con, $line[16]);
// $district=mysqli_real_escape_string($con, $line[17]);
// $sarea=mysqli_real_escape_string($con, $line[18]);
// $scity=mysqli_real_escape_string($con, $line[19]);
// $sdistrict=mysqli_real_escape_string($con, $line[20]);
// $sstate=mysqli_real_escape_string($con, $line[21]);
// $spincode=mysqli_real_escape_string($con, $line[22]);
// $gstno=mysqli_real_escape_string($con, $line[23]);
// $gstrtype=mysqli_real_escape_string($con, $line[24]);
// $mobile=mysqli_real_escape_string($con, $line[25]);
// $workphone=mysqli_real_escape_string($con, $line[26]);
// $batch=mysqli_real_escape_string($con, $line[27]);
// $expdate=mysqli_real_escape_string($con, $line[28]);
// $productid=mysqli_real_escape_string($con, $line[29]);
// $productname=mysqli_real_escape_string($con, $line[30]);
// $producthsn=mysqli_real_escape_string($con, $line[31]);
// $itemmodule=mysqli_real_escape_string($con, $line[32]);
// $vat=mysqli_real_escape_string($con, $line[33]);
// $quantity=mysqli_real_escape_string($con, $line[34]);
// $productrate=mysqli_real_escape_string($con, $line[35]);
// $productvalue=mysqli_real_escape_string($con, $line[36]);
// $taxvalue=mysqli_real_escape_string($con, $line[37]);
// $productnetvalue=mysqli_real_escape_string($con, $line[38]);
// $totalitems=mysqli_real_escape_string($con, $line[39]);
// $totalvatamount=mysqli_real_escape_string($con, $line[40]);
// $taxtype=mysqli_real_escape_string($con, $line[41]);
// $cgst25=mysqli_real_escape_string($con, $line[42]);
// $sgst25=mysqli_real_escape_string($con, $line[43]);
// $gst25=mysqli_real_escape_string($con, $line[44]);
// $cgst6=mysqli_real_escape_string($con, $line[45]);
// $sgst6=mysqli_real_escape_string($con, $line[46]);
// $gst6=mysqli_real_escape_string($con, $line[47]);
// $cgst9=mysqli_real_escape_string($con, $line[48]);
// $sgst9=mysqli_real_escape_string($con, $line[49]);
// $gst9=mysqli_real_escape_string($con, $line[50]);
// $cgst14=mysqli_real_escape_string($con, $line[51]);
// $sgst14=mysqli_real_escape_string($con, $line[52]);
// $gst14=mysqli_real_escape_string($con, $line[53]);
// $tax25=mysqli_real_escape_string($con, $line[54]);
// $tax6=mysqli_real_escape_string($con, $line[55]);
// $tax9=mysqli_real_escape_string($con, $line[56]);
// $tax14=mysqli_real_escape_string($con, $line[57]);
// $totalamount=mysqli_real_escape_string($con, $line[58]);
// $totalquantity=mysqli_real_escape_string($con, $line[59]);
// $grandtotal=mysqli_real_escape_string($con, $line[60]);
// $pos=mysqli_real_escape_string($con, $line[61]);
// $sameasbilling=mysqli_real_escape_string($con, $line[62]);
// $customerinfodefault=mysqli_real_escape_string($con, $line[63]);
// $unit=mysqli_real_escape_string($con, $line[64]);
// $validpaidamount=mysqli_real_escape_string($con, $line[65]);
// $validbalance=mysqli_real_escape_string($con, $line[66]);
// $dlno20=mysqli_real_escape_string($con, $line[67]);
// $dlno21=mysqli_real_escape_string($con, $line[68]);
// $cstno=mysqli_real_escape_string($con, $line[69]);
// $manufacturer=mysqli_real_escape_string($con, $line[70]);
// $mrp=mysqli_real_escape_string($con, $line[71]);
// $noofpacks=mysqli_real_escape_string($con, $line[72]);
// $prodiscount=mysqli_real_escape_string($con, $line[73]);
// $discount=mysqli_real_escape_string($con, $line[74]);
// $discountamount=mysqli_real_escape_string($con, $line[75]);
// $freightamount=mysqli_real_escape_string($con, $line[76]);
// $roundoff=mysqli_real_escape_string($con, $line[77]);
// $preparedby=mysqli_real_escape_string($con, $line[78]);
// $checkedby=mysqli_real_escape_string($con, $line[79]);
// $cancelstatus=mysqli_real_escape_string($con, $line[80]);
// $orderdcno=mysqli_real_escape_string($con, $line[81]);
// $editedon=mysqli_real_escape_string($con, $line[82]);
// $sqlinvoice="INSERT INTO pairinvoices set franchisesession='$franchisesession',createdon='$createdon',createdid='$createdid',createdby='$createdby',paidstatus='$paidstatus',invoicedate='$invoicedate',invoiceno='$invoiceno',invoiceterm='$invoiceterm',duedate='$duedate',duedates='$duedates',invoiceamount='$invoiceamount',customername='$customername',customerid='$customerid',area='$area',city='$city',pincode='$pincode',state='$state',district='$district',sarea='$sarea',scity='$scity',sdistrict='$sdistrict',sstate='$sstate',spincode='$spincode',gstno='$gstno',gstrtype='$gstrtype',mobile='$mobile',workphone='$workphone',batch='$batch',expdate='$expdate',productid='$productid',productname='$productname',producthsn='$producthsn',itemmodule='$itemmodule',vat='$vat',quantity='$quantity',productrate='$productrate',productvalue='$productvalue',taxvalue='$taxvalue',productnetvalue='$productnetvalue',totalitems='$totalitems',totalvatamount='$totalvatamount',taxtype='$taxtype',cgst25='$cgst25',sgst25='$sgst25',gst25='$gst25',cgst6='$cgst6',sgst6='$sgst6',gst6='$gst6',cgst9='$cgst9',sgst9='$sgst9',gst9='$gst9',cgst14='$cgst14',sgst14='$sgst14',gst14='$gst14',tax25='$tax25',tax6='$tax6',tax9='$tax9',tax14='$tax14',totalamount='$totalamount',totalquantity='$totalquantity',grandtotal='$grandtotal',pos='$pos',sameasbilling='$sameasbilling',customerinfodefault='$customerinfodefault',unit='$unit',validpaidamount='$validpaidamount',validbalance='$validbalance',dlno20='$dlno20',dlno21='$dlno21',cstno='$cstno',manufacturer='$manufacturer',mrp='$mrp',noofpacks='$noofpacks',prodiscount='$prodiscount',discount='$discount',discountamount='$discountamount',freightamount='$freightamount',roundoff='$roundoff',preparedby='$preparedby',checkedby='$checkedby',cancelstatus='$cancelstatus',orderdcno='$orderdcno',editedon='$editedon'";
// $resultinvoice=mysqli_query($con,$sqlinvoice);
if (isset($_POST['invoicemigratesubmit'])) {
	$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
	if(!empty($_FILES['migrationinvoicefile'] ['name']) && in_array($_FILES['migrationinvoicefile'] ['type'], $csvMimes)){
		if(is_uploaded_file($_FILES['migrationinvoicefile'] ['tmp_name'])){
			$csvFile=fopen($_FILES['migrationinvoicefile'] ['tmp_name'],'r');
			fgetcsv($csvFile);
			while(($line=fgetcsv($csvFile))!==FALSE){
				$sesunqwerty = $_SESSION['unqwerty'];
				$franchsess = $_SESSION["franchisesession"];
				$customername = mysqli_real_escape_string($con, $line[4]);
				$customerid = mysqli_real_escape_string($con, $line[5]);
				$address1 = mysqli_real_escape_string($con, $line[6]);
				$address2 = mysqli_real_escape_string($con, $line[7]);
				$area = mysqli_real_escape_string($con, $line[8]);
				$city = mysqli_real_escape_string($con, $line[9]);
				$state = mysqli_real_escape_string($con, $line[10]);
				$district = mysqli_real_escape_string($con, $line[11]);
				$pincode = mysqli_real_escape_string($con, $line[12]);
				$saddress1 = mysqli_real_escape_string($con, $line[13]);
				$saddress2 = mysqli_real_escape_string($con, $line[14]);
				$sarea = mysqli_real_escape_string($con, $line[15]);
				$scity = mysqli_real_escape_string($con, $line[16]);
				$sstate = mysqli_real_escape_string($con, $line[17]);
				$sdistrict = mysqli_real_escape_string($con, $line[18]);
				$spincode = mysqli_real_escape_string($con, $line[19]);
				$gstno = mysqli_real_escape_string($con, $line[20]);
				$invoiceterm = mysqli_real_escape_string($con, $line[21]);
				$invoiceno = mysqli_real_escape_string($con, $line[22]);
				$invoicedate = mysqli_real_escape_string($con, (date('Y-m-d',strtotime($line[23]))));
				$invoiceamount = mysqli_real_escape_string($con, $line[24]);
				$duedate = mysqli_real_escape_string($con, (date('Y-m-d',strtotime($line[25]))));
				$duedates = mysqli_real_escape_string($con, $line[26]);
				$oldproductid = mysqli_real_escape_string($con, $line[27]);
				$productname = mysqli_real_escape_string($con, $line[28]);
				$manufacturer = mysqli_real_escape_string($con, $line[29]);
				$producthsn = mysqli_real_escape_string($con, $line[30]);
				$productnotes = mysqli_real_escape_string($con, $line[31]);
				$productdescription = mysqli_real_escape_string($con, $line[32]);
				$itemmodule = mysqli_real_escape_string($con, $line[33]);
				$rack = mysqli_real_escape_string($con, $line[34]);
				$batch = mysqli_real_escape_string($con, $line[35]);
				$expdate = mysqli_real_escape_string($con, (date('Y-m-d',strtotime($line[36]))));
				$mrp = mysqli_real_escape_string($con, $line[37]);
				$vat = mysqli_real_escape_string($con, $line[38]);
				$quantity = mysqli_real_escape_string($con, $line[39]);
				$unit = mysqli_real_escape_string($con, $line[40]);
				$productrate = mysqli_real_escape_string($con, $line[41]);
				$noofpacks = mysqli_real_escape_string($con, $line[42]);
				$prodiscount = mysqli_real_escape_string($con, $line[43]);
				$productvalue = mysqli_real_escape_string($con, $line[44]);
				$taxvalue = mysqli_real_escape_string($con, $line[45]);
				$cgstvat = mysqli_real_escape_string($con, $line[46]);
				$sgstvat = mysqli_real_escape_string($con, $line[47]);
				$productnetvalue = mysqli_real_escape_string($con, $line[48]);
				$totalitems = mysqli_real_escape_string($con, $line[49]);
				$orderdcno = mysqli_real_escape_string($con, $line[50]);
				$reference = mysqli_real_escape_string($con, $line[51]);
				$saleperson = mysqli_real_escape_string($con, $line[52]);
				$totalvatamount = mysqli_real_escape_string($con, $line[53]);
				$totalamount = mysqli_real_escape_string($con, $line[54]);
				$totalquantity = mysqli_real_escape_string($con, $line[55]);
				$discounttype = mysqli_real_escape_string($con, $line[56]);
				$discount = mysqli_real_escape_string($con, $line[57]);
				$discountamount = mysqli_real_escape_string($con, $line[58]);
				$freightamount = mysqli_real_escape_string($con, $line[59]);
				$roundoff = mysqli_real_escape_string($con, $line[60]);
				$grandtotal = mysqli_real_escape_string($con, $line[61]);
				$preparedby = mysqli_real_escape_string($con, $line[62]);
				$checkedby = mysqli_real_escape_string($con, $line[63]);
				$taxtype = mysqli_real_escape_string($con, $line[64]);
				$tax = mysqli_real_escape_string($con, $line[65]);
				$cgst = mysqli_real_escape_string($con, $line[66]);
				$sgst = mysqli_real_escape_string($con, $line[67]);
				$igst = mysqli_real_escape_string($con, $line[68]);
				$gst = mysqli_real_escape_string($con, $line[69]);
				$gstpercent = mysqli_real_escape_string($con, $line[70]);
				$csgstpercent = mysqli_real_escape_string($con, $line[71]);
				$terms = mysqli_real_escape_string($con, $line[72]);
				$notes = mysqli_real_escape_string($con, $line[73]);
				$description = mysqli_real_escape_string($con, $line[74]);
				$fileattach = mysqli_real_escape_string($con, $line[75]);
				$pos = mysqli_real_escape_string($con, $line[76]);
				$twoworkphone = mysqli_real_escape_string($con, $line[77]);
				$twomobilephone = mysqli_real_escape_string($con, $line[78]);
				$twosameasbilling = mysqli_real_escape_string($con, $line[79]);
				$scriptonetwo = mysqli_real_escape_string($con, $line[80]);
				$gstrtype = mysqli_real_escape_string($con, $line[81]);
				$validpaidamount = mysqli_real_escape_string($con, $line[82]);
				$validbalance = mysqli_real_escape_string($con, $line[83]);
				$ansforsepgstval = mysqli_real_escape_string($con, $line[84]);
				$prodiscounttype = mysqli_real_escape_string($con, $line[85]);
				$marginupdates = mysqli_real_escape_string($con, $line[86]);
				$margintotalvalue = mysqli_real_escape_string($con, $line[87]);
				$twoage = mysqli_real_escape_string($con, $line[88]);
				$twosex = mysqli_real_escape_string($con, $line[89]);
				$chartaccountid = mysqli_real_escape_string($con, $line[90]);
				$accountname = mysqli_real_escape_string($con, $line[91]);
				$invoicetime = mysqli_real_escape_string($con, $line[92]);
				$cashreceived = mysqli_real_escape_string($con, $line[93]);
				$cardreceived = mysqli_real_escape_string($con, $line[94]);
				$gpayreceived = mysqli_real_escape_string($con, $line[95]);
				$ordering = mysqli_real_escape_string($con, $line[96]);
				$dlno20 = mysqli_real_escape_string($con, $line[97]);
				$dlno21 = mysqli_real_escape_string($con, $line[98]);
				$cancelstatus = mysqli_real_escape_string($con, $line[99]);

				$sqlproid=mysqli_query($con,"select id from pairproducts where codetags='$oldproductid'");
				$ansproid=mysqli_fetch_array($sqlproid);

				$productid = $ansproid['id'];

				if($productname!=''){
					$sql = $con->prepare("INSERT INTO pairinvoices (barcode,createdon,createdid,createdby,franchisesession,customername,customerid,address1,address2,area,city,state,district,pincode,saddress1,saddress2,sarea,scity,sstate,sdistrict,spincode,gstno,invoiceterm,invoiceno,invoicedate,invoiceamount,duedate,duedates,productid,productname,manufacturer,producthsn,productnotes,productdescription,itemmodule,rack,batch,expdate,mrp,vat,quantity,unit,productrate,noofpacks,prodiscount,productvalue,taxvalue,cgstvat,sgstvat,productnetvalue,totalitems,orderdcno,reference,saleperson,totalvatamount,totalamount,totalquantity,discounttype,discount,discountamount,freightamount,roundoff,grandtotal,preparedby,checkedby,taxtype,tax,cgst,sgst,igst,gst,gstpercent,csgstpercent,terms,notes,description,fileattach,pos,workphone,mobile,sameasbilling,customerinfodefault,gstrtype,validpaidamount,validbalance,icsgsthis,prodiscounttype,marginupdates,margintotalvalue,age,sex,accountid,accountname,invoicetime,cashreceived,cardreceived,gpayreceived,ordering,dlno20,dlno21,invoicetype,cancelstatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Invoice', ?)");
				    $sql->bind_param("sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssissssssssi", $barcode, $times, $companymainid, $sesunqwerty, $franchsess, $customername, $customerid, $address1, $address2, $area, $city, $state, $district, $pincode, $saddress1, $saddress2, $sarea, $scity, $sstate, $sdistrict, $spincode, $gstno, $invoiceterm, $invoiceno, $invoicedate, $invoiceamount, $duedate, $duedates, $productid, $productname, $manufacturer, $producthsn, $productnotes, $productdescription, $itemmodule, $rack, $batch, $expdate, $mrp, $vat, $quantity, $unit, $productrate, $noofpacks, $prodiscount, $productvalue, $taxvalue,$cgstvat,$sgstvat, $productnetvalue, $totalitems, $orderdcno, $reference, $saleperson, $totalvatamount, $totalamount, $totalquantity, $discounttype, $discount, $discountamount, $freightamount, $roundoff, $grandtotal, $preparedby, $checkedby, $taxtype, $tax, $cgst, $sgst, $igst, $gst, $gstpercent, $csgstpercent, $terms, $notes, $description, $fileattach, $pos, $twoworkphone, $twomobilephone, $twosameasbilling, $scriptonetwo, $gstrtype, $validpaidamount, $validbalance, $ansforsepgstval, $prodiscounttype, $marginupdates, $margintotalvalue, $twoage, $twosex, $chartaccountid, $accountname, $invoicetime, $cashreceived, $cardreceived, $gpayreceived, $ordering, $dlno20, $dlno21, $cancelstatus);
					if($sql->execute()){
						header("Location: invoices.php?remarks=Imported Successfully");
					}
					else{
						header("Location: invoices.php?error=".mysqli_error($con));
					}
				}
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <?php
include('externals.php');
?>
    <title>
        Invoices - Dmedia
    </title>
    <style>
    table tbody tr:nth-of-type(odd) {}

/*@media screen and (max-width: 3px) {
    .addmenu{
        position: relative;
        left: -57px; 
        top: 36px;
}
.add{
    position: relative;
    left: -60px;
}
}*/
@media screen and (max-width: 993px) {
    .add{
        position: relative;
        left: 0px; 
        top: 36px;
}
.addmenu{
        position: relative;
        left: 0px; 
        top: 36px;
}
}


@media screen and (max-width: 353px) {
    /*.add{
        position: relative;
        left: -90px; 
        top: 36px;
}
.addmenu{
        position: relative;
        left: -96px; 
        top: 36px;
}*/
}


    @media screen and (max-width: 600px) {
        table {
            border: 0;
            margin-top: 30px;
        }

        table caption {
            font-size: 1.3em;
        }

        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: 1em;
        }


        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8em;
            text-align: right;
        }

        table td::before {
            /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
            padding-bottom: 2em;
        }
    }
    </style>



    <style>
    #tableEditor {
        position: absolute;
        left: 250px;
        top: 161px;
        padding: 5px;
        border: 1px solid #000;
        background: #fff;
    }
    </style>

    <style>
    .checkbox-dropdown {
        width: 220px;
        border: 0px solid #aaa;
        padding: 10px;
        position: relative;
		z-index:5;


        user-select: none;
    }

    /* Display CSS arrow to the right of the dropdown text */
    .checkbox-dropdown:after {

        height: 0;
        position: absolute;
        width: 0;
        border: 6px solid transparent;
        border-top-color: #000;
        top: 50%;
        right: 10px;
        margin-top: -3px;
    }

    /* Reverse the CSS arrow when the dropdown is active */
    .checkbox-dropdown.is-active:after {
        border-bottom-color: #000;
        border-top-color: #fff;
        margin-top: -9px;
    }

    .checkbox-dropdown-list {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        top: 100%;
        /* align the dropdown right below the dropdown text */
        border: inherit;
        border-top: none;
        left: -1px;
        /* align the dropdown to the left */
        right: -1px;
        /* align the dropdown to the right */
        opacity: 0;
        /* hide the dropdown */
        border: 1px solid #aaa;
        transition: opacity 0.4s ease-in-out;
        height: auto;
        overflow: scroll;
        overflow-x: hidden;
        pointer-events: none;
        /* avoid mouse click events inside the dropdown */
    }

    .is-active .checkbox-dropdown-list {
        opacity: 1;
        /* display the dropdown */
        pointer-events: auto;
        /* make sure that the user still can select checkboxes */
    }

    .checkbox-dropdown-list {

        background-color: white;
        padding: 10px;
        text-transform: uppercase;


    }

    .checkbox-dropdown-list li label {

        padding: 10px;


    }

    .checkbox-dropdown-list li:hover {
        background-color: #EDF0F2;
        color: white;
    }

    .dropliststyle {
        padding-left: 10px;
        margin-top: -4px;
        vertical-align: text-bottom;
        font-size: 14px;
    }

    input[type=checkbox] {
        transform: scale(1.25);
    }

    input:disabled {
        background: red;
    }

    input[type="checkbox"i]:disabled {
        color: red;
    }
    </style>

</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6">
   <?php
  // sidebar
  include('sidebar.php');
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
         <?php 
   // navbar
   include('navhead.php');
    ?>
     <div class="container-fluid py-4 bg-body">
     <?php
   // notifications
     if(isset($_GET['remarks']))
     {
     ?>
     <div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -50px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #53b05a !important;">
    <i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks']?></p>
  </div>
     <?php
     }
     ?>
     <?php
     if(isset($_GET['error']))
     {
     ?>
      <div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -50px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
    <i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></p>
  </div>
     <?php
     }
     ?>
     <script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 4000);
 
});
</script>

	 
	 
<div style="max-width: 1650px;">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5">
<div class="card-body p-3">

 <p class="mb-3" style="color:black;font-size:20px;margin-top: -8px;"> <i class="fa fa-file-import"></i> Invoice Import</p>

<div class="alert alert-info text-white">
Kindly Note that the New Invoice List should contains existing Invoice Name, otherwise it has been Overrided.
</div>

<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingThree">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
			  
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">New Import</a>	
             
</div> 
                
</button>
</h5>
<div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree"  style="">
<div class="accordion-body text-sm">
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">

<p>Download a <a href="simpleimport.csv">sample file</a> and compare it to your import file to ensure you have the file perfect for the import.</p>

<div class="row">
<div class="col-lg-12">

<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="invoicefile" class="custom-label"><span class="text-danger">Invoices CSV File *</span></label>
</div>
<div class="col-sm-8">
<input type="file" class="form-control  form-control-sm" required id="invoicefile" name="invoicefile" accept=".csv">
</div>
</div>
</div>
</div>


</div>

</div>

<div class="row justify-content-center">
<div class="col-lg-12"><hr>
<input class="btn btn-primary btn-sm btn-custom" type="submit" name="invoicesubmit" value="Save">  <a class="btn btn-primary btn-sm btn-custom-grey" href="invoices.php">Cancel</a>
</div>
</div>
</form>
			   
</div>
</div>
</div>
		 

			   
</div>


<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingMigrate">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMigrate" aria-expanded="true" aria-controls="collapseMigrate">	  
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Invoice Migrate</a>	      
</div>       
</button>
</h5>
<div id="collapseMigrate" class="accordion-collapse collapse show" aria-labelledby="headingMigrate"  style="">
<div class="accordion-body text-sm">
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
<p>Download a <a href="simpleimport.csv">sample file</a> and compare it to your import file to ensure you have the file perfect for the import.</p>
<div class="row">
<div class="col-lg-12">
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="migrationinvoicefile" class="custom-label"><span class="text-danger">Invoices CSV File *</span></label>
</div>
<div class="col-sm-8">
<input type="file" class="form-control  form-control-sm" required id="migrationinvoicefile" name="migrationinvoicefile" accept=".csv">
</div>
</div>
</div>
</div>
</div>
</div>

<div class="row justify-content-center">
<div class="col-lg-12"><hr>
<input class="btn btn-primary btn-sm btn-custom" type="submit" name="invoicemigratesubmit" value="Save">  <a class="btn btn-primary btn-sm btn-custom-grey" href="invoices.php">Cancel</a>
</div>
</div>
</form>   
</div>
</div>
</div>	   
</div>	


			  
</div>
</div>
</div>
		 
</div>
</div>
        <?php
	  include('footer.php');
	  ?>
        </div>

    </main>
    <?php
 include('fexternals.php');
 ?>
    <script>
    window.setMobileTable = function(selector) {
        // if (window.innerWidth > 600) return false;
        const tableEl = document.querySelector(selector);
        const thEls = tableEl.querySelectorAll('thead th');
        const tdLabels = Array.from(thEls).map(el => el.innerText);
        tableEl.querySelectorAll('tbody tr').forEach(tr => {
            Array.from(tr.children).forEach(
                (td, ndx) => td.setAttribute('label', tdLabels[ndx])
            );
        });
    }
    </script>


    <script>
    function tableEditorremove() {
        $('#tableEditor').remove();
        return false;
    }
    </script>

    <script>
    $(".checkbox-dropdown").click(function() {
        $(this).toggleClass("is-active");
    });

    $(".checkbox-dropdown ul").click(function(e) {
        e.stopPropagation();
    });








    $("#name").click(function(e) {
        var checkbox = $(this);
        if (checkbox.is(":checked")) {
            //check it 
        } else {
            // prevent from being unchecked
            this.checked = !this.checked;
        }
    });



    $("#rate").click(function(e) {
        var checkbox = $(this);
        if (checkbox.is(":checked")) {
            //check it 
        } else {
            // prevent from being unchecked
            this.checked = !this.checked;
        }
    });


    if ($('#name').is(":checked")) {
        // it is checked  
        //alert("Name column is checked")
    }
    if ($('#rate').is(":checked")) {
        // it is checked  
        //alert("rate column is checked")
    }
    </script>
    <script>
    $(function() {
        var $chk = $(".grpChkBox input:checkbox");
        var $tbl = $("#someTable");
        var $tblhead = $("#someTable th");

        $chk.prop('checked', true);

        $chk.click(function() {
            var colToHide = $tblhead.filter("." + $(this).attr("name"));
            var index = $(colToHide).index();
            $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
        });
    });


    function funaddcolumn() {
        
       // $('#grpChkBox').css("display" , "none");
    }
    </script>





    <script>
    var buttons = document.querySelectorAll('.arlina-button');

    Array.prototype.slice.call(buttons).forEach(function(button) {

        var resetTimeout;

        button.addEventListener('click', function() {

            if (typeof button.getAttribute('data-loading') === 'string') {
                button.removeAttribute('data-loading');
            } else {
                button.setAttribute('data-loading', '');
            }

            clearTimeout(resetTimeout);
            resetTimeout = setTimeout(function() {
                button.removeAttribute('data-loading');
            }, 1000);

        }, false);

    });
    </script>






    <style>
    /*************************************
 * BUTTON BASE
 */

    .arlina-button {
        position: relative;
        border: 0;
        cursor: pointer;
        outline: 0;
        -webkit-appearance: none;
        -webkit-font-smoothing: antialiased;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    .arlina-button[data-loading] {
        cursor: default;
    }


    /* Blue button */
    .arlina-button.blue {
        background: #53b5e6;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.blue:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #58c2f8;
    }

    .arlina-button.blue[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }

    /* Orange button */
    .arlina-button.orange {
        background: #ea8557;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.orange:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #ffa96c;
    }

    .arlina-button.orange[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }


    /* Spinner animation */
    .arlina-button .spinner {
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        margin-top: -10px;
        opacity: 0;

        background-image: url("assets/img/spin.gif");
        background-repeat: no-repeat;

        /* background-image: url(http://2.bp.blogspot.com/-GPSLDnKmX3s/VSvPkXsCHvI/AAAAAAAACOg/Xmm2kIDu-CU/s1600/spin.gif); */


    }


    /*************************************
 * EASING
 */

    .arlina-button,
    .arlina-button .spinner,
    .arlina-button .label {
        -webkit-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -moz-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -ms-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
    }

    .arlina-button.zoom-in,
    .arlina-button.zoom-in .spinner,
    .arlina-button.zoom-in .label,
    .arlina-button.zoom-out,
    .arlina-button.zoom-out .spinner,
    .arlina-button.zoom-out .label {
        -webkit-transition: 0.3s ease all;
        -moz-transition: 0.3s ease all;
        -ms-transition: 0.3s ease all;
        transition: 0.3s ease all;
    }



    /*************************************
 * EXPAND RIGHT
 */

    .arlina-button.expand-left .spinner {
        left: 0.8em;
    }

    .arlina-button.expand-left[data-loading] {
        padding-left: 40px;
    }

    .arlina-button.expand-left[data-loading] .spinner {
        opacity: 1;
    }
    </style>



</body>

</html>