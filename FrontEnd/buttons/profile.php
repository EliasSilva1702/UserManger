<div class="dropdown dropdown-toggle 
            pe-auto 
            p-1
            d-flex gap-2 align-items-center justify-content-center" data-bs-toggle="dropdown" aria-expanded="false">

    <h3 class="m-0">Perfil</h3>

    <img src="../img/user-solid.svg" class="color" alt="error-image" style="width:2rem">
</div>

<ul class="dropdown-menu">
    <li>
        <?php

        if ($User->GetPermission("can_add_categories") == true) {
            ?>
            <a class="dropdown-item " href="../AdminCategories">Administrar categorias</a>
            <?php
        }
        if ($User->GetPermission("can_add_products") == true) {
            ?>
            <a class="dropdown-item " href="../AdminProducts">Administrar productos</a>
            <?php
        }

        ?>
        <a class="dropdown-item " href="#">Mi perfil</a>
    </li>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li><a class="dropdown-item" href="../includes/logout.php">Cerrar sesión</a></li>
</ul>
