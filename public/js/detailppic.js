    // Reset penempatan unit (bukan hapus baris)
    function hapusUnit(btn) {
      const row = btn.closest("tr");
      const unitSelect = row.querySelector("select");
      const nama = row.querySelector(".nama-peserta").innerText;

      if (confirm(`Hapus penempatan unit untuk ${nama}?`)) {
        unitSelect.disabled = false;
        unitSelect.value = "";
        btn.outerHTML = `<button onclick="konfirmasiPeserta(this)" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">Konfirmasi</button>`;
      }
    }

    // Fungsi filter unit
  function filterUnit() {
    const unit = document.getElementById("filterUnit").value.toLowerCase();
    const rows = document.querySelectorAll("#tabel-peserta tbody tr");

    rows.forEach(row => {
      const unitPenempatan = row.querySelector(".unit-penempatan").innerText.toLowerCase();
      row.style.display = (unit === "" || unitPenempatan === unit) ? "" : "none";
    });
  }

    // Fungsi pencarian nama / sekolah
    function cariPeserta() {
      const input = document.getElementById("searchText").value.toLowerCase();
      const rows = document.querySelectorAll("#tabel-peserta tbody tr");

      rows.forEach(row => {
        const nama = row.querySelector(".nama-peserta").innerText.toLowerCase();
        const sekolah = row.querySelector(".asal-sekolah").innerText.toLowerCase();
        row.style.display = (nama.includes(input) || sekolah.includes(input)) ? "" : "none";
      });
    }

