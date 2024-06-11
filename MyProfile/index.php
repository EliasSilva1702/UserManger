<!DOCTYPE html>
<html lang="en">

<?php
// titulo de la pestaña
$title = "Bassai - Mi perfil";

include("../includes/head/head.php");


if (!$isUser) {
    header("Location: ../LogIn");
}
?>

<body>

    <?php
    // alerts
    include_once("../FrontEnd/alerts/alerts.php");

    //    echo date("d-m-Y");
    // header
    include_once("../FrontEnd/header/header.php");
    ?>
    <form action="../includes/modifyMyInfo.php" method="POST" enctype="multipart/form-data"
        class="p-2 max-w-5xl mx-auto">

        <!-- container foto -->
        <div class=" border-gray-900/10 pb-10">

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="col-span-full">
                    <label for="cover-photo"
                        class="block text-sm font-medium leading-6 text-gray-900 ml-2 object-cover">
                        Foto del franquiciado
                    </label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="flex items-center justify-center flex-col">
                            <?php

                            $urls = $conn->query("SELECT * from users_profile_picture_urls where id_User='" . $User->GetId() . "'");
                            if ($urls->num_rows > 0) {
                                foreach ($urls as $key => $url) {
                                    ?>
                                    <img class="size-32 flex-none rounded-full bg-gray-50 object-cover"
                                        src="<?php echo $url['url'] ?>" alt="">
                                    <?php
                                }
                            }
                            ?>
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="file"
                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>
                                        <input id="file" name="file" type="file"
                                            class="file:bg-transparent file:border-none text-sm">
                                    </span>
                                </label>
                            </div>
                            <p class="text-xs leading-5 text-gray-600 pl-1">Arrastra y Suelta</p>
                            <p class="text-xs leading-5 text-gray-600">PNG, JPG, JPEG peso máximo de archivo 2MB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin container foto -->

        <div class="px-4 sm:px-0">
            <h3 class="text-3xl text-center font-semibold leading-7 text-gray-900 mt-7">Información del franquiciado
            </h3>
            <p class="mt-1 text-center text-sm leading-6 text-gray-500">(Información personal y detalles.)</p>
        </div>

        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Nombre:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input type="text" name="firstname" id="firstname" autocomplete="given-name"
                            value="<?php echo $User->GetName() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Apellido:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input type="text" name="lastname" id="lastname" autocomplete="given-name"
                            value="<?php echo $User->GetLastName() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Posición:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $User->GetPosition() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Correo:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input id="email" name="email" type="email" autocomplete="email"
                            value="<?php echo $User->GetEmail() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Número de telefono:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input id="phone_number" name="phone_number" type="text" autocomplete="phone_number"
                            value="<?php echo $User->GetPhoneNumber() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Número de franquiciado:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $User->GetF_num() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Región:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $User->GetRegion() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Departamento:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <select id="department" name="department" autocomplete="department-name"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="<?php echo $User->GetDepartment() ?>">
                                <?php echo $User->GetDepartment() ?>
                            </option>
                            <option value="Artigas">Artigas</option>
                            <option value="Canelones">Canelones</option>
                            <option value="Cerro Largo">Cerro Largo</option>
                            <option value="Colonia">Colonia</option>
                            <option value="Durazno">Durazno</option>
                            <option value="Flores">Flores</option>
                            <option value="Florida">Florida</option>
                            <option value="Lavalleja">Lavalleja</option>
                            <option value="Maldonado">Maldonado</option>
                            <option value="Montevideo">Montevideo</option>
                            <option value="Paysandú">Paysandú</option>
                            <option value="Río Negro">Río Negro</option>
                            <option value="Rivera">Rivera</option>
                            <option value="Rocha">Rocha</option>
                            <option value="Salto">Salto</option>
                            <option value="San José">San José</option>
                            <option value="Soriano">Soriano</option>
                            <option value="Tacuarembo">Tacuarembo</option>
                            <option value="Treinta y Tres">Treinta y Tres</option>
                        </select>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Dirección:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input type="text" name="address" id="address" autocomplete="address"
                            value="<?php echo $User->GetAddress() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
            </dl>

            <div class="mb-1 flex w-100 items-center gap-x-2 sm:gap-x-0 justify-end">

                <button type="submit"
                    class=" rounded-md bg-indigo-600 px-3 py-2 mt-4 mb-4 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 ">
                    Guardar cambios
                </button>

            </div>

        </div>
    </form>

    <form action="../includes/modifyPassword.php" method="POST" class="p-2 max-w-5xl mx-auto">


        <div class="px-4 sm:px-0">
            <h3 class="text-3xl text-center font-semibold leading-7 text-gray-900 mt-7">Cambiar contraseña</h3>
            <p class="mt-1 text-center text-sm leading-6 text-gray-500">(Aquí puede modificar tu contraseña.)</p>
        </div>

        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Contraseña actual:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input type="password" name="current-password" id="current-password"  value=""
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Nueva contraseña:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input type="password" name="new-password" id="new-password" value=""
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Confirmar contraseña:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input type="password" name="confirm-password" id="confirm-password"  value=""
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
            </dl>

            <div class="mb-1 flex w-100 items-center gap-x-2 sm:gap-x-0 justify-end">

                <button type="submit"
                    class=" rounded-md bg-indigo-600 px-3 py-2 mt-4 mb-4 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 ">
                    Guardar cambios
                </button>

            </div>

        </div>
    </form>

    <?php

    // footer
    // include_once("../vistas/footer/footer.php");
    
    // include("../vistas/products/modifyProductModal.php");
    // include("../vistas/products/productModal.php");
    
    ?>

    <script src="../js/main.js"></script>



</body>

</html>