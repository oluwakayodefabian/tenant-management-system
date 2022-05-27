<?= $this->extend("layouts/admin_layout") ?>
<?= $this->section('admin-contents') ?>

<div id="wrapper">
    <!-- Sidebar -->
    <?= $this->include('partials/admin_sideBar') ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <?= $this->include("partials/admin_topBar") ?>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <?php if (isset($current_password_error)) : ?>
                            <div class="alert alert-danger">
                                <?= $current_password_error ?>
                                <?php unset($current_password_error) ?>
                            </div>
                        <?php endif; ?>
                        <?php if (errorMessage()) : ?>
                            <div class="alert alert-danger">
                                <?= errorMessage() ?>
                            </div>
                        <?php endif; ?>
                        <?php if (successMessage()) : ?>
                            <div class="alert alert-success">
                                <?= successMessage() ?>
                            </div>
                        <?php endif; ?>
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Change password for</h1>
                                        <?php if (session()->get('adminEmail')) : ?>
                                            <p><?= session()->get('adminEmail') ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?= form_open(base_url('admin/users/change_password/' . session()->get('uniqueID')), ["class" => "user", 'id' => "admin_register_form"]) ?>
                                    <div class="form-group">
                                        <label for="current-password">Enter your current password</label>
                                        <div id="current-pwd-container">
                                            <span id="toggle-pwd" title="see password"><i class="fas fa-eye fa-2x"></i></span>
                                            <input type="password" name="current-password" id="current-password" class=" form-control form-control-user" placeholder="Enter current password" value="<?= set_value('current-password') ?>">
                                        </div>
                                        <small id="currentPasswordHelpBlock" class="form-text text-primary">
                                            Your current password is needed to enable the input fields below
                                        </small>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin_password">Password</label>
                                            <input type="text" class="form-control form-control-user" id="admin_password" name="admin_password" placeholder="Password" disabled>
                                            <small id="passwordHelpBlock" class="form-text text-primary">
                                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                                            </small>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="confirm_admin_password">Re-type Password</label>
                                            <input type="text" class="form-control form-control-user" id="confirm_admin_password" name="confirm_admin_password" placeholder="Password" disabled>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="update password" id="admin_update">
                                    <hr>
                                    <a href="<?= base_url('admin/users/manage') ?>" role="button" class="btn btn-info btn-user btn-block">Cancel Action</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>



        <?= $this->endSection() ?>