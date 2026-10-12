<x-admin-layout>
    <div class="container-fluid">
        <h1 class="mb-4">Edit Founder</h1>
        
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/admin/founders/{{ $founder->id }}">
                    @csrf
                    @method("PUT")
                    
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control @error("first_name") is-invalid @enderror" id="first_name" name="first_name" value="{{ old("first_name", $founder->first_name) }}" required>
                        @error("first_name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control @error("last_name") is-invalid @enderror" id="last_name" name="last_name" value="{{ old("last_name", $founder->last_name) }}" required>
                        @error("last_name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control @error("position") is-invalid @enderror" id="position" name="position" value="{{ old("position", $founder->position) }}" required>
                        @error("position")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="img_url" class="form-label">Image URL</label>
                        <input type="url" class="form-control @error("img_url") is-invalid @enderror" id="img_url" name="img_url" value="{{ old("img_url", $founder->img_url) }}">
                        @error("img_url")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Founder</button>
                        <a href="/admin/founders" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
