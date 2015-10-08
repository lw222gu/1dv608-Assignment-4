<?php

namespace model;
class Register
{
    private $userAlreadyExists = false;

    public function __construct()
    {
        //Do I even need this constructor?
    }

    public function checkIfUserExists($username)
    {
        if(file_exists("data/" . $username . ".txt")){
            $this->userAlreadyExists = true;
            return true;
        }

        else {
            $this->userAlreadyExists = false;
            return false;
        }
    }

    public function saveUser($username, $password){
        $newFile = fopen("data/" . $username . ".txt", "w");
        $input = password_hash($password, PASSWORD_DEFAULT);
        fwrite($newFile, $input);
        fclose($newFile);
    }

    public function getUserExistsStatus(){
        return $this->userAlreadyExists;
    }
}