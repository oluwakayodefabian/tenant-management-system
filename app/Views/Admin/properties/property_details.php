<?= $this->extend("layouts/admin_layout") ?>
<?= $this->section('admin-contents') ?>

<!-- Page Wrapper -->
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

                <!-- Page Heading -->
                <div class="mb-4">
                    <h1 class="h3 mb-0 text-gray-800"><?= session()->get('email') ?></h1>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page"> Registered properties
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Card Example -->
                    <div class="col-xl-12 col-md-10 mb-4">
                        <div class="card border-left-primary shadow mb-4 border-bottom-success text-gray-900">
                            <!-- card header -->
                            <?php if ($property) : ?>
                                <?= $this->include('partials/admin_cardHeader') ?>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-12">
                                            <h3> <?= $property->property_name ?></h3>
                                            <dl class="row">
                                                <dt class="col-sm-4">Property name:</dt>
                                                <dd class="col-sm-8"><?= $property->property_name ?></dd>
                                                <dt class="col-sm-4">Property address:</dt>
                                                <dd class="col-sm-8"><?= $property->address ?></dd>
                                                <dt class="col-sm-4">Property Description:</dt>
                                                <dd class="col-sm-8"><?= $property->description ?></dd>
                                                <dt class="col-sm-4">Property Status:</dt>
                                                <dd class="col-sm-8"><?= $property->property_status ?></dd>
                                                <dt class="col-sm-4">Annual Rent:</dt>
                                                <dd class="col-sm-8"><?= $property->rent_amount ?></dd>
                                                <dt class="col-sm-12">
                                                    <h4 class="text-success">Landlord details</h4>
                                                </dt>
                                                <dt class="col-sm-4">Landlord name:</dt>
                                                <dd class="col-sm-8"><?= $property->title . ' ' . $property->full_name ?></dd>
                                                <dt class="col-sm-4">Phone:</dt>
                                                <dd class="col-sm-8"><?= $property->phone_no ?> </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-lg w-50" data-toggle="modal" data-target="#modal-fill">
                                        UPDATE PROPERTY
                                    </button>
                                    <a href="<?= base_url("admin/property/delete/$property->unique_id") ?>" class="btn btn-danger btn-lg w-25">
                                        DELETE PROPERTY
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade" data-backdrop="false" id="modal-fill" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Property Information</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open(base_url("admin/dashboard/property/update/$property->unique_id"), ["class" => 'user']) ?>
                                                    <?= form_open_multipart(base_url('admin/property/update'), ["class" => "user", 'id' => "property_form"]) ?>
                                                    <div class="form-group row">
                                                        <div class="col-sm-12 mb-3 mb-sm-0">
                                                            <label for="property_name">Name of property<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-user" id="country" name="property_name" placeholder="Enter name of property" value="<?= $property->property_name ?>" />
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
                                                            <input type="text" class="form-control form-control-user" id="country" name="country" placeholder="Enter Country name" value="<?= $property->country ?>" />
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('country')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('country') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                                            <label for="state">State<span class="text-danger">*</span></label>
                                                            <select onchange="toggleLGA(this);" name="state" id="state" class="custom-select">
                                                                <option value="<?= $property->state ?>" selected="selected">- <?= $property->state ?> -</option>
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
                                                            <input type="text" class="form-control form-control-user" id="city" name="city" placeholder="Enter city name" value="<?= $property->city ?>" />
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
                                                            <input type="text" class="form-control form-control-user" id="rent_amount" name="rent_amount" placeholder="Enter rent amount" value="<?= $property->rent_amount ?>" />
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('rent_amount')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('rent_amount') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label for="description">Description<span class="text-danger">*</span></label>
                                                            <textarea name="description" id="description" class="form-control" placeholder="Enter a brief description about the property"><?= $property->description ?></textarea>
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
                                                            <input type="text" class="form-control form-control-user" id="address" name="address" placeholder="Enter the address of the property" value="<?= $property->address ?>">
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('address')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('address') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="property_status">Property Status<span class="text-danger">*</span></label>
                                                            <select class="custom-select" id="property_status" name="property_status">
                                                                <?php switch ($property->property_status) {
                                                                    case 'vacant':
                                                                        echo "<option value='vacant' selected>Vacant</option>
                                                                                <option value='occupied'>Occupied</option>";
                                                                        break;
                                                                    case 'occupied':
                                                                        echo "<option value='vacant'>Vacant</option>
                                                                                <option value='occupied' selected>Occupied</option>";
                                                                        break;
                                                                } ?>

                                                            </select>
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('property_status')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('property_status') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <label for="landlord_id">Landlord<span class="text-danger">*</span></label>
                                                            <select class="custom-select" id="landlord_id" name="landlord_id">
                                                                <option value="">Choose the landlord for this property</option>
                                                                <?php foreach ($landlords as $landlord) : ?>
                                                                    <?php if ($landlord->landlord_id == $property->landlord_id) : ?>
                                                                        <option value="<?= $landlord->landlord_id ?>" selected><?= $landlord->first_name . ' ' . $landlord->last_name ?></option>
                                                                    <?php endif; ?>
                                                                    <option value="<?= $landlord->landlord_id ?>"><?= $landlord->first_name . ' ' . $landlord->last_name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('landlord_id')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('landlord_id') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                    <input type="submit" class="btn btn-primary btn-user btn-block mb-3" value="Update property" id="update_property_btn">

                                                    </form>
                                                </div>
                                                <div class="modal-footer">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.modal -->

                                </div>
                            <?php else : ?>
                                <div class="card-body scroll-card-body">
                                    <div class="border p-2 bg-warning rounded">Landlord details not found</div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- // Content Row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?= $this->endSection() ?>