<?php

namespace controller;
class RegisterController {

    private $register;
    private $registerView;
    private $isUserInputValid;

    public function __construct(\model\Register $register, \view\RegisterView $registerView){
        $this->register = $register;
        $this->registerView = $registerView;
        $this->checkUserInput();
    }

    private function checkUserInput(){
        if($this->registerView->didUserPressRegisterButton()){

            $username = $this->registerView->getUsernameInput();
            $password = $this->registerView->getPasswordInput();

            $this->registerView->setUserAlreadyExists($this->register->checkIfUserExists($username));

            $this->isUserInputValid = $this->registerView->checkUserInput();

            if($this->isUserInputValid){
                $this->register->saveUser($username, $password);
            }
        }
    }

}