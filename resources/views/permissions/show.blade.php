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

    <table class="table table-bordered">
        <tr>
            <td><strong>Name:</strong></td>
            <td>{{$permission->name}}</td>
        </tr>
    </table>
@endsection
