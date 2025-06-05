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
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Jobs' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
if (isset($_GET['term'])) {
$totalcancel=array();
				  $totaljobno=array();
				  $totaljobdate=array();
				  $sql=mysqli_query($con, "select jobdate, jobno, customername, jobterm, duedate, jobamount, cancelstatus, estimatestatus,id from pairjobs where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY jobdate, jobno order by jobdate desc, jobno desc limit ".$_GET['term'].",10");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
            $id=$info['id'];
					 /* $totalid[]=$info['id'];*/
					  $totalcancel[]=$info['cancelstatus'];
					  $totaljobno[]=$info['jobno'];
					  $totaljobdate[]=$info['jobdate'];
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
          $sqli=mysqli_query($con, "select * from pairjobs where franchisesession='".$_SESSION["franchisesession"]."' and id='$id'");
                 
                 
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
                      <td onclick="window.open('jobview.php?jobno=<?=$info['jobno']?>&jobdate=<?=$info['jobdate']?>', '_self')" data-label="Date"><?=(($info['jobdate']!='')?(date($date,strtotime($info['jobdate']))):'')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('No', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('jobview.php?jobno=<?=$info['jobno']?>&jobdate=<?=$info['jobdate']?>', '_self')" data-label="Number"><?=$info['jobno']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('jobview.php?jobno=<?=$info['jobno']?>&jobdate=<?=$info['jobdate']?>', '_self')" data-label="Name"><?=$info['customername']?></td>
                      <?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Term', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('jobview.php?jobno=<?=$info['jobno']?>&jobdate=<?=$info['jobdate']?>', '_self')" data-label="Term"><?=$info['jobterm']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount', $modulecolumns))) {
                                                ?>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('jobview.php?jobno=<?=$info['jobno']?>&jobdate=<?=$info['jobdate']?>', '_self')" data-label="Amount"><i class="fa fa-rupee"></i> <?=$info['jobamount']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Print', $modulecolumns))) {
                                                ?>
					  <!--td class="">&nbsp;
                        <a href="jobedit.php?jobno=<?=$info['jobno']?>&jobdate=<?=$info['jobdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td-->
					  <?php
					 /*  if(($info['estimatestatus']=='1')||($info['cancelstatus']=='1'))
					  {
					  ?>
					  
<!-- <td data-label="Edit"></td> -->
					  <?php
					  // }
					  else
					  {
?>
<!-- <td data-label="Edit" class="">&nbsp;
                        <a href="jobedit.php?jobno=<?=$info['jobno']?>&jobdate=<?=$info['jobdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit <?=$pmsaleorderch?>">
                          Edit
                        </a>
                      </td> -->
<?php
					  } */
					  
					  ?>
					  <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="jobprint.php?jobno=<?=$info['jobno']?>&jobdate=<?=$info['jobdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit <?=$pmsaleorderch?>">
                          Print
                        </a>
                      </td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Quotation', $modulecolumns))) {
                                                ?>
					  
					  <?php
					  if($info['cancelstatus']=='1')
					  {
					  ?>
                      <td data-label="<?= $infomainaccessquotation['modulename'] ?>"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Converted</a></td>
                      <?php
					  }
					  else
					  {
					  ?>
                      <td data-label="<?= $infomainaccessquotation['modulename'] ?>"><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['jobno']?>','<?=$info['jobdate']?>','1')"> Convert</a></td>
                      <?php
					  } 
					  ?>
                      <?php
                                            }
                                                ?>
                      
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="jobedit.php?jobno=<?=$info['jobno']?>&jobdate=<?=$info['jobdate']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                    </tr>

					<?php
				  $count++;
				  }
}
?>