<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE

$sqlismainaccessusercuss=$con->prepare("SELECT * FROM pairmainaccess WHERE franchiseid=? AND moduletype='Customers' ORDER BY id ASC");
$sqlismainaccessusercuss->bind_param("s", $_SESSION['franchisesession']);
$sqlismainaccessusercuss->execute();
$sqlismainaccessusercus = $sqlismainaccessusercuss->get_result();
$infomainaccessusercus=$sqlismainaccessusercus->fetch_array();
$sqlismainaccessusercus->close();
$sqlismainaccessusercuss->close();
//FOR CUSTOMER MODULE INFORMATIONS AND PREFERENCES

$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND grouptype='Reports' ORDER BY id ASC");
$sqlismainaccessusers->bind_param("s", $userid);
$sqlismainaccessusers->execute();
$sqlismainaccessuser = $sqlismainaccessusers->get_result();
$infomainaccessuser=$sqlismainaccessuser->fetch_array();
$sqlismainaccessuser->close();
$sqlismainaccessusers->close();
//FOR REPORT MODULE INFORMATIONS AND PREFERENCES

$sqlismainaccessuserinvs=$con->prepare("SELECT * FROM pairmainaccess WHERE franchiseid=? AND moduletype='Invoices' ORDER BY id ASC");
$sqlismainaccessuserinvs->bind_param("s", $_SESSION['franchisesession']);
$sqlismainaccessuserinvs->execute();
$sqlismainaccessuserinv = $sqlismainaccessuserinvs->get_result();
$infomainaccessuserinv=$sqlismainaccessuserinv->fetch_array();
$sqlismainaccessuserinv->close();
$sqlismainaccessuserinvs->close();
//FOR INVOICE MODULE INFORMATIONS AND PREFERENCES

