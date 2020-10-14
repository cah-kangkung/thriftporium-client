<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
        <!-- <a href="<?php echo site_url(); ?>admin_report" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a> -->
    </div>

    <div class="row">
        <div class="col-lg-10">

            <form action="<?php echo site_url(); ?>category/add_category" method="post">

                <!-- Product Detail -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Category Name <span class="badge badge-pill badge-info">required</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control <?php echo (form_error('name')) ? 'is-invalid' : ''; ?>" name="name" id="name" value="<?php echo set_value('name'); ?>" placeholder="Enter Category Name">
                                <div class="invalid-feedback">
                                    <?php echo form_error('name', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label">Category Description <span class="badge badge-pill badge-info">required</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control <?php echo (form_error('description')) ? 'is-invalid' : ''; ?>" name="description" id="description" rows="5"><?php echo set_value('description'); ?></textarea>
                                <div class="invalid-feedback">
                                    <?php echo form_error('description', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex my-4">
                    <a href="<?php echo site_url(); ?>category" class="btn btn-secondary ml-auto">Back</a>
                    <button type="submit" class="btn btn-primary ml-3">Save</button>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->