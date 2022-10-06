{{-- Update User Modal  --}}
<div class="modal fade" id="EditUserModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <form action="" method="POST" id="updateUserForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Edit User Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="update_errList" class="alert alert-danger"></div>
                    <input type="hidden" id="edit_user_id">
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input 
                            type="text"
                            id="edit_name" 
                            name="name" 
                            class="name form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Last Name</label>
                        <input 
                            type="text" 
                            id="edit_last_name" 
                            name="last_name" 
                            class="last_name form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input 
                            type="text" 
                            id="edit_phone" 
                            name="phone" 
                            class="phone form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input 
                            type="text"
                            id="edit_email"  
                            name="email" 
                            class="email form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="role_as">User Role</label>
                        <select 
                            id="edit_role_as" 
                            name="role_as"   
                            class="role_as form-control"
                        >
                            <option value="">Select a Role</option>
                            <option value="1">Admin</option>
                            <option value="0">Normal user</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input 
                            type="password" 
                            id="edit_password" 
                            name="password" 
                            class="password form-control"
                        >
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_update_btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_user_btn">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- End of Update User Modal  --}}