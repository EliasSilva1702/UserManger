<h3 class="p-4 fs-2 mx-4 mb-3 d-flex align-items-center justify-content-center">
    <?php echo $currentCategory['name'] ?>
</h3>

<!-- Cards -->
<div class="p-2
            container-fluid
            d-flex flex-wrap justify-content-center gap-3 rounded ">
    <?php

    //*muestra un grid con todos los productos disponibles
    
    $sql = "SELECT products.name,products.id,products.description,products.name,products.cost
            from products, products_categories
            where products.id = products_categories.id_product and products_categories.id_category='" . $currentCategory['id'] . "'
            ORDER BY `name` asc";

    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        foreach ($result as $product) {
            include("../vistas/products/productsCard.php");
        }
    } else {
        include("../vistas/products/noProducts.php");
    }
    ?>
</div>
<hr>