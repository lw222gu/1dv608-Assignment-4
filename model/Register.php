<?php

namespace model;
class Register
{
    private $userAlreadyExists = false;

    public function checkIfUserExists($username)
    {
        if(file_exists(\Settings::DATA_PATH . $username . ".txt")){
            $this->userAlreadyExists = true;
            return true;
        }

        else {
            $this->userAlreadyExists = false;
            return false;
        }
    }

    public function saveUser($username, $password){
        $newFile = fopen(\Settings::DATA_PATH . $username . ".txt", "w");
        $input = password_hash($password, PASSWORD_DEFAULT);
        fwrite($newFile, $input);
        fclose($newFile);
    }

    public function getUserExistsStatus(){
        return $this->userAlreadyExists;
    }
}