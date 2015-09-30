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

            $this->isUserInputValid = $this->registerView->checkUserInput($username, $password, $passwordRepeat);

            try {
                if($this->isUserInputValid){
                    $this->register->checkUserInput($username, $password);
                }
            }

            catch (Exception $e){
                $this->registerView->setErrorMessage($e);
            }

            if($this->register->getIsUserSavedStatus()){
                //Tell views to show login form.
            }

            //If the user could not be saved, tell view to show an error message
            //if(!$this->register->saveUser()){
            //    $this->registerView->(false);
            //}


            /*//try
            //send user input to register model
            try{
                //$username = $this->registerView->getUsernameInput();
                //$password = $this->registerView->getPasswordInput();
                //$passwordRepeat = $this->registerView->getPassWordRepeatInput();

                //send user input to register model
            }

            catch(Exception $e) {
                $this->registerView->setErrorMessage($e);
            }*/
        }
    }

}