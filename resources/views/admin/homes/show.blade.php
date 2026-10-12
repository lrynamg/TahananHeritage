<x-admin-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>{{ $home->house_name }}</h1>
            <div>
                <a href="/admin/homes/{{ $home->id }}/edit" class="btn btn-warning">Edit</a>
                <a href="/admin/homes" class="btn btn-secondary">Back</a>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Location:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $home->location }}
                    </div>
                </div>
                
                @if($home->img_url)
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <strong>Image:</strong>
                        </div>
                        <div class="col-md-9">
                            <img src="{{ $home->img_url }}" alt="{{ $home->house_name }}" style="max-width: 400px;" class="img-fluid">
                        </div>
                    </div>
                @endif
                
                <div class="row mb-3">
                    <div class="col-md-3">
                        <strong>Description:</strong>
                    </div>
                    <div class="col-md-9">
                        {{ $home->description }}
                    </div>
                </div>
                
                <hr>
                
                <small class="text-muted">Created: {{ $home->created_at->format("M d, Y H:i") }}</small>
                @if($home->updated_at)
                    <small class="text-muted ms-3">Updated: {{ $home->updated_at->format("M d, Y H:i") }}</small>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
