<!DOCTYPE html>
<html lang="en">

<?php
// titulo de la pestaña
$title = "Bassai - Pedidos";

include("../includes/head/head.php");


if (!$isUser) {
    header("Location: ../LogIn");
}
?>

<body>

    <?php
    // alerts
    include_once("../FrontEnd/alerts/alerts.php");

//    echo date("d-m-Y");
    // header
    include_once("../FrontEnd/header/header.php");

    include_once("../FrontEnd/orders/ordersList.php");

    // include("../vistas/toasts/toasts.php");
    
    // footer
    // include_once("../vistas/footer/footer.php");
    
    // include("../vistas/products/modifyProductModal.php");
    // include("../vistas/products/productModal.php");
    
    ?>

    <script src="../js/main.js"></script>



</body>

</html>