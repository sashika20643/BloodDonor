
@extends('Dashboard.Blood_bank.Layout.layout')

@section('content')
    <div class="container">
        <h1>All Blood Donation Camps</h1>

        <div class="d-flex gap-2 flex-wrap">
        @foreach($bloodDonationCamps as $camp)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $camp->organisation_name }}(<span style='color:{{$camp->status=="Pending" ? "orange":"green"  }}'> {{$camp->status}} </span>)</h5>

                    <p class="card-text">{{ $camp->target_location }}, {{ $camp->start_date }} to {{ $camp->end_date }}</p>
                    <button class="btn btn-primary" data-toggle="collapse" data-target="#campDetails{{ $camp->id }}">Show Details</button>
                    <a href="{{ route('blood_donation_camps.showDonors', ['id' => $camp->id]) }}" class="btn btn-info">Show Donors</a>

                </div>
                 <div id="campDetails{{ $camp->id }}" class="collapse">
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $camp->image) }}" alt="Blood Donation Camp Image" class="img-fluid mb-3" style="max-width:300px">
                        <p class="card-text"><strong>Blood donatio camps.:</strong> {{ $camp->blood_donation_camps }}</p>
                        <p class="card-text"><strong>Number of Donors:</strong> {{ $camp->number_of_donors }}</p>
                        <p class="card-text"><strong>Target Address:</strong> {{ $camp->target_address }}</p>
                        <!-- Add more details as needed -->

                        <!-- Edit and Delete Buttons -->
                        <div class="mt-3">
                            <a href="{{ route('blood_donation_camps.edit', $camp->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('blood_donation_camps.destroy', $camp->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this camp?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div>
    </div>

    <!-- Include Bootstrap and jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
