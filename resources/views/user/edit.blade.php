@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __('Edit New User') }}</div>
               
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @csrf
                        <div class="row  mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="mb-0">Name</label>
                                    <input id="name" type="name" class="form-control custom-textbox @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autocomplete="name" placeholder="Enter name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" class="mb-0">Email</label>
                                    <input id="email" type="email" class="form-control custom-textbox @error('email') is-invalid @enderror" name="email" value="{{ $user->email}}" required autocomplete="email" placeholder="Enter email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password" class="mb-0">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row  mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password-confirm" class="mb-0">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                </div>
                            </div>
                        </div> -->
                        <div  class="row mb-3">
                            <div class="col-12">
                                <h5>User Access</h5>
                                <div class="row mb-3">
                                    <div class="col-5">
                                        <label class="form-check-label">Product View</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <label class="custom-radio">
                                                <input type="radio" class="form-check-input" id="view_1" value="1" name="view"  @if( !empty($user->access_list->view) ) checked @endif >
                                                <span></span>
                                            </label>
                                            <label class="form-check-label" for="view_1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <label class="custom-radio">
                                                <input type="radio" class="form-check-input" id="view_0" value="0" name="view" @if(empty($user->access_list->view) ) checked @endif>
                                                <span></span>
                                            </label>
                                            <label class="form-check-label" for="view_0">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">
                                        <label class="form-check-label">Product Edit</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <label class="custom-radio">
                                                <input type="radio" class="form-check-input" id="edit_1" value="1" name="edit" @if( !empty($user->access_list->edit) ) checked @endif>
                                                <span></span>
                                            </label>                                    
                                            <label class="form-check-label" for="edit_1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <label class="custom-radio">
                                                <input type="radio" class="form-check-input" id="edit_0" value="0" name="edit" @if( empty($user->access_list->edit) ) checked @endif>
                                                <span></span>
                                            </label>                                    
                                            <label class="form-check-label" for="edit_0">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">
                                        <label class="form-check-label">Product Add</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <label class="custom-radio">
                                                <input type="radio" class="form-check-input" id="add_1" value="1" name="add" @if( !empty($user->access_list->add) ) checked @endif>
                                                <span></span>
                                            </label>                                    
                                            <label class="form-check-label" for="add_1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <label class="custom-radio">
                                                <input type="radio" class="form-check-input" id="add_0" value="0" name="add" @if( empty($user->access_list->add) ) checked @endif>
                                                <span></span>
                                            </label>                                    
                                            <label class="form-check-label" for="add_0">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-5">
                                        <label class="form-check-label">Product Delete</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <label class="custom-radio">
                                                <input type="radio" class="form-check-input" id="delete_1" value="1" name="delete" @if( !empty($user->access_list->delete) ) checked @endif>
                                                <span></span>
                                            </label>                                    
                                            <label class="form-check-label" for="delete_1">Yes</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <label class="custom-radio">
                                                <input type="radio" class="form-check-input" id="delete_0" value="0" name="delete" @if( empty($user->access_list->edit) ) checked @endif>
                                                <span></span>
                                            </label>                                    
                                            <label class="form-check-label" for="delete_0">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-4">
                            <div class="m-auto">
                                <button type="submit" class="btn btn-primary">
                                    INVITE
                                </button>
                            </div>
                        </div>
                    </form>
                 </div>   
             </div>
        </div>
    </div>        
</div>    
@endsection