<?php
namespace model;

class Register
{

    private $username;
    private $password;
   // private $isUserSaved = false;
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
        //If it exists, throw new Exception("User exists, pick another username.")...
        //Else $this->saveUser();
    }

    public function saveUser($username, $password){
        //Save new user in userdatabase file,
        //with $this->username and $this->password as credentials.
        //INSERT INTO `lisawestlund_se_db_1`.`Users` (`Username`, `Password`) VALUES ('Admin', 'Password');
        $newFile = fopen("data/" . $username . ".txt", "w");
        //$input = "$username, $password";
        $input = password_hash($password, PASSWORD_DEFAULT);
        fwrite($newFile, $input);
        //$this->isUserSaved = true;
    }

    /*public function getIsUserSavedStatus(){
        return $this->isUserSaved;
    }*/

    public function getUserExistsStatus(){
        return $this->userAlreadyExists;
    }
}