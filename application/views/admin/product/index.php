<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Product List</h1>
        <span><a class="btn btn-primary" href="<?php echo site_url(); ?>admin_product/add_product">Add Product</a></span>
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Weight</th>
                            <th>Stock</th>
                            <th>Availability</th>
                            <th>Sold</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['category_name']; ?></td>
                                <td><?php echo "Rp " . ($product['product_price'] / 1000) . ",000"; ?></td>
                                <td><?php echo $product['product_weight']; ?> gr</td>
                                <td><?php echo $product['product_stock']; ?></td>
                                <td><?php echo $product['product_availability']; ?></td>
                                <td><?php echo $product['product_stock'] - $product['product_availability']; ?></td>
                                <td><?php echo ($product['product_status_detail']); ?></td>
                                <td>
                                    <a href="<?php echo site_url(); ?>admin_product/edit_product/<?php echo $product['id']; ?>" class="badge badge-info p-1">Edit</a>
                                    <?php if ($product['product_status_detail'] == 'UNPUBLISH') : ?>
                                        <a href="<?php echo site_url(); ?>admin_product/toggle_status/publish/<?php echo $product['id']; ?>" class="badge badge-warning p-1">Publish</a>
                                    <?php elseif ($product['product_status_detail'] == 'PUBLISH') : ?>
                                        <a href="<?php echo site_url(); ?>admin_product/toggle_status/unpublish/<?php echo $product['id']; ?>" class="badge badge-warning p-1">Unpublish</a>
                                    <?php endif; ?>
                                    <a href="<?php echo site_url(); ?>admin_product/delete_product/<?php echo $product['id']; ?>" class="badge badge-danger p-1" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->