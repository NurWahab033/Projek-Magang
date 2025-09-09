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
                <td class="px-4 py-3 font-medium text-gray-800 nama-peserta">{{ $peserta->formulirPendaftaran->nama_lengkap ?? '-' }}</td>
                <td class="px-4 py-3 grade">{{ $peserta->formulirPendaftaran->grade ?? '-' }}</td>
                <td class="px-4 py-3 asal-sekolah">{{ $peserta->formulirPendaftaran->nama_institusi ?? '-' }}</td>

                <!-- Kolom Select PIC -->
                <td class="px-4 py-3">
                  <form id="form-unit-{{ $peserta->id }}" action="{{ route('update.unit', $peserta->id) }}" method="POST">
                    @csrf
                    <select name="unit"
                      class="border border-gray-300 px-2 py-1 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400
                        {{ optional($peserta->detailuser)->unit ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                      {{ optional($peserta->detailuser)->unit ? 'disabled' : '' }}
                      title="{{ optional($peserta->detailuser)->unit ? 'Hapus PIC terlebih dahulu untuk mengubah' : 'Pilih PIC' }}">
                      <option value="">-- Pilih PIC --</option>
                      @foreach($picUsers as $pic)
                        <option value="{{ $pic->id }}" {{ optional($peserta->detailuser)->unit == $pic->id ? 'selected' : '' }}>
                          {{ $pic->username }} ({{ $pic->nama_institusi ?? 'Tidak ada institusi' }})
                        </option>
                      @endforeach
                    </select>
                  </form>
                </td>

                <!-- Kolom Aksi -->
                <td class="px-4 py-3 flex items-center justify-center gap-2">
                  @if(optional($peserta->detailuser)->unit)
                    <!-- Jika sudah punya PIC: hanya tombol Hapus PIC -->
                    <form action="{{ route('delete.unit', $peserta->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin hapus PIC dari peserta ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">
                        Hapus PIC
                      </button>
                    </form>
                  @else
                    <!-- Jika belum punya PIC: tombol Konfirmasi (submit form select) -->
                    <button type="button" onclick="konfirmasiPeserta(this)"
                      class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">
                      Konfirmasi
                    </button>
                  @endif

                  <!-- Tombol Detail Peserta selalu ada -->
                  <button id="detailBtn"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">
                    Detail Peserta
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Script kecil untuk konfirmasi -->
  <script>
    'use strict';

  function konfirmasiPeserta(btn) {
    const row = btn.closest('tr');
    if (!row) return;

    const select = row.querySelector('select[name="unit"]');
    if (!select) return;

    if (!select.value) {
      alert('Silakan pilih PIC terlebih dahulu.');
      select.focus();
      return;
    }

    if (!confirm('Simpan PIC yang dipilih untuk peserta ini?')) {
      return;
    }

    const form = select.form;
    if (form) form.submit();
  }

  function cariPeserta() {
    const input = document.getElementById("searchText").value.toLowerCase().trim();
    const rows = document.querySelectorAll("#tabel-peserta tbody tr");

    // bikin regex agar cocok kata utuh (misal "siswa" ≠ "mahasiswa")
    const regex = new RegExp("\\b" + input + "\\b", "i");

    rows.forEach(row => {
      const nama = row.querySelector(".nama-peserta")?.textContent.toLowerCase() || "";
      const sekolah = row.querySelector(".asal-sekolah")?.textContent.toLowerCase() || "";
      const grade = row.querySelector(".grade")?.textContent.toLowerCase() || "";

      // pecah per kata biar lebih presisi
      const namaWords = nama.split(/\s+/);
      const sekolahWords = sekolah.split(/\s+/);
      const gradeWords = grade.split(/\s+/);

      const matchNama = namaWords.some(w => regex.test(w));
      const matchSekolah = sekolahWords.some(w => regex.test(w));
      const matchGrade = gradeWords.some(w => regex.test(w));

      if (matchNama || matchSekolah || matchGrade) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  }
  </script>

</body>
</html>
