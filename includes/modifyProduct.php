<?php

include_once("manager.php");


$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_POST["name"])
    || !isset($_POST["description"])
    || !isset($_POST["cost"])
    || !isset($_GET['id_product'])
) {
    $error = "Faltan datos";
}

// verifica que los archivos estan subidos correctamente
if (isset($_FILES['files']) && count($_FILES['files']['name']) > 0 && $_FILES['files']['name'][0] != "") {

    for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

        //chequea las extensiones
        $fileExt = strtolower(pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION));

        // Extensiones de archivo permitidas
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        // Verificar si la extensión del archivo es válida
        if (in_array($fileExt, $allowedExtensions)) {

            // Verificar si no hay errores en la subida del archivo
            if ($_FILES['files']['error'][$i] > 0) {
                $error = "Error en la subida del archivo.";
            }
        } else {
            $error = 'El formato del archivo "' . $_FILES['files']['name'][$i] . '" (' . $fileExt . ") es invalido";
        }

    }
}


if (!$User->GetPermission("can_modify_products")) {
    $error = "Usted no cuenta con los permisos necesarios.";
}

if ($error !== "") {
    setcookie("error", $error, time() + 5, "/");
    header("location: ../AdminProducts");
    return;
}


$description = $_POST['description'];
$name = $_POST['name'];
$cost = $_POST['cost'];
$id_product = $_GET['id_product'];


// sql para modificar la entidad
$sql = "UPDATE `products` SET `name`='" . $name . "',`description`='" . $description . "',`cost`='" . $cost . "' WHERE id='" . $id_product . "'";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {

    $conn->query("DELETE  from products_categories where id_product='" . $id_product . "';");

    //selecciona todas las categorias existentes
    $categories = $conn->query("SELECT * from categories;");

    //crea la relacion entre la publicacion y las categorias necesarias
    foreach ($categories as $key => $category) {

        //si la categoria está seleccionada entonces la agrega a la relacion
        if (isset($_REQUEST[$category['id']])) {

            $sql = "INSERT INTO `products_categories`(`id_product`, `id_category`) VALUES ('" . $id_product . "','" . $category['id'] . "')";

            if (!mysqli_query($conn, $sql)) {

                $error = "No se pudo agregar una de las categorias.";
                setcookie("error", $error, time() + 5, "/");

                header("location: ../AdminProducts");
                return;

            }
        }
    }

    // Verificar si se ha seleccionado un archivo
    if ($_FILES['files']['name'][0] !== "") {

        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

            // Ruta de almacenamiento en el servidor
            $uploadPath = '../img/products/' ;

            // Generar un nombre único para el archivo
            $newFileName = uniqid('', true) . '.' . $fileExt;


            //chequear si el directorio no existe
            if (!is_dir($uploadPath)) {
                //crea el directorio
                mkdir($uploadPath, 0777, true);
            }

            // Mover el archivo al directorio de almacenamiento
            move_uploaded_file($_FILES['files']['tmp_name'][$i], $uploadPath . $newFileName);

            // Guardar la ruta de la filesn en la base de datos
            $filesPath = $uploadPath . $newFileName;

            $sql = "INSERT INTO `products_url_photos`(`id_product`, `url`) VALUES ('" . $id_product . "','" . $filesPath . "')";

            if (!mysqli_query($conn, $sql)) {
                $error = "No se pudo subir una de las imagenes";

                setcookie("error", $error, time() + 5, "/");
                header("location: ../AdminProducts");
                return;
            }
        }
    }
    $success = "Producto modificado exitosamente.";

    setcookie("success", $success, time() + 5, "/");
    header("location: ../AdminProducts");
} else {
    $error = "No se pudo modificar el producto.";

    setcookie("error", $error, time() + 5, "/");
    header("location: ../AdminProducts");
}

mysqli_close($conn);