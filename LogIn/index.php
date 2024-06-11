<!DOCTYPE html>
<html lang="en">
<?php


// titulo de la pestaña
$title = "Iniciar sesión";
include_once("../includes/head/head.php");


if ($isUser) {
    header("Location: ../MakeOrder");
}
?>

<body>


<!-- Background -->
<div 
class="absolute top-0 z-[-2] h-screen w-screen bg-white bg-[radial-gradient(ellipse_80%_80%_at_50%_-20%,rgba(120,119,198,0.3),rgba(255,255,255,0))]">
</div>


<main>
    <?php     // alerts
         include_once("../FrontEnd/alerts/alerts.php");
    ?>
    <h1 class="text-center text-black text-6xl mt-5 font-Onest font-semibold ">
    Gestor <span class="text-green-600 animate-pulse">Bassai</span>
    </h1>
 
   <?php

    // header
    // include_once("../FrontEnd/header/header.php");


    // formulario registrarse
    include_once("../FrontEnd/login/logInForm.php");


   

    // footer
    // include_once("../vistas/footer/footer.php");
    ?>

</main>

</body>

</html>