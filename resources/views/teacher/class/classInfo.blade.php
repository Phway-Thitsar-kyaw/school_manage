@extends('layouts.teacherDesign')

@section('content')
    @if (Session::has('authError'))
        <p style="color:red">{{ Session::get('authError') }}</p>
    @endif

    <!-- ourse form open -->

    <div class="container">

        @if (Session::has('createClassSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ Session::get('createClassSuccess') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-8">
                <form action=" {{ route('createClass') }} " method="post">
                    @csrf
                    <legend class="mb-3"> Create Class </legend>
                    <div class="form-group">
                        <label for=""> Course Name </label>
                        <select class="form-select" name="course_id" aria-label="Default select example">

                            @foreach ($course as $item)
                                <option value=" {{ $item['course_id'] }} "> {{ $item['course_title'] }} </option>
                            @endforeach

                        </select>
                    </div><br>
                    <div class="form-group">
                        <label> Class Name </label>
                        <input type="text" class="form-control mt-1" name="class_name" value="{{ old('class_name') }}"
                            placeholder="Enter Class Name...">

                    </div><br>
                    <div class="form-group">
                        <label>Course Fee </label>
                        <input type="number" class="form-control mt-1" name="fee" value="{{ old('fee') }}"
                            placeholder="Enter Class Fee...">

                    </div><br>
                    <div class="form-group">
                        <label> Start Time </label>
                        <input type="time" class="form-control mt-1" name="start_time" value="{{ old('start_time') }}"
                            placeholder="Enter Start Time...">

                    </div><br>
                    <div class="form-group">
                        <label> End Time </label>
                        <input type="time" class="form-control mt-1" name="end_time" value="{{ old('end_time') }}"
                            placeholder=" Enter End Time...">

                    </div><br>
                    <div class="form-group">
                        <label> Start Date </label>
                        <input type="date" class="form-control mt-1" name="start_date" value="{{ old('start_date') }}"
                            placeholder=" Enter Start Date...">

                    </div><br>
                    <div class="form-group">
                        <label> End Date </label>
                        <input type="date" class="form-control mt-1" name="end_date" value="{{ old('end_date') }}"
                            placeholder=" Enter End Date...">

                    </div><br>

                    <div class="form-group">
                        <label for=""> Class Type </label>
                        <select class="form-select" name=" class_type" aria-label="Default select example">

                            @if (old('class_type') == 'weekday')
                                <option value="weekday" selected> Weekday Class </option>
                                <option value="weekend">Weekend Class </option>
                            @else
                                <option value="weekday"> Weekday Class </option>
                                <option value="weekend" selected>Weekend Class </option>
                            @endif
                        </select>
                    </div><br>

                    <div class="form-check form-check-inline">
                        @if (old('monday') == 1)
                            <input class="form-check-input" type="checkbox" name="monday" value="1" checked>
                        @else
                            <input class="form-check-input" type="checkbox" name="monday" value="1">
                        @endif
                        <label class="form-check-label" for="">Monday</label>
                    </div>

                    <div class="form-check form-check-inline">
                        @if (old('tueday') == 1)
                            <input class="form-check-input" type="checkbox" name="tueday" value="1" checked>
                        @else
                            <input class="form-check-input" type="checkbox" name="tueday" value="1">
                        @endif
                        <label class="form-check-label" for="">Tuesday</label>
                    </div>

                    <div class="form-check form-check-inline">
                        @if (old('wednesday') == 1)
                            <input class="form-check-input" type="checkbox" name="wednesday" value="1" checked>
                        @else
                            <input class="form-check-input" type="checkbox" name="wednesday" value="1">
                        @endif
                        <label class="form-check-label" for="">Wednesday</label>
                    </div>

                    <div class="form-check form-check-inline">
                        @if (old('thursday') == 1)
                            <input class="form-check-input" type="checkbox" name="thursday" value="1" checked>
                        @else
                            <input class="form-check-input" type="checkbox" name="thursday" value="1">
                        @endif
                        <label class="form-check-label" for="">Thursday</label>
                    </div>

                    <div class="form-check form-check-inline">
                        @if (old('friday') == 1)
                            <input class="form-check-input" type="checkbox" name="friday" value="1" checked>
                        @else
                            <input class="form-check-input" type="checkbox" name="friday" value="1">
                        @endif
                        <label class="form-check-label" for="">Friday</label>
                    </div>

                    <div class="form-check form-check-inline">
                        @if (old('saturday') == 1)
                            <input class="form-check-input" type="checkbox" name="saturday" value="1" checked>
                        @else
                            <input class="form-check-input" type="checkbox" name="saturday" value="1">
                        @endif
                        <label class="form-check-label" for="">Saturday</label>
                    </div>

                    <div class="form-check form-check-inline">
                        @if (old('sunday') == 1)
                            <input class="form-check-input" type="checkbox" name="sunday" value="1" checked>
                        @else
                            <input class="form-check-input" type="checkbox" name="sunday" value="1">
                        @endif
                        <label class="form-check-label" for="">Sunday</label>
                    </div>
                    <br><br>

                    <button type="submit" class="btn btn-secondary">Create Class</button>
                </form>
            </div>
        </div> <br>

    </div>

    <!-- course form close -->
@endsection
