<?php
include('lcheck.php');
     if(isset($_GET['id']))
{
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes, type, publicid, privateid from paircreditnotepayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='".$_GET['id']."'");
if(mysqli_num_rows($sql)>0)
{
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customer Refunds' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
$sqlismainaccesscreditnote=mysqli_query($con, "select * from pairmainaccess where (userid='$companymainid' and createdid='0') and moduletype='Credit Notes' order by id  asc");
$infomainaccesscreditnote=mysqli_fetch_array($sqlismainaccesscreditnote);
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customer Refunds' order by id  asc");
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

$id=mysqli_real_escape_string($con, $_GET['id']);
$sql=mysqli_query($con,"select id, createdon, term, receiptdate, receiptno, cancelstatus, customerid, customername, paymentmode, amount, notes, publicid, privateid from paircreditnotepayments where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='".$_GET['id']."'");
$info=mysqli_fetch_array($sql);
$sqliet=mysqli_query($con, "select * from pairfranchises where id='".$_SESSION['franchisesession']."' ");
$infofranch=mysqli_fetch_array($sqliet);
?>
<?php
$sqlcus=mysqli_query($con,"select * from paircustomers where id=".$info['customerid']."");
$sqlcusfetch=mysqli_fetch_array($sqlcus);
$sqlgetcurrency=mysqli_query($con,"select * from paircurrency");
$rowcurrency=mysqli_fetch_array($sqlgetcurrency);
$anscurrency=$rowcurrency['currencysymbol'];
$rescurrency=explode('-',$anscurrency);
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
    <?= $infomainaccessuser['modulename'] ?> Details
  </title>
  

   <link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">
   <!-- productview.css -->
   <!-- <link href="productview.css" rel="stylesheet"> -->
   
</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
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
     $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
     ?>
     
       <div id="fullcontainerwidth">
      <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3">
<div class="row">
<div class="col-lg-6">
 <p class="mb-3" id="viewpro"><i class="fa fa-eye"></i> <?= $infomainaccessuser['modulename'] ?> Details</p>
 <?php
$sqlismainaccessuser=mysqli_query($con, "select moduleno, moduleprefix, modulesuffix, modulename from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customer Refunds' order by id  asc");
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
 </div>
<div class="col-lg-6">
 <span id="btnalignright" class="mb-3">
    <a style="margin:4.5px 4.5px !important;" class="btn btn-primary btn-sm btn-custom-grey" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="converHTMLFileToPDF()"><i class="fa fa-print" aria-hidden="true"></i> <span class="mobreswords "> Print</span></a>
<a style="margin:4.5px 4.5px !important;" class="btn btn-primary btn-sm btn-custom-grey" onclick="downloadpdf()"><i class="fa fa-download" aria-hidden="true"></i> <span class="mobreswords "> Download</span></a>
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customer Refunds' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if (($infomainaccessuser['useraccessedit']==1&&$infomainaccessuser['createdid']!=0)||($infomainaccessuser['createdid']==0)) {
?>
<a class="btn btn-primary btn-sm btn-custom-grey" href="customerrefundedit.php?id=<?=$id?>" id="btngopage"><i class="fa fa-pencil-alt"></i> <span class="mobreswords "> Edit</span></a>
  <?php 
}
?>
  </span>
  </div>

  </div>
  
<!-- Modal -->
<!-- Print Pdf Modal Download Start -->
<div class="modal fade" id="exampleModaldownload" tabindex="-1" role="dialog" aria-labelledby="downloadexampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="downloadexampleModalLabel" style="font-weight: normal;">Download</h5>
<button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body" id="pdfObjdownload">
<img src="loading.gif" alt="Loading..." id="loadimgobj" style="width:100px">
</div>
<div class="modal-footer" style="margin-top: 33px !important;">
<a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>    
</div>
</div>
</div>
</div>
<!-- Print Pdf Modal Download End -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: normal;">Preview</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="pdfObj">
      </div>
      <div class="modal-footer" style="margin-top: 33px !important;">
          <a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>
          
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


<nav>
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><div class="customcont-header ml-0">
	
		<a class="customcont-heading">Overview</a>	
             
				</div></button>
               <!--  <button class="nav-link" id="nav-transactions-tab" data-bs-toggle="tab" data-bs-target="#nav-transactions" type="button" role="tab" aria-controls="nav-transactions" aria-selected="false"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">Transactions</a>  
             
                </div></button> -->
                  <button class="nav-link" id="nav-journal-tab" data-bs-toggle="tab" data-bs-target="#nav-journal" type="button" role="tab" aria-controls="nav-journal" aria-selected="false">
                    <div class="customcont-header ml-0"> 
                      <a class="customcont-heading">Journal</a>
                    </div>
                  </button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
		<div class="customcont-header ml-0">
	
		<a class="customcont-heading">History</a>	
             
				</div>
		
		</button>
		
  </div>
  
</nav>
<div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade" id="nav-journal" role="tabpanel" aria-labelledby="nav-journal-tab">
                  <div class="table-responsive m-3" id="histables">
                    <table class="table table-bordered">
                      <tbody>
                      <?php
    $i=0;
    $item=1;
    $countt=1;
    $totpros=0;
if(!empty($info["customerid"]))
{
$customerid=$info["customerid"];
if($customerid!='')
{
$sqls=mysqli_query($con,"select creditnoteno, creditnotedate, grandtotal, paidstatus, customerid, customername from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY creditnotedate, creditnoteno  order by creditnotedate asc, creditnoteno asc");
while($infos=mysqli_fetch_array($sqls))
{
$s=0;
if($infos['paidstatus']=='1')
{
$sqlse=mysqli_query($con,"select paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid' and paymentid='".$_GET['id']."'");
if(mysqli_num_rows($sqlse)>0)
{
$s=0;
}
else
{
$s=1;
}
}
if($s==0)
{
$am=0;
$am1=0;
$p='';
$p1=0;
$sqlse=mysqli_query($con,"select amount, paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid'");
while($infose=mysqli_fetch_array($sqlse))
{
if($infose['paymentid']==$_GET['id'])
{
$p='yes';
$p1=(float)$infose['amount'];
}
else
{
$am+=(float)$infose['amount'];
}
$am1+=(float)$infose['amount']; 
}
if($p=='yes')
{
$totpros++;
}
}
}
    $sqls=mysqli_query($con,"select creditnoteno, creditnotedate, grandtotal, paidstatus, customerid, customername from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY creditnotedate, creditnoteno  order by creditnotedate asc, creditnoteno asc");
    while($infos=mysqli_fetch_array($sqls))
    {
        $s=0;
        if($infos['paidstatus']=='1')
        {
            $sqlse=mysqli_query($con,"select paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid' and paymentid='".$_GET['id']."'");
            if(mysqli_num_rows($sqlse)>0)
            {
                $s=0;
            }
            else
            {
                $s=1;
            }
        }
        if($s==0)
        {
        $am=0;
        $am1=0;
        $p='';
        $p1=0;
        $sqlse=mysqli_query($con,"select amount, paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid'");
        while($infose=mysqli_fetch_array($sqlse))
        {
            if($infose['paymentid']==$_GET['id'])
            {
                $p='yes';
                $p1=(float)$infose['amount'];
            }
            else
            {
                $am+=(float)$infose['amount'];
            }
            $am1+=(float)$infose['amount']; 
        }
        if($p=='yes')
        {
        $bal=(float)$infos['grandtotal']-$am;
        if((float)$infos['grandtotal']==$am1)
        {
            $sta='1';
        }
        else
        {
            $sta='2';
        }
                        $sqlijournals=$con->prepare("SELECT customerid, chartaccountname, customername, sum(ledgerdebit) AS ledgerdebit, sum(ledgercredit) AS ledgercredit, notes,ledgerdate, ledgerno, referenceno, referencedate, totalledgerdebit, totalledgercredit, id, type FROM pairledgers WHERE franchisesession=? AND createdid=? AND ledgerno=? AND ledgerdate=? AND type='creditnote payment' GROUP BY type,chartaccountid,ledgerdate,ledgerno ORDER BY ledgerdate,ledgerno,type ASC");
                          $sqlijournals->bind_param("ssss", $_SESSION['franchisesession'], $companymainid, $infos['creditnoteno'], $infos['creditnotedate']);
                          $sqlijournals->execute();
                          $sqlijournal = $sqlijournals->get_result();
                        $ledgerno = '';
                        $totalCredit = 0;
                        $totalDebit = 0;
                        while($infojournal=$sqlijournal->fetch_array()){
                          if (($ledgerno!=$infojournal['ledgerno'].'-'.$infojournal['ledgerdate'].'-'.$infojournal['type'])) {
                            if (!empty($ledgerno)) {
                              echo '<tr style="background-color:#eee;">
                                    <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"></td>
                                    <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;" data-label="Debit">' . $resmaincurrencyans.number_format($totalDebit,2,'.',',') . '</td>
                                    <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;" data-label="Credit">' . $resmaincurrencyans.number_format($totalCredit,2,'.',',') . '</td>
                                  </tr>';
                              $totalCredit = 0;
                              $totalDebit = 0;
                            }
                            $ledgerno = $infojournal['ledgerno'].'-'.$infojournal['ledgerdate'].'-'.$infojournal['type'];
                            $sqlijournalcustnames=$con->prepare("SELECT customerid, customername FROM pairledgers WHERE ledgerno=? AND ledgerdate=?");
                              $sqlijournalcustnames->bind_param("ss", $infojournal['ledgerno'], $infojournal['ledgerdate']);
                              $sqlijournalcustnames->execute();
                              $sqlijournalcustname = $sqlijournalcustnames->get_result();
                            $infojournalcustname=$sqlijournalcustname->fetch_array();
                            $custnamesledger='<span style="color:royalblue;" onclick="window.open(\'customerview.php?id='.$infojournalcustname['customerid'].'\',\'_self\')">('.$infojournalcustname['customername'].')</span>';
                      ?>
                        <tr>
                          <td style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"> 
                            <?=date($datemainphp,strtotime($infojournal['ledgerdate']))?> - <?=strtoupper($infojournal['type'])?> <?=$infojournal['ledgerno']?> <?=$custnamesledger?>
                          </td>
                          <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"> 
                            Debit
                          </td>
                          <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"> 
                            Credit
                          </td>
                        </tr>
                        <?php
                          }
                        ?>
                        <tr>
                          <td data-label="Account Name" style="border: 1px solid #eee;padding-left: 10px;font-size: 13px;"> 
                            <?=$infojournal['chartaccountname']?>
                          </td>
                          <td data-label="Debit"  style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"> 
                            <?=$resmaincurrencyans.number_format($infojournal['ledgerdebit'],2,'.',',')?>
                          </td>
                          <td data-label="Credit"  style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"> 
                            <?=$resmaincurrencyans.number_format($infojournal['ledgercredit'],2,'.',',')?>
                          </td>
                        </tr>
                      <?php
                          $totalCredit += $infojournal['ledgercredit'];
                          $totalDebit += $infojournal['ledgerdebit'];
                        }
                        if (!empty($ledgerno)) {
                          echo '<tr style="background-color:#eee;">
                                <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;"></td>
                                <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;" data-label="Debit">' . $resmaincurrencyans.number_format($totalDebit,2,'.',',') . '</td>
                                <td style="border: 1px solid #eee;padding-right: 10px;font-size: 13px;text-align: right;" data-label="Credit">' . $resmaincurrencyans.number_format($totalCredit,2,'.',',') . '</td>
                              </tr>';
                        }
                      }
                    }
                  }
                }
              }
                        //FOR JOURNAL INFORMATIONS
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="table-responsive m-3" id="histables">
      <table class="table table-bordered">
      <thead>
      <tr>
      <th style="border:1px solid #ddd !important;">DATE</th>
      <th style="border:1px solid #ddd !important;">DETAILS</th>
      </tr>
      </thead>
      <tbody>
        <?php
      $sqluse=mysqli_query($con, "select * from pairusehistory where usetype='CUSREFUND' and useid='$id' order by createdon desc");
      while($infouse=mysqli_fetch_array($sqluse))
      {
      ?>
        <tr>
          <td data-label="DATE" id="datehis" style="white-space: normal !important;"><?=date('d/m/Y h:i:s a', strtotime($infouse['createdon']))?></td>
          <td data-label="DETAILS" style="white-space: normal !important;"><?=$infouse['useremarks']?> <br><span><?=((str_contains($infouse['useremarks'],'PAYMENT CREATED'))?'Created By':'Changed By')?></span><span  id="chhis"> <?=$infouse['createdby']?></span></td>
        </tr>
      <?php
      }
      ?>
      </tbody>
      </table>
      </div>
      </div>
  <!-- <div class="tab-pane fade" id="nav-transactions" role="tabpanel" aria-labelledby="nav-transactions-tab">
    <p class="m-3">Transaction</p>
  </div> -->
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

<div class="container mt-1 mb-3">
<div class="text-center"><br></div>
<div class="row d-flex justify-content-center">
<div class="col-lg-8 col-md-12 justify-content-center">
<div class="card" id="zoomforprint"  style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); padding:10px; width:max-content;height: max-content;padding-bottom: 0px !important;" align="center">
<?php
if($infofranch['salesreturnpaymenttemplate']=='1')
{
?>
<div id="printalble">
<div class="table-responsive myTableValue" style="width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;">
<table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 21cm !important;height: 29cm !important;max-width:21cm !important; max-height:29cm !important;min-width:21cm !important; min-height:29cm !important;">

<tr style="height:10px !important;">
<td style="border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td style="text-align:center;line-height: 13px !important;">
<b style="font-size:15px !important;display: inline-flex;white-space: nowrap;width: max-content;overflow: hidden;text-align: center;max-width: 166px;"><?= $infomainaccessuser['modulename'] ?></b>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:10px !important;">
<td>
<table width="100%">
<tr>
<td style="text-align:center;height: 80px !important;">
<table width="100%">
<tr>
<td width="35%" style="text-align:right;">
<?php
if($infofranch['branchimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$infofranch['branchimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Branch Pic" src="<?=str_replace('../ups','ups',$img)?>" id="branch-image1" height="80" width="80">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>
    <?php
}
?>
</td>
<td width="65%" style="text-align:left;vertical-align: top;padding-left: 30px !important;">
<table width="100%">
<tr style="padding:0px !important;">
<td>
<table width="100%" style="padding:0px !important;">
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;"><?=$infofranch['franchisename']?></strong>
</td>
</tr>
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;margin-bottom: -3px;">
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;"><?=$infofranch['street']?> <?=$infofranch['city']?> <?=$infofranch['pincode']?> <?=$infofranch['state']?> <?=$infofranch['country']?> </span>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="100%">
<tr style="<?=($access['salespayreceivebranchphone']=='0')?'display:none;':''?>">
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">Phone </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">: <span style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$infofranch['mobile']?></span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;<?=($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':''?>">E-mail </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><input type="text" readonly value=": <?=$infofranch['email']?>" style="padding:0px;color:black;width: 206px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;<?=($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':''?>" class="form-control form-control-sm"><span style="<?=(($access['salespayreceiveprintdlno20']=='1')?'display:inline-flex;':'display:none;')?>white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 20 &nbsp; : <?=$infofranch['dlno20']?></span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;<?=($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':''?>">GSTIN </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><span style="display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;<?=($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':''?>">: <?=$infofranch['gstno']?></span><span style="<?=(($access['salespayreceiveprintdlno21']=='1')?'display:inline-flex;':'display:none;')?>white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 21 &nbsp; : <?=$infofranch['dlno21']?></span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;border: 1px solid #cccccc;">
<td style="padding: 0px !important;">
<table width="100%">
<tr>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;height: 98px !important;">
<table width="100%">
<tr style="background-color: #eee;<?=((in_array('Billing Address', $fieldview))?'':'visibility:hidden;')?>">
<td style="padding: 0px !important;">
<strong style="padding:0px 6px !important;">Billing Address</strong>
</td>
</tr>
<tr>
<?php
if (($sqlcusfetch['customername']!='')&&(in_array('Billing Address', $fieldview))&&(in_array('Billing Name', $fieldview))) {
?>
<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;"><?=ucwords(strtolower($sqlcusfetch['customername']))?></strong></td>
<?php
}
?>
</tr>
<tr>
<td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">
<?php
if ((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!='')||($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))&&(in_array('Billing Address', $fieldview))) {
?>
<?php
if ((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!=''))) {
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
    <?=ucwords(strtolower($sqlcusfetch['billstreet']))?> <?=((($sqlcusfetch['billstreet']!='')&&($sqlcusfetch['billcity']!=''))?',':'')?> <?=ucwords(strtolower($sqlcusfetch['billcity']))?>
</span>
<br>
<?php
}
if ((($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))) {
?>
<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=$sqlcusfetch['billstate']?> <?=((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billpincode']!=''))?',':'')?> <?=$sqlcusfetch['billpincode']?> <?=((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billcountry']!='')||($sqlcusfetch['billpincode']!='')&&($sqlcusfetch['billcountry']!=''))?',':'')?> <?=$sqlcusfetch['billcountry']?>
<!-- <br> -->
</span>
<?php
}
}
?>
</td>
</tr>
<tr>
<td style="padding: 0px !important;">
<table width="100%">
<tr <?=((in_array('Work Phone', $fieldview))?'':'style="display:none;"')?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Work Phone </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$sqlcusfetch['workphone']?></b></td>
</tr>
<tr <?=((in_array('GSTIN', $fieldview))?'':'style="display:none;"')?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">GSTIN </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: 
<?php
// if (($infomainaccessuser['creditnoteprintgstin']=='show')||($sqlcusfetch['gstno']!='')&&($infomainaccessuser['creditnoteprintgstin']!='hide')) {
?>
<b style="font-size:12px;padding: 0px !important;display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;"><?=$sqlcusfetch['gstin']?></b>
<?php
// }
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="33%" style="border-right: 1px solid #cccccc;white-space: normal !important;vertical-align: middle;padding: 0px !important;">
<table width="100%" style="text-align: center !important;">
<?php
if ((in_array('Reference Number', $fieldview))) {
?>
<tr style="position:relative;top:10px;">
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Reference Number" style="padding:0px;color:black;width: 130px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><input type="text" readonly value="<?=$info['receiptno']?>" style="padding:0px;color:black;width: 100px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;font-weight: bold;" class="form-control form-control-sm"></b></td>
</tr>
<?php
}
?>
<tr style="position:relative;top:10px;">
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Amount Received" style="padding:0px;color:black;width: 130px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
    ?>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><input type="text" readonly value="<?=(number_format((float)$info['amount'],2,'.',''))?>" style="padding:0px;color:black;width: 100px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;font-weight: bold;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;visibility: hidden;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;visibility: hidden;" width="45%">: <b><?=$info['paymentmode']?></b></td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: middle;padding: 0px !important;">
