{{-- Add User Modal  --}}
<div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="addUserModalForm" action="javascript:void(0)" method="POST">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="add_errList" class="alert alert-danger"></div>
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            class="name form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Last Name</label>
                        <input 
                            type="text" 
                            name="last_name" 
                            class="last_name form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input 
                            type="number" 
                            name="phone" 
                            class="phone form-control"
                        >
                        <span class="error text-danger d-none"></span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input 
                            type="text" 
                            name="email" 
                            class="email form-control"
                        >
                    </div>
                    <div class="form-group mb-3">
                        <label for="role_as">User Role</label>
                        <select 
                            id="role_as" 
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
                            name="password" 
                            class="password form-control"
                        >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_add_btn" data-bs-dismiss="modal">Close</button>
                    <button id="ajaxSaveUser" type="button" class="btn btn-primary add_user">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- End of Add User Modal  --}}