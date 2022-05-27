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
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Edit <?= $member->first_name . ' ' . $member->last_name ?> information!</h1>
                                    </div>
                                    <?= form_open(base_url('admin/member/update'), ["class" => "user", 'id' => "edit_member_form"]) ?>
                                    <div class="form-group">
                                        <input type="hidden" name="member_id" value="<?= $member->id ?>">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="Enter member's first name" value="<?= $member->first_name ?>" />
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control form-control-user" id="last_name" name="last_name" placeholder="Enter member's last name" value="<?= $member->last_name ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <?php if ($member->is_an_elder == 'yes') : ?>
                                                <div class="form-check">
                                                    <p class="lead">Is this member an elder?</p>
                                                    <input class="form-check-input" type="radio" name="is_an_elder" id="yes" value="yes" checked>
                                                    <label class="form-check-label" for="yes">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_an_elder" id="no" value="no">
                                                    <label class="form-check-label" for="no">
                                                        No
                                                    </label>
                                                </div>
                                            <?php else : ?>
                                                <div class="form-check">
                                                    <p class="lead">Is this member an elder?</p>
                                                    <input class="form-check-input" type="radio" name="is_an_elder" id="yes" value="yes">
                                                    <label class="form-check-label" for="yes">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_an_elder" id="no" value="no" checked>
                                                    <label class="form-check-label" for="no">
                                                        No
                                                    </label>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('is_an_elder')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('is_an_elder') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="residential_address">Residential Address</label>
                                            <input type="text" class="form-control form-control-user" id="residential_address" name="residential_address" placeholder="Enter member's residential Address" value="<?= $member->residential_address ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin">Member's state of origin</label>
                                            <select onchange="toggleLGA(this);" name="state" id="state" class="custom-select">
                                                <option value="<?= $member->state ?>" selected><?= $member->state ?></option>
                                                <option value="">- Select -</option>
                                                <option value="Abia">Abia</option>
                                                <option value="Adamawa">Adamawa</option>
                                                <option value="AkwaIbom">AkwaIbom</option>
                                                <option value="Anambra">Anambra</option>
                                                <option value="Bauchi">Bauchi</option>
                                                <option value="Bayelsa">Bayelsa</option>
                                                <option value="Benue">Benue</option>
                                                <option value="Borno">Borno</option>
                                                <option value="Cross River">Cross River</option>
                                                <option value="Delta">Delta</option>
                                                <option value="Ebonyi">Ebonyi</option>
                                                <option value="Edo">Edo</option>
                                                <option value="Ekiti">Ekiti</option>
                                                <option value="Enugu">Enugu</option>
                                                <option value="FCT">FCT</option>
                                                <option value="Gombe">Gombe</option>
                                                <option value="Imo">Imo</option>
                                                <option value="Jigawa">Jigawa</option>
                                                <option value="Kaduna">Kaduna</option>
                                                <option value="Kano">Kano</option>
                                                <option value="Katsina">Katsina</option>
                                                <option value="Kebbi">Kebbi</option>
                                                <option value="Kogi">Kogi</option>
                                                <option value="Kwara">Kwara</option>
                                                <option value="Lagos">Lagos</option>
                                                <option value="Nasarawa">Nasarawa</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Ogun">Ogun</option>
                                                <option value="Ondo">Ondo</option>
                                                <option value="Osun">Osun</option>
                                                <option value="Oyo">Oyo</option>
                                                <option value="Plateau">Plateau</option>
                                                <option value="Rivers">Rivers</option>
                                                <option value="Sokoto">Sokoto</option>
                                                <option value="Taraba">Taraba</option>
                                                <option value="Yobe">Yobe</option>
                                                <option value="Zamfara">Zamafara</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin">Member's LGA</label>
                                            <select class="custom-select select-lga" id="lga" name="lga">
                                                <option value="<?= $member->lga ?>" selected><?= $member->lga ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin">Phone Number</label>
                                            <input type="tel" class="form-control form-control-user" id="phone_number" name="phone_number" placeholder="Enter member's phone number" value="<?= $member->phone_number ?>">
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin">Select a department(optional)</label>
                                            <select class="custom-select" id="department_id" name="department_id">
                                                <?php foreach ($departments as $dept) : ?>
                                                    <?php if ($dept->id == $member->department_id) : ?>
                                                        <option value="<?= $dept->id ?>" selected><?= $dept->dept_name ?></option>
                                                    <?php endif; ?>
                                                    <option value="<?= $dept->id ?>"><?= $dept->dept_name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small id="departmentHelpBlock" class="form-text text-primary">
                                                You can select a department that the member wants to be under(This is optional and can always be changed later.)
                                            </small>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block mb-3" value="Update member information" id="add_user_btn">
                                    <hr>
                                    <a href="<?= base_url('admin/member/manage') ?>" role="button" class="btn btn-info btn-user btn-block">Cancel Action</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>



        <?= $this->endSection() ?>