<x-app-layout title="My Profile" header="My Profile">
    <div class="header">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row text-right py-4">
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
                    <div class="card-header">
                        <h5 class="mt-1">Data Pribadi</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item font-weight-bold">Nama Lengkap</li>
                                <li class="list-group-item font-weight-bold">Username</li>
                                <li class="list-group-item font-weight-bold">Email</li>
                                <li class="list-group-item font-weight-bold">Role</li>
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">{{ Auth::user()->name }}</li>
                                <li class="list-group-item">{{ Auth::user()->username }}</li>
                                <li class="list-group-item">{{ Auth::user()->email }}</li>
                                <li class="list-group-item">{{ Auth::user()->role->role }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg p-4 text-right">

                        <a href="{{ route('parkir.index') }}" class="btn btn-primary text-right">Kembali <i
                                class="fa fa-arrow-left ml-2" aria-hidden="true"></i></a>
                        <a href="{{ route('password.request') }}" class="btn btn-warning">Reset Password<i
                                class="fa fa-key ml-2" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
