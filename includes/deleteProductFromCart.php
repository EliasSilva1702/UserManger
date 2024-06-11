<?php


include_once("manager.php");

$error = "";
// verifica que existan los datos necesarios
if (
    !isset($_POST["id_product"])
) {
    $error = "Faltan datos";
}


if ($error !== "") {
    setcookie("error", $error, time() + 5, "/");
    header("Location: ../MakeOrder");
    return;
}


$id_product = $_POST['id_product'];

//sql para eliminar las categorias
$sql = "SELECT shopping_carts.id FROM `shopping_carts_products`,shopping_carts
WHERE shopping_carts_products.id_product='$id_product' and shopping_carts_products.id_shopping_cart=shopping_carts.id and shopping_carts.id_user='" . $User->GetId() . "'
group by  shopping_carts.id";
$id_shopping_cart = "";

$carts = $conn->query($sql);

foreach ($carts as $key => $cart) {
    $sql = "DELETE from shopping_carts_products where id_product='" . $id_product . "' and id_shopping_cart='" . $cart['id'] . "'";
}


if (!mysqli_query($conn, $sql)) {

    $error = "Error al quitar producto.";

    setcookie("error", $error, time() + 5, "/");
    header("location: ../MakeOrder");
}

mysqli_close($conn);
?>