<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Teacher Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>

        .bg{
             background-color: #8BC6EC;
            background-image: linear-gradient(135deg, #8BC6EC 0%, #9599E2 100%);
        }

        .nav{
            font-family: Arial, Helvetica, sans-serif;
            list-style: none;
            margin:0;
            padding: 0;
        }

        .navbar-brand{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 150%;
        }

        .nav li {
        line-height: 28px;
        text-align: center;
        }

        .nav li a{
            color:black;
            text-decoration: none;
            letter-spacing: 2px;
        }

        .nav li a:hover{
           color: whitesmoke;
        }

    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg">
        <div class="p-2">
            <i class="fa-sharp fa-solid fa-layer-group fa-2x"></i>
        </div>
        <a class="navbar-brand" href="{{ route('adminDashboard') }}" > Admin Dashboard </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link "  href="{{ route('adminDashboard') }}" > Teacher <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('studentList') }}" > Student <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sendNotification') }}" > Send Notification <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('addAdmin') }}"> Add Admin <span class="sr-only"></span></a>
                </li>
            </ul>
            </div>
                <form class="form-inline" action=" {{ route('logout') }} " method="post">
                    @csrf
                <button class="btn btn-outline-dark my-2 my-sm-0" value="logout" type="submit">Logout</button>
                </form>
        </nav>
        </div>
        </div>
        <br>

@yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>
