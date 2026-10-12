<x-admin-layout>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Deleted Founders</h1>
            <a href="/admin/founders" class="btn btn-secondary">Back to All</a>
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
                            <th>Deleted Date</th>
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
                                <td>{{ $founder->deleted_at->format("M d, Y H:i") }}</td>
                                <td>
                                    <form action="/admin/founders/{{ $founder->id }}/restore" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>
                                    <form action="/admin/founders/{{ $founder->id }}/force" method="POST" style="display: inline;">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('"'"'Permanently delete this founder?'"'"');">Delete Permanently</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No deleted founders</td>
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
