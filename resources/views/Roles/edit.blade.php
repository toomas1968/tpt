@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Role {{ $roles->name }}</div>

                 
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Edit Role

                    
                  <form action=" {{ route('update_roles', $roles->id)}}" method="POST">
                    @csrf 
                    @foreach($claimGroups as $group)
                      <div class="card-header"> {{ $group->name }}</div>
                
                      @foreach($group->claims as $claim)
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" name="claim[]" value="{{ $claim->id }}" {{ $roles->hasClaim($claim->id) ? "checked" : "" }}
>
                          <label class="form-check-label" for="exampleCheck1"> {{ $claim->name }}</label>
                        </div>
                      @endforeach
                    @endforeach
                    <button class="btn-success" type="submit">Submit</button>
                  </form>
                </div>       
            </div>






        </div>
    </div>
</div>
@endsection
