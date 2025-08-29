<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sertifikat Magang</title>
<style>
    body {
        font-family: 'Calibri', serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }
    .container {
        text-align: center;
        padding: 20px;
    }
    .page {
        width: 210mm;
        height: 297mm;
        background: white;
        margin: auto;
        padding: 40px;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        position: relative;
        overflow: hidden; 
        page-break-after: always;
}

/* Background watermark */
    .page .watermark {
        position: absolute;
        top: 35%; 
        left: 35%;
        opacity: 0.15;
        width: 800px; 
        height: auto; 
        pointer-events: none; 
        z-index: 0; 
}

    .back-btn {
        position: fixed; 
        top: 20px;
        left: 20px;
        margin: 0;
        padding: 10px 16px;
        background: #f0eaea;
        color: #9e3d3d;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-family: 'Poppins', sans-serif;
        font-size: 16px;
        font-weight: 500;
        z-index: 999; 
}
    .btn-print {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #9e3d3d;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 20px;
    }
    .btn-print:hover {
        background-color: #005fa3;
    }
    .page {
        width: 210mm;
        height: 297mm;
        background: white;
        margin: auto;
        padding: 40px;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        position: relative;
        page-break-after: always;
    }

    /* Logo atas */
    .logo-left {
        position: absolute;
        top: 30px;
        left: 40px;
        height: 120px;
    }
    .logo-right {
        position: absolute;
        top: 60px;
        right: 40px;
        height: 90px;
    }

    /* Halaman Depan */
    .judul {
        margin-top: 130px;
        font-size: 84px;
        font-weight: bold;
    }
    .nomor {
        font-size: 27px;
        margin-top: 5px;
    }
    .isi {
        margin-top: 40px;
        font-size: 25px;
    }
    .penerima {
        padding-top: 40px;
        font-size: 26px;;
        margin: 20px 0;
    }
    .program {
        color: #0056b3;
        font-weight: bold
        font-size: 26px ;
    }
    .ttd {
        position: absolute;
        bottom: 60px;
        right: 80px;
        text-align: center;
        font-size: 24px;
    }

    .space-ttd {
    height: 150px; 
    }

    /* Halaman Belakang */
    .judul-tabel {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }
    .subjudul {
        text-align: center;
        font-size: 18px;
        margin-bottom: 10px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        font-size: 16px;
    }
    table, th, td {
        border: 1px solid #333;
    }
    th {
        background-color: #9bbb59;
        color: black;
        padding: 10px;
        text-align: center;
    }
    td {
        padding: 5px;
        vertical-align: top;
    }

    .signature{
        font-size: 20px;
    }
    #qrcode {
        width: 80px;
        height: 80px;
    }

    @media print {
        body {
            background: white;
        }
        .back-btn {  /* tambahkan ini */
        display: none;
        }
        .btn-print {
            display: none;
        }
        .page {
            box-shadow: none;
            margin: 0;
        }
    }
</style>
</head>
<body>

