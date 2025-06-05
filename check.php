<?php
include('lcheck.php');
$sqlismainaccessusercus=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customers' order by id  asc");
$infomainaccessusercus=mysqli_fetch_array($sqlismainaccessusercus);
$sqlismainaccessuserven=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Vendors' order by id  asc");
$infomainaccessuserven=mysqli_fetch_array($sqlismainaccessuserven);
$sqlismainaccessuserinv=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Invoices' order by id  asc");
$infomainaccessuserinv=mysqli_fetch_array($sqlismainaccessuserinv);
$sqlismainaccessuserbill=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Bills' order by id  asc");
$infomainaccessuserbill=mysqli_fetch_array($sqlismainaccessuserbill);

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

if (isset($_GET['term'])&&($_GET['term']=='invview')) {
function duedays($invoicedateparam,$duedateparam){
	$invoicedate = $invoicedateparam;
	$duedate = $duedateparam;
	$currentDate = date('Y-m-d');
	$invoiceDateObj = new DateTime($invoicedate);
	$dueDateObj = new DateTime($duedate);
	$currentDateObj = new DateTime($currentDate);
	$interval = $currentDateObj->diff($dueDateObj);
	if ($currentDateObj > $dueDateObj) {
		echo "-" . $interval->days . " Days (Overdue)";
	}
	else {
		echo $interval->days . " Days remaining";
	}
}
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='inv' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$anscheck = $sqlviewreport['rowcolumns'];
$newanscheck = explode(',',$anscheck);
$sqli=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and (invoicetime>='".$_GET['timefrom']."' and invoicetime<='".$_GET['timeto']."')".(($_GET['names']=='all')?' ':' and customerid="'.$_GET['names'].'"')."".(($_GET['payterm']=='all')?' ':' and invoiceterm="'.$_GET['payterm'].'"')." GROUP BY invoicedate, invoiceno");                  
$count=1;
$invoiceamount=0;
$balanceamount=0;
$currentamount=0;
$overdueamount=0;
$crbtotal=0;
$inttotal=0;
while($info=mysqli_fetch_array($sqli)){
																							$invoiceamount+=(float)$info['invoiceamount'];
																							$currentamount=(float)$info['invoiceamount'];
																							$paidamount=0;
																							$refundamount=0;
																							$currentbalance=0;
																							$sqlsalespays=$con->prepare("SELECT amount FROM pairsalespayhistory WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? ORDER BY id DESC");
																							$sqlsalespays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $info['invoiceno'], $info['invoicedate']);
																							$sqlsalespays->execute();
																							$sqlsalespay = $sqlsalespays->get_result();
																							while($infosalespay=$sqlsalespay->fetch_array()){
																								$paidamount+=(float)$infosalespay['amount'];
																							}
																							$currentbalance=((float)$info['invoiceamount']-$paidamount);
																							$balanceamount+=((float)$info['invoiceamount']-$paidamount);
																							$totalcancel[]=$info['cancelstatus'];
																							$totalinvoiceno[]=$info['invoiceno'];
																							$totalinvoicedate[]=$info['invoicedate'];
																							$sqlsantss=$con->prepare("SELECT invoiceamount, invoicepaymentreceived, grandtotal,creditnotedate, creditnoteno FROM paircreditnotes WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? AND customerid=? GROUP BY creditnotedate, creditnoteno ORDER BY creditnotedate ASC, creditnoteno ASC");
																							$sqlsantss->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['invoiceno'], $info['invoicedate'], $info['customerid']);
																							$sqlsantss->execute();
																							$sqlsants = $sqlsantss->get_result();
																							if($sqlsants->num_rows>0){
																								while($infoantss=$sqlsants->fetch_array()){
																										$currentbalance=((float)$currentbalance-$infoantss['grandtotal']);
																										$paidamountcr=0;
																										$sqlcrpays=$con->prepare("SELECT amount FROM paircreditnotepayhistory WHERE franchisesession=? AND createdid=? AND creditnoteno=? AND creditnotedate=? ORDER BY id DESC");
																										$sqlcrpays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $infoantss['creditnoteno'], $infoantss['creditnotedate']);
																										$sqlcrpays->execute();
																										$sqlcrpay = $sqlcrpays->get_result();
																										while($infocrpay=$sqlcrpay->fetch_array()){
																											$paidamountcr+=(float)$infocrpay['amount'];
																										}
																										$currentbalance=((float)$currentbalance+$paidamountcr);
																										$refundamount=((float)$paidamountcr);
																								}
																							}
																							if ($currentbalance<0) {
																								$currentbalance = 0;
																							}
																							$crbtotal += $currentbalance;
																							$inttotal += $info['grandtotal'];
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
if(($paidamount - $refundamount)<=0)
{
$status ='Un Paid';
}
else
{
$status ='Partially Paid';
}
}
}
$sqlselcusname = mysqli_query($con,"select customername from paircustomers where id='".$info['customerid']."'");
$fetsqlcusname = mysqli_fetch_array($sqlselcusname);
?>
<tr style="<?=(($_GET['amttype']=='all')?'':(($currentbalance>0)?'':'display: none;'))?>">
<td data-label="Sno" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$count?></td>
<td data-label="Status" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$status?></td>
<td data-label="Date" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=date($datemainphp,strtotime($info['invoicedate']))?></td>
<td data-label="Payment Days" style="display: none;border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=duedays($info['invoicedate'],$info['duedate'])?></td>
<td data-label="Number" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['invoiceno']?></td>
<td data-label="<?=$infomainaccessusercus['modulename']?> Name" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 150px;overflow: hidden;white-space: nowrap;"><?=$fetsqlcusname['customername']?></span></td>
<td data-label="City" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;<?=(((in_array('City', $newanscheck)))?'':'display: none;')?>"><span style="font-size:12px;margin: 0px !important;display: inline-flex;overflow: hidden;white-space: nowrap;"><?=$info['city']?></span></td>
<td data-label="Total" style="border: 1px solid #eee;padding-left: 10px;text-align: right;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></td>
<td data-label="Payment Term" style="<?=(((in_array('Payment Term', $newanscheck)))?'width:120px;':'display: none;')?>border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['invoiceterm']?></td>
<td data-label="Balance" style="border: 1px solid #eee;padding-left: 10px;text-align: right;"><?=number_format((float)$currentbalance,2,'.',',')?></td>
</tr>
<?php
$count++;
}
if (mysqli_num_rows($sqli)>0) {
$colspanans = 5;
if (in_array('City', $newanscheck)) {
$colspanans+=1;
}
?>
<tr style="font-weight: bold;"><td style="border: 1px solid #eee;padding-left: 10px;" colspan="<?=$colspanans?>">Total</td>
<td style="border: 1px solid #eee;padding-left: 10px;text-align: right;"><?=number_format((float)$inttotal,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-left: 10px;text-align: right;<?=(((in_array('Payment Term', $newanscheck)))?'':'display: none;')?>"></td>
<td style="border: 1px solid #eee;padding-left: 10px;text-align: right;"><?=number_format((float)$crbtotal,2,'.',',')?></td>
</tr>
<?php
}
}
elseif (isset($_GET['term'])&&($_GET['term']=='billview')) {
function duedays($billdateparam,$duedateparam){
	$billdate = $billdateparam;
	$duedate = $duedateparam;
	$currentDate = date('Y-m-d');
	$billDateObj = new DateTime($billdate);
	$dueDateObj = new DateTime($duedate);
	$currentDateObj = new DateTime($currentDate);
	$interval = $currentDateObj->diff($dueDateObj);
	if ($currentDateObj > $dueDateObj) {
		echo "-" . $interval->days . " Days (Overdue)";
	}
	else {
		echo $interval->days . " Days remaining";
	}
}
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='bill' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$anscheck = $sqlviewreport['rowcolumns'];
$newanscheck = explode(',',$anscheck);
$sqlinfo=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (billdate>='".$_GET['datefrom']."' and billdate<='".$_GET['dateto']."')".(($_GET['names']=='all')?' ':' and vendorid="'.$_GET['names'].'"')." GROUP BY billdate, billno");                  
$count=1;
$billamount=0;
$balanceamount=0;
$currentamount=0;
$overdueamount=0;
$crbtotal=0;
$inttotal=0;
while($info=mysqli_fetch_array($sqlinfo)){
																							$billamount+=(float)$info['billamount'];
																							$currentamount=(float)$info['billamount'];
																							$paidamount=0;
																							$refundamount=0;
																							$currentbalance=0;
															                        $sqlpurchasepays=$con->prepare("SELECT amount FROM pairpurchasepayhistory WHERE franchisesession=? AND createdid=? AND billno=? AND billdate=? ORDER BY id DESC");
												      									$sqlpurchasepays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $info['billno'], $info['billdate']);
												      									$sqlpurchasepays->execute();
												      									$sqlpurchasepay = $sqlpurchasepays->get_result();
															                        while($infopurchasepay=$sqlpurchasepay->fetch_array()){
																								$paidamount+=(float)$infopurchasepay['amount'];
																							}
																							$currentbalance=((float)$info['billamount']-$paidamount);
																							$balanceamount+=((float)$info['billamount']-$paidamount);
																							$totalcancel[]=$info['cancelstatus'];
																							$totalbillno[]=$info['billno'];
																							$totalbilldate[]=$info['billdate'];
																                      $sqlsantss=$con->prepare("SELECT billamount, billpaymentreceived, grandtotal,debitnotedate, debitnoteno FROM pairdebitnotes WHERE franchisesession=? AND createdid=? AND billno=? AND billdate=? AND vendorid=? GROUP BY debitnotedate, debitnoteno ORDER BY debitnotedate ASC, debitnoteno ASC");
																                      $sqlsantss->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['billno'], $info['billdate'], $info['vendorid']);
																                      $sqlsantss->execute();
																                      $sqlsants = $sqlsantss->get_result();
																                      if($sqlsants->num_rows>0){
																                        while($infoantss=$sqlsants->fetch_array()){
																													$currentbalance=((float)$currentbalance-$infoantss['grandtotal']);
																													$paidamountdr=0;
																													$sqldrpays=$con->prepare("SELECT amount FROM pairdebitnotepayhistory WHERE franchisesession=? AND createdid=? AND debitnoteno=? AND debitnotedate=? ORDER BY id DESC");
																													$sqldrpays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $infoantss['debitnoteno'], $infoantss['debitnotedate']);
																													$sqldrpays->execute();
																													$sqldrpay = $sqldrpays->get_result();
																													while($infodrpay=$sqldrpay->fetch_array()){
																														$paidamountdr+=(float)$infodrpay['amount'];
																													}
																													$currentbalance=((float)$currentbalance+$paidamountdr);
																													$refundamount=((float)$paidamountdr);
																                        }
																                      }
													      							if ($currentbalance<0) {
													      								$currentbalance = 0;
													      							}
													      							$crbtotal += $currentbalance;
													      							$inttotal += $info['grandtotal'];
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
if(($paidamount - $refundamount)<=0)
{
$status ='Un Paid';
}
else
{
$status ='Partially Paid';
}
}
}
?>
<tr style="<?=(($_GET['amttype']=='all')?'':(($currentbalance>0)?'':'display: none;'))?>">
<td data-label="Sno" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$count?></td>
<td data-label="Status" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$status?></td>
<td data-label="Date" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=date($datemainphp,strtotime($info['billdate']))?></td>
<td data-label="Payment Days" style="display: none;border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=duedays($info['billdate'],$info['duedate'])?></td>
<td data-label="Number" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['billno']?></td>
<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 150px;overflow: hidden;white-space: nowrap;"><?=$info['vendorname']?></span></td>
<td data-label="City" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;<?=(((in_array('City', $newanscheck)))?'':'display: none;')?>"><span style="font-size:12px;margin: 0px !important;display: inline-flex;overflow: hidden;white-space: nowrap;"><?=$info['city']?></span></td>
<td data-label="Total" style="border: 1px solid #eee;padding-left: 10px;text-align: right;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></td>
<td data-label="Payment Term" style="<?=(((in_array('Payment Term', $newanscheck)))?'width:120px;':'display: none;')?>border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['billterm']?></td>
<td data-label="Balance" style="border: 1px solid #eee;padding-left: 10px;text-align: right;"><?=number_format((float)$currentbalance,2,'.',',')?></td>
</tr>
<?php
$count++;
}
if (mysqli_num_rows($sqlinfo)>0) {
$colspanans = 5;
if (in_array('City', $newanscheck)) {
$colspanans+=1;
}
?>
<tr style="font-weight: bold;"><td style="border: 1px solid #eee;padding-left: 10px;" colspan="<?=$colspanans?>">Total</td>
<td style="border: 1px solid #eee;padding-left: 10px;text-align: right;"><?=number_format((float)$inttotal,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-left: 10px;text-align: right;<?=(((in_array('Payment Term', $newanscheck)))?'':'display: none;')?>"></td>
<td style="border: 1px solid #eee;padding-left: 10px;text-align: right;"><?=number_format((float)$crbtotal,2,'.',',')?></td>
</tr>
<?php
}
}
elseif (isset($_GET['term'])&&($_GET['term']=='inward')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='inw' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sqlregister=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (billdate>='".$_GET['datefrom']."' and billdate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY billdate, billno");
$registerigst = 0;
$registercgst = 0;
$registersgst = 0;
$registerbilltotal = 0;
while($register=mysqli_fetch_array($sqlregister)){
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
?>
<tr onclick="window.open('inwardreportregistered.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>','_self')"><td data-label="PLACE OF SUPPLY" style="border:1px solid #eee;padding-left: 10px;">Purchases Received From Registered taxpayers</td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registerigst==0)?number_format((float)0,2,'.',','):number_format((float)$registerigst,2,'.',',')) ?></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registercgst==0)?number_format((float)0,2,'.',','):number_format((float)$registercgst,2,'.',',')) ?></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registersgst==0)?number_format((float)0,2,'.',','):number_format((float)$registersgst,2,'.',',')) ?></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registerbilltotal==0)?number_format((float)0,2,'.',','):number_format((float)$registerbilltotal,2,'.',',')) ?></span></td>
</tr>
<?php
$sqlconsumer=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (billdate>='".$_GET['datefrom']."' and billdate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY billdate, billno");
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
?>
<tr onclick="window.open('inwardreportconsumer.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>','_self')"><td data-label="PLACE OF SUPPLY" style="border:1px solid #eee;padding-left: 10px;">Purchases Received From Unregistered (Consumer) taxpayers</td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumerigst==0)?number_format((float)0,2,'.',','):number_format((float)$consumerigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumercgst==0)?number_format((float)0,2,'.',','):number_format((float)$consumercgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumersgst==0)?number_format((float)0,2,'.',','):number_format((float)$consumersgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumerbilltotal==0)?number_format((float)0,2,'.',','):number_format((float)$consumerbilltotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
$sqlhsn=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (billdate>='".$_GET['datefrom']."' and billdate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY billdate, billno");
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
?>
<tr onclick="window.open('inwardreporthsn.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>','_self')"><td data-label="PLACE OF SUPPLY" style="border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 295px;min-width: 295px;white-space: nowrap;overflow: hidden;color: royalblue;">HSN-wise summary of inward supplies</span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($hsnigst==0)?number_format((float)0,2,'.',','):number_format((float)$hsnigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($hsncgst==0)?number_format((float)0,2,'.',','):number_format((float)$hsncgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($hsnsgst==0)?number_format((float)0,2,'.',','):number_format((float)$hsnsgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($hsnbilltotal==0)?number_format((float)0,2,'.',','):number_format((float)$hsnbilltotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&($_GET['term']=='outward')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='ouw' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sqlregister=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY invoicedate, invoiceno");
$registerigst = 0;
$registercgst = 0;
$registersgst = 0;
$registerinvoicetotal = 0;
while($register=mysqli_fetch_array($sqlregister)){
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
$registerinvoicetotal += $register['grandtotal'];
}
}
?>
<tr onclick="window.open('outwardreportregistered.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>','_self')"><td data-label="PLACE OF SUPPLY" style="border:1px solid #eee;padding-left: 10px;">Taxable outward supplies made to registered persons</td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registerigst==0)?number_format((float)0,2,'.',','):number_format((float)$registerigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registercgst==0)?number_format((float)0,2,'.',','):number_format((float)$registercgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registersgst==0)?number_format((float)0,2,'.',','):number_format((float)$registersgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registerinvoicetotal==0)?number_format((float)0,2,'.',','):number_format((float)$registerinvoicetotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
$sqlconsumer=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY invoicedate, invoiceno");
$consumerigst = 0;
$consumercgst = 0;
$consumersgst = 0;
$consumerinvoicetotal = 0;
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
$consumerinvoicetotal += $consumer['grandtotal'];
}
}
?>
<tr onclick="window.open('outwardreportconsumer.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>','_self')"><td data-label="PLACE OF SUPPLY" style="border:1px solid #eee;padding-left: 10px;">Taxable outward supplies to consumer</td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumerigst==0)?number_format((float)0,2,'.',','):number_format((float)$consumerigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumercgst==0)?number_format((float)0,2,'.',','):number_format((float)$consumercgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumersgst==0)?number_format((float)0,2,'.',','):number_format((float)$consumersgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumerinvoicetotal==0)?number_format((float)0,2,'.',','):number_format((float)$consumerinvoicetotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
$sqlhsn=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY invoicedate, invoiceno");
$hsnigst = 0;
$hsncgst = 0;
$hsnsgst = 0;
$hsninvoicetotal = 0;
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
$hsninvoicetotal += $hsn['grandtotal'];
}
}
?>
<tr onclick="window.open('outwardreporthsn.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>','_self')"><td data-label="PLACE OF SUPPLY" style="border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 295px;min-width: 295px;white-space: nowrap;overflow: hidden;color: royalblue;">HSN-wise summary of outward supplies</span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($hsnigst==0)?number_format((float)0,2,'.',','):number_format((float)$hsnigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($hsncgst==0)?number_format((float)0,2,'.',','):number_format((float)$hsncgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($hsnsgst==0)?number_format((float)0,2,'.',','):number_format((float)$hsnsgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($hsninvoicetotal==0)?number_format((float)0,2,'.',','):number_format((float)$hsninvoicetotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&($_GET['term']=='inwardcon')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='inwcon' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (billdate>='".$_GET['datefrom']."' and billdate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY billdate, billno order by billdate asc, billno asc");
$tottaxamt = 0;
$totigstamt = 0;
$totcgstamt = 0;
$totsgstamt = 0;
while($info=mysqli_fetch_array($sql))
{
$tottaxamt += $info['totalamount'];
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
?>
<tr style="vertical-align: middle;"><td data-label="PLACE OF SUPPLY" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$info['vendorname']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color: grey;">Place of Supply : <span style="color: black;"><?=$info['pos']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color: grey;"><?=$infomainaccessuserbill["modulename"]?> Number : <span style="color: black;"><?=$info['billno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color: grey;"><?=$infomainaccessuserinv["modulename"]?> Number : <span style="color: black;"><?=$info['invnumber']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color: grey;">Amount : <span style="color: black;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['billdate']))?></span></span></td>
<td data-label="<?=($access["txttaxablebill"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['totalamount'],2,'.',',')?></span></span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infoigst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics!=$infofranposics)
{
$infoigst += $newgst[$i];
$totigstamt += $newgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infoigst,2,'.',',').'</span></span>';
?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infocgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infocgst += $newcgst[$i];
$totcgstamt += $newcgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infocgst,2,'.',',').'</span></span>';
?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infosgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infosgst += $newsgst[$i];
$totsgstamt += $newsgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infosgst,2,'.',',').'</span></span>';
?></td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="2">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$tottaxamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totigstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totcgstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totsgstamt,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&($_GET['term']=='outwardcon')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='ouwcon' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY invoicedate, invoiceno order by invoicedate asc, invoiceno asc");
$tottaxamt = 0;
$totigstamt = 0;
$totcgstamt = 0;
$totsgstamt = 0;
while($info=mysqli_fetch_array($sql))
{
$tottaxamt += $info['totalamount'];
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
?>
<tr style="vertical-align: middle;"><td data-label="PLACE OF SUPPLY" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$info['customername']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color:grey;">Place of Supply : <span style="color: black;"><?=$info['pos']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color:grey;"><?=$infomainaccessuserinv["modulename"]?> Number : <span style="color: black;"><?=$info['invoiceno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color:grey;">Amount : <span style="color: black;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['invoicedate']))?></span></span></td>
<td data-label="<?=$access["txttaxableinv"]?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['totalamount'],2,'.',',')?></span></span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infoigst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics!=$infofranposics)
{
$infoigst += $newgst[$i];
$totigstamt += $newgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infoigst,2,'.',',').'</span></span>';
?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infocgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infocgst += $newcgst[$i];
$totcgstamt += $newcgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infocgst,2,'.',',').'</span></span>';
?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infosgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infosgst += $newsgst[$i];
$totsgstamt += $newsgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infosgst,2,'.',',').'</span></span>';
?></td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="2">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$tottaxamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totigstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totcgstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totsgstamt,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&($_GET['term']=='inwardreg')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='inwreg' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (billdate>='".$_GET['datefrom']."' and billdate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY billdate, billno order by billdate asc, billno asc");
$tottaxamt = 0;
$totigstamt = 0;
$totcgstamt = 0;
$totsgstamt = 0;
while($info=mysqli_fetch_array($sql))
{
$tottaxamt += $info['totalamount'];
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
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$info['vendorname']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;">Place of Supply : <span><?=$info['pos']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$infomainaccessuserbill["modulename"]?> Number : <?=$info['billno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color: grey;"><?=$infomainaccessuserinv["modulename"]?> Number : <span style="color: black;"><?=$info['invnumber']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span>Amount : <?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="<?=$infomainaccessuserbill["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['billdate']))?></span></span></td>
<td data-label="<?=($access["txttaxablebill"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['totalamount'],2,'.',',')?></span></span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infoigst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics!=$infofranposics)
{
$infoigst += $newgst[$i];
$totigstamt += $newgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infoigst,2,'.',',').'</span></span>';
?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infocgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infocgst += $newcgst[$i];
$totcgstamt += $newcgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infocgst,2,'.',',').'</span></span>';
?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infosgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infosgst += $newsgst[$i];
$totsgstamt += $newsgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infosgst,2,'.',',').'</span></span>';
?></td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="2">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$tottaxamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totigstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totcgstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totsgstamt,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&($_GET['term']=='outwardreg')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='ouwreg' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY invoicedate, invoiceno order by invoicedate asc, invoiceno asc");
$tottaxamt = 0;
$totigstamt = 0;
$totcgstamt = 0;
$totsgstamt = 0;
while($info=mysqli_fetch_array($sql))
{
$tottaxamt += $info['totalamount'];
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
?>
<tr style="vertical-align: middle;"><td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$info['customername']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;">Place of Supply : <span><?=$info['pos']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$infomainaccessuserinv["modulename"]?> Number : <?=$info['invoiceno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span>Amount : <?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="<?=$infomainaccessuserinv["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['invoicedate']))?></span></span></td>
<td data-label="<?=$access["txttaxableinv"]?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['totalamount'],2,'.',',')?></span></span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infoigst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics!=$infofranposics)
{
$infoigst += $newgst[$i];
$totigstamt += $newgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infoigst,2,'.',',').'</span></span>';
?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infocgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infocgst += $newcgst[$i];
$totcgstamt += $newcgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infocgst,2,'.',',').'</span></span>';
?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infosgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infosgst += $newsgst[$i];
$totsgstamt += $newsgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infosgst,2,'.',',').'</span></span>';
?></td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="2">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$tottaxamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totigstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totcgstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totsgstamt,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&$_GET['term']=='inwardhsn') {
$sql=mysqli_query($con, "select * from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (billdate>='".$_GET['datefrom']."' and billdate<='".$_GET['dateto']."') and cancelstatus='0' order by producthsn asc,productname asc");
$totvalamt = 0;
$tottaxamt = 0;
$totigstamt = 0;
$totcgstamt = 0;
$totsgstamt = 0;
while($info=mysqli_fetch_array($sql))
{
$totvalamt += $info['productnetvalue'];
$tottaxamt += $info['productvalue'];
																							$infoposics=$info['pos'];
																							$infofranposics=$franpos;
																							if($infoposics==""){
																								$infoposics="TAMIL NADU (33)";
																							}
																							if($infofranposics==""){
																								$infofranposics="TAMIL NADU (33)";
																							}
if($infoposics!=$infofranposics){
	$totigstamt += floatval($info['taxvalue']);
}
elseif($infoposics==$infofranposics){
	$totcgstamt += floatval($info['cgstvat']);
	$totsgstamt += floatval($info['sgstvat']);
}
?>
<tr style="vertical-align: middle;height: 18px !important;">
<td data-label="HSN/SAC" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;"><span><?=$info['producthsn']?></span></span></td>
<td data-label="Product Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 100px;min-width: 100px;justify-content: start;"><span><?=$info['productname']?></span></span></td>
<td data-label="Unit" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 30px;min-width: 30px;white-space: nowrap;overflow: hidden;justify-content: start;"><span><?=$info['unit']?></span></span></td>
<td data-label="Quantity" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 30px;min-width: 30px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=$info['quantity']?></span></span></td>
<td data-label="Total Value" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['productnetvalue'],2,'.',',')?></span></span></td>
<td data-label="GST" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
echo '<span style="display: inline-flex;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.$info['vat'].'</span>%</span>';
?></td>
<td data-label="Taxable Value" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['productvalue'],2,'.',',')?></span></span></td>
<td data-label="IGST" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
echo '<span style="display: inline-flex;max-width: 60px;min-width: 60px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.(($infoposics!=$infofranposics)?number_format((float)$info['taxvalue'],2,'.',','):'0.00').'</span></span>';
?></td>
<td data-label="CGST" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
echo '<span style="display: inline-flex;max-width: 60px;min-width: 60px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.(($infoposics==$infofranposics)?number_format((float)$info['cgstvat'],2,'.',','):'0.00').'</span></span>';
?></td>
<td data-label="SGST" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
echo '<span style="display: inline-flex;max-width: 60px;min-width: 60px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.(($infoposics==$infofranposics)?number_format((float)$info['sgstvat'],2,'.',','):'0.00').'</span></span>';
?></td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="4">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totvalamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$tottaxamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totigstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totcgstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totsgstamt,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&$_GET['term']=='outwardhsn') {
$sql=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and cancelstatus='0' order by producthsn asc,productname asc");
$totvalamt = 0;
$tottaxamt = 0;
$totigstamt = 0;
$totcgstamt = 0;
$totsgstamt = 0;
while($info=mysqli_fetch_array($sql))
{
$totvalamt += $info['productnetvalue'];
$tottaxamt += $info['productvalue'];
																							$infoposics=$info['pos'];
																							$infofranposics=$franpos;
																							if($infoposics==""){
																								$infoposics="TAMIL NADU (33)";
																							}
																							if($infofranposics==""){
																								$infofranposics="TAMIL NADU (33)";
																							}
if($infoposics!=$infofranposics){
	$totigstamt += floatval($info['taxvalue']);
}
elseif($infoposics==$infofranposics){
	$totcgstamt += floatval($info['cgstvat']);
	$totsgstamt += floatval($info['sgstvat']);
}
?>
<tr style="vertical-align: middle;height: 18px !important;">
<td data-label="HSN/SAC" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;"><span><?=$info['producthsn']?></span></span></td>
<td data-label="Product Name" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 100px;min-width: 100px;justify-content: start;"><span><?=$info['productname']?></span></span></td>
<td data-label="Unit" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 30px;min-width: 30px;white-space: nowrap;overflow: hidden;justify-content: start;"><span><?=$info['unit']?></span></span></td>
<td data-label="Quantity" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 30px;min-width: 30px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=$info['quantity']?></span></span></td>
<td data-label="Total Value" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['productnetvalue'],2,'.',',')?></span></span></td>
<td data-label="GST" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
echo '<span style="display: inline-flex;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.$info['vat'].'</span>%</span>';
?></td>
<td data-label="Taxable Value" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['productvalue'],2,'.',',')?></span></span></td>
<td data-label="IGST" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
echo '<span style="display: inline-flex;max-width: 60px;min-width: 60px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.(($infoposics!=$infofranposics)?number_format((float)$info['taxvalue'],2,'.',','):'0.00').'</span></span>';
?></td>
<td data-label="CGST" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
echo '<span style="display: inline-flex;max-width: 60px;min-width: 60px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.(($infoposics==$infofranposics)?number_format((float)$info['cgstvat'],2,'.',','):'0.00').'</span></span>';
?></td>
<td data-label="SGST" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
echo '<span style="display: inline-flex;max-width: 60px;min-width: 60px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.(($infoposics==$infofranposics)?number_format((float)$info['sgstvat'],2,'.',','):'0.00').'</span></span>';
?></td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="4">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totvalamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$tottaxamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totigstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totcgstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totsgstamt,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&$_GET['term']=='sales') {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='sales' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$anscheck = $sqlviewreport['rowcolumns'];
$newanscheck = explode(',',$anscheck);
$sqlsel=mysqli_query($con, "select invoiceterm,productid,productname,sum(quantity) as quantity,sum(productvalue) as productvalue from pairinvoices where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and (invoicetime>='".$_GET['timefrom']."' and invoicetime<='".$_GET['timeto']."')".(($_GET['payterm']=='all')?' ':' and invoiceterm="'.$_GET['payterm'].'"')." group by productid");                 
$count=1;
$totalamount = 0;
while($fetsql=mysqli_fetch_array($sqlsel))
{
$sqlselproname = mysqli_query($con,"select productname from pairproducts where id='".$fetsql['productid']."'");
$fetsqlproname = mysqli_fetch_array($sqlselproname);
$totalamount += $fetsql['productvalue'];
?>
<tr style="height: 30px;" onclick="window.open('reportsaledetails.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>&productid=<?=$fetsql['productid']?>','_self')"><td  data-label="Sno" style="<?=(((in_array('Sno', $newanscheck)))?'':'display: none;')?>border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$count?></td>
<td  data-label="Product Name" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$fetsqlproname['productname']?></td>
<td  data-label="Quantity" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=$fetsql['quantity']?></td>
<td  data-label="Amount" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format($fetsql['productvalue'],2,'.',',')?></td>
<td  data-label="Payment Term" style="<?=(((in_array('Payment Term', $newanscheck)))?'':'display: none;')?>border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=(($_GET['payterm']=='all')?'All':$fetsql['invoiceterm'])?></td>
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;">
	<td  data-label="Total" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;" colspan="<?=(((in_array('Sno', $newanscheck)))?'3':'2')?>">
		Total
	</td>
	<td  data-label="Total" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;text-align: right;">
		<?=number_format($totalamount,2,'.',',')?>
	</td>
	<td  data-label="Total" style="<?=(((in_array('Payment Term', $newanscheck)))?'':'display: none;')?>border: 1px solid #eee;padding-left: 10px;font-size: 13px;"></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&$_GET['term']=='cust') {
$sqliinvoicefrt=mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') GROUP BY customerid");
$crb=0;
$int=0;
  while($infoinvoicefrt=mysqli_fetch_array($sqliinvoicefrt))
  {
$sqliinvoice=mysqli_query($con, "select customername, customerid,invoiceamount, invoicedate, invoiceno from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='".$infoinvoicefrt['customerid']."' GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc");
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
?>
<tr style="height: 30px;" onclick="window.open('reportcustdetails.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>&customerid=<?=$customerid?>','_self')"><td  data-label="Customer Name" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$customername?></td>
<td  data-label="Invoice Amount" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format($invoiceamount,2,'.',',')?></td>
<td  data-label="Balance" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format($balanceamount,2,'.',',')?></td>
</tr>
<?php
}
?>
<tr style="height: 30px;font-weight: bold;"><td style="border: 1px solid #eee;padding-left: 10px;">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$int,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$crb,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&$_GET['term']=='saledetails') {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='saledetails' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$anscheck = $sqlviewreport['rowcolumns'];
$newanscheck = explode(',',$anscheck);
$sqlsel = mysqli_query($con,"select invoiceterm,productname,sum(quantity) as quantity,sum(productvalue) as productvalue,invoiceno,invoicedate from pairinvoices where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."' and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') and (invoicetime>='".$_GET['timefrom']."' and invoicetime<='".$_GET['timeto']."')".(($_GET['payterm']=='all')?' ':' and invoiceterm="'.$_GET['payterm'].'"')." and productid='".$_GET['productid']."' group by invoiceno,invoicedate");              
$count=1;
while($fetsql = mysqli_fetch_array($sqlsel)){
$sqlselproname = mysqli_query($con,"select productname from pairproducts where id='".$_GET['productid']."'");
$fetsqlproname = mysqli_fetch_array($sqlselproname);
?>
<tr style="height: 30px;"><td  data-label="Sno" style="<?=(((in_array('Sno', $newanscheck)))?'':'display: none;')?>border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$count?></td>
<td  data-label="Product Name" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$fetsqlproname['productname']?></td>
<td  data-label="Invoice Number" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;text-align: left;"><?=$fetsql['invoiceno']?></td>
<td  data-label="Invoice Date" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;text-align: left;"><?=date($datemainphp,strtotime($fetsql['invoicedate']))?></td>
<td  data-label="Quantity" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=$fetsql['quantity']?></td>
<td  data-label="Amount" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format($fetsql['productvalue'],2,'.',',')?></td>
<td class="text-uppercase" style="<?=(((in_array('Payment Term', $newanscheck)))?'width:13%;':'display: none;')?>border:1px solid #eee;padding-left: 10px;"><span style="font-size:13px;color:black;"><?=$fetsql['invoiceterm']?></span></td>
</tr>
<?php
$count++;
}
}
elseif (isset($_GET['term'])&&$_GET['term']=='custdetails') {
$sqliinvoice=mysqli_query($con, "SELECT 
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
                    AND (pi.invoicedate >= '".$_GET['datefrom']."' AND pi.invoicedate <= '".$_GET['dateto']."')
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
                    AND (pcn.creditnotedate >= '".$_GET['datefrom']."' AND pcn.creditnotedate <= '".$_GET['dateto']."')
                    AND pcn.customerid = '".$_GET['customerid']."'
                GROUP BY 
                    pcn.creditnoteno, pcn.creditnotedate
                ORDER BY 
                    notedate ASC");
$int = 0;
$crb = 0;
  while($infoinvoice=mysqli_fetch_array($sqliinvoice))
  {
    $int += $infoinvoice['amount'];
    $balanceamount = $infoinvoice['balanceamount'];
    $crb += $balanceamount;
?>
<tr style="height: 30px;"><td  data-label="Customer Name" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$infoinvoice['customername']?></td>
<td  data-label="Invoice Number" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$infoinvoice['noteno']?></td>
<td  data-label="Invoice Date" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=date($datemainphp,strtotime($infoinvoice['notedate']))?></td>
<td  data-label="Invoice Amount" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format($infoinvoice['amount'],2,'.',',')?></td>
<td  data-label="Balance" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format($balanceamount,2,'.',',')?></td>
<td  data-label="Over Due" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=(($balanceamount>0)?calculateOverdueDays($infoinvoice['duedate'], date("Y-m-d")):'No Due')?></td>
</tr>
<?php
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;" colspan="3">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$int,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$crb,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&$_GET['term']=='journal') {
$sqlijournal=mysqli_query($con, "select customerid, chartaccountname, customername, sum(ledgerdebit) as ledgerdebit, sum(ledgercredit) as ledgercredit, notes,ledgerdate, ledgerno, referenceno, referencedate, totalledgerdebit, totalledgercredit, id, type from pairledgers where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (ledgerdate>='".$_GET['datefrom']."' and ledgerdate<='".$_GET['dateto']."') group by chartaccountid,ledgerdate,ledgerno,type order by ledgerdate,ledgerno,type asc");
$ledgerno = '';
$totalCredit = 0;
$totalDebit = 0;
  while($infojournal=mysqli_fetch_array($sqlijournal))
  {
    if (($ledgerno!=$infojournal['ledgerno'].'-'.$infojournal['ledgerdate'].'-'.$infojournal['type'])) {
      if (!empty($ledgerno)) {
            echo '<tr style="height: 30px;background-color:#eee;">                    <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"></td>
                    <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;">' . number_format($totalDebit,2,'.',',') . '</td>
                    <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;">' . number_format($totalCredit,2,'.',',') . '</td>
                  </tr>';
            $totalCredit = 0;
            $totalDebit = 0;
        }
    $ledgerno = $infojournal['ledgerno'].'-'.$infojournal['ledgerdate'].'-'.$infojournal['type'];
    $sqlijournalcustname=mysqli_query($con, "select customerid, customername from pairledgers where ledgerno='".$infojournal['ledgerno']."' and ledgerdate='".$infojournal['ledgerdate']."' and ledgerdebit!='0'");
    $infojournalcustname=mysqli_fetch_array($sqlijournalcustname);
    $custnamesledger='<span style="color:royalblue;" onclick="window.open(\'customerview.php?id='.$infojournalcustname['customerid'].'\',\'_self\')">('.$infojournalcustname['customername'].')</span>';
?>
<tr style="height: 30px;"><td  data-label="Description" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=date($datemainphp,strtotime($infojournal['ledgerdate']))?> - <?=strtoupper($infojournal['type'])?><?=$infojournal['ledgerno']?><?=$custnamesledger?></td>
<td  data-label="Debit" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"> Debit</td>
<td  data-label="Credit" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"> Credit</td>
</tr>
<?php
}
?>
<tr style="height: 30px;"><td  data-label="Description" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$infojournal['chartaccountname']?></td>
<td  data-label="Debit" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format($infojournal['ledgerdebit'],2,'.',',')?></td>
<td  data-label="Credit" style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format($infojournal['ledgercredit'],2,'.',',')?></td>
</tr>
<?php
$totalCredit += $infojournal['ledgercredit'];
$totalDebit += $infojournal['ledgerdebit'];
}
if (!empty($ledgerno)) {
    echo '<tr style="height: 30px;background-color:#eee;">                    <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"></td>
                    <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;">' . number_format($totalDebit,2,'.',',') . '</td>
                    <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;">' . number_format($totalCredit,2,'.',',') . '</td>
          </tr>';
}
}
elseif (isset($_GET['term'])&&$_GET['term']=='accounttrans') {
$sqlijournal=mysqli_query($con, "select customerid, chartaccountname, customername, sum(ledgerdebit) as ledgerdebit, sum(ledgercredit) as ledgercredit, notes,ledgerdate, ledgerno, referenceno, referencedate, totalledgerdebit, totalledgercredit, id, type from pairledgers where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (ledgerdate>='".$_GET['datefrom']."' and ledgerdate<='".$_GET['dateto']."') group by chartaccountid,ledgerdate,ledgerno,type order by ledgerdate,ledgerno,type asc");
$ledgerno = '';
  while($infojournal=mysqli_fetch_array($sqlijournal))
  {
?>
<tr style="height: 30px;"><td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=date($datemainphp,strtotime($infojournal['ledgerdate']))?></td>
<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$infojournal['chartaccountname']?></td>
<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$infojournal['notes']?></td>
<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=ucfirst($infojournal['type'])?></td>
<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$infojournal['ledgerno']?></td>
<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$infojournal['referenceno']?></td>
<td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format($infojournal['ledgerdebit'],2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format($infojournal['ledgercredit'],2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"><?=number_format(($infojournal['ledgercredit']>0)?$infojournal['ledgercredit']:$infojournal['ledgerdebit'],2,'.',',')?></td>
</tr>
<?php
}
}
elseif (isset($_GET['term'])&&$_GET['term']=='prosalecus') {
if($_GET['category']!='all'){
$sqlicatname = mysqli_query($con, "SELECT category From paircategory WHERE id='".$_GET['category']."' order by category asc");
$infocatname = mysqli_fetch_array($sqlicatname);
$categoryname = $infocatname['category'];
}
$seldata = mysqli_query($con, "SELECT * FROM pairinvoices WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (invoicedate>='" . $_GET['datefrom'] . "' AND invoicedate<='" . $_GET['dateto'] . "') AND cancelstatus='0'".(($_GET['names']=='all')?' ':' and customerid="'.$_GET['names'].'"')." ".(($_GET['category']=='all')?' ':' and manufacturer="'.$categoryname.'"')." ORDER BY productname ASC");

$lastProduct = null;
$totalQuantity = 0;
$totalFreeQuantity = 0;
$totalValue = 0;
$totalValuetot = 0;
$totalRatetot = 0;

while ($info = mysqli_fetch_array($seldata)) {
    $totalValuetot += $info['productvalue'];
    $totalRatetot += ($info['productrate'])+(($info['productrate'] * ($_GET['commision']) /100));
    if ($info['productname'] != $lastProduct) {
        if ($lastProduct !== null) {
            ?>
            <tr style="vertical-align: middle; height: 30px !important;">                <td colspan="4" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"></td>
                <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $totalQuantity ?></td>
                <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $totalFreeQuantity ?></td>
                <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"></td>
                <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= number_format((float)$totalValue,2,'.',',')?></td>
            </tr>
            <?php
        }
        $totalQuantity = 0;
        $totalFreeQuantity = 0;
        $totalValue = 0;

        ?>
        <tr>
            <td colspan="8" style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['productname'] ?></td>
        </tr>
        <?php
        $lastProduct = $info['productname'];
    }
    	if ($info['productrate']>0) {
    		$totalQuantity += $info['quantity'];
 		}
 		else{
 			$totalFreeQuantity += $info['quantity'];
 		}
    $totalValue += $info['productvalue'];

    ?>
    <tr style="vertical-align: middle; height: 30px !important;">        <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['invoiceno'] ?></td>
        <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= date($datemainphp, strtotime($info['invoicedate'])) ?></td>
        <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['customername'] ?></td>
        <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['pos'] ?></td>
        <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= (($info['productrate']>0)?$info['quantity']:'') ?></td>
        <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= (($info['productrate']>0)?'':$info['quantity']) ?></td>
        <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= number_format((float)($info['productrate'])+(($info['productrate'] * ($_GET['commision']) /100)),2,'.',',') ?></td>
        <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= number_format((float)$info['productvalue'],2,'.',',') ?></td>
    </tr>
    <?php
}
if ($lastProduct !== null) {
    ?>
    <tr style="vertical-align: middle; height: 30px !important;">        <td colspan="4" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"></td>
        <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $totalQuantity ?></td>
        <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $totalFreeQuantity ?></td>
        <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"></td>
        <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= number_format((float)$totalValue,2,'.',',') ?></td>
    </tr>
    <?php
}
?>
<tr style="height: 30px;font-weight: bold;">
	<td style="border: 1px solid #eee;padding-left: 10px;" colspan="6">Total</td>
	<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$totalRatetot,2,'.',',')?></td>
	<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$totalValuetot,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&$_GET['term']=='stockinhandwithvalue') {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='stockinhandwithvalue' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$seldata = mysqli_query($con, "SELECT * FROM pairbills WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (billdate>='" . $_GET['datefrom'] . "' AND billdate<='" . $_GET['dateto'] . "') AND cancelstatus='0' ".(($_GET['proid']=='all')?' ':' and productid="'.$_GET['proid'].'"')." ORDER BY productname ASC");

$lastProduct = null;
$totalQuantity = 0;
$totalFreeQuantity = 0;
$totalValue = 0;
$allTotalQuantity = 0;
$allTotalValue = 0;
$allTax = 0;
$allAmount = 0;
$stockonopen = 0;
$stockonclose = 0;
while ($info = mysqli_fetch_array($seldata)) {
   if ($info['productname'] != $lastProduct) {
      if ($lastProduct !== null) {
?>
<tr style="vertical-align: middle; height: 30px !important;">
	<td colspan="6" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"></td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $totalQuantity ?></td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= number_format((float)$totalValue,2,'.',',') ?></td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"></td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"></td>
</tr>
	<?php
		}
		$totalQuantity = 0;
		$totalValue = 0;
																								$stockonopen = 0;
																								$stockonclose = 0;
																								$dateopen = new DateTime($_GET['datefrom']);
																								$dateopen->modify('-1 day');
																								$previousDateopen = $dateopen->format('Y-m-d');
																								$seldatasopen=$con->prepare("SELECT quantity FROM pairbills WHERE franchisesession=? AND createdid=? AND billdate<=? AND cancelstatus='0' ".(($_GET['proid']=='all')?' AND productid="'.$info['productid'].'"':' AND productid="'.$_GET['proid'].'"')." ORDER BY productname ASC");
													      									$seldatasopen->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $previousDateopen);
													      									$seldatasopen->execute();
													      									$seldataopen = $seldatasopen->get_result();
																								while($infoopen=$seldataopen->fetch_array()){
																									$stockonopen += $infoopen['quantity'];
																									$stockonclose += $infoopen['quantity'];
																								}
																								$seldatasopeninv=$con->prepare("SELECT quantity FROM pairinvoices WHERE franchisesession=? AND createdid=? AND invoicedate<=? AND cancelstatus='0' ".(($_GET['proid']=='all')?' AND productid="'.$info['productid'].'"':' AND productid="'.$_GET['proid'].'"')." ORDER BY productname ASC");
													      									$seldatasopeninv->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $previousDateopen);
													      									$seldatasopeninv->execute();
													      									$seldataopeninv = $seldatasopeninv->get_result();
																								while($infoopeninv=$seldataopeninv->fetch_array()){
																									$stockonclose -= $infoopeninv['quantity'];
																								}
	?>
<tr>
	<td colspan="10" style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['productname'] ?> ( Opening : <?=$stockonopen?>) <?=((($_GET['dateto'] < date('Y-m-d'))) ? '( Closing : '.$stockonclose.')' : '')?></td>
</tr>
<?php
		$lastProduct = $info['productname'];
	}
	$totalQuantity += $info['quantity'];
	$totalValue += $info['productvalue'];
	$allTotalQuantity += $info['quantity'];
	$allTotalValue += $info['productvalue'];
	$allTax += $info['taxvalue'];
	$allAmount += $info['productnetvalue'];
?>
<tr style="vertical-align: middle; height: 30px !important;">
	<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['billno'] ?></td>
	<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= date($datemainphp, strtotime($info['billdate'])) ?></td>
	<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['vendorname'] ?></td>
	<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;">
		<?= $info['batch'] ?>
	</td>
	<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;">
		<?= date($datemainphp,strtotime($info['expdate'])) ?>
	</td>
	<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;">
		<?= $info['productrate'] ?>
	</td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $info['quantity'] ?></td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;">
		<?= number_format((float)$info['productvalue'],2,'.',',') ?>
	</td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;">
		<?= number_format((float)$info['taxvalue'],2,'.',',') ?>
	</td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;">
		<?= number_format((float)$info['productnetvalue'],2,'.',',') ?>
	</td>
</tr>
<?php
}
if ($lastProduct !== null) {
?>
<tr style="vertical-align: middle; height: 30px !important;">
	<td colspan="6" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"></td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $totalQuantity ?></td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= number_format((float)$totalValue,2,'.',',') ?></td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"></td>
	<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"></td>
</tr>
<?php
}
?>
<tr style="height: 30px;font-weight: bold;">
	<td style="border: 1px solid #eee;padding-left: 10px;" colspan="6">Total</td>
	<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=$allTotalQuantity?></td>
	<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$allTotalValue,2,'.',',')?></td>
	<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$allTax,2,'.',',')?></td>
	<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$allAmount,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&$_GET['term']=='promovement') {
if($_GET['proid']!='all'){
$sqliproname = mysqli_query($con, "SELECT productname From pairproducts WHERE id='".$_GET['proid']."' order by productname asc");
$infoproname = mysqli_fetch_array($sqliproname);
$proname = $infoproname['productname'];
}
else{
$proname = 'All';
}
$adjtotal = 0;
$saletotal = 0;
$purtotal = 0;
$allthetotal = 0;
$seldata = mysqli_query($con, "SELECT quantity AS quantities,'invoices' AS types,invoiceno AS numbers,invoicedate AS dates,productname AS productname,customername as names FROM pairinvoices WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (invoicedate>='" . $_GET['datefrom'] . "' AND invoicedate<='" . $_GET['dateto'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." UNION SELECT quantity AS quantities,'bills' AS types,billno AS numbers,billdate AS dates,productname AS productname,vendorname as names FROM pairbills WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (billdate>='" . $_GET['datefrom'] . "' AND billdate<='" . $_GET['dateto'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." UNION SELECT newquantity AS quantities,'adjustments' AS types,privateid AS numbers,adjustmentdate AS dates,productname AS productname,createdby as names FROM pairadjustments WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (adjustmentdate>='" . $_GET['datefrom'] . "' AND adjustmentdate<='" . $_GET['dateto'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." ORDER BY dates,numbers ASC");
while ($info = mysqli_fetch_array($seldata)) {
?>
<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= date($datemainphp, strtotime($info['dates'])) ?></td>
  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['numbers'] ?></td>
  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['names'] ?></td>
  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= (($info['types']=='adjustments')?$info['quantities']:'0') ?></td>
  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= (($info['types']=='invoices')?$info['quantities']:'0') ?></td>
  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= (($info['types']=='bills')?$info['quantities']:'0') ?></td>
</tr>
<?php
}
$seldataanother = mysqli_query($con, "SELECT quantity AS quantities,'invoices' AS types,invoiceno AS numbers,invoicedate AS dates,productname AS productname,customername as names FROM pairinvoices WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (invoicedate>='" . $_GET['datefrom'] . "' AND invoicedate<='" . $_GET['dateto'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." UNION SELECT quantity AS quantities,'bills' AS types,billno AS numbers,billdate AS dates,productname AS productname,vendorname as names FROM pairbills WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (billdate>='" . $_GET['datefrom'] . "' AND billdate<='" . $_GET['dateto'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." UNION SELECT newquantity AS quantities,'adjustments' AS types,privateid AS numbers,adjustmentdate AS dates,productname AS productname,createdby as names FROM pairadjustments WHERE franchisesession='" . $_SESSION['franchisesession'] . "' AND createdid='$companymainid' AND (adjustmentdate>='" . $_GET['datefrom'] . "' AND adjustmentdate<='" . $_GET['dateto'] . "') AND cancelstatus='0'".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." ORDER BY dates,numbers ASC");
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
if (mysqli_num_rows($seldata)>0) {
?>
<tr style="height: 30px;font-weight: bold;"><td style="border: 1px solid #eee;padding-left: 10px;" colspan="3">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$adjtotal,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$saletotal,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$purtotal,2,'.',',')?></td>
</tr>
<tr style="height: 30px;font-weight: bold;"><td style="border: 1px solid #eee;padding-left: 10px;" colspan="3">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;text-align: right;" colspan="3"><?=number_format((float)$allthetotal,2,'.',',')?></td>
</tr>
<?php
}
}
elseif (isset($_GET['term'])&&$_GET['term']=='salesperson') {
$seldata = mysqli_query($con, "select * from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (invoicedate>='".$_GET['datefrom']."' and invoicedate<='".$_GET['dateto']."') AND cancelstatus='0'".(($_GET['preparedby']=='all')?' ':' and preparedby="'.$_GET['preparedby'].'"')."".(($_GET['checkedby']=='all')?' ':' and checkedby="'.$_GET['checkedby'].'"')." GROUP BY invoicedate, invoiceno ORDER BY invoicedate,invoiceno");
while ($info = mysqli_fetch_array($seldata)) {
$rowinpid = $info['invoiceno'].str_replace('-', '', $info['invoicedate']);
?>
<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;">Sales</td>
  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= date($datemainphp, strtotime($info['invoicedate'])) ?></td>
  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['invoiceno'] ?></td>
  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['customername'] ?></td>
  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><?= $info['city'] ?></td>
  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= number_format((float)$info['totalamount'],2,'.',',') ?></td>
  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= number_format((float)$info['totalvatamount'],2,'.',',') ?></td>
  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= number_format((float)$info['grandtotal'],2,'.',',') ?></td>
  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $info['preparedby'] ?></td>
  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $info['checkedby'] ?></td>
  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;padding-left: 10px;" id="inputforpercentpdf<?=$rowinpid?>"></td>
  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;padding-left: 10px;" id="inputforamountpdf<?=$rowinpid?>"></td>
</tr>
<?php
}
}
elseif (isset($_GET['term'])&&$_GET['term']=='payreceive') {
$sqlreportviews=$con->prepare("SELECT * FROM pairreports WHERE franchiseid=? AND createdid=? AND types='payreceive'");
	$sqlreportviews->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
	$sqlreportviews->execute();
	$sqlreportview = $sqlreportviews->get_result();
	$sqlviewreport=$sqlreportview->fetch_array();
	$sqlreportview->close();
	$sqlreportviews->close();
	//FOR THIS REPORT ROWS AND COLUMNS ON/OFF PREFERENCES

	$anscheck = $sqlviewreport['rowcolumns'];
	$newanscheck = explode(',',$anscheck);

	$sqlinfos=$con->prepare("SELECT * FROM pairsalespayments WHERE franchisesession=? AND createdid=? AND (receiptdate>=? AND receiptdate<=?) ".(($_GET['names']=='all')?' ':' AND customerid="'.$_GET['names'].'"')."".(($_GET['payterm']=='all')?' ':' AND paymentmode="'.$_GET['payterm'].'"')." ORDER BY id DESC");
	$sqlinfos->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto']);
	$sqlinfos->execute();
	$sqlinfo = $sqlinfos->get_result();
	$count=1;
	while($info=$sqlinfo->fetch_array()){
?>
<tr style="height: 30px;">
	<td data-label="Date" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=date($datemainphp,strtotime($info['receiptdate']))?></td>
	<td data-label="Number" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['receiptno']?></td>
	<td data-label="<?=$infomainaccessusercus['modulename']?> Name" style="<?=(((in_array('Customer Name', $newanscheck)))?'':'display: none;')?>border: 1px solid #eee;padding-left: 10px;font-size: 13px;<?=((($sqlviewreport['filtername']=='1')||($sqlviewreport['filtername']=='0'))?'':'display:none;')?>"><?=$info['customername']?></td>
	<td data-label="Total" style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$info['amount'],2,'.',',')?></td>
	<td data-label="Payment Term" style="<?=(((in_array('Payment Term', $newanscheck)))?'':'display: none;')?>border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['paymentmode']?></td>
</tr>
<?php
		$count++;
	}
}
elseif (isset($_GET['term'])&&$_GET['term']=='paymade') {
	$sqlreportviews=$con->prepare("SELECT * FROM pairreports WHERE franchiseid=? AND createdid=? AND types='paymade'");
	$sqlreportviews->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
	$sqlreportviews->execute();
	$sqlreportview = $sqlreportviews->get_result();
	$sqlviewreport=$sqlreportview->fetch_array();
	$sqlreportview->close();
	$sqlreportviews->close();
	//FOR THIS REPORT ROWS AND COLUMNS ON/OFF PREFERENCES

	$anscheck = $sqlviewreport['rowcolumns'];
	$newanscheck = explode(',',$anscheck);

	$sqlinfos=$con->prepare("SELECT * FROM pairpurchasepayments WHERE franchisesession=? AND createdid=? AND (receiptdate>=? AND receiptdate<=?) ".(($_GET['names']=='all')?' ':' AND vendorid="'.$_GET['names'].'"')."".(($_GET['payterm']=='all')?' ':' AND paymentmode="'.$_GET['payterm'].'"')." ORDER BY id DESC");
	$sqlinfos->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto']);
	$sqlinfos->execute();
	$sqlinfo = $sqlinfos->get_result();
	$count=1;
	while($info=$sqlinfo->fetch_array()){
?>
<tr style="height: 30px;">
	<td data-label="Date" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=date($datemainphp,strtotime($info['receiptdate']))?></td>
	<td data-label="Number" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['receiptno']?></td>
	<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="<?=(((in_array('Vendor Name', $newanscheck)))?'':'display: none;')?>border: 1px solid #eee;padding-left: 10px;font-size: 13px;<?=((($sqlviewreport['filtername']=='1')||($sqlviewreport['filtername']=='0'))?'':'display:none;')?>"><?=$info['vendorname']?></td>
	<td data-label="Total" style="border: 1px solid #eee;padding-right: 10px;text-align: right;"><?=number_format((float)$info['amount'],2,'.',',')?></td>
	<td data-label="Payment Term" style="<?=(((in_array('Payment Term', $newanscheck)))?'':'display: none;')?>border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['paymentmode']?></td>
</tr>
<?php
		$count++;
	}
}
elseif (isset($_GET['term'])&&$_GET['term']=='salesprofitloss') {
																						$allthetotal = 0;
																						$seldatas=$con->prepare("SELECT * FROM pairinvoices WHERE franchisesession=? AND createdid=? AND (invoicedate>=? AND invoicedate<=?) AND cancelstatus='0' ".(($_GET['proid']=='all')?' ':' AND productid="'.$_GET['proid'].'"')." ".(($_GET['modules']=='all')?'':(($_GET['modules']=='products')?'AND itemmodule=\'Products\'':'AND itemmodule=\'Services\''))." ORDER BY invoiceno,invoicedate ASC");
										      										$seldatas->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto']);
										      										$seldatas->execute();
										      										$seldata = $seldatas->get_result();
																						while($info=$seldata->fetch_array()){

																							$selectproducts=$con->prepare("SELECT productname FROM pairproducts WHERE franchisesession=? AND createdid=? AND id=?");
											      										$selectproducts->bind_param("ssi", $_SESSION['franchisesession'], $companymainid, $info['productid']);
											      										$selectproducts->execute();
											      										$selectproduct = $selectproducts->get_result();
																							$fetchproduct=$selectproduct->fetch_array();

																							$checkbymargins=$con->prepare("SELECT * FROM pairmargins WHERE franchisesession=? AND createdid=? AND productid=? AND batch=? AND expiry=? AND type='buying' AND quantity>0 AND nowstatus='added' GROUP BY billingdate, billingno ORDER BY billingdate ASC, billingno ASC");
											      										$checkbymargins->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['productid'], $info['batch'], $info['expdate']);
											      										$checkbymargins->execute();
											      										$checkbymargin = $checkbymargins->get_result();

																							$checkbybills=$con->prepare("SELECT * FROM pairbills WHERE franchisesession=? AND createdid=? AND productid=? AND batch=? AND expdate=? AND quantity>0 GROUP BY billdate, billno ORDER BY billdate ASC, billno ASC");
											      										$checkbybills->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['productid'], $info['batch'], $info['expdate']);
											      										$checkbybills->execute();
											      										$checkbybill = $checkbybills->get_result();
																							$quantityans = 0;

																							$billerans = '';

																							if (mysqli_num_rows($checkbymargin)>0) {

																								$checkbymargininners=$con->prepare("SELECT * FROM pairmargins WHERE franchisesession=? AND createdid=? AND productid=? AND batch=? AND expiry=? AND type='buying' AND quantity>0 AND nowstatus='added' GROUP BY billingdate, billingno ORDER BY billingdate ASC, billingno ASC");
												      										$checkbymargininners->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['productid'], $info['batch'], $info['expdate']);
												      										$checkbymargininners->execute();
												      										$checkbymargininner = $checkbymargininners->get_result();

																								$checkmarginqty = (int)$info['quantity'];

																								while($fetchmargininner=$checkbymargininner->fetch_array()){

																									if($checkmarginqty>0){

																										if($fetchmargininner['quantity']>$checkmarginqty){
																											$marginqty = $checkmarginqty;
																										}
																										else{
																											$marginqty = (int)$fetchmargininner['quantity'];
																											$checkmarginqty-=$marginqty;
																										}

																										if ($quantityans!=(int)$info['quantity']) {
																											$quantityans+=$marginqty;
																											$billerans.=$fetchmargininner['billerid'].'|||'.$fetchmargininner['billername'].'|||'.$fetchmargininner['billingno'].'|||'.$fetchmargininner['billingdate'].'|||'.$marginqty.'|||'.(($marginqty*$info['productrate'])-($marginqty*$fetchmargininner['rate'])).'|||'.$fetchmargininner['rate'].'|||'.$fetchmargininner['batch'].'|||'.$fetchmargininner['expiry'].'|||'.$fetchmargininner['prodiscounttype'].'|||'.$fetchmargininner['discountvalue'].'|||'.$info['prodiscounttype'].'|||'.$info['prodiscount'].'|-|';
																										}

																									}

																								}

																								if ($quantityans<(int)$info['quantity']) {

																									for ($i=$quantityans+1;$i<=(int)$info['quantity'];$i++) {
																										$quantityans+=1;
																										$billerans.='|-|';
																									}

																								}

																							}
																							else{

																								if ($quantityans<(int)$info['quantity']) {

																									for ($i=$quantityans+1;$i<=(int)$info['quantity'];$i++) {
																										$quantityans+=1;
																										$billerans.='|-|';
																									}

																								}

																							}
																							$runtheans = explode('|-|', $billerans);
																							$emptyqty = 0;
																							$margintotal = 0;
																							$showtheempty=true;
																							for($ans=0;$ans<count($runtheans);$ans++){
																								if (strpos($runtheans[$ans], '|||')!==false) {
																									$runtheansnxt = explode('|||', $runtheans[$ans]);
																									$emptyqty+=floatval($runtheansnxt[4]);
																					?>
																						<tr>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $info['productname'] ?></td>
																							<td data-label="Description" style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;"><span style="color: royalblue;">Purchase </span><br>Name : <?=$runtheansnxt[1]?> <br>Number : <?=$runtheansnxt[2]?> <br>Date : <?=date($datemainphp,strtotime($runtheansnxt[3]))?> <br><span style="font-size:10px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>">BATCH: <?=($runtheansnxt[7]!='')?$runtheansnxt[7]:'&nbsp;'?> </span><br><span style="font-size:10px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>">EXPIRY: <?=($runtheansnxt[8]!='')?date($datemainphp,strtotime($runtheansnxt[8])):'&nbsp;'?> </span></td>
																							<td data-label="Purchase Rate" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><span style="font-size: 11px;">RATE: <?=number_format(floatval($runtheansnxt[4]) * floatval($runtheansnxt[6]),2,'.','')?> </span><br><span style="font-size: 10px;"><?=$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[9]=='0')?floatval($runtheansnxt[10]).'%':floatval($runtheansnxt[10])).'(</span><span style="font-size: 10px;color:green !important;">'.number_format(floatval($runtheansnxt[4]) * floatval($runtheansnxt[6]),2,'.','').' - '.(($runtheansnxt[9]=='0')?number_format((((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100),2,'.',''):(number_format(floatval($runtheansnxt[10]),2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span>'?> </span><br>
																							<?php
																								if ($runtheansnxt[9]=='0') {
																									$finalmarginpurchase = number_format(((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) - (((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','');
																									echo '<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].': '.number_format(((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) - (((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','').'</span>';
																								}
																								else{
																									$finalmarginpurchase = number_format(((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','');
																									echo '<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].': '.number_format(((floatval($runtheansnxt[4]) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','').'</span>';
																								}
																							?></td>
																							<td data-label="Quantity" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?=floatval($runtheansnxt[4])?></td>
																							<td data-label="Description" style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;">Name : <?=$info['customername']?> <br>Number : <?=$info['invoiceno']?> <br><span style="font-size:10px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>">BATCH: <?=($info['batch']!='')?$info['batch']:'&nbsp;'?> </span><br><span style="font-size:10px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>">EXPIRY: <?=($info['expdate']!='')?date($datemainphp,strtotime($info['expdate'])):'&nbsp;'?> </span><br><b>	Date : <?=date($datemainphp,strtotime($info['invoicedate']))?> </b></td>
																							<td data-label="Sale Rate" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><span style="font-size: 11px;">RATE: <?=number_format(floatval($runtheansnxt[4]) * $info['productrate'],2,'.','')?> </span><br><span style="font-size: 10px;"><?=$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[11]=='0')?$runtheansnxt[12].'%':$runtheansnxt[12]).'(</span><span style="font-size: 10px;color:green !important;">'.number_format(floatval($runtheansnxt[4]) * floatval($runtheansnxt[6]),2,'.','').' - '.(($runtheansnxt[11]=='0')?number_format((((floatval($runtheansnxt[4]) * $info['productrate']) * $runtheansnxt[12]) / 100),2,'.',''):(number_format($runtheansnxt[12],2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span>'?> </span><br>
																							<?php
																								if ($runtheansnxt[11]=='0') {
																									$finalmarginsales = number_format(((floatval($runtheansnxt[4]) * $info['productrate']) - (((floatval($runtheansnxt[4]) * $info['productrate']) * $runtheansnxt[12]) / 100)),2,'.','');
																									echo '<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].': '.number_format(((floatval($runtheansnxt[4]) * $info['productrate']) - (((floatval($runtheansnxt[4]) * $info['productrate']) * $runtheansnxt[12]) / 100)),2,'.','');
																								}
																								else{
																									$finalmarginsales = number_format(((floatval($runtheansnxt[4]) * $info['productrate']) - ($runtheansnxt[12])),2,'.','');
																									echo '<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].': '.number_format(((floatval($runtheansnxt[4]) * $info['productrate']) - ($runtheansnxt[12])),2,'.','');
																								}
																								$margintotal += number_format(($finalmarginsales - $finalmarginpurchase),2,'.','');
																							?></td>
																							<td data-label="Profit Margin" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?=number_format(($finalmarginsales - $finalmarginpurchase),2,'.','')?></td>
																						</tr>
																					<?php
																						}
																						else{
																							if (($showtheempty==true)&&(($quantityans-$emptyqty)>0)) {
																								$showtheempty=false;

																								$selectpurrates=$con->prepare("SELECT purchasecost FROM pairpropurchase WHERE createdid=? AND productid=?");
																								$selectpurrates->bind_param("si", $companymainid, $info['productid']);
																								$selectpurrates->execute();
																								$selectpurrate = $selectpurrates->get_result();
																								$fetchpurrate=$selectpurrate->fetch_array();

																								if($access['profitvalidationrule']=='1'){
																									if ($ans!=0) {
																										if ($runtheansnxt[9]=='0') {
																											$finalmarginpurchasenxt = number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','');
																											$finalmarginpurchaseans =  number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','');
																										}
																										else{
																											$finalmarginpurchasenxt = number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','');
																											$finalmarginpurchaseans =  number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','');
																										}
																										if ($runtheansnxt[11]=='0') {
																											$finalmarginsalesnxt = number_format(((($quantityans-$emptyqty) * $info['productrate']) - (((($quantityans-$emptyqty) * $info['productrate']) * $runtheansnxt[12]) / 100)),2,'.','');
																											$finalmarginsalesans =  number_format(((($quantityans-$emptyqty) * $info['productrate']) - (((($quantityans-$emptyqty) * $info['productrate']) * $runtheansnxt[12]) / 100)),2,'.','');
																										}
																										else{
																											$finalmarginsalesnxt = number_format(((($quantityans-$emptyqty) * $info['productrate']) - ($runtheansnxt[12])),2,'.','');
																											$finalmarginsalesans =  number_format(((($quantityans-$emptyqty) * $info['productrate']) - ($runtheansnxt[12])),2,'.','');
																										}
																										$rateforsale = '<span style="font-size: 11px;">RATE: '.number_format(($quantityans-$emptyqty) * $info['productrate'],2,'.','').'</span><br>'.('<span style="font-size: 10px;">'.$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[11]=='0')?$runtheansnxt[12].'%':$runtheansnxt[12]).'(</span><span style="font-size: 10px;color:green !important;">'.number_format(($quantityans-$emptyqty) * $info['productrate'],2,'.','').' - '.(($runtheansnxt[11]=='0')?number_format((((($quantityans-$emptyqty) * $info['productrate']) * $runtheansnxt[12]) / 100),2,'.',''):(number_format($runtheansnxt[12],2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span></span>').'<br>'.'<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].$finalmarginsalesans.'</span>';
																										$rateforpur = '<span style="font-size: 11px;">RATE: '.number_format(($quantityans-$emptyqty) * floatval($runtheansnxt[6]),2,'.','').'</span><br>'.('<span style="font-size: 10px;">'.$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[9]=='0')?floatval($runtheansnxt[10]).'%':floatval($runtheansnxt[10])).'(</span><span style="font-size: 10px;color:green !important;">'.number_format(($quantityans-$emptyqty) * floatval($runtheansnxt[6]),2,'.','').' - '.(($runtheansnxt[9]=='0')?number_format((((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100),2,'.',''):(number_format(floatval($runtheansnxt[10]),2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span></span>').'<br>'.'<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].$finalmarginpurchaseans.'</span>';
																										$martotalforpur = number_format(($finalmarginsalesnxt - $finalmarginpurchasenxt),2,'.','');
																										$margintotal+=$martotalforpur;
																									}
																									else{
																										if ($fetchpurrate['purchasecost']!='') {
																											$rateforsale = $info['productrate'];
																											$rateforpur = number_format($fetchpurrate['purchasecost'],2,'.','');
																											$martotalforpur = ($quantityans-$emptyqty)*($info['productrate']) - ($quantityans-$emptyqty)*($fetchpurrate['purchasecost']);
																											$margintotal+=$martotalforpur;
																										}
																										else{
																											$rateforsale = $info['productrate'];
																											$rateforpur = '0.00';
																											$martotalforpur = ($quantityans-$emptyqty)*($info['productrate']);
																											$margintotal+=($quantityans-$emptyqty)*($info['productrate']);
																										}
																									}
																								}
																								else{
																									if ($ans!=0) {
																										if ($runtheansnxt[9]=='0') {
																											$finalmarginpurchasenxt = number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','');
																											$finalmarginpurchaseans =  number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100)),2,'.','');
																										}
																										else{
																											$finalmarginpurchasenxt = number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','');
																											$finalmarginpurchaseans =  number_format(((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) - (floatval($runtheansnxt[10]))),2,'.','');
																										}
																										if ($runtheansnxt[11]=='0') {
																											$finalmarginsalesnxt = number_format(((($quantityans-$emptyqty) * $info['productrate']) - (((($quantityans-$emptyqty) * $info['productrate']) * $runtheansnxt[12]) / 100)),2,'.','');
																											$finalmarginsalesans =  number_format(((($quantityans-$emptyqty) * $info['productrate']) - (((($quantityans-$emptyqty) * $info['productrate']) * $runtheansnxt[12]) / 100)),2,'.','');
																										}
																										else{
																											$finalmarginsalesnxt = number_format(((($quantityans-$emptyqty) * $info['productrate']) - ($runtheansnxt[12])),2,'.','');
																											$finalmarginsalesans =  number_format(((($quantityans-$emptyqty) * $info['productrate']) - ($runtheansnxt[12])),2,'.','');
																										}
																										$rateforsale = '<span style="font-size: 11px;">RATE: '.number_format(($quantityans-$emptyqty) * $info['productrate'],2,'.','').'</span><br>'.('<span style="font-size: 10px;">'.$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[11]=='0')?$runtheansnxt[12].'%':$runtheansnxt[12]).'(</span><span style="font-size: 10px;color:green !important;">'.number_format(($quantityans-$emptyqty) * $info['productrate'],2,'.','').' - '.(($runtheansnxt[11]=='0')?number_format((((($quantityans-$emptyqty) * $info['productrate']) * $runtheansnxt[12]) / 100),2,'.',''):(number_format($runtheansnxt[12],2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span></span>').'<br>'.'<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].$finalmarginsalesans.'</span>';
																										$rateforpur = '<span style="font-size: 11px;">RATE: '.number_format(($quantityans-$emptyqty) * floatval($runtheansnxt[6]),2,'.','').'</span><br>'.('<span style="font-size: 10px;">'.$access['txtprodisinv'].': <span style="font-size: 10px;color:#cb0c9f !important;">'.(($runtheansnxt[9]=='0')?floatval($runtheansnxt[10]).'%':floatval($runtheansnxt[10])).'(</span><span style="font-size: 10px;color:green !important;">'.number_format(($quantityans-$emptyqty) * floatval($runtheansnxt[6]),2,'.','').' - '.(($runtheansnxt[9]=='0')?number_format((((($quantityans-$emptyqty) * floatval($runtheansnxt[6])) * floatval($runtheansnxt[10])) / 100),2,'.',''):(number_format(floatval($runtheansnxt[10]),2,'.',''))).'</span><span style="font-size: 10px;color:#cb0c9f !important;">)</span></span>').'<br>'.'<br><span style="font-size: 12.5px;">'.$access['txttaxableinv'].$finalmarginpurchaseans.'</span>';
																										$martotalforpur = number_format(($finalmarginsalesnxt - $finalmarginpurchasenxt),2,'.','');
																									}
																									else{
																										if ($fetchpurrate['purchasecost']!='') {
																											$rateforsale = $info['productrate'];
																											$rateforpur = number_format($fetchpurrate['purchasecost'],2,'.','');
																											$martotalforpur = ($quantityans-$emptyqty)*($info['productrate']) - ($quantityans-$emptyqty)*($fetchpurrate['purchasecost']);
																										}
																										else{
																											$rateforsale = $info['productrate'];
																											$rateforpur = $info['productrate'];
																											$martotalforpur = ($quantityans-$emptyqty)*($info['productrate']) - ($quantityans-$emptyqty)*($info['productrate']);
																										}
																									}
																									$margintotal+=$martotalforpur;
																								}
																					?>
																						<tr>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?= $info['productname'] ?></td>
																							<td data-label="Description" style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;">
																							<?php
																								if ($ans!=0) {
																							?>
																								<span style="color: royalblue;">Last Purchase </span><br>Name : <?=$runtheansnxt[1]?> <br>Number : <?=$runtheansnxt[2]?> <br>Date : <?=date($datemainphp,strtotime($runtheansnxt[3]))?> 
																							<?php
																								}
																								else{
																									if ($fetchpurrate['purchasecost']!='') {
																							?>
																								<span style="color: royalblue;">Product Information Rate </span>
																							<?php
																									}
																									else{
																							?>
																								<span style="color: royalblue;">No Purchase Information </span>
																							<?php
																									}
																								}
																							?></td>
																							<td data-label="Purchase Rate" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?=$rateforpur?></td>
																							<td data-label="Quantity" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?=$quantityans-$emptyqty?></td>
																							<td data-label="Description" style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; padding-left: 10px;">Name : <?=$info['customername']?> <br>Number : <?=$info['invoiceno']?> <br><span style="font-size:10px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>">BATCH: <?=($info['batch']!='')?$info['batch']:'&nbsp;'?> </span><br><span style="font-size:10px;<?=($access['batchexpiryval']==1)?'':'display:none;'?>">EXPIRY: <?=($info['expdate']!='')?date($datemainphp,strtotime($info['expdate'])):'&nbsp;'?> </span><br><b>	Date : <?=date($datemainphp,strtotime($info['invoicedate']))?> </b></td>
																							<td data-label="Sale Rate" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?=$rateforsale?></td>
																							<td data-label="Profit Margin" style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; padding-right: 10px;"><?=$martotalforpur?></td>
																						</tr>
																					<?php
																									}
																								}
																							}
																							$allthetotal += $info['margintotalvalue'];
																						}
}
elseif (isset($_GET['term'])&&($_GET['term']=='crnote')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='crnote' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sqlregister=mysqli_query($con, "select * from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (creditnotedate>='".$_GET['datefrom']."' and creditnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY creditnotedate, creditnoteno");
$registerigst = 0;
$registercgst = 0;
$registersgst = 0;
$registercreditnotetotal = 0;
while($register=mysqli_fetch_array($sqlregister)){
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
$registercreditnotetotal += $register['grandtotal'];
}
}
?>
<tr onclick="window.open('reportcrnoteregistered.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>','_self')"><td data-label="PLACE OF SUPPLY" style="border:1px solid #eee;padding-left: 10px;">Taxable credit note supplies made to registered persons</td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registerigst==0)?number_format((float)0,2,'.',','):number_format((float)$registerigst,2,'.',',')) ?></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registercgst==0)?number_format((float)0,2,'.',','):number_format((float)$registercgst,2,'.',',')) ?></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registersgst==0)?number_format((float)0,2,'.',','):number_format((float)$registersgst,2,'.',',')) ?></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registercreditnotetotal==0)?number_format((float)0,2,'.',','):number_format((float)$registercreditnotetotal,2,'.',',')) ?></span></td>
</tr>
<?php
$sqlconsumer=mysqli_query($con, "select * from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (creditnotedate>='".$_GET['datefrom']."' and creditnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY creditnotedate, creditnoteno");
$consumerigst = 0;
$consumercgst = 0;
$consumersgst = 0;
$consumercreditnotetotal = 0;
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
$consumercreditnotetotal += $consumer['grandtotal'];
}
}
?>
<tr onclick="window.open('reportcrnoteconsumer.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>','_self')"><td data-label="PLACE OF SUPPLY" style="border:1px solid #eee;padding-left: 10px;">Taxable credit note supplies to consumer</td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumerigst==0)?number_format((float)0,2,'.',','):number_format((float)$consumerigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumercgst==0)?number_format((float)0,2,'.',','):number_format((float)$consumercgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumersgst==0)?number_format((float)0,2,'.',','):number_format((float)$consumersgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumercreditnotetotal==0)?number_format((float)0,2,'.',','):number_format((float)$consumercreditnotetotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&($_GET['term']=='drnote')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='drnote' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sqlregister=mysqli_query($con, "select * from pairdebitnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (debitnotedate>='".$_GET['datefrom']."' and debitnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY debitnotedate, debitnoteno");
$registerigst = 0;
$registercgst = 0;
$registersgst = 0;
$registerdebitnotetotal = 0;
while($register=mysqli_fetch_array($sqlregister)){
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
$registerdebitnotetotal += $register['grandtotal'];
}
}
?>
<tr onclick="window.open('reportdrnoteregistered.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>','_self')"><td data-label="PLACE OF SUPPLY" style="border:1px solid #eee;padding-left: 10px;">Purchases Received From Registered taxpayers</td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registerigst==0)?number_format((float)0,2,'.',','):number_format((float)$registerigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registercgst==0)?number_format((float)0,2,'.',','):number_format((float)$registercgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registersgst==0)?number_format((float)0,2,'.',','):number_format((float)$registersgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($registerdebitnotetotal==0)?number_format((float)0,2,'.',','):number_format((float)$registerdebitnotetotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
$sqlconsumer=mysqli_query($con, "select * from pairdebitnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (debitnotedate>='".$_GET['datefrom']."' and debitnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY debitnotedate, debitnoteno");
$consumerigst = 0;
$consumercgst = 0;
$consumersgst = 0;
$consumerdebitnotetotal = 0;
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
$consumerdebitnotetotal += $consumer['grandtotal'];
}
}
?>
<tr onclick="window.open('reportdrnoteconsumer.php?datefrom=<?=$_GET['datefrom']?>&dateto=<?=$_GET['dateto']?>','_self')"><td data-label="PLACE OF SUPPLY" style="border:1px solid #eee;padding-left: 10px;">Purchases Received From Unregistered (Consumer) taxpayers</td>
<td data-label="IGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumerigst==0)?number_format((float)0,2,'.',','):number_format((float)$consumerigst,2,'.',',')) ?></span></span></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumercgst==0)?number_format((float)0,2,'.',','):number_format((float)$consumercgst,2,'.',',')) ?></span></span></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumersgst==0)?number_format((float)0,2,'.',','):number_format((float)$consumersgst,2,'.',',')) ?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> TOTAL" style="text-align: right !important;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?= (($consumerdebitnotetotal==0)?number_format((float)0,2,'.',','):number_format((float)$consumerdebitnotetotal,2,'.',',')) ?></span></span></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&($_GET['term']=='crnoteconsumer')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='crnoteconsumer' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (creditnotedate>='".$_GET['datefrom']."' and creditnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY creditnotedate, creditnoteno order by creditnotedate asc, creditnoteno asc");
$tottaxamt = 0;
$totigstamt = 0;
$totcgstamt = 0;
$totsgstamt = 0;
while($info=mysqli_fetch_array($sql))
{
$tottaxamt += $info['totalamount'];
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
?>
<tr style="vertical-align: middle;"><td data-label="PLACE OF SUPPLY" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$info['customername']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color: grey;">Place of Supply : <span style="color: black;"><?=$info['pos']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color: grey;"><?=$infomainaccessusercreditnote["modulename"]?> Number : <span style="color: black;"><?=$info['creditnoteno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color: grey;">Amount : <span style="color: black;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['creditnotedate']))?></span></span></td>
<td data-label="<?=($access["txttaxablecreditnote"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['totalamount'],2,'.',',')?></span></span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infoigst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics!=$infofranposics)
{
$infoigst += $newgst[$i];
$totigstamt += $newgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infoigst,2,'.',',').'</span></span>';
?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infocgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infocgst += $newcgst[$i];
$totcgstamt += $newcgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infocgst,2,'.',',').'</span></span>';
?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infosgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infosgst += $newsgst[$i];
$totsgstamt += $newsgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infosgst,2,'.',',').'</span></span>';
?></td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="2">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$tottaxamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totigstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totcgstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totsgstamt,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&($_GET['term']=='drnoteconsumer')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='drnoteconsumer' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairdebitnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Consumer"':'(gstrtype="Consumer" or gstrtype="Registered Business - Regular") and gstno="" ')." and (debitnotedate>='".$_GET['datefrom']."' and debitnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY debitnotedate, debitnoteno order by debitnotedate asc, debitnoteno asc");
$tottaxamt = 0;
$totigstamt = 0;
$totcgstamt = 0;
$totsgstamt = 0;
while($info=mysqli_fetch_array($sql))
{
$tottaxamt += $info['totalamount'];
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
?>
<tr style="vertical-align: middle;"><td data-label="PLACE OF SUPPLY" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$info['vendorname']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color:grey;">Place of Supply : <span style="color: black;"><?=$info['pos']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color:grey;"><?=$infomainaccessuserdebitnote["modulename"]?> Number : <span style="color: black;"><?=$info['debitnoteno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;color:grey;">Amount : <span style="color: black;"><?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['debitnotedate']))?></span></span></td>
<td data-label="<?=$access["txttaxabledebitnote"]?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['totalamount'],2,'.',',')?></span></span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infoigst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics!=$infofranposics)
{
$infoigst += $newgst[$i];
$totigstamt += $newgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infoigst,2,'.',',').'</span></span>';
?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infocgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infocgst += $newcgst[$i];
$totcgstamt += $newcgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infocgst,2,'.',',').'</span></span>';
?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infosgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infosgst += $newsgst[$i];
$totsgstamt += $newsgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infosgst,2,'.',',').'</span></span>';
?></td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="2">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$tottaxamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totigstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totcgstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totsgstamt,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&($_GET['term']=='crnoteregistered')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='crnoteregistered' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (creditnotedate>='".$_GET['datefrom']."' and creditnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY creditnotedate, creditnoteno order by creditnotedate asc, creditnoteno asc");
$tottaxamt = 0;
$totigstamt = 0;
$totcgstamt = 0;
$totsgstamt = 0;
while($info=mysqli_fetch_array($sql))
{
$tottaxamt += $info['totalamount'];
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
?>
<tr style="vertical-align: middle;">
<td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$info['customername']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;">Place of Supply : <span><?=$info['pos']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$infomainaccessusercreditnote["modulename"]?> Number : <?=$info['creditnoteno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span>Amount : <?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="<?=$infomainaccessusercreditnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['creditnotedate']))?></span></span></td>
<td data-label="<?=($access["txttaxablecreditnote"])?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['totalamount'],2,'.',',')?></span></span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infoigst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics!=$infofranposics)
{
$infoigst += $newgst[$i];
$totigstamt += $newgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infoigst,2,'.',',').'</span></span>';
?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infocgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infocgst += $newcgst[$i];
$totcgstamt += $newcgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infocgst,2,'.',',').'</span></span>';
?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infosgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infosgst += $newsgst[$i];
$totsgstamt += $newsgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infosgst,2,'.',',').'</span></span>';
?></td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="2">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$tottaxamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totigstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totcgstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totsgstamt,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&($_GET['term']=='drnoteregistered')) {
$sqlreportview = mysqli_query($con,"select * from pairreports where franchiseid='".$_SESSION['franchisesession']."' and types='drnoteregistered' and createdid='$companymainid'");
$sqlviewreport = mysqli_fetch_array($sqlreportview);
$sql=mysqli_query($con, "select * from pairdebitnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and ".(($sqlviewreport['gstrule']=='0')?'gstrtype="Registered Business - Regular"':'gstrtype="Registered Business - Regular" and gstno!="" ')." and (debitnotedate>='".$_GET['datefrom']."' and debitnotedate<='".$_GET['dateto']."') and cancelstatus='0' GROUP BY debitnotedate, debitnoteno order by debitnotedate asc, debitnoteno asc");
$tottaxamt = 0;
$totigstamt = 0;
$totcgstamt = 0;
$totsgstamt = 0;
while($info=mysqli_fetch_array($sql))
{
$tottaxamt += $info['totalamount'];
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
?>
<tr style="vertical-align: middle;"><td data-label="GSTIN/UIN" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$info['vendorname']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span style="color: royalblue;"><?=$info['gstno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;">Place of Supply : <span><?=$info['pos']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span><?=$infomainaccessuserdebitnote["modulename"]?> Number : <?=$info['debitnoteno']?></span></span>
<br>
<span style="display: inline-flex;max-width: 190px;min-width: 190px;white-space: nowrap;overflow: hidden;"><span>Amount : <?=number_format((float)$info['grandtotal'],2,'.',',')?></span></span></td>
<td data-label="<?=$infomainaccessuserdebitnote["modulename"]?> DATE" style="text-align: left !important;font-size:12px;color:black;border:1px solid #eee;padding-left: 10px;"><span style="display: inline-flex;max-width: 70px;min-width: 70px;white-space: nowrap;overflow: hidden;"><span><?=date($datemainphp,strtotime($info['debitnotedate']))?></span></span></td>
<td data-label="<?=$access["txttaxabledebitnote"]?>" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span><?=number_format((float)$info['totalamount'],2,'.',',')?></span></span></td>
<td data-label="IGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infoigst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics!=$infofranposics)
{
$infoigst += $newgst[$i];
$totigstamt += $newgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infoigst,2,'.',',').'</span></span>';
?></td>
<td data-label="CGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infocgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infocgst += $newcgst[$i];
$totcgstamt += $newcgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infocgst,2,'.',',').'</span></span>';
?></td>
<td data-label="SGST AMOUNT" style="text-align: right !important;font-size:12px;color:black;border:1px solid #eee;padding-right: 10px;"><?php
$infosgst = 0.00;
for ($i=1; $i <count($newtaxes) ; $i++) {
if($infoposics==$infofranposics)
{
$infosgst += $newsgst[$i];
$totsgstamt += $newsgst[$i];
}
}
echo '<span style="display: inline-flex;max-width: 90px;min-width: 90px;white-space: nowrap;overflow: hidden;justify-content: end;"><span>'.number_format((float)$infosgst,2,'.',',').'</span></span>';
?></td>
<!-- <td data-label="CESS AMOUNT " style="text-align: right !important;">0</td> -->
</tr>
<?php
$count++;
}
?>
<tr style="height: 30px;font-weight: bold;">
<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="2">Total</td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$tottaxamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totigstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totcgstamt,2,'.',',')?></td>
<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;"><?=number_format((float)$totsgstamt,2,'.',',')?></td>
</tr>
<?php
}
elseif (isset($_GET['term'])&&$_GET['term']=='timesheet') {
	$sqlreportviews=$con->prepare("SELECT * FROM pairreports WHERE franchiseid=? AND createdid=? AND types='timesheet'");
	$sqlreportviews->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
	$sqlreportviews->execute();
	$sqlreportview = $sqlreportviews->get_result();
	$sqlviewreport=$sqlreportview->fetch_array();
	$sqlreportview->close();
	$sqlreportviews->close();
	//FOR THIS REPORT ROWS AND COLUMNS ON/OFF PREFERENCES

	$anscheck = $sqlviewreport['rowcolumns'];
	$newanscheck = explode(',',$anscheck);

	$sqlinfos=$con->prepare("SELECT * FROM pairtimesheet WHERE franchisesession=? AND createdid=? AND (timesheetdate>=? AND timesheetdate<=?) ORDER BY timesheetdate DESC");
	$sqlinfos->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto']);
	$sqlinfos->execute();
	$sqlinfo = $sqlinfos->get_result();
	$count=1;
	while($info=$sqlinfo->fetch_array()){
		$timestart = strtotime($info['timestart']);
		$timeend = isset($info['timeend']) ? strtotime($info['timeend']) : time();
		$time_difference = $timeend - $timestart;
?>
<tr style="height: 30px;">
	<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=date($datemainphp,strtotime($info['timesheetdate']))?></td>
	<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['projectname']?></td>
	<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['customername']?></td>
	<td style="border: 1px solid #eee;padding-left: 10px;text-align: left;"><?=$info['taskname']?></td>
	<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=$info['username']?></td>
	<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=gmdate('H:i:s', $time_difference)?></td>
	<td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"><?=($info['billable']=='0')?'<span class="text-danger">NOT BILLABLE</span>':'<span class="text-success">BILLABLE</span>'?></td>
</tr>
<?php
		$count++;
	}
}
elseif (isset($_GET['term'])&&$_GET['term']=='stockandsales') {
	$sqlreportviews=$con->prepare("SELECT * FROM pairreports WHERE franchiseid=? AND createdid=? AND types='stockandsales'");
	$sqlreportviews->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
	$sqlreportviews->execute();
	$sqlreportview = $sqlreportviews->get_result();
	$sqlviewreport=$sqlreportview->fetch_array();
	$sqlreportview->close();
	$sqlreportviews->close();
	//FOR THIS REPORT ROWS AND COLUMNS ON/OFF PREFERENCES

	$anscheck = $sqlviewreport['rowcolumns'];
	$newanscheck = explode(',',$anscheck);

	$count = 1;
																						$openingstocktotal = 0;
																						$purchasetotal = 0;
																						$lmstotal = 0;
																						$salestotal = 0;
																						$closingstocktotal = 0;
																						$seldatas = $con->prepare("SELECT DISTINCT id, productname,category FROM pairproducts WHERE franchisesession=? AND createdid=? ".(($sqlviewreport['category']=='all')?' ':'AND category="'.$sqlviewreport['categoryname'].'"')."  ORDER BY category ASC, productname ASC");
																						$seldatas->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
																						$seldatas->execute();
																						$seldata = $seldatas->get_result();
																						while($info=$seldata->fetch_array()){
																							$openingstocksinv = $con->prepare("SELECT SUM(quantity) AS openinginvstock FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND (invoicedate < ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$openingstocksinv->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $info['id']);
																							$openingstocksinv->execute();
																							$openingstockinv = $openingstocksinv->get_result();
																							$openinginvoicestock = 0;
																							if(mysqli_num_rows($openingstockinv)>0){
																								$openinginvstock=$openingstockinv->fetch_array();
																								$openinginvoicestock = $openinginvstock['openinginvstock'];
																							}
																							$openingstocksbill = $con->prepare("SELECT SUM(quantity) AS openingbillstock FROM pairbills WHERE franchisesession = ? AND createdid = ? AND (billdate < ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$openingstocksbill->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $info['id']);
																							$openingstocksbill->execute();
																							$openingstockbill = $openingstocksbill->get_result();
																							$openingbillsstock = 0;
																							if(mysqli_num_rows($openingstockbill)>0){
																								$openingbillstock=$openingstockbill->fetch_array();
																								$openingbillsstock = $openingbillstock['openingbillstock'];
																							}
																							$purchaseqtys = $con->prepare("SELECT 0 AS purchasepacks,SUM(quantity) AS purchaseqty FROM pairbills WHERE franchisesession = ? AND createdid = ? AND (billdate >= ? AND billdate <= ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$purchaseqtys->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id']);
																							$purchaseqtys->execute();
																							$purchaseqty = $purchaseqtys->get_result();
																							$purchaseqtyans = 0;
																							$purchasepacksans = 0;
																							if(mysqli_num_rows($purchaseqty)>0){
																								$purchaseqtyfet=$purchaseqty->fetch_array();
																								$purchaseqtyans = $purchaseqtyfet['purchaseqty'];
																								$purchasepacksans = $purchaseqtyfet['purchasepacks'];
																							}
																							$salesqtys = $con->prepare("SELECT SUM(productnetvalue) AS totalvalue,SUM(productvalue) AS sellingprice,0 AS salespacks,SUM(quantity) AS salesqty FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND (invoicedate >= ? AND invoicedate <= ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$salesqtys->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id']);
																							$salesqtys->execute();
																							$salesqty = $salesqtys->get_result();
																							$salesqtyans = 0;
																							$salespacksans = 0;
																							$sellingpriceans = 0;
																							$totalvalueans = 0;
																							if(mysqli_num_rows($salesqty)>0){
																								$salesqtyfet=$salesqty->fetch_array();
																								$salesqtyans = $salesqtyfet['salesqty'];
																								$salespacksans = $salesqtyfet['salespacks'];
																								$sellingpriceans = $salesqtyfet['sellingprice'];
																								$totalvalueans = $salesqtyfet['totalvalue'];
																							}
																							$adjustqtys = $con->prepare("SELECT SUM(quantity) AS adjustqty FROM pairadjustments WHERE franchisesession = ? AND createdid = ? AND (adjustmentdate >= ? AND adjustmentdate <= ?) AND productid = ? AND cancelstatus = '0' GROUP BY productid");
																							$adjustqtys->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id']);
																							$adjustqtys->execute();
																							$adjustqty = $adjustqtys->get_result();
																							$adjustqtyans = 0;
																							if(mysqli_num_rows($adjustqty)>0){
																								$adjustqtyfet=$adjustqty->fetch_array();
																								$adjustqtyans = $adjustqtyfet['adjustqty'];
																							}
																							$crnoteqtys = $con->prepare("SELECT 0 AS crnotepacks,SUM(quantity) AS crnoteqty FROM paircreditnotes WHERE franchisesession = ? AND createdid = ? AND (creditnotedate >= ? AND creditnotedate <= ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$crnoteqtys->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id']);
																							$crnoteqtys->execute();
																							$crnoteqty = $crnoteqtys->get_result();
																							$crnoteqtyans = 0;
																							$crnotepacksans = 0;
																							if(mysqli_num_rows($crnoteqty)>0){
																								$crnoteqtyfet=$crnoteqty->fetch_array();
																								$crnoteqtyans = $crnoteqtyfet['crnoteqty'];
																								$crnotepacksans = $crnoteqtyfet['crnotepacks'];
																							}
																							$drnoteqtys = $con->prepare("SELECT 0 AS drnotepacks,SUM(quantity) AS drnoteqty FROM pairdebitnotes WHERE franchisesession = ? AND createdid = ? AND (debitnotedate >= ? AND debitnotedate <= ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$drnoteqtys->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id']);
																							$drnoteqtys->execute();
																							$drnoteqty = $drnoteqtys->get_result();
																							$drnoteqtyans = 0;
																							$drnotepacksans = 0;
																							if(mysqli_num_rows($drnoteqty)>0){
																								$drnoteqtyfet=$drnoteqty->fetch_array();
																								$drnoteqtyans = $drnoteqtyfet['drnoteqty'];
																								$drnotepacksans = $drnoteqtyfet['drnotepacks'];
																							}
																							$totalstocksinv = $con->prepare("SELECT SUM(quantity) AS totalinvstock FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$totalstocksinv->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $info['id']);
																							$totalstocksinv->execute();
																							$totalstockinv = $totalstocksinv->get_result();
																							$totalinvoicestock = 0;
																							if(mysqli_num_rows($totalstockinv)>0){
																								$totalinvstock=$totalstockinv->fetch_array();
																								$totalinvoicestock = $totalinvstock['totalinvstock'];
																							}
																							$totalstocksbill = $con->prepare("SELECT SUM(quantity) AS totalbillstock FROM pairbills WHERE franchisesession = ? AND createdid = ? AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$totalstocksbill->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $info['id']);
																							$totalstocksbill->execute();
																							$totalstockbill = $totalstocksbill->get_result();
																							$totalbillsstock = 0;
																							if(mysqli_num_rows($totalstockbill)>0){
																								$totalbillstock=$totalstockbill->fetch_array();
																								$totalbillsstock = $totalbillstock['totalbillstock'];
																							}
																							$lessonemonthfrom = date('Y-m-d', strtotime("".$_GET['datefrom']." -1 month"));
																							$lessonemonthto = date('Y-m-d', strtotime("$lessonemonthfrom +1 month"));
																							$lastmonthsalesdata = $con->prepare("SELECT quantity AS lastmonthsales FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND (invoicedate >= ? AND invoicedate <= ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$lastmonthsalesdata->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $lessonemonthfrom, $lessonemonthto, $info['id']);
																							$lastmonthsalesdata->execute();
																							$lastmonthsalesdatas = $lastmonthsalesdata->get_result();
																							$lastmonthsalesqty = 0;
																							if(mysqli_num_rows($lastmonthsalesdatas)>0){
																								$lastmonthsales=$lastmonthsalesdatas->fetch_array();
																								$lastmonthsalesqty = $lastmonthsales['lastmonthsales'];
																							}
																							$freeqty = $con->prepare("SELECT SUM(freeqty) AS total_freeqty FROM ( SELECT SUM(quantity) AS freeqty FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND invoicedate BETWEEN ? AND ? AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' AND productrate = '0' GROUP BY productid UNION ALL SELECT SUM(quantity) AS freeqty FROM pairbills WHERE franchisesession = ? AND createdid = ? AND billdate BETWEEN ? AND ? AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' AND productrate = '0' GROUP BY productid ) AS combined_result;");
																							$freeqty->bind_param("ssssssssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id'], $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id']);
																							$freeqty->execute();
																							$freeqtys = $freeqty->get_result();
																							$freeqty = 0;
																							if(mysqli_num_rows($freeqtys)>0){
																								$freeqtyqry=$freeqtys->fetch_array();
																								$freeqty = $freeqtyqry['total_freeqty'];
																							}
																							$closingstocksinv = $con->prepare("SELECT SUM(quantity) AS closinginvstock FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND (invoicedate > ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$closingstocksinv->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['dateto'], $info['id']);
																							$closingstocksinv->execute();
																							$closingstockinv = $closingstocksinv->get_result();
																							$closinginvoicestock = 0;
																							if(mysqli_num_rows($closingstockinv)>0){
																								$closinginvstock=$closingstockinv->fetch_array();
																								$closinginvoicestock = $closinginvstock['closinginvstock'];
																							}
																							$closingstocksbill = $con->prepare("SELECT SUM(quantity) AS closingbillstock FROM pairbills WHERE franchisesession = ? AND createdid = ? AND (billdate > ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$closingstocksbill->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['dateto'], $info['id']);
																							$closingstocksbill->execute();
																							$closingstockbill = $closingstocksbill->get_result();
																							$closingbillsstock = 0;
																							if(mysqli_num_rows($closingstockbill)>0){
																								$closingbillstock=$closingstockbill->fetch_array();
																								$closingbillsstock = $closingbillstock['closingbillstock'];
																							}
																							$lastsellingstocksinv = $con->prepare("SELECT vat,productvalue FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND productid = ? AND (invoicedate >= ? AND invoicedate <= ?) ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$lastsellingstocksinv->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['id'], $_GET['datefrom'], $_GET['dateto']);
																							$lastsellingstocksinv->execute();
																							$lastsellingstockinv = $lastsellingstocksinv->get_result();
																							$lastsellinginvoicestock = 0;
																							$gst = 0;
																							if(mysqli_num_rows($lastsellingstockinv)>0){
																								$lastsellinginvstock=$lastsellingstockinv->fetch_array();
																								$lastsellinginvoicestock = $lastsellinginvstock['productvalue'];
																								$gst = $lastsellinginvstock['vat'];
																							}
																							$closingvaluestocksinv = $con->prepare("SELECT SUM(quantity) AS closingvalueinvstock FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND productid = ? AND (invoicedate >= ? AND invoicedate <= ?) ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$closingvaluestocksinv->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['id'], $_GET['datefrom'], $_GET['dateto']);
																							$closingvaluestocksinv->execute();
																							$closingvaluestockinv = $closingvaluestocksinv->get_result();
																							$closingvalueinvoicestock = 0;
																							if(mysqli_num_rows($closingvaluestockinv)>0){
																								$closingvalueinvstock=$closingvaluestockinv->fetch_array();
																								$closingvalueinvoicestock = $closingvalueinvstock['closingvalueinvstock'];
																							}
																							$closingvaluestocksbill = $con->prepare("SELECT SUM(quantity) AS closingvaluebillstock FROM pairbills WHERE franchisesession = ? AND createdid = ? AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND (billdate >= ? AND billdate <= ?) AND cancelstatus = '0' GROUP BY productid");
																							$closingvaluestocksbill->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['id'], $_GET['datefrom'], $_GET['dateto']);
																							$closingvaluestocksbill->execute();
																							$closingvaluestockbill = $closingvaluestocksbill->get_result();
																							$closingvaluebillsstock = 0;
																							if(mysqli_num_rows($closingvaluestockbill)>0){
																								$closingvaluebillstock=$closingvaluestockbill->fetch_array();
																								$closingvaluebillsstock = $closingvaluebillstock['closingvaluebillstock'];
																							}
																							$closingvalueatsellingprice = $closingvaluebillsstock - $closingvalueinvoicestock;
																							$openingstocktotal = $openingbillsstock - $openinginvoicestock * $lastsellinginvoicestock;
																							$purchasetotal = $purchaseqtyans * $lastsellinginvoicestock;
																							$lmstotal = $lastmonthsalesqty * $lastsellinginvoicestock;
																							$salestotal = $salesqtyans * $lastsellinginvoicestock;
																							$closingstocktotal = $totalbillsstock - $totalinvoicestock * $lastsellinginvoicestock;
																					?>
																						<tr style="vertical-align: middle; height: 30px !important;">
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $count ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $info['id'] ?>
																							</td>
																							<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 3px;">
																								<?= $info['productname'] ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $purchasepacksans+$salespacksans+$crnotepacksans+$drnotepacksans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $openingbillsstock - $openinginvoicestock ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $purchaseqtyans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $crnoteqtyans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $totalbillsstock - $totalinvoicestock ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $drnoteqtyans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $lastmonthsalesqty ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $salesqtyans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $freeqty ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $adjustqtyans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $totalbillsstock - $totalinvoicestock ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $sellingpriceans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $closingvalueatsellingprice * $lastsellinginvoicestock ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $gst ?>%
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $totalvalueans ?>
																							</td>
																						</tr>
<?php
		$count++;
	}
																					?>
																					<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td> </tr>
																					<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td> </tr>
																					<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td> </tr>
																						<tr>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-left: 3px;" colspan="3"><span style="font-size:13px;color:black;">Summary</span></td>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-right: 3px;text-align: right !important;" colspan="3"><span style="font-size:13px;color:black;">Opening Stock Value</span></td>
																							<td class="text-uppercase" style="max-border:1px solid #eee;padding-right: 3px;text-align: right !important;" colspan="3"><span style="font-size:13px;color:black;">Purchase</span></td>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-right: 3px;text-align: right !important;" colspan="3"><span style="font-size:13px;color:black;">Last Month Sales Value</span></td>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-right: 3px;text-align: right !important;" colspan="3"><span style="font-size:13px;color:black;">Sales</span></td>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-right: 3px;text-align: right !important;" colspan="3"><span style="font-size:13px;color:black;">Closing Stock Value</span></td>
																						</tr>
																						<tr style="vertical-align: middle; height: 30px !important;">
																							<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 3px;" colspan="3">Goods Value</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;" colspan="3"><?= $openingstocktotal ?></td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;" colspan="3"><?= $purchasetotal ?></td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;" colspan="3"><?= $lmstotal ?></td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;" colspan="3"><?= $salestotal ?></td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;" colspan="3"><?= $closingstocktotal ?></td>
																						</tr>
																					<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td> </tr>
																					<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td> </tr>
																					<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"> </td> </tr>
																						<tr>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-left: 3px;" colspan="6"><span style="font-size:13px;color:black;">Product Name</span></td>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-left: 3px;" colspan="4"><span style="font-size:13px;color:black;">Batch</span></td>
																							<td class="text-uppercase" style="max-border:1px solid #eee;padding-left: 3px;" colspan="4"><span style="font-size:13px;color:black;">Expiry Date</span></td>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-left: 3px;" colspan="4"><span style="font-size:13px;color:black;">Quantity</span></td>
																						</tr>
																						<?php
																							$add6months = date('Y-m-d', strtotime("".$_GET['datefrom']." +6 month"));
																							$expiryproducts = $con->prepare("SELECT pairbatch.productid, pairbatch.productname, pairbatch.quantity, pairbatch.batch, pairbatch.expdate FROM pairbatch JOIN pairproducts ON pairproducts.id = pairbatch.productid AND pairproducts.isactive = '0' WHERE pairbatch.expdate != '' AND pairbatch.createdid = ? AND pairbatch.franchisesession = ? AND pairbatch.quantity >= 1 AND (pairbatch.expdate >= ? AND pairbatch.expdate <= ?) ".(($sqlviewreport['category']=='all')?' ':'AND pairbatch.manufacturer="'.$sqlviewreport['categoryname'].'"')." GROUP BY pairbatch.batch, pairbatch.expdate, pairbatch.productname ORDER BY pairbatch.expdate ASC, pairbatch.quantity DESC");
																							$expiryproducts->bind_param("ssss", $companymainid, $_SESSION["franchisesession"], $_GET['datefrom'], $add6months);
																							$expiryproducts->execute();
																							$expiryresult = $expiryproducts->get_result();
																							if(mysqli_num_rows($expiryresult)>0){
																								$expiryresultans=$expiryresult->fetch_array();
																						?>
																						<tr style="vertical-align: middle; height: 30px !important;">
																							<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 3px;" colspan="6"><?= $expiryresultans['productname'] ?></td>
																							<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 3px;" colspan="4"><?= $expiryresultans['batch'] ?></td>
																							<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 3px;" colspan="4"><?= date('d/m/Y', strtotime($expiryresultans['expdate'])) ?></td>
																							<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 3px;" colspan="4"><?= $expiryresultans['quantity'] ?></td>
																						</tr>
																					<?php
																							}
}
?>