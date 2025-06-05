<?php
include('lcheck.php');
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Chart of Accounts' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
// This is for Restriction of Pages
$sql = "select * from paircontrols where id='$companymainid'";  
$result = mysqli_query($con, $sql);
$rowes = mysqli_fetch_array($result);
$sql = "select * from paircontrols where username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."'";  
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_array($result);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Chart of Accounts' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
<?php
include('externals.php');
?>
  <title>
    <?= $infomainaccessuser['modulename'] ?>
  </title>
</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6">
  <?php
  // sidebar
  include('sidebar.php');
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
         <?php 
   // navbar
   include('navhead.php');
    ?>
     <div class="container-fluid py-4 bg-body">
     <?php
   // notifications
     if(isset($_GET['remarks']))
     {
     ?>
     <div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -50px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #53b05a !important;">
    <i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks']?></p>
  </div>
     <?php
     }
     ?>
     <?php
     if(isset($_GET['error']))
     {
     ?>
      <div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -50px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
    <i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></p>
  </div>
     <?php
     }
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Chart of Accounts' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
     ?>
	 <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> <?= $infomainaccessuser['modulename'] ?></p>
                                    <?php
$sqlismainaccessuserr=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Chart of Accounts' order by id  asc");
$infomainaccessuserr=mysqli_fetch_array($sqlismainaccessuserr);
if (($infomainaccessuserr['useraccesscreate']==1&&$infomainaccessuserr['createdid']!=0)||($infomainaccessuserr['createdid']==0)) {
   ?>
                                <div align="right" class=" p-2" style="margin-top: -60px;">
        
       <a href="chartaccountadd.php" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $infomainaccessuser['modulename'] ?></span></p></a>
       
       <br>
       </div>
                                    <?php
}
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Chart of Accounts' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
    <div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> is Allowed for this Franchise</div>
    <?php
}
else
{
?>
							
                            <div class="table-responsive p-0 min-height-480">
                                <table id="someTable" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                        <tr>
<?php
if ((in_array('Account Name', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Account Name</span></td>
<?php
}
?>
<?php
// if ((in_array('Account Sub Category', $modulecolumns))) {
?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Account Code</span></td>
<?php
// }
?>
<?php
if ((in_array('Account Category', $modulecolumns))) {
?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Account Category</span></td>
<?php
}
?>
<?php
if ((in_array('Notes', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Notes</span></td>
<?php
}
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Parent Account</span></td>
<?php
if ((in_array('Edit', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Edit</span></td>
<?php
}
?>
								
							
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
$selloops = mysqli_query($con,"select optionslist,chartaccounttypelists from pairchartaccounttypes where optionslist!=''");
$count=1;
while($fetloops=mysqli_fetch_array($selloops))
{
$explodeoptions = explode(';', $fetloops['optionslist']);
for($i=0;$i<count($explodeoptions)-1;$i++){
$finalvalues = explode(',',$explodeoptions[$i]);
$selval = mysqli_query($con,"select * from pairchartaccountings where id='".$finalvalues[0]."'");
$fetval=mysqli_fetch_array($selval);
if ($fetval['parentaccount']!='') {
$selvalparent = mysqli_query($con,"select accountname,id from pairchartaccountings where id='".$fetval['parentaccount']."'");
$fetvalparent=mysqli_fetch_array($selvalparent);
$parentname = $fetvalparent['accountname'];
$parentid = $fetvalparent['id'];
}
else{
$parentname = '';
$parentid = '';
}
?>
<tr>
<?php
if ((in_array('Account Name', $modulecolumns))) {
?>
<td data-label="Account Name" style="padding-left: <?=$finalvalues[3]?>px !important;color: #408dfb;"><span style="<?=(($finalvalues[3]>10)?'position: relative;right: 1px;bottom: 16px;padding-top: 10px;padding-bottom: 12px;border-left: 1px solid #adadad;border-bottom: 1px solid #adadad;':'')?>"> &nbsp; </span> 
    <?php
    $selheaders = mysqli_query($con,"select count(id) from pairchartaccountings where parentaccount='".$finalvalues[0]."'");
    $fetheaders = mysqli_fetch_array($selheaders);
    if ($fetheaders[0]!=0) {
    ?>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 468 423" class="icon text-muted icon-xs shift-left" style="width: 12px;height: 12px;"><path d="M384 423H84c-46 0-84-37-84-84V84C0 38 38 0 84 0h67c17 0 33 7 44 20l44 49c3 3 7 5 11 5h134c47 0 84 37 84 84v181c0 47-37 84-84 84zM84 42c-23 0-42 19-42 42v255c0 24 19 42 42 42h300c23 0 42-18 42-42V158c0-23-19-42-42-42H250c-16 0-31-7-42-19l-44-49c-3-4-8-6-13-6H84z"></path></svg>
    <?php
    }
    ?>
     <?=$fetval['accountname']?></td>
<?php
}
?>
<?php
// if ((in_array('Account Sub Category', $modulecolumns))) {
?>
<td data-label="Account Code"><?=$fetval['accountcode']?></td>
<?php
// }
?>
<?php
if ((in_array('Account Category', $modulecolumns))) {
?>
<td data-label="Account Category"><?=$fetloops['chartaccounttypelists']?></td>
<?php
}
?>
<?php
if ((in_array('Notes', $modulecolumns))) {
?>
<td data-label="Notes"><?=$fetval['description']?></td>
<?php
}
?>
<td data-label="Parent Account"><?=$parentname?></td>
<?php
if ((in_array('Edit', $modulecolumns))) {
?>
<td data-label="Edit"><a href="chartaccountedit.php?id=<?=$fetval['id']?>&name=<?=$fetval['accountname']?>&parentid=<?=$parentid?>&padding=<?=$finalvalues[3]?>&cid=<?=$fetval['accountcategory']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
}
?>
</tr>
<?php
$count++;
}
}
?>
                                    </tbody>
                                </table>


                            </div>

 <?php
                            }
                            ?>









                        </div>
                    </div>
                </div>

            </div>
        </div>
	 
      <div class="modal fade" id="deleteconfirm-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to Cancel this Bill?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem" href="" class="btn btn-success success" >Yes</a>
        </div>
    </div>
</div>
</div> 
	  <?php
	  include('footer.php');
	  ?>
    </div>
  
	</main>
 <?php
 include('fexternals.php');
 ?>
 <script>
 function deleteitem(billno,billdate,cancelstatus)
{
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","billcancel.php?billno="+billno+"&billdate="+billdate+"&cancelstatus="+cancelstatus);
}
 </script>
</body>

</html>