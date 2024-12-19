<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabel Kehadiran</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ str_replace('http://', 'https://', Vite::asset('resources/css/app.css')) }}">
  <script type="module" src="{{ str_replace('http://', 'https://', Vite::asset('resources/js/app.js')) }}"></script>
</head>
<body class="bg-[#F1F5FF] font-poppins">
   <nav class="py-7 pl-[0px] sm:pl-7 pr-[0px] md:pr-[30px] lg:pr-[111px] bg-[#010C4A] text-white flex flex-col min-[500px]:flex-row justify-between items-center">
    <div class="flex items-center">
      <img src="{{ asset('img/logo_pesawaran.png') }}" alt="">
      <div>
        <h1 class="font-poppins text-[35px] sm:text-[45px] font-semibold">SiAbsen</h1>
        <h2 class="font-poppins text-[20px] sm:text-[25px] font-light">Sistem Absensi Desa Baturaja</h2>
      </div>
    </div>
    <div class="flex flex-wrap justify-end gap-6 mt-4 min-[500px]:mt-0 text-[#010C4A]">
      @if (Auth::user()->role == 'admin')
      <h1 class="text-[16px] lg:text-[20px] font-semibold rounded-full px-5 py-2 bg-[#FFB524]"><a href="/admin">Admin</a></h1>
      @endif
      <h1 class="text-[16px] lg:text-[20px] font-semibold rounded-full px-5 py-2 bg-[#FFB524]"><a href="{{ route('beranda') }}">Beranda</a></h1>
      <h1 class="text-[16px] lg:text-[20px] font-semibold rounded-full px-5 py-2 bg-[#FFB524]"><a href="{{ route('logout') }}">Logout</a></h1>
    </div>
  </nav>

  <div class="px-[15px] md:px-[30px] lg:px-[66px] mt-[70px]">
    <h1 class="text-[25px] lg:text-[32px] font-semibold text-[#010C4A]">Selamat Datang, {{ Auth::user()->name }}!</h1>
    <div class="bg-[#010C4A]/10 mt-[30px] md:mt-[50px] lg:mt-[70px] py-9">
      <h1 class="font-semibold text-[20px] md:text-[25px] lg:text-[30px] text-center">Riwayat Kehadiran</h1>
      <table class="w-[90%] bg-[#010C4A] rounded-2xl ml-auto mr-auto mt-[20px] lg:mt-[40px]">
        <tr class="border border-white border-solid border-1">
            <th class="text-white py-3 text-[12px] md:text-[15px] lg:text-[20px] font-semibold">Tanggal</th>
            <th class="text-white py-3 text-[12px] md:text-[15px] lg:text-[20px] font-semibold">Status Kehadiran</th>
            <th class="text-white py-3 text-[12px] md:text-[15px] lg:text-[20px] font-semibold">Waktu Check-in</th>
        </tr>
         @if (!$kehadiran->isEmpty())
        @foreach ($kehadiran as $item)
        <tr class="border border-white border-solid border-1 text-center">
            <td class="py-2 text-[12px] md:text-[15px] lg:text-[20px] text-white/50 font-normal">{{$item->qrcode->valid_date}}</td>
            <td class="py-2 text-[12px] md:text-[15px] lg:text-[20px] text-white font-semibold">
                @if ($item->status == 'hadir')
                <h1 class="px-7 text-[12px] md:text-[15px] lg:text-[20px] py-2 rounded-xl bg-[#15F332] ml-auto mr-auto w-fit">Hadir</h1>
                @else
                <h1 class="px-7 text-[12px] md:text-[15px] lg:text-[20px] py-2 rounded-xl bg-[#FF0000] ml-auto mr-auto w-fit">Tidak Hadir</h1>
                @endif
            </td>
            @if ($item->status == 'hadir')
            <td class="py-2 text-[12px] md:text-[15px] lg:text-[20px] text-white/50 font-normal">{{$item->updated_at}}</td>
            @else
            <td class="py-2 text-[12px] md:text-[15px] lg:text-[20px] text-white/50 font-normal">-</td>
            @endif
        </tr>
        @endforeach
        @endif
      </table>
    </div>

    <h1 class="text-[12px] md:text-[15px] lg:text-[20px] text-white bg-[#FFB524] w-fit ml-auto mr-auto mt-[38px] px-6 py-2 rounded-2xl"><a href="{{route('qrcode.scanner')}}">Lakukan Absensi</a></h1>
    @if (auth()->user()->role == 'admin')
    <h1 class="text-[12px] md:text-[15px] lg:text-[20px] text-white bg-[#FFB524] w-fit ml-auto mr-auto mt-[38px] px-6 py-2 rounded-2xl"><a href="{{route('generate.qr.code')}}">Generate QR Code</a></h1>
    @endif
  </div>

  <footer class="bg-[#010C4A]">
    <h3 class="font-medium text-[15px] text-center text-white py-[60px] mt-[150px] sm:mt-[250px]">© 2024 Sistem Absensi Desa. Semua Hak Dilindungi.</h3>
  </footer>
</body>
</html>