<table width="100%" style="text-align: center !important;">
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="<?= $infomainaccessuser['modulename'] ?>" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Number" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=$info['privateid']?></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="<?= $infomainaccessuser['modulename'] ?>" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Date" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
    ?>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=date($date,strtotime($info['receiptdate']))?></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=$info['paymentmode']?></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;">
<td style="padding: 0px !important;">
<table width="100%">
<tr style="vertical-align: top !important;">
<td style="padding: 0px !important;height:799px !important;">
<div style="max-height: 799px;min-height: 799px;overflow: hidden;">
<?php
if(!empty($info["customerid"]))
{
$customerid=$info["customerid"];
if($customerid!='')
{
?>
<table class="table table-bordered responsive-table" style="white-space:normal !important;line-height: 13px !important;height: 799px;">
<thead style="background-color: #eee;">
<tr class="info">
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;"><?=strtoupper($infomainaccesscreditnote['modulename'])?> DATE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;"><?=strtoupper($infomainaccesscreditnote['modulename'])?> NUMBER</span></th>
<!-- <th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;">NAME</span></th> -->
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;"><?=strtoupper($infomainaccesscreditnote['modulename'])?> AMOUNT</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;">BALANCE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align: right;">PAYMENT</span></th>
</tr>
</thead>
<tbody>
<?php
    $i=0;
    $item=1;
    $countt=1;
    $totpros=0;
$sqls=mysqli_query($con,"select creditnoteno, creditnotedate, grandtotal, paidstatus, customerid, customername from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY creditnotedate, creditnoteno  order by creditnotedate asc, creditnoteno asc");
while($infos=mysqli_fetch_array($sqls))
{
$s=0;
if($infos['paidstatus']=='1')
{
$sqlse=mysqli_query($con,"select paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid' and paymentid='".$_GET['id']."'");
if(mysqli_num_rows($sqlse)>0)
{
$s=0;
}
else
{
$s=1;
}
}
if($s==0)
{
$am=0;
$am1=0;
$p='';
$p1=0;
$sqlse=mysqli_query($con,"select amount, paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid'");
while($infose=mysqli_fetch_array($sqlse))
{
if($infose['paymentid']==$_GET['id'])
{
$p='yes';
$p1=(float)$infose['amount'];
}
else
{
$am+=(float)$infose['amount'];
}
$am1+=(float)$infose['amount']; 
}
if($p=='yes')
{
$totpros++;
}
}
}
    $sqls=mysqli_query($con,"select creditnoteno, creditnotedate, grandtotal, paidstatus, customerid, customername from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY creditnotedate, creditnoteno  order by creditnotedate asc, creditnoteno asc");
    while($infos=mysqli_fetch_array($sqls))
    {
        $s=0;
        if($infos['paidstatus']=='1')
        {
            $sqlse=mysqli_query($con,"select paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid' and paymentid='".$_GET['id']."'");
            if(mysqli_num_rows($sqlse)>0)
            {
                $s=0;
            }
            else
            {
                $s=1;
            }
        }
        if($s==0)
        {
        $am=0;
        $am1=0;
        $p='';
        $p1=0;
        $sqlse=mysqli_query($con,"select amount, paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid'");
        while($infose=mysqli_fetch_array($sqlse))
        {
            if($infose['paymentid']==$_GET['id'])
            {
                $p='yes';
                $p1=(float)$infose['amount'];
            }
            else
            {
                $am+=(float)$infose['amount'];
            }
            $am1+=(float)$infose['amount']; 
        }
        if($p=='yes')
        {
        $bal=(float)$infos['grandtotal']-$am;
        if((float)$infos['grandtotal']==$am1)
        {
            $sta='1';
        }
        else
        {
            $sta='2';
        }
        echo '<input type="hidden" name="nos[]" id="creditnote'.$i.'" value="'.$infos['creditnoteno'].'">
        <input type="hidden" name="dates[]" id="date'.$i.'" value="'.$infos['creditnotedate'].'">
        <input type="hidden" name="status[]" id="status'.$i.'" value="'.$sta.'">';
        echo '<tr style="height:28px !important;">';
        echo '<td style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;"><input type="checkbox" name="payments'.$i.'" id="payments'.$i.'" onchange="return changeval('.$i.')" value="'.(number_format((float)$bal,2,'.','')).'" checked disabled style="position:relative;top:0px;"></td>';
        echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' DATE" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;"><input type="text" readonly value="'.date('d/m/Y',strtotime($infos['creditnotedate'])).'" style="text-align: left;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>';
        echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' NUMBER" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;"><input type="text" readonly value="'.$infos['creditnoteno'].'" style="text-align: left;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>';
        // echo '<td data-label="NAME" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;"><input type="text" readonly value="'.(($infos['customerid']!='')?$infos['customername']:$infos['customername']).'" style="text-align: left;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>';
        echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' AMOUNT" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;"><span >'.$rescurrency[0].'</span><input type="text" readonly value="'.(number_format((float)$infos['grandtotal'],2,'.','')).'" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;width:90%;" class="form-control form-control-sm"></td>';
        echo '<td data-label="BALANCE" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;"><span >'.$rescurrency[0].'</span><input type="text" readonly value="'.(number_format((float)$bal,2,'.','')).'" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;width:90%;" class="form-control form-control-sm"></td>';
        echo '<td data-label="PAYMENT" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;" id="amttd"><span >'.$rescurrency[0].'</span><input type="text" class="form-control amt" name="amounts[]" id="amounts'.$i.'" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;width:90%;" value="'.(number_format((float)$p1,2,'.','')).'" readonly></td>';
        echo '</tr>';
        $item++;
        $countt++;
        }
        $i++;
        }
$begin = (ceil(($item-1)/28));
$finish = (ceil(($totpros)/28));
$merge = '';
$merge .= '</tbody>
</table>
';
$merge .= '
</div>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:23px !important;padding: 0px !important;visibility:hidden;">
<td style="padding:0px !important;border-bottom: 0px solid #cccccc;">
<table width="100%">
<tr>
<td width="22%" style="padding:0px 6px !important;">
<table width="100%">
</table>
</td>
<td width="51%" style="padding:0px 6px !important;">
</td>
<td width="27%" style="padding: 0px 0px 0px 6px  !important;border-left: 1px solid #cccccc;vertical-align: top;">
<table width="100%">
<tr>
<td width="43%">Total &nbsp;</td>
<td width="57%" style="font-size: 13px !important;"> : <b><span style="margin-right:-3px !important;position:relative;top:1px;" class="rupeeforprint">'.($rescurrency[0]).'</span><input type="text" readonly value="'.((number_format((float)$info['amount'],2,'.',''))).'" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 13px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
$dateformat = mysqli_query($con,"select * from paricountry");$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {$dateforfooter = 'd/m/Y h:i:s';}
$dates = date('d-m-Y h:i:s');

$merge .= '<tr><td><div style="min-height:0px !important;max-height:0px !important;"><div></td></tr><tr><td><div style="min-height:25px !important;max-height:25px !important;padding: 0px !important;"><div></td></tr><tr style="height:40px !important;"><td style="padding:0px !important;border-bottom: none;"><table width="100%"><tr><td width="30%" style="padding: 0px !important;border-right: 0px solid #cccccc;"><table width="100%"><tr><td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;"><div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;"><span>Printed On :'.date($dateforfooter,strtotime($dates)).'</span></div><div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page '.$begin.'/'.$finish.')</b></div></td></tr></table></td></tr></table></td></tr></table><span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span></div>
<div class="table-responsive myTableValue" style="margin-top:1.6rem;width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;">
<table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 21cm !important;height: 29cm !important;max-width:21cm !important; max-height:29cm !important;min-width:21cm !important; min-height:29cm !important;">

<tr style="height:10px !important;">
<td style="border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td style="text-align:center;line-height: 13px !important;">
<b style="font-size:15px !important;display: inline-flex;white-space: nowrap;width: max-content;overflow: hidden;text-align: center;max-width: 166px;">'.( $infomainaccessuser['modulename'] ).'</b>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:10px !important;">
<td>
<table width="100%">
<tr>
<td style="text-align:center;height: 80px !important;">
<table width="100%">
<tr>
<td width="35%" style="text-align:right;">
';
if($infofranch['branchimage']!='')
{
    $imgs=explode(',',$infofranch['branchimage']);
    foreach($imgs as $img)
    {
    $merge .= '
    <img alt="Branch Pic" src="'.(str_replace('../ups','ups',$img)).'" id="branch-image1" height="80" width="80">
    ';
    }
}
else
{
}
$merge .= '
</td>
<td width="65%" style="text-align:left;vertical-align: top;padding-left: 30px !important;">
<table width="100%">
<tr style="padding:0px !important;">
<td>
<table width="100%" style="padding:0px !important;">
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.($infofranch['franchisename']).'</strong>
</td>
</tr>
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;margin-bottom: -3px;">
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;">'.($infofranch['street']).' '.($infofranch['city']).' '.($infofranch['pincode']).' '.($infofranch['state']).' '.($infofranch['country']).' </span>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="100%">
<tr style="'.(($access['salespayreceivebranchphone']=='0')?'display:none;':'').'">
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">Phone </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">: <span style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$infofranch['mobile'].'</span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;'.(($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':'').'">E-mail </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><input type="text" readonly value=": '.$infofranch['email'].'" style="padding:0px;color:black;width: 206px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;'.(($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':'').'" class="form-control form-control-sm"><span style="'.(($access['salespayreceiveprintdlno20']=='1')?'display:inline-flex;':'display:none;').'white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 20 &nbsp; : '.$infofranch['dlno20'].'</span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;'.(($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':'').'">GSTIN </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><span style="display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;'.(($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':'').'">: '.$infofranch['gstno'].'</span><span style="'.(($access['salespayreceiveprintdlno21']=='1')?'display:inline-flex;':'display:none;').'white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 21 &nbsp; : '.$infofranch['dlno21'].'</span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;border: 1px solid #cccccc;">
<td style="padding: 0px !important;">
<table width="100%">
<tr>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;height: 98px !important;">
<table width="100%">
<tr style="background-color: #eee;'.((in_array('Billing Address', $fieldview))?'':'visibility:hidden;').'">
<td style="padding: 0px !important;">
<strong style="padding:0px 6px !important;">Billing Address</strong>
</td>
</tr>
<tr>
';
if (($sqlcusfetch['customername']!='')&&(in_array('Billing Address', $fieldview))&&(in_array('Billing Name', $fieldview))) {
$merge .= '
<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;">'.(ucwords(strtolower($sqlcusfetch['customername']))).'</strong></td>
';
}
$merge .= '
</tr>
<tr>
<td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">
';
if ((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!='')||($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))&&(in_array('Billing Address', $fieldview))) {
if ((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!=''))) {
$merge .= '
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
    '.(ucwords(strtolower($sqlcusfetch['billstreet']))).' '.(((($sqlcusfetch['billstreet']!='')&&($sqlcusfetch['billcity']!=''))?',':'')).' '.(ucwords(strtolower($sqlcusfetch['billcity']))).'
</span>
<br>
';
}
if ((($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))) {
$merge .= '
<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">
'.($sqlcusfetch['billstate']).' '.(((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billpincode']!=''))?',':'')).' '.($sqlcusfetch['billpincode']).' '.(((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billcountry']!='')||($sqlcusfetch['billpincode']!='')&&($sqlcusfetch['billcountry']!=''))?',':'')).' '.($sqlcusfetch['billcountry']).'
<!-- <br> -->
</span>
';
}
}
$merge .= '
</td>
</tr>
<tr>
<td style="padding: 0px !important;">
<table width="100%">
<tr '.((in_array('Work Phone', $fieldview))?'':'style="display:none;"').'>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Work Phone </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.($sqlcusfetch['workphone']).'</b></td>
</tr>
<tr '.((in_array('GSTIN', $fieldview))?'':'style="display:none;"').'>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">GSTIN </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: 
';
// if (($infomainaccessuser['creditnoteprintgstin']=='show')||($sqlcusfetch['gstno']!='')&&($infomainaccessuser['creditnoteprintgstin']!='hide')) {
$merge .= '
<b style="font-size:12px;padding: 0px !important;display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;">'.($sqlcusfetch['gstin']).'</b>
';
// }
$merge .= '
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;">
<table width="100%">
';
if ((in_array('Reference Number', $fieldview))) {
$merge .= '<tr style="position:relative;top:10px;">
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Reference Number" style="padding:0px;color:black;width: 130px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><input type="text" readonly value="'.($info['receiptno']).'" style="padding:0px;color:black;width: 100px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;font-weight: bold;" class="form-control form-control-sm"></b></td>
</tr>';
}
$merge .= '<tr style="position:relative;top:10px;">
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Amount Received" style="padding:0px;color:black;width: 130px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><input type="text" readonly value="'.((number_format((float)$info['amount'],2,'.',''))).'" style="padding:0px;color:black;width: 100px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;font-weight: bold;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;visibility: hidden;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;visibility: hidden;" width="45%">: <b>'.($info['paymentmode']).'</b></td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: middle;padding: 0px !important;">
<table width="100%" style="text-align: center !important;">
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="'.( $infomainaccessuser['modulename'] ).'" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Number" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.($info['privateid']).'</b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="'.( $infomainaccessuser['modulename'] ).'" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Date" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
    $merge .= '
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.(date($date,strtotime($info['receiptdate']))).'</b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.($info['paymentmode']).'</b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;">
<td style="padding: 0px !important;">
<table width="100%">
<tr style="vertical-align: top !important;">
<td style="padding: 0px !important;height:799px !important;">
<div style="max-height: 799px;min-height: 799px;overflow: hidden;">
<table class="table table-bordered responsive-table" style="white-space:normal !important;line-height: 13px !important;height: 799px;">
<thead style="background-color: #eee;">
<tr class="info">
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;">'.(strtoupper($infomainaccesscreditnote['modulename'])).' DATE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;">'.(strtoupper($infomainaccesscreditnote['modulename'])).' NUMBER</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;">'.(strtoupper($infomainaccesscreditnote['modulename'])).' AMOUNT</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;">BALANCE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align: right;">PAYMENT</span></th>
</tr>
</thead>
<tbody>';
$finalrow=28;
if ($totpros>$finalrow) {
if ((($item-1)%$finalrow)==0) {
if ((($countt-1)-$totpros)!=0) {
if (($item-1)!=0) {
echo $merge;
}
}
}
}
    }
