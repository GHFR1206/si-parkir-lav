<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Parking;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserExitRequest;
use App\Http\Requests\TambahKendaraanRequest;

class ParkingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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


        if ($request->has('search')) {
            $getParkir = Parking::with('vehicle')->whereHas('vehicle', function ($query) {
                $search = request('search');
                $query->where('no_kendaraan', 'LIKE', '%' . $search . '%');
            })->where('status', 'Aktif')->latest()->paginate('7');
        } else {
            $getParkir = Parking::with('vehicle')->where('status', 'aktif')->latest()->paginate('7');
        }
        return view('parkir.index', compact('aktif', 'getParkir', 'motor', 'mobil', 'truk'));
    }

    public function data_keluar(Request $request)
    {
        $keluar = Parking::with('vehicle')->where('status', 'keluar')->get()->count();
        $motor = Parking::whereHas('vehicle', function ($query) {
            $query->where('tipe', 'Motor');
        })->where('status', 'keluar')->count();

        $mobil = Parking::whereHas('vehicle', function ($query) {
            $query->where('tipe', 'Mobil');
        })->where('status', 'keluar')->count();

        $truk = Parking::whereHas('vehicle', function ($query) {
            $query->where('tipe', 'Truk/Lainnya');
        })->where('status', 'keluar')->count();


        if ($request->has('search')) {
            $getParkir = Parking::with('vehicle')->whereHas('vehicle', function ($query) {
                $search = request('search');
                $query->where('no_kendaraan', 'LIKE', '%' . $search . '%');
            })->where('status', 'keluar')->latest()->paginate('7');
        } else {
            $getParkir = Parking::with('vehicle')->where('status', 'keluar')->latest()->paginate('7');
        }

        $pendapatan = Parking::sum('tarif');
        return view('parkir.data-keluar', compact('keluar', 'getParkir', 'pendapatan', 'motor', 'mobil', 'truk'));
    }

    public function detail($parkir)
    {
        $getParkir = Parking::with('vehicle', 'user')->find($parkir);
        return view('parkir.detail', compact('getParkir'));
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
        return view('parkir.masuk', compact('submit', 'export', 'parkir'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TambahKendaraanRequest $request, Parking $parking)
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
                return view('parkir.masuk', compact('data', 'jam_masuk', 'tanggal_masuk', 'parkir', 'export'));
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
            ]);
            $vehicle = $pengendara->vehicle_id;
        }


        $parkir = Parking::create([
            'kode_parkir' => $kode_parkir,
            'vehicle_id' => $vehicle,
            'waktu_masuk' => $waktu_masuk,
            'status' => 'Aktif',
            'user_id' => Auth::user()->user_id,
            'tarif' => $tarif
        ]);

        $submit = 'Masuk';
        $export = true;

        return view('parkir.masuk', compact('parkir', 'submit', 'export'));
    }

    public function keluar(Request $request, $parkir)
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
            'user_id' => Auth::user()->user_id,
            'status' => 'Keluar'
        ]);

        session()->flash('suksesKeluarParking');
        return redirect()->route('parkir.index')->with([
            'getParkir' => $getParkir,
            'hasil_rupiah' => $hasil_rupiah,
        ]);
    }

    public function data_selesai()
    {
        $selesai = Parking::with('vehicle')->where('status', 'Keluar')->get()->count();
        return view('parkir.data-selesai', compact('selesai'));
    }

    public function parkirKeluar(Request $request)
    {
        //query tabel parkir sesuai dengan kode dari request

        $getParkir = Parking::with('vehicle')->where('kode_parkir', $request->kode_parkir)->first();

        if ($getParkir) {
            //validasi kode parkir apakah kode sudah pernah dipakai atau tidak
            if ($getParkir->status == 'Keluar') {
                $parkir = 'keluar';
                $export = null;
                return view('parkir.keluar', compact('getParkir', 'parkir', 'export'));
            } else {
                //jika kode parkir sesuai, menghitung selisih jam masuk ke jam keluar sekaligus menentukan tarif
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
                $parkir = 'bayar';
                $export = true;
                return view('parkir.keluar', compact('getParkir', 'parkir', 'hasil_rupiah', 'export'));
            }
        } else if ($request->kode_parkir) {
            $parkir = 'notCode';
            $export = null;
            return view('parkir.keluar', compact('getParkir', 'parkir', 'export'));
        } else {
            $parkir = null;
            $export = null;
            return view('parkir.keluar', compact('getParkir', 'parkir', 'export'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $parkir
     * @return \Illuminate\Http\Response
     */
    public function edit($parkir)
    {
        $getParkir = Parking::with('vehicle')->find($parkir);
        return view('parkir.edit', compact('getParkir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $parkir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $parkir)
    {
        $getParkir = Parking::find($parkir);
        $getVehicle = Vehicle::find($getParkir->vehicle_id);

        $request->validate([
            'no_kendaraan' => ['required'],
            'waktu_masuk' => ['required'],
        ]);

        $getParkir->update([
            'waktu_masuk' => $request->waktu_masuk,
            'waktu_keluar' => $request->waktu_keluar,
        ]);

        $getVehicle->update([
            'no_kendaraan' => $request->no_kendaraan,
            'tipe' => $request->tipe,
        ]);

        session()->flash('suksesUpdateParkir');
        return redirect()->route('parkir.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parking  $Parking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parking $Parking, $parkir)
    {
        $getParkir = Parking::with('vehicle')->find($parkir);
        $getVehicle = Vehicle::find($getParkir->vehicle_id);

        $getVehicle->delete();
        $getParkir->delete();

        session()->flash('suksesHapusParkir');
        return redirect()->route('parkir.index');
    }
}
