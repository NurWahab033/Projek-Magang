<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pendaftaran Magang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-200 min-h-screen flex items-center justify-center">

  <!-- Konten form -->
  <div class="relative z-10 bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold text-center text-purple-700 mb-6">Form Pendaftaran Magang</h1>

    <form action="/register" method="POST" class="space-y-4">

      @csrf

      <!-- Username -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required>
      </div>

      <!-- Gmail -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="gmail" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required>
      </div>

      <!-- Password -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <div class="relative">
          <input type="password" name="password" id="password" class="w-full border border-gray-300 p-2 rounded pr-10 focus:outline-none focus:ring-2 focus:ring-purple-400" required>

          <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword('password', 'eyeOpen1', 'eyeClosed1')">
            <svg id="eyeOpen1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg id="eyeClosed1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hidden" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.944-9.543-7a9.973 9.973 0 013.058-4.362M15 12a3 3 0 00-4.243-2.828M3 3l18 18" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Repeat Password -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Ulangi Password</label>
        <div class="relative">
          <input type="password" name="password_confirmation" id="passwordConfirm" class="w-full border border-gray-300 p-2 rounded pr-10 focus:outline-none focus:ring-2 focus:ring-purple-400" required>

          <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword('passwordConfirm', 'eyeOpen2', 'eyeClosed2')">
            <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <svg id="eyeClosed2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hidden" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.944-9.543-7a9.973 9.973 0 013.058-4.362M15 12a3 3 0 00-4.243-2.828M3 3l18 18" />
            </svg>
          </div>
        </div>
      </div>

      <!-- Afiliate -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Sekolah / Universitas</label>
        <input type="text" name="nama_institusi" value="{{ old('nama_institusi') }}" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-400">
      </div>

      <!-- Tombol Daftar -->
      <button type="submit" class="w-full bg-purple-600 text-white font-semibold py-2 rounded hover:bg-purple-700 transition duration-300">
        Daftar
      </button>

      <!-- Link ke halaman login -->
      <p class="text-sm text-center text-gray-600 mt-4">
        Sudah punya akun?
        <a href="/login" class="text-purple-600 font-semibold hover:underline">Login</a>
      </p>
    </form>
  </div>

  <!-- Toggle password script -->
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
