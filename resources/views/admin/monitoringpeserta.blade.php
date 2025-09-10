{{-- resources/views/monitoring/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Monitoring Peserta Magang - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/monitoring.css">
</head>

<body class="bg-gray-50 text-sm">
  <!-- Header -->
  <div class="header bg-white border-b shadow px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <img src="/images/cipta nirmala.png" alt="Logo" class="h-12 w-auto">
      <h1 class="text-xl font-bold text-gray-800">PT. CIPTA NIRMALA</h1>
    </div>
  </div>

  <!-- Navbar Utama -->
  <div class="navbar">
    <div class="navbar-left">
      <a href="/monitoring" class="navbar-link">Penempatan Unit & Monitoring Peserta</a>
    </div>
    <div class="navbar-right">
      <a href="/detailakun" class="navbar-link">Pendaftaran Akun Peserta dan PIC</a>
      <a href="/verifikasi" class="navbar-link">Verifikasi Peserta Magang</a>
      <a href="/sertifikasi" class="navbar-link">Sertifikasi Peserta Magang</a>
      <a href="/admin" class="navbar-link">Kembali</a>
    </div>
  </div>

  <!-- Konten laman Monitoring -->
  <div class="px-6 py-8 max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold text-purple-700 mb-6">Monitoring Peserta Magang</h2>

    <!-- Filter & Search -->
    <div class="flex flex-col md:flex-row items-center gap-3 mb-6">
      <input id="searchText" type="text" placeholder="Cari berdasarkan nama / sekolah / tingkat"
        class="border border-gray-300 px-3 py-2 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400 flex-1">

      <button onclick="cariPeserta()" 
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow font-medium">
        Cari
      </button>
    </div>

    <!-- Card Tabel -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table id="tabel-peserta" class="min-w-full table-auto text-sm text-center">
          <thead class="bg-gradient-to-r from-purple-100 to-purple-200 text-gray-700">
            <tr>
              <th class="px-4 py-3 text-left">No</th>
              <th class="px-4 py-3 text-left">Nama Peserta</th>
              <th class="px-4 py-3 text-left">Grade</th>
              <th class="px-4 py-3 text-left">Asal Sekolah</th>
              <th class="px-4 py-3">Penempatan Unit (PIC)</th>
              <th class="px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach ($pesertas as $index => $peserta)
              <tr class="hover:bg-gray-50 transition">
                <td class="px-4 py-3">{{ $index + 1 }}</td>
                <td class="px-4 py-3 font-medium text-gray-800 nama-peserta">{{ $peserta->formulirPendaftaran->nama_lengkap ?? '-' }}</td>
                <td class="px-4 py-3 grade">{{ $peserta->formulirPendaftaran->grade ?? '-' }}</td>
                <td class="px-4 py-3 asal-sekolah">{{ $peserta->formulirPendaftaran->nama_institusi ?? '-' }}</td>

                <!-- Kolom Select PIC -->
                <td class="px-4 py-3">
                  <form id="form-unit-{{ $peserta->id }}" action="{{ route('update.unit', $peserta->id) }}" method="POST">
                    @csrf
                    <select name="unit"
                      class="border border-gray-300 px-2 py-1 rounded-lg text-sm shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-400
                        {{ optional($peserta->detailuser)->unit ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                      {{ optional($peserta->detailuser)->unit ? 'disabled' : '' }}
                      title="{{ optional($peserta->detailuser)->unit ? 'Hapus PIC terlebih dahulu untuk mengubah' : 'Pilih PIC' }}">
                      <option value="">-- Pilih PIC --</option>
                      @foreach($picUsers as $pic)
                        <option value="{{ $pic->id }}" {{ optional($peserta->detailuser)->unit == $pic->id ? 'selected' : '' }}>
                          {{ $pic->username }} ({{ $pic->nama_institusi ?? 'Tidak ada institusi' }})
                        </option>
                      @endforeach
                    </select>
                  </form>
                </td>

                <!-- Kolom Aksi -->
                <td class="px-4 py-3 flex items-center justify-center gap-2">
                  @if(optional($peserta->detailuser)->unit)
                    <!-- Jika sudah punya PIC: hanya tombol Hapus PIC -->
                    <form action="{{ route('delete.unit', $peserta->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin hapus PIC dari peserta ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">
                        Hapus PIC
                      </button>
                    </form>
                  @else
                    <!-- Jika belum punya PIC: tombol Konfirmasi (submit form select) -->
                    <button type="button" onclick="konfirmasiPeserta(this)"
                      class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">
                      Konfirmasi
                    </button>
                  @endif

                  <!-- Tombol Detail Peserta selalu ada -->
                  <button onclick="openDetail('{{ $peserta->id }}')" 
                    class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow">
                    Detail Peserta
                  </button>

                  {{-- Modal Detail Peserta --}}
                  <div id="detail-{{ $peserta->id }}" class="fixed inset-0 bg-black bg-opacity-40 hidden flex items-center justify-center z-50">
                      <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6">
                          <h2 class="text-xl font-bold mb-4 text-purple-700">
                              Detail Peserta - {{ $peserta->formulirPendaftaran->nama_lengkap ?? '-' }}
                          </h2>

                          {{-- ====== NAVBAR TAB ====== --}}
                          <div class="border-b mb-4">
                              <nav class="flex space-x-6">
                                  <button onclick="showTab('{{ $peserta->id }}','biodata')" 
                                          class="tab-btn-{{ $peserta->id }} text-purple-600 font-semibold border-b-2 border-purple-600 pb-2">
                                      Biodata
                                  </button>
                                  <button onclick="showTab('{{ $peserta->id }}','tugas')" 
                                          class="tab-btn-{{ $peserta->id }} text-gray-600 hover:text-purple-600 pb-2">
                                      Tugas Harian
                                  </button>
                                  <button onclick="showTab('{{ $peserta->id }}','akhir')" 
                                          class="tab-btn-{{ $peserta->id }} text-gray-600 hover:text-purple-600 pb-2">
                                      Laporan Akhir
                                  </button>
                                  <button onclick="showTab('{{ $peserta->id }}','absensi')" 
                                          class="tab-btn-{{ $peserta->id }} text-gray-600 hover:text-purple-600 pb-2">
                                      Absensi
                                  </button>
                              </nav>
                          </div>

                          {{-- ====== TAB BIODATA (DEFAULT SHOW) ====== --}}
                          <div id="tab-biodata-{{ $peserta->id }}" class="tab-content-{{ $peserta->id }}">
                              {{-- Foto Peserta --}}
                              <div class="flex justify-center mb-4">
                                  @if($peserta->detailuser && $peserta->detailuser->foto_profil)
                                      <img src="{{ asset('storage/'.$peserta->detailuser->foto_profil) }}" 
                                          alt="Foto {{ $peserta->formulirPendaftaran->nama_lengkap ?? 'Peserta' }}" 
                                          class="w-32 h-32 rounded-full object-cover border-2 border-purple-500 shadow">
                                  @else
                                      <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                          No Foto
                                      </div>
                                  @endif
                              </div>

                              <div class="bg-gray-50 rounded-lg p-4 text-sm shadow-inner text-left">
                                  <div class="grid grid-cols-2 gap-y-2">
                                      <p class="font-semibold">Nama Lengkap</p>
                                      <p>: {{ $peserta->formulirPendaftaran->nama_lengkap ?? '-' }}</p>
                                      <p class="font-semibold">Alamat</p>
                                      <p>: {{ $peserta->formulirPendaftaran->alamat ?? '-' }}</p>
                                      <p class="font-semibold">No. Telp</p>
                                      <p>: {{ $peserta->formulirPendaftaran->no_telp ?? '-' }}</p>
                                      <p class="font-semibold">Email</p>
                                      <p>: {{ $peserta->formulirPendaftaran->email ?? '-' }}</p>
                                      <p class="font-semibold">Nama Institusi</p>
                                      <p>: {{ $peserta->formulirPendaftaran->nama_institusi ?? '-' }}</p>
                                      <p class="font-semibold">Jurusan</p>
                                      <p>: {{ $peserta->formulirPendaftaran->jurusan ?? '-' }}</p>
                                      <p class="font-semibold">Tanggal Mulai</p>
                                      <p>: {{ $peserta->formulirPendaftaran->tanggal_mulai_magang ?? '-' }}</p>
                                      <p class="font-semibold">Tanggal Selesai</p>
                                      <p>: {{ $peserta->formulirPendaftaran->tanggal_selesai_magang ?? '-' }}</p>
                                      <p class="font-semibold">Grade</p>
                                      <p>: {{ $peserta->formulirPendaftaran->grade ?? '-' }}</p>
                                      <p class="font-semibold">Fakultas</p>
                                      <p>: {{ $peserta->formulirPendaftaran->fakultas ?? '-' }}</p>
                                      <p class="font-semibold">Jenjang</p>
                                      <p>: {{ $peserta->formulirPendaftaran->jenjang ?? '-' }}</p>
                                  </div>
                              </div>
                          </div>

                          {{-- === TAB LAPORAN HARIAN === --}}
                          <div id="tab-tugas-{{ $peserta->id }}" class="tab-content-{{ $peserta->id }} hidden text-left">
                              @if($peserta->laporanHarian->isEmpty())
                                  <p class="text-gray-500 italic text-left py-4">
                                      Belum ada laporan harian yang dikumpulkan.
                                  </p>
                              @else
                                  <div class="space-y-4 max-h-80 overflow-y-auto pr-2">
                                      @foreach($peserta->laporanHarian as $laporan)
                                          <div class="border rounded-lg p-4 bg-gray-50 shadow-sm hover:shadow-md transition text-left">
                                              <div class="flex justify-between items-center mb-2">
                                                  <h3 class="font-semibold text-purple-700">
                                                      {{ $laporan->judul }}
                                                  </h3>
                                                  <span class="text-sm text-gray-500">
                                                      {{ \Carbon\Carbon::parse($laporan->tanggal_pengumpulan)->format('d/m/Y') }}
                                                  </span>
                                              </div>

                                              {{-- Isi laporan dengan expand/collapse --}}
                                              <p id="isi-{{ $laporan->id }}" 
                                              class="text-gray-700 text-sm mb-3 line-clamp-3 break-words">
                                                  {{ $laporan->isi }}
                                              </p>
                                              <button type="button" 
                                                      class="text-blue-600 text-sm underline" 
                                                      onclick="toggleIsi('{{ $laporan->id }}', this)">
                                                  Lihat Selengkapnya
                                              </button>

                                              <div class="mt-2">
                                                  @if($laporan->lampiran)
                                                      <a href="{{ asset('storage/'.$laporan->lampiran) }}" 
                                                      target="_blank" 
                                                      class="inline-block text-blue-600 underline text-sm">
                                                          📂 Lihat Lampiran
                                                      </a>
                                                  @else
                                                      <span class="text-gray-400 text-sm">Tidak ada lampiran</span>
                                                  @endif
                                              </div>
                                          </div>
                                      @endforeach
                                  </div>
                              @endif
                          </div>

                          {{-- ====== TAB LAPORAN AKHIR ====== --}}
                          <div id="tab-akhir-{{ $peserta->id }}" class="tab-content-{{ $peserta->id }} hidden">
                              <div class="bg-gray-50 rounded-lg p-4 text-sm shadow-inner text-left">
                                  @if($peserta->laporanAkhir)
                                      <p><strong>Judul:</strong> {{ $peserta->laporanAkhir->judul }}</p>
                                      <p><strong>Deskripsi:</strong> {{ $peserta->laporanAkhir->deskripsi }}</p>
                                      <a href="{{ asset('storage/'.$peserta->laporanAkhir->file) }}" 
                                      class="text-purple-600 underline hover:text-purple-800" target="_blank">
                                          📂 Download Laporan
                                      </a>
                                  @else
                                      <p class="text-gray-500 italic text-left">Belum ada laporan akhir.</p>
                                  @endif
                              </div>
                          </div>

                          {{-- ====== TAB ABSENSI ====== --}}
                          <div id="tab-absensi-{{ $peserta->id }}" class="tab-content-{{ $peserta->id }} hidden text-left">
                              @if($peserta->checkClocks->isEmpty())
                                  <p class="text-gray-500 italic text-left py-4">
                                      Belum ada riwayat absensi.
                                  </p>
                              @else
                                  {{-- Ringkasan Kehadiran --}}
                                  @php
                                      // Ambil absensi unik per tanggal
                                      $grouped = $peserta->checkClocks->groupBy('tanggal');

                                      $total = $grouped->count();
                                      $hadir = 0; $izin = 0; $alpa = 0;

                                      foreach ($grouped as $tanggal => $records) {
                                          if ($records->where('status', 'Hadir')->isNotEmpty()) {
                                              $hadir++;
                                          }
                                          elseif ($records->where('status', 'Izin')->isNotEmpty()) {
                                              $izin++;
                                          }
                                          else {
                                              $alpa++;
                                          }
                                      }

                                      $persenHadir = $total > 0 ? round(($hadir / $total) * 100, 2) : 0;
                                  @endphp

                                  <div class="mb-4 p-3 bg-gray-100 border rounded-lg text-left">
                                      <h3 class="text-sm font-semibold mb-2">📊 Ringkasan Kehadiran</h3>
                                      <p class="text-sm">✅ Hadir: <span class="font-bold">{{ $hadir }}</span></p>
                                      <p class="text-sm">🟡 Izin: <span class="font-bold">{{ $izin }}</span></p>
                                      <p class="text-sm">❌ Tidak Hadir: <span class="font-bold">{{ $alpa }}</span></p>
                                      <p class="text-sm mt-2">🎯 Persentase Kehadiran: 
                                          <span class="font-bold text-purple-700" id="persen-{{ $peserta->id }}">
                                              {{ $persenHadir }}%
                                          </span>
                                      </p>

                                      {{-- Progress bar --}}
                                      <div class="w-full bg-gray-200 rounded-full h-3 mt-2">
                                          <div id="progress-{{ $peserta->id }}" 
                                              class="bg-green-500 h-3 rounded-full" 
                                              style="width: {{ $persenHadir }}%">
                                          </div>
                                      </div>
                                  </div>

                                  {{-- Riwayat Absensi --}}
                                  <div class="max-h-80 overflow-y-auto space-y-3 pr-2">
                                      @foreach($grouped->sortByDesc(fn($records, $tanggal) => $tanggal) as $tanggal => $records)
                                          <div class="border rounded-lg p-3 shadow-sm bg-white hover:shadow-md transition text-left">
                                              <div class="flex justify-between items-center">
                                                  <span class="font-semibold text-sm text-gray-700">
                                                      {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y') }}
                                                  </span>
                                                  <span class="text-xs text-gray-500">
                                                      {{ $records->pluck('keterangan')->implode(', ') }}
                                                  </span>
                                              </div>
                                              <p class="text-xs mt-1">
                                                  Status: 
                                                  <span class="font-medium">
                                                      @if($records->where('status','Hadir')->isNotEmpty()) Hadir
                                                      @elseif($records->where('status','Izin')->isNotEmpty()) Izin
                                                      @else Tidak Hadir
                                                      @endif
                                                  </span>
                                              </p>
                                              @if($records->pluck('alasan')->filter()->isNotEmpty())
                                                  <p class="text-xs text-gray-600 mt-1 italic">
                                                      Alasan: {{ $records->pluck('alasan')->implode(', ') }}
                                                  </p>
                                              @endif
                                          </div>
                                      @endforeach
                                  </div>
                              @endif
                          </div>

                          {{-- Tombol Tutup --}}
                          <div class="flex justify-end mt-6">
                              <button type="button" onclick="closeDetail('{{ $peserta->id }}')" 
                                      class="px-4 py-2 bg-gray-500 text-white rounded-lg">
                                  Tutup
                              </button>
                          </div>
                      </div>
                  </div>


                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Script kecil untuk konfirmasi -->
  <script>
    'use strict';

  function konfirmasiPeserta(btn) {
    const row = btn.closest('tr');
    if (!row) return;

    const select = row.querySelector('select[name="unit"]');
    if (!select) return;

    if (!select.value) {
      alert('Silakan pilih PIC terlebih dahulu.');
      select.focus();
      return;
    }

    if (!confirm('Simpan PIC yang dipilih untuk peserta ini?')) {
      return;
    }

    const form = select.form;
    if (form) form.submit();
  }

  function cariPeserta() {
    const input = document.getElementById("searchText").value.toLowerCase().trim();
    const rows = document.querySelectorAll("#tabel-peserta tbody tr");

    // bikin regex agar cocok kata utuh (misal "siswa" ≠ "mahasiswa")
    const regex = new RegExp("\\b" + input + "\\b", "i");

    rows.forEach(row => {
      const nama = row.querySelector(".nama-peserta")?.textContent.toLowerCase() || "";
      const sekolah = row.querySelector(".asal-sekolah")?.textContent.toLowerCase() || "";
      const grade = row.querySelector(".grade")?.textContent.toLowerCase() || "";

      // pecah per kata biar lebih presisi
      const namaWords = nama.split(/\s+/);
      const sekolahWords = sekolah.split(/\s+/);
      const gradeWords = grade.split(/\s+/);

      const matchNama = namaWords.some(w => regex.test(w));
      const matchSekolah = sekolahWords.some(w => regex.test(w));
      const matchGrade = gradeWords.some(w => regex.test(w));

      if (matchNama || matchSekolah || matchGrade) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  }

  // Modal Detail Peserta
        function openDetail(userId) {
            document.getElementById('detail-'+userId).classList.remove('hidden');
        }
        function closeDetail(userId) {
            document.getElementById('detail-'+userId).classList.add('hidden');
        }

        // Ganti tab
        function showTab(pesertaId, tabName) {
            const tabs = document.querySelectorAll(`.tab-content-${pesertaId}`);
            const btns = document.querySelectorAll(`.tab-btn-${pesertaId}`);
            tabs.forEach(t => t.classList.add('hidden'));
            btns.forEach(b => {
                b.classList.remove('text-purple-600','font-semibold','border-b-2','border-purple-600');
                b.classList.add('text-gray-600');
            });

            document.getElementById(`tab-${tabName}-${pesertaId}`).classList.remove('hidden');
            document.querySelector(`button[onclick="showTab('${pesertaId}','${tabName}')"]`)
                    .classList.add('text-purple-600','font-semibold','border-b-2','border-purple-600');
        }
        function toggleIsi(id, btn) {
            const p = document.getElementById('isi-' + id);
            if (p.classList.contains('line-clamp-3')) {
                p.classList.remove('line-clamp-3');
                btn.textContent = 'Tutup';
            } else {
                p.classList.add('line-clamp-3');
                btn.textContent = 'Lihat Selengkapnya';
            }
        }
  </script>

</body>
</html>
