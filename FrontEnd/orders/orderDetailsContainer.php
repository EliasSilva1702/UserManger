<div id="order-details-container" class="max-w-5xl mx-auto px-2">


</div>

<script>
  
function SetOrderDetails(id_order) {
    $.ajax({
        url: '../includes/setOrderDetailsContainer.php',
        type: 'POST',
        dataType: 'html',
        data: {
            id_order: id_order
        },
    })
        .done(function (answer) {
            $("#order-details-container").html(answer);
            // console.log("funciona SetOrderDetails");
        })
        .fail(function () {
            // console.log("error");

        })
}
  
</script>