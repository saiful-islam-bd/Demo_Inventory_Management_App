@extends('layouts.auth_layout')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-3"></div>

            <div class="col-6">
                <div class="card p-5 mb-4" style="box-shadow: 3px 3px 5px 5px rgba(184, 184, 184, 0.6);">


                    <div class="text-center mb-3">
                        <h3>Admin Register</h3>
                    </div>

                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif

                    <form action="{{ route('admin.register.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                placeholder="Full Name">
                            <span class="text-danger"> @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                placeholder="Email">
                            <span class="text-danger"> @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
               
                        <div class="mb-4">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <span class="text-danger"> @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-4">
                            <input type="checkbox" name="role_id" value="1">
                            <label for="" class="form-label">Register as Admin</label>
                            <span class="text-danger"> @error('role_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="mb-4">
                            <a href="{{ route('admin.login')}}" style="font-size: 15px;">If you already registered, Let's login!</a>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Register</button>
                    </form>

                </div>
            </div>

            <div class="col-3"></div>
        </div>
    </div>
@endsection
