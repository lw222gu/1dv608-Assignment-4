<?php
namespace model;

class Register
{

    private $username;
    private $password;
    private $isUserSaved = false;

    public function __construct()
    {
        //If userdatabase file do not exist, create it.
    }

    public function checkUserInput($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        //Search for username in userdatabase file.

        //If it exists, throw new Exception("User exists, pick another username.")...
        //Else $this->saveUser();
    }

    public function saveUser(){
        //Save new user in userdatabase file,
        //with $this->username and $this->password as credentials.
        $this->isUserSaved = true;
    }

    public function getIsUserSavedStatus(){
        return $this->isUserSaved;
    }
}