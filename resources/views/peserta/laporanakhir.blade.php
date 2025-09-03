<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laporan Akhir Peserta</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>

  <div class="container">
    <a class="back-btn" href="{{ url('/peserta') }}">Kembali</a>

    <div class="section">
      <h2 class="title">Laporan Akhir</h2>

      @if(session('success'))
        <div class="alert-success">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('Laporan-Akhir.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label>Judul Laporan</label>
          <input type="text" name="judulLaporan" required placeholder="Masukkan judul laporan">
        </div>
        <div class="form-group">
          <label>Lampiran Laporan (PDF)</label>
          <input type="file" name="fileLaporan" accept=".pdf" required>
        </div>
        <div class="form-group">
          <label>PowerPoint</label>
          <input type="file" name="fileDokumen" accept=".ppt,.pptx" required>
        </div>
        <button type="submit" class="btn-submit">Submit</button>
      </form>
    </div>

    <div class="section">
      <h3 class="subheading">Riwayat Pengumpulan Tugas</h3>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Judul Laporan</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($laporans as $i => $laporan)
          <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $laporan->judul }}</td>
            <td>{{ $laporan->created_at->format('d-m-Y') }}</td>
            <td>{{ $laporan->created_at->format('H:i') }}</td>
            <td>{{ $laporan->status }}</td>
            <td>
              <a href="javascript:void(0)" onclick="showDetail('{{ $laporan->judul }}', '{{ asset('storage/'.$laporan->file_pdf_path) }}', '{{ asset('storage/'.$laporan->file_ppt_path) }}')">
                Lihat Detail
              </a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6">Belum ada laporan</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal -->
  <div id="detailModal" class="modal">
    <div class="modal-content">
      <span class="modal-close" onclick="closeModal()">&times;</span>
      <div class="modal-header" id="modalJudul"></div>
      <div class="modal-body">
        <p><b>File Laporan (PDF):</b> <a id="modalFileLaporan" href="#" target="_blank"></a></p>
        <p><b>File Dokumen (PPT):</b> <a id="modalFileDokumen" href="#" target="_blank"></a></p>
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
      document.getElementById('detailModal').style.display = 'flex';
    }

    function closeModal() {
      document.getElementById('detailModal').style.display = 'none';
    }

    window.onclick = function(event) {
      const modal = document.getElementById('detailModal');
      if (event.target == modal) {
        modal.style.display = "none";
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
      showClass: {
        popup: 'animate__animated animate__fadeInDown'
      },
      hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
      }
    });
  @endif
</script>

</body>
</html>
