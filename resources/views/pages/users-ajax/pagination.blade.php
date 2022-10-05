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
        @foreach($users as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->last_name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->phone}}</td>
        </tr>
      @endforeach
    </tbody>
</table>

<div id="pagination">
    {{ $users->links() }}
</div>