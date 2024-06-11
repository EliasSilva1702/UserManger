<?php
include("manager.php");
$res = $conn->query("SELECT * from products where id='" . $_POST['id_product'] . "'");
foreach ($res as $key => $product) {
    ?>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
        style="position:absolute;top:0;right:0;drop-shadow:10px 10px 0px black;"></button>

    <div class="row d-flex flex-wrap m-0 p-0 g-0" style="">

        <!-- img -->
        <div class="col d-flex align-items-center " style="min-width:300px">
            <?php
            $urls = $conn->query("SELECT * from products_url_photos where id_product='" . $product['id'] . "'");

            if ($urls->num_rows > 0) {
                foreach ($urls as $key => $url) {
                    ?>
                    <img src="<?php echo $url['url'] ?>" class="card-img-top object-fit-cover w-100" alt="..."
                        style="height:300px;">
                    <?php

                }
            }
            ?>
        </div>

        <!-- descripcion -->
        <div class="col p-2" style="min-width:300px">
            <h2 class="ms-2">
                <?php echo $product['name'] ?>
            </h2>
            <p class="ms-2">
                <?php echo $product['description'] ?>
            </p>

            <!-- Categorias -->
            <?php
            $res = $conn->query("SELECT * from products_categories, categories where id_product='" . $product['id'] . "' and products_categories.id_category=categories.id ");

            if ($res->num_rows > 0) {
                foreach ($res as $category) {
                    ?>
                    <input type="checkbox" class="btn-check" id="btncheck1<?php echo $product['id'] . $category['id'] ?>"
                        autocomplete="off">
                    <label class="btn btn-outline-secondary m-2 " for="btncheck1<?php echo $product['id'] . $category['id'] ?>">
                        <?php echo $category['name'] ?>
                    </label>
                    <?php
                }
            }
            ?>
            <div>
                <?php

                if ($User->GetPermission("can_modify_products")) {

                    ?>
                    <button class="btn btn-secondary w-100 my-2" data-bs-toggle="modal" data-bs-target="#ModifyProductModal"
                        id="ModifyProduct<?php echo $product['id']; ?>">Modificar</button>

                    <script>
                        $(document).on('click', '#ModifyProduct<?php echo $product['id']; ?>', function () {

                            SetModifyProductModal('<?php echo $product['id'] ?>');

                        });
                    </script>
                    <?php
                }

                if ($User->GetPermission("can_delete_products")) {

                    ?>
                    <button class="btn btn-secondary w-100" id="DeleteProduct<?php echo $product['id']; ?>">Delete</button>

                    <script>
                        $(document).on('click', '#DeleteProduct<?php echo $product['id']; ?>', function () {

                            // La función confirm devuelve true si se hace clic en "Aceptar" y false si se hace clic en "Cancelar"
                            var respuesta = confirm("¿Seguro que desea eliminar este producto?");

                            // Verificar la respuesta
                            if (respuesta) {
                                DeleteProduct('<?php echo $product['id'] ?>');

                                // Obtener referencia al elemento que deseas eliminar
                                var e = document.getElementById("ProductCard<?php echo $product['id'] ?>");

                                // Verificar si el elemento existe antes de intentar eliminarlo
                                if (e) {
                                    // Eliminar el elemento del DOM
                                    e.remove();
                                }
                            }

                        });

                    </script>

                    <?php
                }
                ?>
            </div>
        </div>

    </div>


    <!-- 

    <div class="modal-header">
        <h1 class="modal-title fs-5" id="productModalLabel">
            <?php echo $product['name'] ?>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div> -->
    <?php
}
?>