<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#Id</th>
        <th scope="col">Username</th>
        <th scope="col">Date Added</th>
        <th scope="col">Date Updated</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <th scope="row">{{ $loop->index + 1 }}</th>
          <td>{{ $user->username }}</td>
          <td>{{ $user->created_at }} </td>
          <td>{{ $user->updated_at }} </td>
          <td>
            <input type="hidden" class="username" value="{{$user->username}}">
            <input type="hidden" class="userId" value="{{$user->_id}}">
            <button class="btn btn-primary btn-sm editUser" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" wire:submit.prevent='editUser()' id="editForm">
        <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" id="username" class="form-control" wire:model='username' />
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input id="password" type="password" class="form-control password" wire:model='password' />
            </div>
            <div class="form-check">
              <input class="form-check-input showPassword" type="checkbox" />
              <label class="form-check-label"> Show password </label>
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" wire:submit class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>
  <script>
    $('.editUser').on('click', (e)=>{
        let id = e.target.parentElement.getElementsByClassName('userId')[0].value;
        let username = e.target.parentElement.getElementsByClassName('username')[0].value;
        // $('#userId').val(id);
        $('#username').val(username);
        $('#editForm').attr('wire:submit.prevent', `editUser(@json('${id}'))`);

    })
  </script>
</div>
