<?php
include('lcheck.php');
if(!empty($_POST["vendorid"]))
{
$sqlget=mysqli_query($con,"select * from paircurrency");
$row=mysqli_fetch_array($sqlget);
$ans=$row['currencysymbol'];
$res=explode('-',$ans);
$vendorid=mysqli_real_escape_string($con, $_POST["vendorid"]);
$no=mysqli_real_escape_string($con, $_POST["no"]);
$date=mysqli_real_escape_string($con, $_POST["date"]);
$type=mysqli_real_escape_string($con, $_POST["type"]);
$sqlismainaccessdebitnote=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Debit Notes' order by id  asc");
$infomainaccessdebitnote=mysqli_fetch_array($sqlismainaccessdebitnote);
if($type!='')
{
	$labelname=strtoupper($type);
	$nocolumn=$type.'no';
	$datecolumn=$type.'date';
	$tabname='pair'.$type.'s';
}
else
{
	$type='debitnote';
	$labelname=strtoupper($type);
	$nocolumn=$type.'no';
	$datecolumn=$type.'date';
	$tabname='pair'.$type.'s';
}

if($vendorid!='')
{
	echo '
	<table style="width:100%" class="table table-bordered responsive-table" id="amttable">';
	echo '<thead>';
	echo '<tr class="info">';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding:0px;width:30px;"></th>';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;font-size:13px !important;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;">'. strtoupper($infomainaccessdebitnote['modulename']) .' DATE</span></th>';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;font-size:13px !important;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;">'. strtoupper($infomainaccessdebitnote['modulename']) .' NUMBER</span></th>';
	// echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;font-size:13px !important;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;">NAME</span></th>';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;font-size:13px !important;width:215px;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;text-align:right;width:100%;">'. strtoupper($infomainaccessdebitnote['modulename']) .' AMOUNT</span></th>';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;font-size:13px !important;width:215px;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;text-align:right;width:100%;">BALANCE</span></th>';
	echo '<th style="border:1px solid #ddd !important;vertical-align:middle !important;font-size:13px !important;width:215px;"><span style="display:inline-block;font-size:13px;color:black;font-weight: normal;text-align:right;width:100%;">PAYMENT</span></th>';
	echo '</tr>';
	echo '</thead>';
	$i=0;
	$totalbalance=0;
	if($type!=''&&$no!=''&&$date!=''){
	$sqls=mysqli_query($con,"select billno, billdate,$nocolumn, $datecolumn, grandtotal, vendorid, vendorname from $tabname where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and vendorid='$vendorid' and $datecolumn='$date' and $nocolumn='$no' and cancelstatus!='1' GROUP BY $datecolumn, $nocolumn  order by $datecolumn asc, $nocolumn asc");
	}
	else{
	$sqls=mysqli_query($con,"select billno, billdate,$nocolumn, $datecolumn, grandtotal, vendorid, vendorname from $tabname where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and vendorid='$vendorid' and cancelstatus!='1' GROUP BY $datecolumn, $nocolumn  order by $datecolumn asc, $nocolumn asc");
	}
	while($infos=mysqli_fetch_array($sqls))
	{
		$am=0;
		$bal=0;
		$sqlse=mysqli_query($con,"select sum(amount) as amount from pairdebitnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  debitnoteno='".$infos[$nocolumn]."' and debitnotedate='".$infos[$datecolumn]."' and vendorid='$vendorid' ");
		while($infose=mysqli_fetch_array($sqlse))
		{
			$am+=(float)$infose['amount'];
		}
		// if($am>0){
				$bal=(float)$infos['grandtotal']-$am;
			// $bal=(float)$infos['grandtotal']-$am;
			$sqlsant=mysqli_query($con,"select billno, billdate, grandtotal, vendorid, vendorname from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and vendorid='$vendorid' and billno='".$infos['billno']."' and billdate='".$infos['billdate']."' and cancelstatus!='1' GROUP BY billdate, billno  order by billdate asc, billno asc");
			$purchaseamt = 0;
			if(mysqli_num_rows($sqlsant)>0){
				while($infoants=mysqli_fetch_array($sqlsant)){
					$bal-=(float)$infoants['grandtotal'];
					$amant=0;
					$sqlsante=mysqli_query($con,"select sum(amount) as amount from pairpurchasepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  billno='".$infoants['billno']."' and billdate='".$infoants['billdate']."' and vendorid='$vendorid' ");
					while($infoantse=mysqli_fetch_array($sqlsante)){
						$amant+=(float)$infoantse['amount'];
					}
					$bal=((float)$bal+$amant);
				}
			}
			// $bal = $purchaseamt - $am;
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
		echo '<td data-label="'. strtoupper($infomainaccessdebitnote['modulename']) .' DATE" style="vertical-align:middle !important;text-align:left;">'.date('d/m/Y',strtotime($infos[$datecolumn])).'</td>';
		echo '<td data-label="'. strtoupper($infomainaccessdebitnote['modulename']) .' NUMBER" style="vertical-align:middle !important;text-align:left;">'.$infos[$nocolumn].'</td>';
		// echo '<td data-label="NAME" style="vertical-align:middle !important;text-align:left;">'.(($infos['vendorid']!='')?$infos['vendorname']:$infos['vendorname']).'</td>';
		echo '<td data-label="'. strtoupper($infomainaccessdebitnote['modulename']) .' AMOUNT" style="vertical-align:middle !important;text-align:right;">'.$res[0].''.$infos['grandtotal'].'</td>';
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
		echo '<td data-label="'. strtoupper($infomainaccessdebitnote['modulename']) .' DATE" style="vertical-align:middle !important;text-align:left;">'.date('d/m/Y',strtotime($infos[$datecolumn])).'</td>';
		echo '<td data-label="'. strtoupper($infomainaccessdebitnote['modulename']) .' NUMBER" style="vertical-align:middle !important;text-align:left;">'.$infos[$nocolumn].'</td>';
		// echo '<td data-label="NAME" style="vertical-align:middle !important;text-align:left;">'.(($infos['vendorid']!='')?$infos['vendorname']:$infos['vendorname']).'</td>';
		echo '<td data-label="'. strtoupper($infomainaccessdebitnote['modulename']) .' AMOUNT" style="vertical-align:middle !important;text-align:right;">'.$res[0].''.$infos['grandtotal'].'</td>';
		echo '<td data-label="BALANCE" style="vertical-align:middle !important;text-align:right;">'.$res[0].''.$bal.'</td>';
		echo '<td data-label="PAYMENT" style="height:45px !important;vertical-align:middle !important;"  id="amttd"><span style="position:relative;top:0px;" class="rupamt">'.$res[0].'</span><input type="number" step="any" class="form-control amt" name="amounts[]" id="amounts'.$i.'" style="text-align:right;width:90%;float:right;background:none;" value="0.00" max="'.$bal.'" onchange="return changeinpval('.$i.')"></td>';
		echo '</tr>';
		$i++;
		$totalbalance+=(float)$bal;
	}
}
	}
// if($no==''&&$date==''){
// 	$sqlsant=mysqli_query($con,"select billno, billdate, grandtotal, vendorid, vendorname from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and vendorid='$vendorid' and paidstatus!='1' GROUP BY billdate, billno  order by billdate asc, billno asc");
// 	while($infoants=mysqli_fetch_array($sqlsant)){
// 		$amant=0;
// 		$sqlsante=mysqli_query($con,"select sum(amount) as amount from pairpurchasepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  billno='".$infoants['billno']."' and billdate='".$infoants['billdate']."' and vendorid='$vendorid' ");
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