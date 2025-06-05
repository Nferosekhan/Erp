<?php
$sql="select * from paircontrols where username='".$_SESSION["unqwerty"]."'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$sqlss="select * from paircontrols where id='$companymainid'";
$resultss=mysqli_query($con,$sqlss);
$rowww=mysqli_fetch_assoc($resultss);
?>
     <header class="app-header fixed-top" style="height:48px !important;z-index: 3 !important;">
        <div class="app-header-inner">  
            <div class="py-2 px-3">
                <style type="text/css">
                    @media screen and (max-width: 1199px){
                        .app-header-content{
                            margin-left: 0px !important;
                        }
                        #bar{
                            margin-left: -7px !important;
                        }
                    }
                </style>
                <script type="text/javascript">
                    function bars() {
                        var element = document.querySelector('body');
                        var ilu = document.getElementById('ilu');
                        var bar = document.getElementById('bar');
                        var eye = document.getElementById('eye');
                        var isn = document.getElementById('iconSidenav');
                        if (element.classList.contains('g-sidenav-pinned', 'g-sidenav-hidden')) {
                           element.classList.remove('g-sidenav-pinned', 'g-sidenav-hidden');
                           ilu.style.marginLeft='-45px';
                           bar.style.display = 'block';
                           eye.style.display = 'none';
                        } else {
                            if (xyz.matches) { 
                             element.classList.remove('g-sidenav-hidden');
                             element.classList.add('g-sidenav-pinned');
                             isn.style.display = 'block';
                           }
                           else {
                             element.classList.add('g-sidenav-pinned', 'g-sidenav-hidden');
                             ilu.style.marginLeft='-150px';
                             bar.style.display = 'none';
                             eye.style.display = 'block';
                             }
                        }
}
var xyz = window.matchMedia("(max-width: 1199px)");
myFunction(xyz);
xyz.addListener(myFunction);
                </script>
                <div class="app-header-content" style="margin-left: -45px;" id="ilu"> 
                    <div class="row">
                    <div class="col-auto pt-1" style="width:34px !important;margin-top: 1px !important;" onclick="bars()">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="30" viewBox="0 0 30 30" role="img" id="bar" style="cursor: pointer;margin-top: -5px;margin-left: -13px;">
    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
</svg>
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="square" stroke-linejoin="bevel" id="eye" style="display: none;cursor: pointer;;margin-top: -2px;margin-left: -13px;transform: rotate(-90deg);"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    </div>
                    <div class="col" style="width:34px !important;margin-top: 1px !important;margin-left: -9px !important;">
                         <?php
                if($franchisesrole!='')
                {
            ?>  
             <form action="changefranchise.php" method="post" class="fform">
             <input type="hidden" name="url" value="<?=$CurPageURL?>">
              <select class="franchise-session" id="franchisesession" name="franchisesession" onchange="this.form.submit()" style="max-width:150px;">
                <?php
                  $count=1;
                  $sqlifr=mysqli_query($con, "select id, displayname, pos from pairfranchises where id in (".$franchisesrole.") and astatus='0' order by id desc");
                  while($infofr=mysqli_fetch_array($sqlifr))
                  {
                    ?>
                    <option value="<?=$infofr['id']?>" <?=($_SESSION['franchisesession']==$infofr['id'])?'selected':''?>><?=$infofr['displayname']?></option>
                    <?php
					if($_SESSION['franchisesession']==$infofr['id'])
					{
						$franpos=$infofr['pos'];
					}
                    }
                ?>
                </select>
                </form>
             <?php
                }
                ?>
                    </div>
                    <style type="text/css">
                    .bells
					{
                    -webkit-animation: ring 6s .7s ease-in-out infinite;
                    -webkit-transform-origin: 50% 4px;
                    -moz-animation: ring 6s .7s ease-in-out infinite;
                    -moz-transform-origin: 50% 4px;
                    animation: ring 6s .7s ease-in-out infinite;
                    transform-origin: 50% 4px;
                    }

