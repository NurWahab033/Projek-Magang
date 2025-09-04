<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail & Penilaian Peserta Magang</title>
    <style>
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3; /* Batasi 3 baris */
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>
</head>
<body class="bg-gray-50">
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-purple-700">Detail & Penilaian Peserta Magang</h1>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-red-600 text-white px-4 py-2 rounded-lg">Logout</button>
            </form>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">
            @if($pesertas->isEmpty())
                <div class="p-6 text-center text-gray-600">
                    Belum ada peserta di unit Anda.
                </div>
            @else
                <table class="min-w-full border text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">No</th>
                            <th class="px-4 py-2">Nama Peserta</th>
                            <th class="px-4 py-2">Asal Institusi</th>
                            <th class="px-4 py-2">Nilai Rata-rata</th>
                            <th class="px-4 py-2">Beri Nilai</th>
                            <th class="px-4 py-2">Detail Peserta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesertas as $i => $peserta)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $i+1 }}</td>
                                <td class="px-4 py-2">{{ $peserta->formulirPendaftaran->nama_lengkap ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $peserta->formulirPendaftaran->nama_institusi ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $peserta->penilaian->rata_rata ?? 0 }}</td>
                                <td class="px-4 py-2">
                                    <button onclick="openModal('{{ $peserta->id }}')" 
                                            class="bg-indigo-600 text-white px-3 py-1 rounded-lg hover:bg-indigo-700">
                                        Beri Nilai
                                    </button>
                                </td>
                                <td class="px-4 py-2">
                                    <button onclick="openDetail('{{ $peserta->id }}')" 
                                            class="bg-purple-600 text-white px-3 py-1 rounded-lg hover:bg-purple-700">
                                        Detail Peserta
                                    </button>
                                </td>
                            </tr>

                            {{-- Modal Penilaian --}}
                            <div id="modal-{{ $peserta->id }}" class="fixed inset-0 bg-black bg-opacity-40 hidden flex items-center justify-center z-50">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                                    <h2 class="text-xl font-bold mb-4">Beri Nilai - {{ $peserta->formulirPendaftaran->nama_lengkap ?? '-' }}</h2>
                                    <form id="form-{{ $peserta->id }}" method="POST" action="{{ route('penilaian.store', $peserta->id) }}">
                                        @csrf
                                        <div class="grid grid-cols-2 gap-4">
                                            @foreach (['penyelesaian'=>'Penyelesaian','inisiatif'=>'Inisiatif','komunikasi'=>'Komunikasi','kerjasama'=>'Kerjasama','kedisiplinan'=>'Kedisiplinan'] as $field=>$label)
                                                <div>
                                                    <label class="block text-left">{{ $label }}</label>
                                                    <input type="number" name="{{ $field }}" min="0" max="100" 
                                                           value="{{ $peserta->penilaian->$field ?? '' }}"
                                                           class="w-full border rounded p-2" 
                                                           oninput="hitungRataRata('form-{{ $peserta->id }}','{{ $peserta->id }}')">
                                                </div>
                                            @endforeach
                                            <div>
                                                <label class="block text-left">Rata-rata</label>
                                                <input type="text" id="rata_rata-{{ $peserta->id }}" name="rata_rata" readonly 
                                                       class="w-full border rounded p-2 bg-gray-100"
                                                       value="{{ $peserta->penilaian->rata_rata ?? '0.00' }}">
                                            </div>
                                        </div>
                                        <div class="flex justify-end gap-2 mt-4">
                                            <button type="button" onclick="closeModal('{{ $peserta->id }}')" 
                                                    class="px-4 py-2 bg-gray-400 text-white rounded-lg">
                                                Batal
                                            </button>
                                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg">
                                                Simpan Nilai
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

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

                                        <div class="bg-gray-50 rounded-lg p-4 text-sm shadow-inner">
                                            <div class="grid grid-cols-2 gap-y-2">
                                                <p><strong>Nama Lengkap</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->nama_lengkap ?? '-' }}</p>
                                                <p><strong>Alamat</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->alamat ?? '-' }}</p>
                                                <p><strong>No. Telp</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->no_telp ?? '-' }}</p>
                                                <p><strong>Email</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->email ?? '-' }}</p>
                                                <p><strong>Nama Institusi</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->nama_institusi ?? '-' }}</p>
                                                <p><strong>Jurusan</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->jurusan ?? '-' }}</p>
                                                <p><strong>Tanggal Mulai</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->tanggal_mulai_magang ?? '-' }}</p>
                                                <p><strong>Tanggal Selesai</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->tanggal_selesai_magang ?? '-' }}</p>
                                                <p><strong>Grade</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->grade ?? '-' }}</p>
                                                <p><strong>Fakultas</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->fakultas ?? '-' }}</p>
                                                <p><strong>Jenjang</strong></p>
                                                <p>: {{ $peserta->formulirPendaftaran->jenjang ?? '-' }}</p>
                                                <p><strong>Unit</strong></p>
                                                <p>: {{ Auth::user()->nama_institusi ?? '-' }} - {{ Auth::user()->username ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- === TAB LAPORAN HARIAN === --}}
                                    <div id="tab-tugas-{{ $peserta->id }}" class="tab-content-{{ $peserta->id }} hidden">
                                        @if($peserta->laporanHarian->isEmpty())
                                            <p class="text-gray-500 italic text-center py-4">
                                                Belum ada laporan harian yang dikumpulkan.
                                            </p>
                                        @else
                                            <div class="space-y-4 max-h-80 overflow-y-auto pr-2">
                                                @foreach($peserta->laporanHarian as $laporan)
                                                    <div class="border rounded-lg p-4 bg-gray-50 shadow-sm hover:shadow-md transition">
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
                                        <div class="bg-gray-50 rounded-lg p-4 text-sm shadow-inner">
                                            @if($peserta->laporanAkhir)
                                                <p><strong>Judul:</strong> {{ $peserta->laporanAkhir->judul }}</p>
                                                <p><strong>Deskripsi:</strong> {{ $peserta->laporanAkhir->deskripsi }}</p>
                                                <a href="{{ asset('storage/'.$peserta->laporanAkhir->file) }}" 
                                                class="text-purple-600 underline hover:text-purple-800" target="_blank">
                                                    📂 Download Laporan
                                                </a>
                                            @else
                                                <p class="text-gray-500 italic">Belum ada laporan akhir.</p>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- ====== TAB ABSENSI ====== --}}
                                    <div id="tab-absensi-{{ $peserta->id }}" class="tab-content-{{ $peserta->id }} hidden">
                                        @if($peserta->checkClocks->isEmpty())
                                            <p class="text-gray-500 italic text-center py-4">
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
                                                    // Jika ada status "Hadir" (biasanya dari Check In) → Hadir
                                                    if ($records->where('status', 'Hadir')->isNotEmpty()) {
                                                        $hadir++;
                                                    }
                                                    // Jika ada status "Izin"
                                                    elseif ($records->where('status', 'Izin')->isNotEmpty()) {
                                                        $izin++;
                                                    }
                                                    // Kalau tidak ada, berarti alpa
                                                    else {
                                                        $alpa++;
                                                    }
                                                }

                                                $persenHadir = $total > 0 ? round(($hadir / $total) * 100, 2) : 0;
                                            @endphp

                                            <div class="mb-4 p-3 bg-gray-100 border rounded-lg">
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
                                                    <div class="border rounded-lg p-3 shadow-sm bg-white hover:shadow-md transition">
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


                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function hitungRataRata(formId, userId) {
            let form = document.getElementById(formId);
            let fields = ['penyelesaian', 'inisiatif', 'komunikasi', 'kerjasama', 'kedisiplinan'];
            let total = 0, count = fields.length;

            fields.forEach(field => {
                let input = form.querySelector(`[name="${field}"]`);
                let val = parseFloat(input.value) || 0;

                if (val > 100) {
                    val = 100;
                    input.value = 100;
                }
                if (val < 0) {
                    val = 0;
                    input.value = 0;
                }
                total += val;
            });

            let rataInput = document.getElementById('rata_rata-'+userId);
            if (rataInput) {
                rataInput.value = (total / count).toFixed(2);
            }
        }

        function openModal(userId) {
            document.getElementById('modal-'+userId).classList.remove('hidden');
            hitungRataRata('form-'+userId, userId);
        }
        function closeModal(userId) {
            document.getElementById('modal-'+userId).classList.add('hidden');
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

                function toggleIsi(id) {
            let isi = document.getElementById("isi-"+id);
            let btn = event.target;

            if (isi.classList.contains("line-clamp-3")) {
                isi.classList.remove("line-clamp-3");
                btn.innerText = "Tutup";
            } else {
                isi.classList.add("line-clamp-3");
                btn.innerText = "Lihat Selengkapnya";
            }
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
