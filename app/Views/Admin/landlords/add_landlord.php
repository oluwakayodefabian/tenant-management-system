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
                                        <h1 class="h4 text-gray-900 mb-4">Add a Landlord!</h1>
                                    </div>
                                    <?= form_open(base_url('admin/landlord/add'), ["class" => "user", 'id' => "add_landlord_form"]) ?>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <div class="form-check">
                                                <p class="lead">Choose a title</p>
                                                <input class="form-check-input" type="radio" name="title" id="title" value="mr" <?= set_radio('title', 'mr') ?>>
                                                <label class="form-check-label" for="title">
                                                    MR
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <!-- <p class="lead">Choose a title</p> -->
                                                <input class="form-check-input" type="radio" name="title" id="title" value="mrs" <?= set_radio('title', 'mrs') ?>>
                                                <label class="form-check-label" for="title">
                                                    MRS
                                                </label>
                                            </div>

                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('title')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('title') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="Enter landlord's first name" value="<?= set_value('first_name') ?>" />
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('first_name')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('first_name') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control form-control-user" id="last_name" name="last_name" placeholder="Enter landlord's last name" value="<?= set_value('last_name') ?>" />
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('last_name')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('last_name') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <div class="form-check">
                                                <p class="lead">Choose a gender</p>
                                                <input class="form-check-input" type="radio" name="gender" id="gender" value="male" <?= set_radio('gender', 'male') ?>>
                                                <label class="form-check-label" for="gender">
                                                    Male
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="gender" value="female" <?= set_radio('gender', 'female') ?>>
                                                <label class="form-check-label" for="gender">
                                                    Female
                                                </label>
                                            </div>
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('gender')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('gender') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="residential_address">Email Address</label>
                                            <input type="text" class="form-control form-control-user" id="email_address" name="email_address" placeholder="Enter landlord's email Address" value="<?= set_value('email_address') ?>" />
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('email_address')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('email_address') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin">landlord's state of origin</label>
                                            <select onchange="toggleLGA(this);" name="state" id="state" class="custom-select">
                                                <option value="" selected="selected">- Select -</option>
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
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('state')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('state') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin">Landlord's LGA</label>
                                            <select class="custom-select select-lga" id="lga" name="lga">

                                            </select>
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('lga')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('lga') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin">Phone Number</label>
                                            <input type="tel" class="form-control form-control-user" id="phone_number" name="phone_number" placeholder="Enter landlord's phone number" value="<?= set_value('phone_number') ?>">
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('phone_number')) : ?>
                                                    <small class=" form-text text-danger"><?= $validation->getError('phone_number') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="admin">Select a Property that belongs to the landlord</label>
                                            <select class="custom-select" id="property_id" name="property_id">
                                                <option value=""></option>
                                                <?php foreach ($properties as $property) : ?>
                                                    <option value="<?= $property->property_id ?>"><?= $property->property_name ?></option>
                                                <?php endforeach; ?>
                                            </select>

                                            <small id="propertyHelpBlock" class="form-text text-primary">
                                                You can select a Property that the belongs to a landlord
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0 row border-right mr-2">
                                            <div class="col-sm-6">
                                                <label for="rent_amount">Annual Rent Amount set by landlord<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="rent_amount" name="rent_amount" value="<?= set_value('rent_amount') ?>">
                                                <?php if (isset($validation)) : ?>
                                                    <?php if ($validation->hasError('rent_amount')) : ?>
                                                        <small class="form-text text-danger"><?= $validation->getError('rent_amount') ?></small>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Add Landlord" id="add_user_btn">
                                    <hr>
                                    <a href="<?= base_url('admin/landlords/manage') ?>" role="button" class="btn btn-info btn-user btn-block">Cancel Action</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>



        <?= $this->endSection() ?>