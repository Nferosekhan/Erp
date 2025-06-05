<?php
include('lcheck.php');
if($permissionbooks=='0')
{
  header('Location: dashboard.php');
}
$sql="SELECT * FROM paircontrols WHERE id='$companymainid';";
$result=mysqli_query($con,$sql);
$rows=mysqli_fetch_assoc($result);
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
// $oldpermissionitems=$rows['permissionitems'];
// $oldpermissionproducts=$rows['permissionproducts'];
if (isset($_POST['submit'])) {
    // $iheadch=mysqli_real_escape_string($con,$_POST['itemchbox']);
    // $headch=mysqli_real_escape_string($con,$_POST['prochbox']);
    // $servch=mysqli_real_escape_string($con,$_POST['servchbox']);
    // $invadjch=mysqli_real_escape_string($con,$_POST['invadjch']);
    // $salech=mysqli_real_escape_string($con,$_POST['salechbox']);
    // $cusch=mysqli_real_escape_string($con,$_POST['cuschbox']);
    // $saleorderch=mysqli_real_escape_string($con,$_POST['saleorderch']);
    // $saleordersch=mysqli_real_escape_string($con,$_POST['saleordersch']);
    // $qtch=mysqli_real_escape_string($con,$_POST['qtchbox']);
    // $esch=mysqli_real_escape_string($con,$_POST['eschbox']);
    // $pforminvch=mysqli_real_escape_string($con,$_POST['pforminvch']);
    // $deliverychch=mysqli_real_escape_string($con,$_POST['deliverychch']);
    // $invch=mysqli_real_escape_string($con,$_POST['invchbox']);
    // $payreceivech=mysqli_real_escape_string($con,$_POST['payreceivech']);
    // $salereturnch=mysqli_real_escape_string($con,$_POST['salereturnch']);
    // $purchasesch=mysqli_real_escape_string($con,$_POST['purchasesch']);
    // $vendorch=mysqli_real_escape_string($con,$_POST['vendorch']);
    // $purorderch=mysqli_real_escape_string($con,$_POST['purorderch']);
    // $purreceivech=mysqli_real_escape_string($con,$_POST['purreceivech']);
    // $billch=mysqli_real_escape_string($con,$_POST['billch']);
    // $paymadech=mysqli_real_escape_string($con,$_POST['paymadech']);
    // $purreturnch=mysqli_real_escape_string($con,$_POST['purreturnch']);
    // $bankch=mysqli_real_escape_string($con,$_POST['bankch']);
    // $expensch=mysqli_real_escape_string($con,$_POST['expensch']);
    // $accountch=mysqli_real_escape_string($con,$_POST['accountch']);
    // $manualjournalsch=mysqli_real_escape_string($con,$_POST['manualjournalch']);
    // $chartaccountch=mysqli_real_escape_string($con,$_POST['chartaccountch']);
    // $timetrackingch=mysqli_real_escape_string($con,$_POST['timetrackingch']);
    // $projectsch=mysqli_real_escape_string($con,$_POST['projectsch']);
    // $timesheetch=mysqli_real_escape_string($con,$_POST['timesheetch']);
    // $ewaybillsch=mysqli_real_escape_string($con,$_POST['ewaybillsch']);
    // $gstfillingch=mysqli_real_escape_string($con,$_POST['gstfillingch']);
    // $payrollch=mysqli_real_escape_string($con,$_POST['payrollch']);
    // $attendencech=mysqli_real_escape_string($con,$_POST['attendencech']);
    // $reportch=mysqli_real_escape_string($con,$_POST['reportch']);
    // $permissionitems=mysqli_real_escape_string($con, (isset($_POST['items']))?'1':'0');
    // $permissionproducts=mysqli_real_escape_string($con, (isset($_POST['product']))?'1':'0');
    // $permissionservices=mysqli_real_escape_string($con, (isset($_POST['services']))?'1':'0');
    // $permissioninvadj=mysqli_real_escape_string($con, (isset($_POST['invadj']))?'1':'0');
    // $permissionsales=mysqli_real_escape_string($con, (isset($_POST['sales']))?'1':'0');
    // $permissioncustomers=mysqli_real_escape_string($con, (isset($_POST['customers']))?'1':'0');
    // $permissionsaleorder=mysqli_real_escape_string($con, (isset($_POST['saleorder']))?'1':'0');
    // $permissionsaleorders=mysqli_real_escape_string($con, (isset($_POST['saleorders']))?'1':'0');
    // $permissionquotations=mysqli_real_escape_string($con, (isset($_POST['quotations']))?'1':'0');
    // $permissionestimates=mysqli_real_escape_string($con, (isset($_POST['estimates']))?'1':'0');
    // $permissiondeliverychallan=mysqli_real_escape_string($con, (isset($_POST['deliverychallan']))?'1':'0');
    // $permissionpforminv=mysqli_real_escape_string($con, (isset($_POST['pforminv']))?'1':'0');
    // $permissioninvoices=mysqli_real_escape_string($con, (isset($_POST['invoices']))?'1':'0');
    // $permissionpayreceive=mysqli_real_escape_string($con, (isset($_POST['payreceive']))?'1':'0');
    // $permissionsalereturn=mysqli_real_escape_string($con, (isset($_POST['salereturn']))?'1':'0');
    // $permissionpurchases=mysqli_real_escape_string($con, (isset($_POST['purchases']))?'1':'0');
    // $permissionvendor=mysqli_real_escape_string($con, (isset($_POST['vendor']))?'1':'0');
    // $permissionpurorder=mysqli_real_escape_string($con, (isset($_POST['purorder']))?'1':'0');
    // $permissionpurreceive=mysqli_real_escape_string($con, (isset($_POST['purreceive']))?'1':'0');
    // $permissionbill=mysqli_real_escape_string($con, (isset($_POST['bill']))?'1':'0');
    // $permissionpaymade=mysqli_real_escape_string($con, (isset($_POST['paymade']))?'1':'0');
    // $permissionpurreturn=mysqli_real_escape_string($con, (isset($_POST['purreturn']))?'1':'0');
    // $permissionbanking=mysqli_real_escape_string($con, (isset($_POST['banking']))?'1':'0');
    // $permissionexpens=mysqli_real_escape_string($con, (isset($_POST['expens']))?'1':'0');
    // $permissionaccount=mysqli_real_escape_string($con, (isset($_POST['account']))?'1':'0');
    // $permissionmanualjournals=mysqli_real_escape_string($con, (isset($_POST['manualjournal']))?'1':'0');
    // $permissionchartaccount=mysqli_real_escape_string($con, (isset($_POST['chartaccount']))?'1':'0');
    // $permissiontimetracking=mysqli_real_escape_string($con, (isset($_POST['timetracking']))?'1':'0');
    // $permissionprojects=mysqli_real_escape_string($con, (isset($_POST['projects']))?'1':'0');
    // $permissiontimesheet=mysqli_real_escape_string($con, (isset($_POST['timesheet']))?'1':'0');
    // $permissionewaybills=mysqli_real_escape_string($con, (isset($_POST['ewaybills']))?'1':'0');
    // $permissiongstfilling=mysqli_real_escape_string($con, (isset($_POST['gstfilling']))?'1':'0');
    // $permissionpayroll=mysqli_real_escape_string($con, (isset($_POST['payroll']))?'1':'0');
    // $permissionattendence=mysqli_real_escape_string($con, (isset($_POST['attendence']))?'1':'0');
    // $permissionreport=mysqli_real_escape_string($con, (isset($_POST['report']))?'1':'0');
    // $sqlup=mysqli_query($con,"update paircontrols set permissionitems='$permissionitems',permissionproducts='$permissionproducts',permissionservices='$permissionservices',permissioninvadj='$permissioninvadj',permissionsales='$permissionsales',permissioncustomers='$permissioncustomers',permissionssaleorder='$permissionsaleorder',permissionsaleorders='$permissionsaleorders',permissionquotations='$permissionquotations',permissionestimates='$permissionestimates',permissionspforminv='$permissionpforminv',permissiondeliverych='$permissiondeliverychallan',permissioninvoices='$permissioninvoices',permissionspayreceive='$permissionpayreceive',permissionssalereturn='$permissionsalereturn',permissionspurchases='$permissionpurchases',permissionsvendor='$permissionvendor',permissionspurorder='$permissionpurorder',permissionpurreceive='$permissionpurreceive',permissionsbill='$permissionbill',permissionspaymade='$permissionpaymade',permissionspurreturn='$permissionpurreturn',permissionbanking='$permissionbanking',permissionsexpens='$permissionexpens',permissionaccounting='$permissionaccount',permissionmanualjournals='$permissionmanualjournals',permissionchartaccount='$permissionchartaccount',permissiontimetracking='$permissiontimetracking',permissionprojects='$permissionprojects',permissiontimesheet='$permissiontimesheet',permissionewaybills='$permissionewaybills',permissiongstfilling='$permissiongstfilling',permissionpayroll='$permissionpayroll',permissionattendence='$permissionattendence',permissionsreport='$permissionreport',prohead='$headch',itemhead='$iheadch',servch='$servch',invadjch='$invadjch',salech='$salech',cusch='$cusch',saleorderch='$saleorderch',saleordersch='$saleordersch',qtch='$qtch',esch='$esch',pforminvhead='$pforminvch',deliverychch='$deliverychch',invch='$invch',payreceivech='$payreceivech',salereturnch='$salereturnch',purch='$purchasesch',vendorch='$vendorch',purorderch='$purorderch',purreceivech='$purreceivech',billch='$billch',paymadech='$paymadech',purreturnch='$purreturnch',bankch='$bankch',expch='$expensch',accountch='$accountch',manualjournalsch='$manualjournalsch',chartaccountch='$chartaccountch',timetrackingch='$timetrackingch',projectsch='$projectsch',timesheetch='$timesheetch',ewaybillsch='$ewaybillsch',gstfillingch='$gstfillingch',payrollch='$payrollch',attendencech='$attendencech',reportch='$reportch' where id='$companymainid' or createdid='$companymainid'");

    // $enqch=mysqli_real_escape_string($con,$_POST['enqbox']);
    // $permissionenquiry=mysqli_real_escape_string($con, (isset($_POST['enquiry']))?'1':'0');
    
    // $sqlup=mysqli_query($con,"update pairaccess set permissionenquiry='$permissionenquiry',enqch='$enqch' where createdid='$companymainid'");
$orderingans = 0;
$ch='';
           $sqlmain = mysqli_query($con,"select distinct grouptype,groupname,groupaccess from pairmainaccess where userid='$companymainid' and createdid='0'");
while($sqlmainresult = mysqli_fetch_array($sqlmain)){
    $grouptype = preg_replace('/\s+/', '', $sqlmainresult['grouptype']);
    $maingrouptype=$sqlmainresult['grouptype'];
                $maingrouptype=$sqlmainresult['grouptype'];
                $maingroupname=$sqlmainresult['groupname'];
                $maingroupaccess=$sqlmainresult['groupaccess'];
                $groupaccesscol="group".strtolower($grouptype);
                $groupaccess=mysqli_real_escape_string($con, (isset($_POST[$groupaccesscol]))?'1':'0');
                $grouptypecol="grouptype".strtolower($grouptype);
                $grouptype=mysqli_real_escape_string($con, $_POST[$grouptypecol]);
                $sqlmainaccess = "update pairmainaccess set groupname='$grouptype',groupaccess='$groupaccess' where (userid='$companymainid' or createdid='$companymainid') and grouptype='$maingrouptype'"; 
                $sqlmainaccessup = mysqli_query($con, $sqlmainaccess);
                if($grouptype!=$maingroupname)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$maingrouptype.' <span style="color:green;" id="prohisfromtospan">( From '.$maingroupname.' To '.$grouptype.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$maingrouptype.' <span style="color:green;" id="prohisfromtospan">( From '.$maingroupname.' To '.$grouptype.' ) </span>';
                    }
                    }
                if($groupaccess!=$maingroupaccess)
                {
                        $maingroupaccessans=$maingroupaccess;
                        $grouptypeans=$groupaccess;
                        if ($maingroupaccessans==1) {
                            $maingroupaccessansfinal='ENABLE';
                        }
                        else{
                            $maingroupaccessansfinal='DISABLE';
                        }
                        if ($grouptypeans==1) {
                            $groupaccessansfinal='ENABLE';
                        }
                        else{
                            $groupaccessansfinal='DISABLE';
                        }
                    if($ch!='')
                    {
                        $ch.='<br> '.$maingrouptype.' <span style="color:green;" id="prohisfromtospan">( From '.$maingroupaccessansfinal.' To '.$groupaccessansfinal.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$maingrouptype.' <span style="color:green;" id="prohisfromtospan">( From '.$maingroupaccessansfinal.' To '.$groupaccessansfinal.' ) </span>';
                    }                   
                }
            $sqlismainaccess=mysqli_query($con, "select distinct modulename,moduleaccess,moduletype from pairmainaccess where userid='$companymainid' and (grouptype='$maingrouptype' and moduletype!='') ORDER BY ordering ASC");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
    if ($infomainaccess['moduletype']!='') {
                $moduletypeans=$infomainaccess['moduletype'];
                $modulenameans=$infomainaccess['modulename'];
                $moduleaccessans=$infomainaccess['moduleaccess'];
                $moduleaccesscol="module".strtolower($coltype);
                $moduleaccess=mysqli_real_escape_string($con, (isset($_POST[$moduleaccesscol]))?'1':'0');
                $moduletypecol="moduletype".strtolower($coltype);
                $moduletype=mysqli_real_escape_string($con, $_POST[$moduletypecol]);
                $orderingans++;
                $sqlmainaccess = "update pairmainaccess set modulename='$moduletype',moduleaccess='$moduleaccess',ordering='$orderingans' where (userid='$companymainid' or createdid='$companymainid') and moduletype='$moduletypeans'"; 
                $sqlmainaccessup = mysqli_query($con, $sqlmainaccess);
                if ($sqlmainaccessup) {
                if($moduletype!=$modulenameans)
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$moduletypeans.' <span style="color:green;" id="prohisfromtospan">( From '.$modulenameans.' To '.$moduletype.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$moduletypeans.' <span style="color:green;" id="prohisfromtospan">( From '.$modulenameans.' To '.$moduletype.' ) </span>';
                    }                   
                }
                if($moduleaccess!=$moduleaccessans)
                {
                        $moduleaccessansans=$moduleaccessans;
                        $moduleaccessans=$moduleaccess;
                        if ($moduleaccessansans==1) {
                            $moduleaccessansansansfinal='ENABLE';
                        }
                        else{
                            $moduleaccessansansansfinal='DISABLE';
                        }
                        if ($moduleaccessans==1) {
                            $moduleaccessansansfinal='ENABLE';
                        }
                        else{
                            $moduleaccessansansfinal='DISABLE';
                        }
                    if($ch!='')
                    {
                        $ch.='<br> '.$moduletypeans.' <span style="color:green;" id="prohisfromtospan">( From '.$moduleaccessansansansfinal.' To '.$moduleaccessansansfinal.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$moduletypeans.' <span style="color:green;" id="prohisfromtospan">( From '.$moduleaccessansansansfinal.' To '.$moduleaccessansansfinal.' ) </span>';
                    }                   
                }
                }
            }
            else{
                $sqlmainaccess = "update pairmainaccess set groupname='$grouptype',groupaccess='$groupaccess' where (userid='$companymainid' or createdid='$companymainid') and grouptype='$maingrouptype'"; 
                $sqlmainaccessup = mysqli_query($con, $sqlmainaccess);
            }
            }
            }

                $batchexpiryval=mysqli_real_escape_string($con, (isset($_POST['batchexpiryval']))?'1':'0');
                if ($access['batchexpiryval']!=$batchexpiryval) {
                if (isset($_POST['batchexpiryval'])) {
                    if ($ch!='') {
                        $ch.='<br> Batch & Expiry (Invoice,Bill) <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
                    }
                    else{
                        $ch.='Batch & Expiry (Invoice,Bill) <span style="color:green;" id="prohisfromtospan">( From DISABLE To ENABLE ) </span>';
                    }
                }
                else{
                    if ($ch!='') {
                        $ch.='<br> Batch & Expiry (Invoice,Bill) <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
                    }
                    else{
                        $ch.='Batch & Expiry (Invoice,Bill) <span style="color:green;" id="prohisfromtospan">( From ENABLE To DISABLE ) </span>';
                    }
                }
            }
                $sqlupaccessbatchexpiryval=mysqli_query($con,"update pairaccess set batchexpiryval='$batchexpiryval' where createdid='$companymainid'");
                // $sqlsel=mysqli_query($con,"select * from pairmainaccess where moduletype='Invoices'");
                // $sqlselup=mysqli_fetch_array($sqlsel);
                // if (isset($_POST['batchexpiryval'])) {
                // $addinv=str_replace("Batches","Batch",$sqlselup['modulefieldcreate']);
                // $editinv=str_replace("Batches","Batch",$sqlselup['modulefieldedit']);
                // $viewinv=str_replace("Batches","Batch",$sqlselup['modulefieldview']);
                // }
                // else{
                // $addinv=str_replace("Batch","Batches",$sqlselup['modulefieldcreate']);
                // $editinv=str_replace("Batch","Batches",$sqlselup['modulefieldedit']);
                // $viewinv=str_replace("Batch","Batches",$sqlselup['modulefieldview']);
                // }
                // $sqlupaccessbatchexpiryinv=mysqli_query($con,"update pairmainaccess set modulefieldcreate='$addinv',modulefieldedit='$editinv',modulefieldview='$viewinv' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Invoices'");
                // $sqlselbill=mysqli_query($con,"select * from pairmainaccess where moduletype='Bills'");
                // $sqlselupbill=mysqli_fetch_array($sqlselbill);
                // if (isset($_POST['batchexpiryval'])) {
                // $addbill=str_replace("Batches","Batch",$sqlselupbill['modulefieldcreate']);
                // $editbill=str_replace("Batches","Batch",$sqlselupbill['modulefieldedit']);
                // $viewbill=str_replace("Batches","Batch",$sqlselupbill['modulefieldview']);
                // }
                // else{
                // $addbill=str_replace("Batch","Batches",$sqlselupbill['modulefieldcreate']);
                // $editbill=str_replace("Batch","Batches",$sqlselupbill['modulefieldedit']);
                // $viewbill=str_replace("Batch","Batches",$sqlselupbill['modulefieldview']);
                // }
                // $sqlupaccessbatchexpirybill=mysqli_query($con,"update pairmainaccess set modulefieldcreate='$addbill',modulefieldedit='$editbill',modulefieldview='$viewbill' where (userid='$companymainid' or createdid='$companymainid') and moduletype='Bills'");
                if($ch!='')
                {
                $sqluse=mysqli_query($con, "insert into pairusehistory set usetype='Books', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$companymainid', useremarks='".$ch."'");
                }
    header('Location:preference_billing.php?remarks=Updated Successfully');
}
// $sqlsel=mysqli_query($con,"SELECT * FROM paircontrols WHERE username='".$_SESSION['unqwerty']."' or usernewname='".$_SESSION['unqwerty']."'");
// $ans=mysqli_fetch_assoc($sqlsel);
$sqlaccess="SELECT * FROM pairaccess WHERE createdid='$companymainid';";
$resultaccess=mysqli_query($con,$sqlaccess);
$access=mysqli_fetch_assoc($resultaccess);
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
        Preference &gt; <?= $row['books'] ?> &gt; Modules
    </title>
        <style type="text/css">
        table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
  table {
    border: 0;
  }

  table caption {
    font-size: 1.3em;
  }
  
  table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  table tr {
    border-bottom: 3px solid #ddd;
    display: block;
    margin-bottom: 1em;
  }
  
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
.table td, .table th {
    white-space: normal;
}
    </style>
    <style>
   

    [aria-expanded="false"]>.expanded,
    [aria-expanded="true"]>.collapsed {
        display: none;
    }

    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }
    </style>
    <style>
    .accordion-button:not(.collapsed)::after {
        background-image: url();
        margin-left: -20px;
        margin-top: -5px;
    }

    /*.accordion-button:not(.collapsed) a.customcont-heading {
        border-bottom: 1.5px solid #000000;
        color: #000000;
    }*/
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}

