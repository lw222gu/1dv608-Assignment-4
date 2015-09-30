<?php

namespace model;

session_start();

class Login {
   // private static $username = "Admin";
   // private static $password = "Password";
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

            //CONTINUE HERE: Instead of throwing exception, return false, and
            //set if false in controller to be able to create this error from view.
            else {
                fclose($userFile);
                throw new \Exception("Wrong name or password");
            }
        }

        //THIS NEEDS REFACTORING!!!!
        else {
            throw new \Exception("Wrong name or password");
        }

        //NEEDS TO BE REWRITTEN!
        //User credentials are to be compared to the ones in the userdatabase file.

        // Validation in model, if validation in view for some reason wont work...
       /* if(empty($username)){
            throw new \Exception("Username is missing");
        }

        // Validation in model, if validation in view for some reason wont work...
        if(empty($password)){
            throw new \Exception("Password is missing");
        }

        if($username !== self::$username || $password !== self::$password){
            throw new \Exception("Wrong name or password");
        }*/

        //$_SESSION[$this->isLoggedInSession] = true;
        //return true;
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