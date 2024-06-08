<?php

namespace App\Http\Controllers;

use App\Models\Ajuan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Helper\ResponseFormatter;
use Illuminate\Support\Facades\Crypt;

class AjuanController extends Controller
{
    public function index(){
        return view('pages.ajuan.index');
    }
    function getData(){
        $jabatan = Ajuan::with(['user'])->get();

        return DataTables::of($jabatan)
            ->addColumn('action', function ($row) {
                $nama=$row->name;
                $html = '<a href="'.route('ajuan.show', Crypt::encrypt($row->id)).'" class="btn btn-primary btn-xs"><span class="fa fa-eye"></span>';
                $html .= '</a>';
                return $html;
            })
            ->addColumn('nama_pegawai', function($row){
                $namaPegawai = $row->user->nama_lengkap;
                return $namaPegawai;
            })
            ->editColumn('jenis_ajuans', function($row){
                $jenis = $row->jenis_ajuans;
                if($jenis == '1'){
                    $html = '<span class="label label-primary">';
                    $html .= 'Sakit</span>';
                } elseif($jenis == '2'){
                    $html = '<span class="label label-success">';
                    $html .= 'Ijin</span>';
                } else {
                    $html = '<span class="label label-warning">';
                    $html .= 'Dinas Luar</span>';
                }
                $htmlx = '<div>';
                $htmlx .= $html;
                $htmlx .= '</div>';
                return $htmlx;
            })
            ->editColumn('statusajuan', function($row){
                $statusnya = $row->statusajuan;
                if($statusnya == '1'){
                    $html = '<span class="label label-primary">Process</span>';
                } elseif($statusnya == '2'){
                    $html ='<span class="label label-success">Approve</span>';
                } else {
                    $html ='<span class="label label-danger">Tolak</span>';
                }
                $htmlx = '<div>';
                $htmlx .= $html;
                $htmlx .= '</div>';
                return $htmlx;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'nama_pegawai', 'jenis_ajuans', 'statusajuan'])
            ->make(true);
    }
    function show($id){
        return view('pages.ajuan.show');
    }
    function detail(Request $request, $id){
        return ResponseFormatter::success([
            Ajuan::with(['user'])->where('id', Crypt::decrypt($id))->first()
        ], 'get data berhasil');
    }
    function update(Request $request, $id){
        try {
            $data = [
                'statusajuan'       => $request->status,
                'alasantolak'       => NULL
            ];
            if($request->status == '3'){
                $data['alasantolak']=$request->alasan;
            }
            Ajuan::where('id', Crypt::decrypt($id))->update($data);
            return ResponseFormatter::success([], 'Update data success');
        } catch (Exception $error) {
            return ResponseFormatter::error([], 'Something went wrong');
        }
    }
}
