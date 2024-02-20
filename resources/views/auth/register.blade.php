

@section('content')
    <div class="container p-5">
        @extends('layouts.app3')

    @section('content')
        <section id="loggin">
            <div class="container px-4 py-5 mx-auto">
                <h1 class="text-center p-3">REGISTER</h1>
                <div class="card card0">
                    <div class="d-flex flex-lg-row flex-column-reverse">
                        <div class="card card1">
                            <div class="row justify-content-center my-auto">
                                <div class="col-md-8 col-10 my-5">
                                    <div class="row justify-content-center px-3 mb-3">
                                        <img src="{{ asset('images/logoticket.png') }}" alt="Logo"
                                            class="footer-logo company-logo">
                                    </div>
                                    <h6 class="msg-info text-center p-2">Create a new account</h6>

                                    <!-- Nuevo formulario de registro -->
                                    <form method="POST" action="{{ route('register') }}" class="mb-3">
                                        @csrf

                                        <div class="form-group">
                                            <label class="form-control-label text-muted">Name</label>
                                            <input type="text" id="name" name="name" placeholder="Your name"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label text-muted">Email Address</label>
                                            <input type="email" id="email" name="email"
                                                placeholder="Your email address" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label text-muted">Password</label>
                                            <input type="password" id="password" name="password" placeholder="Password"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-control-label text-muted">Confirm Password</label>
                                            <input type="password" id="password-confirm" name="password_confirmation"
                                                placeholder="Confirm password" class="form-control">
                                        </div>

                                        <div class="row justify-content-center my-3 px-3">
                                            <button class="btn btn-warning sm" type="submit">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card card2">
                            <div class="my-auto mx-md-5 px-md-5 right justificar">
                                <h3 class="text-dark">Elevate Your Energy</h3>
                                <p class="text-dark">
                                    Energetic Wave is more than just a beverage company. We are dedicated to providing
                                    high-quality and energizing drinks that fuel your active lifestyle.
                                </p>
                                <p class="text-dark">
                                    Our carefully crafted beverages are designed to boost your energy levels and enhance
                                    your overall well-being. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                    do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis
                                    nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</div>
@endsection
