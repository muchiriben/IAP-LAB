<?php

interface Authenticator{
    public function hashPassword();
    public function isPasswordCorrect($conn);
    public function login();
    public function logout();
    public function createUserSession();
}

?>