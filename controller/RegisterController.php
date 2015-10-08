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
            $passwordRepeat = $this->registerView->getPassWordRepeatInput(); //denna behöver inte hämtas här och skickas tillbaka...

        //    if($this->register->checkIfUserExists($username)){
                $this->registerView->setUserAlreadyExists($this->register->checkIfUserExists($username));
        //    }

            $this->isUserInputValid = $this->registerView->checkUserInput($username, $password, $passwordRepeat);

            if($this->isUserInputValid){
                $this->register->saveUser($username, $password);
            }
        }
    }

}