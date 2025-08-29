function openTab(tab) {
      document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
      document.getElementById('content-' + tab).classList.remove('hidden');

      document.querySelectorAll('#tabs button').forEach(btn => {
        btn.classList.remove('text-purple-600','border-purple-600','text-green-600','border-green-600','border-b-2');
        btn.classList.add('text-gray-500');
      });
      if (tab === 'peserta') {
        document.getElementById('tab-peserta').classList.add('text-purple-600','border-b-2','border-purple-600');
      } else {
        document.getElementById('tab-pic').classList.add('text-green-600','border-b-2','border-green-600');
      }
    }

    function openModal(id) { document.getElementById(id).classList.add("active"); }
    function closeModal(id) { document.getElementById(id).classList.remove("active"); }

    function toggleMahasiswaFields() {
      const mahasiswaFields = document.getElementById("mahasiswa-fields");
      const gradeMahasiswa = document.querySelector('input[name="grade"][value="Mahasiswa"]');
      if (gradeMahasiswa.checked) {
        mahasiswaFields.classList.remove("hidden");
      } else {
        mahasiswaFields.classList.add("hidden");
      }
    }

    // Tambah akun peserta ke tabel
    document.getElementById("formAkunPeserta").addEventListener("submit", function(e) {
      e.preventDefault();
      const nama = this.nama.value;
      const email = this.email.value;
      const password = this.password.value;
      const institusi = this.institusi.value;

      const tbody = document.querySelector("#pesertaTable tbody");
      const row = `<tr>
        <td class="border px-4 py-2">${nama}</td>
        <td class="border px-4 py-2">${email}</td>
        <td class="border px-4 py-2">${password}</td>
        <td class="border px-4 py-2">${institusi}</td>
        <td class="border px-4 py-2 text-center">
          <button onclick="openModal('formulirPesertaModal')" class="bg-purple-600 text-white px-3 py-1 rounded">Tambah Formulir</button>
        </td>
        <td class="border px-4 py-2 text-center">
          <button onclick="openResetPasswordModal('${email}')" class="bg-purple-600 text-white px-3 py-1 rounded">Reset Password</button>
        </td>
      </tr>`;
      tbody.insertAdjacentHTML("beforeend", row);
      closeModal('formAkunPesertaModal');
      this.reset();
    });


        function openResetPasswordModal(email) {
      document.getElementById("resetEmail").value = email;
      openModal('resetpasspeserta');
    }

    // Simpan perubahan password
    document.getElementById("formResetPassPeserta").addEventListener("submit", function(e) {
      e.preventDefault();
      const email = document.getElementById("resetEmail").value;
      const newPass = document.getElementById("resetPassword").value;

      const rows = document.querySelector("#pesertaTable tbody").rows;
      for (let i = 0; i < rows.length; i++) {
        if (rows[i].cells[1].innerText === email) {  // kolom email ada di index ke-1
          rows[i].cells[2].innerText = newPass;     // kolom password ada di index ke-2
          break;
        }
      }

      closeModal('resetpasspeserta');
      this.reset();
    });


    // Tambah akun PIC ke tabel
    document.getElementById("formAkunPic").addEventListener("submit", function(e) {
      e.preventDefault();
      const nama = this.nama.value;
      const email = this.email.value;
      const password = this.password.value;
      const divisi = this.divisi.value;

      const tbody = document.querySelector("#picTable tbody");
      const row = `<tr>
          <td class="border px-4 py-2">${nama}</td>
          <td class="border px-4 py-2">${email}</td>
          <td class="border px-4 py-2">${password}</td>
          <td class="border px-4 py-2">${divisi}</td>
          <td class="border px-4 py-2 text-center">
          <button onclick="openResetPassPic('${email}')" class="bg-green-600 text-white px-3 py-1 rounded">Ganti Password</button>
          </td>
        </tr>`;
      tbody.insertAdjacentHTML("beforeend", row);
      closeModal('formAkunPicModal');
      this.reset();
    });

    // Buka modal reset password PIC dan isi email
    function openResetPassPic(email) {
      document.getElementById("resetEmailPic").value = email;
      openModal("resetpasspic");
    }

    // Proses simpan password baru PIC
    document.getElementById("formResetPassPic").addEventListener("submit", function(e) {
      e.preventDefault();
      const email = document.getElementById("resetEmailPic").value;
      const newPassword = document.getElementById("resetPasswordPic").value;

      const rows = document.querySelectorAll("#picTable tbody tr");
      rows.forEach(row => {
        const emailCell = row.cells[1].textContent;
        if (emailCell === email) {
          row.cells[2].textContent = newPassword; // update kolom password
        }
      });

      closeModal("resetpasspic");
      this.reset();
    });