<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Presensi Peserta - PT Cipta Nirmala</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-blue-100 to-purple-100 min-h-screen font-sans">

  <!-- Header -->
  <header class="flex justify-between items-center px-6 py-4 bg-white shadow rounded-b-xl">
    <div class="flex items-center gap-3">
      <img src="{{ asset('images/cipta nirmala.png') }}" alt="Logo PT Cipta Nirmala" class="w-12 h-12">
      <div>
        <h1 class="text-lg font-bold text-gray-700">Presensi Peserta</h1>
        <p class="text-blue-700 font-semibold">PT. CIPTA NIRMALA</p>
      </div>
    </div>
    <button type="button"
      onclick="window.history.back()"
      class="bg-blue-300 hover:bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
      Kembali
    </button>
  </header>

  <!-- Notifikasi -->
  <div class="max-w-4xl mx-auto mt-4">
    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-lg mb-4">
        {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-lg mb-4">
        {{ session('error') }}
      </div>
    @endif
  </div>

  <!-- Tab Navigation -->
  <div class="flex justify-center gap-8 mt-6">
    <button id="tabCheckIn" onclick="switchTab('checkin')" class="tab-btn font-medium text-gray-600 border-b-2 border-transparent pb-1 hover:text-purple-500">Check In</button>
    <button id="tabCheckOut" onclick="switchTab('checkout')" class="tab-btn font-medium text-gray-600 border-b-2 border-transparent pb-1 hover:text-purple-500">Check Out</button>
  </div>

  <!-- Main Container -->
  <main class="max-w-4xl mx-auto bg-white shadow-md rounded-2xl p-6 mt-6">

    <!-- Form Check In -->
    <div id="checkin" class="form-section">
      <form action="{{ route('checkclock.store') }}" method="POST" class="space-y-6 relative">
        @csrf
        <input type="hidden" name="status" id="statusInInput">
        <input type="hidden" name="keterangan" value="Check In">
        <input type="hidden" name="alasan" id="alasanInHidden">

        <h2 class="text-xl font-semibold text-center text-gray-700">Form Check In</h2>
        <div class="absolute left-6 top-1 hidden md:block">
          <img src="{{ asset('images/iv3.png') }}" alt="Ilustrasi Presensi" class="w-48 h-48 object-contain">
        </div>

        <div class="flex flex-col items-center space-y-4">
          <div class="text-center">
            <label class="block font-medium text-gray-600">Tanggal</label>
            <p class="text-gray-800">{{ now()->format('d-m-Y') }}</p>
            <p id="jamCheckIn" class="text-gray-800 font-semibold"></p>
          </div>

          <div class="text-center">
            <label class="block font-medium text-gray-600">Status Kehadiran</label>
            <div class="flex justify-center gap-6 mt-2">
              <label class="flex items-center gap-1">
                <input type="radio" name="statusIn" value="Hadir" class="accent-purple-500"> Hadir
              </label>
              <label class="flex items-center gap-1">
                <input type="radio" name="statusIn" value="Izin" class="accent-purple-500"> Izin
              </label>
              <label class="flex items-center gap-1">
                <input type="radio" name="statusIn" value="Tidak Hadir" class="accent-purple-500"> Tidak Hadir
              </label>
            </div>
          </div>
        </div>

        <div id="alasanInField" class="hidden">
          <label class="font-medium text-gray-600">Alasan</label>
          <input type="text" id="alasanInInput" placeholder="Tulis alasan..." class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-purple-200">
        </div>

        <button type="submit"
          class="px-6 py-2 font-semibold rounded-lg shadow-md block mx-auto
          {{ $sudahCheckIn ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-300 hover:bg-blue-500 text-white' }}"
          {{ $sudahCheckIn ? 'disabled' : '' }}>
          Submit Check In
        </button>

        @if($sudahCheckIn)
          <p class="text-center text-sm text-red-500 mt-2">Anda sudah melakukan Check In hari ini.</p>
        @endif
      </form>
    </div>

    <!-- Form Check Out -->
    <div id="checkout" class="form-section hidden">
      <form action="{{ route('checkclock.store') }}" method="POST" class="space-y-6 relative">
        @csrf
        <input type="hidden" name="status" value="Hadir">
        <input type="hidden" name="keterangan" value="Check Out">

        <h2 class="text-xl font-semibold text-center text-gray-700">Form Check Out</h2>
        <div class="absolute left-6 top-1 hidden md:block">
          <img src="{{ asset('images/iv3.png') }}" alt="Ilustrasi Presensi" class="w-48 h-48 object-contain">
        </div>

        <div class="flex flex-col items-center space-y-4">
          <div class="text-center">
            <label class="block font-medium text-gray-600">Tanggal</label>
            <p class="text-gray-800">{{ now()->format('d-m-Y') }}</p>
            <p id="jamCheckOut" class="text-gray-800 font-semibold"></p>
          </div>
        </div>

        <button type="submit"
          class="px-6 py-2 font-semibold rounded-lg shadow-md block mx-auto
          {{ $sudahCheckIn && !$sudahCheckOut ? 'bg-green-400 hover:bg-green-600 text-white' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
          {{ $sudahCheckIn && !$sudahCheckOut ? '' : 'disabled' }}>
          Submit Check Out
        </button>

        @if(!$sudahCheckIn)
          <p class="text-center text-sm text-red-500 mt-2">Anda harus Check In terlebih dahulu.</p>
        @elseif($sudahCheckOut)
          <p class="text-center text-sm text-red-500 mt-2">Anda sudah melakukan Check Out hari ini.</p>
        @endif
      </form>
    </div>

    <!-- Riwayat Presensi -->
    <h2 class="text-lg font-semibold text-gray-700 mt-8 mb-4">Riwayat Presensi</h2>
    <div class="overflow-x-auto">
      <table class="w-full border border-gray-200 rounded-lg overflow-hidden text-sm">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="px-4 py-2 text-left">No</th>
            <th class="px-4 py-2 text-left">Tanggal</th>
            <th class="px-4 py-2 text-left">Jam</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-4 py-2 text-left">Keterangan</th>
            <th class="px-4 py-2 text-left">Alasan</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($checkClocks as $index => $clock)
            <tr>
              <td class="px-4 py-2">{{ $index + 1 }}</td>
              <td class="px-4 py-2">{{ \Carbon\Carbon::parse($clock->tanggal)->format('d-m-Y') }}</td>
              <td class="px-4 py-2">{{ $clock->jam }}</td>
              <td class="px-4 py-2">{{ $clock->status }}</td>
              <td class="px-4 py-2">{{ $clock->keterangan ?? '-' }}</td>
              <td class="px-4 py-2">{{ $clock->alasan ?? '-' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data presensi.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>

  <!-- Script -->
  <script>
    function switchTab(tab) {
      document.getElementById('checkin').classList.toggle('hidden', tab !== 'checkin');
      document.getElementById('checkout').classList.toggle('hidden', tab !== 'checkout');
      document.getElementById('tabCheckIn').classList.toggle('border-purple-500', tab === 'checkin');
      document.getElementById('tabCheckOut').classList.toggle('border-purple-500', tab === 'checkout');
    }

    // Radio status Check In
    document.querySelectorAll('input[name="statusIn"]').forEach(radio => {
      radio.addEventListener('change', function() {
        document.getElementById('statusInInput').value = this.value;
        document.getElementById('alasanInField').classList.toggle('hidden', this.value !== 'Izin');
      });
    });

    document.getElementById('alasanInInput')?.addEventListener('input', function() {
      document.getElementById('alasanInHidden').value = this.value;
    });

    // Jam real-time
    function updateClock() {
      const now = new Date();
      const jam = now.toLocaleTimeString('id-ID', { hour12: false });
      document.getElementById('jamCheckIn').textContent = jam;
      document.getElementById('jamCheckOut').textContent = jam;
    }
    setInterval(updateClock, 1000);
    updateClock();
  </script>

</body>
</html>
