<div class="input-group mb-3">
    <div class="form-control text-muted">
        <span id="tanggal"></span> ; <span id="watch"></span>
    </div>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fa-solid fa-clock"></span>
        </div>
    </div>
</div>

<div class="input-group mb-3">
    <input type="text" class="form-control @error('no_kendaraan') is-invalid @enderror" name="no_kendaraan"
        value="{{ old('no_kendaraan') }}" placeholder="Nomor Kendaraan" autocomplete="off">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fa-solid fa-car"></span>
        </div>
    </div>
    @error('no_kendaraan')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="input-group ml-2 mb-3 d-flex justify-content-center">
    <div class="form-check mr-4">
        <input class="form-check-input" type="radio" name="tipe" id="motor" value="Motor" checked>
        <label class="form-check-label" for="motor">
            Motor
        </label>
    </div>
    <div class="form-check mr-4">
        <input class="form-check-input" type="radio" name="tipe" id="mobil" value="Mobil">
        <label class="form-check-label" for="mobil">
            Mobil
        </label>
    </div>
    <div class="form-check mr-4">
        <input class="form-check-input" type="radio" name="tipe" id="truk" value="Truk/Lainnya">
        <label class="form-check-label" for="truk">
            Truk/Lainnya
        </label>
    </div>
</div>

<div class="row">
    <!-- /.col -->
    <div class="col-12">
        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
    </div>
    <!-- /.col -->
</div>
