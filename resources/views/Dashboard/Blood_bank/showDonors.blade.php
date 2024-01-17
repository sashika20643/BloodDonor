<!-- resources/views/Dashboard/Blood_bank/BloodDonationCamp/showDonors.blade.php -->

@extends('Dashboard.Blood_bank.Layout.layout')

@section('content')
<div class="container">
    <h1>Donors for {{ $bloodCamp->organisation_name }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Update Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bloodCamp->bloodCampDonors as $donor)
                <tr>
                    <td>{{ $donor->user->name }}</td>
                    <td class='{{$donor->status=="donated" ? "text-success":($donor->status=="pending" ? "text-warning":"text-danger")}}'>{{ $donor->status }}</td>
                    <td>
                        @if ($donor->status=="pending")
                        <form action="{{ route('blood_camp_donor.update', ['blood_camp_donor' => $donor->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="donated" {{ $donor->status == 'donated' ? 'selected' : '' }}>Donated</option>
                                <option value="pending" {{ $donor->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="cancelled" {{ $donor->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>

                        @endif

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No donors found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


@endsection
