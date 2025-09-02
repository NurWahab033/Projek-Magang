<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Peserta - PT. CIPTA NIRMALA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    /* Animasi fade custom */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.4s ease-out; }

    /* Floating image */
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-8px); }
    }
    .float { animation: float 4s ease-in-out infinite; }

    /* Reusable Card Menu */
    .card-menu {
      display: flex;
      align-items: center;
      padding: 1.5rem;
      background: white;
      border-radius: 1rem;
      border: 1px solid #e5e7eb;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      transition: all 0.3s ease;
    }
    .card-menu:hover {
      transform: translateY(-6px) scale(1.02);
      box-shadow: 0 10px 20px rgba(0,0,0,0.12);
      background: linear-gradient(135deg, #fdfdfd, #f0faff);
    }
    .icon-wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 3.5rem;
      height: 3.5rem;
      border-radius: 9999px;
      flex-shrink: 0;
    }
    .title { font-size: 1.125rem; font-weight: 600; color: #1f2937; }
    .subtitle { font-size: 0.875rem; color: #6b7280; }
  </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-blue-50 to-cyan-50 font-sans min-h-screen">

  <!-- Header -->
<header class="bg-white/70 backdrop-blur-lg shadow-md sticky top-0 z-40 animate__animated animate__fadeInDown">
  <div class="max-w-7xl mx-auto flex items-center justify-between p-4">

    <!-- Logo + Nama Perusahaan -->
    <div class="flex items-center space-x-4">
      <img src="/images/cipta nirmala.png" alt="Logo" class="w-14 h-14 object-contain rounded-lg shadow-sm animate__animated animate__zoomIn">
      <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-cyan-600 via-blue-600 to-indigo-600 bg-clip-text text-transparent tracking-wide">
        PT. CIPTA NIRMALA
      </h1>
    </div>

    <!-- User Icon & Dropdown -->
    <div class="relative flex items-center space-x-3 animate__animated animate__fadeInRight">
      <!-- Nama User -->
      <span class="font-medium text-gray-700 text-base">
        {{ Auth::user()->formulirPendaftaran->nama_lengkap ?? Auth::user()->username }}
      </span>

      <!-- Tombol Foto Profil -->
      <button id="userMenuButton" type="button"
        class="w-11 h-11 flex items-center justify-center rounded-full overflow-hidden border-2 border-cyan-400 hover:scale-110 transition-transform duration-200 shadow-md">
        <img id="headerProfileImage"
            src="{{ Auth::user()->detailuser && Auth::user()->detailuser->foto_profil
                      ? asset('storage/' . Auth::user()->detailuser->foto_profil)
                      : '/images/default profile.png' }}"
            alt="User" class="w-full h-full object-cover">
      </button>

      <!-- Dropdown -->
      <div id="userMenu" class="hidden absolute right-0 top-14 w-48 bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden animate-fade-in">
        <button id="editProfileBtn" type="button" class="block w-full text-left px-4 py-3 text-gray-700 hover:bg-cyan-50 transition">Edit Foto Profil</button>
        <button onclick="handleLogout()" type="button" class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 transition">
          Logout
        </button>
      </div>
    </div>
  </div>
</header>

<!-- Form logout tersembunyi -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>

  <!-- Konten Card -->
<main class="mt-20 px-6">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center md:items-start gap-12">

    <!-- Gambar Kiri -->
    <div class="flex-shrink-0 w-full md:w-2/5 flex justify-center">
      <img src="/images/iv2.png" alt="Ilustrasi Peserta" class="max-w-sm md:max-w-md float animate__animated animate__fadeInLeft">
    </div>

    <!-- Card Kanan -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full md:w-3/5">

    <a href="{{ route('checkclock.index') }}" class="card-menu group animate__animated animate__fadeInUp animate__faster">
        <div class="icon-wrapper bg-cyan-100 text-cyan-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24">
                <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
            </svg>
        </div>
        <div class="ml-5 flex-1">
            <h2 class="title">Daftar Hadir</h2>
            <p class="subtitle">Isi daftar hadir harian Anda di sini</p>
        </div>
    </a>


      <a href="/laporan" class="card-menu group animate__animated animate__fadeInUp animate__delay-1s animate__faster">
        <div class="icon-wrapper bg-green-100 text-green-600">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24">
            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zM13 9V3.5L18.5 9H13z"/>
          </svg>
        </div>
        <div class="ml-5 flex-1">
          <h2 class="title">Laporan Harian</h2>
          <p class="subtitle">Kumpulkan laporan kegiatan setiap hari</p>
        </div>
      </a>

      <a href="/Laporan-Akhir" class="card-menu group animate__animated animate__fadeInUp animate__delay-2s animate__faster">
        <div class="icon-wrapper bg-yellow-100 text-yellow-600">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24">
            <path d="M20.4 14.6l-1.2-1.2c-.4-.4-1-.4-1.4 0L8.7 22.6c-.2.2-.3.4-.3.7v.7h.7c.3 0 .5-.1.7-.3l9.1-9.1c.4-.4.4-1 0-1.4zm2.6-10.6c-.5-.5-1.3-.5-1.8 0l-1.6 1.6 1.8 1.8 1.6-1.6c.5-.5.5-1.3 0-1.8l-.4-.4c0-.1 0-.1 0 0zm-3.5 3.5l-1.8-1.8L5 18.4V21h2.6L19.5 7.5z"/>
          </svg>
        </div>
        <div class="ml-5 flex-1">
          <h2 class="title">Laporan Akhir</h2>
          <p class="subtitle">Kumpulkan laporan akhir sebelum tenggat</p>
        </div>
      </a>

      <a href="/sertifikat" class="card-menu group animate__animated animate__fadeInUp animate__delay-3s animate__faster">
        <div class="icon-wrapper bg-purple-100 text-purple-600">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24">
            <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm-2 10h-6v-2h6v2zm0-4h-6V7h6v2z"/>
          </svg>
        </div>
        <div class="ml-5 flex-1">
          <h2 class="title">Cetak Sertifikat</h2>
          <p class="subtitle">Cetak sertifikat magang Anda di sini</p>
        </div>
      </a>

    </div>
  </div>