.alignright
{
    text-align: right;
}


    @media screen and (min-device-width: 260px) and (max-device-width: 575px) { 
    /* STYLES HERE */

    /* STYLES HERE */
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}
.alignright{
    text-align: center;
    
}
.mobliview
{
    text-align: center;
    
}




}
@media screen and (min-device-width: 366px) and (max-device-width: 575px) { 
.row1
{
    width: auto;
}

}

    .heading:focus{
        border: 1px solid #3f94eb !important;
        outline: none;
        box-shadow: none !important;
        border-radius: 0px !important;
    }
    </style>


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
     <div class="alert alert-dismissible" style="position: relative;top: 32px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -32px;border-radius: 0px !important;">
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
      <div class="alert alert-dismissible" style="position: relative;top: 32px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -32px;border-radius: 0px !important;">
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
    <i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?></p>
  </div>
     <?php
     }
     ?>
             <div class="card card-body mt-5" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;max-width: 1650px;height: auto;z-index: 0;">
                <form action="" method="post" style="position: relative;top: -27px;">
    <p class="mb-3" style="font-size: 14.6px;color: black;position: relative;top: 15px;"><a href="preference.php" style="color: #1878F1"><!-- <i class="fa fa-sliders"></i> --> Preference </a><span>&gt;</span><a href="preference_billing.php" style="color: #1878F1"> <!-- <i class="fa fa-book"></i> -->
                                    <?= $rows['books'] ?> </a> &gt; Modules <!-- <span>&gt;</span> --> <!-- <i class="fa fa-shopping-basket"></i> --> <!-- Items --></p>
                                    <div class="mt-3" style="border-top: 1px solid #dee2e6;position: relative;top: 0px;"></div>
                                    <p class="mb-3" style="font-size: 20px;color: black;position: relative;top: 12px;">Modules</p>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
                                          <div style="margin-top: 0px !important;">
                                        <div style="visibility: visible;" id="arrowsallpro">
