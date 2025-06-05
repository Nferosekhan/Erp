  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" media="all" href="vendor/daterangepicker/daterangepicker.css" />

  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/dtimporttsa-ui.css" rel="stylesheet" />
  <link href="assets/css/improved-inventory.css" rel="stylesheet" />

  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <link href="assets/fontawesome/css/all.css" rel="stylesheet">
  <link href="assets/js/plugins/jquery-ui-1.13.1/jquery-ui.min.css" rel="stylesheet" />
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />  
  <link href="vendor/select2/css/select2.min.css" rel="stylesheet" />
  <link href="vendor/select3/css/select3.min.css" rel="stylesheet" />
  <link href="vendor/select4/css/select4.min.css" rel="stylesheet" />
  <link href="vendor/select5/css/select5.min.css" rel="stylesheet" />
  <link href="vendor/select6/css/select6.min.css" rel="stylesheet" />
  
<style type="text/css">
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable:has(.redstockhand){
background-color: red !important;
}
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable .blinkonloweststkhad{
color: black;
}
@media screen and (max-width: 991px){
  .stockonmobile{
    position: relative;
    top: -2.5px;
  }
}
    .blinkonloweststkhad {
      animation: blinkrows 0.7s infinite;
      color: red;
    }
    @keyframes blinkrows {
      0% {
        opacity: 0;
      }
      50% {
        opacity: .5;
      }
      100% {
        opacity: 1;
      }
    }
@media screen and (max-width: 845px){
 #pagenumcontainer li.ant-pagination-options:before {
    content: "";
    display: block;
    width: 250px !important;
  }
}
#pagenumcontainer li.ant-pagination-options{
display: inline-block !important;
}
@media screen and (max-width: 575px){
.grandtotalfixed{
display: none !important;
}
.toleftmob{
text-align:left !important;
}
.torightmob{
text-align:right !important;
}
.mobscrolls{
max-height:230px !important;
}
}
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable .subtextfoo td:hover{
    color: white !important;
}
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable .subtextfoo{
color: #000000 !important;
}
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable .itemmodulehov{
background-color: #fff !important;
color: #000 !important;
}
.subtextfoo{
    margin-bottom: -6px !important;
    margin-top: -3px !important;
}
#selected_items{
cursor: pointer;
}
#selected_items .input-group-append:hover .input-group-text{
background-color: lightgrey !important;
color: green !important;
}
#selected_items .input-group-prepend:hover .input-group-text{
background-color: lightgrey !important;
color: red !important;
}
.greycoltxthead:hover .itemmodulehov{
background-color: #fff !important;
color: #000 !important;
}
.hovthepro:hover .ticorunticing{
visibility: visible !important;
color: #fff !important;
}
.hovthepro{
cursor: pointer;
}
.ticoruntic:hover .hovthepro{
background-color: rgb(27, 188, 155) !important;
color: #fff !important;
}
.hovthepro:hover{
background-color: rgb(27, 188, 155) !important;
color: #fff !important;
}
.greycoltxt:hover{
color: #fff !important;
}
.daterangepicker .drp-buttons .btn {
margin-bottom: 0px !important;
}
.cancelBtn{
margin-bottom: 0px !important;
}
.applyBtn{
margin-bottom: 0px !important;
}
@media screen and (max-width: 320px){
  .daterangepicker.openscenter:before{
    left: -163px !important;
  }
  .daterangepicker.openscenter:after{
    left: -163px !important;
  }
}
@media screen and (min-device-width: 321px) and (max-device-width: 345px) {
  .daterangepicker.openscenter:before{
    left: -115px !important;
  }
  .daterangepicker.openscenter:after{
    left: -115px !important;
  }
}
@media screen and (min-device-width: 346px) and (max-device-width: 385px) {
  .daterangepicker.openscenter:before{
    left: -66px !important;
  }
  .daterangepicker.openscenter:after{
    left: -66px !important;
  }
}
@media screen and (max-width: 729px){
  .daterangepicker .ranges ul{
    max-height: 100px !important;
    overflow: scroll !important;
  }
}
.form-control:disabled,
.form-control[readonly] {
background-color: #e9ecef;
opacity: 1;
}
.headingall{
font-size:20px;
border-bottom: 1px dashed lightgrey;
width: max-content;
}
table td[data-label='SALE QUANTITY']::before {
background-color: #1BBC9B;
}
@media screen and (max-width: 991px){
    .dvi {
        width: 200px !important;
        right: 25px !important;
    }
}
.dvi {
  position: absolute;
  float: right;
  background-color: #fff;
  border: 1px solid #cccccc !important;
  border-radius: 0 0 5px 5px;
  border-top: none;
  font-family: sans-serif;
  width: 354px;
  padding: 0px;
  max-height: 10rem;
  overflow-y: auto;
  border-bottom: 1px solid #cccccc !important;
}

.dvi div td{
    white-space: nowrap !important;
}

.dvi div {
  background-color: #fff;
  padding: 0px;
  color: black;
  margin-bottom: 0px;
   font-size: 13px;
  cursor: pointer;
}

.dvi div:hover{
  background-color: #1BBC9B !important;
  color: #fff;
}

.select2-container .select2-selection--single .select2-selection__rendered{
white-space: normal !important;
}

.select2-container .select2-selection--single{
    overflow: hidden !important;
}

  </style>

  <!-- <link href="assets/css/customeradd.css" rel="stylesheet"> -->
  <!-- <link href="assets/css/customeredit.css" rel="stylesheet"> -->
  <!--<link href="assets/css/customerview.css" rel="stylesheet">-->
  <style>
    input[readonly]:focus{
        outline: none !important;
        box-shadow: none !important;
    }
    .select2-search--dropdown{
        padding:0px !important;
    }
    @media only screen and (max-width: 991px) {
#gsttable td, th{
    border-top:none !important;
    border-right:none !important;
    border-left:none !important;
}
#gsttable tr{
    border:1px solid #999 !important;
}
}
    .select2-container--open .select2-dropdown--below{
        border-bottom: 1px solid #aaa !important;
    }
  .select2-container--default .select2-selection--single{	border:none;}.select2-container{	width: 130px;	margin-top:3px;}
  @media only screen and (max-width: 600px) 
  {
	  .select2-container
	  {	
		  width: 90px !important;	margin-top:3px;
	  }
	 /* .select2-container--open .select2-dropdown--below
	  {
		  width: 130px !important;
	  }*/
	  #fulla
	  {
	  padding-left: 12px !important;
	  }
}.text-blue{	color:#17A2B7 !important;}
.select2-container--default .select2-selection--single
{
	font-size: 0.85rem;
    border-radius: 2px;
height: 25px;    border: 1px solid #ced4da;
font-weight: 400;
    line-height: 1.6;
}
</style>
<style>
<?php
if ($current_file_name=='dashboard.php') {
?>
@media screen and (max-width: 576px) 
{
  .mobviewtab {
    border: 0;
    margin-top: 13px;
  }

  .mobviewtab caption {
    font-size: 1.3em;
  }
  
  .mobviewtab thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
    display: none;
  }
  
  .mobviewtab tr {
    border-bottom: 1px solid #ddd;
    border-top: 1px solid #ddd;
    display: block;
    margin-bottom: 1em;
  }
  
  
  .mobviewtab td {
/*    height: 32.64px !important;*/
    border-bottom: 0px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  .mobviewtab td::before {
/*    color: grey !important;*/
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  .mobviewtab td:last-child {
    border-bottom: 0;
  }
}
<?php
}
?>
 <?php
if ($current_file_name=='configuration_language_view.php'||$current_file_name=='configuration_country_view.php'||$current_file_name=='configuration_currency_view.php'||$current_file_name=='taxview.php'||$current_file_name=='taxgview.php') {
?>
    thead td{
        color: grey !important;
        font-weight: 600 !important;
    }
<?php
}
if ($current_file_name=='preference.php'||$current_file_name=='config.php'||$current_file_name=='configuration_language_view.php'||$current_file_name=='configuration_language_edit.php'||$current_file_name=='configuration_country_view.php'||$current_file_name=='configuration_country_edit.php'||$current_file_name=='configuration_currency_list.php'||$current_file_name=='configuration_currency_add.php'||$current_file_name=='configuration_currency_view.php'||$current_file_name=='configuration_currency_edit.php'||$current_file_name=='taxs.php'||$current_file_name=='taxadd.php'||$current_file_name=='taxgadd.php'||$current_file_name=='taxview.php'||$current_file_name=='taxedit.php'||$current_file_name=='taxgview.php'||$current_file_name=='taxgedit.php') {
}
if ($current_file_name=='productadd.php'||$current_file_name=='productedit.php'||$current_file_name=='serviceadd.php'||$current_file_name=='serviceedit.php') {
?>
.select2-selection--single .select2-selection__rendered[title=<?=$access['txtnamecategory']?>]{color:#b9c0c7 !important;line-height:28px}
table td{
    height: 32px !important;
}
 .mfsub{
 display: block;

 }
 .modal-content{
  border-radius: 0px;

 }
 .modal-header{
  border-radius:0px !important;

 }
 .modal-title{
  color:#212529;

 }
 #closeicon{
  font-size: 21px;

  font-weight: 600;

 }
 .modal-body{
  padding-bottom: 0px !important;

  margin-bottom: -24.5px !important;

 }
.modal-footer{
     display: block;

     margin-bottom: -14.5px;

}
.mbsub{
     padding-bottom: 0px !important;

     margin-bottom: 0px !important;

}

.customcont-heading{
     font-size: 18px;

}
  #unitsindes{
 margin-bottom: 0px !important;
 margin-top: 9px !important;
 
 }
 #uqcindes{
 padding-left: 0px;
 
 }
 .bi-question-circle{
color: #777777;
width: 14;
height: 14;
cursor: pointer;
margin-bottom: 3px;

}
 #uck{
height:36px;

}
 #defaultunit{
  width: 100%;
  
  }
   .deltophead{
margin-top:0px;

  }
 #delinpbrd{
   border:1px solid lightgrey;
   
   }
#description{
    height: 70px !important;
    
    }
    #taxprefer{
height:48px !important;

        }
         #flagicon{
width: max-content !important;
border: solid 2px #e9ecef;
height: 32px !important;

        }
         #flagimg{
padding-top: 3.5px;
padding-bottom: 5px;
padding-left: 5px;
padding-right: 5px;

        }
         #taxratecountry{
border:1px solid #fff !important;
background-color: #fff !important;
height: 22px !important;
padding-top: 8px !important;

        }
        #intrahead{
 height:48px !important;
 
        }
        @media screen and (max-width: 575px){
     #intrahead{
 margin-top: 18px !important;
        }
}
/*@media screen and (max-width: 1344px) {
    #ruppeitemtable{
        display: none !important;
    }
    #ruppeitemtablemob{
        display: block !important;
    }
}*/
 #neweditpro{
  font-size:20px;

  border-bottom: 1px dashed lightgrey;

  width: max-content;

 }
 @media screen and (max-width: 1344px){
.productselectwidth{
width: 146px !important;
height: 18.78px !important;
float:right !important;
}
.productselectwidthnamdes{
width: 146px !important;
height: 18.78px !important;
float:right !important;
}
}
    @media screen and (min-device-width: 1345px) and (max-device-width: 3000px) {
.productselectwidth{
float:right !important;
width:90% !important;
}
}
 /*@media screen and (max-width: 382px){
        #productname1{
height:21px;
padding: 0px;
font-size: 9.92px !important;
width: 100px !important;
    }
     #ruppesymbol{
color: #495057;
padding: 8px 3.75px;
height:21px;
font-size: 9.92px !important;
    }
     #quantity1{
height:21px;
text-align: right;
padding: 0px;
font-size: 9.92px !important;
width: 100px !important;
    }
     #productrate1{
height:21px;
text-align: right;
padding: 0px;
font-size: 9.92px !important;
width: 100px !important;
    }
    #purquantity1{
height:21px;
text-align: right;
padding: 0px;
font-size: 9.92px !important;
width: 100px !important;
    }
     #purproductrate1{
height:21px;
text-align: right;
padding: 0px;
font-size: 9.92px !important;
width: 100px !important;
    }
      #vat1{
height:21px;
padding: 0px;
text-align: left;
font-size: 9.92px !important;
width: 100px !important;
     }
    }
    @media screen and (min-device-width: 320px) and (max-device-width: 382px){
             #productname1{
height:21px;
padding: 0px;
font-size: 9.92px !important;
width: 130px !important;
    }
     #ruppesymbol{
color: #495057;
padding: 8px 3.75px;
height:21px;
font-size: 9.92px !important;
    }
     #quantity1{
height:21px;
text-align: right;
padding: 0px;
font-size: 9.92px !important;
width: 130px !important;
    }
     #productrate1{
height:21px;
text-align: right;
padding: 0px;
font-size: 9.92px !important;
width: 130px !important;
    }
    #purquantity1{
height:21px;
text-align: right;
padding: 0px;
font-size: 9.92px !important;
width: 130px !important;
    }
     #purproductrate1{
height:21px;
text-align: right;
padding: 0px;
font-size: 9.92px !important;
width: 130px !important;
    }
      #vat1{
height:21px;
padding: 0px;
text-align: left;
font-size: 9.92px !important;
width: 130px !important;
     }

    }*/
<?php
}
?>
 <?php
if ($current_file_name=='products.php'||$current_file_name=='services.php') {
?>
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
    #tableEditor {
        position: absolute;
        left: 250px;
        top: 161px;
        padding: 5px;
        border: 1px solid #000;
        background: #fff;
    }
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
@media screen and (min-device-width: 313px) and (max-device-width: 991px) {
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
@media screen and (min-device-width: 100px) and (max-device-width: 312px) {
    .add{
        position: relative;
        left: -54px !important;
        top: 36px;
}
.addmenu{
    position: relative;
    left: -57px !important;
        top: 36px;
}
}

@media screen and (min-device-width: 870.5px) and (max-device-width: 993px) {
    table{
        margin-top: 30px !important;
    }
}


    @media screen and (max-width: 870px) {
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
/*            color: grey !important;*/
            /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }
    #loadimgins{
        width: 100% !important;
    }

        table td:last-child {
            border-bottom: 0;
        }
    }
<?php
}
?>
 <?php
if ($current_file_name=='productview.php'||$current_file_name=='serviceview.php') {
?>
    thead td span{
        color: grey !important;
        font-weight: 600 !important;
    }
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
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
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
@media screen and (max-width: 380px){
  #arrowsalltabs{
    visibility: visible !important;
  }
}
@media screen and (min-device-width: 381px) and (max-device-width: 3000px){
  #arrowsalltabs{
    visibility: hidden !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
                                                        @media screen and (min-device-width: 600.5px) and (max-device-width: 3000px){
                                                        #newproservtable{
                                                            margin-left: 18px !important;
                                                            margin-right: 18px !important;
                                                        }
                                                        }
 #viewpro{
  font-size:20px;
}
#btnalignright{
float:right;
}
#btngopage{
margin-bottom:0rem;
margin-right:10px;
}
#datehis{
color:grey;
}
#chhis{
color:grey;
}
#infoheadsall{
font-size: 17px;;
}
#aligncenterall{
align-items: center;;
}
#insideheadall{
font-size:13px;
}
#flaghead{
width: max-content !important;
border: solid 2px #e9ecef;
height: 32px !important;
}
#flagin{
padding-top: 3.5px;
padding-bottom: 5px;
padding-left: 5px;
padding-right: 5px;
height: 27.5px !important;
}
#taxratecountry{
border:1px solid #fff !important;
background-color: #fff !important;
height: 21px !important;
padding-top: 11px !important;
}
<?php
}
?>

#fullcontainerwidth{
     max-width: 1650px;

}
.card-body{
 font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;

 }
 #productname1{
height:21px;
padding: 0px;
font-size: 16px;

    }
     #ruppesymbol{
color: #495057;
padding: 8px 3.75px;
height:21px;
font-size: 16px;

    }
/*     #quantity1{
height:21px;
text-align: right;
padding: 0px;
font-size: 16px;

    }*/
     #productrate1{
height:21px;
text-align: right;
padding: 0px;
font-size: 16px;

    }
    #purquantity1{
height:21px;
text-align: right;
padding: 0px;
font-size: 16px;

    }
     #purproductrate1{
height:21px;
text-align: right;
padding: 0px;
font-size: 16px;

    }
      #vat1{
height:21px;
padding: 0px;
text-align: left;

     }
       #intusymbol{
cursor: pointer;

      }
        #imgintusymbol{
border-radius: 10px;

       }
        #tdfsize{
font-size:13px;

       }
#firstclsale{
width:10px;

    }
     #secondclsale{
width:75px;

    }
     #thirdclsale{
width:82px;

    }
     #fourthclsale{
width:84px;

    }
     #fifthclsale{
width:72px;

    }
     #sixthclsale{
width:33px;

    }
    .icon-drag{
color:#cccccc;

    }
 .mfsub{
 display: block;

 }
 .modal-content{
  border-radius: 0px;

 }
 .modal-header{
  border-radius:0px !important;

 }
 .modal-title{
  color:#212529;

 }
 #closeicon{
  font-size: 21px;

  font-weight: 600;

 }
 .modal-body{
  padding-bottom: 0px !important;

  margin-bottom: -24.5px !important;

 }
.modal-footer{
     display: block;

     margin-bottom: -14.5px;

}
.mbsub{
     padding-bottom: 0px !important;

     margin-bottom: 0px !important;

}

.customcont-heading{
     font-size: 18px;

}
  #unitsindes{
 margin-bottom: 0px !important;
 margin-top: 9px !important;
 
 }
 #uqcindes{
 padding-left: 0px;
 
 }
 .bi-question-circle{
color: #777777;
width: 14;
height: 14;
cursor: pointer;
margin-bottom: 3px;

}
 #uck{
height:36px;

}
 #defaultunit{
  width: 100%;
  
  }
   .deltophead{
margin-top:0px;

  }
 #delinpbrd{
   border:1px solid lightgrey;
   
   }
#description{
    height: 70px !important;
    
    }
     #firstclsale{
width:10px;

    }
     #secondclsale{
width:75px;

    }
     #thirdclsale{
width:82px;

    }
     #fourthclsale{
width:84px;

    }
     #fifthclsale{
width:72px;

    }
     #sixthclsale{
width:33px;

    }
     .icon-drag{
color:#cccccc;

    }
</style>
<style type="text/css">
<?php
if ($current_file_name=='franchises.php') {
    ?>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 1100px) 
{
  .add{
    position: relative;
    top: 36px; 
  }
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
    height: 32.64px !important;
  }
  
  table td::before {
    color: black !important;
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
<?php
}
?>
<?php
if ($current_file_name=='users.php') {
    ?>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 850px) 
{
  .add{
    position: relative;
    top: 36px; 
  }
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
    height: 32.64px !important;
  }
  
  table td::before {
    color: black !important;
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
<?php
}
?>
<?php
if ($current_file_name=='franchiseadd.php'||$current_file_name=='useradd.php'||$current_file_name=='franchiseedit.php'||$current_file_name=='useredit.php') {
    ?>
   .tree li {
       font-size:13px;
    list-style-type:none;
    margin:0;
    padding:2px 5px 0 5px;
    position:relative
}
.tree li::before, 
.tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:1px solid #ced4da;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:1px solid #ced4da;
    height:20px;
    top:15px;
    width:25px
}
.tree li span {
    display:inline-block;
    padding:3px 3px;
    text-decoration:none;
    cursor:pointer;
}
.tree>ul>li::before,
.tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:15px
}
.tree li span a
{
    text-decoration:none;
}
.tree li span:hover {
   
    }
    .tree li span:hover a{
    color:white;
    }

[aria-expanded="false"] > .expanded,
[aria-expanded="true"] > .collapsed {
  display: none;
}
 
 .myinput::-webkit-input-placeholder {
    font-size: 9.5px;
 }   
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

        background-image: url("./assets/img/spin.gif");
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
<?php
}
?>
<?php
if ($current_file_name=='useradd.php'||$current_file_name=='useredit.php') {
    ?>
.profile-badge{
    border:1px solid #c1c1c1;
    padding:5px;
    position: relative;
}

.profile-pic{
    height:80px;
    /*width:120px;*/
    padding: 10px;
}
.profile-pic img{
   
    border-radius: 50%;
    box-shadow: 0px 0px 5px 0px #c1c1c1;
    cursor: pointer;
    width: 60px;
    height: 60px;
}   
      .notification {color: red; font-size: 85%;}
        /*! 
 *  Multiple select dropdown with filter jQuery plugin.
 *  Copyright (C) 2022  Andrew Wagner  github.com/andreww1011
 *
 *  This library is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU Lesser General Public
 *  License as published by the Free Software Foundation; either
 *  version 2.1 of the License, or (at your option) any later version.
 * 
 *  This library is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *  Lesser General Public License for more details.
 * 
 *  You should have received a copy of the GNU Lesser General Public
 *  License along with this library; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301
 *  USA
 */
:root {
    --fms-badge-text-color: white;
    --fms-badge-color: var(--primary)
}

.filter-multi-select.dropup, .filter-multi-select.dropdown {
    position: relative;
}

.filter-multi-select .dropdown-toggle::after {
    all: unset;
}

.filter-multi-select .dropdown-toggle:empty::after {
    all: unset;
}

.filter-multi-select > .dropdown-toggle::before {
    display: inline-block;
    margin-right: 0.255em;
    vertical-align: middle;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent;
}

.filter-multi-select > .dropdown-toggle:empty::before {
    margin-right: 0.255em;
}

.filter-multi-select > .viewbar {
    white-space: normal;
    font-size: 0.875rem;
    font-weight: 400;
    height: auto;
    cursor: pointer;
}

.filter-multi-select > .viewbar > .selected-items > .item {
    margin: .125rem .25rem .125rem 0;
    padding: 0px 0px 0px .5em;
    display: inline-flex;
    height: 1.875em;
    color: var(--fms-badge-text-color);
    background-color: var(--fms-badge-color);
    border-radius: 1.1em;
    align-items: center;
    vertical-align: baseline;
}

.filter-multi-select > .viewbar > .selected-items > .item > button {
    background-color: transparent;
    color: var(--fms-badge-text-color);
    border: 0;
    font-weight: 900;
    cursor: pointer;
}

.filter-multi-select > .viewbar > .selected-items > .item > button:hover {
    filter: contrast(50%);
}

.filter-multi-select > .viewbar > .selected-items > .item.disabled {
    display: inline-flex;
    padding: 0px .5em 0px .5em;
    filter: grayscale(80%) brightness(150%);
}

.filter-multi-select > .viewbar > .selected-items > .item.disabled > button {
    display: none;
}

.filter-multi-select > .dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0%;
    z-index: 1000;
    display: none;
    float: left;
    max-height: 50vh;
    min-width: 10rem;
    overflow-y: auto;
    padding: 0.5rem 0;
    margin: 0.125rem 0 0;
    font-size: 0.875rem;
    text-align: left;
    list-style: none;
    background-color: #FFFFFF;
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 0.25rem;
}

