@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row">
        <div class="col-6">
            <a href="{{route('user.create')}}">Add User</a>
        </div> 
        <div class="ml-auto">
            <a href="{{route('home')}}">Back</a>
        </div>  
         
    </div>
        <table class="table text-center" id="user_table">
        @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                @endif
            <thead class="dark-color">
                <tr>
                    <th>Sr. no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>View</th>
                    <th>Edit</th>
                    <th>Add</th>
                    <th>Delete</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table table-bordered">
                @if(count($users)>0)
                    @foreach($users as $user)
                        <tr>
                        <td>{{ $no++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->access_list->view==1?"Yes":"No" }}</td>
                            <td>{{ $user->access_list->edit==1?"Yes":"No" }}</td>
                            <td>{{ $user->access_list->add==1?"Yes":"No" }}</td>
                            <td>{{ $user->access_list->delete==1?"Yes":"No" }}</td>
                            <td><a href="{{ route('user.edit', $user->id)}}">Edit</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8"> No record found</td>
                    </tr>
                @endif
            </tbody>
        </table> 
    </div>   
@endsection