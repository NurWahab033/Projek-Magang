<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Peserta - PT. CIPTA NIRMALA</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white font-sans">
  
  <!-- Header -->
<header class="bg-gradient-to-r from-cyan-200 via-cyan-100 to-white shadow-md">
  <div class="max-w-7xl mx-auto flex items-center justify-between p-4">
    
    <!-- Logo + Nama Perusahaan -->
    <div class="flex items-center space-x-4">
      <img src="/images/cipta nirmala.png" alt="Logo" class="w-14 h-14 object-contain rounded-lg shadow-sm">
      <h1 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-wide">PT. CIPTA NIRMALA</h1>
    </div>

    <!-- User Icon & Dropdown -->
    <div class="relative flex items-center space-x-3">
      <!-- Nama User -->
      <span class="font-medium text-gray-700 text-base">Muhammad Nur Wahab</span>

      <!-- Tombol Foto Profil -->
      <button id="userMenuButton" class="w-11 h-11 flex items-center justify-center rounded-full overflow-hidden border-2 border-cyan-300 hover:scale-105 transition-transform duration-200">
        <img src="/images/default profile.png" alt="User" class="w-full h-full object-cover">
      </button>

      <!-- Dropdown -->
      <div id="userMenu" class="hidden absolute right-0 top-14 w-44 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
        <button id="editProfileBtn" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Edit Foto Profile</button>
        <button onclick="handleLogout()" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>
      </div>
    </div>

  </div>
</header>


  <!-- Konten Card -->
  <main class="mt-12 px-6">
  <div class="grid gap-6 max-w-3xl mx-auto">

    <!-- Card Daftar Hadir -->
    <a href="/Presensi-Peserta" class="flex items-center p-6 bg-white rounded-xl shadow-md border hover:shadow-lg transition cursor-pointer">
      <div class="w-14 h-14 flex items-center justify-center bg-cyan-100 rounded-full text-cyan-600">
        <!-- Icon User -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24">
          <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"/>
        </svg>
      </div>
      <div class="ml-5 flex-1">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Hadir</h2>
        <p class="text-gray-500 text-sm">Isi daftar hadir harian Anda di sini</p>
      </div>
    </a>

    <!-- Card Laporan Harian -->
    <a href="/Laporan-Harian" class="flex items-center p-6 bg-white rounded-xl shadow-md border hover:shadow-lg transition cursor-pointer">
      <div class="w-14 h-14 flex items-center justify-center bg-green-100 rounded-full text-green-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24">
          <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zM13 9V3.5L18.5 9H13z"/>
        </svg>
      </div>
      <div class="ml-5 flex-1">
        <h2 class="text-xl font-semibold text-gray-800">Laporan Harian</h2>
        <p class="text-gray-500 text-sm">Kumpulkan laporan kegiatan setiap hari</p>
      </div>
    </a>

    <!-- Card Laporan Akhir -->
    <a href="/Laporan-Akhir" class="flex items-center p-6 bg-white rounded-xl shadow-md border hover:shadow-lg transition cursor-pointer">
      <div class="w-14 h-14 flex items-center justify-center bg-yellow-100 rounded-full text-yellow-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24">
          <path d="M20.4 14.6l-1.2-1.2c-.4-.4-1-.4-1.4 0L8.7 22.6c-.2.2-.3.4-.3.7v.7h.7c.3 0 .5-.1.7-.3l9.1-9.1c.4-.4.4-1 0-1.4zm2.6-10.6c-.5-.5-1.3-.5-1.8 0l-1.6 1.6 1.8 1.8 1.6-1.6c.5-.5.5-1.3 0-1.8l-.4-.4c0-.1 0-.1 0 0zm-3.5 3.5l-1.8-1.8L5 18.4V21h2.6L19.5 7.5z"/>
        </svg>
      </div>
      <div class="ml-5 flex-1">
        <h2 class="text-xl font-semibold text-gray-800">Laporan Akhir</h2>
        <p class="text-gray-500 text-sm">Kumpulkan laporan akhir sebelum tenggat</p>
      </div>
    </a>

    <!-- Card Cetak Sertifikat -->
    <a href="/sertifikat" class="flex items-center p-6 bg-white rounded-xl shadow-md border hover:shadow-lg transition cursor-pointer">
      <div class="w-14 h-14 flex items-center justify-center bg-purple-100 rounded-full text-purple-600">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-8 h-8" viewBox="0 0 24 24">
          <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm-2 10h-6v-2h6v2zm0-4h-6V7h6v2z"/>
        </svg>
      </div>
      <div class="ml-5 flex-1">
        <h2 class="text-xl font-semibold text-gray-800">Cetak Sertifikat</h2>
        <p class="text-gray-500 text-sm">Cetak sertifikat magang Anda di sini</p>
      </div>
    </a>


  </div>
</main>


  <!-- Modal Edit Profile -->
<div id="editProfileModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
    <!-- Tombol X -->
    <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>

    <!-- Judul -->
    <h2 class="text-xl font-bold mb-6 text-center">Edit Profil</h2>
    
    <!-- Foto Profil -->
    <div class="flex justify-center mb-6 relative">
      <img id="profileImage" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" class="w-28 h-28 rounded-full border object-cover">
      <label for="fileUpload" class="absolute bottom-1 right-[38%] bg-white border border-gray-300 rounded-full p-2 cursor-pointer shadow">
        <img src="images/cp.png" class="w-5 h-5">
      </label>
      <input type="file" id="fileUpload" accept="image/*" class="hidden">
    </div>

    <!-- Info -->
    <div class="bg-gray-100 rounded-lg p-4 space-y-3 text-sm">
      <p><strong>Nama Lengkap:</strong> Muhammad Nur Wahab</p>
      <p><strong>Alamat:</strong> Jl. Panglima Sudirman Gang 6 no 29 Gresik</p>
      <p><strong>No Telp:</strong> 08885280789</p>
      <p><strong>Email:</strong> Wahab@gmail.com</p>
      <p><strong>Nama Institusi:</strong> Universitas Muhammadiyah Gresik</p>
      <p><strong>Jurusan:</strong> Teknik Informatika</p>
    </div>

    <!-- Tombol Konfirmasi -->
    <div class="mt-6 flex justify-center">
      <button id="confirmBtn" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">Konfirmasi</button>
    </div>
  </div>
</div>

  <!-- Script -->
  <script>
  const userMenuButton = document.getElementById("userMenuButton");
  const userMenu = document.getElementById("userMenu");
  const editProfileBtn = document.getElementById("editProfileBtn");
  const editProfileModal = document.getElementById("editProfileModal");
  const closeModal = document.getElementById("closeModal");
  const profileImage = document.getElementById('profileImage');
  const fileUpload = document.getElementById('fileUpload');
  const confirmBtn = document.getElementById('confirmBtn');

  let tempImage = profileImage.src;

  function handleLogout() {
      if (confirm("Anda ingin logout?")) {
        window.location.href = "/login";
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

  // Preview foto (sementara)
  fileUpload.addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function(){
      tempImage = reader.result;
      profileImage.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  });

  // Konfirmasi perubahan foto
  confirmBtn.addEventListener("click", () => {
    alert("Foto profil berhasil diperbarui");
    editProfileModal.classList.add("hidden");
  });
</script>

</body>
</html>
