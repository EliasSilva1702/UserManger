<!DOCTYPE html>
<html lang="en">

<?php
// titulo de la pestaña
$title = "Bassai";

include("../includes/head/head.php");


if (!$isUser) {
    header("Location: ../LogIn");
}
?>

<body>

    <?php
    // alerts
    include_once("../FrontEnd/alerts/alerts.php");

    // header
    include_once("../FrontEnd/header/header.php");

    include_once("../FrontEnd/orders/makeOrderForm.php");

    // include("../vistas/toasts/toasts.php");
    
    // footer
    // include_once("../vistas/footer/footer.php");
    
    // include("../vistas/products/modifyProductModal.php");
    // include("../vistas/products/productModal.php");
    
    ?>

    <script src="../js/main.js"></script>


</body>

</html>