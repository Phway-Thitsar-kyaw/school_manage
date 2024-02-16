@extends('layouts.adminDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<div class="container mt-3">

    @if(Session::has('deleteSuccess'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get( 'deleteSuccess' )}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <span>
                <a href=" {{ route('addAdmin') }} "><button class="btn btn-sm font-light float-end btn-dark">Back</button></a>
            </span>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Date of birth</th>
                  <th scope="col">Phno One</th>
                  <th scope="col">Region</th>
                  <th scope="col">Town</th>
                  <th scope="col">Address</th>
                  <th></th>
                </tr>
              <tbody>
                @foreach($admin as $item)

                <tr>
                  <th scope="row"> {{ $item['id'] }} </th>
                  <td> {{ $item['name']}} </td>
                  <td> {{ $item['email']}} </td>
                  <td> {{ $item['gender']}} </td>
                  <td> {{ $item['date_of_birth']}} </td>
                  <td> {{ $item['phone_number_one']}} </td>
                  <td> {{ $item['region']}} </td>
                  <td> {{ $item['town']}} </td>
                  <td> {{ $item['address']}} </td>
                  <td>  </td>
                  <td>
                      <a href=" {{ route('deleteAdminAccount', $item['id'])}} "> <button class="btn btn-sm btn-danger font-white "> Delete </button> </a>
                  </td>
                </tr>

                @endforeach
              </tbody>
            </table>
        </div>
    </div>

</div>

@endsection


