
<!--Searcher -->
<div class="max-w-5xl relative flex items-center justify-between mx-auto p-3 text-gray-600">
        <input
        type="text" 
        name="search-orders" 
        id="search-orders" 
        autocomplete="search-orders"
        placeholder="Busca tu pedido aquí"
        class=" w-full placeholder:text-gray-400 ring-1 ring-inset ring-gray-300 py-3 px-6 rounded-md"
        >
        <!-- class="w-full py-2 px-6 font-semibold placeholder-gray-500 text-black rounded focus:border-none ring-2 ring-gray-300 focus:ring-gray-500 focus:ring-2 "
         -->
</div>

<ul role="list" id="orders-cards-container" class="divide-y divide-gray-100 max-w-5xl mx-auto px-2">


</ul>

<?php

include_once("../FrontEnd/orders/orderDetailsContainer.php");
?>
<script>


    $(document).on('keyup', '#search-orders', function () {
        var query = $(this).val();
        max_orders_cards = 4;
        SetOrdersList(max_orders_cards, query);

    });

    let max_orders_cards = 4;

    $(SetOrdersList(max_orders_cards,""));

    function SetOrdersList(max_orders_cards, query) {
        $.ajax({
            url: '../includes/setOrdersList.php',
            type: 'POST',
            dataType: 'html',
            data: {
                max_orders_cards: max_orders_cards,
                query: query
            },
        })
            .done(function (answer) {
                $("#orders-cards-container").html(answer);
                // console.log("funciona SetOrdersList");
            })
            .fail(function () {
                // console.log("error");

            })
    }

</script>