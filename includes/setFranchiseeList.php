<?php
include("manager.php");

if (
    !isset($_POST['max_franchisee_cards'])
    || !isset($_POST['query'])
) {

    return;
}
$max_franchisee_cards = $_POST['max_franchisee_cards'];
$query = $_POST['query'];

$sql = "SELECT * 
from users
order by name asc";

if ($query !== "") {
    $query = trim($query);

    // $sql = "SELECT *
    // from users
    // where  (users.name like '%" . $query . "%' or users.lastname like '%" . $query . "%' or users.f_num like '%" . $query . "%' or users.department like '%" . $query . "%' or users.position like '%" . $query . "%')
    // order by name asc
    // ";

    // $query = trim($query);
    $key = explode(" ", $query);

    $sql = "SELECT *
    from users
    where  (";

    for ($i = 0; $i < count($key); $i++) {

        if (!empty($key[$i])) {

            if ($i < count($key) - 1) {

                $sql .= " users.name like '%" . $key[$i] . "%' or users.lastname like '%" . $key[$i] . "%' or users.f_num like '%" . $key[$i] . "%' or users.department like '%" . $key[$i] . "%' or users.position like '%" . $key[$i] . "%' or ";
            } else {

                $sql .= " users.name like '%" . $key[$i] . "%' or users.lastname like '%" . $key[$i] . "%' or users.f_num like '%" . $key[$i] . "%' or users.department like '%" . $key[$i] . "%' or users.position like '%" . $key[$i] . "%' ";
            }

        }

    }

    $sql .= ")
    order by name asc
   ";


}


$users = $conn->query($sql);
if (!$users->num_rows > 0) {
    ?>
    <p>No hay franquiciados aún</p>
    <?php
    return;
}

?>

<?php
foreach ($users as $key => $user) {

    if ($key < $max_franchisee_cards) {

        $_user = new User();
        $_user->SetUser($user['f_num']);
        ?>
        <li id="user<?php echo $_user->GetId() ?>" class="flex justify-between gap-x-6 p-4 cursor-pointer">
            <div class="flex min-w-0 gap-x-4">
                <?php
                $urls = $conn->query("SELECT * from users_profile_picture_urls where id_user='" . $_user->GetId() . "'");
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
                        <?php echo $_user->GetName() . " " . $_user->GetLastName() ?>
                    </p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                        <?php echo $_user->GetEmail() ?>
                    </p>
                </div>
            </div>
            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                <p class="text-sm leading-6 text-gray-900">
                    <?php echo $_user->GetPosition() ?>
                </p>
                <!-- <p class="mt-1 text-xs leading-5 text-gray-500">
                        <?php //echo date("d/m/Y", strtotime($_user['d_creation'])) ?></time>
                    </p> -->
            </div>
        </li>

        <script>


            $(document).off('click', '#user<?php echo $_user->GetId() ?>').on('click', '#user<?php echo $_user->GetId() ?>', function () {
                SetFranchiseeDetails('<?php echo $_user->GetId() ?>');
            })
        </script>

        <?php
    }
}

?>

<div class="flex items-center justify-between px-4">
    <?php
    if ($users->num_rows > $max_franchisee_cards) {
        ?>

        <p id="show-more-franchisee-cards" class="cursor-pointer mt-2 mb-4 text-ms text-blue-500 hover:underline ">
            Mostrar más
        </p>

        <script>
            document.getElementById('show-more-franchisee-cards').addEventListener('click', function () {
                max_franchisee_cards += 3;
                $(SetFranchiseeList(max_franchisee_cards, '<?php echo $query ?>'));
            });
        </script>
        <?php
    }
    if ($max_franchisee_cards > 5) {
        ?>
        <!-- boton ver menos  -->
        <p class="cursor-pointer text-ms mt-2 mb-4 text-blue-500 hover:underline" id="show-less-franchisee-cards">Mostrar
            menos
        </p>

        <script>
            document.getElementById('show-less-franchisee-cards').addEventListener('click', function () {
                max_franchisee_cards -= 3;
                $(SetFranchiseeList(max_franchisee_cards, '<?php echo $query ?>'));
            });
        </script>
        <?php

    }
    ?>
</div>