.filter-multi-select > .dropdown-menu.show {
    display: block;
}

.filter-multi-select > .dropdown-menu > .filter > input {
    font-size: 0.875rem;
}

.filter-multi-select > .dropdown-menu > .filter > button {
    position: absolute;
    border: 0;
    background-color: transparent;
    font-weight: 900;
    color: #ccc;
    right: 2rem;
    top: 1rem;
}

.filter-multi-select > .dropdown-menu > .filter > button:hover {
    color: #aaa;
}

.filter-multi-select .dropdown-item {
    display: block;
    width: 100%;
    padding: 0.25rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #212529;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}

.filter-multi-select .dropdown-item.disabled, .filter-multi-select .dropdown-item:disabled {
    color: #6c757d;
    pointer-events: none;
    background-color: transparent;
}

.filter-multi-select .dropdown-item:hover, .filter-multi-select .dropdown-item:focus  {
    background-color: inherit;
}

.filter-multi-select .dropdown-item.active, .filter-multi-select .dropdown-item:active {
    color: inherit;
}

.filter-multi-select .dropdown-item .custom-control-input {
    position: absolute;
    z-index: -1;
    opacity: 0;
}

.filter-multi-select .dropdown-item .custom-control-label {
    position: relative;
    margin-bottom: 0;
    vertical-align: top;
    display: inline-block;   
}

.filter-multi-select .dropdown-item .custom-control-label::before {
    border-radius: 0.25rem;
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    position: absolute;
    top: 0.15625rem;
    left: -1.5rem;
    display: block;
    width: 1rem;
    height: 1rem;
    pointer-events: none;
    content: "";
    background-color: #FFFFFF;
    border: #adb5bd solid 1px
}

.filter-multi-select .dropdown-item .custom-control-label::after {
    position: absolute;
    top: 0.15625rem;
    left: -1.5rem;
    display: block;
    width: 1rem;
    height: 1rem;
    content: "";
    background: no-repeat 50% / 50% 50%;
}

.filter-multi-select .dropdown-item .custom-checkbox:checked ~ .custom-control-label::before,
.filter-multi-select .dropdown-item .custom-checkbox:indeterminate ~ .custom-control-label::before {
    border-color: var(--fms-badge-color);
    background-color: var(--fms-badge-color);
}

.filter-multi-select .dropdown-item .custom-checkbox:checked:disabled ~ .custom-control-label::before,
.filter-multi-select .dropdown-item .custom-checkbox:indeterminate:disabled ~ .custom-control-label::before {
    border-color: var(--fms-badge-color);
    background-color: var(--fms-badge-color);
    filter: grayscale(80%) brightness(150%);
}

.filter-multi-select .dropdown-item .custom-checkbox:checked ~ .custom-control-label::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23FFFFFF' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
    background-color: green !important;
}

.filter-multi-select .dropdown-item .custom-checkbox:indeterminate ~ .custom-control-label::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 4'%3e%3cpath stroke='%23FFFFFF' d='M0 2h4'/%3e%3c/svg%3e");
}
.placeholder{
    background-color: white !important;
}
.filter-multi-select > .viewbar > .selected-items > .item{
    color: black !important;
}
.filter-multi-select > .viewbar > .selected-items > .item > button{
    color: black !important;
}
.dropdown:not(.dropdown-hover) .dropdown-menu{
    margin-top: -30px !important;
    width: 100% !important;
}
.filter-multi-select .dropdown-item:hover{
    background-color: white !important;
}
<?php
}
?>
<?php
if ($current_file_name=='userview.php') {
    ?>
  .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
  .fast .toggle-group { transition: left 0.1s; -webkit-transition: left 0.1s; }
  .quick .toggle-group { transition: none; -webkit-transition: none; }
  
  .toggle-group .btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    margin-bottom: 0rem;
}
  .toggle-group .btn-default {
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.toggle-on {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 50%;
    margin: 0;
    border: 0;
    border-radius: 0;
}
.toggle-off {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    right: 0;
    margin: 0;
    border: 0;
    border-radius: 0;
}
.toggle-handle {
    position: relative;
    margin: 0 auto;
    padding-top: 0px;
    padding-bottom: 0px;
    height: 100%;
    width: 0px;
    border-width: 0 1px;
}
.toggle-on.btn {
    padding-right: 24px;    
    text-transform:none;
}
.toggle-off.btn {
    padding-left: 24px;
    text-transform:none;
}
 .toggle-group .btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.toggle-group .btn-danger.active
{
    color: #fff;
    background-color: #c9302c;
    border-color: #ac2925;
}
.toggle.btn
{
        margin-bottom: 0rem;
}
 
 .myinput::-webkit-input-placeholder {
    font-size: 9.5px;
 }
table tbody tr:nth-of-type(odd) { 
  
}
/*@media screen and (max-width: 600px) {
    #permissiondashboard{
      margin: 0px;
      padding: 0px;
    }
}*/
@media screen and (max-width: 600px) 
{
  table {
    border: 0;
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
    color: grey !important;
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: 600;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
.table td, .table th {
    white-space: normal;
}
<?php
}
?>
<?php
if ($current_file_name=='franchiseview.php') {
    ?>
    thead td span{
        color: grey !important;
        font-weight: 600 !important;
    }
  .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
  .fast .toggle-group { transition: left 0.1s; -webkit-transition: left 0.1s; }
  .quick .toggle-group { transition: none; -webkit-transition: none; }
  
  .toggle-group .btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    margin-bottom: 0rem;
}
  .toggle-group .btn-default {
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.toggle-on {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 50%;
    margin: 0;
    border: 0;
    border-radius: 0;
}
.toggle-off {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    right: 0;
    margin: 0;
    border: 0;
    border-radius: 0;
}
.toggle-handle {
    position: relative;
    margin: 0 auto;
    padding-top: 0px;
    padding-bottom: 0px;
    height: 100%;
    width: 0px;
    border-width: 0 1px;
}
.toggle-on.btn {
    padding-right: 24px;    
    text-transform:none;
}
.toggle-off.btn {
    padding-left: 24px;
    text-transform:none;
}
 .toggle-group .btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.toggle-group .btn-danger.active
{
    color: #fff;
    background-color: #c9302c;
    border-color: #ac2925;
}
.toggle.btn
{
        margin-bottom: 0rem;
}
 
 .myinput::-webkit-input-placeholder {
    font-size: 9.5px;
 }
    @media screen and (max-width: 600px) 
{
  table {
    border: 0;
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
    color: grey !important;
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: 600;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
.table td, .table th {
    white-space: normal;
}

[aria-expanded="false"] > .expanded,
[aria-expanded="true"] > .collapsed {
  display: none;
}
 
 .myinput::-webkit-input-placeholder {
    font-size: 9.5px;
 }
<?php
}
?>  
</style>
<style type="text/css">
<?php
if ($current_file_name=='preference_franchisee_roles.php'||$current_file_name=='preference_users_roles.php'||$current_file_name=='preference_billing.php') {
    ?>
    thead td{
        color: grey !important;
        font-weight: 600 !important;
    }
        table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
  table {
    border: 0;
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
    color: grey !important;
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: 600;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
.table td, .table th {
    white-space: normal;
}
    </style>
    <style>
   

    [aria-expanded="false"]>.expanded,
    [aria-expanded="true"]>.collapsed {
        display: none;
    }

    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }
    </style>
    <style>
    .accordion-button:not(.collapsed)::after {
        background-image: url();
        margin-left: -20px;
        margin-top: -5px;
    }

    .accordion-button:not(.collapsed) a.customcont-heading {
        border-bottom: 1.5px solid #000000;
        color: #000000;
    }
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
}

.alignright
{
    text-align: right;
}
@media screen and (min-device-width: 260px) and (max-device-width: 575px) { 
    /* STYLES HERE */
    .card .card-body {
    font-family: Inter,"Source Sans Pro",Helvetica,Arial,sans-serif;
    padding: 10px;
    align-items: center !important;
}
}
@media screen and (min-device-width: 366px) and (max-device-width: 575px) { 
.row1
{
    width: auto;
}

}
<?php
}
?>
<?php
if ($current_file_name=='preference_franchisee_roles.php'||$current_file_name=='preference_users_roles.php') {
    ?>
@media screen and (max-width: 384px) { 
        .totedits{
            width: 100% !important;
        }
    }
    @media screen and (max-width: 369px) { 
        .ico{
            margin-top: 0px !important;
        }
        .edbtn{
            margin: auto !important;
        }
        .mobliview
{
    text-align: center;
    width: 100% !important;
    
}
    }
<?php
}
?>
<?php
if ($current_file_name=='preference_billing.php') {
    ?>
@media screen and (min-device-width: 260px) and (max-device-width: 575px) { 
.mobliview
{
    text-align: center;
    
}

.ico{
    margin-top: 0px !important;
}
}
@media screen and (max-width: 703px){
    .incard{
        width: 100% !important;
    }
}
.alignright
{
    text-align: center !important;
}
<?php
}
?>
  <?php
if ($current_file_name=='preference_franchises_roles_label.php'||$current_file_name=='preference_users_roles_label.php'||$current_file_name=='preference_billing_label.php') {
    ?>
    [aria-expanded="false"]>.expanded,
    [aria-expanded="true"]>.collapsed {
        display: none;
    }

    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }
    .accordion-button:not(.collapsed)::after {
        background-image: url();
        margin-left: -20px;
        margin-top: -5px;
    }

    .accordion-button:not(.collapsed) a.customcont-heading {
        border-bottom: 1.5px solid #000000;
        color: #000000;
    }

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
        border-color: rgba( 0, 0, 0, 0.07 );
        background-color: #58c2f8;
    }
    .arlina-button.blue[data-loading] {
        border-color: rgba( 0, 0, 0, 0.07 );
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
        border-color: rgba( 0, 0, 0, 0.07 );
        background-color: #ffa96c;
    }
    .arlina-button.orange[data-loading] {
        border-color: rgba( 0, 0, 0, 0.07 );
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
<?php
}
?>
</style>
<style>
  <?php
if ($current_file_name=='enquiryadd.php'||$current_file_name=='quotationadd.php'||$current_file_name=='estimateadd.php'||$current_file_name=='proformaadd.php'||$current_file_name=='jobadd.php'||$current_file_name=='salesorderadd.php'||$current_file_name=='deliverychallanadd.php'||$current_file_name=='converttoinvoice.php'||$current_file_name=='invoiceadd.php'||$current_file_name=='salesreturnadd.php'||$current_file_name=='creditnoteadd.php'||$current_file_name=='purchaseorderadd.php'||$current_file_name=='purchasereceiveadd.php'||$current_file_name=='billadd.php'||$current_file_name=='purchasereturnadd.php'||$current_file_name=='enquiryedit.php'||$current_file_name=='quotationedit.php'||$current_file_name=='estimateedit.php'||$current_file_name=='proformaedit.php'||$current_file_name=='jobedit.php'||$current_file_name=='salesorderedit.php'||$current_file_name=='deliverychallanedit.php'||$current_file_name=='invoiceedit.php'||$current_file_name=='creditnoteedit.php'||$current_file_name=='salesreturnedit.php'||$current_file_name=='purchaseorderedit.php'||$current_file_name=='purchasereceiveedit.php'||$current_file_name=='billedit.php'||$current_file_name=='debitnoteedit.php'||$current_file_name=='purchasereturnedit.php'||$current_file_name=='debitnoteadd.php') {
    ?>
@media screen and (min-device-width: 576px) and (max-device-width: 3000px) {
  .svgforfrequent{
    padding-left: 6px !important;
  }
}
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable .subtextfoo td:hover{
    color: white !important;
}
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable .subtextfoo{
color: #000000 !important;
}
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable .itemmodulehov{
background-color: #fff !important;
color: #000 !important;
}
.subtextfoo{
    margin-bottom: -6px !important;
    margin-top: -3px !important;
}
@media only screen and (max-width: 300px) {
        .select6-container {
            width: 90px !important;
            margin-top: 3px;
        }
        .select6-dropdown--below
      {
          width: none !important;
      }
}
    .select6 {
        width: 100% !important;
        background-color: #ffffff !important;
    }
input.select2-search__field:focus{
    outline: none !important;
    box-shadow: none !important;
}
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
background-image: url("./assets/img/spin.gif");
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
.bigdrop {
width: 300px !important;
}
@media only screen and (max-width: 600px) {
.bigdrop {
width: 100% !important;
}
}
[aria-labelledby="select2-product1-container"]
{
border:none !important;
}
.foo:hover
{
color:#ffffff;
}
.foo{
    margin-bottom: -6px !important;
    margin-top: -9px !important;
}
#gsttable td,th
{
padding:1px;
text-align: center;
}
#gsttable .form-control-sm
{
 background:none; font-size:12px; padding:1px 2px; height:18px !important; border:none; text-align:right;
}
#gsttable .input-group .input-group-text{
    padding: 0px !important;
    margin-top: -2px !important;
}
#twobillstreet{
padding: 8px !important;
height: 21px !important;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 123px !important;
color: green !important;
}
#twobillcity{
padding: 8px !important;
height: 21px !important;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13px;
color: green !important;
}
#twobillstate{
padding: 8px !important;
height: 21px !important;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
color: green !important;
}
#twobillpincode{
padding: 8px !important;
height: 21px !important;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
color: green !important;
}
#twobillcountry{
padding: 8px !important;
height: 21px !important;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
color: green !important;
}
#twoshipstreet{
padding: 8px !important;
height: 21px !important;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 123px !important;
color: green !important;
}
#twoshipcity{
padding: 8px !important;
height: 21px !important;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13px;
color: green !important;
}
#twoshipstate{
padding: 8px !important;
height: 21px !important;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
color: green !important;
}
#twoshippincode{
padding: 8px !important;
height: 21px !important;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
color: green !important;
}
#twoshipcountry{
padding: 8px !important;
height: 21px !important;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
color: green !important;
}
#twoworkphone{
padding: 8px !important;
height: 21px !important;
font-size: 12px !important;
color: green !important;
}
#twomobilephone{
padding: 8px !important;
height: 21px !important;
font-size: 12px !important;
color: green !important;
}
#twogsttreatment{
padding: 8px !important;
height: 21px !important;
font-size: 12px !important;
color: green !important;
}
#twogstin{
padding: 8px !important;
height: 21px !important;
font-size: 12px !important;
color: green !important;
}
#twopos{
padding: 8px !important;
height: 21px !important;
font-size: 12px !important;
color: green !important;
}
    #firstadd{
        padding: 0px !important;
        margin: -6px 0px -3px 0px !important;
    }
    #secadd{
        padding: 0px !important;
        margin: -6px 0px -3px 0px !important;
    }
    #gstfirstline{
        padding: 0px !important;
        margin: -6px 0px 0px 0px !important;
        font-size: 12px !important;
    }
    #gstsecondline{
        padding: 0px !important;
        margin: -3px 0px -3px 0px !important;
        font-size: 11px !important;
    }
    #workphoneline{
        padding: 0px !important;
        margin: -6px 0px -3px 0px !important;
        font-size: 12px !important;
    }
    #mobilephoneline{
        padding: 0px !important;
        margin: -6px 0px -3px 0px !important;
        font-size: 12px !important;
    }
    #dlno20line{
        padding: 0px !important;
        margin: -6px 0px -3px 0px !important;
        font-size: 12px !important;
    }
    #dlno21line{
        padding: 0px !important;
        margin: -6px 0px -3px 0px !important;
        font-size: 12px !important;
    }
.tfunit{
display: none !important;
}
.modal-content{
border-radius: 0px;
}
.modal-header{
border-radius:0px !important;
}
.modal-title{
color:#212529;
}
#custcloseicon{
font-size: 21px;
font-weight: 600;
}
.modal-body{
padding-bottom: 0px !important;
margin-bottom: -24.5px !important;
}
.modal-footer{
display: block;
margin-bottom: -14.5px;
}
.mbsub{
padding-bottom: 0px !important;
margin-bottom: 0px !important;
}
.mfsub{
display: block;
}
.customcont-heading{
font-size: 18px;
}
.custcustomerid{
border-bottom: 1px dashed grey;
}
.custhighfor{
height:42px;
}
.custprimarycontact{
border-bottom: 1px dashed grey;
}
#custdrpsalute{
position:relative;
top: -23px;
left: 81%;
color: #ced4da;
}
.custcompanyname{
border-bottom: 1px dashed grey;
}
.custdisplayname{
border-bottom: 1px dashed grey;
}
.custvis{
color: #ee0000;
}
.bi-question-circle{
color: #777777;
width: 14;
height: 14;
cursor: pointer;
}
.custtaxpre{
color: #ee0000;
}
#custgstblock{
display: none;
}
#custbillstreet{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 145px !important;
}
#custbillcity{
padding: 5px 8px;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
}
#custbillstate{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
}
#custbillpincode{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
}
#custbillcountry{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
}
#custshipstreet{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 145px !important;
}
#custshipcity{
padding: 5px 8px;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
}
#custshipstate{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
}
#custshippincode{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
}
#custshipcountry{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
}
@media screen and (max-device-width: 575px){
        /*.sameasbilling{
            position: relative;
            top: 0px !important;
            left: 116px !important;
            margin-bottom: -39px !important;
        }*/
        .custhighfor{
            height: 123px !important;
        }
        .custvendorid{
            margin-bottom: 6px !important;
        }
        .custprimarycontact{
            margin-bottom: 6px !important;
        }
        .custcompanyname{
            margin-bottom: 6px !important;
        }
        .custdisplayname{
            margin-bottom: 6px !important;
        }
    }
    .custprimarycontact{
border-bottom: 1px dashed grey;
}
#custdrpsalute{
position:relative;
top: -23px;
left: 81%;
color: #ced4da;
}
.myinput::-webkit-input-placeholder {
font-size: 9.5px;
}
.select2 {
width: 100% !important;
background-color: #ffffff !important;
}
.modal-content {
border-radius: 0px;
}
.modal-header {
background: #F1F2F6;
border-radius: 0;
}
.modal-title {
font-weight: normal;
}
/*.select2-container--default .select2-selection--single {
background-color: #ffffff !important;
color: #495057;
border: 1px solid #eee !important;
height: 25px;
border-radius: 2px;
}*/
.select2-container--default .select2-selection--single{
    border: 1px solid #e1dbdb !important;
}
.select4-container--default .select4-selection--single{
    height: 25px !important;
}
.select4-selection--single .select4-selection__rendered{
    line-height: 22px !important;
}
.select2-container .select2-selection--single{
    height: 25px !important;
}
.select2-selection--single .select2-selection__rendered{
line-height: 22px !important;
}
.btn_upload {
cursor: pointer;
display: inline-block;
overflow: hidden;
position: relative;
color: #fff;
background-color: #fff;
border: none;
}
.btn_upload:hover,
.btn_upload:focus {
background-color: #fff;
}
.yes {
display: flex;
align-items: flex-start;
margin-top: 10px !important;
}
.btn_upload input {
cursor: pointer;
height: 100%;
position: absolute;
filter: alpha(opacity=1);
-moz-opacity: 0;
opacity: 0;
}
.it {
height: 100px;
margin-left: 10px;
}
.accordion-button:not(.collapsed)::after
{
background-image: url("");
}
/*.mb-3 {
margin-bottom: -5px !important;
}*/
#removeImage1,
#removeImage2,
#removeImage3,
#removeImage4,
#removeImage5 {
color: #6c757d;
}
#removeImage1:hover {
color: black;
}
#removeImage2:hover {
color: black;
}
#removeImage3:hover {
color: black;
}
#removeImage4:hover {
color: black;
}
#removeImage5:hover {
color: black;
}
.rmv {
cursor: pointer;
color: #fff;
border-radius: 30px;
border: 1px solid #fff;
display: inline-block;
background: rgba(255, 0, 0, 1);
margin: -5px -10px;
}
.rmv:hover {
background: rgba(255, 0, 0, 0.5);
}
.item-actions-container .item-actions {
position: absolute;
right: -50px;
top: -20px;
}
.icon-cancel-circled {
color: #fab2b1;
}
svg.icon.icon-sm {
height: 14px;
width: 14px;
}
.tdmove:hover {
cursor: move;
}
.imagePreview {
width: 200px;
height: 140px;
background-position: center center;
background-color: #fff;
background-size: cover;
background-repeat: no-repeat;
text-align: center;
}
.btn-custom-grey:hover i {
color: #ffffff !important;
}
.btn-custom-grey:active, .btn-custom-grey:focus, .btn-custom-grey:hover {
background-color: #f8f8f8;
border-color: #c6c6c6;
}
/*.btn-custom:hover {
background-color: #ed0707 !important;
border-color: #c6c6c6;
}*/
.selectdesign {
width: 6px;
padding-right: 0px;
padding-left: 10px;
padding-bottom: 1px;
border-top-width: 2px;
background-color: #f5f5f5;
}
.dash {
border: 0 none;
border-top: 2px dashed #322f32;
background: none;
height: 0;
margin-top: 0px;
width: 60px;
}
thead tr th {
color: black !important;
text-align: left !important;
}
.basicaddon1 {
padding-right: 8px;
padding-left: 8px;
padding-top: 5px;
padding-bottom: 5px;
background-color: #e9ecef;
border-bottom: 2px solid #e9ecef;
}
.form-control:disabled,
.form-control[readonly] {
background-color: #ffffff;
opacity: 1;
}
#footer {
background-color: #ffffff;
width: 84%;
position: fixed;
bottom: 0px;
height: 50px;
margin-bottom: 0px;
Padding-top: 0px;
margin-left: -15px;
margin-right: -15px;
border: 1px solid #eee;
-webkit-box-shadow: 0px -4px 3px #e9ecef;
-moz-box-shadow: 0px -4px 3px #e9ecef;
box-shadow: 0 -4px 5px -3px rgb(0 0 0 / 10%);
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
padding-right: 5px;
}
input[type="number"]::placeholder {
/* Firefox, Chrome, Opera */
text-align: left !important;
}
#subtotal {
text-align: right;
}
input[type=number] {
text-align: left !important;
}
.input-group-text {
border: none;
border-radius: 0px;
}
.form-control {
padding: 1px 8px;
height: 25px;
}
.form-control-sm {
padding: 1px 8px;
}
@media screen and (max-width: 575px) {
#mobtotaliq{
    /*width: max-content !important;*/
    margin: 9px 0px !important;
    text-align: left !important;
}
#mobtotaliqinp{
    margin: 9px 0px !important;
    text-align: left !important;
}
    }
    @media screen and (max-width: 767px) {
#mobtotaliq{
    text-align: left !important;
}
#mobtotaliqinp{
    text-align: left !important;
}
}
table tbody tr:nth-of-type(odd) {}
@media screen and (min-device-width: 601px) and (max-device-width: 3000px) {
    #mobadddesign{
        margin-top: -10px !important;
    }
}
@media screen and (min-device-width: 300px) and (max-device-width: 768px) {
.mobview {
padding-left: 30px;
}
}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
.imagePreview {
width: 100%;
}
}
@media only screen and (max-width: 300px) {
.select2-container {
width: 90px !important;
margin-top: 3px;
}
.select2-dropdown--below
{
width: none !important;
}
#fulla {
padding-left: 12px !important;
}
}
.table-hover>tbody>tr:hover {
--bs-table-accent-bg: #FFFFFF;
color: var(--bs-table-hover-color);
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#city {
margin-top: 15px
}
}
.customcont-heading{
padding-bottom: 5px;font-size: 15px;
}
hr{
margin-bottom:16px;
}
.table> :not(caption)>*>* {
padding-top: 4px;
padding-bottom: 2px;
}
.addan:hover {
background-color: #b7bbc0 !important;
}
.dropdown-toggle{
content: "\f107";
}
.form-group {
margin-bottom: 0.5rem;
}
.bordernoneinput:focus{
outline: none;
border-color: inherit;
-webkit-box-shadow: none;
box-shadow: none;
}
.bordernoneinput{
border: none;
}
.select2-dropdown {
  z-index: 9001;
}
.protables tbody tr:nth-of-type(odd) {}
.protables {
border: 0;
}
.protables caption {
font-size: 1.3em;
}
.protables thead {
border: none;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}
.protables tr {
border-bottom: 1px solid #ddd;
display: block;
margin-bottom: 1em;
}
.protables thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
.protables td {
color: #212529 !important;
border-bottom: 1px solid #ddd;
display: block;
font-size: .8em;
text-align: right;
}
.protables td::before {
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: bold;
text-transform: uppercase;
}
    #loadimgins{
        width: 100% !important;
    }
