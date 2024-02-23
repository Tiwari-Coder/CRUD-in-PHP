<?php
/*Database Connection */ 

class Model{
    private $servername='localhost';
    private $username='root';
    private $password='';
    private $dbname='ignisit';
    private $conn;

    function __construct(){
        $this->conn=new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        if($this->conn->connect_error){

        }else{
            return $this->conn;
        }
    }//const close
    /*fuction define for insert record */
    public function insertRecord($post){
       $name=$post['name'];
       $email=$post['email'];

       $sql="INSERT INTO users(name,email)VALUES('$name','$email')";

       $result= $this->conn->query($sql);
       if($result){
        header('location:index.php?msg=ins');
       }else{
        echo "Error ".$sql."<br>".$this->conn->error; 
    }
    }// insertRecord function close

    public function updateRecord($post){
      $name=$post['name'];
      $email=$post['email'];
      $editid=$post['hid'];
      $sql="UPDATE users SET name='$name',email='$email' WHERE id='$editid'";

      $result= $this->conn->query($sql);
      if($result){
       header('location:index.php?msg=ins');
      }else{
       echo "Error ".$sql."<br>".$this->conn->error; 
   }
   }// updateRecord function close
     public function deleteRecord($delid){
      $sql="DELETE FROM users WHERE id='$delid'";
      $result=$this->conn->query($sql);
      if($result){
        header('location:index.php?msg=del');
      }else{
        echo "Error ".$sql."<br>".$this->conn->error;
      }

     }//delete record
      
      public function displayRecord(){
        $sql="SELECT * FROM users";
        $result=$this->conn->query($sql);
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
               $data[]=$row;
            }//while close
            return $data;
        }//if close
      }//displayRecord close

      public function displayRecordById($editid){
        $sql="SELECT * FROM users WHERE id='$editid'";
        $result=$this->conn->query($sql);
        if($result->num_rows==1){
            $row=$result->fetch_assoc();
            return $row;
        } //if close  
      }//function displayRecordById close

}//class close

