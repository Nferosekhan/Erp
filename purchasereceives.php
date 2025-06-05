<?php
include('lcheck.php');
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Purchase Receives' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Purchase Receives' order by id  asc");
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
$dateformat = mysqli_query($con,"select * from paricountry");
$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {
$date = 'd-m-Y';
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
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Purchase Receives' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
      $sqlismainaccessvendor=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Vendors' order by id  asc");
      $infomainaccessvendor=mysqli_fetch_array($sqlismainaccessvendor);
                                ?>
	 <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> <?= $infomainaccessuser['modulename'] ?></p>
								<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Purchase Receives' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
    ?>
	<div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> Generation is Allowed for this Franchise</div>
	<?php
}
else
{
?>
<?php 
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Purchase Receives' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccesscreate']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
    ?>
								<div class="p-2" align="right" style="margin-top: -60px;">
								<a href="purchasereceiveadd.php" class="btn btn-sm btn-custom add"  style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $infomainaccessuser['modulename'] ?></span></p></a>

								 					
                                            <br>
											
                                        </div>
                                        <?php
                                    }
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
                              if ((in_array('No', $modulecolumns))) {
                              ?>
                      <td class="text-uppercase" style="width:10%;"><span style="font-size:13px;color:black;">Number</span></td>
                      <?php
                  }
                  ?>
                  <?php
                              // if ((in_array('Vendors Name', $modulecolumns))) {
                              ?>
                      <td class="text-uppercase" style="width:46%;"><span style="font-size:13px;color:black;">Name</span></td>
                      <?php
                  // }
                  ?>
                  <?php
                              if ((in_array('Term', $modulecolumns))) {
                              ?>
                      <td class="text-uppercase" style="width:10%;"><span style="font-size:13px;color:black;">Term</span></td>
                      <?php
                  }
                  ?>
                  <?php
                              if ((in_array('Amount', $modulecolumns))) {
                              ?>
                      <td class="text-uppercase" style="width:10%;"><span style="font-size:13px;color:black;">Amount</span></td>
                      <?php
                  }
                  ?>
                  <?php
                              if ((in_array('Print', $modulecolumns))) {
                              ?>
					  <td class="text-uppercase" style="width:10%;"><span style="font-size:13px;color:black;">Print</span></td>
                      <?php
                  }
                  ?>
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
				  $totalcancel=array();
				  $totalpurchasereceiveno=array();
				  $totalpurchasereceivedate=array();
				  $sql=mysqli_query($con, "select id, purchasereceivedate, purchasereceiveno, vendorname, purchasereceiveterm, duedate, purchasereceiveamount, cancelstatus, grandtotal, totalvatamount, roundoff from pairpurchasereceives where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY purchasereceivedate, purchasereceiveno order by purchasereceivedate desc, purchasereceiveno desc limit ".(($access['purreceivepageload']=='pagenum')?'10':'15')."");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
            $id=$info['id'];
					 /* $totalid[]=$info['id'];*/
					  $totalcancel[]=$info['cancelstatus'];
					  $totalpurchasereceiveno[]=$info['purchasereceiveno'];
					  $totalpurchasereceivedate[]=$info['purchasereceivedate'];
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
          $sqli=mysqli_query($con, "select * from pairpurchasereceives where franchisesession='".$_SESSION["franchisesession"]."' and id='$id'");
                 
                 
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
                      <td onclick="window.open('purchasereceiveview.php?purchasereceiveno=<?=$info['purchasereceiveno']?>&purchasereceivedate=<?=$info['purchasereceivedate']?>', '_self')" data-label="Date"><?=(($info['purchasereceivedate']!='')?(date($date,strtotime($info['purchasereceivedate']))):'')?></td>
                      <?php
                  }
                  ?>
                  <?php
                              if ((in_array('No', $modulecolumns))) {
                              ?>
                      
                      <td onclick="window.open('purchasereceiveview.php?purchasereceiveno=<?=$info['purchasereceiveno']?>&purchasereceivedate=<?=$info['purchasereceivedate']?>', '_self')" data-label="Number"><?=$info['purchasereceiveno']?></td>
                      <?php
                  }
                  ?>
                  <?php
                              // if ((in_array('Vendors Name', $modulecolumns))) {
                              ?>
                      
                      <td onclick="window.open('purchasereceiveview.php?purchasereceiveno=<?=$info['purchasereceiveno']?>&purchasereceivedate=<?=$info['purchasereceivedate']?>', '_self')" data-label="Name"><?=$info['vendorname']?></td>
                      <?php
                  // }
                  ?>
                  <?php
                              if ((in_array('Term', $modulecolumns))) {
                              ?>
                      
                      <td onclick="window.open('purchasereceiveview.php?purchasereceiveno=<?=$info['purchasereceiveno']?>&purchasereceivedate=<?=$info['purchasereceivedate']?>', '_self')" data-label="Term"><?=$info['purchasereceiveterm']?></td>
                      <?php
                  }
                  ?>
                  <?php
                              if ((in_array('Amount', $modulecolumns))) {
                              ?>
                      
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('purchasereceiveview.php?purchasereceiveno=<?=$info['purchasereceiveno']?>&purchasereceivedate=<?=$info['purchasereceivedate']?>', '_self')"  data-label="Amount"><i class="fa fa-rupee"></i> <?=(((float)$info['grandtotal']-(float)$info['totalvatamount'])-(float)$info['roundoff'])?></td>
                      <?php
                  }
                  ?>
                  <?php
                              if ((in_array('Print', $modulecolumns))) {
                              ?>
                      <!--td class="">&nbsp;
                        <a href="purchasereceiveedit.php?purchasereceiveno=<?=$info['purchasereceiveno']?>&purchasereceivedate=<?=$info['purchasereceivedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
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
					  // else
					  // {
?>
<!-- <td data-label="Edit" class="">&nbsp;
                        <a href="purchasereceiveedit.php?purchasereceiveno=<?=$info['purchasereceiveno']?>&purchasereceivedate=<?=$info['purchasereceivedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Purchase Receive">
                          Edit
                        </a>
                      </td> -->
<?php
					  // } */
					  
					  ?>
                      
					  <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="purchasereceiveprint.php?purchasereceiveno=<?=$info['purchasereceiveno']?>&purchasereceivedate=<?=$info['purchasereceivedate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Purchase Receive">
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
                      <td><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Converted</a></td>
                      <?php
					  // }
					  // else
					  // {
					  ?>
                      <td><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['purchasereceiveno']?>','<?=$info['purchasereceivedate']?>','1')"> Convert</a></td>
                      <?php
					  // }  */
					  ?>
                      
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="purchasereceiveedit.php?purchasereceiveno=<?=$info['purchasereceiveno']?>&purchasereceivedate=<?=$info['purchasereceivedate']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                    </tr>

					<?php
				  $count++;
				  }
