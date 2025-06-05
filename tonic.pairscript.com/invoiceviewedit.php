<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE
if((isset($_POST['submit']))&&(isset($_POST['validinvoiceno']))&&(isset($_POST['validinvoicedate']))&&(isset($_POST['salesid']))){
	$invoicedate = htmlspecialchars( $_POST['validinvoicedate'], ENT_QUOTES, 'UTF-8');
	$invoiceno = htmlspecialchars( $_POST['validinvoiceno'], ENT_QUOTES, 'UTF-8');
	$customerid = htmlspecialchars( $_POST['customerid'], ENT_QUOTES, 'UTF-8');
	$customername = htmlspecialchars( $_POST['customername'], ENT_QUOTES, 'UTF-8');
	$grandtotal = htmlspecialchars( $_POST['validinvoiceamount'], ENT_QUOTES, 'UTF-8');
	$cashreceived = htmlspecialchars( (($_POST['cashreceived']!='')?$_POST['cashreceived']:0), ENT_QUOTES, 'UTF-8');
	$cardreceived = htmlspecialchars( (($_POST['cardreceived']!='')?$_POST['cardreceived']:0), ENT_QUOTES, 'UTF-8');
	$gpayreceived = htmlspecialchars( (($_POST['gpayreceived']!='')?$_POST['gpayreceived']:0), ENT_QUOTES, 'UTF-8');
	$validpaidamount = htmlspecialchars( (($_POST['validinvoiceamount']!='')?$_POST['validinvoiceamount']:0), ENT_QUOTES, 'UTF-8');
	if($access['definvpay']=='split'){
		$invoiceterm = 'CASH,CARD,GPAY';
	}
	else{
		$invoiceterm = htmlspecialchars($_POST['invoiceterm'], ENT_QUOTES, 'UTF-8');
	}
	$salesid = htmlspecialchars( $_POST['salesid'], ENT_QUOTES, 'UTF-8');
	for($i=0; $i<count($_POST['productnetvalue']); $i++){
		$productnetvalue=htmlspecialchars( $_POST['productnetvalue'][$i], ENT_QUOTES, 'UTF-8');
		if($invoiceterm=='CASH'){
			$sqlismodulespublicnamemanuals=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Manual Journals' ORDER BY id ASC");
			$sqlismodulespublicnamemanuals->execute();
			$sqlismodulespublicnamemanual = $sqlismodulespublicnamemanuals->get_result();
			$infomodulespublicnamemanual=$sqlismodulespublicnamemanual->fetch_array();

			$sqlismainaccesspublicnamemanuals=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Manual Journals' AND franchiseid=? ORDER BY id ASC");
			$sqlismainaccesspublicnamemanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
			$sqlismainaccesspublicnamemanuals->execute();
			$sqlismainaccesspublicnamemanual = $sqlismainaccesspublicnamemanuals->get_result();
			$infomainaccesspublicnamemanual=$sqlismainaccesspublicnamemanual->fetch_array();

			$publicsqlmanuals=$con->prepare("SELECT count(publicid) FROM pairledgers WHERE createdid=? AND type='ledger'");
			$publicsqlmanuals->bind_param("i", $companymainid);
			$publicsqlmanuals->execute();
			$publicsqlmanual = $publicsqlmanuals->get_result();
			$publicansmanual=$publicsqlmanual->fetch_array();

			$oldcodepublicmanual=$publicansmanual[0];
			$publicsqlmanual->close();
			$publicsqlmanuals->close();
			$publicidmanual=$infomodulespublicnamemanual['publiccolumn'] . intval($oldcodepublicmanual)+1;

			$privatesqlmanuals=$con->prepare("SELECT count(privateid) FROM pairledgers WHERE createdid=? AND franchisesession=? AND type='ledger'");
			$privatesqlmanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
			$privatesqlmanuals->execute();
			$privatesqlmanual = $privatesqlmanuals->get_result();
			$privateansmanual=$privatesqlmanual->fetch_array();

			$oldcodeprivatemanual=$privateansmanual[0];
			$privatesqlmanual->close();
			$privatesqlmanuals->close();
			$privateidmanual=$infomainaccesspublicnamemanual['moduleprefix'] . intval($infomainaccesspublicnamemanual['modulesuffix'])+1;

			$sqlismainaccesspublicnamemanual->close();
			$sqlismainaccesspublicnamemanuals->close();

			$sqlismodulespublicnamemanual->close();
			$sqlismodulespublicnamemanuals->close();

			$sqlaccdefaultpettycashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Petty Cash'");
			$sqlaccdefaultpettycashpays->execute();
			$sqlaccdefaultpettycashpay = $sqlaccdefaultpettycashpays->get_result();
			$fetaccdefaultpettycashpay=$sqlaccdefaultpettycashpay->fetch_array();

			$defaccountnamepettycashpay=$fetaccdefaultpettycashpay['accountname'];
			$defaccountidpettycashpay=$fetaccdefaultpettycashpay['id'];

			$sqlaccdefaultpettycashpay->close();
			$sqlaccdefaultpettycashpays->close();

			$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice payment')");
			$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepettycashpay, $defaccountidpettycashpay, $customerid, $customername, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
			$sqlaccinspay->execute();
			$sqlaccinspay->close();
			$sqlaccdefaultcashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Receivable'");
			$sqlaccdefaultcashpays->execute();
			$sqlaccdefaultcashpay = $sqlaccdefaultcashpays->get_result();
			$fetaccdefaultcashpay=$sqlaccdefaultcashpay->fetch_array();

			$defaccountnamepay=$fetaccdefaultcashpay['accountname'];
			$defaccountidpay=$fetaccdefaultcashpay['id'];

			$sqlaccdefaultcashpay->close();
			$sqlaccdefaultcashpays->close();

			$sqlaccdefaultpay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice payment')");
			$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepay, $defaccountidpay, $customerid, $customername, $productnetvalue, $productnetvalue, $grandtotal, $publicidmanual, $privateidmanual);
			$sqlaccdefaultpay->execute();
			$sqlaccdefaultpay->close();
		//FOR INSERT THE MANUAL JOURNAL
		}
		elseif($invoiceterm=='CASH,CARD,GPAY'){
			$sqlismodulespublicnamemanuals=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Manual Journals' ORDER BY id ASC");
			$sqlismodulespublicnamemanuals->execute();
			$sqlismodulespublicnamemanual = $sqlismodulespublicnamemanuals->get_result();
			$infomodulespublicnamemanual=$sqlismodulespublicnamemanual->fetch_array();

			$sqlismainaccesspublicnamemanuals=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Manual Journals' AND franchiseid=? ORDER BY id ASC");
			$sqlismainaccesspublicnamemanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
			$sqlismainaccesspublicnamemanuals->execute();
			$sqlismainaccesspublicnamemanual = $sqlismainaccesspublicnamemanuals->get_result();
			$infomainaccesspublicnamemanual=$sqlismainaccesspublicnamemanual->fetch_array();

			$publicsqlmanuals=$con->prepare("SELECT count(publicid) FROM pairledgers WHERE createdid=? AND type='ledger'");
			$publicsqlmanuals->bind_param("i", $companymainid);
			$publicsqlmanuals->execute();
			$publicsqlmanual = $publicsqlmanuals->get_result();
			$publicansmanual=$publicsqlmanual->fetch_array();

			$oldcodepublicmanual=$publicansmanual[0];
			$publicsqlmanual->close();
			$publicsqlmanuals->close();
			$publicidmanual=$infomodulespublicnamemanual['publiccolumn'] . intval($oldcodepublicmanual)+1;

			$privatesqlmanuals=$con->prepare("SELECT count(privateid) FROM pairledgers WHERE createdid=? AND franchisesession=? AND type='ledger'");
			$privatesqlmanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
			$privatesqlmanuals->execute();
			$privatesqlmanual = $privatesqlmanuals->get_result();
			$privateansmanual=$privatesqlmanual->fetch_array();

			$oldcodeprivatemanual=$privateansmanual[0];
			$privatesqlmanual->close();
			$privatesqlmanuals->close();
			$privateidmanual=$infomainaccesspublicnamemanual['moduleprefix'] . intval($infomainaccesspublicnamemanual['modulesuffix'])+1;

			$sqlismainaccesspublicnamemanual->close();
			$sqlismainaccesspublicnamemanuals->close();

			$sqlismodulespublicnamemanual->close();
			$sqlismodulespublicnamemanuals->close();
			if ($cashreceived>0) {
				$sqlaccdefaultpettycashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Petty Cash'");
				$sqlaccdefaultpettycashpays->execute();
				$sqlaccdefaultpettycashpay = $sqlaccdefaultpettycashpays->get_result();
				$fetaccdefaultpettycashpay=$sqlaccdefaultpettycashpay->fetch_array();

				$defaccountnamepettycashpay=$fetaccdefaultpettycashpay['accountname'];
				$defaccountidpettycashpay=$fetaccdefaultpettycashpay['id'];

				$sqlaccdefaultpettycashpay->close();
				$sqlaccdefaultpettycashpays->close();

				$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice payment')");
				$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepettycashpay, $defaccountidpettycashpay, $customerid, $customername, $cashreceived, $cashreceived, $grandtotal, $publicidmanual, $privateidmanual);
				$sqlaccinspay->execute();
				$sqlaccinspay->close();
				$sqlaccdefaultcashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Receivable'");
				$sqlaccdefaultcashpays->execute();
				$sqlaccdefaultcashpay = $sqlaccdefaultcashpays->get_result();
				$fetaccdefaultcashpay=$sqlaccdefaultcashpay->fetch_array();

				$defaccountnamepay=$fetaccdefaultcashpay['accountname'];
				$defaccountidpay=$fetaccdefaultcashpay['id'];

				$sqlaccdefaultcashpay->close();
				$sqlaccdefaultcashpays->close();

				$sqlaccdefaultpay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice payment')");
				$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepay, $defaccountidpay, $customerid, $customername, $cashreceived, $cashreceived, $grandtotal, $publicidmanual, $privateidmanual);
				$sqlaccdefaultpay->execute();
				$sqlaccdefaultpay->close();
			}
			if ($cardreceived>0) {
				$sqlaccdefaultpettycashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Petty Cash'");
				$sqlaccdefaultpettycashpays->execute();
				$sqlaccdefaultpettycashpay = $sqlaccdefaultpettycashpays->get_result();
				$fetaccdefaultpettycashpay=$sqlaccdefaultpettycashpay->fetch_array();

				$defaccountnamepettycashpay=$fetaccdefaultpettycashpay['accountname'].'(CARD)';
				$defaccountidpettycashpay=$fetaccdefaultpettycashpay['id'];

				$sqlaccdefaultpettycashpay->close();
				$sqlaccdefaultpettycashpays->close();

				$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice payment')");
				$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepettycashpay, $defaccountidpettycashpay, $customerid, $customername, $cardreceived, $cardreceived, $grandtotal, $publicidmanual, $privateidmanual);
				$sqlaccinspay->execute();
				$sqlaccinspay->close();
				$sqlaccdefaultcashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Receivable'");
				$sqlaccdefaultcashpays->execute();
				$sqlaccdefaultcashpay = $sqlaccdefaultcashpays->get_result();
				$fetaccdefaultcashpay=$sqlaccdefaultcashpay->fetch_array();

				$defaccountnamepay=$fetaccdefaultcashpay['accountname'];
				$defaccountidpay=$fetaccdefaultcashpay['id'];

				$sqlaccdefaultcashpay->close();
				$sqlaccdefaultcashpays->close();

				$sqlaccdefaultpay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice payment')");
				$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepay, $defaccountidpay, $customerid, $customername, $cardreceived, $cardreceived, $grandtotal, $publicidmanual, $privateidmanual);
				$sqlaccdefaultpay->execute();
				$sqlaccdefaultpay->close();
			}
			if ($gpayreceived>0) {
				$sqlaccdefaultpettycashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Petty Cash'");
				$sqlaccdefaultpettycashpays->execute();
				$sqlaccdefaultpettycashpay = $sqlaccdefaultpettycashpays->get_result();
				$fetaccdefaultpettycashpay=$sqlaccdefaultpettycashpay->fetch_array();

				$defaccountnamepettycashpay=$fetaccdefaultpettycashpay['accountname'].'(GPAY)';
				$defaccountidpettycashpay=$fetaccdefaultpettycashpay['id'];

				$sqlaccdefaultpettycashpay->close();
				$sqlaccdefaultpettycashpays->close();

				$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice payment')");
				$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepettycashpay, $defaccountidpettycashpay, $customerid, $customername, $gpayreceived, $gpayreceived, $grandtotal, $publicidmanual, $privateidmanual);
				$sqlaccinspay->execute();
				$sqlaccinspay->close();
				$sqlaccdefaultcashpays=$con->prepare("SELECT accountname,id FROM pairchartaccountings WHERE accountname='Accounts Receivable'");
				$sqlaccdefaultcashpays->execute();
				$sqlaccdefaultcashpay = $sqlaccdefaultcashpays->get_result();
				$fetaccdefaultcashpay=$sqlaccdefaultcashpay->fetch_array();

				$defaccountnamepay=$fetaccdefaultcashpay['accountname'];
				$defaccountidpay=$fetaccdefaultcashpay['id'];

				$sqlaccdefaultcashpay->close();
				$sqlaccdefaultcashpays->close();

				$sqlaccdefaultpay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', ?, '0', '0', ?, ?, 'invoice payment')");
				$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $invoicedate, $invoiceno, $defaccountnamepay, $defaccountidpay, $customerid, $customername, $gpayreceived, $gpayreceived, $grandtotal, $publicidmanual, $privateidmanual);
				$sqlaccdefaultpay->execute();
				$sqlaccdefaultpay->close();
			}
		//FOR INSERT THE MANUAL JOURNAL
		}
		else{
			$sqlismodulespublicnamemanuals=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Manual Journals' ORDER BY id ASC");
			$sqlismodulespublicnamemanuals->execute();
			$sqlismodulespublicnamemanual = $sqlismodulespublicnamemanuals->get_result();
			$infomodulespublicnamemanual=$sqlismodulespublicnamemanual->fetch_array();

			$sqlismainaccesspublicnamemanuals=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Manual Journals' AND franchiseid=? ORDER BY id ASC");
			$sqlismainaccesspublicnamemanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
			$sqlismainaccesspublicnamemanuals->execute();
			$sqlismainaccesspublicnamemanual = $sqlismainaccesspublicnamemanuals->get_result();
			$infomainaccesspublicnamemanual=$sqlismainaccesspublicnamemanual->fetch_array();

			$publicsqlmanuals=$con->prepare("SELECT count(publicid) FROM pairledgers WHERE createdid=? AND type='ledger'");
			$publicsqlmanuals->bind_param("i", $companymainid);
			$publicsqlmanuals->execute();
			$publicsqlmanual = $publicsqlmanuals->get_result();
			$publicansmanual=$publicsqlmanual->fetch_array();

			$oldcodepublicmanual=$publicansmanual[0];
			$publicsqlmanual->close();
			$publicsqlmanuals->close();
			$publicidmanual=$infomodulespublicnamemanual['publiccolumn'] . intval($oldcodepublicmanual)+1;

			$privatesqlmanuals=$con->prepare("SELECT count(privateid) FROM pairledgers WHERE createdid=? AND franchisesession=? AND type='ledger'");
			$privatesqlmanuals->bind_param("ii", $companymainid, $_SESSION['franchisesession']);
			$privatesqlmanuals->execute();
			$privatesqlmanual = $privatesqlmanuals->get_result();
			$privateansmanual=$privatesqlmanual->fetch_array();

			$oldcodeprivatemanual=$privateansmanual[0];
			$privatesqlmanual->close();
			$privatesqlmanuals->close();
			$privateidmanual=$infomainaccesspublicnamemanual['moduleprefix'] . intval($infomainaccesspublicnamemanual['modulesuffix'])+1;

			$sqlismainaccesspublicnamemanual->close();
			$sqlismainaccesspublicnamemanuals->close();

			$sqlismodulespublicnamemanual->close();
			$sqlismodulespublicnamemanuals->close();
		//FOR INSERT THE MANUAL JOURNAL
		}
	}
				if(($invoiceterm=='CASH')){
					if ($validpaidamount!=0) {
						$sqlismodulespublicnames=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Payments Received' ORDER BY id ASC");
						$sqlismodulespublicnames->execute();
						$sqlismodulespublicname = $sqlismodulespublicnames->get_result();
						$infomodulespublicname=$sqlismodulespublicname->fetch_array();

						$sqlismainaccesspublicnames=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Payments Received' AND franchiseid=? ORDER BY id ASC");
						$sqlismainaccesspublicnames->bind_param("ii", $companymainid, $_SESSION["franchisesession"]);
						$sqlismainaccesspublicnames->execute();
						$sqlismainaccesspublicname = $sqlismainaccesspublicnames->get_result();
						$infomainaccesspublicname=$sqlismainaccesspublicname->fetch_array();

						$publicsqls=$con->prepare("SELECT count(publicid) FROM pairsalespayments WHERE createdid=?");
						$publicsqls->bind_param("s", $companymainid);
						$publicsqls->execute();
						$publicsql = $publicsqls->get_result();
						$publicans=$publicsql->fetch_array();

						$oldcodepublic=$publicans[0];
						$publicsql->close();
						$publicsqls->close();
						$publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;

						$privatesqls=$con->prepare("SELECT count(privateid) FROM pairsalespayments WHERE createdid=? AND franchisesession=?");
						$privatesqls->bind_param("ss", $companymainid, $_SESSION["franchisesession"]);
						$privatesqls->execute();
						$privatesql = $privatesqls->get_result();
						$privateans=$privatesql->fetch_array();

						$oldcodeprivate=$privateans[0];
						$privatesql->close();
						$privatesqls->close();
						$privatecode=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;

						$sqlismainaccesspublicname->close();
						$sqlismainaccesspublicnames->close();

						$sqlismodulespublicname->close();
						$sqlismodulespublicnames->close();

						$sqlselects=$con->prepare("SELECT id FROM pairsalespayments WHERE receiptno=? AND receiptdate=?");
						$sqlselects->bind_param("ss", $invoiceno, $invoicedate);
						$sqlselects->execute();
						// $sqlselects->store_result();

						if ($sqlselects->num_rows==0) {
							$sqlselectsql = $sqlselects->get_result();
							$sqlselect=$sqlselectsql->fetch_array();
							$sqlsalepayins = $con->prepare("INSERT INTO pairsalespayments (createdid,createdby,franchisesession,createdon,term,type,customername,customerid,receiptno,receiptdate,amount,paymentmode,notes,publicid,privateid) VALUES (?, ?, ?, ?, 'RECEIPT', 'invoice', ?, ?, ?, ?, ?, ?, '-', ?, ?)");
							$sqlsalepayins->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $customername, $customerid, $invoiceno, $invoicedate, $validpaidamount, $invoiceterm, $publiccode, $privatecode);
							$sqlsalepayins->execute();
							if($sqlsalepayins){
								$sqlsalepayins->close();
								$paymentid=$con->insert_id;
								$sqle = $con->prepare("INSERT INTO pairsalespayhistory (createdid,createdby,franchisesession,createdon,paymentid,customerid,invoiceno,invoicedate,amount,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'invoice')");
								$sqle->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $paymentid, $customerid, $invoiceno, $invoicedate, $validpaidamount);
								$sqle->execute();
								$sqle->close();
							}
							//FOR INSERT THE PAYMENT DETAILS
						}
						else{
							$sqlbatchupd = $con->prepare("UPDATE pairsalespayments SET createdid=?, createdby=?, franchisesession=?, createdon=?,  term='RECEIPT', type='invoice', customername=?, customerid=?, receiptno=?, receiptdate=?, amount=?, paymentmode=?, notes='-' WHERE receiptno=? AND receiptdate=?");
							$sqlbatchupd->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $customername, $customerid, $invoiceno, $invoicedate, $validpaidamount, $invoiceterm, $invoiceno, $invoicedate);
							$sqlbatchupd->execute();
							if($sqlbatchupd){
								$sqlbatchupd->close();
								$sqle = $con->prepare("UPDATE pairsalespayhistory SET amount=? WHERE invoiceno=? AND invoicedate=? AND type='invoice'");
								$sqle->bind_param("sss", $validpaidamount, $invoiceno, $invoicedate);
								$sqle->execute();
								$sqle->close();
							}
							//FOR UPDATE THE PAYMENT DETAILS
						}
						$sqlselects->close();
					}
					else{
						$sqlbatchupdant = $con->prepare("UPDATE pairsalespayments SET createdid=?, createdby=?, franchisesession=?, createdon=?,  term='RECEIPT', type='invoice', customername=?, customerid=?, receiptno=?, receiptdate=?, amount=?, paymentmode=?, notes='-' WHERE receiptno=? AND receiptdate=?");
						$sqlbatchupdant->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $customername, $customerid, $invoiceno, $invoicedate, $validpaidamount, $invoiceterm, $invoiceno, $invoicedate);
						$sqlbatchupdant->execute();
						if($sqlbatchupdant){
							$sqlbatchupdant->close();
							$sqleant = $con->prepare("UPDATE pairsalespayhistory SET amount=? WHERE invoiceno=? AND invoicedate=? AND type='invoice'");
							$sqleant->bind_param("sss", $validpaidamount, $invoiceno, $invoicedate);
							$sqleant->execute();
							$sqleant->close();
						}
						//FOR UPDATE THE PAYMENT DETAILS HISTORY
					}
					if($validpaidamount==$grandtotal){
						$sqler = $con->prepare("UPDATE pairinvoices SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='1' WHERE invoiceno=? AND invoicedate=? AND customerid=? AND franchisesession=? AND createdid=?");
	    				$sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $invoiceno, $invoicedate, $customerid, $_SESSION['franchisesession'], $companymainid);
	    				$sqler->execute();
						$sqler->close();
						//FOR UPDATE THE PAYMENT STATUS PAID
					}
					else{
						$sqler = $con->prepare("UPDATE pairinvoices SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='2' WHERE invoiceno=? AND invoicedate=? AND customerid=? AND franchisesession=? AND createdid=?");
	    				$sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $invoiceno, $invoicedate, $customerid, $_SESSION['franchisesession'], $companymainid);
	    				$sqler->execute();
						$sqler->close();
						//FOR UPDATE THE PAYMENT STATUS UNPAID
					}
				}
				if(($invoiceterm=='CASH,CARD,GPAY')){
					$invarr = [$cashreceived,$cardreceived,$gpayreceived];
					for($termrun = 0;$termrun<count(explode(',', $invoiceterm));$termrun++){
						if ($invarr[$termrun]>0) {
							$sqlismodulespublicnames=$con->prepare("SELECT * FROM pairmodules WHERE moduletype='Payments Received' ORDER BY id ASC");
							$sqlismodulespublicnames->execute();
							$sqlismodulespublicname = $sqlismodulespublicnames->get_result();
							$infomodulespublicname=$sqlismodulespublicname->fetch_array();

							$sqlismainaccesspublicnames=$con->prepare("SELECT * FROM pairmainaccess WHERE createdid=? AND moduletype='Payments Received' AND franchiseid=? ORDER BY id ASC");
							$sqlismainaccesspublicnames->bind_param("ii", $companymainid, $_SESSION["franchisesession"]);
							$sqlismainaccesspublicnames->execute();
							$sqlismainaccesspublicname = $sqlismainaccesspublicnames->get_result();
							$infomainaccesspublicname=$sqlismainaccesspublicname->fetch_array();

							$publicsqls=$con->prepare("SELECT count(publicid) FROM pairsalespayments WHERE createdid=?");
							$publicsqls->bind_param("s", $companymainid);
							$publicsqls->execute();
							$publicsql = $publicsqls->get_result();
							$publicans=$publicsql->fetch_array();

							$oldcodepublic=$publicans[0];
							$publicsql->close();
							$publicsqls->close();
							$publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;

							$privatesqls=$con->prepare("SELECT count(privateid) FROM pairsalespayments WHERE createdid=? AND franchisesession=?");
							$privatesqls->bind_param("ss", $companymainid, $_SESSION["franchisesession"]);
							$privatesqls->execute();
							$privatesql = $privatesqls->get_result();
							$privateans=$privatesql->fetch_array();

							$oldcodeprivate=$privateans[0];
							$privatesql->close();
							$privatesqls->close();
							$privatecode=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;

							$sqlismainaccesspublicname->close();
							$sqlismainaccesspublicnames->close();

							$sqlismodulespublicname->close();
							$sqlismodulespublicnames->close();

							$sqlselects=$con->prepare("SELECT id FROM pairsalespayments WHERE receiptno=? AND receiptdate=?");
							$sqlselects->bind_param("ss", $invoiceno, $invoicedate);
							$sqlselects->execute();
							// $sqlselects->store_result();

							if ($sqlselects->num_rows==0) {
								$sqlselectsql = $sqlselects->get_result();
								$sqlselect=$sqlselectsql->fetch_array();
								$sqlsalepayins = $con->prepare("INSERT INTO pairsalespayments (createdid,createdby,franchisesession,createdon,term,type,customername,customerid,receiptno,receiptdate,amount,paymentmode,notes,publicid,privateid) VALUES (?, ?, ?, ?, 'RECEIPT', 'invoice', ?, ?, ?, ?, ?, ?, '-', ?, ?)");
								$sqlsalepayins->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $customername, $customerid, $invoiceno, $invoicedate, $invarr[$termrun], explode(',', $invoiceterm)[$termrun], $publiccode, $privatecode);
								$sqlsalepayins->execute();
								if($sqlsalepayins){
									$sqlsalepayins->close();
									$paymentid=$con->insert_id;
									$sqle = $con->prepare("INSERT INTO pairsalespayhistory (createdid,createdby,franchisesession,createdon,paymentid,customerid,invoiceno,invoicedate,amount,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'invoice')");
									$sqle->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $paymentid, $customerid, $invoiceno, $invoicedate, $invarr[$termrun]);
									$sqle->execute();
									$sqle->close();
								}
								//FOR INSERT THE PAYMENT DETAILS
							}
							else{
								$sqlbatchupd = $con->prepare("UPDATE pairsalespayments SET createdid=?, createdby=?, franchisesession=?, createdon=?,  term='RECEIPT', type='invoice', customername=?, customerid=?, receiptno=?, receiptdate=?, amount=?, paymentmode=?, notes='-' WHERE receiptno=? AND receiptdate=?");
								$sqlbatchupd->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $customername, $customerid, $invoiceno, $invoicedate, $invarr[$termrun], explode(',', $invoiceterm)[$termrun], $invoiceno, $invoicedate);
								$sqlbatchupd->execute();
								if($sqlbatchupd){
									$sqlbatchupd->close();
									$sqle = $con->prepare("UPDATE pairsalespayhistory SET amount=? WHERE invoiceno=? AND invoicedate=? AND type='invoice'");
									$sqle->bind_param("sss", $invarr[$termrun], $invoiceno, $invoicedate);
									$sqle->execute();
									$sqle->close();
								}
								//FOR UPDATE THE PAYMENT DETAILS
							}
							$sqlselects->close();
						}
						else{
							$publicsqlsdel=$con->prepare("SELECT id FROM pairsalespayments WHERE receiptno=? AND receiptdate=? AND paymentmode=?");
							$publicsqlsdel->bind_param("sss", $invoiceno, $invoicedate, explode(',', $invoiceterm)[$termrun]);
							$publicsqlsdel->execute();
							$publicsqldel = $publicsqlsdel->get_result();
							if($publicsqldel->num_rows > 0){
								$publicansdel=$publicsqldel->fetch_array();
								$paymentidfordelete = $publicansdel['id'];
								$publicsqldel->close();
								$publicsqlsdel->close();
								$sqls = $con->prepare("DELETE FROM pairsalespayments WHERE receiptno=? AND receiptdate=? AND paymentmode=?");
								$sqls->bind_param("sss", $invoiceno, $invoicedate, explode(',', $invoiceterm)[$termrun]);
								$sqls->execute();
								$sqls->close();
								$sqlsant = $con->prepare("DELETE FROM pairsalespayhistory WHERE invoiceno=? AND invoicedate=? AND type='invoice' AND paymentid=?");
								$sqlsant->bind_param("sss", $invoiceno, $invoicedate, $paymentidfordelete);
								$sqlsant->execute();
								$sqlsant->close();
								// $sqlbatchupdant = $con->prepare("UPDATE pairsalespayments SET createdid=?, createdby=?, franchisesession=?, createdon=?,  term='RECEIPT', type='invoice', customername=?, customerid=?, receiptno=?, receiptdate=?, amount=?, paymentmode=?, notes='-' WHERE receiptno=? AND receiptdate=?");
								// $sqlbatchupdant->bind_param("ssssssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $customername, $customerid, $invoiceno, $invoicedate, $invarr[$termrun], explode(',', $invoiceterm)[$termrun], $invoiceno, $invoicedate);
								// $sqlbatchupdant->execute();
								// if($sqlbatchupdant){
								// 	$sqlbatchupdant->close();
								// 	$sqleant = $con->prepare("UPDATE pairsalespayhistory SET amount=? WHERE invoiceno=? AND invoicedate=? AND type='invoice'");
								// 	$sqleant->bind_param("sss", $invarr[$termrun], $invoiceno, $invoicedate);
								// 	$sqleant->execute();
								// 	$sqleant->close();
								// }
								//FOR UPDATE THE PAYMENT DETAILS HISTORY
							}
						}
					}
					if($validpaidamount==$grandtotal){
						$sqler = $con->prepare("UPDATE pairinvoices SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='1' WHERE invoiceno=? AND invoicedate=? AND customerid=? AND franchisesession=? AND createdid=?");
	    				$sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $invoiceno, $invoicedate, $customerid, $_SESSION['franchisesession'], $companymainid);
	    				$sqler->execute();
						$sqler->close();
						//FOR UPDATE THE PAYMENT STATUS PAID
					}
				}
				elseif($invoiceterm=='CREDIT'){
					$sqls = $con->prepare("DELETE FROM pairsalespayments WHERE receiptno=? AND receiptdate=?");
					$sqls->bind_param("ss", $invoiceno, $invoicedate);
					$sqls->execute();
					$sqls->close();
					$sqlsant = $con->prepare("DELETE FROM pairsalespayhistory WHERE invoiceno=? AND invoicedate=? AND type='invoice'");
					$sqlsant->bind_param("ss", $invoiceno, $invoicedate);
					$sqlsant->execute();
					$sqlsant->close();
					$sqler = $con->prepare("UPDATE pairinvoices SET createdid=?, createdby=?, franchisesession=?, createdon=?, paidstatus='2' WHERE invoiceno=? AND invoicedate=? AND customerid=? AND franchisesession=? AND createdid=?");
	    			$sqler->bind_param("sssssssss", $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $createdon, $invoiceno, $invoicedate, $customerid, $_SESSION['franchisesession'], $companymainid);
	    			$sqler->execute();
					$sqler->close();
					//FOR UPDATE THE PAYMENT STATUS UNPAID
					$sqldelledgerpay = $con->prepare("DELETE FROM pairledgers WHERE createdid=? AND franchisesession=? AND ledgerno=? AND ledgerdate=? AND type='invoice payment'");
					$sqldelledgerpay->bind_param("ssss", $companymainid, $_SESSION["franchisesession"], $invoiceno, $invoicedate);
					$sqldelledgerpay->execute();
				}
	// }
	if($sql){
		$sqlreceived = $con->prepare("UPDATE pairinvoices SET invoiceterm=?, cashreceived=?, cardreceived=?, gpayreceived=? WHERE invoiceno=? AND invoicedate=? AND customerid=? AND franchisesession=? AND createdid=?");
		$sqlreceived->bind_param("sssssssss", $invoiceterm, $cashreceived, $cardreceived, $gpayreceived, $invoiceno, $invoicedate, $customerid, $_SESSION['franchisesession'], $companymainid);
		$sqlreceived->execute();
		$sqlreceived->close();
		$sqliinvoices=$con->prepare("SELECT invoiceamount, invoicedate, invoiceno FROM pairinvoices WHERE franchisesession=? AND createdid=? AND customerid=? GROUP BY invoicedate, invoiceno ORDER BY invoicedate DESC, invoiceno DESC");
		$sqliinvoices->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $customerid);
		$sqliinvoices->execute();
		$invoiceamount=0;
		$balanceamount=0;
		$currentamount=0;
		$overdueamount=0;
		$sqliinvoice = $sqliinvoices->get_result();
		while($infoinvoice=$sqliinvoice->fetch_array()){
			$invoiceamount+=(float)$infoinvoice['invoiceamount'];
			$paidamount=0;
			$sqlsalespays=$con->prepare("SELECT amount FROM pairsalespayhistory WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? AND customerid=? ORDER BY id DESC");
			$sqlsalespays->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $infoinvoice['invoiceno'], $infoinvoice['invoicedate'], $customerid);
			$sqlsalespays->execute();
			$sqlsalespay = $sqlsalespays->get_result();
			while($infosalespay=$sqlsalespay->fetch_array()){
				$paidamount+=(float)$infosalespay['amount'];
			}
			$balanceamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
			$diff = abs(time() - strtotime($infoinvoice['invoicedate']));
			$days = floor(($diff)/ (60*60*24));
			if($days>30){
				$overdueamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
			}
			else{
				$currentamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
			}
		}
		$sqlicreditnotes=$con->prepare("SELECT creditnoteamount, creditnotedate, creditnoteno FROM paircreditnotes WHERE franchisesession=? AND createdid=? AND customerid=? GROUP BY creditnotedate, creditnoteno ORDER BY creditnotedate DESC, creditnoteno DESC");
		$sqlicreditnotes->bind_param("sss", $_SESSION['franchisesession'], $companymainid, $customerid);
		$sqlicreditnotes->execute();
		$sqlicreditnote = $sqlicreditnotes->get_result();
		while($infocreditnote=$sqlicreditnote->fetch_array()){
			$invoiceamount+=(float)$infocreditnote['creditnoteamount'];
			$paidamount=0;
			$sqlsalespays=$con->prepare("SELECT amount FROM paircreditnotepayhistory WHERE franchisesession=? AND createdid=? AND creditnoteno=? AND creditnotedate=? AND customerid=? ORDER BY id ASC");
			$sqlsalespays->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $infocreditnote['creditnoteno'], $infocreditnote['creditnotedate'], $customerid);
			$sqlsalespays->execute();
			$sqlsalespay = $sqlsalespays->get_result();
			while($infosalespay=$sqlsalespay->fetch_array()){
				$paidamount+=(float)$infosalespay['amount'];
			}
			$balanceamount+=((float)$infocreditnote['creditnoteamount']-$paidamount);
			$diff = abs(time() - strtotime($infocreditnote['creditnotedate']));
			$days = floor(($diff)/ (60*60*24));
			if($days>30){
				$overdueamount+=((float)$infocreditnote['creditnoteamount']-$paidamount);
			}
			else{
				$currentamount+=((float)$infocreditnote['creditnoteamount']-$paidamount);
			}
			$sqlsalespay->close();
			$sqlsalespays->close();
		}
		$sqlicreditnote->close();
		$sqlicreditnotes->close();
		$cussqlup = $con->prepare("UPDATE paircustomers SET invoiceamount=?,balanceamount=?,currentamount=?,overdueamount=? WHERE id=?");
		$cussqlup->bind_param("sssss", $invoiceamount, $balanceamount, $currentamount, $overdueamount, $customerid);
		$cussqlup->execute();
		$cussqlup->close();
		if(isset($_POST['submit1'])){
			echo '<script> window.open("invoiceprint.php?invoiceno='.$invoiceno.'&invoicedate='.$invoicedate.'", "_blank");</script>';
			echo '<script> window.location.href="invoices.php?remarks=Updated Successfully";</script>'; 
		}
		else{
			echo '<script> window.location.href="invoiceview.php?id='.$salesid.'&invoiceno='.$invoiceno.'&invoicedate='.$invoicedate.'&remarks=Updated Successfully";</script>';
		}
	}
	//FOR CUSTOMER BALANCE UPDATION DETAILS
}
else{
	header("Location: invoices.php?error=Error Data");
}
?>