if((($franchisesrole==''))||((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['groupaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['groupaccess']=='0')||($infomainaccessuser['useraccessview']==0))))) {
  header('Location:dashboard.php');
}
//FOR CHECK THE THIS FILES ACCESSES ARE ALLOW OR NOT

$sqlbranchs=$con->prepare("SELECT * FROM pairfranchises WHERE id=?");
$sqlbranchs->bind_param("i", $_SESSION['franchisesession']);
$sqlbranchs->execute();
$sqlbranch = $sqlbranchs->get_result();
$branch=$sqlbranch->fetch_array();
$sqlbranch->close();
$sqlbranchs->close();
//FOR INVOICE MODULE INFORMATIONS AND PREFERENCES

$sqlreportviews=$con->prepare("SELECT * FROM pairreports WHERE franchiseid=? AND createdid=? AND types='inv'");
$sqlreportviews->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
$sqlreportviews->execute();
$sqlreportview = $sqlreportviews->get_result();
$sqlviewreport=$sqlreportview->fetch_array();
$sqlreportview->close();
$sqlreportviews->close();
//FOR THIS REPORT ROWS AND COLUMNS ON/OFF PREFERENCES

$anscheck = $sqlviewreport['rowcolumns'];
$newans = explode(',',$anscheck);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
	include('externals.php');
?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?= $infomainaccessuser['groupname']; ?> View
	</title>
</head>
<body style="padding: 3px;">
																	<table width="100%" style="text-align: center;font-weight: bold;">
																		<tr>
																			<td width="100%" style="height:10px !important;">
																				<table width="100%" style="text-align: center;font-weight: bold;">
																					<tr>
																						<td style="<?= ($sqlviewreport['companyname']=='1')?'':'display: none;'?>">
																							<?= $branch['franchisename'] ?>
																						</td>
																					</tr>
																					<tr>
																						<td>
																							<?=$infomainaccessuserinv["modulename"]?> List/Details
																						</td>
																					</tr>
																					<tr>
																						<td id="datefromto"><?php
																						$startDate = $_GET['datefrom'];
																						$endDate = $_GET['dateto'];
																						$startTime = $_GET['timefrom'];
																						$endTime = $_GET['timeto'];

																						$start = new DateTime($startDate . ' ' . $startTime);
																						$end = new DateTime($endDate . ' ' . $endTime);

																						$startFormatted = $start->format('d F Y h:i A');
																						$endFormatted = $end->format('d F Y h:i A');

																						echo "From " . $startFormatted . " To " . $endFormatted;
																						?></td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	<?php
																		$datefrom = mysqli_real_escape_string($con, $_GET['datefrom']);
																		$dateto = mysqli_real_escape_string($con, $_GET['dateto']);
																		$timefrom = mysqli_real_escape_string($con, $_GET['timefrom']);
																		$timeto = mysqli_real_escape_string($con, $_GET['timeto']);
																	?>
																		<input type="hidden" name="datefrom" id="datefrom" value="<?= $datefrom ?>">
																		<input type="hidden" name="dateto" id="dateto" value="<?= $dateto ?>">
																		<input type="hidden" name="timefrom" id="timefrom" value="<?= $timefrom ?>">
																		<input type="hidden" name="timeto" id="timeto" value="<?= $timeto ?>">
																		<tr style="height:1px;">
																			<td width="100%" style="padding: 10px;">
																				<table id="print-are1" style="border: 1px solid #eee;" width="100%">
																					<thead style="background-color: #e1e1e1;">
																						<tr>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 50px !important;min-width: 50px !important;white-space: nowrap;overflow: hidden;">
																								<span style="font-size:13px;color:black;"> #</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 7px !important;min-width: 7px !important;white-space: nowrap;overflow: hidden;">
																								<span style="font-size:13px;color:black;"> Status
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 80px !important;min-width: 80px !important;white-space: nowrap;overflow: hidden;">
																								<span style="font-size:13px;color:black;"> Date
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 80px !important;min-width: 80px !important;white-space: nowrap;overflow: hidden;display: none;">
																								<span style="font-size:13px;color:black;"> Payment Days
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 93px !important;min-width: 93px !important;white-space: nowrap;overflow: hidden;">
																								<span style="font-size:13px;color:black;"> Number
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 150px !important;min-width: 150px !important;white-space: nowrap;overflow: hidden;<?=((($sqlviewreport['filtername']=='1')||($sqlviewreport['filtername']=='0'))?'':'display:none;')?>">
																								<span style="font-size:13px;color:black;"> <?=$infomainaccessusercus['modulename']?> Name
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 60px !important;min-width: 60px !important;white-space: nowrap;overflow: hidden;<?=(((in_array('City', $newans)))?'':'display: none;')?>">
																								<span style="font-size:13px;color:black;"> City
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-right: 10px;max-width: 76px !important;min-width: 76px !important;white-space: nowrap;overflow: hidden;text-align: right;">
																								<span style="font-size:13px;color:black;"> Total
																								</span>
																							</td>
																							<td class="text-uppercase" style="<?=(((in_array('Payment Term', $newans)))?'':'display: none;')?>border: 1px solid #eee;padding-left: 10px;max-width: 50px !important;min-width: 50px !important;white-space: nowrap;overflow: hidden;">
																								<span style="font-size:13px;color:black;"> Term
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-right: 10px;max-width: 76px !important;min-width: 76px !important;white-space: nowrap;overflow: hidden;text-align: right;">
																								<span style="font-size:13px;color:black;"> Balance
																								</span>
																							</td>
																						</tr>
																					</thead>
																					<tbody id="myTable">
																					<?php
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
																						$sqlinfos=$con->prepare("SELECT MAX(id) AS id,invoicedate, invoiceno, customername, invoiceterm, duedate, invoiceamount, cancelstatus,grandtotal,city,customerid FROM pairinvoices WHERE franchisesession=? AND createdid=? AND (invoicedate>=? AND invoicedate<=?) AND (invoicetime>=? AND invoicetime<=?) ".(($sqlviewreport['names']=='all')?' ':' AND customerid="'.$sqlviewreport['names'].'"')."".(($sqlviewreport['payterm']=='all')?' ':' AND invoiceterm="'.$sqlviewreport['payterm'].'"')." GROUP BY invoicedate, invoiceno");
										      										$sqlinfos->bind_param("ssssss", $_SESSION['franchisesession'], $companymainid, $datefrom, $dateto, $timefrom, $timeto);
										      										$sqlinfos->execute();
										      										$sqlinfo = $sqlinfos->get_result();
																						$count=1;
																						$invoiceamount=0;
																						$balanceamount=0;
																						$currentamount=0;
																						$overdueamount=0;
																						$crbtotal=0;
																						$inttotal=0;
																						while($info=$sqlinfo->fetch_array()){
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
																					?>
																						<tr style="height: 30px;<?=(($_GET['amttype']=='all')?'':(($currentbalance>0)?'':'display: none;'))?>">
																							<td data-label="#" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;">
																								<?=$count?>
																							</td>
																							<td data-label="Status" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;white-space: normal;">
																							<?php
																								if($info['cancelstatus']=='1'){
																							?>
																								Void
																							<?php
																								}
																								else{
																									if(($currentbalance==0)||($currentbalance<=0)){
																							?>
																								Paid
																							<?php
																									}
																									else{
																										if(($paidamount - $refundamount)<=0){
																							?>
																								Un Paid
																							<?php
																										}
																										else{
																							?>
																								Partially Paid
																							<?php
																										}
																									}
																								}
																								$sqlselcusnames=$con->prepare("SELECT customername FROM paircustomers WHERE id=? ORDER BY customername ASC");
																								$sqlselcusnames->bind_param("i", $info['customerid']);
																								$sqlselcusnames->execute();
																								$sqlselcusname = $sqlselcusnames->get_result();
																								$fetsqlcusname=$sqlselcusname->fetch_array();
																							?>
																							</td>
																							<td data-label="Date" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;">
																								<?=date($datemainphp,strtotime($info['invoicedate']))?>
																							</td>
																							<td data-label="Payment Days" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;display: none;">
																								<?=duedays($info['invoicedate'],$info['duedate'])?>
																							</td>
																							<td data-label="Number" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;color: royalblue;" onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')">
																								<?=$info['invoiceno']?>
																							</td>
																							<td data-label="<?=$infomainaccessusercus['modulename']?> Name" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;<?=((($sqlviewreport['filtername']=='1')||($sqlviewreport['filtername']=='0'))?'':'display:none;')?>" onclick="window.open('customerview.php?id=<?=$info['customerid']?>', '_self')">
																								<span style="font-size:12px;margin: 0px !important;display: inline-flex;color: royalblue;max-width: 150px !important;min-width: 150px !important;">
																									<?=$fetsqlcusname['customername']?>
																								</span>
																							</td>
																							<td data-label="City" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;<?=(((in_array('City', $newans)))?'':'display: none;')?>">
																								<span style="font-size:12px;margin: 0px !important;display: inline-flex;overflow: hidden;white-space: nowrap;max-width: 57px !important;min-width: 57px !important;">
																									<?=$info['city']?>
																								</span>
																							</td>
																							<td data-label="Total" style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;">
																								<?=number_format((float)$info['grandtotal'],2,'.',',')?>
																							</td>
																							<td data-label="Payment Method" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;<?=(((in_array('Payment Term', $newans)))?'':'display: none;')?>">
																								<?=$info['invoiceterm']?>
																							</td>
																							<td data-label="Balance" style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;">
																								<?=number_format((float)$currentbalance,2,'.',',')?>
																							</td>
																						</tr>
																					<?php
																							$count++;
																						}
																						$colspanans = 5;
																						if (in_array('City', $newans)) {
																							$colspanans+=1;
																						}
																					?>
																						<tr style="height: 30px;font-weight: bold;">
																							<td style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;" colspan="<?=$colspanans?>">
																								Total
																							</td>
																							<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;">
																								<?=number_format((float)$inttotal,2,'.',',')?>
																							</td>
																							<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;<?=(((in_array('Payment Term', $newans)))?'':'display: none;')?>"></td>
																							<td style="border: 1px solid #eee;padding-right: 10px;padding-left: 10px;text-align: right;">
																								<?=number_format((float)$crbtotal,2,'.',',')?>
																							</td>
																						</tr>
																					<?php
																						if (mysqli_num_rows($sqlinfo)==0) {
																					?>
																						<div style="text-align: center;position: relative;top: 35px;margin-bottom: -25px;">
																							There are no transactions during the selected date range
																						</div>
																					<?php
																						}
																					?>
																					</tbody>
																				</table>
<?php
	include('fexternals.php');
?>
<script>
$(document).ready(function () {
	window.print();
});
</script>
</body>
</html>