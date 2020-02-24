@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Roles</div>

                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    This is Roles page. You can create and edit Roles

                    <a class="btn-success" href="{{ route('add_role') }}">Add Role</a>
                </div>
                
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Created Time</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($roles as $role)
                        <tr>
                          <th scope="row">{{ $role->id }}</th>
                          <td><a href="{{ route('editRoles', $role->id) }}">{{ $role->name }}</a></td>
                          <td>{{ $role->description }}</td>
                          <td>{{ $role->created_at }}</td>
                          <td>
                            <form method="POST" action="{{ route('delete_role', $role->id) }}">
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
