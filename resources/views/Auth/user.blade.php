@extends('Master.Master')
@section('title','Users')

@section('content')

<div class="row m-3">
    <div class="col-12">

        <!-- ===================== -->
        <!-- User Form -->
        <!-- ===================== -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <!-- Header -->
                <div class="mb-4 text-center">
                    <h5 class="fw-semibold mb-1">Register User</h5>
                    <small class="text-muted">Fill in user information carefully</small>
                </div>

                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">

                        <!-- Name -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Name</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input type="text" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       placeholder="Name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Email</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       placeholder="user@email.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Password</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="••••••••" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Phone</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-telephone"></i>
                                </span>
                                <input type="text" name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}"
                                       placeholder="+670...">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Possition -->
                        <div class="col-md-4">
                            <label class="form-label small text-muted">Position</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-briefcase"></i>
                                </span>
                                <input type="text" name="possition"
                                       class="form-control @error('possition') is-invalid @enderror"
                                       value="{{ old('possition') }}"
                                       placeholder="Position">
                                @error('possition')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-3">
                            <label class="form-label small text-muted">Gender</label>
                            <select name="gender"
                                    class="form-select form-select-sm @error('gender') is-invalid @enderror">
                                <option selected disabled>Choose</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Roles -->
                        <div class="col-md-3">
                            <label class="form-label small text-muted">Role</label>
                            <select name="roles"
                                    class="form-select form-select-sm @error('roles') is-invalid @enderror">
                                <option selected disabled>Choose role</option>
                                <option value="administrator" {{ old('roles')=='administrator'?'selected':'' }}>Administrator</option>
                                <option value="staff" {{ old('roles')=='staff'?'selected':'' }}>Staff</option>
                                <option value="manager" {{ old('roles')=='manager'?'selected':'' }}>Manager</option>
                            </select>
                            @error('roles')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="reset" class="btn btn-danger btn-sm me-2">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-success btn-sm px-4">
                            Save <i class="bi bi-person-plus"></i>
                        </button>
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
                                <th>Photo</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Position</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr class="small">
                                <td>{{ $users->firstItem() + $key }}</td>
                                <td>
                                    @if($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}" class="rounded-circle" width="36" height="36">
                                    @else
                                        <img src="{{ asset('users.png') }}" class="rounded-circle" width="36" height="36">
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->gender ?? '-') }}</td>
                                <td>{{ $user->possition ?? '-' }}</td>
                                <td>{{ ucfirst($user->roles ?? '-') }}</td>
                                <td>{{ $user->phone ?? '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('user.edit',$user->id) }}" class="btn btn-warning btn-sm px-2 me-1">
                                        <i class="bi bi-pencil-square text-white"></i>
                                    </a>
                                    <form action="{{route('user.destroy',$user->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm px-2" onclick="return confirm('Delete this user?')">
                                            <i class="bi bi-trash text-white"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
