<?php
include('lcheck.php');
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Sales Orders' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$sqlismainaccessinvoices=$con->prepare("SELECT * FROM pairmainaccess WHERE userid=? AND moduletype='Invoices' ORDER BY id ASC");
$sqlismainaccessinvoices->bind_param("i", $companymainid);
$sqlismainaccessinvoices->execute();
$sqlismainaccessinvoice = $sqlismainaccessinvoices->get_result();
$infomainaccessinvoice=$sqlismainaccessinvoice->fetch_array();
$sqlismainaccessinvoice->close();
$sqlismainaccessinvoices->close();
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
                           $totalsalesorderno=array();
                           $totalsalesorderdate=array();
                           $sqls=$con->prepare("SELECT tdelete,convertstatus,id,salesorderdate, salesorderno, customername, salesorderterm, duedate, salesorderamount, cancelstatus FROM pairsalesorders WHERE franchisesession=? AND createdid=? ".$_GET['typesforlisting']." GROUP BY salesorderdate, salesorderno ORDER BY salesorderdate DESC, salesordertime DESC, ordering DESC LIMIT ".$_GET['term'].",".$_GET['limitings']."");
                      $sqls->bind_param("ss", $_SESSION['franchisesession'], $companymainid);
                      $sqls->execute();
                      $sql = $sqls->get_result();
                           $count=1;
                           $salesorderamount=0;
                           $balanceamount=0;
                           $currentamount=0;
                           $overdueamount=0;
                           while($info=$sql->fetch_array()){
                              $salesorderamount+=(float)$info['salesorderamount'];
                              $currentamount=(float)$info['salesorderamount'];
                              $paidamount=0;
                              $currentbalance=0;
                              $sqlsalespays=$con->prepare("SELECT amount FROM pairsalespayhistory WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? ORDER BY id DESC");
                        $sqlsalespays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $info['salesorderno'], $info['salesorderdate']);
                        $sqlsalespays->execute();
                        $sqlsalespay = $sqlsalespays->get_result();
                              while($infosalespay=$sqlsalespay->fetch_array()){
                                $paidamount+=(float)$infosalespay['amount'];
                              }
                              $currentbalance=((float)$info['salesorderamount']-$paidamount);
                              $balanceamount+=((float)$info['salesorderamount']-$paidamount);
                              $totalcancel[]=$info['cancelstatus'];
                              $totalsalesorderno[]=$info['salesorderno'];
                              $totalsalesorderdate[]=$info['salesorderdate'];
                              if($info['cancelstatus']=='1'){
                          ?>
                            <!--tr style="text-decoration: line-through;"-->
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
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Date">
                        <?=(($info['salesorderdate']!='')?(date($date,strtotime($info['salesorderdate']))):'&nbsp;')?>
                      </td>
                    <?php
                      }
                      if ((in_array('No', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Number">
                        <?=(($info['salesorderno']=='')?'&nbsp;':'')?><?=$info['salesorderno']?>
                      </td>
                    <?php
                      }
                      // if ((in_array('Customer Name', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Name">
                        <?=(($info['customername']=='')?'&nbsp;':'')?><?=$info['customername']?>
                      </td>
                    <?php
                      // }
                      if ((in_array('Amount', $modulecolumns))) {
                    ?>
                              <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Amount">
                        <i class="fa fa-rupee"></i> <?=number_format((float)$info['salesorderamount'],2,'.','')?>
                      </td>
                    <?php
                      }
                      if ((in_array('Status', $modulecolumns))) {
                        if($info['tdelete']=='1'){
                    ?>
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Status" style="color:#bbbbbb;text-decoration: none;">
                        Deleted
                      </td>
                    <?php
                            }
                        else{
                          if($info['convertstatus']=='0'){
                    ?>
                      <td data-label="Status">
                        <a href="converttoinvoice.php?salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>&type=salesorder" class="text-warning">
                          <i class="fa fa-file-import"></i> Convert To <?=$infomainaccessinvoice['modulename']?>
                        </a>
                      </td>
                    <?php
                          }
                          else{
                    ?>
                      <td data-label="Status" onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')">
                        <a href="#" class="text-success">
                          <i class="fa fa-file-import"></i> <?=$infomainaccessinvoice['modulename']?> Converted
                        </a>
                      </td>
                    <?php
                          }
                        }
                      }
                      if ((in_array('Balance', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('salesorderview.php?id=<?=$info['id']?>&salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>', '_self')"  data-label="Balance">
                        <i class="fa fa-rupee"></i> <?=number_format((float)$currentbalance,2,'.','')?>
                      </td>
                    <?php
                      }
                      if ((in_array('Print', $modulecolumns))) {
                    ?>
                      <td data-label="Print" class="">&nbsp;
                                <a target="_blank" href="salesorderprint.php?salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                  Print
                                </a>
                              </td>
                    <?php
                      }
                      if ((in_array('Edit', $modulecolumns))) {
                    ?>
                      <td data-label="Edit">
                        <a href="salesorderedit.php?salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>" class="text-secondary font-weight-bold text-xs">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                      </td>
                    <?php
                      }
                    ?> 
                      <!-- <td data-label="Convert">
                        <?php
                          if ($info['convertstatus']=='0') {
                        ?>
                        <a href="converttoinvoice.php?salesorderno=<?=$info['salesorderno']?>&salesorderdate=<?=$info['salesorderdate']?>&type=salesorder" class="text-warning">
                          <i class="fa fa-file-import"></i> Convert To <?=$infomainaccessinvoice['modulename']?>
                        </a>
                        <?php
                          }
                          else{
                        ?>
                        <a href="#" class="text-success">
                          <i class="fa fa-file-import"></i> <?=$infomainaccessinvoice['modulename']?> Converted
                        </a>
                        <?php
                          }
                        ?>
                      </td> -->
                            </tr>
          <?php
          $count++;
          }
        }
?>