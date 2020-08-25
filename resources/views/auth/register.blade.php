@extends('layouts.auth')

@section('authContent')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control form-control-user @error('name') is-invalid @enderror" id="name"
                                    placeholder="Name" autocomplete="off">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="username"
                                    class="form-control form-control-user @error('username') is-invalid @enderror"
                                    id="username" placeholder="Username" autocomplete="off">
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="email" type="email" value="{{ old('email') }}"
                                class="form-control form-control-user @error('emamil') is-invalid @enderror" id="email"
                                placeholder="Email Address" autocomplete="off">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                    placeholder="Password">

                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="exampleRepeatPassword"
                                    placeholder="Repeat Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Register Account
                        </button>
                    </form>
                    <hr>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="btn btn-google btn-user btn-block">
                        <i class="fas fa-undo"></i>&nbsp; Forgot Password
                    </a>
                    @endif
                    <a href="{{ route('login') }}" class="btn btn-facebook btn-user btn-block">
                        <i class="fas fa-unlock-alt"></i>&nbsp; Already have an account? Login!
                    </a>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
