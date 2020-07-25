<?php

namespace App\Http\Controllers;

use Error;
use notify;
use DateTime;
use App\Model\Kelas;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KelasController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {

            $data = Kelas::orderBy('created_at', 'DESC')
                ->get();
            return DataTables::of($data)
                ->addColumn('nama_kelas', function ($s) {
                    return '<a href="' . route('kelas.show', $s->id) . '">' . $s->nama_kelas . '</a>';
                })
                ->addColumn('walikelas', function ($s) {
                    if (empty($s->guru)) {
                        return 'Belum di Tetapkan';
                    } else {
                        return '<a href="' . route('guru.show', $s->guru->username) . '">' . $s->guru->nama . '</a>';
                    }
                })
                ->addColumn('ketuakelas', function ($s) {
                    if (empty($s->ketuaku)) {
                        return 'Belum di Tetapkan';
                    } else {
                        return '<a href="' . route('siswa.show', $s->ketuaku->username) . '">' . $s->ketuaku->nama . '</a>';
                    }
                })
                ->addColumn('aksi', function ($s) {
                    return '<div class="btn-group dropup mb-1">
                <button type="button" class="btn btn-outline-primary dropdown-toggle"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Aksi
                </button>
                <div class="dropdown-menu">
                <a class="dropdown-item" href="' . route('kelas.show', $s->id) . '">show</a>
                <a class="dropdown-item" href="' . route('kelas.edit', $s->id) . '">Edit</a>
                <form id="data-' . $s->id . '" action="' . route('kelas.destroy', $s->id) . '"   method="post">
                ' . csrf_field() . '
                ' . method_field('delete') . '</form>
                <button onclick="confirmDelete(' . $s->id . ' )" class="dropdown-item">
                <i class="fa fa-trash"> </i>
                Delete</button>
                </div>
                </div>';
                })
                ->rawColumns(['aksi', 'nama_kelas', 'walikelas', 'ketuakelas'])
                ->addIndexColumn()
                ->toJson();
        }
        return view('kelas.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_kelas' => 'required|min:4|unique:kelas',
        ]);
        $data = new Kelas;
        $data->nama_kelas = $request->nama_kelas;
        $data->save();
        notify()->success('Kelas baru telah dibuat, silahkan inputkan Walikelas dan Ketua Kelas');
        return redirect(route('kelas.edit', $data->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        if (request()->ajax()) {

            $data = User::where('kelas_id', $id)->where('status', true)->orderBy('id', 'DESC')
                ->get();
            return DataTables::of($data)
                ->addColumn('nama', function ($s) {
                    return '<a href="' . route('siswa.show', $s->username) . '">' . $s->nama . '</a>';
                })
                ->addColumn('email', function ($s) {
                    return '<a href="Mailto:' . $s->email . '">' . $s->email . '</a>';
                })
                ->addColumn('jk', function ($s) {
                    return $s->jk();
                })
                ->addColumn('age', function ($s) {
                    $birthDate = new DateTime($s->tgl_lahir);
                    $today = new DateTime("today");
                    if ($birthDate > $today) {
                        exit("0 tahun");
                    }
                    $y = $today->diff($birthDate)->y;
                    return $y . " tahun ";
                })
                ->addColumn('telepon', function ($s) {
                    return $s->telepon;
                })
                ->addColumn('status', function ($s) {

                    if ($s->status == true) {
                        return  '<span class="badge badge-pill badge-primary mb-1">Aktif</span>';
                    } else {
                        return  '<span class="badge badge-pill badge-dark mb-1">Suspend</span>';
                    }
                })
                ->rawColumns(['nama', 'email', 'jk', 'age', 'telepon', 'status'])
                ->toJson();
        }
        return view('kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = Kelas::findOrFail($id);
        $kelas = Kelas::all();
        foreach ($kelas as $cek) {
            $walikelas = User::where('id', '!=', $cek->walikelas)
                ->where('role', 'guru')
                ->where('status', true)
                ->orWhere('id', $data->walikelas)
                ->get();

            $siswa = User::where('role', 'siswa')
                ->where('status', true)
                ->where('kelas_id', $data->id)
                ->get();
            return view('kelas.edit', compact('data', 'walikelas', 'siswa'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|min:4',
        ]);
        $data = Kelas::findOrFail($id);
        $data->nama_kelas = $request->nama_kelas;
        $data->walikelas = $request->walikelas;
        $data->ketuakelas = $request->ketuakelas;
        $data->update();
        notify()->success('Data Kelas berhasil di Update');
        return redirect(route('kelas.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::destroy($id);
        notify()->success('Kelas Berhasil di Hapus');
        return back();
    }
}
