@extends('layouts.auth_layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-md-6" style="margin-top: 45px;">
                <div class="card p-4" style="box-shadow: 3px 3px 5px 5px rgba(184, 184, 184, 0.6);">
                    <h4 class="mb-0">Admin Reset password</h4>
                    <hr>
                    <form action="{{ route('admin.reset.password', ['token' => $token]) }}" method="post" autocomplete="off">
                        @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif

                        @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group mb-3">
                            <label for="email" class="mb-1">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter email address"
                                value="{{ $email ?? old('email') }}">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password"
                                value="{{ old('password') }}">
                            <span class="text-danger">
                               
                            </span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Confirm password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Enter password" value="{{ old('password_confirmation') }}">
                            <span class="text-danger">
                                @error('password')
                                {{ $message }}
                            @enderror
                                {{-- @error('password_confirmation')
                                    {{ $message }}
                                @enderror --}}
                            </span>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Reset password</button>
                        </div>

                        <div class="form-group mt-4">
                            <a href="{{ route('admin.login') }}">*Now Log in with New Password.
                            </a>
                        </div>
                        <br>
                        {{-- <a href="{{ route('user.login') }}">Login</a> --}}
                    </form>
                </div>
            </div>

            <div class="col-3"></div>
        </div>
    @endsection
