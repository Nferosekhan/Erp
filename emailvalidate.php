<?php
include('lcheck.php');
if((isset($_POST['email']))&&(isset($_POST['oldemail'])))
{
   $email = mysqli_real_escape_string($con,$_POST['email']);
   $oldemail = mysqli_real_escape_string($con,$_POST['oldemail']);

   $query = "select count(*) as cntUser from paircontrols where username='".$email."' and id!='".$oldemail."'";

   $result = mysqli_query($con,$query);
   $response = "<span style='color: green;'>Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];
    
      if($count > 0){
          $response = "<span style='color: red;'>Not Available.</span>";
      }
   
   }

   echo $response;
   die;
}