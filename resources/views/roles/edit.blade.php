@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10"><h2>Roles of Users</h2></div>
            <div class="col-lg-2">
                <a href="{{route('roles.index')}}" class="btn btn-outline-success">Back</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div>
        <form action="{{route('roles.update',$role->id)}}" method="post">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Enter Your Name" class="form-control" value="{{$role->name}}">
            <br>
            <button type="submit" class="btn btn-primary" value="Create">Update</button>

        </form>
    </div>

@endsection
