<x-app-layout title="Register Kendaraan" tambah="active">

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
                                                <h5 class="card-title mb-0">Input Kendaraan Masuk</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="container h-100">
                                                    <div class="row align-items-center h-100">
                                                        <div class="col mx-auto">
                                                            <form action="{{ route('parkir.store') }}" method="POST">
                                                                @csrf
                                                                @include('includes._form')
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
                                                <div class="container h-100 print-container">
                                                    <div class="row align-items-center h-100">
                                                        <div class="col mx-auto">
                                                            @if ($parkir == 'belumKeluar')
                                                                <div class="col-lg text-center">
                                                                    <h3>NOMOR POLISI KENDARAAN SUDAH MASUK TEMPAT PARKIR
                                                                        DAN BELUM KELUAR</h3>
                                                                </div>
                                                            @elseif($parkir)
                                                                <div class="container text-center p-0 print-container">
                                                                    <h5>Tiket Parkir</h5>
                                                                    <br>
                                                                    <p class="p-0"
                                                                        style="margin-top: -12px !important; font-size:10px">
                                                                        SMKN 1 Ciomas Jl.
                                                                        Raya Laladon, Laladon, Kecamatan
                                                                        Ciomas , Jawa Barat,
                                                                        16610.</p>
                                                                    <p class="mt-1">{{ $parkir->waktu_masuk }}</p>
                                                                    <h5 style="margin-top: -6px;">KODE PARKIR : </h5>
                                                                    <p style="margin-top: -9px;font-size:30px;">
                                                                        {{ $parkir->kode_parkir }}</p>
                                                                    <p class="mt-2" style="font-size:10px;">1.
                                                                        KERUSAKAN & KEHILANGAN BARANG DALAM KENDARAAN
                                                                        JADI TANGGUNG JAWAB PEMILIK (TIDAK ADA
                                                                        PENGGANTIAN) <br>
                                                                        2. BERLAKU 1X (SATU KALI) PARKIR</p>
                                                                </div>
                                                            @else
                                                                <div class="col-lg text-center">
                                                                    <h3>SILAHKAN INPUT KENDARAAN MASUK UNTUK MENDAPATKAN
                                                                        TIKET PARKIR</h3>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($export)
                                            <a class="btn btn-primary"
                                                href="{{ route('exportPDF', $parkir->kode_parkir) }}"><i
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

{{-- 
  <div class="container mt-5">
      <div class="row justify-content-center mt-5">
        <div class="register-box">
          <div class="register-logo">
            <a href="#"><b>GHFR</b>ParkNet.Id</a>
          </div>
    
          <div class="card">
            <div class="card-body register-card-body">
              <div class="row">
                <div class="col-lg">
                  <div class="card-group">
                    <div class="col-lg-6">
                      <div class="card">
                        <div class="card-body">
                          <p class="login-box-msg">Daftarkan kendaraan user disini</p>
                            <form action="{{ route('parkir.store') }}" method="POST">
                              @csrf
                              @include('layouts._form')
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.form-box -->
          </div>
          <!-- /.card -->
    </div>
    <!-- /.register-box -->
      </div>
  </div> --}}