.protables td:last-child {
border-bottom: 0;
}
</style>
<style>
.country:focus{
outline: none !important;
border: none !important;
box-shadow: none !important;
}
.mfsub{
display: block;
}
.modal-content{
border-radius: 0px;
}
.modal-header{
border-radius:0px !important;
}
.modal-title{
color:#212529;
}
#procloseicon{
font-size: 21px;
font-weight: 600;
}
.modal-body{
padding-bottom: 0px !important;
margin-bottom: -24.5px !important;
}
.modal-footer{
display: block;
margin-bottom: -14.5px;
}
.mbsub{
padding-bottom: 0px !important;
margin-bottom: 0px !important;
}
.customcont-heading{
font-size: 18px;
}
#prounitsindes{
margin-bottom: 0px !important;
margin-top: 9px !important;
}
#prouqcindes{
padding-left: 0px;
}
.bi-question-circle{
color: #777777;
width: 14;
height: 14;
cursor: pointer;
margin-bottom: 3px;
}
#prouck{
height:36px;
}
#prodefaultunit{
width: 100%;
}
.deltophead{
margin-top:0px;
}
#prodelinpbrd{
border:1px solid lightgrey;
}
#prodescription{
height: 70px !important;
}
#profirstclsale{
width:10px;
}
#prosecondclsale{
width:75px;
}
#prothirdclsale{
width:82px;
}
#profourthclsale{
width:84px;
}
#profifthclsale{
width:72px;
}
#prosixthclsale{
width:33px;
}
.icon-drag{
color:#cccccc;
}
/*#proproductname1{
height:21px;
padding: 0px;
font-size: 16px !important;
}
#proruppesymbol{
color: #495057;
padding: 8px 3.75px;
height:21px;
font-size: 16px !important;
}
#proquantity1{
height:21px;
width: 24px;
text-align: right;
padding: 0px;
font-size: 16px !important;
}
#proproductrate1{
height:21px;
width: 24px;
text-align: right;
padding: 0px;
font-size: 16px !important;
}
#provat1{
height:21px;
padding: 0px;
text-align: left;
font-size: 16px !important;
}*/
#prointusymbol{
cursor: pointer;
}
#proimgintusymbol{
border-radius: 10px;
}
#protdfsize{
font-size:13px;
}
#protaxprefer{
height:48px !important;
}
#proflagicon{
width: max-content !important;
border: solid 2px #e9ecef;
height: 32px !important;
}
#proflagimg{
padding-top: 3.5px;
padding-bottom: 5px;
padding-left: 5px;
padding-right: 5px;
}
#protaxratecountry{
border:1px solid #fff !important;
background-color: #fff !important;
height: 21px !important;
padding-top: 11px !important;
}
#prointrahead{
height:48px !important;
}
@media screen and (max-width: 575px){
     #prointrahead{
 margin-top: 18px !important;
        }
}
@media screen and (min-device-width: 992px) and (max-device-width: 3000px){
     #quantity1{
        height: 25px !important;
        font-size: inherit !important;
    }
     #productrate1{
        height: 25px !important;
        font-size: inherit !important;
    }
}
@media screen and (max-width: 991px){
     #quantity1{
        width: 146px !important;
        height: 18.78px !important;
        font-size: inherit !important;
    }
     #productrate1{
        width: 146px !important;
        height: 18.78px !important;
        font-size: inherit !important;
    }
}
<?php
}
?>
  <?php
if ($current_file_name=='enquiryadd.php'||$current_file_name=='quotationadd.php'||$current_file_name=='estimateadd.php'||$current_file_name=='proformaadd.php'||$current_file_name=='jobadd.php'||$current_file_name=='salesorderadd.php'||$current_file_name=='deliverychallanadd.php'||$current_file_name=='converttoinvoice.php'||$current_file_name=='invoiceadd.php'||$current_file_name=='purchaseorderadd.php'||$current_file_name=='purchasereceiveadd.php'||$current_file_name=='billadd.php'||$current_file_name=='purchasereturnadd.php'||$current_file_name=='enquiryedit.php'||$current_file_name=='quotationedit.php'||$current_file_name=='estimateedit.php'||$current_file_name=='proformaedit.php'||$current_file_name=='jobedit.php'||$current_file_name=='salesorderedit.php'||$current_file_name=='deliverychallanedit.php'||$current_file_name=='invoiceedit.php'||$current_file_name=='purchaseorderedit.php'||$current_file_name=='purchasereceiveedit.php'||$current_file_name=='billedit.php'||$current_file_name=='debitnoteedit.php'||$current_file_name=='purchasereturnedit.php'||$current_file_name=='salesreturnadd.php'||$current_file_name=='creditnoteadd.php'||$current_file_name=='creditnoteedit.php'||$current_file_name=='salesreturnedit.php'||$current_file_name=='debitnoteadd.php') {
    ?>
    @media screen and (min-device-width: 992px) and (max-device-width: 3000px) {
    #purchasetable{
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable thead:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable tbody:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable th:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable td:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    }
    #purchasetable tr:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable input{
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable textarea{
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable select{
      border: 1px solid #e1dbdb !important;
    }
    .select2-container--default .subtextfoo td  tr  tbody{
      border: none !important;
    }
    .notforfinaloutputsave td{
        width: 60% !important;
    }
@media screen and (max-width: 991px){
    #purchasetable span.select2.select2-container.select2-container--default{
        width: 146px !important;
    }
    #selecttheproduct{
        width: 146px !important;
    }
}
<?php
}
?>
  <?php
if ($current_file_name=='enquiryadd.php'||$current_file_name=='quotationadd.php'||$current_file_name=='estimateadd.php'||$current_file_name=='proformaadd.php'||$current_file_name=='jobadd.php'||$current_file_name=='salesorderadd.php'||$current_file_name=='deliverychallanadd.php'||$current_file_name=='converttoinvoice.php'||$current_file_name=='invoiceadd.php'||$current_file_name=='purchaseorderadd.php'||$current_file_name=='purchasereceiveadd.php'||$current_file_name=='billadd.php'||$current_file_name=='purchasereturnadd.php'||$current_file_name=='enquiryedit.php'||$current_file_name=='quotationedit.php'||$current_file_name=='estimateedit.php'||$current_file_name=='proformaedit.php'||$current_file_name=='jobedit.php'||$current_file_name=='salesorderedit.php'||$current_file_name=='deliverychallanedit.php'||$current_file_name=='invoiceedit.php'||$current_file_name=='purchaseorderedit.php'||$current_file_name=='purchasereceiveedit.php'||$current_file_name=='billedit.php'||$current_file_name=='debitnoteedit.php'||$current_file_name=='purchasereturnedit.php'||$current_file_name=='debitnoteadd.php') {
    ?>
#grandwords{
display: block !important;
overflow: hidden !important;
height: 78px !important;
}
#billstreet{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 145px !important;
}
#billcity{
padding: 5px 8px;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
}
#billstate{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
}
#billpincode{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
}
#billcountry{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
}
#shipstreet{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 145px !important;
}
#shipcity{
padding: 5px 8px;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
}
#shipstate{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
}
#shippincode{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
}
#shipcountry{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
}
<?php
}
?>
  <?php
if ($current_file_name=='salesreturnadd.php'||$current_file_name=='creditnoteadd.php'||$current_file_name=='creditnoteedit.php'||$current_file_name=='salesreturnedit.php') {
    ?>
#salesreturnstreet{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 145px !important;
}
#salesreturncity{
padding: 5px 8px;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
}
#salesreturnstate{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
}
#salesreturnpincode{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
}
#salesreturncountry{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
}
#shipstreet{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 145px !important;
}
#shipcity{
padding: 5px 8px;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
}
#shipstate{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
}
#shippincode{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
}
#shipcountry{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
}
<?php
}
?>
  <?php
if ($current_file_name=='purchaseorderadd.php'||$current_file_name=='purchasereceiveadd.php'||$current_file_name=='billadd.php'||$current_file_name=='purchasereturnadd.php'||$current_file_name=='purchaseorderedit.php'||$current_file_name=='purchasereceiveedit.php'||$current_file_name=='billedit.php'||$current_file_name=='debitnoteedit.php'||$current_file_name=='purchasereturnedit.php'||$current_file_name=='debitnoteadd.php') {
    ?>@media screen and (max-width: 991px){
.productselectwidth{
width: 146px !important;
height: 18.78px !important;
}
}
    @media screen and (min-device-width: 992px) and (max-device-width: 3000px) {
/*select*/
.productselectadd{
float:right !important;
width:78% !important;
}
/*select*/
        #vendorinfofirst{
            padding-right:0px !important;
        }
        #vendorinfosecond{
            border-bottom: 1px solid #eee !important;
        }
        /*duedatealign*/
        #gsttable input{
            width: 86% !important;
            float: right !important;
        }
#totalvatamount1{
    float:right !important;
    width:88% !important;
}
#productrate1{
    float:right !important;
    width:78% !important;
}
#proquantity1{
        float: right !important;
        width: 78% !important;
    }
#proproductrate1{
        float: right !important;
        width: 78% !important;
    }
#purproquantity1{
        float: right !important;
        width: 78% !important;
    }
#purproproductrate1{
        float: right !important;
        width: 78% !important;
    }
        .productnetvalue1{
        float: right !important;
        width: 78% !important;
        }
        .taxvalue1{
        float: right !important;
        width: 78% !important;
        }
    .productvalue1{
        float: right !important;
        width: 78% !important;
    }
        /*duedatealign*/
        #modulegreydesign{
            padding: 6px 6px 0px 1px !important;
        }
        /*duedatealign*/
        .duedateselect{
            padding-right: 1.5px !important;
        }
        .duedatepicker{
            padding-left: 1.5px !important;
        }
    }
    #tgstamount{
        font-weight: 600 !important;
    }
@media screen and (max-width: 991px) {
    #vendorinfotoggler:after{
        margin-top: -30px !important;
    }
    #vendorinfosecond{
        padding-left: 22px !important;
    }
        /*duedatedesign*/
        #modulegreydesign{
            padding: 0px 6px !important;
        }
    .duedateselect{
            padding-bottom: 13px !important;
        }
        #nextcontentdesignforweb{
            position: absolute;
            margin-top: 30px !important;
            margin-bottom: 18px !important;
            margin-left: -4.5px !important;
        }
        #grandbottom{
            margin-top: 256px !important;
        }
.bigdrop{
        min-width: 149px !important;
        max-width: 150px !important;
    }
    #selecttheproduct{
        width: 150px !important;
    }
    #mobadddesign{
        margin-top: -24px !important;
        margin-left: 0px !important;
    }
    #tgstamount{
        border-bottom: 0px solid #999 !important;
        padding-top: 4px !important;
        text-align: left !important;
        float: left !important;
        border-right: none !important;
        font-weight: 600 !important;
    }
    #tgstinp{
        text-align: right !important;
    }
    /*#ruppeitemtable{
        display: none !important;
    }
    #ruppeitemtablemob{
        display: block !important;
    }*/
table:not(.notforfinaloutputsave) {
border: 0;
}
table:not(.notforfinaloutputsave) caption {
font-size: 1.3em;
}
table:not(.notforfinaloutputsave) thead {
border: none;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}
table:not(.notforfinaloutputsave) tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
display: block;
margin-bottom: 1em;
}
table:not(.notforfinaloutputsave) thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
table:not(.notforfinaloutputsave) td {
border-bottom: 0px solid #ddd !important;
display: block;
font-size: .8em;
text-align: right;
}
table:not(.notforfinaloutputsave) td input{
    border: 1px solid #eee !important;
}
table:not(.notforfinaloutputsave) td input:focus{
    border: 1px solid #3f94eb !important;
    outline: none !important;
    box-shadow: none !important;
    border-radius: 0px;
}
table:not(.notforfinaloutputsave) td::before {
    color: grey !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 92.3px !important;
text-align: left !important;
}
#frequentproTable td::before {
    color: grey !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 60% !important;
text-align: left !important;
}
#purchasetable td::before {
    color: black !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 92.3px !important;
text-align: left !important;
}
#gsttable td::before {
    color: black !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 92.3px !important;
text-align: left !important;
}
    #loadimgins{
        width: 100% !important;
    }
table:not(.notforfinaloutputsave) td:last-child {
border-bottom: 0;
}
}
.table> :not(caption)>*>* {
background-color: #ffffff;
box-shadow: none;
}
.table> :not(:last-child)> :last-child>* {
border-bottom-color: #e9ecef;
font-size: 12px !important;
}
.input-group .form-control:not(:first-child) {
border-left: 0;
padding-left: 5px;
}
a .customcont-heading1 {
margin-left: 30px;
}
.form-control-bn:focus {
border: none !important;
box-shadow: none;
}
.input-group .form-control-bn:focus {
border: none !important;
box-shadow: none;
}
table thead th {
height: 10px;
vertical-align: top;
}
<?php
}
?>
  <?php
if ($current_file_name=='enquiryadd.php'||$current_file_name=='quotationadd.php'||$current_file_name=='estimateadd.php'||$current_file_name=='proformaadd.php'||$current_file_name=='jobadd.php'||$current_file_name=='salesorderadd.php'||$current_file_name=='deliverychallanadd.php'||$current_file_name=='converttoinvoice.php'||$current_file_name=='invoiceadd.php'||$current_file_name=='salesreturnadd.php'||$current_file_name=='creditnoteadd.php'||$current_file_name=='enquiryedit.php'||$current_file_name=='quotationedit.php'||$current_file_name=='estimateedit.php'||$current_file_name=='proformaedit.php'||$current_file_name=='jobedit.php'||$current_file_name=='salesorderedit.php'||$current_file_name=='deliverychallanedit.php'||$current_file_name=='invoiceedit.php'||$current_file_name=='creditnoteedit.php'||$current_file_name=='salesreturnedit.php') {
    ?>
@media screen and (max-width: 991px){
.productselectwidth{
width: 146px !important;
height: 18.78px !important;
}
}
    @media screen and (min-device-width: 992px) and (max-device-width: 3000px) {
/*select*/
.productselectadd{
float:right !important;
width:78% !important;
}
/*select*/

        /*duedatealign*/
        #gsttable input{
            width: 86% !important;
            float: right !important;
        }
#totalvatamount1{
    float:right !important;
    width:88% !important;
}
#productrate1{
    float:right !important;
    width:78% !important;
}
#proquantity1{
        float: right !important;
        width: 78% !important;
    }
#proproductrate1{
        float: right !important;
        width: 78% !important;
    }
#purproquantity1{
        float: right !important;
        width: 78% !important;
    }
#purproproductrate1{
        float: right !important;
        width: 78% !important;
    }
        .productnetvalue1{
        float: right !important;
        width: 78% !important;
        }
        .taxvalue1{
        float: right !important;
        width: 78% !important;
        }
    .productvalue1{
        float: right !important;
        width: 78% !important;
    }
        /*duedatealign*/
        #customerinfofirst{
            padding-right:0px !important;
        }
        #customerinfosecond{
            border-bottom: 1px solid #eee !important;
        }
        /*duedatealign*/
        #modulegreydesign{
            padding: 6px 6px 0px 1px !important;
        }
        /*duedatealign*/
        .duedateselect{
            padding-right: 1.5px !important;
        }
        .duedatepicker{
            padding-left: 1.5px !important;
        }
    }
    #tgstamount{
        font-weight: 600 !important;
    }
@media screen and (max-width: 991px) {
        #nextcontentdesignforweb{
            position: absolute;
            margin-top: 30px !important;
            margin-bottom: 18px !important;
            margin-left: -4.5px !important;
        }
        #grandbottom{
            margin-top: 256px !important;
        }
        .duedateselect{
            padding-bottom: 13px !important;
        }
        #modulegreydesign{
            padding: 0px 6px !important;
        }
    #mphonemob{
        margin-top: 0px !important;
    }
    #customerinfotoggler:after{
        margin-top: -30px !important;
    }
    #customerinfosecond{
        padding-left: 22px !important;
    }
    .bigdrop{
        min-width: 149px !important;
        max-width: 150px !important;
    }
    #selecttheproduct{
        width: 150px !important;
    }
    #mobadddesign{
        margin-top: -24px !important;
        margin-left: 0px !important;
    }
    #tgstamount{
        border-bottom: 0px solid #999 !important;
        padding-top: 4px !important;
        text-align: left !important;
        float: left !important;
        border-right: none !important;
        font-weight: 600 !important;
    }
    #tgstinp{
        text-align: right !important;
    }
   /* #ruppeitemtable{
        display: none !important;
    }
    #ruppeitemtablemob{
        display: block !important;
    }*/
table:not(.notforfinaloutputsave) {
border: 0;
}
table:not(.notforfinaloutputsave) caption {
font-size: 1.3em;
}
table:not(.notforfinaloutputsave) thead {
border: none;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}
table:not(.notforfinaloutputsave) tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
display: block;
margin-bottom: 1em;
}
table:not(.notforfinaloutputsave) thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
table:not(.notforfinaloutputsave) td {
border-bottom: 0px solid #ddd !important;
display: block;
font-size: .8em;
text-align: right;
}
table:not(.notforfinaloutputsave) td input{
    border: 1px solid #eee !important;
}
table:not(.notforfinaloutputsave) td input:focus{
    border: 1px solid #3f94eb !important;
    outline: none !important;
    box-shadow: none !important;
    border-radius: 0px;
}
table:not(.notforfinaloutputsave) td::before {
    color: grey !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 92.3px !important;
text-align: left !important;
}
#frequentproTable td::before {
    color: grey !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 60% !important;
text-align: left !important;
}
#purchasetable td::before {
    color: black !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 92.3px !important;
text-align: left !important;
}
#promargintable td::before {
    color: grey !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 123.3px !important;
text-align: left !important;
}
#gsttable td::before {
    color: black !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 92.3px !important;
text-align: left !important;
}
    #loadimgins{
        width: 100% !important;
    }
table:not(.notforfinaloutputsave) td:last-child {
border-bottom: 0;
}
}
.table> :not(caption)>*>* {
background-color: #ffffff;
box-shadow: none;
}
.table> :not(:last-child)> :last-child>* {
border-bottom-color: #e9ecef;
font-size: 12px !important;
}
.input-group .form-control:not(:first-child) {
border-left: 0;
padding-left: 5px;
}
a .customcont-heading1 {
margin-left: 30px;
}
.form-control-bn:focus {
border: none !important;
box-shadow: none;
}
.input-group .form-control-bn:focus {
border: none !important;
box-shadow: none;
}
table thead th {
height: 10px;
vertical-align: top;
}
<?php
}
?>
</style>
<style>
    @media screen and (min-device-width: 100px) and (max-device-width: 991px) {
    .addandmenuonlyforimports{
        margin-bottom: 0px !important;
    }
}
  <?php
