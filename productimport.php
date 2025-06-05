<?php
include('lcheck.php');
if(isset($_POST['simplesubmit']))
{
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['productfile']['name']) && in_array($_FILES['productfile']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['productfile']['tmp_name'])){
			
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['productfile']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
 $cos=0;           
            // Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE)
{

		
$productname=mysqli_real_escape_string($con, $line[0]);
$codetags=mysqli_real_escape_string($con, $line[1]);
$category=mysqli_real_escape_string($con, $line[2]);
$subcategory=mysqli_real_escape_string($con, $line[3]);
$productimage=mysqli_real_escape_string($con, $line[4]);
$defaultunit=mysqli_real_escape_string($con, $line[5]);



$intratname=mysqli_real_escape_string($con, $line[8]);
$intrat=(float)mysqli_real_escape_string($con, $line[9]);
$intertname=mysqli_real_escape_string($con, $line[10]);
$intert=(float)mysqli_real_escape_string($con, $line[11]);
$pvisiblity=mysqli_real_escape_string($con, $line[12]);

if($intert!="")
{
	$sqlis=mysqli_query($con, "select id from pairtaxrates where tax='$intert'");
	if(mysqli_num_rows($sqlis)>0)
	{
		$infois=mysqli_fetch_array($sqlis);
		$intertax=$infois['id'];
	}
	else
	{
		$sqlsi=mysqli_query($con, "insert into pairtaxrates set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', taxname='$intertname', tax='$intert'");
		$intertax=mysqli_insert_id($con);
	}
}
else
{
	$intertax="";
}

if($intrat!="")
{
	$sqlis=mysqli_query($con, "select id from pairtaxrates where tax='$intrat'");
	if(mysqli_num_rows($sqlis)>0)
	{
		$infois=mysqli_fetch_array($sqlis);
		$intratax=$infois['id'];
	}
	else
	{
		$sqlsi=mysqli_query($con, "insert into pairtaxrates set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', taxname='$intratname', tax='$intrat'");
		$intratax=mysqli_insert_id($con);
	}
}
else
{
	$intratax="";
}


if(($productname!=""))
	{	
		
        $sqlcon = "SELECT id From pairproducts WHERE franchisesession='".$_SESSION["franchisesession"]."' and productname = '{$productname}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon == 0) 
		{	
					
			$sqlup = "insert into pairproducts set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', codetags='$codetags', franchisesession='".$_SESSION["franchisesession"]."', productname='$productname', category='$category', subcategory='$subcategory', productimage='$productimage', defaultunit='PCS', intratax='$intratax', intertax='$intertax', pvisiblity='PRIVATE'";
			$queryup = mysqli_query($con, $sqlup);
			 
			 $productid=mysqli_insert_id($con);
			
	    }
		else
		{
			$infocon=mysqli_fetch_array($querycon);
				$productid=$infocon['id'];
	
			$sqlup = "update pairproducts set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', codetags='$codetags',franchisesession='".$_SESSION["franchisesession"]."', productname='$productname', category='$category', subcategory='$subcategory', productimage='$productimage', defaultunit='PCS', intratax='$intratax', intertax='$intertax', pvisiblity='PRIVATE' where id='$productid'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
		}
	}

 $cos++;
			}
			
			// Close opened CSV file
            fclose($csvFile);
			  // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['productfile']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
		while(($line = fgetcsv($csvFile)) !== FALSE){
		
		$salename=mysqli_real_escape_string($con, $line[6]);
$salecost=mysqli_real_escape_string($con, $line[7]);
		
					if(($salename!='')&&($salecost!=''))
					{
						$sqlias=mysqli_query($con, "select salename from pairprosale where productid='$productid' and salename='$salename'");
						if(mysqli_num_rows($sqlias)==0)
						{
							$sqliasa=mysqli_query($con, "insert into pairprosale set productid='$productid', salecost='$salecost', salemrp='$salecost', salename='$salename' ");
							
						}
						else
						{
							$sqliasa=mysqli_query($con, "update pairprosale set salecost='$salecost', salemrp='$salecost'  where productid='$productid' and salename='$salename'");
							
						}
						
					}
			
            }
			

            // Close opened CSV file
            fclose($csvFile);
            
           
        }else{
           
        }
    }else{
        
    }
if($productid)
{
	header("Location: products.php?remarks=Imported Successfully");
}
else
{
	header("Location: products.php?error=".mysqli_errno($con));
} 
}


