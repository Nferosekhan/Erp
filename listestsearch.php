<?php
include('lcheck.php');
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd-m-Y';
}
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Estimates' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
if (isset($_GET['term'])) {
$totalcancel=array();
				  $totalestimateno=array();
				  $totalestimatedate=array();
				  $sql=mysqli_query($con, "select estimatedate, estimateno, customername, estimateterm, duedate, estimateamount, cancelstatus, grandtotal, totalvatamount, roundoff from pairestimates where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY estimatedate, estimateno order by estimatedate desc, estimateno desc limit ".$_GET['term'].",10");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
					 /* $totalid[]=$info['id'];*/
					  $totalcancel[]=$info['cancelstatus'];
					  $totalestimateno[]=$info['estimateno'];
					  $totalestimatedate[]=$info['estimatedate'];
					  /* if($info['cancelstatus']=='1')
					  {
					  ?>
                      <tr style="text-decoration: line-through;">
                      <?php
					  }
					  else
					  { */
					  ?>
                      <tr>
                      <?php
					  /* } */
					  ?>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('estimateview.php?estimateno=<?=$info['estimateno']?>&estimatedate=<?=$info['estimatedate']?>', '_self')"  data-label="Date"><?=(($info['estimatedate']!='')?(date($date,strtotime($info['estimatedate']))):'')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('No', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('estimateview.php?estimateno=<?=$info['estimateno']?>&estimatedate=<?=$info['estimatedate']?>', '_self')"  data-label="Number"><?=$info['estimateno']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('estimateview.php?estimateno=<?=$info['estimateno']?>&estimatedate=<?=$info['estimatedate']?>', '_self')"  data-label="Name"><?=$info['customername']?></td>
                      <?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Term', $modulecolumns))) {
                                                ?>
                      <!-- <td onclick="window.open('estimateview.php?estimateno=<?=$info['estimateno']?>&estimatedate=<?=$info['estimatedate']?>', '_self')"  data-label="Estimate Term"><?=$info['estimateterm']?></td> -->
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount', $modulecolumns))) {
                                                ?>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('estimateview.php?estimateno=<?=$info['estimateno']?>&estimatedate=<?=$info['estimatedate']?>', '_self')"  data-label="Estimate Amount"><i class="fa fa-rupee"></i> <?=(((float)$info['grandtotal']-(float)$info['totalvatamount'])-(float)$info['roundoff'])?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Print', $modulecolumns))) {
                                                ?>
					  <!--td class="">&nbsp;
                        <a href="estimateedit.php?estimateno=<?=$info['estimateno']?>&estimatedate=<?=$info['estimatedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td-->
					  <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="estimateprint.php?estimateno=<?=$info['estimateno']?>&estimatedate=<?=$info['estimatedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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
                      <td><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Invoice Converted</a></td>
                      <?php
					  }
					  else
					  {
					  ?>
                      <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['estimateno']?>','<?=$info['estimatedate']?>','1')"> Convert Invoice</a></td>
                      <?php
					  }  */
					  ?>
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="estimateedit.php?estimateno=<?=$info['estimateno']?>&estimatedate=<?=$info['estimatedate']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                      
                    </tr>

					<?php
				  $count++;
				  }
}
?>