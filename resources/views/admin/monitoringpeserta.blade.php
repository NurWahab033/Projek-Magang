{{-- resources/views/monitoring/index.blade.php --}}
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
      <a href="/monitoring" class="navbar-link">Monitoring Peserta Magang</a>
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
      <input id="searchText" type="text" placeholder="Cari berdasarkan nama / sekolah / tingkat"
        class="border border-gray-300 px-3 py-2 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400 flex-1">

      <button onclick="cariPeserta()" 
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow font-medium">
        Cari
      </button>
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
              <th class="px-4 py-3">Penempatan Unit (PIC)</th>
              <th class="px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($pesertas as $index => $peserta)
              <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3 font-medium text-gray-800 nama-peserta">{{ $peserta->username }}</td>
                <td class="px-4 py-3 grade">{{ $peserta->formulirPendaftaran->grade ?? '-' }}</td>
                <td class="px-4 py-3 asal-sekolah">{{ $peserta->formulirPendaftaran->nama_institusi ?? '-' }}</td>
                <td class="px-4 py-3">
                  <form action="{{ route('update.unit', $peserta->id) }}" method="POST">
                    @csrf
                    <select name="unit" onchange="this.form.submit()"
                      class="border border-gray-300 px-2 py-1 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400">
                      <option value="">-- Pilih PIC --</option>
                      @foreach($picUsers as $pic)
                        <option value="{{ $pic->id }}" {{ optional($peserta->detailuser)->unit == $pic->id ? 'selected' : '' }}>
                          {{ $pic->username }} ({{ $pic->nama_institusi ?? 'Tidak ada institusi' }})
                        </option>
                      @endforeach
                    </select>
                  </form>
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

                  <!-- Tombol Hapus PIC -->
                <form action="{{ route('delete.unit', $peserta->id) }}" method="POST" onsubmit="return confirm('Yakin hapus PIC dari peserta ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">
                    Hapus PIC
                  </button>
                </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
</html>
