@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10"><h2>User Details</h2></div>
            <div class="col-lg-2">
                <a href="{{route('users.index')}}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
    </div>
    <br>

        <table class="table table-bordered table-hover align-content-center container">
            <tr>
                <td><strong>ID</strong></td>
                <td>{{$user->id}}</td>
            </tr>
            <tr>
                <td><strong>Name</strong></td>
                <td>{{$user->name}}</td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td>{{$user->email}}</td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td> {{$user->is_active? "Active": "Inactive" }} </td>
            </tr>



@endsection
