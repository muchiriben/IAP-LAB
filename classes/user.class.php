<?php
include "includes/crud.inc.php";
include "includes/authenticator.inc.php";

class User implements Crud,Authenticator{
    //objects
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;
    private $username;
    private $password;

    //constructor
    public function __construct($first_name,$last_name,$city_name,$username,$password){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city_name = $city_name;
        $this->username = $username;
        $this->password = $password;
    }

    //static constructors(fake)
    public static function create() {
        $instance = new self($first_name,$last_name,$city_name,$username,$password);
        return $instance;
    }
    
    //setters and getters
    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function getUserId(){
        return $this->user_id;
    }
    
    //username
    public function setUsername($username){
        $this->username = $username;
    }

    public function getUsername($username){
        return $this->username;
    }
    
    //password
    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword($password){
        return $this->password;
    }

    public function save($conn) {
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        $uname = $this->username;
        $this->hashPassword();
        $pass = $this->password;
        $reg = "INSERT INTO `users`(`first_name`,`last_name`,`user_city`,`username`,`password`) VALUES(?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $reg)) {
            echo "SQL error";
            exit();
          } else {
            mysqli_stmt_bind_param($stmt, "sssss", $fn,$ln,$city,$uname,$pass);
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

    public function hashPassword(){
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
    }

    public function isPasswordCorrect($conn){
        $found = false;

        $sql = "SELECT * FROM users";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error...Failed";
        } else{
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
        }

        while($row = mysqli_fetch_array($res)) {
            if(password_verify($this->getPassword($password),$row['password']) && $this->getUsername($username) == $row['username']) {
                $found = true;
            }
        }
    return $found;
    }

    public function login(){
           header("Location:private_page.php");
    }

    public function createUserSession(){
        session_start();
        $_SESSION['username'] = $this->getUsername($username);
    }

    public function logout(){
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location:lab.php");
    }

    public function validateForm(){
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;

        if($fn == "" || $ln == "" || $city == ""){
            return false;
        }
        return true;
    }

    public function createFormErrorSessions(){
        session_start();
        $_SESSION['form_errors'] = "All fields are required";
    }

    public function isUserExist($conn) {
        $uname = $this->username;

        $found = false;

        $sql = "SELECT * FROM users";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "Error...Failed";
        } else{
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
        }

        while($row = mysqli_fetch_array($res)) {
            if($this->getUsername($uname) == $row['username']) {
                $found = true;
            }
        }
    return $found;
    }

    
}

?>