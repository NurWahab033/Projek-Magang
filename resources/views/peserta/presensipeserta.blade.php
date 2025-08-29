<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Presensi Peserta - PT Cipta Nirmala</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-blue-100 to-purple-100 min-h-screen font-sans">

  <!-- Header -->
  <header class="flex justify-between items-center px-6 py-4 bg-white shadow rounded-b-xl">
    <div class="flex items-center gap-3">
      <img src="images/cipta nirmala.png" alt="Logo PT Cipta Nirmala" class="w-12 h-12">
      <div>
        <h1 class="text-lg font-bold text-gray-700">Presensi Peserta</h1>
        <p class="text-blue-700 font-semibold">PT. CIPTA NIRMALA</p>
      </div>
    </div>
    <!-- Tombol Kembali (ungu soft) -->
    <button type="button" 
  onclick="window.history.back()" 
  class="bg-blue-300 hover:bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
  Kembali
</button>
  </header>

  <!-- Tab Navigation -->
  <div class="flex justify-center gap-8 mt-6">
    <button id="tabCheckIn" onclick="switchTab('checkin')" class="tab-btn font-medium text-gray-600 border-b-2 border-transparent pb-1 hover:text-purple-500">Check In</button>
    <button id="tabCheckOut" onclick="switchTab('checkout')" class="tab-btn font-medium text-gray-600 border-b-2 border-transparent pb-1 hover:text-purple-500">Check Out</button>
  </div>

  <!-- Main Container -->
  <main class="max-w-4xl mx-auto bg-white shadow-md rounded-2xl p-6 mt-6">

    <!-- Form Check In -->
    <div id="checkin" class="form-section">
      <form id="formCheckIn" onsubmit="event.preventDefault(); submitPresensi('Check In');" class="space-y-6 relative">
        <h2 class="text-xl font-semibold text-center text-gray-700">Form Check In</h2>
        
        <!-- Gambar ilustrasi absolute di kiri card -->
        <div class="absolute left-6 top-1 hidden md:block">
          <img src="images/iv3.png" alt="Ilustrasi Presensi" class="w-48 h-48 object-contain">
        </div>

        <!-- Isi form tetap center di bawah judul -->
        <div class="flex flex-col items-center space-y-4">
          <div class="text-center">
            <label class="block font-medium text-gray-600">Tanggal</label>
            <p id="tanggalCheckIn" class="text-gray-800"></p>
          </div>

          <div class="text-center">
            <label class="block font-medium text-gray-600">Status Kehadiran</label>
            <div class="flex justify-center gap-6 mt-2">
              <label class="flex items-center gap-1">
                <input type="radio" name="statusIn" value="Hadir" class="accent-purple-500"> Hadir
              </label>
              <label class="flex items-center gap-1">
                <input type="radio" name="statusIn" value="Izin" class="accent-purple-500"> Izin
              </label>
              <label class="flex items-center gap-1">
                <input type="radio" name="statusIn" value="Tidak Hadir" class="accent-purple-500"> Tidak Hadir
              </label>
            </div>
          </div>
        </div>

        <!-- Alasan -->
        <div id="alasanInField" class="hidden">
          <label class="font-medium text-gray-600">Alasan</label>
          <input type="text" id="alasanInInput" placeholder="Tulis alasan..." class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-purple-200">
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="px-6 py-2 bg-blue-300 hover:bg-blue-500 text-white font-semibold rounded-lg shadow-md block mx-auto">
          Submit
        </button>
      </form>
    </div>

    <!-- Form Check Out -->
    <div id="checkout" class="form-section hidden">
      <form id="formCheckOut" onsubmit="event.preventDefault(); submitPresensi('Check Out');" class="space-y-6 relative">
        <h2 class="text-xl font-semibold text-center text-gray-700">Form Check Out</h2>
        
        <!-- Gambar ilustrasi absolute di kiri card -->
        <div class="absolute left-6 top-1 hidden md:block">
          <img src="images/iv3.png" alt="Ilustrasi Presensi" class="w-48 h-48 object-contain">
        </div>

        <!-- Isi form tetap center di bawah judul -->
        <div class="flex flex-col items-center space-y-4">
          <div class="text-center">
            <label class="block font-medium text-gray-600">Tanggal</label>
            <p id="tanggalCheckOut" class="text-gray-800"></p>
          </div>

          <div class="text-center">
            <label class="block font-medium text-gray-600">Status Kehadiran</label>
            <div class="flex justify-center gap-6 mt-2">
              <label class="flex items-center gap-1">
                <input type="radio" name="statusOut" value="Hadir" class="accent-purple-500"> Hadir
              </label>
              <label class="flex items-center gap-1">
                <input type="radio" name="statusOut" value="Izin" class="accent-purple-500"> Izin
              </label>
              <label class="flex items-center gap-1">
                <input type="radio" name="statusOut" value="Tidak Hadir" class="accent-purple-500"> Tidak Hadir
              </label>
            </div>
          </div>
        </div>

        <!-- Alasan -->
        <div id="alasanOutField" class="hidden">
          <label class="font-medium text-gray-600">Alasan</label>
          <input type="text" id="alasanOutInput" placeholder="Tulis alasan..." class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-purple-200">
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="px-6 py-2 bg-blue-300 hover:bg-blue-500 text-white font-semibold rounded-lg shadow-md block mx-auto">
          Submit
        </button>
      </form>
    </div>

    <!-- Riwayat Presensi -->
    <h2 class="text-lg font-semibold text-gray-700 mt-8 mb-4">Riwayat Presensi</h2>
    <div class="overflow-x-auto">
      <table class="w-full border border-gray-200 rounded-lg overflow-hidden text-sm">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="px-4 py-2 text-left">No</th>
            <th class="px-4 py-2 text-left">Tanggal</th>
            <th class="px-4 py-2 text-left">Jam</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-left">Keterangan</th>
            <th class="px-4 py-2 text-left">Alasan</th>
          </tr>
        </thead>
        <tbody id="tabelPresensi" class="divide-y divide-gray-200"></tbody>
      </table>
    </div>
  </main>

  <script src="js/script.js"></script>

</body>
</html>
