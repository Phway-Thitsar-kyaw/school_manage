@extends('layouts.adminDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<div class="container mt-3">

    <div class="card">
        <div class="card-header" style="background-color:#ced6e0">
            <span> Teacher Information </span>
            <span>
            <a href=" {{ route('adminDashboard')}} ">
            <button type="button" class="btn btn-sm btn-dark float-end"> Back </button>
            </a>
        </span>
        </div>
        <div class="card-body">
            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value=" {{ $teacher[0]->name }} ">
            </div>
            </div>
            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" readonly class="form-control-plaintext" value=" {{ $teacher[0]->email}} ">
            </div>
            </div>
            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value=" {{ $teacher[0]->gender}} ">
            </div>
            </div>
            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value=" {{ $teacher[0]->phone_number_one}} ">
            </div>
            </div>
            <div class="form-group row">
            <label  class="col-sm-2 col-form-label">Region</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value=" {{ $teacher[0]->region}} ">
            </div>
            </div>
            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Town</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value=" {{ $teacher[0]->town }} ">
            </div>
            </div>
            <div class="form-group row">
            <label class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" value=" {{ $teacher[0]->address }} ">
            </div>
            </div>
        </div>
    </div>

</div>

@endsection