@-webkit-keyframes ring 
{
  0% { -webkit-transform: rotateZ(0); }
  1% { -webkit-transform: rotateZ(30deg); }
  3% { -webkit-transform: rotateZ(-28deg); }
  5% { -webkit-transform: rotateZ(34deg); }
  7% { -webkit-transform: rotateZ(-32deg); }
  9% { -webkit-transform: rotateZ(30deg); }
  11% { -webkit-transform: rotateZ(-28deg); }
  13% { -webkit-transform: rotateZ(26deg); }
  15% { -webkit-transform: rotateZ(-24deg); }
  17% { -webkit-transform: rotateZ(22deg); }
  19% { -webkit-transform: rotateZ(-20deg); }
  21% { -webkit-transform: rotateZ(18deg); }
  23% { -webkit-transform: rotateZ(-16deg); }
  25% { -webkit-transform: rotateZ(14deg); }
  27% { -webkit-transform: rotateZ(-12deg); }
  29% { -webkit-transform: rotateZ(10deg); }
  31% { -webkit-transform: rotateZ(-8deg); }
  33% { -webkit-transform: rotateZ(6deg); }
  35% { -webkit-transform: rotateZ(-4deg); }
  37% { -webkit-transform: rotateZ(2deg); }
  39% { -webkit-transform: rotateZ(-1deg); }
  41% { -webkit-transform: rotateZ(1deg); }

  43% { -webkit-transform: rotateZ(0); }
  100% { -webkit-transform: rotateZ(0); }
}

@-moz-keyframes ring {
  0% { -moz-transform: rotate(0); }
  1% { -moz-transform: rotate(30deg); }
  3% { -moz-transform: rotate(-28deg); }
  5% { -moz-transform: rotate(34deg); }
  7% { -moz-transform: rotate(-32deg); }
  9% { -moz-transform: rotate(30deg); }
  11% { -moz-transform: rotate(-28deg); }
  13% { -moz-transform: rotate(26deg); }
  15% { -moz-transform: rotate(-24deg); }
  17% { -moz-transform: rotate(22deg); }
  19% { -moz-transform: rotate(-20deg); }
  21% { -moz-transform: rotate(18deg); }
  23% { -moz-transform: rotate(-16deg); }
  25% { -moz-transform: rotate(14deg); }
  27% { -moz-transform: rotate(-12deg); }
  29% { -moz-transform: rotate(10deg); }
  31% { -moz-transform: rotate(-8deg); }
  33% { -moz-transform: rotate(6deg); }
  35% { -moz-transform: rotate(-4deg); }
  37% { -moz-transform: rotate(2deg); }
  39% { -moz-transform: rotate(-1deg); }
  41% { -moz-transform: rotate(1deg); }

  43% { -moz-transform: rotate(0); }
  100% { -moz-transform: rotate(0); }
}

