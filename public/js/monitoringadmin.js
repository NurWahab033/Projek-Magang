// Konfirmasi penempatan unit
    function konfirmasiPeserta(btn) {
      const row = btn.closest("tr");
      const nama = row.querySelector(".nama-peserta").innerText;
      const unitSelect = row.querySelector("select");
      const unit = unitSelect.value;

      if (unit === "") {
        alert("Silakan pilih unit terlebih dahulu.");
        return;
      }

      if (confirm(`Apakah Anda yakin menempatkan ${nama} ke unit ${unit}?`)) {
        unitSelect.disabled = true;
        btn.outerHTML = `<button onclick="hapusUnit(this)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">Hapus</button>`;
      }
    }

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

    // Fungsi pencarian nama / sekolah
    function cariPeserta() {
    const input = document.getElementById("searchText").value.toLowerCase().trim();
    const rows = document.querySelectorAll("#tabel-peserta tbody tr");

    rows.forEach(row => {
      const nama = row.querySelector(".nama-peserta").innerText.toLowerCase().split(/\s+/);
      const sekolah = row.querySelector(".asal-sekolah").innerText.toLowerCase().split(/\s+/);
      const grade = row.querySelector(".grade").innerText.toLowerCase().split(/\s+/);

      const allWords = [...nama, ...sekolah, ...grade];

      row.style.display = allWords.includes(input) ? "" : "none";
    });
  }

    // Fungsi filter unit
    function filterUnit() {
      const unit = document.getElementById("filterUnit").value.toLowerCase();
      const rows = document.querySelectorAll("#tabel-peserta tbody tr");

      rows.forEach(row => {
        const unitSelect = row.querySelector("select");
        const unitPenempatan = unitSelect.value.toLowerCase();
        row.style.display = (unit === "" || unitPenempatan === unit) ? "" : "none";
      });
    }

  const detailBtn = document.getElementById('detailBtn');
  const popupOverlay = document.getElementById('popupOverlay');
  const closePopup = document.getElementById('closePopup');

  // buka popup
  detailBtn.addEventListener('click', () => {
    popupOverlay.style.display = 'flex';
  });

  // tutup popup
  closePopup.addEventListener('click', () => {
    popupOverlay.style.display = 'none';
  });

  // klik luar area popup untuk close
  window.addEventListener('click', (e) => {
    if (e.target === popupOverlay) {
      popupOverlay.style.display = 'none';
    }
  });

  // fungsi tab navbar dalam detail peserta
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

  // fungsi tab presensi
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

  // fungsi sidebar
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

  function showDetail(judul) {
    alert("Menampilkan detail untuk: " + judul);
    // Bisa diganti popup card sama seperti detail peserta
  }


  // Contoh data check-in
  const checkinData = [
    {tanggal:"2025-08-10", jam:"08:01", status:"Hadir", alasan:"-"},
    {tanggal:"2025-08-11", jam:"08:15", status:"Hadir", alasan:"Macet"},
    {tanggal:"2025-08-12", jam:"-", status:"Izin", alasan:"Demam"},
    {tanggal:"2025-08-13", jam:"-", status:"Tidak Hadir", alasan:"Tanpa Keterangan"},
    {tanggal:"2025-08-14", jam:"08:05", status:"Hadir", alasan:"-"},
  ];

  // Render tabel (keterangan otomatis "Check In")
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

  // Hitung jumlah & persentase
  function hitungStatistik(data) {
    const total = data.length;
    const hadir = data.filter(d => d.status === "Hadir").length;
    const izin = data.filter(d => d.status === "Izin").length;
    const tidakHadir = data.filter(d => d.status === "Tidak Hadir").length;

    // Update tampilan (jumlah + persen)
    document.getElementById("hadir-info").innerText = `${hadir} kali (${((hadir/total)*100).toFixed(1)}%)`;
    document.getElementById("izin-info").innerText = `${izin} kali (${((izin/total)*100).toFixed(1)}%)`;
    document.getElementById("tidak-hadir-info").innerText = `${tidakHadir} kali (${((tidakHadir/total)*100).toFixed(1)}%)`;
  }
  hitungStatistik(checkinData);

  // Contoh data check-out
  const checkoutData = [
    {tanggal:"2025-08-10", jam:"16:02", status:"Hadir", alasan:"-"},
    {tanggal:"2025-08-11", jam:"16:10", status:"Hadir", alasan:"Lembur"},
    {tanggal:"2025-08-12", jam:"-", status:"Izin", alasan:"Sakit"},
    {tanggal:"2025-08-13", jam:"-", status:"Tidak Hadir", alasan:"Tanpa Keterangan"},
    {tanggal:"2025-08-14", jam:"16:05", status:"Hadir", alasan:"-"},
  ];

  // Render tabel (keterangan otomatis "Check Out")
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

  // Hitung jumlah & persentase
  function hitungStatistikCheckout(data) {
    const total = data.length;
    const hadir = data.filter(d => d.status === "Hadir").length;
    const izin = data.filter(d => d.status === "Izin").length;
    const tidakHadir = data.filter(d => d.status === "Tidak Hadir").length;

    // Update tampilan (jumlah + persen)
    document.getElementById("checkout-hadir-info").innerText = `${hadir} kali (${((hadir/total)*100).toFixed(1)}%)`;
    document.getElementById("checkout-izin-info").innerText = `${izin} kali (${((izin/total)*100).toFixed(1)}%)`;
    document.getElementById("checkout-tidak-hadir-info").innerText = `${tidakHadir} kali (${((tidakHadir/total)*100).toFixed(1)}%)`;
  }
  hitungStatistikCheckout(checkoutData);