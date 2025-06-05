<?php
include('lcheck.php');
$sqlgetcur=mysqli_query($con,"select * from paircurrency");
$rowcur=mysqli_fetch_array($sqlgetcur);
$anscur=$rowcur['currencysymbol'];
$rescurrency=explode('-',$anscur);
$sqlgetcur=mysqli_query($con,"select * from paircurrency");
$rowcur=mysqli_fetch_array($sqlgetcur);
$anscur=$rowcur['currencysymbol'];
$res=explode('-',$anscur);
if (isset($_GET['term'])) {

$sqlismainaccessuseradj=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Inventory Adjustments' order by id  asc");
$infomainaccessuseradj=mysqli_fetch_array($sqlismainaccessuseradj);

$sqlismainaccessuserinv=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Invoices' order by id  asc");
$infomainaccessuserinv=mysqli_fetch_array($sqlismainaccessuserinv);

$sqlismainaccessuserbill=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Bills' order by id  asc");
$infomainaccessuserbill=mysqli_fetch_array($sqlismainaccessuserbill);

$sqlismainaccessusercn=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Credit Notes' order by id  asc");
$infomainaccessusercn=mysqli_fetch_array($sqlismainaccessusercn);

$sqlismainaccessuserdn=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Debit Notes' order by id  asc");
$infomainaccessuserdn=mysqli_fetch_array($sqlismainaccessuserdn);

$sqlismainaccessusersalepay=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Payments Received' order by id  asc");
$infomainaccessusersalepay=mysqli_fetch_array($sqlismainaccessusersalepay);

$sqlismainaccessusercr=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessusercr=mysqli_fetch_array($sqlismainaccessusercr);

$sqlismainaccessuserpurpay=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Payments Made' order by id  asc");
$infomainaccessuserpurpay=mysqli_fetch_array($sqlismainaccessuserpurpay);

$sqlismainaccessuservr=mysqli_query($con, "select modulename from pairmainaccess where userid='$companymainid' and moduletype='Vendor Refunds' order by id  asc");
$infomainaccessuservr=mysqli_fetch_array($sqlismainaccessuservr);

if ($_GET['types']=="customer") {
$sql = "SELECT 'invoice' as source,'invoice' as type, id as id, invoiceno as numbersview, invoiceno as numbers, invoiceno as numberspublic, invoicedate as dates, createdon as date_column,invoiceamount as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairinvoices WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND customerid='".$_GET['id']."' GROUP BY invoicedate, invoiceno UNION SELECT 'creditnote' as source,'creditnote' as type, id as id, creditnoteno as numbersview, creditnoteno as numbers, creditnoteno as numberspublic, creditnotedate as dates, createdon as date_column,creditnoteamount as amount,paidstatus as status,cancelstatus as cancelstatus FROM paircreditnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND customerid='".$_GET['id']."' GROUP BY creditnotedate, creditnoteno UNION SELECT 'salespayment' as source,module as type, id as id, receiptno as numbersview, privateid as numbers, publicid as numberspublic, receiptdate as dates, createdon as date_column,amount as amount,'None' as status,cancelstatus as cancelstatus FROM pairsalespayments WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND customerid='".$_GET['id']."' GROUP BY receiptdate, receiptno UNION SELECT 'customerrefund' as source,'creditnote' as type, id as id, receiptno as numbersview, privateid as numbers, publicid as numberspublic, receiptdate as dates, createdon as date_column,amount as amount,'None' as status,cancelstatus as cancelstatus FROM paircreditnotepayments WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND customerid='".$_GET['id']."' GROUP BY receiptdate, receiptno order by dates desc, numbers desc limit ".$_GET['term'].",20";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
$statusanswer = "None";
if($row['cancelstatus']=='1'){
  $statusanswer = "Void";
}
elseif($row['status']=='1'){
  $statusanswer = "Paid";
}
elseif($row['status']=='0'){
  $statusanswer = "Pending";
}
elseif($row['status']=='2'){
  $statusanswer = "Partially Paid";
}
$modulesourcename = '';
if ($row['source']=='invoice') {
  $modulesourcename = $infomainaccessuserinv['modulename'];
}
elseif($row['source']=='creditnote'){
  $modulesourcename = $infomainaccessusercn['modulename'];
}
elseif($row['source']=='salespayment'){
  $modulesourcename = $infomainaccessusersalepay['modulename'];
}
elseif($row['source']=='customerrefund'){
  $modulesourcename = $infomainaccessusercr['modulename'];
}
if(($row['source']=='invoice')||($row['source']=='creditnote')){
?>
<tr onclick="window.open('<?=$row['source']?>view.php?id=<?=$row['id']?>&<?=$row['source']?>no=<?=$row['numbers']?>&<?=$row['source']?>date=<?=$row['dates']?>','_self')">
<?php
}
else{
?>
<tr onclick="window.open('<?=$row['source']?>view.php?id=<?=$row['id']?>&receiptno=<?=$row['numbers']?>&receiptdate=<?=$row['dates']?>&publicid=<?= $row['numberspublic'] ?>','_self')">
<?php
}
?>
<td data-label="Date"><?=date('d/m/Y', strtotime($row['dates']))?></td>
<td data-label="No"><?=$row['numbers']?></td>
<td data-label="Type"><?=strtoupper($modulesourcename)?></td>
<!-- <td data-label="Quantity"><?=$row['qty']?></td> -->
<td data-label="Amount"><?php echo $res[0]; ?> <?=number_format((float)$row['amount'],2,'.','')?></td>
<td data-label="Status"><?=$statusanswer?></td>
</tr>
<?php
}
}

