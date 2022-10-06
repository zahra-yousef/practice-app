<table class="table">
  <thead>
      <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Edit</th>
          <th>Delete</th>
      </tr>
  </thead>
  <tbody class="table-group-divider">
      @foreach($users as $key=>$user)
      <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->last_name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->phone}}</td>
        <td>
          <button 
            type="button" 
            value={{$user->id}}
            class="btn btn-primary edit_user btn-sm" 
            data-bs-toggle="modal" 
            data-bs-target="#EditUserModal"
            >Edit
          </button>
        </td>
        <td>
          <button 
            type="button" 
            value={{$user->id}}
            class="btn btn-danger delete_user btn-sm"
            data-bs-toggle="modal" 
            data-bs-target="#DeleteUserModal"
            >Delete
          </button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
{!! $users->links() !!}
