<?php

//INCLUDE THE FILES NEEDED
require_once('Settings.php');
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');
require_once('view/NavigationView.php');
require_once('model/Login.php');
require_once('model/Register.php');
require_once('model/TempUser.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');

//START SESSION
session_start();

//MAKE SURE ERRORS ARE SHOWN
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//CREATE MODEL OBJECTS
$login = new model\Login();
$register = new model\Register();

//CREATE OBJECTS OF THE VIEWS
$loginView = new view\LoginView($login);
$dateTimeView = new view\DateTimeView();
$registerView = new view\RegisterView();
$layoutView = new view\LayoutView();
$navigationView = new view\NavigationView($loginView, $registerView);

//START CONTROLLERS
$loginController = new controller\LoginController($login, $loginView);
$registerController = new controller\RegisterController($register, $registerView);

//START RENDERING USER INTERFACE
$layoutView->render($login->checkIfLoggedIn(),$dateTimeView, $navigationView);