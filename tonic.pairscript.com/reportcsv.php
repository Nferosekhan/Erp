<?php
include('lcheck.php');
$sqlismainaccessuserinvs=$con->prepare("SELECT * FROM pairmainaccess WHERE franchiseid=? AND moduletype='Invoices' ORDER BY id ASC");
$sqlismainaccessuserinvs->bind_param("s", $_SESSION['franchisesession']);
$sqlismainaccessuserinvs->execute();
$sqlismainaccessuserinv = $sqlismainaccessuserinvs->get_result();
$infomainaccessuserinv=$sqlismainaccessuserinv->fetch_array();
$sqlismainaccessuserinv->close();
$sqlismainaccessuserinvs->close();
$sqlismainaccessuserbills=$con->prepare("SELECT * FROM pairmainaccess WHERE franchiseid=? AND moduletype='Bills' ORDER BY id ASC");
$sqlismainaccessuserbills->bind_param("s", $_SESSION['franchisesession']);
$sqlismainaccessuserbills->execute();
$sqlismainaccessuserbill = $sqlismainaccessuserbills->get_result();
$infomainaccessuserbill=$sqlismainaccessuserbill->fetch_array();
$sqlismainaccessuserbill->close();
$sqlismainaccessuserbills->close();

$sqlismainaccessusercreditnotes=$con->prepare("SELECT * FROM pairmainaccess WHERE franchiseid=? AND moduletype='Credit Notes' ORDER BY id ASC");
$sqlismainaccessusercreditnotes->bind_param("s", $_SESSION['franchisesession']);
$sqlismainaccessusercreditnotes->execute();
$sqlismainaccessusercreditnote = $sqlismainaccessusercreditnotes->get_result();
$infomainaccessusercreditnote=$sqlismainaccessusercreditnote->fetch_array();
$sqlismainaccessusercreditnote->close();
$sqlismainaccessusercreditnotes->close();
$sqlismainaccessuserdebitnotes=$con->prepare("SELECT * FROM pairmainaccess WHERE franchiseid=? AND moduletype='Debit Notes' ORDER BY id ASC");
$sqlismainaccessuserdebitnotes->bind_param("s", $_SESSION['franchisesession']);
$sqlismainaccessuserdebitnotes->execute();
$sqlismainaccessuserdebitnote = $sqlismainaccessuserdebitnotes->get_result();
$infomainaccessuserdebitnote=$sqlismainaccessuserdebitnote->fetch_array();
$sqlismainaccessuserdebitnote->close();
$sqlismainaccessuserdebitnotes->close();

$sqlismainaccessusercus=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customers' order by id  asc");
$infomainaccessusercus=mysqli_fetch_array($sqlismainaccessusercus);
$sqlismainaccessuserven=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Vendors' order by id  asc");
$infomainaccessuserven=mysqli_fetch_array($sqlismainaccessuserven);
if($_GET['term']=='inv'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='inv' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$anscheck = $sqlviewreport['rowcolumns'];
$newanscheck = explode(',',$anscheck);
if(in_array('Sno', $newanscheck)){
$snoans = '#';
}
else{
$snoans = '-';
}
if(in_array('Customer Name', $newanscheck)){
$nameans = $infomainaccessusercus['modulename'].' Name';
}
else{
$nameans = '-';
}
if(in_array('City', $newanscheck)){
$cityans = 'City';
}
else{
$cityans = '-';
}
if(in_array('Balance Due', $newanscheck)){
$balanceans = 'Balance';
}
else{
$balanceans = '-';
}
if(in_array('Payment Term', $newanscheck)){
$termans = 'Term';
}
else{
$termans = '-';
}
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'and (invoicedate>='".$_GET['from']."' and invoicedate<='".$_GET['to']."') and (invoicetime>='".$_GET['timefrom']."' and invoicetime<='".$_GET['timeto']."')".(($_GET['names']=='all')?' ':' and customerid="'.$_GET['names'].'"')."".(($_GET['payterm']=='all')?' ':' and invoiceterm="'.$_GET['payterm'].'"')." GROUP BY invoicedate, invoiceno LIMIT $offset, $rowsPerFile");

if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Invoice-Reports-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Invoice-Reports-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
// $fields = array($_GET['cusvenname']);
// fputcsv($f, $fields, $delimiter);
// if (in_array('Sno', $newanscheck)) {
// $fields = array('Sno','Status','Date','Number',''.$infomainaccessusercus['modulename'].' Name','City','Total','Balance');
// fputcsv($f, $fields, $delimiter);
// }
// else{
$fields = array($snoans,'Status','Date','Number',$nameans,$cityans,'Total',$balanceans,$termans);
fputcsv($f, $fields, $delimiter);
// }

$count=1;
$invoiceamount=0;
$balanceamount=0;
$currentamount=0;
$overdueamount=0;
$crb=0;
$int=0;
while ($info = $query->fetch_assoc()) {
$invoiceamount+=(float)$info['invoiceamount'];
$currentamount=(float)$info['invoiceamount'];
$paidamount=0;
$currentbalance=0;
$sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$info['invoiceno']."' and (invoicedate>='".$_GET['from']."' and invoicedate<='".$_GET['to']."') order by id desc");
while($infosalespay=mysqli_fetch_array($sqlsalespay))
{
$paidamount+=(float)$infosalespay['amount'];
}
$currentbalance=((float)$info['invoiceamount']-$paidamount);
$crb+=$currentbalance;
$int+=$info['grandtotal'];
$balanceamount+=((float)$info['invoiceamount']-$paidamount);
if($info['cancelstatus']=='1')
{
$status ='Void';
}
else{
if($currentbalance==0)
{
$status ='Paid';
}
else
{
if($currentbalance==$currentamount)
{
$status ='Pending';
}
else
{
$status ='Partially Paid';
}
}
}
$lineData = array((((in_array('Sno', $newanscheck)))?$count:'-'),$status,str_pad($info['invoicedate'],300),$info['invoiceno'],(((in_array('Customer Name', $newanscheck)))?$info['customername']:'-'),(((in_array('City', $newanscheck)))?str_pad($info['city'],300):'-'),number_format((float)$info['grandtotal'],2,'.',','),(((in_array('Balance Due', $newanscheck)))?str_pad(number_format((float)$currentbalance,2,'.',','),300):'-'),(((in_array('Payment Term', $newanscheck)))?str_pad($info['invoiceterm'],300):'-'));
fputcsv($f, $lineData, $delimiter);
$count++;
}

