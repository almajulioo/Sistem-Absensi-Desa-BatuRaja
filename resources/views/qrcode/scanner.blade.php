<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scan QR Code</title>
  <script
  src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"
  integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ str_replace('http://', 'https://', Vite::asset('resources/css/app.css')) }}">
  <script type="module" src="{{ str_replace('http://', 'https://', Vite::asset('resources/js/app.js')) }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

  <main class="container mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold text-center mb-8">Scan QR Code</h1>
    <div class="bg-gray-800 p-6 rounded-lg shadow">
      <div id="qr-reader" class="rounded-lg shadow"></div>
      <div id="qr-result" class="mt-6 text-center text-gray-300">
        <p id="result-message" class="text-lg">Arahkan kamera ke QR Code untuk memulai.</p>
      </div>
    </div>
  </main>

  <footer class="bg-[#010C4A]">
    <h3 class="font-medium text-[15px] text-center text-white py-[60px] mt-[150px] sm:mt-[250px]">© 2024 Sistem Absensi Desa. Semua Hak Dilindungi.</h3>
  </footer>
  <script>
    // Ambil CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Inisialisasi QR Code Scanner
    const qrReader = new Html5Qrcode("qr-reader");

    qrReader.start(
      { facingMode: "environment" }, // Gunakan kamera belakang
      {
        fps: 10, // Frame per detik
        qrbox: { width: 500, height: 500 }, // Ukuran area QR Code
      },
      (decodedText, decodedResult) => {
        console.log("Scanned QR Code:", decodedText);
        document.getElementById("result-message").textContent = `QR Code ditemukan: ${decodedText}`;
        
        // Kirim data ke backend untuk validasi
        fetch('https://sistem-absensi-desa-baturaja.up.railway.app/qrcode-validasi', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
          },
          body: JSON.stringify({ code: decodedText }),
          credentials: 'same-origin',
        })
          .then((response) => {
            if (!response.ok) {
              throw new Error(`HTTP error! Status: ${response.status}`);
            }
            window.location.href = "/"
            return response.json();
          })
          .then((data) => {
            if (data.message) {
              document.getElementById("result-message").textContent = data.message;
            } else {
              document.getElementById("result-message").textContent = 'QR Code validasi berhasil.';
            }
          })
          .catch((error) => {
            console.error('Error:', error);
          });
      },
      (errorMessage) => {
      }
    ).catch((err) => {
    });
  </script>
</body>
</html>
