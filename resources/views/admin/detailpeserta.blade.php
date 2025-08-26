<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Peserta Magang - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="/css/style.css">

  <style>
    /* ==== STYLE KHUSUS MODAL ==== */
    .modal {
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      padding: 20px;
      overflow-y: auto;
    }
    .modal.active { display: flex; }
    .modal-box {
      background: #fff;
      border-radius: 12px;
      padding: 25px;
      width: 100%;
      max-width: 650px;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
      animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .modal-box input,
    .modal-box select,
    .modal-box textarea {
      border: 1px solid #d1d5db;
      border-radius: 6px;
      padding: 8px 10px;
      width: 100%;
      font-size: 0.95rem;
    }
    .modal-box input:focus,
    .modal-box select:focus,
    .modal-box textarea:focus {
      outline: none;
      border-color: #6366f1;
      box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
    }
  </style>
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
      <a href="/detail" class="navbar-link"> Detail Peserta Magang</a>
    </div>
    <div class="navbar-right">
      <a href="/monitoring" class="navbar-link">Monitoring Peserta Magang</a>
      <a href="/verifikasi" class="navbar-link">Verifikasi Peserta Magang</a>
      <a href="/admin" class="navbar-link">Kembali</a>
    </div>
  </div>

  <!-- Tabs -->
  <div class="border-b border-gray-200 mt-10 px-6">
    <nav class="flex space-x-6" id="tabs">
      <button onclick="openTab('peserta')" id="tab-peserta" 
        class="py-2 px-4 font-semibold text-purple-600 border-b-2 border-purple-600 focus:outline-none">
        Peserta
      </button>
      <button onclick="openTab('pic')" id="tab-pic" 
        class="py-2 px-4 font-semibold text-gray-500 hover:text-green-600 focus:outline-none">
        PIC
      </button>
    </nav>
  </div>

  <!-- Content Peserta -->
  <section id="content-peserta" class="px-6 mt-6 tab-content">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-bold">Daftar Peserta</h2>
      <div class="flex gap-2">
        <button onclick="openModal('formAkunPesertaModal')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          + Tambah Akun Peserta
        </button>
      </div>
    </div>
    <table class="min-w-full border" id="pesertaTable">
      <thead class="bg-gray-100">
        <tr>
          <th class="border px-4 py-2">Nama</th>
          <th class="border px-4 py-2">Email</th>
          <th class="border px-4 py-2">Password</th>
          <th class="border px-4 py-2">Institusi</th>
          <th class="border px-4 py-2">Aksi</th>
          <th class="border px-4 py-2">Reset Password</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </section>

  <!-- Content PIC -->
  <section id="content-pic" class="px-6 mt-6 tab-content hidden">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-bold">Daftar PIC</h2>
      <button onclick="openModal('formAkunPicModal')" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
        + Tambah Akun PIC
      </button>
    </div>
    <table class="min-w-full border" id="picTable">
      <thead class="bg-gray-100">
        <tr>
          <th class="border px-4 py-2">Nama</th>
          <th class="border px-4 py-2">Email</th>
          <th class="border px-4 py-2">Password</th>
          <th class="border px-4 py-2">Divisi</th>
          <th class="border px-4 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </section>

  <!-- ========== Modal Tambah Akun Peserta ========== -->
  <div id="formAkunPesertaModal" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold mb-4">Tambah Akun Peserta</h3>
      <form id="formAkunPeserta">
        <div class="mb-3">
          <label class="block font-semibold">Nama</label>
          <input type="text" name="nama" required>
        </div>
        <div class="mb-3">
          <label class="block font-semibold">Email</label>
          <input type="email" name="email" required>
        </div>
        <div class="mb-3">
          <label class="block font-semibold">Password</label>
          <input type="password" name="password" required>
        </div>
        <div class="mb-3">
          <label class="block font-semibold">Institusi</label>
          <input type="text" name="institusi" required>
        </div>
        <div class="flex justify-end gap-2">
          <button type="button" onclick="closeModal('formAkunPesertaModal')" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ========== Modal Tambah Akun PIC ========== -->
  <div id="formAkunPicModal" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold mb-4">Tambah Akun PIC</h3>
      <form id="formAkunPic">
        <div class="mb-3">
          <label class="block font-semibold">Nama</label>
          <input type="text" name="nama" required>
        </div>
        <div class="mb-3">
          <label class="block font-semibold">Email</label>
          <input type="email" name="email" required>
        </div>
        <div class="mb-3">
          <label class="block font-semibold">Password</label>
          <input type="password" name="password" required>
        </div>
        <div class="mb-3">
          <label class="block font-semibold">Divisi</label>
          <input type="text" name="divisi" required>
        </div>
        <div class="flex justify-end gap-2">
          <button type="button" onclick="closeModal('formAkunPicModal')" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
          <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ========== Modal Formulir Pendaftaran Peserta ========== -->
  <div id="formulirPesertaModal" class="modal">
    <div class="modal-box max-w-2xl">
      <h1 class="text-2xl font-bold text-center text-black mb-6">Formulir Pendaftaran</h1>
      <form id="formulirPeserta" class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Alamat</label>
          <input type="text" name="alamat" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">No Telp</label>
          <input type="text" name="no_telp" required>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Alamat Email</label>
          <input type="email" name="email" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Nama Institusi</label>
          <input type="text" name="nama_institusi" readonly>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Jurusan</label>
          <input type="text" name="jurusan" required>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Magang</label>
            <input type="date" name="tanggal_mulai_magang" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Selesai Magang</label>
            <input type="date" name="tanggal_selesai_magang" required>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Grade</label>
          <div class="flex gap-6">
            <label class="inline-flex items-center">
              <input type="radio" name="grade" value="Mahasiswa" onclick="toggleMahasiswaFields()" required>
              <span class="ml-2">Mahasiswa</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="grade" value="Siswa" onclick="toggleMahasiswaFields()" required>
              <span class="ml-2">Siswa</span>
            </label>
          </div>
        </div>
        <div id="mahasiswa-fields" class="hidden space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Fakultas</label>
            <input type="text" name="fakultas">
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Jenjang</label>
            <select name="jenjang">
              <option value="">-- Pilih Jenjang --</option>
              <option value="S1">S1</option>
              <option value="S2">S2</option>
            </select>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Unggah Surat Permohonan PKL</label>
          <input type="file" name="file_surat" required>
        </div>
        <div class="flex justify-end gap-2 pt-4">
          <button type="button" onclick="closeModal('formulirPesertaModal')" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
          <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Submit</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Reset Password Modal Peserta --}} 