if (mysqli_num_rows($query)>0) {
// if ((in_array('Payment Term', $newanscheck))&&(in_array('Sno', $newanscheck))&&(in_array('City', $newanscheck))){
// $lineData = array("Total","","","","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','),"");
// fputcsv($f, $lineData, $delimiter);
// }
// elseif ((!in_array('Payment Term', $newanscheck))&&(in_array('Sno', $newanscheck))&&(!in_array('City', $newanscheck))) {
// $lineData = array("Total","","","","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','),"");
// fputcsv($f, $lineData, $delimiter);
// }
// elseif ((in_array('Payment Term', $newanscheck))&&(!in_array('Sno', $newanscheck))&&(!in_array('City', $newanscheck))){
// $lineData = array("Total","","","","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','),"");
// fputcsv($f, $lineData, $delimiter);
// }
// elseif ((!in_array('Payment Term', $newanscheck))&&(!in_array('Sno', $newanscheck))&&(in_array('City', $newanscheck))){
// $lineData = array("Total","","","","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','),"");
// fputcsv($f, $lineData, $delimiter);
// }
// elseif ((!in_array('Payment Term', $newanscheck))&&(in_array('Sno', $newanscheck))&&(in_array('City', $newanscheck))){
// $lineData = array("Total","","","","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','),"");
// fputcsv($f, $lineData, $delimiter);
// }
// elseif ((in_array('Payment Term', $newanscheck))&&(!in_array('Sno', $newanscheck))&&(in_array('City', $newanscheck))){
// $lineData = array("Total","","","","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','),"");
// fputcsv($f, $lineData, $delimiter);
// }
// elseif ((in_array('Payment Term', $newanscheck))&&(in_array('Sno', $newanscheck))&&(!in_array('City', $newanscheck))){
// $lineData = array("Total","","","","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','),"");
// fputcsv($f, $lineData, $delimiter);
// }
// else{
$lineData = array("Total","","","","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','),"");
fputcsv($f, $lineData, $delimiter);
// }
}
fclose($f);

$fileCounter++;
}
} while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='bill'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='bill' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$anscheck = $sqlviewreport['rowcolumns'];
$newanscheck = explode(',',$anscheck);
if(in_array('Vendor Name', $newanscheck)){
$nameans = $infomainaccessuserven['modulename'].' Name';
}
else{
$nameans = '-';
}
if(in_array('City', $newanscheck)){
$cityans = 'City';
}
else{
$cityans = '-';
}
if(in_array('Balance Due', $newanscheck)){
$balanceans = 'Balance';
}
else{
$balanceans = '-';
}
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'and (billdate>='".$_GET['from']."' and billdate<='".$_GET['to']."')".(($_GET['names']=='all')?' ':' and vendorid="'.$_GET['names'].'"')." GROUP BY billdate, billno LIMIT $offset, $rowsPerFile");

if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Bill-Reports-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Bill-Reports-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
// $fields = array($_GET['cusvenname']);
// fputcsv($f, $fields, $delimiter);
$fields = array('Status','Date','Number',$nameans,$cityans,'Total',$balanceans);
fputcsv($f, $fields, $delimiter);

$count=1;
$billamount=0;
$balanceamount=0;
$currentamount=0;
$overdueamount=0;
$crb=0;
$int=0;
while ($info = $query->fetch_assoc()) {
$billamount+=(float)$info['billamount'];
$currentamount=(float)$info['billamount'];
$paidamount=0;
$currentbalance=0;
$sqlsalespay=mysqli_query($con,"select amount from pairpurchasepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='".$info['billno']."' and (billdate>='".$_GET['from']."' and billdate<='".$_GET['to']."') order by id desc");
while($infosalespay=mysqli_fetch_array($sqlsalespay))
{
$paidamount+=(float)$infosalespay['amount'];
}
$currentbalance=((float)$info['billamount']-$paidamount);
$crb+=$currentbalance;
$int+=$info['grandtotal'];
$balanceamount+=((float)$info['billamount']-$paidamount);
if($info['cancelstatus']=='1')
{
$status ='Void';
}
else{
if($currentbalance==0)
{
$status ='Paid';
}
else
{
if($currentbalance==$currentamount)
{
$status ='Pending';
}
else
{
$status ='Partially Paid';
}
}
}
$lineData = array($status,str_pad($info['billdate'],300),$info['billno'],(((in_array('Vendor Name', $newanscheck)))?$info['vendorname']:'-'),(((in_array('City', $newanscheck)))?str_pad($info['city'],300):'-'),number_format((float)$info['grandtotal'],2,'.',','),(((in_array('Balance Due', $newanscheck)))?str_pad(number_format((float)$currentbalance,2,'.',','),300):'-'));
fputcsv($f, $lineData, $delimiter);
}

if (mysqli_num_rows($query)>0) {
// if ((in_array('City', $newanscheck))){
// $lineData = array("Total","","","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','));
// fputcsv($f, $lineData, $delimiter);
// }
// else{
$lineData = array("Total","","","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','));
fputcsv($f, $lineData, $delimiter);
// }
}
fclose($f);

$fileCounter++;
}
} while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='inward'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='inw' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
// do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (billdate>='".$_GET['from']."' and billdate<='".$_GET['to']."') and cancelstatus='0' GROUP BY billdate, billno");

// if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Inward-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Inward-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
$fields = array('DESCRIPTION','IGST AMOUNT','CGST AMOUNT','SGST AMOUNT','BILLS TOTAL');
fputcsv($f, $fields, $delimiter);

