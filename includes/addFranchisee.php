<?php

include_once("manager.php");

$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_FILES['file'])
    || !isset($_POST["firstname"])
    || !isset($_POST["lastname"])
    || !isset($_POST["f_num"])
    || !isset($_POST["password"])
    || !isset($_POST["email"])
    || !isset($_POST["phone_number"])
    || !isset($_POST["address"])
    || !isset($_POST["department"])
    || !isset($_POST["region"])
    || !isset($_POST["position"])
    || !isset($_POST["franchised"])
) {
    $error = "Faltan datos";
} else {

    $users = $conn->query("SELECT * from users where email='" . $_POST["email"] . "'");
    if ($users->num_rows > 0) {

        $error = "Email en uso";
    }

    $users = $conn->query("SELECT * from users where f_num='" . $_POST["f_num"] . "'");
    if ($users->num_rows > 0) {

        $error = "Número de franquiciado en uso";
    }
}

// verifica que los archivos estan subidos correctamente
if (isset($_FILES['file'])) {

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
if (!$User->GetPermission("can_add_users")) {
    $error = "Usted no cuenta con los permisos necesarios.";
}

if ($error !== "") {
    setcookie("error", $error, time() + 2, "/");
    header("location: ../Franchisee");
    return;
}

$positions = [
    "Coordinador",
    "Supervisor",
    "Lider de equipo",
    "Director regional"
];

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"];
$files = $_FILES['file'];
$department = $_POST["department"];
$address = $_POST["address"];
$region = $_POST["region"];
$position = $_POST["position"];
$franchised = $_POST["franchised"];
$password = $_POST["password"];
$f_num = $_POST["f_num"];


//sql para insertar al usuario
$sql = "INSERT INTO `users`(`name`, `lastname`, `password`, `email`, `phone_number`, `f_num`, `region`, `position`, `address`, `department`) VALUES ('$firstname','$lastname','$password','$email','$phone_number','$f_num','$region','$position','$address','$department')";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {

    $userId = "";

    $users = $conn->query("SELECT * from users order by id asc");
    foreach ($users as $key => $value) {
        $userId = $value['id'];
    }

    foreach ($users as $key => $user) {
        if ($user['id'] == $franchised) {

            $sql = "INSERT INTO `users_franchised`(`id_user`, `id_franchised`) VALUES ('" . $franchised . "','$userId')";

            if (!mysqli_query($conn, $sql)) {

                $error = "No se pudo agregar la relacion de franquiciado.";
                setcookie("error", $error, time() + 2, "/");

                header("location: ../Franchisee");
                return;

            }
        }
    }



    // Verificar si se ha seleccionado un archivo
    if ($_FILES['file']['name'][0] !== "") {

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


        $sql = "INSERT INTO `users_profile_picture_urls`(`id_user`,`url`) VALUES ('" . $userId . "','" . $filesPath . "')";

        if (!mysqli_query($conn, $sql)) {
            $error = "No se pudo subir el archivo";

            setcookie("error", $error, time() + 2, "/");
            header("location: ../Franchisee");
            return;
        }

    }

    //agrega permisos
    $sql = "SELECT * from users where id='" . $userId . "'";
    $users = $conn->query($sql);

    foreach ($users as $key => $user) {

        for ($i = 0; $i < count($positions); $i++) {
            if ($user['position'] == $positions[$i]) {
                $sql = "INSERT INTO `users_admins`(`id_user`, `can_add_products`, `can_modify_products`, `can_delete_products`, `can_add_admins`, `can_modify_admins`, `can_delete_admins`, `can_add_categories`, `can_modify_categories`, `can_delete_categories`, `can_see_orders`, `can_add_users`, `can_modify_users`, `can_delete_users`) VALUES ('$userId','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y')";
                $conn->query($sql);

                break;
            }
        }

    }

    $success = "Usuario agregado exitosamente.";

    setcookie("success", $success, time() + 2, "/");
    header("location: ../Franchisee");
} else {
    $error = "No se pudo agregar al usuario.";

    setcookie("error", $error, time() + 2, "/");
    header("location: ../Franchisee");
}

mysqli_close($conn);