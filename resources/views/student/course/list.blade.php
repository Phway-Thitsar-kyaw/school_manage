@extends('layouts.studentDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<div class="container">

<div class="row">

{{ $course->links() }}

</div>

<div class="row">

@foreach ($course as $item)

    <div class=" col-sm-4 mb-3">
      <div class="card border-secondary">
        <div class="card-body">
          <div class="alert alert-primary" role="alert">
          <h5 class="card-title"> {{ $item->course_title }} </h5>
          </div>
          <p class="card-text"> {{ $item->course_explanation }} </p>

          <p class="card-text"><b> {{ $item->course_details }} </b></p>

          <p> Teacher- <b>{{ $item->name }} </b></p>
          <a href=" {{ route('lookCourse',$item->course_id )}} " class="btn btn-primary">Look Info</a>
        </div>
      </div>
    </div>

@endforeach
</div>
</div>

@endsection
