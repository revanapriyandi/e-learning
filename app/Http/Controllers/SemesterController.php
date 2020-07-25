<?php

namespace App\Http\Controllers;

use App\Model\Absen;
use App\Model\Semester;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SemesterController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {

            $data = Semester::orderBy('kode', 'DESC')
                ->get();
            return DataTables::of($data)
                ->addColumn('semester', function ($s) {
                    return " Semester $s->kode";
                })
                ->addColumn('status', function ($s) {
                    if ($s->status == true) {
                        return '<form method="post" action="' . route('semester.suspend', $s->id) . '">' . csrf_field() . '<button class="btn btn-primary btn-sm" type="submit">Aktif</button></form>';
                    } else {
                        return '<form method="post" action="' . route('semester.aktif', $s->id) . '">' . csrf_field() . '<button type="submit" class="btn btn-warning btn-sm">Suspend</button>';
                    }
                })
                ->addColumn('aksi', function ($s) {
                    return '
                <form id="data-' . $s->id . '" action="' . route('semester.destroy', $s->id) . '"   method="post">
                ' . csrf_field() . '
                ' . method_field('delete') . '</form>
                <button onclick="confirmDelete(' . $s->id . ' )" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"> </i>
                Delete</button>';
                })
                ->rawColumns(['aksi', 'semester', 'status'])
                ->toJson();
        }
        return view('semester.index');
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
            'kode' => 'required',
            'awal' => 'required',
            'akhir' => 'required',
        ]);
        try {
            if ($request->kode) {
                $data = new Semester;
                $data->kode = $request->kode;
                $data->tahun_ajaran = $request->awal . '/' . $request->akhir;
                $count = Semester::where('status', true)->count();
                if ($count != 1) {
                    $data->status == true;
                } else {
                    $data->status = false;
                }
                $data->save();

                notify()->success("Semester  baru telah ditambahkan");
                return back();
            }
        } catch (Exception $e) {
            notify()->error($e->getMessage);
        }
    }
    public function suspend($id)
    {
        $data = Semester::findOrFail($id);
        $data->status = false;
        $data->update();
        // $aktif = Semester::where('status', true)->count();
        // if ($aktif == 0) {
        //     $semester = Semester::orderBy('id', 'DESC')->first();
        //     $semester->status = true;
        //     $semester->update();
        //     notify()->success("Status Semester '.$semester->kode.' telah dijadikan sebagai Semester Aktif");
        //     return back();
        // }
        notify()->success("Status Semester '.$data->kode.' telah ditangguhkan");
        return back();
    }
    public function aktif($id)
    {
        $aktif = Semester::where('status', true)->count();
        if ($aktif == 1) {
            notify()->error("Tidak Dapat mengaktifkan lebih dari 1 Semester, Silahkan Tangguhkan Semester yang sedang aktif untuk melanjutkan");
            return back();
        } else {
            $data = Semester::findOrFail($id);
            $data->status = true;
            $data->update();
            notify()->success("Status Semester '.$data->kode.' telah diAktifkan");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aktif = Semester::where('status', true)->first();
        if ($aktif->id == $id) {
            notify()->error("Tidak Dapat Menghapus yang sedang aktif, silahkan Tangguhkan untuk melanjutkan");
            return back();
        } else {
            $data = Semester::findOrFail($id);
            $data->delete();
            $absen = Absen::where('semester_id', $id)->get();
            $absen->delete();
            notify()->success('Semua Data yang berhubungan dengan Semester ini telah dihapus');
            return back();
        }
    }
}
