<footer>
    <div class="container">
        <div class="copyright">
            Copyright &#9400; 2020 Thrifporium
        </div>
        <div class="footer-list ml-auto">
            <?php foreach ($category as $c) : ?>
                <a class="" href="<?php echo site_url(); ?>products/category/<?php echo $c['category_name'] ?>"><?php echo $c['category_name']; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</footer>
<!-- Optional JavaScript -->
<!-- JavaScript Dependencies: jQuery, Popper.js, Bootstrap JS, Shards JS -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/shards.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom-script.js"></script>
</body>

</html>