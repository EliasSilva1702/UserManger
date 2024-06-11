<?php


include_once("manager.php");

$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_POST["id_product"])
) {
    $error = "Faltan datos";
}

if (!$User->GetPermission("can_delete_products")) {
    $error = "Usted no cuenta con los permisos necesarios.";
}

if ($error !== "") {
    setcookie("error", $error, time() + 5, "/");
    header("Location: ../AdminProducts");
    return;
}


$id = $_POST['id_product'];

//sql para eliminar las categorias
$sql = "DELETE FROM `products_categories` WHERE id_product='$id'";
if (!mysqli_query($conn, $sql)) {

    $error = "Error al eniminar categorias.";

    setcookie("error", $error, time() + 5, "/");
    header("location: ../AdminProducts");
}

//sql para eliminar las imagenes
$sql = "DELETE FROM `products_url_photos` WHERE id_product='$id'";
if (!mysqli_query($conn, $sql)) {

    $error = "Error al eniminar imagenes.";

    setcookie("error", $error, time() + 5, "/");
    header("location: ../AdminProducts");
}
//sql para eliminar
$sql = "DELETE FROM `products` WHERE id='$id'";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {

    $success = "Producto eliminado";

    setcookie("success", $success, time() + 5, "/");
    header("location: ../AdminProducts");
} else {
    $error = "No se pudo eliminar el producto.";

    setcookie("error", $error, time() + 5, "/");
    header("location: ../AdminProducts");
}

mysqli_close($conn);
?>