<?php
include('lcheck.php');
$sqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customers' order by id  asc");
while($infomainaccessfield=mysqli_fetch_array($sqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $infomainaccessfield['moduletype']);
    $add = $infomainaccessfield[21];
    $fieldadd = explode(',',$add);
    $edit = $infomainaccessfield[22];
    $fieldedit = explode(',',$edit);
    $view = $infomainaccessfield[23];
    $fieldview = explode(',',$view);
}
// This is for Restriction of Pages
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccesscreate']==0)))) {
header('Location:dashboard.php');
}
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}

if (isset($_POST['submit'])) {
// $customercode = mysqli_real_escape_string($con, $_POST['customercode']); customercode='$customercode',,  mobile='$mobile', address='$address',  email='$email',   website='$website', tinno='$tinno', cstno='$cstno', landline='$landline'
$sqlismodulespublicnamecust=mysqli_query($con, "select * from pairmodules where moduletype='Customers' order by id  asc");
$infomodulespublicnamecust=mysqli_fetch_array($sqlismodulespublicnamecust);
$sqlismainaccesspublicnamecust=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Customers' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicnamecust=mysqli_fetch_array($sqlismainaccesspublicnamecust);
$cushead = $infomainaccessuser['modulename'];
$customerids = mysqli_real_escape_string($con, $_POST['customerid']);
$sqlins = mysqli_query($con, "select count(customercode) from paircustomers where moduletype='Customers'");
$ansins = mysqli_fetch_array($sqlins);
$oldid = $ansins[0];
$customerid = $oldid + 1;
$publiccodes=mysqli_real_escape_string($con, $_POST['publiccode']);
$publicsql=mysqli_query($con,"select count(publicid) from paircustomers where createdid='$companymainid' and moduletype='Customers'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publiccode=$infomodulespublicnamecust['publiccolumn'] . $oldcodepublic+1;
$privatecodes=mysqli_real_escape_string($con, $_POST['privatecode']);
$privatesql=mysqli_query($con,"select count(privateid) from paircustomers where createdid='$companymainid' and moduletype='Customers' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privatecode=$infomainaccesspublicnamecust['moduleprefix'] . $infomainaccesspublicnamecust['modulesuffix']+1;
$ordering = $infomainaccesspublicnamecust['modulesuffix']+1;
if (isset($_POST['category'])) {
$category = mysqli_real_escape_string($con, $_POST['category']);
} else {
$category = " ";
}
if (isset($_POST['subcategory'])) {
$subcategory = mysqli_real_escape_string($con, $_POST['subcategory']);
} else {
$subcategory = " ";
}
$salute = mysqli_real_escape_string($con, $_POST['salute']);
$pcontact = mysqli_real_escape_string($con, $_POST['pcontact']);
$companyname = mysqli_real_escape_string($con, $_POST['companyname']);
$customerdname = mysqli_real_escape_string($con, $_POST['customerdname']);
$age = mysqli_real_escape_string($con, $_POST['age']);
$sex = mysqli_real_escape_string($con, $_POST['sex']);
if (isset($_POST['visibilityc'])) {
$vvisibility = mysqli_real_escape_string($con, $_POST['visibilityc']);
} else {
$vvisibility = "PUBLIC";
}
$billstreet = mysqli_real_escape_string($con, $_POST['billstreet']);
$billcity = mysqli_real_escape_string($con, $_POST['billcity']);
$billstate = mysqli_real_escape_string($con, $_POST['billstate']);
$billpincode = mysqli_real_escape_string($con, $_POST['billpincode']);
$billcountry = mysqli_real_escape_string($con, $_POST['billcountry']);
$gstrtype = mysqli_real_escape_string($con, $_POST['gstrtype']);
$gstin = mysqli_real_escape_string($con, $_POST['gstin']);
$businesslegalname = mysqli_real_escape_string($con, $_POST['bln']);
$businesstradename = mysqli_real_escape_string($con, $_POST['btname']);
$taxpreference = mysqli_real_escape_string($con, $_POST['taxpref']);
$workphone = mysqli_real_escape_string($con, $_POST['workphone']);
$mobilephone = mysqli_real_escape_string($con, $_POST['mobilephone']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$website = mysqli_real_escape_string($con, $_POST['website']);
$pan = mysqli_real_escape_string($con, $_POST['pan']);
$placeos = mysqli_real_escape_string($con, $_POST['pos']);
$dlt = mysqli_real_escape_string($con, $_POST['dlt']);
$dlo = mysqli_real_escape_string($con, $_POST['dlo']);
$sameasbilling = mysqli_real_escape_string($con, (isset($_POST['sameasbilling'])) ? '1' : '0');
if ($sameasbilling=='1') {
$shipstreet = mysqli_real_escape_string($con, $_POST['billstreet']);
$shipcity = mysqli_real_escape_string($con, $_POST['billcity']);
$shipstate = mysqli_real_escape_string($con, $_POST['billstate']);
$shippincode = mysqli_real_escape_string($con, $_POST['billpincode']);
$shipcountry = mysqli_real_escape_string($con, $_POST['billcountry']);
}
else{
$shipstreet = mysqli_real_escape_string($con, $_POST['shipstreet']);
$shipcity = mysqli_real_escape_string($con, $_POST['shipcity']);
$shipstate = mysqli_real_escape_string($con, $_POST['shipstate']);
$shippincode = mysqli_real_escape_string($con, $_POST['shippincode']);
$shipcountry = mysqli_real_escape_string($con, $_POST['shipcountry']);
}
// $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
// $address = mysqli_real_escape_string($con, $_POST['address']);
// $email = mysqli_real_escape_string($con, $_POST['email']);
// $website = mysqli_real_escape_string($con, $_POST['website']);
// $tinno = mysqli_real_escape_string($con, $_POST['tinno']);
// $cstno = mysqli_real_escape_string($con, $_POST['cstno']);
// $landline = mysqli_real_escape_string($con, $_POST['landline']);
//,billstreet='$billstreet',billcity='$billcity',billstate='$billstate',billpincode='$billpincode',billcountry='$billcountry',shipstreet='$shipstreet',shipcity='$shipcity',shipstate='$shipstate',shippincode='$shippincode',shipcountry='$shipcountry'
$msg = "";
$msg_class = "";
if (($customerdname != "" || $customerdname == "")) {
$sqlcon = "SELECT id From paircustomers WHERE customername = '{$customerdname}' and franchisesession='" . $_SESSION["franchisesession"] . "' and moduletype='Customers'";
$querycon = mysqli_query($con, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if (!$querycon) {
die("SQL query failed: " . mysqli_error($con));
}
// if ($rowCountcon == 0) {
$sqlup = "insert into paircustomers set createdon='$times', createdid='$companymainid', createdby='" . $_SESSION["unqwerty"] . "', franchisesession='" . $_SESSION["franchisesession"] . "',primarysalutation='$salute',primarycontact='$pcontact',companyname='$companyname',customername='$customerdname',cvisiblity='$vvisibility',billstreet='$billstreet',billcity='$billcity',billstate='$billstate',billpincode='$billpincode',billcountry='$billcountry',shipstreet='$shipstreet',shipcity='$shipcity',shipstate='$shipstate',shippincode='$shippincode',shipcountry='$shipcountry',customercode='$customerid',gstrtype='$gstrtype',gstin='$gstin',buslegname='$businesslegalname',bustrdname='$businesstradename',category='$category',subcategory='$subcategory',custaxprefer='$taxpreference',workphone='$workphone',mobile='$mobilephone',email='$email',website='$website',sameasbilling='$sameasbilling',pan='$pan',placeos='$placeos',moduletype='Customers',publicid='$publiccode',privateid='$privatecode',dlno20='$dlt',dlno21='$dlo',age='$age',sex='$sex',ordering='$ordering'";
$queryup = mysqli_query($con, $sqlup);
if (!$queryup) {
die("SQL query failed: " . mysqli_error($con));
} else {
$tid = mysqli_insert_id($con);
                $ch='';
                $ch.='CUSTOMER CREATED';
                if($salute!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Salutaion<span style="color:green;" id="prohisfromtospan">( '.$salute.' ) </span>';
                    }
                    else
                    {
                        $ch.='Salutaion<span style="color:green;" id="prohisfromtospan">( '.$salute.' ) </span>';
                    }                   
                }
                if($pcontact!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Primary Contact Name<span style="color:green;" id="prohisfromtospan">( '.$pcontact.' ) </span>';
                    }
                    else
                    {
                        $ch.='Primary Contact Name<span style="color:green;" id="prohisfromtospan">( '.$pcontact.' ) </span>';
                    }                   
                }
                if($companyname!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Companyname<span style="color:green;" id="prohisfromtospan">( '.$companyname.' ) </span>';
                    }
                    else
                    {
                        $ch.='Companyname<span style="color:green;" id="prohisfromtospan">( '.$companyname.' ) </span>';
                    }                   
                }
                if($customerdname!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> '.$cushead.' Name<span style="color:green;" id="prohisfromtospan">( '.$customerdname.' ) </span>';
                    }
                    else
                    {
                        $ch.=''.$cushead.' Name<span style="color:green;" id="prohisfromtospan">( '.$customerdname.' ) </span>';
                    }                   
                }
                if($age!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Age<span style="color:green;" id="prohisfromtospan">( '.$age.' ) </span>';
                    }
                    else
                    {
                        $ch.='Age<span style="color:green;" id="prohisfromtospan">( '.$age.' ) </span>';
                    }                   
                }
                if($sex!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Sex<span style="color:green;" id="prohisfromtospan">( '.$sex.' ) </span>';
                    }
                    else
                    {
                        $ch.='Sex<span style="color:green;" id="prohisfromtospan">( '.$sex.' ) </span>';
                    }                   
                }
                if($category!=' ')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Category<span style="color:green;" id="prohisfromtospan">( '.$category.' ) </span>';
                    }
                    else
                    {
                        $ch.='Category<span style="color:green;" id="prohisfromtospan">( '.$category.' ) </span>';
                    }                   
                }
                if($subcategory!=' ')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Subcategory<span style="color:green;" id="prohisfromtospan">( '.$subcategory.' ) </span>';
                    }
                    else
                    {
                        $ch.='Subcategory<span style="color:green;" id="prohisfromtospan">( '.$subcategory.' ) </span>';
                    }                   
                }
                if($workphone!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Work Phone<span style="color:green;" id="prohisfromtospan">( '.$workphone.' ) </span>';
                    }
                    else
                    {
                        $ch.='Work Phone<span style="color:green;" id="prohisfromtospan">( '.$workphone.' ) </span>';
                    }                   
                }
                if($mobilephone!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Mobile Phone<span style="color:green;" id="prohisfromtospan">( '.$mobilephone.' ) </span>';
                    }
                    else
                    {
                        $ch.='Mobile Phone<span style="color:green;" id="prohisfromtospan">( '.$mobilephone.' ) </span>';
                    }                   
                }
                if($email!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Email<span style="color:green;" id="prohisfromtospan">( '.$email.' ) </span>';
                    }
                    else
                    {
                        $ch.='Email<span style="color:green;" id="prohisfromtospan">( '.$email.' ) </span>';
                    }                   
                }
                if($website!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Website<span style="color:green;" id="prohisfromtospan">( '.$website.' ) </span>';
                    }
                    else
                    {
                        $ch.='Website<span style="color:green;" id="prohisfromtospan">( '.$website.' ) </span>';
                    }                   
                }
                if($billstreet!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Billing Street<span style="color:green;" id="prohisfromtospan">( '.$billstreet.' ) </span>';
                    }
                    else
                    {
                        $ch.='Billing Street<span style="color:green;" id="prohisfromtospan">( '.$billstreet.' ) </span>';
                    }                   
                }
                if($billcity!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Billing City<span style="color:green;" id="prohisfromtospan">( '.$billcity.' ) </span>';
                    }
                    else
                    {
                        $ch.='Billing City<span style="color:green;" id="prohisfromtospan">( '.$billcity.' ) </span>';
                    }                   
                }
                if($billstate!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Billing State<span style="color:green;" id="prohisfromtospan">( '.$billstate.' ) </span>';
                    }
                    else
                    {
                        $ch.='Billing State<span style="color:green;" id="prohisfromtospan">( '.$billstate.' ) </span>';
                    }                   
                }
                if($billpincode!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Billing Pincode<span style="color:green;" id="prohisfromtospan">( '.$billpincode.' ) </span>';
                    }
                    else
                    {
                        $ch.='Billing Pincode<span style="color:green;" id="prohisfromtospan">( '.$billpincode.' ) </span>';
                    }                   
                }
                if($billcountry!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Billing Country<span style="color:green;" id="prohisfromtospan">( '.$billcountry.' ) </span>';
                    }
                    else
                    {
                        $ch.='Billing Country<span style="color:green;" id="prohisfromtospan">( '.$billcountry.' ) </span>';
                    }                   
                }
                if($shipstreet!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Shipping Street<span style="color:green;" id="prohisfromtospan">( '.$shipstreet.' ) </span>';
                    }
                    else
                    {
                        $ch.='Shipping Street<span style="color:green;" id="prohisfromtospan">( '.$shipstreet.' ) </span>';
                    }                   
                }
                if($shipcity!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Shipping City<span style="color:green;" id="prohisfromtospan">( '.$shipcity.' ) </span>';
                    }
                    else
                    {
                        $ch.='Shipping City<span style="color:green;" id="prohisfromtospan">( '.$shipcity.' ) </span>';
                    }                   
                }
                if($shipstate!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Shipping State<span style="color:green;" id="prohisfromtospan">( '.$shipstate.' ) </span>';
                    }
                    else
                    {
                        $ch.='Shipping State<span style="color:green;" id="prohisfromtospan">( '.$shipstate.' ) </span>';
                    }                   
                }
                if($shippincode!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Shipping Pincode<span style="color:green;" id="prohisfromtospan">( '.$shippincode.' ) </span>';
                    }
                    else
                    {
                        $ch.='Shipping Pincode<span style="color:green;" id="prohisfromtospan">( '.$shippincode.' ) </span>';
                    }                   
                }
                if($shipcountry!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Shipping Country<span style="color:green;" id="prohisfromtospan">( '.$shipcountry.' ) </span>';
                    }
                    else
                    {
                        $ch.='Shipping Country<span style="color:green;" id="prohisfromtospan">( '.$shipcountry.' ) </span>';
                    }                   
                }
                if(in_array('Customers Visibility', $fieldadd)){
                if($vvisibility!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Visibility <span style="color:green;" id="prohisfromtospan">( '.$vvisibility.' ) </span>';
                    }
                    else
                    {
                        $ch.='Visibility <span style="color:green;" id="prohisfromtospan">( '.$vvisibility.' ) </span>';
                    }                   
                }
            }
                if(in_array('Tax Preference', $fieldadd)){
                if($taxpreference!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Tax Preference <span style="color:green;" id="prohisfromtospan">( Taxable ) </span>';
                    }
                    else
                    {
                        $ch.='Tax Preference <span style="color:green;" id="prohisfromtospan">( Taxable ) </span>';
                    }                   
                }
            }
                if($gstrtype!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> GST Registration Type<span style="color:green;" id="prohisfromtospan">( '.$gstrtype.' ) </span>';
                    }
                    else
                    {
                        $ch.='GST Registration Type<span style="color:green;" id="prohisfromtospan">( '.$gstrtype.' ) </span>';
                    }                   
                }
                if($gstin!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> GSTIN / UIN<span style="color:green;" id="prohisfromtospan">( '.$gstin.' ) </span>';
                    }
                    else
                    {
                        $ch.='GSTIN / UIN<span style="color:green;" id="prohisfromtospan">( '.$gstin.' ) </span>';
                    }                   
                }
                if($businesslegalname!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Business Legal Name<span style="color:green;" id="prohisfromtospan">( '.$businesslegalname.' ) </span>';
                    }
                    else
                    {
                        $ch.='Business Legal Name<span style="color:green;" id="prohisfromtospan">( '.$businesslegalname.' ) </span>';
                    }                   
                }
                if($businesstradename!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Business Trade Name<span style="color:green;" id="prohisfromtospan">( '.$businesstradename.' ) </span>';
                    }
                    else
                    {
                        $ch.='Business Trade Name<span style="color:green;" id="prohisfromtospan">( '.$businesstradename.' ) </span>';
                    }                   
                }
                if($pan!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> PAN<span style="color:green;" id="prohisfromtospan">( '.$pan.' ) </span>';
                    }
                    else
                    {
                        $ch.='PAN<span style="color:green;" id="prohisfromtospan">( '.$pan.' ) </span>';
                    }                   
                }
                if (in_array('Place Of Supply', $fieldadd)) {
                if($placeos!='')
                {
                    if($ch!='')
                    {
                        $ch.='<br> Place Of Supply<span style="color:green;" id="prohisfromtospan">( '.$placeos.' ) </span>';
                    }
                    else
                    {
                        $ch.='Place Of Supply<span style="color:green;" id="prohisfromtospan">( '.$placeos.' ) </span>';
                    }                   
                }
            }
                if($ch!='')
                {
                $sqluse=mysqli_query($con, "insert into pairusehistory set usetype='CUSTOMERS', createdon='$times',  createdby='".$_SESSION["unqwerty"]."', useid='$tid', useremarks='".$ch."' ");
                }
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Unit', '{$tid}')");
header("Location: customers.php?remarks=Added Successfully");
$sql3=mysqli_query($con, "update pairmainaccess set modulesuffix=modulesuffix+1 where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customers'");
}
// } else {
// header("Location: customers.php?error=This record is Already Found! Kindly check in All Customers List");
// }
} else {
header("Location: customers.php?error=Error Data");
}
$sqlsubcat = "select subcategory from pairsubcategory where subcategory='$subcategory' and itemmodule='Customers' and createdid='$companymainid'";
$resultsubcat = mysqli_query($con, $sqlsubcat);
if (mysqli_num_rows($resultsubcat) > 0) {
} else {
if (isset($_POST['subcategory'])) {
$sqlupsub = "insert into pairsubcategory set createdon='$times', createdid='$companymainid',createdby='" . $_SESSION["unqwerty"] . "',itemmodule='Customers', subcategory='$subcategory'";
$queryupsub = mysqli_query($con, $sqlupsub);
}
}
$sqlcat = "select category from paircategory where category='$category' and itemmodule='Customers' and createdid='$companymainid'";
$resultcat = mysqli_query($con, $sqlcat);
if (mysqli_num_rows($resultcat) > 0) {
} else {
if (isset($_POST['category'])) {
$sqlupcat = "insert into paircategory set createdon='$times', createdid='$companymainid',createdby='" . $_SESSION["unqwerty"] . "',itemmodule='Customers', category='$category'";
$queryupcat = mysqli_query($con, $sqlupcat);
}
}
}
// }
// $sqlcat=mysqli_query($con,"select * from paircategory");
// while($answercat=mysqli_fetch_array($sqlcat)){
// $oldcategorys=$answercat['category'];
// }
// if(isset($_POST['submitcategory'])){
// // {
// // $sqlcat=mysqli_query($con,"select * from paircategory");
// // $answercat=mysqli_fetch_array($sqlcat);
// // $oldcategorys=$answercat['category'];
// $categorys=mysqli_real_escape_string($con,$_POST['category']);
// if ($categorys!=$oldcategorys) {
//     $categoryses=mysqli_real_escape_string($con,$_POST['category']);
//     $sqlup = "insert into paircategory set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."',itemmodule='Vendors', category='$categoryses'";
//             $queryup = mysqli_query($con, $sqlup);
//             if($queryup){
//                header('Location:vendoradd.php?remarks=Category Added Successfully');
//             }
//             if (!$queryup) {
//             header('Location:vendoradd.php?error=This is Already Exists Category');
//         }
//         }
//         else{
//             header('Location:vendoradd.php?error=This is Already Exists Category');
//         }
// }
// // if( isset($_POST['submitcategory'])) {
// // $sqlcat=mysqli_query($con,"select * from paircategory");
// // $answercat=mysqli_fetch_array($sqlcat);
// // $oldcategorys=$answercat['category'];
// //     $categorys=$_POST['category'];
// //     foreach($categorys as $anscat){
// //         if ($anscat!=$oldcategorys) {
// //             $sqlup = "insert into paircategory set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', category='$anscat'";
// //             $queryup = mysqli_query($con, $sqlup);
// //             if($queryup){
// //                header('Location:vendoradd.php?remarks=Category Added Successfully');
// //             }
// //         }
// //         else{
// //             header('Location:vendoradd.php?error=This is Already Exists Category');
// //         }
// //         }
// // }
// $sqlsubcat=mysqli_query($con,"select * from pairsubcategory");
// while($answersubcat=mysqli_fetch_array($sqlsubcat)){
// $oldsubcategorys=$answersubcat['subcategory'];
// }
// if( isset($_POST['submitsubcategory'])) {
//     $subcategory=mysqli_real_escape_string($con, $_POST['missingsubcategory']);
// if ($subcategory!=$oldsubcategorys) {
//     $subcategoryses=mysqli_real_escape_string($con,$_POST['missingsubcategory']);
//     $sqlup = "insert into pairsubcategory set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."',itemmodule='Vendors', subcategory='$subcategoryses'";
//             $queryup = mysqli_query($con, $sqlup);
//             if($queryup){
//                header('Location:vendoradd.php?remarks=Subcategory Added Successfully');
//             }
//             if (!$queryup) {
//             header('Location:vendoradd.php?error=This is Already Exists SubCategory');
//         }
//         }
//         else{
//             header('Location:vendoradd.php?error=This is Already Exists SubCategory');
//         }
//      // $subcategory=mysqli_real_escape_string($con, $_POST['missingsubcategory']);
//             // $sqlup = "insert into pairsubcategory set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', subcategory='$subcategory'";
//             // $queryup = mysqli_query($con, $sqlup);
//             // if(!$queryup){
//             //    die("SQL query failed: " . mysqli_error($con));
//             // }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="favicon.ico">
<!-- FontAwesome JS-->
<script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
<!-- App CSS -->
<link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
<!-- Externals -->
<?php
include ('externals.php');
?>
<title>
New <?= $infomainaccessuser['modulename'] ?>
</title>
<!-- font awesome -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<!-- customeradd -->
<link href="customeradd.css" rel="stylesheet">
<!-- gst select design -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet"/>
</head>
<body class="g-sidenav-show" style="background-color:#F1F2F6;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<?php
// sidebar
include ('sidebar.php');
?>
<main class="main-content position-relative max-height-vh-100 h-100 mt-0 " style="overflow-y: scroll !important;">
<?php
// navbar
include ('navhead.php');
?>
<div class="container-fluid py-4 bg-body">
<?php
// notifications
if (isset($_GET['remarks'])) {
?>
<div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -50px;border-radius: 0px !important;">
<button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #53b05a !important;">
<i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks'] ?></p>
</div>
<?php
}
?>
<?php
if (isset($_GET['error'])) {
?>
<div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -50px;border-radius: 0px !important;">
<button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button><p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
<i class="fa fa-times"></i> &nbsp;<?=$_GET['error'] ?></p>
</div>
<?php
}
?>
                                <?php
                                $sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Customers' order by id  asc");
                                $infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
                                ?>
