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
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Credit Notes' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
if (isset($_GET['term'])) {
$totalcancel=array();
				  $totalcreditnoteno=array();
				  $totalcreditnotedate=array();
				  $sql=mysqli_query($con, "select MAX(id) AS id,creditnotedate, creditnoteno, customername, creditnoteterm, duedate, creditnoteamount, cancelstatus from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' ".urldecode($_GET['typesforlisting'])." GROUP BY creditnotedate, creditnoteno order by creditnotedate desc, ordering DESC limit ".$_GET['term'].",".$_GET['limitings']."");
	 			  
				  $count=1;
				    $creditnoteamount=0;
	$balanceamount=0;
	$currentamount=0;
	$overdueamount=0;
				  while($info=mysqli_fetch_array($sql))
				  {
			  
			  
			  
				$creditnoteamount+=(float)$info['creditnoteamount'];
				$currentamount=(float)$info['creditnoteamount'];
				$paidamount=0;
				$currentbalance=0;
				$sqlpurchasepay=mysqli_query($con,"select amount from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and creditnoteno='".$info['creditnoteno']."' and creditnotedate='".$info['creditnotedate']."' order by id desc");
				while($infopurchasepay=mysqli_fetch_array($sqlpurchasepay))
				{
					$paidamount+=(float)$infopurchasepay['amount'];
				}
				$currentbalance=((float)$info['creditnoteamount']-$paidamount);
				$balanceamount+=((float)$info['creditnoteamount']-$paidamount);
			  
					 /* $totalid[]=$info['id'];*/
					  $totalcancel[]=$info['cancelstatus'];
					  $totalcreditnoteno[]=$info['creditnoteno'];
					  $totalcreditnotedate[]=$info['creditnotedate'];
					  if($info['cancelstatus']=='1')
					  {
					  ?>
                      <tr>
									<?php
										}
										else{
									?>
										<tr>
									<?php
										}
									?>
										<?php
											if ((in_array('Date', $modulecolumns))) {
										?>
											<td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Date">
												<?=(($info['creditnotedate']!='')?(date($date,strtotime($info['creditnotedate']))):'&nbsp;')?>
											</td>
										<?php
											}
											if ((in_array('No', $modulecolumns))) {
										?>
											<td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Number">
												<?=(($info['creditnoteno']=='')?'&nbsp;':'')?><?=$info['creditnoteno']?>
											</td>
										<?php
											}
											// if ((in_array('Customer Name', $modulecolumns))) {
										?>
											<td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Name">
												<?=(($info['customername']=='')?'&nbsp;':'')?><?=$info['customername']?>
											</td>
										<?php
											// }
											if ((in_array('Amount', $modulecolumns))) {
										?>
											<!--td data-label="Due Date"><?=$info['duedate']?></td-->
											<td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Amount">
												<i class="fa fa-rupee"></i> <?=number_format((float)$info['creditnoteamount'],2,'.','')?>
											</td>
										<?php
											}
											if ((in_array('Status', $modulecolumns))) {
												if($info['cancelstatus']=='1'){
												}
												else{
													if(($currentbalance==0)||($currentbalance<=0)){
										?>
											<td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Status" class="text-success" style="text-decoration: none;">
												Refunded
											</td>
										<?php
													}
													else{
														if($currentbalance==$currentamount){
										?>
											<td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Status" class="text-danger" style="text-decoration: none;">
												Not Refunded
											</td>
										<?php
														}
														else{
										?>
											<td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Status" class="text-warning" style="text-decoration: none;">
												Partially Refunded
											</td>
										<?php
														}
													}
												}
											}
											if ((in_array('Balance', $modulecolumns))) {
										?>
											<td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Balance">
												<i class="fa fa-rupee"></i> <?=number_format((float)$currentbalance,2,'.','')?>
											</td>
										<?php
											}
											if ((in_array('Print', $modulecolumns))) {
										?>
											<td data-label="Print" class="">&nbsp;
												<a target="_blank" href="creditnoteprint.php?creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
													Print
												</a>
											</td>
										<?php
											}
											if ((in_array('Edit', $modulecolumns))) {
										?>
											<td data-label="Edit">
												<a href="creditnoteedit.php?creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>" class="text-secondary font-weight-bold text-xs">
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