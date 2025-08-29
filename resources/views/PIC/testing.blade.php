<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Monitoring Peserta Magang - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/detailppic.css">
</head>

<body class="bg-gray-50 text-sm">
  <!-- Header -->
  <div class="header bg-white border-b shadow px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <img src="/images/cipta nirmala.png" alt="Logo" class="h-12 w-auto">
      <h1 class="text-xl font-bold text-gray-800">PT. CIPTA NIRMALA</h1>
    </div>
  </div>

  <!-- Konten Monitoring -->
  <div class="px-6 py-8 max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold text-purple-700 mb-6">Detail & Penilaian Peserta Magang</h2>

    <!-- Filter & Search -->
    <div class="flex flex-col md:flex-row items-center gap-3 mb-6">
      
      <input id="searchText" type="text" placeholder="Cari berdasarkan nama / sekolah / unit" class="border border-gray-300 px-3 py-2 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400 flex-1">
      <button onclick="cariPeserta()" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow font-medium">Cari</button>
    </div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
  <div class="overflow-x-auto">
    <table id="tabel-peserta" class="min-w-full table-auto text-sm text-center">
      <thead class="bg-gradient-to-r from-purple-100 to-purple-200 text-gray-700">
        <tr>
          <th class="px-4 py-3 text-left">No</th>
          <th class="px-4 py-3 text-left">Nama Peserta</th>
          <th class="px-4 py-3 text-left">Asal Sekolah</th>
          <th class="px-4 py-3">Penempatan Unit</th>
          <th class="px-4 py-3">Detail Peserta</th>
          <th class="px-4 py-3">Nilai</th>
          <th class="px-4 py-3">Beri Nilai</th>
          <th class="px-4 py-3">Tanggal Penilaian</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        <tr class="hover:bg-gray-50 transition">
          <td class="px-4 py-3">1</td>
          <td class="px-4 py-3 font-medium text-gray-800 nama-peserta">Muhammad Nur Wahab</td>
          <td class="px-4 py-3 asal-sekolah">Universitas Muhammadiyah Gresik</td>
          <td class="px-4 py-3 unit-penempatan">IT</td>

          <!-- Detail Peserta -->
          <td class="px-4 py-3">
            <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow" id="detailBtn">
              Detail Peserta
            </button>

            <!-- Popup Detail -->
            <div id="popupDetail" class="overlay">
              <div class="popup-card">
                <span class="close-btn" id="closeDetail">&times;</span>

                <!-- Sidebar -->
                <div class="sidebar">
                  <h3>Menu</h3>
                  <button id="menu-detail" class="active" onclick="showContent('detail')">Detail Peserta</button>
                  <button id="menu-presensi" onclick="showContent('presensi')">Presensi Peserta</button>
                </div>

                <!-- Konten -->
                <div class="content">
                  <!-- Konten Detail Peserta -->
                  <div id="content-detail">
                    <div class="nav-tabs">
                      <button id="tab-profil" class="active" onclick="switchTab('profil')">Profil Peserta</button>
                      <button id="tab-laporan" onclick="switchTab('laporan')">Laporan Harian</button>
                      <button id="tab-akhir" onclick="switchTab('akhir')">Laporan Akhir</button>
                    </div>

                    <!-- Profil -->
                    <div id="content-profil">
                      <div style="display: flex; gap: 30px; align-items: flex-start;">
                        <!-- Foto Profil -->
                        <div style="text-align: center;">
                          <p><b>Foto Profil</b></p>
                          <img src="images/default profile.png" alt="Foto Profil" 
                               style="width: 120px; height: 120px; border-radius: 50%; border: 2px solid #ccc;">
                        </div>

                        <!-- Data Peserta -->
                        <div style="background: #f9f9f9; padding: 20px; border-radius: 8px; width: 100%; max-width: 500px;">
                          <table style="width: 100%; border-collapse: collapse;">
                            <tr><td><b>Nama Lengkap</b></td><td>Muhammad Nur Wahab</td></tr>
                            <tr><td><b>Alamat</b></td><td>Jl. Panglima Sudirman Gang 6 no 29 Gresik</td></tr>
                            <tr><td><b>No Telp</b></td><td>08885280789</td></tr>
                            <tr><td><b>Email</b></td><td>Wahab@gmail.com</td></tr>
                            <tr><td><b>Nama Institusi</b></td><td>Universitas Muhammadiyah Gresik</td></tr>
                            <tr><td><b>Jurusan</b></td><td>Teknik Informatika</td></tr>
                            <tr><td><b>Tanggal Mulai</b></td><td>17/08/2025</td></tr>
                            <tr><td><b>Tanggal Selesai</b></td><td>17/09/2025</td></tr>
                            <tr><td><b>Informasi Unit</b></td><td>Keuangan</td></tr>
                          </table>
                        </div>
                      </div>
                    </div>

                    <!-- Laporan Harian -->
                    <div id="content-laporan" style="display:none;">
                      <h4 class="mb-3 font-bold">Laporan Harian Peserta</h4>
                      <table class="w-full border-collapse text-sm text-center">
                        <thead>
                          <tr class="bg-gray-100 border-b">
                            <th>No</th><th>Judul</th><th>Tanggal</th><th>Jam</th><th>Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td><td>Hari ke 1</td><td>17/08/2025</td><td>08:20</td>
                            <td><button onclick="showDetail('Laporan Hari ke 1')" class="bg-green-600 text-white px-2 py-1 rounded">Lihat Detail</button></td>
                          </tr>
                          <tr>
                            <td>2</td><td>Hari ke 2</td><td>18/08/2025</td><td>07:54</td>
                            <td><button onclick="showDetail('Laporan Hari ke 2')" class="bg-green-600 text-white px-2 py-1 rounded">Lihat Detail</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <!-- Laporan Akhir -->
                    <div id="content-akhir" style="display:none;">
                      <h4 class="mb-3 font-bold">Laporan Akhir Peserta</h4>
                      <table class="w-full border-collapse text-sm text-center">
                        <thead>
                          <tr class="bg-gray-100 border-b">
                            <th>No</th><th>Judul Laporan</th><th>Tanggal</th><th>Jam</th><th>Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td><td>Sistem Presensi</td><td>17/08/2025</td><td>08:20</td>
                            <td><button onclick="showDetail('Sistem Presensi')" class="bg-green-600 text-white px-2 py-1 rounded">Lihat Detail</button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <!-- Konten Presensi -->
                  <div id="content-presensi" style="display:none;">
                    <div class="nav-tabs">
                      <button id="tab-checkin" class="active" onclick="switchPresensi('checkin')">Check In</button>
                      <button id="tab-checkout" onclick="switchPresensi('checkout')">Check Out</button>
                    </div>

                    <!-- Check In -->
                    <div id="content-checkin" style="display:block;">
                      <h4 class="mb-3 font-bold">Data Check-In Peserta</h4>
                      <div class="flex justify-around mb-3">
                        <div><b>Hadir:</b> <span id="hadir-info">0</span></div>
                        <div><b>Izin:</b> <span id="izin-info">0</span></div>
                        <div><b>Tidak Hadir:</b> <span id="tidak-hadir-info">0</span></div>
                      </div>
                      <table class="w-full border-collapse text-sm text-center">
                        <thead class="bg-gray-100">
                          <tr><th>No</th><th>Tanggal</th><th>Jam</th><th>Status</th><th>Keterangan</th><th>Alasan</th></tr>
                        </thead>
                        <tbody id="checkinTableBody"></tbody>
                      </table>
                    </div>

                    <!-- Check Out -->
                    <div id="content-checkout" style="display:none;">
                      <h4 class="mb-3 font-bold">Data Check-Out Peserta</h4>
                      <div class="flex justify-around mb-3">
                        <div><b>Hadir:</b> <span id="checkout-hadir-info">0</span></div>
                        <div><b>Izin:</b> <span id="checkout-izin-info">0</span></div>
                        <div><b>Tidak Hadir:</b> <span id="checkout-tidak-hadir-info">0</span></div>
                      </div>
                      <table class="w-full border-collapse text-sm text-center">
                        <thead class="bg-gray-100">
                          <tr><th>No</th><th>Tanggal</th><th>Jam</th><th>Status</th><th>Keterangan</th><th>Alasan</th></tr>
                        </thead>
                        <tbody id="checkoutTableBody"></tbody>
                      </table>
                    </div>
                  </div>
                </div> <!-- end .content -->
              </div> <!-- end .popup-card -->
            </div> <!-- end #popupDetail -->
          </td>

          <!-- Nilai -->
          <td class="px-4 py-3 font-semibold nilai-peserta">0</td>

          <!-- Beri Nilai -->
          <td class="px-4 py-3">
            <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow" id="nilaiBtn">
              Beri Nilai
            </button>

            <!-- Popup Penilaian -->
            <div id="popupPenilaian" class="overlay-penilaian">
              <div class="popup-card-penilaian">
                <span class="close-btn-penilaian" id="closePopupPenilaian">&times;</span>
                
                <div class="sidebar-penilaian">
                  <button id="menu-penilaian" class="active"><b>Penilaian Peserta Magang</b></button>
                </div>

                <div class="content-penilaian">
                  <div id="content-penilaian">
                    <div class="nav-tabs-penilaian">
                      <button class="active"><b>Form Penilaian</b></button>
                    </div> <br>

                    <!-- Form Penilaian -->
                    <form id="formPenilaian" class="space-y-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Penyelesaian Tugas</label>
                        <input type="number" class="nilai w-full border rounded-lg px-3 py-2" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Inisiatif dan Kerja keras</label>
                        <input type="number" class="nilai w-full border rounded-lg px-3 py-2" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Komunikasi</label>
                        <input type="number" class="nilai w-full border rounded-lg px-3 py-2" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kerjasama</label>
                        <input type="number" class="nilai w-full border rounded-lg px-3 py-2" />
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kedisiplinan</label>
                        <input type="number" class="nilai w-full border rounded-lg px-3 py-2" />
                      </div>

                      <div class="mt-6">
                        <h2 class="font-bold mb-2">Daftar Penilaian</h2>
                        <table class="w-full border border-gray-300 text-sm text-center">
                          <thead class="bg-gray-100">
                            <tr>
                              <th class="border px-2 py-1">Penyelesaian</th>
                              <th class="border px-2 py-1">Inisiatif</th>
                              <th class="border px-2 py-1">Komunikasi</th>
                              <th class="border px-2 py-1">Kerjasama</th>
                              <th class="border px-2 py-1">Kedisiplinan</th>
                              <th class="border px-2 py-1">Rata-rata</th>
                            </tr>
                          </thead>
                          <tbody id="tabelPenilaian"></tbody>
                        </table>
                      </div>

                      <label class="block mt-4 mb-2 font-bold">Rata-rata</label>
                      <input type="text" id="hasilPenilaian" class="border rounded p-2 w-full bg-gray-100 font-semibold" readonly>

                      <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow font-medium">
                          Simpan Penilaian
                        </button>
                      </div>
                    </form>
                  </div> <!-- end #content-penilaian -->
                </div> <!-- end .content-penilaian -->
              </div> <!-- end .popup-card-penilaian -->
            </div> <!-- end #popupPenilaian -->
          </td>
          <!-- Tanggal Penilaian -->
          <td class="px-4 py-3 tanggal-penilaian"></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
  <script src="js/detailppic.js"></script>
</body>
</html>
