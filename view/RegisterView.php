<?php

class RegisterView {

    private static $messageId = 'RegisterView::Message';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $register = 'RegisterView::Register';

    private $message;

    public $wantsToRegisterUser = false;


    public function didUserPressRegisterButton(){
        if(isset($_POST[self::$register])){
            return true;
        }
        return false;
    }

    public function getUsernameInput(){
        if(strlen($_POST[self::$name]) > 2){
            return $_POST[self::$name];
        }

        else {
            throw new Exception("Username has too few characters, at least 3 characters.");
        }
    }

    public function getPasswordInput(){
        if(strlen($_POST[self::$password]) > 5){
            return $_POST[self::$password];
        }

        else {
            throw new Exception("Password has too few characters, at least 6 characters.");
        }
    }

    public function getPassWordRepeatInput(){
        return $_POST[self::$passwordRepeat];
    }

    public function setErrorMessage($e){
        $this->message = $e->getMessage();
    }

    public function renderRegisterLink(){
        //$url = "$_SERVER[REQUEST_URI]";
        if(strpos("$_SERVER[REQUEST_URI]", "?register")){
            $this->wantsToRegisterUser = true;
            return '<a href="?">Back to login</a>';
        }

        else {
            return '<a href="?register">Register a new user</a>';
        }
    }

    public function renderRegisterForm(){
        return '
            <h2>Register new user</h2>
            <form method="post" >
                <fieldset>
                    <legend>Register a new user - Write username and password</legend>
                    <p id="' . self::$messageId . '">' . $this->message . '</p>
                    <br />

                    <label for="' . self::$name . '">Username :</label>
                    <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />
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