if(isset($_POST['advancedsubmit']))
{
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['productfile']['name']) && in_array($_FILES['productfile']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['productfile']['tmp_name'])){
			
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['productfile']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
 $cos=0;           
            // Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE)
{

$itemmodule=mysqli_real_escape_string($con, $line[0]);		
$productname=mysqli_real_escape_string($con, $line[1]);
$codetags=mysqli_real_escape_string($con, $line[2]);
$category=mysqli_real_escape_string($con, $line[3]);
$defaultunit=mysqli_real_escape_string($con, $line[4]);
$description=mysqli_real_escape_string($con, $line[5]);
$delivery=mysqli_real_escape_string($con, $line[6]);
	$salename="SELLING PRICE";
$salecost=mysqli_real_escape_string($con, $line[7]);
$intratname=mysqli_real_escape_string($con, $line[8]);
$intrat = preg_replace('[\D]', '', $intratname);
$pvisiblity=strtoupper(mysqli_real_escape_string($con, $line[9]));

if($intratname!="")
{
	$sqlis=mysqli_query($con, "select id from pairtaxrates where taxname='$intratname'");
	if(mysqli_num_rows($sqlis)>0)
	{
		$infois=mysqli_fetch_array($sqlis);
		$intratax=$infois['id'];
	}
	else
	{
		$sqlsi=mysqli_query($con, "insert into pairtaxrates set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', taxname='$intratname', tax='$intrat'");
		$intratax=mysqli_insert_id($con);
	}
}
else
{
	$intratax="";
}


if(($productname!=""))
	{	
		
        $sqlcon = "SELECT id From pairproducts WHERE franchisesession='".$_SESSION["franchisesession"]."' and productname = '{$productname}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon == 0) 
		{	
					
			$sqlup = "insert into pairproducts set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', codetags='$codetags', franchisesession='".$_SESSION["franchisesession"]."', itemmodule='$itemmodule', productname='$productname', category='$category', defaultunit='PCS', description='$description', delivery='$delivery', intratax='$intratax', pvisiblity='PRIVATE'";
			$queryup = mysqli_query($con, $sqlup);
			 
			 $productid=mysqli_insert_id($con);
			
	    }
		else
		{
			$infocon=mysqli_fetch_array($querycon);
				$productid=$infocon['id'];
	
			$sqlup = "update pairproducts set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', codetags='$codetags', franchisesession='".$_SESSION["franchisesession"]."', itemmodule='$itemmodule', productname='$productname', category='$category', defaultunit='PCS', description='$description', delivery='$delivery', intratax='$intratax', pvisiblity='PRIVATE' where id='$productid'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
		}
		
			
		
					if(($salename!='')&&($salecost!=''))
					{
						$sqlias=mysqli_query($con, "select salename from pairprosale where productid='$productid' and salename='$salename'");
						if(mysqli_num_rows($sqlias)==0)
						{
							$sqliasa=mysqli_query($con, "insert into pairprosale set productid='$productid', salecost='$salecost', salemrp='$salecost', salename='$salename' ");
							
						}
						else
						{
							$sqliasa=mysqli_query($con, "update pairprosale set salecost='$salecost', salemrp='$salecost'  where productid='$productid' and salename='$salename'");
							
						}
						
					}
		
	}

 $cos++;
			}
			
			// Close opened CSV file
            fclose($csvFile);
			  // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['productfile']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
		while(($line = fgetcsv($csvFile)) !== FALSE){
		

			
            }
			

            // Close opened CSV file
            fclose($csvFile);
            
           
        }else{
           
        }
    }else{
        
    }
if($productid)
{
	header("Location: products.php?remarks=Imported Successfully");
}
else
{
	header("Location: products.php?error=".mysqli_error($con));
} 
}


