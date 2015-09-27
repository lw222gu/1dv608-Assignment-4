<?php

namespace model;

session_start();

class Login {
    private static $username = "Admin";
    private static $password = "Password";
    private $isLoggedInSession = "isLoggedIn";

    public function __construct() {
        // If $_SESSION[$this->isLoggedInSession] isn´t set, set it to false.
        if(!isset($_SESSION[$this->isLoggedInSession])){
            $_SESSION[$this->isLoggedInSession] = false;
        }
    }

    public function checkUserInput($username, $password){
        // Validation in model, if validation in view for some reason wont work...
        if(empty($username)){
            throw new \Exception("Username is missing");
        }

        // Validation in model, if validation in view for some reason wont work...
        if(empty($password)){
            throw new \Exception("Password is missing");
        }

        if($username !== self::$username || $password !== self::$password){
            throw new \Exception("Wrong name or password");
        }

        $_SESSION[$this->isLoggedInSession] = true;
        return true;
    }

    public function checkIfLoggedIn(){
        if($_SESSION[$this->isLoggedInSession]){
            return true;
        }
        return false;
    }

    public function Logout(){
        $_SESSION[$this->isLoggedInSession] = false;
        session_destroy();
    }
}