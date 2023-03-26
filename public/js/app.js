require('./bootstrap');

    $(document).ready(function() {
        $('.print').printPage();
    });

    @if (Session::has('success'))
        toastr.success('Kendaraan berhasil keluar!', 'Berhasil Keluar')
    @endif