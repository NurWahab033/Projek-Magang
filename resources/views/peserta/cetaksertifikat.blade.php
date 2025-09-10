<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sertifikasi Peserta - PT. CIPTA NIRMALA</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">
  <!-- Header -->
  <header class="bg-white border-b shadow px-6 py-4 flex items-center justify-between">
    <h1 class="text-lg md:text-xl font-bold text-gray-800">Cetak Sertifikat Peserta - PT. CIPTA NIRMALA</h1>
    <a href="{{ url('/peserta') }}"
       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow transition">
      Kembali
    </a>
  </header>

  <!-- Konten -->
  <main class="max-w-7xl mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold mb-6">Sertifikasi Peserta</h2>

    <div class="overflow-x-auto bg-white rounded-xl shadow border">
      <table class="min-w-full text-sm text-left border-collapse">
        <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
          <tr>
            <th class="px-4 py-3 border">No</th>
            <th class="px-4 py-3 border">Nama Peserta</th>
            <th class="px-4 py-3 border">Tingkat</th>
            <th class="px-4 py-3 border">Institusi Asal</th>
            <th class="px-4 py-3 border">Tanggal Mulai</th>
            <th class="px-4 py-3 border">Tanggal Selesai</th>
            <th class="px-4 py-3 border">Nilai</th>
            <th class="px-4 py-3 border">Nomor Sertifikat</th>
            <th class="px-4 py-3 border">Tanggal Terbit</th>
            <th class="px-4 py-3 border">Status</th>
            <th class="px-4 py-3 border">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y">
          @forelse($sertifikat as $s)
          <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-3 border">{{ $loop->iteration }}</td>
            <td class="px-4 py-3 border">{{ $s->formulir->nama_lengkap }}</td>
            <td class="px-4 py-3 border">{{ $s->formulir->grade }}</td>
            <td class="px-4 py-3 border">{{ $s->formulir->nama_institusi }}</td>
            <td class="px-4 py-3 border">
              {{ \Carbon\Carbon::parse($s->formulir->tanggal_mulai_magang)->format('d/m/Y') }}
            </td>
            <td class="px-4 py-3 border">
              {{ \Carbon\Carbon::parse($s->formulir->tanggal_selesai_magang)->format('d/m/Y') }}
            </td>
            <td class="px-4 py-3 border text-center">{{ $s->penilaian->rata_rata ?? '-' }}</td>
            <td class="px-4 py-3 border nomor-sertifikat">{{ $s->nomor_sertifikat ?? '-' }}</td>
            <td class="px-4 py-3 border">
              {{ $s->tanggal_terbit ? \Carbon\Carbon::parse($s->tanggal_terbit)->format('d/m/Y') : '-' }}
            </td>
            <td class="px-4 py-3 border text-center">
              @if($s->status === 'izin terbit')
                <span class="text-yellow-600 font-medium">Menunggu Terbit</span>
              @elseif($s->status === 'tersedia')
                <span class="text-green-600 font-semibold">Tersedia</span>
              @else
                <span class="text-red-500">Belum Ada</span>
              @endif
            </td>
            <td class="px-4 py-3 border text-center">
              @if($s->status === 'tersedia')
                <a href="{{ route('sertifikat.cetak', $s->id) }}" target="_blank"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs font-medium shadow transition">
                  Cetak
                </a>
              @else
                <span class="text-gray-500 text-sm">Belum Ada</span>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="11" class="px-4 py-6 border text-center text-gray-500">
              Belum ada data sertifikat.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
