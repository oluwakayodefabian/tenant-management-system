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