if(($totpros%$finalrow)!=0){
?>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php
}
}
?>
</div>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:23px !important;padding: 0px !important;">
<td style="padding:0px !important;border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td width="22%" style="padding:0px 6px !important;">
<table width="100%">
</table>
</td>
<td width="51%" style="padding:0px 6px !important;">
</td>
<td width="27%" style="padding: 0px 0px 0px 6px  !important;border-left: 1px solid #cccccc;vertical-align: top;">
<table width="100%">
<tr>
<td width="43%">Total &nbsp;</td>
<td width="57%" style="font-size: 13px !important;"> : <b><span style="margin-right:-3px !important;position:relative;top:1px;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=(number_format((float)$info['amount'],2,'.',''))?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 13px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:40px !important;">
<td style="padding:0px !important;border-bottom: none;">
<table width="100%">
<tr>
<td width="30%" style="padding: 0px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<tr>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
    ?>
<td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;">
<div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;"><span>Printed On : <?php $dates = date('d-m-Y h:i:s');echo date($date,strtotime($dates))?></span></div>
<div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page <?=$begin.'/'.$begin?>)</b></div>
</td>
</tr>
</table>
</td>
<td width="40%" style="padding: 0px 6px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<?php
if ((in_array('Notes', $fieldview))) {
?>
<tr>
<td style="font-size: 12px !important;">Notes : <b><span style="display: inline-flex;white-space: nowrap;width: 171px;overflow: hidden;font-size: 12px !important;"><?=$info['notes']?></span></b></td>
</tr>
<?php
}
?>
</table>
</td>
<td width="30%" style="padding: 0px !important;">
<table width="100%">
<tr>
<td style="border:1px solid #cccccc; height:25px !important;width: 237px !important; text-align:center; vertical-align:bottom">
<?php
if($infofranch['signimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$infofranch['signimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Sign Pic" src="<?=str_replace('../ups','ups',$img)?>" id="sign-image1" style="width: 237px !important;height: 25px !important;">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>

    <?php
}
?>
</td>
</tr>
<tr>
<td style="text-align:center;line-height: 10px !important;"><span style="position: relative;top: 1px !important;font-size: 12px !important;">For <strong style="font-size:12px !important;"><?=$infofranch['franchisename']?></strong></span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

</table>
<span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span>
</div>
<style type="text/css">
.insidecard{
    width: max-content !important;
    height: max-content !important;
}
    @supports (not (-moz-appearance:button)) and (contain:paint) and (-webkit-appearance:none) { 
    @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    zoom: 20% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    margin-left: -15px !important;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    zoom: 21% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    zoom: 22% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 300px) {
                #zoomforprint{
                    zoom: 23% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 301px) and (max-device-width: 310px) {
                #zoomforprint{
                    zoom: 25% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 78% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 311px) and (max-device-width: 320px) {
                #zoomforprint{
                    zoom: 27% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 81% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    zoom: 28% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 86% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 340px) {
                #zoomforprint{
                    zoom: 30% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 90% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 341px) and (max-device-width: 350px) {
                #zoomforprint{
                    zoom: 31% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 360px) {
                #zoomforprint{
                    zoom: 33% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 361px) and (max-device-width: 370px) {
                #zoomforprint{
                    zoom: 34% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 371px) and (max-device-width: 380px) {
                #zoomforprint{
                    zoom: 35% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 390px) {
                #zoomforprint{
                    zoom: 36% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 391px) and (max-device-width: 400px) {
                #zoomforprint{
                    zoom: 38% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 410px) {
                #zoomforprint{
                    zoom: 40% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 411px) and (max-device-width: 420px) {
                #zoomforprint{
                    zoom: 41% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 421px) and (max-device-width: 430px) {
                #zoomforprint{
                    zoom: 42% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 431px) and (max-device-width: 440px) {
                #zoomforprint{
                    zoom: 44% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 441px) and (max-device-width: 450px) {
                #zoomforprint{
                    zoom: 45% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 451px) and (max-device-width: 460px) {
                #zoomforprint{
                    zoom: 46% !important;
                    margin-left: -48px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 470px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -48px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 471px) and (max-device-width: 490px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -40px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -20px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 510px) {
                #zoomforprint{
                    zoom: 49% !important;
                    margin-left: -10px !important;
                }
                #templatetext{
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 511px) and (max-device-width: 530px) {
                #zoomforprint{
                    zoom: 49% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 531px) and (max-device-width: 540px) {
                #zoomforprint{
                    zoom: 50% !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 541px) and (max-device-width: 550px) {
                #zoomforprint{
                    zoom: 52% !important;
                }
                #templatetext{
                    margin-right: -3px !important;
                }
            }
            @media screen and (min-device-width: 551px) and (max-device-width: 560px) {
                #zoomforprint{
                    zoom: 53% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 561px) and (max-device-width: 570px) {
                #zoomforprint{
                    zoom: 54% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 571px) and (max-device-width: 580px) {
                #zoomforprint{
                    zoom: 55% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 581px) and (max-device-width: 590px) {
                #zoomforprint{
                    zoom: 56% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 591px) and (max-device-width: 600px) {
                #zoomforprint{
                    zoom: 57% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 610px) {
                #zoomforprint{
                    zoom: 58% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 611px) and (max-device-width: 620px) {
                #zoomforprint{
                    zoom: 59% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 621px) and (max-device-width: 767px) {
                #zoomforprint{
                    zoom: 61% !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 768px) and (max-device-width: 991px) {
                #zoomforprint{
                    zoom: 80% !important;
                }
            }
            @media screen and (min-device-width: 768.5px) and (max-device-width: 790px) {
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 830px) and (max-device-width: 991.7px) {
                #zoomforprint{
                    margin-left: 25px !important;
                }
            }
            @media screen and (min-device-width: 791px) and (max-device-width: 990.5px) {
                #templatetext{
                    margin-right: 25px !important;
                }
            }
            @media screen and (min-device-width: 992px) and (max-device-width: 1020px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -123px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1021px) and (max-device-width: 1199px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1220px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -111px !important;
                }
            }
            @media screen and (min-device-width: 1221px) and (max-device-width: 1250px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -100px !important;
                }
                #templatetext{
                    margin-right: -100px !important;
                }
            }
            @media screen and (min-device-width: 1251px) and (max-device-width: 1290px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -90px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1291px) and (max-device-width: 1330px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -80px !important;
                }
                #templatetext{
                    margin-right: -80px !important;
                }
            }
            @media screen and (min-device-width: 1331px) and (max-device-width: 1360px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -70px !important;
                }
                #templatetext{
                    margin-right: -70px !important;
                }
            }
            @media screen and (min-device-width: 1361px) and (max-device-width: 1400px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    margin-right: -60px !important;
                }
            }
            @media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: -54px !important;
                }
            }
            @media screen and (min-device-width: 1501px) and (max-device-width: 1549px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: -45px !important;
                }
            }
            @media screen and (min-device-width: 1550px) and (max-device-width: 3000px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: 27px !important;
                }
            }
          }
