<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Absen;
use App\Model\Kelas;
use App\Notifications\RegistrasiDisetujui;
use App\Notifications\SiswaRegistrasiDisetujui;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $data = User::orderBy('id', 'DESC')->where('role', 'siswa')
                ->get();
            return DataTables::of($data)
                ->addColumn('tgl_lahir', function ($s) {
                    $tmp = $s->tempat_lahir;
                    $tgl_lahir = date('d F Y', strtotime($s->tgl_lahir));
                    return $tmp . ' / ' . $tgl_lahir;
                })
                ->addColumn('jk', function ($s) {
                    return $s->jk();
                })
                ->addColumn('nama', function ($s) {
                    return '<a href="' . route('siswa.show', $s->username) . '">' . $s->nama . '</a>';
                })
                ->addColumn('Check', function ($s) {
                    return '<label for="' . $s->id . '" class="custom-control custom-checkbox mb-1 align-self-center data-table-rows-check"><input data-id="' . $s->id . '"  id="' . $s->id . '" type="checkbox" class="custom-control-input"><span class="custom-control-label">&nbsp;</span></label>';
                })
                ->addColumn('status', function ($s) {
                    if ($s->status == "1") {
                        return '<form method="post" action="' . route('siswa.suspend', $s->id) . '">' . csrf_field() . '<button class="btn btn-primary btn-sm" type="submit">Aktif</button></form>';
                    } else {
                        return '<form method="post" action="' . route('siswa.aktif', $s->id) . '">' . csrf_field() . '<button type="submit" class="btn btn-warning btn-sm">Suspend</button>';
                    }
                })
                ->addColumn('aksi', function ($s) {
                    return '<div class="btn-group dropup mb-1">
                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="' . route('siswa.show', $s->username) . '">Show</a>
                                    <a class="dropdown-item" href="' . route('siswa.show', $s->username) . '">Edit</a>
                                    <form id="data-' . $s->id . '" action="' . route('siswa.destroy', $s->id) . '"   method="post">
                                    ' . csrf_field() . '
                                    ' . method_field('delete') . '</form>
                                    <button onclick="confirmDelete(' . $s->id . ' )" class="dropdown-item">
                                    <i class="fa fa-trash"> </i>
                                    Delete</button>
                                </div>
                            </div>';
                })
                ->rawColumns(['tgl_lahir', 'nama', 'jk', 'Check', 'status', 'aksi'])
                ->addIndexColumn()
                ->toJson();
        }
        return view('siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }
    public function cekEmail(Request $request)
    {
        $email = $request->email;
        $isExists = User::where('email', $email)->first();
        if ($isExists) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));
        }
    }
    public function changeEmail(Request $request, $username)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
        ]);
        $data = User::where('username', $username)->first();
        $data->email = $request->email;
        $data->sendEmailVerificationNotification();
        $data->update();
        notify()->success('Email Berhasil diubah, Silahkan cek email anda untuk memverifikasi');
        return back();
    }
    public function cekUsername(Request $request)
    {
        $username = $request->username;
        $isExists = User::where('username', $username)->first();
        if ($isExists) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));
        }
    }
    public function cekNis(Request $request)
    {
        $nis = $request->nis;
        $isExists = User::where('nis', $nis)->first();
        if ($isExists) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => ['required', 'unique:users'],
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users'],
            'telepon' => ['required', 'max:15', 'min:10'],
            'jk' => ['required'],
            'tempat_lahir' => ['required', 'max:255'],
            'tgl_lahir' => ['date', 'required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data = new User;
        $data->nis = $request->nis;
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->username = $request->username;
        $data->password = bcrypt($request->password);
        $data->telepon = $request->telepon;
        $data->jk = $request->jk;
        $data->kelas_id = $request->kelas_id;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->alamat = $request->alamat;
        $data->role = 'siswa';
        $data->status = '1';
        $data->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
        if ($request->avatar) {
            $data->avatar = $request->avatar;
        } else {
            $data->avatar = url('storage/photos/shares/default.jpg');
        }
        $data->save();
        notify()->success('Data Siswa Berhasil ditambahkan');
        return redirect(route('siswa.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $data = User::where('username', $username)->first();
        $hadir = Absen::where('keterangan', '1')->where('user_id', $data->id)->count();
        $izin = Absen::where('keterangan', '2')->where('user_id', $data->id)->count();
        $sakit = Absen::where('keterangan', '3')->where('user_id', $data->id)->count();
        $alfa = Absen::where('keterangan', '4')->where('user_id', $data->id)->count();
        $kelas = Kelas::all();
        return view('siswa.show', compact('data', 'hadir', 'izin', 'sakit', 'alfa', 'kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $request->validate([
            'nis' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'max:15', 'min:10'],
            'jk' => ['required'],
            'tempat_lahir' => ['required', 'max:255'],
            'tgl_lahir' => ['date', 'required'],
        ]);
        $data = User::where('username', $username)->first();
        $data->nis = $request->nis;
        $data->nama = $request->nama;
        $data->telepon = $request->telepon;
        $data->jk = $request->jk;
        $data->kelas_id = $request->kelas_id;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->alamat = $request->alamat;
        $data->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
        if ($request->avatar) {
            $data->avatar = $request->avatar;
        }
        $data->update();
        notify()->success('Data Berhasil diperbaharui !');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        User::destroy($id);
        $absen = Absen::where('user_id', $id)->destroy();
        notify()->success('Data Siswa: ' . $user->nama . ' berhasil Dihapus');
        return redirect()->back();
    }
    public function aktif($id)
    {
        $data = User::findOrFail($id);
        $data->status = true;
        $data->update();
        notify()->success('Status Siswa ' . $data->nama . ' Telah berubah menjadi Aktif');
        return back();
    }
    public function suspend($id)
    {
        $data = User::findOrFail($id);
        $data->status = false;
        $data->update();
        notify()->success('Hak Akses ' . $data->nama . ' Telah ditangguhkan');
        return back();
    }
    public function changePassword(Request $request, $username)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'string', 'min:8'],
            'confirm-password' => ['same:password'],
        ]);
        $data = User::where('username', $username)->first();
        $data->password = bcrypt($request->password);
        $data->update();
        notify()->success('Password change successfully');
        return back();
    }
    public function registrasi()
    {
        if (request()->ajax()) {

            $data = User::orderBy('id', 'DESC')->where('role', 'siswa')
                ->where('status', false)->where('email_verified_at', NULL)
                ->get();
            return DataTables::of($data)
                ->addColumn('jk', function ($s) {
                    return $s->jk();
                })
                ->addColumn('nama', function ($s) {
                    return '<a href="' . route('siswa.show', $s->username) . '">' . $s->nama . '</a>';
                })
                ->addColumn('email', function ($s) {
                    return '<a href = "mailto:' . $s->email . '">' . $s->email . '</a><br>';
                })
                ->addColumn('aksi', function ($s) {
                    return '<div class="btn-group dropup mb-1">
                                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <form action="' . route('siswa.setujui', $s->id) . '"   method="post">
                                    ' . csrf_field() . '
                                    <button type="submit" class="dropdown-item">
                                    <i class="fa fa-check"> </i>
                                    Aktifkan</button></form>
                                    <form id="data-' . $s->id . '" action="' . route('siswa.destroy', $s->id) . '"   method="post">
                                    ' . csrf_field() . '
                                    ' . method_field('delete') . '</form>
                                    <button onclick="confirmDelete(' . $s->id . ' )" class="dropdown-item">
                                    <i class="fa fa-trash"> </i>
                                    Delete</button>
                                </div>
                            </div>';
                })
                ->rawColumns(['nama', 'jk', 'email', 'aksi'])
                ->addIndexColumn()
                ->toJson();
        }
        return view('siswa.registrasi');
    }
    public function setujui($id)
    {
        $data = User::findOrFail($id);
        $data->status = true;
        Notification::send($data, new RegistrasiDisetujui);
        $data->sendEmailVerificationNotification();
        $data->update();
        notify()->success('Registrasi Akun ' . $data->nama . ' Telah Disetujui');
        return back();
    }
}
