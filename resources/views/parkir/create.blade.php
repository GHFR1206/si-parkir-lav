<x-app-layout title="Register Kendaraan" tambah="active">

  <div class="container-fluid mt-n4">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/parkir/masuk">Parkir Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/parkir/keluar">Parkir Keluar</a>
                        </li>
                    </ul>
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
                                                        @include('layouts._form')
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
                                                        @if($parkir == 'belumKeluar')
                                                        <div class="col-lg text-center">
                                                            <h3>NOMOR POLISI KENDARAAN SUDAH MASUK TEMPAT PARKIR DAN BELUM KELUAR</h3>
                                                        </div>
                                                        @elseif($parkir)
                                                        <div class=" container text-center p-0">
                                                            <h5>Tiket Parkir</h5>
                                                            <br>
                                                            <p class="p-0" style="margin-top: -12px !important; font-size:10px">Thamrin Office Park AA03 Jl. Boulevard, Jl. Teluk Betung, RT.11/RW.9, Kb. Melati, Kecamatan Tanah Abang , Daerah Khusus Ibukota Jakarta, 10240.</p>
                                                            <p class="mt-1">{{$waktu_masuk}}</p>
                                                            <h5 style="margin-top: -6px;">KODE PARKIR : </h5>
                                                            <p style="margin-top: -9px;font-size:30px;">{{$kode_unik}}</p>
                                                            <p class="mt-2" style="font-size:10px;">1. KERUSAKAN & KEHILANGAN BARANG DALAM KENDARAAN JADI TANGGUNG JAWAB PEMILIK (TIDAK ADA PENGGANTIAN) <br>
                                                                2. BERLAKU 1X (SATU KALI) PARKIR</p>
                                                        </div>
                                                        @else
                                                        <div class="col-lg text-center">
                                                            <h3>SILAHKAN INPUT KENDARAAN MASUK UNTUK MENDAPATKAN TIKET PARKIR</h3>
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
