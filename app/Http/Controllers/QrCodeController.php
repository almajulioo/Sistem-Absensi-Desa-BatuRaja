<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\User;
use App\Models\Qrcodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function generate()
    {
        // Generate kode unik (UUID)
        $uniqueCode = Str::uuid();

        $qrCode = Qrcodes::where('code', $uniqueCode)->first();
        while($qrCode) {
            $uniqueCode = Str::uuid();
            $qrCode = Qrcodes::where('code', $uniqueCode)->first();
        }

        $qrCode = Qrcodes::where('valid_date', now()->toDateString())->first();
        if (!$qrCode) {
            $qrCode = Qrcodes::create([
                'code' => $uniqueCode,
                'valid_date' => now()->toDateString(),
            ]);
            $users = User::all();
            foreach($users as $user) {
                Kehadiran::create([
                    'user_id' => $user->id,
                    'qrcode_id' => $qrCode->id,
                ]);
            }
        }
        // Generate QR Code gambar
        $qrCodeImage =  QrCode::size(200)
                        ->generate($qrCode->code);

        // Return QR Code ke view
        return view('qrcode.show', [
            'qrCodeImage' => $qrCodeImage,
            'code' => $qrCode->code,
        ]);
    }

    public function qrCodeScanner(){
        return view('qrcode.scanner');
    }

    public function validasiQrCode(Request $request){
        $request->validate([
            'code' => 'required',
        ]);
    
        // Validasi waktu absensi
        $currentHour = now()->hour;
        if ($currentHour < 7 || $currentHour >= 17) {
            return redirect()->route('qrcode.scanner')->with('error', 'Absensi hanya diperbolehkan antara pukul 07:00 hingga 17:00');
        }
    
        // Validasi QR Code
        $qrcode = Qrcodes::where('code', $request->code)->first();
        if ($qrcode && $qrcode->valid_date != now()->toDateString()) {
            return redirect()->route('qrcode.scanner')->with('error', 'QR Code tidak valid');
        }

    
        // Cek kehadiran
        $kehadiran = Kehadiran::where('qrcode_id', $qrcode->id)->where('user_id', Auth::user()->id)->first();
        if ($kehadiran) {
            return redirect()->route('beranda')->with('error', 'Kehadiran sudah tercatat');
        }
        
        // Simpan data kehadiran
        if ($qrcode) {
            Kehadiran::create([
                'qrcode_id' => $qrcode->id,
                'user_id' => auth()->user()->id,
                'status' => 'hadir',
            ]);
            return redirect()->route('beranda')->with('success', 'Kehadiran berhasil ditambahkan');
        }
    
        return redirect()->route('qrcode.scanner')->with('error', 'QR Code tidak valid');
    }
    
}