@keyframes ring {
  0% { transform: rotate(0); }
  1% { transform: rotate(30deg); }
  3% { transform: rotate(-28deg); }
  5% { transform: rotate(34deg); }
  7% { transform: rotate(-32deg); }
  9% { transform: rotate(30deg); }
  11% { transform: rotate(-28deg); }
  13% { transform: rotate(26deg); }
  15% { transform: rotate(-24deg); }
  17% { transform: rotate(22deg); }
  19% { transform: rotate(-20deg); }
  21% { transform: rotate(18deg); }
  23% { transform: rotate(-16deg); }
  25% { transform: rotate(14deg); }
  27% { transform: rotate(-12deg); }
  29% { transform: rotate(10deg); }
  31% { transform: rotate(-8deg); }
  33% { transform: rotate(6deg); }
  35% { transform: rotate(-4deg); }
  37% { transform: rotate(2deg); }
  39% { transform: rotate(-1deg); }
  41% { transform: rotate(1deg); }

  43% { transform: rotate(0); }
  100% { transform: rotate(0); }
}
                </style>
                <script type="text/javascript">
                    function bellfun() {
                       document.getElementById("setarup").style.animation = "setone 2s 3000000";
                    }                   
                </script>
                      <?php
				
				  $sqlinot=mysqli_query($con, "select t1.id, t1.notification from pairnotifications t1, pairnothistory t2 where t2.createdid='$companymainid' and (t2.viewedon='' or t2.viewedon is null) and t1.id=t2.notificationid order by t1.id desc");
				  
				$countnot=mysqli_num_rows($sqlinot);
				  ?>
                  <?php
                if($permissionnotification=='1'&&$rowww['permissionnotification']=='1'){
               ?>
					<div class="col-auto m-auto" style="padding-right:5.4px !important;">
            <div class="dropdown">
              <a class="cursor-pointer" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell-o bells" style="font-size: 20px !important; z-index:1;"></i>
				<span class="badge badge-primary" style="background-color: #ff0000; border-radius: 50%; height: 12px; width: 12px; margin-left: -2px; font-size: 9px; padding: 1px 0px 0px 0px !important;position: relative;top: -12.3px !important;left: -3.5px !important;"><span style="margin-left: -1px !important;"><?=$countnot?></span></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-right px-2 py-1 ms-n4" aria-labelledby="dropdownMenuButton" style="margin-top: -2px !important;">
                <?php
				 
                  while($infonot=mysqli_fetch_array($sqlinot))
				  { 
			  ?>
				<li style="border-bottom:1px solid #cccccc; padding:10px 0;"><?=$infonot['notification']?></li>
				<?php
				  }
				  ?>
				<li style="padding:10px 0;"><a href="notifications.php">View All Notifications</a></li>
              </ul>
			  
            </div>
          </div>
           <?php
                }
                ?>
                <?php
                if($permissionhelp=='1'&&$rowww['permissionhelp']=='1'){
               ?>
					<style type="text/css">
                    .question{
                        animation: quiz 4.5s .3s ease-in-out infinite;
                    }  
                    @keyframes quiz{
                         0% { transform: rotate(-90deg); }
  1% { transform: rotate(-80deg); }
  3% { transform: rotate(-70deg); }
  5% { transform: rotate(-60deg); }
  7% { transform: rotate(-50deg); }
  9% { transform: rotate(-40deg); }
  11% { transform: rotate(-30deg); }
  13% { transform: rotate(-20deg); }
  15% { transform: rotate(-10deg); }
  17% { transform: rotate(0deg); }
  19% { transform: rotate(0deg); }
  21% { transform: rotate(0deg); }
  23% { transform: rotate(0deg); }
  25% { transform: rotate(0deg); }
  27% { transform: rotate(0deg); }
  29% { transform: rotate(0deg); }
  43% { transform: rotate(0); }
  100% { transform: rotate(0); }
                    }             
                    </style>
					
                    <div class="app-utilities col-auto" style="margin-top:4px !important;padding-left: 0px !important;padding-right:
                    <?=
                    (($permissionfranchise=='0')&&($permissionuser=='0')&&($preferencefranchisepermission=='0'&&$permissionuserr=='0'&&$permissionbooks=='0')&&($language=='0'&&$time=='0'&&$currency=='0'&&$taxes=='0')&&($permissionfranchise=='0')&&($permissionuser=='0'))?'0px !important':''
                    ?>
                    ">
                        <div class="app-utility-item">
                        <i class="fa fa-question-circle-o question" style="font-size: 20px !important;"></i>
                    </div>
                    </div>
                    <?php
                }
                ?>
                    <div class="app-utilities col-auto" style="margin-top:-1px !important;padding-right: 5.4px !important;padding-left: 0px !important;">
                        <div class="app-utility-item" style="margin-right: 8px !important;">
                <script src="https://kit.fontawesome.com/9103b0bf4c.js" crossorigin="anonymous"></script>
                 <?php
                if(($permissionfranchise=='2')||($permissionuser=='2')||($preferencefranchisepermission=='1'||$permissionuserr=='1'||$permissionbooks=='1')||($language=='1'||$time=='1'||$currency=='1'||$taxes=='1')||($permissionfranchise=='1')||($permissionuser=='1'))
                {
                ?>  
              <a href="javascript:;" class="p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <style type="text/css">
                    .spinners{
                    animation-name: myfirst;
                    animation-duration: 1.5s;
                    animation-iteration-count: infinite;
                    animation-timing-function: linear; 
                    }
                    @keyframes myfirst {
                         from {
        transform:rotate(0deg);
    }
    to {
        transform:rotate(360deg);
    }
}
                    .setsyl{
                    animation-name: setone;
                    animation-duration: 1.5s;
                    animation-iteration-count: infinite;
                    animation-timing-function: linear;
                    }
                    @keyframes setone {
                         from {
                                   transform:rotate(0deg);
                               }
                               to {
                                   transform:rotate(180deg);
                               }
                           }
                </style>
                <script type="text/javascript">
                    function setfun() {
                       document.getElementById("setarup").style.animation = "setone 2s 3000000";
                    }                   
                </script>
               <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 512 512" xml:space="preserve" class="icon cursor-pointer icon-lg align-text-bottom spinners" style="margin-top: -1px !important;height: 20px !important;width: 24px !important;" onclick="setfun()"><path d="M258.3 149.8c-57.3 0-103.9 46.6-103.9 103.9 0 57.3 46.6 103.9 103.9 103.9s104-46.6 104-103.9c0-57.3-46.6-103.9-104-103.9zm0 175.9c-39.7 0-71.9-32.3-71.9-71.9 0-39.7 32.3-71.9 71.9-71.9 39.7 0 71.9 32.3 71.9 71.9.1 39.6-32.2 71.9-71.9 71.9z"></path><path d="M491.4 202.9l-38.7-14c-3-9.5-6.6-18.6-10.7-27.1l18.3-38.3c5.6-11.8 3.2-26-6-35.2l-30.5-30.6c-9.3-9.3-23.4-11.7-35.2-6.1l-38.2 18.1c-8.1-3.8-16.7-7.1-27.1-10.3l-14-38.7C304.9 8.5 293.2.4 280.2.4h-43.6c-12.9 0-24.6 8.2-29.1 20.4l-14.1 38.8c-9.7 3.1-18.8 6.7-27.1 10.7l-38.2-18.4c-11.8-5.6-26-3.2-35.2 6L62.1 88.3c-9.3 9.3-11.7 23.5-6 35.3l18 37.8c-5.2 9.8-9.2 18.7-12.2 27l-40.8 14.2C8.6 207 .2 218.7.2 232v43.3c0 13.2 8.4 25 20.7 29.2l40.9 14.3c3.1 8.8 6.9 17.7 11.7 27.1L55.6 384c-5.6 11.9-3.2 26 6.2 35.2L92.6 450c9.2 9.2 23.4 11.7 35.2 6l38.1-18.1c9.7 5.2 18.6 9.2 27.1 12.2l14.2 40.8c4.3 12.5 16 20.8 29.3 20.8h43.3c13.2 0 25-8.4 29.3-20.8l14.2-40.9c8.9-3.1 18-7 27.1-11.7l38.1 17.9c11.8 5.6 26 3.1 35.3-6.2l30.7-30.9c9.2-9.2 11.6-23.3 6-35.2l-18.2-38.4c3.8-8 7.1-16.6 10.3-27.1l38.6-14c12.3-4.3 20.6-16 20.6-29V232c0-13-8.2-24.7-20.4-29.1zm-11.6 71.8l-38.5 14c-9.2 3.3-16.1 10.6-19 19.9v.1c-2.8 9.3-5.7 16.8-8.9 23.5-4.1 8.5-4.2 18.3-.1 26.7l18.2 38.3-29.7 29.9-38-17.9c-8.9-4.1-18.8-4-27.3.5-8 4.1-16 7.6-23.7 10.3-8.9 2.9-16.1 10.1-19.3 19.1l-14.2 40.7h-41.8L223.2 439c-3.1-8.9-10-15.9-19-19-7.3-2.6-15-6.1-23.7-10.7s-19.1-4.8-27.9-.6l-37.9 18-29.9-29.8 17.9-37.9c4.1-8.9 4-18.9-.5-27.3-4.3-8.3-7.7-16.1-10.3-23.9-3.1-8.9-10.2-16-19.1-19.1l-40.6-14.2v-41.8l40.7-14.2c8.9-3.1 15.9-10 19-18.9 2.5-7 6-14.7 10.7-23.5 4.6-8.6 4.9-19 .6-27.9l-18-37.8L115 80.9l38 18.3c8.5 4.1 18.6 4 27.1-.2 7.1-3.5 15.1-6.6 23.6-9.3 9-2.9 16.3-9.9 19.6-19l14-38.5h42.1l13.9 38.4c3.3 9.2 10.6 16.1 19.9 19h.1c9.2 2.8 16.6 5.6 23.4 8.9 8.6 4.1 18.3 4.1 26.8.1l38-18 29.5 29.6-18.2 38-.1.2c-4 8.7-4 18.5.2 26.9 3.6 7.4 6.7 15.3 9.3 23.5 2.7 9 9.8 16.4 18.9 19.8l38.5 14v42.1z"></path></svg>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end customdropdown me-sm-n4" aria-labelledby="dropdownMenuButton">   
              <div style="background-color: #3c3c46;margin-top: -9px !important;"> 
              <i class="fa fa-caret-down" id="setarup" style="color: #3c3c46 !important;position: relative;top: -12px;left: 130px;"></i>           
               <?php
               if($permissionfranchise=='1'||$permissionfranchise=='2')
               {
                ?>
               <li class="nav-item" style="margin-top:-22px !important;">
                  <a class="nav-link  <?=($current_file_name=='franchises.php')?'active':''?>" href="franchises.php">
                    <i class="fa fa-building" style="margin-left: 3px;"></i>
                    <span class="nav-link-text ms-2" style="margin-left: 5px !important;"><?= $row['franchiseandroles']?> & Roles</span>
                  </a>
                </li>     
                <?php
                }
                ?>  
                <?php
                if(($permissionuser=='1'||$permissionuser=='2'))
                {
                ?>           
                <li class="nav-item" style="<?=(($permissionfranchise!='1'&&$permissionfranchise!='2')?'margin-top:-22px !important;':'')?>">                  
                <a class="nav-link  <?=($current_file_name=='users.php')?'active':''?>" href="users.php">                    
                <i class="fa fa-users"></i>                    
                <span class="nav-link-text ms-2" style="position: relative;left: -2px;"><?= $row['userandroles']?> & Roles</span>                  
                </a> 
            </li>
            <?php
                }
                ?>
             <?php
               if(($preferencefranchisepermission=='1'||$permissionuserr=='1'||$permissionbooks=='1'))
               {
                ?>
                <li class="nav-item" style="<?=((($permissionuser!='1'&&$permissionuser!='2')&&($permissionfranchise!='1'&&$permissionfranchise!='2'))?'margin-top:-22px !important;':'')?>">
                  <a class="nav-link  <?=($current_file_name=='preference.php')?'active':''?>" href="preference.php">
                    <i class="fa fa-sliders" style="margin-left: 2px;"></i>
                    <span class="nav-link-text ms-2"> Preference</span>
                  </a>
                </li> 
                <?php
                }
                ?>
                <?php
               if(($language=='1'||$time=='1'||$currency=='1'||$taxes=='1'))
               {
                ?>
                 <li class="nav-item" style="<?=((($preferencefranchisepermission!='1'&&$permissionuserr!='1'&&$permissionbooks!='1')&&($permissionuser!='1'&&$permissionuser!='2')&&($permissionfranchise!='1'&&$permissionfranchise!='2'))?'margin-top:-22px !important;':'')?>">
                  <a class="nav-link  <?=($current_file_name=='franchises.php')?'active':''?>" href="config.php">
                    <i class="fa fa-wrench" style="margin-left: 2px;"></i>
                    <span class="nav-link-text ms-2"> Configuration</span>
                  </a>
              </li>
          </div>
          <?php
                }
                ?>
          </ul>
           <?php
                }
                ?> 
                        </div>
                <?php
            $colsarry=array("4285F4", "34A853", "FBBC05", "EA4335", "00A1F1", "7CBB00", "FFBB00", "F65314");
                shuffle($colsarry);
                ?>
                        <div class="app-utility-item app-user-dropdown dropdown">
              <a href="javascript:;" class="p-0 mac" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" <?php if($_SESSION["profileimage"]=='')   { ?>style="width: 35px; height: 35px; text-align:center; border-radius:50px;background-color: #<?=$colsarry[0]?>; color: #000000;" <?php } ?> onclick="macfun()">
                <?php
            if($_SESSION["profileimage"]!='')
            {
                ?>
              <img class="float-left rounded-circle" style="width: 35px; height: 35px;margin-top: -1px !important;" alt="<?=$_SESSION["firstname"]?>" src="<?=($_SESSION["profileimage"]!='')?str_replace('../ups','ups',$_SESSION["profileimage"]):''?>">
              <?php
            }
            else
            {
                
                ?>
                <div style="padding-top: 3.5px; font-size: 18px; margin-top: -1.5px;width: 35px; height: 35px; text-align:center; border-radius:50px;background-color: #<?=$colsarry[0]?>; color: #fff;"><?=substr($_SESSION["firstname"],0,1)?></div>
                <?php
            }
            ?>
              </a>
              <div class="dropdown-menu  dropdown-menu-end customdropdown  me-sm-2" aria-labelledby="dropdownMenuButton1">
                <i class="fa fa-caret-down" id="macarup" style="color: #3c3c46 !important;position: relative;top: -40px;left: 130px;"></i>
                <div style="background-color: #3c3c46;margin-top: -50px !important;">
                    <script type="text/javascript">
                        function macfun(){
                             document.getElementById('macarup').style.animation = "macone 2s 3000000";
                        }
                    </script>
                    <style type="text/css">
                        .macsyl{
                    animation-name: macone;
                    animation-duration: 1.5s;
                    animation-iteration-count: infinite;
                    animation-timing-function: linear;
                    }
                    @keyframes macone {
                         from {
                                   transform:rotate(0deg);
                               }
                               to {
                                   transform:rotate(180deg);
                               }
                           }
                         @media screen and (max-width: 1199px){
                            #macarup{
                                margin-left: -8.9px !important;
                            }
                        }
                    }
                    </style>
                <?php
                if($permissionmyaccount=='1'&&$rowww['permissionmyaccount']=='1'){
               ?>
                  <a class="nav-link  <?=($current_file_name=='myaccount.php')?'active':''?>" href="myaccount.php" style="color: #fff;margin-top: -21px;">
                    <i class="fa fa-user"></i>
                    <span class="nav-link-text ms-2"> My Account</span>
                  </a>
                  <?php
              }
              ?>
                  <a class="nav-link  <?=($current_file_name=='logout.php')?'active':''?>" href="logout.php" style="color: #fff;">
                    <i class="fa fa-sign-out-alt"></i>
                    <span class="nav-link-text ms-2"> Logout</span>
                  </a>
              </div>
              </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </header>