<?php

include_once 'classes/user.class.php';
$null =NULL;
$instance = User::create($null,$null,$null,$username,$null);
$instance->logout();

?>