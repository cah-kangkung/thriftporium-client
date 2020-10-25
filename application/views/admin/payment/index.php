<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 mr-4">Payment</h1>
        <!-- <a href="<?php echo site_url(); ?>admin_test/add_question" class="btn btn-primary shadow-sm"></a> -->
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
                <!-- <li class="nav-item">
                    <a class="nav-link" href="">Waiting Payment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Receipt Uploaded</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Payment Verified</a>
                </li> -->
            </ul>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Bank Account</th>
                            <th>Bank Name</th>
                            <th>Bank Number</th>
                            <th>Transfer To</th>
                            <th>Total</th>
                            <th>Expire</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($payment_list as $payment) : ?>
                            <tr>
                                <td><?php echo $payment['inv_number']; ?></td>
                                <td><?php echo $payment['user_accountbank']; ?></td>
                                <td><?php echo $payment['user_accountname']; ?></td>
                                <td><?php echo $payment['user_accountnumber']; ?></td>
                                <td><?php echo $payment['payment_bank_name'] . ' - ' . $payment['payment_account_name'] . ' - ' . $payment['payment_account_number']; ?></td>
                                <td><?php echo $payment['total_price']; ?></td>
                                <td><?php echo $payment['payment_expired']; ?></td>
                                <td><?php echo $payment['status_details']; ?></td>

                                <td>
                                    <?php if ($payment['payment_status'] == 1 || $payment['payment_status'] == 2) : ?>
                                        <!-- Button trigger modal -->
                                        <a href="" data-toggle="modal" data-target="#adminPaymentModal<?php echo $i; ?>"><span class="badge badge-info">Detail</span></a>
                                        <form action="<?php echo site_url(); ?>admin_payment/reject_receipt" method="post">
                                            <button type="submit" class="badge badge-warning" onclick="return confirm('Are you sure want to reject this receipt?')">
                                                Reject
                                            </button>
                                            <input type="hidden" name="payment_id" value="<?php echo $payment['id']; ?>">
                                        </form>
                                        <form action="<?php echo site_url(); ?>admin_payment/cancel_payment" method="post">
                                            <button type="submit" class="badge badge-danger" onclick="return confirm('Are you sure want to cancel this payment?')">
                                                Cancel
                                            </button>
                                            <input type="hidden" name="payment_id" value="<?php echo $payment['id']; ?>">
                                        </form>
                                        <form action="<?php echo site_url(); ?>admin_payment/verify_payment" method="post">
                                            <button type="submit" class="badge badge-success" onclick="return confirm('Are you sure want to verify this payment?')">
                                                Verify
                                            </button>
                                            <input type="hidden" name="payment_id" value="<?php echo $payment['id']; ?>">
                                        </form>
                                    <?php elseif ($payment['payment_status'] == 3) : ?>
                                        <!-- Button trigger modal -->
                                        <a href="" data-toggle="modal" data-target="#adminPaymentModal<?php echo $i; ?>"><span class="badge badge-info">Detail</span></a>
                                    <?php elseif ($payment['payment_status'] == 0) : ?>

                                        <!-- Button trigger modal -->
                                        <a href="" data-toggle="modal" data-target="#adminPaymentModal<?php echo $i; ?>"><span class="badge badge-info">Detail</span></a>
                                    <?php endif; ?>

                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="adminPaymentModal<?php echo $i;  ?>" tabindex="-1" role="dialog" aria-labelledby="adminPaymentModal<?php echo $i;  ?>Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="adminPaymentModal<?php echo $i;  ?>Label">Modal title <?php echo $payment['id']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex">
                                                <h5 class="card-title">Test DISC</h5>
                                                <p class="ml-auto mb-0">
                                                    payment_status :
                                                    <?php if ($payment['payment_status'] == 0) : ?>
                                                        <span class="badge badge-pill badge-danger p-2">Batal</span>
                                                    <?php elseif ($payment['payment_status'] == 1) : ?>
                                                        <span class="badge badge-pill badge-warning p-2">Menunggu Pembayaran</span>
                                                    <?php elseif ($payment['payment_status'] == 2) : ?>
                                                        <span class="badge badge-pill badge-info p-2">Bukti Diunggah</span>
                                                    <?php elseif ($payment['payment_status'] == 3) : ?>
                                                        <span class="badge badge-pill badge-success p-2">Pembayaran Terkonfirmasi</span>
                                                    <?php elseif ($payment['payment_status'] == 4) : ?>
                                                        <span class="badge badge-pill badge-success p-2">Selesai</span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                            <p class="card-text d-inline">
                                                Total: <p style="color: green; display: inline; font-weight: 500;">Rp <?php echo $payment['total_price'] / 1000 ?>,000</p> | Tanggal Pesan: <?php echo $payment['payment_created'] ?>
                                            </p>
                                            <?php if ($payment['payment_status'] == 1) : ?>
                                                <div class="alert alert-warning" role="alert">
                                                    Bayar Sebelum <?php echo $payment['payment_expired'] ?>
                                                </div>
                                            <?php elseif ($payment['payment_status'] == 3) : ?>
                                                <div class="alert alert-success" role="alert">
                                                    Pembayaran telah dikonfirmasi!
                                                </div>
                                            <?php elseif ($payment['payment_status'] == 4) : ?>
                                                <div class="alert alert-success" role="alert">
                                                    Transaksi telah selesai
                                                </div>
                                            <?php elseif ($payment['payment_status'] == 0) : ?>
                                                <div class="alert alert-danger" role="alert">
                                                    Pembayaran dibatalkan!
                                                </div>
                                            <?php endif; ?>

                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <p class="card-text">Metode</p>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="card-text">: Transfer <?php echo $payment['user_accountbank'] ?> ke <?php echo $payment['payment_bank_name'] ?> </p>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <p class="card-text">Rekening Pengirim</p>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="card-text">: <?php echo $payment['user_accountnumber'] ?> a.n <strong><?php echo $payment['user_accountname']; ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <p class="card-text">Destinasi</p>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="card-text">: <?php echo $payment['payment_account_number'] ?> a.n <strong><?php echo $payment['payment_account_name'] ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <p class="card-text">Bukti Bayar</p>
                                                </div>
                                                <div class="col-md-9">
                                                    <p class="card-text">:</p>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <?php if ($payment['payment_receipt']) { ?>
                                                        <img src="<?php echo base_url(); ?>assets/img/payment-receipt/<?php echo $payment['payment_receipt']; ?>" alt="" style="height: 100%; width: 200%; object-fit: contain;">
                                                    <?php } else { ?> <p class="card-text">Bukti bayar belum di upload</p>
                                                    <?php } ?>
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