<x-app-layout title="Tarif Parkir" header="Data Tarif Parkir">
    <!-- Small boxes (Stat box) -->
    <div class="row d-flex justify-content-center">
        <div class="col-sm-12 mb-3 d-flex justify-content-end">
            <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
        </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row d-flex justify-content-center">
        <!-- Tabel Kendaraan Aktif -->
        <div class="col-10 mb-5">
            <div class="card text-center">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Tarif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getPrices as $index => $data)
                                <tr>
                                    <td>{{ $index + $getPrices->firstItem() }}</td>
                                    <td>{{ $data->tipe }}</td>
                                    <td>{{ $data->tarif }}</td>
                                    <td>
                                        <form action="{{ route('tarif.edit', $data->id) }}" class="d-inline"
                                            method="GET">
                                            <button type="submit" class="btn btn-warning"><i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                        </form>
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
