<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';
include('lcheck.php');
if($permissionuser=='0'||$permissionuser=='1')
{
    header('Location: dashboard.php');
}
$sqlss="select * from paircontrols where id='$companymainid'";
$resultss=mysqli_query($con,$sqlss);
$rowww=mysqli_fetch_assoc($resultss);
// $sql="select * from paircontrols where createdid='$companymainid'";
// $result=mysqli_query($con,$sql);
// $row=mysqli_fetch_assoc($result);
$sqls="select * from paircontrols where id='$companymainid'";
$results=mysqli_query($con,$sqls);
$roww=mysqli_fetch_assoc($results);
//------------------------------------
$sql="SELECT * FROM paircontrols WHERE id='$companymainid'";
$result=mysqli_query($con,$sql);
$rows=mysqli_fetch_assoc($result);
$sql="SELECT * FROM pairaccess WHERE createdid='$companymainid'";
$result=mysqli_query($con,$sql);
$rowsaccess=mysqli_fetch_assoc($result);
//names------------------------------
$oldfranchiseandroles=$rows['franchiseandroles'];
$olduserandroles=$rows['userandroles'];
$oldbooks=$rows['books'];
// $itemsname=$rows['itemhead'];
// $proname=$rows['prohead'];
// $servname=$rows['servch'];
// $invadjname=$rows['invadjch'];
// $salech=$rows['salech'];
// $cusch=$rows['cusch'];
// $saleorderch=$rows['saleorderch'];
// $saleordersch=$rows['saleordersch'];
// $qtch=$rows['qtch'];
// $esch=$rows['esch'];
// $pforminvhead=$rows['pforminvhead'];
// $deliverychch=$rows['deliverychch'];
// $invch=$rows['invch'];
// $payreceivech=$rows['payreceivech'];
// $salereturnch=$rows['salereturnch'];
// $purch=$rows['purch'];
// $vendorch=$rows['vendorch'];
// $purorderch=$rows['purorderch'];
// $purreceivech=$rows['purreceivech'];
// $billch=$rows['billch'];
// $paymadech=$rows['paymadech'];
// $purreturnch=$rows['purreturnch'];
// $bankch=$rows['bankch'];
// $expch=$rows['expch'];
// $accountch=$rows['accountch'];
// $manualjournalsch=$rows['manualjournalsch'];
// $chartaccountch=$rows['chartaccountch'];
// $timetrackingch=$rows['timetrackingch'];
// $projectsch=$rows['projectsch'];
// $timesheetch=$rows['timesheetch'];
// $ewaybillsch=$rows['ewaybillsch'];
// $gstfillingch=$rows['gstfillingch'];
// $payrollch=$rows['payrollch'];
// $attendencech=$rows['attendencech'];
// $reportch=$rows['reportch'];
// $permissionitems=$rows['permissionitems'];
// $permissionproducts=$rows['permissionproducts'];
// $permissionservices=$rows['permissionservices'];
// $permissioninvadj=$rows['permissioninvadj'];
// $permissionsales=$rows['permissionsales'];
// $permissioncustomers=$rows['permissioncustomers'];
// $permissionssaleorder=$rows['permissionssaleorder'];
// $permissionsaleorders=$rows['permissionsaleorders'];
// $permissionquotations=$rows['permissionquotations'];
// $permissionestimates=$rows['permissionestimates'];
// $permissionspforminv=$rows['permissionspforminv'];
// $permissiondeliverych=$rows['permissiondeliverych'];
// $permissioninvoices=$rows['permissioninvoices'];
// $permissionspayreceive=$rows['permissionspayreceive'];
// $permissionssalereturn=$rows['permissionssalereturn'];
// $permissionspurchases=$rows['permissionspurchases'];
// $permissionsvendor=$rows['permissionsvendor'];
// $permissionspurorder=$rows['permissionspurorder'];
// $permissionpurreceive=$rows['permissionpurreceive'];
// $permissionsbill=$rows['permissionsbill'];
// $permissionspaymade=$rows['permissionspaymade'];
// $permissionspurreturn=$rows['permissionspurreturn'];
// $permissionbanking=$rows['permissionbanking'];
// $permissionsexpens=$rows['permissionsexpens'];
// $permissionaccounting=$rows['permissionaccounting'];
// $permissionmanualjournals=$rows['permissionmanualjournals'];
// $permissionchartaccount=$rows['permissionchartaccount'];
// $permissiontimetracking=$rows['permissiontimetracking'];
// $permissionprojects=$rows['permissionprojects'];
// $permissiontimesheet=$rows['permissiontimesheet'];
// $permissionewaybills=$rows['permissionewaybills'];
// $permissiongstfilling=$rows['permissiongstfilling'];
// $permissionpayroll=$rows['permissionpayroll'];
// $permissionattendence=$rows['permissionattendence'];
// $permissionsreport=$rows['permissionsreport'];
//     $propre=$rows['propreference'];
//     $proinfoadd=$rows['proinfoadd'];
//     $proinfoedit=$rows['proinfoedit'];
//     $proinfoview=$rows['proinfoview'];
//     $prohead=$rows['proname'];
//     $servhead=$rows['procode'];
//     $proadd=$rows['pronadd'];
//     $proedit=$rows['pronedit'];
//     $proview=$rows['pronview'];
//     $servadd=$rows['procadd'];
//     $servedit=$rows['procedit'];
//     $servview=$rows['procview'];
//     $provishead=$rows['provisibility'];
//     $provisadd=$rows['provisadd'];
//     $provisedit=$rows['provisedit'];
//     $provisview=$rows['provisview'];
//     $proimghead=$rows['proimage'];
//     $proimgadd=$rows['proimgadd'];
//     $proimgedit=$rows['proimgedit'];
//     $proimgview=$rows['proimgview'];
//     $propurhead=$rows['propurchase'];
//     $propuradd=$rows['propuradd'];
//     $propuredit=$rows['propuredit'];
//     $propurview=$rows['propurview'];
//     $prosalehead=$rows['prosales'];
//     $prosaleadd=$rows['prosaleadd'];
//     $prosaleedit=$rows['prosaleedit'];
//     $prosaleview=$rows['prosaleview'];
//     $protaxhead=$rows['protaxes'];
//     $protaxadd=$rows['protaxadd'];
//     $protaxedit=$rows['protaxedit'];
//     $protaxview=$rows['protaxview'];
//     $proinvhead=$rows['proinventory'];
//     $proinvadd=$rows['proinvadd'];
//     $proinvedit=$rows['proinvedit'];
//     $proinvview=$rows['proinvview'];
//     $prostkhead=$rows['prostock'];
//     $prostkadd=$rows['prostkadd'];
//     $prostkedit=$rows['prostkedit'];
//     $prostkview=$rows['prostkview'];
//     $proothhead=$rows['proother'];
//     $proothadd=$rows['proothadd'];
//     $proothedit=$rows['proothedit'];
//     $proothview=$rows['proothview'];
//     $prounithead=$rows['prounithead'];
//     $prounitadd=$rows['prounitadd'];
//     $prounitedit=$rows['prounitedit'];
//     $prounitview=$rows['prounitview'];
//     $prohsnhead=$rows['prohsnhead'];
//     $prohsnadd=$rows['prohsnadd'];
//     $prohsnedit=$rows['prohsnedit'];
//     $prohsnview=$rows['prohsnview'];
//     $proskuhead=$rows['proskuhead'];
//     $proskuadd=$rows['proskuadd'];
//     $proskuedit=$rows['proskuedit'];
//     $proskuview=$rows['proskuview'];
//     $proupchead=$rows['proupchead'];
//     $proupcadd=$rows['proupcadd'];
//     $proupcedit=$rows['proupcedit'];
//     $proupcview=$rows['proupcview'];
//     $proeanhead=$rows['proeanhead'];
//     $proeanadd=$rows['proeanadd'];
//     $proeanedit=$rows['proeanedit'];
//     $proeanview=$rows['proeanview'];
//     $prompnhead=$rows['prompnhead'];
//     $prompnadd=$rows['prompnadd'];
//     $prompnedit=$rows['prompnedit'];
//     $prompnview=$rows['prompnview'];
//     $proisbhead=$rows['proisbhead'];
//     $proisbadd=$rows['proisbadd'];
//     $proisbedit=$rows['proisbedit'];
//     $proisbview=$rows['proisbview'];
//     $probranhead=$rows['probranhead'];
//     $probranadd=$rows['probranadd'];
//     $probranedit=$rows['probranedit'];
//     $probranview=$rows['probranview'];
//     $promanhead=$rows['promanhead'];
//     $promanadd=$rows['promanadd'];
//     $promanedit=$rows['promanedit'];
//     $promanview=$rows['promanview'];
//     $promolhead=$rows['promolhead'];
//     $promoladd=$rows['promoladd'];
//     $promoledit=$rows['promoledit'];
//     $promolview=$rows['promolview'];
//     $progenhead=$rows['progenhead'];
//     $progenadd=$rows['progenadd'];
//     $progenedit=$rows['progenedit'];
//     $progenview=$rows['progenview'];
//     $prosalthead=$rows['prosalthead'];
//     $prosaltadd=$rows['prosaltadd'];
//     $prosaltedit=$rows['prosaltedit'];
//     $prosaltview=$rows['prosaltview'];
//     $proconshead=$rows['proconshead'];
//     $proconsadd=$rows['proconsadd'];
//     $proconsedit=$rows['proconsedit'];
//     $proconsview=$rows['proconsview'];
//     $procathead=$rows['procathead'];
//     $procatadd=$rows['procatadd'];
//     $procatedit=$rows['procatedit'];
//     $procatview=$rows['procatview'];
//     $prosubhead=$rows['prosubhead'];
//     $prosubadd=$rows['prosubadd'];
//     $prosubedit=$rows['prosubedit'];
//     $prosubview=$rows['prosubview'];
//     $prodimhead=$rows['prodimhead'];
//     $prodimadd=$rows['prodimadd'];
//     $prodimedit=$rows['prodimedit'];
//     $prodimview=$rows['prodimview'];
//     $proweihead=$rows['proweihead'];
//     $proweiadd=$rows['proweiadd'];
//     $proweiedit=$rows['proweiedit'];
//     $proweiview=$rows['proweiview'];
//     $prorackhead=$rows['prorackhead'];
//     $prorackadd=$rows['prorackadd'];
//     $prorackedit=$rows['prorackedit'];
//     $prorackview=$rows['prorackview'];
//     $prodeshead=$rows['prodeshead'];
//     $prodesadd=$rows['prodesadd'];
//     $prodesedit=$rows['prodesedit'];
//     $prodesview=$rows['prodesview'];
//     $prodelhead=$rows['prodelhead'];
//     $prodeladd=$rows['prodeladd'];
//     $prodeledit=$rows['prodeledit'];
//     $prodelview=$rows['prodelview'];
//     $productcodehead=$rows['productcodehead'];
//     $productcodeadd=$rows['productcodeadd'];
//     $productcodeedit=$rows['productcodeedit'];
//     $productcodeview=$rows['productcodeview'];
//     $protaxprefer=$rows['protaxprefer'];
//     $protaxpreferadd=$rows['protaxpreferadd'];
//     $protaxpreferedit=$rows['protaxpreferedit'];
//     $protaxpreferview=$rows['protaxpreferview'];
//     $protaxrate=$rows['protaxrate'];
//     $protaxrateadd=$rows['protaxrateadd'];
//     $protaxrateedit=$rows['protaxrateedit'];
//     $protaxrateview=$rows['protaxrateview'];
//     $prointratax=$rows['prointratax'];
//     $prointrataxadd=$rows['prointrataxadd'];
//     $prointrataxedit=$rows['prointrataxedit'];
//     $prointrataxview=$rows['prointrataxview'];
//     $prointertax=$rows['prointertax'];
//     $prointertaxadd=$rows['prointertaxadd'];
//     $prointertaxedit=$rows['prointertaxedit'];
//     $prointertaxview=$rows['prointertaxview'];
//     $prolistname=$rows['prolistname'];
//     $prolistcode=$rows['prolistcode'];
//     $prolistcat=$rows['prolistcat'];
//     $prolistunit=$rows['prolistunit'];
//     $prolistdes=$rows['prolistdes'];
//     $prolistdel=$rows['prolistdel'];
//     $prolistprice=$rows['prolistprice'];
//     $prolistinttax=$rows['prolistinttax'];
//     $prolistvis=$rows['prolistvis'];
//     $proliststatus=$rows['proliststatus'];
//     $salepricenamehead=$rows['salepricename'];
//     $salepricenameadd=$rows['salepricenameadd'];
//     $salepricenameedit=$rows['salepricenameedit'];
//     $salepricenameview=$rows['salepricenameview'];
//     $salemrphead=$rows['servsalemrpadd'];
//     $salemrpadd=$rows['salemrpadd'];
//     $salemrpedit=$rows['salemrpedit'];
//     $salemrpview=$rows['salemrpview'];
//     $salepriceratehead=$rows['servsalepricerate'];
//     $salepricerateadd=$rows['salepricerateadd'];
//     $salepricerateedit=$rows['salepricerateedit'];
//     $salepricerateview=$rows['salepricerateview'];
//     $saledescriptionhead=$rows['servsaledescription'];
//     $saledescriptionadd=$rows['saledescriptionadd'];
//     $saledescriptionedit=$rows['saledescriptionedit'];
//     $saledescriptionview=$rows['saledescriptionview'];
//     $servsalepricenamehead=$rows['servsalepricename'];
//     $servsalepricenameadd=$rows['servsalepricenameadd'];
//     $servsalepricenameedit=$rows['servsalepricenameedit'];
//     $servsalepricenameview=$rows['servsalepricenameview'];
//     $servsalemrphead=$rows['servsalemrp'];
//     $servsalemrpadd=$rows['servsalemrpadd'];
//     $servsalemrpedit=$rows['servsalemrpedit'];
//     $servsalemrpview=$rows['servsalemrpview'];
//     $servsalepriceratehead=$rows['servsalepricerate'];
//     $servsalepricerateadd=$rows['servsalepricerateadd'];
//     $servsalepricerateedit=$rows['servsalepricerateedit'];
//     $servsalepricerateview=$rows['servsalepricerateview'];
//     $servsaledescriptionhead=$rows['servsaledescription'];
//     $servsaledescriptionadd=$rows['servsaledescriptionadd'];
//     $servsaledescriptionedit=$rows['servsaledescriptionedit'];
//     $servsaledescriptionview=$rows['servsaledescriptionview'];
//     $servinfohead=$rows['servinfohead'];
//     $servinfoadd=$rows['servinfoadd'];
//     $servinfoedit=$rows['servinfoedit'];
//     $servinfoview=$rows['servinfoview'];
//     $servcodehead=$rows['servcodehead'];
//     $servcodeadd=$rows['servcodeadd'];
//     $servcodeedit=$rows['servcodeedit'];
//     $servcodeview=$rows['servcodeview'];
//     $servnhead=$rows['servname'];
//     $servnadd=$rows['servnadd'];
//     $servnedit=$rows['servnedit'];
//     $servnview=$rows['servnview'];
//     $servchead=$rows['servcode'];
//     $servcadd=$rows['servcadd'];
//     $servcedit=$rows['servcedit'];
//     $servcview=$rows['servcview'];
//     $servunithead=$rows['servunithead'];
//     $servunitadd=$rows['servunitadd'];
//     $servunitedit=$rows['servunitedit'];
//     $servunitview=$rows['servunitview'];
//     $servhsnhead=$rows['servhsnhead'];
//     $servhsnadd=$rows['servhsnadd'];
//     $servhsnedit=$rows['servhsnedit'];
//     $servhsnview=$rows['servhsnview'];
//     $servskuhead=$rows['servskuhead'];
//     $servskuadd=$rows['servskuadd'];
//     $servskuedit=$rows['servskuedit'];
//     $servskuview=$rows['servskuview'];
//     $servupchead=$rows['servupchead'];
//     $servupcadd=$rows['servupcadd'];
//     $servupcedit=$rows['servupcedit'];
//     $servupcview=$rows['servupcview'];
//     $serveanhead=$rows['serveanhead'];
//     $serveanadd=$rows['serveanadd'];
//     $serveanedit=$rows['serveanedit'];
//     $serveanview=$rows['serveanview'];
//     $servmpnhead=$rows['servmpnhead'];
//     $servmpnadd=$rows['servmpnadd'];
//     $servmpnedit=$rows['servmpnedit'];
//     $servmpnview=$rows['servmpnview'];
//     $servisbhead=$rows['servisbhead'];
//     $servisbadd=$rows['servisbadd'];
//     $servisbedit=$rows['servisbedit'];
//     $servisbview=$rows['servisbview'];
//     $servbranhead=$rows['servbranhead'];
//     $servbranadd=$rows['servbranadd'];
//     $servbranedit=$rows['servbranedit'];
//     $servbranview=$rows['servbranview'];
//     $servmanhead=$rows['servmanhead'];
//     $servmanadd=$rows['servmanadd'];
//     $servmanedit=$rows['servmanedit'];
//     $servmanview=$rows['servmanview'];
//     $servmolhead=$rows['servmolhead'];
//     $servmoladd=$rows['servmoladd'];
//     $servmoledit=$rows['servmoledit'];
//     $servmolview=$rows['servmolview'];
//     $servgenhead=$rows['servgenhead'];
//     $servgenadd=$rows['servgenadd'];
//     $servgenedit=$rows['servgenedit'];
//     $servgenview=$rows['servgenview'];
//     $servsalthead=$rows['servsalthead'];
//     $servsaltadd=$rows['servsaltadd'];
//     $servsaltedit=$rows['servsaltedit'];
//     $servsaltview=$rows['servsaltview'];
//     $servconshead=$rows['servconshead'];
//     $servconsadd=$rows['servconsadd'];
//     $servconsedit=$rows['servconsedit'];
//     $servconsview=$rows['servconsview'];
//     $servcathead=$rows['servcathead'];
//     $servcatadd=$rows['servcatadd'];
//     $servcatedit=$rows['servcatedit'];
//     $servcatview=$rows['servcatview'];
//     $servsubhead=$rows['servsubhead'];
//     $servsubadd=$rows['servsubadd'];
//     $servsubedit=$rows['servsubedit'];
//     $servsubview=$rows['servsubview'];
//     $servdimhead=$rows['servdimhead'];
//     $servdimadd=$rows['servdimadd'];
//     $servdimedit=$rows['servdimedit'];
//     $servdimview=$rows['servdimview'];
//     $servweihead=$rows['servweihead'];
//     $servweiadd=$rows['servweiadd'];
//     $servweiedit=$rows['servweiedit'];
//     $servweiview=$rows['servweiview'];
//     $servrackhead=$rows['servrackhead'];
//     $servrackadd=$rows['servrackadd'];
//     $servrackedit=$rows['servrackedit'];
//     $servrackview=$rows['servrackview'];
//     $servdeshead=$rows['servdeshead'];
//     $servdesadd=$rows['servdesadd'];
//     $servdesedit=$rows['servdesedit'];
//     $servdesview=$rows['servdesview'];
//     $servdelhead=$rows['servdelhead'];
//     $servdeladd=$rows['servdeladd'];
//     $servdeledit=$rows['servdeledit'];
//     $servdelview=$rows['servdelview'];
//     $servvishead=$rows['servvisibility'];
//     $servvisadd=$rows['servvisadd'];
//     $servvisedit=$rows['servvisedit'];
//     $servvisview=$rows['servvisview'];
//     $servimghead=$rows['servimage'];
//     $servimgadd=$rows['servimgadd'];
//     $servimgedit=$rows['servimgedit'];
//     $servimgview=$rows['servimgview'];
//     $servpurhead=$rows['servpurchase'];
//     $servpuradd=$rows['servpuradd'];
//     $servpuredit=$rows['servpuredit'];
//     $servpurview=$rows['servpurview'];
//     $servsalehead=$rows['servsales'];
//     $servsaleadd=$rows['servsaleadd'];
//     $servsaleedit=$rows['servsaleedit'];
//     $servsaleview=$rows['servsaleview'];
//     $servtaxhead=$rows['servtaxes'];
//     $servtaxadd=$rows['servtaxadd'];
//     $servtaxedit=$rows['servtaxedit'];
//     $servtaxview=$rows['servtaxview'];
//     $servinvhead=$rows['servinventory'];
//     $servinvadd=$rows['servinvadd'];
//     $servinvedit=$rows['servinvedit'];
//     $servinvview=$rows['servinvview'];
//     $servstkhead=$rows['servstock'];
//     $servstkadd=$rows['servstkadd'];
//     $servstkedit=$rows['servstkedit'];
//     $servstkview=$rows['servstkview'];
//     $servothhead=$rows['servother'];
//     $servothadd=$rows['servothadd'];
//     $servothedit=$rows['servothedit'];
//     $servothview=$rows['servothview'];
//     $servtaxprefer=$rows['servtaxpreference'];
//     $servtaxpreferadd=$rows['servtaxpreferadd'];
//     $servtaxpreferedit=$rows['servtaxpreferedit'];
//     $servtaxpreferview=$rows['servtaxpreferview'];
//     $servtaxrate=$rows['servtaxrates'];
//     $servtaxrateadd=$rows['servtaxrateadd'];
//     $servtaxrateedit=$rows['servtaxrateedit'];
//     $servtaxrateview=$rows['servtaxrateview'];
//     $servintratax=$rows['servintrataxes'];
//     $servintrataxadd=$rows['servintrataxadd'];
//     $servintrataxedit=$rows['servintrataxedit'];
//     $servintrataxview=$rows['servintrataxview'];
//     $servintertax=$rows['servintertaxes'];
//     $servintertaxadd=$rows['servintertaxadd'];
//     $servintertaxedit=$rows['servintertaxedit'];
//     $servintertaxview=$rows['servintertaxview'];
//     $servlistname=$rows['servlistname'];
//     $servlistcode=$rows['servlistcode'];
//     $servlistcat=$rows['servlistcat'];
//     $servlistunit=$rows['servlistunit'];
//     $servlistdes=$rows['servlistdes'];
//     $servlistdel=$rows['servlistdel'];
//     $servlistprice=$rows['servlistprice'];
//     $servlistinttax=$rows['servlistinttax'];
//     $servlistvis=$rows['servlistvis'];
//     $servliststatus=$rows['servliststatus'];
//     $cuspre=$rows['cuspreference'];
//     $cusinfoadd=$rows['cusinfoadd'];
//     $cusinfoedit=$rows['cusinfoedit'];
//     $cusinfoview=$rows['cusinfoview'];
//     $cusname=$rows['cusname'];
//     $cusnadd=$rows['cusnadd'];
//     $cusnedit=$rows['cusnedit'];
//     $cusnview=$rows['cusnview'];
//     $cuscode=$rows['cuscode'];
//     $cuscodeadd=$rows['cuscodeadd'];
//     $cuscodeedit=$rows['cuscodeedit'];
//     $cuscodeview=$rows['cuscodeview'];
//     $cusvisinfo=$rows['cusvisinfo'];
//     $cusvisadd=$rows['cusvisadd'];
//     $cusvisedit=$rows['cusvisedit'];
//     $cusvisview=$rows['cusvisview'];
//     $custaxinfo=$rows['custaxinfo'];
//     $custaxadd=$rows['custaxadd'];
//     $custaxedit=$rows['custaxedit'];
//     $custaxview=$rows['custaxview'];
//     $cuspayinfo=$rows['cuspayinfo'];
//     $cuspayadd=$rows['cuspayadd'];
//     $cuspayedit=$rows['cuspayedit'];
//     $cuspayview=$rows['cuspayview'];
//     $cusbankinfo=$rows['cusbankinfo'];
//     $cusbankadd=$rows['cusbankadd'];
//     $cusbankedit=$rows['cusbankedit'];
//     $cusbankview=$rows['cusbankview'];
//     $cusothinfo=$rows['cusothinfo'];
//     $cusothadd=$rows['cusothadd'];
//     $cusothedit=$rows['cusothedit'];
//     $cusothview=$rows['cusothview'];
//     $cusattinfo=$rows['cusattinfo'];
//     $cusattadd=$rows['cusattadd'];
//     $cusattedit=$rows['cusattedit'];
//     $cusattview=$rows['cusattview'];
//     $invinfo=$rows['invinfo'];
//     $invinfoadd=$rows['invinfoadd'];
//     $invinfoedit=$rows['invinfoedit'];
//     $invinfoview=$rows['invinfoview'];
//     $invcusinfo=$rows['invcusinfo'];
//     $invcusadd=$rows['invcusadd'];
//     $invcusedit=$rows['invcusedit'];
//     $invcusview=$rows['invcusview'];
//     $invitminfo=$rows['invitminfo'];
//     $invitmadd=$rows['invitmadd'];
//     $invitmedit=$rows['invitmedit'];
//     $invitmview=$rows['invitmview'];
//     $cusidhead=$rows['cusidhead'];
//     $cusidadd=$rows['cusidadd'];
//     $cusidedit=$rows['cusidedit'];
//     $cusidview=$rows['cusidview'];
//     $cuspcontacthead=$rows['cuspcontacthead'];
//     $cuspcontactadd=$rows['cuspcontactadd'];
//     $cuspcontactedit=$rows['cuspcontactedit'];
//     $cuspcontactview=$rows['cuspcontactview'];
//     $cuscnamehead=$rows['cuscnamehead'];
//     $cuscnameadd=$rows['cuscnameadd'];
//     $cuscnameedit=$rows['cuscnameedit'];
//     $cuscnameview=$rows['cuscnameview'];
//     $cusgenhead=$rows['cusgenhead'];
//     $cusgenadd=$rows['cusgenadd'];
//     $cusgenedit=$rows['cusgenedit'];
//     $cusgenview=$rows['cusgenview'];
//     $cusagehead=$rows['cusagehead'];
//     $cusageadd=$rows['cusageadd'];
//     $cusageedit=$rows['cusageedit'];
//     $cusageview=$rows['cusageview'];
//     $cuscathead=$rows['cuscathead'];
//     $cuscatadd=$rows['cuscatadd'];
//     $cuscatedit=$rows['cuscatedit'];
//     $cuscatview=$rows['cuscatview'];
//     $cussubhead=$rows['cussubhead'];
//     $cussubadd=$rows['cussubadd'];
//     $cussubedit=$rows['cussubedit'];
//     $cussubview=$rows['cussubview'];
//     $cusmailhead=$rows['cusmailhead'];
//     $cusmailadd=$rows['cusmailadd'];
//     $cusmailedit=$rows['cusmailedit'];
//     $cusmailview=$rows['cusmailview'];
//     $cusphonehead=$rows['cusphonehead'];
//     $cusphoneadd=$rows['cusphoneadd'];
//     $cusphoneedit=$rows['cusphoneedit'];
//     $cusphoneview=$rows['cusphoneview'];
//     $cuswebhead=$rows['cuswebhead'];
//     $cuswebadd=$rows['cuswebadd'];
//     $cuswebedit=$rows['cuswebedit'];
//     $cuswebview=$rows['cuswebview'];
//     $cusbillhead=$rows['cusbillhead'];
//     $cusbilladd=$rows['cusbilladd'];
//     $cusbilledit=$rows['cusbilledit'];
//     $cusbillview=$rows['cusbillview'];
//     $cusshiphead=$rows['cusshiphead'];
//     $cusshipadd=$rows['cusshipadd'];
//     $cusshipedit=$rows['cusshipedit'];
//     $cusshipview=$rows['cusshipview'];
//     $qtcusinfo=$rows['qtcusinfo'];
//     $qtcusadd=$rows['qtcusadd'];
//     $qtcusedit=$rows['qtcusedit'];
//     $qtcusview=$rows['qtcusview'];
//     $qtqtinfo=$rows['qtqtinfo'];
//     $qtqtadd=$rows['qtqtadd'];
//     $qtqtedit=$rows['qtqtedit'];
//     $qtqtview=$rows['qtqtview'];
//     $qtitinfo=$rows['qtitinfo'];
//     $qtitadd=$rows['qtitadd'];
//     $qtitedit=$rows['qtitedit'];
//     $qtitview=$rows['qtitview'];
//     $cuslistserial=$rows['cuslistserial'];
//     $cuslistname=$rows['cuslistname'];
//     $cuslistaddress=$rows['cuslistaddress'];
//     $cuslistmail=$rows['cuslistmail'];
//     $cuslistmobile=$rows['cuslistmobile'];
//     $cuslistaction=$rows['cuslistaction'];
//     $cusmobilephonehead=$rows['cusmobilephonehead'];
//     $cusmobilephoneadd=$rows['cusmobilephoneadd'];
//     $cusmobilephoneedit=$rows['cusmobilephoneedit'];
//     $cusmobilephoneview=$rows['cusmobilephoneview'];
//     $custaxpreferhead=$rows['custaxprefer'];
//     $custaxpreferadd=$rows['custaxpreferadd'];
//     $custaxpreferedit=$rows['custaxpreferedit'];
//     $custaxpreferview=$rows['custaxpreferview'];
//     $cusgstrtypehead=$rows['cusgstrtype'];
//     $cusgstrtypeadd=$rows['cusgstrtypeadd'];
//     $cusgstrtypeedit=$rows['cusgstrtypeedit'];
//     $cusgstrtypeview=$rows['cusgstrtypeview'];
//     $cusgstinhead=$rows['cusgstin'];
//     $cusgstinadd=$rows['cusgstinadd'];
//     $cusgstinedit=$rows['cusgstinedit'];
//     $cusgstinview=$rows['cusgstinview'];
//     $cusbusleghead=$rows['cusbusleg'];
//     $cusbuslegadd=$rows['cusbuslegadd'];
//     $cusbuslegedit=$rows['cusbuslegedit'];
//     $cusbuslegview=$rows['cusbuslegview'];
//     $cusbustrdhead=$rows['cusbustrd'];
//     $cusbustrdadd=$rows['cusbustrdadd'];
//     $cusbustrdedit=$rows['cusbustrdedit'];
//     $cusbustrdview=$rows['cusbustrdview'];
//     $cuspanhead=$rows['cuspan'];
//     $cuspanadd=$rows['cuspanadd'];
//     $cuspanedit=$rows['cuspanedit'];
//     $cuspanview=$rows['cuspanview'];
//     $cusposhead=$rows['cuspos'];
//     $cusposadd=$rows['cusposadd'];
//     $cusposedit=$rows['cusposedit'];
//     $cusposview=$rows['cusposview'];
//     $vendorhead=$rows['vendorhead'];
//     $veninfoadd=$rows['veninfoadd'];
//     $veninfoedit=$rows['veninfoedit'];
//     $veninfoview=$rows['veninfoview'];
//     $vendorname=$rows['vendorname'];
//     $vennadd=$rows['vennadd'];
//     $vennedit=$rows['vennedit'];
//     $vennview=$rows['vennview'];
//     $vencode=$rows['vencode'];
//     $vencodeadd=$rows['vencodeadd'];
//     $vencodeedit=$rows['vencodeedit'];
//     $vencodeview=$rows['vencodeview'];
//     $venpcontacthead=$rows['venpcontacthead'];
//     $venpcontactadd=$rows['venpcontactadd'];
//     $venpcontactedit=$rows['venpcontactedit'];
//     $venpcontactview=$rows['venpcontactview'];
//     $vencnamehead=$rows['vencnamehead'];
//     $vencnameadd=$rows['vencnameadd'];
//     $vencnameedit=$rows['vencnameedit'];
//     $vencnameview=$rows['vencnameview'];
//     $venidhead=$rows['venidhead'];
//     $venidadd=$rows['venidadd'];
//     $venidedit=$rows['venidedit'];
//     $venidview=$rows['venidview'];
//     $venbillhead=$rows['venbillhead'];
//     $venbilladd=$rows['venbilladd'];
//     $venbilledit=$rows['venbilledit'];
//     $venbillview=$rows['venbillview'];
//     $venshiphead=$rows['venshiphead'];
//     $venshipadd=$rows['venshipadd'];
//     $venshipedit=$rows['venshipedit'];
//     $venshipview=$rows['venshipview'];
//     $venvisinfo=$rows['venvisinfo'];
//     $venvisadd=$rows['venvisadd'];
//     $venvisedit=$rows['venvisedit'];
//     $venvisview=$rows['venvisview'];
//     $vencathead=$rows['vencathead'];
//     $vencatadd=$rows['vencatadd'];
//     $vencatedit=$rows['vencatedit'];
//     $vencatview=$rows['vencatview'];
//     $vensubhead=$rows['vensubhead'];
//     $vensubadd=$rows['vensubadd'];
//     $vensubedit=$rows['vensubedit'];
//     $vensubview=$rows['vensubview'];
//     $ventaxinfo=$rows['ventaxinfo'];
//     $ventaxadd=$rows['ventaxadd'];
//     $ventaxedit=$rows['ventaxedit'];
//     $ventaxview=$rows['ventaxview'];
//     $venlistserial=$rows['venlistserial'];
//     $venlistname=$rows['venlistname'];
//     $venlistaddress=$rows['venlistaddress'];
//     $venlistmail=$rows['venlistmail'];
//     $venlistmobile=$rows['venlistmobile'];
//     $venlistaction=$rows['venlistaction'];
//     $venmailhead=$rows['venmailhead'];
//     $venmailadd=$rows['venmailadd'];
//     $venmailedit=$rows['venmailedit'];
//     $venmailview=$rows['venmailview'];
//     $venphonehead=$rows['venphonehead'];
//     $venphoneadd=$rows['venphoneadd'];
//     $venphoneedit=$rows['venphoneedit'];
//     $venphoneview=$rows['venphoneview'];
//     $venwebhead=$rows['venwebhead'];
//     $venwebadd=$rows['venwebadd'];
//     $venwebedit=$rows['venwebedit'];
//     $venwebview=$rows['venwebview'];
//     $venmobilephonehead=$rows['venmobilephonehead'];
//     $venmobilephoneadd=$rows['venmobilephoneadd'];
//     $venmobilephoneedit=$rows['venmobilephoneedit'];
//     $venmobilephoneview=$rows['venmobilephoneview'];
//     $ventaxpreferhead=$rows['ventaxprefer'];
//     $ventaxpreferadd=$rows['ventaxpreferadd'];
//     $ventaxpreferedit=$rows['ventaxpreferedit'];
//     $ventaxpreferview=$rows['ventaxpreferview'];
//     $vengstrtypehead=$rows['vengstrtype'];
//     $vengstrtypeadd=$rows['vengstrtypeadd'];
//     $vengstrtypeedit=$rows['vengstrtypeedit'];
//     $vengstrtypeview=$rows['vengstrtypeview'];
//     $vengstinhead=$rows['vengstin'];
//     $vengstinadd=$rows['vengstinadd'];
//     $vengstinedit=$rows['vengstinedit'];
//     $vengstinview=$rows['vengstinview'];
//     $venbusleghead=$rows['venbusleg'];
//     $venbuslegadd=$rows['venbuslegadd'];
//     $venbuslegedit=$rows['venbuslegedit'];
//     $venbuslegview=$rows['venbuslegview'];
//     $venbustrdhead=$rows['venbustrd'];
//     $venbustrdadd=$rows['venbustrdadd'];
//     $venbustrdedit=$rows['venbustrdedit'];
//     $venbustrdview=$rows['venbustrdview'];
//     $venpanhead=$rows['venpan'];
//     $venpanadd=$rows['venpanadd'];
//     $venpanedit=$rows['venpanedit'];
//     $venpanview=$rows['venpanview'];
//     $venposhead=$rows['venpos'];
//     $venposadd=$rows['venposadd'];
//     $venposedit=$rows['venposedit'];
//     $venposview=$rows['venposview'];
//     $quotationdatelist=$rowsaccess['quotationdatelist'];
//     $quotationnolist=$rowsaccess['quotationnolist'];
//     $customernamelist=$rowsaccess['customernamelist'];
//     $quotationtermlist=$rowsaccess['quotationtermlist'];
//     $quotationamountlist=$rowsaccess['quotationamountlist'];
//     $quotationeditlist=$rowsaccess['quotationeditlist'];
//     $quotationprintlist=$rowsaccess['quotationprintlist'];
//     $estimatedatelist=$rowsaccess['estimatedatelist'];
//     $estimatenolist=$rowsaccess['estimatenolist'];
//     $estimatecustomernamelist=$rowsaccess['estimatecustomernamelist'];
//     $estimatetermlist=$rowsaccess['estimatetermlist'];
//     $estimateamountlist=$rowsaccess['estimateamountlist'];
//     $estimateprintlist=$rowsaccess['estimateprintlist'];
//     $invoicedatelist=$rowsaccess['invoicedatelist'];
//     $invoicenolist=$rowsaccess['invoicenolist'];
//     $invoicecustomernamelist=$rowsaccess['invoicecustomernamelist'];
//     $invoicetermlist=$rowsaccess['invoicetermlist'];
//     $invoiceamountlist=$rowsaccess['invoiceamountlist'];
//     $invoicestatuslist=$rowsaccess['invoicestatuslist'];
//     $invoicebalancelist=$rowsaccess['invoicebalancelist'];
//     $invoiceprintlist=$rowsaccess['invoiceprintlist'];
//     $proinvoicedatelist=$rowsaccess['proinvoicedatelist'];
//     $proinvoicenolist=$rowsaccess['proinvoicenolist'];
//     $proinvoicecustomernamelist=$rowsaccess['proinvoicecustomernamelist'];
//     $proinvoicetermlist=$rowsaccess['proinvoicetermlist'];
//     $proinvoiceamountlist=$rowsaccess['proinvoiceamountlist'];
//     $proinvoiceprintlist=$rowsaccess['proinvoiceprintlist'];
//     $jobdatelist=$rowsaccess['jobdatelist'];
//     $jobnolist=$rowsaccess['jobnolist'];
//     $jobcustomernamelist=$rowsaccess['jobcustomernamelist'];
//     $jobtermlist=$rowsaccess['jobtermlist'];
//     $jobamountlist=$rowsaccess['jobamountlist'];
//     $jobprintlist=$rowsaccess['jobprintlist'];
//     $jobgeneratequotation=$rowsaccess['jobgeneratequotation'];
//     $salesordersdatelist=$rowsaccess['salesordersdatelist'];
//     $salesordersnolist=$rowsaccess['salesordersnolist'];
//     $salesorderscustomernamelist=$rowsaccess['salesorderscustomernamelist'];
//     $salesorderstermlist=$rowsaccess['salesorderstermlist'];
//     $salesordersamountlist=$rowsaccess['salesordersamountlist'];
//     $salesordersprintlist=$rowsaccess['salesordersprintlist'];
//     $salesordersgeneratequotation=$rowsaccess['salesordersgeneratequotation'];
//     $quotationproformainvoicelist=$rowsaccess['quotationproformainvoicelist'];
//     $quotationgenerateinvoicelist=$rowsaccess['quotationgenerateinvoicelist'];
//     $payreceivedatelist=$rowsaccess['payreceivedatelist'];
//     $payreceivenolist=$rowsaccess['payreceivenolist'];
//     $payreceivecustomernamelist=$rowsaccess['payreceivecustomernamelist'];
//     $payreceivetermlist=$rowsaccess['payreceivetermlist'];
//     $payreceivemodeofpaylist=$rowsaccess['payreceivemodeofpaylist'];
//     $payreceiveamountreceivelist=$rowsaccess['payreceiveamountreceivelist'];
//     $payreceivenoteslist=$rowsaccess['payreceivenoteslist'];
//     $payreceiveeditlist=$rowsaccess['payreceiveeditlist'];
//     $salesreturndatelist=$rowsaccess['salesreturndatelist'];
//     $salesreturnnolist=$rowsaccess['salesreturnnolist'];
//     $salesreturncustomernamelist=$rowsaccess['salesreturncustomernamelist'];
//     $salesreturntermlist=$rowsaccess['salesreturntermlist'];
//     $salesreturnamountlist=$rowsaccess['salesreturnamountlist'];
//     $salesreturnprintlist=$rowsaccess['salesreturnprintlist'];
//     $purorderdatelist=$rowsaccess['purorderdatelist'];
//     $purordernolist=$rowsaccess['purordernolist'];
//     $purordervendornamelist=$rowsaccess['purordervendornamelist'];
//     $purordertermlist=$rowsaccess['purordertermlist'];
//     $purorderamountlist=$rowsaccess['purorderamountlist'];
//     $purordereditlist=$rowsaccess['purordereditlist'];
//     $purorderprintlist=$rowsaccess['purorderprintlist'];
//     $purordergeneratebilllist=$rowsaccess['purordergeneratebilllist'];
//     $billdatelist=$rowsaccess['billdatelist'];
//     $billnolist=$rowsaccess['billnolist'];
//     $billvendornamelist=$rowsaccess['billvendornamelist'];
//     $billtermlist=$rowsaccess['billtermlist'];
//     $billamountlist=$rowsaccess['billamountlist'];
//     $billstatuslist=$rowsaccess['billstatuslist'];
//     $billbalancelist=$rowsaccess['billbalancelist'];
//     $billprintlist=$rowsaccess['billprintlist'];
//     $paymadedatelist=$rowsaccess['paymadedatelist'];
//     $paymadenolist=$rowsaccess['paymadenolist'];
//     $paymadevendornamelist=$rowsaccess['paymadevendornamelist'];
//     $paymadetermlist=$rowsaccess['paymadetermlist'];
//     $paymademodeofpaylist=$rowsaccess['paymademodeofpaylist'];
//     $paymadeamountreceivedlist=$rowsaccess['paymadeamountreceivedlist'];
//     $paymadenoteslist=$rowsaccess['paymadenoteslist'];
//     $paymadeeditlist=$rowsaccess['paymadeeditlist'];
//     $purreturndatelist=$rowsaccess['purreturndatelist'];
//     $purreturnnolist=$rowsaccess['purreturnnolist'];
//     $purreturnvendornamelist=$rowsaccess['purreturnvendornamelist'];
//     $purreturntermlist=$rowsaccess['purreturntermlist'];
//     $purreturnamountlist=$rowsaccess['purreturnamountlist'];
//     $purreturnprintlist=$rowsaccess['purreturnprintlist'];
//-------------------------------------------------
// $permissionsidebooks=$roww['permissionsidebooks'];
function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$password=generateRandomString();
/*starts here */
$mail = new PHPMailer(true); // create a new object
$mail->isSMTP();
$mail->Host = 'localhost';
$mail->SMTPAuth = false;
$mail->SMTPAutoTLS = false; 
$mail->Port = 25; 
$mail->IsHTML(true);
$mail->Username = "tonic@pairscript.com";
$mail->Password = "Rrifidr@tr7";
$mail->setFrom('tonic@pairscript.com', 'Tonic - Pairscript');
$mail->addReplyTo('tonic@pairscript.com', 'Tonic - Pairscript');
/*end here*/

