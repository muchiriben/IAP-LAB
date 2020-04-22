<?php

class DBconnector {
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "iap-lab";

    public function connect() {
        $this->conn = mysqli_connect($this->host,$this->user,$this->pwd) or die("Error:" .mysqli_error());
        mysqli_select_db($this->conn,$this->dbName);
        
        return $this->conn;
    }

    public function closeDB() {
        mysqli_close($this->conn);
    }

}

?>