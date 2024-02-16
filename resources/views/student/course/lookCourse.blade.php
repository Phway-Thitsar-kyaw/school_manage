@extends('layouts.studentDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<div class="container">

<legend> Teacher - {{ $courseData[0]->name}} </legend>

<div class="row">

    <div class=" col-sm-4 mb-3">
      <div class="card border-secondary">
        <div class="card-body">
          <div class="alert alert-primary" role="alert">
          <h5 class="card-title "> <label> Course Title - </label> {{ $courseData[0]->course_title }} </h5>
          </div><hr>
          <p class="card-text"> {{ $courseData[0]->course_explanation }} </p>
          <hr>
          <p class="card-text"> {{ $courseData[0]->course_details }} </b></p>
        </div>
      </div>
    </div>

</div>

<button class= "btn btn-secondary" onclick="goBack()"> Back </button>
<br><br>


<!-- related class -->

<div class="row">

    <legend> Related Class </legend>

    <hr>

    <div class="row">
        @if(Session::has('classStudentAttendSuccess'))
        <div class="alert alert-success col-sm-4" role="alert">
        {{ Session::get('classStudentAttendSuccess')}}
        </div>
        @endif
    </div>

    @if( $relatedClass != null )

    @foreach( $relatedClass as $item )

    <div class=" col-sm-4 mb-3">
      <div class="card border-secondary">
        <div class="card-body">
          <h5 class="card-title"> {{ $item->class_name }} </h5>
          <hr>
          <p class="card-text"> Fee - {{ $item->fee }} </p>
          <p> Class Type :<b> {{ $item->class_type }} </b></p>
          <p> Time : {{ $item->start_date }} - {{ $item->end_date }} </p>

          <a href=" {{ route('lookClassInformation',[$item->class_id]) }} " class="btn btn-primary"> Look Class Information </a>

        </div>
      </div>
    </div>

    @endforeach

    @else

    <div class="alert alert-danger col-sm-4" role="alert">
    There is no Class for this course!
    </div>

    @endif
</div>
<div style="height:50vh;"></div>
</div>

@endsection
<script>
    function goBack(){
        window.history.back();
    }
</script>
