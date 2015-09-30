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

            if($this->isUserInputValid){
                $this->register->checkUserInput($username, $password, $passwordRepeat);
            }
            //Om isUserInputValid, skicka den då till model\Register för att se att den inte finns i
            //databasen. Om den inte finns i databasen så lägg till den.


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