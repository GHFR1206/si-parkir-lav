<x-app-login title="Ubah Data Tarif">
    <div class="login-box">
        <div class="login-logo">
            <a class="text-white" href="{{ route('home') }}"><b>GHFR</b>ParkNet.Id</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ubah data tarif disini</p>

                <form action="{{ route('tarif.update', $getPrice->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <fieldset disabled="disabled">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control text-muted" value="{{ $getPrice->tipe }}"
                                placeholder="Tipe" autocomplete="off">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa-solid fa-car"></span>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="input-group mb-3">
                        <input type="number" class="form-control @error('tarif') is-invalid @enderror" name="tarif"
                            value="{{ $getPrice->tarif }}" placeholder="tarif" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-dollar-sign"></span>
                            </div>
                        </div>
                        @error('tarif')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
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