if(isset($_POST['multiplesubmit']))
{
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['productfile']['name']) && in_array($_FILES['productfile']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['productfile']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['productfile']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
$id=mysqli_real_escape_string($con, $line[0]);
$productcode=mysqli_real_escape_string($con, $line[1]);
$productname=mysqli_real_escape_string($con, $line[2]);
$codetags=mysqli_real_escape_string($con, $line[3]);
$category=mysqli_real_escape_string($con, $line[4]);
$subcategory=mysqli_real_escape_string($con, $line[5]);
$productimage=mysqli_real_escape_string($con, $line[6]);
$hsncode=mysqli_real_escape_string($con, $line[7]);
$defaultunit=mysqli_real_escape_string($con, $line[8]);
$description=mysqli_real_escape_string($con, $line[9]);
$foronline=(float)mysqli_real_escape_string($con, $line[10]);
$viewaccess=mysqli_real_escape_string($con, $line[11]);
$purchaseaccounttype=mysqli_real_escape_string($con, $line[12]);
$saleaccounttype=mysqli_real_escape_string($con, $line[13]);
$taxpref=(float)mysqli_real_escape_string($con, $line[14]);
$taxratecountry=mysqli_real_escape_string($con, $line[15]);
$intratax=mysqli_real_escape_string($con, $line[16]);
$intertax=mysqli_real_escape_string($con, $line[17]);
$excemptionreason=mysqli_real_escape_string($con, $line[18]);
$trackinventory=(float)mysqli_real_escape_string($con, $line[19]);
$inventoryaccounttype=mysqli_real_escape_string($con, $line[20]);
$openingstock=(float)mysqli_real_escape_string($con, $line[21]);
$openingstockrate=(float)mysqli_real_escape_string($con, $line[22]);
$openingason=mysqli_real_escape_string($con, $line[23]);
$msg = "";
$msg_class = "";
				
				
                
if(($productname!=""))
	{		
        $sqlcon = "SELECT id From pairproducts WHERE franchisesession='".$_SESSION["franchisesession"]."' and id = '{$id}'";
        $querycon = mysqli_query($con, $sqlcon);
        $rowCountcon = mysqli_num_rows($querycon);
         
        if(!$querycon){
           die("SQL query failed: " . mysqli_error($con));
        }
         
        if($rowCountcon == 0) 
		{	
					
			$sqlup = "insert into pairproducts set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', id='$id', franchisesession='".$_SESSION["franchisesession"]."', productcode='$productcode', productname='$productname', codetags='$codetags', category='$category', subcategory='$subcategory', productimage='$productimage', hsncode='$hsncode', defaultunit='PCS', description='$description', foronline='$foronline', viewaccess='$viewaccess', purchaseaccounttype='$purchaseaccounttype', saleaccounttype='$saleaccounttype', taxpref='$taxpref', taxratecountry='$taxratecountry', intratax='$intratax', intertax='$intertax', excemptionreason='$excemptionreason', trackinventory='$trackinventory', inventoryaccounttype='$inventoryaccounttype', openingstock='$openingstock', openingstockrate='$openingstockrate', openingason='$openingason'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
	    }
		else
		{
			$sqlup = "update pairproducts set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', productcode='$productcode',franchisesession='".$_SESSION["franchisesession"]."', productname='$productname', codetags='$codetags', category='$category', subcategory='$subcategory', productimage='$productimage', hsncode='$hsncode', defaultunit='PCS', description='$description', foronline='$foronline', viewaccess='$viewaccess', purchaseaccounttype='$purchaseaccounttype', saleaccounttype='$saleaccounttype', taxpref='$taxpref', taxratecountry='$taxratecountry', intratax='$intratax', intertax='$intertax', excemptionreason='$excemptionreason', trackinventory='$trackinventory', inventoryaccounttype='$inventoryaccounttype', openingstock='$openingstock', openingstockrate='$openingstockrate', openingason='$openingason' where id='$id'";
			$queryup = mysqli_query($con, $sqlup);
			 
			if(!$queryup){
			   die("SQL query failed: " . mysqli_error($con));
			}
		}
	}
	
	        }
			// Close opened CSV file
            fclose($csvFile);
			 // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['productfile']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
	while(($line = fgetcsv($csvFile)) !== FALSE){
		$productid=mysqli_real_escape_string($con, $line[24]);
		$sqlias=mysqli_query($con, "delete from pairpropurchase where productid='$productid'");
		
			$purchasename=mysqli_real_escape_string($con, $line[25]);
			$purchasemrp=(float)mysqli_real_escape_string($con, $line[26]);
			$purchasecost=(float)mysqli_real_escape_string($con, $line[27]);
			$purchasediscount=(float)mysqli_real_escape_string($con, $line[28]);
			$purchaseofferprice=(float)mysqli_real_escape_string($con, $line[29]);
			$purchaseunit=(float)mysqli_real_escape_string($con, $line[30]);
			$purchaseindunit=(float)mysqli_real_escape_string($con, $line[31]);
			if(($purchasename!='')&&($purchasecost!=''))
			{
				$sqlias=mysqli_query($con, "select purchasename from pairpropurchase where productid='$productid' and purchasename='$purchasename'");
				if(mysqli_num_rows($sqlias)==0)
				{
					$sqliasa=mysqli_query($con, "insert into pairpropurchase set productid='$productid', purchasename='$purchasename', purchasemrp='$purchasemrp', purchasecost='$purchasecost', purchasediscount='$purchasediscount', purchaseofferprice='$purchaseofferprice', purchaseunit='$purchaseunit', purchaseindunit='$purchaseindunit'");
				}
				else
				{
					$sqliasa=mysqli_query($con, "update pairpropurchase set productid='$productid', purchasename='$purchasename', purchasemrp='$purchasemrp', purchasecost='$purchasecost', purchasediscount='$purchasediscount', purchaseofferprice='$purchaseofferprice', purchaseunit='$purchaseunit', purchaseindunit='$purchaseindunit' where productid='$productid' and purchasename='$purchasename'");
				}
				
			}
			
            }
			// Close opened CSV file
            fclose($csvFile);
			 // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['productfile']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
		while(($line = fgetcsv($csvFile)) !== FALSE){
			$productid=mysqli_real_escape_string($con, $line[32]);
			
			$sqlias=mysqli_query($con, "delete from pairprosale where productid='$productid'");
					$salename=mysqli_real_escape_string($con, $line[33]);
					$salemrp=(float)mysqli_real_escape_string($con, $line[34]);
					$salecost=(float)mysqli_real_escape_string($con, $line[35]);
					$salediscount=(float)mysqli_real_escape_string($con, $line[36]);
					$saleofferprice=(float)mysqli_real_escape_string($con, $line[37]);
					$saleunit=(float)mysqli_real_escape_string($con, $line[38]);
					$saleindunit=(float)mysqli_real_escape_string($con, $line[39]);
					if(($salename!='')&&($salecost!=''))
					{
						$sqlias=mysqli_query($con, "select salename from pairprosale where productid='$productid' and salename='$salename'");
						if(mysqli_num_rows($sqlias)==0)
						{
							$sqliasa=mysqli_query($con, "insert into pairprosale set productid='$productid', salename='$salename', salemrp='$salemrp', salecost='$salecost', salediscount='$salediscount', saleofferprice='$saleofferprice', saleunit='$saleunit', saleindunit='$saleindunit'");
							
						}
						else
						{
							$sqliasa=mysqli_query($con, "update pairprosale set productid='$productid', salename='$salename', salemrp='$salemrp', salecost='$salecost', salediscount='$salediscount', saleofferprice='$saleofferprice', saleunit='$saleunit', saleindunit='$saleindunit' where productid='$productid' and salename='$salename'");
							
						}
						
					}
			
            }
			

            // Close opened CSV file
            fclose($csvFile);
            
           
        }else{
           
        }
    }else{
        
    }
