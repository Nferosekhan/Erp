<?php
include('lcheck.php');
//FOR INCLUDE THE COMMON FILE
?>
<!DOCTYPE html>
<html>
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
		Training
	</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<style type="text/css">
	/* For Custom Dropdown */
/*	@media screen and (max-width: 991px){
		.outputdropdown {
			width: 200px !important;
			right: 25px !important;
		}
	}*/
	.outputdropdown {
		position: relative;
		float: right;
		background-color: #fff;
		border: 1px solid #cccccc !important;
		border-radius: 0 0 5px 5px;
		border-top: none;
		font-family: sans-serif;
		width: 100% !important;
		padding: 0px;
		max-height: 5rem;
		overflow-y: auto;
		border-bottom: 1px solid #cccccc !important;
	}
	.outputdropdown div td{
		white-space: nowrap !important;
	}
	.outputdropdown div {
		background-color: #fff;
		padding: 0px;
		color: black;
		margin-bottom: 0px;
		font-size: 13px;
		cursor: pointer;
	}
	.outputdropdown div:hover{
		background-color: #1BBC9B !important;
		color: #fff;
	}
	/* For Custom Dropdown */
	/*for table design in mobile view*/
	@media screen and (max-width: 1100px){
		table {
			border: 0;
			margin-top: 30px;
		}
		.outputdropdown div table{
			margin: 0px !important;
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
			height: 32.64px !important;
		}
		.outputdropdown div table td {
			height: 27px !important;
		}
		table td::before {
			color: black !important;
			content: attr(data-label);
			float: left;
			font-weight: normal;
			text-transform: uppercase;
		}
		#loadimgins{
			width: 100% !important;
		}
		table td:last-child {
			border-bottom: 0;
		}
	}
	/*for table design in mobile view*/
	/*for auto scroll in view page nav tabs*/
	#nav-tab::-webkit-scrollbar {
		width: 0px;
		height: 0px !important;
		background-color: green !important;
		display: none !important;
	}

	#nav-tab::-webkit-scrollbar-thumb {
		background-color: green !important;
	}

	#nav-tab::-webkit-scrollbar-track {
		background-color: green;
	}

	#nav-tab::-webkit-scrollbar-button:horizontal:increment {
		background-color: #ffffff !important;
		height: 12px;
		width: 12px;
	}

	#nav-tab::-webkit-scrollbar-button:horizontal:decrement {
		background-color: #ffffff !important;
		height: 12px;
		width: 12px;
	}
	.scrollbar-2 {
		scrollbar-width: none !important;
		scrollbar-color: #ffffff #ffffff;
	}
	.scrollbar-2:hover{
		scrollbar-width: none !important;
		scrollbar-color: transparent transparent;
	}
	.nav-tabs button{
		margin-bottom: 1px !important;
	}
	@media screen and (max-width: 991px){
		.nav-tabs .nav-link{
			padding: 1px !important;
		}
	}
	.nav-tabs .customcont-header{
		border-bottom: 0px !important;
	}
	/*for auto scroll in view page nav tabs*/
	/*for new select*/
	/*using the title as our value [title="New Select"]*/
	.select2-container--default .select2-selection--single .select2-selection__rendered[title="New Select"]{
		color:#b9c0c7 !important;
		line-height:28px;
	}
	.select2-container .select2-selection--single{
		box-sizing:border-box;
		cursor:pointer;
		display:block;
		height:32px;
		user-select:none;
		-webkit-user-select:none
	}
	/*for new select*/
	/*for without new select*/
	/*withoutnewselect is id*/
	/*using the title as our value [title="Without New Select"]*/
	span#select4-withoutnewselect-container[title="Without New Select"]{
		color:#b9c0c7 !important;
		line-height:28px;
	}
	/*for without new select edit*/
	/*for without new select edit*/
	/*withoutnewselectedit is id*/
	/*using the title as our value [title="Without New Select"]*/
	span#select4-withoutnewselectedit-container[title="Without New Select"]{
		color:#b9c0c7 !important;
		line-height:28px;
	}
	/*for without new select edit*/
	/*for subtext select*/
	.foo {
		color: #808080;
		text-size: smaller;
		margin-top: -3px !important;
	}
	.foo:hover {
		color: #ffffff;
	}
	/*using the title as our value [title="Sub Text Select"]*/
	.select2-container--default .select2-selection--single .select2-selection__rendered[title="Sub Text Select"]{
		color:#b9c0c7 !important;
		line-height:28px;
	}
	/*for subtext select*/
	</style>
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
			if(isset($_GET['remarks'])){
		?>
		<div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #53b05a !important;margin-top: -50px;border-radius: 0px !important;">
			<button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button>
			<p style="position: relative;top: -10px;color: white !important;background-color: #53b05a !important;">
				<i class="fa fa-check"></i> &nbsp;<?=$_GET['remarks']?>
			</p>
		</div>
		<?php
			}
			if(isset($_GET['error'])){
		?>
		<div class="alert alert-dismissible" style="position: relative;top: 50px;z-index: 1999;height: 10px;background-color: #d64830 !important;margin-top: -50px;border-radius: 0px !important;">
			<button type="button" class="btn-close" data-bs-dismiss="alert" style="z-index: 900000;color: white;top: -11px;background-image: white !important;"></button>
			<p style="position: relative;top: -10px;color: white !important;background-color: #d64830 !important;">
				<i class="fa fa-times"></i> &nbsp;<?=$_GET['error']?>
			</p>
		</div>
		<?php
			}
		?>
		<!-- FOR ALERT MESSAGES -->
		<div id="fullcontainerwidth">
			<div class="row min-height-480">
				<div class="col-12">
					<div class="card mb-4 mt-5 p-3">
						<div class="card-body p-0">
							<div style="box-shadow:0 2px 6px 0 rgba(0, 0, 0, 20%);" class="card card-body">
								<p class="mb-3 mt-0 ml-0 headingall" data-toggle="tooltip" title="Training List" data-placement="right" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
									Training List
								</p>
								<div class="table-responsive p-0 min-height-480 mt-5" style="overflow-x: hidden;">
									<table id="someTable" class="table align-items-center table-bordered mb-0" style="table-layout: fixed;">
										<thead>
											<tr>
												<td class="text-uppercase" style="width:50px;">
													<span style="font-size:13px;color:black;">
														Required
													</span>
												</td>
												<td class="text-uppercase" style="width:50px;">
													<span style="font-size:13px;color:black;">
														Text
													</span>
												</td>
												<td class="text-uppercase" style="width:50px;">
													<span style="font-size:13px;color:black;">
														Number
													</span>
												</td>
												<td class="text-uppercase" style="width:50px;">
													<span style="font-size:13px;color:black;">
														Email
													</span>
												</td>
												<td class="text-uppercase" style="width:50px;">
													<span style="font-size:13px;color:black;">
														Date
													</span>
												</td>
											</tr>
										</thead>
										<tbody>
										<?php
											$count=1;
											$sqlis=$con->prepare("SELECT * FROM training ORDER BY id ASC");
											$sqlis->execute();
											$sqli = $sqlis->get_result();
											while($info=$sqli->fetch_array()){
										?>
											<tr style="font-size: 0.775rem !important;" onclick="window.open('training.php?id=<?=$info['id']?>', '_self')">
												<td data-label="Required">
													<span style="color:#1878F1" class="mb-0 text-sm">
														<?=(($info['required']=='')?'&nbsp;':$info['required'])?>
													</span>
												</td>
												<td data-label="Text">
													<span class="mb-0 text-sm">
														<?=(($info['typetext']=='')?'&nbsp;':$info['typetext'])?>
													</span>
												</td>
												<td data-label="Number">
													<span class="mb-0 text-sm">
														<?=(($info['typenumber']=='')?'&nbsp;':$info['typenumber'])?>
													</span>
												</td>
												<td data-label="Email">
													<span class="mb-0 text-sm">
														<?=(($info['typeemail']=='')?'&nbsp;':$info['typeemail'])?>
													</span>
												</td>
												<td data-label="Date">
													<span class="mb-0 text-sm">
														<?=(($info['typedate']=='')?'&nbsp;':date($datemainphp,strtotime($info['typedate'])))?>
													</span>
												</td>
											</tr>
										<?php
												$count++;
											}
										?>
										</tbody>
									</table>
								</div>
							</div>
								<!-- form start -->
								<form method="POST" action="trainingaction.php" enctype="multipart/form-data" class="mt-5">
									<div style="box-shadow:0 2px 6px 0 rgba(0, 0, 0, 20%);" class="card card-body">
										<p class="mb-3 mt-0 ml-0 headingall" data-toggle="tooltip" title="New Training" data-placement="right" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
											<i class="fa fa-plus-square-o"></i> New Training
										</p>
										<header class="app-header fixed-bottom" style="height:48px !important;z-index: 1 !important;">
											<div class="app-header-inner">  
												<div class="py-2 px-3">
													<div class="app-header-content" style="margin-left: -45px;" id="ilu"> 
														<div class="row">
															<div class="col-auto pt-1" style="width:34px !important;margin-top: -8px !important;height: 100px;margin-left: -18px !important;border-top: 1px solid #eff0f4;">
															</div>
															<div class="col" style="width:34px !important;margin-top: 1px !important;margin-left: -9px !important;">
																<button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="addsubmit" value="Submit">
																	<span class="label">
																		Add
																	</span>
																	<span class="spinner"></span>
																</button>
																<button class="btn btn-primary btn-sm btn-custom arlina-button expand-left" style="margin-left: 10px !important;margin-top: -3px !important;" type="submit" id="submit" name="editsubmit" value="Submit">
																	<span class="label">
																		Edit
																	</span>
																	<span class="spinner"></span>
																</button>
																<a class="btn btn-primary btn-sm btn-custom-grey" href="training.php" style="margin-top:-3px !important;">
																	Cancel
																</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</header>
										<!-- Just Training Modal -->
										<div class="modal fade" id="Selectmodaldemo" tabindex="-1" role="dialog" aria-labelledby="SelectmodaldemoLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content" style="border-radius: 0px !important;">
													<div class="modal-header" style="border-radius:0px !important;">
														<h5 class="modal-title" id="SelectmodaldemoLabel" style="font-weight: normal !important;color: black !important;">
															Your Details
														</h5>
														<span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
															<span aria-hidden="true" style="font-weight: 600 !important;font-size: 21px !important;">
																&times; <!-- this is html entity for close symbol -->
															</span>
														</span>
													</div>
													<div class="modal-body">
														<p style="font-size:15px !important;">
															Details In Anyway Based On Our Customer Request
														</p>
													</div>
													<div class="modal-footer" style="margin-top: 33px !important;text-align: right !important;">
														<a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;">
															<p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; 
																<span style="margin-left: -5px;width: max-content;">
																	Close
																</span>
															</p>
														</a>
													</div>
												</div>
											</div>
										</div>
										<!-- Just Training Modal -->
										<!-- accordion start -->
										<div class="accordion" id="accordionRental" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
											<div class="accordion-item mb-1">
												<h5 class="accordion-header" id="headingOne">
													<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
														<div class="customcont-header ml-0 mb-1">
															<a class="customcont-heading">
																Inputs Information
															</a>
														</div>
													</button>
												</h5>
												<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
													<div class="accordion-body text-sm">
														<!-- inside start -->
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="readonly" class="custom-label">
																			Read Only
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="text" class="form-control form-control-sm" id="readonly" name="readonly" value="Read only" placeholder="Read Only" readonly>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="required" class="custom-label">
																			<span class="text-danger">
																				Required *
																			</span>
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="text" class="form-control form-control-sm" id="required" name="required" placeholder="Required" required value="Required">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="text" class="custom-label">
																			Custom Drop Down
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="text" class="form-control form-control-sm" id="customdropdown" name="customdropdown" placeholder="Enter Your Text" onClick="customdatasearch()" onFocus="customdatasearch()" list="" autocomplete="off">
																		<div>
																			<div id="outputdropdown" class="outputdropdown" style="display:none;width: 250px;">
																			</div>
																			<input type="text" id="searcherrormessage" style="display:none;">
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="text" class="custom-label">
																			Text
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="text" class="form-control form-control-sm" id="text" name="text" placeholder="Enter Your Text">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="number" class="custom-label">
																			Number
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="number" class="form-control form-control-sm" id="number" name="number" placeholder="Enter Your Number">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="email" class="custom-label">
																			Email
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter Your Email">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="date" class="custom-label">
																			Date
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="date" class="form-control form-control-sm" id="date" name="date">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="datetime-local" class="custom-label">
																			Date Time
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="datetime-local" class="form-control form-control-sm" id="datetime-local" name="datetime-local">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="textarea" class="custom-label">
																			Text Area
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<textarea class="form-control" id="textarea" name="textarea" placeholder="Text Area"></textarea>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="file" class="custom-label">
																			File
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="file" class="form-control form-control-sm" id="file" name="file[]">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="filewithpreview" class="custom-label">
																			File With Preview
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<img alt="Image" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="filewithpreview-image1" style="height: 30px !important;width: 30px !important;">
																		<input id="filewithpreview-image-upload" type="file" style="display:none" class="form-control  form-control-sm" id="filewithpreviewimage" name="filewithpreviewimage[]" accept="image/*" onchange="previewfilewithpreview()" >
																		<input type="hidden" name="filewithpreviewimages" value="">
																		<span style="color:#4285F4; cursor:pointer"  id="filewithpreview-image2">
																			Upload Image
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="value" class="custom-label">
																			Radio
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<div class="row">
																			<div class="col-sm-4 my-1">
																				<div class="custom-control custom-radio mr-sm-2" style="z-index: 0;">
																					<input type="radio" class="custom-control-input" name="allvalue" id="value" value="value" checked>
																					<label class="custom-control-label custom-label" for="value">
																						Value
																					</label>
																				</div>
																			</div>
																			<div class="col-sm-4 my-1">
																				<div class="custom-control custom-radio mr-sm-2" style="z-index: 0;">
																					<input type="radio" class="custom-control-input" name="allvalue" id="values" value="values">
																					<label class="custom-control-label custom-label" for="values">
																						Values
																					</label>
																				</div>
																			</div>
																			<div class="col-sm-4 my-1">
																				<div class="custom-control custom-radio mr-sm-2" style="z-index: 0;">
																					<input type="radio" class="custom-control-input" name="allvalue" id="disabled" value="disabled" disabled>
																					<label class="custom-control-label custom-label" for="disabled">
																						Disabled
																					</label>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="singlecheckbox" class="custom-label">
																			Single Check Box
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																			<input type="checkbox" class="custom-control-input" id="singlecheckbox" name="singlecheckbox" checked>
																			<label class="custom-control-label custom-label" for="singlecheckbox">
																				One
																			</label>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="onecheckbox" class="custom-label">
																			Multi Check Box
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<div class="row">
																			<div class="col-lg-4">
																				<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																					<input type="checkbox" class="custom-control-input" id="disabledcheckbox" name="multicheckbox[]" checked disabled value="disabledcheckbox">
																					<label class="custom-control-label custom-label" for="disabledcheckbox">
																						Disabled
																					</label>
																				</div>
																			</div>
																			<div class="col-lg-4">
																				<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																					<input type="checkbox" class="custom-control-input" id="twocheckbox" name="multicheckbox[]" checked value="twocheckbox">
																					<label class="custom-control-label custom-label" for="twocheckbox">
																						Two
																					</label>
																				</div>
																			</div>
																			<div class="col-lg-4">
																				<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																					<input type="checkbox" class="custom-control-input" id="threecheckbox" name="multicheckbox[]" checked value="threecheckbox">
																					<label class="custom-control-label custom-label" for="threecheckbox">
																						Three
																					</label>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<!-- inside end -->
													</div>
												</div>
											</div>
										</div>
										<!-- accordion end -->
										<!-- accordion start -->
										<div class="accordion" id="accordionRental" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
											<div class="accordion-item mb-1">
												<h5 class="accordion-header" id="headingSelect">
													<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSelect" aria-expanded="true" aria-controls="collapseSelect">
														<div class="customcont-header ml-0 mb-1">
															<a class="customcont-heading">
																Select Information
															</a>
														</div>
													</button>
												</h5>
												<div id="collapseSelect" class="accordion-collapse collapse show" aria-labelledby="headingSelect">
													<div class="accordion-body text-sm">
														<!-- inside start -->
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="withoutnewselect" class="custom-label">
																			Without New Select
																		</label>
																	</div>
																	<!-- use this for select input  onclick="andus()" -->
																	<!-- add select4 for without new option -->
																	<div class="col-sm-8" onclick="andus()">
																		<select class="select4 form-control form-control-sm" name="withoutnewselect" id="withoutnewselect">
																			<option selected disabled hidden>Without New Select</option>
																			<option value="One">
																				One
																			</option>
																			<option value="Two">
																				Two
																			</option>
																			<option value="Three">
																				Three
																			</option>
																			<option value="Four">
																				Four
																			</option>
																			<option value="Five">
																				Five
																			</option>
																			<option value="Six">
																				Six
																			</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="newselect" class="custom-label">
																			New Select
																		</label>
																	</div>
																	<!-- use this for select input  onclick="andus()" -->
																	<div class="col-sm-8" onclick="andus()">
																		<select class="form-control form-control-sm" name="newselect" id="newselect">
																			<option selected disabled hidden>New Select</option>
																			<option value="One">
																				One
																			</option>
																			<option value="Two">
																				Two
																			</option>
																			<option value="Three">
																				Three
																			</option>
																			<option value="Four">
																				Four
																			</option>
																			<option value="Five">
																				Five
																			</option>
																			<option value="Six">
																				Six
																			</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="subtextselect" class="custom-label">
																			Sub Text Select
																		</label>
																	</div>
																	<!-- add select4 for without new option -->
																	<div class="col-sm-8">
																		<select class="form-control form-control-sm subtextselect" name="subtextselect" id="subtextselect">
																			<option selected disabled hidden data-foo="Sub Text Select">Sub Text Select</option>
																			<option data-foo="One Sub Text" value="One">
																				One
																			</option>
																			<option data-foo="Two Sub Text" value="Two">
																				Two
																			</option>
																			<option data-foo="Three Sub Text" value="Three">
																				Three
																			</option>
																			<option data-foo="Four Sub Text" value="Four">
																				Four
																			</option>
																			<option data-foo="Five Sub Text" value="Five">
																				Five
																			</option>
																			<option data-foo="Six Sub Text" value="Six">
																				Six
																			</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="mulsubtextselect" class="custom-label">
																			Multiple Sub Text Select
																		</label>
																	</div>
																	<!-- add select4 for without new option -->
																	<div class="col-sm-8">
																		<select class="form-control form-control-sm mulsubtextselect" name="mulsubtextselect" id="mulsubtextselect">
																			<option selected disabled hidden data-foo="Sub Text Select">Sub Text Select</option>
																			<option data-foo="One Sub Text" value="One">
																				One
																			</option>
																			<option data-foo="Two Sub Text" value="Two">
																				Two
																			</option>
																			<option data-foo="Three Sub Text" value="Three">
																				Three
																			</option>
																			<option data-foo="Four Sub Text" value="Four">
																				Four
																			</option>
																			<option data-foo="Five Sub Text" value="Five">
																				Five
																			</option>
																			<option data-foo="Six Sub Text" value="Six">
																				Six
																			</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<!-- inside end -->
													</div>
												</div>
											</div>
										</div>
										<!-- accordion end -->
									</div>
									<?php
										$idvalue = '';
										$readonly = '';
										$required = 'Required';
										$customdropdown = '';
										$typetext = '';
										$typenumber = '';
										$typeemail = '';
										$typedate = '';
										$typedatetime = '';
										$textarea = '';
										$file = '';
										$filewithpreview = '';
										$radio = '';
										$singlecheckbox = '';
										$multiplecheckbox = 'f,f,f';
										$multiplecheckboxans = explode(',', $multiplecheckbox);
										$withoutnewselect = '';
										$newselect = '';
										$subtextselect = '';
										$multiplesubtextselect = '';
										if (isset($_GET['id'])) {
											$idvalue = $_GET['id'];
											$sqliedits=$con->prepare("SELECT * FROM training WHERE id=? ORDER BY id ASC");
											$sqliedits->bind_param('i', $idvalue);
											$sqliedits->execute();
											$sqliedit = $sqliedits->get_result();
											$infoedit=$sqliedit->fetch_array();
											$readonly = $infoedit['readonly'];
											$required = $infoedit['required'];
											$customdropdown = $infoedit['customdropdown'];
											$typetext = $infoedit['typetext'];
											$typenumber = $infoedit['typenumber'];
											$typeemail = $infoedit['typeemail'];
											$typedate = $infoedit['typedate'];
											$typedatetime = $infoedit['typedatetime'];
											$textarea = $infoedit['textarea'];
											$file = $infoedit['file'];
											$filewithpreview = $infoedit['filewithpreview'];
											$radio = $infoedit['radio'];
											$singlecheckbox = $infoedit['singlecheckbox'];
											$multiplecheckbox = $infoedit['multiplecheckbox'];
											$multiplecheckboxans = explode(',', $multiplecheckbox);
											$withoutnewselect = $infoedit['withoutnewselect'];
											$newselect = $infoedit['newselect'];
											$subtextselect = $infoedit['subtextselect'];
											$multiplesubtextselect = $infoedit['multiplesubtextselect'];
										}
									?>
									<div style="box-shadow:0 2px 6px 0 rgba(0, 0, 0, 20%);" class="card card-body mt-5">
										<div id="fullcontainerwidth">
											<div class="row min-height-480">
												<div class="col-12">
													<div class="mb-4 mt-5">
														<div class="p-3" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
															<div class="row">
																<div class="col-lg-6">
																	<p class="mb-3" style="font-size: 20px;">
																		<i class="fa fa-eye"></i> Training Details
																	</p>
																</div>
																<div class="col-lg-6">
																	<span style="float:right;" class="mb-3">
																		<a class="btn btn-primary btn-sm btn-custom-grey" href="training.php" id="btngopage">
																			<i class="fa fa-pencil-alt"></i> Edit
																		</a>
																	</span>
																</div>
															</div>
															<nav>
																<div style="margin-top: -42px !important;">
																	<div style="visibility: visible;" id="arrowsalltabs">
																		<svg id="rightarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb pull-right" onclick="rightarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-right: -15px !important;position: relative;top: 40px !important;z-index: 1 !important;cursor: pointer;height: 39px;width: 30px;">
																			<path d="M0 0h24v24H0z" fill="none"></path>
																			<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
																		</svg>
																		<svg id="leftarrow" viewBox="0 0 24 24" focusable="false" class="dyAbMb" onclick="leftarrow()" style="font-size: 18px !important;padding: 0px !important;background-color: #fff !important;margin-left: -15px !important;position: relative;top: 40px !important;z-index: 1 !important;cursor: pointer;height: 39px;width: 30px;transform: rotate(180deg);visibility: hidden;">
																			<path d="M0 0h24v24H0z" fill="none"></path>
																			<path d="M8.59,16.59L13.17,12L8.59,7.41L10,6l6,6l-6,6L8.59,16.59z"></path>
																		</svg>
																	</div>
																	<div ontouchmove="checkscrolltouch()" class="nav nav-tabs scrollbar-2" id="nav-tab" role="tablist" style="flex-wrap: nowrap !important;white-space: nowrap !important;overflow: scroll;overflow-y: hidden !important;padding-bottom: 0.5px !important;">
																		<button class="nav-link active" id="nav-overview-tab" data-bs-toggle="tab" data-bs-target="#nav-overview" type="button" role="tab" aria-controls="nav-overview" aria-selected="true">
																			<div class="customcont-header ml-0">
																				<a class="customcont-heading">
																					Overview
																				</a>  
																			</div>
																		</button>
																		<button class="nav-link" id="nav-other-tab" data-bs-toggle="tab" data-bs-target="#nav-other" type="button" role="tab" aria-controls="nav-other" aria-selected="false">
																			<div class="customcont-header ml-0">
																				<a class="customcont-heading">
																					Others
																				</a>  
																			</div>
																		</button>
																	</div>
																</div>
															</nav>
															<div class="tab-content" id="nav-tabContent">
																<div class="tab-pane fade show active" id="nav-overview" role="tabpanel" aria-labelledby="nav-overview-tab">
																	<p class="m-3" style="font-size: 17px;">
																		Inputs Information
																	</p>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Read Only
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$readonly?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Required
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$required?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Custom Drop Down
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$customdropdown?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Text
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$typetext?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Number
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$typenumber?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Email
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$typeemail?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Date
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=date($datemainphp,strtotime($typedate))?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Date Time
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=date('d/m/Y h:i:s A',strtotime($typedatetime))?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Text Area
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$textarea?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				File
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
	                                								<img src="<?=$file?>" width="50" height="50" style="<?=(($file!='')?'':'display: none;')?>">
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				File With Preview
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
	                                								<img src="<?=$filewithpreview?>" width="50" height="50" style="<?=(($filewithpreview!='')?'':'display: none;')?>">
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Radio
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<div class="row">
																				<div class="col-sm-4" style="z-index: 0;">
																					<div class="custom-control custom-radio mr-sm-2">
																						<input type="radio" class="custom-control-input" name="allvalueview" id="valueview" <?= $radio=='value'?'checked':'' ?>  disabled>
																						<label class="custom-control-label custom-label" for="valueview">
																							Value
																						</label>
																					</div>
																				</div>
																				<div class="col-sm-4" style="z-index: 0;">
																					<div class="custom-control custom-radio mr-sm-2">
																						<input type="radio" class="custom-control-input" name="allvalueview" id="valuesview" <?= $radio=='values'?'checked':'' ?>  disabled>
																						<label class="custom-control-label custom-label" for="valuesview">
																							Values
																						</label>
																					</div>
																				</div>
																				<div class="col-sm-4" style="z-index: 0;">
																					<div class="custom-control custom-radio mr-sm-2">
																						<input type="radio" class="custom-control-input" name="allvalueview" id="disabledview" <?= $radio=='disabled'?'checked':'' ?>  disabled>
																						<label class="custom-control-label custom-label" for="disabledview">
																							Disabled
																						</label>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Single Check Box
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																				<input type="checkbox" class="custom-control-input" id="singlecheckboxview" name="singlecheckboxview" <?=(($singlecheckbox=='1')?'checked':'')?> disabled>
																				<label class="custom-control-label custom-label" for="singlecheckboxview">
																					One
																				</label>
																			</div>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Multiple Check Box
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<div class="row">
																				<div class="col-lg-4">
																					<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																						<input type="checkbox" class="custom-control-input" id="disabledcheckboxview" name="multicheckboxview[]" checked disabled>
																						<label class="custom-control-label custom-label" for="disabledcheckboxview">
																							Disabled
																						</label>
																					</div>
																				</div>
																				<div class="col-lg-4">
																					<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																						<input type="checkbox" class="custom-control-input" id="twocheckboxview" name="multicheckboxview[]" <?=((in_array('twocheckbox', $multiplecheckboxans))?'checked':'')?> disabled>
																						<label class="custom-control-label custom-label" for="twocheckboxview">
																							Two
																						</label>
																					</div>
																				</div>
																				<div class="col-lg-4">
																					<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																						<input type="checkbox" class="custom-control-input" id="threecheckboxview" name="multicheckboxview[]" <?=((in_array('threecheckbox', $multiplecheckboxans))?'checked':'')?> disabled>
																						<label class="custom-control-label custom-label" for="threecheckboxview">
																							Three
																						</label>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<hr>
																	<p class="m-3" style="font-size: 17px;">
																		Select Information
																	</p>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Without New Select
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$withoutnewselect?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				New Select
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$newselect?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Sub Text Select
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$subtextselect?>
																		</div>
																	</div>
																	<div class="row m-3" style="align-items: center;">
																		<div class="col-sm-3 col-md-2 col-6">
																			<span style="font-size: 13px;">
																				Multiple Sub Text Select
																			</span>
																		</div>
																		<div class="col-md-8 col-6" style="font-size: 13px;">
																			<?=$multiplesubtextselect?>
																		</div>
																	</div>
																</div>
																<div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-other-tab">
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div style="box-shadow:0 2px 6px 0 rgba(0, 0, 0, 20%);" class="card card-body mt-5">
										<input type="hidden" class="form-control form-control-sm" id="idvalue" name="idvalue" value="<?=$idvalue?>">
										<p class="mb-3 mt-0 ml-0 headingall" data-toggle="tooltip" title="Edit Training" data-placement="right" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
											<i class="fa fa-pencil-square-o"></i> Edit Training
										</p>
										<!-- Just Training Modal -->
										<div class="modal fade" id="Selectmodaldemoedit" tabindex="-1" role="dialog" aria-labelledby="SelectmodaldemoLabeledit" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content" style="border-radius: 0px !important;">
													<div class="modal-header" style="border-radius:0px !important;">
														<h5 class="modal-title" id="SelectmodaldemoLabeledit" style="font-weight: normal !important;color: black !important;">
															Your Details
														</h5>
														<span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
															<span aria-hidden="true" style="font-weight: 600 !important;font-size: 21px !important;">
																&times; <!-- this is html entity for close symbol -->
															</span>
														</span>
													</div>
													<div class="modal-body">
														<p style="font-size:15px !important;">
															Details In Anyway Based On Our Customer Request
														</p>
													</div>
													<div class="modal-footer" style="margin-top: 33px !important;text-align: right !important;">
														<a data-bs-toggle="modal" data-bs-dismiss="modal" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 0px;margin-right:0px;padding-right: 5px;">
															<p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-times" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; 
																<span style="margin-left: -5px;width: max-content;">
																	Close
																</span>
															</p>
														</a>
													</div>
												</div>
											</div>
										</div>
										<!-- Just Training Modal -->
										<!-- accordion start -->
										<div class="accordion" id="accordionRental" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
											<div class="accordion-item mb-1">
												<h5 class="accordion-header" id="headingOneedit">
													<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneedit" aria-expanded="true" aria-controls="collapseOneedit">
														<div class="customcont-header ml-0 mb-1">
															<a class="customcont-heading">
																Inputs Information
															</a>
														</div>
													</button>
												</h5>
												<div id="collapseOneedit" class="accordion-collapse collapse show" aria-labelledby="headingOneedit">
													<div class="accordion-body text-sm">
														<!-- inside start -->
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="readonlyedit" class="custom-label">
																			Read Only
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="text" class="form-control form-control-sm" id="readonlyedit" name="readonlyedit" value="<?=$readonly?>" placeholder="Read Only" readonly>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="requirededit" class="custom-label">
																			<span class="text-danger">
																				Required *
																			</span>
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="text" class="form-control form-control-sm" id="requirededit" name="requirededit" placeholder="Required" required value="<?=$required?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="text" class="custom-label">
																			Custom Drop Down
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="text" class="form-control form-control-sm" id="customdropdownedit" name="customdropdownedit" placeholder="Enter Your Text" onClick="customdatasearchedit()" onFocus="customdatasearchedit()" list="" autocomplete="off" value="<?=$customdropdown?>">
																		<div>
																			<div id="outputdropdownedit" class="outputdropdown" style="display:none;width: 250px;">
																			</div>
																			<input type="text" id="searcherrormessageedit" style="display:none;">
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="textedit" class="custom-label">
																			Text
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="text" class="form-control form-control-sm" id="textedit" name="textedit" placeholder="Enter Your Text" value="<?=$typetext?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="numberedit" class="custom-label">
																			Number
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="number" class="form-control form-control-sm" id="numberedit" name="numberedit" placeholder="Enter Your Number" value="<?=$typenumber?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="emailedit" class="custom-label">
																			Email
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="email" class="form-control form-control-sm" id="emailedit" name="emailedit" placeholder="Enter Your Email" value="<?=$typeemail?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="dateedit" class="custom-label">
																			Date
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="date" class="form-control form-control-sm" id="dateedit" name="dateedit" value="<?=$typedate?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="datetime-localedit" class="custom-label">
																			Date Time
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="datetime-local" class="form-control form-control-sm" id="datetime-localedit" name="datetime-localedit" value="<?=$typedatetime?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="textareaedit" class="custom-label">
																			Text Area
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<textarea class="form-control" id="textareaedit" name="textareaedit" placeholder="Text Area"><?=$textarea?></textarea>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="fileedit" class="custom-label">
																			File
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<input type="file" class="form-control form-control-sm" id="fileedit" name="fileedit[]">
																		<input type="hidden" class="form-control form-control-sm" id="fileeditvalue" name="fileeditvalue" value="<?=$file?>">
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="filewithpreviewedit" class="custom-label">
																			File With Preview
																		</label>
																	</div>
																	<div class="col-sm-8">
																	<?php
																		if($filewithpreview!=''){
																	?>
																		<img alt="Image" src="<?=$filewithpreview?>" id="filewithpreviewedit-image1" style="height: 30px !important;width: 30px !important;">
																	<?php
																		}
																		else{
																	?>
																		<img alt="Image" src="https://via.placeholder.com/150/<?=$colsarry[0]?>/FFFFFF/?text=<?=substr($_SESSION["firstname"],0,1)?>" id="filewithpreviewedit-image1" style="height: 30px !important;width: 30px !important;">
																	<?php
																		}
																	?>
																		<input id="filewithpreviewedit-image-upload" type="file" style="display:none" class="form-control  form-control-sm" id="filewithpreviewimageedit" name="filewithpreviewimageedit[]" accept="image/*" onchange="previewfilewithpreviewedit()" >
																		<input type="hidden" name="filewithpreviewimagesedit" value="<?=$filewithpreview?>">
																		<span style="color:#4285F4; cursor:pointer"  id="filewithpreviewedit-image2">
																			Upload Image
																		</span>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="value" class="custom-label">
																			Radio
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<div class="row">
																			<div class="col-sm-4 my-1">
																				<div class="custom-control custom-radio mr-sm-2" style="z-index: 0;">
																					<input type="radio" class="custom-control-input" name="allvalueedit" id="valueedit" value="value" <?=(($radio=='value')?'checked':'')?>>
																					<label class="custom-control-label custom-label" for="valueedit">
																						Value
																					</label>
																				</div>
																			</div>
																			<div class="col-sm-4 my-1">
																				<div class="custom-control custom-radio mr-sm-2" style="z-index: 0;">
																					<input type="radio" class="custom-control-input" name="allvalueedit" id="valuesedit" value="values" <?=(($radio=='values')?'checked':'')?>>
																					<label class="custom-control-label custom-label" for="valuesedit">
																						Values
																					</label>
																				</div>
																			</div>
																			<div class="col-sm-4 my-1">
																				<div class="custom-control custom-radio mr-sm-2" style="z-index: 0;">
																					<input type="radio" class="custom-control-input" name="allvalueedit" id="disablededit" value="disabled" disabled <?=(($radio=='disabled')?'checked':'')?>>
																					<label class="custom-control-label custom-label" for="disablededit">
																						Disabled
																					</label>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="singlecheckboxedit" class="custom-label">
																			Single Check Box
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																			<input type="checkbox" class="custom-control-input" id="singlecheckboxedit" name="singlecheckboxedit" <?=(($singlecheckbox=='1')?'checked':'')?>>
																			<label class="custom-control-label custom-label" for="singlecheckboxedit">
																				One
																			</label>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="onecheckboxedit" class="custom-label">
																			Multi Check Box
																		</label>
																	</div>
																	<div class="col-sm-8">
																		<div class="row">
																			<div class="col-lg-4">
																				<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																					<input type="checkbox" class="custom-control-input" id="disabledcheckboxedit" name="multicheckboxedit[]" checked disabled value="disabledcheckbox">
																					<label class="custom-control-label custom-label" for="disabledcheckboxedit">
																						Disabled
																					</label>
																				</div>
																			</div>
																			<div class="col-lg-4">
																				<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																					<input type="checkbox" class="custom-control-input" id="twocheckboxedit" name="multicheckboxedit[]" <?=((in_array('twocheckbox', $multiplecheckboxans))?'checked':'')?> value="twocheckbox">
																					<label class="custom-control-label custom-label" for="twocheckboxedit">
																						Two
																					</label>
																				</div>
																			</div>
																			<div class="col-lg-4">
																				<div class="custom-control custom-checkbox mr-sm-2" style="z-index: 0;">
																					<input type="checkbox" class="custom-control-input" id="threecheckboxedit" name="multicheckboxedit[]" <?=((in_array('threecheckbox', $multiplecheckboxans))?'checked':'')?> value="threecheckbox">
																					<label class="custom-control-label custom-label" for="threecheckboxedit">
																						Three
																					</label>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<!-- inside end -->
													</div>
												</div>
											</div>
										</div>
										<!-- accordion end -->
										<!-- accordion start -->
										<div class="accordion" id="accordionRental" style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif !important;">
											<div class="accordion-item mb-1">
												<h5 class="accordion-header" id="headingSelectedit">
													<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSelectedit" aria-expanded="true" aria-controls="collapseSelectedit">
														<div class="customcont-header ml-0 mb-1">
															<a class="customcont-heading">Select Information</a>
														</div>
													</button>
												</h5>
												<div id="collapseSelectedit" class="accordion-collapse collapse show" aria-labelledby="headingSelectedit">
													<div class="accordion-body text-sm">
														<!-- inside start -->
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="withoutnewselectedit" class="custom-label">
																			Without New Select
																		</label>
																	</div>
																	<!-- use this for select input  onclick="andus()" -->
																	<!-- add select4 for without new option -->
																	<div class="col-sm-8" onclick="andus()">
																		<select class="select4 form-control form-control-sm" name="withoutnewselectedit" id="withoutnewselectedit">
																			<option selected disabled hidden>Without New Select</option>
																			<option value="One" <?=(($withoutnewselect=='One')?'selected':'')?>>
																				One
																			</option>
																			<option value="Two" <?=(($withoutnewselect=='Two')?'selected':'')?>>
																				Two
																			</option>
																			<option value="Three" <?=(($withoutnewselect=='Three')?'selected':'')?>>
																				Three
																			</option>
																			<option value="Four" <?=(($withoutnewselect=='Four')?'selected':'')?>>
																				Four
																			</option>
																			<option value="Five" <?=(($withoutnewselect=='Five')?'selected':'')?>>
																				Five
																			</option>
																			<option value="Six" <?=(($withoutnewselect=='Six')?'selected':'')?>>
																				Six
																			</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="newselectedit" class="custom-label">
																			New Select
																		</label>
																	</div>
																	<!-- use this for select input  onclick="andus()" -->
																	<div class="col-sm-8" onclick="andus()">
																		<select class="form-control form-control-sm" name="newselectedit" id="newselectedit">
																			<option selected disabled hidden>New Select</option>
																			<option value="One" <?=(($newselect=='One')?'selected':'')?>>
																				One
																			</option>
																			<option value="Two" <?=(($newselect=='Two')?'selected':'')?>>
																				Two
																			</option>
																			<option value="Three" <?=(($newselect=='Three')?'selected':'')?>>
																				Three
																			</option>
																			<option value="Four" <?=(($newselect=='Four')?'selected':'')?>>
																				Four
																			</option>
																			<option value="Five" <?=(($newselect=='Five')?'selected':'')?>>
																				Five
																			</option>
																			<option value="Six" <?=(($newselect=='Six')?'selected':'')?>>
																				Six
																			</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="subtextselectedit" class="custom-label">
																			Sub Text Select
																		</label>
																	</div>
																	<!-- add select4 for without new option -->
																	<div class="col-sm-8">
																		<select class="form-control form-control-sm subtextselectedit" name="subtextselectedit" id="subtextselectedit">
																			<option selected disabled hidden data-foo="Sub Text Select">Sub Text Select</option>
																			<option data-foo="One Sub Text" value="One" <?=(($subtextselect=='One')?'selected':'')?>>
																				One
																			</option>
																			<option data-foo="Two Sub Text" value="Two" <?=(($subtextselect=='Two')?'selected':'')?>>
																				Two
																			</option>
																			<option data-foo="Three Sub Text" value="Three" <?=(($subtextselect=='Three')?'selected':'')?>>
																				Three
																			</option>
																			<option data-foo="Four Sub Text" value="Four" <?=(($subtextselect=='Four')?'selected':'')?>>
																				Four
																			</option>
																			<option data-foo="Five Sub Text" value="Five" <?=(($subtextselect=='Five')?'selected':'')?>>
																				Five
																			</option>
																			<option data-foo="Six Sub Text" value="Six" <?=(($subtextselect=='Six')?'selected':'')?>>
																				Six
																			</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<div class="row justify-content-center">
															<div class="col-lg-6">
																<div class="form-group row">
																	<div class="col-sm-4">
																		<label for="mulsubtextselectedit" class="custom-label">
																			Multiple Sub Text Select
																		</label>
																	</div>
																	<!-- add select4 for without new option -->
																	<div class="col-sm-8">
																		<select class="form-control form-control-sm mulsubtextselectedit" name="mulsubtextselectedit" id="mulsubtextselectedit">
																			<option selected disabled hidden data-foo="Sub Text Select">Sub Text Select</option>
																			<option data-foo="One Sub Text" value="One" <?=(($multiplesubtextselect=='One')?'selected':'')?>>
																				One
																			</option>
																			<option data-foo="Two Sub Text" value="Two" <?=(($multiplesubtextselect=='Two')?'selected':'')?>>
																				Two
																			</option>
																			<option data-foo="Three Sub Text" value="Three" <?=(($multiplesubtextselect=='Three')?'selected':'')?>>
																				Three
																			</option>
																			<option data-foo="Four Sub Text" value="Four" <?=(($multiplesubtextselect=='Four')?'selected':'')?>>
																				Four
																			</option>
																			<option data-foo="Five Sub Text" value="Five" <?=(($multiplesubtextselect=='Five')?'selected':'')?>>
																				Five
																			</option>
																			<option data-foo="Six Sub Text" value="Six" <?=(($multiplesubtextselect=='Six')?'selected':'')?>>
																				Six
																			</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														<!-- inside end -->
													</div>
												</div>
											</div>
										</div>
										<!-- accordion end -->
									</div>
								</form>
								<!-- form end -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
