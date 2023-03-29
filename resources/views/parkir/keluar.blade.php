<x-app-layout title="Keluar Parkir">

    <div class="container-fluid mt-n4">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        @include('includes._card-navbar')
                    </div>

                    <div class="card-body">
                        <div class="row icon-examples">
                            <div class="col-lg">
                                <div class="card-group">
                                    <div class="col-lg-6">
                                        <div class="card" style="height: 28rem;">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Kendaraan Keluar</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="container h-100">
                                                    <div class="row align-items-center h-100">
                                                        <div class="col mx-auto">
                                                            <form action="{{ route('parkir.postKeluar') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group row">
                                                                    <label for="tanggal"
                                                                        class="col-sm-4 col-form-label"
                                                                        style="font-size:13px;">Tanggal / Waktu</label>
                                                                    <div class="col-sm-8">
                                                                        <p class="text-muted"><span
                                                                                id="tanggal"></span> ; <span
                                                                                id="watch"></span></p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="nomor"
                                                                        class="col-sm-4 col-form-label"
                                                                        style="font-size:13px;">Kode Parkir</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text"
                                                                            class="form-control @error('kode_parkir') is-invalid @enderror"
                                                                            id="kode_parkir" name="kode_parkir">
                                                                        @error('kode_parkir')
                                                                            <span
                                                                                class="invalid-feedback">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row text-right">
                                                                    <div class="col-sm">
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card" style="height: 28rem;">
                                            <div class=" card-header">
                                                <h5 class="card-title mb-0">Tiket parkir</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="container h-100">
                                                    <div class="row align-items-center h-100">
                                                        <div class="col mx-auto">
                                                            @if (!$getParkir && !$parkir)
                                                                <div class="col-lg text-center">
                                                                    <h4>SILAHKAN SUBMIT KODE PARKIR TERLEBIH DAHULU</h4>
                                                                </div>
                                                            @elseif ($parkir == 'keluar')
                                                                <div class="col-lg text-center">
                                                                    <h3>KODE PARKIR SUDAH EXPIRED (KENDARAAN SUDAH
                                                                        KELUAR PARKIR)</h3>
                                                                </div>
                                                            @elseif ($parkir == 'notCode')
                                                                <div class="col-lg text-center">
                                                                    <h4>KODE TIDAK DITEMUKAN</h4>
                                                                </div>
                                                            @elseif ($getParkir)
                                                                <div class="col-lg text-center">
                                                                    <h3>KODE PARKIR : {{ $getParkir->kode_parkir }}</h3>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-lg-5">
                                                                        <p>Total Bayar</p>
                                                                    </div>
                                                                    <div class=" col-lg-7">
                                                                        <h2 class="text-danger">{{ $hasil_rupiah }}</h2>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-5"
                                                                        style="margin-top: -10px !important;">
                                                                        <p class="mt-4">Nomor Polisi</p>
                                                                    </div>
                                                                    <div class="col-lg-7"
                                                                        style="margin-top: -10px !important;">
                                                                        <p class="mt-4">:
                                                                            {{ $getParkir->vehicle->no_kendaraan }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: -10px;">
                                                                    <div class="col-lg-5">
                                                                        <p sty>Jenis Kendaraan</p>
                                                                    </div>
                                                                    <div class="col-lg-7">
                                                                        <p>: {{ $getParkir->vehicle->tipe }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: -10px;">
                                                                    <div class="col-lg-5">
                                                                        <p sty>Waktu Masuk</p>
                                                                    </div>
                                                                    <div class=" col-lg-7">
                                                                        <p>: {{ $getParkir->waktu_masuk }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row" style="margin-top: -10px;">
                                                                    <div class="col-lg-5">
                                                                        <p sty>Waktu Keluar</p>
                                                                    </div>
                                                                    <div class=" col-lg-7">
                                                                        <p>: {{ $getParkir->waktu_keluar }}</p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($export)
                                            <a class="btn btn-primary"
                                                href="{{ route('report.exportKeluar', $getParkir->kode_parkir) }}"><i
                                                    class="fas fa-file-pdf"></i></a>
                                            <a href="#" rel="noopener" target="_blank" onclick="window.print();"
                                                class="btn btn-primary"><i class="fas fa-print"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
