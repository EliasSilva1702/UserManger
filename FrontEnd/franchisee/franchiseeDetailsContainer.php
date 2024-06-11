<div id="franchisee-details-container" class="max-w-5xl mx-auto px-2">


</div>

<script>
  
function SetFranchiseeDetails(id_user) {
    $.ajax({
        url: '../includes/setFranchiseeDetailsContainer.php',
        type: 'POST',
        dataType: 'html',
        data: {
            id_user: id_user
        },
    })
        .done(function (answer) {
            $("#franchisee-details-container").html(answer);
            console.log("funciona SetFranchiseeDetails");
        })
        .fail(function () {
            console.log("error");

        })
}
  
</script>