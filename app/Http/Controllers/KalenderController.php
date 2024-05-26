<?php

namespace App\Http\Controllers;

use App\Models\Kalender;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Helper\ResponseFormatter;

class KalenderController extends Controller
{
    public function index(){
        $tahun = range(2024, date('Y'));
        return view('pages.kalender.index', compact('tahun'));
    }
    function getData(){
        $jabatan = Kalender::query();

        return DataTables::of($jabatan)
            ->addColumn('action', function ($row) {
                $nama=$row->name;
                $html = '<button onclick="ubah('.$row->id.')" class="btn btn-primary btn-xs"><span class="fa fa-edit"></span>';
                $html .= '</button>';
                $html .= ' <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-default" onclick="cek('.$row->id.')"><span class="fa fa-exchange"></span>';
                $html .= '</button>';
                return $html;
            })
            ->addColumn('status', function($row){
                if($row->statusmasterkalenders == '1'){
                    $status = '<span class="label label-primary">Aktif</span>';
                } else {
                    $status = '<span class="label label-warning">Non Aktif</span>';
                }
                $html = '<div>';
                $html .= $status;
                $html .='</div>';
                return $html;

            })
            ->editColumn('bulannya', function($row){
                $bulan = convertMontToName($row->bulan);
                $html = '<div>'.$bulan.'';
                $html .= '</div>';
                return $html;
            })
            ->addIndexColumn()
            ->rawColumns(['action', 'status', 'bulannya'])
            ->make(true);
    }
    function store(Request $request){
        try {
            $data = [
                'bulan'                 => $request->bulan,
                'tahun'                 => $request->tahun,
                'totalhariefektif'      => $request->totalhariefektif,
                'statusmasterkalenders' => '2'
            ];
            Kalender::create($data);
            return ResponseFormatter::success([], 'Data Kalender has been saved', 200);
        } catch (\Throwable $th) {
            return ResponseFormatter::error([$th], 'Something went wrong', 500);
        }
    }
    function show(Request $request, $id){
        $data = Kalender::where('id', $id)->first();
        return ResponseFormatter::success([$data], 'Get Data Successfuly');
    }
    function update(Request $request, $id){
        try {
            $request->validate([
                'bulan'             => 'required',
                'tahun'             => 'required',
                'totalhariefektif'  => 'required'
            ]);
            $data = [
                'bulan'             => $request->bulan,
                'tahun'             => $request->tahun,
                'totalhariefektif'  => $request->totalhariefektif
            ];
            Kalender::where('id', $id)->update($data);
            return ResponseFormatter::success([], 'Kalender has been saved', 200);
        } catch (\Throwable $th) {
            return ResponseFormatter::error([$th], 'Something went wrong', 500);
        }
    }
    function defaultkalender($id){
        Kalender::where('statusmasterkalenders', '!=', '2')->update(['statusmasterkalenders'=> '2']);
        Kalender::where('id', $id)->update(['statusmasterkalenders' => '1']);
        return ResponseFormatter::success([], 'Change kalender successfuly', 200);
    }
}
