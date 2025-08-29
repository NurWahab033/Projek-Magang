let counter = 1;

  document.addEventListener("DOMContentLoaded", () => {
    const today = new Date().toLocaleDateString("id-ID");
    document.getElementById("tanggalCheckIn").textContent = today;
    document.getElementById("tanggalCheckOut").textContent = today;

    // Status Check In
    document.querySelectorAll("input[name='statusIn']").forEach(r => {
      r.addEventListener("change", () => {
        const show = r.value === "Izin"; // hanya muncul kalau Izin
        document.getElementById("alasanInField").classList.toggle("hidden", !show);
      });
    });

    // Status Check Out
    document.querySelectorAll("input[name='statusOut']").forEach(r => {
      r.addEventListener("change", () => {
        const show = r.value === "Izin"; // hanya muncul kalau Izin
        document.getElementById("alasanOutField").classList.toggle("hidden", !show);
      });
    });
  });

  function switchTab(tab) {
    document.getElementById("checkin").classList.add("hidden");
    document.getElementById("checkout").classList.add("hidden");
    document.getElementById("tabCheckIn").classList.remove("border-purple-500", "text-purple-500");
    document.getElementById("tabCheckOut").classList.remove("border-purple-500", "text-purple-500");

    if (tab === "checkin") {
      document.getElementById("checkin").classList.remove("hidden");
      document.getElementById("tabCheckIn").classList.add("border-purple-500", "text-purple-500");
    } else {
      document.getElementById("checkout").classList.remove("hidden");
      document.getElementById("tabCheckOut").classList.add("border-purple-500", "text-purple-500");
    }
  }

  function submitPresensi(keterangan) {
    const date = new Date();
    const tanggal = date.toLocaleDateString("id-ID");
    const jam = date.toLocaleTimeString("id-ID");
    let status, alasan = "-";

    if (keterangan === "Check In") {
      status = document.querySelector("input[name='statusIn']:checked");
      if (status?.value === "Izin") {
        alasan = document.getElementById("alasanInInput").value.trim();
      } else if (status?.value === "Tidak Hadir") {
        alasan = "Alpha";
      }
    } else {
      status = document.querySelector("input[name='statusOut']:checked");
      if (status?.value === "Izin") {
        alasan = document.getElementById("alasanOutInput").value.trim();
      } else if (status?.value === "Tidak Hadir") {
        alasan = "Alpha";
      }
    }

    if (!status) {
      alert("Silakan pilih status kehadiran!");
      return;
    }

    if (status.value === "Izin" && alasan === "") {
      alert("Alasan wajib diisi untuk status Izin");
      return;
    }

    const row = document.createElement("tr");
    row.innerHTML = `
      <td class="px-4 py-2">${counter++}</td>
      <td class="px-4 py-2">${tanggal}</td>
      <td class="px-4 py-2">${jam}</td>
      <td class="px-4 py-2">
        <span class="px-2 py-1 rounded-full text-white text-xs 
          ${status.value === 'Hadir' ? 'bg-green-500' : 
            status.value === 'Izin' ? 'bg-yellow-500' : 
            'bg-red-500'}">
          ${status.value}
        </span>
      </td>
      <td class="px-4 py-2">${keterangan}</td>
      <td class="px-4 py-2">${alasan}</td>
    `;
    document.getElementById("tabelPresensi").appendChild(row);

    // Reset form
    if (keterangan === "Check In") {
      document.getElementById("formCheckIn").reset();
      document.getElementById("alasanInField").classList.add("hidden");
    } else {
      document.getElementById("formCheckOut").reset();
      document.getElementById("alasanOutField").classList.add("hidden");
    }
  }