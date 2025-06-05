<?php
include('lcheck.php');
function get_maincategory($con , $term){ 
$query = "SELECT * from paircustomers WHERE franchisesession='".$_SESSION["franchisesession"]."' and id='".$term."' ORDER BY customername ASC";
 $result = mysqli_query($con, $query); 
while($row = mysqli_fetch_assoc($result)) { $data[] = $row; }
 return $data; 
}
 
if ((isset($_GET['term']))&&($_GET['term']!="")) {
	
 $getmaincategory = get_maincategory($con, mysqli_real_escape_string($con, $_GET['term']));
 $maincategoryList = array();

        $sqliinvoice=mysqli_query($con, "select invoiceamount, invoicedate, invoiceno from pairinvoices where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and customerid='".$_GET['term']."' GROUP BY invoicedate, invoiceno order by invoicedate desc, invoiceno desc");
  $invoiceamount=0;
  $balanceamount=0;
  $currentamount=0;
  $overdueamount=0;
  while($infoinvoice=mysqli_fetch_array($sqliinvoice))
  {
    $invoiceamount+=(float)$infoinvoice['invoiceamount'];
    $paidamount=0;
    $sqlsalespay=mysqli_query($con,"select amount from pairsalespayhistory where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and invoiceno='".$infoinvoice['invoiceno']."' and invoicedate='".$infoinvoice['invoicedate']."' and customerid='".$_GET['term']."' order by id desc");
    while($infosalespay=mysqli_fetch_array($sqlsalespay))
    {
      $paidamount+=(float)$infosalespay['amount'];
    }
    $balanceamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
    $diff = abs(time() - strtotime($infoinvoice['invoicedate']));
    $days = floor(($diff)/ (60*60*24));
    if($days>30)
    {
      $overdueamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
    }
    else
    {
      $currentamount+=((float)$infoinvoice['invoiceamount']-$paidamount);
    }
  }
  $data['balanceamount'] = $balanceamount;

 foreach($getmaincategory as $maincategory){
if($maincategory['primarysalutation']==null)  
{
  $data['primarysalutation']="";
}
else
{
 $data['primarysalutation'] = $maincategory['primarysalutation'];
}
if($maincategory['primarycontact']==null)  
{
  $data['primarycontact']="";
}
else
{
 $data['primarycontact'] = $maincategory['primarycontact'];
}
if($maincategory['companyname']==null)  
{
  $data['companyname']="";
}
else
{
 $data['companyname'] = $maincategory['companyname'];
}
if($maincategory['category']==null)  
{
  $data['category']="";
}
else
{
 $data['category'] = $maincategory['category'];
}
if($maincategory['subcategory']==null)  
{
  $data['subcategory']="";
}
else
{
 $data['subcategory'] = $maincategory['subcategory'];
}
if($maincategory['workphone']==null)   
{
  $data['workphone']="";
}
else
{
 $data['workphone'] = $maincategory['workphone'];
}
if($maincategory['mobile']==null)   
{
  $data['mobile']="";
}
else
{
 $data['mobile'] = $maincategory['mobile'];
}
if($maincategory['email']==null)   
{
  $data['email']="";
}
else
{
 $data['email'] = $maincategory['email'];
}
if($maincategory['website']==null)   
{
  $data['website']="";
}
else
{
 $data['website'] = $maincategory['website'];
}
if($maincategory['cvisiblity']==null)   
{
  $data['cvisiblity']="";
}
else
{
 $data['cvisiblity'] = $maincategory['cvisiblity'];
}
if($maincategory['custaxprefer']==null)   
{
  $data['custaxprefer']="";
}
else
{
 $data['custaxprefer'] = $maincategory['custaxprefer'];
}
if($maincategory['buslegname']==null)   
{
  $data['buslegname']="";
}
else
{
 $data['buslegname'] = $maincategory['buslegname'];
}
if($maincategory['bustrdname']==null)   
{
  $data['bustrdname']="";
}
else
{
 $data['bustrdname'] = $maincategory['bustrdname'];
}
if($maincategory['pan']==null)   
{
  $data['pan']="";
}
else
{
 $data['pan'] = $maincategory['pan'];
}
if($maincategory['placeos']==null)   
{
  $data['placeos']="";
}
else
{
 $data['placeos'] = $maincategory['placeos'];
}
if($maincategory['dlno20']==null)   
{
  $data['dlno20']="";
}
else
{
 $data['dlno20'] = $maincategory['dlno20'];
}
if($maincategory['dlno21']==null)   
{
  $data['dlno21']="";
}
else
{
 $data['dlno21'] = $maincategory['dlno21'];
}

if($maincategory['customername']==null)	 
{
	$data['customername']="";
}
else
{
 $data['customername'] = $maincategory['customername'];
}
if($maincategory['customername']==null)	 
{
	$data['value']="";
}
else
{
 $data['value'] = $maincategory['customername'];
 }
if($maincategory['id']==null)	 
{
	$data['id']="";
}
else
{
 $data['id'] = $maincategory['id'];
}
if($maincategory['customercode']==null)  
{
  $data['customercode']="";
}
else
{
 $data['customercode'] = $maincategory['customercode'];
}
if($maincategory['publicid']==null)  
{
  $data['publicid']="";
}
else
{
 $data['publicid'] = $maincategory['publicid'];
}
if($maincategory['privateid']==null)  
{
  $data['privateid']="";
}
else
{
 $data['privateid'] = $maincategory['privateid'];
}
if($maincategory['billstreet']==null)	 
{
	$data['address']="";
}
else
{
  $data['address'] = $maincategory['billstreet'];
}
if($maincategory['billcity']==null)	 
{
	$data['city']="";
}
else
{
  $data['city'] = $maincategory['billcity'];
 }
if($maincategory['billstate']==null)	 
{
	$data['state']="";
}
else
{
 $data['state'] = $maincategory['billstate'];
 }
if($maincategory['billcountry']==null)	 
{
	$data['country']="";
}
else
{
 $data['country'] = $maincategory['billcountry'];
 }
if($maincategory['billpincode']==null)	 
{
	$data['pin']="";
}
else
{
 $data['pin'] = $maincategory['billpincode']; 
}
 if($maincategory['sameasbilling']=='1')
 {
if($maincategory['billstreet']==null)	 
{
	$data['saddress']="";
}
else
{
 	 $data['saddress'] = $maincategory['billstreet'];
 }
if($maincategory['billcity']==null)	 
{
	$data['scity']="";
}
else
{
 $data['scity'] = $maincategory['billcity'];
 }
if($maincategory['billstate']==null)	 
{
	$data['sstate']="";
}
else
{
 $data['sstate'] = $maincategory['billstate'];
 }
if($maincategory['billcountry']==null)	 
{
	$data['scountry']="";
}
else
{
 $data['scountry'] = $maincategory['billcountry'];
 }
if($maincategory['billpincode']==null)	 
{
	$data['spin']="";
}
else
{
 $data['spin'] = $maincategory['billpincode']; 
}
 }
 else
 {

if($maincategory['shipstreet']==null)	 
{
	$data['saddress']="";
}
else
{
  $data['saddress'] = $maincategory['shipstreet'];
 }
if($maincategory['shipcity']==null)	 
{
	$data['scity']="";
}
else
{
 $data['scity'] = $maincategory['shipcity'];
 }
if($maincategory['shipstate']==null)	 
{
	$data['sstate']="";
}
else
{
 $data['sstate'] = $maincategory['shipstate'];
 }
if($maincategory['shipcountry']==null)	 
{
	$data['scountry']="";
}
else
{
 $data['scountry'] = $maincategory['shipcountry'];
 }
if($maincategory['shippincode']==null)	 
{
	$data['spin']="";
}
else
{
 $data['spin'] = $maincategory['shippincode']; 
}
 }
 
if($maincategory['gstrtype']==null)	 
{
	$data['gstrtype']="";
}
else
{
 $data['gstrtype'] = $maincategory['gstrtype']; 
} 
if($maincategory['gstin']==null)
{
	$data['gstin']="";
}
else
{
 $data['gstin'] = $maincategory['gstin']; 
}
if($maincategory['workphone']==null)
{
	$data['workphone']="";
}
else
{
 $data['workphone'] = $maincategory['workphone']; 
}
if($maincategory['mobile']==null)
{
	$data['mobile']="";
}
else
{
 $data['mobile'] = $maincategory['mobile']; 
}
if($maincategory['placeos']==null)
{
	$data['pos']="";
}
else
{
 $data['pos'] = $maincategory['placeos']; 
}
 
 
        array_push($maincategoryList, $data);
 }
 echo json_encode($maincategoryList);
}
?>