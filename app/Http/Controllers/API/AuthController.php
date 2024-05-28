<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kalender;
use App\Models\Kehadiran;
use Illuminate\Http\Request;
use App\Helper\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        try {
            $request->validate([
                'username'      => 'required',
                'password'      => 'required'
            ]);
            $credentials = [
                'email'     => $request->username,
                'password'  => $request->password
            ];
            if(!Auth::attempt($credentials)){
                return ResponseFormatter::error([
                    'message'   => 'Unautorized',
                ], 'Authenticate Failed', 500);
            }
            $user = User::where('email', $request->username)->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new \Exception('Invalid Password');
            }
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                    'access_token'  => $tokenResult,
                    'token_type'    => 'Bearer',
                    'user'          => $user
                ], 'Authenticated');
        } catch (Exception $error) {
            return ResponseFormatter::error([
            ], 'Login Failed', 500);
        }
    }
    //update profile
    public function updateprofile(Request $request){
        try {
            $credentials = $request->validate([
                'nuptk'     => 'required|unique:users,nuptk,'.auth()->user()->id.',id',
                'nama_lengkap'      => 'required',
                'jenis_kelamin'     => 'required',
                'alamat'            => 'required'
            ]);
            $data = [
                    'nuptk'             => $request->nuptk,
                    'nama_lengkap'      => $request->nama_lengkap,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                    'alamat'            => $request->alamat
                ];
                User::where('id', auth()->user()->id)->update($data);
                return ResponseFormatter::success([],'Profile has been Updated');
        } catch (Exception $error) {
            return ResponseFormatter::error([$error], 'Something went wrong', 500);
        }
    }
    //change email or account
    public function changeemail(Request $request){
        try {
            $credentials = $request->validate([
                'email'     => 'required|unique:users,email,'.auth()->user()->id.',id'
            ]);
            User::where('id', auth()->user()->id)->update(['email'=> $request->email]);
            return ResponseFormatter::success([],'Update Account has been successfuly');
        } catch (Exception $error) {
            return ResponseFormatter::error([$error], 'Something went wrong', 500);
        }
    }

    //fetch data
    public function fetchdata(Request $request){
        $bulan = date('m');
        $tahun = date('Y');
        $tanggalSekarang = Carbon::today()->toDateString();
        $user = User::with(['jabatan'])->where('id', auth()->user()->id)->first();
        $masterkalender = Kalender::where('statusmasterkalenders', '1')->first();
        $totalAbsensi = DB::table('absensis')
                        ->select('pegawais_id', DB::raw('COUNT(*) as total_absensi'))
                        ->whereMonth('tgl_absensi', $bulan)
                        ->whereYear('tgl_absensi', $tahun)
                        ->where('pegawais_id', auth()->user()->id)
                        ->groupBy('pegawais_id')
                        ->get();
        $absenToday = Kehadiran::whereDate('tgl_absensi', $tanggalSekarang)->where('id', auth()->user()->id)->get();
        return ResponseFormatter::success([
            'user'              => $user,
            'masterkalenders'   => $masterkalender,
            'totalabsensi'      => $totalAbsensi,
            'absentoday'        => $absenToday
        ]);
    }

    //logout
    public function logout(Request $request){
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success([$token], 'Token Revoked');
    }
}
