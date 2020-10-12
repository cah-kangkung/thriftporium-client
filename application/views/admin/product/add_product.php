<script>
    const previewImage = function() {
        let total_file = document.getElementById("pictures").files.length;
        for (let i = 0; i < total_file; i++) {
            const template = document.createElement('div');
            template.classList.add('col-sm-3');
            template.innerHTML = `<div class="card">
                                    <img class="card-img-top" src="" alt="Card image cap">
                                </div>`;
            const img = template.querySelector('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.onload = function() {
                URL.revokeObjectURL(this.src);
            }
            $('#imagePreview').append(template);
        }
    };
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
        <!-- <a href="<?php echo site_url(); ?>admin_report" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a> -->
    </div>

    <div class="row">
        <div class="col-lg-10">

            <form action="<?php echo site_url(); ?>admin_product/add_product" method="post" enctype="multipart/form-data">

                <!-- Uplaod Picture -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Upload</h6>
                    </div>
                    <div class="card-body">
                        <input type="file" id="pictures" class="<?php echo (form_error('pictures[]')) ? 'is-invalid' : ''; ?>" name="pictures[]" onchange="previewImage();" multiple />
                        <div id="imagePreview" class="row mt-4"></div>
                        <div class="invalid-feedback">
                            <?php echo form_error('pictures[]', '<div class="pl-2">', '</div>'); ?>
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
                            <label for="name" class="col-sm-4 col-form-label">Product Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?php echo (form_error('name')) ? 'is-invalid' : ''; ?>" name="name" id="name" value="<?php echo set_value('email'); ?>" placeholder="Product Name">
                                <div class="invalid-feedback">
                                    <?php echo form_error('name', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-sm-4 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="category_id" id="category_id">
                                    <?php foreach ($category as $c) : ?>
                                        <option value="<?php echo $c['id']; ?>"><?php echo $c['category_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label">Product Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control <?php echo (form_error('description')) ? 'is-invalid' : ''; ?>" name="description" id="description" rows="5"><?php echo set_value('description'); ?></textarea>
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
                            <label for="price" class="col-sm-4 col-form-label">Price</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                    </div>
                                    <input type="text" class="form-control <?php echo (form_error('price')) ? 'is-invalid' : ''; ?>" name="price" id="price" placeholder="Enter Price" value="<?php echo set_value('price'); ?>">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('price', '<div class="pl-2">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stock" class="col-sm-4 col-form-label">Stock</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?php echo (form_error('stock')) ? 'is-invalid' : ''; ?>" name="stock" id="stock" placeholder="Enter Stock" value="<?php echo set_value('stock'); ?>">
                                <div class="invalid-feedback">
                                    <?php echo form_error('stock', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex my-4">
                    <a href="<?php echo site_url(); ?>admin_test" class="btn btn-secondary ml-auto">Back</a>
                    <button type="submit" class="btn btn-primary ml-3">Save</button>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->