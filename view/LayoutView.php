<?php


class LayoutView {
  
    public function render($isLoggedIn, DateTimeView $dateTimeView, NavigationView $navigationView) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $navigationView->renderRegisterLink() . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '

          <div class="container">
              ' . $navigationView->setResponse() . '
              ' . $dateTimeView->show() . '
          </div>
         </body>
      </html>
    ';
    }

    private function renderIsLoggedIn($isLoggedIn) {
        if ($isLoggedIn) {
          return '<h2>Logged in</h2>';
        }
        else {
          return '<h2>Not logged in</h2>';
        }
    }

    /*public function setResponse(RegisterView $registerView, LoginView $loginView, NavigationView $navigationView){
        //If user is saved -> return login form with success message
        if($registerView->isUserSaved){
            $registerView->isUserSaved = false;
            $navigationView->isUserSaved = false;
            $loginView->savedUsername = $$registerView->savedUsername;
            $loginView->message = "Registered new user.";
            return $loginView->response();
        }

        //If user just started the application, show login form from login view
        if(!$navigationView->isUserSaved && !$registerView->wantsToRegisterUser){
            return $loginView->response();
        }

        //If user logged in or out, show login view
        if($loginView->didUserPressLoginButton() || $loginView->didUserPressLogoutButton()){
            return $loginView->response();
        }

        //If user pressed register a new user, show register form from register view
        if ($registerView->wantsToRegisterUser == true){
            return $registerView->response();
        }
    }*/
}
