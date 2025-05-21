<?php
require __DIR__ . '/../layouts/layouts_top.php';
?>


<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Danh Sách Sản Phẩm</h5>
                <a href="index.php?act=product-add" class="btn btn-primary btn-sm">
                    + Thêm Sản Phẩm
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Mã SP</th>
                            <th>Mã DM</th>
                            <th>Tên SP</th>
                            <th>Mô Tả</th>
                            <th>Số Lượng Tồn</th>
                            <th>Giá</th>
                            <th>Ảnh Đại Diện</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td><?= $p['MaSanPham'] ?></td>
                                <td><?= $p['MaDanhMuc'] ?></td>
                                <td><?= htmlspecialchars($p['TenSanPham']) ?></td>
                                <td><?= htmlspecialchars($p['MoTa']) ?></td>
                                <td><?= $p['SoLuongTon'] ?></td>
                                <td><?= number_format($p['Gia'], 0, ',', '.') ?> đ</td>
                                <td>
                                    <?php if (!empty($p['AnhDaiDien'])): ?>
                                        <img
                                            src="uploads/<?= rawurlencode($p['AnhDaiDien']) ?>"
                                            alt=""
                                            style="max-width:80px; object-fit:cover;">
                                    <?php else: ?>
                                        <span class="text-muted">Chưa có</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="index.php?act=product-edit&id=<?= $p['MaSanPham'] ?>"
                                        class="btn btn-sm btn-warning me-1">Sửa</a>
                                    <a href="index.php?act=product-delete&id=<?= $p['MaSanPham'] ?>"
                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"
                                        class="btn btn-sm btn-danger">
                                        Xóa
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require __DIR__ . '/../layouts/layout_bottom.php';
?>