<?php      
$host = "localhost";  
$whitelist = array(
	'127.0.0.1',
	'::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	$tonicuser = "tonic_pairscript";  
	$tonicpassword = 'dNzy2GXyLRteHFbW';  
	$tonicdb_name = "tonic_pairscript"; 
}
else{
	$tonicuser = "root";  
	$tonicpassword = '';  
	$tonicdb_name = "tonic_pairscript"; 
}
$toniccon = mysqli_connect($host, $tonicuser, $tonicpassword, $tonicdb_name);  
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}
$times=date('Y-m-d H:i:s');
if (isset($_POST['tonicsubmit'])) {

	// $tonicpairreportmodules = mysqli_query($toniccon,"INSERT INTO pairreportmodules SET types='[types]', typefields=''");

	// $tonicpairreportfavmodules = mysqli_query($toniccon,"INSERT INTO pairreportfavmodules SET reportnames='[types]', reporturlname='[filename]', reportstatus='0', reportoriginals='[original file name]', reportfunctions='[favourite onclick function]', reporturl='[filename].php?period=thismonth', reporthref=''");

	$tonicpairmodules = mysqli_query($toniccon,"UPDATE pairmodules SET modulecolumns = 'Business Overview,Horizontal Balance Sheet,Horizontal Profit and Loss,Account Transactions,Receivables or Who owes you,Invoice List or Details,Payments Received,Payables or What you owe,Bills List or Details,Payments Made,Taxes,Summary of Inward Supplies opparen GSTR hypens 2 closparen,Summary of Outward Supplies opparen GSTR hypens 1 closparen,Summary of Credit Note,Summary of Debit Note,Customer Balance,Balance,Sales Details,Sales,Product Customer Wise Sales,Product Movement,Sales Person,Profit And Loss,Stock And Sales Statement,Stock And Sales Statement New,Purchase Details,Stock in Hand with Value,Accounts,Journal,Accounts Transactions,Time Tracking,Timesheet Details' WHERE id = 33;");

	$tonicsql = "select * from paircontrols";
	$tonicresult = mysqli_query($toniccon, $tonicsql);
	while($tonicrow = mysqli_fetch_array($tonicresult)){

		if($tonicrow['role']=='SUPER ADMIN'){
			$toniccompanymainid=$tonicrow['id'];
			$toniccompanymainidforaccess=0;
		}
		else{
			$toniccompanymainid=$tonicrow['createdid'];
			$toniccompanymainidforaccess=$tonicrow['createdid'];
		}

		if ($tonicrow['franchises']!='') {

			$tonicfranchiseValues = explode(',', $tonicrow['franchises']);
			if (!empty($tonicfranchiseValues)) {
				foreach ($tonicfranchiseValues as $tonicfranchiseValue) {
					if (!empty($tonicfranchiseValue)) {

						$tonicreportone = mysqli_query($toniccon,"SELECT * FROM pairreports WHERE createdid='$toniccompanymainid' AND franchiseid='".$tonicfranchiseValue."' AND types='timesheet'");

						if (mysqli_num_rows($tonicreportone)==0) {

							$tonicpairreports = mysqli_query($toniccon,"INSERT INTO pairreports SET createdid='$toniccompanymainid', createdby='".$tonicrow['username']."', username='".$tonicrow['username']."', franchiseid='".$tonicfranchiseValue."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='timesheet', rowcolumns='', rowcolumnsorder=''");

							$tonicpairreportfavourites = mysqli_query($toniccon,"INSERT INTO pairreportfavourites SET createdid='$toniccompanymainid', franchisesession='".$tonicfranchiseValue."', reportnames='timesheet', reporturlname='reporttimesheet', reportstatus='0', reportoriginals='Timesheet Details', reportfunctions='favouritetimesheet', reporturl='reporttimesheet.php?period=thismonth&proid=all', reporthref=''");

						}

					}
				}
			}

		}
		else{

			$tonicreportone = mysqli_query($toniccon,"SELECT * FROM pairreports WHERE createdid='$toniccompanymainid' AND types='timesheet'");

			if (mysqli_num_rows($tonicreportone)==0) {

				$tonicpairreports = mysqli_query($toniccon,"INSERT INTO pairreports SET createdid='$toniccompanymainid', createdby='".$tonicrow['username']."', username='".$tonicrow['username']."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='timesheet', rowcolumns='', rowcolumnsorder=''");

				$tonicpairreportfavourites = mysqli_query($toniccon,"INSERT INTO pairreportfavourites SET createdid='$toniccompanymainid',  reportnames='timesheet', reporturlname='reporttimesheet', reportstatus='0', reportoriginals='Timesheet Details', reportfunctions='favouritetimesheet', reporturl='reporttimesheet.php?period=thismonth&proid=all', reporthref=''");

			}

		}
	}

	header("Location:push.php?remarks=Tonic Reports Are Succesfully Pushed");

}
$tonicsqliu=mysqli_query($toniccon, "select count(id) AS id from paircontrols");
$infou=mysqli_fetch_assoc($tonicsqliu);
$tonicuserlen=$infou['id'];
$tonicsql = "select * from paircontrols";
$tonicresult = mysqli_query($toniccon, $tonicsql);
$tonicchecksumbit = 0;
while($tonicrow = mysqli_fetch_array($tonicresult)){

	if($tonicrow['role']=='SUPER ADMIN'){
		$toniccompanymainid=$tonicrow['id'];
		$toniccompanymainidforaccess=0;
	}
	else{
		$toniccompanymainid=$tonicrow['createdid'];
		$toniccompanymainidforaccess=$tonicrow['createdid'];
	}

	if ($tonicrow['franchises']!='') {

		$tonicfranchiseValues = explode(',', $tonicrow['franchises']);
		if (!empty($tonicfranchiseValues)) {
			foreach ($tonicfranchiseValues as $tonicfranchiseValue) {
				if (!empty($tonicfranchiseValue)) {

					$tonicreportone = mysqli_query($toniccon,"SELECT * FROM pairreports WHERE createdid='$toniccompanymainid' AND franchiseid='".$tonicfranchiseValue."' AND types='timesheet'");

					if (mysqli_num_rows($tonicreportone)==0) {

						$tonicchecksumbit = 1;

					}

				}
			}
		}

	}
	else{

		$tonicreportone = mysqli_query($toniccon,"SELECT * FROM pairreports WHERE createdid='$toniccompanymainid' AND types='timesheet'");

		if (mysqli_num_rows($tonicreportone)==0) {

			$tonicchecksumbit = 1;

		}

	}
}

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	$taskyuser = "tasky_pairscript";  
	$taskypassword = 'WYNbbB2PtwS8aitj';  
	$taskydb_name = "tasky_pairscript"; 
}
else{
	$taskyuser = "root";  
	$taskypassword = '';  
	$taskydb_name = "tasky_pairscript"; 
}
$taskycon = mysqli_connect($host, $taskyuser, $taskypassword, $taskydb_name);  
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}
$times=date('Y-m-d H:i:s');
if (isset($_POST['taskysubmit'])) {

	// $taskypairreportmodules = mysqli_query($taskycon,"INSERT INTO pairreportmodules SET types='[types]', typefields=''");

	// $taskypairreportfavmodules = mysqli_query($taskycon,"INSERT INTO pairreportfavmodules SET reportnames='[types]', reporturlname='[filename]', reportstatus='0', reportoriginals='[original file name]', reportfunctions='[favourite onclick function]', reporturl='[filename].php?period=thismonth', reporthref=''");

	$taskypairmodules = mysqli_query($taskycon,"UPDATE pairmodules SET modulecolumns = 'Business Overview,Horizontal Balance Sheet,Horizontal Profit and Loss,Account Transactions,Receivables or Who owes you,Invoice List or Details,Payments Received,Payables or What you owe,Bills List or Details,Payments Made,Taxes,Summary of Inward Supplies opparen GSTR hypens 2 closparen,Summary of Outward Supplies opparen GSTR hypens 1 closparen,Summary of Credit Note,Summary of Debit Note,Customer Balance,Balance,Sales Details,Sales,Product Customer Wise Sales,Product Movement,Sales Person,Profit And Loss,Stock And Sales Statement,Stock And Sales Statement New,Purchase Details,Stock in Hand with Value,Accounts,Journal,Accounts Transactions,Time Tracking,Timesheet Details' WHERE id = 33;");

	$taskysql = "select * from paircontrols";
	$taskyresult = mysqli_query($taskycon, $taskysql);
	while($taskyrow = mysqli_fetch_array($taskyresult)){

		if($taskyrow['role']=='SUPER ADMIN'){
			$taskycompanymainid=$taskyrow['id'];
			$taskycompanymainidforaccess=0;
		}
		else{
			$taskycompanymainid=$taskyrow['createdid'];
			$taskycompanymainidforaccess=$taskyrow['createdid'];
		}

		if ($taskyrow['franchises']!='') {

			$taskyfranchiseValues = explode(',', $taskyrow['franchises']);
			if (!empty($taskyfranchiseValues)) {
				foreach ($taskyfranchiseValues as $taskyfranchiseValue) {
					if (!empty($taskyfranchiseValue)) {

						$taskyreportone = mysqli_query($taskycon,"SELECT * FROM pairreports WHERE createdid='$taskycompanymainid' AND franchiseid='".$taskyfranchiseValue."' AND types='timesheet'");

						if (mysqli_num_rows($taskyreportone)==0) {

							$taskypairreports = mysqli_query($taskycon,"INSERT INTO pairreports SET createdid='$taskycompanymainid', createdby='".$taskyrow['username']."', username='".$taskyrow['username']."', franchiseid='".$taskyfranchiseValue."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='timesheet', rowcolumns='', rowcolumnsorder=''");

							$taskypairreportfavourites = mysqli_query($taskycon,"INSERT INTO pairreportfavourites SET createdid='$taskycompanymainid', franchisesession='".$taskyfranchiseValue."', reportnames='timesheet', reporturlname='reporttimesheet', reportstatus='0', reportoriginals='Timesheet Details', reportfunctions='favouritetimesheet', reporturl='reporttimesheet.php?period=thismonth&proid=all', reporthref=''");

						}

					}
				}
			}

		}
		else{

			$taskyreportone = mysqli_query($taskycon,"SELECT * FROM pairreports WHERE createdid='$taskycompanymainid' AND types='timesheet'");

			if (mysqli_num_rows($taskyreportone)==0) {

				$taskypairreports = mysqli_query($taskycon,"INSERT INTO pairreports SET createdid='$taskycompanymainid', createdby='".$taskyrow['username']."', username='".$taskyrow['username']."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='timesheet', rowcolumns='', rowcolumnsorder=''");

				$taskypairreportfavourites = mysqli_query($taskycon,"INSERT INTO pairreportfavourites SET createdid='$taskycompanymainid',  reportnames='timesheet', reporturlname='reporttimesheet', reportstatus='0', reportoriginals='Timesheet Details', reportfunctions='favouritetimesheet', reporturl='reporttimesheet.php?period=thismonth&proid=all', reporthref=''");

			}


		}
	}

	header("Location:push.php?remarks=Tasky Reports Are Succesfully Pushed");

}
$taskysqliu=mysqli_query($taskycon, "select count(id) AS id from paircontrols");
$infou=mysqli_fetch_assoc($taskysqliu);
$taskyuserlen=$infou['id'];
$taskysql = "select * from paircontrols";
$taskyresult = mysqli_query($taskycon, $taskysql);
$taskychecksumbit = 0;
while($taskyrow = mysqli_fetch_array($taskyresult)){

	if($taskyrow['role']=='SUPER ADMIN'){
		$taskycompanymainid=$taskyrow['id'];
		$taskycompanymainidforaccess=0;
	}
	else{
		$taskycompanymainid=$taskyrow['createdid'];
		$taskycompanymainidforaccess=$taskyrow['createdid'];
	}

	if ($taskyrow['franchises']!='') {

		$taskyfranchiseValues = explode(',', $taskyrow['franchises']);
		if (!empty($taskyfranchiseValues)) {
			foreach ($taskyfranchiseValues as $taskyfranchiseValue) {
				if (!empty($taskyfranchiseValue)) {

					$taskyreportone = mysqli_query($taskycon,"SELECT * FROM pairreports WHERE createdid='$taskycompanymainid' AND franchiseid='".$taskyfranchiseValue."' AND types='timesheet'");

					if (mysqli_num_rows($taskyreportone)==0) {

						$taskychecksumbit = 1;

					}

				}
			}
		}

	}
	else{

		$taskyreportone = mysqli_query($taskycon,"SELECT * FROM pairreports WHERE createdid='$taskycompanymainid' AND types='timesheet'");

		if (mysqli_num_rows($taskyreportone)==0) {

			$taskychecksumbit = 1;

		}

	}
}

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	$betatonicuser = "betatonic_pairsc";  
	$betatonicpassword = 'rcGxtPaMCXWdrfcB';  
	$betatonicdb_name = "betatonic_pairsc"; 
}
else{
	$betatonicuser = "root";  
	$betatonicpassword = '';  
	$betatonicdb_name = "betatonic_pairsc"; 
}
$betatoniccon = mysqli_connect($host, $betatonicuser, $betatonicpassword, $betatonicdb_name);  
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}
$times=date('Y-m-d H:i:s');
if (isset($_POST['betatonicsubmit'])) {

	// $betatonicpairreportmodules = mysqli_query($betatoniccon,"INSERT INTO pairreportmodules SET types='[types]', typefields=''");

	// $betatonicpairreportfavmodules = mysqli_query($betatoniccon,"INSERT INTO pairreportfavmodules SET reportnames='[types]', reporturlname='[filename]', reportstatus='0', reportoriginals='[original file name]', reportfunctions='[favourite onclick function]', reporturl='[filename].php?period=thismonth', reporthref=''");

	$betatonicpairmodules = mysqli_query($betatoniccon,"UPDATE pairmodules SET modulecolumns = 'Business Overview,Horizontal Balance Sheet,Horizontal Profit and Loss,Account Transactions,Receivables or Who owes you,Invoice List or Details,Payments Received,Payables or What you owe,Bills List or Details,Payments Made,Taxes,Summary of Inward Supplies opparen GSTR hypens 2 closparen,Summary of Outward Supplies opparen GSTR hypens 1 closparen,Summary of Credit Note,Summary of Debit Note,Customer Balance,Balance,Sales Details,Sales,Product Customer Wise Sales,Product Movement,Sales Person,Profit And Loss,Stock And Sales Statement,Stock And Sales Statement New,Purchase Details,Stock in Hand with Value,Accounts,Journal,Accounts Transactions,Time Tracking,Timesheet Details' WHERE id = 33;");

	$betatonicsql = "select * from paircontrols";
	$betatonicresult = mysqli_query($betatoniccon, $betatonicsql);
	while($betatonicrow = mysqli_fetch_array($betatonicresult)){

		if($betatonicrow['role']=='SUPER ADMIN'){
			$betatoniccompanymainid=$betatonicrow['id'];
			$betatoniccompanymainidforaccess=0;
		}
		else{
			$betatoniccompanymainid=$betatonicrow['createdid'];
			$betatoniccompanymainidforaccess=$betatonicrow['createdid'];
		}

		if ($betatonicrow['franchises']!='') {

			$betatonicfranchiseValues = explode(',', $betatonicrow['franchises']);
			if (!empty($betatonicfranchiseValues)) {
				foreach ($betatonicfranchiseValues as $betatonicfranchiseValue) {
					if (!empty($betatonicfranchiseValue)) {

						$betatonicreportone = mysqli_query($betatoniccon,"SELECT * FROM pairreports WHERE createdid='$betatoniccompanymainid' AND franchiseid='".$betatonicfranchiseValue."' AND types='timesheet'");

						if (mysqli_num_rows($betatonicreportone)==0) {

							$betatonicpairreports = mysqli_query($betatoniccon,"INSERT INTO pairreports SET createdid='$betatoniccompanymainid', createdby='".$betatonicrow['username']."', username='".$betatonicrow['username']."', franchiseid='".$betatonicfranchiseValue."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='timesheet', rowcolumns='', rowcolumnsorder=''");

							$betatonicpairreportfavourites = mysqli_query($betatoniccon,"INSERT INTO pairreportfavourites SET createdid='$betatoniccompanymainid', franchisesession='".$betatonicfranchiseValue."', reportnames='timesheet', reporturlname='reporttimesheet', reportstatus='0', reportoriginals='Timesheet Details', reportfunctions='favouritetimesheet', reporturl='reporttimesheet.php?period=thismonth&proid=all', reporthref=''");

						}

					}
				}
			}

		}
		else{

			$betatonicreportone = mysqli_query($betatoniccon,"SELECT * FROM pairreports WHERE createdid='$betatoniccompanymainid' AND types='timesheet'");

			if (mysqli_num_rows($betatonicreportone)==0) {

				$betatonicpairreports = mysqli_query($betatoniccon,"INSERT INTO pairreports SET createdid='$betatoniccompanymainid', createdby='".$betatonicrow['username']."', username='".$betatonicrow['username']."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='timesheet', rowcolumns='', rowcolumnsorder=''");

				$betatonicpairreportfavourites = mysqli_query($betatoniccon,"INSERT INTO pairreportfavourites SET createdid='$betatoniccompanymainid',  reportnames='timesheet', reporturlname='reporttimesheet', reportstatus='0', reportoriginals='Timesheet Details', reportfunctions='favouritetimesheet', reporturl='reporttimesheet.php?period=thismonth&proid=all', reporthref=''");

			}

		}
	}

	header("Location:push.php?remarks=Beta Tonic Reports Are Succesfully Pushed");

}
$betatonicsqliu=mysqli_query($betatoniccon, "select count(id) AS id from paircontrols");
$infou=mysqli_fetch_assoc($betatonicsqliu);
$betatonicuserlen=$infou['id'];
$betatonicsql = "select * from paircontrols";
$betatonicresult = mysqli_query($betatoniccon, $betatonicsql);
$betatonicchecksumbit = 0;
while($betatonicrow = mysqli_fetch_array($betatonicresult)){

	if($betatonicrow['role']=='SUPER ADMIN'){
		$betatoniccompanymainid=$betatonicrow['id'];
		$betatoniccompanymainidforaccess=0;
	}
	else{
		$betatoniccompanymainid=$betatonicrow['createdid'];
		$betatoniccompanymainidforaccess=$betatonicrow['createdid'];
	}

	if ($betatonicrow['franchises']!='') {

		$betatonicfranchiseValues = explode(',', $betatonicrow['franchises']);
		if (!empty($betatonicfranchiseValues)) {
			foreach ($betatonicfranchiseValues as $betatonicfranchiseValue) {
				if (!empty($betatonicfranchiseValue)) {

					$betatonicreportone = mysqli_query($betatoniccon,"SELECT * FROM pairreports WHERE createdid='$betatoniccompanymainid' AND franchiseid='".$betatonicfranchiseValue."' AND types='timesheet'");

					if (mysqli_num_rows($betatonicreportone)==0) {

						$betatonicchecksumbit = 1;

					}

				}
			}
		}

	}
	else{

		$betatonicreportone = mysqli_query($betatoniccon,"SELECT * FROM pairreports WHERE createdid='$betatoniccompanymainid' AND types='timesheet'");

		if (mysqli_num_rows($betatonicreportone)==0) {

			$betatonicchecksumbit = 1;

		}

	}
}

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
	$betataskyuser = "betatasky_pairsc";  
	$betataskypassword = 'n7M5YRLw2FT2b2dS';  
	$betataskydb_name = "betatasky_pairsc"; 
}
else{
	$betataskyuser = "root";  
	$betataskypassword = '';  
	$betataskydb_name = "betatasky_pairsc"; 
}
$betataskycon = mysqli_connect($host, $betataskyuser, $betataskypassword, $betataskydb_name);  
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}
$times=date('Y-m-d H:i:s');
if (isset($_POST['betataskysubmit'])) {

	// $betataskypairreportmodules = mysqli_query($betataskycon,"INSERT INTO pairreportmodules SET types='[types]', typefields=''");

	// $betataskypairreportfavmodules = mysqli_query($betataskycon,"INSERT INTO pairreportfavmodules SET reportnames='[types]', reporturlname='[filename]', reportstatus='0', reportoriginals='[original file name]', reportfunctions='[favourite onclick function]', reporturl='[filename].php?period=thismonth', reporthref=''");

	$betataskypairmodules = mysqli_query($betataskycon,"UPDATE pairmodules SET modulecolumns = 'Business Overview,Horizontal Balance Sheet,Horizontal Profit and Loss,Account Transactions,Receivables or Who owes you,Invoice List or Details,Payments Received,Payables or What you owe,Bills List or Details,Payments Made,Taxes,Summary of Inward Supplies opparen GSTR hypens 2 closparen,Summary of Outward Supplies opparen GSTR hypens 1 closparen,Summary of Credit Note,Summary of Debit Note,Customer Balance,Balance,Sales Details,Sales,Product Customer Wise Sales,Product Movement,Sales Person,Profit And Loss,Stock And Sales Statement,Stock And Sales Statement New,Purchase Details,Stock in Hand with Value,Accounts,Journal,Accounts Transactions,Time Tracking,Timesheet Details' WHERE id = 33;");

	$betataskysql = "select * from paircontrols";
	$betataskyresult = mysqli_query($betataskycon, $betataskysql);
	while($betataskyrow = mysqli_fetch_array($betataskyresult)){

		if($betataskyrow['role']=='SUPER ADMIN'){
			$betataskycompanymainid=$betataskyrow['id'];
			$betataskycompanymainidforaccess=0;
		}
		else{
			$betataskycompanymainid=$betataskyrow['createdid'];
			$betataskycompanymainidforaccess=$betataskyrow['createdid'];
		}

		if ($betataskyrow['franchises']!='') {

			$betataskyfranchiseValues = explode(',', $betataskyrow['franchises']);
			if (!empty($betataskyfranchiseValues)) {
				foreach ($betataskyfranchiseValues as $betataskyfranchiseValue) {
					if (!empty($betataskyfranchiseValue)) {

						$betataskyreportone = mysqli_query($betataskycon,"SELECT * FROM pairreports WHERE createdid='$betataskycompanymainid' AND franchiseid='".$betataskyfranchiseValue."' AND types='timesheet'");

						if (mysqli_num_rows($betataskyreportone)==0) {

							$betataskypairreports = mysqli_query($betataskycon,"INSERT INTO pairreports SET createdid='$betataskycompanymainid', createdby='".$betataskyrow['username']."', username='".$betataskyrow['username']."', franchiseid='".$betataskyfranchiseValue."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='timesheet', rowcolumns='', rowcolumnsorder=''");

							$betataskypairreportfavourites = mysqli_query($betataskycon,"INSERT INTO pairreportfavourites SET createdid='$betataskycompanymainid', franchisesession='".$betataskyfranchiseValue."', reportnames='timesheet', reporturlname='reporttimesheet', reportstatus='0', reportoriginals='Timesheet Details', reportfunctions='favouritetimesheet', reporturl='reporttimesheet.php?period=thismonth&proid=all', reporthref=''");

						}

					}
				}
			}

		}
		else{

			$betataskyreportone = mysqli_query($betataskycon,"SELECT * FROM pairreports WHERE createdid='$betataskycompanymainid' AND types='timesheet'");

			if (mysqli_num_rows($betataskyreportone)==0) {

				$betataskypairreports = mysqli_query($betataskycon,"INSERT INTO pairreports SET createdid='$betataskycompanymainid', createdby='".$betataskyrow['username']."', username='".$betataskyrow['username']."', reportperiod='thismonth', filtername='1', names='all',proid='all',category='all',categoryname='', gstrule='0', cusvenname='', companyname='1', dateprepare='1', timeprepare='1', types='timesheet', rowcolumns='', rowcolumnsorder=''");

				$betataskypairreportfavourites = mysqli_query($betataskycon,"INSERT INTO pairreportfavourites SET createdid='$betataskycompanymainid',  reportnames='timesheet', reporturlname='reporttimesheet', reportstatus='0', reportoriginals='Timesheet Details', reportfunctions='favouritetimesheet', reporturl='reporttimesheet.php?period=thismonth&proid=all', reporthref=''");

			}

		}
	}

	header("Location:push.php?remarks=Beta Tasky Reports Are Succesfully Pushed");

}
$betataskysqliu=mysqli_query($betataskycon, "select count(id) AS id from paircontrols");
$infou=mysqli_fetch_assoc($betataskysqliu);
$betataskyuserlen=$infou['id'];
$betataskysql = "select * from paircontrols";
$betataskyresult = mysqli_query($betataskycon, $betataskysql);
$betataskychecksumbit = 0;
while($betataskyrow = mysqli_fetch_array($betataskyresult)){

	if($betataskyrow['role']=='SUPER ADMIN'){
		$betataskycompanymainid=$betataskyrow['id'];
		$betataskycompanymainidforaccess=0;
	}
	else{
		$betataskycompanymainid=$betataskyrow['createdid'];
		$betataskycompanymainidforaccess=$betataskyrow['createdid'];
	}

	if ($betataskyrow['franchises']!='') {

		$betataskyfranchiseValues = explode(',', $betataskyrow['franchises']);
		if (!empty($betataskyfranchiseValues)) {
			foreach ($betataskyfranchiseValues as $betataskyfranchiseValue) {
				if (!empty($betataskyfranchiseValue)) {

					$betataskyreportone = mysqli_query($betataskycon,"SELECT * FROM pairreports WHERE createdid='$betataskycompanymainid' AND franchiseid='".$betataskyfranchiseValue."' AND types='timesheet'");

					if (mysqli_num_rows($betataskyreportone)==0) {

						$betataskychecksumbit = 1;

					}

				}
			}
		}

	}
	else{

		$betataskyreportone = mysqli_query($betataskycon,"SELECT * FROM pairreports WHERE createdid='$betataskycompanymainid' AND types='timesheet'");

		if (mysqli_num_rows($betataskyreportone)==0) {

			$betataskychecksumbit = 1;

		}

	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		include('externals.php');
	?>
	<title>
		Push
	</title>
</head>
<body>
	<main class="main-content  mt-0">
		<section>
			<div class="page-header min-vh-75">
				<div class="container" style="margin: 0px;max-width: 100%;">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12">
							<div class="card card-plain mt-3">
								<div class="card-header pb-0 text-left bg-transparent"></div>
								<div class="card-body">
								<?php
									if(isset($_GET['remarks'])){
								?>
									<div class="alert alert-success text-sm text-white">
										<?=$_GET['remarks']?>
									</div>
								<?php
									}
									if(isset($_GET['error'])){
								?>
									<div class="alert alert-danger text-sm text-white">
										<?=$_GET['error']?>
									</div>
								<?php
									}
								?>
									<div class="row mt-3 mb-3">
										<div class="col-lg-3 mt-3 mb-3" style="border:1px solid grey;">
											<form role="form" method="post">
												<h1 align="center" class="p-3">PUSH</h1>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">
															Name :
														</span>
													</div>
													<div class="col-md-6 p-1">
														Tonic
													</div>
												</div>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">
															Users :
														</span>
													</div>
													<div class="col-md-6 p-1">
														<?=$tonicuserlen?>
													</div>
												</div>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">Push :</span>
													</div>
													<div class="col-md-6 p-1">
														<button type="tonicsubmit" name="tonicsubmit" class="btn btn-primary btn-sm btn-custom" style="<?=(($tonicchecksumbit == 1)?'display: block':'display: none')?>">
															Push
														</button>
														<a class="btn btn-primary btn-sm btn-custom" style="<?=(($tonicchecksumbit == 1)?'display: none':'display: block')?>">
															Pushed
														</a>
													</div>
												</div>
											</form>
										</div>
										<div class="col-lg-3 mt-3 mb-3" style="border:1px solid grey;">
											<form role="form" method="post">
												<h1 align="center" class="p-3">PUSH</h1>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">
															Name :
														</span>
													</div>
													<div class="col-md-6 p-1">
														Tasky
													</div>
												</div>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">
															Users :
														</span>
													</div>
													<div class="col-md-6 p-1">
														<?=$taskyuserlen?>
													</div>
												</div>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">Push :</span>
													</div>
													<div class="col-md-6 p-1">
														<button type="taskysubmit" name="taskysubmit" class="btn btn-primary btn-sm btn-custom" style="<?=(($taskychecksumbit == 1)?'display: block':'display: none')?>">
															Push
														</button>
														<a class="btn btn-primary btn-sm btn-custom" style="<?=(($taskychecksumbit == 1)?'display: none':'display: block')?>">
															Pushed
														</a>
													</div>
												</div>
											</form>
										</div>
										<div class="col-lg-3 mt-3 mb-3" style="border:1px solid grey;">
											<form role="form" method="post">
												<h1 align="center" class="p-3">PUSH</h1>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">
															Name :
														</span>
													</div>
													<div class="col-md-6 p-1">
														Beta Tonic
													</div>
												</div>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">
															Users :
														</span>
													</div>
													<div class="col-md-6 p-1">
														<?=$betatonicuserlen?>
													</div>
												</div>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">Push :</span>
													</div>
													<div class="col-md-6 p-1">
														<button type="betatonicsubmit" name="betatonicsubmit" class="btn btn-primary btn-sm btn-custom" style="<?=(($betatonicchecksumbit == 1)?'display: block':'display: none')?>">
															Push
														</button>
														<a class="btn btn-primary btn-sm btn-custom" style="<?=(($betatonicchecksumbit == 1)?'display: none':'display: block')?>">
															Pushed
														</a>
													</div>
												</div>
											</form>
										</div>
										<div class="col-lg-3 mt-3 mb-3" style="border:1px solid grey;">
											<form role="form" method="post">
												<h1 align="center" class="p-3">PUSH</h1>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">
															Name :
														</span>
													</div>
													<div class="col-md-6 p-1">
														Beta Tasky
													</div>
												</div>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">
															Users :
														</span>
													</div>
													<div class="col-md-6 p-1">
														<?=$betataskyuserlen?>
													</div>
												</div>
												<div class="row m-3" id="aligncenterall">
													<div class="col-sm-6 p-1">
														<span id="insideheadall">Push :</span>
													</div>
													<div class="col-md-6 p-1">
														<button type="betataskysubmit" name="betataskysubmit" class="btn btn-primary btn-sm btn-custom" style="<?=(($betataskychecksumbit == 1)?'display: block':'display: none')?>">
															Push
														</button>
														<a class="btn btn-primary btn-sm btn-custom" style="<?=(($betataskychecksumbit == 1)?'display: none':'display: block')?>">
															Pushed
														</a>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<?php
		include('fexternals.php');
	?>
</body>
</html>