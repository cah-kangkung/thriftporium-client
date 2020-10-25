<main>
    <div id="hero-section">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/thriftporium-bg/bg-six.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/thriftporium-bg/bg-four.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?php echo base_url(); ?>assets/img/thriftporium-bg/bg-five.jpg" alt="Second slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <section id="category-section">
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