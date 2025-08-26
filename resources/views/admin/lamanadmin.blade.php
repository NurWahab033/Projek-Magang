<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - PT. CIPTA NIRMALA</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative bg-gradient-to-br from-blue-100 to-purple-200 min-h-screen flex flex-col items-center justify-start pt-10 font-sans">

  <!-- Background image -->
  <div class="absolute inset-0 bg-cover bg-center opacity-20 z-0"
       style="background-image: url('/images/cipta nirmala.png');">
  </div>

  <!-- Header -->
  <div class="relative z-10 bg-white rounded-xl shadow p-4 mb-6 w-[90%] max-w-4xl flex items-center justify-between">
    <!-- Kiri: Logo dan Judul -->
    <div class="flex items-center gap-4">
      <img src="/images/cipta nirmala.png" alt="Logo" class="h-20 w-auto">
      <h1 class="text-3xl font-bold text-black">PT. CIPTA NIRMALA</h1>
    </div>
    <!-- Kanan: Logout -->
    <button onclick="handleLogout()" class="text-sm text-red-600 border border-red-400 px-3 py-1 rounded hover:bg-red-100 transition">
      Logout
    </button>
  </div>

  <!-- Main Admin Features -->
  <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-6 w-[90%] max-w-4xl">

    <!-- Verifikasi Peserta -->
    <a href="/verifikasi" class="block">
      <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition duration-300 flex justify-between items-center">
        <h2 class="text-lg font-semibold">Verifikasi Peserta Magang</h2>
        <img src="/images/vpm.png" alt="Verifikasi" class="h-16 opacity-20">
      </div>
    </a>

    <!-- Monitoring Peserta -->
    <a href="/monitoring" class="block">
      <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition duration-300 flex justify-between items-center">
        <h2 class="text-lg font-semibold">Monitoring Peserta Magang</h2>
        <img src="/images/mpm.png" alt="Monitoring" class="h-16 opacity-20">
      </div>
    </a>

    <!-- Detail Peserta -->
    <a href="/detail" class="block md:col-span-2">
      <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition duration-300 flex justify-between items-center">
        <h2 class="text-lg font-semibold">Pendaftaran Akun Peserta Dan PIC</h2>
        <img src="/images/dpm.png" alt="Detail" class="h-16 opacity-20">
      </div>
    </a>

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
