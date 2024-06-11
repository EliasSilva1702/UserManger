<?php
include("manager.php");

$error = "";

if (
    !isset($_POST["name"])
    || !isset($_POST["lastname"])
    || !isset($_POST["email"])
    || !isset($_POST["password"])
) {
    $error = "Faltan datos";
}

if ($error !== "") {
    setcookie("error", $error, time() + 5, "/");
    header("location: ../SignIn");
    return;
}


$name = $_POST["name"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$password = $_POST["password"];

$sql = "INSERT INTO users (name,lastname,email,password) VALUES ('" . $name . "','" . $lastname . "','" . $email . "','" . $password . "')";

if (mysqli_query($conn, $sql)) {

    $UserSession->SetCurrentEmail($email);
    $User->SetUser($email);    

    $success = "Welcome, " . $User->GetName() . ".";

    setcookie("success", $success, time() + 5, "/");

    header("location: ../home");

} else {

    $error = "Something went wrong... (T-T)";
    setcookie("error", $error, time() + 5, "/");
    header("location: ../SignIn");
}
mysqli_close($conn);