if ($_GET['types']=="vendor") {
$sql = "SELECT 'bill' as source,'bill' as type, id as id, billno as numbersview, billno as numbers, billno as numberspublic, billdate as dates, createdon as date_column,billamount as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairbills WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND vendorid='".$_GET['id']."' GROUP BY billdate, billno UNION SELECT 'debitnote' as source,'debitnote' as type, id as id, debitnoteno as numbersview, debitnoteno as numbers, debitnoteno as numberspublic, debitnotedate as dates, createdon as date_column,debitnoteamount as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairdebitnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND vendorid='".$_GET['id']."' GROUP BY debitnotedate, debitnoteno UNION SELECT 'purchasepayment' as source,module as type, id as id, receiptno as numbersview, privateid as numbers, publicid as numberspublic, receiptdate as dates, createdon as date_column,amount as amount,'None' as status,cancelstatus as cancelstatus FROM pairpurchasepayments WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND vendorid='".$_GET['id']."' GROUP BY receiptdate, receiptno UNION SELECT 'vendorrefund' as source,'debitnote' as type, id as id, receiptno as numbersview, privateid as numbers, publicid as numberspublic, receiptdate as dates, createdon as date_column,amount as amount,'None' as status,cancelstatus as cancelstatus FROM pairdebitnotepayments WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND vendorid='".$_GET['id']."' GROUP BY receiptdate, receiptno order by dates desc, numbers desc limit ".$_GET['term'].",20";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
$statusanswer = "None";
if($row['cancelstatus']=='1'){
  $statusanswer = "Void";
}
elseif($row['status']=='1'){
  $statusanswer = "Paid";
}
elseif($row['status']=='0'){
  $statusanswer = "Pending";
}
elseif($row['status']=='2'){
  $statusanswer = "Partially Paid";
}
$modulesourcename = '';
if ($row['source']=='bill') {
  $modulesourcename = $infomainaccessuserbill['modulename'];
}
elseif($row['source']=='debitnote'){
  $modulesourcename = $infomainaccessuserdn['modulename'];
}
elseif($row['source']=='purchasepayment'){
  $modulesourcename = $infomainaccessuserpurpay['modulename'];
}
elseif($row['source']=='vendorrefund'){
  $modulesourcename = $infomainaccessuservr['modulename'];
}
if(($row['source']=='bill')||($row['source']=='debitnote')){
?>
<tr onclick="window.open('<?=$row['source']?>view.php?id=<?=$row['id']?>&<?=$row['source']?>no=<?=$row['numbers']?>&<?=$row['source']?>date=<?=$row['dates']?>','_self')">
<?php
}
else{
?>
<tr onclick="window.open('<?=$row['source']?>view.php?id=<?=$row['id']?>&receiptno=<?=$row['numbers']?>&receiptdate=<?=$row['dates']?>&publicid=<?= $row['numberspublic'] ?>','_self')">
<?php
}
?>
<td data-label="Date"><?=date('d/m/Y', strtotime($row['dates']))?></td>
<td data-label="No"><?=$row['numbers']?></td>
<td data-label="Type"><?=strtoupper($modulesourcename)?></td>
<!-- <td data-label="Quantity"><?=$row['qty']?></td> -->
<td data-label="Amount"><?php echo $res[0]; ?> <?=number_format((float)$row['amount'],2,'.','')?></td>
<td data-label="Status"><?=$statusanswer?></td>
</tr>
<?php
}
}

