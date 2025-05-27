<h4 class="mb-4">Tạo tài khoản mới</h4>

<?php if (!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post" class="text-start">
  <div class="mb-3">
    <label class="form-label">Tên đăng nhập / Email</label>
    <input type="text" name="TenDangNhap" class="form-control" required>
    <div class="invalid-feedback">
      <?= $errors['TenDangNhap'] ?? '' ?>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Email (nếu khác Tên đăng nhập)</label>
    <input type="email" name="Email" class="form-control">
    <div class="invalid-feedback">
      <?= $errors['email'] ?? '' ?>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Mật khẩu</label>
    <input type="password" name="MatKhau" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Vai trò</label>
    <select name="VaiTro" class="form-select">
      <option value="KhachHang">Khách hàng</option>
      <option value="admin">Admin</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success w-100">Đăng ký</button>
</form>

<p class="mt-3 text-center text-muted">
  Đã có tài khoản?
  <a href="auth.php?act=auth-login">Đăng nhập</a>
</p>