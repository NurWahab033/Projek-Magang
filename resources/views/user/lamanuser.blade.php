<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>User - PT. CIPTA NIRMALA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Animasi masuk */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-in-up { animation: fadeInUp 0.7s ease-out forwards; }

    /* Animasi background bulat */
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-15px); }
    }
    .float-anim { animation: float 6s ease-in-out infinite; }

    /* Animasi gambar mengambang */
    @keyframes imgFloat {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-12px); }
    }
  .img-float {
    animation: imgFloat 4s ease-in-out infinite;
  }
  </style>
</head>
<body class="bg-white min-h-screen flex flex-col font-sans relative overflow-hidden">

  <!-- Background dekoratif -->
  <div class="absolute top-10 left-10 w-32 h-32 bg-indigo-100 rounded-full float-anim"></div>
  <div class="absolute bottom-20 right-20 w-40 h-40 bg-purple-100 rounded-full float-anim" style="animation-delay:2s"></div>
  <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-pink-100 rounded-full float-anim" style="animation-delay:4s"></div>

  <!-- Header -->
  <header class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-md relative z-10">
    <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-3">
      <!-- Nama perusahaan agak ke kiri -->
      <span class="text-lg md:text-xl font-bold pl-4">PT. CIPTA NIRMALA</span>
      <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
      <button onclick="handleLogout()" 
        class="bg-white/90 hover:bg-white text-indigo-700 font-medium px-4 py-1.5 rounded-lg shadow transition">
        Logout
      </button>
    </div>
  </header>

  <!-- Konten -->
  <main class="flex-1 flex flex-col items-center justify-center px-4 py-12 relative z-10">
  
    <!-- Gambar sapaan -->
    <div class="w-65 h-65 mb-8 fade-in-up">
      <img src="/images/img1.png" alt="Sapaan" 
          class="w-full h-full object-contain img-float">
    </div>


    <!-- Sapaan -->
    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-10 fade-in-up">Portal Pendaftaran Magang</h2>

    <!-- Kartu -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl">
      
      <!-- Card 1 -->
      <a href="/formpendaftaran" class="group block fade-in-up">
        <div class="bg-white border border-gray-200 shadow-md rounded-2xl p-6 hover:shadow-2xl hover:-translate-y-1 transition duration-300 flex justify-between items-center">
          <h3 class="text-lg md:text-xl font-semibold text-gray-800 group-hover:text-indigo-600">
            Form Pendaftaran
          </h3>
          <img src="/images/dpm.png" alt="Form" class="h-14 opacity-40 group-hover:opacity-80 transition">
        </div>
      </a>

      <!-- Card 2 -->
      <a href="/informasi" class="group block fade-in-up">
        <div class="bg-white border border-gray-200 shadow-md rounded-2xl p-6 hover:shadow-2xl hover:-translate-y-1 transition duration-300 flex justify-between items-center">
          <h3 class="text-lg md:text-xl font-semibold text-gray-800 group-hover:text-indigo-600">
            Informasi Pendaftaran
          </h3>
          <img src="/images/mpm.png" alt="Informasi" class="h-14 opacity-40 group-hover:opacity-80 transition">
        </div>
      </a>

    </div>
  </main>

  <!-- Script logout -->
  <script>
    function handleLogout() {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan keluar dari sesi ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#4f46e5',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('logoutForm').submit();
        }
      })
    }
  </script>

  <!-- Notifikasi -->
  @if(session('success'))
  <script>
  Swal.fire({
      icon: 'success',
      title: '{{ session('success') }}',
      showConfirmButton: false,
      timer: 2000
  });
  </script>
  @endif

  @if(session('alert'))
  <script>
  Swal.fire({
      icon: 'error',
      title: '{{ session('alert') }}',
      showConfirmButton: false,
      timer: 2500
  });
  </script>
  @endif

</body>
</html>
