<?php


include_once("manager.php");

$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_POST["id_photo"])
) {
    $error = "Faltan datos";
}

if (!$User->GetPermission("can_modify_products")) {
    $error = "Usted no cuenta con los permisos necesarios.";
}

if ($error !== "") {
    setcookie("error", $error, time() + 5, "/");
    header("Location: ../AdminProducts");
    return;
}


$id = $_POST['id_photo'];

//sql para eliminar las imagenes
$sql = "DELETE FROM `products_url_photos` WHERE products_url_photos.id='$id'";

if (!mysqli_query($conn, $sql)) {

    $error = "Error al eniminar imagenes.";

    setcookie("error", $error, time() + 5, "/");
    header("location: ../AdminProducts");
}

mysqli_close($conn);
?>