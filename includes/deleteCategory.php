<?php

include_once("manager.php");

$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_GET["id"])
) {
    $error = "Faltan datos";
}

if (!$User->GetPermission("can_delete_categories")) {
    $error = "Usted no cuenta con los permisos necesarios.";
}

if ($error !== "") {
    setcookie("error", $error, time() + 5, "/");
    header("Location: ../AdminCategories");
    return;
}


$id = $_GET['id'];

//sql para eliminar los productos conectados
$sql = "DELETE FROM `products_categories` WHERE id_category='$id'";
if (!mysqli_query($conn, $sql)) {

    $error = "Error al eniminar productos.";

    setcookie("error", $error, time() + 5, "/");
    header("location: ../AdminCategories");
}

//sql para eliminar
$sql = "DELETE FROM `categories` WHERE id='$id'";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {

    $success = "Categoria eliminada";

    setcookie("success", $success, time() + 5, "/");
    header("location: ../AdminCategories");
} else {
    $error = "No se pudo eliminar la Categoria.";

    setcookie("error", $error, time() + 5, "/");
    header("location: ../AdminCategories");
}

mysqli_close($conn);
?>