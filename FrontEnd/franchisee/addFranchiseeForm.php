<h1 class="text-center mt-12 text-4xl sm:text-5xl font-mono font-semibold ">Añadir franquiciado</h1>
<form action="../includes/addFranchisee.php" method="POST" class="max-w-5xl mx-auto mt-8 p-4"
    enctype="multipart/form-data">
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-10">

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900 ml-2">
                        Foto del franquiciado
                    </label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <?php include("../FrontEnd/Icons/File.php") ?>
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                <label for="file"
                                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                    <span>
                                        <input id="file" name="file" type="file"
                                            class="file:bg-transparent file:border-none" required>
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

        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="font-semibold text-xl leading-7 text-gray-900">Información personal</h2>
            <!-- <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p> -->

            <div class="mt-10 flex flex-col justify-start w-full items-center gap-x-6 gap-y-8 ">
                <div class="sm:col-span-3 w-full">
                    <label for="firstname" class="block text-sm font-medium leading-6 text-gray-900">Nombre/s:</label>
                    <div class="mt-1">
                        <input type="text" name="firstname" id="firstname" autocomplete="given-name"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>

                <div class="sm:col-span-3 w-full">
                    <label for="lastname" class="block text-sm font-medium leading-6 text-gray-900">Apellido/s:</label>
                    <div class="mt-2">
                        <input type="text" name="lastname" id="lastname" autocomplete="family-name"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>
                <div class="sm:col-span-3 w-full">
                    <label for="f_num" class="block text-sm font-medium leading-6 text-gray-900">Número de
                        franquiciado:</label>
                    <div class="mt-2">
                        <input type="text" name="f_num" id="f_num" autocomplete="f_num"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>
                <div class="sm:col-span-3 w-full">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Contraseña:</label>
                    <div class="mt-2">
                        <input type="text" name="password" id="password" autocomplete="password"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                            required>
                        <span class="text-sm text-black opacity-80 mb-2 text-pretty">(El franquiciado tiene la libertad
                            de modificar su contraseña según su preferencia)</span>
                    </div>
                </div>

                <div class=" sm:col-span-full w-full">
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Correo
                        electrónico:</label>
                    <div class="mt-1 ">
                        <input id="email" name="email" type="email" autocomplete="email"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>
                <div class=" sm:col-span-full w-full">
                    <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">Número de teléfono:</label>
                    <div class="mt-1 ">
                        <input id="phone_number" name="phone_number" type="text" autocomplete="phone_number"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>

                <div class="col-span-2 w-full">
                    <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Dirección:</label>
                    <div class="mt-1 ">
                        <input type="text" name="address" id="address" autocomplete="address"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>

                <div class="sm:col-span-2 w-full">
                    <label for="department"
                        class="block text-sm font-medium leading-6  text-gray-900">Departamento:</label>
                    <div class="mt-2">
                        <select id="department" name="department" autocomplete="department-name"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  sm:max-w-xs sm:text-sm sm:leading-6">
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
                    </div>
                </div>

                <div class="col-span-2 w-full">
                    <label for="region" class="block text-sm font-medium leading-6 text-gray-900">Región:</label>
                    <div class="mt-1">
                        <input type="text" name="region" id="region" autocomplete="region"
                            class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400  sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>

                <!-- div -->
                <div class="flex items-center justify-between w-full gap-x-2 sm:gap-x-1">
                    <div class="col-sapn-2 w-full">
                        <label for="position"
                            class="block text-sm font-medium leading-6 text-gray-900">Posición:</label>
                        <div class="mt-1">
                            <select id="position" name="position" autocomplete="position"
                                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="Minorista">Minorista</option>
                                <option value="Mayorista">Mayorista</option>
                                <option value="Empresario">Empresario</option>
                                <option value="Coordinador">Coordinador</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Lider de equipo">Lider de equipo</option>
                                <option value="Director regional">Director regional</option>
                            </select>
                        </div>
                    </div>
                    <div class="sm:col-span-2 w-full">
                        <label for="franchised" class="block text-sm font-medium leading-6 text-gray-900">Franquiciado
                            de:</label>
                        <div class="mt-1">
                            <select id="franchised" name="franchised" autocomplete="franchised"
                                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="none">Nadie</option>
                                <?php
                                $users = $conn->query("SELECT * from users order by name asc");
                                foreach ($users as $key => $user) {
                                    ?>
                                    <option value="<?php echo $user['id'] ?>">
                                        <?php echo $user['name'] . " " . $user['lastname'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 flex flex-col items-center justify-center gap-x-6">

            <button type="submit"
                class="w-full rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 ">Añadir
                franquiciado</button>
        </div>
    </div>
</form>