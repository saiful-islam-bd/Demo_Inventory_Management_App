@extends('layouts.user_layout')
@section('content')
    <div class="container p-4">
        <div class="card">
            <div class="card-header">
                <span style="font-weight: 500; font-size:22px;">Manage Users</span>
                <button id="addUser" class="btn btn-primary" style="float: right !important;">Add User</button>
            </div>
            <div class="card-body">
                <table id="userTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



    <!--Create Modal -->
    <div class="modal fade" id="createUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <form id="createUser">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" name="role_id" value="2">
                            <label for="" class="form-label">Add as User</label>
                            <span class="text-danger"> @error('role_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createUserModal">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--Edit Modal -->

    <div class="modal fade" id="editUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <form id="editUser">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="e_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="e_email" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <input type="checkbox" id="e_role_id" name="role_id" value="2">
                            <label for="" class="form-label">Add as User</label>
                            <span class="text-danger"> @error('role_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editUserModal">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
