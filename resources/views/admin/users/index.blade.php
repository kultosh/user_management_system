@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">Manage Users</div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                  <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{implode(', ', $user->roles()->get()->pluck('name')->toArray())}}</td>
                    <td>
                      <a href="{{route('admin.users.edit', $user->id)}}" class="float-left"><button class="btn btn-primary btn-sm" name="button">Edit</button></a>
                      <form action="{{route('admin.users.destroy', $user->id)}}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" name="btn" class="btn btn-danger btn-sm">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{ $users->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
