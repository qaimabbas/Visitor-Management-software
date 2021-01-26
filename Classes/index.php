<?php 
session_start();

 include 'db.php';
  

 
class Admin extends db{
 

      public $uname= '';
      public $mypassword;
      public $msg;
      public $emsg;
      

     public function admin(){
         
      
      if(isset($_POST["submit"])){
         if(empty($_POST["username"])){
          $this->emsg='Entre username and password';


         }else{
            if(empty($_POST["password"])){
              $this->emsg='Entre username and password';
            }else{
                $this->uname= $_POST["username"];
                $this->mypassword= $_POST["password"];
               
                  $query="select * from Admin where uname='".$this->uname."' limit 1";
                
                 $result= $this->connect()->query($query);
                        
                if($result->num_rows>0){
        
                    $userdata = mysqli_fetch_array($result);
                    $pass=$userdata["pass"];
                    $_SESSION["uname"] = $userdata["uname"];
                    $pass_decode= password_verify($this->mypassword,$pass);
                    if($pass_decode){
                            
                       header('location:dashboard.php');
                    }else{
                      
                        $this->msg ='wrong username or password';
               
                    }
        
                       
                }
      
               }
            }
         }
    
        
        
        
        
        
            
    }
     }







$admin= new Admin;
$admin->admin();



?>



<!DOCTYPE html>
<html>
<head>
	<title> Admin Login </title>
	<link rel="stylesheet" href="../Css/login.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<script src="https://kit.fontawesome.com/18c0ad11e1.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
	
	  
	<div class="form">
		 
    
	
		<form action="" method="post">
      <h1>Admin Login <i class="fas fa-user-shield"></i></h1>
      <div class=" alert-danger" role="alert"  style='width:200px;'>
             <p style=''><?php echo $admin->msg;?></p> 
             <p style=''><?php echo $admin->emsg;?></p> 
           </div>
			<div class="form-group">
				  <p>Username</p><i class="fas fa-user"></i>
				<input type="text" name="username" />	
			</div>
			<div class="form-group">
				<p>Password</p><i class="fas fa-unlock"></i>
				<input type="password" name="password" />
			</div>
			
			<input type="submit"  name="submit"  class=" btn btn-primary"/>
		</form>
		<p>Forgot Password ? <a href="reset.php">Click</a></p>
        
	</div>
      
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     
</body>
</html>
