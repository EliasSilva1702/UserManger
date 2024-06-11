<?php

include_once("manager.php");

$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_POST["firstname"])
    || !isset($_FILES['file'])
    || !isset($_POST["lastname"])
    || !isset($_POST["email"])
    || !isset($_POST["phone_number"])
    || !isset($_POST["address"])
    || !isset($_POST["department"])
    || !isset($_POST["region"])
    || !isset($_POST["position"])
    || !isset($_GET["id_user"])
) {
    $error = "Faltan datos";
} else {

    $users = $conn->query("SELECT * from users where email='" . $_POST["email"] . "'");
    if ($users->num_rows > 0) {

        $users = $conn->query("SELECT * from users where id='" . $_GET["id_user"] . "' and email='" . $_POST["email"] . "'");

        if (!$users->num_rows > 0) {

            $error = "Email en uso";
        }

    }

}

// verifica que los archivos estan subidos correctamente
if ($_FILES['file']['name'] !== "") {

    //chequea las extensiones
    $fileExt = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

    // Extensiones de archivo permitidas
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    // Verificar si la extensión del archivo es válida
    if (in_array($fileExt, $allowedExtensions)) {

        // Verificar si no hay errores en la subida del archivo
        if ($_FILES['file']['error'] > 0) {
            $error = "Error en la subida del archivo.";
        }
    } else {
        $error = 'El formato del archivo "' . $_FILES['file']['name'] . '" (' . $fileExt . ") es invalido";
    }

}
if (!$User->GetPermission("can_modify_users")) {
    $error = "Usted no cuenta con los permisos necesarios.";
}

if ($error !== "") {
    setcookie("error", $error, time() + 2, "/");
    header("location: ../Franchisee");
    return;
}

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$department = $_POST["department"];
$address = $_POST["address"];
$region = $_POST["region"];
$phone_number = $_POST["phone_number"];
$position = $_POST["position"];
$franchised = $_POST["franchised"];
$id_user = $_GET["id_user"];


//sql para insertar al usuario
$sql = "UPDATE `users` SET `name`='$firstname',`phone_number`='$phone_number',`lastname`='$lastname',`email`='$email',`region`='$region',`position`='$position',`address`='$address',`department`='$department' WHERE id='$id_user'";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {
    $sql = "DELETE FROM users_franchised WHERE id_franchised = '$id_user';";
    $conn->query($sql);

    if ($franchised != 'none') {

        $sql = "INSERT INTO `users_franchised`(`id_user`, `id_franchised`) VALUES ('" . $franchised . "','$id_user')";

    }

    if (!mysqli_query($conn, $sql)) {

        $error = "No se pudo agregar la relacion de franquiciado.";
        setcookie("error", $error, time() + 2, "/");

        header("location: ../Franchisee");
        return;

    }


    $users = $conn->query("SELECT * from users order by id asc");
    if ($_FILES['file']['name'] !== "") {

        // Verificar si se ha seleccionado un archivo
        if ($_FILES['file']['name'] !== "") {

            // Ruta de almacenamiento en el servidor
            $uploadPath = '../img/users/pfp/';

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

            $urls = $conn->query("SELECT * from users_profile_picture_urls where id_user='$id_user'");

            if ($urls->num_rows > 0) {

                $sql = "UPDATE `users_profile_picture_urls` SET `url`='$filesPath' WHERE id_user='$id_user'";

            } else {

                $sql = "INSERT INTO `users_profile_picture_urls`( `url`, `id_user`) VALUES ('$filesPath','$id_user')";
            }

            if (!mysqli_query($conn, $sql)) {
                $error = "No se pudo subir el archivo";

                setcookie("error", $error, time() + 2, "/");
                header("location: ../Franchisee");
                return;
            }

        }
    }
    $success = "Usuario modificado exitosamente.";

    setcookie("success", $success, time() + 2, "/");
    header("location: ../Franchisee");
} else {
    $error = "No se pudo modificar datos del usuario.";

    setcookie("error", $error, time() + 2, "/");
    header("location: ../Franchisee");
}

mysqli_close($conn);