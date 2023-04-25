<x-app-layout title="Dashboard" header="Dashboard">
    <!-- Small boxes (Stat box) -->
    <div class="row d-flex justify-content-center">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>Rp. {{ number_format(3434, 0, ',', '.') }}</h3>

                    <p>Total Pendapatan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>234</h3>

                    <p>Motor</p>
                </div>
                <div class="icon">
                    <i class="fas fa-motorcycle"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>234</h3>

                    <p>Mobil</p>
                </div>
                <div class="icon">
                    <i class="fas fa-car"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>234</h3>

                    <p>Truk / Lainnya</p>
                </div>
                <div class="icon">
                    <i class="fas fa-truck"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</x-app-layout>
