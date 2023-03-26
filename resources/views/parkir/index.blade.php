<x-app-layout title="Data Aktif" aktif="active" header="Data Parkir Masuk">
    <!-- Small boxes (Stat box) -->
    <div class="row d-flex justify-content-center">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>Rp. {{ number_format($pendapatan, 0, ',', '.') }}</h3>

                    <p>Total Pendapatan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $motor }}</h3>

                    <p>Motor</p>
                </div>
                <div class="icon">
                    <i class="fas fa-motorcycle"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $mobil }}</h3>

                    <p>Mobil</p>
                </div>
                <div class="icon">
                    <i class="fas fa-car"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $truk }}</h3>

                    <p>Truk / Lainnya</p>
                </div>
                <div class="icon">
                    <i class="fas fa-truck"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Tabel Kendaraan Aktif -->
        <div class="col-12 mb-5">
            <div class="card text-center">
                <div class="card-header">
                    <h3 class="card-title">Aktif : {{ $aktif }}</h3>
                    <p class="text-right mb-n2"><span id="tanggal"></span> ; <span id="watch"></span></p>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nomor Kendaraan</th>
                                <th>Tipe</th>
                                <th>Waktu Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataaktifs as $index => $data)
                                <tr>
                                    <td>{{ $index + $dataaktifs->firstItem() }}</td>
                                    <td>{{ $data->vehicle->no_kendaraan }}</td>
                                    <td>{{ $data->vehicle->tipe }}</td>
                                    <td>{{ $data->waktu_masuk }}</td>
                                    <td>
                                        @if (Auth::user()->role == 0)
                                            <a href="#" class="btn btn-warning"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        @endif

                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('parkir.update.keluar').submit();"
                                            class="btn btn-danger"><i class="fa-solid fa-right-from-bracket"></i></a>

                                        <form action="{{ route('parkir.update.keluar', $data->kode_parkir) }}"
                                            method="POST" id="parkir.update.keluar">
                                            @csrf
                                            @method('put')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5">
                                        Belum ada yang parkir
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- /.row (main row) -->
</x-app-layout>
