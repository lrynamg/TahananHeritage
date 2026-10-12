<x-admin-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Manage Volunteers</h1>
            <a href="/admin/volunteers/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Volunteer
            </a>
        </div>
        
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($volunteers as $volunteer)
                            <tr>
                                <td>{{ $volunteer->id }}</td>
                                <td>{{ $volunteer->first_name }} {{ $volunteer->last_name }}</td>
                                <td>{{ $volunteer->email }}</td>
                                <td>{{ $volunteer->phone_number }}</td>
                                <td>
                                    <a href="/admin/volunteers/{{ $volunteer->id }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="/admin/volunteers/{{ $volunteer->id }}/edit" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="/admin/volunteers/{{ $volunteer->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('"'"'Soft delete this volunteer?'"'"');">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No volunteers found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-center">
                {{ $volunteers->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>
