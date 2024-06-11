<?php
include("manager.php");

$error = "";

if (
    !isset($_POST["f_num"])
    || !isset($_POST["password"])
) {
    $error = "Faltan datos";
}

if ($error !== "") {
    setcookie("error", $error, time() + 5, "/");
    header("location: ../LogIn");
    return;
}

$f_num = $_POST["f_num"];
$password = $_POST["password"];

if ($User->UserExist($f_num,$password)) {
   
    $UserSession->SetCurrentF_num($f_num);
    $User->SetUser($f_num);    

    $success = "Bienvenido a Bassai, " . $User->GetName() . ".";

    setcookie("success", $success, time() + 5, "/");

    header("location: ../MakeOrder");

}else{
    
    $error = "El usuario no existe";
    setcookie("error", $error, time() + 5, "/");

    header("location: ../LogIn");
    return;
}


mysqli_close($conn);