</style>
</div>
<?php
}
else
{
?>
<div id="printalble">
<div class="table-responsive myTableValue" style="width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;">
<table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 21cm !important;height: 14.8cm !important;max-width:21cm !important; max-height:14.8cm !important;min-width:21cm !important; min-height:14.8cm !important;">

<tr style="height:10px !important;">
<td style="border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td style="text-align:center;line-height: 13px !important;">
<b style="font-size:15px !important;display: inline-flex;white-space: nowrap;width: max-content;overflow: hidden;text-align: center;max-width: 166px;"><?= $infomainaccessuser['modulename'] ?></b>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:10px !important;">
<td>
<table width="100%">
<tr>
<td style="text-align:center;height: 80px !important;">
<table width="100%">
<tr>
<td width="35%" style="text-align:right;">
<?php
if($infofranch['branchimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$infofranch['branchimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Branch Pic" src="<?=str_replace('../ups','ups',$img)?>" id="branch-image1" height="80" width="80">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>
    <?php
}
?>
</td>
<td width="65%" style="text-align:left;vertical-align: top;padding-left: 30px !important;">
<table width="100%">
<tr style="padding:0px !important;">
<td>
<table width="100%" style="padding:0px !important;">
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;"><?=$infofranch['franchisename']?></strong>
</td>
</tr>
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;margin-bottom: -3px;">
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;"><?=$infofranch['street']?> <?=$infofranch['city']?> <?=$infofranch['pincode']?> <?=$infofranch['state']?> <?=$infofranch['country']?> </span>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="100%">
<tr style="<?=($access['salespayreceivebranchphone']=='0')?'display:none;':''?>">
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">Phone </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">: <span style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$infofranch['mobile']?></span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;<?=($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':''?>">E-mail </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><input type="text" readonly value=": <?=$infofranch['email']?>" style="padding:0px;color:black;width: 206px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;<?=($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':''?>" class="form-control form-control-sm"><span style="<?=(($access['salespayreceiveprintdlno20']=='1')?'display:inline-flex;':'display:none;')?>white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 20 &nbsp; : <?=$infofranch['dlno20']?></span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;<?=($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':''?>">GSTIN </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><span style="display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;<?=($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':''?>">: <?=$infofranch['gstno']?></span><span style="<?=(($access['salespayreceiveprintdlno21']=='1')?'display:inline-flex;':'display:none;')?>white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 21 &nbsp; : <?=$infofranch['dlno21']?></span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;border: 1px solid #cccccc;">
<td style="padding: 0px !important;">
<table width="100%">
<tr>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;height: 98px !important;">
<table width="100%">
<tr style="background-color: #eee;<?=((in_array('Billing Address', $fieldview))?'':'visibility:hidden;')?>">
<td style="padding: 0px !important;">
<strong style="padding:0px 6px !important;">Billing Address</strong>
</td>
</tr>
<tr>
<?php
if (($sqlcusfetch['customername']!='')&&(in_array('Billing Address', $fieldview))&&(in_array('Billing Name', $fieldview))) {
?>
<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;"><?=ucwords(strtolower($sqlcusfetch['customername']))?></strong></td>
<?php
}
?>
</tr>
<tr>
<td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">
<?php
if ((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!='')||($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))&&(in_array('Billing Address', $fieldview))) {
?>
<?php
if ((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!=''))) {
?>
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
    <?=ucwords(strtolower($sqlcusfetch['billstreet']))?> <?=((($sqlcusfetch['billstreet']!='')&&($sqlcusfetch['billcity']!=''))?',':'')?> <?=ucwords(strtolower($sqlcusfetch['billcity']))?>
</span>
<br>
<?php
}
if ((($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))) {
?>
<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">
<?=$sqlcusfetch['billstate']?> <?=((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billpincode']!=''))?',':'')?> <?=$sqlcusfetch['billpincode']?> <?=((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billcountry']!='')||($sqlcusfetch['billpincode']!='')&&($sqlcusfetch['billcountry']!=''))?',':'')?> <?=$sqlcusfetch['billcountry']?>
<!-- <br> -->
</span>
<?php
}
}
?>
</td>
</tr>
<tr>
<td style="padding: 0px !important;">
<table width="100%">
<tr <?=((in_array('Work Phone', $fieldview))?'':'style="display:none;"')?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Work Phone </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;"><?=$sqlcusfetch['workphone']?></b></td>
</tr>
<tr <?=((in_array('GSTIN', $fieldview))?'':'style="display:none;"')?>>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">GSTIN </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: 
<?php
// if (($infomainaccessuser['creditnoteprintgstin']=='show')||($sqlcusfetch['gstno']!='')&&($infomainaccessuser['creditnoteprintgstin']!='hide')) {
?>
<b style="font-size:12px;padding: 0px !important;display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;"><?=$sqlcusfetch['gstin']?></b>
<?php
// }
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="33%" style="border-right: 1px solid #cccccc;white-space: normal !important;vertical-align: middle;padding: 0px !important;">
<table width="100%" style="text-align: center !important;">
<?php
if ((in_array('Reference Number', $fieldview))) {
?>
<tr style="position:relative;top:10px;">
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Reference Number" style="padding:0px;color:black;width: 130px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><input type="text" readonly value="<?=$info['receiptno']?>" style="padding:0px;color:black;width: 100px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;font-weight: bold;" class="form-control form-control-sm"></b></td>
</tr>
<?php
}
?>
<tr style="position:relative;top:10px;">
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Amount Received" style="padding:0px;color:black;width: 130px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
    ?>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><input type="text" readonly value="<?=(number_format((float)$info['amount'],2,'.',''))?>" style="padding:0px;color:black;width: 100px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;font-weight: bold;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;visibility: hidden;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;visibility: hidden;" width="45%">: <b><?=$info['paymentmode']?></b></td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: middle;padding: 0px !important;">
