@extends('layouts.teacherDesign')

@section('content')



    @if(Session::has('authError'))

    <p style="color:red">{{ Session::get('authError')}}</p>

    @endif

    <!-- ourse form open -->

    <div class="container">

         @if(Session::has('updateSuccess'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get( 'updateSuccess' )}}
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

        @endif


    <div class="row">
        <div class="col-8">
            <form action="  {{ route('courseUpdate', $courseData[0]->course_id) }}  " method="post">
                @csrf
                <legend class="mb-3"> Update Course </legend>
                <div class="form-group">
                    <label>Course Title</label>
                    <input type="text" name="course_title" class="form-control mt-1" value="{{ old('course_title', $courseData[0]->course_title )}}">

                </div><br>

                <div class="form-group">
                    <label>Course Explanation</label>
                    <textarea class="form-control mt-1" name="course_explanation" > {{ old('course_explanation', $courseData[0]->course_explanation )}} </textarea>

                </div><br>

                <div class="form-group">
                    <label>Course Details</label>
                    <textarea class="form-control mt-1" name="course_details"> {{ old('course_details', $courseData[0]->course_details) }} </textarea>

                </div><br>

                <button type="submit" class="btn btn-secondary"> Update Course</button>
              </form>
        </div>
    </div>

    </div>

    <!-- course form close -->

@endsection
