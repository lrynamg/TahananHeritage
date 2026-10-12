<x-admin-layout>
    <div class="container-fluid">
        <h1 class="mb-4">Edit Volunteer</h1>
        
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/admin/volunteers/{{ $volunteer->id }}">
                    @csrf
                    @method("PUT")
                    
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control @error("first_name") is-invalid @enderror" id="first_name" name="first_name" value="{{ old("first_name", $volunteer->first_name) }}" required>
                        @error("first_name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control @error("last_name") is-invalid @enderror" id="last_name" name="last_name" value="{{ old("last_name", $volunteer->last_name) }}" required>
                        @error("last_name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error("email") is-invalid @enderror" id="email" name="email" value="{{ old("email", $volunteer->email) }}" required>
                        @error("email")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control @error("phone_number") is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old("phone_number", $volunteer->phone_number) }}">
                        @error("phone_number")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Volunteer</button>
                        <a href="/admin/volunteers" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
