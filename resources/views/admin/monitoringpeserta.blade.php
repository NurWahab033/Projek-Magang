<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Monitoring Peserta Magang - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/monitoring.css">
</head>

<body class="bg-gray-50 text-sm">
  <!-- Header -->
  <div class="header bg-white border-b shadow px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <img src="/images/cipta nirmala.png" alt="Logo" class="h-12 w-auto">
      <h1 class="text-xl font-bold text-gray-800">PT. CIPTA NIRMALA</h1>
    </div>
  </div>

  <!-- Navbar Utama -->
  <div class="navbar">
    <div class="navbar-left">
      <a href="/monitoring" class="navbar-link"> Monitoring Peserta Magang</a>
    </div>
    <div class="navbar-right">
      <a href="/detailakun" class="navbar-link">Pendaftaran Akun Peserta dan PIC</a>
      <a href="/verifikasi" class="navbar-link">Verifikasi Peserta Magang</a>
      <a href="/sertifikasi" class="navbar-link">Sertifikasi Peserta Magang</a>
      <a href="/admin" class="navbar-link">Kembali</a>
    </div>
  </div>

  <!-- Konten laman Monitoring -->
<div class="px-6 py-8 max-w-6xl mx-auto">
  <h2 class="text-2xl font-bold text-purple-700 mb-6">Monitoring Peserta Magang</h2>

  <!-- Filter & Search -->
  <div class="flex flex-col md:flex-row items-center gap-3 mb-6">
    <select id="filterUnit" onchange="filterUnit()" 
      class="border border-gray-300 px-3 py-2 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400">
      <option value="">Pilih Unit</option>
      <option value="IT">IT</option>
      <option value="HRD">HRD</option>
      <option value="Keuangan">Keuangan</option>
    </select>

    <input id="searchText" type="text" placeholder="Cari berdasarkan nama / sekolah / tingkat"
      class="border border-gray-300 px-3 py-2 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400 flex-1">

    <button onclick="cariPeserta()" 
      class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow font-medium">Cari</button>
  </div>

  <!-- Card Tabel -->
  <div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
      <table id="tabel-peserta" class="min-w-full table-auto text-sm text-center">
        <thead class="bg-gradient-to-r from-purple-100 to-purple-200 text-gray-700">
          <tr>
            <th class="px-4 py-3 text-left">No</th>
            <th class="px-4 py-3 text-left">Nama Peserta</th>
            <th class="px-4 py-3 text-left">Grade</th>
            <th class="px-4 py-3 text-left">Asal Sekolah</th>
            <th class="px-4 py-3">Penempatan Unit</th>
            <th class="px-4 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-3">1</td>
            <td class="px-4 py-3 font-medium text-gray-800 nama-peserta">Muhammad Nur Wahab</td>
            <td class="px-4 py-3 grade">Mahasiswa</td>
            <td class="px-4 py-3 asal-sekolah">Universitas Muhammadiyah Gresik</td>
            <td class="px-4 py-3">
              <select class="border border-gray-300 px-2 py-1 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400">
                <option value="">-- Pilih Unit --</option>
                <option value="IT">IT</option>
                <option value="HRD">HRD</option>
                <option value="Keuangan">Keuangan</option>
              </select>
            </td>
            <td class="px-4 py-3 flex items-center justify-center gap-2">
              <!-- Tombol Konfirmasi -->
              <button onclick="konfirmasiPeserta(this)"
                class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">
                Konfirmasi
              </button>

              <!-- Tombol Detail Peserta -->
              <button id="detailBtn"
                class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">
                Detail Peserta
              </button>

              <!-- Overlay + Popup -->
              <div id="popupOverlay" class="overlay">
                <div class="popup-card">
                  <span id="closePopup" class="close-btn">&times;</span>

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

                      <!-- Profil Peserta -->
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
                              <tr>
                                <td style="padding: 6px 10px; font-weight: bold;">Nama Lengkap</td>
                                <td style="padding: 6px 10px;">Muhammad Nur Wahab</td>
                              </tr>
                              <tr>
                                <td style="padding: 6px 10px; font-weight: bold;">Alamat</td>
                                <td style="padding: 6px 10px;">Jl. Panglima Sudirman Gang 6 no 29 Gresik</td>
                              </tr>
                              <tr>
                                <td style="padding: 6px 10px; font-weight: bold;">No Telp</td>
                                <td style="padding: 6px 10px;">08885280789</td>
                              </tr>
                              <tr>
                                <td style="padding: 6px 10px; font-weight: bold;">Email</td>
                                <td style="padding: 6px 10px;">Wahab@gmail.com</td>
                              </tr>
                              <tr>
                                <td style="padding: 6px 10px; font-weight: bold;">Nama Institusi</td>
                                <td style="padding: 6px 10px;">Universitas Muhammadiyah Gresik</td>
                              </tr>
                              <tr>
                                <td style="padding: 6px 10px; font-weight: bold;">Jurusan</td>
                                <td style="padding: 6px 10px;">Teknik Informatika</td>
                              </tr>
                              <tr>
                                <td style="padding: 6px 10px; font-weight: bold;">Tanggal Mulai</td>
                                <td style="padding: 6px 10px;">17/08/2025</td>
                              </tr>
                              <tr>
                                <td style="padding: 6px 10px; font-weight: bold;">Tanggal Selesai</td>
                                <td style="padding: 6px 10px;">17/09/2025</td>
                              </tr>
                              <tr>
                                <td style="padding: 6px 10px; font-weight: bold;">Informasi Unit</td>
                                <td style="padding: 6px 10px;">Keuangan</td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>

                      <!-- Laporan Harian -->
                      <div id="content-laporan" style="display:none;">
                        <h4 style="margin-bottom: 15px;"><b>Laporan Harian Peserta</b></h4>
                        <table style="width:100%; border-collapse: collapse; font-size:14px; text-align:center;">
                          <thead>
                            <tr style="background:#f4f4f4; border-bottom:2px solid #ccc;">
                              <th>No</th>
                              <th>Judul</th>
                              <th>Tanggal Pengumpulan</th>
                              <th>Jam Pengumpulan</th>
                              <th>Detail</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Hari ke 1</td>
                              <td>17/08/2025</td>
                              <td>08:20</td>
                              <td>
                                <button onclick="showDetail('Laporan Hari ke 1')" 
                                  style="background:#4CAF50; color:#fff; border:none; padding:6px 12px; border-radius:5px; cursor:pointer;">
                                  Lihat Detail
                                </button>
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>Hari ke 2</td>
                              <td>18/08/2025</td>
                              <td>07:54</td>
                              <td>
                                <button onclick="showDetail('Laporan Hari ke 2')" 
                                  style="background:#4CAF50; color:#fff; border:none; padding:6px 12px; border-radius:5px; cursor:pointer;">
                                  Lihat Detail
                                </button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                      <!-- Laporan Akhir -->
                      <div id="content-akhir" style="display:none;">
                        <h4 style="margin-bottom: 15px;"><b>Laporan Akhir Peserta</b></h4>
                        <table style="width:100%; border-collapse: collapse; font-size:14px; text-align:center;">
                          <thead>
                            <tr style="background:#f4f4f4; border-bottom:2px solid #ccc;">
                              <th>No</th>
                              <th>Judul Laporan</th>
                              <th>Tanggal Pengumpulan</th>
                              <th>Jam Pengumpulan</th>
                              <th>Detail</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Sistem Presensi</td>
                              <td>17/08/2025</td>
                              <td>08:20</td>
                              <td>
                                <button onclick="showDetail('Sistem Presensi')" 
                                  style="background:#4CAF50; color:#fff; border:none; padding:6px 12px; border-radius:5px; cursor:pointer;">
                                  Lihat Detail
                                </button>
                              </td>
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

                      <!-- Data Checkin -->
                      <div id="content-checkin" style="display:none;">
                        <h4 style="margin-bottom: 15px;"><b>Data Check-In Peserta</b></h4>

                        <!-- Ringkasan -->
                        <div style="display:flex; justify-content: space-around; margin-bottom:20px;">
                          <div><strong>Hadir:</strong> <span id="hadir-info">0</span></div>
                          <div><strong>Izin:</strong> <span id="izin-info">0</span></div>
                          <div><strong>Tidak Hadir:</strong> <span id="tidak-hadir-info">0</span></div>
                        </div>

                        <!-- Tabel Checkin -->
                        <table border="1" cellspacing="0" cellpadding="8"
                          style="width:100%; border-collapse: collapse; text-align:center;">
                          <thead style="background:#f4f4f4;">
                            <tr>
                              <th>No</th>
                              <th>Tanggal</th>
                              <th>Jam</th>
                              <th>Status</th>
                              <th>Keterangan</th>
                              <th>Alasan</th>
                            </tr>
                          </thead>
                          <tbody id="checkinTableBody">
                            <!-- Isi dari JS -->
                          </tbody>
                        </table>
                      </div>

                      <!-- Data Checkout -->
                      <div id="content-checkout" style="display:none;">
                        <h4 style="margin-bottom: 15px;"><b>Data Check-Out Peserta</b></h4>

                        <!-- Ringkasan -->
                        <div style="display:flex; justify-content: space-around; margin-bottom:20px;">
                          <div><strong>Hadir:</strong> <span id="checkout-hadir-info">0</span></div>
                          <div><strong>Izin:</strong> <span id="checkout-izin-info">0</span></div>
                          <div><strong>Tidak Hadir:</strong> <span id="checkout-tidak-hadir-info">0</span></div>
                        </div>

                        <!-- Tabel Checkout -->
                        <table border="1" cellspacing="0" cellpadding="8"
                          style="width:100%; border-collapse: collapse; text-align:center;">
                          <thead style="background:#f4f4f4;">
                            <tr>
                              <th>No</th>
                              <th>Tanggal</th>
                              <th>Jam</th>
                              <th>Status</th>
                              <th>Keterangan</th>
                              <th>Alasan</th>
                            </tr>
                          </thead>
                          <tbody id="checkoutTableBody">
                            <!-- Isi dari JS -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END Popup -->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="js/monitoringadmin.js"></script>
</body>
</html>
