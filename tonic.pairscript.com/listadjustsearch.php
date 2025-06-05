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
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Inventory Adjustments' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
if (isset($_GET['term'])) {
$totalcancel=array();
                  $totaladjustmentno=array();
                  $totaladjustmentdate=array();
                  $sql=mysqli_query($con, "select id, createdby, adjustmentdate, adjustmentno, chartaccountname, adjustmentreason,  cancelstatus, estimatestatus, description, reference,privateid from pairadjustments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' ".$_GET['typesforlisting']." GROUP BY adjustmentdate, adjustmentno order by adjustmentdate desc, adjustmentno desc limit ".$_GET['term'].",".$_GET['limitings']."");
                  
                  $count=1;
                  while($info=mysqli_fetch_array($sql))
                  {
                      ?>


                      <tr>
                                                <?php
                                            if ((in_array('Inventory Adjustments Date', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('adjustmentview.php?adjustmentno=<?=$info['adjustmentno']?>&adjustmentdate=<?=$info['adjustmentdate']?>', '_self')" data-label="Date"><?=(($info['adjustmentdate']!='')?(date('d/m/Y',strtotime($info['adjustmentdate']))):'')?></td>
                       <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Inventory Adjustments No', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('adjustmentview.php?adjustmentno=<?=$info['privateid']?>&adjustmentdate=<?=$info['adjustmentdate']?>', '_self')" data-label="Number"><?=$info['privateid']?></td>
                       <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Reason', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('adjustmentview.php?adjustmentno=<?=$info['adjustmentno']?>&adjustmentdate=<?=$info['adjustmentdate']?>', '_self')" data-label="Reason"><?=$info['adjustmentreason']?></td>
                       <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Description', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('adjustmentview.php?adjustmentno=<?=$info['adjustmentno']?>&adjustmentdate=<?=$info['adjustmentdate']?>', '_self')" data-label="Description"><?=$info['description']?></td>
                       <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Reference', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('adjustmentview.php?adjustmentno=<?=$info['adjustmentno']?>&adjustmentdate=<?=$info['adjustmentdate']?>', '_self')" data-label="Reference"><?=$info['reference']?></td>
                       <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Adjusted By', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('adjustmentview.php?adjustmentno=<?=$info['adjustmentno']?>&adjustmentdate=<?=$info['adjustmentdate']?>', '_self')" data-label="Adjusted by"><?=$info['createdby']?></td>
                       <?php
                                            }
                                                ?>
                      
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="adjustmentedit.php?adjustmentno=<?=$info['adjustmentno']?>&adjustmentdate=<?=$info['adjustmentdate']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                    </tr>

                    <?php
                  $count++;
                  }
}
?>