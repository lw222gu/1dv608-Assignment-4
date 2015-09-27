<?php


class LoginView {
    private static $login = 'LoginView::Login';
    private static $logout = 'LoginView::Logout';
    private static $name = 'LoginView::UserName';
    private static $password = 'LoginView::Password';
    private static $cookieName = 'LoginView::CookieName';
    private static $cookiePassword = 'LoginView::CookiePassword';
    private static $keep = 'LoginView::KeepMeLoggedIn';
    private static $messageId = 'LoginView::Message';

    private $loginModel;
    private $message = "";
    private $savedUsername = "";

    public function __construct(\model\Login $login){
        $this->loginModel = $login;
    }

    /**
     * Functions below gets input from user.
     */
    public function didUserPressLoginButton(){
        if(isset($_POST[self::$login])){
            return true;
        }
        return false;
    }

    public function usernameInput(){
        if(!empty($_POST[self::$name])){
            $this->savedUsername = $_POST[self::$name];
            return $_POST[self::$name];
        }

        else {
            throw new Exception("Username is missing");
        }
    }

    public function passwordInput(){
        if(!empty($_POST[self::$password])){
            return $_POST[self::$password];
        }

        else {
            throw new Exception("Password is missing");
        }
    }

    public function didUserPressLogoutButton(){
        if(isset($_POST[self::$logout])) {
            return true;
        }
        return false;
    }


    /**
     * Functions below sets messages.
     */
    public function setErrorMessage($e){
        $this->message = $e->getMessage();
    }

    public function setLoginMessage(){
        $this->message = "Welcome";
    }

    public function setLogoutMessage(){
        $this->message = "Bye bye!";
    }


    /**
     * Create HTTP response
     *
     * Should be called after a login attempt has been determined
     *
     * @return  void BUT writes to standard output and cookies!
     */
    public function response() {
        if($this->loginModel->checkIfLoggedIn()){
            $response = $this->generateLogoutButtonHTML($this->message);
        }

        else {
            $response = $this->generateLoginFormHTML($this->message);
        }

        return $response;
    }

    /**
    * Generate HTML code on the output buffer for the logout button
    * @param $message, String output message
    * @return  void, BUT writes to standard output!
    */
    private function generateLogoutButtonHTML($message) {
        return '
            <form  method="post" >
                <p id="' . self::$messageId . '">' . $message .'</p>
                <input type="submit" name="' . self::$logout . '" value="logout"/>
            </form>
        ';
    }

    /**
    * Generate HTML code on the output buffer for the logout button
    * @param $message, String output message
    * @return  void, BUT writes to standard output!
    */
    private function generateLoginFormHTML($message) {
        return '
            <form method="post" >
                <fieldset>
                    <legend>Login - enter Username and password</legend>
                    <p id="' . self::$messageId . '">' . $message . '</p>

                    <label for="' . self::$name . '">Username :</label>
                    <input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->savedUsername . '" />

                    <label for="' . self::$password . '">Password :</label>
                    <input type="password" id="' . self::$password . '" name="' . self::$password . '" />

                    <label for="' . self::$keep . '">Keep me logged in  :</label>
                    <input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

                    <input type="submit" name="' . self::$login . '" value="login" />
                </fieldset>
            </form>
        ';
    }

    //CREATE GET-FUNCTIONS TO FETCH REQUEST VARIABLES
    private function getRequestUserName() {
        //RETURN REQUEST VARIABLE: USERNAME
    }
	
}