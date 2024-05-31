<?php

namespace App\Http\Controllers\API;

use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Models\MasterAbsensi;
use App\Helpers\DistanceHelper;
use App\Helper\ResponseFormatter;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Exceptions\ValidasiException;

class AbsenController extends Controller
{
    public function absenmasuk(Request $request){
        try {
            $validasi = $request->validate([
                'latitudeinput'     => 'required',
                'langitudeinput'    => 'required',
                'fotomasuk'         => 'required'
            ]);
            if(!$validasi){
                throw new ValidasiException($error);
            }
            $dataAbsensi = MasterAbsensi::first();
            if(!$dataAbsensi){
                throw new \Exception("Data master absensi belum di setting.");
            }
            $latitudeMaster = $dataAbsensi->latitude;
            $longitudeMaster = $dataAbsensi->langitude;
            $jarak = DistanceHelper::haversineGreatCircleDistance($request->input('latitudeinput'),$request->input('langitudeinput'), $latitudeMaster, $longitudeMaster);
            if($jarak >= $dataAbsensi->jarakabsen ){
                // throw Exception(['data'=> 'Jarak Terlalu jauh' ]);
                throw new CustomException('Jaraknya Terlalu jauh');
            }
            $files = $request->file('fotomasuk');
            $filename = auth()->user()->nuptk.'-'.time().'.'.$files->getClientOriginalExtension();
            $files->storeAs('public/absenmasuk', $filename);
            $data = [
                'pegawais_id'       => auth()->user()->id,
                'masterabsensis_id' => $dataAbsensi->id,
                'tgl_absensi'       => date('y-m-d'),
                'waktu_masuk'       => date('H:i:s'),
                'latitude_masuk'    => $request->latitudeinput,
                'longitude_masuk'   => $request->langitudeinput,
                'foto_masuk'        => $filename,
                'jarak_absen_masuk' => $jarak
            ];
            Kehadiran::create($data);
            return ResponseFormatter::success(['jarak'  => $jarak], 'Absen masuk berhasil di simpan');
        } catch (Exception $error) {
            return ResponseFormatter::error([$error], 'Something went wrong', 500);
        }
        catch(CustomException $e) {
            return ResponseFormatter::error([], $e->render('Pesan'), 422);
        } catch(ValidasiException $e){
            return ResponseFormatter::error([$e->render('Pesan')], 'Something went wrong', 500);
        }
    }
    public function absenkeluar(Request $request){
        try {
            //ambil data absensi terakhir
            $dataAbsenMasuk = Kehadiran::where('pegawais_id', auth()->user()->id)->where('tgl_absensi', date('y-m-d'))->whereNull('waktu_keluar')->first();
            $validasi = $request->validate([
                'latitudeinput'     => 'required',
                'langitudeinput'    => 'required',
                'fotokeluar'         => 'required'
            ]);
            if(!$validasi){
                throw new ValidasiException($error);
            }
            $dataAbsensi = MasterAbsensi::first();
            if(!$dataAbsensi){
                throw new CustomException('Data master absensi belum di setting');
            }
            $latitudeMaster = $dataAbsensi->latitude;
            $longitudeMaster = $dataAbsensi->langitude;
            $jarak = DistanceHelper::haversineGreatCircleDistance($request->input('latitudeinput'),$request->input('langitudeinput'), $latitudeMaster, $longitudeMaster);
            if($jarak >= 200 ){
                // throw Exception(['data'=> 'Jarak Terlalu jauh' ]);
                throw new CustomException('Jaraknya Terlalu jauh');
            }
            $files = $request->file('fotokeluar');
            $filename = auth()->user()->nuptk.'-'. time().'.'.$files->getClientOriginalExtension();
            $files->storeAs('public/absenmasuk', $filename);
            $data = [
                'pegawais_id'       => auth()->user()->id,
                'masterabsensis_id' => $dataAbsensi->id,
                'waktu_keluar'       => date('H:i:s'),
                'latitude_keluar'    => $request->latitudeinput,
                'longitude_keluar'   => $request->langitudeinput,
                'foto_keluar'        => $filename,
                'jarak_absen_keluar' => $jarak
            ];
            Kehadiran::where('id', $dataAbsenMasuk->id)->update($data);
            return ResponseFormatter::success(['jarak'  => $jarak], 'Absen keluar berhasil di simpan');
        } catch (Exception $error) {
            return ResponseFormatter::error([$error], 'Something went wrong', 500);
        }
        catch(CustomException $e) {
            return ResponseFormatter::error([], $e->render('Pesan'), 422);
        } catch(ValidasiException $e){
            return ResponseFormatter::error([$e->render('Pesan')], 'Something went wrong', 500);
        }
    }
}
