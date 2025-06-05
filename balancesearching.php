<?php
if ((isset($_GET['term']))&&($_GET['term']=='customer')&&(isset($_GET['id']))) {
	include 'lcheck.php';
	$id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
	header('Content-Type: application/json');
	$invoiceamount = $balanceamount = $currentamount = $overdueamount = $advanceamount = 0;
	$sqliinvoice = mysqli_query($con, "SELECT pi.invoiceamount, pi.invoicedate, pi.invoiceno, IFNULL(SUM(psp.amount), 0) as paidamount FROM pairinvoices pi LEFT JOIN pairsalespayhistory psp ON pi.invoiceno = psp.invoiceno AND pi.invoicedate = psp.invoicedate AND pi.customerid = psp.customerid AND pi.franchisesession = psp.franchisesession WHERE pi.franchisesession = '".$_SESSION['franchisesession']."' AND pi.createdid = '$companymainid' AND pi.customerid = '$id' GROUP BY pi.invoicedate, pi.invoiceno ORDER BY pi.invoicedate DESC, pi.invoiceno DESC");
	while ($infoinvoice = mysqli_fetch_assoc($sqliinvoice)) {
		$invoiceamount += (float) $infoinvoice['invoiceamount'];
		$paidamount = (float) $infoinvoice['paidamount'];
		$outstanding = $infoinvoice['invoiceamount'] - $paidamount;
		$balanceamount += $outstanding;
		$days = floor((time() - strtotime($infoinvoice['invoicedate'])) / (60 * 60 * 24));
		if ($days > 30) {
			$overdueamount += $outstanding;
		}
		else {
			$currentamount += $outstanding;
		}
		$sqlsants = mysqli_query($con, "SELECT grandtotal, creditnotedate, creditnoteno FROM paircreditnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='$companymainid' AND customerid='$id' AND invoiceno='".$infoinvoice['invoiceno']."' AND invoicedate='".$infoinvoice['invoicedate']."'ORDER BY creditnotedate ASC, creditnoteno ASC");
		while ($infoantss = mysqli_fetch_assoc($sqlsants)) {
			$balanceamount -= (float) $infoantss['grandtotal'];
			$sqlcrpays = $con->prepare("SELECT IFNULL(SUM(amount), 0) as paidamountcr FROM paircreditnotepayhistory WHERE franchisesession=? AND createdid=? AND creditnoteno=? AND creditnotedate=?");
			$sqlcrpays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $infoantss['creditnoteno'], $infoantss['creditnotedate']);
			$sqlcrpays->execute();
			$sqlcrpay = $sqlcrpays->get_result()->fetch_assoc();
			$balanceamount += (float) $sqlcrpay['paidamountcr'];
		}
	}
	$advanceamount = (float) mysqli_fetch_assoc(mysqli_query($con, "SELECT IFNULL(SUM(amount), 0) as total_advance FROM pairsalespayments WHERE module='advance' AND customerid='$id' AND createdid='$companymainid' AND franchisesession='".$_SESSION['franchisesession']."'"))['total_advance'];
	if ($balanceamount < 0) {
		$advanceamount += (-1 * $balanceamount);
		$balanceamount = 0;
	}
	echo json_encode([
		'balanceamount' => $balanceamount,
		'advanceamount' => $advanceamount
	]);
}
elseif ((isset($_GET['term']))&&($_GET['term']=='vendor')&&(isset($_GET['id']))) {
	include 'lcheck.php';
	$id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
	header('Content-Type: application/json');
	$billamount = $balanceamount = $currentamount = $overdueamount = $advanceamount = 0;
	$sqlibill = mysqli_query($con, "SELECT pi.billamount, pi.billdate, pi.billno, IFNULL(SUM(psp.amount), 0) as paidamount FROM pairbills pi LEFT JOIN pairpurchasepayhistory psp ON pi.billno = psp.billno AND pi.billdate = psp.billdate AND pi.vendorid = psp.vendorid AND pi.franchisesession = psp.franchisesession WHERE pi.franchisesession = '".$_SESSION['franchisesession']."' AND pi.createdid = '$companymainid' AND pi.vendorid = '$id' GROUP BY pi.billdate, pi.billno ORDER BY pi.billdate DESC, pi.billno DESC");
	while ($infobill = mysqli_fetch_assoc($sqlibill)) {
		$billamount += (float) $infobill['billamount'];
		$paidamount = (float) $infobill['paidamount'];
		$outstanding = $infobill['billamount'] - $paidamount;
		$balanceamount += $outstanding;
		$days = floor((time() - strtotime($infobill['billdate'])) / (60 * 60 * 24));
		if ($days > 30) {
			$overdueamount += $outstanding;
		}
		else {
			$currentamount += $outstanding;
		}
		$sqlsants = mysqli_query($con, "SELECT grandtotal, debitnotedate, debitnoteno FROM pairdebitnotes WHERE franchisesession='".$_SESSION['franchisesession']."' AND createdid='$companymainid' AND vendorid='$id' AND billno='".$infobill['billno']."' AND billdate='".$infobill['billdate']."'ORDER BY debitnotedate ASC, debitnoteno ASC");
		while ($infoantss = mysqli_fetch_assoc($sqlsants)) {
			$balanceamount -= (float) $infoantss['grandtotal'];
			$sqlcrpays = $con->prepare("SELECT IFNULL(SUM(amount), 0) as paidamountcr FROM pairdebitnotepayhistory WHERE franchisesession=? AND createdid=? AND debitnoteno=? AND debitnotedate=?");
			$sqlcrpays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $infoantss['debitnoteno'], $infoantss['debitnotedate']);
			$sqlcrpays->execute();
			$sqlcrpay = $sqlcrpays->get_result()->fetch_assoc();
			$balanceamount += (float) $sqlcrpay['paidamountcr'];
		}
	}
	$advanceamount = (float) mysqli_fetch_assoc(mysqli_query($con, "SELECT IFNULL(SUM(amount), 0) as total_advance FROM pairpurchasepayments WHERE module='advance' AND vendorid='$id' AND createdid='$companymainid' AND franchisesession='".$_SESSION['franchisesession']."'"))['total_advance'];
	if ($balanceamount < 0) {
		$advanceamount += (-1 * $balanceamount);
		$balanceamount = 0;
	}
	echo json_encode([
		'balanceamount' => $balanceamount,
		'advanceamount' => $advanceamount
	]);
}
else{
	echo json_encode([
		'balanceamount' => 0,
		'advanceamount' => 0
	]);
}
?>