if($sqliasa)
{
	header("Location: products.php?remarks=Imported Successfully");
}
else
{
	header("Location: products.php?error=".mysqli_errno($con));
}
}
if (isset($_POST['newsubmit'])) {
$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
if(!empty($_FILES['productfile'] ['name']) && in_array($_FILES['productfile'] ['type'], $csvMimes)){
if(is_uploaded_file($_FILES['productfile'] ['tmp_name'])){
$csvFile=fopen($_FILES['productfile'] ['tmp_name'],'r');
fgetcsv($csvFile);
while(($line=fgetcsv($csvFile))!==FALSE){

$codetags=mysqli_real_escape_string($con, $line[0]);   	
$productname=mysqli_real_escape_string($con, $line[1]);
$hsncode=mysqli_real_escape_string($con, $line[2]);
$manufacturer=mysqli_real_escape_string($con, $line[3]);
$salecost=mysqli_real_escape_string($con, $line[4]);
$intratax=mysqli_real_escape_string($con, $line[5]);
$intertax=mysqli_real_escape_string($con, $line[6]);
$openingstock=mysqli_real_escape_string($con, $line[7]);
$openingason=mysqli_real_escape_string($con, $line[8]);
$itemmodule=mysqli_real_escape_string($con, $line[9]);
// $publicid=mysqli_real_escape_string($con, $line[10]);
// $privateid=mysqli_real_escape_string($con, $line[11]);
$defaultunit=mysqli_real_escape_string($con, $line[12]);
$taxpref=mysqli_real_escape_string($con, $line[13]);
$pvisiblity=mysqli_real_escape_string($con, $line[14]);


$salemodule=mysqli_real_escape_string($con, $line[15]);
$anspricenames=mysqli_real_escape_string($con, $line[16]);
$salemrp=mysqli_real_escape_string($con, $line[17]);
$saledescription=mysqli_real_escape_string($con, $line[18]);

$purmodule=mysqli_real_escape_string($con, $line[19]);

// $taxgroups=mysqli_real_escape_string($con, $line[20]);
// $taxname=mysqli_real_escape_string($con, $line[21]);
// $tax=mysqli_real_escape_string($con, $line[22]);

$sqlcode=mysqli_query($con,"select count(productcode) from pairproducts where itemmodule='$itemmodule'");
$anscode=mysqli_fetch_array($sqlcode);
$oldcode=$anscode[0];
$productcode=$oldcode+1;

$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);

$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Products' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);

$publicsql=mysqli_query($con,"select count(publicid) from pairproducts where createdid='$companymainid' and itemmodule='$itemmodule'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publicid=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;

$privatesql=mysqli_query($con,"select count(privateid) from pairproducts where createdid='$companymainid' and itemmodule='$itemmodule' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privateid=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;

if ($productname!='') {
$sqlpro = mysqli_query($con,"insert into pairproducts set codetags='$codetags',franchisesession='".$_SESSION["franchisesession"]."',itemmodule='$itemmodule',productcode='$productcode',publicid='$publicid',privateid='$privateid',productname='$productname',hsncode='$hsncode',category='$manufacturer',defaultunit='PCS',taxpref='$taxpref',intratax='$intratax',intertax='$intertax',openingstock='0',openingason='$openingason',createdby='".$_SESSION["unqwerty"]."',createdon='$times',createdid='$companymainid',pvisiblity='PRIVATE'");
$productid=mysqli_insert_id($con);

$vatans = 0;

$sqltaxval=mysqli_query($con,"select tax from pairtaxrates where id='$intratax'");
if(mysqli_num_rows($sqltaxval)>0){
	$fettaxval = mysqli_fetch_array($sqltaxval);
	$vatans = $fettaxval['tax'];
}

$sqlbatpro=mysqli_query($con, "insert into pairbatch set franchisesession='".$_SESSION["franchisesession"]."',createdon='$times',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',manufacturer='',batch='',expdate='',productid='$productid',productname='$productname',mrp='$salecost',vat='$vatans',noofpacks='',quantity='0',prodiscount='0',productrate='$salecost'");

$sqlcat="select category from paircategory where category='$manufacturer' and itemmodule='Products' and createdid='$companymainid'";
$resultcat = mysqli_query($con,$sqlcat);
if (mysqli_num_rows($resultcat)>0) {
}
else{
    if($manufacturer!='')
{
$sqlupcat = "insert into paircategory set createdon='$times', createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',itemmodule='Products', category='$manufacturer'";
$queryupcat = mysqli_query($con, $sqlupcat);
}
}

if ($anspricenames!=''||$salemrp!=''||$salecost!=''||$saledescription!='') {
$sqlpricenamequery=mysqli_query($con,"select count(salename) from pairprosale where productid='$productid'");
$anspricenamequery=mysqli_fetch_array($sqlpricenamequery);
$oldpricenamequery=$anspricenamequery[0];
if ($anspricenames!='') {
$pricename = $anspricenames;
}
else{
$pricename  = 'SELLING PRICE ' . $oldpricenamequery + 1;
}
$sqlprosale = mysqli_query($con,"insert into pairprosale set productid='$productid',salename='$pricename',salemrp='$salecost',salecost='$salecost',saledescription='$saledescription',itemmodule='$salemodule',createdid='$companymainid'");
$sqlupnpro = mysqli_query($con,"update pairproducts set salescost='$salecost' where id='$productid'");
}
else{
$sqlprosale = mysqli_query($con,"insert into pairprosale set productid='$productid',itemmodule='$salemodule',createdid='$companymainid'");
}

$sqlpropur = mysqli_query($con,"insert into pairpropurchase set productid='$productid',itemmodule='$purmodule',createdid='$companymainid'");
}

}
}
}
else{
// $all="invalid products type";
}
header("Location:products.php?remarks=Imported Successfully");
}
if (isset($_POST['newbatchsubmit'])) {
$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
if(!empty($_FILES['batchfile'] ['name']) && in_array($_FILES['batchfile'] ['type'], $csvMimes)){
if(is_uploaded_file($_FILES['batchfile'] ['tmp_name'])){
$csvFile=fopen($_FILES['batchfile'] ['tmp_name'],'r');
fgetcsv($csvFile);
while(($line=fgetcsv($csvFile))!==FALSE){
$batchmanufacturer=mysqli_real_escape_string($con, $line[0]);
$batch=mysqli_real_escape_string($con, $line[1]);
$expdate=mysqli_real_escape_string($con, $line[2]);
$batchproductname=mysqli_real_escape_string($con, $line[3]);
$batchmrp=mysqli_real_escape_string($con, $line[4]);
$batchvat=mysqli_real_escape_string($con, $line[5]);
$batchnopacks=mysqli_real_escape_string($con, $line[6]);
$batchquantity=mysqli_real_escape_string($con, $line[7]);
$batchprodiscount=mysqli_real_escape_string($con, $line[8]);
$batchprorate=mysqli_real_escape_string($con, $line[9]);
$batchproid=mysqli_real_escape_string($con, $line[10]);

$sqlcode=mysqli_query($con,"select count(productcode) from pairproducts where itemmodule='Products'");
$anscode=mysqli_fetch_array($sqlcode);
$oldcode=$anscode[0];
$productcode=$oldcode+1;

$sqlismodulespublicname=mysqli_query($con, "select * from pairmodules where moduletype='Products' order by id  asc");
$infomodulespublicname=mysqli_fetch_array($sqlismodulespublicname);

$publicsql=mysqli_query($con,"select count(publicid) from pairproducts where createdid='$companymainid' and itemmodule='Products'");
$publicans=mysqli_fetch_array($publicsql);
$oldcodepublic=$publicans[0];
$publicid=$infomodulespublicname['publiccolumn'] . $oldcodepublic+1;

$sqlismainaccesspublicname=mysqli_query($con, "select * from pairmainaccess where createdid='$companymainid' and moduletype='Products' and franchiseid='".$_SESSION['franchisesession']."' order by id  asc");
$infomainaccesspublicname=mysqli_fetch_array($sqlismainaccesspublicname);

$privatesql=mysqli_query($con,"select count(privateid) from pairproducts where createdid='$companymainid' and itemmodule='Products' and franchisesession='".$_SESSION['franchisesession']."'");
$privateans=mysqli_fetch_array($privatesql);
$oldcodeprivate=$privateans[0];
$privateid=$infomainaccesspublicname['moduleprefix'] . $oldcodeprivate+1;

if ($batchproductname!='') {
$batsel = mysqli_query($con,"select * from pairproducts where codetags='$batchproid' and franchisesession='".$_SESSION["franchisesession"]."'");
if (mysqli_num_rows($batsel)==0) {
$sqlpro = mysqli_query($con,"insert into pairproducts set franchisesession='".$_SESSION["franchisesession"]."',itemmodule='Products',productcode='$productcode',publicid='$publicid',privateid='$privateid',productname='$batchproductname',taxpref='1',createdby='".$_SESSION["unqwerty"]."',createdon='$times',createdid='$companymainid',pvisiblity='PRIVATE',intratax='16',intertax='3'");
$productid=mysqli_insert_id($con);
$sqlprosale = mysqli_query($con,"insert into pairprosale set productid='$productid',itemmodule='Products',createdid='$companymainid'");
$sqlpropur = mysqli_query($con,"insert into pairpropurchase set productid='$productid',itemmodule='Products',createdid='$companymainid'");
$sqlibatchpro=mysqli_query($con, "select id from pairbatch where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='$productid' and batch='$batch' and expdate='$expdate'");
if(mysqli_num_rows($sqlibatchpro)>0)
{
$sqlbatrpo=mysqli_query($con, "update pairbatch set franchisesession='".$_SESSION["franchisesession"]."',createdon='$times',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',manufacturer='$batchmanufacturer',batch='$batch',expdate='$expdate',productid='$productid',productname='$batchproductname',mrp='$batchmrp',vat='$batchvat',noofpacks='$batchnopacks',quantity=quantity+$batchquantity,prodiscount='$batchprodiscount',productrate='$batchprorate' where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='$productid' and batch='$batch' and expdate='$expdate'");
}
else
{
$sqlbatrpo=mysqli_query($con, "insert into pairbatch set franchisesession='".$_SESSION["franchisesession"]."',createdon='$times',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',manufacturer='$batchmanufacturer',batch='$batch',expdate='$expdate',productid='$productid',productname='$batchproductname',mrp='$batchmrp',vat='$batchvat',noofpacks='$batchnopacks',quantity='$batchquantity',prodiscount='$batchprodiscount',productrate='$batchprorate'");
}
$prostockupd = mysqli_query($con,"update pairproducts set openingstock=openingstock+$batchquantity where id='$productid'");
}
else{
$proids = mysqli_fetch_array($batsel);
$productidold=$proids['codetags'];
$productid=$proids['id'];
$sqlibatchpro=mysqli_query($con, "select id from pairbatch where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='$productidold' and batch='$batch' and expdate='$expdate'");
if(mysqli_num_rows($sqlibatchpro)>0)
{
$sqlbatrpo=mysqli_query($con, "update pairbatch set franchisesession='".$_SESSION["franchisesession"]."',createdon='$times',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',manufacturer='$batchmanufacturer',batch='$batch',expdate='$expdate',productid='$productid',productname='$batchproductname',mrp='$batchmrp',vat='$batchvat',noofpacks='$batchnopacks',quantity=quantity+$batchquantity,prodiscount='$batchprodiscount',productrate='$batchprorate' where createdid='$companymainid' and franchisesession='".$_SESSION["franchisesession"]."' and productid='$productidold' and batch='$batch' and expdate='$expdate'");
}
else
{
$sqlbatrpo=mysqli_query($con, "insert into pairbatch set franchisesession='".$_SESSION["franchisesession"]."',createdon='$times',createdid='$companymainid',createdby='".$_SESSION["unqwerty"]."',manufacturer='$batchmanufacturer',batch='$batch',expdate='$expdate',productid='$productid',productname='$batchproductname',mrp='$batchmrp',vat='$batchvat',noofpacks='$batchnopacks',quantity='$batchquantity',prodiscount='$batchprodiscount',productrate='$batchprorate'");
}
$prostockupd = mysqli_query($con,"update pairproducts set openingstock=openingstock+$batchquantity where id='$productid'");
}
}

}
}
}
else{
// $all="invalid products type";
}
header("Location:products.php?remarks=Imported Successfully");
}
// $franchisesession=mysqli_real_escape_string($con, $line[0]);   	
// $itemmodule=mysqli_real_escape_string($con, $line[1]);
// $productcode=mysqli_real_escape_string($con, $line[2]);
// $publicid=mysqli_real_escape_string($con, $line[3]);
// $privateid=mysqli_real_escape_string($con, $line[4]);
// $productname=mysqli_real_escape_string($con, $line[5]);
// $hsncode=mysqli_real_escape_string($con, $line[6]);
// $defaultunit=mysqli_real_escape_string($con, $line[7]);
// $taxpref=mysqli_real_escape_string($con, $line[8]);
// $intratax=mysqli_real_escape_string($con, $line[9]);
// $intertax=mysqli_real_escape_string($con, $line[10]);
// $createdby=mysqli_real_escape_string($con, $line[11]);
// $createdon=mysqli_real_escape_string($con, $line[12]);
// $createdid=mysqli_real_escape_string($con, $line[13]);
// $pvisiblity=mysqli_real_escape_string($con, $line[14]);

// $productidsale=mysqli_real_escape_string($con, $line[15]);
// $createdidsale=mysqli_real_escape_string($con, $line[16]);
// $itemmodulesale=mysqli_real_escape_string($con, $line[17]);
// $salename=mysqli_real_escape_string($con, $line[18]);
// $salemrp=mysqli_real_escape_string($con, $line[19]);
// $salecost=mysqli_real_escape_string($con, $line[20]);
// $saledescription=mysqli_real_escape_string($con, $line[21]);

// $productidpurchase=mysqli_real_escape_string($con, $line[22]);
// $createdidpurchase=mysqli_real_escape_string($con, $line[23]);
// $itemmodulepurchase=mysqli_real_escape_string($con, $line[24]);

// $manufacturer=mysqli_real_escape_string($con, $line[25]);
//         $sqlproduct="INSERT INTO pairproducts set franchisesession='$franchisesession',itemmodule='$itemmodule',productcode='$productcode',publicid='$publicid',privateid='$privateid',productname='$productname',hsncode='$hsncode',defaultunit='PCS',taxpref='$taxpref',intratax='$intratax',intertax='$intertax',createdby='$createdby',createdon='$createdon',createdid='$createdid',pvisiblity='$pvisiblity',manufacturer='$manufacturer'";
//         $resultproduct=mysqli_query($con,$sqlproduct);

//         $sqlproductsale="INSERT INTO pairprosale set productid='$productidsale',createdid='$createdidsale',itemmodule='$itemmodulesale',salename='$salename',salemrp='$salemrp',salecost='$salecost',saledescription='$saledescription'";
//         $resultproductsale=mysqli_query($con,$sqlproductsale);

//         $sqlproductpurchase="INSERT INTO pairpropurchase set productid='$productidpurchase',createdid='$createdidpurchase',itemmodule='$itemmodulepurchase'";
//         $resultproductpurchase=mysqli_query($con,$sqlproductpurchase);
//   if($resultproductpurchase){
 //         header("Location: products.php?remarks=Imported Successfully");
 //       }
  //  else{
  //        header("Location: products.php?error=".mysqli_errno($con));
  //  } 
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
        Products - Dmedia
    </title>
    <style>
    table tbody tr:nth-of-type(odd) {}

/*@media screen and (max-width: 3px) {
    .addmenu{
        position: relative;
        left: -57px; 
        top: 36px;
}
.add{
    position: relative;
    left: -60px;
}
}*/
@media screen and (max-width: 993px) {
    .add{
        position: relative;
        left: 0px; 
        top: 36px;
}
.addmenu{
        position: relative;
        left: 0px; 
        top: 36px;
}
}


@media screen and (max-width: 353px) {
    /*.add{
        position: relative;
        left: -90px; 
        top: 36px;
}
.addmenu{
        position: relative;
        left: -96px; 
        top: 36px;
}*/
}


    @media screen and (max-width: 600px) {
        table {
            border: 0;
            margin-top: 30px;
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
            padding-bottom: 2em;
        }
    }
    </style>



    <style>
    #tableEditor {
        position: absolute;
        left: 250px;
        top: 161px;
        padding: 5px;
        border: 1px solid #000;
        background: #fff;
    }
    </style>

    <style>
    .checkbox-dropdown {
        width: 220px;
        border: 0px solid #aaa;
        padding: 10px;
        position: relative;
		z-index:5;


        user-select: none;
    }

    /* Display CSS arrow to the right of the dropdown text */
    .checkbox-dropdown:after {

        height: 0;
        position: absolute;
        width: 0;
        border: 6px solid transparent;
        border-top-color: #000;
        top: 50%;
        right: 10px;
        margin-top: -3px;
    }

    /* Reverse the CSS arrow when the dropdown is active */
    .checkbox-dropdown.is-active:after {
        border-bottom-color: #000;
        border-top-color: #fff;
        margin-top: -9px;
    }

    .checkbox-dropdown-list {
        list-style: none;
        margin: 0;
        padding: 0;
        position: absolute;
        top: 100%;
        /* align the dropdown right below the dropdown text */
        border: inherit;
        border-top: none;
        left: -1px;
        /* align the dropdown to the left */
        right: -1px;
        /* align the dropdown to the right */
        opacity: 0;
        /* hide the dropdown */
        border: 1px solid #aaa;
        transition: opacity 0.4s ease-in-out;
        height: auto;
        overflow: scroll;
        overflow-x: hidden;
        pointer-events: none;
        /* avoid mouse click events inside the dropdown */
    }

    .is-active .checkbox-dropdown-list {
        opacity: 1;
        /* display the dropdown */
        pointer-events: auto;
        /* make sure that the user still can select checkboxes */
    }

    .checkbox-dropdown-list {

        background-color: white;
        padding: 10px;
        text-transform: uppercase;


    }

    .checkbox-dropdown-list li label {

        padding: 10px;


    }

    .checkbox-dropdown-list li:hover {
        background-color: #EDF0F2;
        color: white;
    }

    .dropliststyle {
        padding-left: 10px;
        margin-top: -4px;
        vertical-align: text-bottom;
        font-size: 14px;
    }

    input[type=checkbox] {
        transform: scale(1.25);
    }

    input:disabled {
        background: red;
    }

    input[type="checkbox"i]:disabled {
        color: red;
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
     <script type="text/javascript">

$(document).ready(function () {
 
window.setTimeout(function() {
    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
        $(this).remove(); 
    });
}, 4000);
 
});
</script>

	 
	 
	 <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
             <div class="card-body p-3">

 <p class="mb-3" style="color:black;font-size:20px;margin-top: -8px;"> <i class="fa fa-file-import"></i> Product Import</p>

