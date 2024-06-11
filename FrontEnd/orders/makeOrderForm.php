<?php
$shopping_cart = $conn->query("SELECT * from shopping_carts where id_user='" . $User->GetId() . "'");

if ($shopping_cart->num_rows === 0) {
  $sql = "INSERT INTO `shopping_carts`( `id_user`) VALUES ('" . $User->GetId() . "')";
  $conn->query($sql);
}

?>


<h1 class="text-center mt-12 text-7xl font-bold text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400">
  Realiza tu pedido
</h1>


<main class="max-w-5xl	mx-auto mt-7 p-4">
  <div class="space-y-12 my-8">
    <div class="border-b border-gray-900/10 pb-12 grid grid-cols-1 gap-4">

      <!-- agregar producto -->
      <section class="my-8 ">
        <div class="flex justify-center items-center text-blue-900 mb-16 gap-x-2">

          <h2 class="text-xl sm:text-3xl font-bold tracking-tight text-blue-900 opacity-80 mb-1">
            Seleccione sus productos a pedir
          </h2>
          <div class="hidden sm:flex">
            <?php include_once("../FrontEnd/Icons/shopping-cart.php") ?>
          </div>

        </div>

        <form action="../includes/addProductToCart.php" method="POST" class="flex flex-col gap-2">


          <div class="flex flex-row gap-x-5 justify-center">
            <!--producto -->
            <div class="col-span-6 sm:col-span-2">
              <label for="id_product" class=" ml-2 block text-sm font-medium leading-6 text-gray-900">Producto</label>
              <div class="mt-1  w-full">
                <select id="id_product" name="id_product" autocomplete="product-name" required
                  class="block w-full rounded-md border-0 py-[9px] px-2 mb-5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset sm:max-w-xs sm:text-sm sm:leading-6">

                  <?php
                  $products = $conn->query("SELECT * from products");
                  foreach ($products as $key => $product) {
                    ?>

                    <option value="<?php echo $product['id'] ?>">
                      <?php echo $product['name'] ?>
                    </option>
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <!-- fin producto -->

            <!-- cantidad -->
            <div class=" col-span-6 sm:col-span-2">
              <label for="quantity" class=" ml-2 block text-sm font-medium leading-6 text-gray-900">Cantidad</label>
              <div class="mt-1">
                <input id="quantity" name="quantity" type="number"  min="1" autocomplete="quantity" required value="1"
                  class="block w-full rounded-md border-0 py-[8px] px-2 mb-5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset sm:max-w-xs sm:text-sm sm:leading-6">
              </div>
            </div>
            <!-- fin cantidad -->
          </div>

          <!--  carrito -->
          <div class="mt-4 sm:mt-8 col-span-6 sm:col-span-2 flex items-center justify-center ">
            <!-- <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button> -->
            <button type="submit"
              class=" w-full sm:w-[50%]  rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
              Agregar al carrito
            </button>
          </div>

        </form>


        <h2 class="text-xl font-bold tracking-tight text-black opacity-80 text-center mt-10">
          Productos seleccionados
        </h2>
        <div id="products-list-container" class="mt-6 
              grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4 
              gap-x-6 gap-y-10  xl:gap-x-8">

          <?php
          $sql = "SELECT shopping_carts_products.id_product,shopping_carts_products.quantity from shopping_carts,shopping_carts_products where id_user='" . $User->GetId() . "' and shopping_carts_products.id_shopping_cart=shopping_carts.id";
          $cart_products = $conn->query($sql);

          if (!$cart_products->num_rows > 0) {
            ?>
            <p class="col-span-full text-center items-center justify-center ">No has seleccionado ningún producto aún...
            </p>
            <?php
          } else {

            foreach ($cart_products as $key => $cart_product) {

              $products = $conn->query("SELECT * from products where id='" . $cart_product['id_product'] . "'");
              foreach ($products as $key => $product) {
                ?>

                <div id="ProductCard<?php echo $product['id'] ?>" class="group relative">

                  <p id="DeleteProduct<?php echo $product['id']; ?>"
                    class="absolute right-0 
                  items-center rounded-md bg-red-50 px-2 py-2 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10 cursor-pointer">Quitar</p>

                  <script>
                    $(document).on('click', '#DeleteProduct<?php echo $product['id']; ?>', function () {

                      DeleteProduct('<?php echo $product['id'] ?>');

                      // Obtener referencia al elemento que deseas eliminar
                      var e = document.getElementById("ProductCard<?php echo $product['id'] ?>");

                      // Verificar si el elemento existe antes de intentar eliminarlo
                      if (e) {
                        // Eliminar el elemento del DOM
                        e.remove();
                      }

                    });

                  </script>


                  <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none  lg:h-80">
                    <?php

                    // echo $product['id'];
                    $urls = $conn->query("SELECT * from products_url_photos where id_product='" . $product['id'] . "'");

                    if ($urls->num_rows > 0) {
                      foreach ($urls as $key => $url) {
                        if ($key === 0) {
                          ?>
                          <img src="<?php echo $url['url'] ?>" alt=""
                            class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                          <?php
                        }
                      }
                    }
                    ?>

                  </div>


                  <div class="mt-4 flex justify-between">
                    <h3 class="text-sm text-gray-700">
                      <?php echo $product['name'] ?>
                    </h3>
                    <p class="text-sm px-2 font-medium text-gray-900">
                      Cant.
                      <?php echo $cart_product['quantity'] ?>
                    </p>
                  </div>
                </div>
                <?php
              }
            }
          }
          ?>
        </div>
        <!-- // carrito -->
      </section>
      <!-- // agregar producto -->
      <hr>
      <!-- pedido detalles -->
      <form action="../includes/addOrder.php" method="POST" enctype="multipart/form-data">
        <div class=" grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <!-- direccion -->
          <div class="col-span-full my-8">
            <label for="ship_to" class="text-lg font-medium leading-6 text-blue-900 flex gap-x-1 ml-2">Dirección de
              destino
              <?php include_once("../FrontEnd/Icons/Order.php"); ?>
            </label>
            <div class="mt-2">
              <textarea id="ship_to" name="ship_to" rows="3"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 sm:text-sm sm:leading-6 p-3"></textarea>
            </div>
            <p class="mt-1 ml-2 text-sm leading-6 text-gray-600">Puedes especificar a dónde quieres que sea enviado tu
              pedido.
            </p>
          </div>
          <!-- //direccion -->

          <!-- comprobante de pago -->
          <div class="col-span-full sm:mb-7">
            <label for="receipt" class="text-lg font-medium leading-6 text-blue-900 flex gap-x-1 ml-2">Comprobante de
              pago
              <?php include_once("../FrontEnd/Icons/Ticket.php"); ?>
            </label>
            <!-- <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"> -->

            <!-- Copia -->

            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
              <div class="text-center">
                <?php include("../FrontEnd/Icons/File.php") ?>
                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                  <label for="file-upload"
                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                    <span>
                      <input id="receipt" name="receipt" type="file" class="file:bg-transparent file:border-none">
                    </span>
                  </label>
                </div>
                <p class="text-xs leading-5 text-gray-600 pl-1">Arrastra y Suelta</p>
                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF peso máximo de archivo 2MB</p>

              </div>
            </div>
            <!-- fin de copia -->


            <!-- //comprobante de pago -->

          </div>



        </div>
        <div class=" mt-10 flex items-center justify-center gap-x-6">
          <!-- <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button> -->
          <button type="submit" class=" w-full sm:w-[50%] rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm 
    hover:bg-indigo-500">
            Hacer pedido
          </button>
        </div>
      </form>
    </div>

  </div>
</main>