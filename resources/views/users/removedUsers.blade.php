@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 50px;">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Deleted Users</div>

                
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
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
                    @foreach($deletedUsers as $user)
                        <tr>
                          <th scope="row">{{ $user->id }}</th>
                          <td><a href="{{ route('user_edit', $user->id)}}">{{ $user->name }}</a></td>
                          <td>{{ $user->email }}</td>
                            @foreach($user->roles as $role)
                              <td>{{ $role->name }}</td>
                            @endforeach
                          <td>{{ $user->created_at }}</td>
                          <td>
                            <form method="POST" action="{{ route('restore_user', $user->id)}}">
                              @csrf
                              <button class="btn-error" type="submit">Restore</button>
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
