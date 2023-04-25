<x-app-layout title="Data Selesai" header="Data Parkir Keluar">
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
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('parkir.index') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('parkir.index') }}">Kendaraan
                                Aktif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('parkir.data-keluar') ? 'active' : '' }}"
                                href="{{ route('parkir.data-keluar') }}">Kendaraan
                                Keluar</a>
                        </li>
                        <li class="nav-item">
                            <p class="nav-link">Selesai : {{ $keluar }}</p>
                        </li>
                    </ul>
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
                                <th>Waktu Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($getParkir as $index => $data)
                                <tr>
                                    <td>{{ $index + $getParkir->firstItem() }}</td>
                                    <td>{{ $data->vehicle->no_kendaraan }}</td>
                                    <td>{{ $data->vehicle->tipe }}</td>
                                    <td>{{ $data->waktu_masuk }}</td>
                                    <td>{{ $data->waktu_keluar }}</td>
                                    <td>
                                        <a href="{{ route('parkir.detail', $data->id) }}" class="btn btn-primary"><i
                                                class="fa fa-eye" aria-hidden="true"></i></a>

                                        @if (Auth::user()->role->role == 'Admin')
                                            <a href="{{ route('parkir.edit', $data->id) }}" class="btn btn-warning"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>

                                            <a href="#"
                                                onclick="event.preventDefault(); document.getElementById('parkir.destroy').submit();"
                                                class="btn btn-danger"><i class="fa fa-trash"
                                                    aria-hidden="true"></i></a>

                                            <form action="{{ route('parkir.destroy', $data->id) }}" method="POST"
                                                id="parkir.destroy">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
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
            {{ $getParkir->links() }}
        </div>
    </div>

    <!-- /.row (main row) -->
</x-app-layout>
