<x-app-layout selesai="active" header="Data Parkir Keluar">
    <!-- Small boxes (Stat box) -->
    <div class="row d-flex justify-content-end">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $aktif }}</h3>

                    <p>Kendaraan Aktif</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-car"></i>
                </div>
                <a href="{{ route('home') }}" class="small-box-footer">Info lanjut <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $selesai }}</h3>

                    <p>Kendaraan Selesai</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-car"></i>
                </div>
                <a href="#kendaraan_selesai" class="small-box-footer">Info lanjut <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- Main row -->
    <div class="row" id="kendaraan_selesai">
        <!-- Tabel Kendaraan Keluar -->
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Kendaraan</th>
                                <th>Kode Unik</th>
                                <th>Merk</th>
                                <th>Tipe</th>
                                <th>Waktu Masuk</th>
                                <th>Waktu Keluar</th>
                                <th>Tarif</th>
                                @can('hapus')
                                    <th>Aksi</th>
                                @endcan

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataselesais as $index => $data)
                                <tr>
                                    <td>{{ $index + $dataselesais->firstItem() }}</td>
                                    <td>{{ $data->no_kendaraan }}</td>
                                    <td>{{ $data->kode_unik }}</td>
                                    <td>{{ $data->merk }}</td>
                                    <td>{{ $data->tipe }}</td>
                                    <td>{{ $data->waktu_masuk }}</td>
                                    <td>{{ $data->waktu_keluar }}</td>
                                    <td>Rp. {{ number_format($data->tarif) }}-</td>
                                    @can('hapus')
                                        <td>
                                            <a href="{{ route('parkir.exit.user', $data->kode_unik) }}"
                                                class="btn btn-danger">Keluar</a>
                                        </td>
                                    @endcan

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $dataselesais->links() }}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- /.row (main row) -->
</x-app-layout>
