@extends('layouts.adminDesign')

@section('content')

@if(Session::has('authError'))

<p style="color:red"> {{Session::get('authError')}} </p>

@endif

<div class="container mt-3">
    <a href="{{ route('downloadTeacherCSV') }}"><button class="btn btn-sm btn-success mb-3"> Download CSV</button></a>
    <table class="table">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Gender</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Student Count</th>
          <th></th>
        </tr>
      <tbody>
        @foreach($teacher as $item)

        <tr>
          <th scope="row"> {{ $item['id'] }} </th>
          <td> {{ $item['name']}} </td>
          <td> {{ $item['email']}} </td>
          <td> {{ $item['gender']}} </td>
          <td> {{ $item['phone_number_one']}} </td>
          <td> {{ $item['student_count']}} </td>
          <td>
              <a href=" {{ route('lookTeacherDetails',$item['id']) }} "> <button class="btn btn-sm  btn-dark font-light"> More Details </button> </a>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
</div>

@endsection


