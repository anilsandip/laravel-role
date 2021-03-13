@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10"><h2>Edit User Detail</h2></div>
            <div class="col-lg-2">
                <a href="{{route('users.index')}}" class="btn btn-outline-primary">Back</a>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <form action="{{route('users.update',$user->id)}}" method="post">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$user->name}}">
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control" placeholder="Enter email" value="{{$user->email}}">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" value="You cant change Password!" @if($user->id !== Auth::id()) disabled @endif>
            <br>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
