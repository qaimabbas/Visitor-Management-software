<?php

 require_once 'db.php';

class Reset extends db{
  public $email;
  public $msg;

  public function reset(){

    //$this->mysqli= new mysqli($this->host,$this->user,$this->password,$this->database);
       if(isset($_POST["submit"])){
             $this->email=$_POST["email"];
             if(empty($_POST["email"])){
                 echo "input email";
             }else{
                 
                $query= "SELECT * FROM Admin where email='".$this->email."'";
                $result= $this->connect()->query($query);
        
             if($result->num_rows>0){
               
               $userdata= mysqli_fetch_assoc($result);
               $username=$userdata["uname"];
               $token=$userdata["token"];

               $to=$this->email;
               $subject="reset password";
               $body= "reset your password on this link http://localhost:8080/VisitorApp/updatepass.php?token= $token";
               $from="tanveerabbas20175@gmail.com";
               $headers = "from : $from";
               


              mail( $to , $subject , $body, $headers );
              echo " password reset link has been sent to your email";
                  
                 }else{
                     
                      $this->msg='...Email not found';
                     
                    
                 }
             }
       }
  }




}
$reset = new Reset;
$reset->reset();



?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="Css/visit.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/18c0ad11e1.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrap">
     
    
   <div class="form">
   
              
   <h1>Password Reset</h1>
<form action="" method="post">
<div class=" alert-danger msg" role="alert"  style='width:200px;'>
     <p style=''><?php echo $reset->msg;?></p> 
    </div>
   <p>Entre your email</p>
  <input type="email" name="email" placeholder="Entre your email">
  <input type="submit" name="submit">
</form>
   </div>
</div>
  
    
</body>
</html>


