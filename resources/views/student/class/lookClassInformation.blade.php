@extends('layouts.studentDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<div class="container">

<div class="row">

    <div class=" col-sm-4 mb-3">
      <div class="card border-secondary">
        <div class="card-body">
          <div class="alert alert-primary" role="alert">
          <h5 class="card-title "> <label> Class Title - {{$class[0]->class_name}} </label></h5>
          </div><hr>
          <p class="card-text"> Class Fee - {{ $class[0]['fee']}} </p>
          <hr>
          <p class="card-text"> Class Start Time - {{ $class[0]['start_time']}} </b></p>
          <hr>
          <p class="card-text"> Class End Time - {{ $class[0]['end_time']}} </p>
          <hr>
          <p class="card-text"> Start Date - {{ $class[0]['start_date']}} </p>
          <hr>
          <p class="card-text"> End Date - {{ $class[0]['end_date']}} </p>
          <hr>
          <p class="card-text"> Class Type - {{ $class[0]['class_type']}} </p>
          <hr>
          @if ($status == 2)

          <p style="color:green">Approved.You Can Join this Class</p>

          @elseif ($status == 3)

          <p style="color:red">Student Full</p>

          @elseif ($status == 4)

          <p style="color:red"> Teacher Reject this Class </p>

          @elseif ( $status == 0)

          <a href=" {{ route('enrollClass',[ $class[0]['class_id'], $class[0]['user_id'] ] ) }} " class="btn btn-primary"> Enroll </a>

          @else

          <p style="color:orange"> Wait. Teacher Response. </p>
          @endif

        </div>
      </div>
    </div>
</div>

<button class= "btn btn-secondary" onclick="goBack()"> Back </button>
<br><br>
</div>
<div style="height:50vh;"></div>
</div>

@endsection
<script>
    function goBack(){
        window.history.back();
    }
</script>
