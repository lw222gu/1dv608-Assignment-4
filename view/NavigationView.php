<?php

namespace view;
class NavigationView{

    private $loginView;
    private $registerView;
    private $wantsToRegisterUser;
    public $isUserSaved = true;

    public function __construct(\view\LoginView $loginView, \view\RegisterView $registerView){
        $this->loginView = $loginView;
        $this->registerView = $registerView;
    }

    public function renderRegisterLink(){

        if((strpos("$_SERVER[REQUEST_URI]", "?register") && $this->registerView->isUserSaved)
            || $this->loginView->didUserPressLogoutButton()
            || $this->loginView->didUserPressLoginButton()){
            $this->wantsToRegisterUser = false;
            return '<a href="?register">Register a new user</a>';
        }

        if(strpos("$_SERVER[REQUEST_URI]", "?register") && !$this->registerView->isUserSaved){
            $this->wantsToRegisterUser = true;
            return '<a href="?">Back to login</a>';
        }

        else {
            return '<a href="?register">Register a new user</a>';
        }
    }

    public function setResponse(){
        //If user logged in or out, show login view
        if($this->loginView->didUserPressLoginButton() || $this->loginView->didUserPressLogoutButton()){
            return $this->loginView->response();
        }

        //If user pressed register a new user, show register form from register view
        if ($this->wantsToRegisterUser == true){
            return $this->registerView->response();
        }

        //If user just started the application, show login form from login view
        if(!$this->registerView->isUserSaved && !$this->wantsToRegisterUser){
            return $this->loginView->response();
        }

        //If user is saved -> return login form with success message
        if($this->registerView->isUserSaved){
            $this->registerView->isUserSaved = false;
            $this->loginView->savedUsername = $this->registerView->savedUsername;
            $this->loginView->message = "Registered new user.";
            return $this->loginView->response();
        }
    }

}