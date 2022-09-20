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
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        <?php if (successMessage()) : ?>
                            <div class="alert alert-success">
                                <?= successMessage() ?>
                            </div>
                        <?php elseif (errorMessage()) : ?>
                            <div class="alert alert-danger">
                                <?= errorMessage() ?>
                            </div>
                        <?php endif; ?>
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add a Property!</h1>
                                    </div>
                                    <?= form_open_multipart(base_url('admin/property/add'), ["class" => "user", 'id' => "property_form"]) ?>
                                    <div class="form-group row">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label for="property_name">Name of property<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-user" id="country" name="property_name" placeholder="Enter name of property" value="<?= set_value('property_name') ?>" />
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('property_name')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('property_name') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <label for="country">Country<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-user" id="country" name="country" placeholder="Enter Country name" value="<?= set_value('country') ?>" />
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('country')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('country') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <label for="state">State<span class="text-danger">*</span></label>
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
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <label for="city">City<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-user" id="city" name="city" placeholder="Enter city name" value="<?= set_value('city') ?>" />
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('city')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('city') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="rent_amount">Rent Amount (Naira)<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-user" id="rent_amount" name="rent_amount" placeholder="Enter rent amount" value="<?= set_value('rent_amount') ?>" />
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('rent_amount')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('rent_amount') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="description">Description<span class="text-danger">*</span></label>
                                            <textarea name="description" id="description" class="form-control" placeholder="Enter a brief description about the property"><?= set_value('description') ?></textarea>
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('description')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('description') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label for="address">Address<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-user" id="address" name="address" placeholder="Enter the address of the property" value="<?= set_value('address') ?>">
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('address')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('address') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="property_status">Choose a role for the user<span class="text-danger">*</span></label>
                                            <select class="custom-select" id="property_status" name="property_status">
                                                <option value="vacant">Vacant</option>
                                                <option value="occupied">Occupied</option>
                                            </select>
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('property_status')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('property_status') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group w-100 mt-3">
                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                            <label for="property_image">add an image of the property<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="property_image" name="property_image">
                                            <?php if (isset($validation)) : ?>
                                                <?php if ($validation->hasError('property_image')) : ?>
                                                    <small class="form-text text-danger"><?= $validation->getError('property_image') ?></small>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block mb-3" value="Add property" id="add_property_btn">
                                    <hr>
                                    <a href="<?= base_url('admin/property/manage') ?>" class="btn btn-info btn-user btn-block">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>



            <?= $this->endSection() ?>