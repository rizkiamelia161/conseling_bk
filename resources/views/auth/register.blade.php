
@extends('layouts.app')
@section('content')

<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <img class="img-fluid logo-dark mb-2" src="{{ URL::to('assets/img/logo.png') }}" alt="Logo">
            <div class="loginbox">
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>Register</h1>
                        <p class="account-subtitle">Input your data to register to our website.</p>
                        <form method="POST" action="{{ route('register') }}" class="md-float-material">
                            @csrf
                            {{-- insert defaults --}}
                            <input type="hidden" class="image" name="image" value="photo_defaults.jpg">
                            <div class="form-group">
                                <label class="form-control-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter full name">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Role Name</label>
                                <select class="select @error('role_name') is-invalid @enderror" name="role_name" id="role_name">
                                    <option selected disabled>Select Role Name</option>
                                    @foreach ($role as $roles)
                                    <option value="{{ $roles->role_type }}" {{ old('role_name') == $roles->role_type ? "selected" :""}}>{{ $roles->role_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
                                    <span class="fas fa-eye toggle-password"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Confirm Password</label>
                                <div class="pass-group">
                                    <input type="password" class="form-control pass-input" name="password_confirmation" placeholder="Choose Confirm Password">
                                    <span class="fas fa-eye toggle-password"></span>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-block btn-primary" type="submit">Login</button>
                            <div class="text-center dont-have">Don't have an account yet? <a href="{{route('login')}}">Register</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

