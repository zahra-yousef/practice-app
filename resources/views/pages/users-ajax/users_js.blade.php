<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
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
        jQuery.validator.addMethod("lettersonly", function(value, element) 
        {
            return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
        }, "The name format is invalid..");

        $('#add_user_form').validate({ 
            rules: {
                name: {
                    required: true,  
                    minlength: 3,
                    maxlength: 191,
                    lettersonly: true,
                },
                last_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersonly: true,
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10,   
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 255,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                role_as: {
                    required: true,
                    min: 0,
                },
            },
            messages: {
                name: {
                    required: "The name field is required..",
                    minlength: "The name must be at least 3 characters..",
                    maxlength: "The name must not be greater than 191 characters.."
                },
                last_name:{
                    required: "The last name field is required..",
                    minlength: "The last name must be at least 3 characters..",
                    maxlength: "The last name must not be greater than 191 characters.."
                },
                phone: {
                    required: "The phone field is required..",
                    digits: "The phone must be a number..",
                    minlength: "The phone must be 10 digits..",
                    maxlength: "The phone must be 10 digits..",
                    max: "The phone must not exceed 2147483647",
                },
                email: {
                    required: "The email field is required..",
                    email: "The email must be a valid email address..",
                },
                password: {
                    required: "The password field is required..",
                    minlength: "The password must be at least 8 characters..",
                },
                role_as: {
                    required: "The role field is required..",
                    min: "The role field is required..",
                }
            },
            errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                
                const fd = new FormData(form);

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
                            $("#add_user_form")[0].reset();
                            $("#addUserModal").modal('hide');
                            $(document).find('span.invalid-feedback').remove();
                            $(document).find('span.error-msg').remove();
                        }else{
                            $.each(response.errors, function (key, err_value) {
                                $(document).find('[name='+key+']').after('<span class="error-msg text-strong text-danger"><p>' + err_value + '</p></span>');
                            });
                        }
                        $("#add_user_btn").text('Add User'); 
                    }
                });
            }
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
        $('#edit_user_form').validate({ 
            rules: {
                name: {
                    required: true,  
                    minlength: 3,
                    maxlength: 191,
                    lettersonly: true,
                },
                last_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 191,
                    lettersonly: true,
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10,   
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 255,
                },
                password: {
                    minlength: 8,
                },
                role_as: {
                    required: true,
                    min: 0,
                },
            },
            messages: {
                name: {
                    required: "The name field is required..",
                    minlength: "The name must be at least 3 characters..",
                    maxlength: "The name must not be greater than 191 characters.."
                },
                last_name:{
                    required: "The last name field is required..",
                    minlength: "The last name must be at least 3 characters..",
                    maxlength: "The last name must not be greater than 191 characters.."
                },
                phone: {
                    required: "The phone field is required..",
                    digits: "The phone must be a number..",
                    minlength: "The phone must be 10 digits..",
                    maxlength: "The phone must be 10 digits..",
                    max: "The phone must not exceed 2147483647",
                },
                email: {
                    required: "The email field is required..",
                    email: "The email must be a valid email address..",
                },
                password: {
                    minlength: "The password must be at least 8 characters..",
                },
                role_as: {
                    required: "The role field is required..",
                    min: "The role field is required..",
                }
            },
            errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                const fd = new FormData(form);
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
                            $("#editUserModal").modal('hide');
                            $(document).find('span.invalid-feedback').remove();
                            $(document).find('span.error-msg').remove();
                        }else{
                            $.each(response.errors, function (key, err_value) {
                                $(document).find('[name='+key+']').after('<span class="error-msg text-strong text-danger"><p>' + err_value + '</p></span>');
                            });
                        }
                        $("#edit_user_btn").text('Update User');
                    }
                });
            }
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