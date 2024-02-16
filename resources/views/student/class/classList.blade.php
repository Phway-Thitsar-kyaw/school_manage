@extends('layouts.studentDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<div class="container">

<div class="row">

{{ $class->links() }}

</div>

<div class="row">
    @if(Session::has('classStudentAttendSuccess'))
    <div class="alert alert-success col-sm-4" role="alert">
    {{ Session::get('classStudentAttendSuccess')}}
    </div>
    @endif
</div>

<div class="row">

    @foreach( $class as $item )

    <div class=" col-sm-4 mb-3">
      <div class="card border-secondary">
        <div class="card-body">
          <h5 class="card-title"> {{ $item->class_name }} </h5>
          <hr>
          <p class="card-text"> Fee - {{ $item->fee }} </p>
          <p> Class Type :<b> {{ $item->class_type }} </b></p>
          <p>Time : {{ $item->start_date }} - {{ $item->end_date }} </p>
          <p> Teacher - {{ $item->name }} </p>

         <a href=" {{ route('lookClassInformation',[$item->class_id]) }} " class="btn btn-primary"> Look Class Information </a>

        </div>
      </div>
    </div>

    @endforeach

</div>
</div>

@endsection
