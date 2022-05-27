<?= $this->extend("layouts/auth_layout") ?>
<?= $this->section("body-contents") ?>
<!-- Navigation -->
<?= $this->include('partials/navBar') ?>

<!-- Service section -->
<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="alert alert-info" role="alert">
                    <?php
                    if (isset($errMsg)) {
                        echo '<div style="color:#FF0000;text-align:center;font-size:17px;">' . $errMsg . '</div>';
                    }
                    ?>
                    <h2 class="text-center"></h2>
                    <?= form_open(base_url("admin/login")) ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Address/Username</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-success" name='login' value="Login">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>;