<div class="alert alert-info text-white">
	Kindly Note that the New Product List should contains existing Product Name, otherwise it has been Overrided.
	</div>

<div class="accordion" id="accordionRental">
          <div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingOne">
              <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading">Simple Import</a>	
             
				</div> 
                
              </button>
            </h5>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"  style="">
              <div class="accordion-body text-sm">
	<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
	 
	
	
	<p>Download a <a href="simpleimport.csv">sample file</a> and compare it to your import file to ensure you have the file perfect for the import.</p>
	 
	
	
	<div class="row">
<div class="col-lg-12">


<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="firstname" class="custom-label"><span class="text-danger">Products CSV File *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="file" class="form-control  form-control-sm" required id="productfile" name="productfile" accept=".csv">
            </div>
          </div>
    </div>
</div>


</div>

    </div>



<div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <input class="btn btn-primary btn-sm btn-custom" type="submit" name="simplesubmit" value="Save">  <a class="btn btn-primary btn-sm btn-custom-grey" href="products.php">Cancel</a>
    </div>
</div>
</form>
			   
              </div>
            </div>
          </div>
          
          
          
          
          
          
          
           <div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingTwo">
              <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading">Advanced Import</a>	
             
				</div> 
                
              </button>
            </h5>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"  style="">
              <div class="accordion-body text-sm">
	<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
	 <!-- $sqli=mysqli_query($con, "select id from pairproducts where ((franchisesession='".$_SESSION["franchisesession"]."' and pvisiblity='PRIVATE') or pvisiblity='PUBLIC') order by id desc");
	$info=mysqli_fetch_array($sqli);
	$lastproductid=$info['id']; -->
	
	<p>Download a <a href="advancedimport.csv">sample file</a> and compare it to your import file to ensure you have the file perfect for the import.</p>
	 
	
	
	<div class="row">