if ($current_file_name=='salesreturns.php'||$current_file_name=='creditnotes.php'||$current_file_name=='purchasereturns.php'||$current_file_name=='debitnotes.php') {
?>
@media screen and (min-device-width: 100px) and (max-device-width: 991px) {
.add{
margin-top: -39px !important;
}
.addmenu{
margin-top: 20px !important;
}
}
<?php
}
?>
<?php
if ($current_file_name=='salesorders.php') {
?>
@media screen and (min-device-width: 100px) and (max-device-width: 991px) {
.addandmenuonlyforimports{
        margin-bottom: -100px !important;
        margin-top: 39px;
}
}
<?php
}
if (($current_file_name=='salespayments.php')||($current_file_name=='purchasepayments.php')||($current_file_name=='customerrefunds.php')||($current_file_name=='vendorrefunds.php')) {
?>
@media screen and (min-device-width: 100px) and (max-device-width: 991px) {
.addandmenuonlyforimportspayments{
        margin-top: -60px !important;
        margin-bottom: 39px;
}
}
<?php
}
if ($current_file_name=='enquirys.php'||$current_file_name=='quotations.php'||$current_file_name=='estimates.php'||$current_file_name=='proformas.php'||$current_file_name=='jobs.php'||$current_file_name=='salesorders.php'||$current_file_name=='deliverychallans.php'||$current_file_name=='invoices.php'||$current_file_name=='salesreturns.php'||$current_file_name=='creditnotes.php'||$current_file_name=='purchaseorders.php'||$current_file_name=='purchasereceives.php'||$current_file_name=='bills.php'||$current_file_name=='purchasereturns.php'||$current_file_name=='debitnotes.php') {
    ?>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (min-device-width: 100px) and (max-device-width: 991px) {
    .add{
        position: relative;
        left: 0px; 
        top: 45px;
        margin-bottom: 30px !important;
}
.addmenu{
        position: relative;
        left: 0px; 
        top: 39px;
}
}
@media screen and (min-device-width: 100px) and (max-device-width: 312px) {
    .add{
        position: relative;
        left: -54px !important;
        top: 36px;
}
.addmenu{
    position: relative;
    left: -57px !important;
        top: 30px;
}
}
@media screen and (max-width: 870px) 
{
  table {
    border: 0;
    margin-top: 16px;
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
/*    height: 32.64px !important;*/
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  table td::before {
/*    color: grey !important;*/
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
<?php
}
?>
</style>
<style>
  <?php
if ($current_file_name=='enquiryview.php'||$current_file_name=='quotationview.php'||$current_file_name=='estimateview.php'||$current_file_name=='proformaview.php'||$current_file_name=='jobview.php'||$current_file_name=='salesorderview.php'||$current_file_name=='deliverychallanview.php'||$current_file_name=='invoiceview.php'||$current_file_name=='salesreturnview.php'||$current_file_name=='creditnoteview.php'||$current_file_name=='purchaseorderview.php'||$current_file_name=='purchasereceiveview.php'||$current_file_name=='billview.php'||$current_file_name=='purchasereturnview.php'||$current_file_name=='debitnoteview.php') {
    ?>
    #tgstamount{
        font-weight: 700 !important;
    }
        @media only screen and (max-width: 991px) {
#gsttable td, th{
    border-top:1px solid #999 !important;
    border-right:1px solid #999 !important;
    border-left:1px solid #999 !important;
}
#gsttable tr{
    border:none !important;
}
}
    #gsttable input{
            width: 86% !important;
            float: right !important;
            border: none !important;
        }
@media screen and (max-width: 600px) 
{
  #journaltables table {
    border: 0;
  }

  #journaltables table caption {
    font-size: 1.3em;
  }
  
  #journaltables table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  #journaltables table tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    display: block;
    margin-bottom: 1em;
  }
  
  
  #journaltables table td {
    border-width: 0px 2px 0px 2px !important;
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  #journaltables table td::before {
    color: grey !important;
    /*
    * aria-label has no advantage, it won't be read inside a #journaltables table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: 600;
    text-transform: uppercase;
  }
  #journaltables table td:last-child {
    border-bottom: 0;
  }
  #histables table {
    border: 0;
  }

  #histables table caption {
    font-size: 1.3em;
  }
  
  #histables table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  #histables table tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    display: block;
    margin-bottom: 1em;
  }
  
  
  #histables table td {
/*    border-bottom: 1px solid #ddd;*/
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  #histables table td::before {
    color: grey !important;
    /*
    * aria-label has no advantage, it won't be read inside a #histables table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: 600;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  #histables table td:last-child {
    border-bottom: 0;
  }
}
.#journaltables table td, .#journaltables table th {
    white-space: normal;
}
.#histables table td, .#histables table th {
    white-space: normal;
}
    table td{
        white-space: nowrap !important;
    }
.myinput::-webkit-input-placeholder {
font-size: 9.5px;
}
.select2 {
width: 100% !important;
background-color: #ffffff !important;
}
.modal-content {
border-radius: 0px;
}
.modal-header {
background: #F1F2F6;
border-radius: 0;
}
.modal-title {
font-weight: normal;
}
.select2-container--default .select2-selection--single {
background-color: #ffffff !important;
color: #495057;
border: 1px solid #ced4da;
height: 25px;
border-radius: 2px;
}
.btn_upload {
cursor: pointer;
display: inline-block;
overflow: hidden;
position: relative;
color: #fff;
background-color: #fff;
border: none;
}
.btn_upload:hover,
.btn_upload:focus {
background-color: #fff;
}
.yes {
display: flex;
align-items: flex-start;
margin-top: 10px !important;
}
.btn_upload input {
cursor: pointer;
height: 100%;
position: absolute;
filter: alpha(opacity=1);
-moz-opacity: 0;
opacity: 0;
}
.it {
height: 100px;
margin-left: 10px;
}
.accordion-button:not(.collapsed)::after
{
background-image: url("");
}
.mb-3 {
margin-bottom: -5px !important;
}
#removeImage1,
#removeImage2,
#removeImage3,
#removeImage4,
#removeImage5 {
color: #6c757d;
}
#removeImage1:hover {
color: black;
}
#removeImage2:hover {
color: black;
}
#removeImage3:hover {
color: black;
}
#removeImage4:hover {
color: black;
}
#removeImage5:hover {
color: black;
}
.rmv {
cursor: pointer;
color: #fff;
border-radius: 30px;
border: 1px solid #fff;
display: inline-block;
background: rgba(255, 0, 0, 1);
margin: -5px -10px;
}
.rmv:hover {
background: rgba(255, 0, 0, 0.5);
}
.item-actions-container .item-actions {
position: absolute;
right: -50px;
top: -20px;
}
.icon-cancel-circled {
color: #fab2b1;
}
svg.icon.icon-sm {
height: 14px;
width: 14px;
}
td:hover {
cursor: move;
}
.imagePreview {
width: 200px;
height: 140px;
background-position: center center;
background-color: #fff;
background-size: cover;
background-repeat: no-repeat;
text-align: center;
}
.btn-custom-grey:hover i {
color: #ffffff !important;
}
.btn-custom-grey:active, .btn-custom-grey:focus, .btn-custom-grey:hover {
background-color: #f8f8f8;
border-color: #c6c6c6;
}
/*.btn-custom:hover {
background-color: #ed0707 !important;
border-color: #c6c6c6;
}*/
.selectdesign {
width: 6px;
padding-right: 0px;
padding-left: 10px;
padding-bottom: 1px;
border-top-width: 2px;
background-color: #f5f5f5;
}
.dash {
border: 0 none;
border-top: 2px dashed #322f32;
background: none;
height: 0;
margin-top: 0px;
width: 60px;
}
thead tr th {
color: black !important;
text-align: left !important;
}
.basicaddon1 {
padding-right: 8px;
padding-left: 8px;
padding-top: 5px;
padding-bottom: 5px;
background-color: #e9ecef;
border-bottom: 2px solid #e9ecef;
}
.form-control:disabled,
.form-control[readonly] {
background-color: #e9ecef;
opacity: 1;
}
/*#footer {
position:fixed;
bottom: 0px;
width: 100%;
background-color:#ffffff;
left:0;
text-align:center;
border-top:1px solid #eeeeee;
}*/

#footer {
position:fixed;
bottom: 0px;
width: 81.81%;
background-color:#ffffff;
left:0;
margin-left: 223px;
margin-right: -15px;
text-align:center;
padding-top: 10px;
border-top:1px solid #eeeeee;
box-shadow: 9px 9px 9px 9px lightgrey;
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
padding-right: 5px;
}
input[type="number"]::placeholder {
/* Firefox, Chrome, Opera */
text-align: left !important;
}
#subtotal {
text-align: right;
}
input[type=number] {
text-align: left !important;
}
.input-group-text {
border: none;
border-radius: 0px;
}
.form-control {
padding: 1px 8px;
height: 25px;
}
.form-control-sm {
padding: 1px 8px;
}
@media screen and (min-device-width: 300px) and (max-device-width: 768px) {
.mobview {
padding-left: 30px;
}
}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
.imagePreview {
width: 100%;
}
}
@media only screen and (max-width: 300px) {
.select2-container {
width: 90px !important;
margin-top: 3px;
}
.select2-dropdown--below
  {
  width: none !important;
  }
#fulla {
padding-left: 12px !important;
}
}
.table-hover>tbody>tr:hover {
--bs-table-accent-bg: #FFFFFF;
color: var(--bs-table-hover-color);
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#city {
margin-top: 15px
}
#mobprintdesign{
    display: block !important;
}
#webprintdesign{
    display: none !important;
}
}
.customcont-heading{
padding-bottom: 5px;font-size: 15px;
}
hr{
margin-bottom:16px;
}
.table> :not(caption)>*>* {
padding-top: 4px;
padding-bottom: 2px;
}
.addan:hover {
background-color: #b7bbc0 !important;
}
.dropdown-toggle{
content: "\f107";
}

.form-group {
    margin-bottom: 0.5rem;
}
.bordernoneinput:focus{
    outline: none;
    border-color: inherit;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.bordernoneinput{
    border: none;
}
#datehis{
color:grey !important;
}
@media screen and (max-width: 600px) {
.mtcolumn
{
    margin-top:15px;
}
}
.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
}
      @media screen and (max-width: 666px){
        .mobreswords{
            display: none !important;
        }
      }
           /* @-moz-document url-prefix() {
            @media screen and (min-device-width: 992px) and (max-device-width: 1258px) {
                #zoomforprint{
                    transform: scale(%);
                    transform-origin: 0 0; 
                }
            }
            }*/
            @-moz-document url-prefix() {
@media screen and (min-device-width: 100px) and (max-device-width: 350px) {
#templatetext{
margin-top: -850px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 430px) {
#templatetext{
margin-top: -760px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 431px) and (max-device-width: 500px) {
#templatetext{
margin-top: -670px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 501px) and (max-device-width: 580px) {
#templatetext{
margin-top: -560px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 581px) and (max-device-width: 767px) {
#templatetext{
margin-top: -500px !important;
position:relative;
left:-70px;
}
}
@media screen and (min-device-width: 768px) and (max-device-width: 1300px) {
#templatetext{
margin-top: -262px !important;
position:relative;
left:-100px;
}
}
@media screen and (min-device-width: 1301px) and (max-device-width: 1400px) {
#templatetext{
margin-top: -160px !important;
}
}
@media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
#templatetext{
margin-top: 100px !important;
}
}
@media screen and (min-device-width: 1501px) and (max-device-width: 3000px) {
#templatetext{
margin-top: 60px !important;
}
}
            @media screen and (min-device-width: 100px) and (max-device-width: 768px) {
                .totalleftside{
                    font-size: 10px !important;
                }
            }
            @media screen and (min-device-width: 100px) and (max-device-width: 259px) {
                #zoomforprint{
                    transform: scale(15%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    transform: scale(15%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    transform: scale(17%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    transform: scale(19%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 320px) {
                #zoomforprint{
                    transform: scale(21%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    transform: scale(22%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 350px) {
                #zoomforprint{
                    transform: scale(23%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 380px) {
                #zoomforprint{
                    transform: scale(26%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 400px) {
                #zoomforprint{
                    transform: scale(28%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 430px) {
                #zoomforprint{
                    transform: scale(30%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 431px) and (max-device-width: 460px) {
                #zoomforprint{
                    transform: scale(33%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 490px) {
                #zoomforprint{
                    transform: scale(36%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    transform: scale(39%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 520px) {
                #zoomforprint{
                    transform: scale(42%);
                    transform-origin: 0 0;
                }
            }
           @media screen and (min-device-width: 521px) and (max-device-width: 550px) {
                #zoomforprint{
                    transform: scale(45%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 551px) and (max-device-width: 580px) {
                #zoomforprint{
                    transform: scale(48%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 581px) and (max-device-width: 600px) {
                #zoomforprint{
                    transform: scale(51%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 767px) {
                #zoomforprint{
                    transform: scale(54%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 768px) and (max-device-width: 800px) {
                #zoomforprint{
                    transform: scale(69%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 801px) and (max-device-width: 1199px) {
                #zoomforprint{
                    transform: scale(73%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1300px) {
                #zoomforprint{
                    transform: scale(69%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 1301px) and (max-device-width: 1400px) {
                #zoomforprint{
                    transform: scale(81%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
                #zoomforprint{
                    transform: scale(89%);
                    transform-origin: 0 0;
                }
            }
            }
        #gsttable th{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 12px !important;
            width: max-content !important;
        }
        #gsttable td{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 12px !important;
/*            width: 31px !important;*/
        }
        #gsttable td input{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 12px !important;
/*            width: 31px !important;*/
        }
        #gsttable td div{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 12px !important;
        }
        #gsttable .input-group-text{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 10px !important;
        }
        #gsttable .input-group{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 10px !important;
            width: max-content !important;
        }
            }
        .totalleftside{
            font-size: 12px !important;
        }
            @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    zoom: 19% !important;
                }
                #templatetext{
                    zoom: 183% !important;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    zoom: 21% !important;
                }
                #templatetext{
                    zoom: 183% !important;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    zoom: 23% !important;
                }
                #templatetext{
                    zoom: 183% !important;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 300px) {
                #zoomforprint{
                    zoom: 25% !important;
                }
                #templatetext{
                    zoom: 183% !important;
                }
            }
            @media screen and (min-device-width: 301px) and (max-device-width: 310px) {
                #zoomforprint{
                    zoom: 27% !important;
                }
                #templatetext{
                    zoom: 160% !important;
                }
            }
            @media screen and (min-device-width: 311px) and (max-device-width: 320px) {
                #zoomforprint{
                    zoom: 28% !important;
                }
                #templatetext{
                    zoom: 160% !important;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    zoom: 30% !important;
                }
                #templatetext{
                    zoom: 160% !important;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 340px) {
                #zoomforprint{
                    zoom: 32% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 341px) and (max-device-width: 350px) {
                #zoomforprint{
                    zoom: 34% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 360px) {
                #zoomforprint{
                    zoom: 36% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 361px) and (max-device-width: 370px) {
                #zoomforprint{
                    zoom: 37% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 371px) and (max-device-width: 380px) {
                #zoomforprint{
                    zoom: 39% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 390px) {
                #zoomforprint{
                    zoom: 41% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 391px) and (max-device-width: 400px) {
                #zoomforprint{
                    zoom: 43% !important;
                }
                #templatetext{
                    zoom: 150% !important;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 410px) {
                #zoomforprint{
                    zoom: 44% !important;
                }
                #templatetext{
                    zoom: 139% !important;
                }
            }
            @media screen and (min-device-width: 411px) and (max-device-width: 420px) {
                #zoomforprint{
                    zoom: 46% !important;
                }
                #templatetext{
                    zoom: 139% !important;
                }
            }
            @media screen and (min-device-width: 421px) and (max-device-width: 440px) {
                #zoomforprint{
                    zoom: 48% !important;
                }
                #templatetext{
                    zoom: 127% !important;
                }
            }
            @media screen and (min-device-width: 441px) and (max-device-width: 450px) {
                #zoomforprint{
                    zoom: 51% !important;
                }
                #templatetext{
                    zoom: 127% !important;
                }
            }
            @media screen and (min-device-width: 451px) and (max-device-width: 460px) {
                #zoomforprint{
                    zoom: 53% !important;
                }
                #templatetext{
                    zoom: 123% !important;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 470px) {
                #zoomforprint{
                    zoom: 55% !important;
                }
                #templatetext{
                    zoom: 117% !important;
                }
            }
            @media screen and (min-device-width: 471px) and (max-device-width: 490px) {
                #zoomforprint{
                    zoom: 57% !important;
                }
                #templatetext{
                    zoom: 111% !important;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    zoom: 60% !important;
                }
                #templatetext{
                    zoom: 106% !important;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 530px) {
                #zoomforprint{
                    zoom: 62% !important;
                }
            }
            @media screen and (min-device-width: 531px) and (max-device-width: 540px) {
                #zoomforprint{
                    zoom: 64% !important;
                }
            }
            @media screen and (min-device-width: 541px) and (max-device-width: 570px) {
                #zoomforprint{
                    zoom: 66% !important;
                }
            }
            @media screen and (min-device-width: 571px) and (max-device-width: 590px) {
                #zoomforprint{
                    zoom: 68% !important;
                }
            }
            @media screen and (min-device-width: 591px) and (max-device-width: 600px) {
                #zoomforprint{
                    zoom: 72% !important;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 610px) {
                #zoomforprint{
                    zoom: 74% !important;
                }
            }
            @media screen and (min-device-width: 611px) and (max-device-width: 620px) {
                #zoomforprint{
                    zoom: 81% !important;
                }
            }
            @media screen and (min-device-width: 621px) and (max-device-width: 767px) {
                #zoomforprint{
                    zoom: 83% !important;
                }
            }
            @media screen and (min-device-width: 992px) and (max-device-width: 1020px) {
                #zoomforprint{
                    zoom: 90% !important;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1220px) {
                #zoomforprint{
                    zoom: 90% !important;
                }
            }
.ribbon-wrapper {
  width: 185px;
  height: 188px;
  overflow: hidden;
  position: absolute;
  top: -3px;
  left: -3px;
}
    
.ribbon {
    font: bold 15px Sans-Serif;
    color: #333;
    text-align: center;
    text-shadow: rgba(255, 255, 255, 0.5) 0 1px 0;
    position: relative;
    padding: 3px 0;

    transform: rotate(-45deg);

    left: -42px;
    top: 32px;
    width: 180px;

    background-color: #BFDC7A;

    box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
}

.ribbon:before, .ribbon:after {
    content: "";
    border-top: 3px solid #6e8900;
    border-left: 3px solid transparent;
    border-right: 3px solid transparent;
    position: absolute;
    bottom: -3px;
}

.ribbon:before {
    left: 0;
}

.ribbon:after {
    right: 0;
}
        #gsttable td{
            height: 15px !important;
            margin: 0px !important;
            padding: 0px !important;
        }
        #gsttable td input{
            height: 15px !important;
            margin: 0px !important;
            padding: 0px !important;
        }
        #gsttable td div{
            height: 15px !important;
            margin: 0px !important;
            padding: 0px !important;
        }
.imgcontainer {
  position: relative;
  text-align: center;
  color: black;
  cursor:pointer;
  
}
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  color:#1BBC9B;
  font-size:30px;
  transform: translate(-50%, -50%);
}
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

        background-image: url("./assets/img/spin.gif");
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
<?php
}
?>
</style>
<style>
  <?php
if ($current_file_name=='salespaymentadd.php'||$current_file_name=='customerrefundadd.php'||$current_file_name=='purchasepaymentadd.php'||$current_file_name=='vendorrefundadd.php') {
    ?>
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
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
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
@media screen and (max-width: 380px){
  #arrowsalltabs{
    visibility: visible !important;
  }
}
@media screen and (min-device-width: 381px) and (max-device-width: 3000px){
  #arrowsalltabs{
    visibility: hidden !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
    .modal-footer{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
        padding-bottom: 0px !important;
    }
    .modal-content {
        border-radius: 0px;
    }

    .modal-header {
        background: #f5f5f5;
        border-radius: 0;
    }

    .modal-title {
        font-weight: normal;
    }
   @media screen and (max-width: 777px) 
{
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
    text-align: right !important;
  }
  
  table td::before {
    color: black !important;
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}

[aria-expanded="false"] > .expanded,
[aria-expanded="true"] > .collapsed {
  display: none;
}
 
 .myinput::-webkit-input-placeholder {
    font-size: 9.5px;
 }
    .select2-container--default .select2-selection--single{
        height: 32px !important;
    }
<?php
}
?>
  <?php
if ($current_file_name=='salespaymentedit.php'||$current_file_name=='customerrefundedit.php'||$current_file_name=='purchasepaymentedit.php'||$current_file_name=='vendorrefundedit.php') {
    ?>
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
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
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
@media screen and (max-width: 380px){
  #arrowsalltabs{
    visibility: visible !important;
  }
}
@media screen and (min-device-width: 381px) and (max-device-width: 3000px){
  #arrowsalltabs{
    visibility: hidden !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
    .modal-footer{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
        padding-bottom: 0px !important;
    }
    .modal-content {
        border-radius: 0px;
    }

    .modal-header {
        background: #f5f5f5;
        border-radius: 0;
    }

    .modal-title {
        font-weight: normal;
    }
    .amt:focus{
        border: 1px solid skyblue !important;
        outline: none !important;
        box-shadow: none !important;
    }
    .rupamt{
        position: relative;
        top: -2px !important;
    }
        .amt{
            border: 1px solid #eee;
            height: 21px !important;
            padding: 0px !important;
            font-size: 13px !important;
        }
        #amttable td{
            font-size: 13px !important;
        }
      @media screen and (max-width: 777px) {
        .amt{
            width:130px !important;
            float:right;
            border: 1px solid #eee;
            font-size: 9.92px !important;
            height: 18px !important;
        }
        #amttable td{
            height:18px !important;
            font-size: .8em !important;
        }
    .rupamt{
        position: relative;
        top: 0px !important;
    }
      }
   @media screen and (max-width: 777px) 
{
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
    padding-bottom: 1em;
  }
  
  
  table td {
    border-bottom: 1px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right !important;
  }
  
  table td::before {
    color: black !important;
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
[aria-expanded="false"] > .expanded,
[aria-expanded="true"] > .collapsed {
  display: none;
}
 
 .myinput::-webkit-input-placeholder {
    font-size: 9.5px;
 }
    .select2-container--default .select2-selection--single{
        height: 32px !important;
    }
<?php
}
?>
  <?php
