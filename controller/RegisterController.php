<?php

class RegisterController {

    private $register;
    private $registerView;

    public function __construct(model\Register $register, RegisterView $rv){
        $this->register = $register;
        $this->registerView = $rv;
        $this->checkUserInput();
    }

    public function checkUserInput(){
        if($this->registerView->didUserPressRegisterButton()){

            $this->registerView->checkUserInput();
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