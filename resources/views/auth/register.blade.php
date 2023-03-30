<x-app-login title="Register">
    <div class="container">
        <div class="row justify-content-center">
            <div class="login-box">
                <div class="login-logo">
                    <a class="text-white" href="{{ route('home') }}"><b>GHFR</b>ParkNet.Id</a>
                </div>
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Sign in to start your session</p>

                        @include('includes._register-form')
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
</x-app-login>
