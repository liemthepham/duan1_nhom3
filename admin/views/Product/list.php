<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            vertical-align: middle;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        td img {
            max-height: 50px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        /* Nút */
        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin-right: 8px;
            white-space: nowrap;
            transition: background-color 0.3s ease;
        }

        .btn-add {
            background-color: #28a745;
            margin-bottom: 15px;
            display: inline-block;
        }

        .btn-add:hover {
            background-color: #218838;
        }

        .btn-edit {
            background-color: #007bff;
        }

        .btn-edit:hover {
            background-color: #0069d9;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        /* Cột hành động */
        th.actions,
        td.actions {
            width: 160px;
            text-align: center;
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <h2>Danh Sách sản phẩm</h2>

    <table>
        <thead>
            <tr>
                <th>Mã Sản Phẩm</th>
                <th>Mã Danh Mục</th>
                <th>Tên Sản Phẩm</th>
                <th>Mô Tả</th>
                <th>Số Lượng Tồn</th>
                <th>Giá</th>
                <th>ảnh Đại Diện</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $sp): ?>
                <tr>
                    <td><?= $sp['MaSanPham'] ?></td>
                    <td><?= $sp['MaDanhMuc'] ?></td>
                    <td><?= $sp['TenSanPham'] ?></td>
                    <td><?= $sp['MoTa'] ?></td>
                    <td><?= $sp['SoLuongTon'] ?></td>
                    <td><?= number_format($sp['Gia'], 0, ',', '.') ?> đ</td>
                    <td><img src="/duan1/uploads/<?= $sp['AnhDaiDien'] ?>" width="80"></td>
                    <td>
                        <a href="edit_product.php?MaSanPham=<?= $sp['MaSanPham'] ?>" class="btn btn-edit">Sửa</a>
                        

                        <a href="delete_product.php?MaSanPham=<?= $sp['MaSanPham'] ?>" class="btn btn-delete" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>