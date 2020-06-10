<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lapor;
use Auth;
class MapsController extends Controller
{
    public function index()
    {
    	$data['lat'] = 1.478345;
    	$data['long'] = 124.873156;
    	return view('maps.index',compact('data'));
    }

    public function laporan($id)
    {
    	$data = Lapor::findOrFail($id);
    	return view('maps.lapor', compact('data'));
    }
}
