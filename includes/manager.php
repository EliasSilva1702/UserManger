<?php


date_default_timezone_set("America/Buenos_Aires");

include("connection.php");
include_once('user.php');
include_once('userSession.php');
$User = new User();
$UserSession = new UserSession();

$isUser = false;


$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];

if (isset($_SESSION['f_num'])) {
    // HAY SESION ACTIVA

    //carga los datos del usuario
    $User->SetUser($UserSession->GetCurrentF_num());

    $isUser = true;

}
