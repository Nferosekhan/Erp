<?php
include('lcheck.php');
$sqlismainaccessusercus=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
$infomainaccessusercus=mysqli_fetch_array($sqlismainaccessusercus);
$sqlismainaccessinvoice=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Invoices' order by id  asc");
$infomainaccessinvoice=mysqli_fetch_array($sqlismainaccessinvoice);
date_default_timezone_set('Asia/Calcutta');
$createdon=date('Y-m-d H:i:s');
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$datefor = 'd/m/Y';
}
$term = mysqli_real_escape_string($con,$_POST['term']);
$receiptno = mysqli_real_escape_string($con,$_POST['receiptno']);
$customername= mysqli_real_escape_string($con,$_POST['customername']);
$selcusname = mysqli_query($con,"select customername from paircustomers where id='$customername'");
$fetcusname = mysqli_fetch_array($selcusname);
$hiscusname = mysqli_real_escape_string($con,$fetcusname['customername']);
//$accountcategory= mysqli_real_escape_string($con,$_POST['accountcategory']);
$customerid = mysqli_real_escape_string($con,$_POST['customerid']);
$receiptdate = mysqli_real_escape_string($con,$_POST['receiptdate']);
$amount = (float)mysqli_real_escape_string($con,$_POST['amount']);
$paymentmode = mysqli_real_escape_string($con,$_POST['paymentmode']);
$notes = mysqli_real_escape_string($con,$_POST['notes']);
$no=mysqli_real_escape_string($con, $_POST["no"]);
$date=mysqli_real_escape_string($con, $_POST["date"]);
$type=mysqli_real_escape_string($con, $_POST["type"]);
$publiccodes=mysqli_real_escape_string($con, $_POST['publiccode']);
$privatecodes=mysqli_real_escape_string($con, $_POST['privatecode']);
$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Payments Received' order by id  asc");
$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Payments Received' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
$publicsql=mysqli_query($con,"select count(publicid) from pairsalespayments where createdid='$companymainid'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publiccode=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;
$privatesql=mysqli_query($con,"select count(privateid) from pairsalespayments where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privatecode=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;
$ordering = $oldcodeprivate+1;
if($type!='')
{
	$labelname=strtoupper($type);
	$nocolumn=$type.'no';
	$datecolumn=$type.'date';
	$tabname='pair'.$type.'s';
}
else
{
	$type='invoice';
	$labelname=strtoupper($type);
	$nocolumn=$type.'no';
	$datecolumn=$type.'date';
	$tabname='pair'.$type.'s';
}

if(isset($_POST['edit']))
{
$sqlismainaccesspublicnamecheck=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Payments Received' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicnamecheck=mysqli_fetch_array($sqlismainaccesspublicnamecheck);
$privatesqlcheck=mysqli_query($con,"select count(privateid) from pairsalespayments where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
$privateanscheck=mysqli_fetch_array($privatesqlcheck);
$oldcodeprivatecheck=$privateanscheck[0];
$privatecodecheck=$infomainaccesspublicnamecheck['moduleprefix'] . $oldcodeprivatecheck;
$selforch=0;
if ($privatecodecheck==$privatecodes) {
for($i=0; $i<count($_POST['nos']); $i++)
{
// $paymentid=$id;
$nosss=$_POST['nos'][$i];
$datesss=$_POST['dates'][$i];

$sqldelacc=mysqli_query($con,"delete from pairledgers where createdid='$companymainid' AND franchisesession='".$_SESSION['franchisesession']."' AND ledgerno='$nosss' AND ledgerdate='$datesss' AND type='invoice payment'");

$selforsel = mysqli_query($con,"select id from pairsalespayhistory where customerid='$customerid' and invoiceno='$nosss' and invoicedate='$datesss'");
$selforfet = mysqli_fetch_array($selforsel);
if (mysqli_num_rows($selforsel)>0) {
$selforch=10;
}
}
}
// if ($selforch==0) {
$id = mysqli_real_escape_string($con,$_POST['id']);

$sqlhis=mysqli_query($con,"select * from pairsalespayments where id='$id'");
$sqlhisans=mysqli_fetch_array($sqlhis);
$oldreceiptno = mysqli_real_escape_string($con,$sqlhisans['receiptno']);
$oldcustomername= mysqli_real_escape_string($con,$sqlhisans['customername']); 
$oldreceiptdate = mysqli_real_escape_string($con,$sqlhisans['receiptdate']); 
$oldamount = mysqli_real_escape_string($con,$sqlhisans['amount']); 
$oldpaymentmode = mysqli_real_escape_string($con,$sqlhisans['paymentmode']); 
$oldnotes = mysqli_real_escape_string($con,$sqlhisans['notes']); 

$sql=mysqli_query($con,"update pairsalespayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', type='$type', term='$term', customername='$hiscusname',    customerid='$customerid', receiptno='$receiptno', receiptdate='$receiptdate', amount='$amount', paymentmode='$paymentmode', notes='$notes' where id='$id'");
if($sql)
{
	$ch='';
	            if($hiscusname!=$oldcustomername)
				{
					if($ch!='')
					{
						$ch.='<br> '.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldcustomername.' To '.$hiscusname.' ) </span>';
					}
					else
					{
						$ch.=''.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( From '.$oldcustomername.' To '.$hiscusname.' ) </span>';
					}					
				}
                if($receiptdate!=$oldreceiptdate)
				{
					if($ch!='')
					{
						$ch.='<br> Date <span style="color:green;" id="prohisfromtospan">( From '.date($datefor,strtotime($oldreceiptdate)).' To '.date($datefor,strtotime($receiptdate)).' ) </span>';
					}
					else
					{
						$ch.=' Date <span style="color:green;" id="prohisfromtospan">( From '.date($datefor,strtotime($oldreceiptdate)).' To '.date($datefor,strtotime($receiptdate)).' ) </span>';
					}					
				}
				if($receiptno!=$oldreceiptno)
				{
					if($ch!='')
					{
						$ch.='<br> Reference Number <span style="color:green;" id="prohisfromtospan">( From '.$oldreceiptno.' To '.$receiptno.' ) </span>';
					}
					else
					{
						$ch.='Reference Number <span style="color:green;" id="prohisfromtospan">( From '.$oldreceiptno.' To '.$receiptno.' ) </span>';
					}					
				}
                if($paymentmode!=$oldpaymentmode)
				{
					if($ch!='')
					{
						$ch.='<br> Mode of Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldpaymentmode.' To '.$paymentmode.' ) </span>';
					}
					else
					{
						$ch.='Mode of Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldpaymentmode.' To '.$paymentmode.' ) </span>';
					}					
				}
                if($amount!=$oldamount)
				{
					if($ch!='')
					{
						$ch.='<br> Amount Received <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
					}
					else
					{
						$ch.='Amount Received <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
					}					
				}
                if($notes!=$oldnotes)
				{
					if($ch!='')
					{
						$ch.='<br> Notes <span style="color:green;" id="prohisfromtospan">( From '.$oldnotes.' To '.$notes.' ) </span>';
					}
					else
					{
						$ch.='Notes <span style="color:green;" id="prohisfromtospan">( From '.$oldnotes.' To '.$notes.' ) </span>';
					}					
				}
				// if($payment!=$oldpayment)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Select <span style="color:green;" id="prohisfromtospan">( From '.$oldpayment.' To '.$payment.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Select <span style="color:green;" id="prohisfromtospan">( From '.$oldpayment.' To '.$payment.' ) </span>';
				// 	}					
				// }
                // if($amount!=$oldamount)
				// {
				// 	if($ch!='')
				// 	{
				// 		$ch.='<br> Selected <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$ch.='Selected <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
				// 	}					
				// }
$totalamt = $amount;
$oldtotalamt = $oldamount;
$checkforhis = 0;
$sqle=mysqli_query($con,"delete from pairsalespayhistory where paymentid='$id'");	
for($i=0; $i<count($_POST['nos']); $i++)
{
	$paymentid=$id;
	$nos=$_POST['nos'][$i];
	$dates=$_POST['dates'][$i];
	$status=$_POST['status'][$i];
	$invamount=$_POST['invamt'][$i];
	$balamount=$_POST['balamt'][$i];
	if(isset($_POST['payments'.$i]))
	{
		$amount=$_POST['amounts'][$i];
		$oldamount=$_POST['oldamounts'][$i];
		$payment=$_POST['payments'.$i];
		if($amount==$payment)
		{
			$status='1';
		}
                if($amount!=$oldamount)
				{
					if($dates!='')
				{
					if($ch!='')
					{
						$ch.='<br> '.(($checkforhis==0)?'<span style="color:royalblue;">'.$infomainaccessinvoice['modulename'].' Information</span> <br> ':'').' (Selected) <br> '.$infomainaccessinvoice['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($datefor,strtotime($dates)).' ) </span>';
					}
					else
					{
						$ch.=''.(($checkforhis==0)?'<span style="color:royalblue;">'.$infomainaccessinvoice['modulename'].' Information</span> <br> ':'').' (Selected) <br> '.$infomainaccessinvoice['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($datefor,strtotime($dates)).' ) </span>';
					}					
				}
				$checkforhis++;
                if($nos!='')
				{
					if($ch!='')
					{
						$ch.='<br> '.$infomainaccessinvoice['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$nos.' ) </span>';
					}
					else
					{
						$ch.=''.$infomainaccessinvoice['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$nos.' ) </span>';
					}					
				}
                if($invamount!='')
				{
					if($ch!='')
					{
						$ch.='<br> '.$infomainaccessinvoice['modulename'].' Amount <span style="color:green;" id="prohisfromtospan">( '.$invamount.' ) </span>';
					}
					else
					{
						$ch.=''.$infomainaccessinvoice['modulename'].' Amount <span style="color:green;" id="prohisfromtospan">( '.$invamount.' ) </span>';
					}					
				}
                if($balamount!='')
				{
					if($ch!='')
					{
						$ch.='<br> Balance <span style="color:green;" id="prohisfromtospan">( '.$balamount.' ) </span>';
					}
					else
					{
						$ch.='Balance <span style="color:green;" id="prohisfromtospan">( '.$balamount.' ) </span>';
					}					
				}
					if($ch!='')
					{
						$ch.='<br> Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
					}
					else
					{
						$ch.='Payment <span style="color:green;" id="prohisfromtospan">( From '.$oldamount.' To '.$amount.' ) </span>';
					}					
				}
		$sqle=mysqli_query($con,"insert into pairsalespayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', customerid='$customerid', invoiceno='$nos', invoicedate='$dates', amount='$amount',type='payment'");
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
						$publicidmanual=$infomodulespublicnamemanual['publiccolumn'] . $oldcodepublicmanual+1;

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

							$selectinvdetail=$con->prepare("SELECT totalitems FROM pairinvoices WHERE invoiceno=? AND invoicedate=? AND customerid=? AND franchisesession=? AND createdid=?");
		    				$selectinvdetail->bind_param("sssss", $nos, $dates, $customerid, $_SESSION["franchisesession"], $companymainid);
							$selectinvdetail->execute();
							$selectinvdetails = $selectinvdetail->get_result();
							$fetinvdetails=$selectinvdetails->fetch_array();

							$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice payment')");
		    				$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $dates, $nos, $defaccountnamepettycashpay, $defaccountidpettycashpay, $customerid, $customername, $amount, $amount, $invamount, $publicidmanual, $privateidmanual);
		    				if($sqlaccinspay->execute()){}
		    				else{
		    					echo mysqli_error($con);
		    				}
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
		    				$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $dates, $nos, $defaccountnamepay, $defaccountidpay, $customerid, $customername, $amount, $amount, $invamount, $publicidmanual, $privateidmanual);
		    				$sqlaccdefaultpay->execute();
		    				$sqlaccdefaultpay->close();
							$selectinvdetail->close();
							$selectinvdetails->close();
					//FOR INSERT THE MANUAL JOURNAL
		if($sqle)
		{
			$sqler=mysqli_query($con,"update $tabname set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$status' where $nocolumn='$nos' and $datecolumn='$dates' and customerid='$customerid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
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
	// else
	// {
	// 	$sqler=mysqli_query($con,"update $tabname set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$status' where $nocolumn='$nos' and $datecolumn='$dates' and customerid='$customerid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
	// }
}	
if($sqler)
{
$sqliinvoice=mysqli_query($con, "select invoiceamount, invoicedate, invoiceno from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc");
$invoiceamount=0;
$balanceamount=0;
$currentamount=0;
$overdueamount=0;
while($infoinvoice=mysqli_fetch_array($sqliinvoice))
{
$invoiceamount+=(float)$infoinvoice['invoiceamount'];
$paidamount=0;
$sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$infoinvoice['invoiceno']."' and invoicedate='".$infoinvoice['invoicedate']."' and customerid='$customerid' order by id desc");
while($infosalespay=mysqli_fetch_array($sqlsalespay))
{
$paidamount+=(float)$infosalespay['amount'];
}
$balanceamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
$diff = abs(time() - strtotime($infoinvoice['invoicedate']));
$days = floor(($diff)/ (60*60*24));
if($days>30)
{
$overdueamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
}
else
{
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
			$balanceamount-=((float)$infocreditnote['creditnoteamount']);
			$diff = abs(time() - strtotime($infocreditnote['creditnotedate']));
			$days = floor(($diff)/ (60*60*24));
			if($days>30){
				$overdueamount-=((float)$infocreditnote['creditnoteamount']);
			}
			else{
				$currentamount-=((float)$infocreditnote['creditnoteamount']);
			}
			$sqlsalespay->close();
			$sqlsalespays->close();
		}
		$sqlicreditnote->close();
		$sqlicreditnotes->close();
$cussqlup = mysqli_query($con,"update paircustomers set invoiceamount='$invoiceamount',balanceamount='$balanceamount',currentamount='$currentamount',overdueamount='$overdueamount' where id='$customerid'");
}
                if($totalamt!=$oldtotalamt)
				{
					if($ch!='')
					{
						$ch.='<br> Total <span style="color:green;" id="prohisfromtospan">( From '.$oldtotalamt.' To '.$totalamt.' ) </span>';
					}
					else
					{
						$ch.='Total <span style="color:green;" id="prohisfromtospan">( From '.$oldtotalamt.' To '.$totalamt.' ) </span>';
					}					
				}
				if($ch!='')
				{
				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='SALESPAY', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$id', useremarks='".$ch." '");
				}
header("Location: salespaymentview.php?receiptno=".$receiptno."&receiptdate=".$receiptdate."&id=".$id."&remarks=Update Successfully");
}
else
{
header("Location: salespaymentview.php?receiptno=".$receiptno."&receiptdate=".$receiptdate."&id=".$id."&remarks=Error");
}
// }
// else{
// header("Location: salespayments.php?error=Already Added");
// }
}
else
{
$sqlismainaccesspublicnamecheck=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Payments Received' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicnamecheck=mysqli_fetch_array($sqlismainaccesspublicnamecheck);
$privatesqlcheck=mysqli_query($con,"select count(privateid) from pairsalespayments where createdid='$companymainid' and franchisesession='".$_SESSION['franchisesession']."'");
$privateanscheck=mysqli_fetch_array($privatesqlcheck);
$oldcodeprivatecheck=$privateanscheck[0];
$privatecodecheck=$infomainaccesspublicnamecheck['moduleprefix'] . $oldcodeprivatecheck;
$selforch=0;
if ($privatecodecheck==$privatecodes) {
for($i=0; $i<count($_POST['nos']); $i++)
{
// $paymentid=$id;
$nosss=$_POST['nos'][$i];
$datesss=$_POST['dates'][$i];
$selforsel = mysqli_query($con,"select id from pairsalespayhistory where customerid='$customerid' and invoiceno='$nosss' and invoicedate='$datesss'");
$selforfet = mysqli_fetch_array($selforsel);
if (mysqli_num_rows($selforsel)>0) {
$selforch=10;
}
}
}
if ($selforch==0) {
$sql=mysqli_query($con,"insert into pairsalespayments set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon',  term='$term', type='$type', customername='$hiscusname', customerid='$customerid', receiptno='$receiptno', receiptdate='$receiptdate', amount='$amount', paymentmode='$paymentmode', notes='$notes',publicid='$publiccode',privateid='$privatecode',ordering='$ordering'");
if($sql)
{
$id=mysqli_insert_id($con);
	$chadd='';
$chadd.='PAYMENT CREATED';
	            if($hiscusname!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> '.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$hiscusname.' ) </span>';
					}
					else
					{
						$chadd.=''.$infomainaccessusercus['modulename'].' Name <span style="color:green;" id="prohisfromtospan">( '.$hiscusname.' ) </span>';
					}					
				}
                if($receiptdate!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Date <span style="color:green;" id="prohisfromtospan">( '.date($datefor,strtotime($receiptdate)).' ) </span>';
					}
					else
					{
						$chadd.=' Date <span style="color:green;" id="prohisfromtospan">( '.date($datefor,strtotime($receiptdate)).' ) </span>';
					}					
				}
				if($receiptno!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Reference Number <span style="color:green;" id="prohisfromtospan">( '.$receiptno.' ) </span>';
					}
					else
					{
						$chadd.='Reference Number <span style="color:green;" id="prohisfromtospan">( '.$receiptno.' ) </span>';
					}					
				}
                if($paymentmode!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Mode of Payment <span style="color:green;" id="prohisfromtospan">( '.$paymentmode.' ) </span>';
					}
					else
					{
						$chadd.='Mode of Payment <span style="color:green;" id="prohisfromtospan">( '.$paymentmode.' ) </span>';
					}					
				}
                if($amount!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Amount Received <span style="color:green;" id="prohisfromtospan">( '.$amount.' ) </span>';
					}
					else
					{
						$chadd.='Amount Received <span style="color:green;" id="prohisfromtospan">( '.$amount.' ) </span>';
					}					
				}
                if($notes!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Notes <span style="color:green;" id="prohisfromtospan">( '.$notes.' ) </span>';
					}
					else
					{
						$chadd.='Notes <span style="color:green;" id="prohisfromtospan">( '.$notes.' ) </span>';
					}					
				}
				// if($payment!='')
				// {
				// 	if($chadd!='')
				// 	{
				// 		$chadd.='<br> Select <span style="color:green;" id="prohisfromtospan">( '.$payment.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$chadd.='Select <span style="color:green;" id="prohisfromtospan">( '.$payment.' ) </span>';
				// 	}					
				// }
                // if($amount!='')
				// {
				// 	if($chadd!='')
				// 	{
				// 		$chadd.='<br> Selected <span style="color:green;" id="prohisfromtospan">( '.$amount.' ) </span>';
				// 	}
				// 	else
				// 	{
				// 		$chadd.='Selected <span style="color:green;" id="prohisfromtospan">( '.$amount.' ) </span>';
				// 	}					
				// }
