<x-app-layout title="Edit | GHFRParkNet.Id">
    <div class="container">
        <div class="row justify-content-center">
            <div class="login-box">
                <div class="login-logo">
                    <a href="{{ route('home') }}"><b>GHFR</b>ParkNet.Id</a>
                </div>
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Edit Informasi Akun</p>
                        <form action="{{ route('akun.update', $getAkun->id) }}" method="post">
                            @method('PUT')
                            @include('includes._editAkun-form')
                        </form>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
