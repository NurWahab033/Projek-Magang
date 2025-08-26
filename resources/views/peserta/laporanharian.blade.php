<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laporan Harian Peserta</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <a class="back-btn" href="/peserta">Kembali</a>

  <div class="section">
    <div class="title">Laporan Harian Peserta -- PT Cipta Nirmala</div>
    
    <form id="laporanForm">
      <div class="form-group">
        <label for="laporanJudul">Judul</label>
        <input type="text" id="laporanJudul" name="laporanJudul" required />
      </div>
      <div class="form-group">
        <label for="laporanText">Text</label>
        <textarea id="laporanText" name="laporanText" required></textarea>
      </div>
      <div class="form-group">
        <label for="file">Lampiran (opsional)</label>
        <input type="file" id="file" name="file" />
      </div>
      <div style="text-align: center;">
        <button type="submit" class="btn-submit" style="width: 200px;">Submit</button>
      </div>
    </form>
  </div>

  <div class="section">
    <h3 class="title">Riwayat Pengumpulan Tugas</h3>
    <table id="riwayatTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Judul</th>
          <th>Tanggal Pengumpulan</th>
          <th>Jam Pengumpulan</th>
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

      const judul = document.getElementById('laporanJudul').value;
      const text = document.getElementById('laporanText').value;
      const fileInput = document.getElementById('file');
      const fileName = fileInput.files[0] ? fileInput.files[0].name : '';
      const now = new Date();
      const tanggal = now.toLocaleDateString('id-ID');
      const jam = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
      const status = 'Terkirim';

      const laporan = { judul, text, fileName, tanggal, jam, status };
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
          <td>${laporan.judul}</td>
          <td>${laporan.tanggal}</td>
          <td>${laporan.jam}</td>
          <td>${laporan.status}</td>
          <td>
            <a href="#" onclick="alert('Judul: ${laporan.judul}\\nIsi Laporan:\\n${laporan.text}\\nLampiran: ${laporan.fileName || '-'}')">Lihat Detail</a>
          </td>
          <td>
            <a href="#" onclick="editLaporan(${index})">Edit</a> |
            <a href="#" onclick="hapusLaporan(${index})">Hapus</a>
          </td>
        `;
        tableBody.appendChild(row);
      });
    }

    function editLaporan(index) {
      const laporan = laporanList[index];
      document.getElementById('laporanJudul').value = laporan.judul;
      document.getElementById('laporanText').value = laporan.text;
      laporanList.splice(index, 1); // Hapus entri lama
      updateTable();
      window.scrollTo({ top: 0, behavior: 'smooth' });
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
