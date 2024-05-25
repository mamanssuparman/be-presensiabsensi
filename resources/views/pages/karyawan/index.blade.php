@extends('layouts.master')
@section('title')
    K-BIL | Karyawan
@endsection
@section('content-header')
    <h1>
        Karyawan
        <small>DataTable Karyawan</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Karyawan</li>
        <li>Index</li>

    </ol>
@endsection
@section('content')
    <section class="content">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
                <h3 class="box-title">
                </h3>
                <a href="{{ route('karyawan.create') }}" class="btn btn-primary btn-sm pull-right"><span class="fa fa-plus"></span> Add Karyawan</a>
            </div>
            <div class="box-body">
                <table class="dt-responsive table table-bordered table-striped" id="tbl-karyawan">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>NUPTK</th>
                            <th>Nama Lengkap</th>
                            <th>Nomor Telephone</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
@endsection
@push('externaljs')
    <script>
        var url = baseUrl + listRoutes['karyawan.getData'];
        var table
        $(() => {
            table = $('#tbl-karyawan').DataTable({
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
                        data: 'nuptk',
                        name: 'nuptk',
                    },
                    {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap',
                    },
                    {
                        data: 'notelepon',
                        name: 'notelepon',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });
        })
    </script>
@endpush
