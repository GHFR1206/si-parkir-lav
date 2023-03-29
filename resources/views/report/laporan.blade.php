<x-app-layout title="Laporan" header="Laporan Parkir">
    <!-- Main content -->
    <div class="header">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center text-right py-2">
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
                    <!-- Light table -->
                    <div class="card-body">
                        <div class="row icon-examples">
                            <div class="col-lg">
                                @if (session('status'))
                                    <div class="alert alert-success mt-3">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="card-group">
                                    <div class="col-lg-6">
                                        <div class="card" style="height: 26rem;">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Pilihan Laporan</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="container h-100">
                                                    <div class="row align-items-center h-100">
                                                        <div class="col mx-auto">
                                                            <form action="{{ route('report.postLaporan') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <label for="staticName"
                                                                            class="col-form-label p-0">Start
                                                                            Date</label>
                                                                        @if (!$kendaraan)
                                                                            <input type="date" class="form-control"
                                                                                id="start_date" name="start_date"
                                                                                value="{{ date('Y-m-d') }}">
                                                                        @else
                                                                            <input type="date" class="form-control"
                                                                                id="start_date" name="start_date"
                                                                                value="{{ $awal }}">
                                                                        @endif
                                                                        @error('start_date')
                                                                            <div class="mt-1">
                                                                                <small class="ml-1"
                                                                                    style="color: red;">{{ $message }}</small>
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                    <div class=" col-sm-6">
                                                                        <label for="staticName"
                                                                            class="col-form-label p-0">End Date</label>
                                                                        @if (!$kendaraan)
                                                                            <input type="date" class="form-control"
                                                                                id="end_date" name="end_date"
                                                                                value="{{ date('Y-m-d') }}">
                                                                        @else
                                                                            <input type="date" class="form-control"
                                                                                id="end_date" name="end_date"
                                                                                value="{{ $akhir }}">
                                                                        @endif
                                                                        @error('end_date')
                                                                            <div class="mt-1">
                                                                                <small class="ml-1"
                                                                                    style="color: red;">{{ $message }}</small>
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class=" form-group row">
                                                                    <div class="col-sm">
                                                                        <label for="validationTooltip04">Pilih Jenis
                                                                            Kendaraan</label>
                                                                        <select class="custom-select" name="tipe"
                                                                            id="validationTooltip04" required>
                                                                            @if (!$kendaraan)
                                                                                <option value="All">Semua Kendaraan
                                                                                </option>
                                                                                <option value="Mobil">Mobil</option>
                                                                                <option value="Motor">Motor</option>
                                                                                <option value="Truk/Lainnya">Truk /
                                                                                    Lainnya
                                                                                </option>
                                                                            @else
                                                                                <option value="All"
                                                                                    {{ $tipe == 'All' ? 'selected' : '' }}>
                                                                                    Semua Kendaraan</option>
                                                                                <option value="Mobil"
                                                                                    {{ $tipe == 'Mobil' ? 'selected' : '' }}>
                                                                                    Mobil</option>
                                                                                <option value="Motor"
                                                                                    {{ $tipe == 'Motor' ? 'selected' : '' }}>
                                                                                    Motor</option>
                                                                                <option value="Truk/Lainnya"
                                                                                    {{ $tipe == 'Truk/Lainnya' ? 'selected' : '' }}>
                                                                                    Truk/Lainnya</option>
                                                                            @endif
                                                                        </select>
                                                                        @error('tipe')
                                                                            <div class="mt-1">
                                                                                <small class="ml-1"
                                                                                    style="color: red;">{{ $message }}</small>
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row text-center mt-4">
                                                                    <div class="col-sm">
                                                                        <button type="submit"
                                                                            class="btn btn-primary col-lg"
                                                                            name="button"
                                                                            value="submit">Submit</button>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card" style="height: 26rem;">
                                            <div class=" card-header">
                                                <h5 class="card-title mb-0">Resume Laporan</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="container h-100">
                                                    <div class="row align-items-center h-100">
                                                        <div class="col mx-auto">
                                                            <div class="row">
                                                                @if (!$kendaraan)
                                                                    <div class="col-lg text-center">
                                                                        <h3>Silahkan Submit Untuk Mencetak Laporan</h3>
                                                                    </div>
                                                                @else
                                                                    <div class="col-lg-12 text-left">
                                                                        <ul class="list-group list-group-flush">
                                                                            <li
                                                                                class="list-group-item font-weight-bold">
                                                                                Total Kendaraan : {{ $countKendaraan }}
                                                                            </li>
                                                                            <li
                                                                                class="list-group-item font-weight-bold">
                                                                                Total Mobil : {{ $mobil }}</li>
                                                                            <li
                                                                                class="list-group-item font-weight-bold">
                                                                                Total Motor : {{ $motor }}</li>
                                                                            <li
                                                                                class="list-group-item font-weight-bold">
                                                                                Total Truk/Lainnya :
                                                                                {{ $truk }}</li>
                                                                            <li
                                                                                class="list-group-item font-weight-bold">
                                                                                Total Pendapatan : Rp.
                                                                                {{ number_format($pendapatan, 0, ',', '.') }}
                                                                            </li>
                                                                            <li class="list-group-item"></li>
                                                                        </ul>
                                                                        <div class="form-group row text-center">
                                                                            <div class=" col-lg-12 text-center">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary col-lg"
                                                                                    name="button" value="pdf"><i
                                                                                        class="fas fa-file-pdf    "></i></button>
                                                                            </div>
                                                                        </div>

                                                                        </form>
                                                                    </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
