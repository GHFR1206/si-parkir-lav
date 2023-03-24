<x-app-layout title="Register Kendaraan">
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="register-box">
                <div class="register-logo">
                    <a href="#"><b>GHFR</b>ParkNet.Id</a>
                </div>

                @if ($parkir == 'keluar')
                    <div class="alert alert-danger">Kode sudah digunakan/kadaluarsa.</div>
                @endif

                <div class="card">
                    <div class="card-body register-card-body">
                        <p class="login-box-msg">Daftarkan kendaraan anda disini</p>
                        <form action="{{ route('user.update', $data->kode_parkir) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('kode_parkir') is-invalid @enderror"
                                    name="kode_parkir" id="kode_parkir" placeholder="Masukkan Kode Parkir Untuk Keluar"
                                    autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    </div>
                                </div>
                                @error('kode_parkir')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <!-- /.col -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Keluar</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                    <!-- /.form-box -->
                </div><!-- /.card -->
            </div>
            <!-- /.register-box -->
        </div>
    </div>
</x-app-layout>