<svg id="rightarrowproacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowproacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowproacc" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowproacc()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchproacc() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#module').outerWidth()
            var scrollWidth = $('#module')[0].scrollWidth; 
            var scrollLeft = $('#module').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproacc').style.visibility = 'hidden';
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowproacc').style.visibility = 'hidden';
            document.getElementById('leftarrowproacc').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowproacc').style.visibility = 'visible';
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
          }
            }
          }
          function leftarrowproacc() {
            document.getElementById('module').scrollLeft += -90;
            var width = $('#module').outerWidth()
            var scrollWidth = $('#module')[0].scrollWidth; 
            var scrollLeft = $('#module').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowproacc').style.visibility = 'hidden';
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowproacc').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowproacc() {
            document.getElementById('module').scrollLeft += 90;
            var width = $('#module').outerWidth()
            var scrollWidth = $('#module')[0].scrollWidth; 
            var scrollLeft = $('#module').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowproacc').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowproacc').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #module::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#module::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#module::-webkit-scrollbar-track {
  background-color: green;
}

#module::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#module::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 480px){
  #arrowsallpro{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 260px) and (max-device-width: 300px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 188px !important;
}
}
@media screen and (min-device-width: 301px) and (max-device-width: 350px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 152px !important;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 410px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 100px !important;
}
}
@media screen and (min-device-width: 411px) and (max-device-width: 480px){
.accordion-button::after{
  position: sticky !important;
  margin-left: 52px !important;
}
}
@media screen and (min-device-width: 481px) and (max-device-width: 3000px){
  #arrowsallpro{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 class="accordion-header scrollbar-2" ontouchmove="checkscrolltouchproacc()" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;" id="module">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#modules" aria-expanded="true" aria-controls="modules">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the modules you would like to enable</a>
</div>
</button>
</h5>
</div>
<div id="modules" class="accordion-collapse collapse show" aria-labelledby="module">
<div class="accordion-body text-sm">
   <!--  <script>  
  // $(function() {  
  //   $( "#green" ).draggable();  
  // });  
  document.addEventListener('DOMContentLoaded', (event) => {

  var dragSrcEl = null;
  
  function handleDragStart(e) {
    this.style.opacity = '0.4';
    
    dragSrcEl = this;

    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', this.innerHTML);
  }

  function handleDragOver(e) {
    if (e.preventDefault) {
      e.preventDefault();
    }

    e.dataTransfer.dropEffect = 'move';
    
    return false;
  }

  function handleDragEnter(e) {
    this.classList.add('over');
  }

  function handleDragLeave(e) {
    this.classList.remove('over');
  }

  function handleDrop(e) {
    if (e.stopPropagation) {
      e.stopPropagation(); // stops the browser from redirecting.
    }
    
    if (dragSrcEl != this) {
      dragSrcEl.innerHTML = this.innerHTML;
      this.innerHTML = e.dataTransfer.getData('text/html');
    }
    
    return false;
  }

  function handleDragEnd(e) {
    this.style.opacity = '1';
    
    items.forEach(function (item) {
      item.classList.remove('over');
    });
  }
  
  
  let items = document.querySelectorAll('.custom-control');
  items.forEach(function(item) {
    item.addEventListener('dragstart', handleDragStart, false);
    item.addEventListener('dragenter', handleDragEnter, false);
    item.addEventListener('dragover', handleDragOver, false);
    item.addEventListener('dragleave', handleDragLeave, false);
    item.addEventListener('drop', handleDrop, false);
    item.addEventListener('dragend', handleDragEnd, false);
  });
});
  </script> -->
  
  <!-- <div class="col-lg-2 my-1"> -->
  <?php
$sqlmain = mysqli_query($con,"select distinct grouptype,groupname,groupaccess from pairmainaccess where userid='$companymainid' and createdid='0' ORDER BY ordering ASC");
while($sqlmainresult = mysqli_fetch_array($sqlmain)){
    $grouptype = preg_replace('/\s+/', '', $sqlmainresult['grouptype']);
    $maingrouptype=$sqlmainresult['grouptype'];
?>
<div class="custom-control custom-checkbox mr-sm-2" style=" border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="group<?=strtolower($grouptype)?>()">
<input type="checkbox" class="custom-control-input" name="group<?=strtolower($grouptype)?>" id="group<?=strtolower($grouptype)?>" <?= ($sqlmainresult['groupaccess']=='1')?'checked':''?> onclick="$(this).attr('value', this.checked ? 1 : 0)" value="1">
<label class="custom-control-label custom-label" for="group<?=strtolower($grouptype)?>"><input type="text" name="grouptype<?=strtolower($grouptype)?>" id="grouptype<?=strtolower($grouptype)?>" value="<?=$sqlmainresult['groupname']?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: <?= (((strtolower($grouptype)=='items')||(strtolower($grouptype)=='sales')||(strtolower($grouptype)=='purchase')||(strtolower($grouptype)=='reports'))?'royalblue':'yellow') ?>;position: relative;top: -2.5px;" placeholder="<?=$sqlmainresult['groupname']?>"></label>
</div>
<?php
$sqlismainaccess=mysqli_query($con, "select distinct modulename,moduleaccess,moduletype from pairmainaccess where userid='$companymainid' and (grouptype='$maingrouptype' and moduletype!='') ORDER BY ordering ASC");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
?>
<!-- <div class="col-lg-2 my-1"> -->
<div class="custom-control custom-checkbox mr-sm-2" onclick="modules<?=strtolower($coltype)?>()">
<input type="checkbox" class="custom-control-input module<?=strtolower($grouptype)?>" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" <?= ($infomainaccess['moduleaccess']=='1')?'checked':''?> onclick="$(this).attr('value', this.checked ? 1 : 0)" value="1">
<label class="custom-control-label custom-label" for="module<?=strtolower($coltype)?>"><input type="text" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?=$infomainaccess['modulename']?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color:<?= (((strtolower($coltype)=='products')||(strtolower($coltype)=='services')||(strtolower($coltype)=='inventoryadjustments')||(strtolower($coltype)=='customers')||(strtolower($coltype)=='salesorders')||(strtolower($coltype)=='invoices')||(strtolower($coltype)=='paymentsreceived')||(strtolower($coltype)=='vendors')||(strtolower($coltype)=='bills')||(strtolower($coltype)=='paymentsmade')||(strtolower($coltype)=='creditnotes')||(strtolower($coltype)=='debitnotes')||(strtolower($coltype)=='customerrefunds')||(strtolower($coltype)=='vendorrefunds')||(strtolower($coltype)=='salesreturns')||(strtolower($coltype)=='purchasereturns'))?'':'yellow') ?>;position: relative;top: -2.5px;" placeholder="<?=$infomainaccess['modulename']?>"></label>
</div>      
<script>
      function group<?=strtolower($grouptype)?>() {
        if($("#group<?=strtolower($grouptype)?>").prop('checked')){
        let salesinside = document.getElementsByClassName("module<?=strtolower($grouptype)?>");
        salesinsidelen = salesinside.length;
        for(i=0;i<salesinsidelen;i++){
        salesinside[i].checked=true;
      }
      }
  else{
        let salesinside = document.getElementsByClassName("module<?=strtolower($grouptype)?>");
        salesinsidelen = salesinside.length;
        for(i=0;i<salesinsidelen;i++){
        salesinside[i].checked=false;
      }
  }
}
    </script>
<script type="text/javascript">
    function modules<?=strtolower($coltype)?>() {
        salesscript = document.getElementsByClassName("module<?=strtolower($grouptype)?>");
        salesscriptlen = salesscript.length;
        for (i=0;i<salesscriptlen;i++) {
            if (salesscript[i].checked==false) {
            let modulesale = document.getElementById("group<?=strtolower($grouptype)?>");
            modulesale.checked=false;
        }
        }
            if (document.getElementById("modulesalesreturns").checked==false) {
                if('<?=$coltype?>'=='SalesReturns'){
                    document.getElementById("modulecreditnotes").checked=false;
                    document.getElementById("modulecustomerrefunds").checked=false;
                }
            }
            if (document.getElementById("modulesalesreturns").checked==true) {
                if('<?=$coltype?>'=='SalesReturns'){
                    document.getElementById("modulecreditnotes").checked=true;
                    document.getElementById("modulecustomerrefunds").checked=true;
                }
            }
            if (document.getElementById("modulecreditnotes").checked==false) {
                if('<?=$coltype?>'=='CreditNotes'){
                    document.getElementById("modulesalesreturns").checked=false;
                    document.getElementById("modulecustomerrefunds").checked=false;
                }
            }
            if (document.getElementById("modulecreditnotes").checked==true) {
                if('<?=$coltype?>'=='CreditNotes'){
                    document.getElementById("modulesalesreturns").checked=true;
                    document.getElementById("modulecustomerrefunds").checked=true;
                }
            }
            if (document.getElementById("modulecustomerrefunds").checked==false) {
                if('<?=$coltype?>'=='CustomerRefunds'){
                    document.getElementById("modulesalesreturns").checked=false;
                    document.getElementById("modulecreditnotes").checked=false;
                }
            }
            if (document.getElementById("modulecustomerrefunds").checked==true) {
                if('<?=$coltype?>'=='CustomerRefunds'){
                    document.getElementById("modulesalesreturns").checked=true;
                    document.getElementById("modulecreditnotes").checked=true;
                }
            }
            if (document.getElementById("modulepurchasereturns").checked==false) {
                if('<?=$coltype?>'=='PurchaseReturns'){
                    document.getElementById("moduledebitnotes").checked=false;
                    document.getElementById("modulevendorrefunds").checked=false;
                }
            }
            if (document.getElementById("modulepurchasereturns").checked==true) {
                if('<?=$coltype?>'=='PurchaseReturns'){
                    document.getElementById("moduledebitnotes").checked=true;
                    document.getElementById("modulevendorrefunds").checked=true;
                }
            }
            if (document.getElementById("moduledebitnotes").checked==false) {
                if('<?=$coltype?>'=='DebitNotes'){
                    document.getElementById("modulepurchasereturns").checked=false;
                    document.getElementById("modulevendorrefunds").checked=false;
                }
            }
            if (document.getElementById("moduledebitnotes").checked==true) {
                if('<?=$coltype?>'=='DebitNotes'){
                    document.getElementById("modulepurchasereturns").checked=true;
                    document.getElementById("modulevendorrefunds").checked=true;
                }
            }
            if (document.getElementById("modulevendorrefunds").checked==false) {
                if('<?=$coltype?>'=='VendorRefunds'){
                    document.getElementById("moduledebitnotes").checked=false;
                    document.getElementById("modulepurchasereturns").checked=false;
                }
            }
            if (document.getElementById("modulevendorrefunds").checked==true) {
                if('<?=$coltype?>'=='VendorRefunds'){
                    document.getElementById("moduledebitnotes").checked=true;
                    document.getElementById("modulepurchasereturns").checked=true;
                }
            }
        salesscript = document.getElementsByClassName("module<?=strtolower($grouptype)?>");
        salesscriptlen = salesscript.length;
        for (i=0;i<salesscriptlen;i++) {
        if (salesscript[i].checked==true) {
            let modulesale = document.getElementById("group<?=strtolower($grouptype)?>");
            modulesale.checked=true;
        }
        }
    }
</script>     
<?php
}
}
?>

