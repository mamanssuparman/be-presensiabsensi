<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helper\ResponseFormatter;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('pages.profile.index');
    }
    function getData(){
        return ResponseFormatter::success([
            User::where('id', auth()->user()->id)->first()
        ], 'Berhasil mengambil data');
    }
    function update(Request $request){
        try {
            $request->validate([
                'nip'               => 'required|unique:users,nip,'.auth()->user()->id.',id',
                'nuptk'             => 'required|unique:users,nuptk,'.auth()->user()->id.',id',
                'nama_lengkap'      => 'required',
                'alamat'            => 'required',
                'jenis_kelamin'     => 'required',
                'nomor_telepon'     => 'required|unique:users,notelepon,'.auth()->user()->id.',id'
            ]);
            $data = [
                'nip'               => $request->nip,
                'nuptk'             => $request->nuptk,
                'nama_lengkap'      => $request->nama_lengkap,
                'alamat'            => $request->alamat,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'notelepon'         => $request->nomor_telepon
            ];
            User::where('id', auth()->user()->id)->update($data);
            $request->session()->flash('pesan', 'success');
            return ResponseFormatter::success([],'Data profile berhasil di perbaharui.');
        } catch (Exception $errors) {
            return ResponseFormatter::error([$errors], 'Something went wrong');
        }
    }
    function changeemail(Request $request){
        try {
            $request->validate([
                'email'     => 'required|unique:users,email,'.auth()->user()->id.',id'
            ]);
            User::where('id', auth()->user()->id)->update([
                'email'     => $request->email
            ]);
            $request->session()->flash('pesan', 'success');
            return ResponseFormatter::success([], 'Update email berhasil');
        } catch (Exception $error) {
            return ResponseFormatter::error([$error], 'Something went wrong');
        }
    }
    function changepassword(Request $request){
        User::where('id', auth()->user()->id)->update([
            'password'          => Hash::make($request->newpassword)
        ]);
        $request->session()->flash('pesan', 'success');
        return ResponseFormatter::success([], 'Change password berhasil');
    }
}
