<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


        <!-- Styles -->
        <style>

        body {
            padding-top: 56px;
        }

        .hero-section {
            height: 100vh;
            background-image: url({{asset('home_1_slider_1.webp')}});
            background-size: cover;
            background-position: center;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .blood-camps-section {
            padding: 40px 0;
        }

        .card-deck {
            margin-bottom: 30px;
        }

        </style>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset("js/scripts.js")}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset("assets/demo/chart-area-demo.js")}}"></script>
        <script src="{{asset("assets/demo/chart-bar-demo.js")}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset("js/datatables-simple-demo.js")}}"></script>
    </head>
    <body class="antialiased">

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">


             <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top d-flex justify-content-between ps-5 pe-5">
        <a class="navbar-brand " href="#">Blood Donation System</a>
        <div >
            @if (Route::has('login'))
            <div class="">
                @auth
                    <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 " style="color: white">Home</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" style="color: white">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" style="color: white">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        </div>

    </nav>

    <section class="hero-section">
        <h1>Welcome to the Blood Donation System</h1>
        <p>Your one-stop solution for managing blood donation camps.</p>
    </section>

    <section class="blood-camps-section">
        <div class="container mt-5 mb-3">
            <h2>Active Blood Camps</h2>
            <div class="card-deck">
                @foreach($activeBloodCamps as $camp)
                    <div class="card" style="max-width:400px">
                        <img src="{{ asset('storage/' . $camp->image) }}" class="card-img-top" alt="{{ $camp->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $camp->organisation_name }}</h5>
                            <p class="card-text">{{ $camp->description }}</p>
                            <p class="card-text"><small class="text-muted">Start Date: {{ $camp->start_date }}</small></p>
                             <a class="btn btn-primary " href="{{route('blood_camps.show',$camp->id)}}">Show More </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <h2>Pending Blood Camps</h2>
            <div class="card-deck">
                @foreach($pendingBloodCamps as $camp)
                    <div class="card" style="max-width:400px">
                        <img src="{{ asset('storage/' . $camp->image) }}" class="card-img-top" alt="{{ $camp->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $camp->organisation_name }}</h5>
                            <p class="card-text">{{ $camp->description }}</p>
                            <p class="card-text"><small class="text-muted">Start Date: {{ $camp->start_date }}</small></p>
                                  <a class="btn btn-primary " href="{{route('blood_camps.show',$camp->id)}}">Show More </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <h2>Completed Blood Camps</h2>
            <div class="card-deck">
                @foreach($completedBloodCamps as $camp)
                    <div class="card" style="max-width:400px">
                        <img src="{{ asset('storage/' . $camp->image) }}" class="card-img-top" alt="{{ $camp->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{$camp->organisation_name }}</h5>
                            <p class="card-text">{{ $camp->description }}</p>
                            <p class="card-text"><small class="text-muted">Start Date: {{ $camp->start_date }}</small></p>
                                  <a class="btn btn-primary " href="{{route('blood_camps.show',$camp->id)}}">Show More </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


        </div>



    </body>

</html>
