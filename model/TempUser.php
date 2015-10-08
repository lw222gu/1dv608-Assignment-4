<?php

namespace model;
class TempUser{

    private $sessionMessage;
    private $savedUsername;

    public function __construct($sessionMessage, $savedUsername){
        $this->sessionMessage = $sessionMessage;
        $this->savedUsername = $savedUsername;
    }

    public function getSessionMessage(){
        return $this->sessionMessage;
    }

    public function getSavedUsername(){
        return $this->savedUsername;
    }

}