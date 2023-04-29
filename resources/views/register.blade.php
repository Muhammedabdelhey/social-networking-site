@extends('layouts.master')
@section('title', 'Register')
@section('content')
    <section class=" h-custom ">
        @if (isset($errors) && count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="list-unstyled mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="text-center">Register </h1>
        <div class="container-fluid mt-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                        class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form class="mx-1 mx-md-4" method="POST" action="registerRequest">
                        @csrf
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example1c">Your Name</label>
                            <div class="input-group">
                                <span><i class="fas fa-user fa-lg fa-fw"></i></span>
                                <input name="name" value="{{ old('name') }}" type="text" id="form3Example1c"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3c">Your Email</label>
                            <div class="input-group">
                                <span><i class="fas fa-envelope fa-lg fa-fw"></i></span>
                                <input name="email" value="{{ old('email') }}" type="email" id="form3Example3c"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4c">Password</label>
                            <div class="input-group">
                                <span><i class="fas fa-lock fa-lg fa-fw"></i></span>
                                <input name="password" type="password" id="form3Example4c" class="form-control" />
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4cd">Repeat your password</label>
                            <div class="input-group">
                                <span><i class="fas fa-key fa-lg fa-fw"></i></span>
                                <input name="password_confirmation" type="password" id="form3Example4cd"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                            <button type="submit" class="btn btn-primary btn-lg">Register</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
