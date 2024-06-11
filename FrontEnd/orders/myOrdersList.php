
<ul role="list" id="orders-cards-container" class="divide-y divide-gray-100 max-w-5xl mx-auto px-2">


</ul>

<?php
include_once("../FrontEnd/orders/orderDetailsContainer.php");
?>
<script>

    let max_orders_cards = 3;

    $(SetMyOrdersList(max_orders_cards));

    function SetMyOrdersList(max_orders_cards) {
        $.ajax({
            url: '../includes/setMyOrdersList.php',
            type: 'POST',
            dataType: 'html',
            data: {
                max_orders_cards: max_orders_cards
            },
        })
            .done(function (answer) {
                $("#orders-cards-container").html(answer);
                // console.log("funciona SetMyOrdersList");
            })
            .fail(function () {
                // console.log("error");

            })
    }

</script>