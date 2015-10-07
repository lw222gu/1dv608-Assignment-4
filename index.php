<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('view/NavigationView.php');
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
$v = new view\LoginView($login);
$dtv = new view\DateTimeView();
$rv = new view\RegisterView();
$lv = new view\LayoutView();
$nv = new view\NavigationView($v, $rv);

//START CONTROLLERS
$loginController = new controller\LoginController($login, $v);
$registerController = new controller\RegisterController($register, $rv);

//START RENDERING USER INTERFACE
$lv->render($login->checkIfLoggedIn(),$dtv, $nv);