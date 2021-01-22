<?php

  include 'db.php';

class UpdatePass extends db{

     public $mypassword='';
     public $Cpassword='';
     public $msg;
     
        
     

     
      
    public function Upass(){
       // $this->mysqli= new mysqli($this->host,$this->user,$this->password,$this->database);

        if(isset($_POST["submit"])){

           if(isset($_GET['token'])){
                
                $token=$_GET['token'];
                $this->mypassword= $_POST["pass"];
                $this->Cpassword=$_POST["Cpass"];
                $pass=password_hash($this->mypassword,PASSWORD_BCRYPT);
                
        
                 if($this->mypassword===$this->Cpassword){
                    
                  
                  $query= "UPDATE `Admin` SET `pass`= '$pass' WHERE `token`='$token' ";
                  $result= $this->connect()->query($query);

                if($result){
                      // $_SESSION['msg']='your password have been updated';
                       header('location:index.php');
                }else{
                    //$this->msg=$_SESSION['passmsg']='your password is not updated';
                     header('location:updatepass.php');
                }
             }else{
                 echo 'password not matched';
             }

            
               
           }

              
        }

             

    }







}
  
 $up=new UpdatePass;
 $up->Upass();


?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

  
<form action="" method="Post">

  <input type="password"  placeholder="entre new password" name="pass"> <br>
  <input type="password" placeholder="confirm new password" name="Cpass"><br>
  <input type="submit"  name="submit">


</form>
    
</body>
</html>
