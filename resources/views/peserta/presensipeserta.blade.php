<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Presensi Peserta - PT Cipta Nirmala</title>
  <link rel="stylesheet" href="css/style1.css">
</head>
<body>
  
  <!-- Header -->
  <div class="header">
    Presensi Peserta - PT. CIPTA NIRMALA
  </div>
  
  <!-- Tab Navigation -->
  <div class="tab-buttons">
    <button id="tabCheckIn" class="active" onclick="switchTab('checkin')">Check In</button>
    <button id="tabCheckOut" onclick="switchTab('checkout')">Check Out</button>
  </div>
<a class="back-btn" href="/peserta">
  Kembali
  </a>
  <!-- Main Container -->
  <div class="container">

    <!-- Form Check In -->
    <div id="checkin" class="form-section">
      <form id="formCheckIn" onsubmit="event.preventDefault(); submitPresensi('Check In');">
        <h2>Form Check In</h2>
        <label>Tanggal</label>
        <p id="tanggalCheckIn"></p>

        <label>Status Kehadiran</label>
        <div class="radio-group">
          <label><input type="radio" name="statusIn" value="Hadir"> Hadir</label>
          <label><input type="radio" name="statusIn" value="Izin"> Izin</label>
          <label><input type="radio" name="statusIn" value="Tidak Hadir"> Tidak Hadir</label>
        </div>

        <div id="alasanInField" class="hidden">
          <label>Alasan</label>
          <input type="text" id="alasanInInput" placeholder="Tulis alasan...">
        </div>

        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </div>

    <!-- Form Check Out -->
    <div id="checkout" class="form-section hidden">
      <form id="formCheckOut" onsubmit="event.preventDefault(); submitPresensi('Check Out');">
        <h2>Form Check Out</h2>
        <label>Tanggal</label>
        <p id="tanggalCheckOut"></p>

        <label>Status Kehadiran</label>
        <div class="radio-group">
          <label><input type="radio" name="statusOut" value="Hadir"> Hadir</label>
          <label><input type="radio" name="statusOut" value="Izin"> Izin</label>
          <label><input type="radio" name="statusOut" value="Tidak Hadir"> Tidak Hadir</label>
        </div>

        <div id="alasanOutField" class="hidden">
          <label>Alasan</label>
          <input type="text" id="alasanOutInput" placeholder="Tulis alasan...">
        </div>

        <button type="submit" class="submit-btn">Submit</button>
      </form>
    </div>

    <!-- Riwayat Presensi -->
    <h2>Riwayat Presensi</h2>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Status</th>
          <th>Keterangan</th>
          <th>Alasan</th>
        </tr>
      </thead>
      <tbody id="tabelPresensi"></tbody>
    </table>
  </div>

  <script src="js/script.js"></script>
</body>
</html>