<table width="100%" style="text-align: center !important;">
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="<?= $infomainaccessuser['modulename'] ?>" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Number" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=$info['privateid']?></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="<?= $infomainaccessuser['modulename'] ?>" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Date" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
    ?>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=date($date,strtotime($info['receiptdate']))?></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><?=$info['paymentmode']?></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;">
<td style="padding: 0px !important;">
<table width="100%">
<tr style="vertical-align: top !important;">
<td style="padding: 0px !important;height:254px !important;">
<div style="max-height: 254px;min-height: 254px;overflow: hidden;">
<?php
if(!empty($info["customerid"]))
{
$customerid=$info["customerid"];
if($customerid!='')
{
?>
<table class="table table-bordered responsive-table" style="white-space:normal !important;line-height: 13px !important;height: 254px;">
<thead style="background-color: #eee;">
<tr class="info">
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;"><?=strtoupper($infomainaccesscreditnote['modulename'])?> DATE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;"><?=strtoupper($infomainaccesscreditnote['modulename'])?> NUMBER</span></th>
<!-- <th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;">NAME</span></th> -->
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;"><?=strtoupper($infomainaccesscreditnote['modulename'])?> AMOUNT</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;">BALANCE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align: right;">PAYMENT</span></th>
</tr>
</thead>
<tbody>
<?php
    $i=0;
    $item=1;
    $countt=1;
    $totpros=0;
$sqls=mysqli_query($con,"select creditnoteno, creditnotedate, grandtotal, paidstatus, customerid, customername from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY creditnotedate, creditnoteno  order by creditnotedate asc, creditnoteno asc");
while($infos=mysqli_fetch_array($sqls))
{
$s=0;
if($infos['paidstatus']=='1')
{
$sqlse=mysqli_query($con,"select paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid' and paymentid='".$_GET['id']."'");
if(mysqli_num_rows($sqlse)>0)
{
$s=0;
}
else
{
$s=1;
}
}
if($s==0)
{
$am=0;
$am1=0;
$p='';
$p1=0;
$sqlse=mysqli_query($con,"select amount, paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid'");
while($infose=mysqli_fetch_array($sqlse))
{
if($infose['paymentid']==$_GET['id'])
{
$p='yes';
$p1=(float)$infose['amount'];
}
else
{
$am+=(float)$infose['amount'];
}
$am1+=(float)$infose['amount']; 
}
if($p=='yes')
{
$totpros++;
}
}
}
    $sqls=mysqli_query($con,"select creditnoteno, creditnotedate, grandtotal, paidstatus, customerid, customername from paircreditnotes where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='$customerid' GROUP BY creditnotedate, creditnoteno  order by creditnotedate asc, creditnoteno asc");
    while($infos=mysqli_fetch_array($sqls))
    {
        $s=0;
        if($infos['paidstatus']=='1')
        {
            $sqlse=mysqli_query($con,"select paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid' and paymentid='".$_GET['id']."'");
            if(mysqli_num_rows($sqlse)>0)
            {
                $s=0;
            }
            else
            {
                $s=1;
            }
        }
        if($s==0)
        {
        $am=0;
        $am1=0;
        $p='';
        $p1=0;
        $sqlse=mysqli_query($con,"select amount, paymentid from paircreditnotepayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and  creditnoteno='".$infos['creditnoteno']."' and creditnotedate='".$infos['creditnotedate']."' and customerid='$customerid'");
        while($infose=mysqli_fetch_array($sqlse))
        {
            if($infose['paymentid']==$_GET['id'])
            {
                $p='yes';
                $p1=(float)$infose['amount'];
            }
            else
            {
                $am+=(float)$infose['amount'];
            }
            $am1+=(float)$infose['amount']; 
        }
        if($p=='yes')
        {
        $bal=(float)$infos['grandtotal']-$am;
        if((float)$infos['grandtotal']==$am1)
        {
            $sta='1';
        }
        else
        {
            $sta='2';
        }
        echo '<input type="hidden" name="nos[]" id="creditnote'.$i.'" value="'.$infos['creditnoteno'].'">
        <input type="hidden" name="dates[]" id="date'.$i.'" value="'.$infos['creditnotedate'].'">
        <input type="hidden" name="status[]" id="status'.$i.'" value="'.$sta.'">';
        echo '<tr style="height:28px !important;">';
        echo '<td style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;"><input type="checkbox" name="payments'.$i.'" id="payments'.$i.'" onchange="return changeval('.$i.')" value="'.(number_format((float)$bal,2,'.','')).'" checked disabled style="position:relative;top:0px;"></td>';
        echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' DATE" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;"><input type="text" readonly value="'.date('d/m/Y',strtotime($infos['creditnotedate'])).'" style="text-align: left;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>';
        echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' NUMBER" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;"><input type="text" readonly value="'.$infos['creditnoteno'].'" style="text-align: left;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>';
        // echo '<td data-label="NAME" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:left;"><input type="text" readonly value="'.(($infos['customerid']!='')?$infos['customername']:$infos['customername']).'" style="text-align: left;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;" class="form-control form-control-sm"></td>';
        echo '<td data-label="'. strtoupper($infomainaccesscreditnote['modulename']) .' AMOUNT" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;"><span >'.$rescurrency[0].'</span><input type="text" readonly value="'.(number_format((float)$infos['grandtotal'],2,'.','')).'" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;width:90%;" class="form-control form-control-sm"></td>';
        echo '<td data-label="BALANCE" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;"><span >'.$rescurrency[0].'</span><input type="text" readonly value="'.(number_format((float)$bal,2,'.','')).'" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;width:90%;" class="form-control form-control-sm"></td>';
        echo '<td data-label="PAYMENT" style="font-size:12px !important;vertical-align:middle !important;padding: 1px 6px !important;text-align:right;" id="amttd"><span >'.$rescurrency[0].'</span><input type="text" class="form-control amt" name="amounts[]" id="amounts'.$i.'" style="text-align: right;padding:0px;color:black;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;width:90%;" value="'.(number_format((float)$p1,2,'.','')).'" readonly></td>';
        echo '</tr>';
        $item++;
        $countt++;
        }
        $i++;
        }
$begin = (ceil(($item-1)/7));
$finish = (ceil(($totpros)/7));
$merge = '';
$merge .= '</tbody>
</table>
</div>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:23px !important;padding: 0px !important;visibility:hidden;">
<td style="padding:0px !important;border-bottom: 0px solid #cccccc;">
<table width="100%">
<tr>
<td width="22%" style="padding:0px 6px !important;">
<table width="100%">
</table>
</td>
<td width="51%" style="padding:0px 6px !important;">
</td>
<td width="27%" style="padding: 0px 0px 0px 6px  !important;border-left: 1px solid #cccccc;vertical-align: top;">
<table width="100%">
<tr>
<td width="43%">Total &nbsp;</td>
<td width="57%" style="font-size: 13px !important;"> : <b><span style="margin-right:-3px !important;position:relative;top:1px;" class="rupeeforprint">'.($rescurrency[0]).'</span><input type="text" readonly value="'.((number_format((float)$info['amount'],2,'.',''))).'" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 13px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
$dateformat = mysqli_query($con,"select * from paricountry");$datefetch = mysqli_fetch_array($dateformat);
if ($datefetch['date']=='DD/MM/YYYY') {$dateforfooter = 'd/m/Y h:i:s';}
$dates = date('d-m-Y h:i:s');

$merge .= '<tr><td><div style="min-height:0px !important;max-height:0px !important;"><div></td></tr><tr><td><div style="min-height:25px !important;max-height:25px !important;padding: 0px !important;"><div></td></tr><tr style="height:40px !important;"><td style="padding:0px !important;border-bottom: none;"><table width="100%"><tr><td width="30%" style="padding: 0px !important;border-right: 0px solid #cccccc;"><table width="100%"><tr><td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;"><div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;"><span>Printed On :'.date($dateforfooter,strtotime($dates)).'</span></div><div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page '.$begin.'/'.$finish.')</b></div></td></tr></table></td></tr></table></td></tr></table><span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span></div>
<div class="table-responsive myTableValue" style="margin-top:1.6rem;width: max-content !important;height: max-content !important;max-width:max-content !important; max-height:max-content !important;min-width:max-content !important; min-height:max-content !important;">
<table id="printarea" style="border:1px solid #cccccc;margin-bottom: -13px !important;width: 21cm !important;height: 14.8cm !important;max-width:21cm !important; max-height:14.8cm !important;min-width:21cm !important; min-height:14.8cm !important;">

<tr style="height:10px !important;">
<td style="border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td style="text-align:center;line-height: 13px !important;">
<b style="font-size:15px !important;display: inline-flex;white-space: nowrap;width: max-content;overflow: hidden;text-align: center;max-width: 166px;">'.( $infomainaccessuser['modulename'] ).'</b>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:10px !important;">
<td>
<table width="100%">
<tr>
<td style="text-align:center;height: 80px !important;">
<table width="100%">
<tr>
<td width="35%" style="text-align:right;">
';
if($infofranch['branchimage']!='')
{
    $imgs=explode(',',$infofranch['branchimage']);
    foreach($imgs as $img)
    {
    $merge .= '
    <img alt="Branch Pic" src="'.(str_replace('../ups','ups',$img)).'" id="branch-image1" height="80" width="80">
    ';
    }
}
else
{
}
$merge .= '
</td>
<td width="65%" style="text-align:left;vertical-align: top;padding-left: 30px !important;">
<table width="100%">
<tr style="padding:0px !important;">
<td>
<table width="100%" style="padding:0px !important;">
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;">
<strong style="font-size:14px;vertical-align: top;display: inline-flex;white-space: nowrap;width: 312px;overflow: hidden;">'.($infofranch['franchisename']).'</strong>
</td>
</tr>
<tr style="padding:0px !important;">
<td style="padding:0px !important;line-height: 15px !important;margin-bottom: -3px;">
<span style="font-size:12px;margin: 0px !important;display: inline-flex;width: 460px;overflow: hidden;white-space: nowrap;">'.($infofranch['street']).' '.($infofranch['city']).' '.($infofranch['pincode']).' '.($infofranch['state']).' '.($infofranch['country']).' </span>
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td>
<table width="100%">
<tr style="'.(($access['salespayreceivebranchphone']=='0')?'display:none;':'').'">
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">Phone </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 13px !important;">: <span style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.$infofranch['mobile'].'</span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;'.(($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':'').'">E-mail </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><input type="text" readonly value=": '.$infofranch['email'].'" style="padding:0px;color:black;width: 206px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 12px;'.(($access['salespayreceivebranchemail']=='0')?'visibility:hidden;':'').'" class="form-control form-control-sm"><span style="'.(($access['salespayreceiveprintdlno20']=='1')?'display:inline-flex;':'display:none;').'white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 20 &nbsp; : '.$infofranch['dlno20'].'</span></td>
</tr>
<tr>
<td width="10%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;'.(($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':'').'">GSTIN </td>
<td width="90%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;"><span style="display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;'.(($access['salespayreceivebranchgstin']=='0')?'visibility:hidden;':'').'">: '.$infofranch['gstno'].'</span><span style="'.(($access['salespayreceiveprintdlno21']=='1')?'display:inline-flex;':'display:none;').'white-space: nowrap;width: 169px;overflow: hidden;float: right;margin-right: 9px;">DL No 21 &nbsp; : '.$infofranch['dlno21'].'</span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;border: 1px solid #cccccc;">
<td style="padding: 0px !important;">
<table width="100%">
<tr>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;height: 98px !important;">
<table width="100%">
<tr style="background-color: #eee;'.((in_array('Billing Address', $fieldview))?'':'visibility:hidden;').'">
<td style="padding: 0px !important;">
<strong style="padding:0px 6px !important;">Billing Address</strong>
</td>
</tr>
<tr>
';
if (($sqlcusfetch['customername']!='')&&(in_array('Billing Address', $fieldview))&&(in_array('Billing Name', $fieldview))) {
$merge .= '
<td style="padding: 0px 6px !important;line-height: 15px !important;"><strong style="font-weight:bold;font-size: 13px !important;display: inline-flex;width: 254px;overflow: hidden;height: 15px;">'.(ucwords(strtolower($sqlcusfetch['customername']))).'</strong></td>
';
}
$merge .= '
</tr>
<tr>
<td style="padding: 0px 6px !important;line-height: 15px !important;white-space: nowrap !important;">
';
if ((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!='')||($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))&&(in_array('Billing Address', $fieldview))) {
$merge .= '
';
if ((($sqlcusfetch['billstreet']!='')||($sqlcusfetch['billcity']!=''))) {
$merge .= '
<span style="font-size:12px;display: inline-flex;width: 254px;overflow: hidden;">
    '.(ucwords(strtolower($sqlcusfetch['billstreet']))).' '.(((($sqlcusfetch['billstreet']!='')&&($sqlcusfetch['billcity']!=''))?',':'')).' '.(ucwords(strtolower($sqlcusfetch['billcity']))).'
</span>
<br>
';
}
if ((($sqlcusfetch['billstate']!='')||($sqlcusfetch['billpincode']!='')||($sqlcusfetch['billcountry']!=''))) {
$merge .= '
<span style="font-size: 12px;display: inline-flex;width: 254px;overflow: hidden;">
'.($sqlcusfetch['billstate']).' '.(((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billpincode']!=''))?',':'')).' '.($sqlcusfetch['billpincode']).' '.(((($sqlcusfetch['billstate']!='')&&($sqlcusfetch['billcountry']!='')||($sqlcusfetch['billpincode']!='')&&($sqlcusfetch['billcountry']!=''))?',':'')).' '.($sqlcusfetch['billcountry']).'
<!-- <br> -->
</span>
';
}
}
$merge .= '
</td>
</tr>
<tr>
<td style="padding: 0px !important;">
<table width="100%">
<tr '.((in_array('Work Phone', $fieldview))?'':'style="display:none;"').'>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">Work Phone </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: <b style="display: inline-flex;white-space: nowrap;width: 100px;overflow: hidden;">'.($sqlcusfetch['workphone']).'</b></td>
</tr>
<tr '.((in_array('GSTIN', $fieldview))?'':'style="display:none;"').'>
<td width="38%" style="font-size:12px;padding:0px 6px !important;line-height: 15px !important;">GSTIN </td>
<td width="62%" style="font-size:12px;padding: 0px !important;line-height: 15px !important;">: 
';
// if (($infomainaccessuser['creditnoteprintgstin']=='show')||($sqlcusfetch['gstno']!='')&&($infomainaccessuser['creditnoteprintgstin']!='hide')) {
$merge .= '
<b style="font-size:12px;padding: 0px !important;display: inline-flex;white-space: nowrap;width: 134px;overflow: hidden;">'.($sqlcusfetch['gstin']).'</b>
';
// }
$merge .= '
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: top;border-right: 1px solid #cccccc;padding: 0px !important;">
<table width="100%">
';
if ((in_array('Reference Number', $fieldview))) {
$merge .= '<tr style="position:relative;top:10px;">
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Reference Number" style="padding:0px;color:black;width: 130px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><input type="text" readonly value="'.($info['receiptno']).'" style="padding:0px;color:black;width: 100px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;font-weight: bold;" class="form-control form-control-sm"></b></td>
</tr>';
}
$merge .= '<tr style="position:relative;top:39px;left:10px;">
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Amount Received" style="padding:0px;color:black;width: 130px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b><input type="text" readonly value="'.((number_format((float)$info['amount'],2,'.',''))).'" style="padding:0px;color:black;width: 100px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;font-weight: bold;" class="form-control form-control-sm"></b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;visibility: hidden;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;visibility: hidden;" width="45%">: <b>'.($info['paymentmode']).'</b></td>
</tr>
</table>
</td>
<td width="33%" style="white-space: normal !important;vertical-align: middle;padding: 0px !important;">
<table width="100%" style="text-align: center !important;">
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="'.( $infomainaccessuser['modulename'] ).'" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Number" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.($info['privateid']).'</b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="'.( $infomainaccessuser['modulename'] ).'" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Date" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td> </td>
';
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y';
    }
    $merge .= '
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.(date($date,strtotime($info['receiptdate']))).'</b></td>
</tr>
<tr>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;" width="55%"><input type="text" readonly value="Payment" style="padding:0px;color:black;width: 56px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> <input type="text" readonly value="Term" style="padding:0px;color:black;width: 54px !important;height: 18px !important;border: none !important;outline: none !important;display: inline-flex;font-size: 14px;" class="form-control form-control-sm"> </td>
<td style="padding: 0px !important;font-size: 14px !important;line-height: 15px !important;text-align: left !important;" width="45%">: <b>'.($info['paymentmode']).'</b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:1px !important;">
<td style="padding: 0px !important;">
<table width="100%">
<tr style="vertical-align: top !important;">
<td style="padding: 0px !important;height:254px !important;">
<div style="max-height: 254px;min-height: 254px;overflow: hidden;">
<table class="table table-bordered responsive-table" style="white-space:normal !important;line-height: 13px !important;height: 254px;">
<thead style="background-color: #eee;">
<tr class="info">
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;">'.(strtoupper($infomainaccesscreditnote['modulename'])).' DATE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;">'.(strtoupper($infomainaccesscreditnote['modulename'])).' NUMBER</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;">'.(strtoupper($infomainaccesscreditnote['modulename'])).' AMOUNT</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align:right;">BALANCE</span></th>
<th style="border:1px solid #ddd !important;vertical-align:middle !important;padding: 0px 6px !important;height: 13px !important;"><span style="display:inline-block;width:100%;color:black !important;font-size:12px !important;text-align: right;">PAYMENT</span></th>
</tr>
</thead>
<tbody>';
$finalrow=7;
if ($totpros>$finalrow) {
if ((($item-1)%$finalrow)==0) {
if ((($countt-1)-($totpros))!=0) {
if (($item-1)!=0) {
echo $merge;
}
}
}
}
    }
