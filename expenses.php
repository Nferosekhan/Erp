<?php
include('lcheck.php');
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and grouptype='Expences' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['grouptype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Expences' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['groupaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['groupaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
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
    <?= $infomainaccessuser['groupname'] ?>
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and grouptype='Expences' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
     ?>
	 <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> <?= $infomainaccessuser['groupname'] ?></p>
                                <div class="row">
                                 <div class="col-11">
                                    <?php
if (($infomainaccessuser['useraccesscreate']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
   ?>
                                <div align="right" class=" p-2" style="margin-top: -60px;">
        
       <a href="expenseadd.php" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $infomainaccessuser['groupname'] ?></span></p></a>
       
       <br>
       </div>
                                    <?php
}
   ?>
    </div>
<div class="col-1">
<div class="dropdown" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: -45px;margin-right:0px;padding: 0.2rem 0.75rem;" align="right">
<button class="btn btn-sm btn-custom-grey dropdown-toggle addmenu" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="height:24px;">
<i class="fa fa-bars" style="position: relative;top:-4.5px;"></i>
</button>
<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
<li><a class="dropdown-item" href="expensesimport.php"><i class="fa fa-download"></i> <?= $infomainaccessuser['groupname'] ?> Import</a></li>
</ul>
</div>
</div>
</div>
			
							
                            <div class="table-responsive p-0 min-height-480">
                                <table id="someTable" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                        <tr>
<?php
if ((in_array('Date', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Date</span></td>
<?php
}
?>
<?php
if ((in_array('Number', $modulecolumns))) {
?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Number</span></td>
<?php
}
?>
<?php
if ((in_array('Category Name', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Category Name</span></td>
<?php
}
?>
<?php
if ((in_array('Mode of Payment', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Mode of Payment</span></td>
<?php
}
?>
<?php
if ((in_array('Amount', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Amount</span></td>
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
$sql=mysqli_query($con,"set names utf8");
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, headerid, headername, paymentmode, amount, notes from pairexpenses where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' order by id desc");
$count=1;
while($info=mysqli_fetch_array($sql))
{
if($info['term']=='CASH BILL')
{
$sqls=mysqli_query($con,"select cancelstatus from pairbills where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and billno='".$info['receiptno']."' and billdate='".$info['receiptdate']."'");
$infos=mysqli_fetch_array($sqls);
if($infos['cancelstatus']=='1')
{
?>
<tr style="text-decoration: line-through;" onclick="window.open('expenseview.php?id=<?=$info['id']?>','_self')">
<?php
}
else
{
?>
<tr onclick="window.open('expenseview.php?id=<?=$info['id']?>','_self')">
<?php
}
}
else
{
?>
<tr onclick="window.open('expenseview.php?id=<?=$info['id']?>','_self')">
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
<td data-label="Number"><?=$info['receiptno']?></td>
<?php
}
?>
<?php
if ((in_array('Category Name', $modulecolumns))) {
?>
<td data-label="Category Name"><?=$info['headername']?></td>
<?php
}
?>
<?php
if ((in_array('Mode of Payment', $modulecolumns))) {
?>
<td data-label="Mode of Payment"><?=$info['paymentmode']?></td>
<?php
}
?>
<?php
if ((in_array('Amount', $modulecolumns))) {
?>
<td data-label="Amount"><i class="fa fa-rupee"></i> <?=number_format((float)$info['amount'],2,'.','')?></td>
<?php
}
?>
<?php
if ((in_array('Notes', $modulecolumns))) {
?>
<td data-label="Notes"><?=$info['notes']?></td>
<?php
}
?>
<?php
if ((in_array('Edit', $modulecolumns))) {
?>
<td data-label="Edit"><a href="expenseedit.php?id=<?=$info['id']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
}
?>
</tr>
<?php
$count++;
}
?>
                                    </tbody>
                                </table>


                            </div>











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
 <script>
window.setMobileTable = function(selector) {
  // if (window.innerWidth > 600) return false;
  const tableEl = document.querySelector(selector);
  const thEls = tableEl.querySelectorAll('thead th');
  const tdLabels = Array.from(thEls).map(el => el.innerText);
  tableEl.querySelectorAll('tbody tr').forEach( tr => {
    Array.from(tr.children).forEach( 
      (td, ndx) =>  td.setAttribute('label', tdLabels[ndx])
    );
  });
}
</script>
</body>

</html>