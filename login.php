<?php

if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($koneksi, $_POST['username']);
  $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

  $sql = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");
  $cek = mysqli_num_rows($sql);
  $data = mysqli_fetch_assoc($sql);

  if ($cek > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['data'] = $data;

    if ($data['level'] === "admin") {
      header('Location: admin/');
    } elseif ($data['level'] === "petugas") {
      header('Location: petugas/');
    }
    exit();
  } else {
    echo "<script>alert('Gagal Login. Username atau Password salah!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - e-Connote Hybrid</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #4bb4e6 url('background-jne.png') no-repeat center center fixed;
      background-size: cover;
    }

    .login-container {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background: #fff;
      padding: 25px 20px;
      width: 360px;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      text-align: center;
    }

    .login-box h3 {
      font-weight: normal;
      color: #555;
      margin-bottom: 8px;
      font-size: 16px;
    }

    .login-box img {
      width: 150px;
      margin-bottom: 15px;
    }

    .input-wrapper {
      position: relative;
      margin-bottom: 10px;
    }

    .input-wrapper i {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      color: #999;
      font-size: 14px;
    }

    .input-wrapper input {
      width: 100%;
      padding: 7px 12px 7px 38px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 13px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #dce3ec;
      color: #003366;
      font-weight: bold;
      font-size: 14px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background-color: #b8c7d6;
    }

    .footer {
      margin-top: 15px;
      font-size: 11px;
      color: #aaa;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <h3>e-Connote Hybrid</h3>
      <img src="img/logo_JNE.png" alt="JNE Express Logo">

      <form method="POST">
        <div class="input-wrapper">
          <i class="fa fa-user"></i>
          <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-wrapper">
          <i class="fa fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="login">Login</button>
      </form>

      <div class="footer">
        &copy; 2016–2019 IT-Development JNE
      </div>
    </div>
  </div>
</body>
</html>
