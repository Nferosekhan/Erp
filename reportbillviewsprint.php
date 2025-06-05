<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE

$sqlismainaccessuservens=$con->prepare("SELECT * FROM pairmainaccess WHERE franchiseid=? AND moduletype='Vendors' ORDER BY id ASC");
$sqlismainaccessuservens->bind_param("s", $_SESSION['franchisesession']);
$sqlismainaccessuservens->execute();
$sqlismainaccessuserven = $sqlismainaccessuservens->get_result();
$infomainaccessuserven=$sqlismainaccessuserven->fetch_array();
$sqlismainaccessuserven->close();
$sqlismainaccessuservens->close();
//FOR CUSTOMER MODULE INFORMATIONS AND PREFERENCES

$sqlismainaccessusers=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND grouptype='Reports' ORDER BY id ASC");
$sqlismainaccessusers->bind_param("s", $userid);
$sqlismainaccessusers->execute();
$sqlismainaccessuser = $sqlismainaccessusers->get_result();
$infomainaccessuser=$sqlismainaccessuser->fetch_array();
$sqlismainaccessuser->close();
$sqlismainaccessusers->close();
//FOR REPORT MODULE INFORMATIONS AND PREFERENCES

$sqlismainaccessuserbills=$con->prepare("SELECT * FROM pairmainaccess WHERE franchiseid=? AND moduletype='Bills' ORDER BY id ASC");
$sqlismainaccessuserbills->bind_param("s", $_SESSION['franchisesession']);
$sqlismainaccessuserbills->execute();
$sqlismainaccessuserbill = $sqlismainaccessuserbills->get_result();
$infomainaccessuserbill=$sqlismainaccessuserbill->fetch_array();
$sqlismainaccessuserbill->close();
$sqlismainaccessuserbills->close();
//FOR INVOICE MODULE INFORMATIONS AND PREFERENCES

$sqlbranchs=$con->prepare("SELECT * FROM pairfranchises WHERE id=?");
$sqlbranchs->bind_param("i", $_SESSION['franchisesession']);
$sqlbranchs->execute();
$sqlbranch = $sqlbranchs->get_result();
$branch=$sqlbranch->fetch_array();
$sqlbranch->close();
$sqlbranchs->close();
//FOR INVOICE MODULE INFORMATIONS AND PREFERENCES