$sqltotlist = mysqli_query($con,"select COUNT(DISTINCT purchasereceiveno,purchasereceivedate) from pairpurchasereceives where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
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
if ($access['purreceivepageload']=='pageauto') {
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
url: 'listpurreceivesearch.php?term=' + sIndex + '',
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
if ($access['purreceivepageload']=='pagenum') {
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
url: 'listpurreceivesearch.php?term=<?=$i?>0',
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
                Are you sure you want to Generate this Purchase Receive as Invoice?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem" href="" class="btn btn-success success" >Yes</a>
        </div>
    </div>
</div>
</div> 


<div class="modal fade" id="deleteconfirm1-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to Generate this Purchase Receive as Estimate?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem1" href="" class="btn btn-success success" >Yes</a>
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
 function deleteitem(purchasereceiveno,purchasereceivedate,cancelstatus)
{
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","purchasereceivecancel.php?purchasereceiveno="+purchasereceiveno+"&purchasereceivedate="+purchasereceivedate+"&cancelstatus="+cancelstatus);
}
 function deleteitem1(purchasereceiveno,purchasereceivedate,cancelstatus)
{
	$('#deleteconfirm1-adddelete').modal('show');
	$("#deleteconfirm1-adddelete #deleteitem1").attr("href","estimatecancel.php?purchasereceiveno="+purchasereceiveno+"&purchasereceivedate="+purchasereceivedate+"&estimatestatus="+cancelstatus);
}
 </script>
</body>

</html>