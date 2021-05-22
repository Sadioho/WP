<?php 

    class Database{
        private $dsn="mysql:host=localhost;dbname=crud";
        private $user="root";
        private $pass="";
        public $conn;

        public function __construct(){
            try{
                $this->conn=new PDO($this->dsn,$this->user,$this->pass);
                // echo "success connected";
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function insert($fname,$lname,$email,$phone){
                $sql="insert into users (first_name,last_name,email,phone) values (:fname,:lname,:email,:phone)"; 
                $stmt=$this->conn->prepare($sql);
                $stmt->execute(['fname'=>$fname,'lname'=>$lname,'email'=>$email,'phone'=>$phone]);
                return true;
        }



        public function read(){
            $data=array();
            $sql="select * from users";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $data[]=$row;
            }
            return $data;
        }

        public function getUserById($id){
            $sql="select * from users where id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        public function update($id,$fname,$lname,$email,$phone){
            $sql="update users set first_name=:fname,last_name=:lname,email=:email,phone=:phone where id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute([
                'fname'=>$fname,
                'lname'=>$lname,
                'email'=>$email,
                'phone'=>$phone
               
            ]);
            return true;
        }

        public function delete($id){
            $sql="delete from users where id=:id";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute(['id'=>$id]);
            return true;
        }
        public function totalRowCount(){
            $sql="select * from users";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            $t_row=$stmt->rowCount();
            return $t_row;
        }


    }
    $ob=new Database();
    
    // print_r($ob->read());
    // echo $ob->totalRowCount();
?>