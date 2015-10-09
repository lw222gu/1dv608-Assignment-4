<?php

namespace view;
class LoginView {
    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';

    private $loginModel;
    private $message = "";
    private $username = "";

    public function __construct(\model\Login $login){
        $this->loginModel = $login;
    }

    /**
     * Functions below gets and checks input from user, and sets messages.
     */
    public function didUserPressLoginButton(){
        if(isset($_POST[self::$login])){
            return true;
        }
        return false;
    }

    public function didUserPressLogoutButton(){
        if(isset($_POST[self::$logout])) {
            return true;
        }
        return false;
    }

    public function usernameInput(){
        $this->username = $_POST[self::$name];
        return $_POST[self::$name];
    }

    public function passwordInput(){
        return $_POST[self::$password];
    }

    public function checkUserInput(){
        if($this->username == ""){
            $this->message = "Username is missing";
            return false;
        }

        if($this->passwordInput() == ""){
            $this->message = "Password is missing";
            return false;
        }
        return true;
    }

    public function setWrongCredentialsMessage(){
        $this->message = "Wrong name or password";
    }

    public function setLoginMessage(){
        $this->message = "Welcome";
    }

    public function setLogoutMessage(){
        $this->message = "Bye bye!";
    }

    /**
     * Function below sets temp user information, in case of redirect.
     */
    public function setTempUserInformation($message, $username){
        $this->message = $message;
        $this->username = $username;
    }

    /**
     * Functions below generates output html.
     */
    public function response() {

        if($this->loginModel->checkIfLoggedIn()){
            $response = $this->generateLogoutButtonHTML();
        }

        else {
            $response = $this->generateLoginFormHTML();
        }

        return $response;
    }

    private function generateLogoutButtonHTML() {
        return '
            <form  method="post" >
                <p id="' . self::$messageId . '">' . $this->message .'</p>
                <input type="submit" name="' . self::$logout . '" value="logout"/>
            </form>
        ';
    }

    private function generateLoginFormHTML() {
        return '
            <form method="post" >
                <fieldset>
                    <legend>Login - enter Username and password</legend>
                    <p id="' . self::$messageId . '">' . $this->message . '</p>

                    <label for="' . self::$name . '">Username :</label>
                    <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->username . '" />

                    <label for="' . self::$password . '">Password :</label>
                    <input type="password" id="' . self::$password . '" name="' . self::$password . '" />

                    <label for="' . self::$keep . '">Keep me logged in  :</label>
                    <input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

                    <input type="submit" name="' . self::$login . '" value="login" />
                </fieldset>
            </form>
        ';
    }
}