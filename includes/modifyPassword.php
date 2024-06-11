<?php

include_once("manager.php");



$currentPassword = '';
$newPassword = '';
$confirmPassword = '';
$error = "";
// verifica que existan los datos necesarios
if (
  !isset($_POST["current-password"])
  || !isset($_POST["new-password"])
  || !isset($_POST["confirm-password"])
) {
  $error = "Faltan datos";
} else {


  $currentPassword = $_POST['current-password'];
  $newPassword = $_POST['new-password'];
  $confirmPassword = $_POST['confirm-password'];

  if ($currentPassword == "" || $newPassword == "" || $confirmPassword == "") {
    $error = "Faltan datos";
  } else if ($newPassword != $confirmPassword) {
    
    $error = "Las contraseñas no coinciden";
  
  }
}


if ($error !== "") {
  setcookie("error", $error, time() + 2, "/");
  header("location: ../MyProfile");
  return;
}



// sql para modificar la entidad
$sql = "UPDATE `users` SET `password`='$newPassword'  WHERE id='" . $User->GetId() . "'";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {

  $success = "Contraseña modificada exitosamente.";

  setcookie("success", $success, time() + 5, "/");
  header("location: ../MyProfile");
} else {
  $error = "No se pudo modificar su contrsaeña.";

  setcookie("error", $error, time() + 5, "/");
  header("location: ../MyProfile");
}

mysqli_close($conn);