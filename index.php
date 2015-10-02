<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('model/Login.php');
require_once('model/Register.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE MODEL OBJECTS
$login = new model\Login();
$register = new model\Register();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView($login);
$dtv = new DateTimeView();
$rv = new RegisterView();
$lv = new LayoutView();

//START CONTROLLERS
$loginController = new LoginController($login, $v);
$registerController = new RegisterController($register, $rv);

$loginController->checkUserInput();

$lv->render($login->checkIfLoggedIn(), $v, $dtv, $rv);
