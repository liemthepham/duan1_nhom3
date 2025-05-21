<?php  require __DIR__ . '/../../layouts/layouts_top.php'; ?>
<h2>Thêm Danh mục</h2>
<form method="post">
  <div class="form-group">
    <label>Tên danh mục</label>
    <input name="TenDanhMuc" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Danh mục cha</label>
    <select name="MaDanhMucCha" class="form-control">
      <option value="">— Root —</option>
      <?php foreach($parents as $p): ?>
        <option value="<?= $p['MaDanhMuc'] ?>">
          <?= htmlspecialchars($p['TenDanhMuc']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <button class="btn btn-success">Lưu</button>
  <a href="index.php?controller=category&action=index" class="btn btn-secondary">Hủy</a>
</form>
<?php  require __DIR__ . '/../../layouts/layout_bottom.php'; ?>
