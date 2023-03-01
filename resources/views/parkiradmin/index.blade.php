<x-app-layout title="Data Aktif" aktif="active" header="Data Kendaraan Aktif">
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
              <a href="#kendaraan_aktif" class="small-box-footer">Info lanjut <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="{{ route('admin.data.selesai') }}" class="small-box-footer">Info lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Tabel Kendaraan Aktif -->
          <div class="col-12 mb-5">
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
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($dataaktifs as $index => $data)
                    <tr>
                      <td>{{ $index + $dataaktifs->firstItem()  }}</td>
                      <td>{{ $data->no_kendaraan }}</td>
                      <td>{{ $data->kode_unik }}</td>
                      <td>{{ $data->merk }}</td>
                      <td>{{ $data->tipe }}</td>
                      <td>{{ $data->waktu_masuk }}</td>
                      <td>
                        <a href="#" class="btn btn-warning">Edit</a>
                        <a href="{{ route('admin.exit.user', $data->kode_unik) }}" class="btn btn-danger">Keluar</a>
                      </td>
                    </tr>
                    @endforeach
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
