<style>

</style>

<div class="container-sm p-3 mt-5 mb-5">


    <form action="../includes/signIn.php" method="POST" class="row g-3 p-3 needs-validation" novalidate>
        <!-- nombre -->
        <div class="col-md-6">
            <label for="name" class="form-label fs-5 mx-2">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="" placeholder="Nombre" required>
            <!--    <div class="valid-feedback">
                ¡Perfecto!
            </div>-->
            <div class="invalid-feedback">
                Ingrese su nombre.
            </div> 
            <div class="" id="name-feedback">

            </div>

            <script>
                let nameFeedBack = document.getElementById('name-feedback')
                $(document).on('keyup', '#name', function () {

                    var name = $(this).val();
                    if (!CheckOnCharacters("abcdefghijklmnñopqrstuvwxyz", name)) {

                        nameFeedBack.classList.remove("valid-feedback");
                        nameFeedBack.classList.add("invalid-feedback");
                        nameFeedBack.style.display = "flex";
                        nameFeedBack.textContent = "Ingrese un nombre valido";
                        return;
                    }
                    if ($(this).val() == "") {

                        nameFeedBack.classList.remove("valid-feedback");
                        nameFeedBack.classList.add("invalid-feedback");
                        nameFeedBack.style.display = "flex";
                        nameFeedBack.textContent = "Ingrese un nombre ";
                        return;
                    }

                    nameFeedBack.classList.add("valid-feedback");
                    nameFeedBack.classList.remove("invalid-feedback");
                    nameFeedBack.textContent = "Perfecto";

                });
            </script>
        </div>
        <!-- // nombre -->
        <!-- apellido -->
        <div class="col-md-6">
            <label for="lastname" class="form-label fs-5 mx-2">Apellido</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="" placeholder="Apellido"
                required>
            <div class="valid-feedback">
                ¡Perfecto!
            </div>
            <div class="invalid-feedback">
                Ingrese su apellido.
            </div>
        </div>
        <!-- // apellido -->
        <!-- email -->
        <div class="col-md-12">
            <label for="email" class="form-label fs-5 mx-2">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="inputGroupPrepend"
                placeholder="email@ejemplo.com" required>
            <div class="valid-feedback">
                ¡Perfecto!
            </div>
            <div class="invalid-feedback">
                Ingrese un email.
            </div>
        </div>
        <!-- email -->
        <!-- contraseña -->
        <div class="col-md-12">
            <label for="password" class="form-label fs-5 mx-2">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password"
                aria-describedby="inputGroupPrepend" placeholder="......." required>
            <div class="valid-feedback">
                ¡Perfecto!
            </div>
            <div class="invalid-feedback">
                Ingrese una contraseña.
            </div>
        </div>
        <!-- contraseña -->

        <div class="col-12 d-flex gap-4">
            <button class="btn button" type="submit">Registrarse</button>
            <a href="../LogIn/" class="btn button" type="submit">Ya soy usuario</a>
        </div>
    </form>


</div>

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