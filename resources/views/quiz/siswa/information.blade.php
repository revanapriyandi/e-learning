@extends('layouts.app')
@section('title','Create New Quiz')
@section('content')
<div class="container-fluid disable-text-selection">
   <div class="row">
      <div class="col-12 list" data-check-all="checkAll">
         
         <div class="card">
             <div class="card-body">
                 <div class="alert alert-secondary rounded" role="alert">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>Judul</th>
                                <td>:</td>
                                <td>{!! $data->judul !!}</td>
                            </tr>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <td>:</td>
                                <td>{!! $data->mapel_id->nama !!}</td>
                            </tr>
                            <tr>
                                @php
                                    $a = $data->pilihanG;
                                    $b = $data->Essay;
                                    $jumlah = count($a) + count($b);
                                @endphp
                                <th>Jumlah Soal</th>
                                <td>:</td>
                                <td>{{ $jumlah }} Soal ({{ count($a) }} Ojective, {{ count($b) }} Essay)</td>
                            </tr>
                            <tr>
                                <th>Tanggal Posting	</th>
                                <td>:</td>
                                <td>{{ date('d F Y',strtotime($data->created_at)) }}</td>
                            </tr>
                            <tr>
                                <th>Pembuat</th>
                                <td>:</td>
                                <td>{{ $data->user->nama }}</td>
                            </tr>
                            <tr>
                                <th>Durasi Ujian</th>
                                <td>:</td>
                                <td><strong>{{ $data->durasi }} Menit</strong></td>
                            </tr>
                            <tr>
                                <th>Info Soal/Quiz	</th>
                                <td>:</td>
                                <td>{!! $data->deskripsi !!}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4 col-4 col-lg-4"></div>
                        <div class="col-md-6 col-6 col-lg-6">
                            <a href="{{ route('quiz.start',[$data->id,$data->judul]) }}" class="btn btn-primary btn-lg">Lanjut</a>
                        </div>
                    </div>
                </div>
             </div>
         </div>
      </div>
   </div>
</div>
@endsection