@extends('Master.Master')
@section('title','Users')

@section('content')

<div class="row m-3">
    <div class="col-12">

        <!-- ===================== -->
        <!-- Elegant User Form -->
        <!-- ===================== -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <div class="mb-4">
                    <h5 class="fw-semibold mb-1">Register User</h5>
                    <small class="text-muted fs-12">Fill user information carefully</small>
                </div>

                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        <!-- Email -->
                        <div class="col-md-4">
                            <label class="form-label fs-12 text-muted">Email</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control" placeholder="user@email.com" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-4">
                            <label class="form-label fs-12 text-muted">Password</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-4">
                            <label class="form-label fs-12 text-muted">Phone</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="text" name="phone" class="form-control" placeholder="+670...">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fs-12 text-muted">Possition</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                <i class="bi bi-briefcase"></i>
                                </span>
                                <input type="text" name="possition" class="form-control" placeholder="Possition">
                            </div>
                        </div>


                        <!-- Gender -->
                        <div class="col-md-3">
                            <label class="form-label fs-12 text-muted">Gender</label>
                            <select name="gender" class="form-select form-select-sm">
                                <option selected disabled>Choose</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <!-- Position -->
                        <div class="col-md-3">
                            <label class="form-label fs-12 text-muted">Roles</label>
                            <select name="position" class="form-select form-select-sm">
                                <option selected disabled>Roles</option>
                                <option value="administrator">Administrator</option>
                                <option value="staff">Staff</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>

                        <!-- Photo Upload -->
                        {{-- <div class="col-md-6">
                            <label class="form-label fs-12 text-muted">Photo</label>
                            <input type="file" name="photo" class="form-control form-control-sm">
                        </div> --}}

                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="reset" class="btn btn-danger btn-sm me-2">Reset</button>
                        <button type="submit" class="btn btn-success btn-sm px-4">Save <i class="bi bi-person-plus"></i></button>
                    </div>

                </form>
            </div>
        </div>

        <!-- ===================== -->
        <!-- Users Table -->
        <!-- ===================== -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <h6 class="fw-semibold mb-3">User List</h6>

                <div class="table-responsive">
                    <table class="table table-hover table-sm align-middle">
                        <thead class="bg-light text-uppercase small text-muted">
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
                        {{-- @foreach($users as $key => $user)
                            <tr style="font-size:12px;">
                                <td>{{ $users->firstItem() + $key }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->gender ?? '-') }}</td>
                                <td>{{ ucfirst($user->position ?? '-') }}</td>
                                <td>{{ $user->phone ?? '-' }}</td>
                                <td>
                                    @if($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}" class="rounded-circle" width="36" height="36">
                                    @else
                                        <img src="https://via.placeholder.com/36" class="rounded-circle">
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="" class="btn btn-outline-warning btn-sm px-2 me-1">Edit</a>
                                    <form action="" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm px-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{-- {{ $users->simplePaginate(3)->links('pagination::bootstrap-5') }} --}}
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection
