<x-app-layout title="Register Kendaraan" tambah="active">
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
    <div class="register-box">
        <div class="register-logo">
          <a href="#"><b>GHFR</b>ParkNet.Id</a>
        </div>
      
        <div class="card">
          <div class="card-body register-card-body">
            <p class="login-box-msg">Daftarkan kendaraan user disini</p>
            <form action="{{ route('parkir.store') }}" method="POST">
              @csrf
              @include('layouts._form')
            </form>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
      <!-- /.register-box -->
        </div>
    </div>
</x-app-layout>