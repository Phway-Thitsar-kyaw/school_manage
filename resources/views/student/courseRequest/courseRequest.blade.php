@extends('layouts.studentDesign')

@section('content')

    @if(Session::has('authError'))

    <p style="color:red">{{ Session::get('authError')}}</p>

    @endif

    <div class="container">

    <div class="row">
        @if(Session::has('createSuccess'))
        <div class="alert alert-success col-sm-4" role="alert">
        {{ Session::get('createSuccess')}}
        </div>
         @endif
    </div>

    <div class="row justify-content-start">

    <div class="col-6">

    <form action=" {{ route('requestCourse') }} " method="POST">
        @csrf
        <legend class="mb-3"> Course Request </legend>
        <div class="form-group">
            <label> Request Course Title</label>
            <input type="text" name="course_request_title" class="form-control mt-1" value=" {{ old('course_request_title') }} ">
            @if($errors->has('course_request_title'))
            <p style="color:red"> {{ $errors->first('course_request_title') }} </p>
            @endif
        </div><br>
        <div class="form-group">
            <label> Course Request Details</label>
            <textarea class="form-control" rows="3" name="course_request_details" value=" {{ old('course_request_details') }} "></textarea>
            @if($errors->has('course_request_details'))
            <p style="color:red"> {{ $errors->first('course_request_details') }} </p>
            @endif
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Send</button>
      </form>
    </div>
    <div class="col-6">
    </div>
    </div>

    </div>



@endsection

