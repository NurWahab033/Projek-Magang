<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detail Peserta Magang - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="/css/detailakun.css">
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
      <a href="/detailakun" class="navbar-link"> Pendaftaran Akun Peserta dan PIC</a>
    </div>
    <div class="navbar-right">
      <a href="/monitoring" class="navbar-link">Monitoring Peserta Magang</a>
      <a href="/verifikasi" class="navbar-link">Verifikasi Peserta Magang</a>
      <a href="/sertifikasi" class="navbar-link">Sertifikasi Peserta Magang</a>
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
      <tbody>
        @foreach($pics as $pic)
          <tr>
            <td class="border px-4 py-2">{{ $pic->username }}</td>
            <td class="border px-4 py-2">{{ $pic->email }}</td>
            <td class="border px-4 py-2">********</td>
            <td class="border px-4 py-2">{{ $pic->nama_institusi }}</td>
            <td class="border px-4 py-2">
              <button onclick="openModal('resetpasspic'); document.getElementById('resetEmailPic').value='{{ $pic->email }}'"
                class="bg-purple-600 text-white px-2 py-1 rounded hover:bg-purple-700">
                Reset Password
              </button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>

  <!-- ========== Modal Tambah Akun Peserta ========== -->
  <div id="formAkunPesertaModal" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold mb-4">Tambah Akun Peserta</h3>
      <form id="formAkunPeserta">
        @csrf
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
      <form id="formAkunPic" method="POST" action="{{ route('storePic') }}">
        @csrf
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

  <!-- ========== Modal Reset Password Peserta ========== -->
  <div id="resetpasspeserta" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold mb-4">Reset Password Peserta</h3>
      <form id="formResetPassPeserta">
        @csrf
        <div class="mb-3">
          <label class="block font-semibold">Email</label>
          <input type="email" id="resetEmail" name="email" readonly class="border px-2 py-1 w-full">
        </div>
        <div class="mb-3">
          <label class="block font-semibold">Password Baru</label>
          <input type="password" id="resetPassword" name="password" required class="border px-2 py-1 w-full">
        </div>
        <div class="flex justify-end gap-2">
          <button type="button" onclick="closeModal('resetpasspeserta')" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
          <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- ========== Modal Reset Password PIC ========== -->
  <div id="resetpasspic" class="modal">
    <div class="modal-box">
      <h3 class="text-lg font-bold mb-4">Reset Password PIC</h3>
      <form id="formResetPassPic" method="POST" action="{{ route('resetPasswordPic') }}">
        @csrf
        <div class="mb-3">
          <label class="block font-semibold">Email</label>
          <input type="email" id="resetEmailPic" name="email" readonly class="border px-2 py-1 w-full">
        </div>
        <div class="mb-3">
          <label class="block font-semibold">Password Baru</label>
          <input type="password" id="resetPasswordPic" name="password" required class="border px-2 py-1 w-full">
        </div>
        <div class="flex justify-end gap-2">
          <button type="button" onclick="closeModal('resetpasspic')" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
          <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- SCRIPT -->
  <script src="js/detailakun.js"></script>
</body>
</html>


