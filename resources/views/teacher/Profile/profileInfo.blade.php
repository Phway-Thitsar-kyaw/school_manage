@extends('layouts.teacherDesign')

@section('content')

    @if(Session::has('authError'))

    <p style="color:red">{{ Session::get('authError')}}</p>

    @endif

    <div class="container">

        @if(Session::has('updateSuccess'))

            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get( 'updateSuccess' )}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>

         @endif


    <div class="row">
        <div class="col-8">
            <form action="  {{ route('updateProfile', $teacherInfo[0]['id'] )}} " method="POST">
                @csrf
                <legend class="mb-3"> Edit Profile </legend>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control mt-1" value=" {{ old('name', $teacherInfo[0]['name']) }} ">
                </div><br>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control mt-1" value=" {{ old('email', $teacherInfo[0]['email']) }} ">
                </div><br>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control mt-1"  value="{{ old('date_of_birth', $teacherInfo[0]['date_of_birth']) }}">
                </div><br>
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="gender">
                        @if ($teacherInfo[0]['gender'] == "male")
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>
                        @else
                        <option value="male">Male</option>
                        <option value="female" selected>Female</option>
                        @endif
                    </select>
                </div><br>
                <div class="form-group">
                    <label>Primary Phone number</label>
                    <input type="number" name="phone_number_one" class="form-control mt-1" value="{{ old('phone_number_one', $teacherInfo[0]['phone_number_one']) }}">
                </div><br>
                <div class="form-group">
                    <label>Secondary Phone Number</label>
                    <input type="number" name="phone_number_two" class="form-control mt-1" value="{{ old('phone_number_two', $teacherInfo[0]['phone_number_two']) }}">
                </div><br>
                <div class="form-group">
                    <label>Region</label>
                    <input type="text" name="region" class="form-control mt-1" value="{{ old('region', $teacherInfo[0]['region']) }}">
                </div><br>
                <div class="form-group">
                    <label>Town</label>
                    <input type="text" name="town" class="form-control mt-1" value="{{ old('town', $teacherInfo[0]['town']) }}">
                </div><br>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control mt-1" value="{{ old('address', $teacherInfo[0]['address']) }}">
                </div><br>

                <a href=" {{ route('changePassword')}} ">Change Password</a><br><br>

                <button type="submit" class="btn btn-secondary">Update</button>
              </form>
        </div>
    </div>

    </div>



@endsection

