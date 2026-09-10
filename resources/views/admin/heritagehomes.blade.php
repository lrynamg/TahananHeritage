<x-admin-layout>

<div class="heritage-container">
    <div class="card heritage-card">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="heritage-title">Manage Heritage Houses</h3>
                <div class="text-muted">
                    Show
                    <select class="form-select d-inline-block w-auto py-1 mx-1"
                            style="font-size: 0.9rem;"
                           >
                        <option >10</option>
                        <option >25</option>
                        <option >50</option>
                    </select>
                    entries
                </div>
            </div>

            <div class="d-flex align-items-center">
                <button class="btn text-white me-3" style="background-color: #c05a18;"
                        data-bs-toggle="modal" 
                        data-bs-target="#addHomeModal">
                    <i class="fas fa-plus"></i> Add Home
                </button>

                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search records..." >
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover heritage-table" >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Heritage Home</th>
                        <th>Location</th>
                        <th>Image</th>
                        <th>Published Date</th>
                        <th>Modified Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <td>house id</td>
                        <td><strong>house name</strong></td>
                        <td>house location</td>
                        <td class="text-center">
                            <img 
                                 alt="Image"
                                 style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                        </td>
                        <td>date</td>
                        <td>date</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-edit" >
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-delete" ><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Page page of page
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

                    <li class="page-item" >
                        <a class="page-link" href="#">Next</a>
                    </li>

                </ul>
            </nav>
        </div>

    </div>
</div>

{{-- @*modal*@ --}}
<div class="modal fade" id="addHomeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #c05a18; color: white;">
                <h5 class="modal-title">
                    <span >Add Heritage Home</span>
                    <span >Edit Heritage Home</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form name="homeForm" novalidate>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #c05a18;">Home Name <span class="text-danger">*</span></label>
                        <input type="text"
                               name="houseName"
                               class="form-control"
                               
                               required>

                        <div class="text-end text-muted" style="font-size: 0.8rem;">
                            1/ 100
                        </div>

                        <div class="invalid-feedback" style="display: block;"
                             >
                            Home name is required.
                        </div>
                        <div class="invalid-feedback" style="display: block;"
                           >
                            Home name is too short (min 3 chars).
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #c05a18;">Location <span class="text-danger">*</span></label>
                        <input type="text"
                               name="homeLoc"
                               class="form-control"
                              
                               required>

                        <div class="text-end text-muted" style="font-size: 0.8rem;">
                         1 / 100
                        </div>

                        <div class="invalid-feedback" style="display: block;"
                             >
                            Location is required.
                        </div>
                        <div class="invalid-feedback" style="display: block;"
                            >
                            Location is too short (min 3 chars).
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #c05a18;">Category <span class="text-danger">*</span></label>
                        <select name="homeCat"
                                class="form-select"
                                
                                required>
                            <option value="" disabled selected>Select Category</option>
                            <option value="Underrated">Underrated</option>
                            <option value="Popular">Popular</option>
                        </select>

                        <div class="invalid-feedback" style="display: block;"
                            >
                            Please select a category.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #c05a18;">
                            Upload Image <span class="text-danger" >*</span>
                        </label>

                        <input type="file"
                               id="homeImageInput"
                               class="form-control">

                        <div class="mt-2">
                            <small class="text-muted">Current Image:</small><br>
                            <img 
                                 style="height: 80px; border: 1px solid #ddd; padding: 2px;">
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                <button type="button" class="btn text-white" style="background-color: #c05a18;"
                       >
                    Save Home
                </button>

                <button type="button" class="btn btn-success"
                        >
                    Update Changes
                </button>
            </div>

        </div>
    </div>
</div>
</x-admin-layout>
