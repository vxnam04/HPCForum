@extends('layouts.admin')

@section('content')
<div class="container my-5">
    <h2>Phân Quyền Cho Tài Khoản: {{ $user->name }}</h2>
    <form action="{{ route('users.updateRoles', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            @foreach($roles as $role)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" 
                           class="form-check-input"
                           {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $role->name }}</label>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary mt-3">Cập Nhật</button>
    </form>
</div>
@endsection
