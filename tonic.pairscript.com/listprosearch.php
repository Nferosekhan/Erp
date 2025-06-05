<?php
include('lcheck.php');
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Products' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd-m-Y';
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
if (isset($_GET['term'])) {
$count=1;
                  $sqli=mysqli_query($con, "select t1.*,SUM(t2.quantity) as stockonproduct from pairproducts t1,pairbatch t2 where t1.createdid='$companymainid' and ((t1.franchisesession='".$_SESSION["franchisesession"]."' and t1.pvisiblity='PRIVATE') or t1.pvisiblity='PUBLIC') and t1.itemmodule='Products' and t2.createdid='$companymainid' and t2.franchisesession='".$_SESSION["franchisesession"]."' and t2.productid=t1.id ".$_GET['typesforlisting']." GROUP BY t1.id ".$_GET['typesforlistingstock']."  order by t1.productname asc limit ".$_GET['term'].",".$_GET['limitings']."");
                 
                 
                  while($info=mysqli_fetch_array($sqli))
                  {
                      $sqlias=mysqli_query($con, "select salecost from pairprosale where productid='".$info['id']."'");
                      if(mysqli_num_rows($sqlias)>0)
                      {
                            $infoas=mysqli_fetch_array($sqlias);
                            $salecost=(float)$infoas['salecost'];
                      }
                      else
                      {
                          $salecost=0;
                      }
                      $sqlitax=mysqli_query($con, "select * from pairtaxrates where id='".$info['intratax']."'");
                      if(mysqli_num_rows($sqlitax)>0)
                      {
                      $infotax=mysqli_fetch_array($sqlitax);
                      $tax=(float)$infotax['tax'];
                      $taxname=$infotax['taxname'];
                      }
                      else
                      {
                          $tax=0;
                          $taxname=0;
                      }
                      ?>
                                        <tr style="font-size: 0.775rem !important;"
 onclick="window.open('productview.php?id=<?=$info['id']?>', '_self')">
<?php
         // if ((in_array('Name', $modulecolumns))) {
        ?>
                                            <td data-label="Name"><span style="color:#1878F1" class="mb-0 text-sm"><?=$info['productname']?></span></td>
                                            <?php
          // }
          ?>
<?php
         if ((in_array('Code', $modulecolumns))) {
        ?>
                                            <td data-label="Code"><?=$info['codetags']?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Category', $modulecolumns))) {
        ?>
                                            <td data-label="<?=$access['txtnamecategory']?>"><?=$info['category']?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Unit', $modulecolumns))) {
        ?>
                                            <td data-label="Unit"><?=$info['defaultunit']?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Description', $modulecolumns))) {
        ?>
                                            <td data-label="Description"><?=$info['description']?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Delivery', $modulecolumns))) {
        ?>
                                            <td data-label="Delivery"><?=$info['delivery']?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Sale Price', $modulecolumns))) {
        ?>
                                            <td data-label="Sale Price"><?=number_format((float)$salecost,2,".","")?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Intra Tax', $modulecolumns))) {
        ?>
                                            <td data-label="Intratax">
                                                 <?php
           if ($info['intratax']!='null') {
           ?>
                                                <?= $taxname ?> - <?=number_format((float)$tax,2,".","")?> 
                                                <?php
       }
       ?>
                                            </td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Visibility', $modulecolumns))) {
        ?>
                                            <td data-label="Visibility"><?=$info['pvisiblity']?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Stock On Hand', $modulecolumns))) {
        ?>
                      <td data-label="Stock" class="<?=(($info['stockonproduct']>0)?'text-success':'text-danger')?>">&nbsp;<?=(($info['stockonproduct']>0)?$info['stockonproduct']:$info['stockonproduct'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Status', $modulecolumns))) {
        ?>
                                            <td data-label="Status">
                                            <?php if($info['isactive']=='0')
                                            {
                                            ?>
                                            <span class="badge badge-sm mybadge" style="text-transform:none; font-weight:normal">Active</span>
                                            <?php           
                                            }
                                            else
                                            {
                                              ?>
                                            <span class="badge badge-sm mybadge bg-danger" style="text-transform:none; font-weight:normal">Inactive</span>
                                            <?php
                                            }
                                            ?></td>
           <?php
          }
          ?>
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="productedit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                                        </tr>
                                    <?php
                                        $count++;
                                      }
}
?>