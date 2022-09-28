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
                            <?php if ($landlord) : ?>
                                <?= $this->include('partials/admin_cardHeader') ?>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-12">
                                            <h3> <?= $landlord->full_name ?></h3>
                                            <dl class="row">
                                                <dt class="col-sm-4">Title:</dt>
                                                <dd class="col-sm-8"><?= ucfirst($landlord->title) ?></dd>
                                                <dt class="col-sm-4">Landlord name:</dt>
                                                <dd class="col-sm-8"><?= $landlord->full_name ?></dd>
                                                <dt class="col-sm-4">Phone:</dt>
                                                <dd class="col-sm-8"><?= $landlord->phone_no ?> </dd>
                                                <dt class="col-sm-4">Email Address:</dt>
                                                <dd class="col-sm-8"><?= $landlord->email ?></dd>
                                            </dl>
                                            <h4 class="text-success">Properties Owned</h4>
                                            <table class="table table-striped table-hover">
                                                <caption>List of Properties</caption>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <!-- <th scope="col">Landlord Name</th> -->
                                                        <th scope="col">Property Name</th>
                                                        <th scope="col">Address</th>
                                                        <th scope="col">Description</th>
                                                        <!-- <th scope="col">Location</th> -->
                                                        <th scope="col">Annual Rent</th>
                                                        <th scope="col">property status</th>
                                                        <!-- <th scope="col" colspan="1">Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($properties as $key => $property) : ?>
                                                        <tr>
                                                            <td><?= $key + 1 ?></td>
                                                            <td><a href="<?= base_url("admin/property/details/$property->unique_id") ?>"><?= $property->property_name ?></a></td>
                                                            <td><?= $property->address ?></td>
                                                            <td><?= $property->description ?></td>
                                                            <td><?= $property->rent_amount ?></td>
                                                            <td><?= $property->property_status ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-lg w-50" data-toggle="modal" data-target="#modal-fill">
                                        UPDATE LANDLORD
                                    </button>
                                    <a href="<?= base_url("admin/landlord/delete/$landlord->unique_id") ?>" class="btn btn-danger btn-lg w-25">
                                        DELETE LANDLORD
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
                                                    <?= form_open(base_url("admin/landlord/update/details/$landlord->unique_id"), ["class" => "user", 'id' => "add_landlord_form"]) ?>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <?php if ($landlord->title == 'mr') : ?>
                                                                <div class="form-check">
                                                                    <p class="lead">Choose a title</p>
                                                                    <input class="form-check-input" type="radio" name="title" id="title" value="mr" checked>
                                                                    <label class="form-check-label" for="title">
                                                                        MR
                                                                    </label>

                                                                </div>
                                                                <div class="form-check">
                                                                    <!-- <p class="lead">Choose a title</p> -->
                                                                    <input class="form-check-input" type="radio" name="title" id="title" value="mrs">
                                                                    <label class="form-check-label" for="title">
                                                                        MRS
                                                                    </label>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if ($landlord->title == 'mrs') : ?>
                                                                <div class="form-check">
                                                                    <p class="lead">Choose a title</p>
                                                                    <input class="form-check-input" type="radio" name="title" id="title" value="mr">
                                                                    <label class="form-check-label" for="title">
                                                                        MR
                                                                    </label>

                                                                </div>
                                                                <div class="form-check">
                                                                    <!-- <p class="lead">Choose a title</p> -->
                                                                    <input class="form-check-input" type="radio" name="title" id="title" value="mrs" checked>
                                                                    <label class="form-check-label" for="title">
                                                                        MRS
                                                                    </label>
                                                                <?php endif; ?>
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
                                                            <input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="Enter landlord's first name" value="<?= $landlord->first_name ?>" />
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('first_name')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('first_name') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label for="last_name">Last Name</label>
                                                            <input type="text" class="form-control form-control-user" id="last_name" name="last_name" placeholder="Enter landlord's last name" value="<?= $landlord->first_name ?>" />
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
                                                                <?php if ($landlord->gender == 'male') : ?>
                                                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="male" checked>
                                                                    <label class="form-check-label" for="gender">
                                                                        Male
                                                                    </label>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="form-check">
                                                                <?php if ($landlord->gender == 'female') : ?>
                                                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="female" checked>
                                                                    <label class="form-check-label" for="gender">
                                                                        Female
                                                                    </label>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('gender')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('gender') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label for="residential_address">Email Address</label>
                                                            <input type="text" class="form-control form-control-user" id="email_address" name="email_address" placeholder="Enter landlord's email Address" value="<?= $landlord->email ?>" />
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
                                                                <option value="<?= $landlord->state ?>" selected="selected">- <?= $landlord->state ?> -</option>
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
                                                            <input type="tel" class="form-control form-control-user" id="phone_number" name="phone_number" placeholder="Enter landlord's phone number" value="<?= $landlord->phone_no ?>">
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('phone_number')) : ?>
                                                                    <small class=" form-text text-danger"><?= $validation->getError('phone_number') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Update Landlord" id="add_user_btn">
                                                    <?= form_close() ?>
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