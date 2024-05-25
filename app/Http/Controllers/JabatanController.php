<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Helper\ResponseFormatter;

class JabatanController extends Controller
{
    public function index(Request $request){
        return view('pages.jabatan.index');
    }
    function getData(){
        $jabatan = Jabatan::query();

        return DataTables::of($jabatan)
            ->addColumn('action', function ($row) {
                $nama=$row->name;
                $html = '<button onclick="ubah('.$row->id.')" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span>';
                $html .= '</button>';
                return $html;
            })
            ->addColumn('status', function($row){
                if($row->statusjabatans == '1'){
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
    function store(Request $request){
        try {
            $request->validate([
                'jabatan'       => 'required',
                'keterangan'    => 'required',
                'statusjabatans'=> 'required'
            ]);
            $data = [
                'jabatan'       => $request->jabatan,
                'keterangan'    => $request->keterangan,
                'statusjabatans'=> $request->statusjabatans
            ];
            Jabatan::create($data);
            return ResponseFormatter::success([], 'Jabatan has been saved', 200);
        } catch (\Throwable $th) {
            return ResponseFormatter::error([$th], 'Something went wrong', 500);
        }
    }
    function show(Request $request, $id){
        $data = Jabatan::where('id', $id)->first();
        return ResponseFormatter::success([$data], 'Get Data Successfuly');
    }
    function update(Request $request, $id){
        try {
            $request->validate([
                'jabatan'       => 'required',
                'keterangan'    => 'required',
                'statusjabatans'=> 'required'
            ]);
            $data = [
                'jabatan'       => $request->jabatan,
                'keterangan'    => $request->keterangan,
                'statusjabatans'=> $request->statusjabatans
            ];
            Jabatan::where('id', $id)->update($data);
            return ResponseFormatter::success([], 'Jabatan has been saved', 200);
        } catch (\Throwable $th) {
            return ResponseFormatter::error([$th], 'Something went wrong', 500);
        }
    }
}