$registerigst = 0;
$registercgst = 0;
$registersgst = 0;
$registerbilltotal = 0;
while ($register = $query->fetch_assoc()) {
$anstax = $register['tax'];
$anscgst = $register['cgst'];
$anssgst = $register['sgst'];
$ansigst = $register['igst'];
$ansgst = $register['gst'];
$ansgstpercent = $register['gstpercent'];
$anscsgstpercent = $register['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
for ($i=1; $i <count($newtaxes) ; $i++) {
$registerposics=$register['pos'];
$registerfranposics=$franpos;
if($registerposics=="")
{
$registerposics="TAMIL NADU (33)";
}
if($registerfranposics=="")
{
$registerfranposics="TAMIL NADU (33)";
}
if($registerposics!=$registerfranposics)
{
$registerigst += $newgst[$i];
$registercgst += 0.00;
$registersgst += 0.00;
}
else{
$registerigst += 0.00;
$registercgst += $newcgst[$i];
$registersgst += $newsgst[$i];
}
$registerbilltotal += $register['grandtotal'];
}
}
$registerlineData = array("Purchases Received From Registered taxpayers",$registerigst,$registercgst,$registersgst,$registerbilltotal);
fputcsv($f, $registerlineData, $delimiter);

$sqlconsumer=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (billdate>='".$_GET['from']."' and billdate<='".$_GET['to']."') and cancelstatus='0' GROUP BY billdate, billno");
$consumerigst = 0;
$consumercgst = 0;
$consumersgst = 0;
$consumerbilltotal = 0;
while($consumer=mysqli_fetch_array($sqlconsumer)){
$anstax = $consumer['tax'];
$anscgst = $consumer['cgst'];
$anssgst = $consumer['sgst'];
$ansigst = $consumer['igst'];
$ansgst = $consumer['gst'];
$ansgstpercent = $consumer['gstpercent'];
$anscsgstpercent = $consumer['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
for ($i=1; $i <count($newtaxes) ; $i++) {
$consumerposics=$consumer['pos'];
$consumerfranposics=$franpos;
if($consumerposics=="")
{
$consumerposics="TAMIL NADU (33)";
}
if($consumerfranposics=="")
{
$consumerfranposics="TAMIL NADU (33)";
}
if($consumerposics!=$consumerfranposics)
{
$consumerigst += $newgst[$i];
$consumercgst += 0.00;
$consumersgst += 0.00;
}
else{
$consumerigst += 0.00;
$consumercgst += $newcgst[$i];
$consumersgst += $newsgst[$i];
}
$consumerbilltotal += $consumer['grandtotal'];
}
}
$consumerlineData = array("Purchases Received From Unregistered (Consumer) taxpayers",$consumerigst,$consumercgst,$consumersgst,$consumerbilltotal);
fputcsv($f, $consumerlineData, $delimiter);

$sqlhsn=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (billdate>='".$_GET['from']."' and billdate<='".$_GET['to']."') and cancelstatus='0' GROUP BY billdate, billno");
$hsnigst = 0;
$hsncgst = 0;
$hsnsgst = 0;
$hsnbilltotal = 0;
while($hsn=mysqli_fetch_array($sqlhsn)){
$anstax = $hsn['tax'];
$anscgst = $hsn['cgst'];
$anssgst = $hsn['sgst'];
$ansigst = $hsn['igst'];
$ansgst = $hsn['gst'];
$ansgstpercent = $hsn['gstpercent'];
$anscsgstpercent = $hsn['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
for ($i=1; $i <count($newtaxes) ; $i++) {
$hsnposics=$hsn['pos'];
$hsnfranposics=$franpos;
if($hsnposics=="")
{
$hsnposics="TAMIL NADU (33)";
}
if($hsnfranposics=="")
{
$hsnfranposics="TAMIL NADU (33)";
}
if($hsnposics!=$hsnfranposics)
{
$hsnigst += $newgst[$i];
$hsncgst += 0.00;
$hsnsgst += 0.00;
}
else{
$hsnigst += 0.00;
$hsncgst += $newcgst[$i];
$hsnsgst += $newsgst[$i];
}
$hsnbilltotal += $hsn['grandtotal'];
}
}
$hsnlineData = array("HSN-wise summary of inward supplies",$hsnigst,$hsncgst,$hsnsgst,$hsnbilltotal);
fputcsv($f, $hsnlineData, $delimiter);

fclose($f);

// $fileCounter++;
// }
// } while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='outward'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='ouw' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
// do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (invoicedate>='".$_GET['from']."' and invoicedate<='".$_GET['to']."') and cancelstatus='0' GROUP BY invoicedate, invoiceno");

// if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Outward-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Outward-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
$fields = array('DESCRIPTION','IGST AMOUNT','CGST AMOUNT','SGST AMOUNT','INVOICES TOTAL');
fputcsv($f, $fields, $delimiter);

$registerigst = 0;
$registercgst = 0;
$registersgst = 0;
$registerbilltotal = 0;
while ($register = $query->fetch_assoc()) {
$anstax = $register['tax'];
$anscgst = $register['cgst'];
$anssgst = $register['sgst'];
$ansigst = $register['igst'];
$ansgst = $register['gst'];
$ansgstpercent = $register['gstpercent'];
$anscsgstpercent = $register['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
for ($i=1; $i <count($newtaxes) ; $i++) {
$registerposics=$register['pos'];
$registerfranposics=$franpos;
if($registerposics=="")
{
$registerposics="TAMIL NADU (33)";
}
if($registerfranposics=="")
{
$registerfranposics="TAMIL NADU (33)";
}
if($registerposics!=$registerfranposics)
{
$registerigst += $newgst[$i];
$registercgst += 0.00;
$registersgst += 0.00;
}
else{
$registerigst += 0.00;
$registercgst += $newcgst[$i];
$registersgst += $newsgst[$i];
}
$registerbilltotal += $register['grandtotal'];
}
}
$registerlineData = array("Taxable outward supplies made to registered persons",$registerigst,$registercgst,$registersgst,$registerbilltotal);
fputcsv($f, $registerlineData, $delimiter);

$sqlconsumer=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (invoicedate>='".$_GET['from']."' and invoicedate<='".$_GET['to']."') and cancelstatus='0' GROUP BY invoicedate, invoiceno");
$consumerigst = 0;
$consumercgst = 0;
$consumersgst = 0;
$consumerbilltotal = 0;
while($consumer=mysqli_fetch_array($sqlconsumer)){
$anstax = $consumer['tax'];
$anscgst = $consumer['cgst'];
$anssgst = $consumer['sgst'];
$ansigst = $consumer['igst'];
$ansgst = $consumer['gst'];
$ansgstpercent = $consumer['gstpercent'];
$anscsgstpercent = $consumer['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
for ($i=1; $i <count($newtaxes) ; $i++) {
$consumerposics=$consumer['pos'];
$consumerfranposics=$franpos;
if($consumerposics=="")
{
$consumerposics="TAMIL NADU (33)";
}
if($consumerfranposics=="")
{
$consumerfranposics="TAMIL NADU (33)";
}
if($consumerposics!=$consumerfranposics)
{
$consumerigst += $newgst[$i];
$consumercgst += 0.00;
$consumersgst += 0.00;
}
else{
$consumerigst += 0.00;
$consumercgst += $newcgst[$i];
$consumersgst += $newsgst[$i];
}
$consumerbilltotal += $consumer['grandtotal'];
}
}
$consumerlineData = array("Taxable outward supplies to consumer",$consumerigst,$consumercgst,$consumersgst,$consumerbilltotal);
fputcsv($f, $consumerlineData, $delimiter);

$sqlhsn=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (invoicedate>='".$_GET['from']."' and invoicedate<='".$_GET['to']."') and cancelstatus='0' GROUP BY invoicedate, invoiceno");
$hsnigst = 0;
$hsncgst = 0;
$hsnsgst = 0;
$hsnbilltotal = 0;
while($hsn=mysqli_fetch_array($sqlhsn)){
$anstax = $hsn['tax'];
$anscgst = $hsn['cgst'];
$anssgst = $hsn['sgst'];
$ansigst = $hsn['igst'];
$ansgst = $hsn['gst'];
$ansgstpercent = $hsn['gstpercent'];
$anscsgstpercent = $hsn['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
for ($i=1; $i <count($newtaxes) ; $i++) {
$hsnposics=$hsn['pos'];
$hsnfranposics=$franpos;
if($hsnposics=="")
{
$hsnposics="TAMIL NADU (33)";
}
if($hsnfranposics=="")
{
$hsnfranposics="TAMIL NADU (33)";
}
if($hsnposics!=$hsnfranposics)
{
$hsnigst += $newgst[$i];
$hsncgst += 0.00;
$hsnsgst += 0.00;
}
else{
$hsnigst += 0.00;
$hsncgst += $newcgst[$i];
$hsnsgst += $newsgst[$i];
}
$hsnbilltotal += $hsn['grandtotal'];
}
}
$hsnlineData = array("HSN-wise summary of outward supplies",$hsnigst,$hsncgst,$hsnsgst,$hsnbilltotal);
fputcsv($f, $hsnlineData, $delimiter);

fclose($f);

// $fileCounter++;
// }
// } while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='inwardreg'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='inwreg' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (billdate>='".$_GET['datefrom']."' and billdate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY billdate, billno order by billdate asc, billno asc");
while($info=mysqli_fetch_array($sql))
{
$anstax = $info['tax'];
$anscgst = $info['cgst'];
$anssgst = $info['sgst'];
$ansigst = $info['igst'];
$ansgst = $info['gst'];
$ansgstpercent = $info['gstpercent'];
$anscsgstpercent = $info['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
$infoposics=$info['pos'];
$infofranposics=$franpos;
if($infoposics=="")
{
$infoposics="TAMIL NADU (33)";
}
if($infofranposics=="")
{
$infofranposics="TAMIL NADU (33)";
}
if($infoposics!=$infofranposics){
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span></td>
<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['vendorname']?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['billno']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['invnumber']?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['billdate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxablebill"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newgst[$i]?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
</tr>
<?php
}
$count++;
}
else{
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span></td>
<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['vendorname']?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['billno']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['invnumber']?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['billdate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxablebill"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newcgst[$i]?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newsgst[$i]?></td>
</tr>
<?php
}
$count++;
}
}
}
if($_GET['term']=='outwardreg'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='ouwreg' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY invoicedate, invoiceno order by invoicedate asc, invoiceno asc");
while($info=mysqli_fetch_array($sql))
{
$anstax = $info['tax'];
$anscgst = $info['cgst'];
$anssgst = $info['sgst'];
$ansigst = $info['igst'];
$ansgst = $info['gst'];
$ansgstpercent = $info['gstpercent'];
$anscsgstpercent = $info['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
$infoposics=$info['pos'];
$infofranposics=$franpos;
if($infoposics=="")
{
$infoposics="TAMIL NADU (33)";
}
if($infofranposics=="")
{
$infofranposics="TAMIL NADU (33)";
}
if($infoposics!=$infofranposics){
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span></td>
<td data-label="<?=$infomainaccessusercus['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['customername']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['invoiceno']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['invoicedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxableinv"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newgst[$i]?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
</tr>
<?php
}
$count++;
}
else{
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span></td>
<td data-label="<?=$infomainaccessusercus['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['customername']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['invoiceno']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['invoicedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxableinv"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newcgst[$i]?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newsgst[$i]?></td>
</tr>
<?php
}
$count++;
}
}
}
if($_GET['term']=='inwardcon'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='inwcon' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (billdate>='".$_GET['datefrom']."' and billdate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY billdate, billno order by billdate asc, billno asc");
while($info=mysqli_fetch_array($sql))
{
$anstax = $info['tax'];
$anscgst = $info['cgst'];
$anssgst = $info['sgst'];
$ansigst = $info['igst'];
$ansgst = $info['gst'];
$ansgstpercent = $info['gstpercent'];
$anscsgstpercent = $info['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
$infoposics=$info['pos'];
$infofranposics=$franpos;
if($infoposics=="")
{
$infoposics="TAMIL NADU (33)";
}
if($infofranposics=="")
{
$infofranposics="TAMIL NADU (33)";
}
if($infoposics!=$infofranposics){
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['vendorname']?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['billno']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['invnumber']?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['billdate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxablebill"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newgst[$i]?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
</tr>
<?php
}
$count++;
}
else{
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['vendorname']?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['billno']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['invnumber']?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['billdate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxablebill"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newcgst[$i]?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newsgst[$i]?></td>
</tr>
<?php
}
$count++;
}
}
}
if($_GET['term']=='outwardcon'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='ouwcon' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY invoicedate, invoiceno order by invoicedate asc, invoiceno asc");
while($info=mysqli_fetch_array($sql))
{
$anstax = $info['tax'];
$anscgst = $info['cgst'];
$anssgst = $info['sgst'];
$ansigst = $info['igst'];
$ansgst = $info['gst'];
$ansgstpercent = $info['gstpercent'];
$anscsgstpercent = $info['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
$infoposics=$info['pos'];
$infofranposics=$franpos;
if($infoposics=="")
{
$infoposics="TAMIL NADU (33)";
}
if($infofranposics=="")
{
$infofranposics="TAMIL NADU (33)";
}
if($infoposics!=$infofranposics){
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="<?=$infomainaccessusercus['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['customername']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['invoiceno']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['invoicedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxableinv"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newgst[$i]?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
</tr>
<?php
}
$count++;
}
else{
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['customername']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['invoiceno']?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['invoicedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxableinv"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newcgst[$i]?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newsgst[$i]?></td>
</tr>
<?php
}
$count++;
}
}
}
if($_GET['term']=='outwardhsn'){
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (invoicedate>='".$_GET['from']."' and invoicedate<='".$_GET['to']."') and cancelstatus='0' order by producthsn asc,productname asc LIMIT $offset, $rowsPerFile");

if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Outward-Hsn-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Outward-Hsn-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
$fields = array('HSN/SAC','Product Name','Unit','Quantity','Total Value','GST','Taxable Value','CGST','SGST');
fputcsv($f, $fields, $delimiter);

while ($info = $query->fetch_assoc()) {
$lineData = array($info['producthsn'],mysqli_real_escape_string($con,$info['productname']),$info['unit'],$info['quantity'],number_format((float)$info['productnetvalue'],2,'.',','),$info['vat'],number_format((float)$info['productvalue'],2,'.',','),number_format((float)$info['cgstvat'],2,'.',','),number_format((float)$info['sgstvat'],2,'.',','));
fputcsv($f, $lineData, $delimiter);
}

fclose($f);

$fileCounter++;
}
} while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='sales'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='sales' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$anscheck = $sqlviewreport['rowcolumns'];
$newanscheck = explode(',',$anscheck);
if(in_array('Sno', $newanscheck)){
$snoans = '#';
}
else{
$snoans = '-';
}
if(in_array('Payment Term', $newanscheck)){
$termans = 'Term';
}
else{
$termans = '-';
}
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select invoiceterm,productid,productname,sum(quantity) as quantity,sum(productvalue) as productvalue from pairinvoices where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and (invoicedate>='".$_GET['from']."' and invoicedate<='".$_GET['to']."') and (invoicetime>='".$_GET['timefrom']."' and invoicetime<='".$_GET['timeto']."')".(($_GET['payterm']=='all')?' ':' and invoiceterm="'.$_GET['payterm'].'"')." group by productid limit $offset, $rowsPerFile");

if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Sales-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Sales-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
// if (in_array('Sno', $newanscheck)) {
// $fields = array('Sno','Product Name','Quantity','Amount');
// fputcsv($f, $fields, $delimiter);
// }
// else{
$fields = array($snoans,'Product Name','Quantity','Amount',$termans);
fputcsv($f, $fields, $delimiter);
// }
$count=1;

while ($info = $query->fetch_assoc()) {
$sqlselproname = mysqli_query($con,"select productname from pairproducts where id='".$info['productid']."'");
$fetsqlproname = mysqli_fetch_array($sqlselproname);
// if (in_array('Sno', $newanscheck)) {
// $lineData = array($count,str_pad($fetsqlproname['productname'],1000),str_pad($info['quantity'],300),number_format($info['productvalue'],2,'.',','));
// fputcsv($f, $lineData, $delimiter);
// }
// else{
$lineData = array((((in_array('Sno', $newanscheck)))?$count:'-'),str_pad($fetsqlproname['productname'],1000),str_pad($info['quantity'],300),number_format($info['productvalue'],2,'.',','),(((in_array('Payment Term', $newanscheck)))?str_pad((($_GET['payterm']=='all')?'All':$info['invoiceterm']),300):'-'));
fputcsv($f, $lineData, $delimiter);
// }
$count++;
}

fclose($f);

$fileCounter++;
}
} while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='cust'){
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select customername, customerid,invoiceamount from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (invoicedate>='".$_GET['from']."' and invoicedate<='".$_GET['to']."') GROUP BY customerid limit $offset, $rowsPerFile");

if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Balance-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Balance-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
$fields = array('Customer Name','Invoice Amount','Balance');
fputcsv($f, $fields, $delimiter);

$crb=0;
$int=0;
while ($info = $query->fetch_assoc()) {
  $sqliinvoice=mysqli_query($con, "select customername, customerid,invoiceamount, invoicedate, invoiceno from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='".$info['customerid']."' GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc");
  $invoiceamount=0;
  $balanceamount=0;
  $currentamount=0;
  $overdueamount=0;
  while($infoinvoice=mysqli_fetch_array($sqliinvoice)){
    $customerid = $infoinvoice['customerid'];
    $customername = $infoinvoice['customername'];
    $invoiceamount+=(float)$infoinvoice['invoiceamount'];
    $paidamount=0;
    $sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$infoinvoice['invoiceno']."' and invoicedate='".$infoinvoice['invoicedate']."' and customerid='".$customerid."' order by id desc");
    while($infosalespay=mysqli_fetch_array($sqlsalespay))
    {
      $paidamount+=(float)$infosalespay['amount'];
    }
    $balanceamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
 }
$crb+=$balanceamount;
$int+=$invoiceamount;
$lineData = array(str_pad($customername,1000),str_pad(number_format($invoiceamount,2,'.',','),300),str_pad(number_format($balanceamount,2,'.',','),300));
fputcsv($f, $lineData, $delimiter);
}

$lineData = array("Total",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','));
fputcsv($f, $lineData, $delimiter);

fclose($f);

$fileCounter++;
}
} while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='saledetails'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='saledetails' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$anscheck = $sqlviewreport['rowcolumns'];
$newanscheck = explode(',',$anscheck);
if(in_array('Sno', $newanscheck)){
$snoans = '#';
}
else{
$snoans = '-';
}
if(in_array('Payment Term', $newanscheck)){
$termans = 'Term';
}
else{
$termans = '-';
}
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select invoiceterm,productname,sum(quantity) as quantity,sum(productvalue) as productvalue,invoiceno,invoicedate from pairinvoices where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and (invoicedate>='".$_GET['from']."' and invoicedate<='".$_GET['to']."') and (invoicetime>='".$_GET['timefrom']."' and invoicetime<='".$_GET['timeto']."')".(($_GET['payterm']=='all')?' ':' and invoiceterm="'.$_GET['payterm'].'"')." and productid='".$_GET['productid']."' group by invoiceno,invoicedate limit $offset, $rowsPerFile");

