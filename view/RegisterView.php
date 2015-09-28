<?php

class RegisterView {
    public function renderRegisterLink(){
        //$url = "$_SERVER[REQUEST_URI]";
        if(strpos("$_SERVER[REQUEST_URI]","?register")){
            return '<a href="?">Back to login</a>';
        }

        else {
            return '<a href="?register">Register a new user</a>';
        }
    }
}