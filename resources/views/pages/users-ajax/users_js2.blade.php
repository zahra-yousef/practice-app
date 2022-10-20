<script>
    $(function() {
        fetchAllUsers();
        //#1. Show All Users
        function fetchAllUsers() {
            $.ajax({
                type: "GET",
                url:  '{{ route('ajax-users2.show') }}',
                success: function (response) {
                    $("#show_all_users").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        //#2. Insert new User
        $("#add_user_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_user_btn").text('Adding...');
            $.ajax({
                url: '{{ route('ajax-users2.store') }}',
                type: 'POST',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                console.log(response);
                if (response.status == 200) {
                    Swal.fire(
                        'Added!',
                        'User Added Successfully!',
                        'success'
                    )
                    fetchAllUsers();
                }
                $("#add_user_btn").text('Add User');
                $("#add_user_form")[0].reset();
                $("#addUserModal").modal('hide');
                }
            });
        });

        //#3. Show User Info in Update From
        $(document).on('click', '.editIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            $.ajax({
                url: '{{ route('ajax-users2.edit') }}',
                type: 'GET',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $("#name").val(response.name);
                    $("#last_name").val(response.last_name);
                    $("#phone").val(response.phone);
                    $("#email").val(response.email);
                    $("#role_as").val(response.role_as);
                    $("#user_id").val(response.id);
                }
            });
        });

        //#4. Update User Info
        $("#edit_user_form").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#edit_user_btn").text('Updating...');
            $.ajax({
                url: '{{ route('ajax-users2.update') }}',
                type: 'POST',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Updated!',
                            'User Updated Successfully!',
                            'success'
                        )
                        fetchAllUsers();
                    }
                    $("#edit_user_btn").text('Update User');
                    $("#edit_user_form")[0].reset();
                    $("#editUserModal").modal('hide');
                }
            });
        });

        //#5. Delete User Modal
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('ajax-users2.delete') }}',
                        type: 'DELETE',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'User Deleted Successfully!',
                                'success'
                            )
                            fetchAllUsers();
                        }
                    });
                }
            });
        });
    });
</script>