<form id="formResetPassPeserta" class="modal">
  <div class="mb-3">
    <label>Email</label>
    <input type="email" id="resetEmail" name="email" readonly class="border px-2 py-1 w-full">
  </div>
  <div class="mb-3">
    <label>Password Baru</label>
    <input type="password" id="resetPassword" name="password" required class="border px-2 py-1 w-full">
  </div>
  <div class="flex justify-end gap-2">
    <button type="button" onclick="closeModal('resetpasspeserta')" class="bg-gray-400 px-3 py-1 rounded">Batal</button>
    <button type="submit" class="bg-purple-600 text-white px-3 py-1 rounded">Simpan</button>
  </div>
</form>



  <!-- SCRIPT -->
  <script>
    function openTab(tab) {
      document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
      document.getElementById('content-' + tab).classList.remove('hidden');

      document.querySelectorAll('#tabs button').forEach(btn => {
        btn.classList.remove('text-purple-600','border-purple-600','text-green-600','border-green-600','border-b-2');
        btn.classList.add('text-gray-500');
      });
      if (tab === 'peserta') {
        document.getElementById('tab-peserta').classList.add('text-purple-600','border-b-2','border-purple-600');
      } else {
        document.getElementById('tab-pic').classList.add('text-green-600','border-b-2','border-green-600');
      }
    }

    function openModal(id) { document.getElementById(id).classList.add("active"); }
    function closeModal(id) { document.getElementById(id).classList.remove("active"); }

    function toggleMahasiswaFields() {
      const mahasiswaFields = document.getElementById("mahasiswa-fields");
      const gradeMahasiswa = document.querySelector('input[name="grade"][value="Mahasiswa"]');
      if (gradeMahasiswa.checked) {
        mahasiswaFields.classList.remove("hidden");
      } else {
        mahasiswaFields.classList.add("hidden");
      }
    }

    // Tambah akun peserta ke tabel
    document.getElementById("formAkunPeserta").addEventListener("submit", function(e) {
      e.preventDefault();
      const nama = this.nama.value;
      const email = this.email.value;
      const password = this.password.value;
      const institusi = this.institusi.value;

      const tbody = document.querySelector("#pesertaTable tbody");
      const row = `<tr>
        <td class="border px-4 py-2">${nama}</td>
        <td class="border px-4 py-2">${email}</td>
        <td class="border px-4 py-2">${password}</td>
        <td class="border px-4 py-2">${institusi}</td>
        <td class="border px-4 py-2 text-center">
          <button onclick="openModal('formulirPesertaModal')" class="bg-purple-600 text-white px-3 py-1 rounded">Tambah Formulir</button>
        </td>
        <td class="border px-4 py-2 text-center">
          <button onclick="openResetPasswordModal('${email}')" class="bg-purple-600 text-white px-3 py-1 rounded">Reset Password</button>
        </td>
      </tr>`;
      tbody.insertAdjacentHTML("beforeend", row);
      closeModal('formAkunPesertaModal');
      this.reset();
    });


        function openResetPasswordModal(email) {
      document.getElementById("resetEmail").value = email;
      openModal('resetpasspeserta');
    }

    // Simpan perubahan password
    document.getElementById("formResetPassPeserta").addEventListener("submit", function(e) {
      e.preventDefault();
      const email = document.getElementById("resetEmail").value;
      const newPass = document.getElementById("resetPassword").value;

      const rows = document.querySelector("#pesertaTable tbody").rows;
      for (let i = 0; i < rows.length; i++) {
        if (rows[i].cells[1].innerText === email) {  // kolom email ada di index ke-1
          rows[i].cells[2].innerText = newPass;     // kolom password ada di index ke-2
          break;
        }
      }

      closeModal('resetpasspeserta');
      this.reset();
    });


    // Tambah akun PIC ke tabel
    document.getElementById("formAkunPic").addEventListener("submit", function(e) {
      e.preventDefault();
      const nama = this.nama.value;
      const email = this.email.value;
      const password = this.password.value;
      const divisi = this.divisi.value;

      const tbody = document.querySelector("#picTable tbody");
      const row = `<tr>
          <td class="border px-4 py-2">${nama}</td>
          <td class="border px-4 py-2">${email}</td>
          <td class="border px-4 py-2">${password}</td>
          <td class="border px-4 py-2">${divisi}</td>
          <td class="border px-4 py-2 text-center">
            <button class="bg-green-600 text-white px-3 py-1 rounded">Ganti Password</button>
          </td>
        </tr>`;
      tbody.insertAdjacentHTML("beforeend", row);
      closeModal('formAkunPicModal');
      this.reset();
    });

  </script>
</body>
</html>
