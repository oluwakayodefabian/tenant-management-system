<!DOCTYPE html>
<html lang="en">

<head>
    <?php if (isset($ajax_usage) && $ajax_usage == true) : ?>
        <?= csrf_meta() ?>
    <?php endif; ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Oluwakayode Fabian">
    <meta name="author" content="Abdulkadri Zinat">

    <title>Admin|<?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url("assets/admin/vendor/fontawesome-free/css/all.min.css") ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url("assets/admin/css/bootstrap.min.css") ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url("assets/admin/css/sb-admin-2.min.css") ?>" rel="stylesheet">

    <!-- Custom styles for table -->
    <link href="<?= base_url("assets/admin/vendor/datatables/dataTables.bootstrap4.min.css") ?>" rel="stylesheet">

    <!-- Alertify CSS -->
    <link href="<?= base_url("assets/plugins/alertify/alertify.min.css") ?>" rel="stylesheet">

    <!-- Default theme From ALertify -->
    <link href="<?= base_url("assets/plugins/alertify/default.min.css") ?>" rel="stylesheet">

    <!-- Place Custom Favicon here -->
    <!-- <link rel="shortcut icon" href="<?= base_url("assets/images/favicon.png") ?>" type="image/png"> -->
    <style>
        .expire-container {
            overflow: hidden;
        }

        .expire {
            animation: animate 7000ms ease-in infinite;
        }

        @keyframes animate {
            from {
                transform: translateX(-40%);
            }

            to {
                transform: translateX(100%);
            }
        }
    </style>
</head>

<body id="page-top">
    <?= $this->renderSection("admin-contents") ?>
    <?= $this->include('partials/admin_footer') ?>


    <!-- This Modal is for showing a single user -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url("assets/admin/vendor/jquery/jquery.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendor/bootstrap/js/bootstrap.bundle.js") ?>"></script>

    <!-- State & LGAS -->
    <script src="<?= base_url("assets/js/lga.js") ?>"></script>

    <!-- Alertify JS -->
    <script src="<?= base_url("assets/plugins/alertify/alertify.min.js") ?>"></script>

    <?php if ($title == 'Dashboard') : ?>
        <script>
            <?php if (errorMessage()) : ?>
                alertify.alert('Error', "<?= errorMessage() ?>", function() {
                    alertify.error('Only authorized users can see the requested page');
                });
            <?php endif; ?>
            <?php if (successMessage()) : ?>
                alertify.alert('Success', "<?= successMessage() ?>", function() {
                    alertify.success('Welcome');
                });
            <?php endif; ?>
        </script>
    <?php endif; ?>

    <?php if ($title == 'Register') : ?>
        <script>
            let adminPassword = document.getElementById('admin_password')
            adminPassword.addEventListener('input', function() {
                let passwordHelpBlock = document.getElementById("passwordHelpBlock");
                passwordHelpBlock.innerText = " Your password must be 8 - 20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji."
            })
        </script>
    <?php endif; ?>

    <?php if ($title == 'Change_password') : ?>
        <script>
            let currentPassword = document.getElementById('current-password')

            currentPassword.addEventListener('input', function() {
                if (currentPassword.value == '') {
                    admin_password = document.getElementById('admin_password').setAttribute('disabled', true);
                    confirm_admin_password = document.getElementById('confirm_admin_password').setAttribute('disabled', true);
                    let currentPasswordHelpBlock = document.getElementById("currentPasswordHelpBlock");
                    currentPasswordHelpBlock.innerText = "Your current password is needed to enable the input fields below";
                } else {
                    admin_password = document.getElementById('admin_password').removeAttribute('disabled');
                    confirm_admin_password = document.getElementById('confirm_admin_password').removeAttribute('disabled');
                    let currentPasswordHelpBlock = document.getElementById("currentPasswordHelpBlock");
                    currentPasswordHelpBlock.innerText = "";
                }

            });

            let togglePwd = document.getElementById("toggle-pwd");
            let icon = document.querySelector("#toggle-pwd i")

            togglePwd.addEventListener('click', () => {
                if (currentPassword.getAttribute('type') == 'password') {
                    currentPassword.setAttribute('type', 'text');
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash')
                } else {
                    currentPassword.setAttribute('type', 'password');
                    icon.classList.add('fa-eye');
                    icon.classList.remove('fa-eye-slash')
                }
            })
        </script>
    <?php endif; ?>

    <?php if ($title == 'Welcome back') : ?>
        <script>
            let currentPassword = document.getElementById('current-password')
            let togglePwd = document.getElementById("toggle-pwd");
            let icon = document.querySelector("#toggle-pwd i")

            togglePwd.addEventListener('click', () => {
                if (currentPassword.getAttribute('type') == 'password') {
                    currentPassword.setAttribute('type', 'text');
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash')
                } else {
                    currentPassword.setAttribute('type', 'password');
                    icon.classList.add('fa-eye');
                    icon.classList.remove('fa-eye-slash')
                }
            })
        </script>
        <?php if (errorMessage()) : ?>
            <script>
                alertify.alert('Error', "<?= errorMessage() ?>", function() {
                    alertify.error('Only authorized users can see the requested page');
                });
            </script>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($title == 'Tenant Details') : ?>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: `<?= base_url("admin/tenant/fetch_rent_date/$tenant->unique_id") ?>`,
                    method: 'get',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data)
                        setInterval(() => {
                            const countDate = new Date(data.end).getTime();
                            const currentTime = new Date().getTime();
                            const getGap = countDate - currentTime;
                            console.log(getGap);

                            // HOW DOES TIME WORK🤔
                            const second = 1000; // A 1000 milliseconds makes a second
                            const minute = second * 60;
                            const hour = minute * 60;
                            const day = hour * 24;

                            // CALCULATE
                            const getDayText = Math.floor(getGap / day);
                            const getHourText = Math.floor((getGap % day) / hour);
                            const getMinuteText = Math.floor((getGap % hour) / minute);
                            const getSecondText = Math.floor((getGap % minute) / second);

                            document.querySelector(".day").innerText = getDayText;
                            document.querySelector(".hour").innerText = getHourText;
                            document.querySelector(".minute").innerText = getMinuteText;
                            document.querySelector(".second").innerText = getSecondText;
                            console.log(getGap);
                            //   if (getGap < 10000) {
                            //     document.body.remove();
                            //   }
                        }, 1000);
                    }
                })
            })
        </script>
    <?php endif; ?>

    <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>

    <!-- Core plugin JavaScript-->
    <script script src="<?= base_url("assets/admin/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>

    <!-- Custom scripts for all pages -->
    <script src="<?= base_url("assets/admin/js/sb-admin-2.min.js") ?>"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url("assets/admin/vendor/datatables/jquery.dataTables.min.js") ?>"></script>
    <script src="<?= base_url("assets/admin/vendor/datatables/dataTables.bootstrap4.min.js") ?>"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <!-- All the codes for making Ajax requests are kept in the file below -->
    <?= view('admin/ajax') ?>

</body>

</html>