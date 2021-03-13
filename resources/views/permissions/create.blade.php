@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h2>Create Permission</h2>
            </div>
            <div class="col-lg-2">
                <a href="{{route("permissions.index")}}" class="btn btn-outline-success">Back</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <form action="{{route("permissions.store")}}" method="post">
        @csrf
        <label for="name"><strong>Name</strong></label>
        <input type="text" name="name" placeholder="Enter your Name Here" class="form-control" id="name">
        <br>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
