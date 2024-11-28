@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header pt-3">
                    <h4 class="w-100 text-center">Kibertarg`ibot yordamchi bot</h4>
                </div>
                <div class="card-body">
                    <h6 class="w-100 text-center">Dasturiy ta`minoti</h6>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label for="email" class="mb-2">Email</label>
                        <input id="email" type="email" class="mb-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="password" class="mb-2">Parol</label>
                        <input id="password" type="password" class="mb-2 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button type="submit" class="btn btn-primary w-100 mt-3">Kirish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
