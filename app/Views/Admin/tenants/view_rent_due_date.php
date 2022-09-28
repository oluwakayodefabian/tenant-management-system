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
            <div class="container-fluid">
                <div>
                    <?php if (successMessage()) : ?>
                        <div class="alert alert-success">
                            <p class="lead"><?= successMessage() ?></p>
                        </div>
                    <?php elseif (errorMessage()) : ?>
                        <div class="alert alert-danger">
                            <p class="lead"><?= errorMessage() ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- Page Heading -->
                <h1 class="h3 m-4 text-gray-800">Manage Tenants</h1>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info">Rent Due Dates For Tenants</h6>
                    </div>
                    <div class="card-body">
                        <?= $tenants_with_expiry_dates ?>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>



        <?= $this->endSection() ?>