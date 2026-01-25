@extends('Master.Master')

@section('title', 'Update Profile Photo')

@section('content')
<div class="container py-5" style="max-width: 480px;">
    <div class="card shadow border-0 rounded-4">
        <div class="card-header text-center py-4" >
            <h4 class="mb-0 fw-bold">Change Profile</h4>
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="text-center mb-4">
                    <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('users.png') }}" 
                         alt="Profile Photo" 
                         id="preview" 
                         class="rounded-circle shadow-sm" 
                         style="width:120px; height:120px; object-fit:cover; border:2px solid #ddd;">
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label fw-medium">Choose New Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" required>
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg fw-semibold"><i class="bi bi-upload"></i> Update Photo</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    // Preview gambar sebelum upload
    document.getElementById('photo').addEventListener('change', function(e){
        const reader = new FileReader();
        reader.onload = function(){
            const preview = document.getElementById('preview');
            preview.src = reader.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>

<style>
    .btn-primary {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        border: none;
        transition: 0.3s;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #2575fc, #6a11cb);
    }
</style>
@endsection
