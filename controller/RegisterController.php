<?php

class RegisterController {

    private $register;
    private $registerView;
    private $isUserInputValid;

    public function __construct(model\Register $register, RegisterView $rv){
        $this->register = $register;
        $this->registerView = $rv;
        $this->checkUserInput();
    }

    public function checkUserInput(){
        if($this->registerView->didUserPressRegisterButton()){

            $username = $this->registerView->getUsernameInput();
            $password = $this->registerView->getPasswordInput();
            $passwordRepeat = $this->registerView->getPassWordRepeatInput();

            if($this->register->checkIfUserExists($username)){
                $this->registerView->userAlreadyExists = true;
            }

            $this->isUserInputValid = $this->registerView->checkUserInput($username, $password, $passwordRepeat);

            //try {
            if($this->isUserInputValid){
                $this->register->saveUser($username, $password);
               // $this->registerView->wantsToRegisterUser=false;
            }
            //}
            //catch (Exception $e){
            //    $this->registerView->setErrorMessage($e);
            //}

            if($this->register->getIsUserSavedStatus()){
                //Tell views to show login form.
                //$this->registerView->wantsToRegisterUser=false;
            }
        }
    }

}