<div class="col-lg-12">


<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="firstname" class="custom-label"><span class="text-danger">Products CSV File *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="file" class="form-control  form-control-sm" required id="productfile" name="productfile" accept=".csv">
            </div>
          </div>
    </div>
</div>


</div>

    </div>



<div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <input class="btn btn-primary btn-sm btn-custom" type="submit" name="advancedsubmit" value="Save">  <a class="btn btn-primary btn-sm btn-custom-grey" href="products.php">Cancel</a>
    </div>
</div>
</form>
			   
              </div>
            </div>
          </div>
          





          <div class="accordion" id="accordionRental">
          <div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingThree">
              <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading">New Import</a>	
             
				</div> 
                
              </button>
            </h5>
            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree"  style="">
              <div class="accordion-body text-sm">
	<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
	 
	
	
	<p>Download a <a href="simpleimport.csv">sample file</a> and compare it to your import file to ensure you have the file perfect for the import.</p>
	 
	
	
	<div class="row">
<div class="col-lg-12">


<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="productfile" class="custom-label"><span class="text-danger">Products CSV File *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="file" class="form-control  form-control-sm" required id="productfile" name="productfile" accept=".csv">
            </div>
          </div>
    </div>
</div>


</div>

    </div>



<div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <input class="btn btn-primary btn-sm btn-custom" type="submit" name="newsubmit" value="Save">  <a class="btn btn-primary btn-sm btn-custom-grey" href="products.php">Cancel</a>
    </div>
