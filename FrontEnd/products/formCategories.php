
<h3 class="m-4">Administrar Categorias</h3>

<section class="container-sm border">

    <div class="m-2 d-flex justify-content-between align-items-center ">

        <div class="form-floating m-2 ">
            <input type="text" class="form-control" id="search" placeholder="Buscar...">
            <label for="search">Buscar</label>
        </div>

        <button type="button" class="btn button " data-bs-toggle="modal" data-bs-target="#AddCategoryModal">Agregar
            Categoria</button>

        <!-- Modal -->
        <div class="modal fade" id="AddCategoryModal" tabindex="-1" aria-labelledby="AddCategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">

                <form action="../includes/addCategory.php" method="POST" class="modal-content needs-validation"
                    enctype="multipart/form-data" novalidate>

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="AddCategoryModalLabel">Agregar categoria</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">


                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" id="name" placeholder="nombre">
                            <label for="name">Nombre</label>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Agregar categoria</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div>
        <?php
        $sql = "SELECT * from categories";

        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {

            foreach ($result as $row) {
                ?>
                <div class="row  border-top">
                    <p class="col-6 m-0 h-100">
                        <?php echo $row['name'] ?>
                    </p>
                    <?php
                    if ($User->GetPermission("can_modify_categories")) {

                        ?>
                        <button class="btn btn-secondary col" id="ModifiCategory<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#ModifyCategoryModal">Modificar</button>
                        <script>
                            $(document).on('click', '#ModifiCategory<?php echo $row['id']; ?>', function () {

                                SetModifyCategoryModal('<?php echo $row['id'] ?>');

                            });
                        </script>
                        <?php
                    }
                    ?>
                    <a href="../includes/deleteCategory.php?id=<?php echo $row['id'] ?>"
                        class="btn btn-secondary col">Eliminar</a>
                </div>

                <?php
            }
        } else {
            ?>
            <p>Aun no hay categorias disponibles</p>
            <?php
        }
        ?>
    </div>
</section>