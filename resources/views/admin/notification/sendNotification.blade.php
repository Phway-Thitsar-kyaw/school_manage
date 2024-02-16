@extends('layouts.adminDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<div class="container mt-3">

    @if(Session::has('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get( 'success' )}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ route('sendNotification') }}" method="POST">
        @csrf
        <div class="row">
        <div class="col-4">
        <legend class="mb-3"> Send Notification For all Teacher </legend>
        <div class="form-group">
            <label> Message </label>
            <textarea class="form-control" rows="3" name="message" value=" {{old('message')}} "></textarea>
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Send</button>
        </div>
        </div>
    </form>
</div>

@endsection
