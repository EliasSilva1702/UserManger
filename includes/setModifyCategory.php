<?php
include("connection.php");

if (isset($_POST['id_category'])) {

    $categories = $conn->query("SELECT * from categories where id='" . $_POST['id_category'] . "'");
    if ($categories->num_rows > 0) {
        foreach ($categories as $category) {

            ?>

            <form action="../includes/modifyCategory.php?id_category=<?php echo $category['id'] ?>" method="POST"
                class="modal-content needs-validation" enctype="multipart/form-data" novalidate>

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModifyCategoryModalLabel">Modificar categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="nombre"
                            value="<?php echo $category['name'] ?>" required>
                        <label for="name">Nombre</label>
                        <div class="valid-feedback">
                            ¡Perfecto!
                        </div>
                        <div class="invalid-feedback">
                            Su catregoria necesita un nombre.
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Modificar categoria</button>
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