@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10"><h2>Create User</h2></div>
            <div class="col-lg-2">
                <a href="{{route('users.index')}}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
    <form action="{{route('users.store')}}" method="post">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Name">
        <label for="email">Email:</label>
        <input type="text" name="email" class="form-control" placeholder="Enter email">
        <label for="password">Password:</label>
        <input type="password" name="password" class="form-control" placeholder="Enter Password">
        <label for="role">Select Role:</label>
        <select name="roles" class="form-control" id="role">
            @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
        <br>
        <br>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
    </div>
@endsection
@section("script")
    <script>
    $(document).ready(function() {
    $('#role').select2({
        placeholder : "Select a businesses",

    });
    });
    </script>
@endsection
