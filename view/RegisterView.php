<?php

class RegisterView {

    private static $messageId = 'RegisterView::Message';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $register = 'RegisterView::Register';

    private $message;
    private $savedUsername = "";
    public $userAlreadyExists;
    public $wantsToRegisterUser = false;

    public function didUserPressRegisterButton(){
        if(isset($_POST[self::$register])){
            return true;
        }
        return false;
    }

    public function getUsernameInput(){
        return $_POST[self::$name];
    }

    public function getPasswordInput(){
        return $_POST[self::$password];
    }

    public function getPassWordRepeatInput(){
        return $_POST[self::$passwordRepeat];
    }

    public function checkUserInput($username, $password, $passwordRepeat){

        if(strlen($username) > 2){
            $this->message = "";
            $this->savedUsername = $username;
        } else {
            $this->savedUsername = $username;
            $this->message = "Username has too few characters, at least 3 characters. <br/>";
        }

        if(strlen($password) < 6){
            $this->message .= "Password has too few characters, at least 6 characters. <br/>";
        }

        if($password != $passwordRepeat){
            $this->message .= "Passwords do not match. <br/>";
        }

        if($this->userAlreadyExists){
            $this->message .= "User exists, pick another username.";
        }

        if($this->message == ""){
            return true;
        }

        return false;
    }

   /* public function getMessage(){
        return $this->message;
    } */

   /* public function setErrorMessage($e){
        $this->message = $e->getMessage();
    }*/

    public function renderRegisterLink(){
        if(strpos("$_SERVER[REQUEST_URI]", "?register")){
            $this->wantsToRegisterUser = true;
            return '<a href="?">Back to login</a>';
        }

        else {
            return '<a href="?register">Register a new user</a>';
        }
    }

    public function response() {
        $response = $this->renderRegisterForm($this->message);
        return $response;
    }

    public function renderRegisterForm($message){
        return '
            <h2>Register new user</h2>
            <form method="post" >
                <fieldset>
                    <legend>Register a new user - Write username and password</legend>
                    <p id="' . self::$messageId . '">' . $message . '</p>
                    <br />

                    <label for="' . self::$name . '">Username :</label>
                    <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->savedUsername . '" />
                    <br />

                    <label for="' . self::$password . '">Password :</label>
                    <input type="password" size="20" id="' . self::$password . '" name="' . self::$password . '" value="" />
                    <br />

                    <label for="' . self::$passwordRepeat . '">Repeat password  :</label>
                    <input type="password" size="20" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" value="" />
                    <br />

                    <input type="submit" name="' . self::$register . '" value="Register" />
                </fieldset>
            </form>
        ';
    }
}