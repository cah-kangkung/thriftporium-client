<main>
    <section>
        <div class=" container">
            <h2 class="mb-3">
                Order
            </h2>

            <!-- <ul class="nav nav-pills mb-5">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->input->get('filter') == '' ? 'active rounded-pill' : ''); ?>" href="<?php echo site_url(); ?>payment/order_list?filter=">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->input->get('filter') == '1' ? 'active rounded-pill' : ''); ?>" href="<?php echo site_url(); ?>payment/order_list?filter=1">Processed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->input->get('filter') == '3' ? 'active rounded-pill' : ''); ?>" href="<?php echo site_url(); ?>payment/order_list?filter=3">Sent</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->input->get('filter') == '0' ? 'active rounded-pill' : ''); ?>" href="<?php echo site_url(); ?>payment/order_list?filter=0">Canceled</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->input->get('filter') == '4' ? 'active rounded-pill' : ''); ?>" href="<?php echo site_url(); ?>payment/order_list?filter=4">Done</a>
                </li>
            </ul> -->

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

            <?php if (!$orders) : ?>
                <h4>Your Order is empty. Start shopping now!</h4>
            <?php else : ?>
                <?php foreach ($orders as $order) : ?>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="card-title">Order</h5>
                                <p class="ml-auto mb-0">
                                    Status :
                                    <?php if ($order['order_status'] == 0) : ?>
                                        <span class="badge badge-pill badge-danger p-2">Batal</span>
                                    <?php elseif ($order['order_status'] == 1) : ?>
                                        <span class="badge badge-pill badge-warning p-2">Menunggu Pembayaran</span>
                                    <?php elseif ($order['order_status'] == 2) : ?>
                                        <span class="badge badge-pill badge-info p-2">Bukti Diunggah</span>
                                    <?php elseif ($order['order_status'] == 3) : ?>
                                        <span class="badge badge-pill badge-success p-2">Pembayaran Terkonfirmasi</span>
                                    <?php elseif ($order['order_status'] == 4) : ?>
                                        <span class="badge badge-pill badge-success p-2">Selesai</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <p class="card-text d-inline">
                                Total: <p style="color: green; display: inline; font-weight: 500;">Rp <?php echo $order['total_price'] / 1000 ?>,000</p> | Tanggal Pesan: <?php echo $order['order_created'] ?>
                            </p>
                            <?php if ($order['order_status'] == 1) : ?>
                                <div class="alert alert-warning" role="alert">
                                    Bayar Sebelum <?php echo $order['order_expired'] ?>
                                </div>
                            <?php elseif ($order['order_status'] == 3) : ?>
                                <div class="alert alert-success" role="alert">
                                    Pembayaran telah dikonfirmasi!
                                </div>
                            <?php elseif ($order['order_status'] == 4) : ?>
                                <div class="alert alert-success" role="alert">
                                    Transaksi Selesai
                                </div>
                            <?php elseif ($order['order_status'] == 0) : ?>
                                <div class="alert alert-danger" role="alert">
                                    Pembayaran dibatalkan!
                                </div>
                            <?php endif; ?>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Receiver</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $order['destination_receiver'] ?> </p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Phone</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $order['destination_phone'] ?></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Destination Address</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $order['destination_street'] . ', ' . $order['destination_city_name'] . ' ' . $order['destination_zipcode'] ?></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Products</p>
                                </div>
                                <div class="col-md-10">
                                    <?php foreach ($order['products'] as $product) : ?>
                                        <p class="card-text">: <?php echo $product['product_name'] . ' (' . $product['qty'] . ' x)'; ?></p>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Total Products</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $order['total_qty'] ?></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Courier</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $order['courier_name'] ?></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Total Weight</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $order['total_weight'] ?> gram</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Resi Number</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo ($order['shipping_receipt']) ?  $order['shipping_receipt'] : 'Nomor resi belum di masukkan'; ?></p>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>