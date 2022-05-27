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
                <h1 class="h3 m-4 text-gray-800">Activity Log</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            This is the log record of <?= $user_login_activity[0]->first_name . ' ' . $user_login_activity[0]->last_name ?>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Agent</th>
                                        <th scope="col">IP Address</th>
                                        <th scope="col">Login Time</th>
                                        <th scope="col">LogOut Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user_login_activity as $key => $login_activity) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $login_activity->agent ?></td>
                                            <td><?= $login_activity->ip_address ?></td>
                                            <td><?= date('dS M Y H:i:sA', strtotime($login_activity->login_time)) ?></td>
                                            <?php if ($login_activity->logout_time == "0000-00-00 00:00:00") : ?>
                                                <td><?= "Logout time is unavailable for now" ?></td>
                                            <?php else : ?>
                                                <td><?= date('dS M Y H:i:sA', strtotime($login_activity->logout_time)) ?></td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->
        </div>

        <?= $this->endSection() ?>