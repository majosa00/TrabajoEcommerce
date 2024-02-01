<!-- @ extends('auth.template')    Antiguo navbar-->

@extends('layaouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-3">Reset Password</h1>
        @if (session('status'))
            <p class="text-success mb-3">{{ session('status') }}</p>
        @endif
        <form action="/reset-password" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Email address" id="email"
                    value="{{ old('email', $request->email) }}">
                @error('email')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" id="password">
                @error('password')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password"
                    id="password_confirmation">
                @error('password_confirmation')
                    <p class="text-danger mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <input type="hidden" value="{{ request()->route('token') }}">
            </div>
            <button type="submit" class="btn btn-primary">Set new password</button>
        </form>
    </div>
@endsection
