<main>
    <section id="view-product-section" class="top-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <!-- The expanding image container -->
                    <div class="preview-image-container mb-3">
                        <img src="<?php echo base_url(); ?>upload/product-images/<?php echo $product['product_pictures'][0]; ?>" id="expandedImg" style="width:100%">
                    </div>
                    <div class="row">
                        <?php foreach ($product['product_pictures'] as $product_picture) : ?>
                            <div class="col-3 col-sm-4 col-lg-3" style="width: 100px; height: 100px;">
                                <img src="<?php echo base_url(); ?>upload/product-images/<?php echo $product_picture; ?>" alt="" onclick="previewImage(this)" style="height: 100%; width: 100%; object-fit: contain;">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <span class="badge badge-dark"><?php echo ($product['product_availability'] != 0) ? 'Available' : 'Stock Empty'; ?></span>
                    <span class="badge badge-info"><?php echo $product['category_name']; ?></span>
                    <div class="view-product-detail mt-2">
                        <h3 class="view-product-name"><?php echo $product['product_name']; ?></h3>
                        <h5 class="view-product-price mb-4">Rp<?php echo $product['product_price'] / 1000; ?>.000</h5>
                        <h5 class="">Description: </h5>
                        <p class="view-product-description fw-400"><?php echo $product['product_description']; ?></p>
                        <h5 class="">Weight: </h5>
                        <p class="view-product-weight fw-400"><?php echo $product['product_weight']; ?> gram</p>
                    </div>
                    <form class="buy-form" action="<?php echo site_url(); ?>cart/add_to_cart" method="post">
                        <div class="row mb-4">
                            <div class="col-md-2">
                                <h5>Quantity: </h5>
                            </div>
                            <div class="col-md-10">
                                <div class="input-number ml-3" style="display: flex; align-items: center;">
                                    <i class="fas fa-minus-circle fa-lg" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></i>
                                    <input class="mx-2" type="number" min="1" max="<?php echo $product['product_availability']; ?>" name="quantity" value="<?php echo $product['product_availability']; ?>" readonly>
                                    <i class="fas fa-plus-circle fa-lg" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"></i>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product_status" value="<?php echo $product['product_status']; ?>">

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

                        <button class="btn btn-primary btn-block" type="submit" <?php echo ($product['product_status'] != 1 || $product['product_availability'] != 1) ? 'disabled' : ''; ?>><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                    </form>
                </div>
            </div>
    </section>
</main>


<script>
    function previewImage(imgs) {
        // Get the expanded image
        var expandImg = document.getElementById("expandedImg");
        // Use the same src in the expanded image as the image being clicked on from the grid
        expandImg.src = imgs.src;
        // Show the container element (hidden with CSS)
        expandImg.parentElement.style.display = "block";
    }
</script>