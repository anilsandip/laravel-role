@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10"><h2>Users Details</h2></div>
            <div class="col-lg-2">
                <a href="{{route('users.create')}}" class="btn btn-outline-success">Create</a>
            </div>
        </div>
    </div>
    @if($msg=Session::get('success'))
        <div class="alert alert-success">
            {{$msg}}
        </div>
    @endif
    <br>
    <div class="container">
        <table class="table table-bordered table-hover">
            <tr>
                <td><strong>ID</strong></td>
                <td><strong>Name</strong></td>
                <td><strong>Email</strong></td>
                <td><strong>Status</strong></td>
                <td width="250px"><strong>Action</strong></td>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><input type="checkbox" data-toggle="toggle" data-on="Activated" data-off="Deactivated"
                        data-offstyle="danger" data-id="{{$user->id}}" @if($user->id == Auth::id()) checked disabled @endif
                               @if($user->is_active) checked @endif class="status">
                    </td>
                    <td>
                        <form action="{{route("users.destroy",$user->id)}}" method="post">
                            @csrf
                            <a href="{{route("users.show",$user->id)}}" class="btn btn-outline-primary">show</a>
                            <a href="{{route("users.edit",$user->id)}}" class="btn btn-outline-success">Edit</a>
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger" @if($user->id == Auth::id()) disabled @endif>Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{$users->links()}}
    </div>
@endsection
@section('script')
<script>
    let activeurl = "{{route("users.index")}}";
    $(document).on('change','.status',function (event) {
    Swal.fire({
        title: 'Please Wait !',
        html: 'status updating',
        timer: 1000,
        allowOutsideClick: true,
        showConfirmButton:false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
    })
    .then(() =>{

        var id = $(this).data("id");
        $.ajax({
            type : 'get',
            url : activeurl+'/'+id+'/'+'status',
            success:function (){
              console.log('Operation done successfully');
            },

            });

         });
    });

</script>
@endsection
