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

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card shadow" style="overflow: hidden;">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php for ($i = 0; $i < count($products); $i++) : ?>
                                    <div class="carousel-item <?php echo ($i == 0) ? 'active' : ''; ?>">
                                        <img class="d-block w-100" src="<?php echo base_url(); ?>upload/product-images/<?php echo $products[$i]['product_pictures'][0]; ?>" alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <a style="text-decoration: none;" href="<?php echo site_url(); ?>products/<?php echo $products[$i]['id']; ?>">
                                                <h5 class="text-white"><?php echo $products[$i]['product_name']; ?></h5>
                                                <p class="fw-400">Rp<?php echo $products[$i]['product_price']; ?></p>
                                            </a>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 frame-container">
                    <div class="slide-show-card card shadow">
                        <div class="card-body">
                            <h1 style="line-height: 1.3em;">Our Newest Collection!</h1>
                            <p class="fw-400">Browse through our finest collection.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="category-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-6">
                    <a href="<?php echo site_url(); ?>products/category/jacket">
                        <div class="card shadow" style="height: 600px; overflow: hidden;">
                            <img src="<?php echo base_url(); ?>assets/img/category/jacket.jpg" class="card-img-top" alt="...">
                            <div class="overlay">
                                <h2 class="text">Jacket</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="<?php echo site_url(); ?>products/category/sweater">
                        <div class="card shadow" style="height: 600px; overflow: hidden;">
                            <img src="<?php echo base_url(); ?>assets/img/category/sweater.jpg" class="card-img-top" alt="...">
                            <div class="overlay">
                                <h2 class="text">Sweater</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="<?php echo site_url(); ?>products/category/denim">
                        <div class="card shadow" style="width: 100%; height: 400px; overflow: hidden;">
                            <img src="<?php echo base_url(); ?>assets/img/category/denim.jpg" class="card-img-top" alt="...">
                            <div class="overlay">
                                <h2 class="text">Denim</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>


</main>