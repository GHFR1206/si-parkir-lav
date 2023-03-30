<x-app-login>
    <div class="container">
        <div class="row justify-content-center">
            <div class="login-box">
                <div class="login-logo">
                    <a class="text-white" href="{{ route('home') }}"><b>GHFR</b>ParkNet.Id</a>
                </div>
                <!-- /.login-logo -->
                <div class="card">

                    <div class="card-body login-card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="input-group mb-3">
                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary btn-block">Kirim link reset
                                    password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-login>