if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Sales Details-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Sales Details-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
// if (in_array('Sno', $newanscheck)) {
// $fields = array('Sno','Product Name','Invoice Number','Invoice Date','Quantity','Amount');
// fputcsv($f, $fields, $delimiter);
// }
// else{
$fields = array($snoans,'Product Name','Invoice Number','Invoice Date','Quantity','Amount',$termans);
fputcsv($f, $fields, $delimiter);
// }

$count=1;
while ($info = $query->fetch_assoc()) {
$sqlselproname = mysqli_query($con,"select productname from pairproducts where id='".$_GET['productid']."'");
$fetsqlproname = mysqli_fetch_array($sqlselproname);
// if (in_array('Sno', $newanscheck)) {
// $lineData = array($count,str_pad($fetsqlproname['productname'],1000),str_pad($info['invoiceno'],300),str_pad($info['invoicedate'],300),str_pad($info['quantity'],300),str_pad(number_format($info['productvalue'],2,'.',','),300));
// fputcsv($f, $lineData, $delimiter);
// }
// else{
$lineData = array((((in_array('Sno', $newanscheck)))?$count:'-'),str_pad($fetsqlproname['productname'],1000),str_pad($info['invoiceno'],300),str_pad($info['invoicedate'],300),str_pad($info['quantity'],300),str_pad(number_format($info['productvalue'],2,'.',','),300),(((in_array('Payment Term', $newanscheck)))?str_pad($info['invoiceterm'],300):'-'));
fputcsv($f, $lineData, $delimiter);
// }
$count++;
}

