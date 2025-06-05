<?php
include('lcheck.php');
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Sales Returns' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
if (isset($_GET['term'])) {
          $totalcancel=array();
          $totalsalesreturnno=array();
          $totalsalesreturndate=array();
          $sql=mysqli_query($con, "select id,salesreturndate, salesreturnno, customername, salesreturnterm, duedate, salesreturnamount, cancelstatus from pairsalesreturns where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' ".urldecode($_GET['typesforlisting'])." GROUP BY salesreturndate, salesreturnno order by salesreturndate DESC, salesreturntime DESC,ordering DESC limit ".$_GET['term'].",".$_GET['limitings']."");
          
          $count=1;
          $salesreturnamount=0;
  $balanceamount=0;
  $currentamount=0;
  $overdueamount=0;
  
          
          while($info=mysqli_fetch_array($sql))
          {
        
        
        $salesreturnamount+=(float)$info['salesreturnamount'];
        $currentamount=(float)$info['salesreturnamount'];
        $paidamount=0;
        $currentbalance=0;
        $sqlsalespay=mysqli_query($con,"select amount from pairsalesreturnpayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and salesreturnno='".$info['salesreturnno']."' and salesreturndate='".$info['salesreturndate']."' order by id desc");
        while($infosalespay=mysqli_fetch_array($sqlsalespay))
        {
          $paidamount+=(float)$infosalespay['amount'];
        }
        $currentbalance=((float)$info['salesreturnamount']-$paidamount);
        $balanceamount+=((float)$info['salesreturnamount']-$paidamount);

        
           /* $totalid[]=$info['id'];*/
            $totalcancel[]=$info['cancelstatus'];
            $totalsalesreturnno[]=$info['salesreturnno'];
            $totalsalesreturndate[]=$info['salesreturndate'];
            if($info['cancelstatus']=='1')
            {
            ?>
                      <!--tr style="text-decoration: line-through;"-->
                      <tr>
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
                      <td onclick="window.open('salesreturnview.php?id=<?=$info['id']?>&salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>', '_self')"  data-label="Date"><?=(($info['salesreturndate']!='')?(date($date,strtotime($info['salesreturndate']))):'')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('No', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('salesreturnview.php?id=<?=$info['id']?>&salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>', '_self')"  data-label="Number"><?=$info['salesreturnno']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('salesreturnview.php?id=<?=$info['id']?>&salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>', '_self')"  data-label="Name"><?=$info['customername']?></td>
                      <?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Term', $modulecolumns))) {
                                                ?>
                      <!-- <td onclick="window.open('salesreturnview.php?id=<?=$info['id']?>&salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>', '_self')"  data-label="Sales Return Term"><?=$info['salesreturnterm']?></td> -->
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount', $modulecolumns))) {
                                                ?>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('salesreturnview.php?id=<?=$info['id']?>&salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>', '_self')"  data-label="Amount"><i class="fa fa-rupee"></i> <?=number_format((float)$info['salesreturnamount'],2,'.','')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Status', $modulecolumns))) {
                                                ?>
            
            <?php 
            if($info['cancelstatus']=='1')
            {
              ?>
              <td onclick="window.open('salesreturnview.php?id=<?=$info['id']?>&salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>', '_self')"  data-label="Status" style="color:#bbbbbb;text-decoration: none;">Void</td>
              <?php
            }
            else
            {
            if($currentbalance==0)
            {
              ?>
              <td onclick="window.open('salesreturnview.php?id=<?=$info['id']?>&salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>', '_self')"  data-label="Status" class="text-success" style="text-decoration: none;">Paid</td>
              <?php
            }
            else
            {
              if($currentbalance==$currentamount)
                {
                  ?>
                  <td onclick="window.open('salesreturnview.php?id=<?=$info['id']?>&salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>', '_self')"  data-label="Status" class="text-danger" style="text-decoration: none;">Pending</td>
                  <?php
                }
                else
                {
                  ?>
                  <td onclick="window.open('salesreturnview.php?id=<?=$info['id']?>&salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>', '_self')"  data-label="Status" class="text-warning" style="text-decoration: none;">Partially Paid</td>
                  <?php
                }
            }
            }
            ?>
            
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Balance', $modulecolumns))) {
                                                ?>
            <td onclick="window.open('salesreturnview.php?id=<?=$info['id']?>&salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>', '_self')"  data-label="Balance"><i class="fa fa-rupee"></i> <?=number_format((float)$currentbalance,2,'.','')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Print', $modulecolumns))) {
                                                ?>
            
            
            <!--td class="">&nbsp;
                        <a href="salesreturnedit.php?salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td-->
            <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="salesreturnprint.php?salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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
                      <!-- <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['salesreturnno']?>','<?=$info['salesreturndate']?>','0')"><i class="fa fa-check"></i> Enable Sales Return</a></td> -->
                      <?php
            // }
            // else
            // {
            ?>
                      <!-- <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['salesreturnno']?>','<?=$info['salesreturndate']?>','1')"><i class="fa fa-times"></i> Cancel Sales Return</a></td> -->
                      <?php
            // } */
            ?>
                      
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="salesreturnedit.php?salesreturnno=<?=$info['salesreturnno']?>&salesreturndate=<?=$info['salesreturndate']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                    </tr>

          <?php
          $count++;
          }
        }
?>