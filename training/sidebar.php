<style>
    .fa-plus-square{
        opacity: 0 !important;
    }
    .fa:hover{
        opacity: 1 !important;
        background: none !important;
    }
    .nav-link:hover .fa-plus-square{
        color: #8391a2;
        opacity: 1 !important;
    }
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav {
    margin-left: 0px !important;
    padding-left: 0px !important;
    margin-top: 0px;
    padding-top: 9px;
}

.g-sidenav-hidden .navbar-vertical .nav-item .collapse .blf{
    border: none !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .pro {
    margin-left: 0px !important;
    padding: 0px !important;
    margin-top: -42px;
    margin-bottom: -50px !important;
    /*background-color: green !important;*/
}
.g-sidenav-hidden .navbar-vertical .nav-item .ove {
   display: none !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .ove {
   display: block !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .books {
   display: none !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .books {
   display: block !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .fsq {
    /*display: none;*/
    position: absolute !important;
    top: 28.8% !important;
    left: 80% !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .fsqs {
    /*display: none;*/
    position: absolute !important;
    top: 32.5% !important;
    left: 80% !important;
}

.g-sidenav-hidden .navbar-vertical .collapse .subnav .nav-item {
    border: none;
    margin-left: 4px;
    margin-top: -9px;
}

.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .subnav .nav-item .nav-link {
    margin-left: 0px !important;
    padding-left: 0px !important;
    margin-top: 9px !important;
}

.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-link .fa {
    padding-left: 20px !important;
    padding-top: 10px !important;
}
@media screen and (min-device-width: 1199px) and (max-device-width: 1900px){
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .collapsed {
    margin-bottom: 6px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .submenuactive{
    margin-bottom: -45px !important;
    height: max-content;
}
/*.g-sidenav-hidden .navbar-vertical:hover #hrlst{
    margin-top: 45px !important;
}*/
.g-sidenav-hidden .navbar-vertical .books{
margin-bottom: <?=($franchisesrole!='')?'22px':'0px'?>;
}
.g-sidenav-hidden .navbar-vertical:hover .books{
margin-bottom: <?=($franchisesrole!='')?'48px':'0px'?>;
}
.g-sidenav-hidden .navbar-vertical .books .collapsed{
margin-bottom: -180px;
}
.g-sidenav-hidden .navbar-vertical:hover .books .collapsed{
margin-top: 6px;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .submenuactive{
    margin-bottom: -53px !important;
    height: 80px;
}
/*.g-sidenav-hidden .navbar-vertical #hrlst{
    margin-top: 25px !important;
}*/
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .egp{
    margin-top: 10px !important;
    padding-left: 16px !important;
    margin-bottom: 54px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .pur{
    margin-top: 39px !important;
    padding-left: 18px !important;
    margin-bottom: 54px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .pur{
    margin-top: 39px !important;
    padding-left: 18px !important;
    margin-bottom: 54px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .purhead{
    margin-top: -9px !important;
    padding-left: 0px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .acchead{
    margin-top: -6px !important;
    padding-left: 0px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .timehead{
    margin-top: 30px !important;
    padding-left: 0px !important;
    margin-bottom: 30px !important;
    padding-top: 0px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .exp{
    margin-top: -66px !important;
    padding-left: 18px !important;
    margin-bottom: 54px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .exp{
    margin-top: -66px !important;
    padding-left: 18px !important;
    margin-bottom: 54px !important;
}.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .exphead{
    margin-top: -14px !important;
    padding-left: 0px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .banking{
    margin-top: -54px !important;
    padding-left: 3px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .banking{
    margin-top: 16px !important;
    padding-left: 3px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .exphead{
    margin-top: -24px !important;
    padding-left: 4.5px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .exphead{
    margin-top: -9px !important;
    padding-left: 4.5px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .accounting{
    margin-top: -14px !important;
    padding-left: 18px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .accounting{
    padding-left: 18px !important;
    margin-bottom: 9px !important;
    padding-top: 0px !important;
    height: 39px !important;
    position: relative;
    top: -30px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .time{
    margin-top: -16px !important;
    padding-left: 18px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .time{
    padding-left: 18px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
    position: relative;
    top: -39px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .eway{
    margin-top: -14px !important;
    padding-left: 4.5px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .gst{
    margin-top: -14px !important;
    padding-left: 7px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .pay{
    margin-top: -14px !important;
    padding-left: 7px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .att{
    margin-top: -14px !important;
    padding-left: 7px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .report{
    margin-top: -14px !important;
    padding-left: 4.5px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .eway{
    margin-top: -14px !important;
    padding-left: 6px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .gst{
    margin-top: -14px !important;
    padding-left: 7px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .pay{
    margin-top: -14px !important;
    padding-left: 7px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .att{
    margin-top: -14px !important;
    padding-left: 7px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .report{
    margin-top: -14px !important;
    padding-left: 6px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
    height: 39px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .rpt{
    margin-top: -69px !important;
    padding-left: 19px !important;
    margin-bottom: 54px !important;
} 
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .rpt{
    margin-top: -69px !important;
    padding-left: 19px !important;
    margin-bottom: 54px !important;
} .g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .rpthead{
    margin-top: -14px !important;
    padding-left: 0px !important;
    margin-bottom: 0px !important;
    padding-top: 0px !important;
} 
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .sales{
    padding-left: 16px !important;
    margin-top: 16px !important;
}   
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .das{
    margin-top: <?=($permissioninsights==0)?'0px':'-15px'?> !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .das{
    margin-top: <?=($permissioninsights==0)?'10px':'0px'?> !important;
}
}
@media screen and (max-width: 1199px){
    /*#iconSidenav{
        display: block !important;
    }*/
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-link .fa {
    padding-left: 20px !important;
    padding-top: 0px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .das{
    margin-top: <?=($permissioninsights==0)?'10px':'0px'?> !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .das{
    margin-top: -15px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .egp{
    margin-top: 30px !important;
    padding-left: 16px !important;
    margin-bottom: 54px !important;
} 
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-item .sales{
    padding-left: 16px !important;
    margin-top: 20px !important;
}   
.hrlst{
    margin-top: -6px !important;
}
.hrlst{
    margin-top: 6px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .ove{
    margin-top: 0px !important;
    display: block !important;
}
}
.hrlst{
    margin-top: 6px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .das{
    margin-top: 0px !important;
} 
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .das{
    margin-top: -18px !important;
} 
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-link .fa {
    padding-left: 0px !important;
    padding-top: 0px !important;
}

.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav {
    margin-left: 0rem !important;
    padding-left: 0rem !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .blf {
   display: block;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .blf {
   display: none;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .egp {
   margin-bottom: 45px !important;
   padding-bottom: 39px !important;
   padding-top: 18px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .egp {
   padding: 15px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .egp {
   padding: 15px !important;
   margin-bottom: 60px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .egps {
   margin-top: -87px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .egps {
   margin-top: -60px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .items {
   margin-left: -24px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .sales {
   padding-left: 16px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .sales{
    padding-left: 15px !important;
    margin-top: 27px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .hrlst{
   margin-top: 0px !important;
}
.g-sidenav-hidden .navbar-vertical .hrlst{
   margin-top: 0px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .psipo {
   margin-left: 0px !important;
   margin-bottom: 0px !important;
   margin-top: -45px !important;
   padding-top: 0px !important;
   padding-bottom: 0px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item {
    margin-left: 0rem !important;
    padding-left: 0rem !important;
    padding-top: 20px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .ddaass{
    padding-top: 0px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .ddaass{
    padding-top: 0px !important;
    margin-top: -9px !important;
}
.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .insights{
    padding-top: 0px !important;
    padding-bottom: 0px !important;
    margin-bottom: 0px !important;
}
.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .insights{
    padding-top: 9px !important;
    padding-bottom: 9px !important;
    margin-bottom: 9px !important;
    margin-top: -7px !important;
}

.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .producttop {
    margin-top:10px !important;
}

.g-sidenav-hidden .navbar-vertical:hover .nav-item .collapse .nav .nav-item .item {

    margin-top: -30px !important;
    margin-left: 25px !important;
    border-left: 3px solid #8391a2;
}



.navbar-vertical.navbar-expand-xs {

    background-color: #313A46 !important;
    color: #8391a2;
}



.navbar-vertical.navbar-expand-xs span:hover {
    color: #bccee4;
}

/*.navbar-vertical.navbar-expand-xs span:hover {
    color: #bccee4;
}*/
.navbar-vertical.navbar-expand-xs .sidebroder:hover {
    color: #bccee4;
}

.navbar-vertical.navbar-expand-xs .navbar-nav>.nav-item {
    margin-top: -5px;
}

.navbar-vertical .navbar-nav .nav-link {
    padding-left: 1rem;
    padding-right: 1rem;
    font-weight: 400;
    color: #8391a2;
}

.navbar-vertical .navbar-nav .nav-link:hover {
    padding-left: 1rem;
    padding-right: 1rem;
    font-weight: 400;
    color: #bccee4;
}

ul.navbar-nav>li .app-nav .nav-link.active {
    color: #15a362;
    background: #edfdf6;
    border-left: 3px solid #15a362;
    font-weight: 500;
}




.subnav>.active>a {
    background: #edfdf6;
    border-left: 0px solid #bccee4;
}

.navbar-nav>.active>a {

    border-left: 3px solid #8391a2;
    font-weight: 500;
}

.navbar-vertical .navbar-nav .nav-link[data-bs-toggle="collapse"]:after {
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    font-family: 'Font Awesome 5 Free';
    font-weight: 700;
    content: "\f107";
    margin-left: 5px;
    margin-top: 3px;
    color: #8391a2;
    transition: all 0.2s ease-in-out;
}



.sidebroder>li {
    border-left: 3px solid #8391a2;
}


.navbar-vertical .navbar-nav .nav-link>i {
    min-width: 0px;
    font-size: 0.9375rem;
    line-height: 1.5rem;
}

.navbar-vertical .navbar-nav .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]:after {
    color: #8391a2;
    transform: rotate(180deg);
}
.nav .nav-item .egp[data-bs-toggle="collapse"][aria-expanded="false"]{
    margin-bottom: 0px !important;
}
.nav .nav-item .sales[data-bs-toggle="collapse"][aria-expanded="false"]{
    margin-bottom: 0px !important;
}
.navbar-vertical.navbar-expand-xs .navbar-nav .nav-link i {
    color: #8391a2;
}

.navbar-vertical.navbar-expand-xs .navbar-nav .nav-link i:hover {
    color: #8391a2;
}




.navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item .das:hover,
.navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item .pro:hover {
    color: #bccee4;
}


.navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item .item:hover {
    color: #8391a2;
}



.navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item.active .das {
    background-color: #17A2B7;
    color: #fff;
}

.navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item .nav-link {
    color: #8391a2;
}

.marginleft {

    margin-left: 10px;
    margin-top: 3.5%;
}


.navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item .nav-link.active,
.navbar-vertical .navbar-nav .nav-item .collapsing .nav .nav-item .nav-link.active {

    background-color: #1BBC9B;
    color: #fff;
    font-weight: normal;
}



.navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item.active .item {
    background-color: #1BBC9B;
    color: #fff;
}

.navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item.active .item span:hover {
    color: #bccee4;
}

.navbar-vertical .navbar-nav .nav-item .collapse .nav .nav-item .item span:hover {
    color: #bccee4;
}

.g-sidenav-hidden .navbar-vertical .collapse .subnav .nav-item {
    border: none;
    margin-left: 4px;
    margin-top: 3px;
}

.g-sidenav-hidden .navbar-vertical .nav-item .collapse .nav .nav-link .marginleft {
    padding-left: 20px !important;
    padding-top: 20px !important;
}
/*
.g-sidenav-hidden .navbar-vertical .navbar-brand{
    width: 100px !important;
}*/
.g-sidenav-hidden .navbar-vertical:hover .navbar-brand{
    width: 200px !important;
}
#iconSidenav{
    z-index: 9000000 !important;
    margin-top: -5px !important;
    margin-left: -90px !important;
    width: 100% !important;
    height: 100% !important;
    background-color: white !important;
    padding-left: 210px !important;
    font-weight: bolder !important;
    display: none;
}
</style>
<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0"
            aria-hidden="true" id="iconSidenav" onclick="closefun()" style="display: none;"></i>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main"
    style="font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;margin-bottom: -450px !important;z-index: 9000000 !important;">
    <div class="sidenav-header sticky-top" id="sidenav-header">
        <!--  <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0"
            aria-hidden="true" id="iconSidenav" onclick="closefun()" style="display: none;margin-left: 100%;"></i>  -->
            <script type="text/javascript">
                function closefun() {
                    var bar = document.getElementById('bar');
                    bar.style.display = 'block';
                    var eye = document.getElementById('eye');
                    eye.style.display = 'none';
                    var iissnn = document.getElementById('iconSidenav');
                    iissnn.style.display = 'none';
                }
            </script>
        <a class="navbar-brand m-0" href="training.php" style="background-color:#ffffff; height:47px; text-align:left;">
            <img src="assets/img/headerbetalogo.png" id="main_logo" class="navbar-brand-img" alt="main_logo"
                style="height:40px;">
            <img src="assets/img/betalogo.png" id="single_logo" class="navbar-brand-img" alt="main_logo"
                style="height:40px; display:none">

        </a>
    </div>
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main" style="padding-bottom: 54px !important;overflow-y: scroll !important;height: 100% !important;">
        <ul class="navbar-nav">

            <li class="nav-item ">
                <a data-bs-toggle="collapse" href="#show" class="nav-link ove" aria-controls="show" role="button"
                    aria-expanded="true"
                    style="border-left: 3px solid none;padding-left: 12px;padding-bottom: 3px;padding-top: 10px;font-size:14px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;">

                    <span class="nav-link-text ms-1">Overview</span>
                </a>
                <div class="collapse collapseshow show"
                    id="show">
                    <ul class="nav">
                        <?php
                        if ($permissioninsights==1) {
                        ?>
                        <li class="nav-item insights <?=($current_file_name=='insights.php')?'active':''?>">
                            <a id="dashboard"
                                style="margin-left: 0px;margin-top: -4px;margin-bottom: 5px;padding-bottom: 9px;padding-top: 9px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: .9375rem;height:30px;"
                                class="nav-link das" href="insights.php"
                                onclick="javascript:window.open('insights.php','_self')">
                                <p class="fa fa-bar-chart" style="margin-top:8.1%;padding-right:3px;"></p>
                                <span class="nav-link-text ms-1">Insights</span>
                            </a>
                        </li>
                        <?php
                }
                    ?>
                        <li class="nav-item ddaass <?=($current_file_name=='training.php')?'active':''?>">
                            <a id="dashboard"
                                style="margin-left: 0px;margin-top: -4px;margin-bottom: 5px;padding-bottom: 9px;padding-top: 9px;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: .9375rem;height:30px;"
                                class="nav-link das" href="training.php"
                                onclick="javascript:window.open('training.php','_self')">
                                <p class="fa fa-home" style="margin-top:8.1%;padding-right:3px;"></p>
                                <span class="nav-link-text ms-1">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
             
                        
            <hr style="margin-bottom: 5px;margin-top: 0px;" class="hrlst">
<?php
$sqlprefer = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
$resultprefer = mysqli_query($con, $sqlprefer);
$sidebarprefer = mysqli_fetch_array($resultprefer);
if ((($sidebarprefer['createdid']=='0')&&$sidebarprefer['permissionsidebooks']!=0)||(($sidebarprefer['createdid']!='0')&&($sidebarprefer['permissionsidebooks']!=0))) {
                    ?>
<li class="nav-item books">
                <a
                <?php
                $sqlmain = mysqli_query($con,"select distinct grouptype,groupname,groupaccess,createdid,useraccesscreate,useraccessdelete,useraccessedit,useraccessview from pairmainaccess where userid='$userid'");
while($sqlmainresultans = mysqli_fetch_array($sqlmain)){
    $coltype = preg_replace('/\s+/', '', $sqlmainresultans['grouptype']);
    $maingrouptype=$sqlmainresultans['grouptype'];
if(($sqlmainresultans['createdid']=='0'&&$sqlmainresultans['groupaccess']=='1')||(($sqlmainresultans['createdid']!='0'&&$sqlmainresultans['groupaccess']=='1')&&($sqlmainresultans['useraccessview']==1||$sqlmainresultans['useraccesscreate']==1||$sqlmainresultans['useraccessedit']==1||$sqlmainresultans['useraccessdelete']==1))){
    if ($franchisesrole!='') {
    ?>
                 data-bs-toggle="collapse" aria-controls="Module" href="#Module" class="nav-link " role="button" aria-expanded="true"
                 <?php
             }
         }
         }
                 ?>
                    style="border-left: 3px solid none;padding-left: 12px;padding-bottom: 0px;padding-top: 3px;font-size:14px !important;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;font-size: .9375rem;height:30px;cursor: pointer;">
                    <?php
                    $sqlbook = "select * from paircontrols where (username = '".$_SESSION['unqwerty']."' or usernewname = '".$_SESSION['unqwerty']."')";  
                    $resultbook = mysqli_query($con, $sqlbook);
                    $sidebarbooks = mysqli_fetch_array($resultbook);
                    ?>
                    <span class="nav-link-text ms-1" style="padding-top: 0px;font-size: 14px !important;"><?= $sidebarbooks['books']?></span>
                </a>
                <?php
                if($franchisesrole!='')
                {
            ?>  
                <div class="collapse collapseshow pro show"
                    id="Module">
<?php
$pagesmodule['products']='product';
$pagesmodule['services']='service';
$pagesmodule['inventoryadjustments']='adjustment';
$pagesmodule['customers']='customer';
$pagesmodule['enquiries']='enquiry';
$pagesmodule['quotations']='quotation';
$pagesmodule['estimates']='estimate';
$pagesmodule['proformainvoices']='proforma';
$pagesmodule['jobs']='job';
$pagesmodule['salesorders']='salesorder';
$pagesmodule['deliverychallans']='deliverychallan';
$pagesmodule['invoices']='invoice';
$pagesmodule['paymentsreceived']='salespayment';
$pagesmodule['creditnotes']='creditnote';
$pagesmodule['salesreturns']='salesreturn';
$pagesmodule['customerrefunds']='customerrefund';
$pagesmodule['vendors']='vendor';
$pagesmodule['purchaseorders']='purchaseorder';
$pagesmodule['purchasereceives']='purchasereceive';
$pagesmodule['bills']='bill';
$pagesmodule['paymentsmade']='purchasepayment';
$pagesmodule['debitnotes']='debitnote';
$pagesmodule['purchasereturns']='purchasereturn';
$pagesmodule['vendorrefunds']='vendorrefund';
$pagesmodule['manualjournals']='manualjournal';
$pagesmodule['chartofaccounts']='chartaccount';
$pagesmodule['projects']='project';
$pagesmodule['timesheet']='timesheet';

$sqlmain = mysqli_query($con,"select distinct grouptype,groupname,groupaccess from pairmainaccess where userid='$userid' order by id asc");
$modulecheckbook=0;
while($sqlmainresult = mysqli_fetch_array($sqlmain)){
    $coltype = preg_replace('/\s+/', '', $sqlmainresult['grouptype']);
    $maingrouptype=$sqlmainresult['grouptype'];
$sqlmainansnew = mysqli_query($con,"select grouptype,groupname,groupaccess,createdid,useraccesscreate,useraccessdelete,useraccessedit,useraccessview,moduleaccess from pairmainaccess where userid='$userid' and grouptype='".$sqlmainresult['grouptype']."' order by id asc");
$sqlmainresultansnewuseraccessview=0;
$sqlmainresultansnewuseraccesscreate=0;
$sqlmainresultansnewuseraccessedit=0;
$sqlmainresultansnewuseraccessdelete=0;
$sqlmainresultansnewcreatedid=0;
while($sqlmainresultansnew = mysqli_fetch_array($sqlmainansnew)){
    if($sqlmainresultansnew['moduleaccess']==1){
        ($sqlmainresultansnew['useraccessview']==1)?$sqlmainresultansnewuseraccessview++:'';
        ($sqlmainresultansnew['useraccesscreate']==1)?$sqlmainresultansnewuseraccesscreate++:'';
        ($sqlmainresultansnew['useraccessedit']==1)?$sqlmainresultansnewuseraccessedit++:'';
        ($sqlmainresultansnew['useraccessdelete']==1)?$sqlmainresultansnewuseraccessdelete++:'';
    }
    $sqlmainresultansnewcreatedid=$sqlmainresultansnew['createdid'];
}

if(($sqlmainresultansnewcreatedid=='0'&&$sqlmainresult['groupaccess']=='1')||(($sqlmainresultansnewcreatedid!='0'&&$sqlmainresult['groupaccess']=='1')&&((($sqlmainresultansnewuseraccessview>0))||(($sqlmainresultansnewuseraccesscreate>0))||(($sqlmainresultansnewuseraccessedit>0))||(($sqlmainresultansnewuseraccessdelete>0))))){
    ?>
                    <ul class="nav submenuactive">
                        <?php
                        if ($coltype=='Banking') {
                            $singlepages = 'banking';
                        }
                        elseif ($coltype=='Expences') {
                            $singlepages = 'expenses';
                        }
                        elseif ($coltype=='e-WayBills') {
                            $singlepages = 'ewaybills';
                        }
                        elseif ($coltype=='GSTFilling') {
                            $singlepages = 'gstfilling';
                        }
                        elseif ($coltype=='Payroll') {
                            $singlepages = 'payroll';
                        }
                        elseif ($coltype=='Attendence') {
                            $singlepages = 'attendence';
                        }
                        elseif ($coltype=='Reports') {
                            $singlepages = 'reports';
                        }
                        ?>
                        <?php
                        if ($coltype=='Items') {
                            $icons = 'fa fa-shopping-basket';
                        }
                        elseif ($coltype=='Sales') {
                            $icons = 'fa fa-shopping-cart';
                        }
                        elseif ($coltype=='Purchase') {
                            $icons = 'fa fa-shopping-bag';
                        }
                        elseif ($coltype=='Banking') {
                            $icons = 'fa fa-university';
                        }
                        elseif ($coltype=='Expences') {
                            $icons = 'fa fa-file-text-o';
                        }
                        elseif ($coltype=='Accounting') {
                            $icons = 'fa fa-tasks';
                        }
                        elseif ($coltype=='TimeTracking') {
                            $icons = 'fa fa-clock-o';
                        }
                        elseif ($coltype=='e-WayBills') {
                            $icons = 'fa fa-truck';
                        }
                        elseif ($coltype=='GSTFilling') {
                            $icons = 'fa fa-percent';
                        }
                        elseif ($coltype=='Payroll') {
                            $icons = 'fa fa-gift';
                        }
                        elseif ($coltype=='Attendence') {
                            $icons = 'fa fa-check-square-o';
                        }
                        elseif ($coltype=='Reports') {
                            $icons = 'fa fa-pie-chart';
                        }
                        ?>
<li class="nav-item" <?php if (($coltype=='Banking')||($coltype=='Expences')||($coltype=='e-WayBills')||($coltype=='GSTFilling')||($coltype=='Payroll')||($coltype=='Attendence')||($coltype=='Reports')) { ?>onclick="window.open('<?= $singlepages ?>.php','_self')" <?php } ?>>
<a data-bs-toggle="<?= (($coltype=='Banking')||($coltype=='Expences')||($coltype=='e-WayBills')||($coltype=='GSTFilling')||($coltype=='Payroll')||($coltype=='Attendence')||($coltype=='Reports'))?'':'collapse' ?>" aria-controls="<?= (($coltype=='Banking')||($coltype=='Expences')||($coltype=='e-WayBills')||($coltype=='GSTFilling')||($coltype=='Payroll')||($coltype=='Attendence')||($coltype=='Reports'))?'':'groups'.strtolower($coltype) ?>" href="<?= (($coltype=='Banking')||($coltype=='Expences')||($coltype=='e-WayBills')||($coltype=='GSTFilling')||($coltype=='Payroll')||($coltype=='Attendence')||($coltype=='Reports'))?'':'#groups'.strtolower($coltype)?>" class="nav-link producttop pro egp" role="button" aria-expanded="true" style="margin-left: 0px;margin-bottom: -45px;margin-top: 0px;padding-top: 0px;padding-bottom: 0px;font-size: .9375rem;font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;height:30px;width:auto;">
<p class="<?= $icons ?>" style="margin-top:9%;padding-right:3px;"></p>
<span class="nav-link-text ms-1"><?= $sqlmainresult['groupname'] ?></span>
</a>
<div class="collapse collapseshow show" id="groups<?=strtolower($coltype)?>">
<ul class="nav subnav nav-sm flex-column blf psipo" style="margin-left: 23px;margin-top: 23%;border-left: 3px solid #8391a2;">                      
<?php
$sqlismainaccessuser=mysqli_query($con, "select * from pairmainaccess where userid='$userid' and (grouptype='$maingrouptype' and moduletype!='') order by ordering asc");
while($infomainaccessuser=mysqli_fetch_array($sqlismainaccessuser)){
if ($infomainaccessuser['moduleaccess']=='1'||$sqlmainresult['groupaccess']=='1') {
$modulecheckbook+=1;
}
    $coltype1 = strtolower(preg_replace('/\s+/', '', $infomainaccessuser['moduletype']));
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccessview']==1||$infomainaccessuser['useraccesscreate']==1||$infomainaccessuser['useraccessedit']==1||$infomainaccessuser['useraccessdelete']==1))) {
$sqlupaccess=mysqli_query($con,"select * from pairaccess where createdid='$companymainid'");
$fetchsqlaccess=mysqli_fetch_array($sqlupaccess);
$listcurfile = $pagesmodule[$coltype1].(($pagesmodule[$coltype1]!='timesheet')?'s':'').'.php';
$addcurfile = $pagesmodule[$coltype1].'add.php';
$editcurfile = $pagesmodule[$coltype1].'edit.php';
$viewcurfile = $pagesmodule[$coltype1].'view.php';
$importcurfile = $pagesmodule[$coltype1].'import.php';
?>
<li class="nav-item  <?=((($current_file_name==$listcurfile)||($current_file_name==$addcurfile)||($current_file_name==$editcurfile)||($current_file_name==$viewcurfile)||($current_file_name==$importcurfile))?'active':'')?>" style="display:<?=((($pagesmodule[$coltype1]=='salespayment')&&($fetchsqlaccess['payreceiveside']=='0')||($pagesmodule[$coltype1]=='customerrefund')&&($fetchsqlaccess['salepaymadeforside']=='0')||($pagesmodule[$coltype1]=='purchasepayment')&&($fetchsqlaccess['paymadeside']=='0')||($pagesmodule[$coltype1]=='vendorrefund')&&($fetchsqlaccess['purpaymadeforside']=='0')||($pagesmodule[$coltype1]=='salesreturn')&&($fetchsqlaccess['salesreturnsidebar']=='0')||($pagesmodule[$coltype1]=='purchasereturn')&&($fetchsqlaccess['purchasereturnsidebar']=='0'))?'none':'block')?>;">
<a class="nav-link item" style="margin-left: 0px;padding-top: 0px;padding-bottom: 0px;padding-left: 0px;font-size: 15px !important;">
<span onclick="javascript:window.open('<?=$pagesmodule[$coltype1]?><?=(($pagesmodule[$coltype1]!='timesheet')?'s':'')?>.php','_self')" style="width: 136px !important;overflow: hidden;">
<span class="marginleft mb-3" style="height: 5px;padding-left: 0;"></span>
<span class="nav-link-text ms-1 items" style="margin-top:2px;font-size: 15px !important;padding-left: 0;"><?= $infomainaccessuser['modulename']; ?></span>
</span>
<?php
if((($infomainaccessuser['createdid']=='0')&&($infomainaccessuser['moduleaccess']=='1'))||(($infomainaccessuser['createdid']!='0')&&($infomainaccessuser['moduleaccess']=='1')&&($infomainaccessuser['useraccesscreate']==1))) {
?>
<span onclick="javascript:window.open('<?=$pagesmodule[$coltype1]?>add.php','_self')" class="fa fa-plus-square textover " aria-hidden="true" style="display: <?=((($pagesmodule[$coltype1]=='creditnote')&&($fetchsqlaccess['creditnotesidesidebar']=='0')||($pagesmodule[$coltype1]=='debitnote')&&($fetchsqlaccess['debitnotesidesidebar']=='0')||($pagesmodule[$coltype1]=='salesreturn')||($pagesmodule[$coltype1]=='purchasereturn'))?'none':'')?>;"></span>
<?php
}
?>
</a>
</li>
<?php                                   
}
}
?>
</ul>
</div>
</li>
</ul>
<?php
}
}
?>
</div>
<?php
}
?>
</li>
<?php
if($franchisesrole!='')
{
if ($modulecheckbook==0) {
?>
<style type="text/css">
.g-sidenav-hidden .navbar-vertical:hover .books{
margin-bottom: 23px;
}
</style>
<?php
}
}
?>
             
<hr style="margin-bottom: 5px;margin-top: 0px;" class="hrlst" id="hrlst">

    </ul>
    </div>
    </li>

<?php
}
?>
    </ul>
    </div>
    <script>
    $(document).ready(function() {
        "use strict";

        $('ul.nav > li > a').click(function(e) {

            e.preventDefault();
            $('ul.nav > li > a').removeClass('active');
            $(this).addClass('active');
        });




    });
    $(document).on('click', '.sidenav-toggler-inner', function() {
        $('.collapseshow').collapse('show');
    });


    $(document).on('click', '.producttop', function() {
        //alert("yres");

        $('.item').css("background-color", "transparent");
        $('.item').css("color", "#8391a2");




    });
    </script>



</aside>