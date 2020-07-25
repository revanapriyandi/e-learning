<?php

namespace App\Http\Controllers;

use App\User;
use App\Model\Absen;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GuruController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {

            $data = User::orderBy('id', 'DESC')->where('role', 'guru')
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
                    return '<a href="' . route('guru.show', $s->username) . '">' . $s->nama . '</a>';
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
                                    <a class="dropdown-item" href="' . route('guru.show', $s->username) . '">Show</a>
                                    <a class="dropdown-item" href="' . route('guru.show', $s->username) . '">Edit</a>
                                    <form id="data-' . $s->id . '" action="' . route('guru.destroy', $s->id) . '"   method="post">
                                    ' . csrf_field() . '
                                    ' . method_field('delete') . '</form>
                                    <button onclick="confirmDelete(' . $s->id . ' )" class="dropdown-item">
                                    <i class="fa fa-trash"> </i>
                                    Delete</button>
                                </div>
                            </div>';
                })
                ->rawColumns(['tgl_lahir', 'nama', 'jk', 'status', 'aksi'])
                ->addIndexColumn()
                ->toJson();
        }
        return view('guru.index');
    }
    public function cekNip(Request $request)
    {
        $nip = $request->nip;
        $isExists = User::where('nip', $nip)->first();
        if ($isExists) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));
        }
    }
    public function create()
    {
        return view('guru.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nip' => ['required', 'unique:users'],
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
        $data->nip = $request->nip;
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->username = $request->username;
        $data->password = bcrypt($request->password);
        $data->telepon = $request->telepon;
        $data->jk = $request->jk;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->alamat = $request->alamat;
        $data->role = 'guru';
        $data->status = '1';
        $data->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
        if ($request->avatar) {
            $data->avatar = $request->avatar;
        } else {
            $data->avatar = url('storage/photos/shares/default.jpg');
        }
        $data->sendEmailVerificationNotification();
        $data->save();
        notify()->success('Data Guru Berhasil ditambahkan');
        return redirect(route('guru.index'));
    }
    public function show($username)
    {
        $data = User::where('username', $username)->first();
        return view('guru.show', compact('data'));
    }
    public function update(Request $request, $username)
    {
        $request->validate([
            'nip' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'max:15', 'min:10'],
            'jk' => ['required'],
            'tempat_lahir' => ['required', 'max:255'],
            'tgl_lahir' => ['date', 'required'],
        ]);
        $data = User::where('username', $username)->first();
        $data->nip = $request->nip;
        $data->nama = $request->nama;
        $data->telepon = $request->telepon;
        $data->jk = $request->jk;
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
}