<div id="fullcontainerwidth">
<div class="row min-height-480">
<div class="col-12">
<div class="card mb-4 mt-5 p-3">
<div class="card-body p-0" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
<p id="newcus"><i class="fa fa-file-import"></i> New <?= $infomainaccessuser['modulename'] ?></p>

<!-- Start AddNewCategory modal -->
<div class="modal fade" id="AddNewCategory" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">New Category</h5>
<span type="button" onclick="funescategory()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="closeicon">&times;</span>
</span>
</div>
<div class="modal-body">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingcategory" class="custom-label"><span class="text-danger">
Name *</span></label>
</div>
<div class="col-sm-7">
<input type="text" name="category" class="form-control form-control-sm mb-4" id="missingcategory" placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div><!--
<div class="modal-body" style="padding: 1rem 0px 0px 2rem !important;">
<div class="row justify-content-center">
<div class="col-lg-12">
<label for="Unit" class="custom-label"><span class="text-danger">Name *</span></label>
</div>
</div>
</div>
<div class="justify-content-center p-1">
<div style="margin-left: 30px;margin-right: 30px;"> -->
<!-- <input type="text" name="category" class="form-control form-control-sm mb-4" id="missingcategory" > -->
<!-- </div> -->
<?php
// $sqli = mysqli_query($con, "select distinct category from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') and category!='' order by category asc");
// while ($info = mysqli_fetch_array($sqli)) {
?>
<?php
// }
?>
<?php
// $sqli = mysqli_query($con, "select * from paircategory where createdid='$companymainid' and createdby='".$_SESSION['unqwerty']."' order by category asc");
// while ($info = mysqli_fetch_array($sqli)) {
?>
<!-- <div style="margin-left: 30px;margin-right: 30px;">
<input type="text" name="categoryies[]" value="<?=$info['category'] ?>" class="form-control form-control-sm mb-4" >
</div> -->
<?php
// }
?>
<!-- <div class="container1">
<p style="margin-left:180px; padding:0">
<a class="add_form_field btn btn-primary btn-sm btn-custom-grey" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another Category </span></a></p>
</div> -->
<!-- </div> 
$(document).ready(function() {
var wrapper = $(".container1");
var add_button = $(".add_form_field");
$(add_button).click(function(e) {
e.preventDefault();
$(wrapper).prepend('<div style="margin-left: 30px;margin-right: 30px;"><input type="text" name="category[]" class="form-control form-control-sm"><a href="#" class="delete" style="width:max-content;position:relative;top:-27px;left:339px;"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></div>   '); //add input box<div class="mt-1" style="margin-left:30px;"><input type="text" name="cat[]" class="form-control form-control-sm" style="width:332px;"><a href="#" class="delete" style="width:max-content;position:relative;top:-27px;left:345px;"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;" class="mt-1 mb-1"></a></div>
});
$(wrapper).on("click", ".delete", function(e) {
e.preventDefault();
$(this).parent('div').remove();
x--;
})
});</script> -->
<div class="modal-footer ">
<div class="col">
<button   onclick="funaddcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitcategory" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funescategory()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!-- </form> -->
<!-- End AddNewCategory modal -->
<!-- Start AddNewSubCategory modal -->
<div class="modal fade" id="AddNewSubCategory" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">New Sub Category</h5>
<span type="button" onclick="funessubcategory()" class="close" data-dismiss="modal"
aria-label="Close">
<span aria-hidden="true" id="closeicon">&times;</span>
</span>
</div>
<div class="modal-body mbsub">
<form method="post" action="">
<div class="row justify-content-center">
<div class="col-lg-12">
<div class="form-group row">
<div class="col-sm-5">
<label for="missingsubcategory" class="custom-label"><span class="text-danger">
Name *</span></label>
</div>
<div class="col-sm-7">
<input type="text" class="form-control  form-control-sm"
id="missingsubcategory" name="missingsubcategory"
placeholder="Name" required>
</div>
</div>
</div>
</div>
</form>
</div>
<div class="modal-footer mfsub">
<div class="col">
<button   onclick="funaddsubcategory()" class="btn btn-primary btn-sm btn-custom arlina-button expand-left"   type="submit"  name="submitsubcategory" value="Submit">
<span class="label">Save</span> <span class="spinner"></span>
</button>
<button type="button"
class="btn btn-primary btn-sm btn-custom-grey"
onclick="funessubcategory()">Cancel</button> </div>
</div>
</div>
</div>
</div>
<!-- </form> -->
<!-- End AddNewSubCategory modal -->
                                <?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customers' order by id  asc");
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
<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal mt-2" role="form">
<input type="hidden" name="customercode" id="customercode" value="">
<input type="hidden" name="landline" id="landline" value="">
<input type="hidden" name="cstno" id="cstno" value="">
<!-- margin: 1rem;"> -->
<?php
// if ((in_array('Customer Information', $fieldadd))) {
?>
<div class="accordion" id="accordionRental">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="headingOne">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#custcollapseOne" aria-expanded="true" aria-controls="custcollapseOne">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading"><?= $infomainaccessuser['modulename'] ?> Information</a>
</div>
</button>
</h5>
<div id="custcollapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
<div class="accordion-body text-sm">
<?php
$sql = mysqli_query($con, "select count(customercode) from paircustomers where moduletype='Customers'");
$ans = mysqli_fetch_array($sql);
?>
<div class="row justify-content-center" <?=((in_array('Customer Id', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="customerid" class="custom-label vendorid" data-toggle="tooltip" title="<?= $infomainaccessuser['modulename'] ?> Id" data-placement="top"><?= $infomainaccessuser['modulename'] ?> Id</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="customerid" name="customerid" placeholder="<?= $infomainaccessuser['modulename'] ?> Id" readonly value="<?=$ans[0] + 1 ?>">
</div>
</div>
</div>
</div>
<?php
            $publicsql=mysqli_query($con,"select count(publicid) from paircustomers where createdid='$companymainid' and moduletype='Customers'");
            $publicans=mysqli_fetch_array($publicsql);
            $sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Customers' order by id  asc");
                                $infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Customer Public Id', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="publiccode" class="custom-label"><?= $infomainaccessuser['modulename'] ?> Public Id</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="publiccode" name="publiccode" readonly value="<?= $infomodulespublicname['publiccolumn'] . $publicans[0]+1 ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<?php
            $privatesql=mysqli_query($con,"select count(privateid) from paircustomers where createdid='$companymainid' and moduletype='Customers' and franchisesession='".$_SESSION['franchisesession']."'");
            $privateans=mysqli_fetch_array($privatesql);
            $sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Customers' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
                                $infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);
            ?>
                                                    <div class="row justify-content-center" <?=((in_array('Customer Private Id', $fieldadd))?'':'style="display:none;"')?>>
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <div class="col-sm-4">
                                                                    <label for="privatecode" class="custom-label"><?= $infomainaccessuser['modulename'] ?> Private Id</label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control  form-control-sm" id="privatecode" name="privatecode" readonly value="<?= $infomainaccesspublicname['moduleprefix'] . $infomainaccesspublicname['modulesuffix']+1 ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<div class="row justify-content-center highfor" <?=((in_array('Primary Contact', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="pcontact" class="custom-label primarycontact" data-toggle="tooltip" title="Primary Contact">Primary Contact <span id="name"></span></label>
</div>
<div class="col-sm-3 ali">
<input type="text" class="form-control  form-control-sm" id="salute" name="salute" placeholder="Salutation" >
<!-- style="width:93px;"  -->
<i class="fa fa-angle-down" id="drpsalute"></i>
</div>
<div class="col-sm-5 ali one">
<input type="text" class="form-control  form-control-sm" id="pcontact" name="pcontact" placeholder="Name" onchange="companynames()" oninput="pco(this)">
<!-- style="position:relative;left: -36px;width: 236px;"  -->
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Company Name', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="companyname" class="custom-label companyname" data-toggle="tooltip" title="Company Name" data-placement="top">Company Name</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="companyname" name="companyname" placeholder="Company Name" onchange="companynames()" maxlength="300">
</div>
</div>
</div>
</div>
<?php
// if ((in_array('Customer Display Name', $fieldadd))) {
?>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="customerdname" class="custom-label displayname" data-toggle="tooltip" title="Display Name" data-placement="top"><span class="text-danger"> <?= $infomainaccessuser['modulename'] ?></span></label><label class="custom-label displayname" data-toggle="tooltip" title="Display Name" data-placement="top"><span class="text-danger">Name *</span></label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="customerdname" name="customerdname" placeholder="Display Name" required>
</div>
</div>
</div>
</div>
<?php
// }
?>
<?php
if ((in_array('Age', $fieldadd))) {
?>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="age" class="custom-label" data-toggle="tooltip" title="Age" data-placement="top">Age</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="age" name="age" placeholder="Age">
</div>
</div>
</div>
</div>
<?php
}
?>
<?php
if ((in_array('Sex', $fieldadd))) {
?>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="sex" class="custom-label" data-toggle="tooltip" title="Sex" data-placement="top">Sex</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="sex" name="sex" placeholder="Sex">
</div>
</div>
</div>
</div>
<?php
}
?>
<div class="row justify-content-center" <?=((in_array('Category', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="Category" class="custom-label"><span
class="">Category</span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select
class="form-control  form-control-sm"
name="category" id="category" >
<option selected disabled>Category</option>
<?php
$sqli = mysqli_query($con, "select * from paircategory where (createdid='$companymainid' or createdid='0') and itemmodule='Customers' and category!='' order by category asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?=$info['category'] ?>">
<?=$info['category'] ?></option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Sub Category', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="subcategory" class="custom-label"><span
class="">Sub Category</span></label>
</div>
<div class="col-sm-8" onclick="andus()">
<select
class="form-control form-control-sm"
name="subcategory" id="subcategory">
<option selected disabled>Sub Category</option>
<?php
$sqli = mysqli_query($con, "select * from pairsubcategory where (createdid='$companymainid' or createdid='0') and itemmodule='Customers' and subcategory!='' order by subcategory asc");
while ($info = mysqli_fetch_array($sqli)) {
?>
<option value="<?=$info['subcategory'] ?>">
<?=$info['subcategory'] ?></option>
<?php
}
?>
</select>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Work Phone', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="workphone" class="custom-label workphone" data-toggle="tooltip" title="Work Phone" data-placement="top">Work Phone</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="workphone" name="workphone" placeholder="Work Phone" maxlength="100">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Mobile Phone', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="mobilephone" class="custom-label mobilephone" data-toggle="tooltip" title="Mobile Phone" data-placement="top">Mobile Phone</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="mobilephone" name="mobilephone" placeholder="Mobile Phone" maxlength="100">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Email', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="email" class="custom-label email" data-toggle="tooltip" title="Email" data-placement="top">Email</label>
</div>
<div class="col-sm-8 ali">
<input type="email" class="form-control  form-control-sm" id="email" name="email" placeholder="Email">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Website', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="website" class="custom-label website" data-toggle="tooltip" title="Website" data-placement="top">Website</label>
</div>
<div class="col-sm-8 ali">
<input type="text" class="form-control  form-control-sm" id="website" name="website" placeholder="Website" maxlength="180">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Billing Address', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="customername" class="custom-label">Billing Address</label>
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstreet" id="area"  placeholder="Street">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcity" id="city" placeholder="City/Town">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Billing Address', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstate" id="state" placeholder="State">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="billpincode" id="pincode" min="0" placeholder="Pin">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcountry" id="country" placeholder="Country/Region">
</div>
</div>
</div>
</div>
</div>
<!-- <div class="row justify-content-center sameasbilling" id="sameasbilling">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-6">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" name="sameasbilling" id="sameasbilling" checked>
<label class="custom-control-label custom-label" for="sameasbilling"> Same as Billing Address</label>
</div>
</div>
</div>
</div>
</div>  -->
<!--     <div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" name="sameasbilling" id="sameasbilling" checked>
<label class="custom-control-label custom-label" for="sameasbilling" style="font-size:11px !important;"> Same as Billing Address</label>
</div> -->
<div class="row justify-content-center" <?=((in_array('Shipping Address', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="customername" class="custom-label" id="shipword">Shipping Address</label>
</div>
<div class="col-sm-8 shipadd" style="z-index:0;">
<div class="custom-control custom-checkbox" onclick="sameasbillingticaccess()">
<input type="checkbox" class="custom-control-input" name="sameasbilling" id="sameasbilling" checked>
<label class="custom-control-label custom-label" for="sameasbilling"> Same as Billing Address</label>
</div>
<!-- <div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstreet" id="area"  placeholder="Street" style="padding: 5px 8px;border-top: 1px solid #ced4da;border-radius: 0px;margin: 0px;font-size: 13.6px;border-bottom: 1px solid #ced4da;border-left: 1px solid #ced4da;border-right: 0px solid #ced4da;width: 145px !important;">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcity" id="city" placeholder="City/Town" style="padding: 5px 8px;border: 1px solid #ced4da;border-radius: 0px;margin: 0px;font-size: 13.6px;">
</div> -->
</div>
</div>
</div>
</div>
<div id="totalshipadd">
<div class="row justify-content-center" <?=((in_array('Shipping Address', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstreet" id="area"  placeholder="Street">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcity" id="city" placeholder="City/Town">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Shipping Address', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8">
<div class="input-group input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstate" id="state" placeholder="State">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="shippincode" id="pincode" min="0" placeholder="Pin">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcountry" id="country" placeholder="Country/Region">
</div>
</div>
</div>
</div>
</div>
</div>
<!---
<?php
if ($permissionvencode != '0') {
?>
<?php
if ($permissionvencodeadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="codeortags" class="custom-label" data-toggle="tooltip" title="Code or Tags" data-placement="top">Code/Tags </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="codeortags" name="codeortags" placeholder="Code or Tags">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusgenhead != '0') {
?>
<?php
if ($cusgenadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="gender" class="custom-label">Gender</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="gender" name="gender" placeholder="Gender">
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusagehead != '0') {
?>
<?php
if ($cusageadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="age" class="custom-label">Age</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="age" name="age" placeholder="Age">
</div>
</div>
</div>
</div>
<?php
}
}
?>-->
<!---
<?php
if ($cusmailhead != '0') {
?>
<?php
if ($cusmailadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="email" class="custom-label">Email</label>
</div>
<div class="col-sm-8">
<input type="email" class="form-control  form-control-sm" id="email" name="email" placeholder="Email">
</div>
</div>
</div>
</div>
<!-- </div> -->
<?php
}
}
?>
<!-- </div> -->
<!-- </div>
<?php
if ($cusphonehead != '0') {
?>
<?php
if ($cusphoneadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="phonenumber" class="custom-label">Phone Number</label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="phonenumber" name="phonenumber" placeholder="Phone Number">
</div>
</div>
<!-- <div class="row justify-content-center mt-1">
<div class="col-lg-6">
<div class="table-responsive" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
<table class="table table-bordered" id="purchasetable" style="color: #000000;font-size: 14px;">
<thead style="line-height: 9px;">
<tr><th style="color: black !important;"></th><th style="color: black !important;">PHONE NAME</th><th style="color: black !important;">PHONE NUMBER</th><th style="color: black !important;"></th></tr>
</thead>
<tbody>
<tr>
<td style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;" data-label=""><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc;margin-top: 10px;"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td style="" data-label="PHONE NAME"><input type="text" name="pnm[]" id="pnm"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" placeholder="Phone Name"></td>
<td style="" data-label="PHONE NUMBER"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" placeholder="Phone Number"></td>
<td style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;" data-label=""><a onclick="addclick()" style="cursor: pointer;"><svg style="width: 15px;" width="5" height="5" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-8">
<p style="margin-left:150px; padding:0">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cuswebhead != '0') {
?>
<?php
if ($cuswebadd != '0') {
?>
<div class="row justify-content-center">
<div class="col-lg-6" style="margin-left: 1px;">
<div class="form-group row">
<div class="col-sm-4">
<label for="website" class="custom-label">Website</label>
</div>
<div class="col-sm-8 web">
<input type="text" class="form-control  form-control-sm" id="website" name="website" placeholder="Website" >
</div>
</div>
<?php
}
}
?>
<?php
if ($cusbillhead != '0') {
?>
<?php
if ($cusbilladd != '0') {
?>
<div class="row" style="margin-left:1px;">
<div class="col-lg-12 baddress" style="height:48px;">
<div class="form-group row">
<div class="col-sm-4 p-0">
<label for="customername" class="custom-label">Billing Address</label>
</div>
<div class="col-sm-8" style="padding-left: 6px;">
<div class="input-group mb-3 input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstreet" id="area"  placeholder="Street" style="padding: 1.5px;border: 1px solid #ced4da;border-radius: 0px;">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcity" id="city" placeholder="City/Town" style="padding: 1.5px;border: 1px solid #ced4da;border-radius: 0px;">
</div>
</div>
</div>
</div>
<div class="row" style="margin-left: 1px;">
<div class="col-lg-12 baddress p-0" style="height:48px;">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8" style="padding-left: 5.4px;padding-right: 12.3px;">
<div class="input-group mb-3 input-group-sm">
<div class="input-group-prepend" style="margin-left:0px !important;">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billstate" id="state" placeholder="State" style="padding: 1.5px;border: 1px solid #ced4da;border-radius: 0px;">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="billpincode" id="pincode" min="0" placeholder="Pin" style="padding: 1.5px;border: 1px solid #ced4da;border-radius: 0px;">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="billcountry" id="country" placeholder="Country/Region" style="padding: 1.5px;border: 1px solid #ced4da;border-radius: 0px;">
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($cusshiphead != '0') {
?>
<?php
if ($cusshipadd != '0') {
?>
<div class="custom-control custom-checkbox mt-0 mb-3">
<input type="checkbox" class="custom-control-input" name="sameasbilling" id="sameasbilling" checked>
<label class="custom-control-label custom-label" for="sameasbilling"> Same as Billing Address</label>
</div>
<div class="row" style="margin-left:1px;">
<div class="col-lg-12 saddress" style="height:48px;">
<div class="form-group row">
<div class="col-sm-4 p-0">
<label for="customername" class="custom-label">Shipping Address</label>
</div>
<div class="col-sm-8" style="padding-left: 6px;">
<div class="input-group mb-3 input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstreet" id="street"  placeholder="Street" style="padding: 1.5px;border: 1px solid #ced4da;border-radius: 0px;">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcity" id="city" placeholder="City/Town" style="border: 1px solid #ced4da;border-radius: 0px;">
</div>
</div>
</div>
</div>
</div>
<div class="row" style="margin-left:1px;">
<div class="col-lg-12" style="height:48px;">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-8" style="padding-left: 6px;padding-right: 11px;">
<div class="input-group mb-3 input-group-sm">
<div class="input-group-prepend">
</div>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipstate" id="state" placeholder="State" style="padding: 1.5px;border: 1px solid #ced4da;border-radius: 0px;">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="shippincode" id="pincode" min="0" placeholder="Pin" style="padding: 1.5px;border: 1px solid #ced4da;border-radius: 0px;">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="shipcountry" id="country" placeholder="Country/Region" style="padding: 1.5px;border: 1px solid #ced4da;border-radius: 0px;">
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<div class="row">
<div class="col-lg-6" style="display:none">
<h6>Shipping Address <label><input type="checkbox" name="sameaddress" id="sameaddress" onchange="sameadd()" value="0"> Same as Billing Address</label></h6>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label>Door No. / House Name</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="saddress1" id="saddress1">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Street Name</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="saddress2" id="saddress2">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Area</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sarea" id="sarea">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>City</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="scity" id="scity">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>District</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sdistrict" id="sdistrict">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>State</label>
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="sstate" id="sstate">
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Pin Code</label>
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="spincode" id="spincode" min="0">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!------------->
<!-- </div> -->
<!-- <div class="form-group row">
<div class="col-lg-12" style="height:18px;">
<div class="form-group row">
<div class="col-sm-4">
<label for="billingadd" class="custom-label">Billing Address</label>
</div>
<div class="col-sm-5">
<input type="hidden" name="address1" id="address1">
<input type="hidden" name="address2" id="address2">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="area" id="area"  placeholder="Street" style="height: 21px;padding: 1.5px;width: 169px;">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="city" id="city" placeholder="City/Town" style="height: 21px;padding: 1.5px;margin-left: -54px;width: 169px;">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12" style="height:30px;">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="state" id="state" placeholder="State" style="height: 21px;padding: 1.5px;width: 120px;">
</div>
<div class="col-sm-2">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="pincode" id="pincode" min="0" placeholder="Pin" style="height: 21px;padding: 1.5px;width: 72px;margin-left: -10px;">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="district" id="district" placeholder="Country/Region" style="height: 21px;padding: 1.5px;margin-left: -23.5px;width: 140px;">
</div>
</div>
</div>
</div>
<div class="form-group row">
<div class="col-lg-12" style="height:18px;">
<div class="form-group row">
<div class="col-sm-4">
<label for="shippingadd" class="custom-label">Shipping Address </label>
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" name="sameasbilling" id="sameasbilling" checked>
<label class="custom-control-label custom-label" for="sameasbilling"> Same as Billing Address</label>
</div>
</div>
<div class="col-sm-5">
<input type="hidden" name="address1" id="address1">
<input type="hidden" name="address2" id="address2">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="area" id="area"  placeholder="Street" style="height: 21px;padding: 1.5px;width: 169px;">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="city" id="city" placeholder="City/Town" style="height: 21px;padding: 1.5px;margin-left: -54px;width: 169px;">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12" style="height:18px;">
<div class="form-group row">
<div class="col-sm-4">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="state" id="state" placeholder="State" style="height: 21px;padding: 1.5px;width: 120px;">
</div>
<div class="col-sm-2">
<input type="number" autocomplete="off" class="form-control  form-control-sm" name="pincode" id="pincode" min="0" placeholder="Pin" style="height: 21px;padding: 1.5px;width: 72px;margin-left: -10px;">
</div>
<div class="col-sm-3">
<input type="text" autocomplete="off"  class="form-control  form-control-sm" name="district" id="district" placeholder="Country/Region" style="height: 21px;padding: 1.5px;margin-left: -23.5px;width: 140px;">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>-->
</div>
</div>
</div>
</div>
<?php
// }
?>
<div class="accordion" id="accordionRental" <?=((in_array('Customers Visibility', $fieldadd))?'':'style="display:none;"')?>>
<div class="accordion-item mb-1 pvi">
<h5 class="accordion-header" id="headingfour">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#custcollapsefour"
aria-expanded="true" aria-controls="custcollapsefour">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading"><?= $infomainaccessuser['modulename'] ?> Visibility</a>
</div>
</button>
</h5>
<div id="custcollapsefour" class="accordion-collapse collapse show"
aria-labelledby="headingfour">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="custom-label mt-2 text-danger cusvis">Visibility * <svg data-toggle="tooltip" title="Visibility" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
</svg></label>
</div>
<div class="col-sm-8">
<div class="row">
<div class="col-sm-6 my-1">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="visibilityc" id="visibility" value="PUBLIC" <?=($infomainaccessuser['customervisible']=='PUBLIC')?'checked':''?>>
<label class="custom-control-label custom-label" for="visibility">Public</label>
</div>
</div>
<div class="col-sm-6 my-1">
<div class="custom-control custom-radio mr-sm-2">
<input type="radio" class="custom-control-input" name="visibilityc" id="novisibility" value="PRIVATE" <?=($infomainaccessuser['customervisible']=='PRIVATE')?'checked':''?>>
<label class="custom-control-label custom-label" for="novisibility">Private</label>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="accordion-item mb-1" <?=((in_array('Tax Information', $fieldadd))?'':'style="display:none;"')?>>
<h5 class="accordion-header" id="headingFive">
<button class="accordion-button font-weight-bold" type="button"
data-bs-toggle="collapse" data-bs-target="#custcollapseFive"
aria-expanded="true" aria-controls="custcollapseFive">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Tax
Information</a>
</div>
</button>
</h5>
<div id="custcollapseFive" class="accordion-collapse collapse show"
aria-labelledby="headingFive">
<div class="accordion-body text-sm">
<!-- <div class="row justify-content-center">
<div class="col-sm-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="inlineRadio3">Exemption Reason</label>
</div>
<div class="col-sm-8">
<select class="form-control  form-control-sm">
<option>Select Type of Add</option>
</select>
</div>
</div>
</div>
</div> -->
<div class="row justify-content-center" <?=((in_array('Tax Preference', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label taxpre" for="inlineRadio3">Tax Preference*</label>
</div>
<div class="col-sm-8">
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio"
name="taxpref" id="taxpreftaxable" value="0" checked
onclick="gettaxable()">
<label class="form-check-label"
for="taxpreftaxable">Taxable</label>
</div>
<!-- <div class="form-check form-check-inline">
<input class="form-check-input" type="radio"
name="taxpref" id="taxprefnontaxable" value="1"
onclick="gettaxable()">
<label class="form-check-label" for="taxprefnontaxable">Non
Taxable</label>
</div> -->
</div>
</div>
</div>
</div>
<div id="gstrtypesh" <?=((in_array('GST Registration Type', $fieldadd))?'':'style="display:none;"')?>>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label text-danger" for="inlineRadio3">GST Registration Type *</label>
</div>
<div class="col-sm-8">
<select class="selectpicker form-control select2" data-live-search="true" title="Search title or description..." onchange="showDiv(this)" id="myBtn" name="gstrtype" <?=((in_array('GST Registration Type', $fieldadd))?'required':'')?>>
<option <?=($infomainaccessuser['gsttypecus']=='manual')?'selected':'';?> value="" data-foo="Select Type of Add" disabled>Select Type of Add</option>

                                                                                    <option data-foo="Business that is registered under GST" value="Registered Business - Regular" <?=($infomainaccessuser['gsttypecus']=='Registered Business - Regular')?'selected':'';?>>Registered Business - Regular</option>

                                                                                    <option data-foo="Business that is registered under the Composition Scheme in GST" value="Registered Business - Composition" <?=($infomainaccessuser['gsttypecus']=='Registered Business - Composition')?'selected':'';?>>Registered Business - Composition</option>

                                                                                    <option data-foo="Business that has not been registered under GST" value="Unregistered Business" <?=($infomainaccessuser['gsttypecus']=='Unregistered Business')?'selected':'';?>>Unregistered Business</option>

                                                                                    <option data-foo="A customer who is a regular consumer" value="Consumer" <?=($infomainaccessuser['gsttypecus']=='Consumer')?'selected':'';?>>Consumer</option>

                                                                                    <option data-foo="Persons with whom you do import or export of supplies outside India" value="Overseas" <?=($infomainaccessuser['gsttypecus']=='Overseas')?'selected':'';?>>Overseas</option>

                                                                                    <option data-foo="Business (Unit) that is located in a Special Economic Zone (SEZ) of India or a SEZ Developer" value="Special Economic Zone" <?=($infomainaccessuser['gsttypecus']=='Special Economic Zone')?'selected':'';?>>Special Economic Zone</option>

                                                                                    <option data-foo="Supply of goods to an Export Oriented Unit or against Advanced Authorization / Export Promotion Capital Goods" value="Deemed Export" <?=($infomainaccessuser['gsttypecus']=='Deemed Export')?'selected':'';?>>Deemed Export</option>

                                                                                    <option data-foo="Departments of the State / Central government, government agencies or local authorities" value="Tax Deductor" <?=($infomainaccessuser['gsttypecus']=='Tax Deductor')?'selected':'';?>>Tax Deductor</option>

                                                                                    <option data-foo="A person / organisation who owns at least 26% of the equity in creating business units in a Special Economic Zone (SEZ)" value="SEZ Developer" <?=($infomainaccessuser['gsttypecus']=='SEZ Developer')?'selected':'';?>>SEZ Developer</option>
</select>
</div>
</div>
</div>
</div>
<div id="gstblock">
<div class="row justify-content-center" <?=((in_array('GSTIN or UIN', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label text-danger" for="gstin">GSTIN / UIN *</label>
</div>
<div class="col-sm-8">
<input type="text" name="gstin" placeholder="GSTIN / UIN" id="gstin" class="form-control form-control-sm">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Business Legal Name', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="bln">Business Legal Name</label>
</div>
<div class="col-sm-8">
<input type="text" name="bln" placeholder="Business Legal Name" id="bln" class="form-control  form-control-sm">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Business Trade Name', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="btname">Business Trade Name</label>
</div>
<div class="col-sm-8">
<input type="text" name="btname" placeholder="Business Trade Name" id="btname" class="form-control  form-control-sm">
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('Pan', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="pan">PAN</label>
</div>
<div class="col-sm-8">
<input type="text" name="pan" placeholder="PAN" id="pan" class="form-control  form-control-sm">
</div>
</div>
</div>
</div>
<div id="placeofsupply">
<div class="row justify-content-center" <?=((in_array('Place Of Supply', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label text-danger" for="pos">Place Of Supply *</label>
</div>
<div class="col-sm-8">
<select name="pos" id="pos" class="select4 form-control form-control-sm" <?=((in_array('Place Of Supply', $fieldadd))?'required':'')?>>
<option disabled value="" <?=($infomainaccessuser['placeofsupplydefaultcus']=='manual'||'auto')?'selected':''?>>Select The Place</option> 
<option value="JAMMU AND KASHMIR (1)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="JAMMU AND KASHMIR (1)")?'selected':''?>>JAMMU AND KASHMIR (1)</option>
<option value="ANDAMAN AND NICOBAR ISLANDS (35)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="ANDAMAN AND NICOBAR ISLANDS (35)")?'selected':''?>>ANDAMAN AND NICOBAR ISLANDS (35)</option>
<option value="ANDHRA PRADESH (NEWLY ADDED) (37)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="ANDHRA PRADESH (NEWLY ADDED) (37)")?'selected':''?>>ANDHRA PRADESH (NEWLY ADDED) (37)</option>
<option value="ANDHRA PRADESH(BEFORE DIVISION) (28)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="ANDHRA PRADESH(BEFORE DIVISION) (28)")?'selected':''?>>ANDHRA PRADESH(BEFORE DIVISION) (28)</option>
<option value="ARUNACHAL PRADESH (12)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="ARUNACHAL PRADESH (12)")?'selected':''?>>ARUNACHAL PRADESH (12)</option>
<option value="ASSAM (18)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="ASSAM (18)")?'selected':''?>>ASSAM (18)</option>
<option value="BIHAR (10)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="BIHAR (10)")?'selected':''?>>BIHAR (10)</option>
<option value="CENTRE JURISDICTION (99)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="CENTRE JURISDICTION (99)")?'selected':''?>>CENTRE JURISDICTION (99)</option>
<option value="CHANDIGARH (4)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="CHANDIGARH (4)")?'selected':''?>>CHANDIGARH (4)</option>
<option value="CHATTISGARH (22)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="CHATTISGARH (22)")?'selected':''?>>CHATTISGARH (22)</option>
<option value="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)")?'selected':''?>>DADRA AND NAGAR HAVELI AND DAMAN AND DIU (NEWLY MERGED UT) (26*)</option>
<option value="DELHI (7)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="DELHI (7)")?'selected':''?>>DELHI (7)</option>
<option value="GOA (30)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="GOA (30)")?'selected':''?>>GOA (30)</option>
<option value="GUJARAT (24)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="GUJARAT (24)")?'selected':''?>>GUJARAT (24)</option>
<option value="HARYANA (6)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="HARYANA (6)")?'selected':''?>>HARYANA (6)</option>
<option value="HIMACHAL PRADESH (2)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="HIMACHAL PRADESH (2)")?'selected':''?>>HIMACHAL PRADESH (2)</option>
<option value="JHARKHAND (20)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="JHARKHAND (20)")?'selected':''?>>JHARKHAND (20)</option>
<option value="KARNATAKA (29)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="KARNATAKA (29)")?'selected':''?>>KARNATAKA (29)</option>
<option value="KERALA (32)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="KERALA (32)")?'selected':''?>>KERALA (32)</option>
<option value="LADAKH (NEWLY ADDED) (38)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="LADAKH (NEWLY ADDED) (38)")?'selected':''?>>LADAKH (NEWLY ADDED) (38)</option>
<option value="LAKSHADWEEP (31)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="LAKSHADWEEP (31)")?'selected':''?>>LAKSHADWEEP (31)</option>
<option value="MADHYA PRADESH (23)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="MADHYA PRADESH (23)")?'selected':''?>>MADHYA PRADESH (23)</option>
<option value="MAHARASHTRA (27)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="MAHARASHTRA (27)")?'selected':''?>>MAHARASHTRA (27)</option>
<option value="MANIPUR (14)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="MANIPUR (14)")?'selected':''?>>MANIPUR (14)</option>
<option value="MEGHALAYA (17)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="MEGHALAYA (17)")?'selected':''?>>MEGHALAYA (17)</option>
<option value="MIZORAM (15)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="MIZORAM (15)")?'selected':''?>>MIZORAM (15)</option>
<option value="NAGALAND (13)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="NAGALAND (13)")?'selected':''?>>NAGALAND (13)</option>
<option value="ODISHA (21)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="ODISHA (21)")?'selected':''?>>ODISHA (21)</option>
<option value="OTHER TERRITORY (97)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="OTHER TERRITORY (97)")?'selected':''?>>OTHER TERRITORY (97)</option>
<option value="PUDUCHERRY (34)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="PUDUCHERRY (34)")?'selected':''?>>PUDUCHERRY (34)</option>
<option value="PUNJAB (3)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="PUNJAB (3)")?'selected':''?>>PUNJAB (3)</option>
<option value="RAJASTHAN (8)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="RAJASTHAN (8)")?'selected':''?>>RAJASTHAN (8)</option>
<option value="SIKKIM (11)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="SIKKIM (11)")?'selected':''?>>SIKKIM (11)</option>
<option value="TAMIL NADU (33)"  <?=($infomainaccessuser['placeofsupplydefaultcus']=="TAMIL NADU (33)")?'selected':''?>>TAMIL NADU (33)</option>
<option value="TELANGANA (36)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="TELANGANA (36)")?'selected':''?>>TELANGANA (36)</option>
<option value="TRIPURA (16)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="TRIPURA (16)")?'selected':''?>>TRIPURA (16)</option>
<option value="UTTAR PRADESH (9)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="UTTAR PRADESH (9)")?'selected':''?>>UTTAR PRADESH (9)</option>
<option value="UTTARAKHAND (5)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="UTTARAKHAND (5)")?'selected':''?>>UTTARAKHAND (5)</option>
<option value="WEST BENGAL (19)" <?=($infomainaccessuser['placeofsupplydefaultcus']=="WEST BENGAL (19)")?'selected':''?>>WEST BENGAL (19)</option>
</select>
</div>
</div>
</div>
</div>
</div>
<!-- <div class="row justify-content-center">
<div class="col-sm-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="inlineRadio3"
style="color: #ee0000;">Tax Preference*</label>
</div>
<div class="col-sm-8">
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio"
name="taxpref" id="taxpreftaxable" value="0" checked
onchange="gettaxable()">
<label class="form-check-label"
for="taxpreftaxable">Taxable</label>
</div>
<div class="form-check form-check-inline">
<input class="form-check-input" type="radio"
name="taxpref" id="taxprefnontaxable" value="1"
onchange="gettaxable()">
<label class="form-check-label" for="taxprefnontaxable">Non
Taxable</label>
</div>
</div>
</div>
</div>
</div> -->
</div>
<!-- <div class="row justify-content-center">
<div class="col-sm-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="inlineRadio3">Currency</label>
</div>
<div class="col-sm-8">
<div class="input-group mb-3 input-group-sm">
<div class="input-group-prepend">
<span class="input-group-text" style="color: #495057;padding: 8px 4.5px;height:21px;border: none !important;">₹</span>
</div>
<input type="age" min="0" name="quantity[]"  id="quantity1" class="form-control form-control-sm bordernoneinput bor" style="height:21px;width: 24px;text-align: right;padding: 0px;border-radius: 0px;border-left: 1px solid #ced4da;" onChange="productcalc(1)">
</div>
</div>
</div>
</div>
<div class="row justify-content-center mt-1">
<div class="col-lg-6">
<div class="table-responsive" style="margin-left: 0%;margin-right: 0%;">
<table class="table table-bordered" id="purchasetable">
<thead style="color: #000000;font-size: 14px;">
<tr><td></td><td>PHONE NAME</td><td>PHONE NUMBER</td><td></td></tr>
</thead>
<tbody>
<tr>
<td data-label="" style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc;margin-top: 10px;"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="PHONE NAME"><input type="text" name="pnm[]" id="pnm"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="Phone Name"></td>
<td data-label="PHONE NUMBER"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="Phone Number"></td>
<td data-label="" style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;"><a onclick="addclick()" style="cursor: pointer;"><svg style="width: 15px;" width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-8">
<p style="margin-left:150px; padding:0">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
</div>
</div>
</div> -->
<!--
<div class="row justify-content-center">
<div class="col-sm-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="inlineRadio3">Payment Terms</label>
</div>
<div class="col-sm-8">
<select class="form-control  form-control-sm">
<option>Due On Recipts</option>
</select>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-sm-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="inlineRadio3">Price List</label>
</div>
<div class="col-sm-8">
<select class="form-control  form-control-sm">
<option>Price</option>
</select>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-sm-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="inlineRadio3">Enable Portal</label>
</div>
<div class="col-sm-8">
<div class="custom-control custom-checkbox">
<input type="checkbox" class="custom-control-input" name="enablep" id="enablep" checked>
<label class="custom-control-label custom-label" for="enablep"> Allow Portal Access For Their Customer<br>(Email Address is Mondatry)</label>
</div>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-sm-6">
<div class="form-group row">
<div class="col-sm-4">
<label class="form-check-label" for="inlineRadio3">Portal Language</label>
</div>
<div class="col-sm-8">
<select class="form-control  form-control-sm">
<option>English</option>
</select>
</div>
</div>
</div>
</div>-->
<!-- <div class="row justify-content-center"> -->
<!-- <div class="col-lg-6">
<label class="form-check-label mb-1" for="inlineRadio3">Contact Person : </label>
<div class="table-responsive" style="margin-left: 0%;margin-right: 0%;">
<table class="table table-bordered" id="purchasetable">
<thead>
<tr><td></td><td>SATUATION</td><td>DESIGNATION</td><td>FIRST NAME</td><td>LAST NAME</td><td>EMAIL ADDRESS</td><td>WORK PLACE</td><td>MOBILE PHONE</td><td></td></tr>
</thead>
<tbody>
<tr>
<td style="padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px;" data-label=""><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc;margin-top: 10px;"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td>
<td data-label="SATUATION"><input type="text" name="pnm[]" id="pnm"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="SATUATION"></td>
<td data-label="DESIGNATION"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="DESIGNATION"></td>
<td data-label="FIRST NAME"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="FIRST NAME"></td>
<td data-label="LAST NAME"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="LAST NAME"></td>
<td data-label="EMAIL ADDRESS"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="EMAIL ADDRESS"></td>
<td data-label="WORK PLACE"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="WORK PLACE"></td>
<td data-label="MOBILE PHONE"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="MOBILE PHONE"></td>
<td data-label="" style="padding-top: 0px;padding-left: 3px;padding-right: 3px;padding-bottom: 0px;"><a onclick="addclick()" style="cursor: pointer;"><svg style="width: 15px;" width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>
</tr>
</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-8">
<p style="margin-left:140px; padding:0">
<a class="purchaseadd-row btn btn-primary btn-sm btn-custom-grey addan" style="background-color: #e9ecef;height: 27px;padding-left: 4.5px;padding-right: 4.5px;position: relative;left: -157px;"><span style="position: relative;top: -3px;"><i style="font-size: 14px;color:#0066cc" class="fa fa-plus-circle"></i> Add another line </span></a></p>
</div>
</div>
<!-- </div> -->
<!-- </div>
<div class="row justify-content-center">
<div class="col-sm-6">
<label class="form-check-label mb-1" for="inlineRadio3">Notes (For Internal Use) : </label>
<br>
<textarea class="form-control  form-control-sm" style="height:60px;"></textarea>
</div>
</div>
</div>
</div>
</div>
</div>-->
<div class="accordion" id="accordionRental" style="margin-top: 15px; <?=((in_array('Other Information', $fieldadd))?'':'display:none;')?>">
<div class="accordion-item mb-1">
<h5 class="accordion-header" id="custothercollapses">
<button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#custothercollapse" aria-expanded="true" aria-controls="custothercollapse">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading">Other Information</a>
</div>
</button>
</h5>
<div id="custothercollapse" class="accordion-collapse collapse show" aria-labelledby="custothercollapses">
<div class="accordion-body text-sm">
<div class="row justify-content-center" <?=((in_array('DL dot No dot or 20', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="dlt" class="custom-label" data-toggle="tooltip" title="DL.NO./20" data-placement="top">DL.NO./20 </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="dlt" name="dlt" placeholder="DL.NO./20">
</div>
</div>
</div>
</div>
<div class="row justify-content-center" <?=((in_array('DL dot No dot or 21', $fieldadd))?'':'style="display:none;"')?>>
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="dlo" class="custom-label" data-toggle="tooltip" title="DL.NO./21" data-placement="top">DL.NO./21 </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="dlo" name="dlo" placeholder="DL.NO./21">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!--
<?php
if ($permissioncuspayinfo != '0') {
?>
<?php
if ($permissioncuspayadd != '0') {
?>
<div class="accordion-item mb-1 pvi">
<h5 class="accordion-header" id="otherinfo">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#collapsepaydet"
aria-expanded="true" aria-controls="collapsepaydet">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading" style="font-size: 18px;">Payment Informations</a>
</div>
</button>
</h5>
<div id="collapsepaydet" class="accordion-collapse collapse show"
aria-labelledby="otherinfo">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="bank" class="custom-label" data-toggle="tooltip" title="Bank" data-placement="top">Bank </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="bank" name="bank" placeholder="Bank">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="acname" class="custom-label" data-toggle="tooltip" title="Account Name" data-placement="top">Account Name </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="acname" name="acname" placeholder="Account Name">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="sortcode" class="custom-label" data-toggle="tooltip" title="Sort Code" data-placement="top">Sort Code </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="sortcode" name="sortcode" placeholder="Sort Code">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="acnumber" class="custom-label" data-toggle="tooltip" title="Account Number" data-placement="top">Account Number </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="acnumber" name="acnumber" placeholder="Account Number">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="ifsc" class="custom-label" data-toggle="tooltip" title="IFSC" data-placement="top">IFSC </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="ifsc" name="ifsc" placeholder="IFSC">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="branch" class="custom-label" data-toggle="tooltip" title="Branch" data-placement="top">Branch </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="branch" name="branch" placeholder="Branch">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="bic" class="custom-label" data-toggle="tooltip" title="BIC/Swift" data-placement="top">BIC/Swift </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="bic" name="bic" placeholder="BIC/Swift">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="iban" class="custom-label" data-toggle="tooltip" title="IBAN" data-placement="top">IBAN </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="iban" name="iban" placeholder="IBAN">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($permissioncusbankinfo != '0') {
?>
<?php
if ($permissioncusbankadd != '0') {
?>
<div class="accordion-item mb-1 pvi">
<h5 class="accordion-header" id="otherinfo">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#collapsebank"
aria-expanded="true" aria-controls="collapsebank">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading" style="font-size: 18px;">Bank Details</a>
</div>
</button>
</h5>
<div id="collapsebank" class="accordion-collapse collapse show"
aria-labelledby="otherinfo">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="bank" class="custom-label" data-toggle="tooltip" title="Bank" data-placement="top">Bank </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="bank" name="bank" placeholder="Bank">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="acname" class="custom-label" data-toggle="tooltip" title="Account Name" data-placement="top">Account Name </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="acname" name="acname" placeholder="Account Name">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="sortcode" class="custom-label" data-toggle="tooltip" title="Sort Code" data-placement="top">Sort Code </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="sortcode" name="sortcode" placeholder="Sort Code">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="acnumber" class="custom-label" data-toggle="tooltip" title="Account Number" data-placement="top">Account Number </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="acnumber" name="acnumber" placeholder="Account Number">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="ifsc" class="custom-label" data-toggle="tooltip" title="IFSC" data-placement="top">IFSC </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="ifsc" name="ifsc" placeholder="IFSC">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="branch" class="custom-label" data-toggle="tooltip" title="Branch" data-placement="top">Branch </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="branch" name="branch" placeholder="Branch">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="bic" class="custom-label" data-toggle="tooltip" title="BIC/Swift" data-placement="top">BIC/Swift </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="bic" name="bic" placeholder="BIC/Swift">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="iban" class="custom-label" data-toggle="tooltip" title="IBAN" data-placement="top">IBAN </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="iban" name="iban" placeholder="IBAN">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($permissioncusothinfo != '0') {
?>
<?php
if ($permissioncusothadd != '0') {
?>
<div class="accordion-item mb-1 pvi">
<h5 class="accordion-header" id="otherinfo">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#collapseother"
aria-expanded="true" aria-controls="collapseother">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading" style="font-size: 18px;">Other Informations</a>
</div>
</button>
</h5>
<div id="collapseother" class="accordion-collapse collapse show"
aria-labelledby="otherinfo">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="dlt" class="custom-label" data-toggle="tooltip" title="DL.NO./20" data-placement="top">DL.NO./20 </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="dlt" name="dlt" placeholder="DL.NO./20">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="dlo" class="custom-label" data-toggle="tooltip" title="DL.NO./21" data-placement="top">DL.NO./21 </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="dlo" name="dlo" placeholder="DL.NO./21">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="salediscount" class="custom-label" data-toggle="tooltip" title="Sale Discount" data-placement="top">Sale Discount </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="salediscount" name="salediscount" placeholder="Sale Discount">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="codeortags" class="custom-label" data-toggle="tooltip" title="Code or Tags" data-placement="top">Code/Tags </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="codeortags" name="codeortags" placeholder="Code or Tags">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="codeortags" class="custom-label" data-toggle="tooltip" title="Code or Tags" data-placement="top">Code/Tags </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="codeortags" name="codeortags" placeholder="Code or Tags">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
?>
<?php
if ($permissioncusattinfo != '0') {
?>
<?php
if ($permissioncusattadd != '0') {
?>
<div class="accordion-item mb-1 pvi">
<h5 class="accordion-header" id="otherinfo">
<button class="accordion-button" type="button"
data-bs-toggle="collapse" data-bs-target="#collapseattach"
aria-expanded="true" aria-controls="collapseattach">
<div class="customcont-header ml-0 mb-1">
<a class="customcont-heading" style="font-size: 18px;">Attachment</a>
</div>
</button>
</h5>
<div id="collapseattach" class="accordion-collapse collapse show"
aria-labelledby="otherinfo">
<div class="accordion-body text-sm">
<div class="text-sm opacity-8">
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="bank" class="custom-label" data-toggle="tooltip" title="Bank" data-placement="top">Bank </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="bank" name="bank" placeholder="Bank">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="acname" class="custom-label" data-toggle="tooltip" title="Account Name" data-placement="top">Account Name </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="acname" name="acname" placeholder="Account Name">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="sortcode" class="custom-label" data-toggle="tooltip" title="Sort Code" data-placement="top">Sort Code </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="sortcode" name="sortcode" placeholder="Sort Code">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="acnumber" class="custom-label" data-toggle="tooltip" title="Account Number" data-placement="top">Account Number </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="acnumber" name="acnumber" placeholder="Account Number">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="ifsc" class="custom-label" data-toggle="tooltip" title="IFSC" data-placement="top">IFSC </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="ifsc" name="ifsc" placeholder="IFSC">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="branch" class="custom-label" data-toggle="tooltip" title="Branch" data-placement="top">Branch </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="branch" name="branch" placeholder="Branch">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="bic" class="custom-label" data-toggle="tooltip" title="BIC/Swift" data-placement="top">BIC/Swift </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="bic" name="bic" placeholder="BIC/Swift">
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
<div class="col-lg-6">
<div class="form-group row">
<div class="col-sm-4">
<label for="iban" class="custom-label" data-toggle="tooltip" title="IBAN" data-placement="top">IBAN </label>
</div>
<div class="col-sm-8">
<input type="text" class="form-control  form-control-sm" id="iban" name="iban" placeholder="IBAN">
</div>
</div>
</div>
</div>-->

<?php
}
}
?>
<!-- <div class="row justify-content-center" style="margin-bottom: -14px;">
<div class="col-lg-12"><hr>
<button name="submit"
class="btn btn-primary btn-sm btn-custom arlina-button expand-left"
type="submit" id="submittableview" value="Submit"
style="margin-bottom: 15px;">
<span class="label">Save</span> <span
class="spinner"></span>
</button>  <a class="btn btn-primary btn-sm btn-custom-grey" href="vendors.php">Cancel</a>
</div>
</div> -->



</div>
</div>
<?php
include ('navbottom.php');
?>
<?php
}
?>
</form>
</div>
</div>
<?php
include ('footer.php');
?>
</div>
</main>
<!-- subtext -->
<script type="text/javascript">
$(function(){
$(".select2").select2({
matcher: matchCustom,
templateResult: formatCustom
});
})
function stringMatch(term, candidate) {
return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustom(params, data) {
// If there are no search terms, return all of the data
if ($.trim(params.term) === '') {
return data;
}
// Do not display the item if there is no 'text' property
if (typeof data.text === 'undefined') {
return null;
}
// Match text of option
if (stringMatch(params.term, data.text)) {
return data;
}
// Match attribute "data-foo" of option
if (stringMatch(params.term, $(data.element).attr('data-foo'))) {
return data;
}
// Return `null` if the term should not be displayed
return null;
}
function formatCustom(state) {
return $(
'<div><div>' + state.text + '</div><div class="foo">'
+ $(state.element).attr('data-foo')
+ '</div></div>'
);
}
</script>
<?php
include ('fexternals.php');
?>
<!--alert-->
<!--salutation-->
<script type="text/javascript">
$("#salute").click(function(){
document.getElementById('drpsalute').classList.toggle("dropdownsalute");
});
</script>
<!-- cat -->
<script type="text/javascript">
function andun() {
$(".select2-container--open .select2-dropdown--above").hide();
$(".select2-container--open .select2-dropdown--below").hide();
}
function andus() {
$(".select2-container--open .select2-dropdown--above").show();
$(".select2-container--open .select2-dropdown--below").show();
}
</script>
<!-- same as bill -->
<script type="text/javascript">
function sameasbillingticaccess() {
let showorhide = document.getElementById('sameasbilling');
if (showorhide.checked==true) {
document.getElementById('totalshipadd').style.display = 'none';
}
else{
document.getElementById('totalshipadd').style.display = 'block';
}
}
$(document).ready(function() {
let showorhide = document.getElementById('sameasbilling');
if (showorhide.checked==true) {
document.getElementById('totalshipadd').style.display = 'none';
}
else{
document.getElementById('totalshipadd').style.display = 'block';
}
});
</script>
<!-- gstrtype -->
<script type="text/javascript">
$(document).ready(function() {
let noaccess = document.getElementById('taxprefnontaxable');
let access = document.getElementById('taxpreftaxable');
if (noaccess.checked == true) {
document.getElementById('gstrtypesh').style.display='none';
}
if (access.checked == true) {
document.getElementById('gstrtypesh').style.display='block';
}
});
function gettaxable(){
let noaccess = document.getElementById('taxprefnontaxable');
let access = document.getElementById('taxpreftaxable');
if (noaccess.checked == true) {
document.getElementById('gstrtypesh').style.display='none';
}
else{
document.getElementById('gstrtypesh').style.display='block';
}
}
</script>
<script type="text/javascript">
function showDiv(element)
{
if (element.value == '') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
// $("#gstin").attr("required","required");
}
else if (element.value == 'Registered Business - Regular') {
document.getElementById('gstblock').style.display = 'block';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Registered Business - Composition') {
document.getElementById('gstblock').style.display = 'block';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Unregistered Business') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Consumer') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Overseas') {
document.getElementById('placeofsupply').style.display = 'none';
document.getElementById('gstblock').style.display = 'none';
$("#pos").removeAttr("required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Special Economic Zone') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Deemed Export') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Tax Deductor') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'SEZ Developer') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
}
</script>
<script type="text/javascript">
<?php
if(in_array('GST Registration Type', $fieldadd)){
?>
$(document).ready(function () {
                                                                                   let element=document.getElementById('myBtn');
                                                                                   if (element.value == '') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
// $("#gstin").attr("required","required");
}
else if (element.value == 'Registered Business - Regular') {
document.getElementById('gstblock').style.display = 'block';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Registered Business - Composition') {
document.getElementById('gstblock').style.display = 'block';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Unregistered Business') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Consumer') {
document.getElementById('gstblock').style.display = 'none';
document.getElementById('placeofsupply').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Overseas') {
document.getElementById('placeofsupply').style.display = 'none';
document.getElementById('gstblock').style.display = 'none';
$("#pos").removeAttr("required");
$("#gstin").removeAttr("required");
}
else if (element.value == 'Special Economic Zone') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Deemed Export') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'Tax Deductor') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
else if (element.value == 'SEZ Developer') {
document.getElementById('placeofsupply').style.display = 'block';
document.getElementById('gstblock').style.display = 'block';
$("#pos").attr("required","required");
$("#gstin").attr("required","required");
}
});
<?php
}
?>
</script>
<!-- cat -->
<script>
$("#category").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewCategory') {
$('#AddNewCategory').modal('show');
}
});
$("#subcategory").on("change", function() {
var sOptionVal = $(this).val();
if (sOptionVal == '#AddNewSubCategory') {
$('#AddNewSubCategory').modal('show');
}
});
</script>
<script>
function funaddcategory() {
var missingcategory = document.getElementById('missingcategory');
if (missingcategory.value == '') {
alert('Please Enter New Category Name');
missingcategory.focus();
return false;
} else {
$('#category').append('<option value="' + missingcategory.value + '">' + missingcategory.value +
'</option>');
$('#category').val(missingcategory.value).change();
$('#AddNewCategory').modal('hide');
return false;
}
}
function funescategory() {
$('#category').val('').change();
$('#AddNewCategory').modal('hide');
return false;
}
</script>
<!-- subcat -->
<script>
function funaddsubcategory() {
var missingsubcategory = document.getElementById('missingsubcategory');
if (missingsubcategory.value == '') {
alert('Please Enter New Sub Category Name');
missingsubcategory.focus();
return false;
} else {
$('#subcategory').append('<option value="' + missingsubcategory.value + '">' + missingsubcategory.value +
'</option>');
$('#subcategory').val(missingsubcategory.value).change();
$('#AddNewSubCategory').modal('hide');
return false;
}
}
function funessubcategory() {
$('#subcategory').val('').change();
$('#AddNewSubCategory').modal('hide');
return false;
}
</script>
<!-- unit cat subcat select modal design -->
<script>
$("#myBtn").on("select2:open", function() {
$("#configureunits").hide();
});
$("#pos").on("select2:open", function() {
$("#configureunits").hide();
});
$("#subcategory").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewSubCategory");
});
$("#subcategory").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Sub Category";
});
$("#category").on("select2:open", function() {
$("#configureunits").attr("data-bs-target","#AddNewCategory");
});
$("#category").on("select2:open", function() {
document.getElementById("configureunits").innerHTML = "New Category";
});
</script>
<!-- unit -->
<script type="text/javascript">
$(function() {
$( "#unitname" ).autocomplete({
source: 'unitsearch.php?type=unitname',
});
});
</script>
<!-- sve button spinner -->
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
<!-- purchase table add another row -->
<script>
let lineNo = 2;
$(document).ready(function() {
$(".purchaseadd-row").click(function() {
markup =
'<tr><td><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon icon-drag align-text-bottom" style="color:#cccccc"><circle cx="153.6" cy="451" r="61"></circle><circle cx="153.6" cy="256" r="61"></circle><circle cx="153.6" cy="61" r="61"></circle><circle cx="358.4" cy="256" r="61"></circle><circle cx="358.4" cy="61" r="61"></circle><circle cx="358.4" cy="451" r="61"></circle></svg></td><td><input type="text" name="pnm[]" id="pnm' +
lineNo +
'"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="Phone Name"><td style="width:18%;"><input type="text" name="pno[]" id="pno"  class="form-control form-control-sm bordernoneinput bor pna" style="height:21px;padding: 0px;" oninput="titles(this)" data-toggle="tooltip" title="" placeholder="Phone Number"></td><td><a onclick="addclick()" style="cursor: pointer;"><svg width="512" height="512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="icon icon-sm text-blue"><path d="M162 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M256 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32M350 224c17.7 0 32 14.3 32 32s-14.3 32-32 32-32-14.3-32-32 14.3-32 32-32" id="Path"></path><path d="M256 480c123.712 0 224-100.288 224-224S379.712 32 256 32 32 132.288 32 256s100.288 224 224 224zm0 32C114.615 512 0 397.385 0 256S114.615 0 256 0s256 114.615 256 256-114.615 256-256 256z" id="Oval-1"></path></svg> </a><a class="btn-delete" style="cursor:pointer"><img src="assets/img/delete-row.png" width="15" height="15" style="border-radius: 10px;"></a></td>';
tableBody = $("#purchasetable");
tableBody.append(markup);
renumber_table('#purchasetable');
lineNo++;
});
});
$('table').on('click','.btn-delete',function() {
tableID = '#' + $(this).closest('table').attr('id');
var x = document.getElementById("purchasetable").rows.length;
if(x!=2)
{
r = confirm('Delete this item?');
if(r) {
$(this).closest('tr').remove();
renumber_table(tableID);
}
}
else
{
alert('Unable to Delete First row');
}
});
function renumber_table(tableID) {
$(tableID + " tr").each(function() {
count = $(this).parent().children().index($(this)) + 1;
$(this).find('.priority').html(count);
});
}
</script>
</body>
</html>