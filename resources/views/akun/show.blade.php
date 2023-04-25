<x-app-layout title="{{ $getAkun->username }} Profile" header="{{ $getAkun->name }}">
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
                                <li class="list-group-item">{{ $getAkun->name }}</li>
                                <li class="list-group-item">{{ $getAkun->username }}</li>
                                <li class="list-group-item">{{ $getAkun->email }}</li>
                                @if ($getAkun->role->role == 'Admin')
                                    <li class="list-group-item">Admin</li>
                                @else
                                    <li class="list-group-item">Petugas</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg p-4 text-right">

                        <a href="{{ route('akun.index') }}" class="btn btn-primary text-right">Kembali <i
                                class="fa fa-arrow-left ml-2" aria-hidden="true"></i></a>

                        <a href="{{ route('akun.edit', $getAkun->id) }}" class="btn btn-warning"><i
                                class="fa-solid fa-pen-to-square"></i></a>

                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('akun.destroy').submit();"
                            class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        <form action="{{ route('akun.destroy', $getAkun->id) }}" method="POST" id="akun.destroy">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