if ($_GET['types']=="product") {
$sql = "SELECT 'invoice' as source, id as id, invoiceno as numbersview, invoiceno as numbers, invoicedate as dates, createdon as date_column, customername as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairinvoices WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='".$_GET['id']."' GROUP BY invoicedate, invoiceno UNION SELECT 'bill' as source,id as id, billno as numbersview, billno as numbers, billdate as dates, createdon as date_column, vendorname as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairbills WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='".$_GET['id']."' GROUP BY billdate, billno UNION SELECT 'creditnote' as source,id as id, creditnoteno as numbersview, creditnoteno as numbers, creditnotedate as dates, createdon as date_column, customername as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM paircreditnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='".$_GET['id']."' GROUP BY creditnotedate, creditnoteno UNION SELECT 'debitnote' as source,id as id, debitnoteno as numbersview, debitnoteno as numbers, debitnotedate as dates, createdon as date_column, vendorname as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairdebitnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='".$_GET['id']."' GROUP BY debitnotedate, debitnoteno UNION SELECT 'adjustment' as source,id as id, adjustmentno as numbersview, privateid as numbers, adjustmentdate as dates, createdon as date_column, 'None' as names,SUM(quantity) as qty,'None' as value,'None' as amount,'Adjusted' as status,'Adjusted' as cancelstatus FROM pairadjustments WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='".$_GET['id']."' GROUP BY adjustmentdate, adjustmentno order by dates desc, numbers desc limit ".$_GET['term'].",20";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
$statusanswer = "Adjusted";
if($row['cancelstatus']=='1'){
  $statusanswer = "Void";
}
elseif($row['status']=='1'){
  $statusanswer = "Paid";
}
elseif($row['status']=='0'){
  $statusanswer = "Pending";
}
elseif($row['status']=='2'){
  $statusanswer = "Partially Paid";
}
$modulesourcename = '';
if ($row['source']=='adjustment') {
  $modulesourcename = $infomainaccessuseradj['modulename'];
}
elseif($row['source']=='invoice'){
  $modulesourcename = $infomainaccessuserinv['modulename'];
}
elseif($row['source']=='bill'){
  $modulesourcename = $infomainaccessuserbill['modulename'];
}
elseif($row['source']=='creditnote'){
  $modulesourcename = $infomainaccessusercn['modulename'];
}
elseif($row['source']=='debitnote'){
  $modulesourcename = $infomainaccessuserdn['modulename'];
}
?>
<tr onclick="window.open('<?=$row['source']?>view.php?id=<?=$row['id']?>&<?=$row['source']?>no=<?=$row['numbersview']?>&<?=$row['source']?>date=<?=$row['dates']?>','_self')">
<td data-label="Date"><?=date('d/m/Y', strtotime($row['dates']))?></td>
<td data-label="Number"><?=$row['numbers']?></td>
<td data-label="Type"><?=strtoupper($modulesourcename)?></td>
<td data-label="Name"><?=$row['names']?></td>
<td data-label="Quantity"><?=$row['qty']?></td>
<td data-label="Value"><?php echo $res[0]; ?> <?=number_format((float)$row['value'],2,'.','')?></td>
<td data-label="Amount"><?php echo $res[0]; ?> <?=number_format((float)$row['amount'],2,'.','')?></td>
<td data-label="Status"><?=$statusanswer?></td>
</tr>
<?php
}
}

