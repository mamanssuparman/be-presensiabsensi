<?php

namespace App\Http\Controllers\API;

use App\Models\Ajuan;
use Illuminate\Http\Request;
use App\Helper\ResponseFormatter;
use App\Http\Controllers\Controller;

class AjuanController extends Controller
{
    public function getizinuser(){
        $bulan = date('m');
        $dataizin = Ajuan::where('pegawais_id', auth()->user()->id)->where('jenis_ajuans', '!=','3')->whereMonth('tanggal_awal', $bulan)->get();
        return ResponseFormatter::success([$dataizin],'Get data izin successfuly');
    }
    public function getdinasluar(){
        $bulan = date('m');
        $dataizin = Ajuan::where('pegawais_id', auth()->user()->id)->where('jenis_ajuans', '3')->whereMonth('tanggal_awal', $bulan)->get();
        return ResponseFormatter::success([$dataizin],'Get data izin successfuly');
    }
    public function ajukanizinsakit(Request $request){
        try {
            $request->validate([
                'jenis_ajuans'       => 'required',
                'tanggal_awal'      => 'required',
                'tanggal_akhir'     => 'required',
                'lampiran'          => 'required'
            ]);
            $data = [
                'pegawais_id'       => auth()->user()->id,
                'jenis_ajuans'      => $request->jenis_ajuans,
                'tanggal_awal'      => $request->tanggal_awal,
                'tanggal_akhir'     => $request->tanggal_akhir,
            ];
            if($request->hasFile('lampiran')){
                $files = $request->file('lampiran');
                $extension = $files->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $files->storeAs('public/ajuans', $filename);
                $data['lampiran']=$filename;
            }
            Ajuan::create($data);
            return ResponseFormatter::success([],'Ajuan izin atau sakit berhasil di simpan');
        } catch (Exception $error) {
            return ResponseFormatter::error([$error], 'Something went wrong', 500);
        }
    }
    public function ajukandinasluar(Request $request){
        try {
            $request->validate([
                'jenis_ajuans'       => 'required',
                'tanggal_awal'      => 'required',
                'tanggal_akhir'     => 'required',
                'lampiran'          => 'required',
                'tujuan'            => 'required'
            ]);
            $data = [
                'pegawais_id'       => auth()->user()->id,
                'jenis_ajuans'      => $request->jenis_ajuans,
                'tanggal_awal'      => $request->tanggal_awal,
                'tanggal_akhir'     => $request->tanggal_akhir,
                'tujuan'            => $request->tujuan
            ];
            if($request->hasFile('lampiran')){
                $files = $request->file('lampiran');
                $extension = $files->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $files->storeAs('public/ajuans', $filename);
                $data['lampiran']=$filename;
            }
            Ajuan::create($data);
            return ResponseFormatter::success([],'Ajuan dinas luar berhasil di simpan');
        } catch (Exception $error) {
            return ResponseFormatter::error([$error], 'Something went wrong', 500);
        }
    }
    public function getdetailizinsakit(Request $request){
        try {
            return ResponseFormatter::success([Ajuan::where('pegawais_id', auth()->user()->id)->where('id', $request->id)->first()],'berhasil mengambil detail ajuan');
        } catch (Exception $error) {
            return ResponseFormatter::error([$error], 'Something went wrong',500);
        }
    }
    public function cancelajuan(Request $request){
        try {
            Ajuan::where('id', $request->id)->delete();
            return ResponseFormatter::success([], 'Data ajuan berhasil di cancel');
        } catch (\Throwable $th) {
            return ResponseFormatter::error([$error], 'Something went wrong',500);
        }
    }
}
