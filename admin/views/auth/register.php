<h2>Đăng ký</h2>
<?php if(!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>
<form method="post">
  <div class="mb-3">
    <label>Tên đăng nhập / Email</label>
    <input name="TenDangNhap" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Email (nếu khác TenDangNhap)</label>
    <input type="email" name="Email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Mật khẩu</label>
    <input type="password" name="MatKhau" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Vai trò</label>
    <select name="VaiTro" class="form-select">
      <option value="khachhang">Khách hàng</option>
      <option value="admin">Admin</option>
    </select>
  </div>
  <button class="btn btn-primary">Đăng ký</button>
  <a href="index.php?act=auth-login" class="btn btn-link">Đã có tài khoản?</a>
</form>
