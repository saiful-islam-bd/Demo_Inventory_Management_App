@extends('layouts.auth_layout')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="card p-4" style="box-shadow: 3px 3px 5px 5px rgba(184, 184, 184, 0.6);">
                    <div class="text-center mb-4">
                        <h3>Admin Login</h3>
                    </div>

                    <form action="{{ route('admin.login.submit') }}" method="POST">
                        @csrf

                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                        @endif


                        <span class="text-danger"> @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <div class="mb-3 mt-4">
                            <a href="{{ route('admin.forgot.password.form') }}"
                                style="font-size: 15px; text-decoration: none;">Forgot Password? Click here.</a>
                        </div>

                        <div class="mb-3 mt-4">
                            <a href="{{ route('admin.register') }}" style="font-size: 15px;">Not yet registered? Register
                                here!</a>
                        </div>

                        <input type="submit" class="btn btn-primary mt-2" id="" value="Login">
                    </form>

                </div>
            </div>

            <div class="col-4"></div>
        </div>
    </div>
@endsection
