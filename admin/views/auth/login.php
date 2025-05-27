<?php ?>
<img src="/duan1/uploads/logologin.png"  class="auth-logo" alt="Logo">
<h4 class="mb-4">Chào mừng trở lại!</h4>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post" class="text-start">
  <div class="mb-3">
    <label class="form-label">Email hoặc tên đăng nhập</label>
    <input type="text" name="login" class="form-control" placeholder="Nhập email hoặc username" required>
    <div class="invalid-feedback">
      <?= $errors['login'] ?? '' ?>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Mật khẩu</label>
    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>
    <div class="invalid-feedback">
      <?= $errors['login'] ?? '' ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
</form>

<p class="mt-3 text-muted">
  Chưa có tài khoản?
  <a href="auth.php?act=auth-register">Đăng ký ngay</a>
</p>