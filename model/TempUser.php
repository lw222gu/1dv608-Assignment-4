<?php

namespace model;
class TempUser{

    private $message;
    private $savedUsername;

    public function __construct($message, $savedUsername){
        $this->message = $message;
        $this->savedUsername = $savedUsername;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getSavedUsername(){
        return $this->savedUsername;
    }
}