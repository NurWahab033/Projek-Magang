{{-- resources/views/laporan/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laporan Harian Peserta</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-gray-50">
  <a class="back-btn" href="/peserta">Kembali</a>

  {{-- Notifikasi --}}
  @if(session('success'))
  <div id="notif" 
      class="fixed bottom-5 left-5 px-4 py-3 rounded-lg shadow-lg text-white bg-green-500 z-50
            transform transition-all duration-500 ease-out opacity-100 translate-y-0">
    ✅ {{ session('success') }}
  </div>

  <script>
    // Setelah 2 detik, notif fade out lalu hilang
    setTimeout(() => {
      const notif = document.getElementById('notif');
      if (notif) {
        notif.classList.add('opacity-0', 'translate-y-5'); // animasi hilang
        setTimeout(() => notif.remove(), 500); // hapus setelah animasi selesai
      }
    }, 2000);
  </script>
  @endif

  {{-- Form Tambah --}}
  <div class="section">
    <div class="title">Laporan Harian Peserta -- PT Cipta Nirmala</div>
    
    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="laporanJudul">Judul</label>
        <input type="text" id="laporanJudul" name="judul" placeholder="Laporan hari ke ..." required />
      </div>
      <div class="form-group">
        <label for="laporanText">Text</label>
        <textarea id="laporanText" name="isi" required></textarea>
      </div>
      <div class="form-group">
        <label for="file">Lampiran (opsional)</label>
        <input type="file" id="file" name="lampiran" />
      </div>
      <div style="text-align: center;">
        <button type="submit" class="btn-submit" style="width: 200px;">Submit</button>
      </div>
    </form>
  </div>

  {{-- Tabel Riwayat --}}
  <div class="section">
    <h3 class="title">Riwayat Pengumpulan Tugas</h3>
    <table id="riwayatTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Tanggal Pengumpulan</th>
          <th>Jam Pengumpulan</th>
          <th>Detail</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($laporan as $index => $item)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $item->judul }}</td>
          <td>{{ $item->tanggal_pengumpulan->format('d-m-Y') }}</td>
          <td>{{ \Carbon\Carbon::parse($item->jam_pengumpulan)->format('H:i') }}</td>
          <td>
            <a href="#" onclick="showDetail(`{{ $item->judul }}`, `{{ $item->isi }}`, `{{ $item->lampiran ?? '-' }}`)">Lihat Detail</a>
          </td>
          <td>
            <a href="javascript:void(0)" 
               onclick="openEditModal({{ $item->id }}, `{{ $item->judul }}`, `{{ $item->isi }}`, `{{ $item->lampiran ?? '' }}`)">
               Edit
            </a> | 
            <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('Yakin ingin menghapus laporan ini?')">Hapus</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center">Belum ada laporan</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Modal Detail --}}
  <div id="detailModal" class="modal" style="display:none;">
    <div class="modal-content">
      <span class="modal-close" onclick="closeModal()">&times;</span>
      <div class="modal-header" id="modalJudul"></div>
      <div class="modal-body" id="modalText"></div>
      <div><b>Lampiran:</b> <span id="modalFile"></span></div>
    </div>
  </div>

  {{-- Modal Edit --}}
  <div id="editModal" class="modal" style="display:none;">
    <div class="modal-content">
      <span class="modal-close" onclick="closeEditModal()">&times;</span>
      <h3>Edit Laporan</h3>
      <form id="editForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="editJudul">Judul</label>
          <input type="text" id="editJudul" name="judul" required />
        </div>
        <div class="form-group">
          <label for="editIsi">Isi</label>
          <textarea id="editIsi" name="isi" required></textarea>
        </div>
        <div class="form-group">
          <label for="editLampiran">Lampiran (opsional)</label>
          <input type="file" id="editLampiran" name="lampiran" />
          <p id="lampiranOld" class="text-sm text-gray-600"></p>
        </div>
        <button type="submit" class="btn-submit">Update</button>
      </form>
    </div>
  </div>

  <script>
    // Detail Modal
    function showDetail(judul, isi, file) {
      document.getElementById('modalJudul').textContent = judul;
      document.getElementById('modalText').textContent = isi;
      document.getElementById('modalFile').textContent = file;
      document.getElementById('detailModal').style.display = 'flex';
    }
    function closeModal() {
      document.getElementById('detailModal').style.display = 'none';
    }

    // Edit Modal
    function openEditModal(id, judul, isi, lampiran) {
      document.getElementById('editJudul').value = judul;
      document.getElementById('editIsi').value = isi;
      document.getElementById('lampiranOld').textContent = lampiran ? "Lampiran lama: " + lampiran : "Tidak ada lampiran";

      const form = document.getElementById('editForm');
      form.action = "/laporan/" + id;

      document.getElementById('editModal').style.display = 'flex';
    }
    function closeEditModal() {
      document.getElementById('editModal').style.display = 'none';
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
