<?php

include("manager.php");
if (!isset($_POST['id_order'])) {
    return;
}

$id_order = $_POST['id_order'];

$sql = "SELECT orders.ship_to,orders.d_creation,orders.t_creation,users.f_num as 'f_num' 
from orders,users
where orders.id='$id_order' and users.id=orders.id_user";
$orders = $conn->query($sql);

if (!$orders->num_rows > 0) {
    ?>
    <p>No se encontró el pedido</p>
    <?php
    return;
}

foreach ($orders as $key => $order) {
    $order_user = new User();
    $order_user->SetUser($order['f_num']);
    // echo $id_order;
    ?>
    <!-- DETALLES DEL PEDIDO -->
    <div class="mt-16 p-2">
        <div class="px-4 sm:px-0">
            <h3 class="text-xl sm:text-3xl font-semibold leading-7 text-gray-900">Detalles del pedido</h3>
            <!-- <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and application.</p> -->
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Nombre completo:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $order_user->GetName() . " " . $order_user->GetLastName() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Posición:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $order_user->GetPosition() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Correo electrónico:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $order_user->GetEmail() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Número de franquiciado:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $order_user->GetF_num() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Región:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $order_user->GetRegion() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Departamento:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $order_user->GetDepartment() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Dirección de franquiciado:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $order_user->GetAddress() ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Dirección de destino:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $order['ship_to'] ?>
                    </dd>
                </div>
                <div class="px-4 py-6 flex flex-col items-center ">
                    <dt class="text-ms font-medium leading-6 text-gray-900">Productos pedidos:</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        <div class="mt-6 
                                    grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 
                                    gap-x-6 gap-y-10  xl:gap-x-8">

                            <?php
                            $sql = "SELECT products.name,products.id,orders_products.quantity from products, orders, orders_products
                    where orders.id='$id_order' and orders_products.id_order=orders.id and orders_products.id_product=products.id";
                            $products = $conn->query($sql);

                            foreach ($products as $key => $product) {
                                ?>
                                <!-- Card de los productos en DETALLES DEL PEDIDO -->
                                <div id="ProductCard<?php echo $product['id'] ?>" class="group relative">

                                    <div
                                        class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none lg:h-80">
                                        <?php

                                        $urls = $conn->query("SELECT * from products_url_photos where id_product='" . $product['id'] . "'");

                                        if ($urls->num_rows > 0) {
                                            foreach ($urls as $key => $url) {
                                                if ($key === 0) {
                                                    ?>
                                                    <img src="<?php echo $url['url'] ?>" alt=""
                                                        class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>

                                    </div>

                                    <div class="mt-4 flex justify-between">
                                        <h3 class="text-sm text-gray-700">
                                            <?php echo $product['name'] ?>
                                        </h3>
                                        <p class="text-sm font-medium text-gray-900">
                                            <?php echo $product['quantity'] ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- FIN DE LAS CARDS -->
                                <?php
                            }
                            ?>
                        </div>
                    </dd>
                </div>

                <!-- comprobante de pago -->
                <div class="col-span-full sm:mb-7 ">
                    <label for="receipt" class="text-lg font-medium leading-6 text-blue-900 flex gap-x-1 ml-2 mt-14 mb-5">Comprobante de pago
                        <?php include_once("../FrontEnd/Icons/Ticket.php"); ?>
                    </label>
                    <!-- <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"> -->

                    <!-- Copia -->

                    <div class="mt-2 rounded-lg border border-dashed border-gray-900/25 px-6 py-10 
                                 items-center">
                        <div class="flex items-center justify-center flex-col">
                            <?php

                            $urls = $conn->query("SELECT * from orders_receipt where id_order='" . $id_order . "'");
                            
                            // comprueba si hay comprobante
                            if ($urls->num_rows > 0) {
                                foreach ($urls as $key => $url) {
                                    ?>
                                    <img class=" flex items-center justify-center mx-auto size-80 sm:mx-4 bg-gray-50 object-cover" src="<?php echo $url['url'] ?>"
                                        alt="">
                                    <?php
                                }
                            } else {

                                include("../FrontEnd/Icons/File.php");
                                ?>
                            <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">No hay comprobante</span>
                                <?php
                            }

                            // comprueba si el usuario es dueño del pedido
                            if ($order['f_num'] == $User->GetF_num()) {

                                ?>
    <form class="flex flex-col items-center justify-center" 
        action="../includes/addReceipt.php?id_order=<?php echo $id_order ?>" method="POST" enctype="multipart/form-data">
         <div class="mt-4 flex text-sm leading-6 text-gray-600">
            <label for="file"
                class="relative cursor-pointer rounded-md bg-white font-semibold text-indifocus-within:outline-none focus-within:ring-2 focus-within:ring-indifocus-within:ring-offset-2 hover:text-indigo-500">
                <span>
                    <input id="file" name="file" type="file"
                        class="file:bg-transparent file:border-none" required>
                </span>
            </label>
        </div>
        <p class="text-xs leading-5 text-gray-600 pl-1">Arrastra y Suelta</p>
        <p class="text-xs leading-5 text-gray-600">PNG, JPG, JPEG peso máximo de archivo 2MB</p>
        <button type="submit" 
            class=" w-44 sm:w-full rounded-md 
                px-3 py-2 mt-4
                text-sm font-semibold text-white shadow-sm 
                bg-indigo-600 hover:bg-indigo-500">
            Actualizar comprobante
        </button>
    </form>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- fin de copia -->


                    <!-- //comprobante de pago -->

                </div>

            </dl>
        </div>
    </div>

    <?php
}