<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Parking;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{

    public $parkir;
    public function __construct($parkir = null)
    {
        $this->parkir = $parkir;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aktif = Parking::with('vehicle')->where('status', 'aktif')->get()->count();
        $motor = Parking::whereHas('vehicle', function ($query) {
            $query->where('tipe', 'Motor');
        })->where('status', 'Aktif')->count();

        $mobil = Parking::whereHas('vehicle', function ($query) {
            $query->where('tipe', 'Mobil');
        })->where('status', 'Aktif')->count();

        $truk = Parking::whereHas('vehicle', function ($query) {
            $query->where('tipe', 'Truk/Lainnya');
        })->where('status', 'Aktif')->count();

        $dataaktifs = Parking::with('vehicle')->where('status', 'aktif')->paginate('7');
        $pendapatan = Parking::sum('tarif');
        return view('parkir.index', compact('aktif', 'dataaktifs', 'pendapatan', 'motor', 'mobil', 'truk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submit = 'Masuk';
        $export = null;
        $parkir = null;
        return view('parkir.create', compact('submit', 'export', 'parkir'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Parking $parking)
    {
        $waktu_masuk = Carbon::now()->toDateTimeString();
        $merk = $request->merk;
        $tipe = $request->tipe;

        $getVehicle = Vehicle::where('no_kendaraan', str_replace(' ', '', strtoupper($request->no_kendaraan)))->latest()->first();

        // Melakukan cek pada database apakah data kendaraan sudah ada dan belum keluar parkir.

        if ($getVehicle) {
            $data = Parking::with('vehicle')->where('vehicle_id', $getVehicle->vehicle_id)->first();
            if ($data->status == 'Aktif') {
                $data = $data;
                $jam_masuk = Carbon::parse($data->waktu_masuk)->format('H:i:s');
                $tanggal_masuk = Carbon::now()->format('M d Y');
                $parkir = 'belumKeluar';
                $export = null;
                return view('parkir.create', compact('data', 'jam_masuk', 'tanggal_masuk', 'parkir', 'export'));
            }
        }

        // Membuat Kode Parkir
        $hari = substr(Carbon::now()->setTimezone('Asia/Jakarta')->isoFormat('dddd'), 0, 1);
        $today = Carbon::now()->isoFormat('DMMYY');
        $last = $parking->latest('created_at')->first();
        if ($last) {
            $no = substr($last->kode_parkir, 9, 5);
            $no++;
            $kode_parkir = $hari . $today . sprintf("%05s", $no);
        } else {
            $kode_parkir = $hari . $today . sprintf("%05s", 1);
        }

        if ($tipe == 'Motor') {
            $tarif = "2000";
        } elseif ($tipe == 'Mobil') {
            $tarif = "3000";
        } else {
            $tarif = "5000";
        }

        // Cek vehicle apakah sudah ada
        if ($getVehicle) {
            $vehicle = $getVehicle->vehicle_id;
        } else {
            // Menyimpan data kendaraan ke tabel vehicle
            $pengendara = Vehicle::create([
                'no_kendaraan' => str_replace(' ', '', strtoupper($request->no_kendaraan)),
                'tipe' => $request->tipe,
                'merk' => $request->merk
            ]);
            $vehicle = $pengendara->vehicle_id;
        }


        $parkir = Parking::create([
            'kode_parkir' => $kode_parkir,
            'vehicle_id' => $vehicle,
            'waktu_masuk' => $waktu_masuk,
            'status' => 'Aktif',
            'petugas' => Auth::user()->id,
            'tarif' => $tarif
        ]);

        $submit = 'Masuk';
        $export = true;

        return view('parkir.create', compact('parkir', 'submit', 'export'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $parkir)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function data_selesai()
    {
        $selesai = Parking::with('vehicle')->where('status', 'Keluar')->get()->count();
        return view('parkir.data-selesai', compact('selesai'));
    }

    public function showParkirKeluar()
    {
        dd('ok');
        return view("parkir.keluar");
    }

    public function parkirKeluar(Request $request, $parkir)
    {

        $getParkir = Parking::where('kode_parkir', $parkir)->first();

        //menghitung selisih jam masuk ke jam keluar sekaligus menentukan tarif
        $waktu_keluar = Carbon::now()->setTimezone('Asia/Jakarta');
        $keluar = strtotime($waktu_keluar);
        $waktu_masuk = strtotime($getParkir->waktu_masuk);

        $diff = $keluar - $waktu_masuk;
        if (floor($diff / (60 * 60)) == 0.0) {
            $tarif = $getParkir->tarif;
        } else {
            $jam = floor($diff / (60 * 60));
            $tarif  = $getParkir->tarif * ceil($jam);
        }
        $hasil_rupiah = "Rp " . number_format($tarif, 0, ',', '. ');

        //update data ke tabel parking
        $getParkir->update([
            'waktu_keluar' => $waktu_keluar,
            'tarif' => $tarif,
            'petugas' => Auth::user()->id,
            'status' => 'Keluar'
        ]);

        session()->flash('success');
        return redirect()->route('parkir.index')->with([
            'getParkir' => $getParkir,
            'hasil_rupiah' => $hasil_rupiah,
        ]);
    }
}
