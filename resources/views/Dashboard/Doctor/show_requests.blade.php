@extends('Dashboard.Doctor.Layout.layout')

@section('content')
    <div class="container">
        <h1>Blood Camp Requests</h1>

        @if ($bloodCampRequests->isEmpty())
            <p>No requests found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Blood Camp</th>
                        <th>User</th>
                        <th>Medical Report</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bloodCampRequests as $request)
                        <tr>
                            <td>{{ $request->bloodCamp->organisation_name }}</td>
                            <td>{{ $request->user->name }}</td>
                            <td>
                                @if ($request->medical_report_path)
                                    <a href="{{ asset('storage/' . $request->medical_report_path) }}" target="_blank">View Report</a>
                                @else
                                    No report available
                                @endif
                            </td>
                            <td>{{ $request->status }}</td>
                            <td>
                                <a href="{{route('donor_history.user',$request->user->id )}}" class="btn btn-info show-more-btn" data-user-id="{{ $request->user->id }}">Show More</a>
                            </td>
                            <td>
                                <form action="{{route('doctors.donor_requests.respond',$request->id)}}" method="post">
                                    @csrf
                                    <button type="submit" name="response" value="accept" class="btn btn-success">Accept</button>
                                    <button type="submit" name="response" value="reject" class="btn btn-danger">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="modal fade" id="userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="userDetailsContent"></div>
            </div>
        </div>
    </div>
</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add this line to include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        $(document).ready(function() {
            $('.show-more-btn').click(function() {
                var userId = $(this).data('user-id');

                // Make an AJAX request to fetch additional user details
                $.ajax({
                    url: '/users/' + userId, // Adjust the URL based on your actual route
                    type: 'GET',
                    success: function(data) {
                        // Update the modal content with the received data
                        $('#userDetailsContent').html(data);

                        // Show the modal
                        $('#userDetailsModal').modal('show');
                    },
                    error: function(error) {
                        console.error('Error fetching user details:', error);
                    }
                });
            });
        });
    </script>
@endsection
