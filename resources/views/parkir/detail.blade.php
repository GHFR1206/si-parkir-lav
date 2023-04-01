<x-app-layout title="Detail" header="({{ $getParkir->vehicle->no_kendaraan }}) Detail">
    <div class="header">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row text-right py-4">
                    <div class="col-lg-12 col-5">
                        <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row justify-content-center">
            <div class="col-lg">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mt-1">Data Parkir</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item font-weight-bold">No Kendaraan</li>
                                <li class="list-group-item font-weight-bold">Kode Parkir</li>
                                <li class="list-group-item font-weight-bold">Tipe</li>
                                <li class="list-group-item font-weight-bold">Petugas</li>
                                <li class="list-group-item font-weight-bold">Waktu Masuk</li>
                                @if ($getParkir->status == 'Keluar')
                                    <li class="list-group-item font-weight-bold">Waktu Keluar</li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">{{ $getParkir->vehicle->no_kendaraan }}</li>
                                <li class="list-group-item">{{ $getParkir->kode_parkir }}</li>
                                <li class="list-group-item">{{ $getParkir->vehicle->tipe }}</li>
                                <li class="list-group-item">
                                    @if ($getParkir->petugas == 0)
                                        Admin
                                    @elseif ($getParkir->petugas == 1)
                                        Petugas
                                    @else
                                        User
                                    @endif
                                </li>
                                <li class="list-group-item">{{ $getParkir->waktu_masuk }}</li>
                                @if ($getParkir->status == 'Keluar')
                                    <li class="list-group-item">{{ $getParkir->waktu_keluar }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg p-4 text-right">
                        @if ($getParkir->status == 'Aktif')
                            <a href="{{ route('parkir.index') }}" class="btn btn-primary text-right">Kembali <i
                                    class="fa fa-arrow-left ml-2" aria-hidden="true"></i></a>
                            <a class="btn btn-primary"
                                href="{{ route('report.exportInvoice', $getParkir->kode_parkir) }}"><i
                                    class="fas fa-file-pdf"></i></a>
                        @else
                            <a href="{{ route('parkir.data-keluar') }}" class="btn btn-primary text-right">Kembali <i
                                    class="fa fa-arrow-left ml-2" aria-hidden="true"></i></a>
                            <a class="btn btn-primary"
                                href="{{ route('report.exportKeluar', $getParkir->kode_parkir) }}"><i
                                    class="fas fa-file-pdf"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
