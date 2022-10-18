<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#success_message').hide();
        $('#add_errList').hide();
        $('#update_errList').hide();

        //#1. Insert User
        $(document).on('click', '.add_user',function(e) {
            e.preventDefault();

            //Create user object from inserted data 
            var user = {
                'name': $('.name').val(),
                'last_name': $('.last_name').val(),
                'phone': $('.phone').val(),
                'email': $('.email').val(),
                'password': $('.password').val(),
                'role_as': $('.role_as').find(":selected").val(),
            }

            // console.log(user.name);
            $.ajax({
                type: "POST",
                url:"{{ route('ajax-users.store') }}",
                data: user,
                success: function (response) {
                    if(response.status == 200){
                        $('#add_errList').html("");
                        $('#add_errList').hide();
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#success_message').show();
                        $('#AddUserModal').modal('hide');
                        $('#addUserForm')[0].reset(); //clean modal inputs
                        $('.table').load(location.href+' .table');
                    }else{
                        $('#add_errList').html("");
                        $('#add_errList').show();
                        $.each(response.errors, function (key, err_value) {
                            $('#add_errList').append('<p>' + err_value + '</p>');
                        });
                    }
                }
            });
        });

        //#2. Show User Info in Update From
        $(document).on('click', '.edit_user',function (e) {
            e.preventDefault();
            var user_id = $(this).val();
            console.log("u_id:"+user_id);
            
            $.ajax({
                type: "GET",
                url: "/ajax-show-user/" + user_id,
                success: function (response) {
                    console.log(response.message);
                    if(response.status == 404){
                        console.log(response.user);
                        $('#EditUserModal').modal('hide'); 
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                        $('#success_message').show();
                    } else {
                        console.log(response.user);
                        $('#edit_name').val(response.user.name);
                        $('#edit_last_name').val(response.user.last_name);
                        $('#edit_email').val(response.user.email);
                        $('#edit_phone').val(response.user.phone);
                        $('#edit_user_id').val(user_id);
                        $role_as_value = response.user.role_as;
                        $('#edit_role_as option[value='+$role_as_value+']').attr('selected', 'selected');
                    }
                }
            });
            $('.btn-close').find('input').val('');
        });

        //#3. Update User Info
        $(document).on('click', '.update_user_btn',function (e) {
            e.preventDefault();

            var user_id = $('#edit_user_id').val();

            var user = {
                'name' : $('#edit_name').val(),
                'last_name' : $('#edit_last_name').val(),
                'email' : $('#edit_email').val(),
                'phone' : $('#edit_phone').val(),
                'password' : $('#edit_password').val(),
                'role_as': $('#edit_role_as').find(":selected").val(),
            }

            $.ajax({
                type: "PUT",
                url:"{{ route('ajax-users.update', '')}}"+"/"+user_id,
                data: user,
                success: function (response) {
                    if(response.status == 200){
                        $('#update_errList').html("");
                        $('#update_errList').hide();
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#success_message').show();
                        $('#EditUserModal').modal('hide');
                        $('#updateUserForm')[0].reset(); //clean modal inputs
                        $('.table').load(location.href+' .table');
                    }else{
                        $('#update_errList').html("");
                        $('#update_errList').show();
                        $.each(response.errors, function (key, err_value) {
                            $('#update_errList').append('<p>' + err_value + '</p>');
                        });
                    }
                }
            });
        });

        //#4. Show Delete User Modal
        $(document).on('click', '.delete_user', function () {
            var user_id = $(this).val();
            $('#deleteing_id').val(user_id);
            console.log('delete id: ' + user_id);
        });

        //#5. Delete User
        $(document).on('click', '.delete_user_btn',function (e) {
            e.preventDefault();
            var user_id = $('#deleteing_id').val();
          
            $.ajax({
                type: "DELETE",
                url: "{{ route('ajax-users.destroy', '')}}"+"/"+user_id,
                dataType: "json",
                success: function (response) {
                    // console.log(response.message);
                    $('.table').load(location.href+' .table');
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#success_message').show();
                    $('#DeleteUserModal').modal('hide');
                }
            });
        });

        //#6. Search User
        $(document).on('keyup', function (e) {
            e.preventDefault();
            var search_string = $('#search').val();
            console.log(search_string);
            $.ajax({
                type: "GET",
                url: "{{ route('ajax-users.search') }}",
                data: {'serach_string':search_string},
                success: function (res) {
                    $('.table-data').html(res);
                    
                    if(res.status == 'nothing_found'){
                        $('.table-data').html('<span class="text-danger">'+'Nothing Found'+'</span>');
                    }
                }
            });
        });

         //#5. Pagination
         $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            user(page);
        });
        function user(page){
            $.ajax({
                url: "ajax-users?page="+page,
                success: function (res) {
                    // console.log(res);
                    $('.table-data').html(res);
                }
            });
        }

        //#7. Close the Add & Update Modal
        function closeAddModal(){
            $('#success_message').hide();
            $('#add_errList').html("");
            $('#add_errList').hide();
            $('#AddUserModal').find('input').val('');
            $('.add_user').text('Save');
            $('#AddUserModal').modal('hide');
        }

        function closeUpdateModal(){
            $('#success_message').hide();
            $('#update_errList').html("");
            $('#update_errList').hide();
            $('#EditUserModal').find('input').val('');
            $('.update_user_btn').text('Update');
            $('#EditUserModal').modal('hide');
        }

        $(document).on('click', '.btn-close', function () {
            closeAddModal();
            closeUpdateModal();
        });

        $(document).on('click', '.close_add_btn', function () {
            closeAddModal();
        });

        $(document).on('click', '.close_update_btn', function () {
            closeUpdateModal();
        });
    });
</script>