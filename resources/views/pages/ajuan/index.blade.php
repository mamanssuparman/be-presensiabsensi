@extends('layouts.master')
@section('title')
    K-BIL | Ajuan Karyawan
@endsection
@section('content-header')
    <h1>
        Ajuan
        <small>Ajuan Karyawan</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Ajuan </li>
        <li>Detail</li>

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
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="dt-responsive table table-bordered table-striped" id="tbl-ajuan">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama Pegawai</th>
                                    <th>Tanggal Ajuan</th>
                                    <th>Jenis Ajuan</th>
                                    <th>Status Ajuan</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('externaljs')
    <script src="{{ asset('assets/bower_components/jqueryvalidate/jquery.validate.js') }}"></script>
    <script>
        var idJabatan =null;
        var url = baseUrl + listRoutes['ajuan.getData'];
        var table
        $(() => {
            table = $('#tbl-ajuan').DataTable({
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
                        data: 'nama_pegawai',
                        name: 'nama_pegawai',
                    },
                    {
                        data: 'tanggal_awal',
                        name: 'tanggal_awal',
                    },
                    {
                        data: 'jenis_ajuans',
                        name: 'jenis_ajuans',
                    },
                    {
                        data: 'statusajuan',
                        name: 'statusajuan',
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
