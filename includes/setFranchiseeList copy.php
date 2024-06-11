<?php
include("manager.php");

if (!isset($_POST['users_list_page'])) {
    ?>
    <p>Faltan datos...</p>
    <?php
    return;
}
$users_list_page = $_POST['users_list_page'];
// echo $users_list_page;
$users = $conn->query("SELECT * 
from users
order by name asc");

if (!$users->num_rows > 0) {
    ?>
    <p>No hay franquiciados aun</p>
    <?php
    return;
}
$max_users_per_page = 2;

$pages_count = ceil($users->num_rows / $max_users_per_page);
// echo $pages_count;
?>

<div class="max-w-5xl mx-auto px-2">

    <h3>Lista de franquiciados</h3>
    <ul role="list" class="divide-y divide-gray-100 ">
        <?php
        foreach ($users as $key => $user) {


            // if ($key < $pages_count * $max_users_per_page && $key >= ($pages_count * $max_users_per_page) - $max_users_per_page) {
            if ($key < $max_users_per_page) {

                $_user = new User();
                $_user->SetUser($user['f_num']);
                ?>
                <li id="user<?php echo $_user->GetId() ?>" class="flex justify-between gap-x-6 py-5 cursor-pointer">
                    <div class="flex min-w-0 gap-x-4">
                        <img class="h-12 w-12 flex-none rounded-full bg-gray-50"
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                            alt="">
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
                    $(document).on('click', '#user<?php echo $_user->GetId() ?>', function () {
                        SetFranchiseeDetails('<?php echo $_user->GetId() ?>');
                    })
                </script>

                <?php
            }
        }
        ?>

    </ul>

</div>
<?php

if ($pages_count > 1) {
    ?>
    <div class="flex items-center justify-center border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
        <div class="flex flex-1 justify-between md:hidden">
            <a href="#"
                class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
            <a href="#"
                class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center justify-center items-center flex-col">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">1</span>
                    to
                    <span class="font-medium">10</span>
                    of
                    <span class="font-medium">97</span>
                    results
                </p>
            </div>
            <div>
                <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <a href="#"
                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <!-- Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" -->
                    <!-- <a href="#" aria-current="page"
                        class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a> -->
                    <?php
                    for ($i = 0; $i < $pages_count; $i++) {
                        ?>
                        <p id="page-<?php echo $i ?>"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                            <?php echo $i + 1; ?>
                        </p>
                        <script>
                            $(document).on('click', '#page-<?php echo $i ?>', function () {

                                users_list_page = <?php echo $i + 1 ?>;

                                $(SetFranchiseeList(users_list_page));
                            })


                        </script>
                        <?php
                    }

                    ?>

                    <!-- <span
                    class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span> -->
                    <a href="#"
                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>
    <?php
}
