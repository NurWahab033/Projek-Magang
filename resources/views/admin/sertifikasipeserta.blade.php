<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sertifikasi Peserta - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
</head>

<body class="bg-gray-50">

  <!-- Header -->
  <div class="header bg-white border-b shadow px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <img src="/images/cipta nirmala.png" alt="Logo" class="h-12 w-auto">
      <h1 class="text-xl font-bold text-gray-800">PT. CIPTA NIRMALA</h1>
    </div>
  </div>

  <!-- Navbar -->
  <div class="navbar">
    <div class="navbar-left">
      <a href="/sertifikasi" class="navbar-link"> Sertifikasi Peserta</a>
    </div>
    <div class="navbar-right">
      <a href="/detailakun" class="navbar-link">Pendaftaran Akun Peserta & PIC</a>
      <a href="/monitoring" class="navbar-link">Monitoring Peserta Magang</a>
      <a href="/verifikasi" class="navbar-link">Verifikasi Peserta Magang</a>
      <a href="/admin" class="navbar-link">Kembali</a>
    </div>
  </div>

  <!-- Konten -->
  <div class="max-w-7xl mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Sertifikasi Peserta Magang</h2>

    <!-- Search & Filter -->
    <div class="mb-4 flex flex-col md:flex-row items-center gap-3">
      <!-- Search Nama -->
      <input
        type="text"
        id="searchInput"
        placeholder="Cari berdasarkan nama peserta..."
        class="w-full md:w-1/2 px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
      >

      <!-- Filter Tingkat -->
      <select
        id="filterTingkat"
        class="px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
      >
        <option value="">Semua Tingkat</option>
        <option value="Mahasiswa">Mahasiswa</option>
        <option value="Siswa">Siswa</option>
      </select>
    </div>


    <!-- Tabel -->
    <div class="overflow-x-auto bg-white rounded-lg shadow border">
      <table class="min-w-full text-sm text-left border-collapse">
        <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
          <tr>
            <th class="px-4 py-3 border">No</th>
            <th class="px-4 py-3 border">Nama Peserta</th>
            <th class="px-4 py-3 border">Tingkat</th>
            <th class="px-4 py-3 border">Institusi Asal</th>
            <th class="px-4 py-3 border">Tanggal Mulai</th>
            <th class="px-4 py-3 border">Tanggal Selesai</th>
            <th class="px-4 py-3 border">Nilai</th>
            <th class="px-4 py-3 border">Nomor Sertifikat</th>
            <th class="px-4 py-3 border">Tanggal Terbit</th>
            <th class="px-4 py-3 border">Status Sertifikat</th>
            <th class="px-4 py-3 border">Aksi</th>
          </tr>
        </thead>
            <tbody id="sertifikasiTable">
                @forelse($sertifikat as $s)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 border">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 border">{{ $s->formulir->nama_lengkap }}</td>
                    <td class="px-4 py-3 border">{{ $s->formulir->grade }}</td>
                    <td class="px-4 py-3 border">{{ $s->formulir->nama_institusi }}</td>
                    <td class="px-4 py-3 border">{{ \Carbon\Carbon::parse($s->formulir->tanggal_mulai_magang)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 border">{{ \Carbon\Carbon::parse($s->formulir->tanggal_selesai_magang)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 border">{{ $s->nilai ?? '-' }}</td>
                    <td class="px-4 py-3 border nomor-sertifikat">{{ $s->nomor_sertifikat ?? '-' }}</td>
                    <td class="px-4 py-3 border">
                        {{ $s->tanggal_terbit ? \Carbon\Carbon::parse($s->tanggal_terbit)->format('d/m/Y') : '-' }}
                    </td>
                    <td class="px-4 py-3 border text-center">
                        @if($s->status === 'izin terbit')
                            <form action="{{ route('sertifikat.terbit', $s->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm transition">
                                    Terbitkan
                                </button>
                            </form>
                        @elseif($s->status === 'tersedia')
                            <span class="text-gray-500">Sudah Diterbitkan</span>
                        @else
                            <span class="text-red-500">Belum Ada</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="px-4 py-3 border text-center text-gray-500">
                        Belum ada data sertifikat.
                    </td>
                </tr>
                @endforelse
            </tbody>
      </table>
    </div>
  </div>

  <script>
  let counterSertifikat = 1; // auto increment nomor sertifikat

  // Fungsi format tanggal
  function getToday() {
    const today = new Date();
    const d = String(today.getDate()).padStart(2, '0');
    const m = String(today.getMonth() + 1).padStart(2, '0');
    const y = today.getFullYear();
    return `${d}/${m}/${y}`;
  }

  // Fungsi format bulan.tahun
  function getMonthYear() {
    const today = new Date();
    const m = String(today.getMonth() + 1).padStart(2, '0');
    const y = today.getFullYear();
    return `${m}.${y}`;
  }

  // Fitur toggle izin sertifikat
  document.querySelectorAll(".izinBtn").forEach((btn) => {
    btn.addEventListener("click", function() {
      const row = btn.closest("tr");
      const statusCell = row.querySelector(".status-sertifikat");
      const nomorCell = row.querySelector(".nomor-sertifikat");
      const tanggalCell = row.querySelector(".tanggal-terbit");

      if (statusCell.textContent.includes("Belum")) {
        statusCell.textContent = "Sertifikat Tersedia";
        statusCell.classList.remove("text-red-600");
        statusCell.classList.add("text-green-600");

        // Format nomor sertifikat baru
        const nomorUrut = String(counterSertifikat).padStart(2, '0');
        nomorCell.textContent = `${nomorUrut}/KP.02.02/90006/${getMonthYear()}`;

        tanggalCell.textContent = getToday();
        counterSertifikat++;

        btn.textContent = "Batalkan";
        btn.classList.remove("bg-blue-500", "hover:bg-blue-600");
        btn.classList.add("bg-red-500", "hover:bg-red-600");
      } else {
        statusCell.textContent = "Sertifikat Belum Tersedia";
        statusCell.classList.remove("text-green-600");
        statusCell.classList.add("text-red-600");

        nomorCell.textContent = "-";
        tanggalCell.textContent = "-";

        btn.textContent = "Izin Terbit Sertifikat";
        btn.classList.remove("bg-red-500", "hover:bg-red-600");
        btn.classList.add("bg-blue-500", "hover:bg-blue-600");
      }
    });
  });

  // Fitur search & filter
  const searchInput = document.getElementById("searchInput");
  const filterTingkat = document.getElementById("filterTingkat");

  function filterTable() {
    const keyword = searchInput.value.toLowerCase();
    const tingkatFilter = filterTingkat.value.toLowerCase();
    const rows = document.querySelectorAll("#sertifikasiTable tr");

    rows.forEach(row => {
      const nama = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
      const tingkat = row.querySelector("td:nth-child(3)").textContent.toLowerCase();

      const matchNama = nama.includes(keyword);
      const matchTingkat = !tingkatFilter || tingkat === tingkatFilter;

      if (matchNama && matchTingkat) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  }

  searchInput.addEventListener("keyup", filterTable);
  filterTingkat.addEventListener("change", filterTable);
</script>

</body>
</html>
