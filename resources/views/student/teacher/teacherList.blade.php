@extends('layouts.studentDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<div class="container">

<div class="row">

{{ $teacher->links() }}

</div>

<div class="row">

    @foreach ($teacher as $item)

    <div class=" col-sm-4 mb-3">
      <div class="card border-secondary">
        <div class="card-body">
          <h5 class="card-title">Name - {{ $item->name }} </h5>
          <hr>
          <p class="card-text">Phno -  {{ $item->phone_number_one }} </p>

          <p class="card-text"></b>Region - {{ $item->region }} </b></p>

          <a href=" {{ route('lookTeacherCourse',$item->id) }} " class="btn btn-primary">Look Info</a>
        </div>
      </div>
    </div>

@endforeach

</div>
</div>

@endsection



