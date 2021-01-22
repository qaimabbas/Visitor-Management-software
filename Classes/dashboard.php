<!DOCTYPE html>
<html>
<head>
<title>DashBoard</title>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Xanh+Mono&display=swap" rel="stylesheet">



</head>

 
<body style=" background-color:black; color: white;font-family: Xanh Mono, monospace;">

<div class="time" style='margin-left:50px;'>
<p>Date and Time</p>
        <input type="text" id="currentDateTime">
<br><br>
<script>
  var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;
  document.getElementById("currentDateTime").value = dateTime;
</script>





<?php
session_start();
include 'db.php';
		
if(!isset($_SESSION["uname"] ))
{
    header('location:index.php');
    
}?>
<div class="container-dashboard" style='margin-left:40%;margin-top:100px;font-family: Xanh Mono, monospace;'>
        <h1>Admin Interface</h1> 
        
        
        <h1> Welcome <? echo $_SESSION["uname"]; ?>  </h1>
        <a href="search.php"> <button type="button" class="btn btn-primary">Search Records</button></a>
        <a href="logout.php" class="logout-link"><button type="button" class="btn btn-primary">Logout</button></a>
        <a href="visitor.php"><button type="button" class="btn btn-primary">Add Visitor</button></a>

    </div>


    <?php
      Class Data extends db{
          public $total;
          public $faculty;
          public $students;
          public $guest;









            
          public  function data(){
            $query="select * from Visitors ";
            $result= $this->connect()->query($query);
             $this->total=$result->num_rows;


             $query2="select * from Visitors where Cat='faculty' ";
             $this->faculty= $this->connect()->query($query2)->num_rows;


             $query3="select * from Visitors where Cat='student' ";
             $this->students= $this->connect()->query($query3)->num_rows;

             $query4="select * from Visitors where Cat='guest' ";
             $this->guest= $this->connect()->query($query4)->num_rows;
             




            
          }

          


          public function Today(){
              
            $query="select * from Visitors where Date >= CURRENT_DATE() ";
            $this->total=$this->connect()->query($query)->num_rows;

            $query2="select * from Visitors where Cat='student' AND Date >= CURRENT_DATE() ";
            $this->students=$this->connect()->query($query2)->num_rows;

            $query3="select * from Visitors where Cat='faculty' AND Date >= CURRENT_DATE() ";
            $this->faculty=$this->connect()->query($query3)->num_rows;

            $query4="select * from Visitors where Cat='guest' AND Date >= CURRENT_DATE() ";
            $this->guest=$this->connect()->query($query4)->num_rows;
                  

          }

          

           public function Week(){


            $query="SELECT * FROM Visitors
            WHERE  date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
            AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ";
            $this->total=$this->connect()->query($query)->num_rows;

            $query2="SELECT * FROM Visitors
            WHERE  Cat='student' and date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
            AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ";
            $this->students=$this->connect()->query($query2)->num_rows;


            $query3="SELECT * FROM Visitors
            WHERE Cat='faculty' and   date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
            AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ";
            $this->faculty=$this->connect()->query($query3)->num_rows;


            $query4="SELECT * FROM Visitors
            WHERE Cat='guest' and date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
            AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY ";
            $this->guest=$this->connect()->query($query4)->num_rows;


            
               
           }
         
           public function Month(){


            $query="SELECT * FROM Visitors
             where  `date` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
            $this->total=$this->connect()->query($query)->num_rows;


            $query="SELECT * FROM Visitors
             where Cat='faculty' and `date` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
            $this->faculty=$this->connect()->query($query)->num_rows;
            

            $query="SELECT * FROM Visitors
             where Cat='student' and `date` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
            $this->students=$this->connect()->query($query)->num_rows;


            $query="SELECT * FROM Visitors
             where   Cat='guest' and `date` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
             $this->guest=$this->connect()->query($query)->num_rows;


            

                
           }




            public function Year(){

                $query="SELECT * FROM Visitors WHERE date >= curdate() - interval 1 year;";
                $this->total=$this->connect()->query($query)->num_rows;
                    
                $query="SELECT * FROM Visitors WHERE  Cat='student' and date >= curdate() - interval 1 year;";
                 $this->students=$this->connect()->query($query)->num_rows;

                $query="SELECT * FROM Visitors WHERE Cat='faculty' and  date >= curdate() - interval 1 year;";
                $this->faculty=$this->connect()->query($query)->num_rows;

                $query="SELECT * FROM Visitors WHERE Cat='guest' and  date >= curdate() - interval 1 year;";
                 $this->guest=$this->connect()->query($query)->num_rows;
   

            }









      }
       $obj= new Data;
       $today= new Data;
       $week=new Data;
       $month= new Data;
       $year= new Data;

       $obj->data();
       $today->Today();
       $week->Week();
       $month->Month();
       $year->Year();
       
       
    ?>









      
      <div style='font-family: Xanh Mono, monospace;'>

      <h5>Total Visits</h5>

      
            
      <table  class="table table-dark" width="100%"  border="0" > 
         <tr style='font-family: Xanh Mono, monospace;'>
             <th scope="col" width="13%" >Total</th>
             <th width="13%" scope="col" >Faculty</th>
             <th width="13%" scope="col" >Students</th>
             <th width="13%" scope="col" >Guest</th>
         </tr>
             
         <div style='font-family: Xanh Mono, monospace;' >
            
            <tr>
                 
                
               <td height="29" class="text-capitalize" ><?php echo $obj->total; ?></td>
                   <td class="text-capitalize"><?php echo $obj->faculty;?> </td> 
                   <td> <?php echo $obj->students;?> </td>
                   <td> <?php echo $obj->guest;?> </td>
              </tr>
            </div>
            
        

    </table>

      </div>



       
      <div style='font-family: Xanh Mono, monospace;'>

      <h5>Today Visits</h5>
            
      <table  class="table table-dark" width="100%"  border="0" > 
         <tr style='font-family: Xanh Mono, monospace;'>
             <th scope="col" width="13%" >Total</th>
             <th width="13%" scope="col" >Faculty</th>
             <th width="13%" scope="col" >Students</th>
             <th width="13%" scope="col" >Guest</th>
         </tr>
             
         <div style='font-family: Xanh Mono, monospace;' >
            
            <tr>
                 
                
               <td height="29" class="text-capitalize" ><?php echo $today->total; ?></td>
                   <td class="text-capitalize"><?php echo $today->faculty;?> </td> 
                   <td> <?php echo $today->students;?> </td>
                   <td> <?php echo $today->guest;?> </td>
              </tr>
            </div>
            
        

    </table>

      </div>







       
      <div style='font-family: Xanh Mono, monospace;'>

      <h5>Last Week Visits</h5>
            
      <table  class="table table-dark" width="100%"  border="0" > 
         <tr style='font-family: Xanh Mono, monospace;'>
             <th scope="col" width="13%" >Total</th>
             <th width="13%" scope="col" >Faculty</th>
             <th width="13%" scope="col" >Students</th>
             <th width="13%" scope="col" >Guest</th>
         </tr>
             
         <div style='font-family: Xanh Mono, monospace;' >
            
            <tr>
                 
                
               <td height="29" class="text-capitalize" ><?php echo $week->total; ?></td>
                   <td class="text-capitalize"><?php echo $week->faculty;?> </td> 
                   <td> <?php echo $week->students;?> </td>
                   <td> <?php echo $week->guest;?> </td>
              </tr>
            </div>
            
        

    </table>

      </div>




      <div style='font-family: Xanh Mono, monospace;'>

