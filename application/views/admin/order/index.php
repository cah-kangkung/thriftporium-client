<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Order</h1>
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
        <div class="card-header py-3">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="">All</a>
                </li>
            </ul>
        </div>
        <?php if (isset($order_list)) : ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Receiver</th>
                                <th>Products</th>
                                <th>Destination</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($order_list as $order) : ?>
                                <tr>
                                    <td><?php echo $order['order_number']; ?></td>
                                    <td><?php echo $order['destination_receiver'] . ' - ' . $order['destination_phone']; ?></td>
                                    <td>
                                        <?php foreach ($order['products'] as $product) : ?>
                                            <?php echo $product['product_name'] . '(' . $product['qty'] . 'x)'; ?>
                                        <?php endforeach; ?>
                                    </td>
                                    <td><?php echo $order['destination_city_name'] . ', ' . $order['destination_street']; ?></td>
                                    <td><?php echo $order['shipping_status_detail']; ?></td>
                                    <td>
                                        <?php if ($order['order_status'] == 1) : ?>
                                            <!-- Button trigger modal -->
                                            <a href="" data-toggle="modal" data-target="#adminOrderDetailModal<?php echo $i; ?>"><span class="badge badge-info">Detail</span></a>
                                            <form action="<?php echo site_url(); ?>admin_order/cancel_order" method="post">
                                                <button type="submit" class="badge badge-danger" onclick="return confirm('Are you sure want to cancel this order?')">Cancel</button>
                                                <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                            </form>

                                        <?php elseif ($order['order_status'] == 2) : ?>
                                            <!-- Button trigger modal -->
                                            <a href="" data-toggle="modal" data-target="#adminOrderDetailModal<?php echo $i; ?>"><span class="badge badge-info">Detail</span></a>
                                            <a href="" data-toggle="modal" data-target="#adminUploadResiModal<?php echo $i; ?>">
                                                <span class="badge badge-secondary">Upload Resi</span>
                                            </a>

                                        <?php elseif ($order['order_status'] == 3) : ?>
                                            <!-- Button trigger modal -->
                                            <a href="" data-toggle="modal" data-target="#adminOrderDetailModal<?php echo $i; ?>"><span class="badge badge-info">Detail</span></a>
                                            <a href="" data-toggle="modal" data-target="#adminUploadResiModal<?php echo $i; ?>">
                                                <span class="badge badge-secondary">See Resi</span>
                                            </a>
                                            <a href="<?php echo site_url(); ?>admin_order/order_finished/<?php echo $order['shipping_id']; ?>" onclick="return confirm('Are you sure want to finish this order?')">
                                                <span class="badge badge-dark">Order Finished</span>
                                            </a>

                                        <?php elseif ($order['order_status'] == 4) : ?>
                                            <!-- Button trigger modal -->
                                            <a href="" data-toggle="modal" data-target="#adminOrderDetailModal<?php echo $i; ?>"><span class="badge badge-info">Detail</span>
                                            </a>
                                            <a href="" data-toggle="modal" data-target="#adminUploadResiModal<?php echo $i; ?>">
                                                <span class="badge badge-secondary">See Resi</span>
                                            </a>

                                        <?php elseif ($order['order_status'] == 0) : ?>
                                            <!-- Button trigger modal -->
                                            <a href="" data-toggle="modal" data-target="#adminOrderDetailModal<?php echo $i; ?>"><span class="badge badge-info">Detail</span></a>
                                        <?php endif; ?>

                                    </td>
                                </tr>

                                <!-- Detail Modal -->
                                <div class="modal fade" id="adminOrderDetailModal<?php echo $i;  ?>" tabindex="-1" role="dialog" aria-labelledby="adminOrderDetailModal<?php echo $i;  ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="adminOrderDetailModal<?php echo $i;  ?>Label">Detail Order</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex">
                                                    <p class="ml-auto mb-0">
                                                        order_status :
                                                        <?php if ($order['order_status'] == 0) : ?>
                                                            <span class="badge badge-pill badge-danger p-2"><?php echo $order['shipping_status_detail']; ?></span>
                                                        <?php elseif ($order['order_status'] == 1) : ?>
                                                            <span class="badge badge-pill badge-warning p-2"><?php echo $order['shipping_status_detail']; ?></span>
                                                        <?php elseif ($order['order_status'] == 2) : ?>
                                                            <span class="badge badge-pill badge-info p-2"><?php echo $order['shipping_status_detail']; ?></span>
                                                        <?php elseif ($order['order_status'] == 3) : ?>
                                                            <span class="badge badge-pill badge-success p-2"><?php echo $order['shipping_status_detail']; ?></span>
                                                        <?php elseif ($order['order_status'] == 4) : ?>
                                                            <span class="badge badge-pill badge-success p-2"><?php echo $order['shipping_status_detail']; ?></span>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3">
                                                        <p class="card-text">Order Number</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="card-text">: <?php echo $order['order_number'] ?> </p>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3">
                                                        <p class="card-text">Receiver</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="card-text">: <?php echo $order['destination_receiver'] ?> </p>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3">
                                                        <p class="card-text">Phone Number</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="card-text">: <?php echo $order['destination_phone'] ?> </p>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3">
                                                        <p class="card-text">Address</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="card-text">: <?php echo $order['destination_street'] . ', ' . $order['destination_city_name'] . " " . $order['destination_zipcode']; ?> </p>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3">
                                                        <p class="card-text">Courier</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="card-text">: <?php echo $order['courier_name'] ?> </p>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3">
                                                        <p class="card-text">Total Weight</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <p class="card-text">: <?php echo $order['total_weight'] ?> gram</p>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3">
                                                        <p class="card-text">Products</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php foreach ($order['products'] as $product) : ?>
                                                            <p class="card-text">: <?php echo $product['product_name'] . ' (' . $product['qty'] . 'x)'; ?> </p>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Upload Resi Modal -->
                                <div class="modal fade" id="adminUploadResiModal<?php echo $i;  ?>" tabindex="-1" role="dialog" aria-labelledby="adminUploadResiModal<?php echo $i;  ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="adminUploadResiModal<?php echo $i;  ?>Label">Upload Resi</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?php echo site_url(); ?>admin_order/upload_resi" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="">
                                                            <img src="<?php echo ($order['shipping_receipt_picture'] == null) ? '' : base_url() . 'assets/img/resi/' . $order['shipping_receipt_picture']; ?>" class="img-fluid" style="border-radius: unset;">
                                                        </div>
                                                        <div class="mt-4">
                                                            <button type="button" class="btn btn-primary btn-block">
                                                                <input type="file" name="image" id="image">
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="shipping_receipt">Resi Number*</label>
                                                        <input type="text" class="form-control <?php echo (form_error('shipping_receipt')) ? 'is-invalid' : ''; ?>" id="shipping_receipt" name="shipping_receipt" value="<?php echo $order['shipping_receipt'] ?>" autocomplete="off">
                                                        <div class="invalid-feedback">
                                                            <?php echo form_error('shipping_receipt', '<div class="pl-2">', '</div>'); ?>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="shipping_id" value="<?php echo $order['shipping_id']; ?>">
                                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="card-body text-center">
                Tidak ada transaksi order di sistem
            </div>
        <?php endif; ?>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->