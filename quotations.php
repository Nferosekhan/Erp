<?php
include('lcheck.php');
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Quotations' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Quotations' order by id  asc");
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
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Quotations' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
      $sqlismainaccesscustomer=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Customers' order by id  asc");
      $infomainaccesscustomer=mysqli_fetch_array($sqlismainaccesscustomer);
$sqlismainaccessproforma=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Proforma Invoices' order by id  asc");
$infomainaccessproforma=mysqli_fetch_array($sqlismainaccessproforma);
$sqlismainaccessinvoice=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Invoices' order by id  asc");
$infomainaccessinvoice=mysqli_fetch_array($sqlismainaccessinvoice);
                                ?>
	 <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> <?= $infomainaccessuser['modulename'] ?></p>
								<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Quotations' order by id  asc");
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Quotations' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccesscreate']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
                                 ?>
								<div class="p-2" align="right" style="margin-top: -60px;">
								<a href="quotationadd.php" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-plus" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> New <?= $infomainaccessuser['modulename'] ?></span></p></a>
								 					
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
                      <td class="text-uppercase" style="width:10%;"><span style="font-size:13px;color:black;"> Number</span></td>
<?php
                                        	}
                                        		?>
                                        		<?php
                                        	// if ((in_array('Customer Name', $modulecolumns))) {
                                        		?>
                      <td class="text-uppercase" style="width:33%;"><span style="font-size:13px;color:black;">Name</span></td>