if(($totpros%$finalrow)!=0){
?>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<?php
}
?>
</tbody>
</table>
<?php
}
}
?>
</div>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:23px !important;padding: 0px !important;">
<td style="padding:0px !important;border-bottom: 1px solid #cccccc;">
<table width="100%">
<tr>
<td width="22%" style="padding:0px 6px !important;">
<table width="100%">
</table>
</td>
<td width="51%" style="padding:0px 6px !important;">
</td>
<td width="27%" style="padding: 0px 0px 0px 6px  !important;border-left: 1px solid #cccccc;vertical-align: top;">
<table width="100%">
<tr>
<td width="43%">Total &nbsp;</td>
<td width="57%" style="font-size: 13px !important;"> : <b><span style="margin-right:-3px !important;position:relative;top:1px;" class="rupeeforprint"><?=$rescurrency[0]?></span><input type="text" readonly value="<?=(number_format((float)$info['amount'],2,'.',''))?>" style="color:black;width: 86% !important;float: right;text-align: right;font-weight: 700 !important;font-size: 13px !important;height: 18px !important;border: none !important;outline: none !important;padding: 0px 6px !important;" class="form-control form-control-sm"></b></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

<tr style="height:40px !important;">
<td style="padding:0px !important;border-bottom: none;">
<table width="100%">
<tr>
<td width="30%" style="padding: 0px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<tr>
<?php
    $dateformat = mysqli_query($con,"select * from paricountry");
    $datefetch = mysqli_fetch_array($dateformat);
    if ($datefetch['date']=='DD/MM/YYYY') {
    $date = 'd/m/Y h:i:s';
    }
    ?>
