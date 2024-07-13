<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Helper\ResponseFormatter;
use Illuminate\Support\Facades\Crypt;

class KehadiranController extends Controller
{
    public function index(){
        return view('pages.kehadiran.index');
    }
    function getData(){
        $karyawan = Kehadiran::with(['user', 'masterabsensi'])->orderBy('created_at', 'DESC')->get();

        return DataTables::of($karyawan)
            ->addColumn('status', function($row){
                if($row->statususers == '1'){
                    $status = '<span class="label label-primary">Aktif</span>';
                } else {
                    $status = '<span class="label label-warning">Non Aktif</span>';
                }
                $html = '<div>';
                $html .= $status;
                $html .='</div>';
                return $html;
            })
            ->addColumn('fotos', function($row){
                $photos = $row->user->fotos;
                $html = '<div>';
                $html .='<img src="'.asset('storage/users/'.$photos).'" class="profile-user-img img-responsive img-circle">';
                $html .= '</div>';
                return $html;
            })
            ->addColumn('nama_pegawai', function($row){
                $dataPegawai = $row->user->nama_lengkap;
                return $dataPegawai;
            })
            ->addColumn('action', function($row){
                if($row->ajuans_id == null){
                    // $nama=$row->name;
                    $html = '<a href="'.route('kehadiran.show',['id'=> Crypt::encrypt($row->id)]).'" class="btn btn-primary btn-xs" title="Detail Absensis"><span class="fa fa-eye"></span>';
                    $html .= '</a>';
                }else{
                    $html ='';
                }
                return $html;
            })
            ->editColumn('jenis_ajuans', function($row){
                $jenis_ajuans = $row->jenis_ajuans;
                if($jenis_ajuans == '1'){
                    $html = '<span class="label label-primary">Sakit</span>';
                }elseif($jenis_ajuans == '2'){
                    $html = '<span class="label label-success">Izin</span>';
                }elseif($jenis_ajuans == '3'){
                    $html = '<span class="label label-warning">Dinas Luar</span>';
                }else{
                    $html = '<span class="label label-primary">Hadir</span>';
                }
                $htmlx = '<div>';
                $htmlx .= $html;
                $htmlx .= '</div>';
                return $htmlx;
            })
            ->addIndexColumn()
            ->rawColumns(['status', 'nama_pegawai', 'fotos', 'action', 'jenis_ajuans'])
            ->make(true);
    }
    function show($id){
        return view('pages.kehadiran.show');
    }
    function detail($id){
        try {
            $data = Kehadiran::with(['user','user.jabatan','masterabsensi'])->where('id', Crypt::decrypt($id))->firstOrFail();
            return ResponseFormatter::success([$data],'Get detail has been successfuly');
        } catch (\Throwable $th) {
            return ResponseFormatter::error([$th],'Something went wrong', 500);
        }
    }
}
