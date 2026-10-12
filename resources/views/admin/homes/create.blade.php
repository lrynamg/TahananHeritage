<x-admin-layout>
    <div class="container-fluid">
        <h1 class="mb-4">Add New Heritage Home</h1>
        
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/admin/homes">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="house_name" class="form-label">House Name</label>
                        <input type="text" class="form-control @error("house_name") is-invalid @enderror" id="house_name" name="house_name" value="{{ old("house_name") }}" required>
                        @error("house_name")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control @error("location") is-invalid @enderror" id="location" name="location" value="{{ old("location") }}" required>
                        @error("location")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="img_url" class="form-label">Image URL</label>
                        <input type="url" class="form-control @error("img_url") is-invalid @enderror" id="img_url" name="img_url" value="{{ old("img_url") }}">
                        @error("img_url")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Create Home</button>
                        <a href="/admin/homes" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
