<main>
    <section id="all-product-section" class="top-section">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3">
                <?php foreach ($products as $product) : ?>
                    <a href="<?php echo site_url(); ?>products/<?php echo $product['id']; ?>">
                        <div class="col mb-4">
                            <div class="card">
                                <img src="<?php echo base_url(); ?>upload/product-images/<?php echo $product['product_pictures'][0]; ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach;; ?>
            </div>
        </div>
    </section>
</main>