<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Helper\ResponseFormatter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class KaryawanController extends Controller
{
    public function index(){
        return view('pages.karyawan.index');
    }
    function getData(){
        $karyawan = User::query();

        return DataTables::of($karyawan)
            ->addColumn('action', function ($row) {
                $nama=$row->name;
                $html = '<a href="'.route('karyawan.show',['id'=> Crypt::encrypt($row->id)]).'" class="btn btn-primary btn-xs" title="Detail Karyawan"><span class="fa fa-eye"></span>';
                $html .= '</a>';
                return $html;
            })
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
            ->addIndexColumn()
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    function create(Request $request){
        $data = [
            'jabatan'       => Jabatan::where('statusjabatans', '1')->get()
        ];
        return view('pages.karyawan.create', $data);
    }
    function store(Request $request){
        try {
            $request->validate([
                'nip'           => 'required|unique:users,nip',
                'nuptk'         => 'required|unique:users,nuptk',
                'namalengkap'   => 'required',
                'nomortelepon'  => 'required',
                'alamat'        => 'required',
                'jabatan'       => 'required',
                'email'         => 'required|unique:users,email',
                'jeniskelamin'  => 'required'
            ]);
            $data = [
                'nip'           => $request->nip,
                'nuptk'         => $request->nuptk,
                'nama_lengkap'  => $request->namalengkap,
                'jenis_kelamin' => $request->jeniskelamin,
                'notelepon'     => $request->nomortelepon,
                'jabatansid'    => $request->jabatan,
                'alamat'        => $request->alamat,
                'role'          => '3',
                'fotos'         => 'default.jpg',
                'statususers'   => '1',
                'email'         => $request->email,
                'password'      => Hash::make('password')
            ];
            if($request->hasFile('files')){
                $files          = $request->file('files');
                $filename       = time().'.'.$files->getClientOriginalExtension();
                $files->storeAs('public/users', $filename);
                $data['fotos']=$filename;
            }
            User::create($data);
            return ResponseFormatter::success([],'Data has been created', 200);
        } catch (Exception $error) {
            return ResponseFormatter::error([], 'Something went wrong', 500);
        }
    }
    function show(Request $request, $id){
        $data = [
            'jabatan'       => Jabatan::all()
        ];
        return view('pages.karyawan.show', $data);
    }
    function getDetail($id){
        return ResponseFormatter::success([
            User::with(['jabatan'])->where('id', Crypt::decrypt($id))->first()
        ], 'Get data successfuly', 200);
    }
    function update(Request $request, $id){
        try {
            $request->validate([
                'nip'               => 'required|unique:users,nip,'.Crypt::decrypt($id).',id',
                'nuptk'             => 'required|unique:users,nuptk,'.Crypt::decrypt($id).',id',
                'nama_lengkap'      => 'required',
                'nomor_telepon'     => 'required|unique:users,notelepon,'.Crypt::decrypt($id).',id',
                'jabatan'           => 'required',
                'alamat'            => 'required',
                'role'              => 'required'
            ]);
            $credentials = [
                'nip'           => $request->nip,
                'nuptk'         => $request->nuptk,
                'nama_lengkap'  => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'notelepon'     => $request->nomor_telepon,
                'jabatansid'    => $request->jabatan,
                'alamat'        => $request->alamat,
                'role'          => $request->role,
                'statususers'   => $request->statususer
            ];
            User::where('id', Crypt::decrypt($id))->update($credentials);
            return ResponseFormatter::success([], 'Update profile berhasil ', 200);
        } catch (Exception $error) {
            return ResponseFormatter::error([$error], 'Something went wrong', 500);
        }
    }
}
