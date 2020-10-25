<main>
    <section>
        <div class=" container">
            <h2 class="mb-3">
                Order
            </h2>

            <ul class="nav nav-pills mb-5">
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
            </ul>

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
                                    Transaksi Selesai
                                </div>
                            <?php elseif ($order['status'] == 0) : ?>
                                <div class="alert alert-danger" role="alert">
                                    Pembayaran dibatalkan!
                                </div>
                            <?php endif; ?>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Metode</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: Transfer Bank <?php echo $order['bank'] ?> ke <?php echo $order['destination_bank'] ?> </p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Rekening Pengirim</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $order['bank_account_number'] ?> a.n <strong><?php echo $order['bank_account_name']; ?></strong></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Destinasi</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $order['destination_acc_number'] ?> a.n <strong><?php echo $order['destination_acc_name'] ?></strong></p>
                                </div>
                            </div>
                            <br>

                            <?php if ($order['status'] == 1) : ?>
                                <small>
                                    <a href="#" class="mr-3" data-toggle="modal" data-target="#paymentModal<?php echo $i; ?>">
                                        Ubah Informasi Bank
                                    </a>
                                    <a href="<?php echo site_url(); ?>payment/cancel_payment?payment_id=<?php echo $order['payment_id'] ?>&user_id=<?php echo $user_data['user_id'] ?>" class="mr-2" onclick="return confirm('Yakin ingin membatalkan?')"> Batalkan Pesanan</a>
                                </small>
                            <?php elseif ($order['status'] == 3) : ?>
                                <small>
                                    <a href="<?php echo site_url(); ?>pricing" class="mr-2"> Ikuti Test</a>
                                </small>
                            <?php elseif ($order['status'] == 0 || $order['status'] == 4) : ?>
                                <small>
                                    <a href="<?php echo site_url(); ?>pricing" class="mr-2"> Ke Halaman Test</a>
                                </small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="paymentModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="paymentModal<?php echo $i; ?>Label" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="top: 150px;">
                            <form method="post" action="<?php echo site_url(); ?>payment/update_sender_account">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModal<?php echo $i; ?>Label">Ubah Informasi Bank</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="bank">Nama Bank</label>
                                            <input type="text" class="form-control" id="bank" name="bank" value="<?php echo $order['bank'] ?>" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_account_number">Nomor Rekening</label>
                                            <input type="text" class="form-control" id="bank_account_number" name="bank_account_number" value="<?php echo $order['bank_account_number'] ?>" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="bank_account_name">Nama Pengirim</label>
                                            <input type="text" class="form-control" id="bank_account_name" name="bank_account_name" value="<?php echo $order['bank_account_name'] ?>" autocomplete="off">
                                        </div>
                                        <input type="hidden" name="payment_id" value="<?php echo $order['payment_id'] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
                    $i++;
                endforeach;
                ?>
            <?php endif; ?>
            <?php $i = 1; ?>
        </div>
    </section>
</main>