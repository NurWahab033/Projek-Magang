<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laporan Harian Peserta</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
  <div class="max-w-5xl mx-auto px-4 py-8">

    <!-- Tombol Kembali -->
    <a href="/peserta" 
       class="inline-block mb-6 px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700 transition">
      ← Kembali
    </a>

    {{-- Notifikasi --}}
    @if(session('success'))
    <div id="notif" 
        class="fixed bottom-5 left-5 px-4 py-3 rounded-lg shadow-lg text-white bg-green-500 z-50
              transform transition-all duration-500 ease-out opacity-100 translate-y-0">
      ✅ {{ session('success') }}
    </div>

    <script>
      setTimeout(() => {
        const notif = document.getElementById('notif');
        if (notif) {
          notif.classList.add('opacity-0', 'translate-y-5');
          setTimeout(() => notif.remove(), 500);
        }
      }, 2000);
    </script>
    @endif

    <!-- Form Tambah -->
    <div class="bg-white shadow-md rounded-xl p-6 mb-10">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">
        📝 Laporan Harian Peserta — PT Cipta Nirmala
      </h2>
      
      <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div>
          <label for="laporanJudul" class="block font-medium text-gray-700 mb-1">Judul</label>
          <input type="text" id="laporanJudul" name="judul" placeholder="Laporan hari ke ..." required
                 class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
        </div>
        <div>
          <label for="laporanText" class="block font-medium text-gray-700 mb-1">Text</label>
          <textarea id="laporanText" name="isi" rows="4" required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"></textarea>
        </div>
        <div>
          <label for="file" class="block font-medium text-gray-700 mb-1">Lampiran (opsional)</label>
          <input type="file" id="file" name="lampiran"
                 class="w-full rounded-lg border-gray-300 shadow-sm file:mr-4 file:py-2 file:px-4 
                        file:rounded-lg file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
        </div>
        <div class="text-center">
          <button type="submit" class="w-48 py-2 px-4 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
            Submit
          </button>
        </div>
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
              <th class="px-4 py-3">Judul</th>
              <th class="px-4 py-3">Tanggal</th>
              <th class="px-4 py-3">Jam</th>
              <th class="px-4 py-3">Detail</th>
              <th class="px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @forelse($laporan as $index => $item)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-3">{{ $index + 1 }}</td>
              <td class="px-4 py-3 font-medium">{{ $item->judul }}</td>
              <td class="px-4 py-3">{{ $item->tanggal_pengumpulan->format('d-m-Y') }}</td>
              <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->jam_pengumpulan)->format('H:i') }}</td>
              <td class="px-4 py-3">
                <button onclick="showDetail(`{{ $item->judul }}`, `{{ $item->isi }}`, `{{ $item->lampiran ?? '-' }}`)" 
                        class="text-indigo-600 hover:underline">Lihat Detail</button>
              </td>
              <td class="px-4 py-3 space-x-2">
                <button onclick="openEditModal({{ $item->id }}, `{{ $item->judul }}`, `{{ $item->isi }}`, `{{ $item->lampiran ?? '' }}`)" 
                        class="text-yellow-600 hover:underline">Edit</button>
                <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Yakin ingin menghapus laporan ini?')" 
                          class="text-red-600 hover:underline">Hapus</button>
                </form>
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

  <!-- Modal Detail -->
  <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
      <button class="absolute top-3 right-3 text-gray-400 hover:text-gray-600" onclick="closeModal()">&times;</button>
      <h3 id="modalJudul" class="text-lg font-bold text-gray-800 mb-3"></h3>
      <p id="modalText" class="mb-3 text-gray-700"></p>
      <div><b>Lampiran:</b> <span id="modalFile" class="text-gray-600"></span></div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
      <button class="absolute top-3 right-3 text-gray-400 hover:text-gray-600" onclick="closeEditModal()">&times;</button>
      <h3 class="text-lg font-bold text-gray-800 mb-4">Edit Laporan</h3>
      <form id="editForm" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
          <label for="editJudul" class="block font-medium text-gray-700 mb-1">Judul</label>
          <input type="text" id="editJudul" name="judul" required
                 class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
        </div>
        <div>
          <label for="editIsi" class="block font-medium text-gray-700 mb-1">Isi</label>
          <textarea id="editIsi" name="isi" rows="4" required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"></textarea>
        </div>
        <div>
          <label for="editLampiran" class="block font-medium text-gray-700 mb-1">Lampiran (opsional)</label>
          <input type="file" id="editLampiran" name="lampiran"
                 class="w-full rounded-lg border-gray-300 shadow-sm file:mr-4 file:py-2 file:px-4 
                        file:rounded-lg file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
          <p id="lampiranOld" class="text-sm text-gray-600 mt-1"></p>
        </div>
        <div class="text-right">
          <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Detail Modal
    function showDetail(judul, isi, file) {
      document.getElementById('modalJudul').textContent = judul;
      document.getElementById('modalText').textContent = isi;
      document.getElementById('modalFile').textContent = file;
      document.getElementById('detailModal').classList.remove('hidden');
      document.getElementById('detailModal').classList.add('flex');
    }
    function closeModal() {
      document.getElementById('detailModal').classList.add('hidden');
      document.getElementById('detailModal').classList.remove('flex');
    }

    // Edit Modal
    function openEditModal(id, judul, isi, lampiran) {
      document.getElementById('editJudul').value = judul;
      document.getElementById('editIsi').value = isi;
      document.getElementById('lampiranOld').textContent = lampiran ? "Lampiran lama: " + lampiran : "Tidak ada lampiran";
      document.getElementById('editForm').action = "/laporan/" + id;
      document.getElementById('editModal').classList.remove('hidden');
      document.getElementById('editModal').classList.add('flex');
    }
    function closeEditModal() {
      document.getElementById('editModal').classList.add('hidden');
      document.getElementById('editModal').classList.remove('flex');
    }

    // Close modal on outside click
    window.onclick = function(event) {
      const detail = document.getElementById('detailModal');
      const edit = document.getElementById('editModal');
      if (event.target === detail) closeModal();
      if (event.target === edit) closeEditModal();
    }
  </script>
</body>
</html>
