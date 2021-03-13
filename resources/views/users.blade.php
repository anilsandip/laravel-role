@extends('layouts.app')
@section('content')
    <div><h2>Users List</h2></div>
    <br>
    <table class="table table-bordered">
        <tr>
            <td>id:</td>
            <td>Name:</td>
            <td>Email:</td>
            <td>status:</td>
        </tr>

            @php
            $i=1;
            @endphp
        @foreach($users as $user)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <input type="checkbox" value="1" name="Status" data-toggle="toggle" data-on='Active' class="is-active"
                           data-off="Deactive" data-offstyle="danger" data-id="{{$user->id}}"
                            @if($user->id == Auth::id())checked disabled @endif
                            @if($user->is_active) checked @endif>
                </td>
            </tr>
        @endforeach

    </table>
@endsection
@section('script')
    <script>
         let activeurl = "{{url('users')}}";
        $(document).on('change', '.is-active', function (event) {
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                type : 'get',
                url : activeurl+'/'+id+'/'+'status',
                success:function ()
                {
                    console.log('status passed successfully');
                }
            });
        });

    </script>
@endsection

