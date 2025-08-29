{{-- <!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulir Pendaftaran Peserta Magang - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>

<body class="bg-white text-sm relative">

  <!-- Notifikasi -->
  @if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4">
      {{ session('success') }}
  </div>
  @endif

  <!-- Header -->
  <div class="header">
    <div class="header-container">
      <img src="/images/cipta nirmala.png" alt="Logo" class="logo" />
      <h1 class="header-title">PT. CIPTA NIRMALA</h1>
    </div>
  </div>

  <!-- Navbar -->
  <div class="navbar">
    <div class="navbar-left">
      <a href="/formpendaftaran" class="navbar-link">Formulir Pendaftaran</a>
    </div>
    <div class="navbar-right">
      <a href="/informasi" class="navbar-link">Informasi Pendaftaran</a>
      <a href="/user" class="navbar-link">Kembali</a>
    </div>
  </div>

  <br>
  <br>
  <!-- FORM -->
  <div class="bg-white min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-2xl">

      <!-- Header -->
      <div class="flex items-center justify-center gap-4 mb-8">
        <h1 class="text-3xl font-bold text-center text-black">Formulir Pendaftaran</h1>
      </div>

      <form action="{{ route('formulir.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
          <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" class="w-full bg-blue-50 border border-gray-300 p-2 rounded focus:outline-none" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Alamat</label>
          <input type="text" name="alamat" class="w-full bg-blue-50 border border-gray-300 p-2 rounded focus:outline-none" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">No telp</label>
          <input type="text" name="no_telp" class="w-full bg-blue-50 border border-gray-300 p-2 rounded focus:outline-none" required>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Alamat Email</label>
          <input type="email" name="email" value="{{ $user->email ?? '' }}" readonly class="w-full bg-blue-50 border border-gray-300 p-2 rounded focus:outline-none">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Nama Institusi</label>
          <input type="text" name="nama_institusi" value="{{ $user->nama_institusi ?? '' }}" readonly class="w-full bg-blue-50 border border-gray-300 p-2 rounded focus:outline-none">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">Jurusan</label>
          <input type="text" name="jurusan" class="w-full bg-blue-50 border border-gray-300 p-2 rounded focus:outline-none" required>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Mulai Magang</label>
            <input type="date" name="tanggal_mulai_magang" class="w-full bg-blue-50 border border-gray-300 p-2 rounded focus:outline-none" required>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700">Tanggal Selesai Magang</label>
            <input type="date" name="tanggal_selesai_magang" class="w-full bg-blue-50 border border-gray-300 p-2 rounded focus:outline-none" required>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Grade</label>
          <div class="flex gap-6">
            <label class="inline-flex items-center">
              <input type="radio" name="grade" value="Mahasiswa" required>
              <span class="ml-2">Mahasiswa</span>
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="grade" value="Siswa" required>
              <span class="ml-2">Siswa</span>
            </label>
          </div>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Unggah surat Permohonan PKL</label>
          <input type="file" name="file_surat" class="block w-full text-sm text-gray-500" required>
        </div>

        <div class="text-center pt-4">
          <button type="submit" class="w-full bg-purple-600 text-white font-semibold py-2 rounded hover:bg-purple-700">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000 // popup hilang setelah 2 detik
    }).then(() => {
        window.location.href = '/user';
    });
    </script>
 @endif


</body>
</html> --}}
