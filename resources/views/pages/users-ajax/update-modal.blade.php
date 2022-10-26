{{-- Update User Modal  --}}
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_user_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" id="user_id">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-sm">
              <div class="form-group">
                <label for="name">First Name</label>
                <input 
                    type="text" 
                    id="name"
                    name="name" 
                    class="name form-control" 
                    placeholder="First Name" 
                    required
                >
              </div>
            </div>
            <div class="col-sm">
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input 
                    type="text" 
                    id="last_name"
                    name="last_name" 
                    class="last_name form-control" 
                    placeholder="Last Name" 
                    required
                >
              </div>
            </div>
          </div>
          <div class="my-2">
            <div class="form-group">
              <label for="email">E-mail</label>
              <input 
                type="email" 
                name="email" 
                id="email" 
                class="email form-control" 
                placeholder="E-mail" 
                required
              >
            </div>
          </div>
          <div class="my-2">
            <div class="form-group">
              <label for="phone">Phone</label>
              <input 
                type="number" 
                name="phone" 
                id="phone" 
                class="phone form-control" 
                placeholder="Phone" 
                required
              >
            </div>
          </div>
          <div class="my-2">
            <div class="form-group">
              <label for="role_as">User Role</label>
              <select 
                id="role_as" 
                name="role_as"   
                class="role_as form-control"
                required
              >
                <option value="-1">Select a Role</option>
                <option value="1">Admin</option>
                <option value="0">Normal user</option>
              </select>
            </div>
          </div>
        <div class="my-2">
          <div class="form-group">
            <label for="">Password</label>
            <input 
              type="password" 
              id="password"
              name="password" 
              class="password form-control"
              placeholder="Password" 
              required
            >
          </div>
        </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_user_btn" class="btn btn-success">Update User</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- End of Update User Modal  --}}