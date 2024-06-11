
<?php

include_once("manager.php");


$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_POST["name"])
) {
    $error = "Faltan datos";
}

if ($error !== "") {
    setcookie("error", $error, time() + 5, "/");
    header("Location: ../AdminCategories");
    return;
}

$name = $_POST['name'];

//sql para insertar la categoria
$sql = "INSERT INTO `categories`(`name`) VALUES ('" . $name . "')";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {
 
  
    $success = "Categoria agregada";

    setcookie("success", $success, time() + 5, "/");
    header("location: ../AdminCategories");
} else {
    $error = "No se pudo agregar la categoria.";
    $activeSection = "Post";

    setcookie("error", $error, time() + 5, "/");
    header("location: ../AdminCategories");
}

mysqli_close($conn);
?>