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


      function openResetPasswordModal(email) {
      document.getElementById("resetEmail").value = email;
      openModal('resetpasspeserta');
    }

    closeModal('resetpasspeserta');
      this.reset();

    // Buka modal reset password PIC dan isi email
    function openResetPassPic(email) {
      document.getElementById("resetEmailPic").value = email;
      openModal("resetpasspic");
    }

    closeModal("resetpasspic");
      this.reset();