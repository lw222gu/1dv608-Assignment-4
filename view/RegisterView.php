<?php

namespace view;
class RegisterView {

    private static $messageId = 'RegisterView::Message';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $register = 'RegisterView::Register';

    private $saveLocationSession = "saveLocation";
    private $message;
    public $savedUsername = "";
    public $userAlreadyExists;
    public $isUserSaved = false;

    public function redirect(){
        $tempUser = new \model\TempUser($this->message, $this->savedUsername);
        $_SESSION[$this->saveLocationSession] = $tempUser;
        $actualLink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        header("Location: $actualLink");
    }

    public function getTempUser(){
        if(isset($_SESSION[$this->saveLocationSession])){
            return $_SESSION[$this->saveLocationSession];
        }
        return null;
    }

    public function unsetSaveLocationSession(){
        if(isset($_SESSION[$this->saveLocationSession])){
            unset($_SESSION[$this->saveLocationSession]);
        }
    }

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

    public function setRegister($value){
        self::$register = $value;
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
            $this->message .= "User exists, pick another username. <br />";
        }
        if(strlen($username) != strlen(strip_tags($username))) {
            $this->message .= "Username contains invalid characters.";
            $this->savedUsername = strip_tags($username);
        }

        if($this->message == ""){
            $this->isUserSaved = true;
            $this->message = "Registered new user.";
            $this->redirect();
            return true;
        }
        return false;
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