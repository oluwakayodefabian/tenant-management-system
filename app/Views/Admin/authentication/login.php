<?= $this->extend("layouts/admin_layout") ?>
<?= $this->section('admin-contents') ?>

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    <!-- Alert messages -->
                                    <?php if (isset($error)) : ?>
                                        <div class="alert alert-danger">
                                            <?= $error ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (isset($_GET['msg'])) : ?>
                                        <div class="alert alert-info">
                                            <?= $_GET['msg'] ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- // Alert messages -->
                                </div>
                                <?= form_open(base_url("admin/login"), ['class' => 'user']) ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="username" aria-describedby="usernameHelp" placeholder="Enter username..." name="admin_username" value="<?= set_value('admin_username') ?>">
                                    <?php if (isset($validation)) : ?>
                                        <?php if ($validation->hasError('admin_username')) : ?>
                                            <small class="form-text text-danger"><?= $validation->getError('admin_username') ?></small>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <div id="current-pwd-container">
                                        <span id="toggle-pwd" title="see password"><i class="fas fa-eye fa-2x"></i></span>
                                        <input type="password" class="form-control form-control-user" id="current-password" placeholder="Password" name="password">
                                    </div>
                                    <?php if (isset($validation)) : ?>
                                        <?php if ($validation->hasError('password')) : ?>
                                            <small class="form-text text-danger"><?= $validation->getError('password') ?></small>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('admin/forget_password') ?>">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>