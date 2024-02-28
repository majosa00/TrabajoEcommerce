<footer class="bg-dark text-white text-lg-start mt-4 footer">
    <div class="container-fluid p-4">
        <div class="row align-items-start">
            <!-- Logo and Slogan Column -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <div class="text-center text-lg-start">
                    <img src="{{ asset('images/energeticwave-logo.png') }}" alt="Logo" class="footer-logo">
                    <p class="slogan">{{ __('footermessage.slogan') }}</p>
                </div>
            </div>

            <!-- Contact Column -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <div class="text-center text-lg-start">
                    <h5 class="text-uppercase">{{ __('footermessage.contact') }}</h5>
                    <p>{{ __('footermessage.contact_address') }}</p>
                    <p>{{ __('footermessage.cod_postal') }}</p>
                    <p>{{ __('footermessage.contact_email') }}</p>
                </div>
            </div>

            <!-- Quick Link Column -->
            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <div class="text-center text-lg-start">
                    <h5 class="text-uppercase">{{ __('footermessage.quick_links') }}</h5>
                    <ul class="list-unstyled">
                        <li><a href="/products">{{ __('footermessage.product') }}</a></li>
                        <li><a href="/orders">{{ __('footermessage.orders') }}</a></li>
                        <li><a href="/wishlist">{{ __('footermessage.wishlist') }}</a></li>
                        <li><a href="/cart">{{ __('footermessage.cart') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright and Policies -->
    <div class="text-center p-3">
        &copy;
        <script>
            document.write(new Date().getFullYear())
        </script> EnergeticWave - {{ __('footermessage.all_rights_reserved') }}
        <br>
        <a href="#!">{{ __('footermessage.privacy_policy') }}</a> |
        <a href="#!">{{ __('footermessage.terms_conditions') }}</a>
    </div>
</footer>