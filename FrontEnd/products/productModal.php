<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width:auto!important;">
        <div class="modal-content" id="productModalContent">
        </div>
    </div>
</div>
<script>

    function SetProductModal(id_product) {
        $.ajax({
            url: '../includes/setProductModal.php',
            type: 'POST',
            dataType: 'html',
            data: {
                id_product: id_product
            },
        })
            .done(function (answer) {
                $("#productModalContent").html(answer);
                console.log("funciona product container");
            })
            .fail(function () {
                console.log("error");

            })
    }
</script>