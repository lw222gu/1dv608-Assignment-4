<?php

namespace view;
class NavigationView{

    private $loginView;
    private $registerView;
    private $wantsToRegisterUser;

    public function __construct(\view\LoginView $loginView, \view\RegisterView $registerView){
        $this->loginView = $loginView;
        $this->registerView = $registerView;
    }

    public function renderRegisterLink(){

        if((strpos("$_SERVER[REQUEST_URI]", "?register") && $this->registerView->getIsUserSavedStatus())
            || $this->loginView->didUserPressLogoutButton()
            || $this->loginView->didUserPressLoginButton()){
            $this->wantsToRegisterUser = false;
            return '<a href="?register">Register a new user</a>';
        }

        if(strpos("$_SERVER[REQUEST_URI]", "?register") && !$this->registerView->getIsUserSavedStatus()){
            $this->wantsToRegisterUser = true;
            return '<a href="?">Back to login</a>';
        }

        else {
            return '<a href="?register">Register a new user</a>';
        }
    }

    public function setResponse(){

        if ($this->wantsToRegisterUser == true){
            return $this->registerView->response();
        }

        if($this->loginView->didUserPressLogoutButton() || $this->loginView->didUserPressLoginButton()){
            $this->registerView->unsetTempUserSessionSession();
            return $this->loginView->response();
        }

        if($this->registerView->getTempUser() != null){
            $tempUser = $this->registerView->getTempUser();
            $this->loginView->setTempUserInformation($tempUser->getMessage(), $tempUser->getSavedUsername());
            return $this->loginView->response();
        }

        return $this->loginView->response();
    }
}