$sqlreportviews=$con->prepare("SELECT * FROM pairreports WHERE franchiseid=? AND createdid=? AND types='bill'");
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
	<title>
		<?= $infomainaccessuser['groupname']; ?> View
	</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
																							<?=$infomainaccessuserbill["modulename"]?> List/Details
																						</td>
																					</tr>
																					<tr>
																						<td id="datefromto"><?php
																							$startDate = $_GET['datefrom'];
																							$endDate = $_GET['dateto'];
																							$start = new DateTime($startDate);
																							$end = new DateTime($endDate);
																							$startFormatted = $start->format('d F Y');
																							$endFormatted = $end->format('d F Y');
																							echo "From " . $startFormatted . " To " . $endFormatted;
																						?></td>
																					</tr>
																				</table>
																			</td>
																		</tr>
																	<?php
																		$datefrom = mysqli_real_escape_string($con, $_GET['datefrom']);
																		$dateto = mysqli_real_escape_string($con, $_GET['dateto']);
																	?>
																		<input type="hidden" name="datefrom" id="datefrom" value="<?= $datefrom ?>">
																		<input type="hidden" name="dateto" id="dateto" value="<?= $dateto ?>">
																		<tr style="height:1px;">
																			<td width="100%" style="padding: 10px;">
																				<table id="print-are1" style="border: 1px solid #eee;" width="100%">
																					<thead style="background-color: #e1e1e1;">
																						<tr>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 50px !important;min-width: 50px !important;white-space: nowrap;overflow: hidden;">
																								<span style="font-size:13px;color:black;"> #</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 7px !important;min-width: 7px !important;white-space: nowrap;overflow: hidden;">
																								<span style="font-size:13px;color:black;">
																									Status
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 80px !important;min-width: 80px !important;white-space: nowrap;overflow: hidden;">
																								<span style="font-size:13px;color:black;">
																									Date
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 80px !important;min-width: 80px !important;white-space: nowrap;overflow: hidden;display: none;">
																								<span style="font-size:13px;color:black;">
																									Payment Days
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 93px !important;min-width: 93px !important;white-space: nowrap;overflow: hidden;">
																								<span style="font-size:13px;color:black;">
																									Number
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 150px !important;min-width: 150px !important;white-space: nowrap;overflow: hidden;<?=((($sqlviewreport['filtername']=='1')||($sqlviewreport['filtername']=='0'))?'':'display:none;')?>">
																								<span style="font-size:13px;color:black;">
																										<?=$infomainaccessuserven['modulename']?> Name
																									</span>
																								</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-left: 10px;max-width: 60px !important;min-width: 60px !important;white-space: nowrap;overflow: hidden;<?=(((in_array('City', $newans)))?'':'display: none;')?>">
																								<span style="font-size:13px;color:black;">
																									City
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-right: 10px;max-width: 76px !important;min-width: 76px !important;white-space: nowrap;overflow: hidden;text-align: right;">
																								<span style="font-size:13px;color:black;">
																									Total
																								</span>
																							</td>
																							<td class="text-uppercase" style="<?=(((in_array('Payment Term', $newans)))?'':'display: none;')?>border: 1px solid #eee;padding-left: 10px;max-width: 50px !important;min-width: 50px !important;white-space: nowrap;overflow: hidden;">
																								<span style="font-size:13px;color:black;"> Term
																								</span>
																							</td>
																							<td class="text-uppercase" style="border: 1px solid #eee;padding-right: 10px;max-width: 76px !important;min-width: 76px !important;white-space: nowrap;overflow: hidden;text-align: right;">
																								<span style="font-size:13px;color:black;">
																									Balance
																								</span>
																							</td>
																						</tr>
																					</thead>
																					<tbody id="myTable">
																					<?php
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
																						$sqlinfos=$con->prepare("SELECT MAX(id) AS id,billdate, invnumber, billno, vendorname, billterm, duedate, billamount, cancelstatus,grandtotal,city,vendorid FROM pairbills WHERE franchisesession=? AND createdid=? AND (billdate>=? AND billdate<=?) ".(($sqlviewreport['names']=='all')?' ':' and vendorid="'.$sqlviewreport['names'].'"')."".(($sqlviewreport['payterm']=='all')?' ':' AND billterm="'.$sqlviewreport['payterm'].'"')." GROUP BY billdate, billno");
										      										$sqlinfos->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $datefrom, $dateto);
										      										$sqlinfos->execute();
										      										$sqlinfo = $sqlinfos->get_result();
																						$count=1;
																						$billamount=0;
																						$balanceamount=0;
																						$currentamount=0;
																						$overdueamount=0;
																						$crbtotal=0;
																						$inttotal=0;
																						while($info=$sqlinfo->fetch_array()){
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
																							?>
																							</td>
																							<td data-label="Date" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;">
																								<?=date($datemainphp,strtotime($info['billdate']))?>
																							</td>
																							<td data-label="Payment Days" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;display: none;">
																								<?=duedays($info['billdate'],$info['duedate'])?>
																							</td>
																							<td data-label="Number" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;color: royalblue;" onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')">
																								<?=$info['invnumber']?>
																							</td>
																							<td data-label="<?=$infomainaccessuserven['modulename']?> Name" style="border: 1px solid #eee;padding-left: 10px;padding-right: 10px;font-size: 13px;<?=((($sqlviewreport['filtername']=='1')||($sqlviewreport['filtername']=='0'))?'':'display:none;')?>" onclick="window.open('vendorview.php?id=<?=$info['vendorid']?>', '_self')">
																								<span style="font-size:12px;margin: 0px !important;display: inline-flex;color: royalblue;max-width: 150px !important;min-width: 150px !important;">
																									<?=$info['vendorname']?>
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
																								<?=$info['billterm']?>
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
																							<td style="border: 1px solid #eee;padding-left: 10px;padding-left: 10px;text-align: right;<?=(((in_array('Payment Term', $newans)))?'':'display: none;')?>">
																							</td>
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