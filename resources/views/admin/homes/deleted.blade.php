<x-admin-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Deleted Heritage Homes</h1>
            <a href="/admin/homes" class="btn btn-secondary">Back to All</a>
        </div>
        
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>House Name</th>
                            <th>Location</th>
                            <th>Deleted Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($homes as $home)
                            <tr>
                                <td>{{ $home->id }}</td>
                                <td>{{ $home->house_name }}</td>
                                <td>{{ $home->location }}</td>
                                <td>{{ $home->deleted_at->format("M d, Y H:i") }}</td>
                                <td>
                                    <form action="/admin/homes/{{ $home->id }}/restore" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>
                                    <form action="/admin/homes/{{ $home->id }}/force" method="POST" style="display: inline;">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('"'"'Permanently delete this home?'"'"');">Delete Permanently</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No deleted homes</td>
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
