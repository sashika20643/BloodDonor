
    <!-- resources/views/admin/users/create.blade.php -->
@extends('Dashboard.Admin.Layout.layout')

@section('content')


<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf

    <!-- Common Fields -->
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>
        <div class="col-md-6">
            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
        <div class="col-md-6">
            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Role Field -->
    <div class="row mb-3">
        <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
        <div class="col-md-6">
            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                <option value="Donor">Donor</option>
                <option value="Hospital">Hospital</option>
                <option value="Doctor">Doctor</option>
                <option value="Bank">Blood Bank</option>
            </select>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Role-Specific Fields -->
    <div id="roleSpecificFields">
        <!-- This will be dynamically populated based on the selected role -->
    </div>

    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Add User') }}
            </button>
        </div>
    </div>
</form>


<script>
    // JavaScript to show/hide role-specific fields based on the selected role
    document.getElementById('role').addEventListener('change', function () {
        var roleSpecificFields = document.getElementById('roleSpecificFields');
        roleSpecificFields.innerHTML = ''; // Clear previous fields

        var selectedRole = this.value;
        if (selectedRole === 'Doctor') {
            // Append Doctor-specific fields
            roleSpecificFields.innerHTML = `
                <div class="row mb-3">
                    <label for="hospital_id" class="col-md-4 col-form-label text-md-end">{{ __('Hospital') }}</label>
                    <div class="col-md-6">
                        <select id="hospital_id" class="form-control @error('hospital_id') is-invalid @enderror" name="hospital_id" required>
                            @foreach($hospitals as $hospital)
                                <option value="{{ $hospital->id }}">{{ $hospital->user->name }}</option>
                            @endforeach
                        </select>
                        @error('hospital_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            `;
        } else if (selectedRole === 'Hospital') {
            // Append Hospital-specific fields
            roleSpecificFields.innerHTML = `
                <div class="row mb-3">
                    <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Category') }}</label>
                    <div class="col-md-6">
                        <select id="category" class="form-control @error('category') is-invalid @enderror" name="category" required>
                            <option value="Private">Private</option>
                            <option value="Government">Government</option>
                            <option value="Ayurved">Ayurved</option>
                        </select>
                        @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            `;
        }
        // Add more conditions for other roles as needed
    });
</script>

</div>
@endsection
