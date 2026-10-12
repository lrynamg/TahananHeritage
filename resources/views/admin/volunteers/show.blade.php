<x-admin-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</h1>
            <div>
                <a href="/admin/volunteers/{{ $volunteer->id }}/edit" class="btn btn-warning">Edit</a>
                <a href="/admin/volunteers" class="btn btn-secondary">Back</a>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $volunteer->email }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Phone Number:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $volunteer->phone_number }}
                    </div>
                </div>
                
                <hr>
                
                <small class="text-muted">Created: {{ $volunteer->created_at->format("M d, Y H:i") }}</small>
                @if($volunteer->updated_at)
                    <small class="text-muted ms-3">Updated: {{ $volunteer->updated_at->format("M d, Y H:i") }}</small>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
