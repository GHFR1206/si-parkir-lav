<x-app-login title="Masuk Parkir">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('home') }}"><b>GHFR</b>ParkNet.Id</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Daftarkan kendaraan anda disini</p>

                @if ($parkir == 'belumKeluar')
                    <div class="alert alert-danger">Pengendara sedang parkir dan belum keluar.</div>
                @endif
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    @include('includes._form')
                </form>
                <small class="text-muted">
                    Anda sudah
                    masuk? Isi data seperti sebelumnya ya :)
                </small>

            </div>
            <!-- /.login-card-body -->
        </div>
        <a href="{{ route('login') }}"><small class="text-muted">Khusus admin atau petugas</small></a>
    </div>
    <!-- /.login-box -->
</x-app-login>
