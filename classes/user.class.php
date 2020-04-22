<?php
include "includes/Crud.inc.php";

class User implements Crud{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    public function __construct($first_name,$last_name,$city_name){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city_name = $city_name;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function save($conn) {
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        $reg = "INSERT INTO `users`(`first_name`,`last_name`,`user_city`) VALUES(?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $reg)) {
            echo "SQL error";
            exit();
          } else {
            mysqli_stmt_bind_param($stmt, "sss", $fn,$ln,$city);
            mysqli_stmt_execute($stmt);
          }
        return true;
    }

    public function readAll($conn){

        $list = "SELECT * FROM users";   
       //create prepared statement
       $stmt = mysqli_stmt_init($conn);
       //prepare stmt

       if (!mysqli_stmt_prepare($stmt, $list)) {
          echo "SQL STATEMENT FAILED";
       } else {

           mysqli_stmt_execute($stmt);
           $result = mysqli_stmt_get_result($stmt);
        }
        return $result;
    }

    public function readUnique(){
        return null;
    }
    public function search(){
        return null;
    }
    public function update(){
        return null;
    }
    public function removeOne(){
        return null;
    }
    public function removeAll(){
        return null;
    }
}

?>