<div class="container">
    <a class="back-btn" href="/sertifikat">Kembali</a>
    <button class="btn-print" onclick="window.print()">Cetak Sertifikat</button>

    <!-- Halaman Depan -->
    <div class="page">
    <img src="images/Logo IHC 1.png" alt="Watermark" class="watermark">
    
    <img src="images/cipta nirmala.png" alt="Logo Kiri" class="logo-left">

        <div class="judul">SERTIFIKAT</div>
        <div class="nomor">No 00244/KP.02.02/90006/03.2025</div>

        <div class="isi">Diberikan kepada :</div>
        <div class="penerima"><b>FEBRI AZIMI ALFIRMANSYAH</b></div>

        <div class="isi">
            ATAS PARTISIPASINYA SEBAGAI <b>PESERTA</b> MAGANG BERSERTIFIKAT <br><br>
            <span class="program">
            <b>“PROGRAM STUDI S1 TEKNIK INFORMATIKA <br>
            FAKULTAS TEKNIK UNIVERSITAS MUHAMMADIYAH GRESIK”<b>
            </span><br> <br> <br>
            <b>DI PT CIPTA NIRMALA (RUMAH SAKIT SEMEN GRESIK) <br>
            Tanggal, 10 Februari 2025 s/d 07 Maret 2025</b>
        </div>

        <div class="ttd">
        <div>Manajer Sumber Daya Manusia</div>
        <div class="space-ttd"></div>
        <b>Achmad Farid, dr. Sp.KFR</b>
        </div>
        </div>

    <!-- Halaman Belakang -->
    <div class="page">
        <div class="judul-tabel">LEMBAR PENILAIAN<br>MAGANG BERSERTIFIKAT</div>
        <div class="subjudul">
            PROGRAM STUDI S1 TEKNIK INFORMATIKA<br>
            FAKULTAS TEKNIK UNIVERSITAS MUHAMMADIYAH GRESIK<br>
            DI PT. CIPTA NIRMALA (RUMAH SAKIT SEMEN GRESIK)
        </div>

        <table>
            <thead>
                <tr>
                    <th>CLO</th>
                    <th>ASPEK PENILAIAN</th>
                    <th>DESKRIPSI ASPEK PENILAIAN</th>
                    <th>BOBOT</th>
                    <th>SKOR (0-100)</th>
                    <th>NILAI (BOBOT * SKOR)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2">CLO 1</td>
                    <td>PENYELESAIAN TUGAS</td>
                    <td>Penyelesaian setiap tugas yang diberikan oleh pembimbing lapangan. Penilaian berdasarkan presentase penyelesaian tugas.</td>
                    <td>50%</td>
                    <td>80</td>
                    <td>40</td>
                </tr>
                <tr>
                    <td>INISIATIF dan KREATIFITAS</td>
                    <td>Kemampuan merespon masalah secara proaktif dan gigih menjajaki kesempatan yang ada. Melakukan sesuatu tanpa disuruh guna mengatasi hambatan yang ditampilkan secara motorik/verbal (yang berkonsekwen tindakan).</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2">CLO 2</td>
                    <td>KOMUNIKASI</td>
                    <td>Kemampuan untuk menyampaikan informasi, mendengarkan orang lain, berkomunikasi secara efektif dan memberikan respon positif yang mendorong komunikasi terbuka.</td>
                    <td>50%</td>
                    <td>80</td>
                    <td>40</td>
                </tr>
                <tr>
                    <td>KERJASAMA</td>
                    <td>Kemampuan menjalani kerjasama dalam tim, peka akan kebutuhan orang lain, dan memberikan kontribusi dalam aktivitas tim untuk mencapai tujuan dan hasil yang positif.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:right; font-weight:bold;">TOTAL NILAI</td>
                    <td><b>80</b></td>
                </tr>
            </tbody>
        </table>
<br>
<br>
        <!-- Footer Penilaian -->
<div class="signature">
<div style="display: flex; justify-content: flex-end; flex-direction: column; align-items: flex-end;">
    <div style="text-align: right; margin-bottom: 5px;">
        <p style="margin: 0;">Gresik, 07 Maret 2025</p>
        <p style="margin: 0;">Pembimbing,</p>
    </div>
    <!-- QR Code akan di-generate di sini -->
    <div id="qrcode" style="width: 150px; height: 150px; margin-bottom: 5px;"></div>
    <div style="text-align: right;">
        <strong>NANANG JUDIANTO, A.Md</strong><br>
        No.PEG : 7109720
    </div>
</div>
</div>

<!-- Script QR Code -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
  let qrText = "MANAGER ERP & PPB NANANG JUDIANTO, A.Md. 10 Februari s/d 07 Maret 2025";
  new QRCode(document.getElementById("qrcode"), {
    text: qrText,
    width: 150,
    height: 150
  });
</script>

</body>
</html>
