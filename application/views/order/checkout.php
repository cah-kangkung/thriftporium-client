<main>
    <section id="checkout-section" class="top-section">
        <div class="container">
            <h4 class="mb-4">Checkout</h4>
            <div class="row">
                <div class="col-sm-8">
                    <form action="">
                        <h5>Shipping Address</h5>
                        <hr>
                        <div>
                            <button id="profileAddressButton" type="button" class="btn btn-light mr-2">Use Profile Address</button>
                            <button id="manualAddressButton" type="button" class="btn btn-light">Manual Input</button>
                        </div>

                        <div id="addressContainer">
                        </div>
                        <hr>
                    </form>
                </div>
                <div class="col-sm-4">col-4</div>
            </div>
        </div>
    </section>
</main>

<script src="<?php echo base_url(); ?>assets/js/components/Autocomplete.js"></script>
<script>
    const chooseAddress = function() {
        const addressContainer = document.getElementById('addressContainer');

        document.getElementById('profileAddressButton').addEventListener('click', function() {
            addressContainer.innerHTML = '';
            let address =
                `<div id="myAddress" class="my-address mt-3">
                    <p class="fw-400"><?php echo $user['user_firstname'] . ' ' . $user['user_lastname']; ?></p>
                    <p><?php echo $user['user_phone']; ?></p>
                    <p><?php echo $user['user_address']; ?></p>
                    <p><?php echo $user['user_city'] . ', ' . $user['user_province'] . ', ' . $user['user_zipcode']; ?></p>

                    <input type="hidden" value="<?php echo $user['user_address']; ?>">
                    <input type="hidden" value="<?php echo $user['city_id']; ?>">
                    <input type="hidden" value="<?php echo $user['user_zipcode']; ?>">
                    <input type="hidden" value="<?php echo $user['user_firstname'] . ' ' . $user['user_lastname']; ?>">
                    <input type="hidden" value="<?php echo $user['user_phone']; ?>">
                </div>`;
            addressContainer.innerHTML = address;
        });

        document.getElementById('manualAddressButton').addEventListener('click', function() {
            addressContainer.innerHTML = '';
            let address =
                `<div id="manualAddress" class="mt-3">
                    <div class="form-group row">
                        <label for="shipping_receiver" class="col-sm-3 col-form-label">Receiver's Name*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?php echo (form_error('shipping_receiver')) ? 'is-invalid' : ''; ?>" name="shipping_receiver" id="shipping_receiver" value="<?php echo set_value('shipping_receiver'); ?>">
                            <div class="invalid-feedback">
                                <?php echo form_error('shipping_receiver', '<div class="pl-2">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shipping_phone" class="col-sm-3 col-form-label">Receiver's Phone*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?php echo (form_error('shipping_phone')) ? 'is-invalid' : ''; ?>" name="shipping_phone" id="shipping_phone" value="<?php echo set_value('shipping_phone'); ?>">
                            <div class="invalid-feedback">
                                <?php echo form_error('shipping_phone', '<div class="pl-2">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class="col-sm-3 col-form-label">City*</label>
                        <div class="col-sm-9 autocomplete">
                            <input type="text" class="form-control <?php echo (form_error('city')) ? 'is-invalid' : ''; ?>" name="city" id="city" value="<?php echo set_value('city'); ?>">
                            <div class="invalid-feedback">
                                <?php echo form_error('city', '<div class="pl-2">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="street" class="col-sm-3 col-form-label">Street*</label>
                        <div class="col-sm-9">
                            <textarea class="form-control <?php echo (form_error('street')) ? 'is-invalid' : ''; ?>" name="street" id="street" rows="2"><?php echo set_value('street'); ?></textarea>
                            <div class="invalid-feedback">
                                <?php echo form_error('street', '<div class="pl-2">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zipcode" class="col-sm-3 col-form-label">Zipcode*</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?php echo (form_error('zipcode')) ? 'is-invalid' : ''; ?>" name="zipcode" id="zipcode" value="<?php echo set_value('zipcode'); ?>">
                            <div class="invalid-feedback">
                                <?php echo form_error('zipcode', '<div class="pl-2">', '</div>'); ?>
                            </div>
                        </div>
                    </div>
                </div>`;
            addressContainer.innerHTML = address;
            autocomplete(document.getElementById('city'), <?php echo json_encode($cities); ?>);
        });
    };
    chooseAddress();
</script>