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
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        <?php if (successMessage()) : ?>
                            <div class="alert alert-success">
                                <?= successMessage() ?>
                            </div>
                        <?php elseif (errorMessage()) : ?>
                            <div class="alert alert-danger">
                                <?= errorMessage() ?>
                            </div>
                        <?php endif; ?>
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Admin Account!</h1>
                                    </div>
                                    <?= form_open(base_url('admin/register'), ["class" => "user", 'id' => "admin_register_form"]) ?>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="first_name">First name</label>
                                            <input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="Enter First name" value="<?= set_value('first_name') ?>" />
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="last_name">Last name</label>
                                            <input type="text" class="form-control form-control-user" id="last_name" name="last_name" placeholder="Enter Last name" value="<?= set_value('last_name') ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin_username">Username</label>
                                            <input type="text" class="form-control form-control-user" id="admin_username" name="admin_username" placeholder="Enter username" value="<?= set_value('admin_username') ?>" />
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin_email">Email</label>
                                            <input type="email" class="form-control form-control-user" id="admin_email" name="admin_email" placeholder="Email Address" value="<?= set_value('admin_email') ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin_password">Password</label>
                                            <input type="text" class="form-control form-control-user" id="admin_password" name="admin_password" placeholder="Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="admin">Choose a role for the user</label>
                                            <select class="custom-select" id="role" name="role">
                                                <option value="agent">agent</option>
                                                <option value="super_admin">super admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Register Account" id="admin_register">
                                    <hr>
                                    <a href="<?= base_url('admin/users/manage') ?>" class="btn btn-info btn-user btn-block">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>



        <?= $this->endSection() ?>