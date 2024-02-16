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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

        @endif


    <div class="row">
        <div class="col-8">
            <form action =" {{ route('updateClass', $class[0]['class_id'] )}} " method="POST">
                @csrf
                <legend class="mb-3"> Update Class </legend>
                <div class="form-group">
                    <label> Class Name </label>
                    <input type="text" name="class_name" class="form-control mt-1" value="{{ old('class_name',$class[0]['class_name']) }}">

                </div><br>
                <div class="form-group">
                    <label> Class Fee </label>
                    <input type="text" name="fee" class="form-control mt-1" value="{{ old('fee', $class[0]['fee']) }}">

                </div><br>
                <div class="form-group">
                    <label> Start Time </label>
                    <input type="time" name="start_time" class="form-control mt-1" value="{{ old('start_time', $class[0]['start_time']) }}">

                </div><br>
                <div class="form-group">
                    <label> End time </label>
                    <input type="time" name="end_time" class="form-control mt-1" value="{{ old('end_time', $class[0]['end_time']) }}">

                </div><br>
                <div class="form-group">
                    <label> Start Date</label>
                    <input type="date" name="start_date" class="form-control mt-1" value="{{ old('start_date', $class[0]['start_date']) }}">

                </div><br>
                <div class="form-group">
                    <label> End Date </label>
                    <input type="date" name="end_date" class="form-control mt-1" value="{{ old('end_date', $class[0]['end_date']) }}">

                </div><br>
                <div class="form-group">
                    <label for=""> Class Type  </label>
                    <select class="form-select" name=" class_type" aria-label="Default select example">

                        @if ($class[0]['class_type'] == "weekday" || old('class_type') == "weekday" )
                        <option value="weekday" selected> Weekday Class </option>
                        <option value="weekend">Weekend Class </option>

                        @elseif ( $class[0]['class_type'] == "weekend" || old('class_type') == "weekend" )
                        <option value="weekday"> Weekday Class </option>
                        <option value="weekend" selected>Weekend Class </option>

                        @endif
                      </select>


                </div><br>
                    <div class="form-check form-check-inline">
                    @if ( $class[0]['monday'] == 1 || old('monday') == 1)
                    <input class="form-check-input" type="checkbox" name="monday" value="1" checked>
                    @else
                    <input class="form-check-input" type="checkbox" name="monday" value="1">
                    @endif
                    <label class="form-check-label" for="">Monday</label>
                    </div>

                    <div class="form-check form-check-inline">
                    @if ( $class[0]['tueday'] == 1 || old('tueday') == 1)
                    <input class="form-check-input" type="checkbox" name="tueday" value="1" checked>
                    @else
                    <input class="form-check-input" type="checkbox" name="tueday" value="1">
                    @endif
                    <label class="form-check-label" for="">Tueday</label>
                    </div>

                    <div class="form-check form-check-inline">
                    @if ( $class[0]['wednesday'] == 1 || old('wednesday') == 1)
                    <input class="form-check-input" type="checkbox" name="wednesday" value="1" checked>
                    @else
                    <input class="form-check-input" type="checkbox" name="wednesday" value="1">
                    @endif
                    <label class="form-check-label" for="">Wednesday</label>
                    </div>

                    <div class="form-check form-check-inline">
                    @if ( $class[0]['thursday'] == 1 || old('thursday') == 1)
                    <input class="form-check-input" type="checkbox" name="thursday" value="1" checked>
                    @else
                    <input class="form-check-input" type="checkbox" name="thursday" value="1">
                    @endif
                    <label class="form-check-label" for="">Thursday</label>
                    </div>

                    <div class="form-check form-check-inline">
                    @if ( $class[0]['friday'] == 1 || old('friday') == 1)
                    <input class="form-check-input" type="checkbox" name="friday" value="1" checked>
                    @else
                    <input class="form-check-input" type="checkbox" name="friday" value="1">
                    @endif
                    <label class="form-check-label" for="">Friday</label>
                    </div>

                    <div class="form-check form-check-inline">
                    @if ( $class[0]['saturday'] == 1 || old('saturday') == 1)
                    <input class="form-check-input" type="checkbox" name="saturday" value="1" checked>
                    @else
                    <input class="form-check-input" type="checkbox" name="saturday" value="1">
                    @endif
                    <label class="form-check-label" for="">Saturday</label>
                    </div>

                    <div class="form-check form-check-inline">
                    @if ( $class[0]['sunday'] == 1 || old('sunday') == 1)
                    <input class="form-check-input" type="checkbox" name="sunday" value="1" checked>
                    @else
                    <input class="form-check-input" type="checkbox" name="sunday" value="1">
                    @endif
                    <label class="form-check-label" for="">Sunday</label>
                    </div><br><br>

                <button type="submit" class="btn btn-secondary"> Update Course</button>
              </form>
        </div>
    </div>

    </div>

    <!-- course form close -->

@endsection
