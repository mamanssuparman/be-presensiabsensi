<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterAbsensi;
use App\Helper\ResponseFormatter;

class MaterAbsensiController extends Controller
{
    public function index(){
        return view('pages.absensi.index');
    }
    function getData(){
        $dataAbsensi = MasterAbsensi::first();
        return ResponseFormatter::success([$dataAbsensi], 'get data berhasil');
    }
    function update(Request $request){
        try {
            $data= [
                'latitude'          => $request->latitude,
                'langitude'         => $request->longitude,
                'jam_masuk'         => $request->jammasuk,
                'jam_keluar'        => $request->jamkeluar,
                'jarakabsen'        => $request->jarakabsen
            ];
            $masterAbsensi = MasterAbsensi::first();
            $masterAbsensi->update($data);
            $masterAbsensi->save();
            return ResponseFormatter::success([$request->all()], 'Update data berhasil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error([$request->all()], 'Something Went Wrong');
        }
    }
}
