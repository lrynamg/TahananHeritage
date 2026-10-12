<x-admin-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Manage Heritage Homes</h1>
            <a href="/admin/homes/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Home
            </a>
        </div>
        
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>House Name</th>
                            <th>Location</th>
                            <th>Image</th>
                            <th>Published Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($homes as $home)
                            <tr>
                                <td>{{ $home->id }}</td>
                                <td>{{ $home->house_name }}</td>
                                <td>{{ $home->location }}</td>
                                <td>
                                    @if($home->img_url)
                                        <img src="{{ $home->img_url }}" alt="{{ $home->house_name }}" style="max-width: 50px; max-height: 50px;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>{{ $home->created_at->format("M d, Y") }}</td>
                                <td>
                                    <a href="/admin/homes/{{ $home->id }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="/admin/homes/{{ $home->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="/admin/homes/{{ $home->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('"'"'Soft delete this home?'"'"');">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No homes found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-center">
                {{ $homes->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
