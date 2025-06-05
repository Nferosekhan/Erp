<?php
include('lcheck.php');
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Debit Notes' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
if (isset($_GET['term'])) {
$totalcancel=array();
				  $totaldebitnoteno=array();
				  $totaldebitnotedate=array();
				  $sql=mysqli_query($con, "select MAX(id) AS id,debitnotedate, debitnoteno, vendorname, debitnoteterm, duedate, debitnoteamount, cancelstatus from pairdebitnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' ".urldecode($_GET['typesforlisting'])." GROUP BY debitnotedate, debitnoteno order by debitnotedate desc, ordering DESC limit ".$_GET['term'].",".$_GET['limitings']."");
	 			  
				  $count=1;
				    $debitnoteamount=0;
	$balanceamount=0;
	$currentamount=0;
	$overdueamount=0;
				  while($info=mysqli_fetch_array($sql))
				  {
			  
			  
			  
				$debitnoteamount+=(float)$info['debitnoteamount'];
				$currentamount=(float)$info['debitnoteamount'];
				$paidamount=0;
				$currentbalance=0;
				$sqlpurchasepay=mysqli_query($con,"select amount from pairdebitnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and debitnoteno='".$info['debitnoteno']."' and debitnotedate='".$info['debitnotedate']."' order by id desc");
				while($infopurchasepay=mysqli_fetch_array($sqlpurchasepay))
				{
					$paidamount+=(float)$infopurchasepay['amount'];
				}
				$currentbalance=((float)$info['debitnoteamount']-$paidamount);
				$balanceamount+=((float)$info['debitnoteamount']-$paidamount);
			  
					 /* $totalid[]=$info['id'];*/
					  $totalcancel[]=$info['cancelstatus'];
					  $totaldebitnoteno[]=$info['debitnoteno'];
					  $totaldebitnotedate[]=$info['debitnotedate'];
					  if($info['cancelstatus']=='1')
					  {
					  ?>
<!-- <tr style="text-decoration: line-through;"> -->
						<?php
						  }
						  else{
						?>
						  <tr>
						  <?php
							 }
							 if ((in_array('Date', $modulecolumns))) {
						  ?>
							 <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Date">
								<?=(($info['debitnotedate']!='')?(date($date,strtotime($info['debitnotedate']))):'&nbsp;')?>
							 </td>
						  <?php
							 }
							 if ((in_array('No', $modulecolumns))) {
						  ?>
							 <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Number">
								<?=(($info['debitnoteno']=='')?'&nbsp;':'')?><?=$info['debitnoteno']?>
							 </td>
						  <?php
							 }
							 // if ((in_array('Vendor Name', $modulecolumns))) {
						  ?>
							 <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Name">
								<?=(($info['vendorname']=='')?'&nbsp;':'')?><?=$info['vendorname']?>
							 </td>
						  <?php
							 // }
							 if ((in_array('Term', $modulecolumns))) {
						  ?>
							 <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Term">
								<?=$info['debitnoteterm']?>
							 </td>
						  <?php
							 }
							 if ((in_array('Amount', $modulecolumns))) {
						  ?>
							 <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Amount">
								<i class="fa fa-rupee"></i>
								<?=number_format((float)$info['debitnoteamount'],2,'.','')?>
							 </td>
						  <?php
							 }
							 if ((in_array('Status', $modulecolumns))) {
								if($info['cancelstatus']=='1'){
								}
								else{
								  if(($currentbalance==0)||($currentbalance<=0)){
							 ?>
							 <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Status" class="text-success">
								Refunded
							 </td>
								<?php
								  }
								  else{
									 if($currentbalance==$currentamount){
								?>
							 <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Status" class="text-danger">
								Not Refunded
							 </td>
								  <?php
									 }
									 else{
								  ?>
							 <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Status" class="text-warning">
								Partially Refunded
							 </td>
						  <?php
									 }
								  }
								}
							 }
							 if ((in_array('Balance', $modulecolumns))) {
						  ?>
							 <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Balance">
								<i class="fa fa-rupee"></i>
								<?=number_format((float)$currentbalance,2,'.','')?>
							 </td>
						  <?php
							 }
							 if ((in_array('Print', $modulecolumns))) {
						  ?>
							 <td data-label="Print" class="">&nbsp;
								<a target="_blank" href="debitnoteprint.php?debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
								  Print
								</a>
							 </td>
						  <?php
							 }
							 if ((in_array('Edit', $modulecolumns))) {
						  ?>
							 <td data-label="Edit">
								<a href="debitnoteedit.php?debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>" class="text-secondary font-weight-bold text-xs">
								  <i class="fa fa-edit"></i> Edit
								</a>
							 </td>
						  <?php
							 }
						  ?> 
						  </tr>
					<?php
				  $count++;
				  }
}
?>