<td style="vertical-align:middle !important;text-align: center !important;padding-top: 7px !important;">
<div style="text-align:center;margin-top: -10px !important;font-size: 12px !important;"><span>Printed On : <?php $dates = date('d-m-Y h:i:s');echo date($date,strtotime($dates))?></span></div>
<div style="text-align:center;line-height: 7px !important;font-size: 12px !important;"><b>(Page <?=$begin.'/'.$begin?>)</b></div>
</td>
</tr>
</table>
</td>
<td width="40%" style="padding: 0px 6px !important;border-right: 1px solid #cccccc;">
<table width="100%">
<?php
if ((in_array('Notes', $fieldview))) {
?>
<tr>
<td style="font-size: 12px !important;">Notes : <b><span style="display: inline-flex;white-space: nowrap;width: 171px;overflow: hidden;font-size: 12px !important;"><?=$info['notes']?></span></b></td>
</tr>
<?php
}
?>
</table>
</td>
<td width="30%" style="padding: 0px !important;">
<table width="100%">
<tr>
<td style="border:1px solid #cccccc; height:25px !important;width: 237px !important; text-align:center; vertical-align:bottom">
<?php
if($infofranch['signimage']!='')
{
    ?>
    <?php
    $imgs=explode(',',$infofranch['signimage']);
    foreach($imgs as $img)
    {
    ?>
    <img alt="Sign Pic" src="<?=str_replace('../ups','ups',$img)?>" id="sign-image1" style="width: 237px !important;height: 25px !important;">
    <?php
    }
    ?>

    <?php
}
else
{
    ?>

    <?php
}
?>
</td>
</tr>
<tr>
<td style="text-align:center;line-height: 10px !important;"><span style="position: relative;top: 1px !important;font-size: 12px !important;">For <strong style="font-size:12px !important;"><?=$infofranch['franchisename']?></strong></span></td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>

</table>
<span><span style="background-color:#fff !important;font-size: 8px !important;color: #ccc !important;">PAIRSCRIPT</span></span>
</div>
<style type="text/css">
.insidecard{
    width: max-content !important;
    height: max-content !important;
}
 @-moz-document url-prefix() {
@media screen and (min-device-width: 100px) and (max-device-width: 350px) {
#templatetext{
margin-top: -430px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 430px) {
#templatetext{
margin-top: -390px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 431px) and (max-device-width: 500px) {
#templatetext{
margin-top: -330px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 501px) and (max-device-width: 580px) {
#templatetext{
margin-top: -290px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 581px) and (max-device-width: 767px) {
#templatetext{
margin-top: -250px !important;
position:relative;
left:-70px;
}
}
@media screen and (min-device-width: 768px) and (max-device-width: 1300px) {
#templatetext{
margin-top: -132px !important;
position:relative;
left:-100px;
}
}
@media screen and (min-device-width: 1301px) and (max-device-width: 1400px) {
#templatetext{
margin-top: -80px !important;
}
}
@media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
#templatetext{
margin-top: -30px !important;
}
}
@media screen and (min-device-width: 1501px) and (max-device-width: 3000px) {
#templatetext{
margin-top: 30px !important;
}
}
}
    @supports (not (-moz-appearance:button)) and (contain:paint) and (-webkit-appearance:none) { 
    @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    zoom: 20% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 60% !important;
                    margin-left: -15px !important;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    zoom: 21% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 60% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    zoom: 22% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 300px) {
                #zoomforprint{
                    zoom: 23% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 66% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 301px) and (max-device-width: 310px) {
                #zoomforprint{
                    zoom: 25% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 75% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 311px) and (max-device-width: 320px) {
                #zoomforprint{
                    zoom: 27% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 78% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    zoom: 28% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 84% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 340px) {
                #zoomforprint{
                    zoom: 30% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 88% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 341px) and (max-device-width: 350px) {
                #zoomforprint{
                    zoom: 31% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 90% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 360px) {
                #zoomforprint{
                    zoom: 33% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 93% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 361px) and (max-device-width: 370px) {
                #zoomforprint{
                    zoom: 34% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 371px) and (max-device-width: 380px) {
                #zoomforprint{
                    zoom: 35% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 390px) {
                #zoomforprint{
                    zoom: 36% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 391px) and (max-device-width: 400px) {
                #zoomforprint{
                    zoom: 38% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 410px) {
                #zoomforprint{
                    zoom: 40% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 411px) and (max-device-width: 420px) {
                #zoomforprint{
                    zoom: 41% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 421px) and (max-device-width: 430px) {
                #zoomforprint{
                    zoom: 42% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 431px) and (max-device-width: 440px) {
                #zoomforprint{
                    zoom: 44% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 441px) and (max-device-width: 450px) {
                #zoomforprint{
                    zoom: 45% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 451px) and (max-device-width: 460px) {
                #zoomforprint{
                    zoom: 46% !important;
                    margin-left: -48px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 470px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -48px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 471px) and (max-device-width: 490px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -40px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    zoom: 47% !important;
                    margin-left: -20px !important;
                }
                #templatetext{
                    zoom: 100% !important;
                    position: relative;
                    left: -15px !important;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 510px) {
                #zoomforprint{
                    zoom: 49% !important;
                    margin-left: -10px !important;
                }
                #templatetext{
                    margin-right: -15px !important;
                }
            }
            @media screen and (min-device-width: 511px) and (max-device-width: 530px) {
                #zoomforprint{
                    zoom: 49% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 531px) and (max-device-width: 540px) {
                #zoomforprint{
                    zoom: 50% !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 541px) and (max-device-width: 550px) {
                #zoomforprint{
                    zoom: 52% !important;
                }
                #templatetext{
                    margin-right: -3px !important;
                }
            }
            @media screen and (min-device-width: 551px) and (max-device-width: 560px) {
                #zoomforprint{
                    zoom: 53% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 561px) and (max-device-width: 570px) {
                #zoomforprint{
                    zoom: 54% !important;
                }
                #templatetext{
                    margin-right: -6px !important;
                }
            }
            @media screen and (min-device-width: 571px) and (max-device-width: 580px) {
                #zoomforprint{
                    zoom: 55% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 581px) and (max-device-width: 590px) {
                #zoomforprint{
                    zoom: 56% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 591px) and (max-device-width: 600px) {
                #zoomforprint{
                    zoom: 57% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 610px) {
                #zoomforprint{
                    zoom: 58% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 611px) and (max-device-width: 620px) {
                #zoomforprint{
                    zoom: 59% !important;
                }
                #templatetext{
                    margin-right: 9px !important;
                }
            }
            @media screen and (min-device-width: 621px) and (max-device-width: 767px) {
                #zoomforprint{
                    zoom: 61% !important;
                }
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 768px) and (max-device-width: 991px) {
                #zoomforprint{
                    zoom: 80% !important;
                }
            }
            @media screen and (min-device-width: 768.5px) and (max-device-width: 790px) {
                #templatetext{
                    margin-right: 0px !important;
                }
            }
            @media screen and (min-device-width: 830px) and (max-device-width: 991.7px) {
                #zoomforprint{
                    margin-left: 25px !important;
                }
            }
            @media screen and (min-device-width: 791px) and (max-device-width: 990.5px) {
                #templatetext{
                    margin-right: 25px !important;
                }
            }
            @media screen and (min-device-width: 992px) and (max-device-width: 1020px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -123px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1021px) and (max-device-width: 1199px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1220px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -111px !important;
                }
                #templatetext{
                    margin-right: -111px !important;
                }
            }
            @media screen and (min-device-width: 1221px) and (max-device-width: 1250px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -100px !important;
                }
                #templatetext{
                    margin-right: -100px !important;
                }
            }
            @media screen and (min-device-width: 1251px) and (max-device-width: 1290px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -90px !important;
                }
                #templatetext{
                    margin-right: -90px !important;
                }
            }
            @media screen and (min-device-width: 1291px) and (max-device-width: 1330px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -80px !important;
                }
                #templatetext{
                    margin-right: -80px !important;
                }
            }
            @media screen and (min-device-width: 1331px) and (max-device-width: 1360px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -70px !important;
                }
                #templatetext{
                    margin-right: -70px !important;
                }
            }
            @media screen and (min-device-width: 1361px) and (max-device-width: 1400px) {
                #zoomforprint{
                    zoom: 100% !important;
                    margin-left: -60px !important;
                }
                #templatetext{
                    margin-right: -60px !important;
                }
            }
            @media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: -54px !important;
                }
            }
            @media screen and (min-device-width: 1501px) and (max-device-width: 1549px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: -45px !important;
                }
            }
            @media screen and (min-device-width: 1550px) and (max-device-width: 3000px) {
                #zoomforprint{
                    zoom: 100% !important;
                }
                #templatetext{
                    margin-right: 27px !important;
                }
            }
          }
</style>
</div>
<?php
}
?>
</div>
<p align="right" class="mt-3" style="margin-right:-25px; cursor:pointer" id="templatetext">Template: '<?=($infofranch['salesreturnpaymenttemplate']=='0')?'Standard A5 Landscape':''?><?=($infofranch['salesreturnpaymenttemplate']=='1')?'Standard A4 Portrait':''?> ' <a data-bs-toggle="modal" data-bs-target="#changecustomerrefundModal" class="text-blue">Change</a></p>
</div>
 <!-- Modal -->