</div>
</form>
			   
              </div>
            </div>
          </div>


          <div class="accordion" id="accordionRental">
          <div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingbatch">
              <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapsebatch" aria-expanded="true" aria-controls="collapsebatch">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading">New Import</a>	
             
				</div> 
                
              </button>
            </h5>
            <div id="collapsebatch" class="accordion-collapse collapse show" aria-labelledby="headingbatch"  style="">
              <div class="accordion-body text-sm">
	<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
	 
	
	
	<p>Download a <a href="simpleimport.csv">sample file</a> and compare it to your import file to ensure you have the file perfect for the import.</p>
	 
	
	
	<div class="row">
<div class="col-lg-12">


<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="batchfile" class="custom-label"><span class="text-danger">Batches CSV File *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="file" class="form-control  form-control-sm" required id="batchfile" name="batchfile" accept=".csv">
            </div>
          </div>
    </div>
</div>


</div>

    </div>



<div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <input class="btn btn-primary btn-sm btn-custom" type="submit" name="newbatchsubmit" value="Save">  <a class="btn btn-primary btn-sm btn-custom-grey" href="products.php">Cancel</a>
    </div>
</div>
</form>
			   
              </div>
            </div>
          </div>
          
          
          
          
          
          
		  <!---->
		  <!--div class="accordion-item mb-1">
            <h5 class="accordion-header" id="headingTwo">
              <button class="accordion-button font-weight-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
			  
			  <div class="customcont-header ml-0 mb-1">
				<a class="customcont-heading">Muliple Rate Import</a>	
             
				</div> 
                
              </button>
            </h5>
            <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo"  style="">
              <div class="accordion-body text-sm">
	<form action="" onsubmit="return checkvalidate()" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
	 
	
	<div class="alert alert-info text-white">
	Kindly Note that the New Product List should be start with <h2 class="text-white"><?=$lastproductid+1?></h2> Otherwise All Old Product Information has been Overrided.
	</div>
	<p>Download a <a href="products.csv">sample file</a> and compare it to your import file to ensure you have the file perfect for the import.</p>
	 
	
	
	<div class="row">
