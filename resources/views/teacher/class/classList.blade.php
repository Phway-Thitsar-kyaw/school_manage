@extends('layouts.teacherDesign')

@section('content')

@if(Session::has('authError'))

    <p style="color:red">{{ Session::get('authError')}}</p>

@endif

<div class="container">

    @if(Session::has('deleteSuccess'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get( 'deleteSuccess' )}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

    @endif

    <div class="row">

    <table class="table">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Course Title</th>
            <th scope="col"> Class Name </th>
            <th scope="col"> Class Fee </th>
            <th scope="col"> Start Date </th>
            <th scope="col"> End Date </th>
            <th scope="col"> Class Type </th>
            <th></th>
          </tr>
        <tbody>

            @foreach ($classData as $item)

            <tr>
                <td> {{ $item['class_id'] }} </td>
                <td> {{ $item['course_title'] }} </td>
                <td> {{ $item['class_name'] }} </td>
                <td> {{ $item['fee'] }} </td>
                <td> {{ $item['start_date'] }} </td>
                <td> {{ $item['end_date'] }} </td>
                <td> {{ $item['class_type'] }} </td>
                <td>

                <a href=" {{ route('updateClassPage', $item['class_id']) }} "><button  class="btn btn-sm btn-secondary"> Update </button> </a>
                <a href="{{ route('deleteClass', $item['class_id'] )}}"><button  class="btn btn-sm btn-danger"> Delete </button></a>

                </td>
            </tr>

            @endforeach
        </tbody>
      </table>
    </div>
    </div>
</div>


@endsection
