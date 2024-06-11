// *Hacer dropdown a los menus
function toggleDropdown(dropdownID) {
    let dropdown = document.getElementById(dropdownID);
    dropdown.classList.toggle("hidden");
}

// function SetProuctsList() {
//     $.ajax({
//         type: "POST",
//         url: "url",
//         data: "data",
//         dataType: "dataType",
//         success: function (response) {

//         }
//     });
// }

// let page_products_list = 4;
// function SetProductsList(page_products_list) {
//     $.ajax({
//         url: '../includes/setProductsList.php',
//         type: 'POST',
//         dataType: 'html',
//         data: {
//             page_products_list: page_products_list
//         },
//     })
//         .done(function (answer) {
//             $("#products-list-container").html(answer);
//             console.log("funciona list container");
//         })
//         .fail(function () {
//             console.log("error");

//         })
// }
// function LoadShoppingCartProducts(id_user) {
//     $.ajax({
//         url: '../includes/loadShoppingCartProducts.php',
//         type: 'POST',
//         dataType: 'html',
//         data: {
//             id_user: id_user
//         },
//     })
//         .done(function (answer) {
//             $("#products-list-container").html(answer);
//             console.log("funciona list container");
//         })
//         .fail(function () {
//             console.log("error");

//         })
// }


function DeleteProduct(id_product) {
    $.ajax({
        url: '../includes/deleteProductFromCart.php',
        type: 'POST',
        dataType: 'html',
        data: {
            id_product: id_product
        },
    })
        .done(function (answer) {
            console.log("funciona eliminar producto");
        })
        .fail(function () {
            console.log("error");

        })
}
