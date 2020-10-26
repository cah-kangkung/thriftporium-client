<main>
    <section id="all-product-section" class="top-section">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3">
                <?php if (!$products) { ?>
                    <div class="div text-center mx-auto mt-4">
                        <h3>Search not found. Try another search term!</h3>
                    </div>
                <?php } else { ?>
                    <?php foreach ($products as $product) : ?>
                        <a style="text-decoration: none;" href="<?php echo site_url(); ?>products/<?php echo $product['id']; ?>">
                            <div class="col mb-4">
                                <div class="card shadow">
                                    <img src="<?php echo base_url(); ?>upload/product-images/<?php echo $product['product_pictures'][0]; ?>" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                                        <p class="card-text cart-item-price">Rp<?php echo $product['product_price']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                <?php endforeach;
                } ?>
            </div>
        </div>
    </section>
</main>