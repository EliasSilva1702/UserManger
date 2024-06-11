<?php
include("connection.php");

if (isset($_POST['id_product'])) {

    $products = $conn->query("SELECT * from products where id='" . $_POST['id_product'] . "'");
    if ($products->num_rows > 0) {
        foreach ($products as $product) {

            ?>

            <form action="../includes/modifyProduct.php?id_product=<?php echo $product['id'] ?>" method="POST"
                class="modal-content needs-validation" enctype="multipart/form-data" novalidate>

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModifyProductModalLabel">Modificar producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <?php
                    $urls = $conn->query("SELECT * from products_url_photos where id_product='" . $product['id'] . "'");

                    if ($urls->num_rows > 0) {
                        ?>
                        <label>Imagenes</label>
                        <div class="d-flex overflow-x-auto gap-2 ">
                            <?php
                            foreach ($urls as $url) {
                                ?>
                                <div class="position-relative" id="ProductPhoto<?php echo $product['id'] . $url['id'] ?>">

                                    <img src="<?php echo $url['url'] ?>" class=" rounded border" alt="..." style="height: 10rem;">
                                    <img src="../img/trash-solid.svg" class="p-2 rounded position-absolute top-0 end-0" alt="..."
                                        style="width:2rem;background-color:white;"
                                        id="BtnProductPhoto<?php echo $product['id'] . $url['id'] ?>">

                                    <!-- <script src="../js/jquery-3.7.0.min.js"></script> -->

                                    <script>
                                        $(document).on('click', '#BtnProductPhoto<?php echo $product['id'] . $url['id'] ?>', function () {

                                            // La función confirm devuelve true si se hace clic en "Aceptar" y false si se hace clic en "Cancelar"
                                            var respuesta = confirm("¿Seguro que desea eliminar esta imagen?");

                                            // Verificar la respuesta
                                            if (respuesta) {
                                                DeleteProductPhoto('<?php echo $url['id'] ?>');
                                                // Obtener referencia al elemento que deseas eliminar
                                                var e = document.getElementById("ProductPhoto<?php echo $product['id'] . $url['id'] ?>");

                                                // Verificar si el elemento existe antes de intentar eliminarlo
                                                if (e) {
                                                    // Eliminar el elemento del DOM
                                                    e.remove();
                                                }
                                            }

                                        });

                                    </script>

                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="mb-3">
                        <label for="files" class="form-label">Agregar imagenes</label>
                        <input type="file" class="form-control" id="files" name="files[]" placeholder="imagenes" multiple>
                        <div class="valid-feedback">
                            ¡Perfecto!
                        </div>
                        <div class="invalid-feedback">
                            Agrege al menos una imagen.
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="nombre"  value="<?php echo $product['name'] ?>" required>
                            <label for="name">Nombre</label>
                            <div class="valid-feedback">
                                ¡Perfecto!
                            </div>
                            <div class="invalid-feedback">
                                Su producto necesita un nombre.
                            </div>
                        </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="description" name="description" placeholder="descripcion"
                            value="<?php echo $product['description'] ?>" required>
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
                                value="<?php echo $product['cost'] ?>" required>
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
                                $checked = "";

                                $products_categories = $conn->query("SELECT * from products_categories  
                                where id_product='" . $_POST['id_product'] . "' and id_category='" . $currentCategory['id'] . "'");
                                if ($products_categories->num_rows > 0) {
                                    $checked = "checked";
                                }
                                ?>
                                <div class="form-check ms-2">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="category<?php echo $currentCategory['id']; ?>" name="<?php echo $currentCategory['id']; ?>"
                                        <?php echo $checked; ?>>
                                    <label class="form-check-label" for="category<?php echo $currentCategory['id']; ?>">
                                        <?php echo $currentCategory['name'] ?>
                                    </label>
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
                    <button type="submit" class="btn btn-primary">Modificar producto</button>
                </div>
            </form>
            <script>
                
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()

            </script>
            <?php
        }
    }
}