<?php
                                        	// }
                                        		?>
                                        		<?php
                                        	if ((in_array('Term', $modulecolumns))) {
                                        		?>
                      <!-- <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Term</span></td> -->
<?php
                                        	}
                                        		?>
                                        		<?php
                                        	if ((in_array('Amount', $modulecolumns))) {
                                        		?>
                      <!--td class="text-uppercase" style="width:50px;"><span style="font-size:13px;">Due Date</span></td-->
                      <td class="text-uppercase" style="width:10%;"><span style="font-size:13px;color:black;">Amount</span></td>
<?php
                                        	}
                                        		?>
                                        		<?php
                                        	if ((in_array('Edit', $modulecolumns))) {
                                        		?>
                                            <?php 
                             if (($infomainaccessuser['useraccessedit']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
                                 ?>
                      <!-- <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Edit</span></td> -->
<?php
                                        	}
                                        		?>
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
                                        	if ((in_array('Proforma Invoice', $modulecolumns))) {
                                        		?>
					  <!--td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Generate<br>Estimate</span></td-->
					  <td class="text-uppercase" style="width:15%;"><span style="font-size:13px;color:black;"><?= $infomainaccessproforma['modulename'] ?></span></td>
<?php
                                        	}
                                        		?>
                                        		<?php
                                        	if ((in_array('Invoice', $modulecolumns))) {
                                        		?>
					  <td class="text-uppercase" style="width:8%;"><span style="font-size:13px;color:black;"><?= $infomainaccessinvoice['modulename'] ?></span></td>
<?php
                                        	}
                                        		?>
					  
                      <!--td class="text-uppercase" style="width:50px;"><span style="font-size:13px;">Cancel Quotation</span></td-->
												
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
				  $totalquotationno=array();
				  $totalquotationdate=array();
				  $sql=mysqli_query($con, "select quotationdate, quotationno, customername, quotationterm, duedate, quotationamount, cancelstatus, estimatestatus, proformastatus, id from pairquotations where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY quotationdate, quotationno order by quotationdate desc, quotationno desc limit ".(($access['quotpageload']=='pagenum')?'10':'15')."");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
            $id=$info['id'];
					 /* $totalid[]=$info['id'];*/
					  $totalcancel[]=$info['cancelstatus'];
					  $totalquotationno[]=$info['quotationno'];
					  $totalquotationdate[]=$info['quotationdate'];
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
          $sqli=mysqli_query($con, "select * from pairquotations where franchisesession='".$_SESSION["franchisesession"]."' and id='$id'");
                 
                 
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
                      <td onclick="window.open('quotationview.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Date"><?=(($info['quotationdate']!='')?(date($date,strtotime($info['quotationdate']))):'')?></td>
                      <?php
                                          }
                                            ?>
                                            <?php
                                          if ((in_array('No', $modulecolumns))) {
                                            ?>
                      <td onclick="window.open('quotationview.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Number"><?=$info['quotationno']?></td>
                      <?php
                                          }
                                            ?>
                                            <?php
                                          // if ((in_array('Customer Name', $modulecolumns))) {
                                            ?>
                      <td onclick="window.open('quotationview.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Name"><?=$info['customername']?></td>
                      <?php
                                          // }
                                            ?>
                                            <?php
                                          if ((in_array('Term', $modulecolumns))) {
                                            ?>
                      <!-- <td onclick="window.open('quotationview.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Quotation Term"><?=$info['quotationterm']?></td> -->
                      <?php
                                          }
                                            ?>
                                            <?php
                                          if ((in_array('Amount', $modulecolumns))) {
                                            ?>
                      <!--td data-label="Due Date"><?=$info['duedate']?></td-->
                      <td onclick="window.open('quotationview.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>', '_self')" data-label="Quotation Amount"><i class="fa fa-rupee"></i> <?=$info['quotationamount']?></td>
					  <!--td class="">&nbsp;
                        <a href="quotationedit.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td-->
                      <?php
                                          }
                                            ?>
                                            <?php
                                          if ((in_array('Edit', $modulecolumns))) {
                                            ?>
                                            <?php 
                             if (($infomainaccessuser['useraccessedit']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
                                 ?>
					  <?php
					  if(($info['estimatestatus']=='1')||($info['proformastatus']=='1')||($info['cancelstatus']=='1'))
					  {
					  ?>
					  
<!-- <td data-label="Edit"></td> -->
					  <?php
					  }
					  else
					  {
?>
<!-- <td data-label="Edit" class="">&nbsp;
                        <a href="quotationedit.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Quotation">
                          Edit
                        </a>
                      </td> -->
<?php
					  }
					  ?>
            <?php
                                          }
                                            ?>
                                            <?php
            }
            ?>
                                            <?php
                                          if ((in_array('Print', $modulecolumns))) {
                                            ?>
					  <td data-label="Print" class="">&nbsp;
                        <a target="_blank" href="quotationprint.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit Quotation">
                          Print
                        </a>
                      </td>
                      <?php
                                          }
                                            ?>
                                            <?php
                                          if ((in_array('Proforma Invoice', $modulecolumns))) {
                                            ?>
					  
                      <?php
					 /*  if($info['estimatestatus']=='1')
					  {
					  ?>
                      <td data-label="<?= $infomainaccessproforma['modulename'] ?>"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Estimate Converted</a></td>
                      <?php
					  }
					  else
					  {
					  ?>
                      <td data-label="<?= $infomainaccessproforma['modulename'] ?>"><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem1('<?=$info['quotationno']?>','<?=$info['quotationdate']?>','1')"> Convert Estimate</a></td>
                      <?php
					  }  */
					  ?>
					  
					  <?php
					  if($info['proformastatus']=='1')
					  {
					  ?>
                      <td data-label="<?= $infomainaccessproforma['modulename'] ?>"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Converted</a></td>
                      <?php
					  }
					  else
					  {
						  if(($info['estimatestatus']=='0')&&($info['proformastatus']=='0')&&($info['cancelstatus']=='0'))
						  {
						  ?>
						  <td data-label="<?= $infomainaccessproforma['modulename'] ?>"><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem2('<?=$info['quotationno']?>','<?=$info['quotationdate']?>','1')"> Convert</a></td>
						  <?php
						  }
						  else
						  {
							  ?>
							  <td></td>
							  <?php
						  }
						  
					  } 
					  ?>
            <?php
                                          }
                                            ?>
                                            <?php
                                          if ((in_array('Invoice', $modulecolumns))) {
                                            ?>
					  <?php
					  if($info['cancelstatus']=='1')
					  {
					  ?>
                      <td data-label="<?= $infomainaccessinvoice['modulename'] ?>"><a id="edit_button" class="text-success" style="cursor:pointer"><i class="fa fa-check"></i> Converted</a></td>
                      <?php
					  }
					  else
					  {
						  if(($info['estimatestatus']=='0')&&($info['proformastatus']=='0')&&($info['cancelstatus']=='0'))
						  {
					  ?>
                      <td data-label="<?= $infomainaccessinvoice['modulename'] ?>"><a id="edit_button" class="text-danger" style="cursor:pointer" onClick="deleteitem('<?=$info['quotationno']?>','<?=$info['quotationdate']?>','<?=$info['quotationamount']?>','1')"> Convert</a></td>
                      <?php
						  }
						   else
						  {
							  ?>
							  <td></td>
							  <?php
						  }
							  
					  } 
					  ?>
            <?php
                                          }
                                            ?>
                                                <?php
                                            if ((in_array('Edit', $modulecolumns))) {
                                                ?>
<td data-label="Edit"><a href="quotationedit.php?quotationno=<?=$info['quotationno']?>&quotationdate=<?=$info['quotationdate']?>" class="text-secondary font-weight-bold text-xs"><i class="fa fa-edit"></i> Edit</a></td>
<?php
                                            }
                                                ?> 
                      
                    </tr>

					<?php
				  $count++;
				  }
$sqltotlist = mysqli_query($con,"select COUNT(DISTINCT quotationno,quotationdate) from pairquotations where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid'");
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
if ($access['quotpageload']=='pageauto') {
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
url: 'listquotsearch.php?term=' + sIndex + '',
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
if ($access['quotpageload']=='pagenum') {
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
url: 'listquotsearch.php?term=<?=$i?>0',
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
		<form action="quotationcancel.php" method="post">
		<input type="hidden" name="cancelstatus" id="cancelstatus">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                <h6 class="text-blue text-center">Advance Payment Details</h6>
				<table class="table">
				<tr>
				<th>Quotation No</th><td><input type="text" name="quotationno" id="quotationno" class
				="form-control form-control-sm" readonly required></td>
				</tr>
				<tr>
				<th>Quotation Date</th><td><input type="text" name="quotationdate" id="quotationdate" class
				="form-control form-control-sm" readonly required></td>
				</tr>
				<tr>
				<th>Total Amount</th><td><input type="text" name="quotationamount" id="quotationamount" class
				="form-control form-control-sm" readonly required></td>
				</tr>
				<tr>
				<th>Paid Amount</th><td><input type="number" name="paidamount" id="paidamount" class
				="form-control form-control-sm" value="0" required></td>
				</tr>
				<tr>
				<th>Payment Term</th><td> <select required class="form-control  form-control-sm" name="paymentterm" id="paymentterm" >
<option value="" disabled>Select</option>
<option value="CASH" selected>CASH</option>
<option value="BANK ACCOUNT">BANK ACCOUNT</option>
<option value="UPI">UPI</option>
</select></td>
				</tr>
				</table>
				Are you sure you want to Generate this Quotation as Invoice?
				
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" style="padding: 0.5rem 1rem; border-radius:0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <button type="submit" id="deleteitem" href="" style="padding: 0.5rem 1rem; border-radius:0px;" class="btn btn-success success" >Yes</button>
        </div>
		</form>
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
                Are you sure you want to Generate this Quotation as Estimate?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" style="padding: 0.5rem 1rem; border-radius:0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem1" href="" class="btn btn-success success" style="padding: 0.5rem 1rem; border-radius:0px;" >Yes</a>
        </div>
    </div>
</div>
</div> 


<div class="modal fade" id="deleteconfirm2-adddelete" tabindex="-2" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to Generate this Quotation as Proforma Invoice?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem2" href="" class="btn btn-success success" >Yes</a>
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
 function deleteitem(quotationno,quotationdate,quotationamount,cancelstatus)
{
	$('#quotationno').val(quotationno);
	$('#quotationdate').val(quotationdate);
	$('#quotationamount').val(quotationamount);
	$('#cancelstatus').val(cancelstatus);
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","quotationcancel.php?quotationno="+quotationno+"&quotationdate="+quotationdate+"&cancelstatus="+cancelstatus);
}
 function deleteitem1(quotationno,quotationdate,cancelstatus)
{
	$('#deleteconfirm1-adddelete').modal('show');
	$("#deleteconfirm1-adddelete #deleteitem1").attr("href","estimatecancel.php?quotationno="+quotationno+"&quotationdate="+quotationdate+"&estimatestatus="+cancelstatus);
}
 function deleteitem2(quotationno,quotationdate,cancelstatus)
{
	$('#deleteconfirm2-adddelete').modal('show');
	$("#deleteconfirm2-adddelete #deleteitem2").attr("href","proformacancel1.php?quotationno="+quotationno+"&quotationdate="+quotationdate+"&proformastatus="+cancelstatus);
}
 </script>
</body>

</html>