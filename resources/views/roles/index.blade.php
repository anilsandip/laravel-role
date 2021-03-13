@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10"><h2>Roles of Users</h2></div>
            <div class="col-lg-2">
                <a href="{{route('roles.create')}}" class="btn btn-outline-success">Create</a>
            </div>
        </div>
    </div>
    @if($msg = session()->get('success'))
       <div class="alert alert-success">
           {{$msg}}
       </div>

    @endif
<br>

        <table class="table table-bordered" id="roletable">
            <thead>
            <tr>
                <td><strong>Id</strong></td>
                <td><strong>Name</strong></td>
                <td><strong>Slug</strong></td>
                <td><strong>Permission</strong></td>
                <td width="250px">Action</td>
            </tr>
            </thead>

{{--                @php--}}
{{--                    $i=1;--}}
{{--                @endphp--}}
{{--                @foreach($roles as $role)--}}
{{--                <tr>--}}

{{--                    <td>{{$i++}}</td>--}}
{{--                    <td>{{$role->name}}</td>--}}
{{--                    <td>{{$role->slug}}</td>--}}
{{--                    <td>--}}

{{--                        <form action="{{route('roles.destroy',$role->id)}}" method="post">--}}
{{--                            @csrf--}}
{{--                            <a href="{{route('roles.show',$role->id)}}" class="btn btn-outline-primary">show</a>--}}
{{--                            <a href="{{route('roles.edit',$role->id)}}" class="btn btn-outline-primary">edit</a>--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="submit" class="btn btn-outline-danger deleteRole" data-id="{{$role->id}}">delete</button>--}}
{{--                        </form>--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                @endforeach--}}

        </table>

@endsection
@section('script')
    <script>

        $(function() {
            // $.noConflict();
            $('#roletable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('roles.index') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    { data: 'permission', name: 'permission' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });
        });
        $('#roletable').on('click', '.btn-delete[data-remote]', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = $(this).data('remote');
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    // data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                    $('#roletable').DataTable().draw(false);
                });
            }else
                alert("You have cancelled!");
        });
    </script>
@endsection

