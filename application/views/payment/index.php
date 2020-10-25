<main>
    <section class="top-section">
        <div class=" container">
            <h2 class="mb-4">
                Payment
            </h2>

            <!-- <ul class="nav nav-pills mb-5">
                <li class="nav-item">
                    <a class="nav-link active rounded-pill" href="">Waiting Payment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Proof Uploaded</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Verified</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Canceled</a>
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

            <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?php if (!$payment_list) : ?>
                <h4>There are no bills right now . Start shopping now!</h4>
            <?php else : ?>
                <?php $i = 0; ?>
                <?php foreach ($payment_list as $payment) : ?>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="d-flex">
                                <h5 class="card-title"><?php echo $payment['inv_number']; ?></h5>
                                <p class="ml-auto mb-0">
                                    Status :
                                    <?php if ($payment['payment_status'] == 0) : ?>
                                        <span class="badge badge-pill badge-danger p-2">Canceled</span>
                                    <?php elseif ($payment['payment_status'] == 1) : ?>
                                        <span class="badge badge-pill badge-warning p-2">Waiting Payment</span>
                                    <?php elseif ($payment['payment_status'] == 2) : ?>
                                        <span class="badge badge-pill badge-info p-2">Payment Proof Uploaded</span>
                                    <?php elseif ($payment['payment_status'] == 3) : ?>
                                        <span class="badge badge-pill badge-success p-2">Payment Verified</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <p class="card-text d-inline">
                                Total: <p style="color: green; display: inline; font-weight: 500;">Rp <?php echo $payment['total_price'] / 1000 ?>,000</p> | Tanggal Pesan: <?php echo $payment['payment_created'] ?>
                            </p>
                            <?php if ($payment['payment_status'] == 1) : ?>
                                <div class="alert alert-warning" role="alert">
                                    Pay Before <?php echo $payment['payment_expired'] ?>
                                </div>
                            <?php elseif ($payment['payment_status'] == 3) : ?>
                                <div class="alert alert-success" role="alert">
                                    Payment Verified!
                                </div>
                            <?php elseif ($payment['payment_status'] == 0) : ?>
                                <div class="alert alert-danger" role="alert">
                                    Payment Canceled!
                                </div>
                            <?php endif; ?>

                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Payment Method</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $payment['payment_accounttype']; ?></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Sender's Account</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $payment['user_accountbank']; ?> | <?php echo $payment['user_accountnumber'] ?> a.n <strong><?php echo $payment['user_accountname']; ?></strong></p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <p class="card-text">Transfer To</p>
                                </div>
                                <div class="col-md-10">
                                    <p class="card-text">: <?php echo $payment['payment_bank_name']; ?> | <?php echo $payment['payment_account_number'] ?> a.n <strong><?php echo $payment['payment_account_name']; ?></strong></p>
                                </div>
                            </div>
                            <br>

                            <?php if ($payment['payment_status'] == 1) : ?>
                                <small>
                                    <a href="#" class="mr-3" data-toggle="modal" data-target="#paymentModal<?php echo $i; ?>">
                                        Change Bank Information
                                    </a>
                                    <a href="#" class="mr-3" data-toggle="modal" data-target="#transfertoModal<?php echo $i; ?>">
                                        Change Payment Destination
                                    </a>
                                    <a href="#" class="mr-3" data-toggle="modal" data-target="#uploadModal<?php echo $i; ?>">
                                        Upload Proof of Payment
                                    </a>
                                    <a href="<?php echo site_url(); ?>payments/invoice/<?php echo $payment['id']; ?>" target="_blank" class="mr-2"> Print Invoice </a>
                                    <a href="<?php echo site_url(); ?>payment/canceled/<?php echo $payment['id'] ?>" class="mr-2" onclick="return confirm('Are you sure want to cancel your payment?')"> Cancel Payment</a>
                                </small>
                            <?php elseif ($payment['payment_status'] == 2) : ?>
                                <small>
                                    <a href="#" class="mr-3" data-toggle="modal" data-target="#paymentModal<?php echo $i; ?>">
                                        Change Bank Information
                                    </a>
                                    <a href="#" class="mr-3" data-toggle="modal" data-target="#uploadModal<?php echo $i; ?>">
                                        Edit Payment Proof
                                    </a>
                                    <a href="<?php echo site_url(); ?>payments/invoice/<?php echo $payment['id']; ?>" target="_blank" class="mr-2"> Print Invoice </a>
                                </small>
                            <?php elseif ($payment['payment_status'] == 3) : ?>
                                <small>
                                    <a href="" class="mr-2"> See Your Order</a>
                                    <a href="<?php echo site_url(); ?>payments/invoice/<?php echo $payment['id']; ?>" target="_blank" class="mr-2"> Print Invoice </a>
                                </small>
                            <?php endif; ?>

                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="paymentModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="paymentModal<?php echo $i; ?>Label" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="top: 150px;">
                            <form method="post" action="<?php echo site_url(); ?>payment/change_bank_info">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModal<?php echo $i; ?>Label">Change Bank Information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="account_bank">Bank Name*</label>
                                            <input type="text" class="form-control <?php echo (form_error('account_bank')) ? 'is-invalid' : ''; ?>" id="account_bank" name="account_bank" value="<?php echo $payment['user_accountbank'] ?>" autocomplete="off">
                                            <div class="invalid-feedback">
                                                <?php echo form_error('account_bank', '<div class="pl-2">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="account_number">Account Number*</label>
                                            <input type="text" class="form-control <?php echo (form_error('account_number')) ? 'is-invalid' : ''; ?>" id="account_number" name="account_number" value="<?php echo $payment['user_accountnumber'] ?>" autocomplete="off">
                                            <div class="invalid-feedback">
                                                <?php echo form_error('account_number', '<div class="pl-2">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="account_name">Account Name*</label>
                                            <input type="text" class="form-control <?php echo (form_error('account_name')) ? 'is-invalid' : ''; ?>" id="account_name" name="account_name" value="<?php echo $payment['user_accountname'] ?>" autocomplete="off">
                                            <div class="invalid-feedback">
                                                <?php echo form_error('account_name', '<div class="pl-2">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <input type="hidden" name="payment_id" value="<?php echo $payment['id'] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="transfertoModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="transfertoModal<?php echo $i; ?>Label" aria-hidden="true">
                        <div class="modal-dialog" role="document" style="top: 150px;">
                            <form method="post" action="<?php echo site_url(); ?>payment/change_transferto">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transfertoModal<?php echo $i; ?>Label">Changed Payment Method</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <select class="custom-select" id="transfer_to" name="transfer_to">
                                                <?php foreach ($payment_method as $method) : ?>
                                                    <option value="<?php echo $method['id'] ?>"><?php echo $method['pa_name']; ?> - <?php echo $method['pa_type'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="payment_id" value="<?php echo $payment['id'] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="uploadModal<?php echo $i; ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document" style="top: 150px;">
                            <form method="post" action="<?php echo site_url(); ?>payment/upload_proof" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModal<?php echo $i; ?>Label">Upload Proof of Payment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="">
                                                <img src="<?php echo ($payment['payment_receipt'] == null) ? '' : base_url() . 'assets/img/payment-receipt/' . $payment['payment_receipt']; ?>" class="img-fluid" style="border-radius: unset;">
                                            </div>
                                            <div class="">
                                                <button type="button" class="btn btn-primary btn-block">
                                                    <input type="file" name="image" id="image">
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="payment_id" value="<?php echo $payment['id'] ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Upload</button>
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