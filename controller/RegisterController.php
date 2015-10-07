<?php

class RegisterController {

    private $register;
    private $registerView;
    private $isUserInputValid;

    public function __construct(model\Register $register, RegisterView $registerView){
        $this->register = $register;
        $this->registerView = $registerView;
        $this->checkUserInput();
    }

    public function checkUserInput(){
        if($this->registerView->didUserPressRegisterButton()){

            $username = $this->registerView->getUsernameInput();
            $password = $this->registerView->getPasswordInput();
            $passwordRepeat = $this->registerView->getPassWordRepeatInput();

            //I should probably put this in a try-catch
            if($this->register->checkIfUserExists($username)){
                $this->registerView->userAlreadyExists = true;
            }

            $this->isUserInputValid = $this->registerView->checkUserInput($username, $password, $passwordRepeat);

            if($this->isUserInputValid){
                $this->register->saveUser($username, $password);
            }
        }
    }

}