@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    This is Users page. You can create and edit Users

                    <a class="btn-success" href="{{ route('create_user') }}">Add User</a>
                </div>
                
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">User Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Role</th>
                      <th scope="col">Created Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                        <tr>
                          <th scope="row">{{ $user->id }}</th>
                          <td><a href="{{ route('user_edit', $user->id)}}">{{ $user->name }}</a></td>
                          <td>{{ $user->email }}</td>
                            @foreach($user->roles as $role)
                              <td>{{ $role->name }}</td>
                            @endforeach
                          <td>{{ $user->created_at }}</td>
                          <td>
                            <form method="POST" action="{{ route('delete_user', $user->id)}}">
                              @csrf
                            
                              <button class="btn-error" type="submit">Delete</button>
                            </form>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
