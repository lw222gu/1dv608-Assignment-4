<?php
namespace model;

class Register
{

    private $username;
    private $password;
    private $passwordRepeat;

    public function __construct()
    {

    }

    public function checkUserInput($username, $password, $passwordRepeat)
    {
        $this->username = $username;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }
}