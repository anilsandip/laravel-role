@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10"><h2>Role Detail</h2></div>
            <div class="col-lg-2">
                <a href="{{route('roles.index')}}" class="btn btn-outline-success">Back</a>
            </div>
        </div>
    </div>
    <br>
    <br>

    <table class="table">
        <tr>
            <td><strong>ID:</strong></td>
            <td>{{$role->id}}</td>
        </tr>
        <tr>
            <td><strong>Name:</strong></td>
            <td>{{$role->name}}</td>
        </tr>
        <tr>
            <td><strong>Slug:</strong></td>
            <td>{{$role->slug}}</td>
        </tr>
    </table>
@endsection
