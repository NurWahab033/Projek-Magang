<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cipta Nirmala Internship System - Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="/images/cipta nirmala.png" type="image/png">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 via-blue-50 to-purple-100">

  <div class="bg-white/80 backdrop-blur-xl shadow-2xl rounded-2xl overflow-hidden flex w-full max-w-5xl border border-gray-200">
    
    <!-- Bagian kiri -->
    <div class="bg-gradient-to-br from-indigo-600 via-blue-600 to-purple-700 text-white flex flex-col items-center justify-center p-10 w-1/2 relative">
      <!-- Tambahan dekorasi bulatan -->
      <div class="absolute top-6 left-6 w-10 h-10 bg-yellow-400 rounded-full opacity-80 animate-bounce"></div>
      <div class="absolute bottom-10 right-10 w-14 h-14 bg-pink-400 rounded-full opacity-70 animate-pulse"></div>

      <img src="/images/iv.png" alt="Ilustrasi" class="mb-6 w-48 h-48 object-contain drop-shadow-lg">
      <h2 class="text-2xl font-bold mb-3 text-center">Cipta Nirmala Internship Monitoring</h2>
      <p class="text-center text-sm leading-relaxed max-w-sm">
        Sistem magang berbasis web untuk memantau kehadiran, aktivitas, dan laporan peserta magang 
        dengan lebih mudah dan efisien.
      </p>
    </div>

    <!-- Bagian kanan -->
    <div class="flex-1 p-10 flex flex-col justify-center">
      <div class="flex items-center justify-center mb-6">
        <img src="/images/cipta nirmala.png" alt="Logo" class="h-20 w-auto drop-shadow-md">
      </div>

      <h1 class="text-2xl font-bold text-gray-800 mb-2 text-center">Selamat Datang</h1>
      <p class="text-gray-600 text-center mb-6">Silakan login untuk melanjutkan ke sistem magang.</p>

      <form action="/login" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="email" placeholder="Email" required 
               class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-400 hover:border-indigo-400 transition">

        <input type="password" name="password" placeholder="Password" required 
               class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-400 hover:border-indigo-400 transition">

        <button type="submit" 
                class="w-full bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 text-white font-semibold py-3 rounded-xl shadow-lg hover:from-indigo-700 hover:via-blue-700 hover:to-purple-700 transition duration-300 transform hover:scale-[1.02]">
          Login
        </button>
      </form>

      <p class="text-sm text-center text-gray-600 mt-4">
        Belum punya akun?
        <a href="/register" class="text-indigo-600 font-semibold hover:underline">Daftar Sekarang</a>
      </p>

      <!-- Footer -->
      <p class="text-xs text-center text-gray-400 mt-6">
        © 2025 Cipta Nirmala - Internship Monitoring System
      </p>
    </div>
  </div>

</body>
</html>
