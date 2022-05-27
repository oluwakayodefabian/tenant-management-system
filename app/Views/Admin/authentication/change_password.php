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
                        <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <!-- messages -->
                                    <?php if (isset($error)) : ?>
                                        <div class="alert alert-danger">
                                            <?= $error ?>
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
                                    <h1 class="h4 text-gray-900 mb-2">Reset password for</h1>
                                    <p class="mb-4"><?= session()->get('userEmail') ?>!</p>
                                </div>
                                <?= form_open('', ['class' => 'user']) ?>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user" id="password" aria-describedby="passwordHelp" placeholder="Enter Your New Password...">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_repeat" class="form-control form-control-user" id="password_repeat" aria-describedby="passwordHelp" placeholder="Confirm Your New Password...">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Reset password
                                </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('admin/login') ?>">Cancel</a>
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