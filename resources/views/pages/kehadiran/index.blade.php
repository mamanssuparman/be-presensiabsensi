@extends('layouts.master')
@section('title')
    K-BIL | Kehadiran
@endsection
@section('content-header')
    <h1>
        Kehadiran
        <small>DataTable Kehadiran</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Kehadiran</li>
        <li>Index</li>

    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title">
                </h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="dt-responsive table table-bordered table-striped" id="tbl-kehadiran">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th></th>
                                <th>Nama</th>
                                <th>Tanggal Kehadiran</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('externaljs')
    <script>
        var url = baseUrl + listRoutes['kehadiran.getData'];
        var table
        $(() => {
            table = $('#tbl-kehadiran').DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'fotos',
                        name: 'fotos',
                    },
                    {
                        data: 'nama_pegawai',
                        name: 'nama_pegawai',
                    },
                    {
                        data: 'tgl_absensi',
                        name: 'tgl_absensi',
                    },
                    {
                        data: 'waktu_masuk',
                        name: 'waktu_masuk',
                    },
                    {
                        data: 'waktu_keluar',
                        name: 'waktu_keluar',
                    },
                    {
                        data: 'jenis_ajuans',
                        name: 'jenis_ajuans',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });
        })
    </script>
@endpush
