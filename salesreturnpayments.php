<?php
include('lcheck.php');
// This is for Restriction of Pages
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Payments Made For Sales Returns' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Payments Made For Sales Returns' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
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
     ?>
                                <?php
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Payments Made For Sales Returns' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
      $sqlismainaccesscustomer=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Customers' order by id  asc");
      $infomainaccesscustomer=mysqli_fetch_array($sqlismainaccesscustomer);
                                ?>
	 <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> <?= $infomainaccessuser['modulename'] ?></p>
                                <?php 
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Payments Made For Sales Returns' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccesscreate']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
                                 ?>
                                <div align="right" class=" p-2" style="margin-top: -60px;">
        
       <a href="salesreturnpaymentadd.php" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $infomainaccessuser['modulename'] ?></span></p></a>
       
       <br>
       </div>
       <?php
                            }
                            ?>
			<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Payments Made For Sales Returns' order by id  asc");
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
                                <table id="someTable" class="table table-bordered align-items-center mb-0" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                                <?php
                                            if ((in_array('Date', $modulecolumns))) {
                                                ?>
                      <td class="text-uppercase" style="width:9%;"><span style="font-size:13px;color:black;">Date</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Number', $modulecolumns))) {
                                                ?>
					  <td class="text-uppercase" style="width:10%;"><span style="font-size:13px;color:black;">Number</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            // if ((in_array('Customer Name', $modulecolumns))) {
                                                ?>
                      <td class="text-uppercase" style="width:46%;"><span style="font-size:13px;color:black;"> Name</span></td>
                      <?php
                                            // }
                                                ?>
                                                <?php
                                            if ((in_array('Mode of Payment', $modulecolumns))) {
                                                ?>
                      <td class="text-uppercase" style="width:15%;"><span style="font-size:13px;color:black;">Mode of Payment</span></td>
                      <?php
                                            }
                                                ?>
                                                <?php
                                            if ((in_array('Amount Received', $modulecolumns))) {
                                                ?>
                      <td class="text-uppercase" style="width:15%;"><span style="font-size:13px;color:black;">Amount Received</span></td>
                      <?php
                                            }
                                                ?>
                                              <!--   <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Edit</span></td>
                      <?php
                                            }
                                                ?> -->
								
<?php
         if ((in_array('Edit', $modulecolumns))) {
        ?>
                                                <td class="text-uppercase status" style="width:5%;"
                                                id="status"><span style="font-size:13px;color:black;"> Edit</span></td>
                                                <?php
          }
          ?>
							
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
									
									<?php
