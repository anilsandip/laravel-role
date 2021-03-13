@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10"><h2>Create Roles</h2></div>
            <div class="col-lg-2">
                <a href="{{route('roles.index')}}" class="btn btn-outline-success">Back</a>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div>
        <form action="{{route('roles.store')}}" method="post">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" placeholder="Enter Your Name" class="form-control">
            <br>
            <label >Permissions:</label><br>
            @foreach($permissions as $permission)
            <input type="checkbox" name="permissions[]" id="permission[{{$permission->id}}]" value={{$permission->id}}>
            <label for="permission[{{$permission->id}}]">{{$permission->name}}</label><br>
            @endforeach
            <br>
            <button type="submit" class="btn btn-primary" value="Create">Create</button>

        </form>
    </div>
@endsection
