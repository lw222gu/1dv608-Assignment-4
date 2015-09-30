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
        if($rv->isUserSaved){
            $v->savedUsername = $rv->savedUsername;
            $v->message = "Registered new user.";
            return $v->response();
        }

        if(!$rv->wantsToRegisterUser){

            return $v->response();
        }

        if ($rv->wantsToRegisterUser == true){
            return $rv->response();
        }
    }

}
