<?php

namespace view;
class RegisterView {

    private static $messageId = 'RegisterView::Message';
    private static $name = 'RegisterView::UserName';
    private static $password = 'RegisterView::Password';
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';
    private static $register = 'RegisterView::Register';

    private $tempUserSession = "tempUser";
    private $message;
    private $savedUsername = "";

    private $userAlreadyExists;
    private $isUserSaved = false;

    /**
     * Functions below gets and sets private members
     * which needs to be accessible through other classes.
     */
    public function setUserAlreadyExists($userAlreadyExists){
        $this->userAlreadyExists = $userAlreadyExists;
    }

    public function getIsUserSavedStatus(){
        return $this->isUserSaved;
    }

    /**
     * Functions below sets redirects and saves user information
     * as a temporary user object in session.
     */
    private function redirect(){
        $tempUser = new \model\TempUser($this->message, $this->savedUsername);
        $_SESSION[$this->tempUserSession] = $tempUser;
        $actualLink = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        header("Location: $actualLink");
    }

    public function getTempUser(){
        if(isset($_SESSION[$this->tempUserSession])){
            return $_SESSION[$this->tempUserSession];
        }
        return null;
    }

    public function unsetTempUserSessionSession(){
        if(isset($_SESSION[$this->tempUserSession])){
            unset($_SESSION[$this->tempUserSession]);
        }
    }

    /**
     * Functions below gets input from user,
     * and sets messages.
     */
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
        $this->savedUsername = $username;
        if(strlen($username) > 2){
            $this->message = "";
        } else {
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

    /**
     * Functions below generates output html.
     */
    public function response() {
        $response = $this->renderRegisterForm($this->message);
        return $response;
    }

    private function renderRegisterForm($message){
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