if ($current_file_name=='salespaymentadd.php'||$current_file_name=='customerrefundadd.php'||$current_file_name=='purchasepaymentadd.php'||$current_file_name=='vendorrefundadd.php'||$current_file_name=='salespaymentedit.php'||$current_file_name=='customerrefundedit.php'||$current_file_name=='purchasepaymentedit.php'||$current_file_name=='vendorrefundedit.php') {
    ?>
    .modal-footer{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
        padding-bottom: 0px !important;
    }
    .modal-content {
        border-radius: 0px;
    }

    .modal-header {
        background: #f5f5f5;
        border-radius: 0;
    }

    .modal-title {
        font-weight: normal;
    }
    .select2-container{
        width: 100% !important;
    }
    .amt:focus{
        border: 1px solid skyblue !important;
        outline: none !important;
        box-shadow: none !important;
    }
    .rupamt{
        position: relative;
        top: -2px !important;
    }
        .amt{
            border: 1px solid #eee;
            height: 21px !important;
            padding: 0px !important;
            font-size: 13px !important;
        }
        #amttable td{
            font-size: 13px !important;
        }
      @media screen and (max-width: 777px) {
        .amt{
            width:130px !important;
            float:right;
            border: 1px solid #eee;
            font-size: 9.92px !important;
            height: 18px !important;
        }
        #amttable td{
            height:18px !important;
            font-size: .8em !important;
        }
    .rupamt{
        position: relative;
        top: 0px !important;
    }
      }
.tfunit{
display: none !important;
}
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

        background-image: url("./assets/img/spin.gif");
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
<?php
}
?>
</style>
<style>
  <?php
if ($current_file_name=='salespaymentview.php'||$current_file_name=='customerrefundview.php'||$current_file_name=='purchasepaymentview.php'||$current_file_name=='vendorrefundview.php') {
    ?>
.form-control:disabled, .form-control[readonly] {
  background-color: #ffffff !important;
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#mobprintdesign{
    display: block !important;
}
#webprintdesign{
    display: none !important;
}
}
    #histables thead td{
        color: grey !important;
        font-weight: 600 !important;
    }
        #histables table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
  #histables table {
    border: 0;
  }

  #histables table caption {
    font-size: 1.3em;
  }
  
  #histables table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  #histables table tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    display: block;
    margin-bottom: 1em;
  }
  
  
  #histables table td {
    border-bottom: 0px solid #ddd;
    display: block;
    font-size: .8em;
    text-align: right;
    white-space: normal !important;
  }
  
  #histables table td::before {
    color: grey !important;
    /*
    * aria-label has no advantage, it won't be read inside a #histables table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: 600;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  #histables table td:last-child {
    border-bottom: 0;
  }
}
.#histables table td, .#histables table th {
    white-space: normal !important;
}
#fullcontainerwidth{
     max-width: 1650px;

}
.card-body{
 font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;

}
#viewpro{
  font-size:20px;
}
#btnalignright{
float:right;
}
#btngopage{
margin-bottom:0rem;
margin-right:10px;
}
#datehis{
color:grey;
}
#chhis{
color:grey;
}
#infoheadsall{
font-size: 17px;;
}
#aligncenterall{
align-items: center;;
}
#insideheadall{
font-size:13px;
}
      @media screen and (max-width: 666px){
        .mobreswords{
            display: none !important;
        }
      }
           /* @-moz-document url-prefix() {
            @media screen and (min-device-width: 992px) and (max-device-width: 1258px) {
                #zoomforprint{
                    transform: scale(%);
                    transform-origin: 0 0; 
                }
            }
            }*/
            @-moz-document url-prefix() {
@media screen and (min-device-width: 100px) and (max-device-width: 350px) {
#templatetext{
margin-top: -850px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 430px) {
#templatetext{
margin-top: -760px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 431px) and (max-device-width: 500px) {
#templatetext{
margin-top: -670px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 501px) and (max-device-width: 580px) {
#templatetext{
margin-top: -560px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 581px) and (max-device-width: 767px) {
#templatetext{
margin-top: -500px !important;
position:relative;
left:-70px;
}
}
@media screen and (min-device-width: 768px) and (max-device-width: 1300px) {
#templatetext{
margin-top: -262px !important;
position:relative;
left:-100px;
}
}
@media screen and (min-device-width: 1301px) and (max-device-width: 1400px) {
#templatetext{
margin-top: -160px !important;
}
}
@media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
#templatetext{
margin-top: 100px !important;
}
}
@media screen and (min-device-width: 1501px) and (max-device-width: 3000px) {
#templatetext{
margin-top: 60px !important;
}
}
            @media screen and (min-device-width: 100px) and (max-device-width: 768px) {
                .totalleftside{
                    font-size: 10px !important;
                }
            }
            @media screen and (min-device-width: 100px) and (max-device-width: 259px) {
                #zoomforprint{
                    transform: scale(15%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    transform: scale(15%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    transform: scale(17%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    transform: scale(19%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 320px) {
                #zoomforprint{
                    transform: scale(21%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    transform: scale(22%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 350px) {
                #zoomforprint{
                    transform: scale(23%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 380px) {
                #zoomforprint{
                    transform: scale(26%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 400px) {
                #zoomforprint{
                    transform: scale(28%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 430px) {
                #zoomforprint{
                    transform: scale(30%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 431px) and (max-device-width: 460px) {
                #zoomforprint{
                    transform: scale(33%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 490px) {
                #zoomforprint{
                    transform: scale(36%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    transform: scale(39%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 520px) {
                #zoomforprint{
                    transform: scale(42%);
                    transform-origin: 0 0;
                }
            }
           @media screen and (min-device-width: 521px) and (max-device-width: 550px) {
                #zoomforprint{
                    transform: scale(45%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 551px) and (max-device-width: 580px) {
                #zoomforprint{
                    transform: scale(48%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 581px) and (max-device-width: 600px) {
                #zoomforprint{
                    transform: scale(51%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 767px) {
                #zoomforprint{
                    transform: scale(54%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 768px) and (max-device-width: 800px) {
                #zoomforprint{
                    transform: scale(69%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 801px) and (max-device-width: 1199px) {
                #zoomforprint{
                    transform: scale(73%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1300px) {
                #zoomforprint{
                    transform: scale(69%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 1301px) and (max-device-width: 1400px) {
                #zoomforprint{
                    transform: scale(81%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
                #zoomforprint{
                    transform: scale(89%);
                    transform-origin: 0 0;
                }
            }
            }
        #gsttable th{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 8px !important;
            width: max-content !important;
        }
        #gsttable td{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 8px !important;
            width: 31px !important;
        }
        #gsttable td input{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 8px !important;
            width: 31px !important;
        }
        #gsttable td div{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 8px !important;
        }
        #gsttable .input-group-text{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 10px !important;
        }
        #gsttable .input-group{
            height: 10px !important;
            margin: 0px !important;
            padding: 0px !important;
            font-size: 10px !important;
            width: max-content !important;
        }
            }
        .totalleftside{
            font-size: 12px !important;
        }
            @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    zoom: 19% !important;
                }
                #templatetext{
                    zoom: 183% !important;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    zoom: 21% !important;
                }
                #templatetext{
                    zoom: 183% !important;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    zoom: 23% !important;
                }
                #templatetext{
                    zoom: 183% !important;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 300px) {
                #zoomforprint{
                    zoom: 25% !important;
                }
                #templatetext{
                    zoom: 183% !important;
                }
            }
            @media screen and (min-device-width: 301px) and (max-device-width: 310px) {
                #zoomforprint{
                    zoom: 27% !important;
                }
                #templatetext{
                    zoom: 160% !important;
                }
            }
            @media screen and (min-device-width: 311px) and (max-device-width: 320px) {
                #zoomforprint{
                    zoom: 28% !important;
                }
                #templatetext{
                    zoom: 160% !important;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    zoom: 30% !important;
                }
                #templatetext{
                    zoom: 160% !important;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 340px) {
                #zoomforprint{
                    zoom: 32% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 341px) and (max-device-width: 350px) {
                #zoomforprint{
                    zoom: 34% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 360px) {
                #zoomforprint{
                    zoom: 36% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 361px) and (max-device-width: 370px) {
                #zoomforprint{
                    zoom: 37% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 371px) and (max-device-width: 380px) {
                #zoomforprint{
                    zoom: 39% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 390px) {
                #zoomforprint{
                    zoom: 41% !important;
                }
                #templatetext{
                    zoom: 158% !important;
                }
            }
            @media screen and (min-device-width: 391px) and (max-device-width: 400px) {
                #zoomforprint{
                    zoom: 43% !important;
                }
                #templatetext{
                    zoom: 150% !important;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 410px) {
                #zoomforprint{
                    zoom: 44% !important;
                }
                #templatetext{
                    zoom: 139% !important;
                }
            }
            @media screen and (min-device-width: 411px) and (max-device-width: 420px) {
                #zoomforprint{
                    zoom: 46% !important;
                }
                #templatetext{
                    zoom: 139% !important;
                }
            }
            @media screen and (min-device-width: 421px) and (max-device-width: 440px) {
                #zoomforprint{
                    zoom: 48% !important;
                }
                #templatetext{
                    zoom: 127% !important;
                }
            }
            @media screen and (min-device-width: 441px) and (max-device-width: 450px) {
                #zoomforprint{
                    zoom: 51% !important;
                }
                #templatetext{
                    zoom: 127% !important;
                }
            }
            @media screen and (min-device-width: 451px) and (max-device-width: 460px) {
                #zoomforprint{
                    zoom: 53% !important;
                }
                #templatetext{
                    zoom: 123% !important;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 470px) {
                #zoomforprint{
                    zoom: 55% !important;
                }
                #templatetext{
                    zoom: 117% !important;
                }
            }
            @media screen and (min-device-width: 471px) and (max-device-width: 490px) {
                #zoomforprint{
                    zoom: 57% !important;
                }
                #templatetext{
                    zoom: 111% !important;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    zoom: 60% !important;
                }
                #templatetext{
                    zoom: 106% !important;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 530px) {
                #zoomforprint{
                    zoom: 62% !important;
                }
            }
            @media screen and (min-device-width: 531px) and (max-device-width: 540px) {
                #zoomforprint{
                    zoom: 64% !important;
                }
            }
            @media screen and (min-device-width: 541px) and (max-device-width: 570px) {
                #zoomforprint{
                    zoom: 66% !important;
                }
            }
            @media screen and (min-device-width: 571px) and (max-device-width: 590px) {
                #zoomforprint{
                    zoom: 68% !important;
                }
            }
            @media screen and (min-device-width: 591px) and (max-device-width: 600px) {
                #zoomforprint{
                    zoom: 72% !important;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 610px) {
                #zoomforprint{
                    zoom: 74% !important;
                }
            }
            @media screen and (min-device-width: 611px) and (max-device-width: 620px) {
                #zoomforprint{
                    zoom: 81% !important;
                }
            }
            @media screen and (min-device-width: 621px) and (max-device-width: 767px) {
                #zoomforprint{
                    zoom: 83% !important;
                }
            }
            @media screen and (min-device-width: 992px) and (max-device-width: 1020px) {
                #zoomforprint{
                    zoom: 90% !important;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1220px) {
                #zoomforprint{
                    zoom: 90% !important;
                }
            }
    table td{
        white-space: nowrap !important;
    }
        
.ribbon-wrapper {
  width: 185px;
  height: 188px;
  overflow: hidden;
  position: absolute;
  top: -3px;
  left: -3px;
}
    
.ribbon {
    font: bold 15px Sans-Serif;
    color: #333;
    text-align: center;
    text-shadow: rgba(255, 255, 255, 0.5) 0 1px 0;
    position: relative;
    padding: 3px 0;

    transform: rotate(-45deg);

    left: -42px;
    top: 32px;
    width: 180px;

    background-color: #BFDC7A;

    box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
}

.ribbon:before, .ribbon:after {
    content: "";
    border-top: 3px solid #6e8900;
    border-left: 3px solid transparent;
    border-right: 3px solid transparent;
    position: absolute;
    bottom: -3px;
}

.ribbon:before {
    left: 0;
}

.ribbon:after {
    right: 0;
}
.imgcontainer {
  position: relative;
  text-align: center;
  color: black;
  cursor:pointer;
  
}
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  color:#1BBC9B;
  font-size:30px;
  transform: translate(-50%, -50%);
}
<?php
}
?>
</style>
<style>
  <?php
if ($current_file_name=='salespayments.php'||$current_file_name=='customerrefunds.php'||$current_file_name=='purchasepayments.php'||$current_file_name=='vendorrefunds.php') {
    ?>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 724px) 
{
  .add{
    position: relative;
    top: 36px; 
  }
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
/*    color: grey !important;*/
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
<?php
}
?>
</style>
<style>
  <?php
if ($current_file_name=='customers.php'||$current_file_name=='vendors.php') {
    ?>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (min-device-width: 313px) and (max-device-width: 991px) {
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
@media screen and (min-device-width: 100px) and (max-device-width: 312px) {
    .add{
        position: relative;
        left: -54px !important;
        top: 36px;
}
.addmenu{
    position: relative;
    left: -57px !important;
        top: 36px;
}
}
@media screen and (max-width: 900px) 
{
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
/*    color: grey !important;*/
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
<?php
}
?>
  <?php
if ($current_file_name=='vendoradd.php'||$current_file_name=='vendoredit.php') {
    ?>
#fullcontainerwidth{
     max-width: 1650px;

}
.card-body{
 font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;


 }
 #neweditven{
  font-size:20px;

  border-bottom: 1px dashed lightgrey;

  width: max-content;

 }
 .modal-content{
  border-radius: 0px;

 }
 .modal-header{
  border-radius:0px !important;

 }
 .modal-title{
  color:#212529;

 }
 #closeicon{
  font-size: 21px;

  font-weight: 600;

 }
 .modal-body{
  padding-bottom: 0px !important;

  margin-bottom: -24.5px !important;

 }
.modal-footer{
     display: block;

     margin-bottom: -14.5px;

}
.mbsub{
     padding-bottom: 0px !important;

     margin-bottom: 0px !important;

}
.mfsub{
 display: block;

 }
.customcont-heading{
     font-size: 18px;

}
.vendorid{
     border-bottom: 1px dashed grey;

}
.highfor{
     height:42px;

}
.primarycontact{
     border-bottom: 1px dashed grey;

}
#drpsalute{
     position:relative;
     top: -27px;
     left: 81%;
     color: #ced4da;

}
.companyname{
     border-bottom: 1px dashed grey;

}
.displayname{
     border-bottom: 1px dashed grey;

}
#area{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 1px solid #ced4da;
     border-right: 0px solid #ced4da;
     width: 145px !important;

}
#city{
     padding: 5px 8px;
     border: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;

}
#state{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 1px solid #ced4da;
     border-right: 1px solid #ced4da;
     width: 54px !important;

}
#pincode{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 0px solid #ced4da;
     border-right: 0px solid #ced4da;

}
#country{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 1px solid #ced4da;
     border-right: 1px solid #ced4da;
     width: 45px !important;

}
.cusvis{
     color: #ee0000;

}
.bi-question-circle{
     color: #777777;
     width: 14;
     height: 14;
     cursor: pointer;

}
.taxpre{
    color: #ee0000;

}
#gstblock{
     display: none;

}
<?php
}
?>
  <?php
if ($current_file_name=='customeradd.php') {
    ?>
#fullcontainerwidth{
max-width: 1650px;
}
.card-body{
 font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;

}
#newcus{
font-size:20px;
border-bottom: 1px dashed lightgrey;
width: max-content;
}
.modal-content{
border-radius: 0px;
}
.modal-header{
border-radius:0px !important;
}
.modal-title{
color:#212529;
}
#closeicon{
font-size: 21px;
font-weight: 600;
}
.modal-body{
padding-bottom: 0px !important;
margin-bottom: -24.5px !important;
}
.modal-footer{
display: block;
margin-bottom: -14.5px;
}
.mbsub{
padding-bottom: 0px !important;
margin-bottom: 0px !important;
}
.mfsub{
display: block;
}
.customcont-heading{
font-size: 18px;
}
.vendorid{
border-bottom: 1px dashed grey;
}
.highfor{
height:42px;
}
.primarycontact{
border-bottom: 1px dashed grey;
}
#drpsalute{
position:relative;
top: -27px;
left: 81%;
color: #ced4da;
}
.companyname{
border-bottom: 1px dashed grey;
}
.displayname{
border-bottom: 1px dashed grey;
}
#area{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 0px solid #ced4da;
width: 145px !important;
}
#city{
padding: 5px 8px;
border: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
}
#state{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 54px !important;
}
#pincode{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 0px solid #ced4da;
border-right: 0px solid #ced4da;
}
#country{
padding: 5px 8px;
border-top: 1px solid #ced4da;
border-radius: 0px;
margin: 0px;
font-size: 13.6px;
border-bottom: 1px solid #ced4da;
border-left: 1px solid #ced4da;
border-right: 1px solid #ced4da;
width: 45px !important;
}
.cusvis{
color: #ee0000;
}
.bi-question-circle{
color: #777777;
width: 14;
height: 14;
cursor: pointer;
}
.taxpre{
color: #ee0000;
}
#gstblock{
display: none;
}
<?php
}
?>
  <?php
if ($current_file_name=='customeredit.php') {
    ?>
#fullcontainerwidth{
     max-width: 1650px;

}
.card-body{
 font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;


 }
 #edithead{
  font-size:20px;

  border-bottom: 1px dashed lightgrey;

  width: max-content;

 }
 .modal-content{
  border-radius: 0px;

 }
 .modal-header{
  border-radius:0px !important;

 }
 .modal-title{
  color:#212529;

 }
 #closeicon{
  font-size: 21px;

  font-weight: 600;

 }
 .modal-body{
  padding-bottom: 0px !important;

  margin-bottom: -24.5px !important;

 }
.modal-footer{
     display: block;

     margin-bottom: -14.5px;

}
.mbsub{
     padding-bottom: 0px !important;

     margin-bottom: 0px !important;

}
.mfsub{
 display: block;

 }
.customcont-heading{
     font-size: 18px;

}
.vendorid{
     border-bottom: 1px dashed grey;

}
.highfor{
     height:42px;

}
.primarycontact{
     border-bottom: 1px dashed grey;

}
#drpsalute{
     position:relative;
     top: -27px;
     left: 81%;
     color: #ced4da;

}
.companyname{
     border-bottom: 1px dashed grey;

}
.displayname{
     border-bottom: 1px dashed grey;

}
#area{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 1px solid #ced4da;
     border-right: 0px solid #ced4da;
     width: 145px !important;

}
#city{
     padding: 5px 8px;
     border: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;

}
#state{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 1px solid #ced4da;
     border-right: 1px solid #ced4da;
     width: 54px !important;

}
#pincode{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 0px solid #ced4da;
     border-right: 0px solid #ced4da;

}
#country{
     padding: 5px 8px;
     border-top: 1px solid #ced4da;
     border-radius: 0px;
     margin: 0px;
     font-size: 13.6px;
     border-bottom: 1px solid #ced4da;
     border-left: 1px solid #ced4da;
     border-right: 1px solid #ced4da;
     width: 45px !important;

}
.cusvis{
     color: #ee0000;

}
.bi-question-circle{
     color: #777777;
     width: 14;
     height: 14;
     cursor: pointer;

}
.taxpre{
    color: #ee0000;

}
#gstblock{
     display: none;

}
<?php
}
?>
  <?php
if ($current_file_name=='customerview.php'||$current_file_name=='enquiryadd.php') {
    ?>
#fullcontainerwidth{
     max-width: 1650px;
}
.card-body{
 font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;

 }
 #viewhead{
  font-size:20px;
 }
 #btnalignright{
float:right;
}
#btngopage{
margin-bottom:0rem;
margin-right:10px;
}
#datehis{
color:grey;
}
#chhis{
color:grey;
}
#infoheadsall{
font-size: 17px;;
}
#aligncenterall{
align-items: center;;
}
#insideheadall{
font-size:13px;
}
<?php
}
?>
  <?php
if ($current_file_name=='vendorview.php') {
    ?>
#fullcontainerwidth{
     max-width: 1650px;
}
.card-body{
 font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;

 }
 #viewven{
  font-size:20px;
 }
 #btnalignright{
float:right;
}
#btngopage{
margin-bottom:0rem;
margin-right:10px;
}
#datehis{
color:grey;
}
#chhis{
color:grey;
}
#infoheadsall{
font-size: 17px;;
}
#aligncenterall{
align-items: center;;
}
#insideheadall{
font-size:13px;
}
<?php
}
?>
  <?php
if ($current_file_name=='customerview.php'||$current_file_name=='vendorview.php'||$current_file_name=='enquiryadd.php') {
    ?>
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
 /* $scrollbar-2-thumb-width: 10px;
  $scrollbar-2-thumb-color: #008aff;
  $scrollbar-2-track-color: #bbb;*/
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
@media screen and (max-width: 380px){
  #arrowsalltabs{
    visibility: visible !important;
  }
}
@media screen and (min-device-width: 381px) and (max-device-width: 3000px){
  #arrowsalltabs{
    visibility: hidden !important;
  }
/*.accordion-button:not(.collapsed)::after{
  margin-left: -20px !important;
}*/
}
<?php
}
?>
</style>
<style>
  <?php
if ($current_file_name=='adjustments.php') {
    ?>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 600px) 
{
  .add{
    position: relative;
    top: 36px; 
  }
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
    height: 32.64px !important;
  }
  
  table td::before {
/*    color: grey !important;*/
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
<?php
}
?>
  <?php
