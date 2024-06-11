<div class="max-w-5xl mx-auto px-4 mt-10 mb-5">
    <div class="text-center">
        <h3 class="text-3xl text-center ">Lista de franquiciados</h3>
        <span class="text-sm text-center text-black opacity-80">(En esta lista puedes modificar la información del franquiciado)</span>
    </div>
    <div class="col-span-2 w-full p-2">
        <div class="mt-1 flex gap-x-2">
            <input type="text" name="search-users" id="search-users" autocomplete="search-users"
                class="block w-full rounded-md border-0 py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  sm:text-sm sm:leading-6"
                placeholder="Buscar franquiciado aquí">
        </div>
    </div>

    <ul role="list" id="franchisee-list-container" class="divide-y divide-gray-100 ">


    </ul>

    <?php
    include_once("../FrontEnd/franchisee/franchiseeDetailsContainer.php");

    ?>
    <script>

        $(document).on('keyup', '#search-users', function () {
            var query = $(this).val();
            max_franchisee_cards = 4;
            SetFranchiseeList(max_franchisee_cards, query);

        });

        let max_franchisee_cards = 4;

        $(SetFranchiseeList(max_franchisee_cards, ''));

        function SetFranchiseeList(max_franchisee_cards, query) {
            $.ajax({
                url: '../includes/setFranchiseeList.php',
                type: 'POST',
                dataType: 'html',
                data: {
                    max_franchisee_cards: max_franchisee_cards,
                    query: query
                },
            })
                .done(function (answer) {
                    $("#franchisee-list-container").html(answer);
                    console.log("funciona SetFranchiseeList");
                })
                .fail(function () {
                    console.log("error");

                })
        }

    </script>
</div>