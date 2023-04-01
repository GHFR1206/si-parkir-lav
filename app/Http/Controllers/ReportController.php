<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function report()
    {
        $kendaraan = null;
        $total = null;
        return view('report.laporan', compact('kendaraan', 'total'));
    }

    public function postReport(Request $request)
    {
        // Query data sesuai dengan filter yang diipilih
        if ($request->tipe == 'All') {
            $kendaraan = Parking::with('vehicle')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
            $vehicle = Parking::with('vehicle')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);

            // Menghitung total mobil
            $mobil = Parking::with('vehicle')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->whereHas('vehicle', function ($query) {
                $query->where('tipe', 'Mobil');
            })->count();

            // Menghitung total motor
            $motor = Parking::with('vehicle')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->whereHas('vehicle', function ($query) {
                $query->where('tipe', 'Motor');
            })->count();

            $truk = Parking::with('vehicle')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->whereHas('vehicle', function ($query) {
                $query->where('tipe', 'Truk/Lainnya');
            })->count();
        } else {
            $kendaraan = Parking::with('vehicle')->whereHas('vehicle', function ($query) use ($request) {
                $query->where('tipe', $request->tipe);
            })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
            $vehicle = Parking::with('vehicle')->whereHas('vehicle', function ($query) use ($request) {
                $query->where('tipe', $request->tipe);
            })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);

            if ($request->tipe == 'Mobil') {
                // Menghitung total mobil
                $mobil = $vehicle->whereHas('vehicle', function ($query) use ($request) {
                    $query->where('tipe', 'Mobil');
                })->count();
                $motor = 0;
                $truk = 0;
            } elseif ($request->tipe == 'Motor') {
                // Menghitung total motor
                $motor = $vehicle->whereHas('vehicle', function ($query) use ($request) {
                    $query->where('tipe', 'Motor');
                })->count();
                $mobil = 0;
                $truk = 0;
            } else {
                // Menghitung total truk
                $truk = $vehicle->whereHas('vehicle', function ($query) use ($request) {
                    $query->where('tipe', 'Truk/Lainnya');
                })->count();
                $motor = 0;
                $mobil = 0;
            }
        }



        // Mencetak laporan pada web, pdf, atau excel
        if ($request->button == "submit") {
            $awal = $request->start_date;
            $akhir = $request->end_date;
            $tipe = $request->tipe;
            $countKendaraan = $kendaraan->count();
            $pendapatan = $kendaraan->sum('tarif');
            return view('report.laporan', compact('kendaraan', 'countKendaraan', 'pendapatan', 'tipe', 'vehicle', 'motor', 'mobil', 'truk', 'awal', 'akhir'));
        } else if ($request->button == "pdf") {
            $awal = $request->start_date;
            $akhir = $request->end_date;
            $pendapatan = $kendaraan->sum('tarif');
            $countKendaraan = $kendaraan->count();

            if ($awal == $akhir) {
                $filename = 'report-' . $akhir . '.pdf';
                $tanggal = $akhir;
            } else {
                $filename = 'report-' . $awal . '---' . $akhir . '.pdf';
                $tanggal = $awal . ' --- ' . $akhir;
            }

            $pdf = PDF::loadView('report.laporanPDF', compact('kendaraan', 'countKendaraan', 'pendapatan', 'tanggal'));

            return $pdf->download($filename);
        }

        return view('report.laporan', compact('kendaraan', 'vehicle', 'motor', 'mobil', 'truk'));
    }


    public function exportInvoice($parkir)
    {
        $getParkir = Parking::where('kode_parkir', $parkir)->first();
        $tanggal_masuk = Carbon::parse($getParkir->waktu_masuk)->format('d/m/y');

        view()->share('getParkir', $getParkir);
        $pdf = PDF::loadView('report.invoice', compact('getParkir', 'tanggal_masuk'))->setPaper('B6');
        return $pdf->download("invoice-$getParkir->kode_parkir" . '.pdf');
    }

    public function exportKeluar($parkir)
    {
        $getParkir = Parking::where('kode_parkir', $parkir)->first();
        $tanggal_masuk = Carbon::parse($getParkir->waktu_masuk)->format('d/m/y');
        $tanggal_keluar = Carbon::parse($getParkir->waktu_keluar)->format('d/m/y');

        view()->share('getParkir', $getParkir);
        $pdf = PDF::loadView('report.keluar', compact('getParkir', 'tanggal_masuk', 'tanggal_keluar'))->setPaper('B6');
        return $pdf->download("keluar-$getParkir->kode_parkir" . '.pdf');
    }

    public function print($parkir)
    {
        $getParkir = Parking::where('kode_parkir', $parkir)->first();
        $tanggal_masuk = Carbon::parse($getParkir->waktu_masuk)->format('d/m/y');
        return view('report.invoice', compact('getParkir', 'tanggal_masuk'));
    }
}
