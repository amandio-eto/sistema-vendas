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

                <div class="mb-4 text-center">
                    <h5 class="fw-semibold mb-1 text-center">Update User {{ $user->name }}</h5>
                    <small class="text-muted fs-12">Fill user information carefully</small>
                </div>
                <div class="row">
                    <div class="col">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </div>
                </div>

                <form action="{{ route('user.update',['id'=>$user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">


                        <div class="col-md-4">
                            <label class="form-label fs-12 text-muted">Name</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                  <i class="bi bi-person-fill"></i>
                                </span>
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control" placeholder="Name" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-4">
                            <label class="form-label fs-12 text-muted">Email</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input value="{{ $user->email }}" type="email" name="email" class="form-control" placeholder="user@email.com" required>
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
                                <input value="{{ $user->phone }}" type="text" name="phone" class="form-control" placeholder="+670...">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fs-12 text-muted">Possition</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white">
                                <i class="bi bi-briefcase"></i>
                                </span>
                                <input value="{{ $user->possition }}" type="text" name="possition" class="form-control" placeholder="Possition">
                            </div>
                        </div>


                        <!-- Gender -->
                        <div class="col-md-3">
                            <label class="form-label fs-12 text-muted">Gender</label>
                            <select name="gender" class="form-select form-select-sm">
                                <option selected disabled>Choose</option>
                            
                             <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                                    Male
                            </option>
                            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                    Female
                            </option>

                            </select>
                        </div>

                        <!-- Position -->
                        <div class="col-md-3">
                            <label class="form-label fs-12 text-muted">Roles</label>
                            <select  class="form-select form-select-sm" name="roles">
                                <option selected disabled >Roles</option>
                                <option value="administrator" {{ ($user->roles== 'administrator') ? 'selected' : '' }} >Administrator</option>
                                <option value="staff" {{ ($user->roles== 'staff') ? 'selected' : '' }}>Staff</option>
                                <option value="manager" {{ ($user->roles== 'manager') ? 'selected' : '' }}>Manager</option>
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
                        <a href="{{ route('users.list') }}" type="reset" class="btn btn-primary btn-sm me-2"> <i class="bi bi-arrow-left-circle"></i> Back</a>
                        <button type="submit" class="btn btn-warning btn-sm px-4">Update <i class="bi bi-pencil-square"></i></button>
                    </div>

                </form>
            </div>
        </div>

      

    </div>
</div>

@endsection
