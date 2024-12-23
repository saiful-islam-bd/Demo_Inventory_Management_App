@extends('layouts.auth_layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4" style="margin-top: 45px;">
                <div class="card p-4" style="box-shadow: 3px 3px 5px 5px rgba(184, 184, 184, 0.6);">
                    <h4>Forgot password</h4>
                    <hr>
                    <form action="{{ route('forgot.password.link') }}" method="post" autocomplete="off">
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
                        <p>
                            Enter your email address and we will send a link via email to reset your password.
                        </p>
                        <div class="form-group">
                            <label for="email" class="mb-2">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter email address"
                                value="{{ old('email') }}">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Send Reset Password Link</button>
                        </div>
                        <br>
                        {{-- <a href="{{ route('user.login') }}">Login</a> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
