<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(){
        $data['title'] = 'Presensi';
        $data['kehadiran'] = Kehadiran::where('user_id', auth()->user()->id)->with( 'qrcode')->get(); 
        return view('presensi')->with($data);
    }

    public function beranda(){
        $data['title'] = 'Beranda';
        return view('beranda');
    }
}
