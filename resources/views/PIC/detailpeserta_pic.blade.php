<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Monitoring Peserta Magang - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">

  <style>
    /* Overlay Popup - DETAIL */
    .overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    /* Card Popup - DETAIL */
    .popup-card {
      background: #fff;
      border-radius: 12px;
      width: 80%;
      max-width: 1000px;
      min-height: 500px;
      display: flex;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      position: relative;
      animation: fadeIn 0.3s ease-in-out;
    }

    /* Tombol close - DETAIL */
    .close-btn {
      position: absolute;
      top: 12px;
      right: 15px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      color: #555;
    }
    .close-btn:hover {
      color: red;
    }

    /* Sidebar - DETAIL */
    .sidebar {
      background: #f4f4f4;
      width: 220px;
      padding: 20px;
      border-right: 1px solid #ddd;
    }
    .sidebar h3 {
      margin-bottom: 15px;
      font-size: 18px;
      font-weight: bold;
    }
    .sidebar button {
      display: block;
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      background: #e0e0e0;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .sidebar button.active {
      background: #007bff;
      color: #fff;
    }
    .sidebar button:hover {
      background: #d0d0d0;
    }

    /* Konten kanan - DETAIL */
    .content {
      flex: 1;
      padding: 20px;
    }

    /* ============ VERSI PENILAIAN ============ */
    .overlay-penilaian {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 10000; /* lebih tinggi agar selalu muncul di atas */
    }

    .popup-card-penilaian {
      background: #fff;
      border-radius: 12px;
      width: 80%;
      max-width: 1000px;
      min-height: 500px;
      display: flex;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      position: relative;
      animation: fadeIn 0.3s ease-in-out;
    }

    .close-btn-penilaian {
      position: absolute;
      top: 12px;
      right: 15px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      color: #555;
    }
    .close-btn-penilaian:hover {
      color: red;
    }

    .sidebar-penilaian {
      background: #f4f4f4;
      width: 220px;
      padding: 20px;
      border-right: 1px solid #ddd;
    }

    .content-penilaian {
      flex: 1;
      padding: 20px;
    }

    /* Navbar dalam konten detail peserta */
    .nav-tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }
    .nav-tabs button {
      padding: 8px 16px;
      border: 1px solid #ccc;
      border-radius: 6px;
      background: #fafafa;
      cursor: pointer;
    }
    .nav-tabs button.active {
      background: #007bff;
      color: #fff;
      border-color: #007bff;
    }

    /* Animasi */
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
</style>


  <script>
    // Reset penempatan unit (bukan hapus baris)
    function hapusUnit(btn) {
      const row = btn.closest("tr");
      const unitSelect = row.querySelector("select");
      const nama = row.querySelector(".nama-peserta").innerText;

      if (confirm(`Hapus penempatan unit untuk ${nama}?`)) {
        unitSelect.disabled = false;
        unitSelect.value = "";
        btn.outerHTML = `<button onclick="konfirmasiPeserta(this)" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">Konfirmasi</button>`;
      }
    }

    // Fungsi filter unit
  function filterUnit() {
    const unit = document.getElementById("filterUnit").value.toLowerCase();
    const rows = document.querySelectorAll("#tabel-peserta tbody tr");

    rows.forEach(row => {
      const unitPenempatan = row.querySelector(".unit-penempatan").innerText.toLowerCase();
      row.style.display = (unit === "" || unitPenempatan === unit) ? "" : "none";
    });
  }

    // Fungsi pencarian nama / sekolah
    function cariPeserta() {
      const input = document.getElementById("searchText").value.toLowerCase();
      const rows = document.querySelectorAll("#tabel-peserta tbody tr");

      rows.forEach(row => {
        const nama = row.querySelector(".nama-peserta").innerText.toLowerCase();
        const sekolah = row.querySelector(".asal-sekolah").innerText.toLowerCase();
        row.style.display = (nama.includes(input) || sekolah.includes(input)) ? "" : "none";
      });
    }
  </script>
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
      <a href="/detailpesertapic" class="navbar-link"> Informasi dan Penilaian Peserta</a>
    </div>
    <div class="navbar-right">
      <a href="/sertifikasi" class="navbar-link">Sertifikasi Peserta Magang</a>
      <a href="/pic" class="navbar-link">Kembali</a>
    </div>
  </div>

  <!-- Konten Monitoring -->
  <div class="px-6 py-8 max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold text-purple-700 mb-6">Detail Peserta Magang</h2>

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

  
  <script>
  // === POPUP DETAIL PESERTA ===
  const detailBtn = document.getElementById('detailBtn');
  const popupDetail = document.getElementById('popupDetail');
  const closeDetail = document.getElementById('closeDetail');

  // buka popup detail
  detailBtn.addEventListener('click', () => {
    popupDetail.style.display = 'flex';
  });

  // tutup popup detail
  closeDetail.addEventListener('click', () => {
    popupDetail.style.display = 'none';
  });

  // klik luar area untuk close
  window.addEventListener('click', (e) => {
    if (e.target === popupDetail) {
      popupDetail.style.display = 'none';
    }
  });

  // === TAB NAVBAR DALAM DETAIL PESERTA ===
  function switchTab(tab) {
    document.getElementById('content-profil').style.display = 'none';
    document.getElementById('content-laporan').style.display = 'none';
    document.getElementById('content-akhir').style.display = 'none';

    document.getElementById('tab-profil').classList.remove('active');
    document.getElementById('tab-laporan').classList.remove('active');
    document.getElementById('tab-akhir').classList.remove('active');

    if (tab === 'profil') {
      document.getElementById('content-profil').style.display = 'block';
      document.getElementById('tab-profil').classList.add('active');
    } else if (tab === 'laporan') {
      document.getElementById('content-laporan').style.display = 'block';
      document.getElementById('tab-laporan').classList.add('active');
    } else if (tab === 'akhir') {
      document.getElementById('content-akhir').style.display = 'block';
      document.getElementById('tab-akhir').classList.add('active');
    }
  }

  // === TAB PRESENSI ===
  function switchPresensi(tab) {
    document.getElementById('content-checkin').style.display = 'none';
    document.getElementById('content-checkout').style.display = 'none';

    document.getElementById('tab-checkin').classList.remove('active');
    document.getElementById('tab-checkout').classList.remove('active');

    if (tab === 'checkin') {
      document.getElementById('content-checkin').style.display = 'block';
      document.getElementById('tab-checkin').classList.add('active');
    } else if (tab === 'checkout') {
      document.getElementById('content-checkout').style.display = 'block';
      document.getElementById('tab-checkout').classList.add('active');
    }
  }

  // === SIDEBAR DETAIL ===
  function showContent(menu) {
    document.getElementById('content-detail').style.display = 'none';
    document.getElementById('content-presensi').style.display = 'none';

    document.getElementById('menu-detail').classList.remove('active');
    document.getElementById('menu-presensi').classList.remove('active');

    if (menu === 'detail') {
      document.getElementById('content-detail').style.display = 'block';
      document.getElementById('menu-detail').classList.add('active');
    } else if (menu === 'presensi') {
      document.getElementById('content-presensi').style.display = 'block';
      document.getElementById('menu-presensi').classList.add('active');
    }
  }


  // === RENDER DATA PRESENSI (contoh data check-in/out) ===
  const checkinData = [
    {tanggal:"2025-08-10", jam:"08:01", status:"Hadir", alasan:"-"},
    {tanggal:"2025-08-11", jam:"08:15", status:"Hadir", alasan:"Macet"},
    {tanggal:"2025-08-12", jam:"-", status:"Izin", alasan:"Demam"},
    {tanggal:"2025-08-13", jam:"-", status:"Tidak Hadir", alasan:"Tanpa Keterangan"},
    {tanggal:"2025-08-14", jam:"08:05", status:"Hadir", alasan:"-"},
  ];

  const tbody = document.getElementById("checkinTableBody");
  checkinData.forEach((row, i) => {
    tbody.innerHTML += `
      <tr>
        <td>${i+1}</td>
        <td>${row.tanggal}</td>
        <td>${row.jam}</td>
        <td>${row.status}</td>
        <td>Check In</td>
        <td>${row.alasan}</td>
      </tr>
    `;
  });

  // hitung statistik checkin
  function hitungStatistik(data) {
    const total = data.length;
    const hadir = data.filter(d => d.status === "Hadir").length;
    const izin = data.filter(d => d.status === "Izin").length;
    const tidakHadir = data.filter(d => d.status === "Tidak Hadir").length;

    document.getElementById("hadir-info").innerText = `${hadir} kali (${((hadir/total)*100).toFixed(1)}%)`;
    document.getElementById("izin-info").innerText = `${izin} kali (${((izin/total)*100).toFixed(1)}%)`;
    document.getElementById("tidak-hadir-info").innerText = `${tidakHadir} kali (${((tidakHadir/total)*100).toFixed(1)}%)`;
  }
  hitungStatistik(checkinData);

  // checkout
  const checkoutData = [
    {tanggal:"2025-08-10", jam:"16:02", status:"Hadir", alasan:"-"},
    {tanggal:"2025-08-11", jam:"16:10", status:"Hadir", alasan:"Lembur"},
    {tanggal:"2025-08-12", jam:"-", status:"Izin", alasan:"Sakit"},
    {tanggal:"2025-08-13", jam:"-", status:"Tidak Hadir", alasan:"Tanpa Keterangan"},
    {tanggal:"2025-08-14", jam:"16:05", status:"Hadir", alasan:"-"},
  ];

  const tbodyCheckout = document.getElementById("checkoutTableBody");
  checkoutData.forEach((row, i) => {
    tbodyCheckout.innerHTML += `
      <tr>
        <td>${i+1}</td>
        <td>${row.tanggal}</td>
        <td>${row.jam}</td>
        <td>${row.status}</td>
        <td>Check Out</td>
        <td>${row.alasan}</td>
      </tr>
    `;
  });

  function hitungStatistikCheckout(data) {
    const total = data.length;
    const hadir = data.filter(d => d.status === "Hadir").length;
    const izin = data.filter(d => d.status === "Izin").length;
    const tidakHadir = data.filter(d => d.status === "Tidak Hadir").length;

    document.getElementById("checkout-hadir-info").innerText = `${hadir} kali (${((hadir/total)*100).toFixed(1)}%)`;
    document.getElementById("checkout-izin-info").innerText = `${izin} kali (${((izin/total)*100).toFixed(1)}%)`;
    document.getElementById("checkout-tidak-hadir-info").innerText = `${tidakHadir} kali (${((tidakHadir/total)*100).toFixed(1)}%)`;
  }
  hitungStatistikCheckout(checkoutData);

  const inputs = document.querySelectorAll(".nilai");
  const form = document.getElementById("formPenilaian");
  const hasil = document.getElementById("hasilPenilaian");
  const tabelBody = document.getElementById("tabelPenilaian");
  const nilaiPesertaCell = document.querySelector(".nilai-peserta");

  // === Hitung rata-rata otomatis ===
  inputs.forEach(input => input.addEventListener("input", hitungRata));
  function hitungRata() {
    let nilai = [];
    inputs.forEach(input => {
      let val = parseFloat(input.value);
      if (!isNaN(val)) nilai.push(val);
    });
    let rata = nilai.length > 0 ? (nilai.reduce((a, b) => a + b, 0) / nilai.length) : 0;
    hasil.value = rata > 0 ? rata.toFixed(2) : "";
  }

  // === Simpan/update nilai ===
  form.addEventListener("submit", function(e) {
    e.preventDefault();
    let values = [];
    let valid = true;
    inputs.forEach(input => {
      let val = parseFloat(input.value);
      if (isNaN(val)) valid = false;
      values.push(isNaN(val) ? "-" : val);
    });
    if (!valid) {
      alert("Harap isi semua nilai!");
      return;
    }

    let rata = parseFloat(hasil.value) || 0;

    // Update daftar penilaian (popup)
    let existingRow = tabelBody.querySelector("tr");
    if (existingRow) {
      let cells = existingRow.querySelectorAll("td");
      values.forEach((v, i) => cells[i].textContent = v);
      cells[cells.length - 1].textContent = rata.toFixed(2);
    } else {
      let tr = document.createElement("tr");
      values.forEach(v => {
        let td = document.createElement("td");
        td.className = "border px-2 py-1";
        td.textContent = v;
        tr.appendChild(td);
      });
      let tdRata = document.createElement("td");
      tdRata.className = "border px-2 py-1 font-semibold";
      tdRata.textContent = rata.toFixed(2);
      tr.appendChild(tdRata);
      tabelBody.appendChild(tr);
    }

    // Update nilai di tabel utama
    if (nilaiPesertaCell) nilaiPesertaCell.textContent = rata.toFixed(2);

    // === Panggil fungsi update tanggal otomatis ===
    updateTanggalPenilaian();

    // Reset form
    form.reset();
    hasil.value = "";
  });

  // === POPUP NILAI ===
  const nilaiBtn = document.getElementById("nilaiBtn");
  const popupPenilaian = document.getElementById("popupPenilaian");
  const closePopupPenilaian = document.getElementById("closePopupPenilaian");

  nilaiBtn.addEventListener('click', () => {
    popupPenilaian.style.display = 'flex';
  });

  closePopupPenilaian.addEventListener('click', () => {
    popupPenilaian.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === popupPenilaian) {
      popupPenilaian.style.display = 'none';
    }
  });

  // === Script Tanggal Penilaian ===
  const updateTanggalPenilaian = () => {
    const today = new Date();
    const formattedDate = today.toLocaleDateString("id-ID", {
      day: "2-digit",
      month: "2-digit",
      year: "numeric"
    });

    const tanggalCell = document.querySelector(".tanggal-penilaian");
    if (tanggalCell) {
      tanggalCell.textContent = formattedDate;
    }
  };

</script>


</body>
</html>
