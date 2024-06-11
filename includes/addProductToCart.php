<?php


include_once("manager.php");


$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_POST["id_product"])
    || !isset($_POST["quantity"])
) {
    $error = "Faltan datos";
} else {

    //verifica que la cantidad sea mayor a 0
    if (!$_POST["quantity"] > 0) {
        $error = "Necesita agregar una cantidad superior a 0";
    }

    $sql = "SELECT * from shopping_carts,shopping_carts_products
    where shopping_carts.id_user='" . $User->GetId() . "' and shopping_carts.id=shopping_carts_products.id_shopping_cart and shopping_carts_products.id_product='" . $_POST['id_product'] . "'";
    $products = $conn->query($sql);
    if ($products->num_rows != 0) {
        $error="El producto ya fue agregado";
    }
}
// verifica que sea usuario
if (!$isUser) {
    $error = "Usted no cuenta con los permisos necesarios.";
}

if ($error !== "") {
    setcookie("error", $error, time() + 5, "/");
    header("location: ../MakeOrder");
    return;
}

$id_product = $_POST['id_product'];
$quantity = $_POST['quantity'];
$id_shopping_cart = "";

// obtiene el carrito del usuario
$sql = "SELECT * from shopping_carts where id_user='" . $User->GetId() . "'";
$carts = $conn->query($sql);

foreach ($carts as $key => $cart) {
    $id_shopping_cart = $cart['id'];
}



//sql para insertar producto al carrio
$sql = "INSERT INTO `shopping_carts_products`(`id_shopping_cart`, `id_product`, `quantity`) VALUES ('$id_shopping_cart','$id_product','$quantity')";

//chequea si el sql y la conexion a la base de datos funciona
if (mysqli_query($conn, $sql)) {


    $success = "Producto agregado exitosamente.";

    setcookie("success", $success, time() + 5, "/");
    header("location: ../MakeOrder");
} else {
    $error = "No se pudo agregar el producto.";

    setcookie("error", $error, time() + 5, "/");
    header("location: ../MakeOrder");
}

mysqli_close($conn);