@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h2>Permission List</h2>
            </div>
            <div class="col-lg-2">
                <a href="{{route("permissions.create")}}" class="btn btn-outline-success">create</a>
            </div>
        </div>
    </div>
    @if($msg = Session::get('success'))
        <div class="alert alert-success">
            {{$msg}}
        </div>
    @endif
    <br>
    <table class="table table-bordered">
            <thead>
            <tr>
                <td><strong>ID</strong></td>
                <td><strong>Name</strong></td>
                <td width="250px"><strong>Action</strong></td>
            </tr>
            </thead>
        @foreach($permissions as $permission)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$permission->name}}</td>
            <td>
                <form action="{{route("permissions.destroy",$permission->id)}}" method="post">
                    @csrf
                    <a href="{{route("permissions.show",$permission->id)}}" class="btn btn-outline-primary">Show</a>
                    <a href="{{route("permissions.edit",$permission->id)}}" class="btn btn-outline-primary">Edit</a>
                    @method("delete")
                    <button class="btn btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{$permissions->links()}}
@endsection
