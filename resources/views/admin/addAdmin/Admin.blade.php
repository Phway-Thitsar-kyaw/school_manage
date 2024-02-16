@extends('layouts.adminDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<div class="container mt-3">
    @if(Session::has('createSuccess'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get( 'createSuccess' )}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header" style="background-color:#ced6e0">
                    <span> Add Admin Account </span>
                    <span>
                        <a href=" {{ route('adminAccountList') }} "><button class="btn btn-sm btn-dark float-end">Admin Account List</button></a>
                    </span>
                </div>
                <div class="card-body">
                    <form action=" {{ route('createAdminAccount')}} " method="post">
                        @csrf
                        <div class="form-group">
                            <label> Name </label>
                            <input type="name" class="form-control" name="name" placeholder="Enter Name" value=" {{ old('name') }}">
                        </div>
                        @if ($errors->has('name'))
                        <p style="color:red">{{ $errors->first('name') }}</p>
                        @endif
                        <br>
                        <div class="form-group">
                            <label> Email </label>
                            <input type="email" class="form-control" name="email" placeholder=" Enter Email" value=" {{ old('email') }}">
                        </div>
                        @if ($errors->has('email'))
                        <p style="color:red">{{ $errors->first('email') }}</p>
                        @endif
                        <br>
                        <div class="form-group">
                            <label> Password </label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Password" value=" {{ old('password') }}">
                        </div>
                        @if ($errors->has('password'))
                        <p style="color:red">{{ $errors->first('password') }}</p>
                        @endif
                        <br>
                        <div class="form-group">
                            <label> Gender </label>
                            <select class="form-control" name="gender" value=" {{ old('gender') }}">
                              <option> Male </option>
                              <option> Female </option>
                            </select>
                          </div>
                          @if ($errors->has('gender'))
                        <p style="color:red">{{ $errors->first('gender') }}</p>
                        @endif
                          <br>
                        <div class="form-group">
                            <label>Date of Birth </label>
                            <input type="date" class="form-control" name="date_of_birth" placeholder=" Enter date of birth" value=" {{ old('date_of_birth') }}">
                        </div>
                        @if ($errors->has('date_of_birth'))
                        <p style="color:red">{{ $errors->first('date_of_birth') }}</p>
                        @endif
                        <br>
                        <div class="form-group">
                            <label> Phno One </label>
                            <input type="number" class="form-control" name="phone_number_one" placeholder="Enter Phno One" value=" {{ old('phone_number_one') }}">
                        </div>
                        @if ($errors->has('phone_number_one'))
                        <p style="color:red">{{ $errors->first('phone_number_one') }}</p>
                        @endif
                        <br>
                        <div class="form-group">
                            <label> Phno Two </label>
                            <input type="number" class="form-control" name="phone_number_two" placeholder="Enter Phno Two" value=" {{ old('phone_number_two') }}">
                        </div>
                        @if ($errors->has('phone_number_two'))
                        <p style="color:red">{{ $errors->first('phone_number_two') }}</p>
                        @endif
                        <br>
                        <div class="form-group">
                            <label> Region </label>
                            <input type="text" class="form-control" name="region" placeholder="Enter Region" value=" {{ old('region') }}">
                        </div>
                        @if ($errors->has('region'))
                        <p style="color:red">{{ $errors->first('region') }}</p>
                        @endif
                        <br>
                        <div class="form-group">
                            <label> Town </label>
                            <input type="text" class="form-control" name="town" placeholder="Enter Town" value=" {{ old('town') }}">
                        </div>
                        @if ($errors->has('town'))
                        <p style="color:red">{{ $errors->first('town') }}</p>
                        @endif
                        <br>
                        <div class="form-group">
                            <label> Address </label>
                            <input type="text" class="form-control" name="address" placeholder="Enter Address" value=" {{ old('address') }}">
                        </div>
                        @if ($errors->has('address'))
                        <p style="color:red">{{ $errors->first('address') }}</p>
                        @endif
                        <br>

                        <button type="submit" class="btn btn-primary"> Create Account </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
