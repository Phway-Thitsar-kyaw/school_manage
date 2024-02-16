@extends('layouts.teacherDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<!-- ourse form open -->

<div class="container">

@if(Session::has('courseSuccess'))

<div class="alert alert-warning alert-dismissible fade show" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true"&times;></span>
</button>
<p style="color:red"> {{Session::get('courseSuccess')}} </p>
</div>

@endif

<div class="row">
    <div class="col-8">
        <form action=" {{ route('createCourse') }}" method="post">
            @csrf
            <legend class="mb-3"> Create Course </legend>
            <div class="form-group">
                <label>Course Title</label>
                <input type="text" name="course_title" class="form-control mt-1" value="{{ old('course_title') }}"  placeholder="Enter Course Title...">

            </div><br>

            <div class="form-group">
                <label>Course Explanation</label>
                <textarea class="form-control mt-1" name="course_explanation" value="{{ old('course_explanation') }}" placeholder="Enter Course Explanation..."></textarea>

            </div><br>

            <div class="form-group">
                <label>Course Details</label>
                <textarea class="form-control mt-1" name="course_details" value="{{ old('course_details') }}" placeholder="Enter Course Details..."></textarea>

            </div><br>

            <button type="submit" class="btn btn-secondary">Create Course</button>
          </form>
    </div>
</div>

</div>

<!-- course form close -->


@endsection