if ($current_file_name=='adjustmentadd.php'||$current_file_name=='adjustmentedit.php') {
    ?>@media screen and (min-device-width: 992px) and (max-device-width: 3000px) {
.for1per{
width: 1% !important;
}
.iteminfo{
width: 36% !important;
}
.batchinfo{
width: 17% !important;
}
.qtyinfo{
width: 13% !important;
}
.newqtyinfo{
width: 15% !important;
}
.qtyadjinfo{
width: 12% !important;
}
    #purchasetable{
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable thead:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable tbody:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable th:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable td:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    }
    #purchasetable tr:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable input{
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable textarea{
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable select{
      border: 1px solid #e1dbdb !important;
    }
    .select2-container--default .subtextfoo td  tr  tbody{
      border: none !important;
    }
    .notforfinaloutputsave td{
        width: 60% !important;
    }
.myinput::-webkit-input-placeholder {
font-size: 9.5px;
}
.select2 {
width: 100% !important;
background-color: #ffffff !important;
}
.modal-content {
border-radius: 0px;
}
.modal-header {
background: #F1F2F6;
border-radius: 0;
}
.modal-title {
font-weight: normal;
}
.select2-container--default .select2-selection--single {
background-color: #ffffff !important;
color: #495057;
border: 1px solid #ced4da;
height: 25px;
border-radius: 2px;
}
.select2-selection--single .select2-selection__rendered{
line-height: 22.5px !important;
}
.btn_upload {
cursor: pointer;
display: inline-block;
overflow: hidden;
position: relative;
color: #fff;
background-color: #fff;
border: none;
}
.btn_upload:hover,
.btn_upload:focus {
background-color: #fff;
}
.yes {
display: flex;
align-items: flex-start;
margin-top: 10px !important;
}
.btn_upload input {
cursor: pointer;
height: 100%;
position: absolute;
filter: alpha(opacity=1);
-moz-opacity: 0;
opacity: 0;
}
.it {
height: 100px;
margin-left: 10px;
}
.accordion-button:not(.collapsed)::after
{
background-image: url("");
}
.mb-3 {
margin-bottom: -5px !important;
}
#removeImage1,
#removeImage2,
#removeImage3,
#removeImage4,
#removeImage5 {
color: #6c757d;
}
#removeImage1:hover {
color: black;
}
#removeImage2:hover {
color: black;
}
#removeImage3:hover {
color: black;
}
#removeImage4:hover {
color: black;
}
#removeImage5:hover {
color: black;
}
.rmv {
cursor: pointer;
color: #fff;
border-radius: 30px;
border: 1px solid #fff;
display: inline-block;
background: rgba(255, 0, 0, 1);
margin: -5px -10px;
}
.rmv:hover {
background: rgba(255, 0, 0, 0.5);
}
.item-actions-container .item-actions {
position: absolute;
right: -50px;
top: -20px;
}
.icon-cancel-circled {
color: #fab2b1;
}
svg.icon.icon-sm {
height: 14px;
width: 14px;
}
.tdmove:hover {
cursor: move;
}
.imagePreview {
width: 200px;
height: 140px;
background-position: center center;
background-color: #fff;
background-size: cover;
background-repeat: no-repeat;
text-align: center;
}
.btn-custom-grey:hover i {
color: #ffffff !important;
}
.btn-custom-grey:active, .btn-custom-grey:focus, .btn-custom-grey:hover {
background-color: #f8f8f8;
border-color: #c6c6c6;
}
/*.btn-custom:hover {
background-color: #ed0707 !important;
border-color: #c6c6c6;
}*/
.selectdesign {
width: 6px;
padding-right: 0px;
padding-left: 10px;
padding-bottom: 1px;
border-top-width: 2px;
background-color: #f5f5f5;
}
.dash {
border: 0 none;
border-top: 2px dashed #322f32;
background: none;
height: 0;
margin-top: 0px;
width: 60px;
}
thead tr th {
color: black !important;
text-align: left !important;
}
.basicaddon1 {
padding-right: 8px;
padding-left: 8px;
padding-top: 5px;
padding-bottom: 5px;
background-color: #e9ecef;
border-bottom: 2px solid #e9ecef;
}
.form-control:disabled,
.form-control[readonly] {
background-color: #e9ecef;
opacity: 1;
}
#footer {
background-color: #ffffff;
width: 84%;
position: fixed;
bottom: 0px;
height: 50px;
margin-bottom: 0px;
Padding-top: 0px;
margin-left: -15px;
margin-right: -15px;
border: 1px solid #eee;
-webkit-box-shadow: 0px -4px 3px #e9ecef;
-moz-box-shadow: 0px -4px 3px #e9ecef;
box-shadow: 0 -4px 5px -3px rgb(0 0 0 / 10%);
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
padding-right: 5px;
}
input[type="number"]::placeholder {
/* Firefox, Chrome, Opera */
text-align: right;
}
#subtotal {
text-align: right;
}
input[type=number] {
text-align: right;
}
.input-group-text {
border: none;
border-radius: 0px;
}
.form-control {
padding: 1px 8px;
height: 25px;
}
.form-control-sm {
padding: 1px 8px;
}
table tbody tr:nth-of-type(odd) {}
@media screen and (max-width: 600px) {
table {
border: 0;
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
table thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
table td {
border-bottom: 1px solid #ddd;
display: block;
font-size: 9px !important;
text-align: right;
}
table td::before {
    color: grey !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
font-size: 9px !important;
text-transform: uppercase;
}
    #loadimgins{
        width: 100% !important;
    }
table td:last-child {
border-bottom: 0;
}
}
.table> :not(caption)>*>* {
background-color: #ffffff;
box-shadow: none;
}
.table> :not(:last-child)> :last-child>* {
border-bottom-color: #e9ecef;
font-size: 12px !important;
}
.input-group .form-control:not(:first-child) {
border-left: 0;
padding-left: 5px;
}
a .customcont-heading1 {
margin-left: 30px;
}
.form-control-bn:focus {
border: none !important;
box-shadow: none;
}
.input-group .form-control-bn:focus {
border: none !important;
box-shadow: none;
}
table thead th {
height: 10px;
vertical-align: top;
}
@media screen and (min-device-width: 300px) and (max-device-width: 768px) {
.mobview {
padding-left: 30px;
}
}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
.imagePreview {
width: 100%;
}
}
@media only screen and (max-width: 300px) {
.select2-container {
width: 90px !important;
margin-top: 3px;
}
.select2-dropdown--below
{
width: none !important;
}
#fulla {
padding-left: 12px !important;
}
}
.table-hover>tbody>tr:hover {
--bs-table-accent-bg: #FFFFFF;
color: var(--bs-table-hover-color);
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#city {
margin-top: 15px
}
}
.customcont-heading{
padding-bottom: 5px;font-size: 15px;
}
hr{
margin-bottom:16px;
}
.table> :not(caption)>*>* {
padding-top: 4px;
padding-bottom: 2px;
}
.addan:hover {
background-color: #b7bbc0 !important;
}
.dropdown-toggle{
content: "\f107";
}
.form-group {
margin-bottom: 0.5rem;
}
.bordernoneinput:focus{
outline: none;
border-color: inherit;
-webkit-box-shadow: none;
box-shadow: none;
}
.bordernoneinput{
border: none;
}
.select2-dropdown {
  z-index: 9001;
}
.protables tbody tr:nth-of-type(odd) {}
.protables {
border: 0;
}
.protables caption {
font-size: 1.3em;
}
.protables thead {
border: none;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}
.protables tr {
border-bottom: 1px solid #ddd;
display: block;
margin-bottom: 1em;
}
.protables thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
.protables td {
color: #212529 !important;
border-bottom: 1px solid #ddd;
display: block;
font-size: .8em;
text-align: right;
}
.protables td::before {
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: bold;
text-transform: uppercase;
}
    #loadimgins{
        width: 100% !important;
    }
.protables td:last-child {
border-bottom: 0;
}
.country:focus{
outline: none !important;
border: none !important;
box-shadow: none !important;
}
.mfsub{
display: block;
}
.modal-content{
border-radius: 0px;
}
.modal-header{
border-radius:0px !important;
}
.modal-title{
color:#212529;
}
#procloseicon{
font-size: 21px;
font-weight: 600;
}
.modal-body{
padding-bottom: 0px !important;
margin-bottom: -24.5px !important;
}
.modal-footer{
display: block;
margin-bottom: -14.5px;
}
.mbsub{
padding-bottom: 0px !important;
margin-bottom: 0px !important;
}
.customcont-heading{
font-size: 18px;
}
#prounitsindes{
margin-bottom: 0px !important;
margin-top: 9px !important;
}
#prouqcindes{
padding-left: 0px;
}
.bi-question-circle{
color: #777777;
width: 14;
height: 14;
cursor: pointer;
margin-bottom: 3px;
}
#prouck{
height:36px;
}
#prodefaultunit{
width: 100%;
}
.deltophead{
margin-top:0px;
}
#prodelinpbrd{
border:1px solid lightgrey;
}
#prodescription{
height: 70px !important;
}
#profirstclsale{
width:10px;
}
#prosecondclsale{
width:75px;
}
#prothirdclsale{
width:82px;
}
#profourthclsale{
width:84px;
}
#profifthclsale{
width:72px;
}
#prosixthclsale{
width:33px;
}
.icon-drag{
color:#cccccc;
}
/*#proproductname1{
height:21px;
padding: 0px;
font-size: 16px !important;
}
#proruppesymbol{
color: #495057;
padding: 8px 3.75px;
height:21px;
font-size: 16px !important;
}
#proquantity1{
height:21px;
width: 24px;
text-align: right;
padding: 0px;
font-size: 16px !important;
}
#proproductrate1{
height:21px;
width: 24px;
text-align: right;
padding: 0px;
font-size: 16px !important;
}
#provat1{
height:21px;
padding: 0px;
text-align: left;
font-size: 16px !important;
}*/
#prointusymbol{
cursor: pointer;
}
#proimgintusymbol{
border-radius: 10px;
}
#protdfsize{
font-size:13px;
}
#protaxprefer{
height:48px !important;
}
#proflagicon{
width: max-content !important;
border: solid 2px #e9ecef;
height: 32px !important;
}
#proflagimg{
padding-top: 3.5px;
padding-bottom: 5px;
padding-left: 5px;
padding-right: 5px;
}
#protaxratecountry{
border:1px solid #fff !important;
background-color: #fff !important;
height: 21px !important;
padding-top: 11px !important;
}
#prointrahead{
height:48px !important;
}
@media screen and (max-width: 575px){
     #prointrahead{
 margin-top: 18px !important;
        }
}
    @media screen and (min-device-width: 992px) and (max-device-width: 3000px) {
      #productrate1{
    float:right !important;
    width:78% !important;
}
#proquantity1{
        float: right !important;
        width: 78% !important;
    }
#proproductrate1{
        float: right !important;
        width: 78% !important;
    }
#purproquantity1{
        float: right !important;
        width: 78% !important;
    }
#purproproductrate1{
        float: right !important;
        width: 78% !important;
    }
        .productnetvalue1{
        float: right !important;
        width: 78% !important;
        }
        .taxvalue1{
        float: right !important;
        width: 78% !important;
        }
    .productvalue1{
        float: right !important;
        width: 78% !important;
    }
    }
@media screen and (max-width: 991px) {
    .bigdrop{
        min-width: 149px !important;
        max-width: 150px !important;
    }
#selecttheproduct{
    width: 150px !important;
    display: inline-block !important;
}
.productselectwidth{
display: inline-block;
width: 146px !important;
height: 18.78px !important;
}
.select2-results__option{
    padding-left: 0px !important;
}
.select2-results__option tr{
padding-right: 6px !important;
}
    /*#ruppeitemtable{
        display: none !important;
    }
    #ruppeitemtablemob{
        display: block !important;
    }*/
table {
border: 0;
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
table thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
table td input{
font-size: 9px !important;
}
table td span{
font-size: 9px !important;
}
table td div{
font-size: 9px !important;
}
table td {
border-bottom: 1px solid #ddd;
display: block;
font-size: 9px !important;
text-align: right;
}
table td input{
    border: 1px solid #eee !important;
}
table td input:focus{
    border: 1px solid #3f94eb !important;
    outline: none !important;
    box-shadow: none !important;
    border-radius: 0px;
}
table td::before {
    color: grey !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 125px !important;
text-align: left !important;
font-size: 9px !important;
}
.select2-selection--single .select2-selection__rendered{
line-height: 18.5px !important;
}
.select2-container--default .select2-selection--single{
height: 19px !important;
}
    #loadimgins{
        width: 100% !important;
    }
table td:last-child {
border-bottom: 0;
}
}
.tfunit{
display: none !important;
}
.bigdrop {
width: 300px !important;
}
@media only screen and (max-width: 600px) {
.bigdrop {
width: 100% !important;
}
}
[aria-labelledby="select2-product1-container"]
{
border:none !important;
}
.foo:hover
{
color:#ffffff;
}
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
background-image: url("./assets/img/spin.gif");
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
<?php
}
?>
  <?php
if ($current_file_name=='adjustmentview.php') {
    ?>
#fullcontainerwidth{
     max-width: 1650px;

}
.card-body{
 font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;

}
#viewpro{
  font-size:20px;
}
#btnalignright{
float:right;
}
#btngopage{
margin-bottom:0rem;
margin-right:10px;
}
#datehis{
color:grey;
}
#chhis{
color:grey;
}
#infoheadsall{
font-size: 17px;;
}
#aligncenterall{
align-items: center;;
}
#insideheadall{
font-size:13px;
}
@media screen and (min-device-width: 725px) and (max-device-width: 3000px){
table th{
border: 1px solid #e9ecef !important;
}
}
@media screen and (max-width: 724px) 
{
  table {
    border: 0;
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
  .stockontable td::before {
    color: black !important;
  }
  #mobnotshow{
    display: none;
  }
  table td::before {
    color: #212529 !important;
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: 600;
    text-transform: uppercase;
  }
  
  table td:last-child {
    border-bottom: 0;
  }
}
.table td, .table th {
    white-space: normal;
}
          @media screen and (max-width: 600px){
            #newonetable{
                margin-left: -30px !important;
                margin-right: -30px !important;
            }
          }
<?php
}
?>
</style>
<style>
  <?php
if ($current_file_name=='expenses.php') {
    ?>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 724px) 
{
  .add{
    position: relative;
    top: 36px; 
  }
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
    height: 32.64px !important;
  }
  
  table td::before {
/*    color: grey !important;*/
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
<?php
}
?>
  <?php
if ($current_file_name=='expenseadd.php'||$current_file_name=='expenseedit.php') {
    ?>
    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }

    .select2 {
        width: 100% !important;
        background-color: #ffffff !important;
    }

    .modal-content {
        border-radius: 0px;
    }

    .modal-header {
        background: #F1F2F6;
        border-radius: 0;
    }

    .modal-title {
        font-weight: normal;
    }

    .select2-container--default .select2-selection--single {
        background-color: #ffffff !important;
        color: #495057;
        border: 1px solid #ced4da;
        height: 32px;
        border-radius: 2px;
    }
   .tree li {
     font-size:13px;
list-style-type:none;
margin:0;
padding:2px 5px 0 5px;
position:relative
}
.tree li::before, 
.tree li::after {
content:'';
left:-20px;
position:absolute;
right:auto
}
.tree li::before {
border-left:1px solid #ced4da;
bottom:50px;
height:100%;
top:0;
width:1px
}
.tree li::after {
border-top:1px solid #ced4da;
height:20px;
top:15px;
width:25px
}
.tree li span {
display:inline-block;
padding:3px 3px;
text-decoration:none;
cursor:pointer;
}
.tree>ul>li::before,
.tree>ul>li::after {
border:0
}
.tree li:last-child::before {
height:15px
}
.tree li span a
{
  text-decoration:none;
}
.tree li span:hover {
   
}
  .tree li span:hover a{
  color:white;
  }

[aria-expanded="false"] > .expanded,
[aria-expanded="true"] > .collapsed {
  display: none;
}
 
 .myinput::-webkit-input-placeholder {
font-size: 9.5px;
 }
.tfunit{
display: none !important;
}
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

background-image: url("./assets/img/spin.gif");
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
<?php
}
?>
  <?php
if ($current_file_name=='expenseview.php') {
    ?>
#fullcontainerwidth{
max-width: 1650px;

}
.card-body{
 font-family:'Myriad Set Pro','Helvetica Neue',Helvetica,Arial,sans-serif;

}
#viewpro{
  font-size:20px;
}
#btnalignright{
float:right;
}
#btngopage{
margin-bottom:0rem;
margin-right:10px;
}
#datehis{
color:grey;
}
#chhis{
color:grey;
}
#infoheadsall{
font-size: 17px;;
}
#aligncenterall{
align-items: center;;
}
#insideheadall{
font-size:13px;
}
<?php
}
?>
</style>
<style>
  <?php
if ($current_file_name=='manualjournals.php'||$current_file_name=='chartaccounts.php'||$current_file_name=='projects.php'||$current_file_name=='timesheet.php') {
    ?>
table tbody tr:nth-of-type(odd) { 
  
}
@media screen and (max-width: 777px) 
{
  .add{
    position: relative;
    top: 36px; 
  }
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
    height: 32.64px !important;
  }
  
  table td::before {
/*    color: grey !important;*/
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  table td:last-child {
    border-bottom: 0;
  }
}
<?php
}
?>
</style>
<style>
  <?php
if ($current_file_name=='manualjournaladd.php') {
    ?>
#footer {
background-color: #ffffff;
width: 84%;
position: fixed;
bottom: 0px;
height: 50px;
margin-bottom: 0px;
Padding-top: 0px;
margin-left: -15px;
margin-right: -15px;
border: 1px solid #eee;
  -webkit-box-shadow: 0px -4px 3px #e9ecef;
  -moz-box-shadow: 0px -4px 3px #e9ecef;
  box-shadow: 0 -4px 5px -3px rgb(0 0 0 / 10%);
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
padding-right: 5px;
}
input[type="number"]::placeholder {
/* Firefox, Chrome, Opera */
text-align: right;
}
#subtotal {
text-align: right;
}
input[type=number] {
text-align: right;
padding: 1px 3px !important;
}
.input-group-text {
border: none;
border-radius: 0px;
}
.form-control {
padding: 1px 8px;
height: 25px;
}
.form-control-sm {
padding: 1px 8px;
}
table tbody tr:nth-of-type(odd) {}
.inpbordes:focus {
border: 1px solid #3f94eb !important;
box-shadow: none;
}
.inpbordes {
border: 1px solid #eee !important;
box-shadow: none;
}
table td {
padding-bottom: 4px !important;
}
@media screen and (max-width: 600px) {
table {
border: 0;
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
table thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
table td {
border-bottom: 1px solid #ddd;
display: block;
font-size: .8em;
text-align: right;
height: 32.64px !important;
}
table td::before {
    color: grey !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: max-content !important;
text-align: left !important;
}
    #loadimgins{
        width: 100% !important;
    }
#chartaccountname1{
    width: 86px !important;
    text-align: right !important;
    float: right !important;
}
#customername1{
    width: 86px !important;
    text-align: right !important;
    float: right !important;
}
table td:last-child {
border-bottom: 0;
}
}
.table> :not(caption)>*>* {
background-color: #ffffff;
box-shadow: none;
}
.table> :not(:last-child)> :last-child>* {
border-bottom-color: #e9ecef;
font-size: 12px !important;
}
.input-group .form-control:not(:first-child) {
border-left: 0;
padding-left: 5px;
}
a .customcont-heading1 {
margin-left: 30px;
}
.form-control-bn:focus {
border: none !important;
box-shadow: none;
}
.input-group .form-control-bn:focus {
border: none !important;
box-shadow: none;
}
table thead th {
height: 10px;
vertical-align: top;
}
@media screen and (min-device-width: 300px) and (max-device-width: 768px) {
.mobview {
padding-left: 30px;
}
}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
.imagePreview {
width: 100%;
}
}
@media only screen and (max-width: 300px) {
.select2-container {
width: 90px !important;
margin-top: 3px;
}
.select2-dropdown--below
  {
  width: none !important;
  }
#fulla {
padding-left: 12px !important;
}
}
.table-hover>tbody>tr:hover {
--bs-table-accent-bg: #FFFFFF;
color: var(--bs-table-hover-color);
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#city {
margin-top: 15px
}
}
.customcont-heading{
padding-bottom: 5px;font-size: 15px;
}
hr{
margin-bottom:16px;
}
.table> :not(caption)>*>* {
padding-top: 4px;
padding-bottom: 2px;
}
.addan:hover {
background-color: #b7bbc0 !important;
}
.dropdown-toggle{
content: "\f107";
}

.form-group {
    margin-bottom: 0.5rem;
}
.bordernoneinput:focus{
    outline: none;
  border-color: inherit;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.bordernoneinput{
    border: none;
}
#gsttable td,th
{
padding:1px;;
}
<?php
}
?>
  <?php
