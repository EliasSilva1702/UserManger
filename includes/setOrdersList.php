<?php
include("manager.php");
if (
    !isset($_POST['max_orders_cards'])
    || !isset($_POST['query'])
) {
    return;
}

$max_orders_cards = $_POST['max_orders_cards'];
$query = $_POST['query'];

$sql = "SELECT orders.ship_to,orders.id,orders.d_creation,orders.t_creation,users.f_num as 'f_num' 
from orders,users
where users.id=orders.id_user
order by d_creation desc, t_creation desc
";

if ($query !== "") {

    $query = trim($query);
    $key = explode(" ", $query);

    $sql = "SELECT orders.ship_to,orders.id,orders.d_creation,orders.t_creation,users.f_num, users.name as 'user_name', users.lastname as 'user_lastname', users.department as 'user_department', users.position as 'user_position'
    from orders,users
    where users.id=orders.id_user and (
    ";

    for ($i = 0; $i < count($key); $i++) {

        if (!empty($key[$i])) {

            if ($i < count($key) - 1) {

                $sql .= " ship_to like '%" . $key[$i] . "%' or d_creation like '%" . $key[$i] . "%' or t_creation like '%" . $key[$i] . "%' or users.name like '%" . $key[$i] . "%' or users.lastname like '%" . $key[$i] . "%' or users.f_num like '%" . $key[$i] . "%' or users.department like '%" . $key[$i] . "%' or users.position like '%" . $key[$i] . "%' or ";
            } else {

                $sql .= " ship_to like '%" . $key[$i] . "%' or d_creation like '%" . $key[$i] . "%' or t_creation like '%" . $key[$i] . "%' or users.name like '%" . $key[$i] . "%' or users.lastname like '%" . $key[$i] . "%' or users.f_num like '%" . $key[$i] . "%' or users.department like '%" . $key[$i] . "%' or users.position like '%" . $key[$i] . "%' ";
            }

        }

    }

    $sql .= ")
    order by d_creation desc, t_creation desc
   ";

}

$orders = $conn->query($sql);

if (!$orders->num_rows > 0) {
    ?>
    <p>No han realizado ningun pedido aún</p>
    <?php
} else {

    foreach ($orders as $key => $order) {

        if ($key < $max_orders_cards) {
            $order_user = new User();
            $order_user->SetUser($order['f_num']);
            ?>
            <li id="order-card-<?php echo $order['id'] ?>" class="flex justify-between gap-x-6 py-5 px-3 cursor-pointer">
                <div class="flex min-w-0 gap-x-4">
                    <?php
                    $urls = $conn->query("SELECT * from users_profile_picture_urls where id_user='" . $order_user->GetId() . "'");
                    if ($urls->num_rows > 0) {
                        foreach ($urls as $key => $url) {
                            ?>
                            <img class="h-12 w-12 flex-none rounded-full bg-gray-50 object-cover" src="<?php echo $url['url'] ?>" alt="">
                            <?php
                        }
                    }
                    ?>
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900">
                            <?php echo $order_user->GetName() . " " . $order_user->GetLastName() ?>
                            <?php
                            if ($User->GetId() == $order_user->GetId()) {
                                ?>
                                (Tú)
                                <?php
                            }
                            ?>
                        </p>
                        <?php
                        $receipt = $conn->query("SELECT * from orders_receipt where id_order='" . $order['id'] . "'");
                        if ($receipt->num_rows > 0) {
                            ?>
                            <span
                                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Hay
                                comprobante</span>
                            <?php
                        } else {
                            ?>
                            <span
                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">No
                                hay comprobante</span>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">

                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        <?php echo date("d/m/Y", strtotime($order['d_creation'])) ?>
                    </p>
                    <p class="mt-1 text-xs leading-5 text-gray-500">
                        <?php echo date("H:i", strtotime($order['t_creation'])) ?>
                    </p>
                </div>
            </li>

            <script>
                // $(document).on('click', '#order-card-<?php echo $order['id'] ?>', function () {
                //     SetOrderDetails('<?php //echo $order['id'] ?>');
                // })

                document.getElementById('order-card-<?php echo $order['id'] ?>').addEventListener('click', function () {
                    SetOrderDetails('<?php echo $order['id'] ?>');
                });
            </script>

            <?php
        }
    }
    ?>

    <div class="flex items-center justify-between px-4">
        <?php
        if ($orders->num_rows > $max_orders_cards) {
            ?>

            <p class="cursor-pointer mt-2 mb-4 text-ms text-blue-500 hover:underline " id="show-more-orders-cards">Mostrar más
            </p>

            <script>
                document.getElementById('show-more-orders-cards').addEventListener('click', function () {
                    max_orders_cards += 3;
                    $(SetOrdersList(max_orders_cards, '<?php echo $query ?>'));
                });
            </script>
            <?php
        }
        if ($max_orders_cards > 5) {
            ?>
            <!-- boton ver menos  -->
            <p class="cursor-pointer text-ms mt-2 mb-4 text-blue-500 hover:underline" id="show-less-orders-cards">Mostrar menos
            </p>

            <script>
                document.getElementById('show-less-orders-cards').addEventListener('click', function () {
                    max_orders_cards -= 3;
                    $(SetOrdersList(max_orders_cards, '<?php echo $query ?>'));
                });
            </script>
            <?php

        }
        ?>

    </div>
    <?php
}