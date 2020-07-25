<?php

namespace App\Http\Controllers;

use App\Model\Kelas;
use Exception;
use Carbon\Carbon;
use App\Model\Modul;
use App\Model\ModulDownload;
use App\Model\TugasSiswa;
use App\Model\UnduhanModul;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    public function index(Request $request)
    {
        if ($request->kategori) {
            if (auth()->user()->role == 'guru') {
                $datas = Modul::where('user_id', auth()->user()->id)
                    ->where('kategori', $request->kategori)
                    ->paginate();
            } else {
                $datas = Modul::where('kategori', $request->kategori)
                    ->paginate();
            }
        } else {
            if (auth()->user()->role == 'guru') {
                $datas = Modul::where('user_id', auth()->user()->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $datas = Modul::orderBy('created_at', 'desc')
                    ->get();
            }
        }
        if (auth()->user()->role == 'siswa') {
            $jumlahModul = Modul::where('kategori', 'modul')->count();
            $jumlahTugas = Modul::where('kategori', 'tugas')->count();
        } else {
            $jumlahModul = Modul::where('user_id', auth()->user()->id)
                ->where('kategori', 'modul')
                ->orderBy('created_at', 'desc')
                ->count();
            $jumlahTugas = Modul::where('user_id', auth()->user()->id)
                ->where('kategori', 'tugas')
                ->orderBy('created_at', 'desc')
                ->count();
        }
        $tugasMasuk = TugasSiswa::where('dari', auth()->user()->id)
            ->orderBy('created_at', 'DESC')->get();
        return view('modul.index', compact('datas', 'jumlahModul', 'jumlahTugas', 'tugasMasuk'));
    }
    public function create()
    {
        $kelas = Kelas::all();
        return view('modul.create', compact('kelas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'min:10'],
            'deskripsi' => ['required'],
            'status' => ['required'],
            'kategori' => ['required'],
        ]);

        try {
            $reqFile = $request->file;
            $fileArray = explode(",", $reqFile);
            $file = json_encode($fileArray);

            if ($request->kelas == 'semua') {
                $kelas = NULL;
            } else {
                $kelas = $request->kelas;
            }
            if ($request->status == 'publish') {
                $status = true;
            } else {
                $status = false;
            }
            Modul::insert([
                'judul' => $request->judul,
                'user_id' => auth()->user()->id,
                'deskripsi' => $request->deskripsi,
                'file' => $file,
                'kelas_id' => $kelas,
                'status' => $status,
                'kategori' => $request->kategori,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            notify()->success('Modul Baru Berhasil ditambahkan');
            return redirect(route('modul.index'));
        } catch (Exception $e) {
            dd($e->getMessage());
            return back();
        }
    }
    public function show($id)
    {
        if (auth()->user()->role == 'guru') {
            $data = Modul::where('user_id', auth()->user()->id)
                ->where('id', $id)
                ->first();
        } else {
            $data = Modul::findOrFail($id);
        }
        if ($data->kelas_id != NULL) {
            $siswa = User::where('kelas_id', $data->kelas_id)
                ->where('status', true)
                ->count();

            $diunduh = ModulDownload::where('modul_id', $id)
                ->count();
        } else {
            $siswa = User::where('status', true)
                ->count();

            $diunduh = ModulDownload::where('user_id', $data->user_id)
                ->where('modul_id', $data->modul_id)
                ->count();
        }
        return view('modul.show', compact('data', 'siswa', 'diunduh'));
    }
    public function fileDownload($user_id, $id, $file)
    {
        try {
            $data = Modul::findOrFail($id);
            $count = ModulDownload::where('user_id', auth()->user()->id)
                ->where('modul_id', $id)
                ->count();
            if ($count == 0) {
                if (auth()->user()->role == 'siswa') {
                    $m = new ModulDownload;
                    $m->user_id = auth()->user()->id;
                    $m->kelas_id = $data->kelas_id;
                    $m->modul_id = $data->id;
                    $m->save();
                }
            }

            $url = 'public/files/' . $user_id . '/' . $file;
            return Storage::download($url);
        } catch (Exception $e) {
            return back()->with(notify()->error($e->getMessage()));
        }
    }
    public function edit($id)
    {
        $kelas = Kelas::all();
        $data = Modul::findOrFail($id);
        return view('modul.edit', compact('data', 'kelas'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => ['required', 'string', 'min:10'],
            'deskripsi' => ['required'],
            'file' => ['required'],
            'status' => ['required'],
        ]);

        try {
            $reqFile = $request->file;
            $fileArray = explode(",", $reqFile);
            $file = json_encode($fileArray);

            $reqLink = $request->link;
            $linkArray = explode(",", $reqLink);
            $link = json_encode($linkArray);

            if ($request->kelas == 'semua') {
                $kelas = NULL;
            } else {
                $kelas = $request->kelas;
            }
            if ($request->status == 'publish') {
                $status = true;
            } else {
                $status = false;
            }
            Modul::find($id)->update([
                'judul' => $request->judul,
                'user_id' => auth()->user()->id,
                'deskripsi' => $request->deskripsi,
                'file' => $file,
                'links' => $link,
                'kelas_id' => $kelas,
                'status' => $status,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            notify()->success('Modul Baru Berhasil diperbaharui');
            return redirect(route('modul.show', $id));
        } catch (Exception $e) {
            dd($e->getMessage());
            return back();
        }
    }
    public function destroy($id)
    {
        try {
            $data = Modul::findOrFail($id);
            $data->delete();
            notify()->success('Modul ' . $data->nama . ' berhasil di hapus');
            return redirect(route('modul.index'));
        } catch (Exception $e) {
            notify()->error($e->getMessage());
            return back();
        }
    }
}