<div class="col-lg-12">


<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="form-group row">
            <div class="col-sm-4">
            <label for="firstname" class="custom-label"><span class="text-danger">Products CSV File *</span></label>
            </div>
            <div class="col-sm-8">
              <input type="file" class="form-control  form-control-sm" required id="productfile" name="productfile" accept=".csv">
            </div>
          </div>
    </div>
</div>


</div>

    </div>



<div class="row justify-content-center">
    <div class="col-lg-12"><hr>
        <input class="btn btn-primary btn-sm btn-custom" type="submit" name="simplesubmit" value="Save">  <a class="btn btn-primary btn-sm btn-custom-grey" href="products.php">Cancel</a>
    </div>
</div>
</form>
			   
              </div>
            </div>
          </div>
		  <!---->
		 

			   
              </div>
			  
			  
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
    <script>
    window.setMobileTable = function(selector) {
        // if (window.innerWidth > 600) return false;
        const tableEl = document.querySelector(selector);
        const thEls = tableEl.querySelectorAll('thead th');
        const tdLabels = Array.from(thEls).map(el => el.innerText);
        tableEl.querySelectorAll('tbody tr').forEach(tr => {
            Array.from(tr.children).forEach(
                (td, ndx) => td.setAttribute('label', tdLabels[ndx])
            );
        });
    }
    </script>


    <script>
    function tableEditorremove() {
        $('#tableEditor').remove();
        return false;
    }
    </script>

    <script>
    $(".checkbox-dropdown").click(function() {
        $(this).toggleClass("is-active");
    });

    $(".checkbox-dropdown ul").click(function(e) {
        e.stopPropagation();
    });








    $("#name").click(function(e) {
        var checkbox = $(this);
        if (checkbox.is(":checked")) {
            //check it 
        } else {
            // prevent from being unchecked
            this.checked = !this.checked;
        }
    });



    $("#rate").click(function(e) {
        var checkbox = $(this);
        if (checkbox.is(":checked")) {
            //check it 
        } else {
            // prevent from being unchecked
            this.checked = !this.checked;
        }
    });


    if ($('#name').is(":checked")) {
        // it is checked  
        //alert("Name column is checked")
    }
    if ($('#rate').is(":checked")) {
        // it is checked  
        //alert("rate column is checked")
    }
    </script>
    <script>
    $(function() {
        var $chk = $(".grpChkBox input:checkbox");
        var $tbl = $("#someTable");
        var $tblhead = $("#someTable th");

        $chk.prop('checked', true);

        $chk.click(function() {
            var colToHide = $tblhead.filter("." + $(this).attr("name"));
            var index = $(colToHide).index();
            $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
        });
    });


    function funaddcolumn() {
        
       // $('#grpChkBox').css("display" , "none");
    }
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

        background-image: url("assets/img/spin.gif");
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