fclose($f);

$fileCounter++;
}
} while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='custdetails'){
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("SELECT 
                    'invoice' AS type,
                    pi.customername, 
                    pi.customerid, 
                    pi.invoiceamount AS amount, 
                    pi.invoiceno AS noteno, 
                    pi.invoicedate AS notedate, 
                    pi.duedate, 
                    COALESCE(SUM(psh.amount), 0) AS paidamount,
                    (pi.invoiceamount - COALESCE(SUM(psh.amount), 0)) AS balanceamount
                FROM 
                    pairinvoices pi
                LEFT JOIN 
                    pairsalespayhistory psh ON pi.invoiceno = psh.invoiceno AND pi.invoicedate = psh.invoicedate
                WHERE 
                    pi.franchisesession = '".$_SESSION['franchisesession']."' 
                    AND pi.createdid = '$companymainid' 
                    AND (pi.invoicedate >= '".$_GET['from']."' AND pi.invoicedate <= '".$_GET['to']."')
                    AND pi.customerid = '".$_GET['customerid']."'
                GROUP BY 
                    pi.invoiceno, pi.invoicedate
                UNION
                SELECT 
                    'creditnote' AS type,
                    pcn.customername, 
                    pcn.customerid, 
                    pcn.creditnoteamount AS amount, 
                    pcn.creditnoteno AS noteno, 
                    pcn.creditnotedate AS notedate, 
                    pcn.duedate,
                    COALESCE(SUM(pcnph.amount), 0) AS paidamount,
                    (pcn.creditnoteamount - COALESCE(SUM(pcnph.amount), 0)) AS balanceamount
                FROM 
                    paircreditnotes pcn
                LEFT JOIN 
                    paircreditnotepayhistory pcnph ON pcn.creditnoteno = pcnph.creditnoteno AND pcn.creditnotedate = pcnph.creditnotedate
                WHERE 
                    pcn.franchisesession = '".$_SESSION['franchisesession']."' 
                    AND pcn.createdid = '$companymainid' 
                    AND (pcn.creditnotedate >= '".$_GET['from']."' AND pcn.creditnotedate <= '".$_GET['to']."')
                    AND pcn.customerid = '".$_GET['customerid']."'
                GROUP BY 
                    pcn.creditnoteno, pcn.creditnotedate
                ORDER BY 
                    notedate ASC limit $offset, $rowsPerFile");

$int = 0;
$crb = 0;
if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Balance Details-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Balance Details-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
$fields = array('Customer Name','Invoice Number','Invoice Date','Invoice Amount','Balance','Over Due');
fputcsv($f, $fields, $delimiter);

while ($info = $query->fetch_assoc()) {
     $int += $info['amount'];
    $balanceamount = $info['balanceamount'];
    $crb += $balanceamount;
$lineData = array(str_pad($info['customername'],1000),str_pad($info['noteno'],300),str_pad($info['notedate'],300),str_pad(number_format($info['amount'],2,'.',','),300),str_pad(number_format($balanceamount,2,'.',','),300),str_pad((($balanceamount>0)?calculateOverdueDays($info['duedate'], date("Y-m-d")):'No Due'),1000));
fputcsv($f, $lineData, $delimiter);
}
$lineData = array("Total","","",number_format((float)$int,2,'.',','),number_format((float)$crb,2,'.',','));
fputcsv($f, $lineData, $delimiter);

fclose($f);

$fileCounter++;
}
} while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='journal'){
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select customerid, chartaccountname, customername, sum(ledgerdebit) as ledgerdebit, sum(ledgercredit) as ledgercredit, notes,ledgerdate, ledgerno, referenceno, referencedate, totalledgerdebit, totalledgercredit, id, type from pairledgers where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (ledgerdate>='".$_GET['from']."' and ledgerdate<='".$_GET['to']."') group by chartaccountid,ledgerdate,ledgerno,type order by ledgerdate,ledgerno,type asc limit $offset, $rowsPerFile");

if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Journal-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Journal-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);

