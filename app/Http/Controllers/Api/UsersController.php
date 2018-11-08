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
    public function register(Request $request){
        $req = $request->all();
        $messsages = array( 
                            'password.required'=>'Password Harus Diisi',
                            'name.required'=>'Nama Harus Diisi',
                            'nik.required'=>'Nik Harus Diisi',
                            'alamat.required'=>'Alamat Harus Diisi',
                            'no_hp.required'=>'No HP Harus Diisi',
                           );   

        $rules = array(
                        'password' => 'required',
                        'name' => 'required',
                        'nik' => 'required',
                        'alamat' => 'required',
                        'no_hp' => 'required',
                      );

        $validator = Validator::make($request->all(), $rules,$messsages);
        if($validator->fails()){
            $success = 0;
            $msg = $validator->messages()->all();
            $response = $msg;
        }else{
            $input = $request->except('password');
            $input['password'] = bcrypt($request->password);
            $input['role'] = '1';

            $data = User::create($input);
            if($data){
                  $success = 1;
                  $msg = $data;
                  $response = [
                      "success" => $success,
                      "msg" => $msg,
                  ];
                
            }else{
                $success = 0;
                $msg = "Gagal Register";
                $response = [
                      "success" => $success,
                      "msg" => $msg,
                  ];
            } 
        }
        return response()->json($response);
   }

    public function login(Request $request){
        $req = $request->all();
        $messsages = array( 
                            'no_hp.required'=>'No HP Harus Diisi',
                            'password.required'=>'Password Harus Diisi',
                           );   

        $rules = array( 'no_hp' => 'required',
                        'password' => 'required',
                      );

        $validator = Validator::make($request->all(), $rules,$messsages);
        if($validator->fails()){
            $success = 0;
            $msg = $validator->messages()->all();
            $response = $msg;
        }else{
            if(Auth::attempt(['no_hp' => $request->no_hp, 'password' => $request->password])){
                $user = User::where('no_hp', $request->no_hp)->first();
                  $success = 1;
                  $msg = $user;
                  $response = [
                      "success" => $success,
                      "msg" => $msg,
                  ];
                $token['token'] = $request->token;
                $user->update($token);
            }else{
                $success = 0;
                $msg = "Gagal Login";
                $response = [
                      "success" => $success,
                      "msg" => $msg,
                  ];
            } 
        }
        return response()->json($response);
   }

   public function laporus(Request $request)
   {
   	  $req = $request->all();
        $messsages = array( 
                            'user_id.required'=>'Anda Harus Login Kembali',
                            'lat.required'=>'Anda Harus Menyalakan GPS',
                            'long.required'=>'Anda Harus Menyalakan GPS',
                            'gambar.required'=>'Anda Harus Memotret Keadaan Kebakaran',
                           );   

        $rules = array( 'user_id' => 'required',
                        'lat' => 'required',
                        'long' => 'required',
                        'gambar' => 'required',
                      );

        $validator = Validator::make($request->all(), $rules,$messsages);
        if($validator->fails()){
            $success = 0;
            $msg = $validator->messages()->all();
            $response = $msg;
        }else{
             $input = $request->except('gambar');
             $upload = $request->file('gambar');
             $input['gambar'] = $upload->store('lapor');
             $input['status'] = '0';
             $data = Lapor::create($input);
            if($data){
                  event(new LaporEvent('Ada Laporan Kebakaran Masuk !!!!', [1]));
                  $success = 1;
                  $msg = $data;
                  $response = [
                      "success" => $success,
                      "msg" => $msg,
                  ];
                
            }else{
                $success = 0;
                $msg = "Gagal Mengirim Laporan";
                $response = [
                      "success" => $success,
                      "msg" => $msg,
                  ];
            } 
        }
        return response()->json($response);
   }
}
