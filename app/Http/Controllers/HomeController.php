<?php

namespace App\Http\Controllers;

use App\Model\AbsenPending;
use App\Model\Modul;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswa  = User::where('status', true)->where('role', 'siswa')->count();
        $guru  = User::where('status', true)->where('role', 'guru')->count();
        $modul  = Modul::where('status', true)->count();
        $cek = AbsenPending::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->first();
        return view('home', compact('siswa', 'guru', 'modul', 'cek'));
    }
}
