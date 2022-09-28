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
                            <?php if ($tenant) : ?>
                                <?= $this->include('partials/admin_cardHeader') ?>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <style>
                                                .coming-soon {
                                                    /* min-height: 100vh; */
                                                    display: flex;
                                                    justify-content: center;
                                                    align-items: center;
                                                    flex-direction: column;
                                                }

                                                .coming-soon .timer-container h1 {
                                                    font-size: 2.5rem;
                                                    margin-bottom: 2.5rem;
                                                }

                                                .coming-soon .timer-container .countdown {
                                                    display: flex;
                                                    justify-content: space-between;
                                                    align-items: center;
                                                    margin-bottom: 1rem;
                                                    text-align: center;
                                                }

                                                .day,
                                                .hour,
                                                .minute,
                                                .second {
                                                    font-size: 1.7rem;
                                                }
                                            </style>
                                            <section class="coming-soon">
                                                <div class="timer-container">
                                                    <h4>Tenant's Expiration countdown</h4>
                                                    <div class="countdown">
                                                        <div class="container-day pr-4 text-success">
                                                            <h3 class="day">Time</h3>
                                                            <h3>Day</h3>
                                                        </div>
                                                        <div class="container-hour pr-4 text-primary">
                                                            <h3 class="hour">Time</h3>
                                                            <h3>Hour</h3>
                                                        </div>
                                                        <div class="container-minute pr-4 text-info">
                                                            <h3 class="minute">Time</h3>
                                                            <h3>Minute</h3>
                                                        </div>
                                                        <div class="container-second pr-4 text-danger">
                                                            <h3 class="second">Time</h3>
                                                            <h3>Second</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <h3> <?= $tenant->full_name ?></h3>
                                            <dl class="row">
                                                <dt class="col-sm-4">Tenant name:</dt>
                                                <dd class="col-sm-8"><?= $tenant->title . ' ' . $tenant->full_name ?></dd>
                                                <dt class="col-sm-4">Phone:</dt>
                                                <dd class="col-sm-8"><?= $tenant->phone_no ?> </dd>
                                                <dt class="col-sm-4">Email Address:</dt>
                                                <dd class="col-sm-8"><?= $tenant->email ?? '' ?></dd>
                                            </dl>
                                            <h4 class="text-success">Property Rented</h4>
                                            <table class="table table-striped table-hover">
                                                <caption>PROPERTY RENTED</caption>
                                                <thead>
                                                    <tr>
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
                                                    <tr>
                                                        <td><a href="<?= base_url("admin/property/details/$property->unique_id") ?>"><?= $property->property_name ?></a></td>
                                                        <td><?= $property->address ?></td>
                                                        <td><?= $property->description ?></td>
                                                        <td><?= $property->rent_amount ?></td>
                                                        <td><?= $property->property_status ?></td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                            <div class="expire-container">
                                                <h1 class="expire">Rent will expire <?= $due_date_for_expiration ?></h1>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4 col-sm-12">
                                           
                                        </div> -->
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-lg w-50" data-toggle="modal" data-target="#modal-fill">
                                        UPDATE TENANT
                                    </button>
                                    <a href="<?= base_url("admin/tenant/delete/$tenant->unique_id") ?>" class="btn btn-danger btn-lg w-25">
                                        DELETE TENANT
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade" data-backdrop="false" id="modal-fill" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Update Tenant Information</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open(base_url("admin/tenant/update/details/$tenant->unique_id"), ["class" => "user", 'id' => ""]) ?>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <?php if ($tenant->title == 'mr') : ?>
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
                                                            <?php if ($tenant->title == 'mrs') : ?>
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
                                                            <input type="text" class="form-control form-control-user" id="first_name" name="first_name" placeholder="Enter tenant's first name" value="<?= $tenant->first_name ?>" />
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('first_name')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('first_name') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label for="last_name">Last Name</label>
                                                            <input type="text" class="form-control form-control-user" id="last_name" name="last_name" placeholder="Enter tenant's last name" value="<?= $tenant->last_name ?>" />
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('last_name')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('last_name') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <?php if ($tenant->gender == 'male') : ?>
                                                                <div class="form-check">
                                                                    <p class="lead">Choose a gender</p>
                                                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="male" checked>
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
                                                            <?php elseif ($tenant->gender == 'female') : ?>
                                                                <div class="form-check">
                                                                    <p class="lead">Choose a gender</p>
                                                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="male">
                                                                    <label class="form-check-label" for="gender">
                                                                        Male
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="female" checked>
                                                                    <label class="form-check-label" for="gender">
                                                                        Female
                                                                    </label>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('gender')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('gender') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label for="residential_address">Email Address</label>
                                                            <input type="text" class="form-control form-control-user" id="email_address" name="email_address" placeholder="Enter tenant's email Address" value="<?= $tenant->email ?>" />
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('email_address')) : ?>
                                                                    <small class="form-text text-danger"><?= $validation->getError('email_address') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label for="admin">tenant's state of origin</label>
                                                            <select onchange="toggleLGA(this);" name="state" id="state" class="custom-select">
                                                                <option value="<?= $tenant->state ?>" selected="selected"><?= $tenant->state ?></option>
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
                                                            <label for="admin">Tenant's LGA</label>
                                                            <select class="custom-select select-lga" id="lga" name="lga">
                                                                <option value="<?= $tenant->lga ?>"><?= $tenant->lga ?></option>
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
                                                            <input type="tel" class="form-control form-control-user" id="phone_number" name="phone_number" placeholder="Enter member's phone number" value="<?= $tenant->phone_no ?>">
                                                            <?php if (isset($validation)) : ?>
                                                                <?php if ($validation->hasError('phone_number')) : ?>
                                                                    <small class=" form-text text-danger"><?= $validation->getError('phone_number') ?></small>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <label for="admin">Select a Property</label>
                                                            <select class="custom-select" id="property_id" name="property_id">
                                                                <option value="">--Select a property for the tenant--</option>
                                                                <option value="<?= $property->property_id ?>" selected><?= $property->property_name ?></option>
                                                                <?php foreach ($properties as $property) : ?>
                                                                    <option value="<?= $property->property_id ?>"><?= $property->property_name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>

                                                            <small id="propertyHelpBlock" class="form-text text-primary">
                                                                You can select a Property that the tenant wants to be occupy
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0 row border-right mr-2">
                                                            <div class="col-sm-6">
                                                                <label for="rent_starting_date">Rent starting date<span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control" id="rent_starting_date" name="rent_starting_date" value="<?= date('Y-m-d', strtotime($tenant->rent_starting_date)) ?>">
                                                                <?php if (isset($validation)) : ?>
                                                                    <?php if ($validation->hasError('rent_starting_date')) : ?>
                                                                        <small class="form-text text-danger"><?= $validation->getError('rent_starting_date') ?></small>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="rent_starting_time">Rent starting time<span class="text-danger">*</span></label>
                                                                <input type="time" class="form-control" id="rent_starting_time" name="rent_starting_time" value="<?= date('H:i:s', strtotime($tenant->rent_starting_date)) ?>">
                                                                <?php if (isset($validation)) : ?>
                                                                    <?php if ($validation->hasError('rent_starting_time')) : ?>
                                                                        <small class="form-text text-danger"><?= $validation->getError('rent_starting_time') ?></small>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 row">
                                                            <div class="col-sm-6">
                                                                <label for="property_status">Rent Expiry Date<span class="text-danger">*</span></label>
                                                                <input type="date" class="form-control" id="rent_ending_date" name="rent_ending_date" value="<?= date('Y-m-d', strtotime($tenant->rent_ending_date)) ?>">
                                                                <?php if (isset($validation)) : ?>
                                                                    <?php if ($validation->hasError('rent_ending_date')) : ?>
                                                                        <small class="form-text text-danger"><?= $validation->getError('rent_ending_date') ?></small>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label for="property_status">Rent Expiry time<span class="text-danger">*</span></label>
                                                                <input type="time" class="form-control" id="rent_ending_time" name="rent_ending_time" value="<?= date('H:i:s', strtotime($tenant->rent_ending_date)) ?>">
                                                                <?php if (isset($validation)) : ?>
                                                                    <?php if ($validation->hasError('rent_ending_time')) : ?>
                                                                        <small class="form-text text-danger"><?= $validation->getError('rent_ending_time') ?></small>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Update tenant" id="add_user_btn">
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
                                    <div class="border p-2 bg-warning rounded">Tenant details not found</div>
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