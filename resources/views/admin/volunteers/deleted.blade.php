<x-admin-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Deleted Volunteers</h1>
            <a href="/admin/volunteers" class="btn btn-secondary">Back to All</a>
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
                            <th>Deleted Date</th>
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
                                <td>{{ $volunteer->deleted_at->format("M d, Y H:i") }}</td>
                                <td>
                                    <form action="/admin/volunteers/{{ $volunteer->id }}/restore" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>
                                    <form action="/admin/volunteers/{{ $volunteer->id }}/force" method="POST" style="display: inline;">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('"'"'Permanently delete this volunteer?'"'"');">Delete Permanently</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No deleted volunteers</td>
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