// === POPUP DETAIL PESERTA ===
  const detailBtn = document.getElementById('detailBtn');
  const popupDetail = document.getElementById('popupDetail');
  const closeDetail = document.getElementById('closeDetail');

  // buka popup detail
  detailBtn.addEventListener('click', () => {
    popupDetail.style.display = 'flex';
  });

  // tutup popup detail
  closeDetail.addEventListener('click', () => {
    popupDetail.style.display = 'none';
  });

  // klik luar area untuk close
  window.addEventListener('click', (e) => {
    if (e.target === popupDetail) {
      popupDetail.style.display = 'none';
    }
  });

  // === TAB NAVBAR DALAM DETAIL PESERTA ===
  function switchTab(tab) {
    document.getElementById('content-profil').style.display = 'none';
    document.getElementById('content-laporan').style.display = 'none';
    document.getElementById('content-akhir').style.display = 'none';

    document.getElementById('tab-profil').classList.remove('active');
    document.getElementById('tab-laporan').classList.remove('active');
    document.getElementById('tab-akhir').classList.remove('active');

    if (tab === 'profil') {
      document.getElementById('content-profil').style.display = 'block';
      document.getElementById('tab-profil').classList.add('active');
    } else if (tab === 'laporan') {
      document.getElementById('content-laporan').style.display = 'block';
      document.getElementById('tab-laporan').classList.add('active');
    } else if (tab === 'akhir') {
      document.getElementById('content-akhir').style.display = 'block';
      document.getElementById('tab-akhir').classList.add('active');
    }
  }

  // === TAB PRESENSI ===
  function switchPresensi(tab) {
    document.getElementById('content-checkin').style.display = 'none';
    document.getElementById('content-checkout').style.display = 'none';

    document.getElementById('tab-checkin').classList.remove('active');
    document.getElementById('tab-checkout').classList.remove('active');

    if (tab === 'checkin') {
      document.getElementById('content-checkin').style.display = 'block';
      document.getElementById('tab-checkin').classList.add('active');
    } else if (tab === 'checkout') {
      document.getElementById('content-checkout').style.display = 'block';
      document.getElementById('tab-checkout').classList.add('active');
    }
  }

  // === SIDEBAR DETAIL ===
  function showContent(menu) {
    document.getElementById('content-detail').style.display = 'none';
    document.getElementById('content-presensi').style.display = 'none';

    document.getElementById('menu-detail').classList.remove('active');
    document.getElementById('menu-presensi').classList.remove('active');

    if (menu === 'detail') {
      document.getElementById('content-detail').style.display = 'block';
      document.getElementById('menu-detail').classList.add('active');
    } else if (menu === 'presensi') {
      document.getElementById('content-presensi').style.display = 'block';
      document.getElementById('menu-presensi').classList.add('active');
    }
  }


  // === RENDER DATA PRESENSI (contoh data check-in/out) ===
  const checkinData = [
    {tanggal:"2025-08-10", jam:"08:01", status:"Hadir", alasan:"-"},
    {tanggal:"2025-08-11", jam:"08:15", status:"Hadir", alasan:"Macet"},
    {tanggal:"2025-08-12", jam:"-", status:"Izin", alasan:"Demam"},
    {tanggal:"2025-08-13", jam:"-", status:"Tidak Hadir", alasan:"Tanpa Keterangan"},
    {tanggal:"2025-08-14", jam:"08:05", status:"Hadir", alasan:"-"},
  ];

  const tbody = document.getElementById("checkinTableBody");
  checkinData.forEach((row, i) => {
    tbody.innerHTML += `
      <tr>
        <td>${i+1}</td>
        <td>${row.tanggal}</td>
        <td>${row.jam}</td>
        <td>${row.status}</td>
        <td>Check In</td>
        <td>${row.alasan}</td>
      </tr>
    `;
  });

  // hitung statistik checkin
  function hitungStatistik(data) {
    const total = data.length;
    const hadir = data.filter(d => d.status === "Hadir").length;
    const izin = data.filter(d => d.status === "Izin").length;
    const tidakHadir = data.filter(d => d.status === "Tidak Hadir").length;

    document.getElementById("hadir-info").innerText = `${hadir} kali (${((hadir/total)*100).toFixed(1)}%)`;
    document.getElementById("izin-info").innerText = `${izin} kali (${((izin/total)*100).toFixed(1)}%)`;
    document.getElementById("tidak-hadir-info").innerText = `${tidakHadir} kali (${((tidakHadir/total)*100).toFixed(1)}%)`;
  }
  hitungStatistik(checkinData);

  // checkout
  const checkoutData = [
    {tanggal:"2025-08-10", jam:"16:02", status:"Hadir", alasan:"-"},
    {tanggal:"2025-08-11", jam:"16:10", status:"Hadir", alasan:"Lembur"},
    {tanggal:"2025-08-12", jam:"-", status:"Izin", alasan:"Sakit"},
    {tanggal:"2025-08-13", jam:"-", status:"Tidak Hadir", alasan:"Tanpa Keterangan"},
    {tanggal:"2025-08-14", jam:"16:05", status:"Hadir", alasan:"-"},
  ];

  const tbodyCheckout = document.getElementById("checkoutTableBody");
  checkoutData.forEach((row, i) => {
    tbodyCheckout.innerHTML += `
      <tr>
        <td>${i+1}</td>
        <td>${row.tanggal}</td>
        <td>${row.jam}</td>
        <td>${row.status}</td>
        <td>Check Out</td>
        <td>${row.alasan}</td>
      </tr>
    `;
  });

  function hitungStatistikCheckout(data) {
    const total = data.length;
    const hadir = data.filter(d => d.status === "Hadir").length;
    const izin = data.filter(d => d.status === "Izin").length;
    const tidakHadir = data.filter(d => d.status === "Tidak Hadir").length;

    document.getElementById("checkout-hadir-info").innerText = `${hadir} kali (${((hadir/total)*100).toFixed(1)}%)`;
    document.getElementById("checkout-izin-info").innerText = `${izin} kali (${((izin/total)*100).toFixed(1)}%)`;
    document.getElementById("checkout-tidak-hadir-info").innerText = `${tidakHadir} kali (${((tidakHadir/total)*100).toFixed(1)}%)`;
  }
  hitungStatistikCheckout(checkoutData);

  const inputs = document.querySelectorAll(".nilai");
  const form = document.getElementById("formPenilaian");
  const hasil = document.getElementById("hasilPenilaian");
  const tabelBody = document.getElementById("tabelPenilaian");
  const nilaiPesertaCell = document.querySelector(".nilai-peserta");

  // === Hitung rata-rata otomatis ===
  inputs.forEach(input => input.addEventListener("input", hitungRata));
  function hitungRata() {
    let nilai = [];
    inputs.forEach(input => {
      let val = parseFloat(input.value);
      if (!isNaN(val)) nilai.push(val);
    });
    let rata = nilai.length > 0 ? (nilai.reduce((a, b) => a + b, 0) / nilai.length) : 0;
    hasil.value = rata > 0 ? rata.toFixed(2) : "";
  }

  // === Simpan/update nilai ===
  form.addEventListener("submit", function(e) {
    e.preventDefault();
    let values = [];
    let valid = true;
    inputs.forEach(input => {
      let val = parseFloat(input.value);
      if (isNaN(val)) valid = false;
      values.push(isNaN(val) ? "-" : val);
    });
    if (!valid) {
      alert("Harap isi semua nilai!");
      return;
    }

    let rata = parseFloat(hasil.value) || 0;

    // Update daftar penilaian (popup)
    let existingRow = tabelBody.querySelector("tr");
    if (existingRow) {
      let cells = existingRow.querySelectorAll("td");
      values.forEach((v, i) => cells[i].textContent = v);
      cells[cells.length - 1].textContent = rata.toFixed(2);
    } else {
      let tr = document.createElement("tr");
      values.forEach(v => {
        let td = document.createElement("td");
        td.className = "border px-2 py-1";
        td.textContent = v;
        tr.appendChild(td);
      });
      let tdRata = document.createElement("td");
      tdRata.className = "border px-2 py-1 font-semibold";
      tdRata.textContent = rata.toFixed(2);
      tr.appendChild(tdRata);
      tabelBody.appendChild(tr);
    }

    // Update nilai di tabel utama
    if (nilaiPesertaCell) nilaiPesertaCell.textContent = rata.toFixed(2);

    // === Panggil fungsi update tanggal otomatis ===
    updateTanggalPenilaian();

    // Reset form
    form.reset();
    hasil.value = "";
  });

  // === POPUP NILAI ===
  const nilaiBtn = document.getElementById("nilaiBtn");
  const popupPenilaian = document.getElementById("popupPenilaian");
  const closePopupPenilaian = document.getElementById("closePopupPenilaian");

  nilaiBtn.addEventListener('click', () => {
    popupPenilaian.style.display = 'flex';
  });

  closePopupPenilaian.addEventListener('click', () => {
    popupPenilaian.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === popupPenilaian) {
      popupPenilaian.style.display = 'none';
    }
  });

  // === Script Tanggal Penilaian ===
  const updateTanggalPenilaian = () => {
    const today = new Date();
    const formattedDate = today.toLocaleDateString("id-ID", {
      day: "2-digit",
      month: "2-digit",
      year: "numeric"
    });

    const tanggalCell = document.querySelector(".tanggal-penilaian");
    if (tanggalCell) {
      tanggalCell.textContent = formattedDate;
    }
  };