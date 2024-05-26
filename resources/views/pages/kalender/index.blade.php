@extends('layouts.master')
@section('title')
    K-BIL | Kalenders
@endsection
@section('content-header')
    <h1>
        Kalenders
        <small>DataTable Kalenders</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Kalenders</li>
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
                <div class="col-md-8 col-lg-8 col-sm-12">
                    <table class="dt-responsive table table-bordered table-striped" id="tbl-kalenders">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
                                <th>Target Kehadiran</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <h4><strong>Form Add / Update Target Kehadiran</strong></h4>
                    <hr>
                    <form id="formaddupdate">
                        <div class="form-group">
                            <label for="jabatan">Bulan</label>
                            <select name="bulan" id="bulan" class="form form-control">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form form-control">
                                <option value="">-- Pilih Tahun --</option>
                                @foreach ($tahun as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="totalhariefektif">Hari Efektif</label>
                            <input type="text" name="totalhariefektif" id="totalhariefektif" class="form form-control"
                                placeholder="Ex: 22">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn pull-right btn-primary btn-sm"><span
                                    class="fa fa-save"></span> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><span class="fa fa-warning"></span> Information</h4>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menjadikan bulan default.?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="kalenderDefault()">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@push('externaljs')
    <script src="{{ asset('assets/bower_components/jqueryvalidate/jquery.validate.js') }}"></script>
    <script>
        var idMasterKalenders = null;
        var url = baseUrl + listRoutes['kalender.getData'];
        var table
        $(() => {
            table = $('#tbl-kalenders').DataTable({
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
                        data: 'bulannya',
                        name: 'bulannya',
                    },
                    {
                        data: 'tahun',
                        name: 'tahun',
                    },
                    {
                        data: 'totalhariefektif',
                        name: 'totalhariefektif',
                    },
                    {
                        data: 'status',
                        name: 'status,',
                    },
                    {
                        data: 'action',
                        name: 'action,',
                    },
                ]
            });
        })

        function clearForm() {
            $('#bulan').val('')
            $('#tahun').val('')
            $('#totalhariefektif').val('')
            idMasterKalenders = null;
        }
        $('#formaddupdate').validate({
            rules: {
                bulan: 'required',
                tahun: 'required',
                totalhariefektif: {
                    required: true,
                    number: true
                }
            },
            submitHandler: function() {
                var url = baseUrl + listRoutes['kalender.store'];
                if (idMasterKalenders != null) {
                    url = baseUrl + listRoutes['kalender.update'].replace('{id}', idMasterKalenders);
                }
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    data: new FormData($('#formaddupdate')[0]),
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        table.ajax.reload(null, false)
                        clearForm()
                    },
                    error: function(res) {
                        alert('gagal')
                    }
                })
            }
        })

        function ubah(id) {
            let urlGet = baseUrl + listRoutes['kalender.show'].replace('{id}', id);
            $.getJSON(urlGet, function(res) {}).done(function(res) {
                $('#bulan').val(res.data[0].bulan)
                $('#tahun').val(res.data[0].tahun)
                $('#totalhariefektif').val(res.data[0].totalhariefektif)
                idMasterKalenders = res.data[0].id
            }).fail(function(res) {
                console.log(res)
            })
        }
        function cek(id){
            idMasterKalenders = id;
        }
        function kalenderDefault(){
            $.ajax({
                url: baseUrl + listRoutes['kalender.default'].replace('{id}', idMasterKalenders),
                type: "POST",
                dataType: "JSON",
                success: function(res){
                    location.reload()
                },
                error: function(res){
                    alert('gagal')
                }
            })
        }
    </script>
@endpush
