<h2>Đăng nhập</h2>
<?php if(!empty($error)): ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>
<form method="post">
  <div class="mb-3">
    <label>Tên đăng nhập hoặc Email</label>
    <input name="login" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Mật khẩu</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button class="btn btn-success">Đăng nhập</button>
  <a href="index.php?act=auth-register" class="btn btn-link">Đăng ký mới</a>
</form>
