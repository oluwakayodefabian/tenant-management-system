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
                            <?php if (session()->get('admin') == 'super_admin') : ?>
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Edit <?= $user->first_name . ' ' . $user->last_name ?>'s Account!</h1>
                                        </div>
                                        <?= form_open(base_url('admin/users/update'), ["class" => "user", 'id' => "admin_edit_form"]) ?>
                                        <div class="form-group">
                                            <input type="hidden" value="<?= $user->admin_id ?>" name="admin_id">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="admin_username">Username</label>
                                                <input type="text" class="form-control form-control-user" id="admin_username" name="admin_username" placeholder="Enter username" value="<?= $user->admin_username  ?>" disabled />
                                            </div>
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="admin_email">Email</label>
                                                <input type="email" class="form-control form-control-user" id="admin_email" name="admin_email" placeholder="Email Address" value="<?= $user->admin_email ?>" disabled />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="admin_password">Password</label>
                                                <input type="password" class="form-control form-control-user" id="admin_password" name="admin_password" placeholder="Password" value="<?= $user->password ?>" disabled>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="admin">Choose a role for the user</label>
                                                <select class="custom-select" id="role" name="role">
                                                    <?php switch ($user->admin_type):
                                                        case 'super_admin':
                                                            echo "<option value='main_admin' selected>super admin</option>";
                                                            echo "<option value='sub_admin'>sub admin</option>";
                                                            break;
                                                        case 'sub_admin':
                                                            echo "<option value='sub_admin' selected>sub admin</option>";
                                                            echo "<option value='super_admin'>super admin</option>";
                                                            break;
                                                    endswitch; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-success btn-user btn-block" value="Update Account" id="admin_register">
                                        <hr>
                                        <a href="<?= base_url('admin/users/manage') ?>" class="btn btn-info btn-user btn-block ml-3">Cancel</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>



        <?= $this->endSection() ?>