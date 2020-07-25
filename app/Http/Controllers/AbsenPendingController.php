<?php

namespace App\Http\Controllers;

use App\Model\Absen;
use App\Model\AbsenPending;
use App\Model\Semester;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AbsenPendingController extends Controller
{

    public function index()
    {

        $hadir = Absen::where('keterangan', '1')->where('user_id', auth()->user()->id)->count();
        $izin = Absen::where('keterangan', '2')->where('user_id', auth()->user()->id)->count();
        $sakit = Absen::where('keterangan', '3')->where('user_id', auth()->user()->id)->count();
        $alpha = Absen::where('keterangan', '4')->where('user_id', auth()->user()->id)->count();

        $cek = AbsenPending::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->first();
        return view('presensi.absens', compact('cek', 'hadir', 'izin', 'sakit', 'alpha'));
    }
    public function hadir(Request $request, $ket)
    {
        try {
            $semester = Semester::where('status', true)->first();
            AbsenPending::insert([
                'user_id' => auth()->user()->id,
                'semester_id' => $semester->id,
                'kelas_id' => auth()->user()->kelas_id,
                'time_in' => date('H:i:s'),
                'keterangan' => $this->keterangan($ket),
                'note' => $request->keterangan,
                'konfirm' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            notify()->success('Absensi telah dicatat, Akan segera dikonfirmasi oleh walikelas');
            return back();
        } catch (Exception $e) {
            notify()->error($e->getMessage());
            return back();
        }
    }
    private function keterangan($ket)
    {
        switch ($ket) {
            case 'hadir':
                $ket  = '1';
                break;
            case 'terlambat':
                $ket = '2';
                break;
            case 'tidakhadir':
                $ket = '3';
                break;
            case 'tanpaketerangan':
                $ket = '4';
                break;
            default:
                $ket  = '4';
                break;
        }
        return $ket;
    }
    public function edit(Request $request, $id)
    {
        $data = AbsenPending::find($id);
        $data->keterangan = $request->value;
        $data->update();
    }
    public function konfirmasi($id)
    {
        try {
            $data = AbsenPending::find($id);
            Absen::insert([
                'user_id' => $data->user_id,
                'semester_id' => $data->semester_id,
                'time_in' => $data->time_in,
                'kelas_id' => $data->kelas_id,
                'keterangan' => $data->keterangan,
                'note' => $data->note,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at,
            ]);
            $data->konfirm = true;
            $data->update();
            notify()->success('Absen siswa ' . $data->user->nama . ' telah dikonfiramsi');
            return back();
        } catch (Exception $e) {
            notify()->error($e->getMessage());
            return back();
        }
    }
}
