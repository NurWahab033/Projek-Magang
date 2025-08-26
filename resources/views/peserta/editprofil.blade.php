<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profil</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fff;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      padding: 20px;
    }
    .container {
      max-width: 400px;
      width: 100%;
      text-align: center;
    }
    .back-btn {
      display: inline-block;
      background-color: #f5f5f5;
      padding: 8px 16px;
      border-radius: 8px;
      text-decoration: none;
      color: #000;
      font-size: 14px;
      border: none;
      cursor: pointer;
      margin-bottom: 10px;
    }
    h1 {
      font-size: 20px;
      margin-bottom: 20px;
    }
    .profile-pic-wrapper {
      position: relative;
      display: inline-block;
    }
    .profile-pic {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      border: 1px solid #ccc;
      object-fit: cover;
      background-color: #f8f8f8;
    }
    .upload-btn {
      position: absolute;
      bottom: 0;
      right: 0;
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 50%;
      padding: 5px;
      cursor: pointer;
    }
    .upload-btn img {
      width: 20px;
      height: 20px;
    }
    input[type="file"] {
      display: none;
    }
    .info-card {
      background-color: #f8fafa;
      text-align: left;
      padding: 15px;
      border-radius: 8px;
      margin-top: 20px;
      font-size: 14px;
    }
    .info-card p {
      margin: 8px 0;
    }
    .info-card strong {
      display: block;
    }
  </style>
</head>
<body>

  <div class="container">
    <a href="/peserta" class="back-btn">Kembali</a>
    <h1>Edit Profil</h1>

    <!-- Foto Profil -->
    <div class="profile-pic-wrapper">
      <img id="profileImage" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" alt="Profile" class="profile-pic">
      <label for="fileUpload" class="upload-btn">
        <img src="https://cdn-icons-png.flaticon.com/512/1040/1040230.png" alt="Camera">
      </label>
      <input type="file" id="fileUpload" accept="image/default profile.png" onchange="previewImage(event)">
    </div>

    <!-- Data Profil -->
    <div class="info-card">
      <p><strong>Nama Lengkap:</strong> Muhammad Nur Wahab</p>
      <p><strong>Alamat:</strong> Jl. Panglima Sudirman Gang 6 no 29 Gresik</p>
      <p><strong>No Telp:</strong> 08885280789</p>
      <p><strong>Email:</strong> Wahab@gmail.com</p>
      <p><strong>Nama Institusi:</strong> Universitas Muhammadiyah Gresik</p>
      <p><strong>Jurusan:</strong> Teknik Informatika</p>
    </div>
  </div>

  <script>
    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function(){
        document.getElementById('profileImage').src = reader.result;
      }
      reader.readAsDataURL(event.target.files[0]);
    }
  </script>

</body>
</html>
