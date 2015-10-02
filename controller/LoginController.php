<?php

class LoginController
{
    private $loginView;
    private $loginModel;

    public function __construct(\model\Login $login, LoginView $v){
        $this->loginView = $v;
        $this->loginModel = $login;
    }

    public function checkUserInput()
    {
        /** State check:
         * Only tries to log in if user pressed login button AND is logged out.
         */
        if ($this->loginView->didUserPressLoginButton() && !$this->loginModel->checkIfLoggedIn()) {
            $username = $this->loginView->usernameInput();
            $password = $this->loginView->passwordInput();

            if($this->loginView->checkUserInput($username, $password)){
                if($this->loginModel->checkUserInput($username, $password)){
                    $this->loginView->setLoginMessage();
                }
                else {
                    $this->loginView->setWrongCredentialsMessage();
                }
            }
        }

        /** State check:
         * Only logs out if user pressed logout button AND is logged in.
         */
        if($this->loginView->didUserPressLogoutButton() && $this->loginModel->checkIfLoggedIn()){
            $this->loginView->setLogoutMessage();
            $this->loginModel->Logout();
        }
    }
}