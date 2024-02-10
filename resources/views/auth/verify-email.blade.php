@extends('layouts.app')

@section('content')
    <div class="container p-5">
        <div class="row justify-content-center">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Email Verification') }}</div>

                    <div class="card-body">
                        <div class="container text-center">
                            <p>You have been registered successfuly
                            <div class="border d-grid mx-5">
                                <span><strong>User:</strong> {{ Auth::user()->name }}</span>
                                <span><strong>Email:</strong> {{ Auth::user()->email }}</span>
                            </div>
                            </p>
                        </div>
                        <p class="text-center">You must verify your email address. Please, check your email for a
                            verification link</p>
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-warning" value="Resend">
                                        {{ __('Resend Email') }}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
