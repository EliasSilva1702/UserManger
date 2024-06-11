<h2 class="m-4">Administrar productos</h2>

<section class="container-sm border
                px-3">

    <div class="m-2 d-flex justify-content-between align-items-center ">


        <div class="form-floating m-2">
            <input type="text" class="form-control " id="search" placeholder="Buscar">
            <label for="search">Buscar</label>
        </div>

        <button type="button" class="btn button" data-bs-toggle="modal" data-bs-target="#AddProductModal">Agregar
            producto</button>

        <!-- Modal agregar producto-->
        <div class="modal fade" id="AddProductModal" tabindex="-1" aria-labelledby="AddProductModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">

                <form action="../includes/addProduct.php" method="POST" class="modal-content needs-validation"
                    enctype="multipart/form-data" novalidate>

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="AddProductModalLabel">Agregar producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="files" class="form-label">Imagenes</label>
                            <input type="file" class="form-control" id="files" name="files[]" placeholder="imagenes"
                                multiple required>
                            <div class="valid-feedback">
                                ¡Perfecto!
                            </div>
                            <div class="invalid-feedback">
                                Agrege al menos una imagen.
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="nombre" required>
                            <label for="name">Nombre</label>
                            <div class="valid-feedback">
                                ¡Perfecto!
                            </div>
                            <div class="invalid-feedback">
                                Su producto necesita un nombre.
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="descripcion" required>
                            <label for="description">Descripcion</label>
                            <div class="valid-feedback">
                                ¡Perfecto!
                            </div>
                            <div class="invalid-feedback">
                                Su producto necesita una descripcion.
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">$U</span>
                            <div class="form-floating">
                                <input type="number" class="form-control" id="cost" name="cost" placeholder="costo"
                                    required>
                                <label for="cost">Costo</label>
                                <div class="valid-feedback">
                                    ¡Perfecto!
                                </div>
                                <div class="invalid-feedback">
                                    Ingrese un precio rasonable.
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <?php
                            $categories = $conn->query("SELECT * from categories");
                            if ($categories->num_rows > 0) {

                                foreach ($categories as $currentCategory) {
                                    ?>
                                    <div class="form-check ms-2">
                                        <label class="form-check-label" for="category<?php echo $currentCategory['id'] ?>">
                                            <?php echo $currentCategory['name'] ?>
                                        </label>
                                        <input class="form-check-input" type="checkbox" value=""
                                            id="category<?php echo $currentCategory['id'] ?>"
                                            name="<?php echo $currentCategory['id'] ?>">

                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <p>No hay categorias disponibles</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="p-2
            container-fluid
            d-flex flex-wrap justify-content-center gap-3 rounded " id="products-container">
        <?php
        $sql = "SELECT * 
        from products
        ORDER BY `name` DESC";

        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {

            foreach ($result as $product) {
                include("../vistas/products/productsCard.php");
            }
        } else {
            ?>
            <p>Aun no hay productos disponibles</p>
            <?php
        }
        ?>
    </div>
</section>

<script>
    let max_products = 10;
    function search(query, max_products) {
        $.ajax({
            url: '../includes/searchProducts.php',
            type: 'POST',
            dataType: 'html',
            data: {
                query: query,
                max_products: max_products
            },
        })
            .done(function (answer) {
                $("#products-container").html(answer);
                console.log("funciona busqueda");
            })
            .fail(function () {
                console.log("error");
            })
    };

    $(document).on('keyup', '#search', function () {
        var query = $(this).val();

        search(query, max_products);
        // console.log(query, max_products);

    });
</script>