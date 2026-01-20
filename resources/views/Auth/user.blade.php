@extends('Master.Master')
@section('title','Users')

@section('content')

<div class="row m-3">
    <div class="col-12">

        <!-- Elegant Form Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <div class="mb-4">
                    <h5 class="fw-semibold mb-1">Register User</h5>
                    <small class="text-muted">Fill user information carefully</small>
                </div>

                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">

                        <!-- Email -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control" placeholder="user@email.com" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="text" name="phone" class="form-control" placeholder="+670..." >
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-3">
                            <label class="form-label small text-muted">Gender</label>
                            <select name="gender" class="form-select">
                                <option selected disabled>Choose</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <!-- Position -->
                        <div class="col-md-3">
                            <label class="form-label small text-muted">Position</label>
                            <select name="position" class="form-select">
                                <option selected disabled>Choose</option>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>

                        <!-- Photo Upload -->
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="reset" class="btn btn-light me-2">Reset</button>
                        <button type="submit" class="btn btn-primary px-4">
                            Save
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <!-- Table (tetap di bawah) -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-semibold mb-3">User List</h6>

                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="text-muted small">
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Position</th>
                                <th>Phone</th>
                                <th>Photo</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>admin@mail.com</td>
                                <td>Male</td>
                                <td>Admin</td>
                                <td>+670 77xxxx</td>
                                <td>
                                    <img src="https://via.placeholder.com/36" class="rounded-circle">
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
