<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ParkirUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ParkirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aktif = ParkirUser::where('status', 'aktif')->get()->count();
        $motor = ParkirUser::where(['status' => 'aktif', 'tipe' => 'Motor'])->get()->count();
        $mobil = ParkirUser::where(['status' => 'aktif', 'tipe' => 'Mobil'])->get()->count();
        $truk = ParkirUser::where(['status' => 'aktif', 'tipe' => 'Truk'])->get()->count();
        $selesai = ParkirUser::where('status', 'selesai')->get()->count();
        $dataaktifs = ParkirUser::where('status', 'aktif')->paginate('7');
        $pendapatan = ParkirUser::sum('tarif');
        return view('parkir.index', compact('aktif', 'dataaktifs', 'selesai', 'pendapatan', 'motor', 'mobil', 'truk'));
    }

    public function data_selesai()
    {
        $aktif = ParkirUser::where('status', 'aktif')->get()->count();
        $selesai = ParkirUser::where('status', 'selesai')->get()->count();
        $dataselesais = ParkirUser::where('status', 'selesai')->latest()->paginate('5');
        return view('parkir.data-selesai', compact('dataselesais', 'aktif', 'selesai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parkir.create', [
            'submit' => 'Masuk',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $waktu_masuk = \Carbon\Carbon::now()->toDateTimeString();
        $kode_unik = Str::random(5);
        $no_kendaraan = $request->no_kendaraan;
        $no_kendaraan = Str::slug($no_kendaraan, '-');
        $no_kendaraan = Str::upper($no_kendaraan);
        $merk = $request->merk;
        $tipe = $request->tipe;

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
            'status'=>'Aktif',
            'tarif'=>$tarif
        ]);

        $data = ParkirUser::getData($kode_unik);

        return redirect()->route('parkir.index');
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
    public function update(Request $request, $user)
    {
        $data = ParkirUser::getData($user);
        $waktu_keluar = \Carbon\Carbon::now()->toDateTimeString();
        $menuju = Carbon::createFromFormat('Y-m-d H:i:s', $waktu_keluar);
        $dari = Carbon::createFromFormat('Y-m-d H:i:s', $data->waktu_masuk);
        $selisihJam = $menuju->diffInHours($dari);
        $tarif = $data->tarif * $selisihJam;

        ParkirUser::where('kode_unik', $user)->update([
            'waktu_masuk' => $data->waktu_masuk,
            'waktu_keluar' => $waktu_keluar,
            'tarif' => $tarif,
            'status' => 'Selesai',
        ]);
        $data = ParkirUser::getData($user);
        return redirect()->route('parkir.index');
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
}
