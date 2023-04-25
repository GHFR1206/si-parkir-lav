<form action="{{ route('register') }}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
            value="{{ old('username') }}" autocomplete="username" placeholder="Username" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}" autocomplete="name" placeholder="Nama Lengkap" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" placeholder="Email" autocomplete="email">
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

    <div class="input-group mb-3">
        <select class="custom-select @error('role')
            is-invalid
        @enderror" id="inputGroupSelect04"
            name="role">
            <option selected disabled>Pilih role akun...</option>
            @foreach ($role as $r)
                <option value="{{ $r->id }}">{{ $r->role }}</option>
            @endforeach

        </select>
        @error('role')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" placeholder="Password" autocomplete="new-password">
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
    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
    </div>
</form>
