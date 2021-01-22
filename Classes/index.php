 
<?PHP  

   class db{

       

        public $host='localhost';
        public $user= 'root';
        public $password= '';
        public $database= 'Visitor';
        
        
        
        


        public function connect(){
                
            $conn= new mysqli($this->host,$this->user,$this->password,$this->database);

             return $conn;
        }
             






   }
   

   

    











?>
