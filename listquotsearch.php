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
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Quotations' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
if (isset($_GET['term'])) {
$totalcancel=array();
				  $totalquotationno=array();
				  $totalquotationdate=array();
				  $sql=mysqli_query($con, "select quotationdate, quotationno, customername, quotationterm, duedate, quotationamount, cancelstatus, estimatestatus, proformastatus, id from pairquotations where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY quotationdate, quotationno order by quotationdate desc, quotationno desc limit ".$_GET['term'].",10");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
            $id=$info['id'];
					 /* $totalid[]=$info['id'];*/
					  $totalcancel[]=$info['cancelstatus'];
					  $totalquotationno[]=$info['quotationno'];
					  $totalquotationdate[]=$info['quotationdate'];
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
          $sqli=mysqli_query($con, "select * from pairquotations where franchisesession='".$_SESSION["franchisesession"]."' and id='$id'");
                 
                 
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
                      <td onclick="window.open('quotationview.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Date"><?=(($info['quotationdate']!='')?(date($date,strtotime($info['quotationdate']))):'')?></td>
                      <?php
                                          }
                                            ?>
                                            <?php
                                          if ((in_array('No', $modulecolumns))) {
                                            ?>
                      <td onclick="window.open('quotationview.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Number"><?=$info['quotationno']?></td>
                      <?php
                                          }
                                            ?>
                                            <?php
                                          // if ((in_array('Customer Name', $modulecolumns))) {
                                            ?>
                      <td onclick="window.open('quotationview.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Name"><?=$info['customername']?></td>
                      <?php
                                          // }
                                            ?>
                                            <?php
                                          if ((in_array('Term', $modulecolumns))) {
                                            ?>
                      <!-- <td onclick="window.open('quotationview.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Quotation Term"><?=$info['quotationterm']?></td> -->
                      <?php
                                          }
                                            ?>
                                            <?php
                                          if ((in_array('Amount', $modulecolumns))) {
                                            ?>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('quotationview.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Quotation Amount"><i class="fa fa-rupee"></i> <?=$info['quotationamount']?></td>
					  <!--td class="">&nbsp;
                        <a href="quotationedit.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td-->
                      <?php
                                          }
                                            ?>
                                            <?php
                                          if ((in_array('Edit', $modulecolumns))) {
                                            ?>
                                            <?php 
                             if (($infomainaccessuser['useraccessedit']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
                                 ?>
					  <?php
					  if(($info['estimatestatus']=='1')||($info['proformastatus']=='1')||($info['cancelstatus']=='1'))
					  {
					  ?>
					  
<!-- <td data-label="Edit"></td> -->
					  <?php
					  }
					  else
					  {
?>
<!-- <td data-label="Edit" class="">&nbsp;
                        <a href="quotationedit.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Quotation">
                          Edit
                        </a>
                      </td> -->
<?php
					  }
					  ?>
            <?php
                                          }
                                            ?>
                                            <?php
            }
            ?>
                                            <?php
                                          if ((in_array('Print', $modulecolumns))) {
                                            ?>
					  <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="quotationprint.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Quotation">
                          Print
                        </a>
                      </td>
                      <?php
                                          }
                                            ?>
                                            <?php
                                          if ((in_array('Proforma Invoice', $modulecolumns))) {
                                            ?>
					  
                      <?php
					 /*  if($info['estimatestatus']=='1')
					  {
					  ?>
                      <td data-label="<?= $infomainaccessproforma['modulename'] ?>"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Estimate Converted</a></td>
                      <?php
					  }
					  else
					  {
					  ?>
                      <td data-label="<?= $infomainaccessproforma['modulename'] ?>"><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem1('<?=$info['quotationno']?>','<?=$info['quotationdate']?>','1')"> Convert Estimate</a></td>
                      <?php
					  }  */
					  ?>
					  
					  <?php
					  if($info['proformastatus']=='1')
					  {
					  ?>
                      <td data-label="<?= $infomainaccessproforma['modulename'] ?>"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Converted</a></td>
                      <?php
					  }
					  else
					  {
						  if(($info['estimatestatus']=='0')&&($info['proformastatus']=='0')&&($info['cancelstatus']=='0'))
						  {
						  ?>
						  <td data-label="<?= $infomainaccessproforma['modulename'] ?>"><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem2('<?=$info['quotationno']?>','<?=$info['quotationdate']?>','1')"> Convert</a></td>
						  <?php
						  }
						  else
						  {
							  ?>
							  <td></td>
							  <?php
						  }
						  
					  } 
					  ?>
            <?php
                                          }
                                            ?>
                                            <?php
                                          if ((in_array('Invoice', $modulecolumns))) {
                                            ?>
					  <?php
					  if($info['cancelstatus']=='1')
					  {
					  ?>
                      <td data-label="<?= $infomainaccessinvoice['modulename'] ?>"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Converted</a></td>
                      <?php
					  }
					  else
					  {
						  if(($info['estimatestatus']=='0')&&($info['proformastatus']=='0')&&($info['cancelstatus']=='0'))
						  {
					  ?>
                      <td data-label="<?= $infomainaccessinvoice['modulename'] ?>"><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['quotationno']?>','<?=$info['quotationdate']?>','<?=$info['quotationamount']?>','1')"> Convert</a></td>
                      <?php
						  }
						   else
						  {
							  ?>
							  <td></td>
							  <?php
						  }
							  
					  } 
					  ?>
            <?php
                                          }
                                            ?>
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="quotationedit.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                      
                    </tr>

					<?php
				  $count++;
				  }
}
?>