<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laporan Akhir Peserta</title>
  <link rel="stylesheet" href="css/style.css" />
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
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Baris laporan akan diisi lewat JavaScript -->
      </tbody>
    </table>
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
            <a href="#" onclick="alert(
              'Judul: ${laporan.judulLaporan}\\n' +
              'File Laporan: ${laporan.fileLaporan}\\n' +
              'File Dokumen: ${laporan.fileDokumen}\\n' +
              'Jam: ${laporan.jam}'
            )">
              Lihat Detail
            </a>
          </td>
          <td>
            <a href="#" onclick="editLaporan(${index})">Edit Pengajuan</a> | 
            <a href="#" onclick="hapusLaporan(${index})">Hapus Pengajuan</a>
          </td>
        `;
        tableBody.appendChild(row);
      });
    }

    function editLaporan(index) {
      alert('Edit tidak tersedia karena tidak ada input teks. Hapus dan unggah ulang jika perlu.');
    }

    function hapusLaporan(index) {
      if (confirm("Yakin ingin menghapus pengajuan ini?")) {
        laporanList.splice(index, 1);
        updateTable();
      }
    }
  </script>

</body>
</html>
