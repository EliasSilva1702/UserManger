<?php


include_once("manager.php");

$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_GET["id_user"])
) {
    $error = "Faltan datos";
} else {

    if ($User->GetId() == $_GET["id_user"]) {
        $error = "Usted no puede eliminarse a sí mismo.";
    }
}

if (!$User->GetPermission("can_delete_users")) {
    $error = "Usted no cuenta con los permisos necesarios.";
}

if ($error !== "") {
    setcookie("error", $error, time() + 2, "/");
    header("Location: ../Franchisee");
    return;
}

$id = $_GET['id_user'];

//sql para eliminar las categorias
$sql = "DELETE FROM `users_franchised` WHERE id_user='$id' or id_franchised='$id'";
if (!mysqli_query($conn, $sql)) {

    $error = "Error al eniminar relacion con otros usuarios.";

    setcookie("error", $error, time() + 2, "/");
    header("location: ../Franchisee");
}

//sql para eliminar las imagenes
$sql = "DELETE FROM `users_profile_picture_urls` WHERE id_user='$id'";
if (!mysqli_query($conn, $sql)) {

    $error = "Error al eniminar foto de perfil.";

    setcookie("error", $error, time() + 2, "/");
    header("location: ../Franchisee");
}
//sql para eliminar los permisos
$sql = "DELETE FROM `users_admins` WHERE id_user='$id'";
if (!mysqli_query($conn, $sql)) {

    $error = "Error al eniminar los permisos.";

    setcookie("error", $error, time() + 2, "/");
    header("location: ../Franchisee");
}

//sql para eliminar al usuario
$sql = "DELETE FROM `users` WHERE id='$id'";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {

    $success = "Usuario eliminado";

    setcookie("success", $success, time() + 2, "/");
    header("location: ../Franchisee");
} else {
    $error = "No se pudo eliminar al usuario.";

    setcookie("error", $error, time() + 2, "/");
    header("location: ../Franchisee");
}

mysqli_close($conn);
