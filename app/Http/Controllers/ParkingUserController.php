<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Parking;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserExitRequest;
use App\Http\Requests\UserEnterRequest;

class ParkingUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return' \Illuminate\Http\Response
     */
    public function index()
    {

        return view('parkiruser.index', [
            'submit' => 'Masuk',
            'parkir' => 'null'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserEnterRequest $request, Parking $parking)
    {
        $waktu_masuk = Carbon::now()->toDateTimeString();
        $merk = $request->merk;
        $tipe = $request->tipe;

        // Melakukan cek pada database apakah data kendaraan sudah ada dan belum keluar parkir.
        $getVehicle = Vehicle::where('no_kendaraan', str_replace(' ', '', strtoupper($request->no_kendaraan)))->latest()->first();
        if ($getVehicle) {
            $data = Parking::with('vehicle')->where('vehicle_id', $getVehicle->vehicle_id)->first();
            if ($data->status == 'Aktif') {
                $data = $data;
                $jam_masuk = Carbon::parse($data->waktu_masuk)->format('H:i:s');
                $tanggal_masuk = Carbon::now()->format('M d Y');
                return view('parkiruser.show', compact('data', 'jam_masuk', 'tanggal_masuk'));
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

        // Menyimpan data kendaraan ke tabel vehicle
        $pengendara = Vehicle::create([
            'no_kendaraan' => str_replace(' ', '', strtoupper($request->no_kendaraan)),
            'tipe' => $request->tipe,
            'merk' => $request->merk
        ]);

        if (Auth::guest()) {
            $petugas = 'user';
        } else {
            $petugas = Auth::user()->id;
        }

        $parkir = Parking::create([
            'kode_parkir' => $kode_parkir,
            'vehicle_id' => $pengendara->vehicle_id,
            'waktu_masuk' => $waktu_masuk,
            'status' => 'Aktif',
            'petugas' => $petugas,
            'tarif' => $tarif
        ]);

        return redirect()->route('user.show', $kode_parkir);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parking  $Parking
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $data = Parking::where('kode_parkir', $user)->with('vehicle')->first();
        $jam_masuk = Carbon::parse($data->waktu_masuk)->format('H:i:s');
        $tanggal_masuk = Carbon::now()->format('M d Y');
        return view('parkiruser.show', compact('data', 'jam_masuk', 'tanggal_masuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parking  $Parking
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $user)
    {
        $data = Parking::where('kode_parkir', $user)->with('vehicle')->first();
        $parkir = null;
        return view('parkiruser.exit-form', compact('data', 'parkir'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parking  $Parking
     * @return \Illuminate\Http\Response
     */
    public function update(UserExitRequest $request, $user)
    {
        $data = Parking::where('kode_parkir', $user)->with('vehicle')->first();

        if ($data) {
            //validasi kode parkir apakah kode sudah pernah dipakai atau tidak
            if ($data->status == 'Keluar') {
                $parkir = 'keluar';
                return redirect()->route('user.keluar', ['user' => $user, 'parkir' => $parkir]);
            } else {
                //jika kode parkir sesuai, menghitung selisih jam masuk ke jam keluar sekaligus menentukan biaya
                $waktu_keluar = Carbon::now()->setTimezone('Asia/Jakarta');
                $keluar = strtotime($waktu_keluar);
                $waktu_masuk = strtotime($data->waktu_masuk);

                $diff = $keluar - $waktu_masuk;
                if (floor($diff / (60 * 60)) == 0.0) {
                    $tarif = $data->tarif;
                } else {
                    $jam = floor($diff / (60 * 60));
                    $tarif  = $data->tarif * ceil($jam);
                }
                $hasil_rupiah = "Rp " . number_format($tarif, 0, ',', '. ');
                $tanggal_keluar = Carbon::now()->format('M d Y');

                if (Auth::guest()) {
                    $petugas = 'user';
                } else {
                    $petugas = Auth::user()->id;
                }

                //update data ke tabel parking
                $data->update([
                    'waktu_keluar' => $waktu_keluar,
                    'tarif' => $tarif,
                    'petugas' => $petugas,
                    'status' => 'Keluar'
                ]);
            }
        };

        $jam_masuk = Carbon::parse($data->waktu_masuk)->format('H:i:s');
        $jam_keluar = Carbon::parse($data->waktu_keluar)->format('H:i:s');

        return view('parkiruser.exit-show', compact('data', 'tanggal_keluar', 'hasil_rupiah', 'jam_masuk', 'jam_keluar'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parking  $Parking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parking $Parking)
    {
        //
    }
}