<div class="modal fade" id="changecustomerrefundModal" tabindex="-1" role="dialog" aria-labelledby="changecustomerrefundModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changecustomerrefundModalLabel" style="font-weight:normal;">Choose Template</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <!-------------->
      
<table width="100%">
<tr>
<td width="50%" style="text-align:center">
 <div class="imgcontainer" id="standardcontainer">
  <img src="a4.png" id="advancedimg" alt="Snow" onclick="advancedclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered" id="advancedtext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">Standard A4 Portrait</p>
</td>
<td width="50%" style="text-align:center" id="webprintdesign">
 <div class="imgcontainer" id="standardcontainer">
  <img src="a5.png" id="standardimg" class="standardimg" alt="Snow" onclick="standandclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered standardtext" id="standardtext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">Standard A5 Landscape</p>
</td>
</tr>
<tr id="mobprintdesign" style="display: none;">
<td width="50%" style="text-align:center">
 <div class="imgcontainer" id="standardcontainer">
  <img src="a5.png" id="standardimg" class="standardimg" alt="Snow" onclick="standandclick()" style="width:90%;box-shadow: 0 0 5px #aaaaaa;">
  <div class="centered standardtext" id="standardtext" style="display:none"><i class="fa fa-check-circle"></i></div>
</div>
<p class="text-blue mt-2 mb-0 pb-0">Standard A5 Landscape</p>
</td>
</tr>
</table>

<script>
function standandclick()
{
    $("#advancedtext").css('display','none');
    $(".standardtext").css('display','block');
    $(".standardimg").css('border','1px solid #1BBC9B');
    $("#advancedimg").css('border','none'); 
    $(".standardimg").css('opacity','0.5');
    $("#advancedimg").css('opacity','1');   
    setTimeout(function() {
var r = confirm('Are you sure want to Change this Template?');
if (r == true) {
    window.location.href='changetemplatereceipt.php?template=salesreturnpayment&id=<?=$id?>&publicid=<?=$info['publicid']?>&receiptno=<?=$_GET['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&temptype=0&submt=submt';
} else {
   
}
}, 100);
}
</script>

<script>
function advancedclick()
{
    $(".standardtext").css('display','none');
    $("#advancedtext").css('display','block');
    $("#advancedimg").css('border','1px solid #1BBC9B');
    $(".standardimg").css('border','none'); 
    $("#advancedimg").css('opacity','0.5');
    $(".standardimg").css('opacity','1');   
    setTimeout(function() {
var r = confirm('Are you sure want to Change this Template?');
if (r == true) {
    window.location.href='changetemplatereceipt.php?template=salesreturnpayment&id=<?=$id?>&publicid=<?=$info['publicid']?>&receiptno=<?=$_GET['receiptno']?>&receiptdate=<?=$info['receiptdate']?>&temptype=1&submt=submt';
} else {
   
}
}, 100);
}
<?php
if($infofranch['salesreturnpaymenttemplate']=='1')
{
    ?>
    $(".standardtext").css('display','none');
    $("#advancedtext").css('display','block');
    $("#advancedimg").css('border','1px solid #1BBC9B');
    $(".standardimg").css('border','none'); 
    $("#advancedimg").css('opacity','0.5');
    $(".standardimg").css('opacity','1');   
    <?php
}
else
{
    ?>
    $("#advancedtext").css('display','none');
    $(".standardtext").css('display','block');
    $(".standardimg").css('border','1px solid #1BBC9B');
    $("#advancedimg").css('border','none'); 
    $(".standardimg").css('opacity','0.5');
    $("#advancedimg").css('opacity','1');   
    <?php
}
?>
</script>

      <!-------------->
      </div>
      <div class="modal-footer" style="margin-top: 33px !important;">
          <a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Close</span></p></a>
          
      </div>
    </div>
  </div>
</div>
</div>

</div>
</div>
</form>
<?php
}
?>
			 
            </div>
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<?php
if($infofranch['salesreturnpaymenttemplate']=='1')
{
?>
<script>
function converHTMLFileToPDF() {
$('#pdfObj').html('<div class="text-center"><span id="timer">Please wait <span id="time"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');
// ajax for get
$.ajax({
type: "GET",
url: 'salespaydompdf.php?term=customerrefund&names=<?= $infomainaccessuser['modulename'] ?>-<?=$info['privateid']?>-<?=$_GET['receiptdate']?>&receiptno=<?=$_GET['receiptno']?>&receiptdate=<?=$_GET['receiptdate']?>&sizes=a4&id=<?=$_GET['id']?>',
success: function (result) {
if (result && result.length > 0) {       
result=$.parseJSON( result );
Timer=result.timer;
}
$("#time").html(Timer);
 var req = new XMLHttpRequest();
  req.open("GET", "dompdf/<?= $infomainaccessuser['modulename'] ?>-<?=$info['privateid']?>-<?=$_GET['receiptdate']?>.pdf", true);
  req.responseType = "blob";

  req.onload = function (event) {
    var blob = req.response;
    console.log(blob.size);
    url=URL.createObjectURL(blob);
    obj = '<object id="pdfObjObj" data="'+url+'" type="application/pdf" width="100%" height="550"></object>';
    $('#pdfObj').html(obj)        
  };

  req.send();
},
error: function (error) {
alert(error);
}
});
// it is done
}
</script>
<script>

function downloadpdf() {
$("#exampleModaldownload").modal("show");
$('#pdfObjdownload').html('<div class="text-center"><span id="timerdownload">Please wait <span id="timedownload"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');
    // ajax for get
$.ajax({
type: "GET",
url: 'salespaydompdf.php?term=customerrefund&names=<?= $infomainaccessuser['modulename'] ?>-<?=$info['privateid']?>-<?=$_GET['receiptdate']?>&receiptno=<?=$_GET['receiptno']?>&receiptdate=<?=$_GET['receiptdate']?>&sizes=a4&id=<?=$_GET['id']?>',
success: function (result) {
if (result && result.length > 0) {       
result=$.parseJSON( result );
Timer=result.timer;
}
$("#timedownload").html(Timer);
 var req = new XMLHttpRequest();
  req.open("GET", "dompdf/<?= $infomainaccessuser['modulename'] ?>-<?=$info['privateid']?>-<?=$_GET['receiptdate']?>.pdf", true);
  req.responseType = "blob";

  req.onload = function (event) {
    var blob = req.response;
    console.log(blob.size);
    var link=document.createElement('a');
    link.href=window.URL.createObjectURL(blob);
    link.download="<?= $infomainaccessuser['modulename'] ?>-<?=$info['privateid']?>-<?=$_GET['receiptdate']?>.pdf";
    link.click();
  };

  req.send();
$("#exampleModaldownload").modal("hide");
alert("Pdf Downloaded Successfully");
},
error: function (error) {
alert(error);
}
});
// it is done
}

</script>
<?php
}
if($infofranch['salesreturnpaymenttemplate']=='0'){
?>
<script>
function converHTMLFileToPDF() {
$('#pdfObj').html('<div class="text-center"><span id="timer">Please wait <span id="time"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');
// ajax for get
$.ajax({
type: "GET",
url: 'salespaydompdf.php?term=customerrefund&names=<?= $infomainaccessuser['modulename'] ?>-<?=$info['privateid']?>-<?=$_GET['receiptdate']?>&receiptno=<?=$_GET['receiptno']?>&receiptdate=<?=$_GET['receiptdate']?>&sizes=a5&id=<?=$_GET['id']?>',
success: function (result) {
if (result && result.length > 0) {       
result=$.parseJSON( result );
Timer=result.timer;
}
$("#time").html(Timer);
 var req = new XMLHttpRequest();
  req.open("GET", "dompdf/<?= $infomainaccessuser['modulename'] ?>-<?=$info['privateid']?>-<?=$_GET['receiptdate']?>.pdf", true);
  req.responseType = "blob";

  req.onload = function (event) {
    var blob = req.response;
    console.log(blob.size);
    url=URL.createObjectURL(blob);
    obj = '<object id="pdfObjObj" data="'+url+'" type="application/pdf" width="100%" height="550"></object>';
    $('#pdfObj').html(obj)        
  };

  req.send();
},
error: function (error) {
alert(error);
}
});
// it is done
}
</script>
<script>

function downloadpdf() {
$("#exampleModaldownload").modal("show");
$('#pdfObjdownload').html('<div class="text-center"><span id="timerdownload">Please wait <span id="timedownload"></span> Seconds</span></div><br><img src="loading.gif" width="100%">');
    // ajax for get
$.ajax({
type: "GET",
url: 'salespaydompdf.php?term=customerrefund&names=<?= $infomainaccessuser['modulename'] ?>-<?=$info['privateid']?>-<?=$_GET['receiptdate']?>&receiptno=<?=$_GET['receiptno']?>&receiptdate=<?=$_GET['receiptdate']?>&sizes=a5&id=<?=$_GET['id']?>',
success: function (result) {
if (result && result.length > 0) {       
result=$.parseJSON( result );
Timer=result.timer;
}
$("#timedownload").html(Timer);
 var req = new XMLHttpRequest();
  req.open("GET", "dompdf/<?= $infomainaccessuser['modulename'] ?>-<?=$info['privateid']?>-<?=$_GET['receiptdate']?>.pdf", true);
  req.responseType = "blob";

  req.onload = function (event) {
    var blob = req.response;
    console.log(blob.size);
    var link=document.createElement('a');
    link.href=window.URL.createObjectURL(blob);
    link.download="<?= $infomainaccessuser['modulename'] ?>-<?=$info['privateid']?>-<?=$_GET['receiptdate']?>.pdf";
    link.click();
  };

  req.send();
$("#exampleModaldownload").modal("hide");
alert("Pdf Downloaded Successfully");
},
error: function (error) {
alert(error);
}
});
// it is done
}

</script>
<?php
}
?>

<script>
        function printDiv() {
            var divContents = document.getElementById("printarea").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html><link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />');
            a.document.write('<body >');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>
 <script>
    $(document).ready(function(){
      var searchTerm = 'payments';
      var tables = $('.myTableValue');
      tables.each(function() {
        var matchingIds = $(this).find('[id^="' + searchTerm + '"]');
        if(matchingIds.length > 0) {} 
        else {
          $(this).css("display","none");
        }
      });
    });
  </script>
 
</body>

</html>
<?php
}
else{
header("Location:customerrefunds.php?error=No Information Found");
}
}
else{
header("Location:customerrefunds.php?error=No Information Found");  
}
?>