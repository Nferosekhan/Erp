<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Check</title>
</head>
<body>
	<?php
		include('lcheck.php');
		$oldselpayments = mysqli_query($bd,"SELECT id FROM purchasepayments");
		while ($oldfetpayments = mysqli_fetch_array($oldselpayments)) {
			$oldselpayhis = mysqli_query($bd,"SELECT id FROM purchasepayhistory WHERE paymentid='".$oldfetpayments['id']."'");
			if (mysqli_num_rows($oldselpayhis)>0) {}
			else{
				echo "<h1>".$oldfetpayments['id']."</h1>";
			}
		}
	?>
</body>
</html>