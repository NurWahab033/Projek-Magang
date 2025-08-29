<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laporan Akhir Peserta</title>
  <link rel="stylesheet" href="css/style.css" />
  <style>
    /* Modal Styling */
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0; top: 0;
      width: 100%; height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5);
    }
    .modal-content {
      background: #fff;
      margin: 10% auto;
      padding: 20px;
      border-radius: 8px;
      width: 80%;
      max-width: 500px;
    }
    .modal-content h3 {
      margin-top: 0;
    }
    .close {
      float: right;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <a class="back-btn" href="/peserta">Kembali</a>

  <div class="section">
    <div class="title">Laporan Akhir Peserta -- PT Cipta Nirmala</div>
    
    <form id="laporanForm">
      <div class="form-group">
        <label for="judulLaporan">Judul Laporan</label>
        <input type="text" id="judulLaporan" name="judulLaporan" required placeholder="Masukkan judul laporan" />
      </div>
      <div class="form-group">
        <label for="fileLaporan">Lampiran Laporan</label>
        <input type="file" id="fileLaporan" name="fileLaporan" required />
      </div>
      <div class="form-group">
        <label for="fileDokumen">Powerpoint</label>
        <input type="file" id="fileDokumen" name="fileDokumen" required />
      </div>
      <button type="submit" class="btn-submit">Submit</button>
    </form>
  </div>

  <div class="section">
    <h3 class="title">Riwayat Pengumpulan Tugas</h3>
    <table id="riwayatTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Judul Laporan</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Status</th>
          <th>Detail Pengumpulan</th>
        </tr>
      </thead>
      <tbody>
        <!-- Baris laporan akan diisi lewat JavaScript -->
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div id="detailModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h3 id="modalJudul"></h3>
      <p><b>File Laporan:</b> <span id="modalFileLaporan"></span></p>
      <p><b>File Dokumen (PPT):</b> <span id="modalFileDokumen"></span></p>
    </div>
  </div>

  <script>
    const form = document.getElementById('laporanForm');
    const tableBody = document.querySelector('#riwayatTable tbody');
    let laporanList = [];

    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const judulLaporan = document.getElementById('judulLaporan').value.trim();
      const fileLaporanInput = document.getElementById('fileLaporan');
      const fileDokumenInput = document.getElementById('fileDokumen');

      const fileLaporan = fileLaporanInput.files[0] ? fileLaporanInput.files[0].name : '';
      const fileDokumen = fileDokumenInput.files[0] ? fileDokumenInput.files[0].name : '';
      const now = new Date();
      const tanggal = now.toLocaleDateString('id-ID');
      const jam = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
      const status = 'Terkirim';

      const laporan = { judulLaporan, fileLaporan, fileDokumen, tanggal, jam, status };
      laporanList.push(laporan);
      updateTable();
      form.reset();
    });

    function updateTable() {
      tableBody.innerHTML = '';
      laporanList.forEach((laporan, index) => {
        const row = document.createElement('tr');

        row.innerHTML = `
          <td>${index + 1}</td>
          <td>${laporan.judulLaporan}</td>
          <td>${laporan.tanggal}</td>
          <td>${laporan.jam}</td>
          <td>${laporan.status}</td>
          <td>
            <a href="#" onclick="showDetail(${index})">Lihat Detail</a>
          </td>
        `;
        tableBody.appendChild(row);
      });
    }

    function showDetail(index) {
      const laporan = laporanList[index];
      document.getElementById('modalJudul').textContent = laporan.judulLaporan;
      document.getElementById('modalFileLaporan').textContent = laporan.fileLaporan || '-';
      document.getElementById('modalFileDokumen').textContent = laporan.fileDokumen || '-';

      document.getElementById('detailModal').style.display = 'block';
    }

    function closeModal() {
      document.getElementById('detailModal').style.display = 'none';
    }

    // Tutup modal jika klik di luar konten
    window.onclick = function(event) {
      const modal = document.getElementById('detailModal');
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>
</html>
