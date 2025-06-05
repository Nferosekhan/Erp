<?php
include('lcheck.php');
if(!empty($_POST["customerid"]))
{
$sqlget=mysqli_query($con,"select * from paircurrency");
$row=mysqli_fetch_array($sqlget);
$ans=$row['currencysymbol'];
$res=explode('-',$ans);
$customerid=mysqli_real_escape_string($con, $_POST["customerid"]);
$no=mysqli_real_escape_string($con, $_POST["no"]);
$date=mysqli_real_escape_string($con, $_POST["date"]);
$type=mysqli_real_escape_string($con, $_POST["type"]);
$sqlismainaccesscreditnote=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Credit Notes' order by id  asc");
$infomainaccesscreditnote=mysqli_fetch_array($sqlismainaccesscreditnote);
if($type!='')
{
	$labelname=strtoupper($type);
	$nocolumn=$type.'no';
	$datecolumn=$type.'date';
	$tabname='pair'.$type.'s';
}
else
{
	$type='creditnote';
	$labelname=strtoupper($type);
	$nocolumn=$type.'no';
	$datecolumn=$type.'date';
	$tabname='pair'.$type.'s';
}

if($customerid!='')
{
	echo '
	<table style="width:100%" class="table table-bordered responsive-table" id="amttable">';
	echo '<thead>';
	echo '<tr class="info">';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px;width:30px;"></th>';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;">'. strtoupper($infomainaccesscreditnote['modulename']) .' DATE</span></th>';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;">'. strtoupper($infomainaccesscreditnote['modulename']) .' NUMBER</span></th>';
	// echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;">NAME</span></th>';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;width:215px;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;text-align:right;width:100%;">'. strtoupper($infomainaccesscreditnote['modulename']) .' AMOUNT</span></th>';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;width:215px;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;text-align:right;width:100%;">BALANCE</span></th>';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;width:215px;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;text-align:right;width:100%;">PAYMENT</span></th>';
	echo '</tr>';
	echo '</thead>';
	$i=0;
	$totalbalance=0;
	if($type!=''&&$no!=''&&$date!=''){
	$sqls=mysqli_query($con,"select invoiceno,invoicedate,$nocolumn, $datecolumn, grandtotal, customerid, customername from $tabname where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' and $datecolumn='$date' and $nocolumn='$no' and cancelstatus!='1' GROUP BY $datecolumn, $nocolumn  order by $datecolumn asc, $nocolumn asc");
	}
	else{
	$sqls=mysqli_query($con,"select invoiceno,invoicedate,$nocolumn, $datecolumn, grandtotal, customerid, customername from $tabname where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' and cancelstatus!='1' GROUP BY $datecolumn, $nocolumn  order by $datecolumn asc, $nocolumn asc");
	}
	while($infos=mysqli_fetch_array($sqls))
	{
		$am=0;
		$bal=0;
		$sqlse=mysqli_query($con,"select sum(amount) as amount from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos[$nocolumn]."' and creditnotedate='".$infos[$datecolumn]."' and customerid='$customerid' ");
		while($infose=mysqli_fetch_array($sqlse))
		{
			$am+=(float)$infose['amount'];
		}
		// if($am>0){
				$bal=(float)$infos['grandtotal']-$am;
			// $bal=(float)$infos['grandtotal']-$am;
			$sqlsant=mysqli_query($con,"select invoiceno, invoicedate, grandtotal, customerid, customername from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' and invoiceno='".$infos['invoiceno']."' and invoicedate='".$infos['invoicedate']."' and cancelstatus!='1' GROUP BY invoicedate, invoiceno  order by invoicedate asc, invoiceno asc");
			$salesamt = 0;
			if(mysqli_num_rows($sqlsant)>0){
				while($infoants=mysqli_fetch_array($sqlsant)){
					$bal-=(float)$infoants['grandtotal'];
					$amant=0;
					$sqlsante=mysqli_query($con,"select sum(amount) as amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  invoiceno='".$infoants['invoiceno']."' and invoicedate='".$infoants['invoicedate']."' and customerid='$customerid' ");
					while($infoantse=mysqli_fetch_array($sqlsante)){
						$amant+=(float)$infoantse['amount'];
					}
					$bal=((float)$bal+$amant);
				}
			}
			// $bal = $salesamt - $am;
			// if ($bal<=$infos['grandtotal']) {
			// 	$bal = $bal;
			// }
			// else{
			// 	$bal = $infos['grandtotal'];
			// }
			// $bal= -1 * ($bal - $infos['grandtotal']);
		// }
		if ($bal>0) {
		if($type!=''&&$no!=''&&$date!=''){
		echo '<input type="hidden" name="nos[]" id="no'.$i.'" value="'.$infos[$nocolumn].'">
		<input type="hidden" name="dates[]" id="date'.$i.'" value="'.$infos[$datecolumn].'">
		<input type="hidden" name="status[]" id="status'.$i.'" value="0">
		<input type="hidden" name="invamt[]" id="invamt'.$i.'" value="'.$infos['grandtotal'].'">
		<input type="hidden" name="balamt[]" id="balamt'.$i.'" value="'.$bal.'">';
			echo '<tr style="background-color:rgb(213 213 213);">';
		
		echo '<td style="vertical-align:middle !important;text-align:left;"><input type="checkbox" name="payments'.$i.'" id="payments'.$i.'" onchange="return changeval('.$i.')" value="'.$bal.'" style="position:relative;top:2px;" checked></td>';
		echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' DATE" style="vertical-align:middle !important;text-align:left;">'.date('d/m/Y',strtotime($infos[$datecolumn])).'</td>';
		echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' NUMBER" style="vertical-align:middle !important;text-align:left;">'.$infos[$nocolumn].'</td>';
		// echo '<td data-label="NAME" style="vertical-align:middle !important;text-align:left;">'.(($infos['customerid']!='')?$infos['customername']:$infos['customername']).'</td>';
		echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' AMOUNT" style="vertical-align:middle !important;text-align:right;">'.$res[0].''.$infos['grandtotal'].'</td>';
		echo '<td data-label="BALANCE" style="vertical-align:middle !important;text-align:right;">'.$res[0].''.$bal.'</td>';
		echo '<td data-label="PAYMENT" style="height:45px !important;vertical-align:middle !important;"  id="amttd"><span style="position:relative;top:0px;" class="rupamt">'.$res[0].'</span><input type="number" step="any" class="form-control amt" name="amounts[]" id="amounts'.$i.'" style="text-align:right;width:90%;float:right;background:none;" value="'.$bal.'.00" max="'.$bal.'" onchange="return changeinpval('.$i.')"></td>';
		echo '</tr>';
		$i++;
		$totalbalance+=(float)$bal;
	}
	else{
	echo '<input type="hidden" name="nos[]" id="no'.$i.'" value="'.$infos[$nocolumn].'">
		<input type="hidden" name="dates[]" id="date'.$i.'" value="'.$infos[$datecolumn].'">
		<input type="hidden" name="status[]" id="status'.$i.'" value="0">
		<input type="hidden" name="invamt[]" id="invamt'.$i.'" value="'.$infos['grandtotal'].'">
		<input type="hidden" name="balamt[]" id="balamt'.$i.'" value="'.$bal.'">';
			echo '<tr>';
		
		echo '<td style="vertical-align:middle !important;text-align:left;"><input type="checkbox" name="payments'.$i.'" id="payments'.$i.'" onchange="return changeval('.$i.')" value="'.$bal.'" style="position:relative;top:2px;"></td>';
		echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' DATE" style="vertical-align:middle !important;text-align:left;">'.date('d/m/Y',strtotime($infos[$datecolumn])).'</td>';
		echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' NUMBER" style="vertical-align:middle !important;text-align:left;">'.$infos[$nocolumn].'</td>';
		// echo '<td data-label="NAME" style="vertical-align:middle !important;text-align:left;">'.(($infos['customerid']!='')?$infos['customername']:$infos['customername']).'</td>';
		echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' AMOUNT" style="vertical-align:middle !important;text-align:right;">'.$res[0].''.$infos['grandtotal'].'</td>';
		echo '<td data-label="BALANCE" style="vertical-align:middle !important;text-align:right;">'.$res[0].''.$bal.'</td>';
		echo '<td data-label="PAYMENT" style="height:45px !important;vertical-align:middle !important;"  id="amttd"><span style="position:relative;top:0px;" class="rupamt">'.$res[0].'</span><input type="number" step="any" class="form-control amt" name="amounts[]" id="amounts'.$i.'" style="text-align:right;width:90%;float:right;background:none;" value="0.00" max="'.$bal.'" onchange="return changeinpval('.$i.')"></td>';
		echo '</tr>';
		$i++;
		$totalbalance+=(float)$bal;
	}
}
	}
// if($no==''&&$date==''){
// 	$sqlsant=mysqli_query($con,"select invoiceno, invoicedate, grandtotal, customerid, customername from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' and paidstatus!='1' GROUP BY invoicedate, invoiceno  order by invoicedate asc, invoiceno asc");
// 	while($infoants=mysqli_fetch_array($sqlsant)){
// 		$amant=0;
// 		$sqlsante=mysqli_query($con,"select sum(amount) as amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  invoiceno='".$infoants['invoiceno']."' and invoicedate='".$infoants['invoicedate']."' and customerid='$customerid' ");
// 		while($infoantse=mysqli_fetch_array($sqlsante)){
// 			$amant+=(float)$infoantse['amount'];
// 		}
// 		$balant=(float)$infoants['grandtotal']-$amant;
// 		$totalbalance+=(float)$balant;
// 	}
// }
echo '</table>
<script>
document.getElementById("totalbalance").innerHTML="(Pending Balance: Rs.'.$totalbalance.')";
</script>
';
if ($totalbalance==0) {
	echo "<script>$('#submittableview').attr('disabled','disabled');</script>";
}
else{
	echo "<script>$('#submittableview').removeAttr('disabled');</script>";
}
}
else
{
echo ''; 	
}
}
?>