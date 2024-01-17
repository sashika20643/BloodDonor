@extends('layouts.app')

@section('content')
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

    <div class="container">
        <h1>{{ $bloodCamp->organisation_name }} Details</h1>

        <div class="card">
            <div class="card-body d-flex flex-wrap">
                <div>
                    @if($bloodCamp->image)
                    <img src="{{ asset('storage/' . $bloodCamp->image) }}" class="img-fluid" style="max-width:40vw" alt="{{ $bloodCamp->organisation_name }}">
                @else
                    <p>No image available</p>
                @endif
                </div>
                <div class="ps-3">

                    <p><strong class="text-primary">Organisation Name:</strong> {{ $bloodCamp->organisation_name }}</p>
                    <p><strong class="text-primary">Address:</strong> {{ $bloodCamp->address }}</p>
                    <p><strong class="text-primary">Email:</strong> {{ $bloodCamp->email }}</p>
                    <p><strong class="text-primary">Name:</strong> {{ $bloodCamp->name }}</p>
                    <p><strong class="text-primary">Phone Number:</strong> {{ $bloodCamp->phone_number }}</p>
                    <p><strong class="text-primary">Validity:</strong> {{ $bloodCamp->validity }}</p>
                    <p><strong class="text-primary">Number of Donors:</strong> {{ $bloodCamp->number_of_donors }}</p>
                    <p><strong class="text-primary">Target Address:</strong> {{ $bloodCamp->target_address }}</p>
                    <p><strong class="text-primary">Target Location:</strong> {{ $bloodCamp->target_location }}</p>
                    <p><strong class="text-primary">Start Date:</strong> {{ $bloodCamp->start_date }}</p>
                    <p><strong class="text-primary">End Date:</strong> {{ $bloodCamp->end_date }}</p>
                    <p><strong class="text-primary">Status:</strong> {{ $bloodCamp->status }}</p>

                    {{-- Add a button to send a request --}}

                    @if ($bloodCamp->status=="Pending" && auth()->user()->role=="Donor")
                    <form action="{{ route('blood_camp_requests.create', ['bloodCampId' => $bloodCamp->id]) }}" enctype="multipart/form-data" method="post"  >
                        @csrf
                        <h3>Send a donation request</h3>
                        <label> Medical :</label>
                        <input type="file" placeholder="latest medical report" name="medical_report">
                        <button type="submit" class="btn btn-primary">Send Request</button>
                    </form>
                    @endif



                    @if($bloodCamp->bloodCampDonors->isNotEmpty())
                    <h3>{{ $bloodCamp->status=="Pending"?"Donors who have registered":"Donors Who Have Donated" }}</h3>
                    <ul>
                        @foreach($bloodCamp->bloodCampDonors as $donor)
                            <li>{{ $donor->user->name }}</li>
                            {{-- Add more donor details as needed --}}
                        @endforeach
                    </ul>
                @else
                    <p>No donors have donated yet.</p>
                @endif
                </div>


            </div>
        </div>
    </div>
@endsection
