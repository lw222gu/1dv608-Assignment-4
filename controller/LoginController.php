<?php

class LoginController
{
    private $loginView;
    private $loginModel;

    public function __construct(\model\Login $login, LoginView $v){
        $this->loginView = $v;
        $this->loginModel = $login;
        $this->checkUserInput();
    }

    public function checkUserInput()
    {
        /** State check:
         * Only logs in if user pressed login button AND is logged out.
         */
        if ($this->loginView->didUserPressLoginButton() && !$this->loginModel->checkIfLoggedIn()) {
            try{
                $username = $this->loginView->usernameInput();
                $password = $this->loginView->passwordInput();

                if($this->loginModel->checkUserInput($username, $password)){
                    $this->loginView->setLoginMessage();
                }
            }

            catch(Exception $e){
                $this->loginView->setErrorMessage($e);
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