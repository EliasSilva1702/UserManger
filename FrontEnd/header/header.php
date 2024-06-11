<div class="min-h-full">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="/">
                            <img class="h-8 object-cover" src="../FrontEnd/header/LogoBassai.png"
                                alt="Logo de la empresa Bassai" style="filter: drop-shadow(1px 1px 0px white);">
                        </a>
                    </div>
                    <?php
                    if ($isUser) {
                        ?>
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="../MakeOrder"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Hacer
                                    pedidos</a>
                                <a href="../MyOrders"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Mis
                                    pedidos</a>
                                <?php

                                if (
                                    $User->GetPermission('can_see_orders')
                                ) {
                                    ?>
                                    <a href="../Orders"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Pedidos
                                        recibidos</a>
                                    <?php
                                }
                                ?>
                                <?php

                                if (
                                    $User->GetPermission('can_add_users')
                                    || $User->GetPermission('can_modify_users')
                                    || $User->GetPermission('can_delete_users')
                                ) {
                                    ?>

                                    <a href="../Franchisee"
                                        class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Franquiciados</a>
                                    <?php
                                }

                                ?>

                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
                <?php
                if ($isUser) {
                    ?>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <!--  <button type="button"
                                class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                            </button> -->

                            <!-- Profile dropdown -->
                            <div class="relative">
                                <div class="flex items-center gap-x-2 ml-3 flex-row-reverse"
                                    onclick="toggleDropdown('pfpMenu')">
                                    <button type="button"
                                        class="relative flex flex-row-reverse gap-x-2 max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-red focus:ring-offset-2 focus:ring-offset-gray-800"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">Open user menu</span>
                                        <?php

                                        $urls = $conn->query("SELECT * from users_profile_picture_urls where id_user='" . $User->GetId() . "'");
                                        if ($urls->num_rows > 0) {
                                            foreach ($urls as $key => $url) {
                                                ?>
                                                <img class="h-8 w-8 rounded-full" src="<?php echo $url['url'] ?>" alt="">
                                                <?php
                                            }
                                        }
                                        ?>
                                        <span class="text-white">Perfil</span>
                                    </button>
                                </div>

                                <div id="pfpMenu"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    <!-- Active: "bg-gray-100", Not Active: "" -->
                                    <a href="../MyProfile" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="user-menu-item-0">Tu perfil</a>
                                    <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                        id="user-menu-item-1">Settings</a> -->
                                    <a href="../includes/logout.php" class="block px-4 py-2 text-sm text-gray-700"
                                        role="menuitem" tabindex="-1" id="user-menu-item-2">Cerrar sesión</a>
                                </div>

                                <!-- 
                                <script>
                                    function toggleDropdown(dropdownID) {
                                        let dropdown = document.getElementById(dropdownID);
                                        dropdown.classList.toggle("hidden");
                                    }

                                </script> -->
                            </div>
                        </div>
                    </div>

                    <!-- boton responsive -->
                    <div class="-mr-2 flex md:hidden" onclick="toggleDropdown('mobile-menu')">
                        <!-- Mobile menu button -->
                        <button type="button"
                            class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            aria-controls="mobile-menu" aria-expanded="false">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Open main menu</span>
                            <!-- Menu open: "hidden", Menu closed: "block" -->
                            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                            <!-- Menu open: "block", Menu closed: "hidden" -->
                            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <?php
                }
                ?>



            </div>
        </div>
        <?php
        if ($isUser) {
            ?>
            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <a href="../MakeOrder"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"
                        aria-current="page">Hacer pedidos</a>
                    <a href="../MyOrders"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Mis
                        pedidos</a>
                    <?php

                    if (
                        $User->GetPermission('can_see_orders')
                    ) {
                        ?>
                        <a href="../Orders"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">
                            Pedidos recibidos
                        </a>
                        <?php
                    }

                    if (
                        $User->GetPermission('can_add_users')
                        || $User->GetPermission('can_modify_users')
                        || $User->GetPermission('can_delete_users')
                    ) {
                        ?>

                        <a href="../Franchisee"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">
                            Franquiciados
                        </a>

                        <?php
                    }
                    ?>
                </div>

                <div class="border-t border-gray-700 pb-3 pt-4">
                    <div class="flex items-center px-5">
                        <div class="flex-shrink-0">
                            <?php

                            $urls = $conn->query("SELECT * from users_profile_picture_urls where id_user='" . $User->GetId() . "'");
                            if ($urls->num_rows > 0) {
                                foreach ($urls as $key => $url) {
                                    ?>
                                    <img class="h-10 w-10 rounded-full" src="<?php echo $url['url'] ?>" alt="">
                                    <?php
                                }
                            }
                            ?>

                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium leading-none text-white mb-2">
                                <?php echo $User->GetName(); ?>
                            </div>
                            <div class="text-sm font-medium leading-none text-gray-400">
                                <?php echo $User->GetEmail(); ?>
                            </div>
                        </div>
                        <!--  <button type="button"
                            class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                        </button> -->
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <a href="../MyProfile"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Tu
                            perfil</a>
                        <!-- <a href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a> -->
                        <a href="../includes/logout.php"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Cerrar
                            sesión</a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </nav>

</div>