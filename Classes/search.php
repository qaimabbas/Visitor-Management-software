<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Xanh+Mono&display=swap" rel="stylesheet">


    <title>Search</title>
</head>
<body style=" background-color:black; color: white;">

<?php
session_start();

		
if(!isset($_SESSION["uname"] ))
{
    header('location:index.php');
    
}?>
  <h1 style='text-align:center;font-family: Xanh Mono, monospace;'>Search Records</h1>
  <div style='margin-left:40%;font-family: Xanh Mono, monospace;'>
  <a href="logout.php" class="logout-link"><button type="button" class="btn btn-primary">Logout</button></a>
  <a href="dashboard.php" class="logout-link"><button type="button" class="btn btn-primary">Dashboard</button></a>

  </div>



<form action="" method="Post" >
  <div class="form-group" style='font-family: Xanh Mono, monospace;'>
    <label >Entre Name</label>
    <input type="text"  style="width:300px;"  class="form-control form-control-sm"  name="Name" placeholder="Enter Name">
  </div>
  <div class="form-group " style="width:300px;">
    <label for="exampleFormControlSelect1">Select</label>
    <select class="form-control form-control-sm"  name="cat">
    <option value"">Choose</option>
      <option value"student">student</option>
      <option value"faculty">faculty</option>
      <option value"guest">guest</option>
      
    </select>
  </div>
  <div class="form-group">
    <label >From</label>
    <input type="date"  style="width:300px;"  class="form-control form-control-sm"  name="from" placeholder="Enter Name">
  </div>
  <div class="form-group">
    <label >To</label>
    <input type="date"  style="width:300px;"  class="form-control form-control-sm"  name="to" placeholder="Enter Name">
  </div>
  
  <button type="submit" class="btn btn-primary" name="submit" style='font-family: Xanh Mono, monospace;'>Submit</button>
</form>

<?php

  include 'db.php';


   Class Ser extends db{
        

      public $name;
      public $result;
      public $cat;
      public $from;
      public $to;
      public $msg;
      public $count;

     public function Search(){

         if(isset($_POST['submit'])){
              $this->name=mysql_real_escape_string($_POST["Name"]);
              $this->cat=mysql_real_escape_string($_POST["cat"]);
              $this->from=$_POST["from"];
              $this->to=$_POST["to"];

         }
          
        $query="select * from Visitors where  VisitorName ='$this->name' OR  Cat = '$this->cat' OR Date BETWEEN '$this->from' AND '$this->to'   ";
        $this->result= $this->connect()->query($query);
        ?>
        
        
        <table  class="table table-dark" width="100%"  border="0" > 
         <tr style='font-family: Xanh Mono, monospace;'>
             <th scope="col" width="13%" >Name</th>
             <th width="13%" scope="col" >Category</th>
             <th width="13%" scope="col" >Date/Time</th>
         </tr>
         
        
        <?php
         echo $this->result->num_rows.' Records found';


        if($this->result->num_rows>0){
            $this->result->num_rows;
             
           while($this->row= mysqli_fetch_assoc($this->result)){
               ?>
                
             <div style='font-family: Xanh Mono, monospace;' >
            
             <tr>
                  
                 
                <td height="29" class="text-capitalize" ><?php echo  $this->row['VisitorName'];?></td>
                    <td class="text-capitalize">  <?php echo  $this->row['Cat'];?> </td> 
                    <td> <?php echo  $this->row['Date'];?> </td>
               </tr>
             </div>
             
             <?php
     }?>
     </table>
     <?php
   }else{
        $this->msg='No record Found';
   }

}
   }


    $sr= new Ser;
    $sr->Search();
?>


                  
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</body>
</html>
