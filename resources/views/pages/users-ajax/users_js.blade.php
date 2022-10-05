<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function () {
        fetchUserData();
        $('#success_message').hide();
        $('#add_errList').hide();
        $('#update_errList').hide();

        //#1. Show Users
        function fetchUserData(){
            $.ajax({
                type: "GET",
                url: "/ajax-show-users",
                dataType: "json",
                success: function (response) {
                   // console.log(response.users);
                   $('tbody').html("");
                    if (response.status == 404) {
                        $('tbody').append('<tr>\
                            <td colspan="8">' + 'User data not found' + '</td>\
                        \</tr>');
                    } else {
                        $.each(response.users, function (key, user) {
                            $('tbody').append('<tr>\
                                <td>' + user.id + '</td>\
                                <td>' + user.name + '</td>\
                                <td>' + user.last_name + '</td>\
                                <td>' + user.email + '</td>\
                                <td>' + user.phone + '</td>\
                                <td><button type="button" value="' + user.id + '" class="btn btn-primary edit_user btn-sm">Edit</button></td>\
                                <td><button type="button" value="' + user.id + '" class="btn btn-danger delete_user btn-sm">Delete</button></td>\
                            \</tr>');
                        });
                    }
                }
            });
        }

        //#2. Insert User
        $(document).on('click', '.add_user',function (e) {
            e.preventDefault(); //Prevent page from loading

            $(this).text('Sending..');

            //Create user object from inerted data 
            var user = {
                'name': $('.name').val(),
                'last_name': $('.last_name').val(),
                'phone': $('.phone').val(),
                'email': $('.email').val(),
                'password': $('.password').val(),
            }

        //    console.log(user);
 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/ajax-add-user",
                data: user,
                dataType: "json",
                success: function (response) {
                    if (response.status == 400) {
                        // console.log(response);
                        $('#add_errList').html("");
                        $('#add_errList').show();
                        $.each(response.errors, function (key, err_value) {
                            $('#add_errList').append('<p>' + err_value + '</p>');
                        });
                        $('.add_user').text('Save');
                        $('.btn-close').find('input').val('');
                    }
                    else{
                        $('#add_errList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#success_message').show();
                        $('#AddUserModal').find('input').val('');
                        $('.add_user').text('Save');
                        $('#AddUserModal').modal('hide');
                        fetchUserData();
                    }
                }
            });            
        });

        //#3. Search User
        $(document).on('click', '.search_user',function (e) {
            e.preventDefault(); //Prevent page from loading
          
            var query= $('#search').val();
            $.ajax({
                type: "GET",
                url: "/ajax-search-user",
                data: {'search':query},
                dataType: "json",
                success: function (response) {
                    // console.log(response.users);
                    $('tbody').html("");
                    if (response.status == 404) {
                        $('tbody').append('<tr>\
                            <td colspan="8">' + 'User data not found' + '</td>\
                        \</tr>');
                    } else {
                        $.each(response.users, function (key, user) {
                            $('tbody').append('<tr>\
                                <td>' + user.id + '</td>\
                                <td>' + user.name + '</td>\
                                <td>' + user.last_name + '</td>\
                                <td>' + user.email + '</td>\
                                <td>' + user.phone + '</td>\
                                <td><button type="button" value="' + user.id + '" class="btn btn-primary edit_user btn-sm">Edit</button></td>\
                                <td><button type="button" value="' + user.id + '" class="btn btn-danger delete_user btn-sm">Delete</button></td>\
                            \</tr>');
                        });
                    }
                }
            });            
        });

        //#4. Delete the user
        $(document).on('click', '.delete_user', function () {
            var user_id = $(this).val();
            $('#deleteing_id').val(user_id);
            // console.log('first: ' + user_id);
            $('#DeleteUserModal').modal('show');
        });

        $(document).on('click', '.delete_user_btn',function (e) {
            e.preventDefault();
            var user_id = $('#deleteing_id').val();
            $(this).text('Deleting..');
            // console.log('second: ' + user_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "/ajax-delete-user/" + user_id,
                dataType: "json",
                success: function (response) {
                    // console.log(response.message);
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#success_message').show();
                    $('.delete_user_btn').text('Delete');
                    $('#DeleteUserModal').modal('hide');
                    fetchUserData();
                }
            });
        });
        
        //#5. Update the user
        $(document).on('click', '.edit_user',function (e) {
            e.preventDefault();
            var user_id = $(this).val();
            // console.log(user_id);
            $('#EditUserModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/ajax-show-user/" + user_id,
                success: function (response) {
                    // console.log(response.status);
                    if(response.status == 404){
                        $('#success_message').html("");
                        $('#success_message').addClass('alert alert-danger');
                        $('#success_message').text(response.message);
                        $('#success_message').show();
                        $('#EditUserModal').modal('hide'); 
                    } else {
                        // console.log(response.user);
                        $('#edit_name').val(response.user.name);
                        $('#edit_last_name').val(response.user.last_name);
                        $('#edit_email').val(response.user.email);
                        $('#edit_phone').val(response.user.phone);
                        $('#edit_user_id').val(user_id);
                    }
                }
            });
            $('.btn-close').find('input').val('');
        });

        $(document).on('click', '.update_user_btn',function (e) {
            e.preventDefault();
            $(this).text('Updating..');
            var user_id = $('#edit_user_id').val();
            var user = {
                'name' : $('#edit_name').val(),
                'last_name' : $('#edit_last_name').val(),
                'email' : $('#edit_email').val(),
                'phone' : $('#edit_phone').val(),
                'password' : $('#edit_password').val(),
            }
            // To support put method
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "PUT",
                url: "/ajax-update-user/" + user_id,
                data: user,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if(response.status == 400){
                        $('#update_errList').html("");
                        $('#update_errList').show();
                        $.each(response.errors, function (key, err_value) {
                            $('#update_errList').append('<p>' + err_value + '</p>'); 
                        });
                        $('.update_user_btn').text('Update');
                    }else{
                        // console.log(response.message);
                        $('#update_errList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#success_message').show();
                        $('#update_errList').hide();
                        $('#EditUserModal').find('input').val('');
                        $('.update_user_btn').text('Update');
                        $('#EditUserModal').modal('hide');
                        fetchUserData();
                    }
                }
            });
        });

        //#8. Pagination
        $(document).on("click", "#pagination a,#search_btn", function() {
                //get url and make final url for ajax 
                var url = $(this).attr("href");
                var append = url.indexOf("?") == -1 ? "?" : "&";
                var finalURL = url + append + $("#searchform").serialize();
                //set to current url
                window.history.pushState({}, null, finalURL);
                $.get(finalURL, function(data) {
                    $("#pagination_data").html(data);
                });
                return false;
            });

        //#7. Close the Add & Update Modal
        function closeAddModal(){
            $('#success_message').hide();
            $('#add_errList').html("");
            $('#add_errList').hide();
            $('#AddUserModal').find('input').val('');
            $('.add_user').text('Save');
            $('#AddUserModal').modal('hide');
            fetchUserData();
        }

        function closeUpdateModal(){
            $('#success_message').hide();
            $('#update_errList').html("");
            $('#update_errList').hide();
            $('#EditUserModal').find('input').val('');
            $('.update_user_btn').text('Update');
            $('#EditUserModal').modal('hide');
            fetchUserData();
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