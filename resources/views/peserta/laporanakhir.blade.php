<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laporan Akhir Peserta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="bg-gray-50 font-sans">
  <div class="max-w-5xl mx-auto px-4 py-8">
    <!-- Tombol Kembali -->
    <a href="{{ url('/peserta') }}" 
       class="inline-block mb-6 px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700 transition">
      ← Kembali
    </a>

    <!-- Form Upload -->
    <div class="bg-white shadow-md rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">📄 Laporan Akhir</h2>

      @if(session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-lg">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('Laporan-Akhir.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div>
          <label class="block font-medium text-gray-700 mb-1">Judul Laporan</label>
          <input type="text" name="judulLaporan" required placeholder="Masukkan judul laporan"
            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
        </div>
        <div>
          <label class="block font-medium text-gray-700 mb-1">Lampiran Laporan (PDF)</label>
          <input type="file" name="fileLaporan" accept=".pdf" required
            class="w-full rounded-lg border-gray-300 shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
        </div>
        <div>
          <label class="block font-medium text-gray-700 mb-1">PowerPoint</label>
          <input type="file" name="fileDokumen" accept=".ppt,.pptx" required
            class="w-full rounded-lg border-gray-300 shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
        </div>
        <button type="submit" 
          class="w-full py-2 px-4 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
          Submit
        </button>
      </form>
    </div>

    <!-- Tabel Riwayat -->
    <div class="bg-white shadow-md rounded-xl p-6">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">📑 Riwayat Pengumpulan Tugas</h3>
      <div class="overflow-x-auto">
        <table class="w-full border-collapse text-sm text-left text-gray-700">
          <thead class="bg-gray-100 text-gray-800 uppercase text-xs">
            <tr>
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Judul Laporan</th>
              <th class="px-4 py-3">Tanggal</th>
              <th class="px-4 py-3">Jam</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @forelse($laporans as $i => $laporan)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-3">{{ $i+1 }}</td>
              <td class="px-4 py-3 font-medium">{{ $laporan->judul }}</td>
              <td class="px-4 py-3">{{ $laporan->created_at->format('d-m-Y') }}</td>
              <td class="px-4 py-3">{{ $laporan->created_at->format('H:i') }}</td>
              <td class="px-4 py-3">
                <span class="px-2 py-1 rounded-full text-xs font-medium 
                  {{ $laporan->status == 'Disetujui' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                  {{ $laporan->status }}
                </span>
              </td>
              <td class="px-4 py-3">
                <button onclick="showDetail('{{ $laporan->judul }}', '{{ asset('storage/'.$laporan->file_pdf_path) }}', '{{ asset('storage/'.$laporan->file_ppt_path) }}')" 
                        class="text-indigo-600 hover:underline">
                  Lihat Detail
                </button>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="px-4 py-3 text-center text-gray-500">Belum ada laporan</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
      <button class="absolute top-3 right-3 text-gray-400 hover:text-gray-600" onclick="closeModal()">&times;</button>
      <h3 id="modalJudul" class="text-lg font-bold text-gray-800 mb-4"></h3>
      <div class="space-y-3">
        <p><b>File Laporan (PDF):</b> <a id="modalFileLaporan" href="#" target="_blank" class="text-indigo-600 hover:underline"></a></p>
        <p><b>File Dokumen (PPT):</b> <a id="modalFileDokumen" href="#" target="_blank" class="text-indigo-600 hover:underline"></a></p>
      </div>
    </div>
  </div>

  <script>
    function showDetail(judul, filePdf, filePpt) {
      document.getElementById('modalJudul').textContent = judul;
      document.getElementById('modalFileLaporan').textContent = filePdf.split('/').pop();
      document.getElementById('modalFileLaporan').href = filePdf;
      document.getElementById('modalFileDokumen').textContent = filePpt.split('/').pop();
      document.getElementById('modalFileDokumen').href = filePpt;
      document.getElementById('detailModal').classList.remove('hidden');
      document.getElementById('detailModal').classList.add('flex');
    }

    function closeModal() {
      document.getElementById('detailModal').classList.add('hidden');
      document.getElementById('detailModal').classList.remove('flex');
    }

    window.onclick = function(event) {
      const modal = document.getElementById('detailModal');
      if (event.target === modal) {
        closeModal();
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    @if(session('success'))
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
        toast: true,
        position: 'top-end',
        background: '#f0f9ff',
        color: '#0f766e',
        showClass: { popup: 'animate__animated animate__fadeInDown' },
        hideClass: { popup: 'animate__animated animate__fadeOutUp' }
      });
    @endif
  </script>
</body>
</html>
