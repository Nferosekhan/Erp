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
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Bills' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
if (isset($_GET['term'])) {
$totalcancel=array();
				  $totalbillno=array();
				  $totalbilldate=array();
				  $sql=mysqli_query($con, "select MAX(id) AS id,billdate, billno, vendorname, billterm, duedate, billamount, cancelstatus, vendorid from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' ".urldecode($_GET['typesforlisting'])." GROUP BY billdate, billno order by billdate desc, ordering DESC limit ".$_GET['term'].",".$_GET['limitings']."");
	 			  
				  $count=1;
				    $billamount=0;
	$balanceamount=0;
	$currentamount=0;
	$overdueamount=0;
				  while($info=mysqli_fetch_array($sql))
				  {
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
											if($info['cancelstatus']=='1'){
					  ?>
                      <tr style="text-decoration: line-through;">
                      <?php
					  }
					  else
					  {
					  ?>
                      <tr>
                      <?php
					  }
					  ?>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Date"><?=(($info['billdate']!='')?(date($date,strtotime($info['billdate']))):'')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('No', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Number"><?=$info['billno']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Vendor Name', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Name"><?=$info['vendorname']?></td>
                      <?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Term', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Term"><?=$info['billterm']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount', $modulecolumns))) {
                                                ?>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                     
					  
					   <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Amount"><i class="fa fa-rupee"></i> <?=number_format((float)$info['billamount'],2,'.','')?></td>
                       <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Status', $modulecolumns))) {
                                                ?>
					  
					  <?php
					  if($currentbalance==0)
					  {
							?>
							<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" class="text-success">Paid</td>
							<?php
					  }
					  else
					  {
							if(($paidamount - $refundamount)<=0)
							  {
									?>
									<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" class="text-danger">Un Paid</td>
									<?php
							  }
							  else
							  {
									?>
									<td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" class="text-warning">Partially Paid</td>
									<?php
							  }
					  }
					  ?>
					  
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Balance', $modulecolumns))) {
                                                ?>
					  <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Balance"><i class="fa fa-rupee"></i> <?=number_format((float)$currentbalance,2,'.','')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Print', $modulecolumns))) {
                                                ?>
					  
					  <!--td class="">&nbsp;
                        <a href="billedit.php?billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td-->
					  <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="billprint.php?billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Print
                        </a>
                      </td>
                      <?php
                                            }
                                                ?>
                      <?php
					  /* if($info['cancelstatus']=='1')
					  {
					  ?>
                      <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['billno']?>','<?=$info['billdate']?>','0')"><i class="fa fa-check"></i> Enable Bill</a></td>
                      <?php
					  // }
					  // else
					  // {
					  ?>
                      <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['billno']?>','<?=$info['billdate']?>','1')"><i class="fa fa-times"></i> Cancel Bill</a></td>
                      <?php
					  // } */
					  ?>
                      
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="billedit.php?billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                    </tr>

					<?php
				  $count++;
				  }
}
?>