if ($_GET['types']=="service") {
$sql = "SELECT 'invoice' as source, id as id, invoiceno as numbersview, invoiceno as numbers, invoicedate as dates, createdon as date_column, customername as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairinvoices WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='".$_GET['id']."' GROUP BY invoicedate, invoiceno UNION SELECT 'bill' as source,id as id, billno as numbersview, billno as numbers, billdate as dates, createdon as date_column, vendorname as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairbills WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='".$_GET['id']."' GROUP BY billdate, billno UNION SELECT 'creditnote' as source,id as id, creditnoteno as numbersview, creditnoteno as numbers, creditnotedate as dates, createdon as date_column, customername as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM paircreditnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='".$_GET['id']."' GROUP BY creditnotedate, creditnoteno UNION SELECT 'debitnote' as source,id as id, debitnoteno as numbersview, debitnoteno as numbers, debitnotedate as dates, createdon as date_column, vendorname as names,SUM(quantity) as qty,productvalue as value,productnetvalue as amount,paidstatus as status,cancelstatus as cancelstatus FROM pairdebitnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='".$_GET['id']."' GROUP BY debitnotedate, debitnoteno UNION SELECT 'adjustment' as source,id as id, adjustmentno as numbersview, privateid as numbers, adjustmentdate as dates, createdon as date_column, 'None' as names,SUM(quantity) as qty,'None' as value,'None' as amount,'Adjusted' as status,'Adjusted' as cancelstatus FROM pairadjustments WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='".$companymainid."' AND productid='".$_GET['id']."' GROUP BY adjustmentdate, adjustmentno order by dates desc, numbers desc limit ".$_GET['term'].",20";
$result = $con->query($sql);
while ($row = $result->fetch_assoc()) {
$statusanswer = "Adjusted";
if($row['cancelstatus']=='1'){
  $statusanswer = "Void";
}
elseif($row['status']=='1'){
  $statusanswer = "Paid";
}
elseif($row['status']=='0'){
  $statusanswer = "Pending";
}
elseif($row['status']=='2'){
  $statusanswer = "Partially Paid";
}
$modulesourcename = '';
if ($row['source']=='adjustment') {
  $modulesourcename = $infomainaccessuseradj['modulename'];
}
elseif($row['source']=='invoice'){
  $modulesourcename = $infomainaccessuserinv['modulename'];
}
elseif($row['source']=='bill'){
  $modulesourcename = $infomainaccessuserbill['modulename'];
}
elseif($row['source']=='creditnote'){
  $modulesourcename = $infomainaccessusercn['modulename'];
}
elseif($row['source']=='debitnote'){
  $modulesourcename = $infomainaccessuserdn['modulename'];
}
?>
<tr onclick="window.open('<?=$row['source']?>view.php?id=<?=$row['id']?>&<?=$row['source']?>no=<?=$row['numbersview']?>&<?=$row['source']?>date=<?=$row['dates']?>','_self')">
<td data-label="Date"><?=date('d/m/Y', strtotime($row['dates']))?></td>
<td data-label="Number"><?=$row['numbers']?></td>
<td data-label="Type"><?=strtoupper($modulesourcename)?></td>
<td data-label="Name"><?=$row['names']?></td>
<td data-label="Quantity"><?=$row['qty']?></td>
<td data-label="Value"><?php echo $res[0]; ?> <?=number_format((float)$row['value'],2,'.','')?></td>
<td data-label="Amount"><?php echo $res[0]; ?> <?=number_format((float)$row['amount'],2,'.','')?></td>
<td data-label="Status"><?=$statusanswer?></td>
</tr>
<?php
}
}

}
?>