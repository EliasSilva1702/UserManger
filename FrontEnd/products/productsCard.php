
<div class="group relative">
    <div
        class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
        <?php

        // echo $product['id'];
        $urls = $conn->query("SELECT * from products_url_photos where id_product='" . $product['id'] . "'");

        if ($urls->num_rows > 0) {
            foreach ($urls as $key => $url) {
                if ($key === 0) {
                    ?>
                    <img src="<?php echo $url['url']?>"
                        alt="Front of men&#039;s Basic Tee in black."
                        class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                    <?php
                }
            }
        }
        ?>

    </div>
    
    <div class="mt-4 flex justify-between">
        <div>
            <h3 class="text-sm text-gray-700">
                <a href="#">
                    <span aria-hidden="true" class="absolute inset-0"></span>
                    <?php echo $product['name'] ?>
                </a>
            </h3>
            <p class="mt-1 text-sm text-gray-500">Black</p>
        </div>
        <p class="text-sm font-medium text-gray-900">$35</p>
    </div>
</div>