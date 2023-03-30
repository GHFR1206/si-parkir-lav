<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AkunEditRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAkun = User::paginate('7');
        return view('akun.index', compact('getAkun'));
    }

    public function profile()
    {
        return view('akun.profile');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $akun
     * @return \Illuminate\Http\Response
     */
    public function show($akun)
    {
        $getAkun = User::find($akun);
        return view('akun.show', compact('getAkun'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $akun
     * @return \Illuminate\Http\Response
     */
    public function edit($akun)
    {
        $getAkun = User::find($akun);
        return view('akun.edit', compact('getAkun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $akun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $akun)
    {
        $akun = User::find($akun);

        if ($akun->email == $request->email) {
            $emailRule = ['required', 'string', 'email', 'max:255'];
        } else {
            $emailRule = ['required', 'string', 'email', 'max:255', 'unique:users'];
        }

        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'name' => ['required'],
            'email' => $emailRule,
            'role' => ['required']
        ]);

        $akun->update([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        session()->flash('suksesUpdateAkun');
        return redirect()->route('akun.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $akun
     * @return \Illuminate\Http\Response
     */
    public function destroy($akun)
    {
        $getAkun = User::find($akun);
        $getAkun->delete();

        session()->flash('suksesHapusAkun');
        return redirect()->route('akun.index');
    }


    // public function forgotPassword()
    // {
    //     return view('akun.forgot-password');
    // }

    // public function resetPassword(Request $request)
    // {
    //     $getAkun = User::all();
    //     foreach ($getAkun as $key => $value) {
    //         if ($value->email == $request->email) {
    //             $getAkun = User::where('email', $request->email)->first();
    //             return view('akun.reset-password', compact('getAkun'));
    //         } else {
    //             return redirect()->route('forgot-password')->withErrors(['email' => 'Email tidak sesuai']);
    //         }
    //     }
    // }

    // public function updatePassword(Request $request, $akun)
    // {
    //     if ($request->password == $request->password_confirmation) {
    //         $getAkun = User::find($akun);
    //         $getAkun->update([
    //             'password' => Hash::make($request->password),
    //         ]);
    //         session()->flash('suksesResetPassword');
    //         return redirect()->route('login');
    //     } else {
    //         return redirect()->back()->withErrors(['password' => 'Konfirmasi password tidak sesuai.']);
    //     }
    // }
}