$ledgerno = '';
$totalCredit = 0;
$totalDebit = 0;
while ($infojournal = $query->fetch_assoc()) {
    if (($ledgerno!=$infojournal['ledgerno'].'-'.$infojournal['ledgerdate'].'-'.$infojournal['type'])) {
      if (!empty($ledgerno)) {
            $lineData = array(str_pad(' ',1000),str_pad(number_format($totalDebit,2,'.',','),300),str_pad(number_format($totalCredit,2,'.',','),300));
				fputcsv($f, $lineData, $delimiter);
            $totalCredit = 0;
            $totalDebit = 0;
        }
    $ledgerno = $infojournal['ledgerno'].'-'.$infojournal['ledgerdate'].'-'.$infojournal['type'];
    $sqlijournalcustname=mysqli_query($con, "select customerid, customername from pairledgers where ledgerno='".$infojournal['ledgerno']."' and ledgerdate='".$infojournal['ledgerdate']."' and ledgerdebit!='0'");
    $infojournalcustname=mysqli_fetch_array($sqlijournalcustname);
    $custnamesledger='('.$infojournalcustname['customername'].')';
$lineData = array(str_pad(date($datemainphp,strtotime($infojournal['ledgerdate'])).' - '.strtoupper($infojournal['type']).' '.$infojournal['ledgerno'].' '.$custnamesledger,1000),str_pad('Debit',300),str_pad('Credit',300));
fputcsv($f, $lineData, $delimiter);
}
$lineData = array(str_pad($infojournal['chartaccountname'],1000),str_pad(number_format($infojournal['ledgerdebit'],2,'.',','),300),str_pad(number_format($infojournal['ledgercredit'],2,'.',','),300));
fputcsv($f, $lineData, $delimiter);
$totalCredit += $infojournal['ledgercredit'];
$totalDebit += $infojournal['ledgerdebit'];
}
if (!empty($ledgerno)) {
$lineData = array(str_pad(' ',1000),str_pad(number_format($totalDebit,2,'.',','),300),str_pad(number_format($totalCredit,2,'.',','),300));
fputcsv($f, $lineData, $delimiter);
}

fclose($f);

