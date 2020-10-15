<script>
    const previewImage = function() {
        $('#imagePreview').html('');
        let total_file = document.getElementById('images').files.length;
        for (let i = 0; i < total_file; i++) {
            const template = document.createElement('div');
            template.classList.add('col-xl-3');
            template.classList.add('col-lg-4');
            template.classList.add('col-md-6');
            template.classList.add('mb-4');
            template.innerHTML = `<div class="card" style="width: 200px; height: 200px;">
                                    <img class="card-img-top" style="height: 100%; width: 100%; object-fit: contain;" src="" alt="Product images">
                                </div>`;
            const img = template.querySelector('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.onload = function() {
                URL.revokeObjectURL(this.src);
            }
            $('#imagePreview').append(template);
        }
    };

    const clearFileInput = function() {
        document.getElementById('images').value = '';
        $('#imagePreview').html('');
    };
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
        <!-- <a href="<?php echo site_url(); ?>admin_report" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a> -->
    </div>

    <?php if ($this->session->flashdata('danger_alert')) : ?>
        <div class="alert alert-dismissible alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('danger_alert'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success_alert')) : ?>
        <div class="alert alert-dismissible alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $this->session->flashdata('success_alert'); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg-10">

            <form action="<?php echo site_url(); ?>admin_product/edit_product/<?php echo $product['id']; ?>" method="post" enctype="multipart/form-data">

                <!-- Uplaod Picture -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Upload <span class="badge badge-pill badge-info">required</span></h6>
                        <small>Image format .jpg .jpeg .png and maximun file size is 2 Mb each (else it will not get uploaded)</small>
                    </div>
                    <div class="card-body">
                        <input type="file" id="images" class="mb-3 <?php echo (form_error('images[]')) ? 'is-invalid' : ''; ?>" name="images[]" onchange="previewImage();" multiple />
                        <span style="cursor: pointer;" onclick="clearFileInput()">
                            <i class="fas fa-times"></i> Cancel
                        </span>
                        <div id="imagePreview" class="row mt-4">

                            <?php foreach ($product['product_pictures'] as $picture) : ?>
                                <div class="col-xl-3 col-lg-4 col-md-6">
                                    <div class="card" style="width: 200px; height: 200px;">
                                        <img class="card-img-top" style="height: 100%; width: 100%; object-fit: contain;" src="<?php echo base_url(); ?>upload/product-images/<?php echo $picture; ?>" alt="Product images">
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                        <div class="invalid-feedback">
                            <?php echo form_error('images[]', '<div class="pl-2">', '</div>'); ?>
                        </div>
                    </div>
                </div>
                <!-- Product Detail -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Detail</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Product Name <span class="badge badge-pill badge-info">required</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?php echo (form_error('name')) ? 'is-invalid' : ''; ?>" name="name" id="name" value="<?php echo $product['product_name']; ?>" placeholder="Product Name">
                                <div class="invalid-feedback">
                                    <?php echo form_error('name', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-4 col-form-label">Category <span class="badge badge-pill badge-info">required</span></label>
                            <div class="col-sm-8">
                                <select class="form-control" name="category_id" id="category_id">
                                    <option value="<?php echo $product['category_id']; ?>"><?php echo $product['category_name']; ?></option>
                                    <?php foreach ($category as $c) : ?>
                                        <option value="<?php echo $c['id']; ?>"><?php echo $c['category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label">Product Description <span class="badge badge-pill badge-info">required</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control <?php echo (form_error('description')) ? 'is-invalid' : ''; ?>" name="description" id="description" rows="5"><?php echo $product['product_description']; ?></textarea>
                                <div class="invalid-feedback">
                                    <?php echo form_error('description', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Price -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Price & Stock</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="price" class="col-sm-4 col-form-label">Price <span class="badge badge-pill badge-info">required</span></label>
                            <div class="col-sm-8">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control <?php echo (form_error('price')) ? 'is-invalid' : ''; ?>" name="price" id="price" placeholder="Enter Price" value="<?php echo $product['product_price']; ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('price', '<div class="pl-2">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stock" class="col-sm-4 col-form-label">Stock <span class="badge badge-pill badge-info">required</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?php echo (form_error('stock')) ? 'is-invalid' : ''; ?>" name="stock" id="stock" placeholder="Enter Stock" value="<?php echo $product['product_stock']; ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('stock', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="availability" class="col-sm-4 col-form-label">Availability</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?php echo (form_error('availability')) ? 'is-invalid' : ''; ?>" name="availability" id="availability" placeholder="Enter availability" value="<?php echo $product['product_availability']; ?>" readonly>
                                <div class="invalid-feedback">
                                    <?php echo form_error('availability', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex my-4">
                    <a href="<?php echo site_url(); ?>admin_product" class="btn btn-secondary ml-auto">Back</a>
                    <button type="submit" class="btn btn-primary ml-3">Save</button>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->