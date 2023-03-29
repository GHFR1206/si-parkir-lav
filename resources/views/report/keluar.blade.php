<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            text-align: center;
            padding: 70px 0;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        GHFRParkNet.Id
                        <p><small class="float-right">Date: {{ $tanggal_keluar }}</small></p>
                    </h2>
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
                <p class="mt-1">Masuk : {{ $getParkir->waktu_masuk }}</p>
                <p class="mt-1">Keluar : {{ $getParkir->waktu_keluar }}</p>
                <p class="mt-1">Tarif : {{ number_format($getParkir->tarif) }}</p>
                <h5 style="margin-top: -6px;">KODE PARKIR : </h5>
                <p style="margin-top: -9px;font-size:30px;">
                    {{ $getParkir->kode_parkir }}
                </p>
                <p class="mt-2" style="font-size:10px;">Terimakasih telah menggunakan layanan kami!/p>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>


</html>
