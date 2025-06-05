<?php
include ('lcheck.php');
$cussqlismainaccessfield=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Customers' order by id  asc");
while($cusinfomainaccessfield=mysqli_fetch_array($cussqlismainaccessfield)){
    $coltype = preg_replace('/\s+/', '', $cusinfomainaccessfield['moduletype']);
    $cusadd = $cusinfomainaccessfield[21];
    $cusfieldadd = explode(',',$cusadd);
    $cusedit = $cusinfomainaccessfield[22];
    $cusfieldedit = explode(',',$cusedit);
    $cusview = $cusinfomainaccessfield[23];
    $cusfieldview = explode(',',$cusview);
}
if (isset($_POST['submit'])) {
$sqlismodulespublicnamecust=mysqli_query($con, "select * from pairmodules where moduletype='Customers' order by id  asc");
$infomodulespublicnamecust=mysqli_fetch_array($sqlismodulespublicnamecust);
$sqlismainaccesspublicnamecust=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Customers' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicnamecust=mysqli_fetch_array($sqlismainaccesspublicnamecust);
$cushead = $infomainaccesspublicnamecust['modulename'];
// $customerids = mysqli_real_escape_string($con, $_POST['customerid']);
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
if (isset($_POST['custcategory'])) {
$category = mysqli_real_escape_string($con, $_POST['custcategory']);
} else {
$category = " ";
}
if (isset($_POST['custsubcategory'])) {
$subcategory = mysqli_real_escape_string($con, $_POST['custsubcategory']);
} else {
$subcategory = " ";
}
$salute = mysqli_real_escape_string($con, $_POST['salute']);
$pcontact = mysqli_real_escape_string($con, $_POST['pcontact']);
$companyname = mysqli_real_escape_string($con, $_POST['companyname']);
$customerdname = mysqli_real_escape_string($con, $_POST['customerdname']);
if (isset($_POST['custvisibility'])) {
$vvisibility = mysqli_real_escape_string($con, $_POST['custvisibility']);
} else {
$vvisibility = "PUBLIC";
}
$billstreet = mysqli_real_escape_string($con, $_POST['billstreet']);
$billcity = mysqli_real_escape_string($con, $_POST['billcity']);
$billstate = mysqli_real_escape_string($con, $_POST['billstate']);
$billpincode = mysqli_real_escape_string($con, $_POST['billpincode']);
$billcountry = mysqli_real_escape_string($con, $_POST['billcountry']);
$shipstreet = mysqli_real_escape_string($con, $_POST['shipstreet']);
$shipcity = mysqli_real_escape_string($con, $_POST['shipcity']);
$shipstate = mysqli_real_escape_string($con, $_POST['shipstate']);
$shippincode = mysqli_real_escape_string($con, $_POST['shippincode']);
$shipcountry = mysqli_real_escape_string($con, $_POST['shipcountry']);
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
$sameasbillings = mysqli_real_escape_string($con, $_POST['sameasbilling']);
$sameasbilling = ($sameasbillings!=0) ? '1' : '0';
if ($sameasbillings!=0) {
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
// $sameasbilling = mysqli_real_escape_string($con, (isset($_POST['sameasbilling'])) ? '1' : '0');
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
$sqlcon = "SELECT id From paircustomers WHERE customername = '{$customerdname}' and franchisesession='" . $_SESSION["franchisesession"] . "' and  moduletype='Customers'";
$querycon = mysqli_query($con, $sqlcon);
$rowCountcon = mysqli_num_rows($querycon);
if (!$querycon) {
die("SQL query failed: " . mysqli_error($con));
}
// if ($rowCountcon == 0) {
$sqlup = "insert into paircustomers set createdon='$times', createdid='$companymainid', createdby='" . $_SESSION["unqwerty"] . "', franchisesession='" . $_SESSION["franchisesession"] . "',primarysalutation='$salute',primarycontact='$pcontact',companyname='$companyname',customername='$customerdname',cvisiblity='$vvisibility',billstreet='$billstreet',billcity='$billcity',billstate='$billstate',billpincode='$billpincode',billcountry='$billcountry',shipstreet='$shipstreet',shipcity='$shipcity',shipstate='$shipstate',shippincode='$shippincode',shipcountry='$shipcountry',customercode='$customerid',gstrtype='$gstrtype',gstin='$gstin',buslegname='$businesslegalname',bustrdname='$businesstradename',category='$category',subcategory='$subcategory',custaxprefer='$taxpreference',workphone='$workphone',mobile='$mobilephone',email='$email',website='$website',sameasbilling='$sameasbilling',pan='$pan',placeos='$placeos',moduletype='Customers',publicid='$publiccode',privateid='$privatecode',dlno20='$dlt',dlno21='$dlo'";
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
                if($category!='')
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
                if($subcategory!='')
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
                if(in_array('Customers Visibility', $cusfieldadd)){
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
                if(in_array('Tax Preference', $cusfieldadd)){
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
                if (in_array('Place Of Supply', $cusfieldadd)) {
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
$sql3=mysqli_query($con, "update pairmainaccess set modulesuffix=modulesuffix+1 where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Customers'");
mysqli_query($con, "INSERT INTO pairhistory (user, ipaddress, times, remarks, tid) VALUES ('{$username}', '{$ip}', '{$times}', 'Insert A Unit', '{$tid}')");
echo "Added Successfully|".$tid;
}
// } else {
// echo "This record is Already Found! Kindly check in All Customers List|0";
// }
} else {
echo "Error Data|0";
}
$sqlsubcat = "select subcategory from pairsubcategory where subcategory='$subcategory' and itemmodule='Customers' and createdid='$companymainid'";
$resultsubcat = mysqli_query($con, $sqlsubcat);
if (mysqli_num_rows($resultsubcat) > 0) {
} else {
if (isset($_POST['custsubcategory'])) {
$sqlupsub = "insert into pairsubcategory set createdon='$times', createdid='$companymainid',createdby='" . $_SESSION["unqwerty"] . "',itemmodule='Customers', subcategory='$subcategory'";
$queryupsub = mysqli_query($con, $sqlupsub);
}
}
$sqlcat = "select category from paircategory where category='$category' and itemmodule='Customers' and createdid='$companymainid'";
$resultcat = mysqli_query($con, $sqlcat);
if (mysqli_num_rows($resultcat) > 0) {
} else {
if (isset($_POST['custcategory'])) {
$sqlupcat = "insert into paircategory set createdon='$times', createdid='$companymainid',createdby='" . $_SESSION["unqwerty"] . "',itemmodule='Customers', category='$category'";
$queryupcat = mysqli_query($con, $sqlupcat);
}
}
}
?>