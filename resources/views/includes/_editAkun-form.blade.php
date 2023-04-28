@csrf
<div class="input-group mb-3">
    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username"
        value="<?= old('username') ? old('username') : $getAkun->username ?>" autocomplete="username"
        placeholder="Username" autofocus>
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
        value="<?= old('name') ? old('name') : $getAkun->name ?>" autocomplete="name" placeholder="Nama Lengkap"
        autofocus>
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
        value="<?= old('email') ? old('email') : $getAkun->email ?>" placeholder="Email" autocomplete="email">
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

        <option disabled>Pilih role akun..</option>
        @if ($getAkun->role->role == 'Admin')
            <option selected value="1">Admin</option>
            <option value="2">Petugas</option>
        @else
            <option value="1">Admin</option>
            <option selected value="2">Petugas</option>
        @endif

    </select>
    @error('role')
        <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
        </div>
    @enderror
</div>
<button type="submit" class="btn btn-primary btn-block">Sign In</button>
</div>
