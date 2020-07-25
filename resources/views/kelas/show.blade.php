@extends('layouts.app')
@section('title','Data Siswa')
@section('content')
<div class="container-fluid">
    <input type="hidden" value="{{ $kelas->id }}" id="id">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $kelas->nama_kelas }}</h5>
            <table id="table-kelasshow" class="data-table  responsive nowrap"
            data-order="[[ 1, &quot;desc&quot; ]]">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur</th>
                    <th>Hp/Telepon</th>
                    <th>Status</th>
                </tr>
            </thead>
            
        </table>
    </div>
</div>
</div>
@endsection
@section('js')
<script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>
<script>
    var dataTablePs;
    var id = $('#id').val();
    $("#table-kelasshow").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('kelas') }}" + '/' + id ,
        columns: [
        {data: 'nama', name: 'nama'},
        {data: 'email', name: 'email'},
        {data: 'jk', name: 'jk'},
        {data: 'age', name: 'age'},
        {data: 'telepon', name: 'telepon'},
        {data: 'status', name: 'status'},
        ],
        searching: false,
        bLengthChange: false,
        destroy: true,
        info: false,
        paging: false,
        sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
        responsive: !0,
        deferRender: !0,
        scrollY: "calc(100vh - 400px)",
        scrollCollapse: !0,
        "fnInitComplete": function () {
            dataTablePs = new PerfectScrollbar('.dataTables_scrollBody', {
                suppressScrollX: true
            });
            dataTablePs.isRtl = false;
        },
        "fnDrawCallback": function (oSettings) {
            dataTablePs = new PerfectScrollbar('.dataTables_scrollBody', {
                suppressScrollX: true
            });
            dataTablePs.isRtl = false;
        }
    });
</script>
@endsection