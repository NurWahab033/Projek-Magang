<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - PT. CIPTA NIRMALA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    /* Percepat durasi default animate.css */
    :root {
      --animate-duration: 0.6s; 
      --animate-delay: 0.3s;
    }

    /* Floating animation lebih cepat */
    @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-6px); }
      100% { transform: translateY(0px); }
    }
    .float {
      animation: float 2.5s ease-in-out infinite;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 min-h-screen flex flex-col text-gray-800">

  <!-- Main Content -->
  <main class="flex-1 p-8">

    <!-- Judul Dashboard -->
    <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent animate__animated animate__fadeInDown mb-10">
      🚀 Dashboard Admin
    </h1>

    <!-- Pengumuman -->
    <div class="w-full mb-10">
      <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 p-5 rounded-xl shadow-md animate__animated animate__zoomIn">
        <p class="font-semibold text-lg">📢 Selamat Datang, Admin SDM:</p>
        <p class="text-sm mt-1">Terima kasih telah mendukung kelancaran program magang. Semoga aktivitas hari ini berjalan lancar dan penuh manfaat.</p>
      </div>
    </div>

    <!-- Dashboard Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full mb-10">
    <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col items-center">
      <h3 class="text-md font-semibold text-gray-500">Total Siswa</h3>
      <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalSiswa }}</p>
    </div>
    <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col items-center">
      <h3 class="text-md font-semibold text-gray-500">Total Mahasiswa</h3>
      <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalMahasiswa }}</p>
    </div>
    <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col items-center">
      <h3 class="text-md font-semibold text-gray-500">Total PIC</h3>
      <p class="text-4xl font-bold text-pink-600 mt-2">{{ $totalPic }}</p>
    </div>
  </div>

    <!-- Main Admin Features -->
    <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 w-full max-w-6xl mx-auto">

      <!-- Verifikasi Peserta -->
      <a href="/verifikasi" class="block">
        <div class="bg-white shadow-xl rounded-2xl p-8 hover:scale-105 hover:shadow-blue-300/60 transition-all duration-500 flex justify-between items-center min-h-[160px] animate__animated animate__fadeInUp">
          <h2 class="text-xl font-semibold text-gray-700">Verifikasi Peserta Magang</h2>
          <img src="/images/vpm.png" alt="Verifikasi" class="h-20 opacity-40 float">
        </div>
      </a>

      <!-- Monitoring Peserta -->
      <a href="/monitoring" class="block">
        <div class="bg-white shadow-xl rounded-2xl p-8 hover:scale-105 hover:shadow-purple-300/60 transition-all duration-500 flex justify-between items-center min-h-[160px] animate__animated animate__fadeInUp animate__delay-0.3s">
          <h2 class="text-xl font-semibold text-gray-700">Penempatan Unit & Monitoring Peserta</h2>
          <img src="/images/mpm.png" alt="Monitoring" class="h-20 opacity-40 float">
        </div>
      </a>

      <!-- Pendaftaran Akun -->
      <a href="/detailakun" class="block">
        <div class="bg-white shadow-xl rounded-2xl p-8 hover:scale-105 hover:shadow-pink-300/60 transition-all duration-500 flex justify-between items-center min-h-[160px] animate__animated animate__fadeInUp animate__delay-0.6s">
          <h2 class="text-xl font-semibold text-gray-700">Pendaftaran Akun Peserta & PIC</h2>
          <img src="/images/dpm.png" alt="Detail" class="h-20 opacity-40 float">
        </div>
      </a>

      <!-- Sertifikasi -->
      <a href="/sertifikasi" class="block">
        <div class="bg-white shadow-xl rounded-2xl p-8 hover:scale-105 hover:shadow-green-300/60 transition-all duration-500 flex justify-between items-center min-h-[160px] animate__animated animate__fadeInUp animate__delay-0.9s">
          <h2 class="text-xl font-semibold text-gray-700">Sertifikasi Peserta Magang</h2>
          <img src="https://cdn-icons-png.flaticon.com/512/3135/3135763.png" alt="Sertifikasi" class="h-20 opacity-40 float">
        </div>
      </a>

    </div>
  </main>

  <!-- Logout Button (kanan bawah) -->
  <div class="fixed bottom-6 right-6">
    <button onclick="handleLogout()" class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-purple-400/50 hover:scale-105 transition-all duration-500">
      Logout
    </button>
  </div>

  <!-- Script logout -->
  <script>
    function handleLogout() {
      if (confirm("Anda ingin logout?")) {
        window.location.href = "/login";
      }
    }
  </script>

</body>
</html>