if(isset($_POST['submit']))
{
$firstname=mysqli_real_escape_string($con, $_POST['firstname']);
$lastname=mysqli_real_escape_string($con, $_POST['lastname']);
$dob=mysqli_real_escape_string($con, $_POST['dob']);
$designation=mysqli_real_escape_string($con, $_POST['designation']);
$email=mysqli_real_escape_string($con, $_POST['email']);
$year=date("Y");
$usernewname=mysqli_real_escape_string($con, $_POST['usernewname']);
$mobile=mysqli_real_escape_string($con, $_POST['mobile']);
$saltforpassword = "PAIRSALT";
$password = argon2idHash(mysqli_real_escape_string($con, $_POST['password']), $saltforpassword);
$permissiondashboard='1';
$permissionmyaccount=mysqli_real_escape_string($con, (isset($_POST['permissionmyaccount']))?'1':'0');
$permissioninsightss=mysqli_real_escape_string($con, (isset($_POST['permissioninsights']))?'1':'0');
$permissionnotifications=mysqli_real_escape_string($con, (isset($_POST['permissionnotification']))?'1':'0');
$permissionhelps=mysqli_real_escape_string($con, (isset($_POST['permissionhelp']))?'1':'0');
$permissionfranchises=mysqli_real_escape_string($con,$_POST['permissionfranchise']);
$permissionusers=mysqli_real_escape_string($con,$_POST['permissionuser']);
$permissionpreferences=mysqli_real_escape_string($con,$_POST['permissionpreference']);
$preferencefranchisepermissions=mysqli_real_escape_string($con,$_POST['preferencefranchisepermission']);
$permissionuserrs=mysqli_real_escape_string($con,$_POST['permissionuserr']);
$permissionbookss=mysqli_real_escape_string($con,$_POST['permissionbooks']);
$permissionconfigs=mysqli_real_escape_string($con,$_POST['permissionconfig']);
$languages=mysqli_real_escape_string($con,$_POST['language']);
$time=mysqli_real_escape_string($con,$_POST['time']);
$currencys=mysqli_real_escape_string($con,$_POST['currency']);
$taxess=mysqli_real_escape_string($con,$_POST['taxes']);
$permissionsidesbookss=mysqli_real_escape_string($con,$_POST['permissionsidesbooks']);
// $bproadd=mysqli_real_escape_string($con, (isset($_POST['bproadd']))?'1':'0');
// $bproview=mysqli_real_escape_string($con, (isset($_POST['bproview']))?'1':'0');
// $bprocreate=mysqli_real_escape_string($con, (isset($_POST['bprocreate']))?'1':'0');
// $bproedit=mysqli_real_escape_string($con, (isset($_POST['bproedit']))?'1':'0');
// $bprodelete=mysqli_real_escape_string($con, (isset($_POST['bprodelete']))?'1':'0');
// $bservadd=mysqli_real_escape_string($con, (isset($_POST['bservadd']))?'1':'0');
// $bservview=mysqli_real_escape_string($con, (isset($_POST['bservview']))?'1':'0');
// $bservcreate=mysqli_real_escape_string($con, (isset($_POST['bservcreate']))?'1':'0');
// $bservedit=mysqli_real_escape_string($con, (isset($_POST['bservedit']))?'1':'0');
// $bservdelete=mysqli_real_escape_string($con, (isset($_POST['bservdelete']))?'1':'0');
// $binvadjadd=mysqli_real_escape_string($con, (isset($_POST['binvadjadd']))?'1':'0');
// $binvadjview=mysqli_real_escape_string($con, (isset($_POST['binvadjview']))?'1':'0');
// $binvadjcreate=mysqli_real_escape_string($con, (isset($_POST['binvadjcreate']))?'1':'0');
// $binvadjedit=mysqli_real_escape_string($con, (isset($_POST['binvadjedit']))?'1':'0');
// $binvadjdelete=mysqli_real_escape_string($con, (isset($_POST['binvadjdelete']))?'1':'0');
// $bcusadd=mysqli_real_escape_string($con, (isset($_POST['bcusadd']))?'1':'0');
// $bcusview=mysqli_real_escape_string($con, (isset($_POST['bcusview']))?'1':'0');
// $bcuscreate=mysqli_real_escape_string($con, (isset($_POST['bcuscreate']))?'1':'0');
// $bcusedit=mysqli_real_escape_string($con, (isset($_POST['bcusedit']))?'1':'0');
// $bcusdelete=mysqli_real_escape_string($con, (isset($_POST['bcusdelete']))?'1':'0');
// $benqadd=mysqli_real_escape_string($con, (isset($_POST['benqadd']))?'1':'0');
// $benqview=mysqli_real_escape_string($con, (isset($_POST['benqview']))?'1':'0');
// $benqcreate=mysqli_real_escape_string($con, (isset($_POST['benqcreate']))?'1':'0');
// $benqedit=mysqli_real_escape_string($con, (isset($_POST['benqedit']))?'1':'0');
// $benqdelete=mysqli_real_escape_string($con, (isset($_POST['benqdelete']))?'1':'0');
// $bqtadd=mysqli_real_escape_string($con, (isset($_POST['bqtadd']))?'1':'0');
// $bqtview=mysqli_real_escape_string($con, (isset($_POST['bqtview']))?'1':'0');
// $bqtcreate=mysqli_real_escape_string($con, (isset($_POST['bqtcreate']))?'1':'0');
// $bqtedit=mysqli_real_escape_string($con, (isset($_POST['bqtedit']))?'1':'0');
// $bqtdelete=mysqli_real_escape_string($con, (isset($_POST['bqtdelete']))?'1':'0');
// $besadd=mysqli_real_escape_string($con, (isset($_POST['besadd']))?'1':'0');
// $besview=mysqli_real_escape_string($con, (isset($_POST['besview']))?'1':'0');
// $bescreate=mysqli_real_escape_string($con, (isset($_POST['bescreate']))?'1':'0');
// $besedit=mysqli_real_escape_string($con, (isset($_POST['besedit']))?'1':'0');
// $besdelete=mysqli_real_escape_string($con, (isset($_POST['besdelete']))?'1':'0');
// $bpforminvadd=mysqli_real_escape_string($con, (isset($_POST['bpforminvadd']))?'1':'0');
// $bpforminvview=mysqli_real_escape_string($con, (isset($_POST['bpforminvview']))?'1':'0');
// $bpforminvcreate=mysqli_real_escape_string($con, (isset($_POST['bpforminvcreate']))?'1':'0');
// $bpforminvedit=mysqli_real_escape_string($con, (isset($_POST['bpforminvedit']))?'1':'0');
// $bpforminvdelete=mysqli_real_escape_string($con, (isset($_POST['bpforminvdelete']))?'1':'0');
// $bsaleorderadd=mysqli_real_escape_string($con, (isset($_POST['bsaleorderadd']))?'1':'0');
// $bsaleorderview=mysqli_real_escape_string($con, (isset($_POST['bsaleorderview']))?'1':'0');
// $bsaleordercreate=mysqli_real_escape_string($con, (isset($_POST['bsaleordercreate']))?'1':'0');
// $bsaleorderedit=mysqli_real_escape_string($con, (isset($_POST['bsaleorderedit']))?'1':'0');
// $bsaleorderdelete=mysqli_real_escape_string($con, (isset($_POST['bsaleorderdelete']))?'1':'0');
// $bsaleordersadd=mysqli_real_escape_string($con, (isset($_POST['bsaleordersadd']))?'1':'0');
// $bsaleordersview=mysqli_real_escape_string($con, (isset($_POST['bsaleordersview']))?'1':'0');
// $bsaleorderscreate=mysqli_real_escape_string($con, (isset($_POST['bsaleorderscreate']))?'1':'0');
// $bsaleordersedit=mysqli_real_escape_string($con, (isset($_POST['bsaleordersedit']))?'1':'0');
// $bsaleordersdelete=mysqli_real_escape_string($con, (isset($_POST['bsaleordersdelete']))?'1':'0');
// $bdeliverychallanadd=mysqli_real_escape_string($con, (isset($_POST['bdeliverychallanadd']))?'1':'0');
// $bdeliverychallanview=mysqli_real_escape_string($con, (isset($_POST['bdeliverychallanview']))?'1':'0');
// $bdeliverychallancreate=mysqli_real_escape_string($con, (isset($_POST['bdeliverychallancreate']))?'1':'0');
// $bdeliverychallanedit=mysqli_real_escape_string($con, (isset($_POST['bdeliverychallanedit']))?'1':'0');
// $bdeliverychallandelete=mysqli_real_escape_string($con, (isset($_POST['bdeliverychallandelete']))?'1':'0');
// $bpayreceiveadd=mysqli_real_escape_string($con, (isset($_POST['bpayreceiveadd']))?'1':'0');
// $bpayreceiveview=mysqli_real_escape_string($con, (isset($_POST['bpayreceiveview']))?'1':'0');
// $bpayreceivecreate=mysqli_real_escape_string($con, (isset($_POST['bpayreceivecreate']))?'1':'0');
// $bpayreceiveedit=mysqli_real_escape_string($con, (isset($_POST['bpayreceiveedit']))?'1':'0');
// $bpayreceivedelete=mysqli_real_escape_string($con, (isset($_POST['bpayreceivedelete']))?'1':'0');
// $bsalereturnadd=mysqli_real_escape_string($con, (isset($_POST['bsalereturnadd']))?'1':'0');
// $bsalereturnview=mysqli_real_escape_string($con, (isset($_POST['bsalereturnview']))?'1':'0');
// $bsalereturncreate=mysqli_real_escape_string($con, (isset($_POST['bsalereturncreate']))?'1':'0');
// $bsalereturnedit=mysqli_real_escape_string($con, (isset($_POST['bsalereturnedit']))?'1':'0');
// $bsalereturndelete=mysqli_real_escape_string($con, (isset($_POST['bsalereturndelete']))?'1':'0');
// $bvendoradd=mysqli_real_escape_string($con, (isset($_POST['bvendoradd']))?'1':'0');
// $bvendorview=mysqli_real_escape_string($con, (isset($_POST['bvendorview']))?'1':'0');
// $bvendorcreate=mysqli_real_escape_string($con, (isset($_POST['bvendorcreate']))?'1':'0');
// $bvendoredit=mysqli_real_escape_string($con, (isset($_POST['bvendoredit']))?'1':'0');
// $bvendordelete=mysqli_real_escape_string($con, (isset($_POST['bvendordelete']))?'1':'0');
// $bpurorderadd=mysqli_real_escape_string($con, (isset($_POST['bpurorderadd']))?'1':'0');
// $bpurorderview=mysqli_real_escape_string($con, (isset($_POST['bpurorderview']))?'1':'0');
// $bpurordercreate=mysqli_real_escape_string($con, (isset($_POST['bpurordercreate']))?'1':'0');
// $bpurorderedit=mysqli_real_escape_string($con, (isset($_POST['bpurorderedit']))?'1':'0');
// $bpurorderdelete=mysqli_real_escape_string($con, (isset($_POST['bpurorderdelete']))?'1':'0');
// $bpurreceiveadd=mysqli_real_escape_string($con, (isset($_POST['bpurreceiveadd']))?'1':'0');
// $bpurreceiveview=mysqli_real_escape_string($con, (isset($_POST['bpurreceiveview']))?'1':'0');
// $bpurreceivecreate=mysqli_real_escape_string($con, (isset($_POST['bpurreceivecreate']))?'1':'0');
// $bpurreceiveedit=mysqli_real_escape_string($con, (isset($_POST['bpurreceiveedit']))?'1':'0');
// $bpurreceivedelete=mysqli_real_escape_string($con, (isset($_POST['bpurreceivedelete']))?'1':'0');
// $bbilladd=mysqli_real_escape_string($con, (isset($_POST['bbilladd']))?'1':'0');
// $bbillview=mysqli_real_escape_string($con, (isset($_POST['bbillview']))?'1':'0');
// $bbillcreate=mysqli_real_escape_string($con, (isset($_POST['bbillcreate']))?'1':'0');
// $bbilledit=mysqli_real_escape_string($con, (isset($_POST['bbilledit']))?'1':'0');
// $bbilldelete=mysqli_real_escape_string($con, (isset($_POST['bbilldelete']))?'1':'0');
// $bpaymadeadd=mysqli_real_escape_string($con, (isset($_POST['bpaymadeadd']))?'1':'0');
// $bpaymadeview=mysqli_real_escape_string($con, (isset($_POST['bpaymadeview']))?'1':'0');
// $bpaymadecreate=mysqli_real_escape_string($con, (isset($_POST['bpaymadecreate']))?'1':'0');
// $bpaymadeedit=mysqli_real_escape_string($con, (isset($_POST['bpaymadeedit']))?'1':'0');
// $bpaymadedelete=mysqli_real_escape_string($con, (isset($_POST['bpaymadedelete']))?'1':'0');
// $bpurreturnadd=mysqli_real_escape_string($con, (isset($_POST['bpurreturnadd']))?'1':'0');
// $bpurreturnview=mysqli_real_escape_string($con, (isset($_POST['bpurreturnview']))?'1':'0');
// $bpurreturncreate=mysqli_real_escape_string($con, (isset($_POST['bpurreturncreate']))?'1':'0');
// $bpurreturnedit=mysqli_real_escape_string($con, (isset($_POST['bpurreturnedit']))?'1':'0');
// $bpurreturndelete=mysqli_real_escape_string($con, (isset($_POST['bpurreturndelete']))?'1':'0');
// $bbankadd=mysqli_real_escape_string($con, (isset($_POST['bbankadd']))?'1':'0');
// $bbankview=mysqli_real_escape_string($con, (isset($_POST['bbankview']))?'1':'0');
// $bbankcreate=mysqli_real_escape_string($con, (isset($_POST['bbankcreate']))?'1':'0');
// $bbankedit=mysqli_real_escape_string($con, (isset($_POST['bbankedit']))?'1':'0');
// $bbankdelete=mysqli_real_escape_string($con, (isset($_POST['bbankdelete']))?'1':'0');
// $bexpadd=mysqli_real_escape_string($con, (isset($_POST['bexpadd']))?'1':'0');
// $bexpview=mysqli_real_escape_string($con, (isset($_POST['bexpview']))?'1':'0');
// $bexpcreate=mysqli_real_escape_string($con, (isset($_POST['bexpcreate']))?'1':'0');
// $bexpedit=mysqli_real_escape_string($con, (isset($_POST['bexpedit']))?'1':'0');
// $bexpdelete=mysqli_real_escape_string($con, (isset($_POST['bexpdelete']))?'1':'0');
// $bmanualjournalsadd=mysqli_real_escape_string($con, (isset($_POST['bmanualjournalsadd']))?'1':'0');
// $bmanualjournalsview=mysqli_real_escape_string($con, (isset($_POST['bmanualjournalsview']))?'1':'0');
// $bmanualjournalscreate=mysqli_real_escape_string($con, (isset($_POST['bmanualjournalscreate']))?'1':'0');
// $bmanualjournalsedit=mysqli_real_escape_string($con, (isset($_POST['bmanualjournalsedit']))?'1':'0');
// $bmanualjournalsdelete=mysqli_real_escape_string($con, (isset($_POST['bmanualjournalsdelete']))?'1':'0');
// $bchartaccountadd=mysqli_real_escape_string($con, (isset($_POST['bchartaccountadd']))?'1':'0');
// $bchartaccountview=mysqli_real_escape_string($con, (isset($_POST['bchartaccountview']))?'1':'0');
// $bchartaccountcreate=mysqli_real_escape_string($con, (isset($_POST['bchartaccountcreate']))?'1':'0');
// $bchartaccountedit=mysqli_real_escape_string($con, (isset($_POST['bchartaccountedit']))?'1':'0');
// $bchartaccountdelete=mysqli_real_escape_string($con, (isset($_POST['bchartaccountdelete']))?'1':'0');
// $bprojectsadd=mysqli_real_escape_string($con, (isset($_POST['bprojectsadd']))?'1':'0');
// $bprojectsview=mysqli_real_escape_string($con, (isset($_POST['bprojectsview']))?'1':'0');
// $bprojectscreate=mysqli_real_escape_string($con, (isset($_POST['bprojectscreate']))?'1':'0');
// $bprojectsedit=mysqli_real_escape_string($con, (isset($_POST['bprojectsedit']))?'1':'0');
// $bprojectsdelete=mysqli_real_escape_string($con, (isset($_POST['bprojectsdelete']))?'1':'0');
// $btimesheetadd=mysqli_real_escape_string($con, (isset($_POST['btimesheetadd']))?'1':'0');
// $btimesheetview=mysqli_real_escape_string($con, (isset($_POST['btimesheetview']))?'1':'0');
// $btimesheetcreate=mysqli_real_escape_string($con, (isset($_POST['btimesheetcreate']))?'1':'0');
// $btimesheetedit=mysqli_real_escape_string($con, (isset($_POST['btimesheetedit']))?'1':'0');
// $btimesheetdelete=mysqli_real_escape_string($con, (isset($_POST['btimesheetdelete']))?'1':'0');
// $bewaybillsadd=mysqli_real_escape_string($con, (isset($_POST['bewaybillsadd']))?'1':'0');
// $bewaybillsview=mysqli_real_escape_string($con, (isset($_POST['bewaybillsview']))?'1':'0');
// $bewaybillscreate=mysqli_real_escape_string($con, (isset($_POST['bewaybillscreate']))?'1':'0');
// $bewaybillsedit=mysqli_real_escape_string($con, (isset($_POST['bewaybillsedit']))?'1':'0');
// $bewaybillsdelete=mysqli_real_escape_string($con, (isset($_POST['bewaybillsdelete']))?'1':'0');
// $bgstfillingadd=mysqli_real_escape_string($con, (isset($_POST['bgstfillingadd']))?'1':'0');
// $bgstfillingview=mysqli_real_escape_string($con, (isset($_POST['bgstfillingview']))?'1':'0');
// $bgstfillingcreate=mysqli_real_escape_string($con, (isset($_POST['bgstfillingcreate']))?'1':'0');
// $bgstfillingedit=mysqli_real_escape_string($con, (isset($_POST['bgstfillingedit']))?'1':'0');
// $bgstfillingdelete=mysqli_real_escape_string($con, (isset($_POST['bgstfillingdelete']))?'1':'0');
// $bpayrolladd=mysqli_real_escape_string($con, (isset($_POST['bpayrolladd']))?'1':'0');
// $bpayrollview=mysqli_real_escape_string($con, (isset($_POST['bpayrollview']))?'1':'0');
// $bpayrollcreate=mysqli_real_escape_string($con, (isset($_POST['bpayrollcreate']))?'1':'0');
// $bpayrolledit=mysqli_real_escape_string($con, (isset($_POST['bpayrolledit']))?'1':'0');
// $bpayrolldelete=mysqli_real_escape_string($con, (isset($_POST['bpayrolldelete']))?'1':'0');
// $battendenceadd=mysqli_real_escape_string($con, (isset($_POST['battendenceadd']))?'1':'0');
// $battendenceview=mysqli_real_escape_string($con, (isset($_POST['battendenceview']))?'1':'0');
// $battendencecreate=mysqli_real_escape_string($con, (isset($_POST['battendencecreate']))?'1':'0');
// $battendenceedit=mysqli_real_escape_string($con, (isset($_POST['battendenceedit']))?'1':'0');
// $battendencedelete=mysqli_real_escape_string($con, (isset($_POST['battendencedelete']))?'1':'0');
// $breportadd=mysqli_real_escape_string($con, (isset($_POST['breportadd']))?'1':'0');
// $breportview=mysqli_real_escape_string($con, (isset($_POST['breportview']))?'1':'0');
// $breportcreate=mysqli_real_escape_string($con, (isset($_POST['breportcreate']))?'1':'0');
// $breportedit=mysqli_real_escape_string($con, (isset($_POST['breportedit']))?'1':'0');
// $breportdelete=mysqli_real_escape_string($con, (isset($_POST['breportdelete']))?'1':'0');
// $binvadd=mysqli_real_escape_string($con, (isset($_POST['binvadd']))?'1':'0');
// $binvview=mysqli_real_escape_string($con, (isset($_POST['binvview']))?'1':'0');
// $binvcreate=mysqli_real_escape_string($con, (isset($_POST['binvcreate']))?'1':'0');
// $binvedit=mysqli_real_escape_string($con, (isset($_POST['binvedit']))?'1':'0');
// $binvdelete=mysqli_real_escape_string($con, (isset($_POST['binvdelete']))?'1':'0');
//,bproadd='$bproadd',bproview='$bproview',bprocreate='$bprocreate',bproedit='$bproedit',bprodelete='$bprodelete',bservadd='$bservadd',bservview='$bservview',bservcreate='$bservcreate',bservedit='$bservedit',bservdelete='$bservdelete',binvadjustadd='$binvadjadd',binvadjustview='$binvadjview',binvadjustcreate='$binvadjcreate',binvadjustedit='$binvadjedit',binvadjustdelete='$binvadjdelete',bcusadd='$bcusadd',bcusview='$bcusview',bcuscreate='$bcuscreate',bcusedit='$bcusedit',bcusdelete='$bcusdelete',bqtadd='$bqtadd',bqtview='$bqtview',bqtcreate='$bqtcreate',bqtedit='$bqtedit',bqtdelete='$bqtdelete',besadd='$besadd',besview='$besview',bescreate='$bescreate',besedit='$besedit',besdelete='$besdelete',bpforminvadd='$bpforminvadd',bpforminvview='$bpforminvview',bpforminvcreate='$bpforminvcreate',bpforminvedit='$bpforminvedit',bpforminvdelete='$bpforminvdelete',bsaleorderadd='$bsaleorderadd',bsaleorderview='$bsaleorderview',bsaleordercreate='$bsaleordercreate',bsaleorderedit='$bsaleorderedit',bsaleorderdelete='$bsaleorderdelete',bsaleordersadd='$bsaleordersadd',bsaleordersview='$bsaleordersview',bsaleorderscreate='$bsaleorderscreate',bsaleordersedit='$bsaleordersedit',bsaleordersdelete='$bsaleordersdelete',bdeliverychallanadd='$bdeliverychallanadd',bdeliverychallanview='$bdeliverychallanview',bdeliverychallancreate='$bdeliverychallancreate',bdeliverychallanedit='$bdeliverychallanedit',bdeliverychallandelete='$bdeliverychallandelete',bpayreceiveadd='$bpayreceiveadd',bpayreceiveview='$bpayreceiveview',bpayreceivecreate='$bpayreceivecreate',bpayreceiveedit='$bpayreceiveedit',bpayreceivedelete='$bpayreceivedelete',bsalereturnadd='$bsalereturnadd',bsalereturnview='$bsalereturnview',bsalereturncreate='$bsalereturncreate',bsalereturnedit='$bsalereturnedit',bsalereturndelete='$bsalereturndelete',bvendoradd='$bvendoradd',bvendorview='$bvendorview',bvendorcreate='$bvendorcreate',bvendoredit='$bvendoredit',bvendordelete='$bvendordelete',bpurorderadd='$bpurorderadd',bpurorderview='$bpurorderview',bpurordercreate='$bpurordercreate',bpurorderedit='$bpurorderedit',bpurorderdelete='$bpurorderdelete',bpurreceiveadd='$bpurreceiveadd',bpurreceiveview='$bpurreceiveview',bpurreceivecreate='$bpurreceivecreate',bpurreceiveedit='$bpurreceiveedit',bpurreceivedelete='$bpurreceivedelete',bbilladd='$bbilladd',bbillview='$bbillview',bbillcreate='$bbillcreate',bbilledit='$bbilledit',bbilldelete='$bbilldelete',bpaymadeadd='$bpaymadeadd',bpaymadeview='$bpaymadeview',bpaymadecreate='$bpaymadecreate',bpaymadeedit='$bpaymadeedit',bpaymadedelete='$bpaymadedelete',bpurreturnadd='$bpurreturnadd',bpurreturnview='$bpurreturnview',bpurreturncreate='$bpurreturncreate',bpurreturnedit='$bpurreturnedit',bpurreturndelete='$bpurreturndelete',bbankadd='$bbankadd',bbankview='$bbankview',bbankcreate='$bbankcreate',bbankedit='$bbankedit',bbankdelete='$bbankdelete',bexpadd='$bexpadd',bexpview='$bexpview',bexpcreate='$bexpcreate',bexpedit='$bexpedit',bexpdelete='$bexpdelete',bmanualjournalsadd='$bmanualjournalsadd',bmanualjournalsview='$bmanualjournalsview',bmanualjournalscreate='$bmanualjournalscreate',bmanualjournalsedit='$bmanualjournalsedit',bmanualjournalsdelete='$bmanualjournalsdelete',bchartaccountadd='$bchartaccountadd',bchartaccountview='$bchartaccountview',bchartaccountcreate='$bchartaccountcreate',bchartaccountedit='$bchartaccountedit',bchartaccountdelete='$bchartaccountdelete',bprojectsadd='$bprojectsadd',bprojectsview='$bprojectsview',bprojectscreate='$bprojectscreate',bprojectsedit='$bprojectsedit',bprojectsdelete='$bprojectsdelete',btimesheetadd='$btimesheetadd',btimesheetview='$btimesheetview',btimesheetcreate='$btimesheetcreate',btimesheetedit='$btimesheetedit',btimesheetdelete='$btimesheetdelete',bewaybillsadd='$bewaybillsadd',bewaybillsview='$bewaybillsview',bewaybillscreate='$bewaybillscreate',bewaybillsedit='$bewaybillsedit',bewaybillsdelete='$bewaybillsdelete',bgstfillingadd='$bgstfillingadd',bgstfillingview='$bgstfillingview',bgstfillingcreate='$bgstfillingcreate',bgstfillingedit='$bgstfillingedit',bgstfillingdelete='$bgstfillingdelete',bpayrolladd='$bpayrolladd',bpayrollview='$bpayrollview',bpayrollcreate='$bpayrollcreate',bpayrolledit='$bpayrolledit',bpayrolldelete='$bpayrolldelete',battendenceadd='$battendenceadd',battendenceview='$battendenceview',battendencecreate='$battendencecreate',battendenceedit='$battendenceedit',battendencedelete='$battendencedelete',breportadd='$breportadd',breportview='$breportview',breportcreate='$breportcreate',breportedit='$breportedit',breportdelete='$breportdelete',binvadd='$binvadd',binvview='$binvview',binvcreate='$binvcreate',binvedit='$binvedit',binvdelete='$binvdelete',benqadd='$benqadd',benqview='$benqview',benqcreate='$benqcreate',benqedit='$benqedit',benqdelete='$benqdelete'

$franchises='';
if((isset($_POST['franchises']))&&(!empty($_POST['franchises'])))
{
	foreach($_POST['franchises'] as $fr)
	{
		if($franchises!='')
		{
			if($fr!='')
			{
			$franchises.=','.$fr;
			}
		}
		else
		{
			if($fr!='')
			{
			$franchises=$fr;
			}
		}	
	}	
}
if($usernewname=='')
{
	$ema=explode('@',$email);
	if(isset($ema[0]))
	{
	$usernewname=strtolower($ema[0]);
	}
}
$msg = "";
$msg_class = "";
	if(($firstname!="")&&($email!=""))
	{		
        $sqlcon = "SELECT id From paircontrols WHERE email = '{$email}' or usernewname='{$usernewname}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon == 0) 
		{	
			$profileimages=array();
  // Configure upload directory and allowed file types
    $upload_dir = 'ups/profile/';
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
     
    // Define maxsize for files i.e 2MB
    $maxsize = 2 * 1024 * 1024;

    // Checks if user sent an empty form
    if(!empty(array_filter($_FILES['profileimage']['name']))) {

        foreach ($_FILES['profileimage']['tmp_name'] as $key => $value) {
               
            $file_tmpname = $_FILES['profileimage']['tmp_name'][$key];
            $file_name = $_FILES['profileimage']['name'][$key];
            $file_size = $_FILES['profileimage']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $filepath = $upload_dir.$file_name;
            if(in_array(strtolower($file_ext), $allowed_types)) {
 
                if ($file_size > $maxsize)        
                    header("Location: users.php?error=File size is larger than the allowed limit");
 
                if(file_exists($filepath)) {
                    $filepath = $upload_dir.time().$file_name;
                     
                    if( move_uploaded_file($file_tmpname, $filepath)) {
						$profileimages[]=$filepath;
                       // echo "{$file_name} successfully uploaded <br />";
                    }
                    else {                    
                        //echo "Error uploading {$file_name} <br />";
                    }
                }
                else {
                 
                    if( move_uploaded_file($file_tmpname, $filepath)) {
						$profileimages[]=$filepath;
                        //echo "{$file_name} successfully uploaded <br />";
                    }
                    else {                    
                        //echo "Error uploading {$file_name} <br />";
                    }
                }
				
            }
            else {
                 
                // If file extension not valid
               // echo "Error uploading {$file_name} ";
              //  echo "({$file_ext} file type is not allowed)<br / >";
            }
        }
    }
    else {
         
    
    }

if(!empty($profileimages))
{
	$profileimage=implode(",",$profileimages);
}
else
{
	$profileimage='';
}
$csql=mysqli_query($con,"select id from paricountry");
    while($cresult=mysqli_fetch_assoc($csql)) {
        $coid=$cresult['id'];
    }
 $sqlc=mysqli_query($con,"select id from paircurrency");
    while($resultc=mysqli_fetch_assoc($sqlc)){
        $cuid=$resultc['id'];
    }
$lsql=mysqli_query($con,"select id from parilanguage");
   while($lresult=mysqli_fetch_assoc($lsql)){
        $laid=$lresult['id'];
    }
			$sqlup = "insert into paircontrols set createdon='$times', createdid='$companymainid', role='USER', createdby='".$_SESSION["unqwerty"]."', username='$email', usernewname='$usernewname', email='$email', firstname='$firstname', lastname='$lastname', dob='$dob', profileimage='$profileimage', designation='$designation', mobile='$mobile',permissionsidebooks='$permissionsidesbookss', permissiondashboard='$permissiondashboard',permissioninsights='$permissioninsightss',permissionnotification='$permissionnotifications',permissionhelp='$permissionhelps', permissionmyaccount='$permissionmyaccount', permissionfranchise='$permissionfranchises',permissionuser='$permissionusers',permissionpreference='$permissionpreferences',preferencefranchisepermission='$preferencefranchisepermissions',permissionuserr='$permissionuserrs',permissionbooks='$permissionbookss',permissionconfig='$permissionconfigs', language='$languages',time='$time',currency='$currencys',taxes='$taxess',franchises='$franchises',franchiseandroles='$oldfranchiseandroles',userandroles='$olduserandroles',books='$oldbooks', password='$password',languages='".$laid."',currencies='".$cuid."',countries='".$coid."'";
			$queryup = mysqli_query($con, $sqlup);

            $userid=mysqli_insert_id($con);

            $sqlisaccess=mysqli_query($con, "select * from pairmodules order by id asc");
            while($infosaccess=mysqli_fetch_array($sqlisaccess))
            {
                $coltype = preg_replace('/\s+/', '', $infosaccess['moduletype']);
                $colgtype = preg_replace('/\s+/', '', $infosaccess['grouptype']);
                $grouptypeans=$infosaccess['grouptype'];
                $maingrouptype=$infosaccess['grouptype'];
                $moduletypeans=$infosaccess['moduletype'];
                if ($infosaccess['moduletype']!='') {
                $groupaccesscol="group".strtolower($coltype);
                $groupaccess=mysqli_real_escape_string($con, $_POST[$groupaccesscol]);
                $grouptypecol="grouptype".strtolower($coltype);
                $grouptype=mysqli_real_escape_string($con, $_POST[$grouptypecol]);
                $moduleaccesscol="module".strtolower($coltype);
                $moduleaccess=mysqli_real_escape_string($con, $_POST[$moduleaccesscol]);
                $moduletypecol="moduletype".strtolower($coltype);
                $moduletype=mysqli_real_escape_string($con, $_POST[$moduletypecol]);
                $useraccessviewcol="useraccessview".strtolower($coltype);
                $useraccessview=mysqli_real_escape_string($con, (isset($_POST[$useraccessviewcol]))?'1':'0');
                $useraccesscreatecol="useraccesscreate".strtolower($coltype);
                $useraccesscreate=mysqli_real_escape_string($con, (isset($_POST[$useraccesscreatecol]))?'1':'0');
                $useraccesseditcol="useraccessedit".strtolower($coltype);
                $useraccessedit=mysqli_real_escape_string($con, (isset($_POST[$useraccesseditcol]))?'1':'0');
                $useraccessdeletecol="useraccessdelete".strtolower($coltype);
                $useraccessdelete=mysqli_real_escape_string($con, (isset($_POST[$useraccessdeletecol]))?'1':'0');
                $modulefieldscoladd="modulefieldsadd".strtolower($coltype);
                $modulefieldsadd=mysqli_real_escape_string($con, $_POST[$modulefieldscoladd]);
                $modulefieldscoledit="modulefieldsedit".strtolower($coltype);
                $modulefieldsedit=mysqli_real_escape_string($con, $_POST[$modulefieldscoledit]);
                $modulefieldscolview="modulefieldsview".strtolower($coltype);
                $modulefieldsview=mysqli_real_escape_string($con, $_POST[$modulefieldscolview]);
                $modulecolumnscol="modulecolumns".strtolower($coltype);
                $modulecolumns=mysqli_real_escape_string($con, $_POST[$modulecolumnscol]);
                $sqlmainaccess = "insert into pairmainaccess set createdon='$times',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',grouptype='$grouptypeans',groupname='$grouptype',groupaccess='$groupaccess',moduletype='$moduletypeans',userid='$userid',modulename='$moduletype',moduleaccess='$moduleaccess',useraccessview='$useraccessview',useraccesscreate='$useraccesscreate',useraccessedit='$useraccessedit',useraccessdelete='$useraccessdelete',modulefieldcreate='$modulefieldsadd',modulefieldedit='$modulefieldsedit',modulefieldview='$modulefieldsview',modulecolumns='$modulecolumns'"; 
                $sqlmainaccessup = mysqli_query($con, $sqlmainaccess);
            }
            else{
                $sqlismainaccess=mysqli_query($con, "select distinct modulename,moduleaccess,moduletype,groupaccess,groupname,modulefieldcreate,modulefieldedit,modulefieldview,modulecolumns from pairmainaccess where (userid='$companymainid' and createdid='0') and (grouptype='$maingrouptype' and moduletype='') order by id  asc");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
                $modulefieldsadd=$infomainaccess['modulefieldcreate'];
                $modulefieldsedit=$infomainaccess['modulefieldedit'];
                $modulefieldsview=$infomainaccess['modulefieldview'];
                $modulecolumns=$infomainaccess['modulecolumns'];
                $groupaccess=$infomainaccess['groupaccess'];
                $grouptype=$infomainaccess['groupname'];
                $moduleaccess=$infomainaccess['moduleaccess'];
                $moduletype=$infomainaccess['modulename'];
            }
                $useraccessviewcol="useraccessview".strtolower($colgtype);
                $useraccessview=mysqli_real_escape_string($con, (isset($_POST[$useraccessviewcol]))?'1':'0');
                $useraccesscreatecol="useraccesscreate".strtolower($colgtype);
                $useraccesscreate=mysqli_real_escape_string($con, (isset($_POST[$useraccesscreatecol]))?'1':'0');
                $useraccesseditcol="useraccessedit".strtolower($colgtype);
                $useraccessedit=mysqli_real_escape_string($con, (isset($_POST[$useraccesseditcol]))?'1':'0');
                $useraccessdeletecol="useraccessdelete".strtolower($colgtype);
                $useraccessdelete=mysqli_real_escape_string($con, (isset($_POST[$useraccessdeletecol]))?'1':'0');
                $sqlmainaccess = "insert into pairmainaccess set createdon='$times',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',grouptype='$grouptypeans',groupname='$grouptype',groupaccess='$groupaccess',moduletype='$moduletypeans',userid='$userid',modulename='$moduletype',moduleaccess='$moduleaccess',useraccessview='$useraccessview',useraccesscreate='$useraccesscreate',useraccessedit='$useraccessedit',useraccessdelete='$useraccessdelete',modulefieldcreate='$modulefieldsadd',modulefieldedit='$modulefieldsedit',modulefieldview='$modulefieldsview',modulecolumns='$modulecolumns'"; 
                $sqlmainaccessup = mysqli_query($con, $sqlmainaccess);
            }
                // $sqlmainaccess = "insert into pairmainaccess set createdon='$times',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',grouptype='$grouptypeans',groupname='$grouptype',groupaccess='$groupaccess',moduletype='$moduletypeans',userid='$userid',modulename='$moduletype',moduleaccess='$moduleaccess',useraccessview='$useraccessview',useraccesscreate='$useraccesscreate',useraccessedit='$useraccessedit',useraccessdelete='$useraccessdelete',modulefieldcreate='$modulefieldsadd',modulefieldedit='$modulefieldsedit',modulefieldview='$modulefieldsview',modulecolumns='$modulecolumns'"; 
                // $sqlmainaccessup = mysqli_query($con, $sqlmainaccess);
            }

			$sqlismainaccessdefval = mysqli_query($con, "SELECT * FROM pairmainaccess WHERE userid='$companymainid' ORDER BY id ASC");

while ($infomainaccessdefval = mysqli_fetch_assoc($sqlismainaccessdefval)) {
    $pairmains = array();
    
    foreach ($infomainaccessdefval as $column => $value) {
        if ($column != "id" && $column != "createdon" && $column != "createdid" && $column != "createdby" && $column != "grouptype" && $column != "groupname" && $column != "groupaccess" && $column != "moduletype" && $column != "userid" && $column != "modulename" && $column != "moduleaccess" && $column != "useraccessview" && $column != "useraccesscreate" && $column != "useraccessedit" && $column != "useraccessdelete" && $column != "modulefieldcreate" && $column != "modulefieldedit" && $column != "modulefieldview" && $column != "modulecolumns") {
            $pairmains[] = "$column = '$value'";
        }
    }
    
    $set_clause = implode(", ", $pairmains);
    $update_query = mysqli_query($con, "UPDATE pairmainaccess SET $set_clause WHERE userid='".$userid."' AND moduletype='".$infomainaccessdefval['moduletype']."'");
 }
 $sqlaccess = "insert into pairaccess set createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',username='$email'"; 
            $sqlaccessup = mysqli_query($con, $sqlaccess);
$sqlisaccessreport=mysqli_query($con, "select distinct types,rowcolumns from pairreports where createdid='$companymainid' order by id  asc");
while($infosaccessreport=mysqli_fetch_array($sqlisaccessreport))
{
$types=$infosaccessreport['types'];
$typefields=$infosaccessreport['rowcolumns'];
$sqlreport = mysqli_query($con,"insert into pairreports set createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',username='".$_SESSION["unqwerty"]."',types='$types',rowcolumns='$typefields',rowcolumnsorder='$typefields'");
}
$sqlfavsreport=mysqli_query($con, "select distinct reportnames,reporturlname,reporturlname,reportoriginals,reportfunctions,reporturl,reporthref from pairreportfavourites order by id  asc");
while($infofavreport=mysqli_fetch_array($sqlfavsreport))
{
$sqlfavreport = "insert into pairreportfavourites set createdid='$companymainid',reportnames='".mysqli_real_escape_string($con,$infofavreport['reportnames'])."',reporturlname='".mysqli_real_escape_string($con,$infofavreport['reporturlname'])."',reportoriginals='".mysqli_real_escape_string($con,$infofavreport['reportoriginals'])."',reportfunctions='".mysqli_real_escape_string($con,$infofavreport['reportfunctions'])."',reporturl='".mysqli_real_escape_string($con,$infofavreport['reporturl'])."',reporthref='".mysqli_real_escape_string($con,$infofavreport['reporthref'])."'";  
$sqlfavupreport = mysqli_query($con, $sqlfavreport);
}
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
			else
			{
				// $id=mysqli_insert_id($con);
				$sqluse=mysqli_query($con, "insert into pairusehistory set usetype='USER', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$userid', useremarks='USER CREATED' ");
				mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Update their Profile', '{$userid}')");
				
				if($email!='')
				{					
					$mail->addAddress($email, $firstname);
                    $mail->Subject = 'Tonic - Pairscript Welcomes You';
                    $mail->msgHTML('<div style="margin:0;padding:0" bgcolor="#E4E6F3">
   <table width="100%" height="100%" style="min-width:348px; background-color:#E4E6F3" border="0" cellspacing="0" cellpadding="0" lang="en">
      <tbody>
         <tr height="32" style="height:32px">
            <td></td>
         </tr>
         <tr align="center">
            <td>
               <div>
                  <div></div>
               </div>
               <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px; ">
                  <tbody>
                     <tr>
                        <td width="8" style="width:8px"></td>
                        <td>
                           <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:20px 20px;background-color:#ffffff" align="center" class="m_37516624310573855mdv2rw">
                             <div style="margin-top: -30px;">
                             <img src="https://tonic.pairscript.com/assets/img/loginlogo.png" width="200" aria-hidden="true" style="margin-bottom:16px;margin-top:11px;" alt="Tonic" class="CToWUd">
                              
                              
                               <div style="font-family:\'Google Sans\',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:5px;text-align:center;word-break:break-word;margin-top:-15px;">
                         
                              </div>
                              </div>
                              
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:left">
                                 Hi '.$firstname.' '.$lastname.',
                                 </div>
                              
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                 Welcome to Tonic - Pairscript, Your account has been created Successfully.
                                 
                                  <div style="padding-top:32px;">   
                               
                               <a href="https://tonic.pairscript.com" dir="ltr" style="text-align:center;display:inline-block" target="_blank" data-saferedirecturl="https://tonic.pairscript.com">
<table role="presentation" cellspacing="0" cellpadding="0" align="center">
    <tbody><tr style="padding:0;margin:0;font-size:0;line-height:0"><td style="border-top:4px;border-top-left-radius:4px;border-top-right-radius:4px;display:inline-block;text-align:center"></td></tr>
        <tr><td style="background-color:#1a73e8;border:1px solid #1a73e8;border-radius:4px;color:#ffffff;display:inline-block;font-family:Google Sans,Roboto,Arial;font-size:13px;line-height:25px;text-decoration:none;padding:7px 24px 7px 24px;font-weight:500;text-align:center;word-break:normal;direction:ltr;min-width:159px">
Login
</td></tr>
    <tr style="padding:0;margin:0;font-size:0;line-height:0"><td style="border-top:3px;display:inline-block;border-bottom-left-radius:4px;border-bottom-right-radius:4px;text-align:center"></td></tr>
</tbody></table></a>
                               
                               
                             </div>
                              </div>
                              
                              
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                 <b>Need Help?</b>
                                 <p>
                                 Our support team is here to assist you!
                                 </p>
                                 <p>
                                 <a href="https://tonic.pairscript.com" targe="_blank" syle="text-decoration:none">Contact Us</a>
                                 </p>
                                 </div>
                              
                              
                              
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;padding-top:20px;font-size:12px;line-height:16px;color:#5f6368;letter-spacing:0.3px;text-align:center">
                              
                              <p>Replies to this email aren\'t monitored. If you have a question about your new account, the <a style="color:rgba(0,0,0,0.87);text-decoration:inherit">Help Center</a> likely has the answer you\'re looking for</p>
                              <p>&copy; '.$year.' Pairscript. All Rights Reserved<br>Pairscript is a registered trademark of pairscript.com</p>
                              <p style="font-size:10px;">Pairscript<br>
                              India</p>
                              
                              
                              </div>
                              <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;padding-top:20px;font-size:9px;line-height:16px;color:#5f6368;letter-spacing:0.3px;text-align:center">
                              
                              <p>This email was sent to <a style="color:rgba(0,0,0,0.87);text-decoration:inherit" href="mailto:'.$email.'">'.$email.'</a> because you enter this email to create an account with Pairscript. If you think this is SPAM or do not wish to receive pairscript.com emails in future, Contact Us or Unsubscribe.</p>
                              
                              </div>
                           </div>
                        </td>
                        <td width="8" style="width:8px"></td>
                     </tr>
                  </tbody>
               </table>
            </td>
         </tr>
         <tr height="32" style="height:32px">
            <td></td>
         </tr>
      </tbody>
   </table>
</div>');

					if (!$mail->send()) {
					header("Location: users.php?error=".$mail->ErrorInfo);
						//echo 'Mailer Error: ' . $mail->ErrorInfo;
					} else {
					header("Location: users.php?remarks=Updated Successfully");
						//echo 'Message sent!';
					}
				}
				
				//
			} 
	    }
		else
			{
				header("Location: users.php?error=This record is Already Found! Kindly check in All Users List");
			}
	}
	else
			{
				header("Location: users.php?error=Required fields are Mandatory");
			}
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
    New <?= $row['userandroles'] ?>
  </title>

</head>

<body class="g-sidenav-show" style="background-color:#F1F2F6">
  <?php
  // sidebar
  include('sidebar.php');
  ?>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
         <style type="text/css">
    .dropdown:not(.dropdown-hover) .dropdown-menu{
        margin-top: 8px !important;
    }
</style>
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
     
	  <div style="max-width: 1650px;">
		 <div class="row min-height-480">
        <div class="col-12">
          <div class="card mb-4 mt-5">
             <div class="card-body p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;z-index: 0;">

 <p class="mb-3" style="font-size:20px;"><i class="fa fa-file-import"></i> New <?= $row['userandroles'];?></p>
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">


<div class="accordion" id="accordionRental">
          <div class="accordion-item mb-1">
            <p class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading" style="font-size: 18px;"><?= $row['userandroles'];?> Details</a>	
             
				</div> 
                
              </button>
            </p>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"  style="">
              <div class="accordion-body text-sm">
	
	
	<div class="row">
<div class="col-lg-12">
<div class="row justify-content-center">
    <div class="col-lg-4 ml-2">
     
<div class="profile-pic text-center">
           


	    <img alt="User Pic" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="profile-image1" height="200">

                        
						<input id="profile-image-upload" type="file" style="display:none" class="form-control  form-control-sm" id="profileimage" name="profileimage[]" accept="image/*" onchange="previewFile()" >
	                    <div style="color:#4285F4; cursor:pointer"  id="profile-image2"> Upload Photo </div><br>
                        
                </div>
</div>
</div>
<br>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="firstname" class="custom-label"><span class="text-danger">First Name *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="firstname" name="firstname" placeholder="First Name" required>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="lastname" class="custom-label">Last Name</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="lastname" name="lastname" placeholder="Last Name">
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="dob" class="custom-label">D.O.B</label>
            </div>
            <div class="col-sm-8">
              <input type="date" class="form-control  form-control-sm" id="dob" name="dob" placeholder="D.O.B" style="width:100% !important">
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="designation" class="custom-label">Designation</label>
            </div>
            <div class="col-sm-8">
             <input type="text" class="form-control  form-control-sm" id="designation" name="designation" placeholder="Designation">
            </div>
          </div>
    </div>
</div>
<input type="hidden" id="oldemail" name="oldemail" value="<?=$info['username']?>">
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="email" class="custom-label"><span class="text-danger">Email Address *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="email" class="form-control  form-control-sm" id="email" name="email" placeholder="Email Address" required>
              <div id="uname_response" ></div>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="usernewname" class="custom-label"><?= $row['userandroles'];?> name</label>
            </div>
            <div class="col-sm-8">
              <input type="text" class="form-control  form-control-sm" id="usernewname" name="usernewname" placeholder="Username" autocomplete="off">
              <div id="unewname_response" ></div>
            </div>
          </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
				<label for="cpassword" class="custom-label"><span class="text-danger">Password *</span></label>
            </div>
            <div class="col-sm-4 mb-1">
              <input type="password" class="form-control  form-control-sm" id="cpassword" name="cpassword" placeholder="Password" required autocomplete="off" onchange="matchPassword()">
            </div>
            <div class="col-sm-4 mb-1">
              <input type="password" class="form-control  form-control-sm" id="password" name="password" placeholder="Confirm Password" required onchange="matchPassword()">
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
				&nbsp;
            </div>
            <div class="col-sm-8">
			<div id="password_response" ></div>
              <label class="custom-label"><input type="checkbox" name="showpassword" id="showpassword"> Show Password</label>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="mobile" class="custom-label">Mobile Phone</label>
            </div>
            <div class="col-sm-8">
             <input type="number" min="0" step="0.01" step="0.01" class="form-control  form-control-sm" id="mobile" name="mobile" placeholder="Mobile Phone">
            </div>
          </div>
    </div>
</div>

</div>

    </div>

			   
              </div>
            </div>
          </div>
		  
		  <div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingTwo">
              <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading" style="font-size:18px;"><?= $row['userandroles'];?> Roles</a>	
				</div> 
                
              </button>
            </h5>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"  style="">
              <div class="accordion-body text-sm">
			<div class="row" style=" border-top:2px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
      <div class="col-lg-2">
      <label class="custom-label" style="color: royalblue;font-size: 14.6px;">Default Permissions</label>
      </div>
      <div class="col-lg-10">
          
      <div class="row">
        <div class="col-lg-3 my-1">
            <script type="text/javascript">
        function showDiv(element)
{
    // document.getElementById('gstblock').style.display = element.value == 0 ? 'none' : 'block';
    if (element.value==1) {
        let noaccessforprebooks = document.getElementById('nopermissionbooks');
        let accessforprebooks = document.getElementById('permissionbooks');
        document.getElementById('permissionfranchise').checked=true;
        document.getElementById('permissionuser').checked=true;
        document.getElementById('permissiondbook').checked=true;
        document.getElementById('permissionpreference').checked=true;
        document.getElementById('permissionconfig').checked=true;
        document.getElementById('preferencefranchisepermission').checked=true;
        document.getElementById('permissionuserr').checked=true;
        document.getElementById('permissionbooks').checked=true;
        document.getElementById('language').checked=true;
        document.getElementById('time').checked=true;
        document.getElementById('currency').checked=true;
        document.getElementById('taxes').checked=true;
        document.getElementById('showbooks').style.display='block';
        document.getElementById('secbks').style.display='block';
        accessforprebooks.checked = true;
        document.getElementById('showpreference').style.display = 'block';
        document.getElementById('showconfig').style.display = 'block';
        let bproview = document.getElementById('bproview');
        let bprocreate = document.getElementById('bprocreate');
        let bproedit = document.getElementById('bproedit');
        let bprodelete = document.getElementById('bprodelete');
        bproview.checked = true;
        bprocreate.checked = true;
        bproedit.checked = true;
        bprodelete.checked = true;
let bservview = document.getElementById('bservview');
        let bservcreate = document.getElementById('bservcreate');
        let bservedit = document.getElementById('bservedit');
        let bservdelete = document.getElementById('bservdelete');
        bservview.checked = true;
        bservcreate.checked = true;
        bservedit.checked = true;
        bservdelete.checked = true;
let bcusview = document.getElementById('bcusview');
        let bcuscreate = document.getElementById('bcuscreate');
        let bcusedit = document.getElementById('bcusedit');
        let bcusdelete = document.getElementById('bcusdelete');
        bcusview.checked = true;
        bcuscreate.checked = true;
        bcusedit.checked = true;
        bcusdelete.checked = true;
let bqtview = document.getElementById('bqtview');
        let bqtcreate = document.getElementById('bqtcreate');
        let bqtedit = document.getElementById('bqtedit');
        let bqtdelete = document.getElementById('bqtdelete');
        bqtview.checked = true;
        bqtcreate.checked = true;
        bqtedit.checked = true;
        bqtdelete.checked = true;
let besview = document.getElementById('besview');
        let bescreate = document.getElementById('bescreate');
        let besedit = document.getElementById('besedit');
        let besdelete = document.getElementById('besdelete');
        besview.checked = true;
        bescreate.checked = true;
        besedit.checked = true;
        besdelete.checked = true;
let binvview = document.getElementById('binvview');
        let binvcreate = document.getElementById('binvcreate');
        let binvedit = document.getElementById('binvedit');
        let binvdelete = document.getElementById('binvdelete');
        binvview.checked = true;
        binvcreate.checked = true;
        binvedit.checked = true;
        binvdelete.checked = true;
        let bproadd = document.getElementById('bproadd');
bproadd.checked = true;
let bservadd = document.getElementById('bservadd');
bservadd.checked = true;
let bcusadd = document.getElementById('bcusadd');
bcusadd.checked = true;
let bqtadd = document.getElementById('bqtadd');
bqtadd.checked = true;
let besadd = document.getElementById('besadd');
besadd.checked = true;
let binvadd = document.getElementById('binvadd');
binvadd.checked = true;

        

    }
    else{
        let noaccessforprebooks = document.getElementById('nopermissionbooks');
        let accessforprebooks = document.getElementById('permissionbooks');
        document.getElementById('nopermissionfranchise').checked=true;
        document.getElementById('nopermissionuser').checked=true;
        document.getElementById('nopermissiondbook').checked=true;
        document.getElementById('nopermissionpreference').checked=true;
        document.getElementById('nopermissionconfig').checked=true;
        document.getElementById('nopreferencefranchisepermission').checked=true;
        document.getElementById('nopermissionuserr').checked=true;
        document.getElementById('nopermissionbooks').checked=true;
        document.getElementById('nolanguage').checked=true;
        document.getElementById('notime').checked=true;
        document.getElementById('nocurrency').checked=true;
        document.getElementById('notaxes').checked=true;
        document.getElementById('showbooks').style.display='none';
        document.getElementById('secbks').style.display='none';
        noaccessforprebooks.checked = true;
        document.getElementById('showpreference').style.display ='none';
        document.getElementById('showconfig').style.display ='none';
        let bproadd = document.getElementById('bproadd');
        let bproview = document.getElementById('bproview');
        let bprocreate = document.getElementById('bprocreate');
        let bproedit = document.getElementById('bproedit');
        let bprodelete = document.getElementById('bprodelete');
        bproadd.checked = false;
        bproview.checked = false;
        bprocreate.checked = false;
        bproedit.checked = false;
        bprodelete.checked = false;
let bservadd = document.getElementById('bservadd');
let bservview = document.getElementById('bservview');
        let bservcreate = document.getElementById('bservcreate');
        let bservedit = document.getElementById('bservedit');
        let bservdelete = document.getElementById('bservdelete');
        bservadd.checked = false;
        bservview.checked = false;
        bservcreate.checked = false;
        bservedit.checked = false;
        bservdelete.checked = false;
let bcusadd = document.getElementById('bcusadd');
let bcusview = document.getElementById('bcusview');
        let bcuscreate = document.getElementById('bcuscreate');
        let bcusedit = document.getElementById('bcusedit');
        let bcusdelete = document.getElementById('bcusdelete');
        bcusadd.checked = false;
        bcusview.checked = false;
        bcuscreate.checked = false;
        bcusedit.checked = false;
        bcusdelete.checked = false;
let bqtadd = document.getElementById('bqtadd');
let bqtview = document.getElementById('bqtview');
        let bqtcreate = document.getElementById('bqtcreate');
        let bqtedit = document.getElementById('bqtedit');
        let bqtdelete = document.getElementById('bqtdelete');
        bqtadd.checked = false;
        bqtview.checked = false;
        bqtcreate.checked = false;
        bqtedit.checked = false;
        bqtdelete.checked = false;
let besadd = document.getElementById('besadd');
let besview = document.getElementById('besview');
        let bescreate = document.getElementById('bescreate');
        let besedit = document.getElementById('besedit');
        let besdelete = document.getElementById('besdelete');
        besadd.checked = false;
        besview.checked = false;
        bescreate.checked = false;
        besedit.checked = false;
        besdelete.checked = false;
let binvadd = document.getElementById('binvadd');
let binvview = document.getElementById('binvview');
        let binvcreate = document.getElementById('binvcreate');
        let binvedit = document.getElementById('binvedit');
        let binvdelete = document.getElementById('binvdelete');
        binvadd.checked = false;
        binvview.checked = false;
        binvcreate.checked = false;
        binvedit.checked = false;
        binvdelete.checked = false;
    }
    // else if (element.value==0) {

    // }
    // else{

    // }
}
    </script>
                      <select class="select4 form-control form-control-sm" onchange="showDiv(this)">
                          <option selected disabled>Select</option>
                          <option value="0">Owner / Investor</option>
                          <option value="1">Manager / Admin</option>
                          <option value="2">Biller / Cashier</option>
                      </select>
            </div>
          </div>
          
      </div>
      
      
      </div>
			
			 <div class="row" style=" border-top:2px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
      <div class="col-lg-2">
      <label class="custom-label" style="color: royalblue;font-size: 14.6px;">Default Permissions</label>
      </div>
      <div class="col-lg-10">
          
      <div class="row">
        <div class="col-lg-2 my-1" style="<?=(($rowww['permissioninsights']=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="permissioninsights" id="permissioninsights" checked>
                        <label class="custom-control-label custom-label" for="permissioninsights"> Insights</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="permissiondashboard" id="permissiondashboard" checked disabled>
                        <label class="custom-control-label custom-label" for="permissiondashboard"> Dashboard</label>
                      </div>
                      
                      </div>
                       <div class="col-lg-2 my-1" style="<?=(($rowww['permissionnotification']=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="permissionnotification" id="permissionnotification" checked>
                        <label class="custom-control-label custom-label" for="permissionnotification"> Notifications</label>
                      </div>
                      
                      </div>
                       <div class="col-lg-2 my-1" style="<?=(($rowww['permissionhelp']=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="permissionhelp" id="permissionhelp" checked>
                        <label class="custom-control-label custom-label" for="permissionhelp"> Help</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" style="<?=(($rowww['permissionmyaccount']=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" class="custom-control-input" name="permissionmyaccount" id="permissionmyaccount" checked>
                        <label class="custom-control-label custom-label" for="permissionmyaccount"> My Account</label>
                      </div>
                      
                      </div>
            
          </div>
          
      </div>
      
      
      </div>
      <?php
      if($permissionfranchise!=0||$permissionuser!=0||$permissionsidebooks!=0||$permissionpreference!=0||$permissionconfig!=0){
      ?>
            <div class="row" style=" border-top:1px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <div class="col-lg-12">
            <label class="custom-label mr-sm-2" style="font-size: 14.6px;color:royalblue;">App Permissions</label>
            </div>
            <div class="col-lg-10">
                    <script>
        function psf() {
            let permissionfranchise = document.getElementById('permissionfranchise');
            let nopermissionfranchise = document.getElementById('nopermissionfranchise');
            let permissionfranchiseview = document.getElementById('permissionfranchiseview');
        if (permissionfranchise.checked == true) {
            let noaccess = document.getElementById('nopreferencefranchisepermission');
            let fullaccess = document.getElementById('preferencefranchisepermission');
            // noaccess.checked = true;
        document.getElementById('secfranchroles').style.display='block';
        }
        else{
            let noaccess = document.getElementById('nopreferencefranchisepermission');
            let fullaccess = document.getElementById('preferencefranchisepermission');
            fullaccess.checked = false;
            noaccess.checked = true;
        document.getElementById('secfranchroles').style.display='none';
        }
        }
   
    </script>

            <div class="row">
                      
                  </div>
                  
            </div>
            
            
            </div>
      <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0;<?=(($permissionfranchise!='0')?'':'display:none;')?>">
            <div class="col-lg-2">
            <label class="custom-label mt-2"><?= $row['franchiseandroles'] ?> & Roles</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionfranchise" id="nopermissionfranchise" value="0" checked onclick="psf()">
                        <label class="custom-control-label custom-label" for="nopermissionfranchise">No Access</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;<?=(($permissionfranchise=='2'||$permissionfranchise=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionfranchise" id="permissionfranchiseview" value="1" onclick="psf()">
                        <label class="custom-control-label custom-label" for="permissionfranchiseview">View</label>
                      </div>
                      
                      </div>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;<?=(($permissionfranchise=='2')?'':'display:none;')?>">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionfranchise" id="permissionfranchise" value="2" onclick="psf()">
                        <label class="custom-control-label custom-label" for="permissionfranchise">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            
            
            </div>
            
            <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0;<?=(($permissionuser!='0')?'':'display:none;')?>">
            <div class="col-lg-2">
            <label class="custom-label mt-2"><?= $row['userandroles'] ?> & Roles</label>
            </div>
            <div class="col-lg-10">
                    <script>
        function psu() {
            let permissionuser = document.getElementById('permissionuser');
            let nopermissionuser = document.getElementById('nopermissionuser');
            let permissionuserview = document.getElementById('permissionuserview');
        if (permissionuser.checked == true) {
            let noaccess = document.getElementById('nopermissionuserr');
            let fullaccess = document.getElementById('permissionuserr');
            // noaccess.checked = true;
        document.getElementById('secuserroles').style.display='block';
        }
        else{
            let noaccess = document.getElementById('nopermissionuserr');
            let fullaccess = document.getElementById('permissionuserr');
            fullaccess.checked = false;
            noaccess.checked = true;
        document.getElementById('secuserroles').style.display='none';
        }
        }
   
    </script>
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionuser" id="nopermissionuser" value="0" checked onclick="psu()">
                        <label class="custom-control-label custom-label" for="nopermissionuser">No Access</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;<?=(($permissionuser=='2'||$permissionuser=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionuser" id="permissionuserview" value="1" onclick="psu()">
                        <label class="custom-control-label custom-label" for="permissionuserview">View</label>
                      </div>
                      
                      </div>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;<?=(($permissionuser=='2')?'':'display:none;')?>">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionuser" id="permissionuser" value="2" onclick="psu()">
                        <label class="custom-control-label custom-label" for="permissionuser">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            
            
            </div>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0;<?=(($permissionsidebooks!='0')?'':'display:none;')?>">
            <div class="col-lg-2">
            <label class="custom-label mt-2"><?= $row['books'] ?></label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionsidesbooks" id="nopermissiondbook" value="0" checked onclick="bookshows()">
                        <label class="custom-control-label custom-label" for="nopermissiondbook">No Access</label>
                      </div>
                      
                      </div>
                       <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionsidesbooks" id="permissiondbook" value="1" onclick="bookshows()">
                        <label class="custom-control-label custom-label" for="permissiondbook">Access</label>
                      </div>
                      
                      </div>
                     
                  </div>
                  
            </div>
            </div>
            <script type="text/javascript">//secbks nopermissionbooks
$(document).ready(function() {
  let noaccess = document.getElementById('nopermissiondbook');
  let access = document.getElementById('permissiondbook');
  let noaccessforprebooks = document.getElementById('nopermissionbooks');
  let accessforprebooks = document.getElementById('permissionbooks');
  if (noaccess.checked == true) {
    document.getElementById('showbooks').style.display='none';
    // document.getElementById('secbks').style.display='none';
    document.getElementById('preference').style.borderTop='0px solid #eee';
    noaccessforprebooks.checked = true;
  }
  if (access.checked == true) {
    document.getElementById('showbooks').style.display='block';
    // document.getElementById('secbks').style.display='block';
    document.getElementById('preference').style.borderTop='2px solid #eee';
    // noaccessforprebooks.checked = true;
  }
});
function bookshows(){
  let noaccess = document.getElementById('nopermissiondbook');
  let access = document.getElementById('permissiondbook');
  let noaccessforprebooks = document.getElementById('nopermissionbooks');
  let accessforprebooks = document.getElementById('permissionbooks');
  if (noaccess.checked == true) {
    document.getElementById('showbooks').style.display='none';
    document.getElementById('secbks').style.display='none';
    document.getElementById('preference').style.borderTop='0px solid #eee';
    noaccessforprebooks.checked = true;
  }
  else{
    document.getElementById('showbooks').style.display='block';
    document.getElementById('secbks').style.display='block';
    document.getElementById('preference').style.borderTop='2px solid #eee';
    // noaccessforprebooks.checked = true;
  }
}
            </script>
            <?php
            // if($permissionitems!='0'||$permissionsales!='0'||$permissionspurchases!='0'||$permissionbanking!='0'||$permissionsexpens!='0'||$permissionaccounting!='0'||$permissiontimetracking!='0'||$permissionewaybills!='0'||$permissiongstfilling!='0'||$permissionpayroll!='0'||$permissionattendence!='0'||$permissionsreport!='0')
         {
               ?>
            <div style="display:none;" id="showbooks">
            <div class="row" style=" border-top:0px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <div class="col-lg-12">
            <label class="custom-label mt-2" style="color:royalblue !important;"><span style="margin-left: 18px !important;"><?= $row['books'] ?></span></label>
            </div>
            </div>
            <?php
$sqlmain = mysqli_query($con,"select distinct grouptype,groupname,groupaccess from pairmainaccess where userid='$userid'");
while($sqlmainresult = mysqli_fetch_array($sqlmain)){
    $grouptype = preg_replace('/\s+/', '', $sqlmainresult['grouptype']);
    $maingrouptype=$sqlmainresult['grouptype'];
?>
<div class="row" style=" border-top:1px solid #eee; border-bottom:0px solid #eee;margin-left: 6px; padding:5px 0;<?=(($sqlmainresult['groupaccess']=='1')?'':'display:none;')?>">
<div class="col-lg-2">
<label class="custom-label mt-2" style="color: royalblue !important;"><?=$sqlmainresult['groupname']?></label>
</div>
    <div class="col-lg-10">
            <div class="row">
<?php
$sqlismainaccessnew=mysqli_query($con, "select distinct modulename,moduleaccess,moduletype,groupaccess,groupname,modulefieldcreate,modulefieldedit,modulefieldview,modulecolumns,grouptype from pairmainaccess where (userid='$companymainid' and createdid='0') and grouptype='$maingrouptype' ORDER BY ordering ASC");
while($infomainaccessnew=mysqli_fetch_array($sqlismainaccessnew)){
    $colgtype = preg_replace('/\s+/', '', $infomainaccessnew['grouptype']);
if ($infomainaccessnew['moduletype']=='') {
    ?>
    <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="fullaccess<?=strtolower($colgtype)?>()">
                        <input type="checkbox" class="custom-control-input useraccessfull<?=strtolower($colgtype)?>" name="useraccessfull<?=strtolower($colgtype)?>" id="useraccessfull<?=strtolower($colgtype)?>" >
                        <label class="custom-control-label custom-label" for="useraccessfull<?=strtolower($colgtype)?>" style="color: royalblue !important;"> Full access</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="fullviewaccess<?=strtolower($colgtype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($colgtype)?> useraccessview<?=strtolower($colgtype)?>" name="useraccessview<?=strtolower($colgtype)?>" id="useraccessview<?=strtolower($colgtype)?>" >
                        <label class="custom-control-label custom-label" for="useraccessview<?=strtolower($colgtype)?>"> View</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="viewaccess<?=strtolower($colgtype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($colgtype)?>" name="useraccesscreate<?=strtolower($colgtype)?>" id="useraccesscreate<?=strtolower($colgtype)?>" onclick="fullviewaccess<?=strtolower($colgtype)?>()">
                        <label class="custom-control-label custom-label" for="useraccesscreate<?=strtolower($colgtype)?>"> Create</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="viewaccess<?=strtolower($colgtype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($colgtype)?>" name="useraccessedit<?=strtolower($colgtype)?>" id="useraccessedit<?=strtolower($colgtype)?>" onclick="fullviewaccess<?=strtolower($colgtype)?>()">
                        <label class="custom-control-label custom-label" for="useraccessedit<?=strtolower($colgtype)?>"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1">
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="viewaccess<?=strtolower($colgtype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($colgtype)?>" name="useraccessdelete<?=strtolower($colgtype)?>" id="useraccessdelete<?=strtolower($colgtype
                        )?>" onclick="fullviewaccess<?=strtolower($colgtype)?>()">
                        <label class="custom-control-label custom-label text-danger" for="useraccessdelete<?=strtolower($colgtype)?>"> Delete</label>
                      </div>
                      
                      </div>
                      <script type="text/javascript">
                function fullaccess<?=strtolower($colgtype)?>() {
        if($("#useraccessfull<?=strtolower($colgtype)?>").prop('checked')){
                    let one = document.getElementsByClassName("full<?=strtolower($colgtype)?>");
                    let onelen = one.length;
                    for (i=0;i<onelen;i++) {
                        one[i].checked = true;
                    }
                    }
  else{
        let one = document.getElementsByClassName("full<?=strtolower($colgtype)?>");
        onelen = one.length;
        for(i=0;i<onelen;i++){
        one[i].checked=false;
      }
  }
                }
                function viewaccess<?=strtolower($colgtype)?>() {
                    if ($("#useraccesscreate<?=strtolower($colgtype)?>").prop('checked')||$("#useraccessedit<?=strtolower($colgtype)?>").prop('checked')||$("#useraccessdelete<?=strtolower($colgtype)?>").prop('checked')) {
                    let view = document.getElementsByClassName("useraccessview<?=strtolower($colgtype)?>");
                    let viewlen = view.length;
                    for (i=0;i<viewlen;i++) {
                        view[i].checked = true;
                    }
                    }
                    else{
                    let view = document.getElementsByClassName("useraccessview<?=strtolower($colgtype)?>");
                    let viewlen = view.length;
                    for (i=0;i<viewlen;i++) {
                        view[i].checked = false;
                    }
                    }
                }
                function fullviewaccess<?=strtolower($colgtype)?>() {
                    if ($("#useraccesscreate<?=strtolower($colgtype)?>").prop('checked')&&$("#useraccessedit<?=strtolower($colgtype)?>").prop('checked')&&$("#useraccessdelete<?=strtolower($colgtype)?>").prop('checked')&&$("#useraccessview<?=strtolower($colgtype)?>").prop('checked')) {
                    let full = document.getElementsByClassName("useraccessfull<?=strtolower($colgtype)?>");
                    let fulllen = full.length;
                    for (i=0;i<fulllen;i++) {
                        full[i].checked = true;
                    }
                    }
                    else{
                    let full = document.getElementsByClassName("useraccessfull<?=strtolower($colgtype)?>");
                    let fulllen = full.length;
                    for (i=0;i<fulllen;i++) {
                        full[i].checked = false;
                    }
                    }
                }
            </script>
                      <?php
}
}
?>
</div>
</div>
</div>
<?php
$sqlismainaccess=mysqli_query($con, "select distinct modulename,moduleaccess,moduletype,groupaccess,groupname,modulefieldcreate,modulefieldedit,modulefieldview,modulecolumns from pairmainaccess where (userid='$companymainid' and createdid='0') and (grouptype='$maingrouptype' and moduletype!='') ORDER BY ordering ASC");
while($infomainaccess=mysqli_fetch_array($sqlismainaccess)){
    $coltype = preg_replace('/\s+/', '', $infomainaccess['moduletype']);
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and (grouptype='$maingrouptype' and moduletype='".$infomainaccess['moduletype']."') ORDER BY ordering ASC");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if(($infomainaccess['moduleaccess']==1)&&((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessview']==1||$infomainaccessuser['useraccesscreate']==1||$infomainaccessuser['useraccessedit']==1||$infomainaccessuser['useraccessdelete']==1)))) {
?>
            <div class="row" style=" border-top:0px solid #eee;padding:5px 0;margin-left: 6px;">
            <div class="col-lg-2">
                        <label class="custom-label"> <?= $infomainaccess['modulename']; ?></label>
                      </div>
            <div class="col-lg-10">
            <div class="row">
<input type="hidden" name="group<?=strtolower($coltype)?>" id="group<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupaccess'] ?>">
<input type="hidden" name="grouptype<?=strtolower($coltype)?>" id="grouptype<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupname'] ?>">
<input type="hidden" name="modulecolumns<?=strtolower($coltype)?>" id="modulecolumns<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulecolumns'] ?>">
<input type="hidden" name="modulefieldsadd<?=strtolower($coltype)?>" id="modulefieldsadd<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulefieldcreate'] ?>">
<input type="hidden" name="modulefieldsedit<?=strtolower($coltype)?>" id="modulefieldsedit<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulefieldedit'] ?>">
<input type="hidden" name="modulefieldsview<?=strtolower($coltype)?>" id="modulefieldsview<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulefieldview'] ?>">
                <input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
                <input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
                      <div class="col-lg-2 my-1" <?=(((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&(($infomainaccessuser['useraccessview']==1)&&($infomainaccessuser['useraccesscreate']==1)&&($infomainaccessuser['useraccessedit']==1)&&($infomainaccessuser['useraccessdelete']==1))))?'':'style="display:none;"')?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="fullaccess<?=strtolower($coltype)?>()">
                        <input type="checkbox" class="custom-control-input useraccessfull<?=strtolower($coltype)?>" name="useraccessfull<?=strtolower($coltype)?>" id="useraccessfull<?=strtolower($coltype)?>" >
                        <label class="custom-control-label custom-label" for="useraccessfull<?=strtolower($coltype)?>" style="color: royalblue !important;"> Full access</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?=(((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessview']==1)))?'':'style="display:none;"')?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="fullviewaccess<?=strtolower($coltype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($coltype)?> useraccessview<?=strtolower($coltype)?>" name="useraccessview<?=strtolower($coltype)?>" id="useraccessview<?=strtolower($coltype)?>" >
                        <label class="custom-control-label custom-label" for="useraccessview<?=strtolower($coltype)?>"> View</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?=(((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccesscreate']==1)))?'':'style="display:none;"')?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="viewaccess<?=strtolower($coltype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($coltype)?>" name="useraccesscreate<?=strtolower($coltype)?>" id="useraccesscreate<?=strtolower($coltype)?>" onclick="fullviewaccess<?=strtolower($coltype)?>()">
                        <label class="custom-control-label custom-label" for="useraccesscreate<?=strtolower($coltype)?>"> Create</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?=(((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessedit']==1)))?'':'style="display:none;"')?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="viewaccess<?=strtolower($coltype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($coltype)?>" name="useraccessedit<?=strtolower($coltype)?>" id="useraccessedit<?=strtolower($coltype)?>" onclick="fullviewaccess<?=strtolower($coltype)?>()">
                        <label class="custom-control-label custom-label" for="useraccessedit<?=strtolower($coltype)?>"> Edit</label>
                      </div>
                      
                      </div>
                      <div class="col-lg-2 my-1" <?=(((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessdelete']==1)))?'':'style="display:none;"')?>>
                      <div class="custom-control custom-checkbox mr-sm-2" onclick="viewaccess<?=strtolower($coltype)?>()">
                        <input type="checkbox" class="custom-control-input full<?=strtolower($coltype)?>" name="useraccessdelete<?=strtolower($coltype)?>" id="useraccessdelete<?=strtolower($coltype
                        )?>" onclick="fullviewaccess<?=strtolower($coltype)?>()">
                        <label class="custom-control-label custom-label text-danger" for="useraccessdelete<?=strtolower($coltype)?>"> Delete</label>
                      </div>
                      
                      </div>

                  </div>
            </div>
            </div>
            <script type="text/javascript">
                function fullaccess<?=strtolower($coltype)?>() {
        if($("#useraccessfull<?=strtolower($coltype)?>").prop('checked')){
                    let one = document.getElementsByClassName("full<?=strtolower($coltype)?>");
                    let onelen = one.length;
                    for (i=0;i<onelen;i++) {
                        one[i].checked = true;
                    }
                    }
  else{
        let one = document.getElementsByClassName("full<?=strtolower($coltype)?>");
        onelen = one.length;
        for(i=0;i<onelen;i++){
        one[i].checked=false;
      }
  }
                }
                function viewaccess<?=strtolower($coltype)?>() {
                    if ($("#useraccesscreate<?=strtolower($coltype)?>").prop('checked')||$("#useraccessedit<?=strtolower($coltype)?>").prop('checked')||$("#useraccessdelete<?=strtolower($coltype)?>").prop('checked')) {
                    let view = document.getElementsByClassName("useraccessview<?=strtolower($coltype)?>");
                    let viewlen = view.length;
                    for (i=0;i<viewlen;i++) {
                        view[i].checked = true;
                    }
                    }
                    else{
                    let view = document.getElementsByClassName("useraccessview<?=strtolower($coltype)?>");
                    let viewlen = view.length;
                    for (i=0;i<viewlen;i++) {
                        view[i].checked = false;
                    }
                    }
                }
                function fullviewaccess<?=strtolower($coltype)?>() {
                    if ($("#useraccesscreate<?=strtolower($coltype)?>").prop('checked')&&$("#useraccessedit<?=strtolower($coltype)?>").prop('checked')&&$("#useraccessdelete<?=strtolower($coltype)?>").prop('checked')&&$("#useraccessview<?=strtolower($coltype)?>").prop('checked')) {
                    let full = document.getElementsByClassName("useraccessfull<?=strtolower($coltype)?>");
                    let fulllen = full.length;
                    for (i=0;i<fulllen;i++) {
                        full[i].checked = true;
                    }
                    }
                    else{
                    let full = document.getElementsByClassName("useraccessfull<?=strtolower($coltype)?>");
                    let fulllen = full.length;
                    for (i=0;i<fulllen;i++) {
                        full[i].checked = false;
                    }
                    }
                }
            </script>
<?php
}
else{
?>
<input type="hidden" name="group<?=strtolower($coltype)?>" id="group<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupaccess'] ?>">
<input type="hidden" name="grouptype<?=strtolower($coltype)?>" id="grouptype<?=strtolower($coltype)?>" value="<?= $infomainaccess['groupname'] ?>">
<input type="hidden" name="modulecolumns<?=strtolower($coltype)?>" id="modulecolumns<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulecolumns'] ?>">
<input type="hidden" name="modulefieldsadd<?=strtolower($coltype)?>" id="modulefieldsadd<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulefieldcreate'] ?>">
<input type="hidden" name="modulefieldsedit<?=strtolower($coltype)?>" id="modulefieldsedit<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulefieldedit'] ?>">
<input type="hidden" name="modulefieldsview<?=strtolower($coltype)?>" id="modulefieldsview<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulefieldview'] ?>">
                <input type="hidden" name="moduletype<?=strtolower($coltype)?>" id="moduletype<?=strtolower($coltype)?>" value="<?= $infomainaccess['modulename'] ?>">
                <input type="hidden" name="module<?=strtolower($coltype)?>" id="module<?=strtolower($coltype)?>" value="<?= $infomainaccess['moduleaccess'] ?>">
                        <input type="hidden" class="custom-control-input" name="useraccessfull<?=strtolower($coltype)?>" id="useraccessfull<?=strtolower($coltype)?>" value="0">
                        <input type="hidden" class="custom-control-input" name="useraccessview<?=strtolower($coltype)?>" id="useraccessview<?=strtolower($coltype)?>" value="0">
                        <input type="hidden" class="custom-control-input" name="useraccesscreate<?=strtolower($coltype)?>" id="useraccesscreate<?=strtolower($coltype)?>" value="0">
                        <input type="hidden" class="custom-control-input" name="useraccessedit<?=strtolower($coltype)?>" id="useraccessedit<?=strtolower($coltype)?>" value="0">
                        <input type="hidden" class="custom-control-input" name="useraccessdelete<?=strtolower($coltype)?>" id="useraccessdelete<?=strtolower($coltype)?>" value="0">
<?php
}
}
}
?>
<div class="row" style=" border-top:1px solid #eee; border-bottom:0px solid #eee; padding:5px 0"></div>
      </div>
         <?php
          // }
      }
          ?>
            <div class="row" id="preference" style=" border-top:0px solid #eee; border-bottom:1px solid #eee; padding:5px 0;<?=(($permissionpreference!='0')?'':'display:none;')?>">
            <div class="col-lg-2">
            <label class="custom-label mt-2">Preference</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2" onclick="preshows()">
                        <input type="radio" class="custom-control-input" name="permissionpreference" id="nopermissionpreference" value="0" checked>
                        <label class="custom-control-label custom-label" for="nopermissionpreference">No Access</label>
                      </div>
                      
                      </div>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;<?=(($permissionpreference=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-radio mr-sm-2" onclick="preshows()">
                        <input type="radio" class="custom-control-input" name="permissionpreference" id="permissionpreference" value="1">
                        <label class="custom-control-label custom-label" for="permissionpreference">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            <script type="text/javascript">
function preshows(){
  let nopre = document.getElementById('nopermissionpreference');
  let pre = document.getElementById('permissionpreference');
  if (pre.checked == true) {
    document.getElementById('showpreference').style.display='block';
  }
  else{
        let nopreferencefranchisepermission = document.getElementById('nopreferencefranchisepermission');
        let preferencefranchisepermission = document.getElementById('preferencefranchisepermission');
        let nopermissionuserr = document.getElementById('nopermissionuserr');
        let permissionuserr = document.getElementById('permissionuserr');
        let noaccess = document.getElementById('nopermissionbooks');
        let fullaccess = document.getElementById('permissionbooks');
        // fullaccess.checked = true;
        nopreferencefranchisepermission.checked = true;
        nopermissionuserr.checked = true;
        noaccess.checked = true;
    document.getElementById('showpreference').style.display='none';
  }
}
            </script>
            
            </div>
            <div id="showpreference" style="<?=(($preferencefranchisepermission!=0||$permissionuserr!=0||$permissionbooks!=0)?'':'display:none;')?>">
            <div class="row" style=" border-top:1.5px solid #eee; border-bottom:2px solid #eee; padding:5px 0">
           <!--  <div class="col-lg-12">
            <label class="custom-label mr-sm-2" style="font-size: 14.6px;color:royalblue;margin-left: 21px;">Preference Permissions</label>
            </div> -->
            <div class="col-lg-10">
                    
            <div class="row">
                      
                  </div>
                  
            </div>
            
            
            </div>
        <div id="secfranchroles" style="<?=(($preferencefranchisepermission!='0')?'':'display:none;')?>">
            <div class="row" style=" border-top:0px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;"><?= $row['franchiseandroles'] ?> & Roles</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="preferencefranchisepermission" id="nopreferencefranchisepermission" value="0" checked>
                        <label class="custom-control-label custom-label" for="nopreferencefranchisepermission">No Access</label>
                      </div>
                      
                      </div>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;<?=(($preferencefranchisepermission=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="preferencefranchisepermission" id="preferencefranchisepermission" value="1">
                        <label class="custom-control-label custom-label" for="preferencefranchisepermission">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            
            
            </div>
        </div>
        <div id="secuserroles" style="<?=(($permissionuserr!='0')?'':'display:none;')?>">
            <div class="row" style=" border-top:0px solid #eee; border-bottom:0px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;"><?= $row['userandroles'] ?> & Roles</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionuserr" id="nopermissionuserr" value="0" checked>
                        <label class="custom-control-label custom-label" for="nopermissionuserr">No Access</label>
                      </div>
                      
                      </div>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;<?=(($permissionuserr=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionuserr" id="permissionuserr" value="1">
                        <label class="custom-control-label custom-label" for="permissionuserr">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            
            </div>
            </div>
        <div  id="secbks" style="<?=(($permissionbooks!='0')?'':'display:none;')?>">
            <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;"><?= $row['books'] ?></label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionbooks" id="nopermissionbooks" value="0" checked>
                        <label class="custom-control-label custom-label" for="nopermissionbooks">No Access</label>
                      </div>
                      
                      </div>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;<?=(($permissionbooks=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="permissionbooks" id="permissionbooks" value="1">
                        <label class="custom-control-label custom-label" for="permissionbooks">Full Access</label>
                      </div>
                      
                      </div>
                     
                  </div>
                  
            </div>
            
            </div>
            </div>
      </div>
            <div class="row" style=" border-top:1.5px solid #eee; border-bottom:2px solid #eee; padding:5px 0;<?=(($permissionconfig!='0')?'':'display:none;')?>">
            <div class="col-lg-2">
            <label class="custom-label mt-2">Configuration</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2" onclick="conshows()">
                        <input type="radio" class="custom-control-input" name="permissionconfig" id="nopermissionconfig" value="0" checked>
                        <label class="custom-control-label custom-label" for="nopermissionconfig">No Access</label>
                      </div>
                      
                      </div>
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;<?=(($permissionconfig=='1')?'':'display:none;')?>">
                      <div class="custom-control custom-radio mr-sm-2" onclick="conshows()">
                        <input type="radio" class="custom-control-input" name="permissionconfig" id="permissionconfig" value="1">
                        <label class="custom-control-label custom-label" for="permissionconfig">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            <script type="text/javascript">
function conshows(){
  let nocon = document.getElementById('nopermissionconfig');
  let con = document.getElementById('permissionconfig');
  if (con.checked == true) {
    document.getElementById('showconfig').style.display='block';
  }
  else{
        let nolanguage = document.getElementById('nolanguage');
        let language = document.getElementById('language');
        let notime = document.getElementById('notime');
        let time = document.getElementById('time');
        let nocurrency = document.getElementById('nocurrency');
        let currency = document.getElementById('currency');
        let notaxes = document.getElementById('notaxes');
        let taxes = document.getElementById('taxes');
        // currency.checked = true;
        nolanguage.checked = true;
        notime.checked = true;
        nocurrency.checked = true;
        notaxes.checked = true;
    document.getElementById('showconfig').style.display='none';
  }
}
            </script>
            
            </div>
            <?php
        }
        ?>
            <div id="showconfig" style="<?=(($language!=0||$time!=0||$currency!=0||$taxes!=0)?'':'display:none;')?>">
                    <div class="row" style=" border-top:1.5px solid #eee; border-bottom:1px solid #eee; padding:5px 0">
            <!-- <div class="col-lg-12">
            <label class="custom-label mr-sm-2" style="font-size: 14.6px;color:royalblue;margin-left: 21px;">Configuration Permissions</label>
            </div> -->
            <div class="col-lg-10">
                    
            <div class="row">
                      
                  </div>
                  
            </div>
            
             
            </div>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:0px solid #eee; padding:5px 0;<?=(($language!='0')?'':'display:none;')?>">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;">Language</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="language" id="nolanguage" value="0" checked>
                        <label class="custom-control-label custom-label" for="nolanguage">No Access</label>
                      </div>
                      
                      </div>
                      
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="language" id="language" value="1">
                        <label class="custom-control-label custom-label" for="language">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            
            </div>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:0px solid #eee; padding:5px 0;<?=(($time!='0')?'':'display:none;')?>">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;">Country & Time Zone</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="time" id="notime" value="0" checked>
                        <label class="custom-control-label custom-label" for="notime">No Access</label>
                      </div>
                      
                      </div>
                      
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="time" id="time" value="1">
                        <label class="custom-control-label custom-label" for="time">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            
            
            </div>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:0px solid #eee; padding:5px 0;<?=(($currency!='0')?'':'display:none;')?>">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;">Currency</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="currency" id="nocurrency" value="0" checked>
                        <label class="custom-control-label custom-label" for="nocurrency">No Access</label>
                      </div>
                      
                      </div>
                      
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="currency" id="currency" value="1">
                        <label class="custom-control-label custom-label" for="currency">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            
            
            </div>
            <div class="row" style=" border-top:0px solid #eee; border-bottom:2px solid #eee; padding:5px 0;<?=(($taxes!='0')?'':'display:none;')?>">
            <div class="col-lg-2">
            <label class="custom-label mt-2" style="margin-left:21px;">Taxes</label>
            </div>
            <div class="col-lg-10">
                    
            <div class="row">
                      <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="taxes" id="notaxes" value="0" checked>
                        <label class="custom-control-label custom-label" for="notaxes">No Access</label>
                      </div>
                      
                      </div>
                      
                    <div class="col-lg-2 my-1" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                      <div class="custom-control custom-radio mr-sm-2">
                        <input type="radio" class="custom-control-input" name="taxes" id="taxes" value="1">
                        <label class="custom-control-label custom-label" for="taxes">Full Access</label>
                      </div>
                      
                      </div>
                  </div>
                  
            </div>
            
            
            </div>
                </div>
                    
             <div class="row" style=" border-top:1px solid #eee; border-bottom:3px solid #eee; padding:5px 0">
                <div class="col-lg-6">
                    <div class="row">
      <div class="col-lg-4">
      <label class="custom-label" style="color: royalblue;font-size: 14.6px;"><?= $row['franchiseandroles'] ?> Permissions</label>
      </div>
      <div class="col-lg-8">
     <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      
     <div class="row">
        <div class="col-lg-8">
          <select multiple name="franchises[]" id="animals" class="filter-multi-select">
             <?php
          $count=1;
          $sqliu=mysqli_query($con, "select * from pairfranchises where createdid='$companymainid' order by id desc");
          while($infou=mysqli_fetch_array($sqliu))
          {
            ?>
            <option id="franchises<?=$infou['id']?>" value="<?=$infou['id']?>"><?=$infou['franchisename']?></option>
            <?php
          }
          ?>
          </select>
        </div>
        <div class="col-lg-4" id="notifications">&nbsp;</div>
      </div>
              <script type="text/javascript">
        (function($){"use strict";function _interopDefaultLegacy(e){return e&&typeof e==="object"&&"default"in e?e:{"default":e}}var $__default=_interopDefaultLegacy($);var __extends=undefined&&undefined.__extends||function(){var extendStatics=function(d,b){extendStatics=Object.setPrototypeOf||{__proto__:[]}instanceof Array&&function(d,b){d.__proto__=b}||function(d,b){for(var p in b)if(Object.prototype.hasOwnProperty.call(b,p))d[p]=b[p]};return extendStatics(d,b)};return function(d,b){extendStatics(d,b);function __(){this.constructor=d}d.prototype=b===null?Object.create(b):(__.prototype=b.prototype,new __)}}();var NULL_OPTION=new(function(){function class_1(){}class_1.prototype.initialize=function(){};class_1.prototype.select=function(){};class_1.prototype.deselect=function(){};class_1.prototype.enable=function(){};class_1.prototype.disable=function(){};class_1.prototype.isSelected=function(){return false};class_1.prototype.isDisabled=function(){return false};class_1.prototype.getListItem=function(){return document.createElement("div")};class_1.prototype.getSelectedItemBadge=function(){return document.createElement("div")};class_1.prototype.getLabel=function(){return"NULL_OPTION"};class_1.prototype.getValue=function(){return"NULL_OPTION"};class_1.prototype.show=function(){};class_1.prototype.hide=function(){};class_1.prototype.isHidden=function(){return false};class_1.prototype.focus=function(){};return class_1}());var FilterMultiSelect=function(){function FilterMultiSelect(selectTarget,args){var _this=this;this.documentKeydownListener=function(e){switch(e.key){case"Tab":e.stopPropagation();_this.closeDropdown();break;case"ArrowUp":e.stopPropagation();e.preventDefault();_this.decrementItemFocus();_this.focusItem();break;case"ArrowDown":e.stopPropagation();e.preventDefault();_this.incrementItemFocus();_this.focusItem();break;case"Enter":case"Spacebar":case" ":break;default:_this.refocusFilter();break}};this.documentClickListener=function(e){if(_this.div!==e.target&&!_this.div.contains(e.target)){_this.closeDropdown()}};this.fmsFocusListener=function(e){e.stopPropagation();e.preventDefault();_this.viewBar.dispatchEvent(new MouseEvent("click"))};this.fmsMousedownListener=function(e){e.stopPropagation();e.preventDefault()};var t=selectTarget.get(0);if(!(t instanceof HTMLSelectElement)){throw new Error("JQuery target must be a select element.")}var select=t;var multiple=select.multiple;if(!multiple){throw new Error('Select element must have the "multiple" attribute.')}var name=select.name;if(!name){throw new Error("Select element must have a name attribute.")}this.name=name;var array=selectTarget.find("option").toArray();this.options=FilterMultiSelect.createOptions(this,name,array,args.items);this.selectAllOption=FilterMultiSelect.createSelectAllOption(this,name,args.selectAllText);this.filterInput=document.createElement("input");this.filterInput.type="text";this.filterInput.placeholder=args.filterText;this.clearButton=document.createElement("button");this.clearButton.type="button";this.clearButton.innerHTML="&times";this.filter=document.createElement("div");this.filter.append(this.filterInput,this.clearButton);this.items=document.createElement("div");this.items.append(this.selectAllOption.getListItem());this.options.forEach(function(o){return _this.items.append(o.getListItem())});this.dropDown=document.createElement("div");this.dropDown.append(this.filter,this.items);this.placeholder=document.createElement("span");this.placeholder.textContent=args.placeholderText;this.selectedItems=document.createElement("span");this.viewBar=document.createElement("div");this.viewBar.append(this.placeholder,this.selectedItems);this.div=document.createElement("div");this.div.id=select.id;this.div.append(this.viewBar,this.dropDown);this.caseSensitive=args.caseSensitive;this.disabled=select.disabled;this.allowEnablingAndDisabling=args.allowEnablingAndDisabling;this.filterText="";this.showing=new Array;this.focusable=new Array;this.itemFocus=-2;this.initialize()}FilterMultiSelect.createOptions=function(fms,name,htmlOptions,jsOptions){var htmloptions=htmlOptions.map(function(o,i){FilterMultiSelect.checkValue(o.value,o.label);return new FilterMultiSelect.SingleOption(fms,i,name,o.label,o.value,o.defaultSelected,o.disabled)});var j=htmlOptions.length;var jsoptions=jsOptions.map(function(o,i){var label=o[0];var value=o[1];var selected=o[2];var disabled=o[3];FilterMultiSelect.checkValue(value,label);return new FilterMultiSelect.SingleOption(fms,j+i,name,label,value,selected,disabled)});var opts=htmloptions.concat(jsoptions);var counts={};opts.forEach(function(o){var v=o.getValue();if(counts[v]===undefined){counts[v]=1}else{throw new Error("Duplicate value: "+o.getValue()+" ("+o.getLabel()+")")}});return opts};FilterMultiSelect.checkValue=function(value,label){if(value===""){throw new Error("Option "+label+" does not have an associated value.")}};FilterMultiSelect.createSelectAllOption=function(fms,name,label){return new(function(_super){__extends(class_2,_super);function class_2(){var _this=_super.call(this,fms,-1,name,label,"",false,false)||this;_this.checkbox.indeterminate=false;return _this}class_2.prototype.markSelectAll=function(){this.checkbox.checked=true;this.checkbox.indeterminate=false};class_2.prototype.markSelectPartial=function(){this.checkbox.checked=false;this.checkbox.indeterminate=true};class_2.prototype.markSelectAllNotDisabled=function(){this.checkbox.checked=true;this.checkbox.indeterminate=true};class_2.prototype.markDeselect=function(){this.checkbox.checked=false;this.checkbox.indeterminate=false};class_2.prototype.select=function(){if(this.isDisabled())return;this.fms.options.filter(function(o){return!o.isSelected()}).forEach(function(o){return o.select()})};class_2.prototype.deselect=function(){if(this.isDisabled())return;this.fms.options.filter(function(o){return o.isSelected()}).forEach(function(o){return o.deselect()})};class_2.prototype.enable=function(){this.checkbox.disabled=false};class_2.prototype.disable=function(){this.checkbox.disabled=true};return class_2}(FilterMultiSelect.SingleOption))};FilterMultiSelect.createEvent=function(e,n,v,l){var event=new CustomEvent(e,{detail:{name:n,value:v,label:l},bubbles:true,cancelable:true,composed:false});return event};FilterMultiSelect.prototype.initialize=function(){this.options.forEach(function(o){return o.initialize()});this.selectAllOption.initialize();this.filterInput.className="form-control";this.clearButton.tabIndex=-1;this.filter.className="filter dropdown-item";this.items.className="items dropdown-item";this.dropDown.className="dropdown-menu";this.placeholder.className="placeholder";this.selectedItems.className="selected-items";this.viewBar.className="viewbar form-control dropdown-toggle";this.div.className="filter-multi-select dropdown";if(this.isDisabled()){this.disableNoPermissionCheck()}this.attachDropdownListeners();this.attachViewbarListeners();this.closeDropdown()};FilterMultiSelect.prototype.log=function(m,e){};FilterMultiSelect.prototype.attachDropdownListeners=function(){var _this=this;this.filterInput.addEventListener("keyup",function(e){e.stopImmediatePropagation();_this.updateDropdownList();var numShown=_this.showing.length;switch(e.key){case"Enter":if(numShown===1){var o=_this.options[_this.showing[0]];if(!o.isDisabled()){if(o.isSelected()){o.deselect()}else{o.select()}_this.clearFilterAndRefocus()}}break;case"Escape":if(_this.filterText.length>0){_this.clearFilterAndRefocus()}else{_this.closeDropdown()}break}},true);this.clearButton.addEventListener("click",function(e){e.stopImmediatePropagation();var text=_this.filterInput.value;if(text.length>0){_this.clearFilterAndRefocus()}else{_this.closeDropdown()}},true)};FilterMultiSelect.prototype.updateDropdownList=function(){var text=this.filterInput.value;if(text.length>0){this.selectAllOption.hide()}else{this.selectAllOption.show()}var showing=new Array;var focusable=new Array;if(this.caseSensitive){this.options.forEach(function(o,i){if(o.getLabel().indexOf(text)!==-1){o.show();showing.push(i);if(!o.isDisabled()){focusable.push(i)}}else{o.hide()}})}else{this.options.forEach(function(o,i){if(o.getLabel().toLowerCase().indexOf(text.toLowerCase())!==-1){o.show();showing.push(i);if(!o.isDisabled()){focusable.push(i)}}else{o.hide()}})}this.filterText=text;this.showing=showing;this.focusable=focusable};FilterMultiSelect.prototype.clearFilterAndRefocus=function(){this.filterInput.value="";this.updateDropdownList();this.refocusFilter()};FilterMultiSelect.prototype.refocusFilter=function(){this.filterInput.focus();this.itemFocus=-2};FilterMultiSelect.prototype.attachViewbarListeners=function(){var _this=this;this.viewBar.addEventListener("click",function(e){if(_this.isClosed()){_this.openDropdown()}else{_this.closeDropdown()}})};FilterMultiSelect.prototype.isClosed=function(){return!this.dropDown.classList.contains("show")};FilterMultiSelect.prototype.setTabIndex=function(){if(this.isDisabled()){this.div.tabIndex=-1}else{if(this.isClosed()){this.div.tabIndex=0}else{this.div.tabIndex=-1}}};FilterMultiSelect.prototype.closeDropdown=function(){var _this=this;document.removeEventListener("keydown",this.documentKeydownListener,true);document.removeEventListener("click",this.documentClickListener,true);this.dropDown.classList.remove("show");setTimeout(function(){_this.setTabIndex()},100);this.div.addEventListener("mousedown",this.fmsMousedownListener,true);this.div.addEventListener("focus",this.fmsFocusListener)};FilterMultiSelect.prototype.incrementItemFocus=function(){if(this.itemFocus>=this.focusable.length-1||this.focusable.length==0)return;this.itemFocus++;if(this.itemFocus==-1&&this.selectAllOption.isHidden()){this.itemFocus++}};FilterMultiSelect.prototype.decrementItemFocus=function(){if(this.itemFocus<=-2)return;this.itemFocus--;if(this.itemFocus==-1&&this.selectAllOption.isHidden()){this.itemFocus--}};FilterMultiSelect.prototype.focusItem=function(){if(this.itemFocus===-2){this.refocusFilter()}else if(this.itemFocus===-1){this.selectAllOption.focus()}else{this.options[this.focusable[this.itemFocus]].focus()}};FilterMultiSelect.prototype.openDropdown=function(){if(this.disabled)return;this.div.removeEventListener("mousedown",this.fmsMousedownListener,true);this.div.removeEventListener("focus",this.fmsFocusListener);this.dropDown.classList.add("show");this.setTabIndex();this.clearFilterAndRefocus();document.addEventListener("keydown",this.documentKeydownListener,true);document.addEventListener("click",this.documentClickListener,true)};FilterMultiSelect.prototype.queueOption=function(option){if(this.options.indexOf(option)==-1)return;$__default["default"](this.selectedItems).append(option.getSelectedItemBadge())};FilterMultiSelect.prototype.unqueueOption=function(option){if(this.options.indexOf(option)==-1)return;$__default["default"](this.selectedItems).children('[data-id="'+option.getSelectedItemBadge().getAttribute("data-id")+'"]').remove()};FilterMultiSelect.prototype.update=function(){if(this.areAllSelected()){this.selectAllOption.markSelectAll();this.placeholder.hidden=true}else if(this.areSomeSelected()){if(this.areOnlyDeselectedAlsoDisabled()){this.selectAllOption.markSelectAllNotDisabled();this.placeholder.hidden=true}else{this.selectAllOption.markSelectPartial();this.placeholder.hidden=true}}else{this.selectAllOption.markDeselect();this.placeholder.hidden=false}if(this.areAllDisabled()){this.selectAllOption.disable()}else{this.selectAllOption.enable()}};FilterMultiSelect.prototype.areAllSelected=function(){return this.options.map(function(o){return o.isSelected()}).reduce(function(acc,cur){return acc&&cur},true)};FilterMultiSelect.prototype.areSomeSelected=function(){return this.options.map(function(o){return o.isSelected()}).reduce(function(acc,cur){return acc||cur},false)};FilterMultiSelect.prototype.areOnlyDeselectedAlsoDisabled=function(){return this.options.filter(function(o){return!o.isSelected()}).map(function(o){return o.isDisabled()}).reduce(function(acc,cur){return acc&&cur},true)};FilterMultiSelect.prototype.areAllDisabled=function(){return this.options.map(function(o){return o.isDisabled()}).reduce(function(acc,cur){return acc&&cur},true)};FilterMultiSelect.prototype.isEnablingAndDisablingPermitted=function(){return this.allowEnablingAndDisabling};FilterMultiSelect.prototype.getRootElement=function(){return this.div};FilterMultiSelect.prototype.hasOption=function(value){return this.getOption(value)!==NULL_OPTION};FilterMultiSelect.prototype.getOption=function(value){for(var _i=0,_a=this.options;_i<_a.length;_i++){var o=_a[_i];if(o.getValue()==value){return o}}return NULL_OPTION};FilterMultiSelect.prototype.selectOption=function(value){this.getOption(value).select()};FilterMultiSelect.prototype.deselectOption=function(value){this.getOption(value).deselect()};FilterMultiSelect.prototype.isOptionSelected=function(value){return this.getOption(value).isSelected()};FilterMultiSelect.prototype.enableOption=function(value){this.getOption(value).enable()};FilterMultiSelect.prototype.disableOption=function(value){this.getOption(value).disable()};FilterMultiSelect.prototype.isOptionDisabled=function(value){return this.getOption(value).isDisabled()};FilterMultiSelect.prototype.disable=function(){if(!this.isEnablingAndDisablingPermitted())return;this.disableNoPermissionCheck()};FilterMultiSelect.prototype.disableNoPermissionCheck=function(){var _this=this;this.options.forEach(function(o){return _this.setBadgeDisabled(o)});this.disabled=true;this.div.classList.add("disabled");this.viewBar.classList.remove("dropdown-toggle");this.closeDropdown()};FilterMultiSelect.prototype.setBadgeDisabled=function(o){o.getSelectedItemBadge().classList.add("disabled")};FilterMultiSelect.prototype.enable=function(){var _this=this;if(!this.isEnablingAndDisablingPermitted())return;this.options.forEach(function(o){if(!o.isDisabled()){_this.setBadgeEnabled(o)}});this.disabled=false;this.div.classList.remove("disabled");this.setTabIndex();this.viewBar.classList.add("dropdown-toggle")};FilterMultiSelect.prototype.setBadgeEnabled=function(o){o.getSelectedItemBadge().classList.remove("disabled")};FilterMultiSelect.prototype.isDisabled=function(){return this.disabled};FilterMultiSelect.prototype.selectAll=function(){this.selectAllOption.select()};FilterMultiSelect.prototype.deselectAll=function(){this.selectAllOption.deselect()};FilterMultiSelect.prototype.getSelectedOptions=function(includeDisabled){if(includeDisabled===void 0){includeDisabled=true}var a=this.options;if(!includeDisabled){if(this.isDisabled()){return new Array}a=a.filter(function(o){return!o.isDisabled()})}a=a.filter(function(o){return o.isSelected()});return a};FilterMultiSelect.prototype.getSelectedOptionsAsJson=function(includeDisabled){if(includeDisabled===void 0){includeDisabled=true}var data={};var a=this.getSelectedOptions(includeDisabled).map(function(o){return o.getValue()});data[this.getName()]=a;var c=JSON.stringify(data,null,"  ");return c};FilterMultiSelect.prototype.getName=function(){return this.name};FilterMultiSelect.prototype.dispatchSelectedEvent=function(option){this.dispatchEvent(FilterMultiSelect.EventType.SELECTED,option.getValue(),option.getLabel())};FilterMultiSelect.prototype.dispatchDeselectedEvent=function(option){this.dispatchEvent(FilterMultiSelect.EventType.DESELECTED,option.getValue(),option.getLabel())};FilterMultiSelect.prototype.dispatchEvent=function(eventType,value,label){var event=FilterMultiSelect.createEvent(eventType,this.getName(),value,label);this.viewBar.dispatchEvent(event)};FilterMultiSelect.SingleOption=function(){function class_3(fms,row,name,label,value,checked,disabled){this.fms=fms;this.div=document.createElement("div");this.checkbox=document.createElement("input");this.checkbox.type="checkbox";var id=name+"-"+row.toString();var nchbx=id+"-chbx";this.checkbox.id=nchbx;this.checkbox.name=name;this.checkbox.value=value;this.checkbox.checked=checked;this.checkbox.disabled=disabled;this.labelFor=document.createElement("label");this.labelFor.htmlFor=nchbx;this.labelFor.textContent=label;this.div.append(this.checkbox,this.labelFor);this.closeButton=document.createElement("button");this.closeButton.type="button";this.closeButton.innerHTML="&times";this.selectedItemBadge=document.createElement("span");this.selectedItemBadge.setAttribute("data-id",id);this.selectedItemBadge.textContent=label;this.selectedItemBadge.append(this.closeButton)}class_3.prototype.log=function(m,e){};class_3.prototype.initialize=function(){var _this=this;this.div.className="dropdown-item custom-control";this.checkbox.className="custom-control-input custom-checkbox";this.labelFor.className="custom-control-label";this.selectedItemBadge.className="item";if(this.isSelected()){this.selectNoDisabledCheck()}if(this.isDisabled()){this.disableNoPermissionCheck()}this.checkbox.addEventListener("change",function(e){e.stopPropagation();if(_this.isDisabled()||_this.fms.isDisabled()){e.preventDefault();return}if(_this.isSelected()){_this.select()}else{_this.deselect()}var numShown=_this.fms.showing.length;if(numShown===1){_this.fms.clearFilterAndRefocus()}},true);this.checkbox.addEventListener("keyup",function(e){switch(e.key){case"Enter":e.stopPropagation();_this.checkbox.dispatchEvent(new MouseEvent("click"));break}},true);this.closeButton.addEventListener("click",function(e){e.stopPropagation();if(_this.isDisabled()||_this.fms.isDisabled())return;_this.deselect();if(!_this.fms.isClosed()){_this.fms.refocusFilter()}},true);this.checkbox.tabIndex=-1;this.closeButton.tabIndex=-1};class_3.prototype.select=function(){if(this.isDisabled())return;this.selectNoDisabledCheck()};class_3.prototype.selectNoDisabledCheck=function(){this.checkbox.checked=true;this.fms.queueOption(this);this.fms.dispatchSelectedEvent(this);this.fms.update()};class_3.prototype.deselect=function(){if(this.isDisabled())return;this.checkbox.checked=false;this.fms.unqueueOption(this);this.fms.dispatchDeselectedEvent(this);this.fms.update()};class_3.prototype.enable=function(){if(!this.fms.isEnablingAndDisablingPermitted())return;this.checkbox.disabled=false;this.selectedItemBadge.classList.remove("disabled");this.fms.update()};class_3.prototype.disable=function(){if(!this.fms.isEnablingAndDisablingPermitted())return;this.disableNoPermissionCheck()};class_3.prototype.disableNoPermissionCheck=function(){this.checkbox.disabled=true;this.selectedItemBadge.classList.add("disabled");this.fms.update()};class_3.prototype.isSelected=function(){return this.checkbox.checked};class_3.prototype.isDisabled=function(){return this.checkbox.disabled};class_3.prototype.getListItem=function(){return this.div};class_3.prototype.getSelectedItemBadge=function(){return this.selectedItemBadge};class_3.prototype.getLabel=function(){return this.labelFor.textContent};class_3.prototype.getValue=function(){return this.checkbox.value};class_3.prototype.show=function(){this.div.hidden=false};class_3.prototype.hide=function(){this.div.hidden=true};class_3.prototype.isHidden=function(){return this.div.hidden};class_3.prototype.focus=function(){this.labelFor.focus()};return class_3}();FilterMultiSelect.EventType={SELECTED:"optionselected",DESELECTED:"optiondeselected"};return FilterMultiSelect}();$__default["default"].fn.filterMultiSelect=function(args){var target=this;args=$__default["default"].extend({},$__default["default"].fn.filterMultiSelect.args,args);if(typeof args.placeholderText==="undefined")args.placeholderText="nothing selected";if(typeof args.filterText==="undefined")args.filterText="Filter";if(typeof args.selectAllText==="undefined")args.selectAllText="Select All";if(typeof args.caseSensitive==="undefined")args.caseSensitive=false;if(typeof args.allowEnablingAndDisabling==="undefined")args.allowEnablingAndDisabling=true;if(typeof args.items==="undefined")args.items=new Array;var filterMultiSelect=new FilterMultiSelect(target,args);var fms=$__default["default"](filterMultiSelect.getRootElement());target.replaceWith(fms);var methods={hasOption:function(value){return filterMultiSelect.hasOption(value)},selectOption:function(value){filterMultiSelect.selectOption(value)},deselectOption:function(value){filterMultiSelect.deselectOption(value)},isOptionSelected:function(value){return filterMultiSelect.isOptionSelected(value)},enableOption:function(value){filterMultiSelect.enableOption(value)},disableOption:function(value){filterMultiSelect.disableOption(value)},isOptionDisabled:function(value){return filterMultiSelect.isOptionDisabled(value)},enable:function(){filterMultiSelect.enable()},disable:function(){filterMultiSelect.disable()},selectAll:function(){filterMultiSelect.selectAll()},deselectAll:function(){filterMultiSelect.deselectAll()},getSelectedOptionsAsJson:function(includeDisabled){if(includeDisabled===void 0){includeDisabled=true}return filterMultiSelect.getSelectedOptionsAsJson(includeDisabled)}};$__default["default"].fn.filterMultiSelect.applied.push(methods);return methods};$__default["default"](function(){var selector=typeof $__default["default"].fn.filterMultiSelect.selector==="undefined"?"select.filter-multi-select":$__default["default"].fn.filterMultiSelect.selector;var s=$__default["default"](selector);s.each(function(i,e){$__default["default"](e).filterMultiSelect()})});$__default["default"].fn.filterMultiSelect.applied=new Array;$__default["default"].fn.filterMultiSelect.selector=undefined;$__default["default"].fn.filterMultiSelect.args={}})($);
//# sourceMappingURL=filter-multi-select-bundle.min.js.map
    </script>
     <script>
      // Use the plugin once the DOM has been loaded.
      $(function () {
        // Apply the plugin 
        var notifications = $('#notifications');
        $('#animals').on("optionselected", function(e) {
          createNotification("selected", e.detail.label);
        });
        $('#animals').on("optiondeselected", function(e) {
          createNotification("deselected", e.detail.label);
        });
        function createNotification(event,label) {
          var n = $(document.createElement('span'))
            .text(event + ' ' + label + "  ")
            .addClass('notification')
            .appendTo(notifications)
            .fadeOut(3000, function() {
              n.remove();
            });
        }
        var shapes = $('#shapes').filterMultiSelect({
          selectAllText: 'all...',
          placeholderText: 'click to select a shape',
          filterText: 'search',
          caseSensitive: true,
        });
        var cars = $('#cars').filterMultiSelect();
        var pl1 = $('#programming_languages_1').filterMultiSelect();
        $('#b1').click((e) => {
          pl1.enableOption("1");
        });
        $('#b2').click((e) => {
          pl1.disableOption("1");
        });
        var pl2 = $('#programming_languages_2').filterMultiSelect();
        $('#b3').click((e) => {
          pl2.enable();
        });
        $('#b4').click((e) => {
          pl2.disable();
        });
        var pl3 = $('#programming_languages_3').filterMultiSelect({
          allowEnablingAndDisabling: false,
        });
        $('#b5').click((e) => {
          pl3.enableOption("1");
        });
        $('#b6').click((e) => {
          pl3.disableOption("1");
        });
        $('#b7').click((e) => {
          pl3.enable();
        });
        $('#b8').click((e) => {
          pl3.disable();
        });
        var cities = $('#cities').filterMultiSelect({
          items: [["San Francisco","a"],
                  ["Milan","b",false,true],
                  ["Singapore","c",true],
                  ["Berlin","d",true,true],
                 ],
        });
        $('#jsonbtn1').click((e) => {
           var b = true;
           $('#jsonresult1').text(JSON.stringify(getJson(b),null,"  "));
         });
         var getJson = function (b) {
           var result = $.fn.filterMultiSelect.applied
               .map((e) => JSON.parse(e.getSelectedOptionsAsJson(b)))
               .reduce((prev,curr) => {
                 prev = {
                   ...prev,
                   ...curr,
                 };
                 return prev;
               });
           return result;
         }
         $('#jsonbtn2').click((e) => {
           var b = false;
           $('#jsonresult2').text(JSON.stringify(getJson(b),null,"  "));
         });
        $('#form').on('keypress keyup', function(e) {
          var keyCode = e.keyCode || e.which;
          if (keyCode === 13) { 
            e.preventDefault();
            return false;
          }
        });
      });
    </script>    
            </div>
            </div>
            </div>
            </div>
                
            </div>
            </div>
  </div>

               
              <!-- </div> -->
        
        
			  
			  <div class="row justify-content-center" style="margin-bottom: -14px;">
    <div class="col-lg-12"><hr>
        <button name="submit"
                                                            class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
                                                            type="submit" id="submittableview" value="Submit"
                                                            style="margin-bottom: 15px;">
                                                            <span class="label">Save</span> <span
                                                                class="spinner"></span>
                                                        </button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="users.php">Cancel</a>
    </div>
</div>
            </div>
          </div>
</div>





</form>

             
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

<script type="text/javascript">
  $(function() {
     $( "#lastname" ).autocomplete({
       source: 'productsearch.php?type=lastname',
     });
  });
</script>
<script>
 function previewFile() {
  var preview = document.getElementById('profile-image1');
  var file    = document.getElementById('profile-image-upload').files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
  
}
                      $(function() {
            $('#profile-image1').on('click', function() {
                $('#profile-image-upload').click();
            });
            $('#profile-image2').on('click', function() {
                $('#profile-image-upload').click();
            });
        });
        
</script>
<script>
$(document).ready(function(){
   $("#email").keyup(function(){
      var username = $(this).val().trim();
      var oldemail = $('#id').val().trim();
      if(username != ''){
         $.ajax({
            url: 'emailvalidate.php',
            type: 'post',
            data: {email: username, oldemail: <?=$id?>},
            success: function(response){
            $('#uname_response').html(response);
             }
         });
      }else{
         $("#uname_response").html("");
      }

    });

 });
</script>
<script>
$(document).ready(function(){
   $("#usernewname").keyup(function(){
      var usernewname = $(this).val().trim();
      var oldusernewname = $('#id').val().trim();
      if(usernewname != ''){
         $.ajax({
            url: 'usernewnamevalidate.php',
            type: 'post',
            data: {usernewname: usernewname, oldusernewname: <?=$id?>},
            success: function(response){
            $('#unewname_response').html(response);
             }
         });
      }else{
         $("#unewname_response").html("");
      }

    });

 });
</script>
<script>
    function checkvalidate()
    {
        var response=$('#uname_response').html();
        
        if(response=='<span style="color: red;">Not Available.</span>')
        {
            alert('This email is Not Available. Please Try Any other Email');
            return false;
        }
		return matchPassword();
    }
</script>
<script>
$("#checkAll").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
});
</script>
<script>  
function matchPassword()
{
var pw1 = document.getElementById("password");  
var pw2 = document.getElementById("cpassword");  
if(pw1.value != pw2.value)
{
$("#password_response").html('<span style="color: red;"><i class="fa fa-exclamation-circle"></i> Those passwords didn\'t match. Try again</span>');  
pw1.focus();
return false;
}
else
{
$("#password_response").html('');  	
}
}
</script>

<script type='text/javascript'>
	$(document).ready(function(){
            $('#showpassword').click(function(){
                $(this).is(':checked') ? $('#password').attr('type', 'text') : $('#password').attr('type', 'password');
				$(this).is(':checked') ? $('#cpassword').attr('type', 'text') : $('#cpassword').attr('type', 'password');
            });
        });
    </script>






    
	
</body>

</html>