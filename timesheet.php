<?php
include('lcheck.php');
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if(($franchisesrole=='')||(($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']==0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']==0))){
header('location:dashboard.php');
}
$sqlismodules=mysqli_query($con, "select * from pairmainaccess where userid='$companymainid' and moduletype='Timesheet' order by id  asc");
while($infomodules=mysqli_fetch_array($sqlismodules)){
    $coltypemodule = preg_replace('/\s+/', '', $infomodules['moduletype']);
    $ansmodules = $infomodules[24];
    $modulecolumns = explode(',',$ansmodules);
}
// This is for Restriction of Pages
$sql = "select * from paircontrols where id='$companymainid'";  
$result = mysqli_query($con, $sql);
$rowes = mysqli_fetch_array($result);
$sql = "select * from paircontrols where username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."'";  
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_array($result);
if(isset($_POST['submit']))
{
	date_default_timezone_set('Asia/Calcutta');
	$createdon=date('Y-m-d H:i:s');
	$timesheetdate=date('Y-m-d');
	$projectid=mysqli_real_escape_string($con, $_POST['projectname']);
	$taskname=mysqli_real_escape_string($con, $_POST['taskname']);
	$taskdescription=mysqli_real_escape_string($con, $_POST['taskdescription']);	
	$billable=mysqli_real_escape_string($con, ((isset($_POST['billable']))?$_POST['billable']:'0'));
	$timestart=date('Y-m-d H:i:s');
	$sqlipro=mysqli_query($con, "select * from pairprojects where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and id='".$projectid."'");
	if(mysqli_num_rows($sqlipro)>0)
	{
		$infopro=mysqli_fetch_array($sqlipro);
		$projectid=$infopro['id'];
		$projectname=$infopro['projectname'];
		$customerid=$infopro['customerid'];
		$customername=$infopro['customername'];
		$userid=$currentuserid;
		$useremail=$currentuseremail;
		$username=$currentusername;
		$sqlitime=mysqli_query($con, "select id from pairtimesheet where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and userid='$userid' and status='Running'");
		if(mysqli_num_rows($sqlitime)==0)
		{
			$sqlicon=mysqli_query($con, "insert into pairtimesheet set createdon='$times', createdid='$companymainid', createdby='".$_SESSION["unqwerty"]."', franchisesession='".$_SESSION["franchisesession"]."', timesheetdate='$timesheetdate', projectid='$projectid', projectname='$projectname', customerid='$customerid', customername='$customername', userid='$userid', useremail='$useremail', username='$username', taskname='$taskname', taskdescription='$taskdescription', billable='$billable', timestart='$timestart', status='Running'");
			if($sqlicon)
			{
				header("Location: timesheet.php?remarks=Your task has been started");
			}
		}
		else
		{
			header("Location: timesheet.php?error=You are already Started a Task, Kindly Close it");
		}
		
		
	}
	else
	{
		header("Location: timesheet.php?error=No Project Found");
	}
}
if(isset($_GET['event']))
{
	$event=mysqli_real_escape_string($con, $_GET['event']);
	if($event=='Stop')
	{
		date_default_timezone_set('Asia/Calcutta');
		$createdon=date('Y-m-d H:i:s');
		$timesheetdate=date('Y-m-d');
		$tid=mysqli_real_escape_string($con, $_GET['tid']);
		$sqlitime=mysqli_query($con, "select timestart, id from pairtimesheet where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and userid='$currentuserid' and status='Running'");
		if(mysqli_num_rows($sqlitime)>0)
		{
			$infoitime=mysqli_fetch_array($sqlitime);
			
			$dateTimeObject1 = date_create($infoitime['timestart']); 
			$dateTimeObject2 = date_create($createdon); 
			// Calculating the difference between DateTime Objects
			$interval = date_diff($dateTimeObject1, $dateTimeObject2); 
			$min = $interval->days * 24 * 60;
			$min += $interval->h * 60;
			$min += $interval->i;
			
			$totalduration=$min;
			
			$sqlitime2=mysqli_query($con, "update pairtimesheet set status='Ended', timeend='$createdon', totalduration='$totalduration' where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and userid='$currentuserid' and id='".$infoitime['id']."'");
			if($sqlitime2)
			{
				header("Location: timesheet.php?remarks=Your Task Ended Successfully");
			}
			else
			{
				header("Location: timesheet.php?error=".mysqli_errno($conn));
			}
		}
	}
}
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Timesheet' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='0'))||((($infomainaccessuser['createdid']!='0'))&&(($infomainaccessuser['moduleaccess']=='0')||($infomainaccessuser['useraccessview']==0)))) {
header('Location:dashboard.php');
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
    <?= $infomainaccessuser['modulename'] ?>
  </title>
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
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Timesheet' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
     ?>
	 <div style="max-width: 1650px;">
                <div class="row min-height-480">
                    <div class="col-12">
                        <div class="card mb-4 mt-5">
                            <div class="card-body p-3" style="color:black;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">
                                <p class="mb-3" style="color:black;font-size: 20px;margin-top: -8px;"> <?= $infomainaccessuser['modulename'] ?></p>
								<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where franchiseid='".$_SESSION['franchisesession']."' and moduletype='Timesheet' order by id  asc");
$infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser);
if($infomainaccessuser['moduleno']!='1')
{
	?>
	<div class="alert alert-danger mt-2 text-white">Sorry! <?= $infomainaccessuser['modulename'] ?> Generation is Allowed for this Franchise</div>
	<?php
}
else
{
		$sqlitime=mysqli_query($con, "select id, timestart from pairtimesheet where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' and userid='$currentuserid' and status='Running'");
		if(mysqli_num_rows($sqlitime)>0)
		{
			$infoitime=mysqli_fetch_array($sqlitime);
		?>
		
		<div class="p-2" align="right" style="margin-top: -60px;">
			<a href="timesheet.php?tid=<?=$infoitime['id']?>&event=Stop" onClick="return confirm('Are you sure want to Stop this Task?')" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px; background-color:#1db79f; color: #ffffff; border: 1px solid #1db79f !important;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-clock" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;" id="countdowntimer"> Start</span></p></a>
			  <br>
											
                                        </div>

<script>
var timer;
var compareDate = new Date("<?=$infoitime['timestart']?>");
timer = setInterval(function(){
  timeBetweenDates(compareDate);
}, 1000);
function pad(num, size) {
    num = num.toString();
    while (num.length < size) num = "0" + num;
    return num;
}
function timeBetweenDates(toDate) 
{
  var dateEntered = toDate;
  var now = new Date();
  var difference = now.getTime() - dateEntered.getTime();

  if (difference <= 0) 
  {
    clearInterval(timer);
  } 
  else 
  {
    
    var seconds = Math.floor(difference / 1000);
    var minutes = Math.floor(seconds / 60);
    var hours = Math.floor(minutes / 60);
    minutes %= 60;
    seconds %= 60;

    $("#countdowntimer").html(""+pad(hours, 2)+":"+pad(minutes, 2)+":"+pad(seconds, 2)+"");
  }
}
</script>
				<!--a  onClick="deleteitem('','','','1')" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;">
			<i class="fa fa-clock" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Start</span></p></a--->
			<?php 
		}
		else
		{
$sqlismainaccessuserr=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and moduletype='Timesheet' order by id  asc");
$infomainaccessuserr=mysqli_fetch_array($sqlismainaccessuserr);
if (($infomainaccessuserr['useraccesscreate']==1&&$infomainaccessuserr['createdid']!=0)||($infomainaccessuserr['createdid']==0)) {
	?>
			<div class="p-2" align="right" style="margin-top: -60px;">
			<a  onClick="deleteitem('','','','1')" class="btn btn-sm btn-custom add" style="font-size: 13px;height: 24px;margin-bottom:1rem;margin-top: 9px;margin-right:-9px;padding-right: 5px;"><p style="width: max-content;margin-top:-5px;margin-left: -6px;padding: 0px;"><i class="fa fa-clock" style="font-size:13px;padding: 0px;width: max-content;"></i> &nbsp; <span style="margin-left: -5px;width: max-content;"> Start</span></p></a>
			  <br>
											
                                        </div>
			<?php 
		}
		}
		?>
								 					
                                          
								
							
                            <div class="table-responsive p-0 min-height-480">
                                <table id="someTable" class="table table-bordered align-items-center mb-0">
                                    <thead>
                                        <tr>
<?php
if ((in_array('Date', $modulecolumns))) {
?>
<td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Date</span></td>
<?php
}
?>
<?php
if ((in_array('Project', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Project</span></td>
<?php
}
?>
<?php
if ((in_array('Customer', $modulecolumns))) {
?>
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Customer</span></td>
<?php
}
?>
<?php
if ((in_array('Task', $modulecolumns))) {
?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Task</span></td> 
<?php
}
?>
<?php
if ((in_array('User', $modulecolumns))) {
?>      
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">User</span></td>
<?php
}
?>
<?php
if ((in_array('Start Time', $modulecolumns))) {
?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Start Time</span></td>
<?php
}
?>
<?php
if ((in_array('End Time', $modulecolumns))) {
?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">End Time</span></td>
<?php
}
?>
<?php
if ((in_array('Duration', $modulecolumns))) {
?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Duration</span></td>
<?php
}
?>
<?php
if ((in_array('Billing Status', $modulecolumns))) {
?>
					  <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Billing Status</span></td> 
<?php
}
?>
<?php
if ((in_array('Status', $modulecolumns))) {
?>      
                      <td class="text-uppercase" style="width:50px;"><span style="font-size:13px;color:black;">Status</span></td>
<?php
}
?>
												
                                        </tr>
                                    </thead>
                                   <tbody>
				  <?php
				  $totalcancel=array();
				  $totalprojectno=array();
				  $totalprojectdate=array();
				  $sql=mysqli_query($con, "select * from pairtimesheet where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' order by timesheetdate desc");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
       				$minutes=(float)$info['totalduration'];
					  ?>
					  <tr>
<?php
if ((in_array('Date', $modulecolumns))) {
?>
                      <td data-label="Date"><?=(($info['timesheetdate']!='')?(date('d/m/Y',strtotime($info['timesheetdate']))):'')?></td>
<?php
}
?>
<?php
if ((in_array('Project', $modulecolumns))) {
?>
                      <td data-label="Project" class="text-blue"><?=$info['projectname']?></td>
<?php
}
?>
<?php
if ((in_array('Customer', $modulecolumns))) {
?>
                      <td data-label="Customer"><?=$info['customername']?></td>
<?php
}
?>
<?php
if ((in_array('Task', $modulecolumns))) {
?>
                      <td data-label="Task"><?=$info['taskname']?><br><?=$info['taskdescription']?></td> 
<?php
}
?>
<?php
if ((in_array('User', $modulecolumns))) {
?>      
                      <td data-label="User" class="text-blue"><?=$info['username']?></td>
<?php
}
?>
<?php
if ((in_array('Start Time', $modulecolumns))) {
?>
					  <td data-label="Start Time"><?=($info['timestart']!='')?date('h:i:s a', strtotime($info['timestart'])):''?></td>
<?php
}
?>
<?php
if ((in_array('End Time', $modulecolumns))) {
?>
					  <td data-label="End Time"><?=($info['timeend']!='')?date('h:i:s a', strtotime($info['timeend'])):''?></td>
<?php
}
?>
<?php
if ((in_array('Duration', $modulecolumns))) {
$timestart = strtotime($info['timestart']);
$timeend = isset($info['timeend']) ? strtotime($info['timeend']) : time();
$time_difference = $timeend - $timestart;
?>
					  <td data-label="Duration"><?=gmdate('H:i:s', $time_difference)?></td>
<?php
}
?>
<?php
if ((in_array('Billing Status', $modulecolumns))) {
?>
					  <td data-label="Bill Status"><?=($info['billable']=='0')?'<span class="text-danger">NOT BILLABLE</span>':'<span class="text-success">BILLABLE</span>'?></td>
<?php
}
?>
<?php
if ((in_array('Status', $modulecolumns))) {
?>      
					  <td  data-label="Status"><?=($info['status']=="Running")?'<i class="fas fa-circle-notch fa-2x fa-spin"></i>':'Ended'?></td>
<?php
}
?>
					  
					  
					</tr>

					<?php
				  $count++;
				  }
				  ?>
					  
                  </tbody>
                                </table>


                            </div>


<?php 
}
?>









                        </div>
                    </div>
                </div>

            </div>
        </div>
	 
	 
	 
	 
	 
	 
	 
	 
<div class="modal fade" id="deleteconfirm-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
		<form action="" method="post">
		<input type="hidden" name="cancelstatus" id="cancelstatus">
            <div class="modal-header text-center" style="display: block;">
			    
				<i class="fa fa-clock"></i><br>
				START TIMER<br>
					00h : 00m : 00s
					
				
            </div>
            <div class="modal-body">
                <h6 class="text-blue text-center">Task Details</h6>
				<table class="table">
				<tr>
				<th><span class="text-danger">Project Name *</span></th><td>
				<input type="hidden" name="projectid" id="projectid" value="">
				<select name="projectname" id="projectname" class="form-control form-control-sm projectname" required>
				<option value="">Select</option>
				<?php
				$sql=mysqli_query($con, "select projectname, id from pairprojects where franchisesession='".$_SESSION['franchisesession']."' and createdid='$companymainid' GROUP BY projectdate, projectno order by projectdate asc, projectno asc");
	 			  
				  $count=1;
				  while($info=mysqli_fetch_array($sql))
				  {
					?>
					<option value="<?=$info['id']?>"><?=$info['projectname']?></option>
					<?php					
				  }
				?>
				</select>
				</td>
				</tr>
				<tr>
				<th><span class="text-danger">Task Name *</span></th><td>
					<select name="taskname" id="taskname" class="form-control form-control-sm taskname" required>
				<option value="">Select</option>
				
				</select></td>
				</tr>
				<tr>
				<th colspan="2"><label><input type="checkbox" name="billable" id="billable" value="1" checked> Billable</label></td>
				</tr>
				<tr>
				<th>Notes</th><td><textarea name="taskdescription" id="taskdescription" class
				="form-control form-control-sm" style="height:100px;"></textarea></td>
				</tr>
				</table>
			</div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" style="padding: 0.5rem 1rem; border-radius:0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            <button type="submit" id="deleteitem" name="submit" style="padding: 0.5rem 1rem; border-radius:0px;" class="btn btn-success success" >Start Timer</button>
        </div>
		</form>
    </div>
</div>
</div> 


<div class="modal fade" id="deleteconfirm1-adddelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to Generate this Project as Estimate?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" style="padding: 0.5rem 1rem; border-radius:0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem1" href="" class="btn btn-success success" style="padding: 0.5rem 1rem; border-radius:0px;" >Yes</a>
        </div>
    </div>
</div>
</div> 


<div class="modal fade" id="deleteconfirm2-adddelete" tabindex="-2" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm Submit
            </div>
            <div class="modal-body">
                Are you sure you want to Generate this Project as Proforma Invoice?
            </div>

  <div class="modal-footer">
            <button type="button" class="btn btn-default" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button>
            <a id="deleteitem2" href="" class="btn btn-success success" >Yes</a>
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
 function deleteitem(projectno,projectdate,projectamount,cancelstatus)
{
	$('#projectno').val(projectno);
	$('#projectdate').val(projectdate);
	$('#projectamount').val(projectamount);
	$('#cancelstatus').val(cancelstatus);
	$('#deleteconfirm-adddelete').modal('show');
	$("#deleteconfirm-adddelete #deleteitem").attr("href","projectcancel.php?projectno="+projectno+"&projectdate="+projectdate+"&cancelstatus="+cancelstatus);
}
 function deleteitem1(projectno,projectdate,cancelstatus)
{
	$('#deleteconfirm1-adddelete').modal('show');
	$("#deleteconfirm1-adddelete #deleteitem1").attr("href","estimatecancel.php?projectno="+projectno+"&projectdate="+projectdate+"&estimatestatus="+cancelstatus);
}
 function deleteitem2(projectno,projectdate,cancelstatus)
{
	$('#deleteconfirm2-adddelete').modal('show');
	$("#deleteconfirm2-adddelete #deleteitem2").attr("href","proformacancel1.php?projectno="+projectno+"&projectdate="+projectdate+"&proformastatus="+cancelstatus);
}
 </script>
<script>
$(document).ready(function(){
    $("select.projectname").change(function(){
        var selectedproject = $(".projectname option:selected").val();
        $.ajax({
            type: "POST",
            url: "timesheet-get.php",
            data: { project : selectedproject } 
        }).done(function(data){
            $("#taskname").html(data);
        });
    });
});
</script>
</body>

</html>