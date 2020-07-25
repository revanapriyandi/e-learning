<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\Model\TugasSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {
            $user = User::where('id', '!=', auth()->user()->id)
                ->where('nama', 'like', "%" . $request->search . "%")
                ->where('status', true)
                ->get();
        } else {
            $user = User::where('id', '!=', auth()->user()->id)
                ->where('status', true)
                ->get();
        }
        return view('tugas.index', compact('user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string'],
            'user_id' => 'required',
            'file' => 'required',
        ]);
        try {
            $reqFile = $request->file;
            $fileArray = explode(",", $reqFile);
            $file = json_encode($fileArray);

            $data = new TugasSiswa;
            $data->judul = $request->judul;
            $data->to = $request->user_id;
            $data->dari = auth()->user()->id;
            $data->file = $file;
            $data->catatan = $request->catatan;
            $data->status = 'send';
            $data->save();
            notify()->success("File berhasil dikirim");
            return back();
        } catch (Exception $e) {
            notify()->error($e->getMessage());
            return back();
        }
    }
    public function tugasMasuk(Request $request)
    {
        if ($request->search) {
            $data = TugasSiswa::where('to', auth()->user()->id)
                ->where('judul', 'like', "%" . $request->search . "%")
                ->orderBy('created_at', 'DESC')->get();
        } else {
            $data = TugasSiswa::where('to', auth()->user()->id)
                ->orderBy('created_at', 'DESC')->get();
        }
        return view('tugas.tugasMasuk', compact('data'));
    }
    public function show($id)
    {
        $data = TugasSiswa::findOrFail($id);
        if (auth()->user()->id) {
            $data->status = 'read';
            $data->update();
        }
        return view('tugas.show', compact('data'));
    }
    public function fileDownload($id, $file)
    {
        try {
            $data = TugasSiswa::findOrFail($id);
            $url = 'public/files/' . $data->dari . '/' . $file;
            return Storage::download($url);
        } catch (Exception $e) {
            return back()->with(notify()->error($e->getMessage()));
        }
    }
    public function destroy($id)
    {
        try {
            $data = TugasSiswa::findOrFail($id);
            $data->delete();
            notify()->success("Data Tugas Berhasil di Hapus");
            return redirect(route('tugas.masuk.index'));
        } catch (Exception $e) {
            notify()->error($e->getMessage());
            return back();
        }
    }
}
