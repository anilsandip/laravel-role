@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h2>Permission List</h2>
            </div>
            <div class="col-lg-2">
                <a href="{{route("permissions.index")}}" class="btn btn-outline-success">Back</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <form action="{{route("permissions.update",$permission->id)}}" method="post">
        @csrf
        @method("PUT")
        <label for="name"><strong>Name</strong></label>
        <input type="text" name="name" placeholder="Enter your Name Here" class="form-control" id="name" value="{{$permission->name}}">
        <br>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