if ($current_file_name=='manualjournalview.php') {
    ?>
.myinput::-webkit-input-placeholder {
font-size: 9.5px;
}
.select2 {
width: 100% !important;
background-color: #ffffff !important;
}
.modal-content {
border-radius: 0px;
}
.modal-header {
background: #F1F2F6;
border-radius: 0;
}
.modal-title {
font-weight: normal;
}
.select2-container--default .select2-selection--single {
background-color: #ffffff !important;
color: #495057;
border: 1px solid #ced4da;
height: 25px;
border-radius: 2px;
}
.btn_upload {
cursor: pointer;
display: inline-block;
overflow: hidden;
position: relative;
color: #fff;
background-color: #fff;
border: none;
}
.btn_upload:hover,
.btn_upload:focus {
background-color: #fff;
}
.yes {
display: flex;
align-items: flex-start;
margin-top: 10px !important;
}
.btn_upload input {
cursor: pointer;
height: 100%;
position: absolute;
filter: alpha(opacity=1);
-moz-opacity: 0;
opacity: 0;
}
.it {
height: 100px;
margin-left: 10px;
}
.accordion-button:not(.collapsed)::after
{
background-image: url("");
}
.mb-3 {
margin-bottom: -5px !important;
}
#removeImage1,
#removeImage2,
#removeImage3,
#removeImage4,
#removeImage5 {
color: #6c757d;
}
#removeImage1:hover {
color: black;
}
#removeImage2:hover {
color: black;
}
#removeImage3:hover {
color: black;
}
#removeImage4:hover {
color: black;
}
#removeImage5:hover {
color: black;
}
.rmv {
cursor: pointer;
color: #fff;
border-radius: 30px;
border: 1px solid #fff;
display: inline-block;
background: rgba(255, 0, 0, 1);
margin: -5px -10px;
}
.rmv:hover {
background: rgba(255, 0, 0, 0.5);
}
.item-actions-container .item-actions {
position: absolute;
right: -50px;
top: -20px;
}
.icon-cancel-circled {
color: #fab2b1;
}
svg.icon.icon-sm {
height: 14px;
width: 14px;
}
td:hover {
cursor: move;
}
.imagePreview {
width: 200px;
height: 140px;
background-position: center center;
background-color: #fff;
background-size: cover;
background-repeat: no-repeat;
text-align: center;
}
.btn-custom-grey:hover i {
color: #ffffff !important;
}
.btn-custom-grey:active, .btn-custom-grey:focus, .btn-custom-grey:hover {
background-color: #f8f8f8;
border-color: #c6c6c6;
}
/*.btn-custom:hover {
background-color: #ed0707 !important;
border-color: #c6c6c6;
}*/
.selectdesign {
width: 6px;
padding-right: 0px;
padding-left: 10px;
padding-bottom: 1px;
border-top-width: 2px;
background-color: #f5f5f5;
}
.dash {
border: 0 none;
border-top: 2px dashed #322f32;
background: none;
height: 0;
margin-top: 0px;
width: 60px;
}
thead tr th {
color: black !important;
text-align: left !important;
}
.basicaddon1 {
padding-right: 8px;
padding-left: 8px;
padding-top: 5px;
padding-bottom: 5px;
background-color: #e9ecef;
border-bottom: 2px solid #e9ecef;
}
.form-control:disabled,
.form-control[readonly] {
background-color: #e9ecef;
opacity: 1;
}
/*#footer {
position:fixed;
bottom: 0px;
width: 100%;
background-color:#ffffff;
left:0;
text-align:center;
border-top:1px solid #eeeeee;
}*/

#footer {
position:fixed;
bottom: 0px;
width: 81.81%;
background-color:#ffffff;
left:0;
margin-left: 223px;
margin-right: -15px;
text-align:center;
padding-top: 10px;
border-top:1px solid #eeeeee;
box-shadow: 9px 9px 9px 9px lightgrey;
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
padding-right: 5px;
}
input[type="number"]::placeholder {
/* Firefox, Chrome, Opera */
text-align: right;
}
#subtotal {
text-align: right;
}
input[type=number] {
text-align: right;
}
.input-group-text {
border: none;
border-radius: 0px;
}
.form-control {
padding: 1px 8px;
height: 25px;
}
.form-control-sm {
padding: 1px 8px;
}
@media screen and (min-device-width: 300px) and (max-device-width: 768px) {
.mobview {
padding-left: 30px;
}
}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
.imagePreview {
width: 100%;
}
}
@media only screen and (max-width: 300px) {
.select2-container {
width: 90px !important;
margin-top: 3px;
}
.select2-dropdown--below
  {
  width: none !important;
  }
#fulla {
padding-left: 12px !important;
}
}
.table-hover>tbody>tr:hover {
--bs-table-accent-bg: #FFFFFF;
color: var(--bs-table-hover-color);
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#city {
margin-top: 15px
}
}
.customcont-heading{
padding-bottom: 5px;font-size: 15px;
}
hr{
margin-bottom:16px;
}
.table> :not(caption)>*>* {
padding-top: 4px;
padding-bottom: 2px;
}
.addan:hover {
background-color: #b7bbc0 !important;
}
.dropdown-toggle{
content: "\f107";
}

.form-group {
    margin-bottom: 0.5rem;
}
.bordernoneinput:focus{
    outline: none;
  border-color: inherit;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.bordernoneinput{
    border: none;
}
@media screen and (max-width: 600px) {
.mtcolumn
{
  margin-top:15px;
}
}
.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
}
<?php
}
?>
  <?php
if ($current_file_name=='chartaccountadd.php') {
    ?>
    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }

    .select2 {
        width: 100% !important;
        background-color: #ffffff !important;
    }

    .modal-content {
        border-radius: 0px;
    }

    .modal-header {
        background: #F1F2F6;
        border-radius: 0;
    }

    .modal-title {
        font-weight: normal;
    }

    .select2-container--default .select2-selection--single {
        background-color: #ffffff !important;
        color: #495057;
        border: 1px solid #ced4da;
        height: 32px;
        border-radius: 2px;
    }
   .tree li {
     font-size:13px;
list-style-type:none;
margin:0;
padding:2px 5px 0 5px;
position:relative
}
.tree li::before, 
.tree li::after {
content:'';
left:-20px;
position:absolute;
right:auto
}
.tree li::before {
border-left:1px solid #ced4da;
bottom:50px;
height:100%;
top:0;
width:1px
}
.tree li::after {
border-top:1px solid #ced4da;
height:20px;
top:15px;
width:25px
}
.tree li span {
display:inline-block;
padding:3px 3px;
text-decoration:none;
cursor:pointer;
}
.tree>ul>li::before,
.tree>ul>li::after {
border:0
}
.tree li:last-child::before {
height:15px
}
.tree li span a
{
  text-decoration:none;
}
.tree li span:hover {
   
}
  .tree li span:hover a{
  color:white;
  }

[aria-expanded="false"] > .expanded,
[aria-expanded="true"] > .collapsed {
  display: none;
}
 
 .myinput::-webkit-input-placeholder {
font-size: 9.5px;
 }
.tfunit{
display: none !important;
}
<?php
}
?>
  <?php
if ($current_file_name=='chartaccountedit.php') {
    ?>
    .myinput::-webkit-input-placeholder {
        font-size: 9.5px;
    }

    .select2 {
        width: 100% !important;
        background-color: #ffffff !important;
    }

    .modal-content {
        border-radius: 0px;
    }

    .modal-header {
        background: #F1F2F6;
        border-radius: 0;
    }

    .modal-title {
        font-weight: normal;
    }

    .select2-container--default .select2-selection--single {
        background-color: #ffffff !important;
        color: #495057;
        border: 1px solid #ced4da;
        height: 32px;
        border-radius: 2px;
    }
   .tree li {
     font-size:13px;
    list-style-type:none;
    margin:0;
    padding:2px 5px 0 5px;
    position:relative
}
.tree li::before, 
.tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:1px solid #ced4da;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:1px solid #ced4da;
    height:20px;
    top:15px;
    width:25px
}
.tree li span {
    display:inline-block;
    padding:3px 3px;
    text-decoration:none;
    cursor:pointer;
}
.tree>ul>li::before,
.tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:15px
}
.tree li span a
{
  text-decoration:none;
}
.tree li span:hover {
   
    }
  .tree li span:hover a{
  color:white;
  }

[aria-expanded="false"] > .expanded,
[aria-expanded="true"] > .collapsed {
  display: none;
}
 
 .myinput::-webkit-input-placeholder {
    font-size: 9.5px;
 }
.tfunit{
display: none !important;
}
<?php
}
?>
  <?php
if ($current_file_name=='projectadd.php') {
    ?>
.myinput::-webkit-input-placeholder {
font-size: 9.5px;
}
.select2 {
width: 100% !important;
background-color: #ffffff !important;
}
.modal-content {
border-radius: 0px;
}
.modal-header {
background: #F1F2F6;
border-radius: 0;
}
.modal-title {
font-weight: normal;
}
.select2-container--default .select2-selection--single {
background-color: #ffffff !important;
color: #495057;
border: 1px solid #ced4da;
height: 25px;
border-radius: 2px;
}
.btn_upload {
cursor: pointer;
display: inline-block;
overflow: hidden;
position: relative;
color: #fff;
background-color: #fff;
border: none;
}
.btn_upload:hover,
.btn_upload:focus {
background-color: #fff;
}
.yes {
display: flex;
align-items: flex-start;
margin-top: 10px !important;
}
.btn_upload input {
cursor: pointer;
height: 100%;
position: absolute;
filter: alpha(opacity=1);
-moz-opacity: 0;
opacity: 0;
}
.it {
height: 100px;
margin-left: 10px;
}
.accordion-button:not(.collapsed)::after
{
background-image: url("");
}
.mb-3 {
margin-bottom: -5px !important;
}
#removeImage1,
#removeImage2,
#removeImage3,
#removeImage4,
#removeImage5 {
color: #6c757d;
}
#removeImage1:hover {
color: black;
}
#removeImage2:hover {
color: black;
}
#removeImage3:hover {
color: black;
}
#removeImage4:hover {
color: black;
}
#removeImage5:hover {
color: black;
}
.rmv {
cursor: pointer;
color: #fff;
border-radius: 30px;
border: 1px solid #fff;
display: inline-block;
background: rgba(255, 0, 0, 1);
margin: -5px -10px;
}
.rmv:hover {
background: rgba(255, 0, 0, 0.5);
}
.item-actions-container .item-actions {
position: absolute;
right: -50px;
top: -20px;
}
.icon-cancel-circled {
color: #fab2b1;
}
svg.icon.icon-sm {
height: 14px;
width: 14px;
}
td:hover {
cursor: move;
}
.imagePreview {
width: 200px;
height: 140px;
background-position: center center;
background-color: #fff;
background-size: cover;
background-repeat: no-repeat;
text-align: center;
}
.btn-custom-grey:hover i {
color: #ffffff !important;
}
.btn-custom-grey:active, .btn-custom-grey:focus, .btn-custom-grey:hover {
background-color: #f8f8f8;
border-color: #c6c6c6;
}
/*.btn-custom:hover {
background-color: #ed0707 !important;
border-color: #c6c6c6;
}*/
.selectdesign {
width: 6px;
padding-right: 0px;
padding-left: 10px;
padding-bottom: 1px;
border-top-width: 2px;
background-color: #f5f5f5;
}
.dash {
border: 0 none;
border-top: 2px dashed #322f32;
background: none;
height: 0;
margin-top: 0px;
width: 60px;
}
thead tr th {
color: black !important;
text-align: left !important;
}
.basicaddon1 {
padding-right: 8px;
padding-left: 8px;
padding-top: 5px;
padding-bottom: 5px;
background-color: #e9ecef;
border-bottom: 2px solid #e9ecef;
}
.form-control:disabled,
.form-control[readonly] {
background-color: #e9ecef;
opacity: 1;
}
#footer {
background-color: #ffffff;
width: 84%;
position: fixed;
bottom: 0px;
height: 50px;
margin-bottom: 0px;
Padding-top: 0px;
margin-left: -15px;
margin-right: -15px;
border: 1px solid #eee;
  -webkit-box-shadow: 0px -4px 3px #e9ecef;
  -moz-box-shadow: 0px -4px 3px #e9ecef;
  box-shadow: 0 -4px 5px -3px rgb(0 0 0 / 10%);
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
padding-right: 5px;
}
input[type="number"]::placeholder {
/* Firefox, Chrome, Opera */
text-align: right;
}
#subtotal {
text-align: right;
}
input[type=number] {
text-align: right;
}
.input-group-text {
border: none;
border-radius: 0px;
}
.form-control {
padding: 1px 8px;
height: 25px;
}
.form-control-sm {
padding: 1px 8px;
}
table tbody tr:nth-of-type(odd) {}
@media screen and (max-width: 600px) {
table {
border: 0;
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
table thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
table td {
border-bottom: 1px solid #ddd;
display: block;
font-size: .8em;
text-align: right;
}
table td::before {
    color: grey !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
}
    #loadimgins{
        width: 100% !important;
    }
table td:last-child {
border-bottom: 0;
}
}
.table> :not(caption)>*>* {
background-color: #ffffff;
box-shadow: none;
}
.table> :not(:last-child)> :last-child>* {
border-bottom-color: #e9ecef;
font-size: 12px !important;
}
.input-group .form-control:not(:first-child) {
border-left: 0;
padding-left: 5px;
}
a .customcont-heading1 {
margin-left: 30px;
}
.form-control-bn:focus {
border: none !important;
box-shadow: none;
}
.input-group .form-control-bn:focus {
border: none !important;
box-shadow: none;
}
table thead th {
height: 10px;
vertical-align: top;
}
@media screen and (min-device-width: 300px) and (max-device-width: 768px) {
.mobview {
padding-left: 30px;
}
}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
.imagePreview {
width: 100%;
}
}
@media only screen and (max-width: 300px) {
.select2-container {
width: 90px !important;
margin-top: 3px;
}
.select2-dropdown--below
  {
  width: none !important;
  }
#fulla {
padding-left: 12px !important;
}
}
.table-hover>tbody>tr:hover {
--bs-table-accent-bg: #FFFFFF;
color: var(--bs-table-hover-color);
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#city {
margin-top: 15px
}
}
.customcont-heading{
padding-bottom: 5px;font-size: 15px;
}
hr{
margin-bottom:16px;
}
.table> :not(caption)>*>* {
padding-top: 4px;
padding-bottom: 2px;
}
.addan:hover {
background-color: #b7bbc0 !important;
}
.dropdown-toggle{
content: "\f107";
}

.form-group {
    margin-bottom: 0.5rem;
}
.bordernoneinput:focus{
    outline: none;
  border-color: inherit;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.bordernoneinput{
    border: none;
}
<?php
}
?>
  <?php
if ($current_file_name=='projectedit.php') {
    ?>
.myinput::-webkit-input-placeholder {
font-size: 9.5px;
}
.select2 {
width: 100% !important;
background-color: #ffffff !important;
}
.modal-content {
border-radius: 0px;
}
.modal-header {
background: #F1F2F6;
border-radius: 0;
}
.modal-title {
font-weight: normal;
}
.select2-container--default .select2-selection--single {
background-color: #ffffff !important;
color: #495057;
border: 1px solid #ced4da;
height: 25px;
border-radius: 2px;
}
.btn_upload {
cursor: pointer;
display: inline-block;
overflow: hidden;
position: relative;
color: #fff;
background-color: #fff;
border: none;
}
.btn_upload:hover,
.btn_upload:focus {
background-color: #fff;
}
.yes {
display: flex;
align-items: flex-start;
margin-top: 10px !important;
}
.btn_upload input {
cursor: pointer;
height: 100%;
position: absolute;
filter: alpha(opacity=1);
-moz-opacity: 0;
opacity: 0;
}
.it {
height: 100px;
margin-left: 10px;
}
.accordion-button:not(.collapsed)::after
{
background-image: url("");
}
.mb-3 {
margin-bottom: -5px !important;
}
#removeImage1,
#removeImage2,
#removeImage3,
#removeImage4,
#removeImage5 {
color: #6c757d;
}
#removeImage1:hover {
color: black;
}
#removeImage2:hover {
color: black;
}
#removeImage3:hover {
color: black;
}
#removeImage4:hover {
color: black;
}
#removeImage5:hover {
color: black;
}
.rmv {
cursor: pointer;
color: #fff;
border-radius: 30px;
border: 1px solid #fff;
display: inline-block;
background: rgba(255, 0, 0, 1);
margin: -5px -10px;
}
.rmv:hover {
background: rgba(255, 0, 0, 0.5);
}
.item-actions-container .item-actions {
position: absolute;
right: -50px;
top: -20px;
}
.icon-cancel-circled {
color: #fab2b1;
}
svg.icon.icon-sm {
height: 14px;
width: 14px;
}
td:hover {
cursor: move;
}
.imagePreview {
width: 200px;
height: 140px;
background-position: center center;
background-color: #fff;
background-size: cover;
background-repeat: no-repeat;
text-align: center;
}
.btn-custom-grey:hover i {
color: #ffffff !important;
}
.btn-custom-grey:active, .btn-custom-grey:focus, .btn-custom-grey:hover {
background-color: #f8f8f8;
border-color: #c6c6c6;
}
/*.btn-custom:hover {
background-color: #ed0707 !important;
border-color: #c6c6c6;
}*/
.selectdesign {
width: 6px;
padding-right: 0px;
padding-left: 10px;
padding-bottom: 1px;
border-top-width: 2px;
background-color: #f5f5f5;
}
.dash {
border: 0 none;
border-top: 2px dashed #322f32;
background: none;
height: 0;
margin-top: 0px;
width: 60px;
}
thead tr th {
color: black !important;
text-align: left !important;
}
.basicaddon1 {
padding-right: 8px;
padding-left: 8px;
padding-top: 5px;
padding-bottom: 5px;
background-color: #e9ecef;
border-bottom: 2px solid #e9ecef;
}
.form-control:disabled,
.form-control[readonly] {
background-color: #e9ecef;
opacity: 1;
}
/*#footer {
position:fixed;
bottom: 0px;
width: 100%;
background-color:#ffffff;
left:0;
text-align:center;
border-top:1px solid #eeeeee;
}*/

#footer {
position:fixed;
bottom: 0px;
width: 81.81%;
background-color:#ffffff;
left:0;
margin-left: 223px;
margin-right: -15px;
text-align:center;
padding-top: 10px;
border-top:1px solid #eeeeee;
box-shadow: 9px 9px 9px 9px lightgrey;
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
padding-right: 5px;
}
input[type="number"]::placeholder {
/* Firefox, Chrome, Opera */
text-align: right;
}
#subtotal {
text-align: right;
}
input[type=number] {
text-align: right;
}
.input-group-text {
border: none;
border-radius: 0px;
}
.form-control {
padding: 1px 8px;
height: 25px;
}
.form-control-sm {
padding: 1px 8px;
}
@media screen and (min-device-width: 300px) and (max-device-width: 768px) {
.mobview {
padding-left: 30px;
}
}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
.imagePreview {
width: 100%;
}
}
@media only screen and (max-width: 300px) {
.select2-container {
width: 90px !important;
margin-top: 3px;
}
.select2-dropdown--below
  {
  width: none !important;
  }
#fulla {
padding-left: 12px !important;
}
}
.table-hover>tbody>tr:hover {
--bs-table-accent-bg: #FFFFFF;
color: var(--bs-table-hover-color);
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#city {
margin-top: 15px
}
}
.customcont-heading{
padding-bottom: 5px;font-size: 15px;
}
hr{
margin-bottom:16px;
}
.table> :not(caption)>*>* {
padding-top: 4px;
padding-bottom: 2px;
}
.addan:hover {
background-color: #b7bbc0 !important;
}
.dropdown-toggle{
content: "\f107";
}

.form-group {
    margin-bottom: 0.5rem;
}
.bordernoneinput:focus{
    outline: none;
  border-color: inherit;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.bordernoneinput{
    border: none;
}
@media screen and (max-width: 600px) {
.mtcolumn
{
  margin-top:15px;
}
}
.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
}
<?php
}
?>
  <?php
if ($current_file_name=='projectview.php') {
    ?>
.myinput::-webkit-input-placeholder {
font-size: 9.5px;
}
.select2 {
width: 100% !important;
background-color: #ffffff !important;
}
.modal-content {
border-radius: 0px;
}
.modal-header {
background: #F1F2F6;
border-radius: 0;
}
.modal-title {
font-weight: normal;
}
.select2-container--default .select2-selection--single {
background-color: #ffffff !important;
color: #495057;
border: 1px solid #ced4da;
height: 25px;
border-radius: 2px;
}
.btn_upload {
cursor: pointer;
display: inline-block;
overflow: hidden;
position: relative;
color: #fff;
background-color: #fff;
border: none;
}
.btn_upload:hover,
.btn_upload:focus {
background-color: #fff;
}
.yes {
display: flex;
align-items: flex-start;
margin-top: 10px !important;
}
.btn_upload input {
cursor: pointer;
height: 100%;
position: absolute;
filter: alpha(opacity=1);
-moz-opacity: 0;
opacity: 0;
}
.it {
height: 100px;
margin-left: 10px;
}
.accordion-button:not(.collapsed)::after
{
background-image: url("");
}
.mb-3 {
margin-bottom: -5px !important;
}
#removeImage1,
#removeImage2,
#removeImage3,
#removeImage4,
#removeImage5 {
color: #6c757d;
}
#removeImage1:hover {
color: black;
}
#removeImage2:hover {
color: black;
}
#removeImage3:hover {
color: black;
}
#removeImage4:hover {
color: black;
}
#removeImage5:hover {
color: black;
}
.rmv {
cursor: pointer;
color: #fff;
border-radius: 30px;
border: 1px solid #fff;
display: inline-block;
background: rgba(255, 0, 0, 1);
margin: -5px -10px;
}
.rmv:hover {
background: rgba(255, 0, 0, 0.5);
}
.item-actions-container .item-actions {
position: absolute;
right: -50px;
top: -20px;
}
.icon-cancel-circled {
color: #fab2b1;
}
svg.icon.icon-sm {
height: 14px;
width: 14px;
}
td:hover {
cursor: move;
}
.imagePreview {
width: 200px;
height: 140px;
background-position: center center;
background-color: #fff;
background-size: cover;
background-repeat: no-repeat;
text-align: center;
}
.btn-custom-grey:hover i {
color: #ffffff !important;
}
.btn-custom-grey:active, .btn-custom-grey:focus, .btn-custom-grey:hover {
background-color: #f8f8f8;
border-color: #c6c6c6;
}
/*.btn-custom:hover {
background-color: #ed0707 !important;
border-color: #c6c6c6;
}*/
.selectdesign {
width: 6px;
padding-right: 0px;
padding-left: 10px;
padding-bottom: 1px;
border-top-width: 2px;
background-color: #f5f5f5;
}
.dash {
border: 0 none;
border-top: 2px dashed #322f32;
background: none;
height: 0;
margin-top: 0px;
width: 60px;
}
thead tr th {
color: black !important;
text-align: left !important;
}
.basicaddon1 {
padding-right: 8px;
padding-left: 8px;
padding-top: 5px;
padding-bottom: 5px;
background-color: #e9ecef;
border-bottom: 2px solid #e9ecef;
}
.form-control:disabled,
.form-control[readonly] {
background-color: #e9ecef;
opacity: 1;
}
/*#footer {
position:fixed;
bottom: 0px;
width: 100%;
background-color:#ffffff;
left:0;
text-align:center;
border-top:1px solid #eeeeee;
}*/