<h5>Last Month Visits</h5>
      
<table  class="table table-dark" width="100%"  border="0" > 
   <tr style='font-family: Xanh Mono, monospace;'>
       <th scope="col" width="13%" >Total</th>
       <th width="13%" scope="col" >Faculty</th>
       <th width="13%" scope="col" >Students</th>
       <th width="13%" scope="col" >Guest</th>
   </tr>
       
   <div style='font-family: Xanh Mono, monospace;' >
      
      <tr>
           
          
         <td height="29" class="text-capitalize" ><?php echo $month->total; ?></td>
             <td class="text-capitalize"><?php echo $month->faculty;?> </td> 
             <td> <?php echo $month->students;?> </td>
             <td> <?php echo $month->guest;?> </td>
        </tr>
      </div>
  
  

</table>

</div>







<div style='font-family: Xanh Mono, monospace;'>

<h5>Last Year Visits</h5>
      
<table  class="table table-dark" width="100%"  border="0" > 
   <tr style='font-family: Xanh Mono, monospace;'>
       <th scope="col" width="13%" >Total</th>
       <th width="13%" scope="col" >Faculty</th>
       <th width="13%" scope="col" >Students</th>
       <th width="13%" scope="col" >Guest</th>
   </tr>
       
   <div style='font-family: Xanh Mono, monospace;' >
      
      <tr>
           
          
         <td height="29" class="text-capitalize" ><?php echo $year->total; ?></td>
             <td class="text-capitalize"><?php echo $year->faculty;?> </td> 
             <td> <?php echo $year->students;?> </td>
             <td> <?php echo $year->guest;?> </td>
        </tr>
      </div>
      </table>

</div>	
</body>
</html>
 
