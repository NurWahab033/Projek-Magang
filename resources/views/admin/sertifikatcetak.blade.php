{{-- resources/views/admin/sertifikatcetak.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sertifikat Magang</title>
<style>
    {!! file_get_contents(public_path('css/sertifikat.css')) !!}
</style>
</head>
<body>

<div class="container">
    {{-- <a class="back-btn" href="{{ route('sertifikat.index') }}">Kembali</a> --}}
    <a href="javascript:void(0)" onclick="window.close();" class="back-btn">Kembali</a>

    <button class="btn-print" onclick="window.print()">Cetak Sertifikat</button>

    <!-- Halaman Depan -->
    <div class="page">
        <img src="{{ asset('images/Logo IHC 1.png') }}" alt="Watermark" class="watermark">
        <img src="{{ asset('images/cipta nirmala.png') }}" alt="Logo Kiri" class="logo-left">

        <div class="judul">SERTIFIKAT</div>
        <div class="nomor">{{ $sertifikat->nomor_sertifikat ?? 'XXXX' }}</div>

        <div class="isi">Diberikan kepada :</div>
        <div class="penerima"><b>{{ strtoupper($sertifikat->formulir->nama_lengkap) }}</b></div>

        <div class="isi">
            <!-- Bagian ini biar kamu isi sendiri -->
            ATAS PARTISIPASINYA SEBAGAI <b>PESERTA</b> MAGANG BERSERTIFIKAT <br><br>
            <span class="program">
                <b>“PROGRAM STUDI {{ strtoupper($sertifikat->formulir->jenjang) }} {{ strtoupper($sertifikat->formulir->jurusan) }} <br>
                FAKULTAS {{ strtoupper($sertifikat->formulir->fakultas) }} {{ strtoupper($sertifikat->formulir->nama_institusi) }}”</b>
            </span><br><br><br>
            <b>DI PT CIPTA NIRMALA (RUMAH SAKIT SEMEN GRESIK) <br>
            Tanggal, {{ \Carbon\Carbon::parse($sertifikat->formulir->tanggal_mulai_magang)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($sertifikat->formulir->tanggal_selesai_magang)->translatedFormat('d F Y') }}
        </div>

        <div class="ttd">
            <div>Manajer Sumber Daya Manusia</div>
            <div class="space-ttd"></div>
            <b>Achmad Farid, dr. Sp.KFR</b>
        </div>
    </div>

    <!-- Halaman Belakang -->
<!-- Halaman Belakang -->
<div class="page">
    <div class="judul-tabel">LEMBAR PENILAIAN<br>MAGANG BERSERTIFIKAT</div>

    <div class="subjudul">
        PROGRAM STUDI {{ strtoupper($sertifikat->formulir->jenjang) }} {{ strtoupper($sertifikat->formulir->jurusan) }} <br>
        FAKULTAS {{ strtoupper($sertifikat->formulir->fakultas) }} {{ strtoupper($sertifikat->formulir->nama_institusi) }} <br>
        DI PT. CIPTA NIRMALA (RUMAH SAKIT SEMEN GRESIK)
    </div>

    <table class="tabel-penilaian">
        <thead>
            <tr>
                <th>CLO</th>
                <th>ASPEK PENILAIAN</th>
                <th>DESKRIPSI ASPEK PENILAIAN</th>
                <th>SKOR (0-100)</th>
            </tr>
        </thead>
        <tbody>
            <!-- CLO 1 -->
            <tr>
                <td rowspan="2">CLO 1</td>
                <td>PENYELESAIAN TUGAS</td>
                <td>Penyelesaian Setiap Tugas yang Diberikan Oleh Pembimbing Lapangan. Penilaian Berdasarkan Presentase Penyelesaian Tugas</td>
                <td>{{ strtoupper($sertifikat->penilaian->penyelesaian) }}</td>
            </tr>
            <tr>
                <td>INISIATIF dan KREATIFITAS</td>
                <td>Kemampuan Merespon Masalah Secara proaktif dan Gigih Menjajaki Kesempatan yang ada. Melakukan Sesuatu Tanpa di Suruh Guna Mengatasi Hambatan yang di Tampilkan Secara Motorik/Verbal (Yang Berkonsekwen Tindakan)</td>
                <td>{{ strtoupper($sertifikat->penilaian->inisiatif) }}</td>
            </tr>

            <!-- CLO 2 -->
            <tr>
                <td rowspan="3">CLO 2</td>
                <td>KOMUNIKASI</td>
                <td>Kemampuan Untuk Menyampaikan Informasi, Mendengarkan Orang Lain, Berkomunikasi Secara Efektif dan Memberikan Respon Positif yang Mendorong Komunikasi Terbuka</td>
                <td>{{ strtoupper($sertifikat->penilaian->komunikasi) }}</td>
            </tr>
            <tr>
                <td>KERJASAMA</td>
                <td>Kemampuan Menjalani Kerjasama dalam Tim, Peka Akan Kebutuhan Orang Lain dan Memberikan Kontribusi dalam Aktivitas Tim untuk Mencapai Tujuan dan Hasil yang Positif.</td>
                <td>{{ strtoupper($sertifikat->penilaian->kerjasama) }}</td>
            </tr>
            <tr>
                <td>DISIPLIN KERJA dan ADAPTASI</td>
                <td>Kemampuan Untuk Mematuhi Aturan yang Berlaku dan Dapat Menyesuaikan Prilaku Agar Dapat Bekerja Secara Efektif dan Efisien Saat Adanya Informasi Baru, Perubahan Situasi atau Kondisi Lingkungan Kerja yang Berbeda.</td>
                <td>{{ strtoupper($sertifikat->penilaian->kedisiplinan) }}</td>
            </tr>

            <!-- Rata-rata -->
            <tr>
                <td colspan="3" style="text-align:right; font-weight:bold;">RATA-RATA NILAI</td>
                <td><b>{{ strtoupper($sertifikat->penilaian->rata_rata) }}</b></td>
            </tr>
        </tbody>
    </table>

    <br><br>

    <div class="signature">
        <div style="display: flex; justify-content: flex-end; flex-direction: column; align-items: flex-end;">
            <div style="text-align: right; margin-bottom: 5px;">
                <p style="margin: 0;">Gresik, {{ \Carbon\Carbon::parse($sertifikat->tanggal_terbit)->translatedFormat('d F Y') }}</p>
                <p style="margin: 0;">Pembimbing,</p>
            </div>
            <div id="qrcode" style="width: 150px; height: 150px; margin-bottom: 5px;"></div>
            <div style="text-align: right;">
                <p>{{ $sertifikat->penilaian?->pic?->username ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Script QR Code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
  let qrText = "{{ $sertifikat->penilaian?->pic?->username ?? '-' }}-{{ $sertifikat->penilaian?->pic?->nama_institusi ?? '-' }} ({{ \Carbon\Carbon::parse($sertifikat->formulir->tanggal_mulai_magang)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($sertifikat->formulir->tanggal_selesai_magang)->translatedFormat('d F Y') }})";
  new QRCode(document.getElementById("qrcode"), {
    text: qrText,
    width: 150,
    height: 150
  });
</script>



</body>
</html>
