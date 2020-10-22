<main>
    <section>
        <div class="container">

            <?php if ($this->session->flashdata('danger_alert')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('danger_alert'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success_alert')) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success_alert'); ?>
                </div>
            <?php endif; ?>

            <?php if ($cart_products) : ?>
                <div class="row">
                    <?php foreach ($cart_products as $cart_product) : ?>
                        <div class="col-sm-8">
                            <div class="card cart-card shadow-sm">
                                <div class="card-body">
                                    <img class="cart-item-image" src="<?php echo base_url(); ?>upload/product-images/<?php echo $cart_product['picture']; ?>" alt="">
                                    <div class="cart-item-detail">
                                        <h5 class="cart-item-name"><?php echo $cart_product['product_name']; ?></h5>
                                        <p class="cart-item-price">Rp <?php echo $cart_product['price'] / 1000; ?>.000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-sm-4">col 4</div>
                </div>
            <?php else : ?>
                <h4 class="text-center mt-5">Your cart is empty. Browse our finest collection now!</h4>
            <?php endif; ?>
        </div>
    </section>
</main>