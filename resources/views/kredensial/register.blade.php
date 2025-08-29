<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cipta Nirmala Internship System - Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="/images/cipta nirmala.png" type="image/png">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100">

  <div class="bg-white/90 backdrop-blur-xl shadow-2xl rounded-2xl overflow-hidden flex w-full max-w-5xl border border-gray-200">
    
    <!-- Bagian kiri -->
    <div class="bg-gradient-to-br from-purple-600 to-blue-600 text-white flex flex-col items-center justify-center p-10 w-1/2 relative">
      <!-- Dekorasi bulatan -->
      <div class="absolute top-6 left-6 w-10 h-10 bg-yellow-400 rounded-full opacity-80 animate-bounce"></div>
      <div class="absolute bottom-10 right-10 w-14 h-14 bg-pink-400 rounded-full opacity-70 animate-pulse"></div>

      <img src="/images/iv.png" alt="Ilustrasi" class="mb-6 w-48 h-48 object-contain drop-shadow-lg">
      <h2 class="text-2xl font-bold mb-3 text-center">Bergabung dengan Cipta Nirmala</h2>
      <p class="text-center text-sm leading-relaxed max-w-sm">
        Daftarkan diri Anda untuk mengikuti program magang.  
        Pantau aktivitas, kehadiran, dan laporan Anda secara terintegrasi dalam satu sistem.
      </p>
    </div>

    <!-- Bagian kanan (Form Register) -->
    <div class="flex-1 p-10 flex flex-col justify-center">
      <div class="flex items-center justify-center mb-6">
        <img src="/images/cipta nirmala.png" alt="Logo" class="h-20 w-auto drop-shadow-md">
      </div>

      <h1 class="text-2xl font-bold text-gray-800 mb-2 text-center">Form Pendaftaran Magang</h1>
      <p class="text-gray-600 text-center mb-6">Silakan isi data dengan benar untuk membuat akun.</p>

      {{-- Notifikasi error --}}
      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      {{-- Notifikasi error custom --}}
      @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
          {{ session('error') }}
        </div>
      @endif

      {{-- Notifikasi sukses --}}
      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ url('/register') }}" method="POST" class="space-y-4">
        @csrf

        <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" 
               class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-400 hover:border-purple-400 transition" required>

        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" 
               class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-400 hover:border-purple-400 transition" required>

        <!-- Password -->
        <div class="relative">
          <input type="password" name="password" id="password" placeholder="Password"
                 class="w-full border border-gray-300 p-3 rounded-xl pr-10 focus:outline-none focus:ring-2 focus:ring-purple-400 hover:border-purple-400 transition" required>
          <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" 
               onclick="togglePassword('password', 'eyeOpen1', 'eyeClosed1')">
            <svg id="eyeOpen1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg id="eyeClosed1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.944-9.543-7a9.973 9.973 0 013.058-4.362M15 12a3 3 0 00-4.243-2.828M3 3l18 18" />
            </svg>
          </div>
        </div>

        <!-- Ulangi Password -->
        <div class="relative">
          <input type="password" name="password_confirmation" id="passwordConfirm" placeholder="Ulangi Password"
                 class="w-full border border-gray-300 p-3 rounded-xl pr-10 focus:outline-none focus:ring-2 focus:ring-purple-400 hover:border-purple-400 transition" required>
          <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" 
               onclick="togglePassword('passwordConfirm', 'eyeOpen2', 'eyeClosed2')">
            <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg id="eyeClosed2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.944-9.543-7a9.973 9.973 0 013.058-4.362M15 12a3 3 0 00-4.243-2.828M3 3l18 18" />
            </svg>
          </div>
        </div>

        <input type="text" name="nama_institusi" value="{{ old('nama_institusi') }}" placeholder="Sekolah / Universitas"
               class="w-full border border-gray-300 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-400 hover:border-purple-400 transition" required>

        <button type="submit" 
                class="w-full bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 text-white font-semibold py-3 rounded-xl shadow-lg hover:from-indigo-700 hover:via-blue-700 hover:to-purple-700 transition duration-300 transform hover:scale-[1.02]">
          Daftar
        </button>
      </form>

      <p class="text-sm text-center text-gray-600 mt-4">
        Sudah punya akun?
        <a href="/login" class="text-purple-600 font-semibold hover:underline">Login</a>
      </p>

      <!-- Footer -->
      <p class="text-xs text-center text-gray-400 mt-6">
        © 2025 Cipta Nirmala - Internship Monitoring System
      </p>
    </div>
  </div>

  <script>
    function togglePassword(inputId, eyeOpenId, eyeClosedId) {
      const input = document.getElementById(inputId);
      const eyeOpen = document.getElementById(eyeOpenId);
      const eyeClosed = document.getElementById(eyeClosedId);
      if (input.type === "password") {
        input.type = "text";
        eyeOpen.classList.add("hidden");
        eyeClosed.classList.remove("hidden");
      } else {
        input.type = "password";
        eyeOpen.classList.remove("hidden");
        eyeClosed.classList.add("hidden");
      }
    }
  </script>

</body>
</html>
