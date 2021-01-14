<main>
    <section id="checkout-section" class="top-section">
        <div class="container">
            <h4 class="mb-4">Checkout</h4>
            <form action="<?php echo site_url(); ?>order/checkout" method="post">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="shipping-address mb-5">
                            <h5 class="">Shipping Address</h5>
                            <hr>
                            <div>
                                <button id="profileAddressButton" type="button" class="btn btn-light mr-2">Use Profile Address</button>
                                <button id="manualAddressButton" type="button" class="btn btn-light">Manual Input</button>
                            </div>

                            <div id="addressContainer">
                                <div id="myAddress" class="my-address mt-4">
                                    <p class="fw-400"><?php echo $user['user_firstname'] . ' ' . $user['user_lastname']; ?></p>
                                    <p><?php echo $user['user_phone']; ?></p>
                                    <p><?php echo $user['user_address']; ?></p>
                                    <p><?php echo $user['user_city'] . ', ' . $user['user_province'] . ', ' . $user['user_zipcode']; ?></p>

                                    <input type="hidden" name="street" value="<?php echo $user['user_address']; ?>">
                                    <input type="hidden" id="city" name="city" value="<?php echo $user['user_province'] . ', ' . $user['user_city']; ?>">
                                    <input type="hidden" name="zipcode" value="<?php echo $user['user_zipcode']; ?>">
                                    <input type="hidden" name="shipping_receiver" value="<?php echo $user['user_firstname'] . ' ' . $user['user_lastname']; ?>">
                                    <input type="hidden" name="shipping_phone" value="<?php echo $user['user_phone']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="shipping-items mb-5">
                            <h5>Items</h5>
                            <hr>
                            <?php $total_weight = 0; ?>
                            <?php $total_price = 0; ?>
                            <?php foreach ($cart_items as $cart_item) : ?>
                                <div class="card cart-card">
                                    <div class="row card-body">
                                        <div class="col-3 col-sm-2 cart-item-image">
                                            <img style="height: 100%;" src="<?php echo base_url(); ?>upload/product-images/<?php echo $cart_item['picture']; ?>" alt="">
                                        </div>
                                        <div class="col-9 col-sm-10 cart-item-detail">
                                            <h5 class="cart-item-name"><?php echo $cart_item['product_name']; ?></h5>
                                            <p class="cart-item-price">Rp<?php echo $cart_item['price'] / 1000; ?>.000</p>
                                            <p class=""><?php echo $cart_item['qty']; ?> item (<?php echo $cart_item['product_weight']; ?> gram)</p>
                                        </div>
                                    </div>
                                </div>
                                <?php $total_weight += $cart_item['product_weight']; ?>
                                <?php $total_price += $cart_item['price']; ?>
                            <?php endforeach; ?>
                            <?php $postvalue = base64_encode(serialize($cart_items)); ?>
                            <input type="hidden" name="cart_items" value="<?php echo $postvalue; ?>">
                        </div>

                        <div class="shipping-courier mb-5">
                            <h5>Shipping Courier</h5>
                            <hr>
                            <div class="form-group row">
                                <label for="shippingCourier" class="col-sm-4 col-form-label">Courier</label>
                                <div class="col-sm-8">
                                    <select class="custom-select" name="shipping_courier" id="shippingCourier">
                                        <option value="" disabled selected hidden>Choose Courier...</option>
                                        <option value="jne">JNE</option>
                                    </select>
                                </div>
                            </div>
                            <div id="shippingContainer" class="form-group row">
                                <div class="loader"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card shopping-summary shadow">
                            <div class="card-body">
                                <h6 class="mb-3">Shopping Summary</h6>
                                <div class="row">
                                    <p class="col-sm-7">Total price (<?php echo count($cart_items); ?> item)</p>
                                    <p class="col-sm-5 price text-right">Rp<?php echo $total_price / 1000; ?>.000</p>
                                </div>
                                <div class="row">
                                    <p class="col-sm-7">Shipping Fee</p>
                                    <p class="col-sm-5 price text-right">Rp<span id="sFee">0</span></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row mb-2">
                                    <p class="col-sm-7 fw-400">Grand Total</p>
                                    <p class="col-sm-5 price text-right">Rp<span class="grand-total"><?php echo $total_price / 1000; ?></span>.000</p>
                                    <input type="hidden" id="total_price" name="total_price" value="">
                                </div>
                                <!-- Choose Payment Modal Trigger -->
                                <button type="button" id="btnPayment" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#paymentModal" disabled>
                                    Choose Payment
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Choose Payment Modal -->
                <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <h6 for="transfer_to">Choose Payment Method</h6>
                                    <select class="custom-select" id="transfer_to" name="transfer_to" required>
                                        <option value="" disabled selected hidden>Choose Payment Method...</option>
                                        <?php foreach ($payment_method as $method) : ?>
                                            <option value="<?php echo $method['id'] ?>"><?php echo $method['pa_name']; ?> - <?php echo $method['pa_type'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <hr>
                                <!-- <div class="card shadow-sm mb-3">
                                    <div class="card-body">
                                        <p class="mb-0">Total Tagihan</p>
                                        <p class="price mb-0">
                                            Rp<span id="grandTotal">
                                            </span>
                                        </p>
                                    </div>
                                </div> -->
                                <h6>User Information</h6>
                                <div id="userInformation">

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Pay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                `<div id="myAddress" class="my-address mt-4">
                    <p class="fw-400"><?php echo $user['user_firstname'] . ' ' . $user['user_lastname']; ?></p>
                    <p><?php echo $user['user_phone']; ?></p>
                    <p><?php echo $user['user_address']; ?></p>
                    <p><?php echo $user['user_city'] . ', ' . $user['user_province'] . ', ' . $user['user_zipcode']; ?></p>

                    <input type="hidden" name="street" value="<?php echo $user['user_address']; ?>">
                    <input type="hidden" id="city" name="city" value="<?php echo $user['user_province'] . ', ' . $user['user_city']; ?>">
                    <input type="hidden" name="zipcode" value="<?php echo $user['user_zipcode']; ?>">
                    <input type="hidden" name="shipping_receiver" value="<?php echo $user['user_firstname'] . ' ' . $user['user_lastname']; ?>">
                    <input type="hidden" name="shipping_phone" value="<?php echo $user['user_phone']; ?>">
                </div>`;
            addressContainer.innerHTML = address;
        });

        document.getElementById('manualAddressButton').addEventListener('click', function() {
            addressContainer.innerHTML = '';
            let address =
                `<div id="manualAddress" class="mt-4">
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
                            <input type="text" class="form-control <?php echo (form_error('city')) ? 'is-invalid' : ''; ?>" name="city" id="city" value="<?php echo set_value('city'); ?>" autocomplete="off">
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

    const loader = document.querySelector('.loader');
    document.getElementById('shippingCourier').addEventListener('change', function() {
        loader.style.display = 'block';
        const url = '<?php echo site_url(); ?>order/get_shipping_cost';
        let origin = 151;
        let destination = <?php echo $user['city_id']; ?>;
        let weight = '<?php echo $total_weight; ?>';
        let courier = this.value;
        getShippingCost(url, origin, destination, weight, courier);
    });

    const getShippingCost = async function(url, origin, destination, weight, courier) {
        try {
            const response = await fetch(`${url}/${origin}/${destination}/${weight}/${courier}`);
            const result = await response.json();
            // console.log(result.rajaongkir.results[0].costs);
            chooseService(result.rajaongkir.results[0].costs)
        } catch (error) {
            throw (error);
        }
    };

    const chooseService = function(shippingCost) {
        let cs =
            `<label for="shipping_price" class="col-sm-4 col-form-label">Service</label>
            <div class="col-sm-8">
                <select class="custom-select" name="shipping_price" id="shipping_price">
                    <option value="" disabled selected hidden>Choose Service...</option>
                    ${shippingCost.map(result => {
                        return `<option value="${result.cost[0].value}">${result.service} - Rp${result.cost[0].value}</option>`
                    })}
                </select>
            </div>`;
        document.getElementById('shippingContainer').innerHTML = cs;

        document.getElementById('shipping_price').addEventListener('change', function() {
            let shippingFee = parseInt(this.value)
            document.getElementById('sFee').innerHTML = shippingFee;
            let totalPrice = parseInt(<?php echo $total_price; ?>) + shippingFee;
            document.querySelector('.grand-total').innerHTML = totalPrice / 1000;
            document.getElementById('total_price').value = totalPrice;
            document.getElementById('btnPayment').disabled = false
        });
    };

    document.querySelector('#transfer_to').addEventListener('change', function() {
        const userInformation = document.querySelector('#userInformation');

        // get payment method text
        let text = this.options[this.selectedIndex].text;
        let textArray = text.split(" - ");
        let paymentMethod = textArray[1];

        console.log(textArray);

        let template = ``;
        if (paymentMethod == 'TRANSFER') {
            template =
                `<div class="form-group">
                    <label for="account_bank">Account Bank*</label>
                    <input type="text" class="form-control <?php echo (form_error('account_bank')) ? 'is-invalid' : ''; ?>" name="account_bank" id="account_bank" value="${textArray[0]}" readonly>
                    <div class="invalid-feedback">
                        <?php echo form_error('account_bank', '<div class="pl-2">', '</div>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="account_name">Account Name*</label>
                    <input type="text" class="form-control <?php echo (form_error('account_name')) ? 'is-invalid' : ''; ?>" name="account_name" id="account_name" value="<?php echo set_value('account_name'); ?>">
                    <div class="invalid-feedback">
                        <?php echo form_error('account_name', '<div class="pl-2">', '</div>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="account_number">Account Number*</label>
                    <input type="text" class="form-control <?php echo (form_error('account_number')) ? 'is-invalid' : ''; ?>" name="account_number" id="account_number" value="<?php echo set_value('account_number'); ?>">
                    <div class="invalid-feedback">
                        <?php echo form_error('account_number', '<div class="pl-2">', '</div>'); ?>
                    </div>
                </div>`;
        } else {
            template =
                `<div class="form-group">
                    <label for="account_bank">Fintech*</label>
                    <input type="text" class="form-control <?php echo (form_error('account_bank')) ? 'is-invalid' : ''; ?>" name="account_bank" id="account_bank" value="${textArray[0]}" readonly>
                    <div class="invalid-feedback">
                        <?php echo form_error('account_bank', '<div class="pl-2">', '</div>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="account_name">${textArray[0]} Account Name*</label>
                    <input type="text" class="form-control <?php echo (form_error('account_name')) ? 'is-invalid' : ''; ?>" name="account_name" id="account_name" value="<?php echo set_value('account_name'); ?>">
                    <div class="invalid-feedback">
                        <?php echo form_error('account_name', '<div class="pl-2">', '</div>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="account_number">${textArray[0]} Phone Number*</label>
                    <input type="text" class="form-control <?php echo (form_error('account_number')) ? 'is-invalid' : ''; ?>" name="account_number" id="account_number" value="<?php echo set_value('account_number'); ?>">
                    <div class="invalid-feedback">
                        <?php echo form_error('account_number', '<div class="pl-2">', '</div>'); ?>
                    </div>
                </div>`;
        }

        userInformation.innerHTML = template

    });
</script>