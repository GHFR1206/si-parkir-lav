<x-app-login title="Reset Password">
    <div class="login-box">
        <div class="login-logo">
            <a class="text-white" href="{{ route('home') }}"><b>GHFR</b>ParkNet.Id</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Reset password anda
                </p>

                <form action="{{ route('update-password', $getAkun->id) }}" method="post">
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="Password" autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            autocomplete="new-password" placeholder="Password Confirm">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Lanjut</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    </div>
    </div>
</x-app-login>
