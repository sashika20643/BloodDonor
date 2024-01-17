<!-- donor_history/index.blade.php -->
@extends('Dashboard.Doctor.Layout.layout')


@section('content')
    <div class="container">
        <h1>{{ $user->name }}'s Donor History</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Blood Camp</th>
                    <th>Donation Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donorHistory as $history)
                    <tr>
                        <td>{{ $history->bloodCamp->organisation_name }}</td>
                        <td>{{ $history->donation_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
