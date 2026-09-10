

<x-admin-layout>

<div class="heritage-container">
    <div class="card heritage-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="heritage-title">Manage Volunteer</h3>
                <div class="text-muted">
                    Show
                    <select class="form-select d-inline-block w-auto py-1 mx-1"
                            style="font-size: 0.9rem;"
                         >
                        <option >10</option>
                        <option >25</option>
                        <option>50</option>
                    </select>
                    entries
                </div>
            </div>

            <div class="d-flex align-items-center">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search records...">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover heritage-table" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <td>volunteer id</td>
                        <td><strong>first name</strong></td>
                        <td>last name</td>
                        <td>email</td>
                        <td> phone number</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-edit" ><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Page 1 of 10
            </small>

            <nav>
                <ul class="pagination heritage-pagination mb-0">

                    <li class="page-item" >
                        <a class="page-link" href="#" >Previous</a>
                    </li>

                    <li class="page-item"
                        >
                        <a class="page-link" href="#" >1</a>
                    </li>

                    <li class="page-item">
                        <a class="page-link" href="#" >Next</a>
                    </li>

                </ul>
            </nav>
        </div>

    </div>
</div>

<div class="modal fade" id="editVolunteerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #c05a18; color: white;">
                <h5 class="modal-title">Edit Volunteer Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form name="editVolForm">

                    <div class="mb-3">
                        <label class="fw-bold" style="color: #c05a18;">First Name</label>
                        <input type="text" class="form-control"  required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold" style="color: #c05a18;">Last Name</label>
                        <input type="text" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold" style="color: #c05a18;">Email</label>
                        <input type="email" class="form-control"  required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold" style="color: #c05a18;">Phone Number</label>
                        <input type="text" class="form-control"  required>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn text-white" style="background-color: #c05a18;">Update Changes</button>
            </div>

        </div>
    </div>
</div>
</x-admin-layout>
