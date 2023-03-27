 <x-app-login title="Informasi Keluar">
     <div class="container mt-3">
         <div class="row justify-content-center">
             <div class="card text-center col-8">
                 <div class="card-header">
                     <h6><b>Informasi Parkir Keluar</b></h6>
                 </div>
                 <div class="card-body">
                     <h4>
                         <p><b>{{ $data->vehicle->no_kendaraan }}</b></p>
                     </h4>
                 </div>
                 <ul class="list-group list-group-flush">
                     <li class="list-group-item">Tipe : <b>{{ $data->vehicle->tipe }}</b></li>
                     <li class="list-group-item">Waktu Masuk : <b>{{ $jam_masuk }}</b></li>
                     <li class="list-group-item">Waktu Keluar : <b>{{ $jam_keluar }}</b></li>
                     <li class="list-group-item">Tarif : <b>Rp. {{ number_format($data->tarif) }}-</b></li>
                 </ul>
                 <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm btn-block">Parkir lagi..</a>
                 <div class="card-footer text-muted">
                     {{ $tanggal_keluar }}
                 </div>
             </div>
         </div>
     </div>
 </x-app-login>
