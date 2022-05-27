<?= $this->extend("layouts/frontEnd_layout") ?>
<?= $this->section("body-contents") ?>
<!-- Navigation -->
<?= $this->include('partials/navBar') ?>
<!-- Header -->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
                <h1 class="text-uppercase text-white font-weight-bold">Tenancy Managment System</h1>
                <hr class="divider my-4" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 font-weight-light mb-5">Manage with us!</p>
                <a class="btn btn-primary btn-xl js-scroll-trigger" href="<?= base_url('login') ?>">Login</a>
            </div>
        </div>
    </div>
</header>

<?= $this->endSection() ?>;