$fileCounter++;
}
} while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='accounttrans'){
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select customerid, chartaccountname, customername, sum(ledgerdebit) as ledgerdebit, sum(ledgercredit) as ledgercredit, notes,ledgerdate, ledgerno, referenceno, referencedate, totalledgerdebit, totalledgercredit, id, type from pairledgers where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (ledgerdate>='".$_GET['from']."' and ledgerdate<='".$_GET['to']."') group by chartaccountid,ledgerdate,ledgerno,type order by ledgerdate,ledgerno,type asc limit $offset, $rowsPerFile");

if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Accounts Transaction-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Accounts Transaction-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
$fields = array('Date','Account','Transaction Details','Transaction Type','Transaction Number','Reference Number','Debit','Credit','Amount');
fputcsv($f, $fields, $delimiter);

$ledgerno = '';
while ($infojournal = $query->fetch_assoc()) {
$lineData = array(str_pad(date($datemainphp,strtotime($infojournal['ledgerdate'])),1000),str_pad($infojournal['chartaccountname'],300),str_pad($infojournal['notes'],300),str_pad(ucfirst($infojournal['type']),300),str_pad($infojournal['ledgerno'],300),str_pad($infojournal['referenceno'],300),str_pad(number_format($infojournal['ledgerdebit'],2,'.',','),300),str_pad(number_format($infojournal['ledgercredit'],2,'.',','),300),str_pad(number_format(($infojournal['ledgercredit']>0)?$infojournal['ledgercredit']:$infojournal['ledgerdebit'],2,'.',','),300));
fputcsv($f, $lineData, $delimiter);
}

fclose($f);

$fileCounter++;
}
} while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='prosalecus'){
$sqlismainaccessuserinvoice=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Invoices' order by id  asc");
$infomainaccessuserinvoice=mysqli_fetch_array($sqlismainaccessuserinvoice);
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
if($_GET['category']!='all'){
$sqlicatname = mysqli_query($con, "SELECT category From paircategory WHERE id='".$_GET['category']."' order by category asc");
$infocatname = mysqli_fetch_array($sqlicatname);
$categoryname = $infocatname['category'];
}
$seldata = $con->query("SELECT * FROM pairinvoices WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (invoicedate>='" . $_GET['from'] . "' AND invoicedate<='" . $_GET['to'] . "') AND cancelstatus='0'".(($_GET['names']=='all')?' ':' and customerid="'.$_GET['names'].'"')." ".(($_GET['category']=='all')?' ':' and manufacturer="'.$categoryname.'"')." ORDER BY productname ASC limit $offset, $rowsPerFile");

if ($seldata->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Product Customer Wise Sales-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Product Customer Wise Sales-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array((($_GET['category']=='all')?'All':$categoryname));
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);

$lastProduct = null;
$totalQuantity = 0;
$totalFreeQuantity = 0;
$totalValue = 0;

$fields = array($infomainaccessuserinvoice['modulename'].' Number',$infomainaccessuserinvoice['modulename'].' Date','Customer Name','Place',$access['txtqtyinv'],'Free','Rate','Value');
fputcsv($f, $fields, $delimiter);

while ($info = $seldata->fetch_assoc()) {
    if ($info['productname'] != $lastProduct) {
        if ($lastProduct !== null) {
        	$fields = array(' ',' ',' ',' ',str_pad($totalQuantity,300),str_pad($totalFreeQuantity,300),' ',str_pad(number_format((float)$totalValue,2,'.',','),300));
			fputcsv($f, $fields, $delimiter);
        }
        $totalQuantity = 0;
        $totalFreeQuantity = 0;
        $totalValue = 0;
        	$fields = array(str_pad($info['productname'],300));
			fputcsv($f, $fields, $delimiter);
        $lastProduct = $info['productname'];
    }
    	if ($info['productrate']>0) {
    		$totalQuantity += $info['quantity'];
 		}
 		else{
 			$totalFreeQuantity += $info['quantity'];
 		}
    $totalValue += $info['productvalue'];
        	$fields = array(str_pad($info['invoiceno'],300),str_pad(date($datemainphp, strtotime($info['invoicedate'])),300),str_pad($info['customername'],300),str_pad($info['pos'],300),str_pad((($info['productrate']>0)?$info['quantity']:''),300),str_pad((($info['productrate']>0)?'':$info['quantity']),300),str_pad(number_format((float)$info['productrate'],2,'.',','),300),str_pad(number_format((float)$info['productvalue'],2,'.',','),300));
			fputcsv($f, $fields, $delimiter);
}

if ($lastProduct !== null) {
	$fields = array(' ',' ',' ',' ',str_pad($totalQuantity,300),str_pad($totalFreeQuantity,300),' ',str_pad(number_format((float)$totalValue,2,'.',','),300));
	fputcsv($f, $fields, $delimiter);
}

fclose($f);

$fileCounter++;
}
} while ($seldata->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='promovement'){
$sqlismainaccessuserinvoice=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Invoices' order by id  asc");
$infomainaccessuserinvoice=mysqli_fetch_array($sqlismainaccessuserinvoice);
$sqlismainaccessusercust=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customers' order by id  asc");
$infomainaccessusercust=mysqli_fetch_array($sqlismainaccessusercust);
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
if($_GET['proid']!='all'){
$sqliproname = mysqli_query($con, "SELECT productname From pairproducts WHERE id='".$_GET['proid']."' order by productname asc");
$infoproname = mysqli_fetch_array($sqliproname);
$proname = $infoproname['productname'];
}
else{
$proname = 'All';
}
$seldata = $con->query("SELECT quantity AS quantities,'invoices' AS types,invoiceno AS numbers,invoicedate AS dates,productname AS productname,customername as names FROM pairinvoices WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (invoicedate>='" . $_GET['from'] . "' AND invoicedate<='" . $_GET['to'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." UNION SELECT quantity AS quantities,'bills' AS types,billno AS numbers,billdate AS dates,productname AS productname,vendorname as names FROM pairbills WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (billdate>='" . $_GET['from'] . "' AND billdate<='" . $_GET['to'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." UNION SELECT newquantity AS quantities,'adjustments' AS types,privateid AS numbers,adjustmentdate AS dates,productname AS productname,createdby as names FROM pairadjustments WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (adjustmentdate>='" . $_GET['from'] . "' AND adjustmentdate<='" . $_GET['to'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." ORDER BY dates,numbers ASC LIMIT $offset, $rowsPerFile");

if ($seldata->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Product Movement-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Product Movement-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array((($_GET['proid']=='all')?'All':$proname));
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);

$fields = array('Date',$infomainaccessuserinvoice['modulename'].' Number',$infomainaccessusercust['modulename'].' Name','Adjustment'. $access['txtqtyinv'],'Sales'. $access['txtqtyinv'],'Purchase'. $access['txtqtyinv']);
fputcsv($f, $fields, $delimiter);

while ($info = $seldata->fetch_assoc()) {
    $fields = array(str_pad(date($datemainphp, strtotime($info['dates'])),300),str_pad($info['numbers'],300),str_pad($info['names'],300),str_pad((($info['types']=='adjustments')?$info['quantities']:'0'),300),str_pad((($info['types']=='invoices')?$info['quantities']:'0'),300),str_pad((($info['types']=='bills')?$info['quantities']:'0'),300));
	fputcsv($f, $fields, $delimiter);
}
$adjtotal = 0;
$saletotal = 0;
$purtotal = 0;
$allthetotal = 0;
$seldataanother = mysqli_query($con, "SELECT quantity AS quantities,'invoices' AS types,invoiceno AS numbers,invoicedate AS dates,productname AS productname,customername as names FROM pairinvoices WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (invoicedate>='" . $_GET['from'] . "' AND invoicedate<='" . $_GET['to'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." UNION SELECT quantity AS quantities,'bills' AS types,billno AS numbers,billdate AS dates,productname AS productname,vendorname as names FROM pairbills WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (billdate>='" . $_GET['from'] . "' AND billdate<='" . $_GET['to'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." UNION SELECT newquantity AS quantities,'adjustments' AS types,privateid AS numbers,adjustmentdate AS dates,productname AS productname,createdby as names FROM pairadjustments WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (adjustmentdate>='" . $_GET['from'] . "' AND adjustmentdate<='" . $_GET['to'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." ORDER BY dates,numbers ASC");
while ($infoanother = mysqli_fetch_array($seldataanother)) {
$adjtotal += (($infoanother['types']=='adjustments')?$infoanother['quantities']:'0');
$saletotal += (($infoanother['types']=='invoices')?$infoanother['quantities']:'0');
$purtotal += (($infoanother['types']=='bills')?$infoanother['quantities']:'0');
if ($infoanother['types']=='adjustments') {
   $allthetotal += $infoanother['quantities'];
}
elseif ($infoanother['types']=='invoices') {
  $allthetotal -= $infoanother['quantities'];
}
elseif ($infoanother['types']=='bills') {
  $allthetotal += $infoanother['quantities'];
}
}
    $fields = array(str_pad('Total',300),str_pad('',300),str_pad('',300),str_pad(number_format((float)$adjtotal,2,'.',','),300),str_pad(number_format((float)$saletotal,2,'.',','),300),str_pad(number_format((float)$purtotal,2,'.',','),300));
    fputcsv($f, $fields, $delimiter);
    $fields = array(str_pad('Total',300),str_pad('',300),str_pad('',300),str_pad('',300),str_pad('',300),str_pad(number_format((float)$allthetotal,2,'.',','),300));
    fputcsv($f, $fields, $delimiter);

fclose($f);

$fileCounter++;
}
} while ($seldata->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='salesperson'){
$rowsPerFile = 10000;
$fileCounter = 1;
$finaloutput = '';
do {
$offset = ($fileCounter - 1) * $rowsPerFile;
$query = $con->query("select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (invoicedate>='".$_GET['from']."' and invoicedate<='".$_GET['to']."') AND cancelstatus='0'".(($_GET['preparedby']=='all')?' ':' and preparedby="'.$_GET['preparedby'].'"')."".(($_GET['checkedby']=='all')?' ':' and checkedby="'.$_GET['checkedby'].'"')." GROUP BY invoicedate, invoiceno ORDER BY invoicedate,invoiceno limit $offset, $rowsPerFile");

if ($query->num_rows > 0) {
$delimiter = ",";
$filename = "reports/Sales Person-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to'].".csv";
$finaloutput .= ",Sales Person-" . $fileCounter . " - ".$_GET['from']."  ".$_GET['to']."";

$f = fopen($filename, 'w');
$fields = array($_GET['branch']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['type']);
fputcsv($f, $fields, $delimiter);
$fields = array($_GET['fromto']);
fputcsv($f, $fields, $delimiter);
$fields = array('Type','Invoice Date','Invoice Number','Customer Name','Customer City','Taxable Value','Tax Value','Total Value','Prepared By','Checked By','Taxable %','Amount');
fputcsv($f, $fields, $delimiter);

while ($info = $query->fetch_assoc()) {
$rowinpidpages = $info['invoiceno'].str_replace('-', '', $info['invoicedate']);
$encodedArray = $_GET['responseouputs'];
$decodedArray = urldecode($encodedArray);
$responseouputs = json_decode($decodedArray, true);
$lineData = array(str_pad('Sales',1000),str_pad($info['invoicedate'],1000),str_pad($info['invoiceno'],1000),str_pad($info['customername'],1000),str_pad($info['city'],1000),str_pad(number_format((float)$info['totalamount'],2,'.',','),1000),str_pad(number_format((float)$info['totalvatamount'],2,'.',','),1000),str_pad(number_format((float)$info['grandtotal'],2,'.',','),1000),str_pad($info['preparedby'],1000),str_pad($info['checkedby'],1000),str_pad(number_format((float)($responseouputs['percent'.$rowinpidpages]),2,'.',','),1000),str_pad(number_format((float)($responseouputs['amount'.$rowinpidpages]),2,'.',','),1000));
fputcsv($f, $lineData, $delimiter);
}

fclose($f);

$fileCounter++;
}
} while ($query->num_rows > 0);
echo "downloaded".$finaloutput;
}
if($_GET['term']=='crnoteregistered'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='crnoteregistered' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (creditnotedate>='".$_GET['datefrom']."' and creditnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY creditnotedate, creditnoteno order by creditnotedate asc, creditnoteno asc");
while($info=mysqli_fetch_array($sql))
{
$anstax = $info['tax'];
$anscgst = $info['cgst'];
$anssgst = $info['sgst'];
$ansigst = $info['igst'];
$ansgst = $info['gst'];
$ansgstpercent = $info['gstpercent'];
$anscsgstpercent = $info['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
$infoposics=$info['pos'];
$infofranposics=$franpos;
if($infoposics=="")
{
$infoposics="TAMIL NADU (33)";
}
if($infofranposics=="")
{
$infofranposics="TAMIL NADU (33)";
}
if($infoposics!=$infofranposics){
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span></td>
<td data-label="<?=$infomainaccessusercus['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['customername']?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['creditnoteno']?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['creditnotedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxablecreditnote"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newgst[$i]?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
</tr>
<?php
}
$count++;
}
else{
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span></td>
<td data-label="<?=$infomainaccessusercus['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['customername']?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['creditnoteno']?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['creditnotedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxablecreditnote"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newcgst[$i]?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newsgst[$i]?></td>
</tr>
<?php
}
$count++;
}
}
}
if($_GET['term']=='drnoteregistered'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='drnoteregistered' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairdebitnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (debitnotedate>='".$_GET['datefrom']."' and debitnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY debitnotedate, debitnoteno order by debitnotedate asc, debitnoteno asc");
while($info=mysqli_fetch_array($sql))
{
$anstax = $info['tax'];
$anscgst = $info['cgst'];
$anssgst = $info['sgst'];
$ansigst = $info['igst'];
$ansgst = $info['gst'];
$ansgstpercent = $info['gstpercent'];
$anscsgstpercent = $info['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
$infoposics=$info['pos'];
$infofranposics=$franpos;
if($infoposics=="")
{
$infoposics="TAMIL NADU (33)";
}
if($infofranposics=="")
{
$infofranposics="TAMIL NADU (33)";
}
if($infoposics!=$infofranposics){
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span></td>
<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['vendorname']?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['debitnoteno']?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['debitnotedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxabledebitnote"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newgst[$i]?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
</tr>
<?php
}
$count++;
}
else{
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span></td>
<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['vendorname']?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['debitnoteno']?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['debitnotedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxabledebitnote"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newcgst[$i]?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newsgst[$i]?></td>
</tr>
<?php
}
$count++;
}
}
}
if($_GET['term']=='crnoteconsumer'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='crnoteconsumer' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (creditnotedate>='".$_GET['datefrom']."' and creditnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY creditnotedate, creditnoteno order by creditnotedate asc, creditnoteno asc");
while($info=mysqli_fetch_array($sql))
{
$anstax = $info['tax'];
$anscgst = $info['cgst'];
$anssgst = $info['sgst'];
$ansigst = $info['igst'];
$ansgst = $info['gst'];
$ansgstpercent = $info['gstpercent'];
$anscsgstpercent = $info['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
$infoposics=$info['pos'];
$infofranposics=$franpos;
if($infoposics=="")
{
$infoposics="TAMIL NADU (33)";
}
if($infofranposics=="")
{
$infofranposics="TAMIL NADU (33)";
}
if($infoposics!=$infofranposics){
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="<?=$infomainaccessusercus['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['customername']?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['creditnoteno']?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['creditnotedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxablecreditnote"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newgst[$i]?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
</tr>
<?php
}
$count++;
}
else{
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="<?=$infomainaccessusercus['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['customername']?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['creditnoteno']?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['creditnotedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxablecreditnote"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newcgst[$i]?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newsgst[$i]?></td>
</tr>
<?php
}
$count++;
}
}
}
if($_GET['term']=='drnoteconsumer'){
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='drnoteconsumer' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairdebitnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (debitnotedate>='".$_GET['datefrom']."' and debitnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY debitnotedate, debitnoteno order by debitnotedate asc, debitnoteno asc");
while($info=mysqli_fetch_array($sql))
{
$anstax = $info['tax'];
$anscgst = $info['cgst'];
$anssgst = $info['sgst'];
$ansigst = $info['igst'];
$ansgst = $info['gst'];
$ansgstpercent = $info['gstpercent'];
$anscsgstpercent = $info['csgstpercent'];
$newtaxes = explode(',',$anstax);
$newcgst = explode(',',$anscgst);
$newsgst = explode(',',$anssgst);
$newigst = explode(',',$ansigst);
$newgst = explode(',',$ansgst);
$newgstpercent = explode(',',$ansgstpercent);
$newcsgstpercent = explode(',',$anscsgstpercent);
$infoposics=$info['pos'];
$infofranposics=$franpos;
if($infoposics=="")
{
$infoposics="TAMIL NADU (33)";
}
if($infofranposics=="")
{
$infofranposics="TAMIL NADU (33)";
}
if($infoposics!=$infofranposics){
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['vendorname']?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['debitnoteno']?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['debitnotedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxabledebitnote"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newgst[$i]?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
</tr>
<?php
}
$count++;
}
else{
for ($i=1; $i <count($newtaxes) ; $i++) {
?>
<tr style="vertical-align: middle;">
<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['vendorname']?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> Number" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['debitnoteno']?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['debitnotedate']))?></span></span></td>
<td data-label="Total" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="Place Of Supply" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['pos']?></span></span></td>
<td data-label="Total <?=($access["txttaxabledebitnote"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= $newtaxes[$i] ?></span></span></td>
<td data-label="GST %" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?= $newgstpercent[$i] ?></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;">0.00</td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newcgst[$i]?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?=$newsgst[$i]?></td>
</tr>
<?php
}
$count++;
}
}
}
?>