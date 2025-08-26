<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-purple-100 to-blue-200 min-h-screen flex items-center justify-center">

  <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
    <h1 class="text-2xl font-bold text-center text-purple-700 mb-6">Login</h1>
    <!-- Logo di bawah tombol login -->
      <div class="mt-6 flex justify-center">
        <img src="/images/cipta nirmala.png" alt="Logo" class="h-16 w-auto" style="height: 100px">
      </div>

    @if(session('success'))
      <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

        <form action="/login" method="POST" class="space-y-4">
          @csrf

          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-purple-400" required="">
          </div>

          <button type="submit" class="w-full bg-purple-600 text-white font-semibold py-2 rounded hover:bg-purple-700 transition duration-300">
            Login
          </button>
        </form>

        <p class="text-sm text-center text-gray-600 mt-4">
        Belum punya akun?
        <a href="/register" class="text-purple-600 font-semibold hover:underline">Register</a>
      </p>
  </div>

</body>
</html>
