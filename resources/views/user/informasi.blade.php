<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verifikasi Peserta Magang - PT. CIPTA NIRMALA</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/style.css">
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
    <a href="/informasi" class="navbar-link">Informasi Pendaftaran</a>
  </div>
  <div class="navbar-right">
    <a href="/formpendaftaran" class="navbar-link">Formulir pendaftaran</a>
    <a href="/user" class="navbar-link">Kembali</a>
  </div>
</div>

<div class="overflow-x-auto">
<table class="min-w-full table-auto border border-gray-300 text-sm text-left shadow">
  <thead class="bg-gray-100 text-gray-800">
    <tr>
      <th class="border px-3 py-2">Nama Lengkap</th>
      <th class="border px-3 py-2">Alamat</th>
      <th class="border px-3 py-2">No. Telp</th>
      <th class="border px-3 py-2">Email</th>
      <th class="border px-3 py-2">Institusi</th>
      <th class="border px-3 py-2">Jurusan</th>
      <th class="border px-3 py-2">Tanggal Mulai</th>
      <th class="border px-3 py-2">Tanggal Selesai</th>
      <th class="border px-3 py-2">Grade</th>
      <th class="border px-3 py-2">Fakultas</th>
      <th class="border px-3 py-2">Jenjang</th>
      <th class="border px-3 py-2">File Unggahan</th>
      <th class="border px-3 py-2">Status</th>
      <th class="border px-3 py-2">Keterangan</th>
    </tr>
  </thead>
  <tbody>
    @if($formulir)
    <tr class="hover:bg-gray-50">
        <td class="border px-3 py-2">{{ $formulir->nama_lengkap }}</td>
        <td class="border px-3 py-2">{{ $formulir->alamat }}</td>
        <td class="border px-3 py-2">{{ $formulir->no_telp }}</td>
        <td class="border px-3 py-2">{{ $formulir->email }}</td>
        <td class="border px-3 py-2">{{ $formulir->nama_institusi }}</td>
        <td class="border px-3 py-2">{{ $formulir->jurusan }}</td>
        <td class="border px-3 py-2">{{ \Carbon\Carbon::parse($formulir->tanggal_mulai_magang)->format('d/m/Y') }}</td>
        <td class="border px-3 py-2">{{ \Carbon\Carbon::parse($formulir->tanggal_selesai_magang)->format('d/m/Y') }}</td>
        <td class="border px-3 py-2">{{ $formulir->grade }}</td>
        <td class="border px-3 py-2">{{ $formulir->fakultas }}</td>
        <td class="border px-3 py-2">{{ $formulir->jenjang }}</td>
        <td class="border px-3 py-2">
            <a href="{{ asset('storage/' . $formulir->file_surat) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">
                {{ basename($formulir->file_surat) }}
            </a>
        </td>
        <td class="border px-3 py-2">
            <span class="inline-block px-2 py-1 rounded-full text-xs
                @if($formulir->status == 'diterima') bg-green-100 text-green-800
                @elseif($formulir->status == 'ditolak') bg-red-100 text-red-800
                @else bg-yellow-100 text-yellow-800
                @endif">
                {{ ucfirst($formulir->status) }}
            </span>
        </td>
        <td class="border px-3 py-2 text-gray-400 italic">
            {{ $formulir->alasan ?? '-' }}
        </td>
    </tr>
    @else
    <tr>
        <td colspan="12" class="text-center py-4 text-gray-500 italic">
            Belum ada data pendaftaran.
        </td>
    </tr>
    @endif
</tbody>

</table>
</div>
