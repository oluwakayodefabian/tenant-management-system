<?php if ($title == 'Users | manage') : ?>
    <!-- For Users -->
    <script>
        // Get Users from the database using ajax
        $(document).ready(function() {
            let adninUsersTable = $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?= base_url('admin/users/fetch_users') ?>',
                columnDefs: [{
                        targets: -1,
                        orderable: false
                    }, //target -1 means last column
                ]
            });
        });

        // Delete Users
        $(document).on("click", "#deleteUser", function() {
            const deleteID = $(this).attr('value');
            if (deleteID == '') {
                alert("Id cannot be empty!");
            } else {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger mr-3'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?= base_url("admin/users/delete_user") ?>",
                            dataType: "json",
                            method: "POST",
                            data: {
                                deleteID: deleteID
                            },
                            success: function(data) {
                                if (data.response == 'success') {
                                    swalWithBootstrapButtons.fire(
                                        'Deleted!',
                                        'Admin Account has been deleted.',
                                        'success'
                                    )
                                    // reload Admin users table
                                    adminUsersTable.ajax.reload();
                                }
                            }
                        })

                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'User Account is safe :)',
                            'error'
                        )
                    }
                })
            }
        });
    </script>
<?php endif; ?>


<script>
    // fetch single user
    $.ajax({
        url: "<?= base_url('admin/users/profile') ?>",
        dataType: 'json',
        success: function(data) {
            console.log(data)
            let card = `
                <div class="card" style="width: 28rem;">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted"><strong>Full name: </strong>${data.first_name} ${data.last_name}</h6>
                        <p class="card-text"><strong>Email: </strong>${data.admin_email}</p>
                        <p class="card-text"><strong>Current Role: </strong>${data.admin_type}</p>
                    </div>
                </div>
                `

            $("#modal-body").html(card);
        }
    })
</script>



<?php if ($title == 'admin|property|manage') : ?>
    <script>
        $(document).ready(function() {
            $('#propertyTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?= base_url('admin/property/fetch_properties') ?>',
                columnDefs: [{
                        targets: -1,
                        orderable: false
                    }, //target -1 means last column
                ]
            });

            // Delete Member
            $(document).on("click", "#deleteMember", function() {
                let meta = document.querySelectorAll("meta")[0];
                let tokenHash = meta.content;
                const deleteID = $(this).attr('value');
                console.log(deleteID)
                if (deleteID == '') {
                    alert("Id cannot be empty!");
                } else {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger mr-3'
                        },
                        buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                // Pass the CSRF token to the header to allow AJAX functionality
                                headers: {
                                    'X-CSRF-Token': tokenHash
                                },
                                url: "<?= base_url("admin/member/delete") ?>",
                                dataType: "json",
                                method: "POST",
                                data: {
                                    deleteID: deleteID
                                },
                                success: function(data) {
                                    if (data.response == 'success') {
                                        swalWithBootstrapButtons.fire(
                                            'Deleted!',
                                            'A Member\' information has been deleted.',
                                            'success'
                                        )
                                        window.location = "<?= base_url('admin/member/manage') ?>"
                                    }
                                }
                            })

                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'Member is safe :)',
                                'error'
                            )
                        }
                    })
                }
            });
        });
    </script>
<?php endif; ?>

<?php if ($title == 'admin|landlord|manage') : ?>
    <script>
        $(document).ready(function() {
            $('#landlordTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?= base_url('admin/landlord/fetch_landlords') ?>',
                columnDefs: [{
                        targets: -1,
                        orderable: false
                    }, //target -1 means last column
                ]
            });
        });
    </script>
<?php endif; ?>

<?php if ($title == 'Admin|Manage|Tenants') : ?>
    <script>
        $(document).ready(function() {
            $('#tenantTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?= base_url('admin/tenant/fetch_tenants') ?>',
                columnDefs: [{
                        targets: -1,
                        orderable: false
                    }, //target -1 means last column
                ]
            });
        });
    </script>
<?php endif; ?>