<!-- 
<div class="mr-sm-2" style=" border-top:2px solid #eee; border-bottom:0px solid #eee;">
</div> -->
    <!-- <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="items()">
        <script>
      function items() {
        if($("#items").prop('checked')){
        let product = document.getElementById('product');
        let services = document.getElementById('services');
        let invadj = document.getElementById('invadj');
        product.checked = true;
        services.checked = true;
        invadj.checked = true;
      }
  else{
        let product = document.getElementById('product');
        let services = document.getElementById('services');
        let invadj = document.getElementById('invadj');
        services.checked = false;
        invadj.checked = false;
        product.checked = false;
  }
}
    </script>
                        <input type="checkbox" class="custom-control-input" name="items" id="items" <?= ($rows['permissionitems']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="items" style="color: royalblue;font-size: 14.6px;"><input type="text" name="itemchbox" value="<?= $rows['itemhead'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(Items or Inventory)"></label>
                      </div>
                      <script type="text/javascript">
        function foritems() {
            let product = document.getElementById('product');
        let services = document.getElementById('services');
        let invadj = document.getElementById('invadj');
         if(product.checked == false && services.checked == false && invadj.checked == false){
        let items = document.getElementById('items');
        items.checked = false;
      }
  else{
        let items = document.getElementById('items');
        items.checked = true;
  }   
        }
                      </script>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:1px solid #eee;" onclick="foritems()">
                        <input type="checkbox" class="custom-control-input" name="product" id="product" <?= ($rows['permissionproducts']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="product" style="font-size: 14.6px;"> <input type="text" name="prochbox" value="<?= $rows['prohead'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Products or Books)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:1px solid #eee;" onclick="foritems()">
                        <input type="checkbox" class="custom-control-input" name="services" id="services" <?= ($rows['permissionservices']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="services" style="font-size: 14.6px;"> <input type="text" name="servchbox" value="<?= $rows['servch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Services or Services)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:1px solid #eee;" onclick="foritems()">
                        <input type="checkbox" class="custom-control-input" name="invadj" id="invadj" <?= ($rows['permissioninvadj']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="invadj" style="font-size: 14.6px;"> <input type="text" name="invadjch" value="<?= $rows['invadjch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Inventory Adjustments)"></label>
                      </div>
                       <script>
      function sales() {
        if($("#sales").prop('checked')){
        let customers = document.getElementById('customer');
        let saleorder = document.getElementById('saleorder');
        let saleorders = document.getElementById('saleorders');
        let quotations = document.getElementById('quotations');
        let estimates = document.getElementById('estimates');
        let pforminv = document.getElementById('pforminv');
        let deliverychallan = document.getElementById('deliverychallan');
        let invoices = document.getElementById('invoices');
        let payreceive = document.getElementById('payreceive');
        let salereturn = document.getElementById('salereturn');
        customers.checked = true;
        saleorder.checked = true;
        saleorders.checked = true;
        quotations.checked = true;
        estimates.checked = true;
        pforminv.checked = true;
        deliverychallan.checked = true;
        invoices.checked = true;
        payreceive.checked = true;
        salereturn.checked = true;
      }
  else{
        let customers = document.getElementById('customer');
        let saleorder = document.getElementById('saleorder');
        let saleorders = document.getElementById('saleorders');
        let quotations = document.getElementById('quotations');
        let estimates = document.getElementById('estimates');
        let pforminv = document.getElementById('pforminv');
        let deliverychallan = document.getElementById('deliverychallan');
        let invoices = document.getElementById('invoices');
        let payreceive = document.getElementById('payreceive');
        let salereturn = document.getElementById('salereturn');
        customers.checked = false;
        saleorder.checked = false;
        saleorders.checked = false;
        quotations.checked = false;
        estimates.checked = false;
        pforminv.checked = false;
        deliverychallan.checked = false;
        invoices.checked = false;
        payreceive.checked = false;
        salereturn.checked = false;
  }
}
    </script>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:1px solid #eee; border-bottom:0px solid #eee;" onclick="sales()">
                        <input type="checkbox" class="custom-control-input" name="sales" id="sales" <?= ($rows['permissionsales']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="sales" style="color: royalblue;font-size: 14.6px;"><input type="text" name="salechbox" value="<?= $rows['salech'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(Sales)"></label>
                      </div>
                      <script type="text/javascript">
        function forsales() {
        let customers = document.getElementById('customer');
        let saleorder = document.getElementById('saleorder');
        let saleorders = document.getElementById('saleorders');
        let quotations = document.getElementById('quotations');
        let estimates = document.getElementById('estimates');
        let pforminv = document.getElementById('pforminv');
        let deliverychallan = document.getElementById('deliverychallan');
        let invoices = document.getElementById('invoices');
        let payreceive = document.getElementById('payreceive');
        let salereturn = document.getElementById('salereturn');
         if(customers.checked == false &&saleorder.checked == false &&saleorders.checked == false && quotations.checked == false&& estimates.checked == false&&pforminv.checked == false&&deliverychallan.checked == false&& invoices.checked == false&& payreceive.checked == false&& salereturn.checked == false){
        let sales = document.getElementById('sales');
        sales.checked = false;
      }
  else{
        let sales = document.getElementById('sales');
        sales.checked = true;
  }   
        }
                      </script>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:1px solid #eee;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="customers" id="customer" <?= ($rows['permissioncustomers']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="customers" style="font-size: 14.6px;"> <input type="text" name="cuschbox" value="<?= $rows['cusch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Customers)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:1px solid #eee;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="enquiry" id="enquiry" <?= ($access['permissionenquiry']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="enquiry" style="font-size: 14.6px;"> <input type="text" name="enqbox" value="<?= $access['enqch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Enquiries)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="quotations" id="quotations" <?= ($rows['permissionquotations']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="quotations" style="font-size: 14.6px;"> <input type="text" name="qtchbox" value="<?= $rows['qtch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Quotations)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="estimates" id="estimates" <?= ($rows['permissionestimates']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="estimates" style="font-size: 14.6px;"> <input type="text" name="eschbox" value="<?= $rows['esch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Estimates)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="pforminv" id="pforminv" <?= ($rows['permissionspforminv']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="pforminv" style="font-size: 14.6px;"> <input type="text" name="pforminvch" value="<?= $rows['pforminvhead'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Proforma Invoices)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:0px solid #eee;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="saleorder" id="saleorder" <?= ($rows['permissionssaleorder']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="saleorder" style="font-size: 14.6px;"> <input type="text" name="saleorderch" value="<?= $rows['saleorderch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Sales Order)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:0px solid #eee;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="saleorders" id="saleorders" <?= ($rows['permissionsaleorders']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="saleorders" style="font-size: 14.6px;"> <input type="text" name="saleordersch" value="<?= $rows['saleordersch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Sales Orders)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:0px solid #eee;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="deliverychallan" id="deliverychallan" <?= ($rows['permissiondeliverych']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="deliverychallan" style="font-size: 14.6px;"> <input type="text" name="deliverychch" value="<?= $rows['deliverychch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Delivery Challan)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:0px solid #eee;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="invoices" id="invoices" <?= ($rows['permissioninvoices']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="invoices" style="font-size: 14.6px;"> <input type="text" name="invchbox" value="<?= $rows['invch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Invoices)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:0px solid #eee;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="payreceive" id="payreceive" <?= ($rows['permissionspayreceive']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="payreceive" style="font-size: 14.6px;"> <input type="text" name="payreceivech" value="<?= $rows['payreceivech'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Payments Received)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:2px solid #eee;" onclick="forsales()">
                        <input type="checkbox" class="custom-control-input" name="salereturn" id="salereturn" <?= ($rows['permissionssalereturn']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="salereturn" style="font-size: 14.6px;"> <input type="text" name="salereturnch" value="<?= $rows['salereturnch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Sales Return)"></label>
                      </div>

                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="purchases()">
        <script>
      function purchases() {
        if($("#purchases").prop('checked')){
        let vendor = document.getElementById('vendor');
        let purorder = document.getElementById('purorder');
        let purreceive = document.getElementById('purreceive');
        let bill = document.getElementById('bill');
        let paymade = document.getElementById('paymade');
        let purreturn = document.getElementById('purreturn');
        vendor.checked = true;
        purorder.checked = true;
        purreceive.checked = true;
        bill.checked = true;
        paymade.checked = true;
        purreturn.checked = true;
      }
  else{
        let vendor = document.getElementById('vendor');
        let purorder = document.getElementById('purorder');
        let purreceive = document.getElementById('purreceive');
        let bill = document.getElementById('bill');
        let paymade = document.getElementById('paymade');
        let purreturn = document.getElementById('purreturn');
        purorder.checked = false;
        purreceive.checked = false;
        vendor.checked = false;
        bill.checked = false;
        paymade.checked = false;
        purreturn.checked = false;
  }
}
    </script>
                        <input type="checkbox" class="custom-control-input" name="purchases" id="purchases" <?= ($rows['permissionspurchases']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="purchases" style="color: royalblue;font-size: 14.6px;"><input type="text" name="purchasesch" value="<?= $rows['purch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(Purchase)"></label>
                      </div>
                      <script type="text/javascript">
        function forpurchase() {
        let vendor = document.getElementById('vendor');
        let purorder = document.getElementById('purorder');
        let purreceive = document.getElementById('purreceive');
        let bill = document.getElementById('bill');
        let paymade = document.getElementById('paymade');
        let purreturn = document.getElementById('purreturn');
         if(vendor.checked == false && purorder.checked == false&& purreceive.checked == false&& bill.checked == false&& paymade.checked == false&& purreturn.checked == false){
        let purchases = document.getElementById('purchases');
        purchases.checked = false;
      }
  else{
        let purchases = document.getElementById('purchases');
        purchases.checked = true;
  }   
        }
                      </script>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:1px solid #eee;" onclick="forpurchase()">
                        <input type="checkbox" class="custom-control-input" name="vendor" id="vendor" <?= ($rows['permissionsvendor']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="vendor" style="font-size: 14.6px;"> <input type="text" name="vendorch" value="<?= $rows['vendorch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Vendors)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:1px solid #eee;" onclick="forpurchase()">
                        <input type="checkbox" class="custom-control-input" name="purorder" id="purorder" <?= ($rows['permissionspurorder']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="purorder" style="font-size: 14.6px;"> <input type="text" name="purorderch" value="<?= $rows['purorderch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Purchase Order)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:1px solid #eee;" onclick="forpurchase()">
                        <input type="checkbox" class="custom-control-input" name="purreceive" id="purreceive" <?= ($rows['permissionpurreceive']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="purreceive" style="font-size: 14.6px;"> <input type="text" name="purreceivech" value="<?= $rows['purreceivech'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Purchase Receives)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:1px solid #eee;" onclick="forpurchase()">
                        <input type="checkbox" class="custom-control-input" name="bill" id="bill" <?= ($rows['permissionsbill']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="bill" style="font-size: 14.6px;"> <input type="text" name="billch" value="<?= $rows['billch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Bills)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:1px solid #eee;" onclick="forpurchase()">
                        <input type="checkbox" class="custom-control-input" name="paymade" id="paymade" <?= ($rows['permissionspaymade']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="paymade" style="font-size: 14.6px;"> <input type="text" name="paymadech" value="<?= $rows['paymadech'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Payments Made)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:1px solid #eee;" onclick="forpurchase()">
                        <input type="checkbox" class="custom-control-input" name="purreturn" id="purreturn" <?= ($rows['permissionspurreturn']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="purreturn" style="font-size: 14.6px;"> <input type="text" name="purreturnch" value="<?= $rows['purreturnch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Purchase Return)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="bank()">
                        <input type="checkbox" class="custom-control-input" name="banking" id="banking" <?= ($rows['permissionbanking']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="banking" style="color: royalblue;font-size: 14.6px;"><input type="text" name="bankch" value="<?= $rows['bankch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(Banking)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="exp()">
                        <input type="checkbox" class="custom-control-input" name="expens" id="expens" <?= ($rows['permissionsexpens']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="expens" style="color: royalblue;font-size: 14.6px;"><input type="text" name="expensch" value="<?= $rows['expch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(Expenses)"></label>
                      </div>
                       <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="account()">
        <script>
      function account() {
        if($("#account").prop('checked')){
        let manualjournal = document.getElementById('manualjournal');
        let chartaccount = document.getElementById('chartaccount');
        manualjournal.checked = true;
        chartaccount.checked = true;
      }
  else{
        let manualjournal = document.getElementById('manualjournal');
        let chartaccount = document.getElementById('chartaccount');
        chartaccount.checked = false;
        manualjournal.checked = false;
  }
}
    </script>
                        <input type="checkbox" class="custom-control-input" name="account" id="account" <?= ($rows['permissionaccounting']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="account" style="color: royalblue;font-size: 14.6px;"><input type="text" name="accountch" value="<?= $rows['accountch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(Accounting)"></label>
                      </div>
                      <script type="text/javascript">
        function foraccounting() {
            let manualjournal = document.getElementById('manualjournal');
        let chartaccount = document.getElementById('chartaccount');
         if(manualjournal.checked == false && chartaccount.checked == false){
        let account = document.getElementById('account');
        account.checked = false;
      }
  else{
        let account = document.getElementById('account');
        account.checked = true;
  }   
        }
                      </script>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:1px solid #eee;" onclick="foraccounting()">
                        <input type="checkbox" class="custom-control-input" name="manualjournal" id="manualjournal" <?= ($rows['permissionmanualjournals']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="manualjournal" style="font-size: 14.6px;"> <input type="text" name="manualjournalch" value="<?= $rows['manualjournalsch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Manual Journals)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:1px solid #eee;" onclick="foraccounting()">
                        <input type="checkbox" class="custom-control-input" name="chartaccount" id="chartaccount" <?= ($rows['permissionchartaccount']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="chartaccount" style="font-size: 14.6px;"> <input type="text" name="chartaccountch" value="<?= $rows['chartaccountch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Chart of Accounts)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="timetracking()">
        <script>
      function timetracking() {
        if($("#timetracking").prop('checked')){
        let projects = document.getElementById('projects');
        let timesheet = document.getElementById('timesheet');
        projects.checked = true;
        timesheet.checked = true;
      }
  else{
        let projects = document.getElementById('projects');
        let timesheet = document.getElementById('timesheet');
        timesheet.checked = false;
        projects.checked = false;
  }
}
    </script>
                        <input type="checkbox" class="custom-control-input" name="timetracking" id="timetracking" <?= ($rows['permissiontimetracking']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="timetracking" style="color: royalblue;font-size: 14.6px;"><input type="text" name="timetrackingch" value="<?= $rows['timetrackingch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(Time Tracking)"></label>
                      </div>
                      <script type="text/javascript">
        function foraccount() {
            let projects = document.getElementById('projects');
        let timesheet = document.getElementById('timesheet');
         if(projects.checked == false && timesheet.checked == false){
        let timetracking = document.getElementById('timetracking');
        timetracking.checked = false;
      }
  else{
        let timetracking = document.getElementById('timetracking');
        timetracking.checked = true;
  }   
        }
                      </script>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:1px solid #eee;" onclick="foraccount()">
                        <input type="checkbox" class="custom-control-input" name="projects" id="projects" <?= ($rows['permissionprojects']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="projects" style="font-size: 14.6px;"> <input type="text" name="projectsch" value="<?= $rows['projectsch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Projects)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-bottom:1px solid #eee;" onclick="foraccount()">
                        <input type="checkbox" class="custom-control-input" name="timesheet" id="timesheet" <?= ($rows['permissiontimesheet']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="timesheet" style="font-size: 14.6px;"> <input type="text" name="timesheetch" value="<?= $rows['timesheetch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;position: relative;top: -2.5px;" placeholder="(Timesheet)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="ewaybills()">
                        <input type="checkbox" class="custom-control-input" name="ewaybills" id="ewaybills" <?= ($rows['permissionewaybills']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="ewaybills" style="color: royalblue;font-size: 14.6px;"><input type="text" name="ewaybillsch" value="<?= $rows['ewaybillsch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(e-Way Bills)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="gstfilling()">
                        <input type="checkbox" class="custom-control-input" name="gstfilling" id="gstfilling" <?= ($rows['permissiongstfilling']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="gstfilling" style="color: royalblue;font-size: 14.6px;"><input type="text" name="gstfillingch" value="<?= $rows['gstfillingch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(GST Filling)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="payroll()">
                        <input type="checkbox" class="custom-control-input" name="payroll" id="payroll" <?= ($rows['permissionpayroll']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="payroll" style="color: royalblue;font-size: 14.6px;"><input type="text" name="payrollch" value="<?= $rows['payrollch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(Payroll)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="attendence()">
                        <input type="checkbox" class="custom-control-input" name="attendence" id="attendence" <?= ($rows['permissionattendence']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="attendence" style="color: royalblue;font-size: 14.6px;"><input type="text" name="attendencech" value="<?= $rows['attendencech'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(Attendence)"></label>
                      </div>
                      <div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:2px solid #eee; border-bottom:0px solid #eee;" onclick="report()">
                        <input type="checkbox" class="custom-control-input" name="report" id="report" <?= ($rows['permissionsreport']=='1')?'checked':''?>>
                        <label class="custom-control-label custom-label" for="report" style="color: royalblue;font-size: 14.6px;"><input type="text" name="reportch" value="<?= $rows['reportch'] ?>" class="heading" style="border: 1px dashed lightgrey;width: 81%;color: royalblue;position: relative;top: -2.5px;" placeholder="(Reports)"></label>
                      </div> -->
</div>
</div>
</div>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
                                          <div style="margin-top: 0px !important;">
                                        <div style="visibility: visible;" id="arrowsalldashboard">
<svg id="rightarrowprodashboard" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrowprodashboard()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
<svg id="leftarrowprodashboard" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrowprodashboard()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 13px !important;z-index: 3000000 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
<path d="M0 0h24v24H0z" fill="none"></path>
<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
</svg>
</div>
        <script type="text/javascript">
          function checkscrolltouchdashboard() {
            // console.log($('#nav-tab').outerWidth());box-shadow: -1px 0 6px rgb(0 0 0 / 20%);
            // console.log($('#nav-tab').scrollLeft());
            // console.log($('#nav-tab').width());
            var width = $('#batchexpiry').outerWidth()
            var scrollWidth = $('#batchexpiry')[0].scrollWidth; 
            var scrollLeft = $('#batchexpiry').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowprodashboard').style.visibility = 'hidden';
            document.getElementById('rightarrowprodashboard').style.visibility = 'visible';
            }
            else if (scrollLeft!=0){
              if (scrollWidth - width === scrollLeft) {
            document.getElementById('rightarrowprodashboard').style.visibility = 'hidden';
            document.getElementById('leftarrowprodashboard').style.visibility = 'visible'; 
              }
              else{
            document.getElementById('leftarrowprodashboard').style.visibility = 'visible';
            document.getElementById('rightarrowprodashboard').style.visibility = 'visible';
          }
            }
          }
          function leftarrowprodashboard() {
            document.getElementById('batchexpiry').scrollLeft += -90;
            var width = $('#batchexpiry').outerWidth()
            var scrollWidth = $('#batchexpiry')[0].scrollWidth; 
            var scrollLeft = $('#batchexpiry').scrollLeft();
            if (scrollLeft===0){
            document.getElementById('leftarrowprodashboard').style.visibility = 'hidden';
            document.getElementById('rightarrowprodashboard').style.visibility = 'visible';
            }
            else{
            document.getElementById('rightarrowprodashboard').style.visibility = 'visible';
            }
          }
        </script>
        <script type="text/javascript">
          function rightarrowprodashboard() {
            document.getElementById('batchexpiry').scrollLeft += 90;
            var width = $('#batchexpiry').outerWidth()
            var scrollWidth = $('#batchexpiry')[0].scrollWidth; 
            var scrollLeft = $('#batchexpiry').scrollLeft();
            // alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
            if (scrollWidth - width === scrollLeft){
            document.getElementById('rightarrowprodashboard').style.visibility = 'hidden';
            }
            document.getElementById('leftarrowprodashboard').style.visibility = 'visible';
          }
        </script>
        <style type="text/css">
        #batchexpiry::-webkit-scrollbar {
  width: 0px;
  height: 0px !important;
  background-color: green !important;
  display: none !important;
}

#batchexpiry::-webkit-scrollbar-thumb {
  background-color: green !important;
}

#batchexpiry::-webkit-scrollbar-track {
  background-color: green;
}

#batchexpiry::-webkit-scrollbar-button:horizontal:increment {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}

#batchexpiry::-webkit-scrollbar-button:horizontal:decrement {
    background-color: #ffffff !important;
  height: 12px;
    width: 12px;
}
  .scrollbar-2 {
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
    scrollbar-width: none !important;
    scrollbar-color: #ffffff #ffffff;
}
.scrollbar-2:hover{
    scrollbar-width: none !important;
    scrollbar-color: transparent transparent;
}
@media screen and (max-width: 670px){
  #arrowsalldashboard{
    visibility: visible !important;
    display: block !important;
    margin-bottom: -39px !important;
  }
}
@media screen and (min-device-width: 300px) and (max-device-width: 354px){
#batchexpiry .accordion-button::after{
  position: sticky !important;
  margin-left: 350px !important;
}
}
@media screen and (min-device-width: 355px) and (max-device-width: 404px){
#batchexpiry .accordion-button::after{
  position: sticky !important;
  margin-left: 300px !important;
}
}
@media screen and (min-device-width: 405px) and (max-device-width: 479px){
#batchexpiry .accordion-button::after{
  position: sticky !important;
  margin-left: 250px !important;
}
}
@media screen and (min-device-width: 480px) and (max-device-width: 504px){
#batchexpiry .accordion-button::after{
  position: sticky !important;
  margin-left: 180px !important;
}
}
@media screen and (min-device-width: 505px) and (max-device-width: 599px){
#batchexpiry .accordion-button::after{
  position: sticky !important;
  margin-left: 154px !important;
}
}
@media screen and (min-device-width: 600px) and (max-device-width: 630px){
#batchexpiry .accordion-button::after{
  position: sticky !important;
  margin-left: 60px !important;
}
}
@media screen and (min-device-width: 631px) and (max-device-width: 670px){
#batchexpiry .accordion-button::after{
  position: sticky !important;
  margin-left: 62px !important;
}
}
@media screen and (min-device-width: 671px) and (max-device-width: 3000px){
  #arrowsalldashboard{
    visibility: hidden !important;
    display: none !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
      </style>
                                            <h5 class="accordion-header scrollbar-2" ontouchmove="checkscrolltouchdashboard()" style="position: relative;top: 0px;flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;" id="batchexpiry">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#batchexpirys" aria-expanded="true" aria-controls="batchexpirys">
<div class="customcont-header ml-0 mb-1 mt-3">
<a class="customcont-heading" style="font-size: 18px;"> Select the fields in one click you would like to enable in various modules</a>
</div>
</button>
</h5>
</div>
<div id="batchexpirys" class="accordion-collapse collapse show" aria-labelledby="batchexpiry">
<div class="accordion-body text-sm">
<div class="custom-control custom-checkbox mr-sm-2" style="position:relative;top: -18px; border-top:1px solid #eee;">
<input type="checkbox" class="custom-control-input" name="batchexpiryval" id="batchexpiryval" <?= ($access['batchexpiryval']==1)?'checked':'' ?>>
<label class="custom-control-label custom-label" for="batchexpiryval" style="font-size: 14.6px;">Batch & Expiry (Invoice,Bill)</label>
</div>
</div>
</div>
</div>
                      <hr class="mt-3">
                      <div class="row justify-content-center" style="margin-bottom: -39px;">
    <div class="col-lg-12">
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing.php">Cancel</a>
    </div>
</div>
</form>
 <!-- <div class="nav nav-tabs" id="nav-tab" role="tablist">
<button class="nav-link active" id="nav-general-tab" data-bs-toggle="tab" data-bs-target="#nav-general" type="button" role="tab" aria-controls="nav-general" aria-selected="true"><div class="customcont-header ml-0">
    
        <a class="customcont-heading">General</a>  
             
                </div></button> -->
   <!--  <button class="nav-link" id="nav-history-tab" data-bs-toggle="tab" data-bs-target="#nav-history" type="button" role="tab" aria-controls="nav-history" aria-selected="false">
        <div class="customcont-header ml-0">
    
        <a class="customcont-heading">History</a>   
             
                </div>
        </button> -->
 <!-- </div>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab"> -->
 <!-- <div class="card card-body mt-3" style="width: 30%;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;box-shadow: 0 1px 5px 0 rgb(0 0 0 / 20%);">
                                                                <div class="row row1">
                                                                <div class="col-sm-2  mobliview"> <i class="fa fa-pencil-square-o" style="margin-top: 15px;margin-left: 10px;"></i>
                                                                 </div>
                                                                <div class="col-sm-6 mobliview">
                                                                <p class="card-subtitle mb-2 text-muted" style="margin-top: 0px;font-size: 16px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;color: black;">Label</p>
                                                                    <p class="card-text" style="margin-top:-10px;color: grey;font-size: 14px;font-family: 'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['books']
                                                                ?></p>

                                                                </div>
                                                                <div class="col-sm-4 alignright" style="cursor: pointer;" > 
                                                               
                                                               
                                                                 <a class="btn btn-primary btn-sm btn-custom-grey"  style=" margin-top: 5px; margin-bottom: 0px;margin-left: 0px;text-align:right;cursor: pointer;" href="preference_billing_label.php"><span style="color: black;font-size: 15px;">&#128393;</span> Edit</a> 
                                                                <a class="btn btn-primary btn-sm btn-custom-grey" href="preference_billing_label.php" style="margin-top: 6px;margin-bottom:0rem; margin-right:0px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                               
                                                                </div>
                                                                </div>

                                                                   
                                                                </div>
<div class="card card-body mt-3" style="width: 30%;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;box-shadow: 0 1px 5px 0 rgb(0 0 0 / 20%);position: absolute;left: 33%;bottom: 33%;">
<div class="row row1">
                                                                <div class="col-sm-2  mobliview"> <i class="fa fa-pencil-square-o" style="margin-top: 15px;margin-left: 10px;"></i>
                                                                 </div>
                                                                <div class="col-sm-6 mobliview">
                                                                <p class="card-subtitle mb-2 text-muted" style="margin-top: 0px;font-size: 16px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;color: black;">Label</p>
                                                                    <p class="card-text" style="margin-top:-10px;color: grey;font-size: 14px;font-family: 'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><?= $row['books']
                                                                ?></p>

                                                                </div>
                                                                <div class="col-sm-4 alignright" style="cursor: pointer;" > 
                                                               
                                                               
                                                                <a class="btn btn-primary btn-sm btn-custom-grey"  style=" margin-top: 5px; margin-bottom: 0px;margin-left: 0px;text-align:right;cursor: pointer;" href="preference_billing_label.php"><span style="color: black;font-size: 15px;">&#128393;</span> Edit</a> 
                                                                <a class="btn btn-primary btn-sm btn-custom-grey" href="item_preference.php" style="margin-top: 6px;margin-bottom:0rem; margin-right:0px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;"><i class="fa fa-pencil-alt"></i> Edit</a>
                                                               
                                                                </div>
                                                            </div>
                                                        </div>
                                                                <div class="mt-3" style="border-top: 1px solid #dee2e6;">
                                                                <div class="mt-3 btn-custom-grey">
                                                                <a style="font-size:18px;padding: 20px 0px 14px;width: 61.25;height: 55.5;">General</a>
                                                                </div>
                                                            </div> -->
    <!-- </div> -->
    <!-- <div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">
        <div class="table-responsive m-3">
      <table class="table table-bordered">
      <thead>
      <tr>
      <td>DATE</td>
      <td>DETAILS</td>
      </tr>
      </thead>
      <tbody> -->
        <?php
        // $pairuse="SELECT * FROM pairusehistory WHERE createdby='".$_SESSION["unqwerty"]."' order by createdon desc";
        // $finally=mysqli_query($con,$pairuse);
        // while ($use=mysqli_fetch_array($finally))
        //  {
        //     if($use['booklabelchanges']!=''){
        ?>
        <!-- <tr>
          <td data-label="DATE" style="color:grey"><?=date('d/m/Y h:i:s a', strtotime($use['createdon']))?></td>
          <td data-label="DETAILS"><span  style="color:black">Label Changed by <?=$use['createdby']?> </span><br><span  style="color:grey"><?=$use['booklabelchanges']?></span></td>
        </tr> -->
        <?php
    // }
    ?>
    <?php
        // }
        ?>
      <!-- </tbody>
      </table>
      </div>
    </div>
</div> -->
</div>


            <?php
	  include('footer.php');
	  ?>
        </div>

    </main>
    <?php
 include('fexternals.php');
 ?>
    <script type="text/javascript">
    $(function() {
        $("#invoicesuffix").autocomplete({
            source: 'invoicesuffixsearch.php',
            select: function(event, ui) {
                $("#invoicesuffix").val(ui.item.invoicesuffix);
                $("#city").val(ui.item.city);
                $("#district").val(ui.item.district);
                $("#state").val(ui.item.state);
                $("#pincode").val(ui.item.pincode);
            },
            minLength: 2
        });
        $("#email").autocomplete({
            source: 'franchisesearch.php?type=email',
        });
    });
    </script>
    <script>
    var buttons = document.querySelectorAll('.arlina-button');

    Array.prototype.slice.call(buttons).forEach(function(button) {

        var resetTimeout;

        button.addEventListener('click', function() {

            if (typeof button.getAttribute('data-loading') === 'string') {
                button.removeAttribute('data-loading');
            } else {
                button.setAttribute('data-loading', '');
            }

            clearTimeout(resetTimeout);
            resetTimeout = setTimeout(function() {
                button.removeAttribute('data-loading');
            }, 1000);

        }, false);

    });
    </script>






    <style>
    /*************************************
 * BUTTON BASE
 */

    .arlina-button {
        position: relative;
        border: 0;
        cursor: pointer;
        outline: 0;
        -webkit-appearance: none;
        -webkit-font-smoothing: antialiased;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    .arlina-button[data-loading] {
        cursor: default;
    }


    /* Blue button */
    .arlina-button.blue {
        background: #53b5e6;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.blue:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #58c2f8;
    }

    .arlina-button.blue[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }

    /* Orange button */
    .arlina-button.orange {
        background: #ea8557;
        color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
    }

    .arlina-button.orange:hover {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #ffa96c;
    }

    .arlina-button.orange[data-loading] {
        border-color: rgba(0, 0, 0, 0.07);
        background-color: #999;
    }


    /* Spinner animation */
    .arlina-button .spinner {
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        margin-top: -10px;
        opacity: 0;

        background-image: url("./assets/img/spin.gif");
        background-repeat: no-repeat;

        /* background-image: url(http://2.bp.blogspot.com/-GPSLDnKmX3s/VSvPkXsCHvI/AAAAAAAACOg/Xmm2kIDu-CU/s1600/spin.gif); */


    }


    /*************************************
 * EASING
 */

    .arlina-button,
    .arlina-button .spinner,
    .arlina-button .label {
        -webkit-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -moz-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        -ms-transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.320, 1.275) all;
    }

    .arlina-button.zoom-in,
    .arlina-button.zoom-in .spinner,
    .arlina-button.zoom-in .label,
    .arlina-button.zoom-out,
    .arlina-button.zoom-out .spinner,
    .arlina-button.zoom-out .label {
        -webkit-transition: 0.3s ease all;
        -moz-transition: 0.3s ease all;
        -ms-transition: 0.3s ease all;
        transition: 0.3s ease all;
    }



    /*************************************
 * EXPAND RIGHT
 */

    .arlina-button.expand-left .spinner {
        left: 0.8em;
    }

    .arlina-button.expand-left[data-loading] {
        padding-left: 40px;
    }

    .arlina-button.expand-left[data-loading] .spinner {
        opacity: 1;
    }
    </style>
</body>

</html>