#footer {
position:fixed;
bottom: 0px;
width: 81.81%;
background-color:#ffffff;
left:0;
margin-left: 223px;
margin-right: -15px;
text-align:center;
padding-top: 10px;
border-top:1px solid #eeeeee;
box-shadow: 9px 9px 9px 9px lightgrey;
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
padding-right: 5px;
}
input[type="number"]::placeholder {
/* Firefox, Chrome, Opera */
text-align: right;
}
#subtotal {
text-align: right;
}
input[type=number] {
text-align: right;
}
.input-group-text {
border: none;
border-radius: 0px;
}
.form-control {
padding: 1px 8px;
height: 25px;
}
.form-control-sm {
padding: 1px 8px;
}
@media screen and (min-device-width: 300px) and (max-device-width: 768px) {
.mobview {
padding-left: 30px;
}
}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
.imagePreview {
width: 100%;
}
}
@media only screen and (max-width: 300px) {
.select2-container {
width: 90px !important;
margin-top: 3px;
}
.select2-dropdown--below
  {
  width: none !important;
  }
#fulla {
padding-left: 12px !important;
}
}
.table-hover>tbody>tr:hover {
--bs-table-accent-bg: #FFFFFF;
color: var(--bs-table-hover-color);
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#city {
margin-top: 15px
}
}
.customcont-heading{
padding-bottom: 5px;font-size: 15px;
}
hr{
margin-bottom:16px;
}
.table> :not(caption)>*>* {
padding-top: 4px;
padding-bottom: 2px;
}
.addan:hover {
background-color: #b7bbc0 !important;
}
.dropdown-toggle{
content: "\f107";
}

.form-group {
    margin-bottom: 0.5rem;
}
.bordernoneinput:focus{
    outline: none;
  border-color: inherit;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.bordernoneinput{
    border: none;
}
@media screen and (max-width: 600px) {
.mtcolumn
{
  margin-top:15px;
}
}
.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
}
<?php
}
?>
  <?php
if ($current_file_name=='manualjournaledit.php') {
    ?>
.myinput::-webkit-input-placeholder {
font-size: 9.5px;
}
.select2 {
width: 100% !important;
background-color: #ffffff !important;
}
.modal-content {
border-radius: 0px;
}
.modal-header {
background: #F1F2F6;
border-radius: 0;
}
.modal-title {
font-weight: normal;
}
.select2-container--default .select2-selection--single {
background-color: #ffffff !important;
color: #495057;
border: 1px solid #ced4da;
height: 25px;
border-radius: 2px;
}
.btn_upload {
cursor: pointer;
display: inline-block;
overflow: hidden;
position: relative;
color: #fff;
background-color: #fff;
border: none;
}
.btn_upload:hover,
.btn_upload:focus {
background-color: #fff;
}
.yes {
display: flex;
align-items: flex-start;
margin-top: 10px !important;
}
.btn_upload input {
cursor: pointer;
height: 100%;
position: absolute;
filter: alpha(opacity=1);
-moz-opacity: 0;
opacity: 0;
}
.it {
height: 100px;
margin-left: 10px;
}
.accordion-button:not(.collapsed)::after
{
background-image: url("");
}
.mb-3 {
margin-bottom: -5px !important;
}
#removeImage1,
#removeImage2,
#removeImage3,
#removeImage4,
#removeImage5 {
color: #6c757d;
}
#removeImage1:hover {
color: black;
}
#removeImage2:hover {
color: black;
}
#removeImage3:hover {
color: black;
}
#removeImage4:hover {
color: black;
}
#removeImage5:hover {
color: black;
}
.rmv {
cursor: pointer;
color: #fff;
border-radius: 30px;
border: 1px solid #fff;
display: inline-block;
background: rgba(255, 0, 0, 1);
margin: -5px -10px;
}
.rmv:hover {
background: rgba(255, 0, 0, 0.5);
}
.item-actions-container .item-actions {
position: absolute;
right: -50px;
top: -20px;
}
.icon-cancel-circled {
color: #fab2b1;
}
svg.icon.icon-sm {
height: 14px;
width: 14px;
}
td:hover {
cursor: move;
}
.imagePreview {
width: 200px;
height: 140px;
background-position: center center;
background-color: #fff;
background-size: cover;
background-repeat: no-repeat;
text-align: center;
}
.btn-custom-grey:hover i {
color: #ffffff !important;
}
.btn-custom-grey:active, .btn-custom-grey:focus, .btn-custom-grey:hover {
background-color: #f8f8f8;
border-color: #c6c6c6;
}
/*.btn-custom:hover {
background-color: #ed0707 !important;
border-color: #c6c6c6;
}*/
.selectdesign {
width: 6px;
padding-right: 0px;
padding-left: 10px;
padding-bottom: 1px;
border-top-width: 2px;
background-color: #f5f5f5;
}
.dash {
border: 0 none;
border-top: 2px dashed #322f32;
background: none;
height: 0;
margin-top: 0px;
width: 60px;
}
thead tr th {
color: black !important;
text-align: left !important;
}
.basicaddon1 {
padding-right: 8px;
padding-left: 8px;
padding-top: 5px;
padding-bottom: 5px;
background-color: #e9ecef;
border-bottom: 2px solid #e9ecef;
}
.form-control:disabled,
.form-control[readonly] {
background-color: #e9ecef;
opacity: 1;
}
/*#footer {
position:fixed;
bottom: 0px;
width: 100%;
background-color:#ffffff;
left:0;
text-align:center;
border-top:1px solid #eeeeee;
}*/

#footer {
position:fixed;
bottom: 0px;
width: 81.81%;
background-color:#ffffff;
left:0;
margin-left: 223px;
margin-right: -15px;
text-align:center;
padding-top: 10px;
border-top:1px solid #eeeeee;
box-shadow: 9px 9px 9px 9px lightgrey;
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
-webkit-appearance: none;
margin: 0;
padding-right: 5px;
}
input[type="number"]::placeholder {
/* Firefox, Chrome, Opera */
text-align: right;
}
#subtotal {
text-align: right;
}
input[type=number] {
text-align: right;
padding: 1px 3px !important;
}
.input-group-text {
border: none;
border-radius: 0px;
}
.form-control {
padding: 1px 8px;
height: 25px;
}
.form-control-sm {
padding: 1px 8px;
}
@media screen and (min-device-width: 300px) and (max-device-width: 768px) {
.mobview {
padding-left: 30px;
}
}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {}
@media only screen and (min-device-width: 300px) and (max-device-width: 768px) {
.imagePreview {
width: 100%;
}
}
@media only screen and (max-width: 300px) {
.select2-container {
width: 90px !important;
margin-top: 3px;
}
.select2-dropdown--below
  {
  width: none !important;
  }
#fulla {
padding-left: 12px !important;
}
}
.table-hover>tbody>tr:hover {
--bs-table-accent-bg: #FFFFFF;
color: var(--bs-table-hover-color);
}
@media screen and (min-device-width: 300px) and (max-device-width: 575px) {
#city {
margin-top: 15px
}
}
.customcont-heading{
padding-bottom: 5px;font-size: 15px;
}
hr{
margin-bottom:16px;
}
.table> :not(caption)>*>* {
padding-top: 4px;
padding-bottom: 2px;
}
.addan:hover {
background-color: #b7bbc0 !important;
}
.dropdown-toggle{
content: "\f107";
}

.form-group {
    margin-bottom: 0.5rem;
}
.bordernoneinput:focus{
    outline: none;
  border-color: inherit;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.bordernoneinput{
    border: none;
}
@media screen and (max-width: 600px) {
.mtcolumn
{
  margin-top:15px;
}
}
.form-control:disabled, .form-control[readonly] {
    background-color: #ffffff;
}
table tbody tr:nth-of-type(odd) {}
.inpbordes:focus {
border: 1px solid #3f94eb !important;
box-shadow: none;
}
.inpbordes {
border: 1px solid #eee !important;
box-shadow: none;
}
table td {
padding-bottom: 4px !important;
}
@media screen and (max-width: 600px) {
table {
border: 0;
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
table thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
table td {
border-bottom: 1px solid #ddd;
display: block;
font-size: .8em;
text-align: right;
height: 32.64px !important;
}
table td::before {
    color: grey !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: max-content !important;
text-align: left !important;
}
    #loadimgins{
        width: 100% !important;
    }
#chartaccountname1{
    width: 86px !important;
    text-align: right !important;
    float: right !important;
}
#customername1{
    width: 86px !important;
    text-align: right !important;
    float: right !important;
}
table td:last-child {
border-bottom: 0;
}
}
.table> :not(caption)>*>* {
background-color: #ffffff;
box-shadow: none;
}
.table> :not(:last-child)> :last-child>* {
border-bottom-color: #e9ecef;
font-size: 12px !important;
}
.input-group .form-control:not(:first-child) {
border-left: 0;
padding-left: 5px;
}
a .customcont-heading1 {
margin-left: 30px;
}
.form-control-bn:focus {
border: none !important;
box-shadow: none;
}
.input-group .form-control-bn:focus {
border: none !important;
box-shadow: none;
}
table thead th {
height: 10px;
vertical-align: top;
}
#gsttable td,th
{
padding:1px;;
}
<?php
}
?>
  <?php
if ($current_file_name=='manualjournaladd.php'||$current_file_name=='manualjournaledit.php'||$current_file_name=='manualjournalview.php'||$current_file_name=='chartaccountadd.php'||$current_file_name=='chartaccountedit.php'||$current_file_name=='projectadd.php'||$current_file_name=='projectedit.php'||$current_file_name=='projectview.php') {
    ?>
    @media screen and (min-device-width: 992px) and (max-device-width: 3000px) {
    #purchasetable{
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable thead:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable tbody:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable th:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable td:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td  , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    }
    #purchasetable tr:not(.select2-container--default .subtextfoo td  tr  tbody , .dvi div td , .dvi div tr){
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable input{
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable textarea{
      border: 1px solid #e1dbdb !important;
    }
    #purchasetable select{
      border: 1px solid #e1dbdb !important;
    }
    .select2-container--default .subtextfoo td  tr  tbody{
      border: none !important;
    }
<?php
if ($current_file_name!='chartaccountadd.php'&&$current_file_name!='chartaccountedit.php') {
?>
.select4-container--default .select4-selection--single{
height: 25px !important;
}
.select4-container--default .select4-selection--single .select4-selection__rendered{
line-height: 23px !important;
}
<?php
}
?>
    #purchasetable input{
      font-size: 14px;
    }
    #purchasetable textarea{
      font-size: 14px;
    }
    #purchasetable select{
      font-size: 14px;
    }
@media screen and (max-width: 991px) {
    #purchasetable input{
      font-size: 11.2px !important;
    }
    #purchasetable textarea{
      font-size: 11.2px !important;
    }
    #purchasetable select{
      font-size: 11.2px !important;
    }
    .bigdrop{
        min-width: 149px !important;
        max-width: 150px !important;
    }
    .selectmobview{
        width: 150px !important;
    }
.productselectwidth{
width: 150px !important;
height: 18.78px !important;
}
table:not(.notforfinaloutputsave) {
border: 0;
}
table:not(.notforfinaloutputsave) caption {
font-size: 1.3em;
}
table:not(.notforfinaloutputsave) thead {
border: none;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}
table:not(.notforfinaloutputsave) tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
display: block;
margin-bottom: 1em;
}
table:not(.notforfinaloutputsave) thead th {
height: 50px;
vertical-align: top;
}
.pointer {
cursor: pointer;
}
.auto {
cursor: auto;
}
table:not(.notforfinaloutputsave) td {
border-bottom: 0px solid #ddd !important;
display: block;
font-size: .8em;
text-align: right;
}
table:not(.notforfinaloutputsave) td input{
    border: 1px solid #eee !important;
}
table:not(.notforfinaloutputsave) td input:focus{
    border: 1px solid #3f94eb !important;
    outline: none !important;
    box-shadow: none !important;
    border-radius: 0px;
}
table:not(.notforfinaloutputsave) td::before {
    color: black !important;
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: 600;
text-transform: uppercase;
width: 92.3px !important;
text-align: left !important;
}
    #loadimgins{
        width: 100% !important;
    }
table:not(.notforfinaloutputsave) td:last-child {
border-bottom: 0;
}
}
.table> :not(caption)>*>* {
background-color: #ffffff;
box-shadow: none;
}
.table> :not(:last-child)> :last-child>* {
border-bottom-color: #e9ecef;
font-size: 12px !important;
}
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

        background-image: url("./assets/img/spin.gif");
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

        background-image: url("./assets/img/spin.gif");
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

        background-image: url("./assets/img/spin.gif");
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

        background-image: url("./assets/img/spin.gif");
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

        background-image: url("./assets/img/spin.gif");
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

        background-image: url("./assets/img/spin.gif");
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
<?php
}
?>
  <?php
if ($current_file_name=='manualjournaladd.php'||$current_file_name=='manualjournaledit.php'||$current_file_name=='manualjournalview.php'||$current_file_name=='projectadd.php'||$current_file_name=='projectedit.php'||$current_file_name=='projectview.php') {
    ?>
.myinput::-webkit-input-placeholder {
font-size: 9.5px;
}
.select2 {
width: 100% !important;
background-color: #ffffff !important;
}
.modal-content {
border-radius: 0px;
}
.modal-header {
background: #F1F2F6;
border-radius: 0;
}
.modal-title {
font-weight: normal;
}
.select2-container--default .select2-selection--single {
background-color: #ffffff !important;
color: #495057;
border: 1px solid #ced4da;
height: 25px;
border-radius: 2px;
}
.btn_upload {
cursor: pointer;
display: inline-block;
overflow: hidden;
position: relative;
color: #fff;
background-color: #fff;
border: none;
}
.btn_upload:hover,
.btn_upload:focus {
background-color: #fff;
}
.yes {
display: flex;
align-items: flex-start;
margin-top: 10px !important;
}
.btn_upload input {
cursor: pointer;
height: 100%;
position: absolute;
filter: alpha(opacity=1);
-moz-opacity: 0;
opacity: 0;
}
.it {
height: 100px;
margin-left: 10px;
}
.accordion-button:not(.collapsed)::after
{
background-image: url("");
}
.mb-3 {
margin-bottom: -5px !important;
}
#removeImage1,
#removeImage2,
#removeImage3,
#removeImage4,
#removeImage5 {
color: #6c757d;
}
#removeImage1:hover {
color: black;
}
#removeImage2:hover {
color: black;
}
#removeImage3:hover {
color: black;
}
#removeImage4:hover {
color: black;
}
#removeImage5:hover {
color: black;
}
.rmv {
cursor: pointer;
color: #fff;
border-radius: 30px;
border: 1px solid #fff;
display: inline-block;
background: rgba(255, 0, 0, 1);
margin: -5px -10px;
}
.rmv:hover {
background: rgba(255, 0, 0, 0.5);
}
.item-actions-container .item-actions {
position: absolute;
right: -50px;
top: -20px;
}
.icon-cancel-circled {
color: #fab2b1;
}
svg.icon.icon-sm {
height: 14px;
width: 14px;
}
td:hover {
cursor: move;
}
.imagePreview {
width: 200px;
height: 140px;
background-position: center center;
background-color: #fff;
background-size: cover;
background-repeat: no-repeat;
text-align: center;
}
.btn-custom-grey:hover i {
color: #ffffff !important;
}
.btn-custom-grey:active, .btn-custom-grey:focus, .btn-custom-grey:hover {
background-color: #f8f8f8;
border-color: #c6c6c6;
}
/*.btn-custom:hover {
background-color: #ed0707 !important;
border-color: #c6c6c6;
}*/
.selectdesign {
width: 6px;
padding-right: 0px;
padding-left: 10px;
padding-bottom: 1px;
border-top-width: 2px;
background-color: #f5f5f5;
}
.dash {
border: 0 none;
border-top: 2px dashed #322f32;
background: none;
height: 0;
margin-top: 0px;
width: 60px;
}
thead tr th {
color: black !important;
text-align: left !important;
}
.basicaddon1 {
padding-right: 8px;
padding-left: 8px;
padding-top: 5px;
padding-bottom: 5px;
background-color: #e9ecef;
border-bottom: 2px solid #e9ecef;
}
.form-control:disabled,
.form-control[readonly] {
background-color: #e9ecef;
opacity: 1;
}
<?php
}
?>
 <?php
if ($current_file_name=='reportviews.php'||$current_file_name=='reportbillviews.php'||$current_file_name=='inwardreport.php'||$current_file_name=='inwardreportregistered.php'||$current_file_name=='inwardreportconsumer.php'||$current_file_name=='inwardreporthsn.php'||$current_file_name=='outwardreport.php'||$current_file_name=='outwardreportregistered.php'||$current_file_name=='outwardreportconsumer.php'||$current_file_name=='outwardreporthsn.php'||$current_file_name=='reportsales.php'||$current_file_name=='reportsaledetails.php'||$current_file_name=='reportprosalecus.php'||$current_file_name=='reportpromovement.php'||$current_file_name=='reportsalesperson.php'||$current_file_name=='reportcustbalance.php'||$current_file_name=='reportcustdetails.php'||$current_file_name=='reportjournal.php'||$current_file_name=='reportaccounttrans.php'||$current_file_name=='reportsalesprofitloss.php'||$current_file_name=='reportpayreceive.php'||$current_file_name=='reportpaymade.php'||$current_file_name=='reportcrnote.php'||$current_file_name=='reportcrnoteregistered.php'||$current_file_name=='reportcrnoteconsumer.php'||$current_file_name=='reportdrnote.php'||$current_file_name=='reportdrnoteregistered.php'||$current_file_name=='reportdrnoteconsumer.php') {
?>
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  color:#1BBC9B;
  font-size:30px;
  transform: translate(-50%, -50%);
}
#datehis{
color:grey;
}
#chhis{
color:grey;
}
            @-moz-document url-prefix() {
@media screen and (min-device-width: 100px) and (max-device-width: 350px) {
#templatetext{
margin-top: -850px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 351px) and (max-device-width: 430px) {
#templatetext{
margin-top: -760px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 431px) and (max-device-width: 500px) {
#templatetext{
margin-top: -670px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 501px) and (max-device-width: 580px) {
#templatetext{
margin-top: -560px !important;
position:relative;
left:-30px;
}
}
@media screen and (min-device-width: 581px) and (max-device-width: 767px) {
#templatetext{
margin-top: -500px !important;
position:relative;
left:-70px;
}
}
@media screen and (min-device-width: 768px) and (max-device-width: 1300px) {
#templatetext{
margin-top: -262px !important;
position:relative;
left:-100px;
}
}
@media screen and (min-device-width: 1301px) and (max-device-width: 1400px) {
#templatetext{
margin-top: -160px !important;
}
}
@media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
#templatetext{
margin-top: 100px !important;
}
}
@media screen and (min-device-width: 1501px) and (max-device-width: 3000px) {
#templatetext{
margin-top: 60px !important;
}
}
            @media screen and (min-device-width: 100px) and (max-device-width: 768px) {
                .totalleftside{
                    font-size: 10px !important;
                }
            }
            @media screen and (min-device-width: 100px) and (max-device-width: 259px) {
                #zoomforprint{
                    transform: scale(15%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 260px) and (max-device-width: 270px) {
                #zoomforprint{
                    transform: scale(15%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 271px) and (max-device-width: 280px) {
                #zoomforprint{
                    transform: scale(17%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 281px) and (max-device-width: 290px) {
                #zoomforprint{
                    transform: scale(19%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 291px) and (max-device-width: 320px) {
                #zoomforprint{
                    transform: scale(21%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 321px) and (max-device-width: 330px) {
                #zoomforprint{
                    transform: scale(22%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 331px) and (max-device-width: 350px) {
                #zoomforprint{
                    transform: scale(23%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 351px) and (max-device-width: 380px) {
                #zoomforprint{
                    transform: scale(26%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 381px) and (max-device-width: 400px) {
                #zoomforprint{
                    transform: scale(28%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 401px) and (max-device-width: 430px) {
                #zoomforprint{
                    transform: scale(30%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 431px) and (max-device-width: 460px) {
                #zoomforprint{
                    transform: scale(33%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 461px) and (max-device-width: 490px) {
                #zoomforprint{
                    transform: scale(36%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 491px) and (max-device-width: 500px) {
                #zoomforprint{
                    transform: scale(39%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 501px) and (max-device-width: 520px) {
                #zoomforprint{
                    transform: scale(42%);
                    transform-origin: 0 0;
                }
            }
           @media screen and (min-device-width: 521px) and (max-device-width: 550px) {
                #zoomforprint{
                    transform: scale(45%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 551px) and (max-device-width: 580px) {
                #zoomforprint{
                    transform: scale(48%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 581px) and (max-device-width: 600px) {
                #zoomforprint{
                    transform: scale(51%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 601px) and (max-device-width: 767px) {
                #zoomforprint{
                    transform: scale(54%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 768px) and (max-device-width: 800px) {
                #zoomforprint{
                    transform: scale(69%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 801px) and (max-device-width: 1199px) {
                #zoomforprint{
                    transform: scale(73%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 1200px) and (max-device-width: 1300px) {
                #zoomforprint{
                    transform: scale(69%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 1301px) and (max-device-width: 1400px) {
                #zoomforprint{
                    transform: scale(81%);
                    transform-origin: 0 0;
                }
            }
            @media screen and (min-device-width: 1401px) and (max-device-width: 1500px) {
                #zoomforprint{
                    transform: scale(89%);
                    transform-origin: 0 0;
                }
            }
            }
    #histables table thead td span{
        color: grey !important;
        font-weight: 600 !important;
    }
@media screen and (max-width: 600px) 
{
  #histables table {
    border: 0;
  }

  #histables table caption {
    font-size: 1.3em;
  }
  
  #histables table thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }
  
  #histables table tr {
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    display: block;
    margin-bottom: 1em;
  }
  
  
  #histables table td {
/*    border-bottom: 1px solid #ddd;*/
    display: block;
    font-size: .8em;
    text-align: right;
  }
  
  #histables table td::before {
    color: grey !important;
    /*
    * aria-label has no advantage, it won't be read inside a #histables table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: 600;
    text-transform: uppercase;
  }
    #loadimgins{
        width: 100% !important;
    }
  
  #histables table td:last-child {
    border-bottom: 0;
  }
}
.#histables table td, .#histables table th {
    white-space: normal;
}
<?php
}
?>
</style>