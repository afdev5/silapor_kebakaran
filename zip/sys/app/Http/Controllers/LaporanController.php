<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lapor;
use DataTables;
 
class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Lapor::where('status', '!=', '0')->orderBy('id', 'DESC')->get();
        return view('laporan.index', compact('data'));
        // return Lapor::where('status', '!=', '0')->whereBetween('created_at', ['2020-01-01', '2020-01-12'])->orderBy('id', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Lapor::where('status', '1')->orderBy('id', 'DESC')->get();
        return view('laporan.maps', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Lapor::where('status', '!=', '0')->whereBetween('created_at', [$request->start, $request->end])->orderBy('id', 'DESC')->get();
        return view('laporan.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lapor = Lapor::findOrFail($id);
        $data['lat'] = $lapor->lat;
        $data['long'] = $lapor->long;
        return view('laporan.maps', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function datatable(Request $request)
    {
        if (!empty($request->start_date)) {
            $data = Lapor::where('status', '!=', '0')->whereBetween('created_at', [$request->start_date, $request->end_date])->orderBy('id', 'DESC')->get();
        } else {
            $data = Lapor::where('status', '!=', '0')->orderBy('id', 'DESC')->get();
        }

        return Datatables::of($data)
            ->addColumn('gbr', function ($data) {
                $url = asset('upload/'.$data->gambar);
                return '<a class="lihat_img btn btn-sm btn-info" href="'.$url.'">Lihat</a>';
            })
            ->addColumn('action', function ($data) {
                return '<a class="btn btn-sm btn-success" href="' . route('laporan.show', $data->id) . '">Lihat</a>';
            })
            ->addColumn('statu', function ($data) {
                if ($data->status == '1') {
                    return 'Diterima';
                } else {
                    return 'Ditolak';
                }
            })
            ->addColumn('no_hp', function ($data) {
                return $data->user['no_hp'];
            })
            ->addColumn('nama', function ($data) {
                return $data->user['name'];
            })
            ->addIndexColumn()->rawColumns(['action', 'gbr'])->make(true);
    }
}
