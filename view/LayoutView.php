<?php


class LayoutView {
  
    public function render($isLoggedIn, LoginView $v, DateTimeView $dtv, RegisterView $rv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $rv->renderRegisterLink() . '
          ' . $this->renderIsLoggedIn($isLoggedIn) . '

          <div class="container">
              ' . $this->setResponse($rv, $v) . '

              ' . $dtv->show() . '
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

    private function setResponse(RegisterView $rv, LoginView $v){
        //If user is saved -> return login form with success message
        if($rv->isUserSaved){
            $rv->isUserSaved = false;
            $v->savedUsername = $rv->savedUsername;
            $v->message = "Registered new user.";
            return $v->response();
        }

        //If user just started the application, show login form from login view
        if(!$rv->isUserSaved && !$rv->wantsToRegisterUser){
            return $v->response();
        }

        //If user logged in or out, show login view
        if($v->didUserPressLoginButton() || $v->didUserPressLogoutButton()){
            return $v->response();
        }

        //If user pressed register a new user, show register form from register view
        if ($rv->wantsToRegisterUser == true){
            return $rv->response();
        }

    }

}
