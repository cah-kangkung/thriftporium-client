<main>
    <section id="cart-section" class="top-section">
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
                    <div class="col-sm-8">
                        <?php $i = 0; ?>
                        <?php $total_price = 0; ?>
                        <?php foreach ($cart_products as $cart_product) : ?>
                            <div class="card cart-card">
                                <div class="row card-body">
                                    <div class="col-3 col-sm-2 cart-item-image">
                                        <a href="<?php echo site_url(); ?>products/<?php echo $cart_product['product_id']; ?>">
                                            <img style="height: 100%;" src="<?php echo base_url(); ?>upload/product-images/<?php echo $cart_product['picture']; ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="col-9 col-sm-10 cart-item-detail">
                                        <a href="<?php echo site_url(); ?>products/<?php echo $cart_product['product_id']; ?>">
                                            <h5 class="cart-item-name"><?php echo $cart_product['product_name']; ?> (x<?php echo $cart_product['qty']; ?>)</h5>
                                        </a>
                                        <p class="cart-item-price">Rp<?php echo $cart_product['price'] / 1000; ?>.000</p>
                                        <div class="cart-item-action d-flex align-items-center">
                                            <a class="ml-auto" href="<?php echo site_url(); ?>cart/delete_cart_item/<?php echo $cart_product['user_id']; ?>/<?php echo $cart_product['product_id']; ?>">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-info btn-sm ml-3" data-toggle="modal" data-target="#editCart<?php echo $i; ?>">Edit</button>

                                            <!-- Edit Cart Modal -->
                                            <div class="modal fade" id="editCart<?php echo $i; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <form class="d-flex flex-column" action="<?php echo site_url(); ?>cart/edit_cart_item/<?php echo $cart_product['user_id']; ?>/<?php echo $cart_product['product_id']; ?>" method="post">
                                                                <h5 class="mb-4"><?php echo $cart_product['product_name']; ?></h5>
                                                                <div class="d-flex">
                                                                    <p class="fw-400 mr-3">Quantity:</p>
                                                                    <div class="input-number d-flex align-items-center mb-5">
                                                                        <i class="fas fa-minus-circle fa-lg" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></i>
                                                                        <input class="mx-2" type="number" min="1" max="<?php echo $cart_product['product_availability']; ?>" name="quantity" value="<?php echo $cart_product['qty']; ?>" readonly>
                                                                        <i class="fas fa-plus-circle fa-lg" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-light ml-auto" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary ml-3">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $total_price += $cart_product['price'] * $cart_product['qty'];
                            $i++;
                        endforeach;
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5>Shopping summary</h5>
                                <p class="fw-400">Total: <span class="cart-item-price">Rp<?php echo $total_price / 1000; ?>.000</span></p>
                                <form method="post" action="<?php echo site_url(); ?>order/checkout">
                                    <?php $postvalue = base64_encode(serialize($cart_products)); ?>
                                    <input type="hidden" name="cart_items" value="<?php echo $postvalue; ?>">
                                    <button type="submit" class="btn btn-success btn-block">Buy</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <h4 class="text-center mt-5">Your cart is empty. Browse our finest collection now!</h4>
            <?php endif; ?>
        </div>
    </section>
</main>

<script>

</script>