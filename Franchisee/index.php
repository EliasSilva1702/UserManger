<!DOCTYPE html>
<html lang="en">

<?php
// titulo de la pestaña
$title = "Bassai";

include("../includes/head/head.php");


if (!$isUser) {
    header("Location: ../LogIn");
}
if (
    !$User->GetPermission('can_add_users')
    || !$User->GetPermission('can_modify_users')
    || !$User->GetPermission('can_delete_users')
) {

    header("Location: ../MakeOrder");
}
?>

<body>

    <?php
    // alerts
    include_once("../FrontEnd/alerts/alerts.php");

    // header
    include_once("../FrontEnd/header/header.php");


    include("../FrontEnd/franchisee/addFranchiseeForm.php");
    include("../FrontEnd/franchisee/franchiseeListContainer.php");

    // footer
    // include_once("../vistas/footer/footer.php");
    
    // include("../vistas/products/modifyProductModal.php");
    // include("../vistas/products/productModal.php");
    
    ?>

    <script src="../js/main.js"></script>



</body>

</html>