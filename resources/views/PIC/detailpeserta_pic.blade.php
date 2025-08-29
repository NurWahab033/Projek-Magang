<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Monitoring Peserta Magang - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
      <input id="searchText" type="text" placeholder="Cari berdasarkan nama / sekolah / unit" 
        class="border border-gray-300 px-3 py-2 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-purple-400 flex-1">
      <button onclick="cariPeserta()" 
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow font-medium">Cari</button>
    </div>

    <!-- Table Peserta -->
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
                <div id="popupDetail" class="overlay fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
                  <div class="popup-card bg-white rounded-xl shadow-2xl w-full max-w-5xl relative p-6">
                    <span class="close-btn absolute top-4 right-4 text-gray-600 text-2xl cursor-pointer hover:text-red-600" id="closeDetail">&times;</span>

                    <div class="flex">
                      <!-- Sidebar -->
                      <div class="sidebar bg-gradient-to-b from-purple-600 to-purple-700 text-white p-5 rounded-l-xl min-w-[200px] flex flex-col gap-3">
                        <button id="menu-detail" class="active bg-purple-800 py-2 px-3 rounded-lg">Detail Peserta</button>
                        <button id="menu-presensi" class="py-2 px-3 rounded-lg hover:bg-purple-800">Presensi Peserta</button>
                      </div>

                      <!-- Konten -->
                      <div class="content flex-1 p-6">
                        <div id="content-detail">
                          <!-- Tab Navigasi -->
                          <div class="nav-tabs border-b mb-4 flex gap-3">
                            <button id="tab-profil" class="active px-4 py-2 font-bold text-purple-700 border-b-2 border-purple-700">Profil Peserta</button>
                            <button id="tab-laporan" class="px-4 py-2">Laporan Harian</button>
                            <button id="tab-akhir" class="px-4 py-2">Laporan Akhir</button>
                          </div>

                          <!-- Profil -->
                          <div id="content-profil">
                            <div class="flex gap-6 items-start">
                              <!-- Foto Profil -->
                              <div class="text-center">
                                <p class="font-bold mb-2">Foto Profil</p>
                                <img src="images/default profile.png" alt="Foto Profil" 
                                  class="w-32 h-32 rounded-full border-2 border-gray-300 object-cover">
                              </div>

                              <!-- Data Peserta -->
                              <div class="bg-gray-50 p-5 rounded-lg shadow w-full max-w-lg">
                                <table class="w-full text-sm">
                                  <tr><td class="font-semibold pr-3">Nama Lengkap</td><td>Muhammad Nur Wahab</td></tr>
                                  <tr><td class="font-semibold pr-3">Alamat</td><td>Jl. Panglima Sudirman Gang 6 no 29 Gresik</td></tr>
                                  <tr><td class="font-semibold pr-3">No Telp</td><td>08885280789</td></tr>
                                  <tr><td class="font-semibold pr-3">Email</td><td>Wahab@gmail.com</td></tr>
                                  <tr><td class="font-semibold pr-3">Nama Institusi</td><td>Universitas Muhammadiyah Gresik</td></tr>
                                  <tr><td class="font-semibold pr-3">Jurusan</td><td>Teknik Informatika</td></tr>
                                  <tr><td class="font-semibold pr-3">Tanggal Mulai</td><td>17/08/2025</td></tr>
                                  <tr><td class="font-semibold pr-3">Tanggal Selesai</td><td>17/09/2025</td></tr>
                                  <tr><td class="font-semibold pr-3">Informasi Unit</td><td>Keuangan</td></tr>
                                </table>
                              </div>
                            </div>
                          </div>

                          <!-- Laporan Harian -->
                          <div id="content-laporan" class="hidden">
                            <h4 class="mb-3 font-bold">Laporan Harian Peserta</h4>
                            <table class="w-full border border-gray-200 rounded-lg text-sm text-center">
                              <thead class="bg-gray-100">
                                <tr><th>No</th><th>Judul</th><th>Tanggal</th><th>Jam</th><th>Detail</th></tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td><td>Hari ke 1</td><td>17/08/2025</td><td>08:20</td>
                                  <td><button onclick="showDetail('Laporan Hari ke 1')" class="bg-green-600 text-white px-2 py-1 rounded">Lihat Detail</button></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>

                          <!-- Laporan Akhir -->
                          <div id="content-akhir" class="hidden">
                            <h4 class="mb-3 font-bold">Laporan Akhir Peserta</h4>
                            <table class="w-full border border-gray-200 rounded-lg text-sm text-center">
                              <thead class="bg-gray-100">
                                <tr><th>No</th><th>Judul Laporan</th><th>Tanggal</th><th>Jam</th><th>Detail</th></tr>
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
                      </div> <!-- end .content -->
                    </div> <!-- end flex -->
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
                <div id="popupPenilaian" class="overlay-penilaian fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
                  <div class="popup-card-penilaian bg-white rounded-xl shadow-2xl w-full max-w-3xl relative p-6">
                    <span class="close-btn-penilaian absolute top-4 right-4 text-gray-600 text-2xl cursor-pointer hover:text-red-600" id="closePopupPenilaian">&times;</span>

                    <div class="flex">
                      <!-- Sidebar -->
                      <div class="sidebar-penilaian bg-gradient-to-b from-purple-600 to-purple-700 text-white p-5 rounded-l-xl min-w-[200px] flex flex-col items-center">
                        <button id="menu-penilaian" class="active bg-purple-800 py-2 px-3 rounded-lg shadow">Penilaian Peserta Magang</button>
                      </div>

                      <!-- Konten -->
                      <div class="content-penilaian flex-1 p-6">
                        <div id="content-penilaian">
                          <!-- Tab Navigasi -->
                          <div class="nav-tabs-penilaian border-b mb-4">
                            <button class="active px-4 py-2 font-bold text-purple-700 border-b-2 border-purple-700">Form Penilaian</button>
                          </div>

                          <!-- Form Penilaian -->
                          <form id="formPenilaian" class="space-y-4">
                            <div>
                              <label class="block text-sm font-medium text-gray-700 mb-1">Penyelesaian Tugas</label>
                              <input type="number" class="nilai w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400" />
                            </div>
                            <div>
                              <label class="block text-sm font-medium text-gray-700 mb-1">Inisiatif dan Kerja keras</label>
                              <input type="number" class="nilai w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400" />
                            </div>
                            <div>
                              <label class="block text-sm font-medium text-gray-700 mb-1">Komunikasi</label>
                              <input type="number" class="nilai w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400" />
                            </div>
                            <div>
                              <label class="block text-sm font-medium text-gray-700 mb-1">Kerjasama</label>
                              <input type="number" class="nilai w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400" />
                            </div>
                            <div>
                              <label class="block text-sm font-medium text-gray-700 mb-1">Kedisiplinan</label>
                              <input type="number" class="nilai w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-400" />
                            </div>

                            <div class="mt-6">
                              <h2 class="font-bold mb-2 text-lg text-gray-700">Daftar Penilaian</h2>
                              <table class="w-full border border-gray-300 text-sm text-center rounded-lg">
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

                            <label class="block mt-4 mb-2 font-bold text-gray-700">Rata-rata</label>
                            <input type="text" id="hasilPenilaian" class="border rounded p-2 w-full bg-gray-100 font-semibold text-center" readonly>

                            <div class="flex justify-end mt-4">
                              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow font-medium">
                                Simpan Penilaian
                              </button>
                            </div>
                          </form>
                        </div> <!-- end #content-penilaian -->
                      </div> <!-- end .content-penilaian -->
                    </div>
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
  </div>

  <script src="js/detailppic.js"></script>
</body>
</html>
