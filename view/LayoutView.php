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

    //Set response beroende på om användaren valt att registrera en ny user eller inte.
    private function setResponse(RegisterView $rv, LoginView $v){
        if ($rv->wantsToRegisterUser == true){
            return $rv->response();
            //bör nog kalla på en response som i sin tur returnerar olika beroende på om validering är ok eller inte.
        }

        else {
            return $v->response();
        }
    }

}
