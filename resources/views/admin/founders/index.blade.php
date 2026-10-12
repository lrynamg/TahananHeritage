<x-admin-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Manage Founders</h1>
            <a href="/admin/founders/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Founder
            </a>
        </div>
        
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Position</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($founders as $founder)
                            <tr>
                                <td>{{ $founder->id }}</td>
                                <td>{{ $founder->first_name }}</td>
                                <td>{{ $founder->last_name }}</td>
                                <td>{{ $founder->position }}</td>
                                <td>
                                    @if($founder->img_url)
                                        <img src="{{ $founder->img_url }}" alt="{{ $founder->first_name }} {{ $founder->last_name }}" style="max-width: 50px; max-height: 50px;">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/founders/{{ $founder->id }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="/admin/founders/{{ $founder->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="/admin/founders/{{ $founder->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('"'"'Soft delete this founder?'"'"');">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No founders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-center">
                {{ $founders->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
