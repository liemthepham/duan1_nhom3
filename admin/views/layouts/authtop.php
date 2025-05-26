<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?? 'Đăng nhập' ?></title>
  <link href="/duan1/admin/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/duan1/admin/assets/css/custom.min.css" rel="stylesheet">

  <style>
    .auth-body-bg {
      background: #f8f9fa;
      min-height: 100vh;
    }
    .auth-card {
      max-width: 400px;
      width: 100%;
      padding: 2rem;
      background: #fff;
      border-radius: .5rem;
      box-shadow: 0 0 10px rgba(0,0,0,.1);
    }
    .auth-logo {
      max-width: 120px;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body class="auth-body-bg d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="auth-card text-center">
