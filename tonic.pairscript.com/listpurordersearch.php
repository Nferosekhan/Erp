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
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Purchase Orders' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
if (isset($_GET['term'])) {
$totalcancel=array();
				  $totalpurchaseorderno=array();
				  $totalpurchaseorderdate=array();
				  $sql=mysqli_query($con, "select purchaseorderdate, purchaseorderno, vendorname, purchaseorderterm, duedate, purchaseorderamount, cancelstatus, estimatestatus,id from pairpurchaseorders where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY purchaseorderdate, purchaseorderno order by purchaseorderdate desc, purchaseorderno desc limit ".$_GET['term'].",10");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
            $id=$info['id'];
					 /* $totalid[]=$info['id'];*/
					  $totalcancel[]=$info['cancelstatus'];
					  $totalpurchaseorderno[]=$info['purchaseorderno'];
					  $totalpurchaseorderdate[]=$info['purchaseorderdate'];
					  /* if($info['cancelstatus']=='1')
					  {
					  ?>
                      <tr style="text-decoration: line-through;">
                      <?php
					  }
					  else
					  { */
					  ?>



                 <?php
        
          $count=1;
          $sqli=mysqli_query($con, "select * from pairpurchaseorders where franchisesession='".$_SESSION["franchisesession"]."' and id='$id'");
                 
                 
                  while($infop=mysqli_fetch_array($sqli))
          {
            // $sqlias=mysqli_query($con, "select salecost from pairprosale where productid='".$info['id']."'");
            // $infoas=mysqli_fetch_array($sqlias);
            ?>

                      <tr>

             <?php
          $count++;
                  }
                
               
                  
          ?>

                      <?php
					  /* } */
					  ?>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('purchaseorderview.php?purchaseorderno=<?=$info['purchaseorderno']?>&purchaseorderdate=<?=$info['purchaseorderdate']?>', '_self')" data-label="Date"><?=(($info['purchaseorderdate']!='')?(date($date,strtotime($info['purchaseorderdate']))):'')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('No', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('purchaseorderview.php?purchaseorderno=<?=$info['purchaseorderno']?>&purchaseorderdate=<?=$info['purchaseorderdate']?>', '_self')" data-label="Number"><?=$info['purchaseorderno']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Name', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('purchaseorderview.php?purchaseorderno=<?=$info['purchaseorderno']?>&purchaseorderdate=<?=$info['purchaseorderdate']?>', '_self')" data-label="Name"><?=$info['vendorname']?></td>
                      <?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Term', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('purchaseorderview.php?purchaseorderno=<?=$info['purchaseorderno']?>&purchaseorderdate=<?=$info['purchaseorderdate']?>', '_self')" data-label="Term"><?=$info['purchaseorderterm']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount', $modulecolumns))) {
                                                ?>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('purchaseorderview.php?purchaseorderno=<?=$info['purchaseorderno']?>&purchaseorderdate=<?=$info['purchaseorderdate']?>', '_self')" data-label="Amount"><i class="fa fa-rupee"></i> <?=$info['purchaseorderamount']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
					  <!--td class="">&nbsp;
                        <a href="purchaseorderedit.php?purchaseorderno=<?=$info['purchaseorderno']?>&purchaseorderdate=<?=$info['purchaseorderdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td-->
					  <?php
					  // if(($info['estimatestatus']=='1')||($info['cancelstatus']=='1'))
					  // {
					  ?>
					  
<!-- <td data-label="Edit"></td> -->
					  <?php
					  // }
					  // else
					  // {
?>
<!-- <td data-label="Edit" class="">&nbsp;
                        <a href="purchaseorderedit.php?purchaseorderno=<?=$info['purchaseorderno']?>&purchaseorderdate=<?=$info['purchaseorderdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Purchase Order">
                          Edit
                        </a>
                      </td> -->
<?php
					  // }
					  
					  ?>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Print', $modulecolumns))) {
                                                ?>
					  <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="purchaseorderprint.php?purchaseorderno=<?=$info['purchaseorderno']?>&purchaseorderdate=<?=$info['purchaseorderdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Purchase Order">
                          Print
                        </a>
                      </td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Bill', $modulecolumns))) {
                                                ?>
					  
                      <?php
					  /* if($info['estimatestatus']=='1')
					  {
					  ?>
                      <td><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Converted</a></td>
                      <?php
					  // }
					  // else
					  // {
					  ?>
                      <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem1('<?=$info['purchaseorderno']?>','<?=$info['purchaseorderdate']?>','1')"> Convert</a></td>
                      <?php
					  // } */
					  ?>
					  <?php
					  if($info['cancelstatus']=='1')
					  {
					  ?>
                      <td data-label="<?= $infomainaccessbill['modulename'] ?>"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Converted</a></td>
                      <?php
					  }
					  else
					  {
					  ?>
                      <td data-label="<?= $infomainaccessbill['modulename'] ?>"><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['purchaseorderno']?>','<?=$info['purchaseorderdate']?>','<?=$info['purchaseorderamount']?>','1')"> Convert</a></td>
                      <?php
					  }  
					  ?>
                      <?php
                                            }
                                                ?>
                      
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="purchaseorderedit.php?purchaseorderno=<?=$info['purchaseorderno']?>&purchaseorderdate=<?=$info['purchaseorderdate']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                    </tr>

					<?php
				  $count++;
				  }
}
?>