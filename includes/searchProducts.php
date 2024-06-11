<?php

include_once("manager.php");

if (isset($_POST['query']) && isset($_POST['max_products'])) {
    $q = $_POST['query'];

    $sql = "SELECT * from products 
    where (name like '%" . $q . "%' or description like '%" . $q . "%') 
    ORDER BY `name` asc";

    if ($q == "") {

        /*      $sql = "SELECT products.id,products.name,products.description,products_url_photos.url 
             from products, products_url_photos 
             where products.id=products_url_photos.id_product  
             ORDER BY `name` asc"; */

        $sql = "SELECT *
        from products
        ORDER BY `name` asc";

    }

    $products = $conn->query($sql);

    if ($products->num_rows > 0) { ?>

        <?php
        $products_showed = 0;
        $max_products_showed = $_POST['max_products'];

        foreach ($products as $key => $product) {

            if ($products_showed < $max_products_showed) {
                $products_showed++;
                include("../vistas/products/productsCard.php");
            }
        }

    } else {
        ?>
        <p class="text-center">Not found :(</p>
        <?php
    }
}