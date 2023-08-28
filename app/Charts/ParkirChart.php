<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Parking;
use Carbon\CarbonImmutable;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ParkirChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $now = CarbonImmutable::now();
        $tahun = Carbon::now()->format('Y');

        $januariAwal = $now->startOfYear();
        $januariAkhir = $januariAwal->endOfMonth();

        $februariAwal = $januariAwal->addMonth(1)->startOfMonth();
        $februariAkhir = $februariAwal->endOfMonth();

        $maretAwal = $februariAwal->addMonth(1)->startOfMonth();
        $maretAkhir = $maretAwal->endOfMonth();

        $aprilAwal = $maretAwal->addMonth(1)->startOfMonth();
        $aprilAkhir = $aprilAwal->endOfMonth();

        $meiAwal = $aprilAwal->addMonth(1)->startOfMonth();
        $meiAkhir = $meiAwal->endOfMonth();

        $juniAwal = $meiAwal->addMonth(1)->startOfMonth();
        $juniAkhir = $juniAwal->endOfMonth();

        $juliAwal = $juniAwal->addMonth(1)->startOfMonth();
        $juliAkhir = $juliAwal->endOfMonth();

        $agustusAwal = $juliAwal->addMonth(1)->startOfMonth();
        $agustusAkhir = $agustusAwal->endOfMonth();

        $septemberAwal = $agustusAwal->addMonth(1)->startOfMonth();
        $septemberAkhir = $septemberAwal->endOfMonth();

        $oktoberAwal = $septemberAwal->addMonth(1)->startOfMonth();
        $oktoberAkhir = $oktoberAwal->endOfMonth();

        $novemberAwal = $oktoberAwal->addMonth(1)->startOfMonth();
        $novemberAkhir = $novemberAwal->endOfMonth();

        $desemberAwal = $novemberAwal->addMonth(1)->startOfMonth();
        $desemberAkhir = $desemberAwal->endOfMonth();

        $januari = Parking::whereBetween('created_at', [$januariAwal, $januariAkhir])->count();
        $februari = Parking::whereBetween('created_at', [$februariAwal, $februariAkhir])->count();
        $maret = Parking::whereBetween('created_at', [$maretAwal, $maretAkhir])->count();
        $april = Parking::whereBetween('created_at', [$aprilAwal, $aprilAkhir])->count();
        $mei = Parking::whereBetween('created_at', [$meiAwal, $meiAkhir])->count();
        $juni = Parking::whereBetween('created_at', [$juniAwal, $juniAkhir])->count();
        $juli = Parking::whereBetween('created_at', [$juliAwal, $juliAkhir])->count();
        $agustus = Parking::whereBetween('created_at', [$agustusAwal, $agustusAkhir])->count();
        $september = Parking::whereBetween('created_at', [$septemberAwal, $septemberAkhir])->count();
        $oktober = Parking::whereBetween('created_at', [$oktoberAwal, $oktoberAkhir])->count();
        $november = Parking::whereBetween('created_at', [$novemberAwal, $novemberAkhir])->count();
        $desember = Parking::whereBetween('created_at', [$desemberAwal, $desemberAkhir])->count();

        return $this->chart->areaChart()
            ->setTitle("Tahun $tahun")
            ->setSubtitle('Pengguna Parkir')
            ->addData('Pengguna parkir', [$januari, $februari, $maret, $april, $mei, $juni, $juli, $agustus, $oktober, $september, $november, $desember])
            ->setXAxis(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
    }
}
