let counter = 1;

    document.addEventListener("DOMContentLoaded", () => {
      const today = new Date().toLocaleDateString("id-ID");
      document.getElementById("tanggalCheckIn").textContent = today;
      document.getElementById("tanggalCheckOut").textContent = today;

      document.querySelectorAll("input[name='statusIn']").forEach(r => {
        r.addEventListener("change", () => {
          const show = r.value === "Izin" || r.value === "Tidak Hadir";
          document.getElementById("alasanInField").classList.toggle("hidden", !show);
        });
      });

      document.querySelectorAll("input[name='statusOut']").forEach(r => {
        r.addEventListener("change", () => {
          const show = r.value === "Izin" || r.value === "Tidak Hadir";
          document.getElementById("alasanOutField").classList.toggle("hidden", !show);
        });
      });
    });

    function switchTab(tab) {
      document.getElementById("checkin").classList.add("hidden");
      document.getElementById("checkout").classList.add("hidden");
      document.getElementById("tabCheckIn").classList.remove("active");
      document.getElementById("tabCheckOut").classList.remove("active");

      if (tab === "checkin") {
        document.getElementById("checkin").classList.remove("hidden");
        document.getElementById("tabCheckIn").classList.add("active");
      } else {
        document.getElementById("checkout").classList.remove("hidden");
        document.getElementById("tabCheckOut").classList.add("active");
      }
    }

    function submitPresensi(keterangan) {
      const date = new Date();
      const tanggal = date.toLocaleDateString("id-ID");
      const jam = date.toLocaleTimeString("id-ID");
      let status, alasan;

      if (keterangan === "Check In") {
        status = document.querySelector("input[name='statusIn']:checked");
        alasan = document.getElementById("alasanInInput").value.trim();
      } else {
        status = document.querySelector("input[name='statusOut']:checked");
        alasan = document.getElementById("alasanOutInput").value.trim();
      }

      if (!status) {
        alert("Silakan pilih status kehadiran!");
        return;
      }

      if ((status.value === "Izin" || status.value === "Tidak Hadir") && alasan === "") {
        alert("Alasan wajib diisi untuk status " + status.value);
        return;
      }

      const row = document.createElement("tr");
      row.innerHTML = `
        <td>${counter++}</td>
        <td>${tanggal}</td>
        <td>${jam}</td>
        <td>${status.value}</td>
        <td>${keterangan}</td>
        <td>${(status.value === "Izin" || status.value === "Tidak Hadir") ? alasan : '-'}</td>
      `;
      document.getElementById("tabelPresensi").appendChild(row);

      // Reset
      if (keterangan === "Check In") {
        document.getElementById("formCheckIn").reset();
        document.getElementById("alasanInField").classList.add("hidden");
      } else {
        document.getElementById("formCheckOut").reset();
        document.getElementById("alasanOutField").classList.add("hidden");
      }
    }