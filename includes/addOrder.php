<?php

include_once("manager.php");

$error = "";

// verifica que existan los datos necesarios
$sql = "SELECT * from shopping_carts, shopping_carts_products
where shopping_carts.id_user='" . $User->GetId() . "' and  shopping_carts.id= shopping_carts_products.id_shopping_cart";

$cart_products = $conn->query($sql);

if (!$cart_products->num_rows > 0) {
    $error = "Debe seleccionar al menos un producto";
}

// verifica que existan los datos necesarios
if (
    !isset($_POST["ship_to"])
    || !isset($_FILES['receipt'])
) {
    $error = "Faltan datos";
} else {

    // verifica que los archivos estan subidos correctamente
    if ($_FILES['receipt']['name'] !== "") {

        //chequea las extensiones
        $fileExt = strtolower(pathinfo($_FILES['receipt']['name'], PATHINFO_EXTENSION));

        // Extensiones de archivo permitidas
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        // Verificar si la extensión del archivo es válida
        if (in_array($fileExt, $allowedExtensions)) {

            // Verificar si no hay errores en la subida del archivo
            if ($_FILES['receipt']['error'] > 0) {
                $error = "Error en la subida del comprobante.";
            }
        } else {
            $error = 'El formato del archivo "' . $_FILES['receipt']['name'] . '" (' . $fileExt . ") es invalido";
        }
    }
}


if ($error !== "") {
    setcookie("error", $error, time() + 2, "/");
    header("location: ../MakeOrder");
    return;
}

$ship_to = $_POST['ship_to'];
$d_creation = date("Y-m-d");
$t_creation = date("H:i:s");

//sql para insertar la publicacion
$sql = "INSERT INTO `orders`(`ship_to`, `id_user`, `d_creation`, `t_creation`) VALUES ('$ship_to','" . $User->GetId() . "','$d_creation','$t_creation')";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {

    $products = $conn->query("SELECT shopping_carts_products.id_product,shopping_carts_products.quantity from shopping_carts, shopping_carts_products
    where shopping_carts.id_user='" . $User->GetId() . "' and  shopping_carts.id= shopping_carts_products.id_shopping_cart");

    $id_order = "";

    $orders = $conn->query("SELECT * from orders where id_user='" . $User->GetId() . "' order by id asc");
    foreach ($orders as $key => $value) {
        $id_order = $value['id'];
    }

    foreach ($products as $key => $product) {

        $sql = "INSERT INTO `orders_products`(`id_order`, `id_product`, `quantity`) VALUES ('$id_order','" . $product['id_product'] . "','" . $product['quantity'] . "')";

        if (!mysqli_query($conn, $sql)) {
            $error = "No se pudo agregar uno de los productos a su pedido.";
            setcookie("error", $error, time() + 2, "/");
            header("location: ../MakeOrder");
            return;
        }
    }
    $shopping_carts = $conn->query("SELECT * from shopping_carts where id_user='" . $User->GetId() . "'");
    foreach ($shopping_carts as $key => $shopping_cart) {

        $conn->query("DELETE from shopping_carts_products where id_shopping_cart='" . $shopping_cart['id'] . "' ");
    }
    // Verificar si se ha seleccionado un archivo
    if ($_FILES['receipt']['name'] !== "") {

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
        move_uploaded_file($_FILES['receipt']['tmp_name'], $uploadPath . $newFileName);

        // Guardar la ruta de la filesn en la base de datos
        $filesPath = $uploadPath . $newFileName;


        $sql = "INSERT INTO `orders_receipt`(`id_order`, `url`)VALUES ('" . $id_order . "','" . $filesPath . "')";

        if (!mysqli_query($conn, $sql)) {
            $error = "No se pudo subir el comprobante";

            setcookie("error", $error, time() + 2, "/");
            header("location: ../MakeOrder");
            return;
        }

    }


    $success = "Pedido enviado exitosamente.";

    setcookie("success", $success, time() + 2, "/");
    header("location: ../MyOrders");
} else {
    $error = "No se pudo enviar el pedido.";

    setcookie("error", $error, time() + 2, "/");
    header("location: ../MakeOrder");
}

mysqli_close($conn);