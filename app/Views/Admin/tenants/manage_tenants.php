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
                <?php if (session()->get('admin') != 'super_admin') : ?>
                    <!-- Button trigger modal -->
                    <a href="<?= base_url('admin/tenants/add') ?>" class="btn btn-info my-5 mx-4">
                        Add a Tenant
                    </a>
                <?php endif; ?>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info">List of Tenants</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover" id="tenantTable">
                                <caption>List of Tenants</caption>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tenant Name</th>
                                        <th scope="col">Date Created</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>



        <?= $this->endSection() ?>