</main>

  <!-- Modal Edit Profile -->
<div id="editProfileModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative animate-fade-in">
    <button id="closeModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
    <h2 class="text-xl font-bold mb-6 text-center text-gray-800">Edit Profil</h2>

    <!-- Form Update -->
    <form id="updatePhotoForm" action="{{ route('updatePhoto') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="flex justify-center mb-6 relative">
        <img id="modalProfileImage"
            src="{{ Auth::user()->detailuser && Auth::user()->detailuser->foto_profil
                      ? asset('storage/' . Auth::user()->detailuser->foto_profil)
                      : 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png' }}"
            class="w-28 h-28 rounded-full border-4 border-cyan-300 shadow-md object-cover animate__animated animate__zoomIn">

        <label for="fileUpload"
              class="absolute bottom-1 right-[38%] bg-white border border-gray-300 rounded-full p-2 cursor-pointer shadow hover:bg-gray-50">
            <img src="{{ asset('/images/cp.png') }}" class="w-5 h-5">
        </label>

        <input type="file" id="fileUpload" name="foto_profil" accept="image/*" class="hidden">
      </div>

      <div class="bg-gray-50 rounded-lg p-4 text-sm shadow-inner">
        <div class="grid grid-cols-2 gap-y-2">
          <p><strong>Nama Lengkap</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->nama_lengkap ?? Auth::user()->username }}</p>

          <p><strong>Alamat</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->alamat ?? '-' }}</p>

          <p><strong>No.Telp</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->no_telp ?? '-' }}</p>

          <p><strong>Email</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->email ?? '-' }}</p>

          <p><strong>Nama Institusi</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->nama_institusi ?? '-' }}</p>

          <p><strong>Jurusan</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->jurusan ?? '-' }}</p>

          <p><strong>Tanggal Mulai</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->tanggal_mulai_magang ?? '-' }}</p>

          <p><strong>Tanggal Selesai</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->tanggal_selesai_magang ?? '-' }}</p>

          <p><strong>Grade</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->grade ?? '-' }}</p>

          <p><strong>Fakultas</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->fakultas ?? '-' }}</p>

          <p><strong>Jenjang</strong></p>
          <p>: {{ Auth::user()->formulirPendaftaran->jenjang ?? '-' }}</p>
        </div>
      </div>

      <div class="mt-6 flex justify-center">
        <button type="submit" class="bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-600 text-white px-8 py-2 rounded-lg shadow-md hover:scale-105 hover:shadow-lg transition">
          Konfirmasi
        </button>
      </div>
    </form>
  </div>
</div>

  <!-- Script -->
<script>
  const userMenuButton = document.getElementById("userMenuButton");
  const userMenu = document.getElementById("userMenu");
  const editProfileBtn = document.getElementById("editProfileBtn");
  const editProfileModal = document.getElementById("editProfileModal");
  const closeModal = document.getElementById("closeModal");
  const fileUpload = document.getElementById('fileUpload');
  const modalProfileImage = document.getElementById('modalProfileImage');

  function handleLogout() {
    if (confirm("Anda ingin logout?")) {
      document.getElementById("logout-form").submit();
    }
  }

  // Toggle dropdown menu
  userMenuButton.addEventListener("click", () => {
    userMenu.classList.toggle("hidden");
  });

  document.addEventListener("click", (event) => {
    if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
      userMenu.classList.add("hidden");
    }
  });

  // Open modal edit profile
  editProfileBtn.addEventListener("click", () => {
    editProfileModal.classList.remove("hidden");
    userMenu.classList.add("hidden");
  });

  // Close modal
  closeModal.addEventListener("click", () => {
    editProfileModal.classList.add("hidden");
  });

  // Klik di luar modal
  editProfileModal.addEventListener("click", (event) => {
    if (event.target === editProfileModal) {
      editProfileModal.classList.add("hidden");
    }
  });

  // Preview foto sebelum upload
  fileUpload.addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function(){
      modalProfileImage.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  });
</script>

    <!-- Footer -->
  <footer class="mt-16">
    <div class="max-w-7xl mx-auto py-4 text-center text-gray-500 text-sm animate__animated animate__fadeInUp">
      © 2025 PT. CIPTA NIRMALA. All rights reserved.
    </div>
  </footer>
</body>
</html>
