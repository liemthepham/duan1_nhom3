<?php require __DIR__ . '/../../layouts/layouts_top.php';?>
<h2>Sửa Danh mục #<?= $item['MaDanhMuc'] ?></h2>
<form method="post">
  <div class="form-group">
    <label>Tên danh mục</label>
    <input name="TenDanhMuc" class="form-control"
           value="<?= htmlspecialchars($item['TenDanhMuc']) ?>" required>
  </div>
  <div class="form-group">
    <label>Danh mục cha</label>
    <select name="MaDanhMucCha" class="form-control">
      <option value="">— Root —</option>
      <?php foreach($parents as $p): ?>
        <option value="<?= $p['MaDanhMuc'] ?>"
          <?= $p['MaDanhMuc']==$item['MaDanhMucCha']?'selected':''?>>
          <?= htmlspecialchars($p['TenDanhMuc']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <button class="btn btn-success">Cập nhật</button>
  <a href="index.php?act=category-list" class="btn btn-secondary">Hủy</a>
</form>
<?php require __DIR__ . '/../../layouts/layout_bottom.php';?>

