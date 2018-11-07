<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lapor;
use App\User;
use App\Helper\SendNotif;
use Storage;

class LaporController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Lapor::where('status', '0')->orderBy('id', 'DESC')->get();
        return view('maps.lapor', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ // Terima Laporan
    public function show($id)
    {
        $lapor = Lapor::findOrFail($id);
        $data['lat'] = $lapor->lat;
        $data['long'] = $lapor->long;
        $ubah['status'] = '1';
        $lapor->update($ubah);
        // Kirim Notif Ke Android
        $user = User::findOrFail($lapor->user_id);
        SendNotif::sendNotifikasi($user->token, 1);
        return view('maps.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data = Lapor::findOrFail($id);
        if ($data->gambar != null) {
            Storage::delete($data->gambar);
        }
        $data->delete();
        // Kirim Notif Ke Android
        $user = User::findOrFail($data->user_id);
        SendNotif::sendNotifikasi($user->token, 2);
        return redirect()->route('laapor.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
