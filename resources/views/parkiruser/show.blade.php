 <x-app-layout>
     <div class="container mt-0">
         <div class="row justify-content-center">
             <div class="card text-center col-8">
                 <div class="card-header">
                     <h6>Informasi Parkir</h6>
                 </div>
                 <div class="card-body">
                     <p>Kode Anda Adalah</p>
                     <h4>
                         <p><b>{{ $data->kode_parkir }}</b></p>
                     </h4>
                 </div>
                 <ul class="list-group list-group-flush">
                     <li class="list-group-item"></li>
                     <li class="list-group-item">Nomor Polisi : <b>{{ $data->vehicle->no_kendaraan }}</b></li>
                     <li class="list-group-item">Merk : <b>{{ $data->vehicle->merk }}</b></li>
                     <li class="list-group-item">Tipe : <b>{{ $data->vehicle->tipe }}</b></li>
                     <li class="list-group-item">Waktu Masuk : <b>{{ $jam_masuk }}</b></li>
                     <li class="list-group-item">Tarif/jam : <b>Rp. {{ number_format($data->tarif) }}-</b></li>
                 </ul>
                 <p class="card-text mt-2"><small class="text-muted">Jangan tutup halaman ini.</small></p>
                 <a href="{{ route('user.keluar', $data->kode_parkir) }}" class="btn btn-primary btn-sm btn-block">Exit
                     Parkir</a>
                 <div class="card-footer text-muted">
                     {{ $tanggal_masuk }}
                 </div>
             </div>
         </div>
     </div>
 </x-app-layout>
