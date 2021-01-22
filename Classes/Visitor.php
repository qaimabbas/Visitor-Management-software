<?php

 include  'db.php';

 


  class Visitor extends db{

    
      public $VisitorName;
      public $Cat;
      public $fieldmsg;


      
      
      
      
      


      
              
         

        

      public function addvisit(){
          
      //  $conn= new mysqli($this->host,$this->user,$this->password,$this->database);
         if(isset($_POST["submit"])){
             

             if(empty($_POST["VisitorName"])){
                 $this->fieldmsg="Please Entre Name";
             }else{
               if($this->Cat= $_POST["Cat"] == 'choose'){
                $this->fieldmsg="Please Choose Category";
               }else{ 
               $this->VisitorName=mysql_real_escape_string($this->connect(),$_POST["VisitorName"]);
                $this->Cat= mysql_real_escape_string($this->connect(),$_POST["Cat"]);
                $query = "INSERT INTO Visitors(VisitorName, Cat) 
                VALUES ('$this->VisitorName','$this->Cat')";
                $runquery= $this->connect()->query($query);
                if($runquery){
                   header('location: entre.php');
    
                }else{
                  echo 'not';

               }
              
           }

             }

             

             
             
         }

      }

      



  }

  $obj= new Visitor;
  
  $obj->addvisit();














?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor</title>
    <link rel="stylesheet" href="../Css/visit.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<script src="https://kit.fontawesome.com/18c0ad11e1.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
</head>
<body>
 
     
      <div class="form">
          <h1>Liepu Library</h1>
        <form action="" method="post">
            <p>Please entre your details</p>
            <div class=" alert-danger" role="alert"  style='width:200px;'>
             <p style=''><?php echo $obj->fieldmsg;?></p> 
           </div>
            <label for="">Name</label>
          <input type="text" name="VisitorName">
          <label for="">Category</label>
            <select name="Cat" >
            <option value="choose">Choose</option>
            <option value="student">Student</option>
            <option value="faculty">Faculty</option>
            <option value="guest">Guest</option>
            </select>
          <input type="submit" name="submit">
   
   </form>

      </div>
    
        
    
    
</body>
</html>





