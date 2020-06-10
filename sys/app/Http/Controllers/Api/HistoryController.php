<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lapor;
use Validator;

class HistoryController extends Controller
{
    public function listLaporan(Request $request)
    {
        $messsages = array(
            'user_id.required' => 'Anda Harus Login Kembali',
        );

        $rules = array(
            'user_id' => 'required',
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            $response = [
                "msg" => $msg
            ];
            $code = 400;
        } else {
            $data = Lapor::where('user_id', $request['user_id'])->orderBy('id', 'DESC')->get();
            if ($data->count() < 1) {
                $response = [
                    "msg" => "Tidak Ada Data",
                ];
            } else {
                $response = [
                    "msg" => $data,
                ];
            }
            $code = 200;
        }
        return response()->json($response, $code);
    }

    // Detail Laporan
    public function detail(Request $request)
    {
        $messsages = array(
            'user_id.required' => 'Anda Harus Login Kembali',
            'laporan_id.required' => 'Anda Harus Mengirim ID Laporan'
        );

        $rules = array(
            'user_id' => 'required',
            'laporan_id' => 'required'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            $response = [
                "msg" => $msg
            ];
            $code = 400;
        } else {
            $data = Lapor::findOrFail($request['user_id']);
            if ($data->count() < 1) { // Jika Data Tidak Ditemukan
                $response = [
                    "msg" => "Data Laporan Tidak Ditemukan",
                ];
            } else { //Ditemukan
                $response = [
                    "msg" => $data,
                ];
            }
            $code = 200;
        }
        return response()->json($response, $code);
    }
}