$totalamt = $amount;
$checkforhis = 0;
for($i=0; $i<count($_POST['nos']); $i++)
{
	$paymentid=$id;
	$nos=$_POST['nos'][$i];
	$dates=$_POST['dates'][$i];
	$status=$_POST['status'][$i];
	$invamount=$_POST['invamt'][$i];
	$balamount=$_POST['balamt'][$i];
	if(isset($_POST['payments'.$i]))
	{
		$amount=$_POST['amounts'][$i];
		$payment=$_POST['payments'.$i];
		if($amount==$payment)
		{
			$status='1';
		}
                if($dates!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> '.(($checkforhis==0)?'<span style="color:royalblue;">'.$infomainaccessinvoice['modulename'].' Information</span> <br> ':'').' (Selected) <br> '.$infomainaccessinvoice['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($datefor,strtotime($dates)).' ) </span>';
					}
					else
					{
						$chadd.=''.(($checkforhis==0)?'<span style="color:royalblue;">'.$infomainaccessinvoice['modulename'].' Information</span> <br> ':'').' (Selected) <br> '.$infomainaccessinvoice['modulename'].' Date <span style="color:green;" id="prohisfromtospan">( '.date($datefor,strtotime($dates)).' ) </span>';
					}					
				}
				$checkforhis++;
                if($nos!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> '.$infomainaccessinvoice['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$nos.' ) </span>';
					}
					else
					{
						$chadd.=''.$infomainaccessinvoice['modulename'].' Number <span style="color:green;" id="prohisfromtospan">( '.$nos.' ) </span>';
					}					
				}
                if($invamount!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> '.$infomainaccessinvoice['modulename'].' Amount <span style="color:green;" id="prohisfromtospan">( '.$invamount.' ) </span>';
					}
					else
					{
						$chadd.=''.$infomainaccessinvoice['modulename'].' Amount <span style="color:green;" id="prohisfromtospan">( '.$invamount.' ) </span>';
					}					
				}
                if($balamount!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Balance <span style="color:green;" id="prohisfromtospan">( '.$balamount.' ) </span>';
					}
					else
					{
						$chadd.='Balance <span style="color:green;" id="prohisfromtospan">( '.$balamount.' ) </span>';
					}					
				}
                if($amount!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Payment <span style="color:green;" id="prohisfromtospan">( '.$amount.' ) </span>';
					}
					else
					{
						$chadd.='Payment <span style="color:green;" id="prohisfromtospan">( '.$amount.' ) </span>';
					}					
				}
		$sqle=mysqli_query($con,"insert into pairsalespayhistory set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paymentid='$paymentid', customerid='$customerid', invoiceno='$nos', invoicedate='$dates', amount='$amount',type='payment'");
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
						$publicidmanual=$infomodulespublicnamemanual['publiccolumn'] . $oldcodepublicmanual+1;

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

							$selectinvdetail=$con->prepare("SELECT totalitems FROM pairinvoices WHERE invoiceno=? AND invoicedate=? AND customerid=? AND franchisesession=? AND createdid=?");
		    				$selectinvdetail->bind_param("sssss", $nos, $dates, $customerid, $_SESSION["franchisesession"], $companymainid);
							$selectinvdetail->execute();
							$selectinvdetails = $selectinvdetail->get_result();
							$fetinvdetails=$selectinvdetails->fetch_array();

							$sqlaccinspay = $con->prepare("INSERT INTO pairledgers (createdon,createdid,createdby,franchisesession,ledgerdate,ledgerno,chartaccountname,chartaccountid,customerid,customername,ledgerdebit,ledgercredit,subledgerdebit,subledgercredit,totalledgerdebit,totalledgercredit,balanceledgerdebit,balanceledgercredit,publicid,privateid,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', ?, '0', ?, '0', '0', '0', ?, ?, 'invoice payment')");
		    				$sqlaccinspay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $dates, $nos, $defaccountnamepettycashpay, $defaccountidpettycashpay, $customerid, $customername, $amount, $amount, $invamount, $publicidmanual, $privateidmanual);
		    				if($sqlaccinspay->execute()){}
		    				else{
		    					echo mysqli_error($con);
		    				}
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
		    				$sqlaccdefaultpay->bind_param("sisisssssssssss", $times, $companymainid, $_SESSION["unqwerty"], $_SESSION["franchisesession"], $dates, $nos, $defaccountnamepay, $defaccountidpay, $customerid, $customername, $amount, $amount, $invamount, $publicidmanual, $privateidmanual);
		    				$sqlaccdefaultpay->execute();
		    				$sqlaccdefaultpay->close();
							$selectinvdetail->close();
							$selectinvdetails->close();
					//FOR INSERT THE MANUAL JOURNAL
		if($sqle)
		{
			$sqler=mysqli_query($con,"update $tabname set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$status' where $nocolumn='$nos' and $datecolumn='$dates' and customerid='$customerid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
			if($sqler)
			{
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
	// else
	// {
	// 	$sqler=mysqli_query($con,"update $tabname set createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', createdon='$createdon', paidstatus='$status' where $nocolumn='$nos' and $datecolumn='$dates' and customerid='$customerid' and franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
	// }
}
if($sqler)
{
$sqliinvoice=mysqli_query($con, "select invoiceamount, invoicedate, invoiceno from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc");
$invoiceamount=0;
$balanceamount=0;
$currentamount=0;
$overdueamount=0;
while($infoinvoice=mysqli_fetch_array($sqliinvoice))
{
$invoiceamount+=(float)$infoinvoice['invoiceamount'];
$paidamount=0;
$sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$infoinvoice['invoiceno']."' and invoicedate='".$infoinvoice['invoicedate']."' and customerid='$customerid' order by id desc");
while($infosalespay=mysqli_fetch_array($sqlsalespay))
{
$paidamount+=(float)$infosalespay['amount'];
}
$balanceamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
$diff = abs(time() - strtotime($infoinvoice['invoicedate']));
$days = floor(($diff)/ (60*60*24));
if($days>30)
{
$overdueamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
}
else
{
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
			$balanceamount-=((float)$infocreditnote['creditnoteamount']);
			$diff = abs(time() - strtotime($infocreditnote['creditnotedate']));
			$days = floor(($diff)/ (60*60*24));
			if($days>30){
				$overdueamount-=((float)$infocreditnote['creditnoteamount']);
			}
			else{
				$currentamount-=((float)$infocreditnote['creditnoteamount']);
			}
			$sqlsalespay->close();
			$sqlsalespays->close();
		}
		$sqlicreditnote->close();
		$sqlicreditnotes->close();
$cussqlup = mysqli_query($con,"update paircustomers set invoiceamount='$invoiceamount',balanceamount='$balanceamount',currentamount='$currentamount',overdueamount='$overdueamount' where id='$customerid'");
}

                if($totalamt!='')
				{
					if($chadd!='')
					{
						$chadd.='<br> Total <span style="color:green;" id="prohisfromtospan">( '.$totalamt.' ) </span>';
					}
					else
					{
						$chadd.='Total <span style="color:green;" id="prohisfromtospan">( '.$totalamt.' ) </span>';
					}					
				}
	$sql3=mysqli_query($con, "update pairmainaccess set modulesuffix=modulesuffix+1 where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Payments Received'");
	$sql333=mysqli_query($con, "update pairmainaccess set modulesuffix=modulesuffix+1 where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Manual Journals'");
				if($chadd!='')
				{
				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='SALESPAY', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$id', useremarks='".$chadd." '");
				}
   

if(isset($_POST['open']))
{
header("Location: salespaymentadd.php?remarks=Added Successfully");	
}
else
{
header("Location: salespaymentview.php?receiptno=".$receiptno."&receiptdate=".$receiptdate."&id=".$id."&remarks=Added Successfully");	
}

}
else
{
header("Location: salespaymentview.php?receiptno=".$receiptno."&receiptdate=".$receiptdate."&id=".$id."&remarks=Error");
}
}
else{
header("Location: salespayments.php?error=Already Added");
}
}
?>
