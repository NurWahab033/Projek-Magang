let keterangan = "Check In";
let presensiCount = 1;

document.addEventListener("DOMContentLoaded", () => {
  const now = new Date();
  document.getElementById("tanggalSekarang").textContent = now.toLocaleDateString("id-ID");

  // Tampilkan input alasan jika "Izin" dipilih
  document.querySelectorAll("input[name='status']").forEach((radio) => {
    radio.addEventListener("change", () => {
      const alasanField = document.getElementById("alasanField");
      if (radio.value === "Izin") {
        alasanField.classList.remove("hidden");
      } else {
        alasanField.classList.add("hidden");
        document.getElementById("alasanInput").value = "";
      }
    });
  });
});

function setKeterangan(val) {
  keterangan = val;
}

function ajukanPresensi() {
  const status = document.querySelector("input[name='status']:checked");
  const alasan = document.getElementById("alasanInput").value;
  const now = new Date();
  const jam = now.toLocaleTimeString("id-ID");
  const tanggal = now.toLocaleDateString("id-ID");

  if (!status) {
    alert("Silakan pilih status kehadiran!");
    return;
  }

  if (status.value === "Izin" && alasan.trim() === "") {
    alert("Alasan wajib diisi untuk status Izin!");
    return;
  }

  const row = document.createElement("tr");
  row.innerHTML = `
    <td>${presensiCount++}</td>
    <td>${tanggal}</td>
    <td>${jam}</td>
    <td>${status.value}</td>
    <td>${keterangan}</td>
    <td>${status.value === "Izin" ? alasan : '-'}</td>
  `;

  document.getElementById("tabelPresensi").appendChild(row);

  // Reset form
  document.getElementById("presensiForm").reset();
  document.getElementById("alasanField").classList.add("hidden");
}