$sql=mysqli_query($con,"set names utf8");
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes,publicid from pairsalesreturnpayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' order by id desc limit ".(($access['salereturnpaypageload']=='pagenum')?'10':'15')."");
$count=1;
while($info=mysqli_fetch_array($sql))
{
if($info['term']=='CASH SALESRETURN')
{
$sqls=mysqli_query($con,"select cancelstatus from pairsalesreturns where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and salesreturnno='".$info['receiptno']."' and salesreturndate='".$info['receiptdate']."'");
$infos=mysqli_fetch_array($sqls);
if($infos['cancelstatus']=='1')
{
?>
<tr style="text-decoration: line-through;" onclick="window.open('salesreturnpaymentview.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
else
{
?>
<tr onclick="window.open('salesreturnpaymentview.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
<?php
}
}
else
{
?>
<tr onclick="window.open('salesreturnpaymentview.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>', '_self')">
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
                                               <!--  <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="salesreturnpaymentedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> -->
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="salesreturnpaymentedit.php?id=<?=$info['id']?>&receiptdate=<?=$info['receiptdate']?>&publicid=<?= $info['publicid'] ?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
</tr>
<?php
$count++;
}
$sqltotlist = mysqli_query($con,"select COUNT(DISTINCT receiptno,receiptdate) from pairsalesreturnpayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
$sqlfetlist = mysqli_fetch_array($sqltotlist);
if ($sqlfetlist[0]==0) {
$pageinitnum = 0;
}
if ($sqlfetlist[0]!=0) {
$pageinitnum = 1;
}
if (($sqlfetlist[0]>=1)&&($sqlfetlist[0]<=10)) {
$pagetotnum = 1;
}
else if (($sqlfetlist[0]==0)) {
$pagetotnum = 0;
}
else{
$pagetotnum = ceil($sqlfetlist[0]/10);
}
?>
                                    </tbody>
                                </table>
                                <div style="text-align: center !important;display: none;" id="loadimg">
                                    <img src="loading.gif" alt="Loading..." style="margin-top: -60px;" id="loadimgins">
                                </div>
<?php
if ($access['salereturnpaypageload']=='pageauto') {
?>
<script type="text/javascript">
var sIndex = 10, offSet = 10, isPreviousEventComplete = true, isDataAvailable = true;
$('.main-content').on('scroll', function() {
var scrollTop = $(this).scrollTop();
if (scrollTop + $(this).innerHeight() >= this.scrollHeight-50) {
if (isPreviousEventComplete && isDataAvailable) {
isPreviousEventComplete = false;
$("#loadimg").css("display","block");
console.log('ss');
// ajax for get
$.ajax({
type: "GET",
url: 'listsalereturnpaysearch.php?term=' + sIndex + '',
success: function (result) {
$("#myTable").append(result);
sIndex = sIndex + offSet;
isPreviousEventComplete = true;
if (result == '') //When data is not available
isDataAvailable = false;
$("#loadimg").css("display","none");
console.log(result);
},
error: function (error) {
console.log(error);
}
});
// it is done
}
}
});
</script>
<?php
}
?>
<?php
if ($access['salereturnpaypageload']=='pagenum') {
?>
<br>
<span style="position:relative;top: 7px;display: inline-flex;max-width: 90px;overflow: hidden;white-space: nowrap;">Total <span id="pagesforcurrent" style="padding: 0px 3px;"><?=$pageinitnum?></span> of <?=$pagetotnum?></span>
<span style="<?=(($sqlfetlist[0]!=0)&&($sqlfetlist[0]>10))?'':'visibility:hidden !important;'?>">
<svg id="rightarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: 0px !important;position: relative;top: 0px !important;z-index: 3000000 !important;cursor: pointer;height: 36px;width: 30px;border: 1px solid #dee2e6;<?=(ceil($sqlfetlist[0]/10)>3)?'':'visibility:hidden !important;'?>">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: 0px !important;position: relative;top: 0px !important;z-index: 3000000 !important;cursor: pointer;height: 36px;width: 30px;transform: rotate(180deg);visibility: hidden;right: 119px;float: right;border: 1px solid #dee2e6;<?=(ceil($sqlfetlist[0]/10)>3)?'':'visibility:hidden !important;'?>">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
        <script type="text/javascript">
          function checkscrolltouch() {
            // console.log($('#scrforlist').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#scrforlist').scrollLeft());
            // console.log($('#scrforlist').width());
            var width = $('#scrforlist').outerWidth()
            var scrollWidth = $('#scrforlist')[0].scrollWidth; 
            var scrollLeft = $('#scrforlist').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrow').style.visibility = 'hidden';
            document.getElementById('leftarrow').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrow').style.visibility = 'visible';
            document.getElementById('rightarrow').style.visibility = 'visible';
          }
            }
          }
          function leftarrow() {
            document.getElementById('scrforlist').scrollLeft += -76;
            var width = $('#scrforlist').outerWidth()
            var scrollWidth = $('#scrforlist')[0].scrollWidth; 
            var scrollLeft = $('#scrforlist').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrow').style.visibility = 'hidden';
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrow').style.visibility = 'visible';
            }
          }
          function rightarrow() {
            document.getElementById('scrforlist').scrollLeft += 76;
            var width = $('#scrforlist').outerWidth()
            var scrollWidth = $('#scrforlist')[0].scrollWidth; 
            var scrollLeft = $('#scrforlist').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrow').style.visibility = 'hidden';
            }
            document.getElementById('leftarrow').style.visibility = 'visible';
          }
        </script>

        <style type="text/css">
            #page-item .active{
                background-color: green !important;
                border: 1px solid green !important;
                color: white !important;
            }
            #page-item .remactcls{
                color: black;
            }
        #scrforlist::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#scrforlist::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#scrforlist::-webkit-scrollbar-track {
  background-color: green;
}

#scrforlist::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#scrforlist::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbarlist {
 /* $scrollbarlist-thumb-width: 10px;
  $scrollbarlist-thumb-color: #008aff;
  $scrollbarlist-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbarlist:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}

      </style>
<ul class="pagination scrollbarlist" style="max-width:115px !important;overflow-x: scroll !important;cursor: pointer !important;float: right !important;margin-right: -27px !important;" id="scrforlist" ontouchmove="checkscrolltouch()">
<?php
for ($i=0; $i < ceil($sqlfetlist[0]/10); $i++) {
?>
  <li class="page-item" id="page-item"><p class="page-link remactcls" id="page-link<?=$i?>" style="border-radius: 0px !important;"><?=$i+1?></p></li>
<script type="text/javascript">
$(document).ready(function(){
$('#page-link<?=$i?>').click(function(){
$("#pagesforcurrent").html(<?=$i+1?>);
let remactcls = document.getElementsByClassName("remactcls");
remactclslen = remactcls.length;
for (f=0;f<remactclslen;f++) {
remactcls[f].classList.remove('active');
}
this.classList.add('active');
// ajax for get
$.ajax({
type: "GET",
url: 'listsalereturnpaysearch.php?term=<?=$i?>0',
success: function (result) {
$("#myTable").html(result);
},
error: function (error) {
alert(error);
}
});
// it is done
});
});
</script>
<?php
}
?>
</ul>
</span>
<?php 
}
?>


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
                Are you sure you want to Cancel this Invoice?
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
 function deleteitem(salesreturnno,salesreturndate,cancelstatus)
{
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","salesreturncancel.php?salesreturnno="+salesreturnno+"&salesreturndate="+salesreturndate+"&cancelstatus="+cancelstatus);
}
 </script>
</body>

</html>