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
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Vendors' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
if (isset($_GET['term'])) {
$count=1;
                  $sqli=mysqli_query($con, "select * from paircustomers where (franchisesession='".$_SESSION["franchisesession"]."' or cvisiblity='PUBLIC') and (createdid='$companymainid' and moduletype='Vendors') ".$_GET['typesforlisting']." order by customername asc limit ".$_GET['term'].",".$_GET['limitings']."");
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
?>