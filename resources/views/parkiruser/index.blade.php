<x-app-layout title="Register Kendaraan">
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
    <div class="register-box">
        <div class="register-logo">
          <a href="#"><b>GHFR</b>ParkNet.Id</a>
        </div>
      
        <div class="card">
          <div class="card-body register-card-body">
            <p class="login-box-msg">Daftarkan kendaraan anda disini</p>
            <form action="{{ route('user.store') }}" method="POST">
              @csrf
              @include('layouts._form')
            </form>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
        <a href="{{ route('login') }}"><small class="text-muted">Khusus admin atau petugas</small></a>
      </div>
      <!-- /.register-box -->
        </div>
    </div>
</x-app-layout>