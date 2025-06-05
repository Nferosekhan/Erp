<?php
include('lcheck.php');
if ($_GET['term']=='products') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Products' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$count=1;
if($_GET['searchTerm']==''){
  $sqli = mysqli_query($con,"select * FROM pairproducts  WHERE  productname!='' and createdid='$companymainid' and ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and itemmodule='Products' ORDER BY productname ASC limit ".(($access['propageload']=='pagenum')?'10':'15')."");
}else{
  $sqli = mysqli_query($con,"select * FROM pairproducts  WHERE createdid='$companymainid' and ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and itemmodule='Products' and LOWER(productname) like LOWER('%".$_GET['searchTerm']."%') ORDER BY productname ASC limit 50");
}
                 
                 
                  while($info=mysqli_fetch_array($sqli))
                  {
            $sqlstocktotal=mysqli_query($con,"SELECT id, batch, expdate, productrate, mrp, noofpacks, sum(quantity) as total, mrp, vat FROM pairbatch where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='".$info['id']."'");
$infostocktotal=mysqli_fetch_array($sqlstocktotal);
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
                      <td data-label="Stock" class="<?=(($infostocktotal['total']>0)?'text-success':'text-danger')?>">&nbsp;<?=(($infostocktotal['total']>0)?$infostocktotal['total']:$infostocktotal['total'])?></td>
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
if ($_GET['term']=='services') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Services' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$count=1;
if($_GET['searchTerm']==''){
  $sqli = mysqli_query($con,"select * FROM pairproducts  WHERE  productname!='' and createdid='$companymainid' and ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and itemmodule='Services' ORDER BY productname ASC limit ".(($access['servpageload']=='pagenum')?'10':'15')."");
}else{
  $sqli = mysqli_query($con,"select * FROM pairproducts  WHERE createdid='$companymainid' and ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and itemmodule='Services' and LOWER(productname) like LOWER('%".$_GET['searchTerm']."%') ORDER BY productname ASC limit 50");
}
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
 onclick="window.open('serviceview.php?id=<?=$info['id']?>', '_self')">
 <?php
         // if ((in_array('Name', $modulecolumns)))
         // {
        ?>
                                            <td data-label="Name"><span style="color:#1878F1" class="mb-0 text-sm"><?=(($info['productname']=='')?'&nbsp;':$info['productname'])?></span></td>
                                            <?php
          // }
          ?>
<?php
         if ((in_array('Code', $modulecolumns)))
         {
        ?>
                                            <td data-label="Code"><?=(($info['codetags']=='')?'&nbsp;':$info['codetags'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Category', $modulecolumns)))
         {
        ?>
                                            <td data-label="Category"><?=(($info['category']==' ')?'&nbsp;':$info['category'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Unit', $modulecolumns))) 
         {
        ?>
                                            <td data-label="Unit"><?=(($info['defaultunit']=='')?'&nbsp;':$info['defaultunit'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Description', $modulecolumns)))
         {
        ?>
                                            <td data-label="Description"><?=(($info['description']=='')?'&nbsp;':$info['description'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Delivery', $modulecolumns)))
         {
        ?>
                                            <td data-label="Delivery"><?=(($info['delivery']=='')?'&nbsp;':$info['delivery'])?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Sale Price', $modulecolumns)))
         {
        ?>
                                            <td data-label="Sale Price">&nbsp;<?=number_format((float)$salecost,2,".","")?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Intra Tax', $modulecolumns)))
         {
        ?>
                                            <td data-label="Intratax"><?=(($info['intratax']=='null')?'&nbsp;':'')?>
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
         if ((in_array('Visibility', $modulecolumns)))
         {
        ?>
                                            <td data-label="Visibility">&nbsp;<?=$info['pvisiblity']?></td>
                                            <?php
          }
          ?>
<?php
         if ((in_array('Status', $modulecolumns)))
         {
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
<td data-label="Edit"><a href="serviceedit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                                        </tr>
                                    <?php
                                        $count++;
                                      }
}
if ($_GET['term']=='customers') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customers' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$count=1;
if($_GET['searchTerm']==''){
  $sqli = mysqli_query($con,"select * FROM paircustomers  WHERE (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') ORDER BY customername ASC limit ".(($access['custpageload']=='pagenum')?'10':'15')."");
}else{
  $sqli = mysqli_query($con,"select * FROM paircustomers  WHERE (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Customers') and (LOWER(customername) like LOWER('%".$_GET['searchTerm']."%') or LOWER(billcity) like LOWER('%".$_GET['searchTerm']."%') or LOWER(mobile) like LOWER('%".$_GET['searchTerm']."%') or LOWER(email) like LOWER('%".$_GET['searchTerm']."%')) ORDER BY customername ASC limit 50");
}
while($info=mysqli_fetch_array($sqli))
          {
            ?>
                    <tr 
 onclick="window.open('customerview.php?id=<?=$info['id']?>', '_self')">
 <?php
         if ((in_array('S dot NO', $modulecolumns)))
         {
        ?>
            <td data-label="S.No" class="">&nbsp;<?=$count?></td>
                        <?php
}
?>
<?php
          // if ((in_array('Name', $modulecolumns)))
         // {
        ?>
            <td data-label="Name" class=""><?=(($info['customername']=='')?'&nbsp;':$info['customername'])?>
                      </td>
                      <?php
// }
?>
<?php
         if ((in_array('City', $modulecolumns)))
         {
        ?>
            <td data-label="City" class=""><?=(($info['billcity']=='')?'&nbsp;':$info['billcity'])?>
                      </td>
                      <?php
}
?>
<?php
         if ((in_array('E-Mail', $modulecolumns)))
         {
        ?>
            <td data-label="E-mail" class=""><?=(($info['email']=='')?'&nbsp;':$info['email'])?>
                      </td>
                       <?php
}
?>
<?php
         if ((in_array('Mobile Number', $modulecolumns)))
         {
        ?>
            <td data-label="Mobile Number" class=""><?=(($info['mobile']=='')?'&nbsp;':$info['mobile'])?>
                      </td>
                      <?php
}
?>
<?php
         if ((in_array('Action', $modulecolumns)))
         {
        ?>
            <td data-label="Action">
                                            <?php if($info['is_active']=='0')
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
                                            ?>
                                        </td>
                      <!--<td data-label="Action" class="">&nbsp;
                        <a href="customeredit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>-->
                       <?php
}
?>
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="customeredit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                    </tr>
          <?php
          $count++;
          }
}
if ($_GET['term']=='vendors') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Vendors' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$count=1;
if($_GET['searchTerm']==''){
  $sqli = mysqli_query($con,"select * FROM paircustomers  WHERE (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Vendors') ORDER BY customername ASC limit ".(($access['venpageload']=='pagenum')?'10':'15')."");
}else{
  $sqli = mysqli_query($con,"select * FROM paircustomers  WHERE (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Vendors') and (LOWER(customername) like LOWER('%".$_GET['searchTerm']."%') or LOWER(billcity) like LOWER('%".$_GET['searchTerm']."%') or LOWER(mobile) like LOWER('%".$_GET['searchTerm']."%') or LOWER(email) like LOWER('%".$_GET['searchTerm']."%')) ORDER BY customername ASC limit 50");
}
while($info=mysqli_fetch_array($sqli))
                  {
                      ?>
                    <tr
 onclick="window.open('vendorview.php?id=<?=$info['id']?>', '_self')">
                        <?php
         if ((in_array('S dot NO', $modulecolumns)))
         {
        ?>
                        <td data-label="S.No" class="">&nbsp;<?=$count?></td>
                        <?php
}
?>
<?php
         // if ((in_array('Name', $modulecolumns)))
         // {
        ?>
                      <td data-label="Name" class=""><?=(($info['customername']=='')?'&nbsp;':$info['customername'])?>
                      </td>
                      <?php
// }
?>
<?php
         if ((in_array('City', $modulecolumns)))
         {
        ?>
                      <td data-label="City" class=""><?=(($info['billcity']=='')?'&nbsp;':$info['billcity'])?>
                      </td>
                      <?php
}
?>
<?php
         if ((in_array('E-Mail', $modulecolumns)))
         {
        ?>
                      <td data-label="E-mail" class=""><?=(($info['email']=='')?'&nbsp;':$info['email'])?>
                      </td>
                       <?php
}
?>
<?php
         if ((in_array('Mobile Number', $modulecolumns)))
         {
        ?>
                      <td data-label="Mobile Number" class=""><?=(($info['mobile']=='')?'&nbsp;':$info['mobile'])?>
                      </td>
                      <?php
}
?>
<?php
         if ((in_array('Action', $modulecolumns)))
         {
        ?>
                      <td data-label="Action">
                                            <?php if($info['is_active']=='0')
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
                                            ?>
                                        </td>
                      <!--<td data-label="Action" class="">&nbsp;
                        <a href="vendoredit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>-->
                       <?php
}
?>
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="vendoredit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                    </tr>
                    <?php
                    $count++;
                  }
}
if ($_GET['term']=='invoices') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Invoices' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$count=1;
if($_GET['searchTerm']==''){
  $sql = mysqli_query($con,"select id,invoicedate, invoiceno, customername, invoiceterm, duedate, invoiceamount, cancelstatus from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc limit ".(($access['invpageload']=='pagenum')?'10':'15')."");
}else{
  $sql = mysqli_query($con,"select id,invoicedate, invoiceno, customername, invoiceterm, duedate, invoiceamount, cancelstatus from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (LOWER(customername) like LOWER('%".$_GET['searchTerm']."%') or LOWER(invoiceno) like LOWER('%".$_GET['searchTerm']."%')) GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc limit 50");
}
$totalcancel=array();
          $totalinvoiceno=array();
          $totalinvoicedate=array();
          
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
                      <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Date"><?=(($info['invoicedate']!='')?(date($date,strtotime($info['invoicedate']))):'&nbsp;')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('No', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Number"><?=(($info['invoiceno']=='')?'&nbsp;':'')?><?=$info['invoiceno']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Name"><?=(($info['customername']=='')?'&nbsp;':'')?><?=$info['customername']?></td>
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
                                             if ((in_array('Status', $modulecolumns))) {
                                                if($info['cancelstatus']=='1'){
                                        ?>
                                            <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Status" style="color:#bbbbbb;text-decoration: none;">
                                                Void
                                            </td>
                                        <?php
                                                }
                                                else{
                                                    if(($currentbalance==0)||($currentbalance<=0)){
                                        ?>
                                            <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Status" class="text-success" style="text-decoration: none;">
                                                Paid
                                            </td>
                                        <?php
                                                    }
                                                    else{
                                                        if(($paidamount - $refundamount)<=0){
                                        ?>
                                            <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Status" class="text-danger" style="text-decoration: none;">
                                                Un Paid
                                            </td>
                                        <?php
                                                        }
                                                        else{
                                        ?>
                                            <td onclick="window.open('invoiceview.php?id=<?=$info['id']?>&invoiceno=<?=$info['invoiceno']?>&invoicedate=<?=$info['invoicedate']?>', '_self')"  data-label="Status" class="text-warning" style="text-decoration: none;">
                                                Partially Paid
                                            </td>
                                        <?php
                                                        }
                                                    }
                                                }
                                            }
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
                      <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['invoiceno']?>','<?=$info['invoicedate']?>','0')"><i class="fa fa-check"></i> Enable Invoice</a></td>
                      <?php
            }
            else
            {
            ?>
                      <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['invoiceno']?>','<?=$info['invoicedate']?>','1')"><i class="fa fa-times"></i> Cancel Invoice</a></td>
                      <?php
            } */
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
if ($_GET['term']=='bills') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Bills' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$count=1;
if($_GET['searchTerm']==''){
  $sql = mysqli_query($con,"select id,billdate, billno, vendorname, billterm, duedate, billamount, cancelstatus from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY billdate, billno order by billdate DESC,ordering DESC limit ".(($access['billpageload']=='pagenum')?'10':'15')."");
}else{
  $sql = mysqli_query($con,"select id,billdate, billno, vendorname, billterm, duedate, billamount, cancelstatus from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (LOWER(vendorname) like LOWER('%".$_GET['searchTerm']."%') or LOWER(billno) like LOWER('%".$_GET['searchTerm']."%')) GROUP BY billdate, billno order by billdate DESC,ordering DESC limit 50");
}
$totalcancel=array();
          $totalbillno=array();
          $totalbilldate=array();
          
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
                      <!-- <tr style="text-decoration: line-through;"> -->
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
                      <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Date"><?=(($info['billdate']!='')?(date($date,strtotime($info['billdate']))):'&nbsp;')?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('No', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Number"><?=(($info['billno']=='')?'&nbsp;':'')?><?=$info['billno']?></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Vendor Name', $modulecolumns))) {
                                                ?>
                      <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Name"><?=(($info['vendorname']=='')?'&nbsp;':'')?><?=$info['vendorname']?></td>
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
                                                if ((in_array('Status', $modulecolumns))) {
                                                if($info['cancelstatus']=='1'){
                                        ?>
                                            <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" style="color:#bbbbbb;text-decoration: none;">
                                                Void
                                            </td>
                                            <?php
                                                }
                                                else{
                                                    if(($currentbalance==0)||($currentbalance<=0)){
                                            ?>
                                            <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" class="text-success">
                                                Paid
                                            </td>
                                                <?php
                                                    }
                                                    else{
                                                        if(($paidamount - $refundamount)<=0){
                                                ?>
                                            <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" class="text-danger">
                                                Un Paid
                                            </td>
                                                    <?php
                                                        }
                                                        else{
                                                    ?>
                                            <td onclick="window.open('billview.php?id=<?=$info['id']?>&billno=<?=$info['billno']?>&billdate=<?=$info['billdate']?>', '_self')"  data-label="Status" class="text-warning">
                                                Partially Paid
                                            </td>
                                        <?php
                                                        }
                                                    }
                                                }
                                            }
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
if ($_GET['term']=='salespay') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Payments Received' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$count=1;
if($_GET['searchTerm']==''){
  $sqli = mysqli_query($con,"select module, id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes,publicid,privateid from pairsalespayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' order by id desc limit ".(($access['salepaypageload']=='pagenum')?'10':'15')."");
}
else{
  $sqli = mysqli_query($con,"select module, id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes,publicid,privateid from pairsalespayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (LOWER(customername) like LOWER('%".$_GET['searchTerm']."%') or LOWER(privateid) like LOWER('%".$_GET['searchTerm']."%')) order by id desc limit 50");
}
while($info=mysqli_fetch_array($sqli)){
if($info['term']=='CASH INVOICE')
{
$sqls=mysqli_query($con,"select cancelstatus from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$info['receiptno']."' and invoicedate='".$info['receiptdate']."'");
$infos=mysqli_fetch_array($sqls);
if($infos['cancelstatus']=='1')
{
?>
<tr style="text-decoration: line-through;" onclick="window.open('salespaymentview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
else
{
?>
<tr onclick="window.open('salespaymentview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
}
else
{
?>
<tr onclick="window.open('salespaymentview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
?>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
<td data-label="Date"><?=date('d/m/Y',strtotime($info['receiptdate']))?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Number', $modulecolumns))) {
                                                ?>
<td data-label="Number"><?=(($info['privateid']=='')?'&nbsp;':$info['privateid'])?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
<?php
$sqlcus=mysqli_query($con,"select * from paircustomers where id=".$info['customerid']."");
$sqlcusfetch=mysqli_fetch_array($sqlcus);
?>
<td data-label="Name"><?=$sqlcusfetch['customername']?></td>
<?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Mode of Payment', $modulecolumns))) {
                                                ?>
<td data-label="Mode of Payment"><?=$info['paymentmode']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount Received', $modulecolumns))) {
                                                ?>
<td data-label="Amount Received"><i class="fa fa-rupee"></i> <?=number_format((float)$info['amount'],2,'.','')?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Payment Types', $modulecolumns))) {
                                                ?>
<td data-label="Payment Types"><?=strtoupper($info['module'])?></td>
<?php
                                            }
                                                ?>
                                                <!-- <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="salespaymentedit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> -->
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="salespaymentedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
</tr>
<?php
$count++;
}
}
if ($_GET['term']=='purpay') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Payments Made' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$count=1;
if($_GET['searchTerm']==''){
  $sqli = mysqli_query($con,"select module, id, createdon, term, receiptdate, receiptno, cancelstatus, vendorid, vendorname, paymentmode, amount, notes,publicid,privateid from pairpurchasepayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' order by id desc limit ".(($access['purpaypageload']=='pagenum')?'10':'15')."");
}
else{
  $sqli = mysqli_query($con,"select module, id, createdon, term, receiptdate, receiptno, cancelstatus, vendorid, vendorname, paymentmode, amount, notes,publicid,privateid from pairpurchasepayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (LOWER(vendorname) like LOWER('%".$_GET['searchTerm']."%') or LOWER(privateid) like LOWER('%".$_GET['searchTerm']."%')) order by id desc limit 50");
}
while($info=mysqli_fetch_array($sqli)){
if($info['term']=='CASH BILL')
{
$sqls=mysqli_query($con,"select cancelstatus from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='".$info['receiptno']."' and billdate='".$info['receiptdate']."'");
$infos=mysqli_fetch_array($sqls);
if($infos['cancelstatus']=='1')
{
?>
<tr style="text-decoration: line-through;" onclick="window.open('purchasepaymentview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
else
{
?>
<tr onclick="window.open('purchasepaymentview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
}
else
{
?>
<tr onclick="window.open('purchasepaymentview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
?>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
<td data-label="Date"><?=date('d/m/Y',strtotime($info['receiptdate']))?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Number', $modulecolumns))) {
                                                ?>
<td data-label="Number"><?=(($info['privateid']=='')?'&nbsp;':$info['privateid'])?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Vendor Name', $modulecolumns))) {
                                                ?>
<?php
$sqlcus=mysqli_query($con,"select * from paircustomers where id=".$info['vendorid']."");
$sqlcusfetch=mysqli_fetch_array($sqlcus);
?>
<td data-label="Name"><?=$sqlcusfetch['customername']?></td>
<?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Mode of Payment', $modulecolumns))) {
                                                ?>
<td data-label="Mode of Payment"><?=$info['paymentmode']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount Received', $modulecolumns))) {
                                                ?>
<td data-label="Amount Received"><i class="fa fa-rupee"></i> <?=number_format((float)$info['amount'],2,'.','')?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Payment Types', $modulecolumns))) {
                                                ?>
<td data-label="Payment Types"><?=strtoupper($info['module'])?></td>
<?php
                                            }
                                                ?>
                                              <!--   <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="purchasepaymentedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> -->
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="purchasepaymentedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
</tr>
<?php
$count++;
}
}
if ($_GET['term']=='customerrefund') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customer Refunds' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$count=1;
if($_GET['searchTerm']==''){
  $sqli = mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes,publicid,privateid from paircreditnotepayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' order by id desc limit ".(($access['salereturnpaypageload']=='pagenum')?'10':'15')."");
}
else{
  $sqli = mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes,publicid,privateid from paircreditnotepayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (LOWER(customername) like LOWER('%".$_GET['searchTerm']."%') or LOWER(privateid) like LOWER('%".$_GET['searchTerm']."%')) order by id desc limit 50");
}
while($info=mysqli_fetch_array($sqli)){
if($info['term']=='CASH INVOICE')
{
$sqls=mysqli_query($con,"select cancelstatus from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and creditnoteno='".$info['receiptno']."' and creditnotedate='".$info['receiptdate']."'");
$infos=mysqli_fetch_array($sqls);
if($infos['cancelstatus']=='1')
{
?>
<tr style="text-decoration: line-through;" onclick="window.open('customerrefundview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
else
{
?>
<tr onclick="window.open('customerrefundview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
}
else
{
?>
<tr onclick="window.open('customerrefundview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
?>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
<td data-label="Date"><?=date('d/m/Y',strtotime($info['receiptdate']))?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Number', $modulecolumns))) {
                                                ?>
<td data-label="Number"><?=(($info['privateid']=='')?'&nbsp;':$info['privateid'])?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
<?php
$sqlcus=mysqli_query($con,"select * from paircustomers where id=".$info['customerid']."");
$sqlcusfetch=mysqli_fetch_array($sqlcus);
?>
<td data-label="Name"><?=$sqlcusfetch['customername']?></td>
<?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Mode of Payment', $modulecolumns))) {
                                                ?>
<td data-label="Mode of Payment"><?=$info['paymentmode']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount Received', $modulecolumns))) {
                                                ?>
<td data-label="Amount Received"><i class="fa fa-rupee"></i> <?=number_format((float)$info['amount'],2,'.','')?></td>
<?php
                                            }
                                                ?>
                                                <!-- <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="customerrefundedit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> -->
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="customerrefundedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
</tr>
<?php
$count++;
}
}
if ($_GET['term']=='vendorrefund') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Vendor Refunds' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$count=1;
if($_GET['searchTerm']==''){
  $sqli = mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, vendorid, vendorname, paymentmode, amount, notes,publicid,privateid from pairdebitnotepayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' order by id desc limit ".(($access['purreturnpaypageload']=='pagenum')?'10':'15')."");
}
else{
  $sqli = mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, vendorid, vendorname, paymentmode, amount, notes,publicid,privateid from pairdebitnotepayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (LOWER(vendorname) like LOWER('%".$_GET['searchTerm']."%') or LOWER(privateid) like LOWER('%".$_GET['searchTerm']."%')) order by id desc limit 50");
}
while($info=mysqli_fetch_array($sqli)){
if($info['term']=='CASH BILL')
{
$sqls=mysqli_query($con,"select cancelstatus from pairdebitnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and debitnoteno='".$info['receiptno']."' and debitnotedate='".$info['receiptdate']."'");
$infos=mysqli_fetch_array($sqls);
if($infos['cancelstatus']=='1')
{
?>
<tr style="text-decoration: line-through;" onclick="window.open('vendorrefundview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
else
{
?>
<tr onclick="window.open('vendorrefundview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
}
else
{
?>
<tr onclick="window.open('vendorrefundview.php?id=<?=$info['id']?>&receiptno=<?=$info['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
?>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
<td data-label="Date"><?=date('d/m/Y',strtotime($info['receiptdate']))?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Number', $modulecolumns))) {
                                                ?>
<td data-label="Number"><?=(($info['privateid']=='')?'&nbsp;':$info['privateid'])?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Vendor Name', $modulecolumns))) {
                                                ?>
<?php
$sqlcus=mysqli_query($con,"select * from paircustomers where id=".$info['vendorid']."");
$sqlcusfetch=mysqli_fetch_array($sqlcus);
?>
<td data-label="Name"><?=$sqlcusfetch['customername']?></td>
<?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Mode of Payment', $modulecolumns))) {
                                                ?>
<td data-label="Mode of Payment"><?=$info['paymentmode']?></td>
<?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount Received', $modulecolumns))) {
                                                ?>
<td data-label="Amount Received"><i class="fa fa-rupee"></i> <?=number_format((float)$info['amount'],2,'.','')?></td>
<?php
                                            }
                                                ?>
                                              <!--   <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="vendorrefundedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> -->
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="vendorrefundedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
</tr>
<?php
$count++;
}
}
if ($_GET['term']=='creditnote') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Credit Notes' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$count=1;
if($_GET['searchTerm']==''){
  $sql = mysqli_query($con,"select id,creditnotedate, creditnoteno, customername, creditnoteterm, duedate, creditnoteamount, cancelstatus from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY creditnotedate, creditnoteno order by creditnotedate desc, creditnoteno desc limit ".(($access['invpageload']=='pagenum')?'10':'15')."");
}else{
  $sql = mysqli_query($con,"select id,creditnotedate, creditnoteno, customername, creditnoteterm, duedate, creditnoteamount, cancelstatus from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (LOWER(customername) like LOWER('%".$_GET['searchTerm']."%') or LOWER(creditnoteno) like LOWER('%".$_GET['searchTerm']."%')) GROUP BY creditnotedate, creditnoteno order by creditnotedate desc, creditnoteno desc limit 50");
}
$totalcancel=array();
          $totalcreditnoteno=array();
          $totalcreditnotedate=array();
          
          $count=1;
          $creditnoteamount=0;
  $balanceamount=0;
  $currentamount=0;
  $overdueamount=0;
  
          
          while($info=mysqli_fetch_array($sql))
          {
        
        
        $creditnoteamount+=(float)$info['creditnoteamount'];
        $currentamount=(float)$info['creditnoteamount'];
        $paidamount=0;
        $currentbalance=0;
        $sqlsalespay=mysqli_query($con,"select amount from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and creditnoteno='".$info['creditnoteno']."' and creditnotedate='".$info['creditnotedate']."' order by id desc");
        while($infosalespay=mysqli_fetch_array($sqlsalespay))
        {
          $paidamount+=(float)$infosalespay['amount'];
        }
        $currentbalance=((float)$info['creditnoteamount']-$paidamount);
        $balanceamount+=((float)$info['creditnoteamount']-$paidamount);

        
           /* $totalid[]=$info['id'];*/
            $totalcancel[]=$info['cancelstatus'];
            $totalcreditnoteno[]=$info['creditnoteno'];
            $totalcreditnotedate[]=$info['creditnotedate'];
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
                      if ((in_array('Date', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Date">
                        <?=(($info['creditnotedate']!='')?(date($date,strtotime($info['creditnotedate']))):'&nbsp;')?>
                      </td>
                    <?php
                      }
                      if ((in_array('No', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Number">
                        <?=(($info['creditnoteno']=='')?'&nbsp;':'')?><?=$info['creditnoteno']?>
                      </td>
                    <?php
                      }
                      // if ((in_array('Customer Name', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Name">
                        <?=(($info['customername']=='')?'&nbsp;':'')?><?=$info['customername']?>
                      </td>
                    <?php
                      // }
                      if ((in_array('Amount', $modulecolumns))) {
                    ?>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Amount">
                        <i class="fa fa-rupee"></i> <?=number_format((float)$info['creditnoteamount'],2,'.','')?>
                      </td>
                    <?php
                      }
                      if ((in_array('Status', $modulecolumns))) {
                        if($info['cancelstatus']=='1'){
                        }
                        else{
                          if(($currentbalance==0)||($currentbalance<=0)){
                    ?>
                      <td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Status" class="text-success" style="text-decoration: none;">
                        Refunded
                      </td>
                    <?php
                          }
                          else{
                            if($currentbalance==$currentamount){
                    ?>
                      <td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Status" class="text-danger" style="text-decoration: none;">
                        Not Refunded
                      </td>
                    <?php
                            }
                            else{
                    ?>
                      <td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Status" class="text-warning" style="text-decoration: none;">
                        Partially Refunded
                      </td>
                    <?php
                            }
                          }
                        }
                      }
                      if ((in_array('Balance', $modulecolumns))) {
                    ?>
                      <td onclick="window.open('creditnoteview.php?id=<?=$info['id']?>&creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>', '_self')"  data-label="Balance">
                        <i class="fa fa-rupee"></i> <?=number_format((float)$currentbalance,2,'.','')?>
                      </td>
                    <?php
                      }
                      if ((in_array('Print', $modulecolumns))) {
                    ?>
                      <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="creditnoteprint.php?creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Print
                        </a>
                      </td>
                    <?php
                      }
                      if ((in_array('Edit', $modulecolumns))) {
                    ?>
                      <td data-label="Edit">
                        <a href="creditnoteedit.php?creditnoteno=<?=$info['creditnoteno']?>&creditnotedate=<?=$info['creditnotedate']?>" class="text-secondary font-weight-bold text-xs">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                      </td>
                    <?php
                      }
            }
$count++;
}
}
if ($_GET['term']=='debitnote') {
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Debit Notes' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd/m/Y';
}
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
$count=1;
if($_GET['searchTerm']==''){
  $sql = mysqli_query($con,"select id,debitnotedate, debitnoteno, vendorname, debitnoteterm, duedate, debitnoteamount, cancelstatus from pairdebitnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY debitnotedate, debitnoteno order by debitnotedate desc, debitnoteno desc limit ".(($access['invpageload']=='pagenum')?'10':'15')."");
}else{
  $sql = mysqli_query($con,"select id,debitnotedate, debitnoteno, vendorname, debitnoteterm, duedate, debitnoteamount, cancelstatus from pairdebitnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and (LOWER(vendorname) like LOWER('%".$_GET['searchTerm']."%') or LOWER(debitnoteno) like LOWER('%".$_GET['searchTerm']."%')) GROUP BY debitnotedate, debitnoteno order by debitnotedate desc, debitnoteno desc limit 50");
}
$totalcancel=array();
          $totaldebitnoteno=array();
          $totaldebitnotedate=array();
          
          $count=1;
          $debitnoteamount=0;
  $balanceamount=0;
  $currentamount=0;
  $overdueamount=0;
  
          
          while($info=mysqli_fetch_array($sql))
          {
        
        
        $debitnoteamount+=(float)$info['debitnoteamount'];
        $currentamount=(float)$info['debitnoteamount'];
        $paidamount=0;
        $currentbalance=0;
        $sqlsalespay=mysqli_query($con,"select amount from pairdebitnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and debitnoteno='".$info['debitnoteno']."' and debitnotedate='".$info['debitnotedate']."' order by id desc");
        while($infosalespay=mysqli_fetch_array($sqlsalespay))
        {
          $paidamount+=(float)$infosalespay['amount'];
        }
        $currentbalance=((float)$info['debitnoteamount']-$paidamount);
        $balanceamount+=((float)$info['debitnoteamount']-$paidamount);

        
           /* $totalid[]=$info['id'];*/
            $totalcancel[]=$info['cancelstatus'];
            $totaldebitnoteno[]=$info['debitnoteno'];
            $totaldebitnotedate[]=$info['debitnotedate'];
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
                      if ((in_array('Date', $modulecolumns))) {
              ?>
               <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Date">
                <?=(($info['debitnotedate']!='')?(date($date,strtotime($info['debitnotedate']))):'&nbsp;')?>
               </td>
              <?php
               }
               if ((in_array('No', $modulecolumns))) {
              ?>
               <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Number">
                <?=(($info['debitnoteno']=='')?'&nbsp;':'')?><?=$info['debitnoteno']?>
               </td>
              <?php
               }
               // if ((in_array('Vendor Name', $modulecolumns))) {
              ?>
               <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Name">
                <?=(($info['vendorname']=='')?'&nbsp;':'')?><?=$info['vendorname']?>
               </td>
              <?php
               // }
               if ((in_array('Term', $modulecolumns))) {
              ?>
               <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Term">
                <?=$info['debitnoteterm']?>
               </td>
              <?php
               }
               if ((in_array('Amount', $modulecolumns))) {
              ?>
               <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Amount">
                <i class="fa fa-rupee"></i>
                <?=number_format((float)$info['debitnoteamount'],2,'.','')?>
               </td>
              <?php
               }
               if ((in_array('Status', $modulecolumns))) {
                if($info['cancelstatus']=='1'){
                }
                else{
                  if(($currentbalance==0)||($currentbalance<=0)){
               ?>
               <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Status" class="text-success">
                Refunded
               </td>
                <?php
                  }
                  else{
                   if($currentbalance==$currentamount){
                ?>
               <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Status" class="text-danger">
                Not Refunded
               </td>
                  <?php
                   }
                   else{
                  ?>
               <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Status" class="text-warning">
                Partially Refunded
               </td>
              <?php
                   }
                  }
                }
               }
               if ((in_array('Balance', $modulecolumns))) {
              ?>
               <td onclick="window.open('debitnoteview.php?id=<?=$info['id']?>&debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>', '_self')"  data-label="Balance">
                <i class="fa fa-rupee"></i>
                <?=number_format((float)$currentbalance,2,'.','')?>
               </td>
              <?php
               }
               if ((in_array('Print', $modulecolumns))) {
              ?>
               <td data-label="Print" class="">&nbsp;
                <a target="_blank" href="debitnoteprint.php?debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                  Print
                </a>
               </td>
              <?php
               }
               if ((in_array('Edit', $modulecolumns))) {
              ?>
               <td data-label="Edit">
                <a href="debitnoteedit.php?debitnoteno=<?=$info['debitnoteno']?>&debitnotedate=<?=$info['debitnotedate']?>" class="text-secondary font-weight-bold text-xs">
                  <i class="fa fa-edit"></i> Edit
                </a>
               </td>
              <?php
               }
            }
$count++;
}
}
?>