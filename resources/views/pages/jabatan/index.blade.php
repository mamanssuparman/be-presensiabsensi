@extends('layouts.master')
@section('title')
    K-BIL | Jabatan
@endsection
@section('content-header')
    <h1>
        Jabatan
        <small>DataTable Jabatan</small>
    </h1>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>Jabatan</li>
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
                    <table class="dt-responsive table table-bordered table-striped" id="tbl-jabatan">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Jabatan</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <h4><strong>Form Add / Update Jabatan</strong></h4>
                    <hr>
                    <form id="formaddupdate">
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form form-control">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="form form-control">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label> <br>
                            <input type="radio" name="statusjabatans" id="statusjabatanaktif" value="1"> Aktif
                            <input type="radio" name="statusjabatans" id="statusjabatannonaktif" value="2"> Non Aktif
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
@endsection
@push('externaljs')
    <script src="{{ asset('assets/bower_components/jqueryvalidate/jquery.validate.js') }}"></script>
    <script>
        var idJabatan =null;
        var url = baseUrl + listRoutes['jabatan.getData'];
        var table
        $(() => {
            table = $('#tbl-jabatan').DataTable({
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
                        data: 'jabatan',
                        name: 'jabatan',
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });
        })

        function clearForm() {
            $('#jabatan').val('')
            $('#keterangan').val('')
            $('input[name="statusjabatans"]').prop('checked', false);
            idJabatan=null;
        }
        $('#formaddupdate').validate({
            rules: {
                jabatan: 'required',
                keterangan: 'required'
            },
            submitHandler: function() {
                var url = baseUrl + listRoutes['jabatan.store'];
                if(idJabatan != null){
                    url = baseUrl + listRoutes['jabatan.update'].replace('{id}', idJabatan);
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
            let urlGet = baseUrl + listRoutes['jabatan.show'].replace('{id}', id);
            $.getJSON(urlGet, function(res){
            }).done(function(res){
                $('#jabatan').val(res.data[0].jabatan)
                $('#keterangan').val(res.data[0].keterangan)
                if(res.data[0].statusjabatans == "1"){
                    $('#statusjabatanaktif').prop("checked", true)
                } else {
                    $('#statusjabatannonaktif').prop("checked", true)
                }
                idJabatan=res.data[0].id
            }).fail(function(res){
                console.log(res)
            })
        }
    </script>
@endpush
