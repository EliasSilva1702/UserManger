<?php

include_once("manager.php");


$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_POST["name"]) &&
    !isset($_GET["id_category"])
) {
    $error = "Faltan datos";
}

if ($error !== "") {
    setcookie("error", $error, time() + 5, "/");
    header("Location: ../AdminCategories");
    return;
}

$name = $_POST['name'];
$id_category = $_GET['id_category'];

//sql para insertar la categoria
$sql = "UPDATE `categories` SET `name`='" . $name . "' WHERE id='".$id_category."'";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {


    $success = "Categoria modificada";

    setcookie("success", $success, time() + 5, "/");
    header("location: ../AdminCategories");
} else {
    $error = "No se pudo modificar la categoria.";
    
    setcookie("error", $error, time() + 5, "/");
    header("location: ../AdminCategories");
}

mysqli_close($conn);
?>