@extends('layouts.teacherDesign')

@section('content')

    @if(Session::has('authError'))

    <p style="color:red">{{ Session::get('authError')}}</p>

    @endif

    <div class="container">

    @include('teacher.profile.changePasswordError')


    <div class="row">
        <div class="col-8">
            <form action=" {{ route('changePassword') }} " method="POST">
                @csrf
                <legend class="mb-3"> Change Password </legend>
                <div class="form-group">
                    <label> Old Pasword </label>
                    <input type="password" name="old_password" class="form-control mt-1" value="{{ old('old_password')}}">
                </div><br>
                <div class="form-group">
                    <label> New Password </label>
                    <input type="password" name="new_password" class="form-control mt-1" value="{{ old('new_password')}}">
                </div><br>

                <div class="form-group">
                    <label> Comfirm Password </label>
                    <input type="password" name="confirm_password" class="form-control mt-1" value="{{ old('confirm_password')}}">
                </div><br>

                <button type="submit" class="btn btn-secondary">Update</button>
              </form>
        </div>
    </div>

    </div>



@endsection

