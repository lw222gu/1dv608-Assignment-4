<?php

namespace model;
class Login {
    private $isLoggedInSession = \Settings::APP_SESSION_IS_LOGGED_IN;

    public function __construct() {
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
    }
}