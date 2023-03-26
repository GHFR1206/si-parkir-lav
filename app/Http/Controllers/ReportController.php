<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function exportPDF($parkir)
    {
        $getParkir = Parking::where('kode_parkir', $parkir)->first();
        $tanggal_masuk = Carbon::parse($getParkir->waktu_masuk)->format('d/m/y');

        view()->share('getParkir', $getParkir);
        $pdf = PDF::loadView('export.invoice', compact('getParkir', 'tanggal_masuk'))->setPaper('B6');
        return $pdf->download("$getParkir->kode_parkir" . '.pdf');
    }

    public function print($parkir)
    {
        $getParkir = Parking::where('kode_parkir', $parkir)->first();
        $tanggal_masuk = Carbon::parse($getParkir->waktu_masuk)->format('d/m/y');
        return view('export.invoice', compact('getParkir', 'tanggal_masuk'));
    }
}
