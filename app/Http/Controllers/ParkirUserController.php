<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ParkirUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserExitRequest;
use App\Http\Requests\UserEnterRequest;

class ParkirUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
    public function store(UserEnterRequest $request)
    {
        $waktu_masuk = Carbon::now()->toDateTimeString();
        $kode_unik = Str::random(5);
        $no_kendaraan = $request->no_kendaraan;
        $no_kendaraan = Str::slug($no_kendaraan, '-');
        $no_kendaraan = Str::upper($no_kendaraan);
        $merk = $request->merk;
        $tipe = $request->tipe;

        // Melakukan cek pada database apakah data kendaraan sudah ada dan belum keluar parkir.
        $getKendaraan = ParkirUser::where('no_kendaraan', $no_kendaraan)->latest()->first();
        if ($getKendaraan->status == 'Aktif') {
                session()->flash('belumKeluar', 'Kendaraan sudah terdaftar dan belum keluar');
                return redirect()->route('user.index');
        }

        if($tipe == 'Motor') {
            $tarif = "2000";
        }elseif($tipe == 'Mobil'){
            $tarif = "3000";
        }else {
            $tarif = "5000";
        }

        ParkirUser::create([
            'kode_unik' => $kode_unik,
            'no_kendaraan'=>$no_kendaraan,
            'merk'=>$merk,
            'tipe'=>$tipe,
            'waktu_masuk'=>$waktu_masuk,
            'status'=>'aktif',
            'tarif'=>$tarif
        ]);

        $data = ParkirUser::getData($kode_unik);

        return redirect()->route('user.show', $kode_unik);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParkirUser  $parkirUser
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $data = ParkirUser::getData($user);
        $jam_masuk = Carbon::now()->format('H:i:s');
        $tanggal_masuk = Carbon::now()->format('M d Y');
        return view('parkiruser.show', compact('data','jam_masuk','tanggal_masuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParkirUser  $parkirUser
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $user)
    {
        $data = ParkirUser::getData($user);
        
        return view('parkiruser.exit-form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParkirUser  $parkirUser
     * @return \Illuminate\Http\Response
     */
    public function update(UserExitRequest $request, $user)
    {
        $data = ParkirUser::getData($user);
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
        ParkirUser::where('kode_unik', $user)->update([
            'waktu_masuk' => $data->waktu_masuk,
            'waktu_keluar' => $waktu_keluar,
            'tarif' => $tarif,
            'status' => 'Selesai',
        ]);
        $data = ParkirUser::getData($user);
        $tanggal_keluar = Carbon::now()->format('M d Y');
        return view('parkiruser.exit-show', compact('data','tanggal_keluar'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParkirUser  $parkirUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParkirUser $parkirUser)
    {
        //
    }
}
