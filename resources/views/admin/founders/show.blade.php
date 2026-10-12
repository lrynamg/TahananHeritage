<x-admin-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $founder->first_name }} {{ $founder->last_name }}</h1>
            <div>
                <a href="/admin/founders/{{ $founder->id }}/edit" class="btn btn-warning">Edit</a>
                <a href="/admin/founders" class="btn btn-secondary">Back</a>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $founder->email }}
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Biography:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $founder->bio }}
                    </div>
                </div>
                
                <hr>
                
                <small class="text-muted">Created: {{ $founder->created_at->format("M d, Y H:i") }}</small>
                @if($founder->updated_at)
                    <small class="text-muted ms-3">Updated: {{ $founder->updated_at->format("M d, Y H:i") }}</small>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
