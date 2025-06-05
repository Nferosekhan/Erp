<?php
include('lcheck.php');
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Invoices' order by id  asc");
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
          $totalinvoiceno=array();
          $totalinvoicedate=array();
          $sql=mysqli_query($con, "select MAX(id) AS id,invoicedate, invoiceno, customername, invoiceterm, duedate, invoiceamount, cancelstatus, customerid from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' ".urldecode($_GET['typesforlisting'])." GROUP BY invoicedate, invoiceno order by invoicedate DESC, invoicetime DESC,ordering DESC limit ".$_GET['term'].",".$_GET['limitings']."");
          
          $count=1;
          $invoiceamount=0;
  $balanceamount=0;
  $currentamount=0;
  $overdueamount=0;
  
          
          while($info=mysqli_fetch_array($sql))
          {
$invoiceamount+=(float)$info['invoiceamount'];
                                            $currentamount=(float)$info['invoiceamount'];
                                            $paidamount=0;
                                            $refundamount=0;
                                            $currentbalance=0;
                                            $sqlsalespays=$con->prepare("SELECT amount FROM pairsalespayhistory WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? ORDER BY id DESC");
                                            $sqlsalespays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $info['invoiceno'], $info['invoicedate']);
                                            $sqlsalespays->execute();
                                            $sqlsalespay = $sqlsalespays->get_result();
                                            while($infosalespay=$sqlsalespay->fetch_array()){
                                                $paidamount+=(float)$infosalespay['amount'];
                                            }
                                            $currentbalance=((float)$info['invoiceamount']-$paidamount);
                                            $balanceamount+=((float)$info['invoiceamount']-$paidamount);
                                            $totalcancel[]=$info['cancelstatus'];
                                            $totalinvoiceno[]=$info['invoiceno'];
                                            $totalinvoicedate[]=$info['invoicedate'];
                                            $sqlsantss=$con->prepare("SELECT invoiceamount, invoicepaymentreceived, grandtotal,creditnotedate, creditnoteno FROM paircreditnotes WHERE franchisesession=? AND createdid=? AND invoiceno=? AND invoicedate=? AND customerid=? GROUP BY creditnotedate, creditnoteno ORDER BY creditnotedate ASC, creditnoteno ASC");
                                        $sqlsantss->bind_param("sssss", $_SESSION['franchisesession'], $companymainid, $info['invoiceno'], $info['invoicedate'], $info['customerid']);
                                        $sqlsantss->execute();
                                        $sqlsants = $sqlsantss->get_result();
                                        if($sqlsants->num_rows>0){
                                            while($infoantss=$sqlsants->fetch_array()){
                                                $currentbalance=((float)$currentbalance-$infoantss['grandtotal']);
                                                $paidamountcr=0;
                                                        $sqlcrpays=$con->prepare("SELECT amount FROM paircreditnotepayhistory WHERE franchisesession=? AND createdid=? AND creditnoteno=? AND creditnotedate=? ORDER BY id DESC");
                                                        $sqlcrpays->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $infoantss['creditnoteno'], $infoantss['creditnotedate']);
                                                        $sqlcrpays->execute();
                                                        $sqlcrpay = $sqlcrpays->get_result();
                                                        while($infocrpay=$sqlcrpay->fetch_array()){
                                                            $paidamountcr+=(float)$infocrpay['amount'];
                                                        }
                                                        $currentbalance=((float)$currentbalance+$paidamountcr);
                                                        $refundamount=((float)$paidamountcr);
                                            }
                                        }
                                        if ($currentbalance<0) {
                                            $currentbalance = 0;
                                        }
                                            if($info['cancelstatus']=='1'){
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
                      <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Date"><?=(($info['invoicedate']!='')?(date($date,strtotime($info['invoicedate']))):'')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('No', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Number"><?=$info['invoiceno']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Name"><?=$info['customername']?></td>
                      <?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Term', $modulecolumns))) {
                                                ?>
                      <!-- <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Invoice Term"><?=$info['invoiceterm']?></td> -->
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount', $modulecolumns))) {
                                                ?>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Amount"><i class="fa fa-rupee"></i> <?=number_format((float)$info['invoiceamount'],2,'.','')?></td>
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
              <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Status" style="color:#bbbbbb;text-decoration: none;">Void</td>
              <?php
            }
            else
            {
            if($currentbalance==0)
            {
              ?>
              <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Status" class="text-success" style="text-decoration: none;">Paid</td>
              <?php
            }
            else
            {
              if(($paidamount - $refundamount)<=0)
                {
                  ?>
                  <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Status" class="text-danger" style="text-decoration: none;">Un Paid</td>
                  <?php
                }
                else
                {
                  ?>
                  <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Status" class="text-warning" style="text-decoration: none;">Partially Paid</td>
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
            <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Balance"><i class="fa fa-rupee"></i> <?=number_format((float)$currentbalance,2,'.','')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Print', $modulecolumns))) {
                                                ?>
            
            
            <!--td class="">&nbsp;
                        <a href="invoiceedit.php?invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td-->
            <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="invoiceprint.php?invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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
                      <!-- <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['invoiceno']?>','<?=$info['invoicedate']?>','0')"><i class="fa fa-check"></i> Enable Invoice</a></td> -->
                      <?php
            // }
            // else
            // {
            ?>
                      <!-- <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['invoiceno']?>','<?=$info['invoicedate']?>','1')"><i class="fa fa-times"></i> Cancel Invoice</a></td> -->
                      <?php
            // } */
            ?>
                      
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="invoiceedit.php?invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                    </tr>

          <?php
          $count++;
          }
        }
?>