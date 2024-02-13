@extends('layouts.app')

@section('content')
    <section id="verification">
        <div class="container px-4 py-5">
            <div class="card card3 mx-auto">
                <div class="row justify-content-center my-auto">
                    <div class="col-md-8 col-10 my-5">
                        <h4 class="msg-info text-center">Email Verification</h4>
                        <div class="container text-center">
                            <p>You have been registered successfully</p>
                            <div class="border d-grid p-3">
                                <span><strong>User:</strong> {{ Auth::user()->name }}</span>
                                <span><strong>Email:</strong> {{ Auth::user()->email }}</span>
                            </div>
                        </div>
                        <p class="text-center mt-3">You must verify your email address. Please, check your email for a
                            verification link</p>
                        <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                            @csrf
                            <div class="row justify-content-center my-3 px-3">
                                <button class="btn btn-warning" type="submit">Resend Email</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
