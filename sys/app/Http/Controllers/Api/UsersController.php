<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Lapor;
use Validator;
use App\Events\LaporEvent;
use Auth;
use Storage;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $messsages = array(
            'password.required' => 'Password Harus Diisi',
            'name.required' => 'Nama Harus Diisi',
            'nik.required' => 'Nik Harus Diisi',
            'alamat.required' => 'Alamat Harus Diisi',
            'no_hp.required' => 'No HP Harus Diisi',
            'no_hp.unique' => 'No HP Sudah Terdaftar'
        );

        $rules = array(
            'password' => 'required',
            'name' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|unique:users',
        );

        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            $response = [
                "msg" => $msg
            ];
            $code = 400;
        } else {
            $input = $request->except('password');
            $input['password'] = bcrypt($request->password);
            $input['role'] = '1';
            $data = User::create($input);
            if ($data) {
                $msg = $data;
                $response = [
                    "msg" => $msg,
                ];
                $code = 201;
            } else {
                $msg = "Gagal Register";
                $response = [
                    "msg" => $msg,
                ];
                $code = 400;
            }
        }
        return response()->json($response, $code);
    }

    public function login(Request $request)
    {
        $messsages = array(
            'no_hp.required' => 'No HP Harus Diisi',
            'password.required' => 'Password Harus Diisi',
        );

        $rules = array(
            'no_hp' => 'required',
            'password' => 'required',
        );

        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            $response = [
                "msg" => $msg
            ];
            $code = 400;
        } else {
            if (Auth::attempt(['no_hp' => $request->no_hp, 'password' => $request->password])) {
                $user = User::where('no_hp', $request->no_hp)->first();
                $msg = $user;
                $response = [
                    "msg" => $msg,
                ];
                $token['token'] = $request->token;
                $user->update($token);
                $code = 200;
            } else {
                $code = 404;
                $msg = "Gagal Login";
                $response = [
                    "msg" => $msg,
                ];
            }
        }
        return response()->json($response, $code);
    }

    public function laporus(Request $request)
    {
        $req = $request->all();
        $messsages = array(
            'user_id.required' => 'Anda Harus Login Kembali',
            'lat.required' => 'Anda Harus Menyalakan GPS',
            'long.required' => 'Anda Harus Menyalakan GPS',
            'gambar.required' => 'Anda Harus Memotret Keadaan Kebakaran',
        );

        $rules = array(
            'user_id' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'gambar' => 'required',
        );

        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            $response = [
                "msg" => $msg
            ];
            $code = 400;
        } else {
            $input = $request->except('gambar');
            $upload = $request->file('gambar');
            $input['gambar'] = $upload->store('lapor');
            $input['status'] = '0';
            $data = Lapor::create($input);
            if ($data) {
                event(new LaporEvent('Ada Laporan Kebakaran Masuk !!!!', [1]));
                $msg = $data;
                $response = [
                    "msg" => $msg,
                ];
                $code = 201;
            } else {
                $msg = "Gagal Mengirim Laporan";
                $response = [
                    "msg" => $msg,
                ];
                $code = 400;
            }
        }
        return response()->json($response, $code);
    }
}
