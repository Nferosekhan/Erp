<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE

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

$sqlbranchs=$con->prepare("SELECT * FROM pairfranchises WHERE id=?");
$sqlbranchs->bind_param("i", $_SESSION['franchisesession']);
$sqlbranchs->execute();
$sqlbranch = $sqlbranchs->get_result();
$branch=$sqlbranch->fetch_array();
$sqlbranch->close();
$sqlbranchs->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Stock And Sales Report</title>
<?php
	include('externals.php');
?>
</head>
<body style="padding: 3px;">
																	<?php
																		$datefrom = mysqli_real_escape_string($con, $_GET['datefrom']);
																		$dateto = mysqli_real_escape_string($con, $_GET['dateto']);
																	?>
																				<table width="100%" style="text-align: center;font-weight: bold;">
																					<tr>
																						<td style="<?= ($sqlviewreport['companyname']=='1')?'':'display: none;'?>">
																							<?= $branch['franchisename'] ?>
																						</td>
																					</tr>
																					<tr>
																						<td>
																							Stock And Sales Statement
																						</td>
																					</tr>
																					<tr>
																						<td>
																							<?=(($sqlviewreport['category']=='all')?'All':$sqlviewreport['categoryname'])?>
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
<table id="print-are1" style="border: 1px solid #eee;" width="100%">
	<thead>
		<tr>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					S.No
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Pro ID
				</span>
			</td>
			<td class="text-uppercase" style="max-width:3%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Product
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Pack
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Opening Stock
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Purchase Qty
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Sales Return Qty
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Total Stock
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Purchase Return Qty
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Last Month Sales Qty
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Sales Qty
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Free Qty
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Adjust Qty
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Closing Stock
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Selling Price
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Closing Value at Selling Price
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					GST
				</span>
			</td>
			<td class="text-uppercase" style="width:5%;border:1px solid #eee;padding-left: 3px;">
				<span style="font-size:13px;color:black;">
					Total Value
				</span>
			</td>
		</tr>
	</thead>
	<tbody id="myTable">
	<?php
																						$count = 1;
																						$openingstocktotal = 0;
																						$purchasetotal = 0;
																						$lmstotal = 0;
																						$salestotal = 0;
																						$closingstocktotal = 0;
																						$seldatas = $con->prepare("SELECT DISTINCT id, productname,category,oldclosingstock,salepriceold,purchasepriceold,lastqty,lastprice FROM pairproducts WHERE franchisesession=? AND createdid=? ".(($sqlviewreport['category']=='all')?' ':'AND category="'.$sqlviewreport['categoryname'].'"')."  ORDER BY category ASC, productname ASC");
																						$seldatas->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
																						$seldatas->execute();
																						$seldata = $seldatas->get_result();
																						while($info=$seldata->fetch_array()){
																							$totalallstocksinv = $con->prepare("SELECT sum(quantity) as totalallinvstock FROM pairbatch where createdid=? and franchisesession=? and productid=? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')."");
																							$totalallstocksinv->bind_param("sss", $companymainid, $_SESSION['franchisesession'], $info['id']);
																							$totalallstocksinv->execute();
																							$totalallstockinv = $totalallstocksinv->get_result();
																							$totalallinvoicestock = 0;
																							if(mysqli_num_rows($totalallstockinv)>0){
																								$totalallinvstock=$totalallstockinv->fetch_array();
																								$totalallinvoicestock = $totalallinvstock['totalallinvstock'];
																							}
																							$openingstocksadj = $con->prepare("SELECT SUM(quantity) AS openingadjstock FROM pairadjustments WHERE franchisesession = ? AND createdid = ? AND (adjustmentdate < ?) AND productid = ? AND cancelstatus = '0' GROUP BY productid");
																							$openingstocksadj->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $info['id']);
																							$openingstocksadj->execute();
																							$openingstockadj = $openingstocksadj->get_result();
																							$openingadjsstock = 0;
																							if(mysqli_num_rows($openingstockadj)>0){
																								$openingadjstock=$openingstockadj->fetch_array();
																								$openingadjsstock = $openingadjstock['openingadjstock'];
																							}
																							$openingstocksinv = $con->prepare("SELECT SUM(quantity) AS openinginvstock FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND (invoicedate < ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$openingstocksinv->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $info['id']);
																							$openingstocksinv->execute();
																							$openingstockinv = $openingstocksinv->get_result();
																							$openinginvoicestock = 0;
																							if(mysqli_num_rows($openingstockinv)>0){
																								$openinginvstock=$openingstockinv->fetch_array();
																								$openinginvoicestock = $openinginvstock['openinginvstock'];
																							}
																							$openingstockscn = $con->prepare("SELECT SUM(quantity) AS openingcnstock FROM paircreditnotes WHERE franchisesession = ? AND createdid = ? AND (creditnotedate < ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$openingstockscn->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $info['id']);
																							$openingstockscn->execute();
																							$openingstockcn = $openingstockscn->get_result();
																							$openingcnsstock = 0;
																							if(mysqli_num_rows($openingstockcn)>0){
																								$openingcnstock=$openingstockcn->fetch_array();
																								$openingcnsstock = $openingcnstock['openingcnstock'];
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
																							$openingstocksdn = $con->prepare("SELECT SUM(quantity) AS openingdnstock FROM pairdebitnotes WHERE franchisesession = ? AND createdid = ? AND (debitnotedate < ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$openingstocksdn->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $info['id']);
																							$openingstocksdn->execute();
																							$openingstockdn = $openingstocksdn->get_result();
																							$openingdnsstock = 0;
																							if(mysqli_num_rows($openingstockdn)>0){
																								$openingdnstock=$openingstockdn->fetch_array();
																								$openingdnsstock = $openingdnstock['openingdnstock'];
																							}
																							$purchaseqtys = $con->prepare("SELECT 0 AS purchasepacks,SUM(quantity) AS purchaseqty,SUM(productrate) AS totprorate,SUM(prodiscount) AS totprodis,SUM(productvalue) AS totprovalues FROM pairbills WHERE franchisesession = ? AND createdid = ? AND (billdate >= ? AND billdate <= ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$purchaseqtys->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id']);
																							$purchaseqtys->execute();
																							$purchaseqty = $purchaseqtys->get_result();
																							$purchaseqtyans = 0;
																							$purchasepacksans = 0;
																							$gstvalans = 0;
																							$purchasesellingpriceans = 0;
																							$purtotprovalues = 0;
																							if(mysqli_num_rows($purchaseqty)>0){
																								$purchaseqtyfet=$purchaseqty->fetch_array();
																								$purchaseqtyans = $purchaseqtyfet['purchaseqty'];
																								$purchasepacksans = $purchaseqtyfet['purchasepacks'];
																								$totprodisans = $purchaseqtyfet['totprorate'] - $purchaseqtyfet['totprodis'];
																								$purtotprovalues = $purchaseqtyfet['totprovalues'];
																								$purchasesellingpriceans = $purchaseqtyfet['totprovalues'];
																							}
																							$salesqtys = $con->prepare("SELECT SUM(productnetvalue) AS totalvalue,SUM(productvalue) AS sellingprice,0 AS salespacks,SUM(quantity) AS salesqty,SUM(productvalue) AS totprovalues FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND (invoicedate >= ? AND invoicedate <= ?) AND productvalue!=0 AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$salesqtys->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id']);
																							$salesqtys->execute();
																							$salesqty = $salesqtys->get_result();
																							$salesqtyans = 0;
																							$salespacksans = 0;
																							$salesellingpriceans = 0;
																							$totalvalueans = 0;
																							$sellingtotprovalues = 0;
																							if(mysqli_num_rows($salesqty)>0){
																								$salesqtyfet=$salesqty->fetch_array();
																								$salesqtyans = $salesqtyfet['salesqty'];
																								$salespacksans = $salesqtyfet['salespacks'];
																								$salesellingpriceans = $salesqtyfet['sellingprice'];
																								$totalvalueans = $salesqtyfet['totalvalue'];
																								$sellingtotprovalues = $salesqtyfet['totprovalues'];
																							}
																							if ($_GET['commision']=='0') {
																								$sellingpriceans = $salesellingpriceans;
																							}
																							else{
																								$sellingpriceans = $purchasesellingpriceans+(($_GET['commision']*$purchasesellingpriceans)/100);
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
																							$crnoteqtys = $con->prepare("SELECT 0 AS crnotepacks,SUM(quantity) AS crnoteqty,SUM(productvalue) AS totprovalues FROM paircreditnotes WHERE franchisesession = ? AND createdid = ? AND (creditnotedate >= ? AND creditnotedate <= ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$crnoteqtys->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id']);
																							$crnoteqtys->execute();
																							$crnoteqty = $crnoteqtys->get_result();
																							$crnoteqtyans = 0;
																							$crnotepacksans = 0;
																							$cntotprovalues = 0;
																							if(mysqli_num_rows($crnoteqty)>0){
																								$crnoteqtyfet=$crnoteqty->fetch_array();
																								$crnoteqtyans = $crnoteqtyfet['crnoteqty'];
																								$crnotepacksans = $crnoteqtyfet['crnotepacks'];
																								$cntotprovalues = $crnoteqtyfet['totprovalues'];
																							}
																							$drnoteqtys = $con->prepare("SELECT 0 AS drnotepacks,SUM(quantity) AS drnoteqty,SUM(productvalue) AS totprovalues FROM pairdebitnotes WHERE franchisesession = ? AND createdid = ? AND (debitnotedate >= ? AND debitnotedate <= ?) AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$drnoteqtys->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $_GET['datefrom'], $_GET['dateto'], $info['id']);
																							$drnoteqtys->execute();
																							$drnoteqty = $drnoteqtys->get_result();
																							$drnoteqtyans = 0;
																							$drnotepacksans = 0;
																							$dntotprovalues = 0;
																							if(mysqli_num_rows($drnoteqty)>0){
																								$drnoteqtyfet=$drnoteqty->fetch_array();
																								$drnoteqtyans = $drnoteqtyfet['drnoteqty'];
																								$drnotepacksans = $drnoteqtyfet['drnotepacks'];
																								$dntotprovalues = $drnoteqtyfet['totprovalues'];
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
																							$lessonemonthfrom = date('Y-m-01', strtotime("".$_GET['datefrom']."  -1 months"));
																							$lessonemonthto = date('Y-m-t', strtotime($lessonemonthfrom));
																							$lastmonthsalesdata = $con->prepare("SELECT SUM(quantity) AS lastmonthsales,productrate FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND (invoicedate >= ? AND invoicedate <= ?) AND productid = ? AND productvalue!=0 ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$lastmonthsalesdata->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $lessonemonthfrom, $lessonemonthto, $info['id']);
																							$lastmonthsalesdata->execute();
																							$lastmonthsalesdatas = $lastmonthsalesdata->get_result();
																							$lastmonthsalesqty = 0;
																							$lastmonthsalesprices = 0;
																							if(mysqli_num_rows($lastmonthsalesdatas)>0){
																								$lastmonthsales=$lastmonthsalesdatas->fetch_array();
																								$lastmonthsalesqty = $lastmonthsales['lastmonthsales'];
																								$lastmonthsalesprices = $lastmonthsales['productrate'];
																							}
																							$freeqty = $con->prepare("SELECT SUM(freeqty) AS total_freeqty FROM ( SELECT SUM(quantity) AS freeqty FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND invoicedate BETWEEN ? AND ? AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' AND productvalue = '0' GROUP BY productid UNION ALL SELECT SUM(quantity) AS freeqty FROM pairbills WHERE franchisesession = ? AND createdid = ? AND billdate BETWEEN ? AND ? AND productid = ? ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' AND productvalue = '0' GROUP BY productid ) AS combined_result;");
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
																							$lastsellingstocksinv = $con->prepare("SELECT vat,productrate FROM pairbills WHERE franchisesession = ? AND createdid = ? AND productid = ? AND (billdate >= ? AND billdate <= ?) ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$lastsellingstocksinv->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['id'], $lessonemonthfrom, $lessonemonthto);
																							$lastsellingstocksinv->execute();
																							$lastsellingstockinv = $lastsellingstocksinv->get_result();
																							$lastsellinginvoicestock = 0;
																							$gst = 0;
																							if(mysqli_num_rows($lastsellingstockinv)>0){
																								$lastsellinginvstock=$lastsellingstockinv->fetch_array();
																								$lastsellinginvoicestock = $lastsellinginvstock['productrate'];
																								$gst = $lastsellinginvstock['vat'];
																							}
																							$presentsellingstocksinv = $con->prepare("SELECT vat,productrate FROM pairbills WHERE franchisesession = ? AND createdid = ? AND productid = ? AND (billdate >= ? AND billdate <= ?) ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$presentsellingstocksinv->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['id'], $_GET['datefrom'], $_GET['dateto']);
																							$presentsellingstocksinv->execute();
																							$presentsellingstockinv = $presentsellingstocksinv->get_result();
																							$presentsellinginvoicestock = 0;
																							if(mysqli_num_rows($presentsellingstockinv)>0){
																								$presentsellinginvstock=$presentsellingstockinv->fetch_array();
																								$presentsellinginvoicestock = $presentsellinginvstock['productrate'];
																							}
																							$lastsellingstocksbill = $con->prepare("SELECT vat,productrate FROM pairinvoices WHERE franchisesession = ? AND createdid = ? AND productid = ? AND (invoicedate >= ? AND invoicedate <= ?) ".(($sqlviewreport['category']=='all')?' ':'AND manufacturer="'.$sqlviewreport['categoryname'].'"')." AND cancelstatus = '0' GROUP BY productid");
																							$lastsellingstocksbill->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['id'], $_GET['datefrom'], $_GET['dateto']);
																							$lastsellingstocksbill->execute();
																							$lastsellingstockbill = $lastsellingstocksbill->get_result();
																							$lastsellingsalesinvoicestock = 0;
																							if(mysqli_num_rows($lastsellingstockbill)>0){
																								$lastsellingbillstock=$lastsellingstockbill->fetch_array();
																								$lastsellingsalesinvoicestock = $lastsellingbillstock['productrate'];
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
																							$sqlstocktotal=mysqli_query($con,"SELECT id, batch, expdate, productrate, mrp, noofpacks, sum(quantity) as total, mrp, vat FROM pairbatch where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='".$info['id']."'");
																							$infostocktotal=mysqli_fetch_array($sqlstocktotal);
																							$totstockforopen = (($infostocktotal['total']!='')?$infostocktotal['total']:0);
																							$openingstocktotans = ($info['oldclosingstock']) + (($openingcnsstock + $openingbillsstock) - (0 + $openinginvoicestock + $openingdnsstock));
																							if(($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0)<=0){
																								$sellingpriceans = 0;
																							}
																							$openingstocktotal += $openingstocktotans * ($info['purchasepriceold']);
																							$purchasetotal += $purchaseqtyans * $presentsellinginvoicestock;
																							$lmstotal += ($info['lastqty']) * ($info['lastprice']);
																							$salestotal += $salesqtyans * $lastsellingsalesinvoicestock;
																							$closingstocktotal += (($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0)) * ($info['purchasepriceold']);
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
																								<?= $openingstocktotans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $purchaseqtyans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $crnoteqtyans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $openingstocktotans + $purchaseqtyans + $crnoteqtyans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $drnoteqtyans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $info['lastqty'] ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $salesqtyans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $freeqty ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								0
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= ($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0) ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= $sellingpriceans ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= (((($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0)) * (($sellingpriceans))<=0)?0:(($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0)) * (($sellingpriceans))) ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= (((((($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0)) * (($sellingpriceans))*$gst)/100)<=0)?0:(((($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0)) * (($sellingpriceans))*$gst)/100)) ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;">
																								<?= (((($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0)) * (($sellingpriceans)) + (((($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0)) * (($sellingpriceans))*$gst)/100)<=0)?0:(($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0)) * (($sellingpriceans)) + (((($openingstocktotans + $purchaseqtyans + $crnoteqtyans) - ($salesqtyans + $drnoteqtyans + 0)) * (($sellingpriceans))*$gst)/100)) ?>
																							</td>
																						</tr>
																					<?php
																							$count++;
																						}
																					?>
																					<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td> </tr>
																					<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td> </tr>
																					<tr style="vertical-align: middle; height: 30px !important;">  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td>  <td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 10px;"></td> </tr>
																						<tr>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-left: 3px;" colspan="3">
																								<span style="font-size:13px;color:black;">
																									Summary
																								</span>
																							</td>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-left: 3px;" colspan="3">
																								<span style="font-size:13px;color:black;">
																									Opening Stock Value
																								</span>
																							</td>
																							<td class="text-uppercase" style="max-border:1px solid #eee;padding-right: 3px;text-align: right !important;" colspan="3">
																								<span style="font-size:13px;color:black;">
																									Purchase
																								</span>
																							</td>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-right: 3px;text-align: right !important;" colspan="3">
																								<span style="font-size:13px;color:black;">
																									Last Month Sales Value
																								</span>
																							</td>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-right: 3px;text-align: right !important;" colspan="3">
																								<span style="font-size:13px;color:black;">
																									Sales
																								</span>
																							</td>
																							<td class="text-uppercase" style="border:1px solid #eee;padding-right: 3px;text-align: right !important;" colspan="3">
																								<span style="font-size:13px;color:black;">
																									Closing Stock Value
																								</span>
																							</td>
																						</tr>
																						<tr style="vertical-align: middle; height: 30px !important;">
																							<td style="text-align: left !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-left: 3px;" colspan="3">
																								Goods Value
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;" colspan="3">
																								<?= $openingstocktotal ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;" colspan="3">
																								<?= $purchasetotal ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;" colspan="3">
																								<?= $lmstotal ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;" colspan="3">
																								<?= $salestotal ?>
																							</td>
																							<td style="text-align: right !important; font-size:12px; color:black; border:1px solid #eee; white-space: nowrap; overflow: hidden; padding-right: 3px;" colspan="3">
																								<?= $closingstocktotal ?>
																							</td>
																						</tr>
																					<?php
																						// }
																						if (mysqli_num_rows($seldata)==0) {
																					?>
		<div style="text-align: center;position: relative;top: 99px;margin-bottom: -25px;">
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