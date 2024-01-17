<!-- donor_history/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Donor History</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Blood Camp</th>
                    <th>Donation Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donorHistory as $history)
                    <tr>
                        <td>{{ $history->user->name }}</td>
                        <td>{{ $history->bloodCamp->organisation_name }}</td>
                        <td>{{ $history->donation_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
