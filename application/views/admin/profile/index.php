<script>
    const previewImage = function() {
        $('#imagePreview').html('');
        let total_file = document.getElementById('images').files.length;
        for (let i = 0; i < total_file; i++) {
            const template = document.createElement('div');
            template.classList.add('col-xl-3');
            template.classList.add('col-lg-4');
            template.classList.add('col-md-6');
            template.classList.add('mb-4');
            template.innerHTML = `<div class="card" style="width: 200px; height: 200px;">
                                    <img class="card-img-top" style="height: 100%; width: 100%; object-fit: contain;" src="" alt="Product images">
                                </div>`;
            const img = template.querySelector('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.onload = function() {
                URL.revokeObjectURL(this.src);
            }
            $('#imagePreview').append(template);
        }
    };

    const clearFileInput = function() {
        document.getElementById('images').value = '';
        $('#imagePreview').html('');
    };
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin Profile</h1>
        <!-- <a href="<?php echo site_url(); ?>admin_report" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a> -->
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

    <div class="row">
        <div class="col-lg-6">

            <!-- User Detail -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Detail</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-4 col-form-label">First Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $admin['user_firstname']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="last_name" class="col-sm-4 col-form-label">Last Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo $admin['user_lastname']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo $admin['user_email']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-4 col-form-label">Role</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="role" id="role" value="<?php echo $admin['role_name']; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">

            <!-- Password -->
            <form action="<?php echo site_url(); ?>admin_profile/change_password/<?php echo $admin['id']; ?>" method="post">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="old_password" class="col-sm-4 col-form-label">Old Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control <?php echo (form_error('old_password')) ? 'is-invalid' : ''; ?>" name="old_password" id="old_password">
                                <div class="invalid-feedback">
                                    <?php echo form_error('old_password', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="new_password" class="col-sm-4 col-form-label">New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control <?php echo (form_error('new_password')) ? 'is-invalid' : ''; ?>" name="new_password" id="new_password">
                                <div class="invalid-feedback">
                                    <?php echo form_error('new_password', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="repeat_password" class="col-sm-4 col-form-label">Repat New Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control <?php echo (form_error('repeat_password')) ? 'is-invalid' : ''; ?>" name="repeat_password" id="repeat_password">
                                <div class="invalid-feedback">
                                    <?php echo form_error('repeat_password', '<div class="pl-2">', '</div>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ml-auto">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->