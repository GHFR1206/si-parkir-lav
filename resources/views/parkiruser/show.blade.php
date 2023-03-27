 <x-app-login title="Informasi Parkir">
     <div class="container mt-5">
         <div class="row justify-content-center">
             <section class="invoice col-8">
                 <!-- title row -->
                 <div class="row">
                     <div class="col-12">
                         <i class="fas fa-globe"></i> GHFRParkNet.Id
                     </div>
                     <!-- /.col -->
                 </div>

                 <div class="container text-center p-0">
                     <h5>Tiket Parkir</h5>
                     <br>
                     <p class="p-0" style="margin-top: -12px !important; font-size:10px">
                         SMKN 1 Ciomas Jl.
                         Raya Laladon, Laladon, Kecamatan
                         Ciomas , Jawa Barat,
                         16610.</p>
                     <p class="mt-1">{{ $data->waktu_masuk }}</p>
                     <h5 style="margin-top: -6px;">KODE PARKIR : </h5>
                     <p style="margin-top: -9px;font-size:30px;">
                         {{ $data->kode_parkir }}</p>
                     <p class="mt-2" style="font-size:10px;">1.
                         KERUSAKAN & KEHILANGAN BARANG DALAM KENDARAAN
                         JADI TANGGUNG JAWAB PEMILIK (TIDAK ADA
                         PENGGANTIAN) <br>
                         2. BERLAKU 1X (SATU KALI) PARKIR</p>
                 </div>


                 <a href="{{ route('user.keluar', $data->kode_parkir) }}" class="btn btn-primary btn-sm btn-block">Exit
                     Parkir</a>
                 <div class="card-footer text-muted text-center">
                     {{ $tanggal_masuk }}
                 </div>
             </section>
         </div>
     </div>
     </div>
 </x-app-login>
