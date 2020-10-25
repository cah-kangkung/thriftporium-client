<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Order</h1>
        <!-- <a href="<?php echo site_url(); ?>admin_test/add_question" class="btn btn-primary shadow-sm"></a> -->
    </div>
    <?php var_dump($order_list); ?>

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
                    <a class="nav-link <?php echo ($this->input->get('filter') == '' ? 'active' : '') ?>" href="<?php echo site_url(); ?>admin_payment">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->input->get('filter') == '1' ? 'active' : '') ?>" href="<?php echo site_url(); ?>admin_payment?filter=1">Menunggu Pembayaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->input->get('filter') == '3' ? 'active' : '') ?>" href="<?php echo site_url(); ?>admin_payment?filter=3">Pembayaran Terkonfirmasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->input->get('filter') == '4' ? 'active' : '') ?>" href="<?php echo site_url(); ?>admin_payment?filter=4">Selesai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->input->get('filter') == '0' ? 'active' : '') ?>" href="<?php echo site_url(); ?>admin_payment?filter=0">Pembayaran Dibatalkan</a>
                </li>
            </ul>
        </div>
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
                                <td><?php echo $order['destination_receiver'] . ' - ' . $order['destination_receiver']; ?></td>
                                <td>
                                    <?php foreach ($order['products'] as $product) : ?>
                                        <?php echo $product['product_name'] . '(' . $product['qty'] . 'x)'; ?>
                                    <?php endforeach; ?>
                                </td>
                                <td><?php echo $order['destination_city_name'] . ', ' . $order['destination_street']; ?></td>
                                <td><?php echo $order['shipping_status_detail']; ?></td>
                                <td>
                                    <?php if ($order['status'] == 1) : ?>
                                        <span class="badge badge-warning"><i class="fas fa-spinner"></i></span>
                                    <?php elseif ($order['status'] == 3) : ?>
                                        <span class="badge badge-success"><i class="fas fa-dollar-sign"></i></span>
                                    <?php elseif ($order['status'] == 4) : ?>
                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                    <?php elseif ($order['status'] == 0) : ?>
                                        <span class="badge badge-danger">X</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($order['status'] == 1) : ?>

                                        <!-- Button trigger modal -->
                                        <a href="" data-toggle="modal" data-target="#adminPaymentModal<?php echo $i; ?>"><span class="badge badge-info">Detil</span></a>

                                        <a href="<?php echo site_url(); ?>admin_payment/cancel_payment?payment_id=<?php echo $order['payment_id'] ?>&user_id=<?php echo $order['user_id'] ?>">
                                            <span class="badge badge-danger" onclick="return confirm('Yakin ingin membatalkan pembayaran?')">Batalkan</span>
                                        </a>
                                        <a href="<?php echo site_url(); ?>admin_payment/confirm_payment?payment_id=<?php echo $order['payment_id'] ?>&user_id=<?php echo $order['user_id'] ?>">
                                            <span class="badge badge-success" onclick="return confirm('Yakin ingin menkonfirmasi?')">Konfirmasi</span>
                                        </a>
                                    <?php elseif ($order['status'] == 3) : ?>

                                        <!-- Button trigger modal -->
                                        <a href="" data-toggle="modal" data-target="#adminPaymentModal<?php echo $i; ?>"><span class="badge badge-info">Detil</span></a>

                                        <a href="<?php echo site_url(); ?>admin_payment/cancel_payment?payment_id=<?php echo $order['payment_id'] ?>&user_id=<?php echo $order['user_id'] ?>">
                                            <span class="badge badge-danger" onclick="return confirm('Yakin ingin membatalkan pembayaran?')">Batalkan</span>
                                        </a>
                                        <a href="<?php echo site_url(); ?>admin_payment/revert_to_waiting?payment_id=<?php echo $order['payment_id'] ?>&user_id=<?php echo $order['user_id'] ?>">
                                            <span class="badge badge-warning" onclick="return confirm('Yakin ingin kembali menunggu pembayaran?')">Tunggu</span>
                                        </a>
                                    <?php elseif ($order['status'] == 4) : ?>

                                        <!-- Button trigger modal -->
                                        <a href="" data-toggle="modal" data-target="#adminPaymentModal<?php echo $i; ?>"><span class="badge badge-info">Detil</span>
                                        </a>
                                    <?php elseif ($order['status'] == 0) : ?>

                                        <!-- Button trigger modal -->
                                        <a href="" data-toggle="modal" data-target="#adminPaymentModal<?php echo $i; ?>"><span class="badge badge-info">Detil</span></a>

                                        <a href="<?php echo site_url(); ?>admin_payment/revert_to_waiting?payment_id=<?php echo $order['payment_id'] ?>&user_id=<?php echo $order['user_id'] ?>">
                                            <span class="badge badge-warning" onclick="return confirm('Yakin ingin kembali menunggu pembayaran?')">Tunggu</span>
                                        </a>
                                        <a href="<?php echo site_url(); ?>admin_payment/confirm_payment?payment_id=<?php echo $order['payment_id'] ?>&user_id=<?php echo $order['user_id'] ?>">
                                            <span class="badge badge-success" onclick="return confirm('Yakin ingin menkonfirmasi?')">Konfirmasi</span>
                                        </a>
                                    <?php endif; ?>

                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="adminPaymentModal<?php echo $i;  ?>" tabindex="-1" role="dialog" aria-labelledby="adminPaymentModal<?php echo $i;  ?>Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="adminPaymentModal<?php echo $i;  ?>Label">Modal title <?php echo $order['payment_id']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex">
                                                <h5 class="card-title">Test DISC</h5>
                                                <p class="ml-auto mb-0">
                                                    Status :
                                                    <?php if ($order['status'] == 0) : ?>
                                                        <span class="badge badge-pill badge-danger p-2">Batal</span>
                                                    <?php elseif ($order['status'] == 1) : ?>
                                                        <span class="badge badge-pill badge-warning p-2">Menunggu Pembayaran</span>
                                                    <?php elseif ($order['status'] == 2) : ?>
                                                        <span class="badge badge-pill badge-info p-2">Bukti Diunggah</span>
                                                    <?php elseif ($order['status'] == 3) : ?>
                                                        <span class="badge badge-pill badge-success p-2">Pembayaran Terkonfirmasi</span>
                                                    <?php elseif ($order['status'] == 4) : ?>
                                                        <span class="badge badge-pill badge-success p-2">Selesai</span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                            <p class="card-text d-inline">
                                                Total: <p style="color: green; display: inline; font-weight: 500;">Rp <?php echo $order['total_amount'] / 1000 ?>,000</p> | Tanggal Pesan: <?php echo $order['date_created'] ?>
                                            </p>
                                            <?php if ($order['status'] == 1) : ?>
                                                <div class="alert alert-warning" role="alert">
                                                    Bayar Sebelum <?php echo $order['date_expired'] ?>
                                                </div>
                                            <?php elseif ($order['status'] == 3) : ?>
                                                <div class="alert alert-success" role="alert">
                                                    Pembayaran telah dikonfirmasi!
                                                </div>
                                            <?php elseif ($order['status'] == 4) : ?>
                                                <div class="alert alert-success" role="alert">
                                                    Transaksi telah selesai
                                                </div>
                                            <?php elseif ($order['status'] == 0) : ?>
                                                <div class="alert alert-danger" role="alert">
                                                    Pembayaran dibatalkan!
                                                </div>
                                            <?php endif; ?>

                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <p class="card-text">Metode</p>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="card-text">: Transfer Bank <?php echo $order['bank'] ?> ke <?php echo $order['destination_bank'] ?> </p>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <p class="card-text">Rekening Pengirim</p>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="card-text">: <?php echo $order['bank_account_number'] ?> a.n <strong><?php echo $order['bank_account_name']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <p class="card-text">Destinasi</p>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="card-text">: <?php echo $order['destination_acc_number'] ?> a.n <strong><?php echo $order['destination_acc_name'] ?></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->