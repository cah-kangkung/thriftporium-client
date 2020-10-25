<main>
    <section id="edit-profile-section" class="top-section">
        <div class="container">
            <h3 style="font-weight: 300; background-color: rgba(0, 0, 0, 0.05); padding: 18px;">Edit Profile</h3>

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

            <div class="row" style="padding: 18px;">
                <div class="col-lg-9">

                    <form method="post" action="<?php echo site_url(); ?>profile/edit_profile/<?php echo $user['id']; ?>" enctype="multipart/form-data">

                        <h4>Profile Picture</h4>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <img src="<?php echo base_url() . 'assets/img/profile-pictures/' . $user['user_image']; ?>" class="img-thumbnail" style="border-radius: unset;">
                            </div>
                            <div class="col-sm-4 my-auto">
                                <button type="button" class="btn btn-primary btn-custom">
                                    <input type="file" name="image" id="image">
                                </button>
                            </div>
                        </div>

                        <h4 class="mt-5">General Information</h4>
                        <hr>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-3 col-form-label">First Name*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control <?php echo (form_error('first_name')) ? 'is-invalid' : ''; ?>" name="first_name" id="first_name" value="<?php echo $user['user_firstname']; ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('first_name', '<div class="pl-2">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-3 col-form-label">Last Name*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control <?php echo (form_error('last_name')) ? 'is-invalid' : ''; ?>" name="last_name" id="last_name" value="<?php echo $user['user_lastname']; ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('last_name', '<div class="pl-2">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['user_email']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-5">Detail Information</h4>
                        <hr>
                        <div class="card shadow">
                            <div class="card-body" id="detailBody">
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-3 col-form-label">Gender*</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" id="gender" name="gender">
                                            <option value="M" <?php echo ($user['user_gender'] == 'M') ? 'selected' : ''; ?>>Male</option>
                                            <option value="F" <?php echo ($user['user_gender'] == 'F') ? 'selected' : ''; ?>>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3 col-form-label">Phone*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control <?php echo (form_error('phone')) ? 'is-invalid' : ''; ?>" name="phone" id="phone" value="<?php echo $user['user_phone']; ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('phone', '<div class="pl-2">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 col-form-label">Address*</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control <?php echo (form_error('address')) ? 'is-invalid' : ''; ?>" name="address" id="address" rows="2"><?php echo $user['user_address']; ?></textarea>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('address', '<div class="pl-2">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="city" class="col-sm-3 col-form-label">City*</label>
                                    <div class="col-sm-9 autocomplete">
                                        <input type="text" class="form-control <?php echo (form_error('city')) ? 'is-invalid' : ''; ?>" name="city" id="cityProfile" value="<?php echo $user['user_province'] . ', ' . $user['user_city']; ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('city', '<div class="pl-2">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="zipcode" class="col-sm-3 col-form-label">Zipcode*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control <?php echo (form_error('zipcode')) ? 'is-invalid' : ''; ?>" name="zipcode" id="zipcode" value="<?php echo $user['user_zipcode']; ?>">
                                        <div class="invalid-feedback">
                                            <?php echo form_error('zipcode', '<div class="pl-2">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ml-auto mt-4">Save</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </section>
</main>


<script src="<?php echo base_url(); ?>assets/js/components/Autocomplete.js"></script>
<script>
    autocomplete(document.getElementById('cityProfile'), <?php echo json_encode($cities); ?>);
</script>