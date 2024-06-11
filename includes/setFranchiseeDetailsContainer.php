<?php

include("manager.php");

if (!isset($_POST['id_user'])) {
    return;
}

$id_user = $_POST['id_user'];

$sql = "SELECT * from users
where id='$id_user'";
$users = $conn->query($sql);

if (!$users->num_rows > 0) {
    ?>
    <p>No se encontró al usuario</p>
    <?php
    return;
}

foreach ($users as $key => $user) {
    $_user = new User();
    $_user->SetUser($user['f_num']);

    ?>

    <div class="px-2 sm:px-0 mt-12">
        <h3 class="text-xl font-semibold leading-7 text-gray-900">Detalles del usuario</h3>
        <span class="text-sm text-black opacity-80">(Puedes
            <span class="font-bold">editar</span>
            o solo ver la información)
        </span>
    </div>

    <form action="../includes/modifyFranchisee.php?id_user=<?php echo $id_user ?>" method="POST"
        enctype="multipart/form-data">

        <!-- container foto -->
        <div class="border-b border-gray-900/10 pb-10">

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900 ml-2">
                        Foto del franquiciado
                    </label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="flex items-center justify-center flex-col">
                            <?php

                            $urls = $conn->query("SELECT * from users_profile_picture_urls where id_user='" . $_user->GetId() . "'");
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


        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Nombre:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input type="text" name="firstname" id="firstname" autocomplete="given-name"
                            value="<?php echo $_user->GetName() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Apellido:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input type="text" name="lastname" id="lastname" autocomplete="given-name"
                            value="<?php echo $_user->GetLastName() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Posición:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <select id="position" name="position" autocomplete="position"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="<?php echo $_user->GetPosition() ?>">
                                <?php echo $_user->GetPosition() ?>
                            </option>
                            <option value="Minorista">Minorista</option>
                            <option value="Mayorista">Mayorista</option>
                            <option value="Empresario">Empresario</option>
                            <option value="Coordinador">Coordinador</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Lider de equipo">Lider de equipo</option>
                            <option value="Director regional">Director regional</option>
                        </select>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Correo:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input id="email" name="email" type="email" autocomplete="email"
                            value="<?php echo $_user->GetEmail() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Numero de teléfono:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input id="phone_number" name="phone_number" type="text" autocomplete="phone_number"
                            value="<?php echo $_user->GetPhoneNumber() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Numero de franquiciado:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $_user->GetF_num() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Región:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input type="text" name="region" id="region" autocomplete="region"
                            value="<?php echo $_user->GetRegion() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Departamento:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <select id="department" name="department" autocomplete="department-name"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="<?php echo $_user->GetDepartment() ?>">
                                <?php echo $_user->GetDepartment() ?>
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
                    <label for="franchised" class="block text-sm font-medium leading-6 text-gray-900">Franquiciado
                        de:</label>
                    <div class="mt-1">
                        <select id="franchised" name="franchised" autocomplete="franchised"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="none">Nadie</option>

                            <?php
                            $id_franchised = "";
                            $users = $conn->query("SELECT * FROM users_franchised, users where id_franchised='" . $_user->GetId() . "' and users.id=users_franchised.id_user;");
                            if ($users->num_rows > 0) {
                                foreach ($users as $key => $user) {
                                    $id_franchised = $user['id'];
                                    ?>
                                    <option value="<?php echo $user['id'] ?>" selected>
                                        <?php echo $user['name'] . " " . $user['lastname'] ?>
                                    </option>
                                    <?php
                                }
                            }

                            $users = $conn->query("SELECT * from users order by name asc");
                            foreach ($users as $key => $user) {

                                if ($_user->GetId() != $user['id'] && $id_franchised != $user['id']) {
                                    ?>
                                    <option value="<?php echo $user['id'] ?>">
                                        <?php echo $user['name'] . " " . $user['lastname'] ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Dirección:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <input type="text" name="address" id="address" autocomplete="address"
                            value="<?php echo $_user->GetAddress() ?>"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </dd>
                </div>
            </dl>

            <div class="mt-4 flex w-100 items-center gap-x-2 sm:gap-x-0 justify-between">

                <button type="submit"
                    class=" rounded-md bg-indigo-600 px-3 py-2 mt-4 mb-4 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 ">
                    Guardar cambios
                </button>

                <a href="../includes/deleteUser.php?id_user=<?php echo $id_user ?>"
                    class=" rounded-md items-center text-sm bg-red-50 px-3 py-2 font-semibold text-red-700 ring-1 ring-inset ring-red-600/10">
                    Eliminar franquiciado
                </a>

            </div>

        </div>
    </form>
    <?php
}