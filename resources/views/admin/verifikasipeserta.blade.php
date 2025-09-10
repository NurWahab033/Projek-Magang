<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verifikasi Peserta Magang - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
  <script>
    function confirmApproval(id) {
      if (confirm('Setujui peserta ini?')) {
        document.getElementById('status-buttons-' + id).classList.add('hidden');
        alert('Peserta disetujui.');
      }
    }

    function confirmRejection(id) {
      if (confirm('Tolak peserta ini?')) {
        document.getElementById('status-buttons-' + id).classList.add('hidden');
        document.getElementById('rejection-reason-' + id).classList.remove('hidden');
      }
    }

    function submitRejection(id) {
      const reason = document.getElementById('alasan-' + id).value;
      if (reason.trim() === '') {
        alert('Tolong isi alasan penolakan.');
      } else {
        alert('Peserta ditolak dengan alasan: ' + reason);
        document.getElementById('rejection-reason-' + id).classList.add('hidden');
      }
    }
  </script>
</head>
<body class="bg-white text-sm relative">

  <!-- Header -->
  <div class="header">
    <div class="header-container">
      <img src="/images/cipta nirmala.png" alt="Logo" class="logo" />
      <h1 class="header-title">PT. CIPTA NIRMALA</h1>
    </div>
  </div>

  <!-- Navbar -->
  <div class="navbar">
    <div class="navbar-left">
      <a href="/verifikasi" class="navbar-link">Verifikasi Peserta Magang</a>
    </div>
    <div class="navbar-right">
      <a href="/monitoring" class="navbar-link">Penempatan Unit & Monitoring Peserta</a>
      <a href="/detailakun" class="navbar-link">Pendaftaran Akun Peserta & PIC</a>
      <a href="/sertifikasi" class="navbar-link">Sertifikasi Peserta Magang</a>
      <a href="/admin" class="navbar-link">Kembali</a>
    </div>
  </div>

<div class="z-10 relative px-6 mt-6">
  <div class="overflow-x-auto">
    <table class="w-full table-auto border-collapse text-sm text-center bg-white shadow rounded-lg overflow-hidden">
      <thead class="bg-purple-100 text-gray-700 font-semibold">
        <tr>
          <th class="border px-4 py-3">ID</th>
          <th class="border px-4 py-3">Tanggal Masuk</th>
          <th class="border px-4 py-3">Username</th>
          <th class="border px-4 py-3">Formulir</th>
          <th class="border px-4 py-3">Proposal</th>
          <th class="border px-4 py-3">Status</th>
        </tr>
      </thead>
      <tbody class="text-gray-700">
        @foreach($data as $item)
        <tr class="hover:bg-gray-50">
          <td class="border px-4 py-2">{{ $item->id }}</td>
          <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</td>
          <td class="border px-4 py-2">{{ $item->nama_lengkap }}</td>
          <td class="border px-4 py-2">
            <a href="{{ asset('storage/'.$item->file_surat) }}" target="_blank" class="text-blue-600 hover:underline italic">
              Lihat selengkapnya
            </a>
          </td>
          <td class="border px-4 py-2">{{ $item->nama_institusi }}</td>
          <td class="border px-4 py-2">
            <div id="status-buttons-{{ $item->id }}" class="flex items-center justify-center gap-2">
              @if($item->status == 'menunggu')
                <button onclick="updateStatus({{ $item->id }}, 'diterima')" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs">Terima</button>
                <button onclick="showRejection({{ $item->id }})" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Tolak</button>
              @elseif($item->status == 'diterima')
                <span class="text-green-600 font-semibold">Diterima</span>
              @elseif($item->status == 'ditolak')
                <span class="text-red-600 font-semibold">Ditolak</span>
                <div class="text-xs text-gray-500 italic">Alasan: {{ $item->alasan }}</div>
              @endif
            </div>

            <div id="rejection-reason-{{ $item->id }}" class="hidden mt-2">
              <input id="alasan-{{ $item->id }}" type="text" placeholder="Alasan penolakan" class="border px-2 py-1 rounded w-full text-xs">
              <button onclick="submitRejection({{ $item->id }})" class="mt-1 bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-xs">Submit</button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>

    </table>
  </div>
</div>
  <script>
    // ambil CSRF token Laravel
    const csrfToken = '{{ csrf_token() }}';

    function updateStatus(id, status, alasan = null) {
      fetch(`/formpendaftaran/${id}/status`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ status: status, alasan: alasan })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          const row = document.getElementById('status-buttons-' + id);
          row.innerHTML = '';
          if (data.status === 'diterima') {
            row.innerHTML = `<span class="text-green-600 font-semibold">Diterima</span>`;
          } else if (data.status === 'ditolak') {
            row.innerHTML = `<span class="text-red-600 font-semibold">Ditolak</span>
                            <div class="text-xs text-gray-500 italic">Alasan: ${data.alasan}</div>`;
          }
        }
      });
    }

    function showRejection(id) {
      document.getElementById('status-buttons-' + id).classList.add('hidden');
      document.getElementById('rejection-reason-' + id).classList.remove('hidden');
    }

    function submitRejection(id) {
      const alasan = document.getElementById('alasan-' + id).value;
      if (alasan.trim() === '') {
        alert('Tolong isi alasan penolakan.');
        return;
      }
      updateStatus(id, 'ditolak', alasan);
      document.getElementById('rejection-reason-' + id).classList.add('hidden');
    }
  </script>

</body>
</html>