<?php
	include('fexternals.php');
?>
<script type="text/javascript">
// for common selects
function andun() {
	$(".select2-container--open .select2-dropdown--above").hide();
	$(".select2-container--open .select2-dropdown--below").hide();
}
function andus() {
	$(".select2-container--open .select2-dropdown--above").show();
	$(".select2-container--open .select2-dropdown--below").show();
}
// for common selects

// for new select
// #newselect is id
$("#newselect").on("select2:open", function() { 
	$("#configureunits").attr("data-bs-target","#Selectmodaldemo");
});
// #newselect is id
$("#newselect").on("select2:open", function() { 
	document.getElementById("configureunits").innerHTML = "New Select";
});
$(function(){
	// #newselect is id
	$("#newselect").select2({
		matcher: matchCustom
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
// for new select

// for subtext select
// #subtextselect is id
// if you want add new for subtext then you add this code ---
// $("#subtextselect").on("select2:open", function() { 
//   $("#configureunits").attr("data-bs-target","#AddNewSelect");
// });
// // #subtextselect is id
// $("#subtextselect").on("select2:open", function() { 
//   document.getElementById("configureunits").innerHTML = "New Select";
// });
// other wise use this only ---

$("#subtextselect").on("select2:open", function() {
	$("#configureunits").hide();
});
$(function(){
	// .subtextselect is class
	$(".subtextselect").select2({
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
	return $('<div><div>' + state.text + '</div><div class="foo">'+ $(state.element).attr('data-foo')+ '</div></div>');
}
// for subtext select
$("#mulsubtextselect").on("select2:open", function() {
	$("#configureunits").hide();
});
$(function(){
	// .mulsubtextselect is class
	$(".mulsubtextselect").select2({
		matcher: matchCustomMul,
		templateResult: formatCustomMul
	});
})
function stringMatchMul(term, candidate) {
	return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustomMul(params, data) {
	// If there are no search terms, return all of the data
	if ($.trim(params.term) === '') {
		return data;
	}
	// Do not display the item if there is no 'text' property
	if (typeof data.text === 'undefined') {
		return null;
	}
	// Match text of option
	if (stringMatchMul(params.term, data.text)) {
		return data;
	}
	// Match attribute "data-foo" of option
	if (stringMatchMul(params.term, $(data.element).attr('data-foo'))) {
		return data;
	}
	// Return `null` if the term should not be displayed
	return null;
}
function formatCustomMul(state) {
	return $('<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Data Foo: '+ $(state.element).attr('data-foo') + '</td><td align="right">Data Foo: <span style="color:green">'+ $(state.element).attr('data-foo') + '</span></td></tr></table></div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Data Foo: <span style="color:green">'+ $(state.element).attr('data-foo') + '</span></td><td align="right">Data Foo: '+ $(state.element).attr('data-foo') + '</td></tr></table></div></div>');
}
// for multiple sub text select
function previewfilewithpreview() {
	var preview = document.getElementById('filewithpreview-image1');
	var file    = document.getElementById('filewithpreview-image-upload').files[0];
	var reader  = new FileReader();
	reader.addEventListener("load", function () {
		preview.src = reader.result;
	}, false);
	if (file) {
		reader.readAsDataURL(file);
	}
}
$(function() {
	$('#filewithpreview-image1').on('click', function() {
		$('#filewithpreview-image-upload').click();
	});
	$('#filewithpreview-image2').on('click', function() {
		$('#filewithpreview-image-upload').click();
	});
});
//File with preview

// for new select edit
// #newselectedit is id
$("#newselectedit").on("select2:open", function() { 
	$("#configureunits").attr("data-bs-target","#Selectmodaldemoedit");
});
// #newselectedit is id
$("#newselectedit").on("select2:open", function() { 
	document.getElementById("configureunits").innerHTML = "New Select";
});
$(function(){
	// #newselectedit is id
	$("#newselectedit").select2({
		matcher: matchCustom
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
// for new select

// for subtext select
  // #subtextselectedit is id
// if you want add new for subtext then you add this code ---
// $("#subtextselectedit").on("select2:open", function() { 
//   $("#configureunits").attr("data-bs-target","#AddNewSelect");
// });
// // #subtextselectedit is id
// $("#subtextselectedit").on("select2:open", function() { 
//   document.getElementById("configureunits").innerHTML = "New Select";
// });
// other wise use this only ---

$("#subtextselectedit").on("select2:open", function() {
	$("#configureunits").hide();
});
$(function(){
	// .subtextselectedit is class
	$(".subtextselectedit").select2({
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
	return $('<div><div>' + state.text + '</div><div class="foo">'+ $(state.element).attr('data-foo')+ '</div></div>');
}
// for subtext select
$("#mulsubtextselectedit").on("select2:open", function() {
	$("#configureunits").hide();
});
$(function(){
	// .mulsubtextselectedit is class
	$(".mulsubtextselectedit").select2({
		matcher: matchCustomMul,
		templateResult: formatCustomMul
	});
})
function stringMatchMul(term, candidate) {
	return candidate && candidate.toLowerCase().indexOf(term.toLowerCase()) >= 0;
}
function matchCustomMul(params, data) {
	// If there are no search terms, return all of the data
	if ($.trim(params.term) === '') {
		return data;
	}
	// Do not display the item if there is no 'text' property
	if (typeof data.text === 'undefined') {
		return null;
	}
	// Match text of option
	if (stringMatchMul(params.term, data.text)) {
		return data;
	}
	// Match attribute "data-foo" of option
	if (stringMatchMul(params.term, $(data.element).attr('data-foo'))) {
		return data;
	}
	// Return `null` if the term should not be displayed
	return null;
}
function formatCustomMul(state) {
	return $('<div><div style="margin-top:-6px !important;">' + state.text + '</div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Data Foo: '+ $(state.element).attr('data-foo') + '</td><td align="right">Data Foo: <span style="color:green">'+ $(state.element).attr('data-foo') + '</span></td></tr></table></div><div class="foo"><table width="100%" style="font-size:11px; margin-top:5px;"><tr style="border:none !important;"><td style="border:none !important;">Data Foo: <span style="color:green">'+ $(state.element).attr('data-foo') + '</span></td><td align="right">Data Foo: '+ $(state.element).attr('data-foo') + '</td></tr></table></div></div>');
}
// for multiple sub text select
function previewfilewithpreviewedit() {
	var preview = document.getElementById('filewithpreviewedit-image1');
	var file    = document.getElementById('filewithpreviewedit-image-upload').files[0];
	var reader  = new FileReader();
	reader.addEventListener("load", function () {
		preview.src = reader.result;
	}, false);
	if (file) {
		reader.readAsDataURL(file);
	}
}
$(function() {
	$('#filewithpreviewedit-image1').on('click', function() {
		$('#filewithpreviewedit-image-upload').click();
	});
	$('#filewithpreviewedit-image2').on('click', function() {
		$('#filewithpreviewedit-image-upload').click();
	});
});
//File with preview

function checkscrolltouch() {
	var width = $('#nav-tab').outerWidth()
	var scrollWidth = $('#nav-tab')[0].scrollWidth; 
	var scrollLeft = $('#nav-tab').scrollLeft();
	if (scrollLeft===0){
		document.getElementById('leftarrow').style.visibility = 'hidden';
		document.getElementById('rightarrow').style.visibility = 'visible';
	}
	else if (scrollLeft!=0){
		if (scrollWidth - width === scrollLeft) {
			document.getElementById('rightarrow').style.visibility = 'hidden';
			document.getElementById('leftarrow').style.visibility = 'visible'; 
		}
		else{
			document.getElementById('leftarrow').style.visibility = 'visible';
			document.getElementById('rightarrow').style.visibility = 'visible';
		}
	}
}
function leftarrow() {
	document.getElementById('nav-tab').scrollLeft += -90;
	var width = $('#nav-tab').outerWidth()
	var scrollWidth = $('#nav-tab')[0].scrollWidth; 
	var scrollLeft = $('#nav-tab').scrollLeft();
	if (scrollLeft===0){
		document.getElementById('leftarrow').style.visibility = 'hidden';
		document.getElementById('rightarrow').style.visibility = 'visible';
	}
	else{
		document.getElementById('rightarrow').style.visibility = 'visible';
	}
}
function rightarrow() {
	document.getElementById('nav-tab').scrollLeft += 90;
	var width = $('#nav-tab').outerWidth()
	var scrollWidth = $('#nav-tab')[0].scrollWidth; 
	var scrollLeft = $('#nav-tab').scrollLeft();
	// alert('width'+width+'scroll'+scrollWidth+'left'+scrollLeft);
	if (scrollWidth - width === scrollLeft){
		document.getElementById('rightarrow').style.visibility = 'hidden';
	}
	document.getElementById('leftarrow').style.visibility = 'visible';
}
$(document).ready(function() {
	function isOverflown(element) {
		return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
	}
	var el = document.getElementById("nav-tab");
	isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
	window.onresize = function (event) {
		applyOrientation();
	}         
	function applyOrientation() {
		function isOverflown(element) {
			return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
		}
		var el = document.getElementById("nav-tab");
		isOverflown(el) ? $("#rightarrow").css("visibility","visible") : $("#rightarrow").css("visibility","hidden");
	}
});
//For Auto Scroll

// FOR GET ADD CUSTOM DATA INFORMATIONS
	function customdatasearch(){
		var input = document.getElementById("customdropdown");
		var browsers = document.getElementById("outputdropdown");
		browsers.style.display = 'block';
		input.onclick = function () {
			browsers.style.display = 'block';
			$("#outputdropdown").scrollTop( 1 );
			$("#outputdropdown").on('scroll', function() {
				var scrollTop = $(this).scrollTop();
  				if (scrollTop + $(this).innerHeight()>= this.scrollHeight) {
					$("#outputdropdown").scrollTop( 201.3 );
  				}
  				else if (scrollTop <= 0) {
					$("#outputdropdown").scrollTop( 1 );
  				}
			});
			$("body").on("click",function() {
				if($("#customdropdown").is(":focus")){
					browsers.style.display = 'block';
					$("#outputdropdown").scrollTop( 1 );
					$("#outputdropdown").on('scroll', function() {
						var scrollTop = $(this).scrollTop();
  						if (scrollTop + $(this).innerHeight()>= this.scrollHeight) {
							$("#outputdropdown").scrollTop( 201.3 );
  						}
  						else if (scrollTop <= 0) {
							$("#outputdropdown").scrollTop( 1 );
  						}
					});
				}
				else{
					browsers.style.display = 'none';
				}
			});
		}
		$.get("trainingcustomdropdownsearch.php", {term: 'customsearchdiffer'} , function(datas){
			const objcustomdropdown = JSON.parse(datas);
			option='';
			customdropdown='';
			var chnew = 0;
			let check='';
			for (var key in objcustomdropdown) {
				chnew++;
				option+='option'+chnew+'d'+';';
				customdropdown+='customdropdown'+objcustomdropdown[key].customdropdown+';';
				check+="<div id='option"+chnew+'d'+"' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' id='customdropdown"+objcustomdropdown[key].customdropdown+"' style='border:none;overflow:hidden;white-space:nowrap;text-align:left;padding:6px;' title='"+objcustomdropdown[key].customdropdown+"'>Custom Drop Down : "+objcustomdropdown[key].customdropdown+" </td></tr></table></div>";
			}
			$("#outputdropdown").html(check);
			optionspl = option.split(';');
			customdropdownspl = customdropdown.split(';');
			for (var i = 0; i <= optionspl.length; i++) {
				var optionans = document.getElementById(optionspl[i]);
				$("#"+optionspl[i]).on("click",function() {
					const child = this.children;
					const childone = child[0].children;
					const childtwo = childone[0].children;
					var customdropdownqty = childtwo[0].innerHTML;
					var batqtyspl = customdropdownqty.split(" ");
					$('#customdropdown').val(batqtyspl[8]);
					$("#text").focus();
				});
			}
		});
		$('#customdropdown').on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#outputdropdown"+" "+"table").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value)> -1);
				if ($(this).text().toLowerCase().indexOf(value)> -1) {
					$(this).parent().css({"display": "block"});
					var browsers = document.getElementById("outputdropdown");
					browsers.style.display = 'block';
				}
				else{
					$(this).parent().css({"display": "none"});
					var browsers = document.getElementById("outputdropdown");
					browsers.style.display = 'none';
				}
			});
		});
	}
// FOR GET ADD CUSTOM DATA INFORMATIONS

// FOR GET EDIT CUSTOM DATA INFORMATIONS
	function customdatasearchedit(){
		var input = document.getElementById("customdropdownedit");
		var browsers = document.getElementById("outputdropdownedit");
		browsers.style.display = 'block';
		input.onclick = function () {
			browsers.style.display = 'block';
			$("#outputdropdownedit").scrollTop( 1 );
			$("#outputdropdownedit").on('scroll', function() {
				var scrollTop = $(this).scrollTop();
  				if (scrollTop + $(this).innerHeight()>= this.scrollHeight) {
					$("#outputdropdownedit").scrollTop( 201.3 );
  				}
  				else if (scrollTop <= 0) {
					$("#outputdropdownedit").scrollTop( 1 );
  				}
			});
			$("body").on("click",function() {
				if($("#customdropdownedit").is(":focus")){
					browsers.style.display = 'block';
					$("#outputdropdownedit").scrollTop( 1 );
					$("#outputdropdownedit").on('scroll', function() {
						var scrollTop = $(this).scrollTop();
  						if (scrollTop + $(this).innerHeight()>= this.scrollHeight) {
							$("#outputdropdownedit").scrollTop( 201.3 );
  						}
  						else if (scrollTop <= 0) {
							$("#outputdropdownedit").scrollTop( 1 );
  						}
					});
				}
				else{
					browsers.style.display = 'none';
				}
			});
		}
		$.get("trainingcustomdropdownsearch.php", {term: 'customsearchdiffer'} , function(datas){
			const objcustomdropdownedit = JSON.parse(datas);
			option='';
			customdropdownedit='';
			var chnew = 0;
			let check='';
			for (var key in objcustomdropdownedit) {
				chnew++;
				option+='option'+chnew+'d'+';';
				customdropdownedit+='customdropdownedit'+objcustomdropdownedit[key].customdropdown+';';
				check+="<div id='option"+chnew+'d'+"' style='border:1px solid #cccccc;border-top: none !important;'><table width='100%' style='table-layout:fixed;'><tr style='border-bottom:none;margin-bottom:0px;'><td align='left' id='customdropdownedit"+objcustomdropdownedit[key].customdropdown+"' style='border:none;overflow:hidden;white-space:nowrap;text-align:left;padding:6px;' title='"+objcustomdropdownedit[key].customdropdown+"'>Custom Drop Down : "+objcustomdropdownedit[key].customdropdown+" </td></tr></table></div>";
			}
			$("#outputdropdownedit").html(check);
			optionspl = option.split(';');
			customdropdowneditspl = customdropdownedit.split(';');
			for (var i = 0; i <= optionspl.length; i++) {
				var optionans = document.getElementById(optionspl[i]);
				$("#"+optionspl[i]).on("click",function() {
					const child = this.children;
					const childone = child[0].children;
					const childtwo = childone[0].children;
					var customdropdowneditqty = childtwo[0].innerHTML;
					var batqtyspledit = customdropdowneditqty.split(" ");
					$('#customdropdownedit').val(batqtyspledit[8]);
					$("#textedit").focus();
				});
			}
		});
		$('#customdropdownedit').on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#outputdropdownedit"+" "+"table").filter(function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value)> -1);
				if ($(this).text().toLowerCase().indexOf(value)> -1) {
					$(this).parent().css({"display": "block"});
					var browsers = document.getElementById("outputdropdownedit");
					browsers.style.display = 'block';
				}
				else{
					$(this).parent().css({"display": "none"});
					var browsers = document.getElementById("outputdropdownedit");
					browsers.style.display = 'none';
				}
			});
		});
	}
// FOR GET EDIT CUSTOM DATA INFORMATIONS
</script>
</body>
</html>