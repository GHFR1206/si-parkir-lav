<x-app-login title="Ubah Data Parkir">
    <div class="login-box">
        <div class="login-logo">
            <a class="text-white" href="{{ route('home') }}"><b>GHFR</b>ParkNet.Id</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ubah data kendaraan disini</p>

                <form action="{{ route('parkir.update', $getParkir->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('no_kendaraan') is-invalid @enderror"
                            name="no_kendaraan"
                            value="<?= old('no_kendaraan') ? old('no_kendaraan') : $getParkir->vehicle->no_kendaraan ?>"
                            placeholder="Nomor Kendaraan" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa-solid fa-car"></span>
                            </div>
                        </div>
                        @error('no_kendaraan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('waktu_masuk') is-invalid @enderror"
                            name="waktu_masuk"
                            value="<?= old('waktu_masuk') ? old('waktu_masuk') : $getParkir->waktu_masuk ?>"
                            placeholder="Waktu Masuk" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa-solid fa-car"></span>
                            </div>
                        </div>
                        @error('waktu_masuk')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control @error('waktu_keluar') is-invalid @enderror"
                            name="waktu_keluar"
                            value="<?= old('waktu_keluar') ? old('waktu_keluar') : $getParkir->waktu_keluar ?>"
                            placeholder="Waktu Keluar" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa-solid fa-car"></span>
                            </div>
                        </div>
                        @error('waktu_keluar')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group ml-2 mb-3 d-flex justify-content-center">
                        <div class="form-check mr-4">
                            <input class="form-check-input" type="radio" name="tipe" id="motor" value="Motor"
                                @if ($getParkir->vehicle->tipe == 'Motor') checked @endif>
                            <label class="form-check-label" for="motor">
                                Motor
                            </label>
                        </div>
                        <div class="form-check mr-4">
                            <input class="form-check-input" type="radio" name="tipe" id="mobil" value="Mobil"
                                @if ($getParkir->vehicle->tipe == 'Mobil') checked @endif>
                            <label class="form-check-label" for="mobil">
                                Mobil
                            </label>
                        </div>
                        <div class="form-check mr-4">
                            <input class="form-check-input" type="radio" name="tipe" id="truk"
                                value="Truk/Lainnya" @if ($getParkir->vehicle->tipe == 'Truk/Lainnya') checked @endif>
                            <label class="form-check-label" for="truk">
                                Truk/Lainnya
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Ubah</button>
                        </div>
                        <!-- /.col -->
                    </div>

                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
</x-app-login>
