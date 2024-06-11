<?php

include_once("manager.php");

$id_order = "";

$error = "";

// verifica que existan los datos necesarios
if (
    !isset($_GET["id_order"])
    || !isset($_FILES['file'])
) {

    $error = "Faltan datos";

} else {
    $id_order = $_GET['id_order'];


    //chequea las extensiones
    $fileExt = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

    // Extensiones de archivo permitidas
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    // Verificar si la extensión del archivo es válida
    if (in_array($fileExt, $allowedExtensions)) {

        // Verificar si no hay errores en la subida del archivo
        if ($_FILES['file']['error'] > 0) {
            $error = "Error en la subida del comprobante.";
        }
    } else {
        $error = 'El formato del archivo "' . $_FILES['file']['name'] . '" (' . $fileExt . ") es invalido";
    }

    // verifica que existan los datos necesarios
    $sql = "SELECT * from orders where id='$id_order' and id_user='" . $User->GetId() . "'";
    $orders = $conn->query($sql);
    if (!$orders->num_rows > 0) {
        $error = "Su orden no existe o bien no es suya.";
    }
}

if ($error !== "") {
    setcookie("error", $error, time() + 2, "/");
    header("location: ../MyOrders");
    return;
}

// Verificar si se ha seleccionado un archivo
if ($_FILES['file']['name'] !== "") {

    // Ruta de almacenamiento en el servidor
    $uploadPath = '../img/orders/' . $User->GetF_num() . '/';

    // Generar un nombre único para el archivo
    $newFileName = uniqid('', true) . '.' . $fileExt;

    //chequear si el directorio no existe
    if (!is_dir($uploadPath)) {
        //crea el directorio
        mkdir($uploadPath, 0777, true);
    }

    // Mover el archivo al directorio de almacenamiento
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath . $newFileName);

    // Guardar la ruta de la filesn en la base de datos
    $filesPath = $uploadPath . $newFileName;


    $sql = "DELETE from orders_receipt where id_order='" . $id_order . "'";

    if (!mysqli_query($conn, $sql)) {
        $error = "No se pudo eliminar el comprobante anterior";

        setcookie("error", $error, time() + 2, "/");
        header("location: ../MyOrders");
        return;
    } else {

        $sql = "INSERT INTO `orders_receipt`(`id_order`, `url`) VALUES ('" . $id_order . "','" . $filesPath . "')";

        if (!mysqli_query($conn, $sql)) {
            $error = "No se pudo subir el comprobante";

            setcookie("error", $error, time() + 2, "/");
            header("location: ../MyOrders");
            return;
        } else {

            $success = "Comprobante enviado exitosamente.";

            setcookie("success", $success, time() + 2, "/");
            header("location: ../MyOrders");

        }
    }
}

mysqli_close($conn);