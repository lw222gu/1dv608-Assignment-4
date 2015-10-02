<?php

namespace model;

session_start();

class Login {
    private $isLoggedInSession = "isLoggedIn";

    public function __construct() {
        // If $_SESSION[$this->isLoggedInSession] isn´t set, set it to false.
        if(!isset($_SESSION[$this->isLoggedInSession])){
            $_SESSION[$this->isLoggedInSession] = false;
        }
    }

    public function checkUserInput($username, $password){

        if(file_exists("data/" . $username . ".txt")){
            $userFile = fopen("data/" . $username . ".txt", "r");
            if(password_verify($password, fgets($userFile))){
                fclose($userFile);
                $_SESSION[$this->isLoggedInSession] = true;
                return true;
            }

            else {
                fclose($userFile);
                return false;
            }
        }

        else {
            return false;
        }
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