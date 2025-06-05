<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE
if (isset($_POST['addsubmit'])) {
	$readonly = htmlspecialchars($_POST['readonly'], ENT_QUOTES, 'UTF-8');
	$required = htmlspecialchars($_POST['required'], ENT_QUOTES, 'UTF-8');
	$typetext = htmlspecialchars($_POST['text'], ENT_QUOTES, 'UTF-8');
	$customdropdown = htmlspecialchars($_POST['customdropdown'], ENT_QUOTES, 'UTF-8');
	$typenumber = htmlspecialchars($_POST['number'], ENT_QUOTES, 'UTF-8');
	$typeemail = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
	$typedate = htmlspecialchars($_POST['date'], ENT_QUOTES, 'UTF-8');
	$typedatetime = htmlspecialchars($_POST['datetime-local'], ENT_QUOTES, 'UTF-8');
	$textarea = htmlspecialchars($_POST['textarea'], ENT_QUOTES, 'UTF-8');
	$file ="";
	$total_count = count($_FILES['file']['name']);
	for( $i=0 ; $i < $total_count ; $i++ ) {
		$files = $_FILES["file"]["tmp_name"][$i];
		if ($files != ""){
			if(is_uploaded_file($files)) {
				$targetFile = "ups/training/".time().basename($_FILES['file']['name'][$i]);
				if (move_uploaded_file($files, $targetFile)) {
					if($file!=""){
						$file.=" | ".$targetFile;
					}
					else{
						$file.="".$targetFile;
					}
				}
			}
			else {
				$file ="";
			}
		}
	}

	$filewithpreviewimage ="";
	$total_count = count($_FILES['filewithpreviewimage']['name']);
	for( $i=0 ; $i < $total_count ; $i++ ) {
		$filewithpreviewimages = $_FILES["filewithpreviewimage"]["tmp_name"][$i];
		if ($filewithpreviewimages != ""){
			if(is_uploaded_file($filewithpreviewimages)) {
				$targetFile = "ups/training/".time().basename($_FILES['filewithpreviewimage']['name'][$i]);
				if (move_uploaded_file($filewithpreviewimages, $targetFile)) {
					if($filewithpreviewimage!=""){
						$filewithpreviewimage.=" | ".$targetFile;
					}
					else{
						$filewithpreviewimage.="".$targetFile;
					}
				}
			}
			else {
				$filewithpreviewimage ="";
			}
		}
	}
	$radio = htmlspecialchars($_POST['allvalue'], ENT_QUOTES, 'UTF-8');
	$singlecheckbox = htmlspecialchars(((isset($_POST['singlecheckbox']))?'1':''), ENT_QUOTES, 'UTF-8');
	$multiplecheckbox='';
	if((isset($_POST['multicheckbox']))&&(!empty($_POST['multicheckbox']))){
		foreach($_POST['multicheckbox'] as $multicheckboxs){
			if($multiplecheckbox!=''){
				if($multicheckboxs!=''){
					$multiplecheckbox.=','.$multicheckboxs;
				}
			}
			else{
				if($multicheckboxs!=''){
					$multiplecheckbox=$multicheckboxs;
				}
			}	
		}	
	}
	if(isset($_POST['withoutnewselect'])){
		$withoutnewselect = htmlspecialchars($_POST['withoutnewselect'], ENT_QUOTES, 'UTF-8');
	}
	else{
		$withoutnewselect='';
	}
	if(isset($_POST['newselect'])){
		$newselect = htmlspecialchars($_POST['newselect'], ENT_QUOTES, 'UTF-8');
	}
	else{
		$newselect='';
	}
	if(isset($_POST['subtextselect'])){
		$subtextselect = htmlspecialchars($_POST['subtextselect'], ENT_QUOTES, 'UTF-8');
	}
	else{
		$subtextselect='';
	}
	if(isset($_POST['mulsubtextselect'])){
		$multiplesubtextselect = htmlspecialchars($_POST['mulsubtextselect'], ENT_QUOTES, 'UTF-8');
	}
	else{
		$multiplesubtextselect='';
	}

	$traininginsert = $con->prepare("INSERT INTO training (createdon,createdby,createdid,franchiseid,readonly,required,customdropdown,typetext,typenumber,typeemail,typedate,typedatetime,textarea,file,filewithpreview,radio,singlecheckbox,multiplecheckbox,withoutnewselect,newselect,subtextselect,multiplesubtextselect) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$traininginsert->bind_param("ssiissssssssssssssssss", $times, $_SESSION["unqwerty"], $companymainid, $_SESSION["franchisesession"], $readonly, $required, $customdropdown, $typetext, $typenumber, $typeemail, $typedate, $typedatetime, $textarea, $file, $filewithpreviewimage, $radio, $singlecheckbox, $multiplecheckbox, $withoutnewselect, $newselect, $subtextselect, $multiplesubtextselect);
	if($traininginsert->execute()){
		$idvalue = $con->insert_id;
		header("Location: training.php?id=".$idvalue."&remarks=Added Successfully");
		$traininginsert->close();
	}
	else{
		echo mysqli_error($con);
	}
}
else{
	if ((isset($_POST['editsubmit']))&&($_POST['idvalue']!='')) {
		$idvalue = htmlspecialchars($_POST['idvalue'], ENT_QUOTES, 'UTF-8');
		$readonly = htmlspecialchars($_POST['readonlyedit'], ENT_QUOTES, 'UTF-8');
		$required = htmlspecialchars($_POST['requirededit'], ENT_QUOTES, 'UTF-8');
		$customdropdown = htmlspecialchars($_POST['customdropdownedit'], ENT_QUOTES, 'UTF-8');
		$typetext = htmlspecialchars($_POST['textedit'], ENT_QUOTES, 'UTF-8');
		$typenumber = htmlspecialchars($_POST['numberedit'], ENT_QUOTES, 'UTF-8');
		$typeemail = htmlspecialchars($_POST['emailedit'], ENT_QUOTES, 'UTF-8');
		$typedate = htmlspecialchars($_POST['dateedit'], ENT_QUOTES, 'UTF-8');
		$typedatetime = htmlspecialchars($_POST['datetime-localedit'], ENT_QUOTES, 'UTF-8');
		$textarea = htmlspecialchars($_POST['textareaedit'], ENT_QUOTES, 'UTF-8');
		$file =htmlspecialchars($_POST['fileeditvalue'], ENT_QUOTES, 'UTF-8');
		$total_count = count($_FILES['fileedit']['name']);
		for( $i=0 ; $i < $total_count ; $i++ ) {
			$files = $_FILES["fileedit"]["tmp_name"][$i];
			if ($files != ""){
				if(is_uploaded_file($files)) {
					$targetFile = "ups/training/".time().basename($_FILES['fileedit']['name'][$i]);
					if (move_uploaded_file($files, $targetFile)) {
						if($file!=""){
							$file.=" | ".$targetFile;
						}
						else{
							$file.="".$targetFile;
						}
					}
				}
				else {
					$file ="";
				}
			}
		}

		$filewithpreviewimage =htmlspecialchars($_POST['filewithpreviewimagesedit'], ENT_QUOTES, 'UTF-8');
		$total_count = count($_FILES['filewithpreviewimageedit']['name']);
		for( $i=0 ; $i < $total_count ; $i++ ) {
			$filewithpreviewimages = $_FILES["filewithpreviewimageedit"]["tmp_name"][$i];
			if ($filewithpreviewimages != ""){
				if(is_uploaded_file($filewithpreviewimages)) {
					$targetFile = "ups/training/".time().basename($_FILES['filewithpreviewimageedit']['name'][$i]);
					if (move_uploaded_file($filewithpreviewimages, $targetFile)) {
						if($filewithpreviewimage!=""){
							$filewithpreviewimage.=" | ".$targetFile;
						}
						else{
							$filewithpreviewimage.="".$targetFile;
						}
					}
				}
				else {
					$filewithpreviewimage ="";
				}
			}
		}
		$radio = htmlspecialchars($_POST['allvalueedit'], ENT_QUOTES, 'UTF-8');
		$singlecheckbox = htmlspecialchars(((isset($_POST['singlecheckboxedit']))?$_POST['singlecheckboxedit']:''), ENT_QUOTES, 'UTF-8');
		$multiplecheckbox='';
		if((isset($_POST['multicheckboxedit']))&&(!empty($_POST['multicheckboxedit']))){
			foreach($_POST['multicheckboxedit'] as $multicheckboxs){
				if($multiplecheckbox!=''){
					if($multicheckboxs!=''){
						$multiplecheckbox.=','.$multicheckboxs;
					}
				}
				else{
					if($multicheckboxs!=''){
						$multiplecheckbox=$multicheckboxs;
					}
				}	
			}	
		}
		if(isset($_POST['withoutnewselectedit'])){
			$withoutnewselect = htmlspecialchars($_POST['withoutnewselectedit'], ENT_QUOTES, 'UTF-8');
		}
		else{
			$withoutnewselect='';
		}
		if(isset($_POST['newselectedit'])){
			$newselect = htmlspecialchars($_POST['newselectedit'], ENT_QUOTES, 'UTF-8');
		}
		else{
			$newselect='';
		}
		if(isset($_POST['subtextselectedit'])){
			$subtextselect = htmlspecialchars($_POST['subtextselectedit'], ENT_QUOTES, 'UTF-8');
		}
		else{
			$subtextselect='';
		}
		if(isset($_POST['mulsubtextselectedit'])){
			$multiplesubtextselect = htmlspecialchars($_POST['mulsubtextselectedit'], ENT_QUOTES, 'UTF-8');
		}
		else{
			$multiplesubtextselect='';
		}

		$trainingupdate = $con->prepare("UPDATE training SET readonly=?, required=?, customdropdown=?, typetext=?, typenumber=?, typeemail=?, typedate=?, typedatetime=?, textarea=?, file=?, filewithpreview=?, radio=?, singlecheckbox=?, multiplecheckbox=?, withoutnewselect=?, newselect=?, subtextselect=?, multiplesubtextselect=? WHERE id=?");
		$trainingupdate->bind_param("ssssssssssssssssssi", $readonly, $required, $customdropdown, $typetext, $typenumber, $typeemail, $typedate, $typedatetime, $textarea, $file, $filewithpreviewimage, $radio, $singlecheckbox, $multiplecheckbox, $withoutnewselect, $newselect, $subtextselect, $multiplesubtextselect, $idvalue);
		if($trainingupdate->execute()){
			header("Location: training.php?id=".$idvalue."&remarks=Updated Successfully");
			$trainingupdate->close();
		}
		else{
			echo mysqli_error($con);
		}
	}
	else{
		header("Location: training.php?error=Please Select The Data From The Listing Table");
	}
}
?>